<?php
/**
 * Widget Product
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.5
 */
?>
<?php global $product; ?>
<li class="clearfix">
    <div class="img_wrap">

        <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
            <?php echo balanceTags($product->get_image(array(80,90))); ?>
        </a>

    </div>
    <div class="content_wrap">
        <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>"> <span class="product-title"><?php echo balanceTags($product->get_title()); ?></span></a>

        <?php if ( ! empty( $show_rating ) ) echo balanceTags($product->get_rating_html()); ?>
	<?php echo balanceTags($product->get_price_html()); ?>

    </div>
</li>