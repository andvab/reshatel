<?
/**
 * Template Name: Главная
 *
 * @package WordPress
 * @subpackage Solver Lite
 * @since Solver Lite 1.0.0
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
            <a href="https://lk.reshatel.org/help/new/" rel="nofollow" class="banner-link mc-lk-order">Узнать стоимость</a>
        </div>
    </div>

</div>


<?
get_footer();
