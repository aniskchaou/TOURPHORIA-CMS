<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 20-11-2018
     * Time: 8:08 AM
     * Since: 1.0.0
     * Updated: 1.0.0
     */
    while ( have_posts() ): the_post();
        $room_id  = get_the_ID();
        $hotel_id = get_post_meta( get_the_ID(), 'room_parent', true );
        if ( !$hotel_id ) {
            $hotel_id = $room_id;
        }
        $thumbnail = get_the_post_thumbnail_url( $room_id, 'full' );

        $start           = STInput::get( 'start', date( TravelHelper::getDateFormat() ) );
        $end             = STInput::get( 'end', date( TravelHelper::getDateFormat(), strtotime( "+ 1 day" ) ) );
        $date            = STInput::get( 'date', date( 'd/m/Y h:i a' ) . '-' . date( 'd/m/Y h:i a', strtotime( '+1 day' ) ) );
        $room_num_search = (int)STInput::get( 'room_num_search', 1 );
        if ( $room_num_search <= 0 ) $room_num_search = 1;
        $start       = TravelHelper::convertDateFormat( $start );
        $end         = TravelHelper::convertDateFormat( $end );
        $total_price = STPrice::getRoomPriceOnlyCustomPrice( $room_id, strtotime( $start ), strtotime( $end ), $room_num_search );
        $sale_price  = STPrice::getRoomPrice( $room_id, strtotime( $start ), strtotime( $end ), $room_num_search );

        $review_rate = STReview::get_avg_rate();

        $gallery       = get_post_meta( $room_id, 'gallery', true );
        $gallery_array = explode( ',', $gallery );

        $booking_period = 0;
        $location       = get_post_meta( $room_id, 'multi_location', true );
        if ( !empty( $location ) ) {
            $location = explode( ',', $location );
            if ( isset( $location[ 0 ] ) ) {
                $location = str_replace( '_', '', $location[ 0 ] );
            } else {
                $location = false;
            }
        }
        $address = get_post_meta($room_id, 'address', true);
        $marker_icon = st()->get_option('st_hotel_icon_map_marker', '');

        $room_external = get_post_meta(get_the_ID(), 'st_room_external_booking', true);
        $room_external_link = get_post_meta(get_the_ID(), 'st_room_external_booking_link', true);
        ?>
        <div id="st-content-wrapper">
            <?php st_breadcrumbs_new() ?>
            <?php if ( !empty( $gallery_array ) ) { ?>
                <div class="st-flickity st-gallery">
                    <div class="carousel"
                         data-flickity='{ "wrapAround": true, "pageDots": false }'>
                        <?php
                            foreach ( $gallery_array as $value ) {
                                ?>
                                <div class="item"
                                     style="background-image: url('<?php echo wp_get_attachment_image_url( $value, 'large' ) ?>')"></div>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="shares dropdown">
                        <a href="#" class="share-item social-share">
                            <?php echo TravelHelper::getNewIcon( 'ico_share', '', '20px', '20px' ) ?>
                        </a>
                        <ul class="share-wrapper">
                            <li><a class="facebook"
                                   href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>&amp;title=<?php the_title() ?>"
                                   target="_blank" rel="noopener" original-title="Facebook"><i
                                            class="fa fa-facebook fa-lg"></i></a></li>
                            <li><a class="twitter"
                                   href="https://twitter.com/share?url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>"
                                   target="_blank" rel="noopener" original-title="Twitter"><i
                                            class="fa fa-twitter fa-lg"></i></a></li>
                            <li><a class="google"
                                   href="https://plus.google.com/share?url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>"
                                   target="_blank" rel="noopener" original-title="Google+"><i
                                            class="fa fa-google-plus fa-lg"></i></a></li>
                            <li><a class="no-open pinterest"
                                   href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"
                                   target="_blank" rel="noopener" original-title="Pinterest"><i
                                            class="fa fa-pinterest fa-lg"></i></a></li>
                            <li><a class="linkedin"
                                   href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>"
                                   target="_blank" rel="noopener" original-title="LinkedIn"><i
                                            class="fa fa-linkedin fa-lg"></i></a></li>
                        </ul>
                        <?php echo st()->load_template('layouts/modern/hotel/loop/wishlist'); ?>
                    </div>
                </div>
            <?php } ?>
            <div class="st-hotel-room-content">
                <div class="hotel-target-book-mobile">
                    <div class="price-wrapper">
                        <?php echo wp_kses( sprintf( __( 'from <span class="price">%s</span>', ST_TEXTDOMAIN ), TravelHelper::format_money($sale_price) ), [ 'span' => [ 'class' => [] ] ] ) ?>
                    </div>
                    <?php
                    if($room_external == 'off' || empty($room_external)){
                        ?>
                        <a href=""
                           class="btn btn-mpopup btn-green"><?php echo esc_html__( 'Book Now', ST_TEXTDOMAIN ) ?></a>
                        <?php
                    }else{
                        ?>
                        <a href="<?php echo esc_url($room_external_link); ?>"
                           class="btn btn-green"><?php echo esc_html__( 'Book Now', ST_TEXTDOMAIN ) ?></a>
                        <?php
                    }
                    ?>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <div class="room-heading">
                                <div class="left">
                                    <div class="st-heading"><?php the_title(); ?></div>
                                </div>
                                <div class="right">
                                    <div class="review-score style-2">
                                        <?php echo st()->load_template( 'layouts/modern/common/star', '', [ 'star' => $review_rate, 'style' => 'style-2' ] ); ?>
                                        <p class="st-link mb0"><?php comments_number( __( 'from 0 review', ST_TEXTDOMAIN ), __( 'from 1 review', ST_TEXTDOMAIN ), __( 'from % reviews', ST_TEXTDOMAIN ) ); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="st-hr large"></div>
                            <div class="room-featured-items">
                                <div class="row">
                                    <div class="col-xs-6 col-md-3">
                                        <div class="item has-matchHeight">
                                            <?php echo TravelHelper::getNewIcon( 'ico_square_blue', '', '32px' ); ?>
                                            <?php echo sprintf( __( 'S: %s', ST_TEXTDOMAIN ), get_post_meta( $room_id, 'room_footage', true ) ) ?>m<sup>2</sup>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="item has-matchHeight">
                                            <?php echo TravelHelper::getNewIcon( 'ico_beds_blue', '', '32px' ); ?>
                                            <?php echo sprintf( __( 'Beds: %s', ST_TEXTDOMAIN ), get_post_meta( $room_id, 'bed_number', true ) ) ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="item has-matchHeight">
                                            <?php echo TravelHelper::getNewIcon( 'ico_adults_blue', '', '32px' ); ?>
                                            <?php echo sprintf( __( 'Adults: %s', ST_TEXTDOMAIN ), get_post_meta( $room_id, 'adult_number', true ) ) ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="item has-matchHeight">
                                            <?php echo TravelHelper::getNewIcon( 'ico_children_blue', '', '32px' ); ?>
                                            <?php echo sprintf( __( 'Children: %s', ST_TEXTDOMAIN ), get_post_meta( $room_id, 'children_number', true ) ) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="st-hr large"></div>
                            <h2 class="st-heading-section"><?php echo __( 'Description', ST_TEXTDOMAIN ) ?></h2>
                            <?php
                                global $post;
                                $content = $post->post_content;
                                $count   = str_word_count( $content );
                            ?>
                            <div class="st-description"
                                 data-toggle-section="st-description" <?php if ( $count >= 120 ) {
                                echo 'data-show-all="st-description"
                             data-height="120"';
                            } ?>>
                                <?php the_content(); ?>
                                <?php if ( $count >= 120 ) { ?>
                                    <div class="cut-gradient"></div>
                                <?php } ?>
                            </div>
                            <?php if ( $count >= 120 ) { ?>
                                <a href="#" class="st-link block" data-show-target="st-description"
                                   data-text-less="<?php echo esc_html__( 'View Less', ST_TEXTDOMAIN ) ?>"
                                   data-text-more="<?php echo esc_html__( 'View More', ST_TEXTDOMAIN ) ?>"><span
                                            class="text"><?php echo esc_html__( 'View More', ST_TEXTDOMAIN ) ?></span><i
                                            class="fa fa-caret-down ml3"></i></a>
                            <?php } ?>
                            <div class="st-hr large"></div>
                            <h2 class="st-heading-section"><?php echo __( 'Amenities', ST_TEXTDOMAIN ) ?></h2>
                            <?php
                                $facilities = get_the_terms( get_the_ID(), 'room_facilities');
                                if ( $facilities ) {
                                    $count = count( $facilities );
                                    ?>
                                    <div class="facilities" data-toggle-section="st-facilities"
                                        <?php if ( $count > 6 ) echo 'data-show-all="st-facilities"
                                     data-height="150"'; ?>>
                                        <div class="row">
                                            <?php
                                                foreach ( $facilities as $term ) {
                                                    $icon     = TravelHelper::handle_icon( get_tax_meta( $term->term_id, 'st_icon', true ) );
                                                    $icon_new = TravelHelper::handle_icon( get_tax_meta( $term->term_id, 'st_icon_new', true ) );
                                                    if ( !$icon ) $icon = "fa fa-cogs";
                                                    ?>
                                                    <div class="col-xs-6 col-sm-4">
                                                        <div class="item has-matchHeight">
                                                            <?php
                                                                if ( !$icon_new ) {
                                                                    echo '<i class="' . $icon . '"></i>' . $term->name;
                                                                } else {
                                                                    echo TravelHelper::getNewIcon( $icon_new, '#5E6D77', '24px', '24px' ) . $term->name;
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <?php if ( $count > 6 ) { ?>
                                        <a href="#" class="st-link block" data-show-target="st-facilities"
                                           data-text-less="<?php echo esc_html__( 'Show Less', ST_TEXTDOMAIN ) ?>"
                                           data-text-more="<?php echo esc_html__( 'Show All', ST_TEXTDOMAIN ) ?>"><span
                                                    class="text"><?php echo esc_html__( 'Show All', ST_TEXTDOMAIN ) ?></span>
                                            <i
                                                    class="fa fa-caret-down ml3"></i></a>
                                        <?php
                                    }
                                }
                            ?>
                            <div class="st-hr large"></div>
                            <div class="st-flex space-between">
                                <h2 class="st-heading-section mg0"><?php echo __( 'Availability', ST_TEXTDOMAIN ) ?></h2>
                                <ul class="st-list st-list-availability">
                                    <li>
                                        <span class="not_available"></span><?php echo esc_html__( 'Not Available', ST_TEXTDOMAIN ) ?>
                                    </li>
                                    <li>
                                        <span class="available"></span><?php echo esc_html__( 'Available', ST_TEXTDOMAIN ) ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="st-house-availability st-availability">
                                <div class="st-calendar clearfix">
                                    <input type="text" class="calendar_input"
                                           data-minimum-day="<?php echo esc_attr( $booking_period ); ?>"
                                           data-room-id="<?php echo $room_id ?>"
                                           data-action="st_get_availability_hotel_room"
                                           value="" name="calendar_input">
                                </div>
                            </div>
                            <div class="st-hr large"></div>
                            <?php
                                if ( $location ) {
                                    $lat  = get_post_meta( $location, 'map_lat', true );
                                    $lng  = get_post_meta( $location, 'map_lng', true );
                                    $zoom = get_post_meta( $location, 'map_zoom_location', true );
                                    if(!$zoom){
                                        $zoom = 13;
                                    }
                                    ?>
                                    <div class="st-flex space-between">
                                        <h2 class="st-heading-section mg0"><?php echo __( 'Map', ST_TEXTDOMAIN ) ?></h2>
                                        <?php if($address){
                                            ?>
                                            <div class="c-grey"><?php
                                                    echo TravelHelper::getNewIcon( 'Ico_maps', '#5E6D77', '18px', '18px' );
                                                    echo esc_html($address); ?></div>
                                            <?php
                                        } ?>
                                    </div>
                                    <div class="st-map mt30">
                                        <div class="google-map" data-lat="<?php echo trim( $lat ) ?>"
                                             data-lng="<?php echo trim( $lng ) ?>"
                                             data-icon="<?php echo esc_url($marker_icon); ?>"
                                             data-zoom="<?php echo (int)$zoom; ?>" data-disablecontrol="true"
                                             data-showcustomcontrol="true"
                                             data-style="normal"></div>
                                    </div>
                                <?php } ?>
                            <div class="st-hr"></div>
                            <div class="st-flex space-between">
                                <h2 class="st-heading-section mg0"><?php echo esc_html__( 'Review', ST_TEXTDOMAIN ); ?></h2>
                                <div class="f18 font-medium15">
                                    <span class="mr15"><?php comments_number( __( '0 review', ST_TEXTDOMAIN ), __( '1 review', ST_TEXTDOMAIN ), __( '% reviews', ST_TEXTDOMAIN ) ); ?></span>
                                    <?php echo st()->load_template( 'layouts/modern/common/star', '', [ 'star' => $review_rate, 'style' => 'style-2', 'element' => 'span' ] ); ?>
                                </div>
                            </div>
                            <div id="reviews" class="hotel-room-review stoped-scroll-section">
                                <div class="review-pagination">
                                    <div id="reviews" class="review-list">
                                        <?php
                                            $comments_count   = wp_count_comments( get_the_ID() );
                                            $total            = (int)$comments_count->approved;
                                            $comment_per_page = (int)get_option( 'comments_per_page', 10 );
                                            $paged            = (int)STInput::get( 'comment_page', 1 );
                                            $from             = $comment_per_page * ( $paged - 1 ) + 1;
                                            $to               = ( $paged * $comment_per_page < $total ) ? ( $paged * $comment_per_page ) : $total;
                                        ?>
                                        <?php
                                            $offset         = ( $paged - 1 ) * $comment_per_page;
                                            $args           = [
                                                'number'  => $comment_per_page,
                                                'offset'  => $offset,
                                                'post_id' => get_the_ID(),
                                                'status' => ['approve']
                                            ];
                                            $comments_query = new WP_Comment_Query;
                                            $comments       = $comments_query->query( $args );

                                            if ( $comments ):
                                                foreach ( $comments as $key => $comment ):
                                                    echo st()->load_template( 'layouts/modern/common/reviews/review', 'list', [ 'comment' => (object)$comment ] );
                                                endforeach;
                                            endif;
                                        ?>
                                    </div>
                                </div>
                                <?php TravelHelper::pagination_comment( [ 'total' => $total ] ) ?>
                                <?php
                                    if ( comments_open( $room_id ) ) {
                                        ?>
                                        <div id="write-review">
                                            <h4 class="heading">
                                                <a href="" class="toggle-section c-main f16" data-target="st-review-form"><?php echo __( 'Write a review', ST_TEXTDOMAIN ) ?><i class="fa fa-angle-down ml5"></i></a>
                                            </h4>
                                            <?php
                                                TravelHelper::comment_form();
                                            ?>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="widgets">
                                <div class="fixed-on-mobile" data-screen="992px">
                                    <div class="close-icon hide">
                                        <?php echo TravelHelper::getNewIcon( 'Ico_close' ); ?>
                                    </div>
                                    <div class="form-book-wrapper">
                                        <?php echo st()->load_template( 'layouts/modern/common/loader' ); ?>
                                        <div class="form-head">
                                            <?php echo wp_kses( sprintf( __( 'from <span class="price">%s</span> per night', ST_TEXTDOMAIN ), TravelHelper::format_money($sale_price) ), [ 'span' => [ 'class' => [] ] ] ) ?>
                                        </div>
                                        <?php if(empty($room_external) || $room_external == 'off'){ ?>
                                            <form id="form-booking-inpage single-room-form" class="form single-room-form" method="post">
                                                <input name="action" value="hotel_add_to_cart" type="hidden">
                                                <input name="item_id" value="<?php echo $hotel_id; ?>" type="hidden">
                                                <input name="room_id" value="<?php echo $room_id; ?>" type="hidden">
                                                <?php wp_nonce_field( 'room_search', 'room_search' ) ?>
                                                <?php
                                                    $start    = STInput::get( 'start', date( TravelHelper::getDateFormat() ) );
                                                    $end      = STInput::get( 'end', date( TravelHelper::getDateFormat(), strtotime( "+ 1 day" ) ) );
                                                    $date     = STInput::get( 'date', date( 'd/m/Y h:i a' ) . '-' . date( 'd/m/Y h:i a', strtotime( '+1 day' ) ) );
                                                    $has_icon = ( isset( $has_icon ) ) ? $has_icon : false;
                                                ?>
                                                <div class="form-group form-date-field form-date-hotel-room clearfix <?php if ( $has_icon ) echo ' has-icon '; ?>"
                                                     data-format="<?php echo TravelHelper::getDateFormatMoment() ?>">
                                                    <?php
                                                        if ( $has_icon ) {
                                                            echo '<i class="field-icon fa fa-calendar"></i>';
                                                        }
                                                    ?>
                                                    <div class="date-wrapper clearfix">
                                                        <div class="check-in-wrapper">
                                                            <label><?php echo __( 'Check In - Out', ST_TEXTDOMAIN ); ?></label>
                                                            <div class="render check-in-render"><?php echo $start; ?></div> - <div class="render check-out-render"><?php echo $end; ?></div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" class="check-in-input"
                                                           value="<?php echo esc_attr( $start ) ?>" name="check_in">
                                                    <input type="hidden" class="check-out-input"
                                                           value="<?php echo esc_attr( $end ) ?>" name="check_out">
                                                    <input type="text" class="check-in-out"
                                                           data-minimum-day="<?php echo esc_attr( $booking_period ); ?>"
                                                           data-room-id="<?php echo $room_id ?>"
                                                           data-action="st_get_availability_hotel_room"
                                                           value="<?php echo esc_attr( $date ); ?>" name="date">
                                                </div>
                                                <?php echo st()->load_template( 'layouts/modern/hotel/elements/search/guest', '' ); ?>
                                                <?php echo st()->load_template( 'layouts/modern/hotel/elements/search/extra', '' ); ?>
                                                <div class="submit-group">
                                                    <input class="btn btn-green btn-large btn-full upper font-medium btn_hotel_booking"
                                                           type="submit"
                                                           name="submit"
                                                           value="<?php echo __( 'Book Now', ST_TEXTDOMAIN ) ?>">
                                                </div>
                                                <div class="mt30 message-wrapper">
                                                    <?php echo STTemplate::message() ?>
                                                </div>
                                            </form>
                                        <?php }else{ ?>
                                            <div class="submit-group mb30">
                                                <a href="<?php echo esc_url($room_external_link); ?>" class="btn btn-green btn-large btn-full upper"><?php echo esc_html__( 'Book Now', ST_TEXTDOMAIN ); ?></a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endwhile;
