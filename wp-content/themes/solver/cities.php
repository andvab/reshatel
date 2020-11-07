<?
/**
 * Template Name: Города - список
 *
 * @package WordPress
 * @subpackage Solver
 * @since Solver 1.0
 */
?>

<? get_header() ?>
<div id="article" class="container">

    <div class="container">
        <div class="cities">
            <? while (have_rows('cities')) : the_row(); ?>
                <a href="<? the_sub_field('cities_link'); ?>" class="city-block" data-city="<? the_sub_field('cities_name') ?>">
                    <span class="city-block__text"><? the_sub_field('cities_text'); ?></span>
                </a>
            <? endwhile; ?>
        </div>
    </div>

</div>

<?
get_footer();
