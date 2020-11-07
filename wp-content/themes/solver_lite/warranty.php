<?
/**
 * Template Name: Гарантии
 *
 * @package WordPress
 * @subpackage Solver Lite
 * @since Solver Lite 1.0
 */
?>

<? get_header() ?>

<div id="content" class="container" style="margin-top: 20px">
    <div class="row">
        <div class="article">
            <h1 class="article__title"><? the_title() ?></h1>	
            <div class="article__content">
                <? the_post(); ?>
                <? the_content(); ?>
            </div>
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

<? get_footer() ?>
