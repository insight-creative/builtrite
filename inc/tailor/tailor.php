<?php
//TAILOR STUFF TODO: MOVE TO SEPARATE FILE

// TAILOR EDITS

//wysiswyg buttons
function my_tailor_editor( $editor_settings ) {
$editor_settings = array(
    'textarea_rows'     =>  30,
    'tinymce'           =>  array(
        'toolbar1'          =>  'formatselect,bold,italic,bullist,numlist,blockquote,link,unlink,wp_adv',//'bold,italic,bullist,numlist,blockquote,tailoricon,wp_adv',
        'toolbar2'          =>  'alignleft,aligncenter,alignright,tailoricon,strikethrough,hr,forecolor,removeformat,charmap,outdent,indent,undo,redo,wp_help',//'link,unlink,alignleft,aligncenter,alignright,alignjustify,outdent,indent',
        'toolbar3'          =>  '',//'forecolor,hr,strikethrough,pastetext,removeformat,undo,redo',
        'toolbar4'          =>  '',//'fontselect,fontsizeselect,formatselect,styleselect',
    ),
  );

  return $editor_settings;
}

add_filter( 'tailor_editor_settings', 'my_tailor_editor' );

//editor css overrides
function custom_tailor_editor_css() {
	echo '
		<style>
			.modal-container { min-width: 404px; }
		</style>
';
}

add_action('tailor_sidebar_head', 'custom_tailor_editor_css');


function remove_tailor_frontend_stylesheet() {
  return false;
}

//add_filter( 'tailor_enable_frontend_styles', 'remove_tailor_frontend_stylesheet' ) ;

///PHP HEX COLOR ADJUSTER
function adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $color) {
        $color   = hexdec($color); // Convert to decimal
        $color   = max(0,min(255,$color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }

    return $return;
}
