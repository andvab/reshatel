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

<div class="container" style="margin-top: 20px">
  <div class="row">
    <div class="span8">
      <div class="article__title"><? the_title() ?></div>
      <? $categories = get_categories(array(
      'type'=>'post',
      'orderby'=>'id',
      'order'=>'ASC',
      )); ?>
      <? foreach($categories as $category): ?>
		    <div class="category-link">Категория: <a href="<?= get_category_link($category->term_id) ?>"><?php echo $category->name ?></a></div>
    		<? $posts = get_posts(array(
    			'posts_per_page'=>3,
    			'category'=>$category->term_id,
    		)); ?>
    		<? foreach($posts as $post): ?>
    			<div class="cat">
    				<div class="cat__img">
    					<?php echo get_the_post_thumbnail($post->ID); ?>
    				</div>
    				<div class="cat__content">
    					<a class="post-title" href="<?php echo get_permalink($post->ID)?>"><?php echo $post->post_title ?></a>
    					<div class="post-content">
						<?php echo apply_filters('the_content',$post->post_content) ?>    						
    						<a class="read-more" href="<?php echo get_permalink($post->ID) ?>">Читать далее →</a>
    					</div>
    				</div>
    			</div>
    		<? endforeach ?>
      <? endforeach ?>
    </div><!-- .span8 -->
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>
