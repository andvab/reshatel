<?
/**
 * Template Name: Гарантии
 *
 * @package WordPress
 * @subpackage Solver
 * @since Solver 1.0
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
            <div id="vk_comments"><div class="lo-load"></div></div>
        </noindex>
    </div>

</div>

<? get_footer() ?>
