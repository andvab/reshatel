<?php

/**
 * Подключение стилей и скриптов для front-end
 */
function so_enqueues() {

    $template_uri = get_template_directory_uri();

    wp_register_style('so-default-css', $template_uri . '/css/default.css', false, '1.1.2', null);
    wp_enqueue_style('so-default-css');

    wp_register_style('so-forms-css', $template_uri . '/css/forms.css', false, '1.1.1', null);
    wp_enqueue_style('so-forms-css');

    wp_register_style('so-adaptive-css', $template_uri . '/css/adaptive.css', false, '1.1.1', null);
    wp_enqueue_style('so-adaptive-css');

    wp_register_style('so-price-css', $template_uri . '/css/price.css', false, '1.0.0', null);
    wp_enqueue_style('so-price-css');

    wp_register_style('so-recient-orders', $template_uri . '/css/recient-orders.css', false, '1.0.0', null);
    wp_enqueue_style('so-recient-orders');

    wp_register_style('hg-font-OpenSans', 'https://fonts.googleapis.com/css?family=PT+Sans:400,700|Open+Sans:400,700&display=swap&subset=cyrillic-ext', false, '0.2', null);
    wp_enqueue_style('hg-font-OpenSans');
    wp_enqueue_style('dashicons');

    wp_register_script('so-jquery.mobile.custom.min-js', $template_uri . '/js/jquery.mobile.custom.min.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('so-jquery.mobile.custom.min-js');

    wp_register_script('so-jquery.touchSwipe.min-js', $template_uri . '/js/jquery.touchSwipe.min.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('so-jquery.touchSwipe.min-js');

    wp_register_script('rv-readmore-js', $template_uri . '/../../plugins/reshatel-order-viewer/js/readmore.min.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('rv-readmore-js');

    wp_register_script('so-main-js', $template_uri . '/js/main.js', ['jquery', 'rv-readmore-js'], '1.0.0', true);
    wp_enqueue_script('so-main-js');

    wp_register_script('so-adaptive-js', $template_uri . '/js/adaptive.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('so-adaptive-js');

    wp_register_script('so-jquery.maskedinput.min-js', $template_uri . '/js/jquery.maskedinput.min.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('so-jquery.maskedinput.min-js');

    wp_register_script('owl-carousel-js', $template_uri . '/js/owl-carousel/owl.carousel.min.js', ['jquery'], '2.3.4', true);
    wp_enqueue_script('owl-carousel-js');
}

add_action('wp_enqueue_scripts', 'so_enqueues', 101);

