<?php
/**
 * Additional Information tab
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information', ST_TEXTDOMAIN ) );

?>

<?php if ( $heading ): ?>
	<h2 class="tab-content-title"><?php echo balanceTags($heading); ?></h2>
<?php endif; ?>

<?php $product->list_attributes(); ?>
