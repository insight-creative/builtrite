<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BUILTRITE
 */

get_header(); ?>

<?php get_template_part('components/page/hero');

$type = get_query_var('type');
//echo $type;

?>

<section class="product-wrap">
<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <div class="entry-content" style="padding: 0px; margin-bottom: 0px;">


  <div class="products">

		<?php

    if($type == 'attachments') :
  
        get_template_part('components/post/attachment-grid');

      else :

        if (have_posts()) : ?>

			<?php
            /* Start the Loop */
            while (have_posts()) : the_post();


            get_template_part('components/post/content', 'type');

        endwhile;


    else :

        get_template_part('components/post/content', 'none');

    endif; endif; ?>



	  </div>
	</div>
	<?php
    if($type != 'attachments') :
  if (function_exists(custom_pagination)) {
	    custom_pagination($custom_query->max_num_pages,"",$paged);
	  }  endif; ?>

</main>
</div>
<?php
get_sidebar('type');

?>  </section>

<section class="desc">
  <div class="tailor-section__content">
    <h3>More about Builtrite&trade; <?php echo get_the_archive_title(); ?></h3>
    <?php echo term_description(); ?>
  </div>
</section>



 <?php
get_footer();
