<?php
$gallery = get_post_meta(get_the_ID(),'gallery',true);
extract($data);
?>
<div class="st-banner-single-room st-style-1">
    <div class="content-slider">
        <div class="overlay-image owl-carousel">
            <?php
            $gallery_arr = explode(',', $gallery);
            if(!empty($gallery_arr)){
                foreach($gallery_arr as $k=>$v){
                    $image = wp_get_attachment_image_url($v,'full');
                    if(empty($image)) continue;
                    $class_background = Hotel_Alone_Helper::inst()->build_css('background-image: url('.$image.')');
                    ?>
                    <div class="item">
                        <div class="slider-item-background <?php echo esc_html($class_background) ?>">
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="content-info">
            <div class="owl-nav">
                <div class="owl-prev">
                    <i class="fa fa-long-arrow-left"></i>
                </div>
                <div class="owl-next">
                    <i class="fa fa-long-arrow-right"></i>
                </div>
            </div>
            <div class="info">
                <div class="title"><?php the_title() ?></div>
                <div class="breadcrumbs"><?php echo hotel_alone_display_breadcrumbs(); ?></div>
            </div>
        </div>
        <div class="scroll">
            <a href="#<?php echo esc_attr($link_scroll) ?>" class="btn-scroll scroll-to">
                <i class="fa fa-long-arrow-down"></i>
            </a>
        </div>
    </div>
</div>

