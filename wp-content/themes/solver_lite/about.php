<?
/**
 * Template Name: О нас
 *
 * @package WordPress
 * @subpackage Solver Lite
 * @since Solver Lite 1.0
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
    <div class="row" style="margin-top: 20px"> 
      <? $solvers=Infoblock::getAllBySlug('solvers') ?>
      <? if(count($solvers)>0): ?>
        <? foreach($solvers as $solver): ?>
          <div class="span3">
            <div class="solver">
              <div class="solver__img">
                <?= get_the_post_thumbnail($solver->ID,'thumbnail') ?>
              </div>
              <div class="solver__name"><?= $solver->post_title ?></div>				
              <div class="solver__content"><?= apply_filters('the_content',$solver->post_content) ?></div>
            </div>			  
          </div>
        <? endforeach ?>
      <? endif ?>
    </div>	  
  </div>

<? get_footer() ?>
