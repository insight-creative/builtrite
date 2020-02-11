<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BUILTRITE
 */

get_header(); ?>

<?php get_template_part('components/page/hero'); ?>
<div class="crumbs fauxwidth" style="margin-bottom:0;width: 100vw; margin-left: -132.5px;">
<div class="crumb-inner">
<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to Builtrite Handlers." href="http://builtritehandlers.local" class="home"><span class="genericon genericon-home"></span></a></span><meta property="position" content="1"><span class="seperator">&nbsp;:&nbsp;</span><span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to Products." href="http://builtritehandlers.local/industries/" class="post post-product-archive"><span property="name">industry</span></a><meta property="position" content="2"></span><span class="seperator">&nbsp;:&nbsp;</span><span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage"  href="http://builtritehandlers.local/industry/pulpwood-forestry/" class="archive taxonomy industry current-item"><span property="name"><?php the_archive_title(); ?></span></a><meta property="position" content="3"></span>		</div>
</div>

<section class="desc">
	<div class="tailor-section__content">
		<?php the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
		<div><a class="btn "href="#view-products">View Equipment</a></div>
	</div>
	<?php

	$title = get_the_archive_title();

	if(strpos($title, 'Custom') === false) :  else : ?>
		<style>

		.product-wrap {
			display:none !important;
		}

	</style>
	<?php endif; ?>
</section>

<!-- custom bread crumb nav for taxonomy -->

<section id="view-products" class="product-wrap">
	<h5>View <?php the_archive_title(); ?> Products</h5>
<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <div class="entry-content" style="padding: 0px; margin-bottom: 0px;">


  <div class="products">

		<?php
        if (have_posts()) : ?>

			<?php
            /* Start the Loop */
            while (have_posts()) : the_post();

            get_template_part('components/post/content', 'type');

        endwhile;


    else :

        get_template_part('components/post/content', 'none');

    endif; ?>



	  </div>
	</div>
	<?php //if (function_exists(custom_pagination)) {
        custom_pagination($custom_query->max_num_pages, "", $paged);
     // }?>

</main>
</div>
<?php
get_sidebar('industry');

?>  </section> <?php
get_footer();
