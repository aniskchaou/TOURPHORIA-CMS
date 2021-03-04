<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Admin hotel booking edit
     *
     * Created by ShineTheme
     *
     */

    $item_id = isset( $_GET[ 'order_item_id' ] ) ? $_GET[ 'order_item_id' ] : false;

    $order_item_id = get_post_meta( $item_id, 'item_id', true );

    $section = isset( $_GET[ 'section' ] ) ? $_GET[ 'section' ] : false;
    if ( !isset( $page_title ) ) {
        $page_title = __( 'Edit Hotel Booking', ST_TEXTDOMAIN );
    }
    $currency = get_post_meta( $item_id, 'currency', true );
?>
<div class="wrap">
    <?php echo '<h2>' . $page_title . '</h2>'; ?>
    <?php STAdmin::message() ?>
    <div id="post-body" class="columns-2">
        <div id="post-body-content">
            <div class="postbox-container">
                <form method="post" action="" id="form-booking-admin">
                    <?php wp_nonce_field( 'shb_action', 'shb_field' ) ?>
                    <div id="poststuff">
                        <div class="postbox">
                            <div class="handlediv" title="<?php _e( 'Click to toggle', ST_TEXTDOMAIN ) ?>"><br></div>
                            <h3 class="hndle ui-sortable-handle">
                                <span><?php _e( 'Order Information', ST_TEXTDOMAIN ) ?></span></h3>
                            <div class="inside">
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e( 'Booker ID', ST_TEXTDOMAIN ) ?><span
                                            class="require"> (*)</span></label>
                                    <div class="controls">
                                        <?php
                                            $id_user = '';
                                            $pl_name = '';
                                            if ( $item_id ) {
                                                $id_user = get_post_meta( $item_id, 'id_user', true );
                                                if ( $id_user ) {
                                                    $user = get_userdata( $id_user );
                                                    if ( $user ) {
                                                        $pl_name = $user->ID . ' - ' . $user->user_email;
                                                    }
                                                }
                                            }
                                        ?>
                                        <input readonly type="text" name="id_user"
                                               value="<?php echo esc_attr( $pl_name ); ?>"
                                               class="form-control form-control-admin">
                                    </div>
                                </div>

                                <?php ob_start(); ?>

                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e( 'Customer First Name', ST_TEXTDOMAIN ) ?>
                                        <span class="require"> (*)</span></label>
                                    <div class="controls">
                                        <?php
                                            $st_first_name = isset( $_POST[ 'st_first_name' ] ) ? $_POST[ 'st_first_name' ] : get_post_meta( $item_id, 'st_first_name', true );
                                        ?>
                                        <input type="text" name="st_first_name" value="<?php echo $st_first_name; ?>"
                                               class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e( 'Customer Last Name', ST_TEXTDOMAIN ) ?>
                                        <span class="require"> (*)</span></label>
                                    <div class="controls">
                                        <?php
                                            $st_last_name = isset( $_POST[ 'st_last_name' ] ) ? $_POST[ 'st_last_name' ] : get_post_meta( $item_id, 'st_last_name', true );
                                        ?>
                                        <input type="text" name="st_last_name" value="<?php echo $st_last_name; ?>"
                                               class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e( 'Customer Email', ST_TEXTDOMAIN ) ?><span
                                            class="require"> (*)</span></label>
                                    <div class="controls">
                                        <?php
                                            $st_email = isset( $_POST[ 'st_email' ] ) ? $_POST[ 'st_email' ] : get_post_meta( $item_id, 'st_email', true );
                                        ?>
                                        <input type="text" name="st_email" value="<?php echo $st_email; ?>"
                                               class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e( 'Customer Phone', ST_TEXTDOMAIN ) ?><span
                                            class="require"> (*)</span></label>
                                    <div class="controls">
                                        <?php
                                            $st_phone = isset( $_POST[ 'st_phone' ] ) ? $_POST[ 'st_phone' ] : get_post_meta( $item_id, 'st_phone', true );
                                        ?>
                                        <input type="text" name="st_phone" value="<?php echo $st_phone; ?>"
                                               class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label"
                                           for=""><?php _e( 'Customer Address line 1', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php
                                            $st_address = isset( $_POST[ 'st_address' ] ) ? $_POST[ 'st_address' ] : get_post_meta( $item_id, 'st_address', true );
                                        ?>
                                        <input type="text" name="st_address" value="<?php echo $st_address; ?>"
                                               class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label"
                                           for=""><?php _e( 'Customer Address line 2', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php
                                            $st_address2 = isset( $_POST[ 'st_address2' ] ) ? $_POST[ 'st_address2' ] : get_post_meta( $item_id, 'st_address2', true );
                                        ?>
                                        <input type="text" name="st_address2" value="<?php echo $st_address2; ?>"
                                               class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label"
                                           for=""><?php _e( 'Customer City', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php
                                            $st_city = isset( $_POST[ 'st_city' ] ) ? $_POST[ 'st_city' ] : get_post_meta( $item_id, 'st_city', true );
                                        ?>
                                        <input type="text" name="st_city" value="<?php echo $st_city; ?>"
                                               class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label"
                                           for=""><?php _e( 'State/Province/Region', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php
                                            $st_province = isset( $_POST[ 'st_province' ] ) ? $_POST[ 'st_province' ] : get_post_meta( $item_id, 'st_province', true );
                                        ?>
                                        <input type="text" name="st_province" value="<?php echo $st_province; ?>"
                                               class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label"
                                           for=""><?php _e( 'ZIP code/Postal code', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php
                                            $st_zip_code = isset( $_POST[ 'st_zip_code' ] ) ? $_POST[ 'st_zip_code' ] : get_post_meta( $item_id, 'st_zip_code', true );
                                        ?>
                                        <input type="text" name="st_zip_code" value="<?php echo $st_zip_code; ?>"
                                               class="form-control form-control-admin">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e( 'Country', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php
                                            $st_country = isset( $_POST[ 'st_country' ] ) ? $_POST[ 'st_country' ] : get_post_meta( $item_id, 'st_country', true );
                                        ?>
                                        <input type="text" name="st_country" value="<?php echo $st_country; ?>"
                                               class="form-control form-control-admin">
                                    </div>
                                </div>

                                <?php
                                $custommer = @ob_get_clean();
                                echo apply_filters( 'st_customer_infomation_edit_order', $custommer,$item_id );
                                ?>


                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e( 'Room', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php
                                            $room_id = intval( get_post_meta( $item_id, 'room_id', true ) );
                                        ?>
                                        <strong><?php echo get_the_title( $room_id ); ?></strong>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e( 'Price', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php
                                            $item_price = floatval( get_post_meta( $item_id, 'item_price', true ) );
                                            $currency   = get_post_meta( $item_id, 'currency', true );
                                        ?>
                                        <strong><?php echo TravelHelper::format_money_from_db( $item_price, $currency ); ?></strong>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e( 'No. Adults', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php
                                            $adult_number = (int) get_post_meta( $item_id, 'adult_number', true );
                                        ?>
                                        <strong><?php echo $adult_number; ?></strong>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label"
                                           for=""><?php _e( 'No. Children', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php
                                            $child_number = (int) get_post_meta( $item_id, 'child_number', true );
                                        ?>
                                        <strong><?php echo $child_number; ?></strong>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e( 'Number Room', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php
                                            $item_number = (int) get_post_meta( $item_id, 'item_number', true );
                                        ?>
                                        <strong><?php echo $item_number; ?></strong>
                                    </div>
                                </div>

                                <?php st_admin_print_order_item_guest_name([
                                    'guest_name'=>get_post_meta($item_id,'guest_name',true),
                                    'guest_title'=>get_post_meta($item_id,'guest_title',true),
                                ]); ?>
                                <div class="form-row">
                                    <label class="form-label" for="check_in">
                                        <?php _e( 'Check in', ST_TEXTDOMAIN ) ?>
                                    </label>
                                    <div class="controls">
                                        <?php
                                            $check_in = get_post_meta( $item_id, 'check_in', true );
                                            if ( !empty( $check_in ) ) {
                                                $check_in = date( 'm/d/Y', strtotime( $check_in ) );
                                            }
                                        ?>
                                        <strong><?php echo $check_in; ?></strong>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for="check_out"><?php _e( 'Check out', ST_TEXTDOMAIN ) ?>
                                    </label>
                                    <div class="controls">
                                        <?php
                                            $check_out = get_post_meta( $item_id, 'check_out', true );
                                            if ( !empty( $check_out ) ) {
                                                $check_out = date( 'm/d/Y', strtotime( $check_out ) );
                                            }
                                        ?>
                                        <strong><?php echo $check_out; ?></strong>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label" for="extra"><?php _e( 'Extra', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php
                                            $extra_price = get_post_meta( $room_id, 'extra_price', true );
                                            $extras      = get_post_meta( $item_id, 'extras', true );
                                            $data_item   = [];
                                            $data_number = [];
                                            if ( isset( $extras[ 'value' ] ) && is_array( $extras[ 'value' ] ) && count( $extras[ 'value' ] ) ) {
                                                foreach ( $extras[ 'value' ] as $name => $number ) {
                                                    $data_item[]          = $name;
                                                    $data_number[ $name ] = $extras[ 'value' ][ $name ];
                                                }
                                            }
                                        ?>
                                        <?php if ( is_array( $extra_price ) && count( $extra_price ) ): ?>
                                            <table class="table" style="table-layout: fixed;" width="200">
                                                <?php foreach ( $extra_price as $key => $val ): ?>
                                                    <tr>
                                                        <td width="80%">
                                                            <label for="<?php echo $val[ 'extra_name' ]; ?>"
                                                                   class="ml20">
                                                                <strong><?php echo $val[ 'title' ]; ?></strong>
                                                            </label>
                                                        </td>
                                                        <td width="20%">
                                                            <strong><?php echo (int) $data_number[ $val[ 'extra_name' ] ]; ?></strong>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </table>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php
                                    $st_note = get_post_meta( $item_id, 'st_note', true );
                                    if(!empty($st_note)){
                                ?>
                                <div class="form-row">
                                    <label class="form-label"
                                           for="st_note"><?php _e( 'Special Requirements', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php echo esc_html( $st_note ); ?>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php
                                if(!empty($booking_fee_price = get_post_meta($item_id, 'booking_fee_price', true))){
                                    ?>
                                    <div class="form-row">
                                        <label class="form-label" for=""><?php _e( 'Fee', ST_TEXTDOMAIN ) ?></label>
                                        <div class="controls">
                                            <strong><?php echo TravelHelper::format_money_from_db($booking_fee_price ,$currency); ?></strong>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-row">
                                    <label class="form-label" for=""><?php _e( 'Total', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <?php
                                        $data_prices = ( get_post_meta( $item_id, 'data_prices', true ) );
                                        ?>
                                        <strong><?php echo TravelHelper::format_money_from_db( $data_prices['price_with_tax'], $currency ); ?></strong>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label"
                                           for="status"><?php _e( 'Status', ST_TEXTDOMAIN ) ?></label>
                                    <div class="controls">
                                        <select class="" name="status">
                                            <?php $status = get_post_meta( $item_id, 'status', true ); ?>
                                            <option
                                                value="pending" <?php selected( $status, 'pending' ) ?> ><?php _e( 'Pending', ST_TEXTDOMAIN ) ?></option>
                                            <option
                                                value="incomplete" <?php selected( $status, 'incomplete' ) ?> ><?php _e( 'Incomplete', ST_TEXTDOMAIN ) ?></option>
                                            <option
                                                value="complete" <?php selected( $status, 'complete' ) ?> ><?php _e( 'Complete', ST_TEXTDOMAIN ) ?></option>
                                            <option
                                                value="canceled" <?php selected( $status, 'canceled' ) ?> ><?php _e( 'Canceled', ST_TEXTDOMAIN ) ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="controls">
                                        <input type="submit" name="submit"
                                               value="<?php echo __( 'Save', ST_TEXTDOMAIN ) ?>"
                                               class="button button-primary ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>