<?php
    $logo_light               = st()->get_option( 'hotel_alone_logo' );
    $st_topbar_location       = st()->get_option( 'st_hotel_alone_topbar_location' );
    $st_topbar_contact_number = st()->get_option( 'st_hotel_alone_topbar_contact_number' );
    $st_topbar_email_address  = st()->get_option( 'st_hotel_alone_topbar_email_address' );
    /**
     * Custom Meta Page
     */
    if ( is_archive() || is_search() ) {

    } else {
        $custom_header_page = get_post_meta( get_the_ID(), 'custom_header_page', true );
        if ( $custom_header_page == 'on' ) {
            $st_topbar_location       = get_post_meta( get_the_ID(), 'st_topbar_location', true );
            $st_topbar_contact_number = get_post_meta( get_the_ID(), 'st_topbar_contact_number', true );
            $st_topbar_email_address  = get_post_meta( get_the_ID(), 'st_topbar_email_address', true );
        }
        $custom_logo = get_post_meta( get_the_ID(), 'custom_logo', true );
        if ( $custom_logo == 'on' ) {
            $logo_light = get_post_meta( get_the_ID(), 'logo_light', true );
        }
    }
?>

<div class="topbar-content top-bar-style-2" data-offset="0">
    <div class="background-scroll"></div>
    <div class="control-left">
        <div class="option-item">
            <div class="option-mid">
                <?php
                    if ( !empty( $st_topbar_contact_number ) ) {
                        ?>
                        <span class="phone">
                       <?php echo esc_html( $st_topbar_contact_number ) ?>
                    </span>
                    <?php } ?>
                <?php
                    if ( !empty( $st_topbar_email_address ) ) {
                        ?>
                        <span class="email">
                       <?php echo esc_html( $st_topbar_email_address ) ?>
                    </span>
                    <?php } ?>
            </div>
        </div>
        <div class="option-item">
            <div class="option-mid">
                <?php echo st_hotel_alone_load_view('header/top-bar/nav-item-topbar/language', false); ?>
            </div>
        </div>
    </div>
    <div class="control-right">
        <div class="option-item">
            <div class="option-mid">
                <?php echo st_hotel_alone_load_view('header/top-bar/nav-item-topbar/weather', '2', array('st_topbar_location' => $st_topbar_location)); ?>
            </div>
        </div>
        <div class="option-item">
            <div class="option-mid room_book">
                <div class="content_room_book">
                    <p><?php esc_html_e( "Book", ST_TEXTDOMAIN ) ?></p>
                    <p><?php esc_html_e( "Room", ST_TEXTDOMAIN ) ?></p>
                    <i class="icon-room-book"></i>
                </div>
            </div>
            <div class="form-search-position-right">
                <div class="form-search-content">
                    <div class="form-search-content-mid">
                        <?php echo st_hotel_alone_load_view( 'header/top-bar/nav-item-topbar/form-book', false, [ 'picker_style' => 'fixed' ] ) ?>
                        <div class="info-form-book">
                            <div class="title">
                                <?php echo st()->get_option( 'st_hotel_alone_topbar_desc_search_form' ); ?>
                            </div>
                            <?php if ( !empty( $st_topbar_contact_number ) ) { ?>
                                <div class="phone">
                                    <i class="fa fa-phone"></i>
                                    <?php echo esc_html( $st_topbar_contact_number ) ?>
                                </div>
                            <?php } ?>
                            <?php if ( !empty( $st_topbar_email_address ) ) { ?>
                                <div class="email">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    <?php echo esc_html( $st_topbar_email_address ) ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="background_booking">
                            <?php esc_html_e( "Booking", ST_TEXTDOMAIN ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="option-item">
            <div class="option-mid">
                <?php echo st_hotel_alone_load_view('header/top-bar/nav-item-topbar/account', false); ?>
            </div>
        </div>
    </div>
</div>