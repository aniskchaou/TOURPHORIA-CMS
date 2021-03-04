<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 2/22/2019
 * Time: 2:45 PM
 */
$banner_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
$class_bg = '';
if($banner_image)
    $class_bg = Assets::build_css('background: #ccc url('.esc_url($banner_image).') center no-repeat');

if(isset($is_room_alone))
    $is_room_alone = true;
else
    $is_room_alone = false;
?>
<div class="sts-banner <?php echo esc_attr($class_bg); ?>">
    <h1 class="page-title sts-pf-font">
        <?php echo get_the_title(); ?>
        <?php
        if($is_room_alone){
            $sub_heading = get_post_meta(get_the_ID(), 'hotel_alone_room_sub_heading', true);
            if(!empty($sub_heading)){
                echo '<p class="sub-heading">'. esc_html($sub_heading) .'</p>';
            }
        }
        ?>
    </h1>
</div>
