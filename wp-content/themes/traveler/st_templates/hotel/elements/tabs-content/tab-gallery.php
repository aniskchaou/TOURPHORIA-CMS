<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 5/31/2017
 * Version: 1.0
 */

wp_enqueue_script('magnific.js' );
$gallery=get_post_meta(get_the_ID(),'gallery',true);
$gallery_array=explode(',',$gallery);

if(!empty($gallery) && count($gallery_array) > 0){
    echo '<div class="tab-inner-gallery popup-gallery"><div class="gallery-row">';
    foreach($gallery_array as $key => $val){
        $img = wp_get_attachment_image_src($val, array(300, 300), false);
        $img_full = wp_get_attachment_image_src($val, 'full', false);
        if(!empty($img[0])){
            ?>
            <div class="item">
                <div class="st-relative">
                    <a class="hover-img popup-gallery-image icon" href="<?php echo isset($img_full[0])?$img_full[0]:false; ?>" data-effect="mfp-zoom-out"></a>
                    <img src="<?php echo esc_url($img[0]); ?>" alt="<?php echo get_the_title($val); ?>">
                </div>
            </div>
<?php
        }
    }
    echo '</div></div>';
}else{
    echo '<h4 class="no-photo">'.esc_html__('No photo for this tour', ST_TEXTDOMAIN).'</h4>';
}