<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 9/7/2018
 * Time: 10:18 AM
 */


/**
 * @todo Tính toán lại các meta của 1 location theo 1 post type, bao gồm min_price, min_price_post_id, offer_count, comment_count
 *
 * @param $post_type
 * @param $location_id
 */
function st_212_location_update_meta_by_post_type($post_type, $location_id)
{
    global $wpdb;

    $locations      = STLocation::get_children_location( $location_id );
    $where_location = "";
    if ( !empty( $locations ) ) {
        $where_location .= " AND location_from IN (";
        $string = implode( ',', $locations );
        $where_location .= $string . ")";
    }


    $where = TravelHelper::edit_where_wpml( '', $post_type );
    $join  = TravelHelper::edit_join_wpml( '', $post_type );

    $comment_count_sql = "SELECT *,COUNT(comment_ID) as total
                          FROM {$wpdb->comments}
                          JOIN {$wpdb->posts} on {$wpdb->posts}.ID = {$wpdb->comments}.comment_post_ID
          
                          INNER JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}{$post_type}.post_id
                            {$join}
                          JOIN {$wpdb->prefix}st_location_relationships ON {$wpdb->prefix}st_location_relationships.post_id = {$wpdb->prefix}{$post_type}.post_id
                            {$where_location}
                            LEFT JOIN {$wpdb->prefix}comments ON {$wpdb->prefix}comments.comment_post_ID = {$wpdb->prefix}{$post_type}.post_id
                            AND `comment_type` = 'st_reviews'
                            AND comment_approved = 1
                            WHERE
                                {$wpdb->prefix}posts.post_status IN ('private', 'publish')
                                {$where}
                            GROUP BY
                                {$wpdb->prefix}{$post_type}.post_id
                          ";

    $comment_count = $wpdb->get_row($comment_count_sql)->total;



    $keys = [
        "_{$post_type}_comment_count"     => $comment_count,
        "_{$post_type}_offer_count"       => $comment_count,
        "_{$post_type}_min_price"         => $comment_count,
        "_{$post_type}_min_price_post_id" => $comment_count,
    ];

    foreach ($keys as $key => $data) {
        update_post_meta($location_id, $key, $data);
    }
}