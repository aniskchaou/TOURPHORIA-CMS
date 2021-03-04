<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Admin activity index
     *
     * Created by ShineTheme
     *
     */

    $page   = isset( $_GET[ 'paged' ] ) ? $_GET[ 'paged' ] : 1;
    $limit  = 20;
    $offset = ( $page - 1 ) * $limit;

    $data  = STAdmin::get_history_bookings( 'st_flight', $offset, $limit );
    $posts = $data[ 'rows' ];
    $total = ceil( $data[ 'total' ] / $limit );

    global $wp_query;

    $paging = [];

    $paging[ 'base' ]    = admin_url( 'edit.php?post_type=st_flight&page=st_flight_booking%_%' );
    $paging[ 'format' ]  = '&paged=%#%';
    $paging[ 'total' ]   = $total;
    $paging[ 'current' ] = $page;

    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
    echo '<h2>' . __( 'Flight Booking', ST_TEXTDOMAIN ) . '</h2>';

    STAdmin::message();
?>
<form id="posts-filter" action="<?php echo admin_url( 'edit.php?post_type=st_flight&page=st_flight_booking' ) ?>"
      method="get">
    <input type="hidden" name="post_type" value="st_flight">
    <input type="hidden" name="page" value="st_flight_booking">
    <div class="wp-filter st-wp-filter">
        <div class="filter-items">

            <div class="alignleft actions">

                <input type="text" class="st_datepicker" format="mm/dd/yyyy" name="st_date_start"
                       placeholder="<?php _e( 'Filter by Date from', ST_TEXTDOMAIN ) ?>"
                       value="<?php echo STInput::get( 'st_date_start' ) ?>"/>
                <input type="text" class="st_datepicker" name="st_date_end"
                       placeholder="<?php _e( 'Filter by Date to', ST_TEXTDOMAIN ) ?>"
                       value="<?php echo STInput::get( 'st_date_end' ) ?>"/>
                <input type="submit" name="filter_action" id="post-query-submit" class="button"
                       value="<?php _e( 'Filter', ST_TEXTDOMAIN ) ?>">
            </div>
        </div>
    </div>
</form>
<form id="posts-filter" action="<?php echo admin_url( 'edit.php?post_type=st_flight&page=st_flight_booking' ) ?>"
      method="post">

    <?php wp_nonce_field( 'shb_action', 'shb_field' ) ?>
    <div class="tablenav top">
        <div class="alignleft actions bulkactions">
            <label for="bulk-action-selector-top"
                   class="screen-reader-text"><?php _e( 'Select bulk action', ST_TEXTDOMAIN ) ?></label><select
                name="st_action" id="bulk-action-selector-top">
                <option value="-1" selected="selected"><?php _e( 'Bulk Actions', ST_TEXTDOMAIN ) ?></option>
                <option value="delete"><?php _e( 'Delete Permanently', ST_TEXTDOMAIN ) ?></option>
            </select>
            <input type="submit" name="" id="doaction" class="button action"
                   value="<?php _e( 'Apply', ST_TEXTDOMAIN ) ?>">
        </div>
        <div class="tablenav-pages">
            <span
                class="displaying-num"><?php echo sprintf( _n( '%s item', '%s items', $data[ 'total' ] ), $data[ 'total' ], ST_TEXTDOMAIN ) ?></span>
            <?php echo paginate_links( $paging ) ?>

        </div>
    </div>

    <table class="wp-list-table widefat fixed posts">
        <thead>
        <tr>
            <th class="manage-column column-cb check-column">
                <label class="screen-reader-text"
                       for="cb-select-all-1"><?php _e( 'Select All', ST_TEXTDOMAIN ) ?></label>
                <input type="checkbox" id="cb-select-all-1">
            </th>

            <th class="manage-column">
                <a href="#"><span><?php _e( 'Customer', ST_TEXTDOMAIN ) ?></span><span class="sorting-indicator"></span></a>
            </th>

            <th class="manage-column" width="10%">
                <a href="#"><span><?php _e( 'Execution Time', ST_TEXTDOMAIN ) ?></span><span class="sorting-indicator"></span></a>
            </th>
            <th class="manage-column">
                <a href="#"><span><?php _e( 'Flight Detail', ST_TEXTDOMAIN ) ?></span><span
                        class="sorting-indicator"></span></a>
            </th>
            <th class="manage-column" width="7%">
                <a href="#"><span><?php _e( 'Total Price', ST_TEXTDOMAIN ) ?></span><span
                        class="sorting-indicator"></span></a>
            </th>
            <th class="manage-column" width="10%">
                <a href="#"><span><?php _e( 'Created Date', ST_TEXTDOMAIN ) ?></span><span
                        class="sorting-indicator"></span></a>
            </th>
            <th class="manage-column " width="7%">
                <a href="#"><span><?php _e( 'Status', ST_TEXTDOMAIN ) ?></span><span
                        class="sorting-indicator"></span></a>
            </th>
            <th class="manage-column " width="10%">
                <a href="#"><span><?php _e( 'Payment Method', ST_TEXTDOMAIN ) ?></span><span
                        class="sorting-indicator"></span></a>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
            $i = 0;
            if ( !empty( $posts ) ) {
                foreach ( $posts as $key => $value ) {
                    //setup_postdata($value);
                    $i++;
                    $post_id  = $value->ID;
                    $item_id  = get_post_meta( $post_id, 'item_id', true );
                    $order_id = $post_id;
                    ?>
                    <tr class="<?php if ( $i % 2 == 0 ) echo 'alternate'; ?>">
                        <th scope="row" class="check-column">
                            <input id="cb-select-39" type="checkbox" name="post[]"
                                   value="<?php echo esc_attr( $post_id ) ?>">

                            <div class="locked-indicator"></div>
                        </th>

                        <td class="post-title page-title column-title">
                            <strong><a class="row-title"
                                       href="<?php echo admin_url( 'edit.php?post_type=st_flight&page=st_flight_booking&section=edit_order_item&order_item_id=' . $post_id ); ?>"
                                       title=""><?php
                                        $order = $post_id;
                                        if ( $order ) {
                                            $name = get_post_meta( $order, 'st_first_name', true );
                                            if ( !$name ) {
                                                $name = get_post_meta( $order, 'st_name', true );
                                            }
                                            if ( !$name ) {
                                                $name = get_post_meta( $order, 'st_email', true );
                                            }
                                            echo esc_html( $name );
                                        }

                                    ?></a></strong>

                            <div class="row-actions">
                                <a href="<?php echo admin_url( 'edit.php?post_type=st_flight&page=st_flight_booking&section=edit_order_item&order_item_id=' . $post_id ); ?>"><?php _e( 'Edit', ST_TEXTDOMAIN ) ?></a>
                                |
                                <a href="<?php echo admin_url( 'edit.php?post_type=st_flight&page=st_flight_booking&section=resend_email_flight&order_item_id=' . $post_id ); ?>"><?php _e( 'Resend Email', ST_TEXTDOMAIN ) ?></a>
                                <?php do_action('st_after_order_page_admin_information_table',$post_id) ?>
                            </div>
                        </td>
                        <?php
                        $flight_type = get_post_meta($order, 'flight_type', true);
                        ?>
                        <td class="post-title page-title column-title">
                            <?php
                            $depart_date = get_post_meta($order, 'depart_date', true);
                            ?>
                            <p class="depart_date"><?php echo esc_html__('Departure: ')?><?php echo date(get_option('date_format'), $depart_date)?></p>
                            <?php
                            if($flight_type == 'return'){
                                $return_date = get_post_meta($order, 'return_date', true);
                                ?>
                                <p class="depart_date"><?php echo esc_html__('Return: ')?><?php echo date(get_option('date_format'), $return_date)?></p>
                                <?php } ?>
                        </td>

                        <td class="post-title page-title column-title">
                            <?php
                            $depart_data_location = get_post_meta($order, 'depart_data_location', true);
                            echo '<p>'.$depart_data_location['origin_location_full'].' ('.$depart_data_location['origin_iata'].')'.' - '.$depart_data_location['destination_location_full'].' ('.$depart_data_location['destination_iata'].')</p>';
                            if($flight_type == 'return'){
                                echo '<span>('.esc_html__('Round Trip', ST_TEXTDOMAIN).')</span>';
                            }
                            ?>
                        </td>
                        <td class="post-title page-title column-title">
                            <?php
                                $price = get_post_meta( $post_id, 'total_price', true );

                                $currency = TravelHelper::_get_currency_book_history( $post_id );

                                echo TravelHelper::format_money_raw( $price, $currency );
                            ?>
                        </td>
                        <td class="post-title page-title column-title">
                            <?php echo date( get_option( 'date_format' ), strtotime( $value->post_date ) ) ?>
                        </td>
                        <td class="post-title page-title column-title">
                            <?php echo get_post_meta( $order_id, 'status', true ) ?>
                        </td>
                        <td class="post-title page-title column-title">
                            <?php
                            echo STPaymentGateways::get_gatewayname( get_post_meta( $order_id, 'payment_method', true ) );
                            do_action('st_traveler_after_name_payment_method',$post_id);
                            ?>
                        </td>

                    </tr>
                    <?php
                }
            }
        ?>
        </tbody>
    </table>
    <div class="tablenav bottom">
        <div class="tablenav-pages">
            <span
                class="displaying-num"><?php echo sprintf( _n( '%s item', '%s items', $data[ 'total' ] ), $data[ 'total' ], ST_TEXTDOMAIN ) ?></span>
            <?php echo paginate_links( $paging ) ?>

        </div>
    </div>

    <?php wp_reset_query(); ?>
</form>
</div>

