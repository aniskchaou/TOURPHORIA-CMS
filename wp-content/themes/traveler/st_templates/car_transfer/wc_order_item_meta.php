<?php
    /**
     * Created by PhpStorm.
     * User: MSI
     * Date: 14/07/2015
     * Time: 3:17 CH
     */
    $item_data = isset( $item[ 'item_meta' ] ) ? $item[ 'item_meta' ] : [];
?>
<ul class="wc-order-item-meta-list">

    <?php if ( isset( $item_data[ '_st_pick_up' ] ) and $item_data[ '_st_pick_up' ] ) { ?>
        <li>
            <span class="meta-label"><?php _e( 'Pick-up:', ST_TEXTDOMAIN ) ?></span>
            <span class="meta-data"><?php
                    if ( $item_data[ '_st_pick_up' ] ) {
                        echo esc_html($item_data[ '_st_pick_up' ]);
                    }

                ?></span>
        </li>
        <?php

    } ?>

    <?php if ( isset( $item_data[ '_st_drop_off' ] ) and $item_data[ '_st_drop_off' ] ) { ?>
        <li>
            <span class="meta-label"><?php _e( 'Drop-off:', ST_TEXTDOMAIN ) ?></span>
            <span class="meta-data"><?php
                    if ( $item_data[ '_st_drop_off' ] ) {
                        echo esc_html($item_data[ '_st_drop_off' ]);
                    }
                ?>
        </span>
        </li>
        <?php

    } ?>

    <?php if ( isset( $item_data[ '_st_check_in_timestamp' ] ) ): ?>
        <li>
            <span class="meta-label"><?php _e( 'Date:', ST_TEXTDOMAIN ) ?></span>
            <span
                class="meta-data"><?php echo date_i18n( TravelHelper::getDateFormat() . ' ' . get_option( 'time_format' ), $item_data[ '_st_check_in_timestamp' ] ) ?>
                <?php if ( isset( $item_data[ '_st_check_out_timestamp' ] ) ) { ?>
                    <i class="fa fa-long-arrow-right"></i>
                    <?php echo date_i18n( TravelHelper::getDateFormat() . ' ' . get_option( 'time_format' ), $item_data[ '_st_check_out_timestamp' ] ) ?>
                <?php } ?>
        </span>
        </li>
    <?php endif; ?>
    <?php
        if ( isset( $item_data[ '_st_distance' ] ) ): ?>
            <li>
                <span class="meta-label"><?php _e( 'Distance:', ST_TEXTDOMAIN ) ?></span>
                <span
                    class="meta-data">
            <?php
                $time   = $item_data[ '_st_distance' ];
                $hour   = ( $time[ 'hour' ] >= 2 ) ? $time[ 'hour' ] . ' ' . esc_html__( 'hours', ST_TEXTDOMAIN ) : $time[ 'hour' ] . ' ' . esc_html__( 'hour', ST_TEXTDOMAIN );
                $minute = ( $time[ 'minute' ] >= 2 ) ? $time[ 'minute' ] . ' ' . esc_html__( 'minutes', ST_TEXTDOMAIN ) : $time[ 'minute' ] . ' ' . esc_html__( 'minute', ST_TEXTDOMAIN );
                echo esc_attr( $hour ) . ' ' . esc_attr( $minute ) . ' - ' . $time[ 'distance' ] . __( 'Km', ST_TEXTDOMAIN );
            ?>
        </span>
            </li>
        <?php endif; ?>
</ul>