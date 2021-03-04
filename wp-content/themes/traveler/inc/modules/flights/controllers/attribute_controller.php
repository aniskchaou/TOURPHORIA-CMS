<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/8/2017
 * Version: 1.0
 */

if(!class_exists('ST_Attribute_Controller')){
    class ST_Attribute_Controller{

        static $inst;

        function __construct()
        {
            if(function_exists('get_tax_meta')) {
                //st_airline taxonomy
                add_action('st_airline_edit_form_fields', array($this, '_edit_custom_fields_airline'));
                add_action('st_airline_add_form_fields', array($this, '_edit_custom_fields_airline'));
                add_action('edited_st_airline', array($this, '_save_custom_fields_airline'));
                add_action('created_st_airline', array($this, '_save_custom_fields_airline'), 10, 2);

                //st_airport taxonomy
                add_action('st_airport_edit_form_fields', array($this, '_edit_custom_fields_airport'));
                add_action('st_airport_add_form_fields', array($this, '_create_custom_fields_airport'));
                add_action('edited_st_airport', array($this, '_save_custom_fields_airport'));
                add_action('created_st_airport', array($this, '_save_custom_fields_airport'), 10, 2);
                add_action( 'delete_term', [$this, 'delete_airport'], 10, 4 );
                add_filter('manage_st_airport_custom_column', array($this, 'add_st_airport_column_content'),10, 3);

                add_filter('manage_edit-st_airport_columns', array($this, 'add_st_airport_columns'));
            }

        }

        function add_st_airport_columns($columns){
            $columns['iata_airport'] = esc_html__('Iata Airport', ST_TEXTDOMAIN);
            $columns['location_id'] = esc_html__('Location', ST_TEXTDOMAIN);
            return $columns;
        }

        function add_st_airport_column_content($content, $column_name, $term_id){
            switch ($column_name) {
                case 'location_id':
                    if($location_id = get_tax_meta($term_id , 'location_id'))
                        $content = get_the_title($location_id);
                    break;
                case 'iata_airport':
                        $content = get_tax_meta($term_id , 'iata_airport');
                    break;
                default:
                    break;
            }
            return $content;
        }

        function _edit_custom_fields_airline($term_object){
            if(empty($term_object->term_id)) $airline_id = 0; else $airline_id = $term_object->term_id;

            $airline_logo = get_tax_meta($airline_id , 'airline_logo');
            $thumbnail_url = '';
            $thumbnail_image = wp_get_attachment_image_src($airline_logo, 'thumbnail');
            if(!empty($thumbnail_image[0])){
                $thumbnail_url = $thumbnail_image[0];
            }
            wp_enqueue_script('st-flight-admin');
            wp_enqueue_style('st-flight-admin-css');
            wp_enqueue_media();
            ?>
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label><?php echo esc_html__('Airline Logo', ST_TEXTDOMAIN); ?></label>
                </th>
                <td>
                    <div class="upload-wrapper">
                        <div class="upload-items">
                            <?php
                            if( !empty( $thumbnail_url ) ):
                                ?>
                                <div class="upload-item">
                                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_html__('Airline Logo', ST_TEXTDOMAIN)?>" class="frontend-image img-responsive">
                                </div>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" class="save-image-id" name="airline_logo" value="<?php echo esc_attr($airline_logo); ?>">
                        <button type="button" class="upload-button <?php  if( empty( $thumbnail_url ) ) echo 'no_image'; ?>" data-uploader_title="<?php esc_html_e('Select an airline logo image to upload', ST_TEXTDOMAIN); ?>" data-uploader_button_text="<?php esc_html_e('Use this image', ST_TEXTDOMAIN); ?>"><?php echo esc_html__('Upload', ST_TEXTDOMAIN); ?></button>
                        <button type="button" class="delete-button <?php  if( empty( $thumbnail_url ) ) echo 'none'; ?>" data-delete-title="<?php echo esc_html__('Do you want delete this logo?', ST_TEXTDOMAIN)?>"><?php echo esc_html__('Delete', ST_TEXTDOMAIN); ?></button>
                    </div>
                </td>
            </tr>

            <?php
        }

        function _save_custom_fields_airline($airline_id){
            if(empty($airline_id)) return;

            $airline_logo = STInput::post('airline_logo');
            update_tax_meta($airline_id,'airline_logo',$airline_logo);
        }

        function _edit_custom_fields_airport($term_object){
            if(empty($term_object->term_id)) $airport_id = 0; else $airport_id = $term_object->term_id;

            wp_enqueue_script('st-flight-admin');
            wp_enqueue_style('st-flight-admin-css');
            $iata_airport = get_tax_meta($airport_id , 'iata_airport');
            $location_id = get_tax_meta($airport_id , 'location_id');
            ?>
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label><?php echo esc_html__('Iata Airport ID', ST_TEXTDOMAIN); ?></label>
                </th>
                <td>
                    <input type="text" name="iata_airport" value="<?php echo esc_attr($iata_airport); ?>">
                </td>
            </tr>
            <?php
            global $post;
            $locations = get_posts(array(
                'post_type' => 'location',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'title',
                'order' => 'ASC'
            ));
            ?>
            <tr class="form-field">
                <th scope="row" valign="top">
                    <?php echo esc_html__('Select Location', ST_TEXTDOMAIN); ?>
                </th>
                <td>
                    <select name="location_id" class="st-location-airport">
                    <?php

                    foreach($locations as $post){
                        setup_postdata($post);
                        echo '<option '.selected(get_the_ID(), $location_id, false).' value="'.get_the_ID().'">'.get_the_title().'</option>';
                    }
                    echo '</select>
                </td>';

                ?>
            </tr>
            <tr>
                <th scope="row" valign="top">
                    <?php echo esc_html__('Google Map', ST_TEXTDOMAIN); ?>
                </th>
                <td>
                    <?php 
                        echo st_flight_load_view('admin/map_field', false, ['term_id' => $term_object->term_id]);
                    ?>
                </td>
            </tr>
            <?php
            wp_reset_postdata();
        }

        function _create_custom_fields_airport(){
            global $post;
            wp_enqueue_script('st-flight-admin');
            wp_enqueue_style('st-flight-admin-css');
            ?>
            <div class="form-field term-iata-wrap">
                <label><?php echo esc_html__('Iata Airport ID', ST_TEXTDOMAIN); ?>
                    <input type="text" name="iata_airport" value=""></label>
            </div>
            <?php
            $locations = get_posts(array(
                'post_type' => 'location',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'title',
                'order' => 'ASC'
            ));
            ?>
            <div class="form-field term-iata-wrap">
                <label><?php echo esc_html__('Select Location', ST_TEXTDOMAIN); ?>
                    <select name="location_id" class="st-location-airport">
            <?php

            foreach($locations as $post){
                setup_postdata($post);
                echo '<option value="'.get_the_ID().'">'.get_the_title().'</option>';
            }
            echo '</select></label></div>';

            echo st_flight_load_view('admin/map_field', false);

            wp_reset_postdata();
        }

        function _save_custom_fields_airport($airport_id){
            if(empty($airport_id)) return;

            $iata_airport = STInput::post('iata_airport');
            update_tax_meta($airport_id,'iata_airport',$iata_airport);
            $location_id = STInput::post('location_id');
            update_tax_meta($airport_id,'location_id',$location_id);

            $airport = ST_Flight_Airport_Models::inst();

            if($airport->get_data($airport_id)){
                $data = array(
                    'iata_id' => $iata_airport,
                    'location' => $location_id,
                );
                $airport->update_data($data, array('airport_id' => $airport_id));
            }else{
                $data = array(
                    'airport_id' => $airport_id,
                    'iata_id' => $iata_airport,
                    'location' => $location_id,
                );
                $airport->insert_data($data);
            }

            $ap_location = ST_Flight_Location_Models::inst();
            
            $id = $ap_location->get_id($airport_id);

            $data = [
                'airport_id' => $airport_id,
                'map_lat' => STInput::post('map_lat', ''),
                'map_lng' => STInput::post('map_lng', ''),
                'map_address' => STInput::post('map_address', ''),
                'map_zoom' => STInput::post('map_zoom', ''),
                'map_country' => STInput::post('map_country', ''),
            ];
            foreach($data as $key => $val){
                update_term_meta( $airport_id, $key, $val );
            }
            if($id){
                $ap_location->update_data($data, ['id' => $id]);
            }else{
                $ap_location->insert_data($data);
            }

        }

        public function delete_airport($term, $tt_id, $taxonomy, $deleted_term){
            $ap_location = ST_Flight_Location_Models::inst();
            
            $ap_location->delete($term);
        }

        static function inst(){
            if(!self::$inst)
                self::$inst = new self();

            return self::$inst;
        }
    }
    ST_Attribute_Controller::inst();
}