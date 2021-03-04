<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Review list
 *
 * Created by ShineTheme
 *
 */
/* override default avatar size */
?>

<li id="comment-<?php $data->comment_ID; ?>">
    <div class="row">
        <div class="col-md-2">
            <div class="booking-item-review-person">
                <a class="booking-item-review-person-avatar round" href="#">
                    <?php
                    $comment_id = $data->comment_ID;
                    $user_id = $data->user_id;
                    $user_email = $data->comment_author_email;
                    $current_user = wp_get_current_user();
                    $custom_avatar = st_get_profile_avatar($user_id, 70);
                    if (!empty($custom_avatar)) {
                        echo st_get_profile_avatar($user_id, 70);
                    } else {
                        echo st_get_profile_avatar_by_email($user_email, 70);
                    }
                    ?>
                </a>
                <p class="booking-item-review-person-name">
                    <?php printf(__('%s', ST_TEXTDOMAIN), sprintf('<cite class="fn">%s</cite>', $data->comment_author)); ?>
                </p>
                <p class="booking-item-review-person-loc"><?php
                    $user_show_address = apply_filters('st_user_show_address', false);
                    if ($user_show_address) echo get_user_meta($user_id, 'st_address', true);
                    ?>
                </p>
                <small>
                    <a href="#"><?php $review = STUser::count_review_by_email($user_email);

                        ?>
                        <?php
                        if ($review == 0) {
                            esc_html_e('0 Review','traveler');

                        } elseif ($review == 1) {
                            esc_html_e('1 Review','traveler');

                        } else {
                            printf(__('%d ', ST_TEXTDOMAIN) . esc_html__('reviews','traveler'), $review);
                        }
                        ?>

                    </a>
                </small>
            </div>
        </div>

        <div class="col-md-10">
            <div class="booking-item-review-content">
                <?php if ($comment_title = get_comment_meta($comment_id, 'comment_title', true)):

                    ?>
                    <h5>"<?php echo balanceTags($comment_title) ?>"</h5>

                <?php endif; ?>

                 <?php echo '<b>' . __('Review for ', ST_TEXTDOMAIN) . '<a href="' . get_permalink($data->comment_post_ID) . '" target="_blank">' . get_the_title($data->comment_post_ID) . '</a></b>'; ?>

                <?php if ($comment_rate = get_comment_meta($comment_id, 'comment_rate', true)):
                    ?>
                    <ul class="icon-group booking-item-rating-stars" data-rate="<?php echo esc_attr($comment_rate) ?>">
                        <?php
                        if (!$comment_rate) $comment_rate = 1;
                        echo TravelHelper::rate_to_string($comment_rate);
                        ?>

                    </ul>
                <?php endif; ?>

                <?php if ('0' == $data->comment_approved) : ?>
                    <p class="alert alert-danger comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.','traveler') ?></p>
                <?php endif; ?>
                <div class="comment-content">
                    <?php
                    $max_string = 200;
                    $text = $data->comment_content;
                    echo TravelHelper::add_read_more($text, $max_string);
                    ?>
                </div>

                <div class="<?php /*if($max_string<strlen($text))*/
                echo 'booking-item-review-more-content' ?>">
                    <?php do_action('st_review_more_content', $comment_id) ?>
                    <?php
                    $review_stat = [];
                    switch ($post_type) {
                        case "st_hotel":
                            $review_stat = st()->get_option('hotel_review_stats');
                            break;
                        case "st_tours":
                            $review_stat = st()->get_option('tour_review_stats');
                            break;
                        case "st_activity":
                            $review_stat = st()->get_option('activity_review_stats');
                            break;
                        case "st_cars":
                            $review_stat = st()->get_option('car_review_stats');
                            break;
                        case "st_rental":
                            $review_stat = st()->get_option('rental_review_stats');
                            break;
                    }
                    $data = $review_stat;

                    $output[] = '<ul class="list booking-item-raiting-summary-list mt20">';

                    if (!empty($data) and is_array($data)) {
                        foreach ($data as $value) {
                            $key = $value['title'];


                            $stat_value = get_comment_meta($comment_id, 'st_stat_' . sanitize_title($value['title']), true);

                            $output[] = '
                    <li>
                        <div class="booking-item-raiting-list-title">' . $key . '</div>
                        <ul class="icon-group booking-item-rating-stars">';
                            for ($i = 1; $i <= 5; $i++) {
                                $class = '';
                                if ($i > $stat_value)
                                    $class = 'text-gray';
                                $output[] = '<li><i class="fa fa-smile-o ' . $class . '"></i>';
                            }

                            $output[] = '
                        </ul>
                    </li>';
                        }
                    }

                    $output[] = '</ul>';


                    echo implode("\n", $output);
                    ?>
                </div>
                <?php //if($max_string<strlen($text)):
                ?>

                <div class="booking-item-review-expand"><span
                            class="booking-item-review-expand-more"><?php esc_html_e('More','traveler') ?> <i
                                class="fa fa-angle-down"></i></span><span
                            class="booking-item-review-expand-less"><?php esc_html_e('Less','traveler') ?> <i
                                class="fa fa-angle-up"></i></span>
                </div>
                <?php //endif;
                ?>

                <p class="booking-item-review-rate"><?php esc_html_e('Was this review helpful?','traveler') ?>
                    <?php
                    $count_like = get_comment_meta($comment_id, '_comment_like_count', true);
                    if (intval($count_like) <= 0) $count_like = 0;
                    ?>
                    <b class="text-color"> <span
                                class="number"><?php echo $count_like; ?></span> <?php echo __('like this', ST_TEXTDOMAIN); ?>
                    </b>

                    <?php $review_obj = new STReview();
                    if ($review_obj->check_like($comment_id)):
                        ?>
                        <a data-id="<?php echo esc_attr($comment_id); ?>"
                           class="st-like-review fa fa-thumbs-o-down box-icon-inline round" href="#"></a>

                        <?php
                    else:
                        ?>

                        <a data-id="<?php echo esc_attr($comment_id); ?>"
                           class="st-like-review fa fa-thumbs-o-up box-icon-inline round" href="#"></a></b>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</li>