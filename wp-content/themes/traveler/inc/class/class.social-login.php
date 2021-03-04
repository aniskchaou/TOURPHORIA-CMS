<?php
/**
 * Created by PhpStorm.
 * User: dunglinh
 * Date: 9/12/18
 * Time: 14:41
 */

class ST_Social_Login
{
    protected static $_inst;

    public function __construct()
    {
        add_action('wp_ajax_traveler.socialLogin',[$this,'__socialLogin']);
        add_action('wp_ajax_nopriv_traveler.socialLogin',[$this,'__socialLogin']);

        add_action('wp_enqueue_scripts',[$this,'__enqueueScripts']);

        add_action('init',[$this,'__addSocialEndpoint']);
        add_action('template_redirect',[$this,'__handleSocialEndpoint']);

        add_filter( 'query_vars', [$this,'query_vars'] );
    }


    function query_vars( $vars )
    {
        array_push($vars, 'social-login');
        return $vars;
    }

    public function __addSocialEndpoint()
    {
        add_rewrite_endpoint('social-login', EP_ALL);

    }

    public function __handleSocialEndpoint()
    {

        // Check Login Handler
        $path = get_query_var('social-login');

        if($path)
        {
            $path = explode('/',$path);
            $channel = $path[0];
            $action = isset($path[1])?$path[1]:'login';

            switch ($action)
            {
                case "callback":

                    switch ($channel)
                    {
                        case "twitter":

                            $this->twitterLoginCallBack();
                            break;
                    }
                    break;
                case "login":
                    switch ($channel)
                    {
                        case "twitter":
                            $this->twitterLogin();
                            break;
                    }
                default:
            }

        }
    }


    public function channelStatus($channel = 'facebook')
    {
        switch ($channel){
            case "google":
                if(st()->get_option('social_gg_login','off')!='on') return false;
                if(!st()->get_option('social_gg_client_id') or !st()->get_option('social_gg_client_secret')) return false;
                break;

            case "twitter":
                if(st()->get_option('social_tw_login','off')!='on') return false;
                if(!st()->get_option('social_tw_client_id') or !st()->get_option('social_tw_client_secret')) return false;
                break;


            case "facebook":
            default:
                if(st()->get_option('social_fb_login','off')!='on') return false;
                if(!st()->get_option('social_fb_app_id')) return false;
                break;


        }

        return true;
    }

    public function __enqueueScripts()
    {
        $st_social_params = [];
        if($this->channelStatus('google'))
        {
            wp_enqueue_script('google-api','https://apis.google.com/js/api:client.js');
            $st_social_params['google_client_id'] = st()->get_option('social_gg_client_id');
        }

        if(!empty($st_social_params))
        {
            wp_localize_script('jquery','st_social_params',$st_social_params);
        }
    }

    public function __socialLogin()
    {
        $this->verifyRequest();

        if(is_user_logged_in()) {
            $this->sendJson(['reload'=>1]);
        }

        $channel = STInput::post('channel');

        if(empty($channel)) $this->sendError(esc_html__('Channel is missing','traveler'));

        switch ($channel){
            case "facebook":
                $this->handleFacebookLogin();
                break;
            case "google":
                $this->handleGoogleLogin();
                break;

        }

    }


    public function twitterLoginCallBack()
    {
        if(class_exists("Abraham\TwitterOAuth\TwitterOAuth"))
        {
            if(empty($_GET['oauth_verifier'])){
                echo esc_html__("Author Verifier ID is missing",'traveler');
                die;
            }

            $connection = new Abraham\TwitterOAuth\TwitterOAuth(
                st_traveler_get_option('social_tw_client_id'),
                st_traveler_get_option('social_tw_client_secret'),
                $_SESSION['oauth_token'],
                $_SESSION['oauth_token_secret']
                );


            try{

                $access_token = $connection->oauth("oauth/access_token",['oauth_verifier'=>$_GET['oauth_verifier']]);

                if(!empty($access_token['oauth_token']))
                {
                    $handler = $this->handleTwitterAccount($access_token['user_id'],$access_token['screen_name']);

                    if(is_wp_error($handler)) echo $handler->get_error_message();
                    else{
                        //for window.open, reload parent
                        ?>
                        <script>
                            window.opener.location.reload();
                            window.close();
                        </script>
                        <?php
                    }
                }


            }catch (Exception $exception)
            {
                echo $exception->getMessage();die;
            }


            die;

        }
    }

    public function twitterLogin()
    {
        if(class_exists("Abraham\TwitterOAuth\TwitterOAuth"))
        {


            $connection = new Abraham\TwitterOAuth\TwitterOAuth(st_traveler_get_option('social_tw_client_id'), st_traveler_get_option('social_tw_client_secret'));

            $request_token = $connection->oauth("oauth/request_token",['oauth_callback'=>site_url().'/social-login/twitter/callback']);


            if(empty($request_token['oauth_token'])) {
                echo "Can not connect to twitter";die;
            }

            $_SESSION['oauth_token'] = $request_token['oauth_token'];
            $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];


            $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

            wp_redirect($url);
            echo esc_html__("Redirecting you to twitter. Please wait",'traveler');

            die;

        }

    }


    protected function handleTwitterAccount($oauth_uid,$display_name)
    {
        /**
         * @todo Kiểm tra xem OAuth ID đã đăng ký chưa, nếu rồi thì đăng nhập luôn
         *
         */
        $register_user = false;

        global $wpdb;

        $find_user = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->usermeta} where meta_key = '_twitter_uid' and meta_value = %s",$oauth_uid));
        if($find_user)
        {
            /**
             * @todo OAuth UID tồn tại, kiểm tra xem User đã tồn tại chưa
             */
            $user = new WP_User($find_user->user_id);
            if(!empty($user->ID))
            {
                /**
                 * @todo Login bằng UID
                 */
                return $this->loginByUserID($user->ID,$user->user_login, $user);


            }else{
                /**
                 * @todo trường hợp không tìm thấy User, xóa meta key cũ và đăng ký user mới
                 */
                $register_user = true;
                $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->usermeta} where umeta_id = %d",$find_user->umeta_id));

            }
        }else{

            /**
             * @todo Không tìm thấy meta key -> Tạo user
             */
            $register_user = true;
        }


        if($register_user)
        {

            // Note: Twitter do not provide their user's email address and by default a random email will then be generated for them instead.
            $user_email = $oauth_uid.'@twitter.com';
            $user_id = $this->createOauthAccount('twitter',$user_email,$oauth_uid,$display_name);

            if(is_wp_error($user_id)) return $user_id;

            $this->loginByUserID($user_id,'twitter_'.$oauth_uid);

            return true;

        }
    }


    protected function handleFacebookLogin()
    {
        $access_token = STInput::post('access_token');

        if(!$access_token) $this->sendError(esc_html__('Access Token is missing','traveler'));


        $baseFacebooAPI = 'https://graph.facebook.com/v3.1/';

        $response = wp_remote_get(add_query_arg(['fields'=>'id,name,email','access_token'=>$access_token],$baseFacebooAPI.'me'));

        if(is_wp_error($response))
        {
            $this->sendError(esc_html__('Can not connect to Facebook. Please try again later','traveler'));
        }

        $body = wp_remote_retrieve_body($response);

        $json = json_decode($body,true);

        if(empty($json)) $this->sendError(esc_html__('Can not read Facebook response. Please try again later','traveler'));

        if(!empty($json['error'])) $this->sendError(esc_html__("Facebook Error: ",'traveler').$json['error']['message']);

        /**
         * @todo Kiểm tra khách có cấp quyền lấy email chưa
         */
        if(empty($json['email'])) $this->sendError(esc_html__("Facebook Error: You must allow us read your email address ",'traveler'));

        /**
         * @todo Kiểm tra xem FB ID đã đăng ký chưa, nếu rồi thì đăng nhập luôn
         *
         */
        $fb_uid = $json['id'];
        $register_user = false;

        global $wpdb;

        $find_user = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->usermeta} where meta_key = '_facebook_uid' and meta_value = %s",$fb_uid));
        if($find_user)
        {
            /**
             * @todo FB UID tồn tại, kiểm tra xem User đã tồn tại chưa
             */
            $user = new WP_User($find_user->user_id);
            if(!empty($user->ID))
            {
                /**
                 * @todo Login bằng UID
                 */
                $this->loginByUserID($user->ID,$user->user_login, $user);
                $this->sendJson(['reload'=>1]);

            }else{
                /**
                 * @todo trường hợp không tìm thấy User, xóa meta key cũ và đăng ký user mới
                 */
                $register_user = true;
                $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->usermeta} where umeta_id = %d",$find_user->umeta_id));

            }
        }else{

            /**
             * @todo Không tìm thấy meta key -> Tạo user
             */
            $register_user = true;
        }

        if($register_user)
        {
            $user_id = $this->createOauthAccount('facebook',$json['email'],$json['id'],$json['name']);

            if(is_wp_error($user_id))
            {
                $this->sendError(esc_html__('Error: ','traveler').$user_id->get_error_message());
            }

            $this->loginByUserID($user_id,'facebook_'.$json['id']);

            $this->sendJson(['reload'=>1]);
        }
    }

    protected function handleGoogleLogin()
    {
        $authorizationCode = STInput::post('authorizationCode');

        if(!$authorizationCode) $this->sendError(esc_html__('Authorization Code is missing','traveler'));


        $access_token = $this->getGoogleAccessToken($authorizationCode);

        if(is_wp_error($access_token))
        {
            $this->sendError($access_token->get_error_message());
        }

        $json = $this->getGoogleUserData($access_token);

        if(is_wp_error($json)) $this->sendError($json->get_error_message());

        $user_email = isset($json['emails'][0]['value'])?$json['emails'][0]['value']:'';

        /**
         * @todo Kiểm tra khách có cấp quyền lấy email chưa
         */
        if(empty($user_email)) $this->sendError(esc_html__("Google Error: You must allow us read your email address ",'traveler'));


        /**
         * @todo Kiểm tra xem Google ID đã đăng ký chưa, nếu rồi thì đăng nhập luôn
         *
         */
        $oauth_uid = $json['id'];
        $register_user = false;

        global $wpdb;

        $find_user = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->usermeta} where meta_key = '_google_uid' and meta_value = %s",$oauth_uid));
        if($find_user)
        {
            /**
             * @todo Google UID tồn tại, kiểm tra xem User đã tồn tại chưa
             */
            $user = new WP_User($find_user->user_id);
            if(!empty($user->ID))
            {
                /**
                 * @todo Login bằng UID
                 */
                $this->loginByUserID($user->ID,$user->user_login, $user);
                $this->sendJson(['reload'=>1]);

            }else{
                /**
                 * @todo trường hợp không tìm thấy User, xóa meta key cũ và đăng ký user mới
                 */
                $register_user = true;
                $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->usermeta} where umeta_id = %d",$find_user->umeta_id));

            }
        }else{

            /**
             * @todo Không tìm thấy meta key -> Tạo user
             */
            $register_user = true;
        }


        if($register_user)
        {



            $user_id = $this->createOauthAccount('google',$user_email,$oauth_uid,$json['displayName']);

            if(is_wp_error($user_id))
            {
                $this->sendError(esc_html__('Error: ','traveler').$user_id->get_error_message());
            }

            $this->loginByUserID($user_id,'google_'.$json['id']);

            $this->sendJson(['reload'=>1]);


        }
    }


    /**
     * @todo Lấy thông tin google user từ access token
     *
     * @param $access_token
     * @return array|WP_Error
     */
    protected function getGoogleUserData($access_token)
    {

        $baseApiUrl = 'https://www.googleapis.com/plus/v1/';

        $response = wp_remote_get(add_query_arg([
            'access_token'=>$access_token,
        ],$baseApiUrl.'people/me'));

        if(is_wp_error($response)) return $response;

        $body = wp_remote_retrieve_body($response);

        $json = json_decode($body,true);

        if(!empty($json[0]['error']) and !empty($json[0]['error']['message'])) return new WP_Error('api_error',$json[0]['error']['message']);

        if(!empty($json['error_description'])) return new WP_Error('api_error',$json['error_description']);

        if(empty($json) or empty($json['id'])) return new WP_Error('api_error',esc_html__('Can not get user info','traveler'));

        return $json;
    }

    /**
     * @todo Lấy access token Google từ Authorization Code
     *
     * @param $authorizationCode
     * @return array|WP_Error
     */
    protected function getGoogleAccessToken($authorizationCode){
        $baseApiUrl = 'https://www.googleapis.com/oauth2/v4/';

        $response = wp_remote_post($baseApiUrl.'token',[
            'body'=>[
                'client_id'=>st_traveler_get_option('social_gg_client_id'),
                'client_secret'=>st_traveler_get_option('social_gg_client_secret'),
                'code'=>$authorizationCode,
                //'redirect_uri'=>site_url(),
                'redirect_uri'=>st_traveler_get_option('social_gg_client_redirect_uri', site_url()),
                'grant_type'=>'authorization_code'
            ]
        ]);
        if(is_wp_error($response)) return $response;

        $body = wp_remote_retrieve_body($response);

        $json = json_decode($body,true);

        if(!empty($json['error_description'])) return new WP_Error('api_error',$json['error_description']);

        if(empty($json) or empty($json['access_token'])) return new WP_Error('api_error',esc_html__('Can not get access token','traveler'));

        return $json['access_token'];
    }

    /**
     * @todo Đăng ký user bằng social channel, email và oauth_id
     *
     * @param $channel
     * @param $email
     * @param $oauth_id
     * @param $name
     *
     * @return boolean\int|WP_Error
     */
    protected function createOauthAccount($channel,$email, $oauth_id,$name = '')
    {
        $email_check = email_exists($email);

        if($email_check) return new WP_Error('api_error',esc_html__('Email exists','traveler'));

        $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );

        $user_id = wp_insert_user( [
            'display_name'=>$name,
            'user_login'=>$channel.'_'.$oauth_id,
            'user_email'=>$email,
            'user_pass'=>$random_password
        ] );

        if(!is_wp_error($user_id))
        {
            update_user_meta($user_id,'_'.$channel.'_uid',$oauth_id);
        }
        return $user_id;
    }

    /**
     * @todo Force đăng nhập bằng user id và user_login
     *
     * @param $uid
     * @param $user_login
     * @return boolean
     */
    protected function loginByUserID($uid,$user_login, $user = array())
    {
        wp_set_current_user( $uid,$user_login );
        wp_set_auth_cookie( $uid );
        if(!empty($user)){
            do_action( 'wp_login', $user_login, $user);
        }
        return true;
    }


    protected function verifyRequest($action_name = 'st_frontend_security')
    {

        if (!$this->verifyNonce('_s', $action_name)) {
            $res = esc_html__('Your session has ended. Please reload the website', 'traveler');
            $this->sendError($res,['error_code'=>'session']);
        }

        return true;
    }

    protected function verifyNonce($name = '_s', $action_name='')
    {
        if (!isset($_POST[$name]) or !wp_verify_nonce($_POST[$name], $action_name)) return false;
        return true;

    }


    public function sendError($message, $extra = [])
    {
        $res = [];
        $res['message'] = $message;
        $res['status'] = 0;
        if (!empty($extra) and is_array($extra)) {
            $res = array_merge($res, $extra);
        }
        $this->sendJson($res);
    }

    protected function sendJson($res = [])
    {
        $res = wp_parse_args($res, [
            'status' => 1
        ]);

        @header('Content-Type: application/json; charset=' . get_option('blog_charset'));

        echo (json_encode($res));die;
    }


    public static function inst()
    {
        if(!self::$_inst) self::$_inst = new self();
        return self::$_inst;
    }



}

ST_Social_Login::inst();