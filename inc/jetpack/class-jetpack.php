<?php
/**
 * jv Jetpack Class
 *
 * @package  jv
 * @author   benluoma
 * @since    1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'builtrite_Jetpack' ) ) :

	/**
	 * The jv Jetpack integration class
	 */
	class builtrite_Jetpack {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'after_setup_theme', 	array( $this, 'jetpack_setup' ) );
		}

		/**
		 * Jetpack setup function.
		 *
		 * See: https://jetpack.me/support/infinite-scroll/
		 * See: https://jetpack.me/support/responsive-videos/
		 */
		public function jetpack_setup() {
			// Add theme support for Infinite Scroll.
			add_theme_support( 'infinite-scroll', array(
				'container' => 'main',
				'render'    => array( $this, 'jetpack_infinite_scroll_loop' ),
				'footer'    => 'page',
			) );

			// Add theme support for Responsive Videos.
			add_theme_support( 'jetpack-responsive-videos' );

		}

		/**
		 * Custom render function for Infinite Scroll.
		 */
		public function jetpack_infinite_scroll_loop() {
			while ( have_posts() ) {
				the_post();
				if ( is_search() ) :
					get_template_part( 'components/post/content', 'search' );
				else :
					get_template_part( 'components/post/content', get_post_format() );
				endif;
			}
		}
	}

endif;

return new builtrite_Jetpack();
