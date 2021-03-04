<?php
$logo_light = st()->get_option('hotel_alone_logo');
$st_menu_style = st()->get_option('st_hotel_alone_menu_style','style_2');
$st_menu_color = st()->get_option('st_hotel_alone_menu_color','#ffffff');
$st_menu_bottom_line = st()->get_option('st_menu_bottom_line','off');
$st_left_menu = st()->get_option('st_hotel_alone_left_menu','');
$st_right_menu = st()->get_option('st_hotel_alone_right_menu','');
if(is_archive() || is_search()){

}else{
    $custom_menu_style = get_post_meta(get_the_ID(),'custom_menu_style',true);
    if($custom_menu_style == 'on'){
        $st_menu_style = get_post_meta(get_the_ID(),'st_menu_style',true);
        $st_menu_color = get_post_meta(get_the_ID(),'st_menu_color',true);
        $st_menu_bottom_line = get_post_meta(get_the_ID(),'st_menu_bottom_line',true);
        $st_left_menu = get_post_meta(get_the_ID(),'st_left_menu',true);
        $st_right_menu = get_post_meta(get_the_ID(),'st_right_menu',true);
    }
    $custom_logo = get_post_meta(get_the_ID(),'custom_logo',true);
    if($custom_logo == 'on'){
        $logo_light = get_post_meta(get_the_ID(),'logo_light',true);
    }
}

if(empty($st_menu_color))$st_menu_color = '#fff';
if($st_menu_bottom_line == 'on') $st_menu_bottom_line = 'show_buttom_line';

$class_color[] = Hotel_Alone_Helper::inst()->build_css('color:'.$st_menu_color.' !important',' > li > a ');
$class_color[] = $st_menu_bottom_line;
$args = array(
   'style'=>$st_menu_style,
   'class_color'=>$class_color,
   'st_right_menu'=>$st_right_menu,
   'st_left_menu'=>$st_left_menu,
   'logo_light'=>$logo_light,
);
echo st_hotel_alone_load_view('header/menu/style/'.$st_menu_style, false, $args);