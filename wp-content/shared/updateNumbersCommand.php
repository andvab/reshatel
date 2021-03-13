<?php
require __DIR__ . '/../../wp-load.php';

$numbers = request('https://vm273226.had.su/get_numbers', 'api_key=test', ["cache-control: no-cache", "content-type: application/x-www-form-urlencoded"]);

if (isset($numbers->error)) {
    error_log(date("d.m.Y H:i:s") . ': ' . $numbers->error . PHP_EOL, 3, __DIR__ . '/updateNumbersCommand.log');
    return;
}

$mainPageId = 5575;

$numbersField = get_field('numbers', $mainPageId);

$numbersField['items'][0]['num'] = $numbers->age;
$numbersField['items'][1]['num'] = number_format($numbers->orders, 0, '', ' ');
$numbersField['items'][2]['num'] = number_format($numbers->users, 0, '', ' ');
$numbersField['items'][3]['num'] = "{$numbers->grade}  <span>из 5</span>";

update_field('numbers', $numbersField, $mainPageId);

if (function_exists('wp_cache_clean_cache')) {
    wpsc_delete_post_cache($mainPageId);
}

function request($url, $fields, $header = [])
{
    $ch = curl_init($url);

    $options = [
        CURLOPT_HTTPHEADER => $header,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 30,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $fields
    ];

    curl_setopt_array($ch, $options);

    $data = json_decode(curl_exec($ch));

    curl_close($ch);

    return $data;
}
