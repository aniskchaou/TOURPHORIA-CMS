<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours photo
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script('magnific.js' );

if(!is_singular('st_tours') or !isset($attr)) return false;

$default=array(
    'style'=>'slide'
);

extract(wp_parse_args($attr,$default));

$gallery=get_post_meta(get_the_ID(),'gallery',true);
$gallery_array=explode(',',$gallery);

switch($style){



    case "grid":
            ?>
            <div class="row row-no-gutter popup-gallery">
                <?php

                if(is_array($gallery_array) and !empty($gallery_array))
                {
                    foreach($gallery_array as $key=>$value)
                    {
                        $img_link=wp_get_attachment_image_src($value,'full');

                        ?>
                        <div class="col-md-3">
                            <a class="hover-img popup-gallery-image" href="<?php echo isset($img_link[0])?$img_link[0]:false; ?>" data-effect="mfp-zoom-out">

                                <?php echo wp_get_attachment_image($value,array(133,100,'bfi_thumb'=>false), false, array('alt' => TravelHelper::get_alt_image($value)));?>
                                <i class="fa fa-plus round box-icon-small hover-icon i round"></i>
                            </a>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>
            <?php
        break;
    case "slide";
    default :
        ?>
        <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs" data-auto="false">
            <?php
            if(is_array($gallery_array) and !empty($gallery_array))
            {
                foreach($gallery_array as $key=>$value)
                {
                    $img_link=wp_get_attachment_image_src($value,array(800,600,'bfi_thumb'=>true), false, array('alt' => TravelHelper::get_alt_image($value)));

                    ?>
                    <a href="<?php echo isset($img_link[0])?$img_link[0]:false; ?>" data-alt="abc" alt="def" title="dasd" data-title="fdfsdf">
                        <?php  //echo wp_get_attachment_image($value,array(86,86), false, array('alt' => TravelHelper::get_alt_image($value))); ?>
                    </a>
                    <?php
                }
            }
            ?>

        </div>
        <?php
        break;
}
?>
