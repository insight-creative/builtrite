<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BUILTRITE
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header <?php if ( is_single() && has_post_thumbnail() ) : ?>has-thumbnail<?php endif ?>" <?php if ( is_single() && has_post_thumbnail() ) : ?> style="background-image: url(<?php the_post_thumbnail_url(); ?>); height: 50vh;"<?php endif; ?>>
		<?php
			if ( is_single() ) {

				//show category
				$category = get_the_category();
				if($category)
					echo '<a class="cat-link" href="' . get_category_link( $category[0]->term_id) . '">' . $category[0]->cat_name . '</a>';

				the_title( '<h1 class="entry-title">', '</h1>' );
				$terms = get_the_terms( $post->ID, 'type');
				if($terms) {
				foreach ( $terms as $term ) {
    			$termID[] = $term->name;
				}
      echo '<div><a class="cat-link" href="' . get_term_link($term) . '">' .$term->name. '</a></div>';
			//echo '<div><a class="cat-link" href="/product/' . $term->slug . '">' .$term->name. '</a></div>';
			}


			} else {

				if ( '' != get_the_post_thumbnail() ) : ?>
					<div class="post-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'jv-featured-image' ); ?>
						</a>
					</div>
				<?php endif;
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<?php get_template_part( 'components/post/content', 'meta' ); ?>
		<?php
		endif; ?>
	</header>
	<?php crumb_nav(); ?>
	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'builtrite' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'builtrite' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<?php if(is_home() || is_category()) : ?>
	<a href="<?php the_permalink(); ?>" class="btn">Read More »</a>
<?php endif; ?>
	<br><br>
	<?php get_template_part( 'components/post/content', 'footer' ); ?>
</article><!-- #post-## -->
