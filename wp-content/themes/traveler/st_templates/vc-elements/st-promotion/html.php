<?php
$img = wp_get_attachment_image_src($st_bg_img,'full');
$class_bg_img = Assets::build_css('background-image: url("'.$img[0].'") ;');
$class_bg_color = Assets::build_css('background: '.$st_bg.' ;');
if(is_numeric($st_opacity)){
    $st_opacity =  1 - $st_opacity/100 ;
}else{
    $st_opacity = 0.5;
}
$class_opacity = Assets::build_css('opacity: '.($st_opacity).' ;');
?>
<a href="<?php echo esc_url($st_link) ?>">
    <div class="promotion hover-img">
        <div class="promotion_image ">
            <?php if(!empty($img[0])){ ?>
                <img src="<?php echo balanceTags($img[0]) ?>" alt="img">
            <?php } ?>
        </div>
        <div class="promotion_bg <?php echo esc_attr($class_opacity) ?> <?php echo esc_attr($class_bg_color) ?>"></div>
        <div class="content">
            <div class="promotion_discount">
                <i class="<?php echo TravelHelper::handle_icon($st_icon) ?>"></i> <?php echo esc_attr($st_discount) ?>% <?php _e('Off',ST_TEXTDOMAIN) ?>
            </div>
            <div class="promotion_title">
                <?php echo esc_attr($st_title) ?>
            </div>
            <div class="promotion_sub">
                <?php echo esc_attr($st_sub) ?>
            </div>
        </div>
    </div>
</a>