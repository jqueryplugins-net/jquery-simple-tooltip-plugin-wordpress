<?php
/**
 * Plugin Name: The plugin's name
 * Plugin URI: https://jqueryplugins.net/
 * Description: Add a description of what your plugin does - this will be shown on the plugins admin page.
 * Version: 1.0
 * Author: jqueryplugins.net
 * Author URI: https://jqueryplugins.net/
 */

//main function
function jquery-simple-tooltip-plugin-wordpress_shortcode($attributes, $content = “” ) {
//enqueue javascript - lazyloaded.
  wp_enqueue_script('jquery_tooltip_text_highlighter_script');
  // start output buffer
  ob_start();
  //check if tooltip text is included, if not display message showing how to add to shortcode
  $attr =$attributes['text'];
  if (is_null($attr)) {
    $attr = 'Make sure to include Tool Tip hover text in the shortcode - example: [TT text="I\'ll be back"]example text[/TT]';}
    // check to see if any wrapped text was passed in
    if( $content == '' ) {
        // no wrapped text was passed in
        
    } else {
        // wrapped content is in $content
        // it's possible content contains other shortcodes needing handled
        $content = do_shortcode( $content );
        // let's do something
    }
   ?> 
<span title="<?php echo $attr; ?> " class="masterTooltip"><?php echo $content; ?></span>
  <?php return ob_get_clean();
}
add_shortcode( 'TT', 'jquery-simple-tooltip-plugin-wordpress_shortcode' );

// add scripts and stylesheets
function jquery-simple-tooltip-plugin-wordpress_add_script() {
  wp_register_script('jquery_tooltip_text_highlighter_script', plugins_url('/js/jquery-simple-tooltip-plugin-wordpress.js', __FILE__), '', '', true ); 
}
add_action( 'wp_enqueue_scripts', 'jquery-simple-tooltip-plugin-wordpress_add_script' );