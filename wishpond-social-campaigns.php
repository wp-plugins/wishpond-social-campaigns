<?php
/**
 * @package Wishpond
 */
/*
Plugin Name: Wishpond Social Promotions
Plugin URI: http://corp.wishpond.com/social-promotions
Description: Run promotional campaigns on your WordPress site that spread quickly on Facebook and Twitter and drive new customers.
Version: 1.3.1
Author: Wishpond
Author URI: http://corp.wishpond.com

/*  Copyright 2014 Wishpond  ( email : support@wishpond.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

include_once dirname( __FILE__ ) . '/social_campaign_widget.php';
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
    <?php
    $current_user = wp_get_current_user();
    $signup_url = WISHPOND_SITE_URL . "/central/merchant_signups/new?type=wp_campaigns&plain=true&referral=wordpress&autologin=true&utm_campaign=campaigns&utm_source=integration&utm_medium=wordpress&email=" . $current_user->user_email . "&key=" . urlencode(php_uname("n") . site_url()) . "&redirect_to=" . WISHPOND_SITE_URL . "/central/social_campaigns"
?>
    <iframe src="<?php echo $signup_url ?>" width="100%" height="2000" frameBorder="0" onload="scrollToTop()">
    </iframe>
  </div>
  <?php
  echo ob_get_clean();
}

//Admin Tab
function wishpond_campaigns_menu()
{
  add_options_page("Social Promotions Options", "Social Promotions", "manage_options", WISHPOND_ADMIN_OPTIONS, "wishpond_campaigns_page");
  add_menu_page("Social Promotions Options", "Promotions", "manage_options", WISHPOND_ADMIN_MENU, "wishpond_campaigns_page","",30);

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

//For WP e-commerce
if (is_admin()) {
  function wpsc_add_modules_admin_pages($page_hooks, $base_page) {
  $page_hooks[] = add_submenu_page($base_page, __('Promotions','wpsc'), __('Promotions','wpsc'), 7, 'wishpond-social-campaigns-menu', 'wpsc_display_admin_pages');
  return $page_hooks;
}
add_filter('wpsc_additional_pages', 'wpsc_add_modules_admin_pages',10, 2);
}
?>
