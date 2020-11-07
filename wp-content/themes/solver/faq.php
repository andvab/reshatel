<?
/**
 * Template Name: FAQ
 *
 * @package WordPress
 * @subpackage Solver
 * @since Solver 1.0
 */
?>

<? get_header() ?>

  <div id="content" class="container" style="margin-top: 20px">
    <div class="row">
      <div class="span12">
        <div class="article">
          <div class="article__title" style="margin-bottom: 25px;"><? the_title() ?></div>			
          <div class="article__content">
            <? the_post(); ?>
            <? the_content(); ?>
          </div>
        </div>		  
      </div>    		
    </div>
      
  </div>

<? get_footer() ?>
