<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BUILTRITE
 */

?>
<div class="product-item">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="tailor-element tailor-box tailor-box--image" draggable="true" tailor-label="Box">
		<div class="tailor-box__graphic" style="margin-bottom:10px">
			<a href="<?php the_permalink(); ?>">
				<?php $thumb = get_field('product_thumb', $post->ID);
				if($thumb) : ?>
				<img src="<?php echo $thumb['sizes']['product-thumb']; ?>"/>
			<?php else : ?>
				<img src="<?php if(get_the_post_thumbnail()) : echo get_the_post_thumbnail_url(get_the_ID(),'product-thumb'); else : echo get_stylesheet_directory_uri().'/assets/img/placeholder.png'; endif; ?>"/>
			<?php endif; ?>
			</a>
		</div>
		<a href="<?php the_permalink(); ?>"><h3 class="tailor-box__title"><?php the_title(); ?></h3></a>

				<br>
		<div class="tailor-element tailor-button tailor-button--primary tailor-button--medium tailor-button--medium-mobile tailor-button--medium-tablet" tailor-label="Button"><a style="text-align:center" class="tailor-button__inner" href="<?php the_permalink(); ?>">More Info</a></div>

		</div>
</article>
</div>
