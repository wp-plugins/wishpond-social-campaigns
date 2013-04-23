<?php
/**
 * @package Wishpond
 */

include_once dirname( __FILE__ ) . '/common.php';

class WishpondPhotoContestPostWidget extends WP_Widget
{
  function WishpondPhotoContestPostWidget()
  {
    $widget_ops = array('classname' => 'WishpondPhotoContestPostWidget', 'description' => 'Use this widget to add the Photo Contest you have created through the Campaign menu to your pages' );
    $this->WP_Widget('WishpondPhotoContestPostWidget', 'Wishpond Photo Contest', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'merchant_id' => '' ) );
    $merchant_id = $instance['merchant_id'];
    $Photo_Contest_height = empty($instance['Photo_Contest_height']) ? "500" : $instance['Photo_Contest_height'];
    
?>
  <p>
    <label for="<?php echo $this->get_field_id('merchant_id'); ?>">
      Merchant ID: <input class="widefat" id="<?php echo $this->get_field_id('merchant_id'); ?>" name="<?php echo $this->get_field_name('merchant_id'); ?>" type="text" value="<?php echo attribute_escape($merchant_id); ?>" />
    </label>
  </p>
  <p>You can get your Merchant ID by logging into your account through the <a href="admin.php?page=<?php echo WISHPOND_ADMIN_MENU; ?>">Campaigns</a> menu.</p>
  <p>
    <label for="<?php echo $this->get_field_id('Photo_Contest_height'); ?>">
      Height: <input class="widefat" id="<?php echo $this->get_field_id('Photo_Contest_height'); ?>" name="<?php echo $this->get_field_name('Photo_Contest_height'); ?>" type="text" value="<?php echo attribute_escape($Photo_Contest_height); ?>" />
    </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['merchant_id'] = $new_instance['merchant_id'];
    $instance['Photo_Contest_height'] = $new_instance['Photo_Contest_height'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    $merchant_id = $instance['merchant_id'];
    $Photo_Contest_height = empty($instance['Photo_Contest_height']) ? "500" : $instance['Photo_Contest_height'];
 
    if (empty($merchant_id))
    {
      echo "<h1>Missing Merchant ID</h1>";
    }
    else
    {
      echo wpphotocontest_func(array('mid' => $merchant_id, 'width' => "100%", 'height' => $Photo_Contest_height));
    }
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("WishpondPhotoContestPostWidget");') );
?>