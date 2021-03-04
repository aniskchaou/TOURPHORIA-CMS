<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/23/2017
 * Version: 1.0
 */

if(!class_exists('ST_Flight_Helper')){
    class ST_Flight_Helper{

        static $_inst;

        function __construct()
        {



        }

        function get_min_max_price_flight(){

            global $wpdb;

            $sql = "SELECT
                        CASE
                            WHEN MIN(
                                CAST(
                                    {$wpdb->prefix}st_flight_availability.eco_price AS DECIMAL
                                )
                            ) < MIN(
                                CAST(
                                    {$wpdb->prefix}st_flight_availability.business_price AS DECIMAL
                                )
                            ) THEN
                                MIN(
                                    CAST(
                                        {$wpdb->prefix}st_flight_availability.eco_price AS DECIMAL
                                    )
                                )
                            ELSE
                                MIN(
                                    CAST(
                                        {$wpdb->prefix}st_flight_availability.business_price AS DECIMAL
                                    )
                                )
                        END AS price_min,
                         CASE
                            WHEN MAX(
                                CAST(
                                    {$wpdb->prefix}st_flight_availability.eco_price AS DECIMAL
                                )
                            ) < MAX(
                                CAST(
                                    {$wpdb->prefix}st_flight_availability.business_price AS DECIMAL
                                )
                            ) THEN
                                MAX(
                                    CAST(
                                        {$wpdb->prefix}st_flight_availability.business_price AS DECIMAL
                                    )
                                )
                            ELSE
                                MAX(
                                    CAST(
                                        {$wpdb->prefix}st_flight_availability.eco_price AS DECIMAL
                                    )
                                )
                        END AS price_max
                        FROM
                            {$wpdb->prefix}st_flight_availability
                        JOIN {$wpdb->posts} ON {$wpdb->posts}.ID = {$wpdb->prefix}st_flight_availability.post_id
                        WHERE
                            {$wpdb->prefix}st_flight_availability.eco_price > 0
                        AND {$wpdb->prefix}st_flight_availability.business_price > 0
                        AND {$wpdb->prefix}st_flight_availability.`status` = 'available'
                        AND {$wpdb->posts}.post_status = 'publish'
                        AND {$wpdb->prefix}st_flight_availability.start_date >= UNIX_TIMESTAMP(CAST(NOW() as DATE))";

            $res = $wpdb->get_row($sql, ARRAY_A);

            return $res;
        }

        static function inst(){
            if(!self::$_inst)
                self::$_inst = new self();

            return self::$_inst;
        }
    }

    ST_Flight_Helper::inst();
}