<?php

/*
  Plugin Name: Reshatel Form To LK
  Description: Форма Узнать стоимость.
  Version: 0.1
  Author: Rusty Shackleford
 */

include_once __DIR__.'/../../shared/emailChecker.php';

$site2 = 'https://lk.reshatel.org';
define('LINK_API_CREATE2', $site2 . '/api/v1/order/create/');
define('KEY_API2', 'zZ(rcA5Ly1');


$rftl = new RFTL();
$rftl->run();

class RFTL {

    private $redirect_url;

    public function __construct() {
        
    }

    public function run() {
        add_action('admin_post_get_cost', [$this, 'empty_response'], 10);
        add_action('admin_post_nopriv_get_cost', [$this, 'empty_response'], 10);
        add_action('formcraft_after_save', [$this, 'get_cost_processing'], 10, 4);
    }

    public function get_cost_processing($content, $meta, $raw_content, $integrations) {
        global $fc_final_response;

        $this->log('get_cost_processing!');

        $data = ['key' => KEY_API2];

        foreach ($raw_content as $field) {
            $data[$field['altLabel']] = $field['value'];
        }

        if (!empty($data['email'])) {
            $this->log_spam(var_export($data, true));
            return;
        }

        if (!EmailChecker::isLooksCorrect($data['user_email'])) {
            $checker = new EmailChecker($data['user_email']);
            $data['user_email'] = $checker->tryFix();
        }

        if (isset($content['Прикрепите файлы'])) {
            preg_match_all('/<a href=\'(.*?)\'>/s', $content['Прикрепите файлы'], $matches);

            $regexp = '#' . preg_quote(get_site_url()) . '/(.*)/((.*?)-(.*))$#';
            $new_dir = uniqid();

            for ($i = 0; $i < count($matches[1]); $i++) {
                preg_match($regexp, $matches[1][$i], $match);
                $old_path = $match[1] . '/' . $match[2];
                $new_path = $match[1] . '/' . $new_dir . '/' . $match[4];

                if (!is_dir(ABSPATH . $match[1] . '/' . $new_dir)) {
                    mkdir(ABSPATH . $match[1] . '/' . $new_dir);
                }

                rename(ABSPATH . $old_path, ABSPATH . $new_path);

                $data["files[$i]"] = get_site_url() . '/' . $new_path;
            }
        }

        if (!$data['user_name']) {
            $data['user_name'] = 'Друг';
        }

        if (!$data['subject']) {
            $data['subject'] = 'Предмет не указан';
        }

        if (!$data['name']) {
            $data['name'] = $this->get_type_name($data['type']) . '. ' . $data['subject'];
        }

        $res = $this->get_cost_send_data($data);

        $this->log(var_export($data, true));

        if ($res->error == 0) {
            $this->redirect_url = $res->url;
        } else {
            $fc_final_response['failed'] = $res->error_text;
        }

        $fc_final_response['redirect'] = $this->redirect_url;
        $fc_final_response['success'] = 'Спасибо за заказ!<br>Сейчас мы его посмотрим и оценим.<br>' . '<a href="' . $this->redirect_url . '">Перейти в заказ</a>';
    }

    private function get_cost_send_data($data) {
        $ch = curl_init(LINK_API_CREATE2);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $result = curl_exec($ch);
        curl_close($ch);

        if ($result == true) {
            return json_decode($result);
        }

        return ['error' => 'Сервер не отвечает, попробуйте позже.'];
    }

    public function empty_response() {
        if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            $this->log_spam(var_export(array_merge([
                'HTTP_CLIENT_IP' => $_SERVER['HTTP_CLIENT_IP'],
                'HTTP_X_FORWARDED_FOR' => $_SERVER['HTTP_X_FORWARDED_FOR'],
                'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
                'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT']]
                                    , $_POST), true));
        }
        echo json_encode(['error' => 0]);
    }

    private function get_type_name(int $id) {
        $type = [1 => 'Контрольная', 2 => 'Решение задач', 3 => 'Курсовая', 4 => 'Диплом', 5 => 'Реферат', 7 => 'Другое', 9 => 'Презентация', 10 => 'Эссе', 11 => 'Отчет по практике'];
        return $type[$id];
    }

    private function log($text) {
        error_log(date("d.m.Y H:i:s") . PHP_EOL . $text . PHP_EOL . '-------------' . PHP_EOL, 3, plugin_dir_path(__FILE__) . 'log.log');
    }

    private function log_spam($text) {
        error_log(date("d.m.Y H:i:s") . PHP_EOL . $text . PHP_EOL . '-------------' . PHP_EOL, 3, plugin_dir_path(__FILE__) . 'spamers.log');
    }

}
