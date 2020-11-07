<?php

//define('SHORTINIT', true);

require __DIR__ . '/../../../wp-load.php';

$rv_config = json_decode(file_get_contents(__DIR__ . '/config.json'));

$keys = (getopt('', ['update']));
if (isset($keys['update'])) {
    get_new_orders();
}

function get_new_orders() {
    global $wpdb, $rv_config;

    $last_date = $wpdb->get_var('SELECT max(date_finished) FROM ' . $rv_config->db->order) ?: '2000-01-01 00:00:00';

    $i = 0;
    $max = 1000;
    do {
        $result = api_request('orders', [
            'key' => $rv_config->api->key,
            'since_finish_date' => $last_date,
            'status' => [7, 4],
            'limit' => 1000,
            'offset' => $i++ * $max
        ]);

        if ($result->error == 1) {
            echo "{$result->error_text}\n";
            return;
        }

        save_new_orders($result->orders);
    } while (count($result->orders) >= $max);
    
    wpsc_delete_post_cache(7870);
}

function save_new_orders($orders) {
    global $wpdb, $rv_config;

    foreach ($orders as $order) {
        $order->page_name = create_page_name($order);
        unset($files_users, $files_done, $order->status_id, $order->date_deadline);

        if (!$order->category_id) {
            $order->category_id = 37; // Другие
        }
        if (isset($order->files_users)) {
            $files_users = $order->files_users;
            unset($order->files_users);
        }
        if (isset($order->files_done)) {
            $files_done = $order->files_done;
            unset($order->files_done);
        }

        $wpdb->insert($rv_config->db->order, (array) $order);

        if ($files_users) {
            foreach ($files_users as $file) {
                $file->order_id = $order->id;
                $file->url = $rv_config->domain . $file->url;
                $wpdb->insert($rv_config->db->file, (array) $file);
            }
        }
        if ($files_done) {
            foreach ($files_done as $file) {
                $file->order_id = $order->id;
                $file->url = $rv_config->domain . $file->url;
                $file->is_done = 1;
                $wpdb->insert($rv_config->db->file, (array) $file);
            }
        }
    }
}

function create_page_name($order) {
    global $wpdb, $rv_config;

    $iso9_table = [
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G',
        'Ґ' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
        'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J',
        'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K',
        'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
        'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '',
        'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
        'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
        'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j',
        'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k',
        'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
        'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '',
        'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
    ];

    $s = strip_tags($order->name); // убираем HTML-теги
    $s = str_replace(["\n", "\r"], " ", $s); // убираем перевод каретки
    $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
    $s = strtr($s, $iso9_table);
    $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
    $s = trim($s); // убираем пробелы в начале и конце строки
    $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
    $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
    $s = substr($s, 0, 100); // обрезаем слишком длинные названия

    $is_already_exists = (bool) $wpdb->get_row($wpdb->prepare("SELECT id FROM {$rv_config->db->order} WHERE `page_name` LIKE '%s'", $s));

    return $is_already_exists ? $s . "-$order->id" : $s;
}

function api_request($method, $params) {
    global $rv_config;

    $ch = curl_init($rv_config->api->url . $method . '/?' . http_build_query($params));

    $options = [
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HEADER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 30
    ];

    curl_setopt_array($ch, $options);

    $data = json_decode(curl_exec($ch));

    curl_close($ch);

    return $data;
}
