<?php
/**
 * @package Wishpond
 */

define('WISHPOND_SITE_URL', 'http://www.wishpond.com');
define('WISHPOND_ADMIN_MENU', 'wishpond-social-campaigns-menu');
define('WISHPOND_ADMIN_OPTIONS', 'wishpond-social-campaigns-options');

//Shortcode [wpoffer id="YY" mid="XX" width="810" height="650"]
function wpoffer_func($attrs)
{
  extract(shortcode_atts(array(
    'id' => '',
    'mid' => '',
    'width' => '100%',
    'height' => '650'
  ), $attrs));
  
  if($mid=='')
    return "Missing Social Offer mid";
  else
    return "<iframe width='".$width."' height='".$height."' frameborder='0' src='".WISHPOND_SITE_URL."/sd/".$mid."?container=false&sdid=".$id."&type=Merchant'></iframe>";
}
add_shortcode('wpoffer', 'wpoffer_func');


//Shortcode [wpsweepstakes id="YY" mid="XX" width="810" height="650"]
function wpsweepstakes_func($attrs)
{
  extract(shortcode_atts(array(
    'id' => '',
    'mid' => '',
    'width' => '100%',
    'height' => '650'
  ), $attrs));
  
  if($mid=='')
    return "Missing Social Sweepstakes mid";
  else
    return "<iframe width='".$width."' height='".$height."' frameborder='0' src='".WISHPOND_SITE_URL."/sw/".$mid."?container=false&swid=".$id."&type=Merchant'></iframe>";
}
add_shortcode('wpsweepstakes', 'wpsweepstakes_func');

//Shortcode [wpphotocontest id="YY" mid="XX" width="810" height="650"]
function wpphotocontest_func($attrs)
{
  extract(shortcode_atts(array(
    'id' => '',
    'mid' => '',
    'width' => '100%',
    'height' => '650'
  ), $attrs));
  
  if($mid=='')
    return "Missing Social Sweepstakes mid";
  else
    return "<iframe width='".$width."' height='".$height."' frameborder='0' src='".WISHPOND_SITE_URL."/sbpc/".$mid."?container=false&pcid=".$id."&type=Merchant'></iframe>";
}
add_shortcode('wpphotocontest', 'wpphotocontest_func');

//Shortcode [wpphotocontest id="YY" mid="XX" width="810" height="650"]
function wpVoteContest_func($attrs)
{
  extract(shortcode_atts(array(
    'id' => '',
    'mid' => '',
    'width' => '100%',
    'height' => '650'
  ), $attrs));
  
  if($mid=='')
    return "Missing Social Sweepstakes mid";
  else
    return "<iframe width='".$width."' height='".$height."' frameborder='0' src='".WISHPOND_SITE_URL."/vc/".$mid."?container=false&pcid=".$id."&type=Merchant'></iframe>";
}
add_shortcode('wpphotocontest', 'wpphotocontest_func');

?>