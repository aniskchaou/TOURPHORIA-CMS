<?php
$default = array(

			'title' => 'Hight light',
            'tab_icon_' => 'fa fa-info',
            'tab_type' => 'information',
            'map_height' => '500',
            'map_spots' => '500',
            'map_location_style' => 'normal',
            'tab_item_key' => 'in1',
            'information_content'	=> 'content' ,  
            'hight_light_posts' => 1
	);
$value = extract(wp_parse_args( $value, $default )); 
if ($information_content =='content') {
	?><div class='col-xs-12'><?php 
	while ( have_posts() ) : the_post();
        the_content();
    endwhile;
    ?></div><?php 
}
if ($information_content =='posts') {
	?><div class='col-xs-12'><?php 
	$obj = get_post($hight_light_posts,  OBJECT);
	echo apply_filters('the_content' , $obj->post_content );

	//Add custom css for post in location tab detail
	$shortcodes_custom_css = get_post_meta( $obj->ID, '_wpb_shortcodes_custom_css', true );
	Assets::add_css($shortcodes_custom_css);
	?></div><?php 
}
if ($information_content =='child_tab'){ 
	?> <div class='location_child_tab'> <?php
	$child_tab_position = (get_post_meta(get_the_ID(), 'info_location_tab_item_position' , true));
	if ($child_tab_position =='top' or $child_tab_position =="left"){
		echo st()->load_template('location/location_info/nav' , null  , array('tab_key'=> $tab_item_key , 'child_tab_position'=> $child_tab_position));
	}
	echo st()->load_template('location/location_info/content' , null, array('tab_key'=> $tab_item_key , 'child_tab_position'=> $child_tab_position));
	if ($child_tab_position =='right'){
		echo st()->load_template('location/location_info/nav' , null  , array('tab_key'=> $tab_item_key , 'child_tab_position'=> $child_tab_position));
	}
	?> </div> <?php
}
?>
