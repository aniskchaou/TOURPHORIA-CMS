<?php
/**
 * Product Search Form
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */
?>
<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">

    <div class="input-group">
        <input type="text" value="<?php echo get_search_query(); ?>" class="form-control" name="s" placeholder="<?php echo esc_attr_x( 'Search for:', 'label', ST_TEXTDOMAIN ); ?>">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
      </span>
    </div><!-- /input-group -->
	<input type="hidden" name="post_type" value="product" />
</form>
