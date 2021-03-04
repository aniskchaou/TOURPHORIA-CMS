<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/24/2018
 * Time: 2:17 PM
 */

class ST_Admin_Reports
{
    protected static $_inst;

    public function __construct()
    {
        add_action('admin_menu',[$this,'__registerMenu']);
        add_action('admin_enqueue_scripts',[$this,'__addScripts']);
    }

    public function __addScripts()
    {
        wp_register_style('jquery-ui','//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');

        wp_register_script('chartjs',get_template_directory_uri().'/assets/vendors/chart.js/Chart.bundle.js',[],null,true);

//        /**
//         * Select2 jQuery
//         */
//        wp_register_script('jquery-select2',get_template_directory_uri().'/assets/vendors/select2/js/select2.full.min.js',['jquery'],null,true);
//        wp_register_style('jquery-select2',get_template_directory_uri().'/assets/vendors/select2/css/select2.min.css');


        if(STInput::get('page')=='st_traveler_reports')
        {
            wp_enqueue_script('chartjs');
            wp_enqueue_script('jquery-ui-datepicker');
            wp_enqueue_style('jquery-ui');

            wp_enqueue_style('select2');
            wp_enqueue_script('select2');
        }
    }

    public function __registerMenu()
    {
        add_submenu_page(
           'st_traveler_option',
            esc_html__('Reports',ST_TEXTDOMAIN),
            esc_html__('Reports',ST_TEXTDOMAIN),
            'manage_options',
           'st_traveler_reports',
           [$this,'__displayPage']
        );
    }

    public function __displayPage()
    {
        $base_url = admin_url('admin.php?page=st_traveler_reports');
        $tabs = [
            'orders'=>[
                'title'=>esc_html__('Orders',ST_TEXTDOMAIN),
                'children'=>[
                    'by_date'=>['title'=>esc_html__('Sale by date',ST_TEXTDOMAIN)],
                    'by_partner'=>['title'=>esc_html__('Sale by partner',ST_TEXTDOMAIN)],
                    'sale_table'=>['title'=>esc_html__('Sale table',ST_TEXTDOMAIN)],
                ]
            ]
        ];
        $tab_id = isset($_GET['tab'])?$_GET['tab']:'';
        $sub_tab = isset($_GET['sub'])?$_GET['sub']:'';

        if(!$tab_id or !array_key_exists($tab_id,$tabs))
        {
            reset($tabs);
            $tab_id = key($tabs);
        }

        if(!empty($tabs[$tab_id]['children']) and !array_key_exists($sub_tab,$tabs[$tab_id]['children']))
        {
            reset($tabs[$tab_id]['children']);
            $sub_tab = key($tabs[$tab_id]['children']);
        }


        ?>
        <div class="wrap">
            <div class="nav-tab-wrapper">
                <?php foreach ($tabs as $id=>$tab){
                    $url=add_query_arg([
                        'tab'=>$id,
                    ],$base_url);
                    $active = $tab_id==$id?'nav-tab-active':'';

                    printf('<a href="%s" class="nav-tab %s">%s</a>',$url,$active,$tab['title']);
                }?>
            </div>
            <?php if(!empty($tabs[$tab_id]['children']))
            {
                echo '<ul class="subsubsub">';
                $i=0;
                foreach ($tabs[$tab_id]['children'] as $child_id=>$child){

                    $active = $sub_tab==$child_id?'current':'';
                    $url=add_query_arg([
                        'tab'=>$tab_id,
                        'sub'=>$child_id
                    ],$base_url);

                    $sep = $i<(count($tabs[$tab_id]['children'])-1)?'|':'';

                    printf('<li><a href="%s" class="%s">%s</a>%s</li>',$url,$active,$child['title'],$sep);

                    $i++;
                }
                echo '</ul>';
            }?>
            <br class="clear">
            <?php
            $file=ST_TRAVELER_DIR.'/inc/admin/views/reports/'.$tab_id;
            if($sub_tab) $file.='/'.$sub_tab;

            if(is_readable($file.'.php')){
                include_once $file.'.php';
            }
            ?>

        </div>
        <?php


    }

    public static function inst()
    {
        if(!self::$_inst) self::$_inst = new self();

        return self::$_inst;
    }


}
ST_Admin_Reports::inst();
//add_action('admin_init',['ST_Admin_Reports','inst']);