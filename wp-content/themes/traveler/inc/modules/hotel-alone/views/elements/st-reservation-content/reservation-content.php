<?php
    extract( $data );
    if ( empty( $service_id ) ) return;
    global $wp_query;
    $rooms = Hotel_Alone_Helper::inst()->search_room_by_id($service_id);
?>
    <div class="helios-reservation-content" data-style="<?php echo esc_html( $style ) ?>">
        <?php
            $checkin_d = STInput::request( 'checkin_d' );
            $checkin_m = STInput::request( 'checkin_m' );
            $checkin_y = STInput::request( 'checkin_y' );
            $checkin   = STInput::request( 'checkin' );

            $checkout_d   = STInput::request( 'checkout_d' );
            $checkout_m   = STInput::request( 'checkout_m' );
            $checkout_y   = STInput::request( 'checkout_y' );
            $checkout     = STInput::request( 'checkout' );
            $check_in_out = STInput::request( 'check_in_out' );

            $class = '';
            if ( !$checkin_d and !$checkin_m and !$checkin_y and !$checkout_d and !$checkout_m and !$checkout_y ) {
                $class = 'no_date';
            }
        ?>
        <div class="search_room_alert_new"></div>
        <div method="post" class="wpbooking_order_form <?php echo esc_html( $class ) ?>">
            <!--<input name="action" value="wpbooking_add_to_cart" type="hidden">
            <input name="post_id" value="<?php //echo esc_html( $service_id ) ?>" type="hidden">
            <input name="wpbooking_checkin_d" class="form_book_checkin_d" value="<?php //echo esc_attr( $checkin_d ) ?>"
                   type="hidden">
            <input name="wpbooking_checkin_m" class="form_book_checkin_m" value="<?php //echo esc_attr( $checkin_m ) ?>"
                   type="hidden">
            <input name="wpbooking_checkin_y" class="form_book_checkin_y" value="<?php //echo esc_attr( $checkin_y ) ?>"
                   type="hidden">
            <input name="wpbooking_checkin" class="form_book_checkin" value="<?php //echo esc_attr( $checkin ) ?>"
                   type="hidden">

            <input name="wpbooking_checkout_d" class="form_book_checkout_d"
                   value="<?php //echo esc_attr( $checkout_d ) ?>" type="hidden">
            <input name="wpbooking_checkout_m" class="form_book_checkout_m"
                   value="<?php //echo esc_attr( $checkout_m ) ?>" type="hidden">
            <input name="wpbooking_checkout_y" class="form_book_checkout_y"
                   value="<?php //echo esc_attr( $checkout_y ) ?>" type="hidden">
            <input name="wpbooking_checkout" class="form_book_checkout"
                   value="<?php //echo esc_attr( $checkout ) ?>" type="hidden">
            <input name="wpbooking_check_in_out" class="form_book_check_in_out"
                   value="<?php //echo esc_attr( $check_in_out ) ?>" type="hidden">

            <input name="wpbooking_room_number" class="form_book_room_number" type="hidden">
            <input name="wpbooking_adults" class="form_book_adults" type="hidden">
            <input name="wpbooking_children" class="form_book_children" type="hidden">

            <button class="wb-button helios-submit-button hide" type="button"></button>-->
            <div class="search_room_alert hide"></div>

            <div class="content content-search-room">
                <span class="info_number hide">0</span>
                <span class="info_price hide">0</span>
                <div class="content-loop-room <?php if ( $style == 'style-2' ) echo "row"; ?>">
                    <?php
                        if(!empty($rooms)){
                            if($rooms['status']){
                                if ( $rooms['data']->have_posts() ) {
                                    while ( $rooms['data']->have_posts() ) {
                                        $rooms['data']->the_post();
                                        echo st_hotel_alone_load_view( 'elements/st-reservation-content/style/' . $style, false, [ 'data' => $data ] );
                                    }
                                }
                                wp_reset_postdata();
                            }else{
                                ?>
                                <div class="search_room_alert_new">
                                    <div class="alert alert-danger"><?php echo $rooms['message']; ?></div>
                                </div>
                                <?php
                            }
                        }

                    ?>
                </div>
            </div>
            <div class="pagination-room">
                <?php echo hotel_alone_pagination_room( $rooms['data'] ); ?>
            </div>
        </div>
    </div>
<?php wp_reset_query(); ?>