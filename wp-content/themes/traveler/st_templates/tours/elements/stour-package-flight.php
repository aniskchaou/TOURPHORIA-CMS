<?php
$tour_package = get_post_meta($post_id, 'tour_packages_flight', true);
$arr_tour_package = array();
$arr_tour_package_ids = array();
if (!empty((array)$tour_package)) {
    foreach ($tour_package as $k => $v) {
        $arr_tour_package[$v->flight_id] = array(
            'economy' => $v->flight_price_economy,
            'business' => $v->flight_price_business
        );
	    array_push($arr_tour_package_ids, $v->flight_id);
    }
}
if (!empty($ids)) {
    ?>
    <table class="wp-list-table widefat fixed striped stour-list-hotel" data-type="flight">
        <thead>
        <tr>
            <td class="manage-column column-cb check-column" id="cb">
                <input type="checkbox" id="cb-select-all-1">
                <span><?php echo __('Show/Hide', ST_TEXTDOMAIN); ?></span>
            </td>
            <td><?php echo __('Origin', ST_TEXTDOMAIN); ?> <i class="fa fa-long-arrow-right"></i> <?php echo __('Destination', ST_TEXTDOMAIN); ?></td>
            <td><?php echo __('Departure time', ST_TEXTDOMAIN); ?></td>
            <td><?php echo __('Duration', ST_TEXTDOMAIN); ?></td>
            <td><?php echo __('Price', ST_TEXTDOMAIN); ?></td>
        </tr>
        </thead>
        <tbody class="the-list">
        <?php foreach ($ids as $k => $v) { ?>
            <?php
                $origin_iata = '';
                $origin_name = '';
                $destination_iata = '';
                $destination_name = '';

                $origin_id = get_post_meta($v['ID'], 'origin', true);

                if(!empty($origin_id) && $origin_id > 0){
                    $origin = get_term($origin_id, 'st_airport');
                    if(is_object($origin)){
                        $origin_iata = get_tax_meta($origin->term_id, 'iata_airport', true);
                        $origin_name = $origin->name;
                    }
                }

                $destination_id = get_post_meta($v['ID'], 'destination', true);
                if(!empty($destination_id) && $destination_id > 0){
                    $destination = get_term($destination_id, 'st_airport');
                    if(is_object($destination)){
                        $destination_iata = get_tax_meta($destination->term_id, 'iata_airport', true);
                        $destination_name = $destination->name;
                    }
                }

                $origin_res = '';
                if(empty($origin_iata) and empty($origin_name)){
                    $origin_res = '—';
                }else{
                    $origin_res = $origin_name . ' ('. $origin_iata .')';
                }

                $destination_res = '';
                if(empty($destination_iata) and empty($destination_name)){
                    $destination_res = '—';
                }else{
                    $destination_res = $destination_name . ' ('. $destination_iata .')';
                }

	            if(!empty($origin_res != '—' and $destination_res != '—')){
            ?>
            <tr>
                <th class="check-column" scope="row"><input class="cb-select-child1" type="checkbox"
                                                            data-id="<?php echo esc_attr($v['ID']); ?>" <?php if (in_array($v['ID'], $arr_tour_package_ids)) echo 'checked'; ?>/>
                </th>
                <td data-name="<?php echo __('Origin', ST_TEXTDOMAIN); ?>">
                    <?php
                        echo esc_html($origin_res) . '<br /><i class="fa fa-long-arrow-right"></i><br />' . esc_html($destination_res);
                    ?>
                </td>
                <td data-name="<?php echo __('Departure time', ST_TEXTDOMAIN); ?>">
                    <?php
                    $depart_time = get_post_meta($v['ID'], 'departure_time', true);
                    ?>
                    <label><?php echo esc_html($depart_time); ?></label>
                </td>
                <td data-name="<?php echo __('Duration', ST_TEXTDOMAIN); ?>">
                    <?php
                    $total_time = get_post_meta($v['ID'], 'total_time', true);
                    $total_time_str = $total_time['hour'] . 'h' . $total_time['minute'] . 'm';
                    ?>
                    <label><?php echo esc_html($total_time_str); ?></label>
                </td>
                <td data-name="<?php echo __('Price', ST_TEXTDOMAIN); ?>">
                    <label>
                        <?php echo __('Economy', ST_TEXTDOMAIN); ?>
                    <input type="text" class="hotel-price price-economy" value="<?php echo (!empty($arr_tour_package) && isset($arr_tour_package[$v['ID']])) ? $arr_tour_package[$v['ID']]['economy'] : ''; ?>"/>
                    </label>
                    <label>
	                    <?php echo __('Business', ST_TEXTDOMAIN); ?>
                        <input type="text" class="hotel-price price-business" value="<?php echo (!empty($arr_tour_package) && isset($arr_tour_package[$v['ID']])) ? $arr_tour_package[$v['ID']]['business'] : ''; ?>"/>
                    </label>
                </td>
            </tr>
                    <?php } ?>
        <?php } ?>
        </tbody>
    </table>
    <?php
} else {
    echo __('No flights found!', ST_TEXTDOMAIN);
}
?>