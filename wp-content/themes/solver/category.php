<?
/**
 * @package WordPress
 * @subpackage Solver
 * @since Solver 1.1
 */
get_header();

global $paged;

$cat = get_the_category();
$category_id = $cat[0]->term_id;

query_posts(array(
    'cat' => $category_id,
    'posts_per_page' => 5,
    'paged' => $paged,
));
?>

<div id="articles" class="container" style="margin-top: 20px">
    <div class="row">
        <div class="span8">
            <? $pageNum = (get_query_var('paged')) ? get_query_var('paged') : 0; ?>
            <h1 class="article__title">Статьи: <?
                echo $cat[0]->name;
                if ($pageNum) {
                    echo ', страница ' . $pageNum;
                }
                ?></h1>
            <? the_breadcrumb(); ?>

            <?
            if (have_posts()):
                while (have_posts()): the_post();
                    $post_id = get_the_ID();
                    ?>
                    <div class="cat">
                        <div class="cat__img">
                            <a href="<? the_permalink() ?>">
                                <img src="<?= wp_get_attachment_url(get_post_thumbnail_id($post_id)) ?>" width="127" alt="<?= $post->post_title ?>" title="<?= $post->post_title ?>">
                            </a>
                        </div>
                        <div class="cat__content">
                            <a class="post-title" href="<?= get_permalink($post_id) ?>"><? the_title(); ?></a>
                            <div class="post-content">
                                <? the_excerpt(); ?>
                                <a class="read-more" href="<?= get_permalink($post_id) ?>">Читать далее →</a>
                            </div>
                        </div>
                    </div>
                    <?
                endwhile;
            endif;
            ?>

            <?
            the_posts_pagination([
                'show_all' => false,
                'end_size' => 1,
                'mid_size' => 1,
                'prev_text' => __('«', 'reshatel'),
                'next_text' => __('»', 'reshatel'),
                'screen_reader_text' => ' '
            ]);
            ?>

        </div><!-- .span8 -->
        <div id="scroll">
            <? get_sidebar(); ?>
        </div>
    </div>
</div>

<? get_footer(); ?>
