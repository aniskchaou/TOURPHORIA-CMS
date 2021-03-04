<?php
class STLanguage
{
    public static $msg;
    function init()
    {
        //add_action('init',array($this,'load_language'));
        self::load_language();
	    add_action('init',array($this,'load_language'));
        //add_action('admin_menu', array($this,'init_menu'),50);
//        add_action('init',array($this,'add_language'));
//        add_action('init',array($this,'change_language'));
//        add_action('init',array($this,'set_language_default_frontend'));
    }

    static function dir(){
        return plugin_dir_path(__FILE__);
    }
    static function dir_uri(){
        return plugin_dir_url(__FILE__);
    }

    static function get_msg(){
        $msg = self::$msg;
        if(!empty($msg)){
            return '<div class="'.$msg['status'].'">
                      <p>'.$msg['msg'].'</p>
                    </div>';
        }else{
            if(!empty($_REQUEST['status'])){
                return '<div class="'.$_REQUEST['status'].'">
                      <p>'.STInput::get('msg').'</p>
                    </div>';
            }
        }
    }

    static function init_menu(){
        add_submenu_page( apply_filters('ot_theme_options_menu_slug','st_traveler_options'), "ST Language", 'ST Language', 'manage_options', 'st-language', array('STLanguage','action_language') );
    }

    static function action_language(){
        if(is_admin() and !empty($_REQUEST['page'])){
            if($_REQUEST['page'] == 'st-language'){
                if(!empty($_REQUEST['action'])){
                    switch($_REQUEST['action']){
                        case "list_file":
                            require self::dir().'language/list_file.php';
                            break;
                        case "translate":
                            require self::dir().'language/translate.php';
                            break;
                        case "add":
                            require self::dir().'language/add.php';
                            break;
                        case "del":
                            self::delete_language();
                            require self::dir().'language/show.php';
                            break;
                        case "set_default":
                            self::set_language_default();
                            require self::dir().'language/show.php';
                            break;
                        default:
                            require self::dir().'language/show.php';
                    }
                }else{
                    require self::dir().'language/show.php';
                }
            }
        }

    }

//    static function change_language(){
//        if( !empty($_REQUEST['key']) and !empty($_REQUEST['btn_change_language']) ){
//
//            $id = $_REQUEST['id'];
//            $file_name = $_REQUEST['file'];
//            $file =get_template_directory().'/language/'.$id.'/modun/'.$file_name;
//            $file = str_ireplace('\\','/',$file);
//            $txt = self::convert_array_to_string($_REQUEST['key']);
//            $check  = self::write_file($file,$txt);
//            if($check){
//                self::$msg = array(
//                    'status'=>'updated',
//                    'msg'=>__('Update translate successfully !',STP_TEXTDOMAIN)
//                );
//            }else{
//                self::$msg = array(
//                    'status'=>'error',
//                    'msg'=>__('Update translate not successfully !',STP_TEXTDOMAIN)
//                );
//            }
//        }
//    }

    static function convert_array_to_string($array){
        $txt='<?php '."\r\n";
        foreach($array as $k=>$v){
            $txt .="st_lang['".$k."']=__('".$v."','traveler');"."\r\n";
        }
        $txt  = str_ireplace('st_lang','$lang',$txt);
        return $txt;
    }

//    static function add_language(){
//        if(!empty($_REQUEST['btn_add_language'])){
//            $name = $_REQUEST['name'];
//            if (!preg_match('/[^a-z0-9-]/i', $name)) {
//                $desc = $_REQUEST['desc'];
//                $slug = str_ireplace('-', '_', sanitize_title($name));
//                if (!empty($name)) {
//                    $dir = get_template_directory() . '/language/' . $slug;
//                    $dir = str_ireplace('\\', '/', $dir);
//                    if (!is_dir($dir)) {
//                        mkdir($dir);
//                        $dir_modun = $dir . '/modun/';
//                        mkdir($dir_modun);
//                        //create file config
//                        $file_config = get_template_directory() . '/language/' . $slug . '/config.php';
//                        $file_config = str_ireplace('\\', '/', $file_config);
//                        $txt_config = '<?php $config = array( "name"=>"' . $name . '", "desc"=>"' . $desc . '" );';
//                        $check_config = self::write_file($file_config, $txt_config);
//                        $list_modun = self::load_list_modun('english');
//                        if (!empty($list_modun)) {
//                            foreach ($list_modun as $k => $v) {
//                                $file_new = get_template_directory() . '/language/' . $slug . '/modun/' . $v['name'];
//                                $file_new = str_ireplace('\\', '/', $file_new);
//                                copy($v['url'], $file_new);
//                            }
//                        }
//                        if ($check_config) {
//
//                            self::$msg = array(
//                                'status' => 'updated',
//                                'msg' => __('Create successfully !', STP_TEXTDOMAIN)
//                            );
//                            wp_redirect(admin_url('admin.php?page=st-language&action="list_file"&id=' . $slug));
//                        } else {
//                            self::$msg = array(
//                                'status' => 'error',
//                                'msg' => __('Create not successfully !', STP_TEXTDOMAIN)
//                            );
//                        }
//                    } else {
//                        self::$msg = array(
//                            'status' => 'error',
//                            'msg' => __('Name existed !', STP_TEXTDOMAIN)
//                        );
//                    }
//                } else {
//                    self::$msg = array(
//                        'status' => 'error',
//                        'msg' => __('Name empty !', STP_TEXTDOMAIN)
//                    );
//                }
//            }else{
//                self::$msg = array(
//                    'status' => 'error',
//                    'msg' => __('Name only contains valid characters: a-z, A-Z, 0-9 , -', STP_TEXTDOMAIN)
//                );
//            }
//        }
//    }

    static function write_file($url , $txt){
        $myfile = fopen($url, "w");
        $check = fwrite($myfile, $txt);
        fclose($myfile);
        if($check === false){
            return false;
        }else{
            return true;
        }
    }



    static function delete_language(){
        if(!empty($_REQUEST['id'])){
           if($_REQUEST['id'] != 'english'){
               $file = get_template_directory().'/language/'.$_REQUEST['id'].'';
               $file = str_ireplace('\\','/',$file);
               if(file_exists($file)){
                   $title = self::get_title_language($_REQUEST['id']);
                   self::deleteDir($file.'/modun');
                   self::deleteDir($file);
                   self::$msg = array(
                       'status'=>'updated',
                       'msg'=>__('Delete : "'.$title.'" successfully !',STP_TEXTDOMAIN)
                   );
               }
           }
            return true;
        }else{
            return false;
        }
    }
    static function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
           return false;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
    static function set_language_default(){
        if(!empty($_REQUEST['id'])){
            update_option("st_language",$_REQUEST['id']);
            $title = self::get_title_language($_REQUEST['id']);
            self::$msg = array(
                'status'=>'updated',
                'msg'=>__('Set Language default : "'.$title.'" successfully !',STP_TEXTDOMAIN)
            );
            return true;
        }else{
            return false;
        }
    }
//    static function set_language_default_frontend(){
//        if(!empty($_REQUEST['lang']) and !empty($_REQUEST['change_lang'])){
//            $lang = $_REQUEST['lang'];
//            $file = get_template_directory().'/language/'.$lang.'/config.php';
//            $file = str_ireplace('\\','/',$file);
//            if( file_exists($file) ){
//                update_option("st_language",$_REQUEST['lang']);
//                wp_redirect(home_url());
//                die();
//            }
//        }else{
//            return false;
//        }
//    }
    static function get_language_default(){
        $language = get_option('st_language');
        $file =get_template_directory().'/language/'.$language.'/config.php';
        $file = str_ireplace('\\','/',$file);
        if(is_file($file)){
            return $language;
        }else{
            return 'english';
        }
    }


    static function get_title_language($id){
        $title='';
        if(!empty($id)){
            $file =get_template_directory().'/language/'.$id.'/config.php';
            $file = str_ireplace('\\','/',$file);
            if(is_file($file)){
                include $file;
                if(!empty($config)){
                    $title = $config['name'];
                }
            }
        }
        return $title;
    }

    static function get_info_language($id){
        $config=array('name'=>'','desc'=>'','slug'=>'');
        if(!empty($id)){
            $file =get_template_directory().'/language/'.$id.'/config.php';
            $file = str_ireplace('\\','/',$file);
            if(is_file($file)){
                include $file;
                if(!empty($config)){
                    $config = $config;
                }
            }
        }
        return $config;
    }

    static function load_language(){
        global $st_language;
        $language = self::get_language_default();

        //$key="st_language_".$language;
//        if($transient=get_transient($key))
//        {
//            $st_language=$transient;
//            return;
//        }

        $file=get_template_directory().'/language/'.$language.'/all.php';

        if(is_readable($file)){

            include $file;
            if(!empty($lang)){
                foreach($lang  as $key => $value ){
                    $st_language[$key]=$value;
                }
            }

            //set_transient($key,$st_language);
        }


//        $list_modun = self::load_list_modun($language);
//        if(!empty($list_modun)){
//            foreach($list_modun as $k=>$v){
//                include $v['url'];
//                if(!empty($lang)){
//                    foreach($lang  as $key => $value ){
//                        $st_language[$key]=$value;
//                    }
//                }
//            }
//        }

    }
    static function get_modun_language($id , $name_file){
        $st_language=array();
        $tmp =array();
        if(!empty($id)){
            $file =get_template_directory().'/language/'.$id.'/modun/'.$name_file;
            $file = str_ireplace('\\','/',$file);
            if(is_file($file)){
                $lang =array();
                include $file;
                if(!empty($lang)){
                    $tmp = $lang;
                }
            }
        }
        $modun_english  =get_template_directory().'/language/english/modun/'.$name_file;
        $modun_english = str_ireplace('\\','/',$modun_english);
        if(is_file($modun_english)){
            include $modun_english;
            if(!empty($lang)){
               foreach($lang as $k=>$v){
                   if(!empty($tmp[$k])){
                       $st_language[$k] = $tmp[$k];
                   }else{
                       $st_language[$k] = $v;
                   }
                }
            }
        }

        return $st_language;
    }
    static function load_list_language(){
        $dirs = array_filter(glob(get_template_directory().'/language/*'), 'is_dir');
        $dirs = str_ireplace('\\','/',$dirs);
        $list = array();
        if(!empty($dirs))
        {
            foreach($dirs as $key=>$value)
            {
                $dirname=basename($value);
                $file_config = $value.'/config.php';
                if(is_file($file_config)){
                    include $file_config;
                    if(!empty($config)){
                        $config['slug'] = $dirname;
                        array_push($list , $config);
                    }
                }
            }
        }
        return $list;
    }

    static function load_list_modun($language){
        $list = array();

        $dir_english = get_template_directory().'/language/english/modun/';
        $dir_english = str_ireplace('\\','/',$dir_english);
        $files_english = @scandir($dir_english);
        if(!empty($files_english)){
            foreach($files_english as $k=>$v){
                $dir = get_template_directory().'/language/'.$language.'/modun/'.$v;
                $dir = str_ireplace('\\','/',$dir);
                if(file_exists($dir) and $v != "." and $v != ".."){
                    $name = $v;
                    $file = $dir;
                    array_push($list , array(
                        'name'=>$name,
                        'url'=>$file
                    ));
                }else{
                    $file_english = get_template_directory().'/language/english/modun/'.$v;
                    if(is_file($file_english) ){
                        copy($file_english , $dir);
                        $name = $v;
                        $file = $dir;
                        array_push($list , array(
                            'name'=>$name,
                            'url'=>$file
                        ));
                    }
                }
            }
        }
        return $list;
    }
    static function check_exit_modun($name){
        $dir = get_template_directory().'/language/english/modun/';
        $dir = str_ireplace('\\','/',$dir);
        $files = scandir($dir);
        $dk =false;
        if(!empty($files))
        {
            foreach($files as $key=>$value)
            {
                if($name == $value){
                    return $dk = true;
                }
            }
        }
        return $dk ;
    }

    static function st_get_language($key){
        global $st_language;
        if(!empty($st_language[$key])){
            return $st_language[$key];
        }else{
            return $key;
        }
    }
    static function st_the_language($key){
        global $st_language;
        if(!empty($st_language[$key])){
            echo balanceTags($st_language[$key]);
        }else{
            echo balanceTags($key);
        }
    }
}
$x = new STLanguage();
$x->init();