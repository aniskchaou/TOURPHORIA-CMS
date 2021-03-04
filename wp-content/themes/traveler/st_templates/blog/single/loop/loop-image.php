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
        <?php the_post_thumbnail(array(848 , 477), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id(get_the_ID() )))) ?><i class="fa fa-link box-icon-# hover-icon round"></i>
    </a>
<?php } ?>

