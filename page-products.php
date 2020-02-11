<?php
/**
 * Template Name: Products Page Template
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy


 * @package BUILTRITE
 */

get_header(); ?>

<?php get_template_part('components/page/hero'); ?>

<section class="product-wrap">
<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

  <div class="entry-content" style="padding: 0px; margin-bottom: 0px;">

  <div class="products">

<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$custom_args = array(
    'post_type' => 'product',
    'posts_per_page' => 9,
    'orderby' => 'menu_order title',
    'order' => 'ASC',
    'paged' => $paged
  );

$custom_query = new WP_Query($custom_args); ?>

<?php if ($custom_query->have_posts()) : ?>

  <!-- the loop -->
  <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

    <?php   get_template_part('components/post/content', 'type'); ?>

  <?php endwhile; ?>
  <!-- end of the loop -->

  <!-- pagination here -->

<?php wp_reset_postdata(); ?>

<?php endif; ?>


  </div>
</div>
<?php
  //if (function_exists(custom_pagination)) {
      custom_pagination($custom_query->max_num_pages, "", $paged);
//  }
?>
<footer class="entry-footer">
  <span class="edit-link" style="display: none;"><a class="post-edit-link" href="http://builtritehandlers.local/wp-admin/post.php?post=2312&amp;action=edit">Edit <span class="screen-reader-text">"Products"</span></a></span>	</footer>
</article>

  </main>
</div>

<?php
get_sidebar('type');

?> </section> <?php
get_footer();
