<?php
$partner_id = STInput::get('partner_id', '');
if (STUser_f::check_partner_in_element($partner_id)) {
    $current_user_upage = get_user_by('ID', $partner_id);
    $role = $current_user_upage->roles[0];
    $user_meta = get_user_meta($current_user_upage->ID);
    $user_meta = array_filter(array_map(function ($a) {
        return $a[0];
    }, $user_meta));

    $arr_service = [];
    if ( STUser_f::_check_service_available_partner( 'st_hotel', $current_user_upage->ID ) ) {
        array_push( $arr_service, 'hotel' );
    }
    if ( STUser_f::_check_service_available_partner( 'st_tours', $current_user_upage->ID ) ) {
        array_push( $arr_service, 'tours' );
    }
    if ( STUser_f::_check_service_available_partner( 'st_activity', $current_user_upage->ID ) ) {
        array_push( $arr_service, 'activity' );
    }
    if ( STUser_f::_check_service_available_partner( 'st_cars', $current_user_upage->ID ) ) {
        array_push( $arr_service, 'cars' );
    }
    if ( STUser_f::_check_service_available_partner( 'st_rental', $current_user_upage->ID ) ) {
        array_push( $arr_service, 'rental' );
    }
    if ( STUser_f::_check_service_available_partner( 'st_flight', $current_user_upage->ID ) ) {
        array_push( $arr_service, 'flight' );
    }
    if ( ! empty( $arr_service ) ) {
        $active_tab = STInput::get( 'service', $arr_service[0] );
    }

    $default = array(
        'title' => __("Partner's Services", ST_TEXTDOMAIN),
        'font_size' => '4',
        'post_per_page_service' => 10,
        'post_per_page_review' => 5,
    );

    extract(wp_parse_args($atts, $default));
    ?>
    <div class="author-services">
        <h<?php echo esc_attr($font_size); ?> class="author-review-box-title"><?php echo esc_attr($title); ?></h<?php echo esc_attr($font_size) ?>>
        <hr/>
        <?php if (!empty($arr_service)) { ?>
            <ul class="nav nav-tabs" id="">
                <?php
                foreach ($arr_service as $k => $v) {
                    if (STUser_f::_check_service_available_partner('st_'.$v, $current_user_upage->ID)) {
                        $get = $_GET;
                        $get['service'] = $v;
                        unset($get['pages']);
                        $url = esc_url( add_query_arg( $get, get_permalink() ) );
                        ?>
                        <li class="<?php echo $active_tab == $v ? 'active' : ''; ?>"><a
                                    href="<?php echo $url; ?>"
                                    aria-expanded="true"><?php
                                switch ($v) {
                                    case "hotel":
                                        echo __('Hotel', ST_TEXTDOMAIN);
                                        break;
                                    case "tours":
                                        echo __('Tour', ST_TEXTDOMAIN);
                                        break;
                                    case "activity":
                                        echo __('Activity', ST_TEXTDOMAIN);
                                        break;
                                    case "cars":
                                        echo __('Car', ST_TEXTDOMAIN);
                                        break;
                                    case "rental":
                                        echo __('Rental', ST_TEXTDOMAIN);
                                        break;
                                    case "flight":
                                        echo __('Flight', ST_TEXTDOMAIN);
                                        break;
                                }

                                ?></a></li>
                        <?php
                    }
                }
                $get = $_GET;
                $get['service'] = 'review';
                unset($get['pages']);
                $url = esc_url( add_query_arg( $get, get_permalink() ) );
                ?>
                <li class="<?php echo $active_tab == 'review' ? 'active' : ''; ?>"><a
                            href="<?php echo $url; ?>"
                            aria-expanded="true"><?php echo __('Reviews', ST_TEXTDOMAIN); ?></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in author-sv-list" id="tab-all">
                    <?php
                    $service = STInput::get('service', $arr_service[0]);
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $author = $current_user_upage->ID;
                    $args = array(
                        'post_type' => 'st_' . $service,
                        'post_status' => 'publish',
                        'author' => $author,
                        'posts_per_page' => $post_per_page_service,
                        'paged' => $paged
                    );
                    $query = new WP_Query($args);

                    if ($query->have_posts()) {
                        switch ($service) {
                            case "hotel":
                                echo '<ul class="booking-list loop-hotel style_list">';
                                break;
                            case "tours":
                                echo '<ul class="booking-list loop-tours style_list">';
                                break;
                            case "activity":
                                echo '<ul class="booking-list loop-activities style_list">';
                                break;
                            case "cars":
                                echo '<ul class="booking-list loop-cars style_list">';
                                break;
                            case "rental":
                                echo '<ul class="booking-list loop-rental style_list">';
                                break;
                            case "flight":
                                echo '<ul class="booking-list loop-rental style_list">';
                                break;
                        }
                        while ($query->have_posts()) {
                            $query->the_post();
                            switch ($service) {
                                case "hotel":
                                    echo st()->load_template('hotel/loop', 'list');
                                    break;
                                case "tours":
                                    echo st()->load_template('tours/elements/loop/loop-1', null, array('tour_id' => get_the_ID()));
                                    break;
                                case "activity":
                                    echo st()->load_template('activity/elements/loop/loop-1', false);
                                    break;
                                case "cars":
                                    echo st()->load_template('cars/elements/loop/loop-1');
                                    break;
                                case "rental":
                                    echo st()->load_template('rental/loop', 'list', array('taxonomy' => ''));
                                    break;
                                case "flight":
                                    echo st()->load_template('user/loop/loop', 'flight-upage');
                                    break;
                            }
                        }
                        echo "</ul>";
                    } else {
                        if ($service != 'review') {
                            echo '<h5>' . __('No data', ST_TEXTDOMAIN) . '</h5>';
                        } else {
                            echo st()->load_template('user/partner/partner', 'list-review', array(
                                'current_user_upage' => $current_user_upage,
                                'arr_service' => $arr_service,
                                'post_per_page_review' => $post_per_page_review
                            ));
                        }
                    };
                    wp_reset_postdata();
                    ?>
                    <br/>
                    <div class="pull-left author-pag">
                        <?php st_paging_nav(null, $query) ?>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo __('No partner services!', ST_TEXTDOMAIN);
        }
        ?>
    </div>
    <?php
}
?>