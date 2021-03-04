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
<div style="position: relative">
<a class="hover-img" href="<?php the_permalink()?>">
    <?php the_post_thumbnail(array(405,226), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( get_the_ID() )))) ?><i class="fa fa-link box-icon-# hover-icon round"></i>
</a>
<?php
    $cat = wp_get_post_categories(get_the_ID());
    if(!empty($cat)) {
        $need = $cat[0];
        ?>
        <div class="st_tour_category bgr-main-hover st_image_title text-1line text-white"><div><a href="<?php echo get_category_link($need); ?>"><strong><?php echo get_cat_name($need); ?></strong></a></div></div>
        <?php
    }
?>
</div>