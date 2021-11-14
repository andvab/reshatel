<?
/**
 * Template Name: Чертеж
 *
 * @package WordPress
 * @subpackage Solver
 * @since Solver 1.0
 */
?>

<? get_header() ?>
<div id="article" class="container" style="margin-top:20px">
    <div class="row">
        <div class="span12">
            <h1 class="article__title"><? the_title() ?></h1>
        </div>
    </div>

    <div class="general-top row">
        <div class="outer-slider">
            <div class="inner-slider">
                <? if (have_rows('top_part')):
                    while (have_rows('top_part')) : the_row(); ?>
                        <div class="top-block span3">
                            <figure>
                                <img src="<? the_sub_field('top_image'); ?>" alt="icon">
                            </figure>
                            <div class="text-part">
                                <noindex>
                                    <? the_sub_field('top_text'); ?>
                                </noindex>
                            </div>
                        </div>
                    <? endwhile; ?>
                <? endif; ?>
            </div>
        </div>
        <ul class="caption">
            <li class="caption-1">1</li>
            <li class="caption-2">2</li>
            <li class="caption-3">3</li>
        </ul>
    </div>

    <div class="general-form container">
        <h2 class="general-form-header"><? the_field('h2'); ?></h2>
        <noindex>
            <?= do_shortcode('[reshatel_form name=drawing]'); ?>
        </noindex>
    </div>

    <div class="general-how-much container">
        <div class="general-title">сколько стоит выполнить чертеж?</div>
        <? if (have_rows('how_part')):
            while (have_rows('how_part')) : the_row(); ?>
                <div class="how-block">
                    <figure>
                        <img src="<? the_sub_field('how_image'); ?>" alt="icon">
                    </figure>
                    <div class="text-part">
                        <noindex>
                            <? the_sub_field('how_text'); ?>
                        </noindex>
                    </div>
                </div>
            <? endwhile; ?>
        <? endif; ?>
    </div>

    <div class="general-take container">
        <noindex>
            <div class="general-title">заказывай у нас!</div>
            <? if (have_rows('us')):
                while (have_rows('us')) : the_row(); ?>
                    <div class="us-block">
                        <figure>
                            <img src="<? the_sub_field('us_image'); ?>" alt="icon">
                        </figure>

                        <div class="text-part">
                            <? the_sub_field('us_text'); ?>
                        </div>
                    </div>
                <? endwhile; ?>
            <? endif; ?>
        </noindex>
    </div>

    <div class="last-orders container">
        <noindex>
            <div class="general-title">Последние работы</div>
            <div class="lo-load"></div>
            <div class="owl-carousel owl-theme lo-container" data-type="15">
            </div>
        </noindex>
    </div>

    <div class="general-middle container">
        <div class="general-title">Чертежи</div>
        <div class="general-block">
            <? the_field('mid'); ?>
        </div>

    </div>

    <div class="general-qa container">
        <noindex>
            <div class="general-title">Вопрос - ответ</div>
            <div class="general-qa-block">
                <? the_field('qa'); ?>
            </div>
        </noindex>
    </div>

    <div class="general-pay container">
        <noindex>
            <div class="general-title">Способы оплаты</div>
        </noindex>
        <div class="general-pay-block">
            <? if (have_rows('pay')):
                while (have_rows('pay')) : the_row(); ?>
                    <figure>
                        <img src="<? the_sub_field('pay_image'); ?>" alt="icon">
                        <img src="<? the_sub_field('pay_image2'); ?>" alt="icon">
                    </figure>
                <? endwhile; ?>
            <? endif; ?>
        </div>
    </div>

    <div class="main-reviews container">
        <noindex>
            <div class="article__title">Отзывы</div>
            <div id="vk_comments"></div>
        </noindex>
    </div>

</div>

<? get_footer(); ?>
