<?php

/*
  Plugin Name: Reshatel Forms
  Plugin URI: https://reshatel.org/
  Version: 1.0
  Description: Плагин для работы контактных форм на сайте, и обменом информации с другим сайтом по API
  Author: renak
  Author URI: http://freelance.ru/renak
  License: GPLv2
 */

/*  Copyright 2013  |*****Andrew Pisarevsky****|  (email : renakdup@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
global $wpdb;

$site = 'https://lk.reshatel.org';
define('LINK_API_CREATE', $site . '/api/v1/order/create/');
define('LINK_API_CHECK', $site . '/api/v1/order/info/');
define('KEY_API', 'zZ(rcA5Ly1');
// название таблицы где хранятся файлы
define('RE_TABLE_FILES', $wpdb->prefix . 'form_files');
define('RE_TABLE_ORDER', $wpdb->prefix . 'order');

define('FILES_PATH', plugin_dir_path(__FILE__) . 'server/php/order_files/');
define('FILES_PATH_TMP', plugin_dir_path(__FILE__) . 'server/php/files_tmp/');
define('URL_FILES', plugins_url('server/php/order_files/', __FILE__));
define('URL_FILES_TMP', plugins_url('server/php/files_tmp/', __FILE__));

// Обработка формы, отправка и принятие данных JSON
include dirname(__FILE__) . '/prosessing_form.php';

/**
 * При активации плагина
 */
function re_install() {
    global $wpdb;

    $sql = "CREATE TABLE IF NOT EXISTS `" . RE_TABLE_ORDER . "` (
  				`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  				`id_order` int(11) unsigned NULL,
  				`url` varchar(255) NOT NULL,
  				`directory_files` varchar(255) NULL,
  				PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    $wpdb->query($sql);

    // create new table
    $sql = "CREATE TABLE IF NOT EXISTS `" . RE_TABLE_FILES . "` (
  				`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  				`name` varchar(255) NOT NULL,
  				`size` int(11) NOT NULL,
  				`type` varchar(255) NOT NULL,
  				`id_order` int(11) NOT NULL,
  				`time_download` INT(11) NOT NULL,
  				PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    $wpdb->query($sql);
}

register_activation_hook(__FILE__, 're_install');

/**
 * Инициализация данных форм
 */
function re_init_email() {
    //имена полей формы по дефолту (для html и проверки)
    global $re_data;

    // is_ajax_request - если ajax запрос - значение "true"
    if (!empty($_POST['re_form_is_ajax'])) {
        $is_ajax_request = true;
    } else {
        $is_ajax_request = false;
    }

    $re_data['form'] = array(
        'is_ajax_request' => $is_ajax_request,
        'status_ajax_email_send' => null, //null - не известно|отправлено, false - не отправлено
        'name_fields' => array(
            'name' => 're_form_name',
            'email_for_bot' => 're_form_email',
            'email' => 're_form_post',
            'tel' => 're_form_tel',
            'subject' => 're_form_subject',
            'title' => 're_form_title',
            'date_and_time' => 're_form_date_and_time',
            'date' => 're_form_date',
            'duration' => 're_form_duration',
            'other_input_text' => 're_form_other_input_text',
            'number_task' => 're_form_number_task',
            'number_start' => 're_form_number_start',
            'number_end' => 're_form_number_end',
            'unical_procent' => 're_form_unical_procent',
            'site_unical' => 're_form_site_unical',
            'type_work' => 're_form_type_work',
            'comment' => 're_form_comment',
            'select_type' => 're_from_select_type'
        ),
        'prefix_form_id' => 're_form-',
        'class_form' => 're_form',
    );
}

add_action('init', 're_init_email', 11);

/**
 * выводим html формы шорткодом
 */
function re_shortcode_form($atts) {
    global $re_data;

    // Список доступных файлов форм для подключения
    $list_files = array(
        'online-pomoshh',
        'reshenie-zadach',
        'kontrolnye-raboty',
        'kursovye-raboty',
        'diploms',
        'referats',
        'essay',
        'otchety-po-praktike',
        'presentations',
        'articles',
        'category',
        'perevody',
        'laboratornye',
        'choose_type');

    if (isset($atts['name']) && in_array($atts['name'], $list_files)) {
        $type_form = $atts['name'];
        $form_action = admin_url('admin-ajax.php') . '?action=re_processing_form&re_action_form=' . $type_form;  //action attribute form
        $prefix_form_id = $re_data['form']['prefix_form_id'];
        $class_form = $hg_data['form']['class_form'];

        ob_start();
        include dirname(__FILE__) . '/template/' . $atts['name'] . '.php';
        $content = ob_get_contents();
        ob_get_clean();

        return $content;
    } else {
        return 'Form not found';
    }
}

add_shortcode('reshatel_form', 're_shortcode_form');

//Подключаем js and css
function re_enqueues() {
    $url_js = plugins_url('js', __FILE__);
    $url_css = plugins_url('css', __FILE__);

    wp_register_style('re-form-css', $url_css . '/form.css?v=2', false, null);
    wp_enqueue_style('re-form-css');

//    wp_register_style('jquery-ui.min-css', $url_js . '/jquery-ui.min.css', false, null);
//    wp_enqueue_style('jquery-ui.min-css');

    wp_register_style('jquery-ui-timepicker-addon-css', $url_js . '/jquery-ui-timepicker/jquery-ui-timepicker-addon.min.css', false, null);
    wp_enqueue_style('jquery-ui-timepicker-addon-css');

    wp_register_script('jquery.ui.widget-js', $url_js . '/jquery.ui.widget.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('jquery.ui.widget-js');

    wp_register_script('jquery.iframe-transport-js', $url_js . '/jquery.iframe-transport.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('jquery.iframe-transport-js');

    wp_register_script('jquery.fileupload-js', $url_js . '/jquery.fileupload.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('jquery.fileupload-js');

    wp_register_script('re-main-js', $url_js . '/main.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('re-main-js');

    wp_register_script('jquery.form-js', $url_js . '/jquery.form.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('jquery.form-js');

    wp_register_script('jquery.validate-js', $url_js . '/jquery.validate.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('jquery.validate-js');

    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('jquery-ui-widget');
    wp_enqueue_script('jquery-ui-mouse');
    wp_enqueue_script('jquery-ui-slider');
    wp_enqueue_script('jquery-ui-button');
    wp_enqueue_script('jquery-effects-blind');

    wp_register_script('jquery-ui-timepicker-addon.min-js', $url_js . '/jquery-ui-timepicker/jquery-ui-timepicker-addon.min.js', array('jquery-ui-core'), '1.0.0', true);
    wp_enqueue_script('jquery-ui-timepicker-addon.min-js');

    wp_register_script('jquery-ui-timepicker-ru-js', $url_js . '/jquery-ui-timepicker/i18n/jquery-ui-timepicker-ru.js', array('jquery-ui-core'), '1.0.0', true);
    wp_enqueue_script('jquery-ui-timepicker-ru-js');

    wp_register_script('jquery-ui-sliderAccess-js', $url_js . '/jquery-ui-timepicker/jquery-ui-sliderAccess.js', array('jquery-ui-core'), '1.0.0', true);
    wp_enqueue_script('jquery-ui-sliderAccess-js');

    wp_register_script('jdatepicker-ru.min-js', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/i18n/datepicker-ru.min.js?ver=1.11.4', array('jquery-ui-core'), '1.0.0', true);
    wp_enqueue_script('jdatepicker-ru.min-js');
}

add_action('wp_enqueue_scripts', 're_enqueues', 100);

/**
 * Обработка Ajax запроса загрузки файлов на сервер в контактной форме
 */
function re_upload_files_form() {
    include dirname(__FILE__) . '/server/php/index.php';
    wp_die();
}

add_action('wp_ajax_re_upload_files_form', 're_upload_files_form');
add_action('wp_ajax_nopriv_re_upload_files_form', 're_upload_files_form');

/**
 * Проверка заказов и удаление файлов для них
 */
function re_delete_orders() {
    global $wpdb;

    if (isset($_GET['re_cron']) && $_GET['re_cron'] == 'delete_orders_Het12r52') {
        $re_mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($re_mysqli->connect_error) {
            die('Ошибка подключения к BD');
        }

        $sql = "SELECT `id_order` FROM " . RE_TABLE_ORDER;
        if ($result = $re_mysqli->query($sql)) {

            while ($query_order = $result->fetch_row()) {
                $id_order = $query_order[0];
                $ch = curl_init(LINK_API_CHECK . $id_order . '/?key=' . KEY_API);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1); //ожидание ответа от сервера
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $json = curl_exec($ch);
                curl_close($ch);

                if ($json == true) {
                    $json = json_decode($json);

                    if ($json->error == 1 || $json->files_loaded == "done" || $json->files_loaded == "none") {
                        $order = $wpdb->get_row('SELECT * FROM ' . RE_TABLE_ORDER . ' WHERE id_order = ' . $id_order);
                        if ($order) {
                            if ($order->directory_files) {
                                re_dirDel(FILES_PATH . $order->directory_files);
                            }
                            $wpdb->query('DELETE FROM ' . RE_TABLE_ORDER . ' WHERE id_order = ' . $id_order);
                            $wpdb->query('DELETE FROM ' . RE_TABLE_FILES . ' WHERE id_order = ' . $id_order);
                        }
                    }
                }
            }
        }
        $re_mysqli->close();
        exit();
    }
}

add_action('wp_loaded', 're_delete_orders');

/**
 * Удаление временных файлов
 */
function re_delete_files() {
    global $wpdb;

    if (isset($_GET['re_cron']) && $_GET['re_cron'] == 'delete_files_Njw5632ngsa') {
        $re_mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($re_mysqli->connect_error) {
            die('Ошибка подключения к BD');
        }

        $sql = "SELECT * FROM " . RE_TABLE_FILES . ' WHERE id_order IS NULL AND `time_download` < ' . ( time() - ( 60 * 30 ) );
        if ($result = $re_mysqli->query($sql)) {

            while ($files = $result->fetch_array()) {
                $fileName = FILES_PATH_TMP . $files['name'];
                if (is_file($fileName)) {
                    unlink($fileName);
                }
            }
            $re_mysqli->query('DELETE FROM ' . RE_TABLE_FILES . ' WHERE id_order IS NULL AND `time_download` < ' . ( time() - ( 60 * 30 ) ));
        }
        $re_mysqli->close();
        exit();
    }
}

add_action('wp_loaded', 're_delete_files');

/**
 * Функция удаления папки с файлами
 */
function re_dirDel($dir) {
    if (is_dir($dir)) {
        $d = opendir($dir);
    } else {
        return;
    }
    while (( $entry = readdir($d) ) !== false) {
        if ($entry != "." && $entry != "..") {
            if (is_dir($dir . "/" . $entry)) {
                //re_dirDel( $dir . "/" . $entry );
                error_log("Try deleting directory!", 0);
            } else {
                unlink($dir . "/" . $entry);
            }
        }
    }
    closedir($d);
    rmdir($dir);
}
