<?php
/**
 * @package Wishpond
 */

include_once dirname( __FILE__ ) . '/common.php';

class WishpondSocialDiscountPostWidget extends WP_Widget
{
  function WishpondSocialDiscountPostWidget()
  {
    $widget_ops = array('classname' => 'WishpondSocialDiscountPostWidget', 'description' => 'Use this widget to add the Social Offer you have created through the Campaign menu to your pages' );
    $this->WP_Widget('WishpondSocialDiscountPostWidget', 'Wishpond Social Offer', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'merchant_id' => '' ) );
    $merchant_id = $instance['merchant_id'];
    $social_discount_height = empty($instance['social_discount_height']) ? "500" : $instance['social_discount_height'];

?>
  <p>
    <label for="<?php echo $this->get_field_id('merchant_id'); ?>">
      Merchant ID: <input class="widefat" id="<?php echo $this->get_field_id('merchant_id'); ?>" name="<?php echo $this->get_field_name('merchant_id'); ?>" type="text" value="<?php echo attribute_escape($merchant_id); ?>" />
    </label>
  </p>
  <p>You can get your Merchant ID by logging into your account through the <a href="admin.php?page=<?php echo WISHPOND_ADMIN_MENU; ?>">Campaigns</a> menu.</p>
  <p>
    <label for="<?php echo $this->get_field_id('social_discount_height'); ?>">
      Height: <input class="widefat" id="<?php echo $this->get_field_id('social_discount_height'); ?>" name="<?php echo $this->get_field_name('social_discount_height'); ?>" type="text" value="<?php echo attribute_escape($social_discount_height); ?>" />
    </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['merchant_id'] = $new_instance['merchant_id'];
    $instance['social_discount_height'] = $new_instance['social_discount_height'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    $merchant_id = $instance['merchant_id'];
    $social_discount_height = empty($instance['social_discount_height']) ? "500" : $instance['social_discount_height'];
 
    if (empty($merchant_id))
    {
      echo "<h1>Missing Merchant ID</h1>";
    }
    else
    {
      echo wpoffer_func(array('mid' => $merchant_id, 'width' => "100%", 'height' => $social_discount_height));
    }
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("WishpondSocialDiscountPostWidget");') );
?>