<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 10/04/2018
 * Time: 15:12 CH
 */
if(!function_exists('st_vc_about_icon')){
    function st_vc_about_icon($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_icon' =>'',
                'st_name' => '',
                'st_description'=>'',
                'st_link'=>'',
                'st_pos_icon'=>'top',
                'st_color_icon'=>'',
                'st_size_icon'=>'box-icon-sm',
                'st_text_align'=>'text-center',
                'st_border'=>'',
                'st_to_color'=>'black',
                'st_animation'=>'animate-icon-top-to-bottom',
            ), $attr, 'st_about_icon' );
        extract($data);

        $icons_center='';
        if($st_text_align =='text-center'){
            $icons_center = 'box-icon-center';
        }

        $class_bg_color = Assets::build_css("background: ".$st_color_icon."");

        if(!empty($st_border)){
            $class_bg_color = Assets::build_css("border-color: ".$st_color_icon."!important;
                                                 color: ".$st_color_icon."!important;");
        }

        if(empty($st_link)){
            $title = '<h4 class="thumb-title">'.$st_name.'</h4>';
        }else{
            $title = ' <h5 class="thumb-title">
                        <a href="'.$st_link.'" class="text-darken">'.$st_name.'</a>
                       </h5>';
        }
        $txt =  '
                    <div class="st-about-info thumb '.$st_text_align.'">
                            <header class="thumb-header pull-'.$st_pos_icon.' st-thumb-header">
                               <i class="fa '.$st_icon.' '.$st_size_icon.' box-icon-'.$st_pos_icon.' '.$icons_center.' round '.$class_bg_color.' '.$st_animation.' '.$st_border.'  box-icon-to-'.$st_to_color.' "></i>
                            </header>
                            <div class="thumb-caption pull-'.$st_pos_icon.' st-thumb-caption">
                                 '.$title.'
                                <p class="thumb-desc">'.$st_description.'</p>
                            </div>
                    </div>
                    ';
        return $txt;
    }
    st_reg_shortcode('st_about_icon','st_vc_about_icon');
}
if(!function_exists('st_accordion_func')){
    function st_accordion_func($arg,$content=false)
    {
        extract(wp_parse_args($arg,array('style'=>'')));
        global $i_tab;$i_tab=0;
        $content_data= st_remove_wpautop($content);
        $r = '<div id="accordion" class="st_accordion '.$style.' panel-group">'.$content_data.'</div>';
        unset($st_title_tb);
        unset($id_rand);
        return $r;
    }
    st_reg_shortcode('st_accordion','st_accordion_func');
    if ( class_exists( 'WPBakeryShortCodesContainer' ) and !class_exists('WPBakeryShortCode_st_accordion')) {
        class WPBakeryShortCode_st_accordion extends WPBakeryShortCodesContainer {
            protected function content($arg, $content = null) {
                return st_accordion_func($arg,$content);
            }
        }
    }
}
if(!function_exists('st_accordion_item_func')){
    function st_accordion_item_func($arg,$content=false)
    {
        global $i_tab;
        $class_style=Assets::build_css("    
                    float: right;
                    margin-right: 30px;
                    display: block;
                    font-weight: normal;
                    font-size: 13px;
                    color: #adadad;");
        $data = shortcode_atts(array(
            'st_title' =>"",
            'st_date' => "",
        ), $arg,'st_tab_item');
        extract($data);
        $data_expanded = "";
        if($i_tab == '0'){
            $class_active = "in";
            $data_expanded = "aria-expanded='true'";
        }else{
            $class_active="";
        }
        $id = rand();
        $text = '<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                   <a href="#collapse-'.$id.'" '.$data_expanded.'data-parent="#accordion" data-toggle="collapse">'.$st_title.'
                                    <span class="'.$class_style.'">'.$st_date.'</span>
                                   </a>
                                </h4>
                            </div>
                            <div id="collapse-'.$id.'" class="panel-collapse collapse '.$class_active.'" >
                                <div class="panel-body">'.$content.'</div>
                            </div>
                     </div>';
        $i_tab++;
        return $text;
    }
    st_reg_shortcode('st_accordion_item','st_accordion_item_func');
}

if(!function_exists('st_vc_alert')){
    function st_vc_alert($attr,$content=false)
    {

        $data = shortcode_atts(
            array(
                'st_content' =>'',
                'st_type' =>'alert-success',
            ), $attr, 'st_alert' );
        extract($data);
        $txt ='<div class="alert '.$st_type.'">
                    <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                    </button>
                    <p class="text-small">'.$st_content.'</p>
                </div>';
        return $txt;
    }
    st_reg_shortcode('st_alert','st_vc_alert');

}
if(!function_exists('st_vc_all_post_type_content_search')){
    function st_vc_all_post_type_content_search($attr,$content=false)
    {
        $default=array(
            'st_style'=>1,
            'st_number'=>5,
        );
        $attr=wp_parse_args($attr,$default);
        extract($attr);
        if(!is_page_template('template-search-all-post-type.php')){
            return "";
        }
        $html ='';
        global $wp_query, $st_search_query;

        $data_post_type = STInput::request('data_post_type','all');
        if($data_post_type == 'all'){
            $data_post_type = array('st_hotel','st_rental' , 'st_cars' , 'st_tours' , 'st_activity');
        }else{
            $data_post_type = array($data_post_type);
        }
        ///////////////////////////////
        ////// Hotel
        //////////////////////////////
        if(st_check_service_available('st_hotel') and in_array('st_hotel',$data_post_type) ){
            $hotel = new STHotel();
            $hotel = STHotel::inst();
            $hotel->alter_search_query();
            query_posts(
                array(
                    'post_type' => 'st_hotel',
                    's'         => '',
                    'paged'     => get_query_var('paged'),
                    'posts_per_page' => $st_number
                )
            );
            $st_search_query = $wp_query;
            $html .=  st()->load_template('search/search-all-post-type/content','all-post-type',array('attr'=>$attr));
            $html .='<br>';
            $hotel->remove_alter_search_query();
            wp_reset_query();
        }
        ///////////////////////////////
        ////// Rental
        //////////////////////////////
        if(st_check_service_available('st_rental') and in_array('st_rental',$data_post_type) ) {
            $rental = new STRental();
            $rental->alter_search_query();
            //add_action( 'pre_get_posts' , array( $rental , 'change_search_arg' ) );
            query_posts(
                array(
                    'post_type'      => 'st_rental' ,
                    's'              => '' ,
                    'paged'          => get_query_var( 'paged' ) ,
                    'posts_per_page' => $st_number
                )
            );
            $st_search_query = $wp_query;
            $html .= st()->load_template( 'search/search-all-post-type/content' , 'all-post-type' , array( 'attr' => $attr ) );
            $html .= '<br>';
            //remove_action( 'pre_get_posts' , array( $rental , 'change_search_arg' ) );
            $rental->remove_alter_search_query();
            wp_reset_query();
        }

        ///////////////////////////////
        ////// Activity
        //////////////////////////////
        if(st_check_service_available('st_activity')and in_array('st_activity',$data_post_type) ) {
            $activity = STActivity::inst();
            $activity->alter_search_query();
            query_posts(
                array(
                    'post_type'      => 'st_activity' ,
                    's'              => '' ,
                    'paged'          => get_query_var( 'paged' ) ,
                    'posts_per_page' => $st_number
                )
            );
            $st_search_query = $wp_query;
            $html .= st()->load_template( 'search/search-all-post-type/content' , 'all-post-type' , array( 'attr' => $attr ) );
            $html .= '<br>';
            $activity->remove_alter_search_query();
            wp_reset_query();
        }

        ///////////////////////////////
        ////// Cars
        //////////////////////////////
        if(st_check_service_available('st_cars') and in_array('st_cars',$data_post_type) ) {
            $cars = new STCars();
            add_action( 'pre_get_posts' , array( $cars , 'change_search_cars_arg' ) );
            query_posts(
                array(
                    'post_type'      => 'st_cars' ,
                    's'              => '' ,
                    'paged'          => get_query_var( 'paged' ) ,
                    'posts_per_page' => $st_number
                )
            );
            $st_search_query = $wp_query;
            $html .= st()->load_template( 'search/search-all-post-type/content' , 'all-post-type' , array( 'attr' => $attr ) );
            $html .= '<br>';
            remove_action( 'pre_get_posts' , array( $cars , 'change_search_cars_arg' ) );
            $cars->remove_alter_search_query();
            wp_reset_query();
        }
        ///////////////////////////////
        ////// Tours
        //////////////////////////////
        if(st_check_service_available('st_tours') and in_array('st_tours',$data_post_type) ) {
            $tours = new STTour();
            $tours->alter_search_query();
            add_action( 'pre_get_posts' , array( $tours , 'change_search_tour_arg' ) );
            query_posts(
                array(
                    'post_type'      => 'st_tours' ,
                    's'              => '' ,
                    'paged'          => get_query_var( 'paged' ) ,
                    'posts_per_page' => $st_number
                )
            );
            $st_search_query = $wp_query;
            $html .= st()->load_template( 'search/search-all-post-type/content' , 'all-post-type' , array( 'attr' => $attr ) );
            $html .= '<br>';
            $tours->remove_alter_search_query();
            wp_reset_query();
        }


        return $html;
    }
    st_reg_shortcode('st_all_post_type_content_search','st_vc_all_post_type_content_search');
}
if(!function_exists('st_vc_all_post_type_content_search_ajax')){
    function st_vc_all_post_type_content_search_ajax($attr,$content=false)
    {
        $default=array(
            'st_style'=>1,
            'st_number'=>5,
        );
        $attr=wp_parse_args($attr,$default);
        extract($attr);
        if(!is_page_template('template-search-all-post-type.php')){
            return "";
        }

        $data_post_type = STInput::request('data_post_type','all');

        $html =  st()->load_template('search/search-all-post-type/content','all-post-type-ajax',array('attr'=>$attr, 'data_post_type' => $data_post_type));
        return $html;

        $html ='';
        global $wp_query, $st_search_query;

        $data_post_type = STInput::request('data_post_type','all');

        if($data_post_type == 'all'){
            $data_post_type = array('st_hotel','st_rental' , 'st_cars' , 'st_tours' , 'st_activity');
        }else{
            $data_post_type = array($data_post_type);
        }
        ///////////////////////////////
        ////// Hotel
        //////////////////////////////
        if(st_check_service_available('st_hotel') and in_array('st_hotel',$data_post_type) ){
            $hotel = new STHotel();
            $hotel = STHotel::inst();
            $hotel->alter_search_query();
            query_posts(
                array(
                    'post_type' => 'st_hotel',
                    's'         => '',
                    'paged'     => get_query_var('paged'),
                    'posts_per_page' => $st_number
                )
            );
            $st_search_query = $wp_query;
            $html .=  st()->load_template('search/search-all-post-type/content','all-post-type-ajax',array('attr'=>$attr, 'post_type' => 'st_hotel'));
            $html .='<br>';
            $hotel->remove_alter_search_query();
            wp_reset_query();
        }
        ///////////////////////////////
        ////// Rental
        //////////////////////////////
        if(st_check_service_available('st_rental') and in_array('st_rental',$data_post_type) ) {
            $rental = new STRental();
            $rental->alter_search_query();
            //add_action( 'pre_get_posts' , array( $rental , 'change_search_arg' ) );
            query_posts(
                array(
                    'post_type'      => 'st_rental' ,
                    's'              => '' ,
                    'paged'          => get_query_var( 'paged' ) ,
                    'posts_per_page' => $st_number
                )
            );
            $st_search_query = $wp_query;
            $html .= st()->load_template( 'search/search-all-post-type/content' , 'all-post-type-ajax' , array( 'attr' => $attr , 'post_type' => 'st_rental') );
            $html .= '<br>';
            //remove_action( 'pre_get_posts' , array( $rental , 'change_search_arg' ) );
            $rental->remove_alter_search_query();
            wp_reset_query();
        }

        ///////////////////////////////
        ////// Activity
        //////////////////////////////
        if(st_check_service_available('st_activity')and in_array('st_activity',$data_post_type) ) {
            $activity = STActivity::inst();
            $activity->alter_search_query();
            query_posts(
                array(
                    'post_type'      => 'st_activity' ,
                    's'              => '' ,
                    'paged'          => get_query_var( 'paged' ) ,
                    'posts_per_page' => $st_number
                )
            );
            $st_search_query = $wp_query;
            $html .= st()->load_template( 'search/search-all-post-type/content' , 'all-post-type-ajax' , array( 'attr' => $attr , 'post_type' => 'st_activity') );
            $html .= '<br>';
            $activity->remove_alter_search_query();
            wp_reset_query();
        }

        ///////////////////////////////
        ////// Cars
        //////////////////////////////
        if(st_check_service_available('st_cars') and in_array('st_cars',$data_post_type) ) {
            $cars = new STCars();
            add_action( 'pre_get_posts' , array( $cars , 'change_search_cars_arg' ) );
            query_posts(
                array(
                    'post_type'      => 'st_cars' ,
                    's'              => '' ,
                    'paged'          => get_query_var( 'paged' ) ,
                    'posts_per_page' => $st_number
                )
            );
            $st_search_query = $wp_query;
            $html .= st()->load_template( 'search/search-all-post-type/content' , 'all-post-type-ajax' , array( 'attr' => $attr , 'post_type' => 'st_cars') );
            $html .= '<br>';
            remove_action( 'pre_get_posts' , array( $cars , 'change_search_cars_arg' ) );
            $cars->remove_alter_search_query();
            wp_reset_query();
        }
        ///////////////////////////////
        ////// Tours
        //////////////////////////////
        if(st_check_service_available('st_tours') and in_array('st_tours',$data_post_type) ) {
            $tours = new STTour();
            $tours->alter_search_query();
            add_action( 'pre_get_posts' , array( $tours , 'change_search_tour_arg' ) );
            query_posts(
                array(
                    'post_type'      => 'st_tours' ,
                    's'              => '' ,
                    'paged'          => get_query_var( 'paged' ) ,
                    'posts_per_page' => $st_number
                )
            );
            $st_search_query = $wp_query;
            $html .= st()->load_template( 'search/search-all-post-type/content' , 'all-post-type-ajax' , array( 'attr' => $attr , 'post_type' => 'st_tours') );
            $html .= '<br>';
            $tours->remove_alter_search_query();
            wp_reset_query();
        }


        return $html;
    }
    st_reg_shortcode('st_all_post_type_content_search_ajax','st_vc_all_post_type_content_search_ajax');
}
if(!function_exists('st_vc_bg_gallery')){
    function st_vc_bg_gallery($attr,$content=false)
    {
        wp_enqueue_script('gridrotator.js');
        $data = shortcode_atts(
            array(
                'st_images_in' =>0,
                'st_images_not_in' =>0,
                'st_col'=>8,
                'st_row'=>4,
                'st_speed'=>1200,
                'opacity'=>'0.5',
                'tabs_search' => ''
            ), $attr, 'st_bg_gallery' );
        extract($data);
        $per_page = ($st_col * $st_row)+5;
        $query_images_args = array(
            'post_type' => 'attachment',
            //'post_mime_type' =>'image',
            'post_status' => 'public',
            'posts_per_page'=>$per_page,
            'post__not_in'=>explode(',',$st_images_not_in),
            'post__in'=>explode(',',$st_images_in)
        );
        $list = query_posts($query_images_args);
        $txt='';
        $int_i = 0;
        $int_i = count($list);
        foreach ($list as $k=>$v){
            $image=wp_get_attachment_image($v->ID,array(150,150));
            $txt .= '<li class="image-'.$v->ID.'">
                        <a href="#">
                            '.$image.'
                        </a>
                     </li>';
        }
        wp_reset_query();
        if($list_in = count(explode(',',$st_images_in)) < $per_page){
            $query_images_args = array(
                'post_type' => 'attachment',
                'post_mime_type' =>'image',
                'post_status' => 'inherit',
                'posts_per_page'=>$per_page - $list_in,
                'post__not_in'=>explode(',',$st_images_not_in.','.$st_images_in),
            );
            $list = query_posts($query_images_args);
            foreach ($list as $k=>$v){
                $image=wp_get_attachment_image($v->ID,array(150,150));
                $txt .= '<li class="image-'.$v->ID.'">
                        <a href="#">
                            '.$image.'
                        </a>
                     </li>';
                // $int_i++;
            }
            wp_reset_query();
        }
        $class_bg = Assets::build_css("opacity: ".$opacity."!important;");
        $r =  '<div class="bg-holder">
                    <div class="bg-mask-darken '.$class_bg.'"></div>
                    <div class="bg-parallax"></div>
                    <!-- START GRIDROTATOR -->
                     <div class="ri-grid" id="ri-grid" xcount="'.$int_i.'" data-col="'.$st_col.'" data-row="'.$st_row.'" data-speed="'.$st_speed.'">
                        <ul>'.$txt.'</ul>
                    </div>
                    <!-- END GRIDROTATOR -->
                    <div class="bg-front full-center">
                        <div class="container">
                            '.st()->load_template('vc-elements/st-search/search','form',array('st_style_search' =>'style_1', 'st_box_shadow'=>'no' ,'class'=>'', 'tabs_search' => $tabs_search) ).'
                        </div>
                    </div>
                </div>';
        return $r;
    }
    st_reg_shortcode('st_bg_gallery','st_vc_bg_gallery');

}
if(!function_exists('st_vc_blog')){
    function st_vc_blog($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_blog_number_post' =>5,
                'st_blog_orderby' => 0,
                'st_blog_order'=>'asc',
                'st_blog_style'=>4,
                'st_category'=>'',
                'st_style'=>'style1',
                'st_ids'=>''

            ), $attr, 'st_blog' );
        extract($data);
        $query=array(
            'post_type' => 'post',
            'orderby'=>$st_blog_orderby,
            'order'=>$st_blog_order,
            'posts_per_page'=>$st_blog_number_post,
        );
        if($st_category != '0' && $st_category != '')
        {
            $query['tax_query'][]=array(
                'taxonomy'=>'category',
                'terms'=>explode(',',$st_category)
            );
        }

        if($st_ids){
            $query['post__in']=explode(',',$st_ids);
        }
        query_posts($query);
        $custom_class = "";
        $txt='';
        while(have_posts()){
            the_post();
            if($st_style == 'style1'){
                $txt .= st()->load_template('vc-elements/st-blog/loop',false,$data);
            }
            if($st_style == 'style2'){
                $txt .= st()->load_template('vc-elements/st-blog/loop2',false,$data);
            }
            if($st_style == 'style3'){
                $txt .= st()->load_template('vc-elements/st-blog/loop3',false,$data);
                $custom_class .= "no_margin_inner";
            }
        }
        wp_reset_query();
        $r =  '<div class="row row-wrap st_blog st_grid no_margin_inner">
                 '.$txt.'
               </div>';
        return $r;
    }
    st_reg_shortcode('st_blog','st_vc_blog');

}
if (!function_exists('st_breadcrumb_fn')){
    function st_breadcrumb_fn($attr){
        ?>
        <div class="container">
            <div class="breadcrumb">
                <?php st_breadcrumbs(); ?>
            </div>
        </div>
        <?php
    }
    st_reg_shortcode('st_breadcrumb','st_breadcrumb_fn');
}
if(!function_exists('st_vc_button')){
    function st_vc_button($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_title' =>'',
                'st_link' =>'',
                'st_type' =>'btn-default',
                'st_size' =>'btn-normal',
                'st_ghost' =>'',
            ), $attr, 'st_button' );
        extract($data);
        $txt ='<a href="'.$st_link.'" class="btn '.$st_type.' '.$st_size.' '.$st_ghost.'">'.$st_title.'</a>';
        return $txt;
    }
    st_reg_shortcode('st_button','st_vc_button');
}
if(!function_exists('st_vc_flickr')){
    function st_vc_flickr($arg,$content=false)
    {
        $data = shortcode_atts(array(
            'st_number' =>5,
            'st_user'=>'23401669@N00',
        ), $arg, 'st_flickr' );
        extract($data);
        $r = st()->load_template('vc-elements/st-fickr/html',null,$data);
        return $r;
    }
    st_reg_shortcode('st_flickr','st_vc_flickr');

}
if(!function_exists('st_vc_gallery')){
    function st_vc_gallery($attr,$content=false)
    {
        wp_enqueue_script( 'magnific.js' );

        $data = shortcode_atts(
            array(
                'st_number_image'=>'',
                'st_col'=>4,
                'margin_item'=>'',
                'image_size'=> array(360,270) ,
                'st_images_not_in'=>'',
                'st_images_in'=>'',
                'st_effect'=>'mfp-zoom-out',
                'st_icon'=>'fa-plus',
                'st_image_title'=> ''
            ), $attr, 'st_gallery' );
        extract($data);
        $query_images_args = array(
            'post_type' => 'attachment',
            'post_mime_type' =>'image',
            'post_status' => 'inherit',
            'posts_per_page'=>$st_number_image,
            'post__not_in'=>explode(',',$st_images_not_in),
            'post__in'=>explode(',',$st_images_in)
        );
        $class = Assets::build_css('margin-bottom: 30px;');
        $list = query_posts($query_images_args);
        $txt='';
        $icon = (!empty($st_icon)) ? '<i class="fa '.$st_icon.' round box-icon-small hover-icon i round"></i>' : "";
        foreach ($list as $k=>$v){
            $col = 12 / $st_col ;

            $image_src=wp_get_attachment_image_src($v->ID,'full');

            $image_src_raw= (isset($image_src[0])?$image_src[0]:false);
            $image_title = (!empty($st_image_title)  and ($st_image_title =='y')) ? "<div class='bgr-main st_image_title text-1line'><div>".get_the_title($v->ID)."</div></div>" : "";
            $txt .= '<div class="st_fix_gallery col-md-' . $col . ' '.$class.'">';
            if ($margin_item =='full') $txt .='<div class="row" >';
            $txt.=$image_title.'<a class="hover-img popup-gallery-image" href="' .$image_src_raw. '" data-effect="'.$st_effect.'">'.
                wp_get_attachment_image($v->ID,$image_size, false, array('alt' => TravelHelper::get_alt_image($v->ID)))
                .$icon.
                '</a>';
            if ($margin_item =='full') $txt .='</div>';
            $txt .='</div>';
        }
        wp_reset_query();
        if($st_number_image > $list_in = count(explode(',',$st_images_in)) ) {
            $query_images_args = array(
                'post_type' => 'attachment',
                'post_mime_type' =>'image',
                'post_status' => 'inherit',
                'posts_per_page'=>$st_number_image - $list_in,
                'post__not_in'=>explode(',',$st_images_not_in.','.$st_images_in),
            );
            $list = query_posts($query_images_args);
            foreach ($list as $k=>$v){
                $col = 12 / $st_col ;

                $image_src=wp_get_attachment_image_src($v->ID,'full');
                $image_src_raw= (isset($image_src[0])?$image_src[0]:false);
                $image_title = (!empty($st_image_title)  and ($st_image_title =='y')) ? "<div class='bgr-main st_image_title text-1line'><div>".get_the_title($v->ID)."</div></div>" : "";
                $txt .= '<div class="st_fix_gallery2 col-md-'.$col.' '.$class.'">';
                if ($margin_item =='full') $txt .='<div class="row" >';
                $txt .=$image_title.'<a class="hover-img popup-gallery-image" href="'. $image_src_raw.'" data-effect="'.$st_effect.'">
                            '.wp_get_attachment_image($v->ID,$image_size, false, array('alt' => TravelHelper::get_alt_image($v->ID))).
                    $icon.
                    '</a>';
                if ($margin_item =='full') $txt .='</div>';
                $txt.='
                    </div>';
            }
            wp_reset_query();
        }
        $row_class = ($margin_item =='full') ? "" :'row' ;
        $r =  '<div class="popup-gallery">
                    <div class="'.$row_class .' row-col-gap">
                      '.$txt.'
                    </div>
                </div>';
        return $r;
    }
    st_reg_shortcode('st_gallery','st_vc_gallery');
}
if(!function_exists('st_vc_gird')){
    function st_vc_gird($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_color' =>'',
                'st_size' =>'col-md-1',
            ), $attr, 'st_gird' );
        extract($data);
        $class = Assets::build_css('background : '.$st_color. ' ; height : 20px');
        $txt ='<div class="row"><div class="demo-grid">
                    <div class="'.$st_size.'">
                        <div class="'.$class.'"></div>
                    </div>
               </div></div>';
        return $txt;
    }
    st_reg_shortcode('st_gird','st_vc_gird');
}
if (!function_exists('st_vc_header')){
    function st_vc_header($attr){
        $post_type = get_post_type(get_the_ID());
        if($post_type == 'st_tours'){
            $price_html = STTour::get_price_html(get_the_ID());
        }else{
            $price_html = STActivity::get_price_html(get_the_ID());
        }

        $return = '
        <header class="booking-item-header">
            <div class="row">
                <div class="col-md-9 col-xs-12">'.
            st()->load_template('tours/elements/header',null,array('attr'=>$attr))
            .'</div>
                <div class="col-md-3 col-xs-12 text-right price_activity">
						<p class="booking-item-header-price">'.
            $price_html
            .'</p>
                </div>
            </div>
        </header>';
        return $return ;
    }
    st_reg_shortcode('st_header','st_vc_header');
}
if(!function_exists('st_vc_icon')){
    function st_vc_icon($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_tooltips' =>'',
                'st_pos_tooltip' =>'none',
                'st_icon' =>'',
                'st_text_content'=>'',
                'st_color_icon'=>'',
                'st_to_color'=>'',
                'st_size_icon'=>'box-icon-sm',
                'st_round'=>'',
                'st_border'=>'',
                'st_animation'=>'',
                'st_aligment'=>'box-icon-none',
                'st_icon_display'=>''
            ), $attr, 'st_about_icon' );
        extract($data);

        $class_bg_color = Assets::build_css("background: ".$st_color_icon."!important;");
        $class_bg_to_color = Assets::build_css("background: ".$st_to_color."!important;
                                                border-color: ".$st_to_color."!important;
                                                ",":hover");
        if($st_animation == "border-rise"){
            $class__ = Assets::build_css("box-shadow: 0 0 0 2px ".$st_to_color." ",":after");
            $class_bg_to_color =  $class_bg_to_color." ".$class__;
        }


        if(!empty($st_border)){
            $class_bg_color = Assets::build_css("border-color: ".$st_color_icon."!important;
                                                 color: ".$st_color_icon."!important;");
        }
        if(!$st_pos_tooltip or $st_pos_tooltip != 'none'){
            $html_tooltip = 'data-placement="'.$st_pos_tooltip.'" title="" rel="tooltip" data-original-title="'.$st_tooltips.'"';
        }else{$html_tooltip="";}

        if(!empty($st_animation)){
            $animate = "animate-icon-".$st_animation;
        }else{$animate = "";}
        $class__text_font = $class__css_display = "";
        if (!empty($st_icon)) {
            $st_text_content = "";
        }else {
            $class__text_font .= Assets::build_css("font-family: "."inherit;");
        }

        if (!empty($st_icon_display)) {
            $class__css_display = Assets::build_css("display:" .$st_icon_display.";");
        }
        $txt ='<i class="fa '.$class__css_display .' ' .$class__text_font.' '. $st_icon.' '.$st_size_icon.' '.$st_border.' '.$st_aligment.' '.$class_bg_color.' '.$st_round.' '.$class_bg_to_color.' '.$animate.' " '.$html_tooltip.'>'.$st_text_content .'  </i>';
        return $txt;
    }
    st_reg_shortcode('st_icon','st_vc_icon');
}
if(!function_exists('st_vc_image_effect')){
    function st_vc_image_effect($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_image' =>'',
                'st_type' =>'icon',
                'st_pos_layout' =>'-top-left',
                'st_hover_hold' =>'',
                'st_title' =>'',
                'st_class_icon'=>'',
                'st_icon_group'=>'',
                'url'=>''
            ), $attr, 'st_image_effect' );
        extract($data);
        $img = wp_get_attachment_image_src($st_image,array(262,197));
        $txt='';
        if($st_type == ""){
            $txt ='<a href="#" class="hover-img">
                     <img title="" alt="'.TravelHelper::get_alt_image($st_image).'" src="'.$img[0].'">
                   </a>';
        }

        if($st_type == "icon"){
            $txt ='<a href="'.$url.'" class="hover-img">
                     <img title="" alt="'.TravelHelper::get_alt_image($st_image).'" src="'.$img[0].'">
                     <i class="fa '.$st_class_icon.' box-icon hover-icon'.$st_pos_layout.' '.$st_hover_hold.' round"></i>
                   </a>';
        }
        if($st_type == "icon-group"){
            $content = str_ireplace('<ul>','',$content);
            $content = str_ireplace('</ul>','',$content);
            $txt ='<div class="hover-img">
                     <img title="" alt="'.TravelHelper::get_alt_image($st_image).'" src="'.$img[0].'">
                     <ul class="hover-icon-group'.$st_pos_layout.' '.$st_hover_hold.'">
                    '.st_remove_wpautop($content).'
                    </ul>
                   </div>';
        }
        if($st_type == "title"){
            $txt ='<a href="'.$url.'" class="hover-img">
                            <img title="" alt="'.TravelHelper::get_alt_image($st_image).'" src="'.$img[0].'">
                            <h5 class="hover-title'.$st_pos_layout.' '.$st_hover_hold.'">'.$st_title.'</h5>
                         </a>';
        }
        if($st_type == "inner-full"){
            $txt ='<a href="'.$url.'" class="hover-img">
                            <img title="" alt="'.TravelHelper::get_alt_image($st_image).'" src="'.$img[0].'">
                            <div class="hover-inner">'.$st_title.'</div>
                         </a>';
        }
        if($st_type == "inner-block") {
            $txt = '<a href="'.$url.'" class="hover-img">
                            <img title="" alt="'.TravelHelper::get_alt_image($st_image).'" src="' . $img[0] . '">
                            <div class="hover-inner hover-hold">' . $st_title . '</div>
                         </a>';
        }
        return $txt;
    }
    st_reg_shortcode('st_image_effect','st_vc_image_effect');
}
if(!function_exists('st_vc_inbox_form')){
    function st_vc_inbox_form($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'title' =>'',
                'active' =>'',
            ), $attr, 'st_inbox_form' );
        extract($data);
        $enable_inbox = st()->get_option('enable_inbox');
        $html = '';
        if($enable_inbox == 'on') {
            $html = st()->load_template( 'vc-elements/st-inbox-form/index' , false ,$data );
        }
        return $html;
    }
    st_reg_shortcode('st_inbox_form','st_vc_inbox_form');

}
if(!function_exists( 'st_vc_info_owner' )) {
    function st_vc_info_owner( $attr , $content = false )
    {
        $data = shortcode_atts(
            array(
                'title'             => '' ,
                'show_avatar'       => 'true' ,
                'show_social'       => 'true' ,
                'show_member_since' => 'true' ,
                'show_short_info'   => 'true' ,
            ) , $attr , 'st_info_owner' );
        extract( $data );

        return st()->load_template( 'vc-elements/st-info-owner/st-info-owner' , false , array( "data" => $data ) );
    }
    st_reg_shortcode( 'st_info_owner' , 'st_vc_info_owner' );


}
if(!function_exists( 'st_vc_last_minute_deal' )) {
    function st_vc_last_minute_deal( $attr , $content = false )
    {
        $data = shortcode_atts(
            array(
                'st_post_type' => 'st_hotel' ,
            ) , $attr , 'st_last_minute_deal' );
        extract( $data );
        $html = "";
        global $wpdb;
        $sql = null;
        $where = $join = "";

        $where = TravelHelper::edit_where_wpml($where);
        $date_now = strtotime(date('Y-m-d'));
        switch ( $st_post_type ) {
            case 'st_hotel':
                $date_hotel = strtotime(date('Y-m-d'));
                $join = TravelHelper::edit_join_wpml($join , 'hotel_room') ;
                if( !TravelHelper::checkTableDuplicate(array('st_hotel', 'hotel_room'))){
                    return '';
                }

                for($i = $date_hotel; $i <= strtotime('+15 days', $date_hotel); $i = strtotime('+1 day', $i)){
                    $sql = "SELECT
                        room.post_id,
                        room.room_parent,
                        room.discount_rate
                    FROM
                        {$wpdb->prefix}hotel_room AS room
                    INNER JOIN {$wpdb->prefix}st_hotel AS hotel ON hotel.post_id = room.room_parent
                    WHERE
                        CAST(
                            room.discount_rate AS UNSIGNED
                        ) > 0
                    AND room.post_id NOT IN (
                        SELECT
                            room_id
                        FROM
                            (
                                SELECT
                                    od.room_id,
                                    room1.number_room,
                                    od.room_num_search,
                                    sum(od.room_num_search),
                                    cast(
                                        room1.number_room AS UNSIGNED
                                    )
                                FROM
                                    {$wpdb->prefix}st_order_item_meta AS od
                                INNER JOIN {$wpdb->prefix}hotel_room AS room1 ON room1.post_id = od.room_id
                                WHERE
                                    1 = 1
                                AND (
                                    (
                                        check_in_timestamp <= {$i}
                                        AND check_out_timestamp >= {$i}
                                    )
                                    OR (
                                        check_in_timestamp >= {$i}
                                        AND check_in_timestamp <= {$i}
                                    )
                                )
                                AND od.check_out_timestamp
                                AND `status` NOT IN ('trash', 'canceled')
                                AND od.st_booking_post_type = 'st_hotel'
                                GROUP BY
                                    od.room_id
                                HAVING
                                    sum(od.room_num_search) >= cast(
                                        room1.number_room AS UNSIGNED
                                    )
                            ) AS room_id
                    )
                    AND room.post_id NOT IN (
                        SELECT
                            post_id
                        FROM
                            {$wpdb->prefix}st_availability
                        WHERE
                            1 = 1
                        AND (
                            check_in >= {$i}
                            AND check_out <= {$i}
                            AND `status` = 'unavailable'
                        )
                        AND post_type = 'hotel_room'
                    )
                    ORDER BY
                        room.discount_rate DESC
                    LIMIT 0,
                     1";
                    $rs = $wpdb->get_row($sql);
                    if(!empty($rs)){
                        $data['rs'] = $rs;
                        $data['date'] = $i;
                        $html =  st()->load_template('vc-elements/st-last-minute-deal/html',$st_post_type, $data);
                        return $html;
                    }
                }
                break;
            case 'hotel_room':
                $date_hotel = strtotime(date('Y-m-d'));
                $join = TravelHelper::edit_join_wpml($join , 'hotel_room') ;
                if( !TravelHelper::checkTableDuplicate(array('st_hotel', 'hotel_room')) ){
                    return '';
                }
                for($i = $date_hotel; $i <= strtotime('+15 days', $date_hotel); $i = strtotime('+1 day', $i)){
                    $sql = "SELECT
                        room.post_id,
                        room.room_parent,
                        room.discount_rate
                    FROM
                        {$wpdb->prefix}hotel_room AS room
                    WHERE
                        (
                            room.room_parent = 0
                            OR room.room_parent IS NULL
                        )
                    AND CAST(
                        room.discount_rate AS UNSIGNED
                    ) > 0
                    AND room.post_id NOT IN (
                        SELECT
                            room_id
                        FROM
                            (
                                SELECT
                                    od.room_id,
                                    room1.number_room,
                                    od.room_num_search,
                                    sum(od.room_num_search),
                                    cast(
                                        room1.number_room AS UNSIGNED
                                    )
                                FROM
                                    {$wpdb->prefix}st_order_item_meta AS od
                                INNER JOIN {$wpdb->prefix}hotel_room AS room1 ON room1.post_id = od.room_id
                                WHERE
                                    1 = 1
                                AND (
                                    (
                                        check_in_timestamp <= {$i}
                                        AND check_out_timestamp >= {$i}
                                    )
                                    OR (
                                        check_in_timestamp >= {$i}
                                        AND check_in_timestamp <= {$i}
                                    )
                                )
                                AND od.check_out_timestamp
                                AND `status` NOT IN ('trash', 'canceled')
                                AND od.st_booking_post_type = 'hotel_room'
                                GROUP BY
                                    od.room_id
                                HAVING
                                    sum(od.room_num_search) >= cast(
                                        room1.number_room AS UNSIGNED
                                    )
                            ) AS room_id
                    )
                    AND room.post_id NOT IN (
                        SELECT
                            post_id
                        FROM
                            {$wpdb->prefix}st_availability
                        WHERE
                            1 = 1
                        AND (
                            check_in >= {$i}
                            AND check_out <= {$i}
                            AND `status` = 'unavailable'
                        )
                        AND post_type = 'hotel_room'
                    )
                    ORDER BY
                        room.discount_rate DESC
                    LIMIT 0,
                     1";
                    $rs = $wpdb->get_row($sql);
                    if(!empty($rs)){
                        $data['rs'] = $rs;
                        $data['date'] = $i;
                        $html =  st()->load_template('vc-elements/st-last-minute-deal/html',$st_post_type, $data);
                        return $html;
                    }
                }
                break;
            case 'st_rental' :
                $date_rental = strtotime(date('Y-m-d'));
                $date_rental_ymd = date('Y-m-d');
                $join = TravelHelper::edit_join_wpml($join , 'hotel_room') ;
                if( !TravelHelper::checkTableDuplicate('st_rental') ){
                    return '';
                }
                for($i = $date_rental; $i <= strtotime('+15 days', $date_rental); $i = strtotime('+1 day', $i)){
                    $date_rental_ymd = date("Y-m-d", $i);
                    $sql = "SELECT
                        rental.post_id as post_id,
                        rental.discount_rate as discount_rate,
                        rental.is_sale_schedule as is_sale_schedule,
                        rental.sale_price_from as sale_price_from,
                        rental.sale_price_to as sale_price_to
                    FROM
                        {$wpdb->prefix}st_rental AS rental
                    JOIN {$wpdb->prefix}postmeta AS meta ON meta.post_id = rental.post_id
                    AND meta.meta_key = 'rental_number'
                    WHERE
                        cast(
                            rental.discount_rate AS UNSIGNED
                        ) > 0
                    AND (
                        (
                            rental.is_sale_schedule = 'on'
                            AND STR_TO_DATE('{$date_rental_ymd}', '%Y-%m-%d') BETWEEN STR_TO_DATE(
                                rental.sale_price_from,
                                '%Y-%m-%d'
                            )
                            AND STR_TO_DATE(
                                rental.sale_price_to,
                                '%Y-%m-%d'
                            )
                        )
                        OR (
                            rental.is_sale_schedule = 'off'
                        )
                    )
                    AND rental.post_id NOT IN (
                        SELECT
                            post_id
                        FROM
                            {$wpdb->prefix}st_availability
                        WHERE
                            1 = 1
                        AND (
                            check_in >= {$i}
                            AND check_out <= {$i}
                            AND `status` = 'unavailable'
                        )
                        AND post_type = 'st_rental'
                    )
                    AND rental.post_id NOT IN (
                        SELECT
                            st_booking_id
                        FROM
                            (
                                SELECT
                                    od.st_booking_id,
                                    meta.meta_value,
                                    meta.meta_value - count(DISTINCT od.id)
                                FROM
                                    {$wpdb->prefix}st_order_item_meta AS od
                                INNER JOIN {$wpdb->prefix}postmeta AS meta ON meta.post_id = od.st_booking_id
                                AND meta.meta_key = 'rental_number'
                                WHERE
                                    1 = 1
                                AND (
                                    (
                                        check_in_timestamp <= {$i}
                                        AND check_out_timestamp >= {$i}
                                    )
                                    OR (
                                        check_in_timestamp >= {$i}
                                        AND check_in_timestamp <= {$i}
                                    )
                                )
                                AND `status` NOT IN ('trash', 'canceled')
                                AND od.st_booking_post_type = 'st_rental'
                                GROUP BY
                                    od.st_booking_id
                                HAVING
                                    meta.meta_value - count(od.id) <= 0
                            ) AS st_booking_id
                    )
                    ORDER BY
                        rental.discount_rate DESC
                    LIMIT 1";

                    $rs = $wpdb->get_row($sql);
                    if(!empty($rs)){
                        $data['rs'] = $rs;
                        $data['date'] = $i;
                        $html =  st()->load_template('vc-elements/st-last-minute-deal/html',$st_post_type, $data);
                        return $html;
                    }
                }
                break;
            case 'st_cars' :
                $join = TravelHelper::edit_join_wpml($join , 'st_cars') ;
                $date_now = date('Y-m-d');
                if( !TravelHelper::checkTableDuplicate('st_cars') || !TravelHelper::count_all_sale('st_cars')){
                    return '';
                }

                $sql = "SELECT
                    {$wpdb->prefix}posts.*,
                    mt.discount as discount_rate,
                    mt.cars_price as price,
                    mt.is_sale_schedule as is_sale_schedule,
                    mt.sale_price_from as sale_price_from,
                    mt.sale_price_to as sale_price_to
                FROM
                    {$wpdb->prefix}posts
                INNER JOIN {$wpdb->prefix}st_cars AS mt ON mt.post_id = {$wpdb->prefix}posts.ID
                {$join}
                WHERE
                    1 = 1
                {$where}    
                AND post_type = 'st_cars'
                AND mt.discount != ''
                and (
                    (mt.sale_price_from = '0000-00-00' or mt.sale_price_to = '0000-00-00')
                    OR (
                        mt.sale_price_to >= STR_TO_DATE('{$date_now}', '%Y-%m-%d')
                        AND mt.is_sale_schedule = 'on'
                    )
                )
                GROUP BY
                    {$wpdb->prefix}posts.ID
                ORDER BY
                    mt.discount DESC LIMIT 0,1";
                break;
            case 'st_tours' :
                $join = TravelHelper::edit_join_wpml($join , 'st_tours') ;
                $date_now = date('Y-m-d');
                if( !TravelHelper::checkTableDuplicate('st_tours') || !TravelHelper::count_all_sale('st_tours')){
                    return '';
                }
                $sql = "SELECT
                    {$wpdb->prefix}posts.*,
                    mt.discount as discount_rate,
                    mt.adult_price as price,
                    mt.is_sale_schedule as is_sale_schedule,
                    mt.sale_price_from as sale_price_from,
                    mt.sale_price_to as sale_price_to
                FROM
                    {$wpdb->prefix}posts
                INNER JOIN {$wpdb->prefix}st_tours AS mt ON mt.post_id = {$wpdb->prefix}posts.ID
                {$join}
                WHERE
                    1 = 1
                {$where}    
                AND post_type = 'st_tours'
                AND (mt.discount is not null or mt.discount != '' )
                and (
                    (mt.sale_price_from = '' or mt.sale_price_from = '0000-00-00' or mt.sale_price_to = '0000-00-00' or mt.sale_price_to = '')
                    OR (
                        mt.sale_price_to >= STR_TO_DATE('{$date_now}', '%Y-%m-%d')
                        AND mt.is_sale_schedule = 'on'
                    )
                )
                GROUP BY
                    {$wpdb->prefix}posts.ID
                ORDER BY
                    cast(mt.discount as DECIMAL(15,6)) DESC LIMIT 0,1";
                break;
            case 'st_activity' :
                $join = TravelHelper::edit_join_wpml($join , 'st_activity') ;
                $date_now = date('Y-m-d');
                if( !TravelHelper::checkTableDuplicate('st_activity') || !TravelHelper::count_all_sale('st_activity')){
                    return '';
                }
                $sql = "SELECT
                    {$wpdb->prefix}posts.*,
                    mt.discount as discount_rate,
                    mt.adult_price as price,
                    mt.is_sale_schedule as is_sale_schedule,
                    mt.sale_price_from as sale_price_from,
                    mt.sale_price_to as sale_price_to
                FROM
                    {$wpdb->prefix}posts
                INNER JOIN {$wpdb->prefix}st_activity AS mt ON mt.post_id = {$wpdb->prefix}posts.ID
                {$join}
                WHERE
                    1 = 1
                {$where}    
                AND post_type = 'st_activity'
                AND mt.discount != ''
                and (
                    (mt.sale_price_from = '0000-00-00' or mt.sale_price_to = '0000-00-00')
                    OR (
                        mt.sale_price_to >= STR_TO_DATE('{$date_now}', '%Y-%m-%d')
                        AND mt.is_sale_schedule = 'on'
                    )
                )
                GROUP BY
                    {$wpdb->prefix}posts.ID
                ORDER BY
                    mt.discount DESC LIMIT 0,1";
                break;
        }

        $rs = $wpdb->get_row($sql);

        if(!empty($rs)){
            $data['rs'] = $rs;
            $html =  st()->load_template('vc-elements/st-last-minute-deal/html',$st_post_type, $data);
        }
        return $html;
    }
    st_reg_shortcode( 'st_last_minute_deal' , 'st_vc_last_minute_deal' );
}
if(!function_exists('st_vc_lightbox')){
    function st_vc_lightbox($attr,$content=false)
    {
        wp_enqueue_script('magnific.js' );

        $data = shortcode_atts(
            array(
                'st_type' =>'image',
                'st_effect' =>'mfp-zoom-out',
                'st_image' =>'',
                'st_link' =>'',
                'st_title' =>'',
                'st_icon' =>'fa-plus',
            ), $attr, 'st_lightbox' );
        extract($data);
        $img = wp_get_attachment_image_src($st_image,'full');
        if($st_type == "image"){
            $txt ='<a href="'.$img[0].'" class="hover-img popup-image" data-effect="'.$st_effect.'" >
                       <img title="" alt="'.TravelHelper::get_alt_image($st_image).'" src="'.$img[0].'">
                       <i class="fa '.$st_icon.' round box-icon-small hover-icon i round"></i>
                   </a>';
        }
        if($st_type == "iframe"){

            $txt ='<a class="popup-iframe" data-effect="'.$st_effect.'" href="'.$st_link.'" inline_comment="lightbox">'.$st_title.'</a>';
        }
        if($st_type == "html"){
            $id = rand();
            $txt ='<a class="popup-text" data-effect="'.$st_effect.'" href="#small-dialog-'.$id.'">'.$st_title.'</a>
                    <div id="small-dialog-'.$id.'" class="mfp-with-anim mfp-dialog mfp-hide">
                    '.st_remove_wpautop($content).'
                    </div>';
        }
        return $txt;
    }
    st_reg_shortcode('st_lightbox','st_vc_lightbox');
}
if(!function_exists('st_vc_list_location')){
    function st_vc_list_location($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_ids' =>"",
                'st_type'=>'st_hotel',
                'is_featured' =>'no',
                'st_number' =>4,
                'link_to' =>'page_search',
                'st_col'=>4,
                'st_style'=>'normal',
                'st_show_logo'=>'yes',
                'st_logo_position'=>'left',
                'st_orderby'=>'',
                'st_order'=>'asc',
                'st_location_type'=> ''
            ), $attr, 'st_list_location' );

        extract($data);

        $query=array(
            'post_type' => 'location',
            'posts_per_page'=>$st_number,
            'order'=>$st_order,
            'orderby'=>$st_orderby,
        );

        if(!empty($st_ids)){
            $location_ids = explode(',',$st_ids);
            $query['post__in']=$location_ids;
        }
        if(!empty($meta_query)){
            $query['meta_query'] = $meta_query;
        }

        if($st_orderby == 'price'){
            $query['meta_key']='min_price_'.$st_type.'';
            $query['orderby']='meta_value';
        }

        if($st_orderby == 'sale'){
            $query['meta_key']='total_sale_number';
            $query['orderby']='meta_value';
        }

        if($st_orderby == 'rate'){
            $query['meta_key']='review_'.$st_type.'';
            $query['orderby']='meta_value';
        }
        if($is_featured == 'yes'){
            $query['orderby']='meta_value_num';
            $query['meta_query'][]=
                array(
                    'key'     => 'is_featured',
                    'value'   => 'on',
                    'compare' => '=',
                );

        }

        if(!empty($st_location_type)){
            $st_location_type = explode(',',$st_location_type );
        }

        /*if(empty($st_location_type)) {
	        $st_location_type = array();
	        $list_terms       = STLocation::get_location_terms();
	        if ( ! empty( $list_terms ) and is_array( $list_terms ) ) {
		        foreach ( $list_terms as $key => $value ) {
			        $st_location_type[ $value->name ] = $value->taxonomy . "/" . $value->term_id;
		        }
	        }
        }else{
	        $st_location_type = explode(',',$st_location_type );
        }*/


        if (!empty($st_location_type) and is_array($st_location_type)) {
            $tmp = array();
            foreach ($st_location_type as $key => $value) {
                $value = explode('/', $value);
                $tmp[] = $value;
            };
            $tmp_term  =array();
            $tmp_tax = array();
            if (!empty($tmp) and is_array($tmp)) {
                foreach ($tmp as $key => $value) {
                    if ($key== 0 or (!in_array($value[0], $tmp_tax))) {
                        $tmp_tax[] = $value[0];
                        $tmp_term[$value[0]] = array($value[1]);
                    }else {
                        if (in_array($value[0], $tmp_tax)) {
                            $type = $value[0] ;
                            $tmp_term[$type][] = $value[1];
                        }
                    }
                }
            };

            if (!empty($tmp_term) and is_array($tmp_term)){
                foreach ($tmp_term as $key => $value) {
                    $query['tax_query'][] = array(
                        'taxonomy'  => $key,
                        'field' => 'id' ,
                        'terms' => $value ,
                        'operator'  => "IN"
                    );
                }
                $query['tax_query']['relation'] = "AND";
            }

        }

        query_posts($query);
        $r =  st()->load_template('vc-elements/st-list-location/loop',$st_style,$data); ;
        wp_reset_query();
        return $r;
    }
    st_reg_shortcode('st_list_location','st_vc_list_location');

}
if(!function_exists( 'st_list_map_new' )) {
    function st_list_map_new( $attr , $content = false )
    {
        $data = shortcode_atts(
            array(
                'title'  => '' ,
                'st_list_location'  => '' ,
                'st_type'           => 'st_hotel' ,
                'zoom'              => '13' ,
                'height'            => '500' ,
                'number'            => '12' ,
                'style_map'         => 'normal' ,
                'show_circle' => 'no' ,
                'range' => '20' ,
            ) , $attr , 'st_list_map_new' );
        extract( $data );
        $st_type=explode(',',$st_type);
        $map_lat         = get_post_meta( $st_list_location , 'map_lat' , true );
        $map_lng         = get_post_meta( $st_list_location , 'map_lng' , true );
        $location_center = '[' . $map_lat . ',' . $map_lng . ']';
        $class_traveler = new TravelerObject();
        $data_post = $class_traveler->get_near_by_lat_lng($st_list_location , $map_lat,$map_lng,$st_type,$range,$number);



        global $post;
        $stt = 0;
        $data_map = array();
        if(!empty( $data_post )) {
            foreach( $data_post as $post ) :
                setup_postdata( $post );
                $map_lat = get_post_meta( get_the_ID() , 'map_lat' , true );
                $map_lng = get_post_meta( get_the_ID() , 'map_lng' , true );
                if(!empty( $map_lat ) and !empty( $map_lng ) and is_numeric( $map_lat ) and is_numeric( $map_lng )) {
                    $post_type                       = get_post_type();
                    $data_map[ $stt ][ 'id' ]        = get_the_ID();
                    $data_map[ $stt ][ 'name' ]      = get_the_title();
                    $data_map[ $stt ][ 'post_type' ] = $post_type;
                    $data_map[ $stt ][ 'lat' ]       = $map_lat;
                    $data_map[ $stt ][ 'lng' ]       = $map_lng;
                    $post_type_name                  = get_post_type_object( $post_type );
                    $post_type_name->label;
                    switch( $post_type ) {
                        case"st_hotel";
                            $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_hotel_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_black.png' );
                            $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                            $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                            break;
                        case"st_rental";
                            $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_rental_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_brown.png' );
                            $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                            $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                            break;
                        case"st_cars";
                            $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_cars_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_green.png' );
                            $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                            $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                            break;
                        case"st_tours";
                            $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_tours_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_purple.png' );
                            $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                            $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                            break;
                        case"st_activity";
                            $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_activity_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_yellow.png' );
                            $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                            $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                            break;
                    }
                    $stt++;
                }
            endforeach;
            wp_reset_postdata();

        }
        if($location_center =='[,]')$location_center='[0,0]';
        if($show_circle == 'no') {
            $range = 0;
        }
        $data_tmp = array(
            'location_center'  => $location_center ,
            'zoom'             => $zoom ,
            'data_map'         => $data_map ,
            'height'           => $height ,
            'style_map'        => $style_map ,
            'st_type'          => $st_type ,
            'number'           => $number ,
            'title'            => $title ,
            'range'           => $range ,
        );
        $data_tmp[ 'data_tmp' ] = $data_tmp;
        $html     = st()->load_template( 'vc-elements/st-list-map-new/html' , '' , $data_tmp );

        return $html;
    }
    st_reg_shortcode( 'st_list_map_new' , 'st_list_map_new' );

}
if (!function_exists('st_list_partner')) {
    function st_list_partner($arg)
    {
        wp_enqueue_script('owl-carousel.js');
        extract(
            wp_parse_args(
                $arg, array(
                    'style'        => '',
                    'items'        => 4,
                    'speed_slider' => 3000,
                    'autoplay'     => 'yes',
                )
            )
        );

        global $wpdb;

        $sql = "SELECT SQL_CALC_FOUND_ROWS
                {$wpdb->prefix}users.*, count(post.ID) AS services
            FROM
                {$wpdb->prefix}users
            INNER JOIN {$wpdb->prefix}usermeta ON (
                {$wpdb->prefix}users.ID = {$wpdb->prefix}usermeta.user_id
            )
            INNER JOIN {$wpdb->prefix}posts AS post ON (
                {$wpdb->prefix}users.ID = post.post_author
            )
            WHERE
                1 = 1
            AND (
                (
                    (
                        {$wpdb->prefix}usermeta.meta_key = '{$wpdb->prefix}capabilities'
                        AND {$wpdb->prefix}usermeta.meta_value LIKE '%partner%'
                    )
                )
            )
            AND post.post_type IN (
                'st_hotel',
                'hotel_room',
                'st_rental',
                'st_tours',
                'st_activity',
                'st_cars'
            )
            GROUP BY
                {$wpdb->prefix}users.ID
            ORDER BY
                user_login ASC";

        $results = $wpdb->get_results($sql);
        $html = '';
        if (!empty($results)) {
            $items = count($results);
	        $partner_page = st()->get_option('partner_info_page', '');
	        $author_link = '#';
            $html = "<div class='st_list_partner owl-theme' data-items ='" . $items . "' data-speed='" . $speed_slider . "' data-autoplay='" . $autoplay . "'>";
            foreach( $results as $key => $val){
	            if (!empty($partner_page)) {
		            $partner_link = get_permalink($partner_page);
		            $author_link = esc_url(add_query_arg(array('partner_id' => $val->ID), $partner_link));
	            } else {
		            $author_link = esc_url(get_author_posts_url($val->ID));
	            }
                $item_string = ($val->services <= 1) ? __(' service', ST_TEXTDOMAIN) : __(' services', ST_TEXTDOMAIN);
                $html .= '<div class="item st_tour_ver">
                    <a href="'. $author_link .'">
                    <div class="dummy">
                    <h4 class="title">' . $val->user_login . '</h4>
                    <div class="nums">' . $val->services . $item_string . '</div>
                    </div>
                    <div class="img-container">'. get_avatar($val->ID, 512, null, TravelHelper::get_alt_image() , array('class' => 'img-responsive')) . '</div>
                    </a>
                    </div>';
            }
            $html .= "</div> <div class='st_list_partner_nav' >
                <i class=' prev fa main-color  fa-angle-left box-icon-sm box-icon-border round'>  </i>
                <i class=' next fa main-color  fa-angle-right box-icon-sm box-icon-border round'>  </i>
                </div>";
            return $html;
        }
    }
    st_reg_shortcode('st_list_partner', 'st_list_partner');

}
if(!function_exists('st_vc_st_list_review')){
    function st_vc_st_list_review($arg,$content=false)
    {
        if(is_singular()){
            global $st_list_review_number;
            global $st_max_len;$st_max_len =100;
            $data = shortcode_atts(array(
                'st_style'=>'html',
                'number' =>5,
                'st_max_len'=> 150,
            ), $arg, 'st_list_review' );
            extract($data);
            $st_list_review_number = $number;

            ob_start();
            comments_template( '/st_templates/vc-elements/st-list-review/'.$st_style.'.php' );
            $html = @ob_get_clean();
            return $html;
        }

    }
    st_reg_shortcode('st_list_review','st_vc_st_list_review');

}
if(!function_exists('st_location_header_rate_count')){
    function st_location_header_rate_count($arg){

        $defaults = array(
            'post_type'=>'all',
        );
        $arg = wp_parse_args( $arg, $defaults );

        return st()->load_template('vc-elements/st-location/location' , 'header-rate-count' , $arg);
    }
    st_reg_shortcode('st_location_header_rate_count','st_location_header_rate_count' );
}
if(!function_exists('st_location_header_static')){
    function st_location_header_static($arg){
        $defaults = array(
            'post_type'=>'all',
            'star_list'=>'all'
        );
        $arg = wp_parse_args( $arg, $defaults );

        return st()->load_template('vc-elements/st-location/location' , 'header-static' , $arg);
    }
    st_reg_shortcode('st_location_header_static','st_location_header_static' );
}
if (!function_exists('st_location_infomation_func')){
    function st_location_infomation_func($attr){
        //wp_enqueue_script( 'fotorama.js' );
        return STLocation::get_slider($attr['st_location_list_image']);
    }
    st_reg_shortcode('st_location_slider','st_location_infomation_func' );

};
if (!function_exists('st_location_list_car_func')){
    function st_location_list_car_func($attr){
        global $st_search_args;
        $data = shortcode_atts(
            array(
                'st_location_style'=>"",
                'st_location_num'=>"",
                'st_location_orderby'=>"",
                'st_location_order'=>"",
                'st_location'=>get_the_ID()
            ), $attr, 'st_location_list_car' );
        extract($data);

        $st_search_args=$data;
        $return ="";

	    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        $query=array(
            'post_type' => 'st_cars',
            'posts_per_page'=>$st_location_num,
            'order'=>$st_location_order,
            'orderby'=>$st_location_orderby,
            'post_status'=>'publish',
            'paged' => $paged
        );

        if (STInput::request('style')){$st_location_style = STInput::request('style');};

        if ($st_location_style =="list"){
            $return .='<ul class="booking-list loop-cars style_list">' ;
        }else {
            $return .='<div class="row row-wrap">';
        }
        $cars=STCars::get_instance();
        $cars->alter_search_query();

        query_posts($query);

        while(have_posts()){
            the_post();
            if ($st_location_style =="list"){
                $return .=st()->load_template('cars/elements/loop/loop-1');
            }else {
                $return .=st()->load_template('cars/elements/loop/loop-2');
            }
        }
        $cars->remove_alter_search_query();
        $st_search_args=null;
        if ($st_location_style =="list"){
            $return .='</ul>' ;
        }else {
            $return .="</div>";
        }
	    ob_start();
	    TravelHelper::paging();
        $pag = ob_get_contents();
	    ob_clean();
	    ob_end_flush();
	    wp_reset_query();
	    return $return . '<div class="row">' . $pag . '</div>';
    }
    st_reg_shortcode('st_location_list_car','st_location_list_car_func' );
};
if (!function_exists('st_location_list_hotel_func')){
    function st_location_list_hotel_func($attr){
        global $st_search_args;
        $data = shortcode_atts(
            array(
                'st_location_style'=>"",
                'st_location_num'=>"",
                'st_location_orderby'=>"",
                'st_location_order'=>"",
                'st_location'=>get_the_ID()
            ), $attr, 'st_location_list_hotel' );
        extract($data);
        $st_search_args=$data;
        $hotel = STHotel::inst();
        $hotel->alter_search_query();
        $return = '' ;
        $query=array(
            'post_type' => 'st_hotel',
            'posts_per_page'=>$st_location_num,
            'order'=>$st_location_order,
            'orderby'=>$st_location_orderby,
            'post_status'=>'publish',
            'is_st_location_list_hotel' => '1'
        );
        $data['query'] = $query;
        $data['style'] =$st_location_style;
        $data['taxonomy']=FALSE;
        query_posts($query);
        if ( have_posts() ) :
            if($st_location_style=='grid'){
                $return.='<div class="row row-wrap loop_hotel loop_grid_hotel style_box">';
            }
            while ( have_posts() ) : the_post();
                switch($st_location_style){
                    case "grid":
                        $return .=st()->load_template('hotel/loop','grid',$data);
                        break;
                    default:
                        $return .=st()->load_template('hotel/loop','list',$data);
                        break;
                }
            endwhile;
            if($st_location_style=='grid'){
                $return.='</div>';
            }
        endif;
        $hotel->remove_alter_search_query();
        wp_reset_query();
        return $return;
    }
    st_reg_shortcode('st_location_list_hotel','st_location_list_hotel_func' );
};
if (!function_exists('st_location_list_tour_func')){
    function st_location_list_tour_func($attr){
        global $st_search_args;
        $data = shortcode_atts(
            array(
                'st_location_style'=>"",
                'st_location_num'=>"",
                'st_location_orderby'=>"",
                'st_location_order'=>"",
                'st_location'=>get_the_ID()
            ), $attr, 'st_location_list_tour' );
        extract($data);
        $st_search_args=$data;
        $return = '' ;
        $query=array(
            'post_type' => 'st_tours',
            'posts_per_page'=>$st_location_num,
            'order'=>$st_location_order,
            'orderby'=>$st_location_orderby,
            'post_status'=>'publish',
        );
        if (STInput::request('style')){$st_location_style = STInput::request('style');};
        if($st_location_style == 'list'){
            $return .="<ul class='booking-list loop-tours style_list loop-tours-location'>";
        }
        else{
            $return .='<div class="row row-wrap grid-tour-location">';
        }
        $tour = STTour::get_instance();
        $tour->alter_search_query();
        query_posts($query);
        while(have_posts()){
            the_post();
            if($st_location_style == 'list'){
                $return .=st()->load_template('tours/elements/loop/loop-1',null , array('tour_id'=>get_the_ID()));
            }
            else{
                $return .=  st()->load_template('tours/elements/loop/loop-2',null, array('tour_id'=>get_the_ID()));
            }
        }
        $tour->remove_alter_search_query();
        wp_reset_query();
        if($st_location_style == 'list'){
            $return .="</ul>";
        }
        else{
            $return .="</div>";
        }
        return $return ;
    }
    st_reg_shortcode('st_location_list_tour','st_location_list_tour_func' );
};
if (!function_exists('st_location_list_rental_func')){
    function st_location_list_rental_func($attr){

        global $st_search_args;
        $data = shortcode_atts(
            array(
                'st_location_style'=>"",
                'st_location_num'=>"",
                'st_location_orderby'=>"",
                'st_location_order'=>"",
                'st_location'=>get_the_ID()
            ), $attr, 'st_location_list_rental' );
        extract($data);
        $return = '' ;
        $st_search_args = $data;
        $query=array(
            'post_type' => 'st_rental',
            'posts_per_page'=>$st_location_num,
            'order'=>$st_location_order,
            'orderby'=>$st_location_orderby,
            'post_status'=>'publish',
        );
        $rental = STRental::inst();
        $rental->alter_search_query();
        query_posts($query);
        $data['style'] = $st_location_style ;
        if ( have_posts() ) :
            $return.=st()->load_template('rental/loop',FALSE,$data);
        endif;
        $rental->remove_alter_search_query();
        wp_reset_query();
        return $return ;
    }
    st_reg_shortcode('st_location_list_rental','st_location_list_rental_func' );
};
if (!function_exists('st_location_list_activity_func')){
    function st_location_list_activity_func($attr){
        global $st_search_args;
        $data = shortcode_atts(
            array(
                'st_location_style'=>"",
                'st_location_num'=>"",
                'st_location_orderby'=>"",
                'st_location_order'=>"",
                'st_location'=>get_the_ID()
            ), $attr, 'st_location_list_activity' );
        extract($data);
        $st_search_args = $data;
        $return = '' ;
        $query=array(
            'post_type' => 'st_activity',
            'posts_per_page'=>$st_location_num,
            'order'=>$st_location_order,
            'orderby'=>$st_location_orderby,
            'post_status'=>'publish',
        );
        if (STInput::request('style')){$st_location_style = STInput::request('style');};
        if($st_location_style == 'list'){
            $return .="<ul class='booking-list loop-tours style_list loop-activity-location'>";
        }
        else{
            $return .='<div class="row row-wrap grid-activity-location">';
        }
        $activity = STActivity::inst();
        $activity->alter_search_query();
        query_posts($query);
        while(have_posts()){
            the_post();
            if($st_location_style == 'list'){
                $return .=st()->load_template('activity/elements/loop/loop-1' ,null , array('is_location'=>true) );
            }
            else{
                $return .=st()->load_template('activity/elements/loop/loop-2' ,null , array('is_location'=>true) );
            }
        }
        $activity->remove_alter_search_query();
        wp_reset_query();
        if($st_location_style == 'list'){
            $return .="</ul>";
        }
        else{
            $return .='</div>';
        }
        return $return ;
    }
    st_reg_shortcode('st_location_list_activity','st_location_list_activity_func' );
};
if (!function_exists('st_location_map')){
    function st_location_map($attr){
        /**
         *
         * @since 1.2.4
         * @author quandq
         */
        if(!is_singular( 'location' )) {
            return false;
        }
        $data = shortcode_atts(
            array(
                'map_spots'=>"500",
            ), $attr, 'st_location_map' );
        extract($data);
        $map_location_style = get_post_meta(get_the_ID(),'map_location_style',true);
        if (!$map_location_style){$map_location_style = 'normal';}
        $zoom = get_post_meta( get_the_ID() , 'map_zoom' , true );
        if(empty( $zoom ) or !$zoom) {
            $zoom = 15;
        }
        $default = array(
            'tab_icon_'          => 'fa fa-map-marker' ,
            'map_height'         => 500 ,
            'map_spots'          => $map_spots ,
            'map_location_style' => 'normal' ,
            'tab_item_key'       => "location_map" ,
            'show_circle'        => ''
        );
        $data    = extract( wp_parse_args( $default , $attr ) );
        $st_type = array();
        if($is_hotel = st_check_service_available( 'st_hotel' )) {
            $st_type[ ] = 'st_hotel';
        }
        if($is_cars = st_check_service_available( 'st_cars' )) {
            $st_type[ ] = 'st_cars';
        }
        if($st_tours = st_check_service_available( 'st_tours' )) {
            $st_type[ ] = 'st_tours';
        }
        if($st_rental = st_check_service_available( 'st_rental' )) {
            $st_type[ ] = 'st_rental';
        }
        if($st_activity = st_check_service_available( 'st_activity' )) {
            $st_type[ ] = 'st_activity';
        }
        $map_lat                    = get_post_meta( get_the_ID() , 'map_lat' , true );
        $map_lng                    = get_post_meta( get_the_ID() , 'map_lng' , true );
        $location_center            = '[' . $map_lat . ',' . $map_lng . ']';
        $_SESSION[ 'el_post_type' ] = $st_type;
        $st_location                = new st_location();
        add_filter( 'posts_where' , array( $st_location , '_get_query_where' ) );
        $query = array(
            'post_type'      => $st_type ,
            'posts_per_page' => $map_spots ,
            'post_status'    => 'publish' ,
        );
        global $wp_query;
        query_posts( $query );
        unset( $_SESSION[ 'el_post_type' ] );
        remove_filter( 'posts_where' , array( $st_location , '_get_query_where' ) );
        $stt = 0;
        $data_map = array();
        while( have_posts() ) {
            the_post();
            $map_lat = get_post_meta( get_the_ID() , 'map_lat' , true );
            $map_lng = get_post_meta( get_the_ID() , 'map_lng' , true );
            if(!empty( $map_lat ) and !empty( $map_lng ) and is_numeric( $map_lat ) and is_numeric( $map_lng )) {
                $post_type                       = get_post_type();
                $data_map[ $stt ][ 'id' ]        = get_the_ID();
                $data_map[ $stt ][ 'name' ]      = get_the_title();
                $data_map[ $stt ][ 'post_type' ] = $post_type;
                $data_map[ $stt ][ 'lat' ]       = $map_lat;
                $data_map[ $stt ][ 'lng' ]       = $map_lng;
                $post_type_name                  = get_post_type_object( $post_type );
                $post_type_name->label;
                switch( $post_type ) {
                    case"st_hotel";
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_hotel_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_black.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                    case"st_rental";
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_rental_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_brown.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                    case"st_cars";
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_cars_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_green.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                    case"st_tours";
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_tours_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_purple.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                    case"st_activity";
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_activity_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_yellow.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                }
                $stt++;
            }
        }
        wp_reset_query();
        if(empty( $location_center ) or $location_center == '[,]')
            $location_center = '[0,0]';
        $data_tmp               = array(
            'location_center'    => $location_center ,
            'zoom'               => $zoom ,
            'data_map'           => $data_map ,
            'height'             => $map_height ,
            'style_map'          => $map_location_style ,
            'st_type'            => $st_type ,
            'number'             => $map_spots ,
            'show_search_box'    => 'no' ,
            'show_data_list_map' => 'no' ,
            'range'              => '0' ,
        );
        $data_tmp[ 'data_tmp' ] = $data_tmp;
        return "<div class='single_location'>".st()->load_template( 'vc-elements/st-list-map-new/html' , '' , $data_tmp )."</div>";
    }
    st_reg_shortcode('st_location_map' , 'st_location_map');
}
if (!function_exists('st_google_map_func')){
    function st_google_map_func($arg){
        wp_enqueue_script('gmap-init');

        extract(shortcode_atts(array(
            'address'=>'93 Worth St, New York, NY',
            'type'=>1,
            'marker'=>'',
            'height'=>'480',
            'lightness'=>0,
            'saturation'=>0,
            'gama'=>0.5,
            'zoom'=>13,
            'longitude'=>false,
            'latitude'=>false
        ),$arg));

        $marker_url = '';

        if($marker > 0 && $marker != ''){
            $image_attributes = wp_get_attachment_image_src( $marker, 'full' );
            if(!empty($image_attributes)){
                $marker_url = $image_attributes[0];
            }
        }
        return "<div class='map_wrap'><div data-type='{$type}' data-lat='{$latitude}' data-lng='{$longitude}' data-zoom='{$zoom}' style='height: {$height}px' data-lightness='{$lightness}' data-saturation='{$saturation}' data-gama='{$gama}'  class='st_google_map' data-address='{$address}' data-marker='{$marker_url}'>
                            </div></div>";
    }
    st_reg_shortcode('st_google_map' , 'st_google_map_func');

    if ( class_exists( 'WPBakeryShortCodesContainer' ) and !class_exists('WPBakeryShortCode_st_google_map')) {
        class WPBakeryShortCode_st_google_map extends WPBakeryShortCodesContainer {
            protected function content($arg, $content = null) {

                return st_reg_shortcode($arg,$content);
            }
        }
    }
}


if(!function_exists('st_room_map_fc')){
    function st_room_map_fc($attr = array(), $content = null){
        $default = array(
            'number'      => '12' ,
            'range'       => '20' ,
            'show_circle' => 'no' ,
        );
        extract( $dump = wp_parse_args( $attr , $default ) );
        $hotel_id = get_post_meta(get_the_ID(), 'room_parent', true );
        if(!empty($hotel_id) and is_singular('hotel_room' ) || is_singular('rental_room')){
            $lat   = get_post_meta( $hotel_id , 'map_lat' , true );
            $lng   = get_post_meta( $hotel_id , 'map_lng' , true );
            $zoom  = get_post_meta( $hotel_id , 'map_zoom' , true );
            if( get_post_type() =='st_hotel'){
                $class = new STHotel();
            }else{
                $class = new STRental();
            }
            $data  = $class->get_near_by( $hotel_id , $range , $number );
            $location_center                     = '[' . $lat . ',' . $lng . ']';
            $data_map                            = array();
            $data_map[ 0 ][ 'id' ]               = $hotel_id;
            $data_map[ 0 ][ 'name' ]             = get_the_title();
            $data_map[ 0 ][ 'post_type' ]        = get_post_type();
            $data_map[ 0 ][ 'lat' ]              = $lat;
            $data_map[ 0 ][ 'lng' ]              = $lng;
            $data_map[ 0 ][ 'icon_mk' ]          = get_template_directory_uri() . '/img/mk-single.png';
            $data_map[ 0 ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/room' , false , array( 'hotel_id' => $hotel_id ) ) );
            $data_map[ 0 ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/room' , false , array( 'hotel_id' => $hotel_id ) ) );
            $stt                                 = 1;
            global $post;
            if(!empty( $data )) {
                foreach( $data as $post ) :
                    setup_postdata( $post );
                    $map_lat = get_post_meta( get_the_ID() , 'map_lat' , true );
                    $map_lng = get_post_meta( get_the_ID() , 'map_lng' , true );
                    if(!empty( $map_lat ) and !empty( $map_lng ) and is_numeric( $map_lat ) and is_numeric( $map_lng )) {
                        $post_type                              = get_post_type();
                        $data_map[ $stt ][ 'id' ]               = get_the_ID();
                        $data_map[ $stt ][ 'name' ]             = get_the_title();
                        $data_map[ $stt ][ 'post_type' ]        = $post_type;
                        $data_map[ $stt ][ 'lat' ]              = $map_lat;
                        $data_map[ $stt ][ 'lng' ]              = $map_lng;
                        if($post_type == 'st_hotel'){
                            $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_hotel_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_yellow.png' );

                        }else{
                            $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_rental_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_yellow.png' );
                        }
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/room' , false , array( 'hotel_id' => $hotel_id ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/room' , false , array( 'hotel_id' => $hotel_id ) ) );
                        $stt++;
                    }
                endforeach;
                wp_reset_postdata();
            }
            if($location_center == '[,]')
                $location_center = '[0,0]';
            if($show_circle == 'no') {
                $range = 0;
            }
            $data_tmp               = array(
                'location_center' => $location_center ,
                'zoom'            => $zoom ,
                'data_map'        => $data_map ,
                'height'          => 500 ,
                'style_map'       => 'normal' ,
                'number'          => $number ,
                'range'           => $range ,
                'hotel_id'           => $hotel_id ,
            );
            $data_tmp[ 'data_tmp' ] = $data_tmp;
            $html                   = '<div class="map_single">'.st()->load_template( 'hotel/elements/detail' , 'map' , $data_tmp ).'</div>';
            return $html;
        }
    }
    st_reg_shortcode( 'st_room_map' , 'st_room_map_fc' );

}
if(!function_exists('st_progress_bar_func')){
    function st_progress_bar_func($arg = array(), $content = null){
        extract(wp_parse_args($arg,array('style'=>'')));
        $content_data= st_remove_wpautop($content);
        return "<div class='st_progress_bar'>".$content_data."</div>";

    }
    st_reg_shortcode( 'st_progress_bar' , 'st_progress_bar_func' );
    if ( class_exists( 'WPBakeryShortCodesContainer' ) and !class_exists('WPBakeryShortCode_st_progress_bar')) {
        class WPBakeryShortCode_st_progress_bar extends WPBakeryShortCodesContainer {
            protected function content($arg, $content = null) {
                return st_progress_bar_func($arg,$content);
            }
        }
    }
}
if(!function_exists('st_progress_bar_item_func')){
    function st_progress_bar_item_func($arg = array(), $content = null){
        extract(wp_parse_args($arg,array('st_title'=>'','value'=>'')));
        $return = "";
        if (!empty($st_title) and !empty($value)){
            $bgr_main_width = (((int)$value<=100)?(int)$value : 100) ."%";
            $main_color = ($value<100) ? "main-color" : "white";
            $return .="<div class='st_progress_bar_item row'>";
            $return .="<div class='col-xs-12 col-lg-3'>".$st_title."</div>";
            $return .=" <div class='col-xs-12 col-lg-9'>
 <div class='st_tour_ver'>
 <div class='value ".$main_color."'>".$bgr_main_width."</div>
 <div class='bgr-main' style='width:".$bgr_main_width."'></div>
 </div>
 </div>";
            $return .="</div>";
        }
        return $return ;

    }
    st_reg_shortcode( 'st_progress_bar_item' , 'st_progress_bar_item_func' );
}

if(!function_exists('st_vc_promotion')){
    function st_vc_promotion($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_icon'=>'',
                'st_discount' =>0,
                'st_bg'=>'',
                'st_bg_img'=>'',
                'st_opacity'=>'',
                'st_title'=>'',
                'st_sub'=>'',
                'st_link'=>'',
            ), $attr, 'st_promotion' );
        extract($data);
        return st()->load_template('vc-elements/st-promotion/html',false,$data);
    }
    st_reg_shortcode('st_promotion','st_vc_promotion');
}
if(!function_exists('st_vc_rating_count')){
    function st_vc_rating_count($attr)
    {
        extract(wp_parse_args($attr,array('st_icon'=>'fa-flag')));
        $return ="<div class='st_tour_ver st_rating_count'>";
        $return .="<i class='color-main fa ".$st_icon."'></i>";
        $avg=STReview::get_avg_rate();
        $return .= "<div class='st_rating_count_inner main-color text-right'><b>"; // start inner
        if($avg<=4){
            $return .= __('Good', ST_TEXTDOMAIN) ;
        }elseif($avg<=5){
            $return .= __('Best', ST_TEXTDOMAIN) ;
        }
        $return .= " ".esc_attr($avg*2)."<small>/10</small>";
        $return .= "</b><br>";
        $reviews = STReview::count_comment(get_the_ID(),'st_reviews');
        if ($reviews==1) $return .= "<i>". sprintf("from %s review",$reviews, ST_TEXTDOMAIN)."</i>";
        if ($reviews>1) $return .= "<i>". sprintf("from %s reviews",$reviews, ST_TEXTDOMAIN)."</i>";
        $return .= "</div>"; // end inner
        $return .="</div>";
        return $return ;
    }
    st_reg_shortcode('st_rating_count','st_vc_rating_count');
}
if(!function_exists('st_vc_search')){
    function st_vc_search($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_style_search' =>'style_1',
                'st_box_shadow'=>'no',
                'field_size'    => 'lg',
                'tabs_search' => 'all'
            ), $attr, 'st_search' );
        extract($data);
        $txt = st()->load_template('vc-elements/st-search/search','form',array('data'=>$data));
        return $txt;
    }
    st_reg_shortcode('st_search','st_vc_search');
}
if(!function_exists('st_search_filter_func'))
{
    function st_search_filter_func( $arg , $content = null )
    {
        $data = shortcode_atts( array(
            'title' => "" ,
            'style' => "" ,
        ) , $arg , 'st_search_filter' );

        extract( $data );

        $content = do_shortcode( $content );
        if($style == 'dark') {
            $class_side_bar = 'booking-filters text-white';
        } else {
            $class_side_bar = 'booking-filters booking-filters-white';
        }
        $html = '<aside class="st-elements-filters ' . $class_side_bar . '">
                        <h3>' . $title . '</h3>
                        <ul class="list booking-filters-list">' . $content . '</ul>
                    </aside>';
        return $html;
    }
    st_reg_shortcode('st_search_filter','st_search_filter_func');

    if(class_exists( 'WPBakeryShortCodesContainer' ) and !class_exists( 'WPBakeryShortCode_st_search_filter' )) {
        class WPBakeryShortCode_st_search_filter extends WPBakeryShortCodesContainer
        {
            protected function content( $arg , $content = null )
            {
                return st_search_filter_func($arg,$content);
            }
        }
    }
}
if(!function_exists('st_filter_price_func'))
{
    function st_filter_price_func( $arg , $content = null )
    {
        $data = shortcode_atts( array(
            'title'     => "" ,
            'post_type' => "" ,
        ) , $arg , 'st_filter_price' );
        extract( $data );
        $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st()->load_template( 'vc-elements/st-search-filter/filter' , 'price' , array( 'post_type' => $post_type ) ) . '</li>';
        return $html;
    }
    st_reg_shortcode('st_filter_price','st_filter_price_func');
}
if(!function_exists('st_filter_rate_func'))
{
    function st_filter_rate_func( $arg , $content = null )
    {
        $data = shortcode_atts( array(
            'title' => "" ,
        ) , $arg , 'st_filter_rate' );
        extract( $data );
        $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st()->load_template( 'vc-elements/st-search-filter/filter' , 'rate' , array() ) . '</li>';
        return $html;
    }
    st_reg_shortcode('st_filter_rate','st_filter_rate_func');
}

if(!function_exists('st_filter_hotel_rate_func'))
{
    function st_filter_hotel_rate_func( $arg , $content = null )
    {
        $data = shortcode_atts( array(
            'title' => "" ,
        ) , $arg , 'st_filter_hotel_rate' );
        extract( $data );
        $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st()->load_template( 'vc-elements/st-search-filter/filter' , 'hotel-rate' , array() ) . '</li>';
        return $html;
    }
    st_reg_shortcode('st_filter_hotel_rate','st_filter_hotel_rate_func');
}

if(!function_exists('st_filter_taxonomy_func'))
{
    function st_filter_taxonomy_func( $arg , $content = null )
    {
        $data = shortcode_atts( array(
            'title'                => "" ,
            'st_post_type'            => "" ,
            'taxonomy_st_hotel'    => "" ,
            'taxonomy_st_rental'   => "" ,
            'taxonomy_st_cars'     => "" ,
            'taxonomy_st_tours'    => "" ,
            'taxonomy_st_activity' => "" ,
            'taxonomy_hotel_room' => "" ,
        ) , $arg , 'st_filter_taxonomy' );
        extract( $data );
        $taxonomy = '';
        switch($st_post_type){
            case"st_hotel":
                $taxonomy =$taxonomy_st_hotel;
                break;
            case"st_rental":
                $taxonomy =$taxonomy_st_rental;
                break;
            case"st_cars":
                $taxonomy =$taxonomy_st_cars;
                break;
            case"st_tours":
                $taxonomy =$taxonomy_st_tours;
                break;
            case"st_activity":
                $taxonomy =$taxonomy_st_activity;
                break;
            case"hotel_room":
                $taxonomy =$taxonomy_hotel_room;
                break;
        }
        $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st()->load_template( 'vc-elements/st-search-filter/filter' , 'taxonomy' ,  array('taxonomy'=>$taxonomy,'post_type'=>$st_post_type) ) . '</li>';
        return $html;
    }
    st_reg_shortcode('st_filter_taxonomy','st_filter_taxonomy_func');
}

if(!function_exists('st_search_filter_ajax_func'))
{
    function st_search_filter_ajax_func( $arg , $content = null )
    {
        $data = shortcode_atts( array(
            'title' => "" ,
            'style' => "" ,
        ) , $arg , 'st_search_filter_ajax' );
        extract( $data );
        $content = do_shortcode( $content );
        if($style == 'dark') {
            $class_side_bar = 'booking-filters text-white';
        } else {
            $class_side_bar = 'booking-filters booking-filters-white';
        }
        $html = '<aside class="st-elements-filters ' . $class_side_bar . '">
                        <h3>' . $title . '</h3>
                        <ul class="list booking-filters-list">' . $content . '</ul>
                    </aside>';
        return $html;
    }
    st_reg_shortcode('st_search_filter_ajax','st_search_filter_ajax_func');
    if(class_exists( 'WPBakeryShortCodesContainer' ) and !class_exists( 'WPBakeryShortCode_st_search_filter_ajax' )) {
        class WPBakeryShortCode_st_search_filter_ajax extends WPBakeryShortCodesContainer
        {
            protected function content( $arg , $content = null )
            {
                return st_search_filter_ajax_func($arg,$content);
            }
        }
    }
}

if(!function_exists('st_filter_price_ajax_func'))
{
    function st_filter_price_ajax_func( $arg , $content = null )
    {
        $data = shortcode_atts( array(
            'title'     => "" ,
            'post_type' => "" ,
        ) , $arg , 'st_filter_price_ajax' );
        extract( $data );
        $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st()->load_template( 'vc-elements/st-search-filter-ajax/filter' , 'price' , array( 'post_type' => $post_type ) ) . '</li>';
        return $html;
    }
    st_reg_shortcode('st_filter_price_ajax','st_filter_price_ajax_func');
}

if(!function_exists('st_filter_rate_ajax_func'))
{
    function st_filter_rate_ajax_func( $arg , $content = null )
    {
        $data = shortcode_atts( array(
            'title' => "" ,
        ) , $arg , 'st_filter_rate_ajax' );
        extract( $data );
        $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st()->load_template( 'vc-elements/st-search-filter-ajax/filter' , 'rate' , array() ) . '</li>';
        return $html;
    }
    st_reg_shortcode('st_filter_rate_ajax','st_filter_rate_ajax_func');
}

if(!function_exists('st_filter_hotel_rate_ajax_func'))
{
    function st_filter_hotel_rate_ajax_func( $arg , $content = null )
    {
        $data = shortcode_atts( array(
            'title' => "" ,
        ) , $arg , 'st_filter_hotel_rate_ajax' );
        extract( $data );
        $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st()->load_template( 'vc-elements/st-search-filter-ajax/filter' , 'hotel-rate' , array() ) . '</li>';
        return $html;
    }
    st_reg_shortcode('st_filter_hotel_rate_ajax','st_filter_hotel_rate_ajax_func');
}

if(!function_exists('st_filter_taxonomy_ajax_func'))
{
    function st_filter_taxonomy_ajax_func( $arg , $content = null )
    {
        $data = shortcode_atts( array(
            'title'                => "" ,
            'st_post_type'            => "" ,
            'taxonomy_st_hotel'    => "" ,
            'taxonomy_st_rental'   => "" ,
            'taxonomy_st_cars'     => "" ,
            'taxonomy_st_tours'    => "" ,
            'taxonomy_st_activity' => "" ,
            'taxonomy_hotel_room' => "" ,
        ) , $arg , 'st_filter_taxonomy_ajax' );
        extract( $data );
        switch($st_post_type){
            case"st_hotel":
                $taxonomy =$taxonomy_st_hotel;
                break;
            case"st_rental":
                $taxonomy =$taxonomy_st_rental;
                break;
            case"st_cars":
                $taxonomy =$taxonomy_st_cars;
                break;
            case"st_tours":
                $taxonomy =$taxonomy_st_tours;
                break;
            case"st_activity":
                $taxonomy =$taxonomy_st_activity;
                break;
            case"hotel_room":
                $taxonomy =$taxonomy_hotel_room;
                break;
        }
        $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st()->load_template( 'vc-elements/st-search-filter-ajax/filter' , 'taxonomy' ,  array('taxonomy'=>$taxonomy,'post_type'=>$st_post_type) ) . '</li>';
        return $html;
    }
    st_reg_shortcode('st_filter_taxonomy_ajax','st_filter_taxonomy_ajax_func');
}

if(!function_exists('st_search_form_func'))
{
    function st_search_form_func( $arg , $content = null )
    {
        $data = shortcode_atts(array(
            'st_title_form'=>'',
            'st_post_type'=>"st_hotel",
            'st_button_search'=>__("Search",ST_TEXTDOMAIN)
        ), $arg,'st_search_form');
        extract($data);
        $content = st_remove_wpautop($content);
        $text='  <h2>'.$st_title_form.'</h2>
                         <form role="search" method="get" class="search main-search" action="'.home_url( '/' ).'">
                                '.TravelHelper::get_input_multilingual_wpml().'
                                <input type="hidden" name="s" value="">
                                <input type="hidden" name="post_type" value="'.$st_post_type.'">
                                <input type="hidden" name="layout" value="'.STInput::get('layout').'">
                                   <div class="row">'.$content.'</div>
                                <button class="btn btn-primary btn-lg" type="submit">'.$st_button_search.'</button>
                         </form>';
        return $text;
    }
    st_reg_shortcode('st_search_form','st_search_form_func');
    if ( class_exists( 'WPBakeryShortCodesContainer' ) and !class_exists('WPBakeryShortCode_st_search_form')) {
        class WPBakeryShortCode_st_search_form extends WPBakeryShortCodesContainer {
            protected function content($arg, $content = null) {
                return st_search_form_func($arg,$content);
            }
        }
    }
}

if(!function_exists('st_search_field_hotel_func'))
{
    function st_search_field_hotel_func( $arg , $content = null )
    {
        $data = shortcode_atts(array(
            'st_title'=>'',
            'st_col'=>"col-md-1",
            'st_select_field'=>"st_hotel",
            'st_select_taxonomy'=>"",
        ), $arg,'st_search_field_hotel');
        extract($data);

        $default =array(
            'title'=>$st_title,
            'taxonomy'=>$st_select_taxonomy
        );
        $text = '<div class="'.$st_col.'">
                            '.st()->load_template('hotel/elements/search/field_'.$st_select_field,false,array('data'=>$default,'field_size'=>'lg')).'
                        </div>';
        return $text;
    }
    st_reg_shortcode('st_search_field_hotel','st_search_field_hotel_func');
}

if(!function_exists('st_search_field_rental_func'))
{
    function st_search_field_rental_func( $arg , $content = null )
    {
        $data = shortcode_atts(array(
            'st_title'=>'',
            'st_col'=>"col-md-1",
            'st_select_field'=>"st_hotel",
            'st_select_taxonomy'=>"",
        ), $arg,'st_search_field_rental');
        extract($data);

        $default =array(
            'title'=>$st_title,
            'taxonomy'=>$st_select_taxonomy
        );
        $text = '<div class="'.$st_col.'">
                            '.st()->load_template('rental/elements/search/field_'.$st_select_field,false,array('data'=>$default,'field_size'=>'lg')).'
                        </div>';
        return $text;
    }
    st_reg_shortcode('st_search_field_rental','st_search_field_rental_func');
}

if(!function_exists('st_search_field_car_func'))
{
    function st_search_field_car_func( $arg , $content = null )
    {
        $data = shortcode_atts(array(
            'st_title'=>'',
            'st_col'=>"col-md-1",
            'st_select_field'=>"st_hotel",
            'st_select_taxonomy'=>"",
        ), $arg,'st_search_field_car');
        extract($data);

        $default =array(
            'title'=>$st_title,
            'taxonomy'=>$st_select_taxonomy
        );
        $text = '<div class="'.$st_col.'">
                            '.st()->load_template('cars/elements/search/field-'.$st_select_field,false,array('data'=>$default,'field_size'=>'lg')).'
                        </div>';
        return $text;
    }
    st_reg_shortcode('st_search_field_car','st_search_field_car_func');
}
if(!function_exists('st_search_field_tour_func'))
{
    function st_search_field_tour_func( $arg , $content = null )
    {
        $data = shortcode_atts(array(
            'st_title'=>'',
            'st_col'=>"col-md-1",
            'st_select_field'=>"st_hotel",
            'st_select_taxonomy'=>"",
        ), $arg,'st_search_field_tour');
        extract($data);

        $default =array(
            'title'=>$st_title,
            'taxonomy'=>$st_select_taxonomy
        );
        $text = '<div class="'.$st_col.'">
                            '.st()->load_template('tours/elements/search/field-'.$st_select_field,false,array('data'=>$default,'field_size'=>'lg')).'
                        </div>';
        return $text;
    }
    st_reg_shortcode('st_search_field_tour','st_search_field_tour_func');
}
if(!function_exists('st_search_field_activity_func'))
{
    function st_search_field_activity_func( $arg , $content = null )
    {
        $data = shortcode_atts(array(
            'st_title'=>'',
            'st_col'=>"col-md-1",
            'st_select_field'=>"st_hotel",
            'st_select_taxonomy'=>"",
        ), $arg,'st_search_field_activity');
        extract($data);

        $default =array(
            'title'=>$st_title,
            'taxonomy'=>$st_select_taxonomy
        );
        $text = '<div class="'.$st_col.'">
                            '.st()->load_template('activity/elements/search/field-'.$st_select_field,false,array('data'=>$default,'field_size'=>'lg')).'
                        </div>';
        return $text;
    }
    st_reg_shortcode('st_search_field_activity','st_search_field_activity_func');
}

if(!function_exists('st_vc_simple_location')){
    function st_vc_simple_location($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_type' => 'st_hotel',
                'st_list_location' =>0,
                'st_list_location_2'=>0
            ), $attr, 'st_simple_location' );

        extract($data);

        if(!empty($st_list_location)){

            $ids = explode(',',$st_list_location);
        }
        if(!empty($st_list_location_2)){

            $ids = array($st_list_location_2);
        }
        $query=array(
            'post_type' => 'location',
            'post__in'  => $ids
        );
        query_posts($query);
        $r = '';
        while(have_posts()){
            the_post();
            $r =  st()->load_template('vc-elements/st-simple-location/html',null,$data);

        }
        wp_reset_query(); wp_reset_postdata();
        return $r;
    }
    st_reg_shortcode('st_simple_location','st_vc_simple_location');
}
if(!function_exists('st_vc_single_search')){
    function st_vc_single_search($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_list_form'=>'',
                'st_style_search' =>'style_1',
                'st_direction'=>'horizontal',
                'st_box_shadow'=>'no',
                'st_search_tabs'=>'yes',
                'st_title_search'=>'',
                'field_size'    =>'lg',
                'active'            =>1
            ), $attr, 'st_single_search' );
        extract($data);
        $txt = st()->load_template('vc-elements/st-single-search/search','form',array('data'=>$data));
        return $txt;
    }
    st_reg_shortcode('st_single_search','st_vc_single_search');
}
if(!function_exists('st_vc_slide_location')){
    function st_vc_slide_location($attr,$content=false)
    {
        wp_enqueue_script( 'owl-carousel.js' );

        $data = shortcode_atts(
            array(
                'st_type'=>'st_hotel',
                'is_featured' =>'no',
                'st_number' =>4,
                'st_list_location' =>0,
                'st_weather'=>'no',
                'st_style'=>'style_1',
                'st_height'=>'full',
                'effect'=>'fade',
                'link_to'=>'page_search',
                'st_location_type'=> '',
                'title'=>__("Find Your Perfect Trip",ST_TEXTDOMAIN),
                'opacity'=>'0.5',
                'tabs_search' => 'all'

            ), $attr, 'st_slide_location' );
        extract($data);
        $query=array(
            'post_type' => 'location',
            'posts_per_page' => -1 ,
        );
        if($is_featured == 'yes'){
            $query['posts_per_page']= $st_number;
            $query['orderby']='meta_value_num';
            $query['meta_query']=array(
                array(
                    'key'     => 'is_featured',
                    'value'   => 'on',
                    'compare' => '=',
                ),
            );
        }else{
            $ids = explode(',',$st_list_location);
            if (is_array($ids)){
                $query['post__in']= $ids ;
            }
        }
        $st_location_type = array();
        $list_terms = STLocation::get_location_terms();
        if(!empty($list_terms) and is_array($list_terms)) {
            foreach ($list_terms as $key => $value) {
                $st_location_type[$value->name] = $value->taxonomy."/".$value->term_id;
            }
        }
        
        if ($st_location_type) {
            $tax_query = array();
            if(!is_array($st_location_type)) {
	            $st_location_type = explode( ',', $st_location_type );
            }
            $tmp = array();
            if (!empty($st_location_type) and is_array($st_location_type)) {
                foreach ($st_location_type as $key => $value) {
                    $value = explode('/', $value);
                    $tmp[] = $value;
                };
            }
            $tmp_term  =array();
            $tmp_tax = array();
            if (!empty($tmp) and is_array($tmp)) {
                foreach ($tmp as $key => $value) {
                    if ($key== 0 or (!in_array($value[0], $tmp_tax))) {
                        $tmp_tax[] = $value[0];
                        $tmp_term[$value[0]] = array($value[1]);
                    }else {
                        if (in_array($value[0], $tmp_tax)) {
                            $type = $value[0] ;
                            $tmp_term[$type][] = $value[1];
                        }
                    }
                }
            };
            if (!empty($tmp_term) and is_array($tmp_term)){
                foreach ($tmp_term as $key => $value) {
                    $query['tax_query'][] = array(
                        'taxonomy'  => $key,
                        'field' => 'id' ,
                        'terms' => $value ,
                        'operator'  => "IN"
                    );
                }
                $query['tax_query']['relation'] = "AND";
            }

        }
        query_posts($query);
        
        $txt='';
        while(have_posts()){
            the_post();
            if($st_style == 'style_1'){
                $txt .= st()->load_template('vc-elements/st-slide-location/loop-style','1',$data);
            }
            if($st_style == 'style_2'){
                $txt .= st()->load_template('vc-elements/st-slide-location/loop-style','2',$data);
            }

        }
        wp_reset_query();
        if($st_height == 'full'){
            $class = 'top-area show-onload';
        }else{
            $class = 'special-area';
        }


        if($st_style == 'style_1') {
            $r = '<div class="'.$class.'">
                    <div class="owl-carousel owl-slider owl-carousel-area" id="owl-carousel-slider" data-effect="'.$effect.'">
                    ' . $txt . '
                    </div>
                  </div>';
        }
        $bgr = "";
        if (!empty($ids[0])){
            $bgr_url = wp_get_attachment_image_src(get_post_thumbnail_id($ids[0]), 'full');
            $bgr_url= $bgr_url[0];
            $bgr = " style='background-image: url(".$bgr_url.")'";
        }

        if($st_style == 'style_2') {
            $r = '<div class="'.$class.'">
                <div class="bg-holder full st-slider-location"'.$bgr.' >
                    <div class="bg-front bg-front-mob-rel">
                        <div class="container">
                        '.st()->load_template('vc-elements/st-search/search','form',array('st_style_search' =>'style_2', 'st_box_shadow'=>'no' ,'class'=>'search-tabs-abs mt50','title'=>$data['title'], 'tabs_search' => $tabs_search) ).'
                        </div>
                    </div>
                    <div class="owl-carousel owl-slider owl-carousel-area visible-lg" id="owl-carousel-slider" data-effect="'.$effect.'">
                      '.$txt.'
                    </div>
                </div>
            </div>';
        }
        if(empty($txt)){
            $r="";
        }
        return $r;
    }
    st_reg_shortcode('st_slide_location','st_vc_slide_location');
}
if(!function_exists('st_slide_testimonial_func')){
    function st_slide_testimonial_func($arg,$content=false)
    {
        global $st_opacity;
        wp_enqueue_script( 'owl-carousel.js' );
        wp_enqueue_script( 'testimonial' );

        $data = shortcode_atts(
            array(
                'effect' =>'fade',
                'st_speed' =>500,
                'st_play' => 4500,
                'is_form'   => 'yes',
                'is_bgr'    => 'yes',
                'items_per_row'=> 1,
                'navigation' =>'true',
                'opacity'=>'0.5',
                'tabs_search' => ''
            ), $arg, 'st_slide_testimonial' );
        extract($data);
        $st_opacity = $opacity;
        $content = do_shortcode($content);
        $bgr_class = ($is_bgr =='no') ? 'transparent' : "";
        $form_class = ($is_form =='yes')? "is_form" : "no_form";
        $r =  '<!-- TOP AREA -->
                <div class="top-area show-onload '.$form_class.'">
                    <div class="bg-holder full">';
        if ($is_form !=='no'){
            $r.='<div class="bg-front bg-front-mob-rel">
                            <div class="container" style="position: relative">
                                 '.st()->load_template('vc-elements/st-search/search','form',array('st_style_search' =>'style_1', 'st_box_shadow'=>'no' ,'class'=>'search-tabs-abs-bottom', 'tabs_search' => $tabs_search) ).'
                             </div>
                        </div>';
        }
        $r.='<div class=" '.$bgr_class.' owl-carousel owl-slider owl-carousel-area " id="slide-testimonial" data-navigation ="'.$navigation.'" data-items="'.$items_per_row.'" data-speed="'.$st_speed.'" data-play="'.$st_play.'" data-effect="'.$effect.'">
                          '.$content.'
                        </div>
                    </div>
                </div>
                <!-- END TOP AREA  -->';
        unset($st_opacity);
        return $r;
    }
    st_reg_shortcode('st_slide_testimonial','st_slide_testimonial_func');

    if ( class_exists( 'WPBakeryShortCodesContainer' ) and !class_exists('WPBakeryShortCode_st_slide_testimonial') ) {
        class WPBakeryShortCode_st_slide_testimonial extends WPBakeryShortCodesContainer {
            protected function content($arg, $content = null) {
                return st_slide_testimonial_func($arg,$content);
            }
        }
    }
}
if(!function_exists('st_slide_testimonial_func')){
    function st_slide_testimonial_func($arg,$content=false)
    {
        global $st_opacity;
        wp_enqueue_script( 'owl-carousel.js' );
        wp_enqueue_script( 'testimonial' );

        $data = shortcode_atts(
            array(
                'effect' =>'fade',
                'st_speed' =>500,
                'st_play' => 4500,
                'is_form'   => 'yes',
                'is_bgr'    => 'yes',
                'items_per_row'=> 1,
                'navigation' =>'true',
                'opacity'=>'0.5',
                'tabs_search' => ''
            ), $arg, 'st_slide_testimonial' );
        extract($data);
        $st_opacity = $opacity;
        $content = do_shortcode($content);
        $bgr_class = ($is_bgr =='no') ? 'transparent' : "";
        $form_class = ($is_form =='yes')? "is_form" : "no_form";
        $r =  '<!-- TOP AREA -->
                <div class="top-area show-onload '.$form_class.'">
                    <div class="bg-holder full">';
        if ($is_form !=='no'){
            $r.='<div class="bg-front bg-front-mob-rel">
                            <div class="container" style="position: relative">
                                 '.st()->load_template('vc-elements/st-search/search','form',array('st_style_search' =>'style_1', 'st_box_shadow'=>'no' ,'class'=>'search-tabs-abs-bottom', 'tabs_search' => $tabs_search) ).'
                             </div>
                        </div>';
        }
        $r.='<div class=" '.$bgr_class.' owl-carousel owl-slider owl-carousel-area " id="slide-testimonial" data-navigation ="'.$navigation.'" data-items="'.$items_per_row.'" data-speed="'.$st_speed.'" data-play="'.$st_play.'" data-effect="'.$effect.'">
                          '.$content.'
                        </div>
                    </div>
                </div>
                <!-- END TOP AREA  -->';
        unset($st_opacity);
        return $r;
    }
    st_reg_shortcode('st_slide_testimonial','st_slide_testimonial_func');

    if ( class_exists( 'WPBakeryShortCodesContainer' ) and !class_exists('WPBakeryShortCode_st_slide_testimonial') ) {
        class WPBakeryShortCode_st_slide_testimonial extends WPBakeryShortCodesContainer {
            protected function content($arg, $content = null) {
                return st_slide_testimonial_func($arg,$content);
            }
        }
    }
}
if(!function_exists('st_testimonial_item_func')){
    function st_testimonial_item_func($arg,$content=false)
    {
        global $st_opacity;
        $data = shortcode_atts(
            array(
                'st_avatar' =>0,
                'st_name' => 0,
                'st_sub'=>'',
                'st_desc'=>'',
                'st_bg'=>'',
                'st_pos'=>'',
                'opacity'=>$st_opacity
            ), $arg, 'st_testimonial_item' );
        extract($data);
        $text = st()->load_template('vc-elements/st-slide-testimonial/loop',false,$data);
        return $text;
    }
    st_reg_shortcode('st_testimonial_item','st_testimonial_item_func');
}
if(!function_exists('st_tab_func')){
    function st_tab_func($arg,$content=false)
    {
        extract(wp_parse_args($arg,array('style'=>'')));
        $r ="";
        global $st_title_tb;$st_title_tb="";
        global $i_tab;$i_tab=0;
        global $id_rand ; $id_rand = rand();
        $content_data= st_remove_wpautop($content);
        $id = rand();
        if ($style == 'vertical'){
            $style.= " st_tour_ver" ;
            $r .= '<div class="st_tab '.$style.' tabbable st_tab_'.esc_attr($id_rand).'" style="">
                            <div class="row">
                                <div class="col-md-3 col-xs-12">
                                    <ul id="myTab'.$id.'" class="nav nav-tabs myTab">
                                      '.$st_title_tb.'
                                    </ul>
                                </div>
                                <div class="col-md-9 col-xs-12">
                                    <div id="myTabContent'.$id.'" class="tab-content">
                                      '.$content_data.'
                                    </div>
                                </div>
                            </div>
                        </div>';
            return $r;
        }
        if (!empty($style)) $style.= " st_tour_ver" ;
        $r .= '<div class="st_tab '.$style.' tabbable st_tab_'.esc_attr($id_rand).'" style="">
                            <ul id="myTab'.$id.'" class="nav nav-tabs myTab">
                              '.$st_title_tb.'
                            </ul>
                            <div id="myTabContent'.$id.'" class="tab-content">
                              '.$content_data.'
                            </div>
                        </div>';
        return $r;
    }
    st_reg_shortcode('st_tab','st_tab_func');

    if ( class_exists( 'WPBakeryShortCodesContainer' ) and !class_exists('WPBakeryShortCode_st_tab')) {
        class WPBakeryShortCode_st_tab extends WPBakeryShortCodesContainer {
            protected function content($arg, $content = null) {
                return st_tab_func($arg,$content);
            }
        }
    }
}
if(!function_exists('st_tab_item_func')){
    function st_tab_item_func($arg,$content=false)
    {
        global $st_title_tb;
        global $i_tab;
        global $id_rand;
        $data = shortcode_atts(array(
            'st_title' =>"",
            'st_icon'   => "",
        ), $arg,'st_tab_item');
        extract($data);
        if (!empty($st_icon)) {$st_icon = "<i class='fa ".$st_icon."'></i>";}
        if($i_tab == '0'){
            $class_active = "active";
        }else{
            $class_active="";
        }
        $st_title_tb .= '<li class="'.esc_attr($class_active).'">
                               <a href="#tab-'.esc_attr($id_rand).'-'.esc_attr($i_tab).'" data-toggle="tab">'.$st_icon.' '.$st_title.'</a>
                             </li>';
        $text = '<div class="tab-pane fade '.esc_attr($class_active).' in " id="tab-'.esc_attr($id_rand).'-'.esc_attr($i_tab).'">
                     '.do_shortcode($content).'
                     </div>';
        $i_tab++;
        return $text;
    }
    st_reg_shortcode('st_tab_item','st_tab_item_func');
}
if(!function_exists('st_vc_team')){
    function st_vc_team($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_style'=> '',
                'st_avatar' =>0,
                'st_name' => 0,
                'st_position'=>'',
                'st_position_social'=>'-top-left',
                'st_effect'=>'',
                'st_facebook'=>'',
                'st_twitter'=>'',
                'st_google'=>'',
                'st_instagram'=>'',
                'st_linkedin'=> '',
                'st_youtube'=> '',
                'st_other_social'=>'',
                'st_description'=>''
            ), $attr, 'st_team' );
        extract($data);

        $img = wp_get_attachment_image_src($st_avatar,array(300,300));
        $txt ="";
        switch ($st_style) {
            default :
                $round_box = "box-icon-normal round";
                $list_social ='';

                if(!empty($st_facebook)){
                    $list_social .='<li><a href="'.$st_facebook.'" class="fa fa-facebook '.$round_box.'"></a></li>';
                }
                if(!empty($st_twitter)){
                    $list_social .='<li><a href="'.$st_twitter.'" class="fa fa-twitter '.$round_box.'"></a></li>';
                }
                if(!empty($st_google)){
                    $list_social .='<li><a href="'.$st_google.'" class="fa fa-google-plus '.$round_box.'"></a></li>';
                }
                if(!empty($st_instagram)){
                    $list_social .='<li><a href="'.$st_instagram.'" class="fa fa-instagram '.$round_box.'"></a></li>';
                }
                if(!empty($st_linkedin)){
                    $list_social .='<li><a href="'.$st_linkedin.'" class="fa fa-linkedin '.$round_box.'"></a></li>';
                }
                if(!empty($st_youtube)){
                    $list_social .='<li><a href="'.$st_youtube.'" class="fa fa-youtube '.$round_box.'"></a></li>';
                }

                if(!empty($st_other_social)){
                    $list_social .=$st_other_social;
                }
                $txt .=  '<div class="thumb text-center st_team">
                        <header class="thumb-header hover-img">
                            <img alt="'.TravelHelper::get_alt_image($st_avatar).'" class="round" src="'.bfi_thumb($img[0],array('width'=>300,'height'=>300)).'" title="'.$st_name.'" />
                            <ul class="hover-icon-group'.$st_position_social.' '.$st_effect.' ">
                                    '.$list_social.'
                            </ul>
                        </header>
                        <div class="thumb-caption">
                            <h5 class="thumb-title">'.$st_name.'</h5>
                            <p class="thumb-meta text-small">'.$st_position.'</p>
                        </div>
                  </div>';
                break;
            case "st_tour_ver":
                $list_social ='<div class="st_social style1">';
                if(!empty($st_facebook)){
                    $list_social .='<a href="'.$st_facebook.'" class="'.$st_style .' "><i class="fa fa-facebook"></i></a>';
                }
                if(!empty($st_twitter)){
                    $list_social .='<a href="'.$st_twitter.'" class="'.$st_style .'"><i class="fa fa-twitter"></i></a>';
                }
                if(!empty($st_google)){
                    $list_social .='<a href="'.$st_google.'" class="'.$st_style .' "><i class="fa fa-google-plus"></i></a>';
                }
                if(!empty($st_instagram)){
                    $list_social .='<a href="'.$st_instagram.'" class="'.$st_style .'"><i class="fa fa-instagram "></i></a>';
                }
                if(!empty($st_linkedin)){
                    $list_social .='<a href="'.$st_linkedin.'" class="'.$st_style .'"><i class="fa fa-linkedin"></i></a>';
                }
                if(!empty($st_youtube)){
                    $list_social .='<a href="'.$st_youtube.'" class="'.$st_style .'"><i class="fa fa-youtube "></i></a>';
                }

                if(!empty($st_other_social)){
                    $list_social .=$st_other_social;
                }
                $list_social .="</div>";
                $txt .=
                    '<div class="st_team_item_'.$st_style.'">
                        '.wp_get_attachment_image($st_avatar ,'full').'
                        <div class="st_name"><h5>'.$st_name.'</h5></div>
                        <div class="st_position"><small><i>'.$st_position.'</i></small></div>
                        <div class="st_description">'.$st_description.'</div>
                        '.$list_social.'
                    </div>';

                break;

        }





        return $txt;
    }
    st_reg_shortcode('st_team','st_vc_team');
}
if(!function_exists('st_vc_testimonial')){
    function st_vc_testimonial($attr,$content=false)
    {
        $data = shortcode_atts(
            array(
                'st_style' =>'style1',
                'st_avatar' =>0,
                'st_color' =>"#000",
                'st_testimonial_color' =>"",
                'st_name' => 0,
                'st_sub'=>'',
                'st_desc'=>''
            ), $attr, 'st_testimonial' );
        extract($data);
        $img = wp_get_attachment_image_src($st_avatar,array(50,50));
        $class_color = Assets::build_css('color : '.$st_color);
        if($st_style == 'style1'){
            $txt =  '  <div class="testimonial '.$class_color.' '.$st_testimonial_color.' ">
                        <div class="testimonial-inner ">
                            <blockquote>
                                <p>'.$st_desc.'</p>
                            </blockquote>
                        </div>
                        <div class="testimonial-author">
                            <img src="'.($img[0]).'" alt="Avatar" title="'.$st_name.'" />
                            <p class="testimonial-author-name" >'.$st_name.'</p>
                            <cite>'.$st_sub.'</cite>
                        </div>
                    </div>';
        }
        if($st_style == 'style2'){
            $txt =  '  <div class="testimonial style2 '.$class_color.' '.$st_testimonial_color.'">
                        <div class="testimonial-inner">
                            <div class="row">
                                <div class="col-md-3">
                                     <img src="'.($img[0]).'" alt="Avatar" title="'.$st_name.'" />
                                </div>
                                <div class="col-md-8">
                                     <blockquote>
                                        <p>'.$st_desc.'</p>
                                     </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-author">
                            <p class="testimonial-author-name dark" >'.$st_name.'</p>
                            <cite>'.$st_sub.'</cite>
                        </div>
                    </div>';
        }

        return $txt;
    }
    st_reg_shortcode('st_testimonial','st_vc_testimonial');
}
if(!function_exists('st_vc_text_slide')){
    function st_vc_text_slide($attr,$content=false)
    {
        wp_enqueue_script( 'owl-carousel.js' );

        $data = shortcode_atts(
            array(
                'st_title'=>'',
                'st_html_code' =>'',
                'st_background'=>'',
                'opacity'=>'0.5',
                'show_search'=>'yes',
                'tabs_search' => ''
            ), $attr, 'st_text_slide' );
        extract($data);
        $bg_image='';
        $class_bg = Assets::build_css("opacity: ".$opacity."!important;");
        foreach(explode(',',$st_background) as $k=>$v){
            $img = wp_get_attachment_image_src($v,'full');
            $bg_image .= '<div class="bg-holder full">
                            <div class="bg-mask '.$class_bg.'"></div>
                            <div class="bg-img" style="background-image:url('.$img[0].');"></div>
                     </div>';
        }
        $html_search = "";
        if($show_search == "yes"){
            $html_search = '<div class="container">
                                '.st()->load_template('vc-elements/st-search/search','form',array('st_style_search' =>'style_1', 'st_box_shadow'=>'no' ,'class'=>'search-tabs-abs-bottom', 'tabs_search' => $tabs_search) ).'
                            </div>';
        }
        $txt =  '<div id="text-slider-wrapper" class="top-area show-onload">
                    <div class="bg-holder full">
                        <div class="bg-front full-height">
                            <div class="container full-height">
                                <div class="rel full-height div_tagline">
                                    <div class="tagline" id="tagline">
                                    <span>'.$st_title.'</span>
                                    '.st_remove_wpautop($st_html_code).'
                                    </div>
                                    '.$html_search.'
                                </div>
                            </div>
                        </div>
                        <div class="owl-carousel owl-slider owl-carousel-area" id="owl-carousel-slider" data-nav="false">
                                '.$bg_image.'
                        </div>

                    </div>
                </div>';
        return $txt;
    }
    st_reg_shortcode('st_text_slide','st_vc_text_slide');
}
if (!function_exists('st_vc_title')){
    function st_vc_title($attr){
        extract(shortcode_atts( array('heading'=>1,'align'=>'center','color'=>"white",'font_weight'=>'bold'),$attr));
        $title = apply_filters('the_title',get_the_title() );
        return "<h".$heading." style='font-weight: ".$font_weight."; color: ".$color." ;text-align:".$align."'>".$title."</h".$heading.">";
    }
    st_reg_shortcode('st_title','st_vc_title');
}
if (!function_exists('st_tour_card_accepted_fn')){
    function st_tour_card_accepted_fn($attr){
        $cards = st()->get_option('tour_cards_accept',"");
        $html = "<div class='st_tour_card_accepted'>";
        $html .= __("We accepted ", ST_TEXTDOMAIN);
        if (!empty($cards) and is_array($cards)){
            foreach ($cards as $items ){
                extract(wp_parse_args($items,array('title'=>"#" , 'image'=>"#",'link'=> "#")));
                if (!empty($image) and !empty($link)){
                    $html .="<a href='".$link."'><img height='28' width='auto' alt='".$title."' src='".$image."'/></a>";
                }
            }
        }
        $html .="</div>";
        return $html ;
    }
    st_reg_shortcode('st_tour_card_accepted' , 'st_tour_card_accepted_fn');

}
if(!function_exists( 'st_search_car_transfer_result' )) {
    function st_search_car_transfer_result( $arg = array() )
    {
        $default = array(
            'style'    => '2' ,
            'taxonomy' => '' ,
        );
        $arg     = wp_parse_args( $arg , $default );
        return st()->load_template( 'car_transfer/search-elements/result/result' , false , array( 'arg' => $arg ) );
    }
    st_reg_shortcode( 'st_search_car_transfer_result' , 'st_search_car_transfer_result' );

}
if(!function_exists('st_vc_tp_widgets')){
    function st_vc_tp_widgets($arg, $content = false)
    {
        $output = $widget_type = $pr_destination = $language = $language1 = $find_by = $list_hotel = $city_data = $direct = $color_schema = $w_layout = $limit = $pr_origin = $language2 = $language3 = $add_marker = $hotel_id = $map_lat_lon = $map_control = $map_zoom = $marker_size = '';
        $data = shortcode_atts(array(
            'widget_type' => 'popular-router',
            'pr_destination'=>'',
            'language' => 'en',
            'language1' => 'en',
            'language2' => 'en',
            'language3' => 'en',
            'direct' => 'yes',
            'pr_origin' => '',
            'add_marker' => '',
            'hotel_id' => '',
            'map_lat_lon' => '',
            'map_control' => 'drag',
            'map_zoom' => 12,
            'marker_size' =>16,
            'color_schema' => '#00b1dd',
            'w_layout' => 'full',
            'limit' => '10',
            'find_by' => 'city',
            'list_hotel' => '',
            'city_data' => ''
        ), $arg );
        extract($data);

        parse_str(urldecode($pr_destination),$destination);

        parse_str(urldecode($pr_origin),$origin);

        parse_str(urldecode($hotel_id),$ho_id);

        parse_str(urldecode($map_lat_lon),$hotel_map);

        parse_str(urldecode($city_data),$city);

        $output .= '<div class="st_travelpayouts_widgets">';
        $output .= st()->load_template('vc-elements/st-travelpayouts-widget/tp-widget', null, array(
            'widget_type' => $widget_type,
            'pr_destination' => $destination,
            'language' => $language,
            'language1' => $language1,
            'direct' => $direct,
            'pr_origin' => $origin,
            'language2' => $language2,
            'add_marker' => $add_marker,
            'hotel_id' => $ho_id,
            'map_lat_lon' => $hotel_map,
            'map_control' => $map_control,
            'map_zoom' => $map_zoom,
            'marker_size' => $marker_size,
            'color_schema' => $color_schema,
            'language3' => $language3,
            'w_layout' => $w_layout,
            'limit' => $limit,
            'find_by' => $find_by,
            'list_hotel' => $list_hotel,
            'city_data' => $city
        ));
        $output .= '</div>';

        return $output;
    }
    st_reg_shortcode('st_tp_widgets','st_vc_tp_widgets');
}
if(!function_exists('st_vc_twitter')){
    function st_vc_twitter($arg,$content=false)
    {
        $data = shortcode_atts(array(
            'st_twitter_number' =>5,
            'st_twitter_user'=>'evanto',
            'st_color'=>'#fff',
        ), $arg, 'st_twitter' );
        extract($data);
        //require_once 'TwitterAPIExchange.php';
        if($st_twitter_user)
        {
            //get twitter
            $settings = array(
                'oauth_access_token' => "460485056-XHfLUud3fQToKfseTnoaiSLrWrdKnsiEyiCaJHLX",
                'oauth_access_token_secret' => "GmYQbQcDXdiWBJFH39GgyG7i7fxVcfaQQT0YgCgh015f7",
                'consumer_key' => "18ihEuNsfOJokCLb8SAgA",
                'consumer_secret' => "7vTYnLYYiP4BhXvkMWtD3bGnysgiGqYlsPFfwXhGk"
            );
            $num=$st_twitter_number;
            $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
            $getfield = '?screen_name='.$st_twitter_user.'&count='.$num;
            $requestMethod = 'GET';
            try{
                $twitter = new TwitterAPIExchange($settings);
            }catch (Exception $e){
                return;
            }

            $recent_twitter = $twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest();

            $twitters = json_decode($recent_twitter,true);
            $output = array();
            $txt="";
            $class = "";
            if(!empty($st_color)){
                $class =  Assets::build_css("color: ".$st_color);
                Assets::add_css("
                    .$class .owl-controls .owl-buttons div{
                        background:{$st_color};
                    }
                ");
            }
            if (!isset($twitters['errors']) && count($twitters)>0) {
                foreach( $twitters as $twitter ) {
                    $txt.='<div class="item">
                                <div class="icon pull-left">
                                    <i class="fa fa-twitter"></i>
                                </div>
                                <div class="txt">
                                    <span class="tweet_time">
                                        <a class="'.$class.'" title="view tweet on twitter" href="http://twitter.com/'.$st_twitter_user."/status/".$twitter['id'].'">'.human_time_diff(strtotime($twitter['created_at']) ) .' ago :</a>
                                     </span>
                                     <span class="tweet_text">
                                       '.$twitter['text'].'
                                     </span>
                                </div>
                            </div>';
                }
            }
        }
        $r = st()->load_template('vc-elements/st-twitter/html',null,array('html'=>$txt,'st_color'=>$st_color,'class'=>$class));
        return $r;
    }
    st_reg_shortcode('st_twitter','st_vc_twitter');
}
if(!function_exists('st_vc_under_construction')){
    function st_vc_under_construction($arg)
    {
        echo "<pre>";
        print_r($arg);
        echo "</pre>";

        return __FUNCTION__ ;
    }
    st_reg_shortcode('st_under_construction','st_vc_under_construction');
}


//--------------- END ST Activity------------------------------------


//--------------- ST Cars------------------------------------
if(st_check_service_available('st_cars')) {
    if(!function_exists( 'st_vc_cars_attribute' )) {
        function st_vc_cars_attribute( $attr , $content = false )
        {
            $default = array(
                'font_size' => 4
            );
            $attr    = wp_parse_args( $attr , $default );
            if(is_singular( 'st_cars' )) {
                return st()->load_template( 'cars/elements/attribute' , null , array( 'attr' => $attr ) );
            }
        }
        st_reg_shortcode( 'st_cars_attribute' , 'st_vc_cars_attribute' );

    }
    if (!function_exists('st_vc_cars_content_search')) {
        function st_vc_cars_content_search($attr, $content = false)
        {
            $default = array(
                'st_style' => 1
            );
            $attr = wp_parse_args($attr, $default);
            global $st_search_query;
            if (!$st_search_query) return;
            return st()->load_template('cars/content', 'cars', array('attr' => $attr));
        }

        st_reg_shortcode('st_cars_content_search', 'st_vc_cars_content_search');

    }
    if(!function_exists( 'st_vc_cars_content_search_ajax' )) {
        function st_vc_cars_content_search_ajax( $attr , $content = false )
        {
            $default = array(
                'st_style' => 1
            );
            $attr    = wp_parse_args( $attr , $default );
            global $st_search_query;
            if(!$st_search_query) return;
            return st()->load_template( 'cars/content' , 'cars-ajax' , array( 'attr' => $attr ) );
        }
        st_reg_shortcode( 'st_cars_content_search_ajax' , 'st_vc_cars_content_search_ajax' );

    }
    if(!function_exists( 'st_search_cars_title' )) {
        function st_search_cars_title( $arg = array() )
        {
            if(!get_post_type() == 'st_cars' and get_query_var( 'post_type' ) != "st_cars")
                return;

            $default = array(
                'search_modal' => 1
            );

            wp_enqueue_script('magnific.js' );

            extract( wp_parse_args( $arg , $default ) );

            $car  = new STCars();
            $html = '<h3 class="booking-title"><span id="count-filter-tour">' . balanceTags( $car->get_result_string() ) . '</span>';

            if($search_modal) {
                $html .= '<small><a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">' . __( 'Change search' , ST_TEXTDOMAIN ) . '</a></small>';
            }
            $html .= '</h3>';

            return $html;
        }
        st_reg_shortcode( 'st_search_cars_title' , 'st_search_cars_title' );

    }
    if(!function_exists( 'st_vc_car_detail_photo' )) {
        function st_vc_car_detail_photo( $attr , $content = false )
        {
            $default = array(
                'style' => 'slide'
            );
            $attr    = wp_parse_args( $attr , $default );
            if(is_singular( 'st_cars' )) {
                return st()->load_template( 'cars/elements/photo' , null , array( 'attr' => $attr ) );
            }
        }
        st_reg_shortcode( 'st_car_detail_photo' , 'st_vc_car_detail_photo' );

    }
    if(!function_exists( 'st_vc_cars_price' )) {
        function st_vc_cars_price( $attr , $content = false )
        {
            $default = array(
                'st_style' => 1
            );
            $attr    = wp_parse_args( $attr , $default );
            if(is_singular( 'st_cars' )) {
                return st()->load_template( 'cars/elements/price' , null , array( 'attr' => $attr ) );
            }
        }
        st_reg_shortcode( 'st_cars_price' , 'st_vc_cars_price' );

    }
    if(!function_exists('st_vc_cruise_photo')){
        function st_vc_cruise_photo($attr,$content=false)
        {
            if(is_singular('cruise'))
            {
                return st()->load_template('cruise/elements/photo',null,array('attr'=>$attr));
            }
        }
        st_reg_shortcode('st_cruise_photo','st_vc_cruise_photo');
    }
    if(!function_exists( 'st_vc_list_cars' )) {
        function st_vc_list_cars( $attr , $content = false )
        {

            global $st_search_args;

            $param   = array(
                'st_ids'         => '' ,
                'taxonomy'       => '' ,
                'st_number_cars' => 4 ,
                'st_order'       => '' ,
                'st_orderby'     => '' ,
                'st_cars_of_row' => 4 ,
                'st_location'    => '' ,
                'only_featured_location'    => 'no' ,
            );
            $list_tax = TravelHelper::get_object_taxonomies_service('st_cars');
            if( !empty( $list_tax ) ){
                foreach( $list_tax as $name => $label ){
                    $param['taxonomies--'. $name] = '';
                }
            }

            $data    = wp_parse_args( $attr , $param );
            extract( $data );
            $st_search_args=$data;
            $query = array(
                'post_type'      => 'st_cars' ,
                'posts_per_page' => $st_number_cars ,
                'order'          => $st_order ,
                'orderby'        => $st_orderby
            );

            $st_search_args['featured_location']=STLocation::inst()->get_featured_ids();
            $cars=STCars::get_instance();
            $cars->alter_search_query();
            global $wp_query;
            query_posts( $query );
            $txt = '';
            while( have_posts() ) {
                the_post();
                $txt .= st()->load_template( 'vc-elements/st-list-cars/loop' , 'list' , array(
                    'attr'  => $attr ,
                    'data_' => $data
                ) );;
            }
            wp_reset_query();
            $cars->remove_alter_search_query();
            $st_search_args=null;
            return '<div class="row row-wrap">' . $txt . '</div>';
        }
        st_reg_shortcode( 'st_list_cars' , 'st_vc_list_cars' );

    }
    if(!function_exists( 'st_list_car_related' )) {
        function st_list_car_related( $attr , $content = false )
        {
            global $st_search_args;
            $data_vc = STCars::get_taxonomy_and_id_term_tour();
            $param   = array(
                'title'          => '' ,
                'st_ids'         => '' ,
                'sort_taxonomy'  => '' ,
                'posts_per_page' => 3 ,
                'st_orderby'     => 'ID' ,
                'st_order'       => 'DESC' ,
                'font_size'      => '3' ,
                'number_of_row'  => 1
            );
            $param   = array_merge( $param , $data_vc[ 'list_id_vc' ] );
            $data    = shortcode_atts(
                $param , $attr , 'st_list_car_related' );
            extract( $data );
            $st_search_args = $data;
            $page           = STInput::request( 'paged' );
            if(!$page) {
                $page = get_query_var( 'paged' );
            }
            $query = array(
                'post_type'      => 'st_cars' ,
                'posts_per_page' => $posts_per_page ,
                'post_status'    => 'publish' ,
                'paged'          => $page ,
                'order'          => $st_order ,
                'orderby'        => $st_orderby ,
                'post__not_in'   => array( get_the_ID() )
            );
            $cars  = STCars::get_instance();
            $cars->alter_search_query();
            query_posts( $query );
            $r = "<div class='list_car_related'>" . st()->load_template( 'vc-elements/st-list-cars/loop-list' , '2' , array() ) . "</div>";
            wp_reset_query();
            wp_reset_query();
            $cars->remove_alter_search_query();
            $st_search_args = null;
            if(!empty( $title ) and !empty( $r )) {
                $r = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $r;
            }
            return $r;
        }
        st_reg_shortcode( 'st_list_car_related' , 'st_list_car_related' );

    }



}
//--------------- END ST Cars------------------------------------



//--------------- ST Rental------------------------------------
if(st_check_service_available('st_rental'))
{
    if(!function_exists( 'st_vc_list_rental' )) {
        function st_vc_list_rental( $attr , $content = false )
        {
            global $st_search_args;
            $default = array(
                'st_ids'        => '' ,
                'taxonomy'      => '' ,
                'number'        => 0 ,
                'st_order'      => '' ,
                'st_orderby'    => '' ,
                'number_of_row' => 4 ,
                'st_location'   => '' ,
            );
            $list_tax = TravelHelper::get_object_taxonomies_service('st_rental');
            if( !empty( $list_tax ) ){
                foreach( $list_tax as $name => $label ){
                    $default['taxonomies--'. $name] = '';
                }
            }
            $data = wp_parse_args( $attr , $default);
            extract( $data );
            $st_search_args = $data;
            $query = array(
                'post_type'      => 'st_rental' ,
                'posts_per_page' => $number ,
                'order'          => $st_order ,
                'orderby'        => $st_orderby
            );
            $current_page = get_post_type( get_the_ID() );
            $rental = STRental::inst();
            $rental->alter_search_query();
            query_posts( $query );
            $txt = '';
            while( have_posts() ) {
                the_post();
                $txt .= st()->load_template( 'vc-elements/st-list-rental/loop' , 'list' , array(
                    'attr'         => $attr ,
                    'data'         => $data ,
                    'current_page' => $current_page
                ) );;
            }
            $rental->remove_alter_search_query();
            wp_reset_query();
            return '<div class="row row-wrap">' . $txt . '</div>';
        }
        st_reg_shortcode( 'st_list_rental' , 'st_vc_list_rental' );

    }
    if(!function_exists( 'st_list_rental_related' )) {
    function st_list_rental_related( $attr , $content = false )
    {
        global $st_search_args;
        $data_vc = STRental::get_taxonomy_and_id_term_tour();
        $param = array(
            'title'=>'',
            'st_ids'                 => '' ,
            'sort_taxonomy'=>'',
            'posts_per_page'  => 3,
            'st_orderby' =>'ID' ,
            'st_order'=>'DESC',
            'font_size' => '3' ,
            'number_of_row'=>1
        );
        $param   = array_merge( $param , $data_vc[ 'list_id_vc' ] );
        $data = shortcode_atts(
            $param , $attr , 'st_list_rental_related');
        extract($data);
        $st_search_args = $data;
        $page = STInput::request( 'paged' );
        if(!$page) {
            $page = get_query_var( 'paged' );
        }
        $query = array(
            'post_type' =>'st_rental',
            'posts_per_page'=>$posts_per_page,
            'post_status'=>'publish',
            'paged'     =>$page,
            'order'          =>  $st_order,
            'orderby'        => $st_orderby,
            'post__not_in' => array(get_the_ID())
        );
        $rental = STRental::inst();
        $rental->alter_search_query();
        query_posts($query);
        $r = "<div class='list_rental_related'>" . st()->load_template( 'vc-elements/st-list-rental/loop-list' , 'true' , array() ) . "</div>";
        $rental->remove_alter_search_query();
        wp_reset_query();
        if(!empty( $title ) and !empty( $r )) {
            $r = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $r;
        }
        return $r;
    }
    st_reg_shortcode( 'st_list_rental_related' , 'st_list_rental_related' );

}
    if(!function_exists( 'st_vc_rental_attribute' )) {
        function st_vc_rental_attribute( $attr , $content = false )
        {
            $default = array(
                'item_col'  => 12 ,
                'font_size' => 4
            );

            $attr = wp_parse_args( $attr , $default );

            if(is_singular( 'st_rental' )) {
                return st()->load_template( 'rental/elements/attribute' , null , array( 'attr' => $attr ) );
            }
        }
        st_reg_shortcode( 'st_rental_attribute' , 'st_vc_rental_attribute' );

    }
    if(!function_exists( 'st_search_rental_result' )) {
        function st_search_rental_result( $arg = array() )
        {
            $default = array(
                'style'    => 'grid' ,
                'taxonomy' => '' ,
            );

            $arg = wp_parse_args( $arg , $default );

            if(!get_post_type() == 'st_rental' and get_query_var( 'post_type' ) != "st_rental")
                return;

            return st()->load_template( 'rental/search-elements/result' , false , array( 'arg' => $arg ) );
        }
        st_reg_shortcode( 'st_search_rental_result' , 'st_search_rental_result' );

    }
    if(!function_exists( 'st_search_rental_result_ajax' )) {
        function st_search_rental_result_ajax( $arg = array() )
        {
            $default = array(
                'style'    => 'grid' ,
                'taxonomy' => '' ,
            );

            $arg = wp_parse_args( $arg , $default );

            if(!get_post_type() == 'st_rental' and get_query_var( 'post_type' ) != "st_rental")
                return;

            return st()->load_template( 'rental/search-elements/result-ajax' , false , array( 'arg' => $arg ) );
        }
        st_reg_shortcode( 'st_search_rental_result_ajax' , 'st_search_rental_result_ajax' );

    }
    if(!function_exists( 'st_vc_rental_distance' )) {
        function st_vc_rental_distance( $attr , $content = false )
        {
            $default = array(
                'item_col'  => 12 ,
                'font_size' => 4
            );

            $attr = wp_parse_args( $attr , $default );

            if(is_singular( 'st_rental' )) {
                return st()->load_template( 'rental/elements/distance' , null , array( 'attr' => $attr ) );
            }
        }
        st_reg_shortcode( 'st_rental_distance' , 'st_vc_rental_distance' );

    }
    if(!function_exists( 'st_search_rental_title' )) {
        function st_search_rental_title( $arg = array() )
        {
            if(!get_post_type() == 'st_rental' and get_query_var( 'post_type' ) != 'st_rental')
                return;

            $default = array(
                'search_modal' => 1
            );

            wp_enqueue_script('magnific.js' );
            extract( wp_parse_args( $arg , $default ) );

            $object = new STRental();
            $a      = '<h3 class="booking-title"><span id="count-filter-tour">' . balanceTags( $object->get_result_string() ) . '</span>';

            if($search_modal) {
                $a .= '<small><a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">' . __( 'Change search' , ST_TEXTDOMAIN ) . '</a></small>';
            }
            $a .= '</h3>';

            return $a;
        }
        st_reg_shortcode( 'st_search_rental_title' , 'st_search_rental_title' );

    }
    if(!function_exists( 'st_vc_rental_photo' )) {
        function st_vc_rental_photo( $attr , $content = false )
        {
            $default = array(
                'style' => 'slide' ,
            );

            $attr = wp_parse_args( $attr , $default );

            if(is_singular( 'st_rental' )) {
                return st()->load_template( 'rental/elements/photo' , null , array( 'attr' => $attr ) );
            }
        }
        st_reg_shortcode( 'st_rental_photo' , 'st_vc_rental_photo' );

    }


}
//--------------- END ST Rental------------------------------------


//--------------ST Tours -----------------------
if(st_check_service_available('st_tours')){
    if(!function_exists( 'st_vc_list_tour' )) {
        function st_vc_list_tour( $attr , $content = false )
        {
            global $st_search_args;
            $param   = array(
                'st_ids'                 => '' ,
                'st_number_tour'         => 4 ,
                'st_order'               => '' ,
                'st_orderby'             => '' ,
                'st_tour_of_row'         => '' ,
                'st_style'               => 'style_1' ,
                'only_featured_location' => 'no' ,
                'st_location'            => '' ,
                'title'                  => '' ,
                'font_size'              => '3' ,
            );
            $list_tax = TravelHelper::get_object_taxonomies_service('st_tours');

            if( !empty( $list_tax ) ){
                foreach( $list_tax as $name => $label ){
                    $param['taxonomies--'. $name] = '';
                }
            }

            $data    = shortcode_atts( $param , $attr , 'st_list_tour' );

            extract( $data );
            $st_search_args=$data;

            $page = STInput::request( 'paged' );
            if(!$page) {
                $page = get_query_var( 'paged' );
            }
            $query = array(
                'post_type'      => 'st_tours' ,
                'posts_per_page' => $st_number_tour ,
                'paged'          => $page ,
                'order'          => $st_order ,
                'orderby'        => $st_orderby,
            );

            $st_search_args['featured_location']=STLocation::inst()->get_featured_ids();
            $tour=STTour::get_instance();
            $tour->alter_search_query();
            query_posts( $query );
            global $wp_query;
            if($st_style == 'style_1') {
                $r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-tour/loop' , '' , $data ) . "</div>";
            }
            if($st_style == 'style_2') {
                $r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-tour/loop2' , '' , $data ) . "</div>";
            }
            if($st_style == 'style_3') {
                $r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-tour/loop3' , '' , $data ) . "</div>";
            }
            if($st_style == 'style_4') {
                $r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-tour/loop4' , '' , $data ) . "</div>";
            }
            wp_reset_query();
            $tour->remove_alter_search_query();
            $st_search_args=null;

            if(!empty( $title ) and !empty( $r )) {
                $r = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $r;
            }
            return $r;
        }
        st_reg_shortcode( 'st_list_tour' , 'st_vc_list_tour' );

    }
    if(!function_exists( 'st_list_tour_related' )) {
        function st_list_tour_related( $attr , $content = false )
        {
            global $st_search_args;
            $data_vc = STTour::get_taxonomy_and_id_term_tour();
            $param   = array(
                'title'          => '' ,
                'st_ids'                 => '' ,
                'sort_taxonomy'  => '' ,
                'posts_per_page' => 3 ,
                'st_orderby' =>'ID' ,
                'st_order'=>'DESC',
                'st_style'       => 'style_4' ,
                'font_size'      => '3' ,
            );
            $param   = array_merge( $param , $data_vc[ 'list_id_vc' ] );
            $data    = shortcode_atts(
                $param , $attr , 'st_list_tour_related' );
            extract( $data );
            $st_search_args = $data;
            $page = STInput::request( 'paged' );
            if(!$page) {
                $page = get_query_var( 'paged' );
            }
            $query = array(
                'post_type'      => 'st_tours' ,
                'posts_per_page' => $posts_per_page ,
                'post_status'    => 'publish' ,
                'paged'          => $page ,
                'order'          =>  $st_order,
                'orderby'        => $st_orderby,
                'post__not_in'   => array( get_the_ID() )
            );
            $tour = STTour::get_instance();
            $tour->alter_search_query();
            query_posts( $query );
            if($st_style == 'style_1') {
                $r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-tour/loop' , '' , $data ) . "</div>";
            }
            if($st_style == 'style_2') {
                $r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-tour/loop2' , '' , $data ) . "</div>";
            }
            if($st_style == 'style_3') {
                $r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-tour/loop3' , '' , $data ) . "</div>";
            }
            if($st_style == 'style_4') {
                $r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-tour/loop4' , '' , $data ) . "</div>";
            }
            $tour->remove_alter_search_query();
            wp_reset_query();
            if(!empty( $title ) and !empty( $r )) {
                $r = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $r;
            }
            return $r;
        }
        st_reg_shortcode( 'st_list_tour_related' , 'st_list_tour_related' );

    }
    if(!function_exists( 'st_tour_detail_attribute' )) {
        function st_tour_detail_attribute( $attr , $content = false )
        {
            $default = array(
                'item_col'  => 12 ,
                'font_size' => 4
            );
            $attr    = wp_parse_args( $attr , $default );

            if(is_singular( 'st_tours' )) {
                return st()->load_template( 'tours/elements/attribute' , null , array( 'attr' => $attr ) );
            }
        }
        st_reg_shortcode( 'st_tour_detail_attribute' , 'st_tour_detail_attribute' );

    }
    if(!function_exists( 'st_vc_tour_content_search' )) {
        function st_vc_tour_content_search( $attr , $content = false )
        {
            $default = array(
                'st_style' => 1 ,
                'taxonomy' => ''
            );
            $attr    = wp_parse_args( $attr , $default );
            global $st_search_query;
            if(!$st_search_query) return;
            //if(is_search())
            //{
            return st()->load_template( 'tours/content' , 'tours' , array( 'attr' => $attr ) );
            //}
        }
        st_reg_shortcode( 'st_tour_content_search' , 'st_vc_tour_content_search' );

    }
    if(!function_exists( 'st_vc_tour_content_search_ajax' )) {
        function st_vc_tour_content_search_ajax( $attr , $content = false )
        {
            $default = array(
                'st_style' => 1 ,
                'taxonomy' => '',
            );
            $attr    = wp_parse_args( $attr , $default );
            return st()->load_template( 'tours/content' , 'tours-ajax' , array( 'attr' => $attr ) );
        }
        st_reg_shortcode( 'st_tour_content_search_ajax' , 'st_vc_tour_content_search_ajax' );

    }
    if(!function_exists( 'st_search_tour_title' )) {
        function st_search_tour_title( $arg = array() )
        {
            if(!get_post_type() == 'st_tour' and get_query_var( 'post_type' ) != "st_tour")
                return;

            $default = array(
                'search_modal' => 1,
                'is_ajax' => 1
            );

            wp_enqueue_script('magnific.js' );
            extract( wp_parse_args( $arg , $default ) );

            if($is_ajax == '1'){
	            $html = '<h3 class="booking-title"><span id="count-filter-tour"></span>';
            }else{
	            $tour = new STTour();
	            $html = '<h3 class="booking-title"><span id="count-filter-tour">' .  balanceTags( $tour->get_result_string() ) . '</span>';
            }



            if($search_modal) {
                $html .= '<small><a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">' . __( 'Change search' , ST_TEXTDOMAIN ) . '</a></small>';
            }
            $html .= '</h3>';

            return $html;
        }
        st_reg_shortcode( 'st_search_tour_title' , 'st_search_tour_title' );

    }
    if(!function_exists( 'st_vc_tour_detail_photo' )) {
        function st_vc_tour_detail_photo( $attr , $content = false )
        {
            $default = array(
                'style' => 'slide' ,
            );
            $attr    = wp_parse_args( $attr , $default );
            if(is_singular( 'st_tours' )) {
                return st()->load_template( 'tours/elements/photo' , null , array( 'attr' => $attr ) );
            }
        }
        st_reg_shortcode( 'st_tour_detail_photo' , 'st_vc_tour_detail_photo' );

    }
    if (!function_exists('st_tour_rewards_fn')){
        function st_tour_rewards_fn($attr){
            $rewards = st()->get_option('tour_rewards' ,'');
            $html = "<div class='st_tour_rewards row'><div class='col-xs-12'>";
            if (!empty($rewards) and is_array($rewards)) {
                foreach ($rewards as $item ){
                    extract(wp_parse_args($item,array('title'=>"#" , 'image'=>"#",'link'=> "#")));
                    if (!empty($image) and !empty($link)){
                        $html .="<a href='".$link."'><img height='35px' width='auto' alt='".$title."' src='".$image."'/></a>";
                    }
                }
            }
            $html .="</div></div>";
            return $html;

        }
        st_reg_shortcode('st_tour_rewards' , 'st_tour_rewards_fn');
    }



}
//--------------End ST Tours -----------------------




//--------------- ST Rental VS Hotel Room------------------------------------
if(st_check_service_available( 'st_rental' ) || st_check_service_available( 'hotel_room' )) {
    if(!function_exists( 'st_custom_discount_list' )) {
        function st_custom_discount_list( $attr , $content = false )
        {
            $attr = wp_parse_args( $attr, array());

            $return = st()->load_template('vc-elements/st-rental/st_discount_by_day','', null);
            return $return;
        }
        st_reg_shortcode( 'st_custom_discount_list' , 'st_custom_discount_list' );

    }

}
//--------------- End ST Rental VS Hotel Room------------------------------------



//-------- ST List Half Map -------------
if(!function_exists('st_list_half_map_func'))
{
    function st_list_half_map_func( $attr , $content = null )
{
    global $st_form_search_advance_field_half_map;
    $data = shortcode_atts(
        array(
            'title'             => '' ,
            'type'              => 'normal' ,
            'st_list_location'  => '0' ,
            'st_type'           => 'st_hotel' ,
            'zoom'              => '13' ,
            'auto_height'       => 'fixed',
            'height'            => '500' ,
            'number'            => '12' ,
            'fit_bounds'        => 'off' ,
            'map_position'      => 'left' ,
            'style_map'         => 'normal' ,
            'custom_code_style' => '' ,
            'show_search_box'   => 'yes' ,
        ) , $attr , 'st_list_map' );
    extract( $data );
    $form_search    = st_remove_wpautop( $content );
    $form_search_advance    = $st_form_search_advance_field_half_map;
    $html = '';
    if($type == "normal") {

        global $wp_query;
        global $st_search_args;
        $data['location_id'] = $data['st_list_location'];
        $st_search_args=$data;
        $ids = $st_list_location;
        if( count(explode(',',$st_list_location)) > 1) {
            $ids = explode( ',' , $st_list_location );
            $ids = $ids[0];
        }
        $map_lat         = get_post_meta( $ids , 'map_lat' , true );
        $map_lng         = get_post_meta( $ids , 'map_lng' , true );
        $location_center = '[' . $map_lat . ',' . $map_lng . ']';

        switch($st_type){
            case"st_hotel":
                $hotel = STHotel::inst();
                $hotel->alter_search_query();
                break;
            case"st_rental":
                $rental = STRental::inst();
                $rental->alter_search_query();
                break;
            case"st_cars":
                st()->car->alter_search_query();
                break;
            case"st_tours":
                st()->tour->alter_search_query();
                break;
            case"st_activity":
                $activity = STActivity::inst();
                $activity->alter_search_query();
                break;
        }
        $query           = array(
            'post_type'      => explode( ',' , $st_type ) ,
            'posts_per_page' => $number ,
            'post_status'    => 'publish' ,
        );
        query_posts( $query );
        switch( $st_type ) {
            case"st_hotel":
                $hotel->remove_alter_search_query();
                break;
            case"st_rental":
                $rental->remove_alter_search_query();
                break;
            case"st_cars":
                st()->car->remove_alter_search_query();
                break;
            case"st_tours":
                st()->tour->remove_alter_search_query();
                break;
            case"st_activity":
                $activity->remove_alter_search_query();
                break;
        }
    }
    if($type == "page_search") {
        $map_lat_center  = 0;
        $map_lng_center  = 0;
        $location_center = '[0,0]';
        $address_center  = '';
        if(STInput::request( 'pick-up' )) {
            $ids_location = TravelerObject::_get_location_by_name( STInput::get( 'pick-up' ) );
            if(!empty( $ids_location )) {
                $_REQUEST[ 'pick-up' ] = implode( ',' , $ids_location );
                $map_lat_center        = get_post_meta( $ids_location[ 0 ] , 'map_lat' , true );
                $map_lng_center        = get_post_meta( $ids_location[ 0 ] , 'map_lng' , true );
                $location_center       = '[' . $map_lat_center . ',' . $map_lng_center . ']';
                $address_center        = get_the_title( $ids_location[ 0 ] );
            }
        }
        if(STInput::request( 'location_id' )) {
            $map_lat_center  = get_post_meta( STInput::request( 'location_id' ) , 'map_lat' , true );
            $map_lng_center  = get_post_meta( STInput::request( 'location_id' ) , 'map_lng' , true );
            $location_center = '[' . $map_lat_center . ',' . $map_lng_center . ']';
            $address_center  = get_the_title( STInput::request( 'location_id' ) );
        }
        if(STInput::request( 'location_id_pick_up' )) {
            $map_lat_center  = get_post_meta( STInput::request( 'location_id_pick_up' ) , 'map_lat' , true );
            $map_lng_center  = get_post_meta( STInput::request( 'location_id_pick_up' ) , 'map_lng' , true );
            $location_center = '[' . $map_lat_center . ',' . $map_lng_center . ']';
            $address_center  = get_the_title( STInput::request( 'location_id_pick_up' ) );
        }

        $_REQUEST['s']="_";
        global $wp_query , $st_search_query;
        switch( $st_type ) {
            case"st_hotel":
                $hotel = STHotel::inst();
                $hotel->alter_search_query();
                break;
            case"st_rental":
                $rental = STRental::inst();
                $rental->alter_search_query();
                break;
            case"st_cars":
                st()->car->alter_search_query();
                break;
            case"st_tours":
                st()->tour->alter_search_query();
                break;
            case"st_activity":
                $activity = STActivity::inst();
                $activity->alter_search_query();
                break;
        }

        $query = array(
            'post_type'      => $st_type ,
            'posts_per_page' => $number ,
            'post_status'    => 'publish' ,
            's'              => '' ,
        );
        query_posts( $query );
    }

    $stt = 0;
    $data_map = array();
    while( have_posts() ) {
        the_post();
        $map_lat = get_post_meta( get_the_ID() , 'map_lat' , true );
        $map_lng = get_post_meta( get_the_ID() , 'map_lng' , true );
        if(!empty( $map_lat ) and !empty( $map_lng )) {
            $post_type                       = get_post_type();
            $data_map[ $stt ][ 'id' ]        = get_the_ID();
            $data_map[ $stt ][ 'name' ]      = get_the_title();
            $data_map[ $stt ][ 'post_type' ] = $post_type;
            $data_map[ $stt ][ 'lat' ]       = $map_lat;
            $data_map[ $stt ][ 'lng' ]       = $map_lng;
            $post_type_name                  = get_post_type_object( $post_type );
            $post_type_name->label;
            switch( $post_type ) {
                case"st_hotel";
                    $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_hotel_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_black.png' );
                    $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                    $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                    break;
                case"st_rental";
                    $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_rental_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_brown.png' );
                    $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                    $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                    break;
                case"st_cars";
                    $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_cars_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_green.png' );
                    $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                    $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                    break;
                case"st_tours";
                    $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_tours_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_purple.png' );
                    $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                    $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                    break;
                case"st_activity";
                    $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_activity_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_yellow.png' );
                    $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                    $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                    break;
            }
            $stt++;
        }

    }
    if($type == "page_search") {
        $st_search_query = $wp_query;
        switch( $post_type ) {
            case"st_hotel":
                $hotel->remove_alter_search_query();
                break;
            case"st_rental":
                $rental->remove_alter_search_query();
                break;
            case"st_cars":
                st()->car->remove_alter_search_query();
                break;
            case"st_tours":
                st()->tour->remove_alter_search_query();
                break;
            case"st_activity":
                $activity->remove_alter_search_query();
                break;
        }
    }
    wp_reset_query();
    if(empty( $location_center ) or $location_center == '[,]')
        $location_center = '[0,0]';
    $data_tmp               = array(
        'st_list_location' => $st_list_location ,
        'location_center'  => $location_center ,
        'zoom'             => $zoom ,
        'data_map'         => $data_map ,
        'auto_height'      => $auto_height,
        'height'           => $height ,
        'map_position'     => $map_position ,
        'style_map'        => $style_map ,
        'st_type'          => $st_type ,
        'number'           => $number ,
        'fit_bounds'       => $fit_bounds ,
        'title'            => $title ,
        'show_search_box'  => $show_search_box ,
        'form_search'        => $form_search ,
        'form_search_advance'        => $form_search_advance ,
    );
    $data_tmp[ 'data_tmp' ] = $data_tmp;
    $html                   = st()->load_template( 'vc-elements/st-list-half-map/html' , '' , $data_tmp );

    return $html;
}

    st_reg_shortcode('st_list_half_map','st_list_half_map_func');
    if(class_exists( 'WPBakeryShortCodesContainer' ) and !class_exists( 'WPBakeryShortCode_st_list_half_map' )) {
        class WPBakeryShortCode_st_list_half_map extends WPBakeryShortCodesContainer
        {
            protected function content( $attr , $content = null )
            {
                return st_list_half_map_func($attr,$content);
            }
        }
    }
}
if(!function_exists('st_list_half_map_field_hotel_func'))
{
    function st_list_half_map_field_hotel_func( $arg , $content = null )
{
    global $st_form_search_advance_field_half_map;
    $data = shortcode_atts( array(
        'st_title'           => '' ,
        'st_col'             => "col-md-1" ,
        'st_select_field'    => "st_hotel" ,
        'st_select_taxonomy' => "" ,
        'placeholder'           => '' ,
        'st_advance_field' => "no" ,
        'is_required' => "no" ,
    ) , $arg , 'st_list_half_map_field_hotel' );
    extract( $data );

    $default = array(
        'title'    => $st_title ,
        'taxonomy' => $st_select_taxonomy,
        'placeholder' => $placeholder,
        'is_required' => $is_required,
    );
    $text    = '<div class="' . $st_col . '">
                            ' . st()->load_template( 'hotel/elements/search/field_' . $st_select_field , false , array( 'data'       => $default ,
                                                                                                                        'field_size' => 'md'
        ) ) . '
                        </div>';

    if($st_advance_field == 'yes'){
        $st_form_search_advance_field_half_map .= $text;
        $text = "";
    }
    return $text;
}


    st_reg_shortcode('st_list_half_map_field_hotel','st_list_half_map_field_hotel_func');
}

if(!function_exists('st_list_half_map_field_rental_func'))
{
    function st_list_half_map_field_rental_func( $arg , $content = null )
{
    global $st_form_search_advance_field_half_map;
    $data = shortcode_atts( array(
        'st_title'           => '' ,
        'st_col'             => "col-md-1" ,
        'st_select_field'    => "st_hotel" ,
        'st_select_taxonomy' => "" ,
        'placeholder'           => '' ,
        'st_advance_field' => "no" ,
        'is_required' => "off" ,
    ) , $arg , 'st_list_half_map_field_rental' );
    extract( $data );

    $default = array(
        'title'    => $st_title ,
        'taxonomy' => $st_select_taxonomy,
        'placeholder' => $placeholder,
        'is_required' => $is_required,
    );
    $text    = '<div class="' . $st_col . '">
                            ' . st()->load_template( 'rental/elements/search/field_' . $st_select_field , false , array( 'data'       => $default ,
                                                                                                                         'field_size' => 'md'
        ) ) . '
                        </div>';
    if($st_advance_field == 'yes'){
        $st_form_search_advance_field_half_map .= $text;
        $text = "";
    }
    return $text;
}

    st_reg_shortcode('st_list_half_map_field_rental','st_list_half_map_field_rental_func');
}
if(!function_exists('st_list_half_map_field_car_func'))
{
    function st_list_half_map_field_car_func( $arg , $content = null )
{
    global $st_form_search_advance_field_half_map;
    $data = shortcode_atts( array(
        'st_title'           => '' ,
        'st_col'             => "col-md-1" ,
        'st_select_field'    => "st_hotel" ,
        'st_select_taxonomy' => "" ,
        'placeholder'           => '' ,
        'st_advance_field' => "no" ,
        'is_required' => "off" ,
    ) , $arg , 'st_list_half_map_field_car' );
    extract( $data );

    $default = array(
        'title'    => $st_title ,
        'taxonomy' => $st_select_taxonomy,
        'placeholder' => $placeholder,
        'is_required' => $is_required,
    );
    $text    = '<div class="' . $st_col . '">
                            ' . st()->load_template( 'cars/elements/search/field-' . $st_select_field , false , array( 'data'       => $default ,
                                                                                                                       'field_size' => 'md'
        ) ) . '
                        </div>';
    if($st_advance_field == 'yes'){
        $st_form_search_advance_field_half_map .= $text;
        $text = "";
    }
    return $text;
}

    st_reg_shortcode('st_list_half_map_field_car','st_list_half_map_field_car_func');
}

if(!function_exists('st_list_half_map_field_tour_func'))
{
    function st_list_half_map_field_tour_func( $arg , $content = null )
{
    global $st_form_search_advance_field_half_map;
    $data = shortcode_atts( array(
        'st_title'           => '' ,
        'st_col'             => "col-md-1" ,
        'st_select_field'    => "st_hotel" ,
        'st_select_taxonomy' => "" ,
        'placeholder'           => '' ,
        'st_advance_field' => "no" ,
        'is_required' => "off" ,
    ) , $arg , 'st_list_half_map_field_tour' );
    extract( $data );

    $default = array(
        'title'    => $st_title ,
        'taxonomy' => $st_select_taxonomy,
        'placeholder' => $placeholder,
        'is_required' => $is_required,
    );
    $text    = '<div class="' . $st_col . '">
                            ' . st()->load_template( 'tours/elements/search/field-' . $st_select_field , false , array( 'data'       => $default ,
                                                                                                                        'field_size' => 'md'
        ) ) . '
                        </div>';
    if($st_advance_field == 'yes'){
        $st_form_search_advance_field_half_map .= $text;
        $text = "";
    }
    return $text;
}

    st_reg_shortcode('st_list_half_map_field_tour','st_list_half_map_field_tour_func');
}

if(!function_exists('st_list_half_map_field_activity_func'))
{
    function st_list_half_map_field_activity_func( $arg , $content = null )
{
    global $st_form_search_advance_field_half_map;
    $data = shortcode_atts( array(
        'st_title'           => '' ,
        'st_col'             => "col-md-1" ,
        'st_select_field'    => "st_hotel" ,
        'st_select_taxonomy' => "" ,
        'placeholder'           => '' ,
        'st_advance_field' => "no" ,
        'is_required' => "off" ,
    ) , $arg , 'st_list_half_map_field_activity' );
    extract( $data );

    $default = array(
        'title'    => $st_title ,
        'taxonomy' => $st_select_taxonomy,
        'placeholder' => $placeholder,
        'is_required' => $is_required,
    );
    $text    = '<div class="' . $st_col . '">
                            ' . st()->load_template( 'activity/elements/search/field-' . $st_select_field , false , array( 'data'       => $default ,
                                                                                                                           'field_size' => 'md'
        ) ) . '
                        </div>';
    if($st_advance_field == 'yes'){
        $st_form_search_advance_field_half_map .= $text;
        $text = "";
    }
    return $text;
}

    st_reg_shortcode('st_list_half_map_field_activity','st_list_half_map_field_activity_func');
}

if(!function_exists('st_list_half_map_field_range_km_func'))
{
    function st_list_half_map_field_range_km_func( $arg , $content = null )
    {
        wp_enqueue_script( 'ionrangeslider.js' );
        global $st_form_search_advance_field_half_map;
        $data = shortcode_atts( array(
            'st_title'     => '' ,
            'st_col'       => "col-md-1" ,
            'max_range_km' => 20 ,
            'st_advance_field' => "no" ,
            'is_required' => "off" ,
        ) , $arg , 'st_list_half_map_field_range_km' );
        extract( $data );
        $data_min_max[ "min" ] = 0;
        $data_min_max[ "max" ] = $max_range_km;
        $text                  = '
                 <div class="' . $st_col . '">
                    <div class="form-group form-group-md ">
                         <label>' . $st_title . '</label>
                         <input type="text" name="range" value="' . STInput::get( 'range' ) . '" class="range-slider" data-symbol="' . TravelHelper::get_current_currency( 'symbol' ) . '" data-min="' . $data_min_max[ 'min' ] . '" data-max="' . $data_min_max[ 'max' ] . '" data-step="1">
                    </div>
                 </div>';
        if($st_advance_field == 'yes'){
            $st_form_search_advance_field_half_map .= $text;
            $text = "";
        }
        return $text;
    }

    st_reg_shortcode('st_list_half_map_field_range_km','st_list_half_map_field_range_km_func');
}

if(!function_exists( 'st_search_list_half_map' )) {
    function st_search_list_half_map( $attr , $content = false )
    {

        $post_type = STInput::request( 'post_type' );
        $zoom      = STInput::request( 'zoom' );
        $number    = STInput::request( 'number' , 8 );
        $style_map = STInput::request( 'style_map' );

        $query           = array(
            'post_type'      => $post_type ,
            'posts_per_page' => $number ,
            'post_status'    => 'publish' ,
            's'              => '' ,
        );
        $map_lat_center  = 0;
        $map_lng_center  = 0;
        $location_center = '[0,0]';
        $address_center  = '';
        /*if(STInput::request( 'location_name' )) {
            $ids_location = TravelerObject::_get_location_by_name( STInput::get( 'location_name' ) );
            if(!empty( $ids_location )) {
                $_REQUEST['location_name'] = implode(',',$ids_location);
                $map_lat_center  = get_post_meta( $ids_location[ 0 ] , 'map_lat' , true );
                $map_lng_center  = get_post_meta( $ids_location[ 0 ] , 'map_lng' , true );
                $location_center = '[' . $map_lat_center . ',' . $map_lng_center . ']';
                $address_center  = get_the_title( $ids_location[ 0 ] );
            }
        }*/
        if(STInput::request( 'pick-up' )) {
            $ids_location = TravelerObject::_get_location_by_name( STInput::get( 'pick-up' ) );
            if(!empty( $ids_location )) {
                $_REQUEST[ 'pick-up' ] = implode( ',' , $ids_location );
                $map_lat_center        = get_post_meta( $ids_location[ 0 ] , 'map_lat' , true );
                $map_lng_center        = get_post_meta( $ids_location[ 0 ] , 'map_lng' , true );
                $location_center       = '[' . $map_lat_center . ',' . $map_lng_center . ']';
                $address_center        = get_the_title( $ids_location[ 0 ] );
            }
        }
        if(STInput::request( 'location_id' )) {
            $map_lat_center  = get_post_meta( STInput::request( 'location_id' ) , 'map_lat' , true );
            $map_lng_center  = get_post_meta( STInput::request( 'location_id' ) , 'map_lng' , true );
            $location_center = '[' . $map_lat_center . ',' . $map_lng_center . ']';
            $address_center  = get_the_title( STInput::request( 'location_id' ) );
        }
        if(STInput::request( 'location_id_pick_up' )) {
            $map_lat_center  = get_post_meta( STInput::request( 'location_id_pick_up' ) , 'map_lat' , true );
            $map_lng_center  = get_post_meta( STInput::request( 'location_id_pick_up' ) , 'map_lng' , true );
            $location_center = '[' . $map_lat_center . ',' . $map_lng_center . ']';
            $address_center  = get_the_title( STInput::request( 'location_id_pick_up' ) );
        }
        $data_map = array();

        wp_reset_query(); wp_reset_postdata();

        global $wp_query , $st_search_query;
        switch( $post_type ) {
            case"st_hotel":
                $hotel = STHotel::inst();
                $hotel->alter_search_query();
                break;
            case"st_rental":
                $rental = STRental::inst();
                $rental->alter_search_query();
                break;
            case"st_cars":
                st()->car->alter_search_query();
                break;
            case"st_tours":
                st()->tour->alter_search_query();
                break;
            case"st_activity":
                $activity = STActivity::inst();
                $activity->alter_search_query();
                break;
        }
        query_posts( $query );
        global $wp_query;

        $stt = 0;
        while( have_posts() ) {
            the_post();

            $map_lat = get_post_meta( get_the_ID() , 'map_lat' , true );
            $map_lng = get_post_meta( get_the_ID() , 'map_lng' , true );
            if(!empty( $map_lat ) and !empty( $map_lng )) {
                $post_type                       = get_post_type();
                $data_map[ $stt ][ 'id' ]        = get_the_ID();
                $data_map[ $stt ][ 'name' ]      = get_the_title();
                $data_map[ $stt ][ 'post_type' ] = $post_type;
                $data_map[ $stt ][ 'lat' ]       = $map_lat;
                $data_map[ $stt ][ 'lng' ]       = $map_lng;
                $post_type_name                  = get_post_type_object( $post_type );
                $post_type_name->label;
                switch( $post_type ) {
                    case"st_hotel";
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_hotel_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_black.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                    case"st_rental";
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_rental_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_brown.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                    case"st_cars";
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_cars_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_green.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                    case"st_tours";
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_tours_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_purple.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                    case"st_activity";
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_activity_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_yellow.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                }
                $stt++;
            }
        }
        $st_search_query = $wp_query;
        switch( $post_type ) {
            case"st_hotel":
                $hotel->remove_alter_search_query();
                break;
            case"st_rental":
                $rental->remove_alter_search_query();
                break;
            case"st_cars":
                st()->car->remove_alter_search_query();
                break;
            case"st_tours":
                st()->tour->remove_alter_search_query();
                break;
            case"st_activity":
                $activity->remove_alter_search_query();
                break;
        }
        if(!empty( $_REQUEST[ 'st_test' ] )) {
        }
        wp_reset_query();
        /*if($location_center == '[,]' or $location_center == '[0,0]') {
            $location_center = '[21.289374,15.644531]';
            $data_map        = "";
            $zoom            = "3";
        }*/
        $data_tmp = array(
            'location_center' => $location_center ,
            'zoom'            => $zoom ,
            'data_map'        => $data_map ,
            'style_map'       => $style_map ,
            'number'          => $number ,
            'address_center'  => $address_center ,
            'map_lat_center'  => $map_lat_center ,
            'map_lng_center'  => $map_lng_center ,
        );


        echo json_encode( $data_tmp );

        die();
    }
}
add_action( 'wp_ajax_st_search_list_half_map' , 'st_search_list_half_map' );
add_action( 'wp_ajax_nopriv_st_search_list_half_map' , 'st_search_list_half_map' );
if(!class_exists( 'st_list_half_map' )) {
    class st_list_half_map
    {
        static function _get_query_where( $where )
        {
            $post_type = $_SESSION[ 'el_st_type' ];
            if(!TravelHelper::checkTableDuplicate( $post_type ))
                return $where;
            global $wpdb;
            $location_id = $_SESSION[ 'el_location_id' ];
            if(!empty( $location_id )) {
                $where = TravelHelper::_st_get_where_location($location_id,array($post_type),$where);
            }
            return $where;
        }

        static function _get_query_join( $join )
        {
            $post_type = $_SESSION[ 'el_st_type' ];
            if(!TravelHelper::checkTableDuplicate( $post_type ))
                return $join;
            global $wpdb;

            $table = $wpdb->prefix . $post_type;

            $join .= " INNER JOIN {$table} as tb ON {$wpdb->prefix}posts.ID = tb.post_id";
            return $join;
        }
    }
}
//-------- End ST List Half Map -------------


//---------ST List Map-----------------------------------

if(!function_exists('st_list_map_func'))
{
    function st_list_map_func( $attr , $content = null )
{
    global $st_form_search_advance_field;
    $data = shortcode_atts(
        array(
            'title'              => '' ,
            'type'               => 'normal' ,
            'st_list_location'   => '' ,
            'st_type'            => 'st_hotel' ,
            'zoom'               => '13' ,
            'height'             => '500' ,
            'number'             => '12' ,
            'fit_bounds'         => 'no' ,
            'style_map'          => 'normal' ,
            'custom_code_style'  => '' ,
            'show_search_box'    => 'yes' ,
            'show_data_list_map' => 'yes' ,
        ) , $attr , 'st_list_map' );
    extract( $data );
    $data_map       = array();
    $form_search    = st_remove_wpautop( $content );
    $form_search_advance    = $st_form_search_advance_field;
    $html           = '';
    $map_lat_center = 0;
    $map_lng_center = 0;
    if($type == "normal") {
        global $wp_query;
        global $st_search_args;
        $data['location_id'] = $data['st_list_location'];
        $st_search_args=$data;

        $ids = $st_list_location;
        if( count(explode(',',$st_list_location)) > 1) {
            $ids = explode( ',' , $st_list_location );
            $ids = $ids[0];
        }
        $map_lat         = get_post_meta( $ids , 'map_lat' , true );
        $map_lng         = get_post_meta( $ids , 'map_lng' , true );
        $location_center = '[' . $map_lat . ',' . $map_lng . ']';

        switch($st_type){
            case"st_hotel":
                if(class_exists('STHotel')) {
                    $hotel = STHotel::inst();
                    $hotel->alter_search_query();
                }
                break;
            case"st_rental":
                if(class_exists('STRental')) {
                    $rental = STRental::inst();
                    $rental->alter_search_query();
                }
                break;
            case"st_cars":
                if(class_exists('STCars')) {
                    st()->car->alter_search_query();
                }
                break;
            case"st_tours":
                if(class_exists('STTour')) {
                    st()->tour->alter_search_query();
                }
                break;
            case"st_activity":
                if(class_exists('STActivity')){
                $activity = STActivity::inst();
                $activity->alter_search_query();
                }
                break;
        }
        $query           = array(
            'post_type'      => explode( ',' , $st_type ) ,
            'posts_per_page' => $number ,
            'post_status'    => 'publish' ,
        );
        query_posts( $query );
        switch( $st_type ) {
            case"st_hotel":
                if(class_exists('STHotel')) {
                    $hotel->remove_alter_search_query();
                }
                break;
            case"st_rental":

                if(class_exists('STRental')) {
                    $rental->remove_alter_search_query();
                }
                break;
            case"st_cars":
                if(class_exists('STCars')) {
                    st()->car->remove_alter_search_query();
                }
                break;
            case"st_tours":
                if(class_exists('STTour')) {
                    st()->tour->remove_alter_search_query();
                }
                break;
            case"st_activity":
                if(class_exists('STActivity')) {
                    $activity->remove_alter_search_query();
                }
                break;
        }
    }
    if($type == "page_search") {
        $location_center = '[0,0]';
        $address_center  = '';
        if(STInput::request( 'pick-up' )) {
            $ids_location = TravelerObject::_get_location_by_name( STInput::get( 'pick-up' ) );
            if(!empty( $ids_location )) {
                $_REQUEST[ 'pick-up' ] = implode( ',' , $ids_location );
                $map_lat_center        = get_post_meta( $ids_location[ 0 ] , 'map_lat' , true );
                $map_lng_center        = get_post_meta( $ids_location[ 0 ] , 'map_lng' , true );
                $location_center       = '[' . $map_lat_center . ',' . $map_lng_center . ']';
                $address_center        = get_the_title( $ids_location[ 0 ] );
            }
        }
        if(STInput::request( 'location_id' )) {
            $map_lat_center  = get_post_meta( STInput::request( 'location_id' ) , 'map_lat' , true );
            $map_lng_center  = get_post_meta( STInput::request( 'location_id' ) , 'map_lng' , true );
            $location_center = '[' . $map_lat_center . ',' . $map_lng_center . ']';
            $address_center  = get_the_title( STInput::request( 'location_id' ) );
        }
        if(STInput::request( 'location_id_pick_up' )) {
            $map_lat_center  = get_post_meta( STInput::request( 'location_id_pick_up' ) , 'map_lat' , true );
            $map_lng_center  = get_post_meta( STInput::request( 'location_id_pick_up' ) , 'map_lng' , true );
            $location_center = '[' . $map_lat_center . ',' . $map_lng_center . ']';
            $address_center  = get_the_title( STInput::request( 'location_id_pick_up' ) );
        }

        global $wp_query , $st_search_query;
        switch( $st_type ) {
            case"st_hotel":
                $hotel = STHotel::inst();
                $hotel->alter_search_query();
                break;
            case"st_rental":
                $rental = STRental::inst();
                $rental->alter_search_query();
                break;
            case"st_cars":
                st()->car->alter_search_query();
                break;
            case"st_tours":
                st()->tour->alter_search_query();
                break;
            case"st_activity":
                $activity = STActivity::inst();
                $activity->alter_search_query();
                break;
        }

        $query = array(
            'post_type'      => $st_type ,
            'posts_per_page' => $number ,
            'post_status'    => 'publish' ,
            's'              => '' ,
        );
        query_posts( $query );
    }

    $stt = 0;
    while( have_posts() ) {
        the_post();
        $map_lat = get_post_meta( get_the_ID() , 'map_lat' , true );
        $map_lng = get_post_meta( get_the_ID() , 'map_lng' , true );
        if(!empty( $map_lat ) and !empty( $map_lng ) and is_numeric( $map_lat ) and is_numeric( $map_lng )) {
            $post_type                       = get_post_type();
            $data_map[ $stt ][ 'id' ]        = get_the_ID();
            $data_map[ $stt ][ 'name' ]      = get_the_title();
            $data_map[ $stt ][ 'post_type' ] = $post_type;
            $data_map[ $stt ][ 'lat' ]       = $map_lat;
            $data_map[ $stt ][ 'lng' ]       = $map_lng;
            $post_type_name                  = get_post_type_object( $post_type );
            if(empty($post_type_name)) continue;
            $post_type_name->label;
            switch( $post_type ) {
                case"st_hotel";
                    $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_hotel_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_black.png' );
                    $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                    $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                    break;
                case"st_rental";
                    $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_rental_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_brown.png' );
                    $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                    $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                    break;
                case"st_cars";
                    $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_cars_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_green.png' );
                    $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                    $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                    break;
                case"st_tours";
                    $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_tours_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_purple.png' );
                    $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                    $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                    break;
                case"st_activity";
                    $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_activity_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_yellow.png' );
                    $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                    $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                    break;
            }
            $stt++;
        }

    }
    if($type == "page_search") {
        $st_search_query = $wp_query;
        switch( $post_type ) {
            case"st_hotel":
                $hotel->remove_alter_search_query();
                break;
            case"st_rental":
                $rental->remove_alter_search_query();
                break;
            case"st_cars":
                st()->car->remove_alter_search_query();
                break;
            case"st_tours":
                st()->tour->remove_alter_search_query();
                break;
            case"st_activity":
                $activity->remove_alter_search_query();
                break;
        }
    }

    wp_reset_query();
    if(empty( $location_center ) or $location_center == '[,]')
        $location_center = '[0,0]';
    $data_tmp               = array(
        'location_center'    => $location_center ,
        'zoom'               => $zoom ,
        'data_map'           => $data_map ,
        'height'             => $height ,
        'style_map'          => $style_map ,
        'st_type'            => $st_type ,
        'number'             => $number ,
        'fit_bounds'         => $fit_bounds ,
        'title'              => $title ,
        'show_search_box'    => $show_search_box ,
        'show_data_list_map' => $show_data_list_map ,
        'form_search'        => $form_search ,
        'form_search_advance'        => $form_search_advance ,
    );
    $data_tmp[ 'data_tmp' ] = $data_tmp;
    $html                   = st()->load_template( 'vc-elements/st-list-map/html' , '' , $data_tmp );

    return $html;
}

    st_reg_shortcode('st_list_map','st_list_map_func');

    if(class_exists( 'WPBakeryShortCodesContainer' ) and !class_exists( 'WPBakeryShortCode_st_list_map' )) {
        class WPBakeryShortCode_st_list_map extends WPBakeryShortCodesContainer
        {
            protected function content( $attr , $content = null )
            {
                return st_list_map_func($attr,$content);
            }
        }
    }
}

if(!function_exists('st_list_map_field_hotel_func'))
{
    function st_list_map_field_hotel_func( $arg , $content = null )
{
    global $st_form_search_advance_field;
    $data = shortcode_atts( array(
        'st_title'           => '' ,
        'placeholder'           => '' ,
        'st_col'             => "col-md-1" ,
        'st_select_field'    => "location" ,
        'st_advance_field' => "no" ,
        'st_select_taxonomy' => "" ,
        'is_required' => "off" ,
    ) , $arg , 'st_list_map_field_hotel' );
    extract( $data );
    $default = array(
        'title'    => $st_title ,
        'taxonomy' => $st_select_taxonomy,
        'placeholder' => $placeholder,
        'is_required' => $is_required,
    );
    $text = "";
    if($st_advance_field == 'no'){
        $text    = '<div class="' . $st_col . '">' . st()->load_template( 'hotel/elements/search/field_' . $st_select_field , false , array( 'data'       => $default , 'field_size' => 'md' ) ) . '</div>';
    }else{
        $st_form_search_advance_field .= '<div class="' . $st_col . '">' . st()->load_template( 'hotel/elements/search/field_' . $st_select_field , false , array( 'data'       => $default , 'field_size' => 'md' ) ) . '</div>';
    }
    return $text;
}

    st_reg_shortcode('st_list_map_field_hotel','st_list_map_field_hotel_func');
}
if(!function_exists('st_list_map_field_rental_func'))
{
    function st_list_map_field_rental_func( $arg , $content = null )
{
    global $st_form_search_advance_field;
    $data = shortcode_atts( array(
        'st_title'           => '' ,
        'placeholder'           => '' ,
        'st_col'             => "col-md-1" ,
        'st_select_field'    => "location" ,
        'st_advance_field' => "no" ,
        'st_select_taxonomy' => "" ,
        'is_required' => "off" ,
    ) , $arg , 'st_list_map_field_rental' );
    extract( $data );

    $default = array(
        'title'    => $st_title ,
        'taxonomy' => $st_select_taxonomy,
        'placeholder' => $placeholder,
        'is_required' => $is_required,
    );
    $text = "";
    if($st_advance_field == 'no'){
        $text    = '<div class="' . $st_col . '">' . st()->load_template( 'rental/elements/search/field_' . $st_select_field , false , array( 'data'       => $default , 'field_size' => 'md' ) ) . '</div>';
    }else{
        $st_form_search_advance_field .= '<div class="' . $st_col . '">' . st()->load_template( 'rental/elements/search/field_' . $st_select_field , false , array( 'data'       => $default , 'field_size' => 'md' ) ) . '</div>';
    }
    return $text;
}


    st_reg_shortcode('st_list_map_field_rental','st_list_map_field_rental_func');
}
if(!function_exists('st_list_map_field_car_func'))
{
    function st_list_map_field_car_func( $arg , $content = null )
{
    global $st_form_search_advance_field;
    $data = shortcode_atts( array(
        'st_title'           => '' ,
        'placeholder'           => '' ,
        'st_col'             => "col-md-1" ,
        'st_select_field'    => "location" ,
        'st_advance_field' => "no" ,
        'st_select_taxonomy' => "" ,
        'is_required' => "off" ,
    ) , $arg , 'st_list_map_field_car' );
    extract( $data );

    $default = array(
        'title'    => $st_title ,
        'taxonomy' => $st_select_taxonomy,
        'placeholder' => $placeholder,
        'is_required' => $is_required,
    );

    $text = "";
    if($st_advance_field == 'no'){
        $text    = '<div class="' . $st_col . '">' . st()->load_template( 'cars/elements/search/field-' . $st_select_field , false , array( 'data'       => $default , 'field_size' => 'md' ) ) . '</div>';
    }else{
        $st_form_search_advance_field .= '<div class="' . $st_col . '">' . st()->load_template( 'cars/elements/search/field-' . $st_select_field , false , array( 'data'       => $default , 'field_size' => 'md' ) ) . '</div>';
    }
    return $text;
}

    st_reg_shortcode('st_list_map_field_car','st_list_map_field_car_func');
}

if(!function_exists('st_list_map_field_tour_func'))
{
    function st_list_map_field_tour_func( $arg , $content = null )
{
    global $st_form_search_advance_field;
    $data = shortcode_atts( array(
        'st_title'           => '' ,
        'placeholder'           => '' ,
        'st_col'             => "col-md-1" ,
        'st_select_field'    => "location" ,
        'st_advance_field' => "no" ,
        'st_select_taxonomy' => "" ,
        'is_required' => "off" ,
    ) , $arg , 'st_list_map_field_tour' );
    extract( $data );

    $default = array(
        'title'    => $st_title ,
        'taxonomy' => $st_select_taxonomy,
        'placeholder' => $placeholder,
        'is_required' => $is_required,
    );

    $text = "";
    if($st_advance_field == 'no'){
        $text    = '<div class="' . $st_col . '">' . st()->load_template( 'tours/elements/search/field-' . $st_select_field , false , array( 'data'       => $default , 'field_size' => 'md' ) ) . '</div>';
    }else{
        $st_form_search_advance_field .= '<div class="' . $st_col . '">' . st()->load_template( 'tours/elements/search/field-' . $st_select_field , false , array( 'data'       => $default , 'field_size' => 'md' ) ) . '</div>';
    }
    return $text;
}


    st_reg_shortcode('st_list_map_field_tour','st_list_map_field_tour_func');
}

if(!function_exists('st_list_map_field_activity_func'))
{
    function st_list_map_field_activity_func( $arg , $content = null )
{
    global $st_form_search_advance_field;
    $data = shortcode_atts( array(
        'st_title'           => '' ,
        'placeholder'           => '' ,
        'st_col'             => "col-md-1" ,
        'st_select_field'    => "location" ,
        'st_advance_field' => "no" ,
        'st_select_taxonomy' => "" ,
        'is_required' => "off" ,
    ) , $arg , 'st_list_map_field_activity' );
    extract( $data );

    $default = array(
        'title'    => $st_title ,
        'taxonomy' => $st_select_taxonomy,
        'placeholder' => $placeholder,
        'is_required' => $is_required
    );

    $text = "";
    if($st_advance_field == 'no'){
        $text    = '<div class="' . $st_col . '">' . st()->load_template( 'activity/elements/search/field-' . $st_select_field , false , array( 'data'       => $default , 'field_size' => 'md' ) ) . '</div>';
    }else{
        $st_form_search_advance_field  .= '<div class="' . $st_col . '">' . st()->load_template( 'activity/elements/search/field-' . $st_select_field , false , array( 'data'       => $default , 'field_size' => 'md' ) ) . '</div>';
    }
    return $text;
}

    st_reg_shortcode('st_list_map_field_activity','st_list_map_field_activity_func');
}

if(!function_exists('st_list_map_field_range_km_func'))
{
    function st_list_map_field_range_km_func( $arg , $content = null )
{
    wp_enqueue_script( 'ionrangeslider.js' );
    global $st_form_search_advance_field;
    $data = shortcode_atts( array(
        'st_title'     => '' ,
        'st_col'       => "col-md-1" ,
        'max_range_km' => 20 ,
        'st_advance_field' => "no" ,
    ) , $arg , 'st_list_map_field_range_km' );
    extract( $data );
    $data_min_max[ "min" ] = 0;
    $data_min_max[ "max" ] = $max_range_km;

    $text = "";
    if($st_advance_field == 'no'){
        $text    = '
                 <div class="' . $st_col . '">
                    <div class="form-group form-group-md ">
                         <label>' . $st_title . '</label>
                         <input type="text" name="range" value="' . STInput::get( 'range' ) . '" class="range-slider" data-symbol="' . TravelHelper::get_current_currency( 'symbol' ) . '" data-min="' . $data_min_max[ 'min' ] . '" data-max="' . $data_min_max[ 'max' ] . '" data-step="1">
                    </div>
                 </div>';
    }else{
        $st_form_search_advance_field  .= '
                 <div class="' . $st_col . '">
                    <div class="form-group form-group-md ">
                         <label>' . $st_title . '</label>
                         <input type="text" name="range" value="' . STInput::get( 'range' ) . '" class="range-slider" data-symbol="' . TravelHelper::get_current_currency( 'symbol' ) . '" data-min="' . $data_min_max[ 'min' ] . '" data-max="' . $data_min_max[ 'max' ] . '" data-step="1">
                    </div>
                 </div>';
    }
    return $text;

}

    st_reg_shortcode('st_list_map_field_range_km','st_list_map_field_range_km_func');
}


if(!class_exists( 'st_list_map' )) {
    class st_list_map
    {
        static function _get_query_where( $where )
        {
            $post_type     = $_SESSION[ 'el_st_type' ];
            $location_id = $_SESSION[ 'el_location_id' ];
            if(!TravelHelper::checkTableDuplicate( $post_type ))
                return $where;

            if(!empty( $location_id ) ) {
                $where = TravelHelper::_st_get_where_location($location_id,array($post_type),$where);
            }
            return $where;

            /*$location_field = 'id_location';
            if($st_type == 'st_rental')
                $location_field = 'location_id';

            if(is_array( $location_id )) {
                $where .= " AND (";
                foreach( $location_id as $k => $v ) {
                    $list = TravelHelper::getLocationByParent( $v );
                    $list[] = $v;
                    if(is_array( $list ) && count( $list )) {
                        if($k == 0)
                            $where .= "  ("; else $where .= " OR (";;
                        $where_tmp = "";
                        foreach( $list as $item ) {
                            if(empty( $where_tmp )) {
                                $where_tmp .= "tb.multi_location LIKE '%_{$item}_%'";
                            } else {
                                $where_tmp .= " OR tb.multi_location LIKE '%_{$item}_%'";
                            }
                        }
                        $list = implode( ',' , $list );
                        $where_tmp .= " OR tb.{$location_field} IN ({$list})";
                        $where .= $where_tmp . ")";
                    } else {
                        $where .= " AND (tb.multi_location LIKE '%_{$location_id}_%' OR tb.{$location_field} IN ('{$location_id}')) ";
                    }
                }
                $where .= " )";
            } else {
                $list = TravelHelper::getLocationByParent( $location_id );
                $list[] = $location_id;
                if(is_array( $list ) && count( $list )) {
                    $where .= " AND (";
                    $where_tmp = "";
                    foreach( $list as $item ) {
                        if(empty( $where_tmp )) {
                            $where_tmp .= "tb.multi_location LIKE '%_{$item}_%'";
                        } else {
                            $where_tmp .= " OR tb.multi_location LIKE '%_{$item}_%'";
                        }
                    }
                    $list = implode( ',' , $list );
                    $where_tmp .= " OR tb.{$location_field} IN ({$list})";
                    $where .= $where_tmp . ")";
                } else {
                    $where .= " AND (tb.multi_location LIKE '%_{$location_id}_%' OR tb.{$location_field} IN ('{$location_id}')) ";
                }
            }
            return $where;*/
        }

        static function _get_query_join( $join )
        {
            $st_type = $_SESSION[ 'el_st_type' ];
            if(!TravelHelper::checkTableDuplicate( $st_type ))
                return $join;
            global $wpdb;

            $table = $wpdb->prefix . $st_type;

            $join .= " INNER JOIN {$table} as tb ON {$wpdb->prefix}posts.ID = tb.post_id";
            return $join;
        }
    }
}
//---------End ST List Map-----------------------------------
if (!function_exists('st_single_hotel_table_ft')) {
    function st_single_hotel_table_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/hotel/elements/table_membership', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_single_hotel_table', 'st_single_hotel_table_ft');
}
if (!function_exists('st_title_line_ft')) {
    function st_title_line_ft($attr, $content)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/title-content', '', array('attr' => $attr, 'content' => $content));
    }

    st_reg_shortcode('st_title_line', 'st_title_line_ft');
}

if (!function_exists('st_language_currency_new')) {
    function st_language_currency_new($attr, $content = false)
    {
        $attr = shortcode_atts([

        ], $attr);

        return st()->load_template('layouts/modern/elements/language_currency', '', $attr);
    }

    st_reg_shortcode('st_language_currency_new', 'st_language_currency_new');
}