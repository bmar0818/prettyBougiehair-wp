<?php
/*
Plugin Name: Parallax Scrolling Enllax.js
Plugin URI: https://nagysandor.org/bovitmenyek/
Description: An ultra-lightweight and super easy to use plugin for applying parallax scrolling effect to any scrolling element. You can set parallax scrolling effects to background elements, and also in both directions (vertically or horizontally).
Version: 0.0.6
Author: Nagy Sandor
Author URI: https://nagysandor.org/
License: GPLv2
*/

// Language file
function myplugin_init() {
 $plugin_dir = basename(dirname(__FILE__));
 load_plugin_textdomain( 'parallax_scrolling_enllax', false, $plugin_dir."/lang" );
}
add_action('plugins_loaded', 'myplugin_init');

// Initial data load
$enllax_default_css = '.enllax{color:#fff;padding:100px;}
@media screen and (max-width: 1000px) {.enllax{padding:80px;}}
@media screen and (max-width: 800px) {.enllax{padding:60px;}}
@media screen and (max-width: 600px) {.enllax{padding:45px;}}
@media screen and (max-width: 400px) {.enllax{padding:30px;}}';
$enllax_options = get_option( 'parallax_scrolling_enllax_settings' );
if (!isset($enllax_options['parallax_scrolling_enllax_textarea_field_0'])) {
$enllax_default_options=array('parallax_scrolling_enllax_textarea_field_0'=>$enllax_default_css);
add_option( 'parallax_scrolling_enllax_settings', $enllax_default_options, '', 'yes' );
}
// Reset data
if (isset($_POST['enllaxreset'])) {
$enllax_default_options=array('parallax_scrolling_enllax_textarea_field_0'=>$enllax_default_css);
update_option( 'parallax_scrolling_enllax_settings', $enllax_default_options, '', 'yes' );
}

add_action( 'admin_menu', 'parallax_scrolling_enllax_add_menu' );
add_action( 'admin_init', 'parallax_scrolling_enllax_settings_init' );

function parallax_scrolling_enllax_add_menu() { 
add_options_page( 'Enllax', 'Enllax', 'manage_options', 'enllax', 'parallax_scrolling_enllax_page' );
}

function parallax_scrolling_enllax_settings_init(  ) {
register_setting( 'parallax_scrolling_enllax_pluginPage', 'parallax_scrolling_enllax_settings' );
add_settings_section(
'parallax_scrolling_enllax_pluginPage_section',
__( 'CSS setting', 'parallax_scrolling_enllax' ),
'parallax_scrolling_enllax_settings_section_callback',
'parallax_scrolling_enllax_pluginPage'
);
add_settings_field(
'parallax_scrolling_enllax_textarea_field_0',
__( 'Customize your CSS', 'parallax_scrolling_enllax' ),
'parallax_scrolling_enllax_textarea_field_0_render',
'parallax_scrolling_enllax_pluginPage',
'parallax_scrolling_enllax_pluginPage_section'
);
}

// CSS customize textarea
function parallax_scrolling_enllax_textarea_field_0_render(  ) {
$options = get_option( 'parallax_scrolling_enllax_settings' );
?>
<textarea cols='60' rows='5' name='parallax_scrolling_enllax_settings[parallax_scrolling_enllax_textarea_field_0]'><?php echo $options['parallax_scrolling_enllax_textarea_field_0']; ?></textarea>
<?php
}

// CSS description
function parallax_scrolling_enllax_settings_section_callback(  ) {
echo __( 'You can change the appearance of the parallax image by modifying the css. Use enllax class in CSS.', 'parallax_scrolling_enllax' );
}

// Setting page content
function parallax_scrolling_enllax_page(  ) {
echo '<h1>Parallax Scrolling Enllax.js</h1>';
echo '<p>'. __('An ultra-lightweight and super easy to use plugin for applying parallax scrolling effect to any scrolling element. You can set parallax scrolling effects to background elements, and also in both directions (vertically or horizontally)','parallax_scrolling_enllax' ).'</p>';
echo '<form action=\'options.php\' method=\'post\'>';
settings_fields( 'parallax_scrolling_enllax_pluginPage' );
do_settings_sections( 'parallax_scrolling_enllax_pluginPage' );
submit_button();
echo '</form>
<form method="post" action=""><p class="submit">'. __('Reset to defaults:','parallax_scrolling_enllax' ).' <input name="enllaxreset" class="button button-secondary" type="submit" value="'. __('Reset','parallax_scrolling_enllax' ).'" ><input type="hidden" name="action" value="enllaxreset" /></p>
</form>';
echo '<h2>'. __('Shortcode usage examples:','parallax_scrolling_enllax' ).'</h2>';
echo '<h3>'. __('Basic','parallax_scrolling_enllax' ).'</h3>';
echo '<p>[enllax img="'.plugins_url().'/parallax-scrolling-enllax-js/demo.jpg"]</p>';
echo '<p>'. __('Your content.','parallax_scrolling_enllax' ).'</p>';
echo '<p>[enllaxend]</p>';
echo '<p>'. __('Or use a blog content:','parallax_scrolling_enllax' ).'</p>';
echo '<p>[enllax_post postid=\'1\']</p>';
echo '<h3>'. __('Advanced','parallax_scrolling_enllax' ).'</h3>';
echo '<p>[enllax xclass="enllax" offset="0" direction="horizontal" speed="0.8" img="'.plugins_url().'/parallax-scrolling-enllax-js/demo.jpg"]</p>';
echo '<p>'. __('Your content.','parallax_scrolling_enllax' ).'</p>';
echo '<p>[enllaxend]</p>';
echo '<p>'. __('Or use a blog content:','parallax_scrolling_enllax' ).'</p>';
echo '<p>[enllax_post postid="1" enllax xclass="enllax" offset="0" direction="horizontal" speed="0.8"]</p>';
echo '<h3>'. __('Settings','parallax_scrolling_enllax' ).'</h3>';
echo '<p>'. __('xclass: CSS class name (default: enllax)','parallax_scrolling_enllax' ).'</p>';
echo '<p>'. __('offset: background offset in pixel (default: 0)','parallax_scrolling_enllax' ).'</p>';
echo '<p>'. __('direction: vertical (default) or horizontal','parallax_scrolling_enllax' ).'</p>';
echo '<p>'. __('speed: to allow background image to move with different speed, just use a data attribute with a numeric value as a multiplier for scrolling speed, less is slower and 1 is normal (default value: 0.5)','parallax_scrolling_enllax' ).'</p>';
echo '<p>'. __('img: Parallax background image url','parallax_scrolling_enllax' ).'</p>';
echo '<h3>'. __('Enllax.js homepage','parallax_scrolling_enllax' ).'</h3>';
echo '<a href="https://github.com/mmkjony/enllax.js/tree/master" target="_blank">' . __('Homepage on Github','parallax_scrolling_enllax' ).'</a>';
}

// Inline CSS load
function parallax_scrolling_enllax_style() {
$options = get_option( 'parallax_scrolling_enllax_settings' );
echo "<style>
".$options['parallax_scrolling_enllax_textarea_field_0']."
</style>";
}
add_action('wp_head', 'parallax_scrolling_enllax_style');

// enllax shortcode
function parallax_scrolling_enllax_func( $atts ) {
extract(shortcode_atts( array(
'xclass' => 'enllax',
'offset' => '0',
'direction' => 'vertical',
'speed' => '0.5',
'img' => 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAA0JCgsKCA0LCgsODg0PEyAVExISEyccHhcgLikxMC4pLSwzOko+MzZGNywtQFdBRkxOUlNSMj5aYVpQYEpRUk//wAALCACWAMgBAREA/8QAGQABAAMBAQAAAAAAAAAAAAAAAAMEBQIG/8QALxAAAQQCAQIEAwgDAAAAAAAAAAECAwQFERITIQYUMUEjUWEVFiIyQlJxgZGh0f/aAAgBAQAAPwDBAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABp4fCWsw2d1WSFvQ47SRyptXb0idvoV8djp8hkmUIlayZ6uT4m0RFRFVd9voVACe1W8v0fjwy9WJsnwn8uG/0u+Tk90IAAAAAAAAADewsr4PDmamicrXsdWc1U9lSRTXx0TLHijGZiu1EiupJ1Gp+iVGO5J/fqYuLjq08LNlrFZlqTrpBDHJ+RF1yVVT37ElnyuWwdm8ylDUs03sR6QJxY9rl0nb2XZgHo7Vau3M+HY2wRIyavWWRqMTT1V3dVT32WfPUE8RuxbcLSSu+0sLnK3b9q7W0X2T6Icx28fFnUw7MNUWv5jy7nvRXSL+Ljy5exFjKMsF/JRV8fUsxwTLGk1xfhxoiqn9qvb/B34iowJhYbzY6DLCWOi/yLtxqitVe6ey9v9nGQnqYCZMdFjKlmWNjVnlss5q5yoi9vknckuY6tkM9hq8MEdaK1Tjke2JNfucv8rpNbU04sVZkspWm8M1IqDnceoj29Vrf3cuW1+Z4m7B5W9Yrb30ZHR7+el0QgAAAAGjSvxV8Nkqb2vWS30uCoiaTi7a77l7wvnosQ+RlyOSSBV5sRiIqsfrW02qeqKqFXF5KtDTmx+RgfLUmcj/hrp8b090329Du9kqLMa7HYiCZkMr0fNJOqK9+vRO3ZEMc2Z8tXkyWHstZLwowwRyIqJtVYu113/wCFfz8X3k+0uL+j5zr8dJy48+WvXW9fUefi+8n2lxf0fOdfjpOXHny1663r6l9uYx1ht+rkIbK1bFt1qN0KtR7VXfZUXt6EN/JY5+CTG0K88XG11uUjkdyTjrar7L9ETXY1Za8eTjr28jh8o+0+Jv46qIscya7Kq+3bRVz99aGeoS1WNjkpVo2Oj5ckYqb2zfv2XRWdY8NSuWZ9TIRvd3WKN7VZv6KvfRjTujfPI6FixxK5VYxV3xTfZN+5wAAAAAAAAAAWo8jfiiSKO7ZZGiaRjZXImv42VVVVVVVdqvuAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAf/2Q==',
), $atts ));
return '<div class="'.$xclass.'" style="background: url('.$img.');" data-enllax-bgoffset="'.$offset.'" data-enllax-ratio="'.$speed.'" data-enllax-direction="'.$direction.'">';
}
add_shortcode( 'enllax', 'parallax_scrolling_enllax_func' );

// enllaxend shortcode
function parallax_scrolling_enllax_func_end( $atts ) {
return '</div>';
}
add_shortcode( 'enllaxend', 'parallax_scrolling_enllax_func_end' );

// Show shortcode in Posts list
add_filter( 'manage_posts_columns', 'revealid_add_id_column_enllax', 5 );
add_action( 'manage_posts_custom_column', 'revealid_id_column_content_enllax', 5, 2 );
function revealid_add_id_column_enllax( $enllax_columns ) {
   $enllax_columns['revealid_id'] = 'Enllax Shortcode';
   return $enllax_columns;
}
function revealid_id_column_content_enllax( $column, $id ) {
  if( 'revealid_id' == $column ) {
    echo '[enllax_post postid="'.$id.'"]';
  }
}
// enllax_post shortcode
function parallax_scrolling_enllax_func2( $atts ) {
extract(shortcode_atts( array(
'postid' => '1',
'xclass' => 'enllax',
'offset' => '0',
'direction' => 'vertical',
'speed' => '0.5',
), $atts ));
if (get_post_thumbnail_id( $postid )) {$enllaximage = wp_get_attachment_url( get_post_thumbnail_id( $postid ));} else {$enllaximage = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAA0JCgsKCA0LCgsODg0PEyAVExISEyccHhcgLikxMC4pLSwzOko+MzZGNywtQFdBRkxOUlNSMj5aYVpQYEpRUk//wAALCACWAMgBAREA/8QAGQABAAMBAQAAAAAAAAAAAAAAAAMEBQIG/8QALxAAAQQCAQIEAwgDAAAAAAAAAAECAwQFERITIQYUMUEjUWEVFiIyQlJxgZGh0f/aAAgBAQAAPwDBAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABp4fCWsw2d1WSFvQ47SRyptXb0idvoV8djp8hkmUIlayZ6uT4m0RFRFVd9voVACe1W8v0fjwy9WJsnwn8uG/0u+Tk90IAAAAAAAAADewsr4PDmamicrXsdWc1U9lSRTXx0TLHijGZiu1EiupJ1Gp+iVGO5J/fqYuLjq08LNlrFZlqTrpBDHJ+RF1yVVT37ElnyuWwdm8ylDUs03sR6QJxY9rl0nb2XZgHo7Vau3M+HY2wRIyavWWRqMTT1V3dVT32WfPUE8RuxbcLSSu+0sLnK3b9q7W0X2T6Icx28fFnUw7MNUWv5jy7nvRXSL+Ljy5exFjKMsF/JRV8fUsxwTLGk1xfhxoiqn9qvb/B34iowJhYbzY6DLCWOi/yLtxqitVe6ey9v9nGQnqYCZMdFjKlmWNjVnlss5q5yoi9vknckuY6tkM9hq8MEdaK1Tjke2JNfucv8rpNbU04sVZkspWm8M1IqDnceoj29Vrf3cuW1+Z4m7B5W9Yrb30ZHR7+el0QgAAAAGjSvxV8Nkqb2vWS30uCoiaTi7a77l7wvnosQ+RlyOSSBV5sRiIqsfrW02qeqKqFXF5KtDTmx+RgfLUmcj/hrp8b090329Du9kqLMa7HYiCZkMr0fNJOqK9+vRO3ZEMc2Z8tXkyWHstZLwowwRyIqJtVYu113/wCFfz8X3k+0uL+j5zr8dJy48+WvXW9fUefi+8n2lxf0fOdfjpOXHny1663r6l9uYx1ht+rkIbK1bFt1qN0KtR7VXfZUXt6EN/JY5+CTG0K88XG11uUjkdyTjrar7L9ETXY1Za8eTjr28jh8o+0+Jv46qIscya7Kq+3bRVz99aGeoS1WNjkpVo2Oj5ckYqb2zfv2XRWdY8NSuWZ9TIRvd3WKN7VZv6KvfRjTujfPI6FixxK5VYxV3xTfZN+5wAAAAAAAAAAWo8jfiiSKO7ZZGiaRjZXImv42VVVVVVVdqvuAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAf/2Q==';}
$page_for_posts_obj = get_post( $postid );
$enllaxcontent = wpautop(apply_filters( 'the_content', $page_for_posts_obj->post_content ));
return '<div class="'.$xclass.'" style="background: url('.$enllaximage.');" data-enllax-bgoffset="'.$offset.'" data-enllax-ratio="'.$speed.'" data-enllax-direction="'.$direction.'">'.$enllaxcontent.'</div>';}
add_shortcode( 'enllax_post', 'parallax_scrolling_enllax_func2' );

// Footer script
function footer_enllax_script() {
echo '
<script src="'.plugin_dir_url( __FILE__ ).'jquery.enllax.min.js"></script>
<script>(function($){$(window).enllax();})(jQuery);</script>
';
}
add_action( 'wp_footer', 'footer_enllax_script', 999 );

//TinyMCE plugin
function enllax_plugin_scripts($plugin_array)
{
$plugin_array["enllax_button_plugin"] =  plugin_dir_url(__FILE__) . "enllax-button.js";
return $plugin_array;
}
add_filter("mce_external_plugins", "enllax_plugin_scripts");
function enllax_register_buttons_editor($buttons)
{
array_push($buttons, "enllax_button");
return $buttons;
}
add_filter("mce_buttons", "enllax_register_buttons_editor");

// Add setting link to plugin bar
function plugin_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=enllax">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'plugin_add_settings_link' );
