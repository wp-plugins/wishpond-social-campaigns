<?php
/**
 * @package Wishpond
 */
/*
Plugin Name: Wishpond Social Campaigns
Plugin URI: http://corp.wishpond.com/social-campaigns/
Description: Create your own viral promotional campaigns that spread quickly through social networks.
Version: 1.0
Author: Wishpond
Author URI: http://www.wishpond.com
*/

include_once dirname( __FILE__ ) . '/social_discount_widget.php';
include_once dirname( __FILE__ ) . '/sweepstakes_widget.php';
include_once dirname( __FILE__ ) . '/common.php';

/**************
Global
**************/

//Admin Page
function wishpond_campaigns_page()
{
  ob_start();?>
  <div class="wrap">
    <script language="javascript"> 
      function scrollToTop() { 
        scroll(0,0); 
      } 
    </script>
    <iframe src="<?php echo WISHPOND_SITE_URL; ?>/central/sessions/new?type=campaigns&plain=true&referral=wordpress&autologin=true&utm_campaign=campaigns&utm_source=integration&utm_medium=wordpress&redirect_to=<?php echo WISHPOND_SITE_URL; ?>/central/social_campaigns" width="100%" height="2000" frameBorder="0" onload="scrollToTop()">
    </iframe>
  </div>
  <?php
  echo ob_get_clean();
}

//Admin Tab
function wishpond_campaigns_menu()
{
  add_options_page("Social Campaigns Options", "Social Campaigns", "manage_options", "wishpond-social-campaigns-options", "wishpond_campaigns_page");
  add_menu_page("Social Campaigns Options", "Campaigns", "manage_options", WISHPOND_ADMIN_MENU, "wishpond_campaigns_page","",30);
                                            
}
add_action("admin_menu","wishpond_campaigns_menu");

?>