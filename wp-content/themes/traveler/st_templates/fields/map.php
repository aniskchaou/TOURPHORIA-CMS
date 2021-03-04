<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/27/2019
 * Time: 2:29 PM
 */
wp_enqueue_script('st-partner-gmapv3-init');
$require_text = '';
if(isset($data['required']) && $data['required'])
    $require_text = '<span class="required">*</span>';

$old_lat = '';
$old_lng = '';
$old_zoom = '';
$old_type = '';
$old_streetmode = '';

if(!empty($post_id)){
    $old_lat = get_post_meta($post_id, 'map_lat', true);
    $old_lng = get_post_meta($post_id, 'map_lng', true);
    $old_zoom = get_post_meta($post_id, 'map_zoom', true);
    $old_type = get_post_meta($post_id, 'map_type', true);
    $old_streetmode = get_post_meta($post_id, 'enable_street_views_google_map', true);
}
?>
<div class="form-group st-field-<?php echo esc_attr($data['type']); ?>">
    <label for="<?php echo 'st-field-' . esc_attr($data['name']); ?>"><?php echo esc_html($data['label']) . ' ' . $require_text; ?></label>
    <input type="text" placeholder="<?php _e('Search by name...', ST_TEXTDOMAIN) ?>" class="bt_ot_searchbox"/>
    <div class="st-map-box"></div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="st-map-lat"><?php echo __('Latitude', ST_TEXTDOMAIN); ?></label>
                <input id="st-map-lat" type="text" name="gmap[lat]" class="form-control" value="<?php echo esc_html($old_lat); ?>" readonly/>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="st-map-lng"><?php echo __('Longitude', ST_TEXTDOMAIN); ?></label>
                <input id="st-map-lng" type="text" name="gmap[lng]" class="form-control" value="<?php echo esc_html($old_lng); ?>" readonly/>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="st-map-zoom"><?php echo __('Zoom Level', ST_TEXTDOMAIN); ?></label>
                <input id="st-map-zoom" type="text" name="gmap[zoom]" class="form-control" value="13" value="<?php echo esc_html($old_zoom); ?>" readonly/>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="st-map-style"><?php echo __('Map Style', ST_TEXTDOMAIN); ?></label>
                <input id="st-map-style" type="text" name="gmap[type]" class="form-control" value="<?php echo esc_html($old_type); ?>" readonly/>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="st-map-streetview"><?php echo __('Streetview mode', ST_TEXTDOMAIN); ?></label>
                <select id="st-map-streetview" type="text" name="enable_street_views_google_map" class="form-control">
                    <option value="on" <?php echo $old_streetmode == 'on' ? 'selected' : ''; ?>><?php echo __('On', ST_TEXTDOMAIN); ?></option>
                    <option value="off" <?php echo $old_streetmode == 'off' ? 'selected' : ''; ?>><?php echo __('Off', ST_TEXTDOMAIN); ?></option>
                </select>
            </div>
        </div>
    </div>
</div>