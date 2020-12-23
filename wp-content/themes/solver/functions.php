<?php

//error_reporting('E_ALL');
/**
 * Theme Support
 */
add_theme_support('post-thumbnails');
add_theme_support('menus');

// Подключение JS и CSS файлов
include ( dirname(__FILE__) . '/lib/enqueues.php' );

function do_excerpt($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if (count($words) > $word_limit)
        array_pop($words);
    echo implode(' ', $words) . ' …';
}

class Menu_Walker extends Walker_Nav_Menu {

    private $cssClassMenu;

    function __construct($cssClassMenu) {
        $this->cssClassMenu = $cssClassMenu;
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $item_url = esc_attr($item->url);
        $output .= sprintf('<li class="%s__item">', $this->cssClassMenu);
        $attrs = !empty($item->url) ? sprintf(' class="%s__item__link" href="%s"', $this->cssClassMenu, $item_url) : '';
        $current_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if ($item_url != $current_url)
            $item_output .= sprintf('<a %s>%s</a>', $attrs, $item->title);
        else
            $item_output .= sprintf('<span class="%s__item__current">%s</span>', $this->cssClassMenu, $item->title);

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id);
    }

}

/* Ссылка на логотипе */
add_filter('login_headerurl', create_function('', 'return get_home_url();'));

/* Убираем title в логотипе "сайт работает на wordpress" */
add_filter('login_headertitle', create_function('', 'return false;'));

/* Удаление атрибутов из метатегов */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
//add_filter('aioseop_prev_link', '__return_empty_string');
//add_filter('aioseop_next_link', '__return_empty_string');

// Отключаем сам REST API
//add_filter('rest_enabled', '__return_false');

// Отключаем фильтры REST API
//remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
//remove_action('wp_head', 'rest_output_link_wp_head', 10, 0);
//remove_action('template_redirect', 'rest_output_link_header', 11, 0);
//remove_action('auth_cookie_malformed', 'rest_cookie_collect_status');
//remove_action('auth_cookie_expired', 'rest_cookie_collect_status');
//remove_action('auth_cookie_bad_username', 'rest_cookie_collect_status');
//remove_action('auth_cookie_bad_hash', 'rest_cookie_collect_status');
//remove_action('auth_cookie_valid', 'rest_cookie_collect_status');
//remove_filter('rest_authentication_errors', 'rest_cookie_check_errors', 100);

// Отключаем события REST API
//remove_action('init', 'rest_api_init');
//remove_action('rest_api_init', 'rest_api_default_filters', 10, 1);
//remove_action('parse_request', 'rest_api_loaded');

// Отключаем Embeds связанные с REST API
//remove_action('rest_api_init', 'wp_oembed_register_route');
//remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);

// Отключаем вывод ссылок в header
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

/* Ссылка на первую картинку в посте */

function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];
    if (empty($first_img)) {
        $first_img = "/wp-content/uploads/2013/03/logo.png"; // Ссылка на изображение-заглушку, если в посте оно не найдено
    }
    return $first_img;
}

/* Функция хлебных крошек */

function the_breadcrumb() {
    echo '<div id="breadcrumb">
  <div itemscope="" itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs">
  <span class="crumbs" itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
      <a itemprop="item" title="Решатель" href="/">
         <span itemprop="name">Решатель</span>
         <meta itemprop="position" content="1">
      </a>
  </span><span> » </span>';
    if (!is_category() && !is_single()) {
        echo '<span class="crumbs">Статьи</span>';
    } elseif (is_category()) {
        echo '<span class="crumbs" itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
         <a itemprop="item" title="Статьи" href="/articles/">
         <span itemprop="name">Статьи</span>
         <meta itemprop="position" content="2">
         </a>
         </span>';

        $cats = get_the_category();
        $cat = $cats[0];
        echo '<span> » </span><span class="crumbs"  style="display:inline-block;">' . $cat->name . '</span>';
    } elseif (is_single()) {
        $cats = get_the_category();
        $cat = $cats[0];
        echo '<span class="crumbs" itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
       <a itemprop="item" title="' . $cat->name . '" href="..">
          <span itemprop="name">' . $cat->name . '</span>
          <meta itemprop="position" content="2">
       </a>
       </span><span> » </span>';

        echo '<span class="crumbs">' . get_the_title() . ' </span>';
    }
    echo "</div></div><div class=\"clear\"></div>";
}

add_action('init', 'show_order');

function show_order() {

    add_rewrite_rule(
            '^orders/[A-Za-z0-9-_]+/?$', 'index.php?page_id=7871', 'top'
    );
    
}

add_action('rest_api_init', function () {
    global $rv_object;
    register_rest_route('order', '/(?P<type>\d+)(/(?P<cat>\d+))?', [
        'methods' => 'GET',
        'callback' => [$rv_object, 'showLastOrdersJSON'],
    ]);
});

add_action("sm_buildmap", "ROV::buildSitemap");

function filter_aioseop_canonical_category($url) {
    return is_category() ? str_replace('/category', '', $url) : $url;
}

add_filter('aioseo_canonical_url', 'filter_aioseop_canonical_category', 10, 1);
