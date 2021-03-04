<?php
extract($data);
$list_image = explode(",",$list_images);
$href = vc_build_link( $st_link_viewmore );
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
            <div class="content"><?php echo do_shortcode($st_content) ?></div>
            <div class="view-more">
                <a href="<?php echo esc_html($href['url']) ?>">
                    <?php echo esc_html($href['title']) ?>
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="scroll">
        <div class="scroll-to" href="#<?php echo esc_html($link_scroll) ?>"></div>
        <a  class="btn-scroll">
            <span class="line-text-1"><?php echo esc_html($text_sroll_2) ?></span>
            <span class="line-text-2"><?php echo esc_html($text_sroll_1) ?></span>
        </a>
    </div>
</div>