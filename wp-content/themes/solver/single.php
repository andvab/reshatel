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
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?159"></script>

<script type="text/javascript">
    VK.init({apiId: 3612780, onlyWidgets: true});
</script>

<div id="articles" class="container" style="margin-top: 20px">
    <div class="row">
        <div class="span8">
            <?php the_breadcrumb(); ?>
            <h1 class="post-title"><?php the_title() ?></h1>
            <div class="post-content">
                <?php the_content(); ?>


                <div class="post-share"></div>

                <div class="post-comment">
                    <div id="vk_comments"></div>
                    <script type="text/javascript">
			VK.Widgets.Comments("vk_comments", {limit: 10, width: "620", attach: "*", autoPublish: 0, pageUrl: "<? echo get_permalink(); ?>"});
                    </script>
                </div>
            </div>
        </div><!-- .span4 -->
        <div id="scroll">
<?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
