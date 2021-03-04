<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/15/14
 * Time: 9:44 AM
 */
if(!st_check_service_available( 'st_activity' )) {
   return;
}
/**
* ST Thumbnail Activity
* @since 1.1.0
**/

if(!function_exists('st_thumbnail_activity_func'))
{
    function st_thumbnail_activity_func()
    {
        if(is_singular('st_activity'))
        {
            return st()->load_template('activity/elements/image','featured');
        }
    }

    st_reg_shortcode('st_thumbnail_activity','st_thumbnail_activity_func');
}

/**
* ST Form Book
* @since 1.1.0
**/

if(!function_exists('st_form_book_func'))
{
    function st_form_book_func()
    {
        if(is_singular('st_activity'))
        {
            return st()->load_template('activity/elements/form','book');
        }
    }
    st_reg_shortcode('st_form_book','st_form_book_func');
}

/**
* ST Excerpt Activity
* @since 1.1.0
**/


if(!function_exists('st_excerpt_activity_func'))
{
    function st_excerpt_activity_func()
    {
        if(is_singular('st_activity'))
        {
            while(have_posts())
            {
                the_post();
                return '<blockquote class="center">'.get_the_excerpt()."</blockquote>";
            }

        }
    }
    st_reg_shortcode('st_excerpt_activity','st_excerpt_activity_func');
}

/**
* ST Activity Content
* @since 1.1.0
**/

if(!function_exists('st_activity_content_func'))
{
    function st_activity_content_func()
    {
        if(is_singular('st_activity'))
        {
             return st()->load_template('activity/elements/content','activity');
        }
    }
    st_reg_shortcode('st_activity_content','st_activity_content_func');
}

/**
* ST Activity Detail Map
* @since 1.1.0
**/


if(!function_exists('st_activity_detail_map'))
{
    function st_activity_detail_map($attr)
    {
        if(is_singular('st_activity')) {

            $default = array(
                'number'      => '12' ,
                'range'       => '20' ,
                'show_circle' => 'no' ,
            );
			$dump = wp_parse_args( $attr , $default);
            extract( $dump  );
            $lat   = get_post_meta( get_the_ID() , 'map_lat' , true );
            $lng   = get_post_meta( get_the_ID() , 'map_lng' , true );
            $zoom  = get_post_meta( get_the_ID() , 'map_zoom' , true );
            $class = STActivity::inst();
            $data  = $class->get_near_by( get_the_ID() , $range , $number );
            $location_center                     = '[' . $lat . ',' . $lng . ']';
            $data_map                            = array();
            $data_map[ 0 ][ 'id' ]               = get_the_ID();
            $data_map[ 0 ][ 'name' ]             = get_the_title();
            $data_map[ 0 ][ 'post_type' ]        = get_post_type();
            $data_map[ 0 ][ 'lat' ]              = $lat;
            $data_map[ 0 ][ 'lng' ]              = $lng;
            $data_map[ 0 ][ 'icon_mk' ]          = get_template_directory_uri() . '/img/mk-single.png';
            $data_map[ 0 ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/activity' , false , array( 'post_type' => '' ) ) );
            $data_map[ 0 ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/activity' , false , array( 'post_type' => '' ) ) );
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
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_activity_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_yellow.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/activity' , false , array( 'post_type' => '' ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/activity' , false , array( 'post_type' => '' ) ) );
                        $stt++;
                    }
                endforeach;
                wp_reset_postdata();
            }
            $properties = $class->properties_near_by(get_the_ID(), $lat, $lng, $range);
            if( !empty($properties)){
                foreach($properties as $key => $val){
                    $data_map[] = array(
                        'id' => get_the_ID(),
                        'name' => $val['name'],
                        'post_type' => 'st_activity',
                        'lat' => (float)$val['lat'],
                        'lng' => (float)$val['lng'],
                        'icon_mk' => (empty($val['icon']))? 'http://maps.google.com/mapfiles/marker_black.png': $val['icon'],
                        'content_html' => preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/property' , null , array( 'post_type' => '', 'data' => $val ) ) ),
                        'content_adv_html' => preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/property' , null , array( 'post_type' => '', 'data' => $val ) ) ),
                    );
                }
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
            );
            $data_tmp[ 'data_tmp' ] = $data_tmp;
            $html                   = '<div class="map_single">'.st()->load_template( 'hotel/elements/detail' , 'map' , $data_tmp ).'</div>';
            return $html;

        }
    }
    st_reg_shortcode('st_activity_detail_map','st_activity_detail_map');
}

/**
* ST Activity Detail Review Summary
* @since 1.1.0
**/


if(!function_exists('st_activity_detail_review_summary'))
{
    function st_activity_detail_review_summary()
    {

        if(is_singular('st_activity'))
        {
            return st()->load_template('activity/elements/review_summary');
        }
    }
    st_reg_shortcode('st_activity_detail_review_summary','st_activity_detail_review_summary');
}

/**
* ST Activity Detail Review Detail
* @since 1.1.0
**/


if(!function_exists('st_activity_detail_review_detail'))
{
    function st_activity_detail_review_detail()
    {
        if(is_singular('st_activity'))
        {
            return st()->load_template('activity/elements/review_detail');
        }
    }
    st_reg_shortcode('st_activity_detail_review_detail','st_activity_detail_review_detail');
}

/**
* ST Activity Review
* @since 1.1.0
**/

if(!function_exists('st_activity_review'))
{
    function st_activity_review($attr = array())
    {
        $default = array(
            'title'   => '' ,
            'font_size'   => '3' ,
        );
        extract( wp_parse_args( $attr , $default ) );
        if(is_singular('st_activity'))
        {
            if(comments_open() and st()->get_option('activity_review')!='off')
            {
                ob_start();
                    comments_template('/reviews/reviews.php');
                $html =  @ob_get_clean();
                if(!empty($title) and !empty($html)){
                    $html = '<h'.$font_size.'>'.$title.'</h'.$font_size.'>'.$html;
                }
                return $html;
            }
        }
    }
}
st_reg_shortcode('st_activity_review','st_activity_review');

/**
* ST Activity Video
* @since 1.1.0
**/


if(!function_exists('st_activity_video'))
{
    function st_activity_video($attr=array())
    {
        if(is_singular('st_activity'))
        {
            if($video=get_post_meta(get_the_ID(),'video',true)){
                return "<div class='media-responsive'>".wp_oembed_get($video)."</div>";
            }
        }
    }
    st_reg_shortcode('st_activity_video','st_activity_video');
}

/**
* ST Activity Nearby
* @since 1.1.0
**/

if(!function_exists('st_activity_nearby'))
{
    function st_activity_nearby($attr=array())
    {
        $default = array(
            'title'   => '' ,
            'font_size'   => '3' ,
        );
		$data= wp_parse_args( $attr , $default );
        extract(  wp_parse_args( $attr , $default ) );
        if(is_singular('st_activity'))
        {
            $html = st()->load_template('activity/elements/nearby',false,$data);

            return $html;
        }
    }
    st_reg_shortcode('st_activity_nearby','st_activity_nearby');
}

/**
 * ST activity show discount
 * @since 1.1.9
 **/



if(!function_exists( 'st_activity_show_discount' )) {
    function st_activity_show_discount()
    {
        if(is_singular( 'st_activity' )) {
            return st()->load_template( 'activity/elements/activity_show_info_discount' );
        }
    }
}
st_reg_shortcode( 'st_activity_show_discount' , 'st_activity_show_discount' );


if (!function_exists('st_search_activity_title')) {
    function st_search_activity_title($arg = array())
    {
        if (!get_post_type() == 'st_activity' and get_query_var('post_type') != 'st_activity')
            return;

        $default = array(
            'search_modal' => 1
        );

        wp_enqueue_script('magnific.js');

        extract(wp_parse_args($arg, $default));

        $object = STActivity::inst();
        $a = '<h3 class="booking-title"><span id="count-filter-tour">' . balanceTags($object->get_result_string()) . '</span>';

        if ($search_modal) {
            $a .= '<small><a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">' . __('Change search', ST_TEXTDOMAIN) . '</a></small>';
        }
        $a .= '</h3>';

        return $a;
    }

    st_reg_shortcode('st_search_activity_title', 'st_search_activity_title');
}
if (!function_exists('st_activity_detail_attribute')) {
    function st_activity_detail_attribute($attr, $content = false)
    {
        $default = array(
            'item_col'  => 2,
            'font_size' => 4
        );
        $attr = wp_parse_args($attr, $default);
        if (is_singular('st_activity')) {
            return st()->load_template('activity/elements/attribute', null, array('attr' => $attr));
        }
    }

    st_reg_shortcode('st_activity_detail_attribute', 'st_activity_detail_attribute');
}
if (!function_exists('st_vc_activiry_content_search')) {
    function st_vc_activiry_content_search($attr, $content = false)
    {
        $default = array(
            'st_style' => 1,
            'taxonomy' => ''
        );
        $attr = wp_parse_args($attr, $default);
        return st()->load_template('activity/content', 'activity', array('attr' => $attr));
    }

    st_reg_shortcode('st_activiry_content_search', 'st_vc_activiry_content_search');

}
if (!function_exists('st_vc_activiry_content_search_ajax')) {
    function st_vc_activiry_content_search_ajax($attr, $content = false)
    {
        $default = array(
            'st_style' => 1,
            'taxonomy' => ''
        );
        $attr = wp_parse_args($attr, $default);
        return st()->load_template('activity/content', 'activity-ajax', array('attr' => $attr));
    }

    st_reg_shortcode('st_activiry_content_search_ajax', 'st_vc_activiry_content_search_ajax');
}
if (!function_exists('st_vc_activity_detail_photo')) {
    function st_vc_activity_detail_photo($attr, $content = false)
    {
        $default = array(
            'style' => 'slide'
        );
        $attr = wp_parse_args($attr, $default);
        if (is_singular('st_activity')) {
            return st()->load_template('activity/elements/photo', null, array('attr' => $attr));
        }
    }

    st_reg_shortcode('st_activity_detail_photo', 'st_vc_activity_detail_photo');

}
if(!function_exists( 'st_vc_list_activity' )) {
    function st_vc_list_activity( $attr , $content = false )
    {
        global $st_search_args;
        $param = array(
            'st_ids'                 => "" ,
            'st_number'              => 4 ,
            'st_order'               => '' ,
            'st_orderby'             => '' ,
            'st_of_row'              => 4 ,
            'only_featured_location' => 'no' ,
            'st_location'            => '' ,
            'sort_taxonomy'          => '' ,
        );
        $list_tax = TravelHelper::get_object_taxonomies_service('st_activity');
        if( !empty( $list_tax ) ){
            foreach( $list_tax as $name => $label ){
                $param['taxonomies--'. $name] = '';
            }
        }
        $data  = shortcode_atts( $param , $attr , 'st_list_activity' );
        extract( $data );
        $st_search_args=$data;


        $page = STInput::request( 'paged' );
        if(!$page) {
            $page = get_query_var( 'paged' );
        }
        $query = array(
            'post_type'      => 'st_activity' ,
            'posts_per_page' => $st_number ,
            'paged'          => $page ,
            'order'          => $st_order ,
            'orderby'        => $st_orderby
        );
        $st_search_args['featured_location']=STLocation::inst()->get_featured_ids();

        $activity = STActivity::inst();

        $activity->alter_search_query();
        query_posts( $query );

        $r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-activity/loop' , '' , $data ) . "</div>";

        $activity->remove_alter_search_query();
        wp_reset_query();
        $st_search_args=FALSE;


        return $r;
    }
    st_reg_shortcode( 'st_list_activity' , 'st_vc_list_activity' );

}
if(!function_exists( 'st_list_activity_related' )) {
    function st_list_activity_related( $attr , $content = false )
    {
        global $st_search_args;
        $data_vc = STActivity::get_taxonomy_and_id_term_tour();
        $param = array(
            'title'=>'',
            'st_ids'                 => '' ,
            'sort_taxonomy'=>'',
            'posts_per_page'  => 3,
            'st_orderby' =>'ID' ,
            'st_order'=>'DESC',
            'st_style'=>'style_4',
            'font_size' => '3' ,
        );
        $param   = array_merge( $param , $data_vc[ 'list_id_vc' ] );
        $data = shortcode_atts(
            $param , $attr , 'st_list_activity_related');
        extract($data);
        $st_search_args = $data;
        $page = STInput::request( 'paged' );
        if(!$page) {
            $page = get_query_var( 'paged' );
        }
        $query = array(
            'post_type' =>'st_activity',
            'posts_per_page'=>$posts_per_page,
            'post_status'=>'publish',
            'paged'     =>$page,
            'order'          =>  $st_order,
            'orderby'        => $st_orderby,
            'post__not_in' => array(get_the_ID())
        );
        $activity = STActivity::inst();
        $activity->alter_search_query();
        query_posts($query);
        $r =  "<div class='list_activities'>" ;
        $r .= st()->load_template('vc-elements/st-list-activity/loop' , 'list' , array());
        $r .= "</div>";
        $activity->remove_alter_search_query();
        wp_reset_query();
        if(!empty( $title ) and !empty( $r )) {
            $r = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $r;
        }
        return $r;
    }
    st_reg_shortcode( 'st_list_activity_related' , 'st_list_activity_related' );

}