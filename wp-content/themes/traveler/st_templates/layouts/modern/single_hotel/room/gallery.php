<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/7/2019
 * Time: 4:32 PM
 */
$gallery_array = get_post_meta(get_the_ID(), 'gallery', true);
$image_arr = array();
if(!empty($gallery_array)){
    $img_arr = explode(',', $gallery_array);
    if(!empty($img_arr)){
        foreach ($img_arr as $k => $v){
            array_push($image_arr, wp_get_attachment_image_url($v, 'full'));
        }
    }
}

?>
<div class="sts-room-gallery mt30">
    <?php if ( !empty( $image_arr ) ) { ?>
    <div class="carousel"
         data-flickity='{ "wrapAround": true, "lazyLoad": 2}'>
                <?php
                foreach ( $image_arr as $value ) {
                    ?>
                    <img class="carousel-image"
                         data-flickity-lazyload="<?php echo $value; ?>" />
                    <?php
                }
                ?>
        </div>
    <?php } ?>
</div>
