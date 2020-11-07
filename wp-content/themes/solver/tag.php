<?php /*
  Template Name: Tag Archive
 */ ?>
<?php get_header(); ?>

<div class="container" style="margin-top: 20px">
    <div class="row">
        <center style="padding-bottom:20px;"><h2>Архив меток</h2></center>
        <?php wp_tag_cloud('smallest=8&largest=16&number=1500&format=flat&separator=|&orderby=name'); ?>
        <br>
        <br>
        <div class="span8">
            <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>

                    <div class="cat">
                        <div class="cat__img">
                            <a href="<?php the_permalink() ?>">
                                <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post_id)) ?>" width="127">
                            </a>
                        </div>
                        <div class="cat__content">
                            <a class="post-title" href="<?php echo get_permalink($post_id) ?>"><?php the_title(); ?></a>
                            <div class="post-content">
                                <?php the_excerpt(); ?>
                                <a class="read-more" href="<?php echo get_permalink($post_id) ?>">Читать далее →</a>
                            </div>
                        </div>
                    </div>
                     
                        <?php endwhile; ?>
                <?php
                the_posts_pagination([
                    'show_all' => false,
                    'end_size' => 1,
                    'mid_size' => 1,
                    'prev_text' => __('«', 'reshatel'),
                    'next_text' => __('»', 'reshatel'),
                    'screen_reader_text' => ' '
                ]);
                ?>
                    <?php endif; ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
