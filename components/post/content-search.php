<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BUILTRITE
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'product' === get_post_type() ) : ?>
			<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail($post->id, 'thumbnail'); ?></a>
		<?php endif; ?>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() || 'page' === get_post_type()  ) : ?>
			<?php //get_template_part( 'components/post/content', 'meta' ); ?>
		<?php endif; ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<?php if ( 'product' === get_post_type() ) : ?>
				<a class="btn" href="<?php the_permalink(); ?>">More Info »</a>
			<?php endif; ?>
			<?php if ( 'post' === get_post_type() || 'page' === get_post_type()  ) : ?>
				<a class="btn" href="<?php the_permalink(); ?>">Read More »</a>
				<?php //get_template_part( 'components/post/content', 'meta' ); ?>
			<?php endif; ?>
		</div>
	</header>

	<?php get_template_part( 'components/post/content', 'footer' ); ?>
</article>
