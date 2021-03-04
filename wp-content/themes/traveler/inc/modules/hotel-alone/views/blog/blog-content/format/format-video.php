<?php
$sidebar=hotel_alone_get_sidebar();
$sidebar_pos=$sidebar['position'];
if(($sidebar_pos == 'left') or ($sidebar_pos == 'right')){
    $video_fix = array('width'=>750,'height'=>500);
}else{
    $video_fix = array('width'=>1170,'height'=>500);
}
$data = '';
$media_url = get_post_meta(get_the_ID(), 'media', true);
if ($media_url or !empty($media_url)) {
    $video_format = array('.mp4','.ogg','.webm','.MP4','.Ogg','WebM','.mov');
    if($media_url != '' and !empty($media_url)) {
        $check_format = false;
        foreach ($video_format as $key => $value) {
            $check_format = strpos($media_url, $value);
            if ($check_format !== false)
                break;
        }
    }
    if($check_format == false) {
        $data .= '<div class="audio">' . hotel_alone_remove_w3c(wp_oembed_get($media_url,$video_fix)) . '</div>';
    }else{
        $data .= '<video class="video_host_media" controls> <source src="'.$media_url.'"></video>';
    }
}else{
    echo st_hotel_alone_load_view('blog/blog-content/format/format');
}
?>
<?php echo do_shortcode($data) ;?>
