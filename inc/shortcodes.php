<?php // shortcodes
function name_code() {
  $name = get_bloginfo('name');
  return $name;
}
add_shortcode('name', 'name_code');

function phone_code() {
  if (get_theme_mod('builtrite_phone')=='')
    return;
  $phone = '<a href="tel:' . get_theme_mod('builtrite_phone') . '">' . get_theme_mod('builtrite_phone') . '</a>';
  return $phone;
}
add_shortcode('phone', 'phone_code');

//Address
function address_code($atts) {
  if (get_theme_mod('builtrite_address')=='')
    return;
  extract( shortcode_atts( array(
    'format' => true
  ), $atts ) );
  if($format === true) {
    $addy = nl2br(get_theme_mod('builtrite_address'));
  } else {
    $lines = preg_split( "/\\r\\n|\\r|\\n/", get_theme_mod('builtrite_address') );
    $count = count($lines);
    $addy = '';

    for( $i = 0; $i <= $count; $i++ ) {
      $addy .= $lines[$i];
      if($i < $count - 1) {
        $addy .= ', ';
      }
    }//for
  }//else

  return $addy;
}
add_shortcode('address', 'address_code');

// Email
function email_code() {
  if (get_theme_mod('builtrite_email')=='')
    return;
  $e = '<a href="mailto:' . get_theme_mod('builtrite_email') . '">' . get_theme_mod('builtrite_email') . '</a>';
  return $e;
}
add_shortcode('email', 'email_code');



// DEALERS SHORTCODE


function dealer_code($content) {
  ob_start();
  echo '<br>';
  get_template_part('inc/acf/map');
  echo '<br><section id="dealers"><div class="tailor-grid"><h2>I. Truck Mounted Material Handlers</h2>';
  $args = array( 'post_type' => 'dealer',
                 'posts_per_page' => -1,
                 'orderby' => 'title',
                 'order'   => 'ASC',
                 'meta_key'		=> 'category',
	               'meta_value'	=> array('truck', 'both'),

              );
  $loop = new WP_Query( $args );
  if ( $loop->have_posts() ) :
    while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <?php get_template_part('inc/acf/dealer'); ?>
  <?php endwhile; endif; wp_reset_postdata();
  echo '</div>';
  echo '<hr><div class="tailor-grid">';
  echo '<h2>II. Attachments & Stationary Electric Material Handlers - Scrap / Waste Handling</h2>';
  $args2 = array( 'post_type' => 'dealer',
                 'posts_per_page' => -1,
                 'orderby' => 'title',
                 'order'   => 'ASC',
                 'meta_key'		=> 'category',
	               'meta_value'	=> array('attach', 'both'),

              );
  $loop2 = new WP_Query( $args2 );
  if ( $loop2->have_posts() ) :
    while ( $loop2->have_posts() ) : $loop2->the_post(); ?>
    <?php get_template_part('inc/acf/dealer'); ?>
  <?php endwhile; endif; wp_reset_postdata();
  echo '</div>';

  echo '</section>';
  $content = ob_get_clean();
  return $content;
}
add_shortcode('dealers', 'dealer_code');
