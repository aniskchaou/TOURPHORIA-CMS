<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Single room
     *
     * Created by ShineTheme
     *
     */

    if(New_Layout_Helper::isRoomAloneLayout()){
        echo st()->load_template('layouts/modern/single_hotel/single-room');
        return;
    }

    $new_layout = st()->get_option( 'st_theme_style', 'classic' );
    if ( $new_layout == 'modern' ) {
        get_header();
        $room_id  = get_the_ID();
        $hotel_id = get_post_meta( $room_id, 'room_parent', true );
        if ( !$hotel_id ) {
            $style = get_post_meta( get_the_ID(), 'st_custom_layout_alone', true );
            if ( !$style or !in_array($style, array('1', '2'))) {
                $style = st()->get_option('hotel_single_room_layout_v2', 1);
            }
            echo st()->load_template( 'layouts/modern/hotel/single/single-house', $style );
        } else {
            $style = get_post_meta( get_the_ID(), 'st_custom_layout', true );
            if ( !$style or !in_array($style, array('1', '2'))) {
                $style = st()->get_option('hotel_single_room_layout_v2', 1);
            }
            echo st()->load_template( 'layouts/modern/hotel/single/single-room', $style );
        }
        get_footer();

        return;
    }

    $is_hotel_alone = get_post_meta( get_the_ID(), 'hotel_alone_room_layout', true );
    if ( $is_hotel_alone == 'on' )
        get_header( "hotel-alone" );
    else
        get_header();
?>

<?php
    $layout = st()->get_option( 'hotel_single_room_layout', '' );
    if ( $is_hotel_alone == 'on' ) {
        if ( get_post_meta( get_the_ID(), 'st_custom_layout_hotel_alone_room', true ) ) $layout = get_post_meta( get_the_ID(), 'st_custom_layout_hotel_alone_room', true );
        echo st_hotel_alone_load_view( '/single-room/single', false, [ 'layout' => $layout ] );
    } else {
        if ( get_post_meta( get_the_ID(), 'st_custom_layout', true ) ) $layout = get_post_meta( get_the_ID(), 'st_custom_layout', true );

        if ( get_post_meta( $layout, 'is_breadcrumb', true ) !== 'off' ) {
            get_template_part( 'breadcrumb' );
        }
        ?>
        <?php
        while ( have_posts() ) : the_post();

            $gallery       = get_post_meta( get_the_ID(), 'gallery', true );
            $gallery_array = explode( ',', $gallery );
            $fancy_arr     = [];
            if ( is_array( $gallery_array ) and !empty( $gallery_array ) ) {
                foreach ( $gallery_array as $key => $value ) {
                    $img_link    = wp_get_attachment_image_src( $value, [ 800, 600, 'bfi_thumb' => true ] );
                    $fancy_arr[] = [
                        'href'  => $img_link[ 0 ],
                        'title' => ''
                    ];
                }
            }

            ?>
            <div id="single-room" class="booking-item-details">
                <div class="thumb">
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail( [ 1600, 500 ], [ 'class' => 'fancy-responsive' ], [ 'alt' => TravelHelper::get_alt_image( get_post_thumbnail_id( get_the_ID() ) ) ] );
                    } else {
                        echo "<img src='" . get_template_directory_uri() . '/img/default/1600x500.png' . "' class='fancy-responsive' alt='" . get_the_title() . "'>";
                    } ?>
                </div>
                <div class="container">
                    <?php
                        if ( $layout && !empty( $layout ) ) {
                            echo STTemplate::get_vc_pagecontent( $layout );
                        } else {
                            echo do_shortcode( '[vc_row][vc_column width="2/3"][st_hotel_room_header][st_hotel_room_gallery style="slide"][st_hotel_room_description title="Description"][st_hotel_room_space][st_hotel_room_amenities][vc_column_text]
Room Reviews

[/vc_column_text][st_hotel_room_review][/vc_column][vc_column width="1/3"][st_hotel_room_sidebar][/vc_column][/vc_row]' );
                        }
                    ?>
                </div>
            </div>
            <span class="hidden st_single_hotel_room"
                  data-fancy_arr='<?php echo( is_array( $fancy_arr ) and count( $fancy_arr ) ); ?>'></span>
        <?php
        endwhile;
        wp_reset_query();
    }
?>
<?php
    if ( $is_hotel_alone == 'on' )
        get_footer( "hotel-alone" );
    else
        get_footer();
?>
