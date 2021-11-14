<?
/**
 * Template Name: Город
 *
 * @package WordPress
 * @subpackage Solver
 * @since Solver 1.0.0
 */
?>
<?
add_filter('body_class', function( $classes ) {
    return array_merge($classes, ['home']);
});

get_header();

$main_id = get_option('page_on_front');
?>

<div id="main-content">

    <div class="main-banner">
        <div class="container">
            <h1 class="main-banner__top"><? the_title() ?></h1>
            <h2 class="main-banner__bottom">Консультации опытных специалистов</h2>
            <a href="https://lk.reshatel.org/help/new/" rel="nofollow" class="banner-link mc-lk-order">Узнать стоимость</a>
        </div>
    </div>

    <div class="main-services">
        <div class="container">
            <? while (have_rows('services', $main_id)) : the_row(); ?>

                <a href="<? the_sub_field('serv_link'); ?>" class="service-block">
                    <svg version="1.1" enable-background="new 0 0 78 90" preserveAspectRatio="xMinYMax meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="90px" height="78px" viewBox="0 0 55 68" xml:space="preserve">
                        <path fill="#b0b0b0" <? the_sub_field('serv_image'); ?>></path>
                    </svg>
                    <div class="text-part">
                        <div class="service-block__header"><? the_sub_field('serv_title'); ?></div>
                        <? the_sub_field('serv_text'); ?>
                    </div>
                </a>

            <? endwhile; ?>

            <div class="main-services-more">
                <a href="/uslugi/">Показать все виды работ</a>
            </div>

        </div>
    </div>

    <div class="city-text">
        <div class="city-text__bgr" data-city="<? the_field('city_data_name') ?>"></div>
        <div class="general-title city-text__title"><? the_field('city_central') ?></div>
        <div class="general-block city-text__content container"><?= get_post_field('post_content', $post->ID) ?></div>
    </div>

    <div class="main-work">
        <div class="container">
            <h2>как мы работаем</h2>
            <div class="adaptive-slider">
                <div class="adaptive-slider-inner">
                    <? while (have_rows('work', $main_id)) : the_row(); ?>

                        <div class="work-block">
                            <figure>
                                <img src="<? the_sub_field('work_image'); ?>" alt="icon" >
                            </figure>

                            <div class="text-part">
                                <div class="work-block__header"><? the_sub_field('work_title'); ?></div>
                                <? the_sub_field('work_text'); ?>
                            </div>
                        </div>

                    <? endwhile; ?>
                </div>
            </div>
            <ul class="caption">
                <li class="caption-11">1</li>
                <li class="caption-22">2</li>
                <li class="caption-33">3</li>
                <li class="caption-44">4</li>
                <li class="caption-55">5</li>
            </ul>        
        </div>
    </div>

    <div class="main-reviews container">
        <noindex>
            <div class="article__title">Отзывы</div>
            <div id="vk_comments"></div>
        </noindex>
    </div>

</div>


<?
get_footer();
