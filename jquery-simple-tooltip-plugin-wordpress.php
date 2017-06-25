<?php
/**
 * Plugin Name: Jquery Simple ToolTip Plugin
 * Plugin URI: https://jqueryplugins.net/
 * Description: Simple, Lightweight jquery tooltip plugin - add to any post, page or text widget using shortcode.  Example shortcode: [TT text="Hover Text"]example text[/TT]
 * Version: 1.0
 * Author: jqueryplugins.net
 * Author URI: https://jqueryplugins.net/
 */
// add scripts and stylesheets
function jquery_simple_tooltip_plugin_wordpress_add_script() {
  wp_register_script('jquery_simple_tooltip_plugin_wordpress_script', plugins_url('/js/jquery-simple-tooltip-plugin-wordpress.js', __FILE__), '', '', true ); }
add_action( 'wp_enqueue_scripts', 'jquery_simple_tooltip_plugin_wordpress_add_script' );
//main function- shortcode
function jquery_simple_tooltip_plugin_wordpress_shortcode($attributes, $content = “” ) {
//enqueue javascript and css - lazyloaded.
  wp_enqueue_script('jquery_simple_tooltip_plugin_wordpress_script');
  // start output buffer
  ob_start();
  //check if tooltip text is included, if not display message showing how to add to shortcode
 $attr =$attributes['text'];
  if (is_null($attr)) {
    $attr = 'Make sure to include Tool Tip hover text in the shortcode - example: [TT text="I\'ll be back"]example text[/TT]';}
    // check to see if any wrapped text was passed in - if not add default text
    if( $content == '' ) {
        // no wrapped text was passed in
      $content = 'wrap the [TT] shortcodes in text to activate the tooltip';
    } else {
        // wrapped content is in $content
        // it's possible content contains other shortcodes needing handled
        $content = do_shortcode( $content );
        // let's do something
    }
   ?> 
<style>.tooltip{display:none;position:absolute;border:1px solid #333;background-color:#161616;border-radius:5px;padding:10px;color:#fff;font-size:12px Arial}</style>
<span title="<?php echo $attr;?> " class="jQueryTooltip"><?php echo $content;?></span>
  <?php return ob_get_clean();}
add_shortcode( 'TT', 'jquery_simple_tooltip_plugin_wordpress_shortcode' );
