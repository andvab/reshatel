<?php
 /**
 * @package WordPress
 * @subpackage Solver Lite
 * @since Solver Lite 1.1
 */

get_header();

?>
<div class="container" style="margin-top: 20px">
  <div class="row">
    <div class="span8">
      <h1 class="article__title">Результаты поиска</h1>

    <?php if(have_posts()):?>
       <?php while ( have_posts() ): the_post(); $post_id = get_the_ID(); ?>
          <div class="cat">
            <div class="cat__img">
              <a href="<?php the_permalink() ?>">
		<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ) ?>" width="127">
	      </a>
            </div>
            <div class="cat__content">
              <a class="post-title" href="<?php echo get_permalink( $post_id )?>"><?php the_title(); ?></a>
              <div class="post-content">
                <?php the_excerpt(); ?>
                <a class="read-more" href="<?php echo get_permalink( $post_id )?>">Читать далее →</a>
              </div>
            </div>
          </div>
       <?php endwhile;?>
    <?php else:?>
<div class="post"> Ничего не найдено </div>
<?php endif;?>

      <div style="padding:5px"><?php if( function_exists( 'wp_paginate' ) )  wp_paginate(); ?></div>
    </div><!-- .span8 -->
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>
