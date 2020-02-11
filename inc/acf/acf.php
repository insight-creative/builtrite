<?php //hide widget titles
function my_dynamic_sidebar_params( $params ) {

 // get widget name & id
 $widget_name = $params[0]['widget_name'];
 $widget_id = $params[0]['widget_id'];

 $hide = get_field('hide_widget_title','widget_' . $widget_id);
 if ( $hide ) {
     $params[0]['before_title'] = '<div class="sr-only">';
     $params[0]['after_title'] = '</div>';
 }

 if( $widget_name == 'Contact Info' ) {
   $logo = get_field('show_custom_logo','widget_' . $widget_id);
   if($logo) {
     $params[0]['after_title'] = $params[0]['after_title'] . get_custom_logo() . '<br>';
   }
 }

 // return
 return $params;

}

add_filter('dynamic_sidebar_params', 'my_dynamic_sidebar_params');

//add hide widget title field

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_585ae0406c903',
	'title' => 'Hide Widget Titles',
	'fields' => array (
		array (
			'key' => 'field_585ae04ee0206',
			'label' => '',
			'name' => 'hide_widget_title',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 0,
			'message' => 'Hide widget title?',
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'widget',
				'operator' => '==',
				'value' => 'all',
			),
		),
	),
	'menu_order' => 10,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;
