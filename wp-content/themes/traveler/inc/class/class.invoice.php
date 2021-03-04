<?php
if(!class_exists('ST_PDF_Invoices_Controller')){
    class ST_PDF_Invoices_Controller{
        static $_inst;
        public $order_id = 0;
        function __construct()
        {
        	add_action('init',[$this,'_init_invoice'],10,9999);
        }
        function _init_invoice(){
            $invoice_enable = st()->get_option('invoice_enable','off');
            if($invoice_enable == 'on'){
                add_action('st_after_body_order_information_table',array($this, '_show_button_download'), 15, 2);
                add_action('st_after_order_success_page_information_table',array($this, '_show_button_download_order_page'));
                add_action('st_after_order_page_admin_information_table',array($this, '_show_button_download_order_page_admin'));
                $this->_handling_invoice_pdf();
            }
        }
        function _show_button_download_order_page_admin($order_id){
            if(!empty($order_id)){
                $current_url = $_SERVER['REQUEST_URI'];
                $current_url = add_query_arg(array(
                    'st_download' => $order_id
                ), $current_url);
                echo '<a target="_blank" style="display:block" href="' . esc_url($current_url) . '" ></i> '.esc_html__("Download Invoice",ST_TEXTDOMAIN).'</a>';
            }
        }
        function _show_button_download_order_page($order_id){
            if(st()->get_option('invoice_show_link_page_order','off') == 'on' ){
                $current_url = $_SERVER['REQUEST_URI'];
                $current_url = add_query_arg(array(
                    'st_download' => $order_id
                ), $current_url);
                echo '<a target="_blank" class="btn btn-primary" href="' . esc_url($current_url) . '" ><i class="fa fa-download"></i> '.esc_html__("Download Invoice",ST_TEXTDOMAIN).'</a>';
            }
        }
        function _show_button_download($order_id){
            if(!empty($order_id)){
                $current_url = home_url();
                $current_url = add_query_arg(array(
                    'st_download' => $order_id
                ), $current_url);
                echo '<a target="_blank" class="btn btn-primary" href="' . esc_url($current_url) . '" ><i class="fa fa-download"></i> '.esc_html__("Download Invoice",ST_TEXTDOMAIN).'</a>';

            }
        }
        function _handling_invoice_pdf(){
	        if(!empty($this->order_id = STInput::get('st_download'))){
		        $my_user = wp_get_current_user();
		        $user_book = get_post_meta($this->order_id,'user_id',true);
		        $user_partner = 0;
		        $order_data = array();
		        global $wpdb;
		        $sql = "SELECT * FROM {$wpdb->prefix}st_order_item_meta WHERE order_item_id = ".$this->order_id;
		        $rs = $wpdb->get_row($sql);
		        if(!empty($rs->partner_id)){
			        $user_partner = $rs->partner_id;
			        $order_data = $rs;
		        }
		        $is_checked = true;

		        $option_allow_guest_booking = st()->get_option('is_guest_booking');

		        if($option_allow_guest_booking != 'on'){
			        if(!is_user_logged_in()){
				        $is_checked = false;
			        }
		        }

		        if(!empty($user_book) && $user_book != 0) {
			        if ($user_book != $my_user->ID) {
				        $is_checked = false;
			        }
		        }
		        if($user_partner == $my_user->ID ){
			        $is_checked = true;
		        }
		        if(current_user_can('manage_options')){
			        $is_checked = true;
		        }
		        if($is_checked and !empty($order_data)){
			        STTraveler::load_libs(array(
				        'plugins/pdf-invoice/TCPDF/tcpdf',
				        'plugins/pdf-invoice/helpers-pdf'
			        ));
			        st_pdf_invoice_create_invoices($this->order_id,$order_data);
			        exit;
		        }else{
			        $current_url = $_SERVER['REQUEST_URI'];
			        $current_url = remove_query_arg('st_download', $current_url);
			        wp_redirect(($current_url));
			        exit;
		        }
	        }
        }
        static function inst(){
            if(!self::$_inst){
                self::$_inst = new self();
            }
            return self::$_inst;
        }
    }

    ST_PDF_Invoices_Controller::inst();
}