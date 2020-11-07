<?
/**
 * Template Name: Дочерняя посадочная страница
 *
 * @package WordPress
 * @subpackage Solver Lite
 * @since Solver Lite 1.0
 */
?>

<?
get_header();

$parent_id = get_post_ancestors($post->ID)[0];
$parent_slug = get_post_field('post_name', $parent_id);
?>

<div id="article" class="container">

    <div class="row">
        <div class="span12">
            <h1 class="article__title"><? the_title() ?></h1>       
        </div>    
    </div>

    <div class="general-top row">
        <div class="outer-slider">
            <div class="inner-slider">
                <? while (have_rows('top_part', $parent_id)) : the_row(); ?>
                    <div class="top-block span3">
                        <figure>
                            <img src="<? the_sub_field('top_image'); ?>" alt="icon" >
                        </figure>
                        <div class="text-part">
                            <noindex>
                                <? the_sub_field('top_text'); ?>
                            </noindex>
                        </div>
                    </div>
                <? endwhile; ?>
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
            <?= do_shortcode("[reshatel_form name=$parent_slug]"); ?>
        </noindex>
    </div>

    <div class="general-how-much container">
        <div class="general-title"><? the_field('landing_how_much'); ?></div>
        <? while (have_rows('how_part', $parent_id)) : the_row(); ?>
            <div class="how-block">
                <figure>
                    <img src="<? the_sub_field('how_image'); ?>" alt="icon" >
                </figure>
                <div class="text-part">
                    <noindex>
                        <? the_sub_field('how_text'); ?>
                    </noindex>
                </div>
            </div>
        <? endwhile; ?>
    </div> 

    <div class="general-take container">
        <noindex>
            <div class="general-title"><? the_field('landing_advantage'); ?></div>
            <? while (have_rows('us', $parent_id)) : the_row(); ?>
                <div class="us-block">
                    <figure>
                        <img src="<? the_sub_field('us_image'); ?>" alt="icon" >
                    </figure>
                    <div class="text-part">
                        <? the_sub_field('us_text'); ?>
                    </div>
                </div>
            <? endwhile; ?>
        </noindex>
    </div>

    <? if (get_field('landing_type_id')): ?>
        <div class="last-orders container">
            <noindex>
                <div class="general-title"><?= get_field('landing_last_orders') ?: 'Последние работы' ?></div>
                <div class="owl-carousel owl-theme lo-container" data-type="<? the_field('landing_type_id') ?>" data-cat="<? the_field('landing_cat_id') ?>">
                    <div class="lo-load"></div>
                </div>
            </noindex>
        </div>
    <? endif; ?>

    <div class="general-middle container">
        <div class="general-title"><? the_field('landing_central'); ?></div>
        <div class="general-block">
            <?= get_post_field('post_content', $post->ID) ?>
        </div>
    </div>
    <? if (have_rows('articles')): ?>
        <div class="general-prob general-prob_landing container">
            <div class="general-title"><? the_field('landing_articles'); ?></div>
            <? while (have_rows('articles')) : the_row(); ?>
                <a class="prob-block" href="<? the_sub_field('articles_link'); ?>">
                    <figure style="background-image: url(<? the_sub_field('articles_image'); ?>);">
                    </figure>
                    <div class="text-part">
                        <? the_sub_field('articles_text'); ?>
                    </div>
                </a>
            <? endwhile; ?>
        </div>
    <? endif; ?>

    <div class="general-qa container">
        <noindex>
            <div class="general-title">Вопрос - ответ</div>
            <div class="general-qa-block">
                <? the_field('qa', $parent_id); ?>
            </div>
        </noindex>
    </div>

    <div class="general-pay container">
        <noindex>
            <div class="general-title">Способы оплаты</div>
        </noindex>
        <div class="general-pay-block">
            <? while (have_rows('pay', $parent_id)) : the_row(); ?>
                <figure>
                    <img src="<? the_sub_field('pay_image'); ?>" alt="icon" >
                    <img src="<? the_sub_field('pay_image2'); ?>" alt="icon" >
                </figure>
            <? endwhile; ?>
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

<?
get_footer();
