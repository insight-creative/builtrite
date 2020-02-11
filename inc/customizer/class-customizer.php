<?php
/**
 * jv Customizer Class
 *
 * @author   benluoma
 * @package  jv
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'builtrite_Customizer' ) ) :

	/**
	 * The jv Customizer class
	 */
	class builtrite_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'customize_register',              array( $this, 'customize_register' ) );
			//add_action( 'after_setup_theme',               array( $this, 'custom_header_setup' ) );
			add_action( 'wp_head', 												 array( $this, 'builtrite_customizer_css' ) );
		}

		/**
		 * Setup the WordPress core custom header feature.
		 *
		 */
		public function custom_header_setup() {
			add_theme_support( 'custom-header', apply_filters( 'builtrite_custom_header_args', array(
				'default-image' => '',
				'header-text'   => false,
				'width'         => 1950,
				'height'        => 500,
				'flex-width'    => true,
				'flex-height'   => true,
			) ) );
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer along with several other settings.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 * @since  1.0.0
		 */
		public function customize_register( $wp_customize ) {

			/**
			 * Adding layout panel
			 */
			 $wp_customize->add_section( 'builtrite_layout',
			    array(
			       'title' => 'Layout',
			       'priority' => 1,
			        )
			    );

			//header layout
			 $wp_customize->add_setting(
				 'builtrite_header_layout',
		     array(
		        'default' => 'right'
		     )
			 );

			 $wp_customize->add_control('builtrite_header_layout', array(
			     'label' => 'Header Layout',
					 'description' => 'Choose a header navigation style.',
			     'section' => 'builtrite_layout',
					 'type' => 'select',
            'choices'        => array(
							'right'  => __( 'Right' ),
							'left'  => __( 'Left' ),
							'center'   => __( 'Center' ),
            )
			   )
			 );

			 //fixed Header
			 $wp_customize->add_setting(
 		 			'builtrite_fixed_header',
 		 			array(
 		 				'default' => 0,
 		 			)
 		 	);

 		 	$wp_customize->add_control(
 		 		'builtrite_fixed_header',
 		 		array(
 		 			'type' => 'checkbox',
 		 			'priority' => 10,
 		 			'section' => 'builtrite_layout',
 		 			'label' => __( 'Fixed Header', 'textdomain' ),
 		 			'description' => '',
 		 		)
 		 	);

			//header layout
			 $wp_customize->add_setting(
				 'builtrite_mobile_menu_type',
		     array(
		        'default' => 'bottom'
		     )
			 );

			 $wp_customize->add_control('builtrite_mobile_menu_type', array(
			     'label' => 'Mobile Menu Type',
					 'description' => 'Choose a position for your mobile menu.',
			     'section' => 'builtrite_layout',
					 'priority' => 12,
					 'type' => 'select',
            'choices'        => array(
							'top'  => __( 'Top' ),
							'bottom'  => __( 'Bottom' ),
            )
			   )
			 );


			/**
			 * Tagline display settings
			 */

		 	$wp_customize->add_setting(
		 			'builtrite_show_tagline',
		 			array(
		 				'default' => 0,
		 				'type' => 'theme_mod',
		 				'capability' => 'edit_theme_options',
		 				'transport' => 'refresh',
		 			)
		 	);

		 	$wp_customize->add_control(
		 		'builtrite_show_tagline',
		 		array(
		 			'type' => 'checkbox',
		 			'priority' => 10,
		 			'section' => 'title_tagline',
		 			'label' => __( 'Display Tagline', 'textdomain' ),
		 			'description' => '',
		 		)
		 	);

			/**
			 * Contact info settings (used in Contact Info widget)
			 */
			$wp_customize->add_setting(
					'builtrite_address',
					array(
						'default' => '',
						'type' => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport' => 'refresh',
					)
			);

			$wp_customize->add_control(
				'builtrite_address',
				array(
					'type' => 'textarea',
					'priority' => 11,
					'section' => 'title_tagline',
					'label' => __( 'Address', 'textdomain' ),
					'description' => '',
				)
			);

			$wp_customize->add_setting(
					'builtrite_phone',
					array(
						'default' => '',
						'type' => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport' => 'refresh',
					)
			);

			$wp_customize->add_control(
				'builtrite_phone',
				array(
					'type' => 'text',
					'priority' => 11,
					'section' => 'title_tagline',
					'label' => __( 'Phone', 'textdomain' ),
					'description' => '',
				)
			);

			$wp_customize->add_setting(
					'builtrite_email',
					array(
						'default' => '',
						'type' => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport' => 'refresh',
					)
			);

			$wp_customize->add_control(
				'builtrite_email',
				array(
					'type' => 'text',
					'priority' => 11,
					'section' => 'title_tagline',
					'label' => __( 'Email', 'textdomain' ),
					'description' => '',
				)
			);

			$wp_customize->add_setting(
					'builtrite_hours',
					array(
						'default' => '',
						'type' => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport' => 'refresh',
					)
			);

			$wp_customize->add_control(
				'builtrite_hours',
				array(
					'type' => 'text',
					'priority' => 11,
					'section' => 'title_tagline',
					'label' => __( 'Hours', 'textdomain' ),
					'description' => '',
				)
			);

			/**
			 * Custom theme colors
			 */
			 //Adding color
 			$wp_customize->add_setting( 'primary_color' , array(
 			    'default'     => '',
 			    'transport'   => 'refresh',
 			) );

 			$wp_customize->add_setting( 'link_color' , array(
 			    'default'     => '',
 			    'transport'   => 'refresh',
 			) );

 			$wp_customize->add_setting( 'text_color' , array(
 			    'default'     => '',
 			    'transport'   => 'refresh',
 			) );

 			$wp_customize->add_setting( 'accent_color' , array(
 			    'default'     => '',
 			    'transport'   => 'refresh',
 			) );

 			//Adding control
 			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
 				'label'       => __( 'Primary Color', 'builtrite' ),
 				'section'     => 'colors',
 			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
 				'label'       => __( 'Accent Color', 'builtrite' ),
 				'section'     => 'colors',
 			) ) );

 			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
 				'label'       => __( 'Text Color', 'builtrite' ),
 				'section'     => 'colors',
 			) ) );

 			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
 				'label'       => __( 'Link Color', 'builtrite' ),
 				'section'     => 'colors',
 			) ) );

		}

		/**
		 * Add customizer css to doc head
		 *
		 */
		public function builtrite_customizer_css() { ?>
			<style type="text/css">
									/* TODO: Get Background Color in here */
		    <?php if (get_theme_mod('primary_color')) : ?>
									/* Button Background Color */
									button,
									[type='button'],
									[type='reset'],
									[type='submit'],
									.btn,
									.cat-link,
									.widget_tag_cloud a {
										background-color: <?php echo get_theme_mod('primary_color'); ?>;
									}

									button:hover,
									[type='button']:hover,
									[type='reset']:hover,
									[type='submit']:hover,
									.btn:hover,
									.cat-link:hover,
									.widget_tag_cloud a:hover {
										background-color: <?php echo adjustBrightness(get_theme_mod('primary_color'), -50); ?>;
									}

					<?php endif; ?>

		      <?php if (get_theme_mod('link_color')) : ?>
									/* Link Color */
									a,
									a:visited,
									.main-menu li > a,
									.main-menu li > a:visited,
									.search-submit {
										color: <?php echo get_theme_mod('link_color'); ?>;
									}

									a:hover,
									.main-menu li > a:hover,
									.search-submit {
										color: <?php echo adjustBrightness(get_theme_mod('link_color'), -50); ?>;
									}

									.main-menu li.current-menu-item > a,
									.main-menu li.current-menu-ancestor > a,
									.search-submit:hover {
										color: <?php echo adjustBrightness(get_theme_mod('link_color'), -100); ?>;
									}
					<?php endif; ?>

		      <?php if (get_theme_mod('text_color')) : ?>
									/* Main Text Color */
									body {
										color: <?php echo get_theme_mod('text_color'); ?>;
									}
				  <?php endif; ?>

					<?php if (get_theme_mod('accent_color')) : ?>
									/* Secondary Text Color */
									.site-description,
									.widget-title {
										color: <?php echo get_theme_mod('accent_color'); ?> !important;
									}
					<?php endif; ?>

					<?php if ( (bool) get_theme_mod('builtrite_show_tagline') == FALSE ) : ?>
						.site-description {
							clip: rect(1px, 1px, 1px, 1px);
							position: absolute;
						}
					<?php endif; ?>

			</style>
		<?php }
	}

endif;

return new builtrite_Customizer();
