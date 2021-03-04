<?php 
	$list_post_type = explode(",", $post_type) ; 
	$list_star  = explode(',', $star_list);
	
	if(in_array('all', $list_post_type)){
		$list_post_type = STLocation::get_post_type_list_active();
	}
	if(in_array('all', $list_star)){
		$list_star = array(5,4,3,2,1);
	}

	$result = STLocation::get_rate_count($list_star , $list_post_type);	

?>
<ul class='icon-list text-white bgr-opacity' id='location_header_static'>
<?php 
	if (!empty($result) and is_array($result)){
		foreach ($result as $key => $value) {
			$rate_text  = __(" rate" , ST_TEXTDOMAIN);
			if ($value >1){$rate_text  = __(" rates" , ST_TEXTDOMAIN);}

			if ($key == 5){
				echo "<li> ".$value .$rate_text.' <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>'."</li>";
			}
			if ($key == 4){
				echo "<li> ".$value .$rate_text.' <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>'."</li>";
			}
			if ($key == 3){
				echo "<li> ".$value .$rate_text.' <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>'."</li>";	
			}
			if ($key == 2){
				echo "<li> ".$value .$rate_text.' <i class="fa fa-star"></i><i class="fa fa-star"></i>'."</li>";		
			}
			if ($key == 1){
				echo "<li> ".$value .$rate_text.' <i class="fa fa-star"></i>'."</li>";			
			}
		}
	}
?>
</ul>
