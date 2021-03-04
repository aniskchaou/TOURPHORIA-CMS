<?php
    /**
     * The template for displaying product content in the single-product.php template
     *
     * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
     *
     * @author        WooThemes
     * @package    WooCommerce/Templates
     * @version     3.6.0
     */

    if (!defined('ABSPATH')) {
        exit; // Exit if accessed directly
    }

?>

<?php
    /**
     * woocommerce_before_single_product hook
     *
     * @hooked wc_print_notices - 10
     */
    do_action('woocommerce_before_single_product');

    if (post_password_required()) {
        echo get_the_password_form();

        return;
    }
?>

<div itemscope itemtype=""
     id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="product_border">
    <div class="row">
        <div class="col-sm-5">
            <figure class="product-image-container clearfix ">

                <?php
                    /**
                     * woocommerce_before_single_product_summary hook
                     *
                     * @hooked woocommerce_show_product_sale_flash - 10
                     * @hooked woocommerce_show_product_images - 20
                     */
                    do_action('woocommerce_before_single_product_summary');
                ?>
            </figure>
        </div>
        <div class="col-sm-7">
            <div class="summary entry-summary">

                <?php
                    /**
                     * woocommerce_single_product_summary hook
                     *
                     * @hooked woocommerce_template_single_title - 5
                     * @hooked woocommerce_template_single_rating - 10
                     * @hooked woocommerce_template_single_price - 10
                     * @see woocommerce_template_single_excerpt - 20
                     * @hooked woocommerce_template_single_add_to_cart - 30
                     * @hooked woocommerce_template_single_meta - 40
                     * @hooked woocommerce_template_single_sharing - 50
                     */
                    do_action('woocommerce_single_product_summary');
                ?>

            </div>
            <!-- .summary -->
        </div>
    </div>
    </div><!-- End Product_border-->

    <?php
        /**
         * woocommerce_after_single_product_summary hook
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action('woocommerce_after_single_product_summary');
    ?>

    <meta itemprop="url" content="<?php the_permalink(); ?>"/>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action('woocommerce_after_single_product'); ?>
