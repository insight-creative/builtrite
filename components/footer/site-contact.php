<div class="site-contact">
	<?php
  if(get_custom_logo()) {
  	echo get_custom_logo() . '<br>';
  } else {
    echo '<span class="contact-info-title">' . get_bloginfo('name') . '</span><br>';
  }

	$address = nl2br(get_theme_mod('builtrite_address'));
	if ($address != '') {
		echo '<span class="contact-info-address">' . $address . '</span><br>';
	}
	if (get_theme_mod('builtrite_phone') != '') {
		echo '<br><span class="contact-info-phone"><abbr title="Phone Number">PH</abbr>: <a href="tel:' . get_theme_mod('builtrite_phone'). '">' . get_theme_mod('builtrite_phone') . '</a></span><br>';
	}
	if (get_theme_mod('builtrite_email') !='' ) {
		echo '<span class="contact-info-email"><a href="mailto:' . get_theme_mod('builtrite_email'). '"> Email Us </a></span>';
	}
	if (get_theme_mod('builtrite_hours') !='' ) {
		echo '<br><br><span class="contact-info-email">Hours of Operation: '.get_theme_mod('builtrite_hours').'</span>';
	}
	?>


	<div class="footer-top">
	<div class="footer-inner">
	<?php get_template_part( 'components/footer/site', 'morefoot' ); ?>
	<!-- <p class="top-link">
		<a href="#">Back to top</a>
	</p> -->
	<?php
			wp_nav_menu( array(
					'theme_location'    => 'footer-menu',
					'container_class'				=> 'footer-menu',
					'depth'             => 2,
					//'container'         => false,
					'items_wrap' 				=> '%3$s'
			) );
	?>
</div>
</div>

	<?php if ( ! is_active_sidebar( 'sidebar-4' ) ) {
		return;
	} ?>

			<?php dynamic_sidebar( 'sidebar-4' ); ?>
</div><!-- .site-contact -->


<?php

//GET ADDRESS LINE BY LINE
/*
$address = '';
$lines = explode("\n", get_theme_mod('builtrite_address'));
$i = 1;
foreach ($lines as $line) {
  if($i == 1) {
    $address .= '<span>'.$line.'</span>';
  } else {
    $address .= '<br><span>'.$line.'</span>';
  }
  $i++;
}
*/

?>
