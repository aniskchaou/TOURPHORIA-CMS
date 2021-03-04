<?php
    /**
     * The template for displaying product content within loops.
     *
     * Override this template by copying it to yourtheme/woocommerce/content-product.php
     *
     * @author 		WooThemes
     * @package 	WooCommerce/Templates
     * @version     1.6.4
     */

    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }

    global $product, $woocommerce_loop;

    // Store loop count we're currently on
    if ( empty( $woocommerce_loop['loop'] ) )
        $woocommerce_loop['loop'] = 0;

    // Store column count for displaying the grid
    if ( empty( $woocommerce_loop['columns'] ) )
        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

    // Ensure visibility
    if ( ! $product || ! $product->is_visible() )
        return;

    // Increase loop count
    $woocommerce_loop['loop']++;

    // Extra post classes
    $classes = array();
    if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
        $classes[] = 'first';
    if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
        $classes[] = 'last';
?>
<li <?php post_class( $classes ); ?>>
    <div class="product-wrap">
        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
        <figure class="product-image-container">
            <a href="<?php the_permalink(); ?>">

                <?php
                    /**
                     * woocommerce_before_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    do_action( 'woocommerce_before_shop_loop_item_title' );
                ?>
            </a>
        </figure>
        <div class="product-info">

            <h3 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="text-center price_and_rate">
                <?php
                    /**
                     * woocommerce_after_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_template_loop_rating - 5
                     * @hooked woocommerce_template_loop_price - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item_title' );
                ?>
            </div>



            <div class="product-info-hide">
                <?php

                    /**
                     * woocommerce_after_shop_loop_item hook
                     *
                     * @hooked woocommerce_template_loop_add_to_cart - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item' );




                    // Add compare plugins
                    if(class_exists('YITH_Woocompare'))
                    {
                        global $yith_woocompare;
                        ?>
                        <a href="<?php echo esc_url(add_query_arg( array( 'iframe' => 'true' ), $yith_woocompare->obj->view_table_url() )) ?>" rel="tooltip" data-original-title="<?php _e('Compare',ST_TEXTDOMAIN)?>" data-product_id="<?php the_ID()?>" class="product-btn product-compare compare"><i class="fa fa-bar-chart"></i></a>
                    <?php

                    }

                    // Add wishlist plugins
                    if(class_exists('YITH_WCWL'))
                    {
                        ?>
                        <a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', get_the_ID(),get_permalink() ) )?>" rel="tooltip" data-original-title="<?php _e('Add to wishlist',ST_TEXTDOMAIN)?>" class="product-btn product-favorite"><i class="fa fa-heart"></i></a>
                    <?php

                    }

                ?>
            </div>
        </div>
    </div>

</li>
