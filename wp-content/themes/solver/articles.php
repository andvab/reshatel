<?
/**
 * Template Name: Статьи
 *
 * @package WordPress
 * @subpackage Solver
 * @since Solver 1.0.1
 */
?>

<?php get_header(); ?>

<div id="articles" class="container" style="margin-top: 20px">
    <div class="row">
        <div class="span8">
            <h1 class="article__title"><? the_title() ?></h1>
            <?php the_breadcrumb(); ?>
            <?
            $categories = get_categories(array(
                'type' => 'post',
                'orderby' => 'id',
                'order' => 'ASC',
                'exclude' => '14,15',
            ));
            ?>
            <? foreach ($categories as $category): ?>
                <div class="category-link">Категория: <a href="<?php echo get_category_link($category->term_id) ?>" title="Посмотреть все статьи данной категории"><?php echo $category->name ?></a></div>
                <?
                $posts = get_posts(array(
                    'posts_per_page' => 3,
                    'category' => $category->term_id,
                ));
                ?>
                <? foreach ($posts as $post): ?>
                    <div class="cat">
                        <div class="cat__img">
                            <a href="<?php the_permalink() ?>" rel="nofollow" ><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post_id)) ?>" width="127" alt="<? echo $post->post_title ?>" title="<? echo $post->post_title ?>"></a>
                        </div>
                        <div class="cat__content">
                            <a class="post-title" href="<?php echo get_permalink($post->ID) ?>"><?php echo $post->post_title ?></a>
                            <div class="post-content">
                                <noindex>
                                    <?php the_excerpt(); ?>
                                    <a class="read-more" href="<?php echo get_permalink($post->ID) ?>">Читать далее →</a>
                                </noindex>
                            </div>
                        </div>
                    </div>
                <? endforeach ?>
            <? endforeach ?>
        </div><!-- .span8 -->
        <div id="scroll">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
