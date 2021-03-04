<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 1/9/2019
 * Time: 4:22 PM
 */
$data_video = "{videoURL:'" . $link . "',containment:'.youtube-video',autoPlay:true, showControls:false, showYTLogo: false, mute:false, startAt:0, opacity:1}";
$img_url = '';
if (!empty($background_image)) {
    $img = wp_get_attachment_image_src($background_image, 'full', false);
    $img_url = !empty($img[0]) ? $img[0] : '';
}
if (!empty($link)) {
    ?>
    <div class="st-video style-1 youtube-video not-play"
         style="background: #f1f1f1 url(<?php echo esc_url($img_url); ?>) no-repeat center; ">
        <div id="bgndVideo" class="player" data-property="<?php echo($data_video); ?>"></div>
        <div class="d-table">
            <div class="table-cell">
                <div class="caption">
                    <?php if (!empty($label_video)) { ?>
                        <div class="title-video"><?php echo wpb_js_remove_wpautop($label_video, true) ?></div>
                    <?php } ?>
                    <div class="st-play">
                        <a class="btn-play-video play" href="#"><i class="fa fa-play"></i><i
                                    class="fa fa-pause"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} ?>