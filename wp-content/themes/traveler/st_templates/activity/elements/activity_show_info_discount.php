<?php 
	$discount_by_adult = get_post_meta(get_the_ID() , 'discount_by_adult' , true) ; 
	$discount_by_child = get_post_meta(get_the_ID() , 'discount_by_child' , true) ;		

	$discount_type = get_post_meta( get_the_ID(), 'discount_by_people_type', true );
	if(!$discount_type){
		$discount_type = 'percent';
	}
?>

<div class="activity_discount_info">
	<br>
	<?php if (!empty($discount_by_adult) and is_array($discount_by_adult) ) { ?>
	<h4><?php echo __("Adult discount" ,ST_TEXTDOMAIN); ?></h4>
	<table>
		<tr>
			<th>#</th>
			<th><?php echo __("Title" ,ST_TEXTDOMAIN);?></th>
			<th><?php echo __("Number" ,ST_TEXTDOMAIN);?></th>
			<th><?php echo __("Discount" ,ST_TEXTDOMAIN);?></th>
		</tr>
		<?php
			foreach ($discount_by_adult as $key => $value) {
                $name = (int)$value['key'];
                if(isset($value['key_to'])){
                    $name .= ' - '. (int) $value['key_to'];
                }
				if($discount_type == 'percent'){
					$price = (float)$value['value'].'%';
				}else{
					$price = TravelHelper::format_money((float) $value['value']);
				}
				echo "<tr>";
				echo "<td>".esc_attr($key+1)."</td>";
				echo "<td>".esc_attr($value['title'])."</td>";
				echo "<td>".$name."</td>";
				echo "<td>". $price ."</td>";
				echo "</tr>";
			}
		?>
	</table>
	<?php } ;?>
	<?php if (!empty($discount_by_child) and is_array($discount_by_child) ) { ?>
	<br>
	<h4><?php echo __("Children discount" ,ST_TEXTDOMAIN); ?></h4>
	<table>
		<tr>
			<th>#</th>
			<th><?php echo __("Title" ,ST_TEXTDOMAIN);?></th>
			<th><?php echo __("Number" ,ST_TEXTDOMAIN);?></th>
			<th><?php echo __("Discount" ,ST_TEXTDOMAIN);?></th>
		</tr>
		<?php
			foreach ($discount_by_child as $key => $value) {
                $name = (int)$value['key'];
                if(isset($value['key_to'])){
                    $name .= ' - '. (int) $value['key_to'];
                }
				if($discount_type == 'percent'){
					$price = (float)$value['value'].'%';
				}else{
					$price = TravelHelper::format_money((float) $value['value']);
				}
				echo "<tr>";
				echo "<td>".esc_attr($key+1)."</td>";
				echo "<td>".esc_attr($value['title'])."</td>";
				echo "<td>".$name."</td>";
				echo "<td>".$price."</td>";
				echo "</tr>";
			}
		?>
	</table>
	<br>
	<?php } ;?>
</div>


