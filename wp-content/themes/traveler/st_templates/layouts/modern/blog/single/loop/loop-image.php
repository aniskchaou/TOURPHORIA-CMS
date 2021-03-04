<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single loop image
 *
 * Created by ShineTheme
 *
 */
?>
<?php if(is_single()){ ?>
    <span class="hover-img" href="<?php the_permalink()?>">
        <?php the_post_thumbnail('full', array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id(get_the_ID() )))) ?>
    </span>
<?php }else{ ?>
    <a class="hover-img" href="<?php the_permalink()?>">
        <?php
            if(has_post_thumbnail()){
                the_post_thumbnail(array(870 , 500), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id(get_the_ID() ))));
            }else{
                ?>
                    <img src="<?php echo get_stylesheet_directory_uri() . '/v2/images/image_default.jpg' ?>" alt="<?php echo __('Default Image', ST_TEXTDOMAIN); ?>"/>
                <?php
            }

        ?>
    </a>
<?php } ?>

