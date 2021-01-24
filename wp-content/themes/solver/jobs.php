<?
/**
 * Template Name: Вакансии
 *
 * @package WordPress
 * @subpackage Solver
 * @since Solver 1.0.1
 */
?>

<? get_header() ?>

<style>
    .grecaptcha-badge {
        display: block !important;
    }
</style>

<div id="content" class="container" style="margin-top: 20px">
    <div class="row">
        <div class="span12">
            <div class="article__title">Вакансия "Решатель"</div>
        </div>
    </div>
    <div class="row"><?= do_shortcode('[contact-form-7 id="985" title="Вакансии"]') ?></div>
    <div class="row">
        <div class="article">
            <div class="article__content"><? the_post(); the_content(); ?></div>                  
        </div>
    </div>

    <div class="main-reviews main-reviews_job container">
        <div class="article__title">Отзывы</div>
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?127"></script>
        <script type="text/javascript">
            VK.init({apiId: 6698753, onlyWidgets: true});
        </script>
        <div id="vk_comments"></div>
        <script type="text/javascript">
            VK.Widgets.Comments("vk_comments", {redesign: 0, limit: 3, mini: "1", width: "100%", attach: "*", pageUrl: "https://reshatel.org/jobs/"});
        </script>
    </div>

</div>

<? get_footer() ?>
