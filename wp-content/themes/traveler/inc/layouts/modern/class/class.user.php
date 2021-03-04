<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STUser_f
     *
     * Created by ShineTheme
     *
     */
    $cancel_order_id    = '';
    $cancel_cancel_data = [];
    if ( !class_exists( 'STUser_f' ) ) {
        class STUser_f extends TravelerObject
        {
            public static $msg = '';
            public static $msg_uptp = '';
            public static $validator;

            function init()
            {
                parent::init();
                self::$validator = new STValidate();

                add_action( 'init', [ $this, 'st_is_partner' ] );
                add_action( 'init', [ $this, 'st_login_func' ] );
                add_action( 'init', [ $this, 'update_user' ] );
                add_action( 'init', [ $this, 'update_info_partner' ] );
                add_action( 'init', [ $this, 'update_pass' ] );
                add_action( 'init', [ $this, 'upload_image' ] );
                add_action( 'init', [ $this, 'upgrade_to_partner' ] );

                add_action( 'init', [ $this, 'st_update_post_type_hotel' ], 50 );
                add_action( 'init', [ $this, 'st_update_post_type_room' ], 50 );

                add_action( 'init', [ $this, 'st_update_post_type_rental' ], 50 );
                add_action( 'init', [ $this, 'st_update_rental_room' ], 50 );

                add_action( 'init', [ $this, 'st_update_post_type_tours' ], 50 );

                add_action( 'init', [ $this, 'st_update_post_type_flight' ], 50 );

                add_action( 'init', [ $this, 'st_update_post_type_activity' ], 50 );

                add_action( 'init', [ $this, 'st_update_post_type_cars' ], 50 );

                add_action( 'init', [ $this, 'st_insert_post_type_location' ], 50 );
                add_action( 'init', [ $this, 'st_write_review' ], 50 );

                add_action( 'init', [ $this, '_update_certificate_user' ], 50 );


                add_action( 'wp_ajax_st_add_wishlist', [ $this, 'st_add_wishlist_func' ] );
                add_action( 'wp_ajax_nopriv_st_add_wishlist', [ $this, 'st_add_wishlist_func' ] );

                add_action( 'wp_ajax_st_remove_wishlist', [ $this, 'st_remove_wishlist_func' ] );
                add_action( 'wp_ajax_nopriv_st_remove_wishlist', [ $this, 'st_remove_wishlist_func' ] );

                add_action( 'wp_ajax_st_load_more_wishlist', [ $this, 'st_load_more_wishlist_func' ] );
                add_action( 'wp_ajax_nopriv_st_load_more_wishlist', [ $this, 'st_load_more_wishlist_func' ] );

                add_action( 'wp_ajax_st_remove_post_type', [ $this, 'st_remove_post_type_func' ] );
                add_action( 'wp_ajax_nopriv_st_remove_post_type', [ $this, 'st_remove_post_type_func' ] );

                add_action( 'wp_ajax_st_change_status_post_type', [ $this, 'st_change_status_post_type_func' ] );
                add_action( 'wp_ajax_nopriv_st_change_status_post_type', [ $this, 'st_change_status_post_type_func' ] );


                add_action( 'template_redirect', [ $this, 'check_login' ] );

                add_action( 'wp_ajax_st_load_more_history_book', [ $this, 'get_book_history' ] );
                add_action( 'wp_ajax_nopriv_st_load_more_history_book', [ $this, 'get_book_history' ] );


                add_action( 'wp_ajax_st_load_month_by_year_partner', [ $this, '_st_load_month_by_year_partner' ] );
                add_action( 'wp_ajax_nopriv_st_load_month_by_year_partner', [ $this, '_st_load_month_by_year_partner' ] );
                add_action( 'wp_ajax_st_load_day_by_month_and_year_partner', [ $this, '_st_load_day_by_month_and_year_partner' ] );
                add_action( 'wp_ajax_nopriv_st_load_day_by_month_and_year_partner', [ $this, '_st_load_day_by_month_and_year_partner' ] );

                add_action( 'wp_ajax_st_load_month_all_time_by_year_partner', [ $this, '_st_load_month_all_time_by_year_partner' ] );
                add_action( 'wp_ajax_nopriv_st_load_month_all_time_by_year_partner', [ $this, '_st_load_month_all_time_by_year_partner' ] );
                add_action( 'wp_ajax_st_load_day_all_time_by_month_and_year_partner', [ $this, '_st_load_day_all_time_by_month_and_year_partner' ] );

                add_action( 'wp_ajax_nopriv_st_load_day_all_time_by_month_and_year_partner', [ $this, '_st_load_day_all_time_by_month_and_year_partner' ] );


                add_action( 'wp_ajax_update_certificates', [ $this, '_update_certificates' ] );
                add_action( 'wp_ajax_nopriv_update_certificates', [ $this, '_update_certificates' ] );

                add_action( 'wp_ajax_send_email_for_user_partner', [ $this, '_send_email_for_user_partner' ] );
                add_action( 'wp_ajax_nopriv_send_email_for_user_partner', [ $this, '_send_email_for_user_partner' ] );

                add_action( 'wp_ajax_get_list_item_service_available', [ $this, '_get_list_item_service_available' ] );
                add_action( 'wp_ajax_nopriv_get_list_item_service_available', [ $this, '_get_list_item_service_available' ] );

                add_action( 'wp_ajax_st_get_cancel_booking_step_1', [ $this, 'st_get_cancel_booking_step_1' ] );
                add_action( 'wp_ajax_st_get_cancel_booking_step_2', [ $this, 'st_get_cancel_booking_step_2' ] );
                add_action( 'wp_ajax_st_get_cancel_booking_step_3', [ $this, 'st_get_cancel_booking_step_3' ] );
                add_action( 'wp_ajax_st_get_refund_infomation', [ $this, 'st_get_refund_infomation' ] );
                add_action( 'wp_ajax_st_check_complete_refund', [ $this, 'st_check_complete_refund' ] );

                add_action( 'wp_ajax_nopriv_st_login_popup', [ $this, '_st_login_popup' ] );
                add_action( 'wp_ajax_nopriv_st_registration_popup', [ $this, '_st_registration_popup' ] );
                add_action( 'wp_ajax_nopriv_st_reset_password', [ $this, '_st_reset_password' ] );

                add_action( 'init', [ __CLASS__, 'session_init' ] );

                add_action( 'init', [ $this, 'reset_password' ], 50 );

                /**
                 *   Upload media partner
                 * @since 1.3.1
                 **/
                add_action( 'init', [ $this, '_enuque_media_partner' ] );


                /**
                 * @since 2.0.0
                 * By Quandq
                 */
                add_action( 'wp_ajax_st_get_info_booking_history', [ $this, '_st_get_info_booking_history' ] );
                add_action( 'wp_ajax_nopriv_st_get_info_booking_history', [ $this, '_st_get_info_booking_history' ] );
                add_action( 'wp_ajax_st_sendmail_expire_customer', [ $this, '_st_sendmail_expire_customer' ] );

                add_action( 'wp_ajax_st_partner_approve_booking', [ $this, '_st_partner_approve_booking' ] );

                //Inventory Hotel
                add_filter('st_partner_hotel_tabs', array($this, 'st_partner_hotel_tab_inventory'));
                add_filter('st_partner_hotel_content', array($this, 'st_partner_hotel_content_inventory'));

                add_filter('st_partner_hotel_facility', [$this, 'st_partner_hotel_facility']);
                add_filter('st_partner_hotel_room_facility', array($this, 'st_partner_hotel_room_facility'));
                add_filter('st_partner_hotel_room_content', array($this, 'st_partner_hotel_room_content_payment'));
                add_filter('st_partner_hotel_room_content', array($this, 'st_partner_hotel_room_content_availability'));
                add_filter('st_partner_hotel_room_tabs', array($this, 'st_partner_hotel_room_tabs_payment'));
                add_filter('st_partner_tour_info', array($this, 'st_partner_tour_info'));
                add_filter('st_partner_tour_content', array($this, 'st_partner_hotel_room_content_payment'));
                add_filter('st_partner_tour_content', array($this, 'st_partner_tour_remain_tab_content'));
                add_filter('st_partner_tour_tabs', array($this, 'st_partner_tour_tabs_payment'));
                add_filter('st_partner_activity_info', array($this, 'st_partner_activity_info'));
                add_filter('st_partner_activity_content', array($this, 'st_partner_hotel_room_content_payment'));
                add_filter('st_partner_tour_content', array($this, 'st_partner_tour_remain_tab_content'));
                add_filter('st_partner_activity_tabs', array($this, 'st_partner_tour_tabs_payment'));
                add_filter('st_partner_car_tabs', array($this, 'st_partner_tour_tabs_payment'));
                add_filter('st_partner_car_content', array($this, 'st_partner_hotel_room_content_payment'));
                add_filter('st_partner_car_info', array($this, 'st_partner_car_info'));
                add_filter('st_partner_rental_info', array($this, 'st_partner_rental_info'));
                add_filter('st_partner_rental_tabs', array($this, 'st_partner_tour_tabs_payment'));
                add_filter('st_partner_rental_content', array($this, 'st_partner_hotel_room_content_payment'));
                add_filter('st_partner_rental_content', array($this, 'st_partner_tour_remain_tab_content'));
                add_filter('st_partner_rental_room_facility', array($this, 'st_partner_rental_room_facility'));
                add_filter('st_partner_tour_tabs', array($this, 'st_partner_tour_tabs_custom_field'));
                add_filter('st_partner_tour_content', array($this, 'st_partner_tour_content_custom_field'));
                //Activity tab
                add_filter('st_partner_activity_tabs', array($this, 'st_partner_tour_tabs_custom_fields'));
                add_filter('st_partner_activity_content', array($this, 'st_partner_tour_remain_tab_content'));
                add_filter('st_partner_activity_content', array($this, 'st_partner_activity_content_customfields'));
                //Car tab
                add_filter('st_partner_car_tabs', array($this, 'st_partner_car_tabs_custom_fields'));
                add_filter('st_partner_car_content', array($this, 'st_partner_car_content_customfields'));
                //Rental tab
                add_filter('st_partner_rental_tabs', array($this, 'st_partner_rental_tabs_custom_fields'));
                add_filter('st_partner_rental_content', array($this, 'st_partner_rental_content_customfields'));

                //Flight
                add_filter('st_partner_flight_tabs', array($this, 'st_partner_flight_tabs_more'));
                add_filter('st_partner_flight_content', array($this, 'st_partner_flight_content_more'));

                //Create service ajax
                add_action('wp_ajax_st_partner_create_service', array($this, '__stPartnerCreateService'));
                add_action('wp_ajax_st_partner_create_service_room', array($this, '__stPartnerCreateServiceRoom'));
                add_action('wp_ajax_st_partner_create_service_tour', array($this, '__stPartnerCreateServiceTour'));
                add_action('wp_ajax_st_partner_create_service_activity', array($this, '__stPartnerCreateServiceActivity'));
                add_action('wp_ajax_st_partner_create_service_car', array($this, '__stPartnerCreateServiceCar'));
                add_action('wp_ajax_st_partner_create_service_rental', array($this, '__stPartnerCreateServiceRental'));
                add_action('wp_ajax_st_partner_create_service_rental_room', array($this, '__stPartnerCreateServiceRentalRoom'));
                add_action('wp_ajax_st_partner_create_service_flight', array($this, '__stPartnerCreateServiceFlight'));
            }

            public function __stPartnerCreateServiceFlight(){
                $step = STInput::post('step', 1);
                $step_name = STInput::post('step_name', 'general');
                switch ($step_name){
                    case 'general':
                        $valid = $this->stFlightValidate(1);
                        if($valid){
                            if (!empty($_REQUEST['btn_insert_post_type_flight']) && empty(STInput::request('post_id'))) {
                                if (st()->get_option('partner_post_by_admin', 'on') == 'on') {
                                    $post_status = 'draft';
                                } else {
                                    $post_status = 'publish';
                                }
                                if (current_user_can('manage_options')) {
                                    $post_status = 'publish';
                                }
                                if (STInput::request('save_and_preview') == "true") {
                                    $post_status = 'draft';
                                }

                                $current_user = wp_get_current_user();

                                $my_post = [
                                    'post_title' => STInput::request('st_title', 'Title'),
                                    'post_content' => '',
                                    'post_status' => $post_status,
                                    'post_author' => $current_user->ID,
                                    'post_type' => 'st_flight',
                                    'post_excerpt' => ''
                                ];
                                $post_id = wp_insert_post($my_post);
                            }else{
                                $post_id = STInput::request('post_id');
                            }

                            if (!empty($post_id)) {
                                $my_post = [
                                    'ID' => $post_id,
                                    'post_title' => STInput::request('st_title'),
                                    'post_content' => STInput::request('st_content'),
                                    'post_excerpt' => stripslashes(STInput::request('st_desc')),
                                ];

                                if (st()->get_option('partner_post_by_admin', 'on') == 'off') {
                                    $my_post['post_status'] = 'publish';
                                }

                                $admin_packages = STAdminPackages::get_inst();
                                $set_status_publish = $admin_packages->count_item_can_public_status(get_current_user_id(), $post_id);
                                if ($admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ($set_status_publish !== 'unlimited' && $set_status_publish <= 0)) {
                                    $my_post['post_status'] = 'draft';
                                }

                                wp_update_post($my_post);

                                update_post_meta( $post_id, 'airline', STInput::request( 'airline' ) );
                                if ( $airline = STInput::request( 'airline' ) ) {
                                    wp_set_post_terms( $post_id, $airline, 'st_airline' );
                                }
                                update_post_meta( $post_id, 'origin', STInput::request( 'origin' ) );
                                update_post_meta( $post_id, 'destination', STInput::request( 'destination' ) );
                                update_post_meta( $post_id, 'departure_time', STInput::request( 'departure_time' ) );
                                update_post_meta( $post_id, 'total_time', STInput::request( 'total_time' ) );
                                update_post_meta( $post_id, 'flight_type', STInput::request( 'flight_type' ) );
                            }

                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 2,
                                'next_step_name' => $step_name,
                                'post_id' => $post_id
                            ));
                            die;
                        }else{
                            $err = $this->stSetErrorMessage(array('st_title', 'airline', 'origin', 'destination', 'departure_time', 'total_time[hour]', 'total_time[minute]', 'flight_type'));
                            echo json_encode(array(
                                'status' => false,
                                'err' => $err
                            ));
                            die;
                        }
                        break;
                    case 'tax_option':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            update_post_meta( $post_id, 'max_ticket', STInput::request( 'max_ticket' ) );
                            update_post_meta( $post_id, 'enable_tax', STInput::request( 'enable_tax' ) );
                            update_post_meta( $post_id, 'vat_amount', STInput::request( 'vat_amount' ) );
                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 3,
                                'next_step_name' => $step_name,
                                'post_id' => $post_id
                            ));
                            die;
                        }
                        break;
                    case 'payments':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $data_paypment = STPaymentGateways::get_payment_gateways();
                            if (!empty($data_paypment) and is_array($data_paypment)) {
                                foreach ($data_paypment as $k => $v) {
                                    update_post_meta($post_id, 'is_meta_payment_gateway_' . $k, STInput::request('is_meta_payment_gateway_' . $k));
                                }
                            }
                            if($step != 'final'){
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 4,
                                    'next_step_name' => $step_name,
                                    'sc' => 'edit-flight',
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $this->getSuccessEditService('edit-flight', $post_id);
                            }
                        }
                        break;
                    case 'availability':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $this->getSuccessEditService('edit-flight', $post_id);
                        }
                        break;

                }
            }
            private function stFlightValidate($step = 1){
                $validator = self::$validator;
                switch ($step){
                    case 1:
                        $validator->set_rules('st_title', __("Title", ST_TEXTDOMAIN), 'required|min_length[6]|max_length[100]');
                        $validator->set_rules('airline', __("Airline Company", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('origin', __("Origin", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('destination', __("Destination", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('departure_time', __("Departure time", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('total_time[hour]', __("Hours", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('total_time[minute]', __("Minutes", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('flight_type', __("Flight Type", ST_TEXTDOMAIN), 'required');
                        break;
                    case 2:
                        $validator->set_rules('id_featured_image', __("Featured image", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('id_gallery', __("Gallery", ST_TEXTDOMAIN), 'required');
                        break;
                    case 3:
                        $validator->set_rules('adult_number', __("Adults Number", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('children_number', __("Children Number", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('bed_number', __("Beds Number", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('room_footage', __("Room Footage (square feet)", ST_TEXTDOMAIN), 'required');
                        break;
                }

                $result = $validator->run();
                return $result;
            }
            public function st_partner_flight_tabs_more($fields){
                array_push($fields, array(
                    'name' => 'payments',
                    'label' => __('3. Payments', ST_TEXTDOMAIN)
                ));

                $sc = STInput::get('sc');
                $id = STInput::get('id');
                if($sc == 'edit-flight'){
                    if(!empty($id)){
                        array_push($fields, array(
                            'name' => 'availability',
                            'label' => __('4. Availability', ST_TEXTDOMAIN)
                        ));
                    }
                }

                return $fields;
            }
            public function st_partner_flight_content_more($fields){
                $data_paypment = STPaymentGateways::get_payment_gateways();
                if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                    foreach ( $data_paypment as $k => $v ) {
                        $fields['payments'][] = [
                            'type' => 'select',
                            'label' => $v->get_name(),
                            'name' => 'is_meta_payment_gateway_' . $k,
                            'col' => '6',
                            'options' => array(
                                'on' => __('On', ST_TEXTDOMAIN),
                                'off' => __('Off', ST_TEXTDOMAIN),
                            ),
                            'clear' => true
                        ];
                    }
                }

                $sc = STInput::get('sc');
                $id = STInput::get('id');
                if($sc == 'edit-flight') {
                    if (!empty($id)) {
                        $fields['availability'] = array(
                            array(
                                'type' => 'availability',
                                'label' => __('Property Name', ST_TEXTDOMAIN),
                                'name' => 'st_title',
                                'col' => '12',
                                'plh' => '',
                                'required' => true
                            ),
                        );
                    }
                }

                return $fields;
            }
            public function st_partner_rental_content_customfields($fields){
                $custom_field = st()->get_option( 'rental_unlimited_custom_field' );
                if(!empty( $custom_field ) and is_array( $custom_field )) {
                    $fields['custom_fields'] = array(array(
                        'type' => 'custom_fields',
                        'label' => __('Custom Fields', ST_TEXTDOMAIN),
                        'name' => 'custom_fiels',
                        'col' => '12',
                        'plh' => '',
                        'option_name' => 'rental_unlimited_custom_field',
                        'required' => false
                    ));
                }

                return $fields;
            }
            public function st_partner_rental_tabs_custom_fields($fields){
                $id = STInput::get('id');

                $custom_field = st()->get_option( 'rental_unlimited_custom_field' );
                if(!empty($id)){
                    if(!empty( $custom_field ) and is_array( $custom_field )) {
                        array_push($fields, array(
                            'name' => 'custom_fields',
                            'label' => __('8. Custom Fields', ST_TEXTDOMAIN)
                        ));
                    }
                }else{
                    if(!empty( $custom_field ) and is_array( $custom_field )) {
                        array_push($fields, array(
                            'name' => 'custom_fields',
                            'label' => __('6. Custom Fields', ST_TEXTDOMAIN)
                        ));
                    }
                }

                return $fields;
            }
            public function st_partner_car_content_customfields($fields){
                $custom_field = st()->get_option( 'st_cars_unlimited_custom_field' );
                if(!empty( $custom_field ) and is_array( $custom_field )) {
                    $fields['custom_fields'] = array(array(
                        'type' => 'custom_fields',
                        'label' => __('Custom Fields', ST_TEXTDOMAIN),
                        'name' => 'custom_fiels',
                        'col' => '12',
                        'plh' => '',
                        'option_name' => 'st_cars_unlimited_custom_field',
                        'required' => false
                    ));
                }

                return $fields;
            }
            public function st_partner_car_tabs_custom_fields($fields){
                $custom_field = st()->get_option( 'st_cars_unlimited_custom_field' );
                if(!empty( $custom_field ) and is_array( $custom_field )) {
                    array_push($fields, array(
                        'name' => 'custom_fields',
                        'label' => __('6. Custom Fields', ST_TEXTDOMAIN)
                    ));
                }

                return $fields;
            }
            public function st_partner_activity_content_customfields($fields){
                $custom_field = st()->get_option( 'st_activity_unlimited_custom_field' );
                if(!empty( $custom_field ) and is_array( $custom_field )) {
                    $fields['custom_fields'] = array(array(
                        'type' => 'custom_fields',
                        'label' => __('Custom Fields', ST_TEXTDOMAIN),
                        'name' => 'custom_fiels',
                        'col' => '12',
                        'plh' => '',
                        'option_name' => 'st_activity_unlimited_custom_field',
                        'required' => false
                    ));
                }

                return $fields;
            }
            public function st_partner_tour_tabs_custom_fields($fields){
                $id = STInput::get('id');

                $custom_field = st()->get_option( 'st_activity_unlimited_custom_field' );
                if(!empty($id)){
                    if(!empty( $custom_field ) and is_array( $custom_field )) {
                        array_push($fields, array(
                            'name' => 'custom_fields',
                            'label' => __('8. Custom Fields', ST_TEXTDOMAIN)
                        ));
                    }
                }else{
                    if(!empty( $custom_field ) and is_array( $custom_field )) {
                        array_push($fields, array(
                            'name' => 'custom_fields',
                            'label' => __('6. Custom Fields', ST_TEXTDOMAIN)
                        ));
                    }
                }

                return $fields;
            }
            public function st_partner_tour_content_custom_field($fields){
                $fields['custom_fields'] = array(array(
                    'type' => 'custom_fields',
                    'label' => __('Custom Fields', ST_TEXTDOMAIN),
                    'name' => 'custom_fiels',
                    'col' => '12',
                    'plh' => '',
                    'option_name' => 'tours_unlimited_custom_field',
                    'required' => false
                ));

                return $fields;
            }
            public function st_partner_tour_tabs_custom_field($fields){
                $id = STInput::get('id');

                $custom_field = st()->get_option( 'tours_unlimited_custom_field' );
                if(!empty($id)){
                    if(!empty( $custom_field ) and is_array( $custom_field )) {
                        array_push($fields, array(
                            'name' => 'custom_fields',
                            'label' => __('9. Custom Fields', ST_TEXTDOMAIN)
                        ));
                    }
                }else{
                    if(!empty( $custom_field ) and is_array( $custom_field )) {
                        array_push($fields, array(
                            'name' => 'custom_fields',
                            'label' => __('6. Custom Fields', ST_TEXTDOMAIN)
                        ));
                    }
                }


                return $fields;
            }
            public function st_partner_tour_remain_tab_content($fields){
                $id = STInput::get('id');
                if (!empty($id)) {
                    $sc = STInput::get('sc');
                    if (!empty($sc) && $sc == 'edit-tours') {
                        $fields['package'] = array(
                            array(
                                'type' => 'package',
                                'label' => __('Tour Packages', ST_TEXTDOMAIN),
                                'name' => 'tour_package',
                                'col' => '12',
                                'plh' => '',
                                'required' => false
                            ),
                        );

                        $fields['availability'] = array(
                            array(
                                'type' => 'availability',
                                'label' => __('Property Name', ST_TEXTDOMAIN),
                                'name' => 'st_title',
                                'col' => '12',
                                'plh' => '',
                                'required' => false
                            ),
                        );

                        $fields['ical'] = array(
                            array(
                                'type' => 'ical',
                                'label' => __('iCal Sync', ST_TEXTDOMAIN),
                                'name' => 'ical',
                                'col' => '12',
                                'plh' => '',
                                'required' => false
                            ),
                        );
                    }
                    if (!empty($sc) && $sc == 'edit-activity') {
                        $fields['availability'] = array(
                            array(
                                'type' => 'availability',
                                'label' => __('Property Name', ST_TEXTDOMAIN),
                                'name' => 'st_title',
                                'col' => '12',
                                'plh' => '',
                                'required' => false
                            ),
                        );

                        $fields['ical'] = array(
                            array(
                                'type' => 'ical',
                                'label' => __('iCal Sync', ST_TEXTDOMAIN),
                                'name' => 'ical',
                                'col' => '12',
                                'plh' => '',
                                'required' => false
                            ),
                        );
                    }
                    if (!empty($sc) && $sc == 'edit-rental') {
                        $fields['availability'] = array(
                            array(
                                'type' => 'availability',
                                'label' => __('Availability', ST_TEXTDOMAIN),
                                'name' => 'st_title',
                                'col' => '12',
                                'plh' => '',
                                'required' => false
                            ),
                        );

                        $fields['ical'] = array(
                            array(
                                'type' => 'ical',
                                'label' => __('iCal Sync', ST_TEXTDOMAIN),
                                'name' => 'ical',
                                'col' => '12',
                                'plh' => '',
                                'required' => false
                            ),
                        );
                    }
                }
                return $fields;
            }
            public function st_partner_hotel_room_content_availability($fields){
                $sc = STInput::get('sc');
                if(!empty($sc) && $sc == 'edit-tours') {
                    $post_id = STInput::get('id');
                    if(!empty($post_id)) {
                        $fields['availability'] = array(
                            array(
                                'type' => 'availability',
                                'label' => __('Property Name', ST_TEXTDOMAIN),
                                'name' => 'st_title',
                                'col' => '12',
                                'plh' => '',
                                'required' => true
                            ),
                        );

                        $fields['ical'] = array(
                            array(
                                'type' => 'ical',
                                'label' => __('iCal Sync', ST_TEXTDOMAIN),
                                'name' => 'ical',
                                'col' => '12',
                                'plh' => '',
                                'required' => true
                            ),
                        );
                    }
                }
                if(!empty($sc) && $sc == 'edit-room') {
                    $post_id = STInput::get('id');
                    if(!empty($post_id)) {
                        $fields['availability'] = array(
                            array(
                                'type' => 'availability',
                                'label' => __('Property Name', ST_TEXTDOMAIN),
                                'name' => 'st_title',
                                'col' => '12',
                                'plh' => '',
                                'required' => true
                            ),
                        );

                        $fields['ical'] = array(
                            array(
                                'type' => 'ical',
                                'label' => __('iCal Sync', ST_TEXTDOMAIN),
                                'name' => 'ical',
                                'col' => '12',
                                'plh' => '',
                                'required' => true
                            ),
                        );
                    }
                }

                return $fields;
            }
            public function st_partner_hotel_content_inventory($fields){
                $sc = STInput::get('sc');
                if(!empty($sc) && $sc == 'edit-hotel') {
                    $id = STInput::get('id');
                    if (!empty($id)) {
                        $fields['inventory'] = array(array(
                            'type' => 'inventory',
                            'label' => __('Inventory', ST_TEXTDOMAIN),
                            'name' => 'inventory',
                            'col' => '12',
                            'plh' => '',
                            'required' => false
                        ));
                    }
                }

                $fields['custom_fields'] = array(array(
                    'type' => 'custom_fields',
                    'label' => __('Custom Fields', ST_TEXTDOMAIN),
                    'name' => 'custom_fiels',
                    'col' => '12',
                    'plh' => '',
                    'option_name' => 'hotel_unlimited_custom_field',
                    'required' => false
                ));

                return $fields;
            }
            public function st_partner_hotel_tab_inventory($fields){
                $sc = STInput::get('sc');
                $id = STInput::get('id');
                if(!empty($sc) && $sc == 'edit-hotel'){
                    if(!empty($id)){
                        array_push($fields, array(
                            'name' => 'inventory',
                            'label' => __('6. Inventory', ST_TEXTDOMAIN)
                        ));
                    }
                }

                $custom_field = st()->get_option( 'hotel_unlimited_custom_field' );
                if(!empty($id)){
                    if(!empty( $custom_field ) and is_array( $custom_field )) {
                        array_push($fields, array(
                            'name' => 'custom_fields',
                            'label' => __('7. Custom Fields', ST_TEXTDOMAIN)
                        ));
                    }
                }else{
                    if(!empty( $custom_field ) and is_array( $custom_field )) {
                        array_push($fields, array(
                            'name' => 'custom_fields',
                            'label' => __('6. Custom Fields', ST_TEXTDOMAIN)
                        ));
                    }
                }


                return $fields;
            }
            public function __stPartnerCreateServiceRentalRoom(){
                $step = STInput::post('step', 1);
                $step_name = STInput::post('step_name', 'basic_info');
                switch ($step_name){
                    case 'basic_info':
                        $valid = $this->stRentalRoomValidate(1);
                        if($valid){
                            if (!empty($_REQUEST['btn_insert_post_type_rental_room']) && empty(STInput::request('post_id'))) {
                                if (st()->get_option('partner_post_by_admin', 'on') == 'on') {
                                    $post_status = 'draft';
                                } else {
                                    $post_status = 'publish';
                                }
                                if (current_user_can('manage_options')) {
                                    $post_status = 'publish';
                                }
                                if (STInput::request('save_and_preview') == "true") {
                                    $post_status = 'draft';
                                }

                                $current_user = wp_get_current_user();

                                $my_post = [
                                    'post_title' => STInput::request('st_title', 'Title'),
                                    'post_content' => '',
                                    'post_status' => $post_status,
                                    'post_author' => $current_user->ID,
                                    'post_type' => 'rental_room',
                                    'post_excerpt' => ''
                                ];
                                $post_id = wp_insert_post($my_post);
                            }else{
                                $post_id = STInput::request('post_id');
                            }

                            if (!empty($post_id)) {
                                $my_post = [
                                    'ID' => $post_id,
                                    'post_title' => STInput::request('st_title'),
                                    'post_content' => STInput::request('st_content'),
                                    'post_excerpt' => stripslashes(STInput::request('st_desc')),
                                ];

                                if (st()->get_option('partner_post_by_admin', 'on') == 'off') {
                                    $my_post['post_status'] = 'publish';
                                }

                                $admin_packages = STAdminPackages::get_inst();
                                $set_status_publish = $admin_packages->count_item_can_public_status(get_current_user_id(), $post_id);
                                if ($admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ($set_status_publish !== 'unlimited' && $set_status_publish <= 0)) {
                                    $my_post['post_status'] = 'draft';
                                }

                                wp_update_post($my_post);

                                update_post_meta( $post_id, 'room_parent', STInput::request( 'room_parent' ) );
                            }

                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 2,
                                'next_step_name' => $step_name,
                                'post_id' => $post_id
                            ));
                            die;
                        }else{
                            $err = $this->stSetErrorMessage(array('st_title', 'st_content', 'st_desc', 'room_parent'));
                            echo json_encode(array(
                                'status' => false,
                                'err' => $err
                            ));
                            die;
                        }
                        break;
                    case 'photos':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            $valid = $this->stRentalRoomValidate(2);
                            if($valid) {
                                $gallery = STInput::request('id_gallery', '');
                                update_post_meta($post_id, 'gallery', $gallery);
                                $thumbnail = (int)STInput::request('id_featured_image', '');
                                set_post_thumbnail($post_id, $thumbnail);
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 3,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('id_featured_image', 'id_gallery'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'facility':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $valid = $this->stRentalRoomValidate(3);
                            if($valid){
                                if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                    if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                        $taxonomy = $_REQUEST[ 'taxonomy' ];
                                        if ( !empty( $taxonomy ) ) {
                                            $tax = [];
                                            foreach ( $taxonomy as $item ) {
                                                $tmp                = explode( ",", $item );
                                                $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                            }
                                            foreach ( $tax as $key2 => $val2 ) {
                                                wp_set_post_terms( $post_id, $val2, $key2 );
                                            }
                                        }
                                    }
                                }

                                update_post_meta( $post_id, 'adult_number', STInput::request( 'adult_number' ) );
                                update_post_meta( $post_id, 'children_number', STInput::request( 'children_number' ) );
                                update_post_meta( $post_id, 'bed_number', STInput::request( 'bed_number' ) );
                                update_post_meta( $post_id, 'room_footage', STInput::request( 'room_footage' ) );
                                $add_new_facility_title = STInput::request( 'add_new_facility_title' );
                                $add_new_facility_value = STInput::request( 'add_new_facility_value' );
                                $add_new_facility_icon  = STInput::request( 'add_new_facility_icon' );
                                if ( !empty( $add_new_facility_title ) ) {
                                    $data = [];
                                    foreach ( $add_new_facility_title as $k => $v ) {
                                        if(!empty($v) && !empty($add_new_facility_value[ $k ]) && !empty($add_new_facility_icon[ $k ])) {
                                            $data[] = ['title' => $v, 'value' => $add_new_facility_value[$k], 'facility_icon' => $add_new_facility_icon[$k]];
                                        }
                                    }
                                    update_post_meta( $post_id, 'add_new_facility', $data );
                                }else{
                                    update_post_meta( $post_id, 'add_new_facility', array() );
                                }
                                update_post_meta( $post_id, 'room_description', stripslashes( STInput::request( 'room_description' ) ) );

                                if($step != 'final'){
                                    echo json_encode(array(
                                        'status' => true,
                                        'next_step' => 4,
                                        'next_step_name' => $step_name,
                                        'post_id' => $post_id
                                    ));
                                    die;
                                }else{
                                    $this->getSuccessEditService('create-room-rental', $post_id);
                                }
                            }else{
                                $err = $this->stSetErrorMessage(array('adult_number', 'children_number', 'bed_number', 'room_footage'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;

                }
            }
            private function stRentalRoomValidate($step = 1){
                $validator = self::$validator;
                switch ($step){
                    case 1:
                        $validator->set_rules('st_title', __("Title", ST_TEXTDOMAIN), 'required|min_length[6]|max_length[100]');
                        $validator->set_rules('st_content', __("Content", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('st_desc', __("Short Intro", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('room_parent', __("Rental parent", ST_TEXTDOMAIN), 'required');
                        break;
                    case 2:
                        $validator->set_rules('id_featured_image', __("Featured image", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('id_gallery', __("Gallery", ST_TEXTDOMAIN), 'required');
                        break;
                    case 3:
                        $validator->set_rules('adult_number', __("Adults Number", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('children_number', __("Children Number", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('bed_number', __("Beds Number", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('room_footage', __("Room Footage (square feet)", ST_TEXTDOMAIN), 'required');
                        break;
                }

                $result = $validator->run();
                return $result;
            }
            public function st_partner_rental_room_facility($fields){
                $list_tax_activity = TravelHelper::get_object_taxonomies_service('rental_room');
                if( !empty( $list_tax_activity ) ){
                    foreach( $list_tax_activity as $name => $label ){
                        $list = array();
                        $terms = get_terms( $name, array(
                            'hide_empty' => false,
                        ) );
                        if(!empty($terms)){
                            foreach( $terms as $key => $val){
                                $list[$val->term_id . ',' . $val->taxonomy] = $val->name;
                            }
                        }
                        $fields[] = array(
                            'type' => 'checkbox',
                            'label' => $label,
                            'name' => 'taxonomy[]',
                            'col' => '12',
                            'plh' => '',
                            'options' => $list,
                            'col_option' => '4',
                            'seperate' => true
                        );
                    }
                }
                $arr_temp =  array(
                    array(
                        'type' => 'text',
                        'label' => __('Adults Number', ST_TEXTDOMAIN),
                        'name' => 'adult_number',
                        'col' => '6',
                        'plh' => '',
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Children Number', ST_TEXTDOMAIN),
                        'name' => 'children_number',
                        'col' => '6',
                        'plh' => '',
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Beds Number', ST_TEXTDOMAIN),
                        'name' => 'bed_number',
                        'col' => '6',
                        'plh' => '',
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Room Footage (square feet)', ST_TEXTDOMAIN),
                        'name' => 'room_footage',
                        'col' => '6',
                        'plh' => '',
                        'required' => true
                    ),
                    array(
                        'type' => 'list-item',
                        'label' => __('Facility', ST_TEXTDOMAIN),
                        'name' => 'add_new_facility',
                        'col' => '6',
                        'plh' => '',
                        'text_add' => __('Add New', ST_TEXTDOMAIN),
                        'clear' => true,
                        'fields' => array(
                            array(
                                'type' => 'text',
                                'label' => __('Title', ST_TEXTDOMAIN),
                                'name' => 'add_new_facility_title'
                            ),
                            array(
                                'type' => 'text',
                                'label' => __('Value', ST_TEXTDOMAIN),
                                'name' => 'add_new_facility_value',
                            ),
                            array(
                                'type' => 'text',
                                'label' => __('Icon', ST_TEXTDOMAIN),
                                'plh' => __('(eg: fa-facebook)', ST_TEXTDOMAIN),
                                'name' => 'add_new_facility_icon',
                            ),
                        )
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => __('Description', ST_TEXTDOMAIN),
                        'name' => 'room_description',
                        'col' => '12',
                        'plh' => '',
                        'required' => false,
                        'rows' => 7
                    ),
                );

                $fields = array_merge($fields, $arr_temp);

                return $fields;
            }
            public function __stPartnerCreateServiceRental(){
                $step = STInput::post('step', 1);
                $step_name = STInput::post('step_name', 'basic_info');
                switch ($step_name){
                    case 'basic_info':
                        $valid = $this->stRentalValidate(1);
                        if($valid){
                            if (!empty($_REQUEST['btn_insert_post_type_rental']) && empty(STInput::request('post_id'))) {
                                if (st()->get_option('partner_post_by_admin', 'on') == 'on') {
                                    $post_status = 'draft';
                                } else {
                                    $post_status = 'publish';
                                }
                                if (current_user_can('manage_options')) {
                                    $post_status = 'publish';
                                }
                                if (STInput::request('save_and_preview') == "true") {
                                    $post_status = 'draft';
                                }

                                $current_user = wp_get_current_user();

                                $my_post = [
                                    'post_title' => STInput::request('st_title', 'Title'),
                                    'post_content' => '',
                                    'post_status' => $post_status,
                                    'post_author' => $current_user->ID,
                                    'post_type' => 'st_rental',
                                    'post_excerpt' => ''
                                ];
                                $post_id = wp_insert_post($my_post);
                            }else{
                                $post_id = STInput::request('post_id');
                            }

                            if (!empty($post_id)) {
                                $my_post = [
                                    'ID' => $post_id,
                                    'post_title' => STInput::request('st_title'),
                                    'post_content' => STInput::request('st_content'),
                                    'post_excerpt' => stripslashes(STInput::request('st_desc')),
                                ];

                                if (st()->get_option('partner_post_by_admin', 'on') == 'off') {
                                    $my_post['post_status'] = 'publish';
                                }

                                $admin_packages = STAdminPackages::get_inst();
                                $set_status_publish = $admin_packages->count_item_can_public_status(get_current_user_id(), $post_id);
                                if ($admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ($set_status_publish !== 'unlimited' && $set_status_publish <= 0)) {
                                    $my_post['post_status'] = 'draft';
                                }

                                wp_update_post($my_post);

                                update_post_meta( $post_id, 'rental_number', STInput::request( 'rental_number' ) );
                                update_post_meta( $post_id, 'rental_max_adult', STInput::request( 'rental_max_adult' ) );
                                update_post_meta( $post_id, 'rental_max_children', STInput::request( 'rental_max_children' ) );
                                update_post_meta( $post_id, 'allow_full_day', STInput::request( 'allow_full_day', 'off' ) );
                                update_post_meta( $post_id, 'rentals_booking_period', (int)STInput::request( 'rentals_booking_period' ) );
                                update_post_meta( $post_id, 'rentals_booking_min_day', (int)STInput::request( 'rentals_booking_min_day' ) );
                                update_post_meta( $post_id, 'st_rental_external_booking', STInput::request( 'st_rental_external_booking' ) );
                                update_post_meta( $post_id, 'st_rental_external_booking_link', STInput::request( 'st_rental_external_booking_link' ) );
                                update_post_meta( $post_id, 'rental_bed', STInput::request( 'rental_bed' ) );
                                update_post_meta( $post_id, 'rental_bath', STInput::request( 'rental_bath' ) );
                                update_post_meta( $post_id, 'rental_size', STInput::request( 'rental_size' ) );
                            }

                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 2,
                                'next_step_name' => $step_name,
                                'post_id' => $post_id
                            ));
                            die;
                        }else{
                            $arr_err = array('st_title', 'st_content', 'st_desc', 'rental_number', 'rental_max_adult', 'rental_max_children', 'rental_bed', 'rental_bath', 'rental_size');
                            if(isset($_REQUEST['st_rental_external_booking']) && $_REQUEST['st_rental_external_booking'] == 'on'){
                                array_push($arr_err, 'st_rental_external_booking_link');
                            }
                            $err = $this->stSetErrorMessage($arr_err);
                            echo json_encode(array(
                                'status' => false,
                                'err' => $err
                            ));
                            die;
                        }
                        break;
                    case 'info':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            $valid = $this->stRentalValidate(2);
                            if($valid){
                                /////////////////////////////////////
                                /// Update taxonomy
                                /////////////////////////////////////
                                if (!empty($_REQUEST['taxonomy'])) {
                                    if (!empty($_REQUEST['taxonomy'])) {
                                        $taxonomy = $_REQUEST['taxonomy'];
                                        if (!empty($taxonomy)) {
                                            $tax = [];
                                            foreach ($taxonomy as $item) {
                                                $tmp = explode(",", $item);
                                                $tax[$tmp[1]][] = $tmp[0];
                                            }
                                            foreach ($tax as $key2 => $val2) {
                                                wp_set_post_terms($post_id, $val2, $key2);
                                            }
                                        }
                                    }
                                }

                                //aaa
                                update_post_meta( $post_id, 'show_agent_contact_info', STInput::request( 'show_agent_contact_info' ) );
                                update_post_meta( $post_id, 'video', STInput::request( 'video' ) );
                                update_post_meta( $post_id, 'agent_email', STInput::request( 'agent_email' ) );
                                update_post_meta( $post_id, 'agent_website', STInput::request( 'agent_website' ) );
                                update_post_meta( $post_id, 'agent_phone', STInput::request( 'agent_phone' ) );
                                update_post_meta( $post_id, 'st_fax', STInput::request( 'st_fax' ) );

                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 3,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('phone', 'agent_email', 'agent_website', 'video'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'photos':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            $valid = $this->stRentalValidate(3);
                            if($valid) {
                                $gallery = STInput::request('id_gallery', '');
                                update_post_meta($post_id, 'gallery', $gallery);
                                $thumbnail = (int)STInput::request('id_featured_image', '');
                                set_post_thumbnail($post_id, $thumbnail);
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 4,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('id_featured_image', 'id_gallery'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'prices':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $valid = $this->stRentalValidate(4);
                            if($valid) {
                                update_post_meta( $post_id, 'price', STInput::request( 'price' ) );
                                update_post_meta( $post_id, 'discount_rate', (int)STInput::request( 'discount_rate' ) );
                                update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );
                                $sale_price_from = TravelHelper::convertDateFormat( STInput::request( 'sale_price_from' ) );
                                $sale_price_from = date( 'Y-m-d', strtotime( $sale_price_from ) );
                                update_post_meta( $post_id, 'sale_price_from', $sale_price_from );
                                $sale_price_to = TravelHelper::convertDateFormat( STInput::request( 'sale_price_to' ) );
                                $sale_price_to = date( 'Y-m-d', strtotime( $sale_price_to ) );
                                update_post_meta( $post_id, 'sale_price_to', $sale_price_to );
                                update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                                update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );

                                // Update extra
                                $extra = STInput::request( 'extra', '' );
                                if ( isset( $extra[ 'title' ] ) && is_array( $extra[ 'title' ] ) && count( $extra[ 'title' ] ) ) {
                                    $list_extras = [];
                                    foreach ( $extra[ 'title' ] as $key => $val ) {
                                        if ( !empty( $val ) ) {
                                            $list_extras[ $key ] = [
                                                'title'            => $val,
                                                'extra_name'       => isset( $extra[ 'extra_name' ][ $key ] ) ? $extra[ 'extra_name' ][ $key ] : '',
                                                'extra_max_number' => isset( $extra[ 'extra_max_number' ][ $key ] ) ? $extra[ 'extra_max_number' ][ $key ] : '',
                                                'extra_price'      => isset( $extra[ 'extra_price' ][ $key ] ) ? $extra[ 'extra_price' ][ $key ] : ''
                                            ];
                                        }
                                    }
                                    update_post_meta( $post_id, 'extra_price', $list_extras );
                                } else {
                                    update_post_meta( $post_id, 'extra_price', '' );
                                }

                                // Update discount by number day
                                $discount_by_day = STInput::request( 'discount_by_day', '' );
                                if ( isset( $discount_by_day[ 'title' ] ) && is_array( $discount_by_day[ 'title' ] ) && count( $discount_by_day[ 'title' ] ) ) {
                                    $list_discount_by_day = [];
                                    foreach ( $discount_by_day[ 'title' ] as $key => $val ) {
                                        if ( !empty( $val ) ) {
                                            $list_discount_by_day[ $key ] = [
                                                'title'      => $val,
                                                'number_day' => isset( $discount_by_day[ 'number_day' ][ $key ] ) ? $discount_by_day[ 'number_day' ][ $key ] : '',
                                                'discount'   => isset( $discount_by_day[ 'discount' ][ $key ] ) ? $discount_by_day[ 'discount' ][ $key ] : '',
                                            ];
                                        }
                                    }
                                    update_post_meta( $post_id, 'discount_by_day', $list_discount_by_day );
                                } else {
                                    update_post_meta( $post_id, 'discount_by_day', '' );
                                }


                                update_post_meta( $post_id, 'discount_type_no_day', STInput::request( 'discount_type_no_day' ) );
                                update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                                update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                                update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );

                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 5,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $arr = [];
                                array_push($arr, 'price');
                                if(isset($_REQUEST['is_sale_schedule'])) {
                                    $is_sale_schedule = $_REQUEST['is_sale_schedule'];
                                    if ($is_sale_schedule == 'on') {
                                        array_push($arr, 'sale_price_from');
                                        array_push($arr, 'sale_price_to');
                                    }
                                }
                                $err = $this->stSetErrorMessage($arr);
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'locations':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $valid = $this->stRentalValidate(5);
                            if($valid) {
                                if (isset($_REQUEST['multi_location'])) {
                                    $location = $_REQUEST['multi_location'];
                                    if (is_array($location) && count($location)) {
                                        $location_str = '';
                                        foreach ($location as $item) {
                                            if (empty($location_str)) {
                                                $location_str .= $item;
                                            } else {
                                                $location_str .= ',' . $item;
                                            }
                                        }
                                    } else {
                                        $location_str = '';
                                    }
                                    update_post_meta($post_id, 'multi_location', $location_str);
                                    update_post_meta($post_id, 'id_location', '');
                                }

                                update_post_meta($post_id, 'address', STInput::request('address'));

                                $gmap = STInput::request( 'gmap' );
                                update_post_meta( $post_id, 'map_lat', $gmap[ 'lat' ] );
                                update_post_meta( $post_id, 'map_lng', $gmap[ 'lng' ] );
                                update_post_meta( $post_id, 'map_zoom', $gmap[ 'zoom' ] );
                                update_post_meta( $post_id, 'map_type', $gmap[ 'type' ] );

                                update_post_meta( $post_id, 'st_google_map', $gmap );
                                update_post_meta( $post_id, 'enable_street_views_google_map', STInput::request( 'enable_street_views_google_map' ) );

                                $properties = STInput::post( 'property-item', '' );
                                if ( !empty( $properties ) ) {
                                    $list = [];
                                    for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                        if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                            $list[] = [
                                                'title'          => $properties[ 'title' ][ $i ],
                                                'featured_image' => $properties[ 'featured_image' ][ $i ],
                                                'description'    => $properties[ 'description' ][ $i ],
                                                'icon'           => $properties[ 'icon' ][ $i ],
                                                'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                                'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                            ];
                                        }

                                    }
                                    update_post_meta( $post_id, 'properties_near_by', $list );
                                }

                                /* Rental Closest */
                                $properties = STInput::post( 'rdistance-item', '' );
                                if ( !empty( $properties ) ) {
                                    $list = [];
                                    for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                        if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                            $list[] = [
                                                'title'    => $properties[ 'title' ][ $i ],
                                                'icon'     => $properties[ 'icon' ][ $i ],
                                                'name'     => $properties[ 'name' ][ $i ],
                                                'distance' => $properties[ 'distance' ][ $i ],
                                            ];
                                        }

                                    }
                                    update_post_meta( $post_id, 'distance_closest', $list );
                                }

                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 6,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('address', 'multi_location'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'payments':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $data_paypment = STPaymentGateways::get_payment_gateways();
                            if (!empty($data_paypment) and is_array($data_paypment)) {
                                foreach ($data_paypment as $k => $v) {
                                    update_post_meta($post_id, 'is_meta_payment_gateway_' . $k, STInput::request('is_meta_payment_gateway_' . $k));
                                }
                            }
                            if($step != 'final'){
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 7,
                                    'next_step_name' => $step_name,
                                    'sc' => 'edit-rental',
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $this->getSuccessEditService('edit-rental', $post_id);
                            }
                        }
                        break;
                    case 'availability':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 8,
                                'next_step_name' => $step_name,
                                'post_id' => $post_id
                            ));
                            die;
                        }
                        break;
                    case 'ical':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            if($step != 'final') {
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 9,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $this->getSuccessEditService('edit-rental', $post_id);
                            }
                        }
                        break;
                    case 'custom_fields':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            /////////////////////////////////////
                            /// Update Custom Field
                            /////////////////////////////////////
                            $custom_field = st()->get_option( 'rental_unlimited_custom_field' );
                            if ( !empty( $custom_field ) ) {
                                foreach ( $custom_field as $k => $v ) {
                                    $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                    update_post_meta( $post_id, $key, STInput::request( $key ) );
                                }
                            }
                            if($step != 'final') {
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 10,
                                    'post_id' => $post_id,
                                    'next_step_name' => $step_name
                                ));
                                die;
                            }else{
                                $this->getSuccessEditService('edit-rental', $post_id);
                            }
                        }
                        break;

                }
            }
            private function stRentalValidate($step = 1){
                $validator = self::$validator;
                switch ($step){
                    case 1:
                        $validator->set_rules('st_title', __("Title", ST_TEXTDOMAIN), 'required|min_length[6]|max_length[100]');
                        $validator->set_rules('st_content', __("Content", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('st_desc', __("Short Intro", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('rental_number', __("Number", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('rental_max_adult', __("Max of Adult", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('rental_max_children', __("Max of Children", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('rental_bed', __("Number of Bed", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('rental_bath', __("Number of Bath", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('rental_size', __("Room Size", ST_TEXTDOMAIN), 'required');
                        if(isset($_REQUEST['st_rental_external_booking']) && $_REQUEST['st_rental_external_booking'] == 'on'){
                            $validator->set_rules('st_rental_external_booking_link', __("External booking URL", ST_TEXTDOMAIN), 'required|valid_url');
                        }
                        break;
                    case 2:
                        $validator->set_rules('agent_phone', __("Phone", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('agent_email', __("Email", ST_TEXTDOMAIN), 'valid_email');
                        $validator->set_rules('agent_website', __("Webite", ST_TEXTDOMAIN), 'valid_url');
                        $validator->set_rules('video', __("Video", ST_TEXTDOMAIN), 'valid_url');
                        break;
                    case 3:
                        $validator->set_rules('id_featured_image', __("Featured image", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('id_gallery', __("Gallery", ST_TEXTDOMAIN), 'required');
                        break;
                    case 4:
                        $validator->set_rules('price', __("Price", ST_TEXTDOMAIN), 'required');

                        if(isset($_REQUEST['is_sale_schedule'])){
                            $is_sale_schedule = $_REQUEST['is_sale_schedule'];
                            if($is_sale_schedule == 'on'){
                                $validator->set_rules('sale_price_from', __("Sale start date", ST_TEXTDOMAIN), 'required');
                                $validator->set_rules('sale_price_to', __("Sale end date", ST_TEXTDOMAIN), 'required');
                            }
                        }
                        break;
                    case 5:
                        $validator->set_rules('address', __("Address", ST_TEXTDOMAIN), 'required');
                        $location = $_REQUEST['multi_location'];
                        if(isset($_REQUEST['multi_location']) && empty($location)){
                            $validator->set_error_message('multi_location', __("The Location field is required.", ST_TEXTDOMAIN));
                        }
                        break;
                }

                $result = $validator->run();
                return $result;
            }
            public function st_partner_rental_info($fields){
                $list_tax_activity = TravelHelper::get_object_taxonomies_service('st_rental');
                if( !empty( $list_tax_activity ) ){
                    foreach( $list_tax_activity as $name => $label ){
                        $list = array();
                        $terms = get_terms( $name, array(
                            'hide_empty' => false,
                        ) );
                        if(!empty($terms)){
                            foreach( $terms as $key => $val){
                                $list[$val->term_id . ',' . $val->taxonomy] = $val->name;
                            }
                        }
                        $fields[] = array(
                            'type' => 'checkbox',
                            'label' => $label,
                            'name' => 'taxonomy[]',
                            'col' => '12',
                            'plh' => '',
                            'options' => $list,
                            'col_option' => '4',
                            'seperate' => true
                        );
                    }
                }
                $arr_temp =  array(
                    array(
                        'type' => 'select',
                        'label' => __('Choose which contact info will be shown?', ST_TEXTDOMAIN),
                        'name' => 'show_agent_contact_info',
                        'col' => '4',
                        'plh' => '',
                        'clear' => true,
                        'required' => false,
                        'options' => array(
                            '' => __('Select', ST_TEXTDOMAIN),
                            'user_agent_info' => __('Use agent contact Info', ST_TEXTDOMAIN),
                            'user_item_info' => __('Use item info', ST_TEXTDOMAIN),
                        ),
                    ),
                    //bbb
                    array(
                        'type' => 'text',
                        'label' => __('Rental email', ST_TEXTDOMAIN),
                        'name' => 'agent_email',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Rental website', ST_TEXTDOMAIN),
                        'name' => 'agent_website',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Rental phone', ST_TEXTDOMAIN),
                        'name' => 'agent_phone',
                        'col' => '4',
                        'plh' => '',
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Fax number', ST_TEXTDOMAIN),
                        'name' => 'st_fax',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Rental video', ST_TEXTDOMAIN),
                        'name' => 'video',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                );

                $fields = array_merge($fields, $arr_temp);

                return $fields;
            }
            public function st_partner_car_info($fields){
                $list_tax_activity = TravelHelper::get_object_taxonomies_service('st_cars');
                if( !empty( $list_tax_activity ) ){
                    foreach( $list_tax_activity as $name => $label ){
                        $list = array();
                        $terms = get_terms( $name, array(
                            'hide_empty' => false,
                        ) );
                        if(!empty($terms)){
                            foreach( $terms as $key => $val){
                                $list[$val->term_id . ',' . $val->taxonomy] = $val->name;
                            }
                        }
                        $fields[] = array(
                            'type' => 'checkbox',
                            'label' => $label,
                            'name' => 'taxonomy[]',
                            'col' => '12',
                            'plh' => '',
                            'options' => $list,
                            'col_option' => '4',
                            'tax_name' => $name,
                            'seperate' => true
                        );
                    }
                }
                $arr_temp =  array(
                    array(
                        'type' => 'list-item',
                        'label' => __('Equipment Price List', ST_TEXTDOMAIN),
                        'name' => 'cars_equipment_list',
                        'col' => '6',
                        'plh' => '',
                        'text_add' => __('Add New', ST_TEXTDOMAIN),
                        'clear' => true,
                        'fields' => array(
                            array(
                                'type' => 'text',
                                'label' => __('Title', ST_TEXTDOMAIN),
                                'name' => 'equipment_item_title'
                            ),
                            array(
                                'type' => 'text',
                                'label' => __('Price', ST_TEXTDOMAIN),
                                'name' => 'equipment_item_price'
                            ),
                            array(
                                'type' => 'select',
                                'label' => __('Price unit', ST_TEXTDOMAIN),
                                'name' => 'equipment_item_price_unit',
                                'col' => '4',
                                'plh' => '',
                                'required' => false,
                                'options' => array(
                                    '' => __('Fixed Price', ST_TEXTDOMAIN),
                                    'per_hour' => __('Price per Hour', ST_TEXTDOMAIN),
                                    'per_day' => __('Price per Day', ST_TEXTDOMAIN),
                                ),
                            ),
                            array(
                                'type' => 'text',
                                'label' => __('Price max', ST_TEXTDOMAIN),
                                'name' => 'equipment_item_price_max'
                            ),
                            array(
                                'type' => 'text',
                                'label' => __('Number of item', ST_TEXTDOMAIN),
                                'name' => 'cars_equipment_list_number'
                            ),
                        )
                    ),

                    array(
                        'type' => 'list-item',
                        'label' => __('Features', ST_TEXTDOMAIN),
                        'name' => 'cars_equipment_info',
                        'col' => '6',
                        'plh' => '',
                        'text_add' => __('Add New', ST_TEXTDOMAIN),
                        'fields' => array(
                            array(
                                'type' => 'text',
                                'label' => __('Title', ST_TEXTDOMAIN),
                                'name' => 'features_title'
                            ),
                            array(
                                'type' => 'select',
                                'label' => __('Taxonomy', ST_TEXTDOMAIN),
                                'name' => 'features_taxonomy',
                                'options' => st_get_list_car_taxonomy()
                            ),
                            array(
                                'type' => 'text',
                                'label' => __('Taxonomy Info', ST_TEXTDOMAIN),
                                'name' => 'taxonomy_info'
                            ),
                        )
                    ),

                    array(
                        'type' => 'select',
                        'label' => __('Choose which contact info will be shown?', ST_TEXTDOMAIN),
                        'name' => 'show_agent_contact_info',
                        'col' => '4',
                        'plh' => '',
                        'clear' => true,
                        'required' => false,
                        'options' => array(
                            '' => __('Select', ST_TEXTDOMAIN),
                            'user_agent_info' => __('Use agent contact Info', ST_TEXTDOMAIN),
                            'user_item_info' => __('Use item info', ST_TEXTDOMAIN),
                        ),
                    ),
                    //bbb
                    array(
                        'type' => 'text',
                        'label' => __('Contact email addresses', ST_TEXTDOMAIN),
                        'name' => 'cars_email',
                        'col' => '4',
                        'plh' => '',
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Phone', ST_TEXTDOMAIN),
                        'name' => 'cars_phone',
                        'col' => '4',
                        'plh' => '',
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Fax', ST_TEXTDOMAIN),
                        'name' => 'cars_fax',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Video', ST_TEXTDOMAIN),
                        'name' => 'video',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => __('Info about car', ST_TEXTDOMAIN),
                        'name' => 'cars_about',
                        'col' => '12',
                        'plh' => '',
                        'required' => true
                    ),
                    /* New layout */
                    array(
                        'type' => 'text',
                        'label' => __('No. Passengers', ST_TEXTDOMAIN),
                        'name' => 'passengers',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                    array(
                        'type' => 'select',
                        'label' => __('Auto Transmission', ST_TEXTDOMAIN),
                        'name' => 'auto_transmission',
                        'col' => '4',
                        'plh' => '',
                        'options' => array(
                            'on' => __('On', ST_TEXTDOMAIN),
                            'off' => __('Off', ST_TEXTDOMAIN)
                        ),
                        'required' => false
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Baggage', ST_TEXTDOMAIN),
                        'name' => 'baggage',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('No. Door', ST_TEXTDOMAIN),
                        'name' => 'door',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                    array(
                        'type' => 'select',
                        'label' => __('Free Cancellation', ST_TEXTDOMAIN),
                        'name' => 'fee_cancellation',
                        'col' => '4',
                        'plh' => '',
                        'options' => array(
                            'on' => __('On', ST_TEXTDOMAIN),
                            'off' => __('Off', ST_TEXTDOMAIN)
                        ),
                        'required' => false
                    ),
                    array(
                        'type' => 'select',
                        'label' => __('Pay at Pick-up', ST_TEXTDOMAIN),
                        'name' => 'pay_at_pick_up',
                        'col' => '4',
                        'plh' => '',
                        'options' => array(
                            'on' => __('On', ST_TEXTDOMAIN),
                            'off' => __('Off', ST_TEXTDOMAIN)
                        ),
                        'required' => false
                    ),
                    array(
                        'type' => 'select',
                        'label' => __('Unlimited mileage', ST_TEXTDOMAIN),
                        'name' => 'unlimited_mileage',
                        'col' => '4',
                        'plh' => '',
                        'options' => array(
                            'on' => __('On', ST_TEXTDOMAIN),
                            'off' => __('Off', ST_TEXTDOMAIN)
                        ),
                        'required' => false
                    ),
                    array(
                        'type' => 'select',
                        'label' => __('Shuttle to Car', ST_TEXTDOMAIN),
                        'name' => 'shuttle_to_car',
                        'col' => '4',
                        'plh' => '',
                        'options' => array(
                            'on' => __('On', ST_TEXTDOMAIN),
                            'off' => __('Off', ST_TEXTDOMAIN)
                        ),
                        'required' => false
                    ),
                    /* End new layout */
                    array(
                        'type' => 'text',
                        'label' => __('Booking period', ST_TEXTDOMAIN),
                        'name' => 'cars_booking_period',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Minimum days to book', ST_TEXTDOMAIN),
                        'name' => 'cars_booking_min_day',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                    array(
                        'type' => 'select',
                        'label' => __('External Booking', ST_TEXTDOMAIN),
                        'name' => 'st_car_external_booking',
                        'col' => '4',
                        'plh' => '',
                        'required' => false,
                        'options' => array(
                            'off' => __('No', ST_TEXTDOMAIN),
                            'on' => __('Yes', ST_TEXTDOMAIN),
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('External booking URL', ST_TEXTDOMAIN),
                        'name' => 'st_car_external_booking_link',
                        'col' => '4',
                        'plh' => '',
                        'required' => false,
                        'condition' => 'st_car_external_booking:is(on)'
                    ),
                );
                $fields = array_merge($fields, $arr_temp);
                return $fields;
            }
            public function __stPartnerCreateServiceCar(){
                $step = STInput::post('step', 1);
                $step_name = STInput::post('step_name', 'basic_info');
                switch ($step_name){
                    case 'basic_info':
                        $valid = $this->stCarValidate(1);
                        if($valid){
                            if (!empty($_REQUEST['btn_insert_post_type_car']) && empty(STInput::request('post_id'))) {
                                if (st()->get_option('partner_post_by_admin', 'on') == 'on') {
                                    $post_status = 'draft';
                                } else {
                                    $post_status = 'publish';
                                }
                                if (current_user_can('manage_options')) {
                                    $post_status = 'publish';
                                }
                                if (STInput::request('save_and_preview') == "true") {
                                    $post_status = 'draft';
                                }

                                $current_user = wp_get_current_user();

                                $my_post = [
                                    'post_title' => STInput::request('st_title', 'Title'),
                                    'post_content' => '',
                                    'post_status' => $post_status,
                                    'post_author' => $current_user->ID,
                                    'post_type' => 'st_cars',
                                    'post_excerpt' => ''
                                ];
                                $post_id = wp_insert_post($my_post);
                            }else{
                                $post_id = STInput::request('post_id');
                            }

                            if (!empty($post_id)) {
                                $my_post = [
                                    'ID' => $post_id,
                                    'post_title' => STInput::request('st_title'),
                                    'post_content' => STInput::request('st_content'),
                                    'post_excerpt' => stripslashes(STInput::request('st_desc')),
                                ];

                                if (st()->get_option('partner_post_by_admin', 'on') == 'off') {
                                    $my_post['post_status'] = 'publish';
                                }

                                $admin_packages = STAdminPackages::get_inst();
                                $set_status_publish = $admin_packages->count_item_can_public_status(get_current_user_id(), $post_id);
                                if ($admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ($set_status_publish !== 'unlimited' && $set_status_publish <= 0)) {
                                    $my_post['post_status'] = 'draft';
                                }

                                wp_update_post($my_post);

                                $logo = STInput::request( 'cars_logo', '' );
                                update_post_meta( $post_id, 'cars_logo', $logo );
                                update_post_meta( $post_id, 'cars_name', STInput::request( 'cars_name' ) );
                            }

                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 2,
                                'next_step_name' => $step_name,
                                'post_id' => $post_id
                            ));
                            die;
                        }else{
                            $err = $this->stSetErrorMessage(array('st_title', 'st_content', 'st_desc', 'cars_logo', 'cars_name'));
                            echo json_encode(array(
                                'status' => false,
                                'err' => $err
                            ));
                            die;
                        }
                        break;
                    case 'info':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            $valid = $this->stCarValidate(2);
                            if($valid){
                                /////////////////////////////////////
                                /// Update taxonomy
                                /////////////////////////////////////
                                if (!empty($_REQUEST['taxonomy'])) {
                                    if (!empty($_REQUEST['taxonomy'])) {
                                        $taxonomy = $_REQUEST['taxonomy'];
                                        if (!empty($taxonomy)) {
                                            $tax = [];
                                            foreach ($taxonomy as $item) {
                                                $tmp = explode(",", $item);
                                                $tax[$tmp[1]][] = $tmp[0];
                                            }
                                            foreach ($tax as $key2 => $val2) {
                                                wp_set_post_terms($post_id, $val2, $key2);
                                            }
                                        }
                                    }
                                }

                                if ( !empty( $_REQUEST[ 'equipment_item_title' ] ) ) {
                                    $equipment                  = [];
                                    $equipment_item_title       = STInput::request( 'equipment_item_title' );
                                    $equipment_item_price       = STInput::request( 'equipment_item_price' );
                                    $equipment_item_price_unit  = STInput::request( 'equipment_item_price_unit' );
                                    $equipment_item_price_max   = STInput::request( 'equipment_item_price_max' );
                                    $cars_equipment_list_number = STInput::request( 'cars_equipment_list_number' );
                                    if ( !empty( $equipment_item_title ) ) {
                                        foreach ( $equipment_item_title as $k => $v ) {
                                            if ( !empty( $v ) ) {
                                                array_push( $equipment, [
                                                    'title'                         => $v,
                                                    'cars_equipment_list_price'     => $equipment_item_price[ $k ],
                                                    'price_unit'                    => $equipment_item_price_unit[ $k ],
                                                    'cars_equipment_list_price_max' => $equipment_item_price_max[ $k ],
                                                    'cars_equipment_list_number'    => $cars_equipment_list_number[ $k ],
                                                ] );
                                            }

                                        }
                                    }
                                    update_post_meta( $post_id, 'cars_equipment_list', $equipment );
                                }else{
                                    update_post_meta( $post_id, 'cars_equipment_list', '' );
                                }

                                if ( !empty( $_REQUEST[ 'features_taxonomy' ] ) ) {
                                    $features               = [];
                                    $features_taxonomy      = STInput::request( 'features_taxonomy' );
                                    $features_title      = STInput::request( 'features_title' );
                                    $features_taxonomy_info = STInput::request( 'taxonomy_info' );
                                    if ( !empty( $features_taxonomy ) ) {
                                        foreach ( $features_taxonomy as $k => $v ) {
                                            if(!empty($v) && !empty($features_taxonomy_info[ $k ])) {
                                                array_push($features, [
                                                    'title' => $features_title[$k],
                                                    'cars_equipment_taxonomy_id' => $v,
                                                    'cars_equipment_taxonomy_info' => $features_taxonomy_info[$k]
                                                ]);
                                            }
                                        }
                                    }
                                    update_post_meta( $post_id, 'cars_equipment_info', $features );
                                }else{
                                    update_post_meta( $post_id, 'cars_equipment_info', array() );
                                }

                                update_post_meta( $post_id, 'show_agent_contact_info', STInput::request( 'show_agent_contact_info' ) );
                                update_post_meta( $post_id, 'cars_email', STInput::request( 'cars_email' ) );
                                update_post_meta( $post_id, 'cars_phone', STInput::request( 'cars_phone' ) );
                                update_post_meta( $post_id, 'cars_fax', STInput::request( 'cars_fax' ) );
                                update_post_meta( $post_id, 'video', STInput::request( 'video' ) );
                                update_post_meta( $post_id, 'cars_about', STInput::request( 'cars_about' ) );
                                update_post_meta( $post_id, 'cars_booking_period', (int)STInput::request( 'cars_booking_period' ) );
                                update_post_meta( $post_id, 'cars_booking_min_day', (int)STInput::request( 'cars_booking_min_day' ) );
                                update_post_meta( $post_id, 'cars_booking_min_hour', (int)STInput::request( 'cars_booking_min_hour' ) );
                                update_post_meta( $post_id, 'st_car_external_booking', STInput::request( 'st_car_external_booking' ) );
                                update_post_meta( $post_id, 'st_car_external_booking_link', STInput::request( 'st_car_external_booking_link' ) );

                                update_post_meta( $post_id, 'passengers', STInput::request( 'passengers' ) );
                                update_post_meta( $post_id, 'auto_transmission', STInput::request( 'auto_transmission' ) );
                                update_post_meta( $post_id, 'baggage', STInput::request( 'baggage' ) );
                                update_post_meta( $post_id, 'door', STInput::request( 'door' ) );

                                update_post_meta( $post_id, 'fee_cancellation', STInput::request( 'fee_cancellation' ) );
                                update_post_meta( $post_id, 'pay_at_pick_up', STInput::request( 'pay_at_pick_up' ) );
                                update_post_meta( $post_id, 'unlimited_mileage', STInput::request( 'unlimited_mileage' ) );
                                update_post_meta( $post_id, 'shuttle_to_car', STInput::request( 'shuttle_to_car' ) );

                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 3,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('cars_email', 'cars_phone', 'cars_about'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'photos':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            $valid = $this->stCarValidate(3);
                            if($valid) {
                                $gallery = STInput::request('id_gallery', '');
                                update_post_meta($post_id, 'gallery', $gallery);
                                $thumbnail = (int)STInput::request('id_featured_image', '');
                                set_post_thumbnail($post_id, $thumbnail);
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 4,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('id_featured_image', 'id_gallery'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'prices':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $valid = $this->stCarValidate(4);
                            if($valid) {
                                update_post_meta( $post_id, 'car_type', STInput::request( 'car_type', 'normal' ) );
                                update_post_meta( $post_id, 'cars_price', STInput::request( 'cars_price' ) );
                                update_post_meta( $post_id, 'is_custom_price', STInput::request( 'is_custom_price' ) );
                                update_post_meta( $post_id, 'price_type', STInput::request( 'price_type', 'distance' ) );
                                update_post_meta( $post_id, 'num_passenger', STInput::request( 'num_passenger', '1' ) );

                                if ( !empty( $_REQUEST[ 'journey_title' ] ) ) {
                                    $data                  = [];
                                    $journey_title         = STInput::request( 'journey_title' );
                                    $journey_transfer_from = STInput::request( 'journey_transfer_from' );
                                    $journey_transfer_to   = STInput::request( 'journey_transfer_to' );
                                    $journey_price         = STInput::request( 'journey_price' );
                                    $journey_return        = STInput::request( 'journey_return' );

                                    if ( !empty( $journey_transfer_from ) ) {
                                        foreach ( $journey_transfer_from as $k => $v ) {
	                                        if(!empty($journey_title[ $k ])) {
		                                        $data[] = [
			                                        'title'         => $journey_title[ $k ],
			                                        'transfer_from' => $journey_transfer_from[ $k ],
			                                        'transfer_to'   => $journey_transfer_to[ $k ],
			                                        'price'         => $journey_price[ $k ],
			                                        'return'        => isset( $journey_return[ $k ] ) ? $journey_return[ $k ] : 'no',
		                                        ];
	                                        }
                                        }
                                    }


                                    update_post_meta( $post_id, 'journey', $data );
                                } else {
                                    update_post_meta( $post_id, 'journey', [] );
                                }

                                if ( !empty( $_REQUEST[ 'st_price' ] ) ) {
                                    $data               = [];
                                    $price_new  = STInput::request( 'st_price' );
                                    $price_type = STInput::request( 'st_price_type' );
                                    $start_date = STInput::request( 'st_start_date' );
                                    $end_date   = STInput::request( 'st_end_date' );
                                    $status     = STInput::request( 'st_status', 1);
                                    $priority   = STInput::request( 'st_priority' );
                                    STAdmin::st_delete_price( $post_id );
                                    if ( $price_new and $start_date and $end_date ) {
                                        foreach ( $price_new as $k => $v ) {
                                            if ( !empty( $v ) ) {
                                                $data[] = [
                                                    'st_price'        => $v,
                                                    'st_start_date'   => date( 'Y-m-d', strtotime( TravelHelper::convertDateFormat($start_date[ $k ]))),
                                                    'st_end_date' =>  date( 'Y-m-d', strtotime( TravelHelper::convertDateFormat($end_date[ $k ])))
                                                ];
                                                STAdmin::st_add_price( $post_id, $price_type[ $k ], $v, $start_date[ $k ], $end_date[ $k ], 1, 0 );
                                            }
                                        }
                                    }

                                    update_post_meta( $post_id, 'price_by_date', $data );
                                }
                                if ( !empty( $_REQUEST[ 'st_price_by_number' ] ) ) {
                                    $data               = [];
                                    $st_number_start    = STInput::request( 'st_number_start' );
                                    $st_number_end      = STInput::request( 'st_number_end' );
                                    $st_price_by_number = STInput::request( 'st_price_by_number' );
                                    $st_title           = STInput::request( 'st_title' );
                                    if ( !empty( $st_price_by_number ) ) {
                                        foreach ( $st_price_by_number as $k => $v ) {
                                            if ( !empty( $st_title[ $k ] ) ) {
                                                $data[] = [
                                                    'title'        => $st_title[ $k ],
                                                    'number_start' => $st_number_start[ $k ],
                                                    'number_end'   => $st_number_end[ $k ],
                                                    'price'        => $v,
                                                ];
                                            }

                                        }
                                    }
                                    update_post_meta( $post_id, 'price_by_number_of_day_hour', $data );
                                }

                                $extra = STInput::request( 'extra', '' );
                                if ( isset( $extra[ 'title' ] ) && is_array( $extra[ 'title' ] ) && count( $extra[ 'title' ] ) ) {
                                    $list_extras = [];
                                    foreach ( $extra[ 'title' ] as $key => $val ) {
                                        if ( !empty( $val ) ) {
                                            $list_extras[ $key ] = [
                                                'title'            => $val,
                                                'extra_name'       => isset( $extra[ 'extra_name' ][ $key ] ) ? $extra[ 'extra_name' ][ $key ] : '',
                                                'extra_max_number' => isset( $extra[ 'extra_max_number' ][ $key ] ) ? $extra[ 'extra_max_number' ][ $key ] : '',
                                                'extra_price'      => isset( $extra[ 'extra_price' ][ $key ] ) ? $extra[ 'extra_price' ][ $key ] : ''
                                            ];
                                        }
                                    }
                                    update_post_meta( $post_id, 'extra_price', $list_extras );
                                } else {
                                    update_post_meta( $post_id, 'extra_price', '' );
                                }

                                update_post_meta( $post_id, 'discount', (int)STInput::request( 'discount' ) );
                                update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );

                                $sale_price_from = TravelHelper::convertDateFormat( STInput::request( 'sale_price_from' ) );
                                $sale_price_from = date( 'Y-m-d', strtotime( $sale_price_from ) );
                                update_post_meta( $post_id, 'sale_price_from', $sale_price_from );
                                $sale_price_to = TravelHelper::convertDateFormat( STInput::request( 'sale_price_to' ) );
                                $sale_price_to = date( 'Y-m-d', strtotime( $sale_price_to ) );
                                update_post_meta( $post_id, 'sale_price_to', $sale_price_to );
                                update_post_meta( $post_id, 'number_car', STInput::request( 'number_car' ) );
                                update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                                update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );

                                update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                                update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                                update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );




                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 5,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $arr = [];
                                array_push($arr, 'cars_price');
                                array_push($arr, 'number_car');

                                if(isset($_REQUEST['car_type'])){
                                    $car_type = $_REQUEST['car_type'];
                                    if($car_type == 'car_transfer'){
                                        array_push($arr, 'num_passenger');
                                    }
                                }
                                if(isset($_REQUEST['is_sale_schedule'])) {
                                    $is_sale_schedule = $_REQUEST['is_sale_schedule'];
                                    if ($is_sale_schedule == 'on') {
                                        array_push($arr, 'sale_price_from');
                                        array_push($arr, 'sale_price_to');
                                    }
                                }
                                $err = $this->stSetErrorMessage($arr);
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'locations':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $valid = $this->stCarValidate(5);
                            if($valid) {
                                if (isset($_REQUEST['multi_location'])) {
                                    $location = $_REQUEST['multi_location'];
                                    if (is_array($location) && count($location)) {
                                        $location_str = '';
                                        foreach ($location as $item) {
                                            if (empty($location_str)) {
                                                $location_str .= $item;
                                            } else {
                                                $location_str .= ',' . $item;
                                            }
                                        }
                                    } else {
                                        $location_str = '';
                                    }
                                    update_post_meta($post_id, 'multi_location', $location_str);
                                    update_post_meta($post_id, 'id_location', '');
                                }

                                update_post_meta($post_id, 'cars_address', STInput::request('cars_address'));

                                $gmap = STInput::request( 'gmap' );
                                update_post_meta( $post_id, 'map_lat', $gmap[ 'lat' ] );
                                update_post_meta( $post_id, 'map_lng', $gmap[ 'lng' ] );
                                update_post_meta( $post_id, 'map_zoom', $gmap[ 'zoom' ] );
                                update_post_meta( $post_id, 'map_type', $gmap[ 'type' ] );

                                update_post_meta( $post_id, 'st_google_map', $gmap );
                                update_post_meta( $post_id, 'enable_street_views_google_map', STInput::request( 'enable_street_views_google_map' ) );

                                $properties = STInput::post( 'property-item', '' );
                                if ( !empty( $properties ) ) {
                                    $list = [];
                                    for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                        if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                            $list[] = [
                                                'title'          => $properties[ 'title' ][ $i ],
                                                'featured_image' => $properties[ 'featured_image' ][ $i ],
                                                'description'    => $properties[ 'description' ][ $i ],
                                                'icon'           => $properties[ 'icon' ][ $i ],
                                                'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                                'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                            ];
                                        }

                                    }
                                    update_post_meta( $post_id, 'properties_near_by', $list );
                                }


                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 6,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('cars_address', 'multi_location'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'payments':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $data_paypment = STPaymentGateways::get_payment_gateways();
                            if (!empty($data_paypment) and is_array($data_paypment)) {
                                foreach ($data_paypment as $k => $v) {
                                    update_post_meta($post_id, 'is_meta_payment_gateway_' . $k, STInput::request('is_meta_payment_gateway_' . $k));
                                }
                            }

                            if($step != 'final'){
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 7,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $this->getSuccessEditService('edit-cars', $post_id);
                            }
                        }
                        break;
                    case 'custom_fields':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            /////////////////////////////////////
                            /// Update Custom Field
                            /////////////////////////////////////
                            $custom_field = st()->get_option( 'st_cars_unlimited_custom_field' );
                            if ( !empty( $custom_field ) ) {
                                foreach ( $custom_field as $k => $v ) {
                                    $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                    update_post_meta( $post_id, $key, STInput::request( $key ) );
                                }
                            }
                            if($step != 'final') {
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 8,
                                    'post_id' => $post_id,
                                    'next_step_name' => $step_name
                                ));
                                die;
                            }else{
                                $this->getSuccessEditService('edit-cars', $post_id);
                            }
                        }
                        break;

                }
            }
            private function stCarValidate($step = 1){
                $validator = self::$validator;
                switch ($step){
                    case 1:
                        $validator->set_rules('st_title', __("Title", ST_TEXTDOMAIN), 'required|min_length[6]|max_length[100]');
                        $validator->set_rules('st_content', __("Content", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('st_desc', __("Short Intro", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('cars_logo', __("Manufacture logo", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('cars_name', __("Car Manufacturer Name", ST_TEXTDOMAIN), 'required');
                        break;
                    case 2:

                        $validator->set_rules('cars_email', __("Contact email", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('cars_phone', __("Phone", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('cars_about', __("Info about car", ST_TEXTDOMAIN), 'required');
                        break;
                    case 3:
                        $validator->set_rules('id_featured_image', __("Featured image", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('id_gallery', __("Gallery", ST_TEXTDOMAIN), 'required');
                        break;
                    case 4:
                        $validator->set_rules('cars_price', __("Price", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('number_car', __("Number of cars for rent", ST_TEXTDOMAIN), 'required');

                        if(isset($_REQUEST['car_type'])){
                            $car_type = $_REQUEST['car_type'];
                            if($car_type == 'car_transfer'){
                                $validator->set_rules('num_passenger', __("Passengers", ST_TEXTDOMAIN), 'required');
                            }
                        }
                        if(isset($_REQUEST['is_sale_schedule'])){
                            $is_sale_schedule = $_REQUEST['is_sale_schedule'];
                            if($is_sale_schedule == 'on'){
                                $validator->set_rules('sale_price_from', __("Sale start date", ST_TEXTDOMAIN), 'required');
                                $validator->set_rules('sale_price_to', __("Sale end date", ST_TEXTDOMAIN), 'required');
                            }
                        }
                        break;
                    case 5:
                        $validator->set_rules('cars_address', __("Address", ST_TEXTDOMAIN), 'required');
                        $location = $_REQUEST['multi_location'];
                        if(isset($_REQUEST['multi_location']) && empty($location)){
                            $validator->set_error_message('multi_location', __("The Location field is required.", ST_TEXTDOMAIN));
                        }
                        break;
                }

                $result = $validator->run();
                return $result;
            }
            public function __stPartnerCreateServiceActivity(){
                $step = STInput::post('step', 1);
                $step_name = STInput::post('step_name', 'basic_info');
                switch ($step_name){
                    case 'basic_info':
                        $valid = $this->stActivityValidate(1);
                        if($valid){
                            if (!empty($_REQUEST['btn_insert_post_type_activity']) && empty(STInput::request('post_id'))) {
                                if (st()->get_option('partner_post_by_admin', 'on') == 'on') {
                                    $post_status = 'draft';
                                } else {
                                    $post_status = 'publish';
                                }
                                if (current_user_can('manage_options')) {
                                    $post_status = 'publish';
                                }
                                if (STInput::request('save_and_preview') == "true") {
                                    $post_status = 'draft';
                                }

                                $current_user = wp_get_current_user();

                                $my_post = [
                                    'post_title' => STInput::request('st_title', 'Title'),
                                    'post_content' => '',
                                    'post_status' => $post_status,
                                    'post_author' => $current_user->ID,
                                    'post_type' => 'st_activity',
                                    'post_excerpt' => ''
                                ];
                                $post_id = wp_insert_post($my_post);
                            }else{
                                $post_id = STInput::request('post_id');
                            }

                            if (!empty($post_id)) {
                                $my_post = [
                                    'ID' => $post_id,
                                    'post_title' => STInput::request('st_title'),
                                    'post_content' => STInput::request('st_content'),
                                    'post_excerpt' => stripslashes(STInput::request('st_desc')),
                                ];

                                if (st()->get_option('partner_post_by_admin', 'on') == 'off') {
                                    $my_post['post_status'] = 'publish';
                                }

                                $admin_packages = STAdminPackages::get_inst();
                                $set_status_publish = $admin_packages->count_item_can_public_status(get_current_user_id(), $post_id);
                                if ($admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ($set_status_publish !== 'unlimited' && $set_status_publish <= 0)) {
                                    $my_post['post_status'] = 'draft';
                                }

                                wp_update_post($my_post);

                                update_post_meta($post_id, 'show_agent_contact_info', STInput::request('show_agent_contact_info'));
                                update_post_meta($post_id, 'contact_email', STInput::request('contact_email'));
                                update_post_meta($post_id, 'contact_web', STInput::request('contact_web'));
                                update_post_meta($post_id, 'contact_phone', STInput::request('contact_phone'));
                                update_post_meta($post_id, 'contact_fax', STInput::request('contact_fax'));
                                update_post_meta($post_id, 'video', STInput::request('video'));
                            }

                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 2,
                                'next_step_name' => $step_name,
                                'post_id' => $post_id
                            ));
                            die;
                        }else{
                            $err = $this->stSetErrorMessage(array('st_title', 'st_content', 'st_desc', 'contact_email', 'contact_web', 'video'));
                            echo json_encode(array(
                                'status' => false,
                                'err' => $err
                            ));
                            die;
                        }
                        break;
                    case 'info':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            $valid = $this->stActivityValidate(2);
                            if($valid){
                                /////////////////////////////////////
                                /// Update taxonomy
                                /////////////////////////////////////
                                if (!empty($_REQUEST['taxonomy'])) {
                                    if (!empty($_REQUEST['taxonomy'])) {
                                        $taxonomy = $_REQUEST['taxonomy'];
                                        if (!empty($taxonomy)) {
                                            $tax = [];
                                            foreach ($taxonomy as $item) {
                                                $tmp = explode(",", $item);
                                                $tax[$tmp[1]][] = $tmp[0];
                                            }
                                            foreach ($tax as $key2 => $val2) {
                                                wp_set_post_terms($post_id, $val2, $key2);
                                            }
                                        }
                                    }
                                }

                                update_post_meta( $post_id, 'type_activity', STInput::request( 'type_activity' ) );
                                update_post_meta( $post_id, 'duration', STInput::request( 'duration' ) );
                                update_post_meta( $post_id, 'activity-time', STInput::request( 'activity-time' ) );
                                update_post_meta( $post_id, 'activity_booking_period', (int)STInput::request( 'activity_booking_period' ) );
                                update_post_meta( $post_id, 'max_people', STInput::request( 'max_people' ) );
                                update_post_meta( $post_id, 'st_activity_external_booking', STInput::request( 'st_activity_external_booking' ) );
                                update_post_meta( $post_id, 'st_activity_external_booking_link', STInput::request( 'st_activity_external_booking_link' ) );
                                update_post_meta( $post_id, 'activity_include', STInput::request( 'activity_include' ) );
                                update_post_meta( $post_id, 'activity_exclude', STInput::request( 'activity_exclude' ) );
                                update_post_meta( $post_id, 'activity_highlight', STInput::request( 'activity_highlight' ) );

                                if ( !empty( $_REQUEST[ 'activity_faq_title' ] ) ) {
                                    $activity_faq_title = $_REQUEST['activity_faq_title'];
                                    $activity_faq_desc = $_REQUEST['activity_faq_desc'];
                                    $activity_faq = [];
                                    if (!empty($activity_faq_title)) {
                                        foreach ($activity_faq_title as $k => $v) {
                                            if(!empty($v) && !empty($activity_faq_desc[$k])) {
                                                array_push($activity_faq, [
                                                    'title' => $v,
                                                    'desc' => $activity_faq_desc[$k]
                                                ]);
                                            }
                                        }
                                    }
                                    update_post_meta($post_id, 'activity_faq', $activity_faq);
                                }else{
                                    update_post_meta($post_id, 'activity_faq', '');
                                }


                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 3,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('duration'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'photos':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            $valid = $this->stActivityValidate(3);
                            if($valid) {
                                $gallery = STInput::request('id_gallery', '');
                                update_post_meta($post_id, 'gallery', $gallery);
                                $thumbnail = (int)STInput::request('id_featured_image', '');
                                set_post_thumbnail($post_id, $thumbnail);
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 4,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('id_featured_image', 'id_gallery'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'prices':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $valid = $this->stActivityValidate(4);
                            if($valid) {
                                update_post_meta( $post_id, 'adult_price', STInput::request( 'adult_price' ) );
                                update_post_meta( $post_id, 'child_price', STInput::request( 'child_price' ) );
                                update_post_meta( $post_id, 'infant_price', STInput::request( 'infant_price' ) );
                                update_post_meta( $post_id, 'hide_adult_in_booking_form', STInput::request( 'hide_adult_in_booking_form' ) );
                                update_post_meta( $post_id, 'hide_children_in_booking_form', STInput::request( 'hide_children_in_booking_form' ) );
                                update_post_meta( $post_id, 'hide_infant_in_booking_form', STInput::request( 'hide_infant_in_booking_form' ) );
                                $discount_by_adult_title = STInput::request( 'discount_by_adult_title' );
                                if ( !empty( $discount_by_adult_title ) ) {
                                    $discount_by_adult_value  = $_REQUEST[ 'discount_by_adult_value' ];
                                    $discount_by_adult_key    = $_REQUEST[ 'discount_by_adult_key' ];
                                    $discount_by_adult_key_to = $_REQUEST[ 'discount_by_adult_key_to' ];
                                    $data                     = [];
                                    foreach ( $discount_by_adult_title as $k => $v ) {
                                        if ( !empty( $v ) ) {
                                            array_push( $data, [
                                                'title'  => $v,
                                                'value'  => $discount_by_adult_value[ $k ],
                                                'key'    => $discount_by_adult_key[ $k ],
                                                'key_to' => $discount_by_adult_key_to[ $k ],
                                            ] );
                                        }

                                    }
                                    update_post_meta( $post_id, 'discount_by_adult', $data );
                                } else {
                                    update_post_meta( $post_id, 'discount_by_adult', [] );
                                }

                                $discount_by_child_title = STInput::request( 'discount_by_child_title' );
                                if ( !empty( $discount_by_child_title ) ) {
                                    $discount_by_child_value  = STInput::request( 'discount_by_child_value' );
                                    $discount_by_child_key    = STInput::request( 'discount_by_child_key' );
                                    $discount_by_child_key_to = STInput::request( 'discount_by_child_key_to' );
                                    $data                     = [];
                                    foreach ( $discount_by_child_title as $k => $v ) {
                                        if ( !empty( $v ) ) {
                                            array_push( $data, [
                                                'title'  => $v,
                                                'value'  => $discount_by_child_value[ $k ],
                                                'key'    => $discount_by_child_key[ $k ],
                                                'key_to' => $discount_by_child_key_to[ $k ],
                                            ] );
                                        }
                                    }

                                    update_post_meta( $post_id, 'discount_by_child', $data );
                                } else {
                                    update_post_meta( $post_id, 'discount_by_child', [] );
                                }

                                update_post_meta( $post_id, 'discount_by_people_type', STInput::request( 'discount_by_people_type' ) );

                                // Update extra
                                $extra = STInput::request( 'extra', '' );
                                if ( isset( $extra[ 'title' ] ) && is_array( $extra[ 'title' ] ) && count( $extra[ 'title' ] ) ) {
                                    $list_extras = [];
                                    foreach ( $extra[ 'title' ] as $key => $val ) {
                                        if ( !empty( $val ) ) {
                                            $list_extras[ $key ] = [
                                                'title'            => $val,
                                                'extra_name'       => isset( $extra[ 'extra_name' ][ $key ] ) ? $extra[ 'extra_name' ][ $key ] : '',
                                                'extra_max_number' => isset( $extra[ 'extra_max_number' ][ $key ] ) ? $extra[ 'extra_max_number' ][ $key ] : '',
                                                'extra_price'      => isset( $extra[ 'extra_price' ][ $key ] ) ? $extra[ 'extra_price' ][ $key ] : ''
                                            ];
                                        }
                                    }
                                    update_post_meta( $post_id, 'extra_price', $list_extras );
                                } else {
                                    update_post_meta( $post_id, 'extra_price', '' );
                                }
                                update_post_meta( $post_id, 'discount_type', STInput::request( 'discount_type' ) );
                                update_post_meta( $post_id, 'discount', (int)STInput::request( 'discount' ) );
                                update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );
                                $sale_price_from = TravelHelper::convertDateFormat( STInput::request( 'sale_price_from' ) );
                                $sale_price_from = date( 'Y-m-d', strtotime( $sale_price_from ) );
                                update_post_meta( $post_id, 'sale_price_from', $sale_price_from );
                                $sale_price_to = TravelHelper::convertDateFormat( STInput::request( 'sale_price_to' ) );
                                $sale_price_to = date( 'Y-m-d', strtotime( $sale_price_to ) );
                                update_post_meta( $post_id, 'sale_price_to', $sale_price_to );
                                update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                                update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );
                                update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                                update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                                update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );
                                update_post_meta( $post_id, 'best-price-guarantee', STInput::request( 'best-price-guarantee' ) );
                                update_post_meta( $post_id, 'best-price-guarantee-text', STInput::request( 'best-price-guarantee-text' ) );

                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 5,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $arr = [];
                                array_push($arr, 'adult_price');
                                array_push($arr, 'child_price');
                                array_push($arr, 'infant_price');

                                if(isset($_REQUEST['is_sale_schedule'])) {
                                    $is_sale_schedule = $_REQUEST['is_sale_schedule'];
                                    if ($is_sale_schedule == 'on') {
                                        array_push($arr, 'sale_price_from');
                                        array_push($arr, 'sale_price_to');
                                    }
                                }

                                if(isset($_REQUEST['deposit_payment_status']) && $_REQUEST['deposit_payment_status'] == 'percent'){
                                    array_push($arr, 'deposit_payment_amount');
                                }

                                if(isset($_REQUEST['st_allow_cancel']) && $_REQUEST['st_allow_cancel'] == 'on'){
                                    array_push($arr, 'st_cancel_number_days');
                                    array_push($arr, 'st_cancel_percent');
                                }

                                if(isset($_REQUEST['best-price-guarantee']) && $_REQUEST['best-price-guarantee'] == 'on'){
                                    array_push($arr, 'best-price-guarantee-text');
                                }
                                $err = $this->stSetErrorMessage($arr);
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'locations':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $valid = $this->stActivityValidate(5);
                            if($valid) {
                                if (isset($_REQUEST['multi_location'])) {
                                    $location = $_REQUEST['multi_location'];
                                    if (is_array($location) && count($location)) {
                                        $location_str = '';
                                        foreach ($location as $item) {
                                            if (empty($location_str)) {
                                                $location_str .= $item;
                                            } else {
                                                $location_str .= ',' . $item;
                                            }
                                        }
                                    } else {
                                        $location_str = '';
                                    }
                                    update_post_meta($post_id, 'multi_location', $location_str);
                                    update_post_meta($post_id, 'id_location', '');
                                }

                                update_post_meta($post_id, 'address', STInput::request('address'));

                                $gmap = STInput::request('gmap');
                                update_post_meta($post_id, 'map_lat', $gmap['lat']);
                                update_post_meta($post_id, 'map_lng', $gmap['lng']);
                                update_post_meta($post_id, 'map_zoom', $gmap['zoom']);
                                update_post_meta($post_id, 'map_type', $gmap['type']);

                                update_post_meta($post_id, 'st_google_map', $gmap);

                                update_post_meta($post_id, 'enable_street_views_google_map', STInput::request('enable_street_views_google_map'));

                                $properties = STInput::post( 'property-item', '' );
                                if ( !empty( $properties ) ) {
                                    $list = [];
                                    for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                        if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                            $list[] = [
                                                'title'          => $properties[ 'title' ][ $i ],
                                                'featured_image' => $properties[ 'featured_image' ][ $i ],
                                                'description'    => $properties[ 'description' ][ $i ],
                                                'icon'           => $properties[ 'icon' ][ $i ],
                                                'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                                'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                            ];
                                        }

                                    }
                                    update_post_meta( $post_id, 'properties_near_by', $list );
                                }

                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 6,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('address', 'multi_location'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'payments':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $data_paypment = STPaymentGateways::get_payment_gateways();
                            if (!empty($data_paypment) and is_array($data_paypment)) {
                                foreach ($data_paypment as $k => $v) {
                                    update_post_meta($post_id, 'is_meta_payment_gateway_' . $k, STInput::request('is_meta_payment_gateway_' . $k));
                                }
                            }
                            if($step != 'final'){
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 7,
                                    'next_step_name' => $step_name,
                                    'sc' => 'edit-activity',
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $this->getSuccessEditService('edit-activity', $post_id);
                            }
                        }
                        break;
                    case 'availability':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            update_post_meta($post_id, 'calendar_status', STInput::request('calendar_status'));
                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 8,
                                'next_step_name' => $step_name,
                                'post_id' => $post_id
                            ));
                            die;
                        }
                        break;
                    case 'ical':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            if($step != 'final') {
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 9,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $this->getSuccessEditService('edit-activity', $post_id);
                            }
                        }
                        break;
                    case 'custom_fields':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            /////////////////////////////////////
                            /// Update Custom Field
                            /////////////////////////////////////
                            $custom_field = st()->get_option( 'st_activity_unlimited_custom_field' );
                            if ( !empty( $custom_field ) ) {
                                foreach ( $custom_field as $k => $v ) {
                                    $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                    update_post_meta( $post_id, $key, STInput::request( $key ) );
                                }
                            }
                            if($step != 'final') {
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 10,
                                    'post_id' => $post_id,
                                    'next_step_name' => $step_name
                                ));
                                die;
                            }else{
                                $this->getSuccessEditService('edit-activity', $post_id);
                            }
                        }
                        break;

                }
            }
            private function stActivityValidate($step = 1){
                $validator = self::$validator;
                switch ($step){
                    case 1:
                        $validator->set_rules('st_title', __("Title", ST_TEXTDOMAIN), 'required|min_length[6]|max_length[100]');
                        $validator->set_rules('st_content', __("Content", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('st_desc', __("Short Intro", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('contact_email', __("Email", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('contact_web', __("Website", ST_TEXTDOMAIN), 'valid_url');
                        $validator->set_rules('video', __("Video", ST_TEXTDOMAIN), 'valid_url');
                        break;
                    case 2:
                        $validator->set_rules('duration', __("Duration", ST_TEXTDOMAIN), 'required');
                        break;
                    case 3:
                        $validator->set_rules('id_featured_image', __("Featured image", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('id_gallery', __("Gallery", ST_TEXTDOMAIN), 'required');
                        break;
                    case 4:
                        $validator->set_rules('adult_price', __("Adult price", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('child_price', __("Child price", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('infant_price', __("Infant price", ST_TEXTDOMAIN), 'required');

                        if(isset($_REQUEST['is_sale_schedule'])){
                            $is_sale_schedule = $_REQUEST['is_sale_schedule'];
                            if($is_sale_schedule == 'on'){
                                $validator->set_rules('sale_price_from', __("Sale start date", ST_TEXTDOMAIN), 'required');
                                $validator->set_rules('sale_price_to', __("Sale end date", ST_TEXTDOMAIN), 'required');
                            }
                        }

                        if(isset($_REQUEST['deposit_payment_status']) && $_REQUEST['deposit_payment_status'] == 'percent'){
                            $validator->set_rules('deposit_payment_amount', __("Deposit amount", ST_TEXTDOMAIN), 'required');
                        }

                        if(isset($_REQUEST['st_allow_cancel']) && $_REQUEST['st_allow_cancel'] == 'on'){
                            $validator->set_rules('st_cancel_number_days', __("Number of days before the arrival", ST_TEXTDOMAIN), 'required');
                            $validator->set_rules('st_cancel_percent', __("Percent of total price", ST_TEXTDOMAIN), 'required');
                        }

                        if(isset($_REQUEST['best-price-guarantee']) && $_REQUEST['best-price-guarantee'] == 'on'){
                            $validator->set_rules('best-price-guarantee-text', __("Best Price Guarantee Text", ST_TEXTDOMAIN), 'required');
                        }
                        break;
                    case 5:
                        $validator->set_rules('address', __("Address", ST_TEXTDOMAIN), 'required');
                        $location = $_REQUEST['multi_location'];
                        if(isset($_REQUEST['multi_location']) && empty($location)){
                            $validator->set_error_message('multi_location', __("The Location field is required.", ST_TEXTDOMAIN));
                        }
                        break;
                }

                $result = $validator->run();
                return $result;
            }
            public function st_partner_activity_info($fields){
                $list_tax_activity = TravelHelper::get_object_taxonomies_service('st_activity');
                if( !empty( $list_tax_activity ) ){
                    foreach( $list_tax_activity as $name => $label ){
                        $list = array();
                        $terms = get_terms( $name, array(
                            'hide_empty' => false,
                        ) );
                        if(!empty($terms)){
                            foreach( $terms as $key => $val){
                                $list[$val->term_id . ',' . $val->taxonomy] = $val->name;
                            }
                        }
                        $fields[] = array(
                            'type' => 'checkbox',
                            'label' => $label,
                            'name' => 'taxonomy[]',
                            'col' => '12',
                            'plh' => '',
                            'options' => $list,
                            'col_option' => '4',
                            'tax_name' => $name,
                            'seperate' => true
                        );
                    }
                }

                $new_arr = array(
                    array(
                        'type' => 'select',
                        'label' => __('Select activity type', ST_TEXTDOMAIN),
                        'name' => 'type_activity',
                        'col' => '4',
                        'plh' => '',
                        'required' => false,
                        'options' => array(
                            'daily_activity' => __('Daily Activity', ST_TEXTDOMAIN),
                            'specific_date' => __('Specific Date', ST_TEXTDOMAIN),
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Duration', ST_TEXTDOMAIN),
                        'name' => 'duration',
                        'col' => '4',
                        'plh' => '',
                        'required' => true
                    ),
                    array(
                        'type' => 'timepicker',
                        'label' => __('Activity Timing', ST_TEXTDOMAIN),
                        'name' => 'activity-time',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Booking period', ST_TEXTDOMAIN),
                        'name' => 'activity_booking_period',
                        'col' => '4',
                        'plh' => '',
                        'std' => '0',
                        'required' => false
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Max people. Leave empty or enter \'0\' for unlimited', ST_TEXTDOMAIN),
                        'name' => 'max_people',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                    array(
                        'type' => 'select',
                        'label' => __('External booking', ST_TEXTDOMAIN),
                        'name' => 'st_activity_external_booking',
                        'col' => '4',
                        'plh' => '',
                        'required' => false,
                        'options' => array(
                            'off' => __('No', ST_TEXTDOMAIN),
                            'on' => __('Yes', ST_TEXTDOMAIN),
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('External booking URL', ST_TEXTDOMAIN),
                        'name' => 'st_activity_external_booking_link',
                        'col' => '4',
                        'plh' => '',
                        'required' => true,
                        'condition' => 'st_activity_external_booking:is(on)'
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => __('Activity Include', ST_TEXTDOMAIN),
                        'name' => 'activity_include',
                        'col' => '6',
                        'plh' => '',
                        'required' => false,
                        'rows' => 6,
                        'clear' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => __('Activity Exclude', ST_TEXTDOMAIN),
                        'name' => 'activity_exclude',
                        'col' => '6',
                        'plh' => '',
                        'required' => false,
                        'rows' => 6,
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => __('Activity Highlight', ST_TEXTDOMAIN),
                        'name' => 'activity_highlight',
                        'col' => '12',
                        'plh' => '',
                        'required' => false,
                        'rows' => 6,
                    ),
                    array(

                        'type' => 'list-item',
                        'label' => __('Activity FAQ', ST_TEXTDOMAIN),
                        'name' => 'activity_faq',
                        'col' => '6',
                        'plh' => '',
                        'text_add' => __('Add New', ST_TEXTDOMAIN),
                        'fields' => array(
                            array(
                                'type' => 'text',
                                'label' => __('Title', ST_TEXTDOMAIN),
                                'name' => 'activity_faq_title'
                            ),
                            array(
                                'type' => 'textarea',
                                'label' => __('Description', ST_TEXTDOMAIN),
                                'name' => 'activity_faq_desc',
                                'rows' => 5
                            ),
                        )
                    ),
                );

                $fields = array_merge($fields, $new_arr);
                return $fields;
            }
            public function __stPartnerCreateServiceTour(){
                $step = STInput::post('step', 1);
                $step_name = STInput::post('step_name', 'basic_info');
                switch ($step_name){
                    case 'basic_info':
                        $valid = $this->stTourValidate(1);
                        if($valid){
                            if (!empty($_REQUEST['btn_insert_post_type_tour']) && empty(STInput::request('post_id'))) {
                                if (st()->get_option('partner_post_by_admin', 'on') == 'on') {
                                    $post_status = 'draft';
                                } else {
                                    $post_status = 'publish';
                                }
                                if (current_user_can('manage_options')) {
                                    $post_status = 'publish';
                                }
                                if (STInput::request('save_and_preview') == "true") {
                                    $post_status = 'draft';
                                }

                                $current_user = wp_get_current_user();

                                $my_post = [
                                    'post_title' => STInput::request('st_title', 'Title'),
                                    'post_content' => '',
                                    'post_status' => $post_status,
                                    'post_author' => $current_user->ID,
                                    'post_type' => 'st_tours',
                                    'post_excerpt' => ''
                                ];
                                $post_id = wp_insert_post($my_post);
                            }else{
                                $post_id = STInput::request('post_id');
                            }

                            if (!empty($post_id)) {
                                $my_post = [
                                    'ID' => $post_id,
                                    'post_title' => STInput::request('st_title'),
                                    'post_content' => STInput::request('st_content'),
                                    'post_excerpt' => stripslashes(STInput::request('st_desc')),
                                ];

                                if (st()->get_option('partner_post_by_admin', 'on') == 'off') {
                                    $my_post['post_status'] = 'publish';
                                }

                                $admin_packages = STAdminPackages::get_inst();
                                $set_status_publish = $admin_packages->count_item_can_public_status(get_current_user_id(), $post_id);
                                if ($admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ($set_status_publish !== 'unlimited' && $set_status_publish <= 0)) {
                                    $my_post['post_status'] = 'draft';
                                }

                                wp_update_post($my_post);

                                update_post_meta($post_id, 'show_agent_contact_info', STInput::request('show_agent_contact_info'));
                                update_post_meta($post_id, 'contact_email', STInput::request('contact_email'));
                                update_post_meta($post_id, 'website', STInput::request('website'));
                                update_post_meta($post_id, 'phone', STInput::request('phone'));
                                update_post_meta($post_id, 'fax', STInput::request('fax'));
                                update_post_meta($post_id, 'video', STInput::request('video'));
                            }

                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 2,
                                'next_step_name' => $step_name,
                                'post_id' => $post_id,
                            ));
                            die;
                        }else{
                            $err = $this->stSetErrorMessage(array('st_title', 'st_content', 'st_desc', 'contact_email', 'website', 'video'));
                            echo json_encode(array(
                                'status' => false,
                                'err' => $err
                            ));
                            die;
                        }
                        break;
                    case 'info':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            $valid = $this->stTourValidate(2);
                            if($valid){
                                /////////////////////////////////////
                                /// Update taxonomy
                                /////////////////////////////////////

                                if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                    $taxonomy = $_REQUEST[ 'taxonomy' ];
                                    if ( !empty( $taxonomy ) ) {
                                        $tax = [];
                                        foreach ( $taxonomy as $item ) {
                                            $tmp                = explode( ",", $item );
                                            $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                        }
                                        foreach ( $tax as $key2 => $val2 ) {
                                            wp_set_post_terms( $post_id, $val2, $key2 );
                                        }
                                    }
                                }

                                update_post_meta($post_id, 'type_tour', STInput::request('type_tour'));
                                update_post_meta($post_id, 'duration_day', STInput::request('duration_day'));
                                update_post_meta($post_id, 'tours_booking_period', (int)STInput::request('tours_booking_period'));
                                update_post_meta($post_id, 'max_people', STInput::request('max_people'));
                                update_post_meta($post_id, 'min_people', STInput::request('min_people'));
                                update_post_meta($post_id, 'st_tour_external_booking', STInput::request('st_tour_external_booking'));
                                update_post_meta($post_id, 'st_tour_external_booking_link', STInput::request('st_tour_external_booking_link'));
                                update_post_meta( $post_id, 'tours_include', STInput::request( 'tours_include' ) );
                                update_post_meta( $post_id, 'tours_exclude', STInput::request( 'tours_exclude' ) );

                                if ( !empty( $_REQUEST[ 'tours_faq_title' ] ) ) {
                                    $tours_faq_title = $_REQUEST[ 'tours_faq_title' ];
                                    $tours_faq_desc  = $_REQUEST[ 'tours_faq_desc' ];
                                    $tours_faq       = [];
                                    if ( !empty( $tours_faq_title ) ) {
                                        foreach ( $tours_faq_title as $k => $v ) {
                                            if(!empty($v) && !empty($tours_faq_desc[ $k ])) {
                                                array_push($tours_faq, [
                                                    'title' => $v,
                                                    'desc' => $tours_faq_desc[$k]
                                                ]);
                                            }
                                        }
                                        update_post_meta( $post_id, 'tours_faq', $tours_faq );
                                    }else{
                                        update_post_meta( $post_id, 'tours_faq', array() );
                                    }
                                }else{
                                    update_post_meta( $post_id, 'tours_faq', array() );
                                }

                                if ( !empty( $_REQUEST[ 'program_title' ] ) ) {
                                    $program_title = $_REQUEST[ 'program_title' ];
                                    $program_desc  = $_REQUEST[ 'program_desc' ];
                                    $program       = [];
                                    if ( !empty( $program_title ) ) {
                                        foreach ( $program_title as $k => $v ) {
                                            if(!empty($v) && !empty($program_desc[ $k ])) {
                                                array_push($program, [
                                                    'title' => $v,
                                                    'desc' => $program_desc[$k]
                                                ]);
                                            }
                                        }
                                        update_post_meta( $post_id, 'tours_program', $program );
                                    }else{
                                        update_post_meta( $post_id, 'tours_program', array() );
                                    }
                                }else{
                                    update_post_meta( $post_id, 'tours_program', array() );
                                }

                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 3,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $arr_err = array('duration_day', 'min_people');
                                if(isset($_REQUEST['st_tour_external_booking']) && $_REQUEST['st_tour_external_booking'] == 'on'){
                                    array_push($arr_err, 'st_tour_external_booking_link');
                                }
                                $err = $this->stSetErrorMessage($arr_err);
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'photos':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            $valid = $this->stTourValidate(3);
                            if($valid) {
                                $gallery = STInput::request('id_gallery', '');
                                update_post_meta($post_id, 'gallery', $gallery);
                                $thumbnail = (int)STInput::request('id_featured_image', '');
                                set_post_thumbnail($post_id, $thumbnail);
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 4,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('id_featured_image', 'id_gallery'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'prices':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $valid = $this->stTourValidate(4);
                            if($valid) {
                                update_post_meta( $post_id, 'tour_price_by', STInput::request( 'tour_price_by' ) );
                                update_post_meta( $post_id, 'adult_price', STInput::request( 'adult_price' ) );
                                update_post_meta( $post_id, 'child_price', STInput::request( 'child_price' ) );
                                update_post_meta( $post_id, 'infant_price', STInput::request( 'infant_price' ) );

                                update_post_meta( $post_id, 'base_price', STInput::request( 'base_price' ) );

                                $start_date_fixed = STInput::request( 'start_date_fixed' );
                                $end_date_fixed   = STInput::request( 'end_date_fixed' );
                                if ( !empty( $start_date_fixed ) and !empty( $end_date_fixed ) ) {
                                    update_post_meta( $post_id, 'start_date_fixed', date( 'Y-m-d', strtotime( TravelHelper::convertDateFormat( $start_date_fixed ) ) ) );
                                    update_post_meta( $post_id, 'end_date_fixed', date( 'Y-m-d', strtotime( TravelHelper::convertDateFormat( $end_date_fixed ) ) ) );
                                }

                                update_post_meta( $post_id, 'hide_adult_in_booking_form', STInput::request( 'hide_adult_in_booking_form' ) );
                                update_post_meta( $post_id, 'hide_children_in_booking_form', STInput::request( 'hide_children_in_booking_form' ) );
                                update_post_meta( $post_id, 'hide_infant_in_booking_form', STInput::request( 'hide_infant_in_booking_form' ) );

                                $discount_by_adult_title = STInput::request( 'discount_by_adult_title' );
                                if ( !empty( $discount_by_adult_title ) ) {
                                    $discount_by_adult_value  = $_REQUEST[ 'discount_by_adult_value' ];
                                    $discount_by_adult_key    = $_REQUEST[ 'discount_by_adult_key' ];
                                    $discount_by_adult_key_to = $_REQUEST[ 'discount_by_adult_key_to' ];
                                    $data                     = [];
                                    foreach ( $discount_by_adult_title as $k => $v ) {
                                        if ( !empty( $v ) ) {
                                            array_push( $data, [
                                                'title'  => $v,
                                                'value'  => $discount_by_adult_value[ $k ],
                                                'key'    => $discount_by_adult_key[ $k ],
                                                'key_to' => $discount_by_adult_key_to[ $k ],
                                            ] );
                                        }

                                    }
                                    update_post_meta( $post_id, 'discount_by_adult', $data );
                                } else {
                                    update_post_meta( $post_id, 'discount_by_adult', [] );
                                }

                                $discount_by_child_title = STInput::request( 'discount_by_child_title' );
                                if ( !empty( $discount_by_child_title ) ) {
                                    $discount_by_child_value  = $_REQUEST[ 'discount_by_child_value' ];
                                    $discount_by_child_key    = $_REQUEST[ 'discount_by_child_key' ];
                                    $discount_by_child_key_to = $_REQUEST[ 'discount_by_child_key_to' ];
                                    $data                     = [];
                                    foreach ( $discount_by_child_title as $k => $v ) {
                                        if ( !empty( $v ) ) {
                                            array_push( $data, [
                                                'title'  => $v,
                                                'value'  => $discount_by_child_value[ $k ],
                                                'key'    => $discount_by_child_key[ $k ],
                                                'key_to' => $discount_by_child_key_to[ $k ],
                                            ] );
                                        }
                                    }

                                    update_post_meta( $post_id, 'discount_by_child', $data );
                                } else {
                                    update_post_meta( $post_id, 'discount_by_child', [] );
                                }

                                update_post_meta( $post_id, 'discount_by_people_type', STInput::request( 'discount_by_people_type' ) );

                                // Update extra
                                $extra = STInput::request( 'extra', '' );
                                if ( isset( $extra[ 'title' ] ) && is_array( $extra[ 'title' ] ) && count( $extra[ 'title' ] ) ) {
                                    $list_extras = [];
                                    foreach ( $extra[ 'title' ] as $key => $val ) {
                                        if ( !empty( $val ) ) {
                                            $list_extras[ $key ] = [
                                                'title'            => $val,
                                                'extra_name'       => isset( $extra[ 'extra_name' ][ $key ] ) ? $extra[ 'extra_name' ][ $key ] : '',
                                                'extra_max_number' => isset( $extra[ 'extra_max_number' ][ $key ] ) ? $extra[ 'extra_max_number' ][ $key ] : '',
                                                'extra_price'      => isset( $extra[ 'extra_price' ][ $key ] ) ? $extra[ 'extra_price' ][ $key ] : ''
                                            ];
                                        }
                                    }
                                    update_post_meta( $post_id, 'extra_price', $list_extras );
                                } else {
                                    update_post_meta( $post_id, 'extra_price', '' );
                                }

                                update_post_meta( $post_id, 'discount_type', STInput::request( 'discount_type' ) );
                                update_post_meta( $post_id, 'discount', (int)STInput::request( 'discount' ) );

                                update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );
                                $sale_price_from = TravelHelper::convertDateFormat( STInput::request( 'sale_price_from' ) );
                                $sale_price_from = date( 'Y-m-d', strtotime( $sale_price_from ) );
                                update_post_meta( $post_id, 'sale_price_from', $sale_price_from );
                                $sale_price_to = TravelHelper::convertDateFormat( STInput::request( 'sale_price_to' ) );
                                $sale_price_to = date( 'Y-m-d', strtotime( $sale_price_to ) );
                                update_post_meta( $post_id, 'sale_price_to', $sale_price_to );

                                update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                                update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );

                                update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                                update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                                update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );

                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 5,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                if(isset($_REQUEST['tour_price_by'])){
                                    $tour_price_type = $_REQUEST['tour_price_by'];
                                    $arr = [];
                                    if($tour_price_type == 'person' || $tour_price_type == 'fixed_depart'){
                                        array_push($arr, 'adult_price');
                                        array_push($arr, 'child_price');
                                        array_push($arr, 'infant_price');
                                    }
                                    if($tour_price_type == 'fixed_depart'){
                                        array_push($arr, 'start_date_fixed');
                                        array_push($arr, 'end_date_fixed');
                                    }
                                    if($tour_price_type == 'fixed'){
                                        array_push($arr, 'base_price');
                                    }
                                }
                                if(isset($_REQUEST['is_sale_schedule'])) {
                                    $is_sale_schedule = $_REQUEST['is_sale_schedule'];
                                    if ($is_sale_schedule == 'on') {
                                        array_push($arr, 'sale_price_from');
                                        array_push($arr, 'sale_price_to');
                                    }
                                }
                                if(isset($_REQUEST['deposit_payment_status'])){
                                    $deposit_payment_status = $_REQUEST['deposit_payment_status'];
                                    if($deposit_payment_status == 'percent'){
                                        array_push($arr, 'deposit_payment_amount');
                                    }
                                }
                                if(isset($_REQUEST['st_allow_cancel'])){
                                    $st_allow_cancel = $_REQUEST['st_allow_cancel'];
                                    if($st_allow_cancel == 'on'){
                                        array_push($arr, 'st_cancel_number_days');
                                        array_push($arr, 'st_cancel_percent');
                                    }
                                }
                                $err = $this->stSetErrorMessage($arr);
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'locations':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $valid = $this->stTourValidate(5);
                            if($valid) {
                                if (isset($_REQUEST['multi_location'])) {
                                    $location = $_REQUEST['multi_location'];
                                    if (is_array($location) && count($location)) {
                                        $location_str = '';
                                        foreach ($location as $item) {
                                            if (empty($location_str)) {
                                                $location_str .= $item;
                                            } else {
                                                $location_str .= ',' . $item;
                                            }
                                        }
                                    } else {
                                        $location_str = '';
                                    }
                                    update_post_meta($post_id, 'multi_location', $location_str);
                                    update_post_meta($post_id, 'id_location', '');
                                }

                                update_post_meta($post_id, 'address', STInput::request('address'));

                                $gmap = STInput::request('gmap');
                                update_post_meta($post_id, 'map_lat', $gmap['lat']);
                                update_post_meta($post_id, 'map_lng', $gmap['lng']);
                                update_post_meta($post_id, 'map_zoom', $gmap['zoom']);
                                update_post_meta($post_id, 'map_type', $gmap['type']);

                                update_post_meta($post_id, 'st_google_map', $gmap);

                                update_post_meta($post_id, 'enable_street_views_google_map', STInput::request('enable_street_views_google_map'));

                                $properties = STInput::post( 'property-item', '' );
                                if ( !empty( $properties ) ) {
                                    $list = [];
                                    for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                        if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                            $list[] = [
                                                'title'          => $properties[ 'title' ][ $i ],
                                                'featured_image' => $properties[ 'featured_image' ][ $i ],
                                                'description'    => $properties[ 'description' ][ $i ],
                                                'icon'           => $properties[ 'icon' ][ $i ],
                                                'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                                'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                            ];
                                        }

                                    }
                                    update_post_meta( $post_id, 'properties_near_by', $list );
                                }

                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 6,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('address', 'multi_location'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'payments':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $data_paypment = STPaymentGateways::get_payment_gateways();
                            if (!empty($data_paypment) and is_array($data_paypment)) {
                                foreach ($data_paypment as $k => $v) {
                                    update_post_meta($post_id, 'is_meta_payment_gateway_' . $k, STInput::request('is_meta_payment_gateway_' . $k));
                                }
                            }

                            if($step != 'final'){
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 7,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $this->getSuccessEditService('edit-tours', $post_id);
                            }
                        }
                        break;
                    case 'package':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 8,
                                'sc' => 'edit-tours',
                                'next_step_name' => $step_name,
                                'post_id' => $post_id
                            ));
                            die;
                        }
                        break;
                    case 'availability':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 9,
                                'next_step_name' => $step_name,
                                'post_id' => $post_id
                            ));
                            die;
                        }
                        break;
                    case 'ical':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            if($step != 'final') {
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 10,
                                    'next_step_name' => $step_name,
                                    'post_id' => $post_id
                                ));
                                die;
                            }else{
                                $this->getSuccessEditService('edit-tours', $post_id);
                            }
                        }
                        break;
                    case 'custom_fields':

                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            /////////////////////////////////////
                            /// Update Custom Field
                            /////////////////////////////////////
                            $custom_field = st()->get_option( 'tours_unlimited_custom_field' );
                            if ( !empty( $custom_field ) ) {
                                foreach ( $custom_field as $k => $v ) {
                                    $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                    update_post_meta( $post_id, $key, STInput::request( $key ) );
                                }
                            }
                            if($step != 'final') {
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 11,
                                    'post_id' => $post_id,
                                    'next_step_name' => $step_name
                                ));
                                die;
                            }else{
                                $this->getSuccessEditService('edit-tours', $post_id);
                            }
                        }
                        break;
                }



            }
            private function stTourValidate($step = 1){
                $validator = self::$validator;
                switch ($step){
                    case 1:
                        $validator->set_rules('st_title', __("Title", ST_TEXTDOMAIN), 'required|min_length[6]|max_length[100]');
                        $validator->set_rules('st_content', __("Content", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('st_desc', __("Short Intro", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('contact_email', __("Email", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('website', __("Website", ST_TEXTDOMAIN), 'valid_url');
                        $validator->set_rules('video', __("Video", ST_TEXTDOMAIN), 'valid_url');
                        break;
                    case 2:
                        $validator->set_rules('duration_day', __("Duration", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('min_people', __("Min people", ST_TEXTDOMAIN), 'required');
                        if(isset($_REQUEST['st_tour_external_booking']) && $_REQUEST['st_tour_external_booking'] == 'on'){
                            $validator->set_rules('st_tour_external_booking_link', __("External booking URL", ST_TEXTDOMAIN), 'required|valid_url');
                        }
                        break;
                    case 3:
                        $validator->set_rules('id_featured_image', __("Featured image", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('id_gallery', __("Gallery", ST_TEXTDOMAIN), 'required');
                        break;
                    case 4:
                        if(isset($_REQUEST['tour_price_by'])){
                            $tour_price_type = $_REQUEST['tour_price_by'];
                            if($tour_price_type == 'person' || $tour_price_type == 'fixed_depart'){
                                $validator->set_rules('adult_price', __("Adult price", ST_TEXTDOMAIN), 'required');
                                $validator->set_rules('child_price', __("Child price", ST_TEXTDOMAIN), 'required');
                                $validator->set_rules('infant_price', __("Infant price", ST_TEXTDOMAIN), 'required');
                            }

                            if($tour_price_type == 'fixed_depart'){
                                $validator->set_rules('start_date_fixed', __("Start date", ST_TEXTDOMAIN), 'required');
                                $validator->set_rules('end_date_fixed', __("End date", ST_TEXTDOMAIN), 'required');
                            }

                            if($tour_price_type == 'fixed'){
                                $validator->set_rules('base_price', __("Base price", ST_TEXTDOMAIN), 'required');
                            }
                        }
                        if(isset($_REQUEST['is_sale_schedule'])){
                            $is_sale_schedule = $_REQUEST['is_sale_schedule'];
                            if($is_sale_schedule == 'on'){
                                $validator->set_rules('sale_price_from', __("Sale start date", ST_TEXTDOMAIN), 'required');
                                $validator->set_rules('sale_price_to', __("Sale end date", ST_TEXTDOMAIN), 'required');
                            }
                        }
                        if(isset($_REQUEST['deposit_payment_status'])){
                            $deposit_payment_status = $_REQUEST['deposit_payment_status'];
                            if($deposit_payment_status == 'percent'){
                                $validator->set_rules('deposit_payment_amount', __("Deposit amount", ST_TEXTDOMAIN), 'required');
                            }
                        }
                        if(isset($_REQUEST['st_allow_cancel'])){
                            $st_allow_cancel = $_REQUEST['st_allow_cancel'];
                            if($st_allow_cancel == 'on'){
                                $validator->set_rules('st_cancel_number_days', __("Number of days before the arrival", ST_TEXTDOMAIN), 'required');
                                $validator->set_rules('st_cancel_percent', __("Percent of total price", ST_TEXTDOMAIN), 'required');
                            }
                        }
                        break;
                    case 5:
                        $validator->set_rules('address', __("Address", ST_TEXTDOMAIN), 'required');
                        $location = $_REQUEST['multi_location'];
                        if(isset($_REQUEST['multi_location']) && empty($location)){
                            $validator->set_error_message('multi_location', __("The Location field is required.", ST_TEXTDOMAIN));
                        }
                        break;
                }

                $result = $validator->run();
                return $result;
            }
            public function st_partner_tour_tabs_payment($fields){
                array_push($fields, array(
                    'name' => 'payments',
                    'label' => __('5. Payments', ST_TEXTDOMAIN)
                ));

                $sc = STInput::get('sc');
                $id = STInput::get('id');
                if (!empty($id)) {
                    if (!empty($sc) && $sc == 'edit-tours') {
                        array_push($fields, array(
                            'name' => 'package',
                            'label' => __('6. Packages', ST_TEXTDOMAIN)
                        ));
                        array_push($fields, array(
                            'name' => 'availability',
                            'label' => __('7. Availability', ST_TEXTDOMAIN)
                        ));
                        array_push($fields, array(
                            'name' => 'ical',
                            'label' => __('8. iCal Sync', ST_TEXTDOMAIN)
                        ));
                    }

                    if (!empty($sc) && $sc == 'edit-activity') {
                        array_push($fields, array(
                            'name' => 'availability',
                            'label' => __('6. Availability', ST_TEXTDOMAIN)
                        ));
                        array_push($fields, array(
                            'name' => 'ical',
                            'label' => __('7. iCal Sync', ST_TEXTDOMAIN)
                        ));
                    }

                    if (!empty($sc) && $sc == 'edit-rental') {
                        array_push($fields, array(
                            'name' => 'availability',
                            'label' => __('6. Availability', ST_TEXTDOMAIN)
                        ));
                        array_push($fields, array(
                            'name' => 'ical',
                            'label' => __('7. iCal Sync', ST_TEXTDOMAIN)
                        ));
                    }
                }
                return $fields;
            }
            public function st_partner_tour_info($fields){
                $list_tax_tour = TravelHelper::get_object_taxonomies_service('st_tours');
                if( !empty( $list_tax_tour ) ){
                    foreach( $list_tax_tour as $name => $label ){
                        $list = array();
                        $terms = get_terms( $name, array(
                            'hide_empty' => false,
                        ) );
                        if(!empty($terms)){
                            foreach( $terms as $key => $val){
                                $list[$val->term_id . ',' . $val->taxonomy] = $val->name;
                            }
                        }
                        $fields[] = array(
                            'type' => 'checkbox',
                            'label' => $label,
                            'name' => 'taxonomy[]',
                            'col' => '12',
                            'plh' => '',
                            'options' => $list,
                            'col_option' => '4',
                            'tax_name' => $name,
                            'seperate' => true
                        );
                    }
                }

                $new_arr = array(
                    array(
                        'type' => 'select',
                        'label' => __('Tour type', ST_TEXTDOMAIN),
                        'name' => 'type_tour',
                        'col' => '4',
                        'plh' => '',
                        'required' => false,
                        'options' => array(
                            'specific_date' => __('Specific Date', ST_TEXTDOMAIN),
                            'daily_tour' => __('Daily Tour', ST_TEXTDOMAIN),
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Duration', ST_TEXTDOMAIN),
                        'name' => 'duration_day',
                        'col' => '4',
                        'plh' => '',
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Booking period', ST_TEXTDOMAIN),
                        'name' => 'tours_booking_period',
                        'col' => '4',
                        'plh' => '',
                        'std' => '0',
                        'required' => false
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Min people', ST_TEXTDOMAIN),
                        'name' => 'min_people',
                        'col' => '4',
                        'plh' => '',
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('Max people', ST_TEXTDOMAIN),
                        'name' => 'max_people',
                        'col' => '4',
                        'plh' => '',
                        'required' => false
                    ),
                    array(
                        'type' => 'select',
                        'label' => __('External booking', ST_TEXTDOMAIN),
                        'name' => 'st_tour_external_booking',
                        'col' => '4',
                        'plh' => '',
                        'required' => false,
                        'options' => array(
                            'off' => __('No', ST_TEXTDOMAIN),
                            'on' => __('Yes', ST_TEXTDOMAIN),
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => __('External booking URL', ST_TEXTDOMAIN),
                        'name' => 'st_tour_external_booking_link',
                        'col' => '4',
                        'plh' => '',
                        'required' => true,
                        'condition' => 'st_tour_external_booking:is(on)'
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => __('Tour Include', ST_TEXTDOMAIN),
                        'name' => 'tours_include',
                        'col' => '6',
                        'plh' => '',
                        'required' => false,
                        'rows' => 6,
                        'clear' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => __('Tour Exclude', ST_TEXTDOMAIN),
                        'name' => 'tours_exclude',
                        'col' => '6',
                        'plh' => '',
                        'required' => false,
                        'rows' => 6,
                    ),
                    array(
                        'type' => 'list-item',
                        'label' => __('Tour FAQ', ST_TEXTDOMAIN),
                        'name' => 'tours_faq',
                        'col' => '6',
                        'plh' => '',
                        'text_add' => __('Add New', ST_TEXTDOMAIN),
                        'fields' => array(
                            array(
                                'type' => 'text',
                                'label' => __('Title', ST_TEXTDOMAIN),
                                'name' => 'tours_faq_title'
                            ),
                            array(
                                'type' => 'textarea',
                                'label' => __('Description', ST_TEXTDOMAIN),
                                'name' => 'tours_faq_desc',
                                'rows' => 5
                            ),
                        )
                    ),
                    array(
                        'type' => 'list-item',
                        'label' => __('Tour Program', ST_TEXTDOMAIN),
                        'name' => 'tours_program',
                        'col' => '6',
                        'plh' => '',
                        'text_add' => __('Add New', ST_TEXTDOMAIN),
                        'fields' => array(
                            array(
                                'type' => 'text',
                                'label' => __('Title', ST_TEXTDOMAIN),
                                'name' => 'program_title'
                            ),
                            array(
                                'type' => 'textarea',
                                'label' => __('Description', ST_TEXTDOMAIN),
                                'name' => 'program_desc',
                                'rows' => 5
                            ),
                        )
                    )
                );

                $fields = array_merge($fields, $new_arr);
                return $fields;
            }
            public function __stPartnerCreateServiceRoom(){
                $step = STInput::post('step', 1);
                $step_name = STInput::post('step_name', 'basic_info');
                switch ($step_name){
                    case 'basic_info':
                        $valid = $this->stHotelRoomValidate(1);
                        if($valid){
                            if (!empty($_REQUEST['btn_insert_post_type_hotel_room']) && empty(STInput::request('post_id'))) {
                                if (st()->get_option('partner_post_by_admin', 'on') == 'on') {
                                    $post_status = 'draft';
                                } else {
                                    $post_status = 'publish';
                                }
                                if (current_user_can('manage_options')) {
                                    $post_status = 'publish';
                                }
                                if (STInput::request('save_and_preview') == "true") {
                                    $post_status = 'draft';
                                }

                                $current_user = wp_get_current_user();

                                $my_post = [
                                    'post_title' => STInput::request('st_title', 'Title'),
                                    'post_content' => '',
                                    'post_status' => $post_status,
                                    'post_author' => $current_user->ID,
                                    'post_type' => 'hotel_room',
                                    'post_excerpt' => ''
                                ];
                                $post_id = wp_insert_post($my_post);
                            }else{
                                $post_id = STInput::request('post_id');
                            }

                            if (!empty($post_id)) {
                                $my_post = [
                                    'ID' => $post_id,
                                    'post_title' => STInput::request('st_title'),
                                    'post_content' => STInput::request('st_content'),
                                    'post_excerpt' => stripslashes(STInput::request('st_desc')),
                                ];

                                if (st()->get_option('partner_post_by_admin', 'on') == 'off') {
                                    $my_post['post_status'] = 'publish';
                                }

                                $admin_packages = STAdminPackages::get_inst();
                                $set_status_publish = $admin_packages->count_item_can_public_status(get_current_user_id(), $post_id);
                                if ($admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ($set_status_publish !== 'unlimited' && $set_status_publish <= 0)) {
                                    $my_post['post_status'] = 'draft';
                                }

                                wp_update_post($my_post);

                                update_post_meta($post_id, 'st_custom_layout', STInput::request('st_custom_layout'));
                                update_post_meta($post_id, 'room_parent', STInput::request('room_parent'));

                                update_post_meta($post_id, 'number_room', (int)STInput::request('number_room'));
                                update_post_meta($post_id, 'adult_number', (int)STInput::request('adult_number'));
                                update_post_meta($post_id, 'children_number', (int)STInput::request('children_number'));
                                update_post_meta($post_id, 'bed_number', (int)STInput::request('bed_number'));
                                update_post_meta($post_id, 'room_footage', (int)STInput::request('room_footage'));
                                update_post_meta($post_id, 'st_room_external_booking', (int)STInput::request('st_room_external_booking'));
                                update_post_meta($post_id, 'st_room_external_booking_link', (int)STInput::request('st_room_external_booking_link'));
                            }
                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 2,
                                'post_id' => $post_id,
                                'next_step_name' => $step_name
                            ));
                            die;
                        }else{
                            $arr_field = array('st_title', 'st_content', 'st_desc', 'number_room', 'adult_number', 'children_number', 'bed_number', 'room_footage');

                            if(isset($_REQUEST['st_room_external_booking']) && $_REQUEST['st_room_external_booking'] == 'on'){
                                array_push($arr_field, 'st_room_external_booking_link');
                            }
                            $err = $this->stSetErrorMessage($arr_field);
                            echo json_encode(array(
                                'status' => false,
                                'err' => $err
                            ));
                            die;
                        }
                        break;
                    case 'facility':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            /////////////////////////////////////
                            /// Update taxonomy
                            /////////////////////////////////////
                            if (!empty($_REQUEST['taxonomy'])) {
                                if (!empty($_REQUEST['taxonomy'])) {
                                    $taxonomy = STInput::request('taxonomy');
                                    if (!empty($taxonomy)) {
                                        $tax = [];
                                        foreach ($taxonomy as $item) {
                                            $tmp = explode(",", $item);
                                            $tax[$tmp[1]][] = $tmp[0];
                                        }
                                        foreach ($tax as $key2 => $val2) {
                                            wp_set_post_terms($post_id, $val2, $key2);
                                        }
                                    }
                                }
                            }

                            //tab other facility
                            $add_new_facility_title = STInput::request('add_new_facility_title');
                            $add_new_facility_value = STInput::request('add_new_facility_value');
                            $add_new_facility_icon = STInput::request('add_new_facility_icon');
                            if (!empty($add_new_facility_title)) {
                                $data = [];
                                foreach ($add_new_facility_title as $k => $v) {
                                    if(!empty($v) && !empty($add_new_facility_value[$k]) && !empty($add_new_facility_icon[$k])) {
                                        $data[] = ['title' => $v, 'facility_value' => $add_new_facility_value[$k], 'facility_icon' => $add_new_facility_icon[$k]];
                                    }
                                }
                                update_post_meta($post_id, 'add_new_facility', $data);
                            }

                            update_post_meta($post_id, 'room_description', stripslashes(STInput::request('room_description')));

                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 3,
                                'post_id' => $post_id,
                                'next_step_name' => $step_name
                            ));
                            die;
                        }
                        break;
                    case 'photos':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            $valid = $this->stHotelRoomValidate(3);
                            if($valid) {
                                $gallery = STInput::request('id_gallery', '');
                                update_post_meta($post_id, 'gallery', $gallery);
                                $thumbnail = (int)STInput::request('id_featured_image', '');
                                set_post_thumbnail($post_id, $thumbnail);
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 4,
                                    'post_id' => $post_id,
                                    'next_step_name' => $step_name
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('id_featured_image', 'id_gallery'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'prices':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $valid = $this->stHotelRoomValidate(4);
                            if($valid) {

                                update_post_meta($post_id, 'allow_full_day', STInput::request('allow_full_day', 'off'));
                                update_post_meta($post_id, 'price', STInput::request('price'));

                                /*Update discount by day for room*/
                                $discount_by_day = STInput::request( 'discount_by_day', '' );
                                if ( isset( $discount_by_day[ 'title' ] ) && is_array( $discount_by_day[ 'title' ] ) && count( $discount_by_day[ 'title' ] ) ) {
                                    $list_discount_by_day = [];
                                    foreach ( $discount_by_day[ 'title' ] as $key => $val ) {
                                        if ( !empty( $val ) ) {
                                            $list_discount_by_day[ $key ] = [
                                                'title'      => $val,
                                                'number_day' => isset( $discount_by_day[ 'number_day' ][ $key ] ) ? $discount_by_day[ 'number_day' ][ $key ] : '',
                                                'discount'   => isset( $discount_by_day[ 'discount' ][ $key ] ) ? $discount_by_day[ 'discount' ][ $key ] : '',
                                            ];
                                        }
                                    }
                                    update_post_meta( $post_id, 'discount_by_day', $list_discount_by_day );
                                } else {
                                    update_post_meta( $post_id, 'discount_by_day', '' );
                                }
                                update_post_meta($post_id, 'discount_type_no_day', STInput::request('discount_type_no_day', ''));
                                /*End Update discount by day for room*/

                                update_post_meta($post_id, 'discount_rate', STInput::request('discount_rate'));

                                update_post_meta($post_id, 'deposit_payment_status', STInput::request('deposit_payment_status'));
                                update_post_meta($post_id, 'deposit_payment_amount', STInput::request('deposit_payment_amount'));

                                // Update extra
                                $extra = STInput::request('extra', '');
                                if (isset($extra['title']) && is_array($extra['title']) && count($extra['title'])) {
                                    $list_extras = [];
                                    foreach ($extra['title'] as $key => $val) {
                                        if (!empty($val)) {
                                            $list_extras[$key] = [
                                                'title' => $val,
                                                'extra_name' => isset($extra['extra_name'][$key]) ? $extra['extra_name'][$key] : '',
                                                'extra_max_number' => isset($extra['extra_max_number'][$key]) ? $extra['extra_max_number'][$key] : '',
                                                'extra_price' => isset($extra['extra_price'][$key]) ? $extra['extra_price'][$key] : ''
                                            ];
                                        }
                                    }
                                    update_post_meta($post_id, 'extra_price', $list_extras);
                                } else {
                                    update_post_meta($post_id, 'extra_price', '');
                                }

                                update_post_meta($post_id, 'st_allow_cancel', STInput::request('st_allow_cancel'));
                                update_post_meta($post_id, 'st_cancel_number_days', STInput::request('st_cancel_number_days'));
                                update_post_meta($post_id, 'st_cancel_percent', STInput::request('st_cancel_percent'));

                                //$class_room = new STAdminRoom();
                                //$class_room->_update_avg_price($post_id);

                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 5,
                                    'post_id' => $post_id,
                                    'next_step_name' => $step_name
                                ));
                                die;
                            }else{
                                $arr_err = array('price');

                                if(isset($_REQUEST['deposit_payment_status']) && $_REQUEST['deposit_payment_status'] == 'percent'){
                                    array_push($arr_err, 'deposit_payment_amount');
                                }
                                if(isset($_REQUEST['st_allow_cancel']) && $_REQUEST['st_allow_cancel'] == 'on'){
                                    array_push($arr_err, 'st_cancel_number_days');
                                    array_push($arr_err, 'st_cancel_percent');
                                }
                                $err = $this->stSetErrorMessage($arr_err);
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'locations':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $valid = $this->stHotelRoomValidate(5);
                            if($valid) {
                                if (isset($_REQUEST['multi_location'])) {
                                    $location = $_REQUEST['multi_location'];
                                    if (is_array($location) && count($location)) {
                                        $location_str = '';
                                        foreach ($location as $item) {
                                            if (empty($location_str)) {
                                                $location_str .= $item;
                                            } else {
                                                $location_str .= ',' . $item;
                                            }
                                        }
                                    } else {
                                        $location_str = '';
                                    }
                                    update_post_meta($post_id, 'multi_location', $location_str);
                                    update_post_meta($post_id, 'id_location', '');
                                }

                                update_post_meta($post_id, 'address', STInput::request('address'));

                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 6,
                                    'post_id' => $post_id,
                                    'next_step_name' => $step_name
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('address', 'multi_location'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'payments':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $data_paypment = STPaymentGateways::get_payment_gateways();
                            if (!empty($data_paypment) and is_array($data_paypment)) {
                                foreach ($data_paypment as $k => $v) {
                                    update_post_meta($post_id, 'is_meta_payment_gateway_' . $k, STInput::request('is_meta_payment_gateway_' . $k));
                                }
                            }

                            if($step != 'final'){
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 7,
                                    'post_id' => $post_id,
                                    'sc' => 'edit-room',
                                    'next_step_name' => $step_name
                                ));
                                die;
                            }else{
                                $class_room = new STAdminRoom();
                                $class_room->_update_avg_price( $post_id );
                                $this->getSuccessEditService('edit-room', $post_id);
                            }
                        }
                        break;
                    case 'availability':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            update_post_meta( $post_id, 'default_state', STInput::request( 'default_state' ) );
                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 8,
                                'post_id' => $post_id,
                                'next_step_name' => $step_name
                            ));
                            die;
                        }
                        break;
                    case 'ical':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $class_room = new STAdminRoom();
                            $class_room->_update_avg_price( $post_id );
                            $this->getSuccessEditService('edit-room', $post_id);
                        }
                        break;
                }
            }
            private function getSuccessEditService($sc, $post_id){
                $linkEdit = add_query_arg(array(
                    'sc' => $sc,
                    'id' => $post_id
                ), get_the_permalink(st()->get_option('page_my_account_dashboard')));

                STTemplate::set_message(__('Successfully.', ST_TEXTDOMAIN), 'success');
                echo json_encode(array(
                    'status' => true,
                    'next_step' => 'final',
                    'post_id' => $post_id,
                    'linkEdit' => $linkEdit,
                    'message' => __('Successfully.', ST_TEXTDOMAIN)
                ));
                die;
            }
            private function stHotelRoomValidate($step = 1){
                $validator = self::$validator;
                switch ($step){
                    case 1:
                        $validator->set_rules('st_title', __("Title", ST_TEXTDOMAIN), 'required|min_length[6]|max_length[100]');
                        $validator->set_rules('st_content', __("Content", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('st_desc', __("Short Intro", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('number_room', __("Number of room", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('adult_number', __("Number of adult", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('children_number', __("Number of children", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('bed_number', __("Number of bed", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('room_footage', __("Room Footage", ST_TEXTDOMAIN), 'required');
                        if(isset($_REQUEST['st_room_external_booking']) && $_REQUEST['st_room_external_booking'] == 'on'){
                            $validator->set_rules('st_room_external_booking_link', __("External Link", ST_TEXTDOMAIN), 'required|valid_url');
                        }
                        break;
                    case 3:
                        $validator->set_rules('id_featured_image', __("Featured image", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('id_gallery', __("Gallery", ST_TEXTDOMAIN), 'required');
                        break;
                    case 4:
                        $validator->set_rules('price', __("Price", ST_TEXTDOMAIN), 'required');
                        if(isset($_REQUEST['deposit_payment_status']) && $_REQUEST['deposit_payment_status'] == 'percent'){
                            $validator->set_rules('deposit_payment_amount', __("Deposit Payment Amount", ST_TEXTDOMAIN), 'required');
                        }
                        if(isset($_REQUEST['st_allow_cancel']) && $_REQUEST['st_allow_cancel'] == 'on'){
                            $validator->set_rules('st_cancel_number_days', __("Number of days before the arrival", ST_TEXTDOMAIN), 'required');
                            $validator->set_rules('st_cancel_percent', __("Percent of total price", ST_TEXTDOMAIN), 'required');
                        }
                        break;
                    case 5:
                        $validator->set_rules('address', __("Address", ST_TEXTDOMAIN), 'required');
                        $location = $_REQUEST['multi_location'];
                        if(isset($_REQUEST['multi_location']) && empty($location)){
                            $validator->set_error_message('multi_location', __("The Location field is required.", ST_TEXTDOMAIN));
                        }
                        break;
                }

                $result = $validator->run();
                return $result;
            }
            public function st_partner_hotel_room_tabs_payment($fields){
                array_push($fields, array(
                    'name' => 'payments',
                    'label' => __('6. Payments', ST_TEXTDOMAIN)
                ));

                $sc = STInput::get('sc');
                if(!empty($sc) && $sc == 'edit-room'){
                    $id = STInput::get('id');
                    if(!empty($id)){
                        array_push($fields, array(
                            'name' => 'availability',
                            'label' => __('7. Availability', ST_TEXTDOMAIN)
                        ));
                        array_push($fields, array(
                            'name' => 'ical',
                            'label' => __('8. iCal Sync', ST_TEXTDOMAIN)
                        ));
                    }
                }

                return $fields;
            }
            public function st_partner_hotel_room_content_payment($fields){

                $data_paypment = STPaymentGateways::get_payment_gateways();
                if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                    foreach ( $data_paypment as $k => $v ) {
                        $fields['payments'][] = [
                            'type' => 'select',
                            'label' => $v->get_name(),
                            'name' => 'is_meta_payment_gateway_' . $k,
                            'col' => '6',
                            'options' => array(
                                'on' => __('On', ST_TEXTDOMAIN),
                                'off' => __('Off', ST_TEXTDOMAIN),
                            ),
                            'clear' => true
                        ];
                    }
                }


                return $fields;
            }
            public function st_partner_hotel_room_facility($fields){
                $list_tax_hotel = TravelHelper::get_object_taxonomies_service('hotel_room');
                if( !empty( $list_tax_hotel ) ){
                    foreach( $list_tax_hotel as $name => $label ){
                        $list = array();
                        $terms = get_terms( $name, array(
                            'hide_empty' => false,
                        ) );
                        if(!empty($terms)){
                            foreach( $terms as $key => $val){
                                $list[$val->term_id . ',' . $val->taxonomy] = $val->name;
                            }
                        }
                        $fields[] = array(
                            'type' => 'checkbox',
                            'label' => $label,
                            'name' => 'taxonomy[]',
                            'tax_name' => $name,
                            'col' => '12',
                            'plh' => '',
                            'options' => $list,
                            'col_option' => '4',
                            'seperate' => true
                        );
                    }
                }

                $fields[] = array(
                    'type' => 'list-item',
                    'label' => __('Add a Facility', ST_TEXTDOMAIN),
                    'name' => 'add_new_facility',
                    'col' => '6',
                    'plh' => '',
                    'text_add' => __('+ Add A Facility', ST_TEXTDOMAIN),
                    'fields' => array(
                        array(
                            'type' => 'text',
                            'label' => __('Title', ST_TEXTDOMAIN),
                            'name' => 'add_new_facility_title'
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Value', ST_TEXTDOMAIN),
                            'name' => 'add_new_facility_value',
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Icon', ST_TEXTDOMAIN),
                            'name' => 'add_new_facility_icon',
                            'plh' => __('(eg. fa-facebook)', ST_TEXTDOMAIN)
                        ),
                    )
                );

                $fields[] = array(
                    'type' => 'textarea',
                    'label' => __('Description', ST_TEXTDOMAIN),
                    'name' => __('room_description', ST_TEXTDOMAIN),
                    'col' => '12',
                    'rows' => 6
                );

                return $fields;
            }
            public function __stPartnerCreateService(){
                $step = STInput::post('step', 1);
                $step_name = STInput::post('step_name', 'basic_info');
                switch ($step_name){
                    case 'basic_info':
                        $valid = $this->stHotelValidate(1);
                        if($valid){
                            if (!empty($_REQUEST['btn_insert_post_type_hotel']) && empty(STInput::request('post_id'))) {
                                if (st()->get_option('partner_post_by_admin', 'on') == 'on') {
                                    $post_status = 'draft';
                                } else {
                                    $post_status = 'publish';
                                }
                                if (current_user_can('manage_options')) {
                                    $post_status = 'publish';
                                }
                                if (STInput::request('save_and_preview') == "true") {
                                    $post_status = 'draft';
                                }

                                $current_user = wp_get_current_user();

                                $my_post = [
                                    'post_title' => STInput::request('st_title', 'Title'),
                                    'post_content' => '',
                                    'post_status' => $post_status,
                                    'post_author' => $current_user->ID,
                                    'post_type' => 'st_hotel',
                                    'post_excerpt' => ''
                                ];
                                $post_id = wp_insert_post($my_post);
                            }else{
                                $post_id = STInput::request('post_id');
                            }

                            if (!empty($post_id)) {
                                $my_post = [
                                    'ID' => $post_id,
                                    'post_title' => STInput::request('st_title'),
                                    'post_content' => STInput::request('st_content'),
                                    'post_excerpt' => stripslashes(STInput::request('st_desc')),
                                ];

                                if (st()->get_option('partner_post_by_admin', 'on') == 'off') {
                                    $my_post['post_status'] = 'publish';
                                }

                                $admin_packages = STAdminPackages::get_inst();
                                $set_status_publish = $admin_packages->count_item_can_public_status(get_current_user_id(), $post_id);
                                if ($admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ($set_status_publish !== 'unlimited' && $set_status_publish <= 0)) {
                                    $my_post['post_status'] = 'draft';
                                }

                                wp_update_post($my_post);

                                update_post_meta($post_id, 'hotel_star', STInput::request('hotel_star'));

                                $logo = (int)STInput::request('id_logo', '');
                                update_post_meta($post_id, 'logo', wp_get_attachment_image_url($logo, 'full'));
                                update_post_meta($post_id, 'id_logo', $logo);

                                update_post_meta($post_id, 'email', STInput::request('email'));
                                update_post_meta($post_id, 'website', STInput::request('website'));
                                update_post_meta($post_id, 'phone', STInput::request('phone'));
                                update_post_meta($post_id, 'fax', STInput::request('fax'));;
                                update_post_meta($post_id, 'show_agent_contact_info', STInput::request('show_agent_contact_info'));
                                update_post_meta($post_id, 'video', STInput::request('video'));

                                update_post_meta($post_id, 'st_custom_layout', '');

                                update_post_meta($post_id, 'hotel_booking_period', (int)STInput::request('hotel_booking_period'));
                                update_post_meta($post_id, 'min_book_room', (int)STInput::request('min_book_room'));

                                update_post_meta($post_id, 'is_auto_caculate', STInput::request('is_auto_caculate'));
                                update_post_meta($post_id, 'price_avg', STInput::request('price_avg'));
                                update_post_meta($post_id, 'min_price', STInput::request('min_price'));
                                update_post_meta($post_id, 'total_sale_number', '1');
                                update_post_meta($post_id, 'rate_review', '1');
                            }
                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 2,
                                'post_id' => $post_id,
                                'next_step_name' => $step_name
                            ));
                            die;
                        }else{
                            $err_field = array('st_title', 'st_content', 'hotel_star', 'st_desc', 'id_logo', 'email', 'phone', 'hotel_booking_period');
                            if(!empty(STInput::post('website', ''))) {
                                array_push($err_field, 'website');
                            }
                            if(!empty(STInput::post('video', ''))) {
                                array_push($err_field, 'video');
                            }
                            $err = $this->stSetErrorMessage($err_field);
                            echo json_encode(array(
                                'status' => false,
                                'err' => $err
                            ));
                            die;
                        }
                        break;
                    case 'facility':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            /////////////////////////////////////
                            /// Update taxonomy
                            /////////////////////////////////////
                            if (!empty($_REQUEST['taxonomy'])) {
                                if (!empty($_REQUEST['taxonomy'])) {
                                    $taxonomy = STInput::request('taxonomy');
                                    if (!empty($taxonomy)) {
                                        $tax = [];
                                        foreach ($taxonomy as $item) {
                                            $tmp = explode(",", $item);
                                            $tax[$tmp[1]][] = $tmp[0];
                                        }
                                        foreach ($tax as $key2 => $val2) {
                                            wp_set_post_terms($post_id, $val2, $key2);
                                        }
                                    }
                                }
                            }

                            update_post_meta($post_id, 'allow_full_day', STInput::request('allow_full_day', 'off'));
                            update_post_meta($post_id, 'check_in_time', STInput::request('check_in_time', ''));
                            update_post_meta($post_id, 'check_out_time', STInput::request('check_out_time', ''));

                            echo json_encode(array(
                                'status' => true,
                                'next_step' => 3,
                                'post_id' => $post_id,
                                'next_step_name' => $step_name
                            ));
                            die;
                        }
                        break;
                    case 'photos':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)){
                            $valid = $this->stHotelValidate(3);
                            if($valid) {
                                $gallery = STInput::request('id_gallery', '');
                                update_post_meta($post_id, 'gallery', $gallery);

                                $thumbnail = (int)STInput::request('id_featured_image', '');
                                set_post_thumbnail($post_id, $thumbnail);
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 4,
                                    'post_id' => $post_id,
                                    'next_step_name' => $step_name
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('id_featured_image', 'id_gallery'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'locations':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            $valid = $this->stHotelValidate(4);
                            if($valid) {
                                if (isset($_REQUEST['multi_location'])) {
                                    $location = $_REQUEST['multi_location'];
                                    if (is_array($location) && count($location)) {
                                        $location_str = '';
                                        foreach ($location as $item) {
                                            if (empty($location_str)) {
                                                $location_str .= $item;
                                            } else {
                                                $location_str .= ',' . $item;
                                            }
                                        }
                                    } else {
                                        $location_str = '';
                                    }
                                    update_post_meta($post_id, 'multi_location', $location_str);
                                    update_post_meta($post_id, 'id_location', '');
                                }

                                update_post_meta($post_id, 'address', STInput::request('address'));

                                $gmap = STInput::request('gmap');
                                update_post_meta($post_id, 'map_lat', $gmap['lat']);
                                update_post_meta($post_id, 'map_lng', $gmap['lng']);
                                update_post_meta($post_id, 'map_zoom', $gmap['zoom']);
                                update_post_meta($post_id, 'map_type', $gmap['type']);

                                update_post_meta($post_id, 'st_google_map', $gmap);

                                update_post_meta($post_id, 'enable_street_views_google_map', STInput::request('enable_street_views_google_map'));

                                $properties = STInput::post( 'property-item', '' );
                                if ( !empty( $properties ) ) {
                                    $list = [];
                                    for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                        if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                            $list[] = [
                                                'title'          => $properties[ 'title' ][ $i ],
                                                'featured_image' => $properties[ 'featured_image' ][ $i ],
                                                'description'    => $properties[ 'description' ][ $i ],
                                                'icon'           => $properties[ 'icon' ][ $i ],
                                                'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                                'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                            ];
                                        }

                                    }
                                    update_post_meta( $post_id, 'properties_near_by', $list );
                                }

                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 5,
                                    'post_id' => $post_id,
                                    'next_step_name' => $step_name
                                ));
                                die;
                            }else{
                                $err = $this->stSetErrorMessage(array('address', 'multi_location'));
                                echo json_encode(array(
                                    'status' => false,
                                    'err' => $err
                                ));
                                die;
                            }
                        }
                        break;
                    case 'policy':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            if (!empty($_REQUEST['policy_title']) and !empty($_REQUEST['policy_description'])) {
                                $policy_title = $_REQUEST['policy_title'];
                                $policy_description = $_REQUEST['policy_description'];
                                $array_policy = [];
                                if (is_array($policy_title)) {
                                    foreach ($policy_title as $key => $value) {
                                        if(!empty($value) || !empty($policy_description[$key])) {
                                            $array_policy[$key] = [
                                                'title' => $value,
                                                'policy_description' => stripslashes($policy_description[$key])
                                            ];
                                        }
                                    }
                                }
                                update_post_meta($post_id, 'hotel_policy', $array_policy);
                            }

                            if($step != 'final'){
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 6,
                                    'post_id' => $post_id,
                                    'next_step_name' => $step_name
                                ));
                                die;
                            }else {
                                $class_hotel = new STAdminHotel();
                                $class_hotel->_update_avg_price( $post_id );
                                $this->getSuccessEditService('edit-hotel', $post_id);
                            }
                        }
                        break;
                    case 'inventory':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            if($step != 'final'){
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 7,
                                    'post_id' => $post_id,
                                    'next_step_name' => $step_name
                                ));
                                die;
                            }else{
                                $class_hotel = new STAdminHotel();
                                $class_hotel->_update_avg_price( $post_id );
                                $this->getSuccessEditService('edit-hotel', $post_id);
                            }
                        }
                        break;
                    case 'custom_fields':
                        $post_id = STInput::post('post_id');
                        if(!empty($post_id)) {
                            /////////////////////////////////////
                            /// Update Custom Field
                            /////////////////////////////////////
                            $custom_field = st()->get_option( 'hotel_unlimited_custom_field' );
                            if ( !empty( $custom_field ) ) {
                                foreach ( $custom_field as $k => $v ) {
                                    $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                    update_post_meta( $post_id, $key, STInput::request( $key ) );
                                }
                            }
                            if($step != 'final'){
                                echo json_encode(array(
                                    'status' => true,
                                    'next_step' => 8,
                                    'post_id' => $post_id,
                                    'next_step_name' => $step_name
                                ));
                                die;
                            }else{
                                $class_hotel = new STAdminHotel();
                                $class_hotel->_update_avg_price( $post_id );
                                $this->getSuccessEditService('edit-hotel', $post_id);
                            }
                        }
                        break;

                }
            }
            private function stSetErrorMessage($arr){
                $validator = self::$validator;
                $err = array();
                if(!empty($arr)){
                    foreach ($arr as $v){
                        if(!empty($validator->error($v))){
                            $err[$v] = $validator->error($v);
                        }
                    }
                }

                return $err;
            }
            private function stHotelValidate($step = 1){
                $validator = self::$validator;
                switch ($step){
                    case 1:
                        $validator->set_rules('st_title', __("Title", ST_TEXTDOMAIN), 'required|min_length[6]|max_length[100]');
                        $validator->set_rules('st_content', __("Content", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('hotel_star', __("Hotel Star", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('st_desc', __("Short Intro", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('id_logo', __("Logo", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('email', __("Email", ST_TEXTDOMAIN), 'required|valid_email');
                        $validator->set_rules('phone', __("Phone", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('hotel_booking_period', __("Book before number of day", ST_TEXTDOMAIN), 'required|unsigned_integer');
                        if(!empty(STInput::post('website', ''))) {
                            $validator->set_rules('website', __("Website", ST_TEXTDOMAIN), 'valid_url');
                        }
                        if(!empty(STInput::post('video', ''))) {
                            $validator->set_rules('video', __("Video", ST_TEXTDOMAIN), 'valid_url');
                        }
                        break;
                    case 3:
                        $validator->set_rules('id_featured_image', __("Featured image", ST_TEXTDOMAIN), 'required');
                        $validator->set_rules('id_gallery', __("Gallery", ST_TEXTDOMAIN), 'required');
                        break;
                    case 4:
                        $validator->set_rules('address', __("Address", ST_TEXTDOMAIN), 'required');
                        $location = $_REQUEST['multi_location'];
                        if(isset($_REQUEST['multi_location']) && empty($location)){
                            $validator->set_error_message('multi_location', __("The Location field is required.", ST_TEXTDOMAIN));
                        }
                        break;
                }

                $result = $validator->run();
                return $result;
            }
            function st_partner_hotel_facility($fields){
                $list_tax_hotel = TravelHelper::get_object_taxonomies_service('st_hotel');
                if( !empty( $list_tax_hotel ) ){
                    foreach( $list_tax_hotel as $name => $label ){
                        $list = array();
                        $terms = get_terms( $name, array(
                            'hide_empty' => false,
                        ) );
                        if(!empty($terms)){
                            foreach( $terms as $key => $val){
                                $list[$val->term_id . ',' . $val->taxonomy] = $val->name;
                            }
                        }
                        $fields[] = array(
                            'type' => 'checkbox',
                            'label' => $label,
                            'name' => 'taxonomy[]',
                            'tax_name' => $name,
                            'col' => '12',
                            'plh' => '',
                            'options' => $list,
                            'col_option' => '4',
                            'seperate' => true
                        );
                    }
                }

                $fields[] = array(
                    'type' => 'timepicker',
                    'label' => __('Check in time', ST_TEXTDOMAIN),
                    'name' => 'check_in_time',
                    'col' => '4',
                    'required' => false,
                );

                $fields[] = array(
                    'type' => 'timepicker',
                    'label' => __('Check out time', ST_TEXTDOMAIN),
                    'name' => 'check_out_time',
                    'col' => '4',
                    'required' => false,
                );

                $fields[] = array(
                    'type' => 'select',
                    'label' => __('Booking full day', ST_TEXTDOMAIN),
                    'name' => 'allow_full_day',
                    'col' => '4',
                    'plh' => '',
                    'options' => array(
                        'on' => __('On', ST_TEXTDOMAIN),
                        'off' => __('Off', ST_TEXTDOMAIN)
                    ),
                    'required' => false
                );

                return $fields;
            }

            public function _st_partner_approve_booking()
            {
                $post_id  = STInput::post( 'post_id', '' );
                $order_id = STInput::post( 'order_id', '' );
                if ( $order_id != '' && $post_id != '' ) {
                    $data_order = self::get_history_bookings_by_id( $post_id );
                    if ( !empty( $data_order ) ) {
                        $status = 'pending';
                        if ( $data_order->type == "normal_booking" ) {
                            $status = get_post_meta( $order_id, 'status', true );
                        } else {
                            $status = $data_order->status;
                        }

                        if ( $status == 'incomplete' ) {
                            $res = update_post_meta( $order_id, 'status', 'complete' );

                            if ( TravelHelper::checkTableDuplicate( 'st_tours' ) ) {
                                global $wpdb;

                                $table = $wpdb->prefix . 'st_order_item_meta';
                                $data  = [
                                    'status' => 'complete',
                                ];
                                $where = [
                                    'order_item_id' => $order_id
                                ];
                                $wpdb->update( $table, $data, $where );
                            }

                            STCart::send_mail_after_booking( $order_id, true, true );

                            $data_status = self::_get_order_statuses();
                            if ( $res ) {
                                echo json_encode(
                                    [
                                        'status'  => true,
                                        'message' => $data_status[ 'complete' ]
                                    ]
                                );
                                die;
                            } else {
                                echo json_encode(
                                    [
                                        'status'  => false,
                                        'message' => __( 'error', ST_TEXTDOMAIN )
                                    ]
                                );
                                die;
                            }
                        }
                    } else {
                        echo json_encode(
                            [
                                'status'  => false,
                                'message' => __( 'Not found', ST_TEXTDOMAIN )
                            ]
                        );
                        die;
                    }
                }
            }

            function _st_sendmail_expire_customer()
            {
                $order = STInput::post( 'order', '' );
                if ( !empty( $order ) ) {
                    foreach ( $order as $k => $v ) {
                        $this->_send_partner_notice_departure_date( $v );
                        self::_update_booking_history_log_mail( $v );
                    }
                    $return = [
                        'status'  => true,
                        'message' => __( 'Send notification departure date to customer successful!', ST_TEXTDOMAIN )
                    ];
                } else {
                    $return = [
                        'status'  => false,
                        'message' => __( 'Please select least 1 item', ST_TEXTDOMAIN )
                    ];
                }
                echo json_encode( $return );
                die;
            }

            public function _send_partner_notice_departure_date( $order_id )
            {
                global $st_order_id;
                $st_order_id = $order_id;

                if ( $order_id ) {
                    $message  = st()->load_template( 'email/header' );
                    $email_to = st()->get_option( 'email_for_customer_out_of_depature_date', '' );
                    $message  .= TravelHelper::_get_template_email( $message, $email_to );
                    $message  .= st()->load_template( 'email/footer' );

                    $data     = STUser_f::get_history_bookings_by_id( $st_order_id );
                    $post_id  = $data->wc_order_id;
                    $email_to = get_post_meta( $post_id, 'st_email', true );

                    $subject = __( 'Notification about departure date of service', ST_TEXTDOMAIN );
                    $check   = self::_send_mail( $email_to, $subject, $message );
                }

                unset( $st_order_id );

                return $check;
            }

            /**
             * Get Data Booking
             */
            function _st_get_info_booking_history()
            {
                $order_id   = STInput::request( 'order_id' );
                $service_id = STInput::request( 'service_id' );
                $res        = [ 'status' => 0, 'msg' => "" ];

                $my_user      = wp_get_current_user();
                $user_partner = 0;
                $user_book    = 0;
                global $wpdb;
                $sql        = "SELECT * FROM {$wpdb->prefix}st_order_item_meta WHERE order_item_id = " . $order_id . " or wc_order_id = " . $order_id;
                $rs         = $wpdb->get_row( $sql, ARRAY_A );
                $order_data = $rs;
                if ( !empty( $rs[ 'id' ] ) ) {
                    $user_book = $rs[ 'user_id' ];
                }
                if ( !empty( $rs[ 'partner_id' ] ) ) {
                    $user_partner = $rs[ 'partner_id' ];
                }
                $is_checked = true;
                if ( !is_user_logged_in() ) {
                    $is_checked = false;
                }
                if ( $user_book != $my_user->ID ) {
                    $is_checked = false;
                }
                if ( $user_partner == $my_user->ID ) {
                    $is_checked = true;
                }
                if ( current_user_can( 'manage_options' ) ) {
                    $is_checked = true;
                }
                if ( $is_checked and !empty( $rs ) ) {
                    $html      = '';
                    $post_type = $rs[ 'st_booking_post_type' ];
                    $order_id  = $rs[ 'wc_order_id' ];
                    if ( $order_data[ 'type' ] == "normal_booking" ) {
                        $html = st()->load_template( 'user/detail-booking-history/' . $post_type, false, [ 'order_id' => $order_id, 'service_id' => $service_id, 'order_data' => $order_data ] );
                    } else {
                        $html = st()->load_template( 'user/detail-booking-history/woo/' . $post_type, false, [ 'order_id' => $order_id, 'service_id' => $service_id, 'order_data' => $order_data ] );
                    }
                    $res[ 'status' ] = 1;
                    $res[ 'html' ]   = $html;
                } else {
                    $res[ 'msg' ] = '<p class="text-center">' . esc_html__( "Load failed...", ST_TEXTDOMAIN ) . '</p>';
                }
                echo json_encode( $res );
                die();
            }

            /**
             *   Upload media partner
             * @since 1.3.1
             **/
            public function _enuque_media_partner()
            {
                add_action( 'wp_enqueue_scripts', [ $this, '_enqueue_scripts' ] );
                add_filter( 'ajax_query_attachments_args', [ $this, '_filter_media' ] );
            }

            public function _enqueue_scripts()
            {
                if ( is_page_template( 'template-user.php' ) ) {
                    wp_enqueue_media();
                    wp_register_script( 'user_upload.js', get_template_directory_uri() . '/js/user-upload.js', [ 'jquery' ], null, true );
                }
            }

            public function _filter_media( $query )
            {
                if ( !current_user_can( 'manage_options' ) )
                    $query[ 'author' ] = get_current_user_id();

                return $query;
            }

            static function session_init()
            {
                if ( session_id() == false ) {
                    session_start();
                }
            }

            public function reset_password()
            {
                if ( STInput::post( 'action', '' ) == 'reset_password' &&
                    wp_verify_nonce( $_POST[ 'security_field' ], 'security' )
                ) {
                    $email = esc_html( STInput::post( 'email', '' ) );
                    if ( empty( $email ) || !email_exists( $email ) ) {
                        STTemplate::set_message( __( 'Your email is invalid', ST_TEXTDOMAIN ), 'danger' );

                        return false;
                    }
                    $user = get_user_by( 'email', $email );
                    if ( !$user ) {
                        STTemplate::set_message( __( 'You account is not exists. Please re-check your information.', ST_TEXTDOMAIN ), 'danger' );

                        return false;
                    }
                    $random_password = wp_generate_password( 12, false );
                    $update_user     = wp_update_user( [
                            'ID'        => $user->ID,
                            'user_pass' => $random_password
                        ]
                    );
                    if ( $update_user ) {
                        $to      = $email;
                        $subject = 'Your new password';
                        $sender  = get_option( 'name' );

                        $message = 'Your new password is: ' . $random_password;

                        $headers[] = 'MIME-Version: 1.0' . "\r\n";
                        $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers[] = "X-Mailer: PHP \r\n";
                        $headers[] = 'From: ' . $sender . ' < ' . $email . '>' . "\r\n";

                        $mail = @wp_mail( $to, $subject, $message, $headers );
                        if ( $mail ) {
                            STTemplate::set_message( __( 'Check your email address for your new password.', ST_TEXTDOMAIN ), 'success' );

                            return true;
                        } else {
                            STTemplate::set_message( __( 'Oops something went wrong updaing your account.', ST_TEXTDOMAIN ), 'danger' );

                            return false;
                        }
                    } else {
                        STTemplate::set_message( __( 'Oops something went wrong updaing your account.', ST_TEXTDOMAIN ), 'danger' );

                        return false;
                    }
                }
            }

            public function add_where_join_refund()
            {
                add_filter( 'posts_where', [ $this, 'where_refund' ] );
                add_filter( 'posts_join', [ $this, 'join_refund' ] );
                add_filter( 'posts_fields', [ $this, 'field_refund' ] );
            }

            public function remove_where_join_refund()
            {
                remove_filter( 'posts_where', [ $this, 'where_refund' ] );
                remove_filter( 'posts_join', [ $this, 'join_refund' ] );
                remove_filter( 'posts_fields', [ $this, 'field_refund' ] );
            }

            public function where_refund( $where )
            {
                $where .= " AND od.`status` = 'canceled'
            AND CAST(od.cancel_refund AS UNSIGNED)
            AND od.cancel_refund_status = 'pending'";

                return $where;
            }

            public function join_refund( $join )
            {
                global $wpdb;
                $join .= " INNER JOIN {$wpdb->prefix}st_order_item_meta AS od ON od.order_item_id = {$wpdb->prefix}posts.ID";

                return $join;
            }

            public function field_refund( $fields )
            {
                $fields = " od.* ";

                return $fields;
            }

            public function st_check_complete_refund()
            {
                global $cancel_order_id, $cancel_cancel_data;

                $order_id      = STInput::request( 'order_id', '' );
                $order_encrypt = STInput::request( 'order_encrypt' );

                $item_id        = (int)get_post_meta( $order_id, 'st_booking_id', true );
                $post_type      = get_post_meta( $order_id, 'st_booking_post_type', true );
                $post_author_id = get_post_field( 'post_author', $item_id );
                if ( $post_type == 'st_hotel' ) {
                    $room_id        = (int)get_post_meta( $order_id, 'room_id', true );
                    $post_author_id = get_post_field( 'post_author', $room_id );
                }

                $author_obj = get_userdata( $post_author_id );
                $user_email = $author_obj->data->user_email;
                $user_role  = array_shift( $author_obj->roles );

                if ( TravelHelper::st_compare_encrypt( $order_id, $order_encrypt ) ) {
                    $cancel_data                 = get_post_meta( $order_id, 'cancel_data', true );
                    $enable_email_cancel_success = st()->get_option( 'enable_email_cancel_success', 'on' );
                    $enable_partner_email_cancel = st()->get_option( 'enable_partner_email_cancel', 'on' );


                    if ( $cancel_data ) {
                        $cancel_data[ 'cancel_refund_status' ] = 'complete';
                        update_post_meta( $order_id, 'cancel_data', $cancel_data );

                        global $wpdb;

                        $query = "UPDATE {$wpdb->prefix}st_order_item_meta set cancel_refund_status='complete' where order_item_id={$order_id}";

                        $wpdb->query( $query );

                        $message = st()->load_template( 'user/cancel-booking/cancel', 'success-refund', [ 'cancel_data' => $cancel_data ] );


                        $cancel_order_id    = $order_id;
                        $cancel_cancel_data = $cancel_data;

                        if ( $enable_email_cancel_success == 'on' ) {
                            $this->_send_email_refund( $order_id, 'success' );
                        }
                        if ( $enable_partner_email_cancel == 'on' ) {
                            if ( $user_role == 'partner' ) {
                                $this->_send_email_refund_for_partner( $order_id, $user_email, 'success' );
                            }
                        }


                        echo json_encode( [
                            'status'  => 1,
                            'message' => $message
                        ] );
                        die;

                    }
                }
                echo json_encode( [
                    'status'  => 1,
                    'message' => '<div class="text-danger">' . __( 'Have an error when get data. Try again!', ST_TEXTDOMAIN ) . '</div>',
                ] );
                die;
            }

            public function st_get_refund_infomation()
            {
                $order_id      = STInput::request( 'order_id', '' );
                $order_encrypt = STInput::request( 'order_encrypt' );
                if ( TravelHelper::st_compare_encrypt( $order_id, $order_encrypt ) ) {
                    $cancel_data = get_post_meta( $order_id, 'cancel_data', true );
                    if ( $cancel_data ) {
                        $message = st()->load_template( 'user/cancel-booking/cancel', 'with-refund', [ 'cancel_data' => $cancel_data ] );
                        echo json_encode( [
                            'status'        => 1,
                            'message'       => $message,
                            'step'          => 'st_check_complete_refund',
                            'order_id'      => $order_id,
                            'order_encrypt' => $order_encrypt
                        ] );
                        die;
                    }
                }
                echo json_encode( [
                    'status'        => 0,
                    'message'       => '<div class="text-danger">' . __( 'Have an error when get data. Try again!', ST_TEXTDOMAIN ) . '</div>',
                    'step'          => '',
                    'order_id'      => $order_id,
                    'order_encrypt' => $order_encrypt
                ] );
                die;
            }

            public function st_get_cancel_booking_step_1()
            {
                $order_id      = STInput::request( 'order_id', '' );
                $order_encrypt = STInput::request( 'order_encrypt' );
                if ( TravelHelper::st_compare_encrypt( $order_id, $order_encrypt ) ) {
                    $message = st()->load_template( 'user/cancel-booking/cancel', 'step-1', [ 'order_id' => $order_id ] );

                    $_SESSION[ 'cancel_data' ][ 'order_id' ]      = $order_id;
                    $_SESSION[ 'cancel_data' ][ 'order_encrypt' ] = $order_encrypt;
                    $status                                       = get_post_meta( $order_id, 'status', true );

                    $step = 'next-to-step-2';
                    if ( $status != 'complete' ) {
                        $step = 'next-to-step-3';
                    }

                    echo json_encode( [
                        'status'        => 1,
                        'message'       => $message,
                        'order_id'      => $order_id,
                        'order_encrypt' => $order_encrypt,
                        'step'          => $step
                    ] );
                    die;
                }

                echo json_encode( [
                    'status'        => 0,
                    'message'       => '<div class="text-danger">' . __( 'Have an error when get data. Try again!', ST_TEXTDOMAIN ) . '</div>',
                    'order_id'      => $order_id,
                    'order_encrypt' => $order_encrypt,
                    'step'          => ''
                ] );
                die;
            }

            public function st_get_cancel_booking_step_2()
            {
                $order_id      = STInput::request( 'order_id', '' );
                $order_encrypt = STInput::request( 'order_encrypt' );
                $why_cancel    = STInput::request( 'why_cancel', '' );
                $detail        = STInput::request( 'detail', '' );

                if ( TravelHelper::st_compare_encrypt( $order_id, $order_encrypt ) ) {
                    $message = st()->load_template( 'user/cancel-booking/cancel', 'step-2', [ 'order_id' => $order_id ] );

                    $_SESSION[ 'cancel_data' ][ 'why_cancel' ] = $why_cancel;
                    $_SESSION[ 'cancel_data' ][ 'detail' ]     = $detail;

                    echo json_encode( [
                        'status'        => 1,
                        'message'       => $message,
                        'order_id'      => $order_id,
                        'order_encrypt' => $order_encrypt,
                        'step'          => 'next-to-step-3'
                    ] );
                    die;
                }

                echo json_encode( [
                    'status'        => 0,
                    'message'       => '<div class="text-danger">' . __( 'Have an error when get data. Try again!', ST_TEXTDOMAIN ) . '</div>',
                    'order_id'      => $order_id,
                    'order_encrypt' => $order_encrypt,
                    'step'          => ''

                ] );
                die;
            }

            public function st_get_cancel_booking_step_3()
            {
                global $wpdb;
                global $cancel_order_id, $cancel_cancel_data;

                $order_id      = STInput::request( 'order_id', '' );
                $order_encrypt = STInput::request( 'order_encrypt' );

                if ( TravelHelper::st_compare_encrypt( $order_id, $order_encrypt ) ) {
                    $item_id        = (int)get_post_meta( $order_id, 'st_booking_id', true );
                    $post_type      = get_post_meta( $order_id, 'st_booking_post_type', true );
                    $post_author_id = get_post_field( 'post_author', $item_id );
                    if ( $post_type == 'st_hotel' ) {
                        $room_id        = (int)get_post_meta( $order_id, 'room_id', true );
                        $post_author_id = get_post_field( 'post_author', $room_id );
                    }

                    $author_obj = get_userdata( $post_author_id );
                    $user_email = $author_obj->data->user_email;
                    $user_role  = array_shift( $author_obj->roles );

                    $total_price = (float)get_post_meta( $order_id, 'total_price', true );
                    $currency    = STUser_f::_get_currency_book_history( $order_id );

                    $percent = (int)get_post_meta( $item_id, 'st_cancel_percent', true );
                    if ( $post_type == 'st_hotel' && isset( $room_id ) ) {
                        $percent = (int)get_post_meta( $room_id, 'st_cancel_percent', true );
                    }

                    $refunded             = $total_price - ( $total_price * $percent / 100 );
                    $status               = get_post_meta( $order_id, 'status', true );
                    $cancel_refund_status = 'pending';

                    if ( $status != 'complete' ) {
                        $refunded             = 0;
                        $cancel_refund_status = 'complete';
                    }

                    $select_account = STInput::request( 'select_account', '' );

                    $refund_for_partner  = 'false';
                    $percent_for_partner = 'false';

                    $enable_email_cancel         = st()->get_option( 'enable_email_cancel', 'on' );
                    $enable_partner_email_cancel = st()->get_option( 'enable_partner_email_cancel', 'on' );
                    $enable_email_cancel_user    = st()->get_option( 'enable_email_cancel_success', 'on' );

                    if ( empty( $select_account ) ) {
                        $cancel_data = [
                            'order_id'             => $order_id,
                            'cancel_percent'       => $percent,
                            'refunded'             => $refunded,
                            'your_paypal'          => false,
                            'your_bank'            => false,
                            'your_stripe'          => false,
                            'your_payfast'         => false,
                            'currency'             => $currency,
                            'why_cancel'           => $_SESSION[ 'cancel_data' ][ 'why_cancel' ],
                            'detail'               => $_SESSION[ 'cancel_data' ][ 'detail' ],
                            'status_before'        => $status,
                            'cancel_refund_status' => $cancel_refund_status,
                            'refund_for_partner'   => $refund_for_partner,
                            'percent_for_partner'  => $percent_for_partner
                        ];

                        $cancel = self::_cancel_booking( $order_id );
                        if ( $cancel ) {
                            //Update number_booked
                            AvailabilityHelper::syncAvailabilityAfterCanceled( $order_id );

                            $query = "UPDATE {$wpdb->prefix}st_order_item_meta set cancel_refund='{$refunded}' , cancel_refund_status='{$cancel_refund_status}' where order_item_id={$order_id}";

                            $wpdb->query( $query );

                            update_post_meta( $order_id, 'cancel_data', $cancel_data );
                            unset( $_SESSION[ 'cancel_data' ] );

                            $message = st()->load_template( 'user/cancel-booking/success', 'none', [ 'cancel_data' => $cancel_data ] );

                            $cancel_order_id    = $order_id;
                            $cancel_cancel_data = $cancel_data;

                            if ( $status == 'incomplete' ) {
                                if ( $enable_email_cancel == 'on' ) {
                                    $this->_send_email_refund( $order_id, 'has-refund' );
                                }
                                if ( $enable_email_cancel_user == 'on' ) {
                                    $this->_send_email_refund( $order_id, 'success' );
                                }

                                if ( $enable_partner_email_cancel == 'on' ) {
                                    if ( $user_role == 'partner' ) {
                                        $this->_send_email_refund_for_partner( $order_id, $user_email, '' );
                                    }
                                }
                            }

                            echo json_encode( [
                                'status'  => 1,
                                'message' => $message,
                                'step'    => ''
                            ] );
                            die;
                        }
                    }
                    if ( $select_account == 'your_bank' ) {
                        $account_name   = STInput::request( 'account_name', '' );
                        $account_number = STInput::request( 'account_number', '' );
                        $bank_name      = STInput::request( 'bank_name', '' );
                        $swift_code     = STInput::request( 'swift_code', '' );

                        $cancel_data = [
                            'order_id'             => $order_id,
                            'cancel_percent'       => $percent,
                            'refunded'             => $refunded,
                            'your_paypal'          => false,
                            'your_bank'            => [
                                'account_name'   => $account_name,
                                'account_number' => $account_number,
                                'bank_name'      => $bank_name,
                                'swift_code'     => $swift_code
                            ],
                            'your_stripe'          => false,
                            'your_payfast'         => false,
                            'currency'             => $currency,
                            'why_cancel'           => $_SESSION[ 'cancel_data' ][ 'why_cancel' ],
                            'detail'               => $_SESSION[ 'cancel_data' ][ 'detail' ],
                            'status_before'        => $status,
                            'cancel_refund_status' => $cancel_refund_status,
                            'refund_for_partner'   => $refund_for_partner,
                            'percent_for_partner'  => $percent_for_partner
                        ];

                        $cancel = self::_cancel_booking( $order_id );
                        if ( $cancel ) {

                            $query = "UPDATE {$wpdb->prefix}st_order_item_meta set cancel_refund='{$refunded}' , cancel_refund_status='{$cancel_refund_status}' where order_item_id={$order_id}";

                            $wpdb->query( $query );

                            update_post_meta( $order_id, 'cancel_data', $cancel_data );
                            unset( $_SESSION[ 'cancel_data' ] );

                            $message = st()->load_template( 'user/cancel-booking/success', 'bank', [ 'cancel_data' => $cancel_data ] );

                            $cancel_order_id    = $order_id;
                            $cancel_cancel_data = $cancel_data;

                            if ( $enable_email_cancel == 'on' ) {
                                $this->_send_email_refund( $order_id, 'has-refund' );
                            }
                            if ( $enable_partner_email_cancel == 'on' ) {
                                if ( $user_role == 'partner' ) {
                                    $this->_send_email_refund_for_partner( $order_id, $user_email, '' );
                                }
                            }


                            echo json_encode( [
                                'status'  => 1,
                                'message' => $message,
                                'step'    => ''
                            ] );
                            die;
                        }

                    }
                    if ( $select_account == 'your_paypal' ) {

                        $paypal_email = STInput::request( 'paypal_email', '' );

                        $cancel_data = [
                            'order_id'             => $order_id,
                            'cancel_percent'       => $percent,
                            'refunded'             => $refunded,
                            'your_paypal'          => [
                                'paypal_email' => $paypal_email
                            ],
                            'your_bank'            => false,
                            'your_stripe'          => false,
                            'your_payfast'         => false,
                            'currency'             => $currency,
                            'why_cancel'           => $_SESSION[ 'cancel_data' ][ 'why_cancel' ],
                            'detail'               => $_SESSION[ 'cancel_data' ][ 'detail' ],
                            'status_before'        => $status,
                            'cancel_refund_status' => $cancel_refund_status,
                            'refund_for_partner'   => $refund_for_partner,
                            'percent_for_partner'  => $percent_for_partner
                        ];

                        $cancel = self::_cancel_booking( $order_id );
                        if ( $cancel ) {

                            $query = "UPDATE {$wpdb->prefix}st_order_item_meta set cancel_refund='{$refunded}' , cancel_refund_status='{$cancel_refund_status}' where order_item_id={$order_id}";

                            $wpdb->query( $query );

                            update_post_meta( $order_id, 'cancel_data', $cancel_data );
                            unset( $_SESSION[ 'cancel_data' ] );

                            $message = st()->load_template( 'user/cancel-booking/success', 'paypal', [ 'cancel_data' => $cancel_data ] );

                            $cancel_order_id    = $order_id;
                            $cancel_cancel_data = $cancel_data;

                            if ( $enable_email_cancel == 'on' ) {
                                $this->_send_email_refund( $order_id, 'has-refund' );
                            }
                            if ( $enable_partner_email_cancel == 'on' ) {
                                if ( $user_role == 'partner' ) {
                                    $this->_send_email_refund_for_partner( $order_id, $user_email, '' );
                                }
                            }


                            echo json_encode( [
                                'status'  => 1,
                                'message' => $message,
                                'step'    => ''
                            ] );
                            die;
                        }

                    }
                    if ( $select_account == 'your_stripe' ) {

                        $transaction_id = STInput::request( 'transaction_id', '' );

                        $cancel_data = [
                            'order_id'             => $order_id,
                            'cancel_percent'       => $percent,
                            'refunded'             => $refunded,
                            'your_paypal'          => false,
                            'your_bank'            => false,
                            'your_stripe'          => false,
                            'your_payfast'         => false,
                            'your_stripe'          => [
                                'transaction_id' => $transaction_id
                            ],
                            'currency'             => $currency,
                            'why_cancel'           => $_SESSION[ 'cancel_data' ][ 'why_cancel' ],
                            'detail'               => $_SESSION[ 'cancel_data' ][ 'detail' ],
                            'status_before'        => $status,
                            'cancel_refund_status' => $cancel_refund_status,
                            'refund_for_partner'   => $refund_for_partner,
                            'percent_for_partner'  => $percent_for_partner
                        ];

                        $cancel = self::_cancel_booking( $order_id );
                        if ( $cancel ) {

                            $query = "UPDATE {$wpdb->prefix}st_order_item_meta set cancel_refund='{$refunded}' , cancel_refund_status='{$cancel_refund_status}' where order_item_id={$order_id}";

                            $wpdb->query( $query );

                            update_post_meta( $order_id, 'cancel_data', $cancel_data );
                            unset( $_SESSION[ 'cancel_data' ] );

                            $message = st()->load_template( 'user/cancel-booking/success', 'stripe', [ 'cancel_data' => $cancel_data ] );

                            $cancel_order_id    = $order_id;
                            $cancel_cancel_data = $cancel_data;

                            if ( $enable_email_cancel == 'on' ) {
                                $this->_send_email_refund( $order_id, 'has-refund' );
                            }
                            if ( $enable_partner_email_cancel == 'on' ) {
                                if ( $user_role == 'partner' ) {
                                    $this->_send_email_refund_for_partner( $order_id, $user_email, '' );
                                }
                            }


                            echo json_encode( [
                                'status'  => 1,
                                'message' => $message,
                                'step'    => ''
                            ] );
                            die;
                        }

                    }
                    if ( $select_account == 'your_payfast' ) {

                        $transaction_id = STInput::request( 'transaction_id', '' );

                        $cancel_data = [
                            'order_id'             => $order_id,
                            'cancel_percent'       => $percent,
                            'refunded'             => $refunded,
                            'your_paypal'          => false,
                            'your_bank'            => false,
                            'your_stripe'          => false,
                            'your_stripe'          => false,
                            'your_payfast'         => [
                                'transaction_id' => $transaction_id
                            ],
                            'currency'             => $currency,
                            'why_cancel'           => $_SESSION[ 'cancel_data' ][ 'why_cancel' ],
                            'detail'               => $_SESSION[ 'cancel_data' ][ 'detail' ],
                            'status_before'        => $status,
                            'cancel_refund_status' => $cancel_refund_status,
                            'refund_for_partner'   => $refund_for_partner,
                            'percent_for_partner'  => $percent_for_partner
                        ];

                        $cancel = self::_cancel_booking( $order_id );
                        if ( $cancel ) {

                            $query = "UPDATE {$wpdb->prefix}st_order_item_meta set cancel_refund='{$refunded}' , cancel_refund_status='{$cancel_refund_status}' where order_item_id={$order_id}";

                            $wpdb->query( $query );

                            update_post_meta( $order_id, 'cancel_data', $cancel_data );
                            unset( $_SESSION[ 'cancel_data' ] );

                            $message = st()->load_template( 'user/cancel-booking/success', 'payfast', [ 'cancel_data' => $cancel_data ] );

                            $cancel_order_id    = $order_id;
                            $cancel_cancel_data = $cancel_data;

                            //3rd action
                            do_action( 'st_booking_cancel_order_item', $order_id );

                            if ( $enable_email_cancel == 'on' ) {
                                $this->_send_email_refund( $order_id, 'has-refund' );
                            }
                            if ( $enable_partner_email_cancel == 'on' ) {
                                if ( $user_role == 'partner' ) {
                                    $this->_send_email_refund_for_partner( $order_id, $user_email, '' );
                                }
                            }

                            echo json_encode( [
                                'status'  => 1,
                                'message' => $message,
                                'step'    => ''
                            ] );
                            die;
                        }

                    }

                }
                echo json_encode( [
                    'status'  => 1,
                    'message' => '<div class="text-danger">' . __( 'You can not cancel this booking', ST_TEXTDOMAIN ) . '</div>',
                    'step'    => ''

                ] );
                die;
            }

            public function _send_email_refund_for_partner( $order_id = '', $to, $type = false )
            {
                if ( $type = "success" ) {
                    $subject  = __( 'Cancel booking of your customer is completed.', ST_TEXTDOMAIN );
                    $template = st()->get_option( 'email_cancel_booking_success_for_partner', '' );
                    $message  = TravelHelper::_get_template_email( '', $template );
                } else {
                    $subject  = __( 'You have a request for cancel booking.', ST_TEXTDOMAIN );
                    $template = st()->get_option( 'email_has_refund_for_partner', '' );
                    $message  = TravelHelper::_get_template_email( '', $template );
                }
                $check = $this->_send_mail( $to, $subject, $message );

                return $check;
            }

            public function _send_email_refund( $order_id = '', $type = 'success' )
            {

                if ( $type == 'success' ) {
                    $to       = get_post_meta( $order_id, 'st_email', true );
                    $subject  = __( 'Your cancel booking is completed.', ST_TEXTDOMAIN );
                    $template = st()->get_option( 'email_cancel_booking_success', '' );
                    $message  = TravelHelper::_get_template_email( '', $template );

                } elseif ( $type == 'has-refund' ) {
                    $to      = st()->get_option( 'email_admin_address', '' );
                    $subject = __( 'You have a request for cancel booking.', ST_TEXTDOMAIN );

                    $template = st()->get_option( 'email_has_refund', '' );
                    $message  = TravelHelper::_get_template_email( '', $template );
                }

                $check = $this->_send_mail( $to, $subject, $message );

                return $check;
            }

            public function _send_mail( $to, $subject, $message, $attachment = false )
            {

                if ( !$message ) return [
                    'status'  => false,
                    'data'    => '',
                    'message' => __( "Email content is empty", ST_TEXTDOMAIN )
                ];
                $from         = st()->get_option( 'email_from' );
                $from_address = st()->get_option( 'email_from_address' );
                $headers      = [];

                if ( $from and $from_address ) {
                    $headers[] = 'From:' . $from . ' <' . $from_address . '>';
                }

                add_filter( 'wp_mail_content_type', [ $this, 'set_html_content_type' ] );

                $check = @wp_mail( $to, $subject, $message, $headers, $attachment );

                remove_filter( 'wp_mail_content_type', [ $this, 'set_html_content_type' ] );

                return [
                    'status' => $check,
                    'data'   => [
                        'to'      => $to,
                        'subject' => $subject,
                        'message' => $message,
                        'headers' => $headers
                    ]
                ];
            }

            public function set_html_content_type()
            {

                return 'text/html';
            }

            public static function set_control_data( $data )
            {
                $_SESSION[ 'st_control_data' ] = $data;

            }

            public static function get_control_data()
            {
                $data                          = isset( $_SESSION[ 'st_control_data' ] ) ? $_SESSION[ 'st_control_data' ] : false;
                $_SESSION[ 'st_control_data' ] = false;

                return $data;
            }

            // from 1.2.1
            function _send_email_for_user_partner()
            {
                $name         = STInput::request( 'st_name' );
                $email        = STInput::request( 'st_email' );
                $content      = STInput::request( 'st_content' );
                $user_id      = STInput::request( 'user_id' );
                $user_data    = new WP_User( $user_id );
                $to           = $user_data->user_email;
                $from         = $email;
                $subject      = $name;
                $from_address = $from;
                $headers[]    = 'From:' . $name . ' <' . $from_address . '>';
                $check        = wp_mail( $to, $subject, $content, $headers );
                if ( $check == true ) {
                    $msg = '<div class="alert alert-success">
                            <p class="text-small">' . __( "Your message was sent successfully. Thanks.", ST_TEXTDOMAIN ) . '</p>
                        </div>';
                } else {
                    $msg = '<div class="alert alert-danger">
                            <p class="text-small">' . __( "Failed to send your message.", ST_TEXTDOMAIN ) . '</p>
                        </div>';
                }
                echo json_encode( [
                    'status' => $check,
                    'msg'    => $msg,
                    'data'   => [
                        'to'      => $to,
                        'subject' => $subject,
                        'message' => $content,
                        'headers' => $headers
                    ]
                ] );
                die();
            }

            // disable admin bar only patner
            // from 1.1.9
            function st_is_partner()
            {

                if ( is_user_logged_in() ) {
                    global $current_user;

                    $user_roles = $current_user->roles;
                    $user_role  = array_shift( $user_roles );
                    $return     = '__return_false';
                    // administrtor
                    if ( $user_role == 'administrator' ) return;
                    if ( $user_role == 'partner' ) {
                        $partner_option = st()->get_option( 'admin_menu_partner', 'off' );
                        if ( $partner_option == "on" ) {
                            $return = '__return_true';
                        }
                        add_filter( 'show_admin_bar', $return, 1000 );
                        if ( STInput::post( 'action', '' ) != 'upload-attachment' ) {
                            if ( is_admin() && !st_is_ajax() ) {
                                $page = st()->get_option( 'page_my_account_dashboard' );
                                wp_redirect( get_permalink( $page ) );
                            }
                        }

                    } else {
                        $normal_user_option = st()->get_option( 'admin_menu_normal_user', 'off' );
                        if ( $normal_user_option == 'on' ) {
                            $return = '__return_true';
                        }
                        add_filter( 'show_admin_bar', $return, 1000 );
                    }
                }
            }

            function add_scripts()
            {


            }

            function check_login()
            {
                if ( is_page_template( 'template-user.php' ) ) {
                    if ( !is_user_logged_in() ) {
                        $page_login = st()->get_option( 'page_user_login' );
                        if ( !empty( $page_login ) ) {
                            $url_redirect = ( is_ssl() ? "https" : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            $location     = add_query_arg( [ 'st_url_redirect' => urlencode( $url_redirect ) ], get_permalink( $page_login ) );
                            wp_redirect( $location );
                            exit;
                        } else {
                            wp_redirect( home_url() );
                            exit;
                        }

                    }
                }
                if ( is_page_template( 'template-login.php' ) || is_page_template( 'template-login-normal.php' ) || is_page_template( 'template-register.php' ) || is_page_template( 'template-reset-pasword.php' ) ) {
                    if ( is_user_logged_in() ) {
                        wp_redirect( home_url() );
                        exit;
                    }
                }
            }

            /**
             *  Login form and regedit
             */
            function dlf_auth( $username, $password )
            {
                global $user;
                global $status_error_login;
                $creds                    = [];
                $creds[ 'user_login' ]    = $username;
                $creds[ 'user_password' ] = $password;
                $creds[ 'remember' ]      = true;
                $validate                 = false;
                $captcha_validate         = STRecaptcha::inst()->validate_captcha();
                $status_error_login       = '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                if ( empty( $username ) && empty( $password ) ) {
                    $status_error_login .= esc_html__( 'Username and password not empty', ST_TEXTDOMAIN );
                } elseif ( $captcha_validate[ 'status' ] == 0 ) {
                    $status_error_login .= $captcha_validate[ 'message' ];
                } else {
                    $validate = true;
                }
                $status_error_login .= '</div>';

                if ( $validate ) {
                    $user = wp_signon( $creds, true );
                    if ( is_wp_error( $user ) ) {
                        $status_error_login = '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';

                        $status_error_login .= $user->get_error_message();

                        $status_error_login .= ' </div>';
                    } else {
                        $page_login   = ( st()->get_option( 'page_redirect_to_after_login' ) );
                        $url_redirect = ( STInput::request( 'st_url_redirect' ) );
                        $url          = ( STInput::request( 'url' ) );
                        $need_link    = home_url();
                        if ( !empty( $page_login ) ) $need_link = get_permalink( $page_login );
                        if ( !empty( $url_redirect ) ) $need_link = urldecode( $url_redirect );
                        if ( !empty( $url ) ) $need_link = get_permalink( $url );
                        $userID = $user->ID;

                        wp_set_current_user( $userID, $user->user_email );
                        wp_set_auth_cookie( $userID, true, false );

                        wp_redirect( $need_link );
                        exit;
                    }
                }
            }


            function st_login_func()
            {
                if ( isset( $_POST[ 'dlf_submit' ] ) ) {
                    $this->dlf_auth( $_POST[ 'login_name' ], $_POST[ 'login_password' ] );
                }
            }

            static function validation()
            {
                $theme_layout = STInput::request('st_theme_style', 'classic');
                if($theme_layout == 'classic') {
                    $user_name = $_REQUEST['user_name'];
                    $password = $_REQUEST['password'];
                    $email = $_REQUEST['email'];

                    if (empty($user_name)) {
                        return new WP_Error('field', __('Required form field user name is missing', ST_TEXTDOMAIN));
                    }
                    if (empty($password)) {
                        return new WP_Error('field', __('Required form field password is missing', ST_TEXTDOMAIN));
                    }
                    if (empty($email)) {
                        return new WP_Error('field', __('Required form field email is missing', ST_TEXTDOMAIN));
                    }
                    if (strlen($user_name) < 3) {
                        return new WP_Error('username_length', __('User Name too short. At least 3 characters is required', ST_TEXTDOMAIN));
                    }
                    if (strlen($password) < 6) {
                        return new WP_Error('password', __('Password length must be greater than 6', ST_TEXTDOMAIN));
                    }
                    if (!is_email($email)) {
                        return new WP_Error('email_invalid', __('Email is not valid', ST_TEXTDOMAIN));
                    }
                    if (email_exists($email)) {
                        return new WP_Error('email', __('Email already used', ST_TEXTDOMAIN));
                    }
                    if (STInput::request('term_condition', '') == '') {
                        return new WP_Error('field', esc_html__('The terms and conditions field is required', ST_TEXTDOMAIN));
                    }

                    $captcha_validate = STRecaptcha::inst()->validate_captcha();
                    if ($captcha_validate['status'] == 0) {
                        return new WP_Error('field', $captcha_validate['message']);
                    }
                }else {
                    $user_name = $_REQUEST['username'];
                    $password = $_REQUEST['password'];
                    $email = $_REQUEST['email'];

                    if (empty($user_name)) {
                        return new WP_Error('field', __('Required form field user name is missing', ST_TEXTDOMAIN));
                    }
                    if (empty($password)) {
                        return new WP_Error('field', __('Required form field password is missing', ST_TEXTDOMAIN));
                    }
                    if (empty($email)) {
                        return new WP_Error('field', __('Required form field email is missing', ST_TEXTDOMAIN));
                    }
                    if (strlen($user_name) < 3) {
                        return new WP_Error('username_length', __('User Name too short. At least 3 characters is required', ST_TEXTDOMAIN));
                    }
                    if (strlen($password) < 6) {
                        return new WP_Error('password', __('Password length must be greater than 6', ST_TEXTDOMAIN));
                    }
                    if (!is_email($email)) {
                        return new WP_Error('email_invalid', __('Email is not valid', ST_TEXTDOMAIN));
                    }
                    if (email_exists($email)) {
                        return new WP_Error('email', __('Email already used', ST_TEXTDOMAIN));
                    }
                    if (STInput::request('term', '') != 'on') {
                        return new WP_Error('field', esc_html__('The terms and conditions field is required', ST_TEXTDOMAIN));
                    }

                    $captcha_validate = STRecaptcha::inst()->validate_captcha();
                    if ($captcha_validate['status'] == 0) {
                        return new WP_Error('field', $captcha_validate['message']);
                    }
                }
            }


            static function registration_user()
            {
                $userdata = [
                    'user_login' => esc_attr( $_REQUEST[ 'user_name' ] ),
                    'user_email' => esc_attr( $_REQUEST[ 'email' ] ),
                    'user_pass'  => esc_attr( $_REQUEST[ 'password' ] ),
                    'first_name' => esc_attr( $_REQUEST[ 'full_name' ] ),
                ];

                if ( is_wp_error( self::validation() ) ) {
                    echo '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                    echo '<strong>' . self::validation()->get_error_message() . '</strong>';
                    echo '</div>';
                } else {
                    $register_user = wp_insert_user( $userdata );
                    wp_new_user_notification( $register_user, null, 'user' );
                    if ( !is_wp_error( $register_user ) ) {
                        $class_user = new STUser_f();
                        $class_user->_update_info_user( $register_user );

                        return "true";
                    } else {
                        echo '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                        echo '<strong>' . $register_user->get_error_message() . '</strong>';
                        echo '</div>';
                    }
                }

            }

            function _update_certificates()
            {
                $post_type = STInput::request( 'post_type' );
                $id_image  = $url_image = $html_image = "";
                $erro_msg  = "";
                if ( !empty( $_FILES[ 'st_certificates_' . $post_type ] ) ) {
                    $id_image = self::upload_image_return( $_FILES[ 'st_certificates_' . $post_type ], 'st_certificates_' . $post_type, $_FILES[ 'st_certificates_' . $post_type ][ 'type' ], 1 );
                    if ( is_array( $id_image ) ) {
                        $erro_msg = $id_image[ 'msg' ];
                    } else {
                        $data = wp_get_attachment_image_src( $id_image, 'full' );
                    }
                    if ( !empty( $data[ 0 ] ) ) {
                        $url_image  = $data[ 0 ];
                        $html_image = wp_get_attachment_image( $id_image, 'full', false, [ "class" => 'thumbnail' ] );
                    }
                }

                echo json_encode(
                    [
                        'image_id'   => $id_image,
                        'image_url'  => $url_image,
                        'html_image' => $html_image,
                        'post_type'  => $post_type,
                        'erro_msg'   => $erro_msg
                    ]
                );
                die();
            }

            function _update_certificate_user()
            {

                if ( !empty( $_REQUEST[ 'btn_st_update_certificate' ] ) ) {
                    if ( wp_verify_nonce( $_REQUEST[ 'st_update_certificate' ], 'user_setting' ) ) {

                        $allowedTypes = [ IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF ];

                        global $current_user;
                        wp_get_current_user();
                        $user_id = $current_user->ID;
                        $role    = $current_user->roles;
                        $role    = array_shift( $role );

                        $data_certificates = [];
                        if ( STInput::request( "st_service_st_hotel" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_hotel_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_hotel' ] ) || empty( $_FILES[ 'st_certificates_st_hotel' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for hotel', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_hotel' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file   = self::upload_image_return( $file, 'st_certificates_st_hotel', $file[ 'type' ] );
                                    $url_image = get_post_field( 'guid', $id_file );
                                }


                            } else {
                                $url_image = $_POST[ 'st_certificates_st_hotel_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                             = get_post_type_object( 'st_hotel' );
                                $data_certificates[ "st_hotel" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_rental" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_rental_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_rental' ] ) || empty( $_FILES[ 'st_certificates_st_rental' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for rental', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_rental' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_rental', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_rental_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                              = get_post_type_object( 'st_rental' );
                                $data_certificates[ "st_rental" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_cars" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_cars_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_cars' ] ) || empty( $_FILES[ 'st_certificates_st_cars' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for cars', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_cars' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_cars', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_cars_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                            = get_post_type_object( 'st_cars' );
                                $data_certificates[ "st_cars" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_tours" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_tours_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_tours' ] ) || empty( $_FILES[ 'st_certificates_st_tours' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for tours', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_tours' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_tours', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_tours_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                             = get_post_type_object( 'st_tours' );
                                $data_certificates[ "st_tours" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_activity" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_activity_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_activity' ] ) || empty( $_FILES[ 'st_certificates_st_activity' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for activity', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_activity' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_activity', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_activity_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                                = get_post_type_object( 'st_activity' );
                                $data_certificates[ "st_activity" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }

                        if ( $role == "partner" ) {
                            update_user_meta( $user_id, 'st_pending_partner', '2' );
                        } else {
                            update_user_meta( $user_id, 'st_pending_partner', '1' );
                        }
                        if ( !empty( $data_certificates ) ) {
                            update_user_meta( $user_id, 'st_certificates', $data_certificates );
                            STUser::_resend_send_admin_update_certificate_partner( $user_id );
                        } else {
                            update_user_meta( $user_id, 'st_certificates', "" );
                        }

                        self::$msg = [
                            'status' => 'success',
                            'msg'    => 'Update successfully !'
                        ];

                        return true;
                    }
                }
            }

            static function _update_info_user( $register_user )
            {
                $theme_layout = STInput::request('st_theme_style', 'classic');
                if($theme_layout == 'classic'){
                    $html = '';
                    $register_as = STInput::request('register_as');
                    switch ($register_as) {
                        case "normal":
                            $html = '<div  class="alert alert-success"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                            $html .= "<strong>" . __('Success!.', ST_TEXTDOMAIN) . "</strong>" . __('Registration successful...', ST_TEXTDOMAIN);
                            $html .= '</div>';
                            STUser::_send_admin_new_register_user($register_user);
                            break;
                        case "partner":
                            $data_certificates = [];
                            $validate = true;

                            //Add option automatic approved
                            $auto_approve = st()->get_option('enable_automatic_approval_partner', 'off');
                            if ($auto_approve == 'on') {
                                update_user_meta($register_user, 'st_certificates', $data_certificates);
                                $user_data = new WP_User($register_user);
                                $user__permission = array_shift($user_data->roles);
                                if ($user__permission == "subscriber" or $user__permission == "" or $user__permission == "Subscriber" or $user__permission == "partner") {
                                    if (!empty($user_data->roles)) {
                                        foreach ($user_data->roles as $k => $v) {
                                            $user_data->remove_role($v);
                                        }
                                    }

                                    $user_data = new WP_User($register_user);
                                    $user_data->remove_role($user__permission);
                                    $user_data->add_role('partner');
                                    update_user_meta($register_user, 'st_pending_partner', '0');
                                    if (!get_user_meta($register_user, 'st_partner_approved_date', true)) {
                                        $date = date('Y-m-d');
                                        update_user_meta($register_user, 'st_partner_approved_date', $date);
                                    }
                                    $st_certificates = get_user_meta($register_user, 'st_certificates', true);
                                    update_user_meta($register_user, 'st_partner_service', $st_certificates);

                                    // send email
                                    STUser::_send_admin_new_register_partner($register_user);
                                    STUser::_send_approved_customer_register_partner($register_user);

                                    $html = '<div  class="alert alert-success"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                                    $html .= "<strong>" . __('Success!.', ST_TEXTDOMAIN) . "</strong>" . __('Registration successful!', ST_TEXTDOMAIN);
                                    $html .= '</div>';
                                }
                                unset($user_data);
                            } else {
                                update_user_meta($register_user, 'st_pending_partner', '1');
                                update_user_meta($register_user, 'st_certificates', $data_certificates);

                                STUser::_send_admin_new_register_partner($register_user);
                                STUser::_send_customer_register_partner($register_user);

                                $html = '<div  class="alert alert-success"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                                $html .= "<strong>" . __('Success!.', ST_TEXTDOMAIN) . "</strong>" . __('Registration successful! Please wait for administrator\'s approval', ST_TEXTDOMAIN);
                                $html .= '</div>';
                            }

                            break;
                    }
                    if ($echo)
                        echo $html;
                    else return $html;
                }else {
                    $responsive = [
                        'status' => 0,
                        'message' => ''
                    ];
                    $register_as = STInput::request('register_as');
                    switch ($register_as) {
                        case "normal":
                            STUser::_send_admin_new_register_user($register_user);
                            $responsive = [
                                'status' => 1,
                                'message' => __('Registration successful!', ST_TEXTDOMAIN),
                                'closeText' => __('Login Now', ST_TEXTDOMAIN)
                            ];
                            break;
                        case "partner":
                            $data_certificates = [];
                            $auto_approve = st()->get_option('enable_automatic_approval_partner', 'off');
                            if ($auto_approve == 'on') {
                                update_user_meta($register_user, 'st_certificates', $data_certificates);
                                $user_data = new WP_User($register_user);
                                $user__permission = array_shift($user_data->roles);
                                if ($user__permission == "subscriber" or $user__permission == "" or $user__permission == "Subscriber" or $user__permission == "partner") {
                                    if (!empty($user_data->roles)) {
                                        foreach ($user_data->roles as $k => $v) {
                                            $user_data->remove_role($v);
                                        }
                                    }

                                    $user_data = new WP_User($register_user);
                                    $user_data->remove_role($user__permission);
                                    $user_data->add_role('partner');
                                    update_user_meta($register_user, 'st_pending_partner', '0');
                                    if (!get_user_meta($register_user, 'st_partner_approved_date', true)) {
                                        $date = date('Y-m-d');
                                        update_user_meta($register_user, 'st_partner_approved_date', $date);
                                    }
                                    $st_certificates = get_user_meta($register_user, 'st_certificates', true);
                                    update_user_meta($register_user, 'st_partner_service', $st_certificates);

                                    STUser::_send_admin_new_register_partner($register_user);
                                    STUser::_send_approved_customer_register_partner($register_user);

                                    $responsive = [
                                        'status' => 1,
                                        'message' => __('Registration successful!', ST_TEXTDOMAIN),
                                        'sub_message' => '',
                                        'closeText' => __('LOGIN NOW', ST_TEXTDOMAIN)
                                    ];
                                }
                                unset($user_data);
                            } else {
                                update_user_meta($register_user, 'st_pending_partner', '1');
                                update_user_meta($register_user, 'st_certificates', $data_certificates);

                                STUser::_send_admin_new_register_partner($register_user);
                                STUser::_send_customer_register_partner($register_user);

                                $responsive = [
                                    'status' => 1,
                                    'message' => __('Partner Registration successful!', ST_TEXTDOMAIN),
                                    'sub_message' => __('Please wait for Administrator\'s approval', ST_TEXTDOMAIN),
                                    'closeText' => __('LOGIN NOW', ST_TEXTDOMAIN)
                                ];
                            }
                            break;
                    }

                    return $responsive;
                }
            }


            //ver 1.2.1
            function update_info_partner()
            {
                global $current_user;
                if ( !empty( $_REQUEST[ 'btn_update_user_partner' ] ) ) {
                    if ( wp_verify_nonce( $_REQUEST[ 'st_update_info_partner' ], 'user_setting' ) ) {

                        $id_user = $current_user->ID;
                        if ( !empty( $_FILES[ 'st_avatar' ][ 'name' ] ) ) {
                            $st_avatar = $_FILES[ 'st_avatar' ];
                            $id_avatar = self::upload_image_return( $st_avatar, 'st_avatar', $st_avatar[ 'type' ] );
                        } else {
                            $id_avatar = STInput::request( "id_avatar" );
                        }
                        if ( !empty( $_FILES[ 'st_banner_image' ][ 'name' ] ) ) {
                            $banner_image    = $_FILES[ 'st_banner_image' ];
                            $id_banner_image = self::upload_image_return( $banner_image, 'st_banner_image', $banner_image[ 'type' ] );
                        } else {
                            $id_banner_image = $_REQUEST[ 'id_banner_image' ];
                        }

                        $userdata = [
                            'ID'           => $id_user,
                            'display_name' => STInput::request( 'st_display_name' ),
                        ];
                        $user_id  = wp_update_user( $userdata );

                        update_user_meta( $id_user, 'st_avatar', $id_avatar );
                        update_user_meta( $id_user, 'st_phone', STInput::request( 'st_phone' ) );
                        update_user_meta( $id_user, 'st_address', STInput::request( 'st_address' ) );
                        update_user_meta( $id_user, 'st_contact_info', STInput::request( 'st_contact_info' ) );
                        update_user_meta( $id_user, 'st_desc', STInput::request( 'st_desc' ) );
                        update_user_meta( $id_user, 'st_banner_image', $id_banner_image );

                        $data_social_icon = [];
                        if ( !empty( $_REQUEST[ 'st_add_social_icon' ] ) ) {
                            $st_add_social_icon = STInput::request( 'st_add_social_icon' );
                            if ( !empty( $st_add_social_icon ) ) {
                                $icon = $st_add_social_icon[ 'icon' ];
                                $link = $st_add_social_icon[ 'link' ];
                                foreach ( $icon as $k => $v ) {
                                    $data_social_icon[] = [
                                        "icon" => $icon[ $k ],
                                        "link" => $link[ $k ],
                                    ];
                                }
                            }
                        }
                        update_user_meta( $id_user, 'st_social', $data_social_icon );

                        $gmap = STInput::request( 'gmap' );
                        if ( !empty( $gmap ) ) {
                            update_user_meta( $id_user, 'map_lat', $gmap[ 'lat' ] );
                            update_user_meta( $id_user, 'map_lng', $gmap[ 'lng' ] );
                            update_user_meta( $id_user, 'map_zoom', $gmap[ 'zoom' ] );
                            update_user_meta( $id_user, 'map_type', $gmap[ 'type' ] );
                        }

                        $data_certificates = [];
                        $validate          = true;
                        $allowedTypes      = [ IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF ];
                        if ( STInput::request( "st_service_st_hotel" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_hotel_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_hotel' ] ) || empty( $_FILES[ 'st_certificates_st_hotel' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for hotel', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_hotel' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file   = self::upload_image_return( $file, 'st_certificates_st_hotel', $file[ 'type' ] );
                                    $url_image = get_post_field( 'guid', $id_file );
                                }


                            } else {
                                $url_image = $_POST[ 'st_certificates_st_hotel_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                             = get_post_type_object( 'st_hotel' );
                                $data_certificates[ "st_hotel" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_rental" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_rental_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_rental' ] ) || empty( $_FILES[ 'st_certificates_st_rental' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for rental', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_rental' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_rental', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_rental_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                              = get_post_type_object( 'st_rental' );
                                $data_certificates[ "st_rental" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_cars" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_cars_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_cars' ] ) || empty( $_FILES[ 'st_certificates_st_cars' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for cars', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_cars' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_cars', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_cars_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                            = get_post_type_object( 'st_cars' );
                                $data_certificates[ "st_cars" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_tours" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_tours_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_tours' ] ) || empty( $_FILES[ 'st_certificates_st_tours' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for tours', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_tours' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_tours', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_tours_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                             = get_post_type_object( 'st_tours' );
                                $data_certificates[ "st_tours" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( STInput::request( "st_service_st_activity" ) == "on" ) {
                            if ( empty( $_POST[ 'st_certificates_st_activity_url' ] ) ) {
                                if ( !isset( $_FILES[ 'st_certificates_st_activity' ] ) || empty( $_FILES[ 'st_certificates_st_activity' ][ 'name' ] ) ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Upload a image certificate for activity', ST_TEXTDOMAIN )
                                    ];
                                    $validate  = false;
                                } else {
                                    $file         = $_FILES[ 'st_certificates_st_activity' ];
                                    $detectedType = exif_imagetype( $file[ 'tmp_name' ] );
                                    if ( !in_array( $detectedType, $allowedTypes ) ) {
                                        self::$msg = [
                                            'status' => 'danger',
                                            'msg'    => __( 'Don\'t support for this type file.', ST_TEXTDOMAIN ) . '(' . $file[ 'tmp_name' ] . ')'
                                        ];
                                        $validate  = false;
                                    }
                                    $id_file = self::upload_image_return( $file, 'st_certificates_st_activity', $file[ 'type' ] );

                                    $url_image = get_post_field( 'guid', $id_file );
                                }

                            } else {
                                $url_image = $_POST[ 'st_certificates_st_activity_url' ];
                            }
                            if ( !empty( $url_image ) ) {
                                $obj                                = get_post_type_object( 'st_activity' );
                                $data_certificates[ "st_activity" ] = [
                                    'name'  => $obj->labels->singular_name,
                                    'image' => $url_image,
                                ];
                            }
                            unset( $url_image );
                        }
                        if ( !empty( $data_certificates ) ) {
                            update_user_meta( $user_id, 'st_pending_partner', '2' );
                            update_user_meta( $user_id, 'st_certificates', $data_certificates );
                        } else {
                            update_user_meta( $user_id, 'st_pending_partner', '0' );
                            update_user_meta( $user_id, 'st_certificates', "" );
                        }
                        if ( !$validate ) {
                            return false;
                        }


                        if ( is_wp_error( $user_id ) ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            wp_redirect( add_query_arg( [ 'sc' => "update-info-partner", "status" => "danger" ], get_the_permalink( $page_my_account_dashboard ) ) );
                            exit();
                        } else {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            wp_redirect( add_query_arg( [ 'sc' => "update-info-partner", "status" => "success" ], get_the_permalink( $page_my_account_dashboard ) ) );
                            exit();
                        }

                    }
                }

            }

            /* Function update meta user */
            function update_user()
            {
                global $current_user;
                if ( !empty( $_REQUEST[ 'st_btn_update' ] ) ) {

                    if ( wp_verify_nonce( $_REQUEST[ 'st_update_user' ], 'user_setting' ) ) {
                        $id_user = $current_user->ID;
                        if ( !empty( $_FILES[ 'st_avatar' ][ 'name' ] ) ) {
                            $st_avatar = $_FILES[ 'st_avatar' ];
                            $id_avatar = self::upload_image_return( $st_avatar, 'st_avatar', $st_avatar[ 'type' ] );
                        } else {
                            $id_avatar = STInput::request( "id_avatar" );
                        }

                        update_user_meta( $id_user, 'st_avatar', $id_avatar );
                        update_user_meta( $id_user, 'st_phone', $_REQUEST[ 'st_phone' ] );
                        update_user_meta( $id_user, 'st_airport', $_REQUEST[ 'st_airport' ] );
                        update_user_meta( $id_user, 'st_address', $_REQUEST[ 'st_address' ] );
                        update_user_meta( $id_user, 'st_city', $_REQUEST[ 'st_city' ] );
                        update_user_meta( $id_user, 'st_province', $_REQUEST[ 'st_province' ] );
                        update_user_meta( $id_user, 'st_zip_code', $_REQUEST[ 'st_zip_code' ] );
                        update_user_meta( $id_user, 'st_country', $_REQUEST[ 'st_country' ] );
                        update_user_meta( $id_user, 'nickname', $_REQUEST[ 'st_name' ] );
                        update_user_meta( $id_user, 'st_paypal_email', $_REQUEST[ 'st_paypal_email' ] );
                        $is_check = '';
                        if ( !empty( $_REQUEST[ 'st_is_check_show_info' ] ) ) {
                            $is_check = 'on';
                        }
                        update_user_meta( $id_user, 'st_is_check_show_info', $is_check );
                        update_user_meta( $id_user, 'st_bio', $_REQUEST[ 'st_bio' ] );


                        $userdata = [
                            'ID'           => $id_user,
                            'display_name' => esc_attr( $_REQUEST[ 'st_name' ] ),
                            'user_email'   => $_REQUEST[ 'st_email' ],
                        ];
                        $user_id  = wp_update_user( $userdata );
                        if ( is_wp_error( $user_id ) ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            wp_redirect( add_query_arg( [ 'sc' => "setting", "status" => "danger" ], get_the_permalink( $page_my_account_dashboard ) ) );
                            exit();
                        } else {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            wp_redirect( add_query_arg( [ 'sc' => "setting", "status" => "success" ], get_the_permalink( $page_my_account_dashboard ) ) );
                            exit();
                        }

                    } else {
                        print 'Sorry, your nonce did not verify.';
                        exit;
                    }

                }
            }

            public static function get_mess_utp()
            {
                $data = self::$msg_uptp;
                if ( $data[ 'action' ] == 'up_to_partner' ) {
                    echo '<div class="alert alert-' . STUser_f::$msg_uptp[ 'status' ] . '">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">' . STUser_f::$msg_uptp[ 'msg' ] . '</p>
                </div>';
                }
            }

            function upgrade_to_partner()
            {
                global $current_user;
                if ( !empty( $_REQUEST[ 'btn_upgrade_to_partner' ] ) ) {
                    $register_user    = $current_user->ID;
                    $lever            = $current_user->roles;
                    $user__permission = array_shift( $lever );
                    $auto_approve     = st()->get_option( 'enable_automatic_approval_partner', 'off' );
                    if ( $auto_approve == 'on' ) {
                        if ( $user__permission == "subscriber" or $user__permission == "" or $user__permission == "Subscriber" or $user__permission == "partner" ) {
                            $user_data = new WP_User( $register_user );
                            if ( !empty( $user_data->roles ) ) {
                                foreach ( $user_data->roles as $k => $v ) {
                                    $user_data->remove_role( $v );
                                }
                            }
                            $user_data = new WP_User( $register_user );
                            $user_data->remove_role( $user__permission );
                            $user_data->add_role( 'partner' );
                            update_user_meta( $register_user, 'st_pending_partner', '0' );
                            if ( !get_user_meta( $register_user, 'st_partner_approved_date', true ) ) {
                                $date = date( 'Y-m-d' );
                                update_user_meta( $register_user, 'st_partner_approved_date', $date );
                            }
                            $st_certificates = get_user_meta( $register_user, 'st_certificates', true );
                            update_user_meta( $register_user, 'st_partner_service', $st_certificates );

                            // send email
                            STUser::_send_admin_new_register_partner( $register_user );
                            STUser::_send_approved_customer_register_partner( $register_user );

                            self::$msg_uptp = [
                                'action' => 'up_to_partner',
                                'status' => 'success',
                                'msg'    => "<strong>" . __( 'Success!.', ST_TEXTDOMAIN ) . "</strong>" . __( 'Registration successful!', ST_TEXTDOMAIN )
                            ];
                        }
                        unset( $user_data );
                    } else {
                        update_user_meta( $register_user, 'st_pending_partner', '1' );

                        STUser::_send_admin_new_register_partner( $register_user );
                        STUser::_send_customer_register_partner( $register_user );

                        self::$msg_uptp = [
                            'action' => 'up_to_partner',
                            'status' => 'success',
                            'msg'    => "<strong>" . __( 'Success!.', ST_TEXTDOMAIN ) . "</strong>" . __( 'Registration successful! Please wait for administrator\'s approval', ST_TEXTDOMAIN )
                        ];
                    }
                }
            }

            /* Function update meta user */
            function update_pass()
            {
                if ( !empty( $_REQUEST[ 'btn_update_pass' ] ) ) {
                    $old_pass       = $_REQUEST[ 'old_pass' ];
                    $new_pass       = $_REQUEST[ 'new_pass' ];
                    $new_pass_again = $_REQUEST[ 'new_pass_again' ];
                    $user_login     = $_REQUEST[ 'user_login' ];
                    $user           = get_user_by( 'login', $user_login );
                    if ( $user && wp_check_password( $old_pass, $user->data->user_pass, $user->ID ) ) {
                        if ( $new_pass == $new_pass_again && $new_pass != "" ) {
                            $userdata = [
                                'ID'        => $user->ID,
                                'user_pass' => $new_pass,
                            ];
                            wp_update_user( $userdata );
                            //wp_set_password( $new_pass, $user->ID );
                            self::$msg = [
                                'status' => 'success',
                                'msg'    => __( 'Change password successfully !', ST_TEXTDOMAIN )
                            ];
                        } else {
                            self::$msg = [
                                'status' => 'danger',
                                'msg'    => __( 'New password does not match!', ST_TEXTDOMAIN )
                            ];
                        }
                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => __( 'Current password incorrect!', ST_TEXTDOMAIN )
                        ];
                    }
                }
            }

            function st_add_wishlist_func()
            {
                $data_id   = $_REQUEST[ 'data_id' ];
                $data_type = $_REQUEST[ 'data_type' ];

                $current_user = wp_get_current_user();
                $data_list    = get_user_meta( $current_user->ID, 'st_wishlist', true );
                $data_list    = json_decode( $data_list );
                $date         = new DateTime();
                $date         = mysql2date( 'M d, Y', $date->format( 'Y-m-d' ) );

                $tmp_data = [];
                if ( $data_list != '' and is_array( $data_list ) ) {
                    $check = true;
                    $i     = 0;
                    foreach ( $data_list as $k => $v ) {
                        if ( $v->id == $data_id and $v->type == $data_type ) {
                            $check = false;
                        } else {
                            array_unshift( $tmp_data, $data_list[ $i ] );
                        }
                        $i++;
                    }
                    if ( $check == true ) {
                        array_unshift( $tmp_data, [
                                'id'   => $data_id,
                                'type' => $data_type,
                                'date' => $date
                            ]
                        );
                        echo json_encode( [
                            'status' => 'true',
                            'msg'    => 'ID :' . $data_id,
                            'icon'   => '<i class="fa fa-heart"></i>',
                            'title'  => st_get_language( 'remove_to_wishlist' ),
                            'added' => 'true'
                        ] );
                    } else {
                        echo json_encode( [
                            'status' => 'true',
                            'msg'    => 'ID :' . $data_id,
                            'icon'   => '<i class="fa fa-heart-o"></i>',
                            'title'  => st_get_language( 'add_to_wishlist' ),
                            'added' => 'false'
                        ] );
                    }
                    update_user_meta( $current_user->ID, 'st_wishlist', json_encode( $tmp_data ) );
                } else {
                    $user_meta = [
                        [
                            'id'   => $data_id,
                            'type' => $data_type,
                            'date' => $date
                        ],
                    ];
                    update_user_meta( $current_user->ID, 'st_wishlist', json_encode( $user_meta ) );
                    echo json_encode( [
                        'status' => 'true',
                        'msg'    => 'ID :' . $data_id,
                        'icon'   => '<i class="fa fa-heart"></i>'
                    ] );
                }
                die();
            }

            function st_remove_wishlist_func()
            {
                $data_id   = $_REQUEST[ 'data_id' ];
                $data_type = $_REQUEST[ 'data_type' ];

                $current_user = wp_get_current_user();
                $data_list    = get_user_meta( $current_user->ID, 'st_wishlist', true );
                $data_list    = json_decode( $data_list );
                $tmp_data     = [];
                if ( $data_list != '' and is_array( $data_list ) ) {
                    $i = 0;
                    foreach ( $data_list as $k => $v ) {
                        if ( $v->id == $data_id and $v->type == $data_type ) {
                        } else {
                            array_push( $tmp_data, $data_list[ $i ] );
                        }
                        $i++;
                    }
                    update_user_meta( $current_user->ID, 'st_wishlist', json_encode( $tmp_data ) );
                    echo json_encode( [
                        'status'  => 'true',
                        'msg'     => $data_id,
                        'type'    => 'success',
                        'content' => __( 'Delete successfully', ST_TEXTDOMAIN )
                    ] );
                } else {
                    echo json_encode( [
                        'status'  => 'false',
                        'msg'     => $data_id,
                        'type'    => 'danger',
                        'content' => __( 'Delete not successfully', ST_TEXTDOMAIN )
                    ] );
                }

                die();
            }

            function st_load_more_wishlist_func()
            {
                $data_per     = $_REQUEST[ 'data_per' ];
                $data_next    = $_REQUEST[ 'data_next' ];
                $data_html    = '';
                $current_user = wp_get_current_user();
                $data_list    = get_user_meta( $current_user->ID, 'st_wishlist', true );
                $i_check      = 0;
                if ( $data_list != '[]' or $data_list != '' ):
                    $data_list = json_decode( $data_list );
                    $i         = 0;
                    foreach ( $data_list as $k => $v ):
                        if ( $i >= $data_per and $i < $data_next + $data_per ):
                            $args = [
                                'post_type' => $v->type,
                                'post__in'  => [ $v->id ],
                            ];
                            query_posts( $args );
                            $data_html .= st()->load_template( 'user/loop/loop', 'wishlist', get_object_vars( $data_list[ $i ] ) );
                            $i_check++;
                            wp_reset_query();
                        endif;
                        $i++;
                    endforeach;
                endif;

                $status = 'true';
                if ( $i_check < $data_next ) {
                    $status = 'false';
                }
                echo json_encode( [
                    'status'   => $status,
                    'msg'      => $data_html,
                    'data_per' => $data_next + $data_per
                ] );
                die();
            }

            function upload_image()
            {
                if (
                    isset( $_POST[ 'my_image_upload_nonce' ], $_POST[ 'post_id' ] )
                    && wp_verify_nonce( $_POST[ 'my_image_upload_nonce' ], 'my_image_upload' )
                    && current_user_can( 'edit_post', $_POST[ 'post_id' ] )
                ) {
                    $f_type = $_FILES[ 'my_image_upload' ][ 'type' ];
                    if ( $f_type == "image/gif" OR $f_type == "image/png" OR $f_type == "image/jpeg" OR $f_type == "image/JPEG" OR $f_type == "image/PNG" OR $f_type == "image/GIF" ) {
                        // The nonce was valid and the user has the capabilities, it is safe to continue.

                        // These files need to be included as dependencies when on the front end.
                        require_once( ABSPATH . 'wp-admin/includes/image.php' );
                        require_once( ABSPATH . 'wp-admin/includes/file.php' );
                        require_once( ABSPATH . 'wp-admin/includes/media.php' );

                        // Let WordPress handle the upload.
                        // Remember, 'my_image_upload' is the name of our file input in our form above.
                        $attachment_id = media_handle_upload( 'my_image_upload', '' );

                        if ( is_wp_error( $attachment_id ) ) {
                            // There was an error uploading the image.
                        } else {
                            // The image was uploaded successfully!
                            self::$msg = [
                                'status' => 'success',
                                'msg'    => 'Uploaded successfully !'
                            ];
                        }
                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => 'Uploaded not successfully !'
                        ];
                    }
                } else {
                    // The security check failed, maybe show the user an error.
                }
            }

            function upload_image_return( $file, $flied_name, $type_file, $lever_erro = 0 )
            {
                $f_type    = $type_file;
                $size_file = $file[ "size" ];
                if ( $f_type == "image/gif" OR $f_type == "image/png" OR $f_type == "image/jpeg" OR $f_type == "image/JPEG" OR $f_type == "image/PNG" OR $f_type == "image/GIF" ) {
                    if ( $size_file < ( 1024 * 1024 * 2 ) ) {
                        // The nonce was valid and the user has the capabilities, it is safe to continue.

                        // These files need to be included as dependencies when on the front end.
                        require_once( ABSPATH . 'wp-admin/includes/image.php' );
                        require_once( ABSPATH . 'wp-admin/includes/file.php' );
                        require_once( ABSPATH . 'wp-admin/includes/media.php' );

                        // Let WordPress handle the upload.
                        // Remember, 'my_image_upload' is the name of our file input in our form above.
                        $attachment_id = media_handle_upload( $flied_name, '' );

                        if ( is_wp_error( $attachment_id ) ) {
                            return $attachment_id;
                            // There was an error uploading the image.
                        } else {
                            // The image was uploaded successfully!
                            return $attachment_id;
                        }
                    } else {
                        if ( $lever_erro > 0 ) {
                            return [ 'msg' => 'Maximum upload file size: 2 MB' ];
                        }
                    }
                } else {

                    if ( $lever_erro > 0 ) {
                        return [ 'msg' => 'This does not appear to be a image file !' ];
                    }

                }
            }

            function st_remove_post_type_func()
            {
                if ( isset( $_REQUEST[ 'data_id' ] ) && isset( $_REQUEST[ 'data_id_user' ] ) ) {
                    $data_id      = $_REQUEST[ 'data_id' ];
                    $data_id_user = $_REQUEST[ 'data_id_user' ];

                    if ( current_user_can( 'manage_options' ) ) {
                        wp_delete_post( $data_id );
                        echo json_encode( [
                            'status'  => 'true',
                            'msg'     => $data_id,
                            'type'    => 'success',
                            'content' => 'Delete successfully'
                        ] );
                    } else {
                        $data_post = get_post( $data_id );
                        if ( $data_post->post_author == $data_id_user ) {
                            wp_delete_post( $data_id );
                            echo json_encode( [
                                'status'  => 'true',
                                'msg'     => $data_id,
                                'type'    => 'success',
                                'content' => 'Delete successfully'
                            ] );
                        } else {
                            echo json_encode( [
                                'status'  => 'false',
                                'msg'     => $data_id,
                                'type'    => 'danger',
                                'content' => 'Delete not successfully'
                            ] );
                        }
                    }
                    die;
                }
            }

            static function get_list_layout()
            {
                $arg  = [
                    'post_type'   => 'st_layouts',
                    'numberposts' => -1
                ];
                $list = query_posts( $arg );
                $txt  = '<select name="st_custom_layout" class="form-control">';
                while ( have_posts() ) {
                    the_post();
                    $txt .= '<option value="' . get_the_ID() . '">' . get_the_title() . '</option>';
                }
                $txt .= ' </select>';
                wp_reset_query();

                return $txt;
            }

            static function get_list_taxonomy( $tax = 'category', $array = [] )
            {

                $args       = [
                    'hide_empty' => 0
                ];
                $taxonomies = get_terms( $tax, $args );

                $r = [];

                if ( !is_wp_error( $taxonomies ) ) {
                    foreach ( $taxonomies as $key => $value ) {
                        # code...
                        $r[ $value->term_id ] = $value->name;

                    }
                }

                return $r;
            }


            static function get_list_value_taxonomy( $post_type )
            {
                $data_value = [];

                $taxonomy = get_object_taxonomies( $post_type, 'object' );
                foreach ( $taxonomy as $key => $value ) {
                    if ( $key != 'st_category_cars' ) {
                        if ( $key != 'st_cars_pickup_features' ) {
                            if ( $key != 'cabin_type' ) {
                                if ( $key != 'room_type' ) {
                                    $args      = [
                                        'hide_empty' => 0
                                    ];
                                    $data_term = get_terms( $key, $args );
                                    if ( !empty( $data_term ) ) {
                                        foreach ( $data_term as $k => $v ) {
                                            $icon = get_tax_meta( $v->term_id, 'st_icon' );
                                            $icon = TravelHelper::handle_icon( $icon );
                                            array_push(
                                                $data_value, [
                                                    'value'    => $v->term_id,
                                                    'label'    => $v->name,
                                                    'taxonomy' => $v->taxonomy,
                                                    'icon'     => $icon
                                                ]
                                            );
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                return $data_value;
            }

            static function get_msg()
            {
                if ( !empty( STUser_f::$msg ) ) {
                    return '<div class="alert alert-' . STUser_f::$msg[ 'status' ] . '">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">' . STUser_f::$msg[ 'msg' ] . '</p>
                      </div>';
                }
                $status = STInput::request( 'create' );
                if ( !empty( $status ) and $status == 'true' ) {
                    return '<div class="alert alert-success">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">' . __( "Create successfully !", ST_TEXTDOMAIN ) . '</p>
                      </div>';
                }

                return '';
            }

            static function get_msg_html( $msg, $status )
            {
                if ( !empty( $msg ) ) {
                    $msg = str_ireplace( "<p>", "", $msg );
                    $msg = str_ireplace( "</p>", "", $msg );

                    return '<div class="alert alert-' . $status . '">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">' . $msg . '</p>
                      </div>';
                }

                return '';

            }

            static function get_status_msg()
            {
                if ( !empty( STUser_f::$msg ) ) {
                    return STUser_f::$msg[ 'status' ];
                }

                return '';
            }

            static function _update_content_meta_box( $id )
            {
                $my_post = get_post( $id );
                wp_update_post( $my_post );;
            }

            function validate_hotel()
            {

                if ( !st_check_service_available( 'st_hotel' ) ) {
                    return;
                }

                if ( !empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if ( !empty( $_FILES[ 'logo' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $logo_image            = $_FILES[ 'logo' ];
                    $id_logo_image         = self::upload_image_return( $logo_image, 'logo', $logo_image[ 'type' ] );
                    $_REQUEST[ 'id_logo' ] = $id_logo_image;
                }
                if ( !empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $gallery = $_FILES[ 'gallery' ];
                    if ( !empty( $gallery ) ) {
                        $tmp_array = [];
                        for ( $i = 0; $i < count( $gallery[ 'name' ] ); $i++ ) {
                            array_push( $tmp_array, [
                                'name'     => $gallery[ 'name' ][ $i ],
                                'type'     => $gallery[ 'type' ][ $i ],
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ],
                                'error'    => $gallery[ 'error' ][ $i ],
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach ( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery          .= self::upload_image_return( $_FILES[ 'gallery' ], 'gallery', $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery, 0, -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

                $validator = self::$validator;
                /// Location ///
                $validator->set_rules( 'st_title', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );
                $validator->set_rules( 'st_content', __( "Content", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'st_desc', __( "Description", ST_TEXTDOMAIN ), 'required' );
                $id_featured_image = STInput::request( 'id_featured_image' );
                if ( empty( $_FILES[ 'featured-image' ][ 'name' ] ) AND empty( $id_featured_image ) ) {
                    $validator->set_error_message( 'featured_image', __( "The Featured Image field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_gallery' ) ) {
                    $validator->set_error_message( 'gallery', __( "The Gallery field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'logo' ][ 'name' ] ) AND !STInput::request( 'id_logo' ) ) {
                    $validator->set_error_message( 'logo', __( "The Logo field is required.", ST_TEXTDOMAIN ) );
                }
                $validator->set_rules( 'address', __( "Address", ST_TEXTDOMAIN ), 'required|max_length[100]' );
                $validator->set_rules( 'gmap[zoom]', __( "Zoom", ST_TEXTDOMAIN ), 'required|numeric' );


                //$validator->set_rules('card_accepted[]', __("Card Accepted", ST_TEXTDOMAIN), 'required');

                $validator->set_rules( 'phone', __( "Phone", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'video', __( "Video", ST_TEXTDOMAIN ), 'valid_url' );
                $validator->set_rules( 'email', __( "Email", ST_TEXTDOMAIN ), 'required|valid_email' );
                $validator->set_rules( 'website', __( "Website", ST_TEXTDOMAIN ), 'valid_url' );
                $validator->set_rules( 'hotel_star', __( "Star Rating", ST_TEXTDOMAIN ), 'required|numeric' );

                $validator->set_rules( 'hotel_booking_period', __( "Booking Period", ST_TEXTDOMAIN ), 'required|unsigned_integer' );

                // /is_featured
                $admin_packages   = STAdminPackages::get_inst();
                $num_set_featured = $admin_packages->count_item_can_featured( get_current_user_id(), STInput::get( 'id', '' ) );
                if ( $admin_packages->enabled_membership() ) {
                    if ( $admin_packages->get_user_role() == 'partner' && ( $num_set_featured !== 'unlimited' && $num_set_featured <= 0 ) && STInput::request( 'is_featured', 'off' ) == 'on' ) {
                        STTemplate::set_message( sprintf( __( "You cannot set featured for this hotel. Your remaining item is %s (items)", ST_TEXTDOMAIN ), $num_set_featured ), 'warning' );

                        return false;
                    }
                }


                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );

                    return false;
                }

                return true;
            }

            /* Update Hotel */
            function st_update_post_type_hotel()
            {
                if ( !st_check_service_available( 'st_hotel' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_post_hotel', '' ), 'user_setting' ) ) {

                    if ( self::validate_hotel() == false ) {
                        return;
                    }

                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_hotel' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }

                        $current_user = wp_get_current_user();

                        $my_post = [
                            'post_title'   => STInput::request( 'st_title', 'Title' ),
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'st_hotel',
                            'post_excerpt' => ''
                        ];
                        $post_id = wp_insert_post( $my_post );
                    }

                    if ( !empty( $_REQUEST[ 'btn_update_post_type_hotel' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }

                    if ( !empty( $post_id ) ) {

                        $my_post = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title' ),
                            'post_content' => STInput::request( 'st_content' ),
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );
                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );
                        /////////////////////////////////////
                        /// Update featured
                        /////////////////////////////////////
                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );
                        /////////////////////////////////////
                        /// Update logo
                        /////////////////////////////////////


                        $logo = (int)STInput::request( 'id_logo', '' );
                        update_post_meta( $post_id, 'logo', $logo );


                        /////////////////////////////////////
                        /// Update gallery
                        /////////////////////////////////////
                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        /////////////////////////////////////
                        /// Update Metabox
                        /////////////////////////////////////
                        //tab hotel details
                        update_post_meta( $post_id, 'email', STInput::request( 'email' ) );
                        update_post_meta( $post_id, 'website', STInput::request( 'website' ) );
                        update_post_meta( $post_id, 'phone', STInput::request( 'phone' ) );
                        update_post_meta( $post_id, 'fax', STInput::request( 'fax' ) );;
                        update_post_meta( $post_id, 'show_agent_contact_info', STInput::request( 'show_agent_contact_info' ) );
                        update_post_meta( $post_id, 'video', STInput::request( 'video' ) );
                        update_post_meta( $post_id, 'hotel_star', STInput::request( 'hotel_star' ) );
                        update_post_meta( $post_id, 'st_custom_layout', STInput::request( 'st_custom_layout' ) );
                        update_post_meta( $post_id, 'is_featured', STInput::request( 'is_featured' ) );

                        update_post_meta( $post_id, 'card_accepted', STInput::request( 'card_accepted' ) );

                        update_post_meta( $post_id, 'allow_full_day', STInput::request( 'allow_full_day', 'off' ) );
                        update_post_meta( $post_id, 'check_in_time', STInput::request( 'check_in_time', '' ) );
                        update_post_meta( $post_id, 'check_out_time', STInput::request( 'check_out_time', '' ) );
                        //tab price
                        update_post_meta( $post_id, 'is_auto_caculate', STInput::request( 'is_auto_caculate' ) );
                        update_post_meta( $post_id, 'price_avg', STInput::request( 'price_avg' ) );
                        update_post_meta( $post_id, 'min_price', STInput::request( 'min_price' ) );
                        update_post_meta( $post_id, 'total_sale_number', '1' );
                        update_post_meta( $post_id, 'rate_review', '1' );
                        //tab location
                        if ( isset( $_REQUEST[ 'multi_location' ] ) ) {
                            $location = $_REQUEST[ 'multi_location' ];
                            if ( is_array( $location ) && count( $location ) ) {
                                $location_str = '';
                                foreach ( $location as $item ) {
                                    if ( empty( $location_str ) ) {
                                        $location_str .= $item;
                                    } else {
                                        $location_str .= ',' . $item;
                                    }
                                }
                            } else {
                                $location_str = '';
                            }
                            update_post_meta( $post_id, 'multi_location', $location_str );
                            update_post_meta( $post_id, 'id_location', '' );
                        }
                        update_post_meta( $post_id, 'address', STInput::request( 'address' ) );
                        $gmap = STInput::request( 'gmap' );
                        update_post_meta( $post_id, 'map_lat', $gmap[ 'lat' ] );
                        update_post_meta( $post_id, 'map_lng', $gmap[ 'lng' ] );
                        update_post_meta( $post_id, 'map_zoom', $gmap[ 'zoom' ] );
                        update_post_meta( $post_id, 'map_type', $gmap[ 'type' ] );

                        update_post_meta( $post_id, 'st_google_map', $gmap );
                        update_post_meta( $post_id, 'enable_street_views_google_map', STInput::request( 'enable_street_views_google_map' ) );
                        //tab other options
                        update_post_meta( $post_id, 'hotel_booking_period', (int)STInput::request( 'hotel_booking_period' ) );
                        update_post_meta( $post_id, 'min_book_room', (int)STInput::request( 'min_book_room' ) );
                        //tab discount flash

                        if ( !empty( $_REQUEST[ 'policy_title' ] ) and !empty( $_REQUEST[ 'policy_description' ] ) ) {
                            $policy_title       = $_REQUEST[ 'policy_title' ];
                            $policy_description = $_REQUEST[ 'policy_description' ];
                            $array_policy       = [];
                            if ( is_array( $policy_title ) ) {
                                foreach ( $policy_title as $key => $value ) {
                                    $array_policy[ $key ] = [
                                        'title'              => $value,
                                        'policy_description' => stripslashes( $policy_description[ $key ] )
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'hotel_policy', $array_policy );
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = STInput::request( 'taxonomy' );
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }

                        /////////////////////////////////////
                        /// Update Custom Field
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'hotel_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }

                        /**
                         * @since 1.3.1
                         **/
                        /*---- Properties*/
                        $properties = STInput::post( 'property-item', '' );
                        if ( !empty( $properties ) ) {
                            $list = [];
                            for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                    $list[] = [
                                        'title'          => $properties[ 'title' ][ $i ],
                                        'featured_image' => $properties[ 'featured_image' ][ $i ],
                                        'description'    => $properties[ 'description' ][ $i ],
                                        'icon'           => $properties[ 'icon' ][ $i ],
                                        'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                        'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                    ];
                                }

                            }
                            update_post_meta( $post_id, 'properties_near_by', $list );
                        }

                        $class_hotel = new STAdminHotel();
                        $class_hotel->_update_avg_price( $post_id );
                        self::$msg = [
                            'status' => 'success',
                            'msg'    => 'Updated hotel successfully !'
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-hotel', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }

                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => 'Error : Update hotel not successfully !'
                        ];
                    }
                }
            }

            function validate_hotel_room()
            {

                if ( !st_check_service_available( 'hotel_room' ) ) {
                    return;
                }

                if ( !empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if ( !empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $gallery = $_FILES[ 'gallery' ];
                    if ( !empty( $gallery ) ) {
                        $tmp_array = [];
                        for ( $i = 0; $i < count( $gallery[ 'name' ] ); $i++ ) {
                            array_push( $tmp_array, [
                                'name'     => $gallery[ 'name' ][ $i ],
                                'type'     => $gallery[ 'type' ][ $i ],
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ],
                                'error'    => $gallery[ 'error' ][ $i ],
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach ( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery          .= self::upload_image_return( $_FILES[ 'gallery' ], 'gallery', $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery, 0, -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

                $validator = self::$validator;
                /// Location ///
                $validator->set_rules( 'st_title', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );
                $validator->set_rules( 'st_content', __( "Content", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'st_desc', __( "Description", ST_TEXTDOMAIN ), 'required' );
                $id_featured_image = STInput::request( 'id_featured_image' );
                if ( empty( $_FILES[ 'featured-image' ][ 'name' ] ) AND empty( $id_featured_image ) ) {
                    $validator->set_error_message( 'featured_image', __( "The Featured Image field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_gallery' ) ) {
                    $validator->set_error_message( 'gallery', __( "The Gallery field is required.", ST_TEXTDOMAIN ) );
                }
                $validator->set_rules( 'number_room', __( "Number of Room", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                $validator->set_rules( 'price', __( "Price Per Night", ST_TEXTDOMAIN ), 'required|is_numeric' );


                $validator->set_rules( 'discount_rate', __( "Discount Rate", ST_TEXTDOMAIN ), 'unsigned_integer' );
                if ( STInput::request( 'is_sale_schedule' ) == 'on' ) {
                    $validator->set_rules( 'sale_price_from', __( "Sale Start Date", ST_TEXTDOMAIN ), 'required' );
                    $validator->set_rules( 'sale_price_to', __( "Sale End Date", ST_TEXTDOMAIN ), 'required' );
                }
                if ( STInput::request( 'deposit_payment_status' ) != '' ) {
                    $validator->set_rules( 'deposit_payment_amount', __( "Deposit Amount", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                    $deposit_payment_status = STInput::request( 'deposit_payment_status' );
                    $deposit_payment_amount = STInput::request( 'deposit_payment_amount' );
                    $partner_commission     = st()->get_option( 'partner_commission', '0' );
                    if ( $deposit_payment_status == "percent" ) {
                        if ( $deposit_payment_amount <= $partner_commission ) {
                            $validator->set_error_message( 'deposit_payment_amount', __( "The commission does not match the criteria.", ST_TEXTDOMAIN ) );
                        }
                    }
                }
                $validator->set_rules( 'adult_number', __( "Adults Number", ST_TEXTDOMAIN ), 'required|unsigned_integer|greater_than[0]' );
                $validator->set_rules( 'children_number', __( "Children Number", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                $validator->set_rules( 'bed_number', __( "Beds Number", ST_TEXTDOMAIN ), 'required|unsigned_integer|greater_than[0]' );
                $validator->set_rules( 'room_footage', __( "Room footage", ST_TEXTDOMAIN ), 'required|unsigned_integer|greater_than[0]' );
                if ( STInput::request( 'st_room_external_booking' ) == 'on' ) {
                    $validator->set_rules( 'st_room_external_booking_link', __( "External Booking URL", ST_TEXTDOMAIN ), 'required|valid_url' );
                }

                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );


                    return false;
                }

                return true;
            }

            /* Update Room */
            function st_update_post_type_room()
            {
                if ( !st_check_service_available( 'st_hotel' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_room', '' ), 'user_setting' ) ) {
                    if ( self::validate_hotel_room() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_room' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();
                        $st_content   = STInput::request( 'st_content' );
                        $my_post      = [
                            'post_title'   => STInput::request( 'st_title', 'Title' ),
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'hotel_room',
                            'post_excerpt' => '',
                        ];
                        $post_id      = wp_insert_post( $my_post );
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_room' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }
                    if ( !empty( $post_id ) ) {
                        $st_content = STInput::request( 'st_content' );
                        $my_post    = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title' ),
                            'post_content' => stripslashes( $st_content ),
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );

                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }


                        wp_update_post( $my_post );

                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );

                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        /////////////////////////////////////
                        /// Update Metabox
                        /////////////////////////////////////
                        //tab location
                        if ( isset( $_REQUEST[ 'multi_location' ] ) ) {
                            $location = $_REQUEST[ 'multi_location' ];
                            if ( is_array( $location ) && count( $location ) ) {
                                $location_str = '';
                                foreach ( $location as $item ) {
                                    if ( empty( $location_str ) ) {
                                        $location_str .= $item;
                                    } else {
                                        $location_str .= ',' . $item;
                                    }
                                }
                            } else {
                                $location_str = '';
                            }
                            update_post_meta( $post_id, 'multi_location', $location_str );
                            update_post_meta( $post_id, 'id_location', '' );
                        }
                        update_post_meta( $post_id, 'address', STInput::request( 'address' ) );
                        //tab general
                        update_post_meta( $post_id, 'room_parent', STInput::request( 'room_parent' ) );
                        update_post_meta( $post_id, 'number_room', STInput::request( 'number_room' ) );
                        update_post_meta( $post_id, 'st_custom_layout', STInput::request( 'st_custom_layout' ) );
                        //tab general
                        update_post_meta( $post_id, 'allow_full_day', STInput::request( 'allow_full_day', 'off' ) );
                        update_post_meta( $post_id, 'price', STInput::request( 'price' ) );
                        update_post_meta( $post_id, 'discount_rate', STInput::request( 'discount_rate' ) );
                        update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );
                        update_post_meta( $post_id, 'sale_price_from', STInput::request( 'sale_price_from' ) );
                        update_post_meta( $post_id, 'sale_price_to', STInput::request( 'sale_price_to' ) );
                        update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                        update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );
                        update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                        update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                        update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );
                        //tab room facility
                        update_post_meta( $post_id, 'default_state', STInput::request( 'default_state' ) );

                        update_post_meta( $post_id, 'adult_number', STInput::request( 'adult_number' ) );
                        update_post_meta( $post_id, 'children_number', STInput::request( 'children_number' ) );
                        update_post_meta( $post_id, 'bed_number', STInput::request( 'bed_number' ) );
                        update_post_meta( $post_id, 'room_footage', STInput::request( 'room_footage' ) );
                        update_post_meta( $post_id, 'room_description', stripslashes( STInput::request( 'room_description' ) ) );
                        update_post_meta( $post_id, 'st_room_external_booking', STInput::request( 'st_room_external_booking' ) );
                        update_post_meta( $post_id, 'st_room_external_booking_link', STInput::request( 'st_room_external_booking_link' ) );
                        //tab other facility
                        $add_new_facility_title = STInput::request( 'add_new_facility_title' );
                        $add_new_facility_value = STInput::request( 'add_new_facility_value' );
                        $add_new_facility_icon  = STInput::request( 'add_new_facility_icon' );
                        if ( !empty( $add_new_facility_title ) ) {
                            $data = [];
                            foreach ( $add_new_facility_title as $k => $v ) {
                                $data[] = [ 'title' => $v, 'facility_value' => $add_new_facility_value[ $k ], 'facility_icon' => $add_new_facility_icon[ $k ] ];
                            }
                            update_post_meta( $post_id, 'add_new_facility', $data );
                        }

                        /////////////////////////////////////
                        /// Update Payment
                        /////////////////////////////////////
                        $data_paypment = STPaymentGateways::$_payment_gateways;
                        if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                            foreach ( $data_paypment as $k => $v ) {
                                update_post_meta( $post_id, 'is_meta_payment_gateway_' . $k, STInput::request( 'is_meta_payment_gateway_' . $k ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = STInput::request( 'taxonomy' );
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }
                        /////////////////////////////////////
                        /// Update Custom Price
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'st_price' ] ) ) {
                            $price_new  = STInput::request( 'st_price' );
                            $price_type = STInput::request( 'st_price_type' );
                            $start_date = STInput::request( 'st_start_date' );
                            $end_date   = STInput::request( 'st_end_date' );
                            $status     = STInput::request( 'st_status' );
                            $priority   = STInput::request( 'st_priority' );
                            STAdmin::st_delete_price( $post_id );
                            if ( $price_new and $start_date and $end_date ) {
                                foreach ( $price_new as $k => $v ) {
                                    if ( !empty( $v ) ) {
                                        STAdmin::st_add_price( $post_id, $price_type[ $k ], $v, $start_date[ $k ], $end_date[ $k ], $status[ $k ], $priority[ $k ] );
                                    }
                                }
                            }
                        }
                        // Update extra
                        $extra = STInput::request( 'extra', '' );
                        if ( isset( $extra[ 'title' ] ) && is_array( $extra[ 'title' ] ) && count( $extra[ 'title' ] ) ) {
                            $list_extras = [];
                            foreach ( $extra[ 'title' ] as $key => $val ) {
                                if ( !empty( $val ) ) {
                                    $list_extras[ $key ] = [
                                        'title'            => $val,
                                        'extra_name'       => isset( $extra[ 'extra_name' ][ $key ] ) ? $extra[ 'extra_name' ][ $key ] : '',
                                        'extra_max_number' => isset( $extra[ 'extra_max_number' ][ $key ] ) ? $extra[ 'extra_max_number' ][ $key ] : '',
                                        'extra_price'      => isset( $extra[ 'extra_price' ][ $key ] ) ? $extra[ 'extra_price' ][ $key ] : ''
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'extra_price', $list_extras );
                        } else {
                            update_post_meta( $post_id, 'extra_price', '' );
                        }

                        /*Update discount by days*/
                        $discount_by_day = STInput::request( 'discount_by_day', '' );
                        if ( isset( $discount_by_day[ 'title' ] ) && is_array( $discount_by_day[ 'title' ] ) && count( $discount_by_day[ 'title' ] ) ) {
                            $list_discount_by_day = [];
                            foreach ( $discount_by_day[ 'title' ] as $key => $val ) {
                                if ( !empty( $val ) ) {
                                    $list_discount_by_day[ $key ] = [
                                        'title'      => $val,
                                        'number_day' => isset( $discount_by_day[ 'number_day' ][ $key ] ) ? $discount_by_day[ 'number_day' ][ $key ] : '',
                                        'discount'   => isset( $discount_by_day[ 'discount' ][ $key ] ) ? $discount_by_day[ 'discount' ][ $key ] : '',
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'discount_by_day', $list_discount_by_day );
                        } else {
                            update_post_meta( $post_id, 'discount_by_day', '' );
                        }
                        update_post_meta($post_id, 'discount_type_no_day', STInput::request('discount_type_no_day', ''));
                        /*End update discount by days*/

                        $class_room = new STAdminRoom();
                        $class_room->_update_avg_price( $post_id );
                        self::$msg = [
                            'status' => 'success',
                            'msg'    => 'Update Room successfully !'
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-room', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }
                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => 'Error : Update Room not successfully !'
                        ];
                    }
                }
            }

            function validate_tour()
            {

                if ( !st_check_service_available( 'st_tours' ) ) {
                    return;
                }
                if ( !empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if ( !empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $gallery = $_FILES[ 'gallery' ];
                    if ( !empty( $gallery ) ) {
                        $tmp_array = [];
                        for ( $i = 0; $i < count( $gallery[ 'name' ] ); $i++ ) {
                            array_push( $tmp_array, [
                                'name'     => $gallery[ 'name' ][ $i ],
                                'type'     => $gallery[ 'type' ][ $i ],
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ],
                                'error'    => $gallery[ 'error' ][ $i ],
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach ( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery          .= self::upload_image_return( $_FILES[ 'gallery' ], 'gallery', $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery, 0, -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

                $validator = self::$validator;
                $validator->set_rules( 'st_title', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );
                $validator->set_rules( 'st_content', __( "Content", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'st_desc', __( "Description", ST_TEXTDOMAIN ), 'required' );
                if ( empty( $_FILES[ 'featured-image' ][ 'name' ] ) AND !STInput::request( 'id_featured_image' ) ) {
                    $validator->set_error_message( 'featured_image', __( "The Featured Image field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_gallery' ) ) {
                    $validator->set_error_message( 'gallery', __( "The Gallery field is required.", ST_TEXTDOMAIN ) );
                }

                $validator->set_rules( 'address', __( "Address", ST_TEXTDOMAIN ), 'required|max_length[100]' );

                $validator->set_rules( 'gmap[zoom]', __( "Zoom", ST_TEXTDOMAIN ), 'required|numeric' );

                $validator->set_rules( 'email', __( "Email", ST_TEXTDOMAIN ), 'required|valid_email' );

                if ( STInput::post( 'hide_adult_in_booking_form' ) == 'off' && STInput::post( 'tour_price_by' ) == 'person' )
                    $validator->set_rules( 'adult_price', __( "Adult Price", ST_TEXTDOMAIN ), 'required|is_numeric' );
                if ( STInput::post( 'hide_children_in_booking_form' ) == 'off' && STInput::post( 'tour_price_by' ) == 'person' )
                    $validator->set_rules( 'child_price', __( "Child Price", ST_TEXTDOMAIN ), 'required|is_numeric' );
                if ( STInput::post( 'hide_infant_in_booking_form' ) == 'off' && STInput::post( 'tour_price_by' ) == 'person' )
                    $validator->set_rules( 'infant_price', __( "Infant Price", ST_TEXTDOMAIN ), 'required|is_numeric' );

                if ( STInput::post( 'tour_price_by' ) == 'fixed' )
                    $validator->set_rules( 'base_price', __( "Base Price", ST_TEXTDOMAIN ), 'required|is_numeric' );

                if ( STInput::post( 'tour_price_by' ) == 'fixed_depart' ) {
                    $validator->set_rules( 'start_date_fixed', __( "Start date", ST_TEXTDOMAIN ), 'required' );
                    $validator->set_rules( 'end_date_fixed', __( "End date", ST_TEXTDOMAIN ), 'required' );
                }


                $validator->set_rules( 'discount', __( "Discount", ST_TEXTDOMAIN ), 'unsigned_integer' );
                if ( STInput::request( 'is_sale_schedule' ) == 'on' ) {
                    $validator->set_rules( 'sale_price_from', __( "Sale Start Date", ST_TEXTDOMAIN ), 'required' );
                    $validator->set_rules( 'sale_price_to', __( "Sale End Date", ST_TEXTDOMAIN ), 'required' );
                }
                if ( STInput::request( 'deposit_payment_status' ) != '' ) {
                    $validator->set_rules( 'deposit_payment_amount', __( "Deposit Amount", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                }


                $validator->set_rules( 'discount', __( "Discount", ST_TEXTDOMAIN ), 'unsigned_integer' );
                if ( STInput::request( 'is_sale_schedule' ) == 'on' ) {
                    $validator->set_rules( 'sale_price_from', __( "Sale Start Date", ST_TEXTDOMAIN ), 'required' );
                    $validator->set_rules( 'sale_price_to', __( "Sale End Date", ST_TEXTDOMAIN ), 'required' );
                }
                if ( STInput::request( 'deposit_payment_status' ) != '' ) {
                    $validator->set_rules( 'deposit_payment_amount', __( "Deposit Amount", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                    $deposit_payment_status = STInput::request( 'deposit_payment_status' );
                    $deposit_payment_amount = STInput::request( 'deposit_payment_amount' );
                    $partner_commission     = st()->get_option( 'partner_commission', '0' );
                    if ( $deposit_payment_status == "percent" ) {
                        if ( $deposit_payment_amount <= $partner_commission ) {
                            $validator->set_error_message( 'deposit_payment_amount', __( "The commission does not match the criteria.", ST_TEXTDOMAIN ) );
                        }
                    }
                }

                if ( STInput::request( 'tour_type' ) == 'specific_date' ) {
                } else {
                    $validator->set_rules( 'duration', __( "Duration", ST_TEXTDOMAIN ), 'required' );
                }
                $validator->set_rules( 'tours_booking_period', __( "Booking Period", ST_TEXTDOMAIN ), 'unsigned_integer' );
                $validator->set_rules( 'min_people', __( "Min No. People", ST_TEXTDOMAIN ), 'required|greater_than[0]' );
                if ( STInput::request( 'st_tour_external_booking' ) == 'on' ) {
                    $validator->set_rules( 'st_tour_external_booking_link', __( "External Booking URL", ST_TEXTDOMAIN ), 'required|valid_url' );
                }


                // /is_featured
                $admin_packages   = STAdminPackages::get_inst();
                $num_set_featured = $admin_packages->count_item_can_featured( get_current_user_id(), STInput::get( 'id', '' ) );
                if ( $admin_packages->enabled_membership() ) {
                    if ( $admin_packages->get_user_role() == 'partner' && ( $num_set_featured !== 'unlimited' && $num_set_featured <= 0 ) && STInput::request( 'is_featured', 'off' ) == 'on' ) {
                        STTemplate::set_message( sprintf( __( "You cannot set featured for this car. Your remaining item is %s (items)", ST_TEXTDOMAIN ), $num_set_featured ), 'warning' );

                        return false;
                    }
                }

                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );

                    return false;
                }

                return true;
            }

            /* Update Tours */
            function st_update_post_type_tours()
            {
                if ( !st_check_service_available( 'st_tours' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_post_tours', '' ), 'user_setting' ) ) {
                    if ( self::validate_tour() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_tours' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();

                        $my_post = [
                            'post_title'   => STInput::request( 'st_title', 'Title' ),
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'st_tours',
                            'post_excerpt' => '',
                        ];
                        $post_id = wp_insert_post( $my_post );
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_tours' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }
                    if ( !empty( $post_id ) ) {
                        $my_post = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title' ),
                            'post_content' => STInput::request( 'st_content' ),
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }
                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );
                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );

                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );

                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        //tab location
                        if ( isset( $_REQUEST[ 'multi_location' ] ) ) {
                            $location = $_REQUEST[ 'multi_location' ];
                            if ( is_array( $location ) && count( $location ) ) {
                                $location_str = '';
                                foreach ( $location as $item ) {
                                    if ( empty( $location_str ) ) {
                                        $location_str .= $item;
                                    } else {
                                        $location_str .= ',' . $item;
                                    }
                                }
                            } else {
                                $location_str = '';
                            }
                            update_post_meta( $post_id, 'multi_location', $location_str );
                            update_post_meta( $post_id, 'id_location', '' );
                        }
                        update_post_meta( $post_id, 'address', STInput::request( 'address' ) );
                        $gmap = STInput::request( 'gmap' );
                        update_post_meta( $post_id, 'map_lat', $gmap[ 'lat' ] );
                        update_post_meta( $post_id, 'map_lng', $gmap[ 'lng' ] );
                        update_post_meta( $post_id, 'map_zoom', $gmap[ 'zoom' ] );
                        update_post_meta( $post_id, 'map_type', $gmap[ 'type' ] );

                        update_post_meta( $post_id, 'st_google_map', $gmap );
                        update_post_meta( $post_id, 'enable_street_views_google_map', STInput::request( 'enable_street_views_google_map' ) );
                        //tab general
                        update_post_meta( $post_id, 'st_custom_layout', STInput::request( 'st_custom_layout' ) );
                        update_post_meta( $post_id, 'is_featured', STInput::request( 'is_featured' ) );
                        update_post_meta( $post_id, 'contact_email', STInput::request( 'email' ) );
                        update_post_meta( $post_id, 'website', STInput::request( 'website' ) );
                        update_post_meta( $post_id, 'phone', STInput::request( 'phone' ) );
                        update_post_meta( $post_id, 'fax', STInput::request( 'fax' ) );;
                        update_post_meta( $post_id, 'show_agent_contact_info', STInput::request( 'show_agent_contact_info' ) );

                        update_post_meta( $post_id, 'video', STInput::request( 'video' ) );
                        update_post_meta( $post_id, 'gallery_style', STInput::request( 'gallery_style' ) );
                        //tab price
                        update_post_meta( $post_id, 'type_price', 'people_price' );
                        // update_post_meta( $post_id , 'price' , STInput::request( 'price' ) );
                        update_post_meta( $post_id, 'adult_price', STInput::request( 'adult_price' ) );
                        update_post_meta( $post_id, 'child_price', STInput::request( 'child_price' ) );
                        update_post_meta( $post_id, 'infant_price', STInput::request( 'infant_price' ) );
                        update_post_meta( $post_id, 'discount', (int)STInput::request( 'discount' ) );
                        update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );
                        $sale_price_from = TravelHelper::convertDateFormat( STInput::request( 'sale_price_from' ) );
                        $sale_price_from = date( 'Y-m-d', strtotime( $sale_price_from ) );
                        update_post_meta( $post_id, 'sale_price_from', $sale_price_from );
                        $sale_price_to = TravelHelper::convertDateFormat( STInput::request( 'sale_price_to' ) );
                        $sale_price_to = date( 'Y-m-d', strtotime( $sale_price_to ) );
                        update_post_meta( $post_id, 'sale_price_to', $sale_price_to );
                        update_post_meta( $post_id, 'hide_adult_in_booking_form', STInput::request( 'hide_adult_in_booking_form' ) );
                        update_post_meta( $post_id, 'hide_children_in_booking_form', STInput::request( 'hide_children_in_booking_form' ) );
                        update_post_meta( $post_id, 'hide_infant_in_booking_form', STInput::request( 'hide_infant_in_booking_form' ) );
                        update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                        update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                        update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );
                        update_post_meta( $post_id, 'discount_by_people_type', STInput::request( 'discount_by_people_type' ) );
                        update_post_meta( $post_id, 'discount_type', STInput::request( 'discount_type' ) );

                        //Price fixed
                        update_post_meta( $post_id, 'tour_price_by', STInput::request( 'tour_price_by' ) );
                        update_post_meta( $post_id, 'base_price', STInput::request( 'base_price' ) );

                        $start_date_fixed = STInput::request( 'start_date_fixed' );
                        $end_date_fixed   = STInput::request( 'end_date_fixed' );
                        //update_post_meta($post_id, 'start_date_fixed', STInput::request('start_date_fixed'));
                        //update_post_meta($post_id, 'end_date_fixed', STInput::request('end_date_fixed'));
                        if ( !empty( $start_date_fixed ) and !empty( $end_date_fixed ) ) {
                            update_post_meta( $post_id, 'start_date_fixed', date( 'Y-m-d', strtotime( TravelHelper::convertDateFormat( $start_date_fixed ) ) ) );
                            update_post_meta( $post_id, 'end_date_fixed', date( 'Y-m-d', strtotime( TravelHelper::convertDateFormat( $end_date_fixed ) ) ) );
                        }


                        $discount_by_adult_title = STInput::request( 'discount_by_adult_title' );
                        if ( !empty( $discount_by_adult_title ) ) {
                            $discount_by_adult_value  = $_REQUEST[ 'discount_by_adult_value' ];
                            $discount_by_adult_key    = $_REQUEST[ 'discount_by_adult_key' ];
                            $discount_by_adult_key_to = $_REQUEST[ 'discount_by_adult_key_to' ];
                            $data                     = [];
                            foreach ( $discount_by_adult_title as $k => $v ) {
                                if ( !empty( $v ) ) {
                                    array_push( $data, [
                                        'title'  => $v,
                                        'value'  => $discount_by_adult_value[ $k ],
                                        'key'    => $discount_by_adult_key[ $k ],
                                        'key_to' => $discount_by_adult_key_to[ $k ],
                                    ] );
                                }

                            }
                            update_post_meta( $post_id, 'discount_by_adult', $data );
                        } else {
                            update_post_meta( $post_id, 'discount_by_adult', [] );
                        }

                        $discount_by_child_title = STInput::request( 'discount_by_child_title' );
                        if ( !empty( $discount_by_child_title ) ) {
                            $discount_by_child_value  = $_REQUEST[ 'discount_by_child_value' ];
                            $discount_by_child_key    = $_REQUEST[ 'discount_by_child_key' ];
                            $discount_by_child_key_to = $_REQUEST[ 'discount_by_child_key_to' ];
                            $data                     = [];
                            foreach ( $discount_by_child_title as $k => $v ) {
                                if ( !empty( $v ) ) {
                                    array_push( $data, [
                                        'title'  => $v,
                                        'value'  => $discount_by_child_value[ $k ],
                                        'key'    => $discount_by_child_key[ $k ],
                                        'key_to' => $discount_by_child_key_to[ $k ],
                                    ] );
                                }
                            }

                            update_post_meta( $post_id, 'discount_by_child', $data );
                        } else {
                            update_post_meta( $post_id, 'discount_by_child', [] );
                        }
                        update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                        update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );
                        //tab info
                        update_post_meta( $post_id, 'type_tour', STInput::request( 'tour_type' ) );
                        update_post_meta( $post_id, 'check_in', STInput::request( 'check_in' ) );
                        update_post_meta( $post_id, 'check_out', STInput::request( 'check_out' ) );
                        update_post_meta( $post_id, 'duration_day', STInput::request( 'duration' ) );
                        //update_post_meta( $post_id , 'duration_unit' , STInput::request( 'duration_unit' ) );
                        update_post_meta( $post_id, 'max_people', STInput::request( 'max_people' ) );
                        update_post_meta( $post_id, 'min_people', STInput::request( 'min_people' ) );
                        update_post_meta( $post_id, 'tours_booking_period', (int)STInput::request( 'tours_booking_period' ) );
                        update_post_meta( $post_id, 'st_tour_external_booking', STInput::request( 'st_tour_external_booking' ) );
                        update_post_meta( $post_id, 'st_tour_external_booking_link', STInput::request( 'st_tour_external_booking_link' ) );
                        if ( !empty( $_REQUEST[ 'program_title' ] ) ) {
                            $program_title = $_REQUEST[ 'program_title' ];
                            $program_desc  = $_REQUEST[ 'program_desc' ];
                            $program       = [];
                            if ( !empty( $program_title ) ) {
                                foreach ( $program_title as $k => $v ) {
                                    array_push( $program, [
                                        'title' => $v,
                                        'desc'  => $program_desc[ $k ]
                                    ] );
                                }
                            }
                            update_post_meta( $post_id, 'tours_program', $program );
                        }

                        if ( !empty( $_REQUEST[ 'tours_faq_title' ] ) ) {
                            $tours_faq_title = $_REQUEST[ 'tours_faq_title' ];
                            $tours_faq_desc  = $_REQUEST[ 'tours_faq_desc' ];
                            $tours_faq       = [];
                            if ( !empty( $tours_faq_title ) ) {
                                foreach ( $tours_faq_title as $k => $v ) {
                                    array_push( $tours_faq, [
                                        'title' => $v,
                                        'desc'  => $tours_faq_desc[ $k ]
                                    ] );
                                }
                            }
                            update_post_meta( $post_id, 'tours_faq', $tours_faq );
                        }
                        /////////////////////////////////////
                        /// Update Payment
                        /////////////////////////////////////
                        $data_paypment = STPaymentGateways::$_payment_gateways;
                        if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                            foreach ( $data_paypment as $k => $v ) {
                                update_post_meta( $post_id, 'is_meta_payment_gateway_' . $k, STInput::request( 'is_meta_payment_gateway_' . $k ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update custom field
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'tours_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = $_REQUEST[ 'taxonomy' ];
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }

                        /**
                         * @since 1.3.1
                         **/
                        /*---- Properties*/
                        $properties = STInput::post( 'property-item', '' );
                        if ( !empty( $properties ) ) {
                            $list = [];
                            for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                    $list[] = [
                                        'title'          => $properties[ 'title' ][ $i ],
                                        'featured_image' => $properties[ 'featured_image' ][ $i ],
                                        'description'    => $properties[ 'description' ][ $i ],
                                        'icon'           => $properties[ 'icon' ][ $i ],
                                        'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                        'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                    ];
                                }

                            }
                            update_post_meta( $post_id, 'properties_near_by', $list );
                        }

                        // Update extra
                        $extra = STInput::request( 'extra', '' );
                        if ( isset( $extra[ 'title' ] ) && is_array( $extra[ 'title' ] ) && count( $extra[ 'title' ] ) ) {
                            $list_extras = [];
                            foreach ( $extra[ 'title' ] as $key => $val ) {
                                if ( !empty( $val ) ) {
                                    $list_extras[ $key ] = [
                                        'title'            => $val,
                                        'extra_name'       => isset( $extra[ 'extra_name' ][ $key ] ) ? $extra[ 'extra_name' ][ $key ] : '',
                                        'extra_max_number' => isset( $extra[ 'extra_max_number' ][ $key ] ) ? $extra[ 'extra_max_number' ][ $key ] : '',
                                        'extra_price'      => isset( $extra[ 'extra_price' ][ $key ] ) ? $extra[ 'extra_price' ][ $key ] : ''
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'extra_price', $list_extras );
                        } else {
                            update_post_meta( $post_id, 'extra_price', '' );
                        }

                        update_post_meta( $post_id, 'tours_include', STInput::request( 'tours_include' ) );
                        update_post_meta( $post_id, 'tours_exclude', STInput::request( 'tours_exclude' ) );

                        self::$msg = [
                            'status' => 'success',
                            'msg'    => esc_html__( 'Update tours successfully !', ST_TEXTDOMAIN )
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-tours', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }

                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => esc_html__( 'Update tours not successfully !', ST_TEXTDOMAIN )
                        ];
                    }
                }
            }

            function validate_activity()
            {

                if ( !st_check_service_available( 'st_activity' ) ) {
                    return;
                }

                if ( !empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if ( !empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $gallery = $_FILES[ 'gallery' ];
                    if ( !empty( $gallery ) ) {
                        $tmp_array = [];
                        for ( $i = 0; $i < count( $gallery[ 'name' ] ); $i++ ) {
                            array_push( $tmp_array, [
                                'name'     => $gallery[ 'name' ][ $i ],
                                'type'     => $gallery[ 'type' ][ $i ],
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ],
                                'error'    => $gallery[ 'error' ][ $i ],
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach ( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery          .= self::upload_image_return( $_FILES[ 'gallery' ], 'gallery', $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery, 0, -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

                $validator = self::$validator;

                $validator->set_rules( 'st_title', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );
                $validator->set_rules( 'st_content', __( "Content", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'st_desc', __( "Description", ST_TEXTDOMAIN ), 'required' );
                $id_featured_image = STInput::request( 'id_featured_image' );
                if ( empty( $_FILES[ 'featured-image' ][ 'name' ] ) AND empty( $id_featured_image ) ) {
                    $validator->set_error_message( 'featured_image', __( "The Featured Image field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_gallery' ) ) {
                    $validator->set_error_message( 'gallery', __( "The Gallery field is required.", ST_TEXTDOMAIN ) );
                }
                $validator->set_rules( 'address', __( "Address", ST_TEXTDOMAIN ), 'required|max_length[100]' );
                $validator->set_rules( 'gmap[zoom]', __( "Zoom", ST_TEXTDOMAIN ), 'required|numeric' );


                $validator->set_rules( 'email', __( "Email", ST_TEXTDOMAIN ), 'required|valid_email' );
                $validator->set_rules( 'phone', __( "Phone", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'website', __( "Website", ST_TEXTDOMAIN ), 'valid_url' );
                $validator->set_rules( 'video', __( "Video", ST_TEXTDOMAIN ), 'valid_url' );

                if ( STInput::request( 'type_activity' ) == 'specific_date' ) {

                } else {
                    $validator->set_rules( 'duration', __( "Duration", ST_TEXTDOMAIN ), 'required' );
                }
                $validator->set_rules( 'activity-time', __( "Activity time", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'activity_booking_period', __( "Booking Period", ST_TEXTDOMAIN ), 'unsigned_integer' );
                $validator->set_rules( 'venue-facilities', __( "Venue facilities", ST_TEXTDOMAIN ), 'required' );

                if ( STInput::post( 'hide_adult_in_booking_form' ) == 'off' )
                    $validator->set_rules( 'adult_price', __( "Adult Price", ST_TEXTDOMAIN ), 'required|is_numeric' );
                if ( STInput::post( 'hide_children_in_booking_form' ) == 'off' )
                    $validator->set_rules( 'child_price', __( "Child Price", ST_TEXTDOMAIN ), 'required|is_numeric' );
                if ( STInput::post( 'hide_infant_in_booking_form' ) == 'off' )
                    $validator->set_rules( 'infant_price', __( "Infant Price", ST_TEXTDOMAIN ), 'required|is_numeric' );

                $validator->set_rules( 'discount', __( "Discount", ST_TEXTDOMAIN ), 'unsigned_integer' );
                if ( STInput::request( 'is_sale_schedule' ) == 'on' ) {
                    $validator->set_rules( 'sale_price_from', __( "Sale Start Date", ST_TEXTDOMAIN ), 'required' );
                    $validator->set_rules( 'sale_price_to', __( "Sale End Date", ST_TEXTDOMAIN ), 'required' );
                }
                if ( STInput::request( 'st_activity_external_booking' ) == 'on' ) {
                    $validator->set_rules( 'st_activity_external_booking_link', __( "External Booking URL", ST_TEXTDOMAIN ), 'required|valid_url' );
                }
                if ( STInput::request( 'deposit_payment_status' ) != '' ) {
                    $validator->set_rules( 'deposit_payment_amount', __( "Deposit Amount", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                }
                if ( STInput::request( 'best-price-guarantee' ) == 'on' ) {
                    $validator->set_rules( 'best-price-guarantee-text', __( "Best Price Guarantee Text", ST_TEXTDOMAIN ), 'required' );
                }
                // /is_featured
                $admin_packages   = STAdminPackages::get_inst();
                $num_set_featured = $admin_packages->count_item_can_featured( get_current_user_id(), STInput::get( 'id', '' ) );
                if ( $admin_packages->enabled_membership() ) {
                    if ( $admin_packages->get_user_role() == 'partner' && ( $num_set_featured !== 'unlimited' && $num_set_featured <= 0 ) && STInput::request( 'is_featured', 'off' ) == 'on' ) {
                        STTemplate::set_message( sprintf( __( "You cannot set featured for this activity. Your remaining item is %s (items)", ST_TEXTDOMAIN ), $num_set_featured ), 'warning' );

                        return false;
                    }
                }

                if ( STInput::request( 'type_activity' ) == 'specific_date' ) {

                } else {
                    $validator->set_rules( 'duration', __( "Duration", ST_TEXTDOMAIN ), 'required' );
                }
                $validator->set_rules( 'activity-time', __( "Activity time", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'activity_booking_period', __( "Booking Period", ST_TEXTDOMAIN ), 'unsigned_integer' );
                $validator->set_rules( 'venue-facilities', __( "Venue facilities", ST_TEXTDOMAIN ), 'required' );

                if ( STInput::post( 'hide_adult_in_booking_form' ) == 'off' )
                    $validator->set_rules( 'adult_price', __( "Adult Price", ST_TEXTDOMAIN ), 'required|is_numeric' );
                if ( STInput::post( 'hide_children_in_booking_form' ) == 'off' )
                    $validator->set_rules( 'child_price', __( "Child Price", ST_TEXTDOMAIN ), 'required|is_numeric' );
                if ( STInput::post( 'hide_infant_in_booking_form' ) == 'off' )
                    $validator->set_rules( 'infant_price', __( "Infant Price", ST_TEXTDOMAIN ), 'required|is_numeric' );

                $validator->set_rules( 'discount', __( "Discount", ST_TEXTDOMAIN ), 'unsigned_integer' );
                if ( STInput::request( 'is_sale_schedule' ) == 'on' ) {
                    $validator->set_rules( 'sale_price_from', __( "Sale Start Date", ST_TEXTDOMAIN ), 'required' );
                    $validator->set_rules( 'sale_price_to', __( "Sale End Date", ST_TEXTDOMAIN ), 'required' );
                }
                if ( STInput::request( 'st_activity_external_booking' ) == 'on' ) {
                    $validator->set_rules( 'st_activity_external_booking_link', __( "External Booking URL", ST_TEXTDOMAIN ), 'required|valid_url' );
                }
                if ( STInput::request( 'deposit_payment_status' ) != '' ) {
                    $validator->set_rules( 'deposit_payment_amount', __( "Deposit Amount", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                    $deposit_payment_status = STInput::request( 'deposit_payment_status' );
                    $deposit_payment_amount = STInput::request( 'deposit_payment_amount' );
                    $partner_commission     = st()->get_option( 'partner_commission', '0' );
                    if ( $deposit_payment_status == "percent" ) {
                        if ( $deposit_payment_amount <= $partner_commission ) {
                            $validator->set_error_message( 'deposit_payment_amount', __( "The commission does not match the criteria.", ST_TEXTDOMAIN ) );
                        }
                    }
                }
                if ( STInput::request( 'best-price-guarantee' ) == 'on' ) {
                    $validator->set_rules( 'best-price-guarantee-text', __( "Best Price Guarantee Text", ST_TEXTDOMAIN ), 'required' );
                }
                // /is_featured
                $admin_packages   = STAdminPackages::get_inst();
                $num_set_featured = $admin_packages->count_item_can_featured( get_current_user_id(), STInput::get( 'id', '' ) );
                if ( $admin_packages->enabled_membership() ) {
                    if ( $admin_packages->get_user_role() == 'partner' && ( $num_set_featured !== 'unlimited' && $num_set_featured <= 0 ) && STInput::request( 'is_featured', 'off' ) == 'on' ) {
                        STTemplate::set_message( sprintf( __( "You cannot set featured for this activity. Your remaining item is %s (items)", ST_TEXTDOMAIN ), $num_set_featured ), 'warning' );

                        return false;
                    }
                }

                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );


                    //STTemplate::set_message($result->error_string, 'warning');


                    return false;
                }

                return true;
            }

            /* Update Activity */
            function st_update_post_type_activity()
            {
                if ( !st_check_service_available( 'st_activity' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_post_activity', '' ), 'user_setting' ) ) {
                    if ( self::validate_activity() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_activity' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();

                        $my_post = [
                            'post_title'   => STInput::request( 'st_title', 'Title' ),
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'st_activity',
                            'post_excerpt' => '',
                        ];
                        $post_id = wp_insert_post( $my_post );
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_activity' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }

                    if ( !empty( $post_id ) ) {
                        $st_content = STInput::request( 'st_content' );
                        $my_post    = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title' ),
                            'post_content' => stripslashes( $st_content ),
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );

                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );
                        /////////////////////////////////////
                        /// Update featured
                        /////////////////////////////////////
                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );

                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        /////////////////////////////////////
                        /// Update Meta Box
                        /////////////////////////////////////
                        //tab location
                        if ( isset( $_REQUEST[ 'multi_location' ] ) ) {
                            $location = $_REQUEST[ 'multi_location' ];
                            if ( is_array( $location ) && count( $location ) ) {
                                $location_str = '';
                                foreach ( $location as $item ) {
                                    if ( empty( $location_str ) ) {
                                        $location_str .= $item;
                                    } else {
                                        $location_str .= ',' . $item;
                                    }
                                }
                            } else {
                                $location_str = '';
                            }
                            update_post_meta( $post_id, 'multi_location', $location_str );
                            update_post_meta( $post_id, 'id_location', '' );
                        }
                        update_post_meta( $post_id, 'address', STInput::request( 'address' ) );
                        $gmap = STInput::request( 'gmap' );
                        update_post_meta( $post_id, 'map_lat', $gmap[ 'lat' ] );
                        update_post_meta( $post_id, 'map_lng', $gmap[ 'lng' ] );
                        update_post_meta( $post_id, 'map_zoom', $gmap[ 'zoom' ] );
                        update_post_meta( $post_id, 'map_type', $gmap[ 'type' ] );

                        update_post_meta( $post_id, 'st_google_map', $gmap );
                        update_post_meta( $post_id, 'enable_street_views_google_map', STInput::request( 'enable_street_views_google_map' ) );
                        //tab general
                        update_post_meta( $post_id, 'st_custom_layout', STInput::request( 'st_custom_layout' ) );
                        update_post_meta( $post_id, 'is_featured', STInput::request( 'is_featured' ) );
                        update_post_meta( $post_id, 'contact_email', STInput::request( 'email' ) );
                        update_post_meta( $post_id, 'contact_web', STInput::request( 'website' ) );
                        update_post_meta( $post_id, 'contact_phone', STInput::request( 'phone' ) );
                        update_post_meta( $post_id, 'contact_fax', STInput::request( 'contact_fax' ) );;
                        update_post_meta( $post_id, 'show_agent_contact_info', STInput::request( 'show_agent_contact_info' ) );
                        update_post_meta( $post_id, 'video', STInput::request( 'video' ) );
                        update_post_meta( $post_id, 'gallery_style', STInput::request( 'gallery_style' ) );
                        update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                        update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                        update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );
                        update_post_meta( $post_id, 'discount_by_people_type', STInput::request( 'discount_by_people_type' ) );
                        update_post_meta( $post_id, 'discount_type', STInput::request( 'discount_type' ) );
                        //tab info
                        update_post_meta( $post_id, 'type_activity', STInput::request( 'type_activity' ) );

                        update_post_meta( $post_id, 'activity-time', STInput::request( 'activity-time' ) );
                        update_post_meta( $post_id, 'duration', STInput::request( 'duration' ) );
                        update_post_meta( $post_id, 'venue-facilities', stripslashes( STInput::request( 'venue-facilities' ) ) );
                        update_post_meta( $post_id, 'activity_booking_period', (int)STInput::request( 'activity_booking_period' ) );
                        update_post_meta( $post_id, 'max_people', STInput::request( 'max_people' ) );
                        //tab price settings
                        update_post_meta( $post_id, 'type_price', 'people_price' );

                        update_post_meta( $post_id, 'adult_price', STInput::request( 'adult_price' ) );
                        update_post_meta( $post_id, 'child_price', STInput::request( 'child_price' ) );
                        update_post_meta( $post_id, 'infant_price', STInput::request( 'infant_price' ) );
                        update_post_meta( $post_id, 'discount', (int)STInput::request( 'discount' ) );
                        update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );

                        $sale_price_from = TravelHelper::convertDateFormat( STInput::request( 'sale_price_from' ) );
                        $sale_price_from = date( 'Y-m-d', strtotime( $sale_price_from ) );
                        update_post_meta( $post_id, 'sale_price_from', $sale_price_from );
                        $sale_price_to = TravelHelper::convertDateFormat( STInput::request( 'sale_price_to' ) );
                        $sale_price_to = date( 'Y-m-d', strtotime( $sale_price_to ) );
                        update_post_meta( $post_id, 'sale_price_to', $sale_price_to );

                        update_post_meta( $post_id, 'st_activity_external_booking', STInput::request( 'st_activity_external_booking' ) );
                        update_post_meta( $post_id, 'st_activity_external_booking_link', STInput::request( 'st_activity_external_booking_link' ) );
                        update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                        update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );
                        update_post_meta( $post_id, 'best-price-guarantee', STInput::request( 'best-price-guarantee' ) );
                        update_post_meta( $post_id, 'best-price-guarantee-text', STInput::request( 'best-price-guarantee-text' ) );
                        update_post_meta( $post_id, 'hide_adult_in_booking_form', STInput::request( 'hide_adult_in_booking_form' ) );
                        update_post_meta( $post_id, 'hide_children_in_booking_form', STInput::request( 'hide_children_in_booking_form' ) );
                        update_post_meta( $post_id, 'hide_infant_in_booking_form', STInput::request( 'hide_infant_in_booking_form' ) );

                        $discount_by_adult_title = STInput::request( 'discount_by_adult_title' );
                        if ( !empty( $discount_by_adult_title ) ) {
                            $discount_by_adult_value  = $_REQUEST[ 'discount_by_adult_value' ];
                            $discount_by_adult_key    = $_REQUEST[ 'discount_by_adult_key' ];
                            $discount_by_adult_key_to = $_REQUEST[ 'discount_by_adult_key_to' ];
                            $data                     = [];
                            foreach ( $discount_by_adult_title as $k => $v ) {
                                if ( !empty( $v ) ) {
                                    array_push( $data, [
                                        'title'  => $v,
                                        'value'  => $discount_by_adult_value[ $k ],
                                        'key'    => $discount_by_adult_key[ $k ],
                                        'key_to' => $discount_by_adult_key_to[ $k ],
                                    ] );
                                }

                            }
                            update_post_meta( $post_id, 'discount_by_adult', $data );
                        } else {
                            update_post_meta( $post_id, 'discount_by_adult', [] );
                        }

                        $discount_by_child_title = STInput::request( 'discount_by_child_title' );
                        if ( !empty( $discount_by_child_title ) ) {
                            $discount_by_child_value  = STInput::request( 'discount_by_child_value' );
                            $discount_by_child_key    = STInput::request( 'discount_by_child_key' );
                            $discount_by_child_key_to = STInput::request( 'discount_by_child_key_to' );
                            $data                     = [];
                            foreach ( $discount_by_child_title as $k => $v ) {
                                if ( !empty( $v ) ) {
                                    array_push( $data, [
                                        'title'  => $v,
                                        'value'  => $discount_by_child_value[ $k ],
                                        'key'    => $discount_by_child_key[ $k ],
                                        'key_to' => $discount_by_child_key_to[ $k ],
                                    ] );
                                }
                            }

                            update_post_meta( $post_id, 'discount_by_child', $data );
                        } else {
                            update_post_meta( $post_id, 'discount_by_child', [] );
                        }
                        /////////////////////////////////////
                        /// Update Payment
                        /////////////////////////////////////
                        $data_paypment = STPaymentGateways::$_payment_gateways;
                        if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                            foreach ( $data_paypment as $k => $v ) {
                                update_post_meta( $post_id, 'is_meta_payment_gateway_' . $k, STInput::request( 'is_meta_payment_gateway_' . $k ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update custom flied
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'st_activity_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = $_REQUEST[ 'taxonomy' ];
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }

                        update_post_meta( $post_id, 'activity_include', STInput::request( 'activity_include' ) );
                        update_post_meta( $post_id, 'activity_exclude', STInput::request( 'activity_exclude' ) );
                        update_post_meta( $post_id, 'activity_highlight', STInput::request( 'activity_highlight' ) );

                        if ( !empty( $_REQUEST[ 'activity_faq_title' ] ) ) {
                            $activity_faq_title = $_REQUEST['activity_faq_title'];
                            $activity_faq_desc = $_REQUEST['activity_faq_desc'];
                            $activity_faq = [];
                            if (!empty($activity_faq_title)) {
                                foreach ($activity_faq_title as $k => $v) {
                                    array_push($activity_faq, [
                                        'title' => $v,
                                        'desc' => $activity_faq_desc[$k]
                                    ]);
                                }
                            }
                            update_post_meta($post_id, 'activity_faq', $activity_faq);
                        }

                        /**
                         * @since 1.3.1
                         **/
                        /*---- Properties*/
                        $properties = STInput::post( 'property-item', '' );
                        if ( !empty( $properties ) ) {
                            $list = [];
                            for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                    $list[] = [
                                        'title'          => $properties[ 'title' ][ $i ],
                                        'featured_image' => $properties[ 'featured_image' ][ $i ],
                                        'description'    => $properties[ 'description' ][ $i ],
                                        'icon'           => $properties[ 'icon' ][ $i ],
                                        'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                        'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                    ];
                                }

                            }
                            update_post_meta( $post_id, 'properties_near_by', $list );
                        }


                        // Update extra
                        $extra = STInput::request( 'extra', '' );
                        if ( isset( $extra[ 'title' ] ) && is_array( $extra[ 'title' ] ) && count( $extra[ 'title' ] ) ) {
                            $list_extras = [];
                            foreach ( $extra[ 'title' ] as $key => $val ) {
                                if ( !empty( $val ) ) {
                                    $list_extras[ $key ] = [
                                        'title'            => $val,
                                        'extra_name'       => isset( $extra[ 'extra_name' ][ $key ] ) ? $extra[ 'extra_name' ][ $key ] : '',
                                        'extra_max_number' => isset( $extra[ 'extra_max_number' ][ $key ] ) ? $extra[ 'extra_max_number' ][ $key ] : '',
                                        'extra_price'      => isset( $extra[ 'extra_price' ][ $key ] ) ? $extra[ 'extra_price' ][ $key ] : ''
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'extra_price', $list_extras );
                        } else {
                            update_post_meta( $post_id, 'extra_price', '' );
                        }
                        self::$msg = [
                            'status' => 'success',
                            'msg'    => __( 'Update activity successful!', ST_TEXTDOMAIN )
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-activity', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }

                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => __( 'Error : Update activity not successful!', ST_TEXTDOMAIN )
                        ];
                    }
                }
            }

            function validate_car()
            {

                if ( !st_check_service_available( 'st_cars' ) ) {
                    return;
                }
                if ( !empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if ( !empty( $_FILES[ 'logo' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $logo_image            = $_FILES[ 'logo' ];
                    $id_logo_image         = self::upload_image_return( $logo_image, 'logo', $logo_image[ 'type' ] );
                    $_REQUEST[ 'id_logo' ] = $id_logo_image;
                }
                if ( !empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $gallery = $_FILES[ 'gallery' ];
                    if ( !empty( $gallery ) ) {
                        $tmp_array = [];
                        for ( $i = 0; $i < count( $gallery[ 'name' ] ); $i++ ) {
                            array_push( $tmp_array, [
                                'name'     => $gallery[ 'name' ][ $i ],
                                'type'     => $gallery[ 'type' ][ $i ],
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ],
                                'error'    => $gallery[ 'error' ][ $i ],
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach ( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery          .= self::upload_image_return( $_FILES[ 'gallery' ], 'gallery', $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery, 0, -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

                $validator = self::$validator;
                $validator->set_rules( 'st_title_car', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );

                $validator->set_rules( 'st_desc', __( "Description", ST_TEXTDOMAIN ), 'required' );
                if ( empty( $_FILES[ 'featured-image' ][ 'name' ] ) AND !STInput::request( 'id_featured_image' ) ) {
                    $validator->set_error_message( 'featured_image', __( "The Featured Image field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_gallery' ) ) {
                    $validator->set_error_message( 'gallery', __( "The Gallery field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'logo' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_logo' ) ) {
                    $validator->set_error_message( 'logo', __( "The Logo field is required.", ST_TEXTDOMAIN ) );
                }

                $validator->set_rules( 'address', __( "Address", ST_TEXTDOMAIN ), 'required|max_length[100]' );

                $validator->set_rules( 'gmap[zoom]', __( "Zoom", ST_TEXTDOMAIN ), 'required|numeric' );

                $validator->set_rules( 'email', __( "Email", ST_TEXTDOMAIN ), 'required|valid_email' );
                $validator->set_rules( 'st_name', __( "Car Manufacturer Name", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'phone', __( "Phone", ST_TEXTDOMAIN ), 'required' );

                $validator->set_rules( 'about', __( "About", ST_TEXTDOMAIN ), 'required' );

                $validator->set_rules( 'price', __( "Price", ST_TEXTDOMAIN ), 'required|is_numeric' );
                $validator->set_rules( 'discount', __( "Discount", ST_TEXTDOMAIN ), 'unsigned_integer' );
                $validator->set_rules( 'number_car', __( "Number of cars for Rent", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                if ( STInput::request( 'is_sale_schedule' ) == 'on' ) {
                    $validator->set_rules( 'sale_price_from', __( "Sale Start Date", ST_TEXTDOMAIN ), 'required' );
                    $validator->set_rules( 'sale_price_to', __( "Sale End Date", ST_TEXTDOMAIN ), 'required' );
                }
                if ( STInput::request( 'deposit_payment_status' ) != '' ) {
                    $validator->set_rules( 'deposit_payment_amount', __( "Deposit Amount", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                    $deposit_payment_status = STInput::request( 'deposit_payment_status' );
                    $deposit_payment_amount = STInput::request( 'deposit_payment_amount' );
                    $partner_commission     = st()->get_option( 'partner_commission', '0' );
                    if ( $deposit_payment_status == "percent" ) {
                        if ( $deposit_payment_amount <= $partner_commission ) {
                            $validator->set_error_message( 'deposit_payment_amount', __( "The commission does not match the criteria.", ST_TEXTDOMAIN ) );
                        }
                    }
                }
                $validator->set_rules( 'cars_booking_period', __( "Booking Period", ST_TEXTDOMAIN ), 'unsigned_integer' );
                if ( STInput::request( 'st_car_external_booking' ) == 'on' ) {
                    $validator->set_rules( 'st_car_external_booking_link', __( "External Booking URL", ST_TEXTDOMAIN ), 'required|valid_url' );
                }

                // /is_featured
                $admin_packages   = STAdminPackages::get_inst();
                $num_set_featured = $admin_packages->count_item_can_featured( get_current_user_id(), STInput::get( 'id', '' ) );
                if ( $admin_packages->enabled_membership() ) {
                    if ( $admin_packages->get_user_role() == 'partner' && ( $num_set_featured !== 'unlimited' && $num_set_featured <= 0 ) && STInput::request( 'is_featured', 'off' ) == 'on' ) {
                        STTemplate::set_message( sprintf( __( "You cannot set featured for this car. Your remaining item is %s (items)", ST_TEXTDOMAIN ), $num_set_featured ), 'warning' );

                        return false;
                    }
                }
                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );

                    return false;
                }

                return true;
            }

            /* Update Cars */
            function st_update_post_type_cars()
            {
                if ( !st_check_service_available( 'st_cars' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_post_cars', '' ), 'user_setting' ) ) {
                    if ( self::validate_car() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_cars' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();

                        $my_post = [
                            'post_title'   => STInput::request( 'st_title_car', 'Title' ),
                            'post_name'    => sanitize_title( STInput::request( 'st_title_car', 'Title' ) ),
                            'post_content' => STInput::request( 'st_content', '' ),
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'st_cars',
                            'post_excerpt' => '',
                        ];
                        $post_id = wp_insert_post( $my_post );
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_cars' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }
                    if ( !empty( $post_id ) ) {
                        $my_post = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title_car' ),
                            'post_name'    => sanitize_title( STInput::request( 'st_title_car' ) ),
                            'post_content' => STInput::request( 'st_content', '' ),
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );

                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );
                        /////////////////////////////////////
                        /// Update featured
                        /////////////////////////////////////
                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );
                        /////////////////////////////////////
                        /// Update logo
                        /////////////////////////////////////


                        $logo = (int)STInput::request( 'id_logo', '' );
                        update_post_meta( $post_id, 'logo', $logo );


                        /////////////////////////////////////
                        /// Update gallery
                        /////////////////////////////////////
                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        /////////////////////////////////////
                        /// Update Meta
                        /////////////////////////////////////
                        if ( isset( $_REQUEST[ 'multi_location' ] ) ) {
                            $location = STInput::request( 'multi_location' );
                            if ( is_array( $location ) && count( $location ) ) {
                                $location_str = '';
                                foreach ( $location as $item ) {
                                    if ( empty( $location_str ) ) {
                                        $location_str .= $item;
                                    } else {
                                        $location_str .= ',' . $item;
                                    }
                                }
                            } else {
                                $location_str = '';
                            }
                            update_post_meta( $post_id, 'multi_location', $location_str );
                            update_post_meta( $post_id, 'id_location', '' );
                        }
                        update_post_meta( $post_id, 'location_type', STInput::request( 'location_type', 'multi_location' ) );

                        update_post_meta( $post_id, 'is_featured', STInput::request( 'is_featured' ) );
                        update_post_meta( $post_id, 'cars_name', STInput::request( 'st_name' ) );
                        update_post_meta( $post_id, 'st_custom_layout', STInput::request( 'st_custom_layout' ) );
                        update_post_meta( $post_id, 'gallery_style', STInput::request( 'gallery_style' ) );
                        update_post_meta( $post_id, 'cars_email', STInput::request( 'email' ) );
                        update_post_meta( $post_id, 'cars_phone', STInput::request( 'phone' ) );
                        update_post_meta( $post_id, 'cars_fax', STInput::request( 'cars_fax' ) );
                        update_post_meta( $post_id, 'show_agent_contact_info', STInput::request( 'show_agent_contact_info' ) );

                        update_post_meta( $post_id, 'cars_website', STInput::request( 'cars_website' ) );
                        update_post_meta( $post_id, 'cars_about', STInput::request( 'about' ) );
                        update_post_meta( $post_id, 'video', STInput::request( 'video' ) );
                        update_post_meta( $post_id, 'cars_address', STInput::request( 'address' ) );
                        update_post_meta( $post_id, 'cars_price', STInput::request( 'price' ) );
                        update_post_meta( $post_id, 'is_custom_price', STInput::request( 'is_custom_price' ) );
                        update_post_meta( $post_id, 'discount', (int)STInput::request( 'discount' ) );
                        update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );

                        $sale_price_from = TravelHelper::convertDateFormat( STInput::request( 'sale_price_from' ) );
                        $sale_price_from = date( 'Y-m-d', strtotime( $sale_price_from ) );
                        update_post_meta( $post_id, 'sale_price_from', $sale_price_from );
                        $sale_price_to = TravelHelper::convertDateFormat( STInput::request( 'sale_price_to' ) );
                        $sale_price_to = date( 'Y-m-d', strtotime( $sale_price_to ) );
                        update_post_meta( $post_id, 'sale_price_to', $sale_price_to );

                        update_post_meta( $post_id, 'number_car', STInput::request( 'number_car' ) );
                        update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                        update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );
                        update_post_meta( $post_id, 'cars_booking_period', (int)STInput::request( 'cars_booking_period' ) );
                        update_post_meta( $post_id, 'cars_booking_min_day', (int)STInput::request( 'cars_booking_min_day' ) );
                        update_post_meta( $post_id, 'cars_booking_min_hour', (int)STInput::request( 'cars_booking_min_hour' ) );
                        update_post_meta( $post_id, 'st_car_external_booking', STInput::request( 'st_car_external_booking' ) );
                        update_post_meta( $post_id, 'st_car_external_booking_link', STInput::request( 'st_car_external_booking_link' ) );
                        update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                        update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                        update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );
                        $gmap = STInput::request( 'gmap' );
                        update_post_meta( $post_id, 'map_lat', $gmap[ 'lat' ] );
                        update_post_meta( $post_id, 'map_lng', $gmap[ 'lng' ] );
                        update_post_meta( $post_id, 'map_zoom', $gmap[ 'zoom' ] );
                        update_post_meta( $post_id, 'map_type', $gmap[ 'type' ] );

                        update_post_meta( $post_id, 'st_google_map', $gmap );
                        update_post_meta( $post_id, 'enable_street_views_google_map', STInput::request( 'enable_street_views_google_map' ) );
                        /////////////////////////////////////
                        /// Update Payment
                        /////////////////////////////////////
                        $data_paypment = STPaymentGateways::$_payment_gateways;
                        if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                            foreach ( $data_paypment as $k => $v ) {
                                update_post_meta( $post_id, 'is_meta_payment_gateway_' . $k, STInput::request( 'is_meta_payment_gateway_' . $k ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update Custom Price
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'st_price' ] ) ) {
                            $price_new  = STInput::request( 'st_price' );
                            $price_type = STInput::request( 'st_price_type' );
                            $start_date = STInput::request( 'st_start_date' );
                            $end_date   = STInput::request( 'st_end_date' );
                            $status     = STInput::request( 'st_status' );
                            $priority   = STInput::request( 'st_priority' );
                            STAdmin::st_delete_price( $post_id );
                            if ( $price_new and $start_date and $end_date ) {
                                foreach ( $price_new as $k => $v ) {
                                    if ( !empty( $v ) ) {
                                        STAdmin::st_add_price( $post_id, $price_type[ $k ], $v, $start_date[ $k ], $end_date[ $k ], $status[ $k ], $priority[ $k ] );
                                    }
                                }
                            }
                        }
                        if ( !empty( $_REQUEST[ 'st_price_by_number' ] ) ) {
                            $data               = [];
                            $st_number_start    = STInput::request( 'st_number_start' );
                            $st_number_end      = STInput::request( 'st_number_end' );
                            $st_price_by_number = STInput::request( 'st_price_by_number' );
                            $st_title           = STInput::request( 'st_title' );
                            if ( !empty( $st_price_by_number ) ) {
                                foreach ( $st_price_by_number as $k => $v ) {
                                    if ( !empty( $st_title[ $k ] ) ) {
                                        $data[] = [
                                            'title'        => $st_title[ $k ],
                                            'number_start' => $st_number_start[ $k ],
                                            'number_end'   => $st_number_end[ $k ],
                                            'price'        => $v,
                                        ];
                                    }

                                }
                            }
                            update_post_meta( $post_id, 'price_by_number_of_day_hour', $data );
                        }

                        if ( !empty( $_REQUEST[ 'journey_title' ] ) ) {
                            $data                  = [];
                            $journey_title         = STInput::request( 'journey_title' );
                            $journey_transfer_from = STInput::request( 'journey_transfer_from' );
                            $journey_transfer_to   = STInput::request( 'journey_transfer_to' );
                            $journey_price         = STInput::request( 'journey_price' );
                            $journey_return        = STInput::request( 'journey_return' );

                            if ( !empty( $journey_transfer_from ) ) {
                                foreach ( $journey_transfer_from as $k => $v ) {
                                    $data[] = [
                                        'title'         => $journey_title[ $k ],
                                        'transfer_from' => $journey_transfer_from[ $k ],
                                        'transfer_to'   => $journey_transfer_to[ $k ],
                                        'price'         => $journey_price[ $k ],
                                        'return'        => isset( $journey_return[ $k ] ) ? $journey_return[ $k ] : 'no',
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'journey', $data );
                        } else {
                            update_post_meta( $post_id, 'journey', [] );
                        }

                        // Extra service for car transfer
                        $extra = STInput::request( 'extra', '' );
                        if ( isset( $extra[ 'title' ] ) && is_array( $extra[ 'title' ] ) && count( $extra[ 'title' ] ) ) {
                            $list_extras = [];
                            foreach ( $extra[ 'title' ] as $key => $val ) {
                                if ( !empty( $val ) ) {
                                    $list_extras[ $key ] = [
                                        'title'            => $val,
                                        'extra_name'       => isset( $extra[ 'extra_name' ][ $key ] ) ? $extra[ 'extra_name' ][ $key ] : '',
                                        'extra_max_number' => isset( $extra[ 'extra_max_number' ][ $key ] ) ? $extra[ 'extra_max_number' ][ $key ] : '',
                                        'extra_price'      => isset( $extra[ 'extra_price' ][ $key ] ) ? $extra[ 'extra_price' ][ $key ] : ''
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'extra_price', $list_extras );
                        } else {
                            update_post_meta( $post_id, 'extra_price', '' );
                        }
                        // End Extra service for car transfer

                        update_post_meta( $post_id, 'car_type', STInput::request( 'car_type', 'normal' ) );
                        update_post_meta( $post_id, 'price_type', STInput::request( 'price_type', 'distance' ) );
                        update_post_meta( $post_id, 'num_passenger', STInput::request( 'num_passenger', '1' ) );
                        /////////////////////////////////////
                        /// Update equipment item
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'equipment_item_title' ] ) ) {
                            $equipment                  = [];
                            $equipment_item_title       = STInput::request( 'equipment_item_title' );
                            $equipment_item_price       = STInput::request( 'equipment_item_price' );
                            $equipment_item_price_unit  = STInput::request( 'equipment_item_price_unit' );
                            $equipment_item_price_max   = STInput::request( 'equipment_item_price_max' );
                            $cars_equipment_list_number = STInput::request( 'cars_equipment_list_number' );
                            if ( !empty( $equipment_item_title ) ) {
                                foreach ( $equipment_item_title as $k => $v ) {
                                    if ( !empty( $v ) ) {
                                        array_push( $equipment, [
                                            'title'                         => $v,
                                            'cars_equipment_list_price'     => $equipment_item_price[ $k ],
                                            'price_unit'                    => $equipment_item_price_unit[ $k ],
                                            'cars_equipment_list_price_max' => $equipment_item_price_max[ $k ],
                                            'cars_equipment_list_number'    => $cars_equipment_list_number[ $k ],
                                        ] );
                                    }

                                }
                            }
                            update_post_meta( $post_id, 'cars_equipment_list', $equipment );
                        }

                        /////////////////////////////////////
                        /// Update equipment item
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'features_taxonomy' ] ) ) {
                            $features               = [];
                            $features_taxonomy      = STInput::request( 'features_taxonomy' );
                            $features_taxonomy_info = STInput::request( 'taxonomy_info' );
                            if ( !empty( $features_taxonomy ) ) {
                                foreach ( $features_taxonomy as $k => $v ) {
                                    $tmp = explode( ',', $v );
                                    array_push( $features, [
                                        'title'                        => $tmp[ 1 ],
                                        'cars_equipment_taxonomy_id'   => $tmp[ 0 ],
                                        'cars_equipment_taxonomy_info' => $features_taxonomy_info[ $k ]
                                    ] );
                                }
                            }
                            update_post_meta( $post_id, 'cars_equipment_info', $features );
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            $taxonomy = STInput::request( 'taxonomy' );
                            if ( !empty( $taxonomy ) ) {
                                $tax = [];
                                foreach ( $taxonomy as $item ) {
                                    $tmp                = explode( ",", $item );
                                    $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                }
                                foreach ( $tax as $key2 => $val2 ) {
                                    wp_set_post_terms( $post_id, $val2, $key2 );
                                }
                            }
                        }

                        /**
                         * @since 1.3.1
                         **/
                        /*---- Properties*/
                        $properties = STInput::post( 'property-item', '' );
                        if ( !empty( $properties ) ) {
                            $list = [];
                            for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                    $list[] = [
                                        'title'          => $properties[ 'title' ][ $i ],
                                        'featured_image' => $properties[ 'featured_image' ][ $i ],
                                        'description'    => $properties[ 'description' ][ $i ],
                                        'icon'           => $properties[ 'icon' ][ $i ],
                                        'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                        'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                    ];
                                }

                            }
                            update_post_meta( $post_id, 'properties_near_by', $list );
                        }

                        /////////////////////////////////////
                        /// Update Custom field
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'st_cars_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }

                        self::$msg = [
                            'status' => 'success',
                            'msg'    => 'Update car successfully !'
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-cars', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }

                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => 'Error : Update car not successfully !'
                        ];
                    }
                }
            }

            function validate_rental()
            {

                if ( !st_check_service_available( 'st_rental' ) ) {
                    return;
                }

                if ( !empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if ( !empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $gallery = $_FILES[ 'gallery' ];
                    if ( !empty( $gallery ) ) {
                        $tmp_array = [];
                        for ( $i = 0; $i < count( $gallery[ 'name' ] ); $i++ ) {
                            array_push( $tmp_array, [
                                'name'     => $gallery[ 'name' ][ $i ],
                                'type'     => $gallery[ 'type' ][ $i ],
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ],
                                'error'    => $gallery[ 'error' ][ $i ],
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach ( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery          .= self::upload_image_return( $_FILES[ 'gallery' ], 'gallery', $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery, 0, -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

                $validator = self::$validator;
                /// Location ///
                $validator->set_rules( 'st_title', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );
                $validator->set_rules( 'st_content', __( "Content", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'st_desc', __( "Description", ST_TEXTDOMAIN ), 'required' );
                $id_featured_image = STInput::request( 'id_featured_image' );
                if ( empty( $_FILES[ 'featured-image' ][ 'name' ] ) AND empty( $id_featured_image ) ) {
                    $validator->set_error_message( 'featured_image', __( "The Featured Image field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_gallery' ) ) {
                    $validator->set_error_message( 'gallery', __( "The Gallery field is required.", ST_TEXTDOMAIN ) );
                }

                $validator->set_rules( 'address', __( "Address", ST_TEXTDOMAIN ), 'required|max_length[100]' );

                $validator->set_rules( 'gmap[zoom]', __( "Zoom", ST_TEXTDOMAIN ), 'required|numeric' );

                $validator->set_rules( 'rental_number', __( "Number", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                $validator->set_rules( 'rental_max_adult', __( "Max of Adult", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                $validator->set_rules( 'rental_max_children', __( "Max of Children", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                $validator->set_rules( 'phone', __( "Phone", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'video', __( "Video", ST_TEXTDOMAIN ), 'valid_url' );
                $validator->set_rules( 'email', __( "Email", ST_TEXTDOMAIN ), 'valid_email' );
                $validator->set_rules( 'website', __( "Website", ST_TEXTDOMAIN ), 'valid_url' );

                $validator->set_rules( 'price', __( "Price", ST_TEXTDOMAIN ), 'required|is_numeric' );
                $validator->set_rules( 'discount', __( "Discount", ST_TEXTDOMAIN ), 'unsigned_integer' );
                if ( STInput::request( 'is_sale_schedule' ) == 'on' ) {
                    $validator->set_rules( 'sale_price_from', __( "Sale Start Date", ST_TEXTDOMAIN ), 'required' );
                    $validator->set_rules( 'sale_price_to', __( "Sale End Date", ST_TEXTDOMAIN ), 'required' );
                }
                if ( STInput::request( 'deposit_payment_status' ) != '' ) {
                    $validator->set_rules( 'deposit_payment_amount', __( "Deposit Amount", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                    $deposit_payment_status = STInput::request( 'deposit_payment_status' );
                    $deposit_payment_amount = STInput::request( 'deposit_payment_amount' );
                    $partner_commission     = st()->get_option( 'partner_commission', '0' );
                    if ( $deposit_payment_status == "percent" ) {
                        if ( $deposit_payment_amount <= $partner_commission ) {
                            $validator->set_error_message( 'deposit_payment_amount', __( "The commission does not match the criteria.", ST_TEXTDOMAIN ) );
                        }
                    }
                }
                $validator->set_rules( 'rentals_booking_period', __( "Booking Period", ST_TEXTDOMAIN ), 'unsigned_integer' );
                $validator->set_rules( 'rentals_booking_min_day', __( "Minimum day", ST_TEXTDOMAIN ), 'unsigned_integer' );

                if ( STInput::request( 'st_rental_external_booking' ) == 'on' ) {
                    $validator->set_rules( 'st_rental_external_booking_link', __( "External Booking URL", ST_TEXTDOMAIN ), 'required|valid_url' );
                }
                // /is_featured
                $admin_packages   = STAdminPackages::get_inst();
                $num_set_featured = $admin_packages->count_item_can_featured( get_current_user_id(), STInput::get( 'id', '' ) );
                if ( $admin_packages->enabled_membership() ) {
                    if ( $admin_packages->get_user_role() == 'partner' && ( $num_set_featured !== 'unlimited' && $num_set_featured <= 0 ) && STInput::request( 'is_featured', 'off' ) == 'on' ) {
                        STTemplate::set_message( sprintf( __( "You cannot set featured for this rental. Your remaining item is %s (items)", ST_TEXTDOMAIN ), $num_set_featured ), 'warning' );

                        return false;
                    }
                }


                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );

                    return false;
                }

                return true;
            }

            /* Update Rental */
            function st_update_post_type_rental()
            {
                if ( !st_check_service_available( 'st_rental' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_post_rental', '' ), 'user_setting' ) ) {
                    if ( self::validate_rental() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_rental' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();
                        $my_post      = [
                            'post_title'   => STInput::request( 'st_title', 'Title' ),
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'st_rental',
                            'post_excerpt' => '',
                        ];
                        $post_id      = wp_insert_post( $my_post );
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_rental' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }
                    if ( !empty( $post_id ) ) {
                        $st_content = STInput::request( 'st_content' );
                        $my_post    = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title' ),
                            'post_content' => stripslashes( $st_content ),
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );
                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );

                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );

                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        /////////////////////////////////////
                        /// Update Muti location
                        /////////////////////////////////////
                        if ( isset( $_REQUEST[ 'multi_location' ] ) ) {
                            $location = $_REQUEST[ 'multi_location' ];
                            if ( is_array( $location ) && count( $location ) ) {
                                $location_str = '';
                                foreach ( $location as $item ) {
                                    if ( empty( $location_str ) ) {
                                        $location_str .= $item;
                                    } else {
                                        $location_str .= ',' . $item;
                                    }
                                }
                            } else {
                                $location_str = '';
                            }
                            update_post_meta( $post_id, 'multi_location', $location_str );
                            update_post_meta( $post_id, 'location_id', '' );
                        }
                        //tab rental info
                        update_post_meta( $post_id, 'is_featured', STInput::request( 'is_featured' ) );
                        update_post_meta( $post_id, 'rental_number', STInput::request( 'rental_number' ) );
                        update_post_meta( $post_id, 'custom_layout', STInput::request( 'st_custom_layout' ) );
                        update_post_meta( $post_id, 'rental_max_adult', STInput::request( 'rental_max_adult' ) );
                        update_post_meta( $post_id, 'rental_max_children', STInput::request( 'rental_max_children' ) );
                        update_post_meta( $post_id, 'video', STInput::request( 'video' ) );
                        //tab agent info
                        update_post_meta( $post_id, 'agent_email', STInput::request( 'email' ) );
                        update_post_meta( $post_id, 'agent_website', STInput::request( 'website' ) );
                        update_post_meta( $post_id, 'agent_phone', STInput::request( 'phone' ) );
                        update_post_meta( $post_id, 'st_fax', STInput::request( 'st_fax' ) );
                        update_post_meta( $post_id, 'show_agent_contact_info', STInput::request( 'show_agent_contact_info' ) );
                        update_post_meta( $post_id, 'st_allow_cancel', STInput::request( 'st_allow_cancel' ) );
                        update_post_meta( $post_id, 'st_cancel_number_days', STInput::request( 'st_cancel_number_days' ) );
                        update_post_meta( $post_id, 'st_cancel_percent', STInput::request( 'st_cancel_percent' ) );

                        //tab price
                        update_post_meta( $post_id, 'price', STInput::request( 'price' ) );
                        update_post_meta( $post_id, 'discount_rate', (int)STInput::request( 'discount' ) );
                        update_post_meta( $post_id, 'is_sale_schedule', STInput::request( 'is_sale_schedule' ) );

                        $sale_price_from = TravelHelper::convertDateFormat( STInput::request( 'sale_price_from' ) );
                        $sale_price_from = date( 'Y-m-d', strtotime( $sale_price_from ) );
                        update_post_meta( $post_id, 'sale_price_from', $sale_price_from );
                        $sale_price_to = TravelHelper::convertDateFormat( STInput::request( 'sale_price_to' ) );
                        $sale_price_to = date( 'Y-m-d', strtotime( $sale_price_to ) );
                        update_post_meta( $post_id, 'sale_price_to', $sale_price_to );

                        update_post_meta( $post_id, 'deposit_payment_status', STInput::request( 'deposit_payment_status' ) );
                        update_post_meta( $post_id, 'deposit_payment_amount', STInput::request( 'deposit_payment_amount' ) );
                        update_post_meta( $post_id, 'discount_type_no_day', STInput::request( 'discount_type_no_day' ) );
                        //tab other options
                        update_post_meta( $post_id, 'allow_full_day', STInput::request( 'allow_full_day', 'off' ) );
                        update_post_meta( $post_id, 'rentals_booking_period', (int)STInput::request( 'rentals_booking_period' ) );
                        update_post_meta( $post_id, 'rentals_booking_min_day', (int)STInput::request( 'rentals_booking_min_day' ) );
                        update_post_meta( $post_id, 'st_rental_external_booking', STInput::request( 'st_rental_external_booking' ) );
                        update_post_meta( $post_id, 'st_rental_external_booking_link', STInput::request( 'st_rental_external_booking_link' ) );
                        //tab location settings
                        update_post_meta( $post_id, 'address', STInput::request( 'address' ) );
                        $gmap = STInput::request( 'gmap' );
                        update_post_meta( $post_id, 'map_lat', $gmap[ 'lat' ] );
                        update_post_meta( $post_id, 'map_lng', $gmap[ 'lng' ] );
                        update_post_meta( $post_id, 'map_zoom', $gmap[ 'zoom' ] );
                        update_post_meta( $post_id, 'map_type', $gmap[ 'type' ] );

                        update_post_meta( $post_id, 'st_google_map', $gmap );
                        update_post_meta( $post_id, 'enable_street_views_google_map', STInput::request( 'enable_street_views_google_map' ) );
                        /////////////////////////////////////
                        /// Update Payment
                        /////////////////////////////////////
                        $data_paypment = STPaymentGateways::$_payment_gateways;
                        if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                            foreach ( $data_paypment as $k => $v ) {
                                update_post_meta( $post_id, 'is_meta_payment_gateway_' . $k, STInput::request( 'is_meta_payment_gateway_' . $k ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = $_REQUEST[ 'taxonomy' ];
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }
                        // Update extra
                        $extra = STInput::request( 'extra', '' );
                        if ( isset( $extra[ 'title' ] ) && is_array( $extra[ 'title' ] ) && count( $extra[ 'title' ] ) ) {
                            $list_extras = [];
                            foreach ( $extra[ 'title' ] as $key => $val ) {
                                if ( !empty( $val ) ) {
                                    $list_extras[ $key ] = [
                                        'title'            => $val,
                                        'extra_name'       => isset( $extra[ 'extra_name' ][ $key ] ) ? $extra[ 'extra_name' ][ $key ] : '',
                                        'extra_max_number' => isset( $extra[ 'extra_max_number' ][ $key ] ) ? $extra[ 'extra_max_number' ][ $key ] : '',
                                        'extra_price'      => isset( $extra[ 'extra_price' ][ $key ] ) ? $extra[ 'extra_price' ][ $key ] : ''
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'extra_price', $list_extras );
                        } else {
                            update_post_meta( $post_id, 'extra_price', '' );
                        }

                        // Update discount by number day
                        $discount_by_day = STInput::request( 'discount_by_day', '' );
                        if ( isset( $discount_by_day[ 'title' ] ) && is_array( $discount_by_day[ 'title' ] ) && count( $discount_by_day[ 'title' ] ) ) {
                            $list_discount_by_day = [];
                            foreach ( $discount_by_day[ 'title' ] as $key => $val ) {
                                if ( !empty( $val ) ) {
                                    $list_discount_by_day[ $key ] = [
                                        'title'      => $val,
                                        'number_day' => isset( $discount_by_day[ 'number_day' ][ $key ] ) ? $discount_by_day[ 'number_day' ][ $key ] : '',
                                        'discount'   => isset( $discount_by_day[ 'discount' ][ $key ] ) ? $discount_by_day[ 'discount' ][ $key ] : '',
                                    ];
                                }
                            }
                            update_post_meta( $post_id, 'discount_by_day', $list_discount_by_day );
                        } else {
                            update_post_meta( $post_id, 'discount_by_day', '' );
                        }

                        /**
                         * @since 1.3.1
                         **/
                        /*---- Properties*/
                        $properties = STInput::post( 'property-item', '' );
                        if ( !empty( $properties ) ) {
                            $list = [];
                            for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                    $list[] = [
                                        'title'          => $properties[ 'title' ][ $i ],
                                        'featured_image' => $properties[ 'featured_image' ][ $i ],
                                        'description'    => $properties[ 'description' ][ $i ],
                                        'icon'           => $properties[ 'icon' ][ $i ],
                                        'map_lat'        => $properties[ 'map_lat' ][ $i ],
                                        'map_lng'        => $properties[ 'map_lng' ][ $i ],
                                    ];
                                }

                            }
                            update_post_meta( $post_id, 'properties_near_by', $list );
                        }

                        /* Rental Closest */
                        $properties = STInput::post( 'rdistance-item', '' );
                        if ( !empty( $properties ) ) {
                            $list = [];
                            for ( $i = 0; $i < count( $properties[ 'title' ] ); $i++ ) {
                                if ( !empty( $properties[ 'title' ][ $i ] ) ) {
                                    $list[] = [
                                        'title'    => $properties[ 'title' ][ $i ],
                                        'icon'     => $properties[ 'icon' ][ $i ],
                                        'name'     => $properties[ 'name' ][ $i ],
                                        'distance' => $properties[ 'distance' ][ $i ],
                                    ];
                                }

                            }
                            update_post_meta( $post_id, 'distance_closest', $list );
                        }

                        /////////////////////////////////////
                        /// Update custom flied
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'rental_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }

                        self::$msg = [
                            'status' => 'success',
                            'msg'    => 'Update rental successfully !'
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-rental', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }
                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => 'Error : Update rental not successfully !'
                        ];
                    }
                }
            }

            function validate_rental_room()
            {

                if ( !st_check_service_available( 'rental_room' ) ) {
                    return;
                }

                if ( !empty( $_FILES[ 'featured-image' ][ 'name' ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $featured_image                  = $_FILES[ 'featured-image' ];
                    $id_featured_image               = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                    $_REQUEST[ 'id_featured_image' ] = $id_featured_image;
                }
                if ( !empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) and STInput::request( 'action_partner' ) == 'add_partner' ) {
                    $gallery = $_FILES[ 'gallery' ];
                    if ( !empty( $gallery ) ) {
                        $tmp_array = [];
                        for ( $i = 0; $i < count( $gallery[ 'name' ] ); $i++ ) {
                            array_push( $tmp_array, [
                                'name'     => $gallery[ 'name' ][ $i ],
                                'type'     => $gallery[ 'type' ][ $i ],
                                'tmp_name' => $gallery[ 'tmp_name' ][ $i ],
                                'error'    => $gallery[ 'error' ][ $i ],
                                'size'     => $gallery[ 'size' ][ $i ]
                            ] );
                        }
                    }
                    $id_gallery = '';
                    foreach ( $tmp_array as $k => $v ) {
                        $_FILES[ 'gallery' ] = $v;
                        $id_gallery          .= self::upload_image_return( $_FILES[ 'gallery' ], 'gallery', $_FILES[ 'gallery' ][ 'type' ] ) . ',';
                    }
                    $id_gallery               = substr( $id_gallery, 0, -1 );
                    $_REQUEST[ 'id_gallery' ] = $id_gallery;
                }

                $validator = self::$validator;
                /// Location ///
                $validator->set_rules( 'st_title', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );
                $validator->set_rules( 'st_content', __( "Content", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'st_desc', __( "Description", ST_TEXTDOMAIN ), 'required' );
                $id_featured_image = STInput::request( 'id_featured_image' );
                if ( empty( $_FILES[ 'featured-image' ][ 'name' ] ) AND empty( $id_featured_image ) ) {
                    $validator->set_error_message( 'featured_image', __( "The Featured Image field is required.", ST_TEXTDOMAIN ) );
                }
                if ( empty( $_FILES[ 'gallery' ][ 'name' ][ 0 ] ) AND !STInput::request( 'id_gallery' ) ) {
                    $validator->set_error_message( 'gallery', __( "The Gallery field is required.", ST_TEXTDOMAIN ) );
                }
                $validator->set_rules( 'room_parent', __( "Select Rental", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                $validator->set_rules( 'adult_number', __( "Adults Number", ST_TEXTDOMAIN ), 'required|unsigned_integer|greater_than[0]' );
                $validator->set_rules( 'children_number', __( "Children Number", ST_TEXTDOMAIN ), 'required|unsigned_integer' );
                $validator->set_rules( 'bed_number', __( "Beds Number", ST_TEXTDOMAIN ), 'required|unsigned_integer|greater_than[0]' );
                $validator->set_rules( 'room_footage', __( "Room footage", ST_TEXTDOMAIN ), 'required|unsigned_integer|greater_than[0]' );
                $validator->set_rules( 'room_description', __( "Description", ST_TEXTDOMAIN ), 'required' );
                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );

                    return false;
                }

                return true;
            }

            /* Rental room */
            function st_update_rental_room()
            {
                if ( !st_check_service_available( 'rental_room' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_rental_room', '' ), 'user_setting' ) ) {
                    if ( self::validate_rental_room() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_rental_room' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }

                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_rental_room' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();

                        $my_post = [
                            'post_title'   => STInput::request( 'st_title', 'Title' ),
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'rental_room',
                            'post_excerpt' => '',
                        ];
                        $post_id = wp_insert_post( $my_post );
                    }
                    if ( !empty( $post_id ) ) {
                        $st_content = STInput::request( 'st_content' );
                        $my_post    = [
                            'ID'           => $post_id,
                            'post_title'   => STInput::request( 'st_title' ),
                            'post_content' => stripslashes( $st_content ),
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );
                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );

                        $thumbnail = (int)STInput::request( 'id_featured_image', '' );
                        set_post_thumbnail( $post_id, $thumbnail );

                        $gallery = STInput::request( 'id_gallery', '' );
                        update_post_meta( $post_id, 'gallery', $gallery );
                        /////////////////////////////////////
                        /// Update Meta Box
                        /////////////////////////////////////
                        update_post_meta( $post_id, 'st_custom_layout', STInput::request( 'st_custom_layout' ) );
                        update_post_meta( $post_id, 'room_parent', STInput::request( 'room_parent' ) );
                        update_post_meta( $post_id, 'adult_number', STInput::request( 'adult_number' ) );
                        update_post_meta( $post_id, 'children_number', STInput::request( 'children_number' ) );
                        update_post_meta( $post_id, 'bed_number', STInput::request( 'bed_number' ) );
                        update_post_meta( $post_id, 'room_footage', STInput::request( 'room_footage' ) );
                        $add_new_facility_title = STInput::request( 'add_new_facility_title' );
                        $add_new_facility_value = STInput::request( 'add_new_facility_value' );
                        $add_new_facility_icon  = STInput::request( 'add_new_facility_icon' );
                        if ( !empty( $add_new_facility_title ) ) {
                            $data = [];
                            foreach ( $add_new_facility_title as $k => $v ) {
                                $data[] = [ 'title' => $v, 'value' => $add_new_facility_value[ $k ], 'facility_icon' => $add_new_facility_icon[ $k ] ];
                            }
                            update_post_meta( $post_id, 'add_new_facility', $data );
                        }
                        update_post_meta( $post_id, 'room_description', stripslashes( STInput::request( 'room_description' ) ) );
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = $_REQUEST[ 'taxonomy' ];
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }
                        /////////////////////////////////////
                        /// Update custom_field
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'rental_room_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }

                        self::$msg = [
                            'status' => 'success',
                            'msg'    => __( 'Update rental room successfully !', ST_TEXTDOMAIN )
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-room-rental', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }
                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => __( 'Error : Update rental room not successfully !', ST_TEXTDOMAIN )
                        ];
                    }
                }
            }

            function validate_flight()
            {
                if ( !st_check_service_available( 'st_flight' ) ) {
                    return false;
                }

                $validator = self::$validator;
                $validator->set_rules( 'st_title', __( "Title", ST_TEXTDOMAIN ), 'required|min_length[6]|max_length[100]' );
                $validator->set_rules( 'airline', __( "Airline Company", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'origin', __( "Origin", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'destination', __( "Destination", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'departure_time', __( "Departure time", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'total_time', __( "Total time", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'flight_type', __( "Flight Type", ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'enable_tax', __( "Enable Tax", ST_TEXTDOMAIN ), 'required' );
                if ( STInput::request( 'enable_tax' ) == 'yes_not_included' ) {
                    $validator->set_rules( 'vat_amount', __( "Tax Percent", ST_TEXTDOMAIN ), 'required|numeric' );
                }

                $result = $validator->run();
                if ( !$result ) {
                    STTemplate::set_message( __( "Warning: Some fields must be filled in", ST_TEXTDOMAIN ), 'warning' );

                    return false;
                }

                return true;
            }

            /**
             * Since 1.4.7
             */
            function st_update_post_type_flight()
            {
                if ( !st_check_service_available( 'st_flight' ) ) {
                    return;
                }
                if ( wp_verify_nonce( STInput::request( 'st_update_post_flight', '' ), 'user_setting' ) ) {
                    if ( $this->validate_flight() == false ) {
                        return;
                    }
                    if ( !empty( $_REQUEST[ 'btn_update_post_type_flight' ] ) ) {
                        $post_id = STInput::request( 'id' );
                    }

                    if ( !empty( $_REQUEST[ 'btn_insert_post_type_flight' ] ) ) {
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'on' ) {
                            $post_status = 'draft';
                        } else {
                            $post_status = 'publish';
                        }
                        if ( current_user_can( 'manage_options' ) ) {
                            $post_status = 'publish';
                        }
                        if ( STInput::request( 'save_and_preview' ) == "true" ) {
                            $post_status = 'draft';
                        }
                        $current_user = wp_get_current_user();

                        $my_post = [
                            'post_title'   => STInput::request( 'st_title', 'Title' ),
                            'post_content' => '',
                            'post_status'  => $post_status,
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'st_flight',
                            'post_excerpt' => '',
                        ];
                        $post_id = wp_insert_post( $my_post );
                    }
                    if ( !empty( $post_id ) ) {
                        $my_post = [
                            'ID'         => $post_id,
                            'post_title' => STInput::request( 'st_title' )
                        ];
                        if ( st()->get_option( 'partner_post_by_admin', 'on' ) == 'off' ) {
                            $my_post[ 'post_status' ] = 'publish';
                        }

                        $admin_packages     = STAdminPackages::get_inst();
                        $set_status_publish = $admin_packages->count_item_can_public_status( get_current_user_id(), $post_id );
                        if ( $admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner' && ( $set_status_publish !== 'unlimited' && $set_status_publish <= 0 ) ) {
                            $my_post[ 'post_status' ] = 'draft';
                        }

                        wp_update_post( $my_post );

                        //Update metabox
                        update_post_meta( $post_id, 'airline', STInput::request( 'airline' ) );
                        if ( $airline = STInput::request( 'airline' ) ) {
                            wp_set_post_terms( $post_id, $airline, 'st_airline' );
                        }

                        update_post_meta( $post_id, 'origin', STInput::request( 'origin' ) );
                        update_post_meta( $post_id, 'destination', STInput::request( 'destination' ) );
                        update_post_meta( $post_id, 'departure_time', STInput::request( 'departure_time' ) );
                        update_post_meta( $post_id, 'total_time', STInput::request( 'total_time' ) );
                        update_post_meta( $post_id, 'flight_type', STInput::request( 'flight_type' ) );
                        update_post_meta( $post_id, 'airport_stop', STInput::request( 'airport_stop' ) );
                        update_post_meta( $post_id, 'airline_stop', STInput::request( 'airline_stop' ) );
                        update_post_meta( $post_id, 'arrival_stop', STInput::request( 'arrival_stop' ) );
                        update_post_meta( $post_id, 'st_stopover_time', STInput::request( 'st_stopover_time' ) );
                        update_post_meta( $post_id, 'departure_stop', STInput::request( 'departure_stop' ) );
                        update_post_meta( $post_id, 'airport_stop_1', STInput::request( 'airport_stop_1' ) );
                        update_post_meta( $post_id, 'airline_stop_1', STInput::request( 'airline_stop_1' ) );
                        update_post_meta( $post_id, 'arrival_stop_1', STInput::request( 'arrival_stop_1' ) );
                        update_post_meta( $post_id, 'st_stopover_time_1', STInput::request( 'st_stopover_time_1' ) );
                        update_post_meta( $post_id, 'airport_stop_2', STInput::request( 'airport_stop_2' ) );
                        update_post_meta( $post_id, 'airline_stop2', STInput::request( 'airline_stop2' ) );
                        update_post_meta( $post_id, 'arrival_stop_2', STInput::request( 'arrival_stop_2' ) );
                        update_post_meta( $post_id, 'st_stopover_time_2', STInput::request( 'st_stopover_time_2' ) );
                        update_post_meta( $post_id, 'departure_stop_2', STInput::request( 'departure_stop_2' ) );
                        update_post_meta( $post_id, 'max_ticket', STInput::request( 'max_ticket' ) );
                        update_post_meta( $post_id, 'enable_tax', STInput::request( 'enable_tax' ) );
                        update_post_meta( $post_id, 'vat_amount', STInput::request( 'vat_amount' ) );

                        $flight        = ST_Flights_Models::inst();
                        $location_from = get_tax_meta( STInput::request( 'origin' ), 'location_id' );
                        $location_to   = get_tax_meta( STInput::request( 'destination' ), 'location_id' );
                        if ( $flight->get_data( $post_id ) ) {
                            $data = [
                                'iata_from'      => STInput::request( 'origin' ),
                                'location_from'  => $location_from,
                                'iata_to'        => STInput::request( 'destination' ),
                                'location_to'    => $location_to,
                                'flight_type'    => STInput::request( 'flight_type' ),
                                'max_ticket'     => STInput::request( 'max_ticket' ),
                                'departure_time' => st_flight_convert_time_to_str( STInput::request( 'departure_time' ) ),
                                'airline'        => STInput::request( 'airline' )
                            ];

                            $flight->update_data( $data, [ 'post_id' => $post_id ] );
                        } else {
                            $data = [
                                'post_id'        => $post_id,
                                'iata_from'      => STInput::request( 'origin' ),
                                'location_from'  => $location_from,
                                'iata_to'        => STInput::request( 'destination' ),
                                'location_to'    => $location_to,
                                'flight_type'    => STInput::request( 'flight_type' ),
                                'max_ticket'     => STInput::request( 'max_ticket' ),
                                'departure_time' => st_flight_convert_time_to_str( STInput::request( 'departure_time' ) ),
                                'airline'        => STInput::request( 'airline' )
                            ];

                            $flight->insert_data( $data );
                        }

                        /////////////////////////////////////
                        /// Update Payment
                        /////////////////////////////////////
                        $data_paypment = STPaymentGateways::$_payment_gateways;
                        if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                            foreach ( $data_paypment as $k => $v ) {
                                update_post_meta( $post_id, 'is_meta_payment_gateway_' . $k, STInput::request( 'is_meta_payment_gateway_' . $k ) );
                            }
                        }
                        /////////////////////////////////////
                        /// Update taxonomy
                        /////////////////////////////////////
                        if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                            if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                                $taxonomy = $_REQUEST[ 'taxonomy' ];
                                if ( !empty( $taxonomy ) ) {
                                    $tax = [];
                                    foreach ( $taxonomy as $item ) {
                                        $tmp                = explode( ",", $item );
                                        $tax[ $tmp[ 1 ] ][] = $tmp[ 0 ];
                                    }
                                    foreach ( $tax as $key2 => $val2 ) {
                                        wp_set_post_terms( $post_id, $val2, $key2 );
                                    }
                                }
                            }
                        }
                        /////////////////////////////////////
                        /// Update custom_field
                        /////////////////////////////////////
                        $custom_field = st()->get_option( 'flight_unlimited_custom_field' );
                        if ( !empty( $custom_field ) ) {
                            foreach ( $custom_field as $k => $v ) {
                                $key = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                                update_post_meta( $post_id, $key, STInput::request( $key ) );
                            }
                        }

                        self::$msg = [
                            'status' => 'success',
                            'msg'    => __( 'Update flight successfully !', ST_TEXTDOMAIN )
                        ];

                        if ( STInput::get( 'id', '' ) == '' ) {
                            $page_my_account_dashboard = st()->get_option( 'page_my_account_dashboard' );
                            if ( !empty( $page_my_account_dashboard ) ) {
                                wp_redirect( add_query_arg( [ 'sc' => 'my-flights', 'create' => 'true' ], get_the_permalink( $page_my_account_dashboard ) ) );
                                exit;
                            }
                        }
                    } else {
                        self::$msg = [
                            'status' => 'danger',
                            'msg'    => __( 'Error : Update flight not successfully !', ST_TEXTDOMAIN )
                        ];
                    }
                }
            }
            /**
             * Since 1.1.0
             */
            /* Location */
            function st_insert_post_type_location()
            {
                if ( !empty( $_REQUEST[ 'btn_insert_post_type_location' ] ) ) {
                    if ( wp_verify_nonce( $_REQUEST[ 'st_insert_post_location' ], 'user_setting' ) ) {
                        $current_user = wp_get_current_user();
                        $title        = STInput::request( 'st_title' );
                        $st_content   = $_REQUEST[ 'st_content' ];
                        $desc         = STInput::request( 'st_desc' );
                        $post_parent  = $_REQUEST[ 'post_parent' ];
                        $my_post      = [
                            'post_title'   => $title,
                            'post_content' => stripslashes( $st_content ),
                            'post_status'  => "publish",
                            'post_author'  => $current_user->ID,
                            'post_type'    => 'location',
                            'post_excerpt' => stripslashes( STInput::request( 'st_desc' ) ),
                            'post_parent'  => $post_parent
                        ];
                        $post_id      = wp_insert_post( $my_post );
                        if ( !empty( $post_id ) ) {
                            $featured_image    = $_FILES[ 'featured-image' ];
                            $id_featured_image = self::upload_image_return( $featured_image, 'featured-image', $featured_image[ 'type' ] );
                            set_post_thumbnail( $post_id, $id_featured_image );

                            $logo    = $_FILES[ 'logo' ];
                            $id_logo = self::upload_image_return( $logo, 'logo', $logo[ 'type' ] );
                            update_post_meta( $post_id, 'logo', $id_logo );

                            update_post_meta( $post_id, 'zipcode', $_REQUEST[ 'zipcode' ] );
                            update_post_meta( $post_id, 'map_lat', $_REQUEST[ 'map_lat' ] );
                            update_post_meta( $post_id, 'map_lng', $_REQUEST[ 'map_lng' ] );
                            update_post_meta( $post_id, 'is_featured', $_REQUEST[ 'is_featured' ] );

                            self::$msg = [
                                'status' => 'success',
                                'msg'    => __( 'Create Location successfully !', ST_TEXTDOMAIN )
                            ];
                        } else {
                            self::$msg = [
                                'status' => 'danger',
                                'msg'    => __( 'Error : Create Location not successfully !', ST_TEXTDOMAIN )
                            ];
                        }

                    }
                }
            }

            public function _get_join( $join )
            {
                global $wpdb;
                $type = isset( $_SESSION[ 'type_booking' ] ) ? $_SESSION[ 'type_booking' ] : '';

                $join .= " INNER JOIN {$wpdb->prefix}postmeta as mt ON {$wpdb->prefix}posts.ID = mt.post_id AND mt.meta_key = 'id_user' ";
                $join .= " INNER JOIN {$wpdb->prefix}postmeta as mt1 ON {$wpdb->prefix}posts.ID = mt1.post_id AND mt1.meta_key = 'st_email' ";
                $join .= " INNER JOIN {$wpdb->prefix}postmeta as mt2 ON {$wpdb->prefix}posts.ID = mt2.post_id ";
                if ( !empty( $type ) ) {
                    $join .= " INNER JOIN {$wpdb->prefix}postmeta as mt3 ON {$wpdb->prefix}posts.ID = mt3.post_id AND mt3.meta_key = 'status'";
                }

                return $join;
            }

            public function _get_where( $where )
            {
                global $wpdb;

                global $current_user;

                $type = isset( $_SESSION[ 'type_booking' ] ) ? $_SESSION[ 'type_booking' ] : '';

                //get_bloginfo('version');
                //get_currentuserinfo();
                $user_id    = $current_user->ID;
                $user_email = $current_user->user_email;

                $data_type = STInput::request( 'data_type', '' );

                $where .= " AND ((CAST(mt.meta_value AS UNSIGNED) = '{$user_id}')";

                $where .= " OR (mt2.meta_key = 'booking_by'
            AND mt2.meta_value = 'admin' AND mt1.meta_value = '{$user_email}')";

                $where .= " OR (mt2.meta_key = 'booking_by'
            AND mt2.meta_value = 'partner' AND mt1.meta_value = '{$user_email}'))";

                if ( !empty( $type ) ) {
                    $where .= " AND mt3.meta_value = '{$type}'";
                }

                return $where;
            }

            public function _get_distinct()
            {
                return 'DISTINCT';
            }

            /* book history */


            static function _get_currency_book_history( $post_id )
            {
                $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                if ( $st_is_woocommerce_checkout ) {
                    global $wpdb;
                    $querystr    = "SELECT meta_value FROM  " . $wpdb->prefix . "woocommerce_order_itemmeta
                                    WHERE
                                    1=1
                                    AND order_item_id = '{$post_id}'
                                    AND meta_key = '_st_currency'";
                    $st_currency = $wpdb->get_row( $querystr, OBJECT );
                    if ( !empty( $st_currency->meta_value ) ) {
                        return $st_currency->meta_value;
                    }
                } else {
                    $currency = get_post_meta( $post_id, 'currency', true );

                    if ( !empty( $currency ) ) {
                        return $currency[ 'symbol' ];
                    } else {
                        return '';
                    }
                }
            }

            static function _get_order_statuses()
            {

                $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                $order_statuses             = [];
                if ( $st_is_woocommerce_checkout ) {
                    if ( function_exists( 'wc_get_order_statuses' ) ) {
                        $order_statuses = wc_get_order_statuses();
                    }
                } else {
                    $order_statuses = [
                        'pending'    => __( 'Pending', ST_TEXTDOMAIN ),
                        'complete'   => __( 'Completed', ST_TEXTDOMAIN ),
                        'incomplete' => __( 'Incomplete', ST_TEXTDOMAIN ),
                        'canceled'   => __( 'Cancelled', ST_TEXTDOMAIN ),
                    ];
                }

                return apply_filters( 'st_order_statuses', $order_statuses );
            }

            static function _get_order_total_price( $post_id, $st_is_woocommerce_checkout = null )
            {
                if ( $st_is_woocommerce_checkout === null )
                    $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );

                if ( $st_is_woocommerce_checkout ) {
                    global $wpdb;
                    $querystr   = "SELECT meta_value FROM  " . $wpdb->prefix . "woocommerce_order_itemmeta
                                    WHERE
                                    1=1
                                    AND order_item_id = '{$post_id}'
                                    AND (
                                        meta_key = '_line_total'
                                        OR meta_key = '_line_tax'
                                        OR meta_key = '_st_booking_fee_price'
                                    )
                                    ";
                    $price      = $wpdb->get_results( $querystr, OBJECT );
                    $data_price = 0;
                    if ( !empty( $price ) ) {
                        foreach ( $price as $k => $v ) {
                            $data_price += $v->meta_value;
                        }
                    }

                    return $data_price;
                } else {
                    return get_post_meta( $post_id, 'total_price', true );
                }
            }

            static function _get_price_item_order_woo( $order_woo_id )
            {
                global $wpdb;
                $querystr   = "SELECT meta_value 

                                    FROM  " . $wpdb->prefix . "woocommerce_order_itemmeta
                                    WHERE
                                    1=1
                                    AND order_item_id = '{$order_woo_id}'
                                    AND (
                                        meta_key = '_line_total'
                                        OR meta_key = '_line_tax'
                                    )
                                    ORDER BY meta_key DESC
                                    ";
                $price      = $wpdb->get_results( $querystr, ARRAY_A );
                $data_price = [];
                if ( !empty( $price ) ) {
                    $data_price = $price;
                }

                return $data_price;
            }

            static function _get_all_order_statuses()
            {
                $order_statuses = [
                    'pending'    => __( 'Pending', ST_TEXTDOMAIN ),
                    'complete'   => __( 'Completed', ST_TEXTDOMAIN ),
                    'incomplete' => __( 'Incomplete', ST_TEXTDOMAIN ),
                    'canceled'   => __( 'Cancelled', ST_TEXTDOMAIN ),
                ];
                if ( function_exists( 'wc_get_order_statuses' ) ) {
                    $order_statuses_woo = wc_get_order_statuses();
                    $order_statuses     = array_merge( $order_statuses, $order_statuses_woo );
                }

                return apply_filters( 'st_order_statuses', $order_statuses );
            }


            function get_book_history( $status = '' )
            {
                $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                if ( $st_is_woocommerce_checkout ) {
                    $paged = 1;
                    $limit = 10;
                    if ( !empty( $_REQUEST[ 'paged' ] ) ) {
                        $paged = $_REQUEST[ 'paged' ];
                    }
                    $offset = ( $paged - 1 ) * $limit;
                    global $wpdb;
                    $where = "";
                    if ( !empty( $status ) ) {
                        $where .= " AND status = '" . $status . "' ";
                    }
                    if ( !empty( $_REQUEST[ 'data_type' ] ) ) {
                        $where .= " AND status = '" . $_REQUEST[ 'data_type' ] . "' ";
                    }
                    $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                    if ( $st_is_woocommerce_checkout ) {
                        $where .= " AND type = 'woocommerce' ";
                    } else {
                        $where .= " AND type = 'normal_booking' ";
                    }

                    $where_user = " AND user_id = " . get_current_user_id();

                    $querystr  = "SELECT SQL_CALC_FOUND_ROWS * FROM
                                       " . $wpdb->prefix . "st_order_item_meta
                                                            WHERE 1=1 {$where_user}
                                                            {$where} 
                         ORDER BY " . $wpdb->prefix . "st_order_item_meta.id DESC LIMIT {$offset},{$limit}
            ";
                    $pageposts = $wpdb->get_results( $querystr, OBJECT );
                    $html      = '';
                } else {
                    $paged = 1;
                    $limit = 10;
                    if ( !empty( $_REQUEST[ 'paged' ] ) ) {
                        $paged = $_REQUEST[ 'paged' ];
                    }
                    $offset = ( $paged - 1 ) * $limit;
                    global $wpdb;
                    $where = "";
                    if ( !empty( $status ) ) {
                        //$where .= " AND status = '" . $status . "' ";
                        $where .= " AND pm.meta_value = '" . $status . "' ";
                    }
                    if ( !empty( $_REQUEST[ 'data_type' ] ) ) {
                        //$where .= " AND status = '" . $_REQUEST['data_type'] . "' ";
                        $where .= " AND pm.meta_value = '" . $_REQUEST[ 'data_type' ] . "' ";
                    }
                    $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                    if ( $st_is_woocommerce_checkout ) {
                        $where .= " AND type = 'woocommerce' ";
                    } else {
                        $where .= " AND type = 'normal_booking' ";
                    }

                    $where_user = " AND user_id = " . get_current_user_id();

                    if ( $status == '' ) {
                        $querystr = "SELECT SQL_CALC_FOUND_ROWS * FROM
                                       " . $wpdb->prefix . "st_order_item_meta
                                                            WHERE 1=1 {$where_user} {$where}
                         ORDER BY " . $wpdb->prefix . "st_order_item_meta.id DESC LIMIT {$offset},{$limit}";
                    } else {
                        $querystr = "SELECT SQL_CALC_FOUND_ROWS * FROM
                                       " . $wpdb->prefix . "st_order_item_meta st INNER JOIN " . $wpdb->prefix . "postmeta pm ON st.order_item_id = pm.post_id
                                                            WHERE 1=1 {$where_user}
                                                            {$where}
                         ORDER BY st.id DESC LIMIT {$offset},{$limit}
                ";
                    }
                    $pageposts = $wpdb->get_results( $querystr, OBJECT );
                    $html      = '';
                }


                if ( !empty( $pageposts ) ) {
                    foreach ( $pageposts as $key => $value ) {
                        $id_item = $value->st_booking_id;
                        /////////////////// REVIEW //////////////////

                        $action        = '';
                        $action_cancel = '';

                        $user_url          = st()->get_option( 'page_my_account_dashboard' );
                        $data[ 'sc' ]      = 'write_review';
                        $data[ 'item_id' ] = $id_item;

                        if ( STReview::review_check( $id_item ) == 'true' ) {
                            $action = '<a class="btn btn-xs btn-success" class="user_write_review" href="' . st_get_link_with_search( get_permalink( $user_url ), [
                                    'sc',
                                    'item_id'
                                ], $data ) . '">' . st_get_language( 'user_write_review' ) . '</a>';

                        } else {
                            $action = "<p style='display: none'>" . STReview::review_check( $id_item ) . "</p>";
                        }

                        if ( TravelerObject::check_cancel_able( $value->order_item_id ) && $value->type == 'normal_booking' ) {
                            $url = add_query_arg( [
                                'sc'            => 'booking-history',
                                'st_action'     => 'cancel_booking',
                                'order_item_id' => $value->order_item_id
                            ], get_permalink( $user_url ) );

                            $action .= '<a  data-toggle="modal" data-target="#cancel-booking-modal" class="btn btn-xs btn-primary mt5 confirm-cancel-booking" href="javascript: void(0);" data-order_id="' . $value->order_item_id . '" data-order_encrypt="' . TravelHelper::st_encrypt( $value->order_item_id ) . '">' . __( 'Cancel Booking', ST_TEXTDOMAIN ) . '</a>';
                        }
                        $action .= '<a data-toggle="modal" data-target="#info-booking-modal" class="btn btn-xs btn-primary mt5 btn-info-booking" data-service_id=' . $id_item . ' data-order_id="' . $value->order_item_id . '" href="javascript: void(0);"><i class="fa fa-info-circle"></i>' . __( ' Details', ST_TEXTDOMAIN ) . '</a>';

                        /////////////////// DATE //////////////////
                        $check_in  = $value->check_in;
                        $check_out = $value->check_out;
                        $format    = TravelHelper::getDateFormat();
                        if ( $st_is_woocommerce_checkout ) {
                            $starttime = $value->starttime;
                        } else {
                            $starttime = get_post_meta( $value->order_item_id, 'starttime', true );
                        }
                        if ( $check_in and $check_out ) {
                            $date = date_i18n( $format, $value->check_in_timestamp ) . ' <i class="fa fa-long-arrow-right"></i> ' . date_i18n( $format, $value->check_out_timestamp );
                            $date .= ( $starttime == '' ? '' : ' - ' . $starttime );
                        }
                        if ( $value->st_booking_post_type == 'st_tours' || $value->st_booking_post_type == 'st_activity' ) {
                            $type_tour       = get_post_meta( $id_item, 'type_tour', true );
                            $tour_price_type = get_post_meta( $id_item, 'tour_price_by', true );

                            if ( $tour_price_type == 'fixed_depart' ) {
                                if ( $date ) {
                                    $date = __( "Start", ST_TEXTDOMAIN ) . ': ' . TourHelper::getDayFromNumber( date_i18n( 'N', $value->check_in_timestamp ) ) . ' ' . date_i18n( $format, $value->check_in_timestamp ) . '<br />';
                                    $date .= __( "End", ST_TEXTDOMAIN ) . ': ' . TourHelper::getDayFromNumber( date_i18n( 'N', $value->check_out_timestamp ) ) . ' ' . date_i18n( $format, $value->check_out_timestamp );
                                }
                            } else {
                                if ( $type_tour == 'daily_tour' ) {
                                    $duration = get_post_meta( $id_item, 'duration_day', true );
                                    if ( $date ) {
                                        $date = __( "Check in : ", ST_TEXTDOMAIN ) . date_i18n( $format, $value->check_in_timestamp );
                                        $date .= ( $starttime == '' ? '' : ' - ' . $starttime ) . "<br>";
                                        $date .= __( "Duration : ", ST_TEXTDOMAIN ) . $duration . " ";
                                    }
                                }
                            }
                        }
                        if ( !isset( $date ) ) {
                            $date = "";
                        }
                        /////////////////// HTML //////////////////
                        $icon_type = $this->get_icon_type_order_item( $id_item, $value->st_booking_post_type );
                        if ( !empty( $icon_type ) ) {
                            $price         = self::_get_order_total_price( $value->order_item_id );
                            $currency      = self::_get_currency_book_history( $value->order_item_id );
                            $status_string = "";
                            $data_status   = self::_get_order_statuses();
                            if ( !empty( $data_status[ $value->status ] ) ) {
                                $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                                if ( $st_is_woocommerce_checkout ) {
                                    $status_string = $data_status[ $value->status ];
                                } else {
                                    if ( isset( $data_status[ get_post_meta( $value->order_item_id, 'status', true ) ] ) ) {
                                        $status_string = $data_status[ get_post_meta( $value->order_item_id, 'status', true ) ];
                                    } else {
                                        $status_string = '';
                                    }
                                }
                                if ( isset( $value->cancel_refund_status ) && $value->cancel_refund_status == 'pending' ) {
                                    $status_string = __( 'Cancelling', ST_TEXTDOMAIN );
                                }
                            }
                            global $wpdb;
                            $address = get_post_meta( $id_item, 'address', true );
                            if ( get_post_type( $id_item ) == 'st_cars' ) {
                                $address = get_post_meta( $id_item, 'cars_address', true );
                            }
                            $other_html = apply_filters( 'st_after_body_order_information_table', '', $value->order_item_id );

                            if ( get_post_type( $id_item ) == 'st_flight' ) {
                                if ( !empty( $value->raw_data ) ) {
                                    $raw_data = json_decode( $value->raw_data );

                                    $title = '';
                                    if ( !empty( $raw_data->depart_data_location->origin_location_full ) && !empty( $raw_data->depart_data_location->destination_location_full ) ) {
                                        $title .= $raw_data->depart_data_location->origin_location_full . ' (' . $raw_data->depart_data_location->origin_iata . ') <i class="fa fa-long-arrow-right"></i> ' . $raw_data->depart_data_location->destination_location_full . ' (' . $raw_data->depart_data_location->destination_iata . ')';
                                    }
                                    $date = esc_html__( 'Depart: ', ST_TEXTDOMAIN ) . $raw_data->depart_data_time->depart_time . ' ' . date_i18n( $format, $value->check_in_timestamp );
                                    if ( $raw_data->flight_type == 'return' ) {
                                        $title .= esc_html__( ' (return)', ST_TEXTDOMAIN );
                                        $date  .= '<br>' . esc_html__( 'Return: ', ST_TEXTDOMAIN ) . $raw_data->return_data_time->depart_time . ' ' . date_i18n( $format, $value->check_out_timestamp );
                                    }
                                    $html .= '
                                    <tr class="' . $id_item . ' " data-id-order="' . $value->id . '">
                                        <td class="booking-history-type ' . get_post_type( $id_item ) . '">
                                           ' . $this->get_icon_type_order_item( $id_item, $value->st_booking_post_type ) . '
                                        </td>

                                        <td class="hidden-xs"> ' . $value->wc_order_id . '</td>
                                        <td class="">  ' . $title . '</td>
                                        <td class="hidden-xs" >' . date_i18n( $format, strtotime( $value->created ) ) . '</td>
                                        <td class="hidden-xs" >' . $date . '</td>
                                        <td >' . TravelHelper::format_money_raw( $price, $currency ) . '</td>
                                        <td class="hidden-xs" >' . $status_string . '</td>
                                        <td style="width:1%" >' . $action . '</td>
                                        ' . $other_html . '
                                    </tr>';

                                }
                            } else {
                                $html .= '
                            <tr class="' . $id_item . ' " data-id-order="' . $value->id . '">
                                <td class="booking-history-type ' . get_post_type( $id_item ) . '">
                                   ' . $this->get_icon_type_order_item( $id_item, $value->st_booking_post_type ) . '
                                </td>
                               
                                <td class="hidden-xs"> ' . $value->order_item_id . '</td>
                                <td class=""> <a href="' . $this->get_link_order_item( $id_item ) . '">' . $this->get_title_order_item( $id_item ) . '</a></td>
                                <td class="hidden-xs" >' . date_i18n( $format, strtotime( $value->created ) ) . '</td>
                                <td class="hidden-xs" >' . $date . '</td>
                                <td >' . TravelHelper::format_money_raw( $price, $currency ) . '</td>
                                <td class="hidden-xs" >' . $status_string . '</td>
                                <td style="width:1%" >' . $action . '</td>
                                ' . $other_html . '
                            </tr>';
                            }
                        }
                    }
                }
                if ( !empty( $_REQUEST[ 'show' ] ) ) {
                    if ( !empty( $html ) )
                        $status = 'true';
                    else
                        $status = 'false';

                    echo json_encode( [
                        'html'     => $html,
                        'data_per' => $paged + 1,
                        'status'   => $status
                    ] );
                    die();
                } else {
                    return $html;
                }

            }

            function get_book_history_back_up( $status = '' )
            {

                $paged = 1;
                $limit = 10;
                if ( !empty( $_REQUEST[ 'paged' ] ) ) {
                    $paged = $_REQUEST[ 'paged' ];
                }
                $offset = ( $paged - 1 ) * $limit;
                global $wpdb;
                $where = "";
                if ( !empty( $status ) ) {
                    $where .= " AND status = '" . $status . "' ";
                }
                if ( !empty( $_REQUEST[ 'data_type' ] ) ) {
                    $where .= " AND status = '" . $_REQUEST[ 'data_type' ] . "' ";
                }
                $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                if ( $st_is_woocommerce_checkout ) {
                    $where .= " AND type = 'woocommerce' ";
                } else {
                    $where .= " AND type = 'normal_booking' ";
                }

                $where_user = " AND user_id = " . get_current_user_id();

                $querystr  = "SELECT SQL_CALC_FOUND_ROWS * FROM
                                       " . $wpdb->prefix . "st_order_item_meta
                                                            WHERE 1=1 {$where_user}
                                                            {$where}
                         ORDER BY " . $wpdb->prefix . "st_order_item_meta.id DESC LIMIT {$offset},{$limit}
                ";
                $pageposts = $wpdb->get_results( $querystr, OBJECT );
                $html      = '';

                if ( !empty( $pageposts ) ) {
                    foreach ( $pageposts as $key => $value ) {
                        $id_item = $value->st_booking_id;
                        /////////////////// REVIEW //////////////////

                        $action        = '';
                        $action_cancel = '';

                        $user_url          = st()->get_option( 'page_my_account_dashboard' );
                        $data[ 'sc' ]      = 'write_review';
                        $data[ 'item_id' ] = $id_item;

                        if ( STReview::review_check( $id_item ) == 'true' ) {
                            $action = '<a class="btn btn-xs btn-primary" class="user_write_review" href="' . st_get_link_with_search( get_permalink( $user_url ), [
                                    'sc',
                                    'item_id'
                                ], $data ) . '">' . st_get_language( 'user_write_review' ) . '</a>';

                        } else {
                            $action = "<p style='display: none'>" . STReview::review_check( $id_item ) . "</p>";
                        }

                        if ( TravelerObject::check_cancel_able( $value->order_item_id ) && $value->type == 'normal_booking' ) {
                            $url = add_query_arg( [
                                'sc'            => 'booking-history',
                                'st_action'     => 'cancel_booking',
                                'order_item_id' => $value->order_item_id
                            ], get_permalink( $user_url ) );

                            $action .= '<a  data-toggle="modal" data-target="#cancel-booking-modal" class="btn btn-xs btn-primary mt5 confirm-cancel-booking" href="javascript: void(0);" data-order_id="' . $value->order_item_id . '" data-order_encrypt="' . TravelHelper::st_encrypt( $value->order_item_id ) . '">' . __( 'Cancel Booking', ST_TEXTDOMAIN ) . '</a>';
                        }
                        $action .= '<a data-toggle="modal" data-target="#info-booking-modal" class="btn btn-xs btn-primary mt5 btn-info-booking" data-service_id=' . $id_item . ' data-order_id="' . $value->order_item_id . '" href="javascript: void(0);"><i class="fa fa-info-circle"></i>' . __( 'Details', ST_TEXTDOMAIN ) . '</a>';

                        /////////////////// DATE //////////////////
                        $check_in  = $value->check_in;
                        $check_out = $value->check_out;
                        $format    = TravelHelper::getDateFormat();
                        $starttime = get_post_meta( $value->order_item_id, 'starttime', true );
                        if ( $check_in and $check_out ) {
                            $date = date_i18n( $format, $value->check_in_timestamp ) . ' <i class="fa fa-long-arrow-right"></i> ' . date_i18n( $format, $value->check_out_timestamp );
                            $date .= ( $starttime == '' ? '' : ' - ' . $starttime );
                        }
                        if ( $value->st_booking_post_type == 'st_tours' ) {
                            $type_tour = get_post_meta( $id_item, 'type_tour', true );
                            if ( $type_tour == 'daily_tour' ) {
                                $duration = get_post_meta( $id_item, 'duration_day', true );
                                if ( $date ) {
                                    $date = __( "Check in : ", ST_TEXTDOMAIN ) . date_i18n( $format, $value->check_in_timestamp );
                                    $date .= ( $starttime == '' ? '' : ' - ' . $starttime ) . "<br>";
                                    $date .= __( "Duration : ", ST_TEXTDOMAIN ) . $duration . " ";
                                }
                            }
                        }
                        if ( !isset( $date ) ) {
                            $date = "";
                        }
                        /////////////////// HTML //////////////////
                        $icon_type = $this->get_icon_type_order_item( $id_item, $value->st_booking_post_type );
                        if ( !empty( $icon_type ) ) {
                            $price         = self::_get_order_total_price( $value->order_item_id );
                            $currency      = self::_get_currency_book_history( $value->order_item_id );
                            $status_string = "";
                            $data_status   = self::_get_order_statuses();
                            if ( !empty( $data_status[ $value->status ] ) ) {
                                $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                                if ( $st_is_woocommerce_checkout ) {
                                    $status_string = $data_status[ $value->status ];
                                } else {
                                    $status_string = $data_status[ get_post_meta( $value->order_item_id, 'status', true ) ];
                                }
                                if ( isset( $value->cancel_refund_status ) && $value->cancel_refund_status == 'pending' ) {
                                    $status_string = __( 'Cancelling', ST_TEXTDOMAIN );
                                }
                            }
                            global $wpdb;
                            $address = get_post_meta( $id_item, 'address', true );
                            if ( get_post_type( $id_item ) == 'st_cars' ) {
                                $address = get_post_meta( $id_item, 'cars_address', true );
                            }
                            $other_html = apply_filters( 'st_after_body_order_information_table', '', $value->order_item_id );

                            if ( get_post_type( $id_item ) == 'st_flight' ) {
                                if ( !empty( $value->raw_data ) ) {
                                    $raw_data = json_decode( $value->raw_data );

                                    $title = '';
                                    if ( !empty( $raw_data->depart_data_location->origin_location_full ) && !empty( $raw_data->depart_data_location->destination_location_full ) ) {
                                        $title .= $raw_data->depart_data_location->origin_location_full . ' (' . $raw_data->depart_data_location->origin_iata . ') <i class="fa fa-long-arrow-right"></i> ' . $raw_data->depart_data_location->destination_location_full . ' (' . $raw_data->depart_data_location->destination_iata . ')';
                                    }
                                    $date = esc_html__( 'Depart: ', ST_TEXTDOMAIN ) . $raw_data->depart_data_time->depart_time . ' ' . date_i18n( $format, $value->check_in_timestamp );
                                    if ( $raw_data->flight_type == 'return' ) {
                                        $title .= esc_html__( ' (return)', ST_TEXTDOMAIN );
                                        $date  .= '<br>' . esc_html__( 'Return: ', ST_TEXTDOMAIN ) . $raw_data->return_data_time->depart_time . ' ' . date_i18n( $format, $value->check_out_timestamp );
                                    }
                                    $html .= '
                                    <tr class="' . $id_item . ' " data-id-order="' . $value->id . '">
                                        <td class="booking-history-type ' . get_post_type( $id_item ) . '">
                                           ' . $this->get_icon_type_order_item( $id_item, $value->st_booking_post_type ) . '
                                        </td>

                                        <td class="hidden-xs"> ' . $value->wc_order_id . '</td>
                                        <td class="">  ' . $title . '</td>
                                        <td class="hidden-xs" >' . date_i18n( $format, strtotime( $value->created ) ) . '</td>
                                        <td class="hidden-xs" >' . $date . '</td>
                                        <td >' . TravelHelper::format_money_raw( $price, $currency ) . '</td>
                                        <td class="hidden-xs" >' . $status_string . '</td>
                                        <td style="width:1%" >' . $action . '</td>
                                        ' . $other_html . '
                                    </tr>';

                                }
                            } else {
                                $html .= '
                            <tr class="' . $id_item . ' " data-id-order="' . $value->id . '">
                                <td class="booking-history-type ' . get_post_type( $id_item ) . '">
                                   ' . $this->get_icon_type_order_item( $id_item, $value->st_booking_post_type ) . '
                                </td>
                               
                                <td class="hidden-xs"> ' . $value->order_item_id . '</td>
                                <td class=""> <a href="' . $this->get_link_order_item( $id_item ) . '">' . $this->get_title_order_item( $id_item ) . '</a></td>
                                <td class="hidden-xs" >' . date_i18n( $format, strtotime( $value->created ) ) . '</td>
                                <td class="hidden-xs" >' . $date . '</td>
                                <td >' . TravelHelper::format_money_raw( $price, $currency ) . '</td>
                                <td class="hidden-xs" >' . $status_string . '</td>
                                <td style="width:1%" >' . $action . '</td>
                                ' . $other_html . '
                            </tr>';
                            }
                        }
                    }
                }
                if ( !empty( $_REQUEST[ 'show' ] ) ) {
                    if ( !empty( $html ) )
                        $status = 'true';
                    else
                        $status = 'false';

                    echo json_encode( [
                        'html'     => $html,
                        'data_per' => $paged + 1,
                        'status'   => $status
                    ] );
                    die();
                } else {
                    return $html;
                }

            }

            function get_location_order_item( $id_item )
            {
                $post_type = get_post_type( $id_item );
                switch ( $post_type ) {
                    case "st_hotel":
                        $location = TravelHelper::locationHtml( $id_item );
                        break;
                    case "cruise_cabin":
                        $id_cruise   = get_post_meta( $id_item, 'cruise_id', true );
                        $id_location = get_post_meta( $id_cruise, 'location_id', true );
                        if ( !$id_location )
                            return;
                        $location = get_the_title( $id_location );
                        break;
                    case "st_tours":
                        $id_location = get_post_meta( $id_item, 'id_location', true );
                        if ( !$id_location )
                            return;
                        $location = get_the_title( $id_location );
                        break;
                    case "st_cars":
                        $id_location = get_post_meta( $id_item, 'id_location', true );
                        if ( !$id_location )
                            return;
                        $location = get_the_title( $id_location );
                        break;
                    case "st_rental":
                        $id_location = get_post_meta( $id_item, 'location_id', true );
                        if ( !$id_location )
                            return;
                        $location = get_the_title( $id_location );
                        break;
                    case "st_activity":
                        $id_location = get_post_meta( $id_item, 'id_location', true );
                        if ( !$id_location )
                            return;
                        $location = get_the_title( $id_location );
                        break;
                    default :
                        $location = '';
                }

                return $location;
            }

            function get_link_order_item( $id_item )
            {
                $post_type = get_post_type( $id_item );
                switch ( $post_type ) {
                    case "st_hotel":
                        $title = get_the_permalink( $id_item );
                        break;
                    case "hotel_room":
                        $title = get_the_permalink( $id_item );
                        break;
                    case "cruise_cabin":
                        $id_cruise = get_post_meta( $id_item, 'cruise_id', true );
                        $title     = get_the_permalink( $id_cruise );
                        break;
                    case "st_tours":
                        $title = get_the_permalink( $id_item );
                        break;
                    case "st_cars":
                        $title = get_the_permalink( $id_item );
                        break;
                    case "st_rental":
                        $title = get_the_permalink( $id_item );
                        break;
                    case "st_activity":
                        $title = get_the_permalink( $id_item );
                        break;
                    default :
                        $title = get_the_permalink( $id_item );
                }

                return $title;
            }

            function get_title_order_item( $id_item )
            {
                $post_type = get_post_type( $id_item );
                switch ( $post_type ) {
                    case "st_hotel":
                        $title = get_the_title( $id_item );
                        break;
                    case "hotel_room":
                        $title = get_the_title( $id_item );
                        break;
                    case "cruise_cabin":
                        $id_cruise = get_post_meta( $id_item, 'cruise_id', true );
                        $title     = get_the_title( $id_cruise );
                        break;
                    case "st_tours":
                        $title           = get_the_title( $id_item );
                        $tour_price_type = get_post_meta( $id_item, 'tour_price_by', true );
                        if ( $tour_price_type == 'fixed_depart' ) {
                            $title .= '<br /><span style="color: #333;">(' . __( 'Fixed Departure', ST_TEXTDOMAIN ) . ')</span>';
                        }
                        break;
                    case "st_cars":
                        $title = get_the_title( $id_item );
                        break;
                    case "st_rental":
                        $title = get_the_title( $id_item );
                        break;
                    case "st_activity":
                        $title = get_the_title( $id_item );
                        break;
                    default :
                        $title = get_the_title( $id_item );
                }

                return $title;
            }

            function get_icon_type_order_item( $id_item, $type = false )
            {
                $html = '';
                if ( $type == 'car_transfer' ) {
                    $html = '<i class="fa fa-dashboard"></i><small>' . __( "transfer", ST_TEXTDOMAIN ) . '</small>';
                } else {
                    $post_type = get_post_type( $id_item );
                    switch ( $post_type ) {
                        case "st_hotel":
                            $html = '<i class="fa fa-building-o"></i><small>' . __( "hotel", ST_TEXTDOMAIN ) . '</small>';
                            break;
                        case "hotel_room":
                            $html = '<i class="fa fa-building-o"></i><small>' . __( "room", ST_TEXTDOMAIN ) . '</small>';
                            break;
                        case "st_tours":
                            $html = '<i class="fa fa-bolt"></i><small>' . __( 'tour', ST_TEXTDOMAIN ) . '</small>';
                            break;
                        case "st_cars":
                            $html = '<i class="fa fa-dashboard"></i><small>' . __( "car", ST_TEXTDOMAIN ) . '</small>';
                            break;
                        case "st_rental":
                            $html = '<i class="fa fa-home"></i><small>' . __( "rental", ST_TEXTDOMAIN ) . '</small>';
                            break;
                        case "st_activity":
                            $html = '<i class="fa fa-bolt"></i><small>' . __( "activity", ST_TEXTDOMAIN ) . '</small>';
                            break;
                        case "cruise_cabin":
                            $html = '<i class="fa fa-bolt"></i><small>' . __( "cruise", ST_TEXTDOMAIN ) . '</small>';
                            break;
                        case "st_flight":
                            $html = '<i class="fa fa-plane"></i><small>' . __( "flight", ST_TEXTDOMAIN ) . '</small>';
                            break;
                        default :
                            $html = '';
                    }
                }

                return $html;
            }


            /**
             * @updated 1.3.1
             **/
            static function check_lever_partner( $lever )
            {
                $dk = true;
                switch ( $lever ) {
                    case "subscriber":
                        $dk = false;
                        break;
                    case "contributor":
                        $dk = false;
                        break;
                    case "author":
                        $dk = false;
                        break;
                    case "editor":
                        $dk = false;
                        break;
                    case "partner":
                        $dk = true;
                        break;
                    case "administrator":
                        $dk = true;
                        break;
                    default :
                        $dk = false;
                }
                $user_id        = get_current_user_id();
                $admin_packages = STAdminPackages::get_inst();

                $enable = $admin_packages->enabled_membership();
                if ( $enable && $lever == 'partner' ) {
                    $order = $admin_packages->get_order_by_partner( $user_id );

                    if ( !$order ) {
                        $dk = false;
                    }
                    $verified = $admin_packages->partner_verified_package( $user_id );
                    if ( !$verified ) {
                        $dk = false;
                    }
                }

                return $dk;
            }

            function st_write_review()
            {
                if ( STInput::request( 'write_review' ) ) {
                    if ( !STInput::request( 'item_id' ) ) {
                        $user_url = st()->get_option( 'page_my_account_dashboard' );
                        if ( $user_url ) {
                            wp_safe_redirect( get_permalink( $user_url ) );
                        } else {
                            wp_safe_redirect( home_url() );
                        }
                        die;
                    } else {
                        if ( !get_post_status( STInput::request( 'item_id' ) ) ) {
                            $user_url = st()->get_option( 'page_my_account_dashboard' );
                            if ( $user_url ) {
                                wp_safe_redirect( get_permalink( $user_url ) );
                            } else {
                                wp_safe_redirect( home_url() );
                            }
                            die;
                        }
                    }
                }

                if ( STInput::post() and STInput::post( 'comment_post_ID' ) ) {

                    if ( wp_verify_nonce( STInput::post( 'st_user_write_review' ), 'st_user_settings' ) ) {
                        global $current_user;
                        $comment_data[ 'comment_post_ID' ]      = STInput::post( 'comment_post_ID' );
                        $comment_data[ 'comment_author' ]       = $current_user->data->user_nicename;
                        $comment_data[ 'comment_author_email' ] = $current_user->data->user_email;
                        $comment_data[ 'comment_content' ]      = STInput::post( 'comment' );
                        $comment_data[ 'comment_type' ]         = 'st_reviews';
                        $comment_data[ 'user_id' ]              = $current_user->ID;

                        if ( STInput::post( 'item_id' ) ) {
                            $comment_data[ 'comment_post_ID' ] = STInput::post( 'item_id' );
                        }
                        if ( STReview::check_reviewable( STInput::post( 'comment_post_ID' ) ) ) {
                            $comment_id = wp_new_comment( $comment_data );

                            if ( $comment_id ) {
                                update_comment_meta( $comment_id, 'comment_title', STInput::post( 'comment_title' ) );
                                if ( STInput::post( 'comment_rate' ) )
                                    update_comment_meta( $comment_id, 'comment_rate', STInput::post( 'comment_rate' ) );
                            }

                            wp_safe_redirect( get_permalink( STInput::post( 'comment_post_ID' ) ) );
                            die;
                        }

                    }
                }
            }


            static function get_icon_wishlist()
            {
                $current_user = wp_get_current_user();
                $data_list    = get_user_meta( $current_user->ID, 'st_wishlist', true );
                $data_list    = json_decode( $data_list );

                if ( $data_list != '' and is_array( $data_list ) ) {
                    $check = false;
                    foreach ( $data_list as $k => $v ) {
                        if ( $v->id == get_the_ID() and $v->type == get_post_type( get_the_ID() ) ) {
                            $check = true;
                        }
                    }
                    if ( $check == true ) {
                        return [
                            'original-title' => st_get_language( 'remove_to_wishlist' ),
                            'icon'           => '<i class="fa fa-heart"></i>',
                            'status' => true
                        ];
                    } else {
                        return [
                            'original-title' => st_get_language( 'add_to_wishlist' ),
                            'icon'           => '<i class="fa fa-heart-o"></i>',
                            'status' => false
                        ];
                    }
                } else {
                    return [
                        'original-title' => st_get_language( 'add_to_wishlist' ),
                        'icon'           => '<i class="fa fa-heart-o"></i>',
                        'status' => false
                    ];
                }
            }

            static function get_title_account_setting()
            {
                if ( !empty( $_REQUEST[ 'sc' ] ) ) {
                    $type = $_REQUEST[ 'sc' ];
                    switch ( $type ) {
                        case "setting":
                            esc_html_e( 'Account Setting', 'traveler' );
                            break;
                        case "photos":
                            esc_html_e( 'My Travel Photos', 'traveler' );
                            break;
                        case "booking-history":
                            esc_html_e( 'Booking History', 'traveler' );
                            break;
                        case "wishlist":
                            esc_html_e( 'Wishlist', 'traveler' );
                            break;
                        case "create-hotel":
                            esc_html_e( 'Add new Hotel', 'traveler' );
                            break;
                        case "my-hotel":
                            esc_html_e( 'My Hotel', 'traveler' );
                            break;
                        case "create-room":
                            esc_html_e( 'Add new room', 'traveler' );
                            break;
                        case "my-room":
                            esc_html_e( 'My Room', 'traveler' );
                            break;
                        case "create-tours":
                            esc_html_e( 'Add new tour', 'traveler' );
                            break;
                        case "my-tours":
                            esc_html_e( 'My Tour', 'traveler' );
                            break;
                        case "create-flight":
                            esc_html_e( 'Create new flight', ST_TEXTDOMAIN );
                            break;
                        case "my-flights":
                            esc_html_e( 'My flights', ST_TEXTDOMAIN );
                            break;
                        case "create-activity":
                            esc_html_e( 'Add new activity', 'traveler' );
                            break;
                        case "my-activity":
                            esc_html_e( 'My Activity', 'traveler' );
                            break;
                        case "create-cars":
                            esc_html_e( 'Add new car', 'traveler' );
                            break;
                        case "my-cars":
                            esc_html_e( 'My Car', 'traveler' );
                            break;
                        case "create-rental":
                            esc_html_e( 'Add new rental', 'traveler' );
                            break;
                        case "my-rental":
                            esc_html_e( 'My Rental', 'traveler' );
                            break;
                        case "create-cruise":
                            esc_html_e( 'user_create_cruise' );
                            break;
                        case "my-cruise":
                            esc_html_e( 'user_my_cruise' );
                            break;
                        case "create-cruise-cabin":
                            esc_html_e( 'user_create_cruise_cabin' );
                            break;
                        case "my-cruise-cabin":
                            esc_html_e( 'user_my_cruise_cabin' );
                            break;
                        case "setting-info":
                            esc_html_e( 'User Info', 'traveler' );
                            break;
                        case "write-review":
                            esc_html_e( 'Write Review', 'traveler' );
                            break;
                        case "list-refund":
                            esc_html_e( "Refund Manager", ST_TEXTDOMAIN );
                            break;
                    }
                } else if ( !empty( $_REQUEST[ 'id_user' ] ) ) {
                    esc_html_e( 'User Info', 'traveler' );
                } else {
                    esc_html_e( 'Settings', 'traveler' );
                }
            }

            static function get_info_total_traveled()
            {
                $data = [
                    'st_hotel'    => 0,
                    'st_rental'   => 0,
                    'st_cars'     => 0,
                    'st_activity' => 0,
                    'st_tours'    => 0,
                    'address'     => []
                ];
                global $wpdb;

                $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                $type                       = 'normal_booking';
                if ( $st_is_woocommerce_checkout ) {
                    $type = 'woocommerce';
                }

                $querystr  = "SELECT order_item_id,st_booking_post_type,st_booking_id FROM
                                       " . $wpdb->prefix . "st_order_item_meta
                                                            WHERE 1=1
                                                            AND user_id = " . get_current_user_id() . " and type='" . $type . "'
            ";
                $pageposts = $wpdb->get_results( $querystr, OBJECT );

                if ( !empty( $pageposts ) ) {
                    foreach ( $pageposts as $k => $v ) {
                        $item_id   = $v->st_booking_id;
                        $post_type = $v->st_booking_post_type;
                        if ( !empty( $post_type ) and isset( $data[ $post_type ] ) and st_check_service_available( $post_type ) ) {
                            $data[ $post_type ] += 1;
                            $lat                = get_post_meta( $item_id, 'map_lat', true );
                            $lng                = get_post_meta( $item_id, 'map_lng', true );
                            $icon               = 'http://maps.google.com/mapfiles/marker_green.png';
                            switch ( $post_type ) {
                                case"st_hotel";
                                    $icon = st()->get_option( 'st_hotel_icon_map_marker', 'http://maps.google.com/mapfiles/marker_black.png' );
                                    break;
                                case"st_rental";
                                    $icon = st()->get_option( 'st_rental_icon_map_marker', 'http://maps.google.com/mapfiles/marker_brown.png' );
                                    break;
                                case"st_cars";
                                    $icon = st()->get_option( 'st_cars_icon_map_marker', 'http://maps.google.com/mapfiles/marker_green.png' );
                                    break;
                                case"st_tours";
                                    $icon = st()->get_option( 'st_tours_icon_map_marker', 'http://maps.google.com/mapfiles/marker_purple.png' );
                                    break;
                                case"st_activity";
                                    $icon = st()->get_option( 'st_activity_icon_map_marker', 'http://maps.google.com/mapfiles/marker_yellow.png' );
                                    break;
                            }
                            $data[ 'address' ][] = [ $lat, $lng, $icon ];
                        }
                    }
                }

                return $data;
            }

            /*
         * since 1.1.2
         */
            static function get_week_reports()
            {

                $day        = date( 'w' );
                $week_start = date( 'Y-m-d', strtotime( '-' . ( $day - 1 ) . ' days' ) );
                $week_end   = date( 'Y-m-d', strtotime( '+' . ( 7 - $day ) . ' days' ) );

                $last_week_start = date( 'Y-m-d', strtotime( '-' . ( $day + 7 ) . ' days' ) );
                $last_week_end   = date( 'Y-m-d', strtotime( '+' . ( 6 - $day - 7 ) . ' days' ) );

                return [
                    'this_week' => [
                        'start' => $week_start,
                        'end'   => $week_end,
                    ],
                    'last_week' => [
                        'start' => $last_week_start,
                        'end'   => $last_week_end,
                    ]
                ];
            }

            /*
         * since 1.1.2
         */
            static function get_fist_year_reports()
            {
                $the_week     = STUser_f::get_week_reports();
                $last_7_days  = date( 'Y-m-d', strtotime( 'today - 7 days' ) );
                $last_15_days = date( 'Y-m-d', strtotime( 'today - 30 days' ) );
                $last_60_days = date( 'Y-m-d', strtotime( 'today - 60 days' ) );
                $last_90_days = date( 'Y-m-d', strtotime( 'today - 90 days' ) );
                $yesterday    = date( 'Y-m-d', strtotime( 'today - 1 days' ) );
                $defaut       = [
                    'd'           => '',
                    'm'           => '',
                    'y'           => '',
                    'full'        => '',
                    'last_7days'  => $last_7_days,
                    'last_15days' => $last_15_days,
                    'last_60days' => $last_60_days,
                    'last_90days' => $last_90_days,
                    'yesterday'   => $yesterday,
                    'date_now'    => date( 'Y-m-d' ),
                    'the_week'    => $the_week,
                    'last_year'   => date( "Y" ) - 1,
                ];
                global $current_user;
                wp_get_current_user();
                $user_id = $current_user->ID;
                $query   = [
                    'post_type'      => 'shop_order',
                    'post_status'    => [ 'wc-completed' ],
                    'posts_per_page' => 1,
                    'author'         => $user_id,
                    'order'          => "ASC",
                    'orderby'        => "date",
                ];
                query_posts( $query );
                while ( have_posts() ) {
                    the_post();
                    $defaut = [
                        'd'           => get_the_date( "d" ),
                        'm'           => get_the_date( "n" ),
                        'y'           => get_the_date( "Y" ),
                        'full'        => get_the_date( "Y-m-d" ),
                        'last_7days'  => $last_7_days,
                        'last_15days' => $last_15_days,
                        'last_60days' => $last_60_days,
                        'last_90days' => $last_90_days,
                        'yesterday'   => $yesterday,
                        'date_now'    => date( 'Y-m-d' ),
                        'the_week'    => $the_week,
                        'last_year'   => date( "Y" ) - 1,
                    ];
                }

                return $defaut;
            }

            static function get_info_reports_old( $type = 'month', $year = false, $year_start = false, $year_end = false, $_date_start = false, $_date_end = false )
            {
                $data      = self::get_default_info_reports( $type, $_date_start, $_date_end );
                $data_year = current_time( 'Y' );
                if ( !empty( $year ) ) {
                    $data_year = $year;
                }
                $date_start = $data_year . '-01-1';
                $date_end   = $data_year . '-12-31';
                if ( !empty( $year_start ) and !empty( $year_end ) and $year_start <= $year_end ) {
                    $date_start = $year_start . '-01-1';
                    $date_end   = $year_end . '-12-31';
                }
                if ( !empty( $_date_start ) and !empty( $_date_end ) ) {
                    $date_start = $_date_start;
                    $date_end   = $_date_end;
                }
                global $current_user;
                wp_get_current_user();
                $user_id = $current_user->ID;
                $query   = [
                    'post_type'      => 'st_order',
                    'post_status'    => [ 'publish' ],
                    'posts_per_page' => -1,
                    'meta_query'     => [
                        [
                            'key'     => 'id_user',
                            'value'   => $user_id,
                            'compare' => '=',
                            'type'    => "NUMERIC"
                        ],
                    ],
                    'date_query'     => [
                        [
                            'after'     => $date_start,
                            'before'    => $date_end,
                            'inclusive' => true,
                        ],
                    ],
                ];
                query_posts( $query );
                global $wp_query;
                while ( have_posts() ) {
                    the_post();
                    $item_id   = get_post_meta( get_the_ID(), 'item_id', true );
                    $post_type = get_post_type( $item_id );
                    if ( !empty( $post_type ) and isset( $data[ 'post_type' ][ $post_type ] ) ) {


                        $price         = get_post_meta( get_the_ID(), 'total_price', true );
                        $item_number   = get_post_meta( get_the_ID(), 'item_number', true );
                        $number_orders = 1;

                        //
                        $data[ 'number_orders' ] = $data[ 'number_orders' ] + 1;
                        $data[ 'number_items' ]  = $data[ 'number_items' ] + $item_number;
                        $data[ 'average_total' ] = $data[ 'average_total' ] + $price;

                        // price by post type
                        $data[ 'post_type' ][ $post_type ][ 'ids' ][]         = $item_id;
                        $data[ 'post_type' ][ $post_type ][ 'number_orders' ] += $number_orders;
                        $data[ 'post_type' ][ $post_type ][ 'number_items' ]  += $item_number;
                        $data[ 'post_type' ][ $post_type ][ 'average_total' ] += $price;

                        /// price by custom date ---------------------------------------------
                        if ( $type == "15days" or $type == 'custom_date' ) {
                            $date_create = get_the_date( "m-d-Y" );
                            if ( isset( $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ] ) ) {
                                $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ][ 'number_orders' ] += $number_orders;
                                $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ][ 'number_items' ]  += $item_number;
                                $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ][ 'average_total' ] += $price;
                            }
                        } else {
                            /// price by year ---------------------------------------------
                            $year_create = get_the_date( "Y" );
                            foreach ( $data[ 'post_type' ] as $k => $v ) {
                                if ( empty( $data[ 'post_type' ][ $k ][ 'year' ][ $year_create ] ) ) {
                                    $data[ 'post_type' ][ $k ][ 'year' ][ $year_create ] = [
                                        'number_orders' => 0,
                                        'number_items'  => 0,
                                        'average_total' => 0,
                                    ];
                                }
                                if ( !empty( $data[ 'post_type' ][ $k ][ 'year' ] ) ) {
                                    ksort( $data[ 'post_type' ][ $k ][ 'year' ] );
                                }
                            }
                            $data[ 'post_type' ][ $post_type ][ 'year' ][ $year_create ][ 'number_orders' ] = $number_orders;
                            $data[ 'post_type' ][ $post_type ][ 'year' ][ $year_create ][ 'number_items' ]  += $item_number;
                            $data[ 'post_type' ][ $post_type ][ 'year' ][ $year_create ][ 'average_total' ] += $price;

                            /// price by month ---------------------------------------------

                            $month_create                                                                   = get_the_date( "n" );
                            $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'number_order' ] += 1;

                            $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'number_items' ]  += $item_number;
                            $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'average_total' ] += $price;

                            /// price by day ---------------------------------------------
                            $day_create = get_the_date( "j" );


                            $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'day' ][ $day_create ][ 'number_order' ]  += 1;
                            $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'day' ][ $day_create ][ 'number_items' ]  += $item_number;
                            $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'day' ][ $day_create ][ 'average_total' ] += $price;

                        }


                        /*       $date_create = get_the_date("n");
                    $data['post_type'][$post_type]['ids'][] = get_the_ID();
                    $data['post_type'][$post_type]['number_orders'] = $data['post_type'][$post_type]['number_orders'] + 1 ;
                    $item_number = get_post_meta(get_the_ID(), 'item_number', true);
                    $data['post_type'][$post_type]['number_items']  = $data['post_type'][$post_type]['number_items']  + $item_number;
                    $total_price = get_post_meta(get_the_ID(), 'total_price', true);
                    $data['post_type'][$post_type]['average_total'] = $data['post_type'][$post_type]['average_total'] + $total_price;

                    $data['post_type'][$post_type]['date'][$date_create]['number_order']  = $data['post_type'][$post_type]['date'][$date_create]['number_order'] + 1;
                    $data['post_type'][$post_type]['date'][$date_create]['number_items']  = $data['post_type'][$post_type]['date'][$date_create]['number_items'] + $item_number;
                    $data['post_type'][$post_type]['date'][$date_create]['average_total'] = $data['post_type'][$post_type]['date'][$date_create]['average_total'] + $total_price;

                    $data['number_orders'] = $data['number_orders'] + 1 ;
                    $data['number_items']  = $data['number_items'] + $item_number;
                    $data['average_total'] = $data['average_total'] + $total_price;*/

                    }
                }
                wp_reset_query();

                return $data;
            }

            /*
         * since 1.1.2
         * remove ver 1.2.0
        */
            static function get_info_reports( $type = 'month', $year = false, $year_start = false, $year_end = false, $_date_start = false, $_date_end = false )
            {

                $data = self::get_default_info_reports( $type, $_date_start, $_date_end );
                if ( !class_exists( 'WooCommerce' ) ) {
                    return $data;
                }

                global $wp_query;
                global $wpdb;

                $data_year = current_time( 'Y' );
                if ( !empty( $year ) ) {
                    $data_year = $year;
                }
                $date_start = $data_year . '-01-1';
                $date_end   = $data_year . '-12-31';

                if ( !empty( $year_start ) and !empty( $year_end ) and $year_start <= $year_end ) {
                    $date_start = $year_start . '-01-1';
                    $date_end   = $year_end . '-12-31';
                }

                if ( !empty( $_date_start ) and !empty( $_date_end ) ) {

                    $date_start = $_date_start;
                    $date_end   = $_date_end;
                }

                global $current_user;
                wp_get_current_user();
                $user_id       = $current_user->ID;
                $query         = [
                    'post_type'      => 'shop_order',
                    'post_status'    => [ 'wc-completed' ],
                    'posts_per_page' => -1,
                    'author'         => $user_id,
                    'date_query'     => [
                        [
                            'after'     => $date_start,
                            'before'    => $date_end,
                            'inclusive' => true,
                        ],
                    ],
                ];
                $list_partner  = st()->get_option( 'list_partner' );
                $array_partner = [];
                if ( !empty( $list_partner ) ) {
                    foreach ( $list_partner as $key => $value ) {
                        $id = 'st_' . $value[ 'id_partner' ];
                        if ( $value[ 'id_partner' ] == 'car' or $value[ 'id_partner' ] == 'tour' ) {
                            $id = 'st_' . $value[ 'id_partner' ] . 's';
                        }
                        $array_partner[ $id ] = $value[ 'title' ];
                    }
                }

                query_posts( $query );

                while ( have_posts() ) {
                    the_post();
                    $id_order          = get_the_ID();
                    $data_items        = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_order_items  WHERE 1=1 AND " . $wpdb->prefix . "woocommerce_order_items.order_id IN (" . $id_order . ") AND " . $wpdb->prefix . "woocommerce_order_items.order_item_type = 'line_item'" );
                    $total_price       = 0;
                    $total_item_number = 0;
                    $number_orders     = 0;
                    if ( !empty( $data_items ) and is_array( $data_items ) ) {
                        foreach ( $data_items as $key => $value ) {
                            $order_item_id = $value->order_item_id;
                            $data_item     = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_order_itemmeta  WHERE 1=1 AND " . $wpdb->prefix . "woocommerce_order_itemmeta.order_item_id IN (" . $order_item_id . ")" );
                            $item_id       = 0;
                            $price         = 0;
                            if ( !empty( $data_item ) ) {
                                foreach ( $data_item as $k => $v ) {
                                    if ( $v->meta_key == '_product_id' ) {
                                        $item_id = $v->meta_value;
                                    }
                                    if ( $v->meta_key == '_line_total' ) {
                                        $price = $v->meta_value;
                                    }
                                    if ( $v->meta_key == '_qty' ) {
                                        $item_number = $v->meta_value;
                                    }
                                }
                            }
                            $post_type = get_post_type( $item_id );

                            if ( !empty( $post_type ) and isset( $data[ 'post_type' ][ $post_type ] ) and isset( $array_partner[ $post_type ] ) ) {

                                $total_price       += $price;
                                $total_item_number += $item_number;
                                $number_orders     = 1;

                                // price by post type
                                $data[ 'post_type' ][ $post_type ][ 'ids' ][] = $item_id;
                                if ( $key == 0 ) {
                                    $data[ 'post_type' ][ $post_type ][ 'number_orders' ] += $number_orders;
                                }
                                $data[ 'post_type' ][ $post_type ][ 'number_items' ]  += $item_number;
                                $data[ 'post_type' ][ $post_type ][ 'average_total' ] += $price;

                                /// price by custom date ---------------------------------------------
                                if ( $type == "15days" or $type == 'custom_date' ) {
                                    $date_create = get_the_date( "m-d-Y" );
                                    if ( isset( $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ] ) ) {
                                        $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ][ 'number_orders' ] += $number_orders;
                                        $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ][ 'number_items' ]  += $item_number;
                                        $data[ 'post_type' ][ $post_type ][ 'date' ][ $date_create ][ 'average_total' ] += $price;
                                    }
                                } else {
                                    /// price by year ---------------------------------------------
                                    $year_create = get_the_date( "Y" );
                                    foreach ( $data[ 'post_type' ] as $k => $v ) {
                                        if ( empty( $data[ 'post_type' ][ $k ][ 'year' ][ $year_create ] ) ) {
                                            $data[ 'post_type' ][ $k ][ 'year' ][ $year_create ] = [
                                                'number_orders' => 0,
                                                'number_items'  => 0,
                                                'average_total' => 0,
                                            ];
                                        }
                                        if ( !empty( $data[ 'post_type' ][ $k ][ 'year' ] ) ) {
                                            ksort( $data[ 'post_type' ][ $k ][ 'year' ] );
                                        }
                                    }
                                    if ( $key == 0 ) {
                                        $data[ 'post_type' ][ $post_type ][ 'year' ][ $year_create ][ 'number_orders' ] = $number_orders;
                                    }
                                    $data[ 'post_type' ][ $post_type ][ 'year' ][ $year_create ][ 'number_items' ]  += $item_number;
                                    $data[ 'post_type' ][ $post_type ][ 'year' ][ $year_create ][ 'average_total' ] += $price;

                                    /// price by month ---------------------------------------------

                                    $month_create = get_the_date( "n" );
                                    if ( $key == 0 ) {
                                        $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'number_order' ] += 1;
                                    }
                                    $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'number_items' ]  += $item_number;
                                    $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'average_total' ] += $price;

                                    /// price by day ---------------------------------------------
                                    $day_create = get_the_date( "j" );

                                    if ( $key == 0 ) {
                                        $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'day' ][ $day_create ][ 'number_order' ] += 1;
                                    }
                                    $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'day' ][ $day_create ][ 'number_items' ]  += $item_number;
                                    $data[ 'post_type' ][ $post_type ][ 'date' ][ $month_create ][ 'day' ][ $day_create ][ 'average_total' ] += $price;

                                }
                            }
                        }
                    }
                    $data[ 'number_orders' ] = $data[ 'number_orders' ] + $number_orders;
                    $data[ 'number_items' ]  = $data[ 'number_items' ] + $total_item_number;
                    $data[ 'average_total' ] = $data[ 'average_total' ] + $total_price;

                }

                wp_reset_query();

                return $data;
            }

            /*
         * since 1.1.2
         */
            static function get_default_info_reports( $type, $date_start = false, $date_end = false )
            {
                $data = [
                    'post_type'          => [
                        'st_hotel'    => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ],
                        'hotel_room'  => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ],
                        'st_rental'   => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ],
                        'st_cars'     => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ],
                        'st_activity' => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ],
                        'st_tours'    => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ],
                        'st_flight'   => [
                            'ids'           => [],
                            'ids_orders'    => [],
                            'number_orders' => 0,
                            'number_items'  => 0,
                            'average_total' => 0,
                            'date'          => []
                        ]
                    ],
                    'number_orders'      => 0,
                    'number_items'       => 0,
                    'average_total'      => 0,
                    'average_daily_sale' => 0,
                ];
                if ( !self::_check_service_available_partner( 'st_hotel' ) ) {
                    unset( $data[ 'post_type' ][ 'st_hotel' ] );
                    unset( $data[ 'post_type' ][ 'hotel_room' ] );
                }
                if ( !self::_check_service_available_partner( 'st_rental' ) ) {
                    unset( $data[ 'post_type' ][ 'st_rental' ] );
                }
                if ( !self::_check_service_available_partner( 'st_cars' ) ) {
                    unset( $data[ 'post_type' ][ 'st_cars' ] );
                }
                if ( !self::_check_service_available_partner( 'st_tours' ) ) {
                    unset( $data[ 'post_type' ][ 'st_tours' ] );
                }
                if ( !self::_check_service_available_partner( 'st_activity' ) ) {
                    unset( $data[ 'post_type' ][ 'st_activity' ] );
                }
                if ( !self::_check_service_available_partner( 'st_flight' ) ) {
                    unset( $data[ 'post_type' ][ 'st_flight' ] );
                }

                foreach ( $data[ 'post_type' ] as $k => $v ) {

                    if ( $type != '15days' and $type != 'custom_date' ) {
                        // add 12 month
                        for ( $i = 1; $i <= 12; $i++ ) {
                            $data[ 'post_type' ][ $k ][ 'date' ][ $i ] = [
                                'number_order'  => 0,
                                'number_items'  => 0,
                                'average_total' => 0
                            ];
                            // add day
                            if ( $i == 2 )
                                $day = 28; else $day = 31;
                            for ( $j = 1; $j <= $day; $j++ ) {
                                $data[ 'post_type' ][ $k ][ 'date' ][ $i ][ 'day' ][ $j ] = [
                                    'number_order'  => 0,
                                    'number_items'  => 0,
                                    'average_total' => 0
                                ];
                            }
                        }
                    } else {
                        $number_days = STDate::date_diff( strtotime( $date_start ), strtotime( $date_end ) );
                        for ( $i = 0; $i <= $number_days; $i++ ) {
                            $next_day = date( 'm-d-Y', strtotime( $date_start . "+" . $i . " days" ) );
                            if ( empty( $data[ 'post_type' ][ $k ][ 'date' ][ $next_day ] ) ) {
                                $data[ 'post_type' ][ $k ][ 'date' ][ $next_day ] = [
                                    'number_orders' => 0,
                                    'number_items'  => 0,
                                    'average_total' => 0,
                                ];
                            }
                            $data[ 'date' ][ $next_day ] = [
                                'number_orders' => 0,
                                'number_items'  => 0,
                                'average_total' => 0,
                            ];

                        }
                    }

                }

                return $data;
            }

            /*
         * since 1.1.2
         */
            static function get_js_reports( $data_post, $type, $date_start = false, $date_end = false )
            {
                $_number_order = $data_post[ 'number_orders' ];
                $data_post     = $data_post[ 'post_type' ];
                $default       = [
                    'data_key'   => 'var data_key=[];',
                    'data_lable' => 'var data_lable=[];',
                    'data_value' => 'var data_value=[];',
                    'data_ticks' => 'var data_ticks=[];',
                ];
                if ( !empty( $data_post ) and $_number_order > 0 ) {
                    $data_lable = $data_key = $data_value = $data_ticks = "";
                    switch ( $type ) {
                        case "month":
                            foreach ( $data_post as $k => $v ) {
                                $data_date_js = "";
                                $data_ticks   = '';
                                foreach ( $v[ 'date' ] as $key => $value ) {
                                    $data_date_js .= ceil( $value[ 'average_total' ] ) . ',';
                                    $dt           = DateTime::createFromFormat( '!m', $key );
                                    $dt->format( 'F' );
                                    $data_ticks .= "'" . $dt->format( 'F' ) . "',";
                                }
                                $obj        = get_post_type_object( $k );
                                $data_lable .= "{label:'" . $obj->labels->singular_name . "'},";
                                $data_value .= $k . ',';
                                $data_key   .= " var " . $k . " = [" . $data_date_js . "]; ";
                            }
                            $default[ 'data_key' ]   = $data_key;
                            $default[ 'data_lable' ] = "var data_lable=[" . $data_lable . "];";
                            $default[ 'data_value' ] = "var data_value=[" . $data_value . "];";
                            $default[ 'data_ticks' ] = "var data_ticks=[" . $data_ticks . "];";
                            break;
                        case "quarter":
                            foreach ( $data_post as $k => $v ) {
                                $data_date_js = "";
                                $data_ticks   = '';
                                $total_price  = 0;
                                foreach ( $v[ 'date' ] as $key => $value ) {
                                    if ( $key <= 3 ) {
                                        $total_price += ceil( $value[ 'average_total' ] );
                                        if ( $key == 3 ) {
                                            $data_date_js .= $total_price . ',';
                                            $data_ticks   .= "'" . __( "Quarter 1", ST_TEXTDOMAIN ) . "',";
                                            $total_price  = 0;
                                        }
                                    }
                                    if ( $key <= 6 and $key > 3 ) {
                                        $total_price += ceil( $value[ 'average_total' ] );
                                        if ( $key == 6 ) {
                                            $data_date_js .= $total_price . ',';
                                            $data_ticks   .= "'" . __( "Quarter 2", ST_TEXTDOMAIN ) . "',";
                                            $total_price  = 0;
                                        }
                                    }
                                    if ( $key <= 9 and $key > 6 ) {
                                        $total_price += ceil( $value[ 'average_total' ] );
                                        if ( $key == 9 ) {
                                            $data_date_js .= $total_price . ',';
                                            $data_ticks   .= "'" . __( "Quarter 3", ST_TEXTDOMAIN ) . "',";
                                            $total_price  = 0;
                                        }
                                    }
                                    if ( $key <= 12 and $key > 9 ) {
                                        $total_price += ceil( $value[ 'average_total' ] );
                                        if ( $key == 12 ) {
                                            $data_date_js .= $total_price . ',';
                                            $data_ticks   .= "'" . __( "Quarter 4", ST_TEXTDOMAIN ) . "',";
                                            $total_price  = 0;
                                        }
                                    }
                                }
                                $obj        = get_post_type_object( $k );
                                $data_lable .= "{label:'" . $obj->labels->singular_name . "'},";
                                $data_value .= $k . ',';
                                $data_key   .= " var " . $k . " = [" . $data_date_js . "]; ";
                            }
                            $default[ 'data_key' ]   = $data_key;
                            $default[ 'data_lable' ] = "var data_lable=[" . $data_lable . "];";
                            $default[ 'data_value' ] = "var data_value=[" . $data_value . "];";
                            $default[ 'data_ticks' ] = "var data_ticks=[" . $data_ticks . "];";
                            break;
                        case "year":
                            foreach ( $data_post as $k => $v ) {
                                $data_date_js = $total_price = "";
                                $data_ticks   = '';
                                foreach ( $v[ 'year' ] as $key => $value ) {
                                    $price = 0;
                                    if ( !empty( $value[ 'average_total' ] ) ) {
                                        $price = ceil( $value[ 'average_total' ] );
                                    }
                                    $data_date_js .= $price . ',';
                                    $data_ticks   .= "'" . $key . "',";
                                }
                                $obj        = get_post_type_object( $k );
                                $data_lable .= "{label:'" . $obj->labels->singular_name . "'},";
                                $data_value .= $k . ',';
                                $data_key   .= " var " . $k . " = [" . $data_date_js . "]; ";
                            }
                            $default[ 'data_key' ]   = $data_key;
                            $default[ 'data_lable' ] = "var data_lable=[" . $data_lable . "];";
                            $default[ 'data_value' ] = "var data_value=[" . $data_value . "];";
                            $default[ 'data_ticks' ] = "var data_ticks=[" . $data_ticks . "];";
                            break;
                        case "15days":
                            foreach ( $data_post as $k => $v ) {
                                $data_date_js = "";
                                $data_ticks   = '';
                                foreach ( $v[ 'date' ] as $key => $value ) {
                                    $data_date_js .= ceil( $value[ 'average_total' ] ) . ',';
                                    $data_ticks   .= "'" . $key . "',";
                                }
                                $obj        = get_post_type_object( $k );
                                $data_lable .= "{label:'" . $obj->labels->singular_name . "'},";
                                $data_value .= $k . ',';
                                $data_key   .= " var " . $k . " = [" . $data_date_js . "]; ";
                            }
                            $default[ 'data_key' ]   = $data_key;
                            $default[ 'data_lable' ] = "var data_lable=[" . $data_lable . "];";
                            $default[ 'data_value' ] = "var data_value=[" . $data_value . "];";
                            $default[ 'data_ticks' ] = "var data_ticks=[" . $data_ticks . "];";
                            break;
                        case "custom_date":
                            foreach ( $data_post as $k => $v ) {
                                $data_date_js = "";
                                $data_ticks   = '';
                                foreach ( $v[ 'date' ] as $key => $value ) {
                                    $data_date_js .= ceil( $value[ 'average_total' ] ) . ',';
                                    $data_ticks   .= "'" . $key . "',";
                                }
                                $obj        = get_post_type_object( $k );
                                $data_lable .= "{label:'" . $obj->labels->singular_name . "'},";
                                $data_value .= $k . ',';
                                $data_key   .= " var " . $k . " = [" . $data_date_js . "]; ";
                            }
                            $default[ 'data_key' ]   = $data_key;
                            $default[ 'data_lable' ] = "var data_lable=[" . $data_lable . "];";
                            $default[ 'data_value' ] = "var data_value=[" . $data_value . "];";
                            $default[ 'data_ticks' ] = "var data_ticks=[" . $data_ticks . "];";
                            break;
                    }
                }

                return $default;
            }

            /*
        * since 1.1.2
        */
            function st_change_status_post_type_func()
            {
                $data_id      = $_REQUEST[ 'data_id' ];
                $data_id_user = $_REQUEST[ 'data_id_user' ];
                $status       = $_REQUEST[ 'status' ];
                $data_post    = get_post( $data_id );
                if ( $data_post->post_author == $data_id_user ) {
                    if ( $status == 'on' ) {
                        $_status_old = get_post_meta( $data_post->ID, '_post_status_old', true );
                        if ( empty( $_status_old ) or $_status_old == 'trash' )
                            $_status_old = 'draft';

                        $data_post->post_status = $_status_old;
                    }
                    if ( $status == 'off' ) {
                        update_post_meta( $data_post->ID, '_post_status_old', $data_post->post_status );
                        $data_post->post_status = 'trash';
                    }
                    $post = [ 'ID' => $data_post->ID, 'post_status' => $data_post->post_status ];
                    wp_update_post( $post );
                    echo json_encode( [
                        'status'      => 'true',
                        'msg'         => $data_id,
                        'type'        => 'success',
                        'content'     => 'Update successfully',
                        'data_status' => $data_post->post_status
                    ] );
                } else {
                    echo json_encode( [
                        'status'      => 'false',
                        'msg'         => $data_id,
                        'type'        => 'danger',
                        'content'     => 'Update not successfully',
                        'data_status' => $data_post->post_status
                    ] );
                }
                die();
            }

            /*
        * since 1.1.2
        */
            static function st_get_icon_status_partner( $id = false )
            {
                if ( !$id )
                    $id = get_the_ID();

                $status = get_post_status( $id );
                if ( $status == 'draft' ) {
                    $icon_class = 'status_warning fa-warning';
                }
                if ( $status == 'publish' ) {
                    $icon_class = 'status_ok  fa-check-square-o';
                }
                if ( empty( $icon_class ) ) {
                    $_status = get_post_meta( get_the_ID(), '_post_status_old', true );
                    if ( $_status == 'draft' ) {
                        $icon_class = 'status_warning fa-warning';
                    }
                    if ( $_status == 'publish' ) {
                        $icon_class = 'status_ok  fa-check-square-o';
                    }
                }
                if ( empty( $icon_class ) ) {
                    $icon_class = 'status_warning fa-warning';
                }

                return $icon_class;
            }

            /***
             *
             *
             * since 1.1.6
             */
            static function st_check_edit_partner( $id )
            {
                if ( empty( $id ) ) return false;
                $current_user = wp_get_current_user();
                $data_post    = get_post( $id );
                if ( $data_post->post_author == $current_user->ID ) {
                    return true;
                } else {
                    return false;
                }
            }

            /***
             *
             *
             * since 1.1.6
             */
            static function st_check_post_term_partner( $post_id, $taxonomy, $terms )
            {
                $is_check = false;
                if ( !empty( $post_id ) ) {
                    $my_terms = wp_get_post_terms( $post_id, $taxonomy );
                    foreach ( $my_terms as $k => $v ) {
                        if ( $terms == $v->term_id ) {
                            $is_check = true;
                        }
                    }
                }

                if ( !empty( $_REQUEST[ 'taxonomy' ] ) ) {
                    $array = STInput::request( 'taxonomy' );
                    $value = $terms . ',' . $taxonomy;
                    if ( in_array( $value, $array ) ) {
                        $is_check = true;
                    }

                }

                return $is_check;

            }

            /***
             *
             *
             * since 1.1.6
             */
            static function st_get_breadcrumb_partner()
            {
                $current_user = wp_get_current_user();
                $lever        = $current_user->roles;
                $lever        = array_shift( $lever );
                $default_page = "setting";
                if ( STUser_f::check_lever_partner( $lever ) and st()->get_option( 'partner_enable_feature' ) == 'on' ) {
                    $default_page = "dashboard";
                }
                $html = ' <li><i class="fa fa-home"></i><a href="' . add_query_arg( 'sc', $default_page, get_the_permalink() ) . '"> ' . __( " Home ", ST_TEXTDOMAIN ) . ' </a><i class="fa fa-angle-right"></i></li>';
                $sc   = STInput::request( 'sc' );
                switch ( $sc ) {
                    case "dashboard":
                        $html .= '<li>&nbsp;<a href="' . add_query_arg( 'sc', 'dashboard', get_the_permalink() ) . '">' . __( " Dashboard ", ST_TEXTDOMAIN ) . '</a></li>';
                        break;
                    case "dashboard-info":
                        $type          = STInput::request( 'type' );
                        $obj_post_type = get_post_type_object( $type );
                        $html          .= '<li>&nbsp;' . $obj_post_type->labels->singular_name . ' ' . __( "statistics", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "overview":
                        $html .= '<li>&nbsp;' . __( " Overview ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "setting":
                        $html .= '<li>&nbsp;' . __( " Setting ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-history":
                        $html .= '<li>&nbsp;' . __( " Booking History ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "wishlist":
                        $html .= '<li>&nbsp;' . __( "Wishlist", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "reports":
                        $html .= '<li>&nbsp;' . __( "Reports", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-hotel":
                        $html .= '<li>&nbsp;' . __( "Add new Hotel", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-hotel":
                        $html .= '<li>&nbsp;' . __( "My Hotel", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-room":
                        $html .= '<li>&nbsp;' . __( "Add new room", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-room":
                        $html .= '<li>&nbsp;' . __( "My Room", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-hotel":
                        $html .= '<li>&nbsp;' . __( "Hotel Bookings", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-hotel-room":
                        $html .= '<li>&nbsp;' . __( "Room Bookings", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-rental":
                        $html .= '<li>&nbsp;' . __( "Add new rental", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-rental":
                        $html .= '<li>&nbsp;' . __( "My Rental", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-room-rental":
                        $html .= '<li>&nbsp;' . __( "Add new Rental Room", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-room-rental":
                        $html .= '<li>&nbsp;' . __( "My Rental Room", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-rental":
                        $html .= '<li>&nbsp;' . __( "Rental Bookings/Reservations", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-cars":
                        $html .= '<li>&nbsp;' . __( "Add new car", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-cars":
                        $html .= '<li>&nbsp;' . __( "Add new car", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-cars":
                        $html .= '<li>&nbsp;' . __( "Car Bookings", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-tours":
                        $html .= '<li>&nbsp;' . __( "Add new tour", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-tours":
                        $html .= '<li>&nbsp;' . __( "My Tour", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-tours":
                        $html .= '<li>&nbsp;' . __( "Tour Bookings", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-flight":
                        $html .= '<li>&nbsp;' . __( "Add new flight", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-flights":
                        $html .= '<li>&nbsp;' . __( "My Flights", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "booking-flight":
                        $html .= '<li>&nbsp;' . __( "Flight Bookings", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "create-activity":
                        $html .= '<li>&nbsp;' . __( "Add new activity ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "my-activity":
                        $html .= '<li>&nbsp;' . __( "My Activities", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-hotel":
                        $html .= '<li>&nbsp;' . __( "Edit Hotel", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-room":
                        $html .= '<li>&nbsp;' . __( "Edit Room Hotel", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-rental":
                        $html .= '<li>&nbsp;' . __( "Edit Rental ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-room-rental":
                        $html .= '<li>&nbsp;' . __( "Edit Room Rental", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-car":
                        $html .= '<li>&nbsp;' . __( "Edit Car ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-tour":
                        $html .= '<li>&nbsp;' . __( "Edit Tour ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "edit-activity":
                        $html .= '<li>&nbsp;' . __( "Edit Activity ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "certificate":
                        $html .= '<li>&nbsp;' . __( "Certificate ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "withdrawal":
                        $html .= '<li>&nbsp;' . __( "Withdrawal ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "withdrawal-history":
                        $html .= '<li>&nbsp;' . __( "Withdrawal History ", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    case "list-refund":
                        $html .= '<li>&nbsp;' . __( "Refund", ST_TEXTDOMAIN ) . '</li>';
                        break;
                    default:
                        $html .= '<li>&nbsp;' . __( "Dashboard", ST_TEXTDOMAIN ) . '</li>';
                }

                return $html;
            }

            /***
             *
             *
             * since 1.1.6
             */
            static function st_get_title_head_partner()
            {
                $html = "";
                $sc   = STInput::request( 'sc' );
                switch ( $sc ) {
                    case "dashboard":
                        $html .= __( " Dashboard ", ST_TEXTDOMAIN );
                        break;
                    case "dashboard-info":
                        $type          = STInput::request( 'type' );
                        $obj_post_type = get_post_type_object( $type );
                        $html          .= $obj_post_type->labels->singular_name . ' ' . __( "statistics", ST_TEXTDOMAIN );
                        break;
                    case "overview":
                        $html .= __( " Overview ", ST_TEXTDOMAIN );
                        break;
                    case "setting":
                        $html .= __( " Setting ", ST_TEXTDOMAIN );
                        break;
                    case "booking-history":
                        $html .= __( " Booking History ", ST_TEXTDOMAIN );
                        break;
                    case "wishlist":
                        $html .= __( "Wishlist", ST_TEXTDOMAIN );
                        break;
                    case "reports":
                        $html .= __( "Reports", ST_TEXTDOMAIN );
                        break;
                    case "create-hotel":
                        $html .= __( "Add new Hotel", ST_TEXTDOMAIN );
                        break;
                    case "my-hotel":
                        $html .= __( "My Hotel", ST_TEXTDOMAIN );
                        break;
                    case "create-room":
                        $html .= __( "Add new room", ST_TEXTDOMAIN );
                        break;
                    case "my-room":
                        $html .= __( "My Room", ST_TEXTDOMAIN );
                        break;
                    case "booking-hotel":
                        $html .= __( "Hotel Bookings", ST_TEXTDOMAIN );
                        break;
                    case "create-rental":
                        $html .= __( "Add new rental", ST_TEXTDOMAIN );
                        break;
                    case "my-rental":
                        $html .= __( "My Rental", ST_TEXTDOMAIN );
                        break;
                    case "create-room-rental":
                        $html .= __( "Add new Rental Room", ST_TEXTDOMAIN );
                        break;
                    case "my-room-rental":
                        $html .= __( "My Rental Room", ST_TEXTDOMAIN );
                        break;
                    case "booking-rental":
                        $html .= __( "Rental Bookings/Reservations", ST_TEXTDOMAIN );
                        break;
                    case "create-cars":
                        $html .= __( "Add new car", ST_TEXTDOMAIN );
                        break;
                    case "my-cars":
                        $html .= __( "Add new car", ST_TEXTDOMAIN );
                        break;
                    case "booking-cars":
                        $html .= __( "Car Bookings", ST_TEXTDOMAIN );
                        break;
                    case "create-tours":
                        $html .= __( "Add new tour", ST_TEXTDOMAIN );
                        break;
                    case "my-tours":
                        $html .= __( "My Tour", ST_TEXTDOMAIN );
                        break;
                    case "booking-tours":
                        $html .= __( "Tour Bookings", ST_TEXTDOMAIN );
                        break;
                    case "create-flight":
                        $html .= __( "Add new flight", ST_TEXTDOMAIN );
                        break;
                    case "my-flights":
                        $html .= __( "My Flight", ST_TEXTDOMAIN );
                        break;
                    case "booking-flight":
                        $html .= __( "Flight Bookings", ST_TEXTDOMAIN );
                        break;
                    case "create-activity":
                        $html .= __( "Add new activity ", ST_TEXTDOMAIN );
                        break;
                    case "my-activity":
                        $html .= __( "My Activities", ST_TEXTDOMAIN );
                        break;
                    case "edit-hotel":
                        $html .= __( "Edit Hotel", ST_TEXTDOMAIN );
                        break;
                    case "edit-room":
                        $html .= __( "Edit Room Hotel", ST_TEXTDOMAIN );
                        break;
                    case "edit-rental":
                        $html .= __( "Edit Rental ", ST_TEXTDOMAIN );
                        break;
                    case "edit-room-rental":
                        $html .= __( "Edit Room Rental", ST_TEXTDOMAIN );
                        break;
                    case "edit-car":
                        $html .= __( "Edit Car ", ST_TEXTDOMAIN );
                        break;
                    case "edit-tour":
                        $html .= __( "Edit Tour ", ST_TEXTDOMAIN );
                        break;
                    case "edit-activity":
                        $html .= __( "Edit Activity ", ST_TEXTDOMAIN );
                        break;
                    case "booking-activity":
                        $html .= __( "Activity Bookings", ST_TEXTDOMAIN );
                        break;
                    default:
                        $html .= __( "Dashboard", ST_TEXTDOMAIN );
                }

                return $html;
            }

            /***
             *
             *
             * since 1.1.9
             */
            static function get_custom_date_reports_partner()
            {
                $the_week     = STUser_f::get_week_reports();
                $last_7_days  = date( 'Y-m-d', strtotime( 'today - 7 days' ) );
                $last_15_days = date( 'Y-m-d', strtotime( 'today - 15 days' ) );
                $last_60_days = date( 'Y-m-d', strtotime( 'today - 60 days' ) );
                $last_90_days = date( 'Y-m-d', strtotime( 'today - 90 days' ) );
                $yesterday    = date( 'Y-m-d', strtotime( 'today - 1 days' ) );

                $last_month_start = date( "Y-m-d", strtotime( "first day of previous month" ) );
                $last_month_end   = date( "Y-m-d", strtotime( "last day of previous month" ) );

                $_4_month_ago_start = date( "Y-m-d", strtotime( "first day of previous month - 2 month" ) );
                $_4_month_ago_end   = date( "Y-m-t" );

                return $defaut = [
                    'd'           => date( 'd' ),
                    'm'           => date( 'm' ),
                    'y'           => date( 'Y' ),
                    'last_7days'  => $last_7_days,
                    'last_15days' => $last_15_days,
                    'last_60days' => $last_60_days,
                    'last_90days' => $last_90_days,
                    'yesterday'   => $yesterday,
                    'date_now'    => date( 'Y-m-d' ),
                    'the_week'    => $the_week,
                    'last_year'   => date( "Y" ) - 1,
                    'last_month'  => [
                        'start' => $last_month_start,
                        'end'   => $last_month_end,
                    ],
                    '4_month_ago' => [
                        'start' => $_4_month_ago_start,
                        'end'   => $_4_month_ago_end,
                    ],
                ];
            }

            /***
             *
             *
             * since 1.1.9
             */
            static function _get_data_reports_partner_new( $post_type, $date_start = false, $date_end = false )
            {
                $data_items = [];
                if ( !empty( $post_type ) and is_array( $post_type ) ) {
                    $data_post_type = "";
                    foreach ( $post_type as $k => $v ) {
                        $data_post_type .= "'" . $v . "',";
                    }
                    $data_post_type = substr( $data_post_type, 0, -1 );
                    $date_start     = date( "Y-m-d", strtotime( $date_start ) );
                    $date_end       = date( "Y-m-d", strtotime( $date_end ) );
                    global $wpdb;
                    global $current_user;
                    wp_get_current_user();
                    $user_id    = $current_user->ID;
                    $sql        = "SELECT * FROM  " . $wpdb->prefix . "st_order_item_meta
                        WHERE 1=1
                        AND
                        (
                          created >= '" . $date_start . "' AND created <= '" . $date_end . "'
                        )
                        AND partner_id = " . $user_id . "
                        AND (status = 'complete' OR status = 'wc-completed' OR(status ='canceled' AND CAST(cancel_refund as UNSIGNED ) > 0 AND cancel_refund_status IN ('complete', 'pending')))
                        AND st_booking_post_type IN (" . $data_post_type . ")
                        AND st_booking_post_type != ''
                        GROUP BY wc_order_id
                ";
                    $data_items = $wpdb->get_results( $sql );
                }

                return $data_items;
            }


            /***
             *
             *
             * since 1.1.9
             */
            static function st_get_data_reports_partner( $post_type, $type_date, $date_start = false, $date_end = false )
            {
                $data = self::get_default_info_reports( $type_date, $date_start, $date_end );
                if ( $post_type == "all" ) $post_type = TravelHelper::get_all_post_type();
                if ( !empty( $post_type ) and is_array( $post_type ) ) {
                    $data_items   = self::_get_data_reports_partner_new( $post_type, $date_start, $date_end );
                    $total_price  = 0;
                    $total_orders = 0;
                    foreach ( $data_items as $k => $v ) {
                        $item_price = 0;
                        if ( !empty( $v->st_booking_post_type ) ) {

                            //  $item_price = $v->total_order;
                            $currency = TravelHelper::_get_currency_book_history( $v->order_item_id );

                            $item_price = 0;
                            if ( $v->type == 'normal_booking' ) {
                                $item_price = get_post_meta( $v->order_item_id, 'total_price', true );
                                $item_price = TravelHelper::convert_money_from_to( $item_price, $currency );
                            }
                            if ( $v->type == 'woocommerce' ) {
                                $item_price = get_post_meta( $v->wc_order_id, '_order_total', true );
                                $item_price = TravelHelper::convert_money_from_to( $item_price, $currency );
                            }

                            if ( $v->type == 'normal_booking' && $v->status == 'canceled' && (float)$v->cancel_refund > 0 && $v->cancel_refund_status == 'complete' ) {
                                $total_order = (float)get_post_meta( $v->order_item_id, 'total_price', true );
                                $price       = $total_order - (float)$v->cancel_refund;
                                $cancel_data = get_post_meta( $v->order_item_id, 'cancel_data', true );
                                $item_price  = TravelHelper::get_price_refund_for_partner( $price, $cancel_data, $v->commission );
                            } else {
                                $commission = $v->commission;
                                if ( !empty( $commission ) AND (float)$commission > 0 ) {
                                    $item_price = $item_price - ( $item_price / 100 ) * (float)$commission;
                                }
                            }

                            $date_create = date( "m-d-Y", strtotime( $v->created ) );
                            if ( !empty( $data[ 'post_type' ] ) ) {
                                $data[ 'post_type' ][ $v->st_booking_post_type ][ 'ids' ][]                                   = $v->st_booking_id;
                                $data[ 'post_type' ][ $v->st_booking_post_type ][ 'date' ][ $date_create ][ 'average_total' ] += $item_price;
                                $data[ 'post_type' ][ $v->st_booking_post_type ][ 'average_total' ]                           += $item_price;
                                $total_price                                                                                  += $item_price;


                                $data[ 'post_type' ][ $v->st_booking_post_type ][ 'date' ][ $date_create ][ 'number_orders' ] += 1;
                                $data[ 'post_type' ][ $v->st_booking_post_type ][ 'number_orders' ]                           += 1;
                                $total_orders                                                                                 += 1;

                                $data[ 'date' ][ $date_create ][ 'average_total' ] += $item_price;
                                $data[ 'date' ][ $date_create ][ 'number_orders' ] += 1;

                                $data[ 'post_type' ][ $v->st_booking_post_type ][ 'ids_orders' ][] = $v->wc_order_id;
                            }

                        }
                    }
                    $data[ 'average_total' ] = $total_price;
                    $data[ 'number_orders' ] = $total_orders;
                }

                return $data;
            }

            /***
             * SINGLE TIME
             *
             * since 1.1.9
             */
            static function st_get_data_reports_partner_info_year( $post_type )
            {
                $data_item = [];
                if ( !empty( $post_type ) ) {
                    global $wpdb;
                    global $current_user;
                    wp_get_current_user();


                    $user_id     = $current_user->ID;
                    $list_not_in = TravelHelper::get_all_post_type_not_in();
                    $sql         = "SELECT * FROM  " . $wpdb->prefix . "st_order_item_meta
                        WHERE 1=1
                        AND partner_id = " . $user_id . "
                        AND st_booking_post_type IN ('" . $post_type . "')
                        AND (status = 'complete' OR ( status = 'canceled' AND CAST( cancel_refund as UNSIGNED ) > 0 AND cancel_refund_status IN ('complete', 'pending')) )
                        AND st_booking_post_type not in {$list_not_in}
                        GROUP BY wc_order_id
                ";

                    $data_items = $wpdb->get_results( $sql );
                    if ( !empty( $data_items ) ) {
                        foreach ( $data_items as $k => $v ) {
                            //$item_price = $v->total_order;
                            $item_price = 0;
                            if ( $v->type == 'normal_booking' ) {
                                $item_price = get_post_meta( $v->order_item_id, 'total_price', true );
                            }
                            if ( $v->type == 'woocommerce' ) {
                                $item_price = get_post_meta( $v->wc_order_id, '_order_total', true );
                            }
                            if ( $v->type == 'normal_booking' && $v->status == 'canceled' && (float)$v->cancel_refund > 0 && $v->cancel_refund_status == 'complete' ) {
                                $total_order = (float)get_post_meta( $v->order_item_id, 'total_price', true );
                                $price       = $total_order - (float)$v->cancel_refund;
                                $cancel_data = get_post_meta( $v->order_item_id, 'cancel_data', true );
                                $item_price  = TravelHelper::get_price_refund_for_partner( $price, $cancel_data, $v->commission );
                            } else {
                                $commission = $v->commission;
                                if ( !empty( $commission ) AND (float)$commission > 0 ) {
                                    $item_price = $item_price - ( $item_price / 100 ) * (float)$commission;
                                }
                            }
                            $date_create = date( "Y", strtotime( $v->created ) );
                            if ( empty( $data_item[ $date_create ][ 'average_total' ] ) ) $data_item[ $date_create ][ 'average_total' ] = 0;
                            if ( empty( $data_item[ $date_create ][ 'number_orders' ] ) ) $data_item[ $date_create ][ 'number_orders' ] = 0;
                            $data_item[ $date_create ][ 'average_total' ] += $item_price;
                            $data_item[ $date_create ][ 'number_orders' ] += 1;
                        }
                    }
                    ksort( $data_item );
                }

                return $data_item;
            }

            /***
             * SINGLE TIME
             *
             * since 1.1.9
             */
            static function _st_load_month_by_year_partner()
            {
                $year      = STInput::request( 'data_year' );
                $post_type = STInput::request( 'data_post_type' );
                $start     = $year . "-1-1";
                $end       = $year . "-12-31";
                global $wpdb;
                global $current_user;
                wp_get_current_user();
                $user_id     = $current_user->ID;
                $list_not_in = TravelHelper::get_all_post_type_not_in();
                $sql         = "SELECT * FROM  " . $wpdb->prefix . "st_order_item_meta
                        WHERE 1=1
                         AND
                        (
                          created >= '" . $start . "' AND created <= '" . $end . "'
                        )
                        AND partner_id = " . $user_id . "
                        AND (status = 'complete' OR ( status = 'canceled' AND CAST( cancel_refund as UNSIGNED ) > 0 AND cancel_refund_status IN ('complete', 'pending')) )
                        AND st_booking_post_type IN ('" . $post_type . "')
                        AND st_booking_post_type not in {$list_not_in}
                        GROUP BY wc_order_id
                ";
                for ( $i = 1; $i <= 12; $i++ ) {
                    $number              = sprintf( '%02d', $i );
                    $data_tmp[ $number ] = [
                        'price' => 0,
                        'order' => 0
                    ];
                }
                $data_items  = $wpdb->get_results( $sql );
                $price_total = 0;
                $order_total = 0;
                // if ( !empty( $data_items ) ) {
                    foreach ( $data_items as $k => $v ) {
                        $item_price = 0;
                        if ( $v->type == 'normal_booking' ) {
                            $item_price = get_post_meta( $v->order_item_id, 'total_price', true );
                        }
                        if ( $v->type == 'woocommerce' ) {
                            $item_price = get_post_meta( $v->wc_order_id, '_order_total', true );
                        }

                        if ( $v->type == 'normal_booking' && $v->status == 'canceled' && (float)$v->cancel_refund > 0 && $v->cancel_refund_status == 'complete' ) {
                            $total_order = (float)get_post_meta( $v->order_item_id, 'total_price', true );
                            $price       = $total_order - (float)$v->cancel_refund;
                            $cancel_data = get_post_meta( $v->order_item_id, 'cancel_data', true );
                            $item_price  = TravelHelper::get_price_refund_for_partner( $price, $cancel_data, $v->commission );
                        } else {
                            $commission = $v->commission;
                            if ( !empty( $commission ) AND (float)$commission > 0 ) {
                                $item_price = $item_price - ( $item_price / 100 ) * (float)$commission;
                            }
                        }

                        $date_create                         = date( "m", strtotime( $v->created ) );
                        $data_tmp[ $date_create ][ 'price' ] += $item_price;
                        $data_tmp[ $date_create ][ 'order' ] += 1;
                        $price_total                         += $item_price;
                        $order_total                         += 1;
                    }
                    $html       = $data_lable = $data_price = '';
                    $data_lable = $data_price = '[';
                    foreach ( $data_tmp as $k => $v ) {
                        $dt = DateTime::createFromFormat( '!m', $k );
                        if ( $v[ 'price' ] > 0 ) {
                            if ( $v[ 'price' ] == 0 ) $price = $v[ 'price' ]; else $price = TravelHelper::format_money( $price = $v[ 'price' ] );
                            $html .= '<tr>
                            <td>
                            <span class="btn_show_day_by_month_year_partner text-color" data-title="' . __( "View", ST_TEXTDOMAIN ) . '" data-loading="' . __( "Loading...", ST_TEXTDOMAIN ) . '" data-post-type="' . $post_type . '" data-year="' . $year . '" data-month="' . $k . '" >
                            ' . $dt->format( 'F' ) . '
                             </a>
                            </td>
                            <td class="text-center">' . $v[ 'order' ] . '</td>
                            <td class="text-center">' . $price . '</td>
                        </tr>';
                        }
                        $data_lable .= '"' . $dt->format( 'F' ) . '",';
                        $data_price .= '"' . $v[ 'price' ] . '",';
                    }
                    if ( $price_total > 0 ) $tmp_price = TravelHelper::format_money( $price_total ); else $tmp_price = 0;
                    $html       .= '<tr class="bg-white">
                        <th>' . __( "Total", ST_TEXTDOMAIN ) . '</th>
                        <td class="text-center">' . $order_total . '</td>
                        <td class="text-center">' . $tmp_price . '</td>
                    </tr>';
                    $data_lable = substr( $data_lable, 0, -1 );
                    $data_price = substr( $data_price, 0, -1 );
                    $data_lable .= ']';
                    $data_price .= ']';
                    $json       = [
                        'id_rand'  => strtotime( 'now' ),
                        'html'     => $html,
                        'js'       => [
                            'lable' => $data_lable,
                            'data'  => $data_price,
                        ],
                        'bc_title' => '<span class="btn_single_all_time">' . __( "All Time", ST_TEXTDOMAIN ) . '</span>  <span class="active">' . $year . '</span>',
                    ];
                    echo json_encode( $json );
                    die();
                // }
            }

            /***
             * SINGLE TIME
             *
             * since 1.1.9
             */
            static function _st_load_day_by_month_and_year_partner()
            {
                $month     = STInput::request( 'data_month' );
                $year      = STInput::request( 'data_year' );
                $post_type = STInput::request( 'data_post_type' );

                $start = $year . "-" . $month . "-1";
                $end   = date( "Y-m-t", strtotime( $start ) );

                $data = self::st_get_data_reports_partner( [ $post_type ], 'custom_date', $start, $end );
                $data = $data[ 'post_type' ][ $post_type ];

                $html = "";
                foreach ( $data[ 'date' ] as $k => $v ) {
                    $dt = DateTime::createFromFormat( 'm-d-Y', $k );
                    if ( $v[ 'number_orders' ] > 0 ) {
                        if ( $v[ 'average_total' ] == 0 ) $price = $v[ 'average_total' ]; else $price = TravelHelper::format_money( $price = $v[ 'average_total' ] );
                        $html .= '<tr>
                            <td>' . $dt->format( 'd' ) . '</td>
                            <td class="text-center">' . $v[ 'number_orders' ] . '</td>
                            <td class="text-center">' . $price . '</td>
                          </tr>';
                    }
                }
                if ( $data[ 'average_total' ] > 0 ) $tmp_price = TravelHelper::format_money( $data[ 'average_total' ] ); else $tmp_price = 0;
                $html    .= '<tr class="bg-white">
                        <th>' . __( "Total", ST_TEXTDOMAIN ) . '</th>
                        <td class="text-center">' . $data[ 'number_orders' ] . '</td>
                        <td class="text-center">' . $tmp_price . '</td>
                    </tr>';
                $data_js = STUser_f::_conver_array_to_data_js_reports( $data[ 'date' ], 'all', 'month' );
                $dt      = DateTime::createFromFormat( '!m', $month );
                echo json_encode( [
                    'js'       => $data_js,
                    'html'     => $html,
                    'bc_title' => '<span class="btn_single_all_time">' . __( "All Time", ST_TEXTDOMAIN ) . '</span> <span class="btn_single_year">' . $year . '</span>  <span class="active">' . $dt->format( 'F' ) . '</span>',
                    'id_rand'  => strtotime( 'now' )
                ] );


                die();
            }

            /***
             * ALL TIME
             *
             * since 1.1.9
             */

            /***
             * ALL TIME
             *
             * since 1.1.9
             */
            static function st_get_data_reports_total_all_time_partner( $user_id = false )
            {
                $data = [];
                global $wpdb;
                global $current_user;
                wp_get_current_user();
                if ( empty( $user_id ) ) {
                    $user_id = $current_user->ID;
                }

                /*$year_start = date_i18n('Y',strtotime($current_user->data->user_registered));
            $year_end = date("Y");
            $number = $year_end - $year_start;
            if($number >= 0){
                $data_item[$year_start] = array('average_total'=>0,'number_orders'=>0);
                for($i=0 ; $i <= $number ; $i++){
                    $year = $year_start + $i;
                    $data['date'][$year]['average_total'] = 0;
                    $data['date'][$year]['number_orders'] = 0;
                }
            }*/
                $list_not_in = TravelHelper::get_all_post_type_not_in();
                $sql         = "SELECT * FROM  " . $wpdb->prefix . "st_order_item_meta
                    WHERE 1=1
                    AND partner_id = " . $user_id . "
                    AND (status = 'complete' OR status = 'wc-completed' OR ( status = 'canceled' AND CAST( cancel_refund as UNSIGNED ) > 0 AND cancel_refund_status IN ('complete', 'pending')) )
                    AND st_booking_post_type not in {$list_not_in}
                    GROUP BY wc_order_id";

                $data[ 'post_type' ][ 'st_hotel' ][ 'average_total' ]    = 0;
                $data[ 'post_type' ][ 'hotel_room' ][ 'average_total' ]  = 0;
                $data[ 'post_type' ][ 'st_rental' ][ 'average_total' ]   = 0;
                $data[ 'post_type' ][ 'st_cars' ][ 'average_total' ]     = 0;
                $data[ 'post_type' ][ 'st_tours' ][ 'average_total' ]    = 0;
                $data[ 'post_type' ][ 'st_activity' ][ 'average_total' ] = 0;
                $data[ 'post_type' ][ 'st_flight' ][ 'average_total' ]   = 0;

                $data[ 'post_type' ][ 'st_hotel' ][ 'total' ]    = 0;
                $data[ 'post_type' ][ 'hotel_room' ][ 'total' ]  = 0;
                $data[ 'post_type' ][ 'st_rental' ][ 'total' ]   = 0;
                $data[ 'post_type' ][ 'st_cars' ][ 'total' ]     = 0;
                $data[ 'post_type' ][ 'st_tours' ][ 'total' ]    = 0;
                $data[ 'post_type' ][ 'st_activity' ][ 'total' ] = 0;
                $data[ 'post_type' ][ 'st_flight' ][ 'total' ]   = 0;

                $data[ 'post_type' ][ 'st_hotel' ][ 'number_orders' ]    = 0;
                $data[ 'post_type' ][ 'hotel_room' ][ 'number_orders' ]  = 0;
                $data[ 'post_type' ][ 'st_rental' ][ 'number_orders' ]   = 0;
                $data[ 'post_type' ][ 'st_cars' ][ 'number_orders' ]     = 0;
                $data[ 'post_type' ][ 'st_tours' ][ 'number_orders' ]    = 0;
                $data[ 'post_type' ][ 'st_activity' ][ 'number_orders' ] = 0;
                $data[ 'post_type' ][ 'st_flight' ][ 'number_orders' ]   = 0;

                $data[ 'average_total' ] = 0;
                $data[ 'total' ]         = 0;
                $data[ 'number_orders' ] = 0;
                $data[ 'date' ]          = [];

                $data_items = $wpdb->get_results( $sql );
                if ( !empty( $data_items ) ) {
                    foreach ( $data_items as $k => $v ) {
                        $currency = TravelHelper::_get_currency_book_history( $v->order_item_id );
                        $type_id  = $v->st_booking_post_type;
                        if ( $v->type == 'normal_booking' ) {
                            $item_price = get_post_meta( $v->order_item_id, 'total_price', true );
                            $item_price = TravelHelper::convert_money_from_to( $item_price, $currency );
                        }
                        if ( $v->type == 'woocommerce' ) {
                            $item_price = get_post_meta( $v->wc_order_id, '_order_total', true );
                            $item_price = TravelHelper::convert_money_from_to( $item_price, $currency );
                            if ( !$v->st_booking_post_type ) {
                                $type_id = get_post_type( $v->st_booking_id );
                            }
                        }
                        if ( st_check_service_available( $type_id ) ) {
                            $item_price_old = $item_price;
                            if ( $v->type == 'normal_booking' && $v->status == 'canceled' && (float)$v->cancel_refund > 0 && $v->cancel_refund_status == 'complete' ) {
                                $total_order    = (float)get_post_meta( $v->order_item_id, 'total_price', true );
                                $price          = $total_order - (float)$v->cancel_refund;
                                $item_price_old = $price;
                                $cancel_data    = get_post_meta( $v->order_item_id, 'cancel_data', true );
                                $item_price     = TravelHelper::get_price_refund_for_partner( $price, $cancel_data, $v->commission );
                            } else {
                                $commission = $v->commission;
                                if ( !empty( $commission ) AND (float)$commission > 0 ) {
                                    $item_price = $item_price - ( $item_price / 100 ) * (float)$commission;
                                }
                            }
                            $date_create = date( "Y", strtotime( $v->created ) );
                            if ( empty( $data[ 'date' ][ $date_create ][ 'average_total' ] ) ) $data[ 'date' ][ $date_create ][ 'average_total' ] = 0;
                            if ( empty( $data[ 'date' ][ $date_create ][ 'total' ] ) ) $data[ 'date' ][ $date_create ][ 'total' ] = 0;
                            if ( empty( $data[ 'date' ][ $date_create ][ 'number_orders' ] ) ) $data[ 'date' ][ $date_create ][ 'number_orders' ] = 0;

                            $data[ 'total' ]         += $item_price_old;
                            $data[ 'number_orders' ] += 1;

                            $data[ 'date' ][ $date_create ][ 'total' ]         += $item_price_old;
                            $data[ 'date' ][ $date_create ][ 'number_orders' ] += 1;

                            if ( empty( $data[ 'post_type' ][ $type_id ][ 'total' ] ) )
                                $data[ 'post_type' ][ $type_id ][ 'total' ] = 0;
                            $data[ 'post_type' ][ $type_id ][ 'total' ] += $item_price_old;
                            if ( empty( $data[ 'post_type' ][ $type_id ][ 'number_orders' ] ) )
                                $data[ 'post_type' ][ $type_id ][ 'number_orders' ] = 0;
                            $data[ 'post_type' ][ $type_id ][ 'number_orders' ] += 1;

                            if ( !TravelerObject::check_cancel_able( $v->order_item_id ) ) {
                                $data[ 'average_total' ]                           += $item_price;
                                $data[ 'date' ][ $date_create ][ 'average_total' ] += $item_price;
                                if ( empty( $data[ 'post_type' ][ $type_id ][ 'average_total' ] ) )
                                    $data[ 'post_type' ][ $type_id ][ 'average_total' ] = 0;
                                $data[ 'post_type' ][ $type_id ][ 'average_total' ] += $item_price;
                            }
                        }
                        ksort( $data[ 'date' ] );
                    }

                    return $data;
                }

                return $data;
            }

            static function _get_total_price_split_adaptivepayment( $user_id = false )
            {
                $total_price = 0;
                global $wpdb;
                global $current_user;
                wp_get_current_user();
                if ( empty( $user_id ) ) {
                    $user_id = $current_user->ID;
                }
                $list_not_in = TravelHelper::get_all_post_type_not_in();
                $sql         = "SELECT * FROM  " . $wpdb->prefix . "st_order_item_meta
                    LEFT JOIN {$wpdb->prefix}postmeta ON {$wpdb->prefix}st_order_item_meta.order_item_id = {$wpdb->prefix}postmeta.post_id 
                    WHERE 1=1
                    AND {$wpdb->prefix}postmeta.meta_key = 'st_is_split_payment' AND {$wpdb->prefix}postmeta.meta_value = 'yes'
                    AND partner_id = " . $user_id . "
                    AND (status = 'complete' OR ( status = 'canceled' AND CAST( cancel_refund as UNSIGNED ) > 0 AND cancel_refund_status IN ('complete', 'pending')) )
                    AND st_booking_post_type not in {$list_not_in}
                    GROUP BY wc_order_id
            ";
                $data_items  = $wpdb->get_results( $sql );
                if ( !empty( $data_items ) ) {
                    foreach ( $data_items as $k => $v ) {
                        $item_price = 0;
                        $currency   = TravelHelper::_get_currency_book_history( $v->order_item_id );
                        $type_id    = $v->st_booking_post_type;
                        if ( $v->type == 'normal_booking' ) {
                            $item_price = get_post_meta( $v->order_item_id, 'total_price', true );
                            $item_price = TravelHelper::convert_money_from_to( $item_price, $currency );
                        }
                        if ( $v->type == 'woocommerce' ) {
                            $item_price = get_post_meta( $v->wc_order_id, '_order_total', true );
                            $item_price = TravelHelper::convert_money_from_to( $item_price, $currency );
                            if ( !$v->st_booking_post_type ) {
                                $type_id = get_post_type( $v->st_booking_id );
                            }
                        }
                        if ( st_check_service_available( $type_id ) ) {
                            if ( $v->type == 'normal_booking' && $v->status == 'canceled' && (float)$v->cancel_refund > 0 && $v->cancel_refund_status == 'complete' ) {
                                $total_order = (float)get_post_meta( $v->order_item_id, 'total_price', true );
                                $price       = $total_order - (float)$v->cancel_refund;
                                $cancel_data = get_post_meta( $v->order_item_id, 'cancel_data', true );
                                $commission  = $v->commission;
                                $item_price  = TravelHelper::get_price_refund_for_partner( $price, $cancel_data, $commission );
                            } else {
                                $commission = $v->commission;
                                if ( !empty( $commission ) AND (float)$commission > 0 ) {
                                    $item_price = $item_price - ( $item_price / 100 ) * (float)$commission;
                                }
                            }
                            $total_price += $item_price;
                        }
                    }
                }

                return $total_price;
            }


            /***
             * ALL TIME
             *
             * since 1.1.9
             */
            static function _st_load_month_all_time_by_year_partner()
            {
                $year  = STInput::request( 'data_year' );
                $start = $year . "-1-1";
                $end   = $year . "-12-31";
                global $wpdb;
                global $current_user;
                wp_get_current_user();
                $user_id     = $current_user->ID;
                $list_not_in = TravelHelper::get_all_post_type_not_in();
                $sql         = "SELECT * FROM  " . $wpdb->prefix . "st_order_item_meta
                        WHERE 1=1
                         AND
                        (
                          created >= '" . $start . "' AND created <= '" . $end . "'
                        )
                        AND partner_id = " . $user_id . "
                        AND (status = 'complete' OR ( status = 'canceled' AND CAST( cancel_refund as UNSIGNED ) > 0 AND cancel_refund_status IN ('complete', 'pending')) )
                        AND st_booking_post_type not in {$list_not_in}
                        GROUP BY wc_order_id
                ";
                for ( $i = 1; $i <= 12; $i++ ) {
                    $number              = sprintf( '%02d', $i );
                    $data_tmp[ $number ] = [
                        'price' => 0,
                        'order' => 0
                    ];
                }
                $data_items  = $wpdb->get_results( $sql );
                $price_total = 0;
                $order_total = 0;
                if ( !empty( $data_items ) ) {
                    foreach ( $data_items as $k => $v ) {
                        //$item_price = $v->total_order;
                        $item_price = 0;
                        if ( $v->type == 'normal_booking' ) {
                            $item_price = get_post_meta( $v->order_item_id, 'total_price', true );
                        }
                        if ( $v->type == 'woocommerce' ) {
                            $item_price = get_post_meta( $v->wc_order_id, '_order_total', true );
                        }

                        if ( $v->type == 'normal_booking' && $v->status == 'canceled' && (float)$v->cancel_refund > 0 && $v->cancel_refund_status == 'complete' ) {
                            $total_order = (float)get_post_meta( $v->order_item_id, 'total_price', true );
                            $price       = $total_order - (float)$v->cancel_refund;
                            $cancel_data = get_post_meta( $v->order_item_id, 'cancel_data', true );
                            $item_price  = TravelHelper::get_price_refund_for_partner( $price, $cancel_data, $v->commission );
                        } else {
                            $commission = $v->commission;
                            if ( !empty( $commission ) AND (float)$commission > 0 ) {
                                $item_price = $item_price - ( $item_price / 100 ) * (float)$commission;
                            }
                        }


                        $date_create                         = date( "m", strtotime( $v->created ) );
                        $data_tmp[ $date_create ][ 'price' ] += $item_price;
                        $data_tmp[ $date_create ][ 'order' ] += 1;

                        $price_total += $item_price;
                        $order_total += 1;
                    }
                }
                $html       = $data_lable = $data_price = '';
                $data_lable = $data_price = '[';

                foreach ( $data_tmp as $k => $v ) {

                    $dt = DateTime::createFromFormat( '!m', $k );
                    if ( $v[ 'price' ] > 0 ) {
                        if ( $v[ 'price' ] == 0 ) $price = $v[ 'price' ]; else $price = TravelHelper::format_money( $price = $v[ 'price' ] );
                        $html .= '<tr>
                            <td>
                            <span class="btn_all_time_show_day_by_month_year_partner text-color" data-title="' . __( "View", ST_TEXTDOMAIN ) . '" data-loading="' . __( "Loading...", ST_TEXTDOMAIN ) . '"  data-year="' . $year . '" data-month="' . $k . '" >
                            ' . $dt->format( 'F' ) . '
                             </span>
                            </td>
                            <td class="text-center">' . $v[ 'order' ] . '</td>
                            <td class="text-center">' . $price . '</td>
                        </tr>';
                    }
                    $data_lable .= '"' . $dt->format( 'F' ) . '",';
                    $data_price .= '"' . $v[ 'price' ] . '",';
                }

                if ( $price_total > 0 ) $tmp_price = TravelHelper::format_money( $price_total ); else $tmp_price = 0;
                $html .= '<tr class="bg-white">
                        <th>' . __( "Total", ST_TEXTDOMAIN ) . '</th>
                        <td class="text-center">' . $order_total . '</td>
                        <td class="text-center">' . $tmp_price . '</td>
                    </tr>';

                $data_lable = substr( $data_lable, 0, -1 );
                $data_price = substr( $data_price, 0, -1 );
                $data_lable .= ']';
                $data_price .= ']';
                $json       = [
                    'id_rand'  => strtotime( 'now' ),
                    'html'     => $html,
                    'js'       => [
                        'lable' => $data_lable,
                        'data'  => $data_price,
                    ],
                    'bc_title' => '<span class="btn_all_time">' . __( "All Time", ST_TEXTDOMAIN ) . '</span> <span class="active">' . $year . '</span>',
                ];
                echo json_encode( $json );
                die();
            }

            /***
             * ALL TIME
             *
             * since 1.1.9
             */
            static function _st_load_day_all_time_by_month_and_year_partner()
            {
                $month = STInput::request( 'data_month' );
                $year  = STInput::request( 'data_year' );
                $start = $year . "-" . $month . "-1";
                $end   = date( "Y-m-t", strtotime( $start ) );
                $data  = self::st_get_data_reports_partner( 'all', 'custom_date', $start, $end );

                $html = "";
                foreach ( $data[ 'date' ] as $k => $v ) {
                    $dt = DateTime::createFromFormat( 'm-d-Y', $k );
                    if ( $v[ 'number_orders' ] > 0 ) {
                        if ( $v[ 'average_total' ] == 0 ) $price = $v[ 'average_total' ]; else $price = TravelHelper::format_money( $price = $v[ 'average_total' ] );
                        $html .= '<tr>
                             <td>' . $dt->format( 'd' ) . '</td>
                             <td class="text-center">' . $v[ 'number_orders' ] . '</td>
                             <td class="text-center">' . $price . '</td>
                          </tr>';
                    }
                }
                if ( $data[ 'average_total' ] > 0 ) $tmp_price = TravelHelper::format_money( $data[ 'average_total' ] ); else $tmp_price = 0;
                $html    .= '<tr class="bg-white">
                        <th>' . __( "Total", ST_TEXTDOMAIN ) . '</th>
                        <td class="text-center">' . $data[ 'number_orders' ] . '</td>
                        <td class="text-center">' . $tmp_price . '</td>
                    </tr>';
                $data_js = STUser_f::_conver_array_to_data_js_reports( $data[ 'date' ], 'all', 'month' );
                $dt      = DateTime::createFromFormat( '!m', $month );
                echo json_encode( [
                    'js'       => $data_js,
                    'html'     => $html,
                    'bc_title' => '<span class="btn_all_time">' . __( "All Time", ST_TEXTDOMAIN ) . '</span> <span class="btn_all_time_year">' . $year . '</span> <span class="active">' . $dt->format( 'F' ) . '</span>',
                    'id_rand'  => strtotime( 'now' )
                ] );
                die();
            }

            /***
             *
             *
             * since 1.1.9
             */
            static function get_request_custom_date_partner()
            {
                $data             = [];
                $start_date_month = date( 'Y' ) . '-' . date( 'm' ) . '-01';
                $end_date_month   = date( 'Y' ) . '-' . date( 'm' ) . '-' . date( 't' );
                $request_type = STInput::request( 'custom_select_date', 'this_month|' . $start_date_month . '|' . $end_date_month );
                $request_type = explode( "|", $request_type );

                 /*Before*/
                $datestring=date( 'Y-m-d' ).' first day of last month';
                $dt=date_create($datestring);
                $month_before = $dt->format('m');
                $start_date_month_before = date( 'Y' ) . '-' .  $month_before . '-01';
                $end_date_month_before   = date( 'Y' ) . '-' .  $month_before . '-' . date( 't' );
                
                if ( !empty( $request_type ) ) {
                    if ( $request_type[ 0 ] == 'custom_date' ) {
                        $start = STInput::request( 'date_start' );
                        if ( empty( $start ) ) $start = $start_date_month;
                        $end = STInput::request( 'date_end' );
                        if ( empty( $end ) ) $end = $end_date_month;
                        $data = [
                            'type'  => $request_type[ 0 ],
                            'start' => $start,
                            'end'   => $end,
                        ];
                    } else {
                        $data = [
                            'type'  => $request_type[ 0 ],
                            'start' => $request_type[ 1 ],
                            'end'   => $request_type[ 2 ],
                        ];
                    }
                }
                if ( STInput::request( 'sc' ) == 'dashboard-info' ) {
                    $start = date( "Y" ) . '-1-1';
                    $end   = date( "Y" ) . '-12-31';
                    $data  = [
                        'type'  => 'this_year',
                        'start' => $start,
                        'end'   => $end,
                    ];
                }
                switch ( $data[ 'type' ] ) {
                    case "this_year":
                        $data[ 'title' ] = __( "this year", ST_TEXTDOMAIN );
                        break;
                    case "this_month":
                        $data[ 'title' ] = __( "this month", ST_TEXTDOMAIN );
                        break;
                    case "this_week":
                        $data[ 'title' ] = __( "this week", ST_TEXTDOMAIN );
                        break;
                    case "all_time":
                        $data[ 'title' ] = __( "all time", ST_TEXTDOMAIN );
                        break;
                    case "custom_date":
                    default:
                        $data[ 'title' ] = date_i18n( TravelHelper::getDateFormat(), strtotime( $data[ 'start' ] ) ) . ' - ' . date_i18n( TravelHelper::getDateFormat(), strtotime( $data[ 'end' ] ) );
                        $data[ 'start' ] = TravelHelper::convertDateFormat( $data[ 'start' ] );
                        $data[ 'end' ]   = TravelHelper::convertDateFormat( $data[ 'end' ] );
                        break;
                }

               


                return $data;
            }

            /***
             *
             *
             * since 1.1.9
             */
            static function _conver_array_to_data_js_reports( $array_php, $type_post_type, $type_date )
            {
                if ( empty( $array_php ) or !is_array( $array_php ) ) return;
                $total_price    = 0;
                $number_orders  = 0;
                $data_lable     = '[';
                $data_price     = '[';
                $data_array_php = [];
                if ( empty( $array_php ) ) $array_php = [];
                if ( $type_post_type == "all" ) {
                    if ( $type_date == 'this_year' ) {
                        /* show month */
                        $data_tmp = [ '01' => [ 'average_total' => 0, 'number_orders' => 0 ], '02' => [ 'average_total' => 0, 'number_orders' => 0 ], '03' => [ 'average_total' => 0, 'number_orders' => 0 ], '04' => [ 'average_total' => 0, 'number_orders' => 0 ], '05' => [ 'average_total' => 0, 'number_orders' => 0 ], '06' => [ 'average_total' => 0, 'number_orders' => 0 ], '07' => [ 'average_total' => 0, 'number_orders' => 0 ], '08' => [ 'average_total' => 0, 'number_orders' => 0 ], '09' => [ 'average_total' => 0, 'number_orders' => 0 ], '10' => [ 'average_total' => 0, 'number_orders' => 0 ], '11' => [ 'average_total' => 0, 'number_orders' => 0 ], '12' => [ 'average_total' => 0, 'number_orders' => 0 ] ];
                        foreach ( $array_php as $k => $v ) {
                            $date                                      = explode( '-', $k );
                            $data_tmp[ $date[ 0 ] ][ 'average_total' ] += $v[ 'average_total' ];
                            $data_tmp[ $date[ 0 ] ][ 'number_orders' ] += $v[ 'number_orders' ];
                        }
                        foreach ( $data_tmp as $k => $v ) {
                            $dt         = DateTime::createFromFormat( '!m', $k );
                            $data_lable .= '"' . $dt->format( 'F' ) . '",';
                            $data_price .= '"' . $v[ 'average_total' ] . '",';

                            if ( $v[ 'number_orders' ] > 0 ) {
                                $data_array_php[ $k ][ 'title' ]         = $dt->format( 'F' );
                                $data_array_php[ $k ][ 'average_total' ] = $v[ 'average_total' ];
                                $data_array_php[ $k ][ 'number_orders' ] = $v[ 'number_orders' ];
                                $total_price                             += $v[ 'average_total' ];
                                $number_orders                           += $v[ 'number_orders' ];
                            }

                        }
                        $data_lable = substr( $data_lable, 0, -1 );
                        $data_price = substr( $data_price, 0, -1 );
                    } elseif ( $type_date == 'year' ) {
                        /* show year */
                        foreach ( $array_php as $k => $v ) {
                            $data_lable .= '"' . $k . '",';
                            $data_price .= '"' . $v[ 'average_total' ] . '",';

                            if ( $v[ 'number_orders' ] > 0 ) {
                                $data_array_php[ $k ][ 'title' ]         = $k;
                                $data_array_php[ $k ][ 'average_total' ] = $v[ 'average_total' ];
                                $data_array_php[ $k ][ 'number_orders' ] = $v[ 'number_orders' ];
                                $total_price                             += $v[ 'average_total' ];
                                $number_orders                           += $v[ 'number_orders' ];
                            }

                        }
                        $data_lable = substr( $data_lable, 0, -1 );
                        $data_price = substr( $data_price, 0, -1 );
                    } else {
                        /* show custom date */
                        foreach ( $array_php as $k => $v ) {
                            $date_tmp   = explode( '-', $k );
                            $date       = $date_tmp[ 1 ]/*."/".$date[0]."/".$date[2]*/
                            ;
                            $data_lable .= '"' . $date . '",';
                            $data_price .= '"' . $v[ 'average_total' ] . '",';


                            $start = strtotime( $date_tmp[ 1 ] . "-" . $date_tmp[ 0 ] . "-" . $date_tmp[ 2 ] );
                            $end   = strtotime( date( 'd-m-Y' ) );
                            if ( $start <= $end ) {
                                if ( $v[ 'number_orders' ] > 0 ) {
                                    $data_array_php[ $k ][ 'title' ]         = date_i18n( 'l, d', $start );
                                    $data_array_php[ $k ][ 'average_total' ] = $v[ 'average_total' ];
                                    $data_array_php[ $k ][ 'number_orders' ] = $v[ 'number_orders' ];
                                    $total_price                             += $v[ 'average_total' ];
                                    $number_orders                           += $v[ 'number_orders' ];
                                }

                            }
                        }
                        $data_lable = substr( $data_lable, 0, -1 );
                        $data_price = substr( $data_price, 0, -1 );
                    }
                }
                if ( $type_post_type == "custom" ) {

                }
                $data_lable .= ']';
                $data_price .= ']';
                $data_array = [
                    'lable'          => $data_lable,
                    'data'           => $data_price,
                    'data_array_php' => $data_array_php,
                    'info_total'     => [
                        'average_total' => $total_price,
                        'number_orders' => $number_orders,
                    ]
                ];

                return $data_array;
            }


            static function _cancel_booking( $order_id )
            {
                $check_cancel_able = TravelerObject::check_cancel_able( $order_id );

                if ( $check_cancel_able ) {
                    global $wpdb;
                    $user_id       = get_current_user_id();
                    $order_item_id = $order_id;

                    $check_order = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}st_order_item_meta where user_id={$user_id} and  order_item_id = {$order_item_id} and `status`!='canceled' and `status`!='wc-canceled' LIMIT 0,1" );

                    if ( $check_order ) {
                        $item_id = $check_order->st_booking_id;
                        if ( $check_order->room_id ) $item_id = $check_order->room_id;
                        $cancel_percent = get_post_meta( $item_id, 'st_cancel_percent', true );

                        $query = "UPDATE {$wpdb->prefix}st_order_item_meta set `status`='canceled' , cancel_percent={$cancel_percent} where order_item_id={$order_item_id}";

                        $wpdb->query( $query );

                        update_post_meta( $order_item_id, 'status', 'canceled' );

                        return true;
                    }
                } else {
                    return false;
                }
            }

            static function get_history_bookings( $type = "st_hotel", $offset, $limit, $author = false )
            {
                global $wpdb;
                $querystr  = "
                            SELECT SQL_CALC_FOUND_ROWS * FROM (
                                           SELECT  *  FROM  " . $wpdb->prefix . "st_order_item_meta
                                                                WHERE 1=1
                                                                AND partner_id = " . $author . "
                                                                AND st_booking_post_type IN ('" . $type . "')
                                                                GROUP BY wc_order_id

                            ) AS tmp_table ORDER BY id DESC LIMIT {$offset},{$limit}
                ";
                $pageposts = $wpdb->get_results( $querystr, OBJECT );

                return [ 'total' => $wpdb->get_var( "SELECT FOUND_ROWS();" ), 'rows' => $pageposts ];
            }

            static function get_history_bookings_by_id( $id )
            {
                global $wpdb;
                $table = $wpdb->prefix . 'st_order_item_meta';

                $sql = "SELECT * FROM {$table} WHERE id=%s";

                $res = $wpdb->get_row( $wpdb->prepare( $sql, $id ) );

                if ( !empty( $res ) && count( $res ) > 0 ) {
                    return $res;
                }

                return false;
            }

            static function get_history_bookings_send_mail( $type = "st_hotel", $offset, $limit, $author = false )
            {
                global $wpdb;
                $where    = "";
                $order_by = " ORDER BY id DESC ";
                $cs_from  = STInput::request( 'from', 'csfrom' );
                if ( $cs_from != 'csfrom' ) {
                    if ( $cs_from == 'expire' ) {
                        $where .= " AND DATEDIFF(DATE_FORMAT(FROM_UNIXTIME(check_in_timestamp), '%Y-%m-%d'), CURDATE()) < 0 ";
                    }

                    if ( $cs_from != 'all' && $cs_from != 'expire' && is_numeric( $cs_from ) ) {
                        $where .= " AND DATEDIFF(DATE_FORMAT(FROM_UNIXTIME(check_in_timestamp), '%Y-%m-%d'), CURDATE()) >= {$cs_from} ";
                    }

                    $order_by = " ORDER BY expire_day ASC ";
                } else {
                    $where    .= " AND DATEDIFF(DATE_FORMAT(FROM_UNIXTIME(check_in_timestamp), '%Y-%m-%d'), CURDATE()) >= 0 ";
                    $order_by = " ORDER BY expire_day ASC ";
                }

                $cs_to = STInput::request( 'to', 'csto' );
                if ( $cs_to != 'csto' ) {
                    if ( $cs_to != 'all' && $cs_to != 'expire' && is_numeric( $cs_to ) ) {
                        $where .= " AND DATEDIFF(DATE_FORMAT(FROM_UNIXTIME(check_in_timestamp), '%Y-%m-%d'), CURDATE()) <= {$cs_to} ";
                    }
                } else {
                    $where .= " AND DATEDIFF(DATE_FORMAT(FROM_UNIXTIME(check_in_timestamp), '%Y-%m-%d'), CURDATE()) <= 5 ";
                }

                $querystr = "
                            SELECT SQL_CALC_FOUND_ROWS *, DATEDIFF(DATE_FORMAT(FROM_UNIXTIME(check_in_timestamp), '%Y-%m-%d'), CURDATE()) as expire_day FROM (
                                           SELECT  *  FROM  " . $wpdb->prefix . "st_order_item_meta
                                                                WHERE 1=1
                                                                AND partner_id = " . $author . "
                                                                AND st_booking_post_type IN ('" . $type . "')
                                                                AND status = 'complete'
                                                                " . $where . "
                                                                GROUP BY wc_order_id

                            ) AS tmp_table " . $order_by . " LIMIT {$offset},{$limit}
                ";

                $pageposts = $wpdb->get_results( $querystr, OBJECT );

                return [ 'total' => $wpdb->get_var( "SELECT FOUND_ROWS();" ), 'rows' => $pageposts ];
            }

            static function getListServicesAuthor($current_user_upage){
                $arr_service = [];
                if (STUser_f::_check_service_available_partner('st_hotel', $current_user_upage->ID)) {
                    array_push($arr_service, 'hotel');
                }
                if (STUser_f::_check_service_available_partner('st_tours', $current_user_upage->ID)) {
                    array_push($arr_service, 'tours');
                }
                if (STUser_f::_check_service_available_partner('st_activity', $current_user_upage->ID)) {
                    array_push($arr_service, 'activity');
                }
                /*if (STUser_f::_check_service_available_partner('st_activity', $current_user_upage->ID)) {
                    array_push($arr_service, 'activity');
                }
                if (STUser_f::_check_service_available_partner('st_cars', $current_user_upage->ID)) {
                    array_push($arr_service, 'cars');
                }
                if (STUser_f::_check_service_available_partner('st_rental', $current_user_upage->ID)) {
                    array_push($arr_service, 'rental');
                }
                if (STUser_f::_check_service_available_partner('st_flight', $current_user_upage->ID)) {
                    array_push($arr_service, 'flight');
                }*/

                return $arr_service;
            }

            static function getReviewsDataAuthor($arr_service, $current_user_upage){
                $arr_full_service = [];
                if (!empty($arr_service)) {
                    foreach ($arr_service as $kkk => $vvv) {
                        array_push($arr_full_service, 'st_' . $vvv);
                    }
                }
                $author_query_id = array(
                    'author' => $current_user_upage->ID,
                    'post_type' => $arr_full_service,
                    'posts_per_page' => '-1',
                    'post_status' => 'publish'
                );

                $a_query = new WP_Query($author_query_id);
                $arr_id = [];
                while ($a_query->have_posts()) {
                    $a_query->the_post();
                    array_push($arr_id, get_the_ID());
                }
                wp_reset_postdata();

                $review_data = STReview::data_comment_author_page($arr_id, 'st_reviews');

                return $review_data;
            }

            static function getAVGRatingAuthor($review_data){
                $avg_rating = 0;
                if (!empty($review_data)) {
                    $total_review_core = 0;
                    $arr_c_rate = [];
                    foreach ($review_data as $kkk => $vvv) {
                        $comment_rate = get_comment_meta($vvv['comment_ID'], 'comment_rate', true);
                        array_push($arr_c_rate, $comment_rate);
                        $total_review_core = (float)$total_review_core + (float)$comment_rate;
                    }

                    foreach ($arr_c_rate as $k => $v) {
                        if ($v == 0 || $v == '') {
                            unset($arr_c_rate[$k]);
                        }
                    }
                    if(count($arr_c_rate) > 0)
                        $avg_rating = round(array_sum($arr_c_rate) / count($arr_c_rate), 1);
                }
                return $avg_rating;
            }

            static function _check_service_available_partner( $post_type, $user_id = false )
            {
                if ( !empty( $user_id ) ) {
                    $current_user = new WP_User( $user_id );
                    $role         = $current_user->roles;
                    $role         = array_shift( $role );
                } else {
                    $current_user = wp_get_current_user();
                    $user_id      = $current_user->ID;
                    $role         = $current_user->roles;
                    $role         = array_shift( $role );
                }
                if ( st_check_service_available( $post_type ) ) {
                    if ( $role == 'administrator' || $role == 'partner' ) {
                        $admin_packages = STAdminPackages::get_inst();
                        $order          = $admin_packages->get_order_by_partner( $user_id );
                        if ( !empty( $order ) ) {
                            $package_services = $order->package_services;
                            if ( $package_services == '' ) {
                                return true;
                            } else {
                                $arr_package_services = explode( ',', $package_services );
                                if ( !empty( $arr_package_services ) ) {
                                    if ( in_array( 'all', $arr_package_services ) ) {
                                        return true;
                                    } else {
                                        if ( in_array( $post_type, $arr_package_services ) ) {
                                            return true;
                                        }
                                    }
                                }
                            }
                        } else {
                            return true;
                        }
                    }

                    return false;
                }

                return false;
            }

            static function _get_service_available()
            {

                $data = [];

                if ( st_check_service_available( 'st_hotel' ) ) {
                    $data [] = 'st_hotel';
                }
                if ( st_check_service_available( 'st_rental' ) ) {
                    $data [] = 'st_rental';
                }
                if ( st_check_service_available( 'st_tours' ) ) {
                    $data [] = 'st_tours';
                }
                if ( st_check_service_available( 'st_cars' ) ) {
                    $data [] = 'st_cars';
                }
                if ( st_check_service_available( 'st_activity' ) ) {
                    $data [] = 'st_activity';
                }
                if ( st_check_service_available( 'st_flight' ) ) {
                    $data [] = 'st_flight';
                }

                return $data;
            }

            static function check_lever_service_partner( $sc, $lever )
            {
                if ( $lever == 'administrator' ) {
                    return true;
                }
                switch ( $sc ) {
                    case "create-hotel":
                    case "my-hotel":
                    case "create-room":
                    case "my-room":
                    case "booking-hotel":
                    case "edit-hotel":
                    case "edit-room":
                        if ( STUser_f::_check_service_available_partner( 'st_hotel' ) )
                            return true;
                        break;
                    case "create-rental":
                    case "my-rental":
                    case "create-room-rental":
                    case "my-room-rental":
                    case "booking-rental":
                    case "edit-rental":
                    case "edit-room-rental":
                        if ( STUser_f::_check_service_available_partner( 'st_rental' ) )
                            return true;
                        break;
                    case "create-cars":
                    case "edit-car":
                    case "my-cars":
                    case "booking-cars":
                        if ( STUser_f::_check_service_available_partner( 'st_cars' ) )
                            return true;
                        break;
                    case "create-tours":
                    case "edit-tour":
                    case "my-tours":
                    case "booking-tours":
                        if ( STUser_f::_check_service_available_partner( 'st_tours' ) )
                            return true;
                        break;
                    case "create-activity":
                    case "edit-activity":
                    case "my-activity":
                    case "booking-activity":
                        if ( STUser_f::_check_service_available_partner( 'st_activity' ) )
                            return true;
                        break;
                    case "create-flight":
                    case "edit-flight":
                    case "my-flights":
                    case "booking-flight":
                        if ( STUser_f::_check_service_available_partner( 'st_flight' ) )
                            return true;
                        break;
                    case "list-refund":
                        return false;
                        break;

                    default:
                        return true;
                }
            }

            static function _get_list_item_service_available( $post_type = "st_hotel", $user_id, $page = 1 )
            {

                $st_post_type     = STInput::request( 'data_post_type', $post_type );
                $st_user_id       = STInput::request( 'data_user_id', $user_id );
                $st_page          = STInput::request( 'data_page', $page );
                $st_ajax          = STInput::request( 'st_ajax' );
                $arg              = [
                    'post_type'      => $st_post_type,
                    'posts_per_page' => '5',
                    'paged'          => $st_page,
                    'author'         => $st_user_id
                ];
                $result[ 'data' ] = "";
                global $wp_query;
                query_posts( $arg );
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        switch ( $st_post_type ) {
                            case"st_hotel":
                                $result[ 'data' ] .= st()->load_template( 'hotel/loop', 'list', [ "taxonomy" => [] ] );
                                break;
                            case"st_rental":
                                $result[ 'data' ] .= st()->load_template( 'hotel/loop', 'list' );
                                break;
                            case"st_cars":
                                $result[ 'data' ] .= st()->load_template( 'cars/elements/loop/loop-1' );
                                break;
                            case"st_tours":
                                $result[ 'data' ] .= st()->load_template( 'tours/elements/loop/loop-1' );
                                break;
                            case"st_activity":
                                $result[ 'data' ] .= st()->load_template( 'activity/elements/loop/loop-1' );
                                break;
                        }
                    }
                }
                $result[ 'paging' ] = TravelHelper::paging_single_partner( '', $st_user_id ) . '<img class="ajax_loader" src="' . admin_url( "/images/wpspin_light.gif" ) . '" style="display: none;" alt="' . TravelHelper::get_alt_image() . '">';
                wp_reset_query();

                if ( $st_ajax == '1' ) {
                    echo json_encode( $result );
                    die();
                } else {
                    return $result;
                }
            }


            //version 1.2.9
            function _st_login_popup()
            {
                $theme_layout = STInput::request('st_theme_style', 'classic');
                if($theme_layout == 'classic'){
                    $creds = [];
                    $creds['user_login'] = STInput::post('user_login');
                    $creds['user_password'] = STInput::post('user_password');
                    $creds['remember'] = true;
                    $status_error_login = '';
                    $check_error = false;
                    if (empty($creds['user_login']) and empty($creds['user_password'])) {
                        $status_error_login = '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                        $status_error_login .= '<strong>' . __('ERROR', ST_TEXTDOMAIN) . '</strong>: ' . __('The username and password field is empty', ST_TEXTDOMAIN);
                        $status_error_login .= ' </div>';
                        $check_error = true;
                    }
                    $need_link = '';
                    if (!$check_error) {
                        $user = wp_signon($creds, true);
                        if (is_wp_error($user)) {
                            if ($user->get_error_message() != "") {
                                $status_error_login = '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                                if ($user->get_error_code() == "incorrect_password") {
                                    $status_error_login .= sprintf(__("The password you entered for the username <strong>%s</strong> is incorrect.", ST_TEXTDOMAIN), $creds['user_login']);
                                }
                                if ($user->get_error_code() == "invalid_username") {
                                    $status_error_login .= __("Invalid username.", ST_TEXTDOMAIN);
                                }
                                if ($user->get_error_code() == "empty_password") {
                                    $status_error_login .= __("The password field is empty.", ST_TEXTDOMAIN);
                                }
                                if ($user->get_error_code() == "empty_username") {
                                    $status_error_login .= __("The username field is empty.", ST_TEXTDOMAIN);
                                }
                                $status_error_login .= ' </div>';
                                $check_error = true;
                            }
                        }

                        if (!is_wp_error($user)) {

                            $userID = $user->ID;

                            wp_set_current_user($userID, $user->user_email);
                            wp_set_auth_cookie($userID, true, false);
                            do_action('wp_login', $user->user_email, $user);

                            $check_error = false;
                            $page_login = (st()->get_option('page_redirect_to_after_login'));
                            $url_redirect = (STInput::request('st_url_redirect'));
                            $url = (STInput::request('url'));
                            $need_link = home_url();
                            if (!empty($page_login)) $need_link = get_permalink($page_login);
                            if (!empty($url_redirect)) $need_link = urldecode($url_redirect);
                            if (!empty($url)) $need_link = get_permalink($url);

                        }
                    }
                    echo json_encode(['error' => $check_error, 'message' => $status_error_login, 'need_link' => $need_link]);
                    unset($status_error_login);
                    die();
                }else {
                    check_ajax_referer('st_frontend_security', 'security');
                    $username = STInput::post('username');
                    $password = STInput::post('password');
                    $remember = (int)STInput::post('remember', 0);

                    $creds = [];
                    $creds['user_login'] = $username;
                    $creds['user_password'] = $password;
                    $creds['remember'] = $remember;

                    if (empty($creds['user_login']) and empty($creds['user_password'])) {
                        echo json_encode([
                            'status' => 0,
                            'message' => st()->load_template('layouts/modern/common/message', '', ['status' => 'danger', 'message' => __('Username & Password is required', ST_TEXTDOMAIN)])
                        ]);
                        die;
                    }
                    $user = wp_signon($creds, true);
                    if (is_wp_error($user)) {
                        echo json_encode([
                            'status' => 0,
                            'message' => st()->load_template('layouts/modern/common/message', '', ['status' => 'danger', 'message' => $user->get_error_message()])
                        ]);
                        die;
                    }

                    $userID = $user->ID;

                    wp_set_current_user($userID, $user->user_email);
                    wp_set_auth_cookie($userID, true, false);
                    do_action('wp_login', $user->user_email, $user);

                    $page_login = st()->get_option('page_redirect_to_after_login');

                    echo json_encode([
                        'status' => 1,
                        'message' => st()->load_template('layouts/modern/common/message', '', ['status' => 'success', 'message' => __('Logged in successfully', ST_TEXTDOMAIN)]),
                        'redirect' => get_the_permalink($page_login)
                    ]);
                    die;
                }
            }

            public function _st_reset_password()
            {
                check_ajax_referer( 'st_frontend_security', 'security' );
                $email = STInput::post( 'email' );
                if ( !is_email( $email ) ) {
                    echo json_encode( [
                        'status'  => 0,
                        'message' => st()->load_template( 'layouts/modern/common/message', '', [ 'status' => 'danger', 'message' => __( 'The Email is invalid', ST_TEXTDOMAIN ) ] )
                    ] );
                    die;
                }
                if ( !email_exists( $email ) ) {
                    echo json_encode( [
                        'status'  => 0,
                        'message' => st()->load_template( 'layouts/modern/common/message', '', [ 'status' => 'danger', 'message' => __( 'There is no user registered with that email address', ST_TEXTDOMAIN ) ] )
                    ] );
                    die;
                }

                $random_password = wp_generate_password( 12, false );
                $user            = get_user_by( 'email', $email );
                $update_user     = wp_update_user( [
                        'ID'        => $user->ID,
                        'user_pass' => $random_password
                    ]
                );
                if ( $update_user ) {
                    $to      = $email;
                    $subject = 'Your new password';
                    $sender  = get_option( 'name' );

                    $message = 'Your new password is: ' . $random_password;

                    $headers[] = 'MIME-Version: 1.0' . "\r\n";
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers[] = "X-Mailer: PHP \r\n";
                    $headers[] = 'From: ' . $sender . ' < ' . $email . '>' . "\r\n";

                    $mail = @wp_mail( $to, $subject, $message, $headers );
                    if ( $mail ) {
                        echo json_encode( [
                            'status'  => 1,
                            'message' => st()->load_template( 'layouts/modern/common/message', '', [ 'status' => 'success', 'message' => __( 'Check your email address for you new password', ST_TEXTDOMAIN ) ] )
                        ] );
                        die;
                    }
                }
                echo json_encode( [
                    'status'  => 0,
                    'message' => st()->load_template( 'layouts/modern/common/message', '', [ 'status' => 'danger', 'message' => __( 'Oops something went wrong updaing your account.', ST_TEXTDOMAIN ) ] )
                ] );
                die;
            }

            //version 1.2.9
            function _st_registration_popup()
            {
                $theme_layout = STInput::request('st_theme_style', 'classic');
                if($theme_layout == 'classic'){
                    $userdata = [
                        'user_login' => esc_attr($_REQUEST['user_name']),
                        'user_email' => esc_attr($_REQUEST['email']),
                        'user_pass' => esc_attr($_REQUEST['password']),
                        'first_name' => esc_attr($_REQUEST['full_name']),
                    ];

                    $notice = '';
                    $error = true;

                    if (is_wp_error(self::validation())) {
                        $notice .= '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                        $notice .= '<strong>' . self::validation()->get_error_message() . '</strong>';
                        $notice .= '</div>';
                    } else {
                        $register_user = wp_insert_user($userdata);
                        wp_new_user_notification($register_user, null, 'user');
                        if (!is_wp_error($register_user)) {
                            $class_user = new STUser_f();
                            $notice .= $class_user->_update_info_user($register_user, false);
                            $error = false;

                        } else {
                            $notice .= '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
                            $notice .= '<strong>' . $register_user->get_error_message() . '</strong>';
                            $notice .= '</div>';
                        }
                    }

                    echo json_encode(['error' => $error, 'notice' => $notice]);
                    die;
                }else {
                    check_ajax_referer('st_frontend_security', 'security');
                    $userdata = [
                        'user_login' => STInput::post('username'),
                        'user_email' => STInput::post('email'),
                        'user_pass' => STInput::post('password'),
                        'first_name' => STInput::post('fullname'),
                    ];
                    if (is_wp_error(self::validation())) {
                        echo json_encode([
                            'status' => 0,
                            'message' => st()->load_template('layouts/modern/common/message', '', ['status' => 'danger', 'message' => self::validation()->get_error_message()]),
                        ]);
                        die;
                    } else {
                        $register_user = wp_insert_user($userdata);
                        wp_new_user_notification($register_user, null, 'user');
                        if (!is_wp_error($register_user)) {
                            $class_user = new STUser_f();
                            $respon = $class_user->_update_info_user($register_user);
                            echo json_encode($respon);
                            die;
                        } else {
                            echo json_encode([
                                'status' => 0,
                                'message' => st()->load_template('layouts/modern/common/message', '', ['status' => 'danger', 'message' => $register_user->get_error_message()]),
                            ]);
                            die;
                        }
                    }
                }
            }

            static function _is_user_partner( $user_id = false )
            {
                if ( empty( $user_id ) ) $user_id = get_current_user_id();
                $user_info = get_userdata( $user_id );
                if ( !empty( $user_info ) ) {
                    $roles = $user_info->roles;
                    if ( is_array( $roles ) and in_array( 'partner', $roles ) ) {
                        return true;
                    }
                }

                return false;
            }

            static function get_booking_meta( $order_id )
            {
                global $wpdb;
                $querystr  = "SELECT * FROM
                                       " . $wpdb->prefix . "st_order_item_meta
                                                            WHERE 1=1
                                                            AND wc_order_id = " . $order_id;
                $pageposts = $wpdb->get_row( $querystr, ARRAY_A );

                return $pageposts;
            }

            static function check_partner_by_id( $partner_id )
            {
                if ( $partner_id == '' ) {
                    return false;
                } else {
                    if ( $partner_id instanceof WP_User ) {
                        $partner_id = $partner_id->ID;
                    }

                    return (bool)get_user_by( 'id', $partner_id );
                }
            }

            static function check_role_user_by_id( $user_id )
            {
                $author_obj = get_userdata( $user_id );
                $user_role  = array_shift( $author_obj->roles );

                return $user_role;
            }

            static function check_partner_in_element( $partner_id )
            {
                if ( !self::check_partner_by_id( $partner_id ) ) {
                    return false;
                } else {
                    $user_role = self::check_role_user_by_id( $partner_id );
                    if ( !in_array( $user_role, [ 'partner', 'administrator' ] ) ) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }

            static function _update_booking_history_log_mail( $order_id )
            {
                if ( $order_id ) {
                    global $wpdb;
                    $table = $wpdb->prefix . 'st_order_item_meta';
                    $data  = [
                        'log_mail' => strtotime( date( 'Y-m-d' ) )
                    ];
                    $where = [
                        'id' => $order_id
                    ];
                    $res   = $wpdb->update( $table, $data, $where );

                    return $res;
                }

                return;
            }
        }


        $user = new STUser_f();
        $user->init();
    }
