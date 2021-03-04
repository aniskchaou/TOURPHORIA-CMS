<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 30-11-2018
     * Time: 10:51 AM
     * Since: 1.0.0
     * Updated: 1.0.0
     */

    $data = STUser_f::get_icon_wishlist();
?>
<?php
    if ( is_user_logged_in() ) {
        ?>
        <a href="#" class="share-item like-it btn_add_wishlist"
           data-type="<?php echo get_post_type( get_the_ID() ) ?>"
           data-id="<?php echo get_the_ID() ?>"><?php echo balanceTags( $data[ 'icon' ] ) ?></a>
        <?php
    } else {
        ?>
        <a href="#" class="share-item like-it" data-toggle="modal" data-target="#st-login-form"
           data-type="<?php echo get_post_type( get_the_ID() ) ?>"
           data-id="<?php echo get_the_ID() ?>"><?php echo balanceTags( $data[ 'icon' ] ) ?></a>
        <?php
    }
?>
