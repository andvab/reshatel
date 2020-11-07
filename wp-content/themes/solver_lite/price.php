<?
/**
 * Template Name: Цены
 *
 * @package WordPress
 * @subpackage Solver Lite
 * @since Solver Lite 1.0
 */
?>

<? get_header() ?>

<div id="content" class="container">
    <section class="article">
        <h1 class="article__title"><? the_title() ?> и сроки</h1>
        <div class="article__content">
            <? the_post(); ?>

            <div class="pricelist">

                <? while (have_rows('price')) : the_row(); ?>

                    <a href="<? the_sub_field('url'); ?>" class="pricelist__row">
                        <div class="pricelist__title">
                            <div class="pricelist__icon">
                                <svg version="1.1" enable-background="new 0 0 78 90" preserveAspectRatio="xMinYMax meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 55 68" xml:space="preserve">
                                    <path fill="#b0b0b0" <? the_sub_field('icon'); ?>></path>
                                </svg>
                            </div>
                            <div class="pricelist__name"><? the_sub_field('name'); ?></div>
                        </div>
                        <div class="pricelist__sum"><span class="pricelist__hits">Цена </span><? the_sub_field('sum'); ?> &#8381;</div>
                        <div class="pricelist__time"><span class="pricelist__hits">Срок </span><? the_sub_field('time'); ?></div>

                    </a>

                <?php endwhile; ?>

            </div>
        </div>
    </section>

    <section class="general-pay container">
        <h2>Способы оплаты</h2>
        <div class="general-pay-block">
            <? while (have_rows('pay')) : the_row(); ?>
                <figure>
                    <img src="<?php the_sub_field('pay_image'); ?>" alt="icon" >
                        <img src="<?php the_sub_field('pay_image2'); ?>" alt="icon" >
                            </figure>
            <? endwhile; ?>
        </div>
    </section>
</div>

<? get_footer();
