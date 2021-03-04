<?php
$post_type_service = STInput::get('review', $arr_service[0]);
?>
<div class="author-list-review">
    <h4><?php echo __("List of reviews", ST_TEXTDOMAIN); ?></h4>
    <?php if (!empty($arr_service)) { ?>
        <div class="row">
            <div class="col-lg-2">
                <ul class="author-review-panel">
                    <?php
                    foreach ($arr_service as $k => $v) {
                        if (STUser_f::_check_service_available_partner($v, $current_user_upage->ID)) {
                            $get = $_GET;
                            $get['service'] = 'review';
                            unset($get['pages']);
                            $get['review'] = $v;
                            $url = esc_url(add_query_arg($get, get_permalink()));
                            ?>
                            <li class="<?php echo $post_type_service == $v ? 'active' : ''; ?>"><a
                                        href="<?php echo $url; ?>"><?php
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
                    ?>
                </ul>
            </div>
            <div class="col-lg-10">
                <div class="author-review-panel-list">
                    <?php
                    $author_query_id = array(
                        'author' => $current_user_upage->ID,
                        'post_type' => 'st_' . $post_type_service,
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
                    $page = (int)(!isset($_REQUEST["pages"]) ? 1 : $_REQUEST["pages"]);
                    $limit = $post_per_page_review;
                    $offset = ($page * $limit) - $limit;
                    $param = array(
                        'status' => 'approve',
                        'post__in' => $arr_id,
                        'offset' => $offset,
                        'number' => $limit,
                    );
                    $total_comments = get_comments(array('status' => 'approve', 'post__in' => $arr_id));
                    $pages = ceil(count($total_comments) / $post_per_page_review);
                    $comments = get_comments($param);
                    $review_stat = [];
                    switch ($post_type_service) {
                        case "hotel":
                            $review_stat = st()->get_option('hotel_review_stats');
                            break;
                        case "tours":
                            $review_stat = st()->get_option('tour_review_stats');
                            break;
                        case "activity":
                            $review_stat = st()->get_option('activity_review_stats');
                            break;
                        case "cars":
                            $review_stat = st()->get_option('car_review_stats');
                            break;
                        case "rental":
                            $review_stat = st()->get_option('rental_review_stats');
                            break;
                    }

                    $review_data = STReview::data_comment_author_page($arr_id, 'st_reviews');
                    if (!empty($review_data)) {
                        $arr_option_review = [];
                        $s = 0;
                        foreach ($review_data as $kkk => $vvv) {
                            if (!empty($review_stat) and is_array($review_stat)) {
                                foreach ($review_stat as $value) {
                                    $key = $value['title'];
                                    $stat_value = get_comment_meta($vvv['comment_ID'], 'st_stat_' . sanitize_title($value['title']), true);
                                    $arr_option_review[$s][$key] = $stat_value;
                                }
                            }
                            $s++;
                        }

                        foreach ($arr_option_review as $k => $v) {
                            $c = 0;
                            foreach ($review_stat as $kk => $vv) {
                                if ($v[$vv['title']] == 0 || $v[$vv['title']] == '') {
                                    $c++;
                                }
                            }
                            if ($c == 5) {
                                unset($arr_option_review[$k]);
                            }
                        }

                        $i = 0;
                        $arr_temp = [];
                        foreach ($arr_option_review as $k => $v) {
                            $arr_temp[$i] = $v;
                            $i++;
                        }

                        $arr_option_review = $arr_temp;
                        $avrage = [];
                        if (!empty($arr_option_review)) {
                            foreach ($arr_option_review[0] as $kk => $vv) {
                                $avrage[$kk] = 0;
                            }
                        }

                        if (!empty($arr_option_review)) {
                            $i = count($arr_option_review);
                            foreach ($arr_option_review as $value) {
                                foreach ($arr_option_review[0] as $kk => $vv) {
                                    $avrage[$kk] += $value[$kk];
                                }
                            }

                            foreach ($arr_option_review[0] as $kk => $vv) {
                                $avrage[$kk] = ($avrage[$kk] ? number_format(round($avrage[$kk] / $i, 1), 1) : 0);
                            }
                        }
                        if (!empty($avrage)):
                            ?>
                            <div class="author-review-detail">
                                <div class="stm-dealer-overall-inner">
                                    <?php
                                    foreach ($avrage as $k => $v) {
                                        ?>
                                        <div class="col-lg-6">
                                            <div class="stm-dealer-rate-part stm-dealer-rate-part-1">
                                                <h4><?php echo $k; ?></h4>
                                                <div class="author-start-rating">
                                                    <div class="stm-star-rating">
                                                        <div class="inner">
                                                            <div class="stm-star-rating-upper"
                                                                 style="width:<?php echo round($v / 5 * 100, 0); ?>%"></div>
                                                            <div class="stm-star-rating-lower"></div>
                                                        </div>
                                                        <span><strong><?php echo $v; ?></strong> <?php echo __('out of 5.0', ST_TEXTDOMAIN); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                            </div>

                            <?php
                        endif;
                        ?>
                        <ul class="booking-item-reviews list">
                            <?php
                            if (!empty($comments)) {
                                foreach ($comments as $comment) {
                                    echo st()->load_template('user/partner/partner', 'review-list-author', array(
                                        'data' => $comment,
                                        'post_type' => $post_type_service
                                    ));
                                }
                                $args = array(
                                    'base' => '%_%',
                                    'format' => '?pages=%#%',
                                    'total' => $pages,
                                    'current' => $page,
                                    'show_all' => false,
                                    'end_size' => 1,
                                    'mid_size' => 2,
                                    'prev_next' => true,
                                    'prev_text' => __('&laquo; Previous', ST_TEXTDOMAIN),
                                    'next_text' => __('Next &raquo;', ST_TEXTDOMAIN),
                                    'type' => 'plain'
                                );
                                echo '<div class="pagination loop-pagination pagination">';
                                echo paginate_links($args);
                                echo '</div>';
                            }
                            ?>
                        </ul>
                        <?php
                    } else {
                        echo __('No reviews data', ST_TEXTDOMAIN);
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>