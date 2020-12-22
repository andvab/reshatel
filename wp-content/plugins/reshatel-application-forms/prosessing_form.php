<?php

/**
 * Файл обработки формы, отправка и принятие данных JSON
 */

include_once __DIR__.'/../../shared/emailChecker.php';

/**
 * Функция обработки данных формы
 * */
function re_processing_form() {
    global $re_data;

    // Массив данных для отправки на сервер
    $data_send_json = array(
        'key' => KEY_API,
    );

    // Супермизерная защита от ботов
    if ((!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') || $_POST[$re_data['form']['name_fields']['email_for_bot']] != 'example@email.com') {
        error_log(date("d.m.Y H:i:s") . PHP_EOL . var_export(array_merge([
                    'HTTP_CLIENT_IP' => $_SERVER['HTTP_CLIENT_IP'],
                    'HTTP_X_FORWARDED_FOR' => $_SERVER['HTTP_X_FORWARDED_FOR'],
                    'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
                    'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT']]
                                , $_POST), true) . PHP_EOL . '-------------' . PHP_EOL, 3, plugin_dir_path(__FILE__) . 'spamers.log');
        re_output_data_result_for_user(NULL, ['error' => 'Ошибка! Пожалуйста, обратитесь к менеджеру по телефону.'], false);
    }

    $error_fields = false;

    if (isset($_GET['re_action_form'])) {
        $action_form = re_form_check($_GET['re_action_form'], 'action_form');

        if (!$_GET['re_redirect_result_form']) {
            $email = re_form_check($_POST[$re_data['form']['name_fields']['email']], 'email');
            if (!EmailChecker::isLooksCorrect($email)) {
                $checker = new EmailChecker($email);
                $email = $checker->tryFix();
            }
            $name = re_form_check($_POST[$re_data['form']['name_fields']['name']], 'name');
            $tel = re_form_check($_POST[$re_data['form']['name_fields']['tel']], 'tel');

            $subject = re_form_check($_POST[$re_data['form']['name_fields']['subject']], 'other_input_text');
            $comment = re_form_check($_POST[$re_data['form']['name_fields']['comment']], 'text');
            $files = re_form_check($_POST['files'], 'id_files'); // Возвращает уже ссылки на существующие файлы

            switch ($action_form) {
                case 'online-pomoshh':
                    $duration = re_form_check($_POST[$re_data['form']['name_fields']['duration']], 'other_input_text');
                    $date_and_time = re_form_check($_POST[$re_data['form']['name_fields']['date_and_time']], 'date_and_time');
                    $number_task = re_form_check($_POST[$re_data['form']['name_fields']['number_task']], 'other_input_text');

                    if ($name && $email && $subject && $duration && $number_task && $date_and_time['date'] && $date_and_time['time']) {
                        $data_send_json = array_merge($data_send_json, array(
                            'type' => 6,
                            'user_name' => $name,
                            'user_email' => $email,
                            'user_phone' => $tel,
                            'comments' => $comment,
                            'duration' => $duration,
                            'name' => 'Онлайн помощь.' . ' ' . $subject,
                            'subject' => $subject,
                            'date' => $date_and_time['date'], //ток для онл помощи
                            'time_start' => $date_and_time['time'],
                            'tests_count' => $number_task,
                                ), $files['post']);
                    } else {
                        $error_fields = true;
                    }

                    break;
                case 'reshenie-zadach':
                    $date = re_form_check($_POST[$re_data['form']['name_fields']['date']], 'date');

                    if ($name && $email && $date && $subject) {
                        $data_send_json = array_merge($data_send_json, array(
                            'type' => 2,
                            'user_name' => $name,
                            'user_email' => $email,
                            'user_phone' => $tel,
                            'comments' => $comment,
                            'name' => 'Решение задач.' . ' ' . $subject,
                            'subject' => $subject,
                            'date2' => $date,
                                ), $files['post']);
                    } else {
                        $error_fields = true;
                    }

                    break;
                case 'kontrolnye-raboty':
                    $date = re_form_check($_POST[$re_data['form']['name_fields']['date']], 'date');

                    if ($name && $email && $date && $subject) {
                        $data_send_json = array_merge($data_send_json, array(
                            'type' => 1,
                            'user_name' => $name,
                            'user_email' => $email,
                            'user_phone' => $tel,
                            'comments' => $comment,
                            'name' => 'Контрольная.' . ' ' . $subject,
                            'subject' => $subject,
                            'date2' => $date,
                                ), $files['post']);
                    } else {
                        $error_fields = true;
                    }

                    break;
                case 'kursovye-raboty':
                    $date = re_form_check($_POST[$re_data['form']['name_fields']['date']], 'date');

                    $title = re_form_check($_POST[$re_data['form']['name_fields']['title']], 'other_input_text');
                    $number_start = (int) $_POST[$re_data['form']['name_fields']['number_start']];
                    $number_end = (int) $_POST[$re_data['form']['name_fields']['number_end']];
                    $unical_procent = (int) $_POST[$re_data['form']['name_fields']['unical_procent']];
                    $site_unical = re_form_check($_POST[$re_data['form']['name_fields']['site_unical']], 'other_input_text');

                    if ($name && $email && $date && $subject) {
                        $data_send_json = array_merge($data_send_json, array(
                            'type' => 3,
                            'user_name' => $name,
                            'user_email' => $email,
                            'user_phone' => $tel,
                            'comments' => $comment,
                            'name' => 'Курсовая. ' . $title,
                            'subject' => $subject,
                            'pages_start' => $number_start,
                            'pages_end' => $number_end,
                            'unique_persent' => $unical_procent,
                            'unique_tester' => $site_unical,
                            'date2' => $date,
                                ), $files['post']);
                    } else {
                        $error_fields = true;
                    }

                    break;
                case 'diploms':
                    $date = re_form_check($_POST[$re_data['form']['name_fields']['date']], 'date');

                    $title = re_form_check($_POST[$re_data['form']['name_fields']['title']], 'other_input_text');
                    $number_start = (int) $_POST[$re_data['form']['name_fields']['number_start']];
                    $number_end = (int) $_POST[$re_data['form']['name_fields']['number_end']];
                    $unical_procent = (int) $_POST[$re_data['form']['name_fields']['unical_procent']];
                    $site_unical = re_form_check($_POST[$re_data['form']['name_fields']['site_unical']], 'other_input_text');

                    if ($name && $email && $date && $subject) {
                        $data_send_json = array_merge($data_send_json, array(
                            'type' => 4,
                            'user_name' => $name,
                            'user_email' => $email,
                            'user_phone' => $tel,
                            'comments' => $comment,
                            'name' => 'Диплом. ' . $title,
                            'subject' => $subject,
                            'pages_start' => $number_start,
                            'pages_end' => $number_end,
                            'unique_persent' => $unical_procent,
                            'unique_tester' => $site_unical,
                            'date2' => $date,
                                ), $files['post']);
                    } else {
                        $error_fields = true;
                    }

                    break;
                case 'referats':
                    $date = re_form_check($_POST[$re_data['form']['name_fields']['date']], 'date');

                    $title = re_form_check($_POST[$re_data['form']['name_fields']['title']], 'other_input_text');
                    $number_start = (int) $_POST[$re_data['form']['name_fields']['number_start']];
                    $number_end = (int) $_POST[$re_data['form']['name_fields']['number_end']];
                    $unical_procent = (int) $_POST[$re_data['form']['name_fields']['unical_procent']];
                    $site_unical = re_form_check($_POST[$re_data['form']['name_fields']['site_unical']], 'other_input_text');

                    if ($name && $email && $date && $subject) {
                        $data_send_json = array_merge($data_send_json, array(
                            'type' => 5,
                            'user_name' => $name,
                            'user_email' => $email,
                            'user_phone' => $tel,
                            'comments' => $comment,
                            'name' => 'Реферат. ' . $title,
                            'subject' => $subject,
                            'pages_start' => $number_start,
                            'pages_end' => $number_end,
                            'unique_persent' => $unical_procent,
                            'unique_tester' => $site_unical,
                            'date2' => $date,
                                ), $files['post']);
                    } else {
                        $error_fields = true;
                    }

                    break;
                case 'essay':
                    $date = re_form_check($_POST[$re_data['form']['name_fields']['date']], 'date');

                    $title = re_form_check($_POST[$re_data['form']['name_fields']['title']], 'other_input_text');
                    $number_start = (int) $_POST[$re_data['form']['name_fields']['number_start']];
                    $number_end = (int) $_POST[$re_data['form']['name_fields']['number_end']];
                    $unical_procent = (int) $_POST[$re_data['form']['name_fields']['unical_procent']];
                    $site_unical = re_form_check($_POST[$re_data['form']['name_fields']['site_unical']], 'other_input_text');

                    if ($name && $email && $date && $subject) {
                        $data_send_json = array_merge($data_send_json, array(
                            'type' => 10,
                            'user_name' => $name,
                            'user_email' => $email,
                            'user_phone' => $tel,
                            'comments' => $comment,
                            'name' => 'Эссе. ' . $title,
                            'subject' => $subject,
                            'pages_start' => $number_start,
                            'pages_end' => $number_end,
                            'unique_persent' => $unical_procent,
                            'unique_tester' => $site_unical,
                            'date2' => $date,
                                ), $files['post']);
                    } else {
                        $error_fields = true;
                    }

                    break;
                case 'otchety-po-praktike':
                    $date = re_form_check($_POST[$re_data['form']['name_fields']['date']], 'date');

                    $title = re_form_check($_POST[$re_data['form']['name_fields']['title']], 'other_input_text');
                    $number_start = (int) $_POST[$re_data['form']['name_fields']['number_start']];
                    $number_end = (int) $_POST[$re_data['form']['name_fields']['number_end']];
                    $unical_procent = (int) $_POST[$re_data['form']['name_fields']['unical_procent']];
                    $site_unical = re_form_check($_POST[$re_data['form']['name_fields']['site_unical']], 'other_input_text');

                    if ($name && $email && $date && $subject) {
                        $data_send_json = array_merge($data_send_json, array(
                            'type' => 11,
                            'user_name' => $name,
                            'user_email' => $email,
                            'user_phone' => $tel,
                            'comments' => $comment,
                            'name' => 'Отчет по практике. ' . $title,
                            'subject' => $subject,
                            'pages_start' => $number_start,
                            'pages_end' => $number_end,
                            'unique_persent' => $unical_procent,
                            'unique_tester' => $site_unical,
                            'date2' => $date,
                                ), $files['post']);
                    } else {
                        $error_fields = true;
                    }

                    break;
                case 'presentations':
                    $date = re_form_check($_POST[$re_data['form']['name_fields']['date']], 'date');

                    $title = re_form_check($_POST[$re_data['form']['name_fields']['title']], 'other_input_text');
                    $number_start = (int) $_POST[$re_data['form']['name_fields']['number_start']];
                    $number_end = (int) $_POST[$re_data['form']['name_fields']['number_end']];

                    if ($name && $email && $date && $subject) {
                        $data_send_json = array_merge($data_send_json, array(
                            'type' => 9,
                            'user_name' => $name,
                            'user_email' => $email,
                            'user_phone' => $tel,
                            'comments' => $comment,
                            'name' => 'Презентация. ' . $title,
                            'subject' => $subject,
                            'pages_start' => $number_start,
                            'pages_end' => $number_end,
                            'date2' => $date,
                                ), $files['post']);
                    } else {
                        $error_fields = true;
                    }

                    break;
                case 'choose_type':
                    $type_form = (int) $_POST[$re_data['form']['name_fields']['select_type']];
                    $title = re_form_check($_POST[$re_data['form']['name_fields']['title']], 'other_input_text');

                    $duration = re_form_check($_POST[$re_data['form']['name_fields']['duration']], 'other_input_text');
                    if ($duration) {
                        $data_send_json['duration'] = $duration;
                    }

                    $date_and_time = re_form_check($_POST[$re_data['form']['name_fields']['date_and_time']], 'date_and_time');
                    if ($date_and_time) {
                        $data_send_json['date'] = $date_and_time['date'];
                        $data_send_json['time_start'] = $date_and_time['time'];
                    } else {
                        $date = re_form_check($_POST[$re_data['form']['name_fields']['date']], 'date');
                        $data_send_json['date2'] = $date;
                    }

                    $number_task = re_form_check($_POST[$re_data['form']['name_fields']['number_task']], 'other_input_text');
                    if ($number_task) {
                        $data_send_json['tests_count'] = $number_task;
                    }

                    $number_start = (int) $_POST[$re_data['form']['name_fields']['number_start']];
                    if ($number_start) {
                        $data_send_json['pages_start'] = $number_start;
                    }
                    $number_end = (int) $_POST[$re_data['form']['name_fields']['number_end']];
                    if ($number_end) {
                        $data_send_json['pages_end'] = $number_end;
                    }
                    $unical_procent = (int) $_POST[$re_data['form']['name_fields']['unical_procent']];
                    if ($unical_procent) {
                        $data_send_json['unique_persent'] = $unical_procent;
                    }
                    $site_unical = re_form_check($_POST[$re_data['form']['name_fields']['site_unical']], 'other_input_text');
                    if ($site_unical) {
                        $data_send_json['unique_tester'] = $site_unical;
                    }

                    if ($type_form == 1) {
                        $data_send_json['name'] = 'Контрольная.' . ' ' . $title;
                    } elseif ($type_form == 2) {
                        $data_send_json['name'] = 'Решение задач.' . ' ' . $title;
                    } elseif ($type_form == 3) {
                        $data_send_json['name'] = 'Курсовая.' . ' ' . $title;
                    } elseif ($type_form == 4) {
                        $data_send_json['name'] = 'Диплом.' . ' ' . $title;
                    } elseif ($type_form == 5) {
                        $data_send_json['name'] = 'Реферат.' . ' ' . $title;
                    } elseif ($type_form == 6) {
                        $data_send_json['name'] = 'Онлайн помощь.' . ' ' . $title;
                    } elseif ($type_form == 10) {
                        $data_send_json['name'] = 'Эссе.' . ' ' . $title;
                    } elseif ($type_form == 11) {
                        $data_send_json['name'] = 'Отчет по практике.' . ' ' . $title;
                    } elseif ($type_form == 9) {
                        $data_send_json['name'] = 'Презентация.' . ' ' . $title;
                    } elseif ($type_form == 13) {
                        $data_send_json['name'] = 'Лабораторная.' . ' ' . $title;
                    } else {
                        $data_send_json['name'] = $title;
                    }

                    if ($name && $email && $subject && $type_form) {
                        $data_send_json = array_merge($data_send_json, array(
                            'type' => $type_form,
                            'user_name' => $name,
                            'user_email' => $email,
                            'user_phone' => $tel,
                            'comments' => $comment,
                            'subject' => $subject,
                                ), $files['post']);
                    } else {
                        $error_fields = true;
                    }

                    break;
                case 'perevody':
                    $translate_direction = explode('*', $subject, 2);
                    $date = re_form_check($_POST[$re_data['form']['name_fields']['date']], 'date');

                    if ($name && $email && $date && $translate_direction) {
                        $data_send_json = array_merge($data_send_json, array(
                            'type' => 12,
                            'user_name' => $name,
                            'user_email' => $email,
                            'user_phone' => $tel,
                            'comments' => $comment,
                            'name' => 'Перевод. ' . $translate_direction[1],
                            'translate_direction' => $translate_direction[0],
                            'date2' => $date,
                                ), $files['post']);
                    } else {
                        $error_fields = true;
                    }

                    break;
                case 'laboratornye':
                    $date = re_form_check($_POST[$re_data['form']['name_fields']['date']], 'date');

                    if ($name && $email && $date && $subject) {
                        $data_send_json = array_merge($data_send_json, array(
                            'type' => 13,
                            'user_name' => $name,
                            'user_email' => $email,
                            'user_phone' => $tel,
                            'comments' => $comment,
                            'name' => 'Лабораторная.' . ' ' . $subject,
                            'subject' => $subject,
                            'date2' => $date,
                        ), $files['post']);
                    } else {
                        $error_fields = true;
                    }
                    break;
            }

            if (!$error_fields) {
                $result = re_send_data_server($data_send_json, $files);
            } else {
                $result = '';
            }
            re_output_data_result_for_user($action_form, $result, $error_fields);
        }
    }
}

add_action('wp_ajax_re_processing_form', 're_processing_form');
add_action('wp_ajax_nopriv_re_processing_form', 're_processing_form');

/**
 * Отправка Json данных на сервер и получение результата
 */
function re_send_data_server($json_data, $files) {
    global $wpdb;

    $ch = curl_init(LINK_API_CREATE);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1); //ожидание ответа от сервера
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $result = curl_exec($ch);
    curl_close($ch);

    if ($result == true) {
        $result = json_decode($result);

        if ($result->error == 0 && isset($result->url)) {
            $return = $result;
            $wpdb->insert(RE_TABLE_ORDER, array(
                'id_order' => (int) $result->id,
                'url' => $result->url,
                'directory_files' => $files['name_order_dir']), array('%d', '%s')
            );

            foreach ($files['ids'] as $file_id) {
                $wpdb->update(RE_TABLE_FILES, array('id_order' => (int) $result->id), array('ID' => $file_id), array('%d'), array('%d')
                );
            }
        } else {
            $return = array('error' => $result->error_text);
        }
    } else {
        $return = array('error' => 'Сервер не отвечает, попробуйте позже.');
    }
    return $return;
}

/**
 * Отображение результата отправки формы для пользователя
 * @result          object|array|string   возвращаемые данные об ошибке или данные с url переадресацией
 * @error_fileds    boolean ошибка заполнения обязательных полей формы
 */
function re_output_data_result_for_user($action_form, $result, $error_fileds) {
    global $wpdb;

    if (is_object($result)) {
        $return['url'] = $result->url;
    } elseif ($error_fileds) {
        $return['error'] = 'Неверно заполнены поля.';
    } elseif (isset($result['error'])) {
        $return['error'] = $result['error'];
    }

    echo json_encode($return);
    exit;
}

/**
 * Проверка валидности данных формы
 * @return boolean, string, array
 * */
function re_form_check($data, $type) {
    global $wpdb;

    if (!is_array($data)) {
        $data = trim($data);
    }

    if ($type == 'name') {
        $data = preg_replace('/[^a-zа-я0-9-\s]/ui', '', mb_substr($data, 0, 40, 'UTF-8'));
    } elseif ($type == 'tel') {
        if (!preg_match('/^[a-zа-я0-9-+()\s]{0,30}+$/ui', $data)) {
            return false;
        }
    } elseif ($type == 'email') {
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
    } elseif ($type == 're_form_check') {
        $data = preg_replace('/[^a-zа-я0-9-()\s]/ui', '', mb_substr($data, 0, 40, 'UTF-8'));
    } elseif ($type == 'text') {
        $data = mb_substr($data, 0, 4096, 'UTF-8') . ( ( mb_strlen($data, 'UTF-8') > 4096 ) ? '...' : '' );
    } elseif ($type == 'other_input_text') {
        $data = mb_substr($data, 0, 240, 'UTF-8');
    } elseif ($type == 'id_files') {
        $array_files = array(
            'post' => array(),
            'ids' => array()
        );

        $files_dir = '';
        if (is_array($data)) {
            $i = 0;
            foreach ($data as $file) {
                $file_result = $wpdb->get_row('SELECT * FROM ' . RE_TABLE_FILES . ' WHERE id=' . absint($file));
                if ($file_result) {
                    if (!$files_dir) {
                        mkdir(FILES_PATH . $file_result->id);
                        $files_dir = $file_result->id;
                        $array_files['name_order_dir'] = $files_dir;
                    }

                    rename(FILES_PATH_TMP . $file_result->name, FILES_PATH . $files_dir . '/' . $file_result->name);
                    $array_files['post']['files[' . $i . ']'] = URL_FILES . $files_dir . '/' . $file_result->name;
                    $array_files['ids'][] = absint($file);
                    $i ++;
                }
            }
        }

        $data = $array_files;
    } elseif ($type == 'date_and_time') {
        if (!preg_match('/^[0-9]{1,2}.[0-9]{1,2}.[0-9]{4} [0-9]{2}:[0-9]{2}/', $data)) {
            return false;
        } else {
            $expl_result = explode(' ', $data);
            $data = array(
                'date' => $expl_result[0],
                'time' => $expl_result[1],
            );
        }
    } elseif ($type == 'date') {
        if (!preg_match('/^[0-9]{1,2}.[0-9]{1,2}.[0-9]{4}/', $data)) {
            return false;
        }
    }

    return $data;
}
