<?php
    /**
     * @since 1.1.8
     **/
    if ( !class_exists( 'CarHelper' ) ) {
        class CarHelper
        {
            public function init()
            {

            }

            static function _get_car_cant_order( $check_in, $check_out )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_cars' ) ) return '';
                global $wpdb;

                if ( TravelHelper::is_wpml() ) {
                    $sql  = "SELECT
                    origin_id as st_booking_id,
                    check_in_timestamp,
                    check_out_timestamp,
                    mt.number_car AS number_car,
                    mt.number_car - COUNT(origin_id) AS free_car
                FROM
                    {$wpdb->prefix}st_order_item_meta
                INNER JOIN {$wpdb->prefix}st_cars AS mt ON mt.post_id = st_booking_id
                WHERE
                    st_booking_post_type = 'st_cars'
                AND `status` NOT IN ('trash', 'canceled')
                AND (
                        (
                            {$check_in} < check_in_timestamp
                            AND {$check_out} > check_out_timestamp
                        )
                        OR (
                            {$check_in} BETWEEN check_in_timestamp
                            AND check_out_timestamp
                        )
                        OR (
                            {$check_out} BETWEEN check_in_timestamp
                            AND check_out_timestamp
                        )
                    )
                GROUP BY origin_id
                HAVING
                    number_car - COUNT(st_booking_id) <= 0";
                } else {
                    $sql = "SELECT
                        st_booking_id,
                        check_in_timestamp,
                        check_out_timestamp,
                        mt.number_car AS number_car,
                        mt.number_car - COUNT(st_booking_id) AS free_car
                    FROM
                        {$wpdb->prefix}st_order_item_meta
                    INNER JOIN {$wpdb->prefix}st_cars AS mt ON mt.post_id = st_booking_id
                    WHERE
                        st_booking_post_type = 'st_cars'
                        AND `status` NOT IN ('trash', 'canceled')
                    AND (
                        (
                            {$check_in} < check_in_timestamp
                            AND {$check_out} > check_out_timestamp
                        )
                        OR (
                            {$check_in} BETWEEN check_in_timestamp
                            AND check_out_timestamp
                        )
                        OR (
                            {$check_out} BETWEEN check_in_timestamp
                            AND check_out_timestamp
                        )
                    )
                    GROUP BY st_booking_id
                    HAVING
                        number_car - COUNT(st_booking_id)  <= 0";
                }

                $result = $wpdb->get_results( $sql, ARRAY_A );
                $list   = "''";
                if ( is_array( $result ) && count( $result ) ) {
                    $list = [];
                    foreach ( $result as $key => $val ) {
                        $list[] = $val[ 'st_booking_id' ];
                    }
                    $list = implode( ',', $list );
                }

                return $list;
            }

            static function _get_car_cant_order_by_id( $car_id, $check_in, $check_out, $order_item_id = '' )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_cars' ) ) return true;
                global $wpdb;
                $string = "";
                if ( !empty( $order_item_id ) ) {
                    $string = " AND order_item_id NOT IN ('{$order_item_id}') ";
                }
                if ( TravelHelper::is_wpml() ) {
                    $sql  = "SELECT
                        origin_id AS car_id,
                        mt.number_car AS number_car,
                        mt.number_car - COUNT(origin_id) AS car_free
                    FROM
                        {$wpdb->prefix}st_order_item_meta
                    INNER JOIN {$wpdb->prefix}st_cars AS mt ON mt.post_id = st_booking_id
                    WHERE
                        st_booking_post_type = 'st_cars'
                    AND `status` NOT IN ('trash', 'canceled')
                    AND origin_id = '{$car_id}'
                    AND (
                        ({$check_in} < check_in_timestamp AND {$check_out} > check_out_timestamp)
                            OR(
                            {$check_in} BETWEEN check_in_timestamp AND check_out_timestamp
                        )
                            OR(
                            {$check_out} BETWEEN check_in_timestamp AND check_out_timestamp
                        )
                    )
                    {$string}
                    GROUP BY
                        origin_id
                    HAVING
                        (
                            mt.number_car - COUNT(st_booking_id) <= 0
                        )";
                } else {
                    $sql = "SELECT
                      st_booking_id as car_id,
                      mt.meta_value as number_car,
                      mt.meta_value - COUNT(st_booking_id) as car_free
                    FROM {$wpdb->prefix}st_order_item_meta
                    INNER JOIN {$wpdb->prefix}postmeta as mt ON mt.post_id = st_booking_id AND mt.meta_key = 'number_car'
                    WHERE
                      st_booking_post_type = 'st_cars'
                    AND `status` NOT IN ('trash', 'canceled')
                    AND st_booking_id = '{$car_id}'
                    AND (
                        ({$check_in} < check_in_timestamp AND {$check_out} > check_out_timestamp)
                            OR(
                            {$check_in} BETWEEN check_in_timestamp AND check_out_timestamp
                        )
                            OR(
                            {$check_out} BETWEEN check_in_timestamp AND check_out_timestamp
                        )
                    )
                    {$string}
                    GROUP BY st_booking_id
                    HAVING (mt.meta_value - COUNT(st_booking_id) <= 0)";
                }
                $result = $wpdb->get_results( $sql, ARRAY_A );

                $number_car = get_post_meta( $car_id, 'number_car', true );
                if ( is_array( $result ) && count( $result ) or (int)$number_car == 0 ) {
                    return false;
                }

                return true;
            }

        }

        $carhelper = new CarHelper();
        $carhelper->init();
    }
?>