<?php
/**
 * @package Wishpond
 */

include_once dirname( __FILE__ ) . '/common.php';

class WishpondSocialCampaignPostWidget extends WP_Widget
{
  function WishpondSocialCampaignPostWidget()
  {
    $widget_ops = array('classname' => 'WishpondSocialCampaignPostWidget', 'description' => 'Use this widget to add the Social Campaign you have created through the Campaign menu to your pages' );
    $this->WP_Widget('WishpondSocialCampaignPostWidget', 'Wishpond Social Campaign', $widget_ops);
  }

  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'merchant_id' => '' ) );
    $merchant_id = $instance['merchant_id'];

?>
  <p>
    <label for="<?php echo $this->get_field_id('merchant_id'); ?>">
      Merchant ID: <input class="widefat" id="<?php echo $this->get_field_id('merchant_id'); ?>" name="<?php echo $this->get_field_name('merchant_id'); ?>" type="text" value="<?php echo attribute_escape($merchant_id); ?>" />
    </label>
  </p>
  <p>You can get your Merchant ID by logging into your account through the <a href="admin.php?page=<?php echo WISHPOND_ADMIN_MENU; ?>">Campaigns</a> menu.</p>
<?php
  }

  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['merchant_id'] = $new_instance['merchant_id'];
    return $instance;
  }

  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);

    $merchant_id = $instance['merchant_id'];

    if (empty($merchant_id))
    {
      echo "<h1>Missing Merchant ID</h1>";
    }
    else
    {
      echo wpsc_func(array('merchant_id' => $merchant_id));
    }
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("WishpondSocialCampaignPostWidget");') );
?>
