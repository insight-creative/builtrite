<?php


//CONTACT INFO
class builtrite_contact_info_widget extends WP_Widget {

	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Contact Info' );
	}

	function widget( $args, $instance ) {

    extract($args, EXTR_SKIP);

    echo $before_widget;
    $title = empty($instance['title']) ? 'Contact Info' : apply_filters('widget_title', $instance['title']);

    if ($title === ' ') {
      //do nothing
	} else {
		echo $before_title . $title . $after_title;
	}

  echo '<span class="contact-info-title">' . get_bloginfo('name') . '</span><br>';
	echo '<span class="contact-info-address">' . nl2br(get_theme_mod('builtrite_address')) . '</span><br>';
	echo '<span class="contact-info-phone"><abbr title="Phone Number">PH</abbr>: ' . get_theme_mod('builtrite_phone') . '</span><br>';
	echo '<span class="contact-info-email"><abbr title="Email Address">E</abbr>: ' . get_theme_mod('builtrite_email') . '</span>';

	echo $after_widget;

    }

	function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }

	 function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
	?>
	  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<?php
	  }
}

// type widget

//CONTACT INFO
class builtrite_type_widget extends WP_Widget {

	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Product Types' );
	}

	function widget( $args, $instance ) {

    extract($args, EXTR_SKIP);

    echo $before_widget;
    $title = empty($instance['title']) ? 'Product Categories' : apply_filters('widget_title', $instance['title']);

    if ($title === ' ') {
      //do nothing
	} else {
		echo $before_title . $title . $after_title;
	}

	$tax_terms = get_terms('type', array('hide_empty' => false));

	echo '<ul class="product-cat-list">';

	global $post;
	$object = get_queried_object();
	$query_id = $object->term_id;



	foreach($tax_terms as $term) {
		//print_r($object);
		//print_r($term);
					if($term->term_id === $query_id) {
						$class ='class="current-menu-item"';
					} else {
						$class = '';
					}
					if($term->parent != 0) {
						$sub = 'class="sub-cat" data-attr="'.$term->slug.'"';
					} else {
						$sub = '';
					}
				$link  = get_term_link($term->term_id);
				echo '<li '.$sub.'><a '.$class.' href="'.$link.'">'.$term->name.'</a></li>';
			}
	echo '<li><a href="/automobile-processing">Auto Processing</a></li>';
	echo '</ul>';

	//echo get_queried_object()->term_id;



	echo $after_widget;

    }

	function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }

	 function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
	?>
	  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<?php
	  }
}

// industry widget

//CONTACT INFO
class builtrite_industry_widget extends WP_Widget {

	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Product Industries' );
	}

	function widget( $args, $instance ) {

    extract($args, EXTR_SKIP);

    echo $before_widget;
    $title = empty($instance['title']) ? 'Industries' : apply_filters('widget_title', $instance['title']);

    if ($title === ' ') {
      //do nothing
	} else {
		echo $before_title . $title . $after_title;
	}

	$tax_terms = get_terms('industry', array('hide_empty' => false));

	echo '<ul class="product-cat-list">';
	global $post;
	$query_id = get_queried_object()->term_id;

	foreach($tax_terms as $term) {
		if($term->term_id === $query_id) {
			$class ='class="current-menu-item"';
		} else{
			$class = '';
		}
				$link  = get_term_link($term->term_id);
				echo '<li><a '.$class.' href="'.$link.'">'.$term->name.'</a></li>';
			}
	echo '</ul>';

	//echo get_queried_object()->term_id;;


	echo $after_widget;

    }

	function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }

	 function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
	?>
	  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<?php
	  }
}



function builtrite_register_widgets() {
	register_widget( 'builtrite_contact_info_widget' );
	register_widget( 'builtrite_type_widget' );
	register_widget( 'builtrite_industry_widget' );
}

add_action( 'widgets_init', 'builtrite_register_widgets' );
