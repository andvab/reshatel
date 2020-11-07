<?
/**
 * Template Name: Лента заказов
 *
 * @package WordPress
 * @subpackage Solver Lite
 * @since Solver Lite 1.0
 */
$page = filter_input(INPUT_GET, 'r', FILTER_VALIDATE_INT, ['options' => ['default' => 1, 'min_range' => 1]]);
$type = filter_input(INPUT_GET, 'type', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$section = filter_input(INPUT_GET, 'section', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$category = filter_input(INPUT_GET, 'category', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$pattern = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);

$feed = do_shortcode("[rv_show_feed page=\"$page\" type=\"$type\" section=\"$section\" category=\"$category\" search =\"$pattern\"]");

get_header();
?>

<div id="article" class="container">
    <h1 class="rv-header"><? the_title() ?></h1>
    <?= $feed ?>
</div>

<? get_footer(); ?>
