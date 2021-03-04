<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/23/2018
 * Time: 10:59 AM
 */


if(!function_exists('ST_Admin_Notices'))
{
    class ST_Admin_Notices
    {
        protected static $_inst;

        protected $key = 'st_admin_notices';

        // Cached Notices
        protected $notices = [];

        public function __construct()
        {
            add_action('init',[$this,'__loadNotices']);
            add_action( 'wp_loaded', array( $this, '__hideNotices' ) );
            add_action('shutdown',[$this,'__storeNotices']);

            add_action('admin_notices',[$this,'__showNotices']);
        }


        public function __showNotices()
        {
            self::show();
        }

        public function __hideNotices()
        {
            if(!empty($_GET['st_hide_notice']) and !empty($_GET['_nonce']) and wp_verify_nonce($_GET['_nonce'],'st_hide_notice') and current_user_can('manage_options'))
            {
                $this->removeNotice($_GET['st_hide_notice']);
            }
        }

        public function removeNotice($id)
        {
            if(isset($this->notices[$id])) unset($this->notices[$id]);
        }

        public function __loadNotices()
        {
            $this->notices = get_option($this->key);
        }
        public function __storeNotices()
        {
            update_option($this->key,$this->notices);
        }

        public function addNotice($type,$id, $message)
        {
            if(empty($this->notices[$id])) $this->notices[$id]=['type'=>$type,'message'=>[]];

            $this->notices[$id]['message'][]=$message;
        }

        public function getNotices($id='')
        {
            if($id) return isset($this->notices[$id])?$this->notices[$id]:[];
            return $this->notices;
        }

        public static function addError($id,$message)
        {
            self::inst()->addNotice('error',$id,$message);
        }


        public static function addSuccess($id,$message)
        {
            self::inst()->addNotice('success',$id,$message);
        }

        public static function show($id='')
        {

            if(empty($id))
            {
                $notices = self::inst()->getNotices();
                if(!empty($notices))
                foreach ($notices as $id=>$notice)
                {
                    if(!empty($notice['message'])){
                        $hide_url= esc_url(add_query_arg([
                            'st_hice_notice'=>$id,
                            '_nonce'=>wp_create_nonce('st_hide_notice')
                        ]));
                        $template='<div class="notice notice-%s">
                        <a class="notice-dismiss" href="%s">'.esc_html__('Dismiss',ST_TEXTDOMAIN).'</a>
                        <p>%s</p></div>';

                        printf($template,$hide_url,$notice['type'],implode('<br>',$notice['message']));
                    }
                }

            }else{
                $notices = self::inst()->getNotices();
                if(isset($notices[$id]))
                {
                    $notice=$notices[$id];
                    if(!empty($notice['message'])){
                        $hide_url= esc_url(add_query_arg([
                            'st_hice_notice'=>$id,
                            '_nonce'=>wp_create_nonce('st_hide_notice')
                        ]));
                        $template='<div class="notice notice-%s">
                        <a class="notice-dismiss" href="%s">'.esc_html__('Dismiss',ST_TEXTDOMAIN).'</a>
                        <p>%s</p></div>';

                        printf($template,$hide_url,$notice['type'],implode('<br>',$notice['message']));
                    }
                }
            }
        }


        public static function inst()
        {
            if(!self::$_inst) self::$_inst = new self();
            return self::$_inst;
        }
    }

    ST_Admin_Notices::inst();
}

