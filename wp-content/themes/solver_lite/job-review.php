<?
/**
 * Template Name: Отзывы авторов
 *
 * @package WordPress
 * @subpackage Solver Lite
 * @since Solver Lite 1.0.1
 */
?>

<? get_header() ?>

<div id="content" class="container" style="margin-top: 20px">
    <div class="main-reviews container">
        <noindex>
            <div class="article__title">Отзывы о сотрудничестве с "Решателем"</div>
            <script type="text/javascript" src="//vk.com/js/api/openapi.js?127"></script>
            <script type="text/javascript">
                VK.init({apiId: 6698753, onlyWidgets: true});
            </script>
            <div id="vk_comments"></div>
            <script type="text/javascript">
                VK.Widgets.Comments("vk_comments", {redesign: 0, limit: 3, mini: "1", width: "100%", attach: "*", pageUrl: "https://reshatel.org/jobs/"});
            </script>
        </noindex>
    </div>
</div>

<? get_footer() ?>
