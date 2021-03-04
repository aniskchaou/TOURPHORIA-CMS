<?php
/**
 * Created by wpbooking
 * Developer: nasanji
 * Date: 12/20/2016
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if(!class_exists('WB_Form_Builder_Controller')){
    class WB_Form_Builder_Controller{
        static $_inst;
        private $groups = array();

        public function __construct(){

            $loader = WB_Form_Builder_Loader::init();
            $loader->load_lib(array(
                'class_fields/base',
                'class_fields/text',
                'class_fields/email',
                'class_fields/checkbox',
                'class_fields/radio',
                'class_fields/textarea',
                'class_fields/number',
                'class_fields/dropdown',
                'class_fields/first_name',
                'class_fields/last_name',
                'class_fields/user_email',
                'class_fields/telephone',
                'class_fields/address',
                'class_fields/postcode_zip',
                'class_fields/apt_unit',
                'class_fields/country_dropdown',
                'class_fields/post_select',
                // 'class_fields/taxonomy_select',
                'class_fields/image_upload',
            ));
            /**
             * Register post type
             *
             * @since 1.0
             */
            add_action('admin_init', array($this, '_register_form_builder_post_type'));

            /**
             * Manage form
             *
             * @since 1.0
             */
            add_action('wb_form_builder_after_title', array($this, '_manage_form'));

            /**
             * Get content form builder
             *
             * @since 1.0
             */
            add_action('wb_form_builder_content_form', array($this, '_fields_control'), 15);

            add_action('admin_footer',array($this,'_add_js_tmpl'));

            /**
             * Get content form builder
             *
             * @since 1.0
             */
            add_action('wb_form_builder_content_form', array($this, '_content_form_builder'), 15);

            /**
             * Save data
             *
             * @since 1.0
             */
            add_action('admin_init', array($this, '_save_data'));
        }

        /**
         * Register fields
         *
         * @since 1.0
         *
         * @param $id
         * @param $group
         * @param $object
         */
        function register_fields($id, $group, $object)
        {
            $this->groups[$group][$id] = $object;
        }

        /**
         * Register form builder post type
         *
         * @since 1.0
         */
        function _register_form_builder_post_type() {

            $wb_form_builder_demo = get_option('wb_form_builder_demo', 0);

            if(empty($wb_form_builder_demo)){

                $data_items = array(
                    array(
                        'field_type' => 'first_name',
                        'title' => esc_html__('First name', ST_TEXTDOMAIN),
                        'name' => 'st_first_name',
                        'required' => '1',
                        'placeholder' => esc_html__('First name', ST_TEXTDOMAIN),
                        'desc' => '',
                        'extra_class' => 'col-6',
                        'custom_id' => '',
                        'validate' => 'required|trim|strip_tags',
                    ),
                    array(
                        'field_type' => 'last_name',
                        'title' => esc_html__('Last name', ST_TEXTDOMAIN),
                        'name' => 'st_last_name',
                        'required' => '1',
                        'placeholder' => esc_html__('Last name', ST_TEXTDOMAIN),
                        'desc' => '',
                        'extra_class' => 'col-6',
                        'custom_id' => '',
                        'validate'    => 'required|trim|strip_tags',
                    ),
                    array(
                        'field_type' => 'user_email',
                        'title' => esc_html__('Email', ST_TEXTDOMAIN),
                        'name' => 'st_email',
                        'required' => '1',
                        'placeholder' => esc_html__('Email', ST_TEXTDOMAIN),
                        'desc' => '',
                        'extra_class' => 'col-6',
                        'custom_id' => '',
                        'validate'    => 'required|trim|strip_tags|valid_email',
                    ),
                    array(
                        'field_type' => 'telephone',
                        'title' => esc_html__('Phone number', ST_TEXTDOMAIN),
                        'name' => 'st_phone',
                        'required' => '1',
                        'placeholder' => esc_html__('Phone', ST_TEXTDOMAIN),
                        'desc' => '',
                        'extra_class' => 'col-6',
                        'custom_id' => '',
                        'validate'    => 'required|trim|strip_tags',
                    ),
                    array(
                        'field_type' => 'address',
                        'title' => esc_html__('Address', ST_TEXTDOMAIN),
                        'name' => 'st_address',
                        'required' => '1',
                        'placeholder' => esc_html__('Address', ST_TEXTDOMAIN),
                        'desc' => '',
                        'extra_class' => '',
                        'custom_id' => '',
                    ),
                    array(
                        'field_type' => 'postcode_zip',
                        'title' => esc_html__('Postcode/Zip', ST_TEXTDOMAIN),
                        'name' => 'st_zip_code',
                        'required' => '',
                        'placeholder' => esc_html__('Postcode/Zip', ST_TEXTDOMAIN),
                        'desc' => '',
                        'extra_class' => 'col-6',
                        'custom_id' => '',
                    ),
                    array(
                        'field_type' => 'apt_unit',
                        'title' => esc_html__('Apt/Unit', ST_TEXTDOMAIN),
                        'name' => 'st_apt_unit',
                        'required' => '',
                        'placeholder' => esc_html__('Apt/Unit', ST_TEXTDOMAIN),
                        'desc' => '',
                        'extra_class' => 'col-6',
                        'custom_id' => '',
                    ),
                    array(
                        'field_type' => 'textarea',
                        'title' => esc_html__('Special Request', ST_TEXTDOMAIN),
                        'name' => 'st_note',
                        'required' => '',
                        'placeholder' => esc_html__('Notes about your order, e.g. special notes for  delivery.', ST_TEXTDOMAIN),
                        'desc' => '',
                        'extra_class' => '',
                        'custom_id' => '',
                    )
                );

                $data_types = array('first_name', 'last_name', 'user_email', 'telephone', 'address', 'postcode_zip', 'apt_unit', 'textarea');

                $id = ST_Form_Builder_Models::inst()->insert_data(
                    array(
                        'name' => esc_html__('Form 1', ST_TEXTDOMAIN),
                        'meta' => serialize($data_items),
                        'status' => 'publish',
                        'data_type' => serialize($data_types),
                    )
                );

                update_option('wb_form_builder_demo', 1);
            }
        }

        /**
         * Manage form
         *
         * @since 1.0
         * @param $form_id
         */
        function _manage_form($form_id){
            echo wb_form_builder_load_view('admin/form-content/manage_form', array('form_id' => $form_id));
        }

        /**
         * Html fields control
         *
         * @since 1.0
         * @param $form_id
         */
        function _fields_control($form_id){
            echo wb_form_builder_load_view('admin/form-content/fields_control', array('form_id' => $form_id));
        }

        /**
         * Get content form
         *
         * @return WB_Form_Builder_Controller
         * @param $form_id
         */
        function _content_form_builder($form_id){
            if(WB_Form_Builder_Input::get('action') == 'create_new' || !$form_id){
                echo wb_form_builder_load_view('admin/form-content/create_new', array('form_id' => $form_id));
            }else{
                echo wb_form_builder_load_view('admin/form-content/edit', array('form_id' => $form_id));
            }
        }

        /**
         * Save data
         *
         * @since 1.0
         *
         * @return WB_Form_Builder_Controller
         */
        function _save_data(){
            //Create new form
            if(WB_Form_Builder_Input::post('create_form') && wp_verify_nonce(WB_Form_Builder_Input::request('create-new-form'), 'wb-form-builder-create-new')){
                $form_name = WB_Form_Builder_Input::post('form-name');
                $this->create_new_form($form_name);
            }

            //Delete form
            if(WB_Form_Builder_Input::get('action') == 'delete' && wp_verify_nonce(WB_Form_Builder_Input::request('_wpnonce'),'wb-delete-field-form') && $form_id = WB_Form_Builder_Input::get('form')){
                $this->delete_form($form_id);
            }

            //Save data
            if(WB_Form_Builder_Input::post('action') == 'edit' && wp_verify_nonce(WB_Form_Builder_Input::request('wb_form_nonce'),'wb_update_form_builder') && WB_Form_Builder_Input::post('save_form')){
                $this->update_form();
            }

            //Duplicate Form
            if(WB_Form_Builder_Input::get('action') == 'duplicate' && wp_verify_nonce(WB_Form_Builder_Input::request('_wpnonce'),'wb-duplicate-form') && $form_id = WB_Form_Builder_Input::get('form')){
                $this->duplicate_form($form_id);
            }
        }

        /**
         * Update form data
         *
         * @since 1.0
         */
        function update_form(){
            $form_id = WB_Form_Builder_Input::post('form_id', 0);

            $form_data = ST_Form_Builder_Models::inst()->get_data($form_id);
            if(!empty($form_data)){

                $is_validated = true;
                apply_filters('wb_form_builder_validate_update_form', $is_validated);

                if($is_validated) {

                    $use_form = get_option('wb_form_use_for_checkout','');
                    if(WB_Form_Builder_Input::post('use_form_checkout') == 1){
                        update_option('wb_form_use_for_checkout', $form_id);
                    }else{
                        if($use_form == $form_id){
                            update_option('wb_form_use_for_checkout', '');
                        }
                    }
                    $item_data = WB_Form_Builder_Input::post('item_data');
                    //save for dropdown
                    $new_data = array();
                    if(!empty($item_data) && is_array($item_data) && count($item_data) > 0) {
                        foreach($item_data as $key => $value){
                            $new_data[$key] = $value;
                            if (!empty($value['option_value'])) {
                                if (count($value['option_value']['op_key']) == count($value['option_value']['op_value'])) {
                                    $arr = array();
                                    $i = 0;
                                    foreach($value['option_value']['op_key'] as $k => $v){
                                        if(empty($v)){
                                            $v = $i;
                                            $i++;
                                        }
                                        $arr[$k] = $v;
                                    }
                                    $cb = array_combine($arr, $value['option_value']['op_value']);
                                    $new_data[$key]['option_value'] = $cb;
                                }
                            }
                        }

                    }
                    $item_data = $new_data;
                    $field_type = WB_Form_Builder_Input::post('field_type');
                    $data = array();
                    $data_type = array();

                    if(!empty($field_type) && is_array($field_type)){
                        foreach($field_type as $key => $value){
                            $data[] = $item_data[$key];
                            $data_type[] = $value;
                        }
                    }
                    $name = $form_data['name'];
                    $name = WB_Form_Builder_Input::post('form-name', $name);
                    $data_update = array(
                        'name' => $name,
                        'meta' => serialize($data),
                        'data_type' => serialize($data_type),
                        );


                    ST_Form_Builder_Models::inst()->update_data($data_update, array('id' => $form_id));
                    
                    wb_set_admin_message(esc_html__('Form have been updated.',ST_TEXTDOMAIN),'success');
                    WB_Form_Builder::inst()->set('update', 'success');
                    
                }
            }
        }

        /**
         * Create new form
         *
         * @since 1.0
         * @param $form_name
         * @return int
         */
        function create_new_form($form_name){

            $form_id = ST_Form_Builder_Models::inst()->create_form($form_name);
            
            if(!empty($form_id)){
                $url = add_query_arg(array(
                    'page' => 'wb_page_form_builder',
                    'form' => $form_id
                ),admin_url('admin.php'));
                wp_redirect($url);
            }else{
                wb_set_admin_message(esc_html__('There is an error in the process of creating a new form',ST_TEXTDOMAIN),'error');
                $url = add_query_arg(array(
                    'page' => 'wb_page_form_builder',
                    'action' => 'create_new',
                    'form' => 'error'
                ),admin_url('admin.php'));
                wp_redirect($url);
            }
            return $form_id;
        }

        /**
         * Delete form
         *
         * @since 1.0
         * @return WB_Form_Builder_Controller
         * @param $form_id
         */
        function delete_form($form_id){

            ST_Form_Builder_Models::inst()->delete_form($form_id);
            
            $id = ST_Form_Builder_Models::inst()->get_first_form_id();
            
            $use_form_id = wb_use_for_checkout();

            if($form_id == $use_form_id){
                update_option('wb_form_use_for_checkout','');
            }else if(!empty($use_form_id)){
                $id = $use_form_id;
            }
            wb_set_admin_message(esc_html__('The form has been successfully deleted.', ST_TEXTDOMAIN), 'success');
            WB_FB_Session::set('delete','success');
            if(!empty($id)){
                $url = add_query_arg(array(
                    'page' => 'wb_page_form_builder',
                    'form' => $id
                ), admin_url('admin.php'));
            }else{
                $url = add_query_arg(array(
                    'page' => 'wb_page_form_builder',
                    'action' => 'create_new'
                ), admin_url('admin.php'));
            }
            wp_redirect($url);
        }

        /**
         * Duplicate form
         *
         * @since 1.0
         * @param $form_id
         */
        function duplicate_form($form_id){
        
            $form_data = ST_Form_Builder_Models::inst()->get_data($form_id);
            $duplicate = false;
            if(!empty($form_data)){
                $data = array(
                    'name' => $form_data['name'].esc_html__(' (copy)',ST_TEXTDOMAIN),
                    'meta' => $form_data['meta'],
                    'data_type' => $form_data['data_type'],
                    'status' => $form_data['status'],
                    );
                $id = ST_Form_Builder_Models::inst()->insert_data($data);
                if(!empty($id)){
                    $url = add_query_arg(array(
                        'page' => 'wb_page_form_builder',
                        'form' => $id
                    ),admin_url('admin.php'));
                    wb_set_admin_message(esc_html__('Duplicated successfully.', ST_TEXTDOMAIN), 'success');
                    WB_FB_Session::set('duplicate','success');
                    wp_redirect($url);
                    $duplicate = true;
                }
            }
            if(!$duplicate){
                wb_set_admin_message(esc_html__('There is an error in the process of duplicating form',ST_TEXTDOMAIN),'error');
                $url = add_query_arg(array(
                    'page' => 'wb_page_form_builder',
                    'action' => 'duplicate',
                    'form' => 'error'
                ),admin_url('admin.php'));
                wp_redirect($url);
            }
        }

        /**
         * Get all fields
         *
         * @since 1.0
         *
         * @return mixed|void
         */
        function get_fields(){
            $groups = $this->groups;
            $fields = array();
            if(!empty($groups) && is_array($groups)){
                foreach($groups as $group){
                    $fields = array_merge($fields, $group);
                }
            }
            return apply_filters('wb_form_builder_fields', $fields);
        }

        /**
         * Get field data by field_id
         *
         * @since 1.0
         *
         * @param $field_id
         * @return bool
         */
        function get_field($field_id){
            $fields = $this->get_fields();

            if ($fields and isset($fields[$field_id])){
                return $fields[$field_id];
            }else{
                return false;
            }
        }

        /**
         * Get group field
         *
         * @since 1.0
         *
         * @return array
         */
        function get_group(){
            return $this->groups;
        }

        /**
         * Fields template js
         *
         * @since 1.0
         */
        function _add_js_tmpl(){
            $fields = $this->get_fields();
            if(!empty($fields)){
                foreach($fields as $key => $field){
                    ?>
                    <script type="text/html" id="tmpl-wb-form-item-<?php echo esc_attr($key)?>">
                        <?php
                        $html = '<li class="wb-form-item menu-item menu-item-edit-inactive">
                                <div class="menu-item-bar">
                                <input type="hidden" name="field_type[{{data.index}}]" value="'.$key.'">
                                <input type="hidden" name="item_data[{{data.index}}][field_type]" value="'.$key.'">
                                    <div class="menu-item-handle form-item-handle ui-sortable-handle">
                                        <span class="item-title">
                                            <span class="form-item-title"></span>
                                            <span class="error-message fb_hidden"></span>
                                        </span>
                                        <span class="item-controls">
                                            <span class="item-type">'.$field->get_info('title').'</span>
                                            <a class="item-edit" title="'.esc_html__('Setting',ST_TEXTDOMAIN).'" href="#"></a>
                                            <a class="wb-item-delete item-delete" title="'.esc_html__('Delete',ST_TEXTDOMAIN).'" href="#"><i class="dashicons dashicons-no"></i></a>
                                        </span>
                                    </div>
                                </div>
                                <div class="menu-item-settings wp-clearfix">';
                        $field_settings = $field->get_field_settings();
                        if(!empty($field_settings) && is_array($field_settings)){
                            foreach($field_settings as $k => $v){
                                $html .= wb_form_builder_field_setting($v);
                            }
                            $html .= '<div class="menu-item-actions description-wide submitbox">
                                        <a class="item-delete submitdelete deletion" href="#">'.esc_html__('Remove',ST_TEXTDOMAIN).'</a>
                                        <span class="meta-sep hide-if-no-js"> | </span>
                                        <a class="item-cancel submitcancel hide-if-no-js" href="#">'.esc_html__('Cancel',ST_TEXTDOMAIN).'</a>
                                    </div>';
                            $html .= '</div>';
                        }
                        $html .= '</li>';
                        echo do_shortcode($html);
                        ?>
                    </script>
                    <?php
                }
            }

        }

        static function inst(){
            if(!self::$_inst) self::$_inst = new self();

            return self::$_inst;
        }
    }

    WB_Form_Builder_Controller::inst();
}