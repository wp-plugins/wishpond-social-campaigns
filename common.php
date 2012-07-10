<?php
/**
 * @package Wishpond
 */

define('WISHPOND_SITE_URL', 'http://www.wishpond.com');
define('WISHPOND_ADMIN_MENU', 'wishpond-social-campaigns-menu');

//Shortcode [wpoffer mid="XX" width="810" height="650"]
function wpoffer_func($attrs)
{
  extract(shortcode_atts(array(
    'mid' => '',
    'width' => '100%',
    'height' => '650'
  ), $attrs));
  
  if($mid=='')
    return "Missing Social Offer mid";
  else
    return "<iframe width='".$width."' height='".$height."' frameborder='0' src='".WISHPOND_SITE_URL."/sd/".$mid."?container=false'></iframe>";
}
add_shortcode('wpoffer', 'wpoffer_func');


//Shortcode [wpsweepstakes mid="XX" width="810" height="650"]
function wpsweepstakes_func($attrs)
{
  extract(shortcode_atts(array(
    'mid' => '',
    'width' => '100%',
    'height' => '650'
  ), $attrs));
  
  if($mid=='')
    return "Missing Social Sweepstakes mid";
  else
    return "<iframe width='".$width."' height='".$height."' frameborder='0' src='".WISHPOND_SITE_URL."/sw/".$mid."?container=false'></iframe>";
}
add_shortcode('wpsweepstakes', 'wpsweepstakes_func');

?>