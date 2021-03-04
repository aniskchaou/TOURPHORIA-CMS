<?php 
	wp_enqueue_script( 'gmapv3' );

	if(!isset($term_id)){
		$term_id = 0;
	}
	$lat = get_term_meta( $term_id, 'map_lat', true );
	$lng = get_term_meta( $term_id, 'map_lng', true );
	$zoom = get_term_meta( $term_id, 'map_zoom', true );
	$address = get_term_meta( $term_id, 'map_address', true );
	$country = get_term_meta( $term_id, 'map_country', true );
?>
<div class="map-field-wrapper">
	<input class="search" type="text" name="search" value="">
	<div class="map-field-content">
		
	</div>
	<div class="map-field-values">
		<input type="hidden" name="map_lat" value="<?php echo (float)STInput::post('map_lat', $lat); ?>">
		<input type="hidden" name="map_lng" value="<?php echo (float)STInput::post('map_lng', $lng); ?>">
		<input type="hidden" name="map_zoom" value="<?php echo (float)STInput::post('map_zoom', $zoom); ?>">
		<input type="hidden" name="map_country" value="<?php echo STInput::post('map_country', $country); ?>">
		<input type="hidden" name="map_address" value="<?php echo STInput::post('map_address', $address); ?>">
	</div>
</div>