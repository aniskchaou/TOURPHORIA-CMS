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

switch ($service) {
    case 'st_hotel':
        if (st_check_service_available('st_hotel')) {
            $hotel = STHotel::inst();
            $hotel->alter_search_query();
            $query = new WP_Query($args);
            $html = '<div class="services-grid"><div class="row">';
            while ($query->have_posts()):
                $query->the_post();
                $html .= st()->load_template('layouts/modern/hotel/loop/grid', '');
            endwhile;
            $hotel->remove_alter_search_query();
            wp_reset_postdata();
            $post = $old_post;
            $html .= '</div></div>';
            echo balanceTags($html);
        }
        break;
    case 'st_tours':
        if (st_check_service_available('st_tours')) {
            $tour = STTour::get_instance();
            $tour->alter_search_query();
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                echo '<div class="search-result-page st-tours service-slider-wrapper"><div class="st-hotel-result"><div class="owl-carousel st-service-slider">';
                while ($query->have_posts()):
                    $query->the_post();
                    echo st()->load_template('layouts/modern/tour/elements/loop/grid', '', array('slider' => true));
                endwhile;
                echo '</div></div></div>';
            }
            $tour->remove_alter_search_query();
            wp_reset_postdata();
            $post = $old_post;
        }
        break;
    case 'st_rental':
        if (st_check_service_available('st_rental')) {
            $rental = STRental::inst();
            $rental->alter_search_query();
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                echo '<div class="search-result-page st-rental service-slider-wrapper"><div class="st-hotel-result"><div class="owl-carousel st-service-rental-slider">';
                while ($query->have_posts()):
                    $query->the_post();
                    echo st()->load_template('layouts/modern/rental/elements/loop/grid', '', array('slider' => true));
                endwhile;
                echo '</div></div></div>';
            }
            $rental->remove_alter_search_query();
            wp_reset_postdata();
            $post = $old_post;
        }
        break;
    case 'st_activity':
        if (st_check_service_available('st_activity')) {
            $activity = STActivity::inst();
            $activity->alter_search_query();
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                echo '<div class="search-result-page st-tours service-slider-wrapper st_activity"><div class="st-hotel-result"><div class="owl-carousel st-service-slider">';
                while ($query->have_posts()):
                    $query->the_post();
                    echo st()->load_template('layouts/modern/activity/elements/loop/grid', '', array('slider' => true));
                endwhile;
                echo '</div></div></div>';
            }
            $activity->remove_alter_search_query();
            wp_reset_postdata();
            $post = $old_post;
        }
        break;
    case 'st_cars':
        if (st_check_service_available('st_cars')) {
            $car = STCars::get_instance();
            $car->alter_search_query();
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                echo '<div class="search-result-page st-tours service-slider-wrapper st_cars"><div class="st-hotel-result"><div class="owl-carousel st-service-slider">';
                while ($query->have_posts()):
                    $query->the_post();
                    echo st()->load_template('layouts/modern/car/elements/loop/grid', '', array('slider' => true));
                endwhile;
                echo '</div></div></div>';
            }
            $car->remove_alter_search_query();
            wp_reset_postdata();
            $post = $old_post;
        }
        break;
}
?>

