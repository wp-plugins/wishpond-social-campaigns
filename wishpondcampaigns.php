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
    <iframe src="<?php echo WISHPOND_SITE_URL; ?>/central/merchant_signups/new?type=campaigns&plain=true&referral=wordpress&autologin=true&utm_campaign=campaigns&utm_source=integration&utm_medium=wordpress&redirect_to=<?php echo WISHPOND_SITE_URL; ?>/central/social_campaigns" width="100%" height="2000" frameBorder="0" onload="scrollToTop()">
    </iframe>
  </div>
  <?php
  echo ob_get_clean();
}

//Admin Tab
function wishpond_campaigns_menu()
{
  add_options_page("Social Campaigns Options", "Social Campaigns", "manage_options", WISHPOND_ADMIN_OPTIONS, "wishpond_campaigns_page");
  add_menu_page("Social Campaigns Options", "Campaigns", "manage_options", WISHPOND_ADMIN_MENU, "wishpond_campaigns_page","",30);
                                            
}
add_action("admin_menu","wishpond_campaigns_menu");

//Add settings menu
function wishpond_campaigns_admin_action_links($links, $file) {
    static $my_plugin;
    if (!$my_plugin) {
        $my_plugin = plugin_basename(__FILE__);
    }
    if ($file == $my_plugin) {
        $settings_link = '<a href="options-general.php?page='. WISHPOND_ADMIN_OPTIONS .'">Settings</a>';
        array_unshift($links, $settings_link);
    }
    return $links;
}
add_filter('plugin_action_links', 'wishpond_campaigns_admin_action_links', 10, 2);

//Automatically redirect after activation
register_activation_hook(__FILE__, 'wishpond_plugin_activate');
add_action('admin_init', 'wishpond_plugin_redirect');

function wishpond_plugin_activate() {
  add_option('wishpond_plugin_do_activation_redirect', true);
}

function wishpond_plugin_redirect() {
  if (get_option('wishpond_plugin_do_activation_redirect', false)) {
    delete_option('wishpond_plugin_do_activation_redirect');
    wp_redirect('options-general.php?page='. WISHPOND_ADMIN_OPTIONS);
  }
}

?>