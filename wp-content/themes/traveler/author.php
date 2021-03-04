<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * author
 *
 * Created by ShineTheme
 *
 */
if(New_Layout_Helper::isNewLayout()){
    echo st()->load_template('layouts/modern/page/author');
    return;
}
get_header();
$current_user_upage = get_user_by('slug', get_query_var('author_name'));
$role = $current_user_upage->roles[0];
$user_meta = get_user_meta($current_user_upage->ID);
$user_meta = array_filter(array_map(function ($a) {
    return $a[0];
}, $user_meta));

$list_info = st()->get_option('display_list_partner_info', '');
if($list_info == 'all'){
	$list_info = array('all');
}
if(empty($list_info)){
	$list_info = array('all');
}

if (!STUser_f::check_partner_by_id($current_user_upage->ID)) {
    echo '<br /><div class="container">';
    echo __('Partner is not exists.', ST_TEXTDOMAIN);
    echo '</div>';
} else {
    $user_role = STUser_f::check_role_user_by_id($current_user_upage->ID);
    if (!in_array($user_role, array('partner', 'administrator'))) {
        echo st()->load_template('user/profile-page/normal-user', false, array());
    } else {

        $arr_service = [];
        if (STUser_f::_check_service_available_partner('st_hotel', $current_user_upage->ID)) {
            array_push($arr_service, 'hotel');
        }
        if (STUser_f::_check_service_available_partner('st_tours', $current_user_upage->ID)) {
            array_push($arr_service, 'tours');
        }
        if (STUser_f::_check_service_available_partner('st_activity', $current_user_upage->ID)) {
            array_push($arr_service, 'activity');
        }
        if (STUser_f::_check_service_available_partner('st_cars', $current_user_upage->ID)) {
            array_push($arr_service, 'cars');
        }
        if (STUser_f::_check_service_available_partner('st_rental', $current_user_upage->ID)) {
            array_push($arr_service, 'rental');
        }
        if (STUser_f::_check_service_available_partner('st_flight', $current_user_upage->ID)) {
            array_push($arr_service, 'flight');
        }
        if (!empty($arr_service)) {
            $active_tab = STInput::get('service', $arr_service[0]);
        }
        ?>
        <?php //if (in_array($role, )) :
        ?>
        <div class="container">
            <h1 class="author-page-title">
                <?php
                echo __('Partner Information', ST_TEXTDOMAIN);
                ?>
            </h1>
            <?php if (get_the_author_meta('description')) : ?>
                <div class="author-description"><?php the_author_meta('description'); ?></div>
            <?php endif; ?>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-xs-12">
                    <div class="author-info-wrapper">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="text-center">
                                    <?php  echo st_get_profile_avatar( $current_user_upage->ID, 200 );  ?>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="author-info-meta">

                                            <h4><strong><?php echo esc_html( $current_user_upage->display_name ) ?></strong></h4>
                                            <?php
                                            $admin_packages = STAdminPackages::get_inst();
                                            $order          = $admin_packages->get_order_by_partner( $current_user_upage->ID );
                                            $enable         = $admin_packages->enabled_membership();
                                            if ( $enable ):
                                                if ( $order ):
                                                    if($order->status == 'completed') {
                                                        ?>
                                                        <img src="<?php echo ST_TRAVELER_URI; ?>/img/membership.png"
                                                             alt="<?php echo TravelHelper::get_alt_image(); ?>"
                                                             class="heading-image img-responsive img-mbp" width="200px">
                                                        <h3 class="uppercase color-main">
                                                            <strong><?php echo esc_html($order->package_name); ?></strong></h3><br/>
                                                        <?php
                                                    }
                                                endif;
                                            endif;
                                            ?>
                                            <p>
                                                <?php echo st_get_language( 'user_member_since' ) . mysql2date( ' M Y', $current_user_upage->data->user_registered ); ?>
                                                -
                                                <?php
                                                $author_obj = ST_Author::inst();
                                                echo '( ' . $author_obj->st_get_time_membership( $current_user_upage->data->user_registered ) . ' )';
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="author-info-meta">
                                            <ul class="author-list-info">
                                                <?php if ( isset( $user_meta['st_is_check_show_info'] ) && $user_meta['st_is_check_show_info'] == 'on' ): ?>
                                                    <?php if ( (in_array('all', $list_info) || in_array('email', $list_info)) ) { ?>
                                                        <li>
                                                            <i class="fa fa-envelope input-icon"></i> <?php echo '<strong>' . __( 'Email: ', ST_TEXTDOMAIN ) . '</strong>' . $current_user_upage->user_email; ?>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ( isset( $user_meta['st_phone'] ) ) { ?>
                                                        <?php if ( $user_meta['st_phone'] != '' && (in_array('all', $list_info) || in_array('phone', $list_info)) ) { ?>
                                                            <li><i class="fa fa-phone"
                                                                   aria-hidden="true"></i> <?php echo '<strong>' . __( 'Phone: ', ST_TEXTDOMAIN ) . '</strong>' . $user_meta['st_phone']; ?>
                                                            </li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if ( isset( $user_meta['st_paypal_email'] ) ) { ?>
                                                        <?php if ( $user_meta['st_paypal_email'] != '' && (in_array('all', $list_info) || in_array('email_paypal', $list_info)) ) { ?>
                                                            <li>
                                                                <i class="fa fa-money input-icon"></i> <?php echo '<strong>' . __( 'Email Paypal: ', ST_TEXTDOMAIN ) . '</strong>' . $user_meta['st_paypal_email']; ?>
                                                            </li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php endif; ?>
                                                <?php if ( isset( $user_meta['st_airport'] ) ): ?>
                                                    <?php if ( $user_meta['st_airport'] != '' && (in_array('all', $list_info) || in_array('home_airport', $list_info)) ) { ?>
                                                        <li>
                                                            <i class="fa fa-plane input-icon"></i> <?php echo '<strong>' . __( 'Home Airport: ', ST_TEXTDOMAIN ) . '</strong>' . $user_meta['st_airport']; ?>
                                                        </li>
                                                    <?php } ?>
                                                <?php endif; ?>
                                                <?php if ( isset( $user_meta['st_address'] ) || isset( $user_meta['st_city'] ) || isset( $user_meta['st_country'] ) ): ?>
                                                    <?php if ((in_array('all', $list_info) || in_array('address', $list_info))) { ?>
                                                        <li><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                            <?php
                                                            $address = '';
                                                            echo '<strong>' . __( 'Address: ', ST_TEXTDOMAIN ) . '</strong>';
                                                            if ( isset( $user_meta['st_address'] ) ) {
                                                                $address .= $user_meta['st_address'];
                                                            }
                                                            if ( isset( $user_meta['st_city'] ) ) {
                                                                $address .= ', ' . $user_meta['st_city'];
                                                            }
                                                            if ( isset( $user_meta['st_country'] ) ) {
                                                                $address .= ', ' . $user_meta['st_country'];
                                                            }
                                                            echo $address;
                                                            ?>
                                                        </li>
                                                    <?php } ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="author-verify-status">
                                            <h4 class="verify-title"><?php esc_html_e('Verifications',ST_TEXTDOMAIN) ?></h4>
                                            <ul>
                                                <li><i class="left-icon fa fa-phone"></i> <span><?php esc_html_e('Phone number',ST_TEXTDOMAIN) ?></span> <i class="right-icon <?php echo st_check_user_verify('phone')?'fa fa-check':'fa fa-times' ?>"></i></li>
                                                <li><i class="left-icon fa fa-user"></i> <span><?php esc_html_e('ID Card',ST_TEXTDOMAIN) ?></span> <i class="right-icon <?php echo st_check_user_verify('passport')?'fa fa-check':'fa fa-times' ?>"></i></li>
                                                <li><i class="left-icon fa fa-book"></i> <span><?php esc_html_e('Travel Certificate',ST_TEXTDOMAIN) ?></span> <i class="right-icon <?php echo st_check_user_verify('travel_certificate')?'fa fa-check':'fa fa-times' ?>"></i></li>
                                                <li><i class="left-icon fa fa-envelope"></i> <span><?php esc_html_e('Email',ST_TEXTDOMAIN) ?></span> <i class="right-icon <?php echo st_check_user_verify('email')?'fa fa-check':'fa fa-times' ?>"></i></li>
                                                <li><i class="left-icon fa fa-share-alt"></i> <span><?php esc_html_e('Social media',ST_TEXTDOMAIN) ?></span> <i class="right-icon <?php echo st_check_user_verify('social')?'fa fa-check':'fa fa-times' ?>"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="author-bio">
                            <?php
                            if (isset($user_meta['st_bio'])) {
                                if ($user_meta['st_bio'] != '' && (in_array('all', $list_info) || in_array('bio', $list_info))) {
                                    echo '<strong>' . __("Author's description", ST_TEXTDOMAIN) . '</strong>';
                                    echo nl2br($user_meta['st_bio']);
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="author-services">
                        <h4><?php echo __("Partner's Service", ST_TEXTDOMAIN); ?></h4>
                        <hr/>
                        <?php if (!empty($arr_service)) { ?>
                            <ul class="nav nav-tabs" id="">
                                <?php
                                foreach ($arr_service as $k => $v) {
                                    if (STUser_f::_check_service_available_partner('st_'.$v, $current_user_upage->ID)) {
                                        $get = $_GET;
                                        $get['service'] = $v;
                                        unset($get['pages']);
                                        $author_link = esc_url(get_author_posts_url($current_user_upage->ID));
                                        $url = esc_url(add_query_arg($get, $author_link));
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
                                $author_link = esc_url(get_author_posts_url($current_user_upage->ID));
                                $url = esc_url(add_query_arg($get, $author_link));
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
                                        'posts_per_page' => 10,
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
                                            echo st()->load_template('user/profile-page/list_review', false, array(
                                                'current_user_upage' => $current_user_upage,
                                                'arr_service' => $arr_service,
                                                'post_per_page_review' => 10
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
                </div>
                <!-- Sidebar here -->
                <div class="col-sm-3 col-xs-12">
                    <aside class=''>
                        <?php
                        $arr_full_service = [];
                        if (!empty($arr_service)) {
                            foreach ($arr_service as $kkk => $vvv) {
                                array_push($arr_full_service, 'st_' . $vvv);
                            }
                        }
                        $author_query_id = array(
                            'author' => $current_user_upage->ID,
                            'post_type' => $arr_full_service,
                            'posts_per_page' => '-1',
                            'post_status' => 'publish'
                        );

                        $a_query = new WP_Query($author_query_id);
                        $arr_id = [];
                        while ($a_query->have_posts()) {
                            $a_query->the_post();
                            array_push($arr_id, get_the_ID());
                        }
                        wp_reset_postdata();

                        $review_data = STReview::data_comment_author_page($arr_id, 'st_reviews');
                        $total_review_core = 0;
                        $arr_c_rate = [];
                        if (!empty($review_data)) {
                            foreach ($review_data as $kkk => $vvv) {
                                $comment_rate = get_comment_meta($vvv['comment_ID'], 'comment_rate', true);
                                array_push($arr_c_rate, $comment_rate);
                                $total_review_core = $total_review_core + $comment_rate;
                            }

                            foreach ($arr_c_rate as $k => $v) {
                                if ($v == 0 || $v == '') {
                                    unset($arr_c_rate[$k]);
                                }
                            }

                            $avg_rating = round(array_sum($arr_c_rate) / count($arr_c_rate), 1);
                        }

                        if (!empty($review_data)) {
                            ?>
                            <div class="author-review-box">
                                <h4><?php echo __('Average rating', ST_TEXTDOMAIN); ?></h4>
                                <p class="author-review-score">
                                    <span class="author-review-number"><?php echo $avg_rating; ?></span>
                                    <span class="author-review-number-total">/5</span>
                                </p>
                                <div class="author-start-rating">
                                    <div class="stm-star-rating">
                                        <div class="inner">
                                            <div class="stm-star-rating-upper"
                                                 style="width:<?php echo $avg_rating / 5 * 100; ?>%;"></div>
                                            <div class="stm-star-rating-lower"></div>
                                        </div>
                                    </div>
                                </div>
                                <p class="author-review-label">
                                    <?php printf(__('(Based on %s ratings.)', ST_TEXTDOMAIN), count($review_data)); ?>
                                </p>
                            </div>
                        <?php } else {
                            ?>
                            <div class="author-review-box">
                                <h4><?php echo __('No Reviews', ST_TEXTDOMAIN); ?></h4>
                            </div>
                            <?php
                        } ?>
                        <?php echo st()->load_template('user/profile-page/contact-form', false, array('current_user' => $current_user_upage)); ?>
                    </aside>
                </div>
                <!-- End sidebar -->
            </div>
        </div>
        <?php //endif;
        ?>
        <?php
    }
}
get_footer(); ?>