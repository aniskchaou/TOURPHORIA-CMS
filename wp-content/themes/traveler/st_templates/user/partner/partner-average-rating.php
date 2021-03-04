<?php
$partner_id = STInput::get('partner_id', '');
if(STUser_f::check_partner_in_element($partner_id)) {
    $current_user_upage = get_user_by('ID', $partner_id);
    $role = $current_user_upage->roles[0];
    $user_meta = get_user_meta($current_user_upage->ID);
    $user_meta = array_filter(array_map(function ($a) {
        return $a[0];
    }, $user_meta));

    $arr_service = [];
    if ( STUser_f::_check_service_available_partner( 'st_hotel', $current_user_upage->ID ) ) {
        array_push( $arr_service, 'st_hotel' );
    }
    if ( STUser_f::_check_service_available_partner( 'st_tours', $current_user_upage->ID ) ) {
        array_push( $arr_service, 'st_tours' );
    }
    if ( STUser_f::_check_service_available_partner( 'st_activity', $current_user_upage->ID ) ) {
        array_push( $arr_service, 'st_activity' );
    }
    if ( STUser_f::_check_service_available_partner( 'st_cars', $current_user_upage->ID ) ) {
        array_push( $arr_service, 'st_cars' );
    }
    if ( STUser_f::_check_service_available_partner( 'st_rental', $current_user_upage->ID ) ) {
        array_push( $arr_service, 'st_rental' );
    }
    if ( STUser_f::_check_service_available_partner( 'st_flight', $current_user_upage->ID ) ) {
        array_push( $arr_service, 'st_flight' );
    }
    if ( ! empty( $arr_service ) ) {
        $active_tab = STInput::get( 'service', $arr_service[0] );
    }

    $author_query_id = array(
        'author' => $current_user_upage->ID,
        'post_type' => $arr_service,
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

        $default = array(
            'title' => __('Average rating', ST_TEXTDOMAIN),
            'font_size' => '4',
        );

        extract(wp_parse_args($atts, $default));

        ?>
        <div class="author-review-box">
            <h<?php echo esc_attr($font_size); ?> class="author-review-box-title"><?php echo esc_attr($title); ?></h<?php echo esc_attr($font_size) ?>>
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
    }
}?>