<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single loop gallery
 *
 * Created by ShineTheme
 *
 */
//wp_enqueue_script('fotorama.js');

$images=get_post_meta(get_the_ID(),'gallery',true);

$images=apply_filters('post_gallery_images',$images);

$images=explode(',',$images);

if(!empty($images) and is_array($images)):

?>
    <div class="" style="position: relative">
        <div class="st_tour_ver_fotorama fotorama" data-allowfullscreen="true" data-width="100%" >
            <?php foreach($images as $key=>$value):
                echo wp_get_attachment_image($value,array(405,226));
                ?>
            <?php endforeach; ?>
        </div>
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


<?php endif; ?>