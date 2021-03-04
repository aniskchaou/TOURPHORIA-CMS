<?php
    /**
     * @since 1.2.2
     **/
    if ( !class_exists( 'STLocationRelationships' ) ) {
        class STLocationRelationships
        {
            public $table                             = 'st_location_relationships';
            public $column                            = [];
            public $st_upgrade_location_relationships = 0;
            public $allow_version                     = false;

            public function __construct()
            {

                add_action( 'save_post', [ $this, 'st_update_location_relationships' ], 9999999 );
                add_action( 'delete_post', [ $this, 'st_delete_location_relationships' ], 9999999 );

            }

            public function st_update_location_relationships( $post_id )
            {
                global $wpdb;

                $table          = $wpdb->prefix . $this->table;
                $multi_location = get_post_meta( $post_id, 'multi_location', true );
                $post_type      = get_post_type( $post_id );

                if ( $post_type == "st_hotel" ) {
                    $list_room       = STAdminHotel::_get_list_room_by_hotel( $post_id );
                    $string_location = "";
                    if ( !empty( $list_room ) ) {
                        foreach ( $list_room as $key => $val ) {
                            $multi_location_tmp = explode( ',', $multi_location );
                            if ( !empty( $multi_location_tmp ) and is_array( $multi_location_tmp ) ) {
                                foreach ( $multi_location_tmp as $location ) {
                                    if ( !empty( $location ) ) {
                                        $location = (int) str_replace( '_', '', $location );
                                        $this->insert_location_relationships( $val->post_id, $location );
                                        $string_location .= "'" . $location . "',";
                                    }
                                }
                            }
                            if ( !empty( $string_location ) ) {
                                $string_location = substr( $string_location, 0, -1 );
                                $sql             = "DELETE FROM {$table} WHERE post_id = {$val->post_id} AND location_from NOT IN ({$string_location}) AND location_type = 'multi_location'";
                                $wpdb->query( $sql );
                            }
                            update_post_meta( $val->post_id, 'multi_location', $multi_location );
                        }
                    }
                }
                if ( $post_type == "hotel_room" ) {
                    $hotel_id = get_post_meta( $post_id, 'room_parent', 'true' );
                    if ( empty( $hotel_id ) ) {
                        $hotel_id = STInput::request( 'room_parent' );
                    }
                    $multi_location_hotel = get_post_meta( $hotel_id, 'multi_location', true );
                    if ( !empty( $multi_location_hotel ) ) {
                        $string_location    = "";
                        $multi_location_tmp = explode( ',', $multi_location_hotel );
                        if ( !empty( $multi_location_tmp ) and is_array( $multi_location_tmp ) ) {
                            foreach ( $multi_location_tmp as $location ) {
                                if ( !empty( $location ) ) {
                                    $location = (int) str_replace( '_', '', $location );
                                    $this->insert_location_relationships( $post_id, $location );
                                    $string_location .= "'" . $location . "',";
                                }
                            }
                        }
                        if ( !empty( $string_location ) ) {
                            $string_location = substr( $string_location, 0, -1 );
                            $sql             = "DELETE FROM {$table} WHERE post_id = {$post_id} AND location_from NOT IN ({$string_location}) AND location_type = 'multi_location'";
                            $wpdb->query( $sql );
                        }
                        update_post_meta( $post_id, 'multi_location', $multi_location_hotel );
                    }
                }

                if ( !empty( $multi_location ) && !is_array( $multi_location ) ) {
                    $multi_location = explode( ',', $multi_location );
                }
                $string_location = "";

                if ( !empty( $multi_location ) and is_array( $multi_location ) ) {
                    foreach ( $multi_location as $location ) {
                        if ( !empty( $location ) ) {
                            $location = (int) str_replace( '_', '', $location );
                            $this->insert_location_relationships( $post_id, $location );
                            $string_location .= "'" . $location . "',";
                        }
                    }
                }

                if ( !empty( $string_location ) ) {
                    $string_location = substr( $string_location, 0, -1 );

                    $sql = "DELETE FROM {$table} WHERE post_id = {$post_id} AND location_from NOT IN ({$string_location}) AND location_type = 'multi_location'";

                    $wpdb->query( $sql );
                }
            }

            public function st_delete_location_relationships( $post_id )
            {
                global $wpdb;
                $table = $wpdb->prefix . $this->table;

                $where = [
                    'post_id' => $post_id
                ];
                $wpdb->delete( $table, $where );
            }


            public function insert_location_relationships( $post_id = '', $location = '' )
            {
                global $wpdb;
                $table = $wpdb->prefix . 'st_location_relationships';
                $sql   = "SELECT ID FROM {$table} WHERE post_id = {$post_id} AND location_from = {$location} AND location_type = 'multi_location'";

                $row = $wpdb->get_var( $sql );
                if ( empty( $row ) ) {
                    $data = [
                        'post_id'       => $post_id,
                        'location_from' => $location,
                        'location_to'   => 0,
                        'post_type'     => get_post_type( $post_id ),
                        'location_type' => 'multi_location'
                    ];

                    $wpdb->insert( $table, $data );
                }
            }
        }

        new STLocationRelationships;
    }