<?php   
$class = "col-md-9 col-xs-9";
if (($child_tab_position)  =="top"){
	$class = "col-xs-12 col-lg-12" ;
}
?>
<div class='mt20 location_list_item_content <?php echo esc_attr($class) ; ?> '>
	<div class='tab-content'>
	<?php 
	$list_item = get_post_meta(get_the_ID() , 'info_tab_item' , true );
	$i = 0; 
	if(!empty($list_item) and is_array($list_item)){		
		foreach ($list_item as $key => $value) {
			if (!empty($value) and !empty($tab_key ) and $value['tab_item_key'] ==$tab_key ) {
			$post_id = !empty($value['post_info_select']) ? $value['post_info_select'] :1 ;
           	$title  = !empty($value['title']) ? $value['title'] : get_the_title($post_id);        
			?>
				<div class='tab-pane  fade <?php if ($i == 0) echo " in active " ; ?>' id='<?php echo esc_attr("tab_".$post_id.$tab_key); ?>'>
					<?php
                    global $post;
                    $post = get_post($post_id,  OBJECT);
                    if(!empty($post->post_content)){
                        echo apply_filters('the_content' , $post->post_content );
                    }
                    wp_reset_postdata();
					?>
				</div>
			<?php 
			$i ++; }// end if
		}
	}	
	unset($i);
?>	
	</div>
</div>