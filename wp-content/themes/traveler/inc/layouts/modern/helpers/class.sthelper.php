<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * List all function helper
     *
     * Created by ShineTheme
     *
     */


    if ( !function_exists( 'st_social_channel_status' ) ) {
        function st_social_channel_status( $channel )
        {
            if ( class_exists( 'ST_Social_Login' ) ) {
                return ST_Social_Login::inst()->channelStatus( $channel );
            }

            return false;
        }
    }
    if ( !function_exists( 'st_traveler_get_option' ) ) {
        function st_traveler_get_option( $option_id, $default = false )
        {
            //global $st_traveler_cached_options;
            //if ( empty( $st_traveler_cached_options ) ) $st_traveler_cached_options = get_option( st_options_id() );

            $st_traveler_cached_options = get_option( st_options_id() );

            if ( isset( $st_traveler_cached_options[ $option_id ] ) ) return $st_traveler_cached_options[ $option_id ];

            return $default;
        }
    }

    if ( !function_exists( 'st_hex2rgb' ) ) {

        function st_hex2rgb( $hex )
        {
            $hex = str_replace( "#", "", $hex );

            if ( strlen( $hex ) == 3 ) {
                $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
                $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
                $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
            } else {
                $r = hexdec( substr( $hex, 0, 2 ) );
                $g = hexdec( substr( $hex, 2, 2 ) );
                $b = hexdec( substr( $hex, 4, 2 ) );
            }
            $rgb = [ $r, $g, $b ];

            //return implode(",", $rgb); // returns the rgb values separated by commas
            return $rgb; // returns an array with the rgb values
        }
    }
    if ( !function_exists( 'st_get_list_taxonomy_id' ) ) {
        function st_get_list_taxonomy_id( $tax = 'category', $array = [] )
        {

            $taxonomies = get_terms( $tax, $array );

            $r = [];

            $r[ __( 'All Categories', ST_TEXTDOMAIN ) ] = 0;


            if ( !is_wp_error( $taxonomies ) ) {

                foreach ( $taxonomies as $key => $value ) {
                    # code...
                    $r[ $value->name ] = $value->term_id;
                }
            }

            return $r;
        }
    }
    if ( !function_exists( 'st_get_list_order_by' ) ) {
        function st_get_list_order_by( $arg = null )
        {
            $list = [
                __( '--Select--', ST_TEXTDOMAIN )    => '',
                __( 'None', ST_TEXTDOMAIN )          => 'none',
                __( 'ID', ST_TEXTDOMAIN )            => 'ID',
                __( 'Author', ST_TEXTDOMAIN )        => 'author',
                __( 'Title', ST_TEXTDOMAIN )         => 'title',
                __( 'Name', ST_TEXTDOMAIN )          => 'name',
                __( 'Type', ST_TEXTDOMAIN )          => 'type',
                __( 'Date', ST_TEXTDOMAIN )          => 'date',
                __( 'Modified', ST_TEXTDOMAIN )      => 'modified',
                __( 'Parent', ST_TEXTDOMAIN )        => 'parent',
                __( 'Rand', ST_TEXTDOMAIN )          => 'rand',
                __( 'Comment Count', ST_TEXTDOMAIN ) => 'comment_count',
            ];
            if ( !empty( $arg ) && is_array( $arg ) ) {

                foreach ( $arg as $k => $v ) {
                    $list[ $k ] = $v;
                }
            }

            return $list;
        }
    }


    if ( !function_exists( 'st_remove_wpautop' ) ) {
        function st_remove_wpautop( $content )
        {
            if ( function_exists( 'wpb_js_remove_wpautop' ) ) {
                $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );

                return do_shortcode( shortcode_unautop( $content ) );
            }
        }
    }
    if ( !function_exists( 'st_paging_nav' ) ) {

        function st_paging_nav( $title = null, $query = false, $num_pages = false )

        {
            global $wp_query;

            if ( !$query ) $query = $wp_query;
            // Don't print empty markup if there's only one page.

            $max_num_pages = $query->max_num_pages;
            if ( $num_pages ) {
                $max_num_pages = $num_pages;
            }
            if ( $max_num_pages < 2 ) {
                return;
            }
            $paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

            $pagenum_link = html_entity_decode( get_pagenum_link() );
            $query_args   = [];
            $url_parts    = explode( '?', $pagenum_link );

            if ( isset( $url_parts[ 1 ] ) ) {
                wp_parse_str( $url_parts[ 1 ], $query_args );
            }

            $pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
            $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

            $format = $GLOBALS[ 'wp_rewrite' ]->using_index_permalinks() && !strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
            $format .= $GLOBALS[ 'wp_rewrite' ]->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

            // Set up paginated links.
            $links = paginate_links( [
                'base'      => $pagenum_link,
                'format'    => $format,
                'total'     => $max_num_pages,
                'current'   => $paged,
                'mid_size'  => 3,
                'add_args'  => array_map( 'urlencode', $query_args ),
                'prev_text' => '<i class="fa fa-angle-left"></i>',
                'next_text' => '<i class="fa fa-angle-right"></i>',
            ] );
            if ( $links ) :
                ?>
                <nav class="navigation paging-navigation" role="navigation">
                    <h1 class="screen-reader-text"><?php echo( $title ) ?></h1>

                    <div class="pagination loop-pagination pagination">
                        <?php echo balanceTags( $links ); ?>
                    </div>
                    <!-- .pagination -->
                </nav><!-- .navigation -->
            <?php
            endif;
        }
    }
    if ( !function_exists( 'st_handle_icon_class' ) ) {
        function st_handle_icon_class( $class )
        {
            $class = ltrim( $class );

            //Detech Fontawesome Icon

            if ( substr( $class, 0, 2 ) == 'fa' ) {
                return "fa " . $class;
            }
        }
    }
    if ( !function_exists( 'st_handle_icon_tag' ) ) {
        function st_handle_icon_tag( $class, $required_handle_class = true, $holder = "i" )
        {
            if ( $required_handle_class ) {
                $class = st_handle_icon_class( $class );
            }

            if ( $class ) {
                return "<" . $holder . ' class="' . $class . '"></' . $holder . '>';
            }
        }
    }
    if ( !function_exists( 'st_hext2rgb' ) ) {
        function st_hext2rgb( $hex )
        {
            $hex = str_replace( "#", "", $hex );

            if ( strlen( $hex ) == 3 ) {
                $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
                $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
                $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
            } else {
                $r = hexdec( substr( $hex, 0, 2 ) );
                $g = hexdec( substr( $hex, 2, 2 ) );
                $b = hexdec( substr( $hex, 4, 2 ) );
            }
            $rgb = [ $r, $g, $b ];

            //return implode(",", $rgb); // returns the rgb values separated by commas
            return $rgb; // returns an array with the rgb values
        }
    }
    if ( !function_exists( 'st_get_profile_avatar' ) ) {
        function st_get_profile_avatar( $id, $size )
        {
            $gravatar_me_id = get_user_meta( $id, 'st_avatar', true );

            if ( !empty( $gravatar_me_id ) ) {
                $gravatar_pic_url = wp_get_attachment_image_src( $gravatar_me_id, 'full' );
                $data_size        = [ 'width' => $size, 'height' => $size ];
                if ( !empty( $gravatar_pic_url[ 0 ] ) ) {
                    $gravatar_pic_url = '<img alt="avatar" width=' . $size . ' height=' . $size . ' src="' . bfi_thumb( $gravatar_pic_url[ 0 ], $data_size ) . '" class="avatar avatar-96 photo origin round" >';
                } else {
                    $gravatar_pic_url = get_avatar( $id, $size, null, TravelHelper::get_alt_image() );
                }
            } else {
                $gravatar_pic_url = get_avatar( $id, $size, null, TravelHelper::get_alt_image() );
            }

            return $gravatar_pic_url;
        }
    }
    if ( !function_exists( 'st_get_profile_avatar_by_email' ) ) {
        function st_get_profile_avatar_by_email( $email, $size )
        {
            $gravatar_me_id = get_user_meta( $email, 'st_avatar', true );

            if ( !empty( $gravatar_me_id ) ) {
                $gravatar_pic_url = wp_get_attachment_image_src( $gravatar_me_id, 'full' );
                $data_size        = [ 'width' => $size, 'height' => $size ];
                if ( !empty( $gravatar_pic_url[ 0 ] ) ) {
                    $gravatar_pic_url = '<img alt="avatar" width=' . $size . ' height=' . $size . ' src="' . bfi_thumb( $gravatar_pic_url[ 0 ], $data_size ) . '" class="avatar avatar-96 photo origin round" >';
                } else {
                    $gravatar_pic_url = get_avatar( $email, $size, false, TravelHelper::get_alt_image() );
                }
            } else {
                $gravatar_pic_url = get_avatar( $email, $size, false, TravelHelper::get_alt_image() );
            }

            return $gravatar_pic_url;
        }
    }

    /** 1.1.4  */
    if ( !function_exists( 'st_get_page_search_result' ) ) {
        function st_get_page_search_result( $post_type )
        {
            if ( empty( $post_type ) ) return;
            switch ( $post_type ) {
                case "st_hotel":
                case "hotel_room":
                    $page_search = st()->get_option( 'hotel_search_result_page' );
                    break;
                case "st_rental":
                    $page_search = st()->get_option( 'rental_search_result_page' );
                    break;
                case "st_cars":
                    $page_search = st()->get_option( 'cars_search_result_page' );
                    break;
                case "st_activity":
                    $page_search = st()->get_option( 'activity_search_result_page' );
                    break;
                case "st_tours":
                    $page_search = st()->get_option( 'tours_search_result_page' );
                    break;
                default :
                    $page_search = false;
            }

            return $page_search;
        }
    }

    if ( !function_exists( 'st_breadcrumbs_new' ) ) {
        function st_breadcrumbs_new()
        {
            global $post;
            $sep      = ' > ';
            $bc_style = st()->get_option( 'bc_style', "mt15" );
            ?>
            <div class="st-breadcrumb hidden-xs">
                <div class="container">
                    <ul>
                        <?php
                            if ( !is_home() ) {
                                echo '<li>';
                                if ( !empty( $bc_style ) and $bc_style != "mt15" ) echo "<i class=\" main-color fa fa-home\"></i> ";
                                echo '<a href="' . home_url() . '">' . st_get_language( 'home' ) . '</a></li>';

                                if ( is_category() || is_single() || is_tag()) {

                                    if(is_category() or is_tag()){
                                        the_archive_title('<li class="active">', '</li');
                                    }
                                    //$cats = get_the_category( $post->ID );
                                    /*foreach ( $cats as $cat ) {
                                        echo '<li><a href="'.get_category_link($cat->term_id).'">' . balanceTags( $cat->cat_name ) . '</a></li>';
                                    }*/

                                    do_action( 'st_single_breadcrumb', $sep );
                                    if ( get_post_type( $post->ID ) == 'hotel_room' ) {
                                        $hotel_parent = get_post_meta( $post->ID, 'room_parent', true );
                                        if ( !empty( $hotel_parent ) ) {
                                            echo '<li><a href="' . get_permalink( $hotel_parent ) . '" title="' . get_the_title( $hotel_parent ) . '">' . get_the_title( $hotel_parent ) . '</a></li>';
                                        }
                                    }
                                    if ( is_single() ) {
                                        echo '<li class="active">' . get_the_title() . '</li>';
                                    }
                                } elseif ( is_page() ) {
                                    if ( $post->post_parent ) {
                                        $anc      = get_post_ancestors( $post->ID );
                                        $anc_link = get_page_link( $post->post_parent );

                                        foreach ( $anc as $ancestor ) {
                                            $output = '<li><a href="' . $anc_link . '">' . get_the_title( $ancestor ) . '</a></li>';
                                        }
                                        echo balanceTags( $output );
                                        echo '<li class="active">' . get_the_title() . '</li>';
                                    } else {
                                        echo '<li class="active">' . get_the_title() . '</li>';
                                    }
                                } elseif ( is_search() ) {

                                    //if( !empty($_REQUEST['location_id']) || !empty($_REQUEST['location_id_pick_up']) ){
                                    if ( !empty( $_REQUEST[ 'location_id' ] ) ) {
                                        if ( !empty( $_REQUEST[ 'location_id' ] ) ) {
                                            $location_id = $_REQUEST[ 'location_id' ];
                                        }
                                        if ( !empty( $_REQUEST[ 'location_id_pick_up' ] ) ) {
                                            $location_id = $_REQUEST[ 'location_id_pick_up' ];
                                        }
                                        $parent = array_reverse( get_post_ancestors( $location_id ) );

                                        foreach ( $parent as $k => $v ) {
                                            // $url = TravelHelper::bui
                                            $post_type = STInput::request( 'post_type' );
                                            if ( !empty( $post_type ) ) {
                                                echo '<li><a href="' . home_url( '?s=' . STInput::request( 's' ) . '&post_type=' . $post_type . '&location_id=' . $v ) . '">' . get_the_title( $v ) . '</a></li>';
                                            } else {

                                                echo '<li><a href="' . add_query_arg( [ 'location_id' => $v ], get_the_permalink() ) . '">' . get_the_title( $v ) . '</a></li>';
                                            }
                                        }
                                        echo '<li class="active">' . get_the_title( $location_id ) . '</li>';
                                    } else if ( STInput::request( 's' ) ) {
                                        echo '<li class="active">' . st_get_language( 'search_results' ) . esc_html( '"' . STInput::request( 's' ) . '"' ) . '</li>';
                                    } else if ( STInput::request( 'location_name' ) ) {
                                        echo '<li class="active">' . esc_html( STInput::request( 'location_name' ) ) . '</li>';
                                    } else if ( STInput::request( 'address' ) ) {
                                        echo '<li class="active">' . esc_html( STInput::request( 'address' ) ) . '</li>';
                                    } else if ( !empty( $_REQUEST[ 'pick-up' ] ) ) {
                                        echo '<li class="active">' . st_get_language( 'search_results' ) . '</li>';
                                        echo esc_html( '"' . $_REQUEST[ 'pick-up' ] . '"' );
                                        if ( !empty( $_REQUEST[ 'drop-off' ] ) ) {
                                            echo esc_html( ' to "' . $_REQUEST[ 'drop-off' ] . '"' );
                                        }
                                    } elseif ( !empty( $_REQUEST[ 'st_google_location' ] ) ) {
                                        echo ( !empty( $_REQUEST[ 'st_country' ] ) ) ? '<li class="active">' . esc_html( STInput::request( 'st_country', '' ) ) . '</li>' : '';
                                        echo ( !empty( $_REQUEST[ 'st_admin_area' ] ) ) ? '<li class="active">' . esc_html( STInput::request( 'st_admin_area', '' ) ) . '</li>' : '';
                                        echo ( !empty( $_REQUEST[ 'st_sub' ] ) ) ? '<li class="active">' . esc_html( STInput::request( 'st_sub', '' ) ) . '</li>' : '';
                                        echo ( !empty( $_REQUEST[ 'st_locality' ] ) ) ? '<li class="active">' . esc_html( STInput::request( 'st_locality', '' ) ) . '</li>' : '';
                                    } elseif ( !empty( $_REQUEST[ 'st_google_location_pickup' ] ) ) {
                                        echo ( !empty( $_REQUEST[ 'st_country_up' ] ) ) ? '<li class="active">' . esc_html( STInput::request( 'st_country_up', '' ) ) . '</li>' : '';
                                        echo ( !empty( $_REQUEST[ 'st_admin_area_up' ] ) ) ? '<li class="active">' . esc_html( STInput::request( 'st_admin_area_up', '' ) ) . '</li>' : '';
                                        echo ( !empty( $_REQUEST[ 'st_sub_up' ] ) ) ? '<li class="active">' . esc_html( STInput::request( 'st_sub_up', '' ) ) . '</li>' : '';
                                        echo ( !empty( $_REQUEST[ 'st_locality_up' ] ) ) ? '<li class="active">' . esc_html( STInput::request( 'st_locality_up', '' ) ) . '</li>' : '';
                                    }
                                }
                            } elseif ( is_tag() ) {
                                single_tag_title();
                            } elseif ( is_day() ) {
                                echo __( "Archive: ", ST_TEXTDOMAIN );
                                the_time( 'F jS, Y' );
                                echo '</li>';
                            } elseif ( is_month() ) {
                                echo __( "Archive: ", ST_TEXTDOMAIN );
                                the_time( 'F, Y' );
                                echo '</li>';
                            } elseif ( is_year() ) {
                                echo __( "Archive: ", ST_TEXTDOMAIN );
                                the_time( 'Y' );
                                echo '</li>';
                            } elseif ( is_author() ) {
                                echo __( "Author's archive: ", ST_TEXTDOMAIN );
                                echo '</li>';
                            } elseif ( isset( $_GET[ 'paged' ] ) && !empty( $_GET[ 'paged' ] ) ) {
                                echo __( "Blog Archive: ", ST_TEXTDOMAIN );
                                echo '';
                            } elseif ( is_search() ) {
                                echo '<li><span>' . st_get_language( 'search_results' ) . '</span></li>';
                            }
                        ?> </ul>
                </div>
            </div>
            <?php
        }

    }

    if (!function_exists('st_breadcrumbs')) {
        function st_breadcrumbs()
        {
            global $post;
            $sep = ' > ';
            $bc_style = st()->get_option('bc_style', "mt15");
            ?>
        <ul class="breadcrumb  <?php echo esc_attr($bc_style); ?>"> <?php
            if (!is_home()) {
                echo '<li>';
                if (!empty($bc_style) and $bc_style != "mt15") echo "<i class=\" main-color fa fa-home\"></i> ";
                echo '<a href="' . home_url() . '">' . st_get_language('home') . '</a></li>';

                if (is_category() || is_single()) {
                    $cats = get_the_category($post->ID);
                    foreach ($cats as $cat) {
                        echo '<li><a href="#">' . balanceTags($cat->cat_name) . '</a></li>';
                    }

                    do_action('st_single_breadcrumb', $sep);
                    if (get_post_type($post->ID) == 'hotel_room') {
                        $hotel_parent = get_post_meta($post->ID, 'room_parent', true);
                        if (!empty($hotel_parent)) {
                            echo '<li><a href="' . get_permalink($hotel_parent) . '" title="' . get_the_title($hotel_parent) . '">' . get_the_title($hotel_parent) . '</a></li>';
                        }
                    }
                    if (is_single()) {
                        echo '<li class="active">' . get_the_title() . '</li>';
                    }
                } elseif (is_page()) {
                    if ($post->post_parent) {
                        $anc = get_post_ancestors($post->ID);
                        $anc_link = get_page_link($post->post_parent);

                        foreach ($anc as $ancestor) {
                            $output = '<li><a href="' . $anc_link . '">' . get_the_title($ancestor) . '</a></li>';
                        }
                        echo balanceTags($output);
                        echo '<li class="active">' . get_the_title() . '</li>';
                    } else {
                        echo '<li class="active">' . get_the_title() . '</li>';
                    }
                } elseif (is_search()) {

                    //if( !empty($_REQUEST['location_id']) || !empty($_REQUEST['location_id_pick_up']) ){
                    if (!empty($_REQUEST['location_id'])) {
                        if (!empty($_REQUEST['location_id'])) {
                            $location_id = $_REQUEST['location_id'];
                        }
                        if (!empty($_REQUEST['location_id_pick_up'])) {
                            $location_id = $_REQUEST['location_id_pick_up'];
                        }
                        $parent = array_reverse(get_post_ancestors($location_id));

                        foreach ($parent as $k => $v) {
                            // $url = TravelHelper::bui
                            $post_type = STInput::request('post_type');
                            if (!empty($post_type)) {
                                echo '<li><a href="' . home_url('?s=' . STInput::request('s') . '&post_type=' . $post_type . '&location_id=' . $v) . '">' . get_the_title($v) . '</a></li>';
                            } else {

                                echo '<li><a href="' . add_query_arg(array('location_id' => $v), get_the_permalink()) . '">' . get_the_title($v) . '</a></li>';
                            }
                        }
                        echo '<li class="active">' . get_the_title($location_id) . '</li>';
                    } else if (STInput::request('s')) {
                        echo '<li class="active">' . st_get_language('search_results') . esc_html('"' . STInput::request('s') . '"') . '</li>';
                    } else if (STInput::request('location_name')) {
                        echo '<li class="active">' . esc_html(STInput::request('location_name')) . '</li>';
                    } else if (STInput::request('address')) {
                        echo '<li class="active">' . esc_html(STInput::request('address')) . '</li>';
                    } else if (!empty($_REQUEST['pick-up'])) {
                        echo '<li class="active">' . st_get_language('search_results') . '</li>';
                        echo esc_html('"' . $_REQUEST['pick-up'] . '"');
                        if (!empty($_REQUEST['drop-off'])) {
                            echo esc_html(' to "' . $_REQUEST['drop-off'] . '"');
                        }
                    } elseif (!empty($_REQUEST['st_google_location'])) {
                        echo (!empty($_REQUEST['st_country'])) ? '<li class="active">' . esc_html(STInput::request('st_country', '')) . '</li>' : '';
                        echo (!empty($_REQUEST['st_admin_area'])) ? '<li class="active">' . esc_html(STInput::request('st_admin_area', '')) . '</li>' : '';
                        echo (!empty($_REQUEST['st_sub'])) ? '<li class="active">' . esc_html(STInput::request('st_sub', '')) . '</li>' : '';
                        echo (!empty($_REQUEST['st_locality'])) ? '<li class="active">' . esc_html(STInput::request('st_locality', '')) . '</li>' : '';
                    } elseif (!empty($_REQUEST['st_google_location_pickup'])) {
                        echo (!empty($_REQUEST['st_country_up'])) ? '<li class="active">' . esc_html(STInput::request('st_country_up', '')) . '</li>' : '';
                        echo (!empty($_REQUEST['st_admin_area_up'])) ? '<li class="active">' . esc_html(STInput::request('st_admin_area_up', '')) . '</li>' : '';
                        echo (!empty($_REQUEST['st_sub_up'])) ? '<li class="active">' . esc_html(STInput::request('st_sub_up', '')) . '</li>' : '';
                        echo (!empty($_REQUEST['st_locality_up'])) ? '<li class="active">' . esc_html(STInput::request('st_locality_up', '')) . '</li>' : '';
                    }
                }
            } elseif (is_tag()) {
                single_tag_title();
            } elseif (is_day()) {
                echo __("Archive: ", ST_TEXTDOMAIN);
                the_time('F jS, Y');
                echo '</li>';
            } elseif (is_month()) {
                echo __("Archive: ", ST_TEXTDOMAIN);
                the_time('F, Y');
                echo '</li>';
            } elseif (is_year()) {
                echo __("Archive: ", ST_TEXTDOMAIN);
                the_time('Y');
                echo '</li>';
            } elseif (is_author()) {
                echo __("Author's archive: ", ST_TEXTDOMAIN);
                echo '</li>';
            } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
                echo __("Blog Archive: ", ST_TEXTDOMAIN);
                echo '';
            } elseif (is_search()) {
                echo '<li class="active">' . st_get_language('search_results') . '</li>';
            }
            ?> </ul><?php
        }
    }
    if ( !function_exists( 'st_get_default_image' ) ) {
        function st_get_default_image()
        {
            return "<img class='' alt='" . TravelHelper::get_alt_image() . "' src='" . get_template_directory_uri() . '/img/no-image.png' . "'/>";
        }
    }

    if ( !function_exists( 'st_get_post_taxonomy' ) ) {
        function st_get_post_taxonomy( $post_type = 'post', $for_ot = true )
        {
            $tax = get_object_taxonomies( $post_type, 'object' );

            $r = [];

            if ( !empty( $tax ) ) {
                foreach ( $tax as $key => $value ) {
                    if ( $for_ot == true ) {
                        $r[] = [
                            'value' => $value->name,
                            'label' => $value->label
                        ];
                    } else {
                        $r[] = [
                            'value' => $value->name,
                            'label' => $value->label
                        ];
                    }

                }
            }

            return $r;
        }
    }

    if ( !function_exists( 'st_get_link_with_search' ) ) {
        function st_get_link_with_search( $link = false, $need = [], $data = [] )
        {
            $form_data = [];
            if ( !empty( $need ) ) {
                foreach ( $need as $key ) {
                    if ( isset( $data[ $key ] ) and $data[ $key ] ) {
                        $form_data[ $key ] = $data[ $key ];
                    }
                }
            }

            return esc_url( add_query_arg( $form_data, $link ) );

        }
    }


    if ( !function_exists( 'st_get_the_excerpt_max_charlength' ) ) {
        function st_get_the_excerpt_max_charlength( $charlength )
        {
            $excerpt = get_the_excerpt();
            $charlength++;
            $txt = '';
            if ( mb_strlen( $excerpt ) > $charlength ) {
                $subex   = mb_substr( $excerpt, 0, $charlength - 5 );
                $exwords = explode( ' ', $subex );
                $excut   = -( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
                if ( $excut < 0 ) {
                    $txt .= mb_substr( $subex, 0, $excut );
                } else {
                    $txt .= $subex;
                }
                $txt .= '...';
            } else {
                $txt .= $excerpt;
            }

            return $txt;
        }
    }
    if ( !function_exists( 'st_implode' ) ) {
        function st_implode( $char, $array )
        {
            $r = '';
            if ( is_array( $array ) and !empty( $array ) ) {
                foreach ( $array as $val ) {
                    if ( is_string( $val ) ) {
                        $r .= $val . $char;
                    }
                }
            }

            return rtrim( $r, $char );
        }
    }
    if ( function_exists( 'st_is_ajax' ) == false ) {
        function st_is_ajax()
        {
            if ( !empty( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest' ) {
                return true;
            }
            {
                return false;
            }
        }
    }


    if ( !function_exists( 'st_get_language' ) ) {
        function st_get_language( $key )
        {
            if ( class_exists( 'STLanguage' ) ) {
                return STLanguage::st_get_language( $key );
            } else {
                global $st_language;
                if ( !empty( $st_language[ $key ] ) ) {
                    return $st_language[ $key ];
                } else {
                    return $key;
                }
            }
        }
    }

    if ( !function_exists( 'st_the_language' ) ) {
        function st_the_language( $key )
        {
            if ( class_exists( 'STLanguage' ) ) {
                STLanguage::st_the_language( $key );
            } else {
                global $st_language;
                if ( !empty( $st_language[ $key ] ) ) {
                    echo balanceTags( $st_language[ $key ] );
                } else {
                    echo balanceTags( $key );
                }
            }
        }
    }

    if ( !function_exists( 'st_dateformat_PHP_to_jQueryUI' ) ) {
        function st_dateformat_PHP_to_jQueryUI( $php_format )
        {
            $SYMBOLS_MATCHING = [
                // Day
                'd' => 'dd',
                'D' => 'D',
                'j' => 'd',
                'l' => 'DD',
                'N' => '',
                'S' => '',
                'w' => '',
                'z' => 'o',
                // Week
                'W' => '',
                // Month
                'F' => 'MM',
                'm' => 'mm',
                'M' => 'M',
                'n' => 'm',
                't' => '',
                // Year
                'L' => '',
                'o' => '',
                'Y' => 'yy',
                'y' => 'y',
                // Time
                'a' => '',
                'A' => '',
                'B' => '',
                'g' => '',
                'G' => '',
                'h' => '',
                'H' => '',
                'i' => '',
                's' => '',
                'u' => ''
            ];
            $jqueryui_format  = "";
            $escaping         = false;
            for ( $i = 0; $i < strlen( $php_format ); $i++ ) {
                $char = $php_format[ $i ];
                if ( $char === '\\' ) // PHP date format escaping character
                {
                    $i++;
                    if ( $escaping ) $jqueryui_format .= $php_format[ $i ];
                    else $jqueryui_format .= '\'' . $php_format[ $i ];
                    $escaping = true;
                } else {
                    if ( $escaping ) {
                        $jqueryui_format .= "'";
                        $escaping        = false;
                    }
                    if ( isset( $SYMBOLS_MATCHING[ $char ] ) )
                        $jqueryui_format .= $SYMBOLS_MATCHING[ $char ];
                    else
                        $jqueryui_format .= $char;
                }
            }

            return $jqueryui_format;
        }
    }

    if ( !function_exists( 'st_fix_iframe_w3c' ) ) {
        function st_fix_iframe_w3c( $iframe )
        {
            $iframe = str_replace( 'webkitallowfullscreen', '', $iframe );
            $iframe = str_replace( 'frameborder="0"', '', $iframe );
            $iframe = str_replace( 'mozallowfullscreen', '', $iframe );

            return $iframe;
        }
    }
    if ( !function_exists( 'st_get_discount_value' ) ) {
        function st_get_discount_value( $number, $percent = 0, $format_money = true )
        {
            if ( $percent > 100 ) $percent = 100;

            $rs = $number - ( $number / 100 ) * $percent;

            if ( $format_money ) return TravelHelper::format_money( $rs );

            return $rs;
        }
    }
    if ( !function_exists( 'get_price_by_discount_person' ) ) {
        /*
    * @since 1.1.1
    */
        function get_price_by_discount_person( $id_tours, $price, $num, $is_adult )
        {
            $flag  = 0;
            $array = STTour::get_array_discount_by_person_num( $id_tours );
            if ( $is_adult ) {
                $array = $array[ 'adult' ];
            } else {
                $array = $array[ 'child' ];
            }
            if ( !empty( $array ) and is_array( $array ) ) {
                foreach ( $array as $key => $value ) {
                    if ( (int)$key <= $num ) {
                        $flag      = $price * $value;
                        $flagvalue = $value;
                    }
                }
            }
            $price -= $flag;

            return $price;

        }
    }
    if ( !function_exists( 'st_is_https' ) ) {
        function st_is_https()
        {
            if ( !isset( $_SERVER[ 'HTTPS' ] ) || $_SERVER[ 'HTTPS' ] != 'on' ) {
                // no SSL request
                return false;
            }

            return true;
        }
    }

    if ( !function_exists( 'get_list_posttype' ) ) {
        function get_list_posttype()
        {
            $result = [];
            $lists  = get_post_types( [
                'public' => true,
            ], 'objects' );
            foreach ( $lists as $key => $val ) {
                $result[] = [
                    'value' => $key,
                    'label' => $val->labels->name
                ];
            }

            return $result;
        }
    }
    if ( !function_exists( 'st_get_the_slug' ) ) {
        function st_get_the_slug()
        {

            global $post;

            if ( is_single() || is_page() ) {
                return $post->post_name;
            } else {
                return "";
            }

        }
    }
    if ( !function_exists( 'st_options_id' ) ) {
        function st_options_id()
        {

            return apply_filters( 'st_options_id', 'option_tree' );

        }
    }

    if ( !function_exists( 'st_wc_parse_order_item_meta' ) ) {
        /**
         * @param array $key
         *
         * @return array
         * @since 1.1.7
         */
        function st_wc_parse_order_item_meta( $key = [] )
        {
            if ( is_array( $key ) ) {
                return $key;
            }

            return [];
        }
    }

    /**
     * @since 1.2.0
     */
    if ( !function_exists( 'st_letter_to_number' ) ) {
        function st_letter_to_number( $size )
        {
            $l   = substr( $size, -1 );
            $ret = substr( $size, 0, -1 );
            switch ( strtoupper( $l ) ) {
                case 'P':
                    $ret *= 1024;
                case 'T':
                    $ret *= 1024;
                case 'G':
                    $ret *= 1024;
                case 'M':
                    $ret *= 1024;
                case 'K':
                    $ret *= 1024;
            }

            return $ret;
        }
    }

    /**
     * @since 1.3.0
     */

    if ( !function_exists( 'st_get_avatar_in_list_service' ) ) {
        function st_get_avatar_in_list_service( $post_id, $size = 35, $return_link = false )
        {
            if ( empty( $post_id ) ) return false;
            if ( st()->get_option( 'avatar_in_list_service', 'off' ) == 'on' ) {
                $post_author_id = get_post_field( 'post_author', get_the_ID() );
                $partner_page   = st()->get_option( 'partner_info_page', '' );
                if ( $partner_page != '' ) {
                    $partner_link = get_permalink( $partner_page );
                    $author_link  = esc_url( add_query_arg( [ 'partner_id' => $post_author_id ], $partner_link ) );
                } else {
                    $author_link = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
                }
                if ( $return_link ) {
                    $user_link = get_permalink( st()->get_option( 'user_info_page' ) );
                    $user_link = add_query_arg( 'user', $post_author_id, $user_link );

                    return '<a href="' . $user_link . '" target="_blank" class="service-avatar">' . st_get_profile_avatar( $post_author_id, $size ) . '</a>';
                }

                return '<a href="' . $author_link . '" target="_blank" title="' . get_the_author() . '"  class="service-avatar">' . st_get_profile_avatar( $post_author_id, $size ) . '</a>';
                //return st_get_profile_avatar($post_author_id, $size);
            }
        }
    }

    function ot_type_email_template_document()
    {

        echo '<div class="format-setting type-textblock wide-desc">';

        echo '<div class="description">';
        ?>
        <style>
            table {
                border: 1px solid #CCC;
            }

            table tr:not(:last-child) td {
                border-bottom: 1px solid #CCC;
            }

            xmp {
                margin: 0;
            }
        </style>
        <p>
            <?php echo __( 'From version 1.1.9 you can edit email template for Admin, Partner, Customer by use our shortcodes system with some layout we ready build in. Below is the list shortcodes you can use', ST_TEXTDOMAIN ); ?>
            :
        </p>
        <h4><?php echo __( 'List All Shortcode:', ST_TEXTDOMAIN ); ?></h4>
        <ul>
            <li>
                <h5><?php echo __( 'Customer Information:', ST_TEXTDOMAIN ); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr style="background: #CCC;">
                        <th align="center" width="33.3333%"><?php echo __( 'Name', ST_TEXTDOMAIN ); ?></th>
                        <th align="center" width="33.3333%"><?php echo __( 'Code', ST_TEXTDOMAIN ); ?></th>
                        <th align="center" width="33.3333%"><?php echo __( 'Description', ST_TEXTDOMAIN ); ?></th>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'First Name', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_first_name]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Last Name', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_last_name]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Email', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_email]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Address', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_address]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Phone Number', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_phone]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'City', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_city]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Province', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_province]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Zipcode', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_zip_code]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Country', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_country]</td>
                        <td></td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __( 'Item booking Information', ST_TEXTDOMAIN ); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr style="background: #CCC;">
                        <th align="center" width="33.3333%"><?php echo __( 'Name', ST_TEXTDOMAIN ); ?></th>
                        <th align="center" width="33.3333%"><?php echo __( 'Code', ST_TEXTDOMAIN ); ?></th>
                        <th align="center" width="33.3333%"><?php echo __( 'Description', ST_TEXTDOMAIN ); ?></th>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Post type name', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_email_booking_posttype]</td>
                        <td><em><?php echo __( 'Show post-type name.', ST_TEXTDOMAIN ); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'ID', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_id]</td>
                        <td>
                            <em><?php echo __( 'Display the Order ID', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Thumbnail Image', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_thumbnail]</td>
                        <td>
                            <em><?php echo __( 'Display the product\'s thumbnail image (if have)', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Date', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_date]</td>
                        <td>
                            <em><?php echo __( 'Display the booking date', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Special Requirements', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_note]</td>
                        <td>
                            <em><?php echo __( 'Display the information of the \'Special Requirements\' when booking', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Payment Method', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_payment_method]</td>
                        <td>
                            <em><?php echo __( 'Display the booking method', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Name', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_item_name]</td>
                        <td>
                            <em><?php echo __( 'Display item name of service.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Link', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_item_link]</td>
                        <td>
                            <em><?php echo __( 'Display the item title with a link under.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Number', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_number_item]</td>
                        <td>
                            <em><?php echo __( 'Display number of items when booking.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong><?php echo __( 'Check In', ST_TEXTDOMAIN ); ?>:</strong><br/>
                            <strong><?php echo __( 'Check Out', ST_TEXTDOMAIN ); ?>:</strong>
                        </td>
                        <td>
                            [st_email_booking_check_in]<br/>
                            [st_email_booking_check_out]<br/>
                            [st_check_in_out_title] <br/>
                            [st_check_in_out_value]
                        </td>
                        <td>
                            <em>
                                1. <?php echo __( 'Display check in, check out with Hotel and Rental', ST_TEXTDOMAIN ); ?>
                                <br/>
                                2. <?php echo __( 'Display Pick-up Date and Drop-off Date with Car', ST_TEXTDOMAIN ); ?>
                                <br/>
                                3. <?php echo __( 'Display Departure date and Return date with Tour and Activity', ST_TEXTDOMAIN ); ?>
                            </em>
                        </td>
                    </tr>
                    <!-- Since 2.0.0 Start Time Order Shortcode -->
                    <tr>
                        <td><strong><?php echo __( 'Start Time', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_start_time]</td>
                        <td>
                            <em><?php echo __( 'Display Start Time with Tour', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Price', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_item_price]</td>
                        <td>
                            <em><?php echo __( 'Display item price (not included Tour and Activity)', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Origin Price', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_origin_price]</td>
                        <td>
                            <em>
                                <?php echo __( 'Display original price of the item (not included custom price, sale price and tax)', ST_TEXTDOMAIN ); ?>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Sale Price', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_sale_price]</td>
                        <td>
                            <em><?php echo __( 'Display the sale price.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Tax Price', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_price_with_tax]</td>
                        <td>
                            <em><?php echo __( 'Display the price with tax.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Deposit Price', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_deposit_price]</td>
                        <td>
                            <em><?php echo __( 'Display the deposit require. ', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Total Price', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_total_price]</td>
                        <td>
                            <em><?php echo __( 'Display the total price (included sale price and tax).', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Tax Percent', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_total_price]</td>
                        <td>
                            <em><?php echo __( 'Display the total amount payment.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Address', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_item_address]</td>
                        <td>
                            <em><?php echo __( 'Display the address.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Website', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_item_website]</td>
                        <td>
                            <em><?php echo __( 'Display the website.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Email', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_item_email]</td>
                        <td>
                            <em><?php echo __( 'Display the email.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Phone', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_item_phone]</td>
                        <td>
                            <em><?php echo __( 'Display the phone.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item Fax', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_item_fax]</td>
                        <td>
                            <em><?php echo __( 'Display the fax.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Booking Status', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_status]</td>
                        <td>
                            <em><?php echo __( 'Display the booking status.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Booking Payment method', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_payment_method]</td>
                        <td>
                            <em><?php echo __( 'Display the booking payment method.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Booking Guest Name', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_guest_name]</td>
                        <td>
                            <em><?php echo __( 'Display the booking guest name.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>

                </table>
            </li>
            <li>
                <h5><?php echo __( 'Use for Hotel', ST_TEXTDOMAIN ); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr style="background: #CCC;">
                        <th align="center" width="33.3333%"><?php echo __( 'Name', ST_TEXTDOMAIN ); ?></th>
                        <th align="center" width="33.3333%"><?php echo __( 'Code', ST_TEXTDOMAIN ); ?></th>
                        <th align="center" width="33.3333%"><?php echo __( 'Description', ST_TEXTDOMAIN ); ?></th>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Room Name', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_room_name]</td>
                        <td>
                            <em>
                                <?php echo __( 'Display the room name of hotel.', ST_TEXTDOMAIN ); ?>
                                <br/>
                                @param 'title' 'string'.<br/>
                                <xmp> Eg: title="Room Name"</xmp>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Extra Items', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_extra_items]</td>
                        <td>
                            <em><?php echo __( 'Display all service/facillities inside a room.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Extra Price', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_extra_price]</td>
                        <td>
                            <em><?php echo __( 'Display total price of service in room.', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __( 'Use for Car', ST_TEXTDOMAIN ); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr style="background: #CCC;">
                        <th align="center" width="33.3333%"><?php echo __( 'Name', ST_TEXTDOMAIN ); ?></th>
                        <th align="center" width="33.3333%"><?php echo __( 'Code', ST_TEXTDOMAIN ); ?></th>
                        <th align="center" width="33.3333%"><?php echo __( 'Description', ST_TEXTDOMAIN ); ?></th>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Car Time', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_check_in_out_time]</td>
                        <td>
                            <em>
                                <?php echo __( 'Display Pick up and Drop off time.', ST_TEXTDOMAIN ); ?>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Car pick up from', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_pick_up_from]</td>
                        <td>
                            <em>
                                <?php echo __( 'Display Pick up from.', ST_TEXTDOMAIN ); ?>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Car Drop off to ', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_drop_off_to]</td>
                        <td>
                            <em>
                                <?php echo __( 'Car Drop off to ', ST_TEXTDOMAIN ); ?>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Car Driver Informations', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_car_driver]</td>
                        <td>
                            <em>
                                <?php echo __( 'Car Driver Informations  ', ST_TEXTDOMAIN ); ?>
                            </em>
                        </td>
                    </tr>

                    <tr>
                        <td><strong><?php echo __( 'Car Equipments', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_equipments]</td>
                        <td>
                            <em>
                                <?php echo __( 'Display equipment list in a car.', ST_TEXTDOMAIN ); ?>
                                </br />
                                @param 'tag' 'string'.<br/>
                                <xmp> Eg: tag="<h3>"</xmp>
                                <br/>
                                @param 'title' 'string'.<br/>
                                <xmp> Eg: title="Equipments"</xmp>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Car Equipments Price', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_equipment_price]</td>
                        <td>
                            <em>
                                <?php echo __( 'Display total price of equipment in car.', ST_TEXTDOMAIN ); ?>
                                <br/>
                                @param 'title' 'string'.<br/>
                                <xmp> Eg: title="Equipments Price"</xmp>
                            </em>
                        </td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __( 'Use for Tour and Activity', ST_TEXTDOMAIN ); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr style="background: #CCC;">
                        <th align="center" width="33.3333%"><?php echo __( 'Name', ST_TEXTDOMAIN ); ?></th>
                        <th align="center" width="33.3333%"><?php echo __( 'Code', ST_TEXTDOMAIN ); ?></th>
                        <th align="center" width="33.3333%"><?php echo __( 'Description', ST_TEXTDOMAIN ); ?></th>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Adult Information', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_adult_info]</td>
                        <td>
                            <em>
                                <?php echo __( 'Display info of adult (number and price)', ST_TEXTDOMAIN ); ?>
                                </br />
                                @param 'title' 'string'.<br/>
                                <xmp> Eg: title="No. Adults"</xmp>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Children Information', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_children_info]</td>
                        <td>
                            <em>
                                <?php echo __( 'Display info of adult (number and price)', ST_TEXTDOMAIN ); ?>
                                </br />
                                @param 'title' 'string'.<br/>
                                <xmp> Eg: title="No. Children"</xmp>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Infant Information', ST_TEXTDOMAIN ); ?>:</strong></td>
                        <td>[st_email_booking_infant_info]</td>
                        <td>
                            <em>
                                <?php echo __( 'Display info of infant  (number and price)', ST_TEXTDOMAIN ); ?>
                                </br />
                                @param 'title' 'string'.<br/>
                                <xmp> Eg: title="No. Infant"</xmp>
                            </em>
                        </td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __( 'Use for Confirm Email ', ST_TEXTDOMAIN ); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr>
                        <td><strong><?php echo __( 'Confirm Link', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_email_confirm_link]</td>
                        <td><em><?php echo __( 'Get confirm email link', ST_TEXTDOMAIN ); ?></em></td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __( 'Use for Approved Email', ST_TEXTDOMAIN ); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr>
                        <td><strong><?php echo __( 'Account name', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_approved_email_admin_name]</td>
                        <td><em><?php echo __( 'Returns the name of the accounts was approved', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Post type', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_approved_email_item_type]</td>
                        <td>
                            <em><?php echo __( 'Returns type is type approved post (Hotel, Rental, Car, ...)', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item name', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_approved_email_item_name]</td>
                        <td>
                            <em><?php echo __( 'Returns the name of the item has been approved', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Item link', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_approved_email_item_link]</td>
                        <td><em><?php echo __( 'Returns link to item', ST_TEXTDOMAIN ); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Approval date', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_approved_email_date]</td>
                        <td><em><?php echo __( 'Returns the Approval date', ST_TEXTDOMAIN ); ?></em></td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __( 'MemberShip', ST_TEXTDOMAIN ); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr>
                        <td><strong><?php echo __( 'Partner\'s Name', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_email_package_partner_name]</td>
                        <td><em><?php echo __( 'Returns the name of the partner', ST_TEXTDOMAIN ); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Partner\'s Email', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_email_package_partner_email]</td>
                        <td><em><?php echo __( 'Returns email of the partner', ST_TEXTDOMAIN ); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Partner\'s Phone', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_email_package_partner_phone]</td>
                        <td><em><?php echo __( 'Returns phone number of the partner', ST_TEXTDOMAIN ); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Package Name', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_email_package_name]</td>
                        <td><em><?php echo __( 'Returns name of the package', ST_TEXTDOMAIN ); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Package Price', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_email_package_price]</td>
                        <td><em><?php echo __( 'Returns price of the package', ST_TEXTDOMAIN ); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Package Commission', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_email_package_commission]</td>
                        <td><em><?php echo __( 'Returns commission of the package', ST_TEXTDOMAIN ); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Package Time', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_email_package_time]</td>
                        <td><em><?php echo __( 'Returns time available of the package', ST_TEXTDOMAIN ); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Package Item Upload', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_email_package_upload]</td>
                        <td>
                            <em><?php echo __( 'Returns number of item uploaded of the package', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Package Item Set Featured', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_email_package_featured]</td>
                        <td>
                            <em><?php echo __( 'Returns number of item set featured of the package', ST_TEXTDOMAIN ); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Package Description', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_email_package_description]</td>
                        <td><em><?php echo __( 'Returns description of the package', ST_TEXTDOMAIN ); ?></em></td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __( 'Invoice', ST_TEXTDOMAIN ); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr>
                        <td><strong><?php echo __( 'Link Download Invoice', ST_TEXTDOMAIN ); ?></strong></td>
                        <td>[st_email_booking_url_download_invoice]</td>
                        <td><em><?php echo __( 'Returns link download invoice', ST_TEXTDOMAIN ); ?></em></td>
                    </tr>
                </table>
            </li>
        </ul>
        <?php
        echo '</div>';

        echo '</div>';

    }

    function st_apply_discount( $price, $type = 'percent', $amount = '', $booking_date = '', $is_sale_schedule = 'off', $from_date = '', $to_date = '' )
    {
        if ( !$amount ) return $price;

        $is_discount = false;

        if ( $is_sale_schedule != 'on' ) {
            $is_discount = true;
        } else {
            if ( $booking_date and $from_date and $to_date and ( $booking_date ) >= ( $from_date ) and ( $booking_date ) <= ( $to_date ) ) $is_discount = true;
        }
        if ( $is_discount ) {
            switch ( $type ) {
                case "amount":
                case "fixed":
                    $price -= $amount;
                    break;
                case "percent":
                default:
                    $price -= ( $price * $amount / 100 );
                    break;
            }
        }

        if ( $price <= 0 ) $price = 0;

        return (float)$price;

    }

    if ( !function_exists( 'st_user_has_partner_features' ) ) {

        function st_user_has_partner_features( $user_id = false )
        {
            if ( !$user_id ) $user_id = get_current_user_id();

            if ( $user_id instanceof WP_User == false ) $user = new WP_User( $user_id );
            else $user = $user_id;

            $roles = $user->roles;

            if ( in_array( 'partner', $roles ) ) return true;
            if ( in_array( 'administrator', $roles ) ) return true;

            return false;

        }
    }
    if ( !function_exists( 'st_get_user_verify_keys' ) ) {
        function st_get_user_verify_keys()
        {
            $available_keys = [
                'email', 'phone', 'passport', 'travel_certificate', 'social'
            ];

            return apply_filters( 'st_get_user_verify_keys', $available_keys );
        }
    }
    if ( !function_exists( 'st_check_user_verify' ) ) {
        function st_check_user_verify( $key = '', $user_id = false )
        {
            if ( empty( $user_id ) ) $user_id = get_current_user_id();

            $available_keys = st_get_user_verify_keys();

            if ( $key ) {
                if ( !in_array( $key, $available_keys ) ) return false;

                return get_user_meta( $user_id, '_verify_' . $key, true );

            } else {
                // Check All Keys
                foreach ( $available_keys as $k ) {
                    if ( !st_check_user_verify( $k, $user_id ) ) return false;
                }

                return true;
            }


        }
    }
    if ( !function_exists( 'st_check_user_verify_empty' ) ) {
        function st_check_user_verify_empty( $arr )
        {
            $check = true;
            foreach ( $arr as $k => $v ) {
                if ( empty( $v ) ) {
                    $check = false;
                    break;
                }
            }

            return $check;
        }
    }

    if ( !function_exists( 'st_update_user_verify' ) ) {
        function st_update_user_verify( $key = '', $user_id, $value )
        {
            $available_keys = st_get_user_verify_keys();
            if ( $key ) {
                if ( !in_array( $key, $available_keys ) ) return false;
                update_user_meta( $user_id, '_verify_' . $key, $value );
            } else {
                foreach ( $available_keys as $k ) {
                    update_user_meta( $user_id, '_verify_' . $k, $value );
                }
            }
        }
    }

    if ( !function_exists( 'st_owner_post' ) ) {
        function st_owner_post()
        {
            if ( !is_user_logged_in() ) {
                return true;
            } else {
                $current_user_id = get_current_user_id();
                $post_id         = get_the_ID();
                if ( empty( $post_id ) ) {
                    return false;
                } else {
                    $author_id = get_post_field( 'post_author', $post_id );
                    if ( $author_id == $current_user_id ) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        }
    }

    if ( !function_exists( 'st_button_send_message' ) ) {
        function st_button_send_message( $post_id )
        {
            $res                = '';
            $enable_message_btn = st()->get_option( 'enable_send_message_button', 'off' );
            if ( $enable_message_btn == 'off' ) return;
            if ( is_user_logged_in() ) {
                $res = '<input type="submit" class="btn btn-default btn-send-message" data-id="' . $post_id . '" name="st_send_message" value="' . __( 'Send message', ST_TEXTDOMAIN ) . '"/>';
            } else {
                $enable_popup_login = st()->get_option( 'enable_popup_login', 'off' );
                $page_login         = st()->get_option( 'page_user_login' );
                $login_modal        = '';
                $page_login         = esc_url( get_the_permalink( $page_login ) );
                if ( $enable_popup_login == 'on' ) {
                    $login_modal = 'data-toggle="modal" data-target="#login_popup"';
                    $page_login  = 'javascript:void(0)';
                }
                $res = '<a href="' . $page_login . '" class="btn btn-default btn-send-message-login" ' . $login_modal . ' data-id="' . $post_id . '">' . __( 'Send message', ST_TEXTDOMAIN ) . '</a>';
            }

            return $res;
        }
    }

    if ( !function_exists( 'st_validate_msg' ) ) {
        function st_validate_msg( $msg, $rule = 'required' )
        {
            printf( '<div class="validate-msg rule-%s st_msg"><div class="alert alert-danger">%s</div></div>', $rule, $msg );
        }
    }


    if ( !function_exists( 'st_validate_guest_name' ) ) {
        function st_validate_guest_name( $post_id, $adult_number = 0, $children_number = 0, $infant_number = 0 )
        {
            $passValidate = true;

            $total = $adult_number;

            $disable_adult_name    = get_post_meta( $post_id, 'disable_adult_name', true );
            $disable_children_name = get_post_meta( $post_id, 'disable_children_name', true );
            $disable_infant_name   = get_post_meta( $post_id, 'disable_infant_name', true );

            if ( $disable_adult_name == 'on' ) $total = 0;
            if ( $disable_children_name != 'on' ) $total += $children_number;
            if ( $disable_infant_name != 'on' ) $total += $infant_number;

            $total -= 1;

            if ( $total > 0 ) {
                $guest_name = STInput::post( 'guest_name' );
                if ( empty( $guest_name ) )
                    $guest_name = STInput::get( 'guest_name' );
                $guest_title = STInput::post( 'guest_title' );
                if ( empty( $guest_title ) )
                    $guest_title = STInput::get( 'guest_title' );

                if ( empty( $guest_name ) or !is_array( $guest_name ) or count( $guest_name ) < $total ) $passValidate = false;
                if ( empty( $guest_title ) or !is_array( $guest_title ) or count( $guest_title ) < $total ) $passValidate = false;

                if ( $passValidate ) {

                    for ( $i = 0; $i < $total; $i++ ) {
                        if ( empty( $guest_name[ $i ] ) or empty( $guest_title[ $i ] ) ) $passValidate = false;
                    }
                }
            }


            return $passValidate;
        }
    }
    if ( !function_exists( 'st_guest_title_to_text' ) ) {
        function st_guest_title_to_text( $title_id )
        {
            switch ( $title_id ) {
                case "mr":
                    return esc_html__( 'Mr', ST_TEXTDOMAIN );
                    break;
                case "mrs":
                    return esc_html__( 'Mrs', ST_TEXTDOMAIN );
                    break;
                case "miss":
                    return esc_html__( 'Miss', ST_TEXTDOMAIN );
                    break;
            }
        }
    }

    if ( !function_exists( 'st_print_order_item_guest_name' ) ) {
        function st_print_order_item_guest_name( $data )
        {
            if ( !empty( $data[ 'guest_name' ] ) ) {
                ?>
                <p><strong><?php esc_html_e( 'Guest Name:', ST_TEXTDOMAIN ) ?></strong>
                    <?php
                        $guest_title = isset( $data[ 'guest_title' ] ) ? $data[ 'guest_title' ] : [];
                        $html        = [];
                        foreach ( $data[ 'guest_name' ] as $k => $name ) {
                            $str    = isset( $guest_title[ $k ] ) ? st_guest_title_to_text( $guest_title[ $k ] ) . ' ' : '';
                            $str    .= $name;
                            $html[] = $str;
                        }
                        echo implode( ', ', $html );
                    ?>
                </p>
                <?php
            }
        }
    }
    if ( !function_exists( 'st_admin_print_order_item_guest_name' ) ) {
        function st_admin_print_order_item_guest_name( $data )
        {
            if ( !empty( $data[ 'guest_name' ] ) ) {
                ?>
                <div class="form-row">
                    <label class="form-label" for=""><?php esc_html_e( 'Guest Name', ST_TEXTDOMAIN ) ?></label>
                    <div class="controls">
                        <?php
                            $guest_title = isset( $data[ 'guest_title' ] ) ? $data[ 'guest_title' ] : [];
                            $html        = [];
                            foreach ( $data[ 'guest_name' ] as $k => $name ) {
                                $str    = isset( $guest_title[ $k ] ) ? st_guest_title_to_text( $guest_title[ $k ] ) . ' ' : '';
                                $str    .= $name;
                                $html[] = $str;
                            }
                            echo implode( ', ', $html );
                        ?>
                    </div>
                </div>

                <?php
            }
        }
    }

    function st_get_data_location_from_to( $post_id )
    {
        global $wpdb;
        $table = $wpdb->prefix . 'st_location_relationships';

        $sql = $wpdb->prepare( "SELECT * FROM {$table} WHERE post_id = %d AND location_from <> '' AND location_to <> '' AND location_type = 'location_from_to'", $post_id );

        return $wpdb->get_results( $sql, ARRAY_A );
    }

