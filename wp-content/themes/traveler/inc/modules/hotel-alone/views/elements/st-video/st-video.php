<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 8/15/2017
 * Version: 1.0
 */

extract($atts);
$data_video = "{videoURL:'".$link."',containment:'.youtube-video',autoPlay:true, showControls:false, showYTLogo: false, mute:false, startAt:0, opacity:1}";
$img_url = '';
if(!empty($background_image)){
    $img = wp_get_attachment_image_src($background_image, 'full', false);
    $img_url = !empty($img[0])?$img[0]:'';
}
if(!empty($label_color)){
    $label_color = Hotel_Alone_Helper::inst()->build_css('color: '.$label_color.' !important');
}
if(!empty($title_color)){
    $title_color = Hotel_Alone_Helper::inst()->build_css('color: '.$title_color.' !important');
}
if(!empty($height)){
    $height = Hotel_Alone_Helper::inst()->build_css('height: '.$height.'px !important');
}
if(!empty($overlay)){
    $overlay = Hotel_Alone_Helper::inst()->build_css('background-color: '.$overlay.' !important; content: ""', ':after');
}
if(!empty($link)) {
    if ($style == 'style-1') {
        ?>
        <div class="st-video style-1 youtube-video not-play <?php echo esc_attr($height); ?> <?php echo esc_attr($overlay); ?>"
             style="background: #f1f1f1 url(<?php echo esc_url($img_url); ?>) no-repeat center; ">
            <div id="bgndVideo" class="player" data-property="<?php echo($data_video); ?>"></div>
            <div class="d-table">
                <div class="table-cell">
                    <div class="caption">
                        <?php if (!empty($content)) { ?>
                            <div class="title-video <?php echo esc_attr($title_color); ?>"><?php echo wpb_js_remove_wpautop($content, true) ?></div>
                        <?php } ?>
                        <div class="st-play">
                            <?php if($enable_label == 'yes'){ ?>
                            <span class="label-left <?php echo esc_attr($label_color); ?>"><?php echo esc_html__('CLICK THE PLAYER TO', ST_TEXTDOMAIN) ?></span>
                            <?php } ?>
                            <a class="btn-play-video play" href="#"><i class="fa fa-play"></i><i
                                    class="fa fa-pause"></i></a>
                            <?php if($enable_label == 'yes'){ ?>
                            <span
                                class="label-right <?php echo esc_attr($label_color); ?>"><?php echo esc_html__('WATCH THE OVERVIEW', ST_TEXTDOMAIN) ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }else{
        ?>
        <div class="st-video style-2 youtube-video not-play <?php echo esc_attr($height); ?> <?php echo esc_attr($overlay); ?>"
             style="background: #f1f1f1 url(<?php echo esc_url($img_url); ?>) no-repeat center; ">
            <div id="bgndVideo" class="player" data-property="<?php echo($data_video); ?>"></div>
            <div class="d-table">
                <div class="table-cell">
                    <div class="caption">
                        <div class="st-play">
                            <a class="btn-play-video play" href="#"><i class="fa fa-play"></i><i
                                    class="fa fa-pause"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}?>