<?php
if ( !class_exists( 'ST_All_Post_Type' ) ) {
    /**
     * Class STActivity
     */
    class ST_All_Post_Type extends TravelerObject
    {
        /**
         * @var
         */
        static $_inst;

        function __construct()
        {
            add_action('wp_ajax_st_filter_all_post_type_ajax', [__CLASS__, 'st_filter_all_post_type_ajax']);
            add_action('wp_ajax_nopriv_st_filter_all_post_type_ajax', [__CLASS__, 'st_filter_all_post_type_ajax']);
        }

        static function st_filter_all_post_type_ajax(){
            $style = STInput::get('style');
            $number = STInput::get('number');
            $post_type = STInput::get('post_type');

            $attr=array(
                'st_style'=>$style,
                'st_number'=>$number,
            );

            $html ='';
            global $wp_query, $st_search_query;

            $data_post_type = $post_type;

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

            echo json_encode(array(
                'status' => true,
                'content' => $html
            ));

            die;
        }

        static function inst()
        {
            if ( !self::$_inst ) {
                self::$_inst = new self();
            }

            return self::$_inst;
        }
    }
    ST_All_Post_Type::inst()->init();
}