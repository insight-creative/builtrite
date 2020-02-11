<?php
/**
 * components functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BUILTRITE
 */

/**
 * Assign the BUILTRITE version to a var
 */
$theme            = wp_get_theme();
$builtrite_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (! isset($content_width)) {
    $content_width = 1280; /* pixels */
}

$jv = (object) array(
    'version' => $builtrite_version,

    /**
     * Initialize all the things.
     */
    'main'       => require 'inc/class-theme.php',
    'customizer' => require 'inc/customizer/class-customizer.php',
);

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load custom widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load custom shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Load Jetpack compatibility file.
 */
if (class_exists('Jetpack')) {
    //for development (remove for production)
  add_filter('jetpack_development_mode', '__return_true');
    $jv->jetpack = require 'inc/jetpack/class-jetpack.php';
}

/**
 * Load tailor compatibility file.
 */
if (class_exists('Tailor')) {
    $jv->tailor = require 'inc/tailor/tailor.php';
}

/**
 * Load acf compatibility file.
 */
if (class_exists('acf')) {
    $jv->acf = require 'inc/acf/acf.php';
}

/*
            register_post_type( 'product',

                //apply_filters( 'tailor_project_parameters',
                    array(
                        'labels'              => array(
                            'name'                      =>  _x( 'Products', 'project general name' ),
                            'singular_name'             =>  _x( 'Project', 'project singular name' ),
                            'all_items'                 =>  __( 'All Projects', 'tailor-portfolio' ),
                            'add_new'                   =>  _x( 'Add New', 'project', 'tailor-portfolio' ),
                            'add_new_item'              =>  __( 'Add New Project', 'tailor-portfolio' ),
                            'edit_item'                 =>  __( 'Edit Project', 'tailor-portfolio' ),
                            'new_item'                  =>  __( 'Add New Project', 'tailor-portfolio' ),
                            'view_item'                 =>  __( 'View Project', 'tailor-portfolio' ),
                            'search_items'              =>  __( 'Search Projects', 'tailor-portfolio' ),
                            'not_found'                 =>  __( 'No projects found', 'tailor-portfolio' ),
                            'not_found_in_trash'        =>  __( 'No projects found in trash', 'tailor-portfolio' ),
                        ),
                        'description'               =>  __( 'This is where you can add new projects to your portfolio.', 'tailor-portfolio' ),
                        'public'                    =>  true,
                        'show_ui'                   =>  true,
                        'map_meta_cap'              =>  true,
                        'publicly_queryable'        =>  true,
                        'exclude_from_search'       =>  false,
            'taxonomies' => array('type','industry'),
                        'hierarchical'              =>  false,
                    //	'rewrite'                   =>  $rewrite_args,
                        'query_var'                 =>  true,
                        'supports'                  =>  array(
                            'title',
                            'editor',
                            'excerpt',
                            'thumbnail',
                            'comments',
                            'custom-fields',
                            'page-attributes',
                            'publicize',
                            'wpcom-markdown'
                        ),
                        //'has_archive'               =>  get_post( $portfolio_page_id ) ? get_page_uri( $portfolio_page_id ) : 'portfolio',
                        'show_in_nav_menus'         =>  true
                    )
                );






            //$permalinks = get_option( '_tailor_portfolio_permalinks' );

      */

      // Our custom post type function
function create_posttype()
{
    register_post_type('product',
    // CPT Options
        array(
            'labels' => array(
              'name'               => _x('Products', 'post type general name', 'your-plugin-textdomain'),
  'singular_name'      => _x('Product', 'post type singular name', 'your-plugin-textdomain'),
  'menu_name'          => _x('Products', 'admin menu', 'your-plugin-textdomain'),
  'name_admin_bar'     => _x('Product', 'add new on admin bar', 'your-plugin-textdomain'),
  'add_new'            => _x('Add New', 'Product', 'your-plugin-textdomain'),
  'add_new_item'       => __('Add New Product', 'your-plugin-textdomain'),
  'new_item'           => __('New Product', 'your-plugin-textdomain'),
  'edit_item'          => __('Edit Product', 'your-plugin-textdomain'),
  'view_item'          => __('View Product', 'your-plugin-textdomain'),
  'all_items'          => __('All Products', 'your-plugin-textdomain'),
  'search_items'       => __('Search Products', 'your-plugin-textdomain'),
  'parent_item_colon'  => __('Parent Products:', 'your-plugin-textdomain'),
  'not_found'          => __('No Products found.', 'your-plugin-textdomain'),
  'not_found_in_trash' => __('No Products found in Trash.', 'your-plugin-textdomain')
            ),
            'public' => true,
            'hierarchical'                =>    true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'product'),
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
            'taxonomies' => array( 'industry','type','post_tag'),
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_posttype');


// Our custom post type function
function create_posttype2()
{
register_post_type('dealer',
// CPT Options
  array(
      'labels' => array(
        'name'               => _x('Dealers', 'post type general name', 'your-plugin-textdomain'),
'singular_name'      => _x('Dealer', 'post type singular name', 'your-plugin-textdomain'),
'menu_name'          => _x('Dealers', 'admin menu', 'your-plugin-textdomain'),
'name_admin_bar'     => _x('Dealer', 'add new on admin bar', 'your-plugin-textdomain'),
'add_new'            => _x('Add New', 'Dealer', 'your-plugin-textdomain'),
'add_new_item'       => __('Add New Dealer', 'your-plugin-textdomain'),
'new_item'           => __('New Dealer', 'your-plugin-textdomain'),
'edit_item'          => __('Edit Dealer', 'your-plugin-textdomain'),
'view_item'          => __('View Dealer', 'your-plugin-textdomain'),
'all_items'          => __('All Dealers', 'your-plugin-textdomain'),
'search_items'       => __('Search Dealers', 'your-plugin-textdomain'),
'parent_item_colon'  => __('Parent Dealers:', 'your-plugin-textdomain'),
'not_found'          => __('No Dealers found.', 'your-plugin-textdomain'),
'not_found_in_trash' => __('No Dealers found in Trash.', 'your-plugin-textdomain')
      ),
      'public' => true,
      'hierarchical'                =>    true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'dealer'),
      'supports'           => array( 'title','revisions' ),
  //    'taxonomies' => array( 'industry','type','post_tag'),
  )
);
}

// Hooking up our function to theme setup
add_action('init', 'create_posttype2');


add_action('init', 'create_private_Product_tax');

function create_private_Product_tax()
{
    register_taxonomy(
        'type',
        'product',
        array(
            'label' => __('Type'),
            'public' => true,
            'rewrite' => true,
            'hierarchical' => true,
        )
    );
}

add_action('init', 'create_private_Product_tax2');

function create_private_Product_tax2()
{
    register_taxonomy(
        'industry',
        'product',
        array(
            'label' => __('Industry'),
            'public' => true,
            'rewrite' => true,
            'hierarchical' => true,
        )
    );
}


function customize_customtaxonomy_archive_display($query)
{
    if (($query->is_main_query()) && (is_tax('type'))) {
        $query->set('orderby', 'menu_order');
    }
    $query->set('order', 'ASC');
}

add_action('pre_get_posts', 'customize_customtaxonomy_archive_display');
/*
// include custom jQuery
function shapeSpace_include_custom_jquery() {

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquery');

*/

if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        //echo $current_user->user_firstname;
    }
