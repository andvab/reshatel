<?
/**
 * Template Name: Презентации
 *
 * @package WordPress
 * @subpackage Solver Lite
 * @since Solver Lite 1.0
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
                <?php
                if (have_rows('top_part')):
                    while (have_rows('top_part')) : the_row();
                        ?>

                        <div class="top-block span3">
                            <figure>
                                <img src="<?php the_sub_field('top_image'); ?>" alt="icon" >
                            </figure>

                            <div class="text-part">
                                <noindex>
                                    <?php the_sub_field('top_text'); ?>
                                </noindex>
                            </div>
                        </div>



                    <?php endwhile; ?>

                <?php endif; ?>
            </div>
        </div>       
        <ul class="caption">
            <li class="caption-1">1</li>
            <li class="caption-2">2</li>
            <li class="caption-3">3</li>
        </ul>        
    </div>

    <div class="general-form container">
        <noindex>
            <?= do_shortcode('[reshatel_form name=presentations]'); ?>
        </noindex>
    </div>

    <div class="general-how-much container">
        <div class="general-title">Сколько стоит презентация?</div>
        <?php
        if (have_rows('how_part')):
            while (have_rows('how_part')) : the_row();
                ?>

                <div class="how-block">
                    <figure>
                        <img src="<?php the_sub_field('how_image'); ?>" alt="icon" >
                    </figure>

                    <div class="text-part">
                        <noindex>
                            <?php the_sub_field('how_text'); ?>
                        </noindex>
                    </div>
                </div>



            <?php endwhile; ?>

        <?php endif; ?>
    </div> 

    <div class="general-take container">
        <noindex>
            <div class="general-title">заказывай у нас !</div>
            <?php
            if (have_rows('us')):
                while (have_rows('us')) : the_row();
                    ?>

                    <div class="us-block">
                        <figure>
                            <img src="<?php the_sub_field('us_image'); ?>" alt="icon" >
                        </figure>

                        <div class="text-part">

                            <?php the_sub_field('us_text'); ?>
                        </div>
                    </div>

                <?php endwhile; ?>

            <?php endif; ?>
        </noindex>
    </div>

    <div class="general-prob container">
        <?php if (have_rows('how_prob')): ?>
            <div class="general-title">Какие презентации мы выполняем?</div>
            <?
            while (have_rows('how_prob')) : the_row();
                ?>

                <a class="prob-block" href="<?php the_sub_field('prob_link'); ?>">
                    <figure style="background-image: url(<?php the_sub_field('prob_image'); ?>);">
                    </figure>
                    <div class="text-part">
                        <?php the_sub_field('prob_text'); ?>
                    </div>
                </a>

            <?php endwhile; ?>

        <?php endif; ?>
    </div> 

    <div class="last-orders container">
        <noindex>
            <div class="general-title">Последние работы</div>
            <div class="owl-carousel owl-theme lo-container" data-type="9">
                <div class="lo-load"></div>
            </div>
        </noindex>
    </div>

    <div class="general-middle container">
        <div class="general-title">презентации</div>
        <div class="general-block">
            <?php the_field('mid'); ?>
        </div>

    </div>  

    <div class="general-qa container">
        <noindex>
            <div class="general-title">Вопрос - ответ</div>
            <div class="general-qa-block">
                <?php the_field('qa'); ?>
            </div>
        </noindex>
    </div>

    <div class="general-pay container">
        <noindex>
            <div class="general-title">Способы оплаты</div>
        </noindex>
        <div class="general-pay-block">
            <?php
            if (have_rows('pay')):
                while (have_rows('pay')) : the_row();
                    ?>
                    <figure>
                        <img src="<?php the_sub_field('pay_image'); ?>" alt="icon" >
                        <img src="<?php the_sub_field('pay_image2'); ?>" alt="icon" >
                    </figure>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="main-reviews container">
        <noindex>
            <div class="article__title">Отзывы</div>
            <script type="text/javascript" src="//vk.com/js/api/openapi.js?127"></script>
            <script type="text/javascript">
                VK.init({apiId: 3543059, onlyWidgets: true});
            </script>
            <div id="vk_comments"></div>
            <script type="text/javascript">
                VK.Widgets.Comments("vk_comments", {redesign: 0, limit: 3, mini: "1", width: "100%", attach: "*", pageUrl: "http://reshatel.org/garantii/"});
            </script>
        </noindex>
    </div>

</div>

<?php get_footer(); ?>

