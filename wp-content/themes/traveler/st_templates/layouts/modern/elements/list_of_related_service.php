<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 13-11-2018
 * Time: 5:10 PM
 * Since: 1.0.0
 * Updated: 1.0.0
 */
global $post;
$old_post = $post;

$args = [
    'post_type' => $service,
    'posts_per_page' => $posts_per_page,
    'order' => 'ASC',
    'orderby' => 'name',
];
if ($ids) {
    $args['post__in'] = explode(',', $ids);
}

?>
<div class="st-related-service-new">
    <?php if (!empty($title)) { ?>
        <div class="e-title-wrapper">
            <h3 class="e-title"><?php echo esc_attr($title); ?></h3>
        </div>
    <?php } ?>
    <?php

    switch ($service) {
        case 'st_hotel':
            if (!st_check_service_available('st_hotel')) {
                break;
            }
            $hotel = STHotel::inst();
            $hotel->alter_search_query();
            $query = new WP_Query($args);
            $html = '';
            while ($query->have_posts()):
                $query->the_post();
                $html .= st()->load_template('layouts/modern/hotel/loop/related');
            endwhile;
            $hotel->remove_alter_search_query();
            wp_reset_postdata();
            $post = $old_post;
            echo balanceTags($html);
            break;
        case 'st_tours':
            if (!st_check_service_available('st_tours')) {
                break;
            }
            $tour = STTour::get_instance();
            $tour->alter_search_query();
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()):
                    $query->the_post();
                    echo st()->load_template('layouts/modern/tour/elements/loop/related');
                endwhile;
            }
            $tour->remove_alter_search_query();
            wp_reset_postdata();
            $post = $old_post;
            break;
        case 'st_activity':
            if (!st_check_service_available('st_activity')) {
                break;
            }
            $activity = STActivity::inst();
            $activity->alter_search_query();
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()):
                    $query->the_post();
                    echo st()->load_template('layouts/modern/activity/elements/loop/related');
                endwhile;
            }
            $activity->remove_alter_search_query();
            wp_reset_postdata();
            $post = $old_post;
            break;
        case 'st_cars':
            if (!st_check_service_available('st_cars')) {
                break;
            }
            $car = STCars::get_instance();
            $car->alter_search_query();
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()):
                    $query->the_post();
                    echo st()->load_template('layouts/modern/car/elements/loop/related');
                endwhile;
            }
            $car->remove_alter_search_query();
            wp_reset_postdata();
            $post = $old_post;
            break;

    }
    ?>
</div>

