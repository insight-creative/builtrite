<?php

// filter the Gravity Forms button type
add_filter('gform_submit_button', 'form_submit_button', 10, 2);
function form_submit_button($button, $form)
{
  if($form['id'] != 5) {
    return "<button class='button' id='gform_submit_button_{$form['id']}'><span>Submit</span></button>";
  } else {
    return "<button class='button' id='gform_submit_button_{$form['id']}'><span>Sign Up</span></button>";
  }
}

add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    } elseif (is_tax()) {
        $title = single_tag_title('', false);
    }


    return $title;
});

function crumb_nav()
{
    global $post;
    if (is_singular('product') || is_tax('industry')) {
        ?>
  <div class="crumbs fauxwidth">
		<div class="crumb-inner">
		<?php bcn_display($return = false, $linked = true, $reverse = false, $force = false); ?>
		</div>
	</div>
<?php
    }
}
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package BUILTRITE
 */

 /**
* Disable the taxonomy archive pages
*/
//add_action('pre_get_posts', 'disable_tax_archive');
function disable_tax_archive($qry)
{
    if (is_admin()) {
        return;
    }

    if (is_tax('industry')) {
        $qry->set_404();
    }
}


function custom_pagination($numpages = '', $pagerange = '', $paged='')
{
    if (empty($pagerange)) {
        $pagerange = 2;
    }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   *
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
    if (empty($paged)) {
        $paged = 1;
    }
    if ($numpages == '') {
        global $wp_query;
        $numpages = $wp_query->max_num_pages;
        if (!$numpages) {
            $numpages = 1;
        }
    }

  /**
   * We construct the pagination arguments to enter into our paginate_links
   * function.
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => false,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => true,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

    $paginate_links = paginate_links($pagination_args);

    if ($paginate_links) {
        echo "<nav class='navigation pagination'>";
    //  echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
        echo "</nav>";
    }
}



/// custom featured product lineup

function featured_prod($content)
{
    $custom_args = array(
      'post_type' => 'product',
      'posts_per_page' => -1,
      'tag' => 'Featured',
      'orderby' => 'menu_order title',
      'order' => 'ASC',
    );

    $custom_query = new WP_Query($custom_args); ?>

  <?php if ($custom_query->have_posts()) :

    ob_start(); ?>

    <!-- the loop -->
    <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

      <?php

      get_template_part('components/post/content', 'type'); ?>


    <?php endwhile;
    $content = ob_get_clean(); ?>

    <?php wp_reset_postdata(); ?>

    <?php endif;

    wp_reset_query();

    return $content;
}

add_shortcode('featured_products', 'featured_prod');


// related products shortcode

function related_prod($content)  {

  ob_start();

  $post_objects = get_field('related_products');

  if ($post_objects):
    // override $post
  foreach ($post_objects as $post):

  setup_postdata($post);

  //  global $post;

  //  print_r($post) ?>

    <div class="product-item">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


    	<div class="tailor-element tailor-box tailor-box--image" draggable="true" tailor-label="Box">
    		<div class="tailor-box__graphic" style="margin-bottom:10px">
    			<a href="<?php echo get_the_permalink($post->ID); ?>"><img src="<?php if(get_the_post_thumbnail($post->ID)) : echo get_the_post_thumbnail_url($post->ID,'product-thumb'); else : echo get_stylesheet_directory_uri().'/assets/img/placeholder.png'; endif; ?>"/></a>			<!--<img src="//localhost:3000/wp-content/uploads/2017/05/Screen-Shot-2017-08-01-at-11.38.38-AM.png" alt="" draggable="false"> -->
    		</div>
    		<a href="<?php  echo get_the_permalink($post->ID); ?>"><h3 class="tailor-box__title"><?php echo $post->post_title ?></h3></a>

    				<br>
    		<div class="tailor-element tailor-button tailor-button--primary tailor-button--medium tailor-button--medium-mobile tailor-button--medium-tablet" tailor-label="Button"><a style="text-align:center" class="tailor-button__inner" href="<?php echo get_the_permalink($post->ID); ?>">More Info</a></div>

    		</div>
    </article>
    </div>


  <?php   endforeach;

    wp_reset_postdata();

    else : // if no selected products

    $terms = get_the_terms($post->ID, 'type');
    if ($terms) {
        foreach ($terms as $term) {
            $termID[] = $term->slug;
        }
    }

    $term = array_pop($termID);

    //echo $term;

    //print_r($termID);

    $not = get_the_ID();

    $custom_args = array(
       'post_type' => 'product',
       'posts_per_page' => 6,
       //'orderby' => 'rand',
       'order' => 'ASC',
       'post__not_in' => array($not),
       'tax_query' => array(
               array(
                   'taxonomy' => 'type',
                   'field' => 'slug',
                   'terms'    => $term,
                  ),
            ),
     );

    $custom_query = new WP_Query($custom_args); ?>

   <?php if ($custom_query->have_posts()) : ?>

     <!-- the loop -->
     <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

       <?php

       get_template_part('components/post/content', 'type'); ?>


     <?php endwhile; ?>
   <?php else : ?>
     <h6 style="margin-left:22px;color:#aaa">No Related Products to Show</h6>
     <?php endif;

    wp_reset_query();

    endif;

    $content = ob_get_clean();

    return $content;
}

add_shortcode('related_products', 'related_prod');


// new image size for products

add_theme_support('post-thumbnails');

add_image_size('product-thumb', 500, 425, true); // Hard Crop Mode


// Move Yoast to bottom
function yoasttobottom()
{
    return 'low';
}
add_filter('wpseo_metabox_prio', 'yoasttobottom');

function mv_browser_body_class($classes) {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
        if($is_lynx) $classes[] = 'lynx';
        elseif($is_gecko) $classes[] = 'gecko';
        elseif($is_opera) $classes[] = 'opera';
        elseif($is_NS4) $classes[] = 'ns4';
        elseif($is_safari) $classes[] = 'safari';
        elseif($is_chrome) $classes[] = 'chrome';
        elseif($is_IE) {
                $classes[] = 'ie';
                if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
                $classes[] = 'ie'.$browser_version[1];
        } else $classes[] = 'unknown';
        if($is_iphone) $classes[] = 'iphone';
        if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
                 $classes[] = 'osx';
           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
                 $classes[] = 'linux';
           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
                 $classes[] = 'windows';
           }
        return $classes;
}
add_filter('body_class','mv_browser_body_class');



// industries shortcode


function industries($content) {


$terms = get_terms( array(
    'taxonomy' => 'industry',
    'order' => 'menu_order',
    'order' => 'ASC',
    'hide_empty' => false,
) );


ob_start();

foreach ($terms as $term) {


  $img = get_field('type_image', $term );

  $img = $img['sizes']['product-thumb'];


  ?>
  <div class="product-item">
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <a href="<?php echo get_term_link($term); ?>">
  <div class="tailor-element tailor-box tailor-box--image tailor-5991c6a89dd94">
  <div class="tailor-box__graphic">
    <?php if($img) : ?>
        <img src="<?php echo $img; ?>"/>

      <?php else : ?>
    <img src="/wp-content/uploads/2017/05/palceholder-dark.png" alt="">

  <?php endif; ?>

  </div>
  <h3 class="tailor-box__title"><?php echo $term->name; ?></h3>
  <div class="tailor-box__content"><!-- tailor:content:5991c6a89dd93 -->
  <div class="tailor-element tailor-content tailor-5991c6a89dd93">
  </div>
</a>
  </article><!-- #post-## -->
</div>
<?php } wp_reset_postdata();



$content = ob_get_clean();

return $content;
}

add_shortcode('industries_grid', 'industries');


add_filter( 'gform_confirmation_anchor', '__return_true' );


// Add custom taxonomy terms to body class
            function section_taxonomy_in_body_class( $classes ){
              if( is_singular() )
              {
                global $post;
                $custom_terms = get_the_terms($post->ID, 'subsite');
                if ($custom_terms) {
                  foreach ($custom_terms as $custom_term) {
                    $classes[] = 'section_' . $custom_term->slug;
                  }
                }
              }
              return $classes;
            }
            add_filter( 'body_class', 'section_taxonomy_in_body_class' );


            function custom_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/// fix search results becasue of dumb tailor editor
function replace_content($content)
{
if(is_search()) {
  $content = str_replace('Description', '',$content);
  $content = str_replace('Downloads', '',$content);
  $content = str_replace('Videos', '',$content);
  return $content;
} else {
  return $content;
  }
}

add_filter('the_content','replace_content');


// remove home from search

add_action('pre_get_posts','wpse67626_exclude_posts_from_search');
function wpse67626_exclude_posts_from_search( $query ){

    if( $query->is_main_query() && is_search() ){
         //Exclude posts by ID
         $post_ids = array(2205);
         $query->set('post__not_in', $post_ids);
    }

}
