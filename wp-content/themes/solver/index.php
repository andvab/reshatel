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

    <div class="main-banner">
        <div class="container">
            <? $university = filter_input(INPUT_GET, 'u', FILTER_SANITIZE_STRING);
            if ($university):
                ?>
                <div class="main-banner__top">Курсовые, дипломы, рефераты для студентов <?= $university ?></div>
            <? else: ?>
                <div class="main-banner__top">Поможем справиться с любым заданием!</div>
<? endif; ?>
            <div class="main-banner__bottom">Консультации опытных специалистов</div>
            <a href="/uznat-stoimost/" rel="nofollow" class="banner-link mc-lk-order">Узнать стоимость</a>
        </div>
    </div>

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

                <div class="main-services-more">
                    <a href="/uslugi/">Показать все виды работ</a>
                </div>

<? endif; ?>

        </div>
    </div>

    <div class="main-take">
        <div class="container">
            <div class="main-take__title">заказывай у нас!</div>
<? while (have_rows('take')) : the_row(); ?>

                <div class="take-block">
                    <figure>
                        <img src="<? the_sub_field('take_image'); ?>" alt="icon" >
                    </figure>

                    <div class="text-part">
    <? the_sub_field('take_text'); ?>
                    </div>
                </div>

<? endwhile; ?>
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
                                <img src="<? the_sub_field('work_image'); ?>" alt="icon" >
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
