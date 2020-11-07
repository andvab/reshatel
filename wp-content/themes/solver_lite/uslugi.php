<?
/**
 * Template Name: Услуги
 *
 * @package WordPress
 * @subpackage Solver Lite
 * @since Solver Lite 1.0
 */
?>

<? get_header() ?>


<div class="main-services">
    <div class="container">
        <?
        if (have_rows('services')):
            while (have_rows('services')) : the_row();
                ?>

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

        <? endif; ?>
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

<?
get_footer();
