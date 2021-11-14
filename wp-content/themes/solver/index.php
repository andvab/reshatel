<?
/**
 * Template Name: Главная
 *
 * @package WordPress
 * @subpackage Solver
 * @since Solver 1.0.0
 */
?>
<? get_header() ?>

<div id="main-content">

    <section class="main-banner">
        <div class="container">
            <h1 class="main-banner__top">Решатель - сервис помощи с выполнением студенческих работ</h1>
            <h2 class="main-banner__bottom">Консультируем и помогаем студентам</h2>
            <a href="/uznat-stoimost/" rel="nofollow" class="banner-link mc-lk-order">Узнать стоимость</a>
        </div>
    </section>

    <? while (have_rows('current_offer')) : the_row(); ?>
        <? if (get_sub_field('enabled')): ?>
            <div class="container main-offer">
                <style>
                    <? the_sub_field('style'); ?>
                </style>
                <div class="offer" style="background-image: url(<? esc_url(the_sub_field('image')); ?>)" <? if (!empty(get_sub_field('url'))): ?> onclick="window.location='<? the_sub_field('url') ?>'" <? endif ?>>
                    <div class="offer-text"><?= the_sub_field('text'); ?></div>
                </div>
            </div>
        <? endif; ?>
    <? endwhile; ?>

    <div class="main-services">
        <div class="container">
            <? if (have_rows('services')):
                while (have_rows('services')) : the_row(); ?>
                    <a href="<? the_sub_field('serv_link'); ?>" class="service-block">
                        <svg version="1.1" enable-background="new 0 0 78 90" preserveAspectRatio="xMinYMax meet"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                             y="0px" width="90px" height="78px" viewBox="0 0 55 68" xml:space="preserve">
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
            <? endif; ?>

        </div>
    </div>

    <div class="main-take">
        <div class="container">
            <div class="main-take__title">заказывай у нас!</div>
            <div class="main-take__items">
                <? while (have_rows('take')) : the_row(); ?>
                    <div class="take-block">
                        <figure class="take-figure">
                        </figure>
                        <div class="text-part">
                            <? the_sub_field('take_text'); ?>
                        </div>
                    </div>
                <? endwhile; ?>
            </div>
        </div>
    </div>

    <div class="main-work">
        <div class="container">
            <div class="main-work__title">как мы работаем</div>
            <div class="adaptive-slider">
                <div class="adaptive-slider-inner">
                    <? while (have_rows('work')) : the_row(); ?>
                        <div class="work-block">
                            <figure>
                                <img src="<? the_sub_field('work_image'); ?>" alt="icon">
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

        <div class="show-more">
            <div class="container ">
                <div class="general-middle">
                    <div class="general-title"><? the_title() ?></div>
                    <div class="general-block">
                        <?= get_post_field('post_content', $post->ID) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <? $numbers = get_field('numbers'); ?>
    <? if ($numbers): ?>
        <div class="main-numbers">
            <div class="container">
                <div class="main-numbers_title"><?= $numbers['title'] ?></div>
                <div class="main-numbers_subtitle"><?= $numbers['subtitle'] ?></div>
                <div class="main-numbers_items">
                    <? foreach ($numbers['items'] as $item): ?>
                        <div class="number-block">
                            <div class="number-block_value">
                                <?= $item['num'] ?>
                            </div>
                            <div class="number-block_text">
                                <?= $item['text'] ?>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
                <div class="button-box-center">
                    <a href="/uznat-stoimost/" rel="nofollow" class="main-numbers_btn mc-lk-order-bottom">Узнать стоимость</a>
                </div>
            </div>
        </div>
    <? endif; ?>

    <div class="main-reviews container">
        <noindex>
            <div class="article__title">Отзывы</div>
            <div id="vk_comments"><div class="lo-load"></div></div>
        </noindex>
    </div>

</div>

<? get_footer();
