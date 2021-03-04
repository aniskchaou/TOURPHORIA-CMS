<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.3.1
     *
     * Class STAttribute
     *
     * Created by ShineTheme
     *
     */
    use Omnipay\Omnipay;
    use Omnipay\Common\CreditCard;

    if ( !class_exists( 'STAdminPackages' ) ) {
        class STAdminPackages extends STAdmin
        {
            public static $inst;

            public function __construct()
            {
                //parent::__construct();
                self::$inst = &$this;

                /*
                 * Add sub menu
                 */
                add_action( 'admin_menu', [ $this, '_add_submenu_packages' ], 50 );
                add_action( 'init', [ $this, '_create_member_packages_table' ] );
                add_action( 'init', [ $this, '_create_member_packages_order_table' ] );
                add_action( 'init', [ $this, 'st_save_member_package' ], 10 );
                add_action( 'init', [ $this, 'st_add_cart_member_package' ] );
                add_action( 'init', [ $this, 'st_add_cart_member_package_new' ] );

            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function _add_submenu_packages()
            {
                add_submenu_page( 'st_traveler_option', __( 'Member Packages', ST_TEXTDOMAIN ), __( 'Member Packages', ST_TEXTDOMAIN ), 'manage_options', 'st_member_packages', [ $this, '_st_member_packages_content' ] );
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function _create_member_packages_table()
            {
                global $wpdb;
                $dbhelper = new DatabaseHelper( '1.0.5' );
                $dbhelper->setTableName( 'st_member_packages' );
                $column = [
                    'id'                    => [
                        'type'           => 'bigint',
                        'length'         => 9,
                        'AUTO_INCREMENT' => true,
                    ],
                    'package_name'          => [
                        'type'   => 'varchar',
                        'length' => '255',
                    ],
                    'package_subname'       => [
                        'type'   => 'varchar',
                        'length' => '255',
                    ],
                    'package_price'         => [
                        'type'   => 'float',
                        'length' => '10',
                    ],
                    'package_services'         => [
                        'type'   => 'varchar',
                        'length' => '255',
                    ],
                    'package_time'          => [
                        'type'   => 'varchar',
                        'length' => '50',
                    ],
                    'package_commission'    => [
                        'type'   => 'varchar',
                        'length' => '50',
                    ],
                    'package_item_upload'   => [
                        'type'   => 'varchar',
                        'length' => '50',
                    ],
                    'package_item_featured' => [
                        'type'   => 'varchar',
                        'length' => '50',
                    ],
                    'package_description'   => [
                        'type' => 'text',
                    ],
                ];
                $dbhelper->setDefaultColums( $column );
                $dbhelper->check_meta_table_is_working( 'member_packages_version' );
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function _create_member_packages_order_table()
            {
                global $wpdb;
                $dbhelper = new DatabaseHelper( '1.0.6' );
                $dbhelper->setTableName( 'st_member_packages_order' );
                $column = [
                    'id'                    => [
                        'type'           => 'bigint',
                        'length'         => 11,
                        'AUTO_INCREMENT' => true,
                    ],
                    'package_id'            => [
                        'type'   => 'int',
                        'length' => 11,
                    ],
                    'package_name'          => [
                        'type'   => 'varchar',
                        'length' => '255',
                    ],
                    'package_subname'       => [
                        'type'   => 'varchar',
                        'length' => '255',
                    ],
                    'package_price'         => [
                        'type'   => 'float',
                        'length' => '10',
                    ],
                    'package_services'         => [
                        'type'   => 'varchar',
                        'length' => '255',
                    ],
                    'package_time'          => [
                        'type'   => 'varchar',
                        'length' => '50',
                    ],
                    'package_commission'    => [
                        'type'   => 'varchar',
                        'length' => '50',
                    ],
                    'package_item_upload'   => [
                        'type'   => 'varchar',
                        'length' => '50',
                    ],
                    'package_item_featured' => [
                        'type'   => 'varchar',
                        'length' => '50',
                    ],
                    'package_description'   => [
                        'type' => 'text',
                    ],
                    'partner'               => [
                        'type'   => 'int',
                        'length' => 11,
                    ],
                    'created'               => [
                        'type'   => 'varchar',
                        'length' => 50,
                    ],
                    'token'                 => [
                        'type'   => 'varchar',
                        'length' => 100,
                    ],
                    'gateway'               => [
                        'type'   => 'varchar',
                        'length' => 50
                    ],
                    'partner_info'          => [
                        'type' => 'text'
                    ],
                    'status'                => [
                        'type'   => 'varchar',
                        'length' => 50,
                    ],
                    'log_mail'                => [
                        'type'   => 'varchar',
                        'length' => 50,
                    ],
                ];
                $dbhelper->setDefaultColums( $column );
                $dbhelper->check_meta_table_is_working( 'member_packages_order_version' );
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function _st_member_packages_content()
            {
                $data = [];
                if ( STInput::get( 'delete_package', '' ) !== '' && wp_verify_nonce( STInput::get( '_wpnonce', '' ), 'st_delete_package' ) ) {
                    $package_id = (int)STInput::get( 'delete_package', '' );
                    global $wpdb;
                    $table = $wpdb->prefix . 'st_member_packages';
                    $wpdb->delete( $table, [ 'id' => $package_id ] );
                    STTemplate::set_message( __( 'Deleted successful.', ST_TEXTDOMAIN ), 'success' );
                    wp_redirect( admin_url( 'admin.php?page=st_member_packages' ) );
                    eixt();
                }
                if ( STInput::get( 'edit_package', '' ) !== '' ) {
                    echo balanceTags( $this->load_view( 'member_packages/edit', false, $data ) );
                } else {
                    echo balanceTags( $this->load_view( 'member_packages/index', false, $data ) );
                }

            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function st_save_member_package()
            {
                if ( STInput::post( 'action', '' ) === 'st_add_member_package' ) {
                    $id          = (int)STInput::post( 'package_id', '' );
                    $name        = esc_html( STInput::post( 'package_label', '' ) );
                    $subname     = esc_html( STInput::post( 'package_subname', '' ) );
                    $price       = (float)STInput::post( 'package_price', '' );
                    $services       = STInput::post( 'package_services', '' );
                    $available   = (int)STInput::post( 'package_available', '' );
                    $commission  = (float)STInput::post( 'package_commision', '' );
                    $upload      = STInput::post( 'package_item_upload', '' );
                    $featured    = STInput::post( 'package_item_featured', '' );
                    $description = STInput::post( 'package_description', '' );

                    $services_str = '';
                    if(!empty($services)){
                        $services_str = implode(',', $services);
                    }

                    //== Check empty package's name
                    if ( empty( trim( $name ) ) ) {
                        STTemplate::set_message( __( 'The name field is required', ST_TEXTDOMAIN ), 'error' );

                        return false;
                    }

                    $created = strtotime( date( 'Y-m-d' ) );

                    if ( $available > 0 ) {
                        $available = (int)$available;
                    } else {
                        $available = 'unlimited';
                    }

                    if ( $upload == '' ) {
                        $upload = 'unlimited';
                    } else {
                        $upload = (float)$upload;
                    }

                    if ( $featured == '' ) {
                        $featured = 'unlimited';
                    } else {
                        $featured = (float)$featured;
                    }

                    global $wpdb;
                    $table = $wpdb->prefix . 'st_member_packages';

                    $data = [
                        'id'                    => null,
                        'package_name'          => $name,
                        'package_subname'       => $subname,
                        'package_price'         => $price,
                        'package_services'      => $services_str,
                        'package_time'          => $available,
                        'package_commission'    => $commission,
                        'package_item_upload'   => $upload,
                        'package_item_featured' => $featured,
                        'package_description'   => $description,
                    ];

                    if ( $id ) {
                        $data[ 'id' ] = (int)$id;
                    }
                    $wpdb->replace( $table, $data );

                    STTemplate::set_message( __( 'Added a new package successful.', ST_TEXTDOMAIN ), 'success' );
                    wp_redirect( admin_url( 'admin.php?page=st_member_packages' ) );
                    eixt();
                }
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function get_packages( $where = '' , $order = null)
            {
                global $wpdb;
                $table = $wpdb->prefix . 'st_member_packages';
	            $order_clause = '';
                if($order == '1')
	                $order_clause = " ORDER BY package_price ASC";
                $sql   = "SELECT * FROM {$table} WHERE 1=1 {$where} {$order_clause}";

                return $wpdb->get_results( $sql );
            }
            public function get_packages_by_id($id)
            {
                global $wpdb;
                $where = "AND id = {$id}";
                $table = $wpdb->prefix . 'st_member_packages';
                $order_clause = '';
                $order_clause = " ORDER BY package_price ASC";
                $sql   = "SELECT * FROM {$table} WHERE 1=1 {$where} {$order_clause}";
                    

                return $wpdb->get_results( $sql );
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function get_order_info( $order_id, $info = 'id' )
            {
                global $wpdb;
                $table = $wpdb->prefix . 'st_member_packages_order';
                $sql   = "SELECT {$info} FROM {$table} WHERE id = {$order_id}";

                return $wpdb->get_row( $sql );
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function get_order_by_partner( $partner_id )
            {
                global $wpdb;
                $table = $wpdb->prefix . 'st_member_packages_order';
                $sql   = "SELECT * FROM {$table} WHERE partner = {$partner_id}";

                return $wpdb->get_row( $sql );
            }

            public function can_upgrade( $user_id )
            {
                $order = $this->get_order_by_partner( $user_id );
                if ( !$order ) {
                    return false;
                }
                //When renew package
                $id       = $order->package_id;
                $price    = (float)$order->package_price;
                $order = " ORDER BY package_price ASC";
                $packages = $this->get_packages( $order );
                if ( !$packages ) {
                    return false;
                }
                $pack_upgrade = [];
                foreach ( $packages as $key => $package ) {
                    $_price = (float)$package->package_price;
                    if ( $price <= $_price or $id==$package->id ) {
                        $pack_upgrade[] = $package;
                    }
                }
                if ( empty( $pack_upgrade ) ) {
                    return false;
                }

                return $pack_upgrade;
            }

            public function enabled_membership()
            {
                $enable = st()->get_option( 'enable_membership', 'on' );
                if ( $enable == 'on' ) {
                    return true;
                }

                return false;
            }

            public function register_member_page()
            {
                $page = st()->get_option( 'member_packages_page', 0 );

                return get_permalink( $page );
            }

            public function user_can_register_package( $user_id )
            {
                if ( !$this->enabled_membership() ) {
                    return false;
                }

                if ( !is_user_logged_in() ) {
                    return false;
                }
                if ( $this->get_user_role() == 'administrator' ) {
                    return false;
                }
                $package = $this->get_order_by_partner( $user_id );
                if ( $user_id && !$package ) {
                    return true;
                }
                if ( $this->is_package_expired( $user_id ) ) {
                    return true;
                }

                return false;
            }

            public function get_user_role( $user_id = '' )
            {
                if ( empty( $user_id ) ) {
                    $user_id = get_current_user_id();
                }
                $user_info = get_userdata( $user_id );
                $roles     = $user_info->roles;

                return isset( $roles[ 0 ] ) ? $roles[ 0 ] : 'subscriber';
            }

            public function is_package_expired( $user_id )
            {
                if ( $this->enabled_membership() ) {
                    if ( $this->get_user_role() != 'partner' ) {
                        return false;
                    }
                    $order = $this->get_order_by_partner( $user_id );
                    $today = strtotime( date( 'Y-m-d', strtotime( 'now' ) ) );
                    if ( $order ) {
                        $created = (int)$order->created;
                        $time    = $order->package_time;
                        if ( $time == 'unlimited' ) {
                            return false;
                        } else {
                            $expired = strtotime( '+' . $time . ' days', $created );
                            if ( $expired < $today ) {
                                return true;
                            }
                        }

                        return false;
                    } else {
                        return true;
                    }
                }

                return false;

            }

            public function partner_verified_package( $user_id )
            {
                $order = $this->get_order_by_partner( $user_id );
                $today = date( 'Y-m-d', strtotime( 'now' ) );
                if ( $order ) {
                    if ( $order->status != 'completed' ) {
                        return false;
                    }
                    $created = (int)$order->created;
                    $time    = (int)$order->package_time;
                    if ( $time != 'unlimited' ) {
                        $expired = strtotime( '+' . $time . ' days', $created );
                        if ( $expired < $today ) {
                            return false;
                        }
                    }

                    return true;
                } else {
                    return false;
                }
            }

            public function get_commission_package( $user_id, $default )
            {

                if ( $this->partner_verified_package( $user_id ) ) {
                    $order      = $this->get_order_by_partner( $user_id );
                    $commission = (float)$order->package_commission;
                    if ( $commission < 0 ) {
                        $commission = 0;
                    }

                    return $commission;
                }

                return (float)$default;
            }

            public function count_item_package( $user_id )
            {
                if ( (int)$user_id <= 0 ) {
                    return 0;
                }

                if ( !$this->partner_verified_package( $user_id ) ) {
                    return 0;
                }

                $order = $this->get_order_by_partner( $user_id );

                return $order->package_item_upload;

            }

            public function count_item_can_public( $user_id )
            {
                global $wpdb;
                $inner_join_wpml = "";
                $where_wpml = "";

	            if ( function_exists( 'icl_object_id' ) ) {
		            $default_language = wpml_get_default_language();
					$inner_join_wpml = " INNER JOIN {$wpdb->prefix}icl_translations as itl ON {$wpdb->posts}.ID = itl.element_id ";
					$where_wpml = " AND itl.language_code = '{$default_language}' ";
	            }

                $sql = "SELECT
			                count(ID) total
			            FROM
			                {$wpdb->prefix}posts
			                {$inner_join_wpml}
			            WHERE
			                post_type IN (
			                    'st_hotel',
			                    'hotel_room',
			                    'st_rental',
			                    'rental_room',
			                    'st_cars',
			                    'st_tours',
			                    'st_activity'
			                )
			            	AND 
			            		post_author = {$user_id}
			            		{$where_wpml}			            	  
			            	";

                $total = (int)$wpdb->get_var( $sql );

                $order = $this->get_order_by_partner( $user_id );
                if ( !$order ) {
                    return 0;
                }
                if ( $order->package_item_upload == 'unlimited' ) {
                    return 'unlimited';
                }

                return (int)$order->package_item_upload - $total;
            }

            public function count_item_can_public_status( $user_id, $post_id = '' )
            {
                global $wpdb;
                $where = '';
                if ( !empty( $post_id ) ) {
                    $where = " AND ID NOT IN ({$post_id})";
                }
                $sql = "SELECT
                    count(ID) total
                FROM
                    {$wpdb->prefix}posts
                WHERE
                    post_type IN (
                        'st_hotel',
                        'hotel_room',
                        'st_rental',
                        'rental_room',
                        'st_cars',
                        'st_tours',
                        'st_activity'
                    )
                    {$where}
                    AND post_status = 'publish'
                AND post_author = {$user_id}";

                $total = (int)$wpdb->get_var( $sql );

                $order = $this->get_order_by_partner( $user_id );
                if ( !$order ) {
                    return 0;
                }
                if ( $order->package_item_upload == 'unlimited' ) {
                    return 'unlimited';
                }

                return (int)$order->package_item_upload - $total;
            }

            public function count_item_can_featured( $user_id, $post_id = '' )
            {
                global $wpdb;

                $where = '';
                if ( !empty( $post_id ) ) {
                    $where = " AND ID NOT IN ({$post_id}) ";
                }
                $sql = "SELECT
                    count(_post.ID) AS total
                FROM
                    (
                        SELECT DISTINCT
                            ID
                        FROM
                            {$wpdb->prefix}posts
                        INNER JOIN {$wpdb->prefix}postmeta AS meta ON meta.post_id = {$wpdb->prefix}posts.ID
                        AND meta.meta_key = 'is_featured'
                        WHERE
                            post_type IN (
                                'st_hotel',
                                'hotel_room',
                                'st_rental',
                                'rental_room',
                                'st_cars',
                                'st_tours',
                                'st_activity'
                            )
                        AND post_author = 2
                        {$where}
                        AND meta.meta_value = 'on'
                    ) AS _post";

                $total = (int)$wpdb->get_var( $sql );

                $order = $this->get_order_by_partner( $user_id );

                if ( !$order ) {
                    return 0;
                }

                if ( $order->package_item_featured == 'unlimited' ) {
                    return 'unlimited';
                }

                return (int)$order->package_item_featured - $total;
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function convert_item( $item, $input_time = false )
            {
                if ( $item === 'unlimited' ) {
                    return __( 'Unlimited', ST_TEXTDOMAIN );
                } else {
                    $item = (int)$item;
                    if ( $input_time ) {
                        if ( $item <= 1 ) {
                            return $item . ' ' . __( 'day', ST_TEXTDOMAIN );
                        } else {
                            return $item . ' ' . __( 'days', ST_TEXTDOMAIN );
                        }
                    } else {
                        if ( $item <= 1 ) {
                            return $item . ' ' . __( 'item', ST_TEXTDOMAIN );
                        } else {
                            return $item . ' ' . __( 'items', ST_TEXTDOMAIN );
                        }
                    }
                }
            }

            public function paser_list_services($package_services_str){
                $res = '';
                if($package_services_str == ''){
                    $res = __('All services', ST_TEXTDOMAIN);
                }else{
                    $arr_services = explode(',', $package_services_str);
                    if(!empty($arr_services)){
                        if(in_array('all', $arr_services)){
                            $res = __('All services', ST_TEXTDOMAIN);
                        }else{
                            $arr_sub_services = array();
                            foreach ($arr_services as $k => $v){
                                $obj = get_post_type_object( $v );
                                array_push($arr_sub_services, $obj->labels->singular_name);
                            }
                            $res = implode(', ', $arr_sub_services);
                        }
                    }
                }
                return $res;
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function st_add_cart_member_package()
            {
                if ( STInput::post( 'add_cart_package', '' ) != '' ) {
                    $package_id      = (int)STInput::post( 'package', 0 );
                    $package_encrypt = STInput::post( 'package_encrypt', '' );
                    if ( TravelHelper::st_compare_encrypt( $package_id, $package_encrypt ) ) {
                        $order = " ORDER BY package_price ASC";
                        $package = $this->get_packages( " AND id = {$package_id} " . $order . " LIMIT 1" );
                        if ( !empty( $package ) ) {
                            $redirect = $this->do_checkout( $package[ 0 ] );
                            wp_redirect( $redirect );
                            exit();
                        } else {
                            STTemplate::set_message( __( 'The package is invalid. Please select again!', ST_TEXTDOMAIN ), 'error' );

                            return false;
                        }
                    } else {
                        STTemplate::set_message( __( 'The package is invalid. Please select again!', ST_TEXTDOMAIN ), 'error' );

                        return false;
                    }
                }
            }
            /*Package new*/
            public function st_add_cart_member_package_new()
            {
                if ( STInput::post( 'add_cart_package_new', '' ) != '' ) {
                    $package_id      = (int)STInput::post( 'package_new', 0 );
                    $package_encrypt = STInput::post( 'package_encrypt_new', '' );
                    if ( TravelHelper::st_compare_encrypt( $package_id, $package_encrypt ) ) {
                        $order = " ORDER BY package_price ASC";
                        $package = $this->get_packages( " AND id = {$package_id} " . $order . " LIMIT 1" );
                        if ( !empty( $package ) ) {
                            $redirect = $this->do_checkout( $package[ 0 ] );
                            wp_redirect( $redirect );
                            exit();
                        } else {
                            STTemplate::set_message( __( 'The package is invalid. Please select again!', ST_TEXTDOMAIN ), 'error' );
                            return false;
                        }
                    } else {
                        STTemplate::set_message( __( 'The package is invalid. Please select again!', ST_TEXTDOMAIN ), 'error' );
                        return false;
                    }
                }
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function do_checkout( $package )
            {
                $this->add_cart( $package );
                $checkout_id  = st()->get_option( 'member_checkout_page', '' );
                $checkout_url = get_permalink( $checkout_id );

                return esc_url( $checkout_url );
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function add_cart( $package )
            {
                if ( isset( $_COOKIE[ 'st_cart_package' ] ) ) {
                    TravelHelper::setcookie( 'st_cart_package', '', time() - 3600 );
                }
                $package = $this->update_cart( $package );
                TravelHelper::setcookie( 'st_cart_package', serialize( $package ), time() + ( 86400 * 30 ) );
            }

            public function update_cart( $package )
            {
                $order = $this->get_order_by_partner( get_current_user_id() );
                if ( !$order ) {
                    return $package;
                }
                $price = 0;
                if ( $order->package_time != 'unlimited' && $order->status == 'completed' ) {
                    $price        = (float)$order->package_price;
                    $created      = (int)$order->created;
                    $today        = date( 'Y-m-d' );
                    $package_time = absint( $order->package_time );
                    $avai_time    = $package_time - ( STDate::dateDiff( date( 'Y-m-d', $created ), $today ) );
                    $price        = ( $price / $package_time ) * $avai_time;
                }
                $_price = (float)$package->package_price;

                $package->package_price = $_price - $price;

                return $package;
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function get_cart()
            {
                if ( isset( $_COOKIE[ 'st_cart_package' ] ) && !empty( $_COOKIE[ 'st_cart_package' ] ) ) {
                    return unserialize( stripslashes( $_COOKIE[ 'st_cart_package' ] ) );
                }

                return false;
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function destroy_cart()
            {
                if ( isset( $_COOKIE[ 'st_cart_package' ] ) ) {
                    TravelHelper::setcookie( 'st_cart_package', '', time() - 3600 );
                }
            }


            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function complete_purchase( $payment, $order_id )
            {

                do_action( 'st_before_complete_checkout', $payment );
                $respon = [];
                switch ( $payment ) {
                    case 'st_submit_form':
                        $respon = $this->submit_checkout( $order_id );
                        break;
                    case 'st_paypal':
                        $respon = $this->paypal_checkout( $order_id );
                        break;
                    case 'st_stripe':
                        $respon = $this->stripe_checkout( $order_id );
                        break;
                    case 'st_payfast':
                        $respon = $this->payfast_checkout( $order_id );
                        break;
                    case 'st_authorize':
                        $respon = $this->authorize_checkout( $order_id );
                        break;
                    case 'st_payu':
                        $respon = $this->payu_checkout( $order_id );
                        break;
                    case 'st_skrill':
                        $respon = $this->skrill_checkout( $order_id );
                        break;
                    case 'st_twocheckout':
                        $respon = $this->twocheckout_checkout( $order_id );
                        break;
                }

                return $respon;

            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function submit_checkout( $order_id )
            {
                return [
                    'status'       => TravelHelper::st_encrypt( $order_id . 'st1' ),
                    'redirect_url' => $this->get_return_url( $order_id ),
                ];
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function paypal_checkout( $order_id )
            {
                $order = $this->get( '*', $order_id );

                $currency = TravelHelper::get_current_currency( 'name' );

                $total = (float)$order->package_price;

                $booking_currency_conversion = st()->get_option( 'booking_currency_conversion' );
                if ( !empty( $booking_currency_conversion ) ) {
                    foreach ( $booking_currency_conversion as $k => $v ) {
                        if ( $v[ 'name' ] == $currency ) {
                            $total    = $total / $v[ 'rate' ];
                            $total    = round( (float)$total, 2 );
                            $currency = "USD";
                        }
                    }
                }

                $purchase = [
                    'amount'      => $total,
                    'currency'    => $currency,
                    'description' => __( 'Member Package', ST_TEXTDOMAIN ),
                    'returnUrl'   => $this->get_return_url( $order_id ),
                    'cancelUrl'   => $this->get_cancel_url( $order_id ),
                ];

                $gateway  = Omnipay::create( 'PayPal_Express' );
                $gateway->setUsername( st()->get_option( 'paypal_api_username' ) );
                $gateway->setPassword( st()->get_option( 'paypal_api_password' ) );
                $gateway->setSignature( st()->get_option( 'paypal_api_signature' ) );
                if ( st()->get_option( 'paypal_enable_sandbox', 'on' ) == 'on' ) {
                    $gateway->setTestMode( true );
                }

                $response = $gateway->purchase( $purchase )->send();

                if ( $response->isSuccessful() ) {
                    return [ 'status' => TravelHelper::st_encrypt( $order_id . 'st1' ) ];
                } elseif ( $response->isRedirect() ) {
                    return [ 'status' => TravelHelper::st_encrypt( $order_id . 'st1' ), 'redirect_url' => $response->getRedirectUrl() ];
                } else {
                    return [ 'status' => TravelHelper::st_encrypt( $order_id . 'st0' ), 'message' => $response->getMessage(), 'data' => $purchase ];
                }
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function payfast_checkout( $order_id )
            {
                $order   = $this->get( '*', $order_id );
                $gateway = Omnipay::create( 'PayFast' );
                $gateway->setMerchantId( st()->get_option( 'pay_fast_merchant_id' ) );
                $gateway->setMerchantKey( st()->get_option( 'pay_fast_merchant_key' ) );
                $gateway->setPdtKey( st()->get_option( 'pay_fast_pdt_key' ) );
                if ( st()->get_option( 'pay_fast_enable_sandbox', 'on' ) == 'on' ) {
                    $gateway->setTestMode( true );
                }

                $currency = TravelHelper::get_current_currency( 'name' );

                $order_token_code = $order->token;

                $purchase = [
                    'amount'        => round( (float)$order->package_price, 2 ),
                    'currency'      => $currency,
                    'description'   => __( 'Member Package', ST_TEXTDOMAIN ),
                    'returnUrl'     => $this->get_return_url( $order_id ),
                    'cancelUrl'     => $this->get_cancel_url( $order_id ),
                    'transactionId' => $order_token_code,
                ];

                $response = $gateway->purchase(
                    $purchase
                )->send();

                if ( $response->isSuccessful() ) {
                    return [ 'status' => TravelHelper::st_encrypt( $order_id . 'st1' ) ];
                } elseif ( $response->isRedirect() ) {
                    return [
                        'status'        => TravelHelper::st_encrypt( $order_id . 'st1' ),
                        'redirect_form' => $this->getRedirectForm( $response ),
                    ];
                } else {
                    return [ 'status' => TravelHelper::st_encrypt( $order_id . 'st0' ), 'message' => $response->getMessage(), 'data' => $purchase ];
                }
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function stripe_checkout( $order_id )
            {
                $validate=new STValidate();
                $enable_token = st()->get_option('stripe_enable_token', 'off');
                if($enable_token == 'on'){
                    $validate->set_rules('st_stripe_card_holder',__("Card Holder Name",ST_TEXTDOMAIN),'required');
                    $validate->set_rules('st_stripe_card_zipcode',__("Zip Code",ST_TEXTDOMAIN),'required');
                }else{
                    $validate->set_rules('st_stripe_card_number',__("Card Number",ST_TEXTDOMAIN),'required');
                    $validate->set_rules('st_stripe_card_expiry_month',__("Expiry Month",ST_TEXTDOMAIN),'required');
                    $validate->set_rules('st_stripe_card_expiry_year',__("Expiry Year",ST_TEXTDOMAIN),'required');
                    $validate->set_rules('st_stripe_card_code',__("Card Code",ST_TEXTDOMAIN),'required');
                }

                if(!$validate->run())
                {
                    STTemplate::set_message($validate->error_string(), 'danger');
                    return false;
                }

                $order   = $this->get( '*', $order_id );
                $gateway = Omnipay::create( 'Stripe' );
                $gateway->setApiKey( st()->get_option( 'stripe_secret_key' ) );
                if ( st()->get_option( 'stripe_enable_sandbox', 'on' ) == 'on' ) {
                    $gateway->setApiKey( st()->get_option( 'stripe_test_secret_key' ) );
                }

                $enable_token = st()->get_option('stripe_enable_token', 'off');
                $currency = TravelHelper::get_current_currency( 'name' );
                if($enable_token == 'on'){
                    $token = STInput::post('token');
                    $purchase = array(
                        'amount'        => round( (float)$order->package_price, 2 ),
                        'currency'      => $currency,
                        'description'   => __('Traveler Booking', ST_TEXTDOMAIN),
                        'token' => $token,
                    );
                }else{
                    $cardData = [
                        'number'      => STInput::post( 'st_stripe_card_number' ),
                        'expiryMonth' => STInput::post( 'st_stripe_card_expiry_month' ),
                        'expiryYear'  => STInput::post( 'st_stripe_card_expiry_year' ),
                        'cvv'         => STInput::post( 'st_stripe_card_code' ),
                    ];

                    $purchase = [
                        'amount'      => round( (float)$order->package_price, 2 ),
                        'currency'    => $currency,
                        'description' => __( 'Traveler Booking', ST_TEXTDOMAIN ),
                        'card'        => $cardData,
                    ];

                }

                try {
                    $response = $gateway->purchase(
                        $purchase
                    )->send();
                } catch ( Exception $e ) {
                    return [
                        'status'  => TravelHelper::st_encrypt( $order_id . $order_id . 'st0' ),
                        'message' => $e->getMessage(),
                    ];
                }

                if ( $response->isSuccessful() ) {
                    return [
                        'status'       => TravelHelper::st_encrypt( $order_id . 'st1' ),
                        'redirect_url' => $this->get_return_url( $order_id ),
                    ];

                } elseif ( $response->isRedirect() ) {
                    return [
                        'status'       => TravelHelper::st_encrypt( $order_id . 'st1' ),
                        'redirect_url' => $this->get_return_url( $order_id ),
                    ];
                } else {
                    return [ 'status' => 0, 'message' => $response->getMessage(), 'data' => $response ];

                }
            }

            public function getRedirectForm( $res )
            {
                $form = st()->load_template( 'member_packages/form_payfast', false, [ 'res' => $res ] );

                return $form;
            }

            public function authorize_checkout($order_id){
                $validate=new STValidate();
                $validate->set_rules('st_authorize_card_name',__("Card Name",ST_TEXTDOMAIN),'required');
                $validate->set_rules('st_authorize_card_number',__("Card Number",ST_TEXTDOMAIN),'required');
                $validate->set_rules('st_authorize_card_expiry_month',__("Expiry Month",ST_TEXTDOMAIN),'required');
                $validate->set_rules('st_authorize_card_expiry_year',__("Expiry Year",ST_TEXTDOMAIN),'required');
                $validate->set_rules('st_authorize_card_code',__("Card Code",ST_TEXTDOMAIN),'required');

                if(!$validate->run())
                {
                    STTemplate::set_message($validate->error_string(), 'danger');
                    return false;
                }

                $order   = $this->get( '*', $order_id );
                $gateway = Omnipay::create( 'AuthorizeNet_AIM' );

                $gateway->setApiLoginId( st()->get_option( 'authorize_login_id', '' ) );
                $gateway->setTransactionKey( st()->get_option( 'authorize_transaction_key', '' ) );

                if ( st()->get_option( 'authorize_enable_sandbox', 'on' ) == 'on' ) {
                    $gateway->setTestMode( true );
                    $gateway->setDeveloperMode( true );
                }

                $purchase = [
                    'card'          => new CreditCard( [
                        'firstName'   => STInput::request( 'st_authorize_card_name' ),
                        'number'      => STInput::request( 'st_authorize_card_number' ),
                        'expiryMonth' => STInput::request( 'st_authorize_card_expiry_month' ),
                        'expiryYear'  => STInput::request( 'st_authorize_card_expiry_year' ),
                        'cvv'         => STInput::request( 'st_authorize_card_code' ),
                    ] ),
                    'amount'        => round( (float)$order->package_price, 2 ),
                    'currency'      => TravelHelper::get_current_currency('name'),
                    'description'   => 'Order',
                    'transactionId' => uniqid() . $order_id,
                    'failureUrl'    => $this->get_cancel_url( $order_id ),
                    'returnUrl'     => $this->get_return_url( $order_id ),
                    'cancelUrl'     => $this->get_cancel_url( $order_id )
                ];

                try {
                    $response = $gateway->purchase(
                        $purchase
                    )->send();
                } catch ( Exception $e ) {
                    STTemplate::set_message($e->getMessage(), 'danger');
                    return false;
                }
                if ( $response->isSuccessful() ) {
                    return [
                        'status'       => TravelHelper::st_encrypt( $order_id . 'st1' ),
                        'redirect_url' => $this->get_return_url( $order_id ),
                    ];
                } elseif ( $response->isRedirect() ) {
                    return [
                        'status'       => TravelHelper::st_encrypt( $order_id . 'st1' ),
                        'redirect_url' => $this->get_return_url( $order_id ),
                    ];
                } else {
                    STTemplate::set_message($response->getMessage(), 'danger');
                    return false;
                }
            }

            public function payu_checkout($order_id){
                $order   = $this->get( '*', $order_id );
                $gateway = Omnipay::create( 'PayUBiz' );

                $gateway->setKey(st()->get_option('payu_merchant_id', ''));
                $gateway->setSalt(st()->get_option('payu_salt_key', ''));

                if (st()->get_option('payu_enable_sandbox', 'on') == 'on') {
                    $gateway->setTestMode(true);
                }

                $order_token_code = $order->token;

                $purchase = [
                    'name' => STInput::request('st_first_name'),
                    'email' => STInput::request('st_email'),
                    'phone' => STInput::request('st_phone'),
                    'amount' => number_format(round( (float)$order->package_price, 2 ), 2, '.', ''),
                    'product' => 'Order',
                    'transactionId' => $order_token_code,
                    'failureUrl' => $this->get_cancel_url($order_id),
                    'returnUrl' => $this->get_return_url($order_id),
                    'cancelUrl' => $this->get_cancel_url($order_id)
                ];

                $response = $gateway->purchase(
                    $purchase
                )->send();

                if ( $response->isSuccessful() ) {
                    return [ 'status' => TravelHelper::st_encrypt( $order_id . 'st1' ) ];
                } elseif ( $response->isRedirect() ) {
                    return [
                        'status'        => TravelHelper::st_encrypt( $order_id . 'st1' ),
                        'redirect_form' => $this->getRedirectForm( $response ),
                    ];
                } else {
                    return [ 'status' => TravelHelper::st_encrypt( $order_id . 'st0' ), 'message' => $response->getMessage(), 'data' => $purchase ];
                }
            }

            public function skrill_checkout($order_id){
                $order   = $this->get( '*', $order_id );
                $gateway = Omnipay::create( 'Skrill' );

                $gateway->setEmail(st()->get_option('skrill_email', ''));
                $gateway->setPassword(st()->get_option('skrill_password', ''));

                if (st()->get_option('skrill_enable_sandbox', 'on') == 'on') {
                    $gateway->setTestMode(true);
                }

                $purchase = [
                    'language' => 'EN',
                    'amount' => number_format(round( (float)$order->package_price, 2 ), 2, '.', ''),
                    'currency' => TravelHelper::get_current_currency('name'),
                    'details' => ['item' => __('Package Member', ST_TEXTDOMAIN)],
                    'notifyUrl' => $this->get_return_url($order_id),
                    'returnUrl' => $this->get_return_url($order_id),
                    'cancelUrl' => $this->get_cancel_url($order_id)
                ];

                $response = $gateway->purchase($purchase)->send();

                if ( $response->isSuccessful() ) {
                    return [ 'status' => TravelHelper::st_encrypt( $order_id . 'st1' ) ];
                } elseif ( $response->isRedirect() ) {
                    return [ 'status' => TravelHelper::st_encrypt( $order_id . 'st1' ), 'redirect_url' => $response->getRedirectUrl() ];
                } else {
                    return [ 'status' => TravelHelper::st_encrypt( $order_id . 'st0' ), 'message' => $response->getMessage(), 'data' => $purchase ];
                }

            }

            public function twocheckout_checkout($order_id){
                $validate=new STValidate();
                $validate->set_rules('st_twocheckout_card_name',__("Card Name",ST_TEXTDOMAIN),'required');
                $validate->set_rules('st_twocheckout_card_number',__("Card Number",ST_TEXTDOMAIN),'required');
                $validate->set_rules('st_twocheckout_card_expiry_month',__("Expiry Month",ST_TEXTDOMAIN),'required');
                $validate->set_rules('st_twocheckout_card_expiry_year',__("Expiry Year",ST_TEXTDOMAIN),'required');
                $validate->set_rules('st_twocheckout_card_code',__("Card Code",ST_TEXTDOMAIN),'required');

                if(!$validate->run())
                {
                    STTemplate::set_message($validate->error_string(), 'danger');
                    return false;
                }

                $order   = $this->get( '*', $order_id );
                $gateway = Omnipay::create( 'TwoCheckoutPlus_Token' );

                $gateway->setAccountNumber( st()->get_option( 'twocheckout_account_number', '' ) );
                $gateway->setPrivateKey( st()->get_option( 'twocheckout_private_key', '' ) );

                if ( st()->get_option( 'twocheckout_enable_sandbox', 'on' ) == 'on' ) {
                    $gateway->setTestMode( true );
                }

                $purchase = [
                    'currency'      => TravelHelper::get_current_currency('name'),
                    'transactionId' => esc_html__( 'Order:', ST_TEXTDOMAIN ) . ' ' . esc_attr( $order_id ) . '-' . esc_attr( $order_id ),
                    'returnUrl'     => $this->get_return_url( $order_id ),
                    'notifyUrl' => $this->get_return_url($order_id),
                    'returnUrl' => $this->get_return_url($order_id),
                    'cancelUrl' => $this->get_cancel_url($order_id)
                ];

                $card                 = [
                    'firstName'       => STInput::request( 'st_first_name', 'firstname' ),
                    'lastName'        => STInput::request( 'st_last_name', 'lastname'),
                    'email'           => STInput::request( 'st_email', 'email' ),
                    'billingAddress1' => STInput::request( 'st_address', 'address1' ),
                    'billingAddress2' => STInput::request( 'st_address2', 'address2' ),
                    'billingCity'     => STInput::request( 'st_city', 'city' ),
                    'billingPostcode' => STInput::request( 'st_zip_code', 'zip_code' ),
                    'billingState'    => STInput::request( 'st_province', 'state' ),
                    'billingCountry'  => STInput::request( 'st_country', 'country' ),
                ];

                $purchase[ 'card' ]   = $card;
                $purchase[ 'token' ]  = sanitize_text_field(STInput::request('token'));
                $purchase[ 'amount' ] = number_format(round( (float)$order->package_price, 2 ), 2, '.', '');

                try {
                    $response = $gateway->purchase(
                        $purchase
                    )->send();
                } catch ( Exception $e ) {
                    STTemplate::set_message($e->getMessage(), 'danger');
                    return false;
                }
                if ( $response->isSuccessful() ) {
                    return [
                        'status'       => TravelHelper::st_encrypt( $order_id . 'st1' ),
                        'redirect_url' => $this->get_return_url( $order_id ),
                    ];
                } elseif ( $response->isRedirect() ) {
                    return [
                        'status'       => TravelHelper::st_encrypt( $order_id . 'st1' ),
                        'redirect_url' => $this->get_return_url( $order_id ),
                    ];
                } else {
                    STTemplate::set_message($response->getMessage(), 'danger');
                    return false;
                }
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function get_cancel_url( $order_id )
            {
                $order_token_code = $this->get( 'token', $order_id );
                $array            = [
                    'order_token_code' => $order_token_code,
                    'status'           => TravelHelper::st_encrypt( $order_id . 'st0' ),
                ];

                return add_query_arg( $array, $this->get_success_link() );
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function get_return_url( $order_id )
            {
                $order_token_code = $this->get( 'token', $order_id );
                $array            = [
                    'order_token_code' => $order_token_code,
                    'status'           => TravelHelper::st_encrypt( $order_id . 'st1' ),
                ];

                return add_query_arg( $array, $this->get_success_link() );
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function get_success_link()
            {
                $payment_success_link = get_permalink( st()->get_option( 'member_success_page' ) );

                return $payment_success_link;
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function get( $key = 'id', $order_id )
            {
                global $wpdb;
                $table = $wpdb->prefix . 'st_member_packages_order';
                $sql   = "SELECT {$key} FROM {$table} WHERE id = {$order_id} LIMIT 1";
                if ( $key === '*' ) {
                    return $wpdb->get_row( $sql );
                }

                return $wpdb->get_var( $sql );
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public function update_status( $new_status, $order_id )
            {
                global $wpdb;
                $table = $wpdb->prefix . 'st_member_packages_order';
                $sql   = "UPDATE {$table} SET status='{$new_status}' WHERE id = {$order_id}";
                $wpdb->query( $sql );

                $cls_package     = STPackages::get_inst();
                $get_order_by_id = $cls_package->get_order_package_by( "id = {$order_id}" );

                if ( $new_status == 'completed' ) {
                    //==== Limit services of old partner
                    $author = (int)$get_order_by_id->partner;
                    global $wpdb;
                    $sql = "SELECT
                    ID
                FROM
                    {$wpdb->prefix}posts
                WHERE
                    post_type IN (
                        'st_hotel',
                        'hotel_room',
                        'st_rental',
                        'rental_room',
                        'st_cars',
                        'st_tours',
                        'st_activity'
                    )
                AND post_author = {$author}";

                    $posts = $wpdb->get_col( $sql, 0 );
                    $size  = count( $posts );

                    $package_item_upload = $get_order_by_id->package_item_upload;
                    if ( $package_item_upload != 'unlimited' && $size > (int)$package_item_upload ) {
                        for ( $i = (int)$package_item_upload; $i < $size; $i++ ) {
                            wp_update_post(
                                [
                                    'ID'          => $posts[ $i ],
                                    'post_status' => 'draft'
                                ]
                            );
                        }
                    }
                }
            }

            public function delete_order( $order_id )
            {
                global $wpdb;
                $table = $wpdb->prefix . 'st_member_packages_order';
                $sql   = "DELETE FROM {$table} WHERE id = {$order_id}";
                $wpdb->query( $sql );
            }

            /**
             * @since   1.3.1
             * @updated 1.3.1
             **/
            public static function get_inst()
            {
                return self::$inst;
            }
        }

        new STAdminPackages();
    }
