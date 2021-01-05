<?
/**
 * Template Name: Заказ
 *
 * @package WordPress
 * @subpackage Solver
 * @since Solver 1.0
 */
//wp_head();
$order = do_shortcode('[rv_show_order]');
get_header();
?>

<div id="article" class="container">

    <?= $order ?>

</div>
<?
get_footer();
