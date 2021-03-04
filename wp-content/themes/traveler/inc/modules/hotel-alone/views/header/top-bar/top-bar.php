<?php
wp_enqueue_style('weather-icons.css');
$st_topbar_style = st()->get_option('st_hotel_alone_topbar_style','');
if(is_archive() || is_search()){
}else{
    $custom_header_page = get_post_meta(get_the_ID(),'custom_header_page',true);
    if($custom_header_page == 'on'){
        $st_topbar_style = get_post_meta(get_the_ID(),'st_topbar_style',true);
    }
}
echo st_hotel_alone_load_view('header/top-bar/style/' . $st_topbar_style);
?>
<div class="st_main_menu topbar-<?php echo esc_html(str_ireplace("_","-",$st_topbar_style)) ?>">
    <?php echo st_hotel_alone_load_view('header/menu/menu'); ?>
</div>