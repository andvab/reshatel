<?php
/**
 * @package WordPress
 * @subpackage Solver
 * @since Solver 1.1
 */
get_header();
have_posts();
the_post();
?>

<div id="articles" class="container" style="margin-top: 20px">
    <div class="row">
        <div class="span8">
            <?php the_breadcrumb(); ?>
            <h1 class="post-title"><?php the_title() ?></h1>
            <div class="post-content">
                <?php the_content(); ?>
                <div class="post-share"></div>
                <div class="post-comment">
                    <div id="vk_comments"><div class="lo-load"></div></div>
                </div>
            </div>
        </div>
        <div id="scroll">
<?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
