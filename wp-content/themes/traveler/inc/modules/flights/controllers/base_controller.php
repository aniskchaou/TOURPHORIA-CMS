<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/7/2017
 * Version: 1.0
 */

if(!class_exists('ST_Flight_Base_Controller')){
    class ST_Flight_Base_Controller{
        static $_inst;

        public function __construct()
        {

            add_action('admin_enqueue_scripts', array($this, '_admin_enqueue_scripts'));

            add_action('wp_enqueue_scripts', array($this, '_enqueue_scripts'));

            add_filter('traveler_all_settings', array($this, '__addFlightSectionThemeOption'));
        }

        function _admin_enqueue_scripts(){
            //Fix error js select2 min when add new product product vari...
            if(!in_array(get_post_type( ) , array('product', 'shop_order'))) {
                //wp_enqueue_script( 'select2.js', ST_TRAVELER_URI . '/js/select2/select2.min.js', [ 'jquery' ], NULL, TRUE );
            }
            $lang      = get_locale();
            $lang_file = ST_TRAVELER_DIR . '/js/select2/select2_locale_' . $lang . '.js';
            if ( file_exists( $lang_file ) ) {
                wp_enqueue_script( 'select2-lang', ST_TRAVELER_URI . '/js/select2/select2_locale_' . $lang . '.js', [ 'jquery', 'select2.js' ], null, true );
            } else {
                $locale    = TravelHelper::get_minify_locale( $lang );
                $lang_file = ST_TRAVELER_URI . '/js/select2/select2_locale_' . $locale . '.js';
                if ( file_exists( $lang_file ) ) {
                    wp_enqueue_script( 'select2-lang', ST_TRAVELER_URI . '/js/select2/select2_locale_' . $locale . '.js', [ 'jquery', 'select2.js' ], null, true );
                }
            }
            wp_enqueue_style( 'st-select2', ST_TRAVELER_URI . '/js/select2/select2.css' );
            wp_register_script('st-flight-admin', ST_TRAVELER_URI.'/inc/modules/flights/js/flight_admin.js', array('jquery'), null, true);
            wp_register_style('st-flight-admin-css', ST_TRAVELER_URI.'/inc/modules/flights/css/flight_admin.css');

            wp_register_script( 'flight-bulk-calendar', ST_TRAVELER_URI . '/inc/modules/flights/js/bulk-calendar.js', [ 'jquery', ], null, true );
        }

        function _enqueue_scripts(){

            //wp_enqueue_script('st-custom-flight-js', ST_TRAVELER_URI.'/inc/modules/flights/js/custom_flight.js', array('jquery'),null, true);

            //wp_enqueue_style('st-flight-css', ST_TRAVELER_URI.'/inc/modules/flights/css/flight-style.css');
            //wp_register_style('st-flight-select-css', ST_TRAVELER_URI.'/inc/modules/flights/css/st-flight-select.css');
            //wp_register_script('st-flight-select-js', ST_TRAVELER_URI.'/inc/modules/flights/js/st-flight-select.js',array('jquery'),null, true);
            wp_register_script('flight-create.js', ST_TRAVELER_URI.'/inc/modules/flights/js/flight-create.js',array('jquery'),null, true);

            wp_register_script( 'flight-bulk-calendar', ST_TRAVELER_URI . '/inc/modules/flights/js/bulk-calendar.js', [ 'jquery', ], null, true );

        }

        public function __addFlightSectionThemeOption($allSetings){
	        $sections = $allSetings;
	        $sections1 = array_slice($sections, 0, 12);
	        $sections2 = array_slice($sections, 12, count($sections) - 1);
	        array_push($sections1,
		        array(
			        'id'       => 'option_flight',
			        'title'    => __('<i class="fa fa-fighter-jet"></i> Flight Options', ST_TEXTDOMAIN),
			        'settings' => array($this, '__flightSettings')
		        )
	        );
	        $sections = array_merge($sections1, $sections2);
	        return $sections;

        }

        public function __flightSettings(){
	        $r = [
		        array(
			        'id'       => 'flight_search_fields' ,
			        'label'    => __( 'Flight Search Fields' , ST_TEXTDOMAIN ) ,
			        'desc'     => __( 'You can add, sort search fields for tour' , ST_TEXTDOMAIN ) ,
			        'type'     => 'list-item' ,
			        'section'  => 'option_flight' ,
			        'settings' => array(
				        array(
					        'id'       => 'flight_field_search' ,
					        'label'    => __( 'Field Type' , ST_TEXTDOMAIN ) ,
					        'type'     => 'select' ,
					        'operator' => 'and' ,
					        'choices'  => ST_Flights_Controller::inst()->get_search_fields_name() ,
				        ) ,
				        array(
					        'id'       => 'placeholder' ,
					        'label'    => __( 'Placeholder' , ST_TEXTDOMAIN ) ,
					        'desc'     => __( 'Placeholder' , ST_TEXTDOMAIN ) ,
					        'type'     => 'text' ,
					        'operator' => 'and' ,
				        ) ,
				        array(
					        'id'       => 'layout_col' ,
					        'label'    => __( 'Layout 1 size' , ST_TEXTDOMAIN ) ,
					        'type'     => 'select' ,
					        'operator' => 'and' ,
					        'choices'  => array(
						        array(
							        'value' => '1' ,
							        'label' => __( 'column 1' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '2' ,
							        'label' => __( 'column 2' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '3' ,
							        'label' => __( 'column 3' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '4' ,
							        'label' => __( 'column 4' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '5' ,
							        'label' => __( 'column 5' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '6' ,
							        'label' => __( 'column 6' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '7' ,
							        'label' => __( 'column 7' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '8' ,
							        'label' => __( 'column 8' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '9' ,
							        'label' => __( 'column 9' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '10' ,
							        'label' => __( 'column 10' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '11' ,
							        'label' => __( 'column 11' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '12' ,
							        'label' => __( 'column 12' , ST_TEXTDOMAIN )
						        ) ,
					        ) ,
					        'std'      => 4
				        ) ,
				        array(
					        'id'       => 'layout2_col' ,
					        'label'    => __( 'Layout 2 Size' , ST_TEXTDOMAIN ) ,
					        'type'     => 'select' ,
					        'operator' => 'and' ,
					        'std'      => 4 ,
					        'choices'  => array(
						        array(
							        'value' => '1' ,
							        'label' => __( 'column 1' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '2' ,
							        'label' => __( 'column 2' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '3' ,
							        'label' => __( 'column 3' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '4' ,
							        'label' => __( 'column 4' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '5' ,
							        'label' => __( 'column 5' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '6' ,
							        'label' => __( 'column 6' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '7' ,
							        'label' => __( 'column 7' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '8' ,
							        'label' => __( 'column 8' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '9' ,
							        'label' => __( 'column 9' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '10' ,
							        'label' => __( 'column 10' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '11' ,
							        'label' => __( 'column 11' , ST_TEXTDOMAIN )
						        ) ,
						        array(
							        'value' => '12' ,
							        'label' => __( 'column 12' , ST_TEXTDOMAIN )
						        ) ,
					        )
				        ) ,

				        array(
					        'id'       => 'is_required' ,
					        'label'    => __( 'Field required' , ST_TEXTDOMAIN ) ,
					        'type'     => 'on-off' ,
					        'operator' => 'and' ,
					        'std'      => 'on' ,
				        ) ,
			        ) ,
			        'std'      => array(
				        array(
					        'title'              => __('From', ST_TEXTDOMAIN) ,
					        'layout_col'         => 6 ,
					        'layout2_col'        => 3 ,
					        'flight_field_search' => 'origin',
					        'placeholder'    => __("Location / Airport" , ST_TEXTDOMAIN)
				        ) ,
				        array(
					        'title'              => __('To', ST_TEXTDOMAIN) ,
					        'layout_col'         => 6 ,
					        'layout2_col'        => 3 ,
					        'flight_field_search' => 'destination',
					        'placeholder'    => __("Location / Airport" , ST_TEXTDOMAIN)
				        ) ,
				        array(
					        'title'              => __('Departing', ST_TEXTDOMAIN) ,
					        'layout_col'         => 3 ,
					        'layout2_col'        => 2 ,
					        'flight_field_search' => 'depart'
				        ) ,
				        array(
					        'title'              => __('Returning', ST_TEXTDOMAIN) ,
					        'layout_col'         => 3 ,
					        'layout2_col'        => 2 ,
					        'flight_field_search' => 'return'
				        ) ,
				        array(
					        'title'              => __('Passengers', ST_TEXTDOMAIN) ,
					        'layout_col'         => 6 ,
					        'layout2_col'        => 2 ,
					        'flight_field_search' => 'passengers'
				        ) ,
			        )
		        ),
		        array(
			        'type'      => 'post-select-ajax',
			        'post_type' => 'page',
			        'sparam' => 'page',
			        'id' => 'flight_search_result_page',
			        'label' => esc_html__('Flight Search Result Page', ST_TEXTDOMAIN),
			        'desc' => esc_html__('Select page to show hotel results search page', ST_TEXTDOMAIN),
			        'section'  => 'option_flight'
		        ),
                array(
                    'type'      => 'on-off',
                    'id' => 'st_flight_disable_guest_name',
                    'label' => esc_html__('Disable Guest Name Form', ST_TEXTDOMAIN),
                    'section'  => 'option_flight'
                )
	        ];

	        return $r;
        }

        static function inst(){
            if(!self::$_inst)
                self::$_inst = new self();

            return self::$_inst;
        }
    }

    ST_Flight_Base_Controller::inst();
}