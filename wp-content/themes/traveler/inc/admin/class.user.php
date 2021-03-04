<?php
/**
 * @package    WordPress
 * @subpackage Traveler
 * @since      1.0
 *
 * Class STUser
 *
 * Created by ShineTheme
 *
 */
if (!class_exists('STUser')) {

    class STUser extends STAdmin
    {
	    protected static $countComments=[];

        function __construct()
        {
            //parent::__construct();

        }

        //Do one time
        function init()
        {



            add_action('show_user_profile', [$this, 'show_user_profile']);

            add_action('edit_user_profile', [$this, 'show_user_profile']);

            add_action('show_user_profile', [$this, 'show_user_certificates']);
            add_action('edit_user_profile', [$this, 'show_user_certificates']);

            add_action('show_user_profile', [$this, 'show_user_partner_service']);
            add_action('edit_user_profile', [$this, 'show_user_partner_service']);

            add_action('personal_options_update', [$this, 'personal_options_update']);
            add_action('edit_user_profile_update', [$this, 'personal_options_update']);


            add_action('admin_menu', [$this, 'st_users_partner_menu']);
            add_action('admin_menu', [$this, 'st_refund_manager_menu']);

            add_action('set_user_role', [$this, '_st_check_change_role'], 999, 3);

            //Check booking edit and redirect
            if (self::is_admin_user_page()) {
                add_action('admin_enqueue_scripts', [__CLASS__, 'add_edit_scripts']);
            }

            add_action('wp_ajax_st_load_more_service_partner', [$this, '_load_more_service_partner']);
            add_action('wp_ajax_nopriv_st_load_more_service_partner', [$this, '_load_more_service_partner']);

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            if (is_super_admin()) {
                add_filter('manage_users_columns', [$this, 'new_modify_user_table']);
                add_filter('manage_users_custom_column', [$this, 'new_modify_user_table_row'], 10, 3);
                add_action('init', [$this, 'admin_change_status_order']);
            }

            add_action('wp_ajax_st_sendmail_expire_partner', [$this, '_sendmail_expire_partner']);
            add_action('wp_ajax_nopriv_st_sendmail_expire_partner', [$this, '_sendmail_expire_partner']);

            //Get User Verifications Info
            add_action('wp_ajax_get_user_verifications_info', array($this, '__getUserVerificationsInfo'));
	        add_action('wp_ajax_user_verify_all_info', array($this, '__userVerifyAllnInfo'));
	        add_action('wp_ajax_user_verify_each_info', array($this, '__userVerifyEachInfo'));
	        add_action('wp_ajax_user_deny_each_info', array($this, '__userDenyEachInfo'));

            add_filter( 'comment_row_actions', array($this, '__filterCommentRowAdmin'), 10, 2 );
            add_filter( 'get_avatar' , array($this, '__customAvatarInAdmin') , 1 , 5 );

            /*add field*/
            add_action( 'show_user_profile', array($this,'_facebook_field_profile' ));
            add_action( 'edit_user_profile', array($this,'_facebook_field_profile' ));
            add_action( 'show_user_profile', array($this,'_instagram_field_profile' ));
            add_action( 'edit_user_profile', array($this,'_instagram_field_profile' ));
            add_action( 'show_user_profile', array($this,'_twitter_field_profile' ));
            add_action( 'edit_user_profile', array($this,'_twitter_field_profile' ));
            add_action( 'personal_options_update', array($this,'st_facebook_author_register') );
            add_action( 'edit_user_profile_update', array($this,'st_facebook_author_register') );
            add_action( 'personal_options_update', array($this,'st_twitter_author_register') );
            add_action( 'edit_user_profile_update', array($this,'st_twitter_author_register') );
            add_action( 'personal_options_update', array($this,'st_instagram_author_register') );
            add_action( 'edit_user_profile_update', array($this,'st_instagram_author_register') );
        }

        public function __customAvatarInAdmin($avatar, $id_or_email, $size, $default, $alt){
            if(is_admin()) {
                $user = false;

                if (is_numeric($id_or_email)) {

                    $id = (int)$id_or_email;
                    $user = get_user_by('id', $id);

                } elseif (is_object($id_or_email)) {

                    if (!empty($id_or_email->user_id)) {
                        $id = (int)$id_or_email->user_id;
                        $user = get_user_by('id', $id);
                    }

                } else {
                    $user = get_user_by('email', $id_or_email);
                }

                if ($user && is_object($user)) {
                    if ($user->data->ID) {
                        $avatar_id = get_user_meta($user->data->ID, 'st_avatar', true);
                        if(!empty($avatar_id)) {
                            $avatar = wp_get_attachment_image_url($avatar_id, array(50, 50));
                            $avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
                            return $avatar;
                        }
                    }
                }
                return $avatar;
            }
            return $avatar;
        }

        public function __filterCommentRowAdmin($array, $comment){
            $arr_comment = $comment;

            if(!empty($comment)){
                foreach ($comment as $k => $v){
                    $arr_comment->comment_type = '';
                }
            }

            return $arr_comment;
        }

        public function __get($name)
        {
            switch ($name){
                case "extra_fields":
                    return $this->get_extra_fields();
                    break;
            }
            // TODO: Implement __get() method.
        }

        public function get_extra_fields()
        {
            $this->extra_fields = [

                'st_address' => [
                    'type' => 'text',
                    'label' => __('Address Line 1', ST_TEXTDOMAIN),
                    'desc' => __('Show under your reviews', ST_TEXTDOMAIN)
                ],
                'st_address2' => [
                    'type' => 'text',
                    'label' => __('Address Line 2', ST_TEXTDOMAIN),
                    'desc' => __('Address Line 2', ST_TEXTDOMAIN)
                ],
                'st_phone' => [
                    'type' => 'text',
                    'label' => __('Phone', ST_TEXTDOMAIN),
                    'desc' => __('Phone', ST_TEXTDOMAIN)
                ],
                'st_fax' => [
                    'type' => 'text',
                    'label' => __('Fax Number', ST_TEXTDOMAIN),
                    'desc' => __('Fax Number', ST_TEXTDOMAIN)
                ],
                'st_airport' => [
                    'type' => 'text',
                    'label' => __('Airport', ST_TEXTDOMAIN),
                    'desc' => __('Airport', ST_TEXTDOMAIN)
                ],
                'st_city' => [
                    'type' => 'text',
                    'label' => __('City', ST_TEXTDOMAIN),
                    'desc' => __('City', ST_TEXTDOMAIN)
                ],
                'st_province' => [
                    'type' => 'text',
                    'label' => __('State/Province/Region', ST_TEXTDOMAIN),
                    'desc' => __('State/Province/Region', ST_TEXTDOMAIN)
                ],
                'st_zip_code' => [
                    'type' => 'text',
                    'label' => __('ZIP code/Postal code', ST_TEXTDOMAIN),
                    'desc' => __('ZIP code/Postal code', ST_TEXTDOMAIN)
                ],
                'st_country' => [
                    'type' => 'text',
                    'label' => __('Country', ST_TEXTDOMAIN),
                    'desc' => __('Country', ST_TEXTDOMAIN)
                ]
            ];

            $this->extra_fields = apply_filters('st_user_extra_fields', $this->extra_fields);
        }

        public function __userDenyEachInfo(){
	        if(!is_user_logged_in()) return;
	        $user_id = STInput::post('user_id');
	        $criteria = STInput::post('criteria');
	        $notice = STInput::post('notice');

	        if(empty($user_id) || empty($criteria)) return;

	        st_update_user_verify($criteria, $user_id, '0');

	        $arr_old_notice = get_user_meta($user_id, 'admin_verify_notes', true);
	        if(empty($arr_old_notice))
	        	$arr_old_notice = array();
	        $arr_old_notice[$criteria] = $notice;
	        $res = update_user_meta($user_id, 'admin_verify_notes', $arr_old_notice);

	        if($res){
		        $status = STUser::verify_status($user_id)['value'];
		        $data = ['status' => 1, 'verify_info' => $status];
		        wp_send_json($data);
	        }else{
		        $data = ['status' => 0];
		        wp_send_json($data);
	        }
        }

        public function __userVerifyEachInfo(){
	        if(!is_user_logged_in()) return;
	        $user_id = STInput::post('user_id');
	        $criteria = STInput::post('criteria');

	        if(empty($user_id) || empty($criteria)) return;

	        st_update_user_verify( $criteria, $user_id, 1 );
	        $arr_notice = get_user_meta($user_id, 'admin_verify_notes', true);

	        if(empty($arr_notice))
		        $arr_notice = array();

	        if(isset($arr_notice[$criteria])){
	            unset($arr_notice[$criteria]);
	            update_user_meta($user_id, 'admin_verify_notes', $arr_notice);
	        }

	        $status = STUser::verify_status($user_id)['value'];

	        $data = ['status' => 1, 'verify_info' => $status];
	        wp_send_json($data);
        }

        public function __userVerifyAllnInfo(){
	        check_ajax_referer('user_verifications', 'security');
	        if(!is_user_logged_in()) return;
	        $user_id = STInput::post('user_id');
	        if(empty($user_id)) return;
	        st_update_user_verify( '', $user_id, 1 );
	        update_user_meta($user_id, 'admin_verify_notes', array());
	        $data = [ 'status' => 1];
	        echo json_encode($data);die;
        }

	    public static function verify_status_by_key($user_id, $verify_key, $icon = false){
		    $verify_status = st_check_user_verify($verify_key, $user_id);
		    if($verify_status) {
			    if ( $icon ) {
				    return '<div class="verify-status-item icon all"><span class="dashicons dashicons-yes"></span><span class="dashicons dashicons-minus"></span></div>';
			    } else {
				    return '<span class="verify-status-item all">' . __( 'Verified', ST_TEXTDOMAIN ) . '</span>';
			    }
		    }else{
			    if($icon){
				    return '<div class="verify-status-item icon none"><span class="dashicons dashicons-yes"></span><span class="dashicons dashicons-minus"></span></div>';
			    }else{
				    return '<span class="verify-status-item none">' . __('Not Verified', ST_TEXTDOMAIN) . '</span>';
			    }
		    }

	    }

	    public static function verify_status($user_id){
		    $st_verify_email = st_check_user_verify('email', $user_id);
		    $st_verify_phone = st_check_user_verify('phone', $user_id);
		    $st_verify_passport = st_check_user_verify('passport', $user_id);
		    $st_verify_cer = st_check_user_verify('travel_certificate', $user_id);
		    $st_verify_social = st_check_user_verify('social', $user_id);

		    $count = 0;
		    if(!empty($st_verify_phone) && $st_verify_phone == 1)
			    $count++;
		    if(!empty($st_verify_passport) && $st_verify_passport == 1)
			    $count++;
		    if(!empty($st_verify_email) && $st_verify_email == 1)
			    $count++;
		    if(!empty($st_verify_cer) && $st_verify_cer == 1)
			    $count++;
		    if(!empty($st_verify_social) && $st_verify_social == 1)
			    $count++;

		    $count_c = 5;

		    if($count >= $count_c){
			    return [
				    'value' => 'verified',
				    'html' => '<span class="verify-status all">' . __('Verified', ST_TEXTDOMAIN) . '</span>'
			    ];
		    }
		    if($count > 0 && $count < $count_c){
			    return [
				    'value' => 'apart',
				    'html' => '<span class="verify-status apart">' . __('A Part', ST_TEXTDOMAIN) . '</span>'
			    ];
		    }
		    if($count == 0){
			    return [
				    'value' => 'none',
				    'html' => '<span class="verify-status none">' . __('Not Verified', ST_TEXTDOMAIN) . '</span>'
			    ];
		    }
	    }

        public function __getUserVerificationsInfo(){
	        check_ajax_referer('user_verifications', 'security');
	        if(!is_user_logged_in()) return;
	        $user_id = STInput::post('user_id');
	        $user_info = get_userdata($user_id);

	        $model = [
		        'user_email' => $user_info->user_email,
		        'st_phone'       => get_user_meta($user_id, 'st_phone', true ),
	            'passport_name' => get_user_meta( $user_id, 'passport_name', true ),
		        'passport_id' => get_user_meta( $user_id, 'passport_id', true ),
		        'passport_birthday' => get_user_meta( $user_id, 'passport_birthday', true ),
		        'passport_photos' => get_user_meta( $user_id, 'passport_photos', true ),
	            'business_c_name' => get_user_meta( $user_id, 'business_c_name', true ),
		        'business_c_email' => get_user_meta( $user_id, 'business_c_email', true ),
		        'business_c_address' => get_user_meta( $user_id, 'business_c_address', true ),
		        'business_c_phone' => get_user_meta( $user_id, 'business_c_phone', true ),
		        'business_r_name' => get_user_meta( $user_id, 'business_r_name', true ),
		        'business_r_position' => get_user_meta( $user_id, 'business_r_position', true ),
		        'business_r_passport_id' => get_user_meta( $user_id, 'business_r_passport_id', true ),
		        'business_r_issue_date' => get_user_meta( $user_id, 'business_r_issue_date', true ),
		        'social_facebook_uid' => get_user_meta( $user_id, 'social_facebook_uid', true ),
		        'social_facebook_name' => get_user_meta( $user_id, 'social_facebook_name', true ),
		        'business_photos' => get_user_meta( $user_id, 'business_photos', true ),
		        'user_id' => $user_id
	        ];

	        $html = st()->load_template('user/verify/info', '', array('data' => $model));
	        $data = [ 'status' => 1, 'htmlData' => $html ];
	        echo json_encode($data);die;
        }

        public function new_modify_user_table($columns)
        {
            $columns['package'] = __('Member package', ST_TEXTDOMAIN);
            $columns['status'] = __('Package Status', ST_TEXTDOMAIN);
            $columns['expiration'] = __('Expiration date', ST_TEXTDOMAIN);

            return $columns;
        }

        public function new_modify_user_table_row($val, $column_name, $user_id)
        {
            $cls_package = STPackages::get_inst();
            $order = $cls_package->get_order_package_by("partner = {$user_id}");

            if ($order) {
                $currency = get_post_meta($order->id, 'currency', true);
                $currency = (isset($currency['symbol'])) ? $currency['symbol'] : '';

                switch ($column_name) {
                    case 'package':
                        return esc_attr($order->package_name) . ' (' . TravelHelper::format_money_raw($order->package_price, $currency) . ')';
                        break;
                    case 'status':
                        $link_completed = add_query_arg([
                            'order_id' => $order->id,
                            'order_status' => 'completed',
                            'order_user' => $user_id,
                            'security' => wp_create_nonce('st-security')
                        ], admin_url('/users.php'));

                        $link_incomplete = add_query_arg([
                            'order_id' => $order->id,
                            'order_status' => 'incomplete',
                            'order_user' => $user_id,
                            'security' => wp_create_nonce('st-security')
                        ], admin_url('/users.php'));

                        $link_cancelled = add_query_arg([
                            'order_id' => $order->id,
                            'order_status' => 'cancelled',
                            'order_user' => $user_id,
                            'security' => wp_create_nonce('st-security')
                        ], admin_url('/users.php'));

                        $link_deleted = add_query_arg([
                            'order_id' => $order->id,
                            'order_status' => 'deleted',
                            'order_user' => $user_id,
                            'security' => wp_create_nonce('st-security')
                        ], admin_url('/users.php'));

                        $rows_action = '<div class="row-actions">
                            <span><a href="' . esc_url($link_completed) . '" title="' . __('Completed', ST_TEXTDOMAIN) . '">' . __('Completed', ST_TEXTDOMAIN) . '</a></span> |
                            <span><a href="' . esc_url($link_incomplete) . '" title="' . __('Incomplete', ST_TEXTDOMAIN) . '">' . __('Incomplete', ST_TEXTDOMAIN) . '</a></span> |
                            <span><a href="' . esc_url($link_cancelled) . '" title="' . __('Cancelled', ST_TEXTDOMAIN) . '">' . __('Cancelled', ST_TEXTDOMAIN) . '</a></span> | 
                            <span><a href="' . esc_url($link_deleted) . '" title="' . __('Delete', ST_TEXTDOMAIN) . '">' . __('Delete', ST_TEXTDOMAIN) . '</a></span>
                            </div>
                        ';
                        return esc_attr($order->status) . $rows_action;
                        break;
                    case 'expiration':
                        $created = (int)$order->created;
                        $time = $order->package_time;
                        if ($time == 'unlimited') {
                            $expiration = esc_html__('Unlimited', ST_TEXTDOMAIN);
                        } else {
                            $expiration = date('Y-m-d', strtotime('+' . (int)$time . ' days', $created));
                        }

                        return esc_attr($expiration);
                        break;
                    default:
                        break;
                }
            }

        }

        public function admin_change_status_order()
        {
            if (wp_verify_nonce(STInput::get('security', ''), 'st-security') && is_admin()) {
                $order_id = (int)STInput::get('order_id', '');
                $user_id = (int)STInput::get('order_user', '');
                $status = STInput::get('order_status', '');

                $admin_package = STAdminPackages::get_inst();

                global $wpdb;
                $order = $admin_package->get_order_by_partner($user_id);
                if (!empty($order) && (int)$order->id == $order_id) {
                    if (in_array($status, ['incomplete', 'completed', 'cancelled'])) {
                        $admin_package->update_status($status, $order_id);
                        $is_page = STInput::request('page');
                        if ($is_page == 'st-users-list-partner-menu') {
                            wp_redirect(admin_url('/admin.php?page=st-users-list-partner-menu&st_tab=' . STInput::request('st_tab')));
                            exit();
                        } else {
                            wp_redirect(admin_url('/users.php'));
                            exit();
                        }
                    } elseif ($status == 'deleted') {
                        $admin_package->delete_order($order_id);
                        $is_page = STInput::request('page');
                        if ($is_page == 'st-users-list-partner-menu') {
                            wp_redirect(admin_url('/admin.php?page=st-users-list-partner-menu&st_tab=' . STInput::request('st_tab')));
                            exit();
                        } else {
                            wp_redirect(admin_url('/users.php'));
                            exit();
                        }
                    }
                }

            }
        }

        static function is_admin_user_page()
        {
            if (is_admin() and isset($_GET['page']) and $_GET['page'] == 'st-users-partner-static-menu') return TRUE;
            if (is_admin() and isset($_GET['page']) and $_GET['page'] == 'st-users-top-partner-menu') return TRUE;
            if (is_admin() and isset($_GET['page']) and $_GET['page'] == 'st-users-list-partner-menu') return TRUE;
            if (is_admin() and isset($_GET['page']) and $_GET['page'] == 'st-users-partner-withdrawal-menu') return TRUE;

            return FALSE;
        }

        static function add_edit_scripts()
        {
            if (get_post_type() != 'product') {
                wp_enqueue_script('select2');
            }
            wp_enqueue_script('st-jquery-ui-datepicker', get_template_directory_uri() . '/js/jquery-ui.js');
            wp_enqueue_style('jjquery-ui.theme.min.css', get_template_directory_uri() . '/css/admin/jquery-ui.min.css');
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
            wp_enqueue_style('bootstrap.css', get_template_directory_uri() . '/inc/css/bootstrap_admin.css');
            wp_enqueue_script('Chart.min.js', get_template_directory_uri() . '/inc/plugins/chart-master/Chart.js', ['jquery'], null, true);

	        wp_enqueue_script('verify.js', get_template_directory_uri() . '/js/admin/verify.js', ['jquery'], null, true);

            wp_localize_script('jquery', 'st_params_partner', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'loading_url' => admin_url('/images/wpspin_light.gif'),
                'text_loading' => __("Loading...", ST_TEXTDOMAIN),
                'text_no_more' => __("No More", ST_TEXTDOMAIN),
            ]);


        }

        function _st_check_change_role($user_id, $role_new, $role_old)
        {
            $role_old = array_shift($role_old);
            if ($role_new == "partner" and $role_old == "subscriber") {
                update_user_meta($user_id, 'st_pending_partner', '0');
                if (!get_user_meta($user_id, 'st_partner_approved_date', true)) {
                    $date = date('Y-m-d');
                    update_user_meta($user_id, 'st_partner_approved_date', $date);
                }
                STUser::_send_approved_customer_register_partner($user_id);
            }
        }


        function st_users_partner_menu()
        {
            if (current_user_can('manage_options') && class_exists('STTravelCode')) {

                add_menu_page(
                    __('Partner Statistic', ST_TEXTDOMAIN),
                    __('Partner Statistic', ST_TEXTDOMAIN),
                    'manage_options',
                    'st-users-partner-static-menu',
                    [
                        $this,
                        'st_callback_user_partner_static_function'
                    ]
                    ,
                    'dashicons-admin-users',
                    35
                );

                add_submenu_page('st-users-partner-static-menu', __('List Partner', ST_TEXTDOMAIN), __('List Partner', ST_TEXTDOMAIN), 'manage_options', 'st-users-list-partner-menu', [$this, 'st_callback_user_partner_function']);

                add_submenu_page('st-users-partner-static-menu', __('Top Partner', ST_TEXTDOMAIN), __('Top Partner', ST_TEXTDOMAIN), 'manage_options', 'st-users-top-partner-menu', [$this, 'st_callback_user_partner_top_function']);

            }
        }


        function st_callback_user_partner_static_function()
        {
            echo balanceTags($this->load_view('users/partner_static', false));
        }

        /**
         * Refund manager menu
         */
        function st_refund_manager_menu()
        {
            if (current_user_can('manage_options') && class_exists('STTravelCode')) {
                add_menu_page(
                    __('Refund Manager', ST_TEXTDOMAIN),
                    __('Refund Manager', ST_TEXTDOMAIN),
                    'manage_options',
                    'st-refund-manager-menu',
                    [
                        $this,
                        'st_callback_refund_manager_function'
                    ]
                    ,
                    'dashicons-randomize',
                    35
                );
            }
        }

        function st_callback_refund_manager_function()
        {
            echo balanceTags($this->load_view('users/refund_manager', false));
        }

        //End Refund manager menu for admin

        function st_callback_user_partner_function()
        {
            $action = STInput::request('st_action', false);
            switch ($action) {
                case "delete":
                    //$this->_delete_items();
                    break;
                case "approve_role":
                    $user_id = STInput::request('user_id');
                    if (!empty($user_id)) {
                        $user_data = new WP_User($user_id);
                        $user__permission = array_shift($user_data->roles);
                        if ($user__permission == "subscriber" or $user__permission == "" or $user__permission == "Subscriber" or $user__permission == "partner") {
                            if (!empty($user_data->roles)) {
                                foreach ($user_data->roles as $k => $v) {
                                    $user_data->remove_role($v);
                                }
                            }

                            $user_data = new WP_User($user_id);
                            $user_data->remove_role($user__permission);
                            $user_data->add_role('partner');
                            update_user_meta($user_id, 'st_pending_partner', '0');
                            if (!get_user_meta($user_id, 'st_partner_approved_date', true)) {
                                $date = date('Y-m-d');
                                update_user_meta($user_id, 'st_partner_approved_date', $date);
                            }
                            $st_certificates = get_user_meta($user_id, 'st_certificates', true);
                            update_user_meta($user_id, 'st_partner_service', $st_certificates);

                            STAdmin::set_message(__("Approve success !", ST_TEXTDOMAIN), 'updated');
                            // send email
                            STUser::_send_approved_customer_register_partner($user_id);
                        }
                        unset($user_data);
                    }
                    break;
                case "cancel_role":
                    $user_id = STInput::request('user_id');
                    if (!empty($user_id)) {
                        update_user_meta($user_id, 'st_pending_partner', '0');
                        STAdmin::set_message(__("Cancel success !", ST_TEXTDOMAIN), 'updated');
                        // send email
                        STUser::_send_cancel_customer_register_partner($user_id);
                    }
                    break;
            }
            echo balanceTags($this->load_view('users/partner_index', false));
        }

        function st_callback_user_partner_top_function()
        {
            $action = STInput::request('st_action', false);
            echo balanceTags($this->load_view('users/partner_top', false));
        }

        function _delete_items()
        {

            if (empty($_POST) or !check_admin_referer('shb_action', 'shb_field')) {
                //// process form data, e.g. update fields
                return;
            }
            $ids = isset($_POST['users']) ? $_POST['users'] : [];
            if (!empty($ids)) {
                foreach ($ids as $id)
                    wp_delete_user($id, true);

            }

            STAdmin::set_message(__("Delete item(s) success", ST_TEXTDOMAIN), 'updated');

        }

        function show_user_profile($user)
        {
            echo balanceTags($this->load_view('users/profile', null, ['user' => $user, 'extra_fields' => $this->extra_fields]));
        }

        function show_user_certificates($user)
        {
            echo balanceTags($this->load_view('users/certificates', null, ['user' => $user]));

        }

        function show_user_partner_service($user)
        {
            echo balanceTags($this->load_view('users/partner_service', null, ['user' => $user]));
        }


        static function get_list_partner($permission = "partner", $offset, $limit)
        {
            global $wpdb;
            $where = '';
            $join = '';
            $order_by = '';
            if ($permission == "partner") {
                $join .= " INNER JOIN {$wpdb->prefix}usermeta ON ( {$wpdb->prefix}users.ID = {$wpdb->prefix}usermeta.user_id ) ";
                $where .= " AND
                            ( {$wpdb->prefix}usermeta.meta_key = '{$wpdb->prefix}capabilities' AND CAST({$wpdb->prefix}usermeta.meta_value AS CHAR) LIKE '%\"partner\"%' )";
            }
            if ($permission == "partner_pending") {
                $join .= " INNER JOIN {$wpdb->prefix}usermeta ON ( {$wpdb->prefix}users.ID = {$wpdb->prefix}usermeta.user_id )
                           INNER JOIN {$wpdb->prefix}usermeta AS mt1 ON ( {$wpdb->prefix}users.ID = mt1.user_id )";
                $where .= " AND
                            (
                                (
                                    (
                                        ( {$wpdb->prefix}usermeta.meta_key = 'st_pending_partner' AND CAST({$wpdb->prefix}usermeta.meta_value AS CHAR) = '1' )
                                    )
                                    AND
                                    (
                                        (
                                            ( mt1.meta_key = '{$wpdb->prefix}capabilities' AND CAST(mt1.meta_value AS CHAR) LIKE '%\"Subscriber\"%' )
                                        )
                                    )
                                )
                            )";
            }
            if ($permission == "partner_update") {
                $join .= " INNER JOIN {$wpdb->prefix}usermeta ON ( {$wpdb->prefix}users.ID = {$wpdb->prefix}usermeta.user_id )
                           INNER JOIN {$wpdb->prefix}usermeta AS mt1 ON ( {$wpdb->prefix}users.ID = mt1.user_id )";
                $where .= " AND
                            (
                                (
                                    (
                                        ( {$wpdb->prefix}usermeta.meta_key = 'st_pending_partner' AND CAST({$wpdb->prefix}usermeta.meta_value AS CHAR) = '2' )
                                    )
                                    AND
                                    (
                                        (
                                            ( mt1.meta_key = '{$wpdb->prefix}capabilities' AND CAST(mt1.meta_value AS CHAR) LIKE '%\"partner\"%' )
                                        )
                                    )
                                )
                            )";
            }
            if ($permission == "partner_expire") {
                $select = "SELECT SQL_CALC_FOUND_ROWS {$wpdb->prefix}users.*, DATEDIFF(DATE_ADD(DATE_FORMAT(FROM_UNIXTIME({$wpdb->prefix}st_member_packages_order.created), '%Y-%m-%d'), INTERVAL {$wpdb->prefix}st_member_packages_order.package_time DAY),CURDATE()) as expire_date  FROM {$wpdb->prefix}users";
                $join .= " INNER JOIN {$wpdb->prefix}usermeta ON ( {$wpdb->prefix}users.ID = {$wpdb->prefix}usermeta.user_id ) INNER JOIN {$wpdb->prefix}st_member_packages_order ON ( {$wpdb->prefix}users.ID = {$wpdb->prefix}st_member_packages_order.partner )";
                $where .= " AND
                            ( {$wpdb->prefix}usermeta.meta_key = '{$wpdb->prefix}capabilities' AND CAST({$wpdb->prefix}usermeta.meta_value AS CHAR) LIKE '%\"partner\"%' ) AND {$wpdb->prefix}st_member_packages_order.package_time <> 'unlimited'";
                if ($number_day = STInput::get('st_custommer_daydiff')) {
                    $where .= " AND  DATEDIFF(DATE_ADD(DATE_FORMAT(FROM_UNIXTIME({$wpdb->prefix}st_member_packages_order.created), '%Y-%m-%d'), INTERVAL {$wpdb->prefix}st_member_packages_order.package_time DAY),CURDATE()) <= {$number_day}";
                }
                $order_by .= " ORDER BY expire_date ASC ";
            } else {
                $select = "SELECT SQL_CALC_FOUND_ROWS {$wpdb->prefix}users.* FROM {$wpdb->prefix}users";
                $order_by .= " ORDER BY user_registered DESC ";
            }


            if ($c_name = STInput::request('st_custommer_name')) {
                $where .= "
                AND (  {$wpdb->users}.user_login LIKE '%{$c_name}%'
                    OR {$wpdb->users}.user_email LIKE '%{$c_name}%'
                    OR {$wpdb->users}.user_nicename LIKE '%{$c_name}%'
                    OR {$wpdb->users}.display_name LIKE '%{$c_name}%')
                ";
            }


            $querystr = "
                {$select}
                {$join}
                WHERE 1=1
                " . $where . "
                " . $order_by . "
                LIMIT {$offset},{$limit}
            ";
            $pageposts = $wpdb->get_results($querystr, OBJECT);

            return ['total' => $wpdb->get_var("SELECT FOUND_ROWS();"), 'rows' => $pageposts];
        }

        static function _admin_get_fist_date_approved_user_partner()
        {
            global $wpdb;
            $querystr = "
                    SELECT SQL_CALC_FOUND_ROWS mt1.meta_value AS st_fist_date FROM {$wpdb->prefix}users

                    INNER JOIN {$wpdb->prefix}usermeta ON ( {$wpdb->prefix}users.ID = {$wpdb->prefix}usermeta.user_id  )

                    INNER JOIN {$wpdb->prefix}usermeta as mt1 ON ( {$wpdb->prefix}users.ID = mt1.user_id ) and mt1.meta_key = 'st_partner_approved_date'

                    WHERE 1=1

                    AND ( {$wpdb->prefix}usermeta.meta_key = '{$wpdb->prefix}capabilities' AND CAST({$wpdb->prefix}usermeta.meta_value AS CHAR) LIKE '%\"partner\"%' )

                    ORDER BY st_fist_date ASC LIMIT 1
                ";

            $rs = $wpdb->get_row($querystr, OBJECT);
            if (!empty($rs)) {
                return date_i18n('Y', strtotime($rs->st_fist_date));
            } else {
                return date_i18n('Y');
            }
        }

        /***
         *
         *
         * since 1.2.7
         * by quandq ahii
         */
        static function _admin_get_data_chart_number_user_partner()
        {
            $st_month = STInput::request('st_month', date('m'));
            $st_year = STInput::request('st_year', date('Y'));
            if ($st_year == "all") {
                $data_default = [];
                global $wpdb;
                $querystr = "
                                SELECT SQL_CALC_FOUND_ROWS {$wpdb->prefix}users.* ,mt1.meta_value as st_date FROM {$wpdb->prefix}users

                                INNER JOIN {$wpdb->prefix}usermeta ON ( {$wpdb->prefix}users.ID = {$wpdb->prefix}usermeta.user_id  )

                                INNER JOIN {$wpdb->prefix}usermeta as mt1 ON ( {$wpdb->prefix}users.ID = mt1.user_id ) and mt1.meta_key = 'st_partner_approved_date'

                                WHERE 1=1

                                AND ( {$wpdb->prefix}usermeta.meta_key = '{$wpdb->prefix}capabilities' AND CAST({$wpdb->prefix}usermeta.meta_value AS CHAR) LIKE '%\"partner\"%' )

                                GROUP BY {$wpdb->prefix}users.ID

                                ORDER BY
                                mt1.meta_value ASC
                            ";
                $total = 0;
                $pageposts = $wpdb->get_results($querystr, OBJECT);
                if (!empty($pageposts)) {
                    foreach ($pageposts as $key => $value) {
                        $tmp_date = date("Y", strtotime($value->st_date));
                        if (empty($data_default[$tmp_date]['number'])) {
                            $data_default[$tmp_date]['number'] = 0;
                        }
                        $data_default[$tmp_date]['number'] += 1;
                        $total++;
                    }
                }
                $data_lable = '[';
                $data_number = '[';
                foreach ($data_default as $k => $v) {
                    $date = $k;
                    $data_lable .= '"' . $date . '",';
                    $data_number .= '"' . $v['number'] . '",';
                }
                $data_lable = substr($data_lable, 0, -1);
                $data_number = substr($data_number, 0, -1);
                $data_lable .= ']';
                $data_number .= ']';

                return ['total' => $total, 'php' => $data_default, 'js' => ['lable' => $data_lable, 'number' => $data_number]];
            } else {
                if ($st_month == 'all') {
                    $date_start = date($st_year . '-01-01');
                    $date_end = date('Y-m-t', strtotime(date($st_year . '-12-01')));
                    $data_default = [];
                    for ($j = 1; $j <= 12; $j++) {
                        if ($j < 10) {
                            $data_default['0' . $j] = [
                                'number' => 0,
                            ];
                        } else {
                            $data_default[$j] = [
                                'number' => 0,
                            ];
                        }
                    }
                    global $wpdb;
                    $querystr = "
                            SELECT SQL_CALC_FOUND_ROWS {$wpdb->prefix}users.* ,mt1.meta_value as st_date FROM {$wpdb->prefix}users

                            INNER JOIN {$wpdb->prefix}usermeta ON ( {$wpdb->prefix}users.ID = {$wpdb->prefix}usermeta.user_id  )

                            INNER JOIN {$wpdb->prefix}usermeta as mt1 ON ( {$wpdb->prefix}users.ID = mt1.user_id ) and mt1.meta_key = 'st_partner_approved_date'

                            WHERE 1=1

                            AND ( {$wpdb->prefix}usermeta.meta_key = '{$wpdb->prefix}capabilities' AND CAST({$wpdb->prefix}usermeta.meta_value AS CHAR) LIKE '%\"partner\"%' )

                            AND mt1.meta_value >= '{$date_start}'

                            AND mt1.meta_value <= '{$date_end}'

                            GROUP BY {$wpdb->prefix}users.ID
                        ";
                    $total = 0;
                    $pageposts = $wpdb->get_results($querystr, OBJECT);
                    if (!empty($pageposts)) {
                        foreach ($pageposts as $key => $value) {
                            $tmp_date = date("m", strtotime($value->st_date));
                            $data_default[$tmp_date]['number'] += 1;
                            $total++;
                        }

                    }
                    $data_lable = '[';
                    $data_number = '[';
                    foreach ($data_default as $k => $v) {
                        $date = date("F", strtotime($st_year . "-" . $k . '-01'));
                        $data_lable .= '"' . $date . '",';
                        $data_number .= '"' . $v['number'] . '",';
                    }
                    $data_lable = substr($data_lable, 0, -1);
                    $data_number = substr($data_number, 0, -1);
                    $data_lable .= ']';
                    $data_number .= ']';

                    return ['total' => $total, 'php' => $data_default, 'js' => ['lable' => $data_lable, 'number' => $data_number]];
                } else {
                    $date_start = date($st_year . '-' . $st_month . '-01');
                    $date_end = date('Y-m-t', strtotime($date_start));
                    $this_month = date('m');
                    $data_default = [];
                    if ($this_month == 2)
                        $day = 28; else $day = 31;
                    for ($j = 1; $j <= $day; $j++) {
                        if ($j < 10) {
                            $data_default['0' . $j] = [
                                'number' => 0,
                            ];
                        } else {
                            $data_default[$j] = [
                                'number' => 0,
                            ];
                        }
                    }
                    global $wpdb;
                    $querystr = "
                                SELECT SQL_CALC_FOUND_ROWS {$wpdb->prefix}users.* ,mt1.meta_value as st_date FROM {$wpdb->prefix}users

                                INNER JOIN {$wpdb->prefix}usermeta ON ( {$wpdb->prefix}users.ID = {$wpdb->prefix}usermeta.user_id  )

                                INNER JOIN {$wpdb->prefix}usermeta as mt1 ON ( {$wpdb->prefix}users.ID = mt1.user_id ) and mt1.meta_key = 'st_partner_approved_date'

                                WHERE 1=1

                                AND ( {$wpdb->prefix}usermeta.meta_key = '{$wpdb->prefix}capabilities' AND CAST({$wpdb->prefix}usermeta.meta_value AS CHAR) LIKE '%\"partner\"%' )

                                AND mt1.meta_value >= '{$date_start}'

                                AND mt1.meta_value <= '{$date_end}'

                                GROUP BY {$wpdb->prefix}users.ID
                            ";
                    $total = 0;
                    $pageposts = $wpdb->get_results($querystr, OBJECT);
                    if (!empty($pageposts)) {
                        foreach ($pageposts as $key => $value) {
                            $tmp_date = date("d", strtotime($value->st_date));
                            $data_default[$tmp_date]['number'] += 1;
                            $total++;
                        }
                    }
                    $data_lable = '[';
                    $data_number = '[';
                    foreach ($data_default as $k => $v) {
                        $date = $k;
                        $data_lable .= '"' . $date . '",';
                        $data_number .= '"' . $v['number'] . '",';
                    }
                    $data_lable = substr($data_lable, 0, -1);
                    $data_number = substr($data_number, 0, -1);
                    $data_lable .= ']';
                    $data_number .= ']';

                    return ['total' => $total, 'php' => $data_default, 'js' => ['lable' => $data_lable, 'number' => $data_number]];
                }

            }
        }

        static function _admin_get_list_top_partner($offset, $limit)
        {
            global $wpdb;
            $where = "";
            if ($c_name = STInput::request('st_custommer_name')) {

                $where .= "
                AND (  {$wpdb->users}.user_login LIKE '%{$c_name}%'
                    OR {$wpdb->users}.user_email LIKE '%{$c_name}%'
                    OR {$wpdb->users}.user_nicename LIKE '%{$c_name}%'
                    OR {$wpdb->users}.display_name LIKE '%{$c_name}%')
                ";

            }
            $querystr = "SELECT SQL_CALC_FOUND_ROWS
                            {$wpdb->prefix}users.user_login,
                            {$wpdb->prefix}users.user_email,
                            {$wpdb->prefix}users.user_nicename,
                            {$wpdb->prefix}users.display_name,
                            {$wpdb->prefix}st_withdrawal.*,
                        SUM({$wpdb->prefix}st_withdrawal.price) AS total_price
                        FROM
                            {$wpdb->prefix}st_withdrawal
                        INNER JOIN {$wpdb->prefix}users ON {$wpdb->prefix}users.ID = {$wpdb->prefix}st_withdrawal.user_id
                        WHERE
                            1 = 1
                        AND {$wpdb->prefix}st_withdrawal.status = 'completed'
                            {$where}
                        GROUP BY
                            {$wpdb->prefix}st_withdrawal.user_id
            ";
            $pageposts = $wpdb->get_results($querystr, OBJECT);

            return ['total' => $wpdb->get_var("SELECT FOUND_ROWS();"), 'rows' => $pageposts];
        }

        static function _send_partner_notice_expire_date($user_id)
        {
            global $expire_partner_id;
            $expire_partner_id = $user_id;

            if ($user_id) {
                $message = st()->load_template('email/header');
                $email_to = st()->get_option('email_for_partner_expired_date', '');
	            $message .= TravelHelper::_get_template_email($message, $email_to);
                $message .= st()->load_template('email/footer');
                $user_data = get_userdata($user_id);
                $title = $user_data->user_nicename . " - " . $user_data->user_email;
                $subject = sprintf(__('Notification expired membership package: %s', ST_TEXTDOMAIN), $title);
                $check = self::_send_mail_user($user_data->user_email, $subject, $message);
            }

            unset($expire_partner_id);
            return $check;
        }

        static function _send_admin_new_register_partner($user_id)
        {
            global $st_user_id;
            $st_user_id = $user_id;
            $admin_email = st()->get_option('email_admin_address');
            if (!$admin_email) return false;
            $to = $admin_email;
            if ($user_id) {
                $message = st()->load_template('email/header');
                $email_to = st()->get_option('partner_email_for_admin', '');
                $message .= do_shortcode($email_to);
                $message .= st()->load_template('email/footer');
                $user_data = get_userdata($user_id);
                $title = $user_data->user_nicename . " - " . $user_data->user_email . " - " . $user_data->user_registered;
                $subject = sprintf(__('New Register Partner: %s', ST_TEXTDOMAIN), $title);
                $check = self::_send_mail_user($to, $subject, $message);
            }
            unset($st_user_id);

            return $check;
        }

        static function _send_admin_new_register_user($user_id)
        {

            global $st_user_id;
            $st_user_id = $user_id;
            $admin_email = st()->get_option('email_admin_address');
            if (!$admin_email) return false;
            $to = $admin_email;
            if ($user_id) {
                $message = st()->load_template('email/header');
                $email_to = st()->get_option('user_register_email_for_admin', '');
                $message .= do_shortcode($email_to);
                $message .= st()->load_template('email/footer');
                $title = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
                $subject = sprintf(__('[%s] New User Registration', ST_TEXTDOMAIN), $title);
                $check = self::_send_mail_user($to, $subject, $message);
            }
            unset($st_user_id);

            return $check;
        }

        static function _resend_send_admin_update_certificate_partner($user_id)
        {
            global $st_user_id;
            $st_user_id = $user_id;
            $admin_email = st()->get_option('email_admin_address');
            if (!$admin_email) return false;
            $to = $admin_email;
            if ($user_id) {
                $message = st()->load_template('email/header');
                $email_to = st()->get_option('partner_resend_email_for_admin', '');
                $message .= do_shortcode($email_to);
                $message .= st()->load_template('email/footer');
                $user_data = get_userdata($user_id);
                $title = $user_data->user_nicename . " - " . $user_data->user_email;
                $subject = sprintf(__('New Update Certificate Partner: %s', ST_TEXTDOMAIN), $title);
                $check = self::_send_mail_user($to, $subject, $message);
            }
            unset($st_user_id);

            return $check;
        }

        static function _send_customer_register_partner($user_id)
        {
            global $st_user_id;
            $st_user_id = $user_id;
            $user_data = get_userdata($user_id);
            $user_email = $user_data->user_email;
            if (!$user_email) return false;
            $to = $user_email;
            $message = st()->load_template('email/header');
            $email_to = st()->get_option('partner_email_for_customer', '');
            $message .= do_shortcode($email_to);
            $message .= st()->load_template('email/footer');
            $title = get_option('blogname');
            $subject = sprintf(__('Your partner registration at %s is pending approval!', ST_TEXTDOMAIN), $title);
            $check = self::_send_mail_user($to, $subject, $message);
            unset($st_user_id);

            return $check;
        }

        static function _send_approved_customer_register_partner($user_id)
        {
            global $st_user_id;
            $st_user_id = $user_id;
            $user_data = get_userdata($user_id);
            $user_email = $user_data->user_email;
            if (!$user_email) return false;
            $to = $user_email;
            $message = st()->load_template('email/header');
            $email_to = st()->get_option('partner_email_approved', '');
            $message .= do_shortcode($email_to);
            $message .= st()->load_template('email/footer');
            $title = get_option('blogname');
            $subject = sprintf(__(' %s Partner Registration Has Been Received and Welcome to %s! ', ST_TEXTDOMAIN), $title, $title);
            $check = self::_send_mail_user($to, $subject, $message);
            unset($st_user_id);

            return $check;
        }

        static function _send_cancel_customer_register_partner($user_id)
        {
            global $st_user_id;
            $st_user_id = $user_id;
            $user_data = get_userdata($user_id);
            $user_email = $user_data->user_email;
            if (!$user_email) return false;
            $to = $user_email;
            $message = st()->load_template('email/header');
            $email_to = st()->get_option('partner_email_cancel', '');
            $message .= do_shortcode($email_to);
            $message .= st()->load_template('email/footer');
            $title = get_option('blogname');
            $subject = sprintf(__('%s Partner Registration Has Been Cancel! ', ST_TEXTDOMAIN), $title);
            $check = self::_send_mail_user($to, $subject, $message);
            unset($st_user_id);

            return $check;
        }

        private static function _send_mail_user($to, $subject, $message, $attachment = false)
        {
            if (!$message) return [
                'status' => false,
                'data' => '',
                'message' => __("Email content is empty", ST_TEXTDOMAIN)
            ];
            $from = st()->get_option('email_from');
            $from_address = st()->get_option('email_from_address');
            $headers = [];

            if ($from and $from_address) {
                $headers[] = 'From:' . $from . ' <' . $from_address . '>';
            }
            add_filter('wp_mail_content_type', [__CLASS__, 'set_html_content_type']);
            $check = wp_mail($to, $subject, $message, $headers, $attachment);
            remove_filter('wp_mail_content_type', [__CLASS__, 'set_html_content_type']);

            return [
                'status' => $check,
                'data' => [
                    'to' => $to,
                    'subject' => $subject,
                    'message' => $message,
                    'headers' => $headers
                ]
            ];
        }

        static function set_html_content_type()
        {
            return 'text/html';
        }

        function personal_options_update($user_id)
        {
            if (!current_user_can('edit_user', $user_id))
                return false;

            if (!empty($this->extra_fields)) {

                foreach ($this->extra_fields as $key => $value) {
                    update_user_meta($user_id, $key, sanitize_text_field($_POST[$key]));
                }

                //Update service partner
                $user_data = new WP_User($user_id);

                $user__permission = array_shift($user_data->roles);
                if ($user__permission == "partner") {
                    $data_service_new = STInput::request('st_partner_service');
                    $st_partner_service = [];
                    if (!empty($data_service_new)) {
                        foreach ($data_service_new as $k => $v) {
                            $st_partner_service[$v] = ['name' => $v, 'image' => ''];
                        }
                    }
                    $data_service_old = get_user_meta($user_id, 'st_partner_service', true);
                    if (!empty($data_service_old) and !empty($st_partner_service)) {
                        $check = true;
                        foreach ($data_service_old as $k => $v) {
                            if (empty($st_partner_service[$k])) {
                                $check = false;
                            }
                        }
                        foreach ($st_partner_service as $k => $v) {
                            if (empty($data_service_old[$k])) {
                                $check = false;
                            }
                        }
                        if ($check == false) {
                            STUser::_send_approved_customer_register_partner($user_id);
                            if (!get_user_meta($user_id, 'st_partner_approved_date', true)) {
                                $date = date('Y-m-d');
                                update_user_meta($user_id, 'st_partner_approved_date', $date);
                            }
                        }
                    }
                    if (empty($st_partner_service)) {
                        STUser::_send_cancel_customer_register_partner($user_id);
                    }
                    update_user_meta($user_id, 'st_pending_partner', '0');
                    update_user_meta($user_id, 'st_partner_service', $st_partner_service);
                }

            }
        }

        static function count_comment($user_id = false, $post_id = false, $comment_type = false)
        {
            if (!$user_id) {
                if (is_user_logged_in()) {

                    global $current_user;

                    $user_id = $current_user->ID;
                }
            }

            if ($user_id) {
                global $wpdb;

                $query = 'SELECT COUNT(comment_ID) FROM ' . $wpdb->comments . ' WHERE user_id = "' . sanitize_title_for_query($user_id) . '"';


                if ($post_id) {
                    $query .= ' AND comment_post_ID="' . sanitize_title_for_query($post_id) . '"';
                }

                if ($comment_type) {
                    $query .= ' AND comment_type="' . sanitize_title_for_query($comment_type) . '"';
                }

                $count = $wpdb->get_var($query);


                return $count;
            }
        }

        static function count_comment_by_email($email, $post_id = false, $comment_type = false)
        {
            if (!$email)
                return 0;

            if ($email) {
	            if(array_key_exists($email,self::$countComments)) return self::$countComments[$email];
                global $wpdb;

                $query = 'SELECT COUNT(comment_ID) FROM ' . $wpdb->comments . ' WHERE comment_author_email = "' . $email . '"';


                if ($post_id) {
                    $query .= ' AND comment_post_ID="' . sanitize_title_for_query($post_id) . '"';
                }

                if ($comment_type) {
                    $query .= ' AND comment_type="' . sanitize_title_for_query($comment_type) . '"';
                }

                $count = $wpdb->get_var($query);
	            self::$countComments[$email]=$count;
                return $count;
            }
        }

        static function count_review($user_id = false, $post_id = false)
        {
            return self::count_comment($user_id, $post_id, "st_reviews");
        }

        static function count_review_by_email($email, $post_id = false)
        {
            return self::count_comment_by_email($email, $post_id, "st_reviews");
        }

        static function _load_more_service_partner($post_type = false, $user_id = false)
        {
            if (STInput::request('st_post_type', '') != '') {
                $post_type = STInput::request('st_post_type');
            }
            if (STInput::request('st_user_id', '') != '') {
                $user_id = STInput::request('st_user_id');
            }
            if (!empty($post_type) and !empty($user_id)) {
                $paged = 1;
                $limit = 10;
                if (!empty($_REQUEST['st_paged'])) {
                    $paged = $_REQUEST['st_paged'];
                }
                $offset = ($paged - 1) * $limit;
                global $wpdb;

                $querystr = "SELECT SQL_CALC_FOUND_ROWS *
                        FROM
                            {$wpdb->prefix}posts
                        WHERE 1 = 1

                        AND {$wpdb->prefix}posts.post_author = {$user_id}

                        AND {$wpdb->prefix}posts.post_type = '{$post_type}'

                        ORDER BY
                            {$wpdb->prefix}posts.post_date DESC
                        LIMIT {$offset},{$limit}";
                $pageposts = $wpdb->get_results($querystr, OBJECT);
                $number_post = $wpdb->get_var("SELECT FOUND_ROWS();");
                $html = '';
                if (!empty($pageposts)) {
                    foreach ($pageposts as $k => $v) {
                        $post_id = $v->ID;
                        $address = get_post_meta($post_id, 'address', true);
                        switch ($post_type) {
                            case "st_hotel":
                                $price = TravelHelper::format_money(STHotel::get_price($post_id));
                                break;
                            case "st_rental":
                                $price = TravelHelper::format_money(get_post_meta($post_id, 'price', true));
                                break;
                            case "st_tours":
                                $adult_price = TravelHelper::format_money(get_post_meta($post_id, 'adult_price', true));
                                $child_price = TravelHelper::format_money(get_post_meta($post_id, 'child_price', true));
                                $infant_price = TravelHelper::format_money(get_post_meta($post_id, 'infant_price', true));
                                $price = "
                                	" . __("Adult Price", ST_TEXTDOMAIN) . ": {$adult_price} <br>
                                	" . __("Child Price", ST_TEXTDOMAIN) . ": {$child_price} <br>
                                	" . __("Infant Price", ST_TEXTDOMAIN) . ": {$infant_price}";
                                break;
                            case "st_cars":
                                $price = TravelHelper::format_money(get_post_meta($post_id, 'cars_price', true));
                                $address = get_post_meta($post_id, 'cars_address', true);
                                break;
                            case "st_activity":
                                $adult_price = TravelHelper::format_money(get_post_meta($post_id, 'adult_price', true));
                                $child_price = TravelHelper::format_money(get_post_meta($post_id, 'child_price', true));
                                $infant_price = TravelHelper::format_money(get_post_meta($post_id, 'infant_price', true));
                                $price = "
                                	" . __("Adult Price", ST_TEXTDOMAIN) . ": {$adult_price} <br>
                                	" . __("Child Price", ST_TEXTDOMAIN) . ": {$child_price} <br>
                                	" . __("Infant Price", ST_TEXTDOMAIN) . ": {$infant_price}";
                                break;
                        }
                        $date_create = date_i18n(TravelHelper::getDateFormat(), strtotime($v->post_date));
                        $status = $v->post_status;
                        $img = get_the_post_thumbnail($post_id, [50, 50], array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($post_id))));
                        if (empty($img)) {
                            $img = '<img width="50" height="50" alt="no-image" class="wp-post-image" src="' . bfi_thumb(get_template_directory_uri() . '/img/no-image.png', ['width' => 50, 'height' => 50]) . '" alt="' . TravelHelper::get_alt_image() . '">';
                        }
                        $title = "<a href=" . admin_url("post.php?post={$post_id}&action=edit") . ">" . $v->post_title . "</a>";
                        $number = $offset + $k + 1;
                        $html .= "
                                    <tr class='post-id-{$post_id}'>
                                        <td style='text-align: center'>{$number}</td>
                                        <td>{$img}</td>
                                        <td>{$title}</td>
                                        <td>{$price}</td>
                                        <td>{$address}</td>
                                        <td>{$date_create}</td>
                                        <td >{$status}</td>
                                    </tr>";
                    }
                }
                if (STInput::request('st_show') == 'true') {
                    echo json_encode(['data_html' => $html]);
                    die();
                } else {
                    return ["html" => $html, "number_post" => $number_post];
                }

            }
        }

        public static function _update_partner_log_mail($v){
            if($v){
                global $wpdb;
                $table = $wpdb->prefix . 'st_member_packages_order';
                $data  = [
                    'log_mail' => strtotime(date('Y-m-d'))
                ];
                $where = [
                    'partner' => $v
                ];
                $res = $wpdb->update( $table, $data, $where );
                return $res;
            }
            return;
        }

        public function _sendmail_expire_partner()
        {
            $users = STInput::post('users', '');
            if (!empty($users)) {
                foreach ($users as $k => $v) {
                    $check = self::_send_partner_notice_expire_date($v);
                    self::_update_partner_log_mail($v);
                }
                if ($check) {
                    $return = [
                        'status' => true,
                        'message' => __('Send notification expired date membership package successful!', ST_TEXTDOMAIN)
                    ];
                }
            } else {
                $return = [
                    'status' => false,
                    'message' => __('Please select least 1 partner', ST_TEXTDOMAIN)
                ];
            }
            echo json_encode($return);
            die;
        }


        /*Add new field social ngothoai*/
        public function _facebook_field_profile($user){
            $facebook_author = get_the_author_meta( 'facebook_author', $user->ID ); ?>
            <table class="form-table">
                <tr>
                    <th><label for="facebook_author"><?php esc_html_e( 'Url facebook', ST_TEXTDOMAIN ); ?></label></th>
                    <td>
                        <input type="url"
                           value="<?php echo esc_attr( $facebook_author ); ?>"
                           class="regular-text"
                           name="facebook_author"
                        />
                    </td>
                </tr>
            </table>
        <?php }
        public function _twitter_field_profile( $user ){
            $twitter_author = get_the_author_meta( 'twitter_author', $user->ID ); ?>
            <table class="form-table">
                <tr>
                    <th><label for="twitter_author"><?php esc_html_e( 'Url twitter', ST_TEXTDOMAIN ); ?></label></th>
                    <td>
                        <input type="url"
                           value="<?php echo esc_attr( $twitter_author ); ?>"
                           class="regular-text"
                           name="twitter_author"
                        />
                    </td>
                </tr>
            </table>
        <?php }
        public function _instagram_field_profile( $user){
            $instagram_author = get_the_author_meta( 'instagram_author', $user->ID ); ?>
            <table class="form-table">
                <tr>
                    <th><label for="instagram_author"><?php esc_html_e( 'Url instagram', ST_TEXTDOMAIN ); ?></label></th>
                    <td>
                        <input type="url"
                           value="<?php echo esc_attr( $instagram_author ); ?>"
                           class="regular-text"
                           name="instagram_author"
                        />
                    </td>
                </tr>
            </table>
        <?php }
        public function st_facebook_author_register( $user_id ) {
            if ( ! empty( $_POST['facebook_author'] ) ) {
                update_user_meta( $user_id, 'facebook_author', sanitize_text_field( $_POST['facebook_author'] ) );
            }
        }
        public function st_twitter_author_register( $user_id ) {
            if ( ! empty( $_POST['twitter_author'] ) ) {
                update_user_meta( $user_id, 'twitter_author', sanitize_text_field( $_POST['twitter_author'] ) );
            }
        }
        public function st_instagram_author_register( $user_id ) {
            if ( ! empty( $_POST['instagram_author'] ) ) {
                update_user_meta( $user_id, 'instagram_author', sanitize_text_field( $_POST['instagram_author'] ) );
            }
        }
    }

    $User = new STUser();

    $User->init();
}