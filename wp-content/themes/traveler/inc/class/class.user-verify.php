<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/21/2018
 * Time: 9:50 AM
 */

class ST_User_Verify
{
    protected static $_inst;


    public function __construct()
    {
        add_action('wp_ajax_st_user_add_photo',[$this,'__uploadPhoto']);
        add_action('init',[$this,'__handleUserSubmit']);
    }

    public function __handleUserSubmit()
    {
        if(!empty($_POST['st_user_verify_nonce']) and wp_verify_nonce($_POST['st_user_verify_nonce'],'st_user_submit_verify')) {
            $validator = new STValidate();
            $validator->set_rules('_user_email', esc_html__('Email', ST_TEXTDOMAIN), 'required|valid_email|max_length[255]');
            $validator->set_rules('_st_phone', esc_html__('Phone Number', ST_TEXTDOMAIN), 'required|max_length[255]');
            $validator->set_rules('_passport_name', esc_html__('Passport Name', ST_TEXTDOMAIN), 'required|max_length[255]');
            $validator->set_rules('_passport_id', esc_html__('Passport ID', ST_TEXTDOMAIN), 'required|max_length[255]');
            $validator->set_rules('_passport_birthday', esc_html__('Passport Birthday', ST_TEXTDOMAIN), 'required|max_length[255]');
            $validator->set_rules('_passport_photos', esc_html__('Passport Photos', ST_TEXTDOMAIN), 'required|max_length[1000]');

            if (st_user_has_partner_features()) {
                $validator->set_rules('_business_c_name', esc_html__('Company Name', ST_TEXTDOMAIN), 'required|max_length[255]');
                $validator->set_rules('_business_c_email', esc_html__('Company Email', ST_TEXTDOMAIN), 'required|valid_email|max_length[255]');
                $validator->set_rules('_business_c_address', esc_html__('Company Address', ST_TEXTDOMAIN), 'required|max_length[255]');
                $validator->set_rules('_business_c_phone', esc_html__('Company Phone', ST_TEXTDOMAIN), 'required|max_length[255]');
                $validator->set_rules('_business_r_name', esc_html__('Representative Name', ST_TEXTDOMAIN), 'required|max_length[255]');
                $validator->set_rules('_business_r_position', esc_html__('Representative Position', ST_TEXTDOMAIN), 'required|max_length[255]');
                $validator->set_rules('_business_r_passport_id', esc_html__('Representative Passport ID', ST_TEXTDOMAIN), 'required|max_length[255]');
                $validator->set_rules('_business_r_issue_date', esc_html__('Representative Issue Date', ST_TEXTDOMAIN), 'required|max_length[255]');
            }

            do_action('st_before_user_verify_validate',$validator,$this);

            $validate = $validator->run()?true:new WP_Error($validator->error_string());

            $validate = apply_filters('st_user_verify_validate',$validate,$this,$validator);

            if(is_wp_error($validate) or !$validate){
                $_COOKIE['st_errors'] = $validate;
                return;
            }

            $userData=[];
            $userMeta=[];

            // Check if user has been verify, so we only update new files
            // Check Email
            if(!st_check_user_verify('email'))
            {
                $userData['user_email']= STInput::post('_user_email');
            }
            if(!st_check_user_verify('phone'))
            {
                $userMeta['st_phone']= STInput::post('_st_phone');
            }
            if(!st_check_user_verify('passport'))
            {
                $userMeta['passport_name']= STInput::post('_passport_name');
                $userMeta['passport_id']= STInput::post('_passport_id');
                $userMeta['passport_birthday']= STInput::post('_passport_birthday');
                $userMeta['passport_photos']= STInput::post('_passport_photos');
            }
            if(!st_check_user_verify('travel_certificate'))
            {
                $userMeta['business_c_name']= STInput::post('_business_c_name');
                $userMeta['business_c_email']= STInput::post('_business_c_email');
                $userMeta['business_c_address']= STInput::post('_business_c_address');
                $userMeta['business_c_phone']= STInput::post('_business_c_phone');
                $userMeta['business_r_name']= STInput::post('_business_r_name');
                $userMeta['business_r_position']= STInput::post('_business_r_position');
                $userMeta['business_r_passport_id']= STInput::post('_business_r_passport_id');
                $userMeta['business_r_issue_date']= STInput::post('_business_r_issue_date');
                $userMeta['business_photos']= STInput::post('_business_photos');

            }
            if(!st_check_user_verify('social'))
            {
                $userMeta['social_facebook_uid']= STInput::post('_social_facebook_uid');
                $userMeta['social_facebook_name']= STInput::post('_social_facebook_name');

            }


            $checkUpdate = true;

            if(!empty($userData))
            {
                $userData['ID'] = get_current_user_id();
                $res = wp_update_user($userData);
                if(is_wp_error($res))
                {
                    $_COOKIE['st_errors'] = $res;
                    return;
                }

            }

            if(!empty($userMeta))
            {
                foreach ($userMeta as $meta =>$val)
                {
                    update_user_meta(get_current_user_id(),$meta,$val);
                }
            }

            if($checkUpdate)
            {
                $_COOKIE['st_success'] = esc_html__('Update user verification information successfully',ST_TEXTDOMAIN);
                return;
            }
        }
    }

    protected function reArrayFiles(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }
    public function __uploadPhoto()
    {
        add_filter('upload_dir',[$this,'__changeUserUploadDir']);
        add_filter( 'wp_handle_upload_prefilter', [$this,'__validateFileSize'] );

        // Validate Security
        if(empty($_POST['_s']) or !wp_verify_nonce($_POST['_s'],'st_frontend_security')) $this->sendError(esc_html__('Session has ended. Please reload website',ST_TEXTDOMAIN));

        if(empty($_FILES['image'])) $this->sendError(esc_html__('Please select files',ST_TEXTDOMAIN));

        $rows = [];
        $errors = [];

        $files = $this->reArrayFiles($_FILES['image']);


        foreach ($files as $uploadedfile)
        {
            $upload_overrides = array( 'test_form' => false,
                'test_type'=>true,
                'mimes'=>[
                    'jpg|jpeg|jpe' => 'image/jpeg',
                    'gif' => 'image/gif',
                    'png' => 'image/png',
                    'bmp' => 'image/bmp'
                ]
            );

            $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

            if ( $movefile && ! isset( $movefile['error'] ) ) {

                $rows[] = $movefile;
            } else {

                $errors[]= $movefile['error'];
            }
        }

        wp_send_json([
            'status'=>1,
            'rows'=>$rows,
            'message'=>implode("<br>",$errors)
        ]);

        die;
    }

    public function __validateFileSize($file ) {

        $limit = 5000000; // 5mb in bytes
        if ( $file['size'] > $limit ) {
            $file['error'] = __( 'Maximum file size is 5mb', ST_TEXTDOMAIN );
        }

        return $file;
    }

    public function sendError($message)
    {
        wp_send_json([
            'status'=>0,
            'message'=>$message
        ]);
        die;
    }

    public function __changeUserUploadDir($param)
    {
        $mydir = '/uploads/users/'.get_current_user_id().'/verify';

        $param['path'] = WP_CONTENT_DIR. $mydir;
        $param['url'] = content_url($mydir);

        return $param;
    }



    public static function inst()
    {
        if ( !self::$_inst ) {
            self::$_inst = new self();
        }

        return self::$_inst;
    }
}

ST_User_Verify::inst();