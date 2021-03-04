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
//wp_enqueue_script( 'fotorama.js' );
$images=get_post_meta(get_the_ID(),'gallery',true);

$images=apply_filters('post_gallery_images',$images);

$images=explode(',',$images);

if(!empty($images) and is_array($images)):

?>
<div class="fotorama" data-allowfullscreen="true" data-width="100%">
    <?php foreach($images as $key=>$value):

        echo wp_get_attachment_image($value,'full');
        ?>


    <?php endforeach; ?>
</div>

<?php endif; ?>