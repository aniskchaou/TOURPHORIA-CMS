<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User html add to wishlist
 *
 * Created by ShineTheme
 *
 */
if ( is_user_logged_in() ) : 
        wp_enqueue_script( 'user.js' );
    ?>
    <?php $data = STUser_f::get_icon_wishlist();  ?>
    <?php if(!empty($title)){?>
        <div class=" clear mt20" style="margin-bottom: 10px;">
            <?php if(!empty($title)){ echo '<span>'.$title.': </span>'; } ?>
            <a data-placement="top" rel="tooltip" data-original-title="<?php echo balanceTags($data['original-title']) ?>" class="btn_add_wishlist btn btn-primary <?php if(!empty($class))echo esc_attr($class) ?>" data-type="<?php echo get_post_type(get_the_ID()) ?>" data-id="<?php echo get_the_ID() ?>" >
                <?php echo balanceTags($data['icon']) ?>
            </a>
        </div>
    <?php }else{ ?>
        <a data-placement="top" rel="tooltip" data-original-title="<?php echo balanceTags($data['original-title']) ?>" class="btn_add_wishlist btn btn-primary <?php if(!empty($class))echo esc_attr($class) ?>" data-type="<?php echo get_post_type(get_the_ID()) ?>" data-id="<?php echo get_the_ID() ?>" >
            <?php echo balanceTags($data['icon']) ?>
        </a>
    <?php } ?>
<?php endif; ?>