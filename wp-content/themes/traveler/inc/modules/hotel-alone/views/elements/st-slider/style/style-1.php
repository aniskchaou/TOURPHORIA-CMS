<?php
extract($data);
$list_image = explode(",",$list_images);
?>
<div class="content-slider">
    <div class="overlay-image owl-carousel">
        <?php
        if(!empty($list_image)){
            foreach($list_image as $k=>$v){
                $image = wp_get_attachment_image_url($v,'full');
                $image_s = wp_get_attachment_image($v,'full');
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
            <div class="title"><?php echo esc_html($st_title) ?></div>
            <div class="content"><?php echo esc_html($st_content) ?></div>
            <div class="sub_title"><?php echo esc_html($st_sub_title) ?></div>
        </div>
    </div>
    <div class="scroll">
        <a href="#<?php echo esc_html($link_scroll) ?>" class="btn-scroll scroll-to">
            <span class="line-1"></span>
            <span class="line-2"></span>
            <span class="line-3"></span>
            <span class="line-text"><?php esc_html_e("Scroll",ST_TEXTDOMAIN) ?></span>
        </a>
    </div>
</div>