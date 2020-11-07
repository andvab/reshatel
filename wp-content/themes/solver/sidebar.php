<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<div class="span4">
    <noindex>
        <div class="article__title">Заказать сейчас</div>


        <div class="sideform_contaiter">
            <div class="sideform" style="display:block">
                <?= do_shortcode('[reshatel_form name=choose_type]'); ?>
            </div>
        </div>

        <div class="article__title">Избранные статьи</div>
        <?php
        $posts = get_posts(array(
            'numberposts' => 10,
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_tag',
                    'field' => 'slug',
                    'terms' => 'best_articles',
                ),
            ),
        ));
        ?>
        <?php if (count($posts) > 0): ?>
            <ul class="best_articles">
                <?php foreach ($posts as $post): ?>
                    <li>
                        <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php
        /* <div style="margin-top: 25px">
          <div class="article__title">Поиск</div>
          get_search_form();
          </div> */
        ?>

    </noindex>
</div>
