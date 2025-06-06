<?
/**
 * Template Name: Дипломные работы
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
        <h2 class="general-form-header"><? the_field('h2'); ?></h2>
        <noindex>
            <?= do_shortcode('[reshatel_form name=diploms]'); ?>
        </noindex>
    </div>

    <div class="general-how-much container">
        <div class="general-title">сколько стоит наша помощь?</div>
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
            <div class="general-title">заказывай у нас!</div>
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

            <div class="general-title">Дипломные работы по специальностям</div>

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
            <div class="owl-carousel owl-theme lo-container" data-type="4">
                <div class="lo-load"></div>
            </div>
        </noindex>
    </div>

    <div class="general-middle container">
        <div class="general-title">дипломные работы</div>
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
            <div id="vk_comments"><div class="lo-load"></div></div>
        </noindex>
    </div>

</div>

<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "Помощь с дипломной работой",
        "image": "https://reshatel.org/wp-content/themes/solver/img/logo_markup.png",
        "description": "Помощь студентам с дипломными по всем направлениям. Низкие цены!",
        "offers": {
            "@type": "Offer",
            "url": "https://reshatel.org/diploms/",
            "priceCurrency": "RUB",
            "price": "5990"
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.6",
            "bestRating": "5",
            "worstRating": "1",
            "ratingCount": "121"
        }
    }
</script>

<?php get_footer(); ?>

