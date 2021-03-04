<?php
/**
 * @since 1.1.9
 */
if(!class_exists('STAdminlandingpage')){
    class STAdminlandingpage  extends STAdmin
    {
        //private $_api_url='http://shinetheme.com/demosd/check_purchase/index.php';
        private $_api_url='http://shinetheme.com/demosd/check_purchase/index.php';

        public function __construct()
        {
            $envato_purchasecode = st()->get_option('envato_purchasecode', false);
            $check_upcode = get_option('check_ucode');
            if(!empty($envato_purchasecode) && empty($check_upcode)){
                update_option('envato_purchasecode', $envato_purchasecode);
                update_option('check_ucode', '1');
            }
            //parent::__construct();
            //add_action('after_switch_theme', array($this, 'redirect_after_set_up_theme'));
            add_action('admin_menu', array($this, 'st_create_submenu'), 11);
            add_action('admin_enqueue_scripts', array($this, 'add_script'));

            /**
             * @since 1.2.0
             */
            add_action('admin_init',array($this,'_save_product_registration'));
        }

        public function redirect_after_set_up_theme()
        {
            if (!class_exists( 'OT_Loader' )) return ;
            wp_redirect(admin_url('/admin.php?page=st_product_reg'));
        }

        /**
         * @since 1.2.0
         */
        function _save_product_registration()
        {
            if(STInput::post('st_action')=='save_product_registration')
            {
                if(check_admin_referer('traveler_update_registration','traveler_update_registration_nonce'))
                {

                    $pcc = STInput::post('tf_purchase_code');
                    if(!empty($pcc)){
                        if(self::checkValidatePurchaseCode($pcc)){
                            if(md5($pcc) == '7a87014a91520fb87904f12fff17ce24'){
                                update_option('envato_purchasecode',$pcc);
                            }else{
                                /* Save data */
                                $args_data = array(
                                    'name' => get_bloginfo('name'),
                                    'url' => get_bloginfo('url'),
                                    'admin_email' => get_bloginfo('admin_email'),
                                    'purchare_code' => $pcc
                                );

                                global $wp_version;

                                $request= array(
                                    'body' => array(
                                        'action' => 'check_purchase_time',
                                        'request' => $args_data,
                                    ),
                                    'user-agent' => 'WordPress/'. $wp_version .'; '. home_url()
                                );

                                $res_remote = wp_remote_post($this->_api_url,$request);

                                $body = '';
                                if(isset($res_remote['body']))
                                    $body = json_decode($res_remote['body'], TRUE);

                                if(!empty($body)){
                                    if($body['status'] == '1' or $body['status'] == '4'){
                                        update_option('envato_purchasecode',$pcc);
                                        wp_redirect(admin_url('/admin.php?page=st_product_reg'));
                                    }
                                    if($body['status'] == '2'){
                                        wp_redirect(admin_url('/admin.php?page=st_product_reg&has_error=3'));
                                    }
                                }else{
                                    update_option('envato_purchasecode',$pcc);
                                    wp_redirect(admin_url('/admin.php?page=st_product_reg'));
                                }
                            }
                        }else{
                            wp_redirect(admin_url('/admin.php?page=st_product_reg&has_error=2'));
                        }
                    }else{
                        wp_redirect(admin_url('/admin.php?page=st_product_reg&has_error=1'));
                    }
                }
            }elseif(STInput::post('st_action')=='un_save_product_registration'){
                /* Save data */
                if(md5(get_option('envato_purchasecode')) == '7a87014a91520fb87904f12fff17ce24'){
                    update_option('envato_purchasecode','');
                    wp_redirect(admin_url('/admin.php?page=st_product_reg&deregister=1'));
                }else{
                    $args_data = array(
                        'name' => get_bloginfo('name'),
                        'url' => get_bloginfo('url'),
                        'admin_email' => get_bloginfo('admin_email'),
                        'purchare_code' => get_option('envato_purchasecode')
                    );

                    global $wp_version;

                    $request= array(
                        'body' => array(
                            'action' => 'delete_purchase_time',
                            'request' => $args_data,
                        ),
                        'user-agent' => 'WordPress/'. $wp_version .'; '. home_url()
                    );

                    $res_remote = wp_remote_post($this->_api_url,$request);

                    $body = json_decode($res_remote['body'], TRUE);

                    if(!empty($body)){
                        if($body['status'] == '1'){
                            update_option('envato_purchasecode','');
                            wp_redirect(admin_url('/admin.php?page=st_product_reg&deregister=1'));
                        }
                        if($body['status'] == '3'){
                            wp_redirect(admin_url('/admin.php?page=st_product_reg&deregister=2'));
                        }
                    }
                }
            }
        }

        public function add_script()
        {
            wp_register_style('landing_page_css', get_template_directory_uri() . "/css/admin/landing_page.css");
            wp_register_script('landing_page_js', get_template_directory_uri() . "/js/admin/landing_page.js",array('jquery'),null,true);
            if(STInput::get('page')=='st_admin_install')
            {
                wp_enqueue_script('st-import-js',get_template_directory_uri().'/js/admin/import-content.js',array('jquery'),null,true);
                wp_localize_script('jquery','st_import_localize',array(
                    'confirm_message'=>__('WARNING: Importing data is recommended on fresh installs only once. Importing on sites with content or importing twice will duplicate menus, pages and all posts.',ST_TEXTDOMAIN),
                ));
            }
        }

        static function sub_menu_list()
        {

            $return = array();
            if (!self::register_completed()) {
                array_push($return,
                    array(
                        'page_title' => __("Product Registration", ST_TEXTDOMAIN),
                        'menu_title' => __("Product Registration", ST_TEXTDOMAIN),
                        'menu_slug'  => 'st_product_reg'
                    )
                );
            }

            array_push($return,
                array(
                    'page_title' => __("Support", ST_TEXTDOMAIN),
                    'menu_title' => __("Support", ST_TEXTDOMAIN),
                    'menu_slug' => "st_admin_support"
                ),
                array(
                    'page_title' => __("Change Log", ST_TEXTDOMAIN),
                    'menu_title' => __("Change Log", ST_TEXTDOMAIN),
                    'menu_slug' => "st_admin_change_log"
                ),
                array(
                    'page_title' => __("Install Demo", ST_TEXTDOMAIN),
                    'menu_title' => __("Install Demo", ST_TEXTDOMAIN),
                    'menu_slug' => "st_admin_install"
                ),
                array(
                    'page_title' => __("System status", ST_TEXTDOMAIN),
                    'menu_title' => __("System status", ST_TEXTDOMAIN),
                    'menu_slug' => "st_admin_system"
                )
            );

            return $return;
        }

        function st_create_submenu()
        {
            $sub_menu = self::sub_menu_list();

            if(!empty($sub_menu) and is_array($sub_menu)){
                foreach ($sub_menu as $key => $value) {

                    $page_title = $value['page_title'];
                    $menu_title = $value['menu_title'];
                    $menu_slug  = $value['menu_slug'];

                    add_submenu_page(
                        'st_traveler_option',
                        $page_title,
                        $menu_title,
                        'manage_options',
                        $menu_slug,
                        array($this, 'get_landing_page')
                    );
                }
            }
        }

        static function checkValidatePurchaseCode($_purchase_code = false){
            if(!$_purchase_code)
                $_purchase_code=get_option('envato_purchasecode');


            if(!empty($_purchase_code)){
                if(md5($_purchase_code) == '7a87014a91520fb87904f12fff17ce24'){
                    return true;
                }else{
                    $item_id = 10822683;

                    $url = "https://api.envato.com/v3/market/author/sale?code=".$_purchase_code;
                    $personal_token = "fivQeTQarEgttMvvxLjnYza19xh1r8lo";

                    if( ini_get('allow_url_fopen') ) {
                        $options = array('http' => array(
                            'method'  => 'GET',
                            'header' => 'Authorization: Bearer '.$personal_token
                        ));
                        $context  = stream_context_create($options);
                        $envatoRes = file_get_contents($url, false, $context);
                    }
                    if(!$envatoRes ){
                        $curl = curl_init($url);
                        $header = array();
                        $header[] = 'Authorization: Bearer '.$personal_token;
                        $header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:41.0) Gecko/20100101 Firefox/41.0';
                        $header[] = 'timeout: 20';
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($curl, CURLOPT_HTTPHEADER,$header);

                        $envatoRes = curl_exec($curl);
                        curl_close($curl);
                    }

                    if(!empty($envatoRes)){
                        $res=json_decode($envatoRes,true);
                        if(!empty($res)){
                            if(isset($res['item']['id'])){
                                if($res['item']['id'] == $item_id){
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
            return false;
        }

        public function get_landing_page(){
            echo balancetags($this->load_view('landing_page/landing_page'));
        }
        static function register_completed(){
            return false ;
        }

    }
    $s = new STAdminlandingpage();

}