<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 4/20/15
 * Time: 3:19 PM
 */
global $product,$post;
    $is_new=apply_filters('st_is_new_product',false);
    if(!$is_new) return;?>

<?php echo apply_filters( 'st_new_product_ribbon', '<div class="woocommere-ribbon-wrap new_product_ribbon_wrap"><span class="new_product woocommere-ribbon">' . __( 'New', ST_TEXTDOMAIN ) . '</span></div>', $post, $product ); ?>
