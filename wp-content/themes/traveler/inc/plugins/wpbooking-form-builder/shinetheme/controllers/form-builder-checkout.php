<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 12/28/2016
 * Version: 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if(!class_exists('WB_Form_Builder_Checkout_Controller')){
    class WB_Form_Builder_Checkout_Controller{
        static $_inst;

        function __construct()
        {

            /**
             * Enqueue script
             *
             */
            add_action('wp_enqueue_scripts', array($this, '_enqueue_scripts'));

            add_action('admin_enqueue_scripts', array($this, '_admin_enqueue_scripts'));
            /**
             * Add form fields
             *
             * @since 1.0
             */
            add_filter('st_booking_form_fields', array($this, 'custom_form_fields_billing'));

            /**
             * Add form billing html
             *
             * @since 1.0
             */
            add_filter('st_booking_form_billing', array($this, '_custom_form_billing_checkout'), 15);

            /**
             * Checkout info in email
             *
             * @since 1.0
             */
            add_filter('wpbooking_email_checkout_info_html', array($this, '_custom_email_checkout_info_html'), 10, 3);

            /**
             * Customer info in order admin
             *
             * @since 1.0
             */
            add_filter('wpbooking_admin_order_customer_html', array($this, '_custom_order_customer_html'), 10, 2);

            add_action('init' ,array($this, 'remove_action_form_billing'));

            add_action('st_booking_success', array($this, '_save_form_builder_for_order'));


            add_filter('st_order_success_custommer_billing', array($this , '_custom_customer_information_html'), 10, 2 );

            add_filter('st_customer_infomation_edit_order', array($this , '_customer_infomation_edit_order'), 15, 2 );

            add_filter( 'st_customer_info_booking_history', [$this, '_custom_customer_information_popup_html'], 15, 2);


        }

        /**
         * Enqueue scripts
         *
         * @since 1.0
         */
        function _enqueue_scripts(){
            //wp_enqueue_style('wb-form-builder', WB_Form_Builder::inst()->get_url('assets/css/form-builder.css'));
            //wp_enqueue_script('wb-form-builder-js', WB_Form_Builder::inst()->get_url('assets/js/form-builder.js'), array('jquery'), null, true);
        }

        function _admin_enqueue_scripts(){
            if(isset($_GET['page']) && ($_GET['page'] == 'st_tours_booking') ) {
                wp_enqueue_style('wb-form-builder-css2', WB_Form_Builder::inst()->get_url('assets/css/form-builder.css'));
                wp_enqueue_script('wb-form-builder-js2', WB_Form_Builder::inst()->get_url('assets/js/form-builder.js'), array('jquery'), null, true);
            }
        }

        /**
         * Remove old form billing when isset new form
         */
        function remove_action_form_billing(){
            if(wb_use_for_checkout()) {
                if(class_exists('WPBooking_Checkout_Controller')) {
                    remove_action('wpbooking_billing_information_form', array(WPBooking_Checkout_Controller::inst(), 'form_billing_html'));
                }
            }
        }

        /**
         * Custom form billing field
         *
         * @since 1.0
         *
         * @param $field_form
         * @return array
         */
        function custom_form_fields_billing($field_form){

            $form_id = wb_use_for_checkout();

            if(!empty($form_id)){
                $form_data_items = ST_Form_Builder_Models::inst()->get_form_meta($form_id);
                $form_data_items = unserialize($form_data_items);

                if(!empty($form_data_items) && is_array($form_data_items) && count($form_data_items) > 0){
                    $field_form = array();
                    $field_text = array(
                        ''
                        );
                    foreach($form_data_items as $key => $val){
                        $field_form[$val['name']] = array(
                            'label'       => $val['title'] ,
                            'placeholder' => isset($val['placeholder'])?$val['placeholder']:'' ,
                            'type'        => $val['field_type'] ,
                            'name'        => $val['name'] ,
                            'desc'        => $val['desc'] ,
                            'required'    => (!empty($val['required']) && $val['required'] == '1')?true:false,
                            'validate'        => (!empty($val['required']) && $val['required'] == '1')?'required':'',
                            'rule'        => (!empty($val['required']) && $val['required'] == '1')?'required':'',
                            'class'       => explode(' ', $val['extra_class']),
                            'custom_id'   => $val['custom_id'],
                            'option_value' => isset($val['option_value'])?$val['option_value']:false,
                            'post_type' => isset($val['post_type'])?$val['post_type']:false,
                            'taxonomy' => isset($val['taxonomy'])?$val['taxonomy']:false,
                            'value' => '',
                            'icon'        => 'fa-user'
                        );

                        switch($val['field_type']){
                            case 'email':
                            case 'user_email':
                                $field_form[$val['name']]['rule'] .= (!empty($val['required']) && $val['required'] == '1')?'|valid_email':'valid_email';
                                break;
                        }
                        if($val['field_type'] == 'textarea'){
                            $field_form[$val['name']]['attrs'] = array('rows' => 6);
                        }
                    }
                }
            }
            return $field_form;
        }

        /**
         * Custom form billing html
         *
         * @since 1.0
         */
        function _custom_form_billing_checkout($output)
        {
            $form_id = wb_use_for_checkout();

            if (!empty($form_id)) {
                $output = '<div class="billing_information">
                    <div class="wb_row">';

                        $field_form_billing = STCart::get_checkout_fields();
        
                        if (!empty($field_form_billing)) {
                            ?>
                            <?php foreach ($field_form_billing as $k => $v) {
                                $data = wp_parse_args($v, array(
                                    'title' => '',
                                    'desc' => '',
                                    'placeholder' => '',
                                    'type' => '',
                                    'name' => '',
                                    'required' => false,
                                    'class' => '',
                                    'custom_id' => '',
                                    'option_value' => false,
                                    'post_type' => '',
                                    'taxonomy' => '',
                                    'icon' => '',
                                    'validate' => '',
                                    'attrs' => array()
                                ));
                                $data['class'] = implode(' ', $data['class']);
                                $field_object = WB_Form_Builder_Controller::inst()->get_field($data['type']);

                                $field_html = $field_object->get_frontend_html($data);
                                $output .= do_shortcode($field_html);
                            }
                        }
                $output .= '
                    </div>
                </div>
                ';
            }

            return $output;
        }

        /**
         * Custom customer information html
         *
         * @since 1.0
         */
        function _custom_customer_information_html($html, $order_id){
            $form_data = get_post_meta($order_id, 'wb_form_for_order', true);

            if(!empty($form_data)) {
                $html = wb_form_builder_load_view('frontend/order/customer_information', array('order_id' => $order_id, 'form_data' => $form_data));
            }

            return $html;
        }

        function _custom_customer_information_popup_html($html, $order_id){
            $form_data = get_post_meta($order_id, 'wb_form_for_order', true);

            if(!empty($form_data)) {
                $html = wb_form_builder_load_view('frontend/order/customer_information_popup', array('order_id' => $order_id, 'form_data' => $form_data));
            }

            return $html;
        }

        /**
         * Custom email checkout info
         *
         * @since 1.0
         *
         * @param $attr
         * @param $html, $order_id
         * @return string
         */
        function _custom_email_checkout_info_html($html, $attr, $order_id){
            $form_id = wb_use_for_checkout();

            $form_data = get_post_meta($order_id, 'wb_form_for_order', true);

            if(!empty($form_id) && !empty($form_data)){
                $html = wb_form_builder_load_view('frontend/email/checkout_info', array('order_id' => $order_id));
            }
            return $html;
        }

        /**
         * Create order customer html
         *
         * @since 1.0
         *
         * @param $html
         * @param $order_id
         * @return string
         */
        function _custom_order_customer_html($html, $order_id){

            if(wb_use_for_checkout() && !empty($order_id)) {

                $field_form_billing = get_post_meta($order_id, 'wb_form_for_order', true);
                if(!empty($field_form_billing) && is_array($field_form_billing) && count($field_form_billing) > 0){
                    $full_name = '';
                    $li_html = '';
                    $isset_user_email = false;
                    foreach($field_form_billing as $key => $val){
                        if(!empty($item_data = get_post_meta($order_id, 'wpbooking_'.$val['name'], true))){

                            if($val['name'] == 'user_last_name' || $val['name'] == 'user_first_name'){
                                $full_name .= $item_data.' ';
                            }else{
                                switch($val['field_type']){
                                    case 'checkbox':
                                        $li_html .= '<li><strong>'.$val['title'].' </strong></li>';
                                        break;
                                    case 'country_dropdown':
                                        $list_country = wb_list_country();
                                        $li_html .= '<li><strong>'.$val['title'].': </strong>'.esc_attr($list_country[$item_data]).'</li>';
                                        break;
                                    case 'post_select':
                                        $li_html .= '<li><strong>'.$val['title'].': </strong>'.get_the_title($item_data).'</li>';
                                        break;
                                    case 'taxonomy_select':
                                        $term = get_term_by('id', $item_data, $val['taxonomy']);
                                        $li_html .= '<li><strong>'.$val['title'].': </strong>'.(isset($term->name)?$term->name:'').'</li>';
                                        break;
                                    case 'radio':
                                    case 'dropdown':
                                        $li_html .= '<li><strong>'.$val['title'].': </strong>'.(isset($val['option_value'][$item_data])?$val['option_value'][$item_data]:'').'</li>';
                                        break;
                                    case 'image_upload':
                                        $li_html .= '<li><strong>'.$val['title'].': </strong>'.wp_get_attachment_image($item_data, array(100,50), true).'</li>';
                                        break;
                                    default:
                                        $li_html .= '<li><strong>'.$val['title'].': </strong>'.esc_attr($item_data).'</li>';
                                        break;
                                }


                            }
                            if($val['name'] == 'user_email'){
                                $isset_user_email = true;
                                if(empty($full_name))
                                    $full_name = $item_data;
                            }
                        }
                    }
                    if($isset_user_email){
                        $order=new WB_Order($order_id);
                        $html = '<a href="'.esc_url(add_query_arg( 'user_id', $order->get_customer('id'), self_admin_url( 'user-edit.php' ) )).'"><strong>'.$full_name.'</strong></a><br>';
                    }else{
                        $html = '<span><strong>'.$full_name.'</strong></span><br>';
                    }

                    $html .= '<span class="wb-button-customer"><em>'.esc_html__('details ',ST_TEXTDOMAIN).'</em><span class="caret"></span></span>';
                    $html .= '<ul class="none wb-customer-detail">';
                    $html .= $li_html;
                    $html .= '</ul>';
                }
            }
            return $html;
        }

        /**
         * Save form builder for order
         *
         * @since 1.0
         *
         * @param $order_id
         */
        function _save_form_builder_for_order($order_id){
            if($form_id = wb_use_for_checkout()){
                $checkout_fields = STCart::get_checkout_fields();

                if(!empty($checkout_fields)){
                    update_post_meta($order_id, 'wb_form_for_order', $checkout_fields);
                }
            }
        }

        function _customer_infomation_edit_order($html, $order_id){
            
            $form_builder = get_post_meta( $order_id, 'wb_form_for_order', true );

            if (!empty($form_builder)) {
                $html = '';
                foreach ($form_builder as $k => $v) {

                    $data = wp_parse_args($v, array(
                        'title' => '',
                        'desc' => '',
                        'placeholder' => '',
                        'type' => '',
                        'name' => '',
                        'required' => false,
                        'class' => '',
                        'custom_id' => '',
                        'option_value' => false,
                        'post_type' => '',
                        'taxonomy' => '',
                        'icon' => '',
                        'validate' => '',
                        'attrs' => array()
                    ));
                    $data['class'] = implode(' ', $data['class']);
                    $field_object = WB_Form_Builder_Controller::inst()->get_field($data['type']);
                    if($data['name'] == 'st_note'){
                        $field_html = '';
                    }else{
                        $field_html = $field_object->get_admin_html($data, $order_id);
                    }
                    $html .= $field_html;
                }

            }

            return $html;
        }

        static function inst(){
            if(!self::$_inst) self::$_inst = new self;

            return self::$_inst;
        }

    }
    WB_Form_Builder_Checkout_Controller::inst();
}