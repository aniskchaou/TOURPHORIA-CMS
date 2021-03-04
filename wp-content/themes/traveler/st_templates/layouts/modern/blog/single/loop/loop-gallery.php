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
$images=get_post_meta(get_the_ID(),'gallery',true);

$images=apply_filters('post_gallery_images',$images);

$images=explode(',',$images);

if(!empty($images) and is_array($images)):

?>
<div class="st-gallery" data-width="100%"
     data-nav="false" data-allowfullscreen="true">
    <div class="fotorama" data-auto="false">
        <?php foreach($images as $key=>$value):
            echo wp_get_attachment_image($value,array(870 , 500));
            ?>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>