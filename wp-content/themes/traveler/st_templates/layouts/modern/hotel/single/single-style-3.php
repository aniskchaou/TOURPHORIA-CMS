<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 16-11-2018
     * Time: 8:47 AM
     * Since: 1.0.0
     * Updated: 1.0.0
     */
    while ( have_posts() ): the_post();
        $price       = STHotel::get_price();
        $post_id     = get_the_ID();
        $hotel_star  = (int)get_post_meta( $post_id, 'hotel_star', true );
        $address     = get_post_meta( $post_id, 'address', true );
        $review_rate = STReview::get_avg_rate();
        $count_review = get_comment_count($post_id)['approved'];
        $lat         = get_post_meta( $post_id, 'map_lat', true );
        $lng         = get_post_meta( $post_id, 'map_lng', true );
        $zoom        = get_post_meta( $post_id, 'map_zoom', true );

        $gallery       = get_post_meta( $post_id, 'gallery', true );
        $gallery_array = explode( ',', $gallery );
        $marker_icon = st()->get_option('st_hotel_icon_map_marker', '');
        ?>
        <div id="st-content-wrapper">
            <?php st_breadcrumbs_new() ?>
            <div class="st-hotel-map-area clearfix">
                <?php
                    if ( !empty( $gallery_array ) ) { ?>
                        <div class="st-gallery" data-nav="false" data-width="100%"
                             data-allowfullscreen="true">
                            <div class="fotorama" data-auto="false">
                                <?php
                                    foreach ( $gallery_array as $value ) {
                                        ?>
                                        <img src="<?php echo wp_get_attachment_image_url( $value, [ 1108, 600 ] ) ?>">
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
                        <?php
                    }
                ?>
                <div class="st-map hidden-xs hidden-sm">
                    <div class="google-map" data-lat="<?php echo trim( $lat ) ?>"
                         data-lng="<?php echo trim( $lng ) ?>"
                         data-icon="<?php echo esc_url($marker_icon); ?>"
                         data-zoom="<?php echo (int)$zoom; ?>" data-disablecontrol="true"
                         data-showcustomcontrol="true"></div>
                </div>
            </div>
            <div class="container">
                <div class="st-hotel-content">
                    <div class="row">
                        <div class="col-xs-12 col-md-9 ">
                            <div class="st-hotel-header">
                                <div class="left">
                                    <?php echo st()->load_template( 'layouts/modern/common/star', '', [ 'star' => $hotel_star ] ); ?>
                                    <h2 class="st-heading"><?php the_title(); ?></h2>
                                    <div class="sub-heading">
                                        <?php if ( $address ) {
                                            echo TravelHelper::getNewIcon( 'ico_maps_add_2', '#5E6D77', '16px', '16px' );
                                            echo esc_html( $address );
                                        }
                                        ?>
                                        <a href="" class="st-link font-medium hidden-md hidden-lg" data-toggle="modal"
                                           data-target="#st-modal-show-map"> <?php echo esc_html__( 'View on map', ST_TEXTDOMAIN ) ?></a>
                                        <div class="modal fade modal-map" id="st-modal-show-map" tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <?php echo TravelHelper::getNewIcon( 'Ico_close' ); ?></button>
                                                        <h4 class="modal-title"><?php the_title(); ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="st-map">
                                                            <div class="google-map" data-lat="<?php echo trim( $lat ) ?>"
                                                                 data-lng="<?php echo trim( $lng ) ?>"
                                                                 data-icon="<?php echo get_template_directory_uri() ?>/v2/images/markers/hotel_marker.png"
                                                                 data-zoom="<?php echo (int)$zoom; ?>" data-disablecontrol="true"
                                                                 data-showcustomcontrol="true"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="review-score">
                                        <div class="head clearfix">
                                            <div class="left">
                                                <span class="head-rating"><?php echo TravelHelper::get_rate_review_text( $review_rate, $count_review ); ?></span>
                                                <span class="text-rating"><?php comments_number( __( 'from 0 review', ST_TEXTDOMAIN ), __( 'from 1 review', ST_TEXTDOMAIN ), __( 'from % reviews', ST_TEXTDOMAIN ) ); ?></span>
                                            </div>
                                            <div class="score">
                                                <?php echo esc_html( $review_rate ); ?><span>/5</span>
                                            </div>
                                        </div>
                                        <div class="foot">
                                            <?php echo esc_html__( '100% of guests recommend', ST_TRAVELER_DIR ) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="st-tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#description-tab"
                                                                              aria-controls="description-tab" role="tab"
                                                                              data-toggle="tab"><?php echo __( 'Description', ST_TEXTDOMAIN ) ?></a>
                                    </li>
                                    <li role="presentation"><a href="#facilities-tab" aria-controls="facilities-tab"
                                                               role="tab"
                                                               data-toggle="tab"><?php echo __( 'Facilities', ST_TEXTDOMAIN ) ?></a>
                                    </li>
                                    <li role="presentation"><a href="#rules-tab" aria-controls="rules-tab" role="tab"
                                                               data-toggle="tab"><?php echo __( 'Rules', ST_TEXTDOMAIN ) ?></a>
                                    </li>
                                    <li role="presentation"><a href="#reviews-tab" aria-controls="reviews-tab"
                                                               role="tab"
                                                               data-toggle="tab"><?php echo __( 'Reviews', ST_TEXTDOMAIN ) ?></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="description-tab">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-3 col-sm-push-9 col-md-4 col-md-push-8 hotel-logo">
                                                <?php
                                                    $logo = get_post_meta( get_the_ID(), 'logo', true );
                                                    if ( $logo ) {
                                                        echo '<img src="' . esc_url( $logo ) . '" class="img-responsivve">';
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-xs-12 col-sm-9 col-sm-pull-3 col-md-8 col-md-pull-4">
                                                <?php
                                                    global $post;
                                                    $content = $post->post_content;
                                                    $count   = str_word_count( $content );
                                                ?>
                                                <div class="st-description" data-toggle-section="st-description" <?php if ( $count >= 120 ) {
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
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="facilities-tab">
                                        <?php
                                            $facilities = get_the_terms( $post_id, 'hotel_facilities');
                                            if ( $facilities ) {
                                                $count = count( $facilities );
                                                ?>
                                                <div class="facilities" data-toggle-section="st-facilities"
                                                    <?php if ( $count > 6 ) echo 'data-show-all="st-facilities" data-height="150"'; ?>>
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
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="rules-tab">
                                        <table class="table st-properties" data-toggle-section="st-properties">
                                            <tr>
                                                <th><?php echo esc_html__( 'Check In', ST_TEXTDOMAIN ) ?></th>
                                                <td>
                                                    <?php echo get_post_meta( $post_id, 'check_in_time', true ); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><?php echo esc_html__( 'Check Out', ST_TEXTDOMAIN ) ?></th>
                                                <td>
                                                    <?php echo get_post_meta( $post_id, 'check_out_time', true ); ?>
                                                </td>
                                            </tr>
                                            <?php
                                                $policies = get_post_meta( $post_id, 'hotel_policy', true );
                                                if ( $policies ) {
                                                    ?>
                                                    <tr>
                                                        <th><?php echo esc_html__( 'Hotel Policies', ST_TEXTDOMAIN ) ?></th>
                                                        <td>
                                                            <?php
                                                                foreach ( $policies as $policy ) {
                                                                    ?>
                                                                    <h4 class="f18"><?php echo esc_html( $policy[ 'title' ] ); ?></h4>
                                                                    <div><?php echo balanceTags( $policy[ 'policy_description' ] ) ?></div>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="reviews-tab">
                                        <div id="reviews">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="review-box has-matchHeight">
                                                        <h2 class="heading"><?php echo __( 'Review score', ST_TEXTDOMAIN ) ?></h2>
                                                        <div class="review-box-score">
                                                            <?php
                                                                $avg = STReview::get_avg_rate();
                                                            ?>
                                                            <div class="review-score">
                                                                <?php echo esc_attr( $avg ); ?><span class="per-total">/5</span>
                                                            </div>
                                                            <div class="review-score-text"><?php echo TravelHelper::get_rate_review_text( $avg, $count_review ); ?></div>
                                                            <div class="review-score-base">
                                                                <?php echo __( 'Based on', ST_TEXTDOMAIN ) ?>
                                                                <span><?php comments_number( __( '0 review', ST_TEXTDOMAIN ), __( '1 review', ST_TEXTDOMAIN ), __( '% reviews', ST_TEXTDOMAIN ) ); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="review-box has-matchHeight">
                                                        <h2 class="heading"><?php echo __( 'Traveler rating', ST_TEXTDOMAIN ) ?></h2>
                                                        <?php $total = get_comments_number(); ?>
                                                        <?php $rate_exe = STReview::count_review_by_rate( null, 5 ); ?>
                                                        <div class="item">
                                                            <div class="progress">
                                                                <div class="percent green"
                                                                     style="width: <?php echo TravelHelper::cal_rate( $rate_exe, $total ) ?>%;"></div>
                                                            </div>
                                                            <div class="label">
                                                                <?php echo esc_html__( 'Excellent', ST_TEXTDOMAIN ) ?>
                                                                <div class="number"><?php echo esc_html($rate_exe); ?></div>
                                                            </div>
                                                        </div>
                                                        <?php $rate_good = STReview::count_review_by_rate( null, 4 ); ?>
                                                        <div class="item">
                                                            <div class="progress">
                                                                <div class="percent darkgreen"
                                                                     style="width: <?php echo TravelHelper::cal_rate( $rate_good, $total ) ?>%;"></div>
                                                            </div>
                                                            <div class="label">
                                                                <?php echo __( 'Very Good', ST_TEXTDOMAIN ) ?>
                                                                <div class="number"><?php echo esc_html($rate_good); ?></div>
                                                            </div>
                                                        </div>
                                                        <?php $rate_avg = STReview::count_review_by_rate( null, 3 ); ?>
                                                        <div class="item">
                                                            <div class="progress">
                                                                <div class="percent yellow"
                                                                     style="width: <?php echo TravelHelper::cal_rate( $rate_avg, $total ) ?>%;"></div>
                                                            </div>
                                                            <div class="label">
                                                                <?php echo __( 'Average', ST_TEXTDOMAIN ) ?>
                                                                <div class="number"><?php echo esc_html($rate_avg); ?></div>
                                                            </div>
                                                        </div>
                                                        <?php $rate_poor = STReview::count_review_by_rate( null, 2 ); ?>
                                                        <div class="item">
                                                            <div class="progress">
                                                                <div class="percent orange"
                                                                     style="width: <?php echo TravelHelper::cal_rate( $rate_poor, $total ) ?>%;"></div>
                                                            </div>
                                                            <div class="label">
                                                                <?php echo __( 'Poor', ST_TEXTDOMAIN ) ?>
                                                                <div class="number"><?php echo esc_html($rate_poor); ?></div>
                                                            </div>
                                                        </div>
                                                        <?php $rate_terible = STReview::count_review_by_rate( null, 1 ); ?>
                                                        <div class="item">
                                                            <div class="progress">
                                                                <div class="percent red"
                                                                     style="width: <?php echo TravelHelper::cal_rate( $rate_terible, $total ) ?>%;"></div>
                                                            </div>
                                                            <div class="label">
                                                                <?php echo __( 'Terrible', ST_TEXTDOMAIN ) ?>
                                                                <div class="number"><?php echo esc_html($rate_terible); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="review-box has-matchHeight">
                                                        <h2 class="heading"><?php echo __( 'Summary', ST_TEXTDOMAIN ) ?></h2>
                                                        <?php
                                                            $stats = STReview::get_review_summary();
                                                            if ( $stats ) {
                                                                foreach ( $stats as $stat ) {
                                                                    ?>
                                                                    <div class="item">
                                                                        <div class="progress">
                                                                            <div class="percent"
                                                                                 style="width: <?php echo esc_attr($stat[ 'percent' ]); ?>%;"></div>
                                                                        </div>
                                                                        <div class="label">
                                                                            <?php echo esc_html($stat[ 'name' ]); ?>
                                                                            <div class="number"><?php echo esc_html($stat[ 'summary' ]) ?>
                                                                                /5
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-pagination">
                                                <div class="summary">
                                                    <?php
                                                        $comments_count   = wp_count_comments( get_the_ID() );
                                                        $total            = (int)$comments_count->approved;
                                                        $comment_per_page = (int)get_option( 'comments_per_page', 10 );
                                                        $paged            = (int)STInput::get( 'comment_page', 1 );
                                                        $from             = $comment_per_page * ( $paged - 1 ) + 1;
                                                        $to               = ( $paged * $comment_per_page < $total ) ? ( $paged * $comment_per_page ) : $total;
                                                    ?>
                                                    <?php comments_number( __( '0 review on this Hotel', ST_TEXTDOMAIN ), __( '1 review on this Hotel', ST_TEXTDOMAIN ), __( '% reviews on this Hotel', ST_TEXTDOMAIN ) ); ?>
                                                    - <?php echo sprintf( __( 'Showing %s to %s', ST_TEXTDOMAIN ), $from, $to ) ?>
                                                </div>
                                                <div id="reviews" class="review-list">
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
                                                if ( comments_open( $post_id ) ) {
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
                                </div>
                            </div>
                            <div class="form-book-wrapper relative inline">
                                <?php echo st()->load_template( 'layouts/modern/common/loader' ); ?>
                                <form class="form form-check-availability-hotel clearfix">
                                    <input type="hidden" name="action" value="ajax_search_room">
                                    <input type="hidden" name="room_search" value="1">
                                    <input type="hidden" name="is_search_room" value="1">
                                    <input type="hidden" name="room_parent"
                                           value="<?php echo esc_attr( get_the_ID() ); ?>">
                                    <?php echo st()->load_template( 'layouts/modern/hotel/elements/search/date', '' ); ?>
                                    <?php echo st()->load_template( 'layouts/modern/hotel/elements/search/guest', '' ); ?>
                                    <div class="form-group submit-group">
                                        <input class="btn btn-green btn-large btn-full upper font-medium" type="submit"
                                               name="submit"
                                               value="<?php echo esc_html__( 'Check Availability', ST_TEXTDOMAIN ) ?>">
                                    </div>
                                </form>
                            </div>
                            <h2 class="st-heading-section"><?php echo esc_html__( 'Rooms', ST_TEXTDOMAIN ) ?>
                                <a href="#" class="pull-right toggle-section" data-target="st-list-rooms">
                                    <i class="fa fa-angle-up"></i>
                                </a>
                            </h2>
                            <div class="st-list-rooms relative" data-toggle-section="st-list-rooms">
                                <?php echo st()->load_template( 'layouts/modern/common/loader' ); ?>
                                <div class="fetch">
                                    <?php
                                        $hotel = new STHotel();
                                        $query = $hotel->search_room();
                                        while ( $query->have_posts() ) {
                                            $query->the_post();
                                            echo st()->load_template( 'layouts/modern/hotel/loop/room_item' );
                                        }
                                        wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3 ">
                            <div class="widgets">
                                <div class="owner-info widget-box">
                                    <h4 class="heading"><?php echo __( 'Owner', ST_TEXTDOMAIN ) ?></h4>
                                    <div class="media">
                                        <div class="media-left">
                                            <?php
                                            $author_id = get_post_field( 'post_author', get_the_ID() );
                                            $userdata  = get_userdata( $author_id );
                                            ?>
                                            <a href="<?php echo get_author_posts_url($author_id); ?>">
                                                <?php
                                                echo st_get_profile_avatar( $author_id, 60 );
                                                ?>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="<?php echo get_author_posts_url($author_id); ?>" class="author-link"><?php echo TravelHelper::get_username( $author_id ); ?></a></h4>
                                            <p><?php echo sprintf( __( 'Member Since %s', ST_TEXTDOMAIN ), date( 'Y', strtotime( $userdata->user_registered ) ) ) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-box review-box">
                                    <h2 class="heading"><?php echo esc_html__( 'Traveler rating', ST_TEXTDOMAIN ) ?></h2>
                                    <?php $total = get_comments_number(); ?>
                                    <?php $rate_exe = STReview::count_review_by_rate( null, 5 ); ?>
                                    <div class="item">
                                        <div class="progress">
                                            <div class="percent green"
                                                 style="width: <?php echo TravelHelper::cal_rate( $rate_exe, $total ) ?>%;"></div>
                                        </div>
                                        <div class="label">
                                            <?php echo esc_html__( 'Excellent', ST_TEXTDOMAIN ) ?>
                                            <div class="number"><?php echo esc_html($rate_exe); ?></div>
                                        </div>
                                    </div>
                                    <?php $rate_good = STReview::count_review_by_rate( null, 4 ); ?>
                                    <div class="item">
                                        <div class="progress">
                                            <div class="percent darkgreen"
                                                 style="width: <?php echo TravelHelper::cal_rate( $rate_good, $total ) ?>%;"></div>
                                        </div>
                                        <div class="label">
                                            <?php echo __( 'Very Good', ST_TEXTDOMAIN ) ?>
                                            <div class="number"><?php echo esc_html($rate_good); ?></div>
                                        </div>
                                    </div>
                                    <?php $rate_avg = STReview::count_review_by_rate( null, 3 ); ?>
                                    <div class="item">
                                        <div class="progress">
                                            <div class="percent yellow"
                                                 style="width: <?php echo TravelHelper::cal_rate( $rate_avg, $total ) ?>%;"></div>
                                        </div>
                                        <div class="label">
                                            <?php echo __( 'Average', ST_TEXTDOMAIN ) ?>
                                            <div class="number"><?php echo esc_html($rate_avg); ?></div>
                                        </div>
                                    </div>
                                    <?php $rate_poor = STReview::count_review_by_rate( null, 2 ); ?>
                                    <div class="item">
                                        <div class="progress">
                                            <div class="percent orange"
                                                 style="width: <?php echo TravelHelper::cal_rate( $rate_poor, $total ) ?>%;"></div>
                                        </div>
                                        <div class="label">
                                            <?php echo __( 'Poor', ST_TEXTDOMAIN ) ?>
                                            <div class="number"><?php echo esc_html($rate_poor); ?></div>
                                        </div>
                                    </div>
                                    <?php $rate_terible = STReview::count_review_by_rate( null, 1 ); ?>
                                    <div class="item">
                                        <div class="progress">
                                            <div class="percent red"
                                                 style="width: <?php echo TravelHelper::cal_rate( $rate_terible, $total ) ?>%;"></div>
                                        </div>
                                        <div class="label">
                                            <?php echo __( 'Terrible', ST_TEXTDOMAIN ) ?>
                                            <div class="number"><?php echo esc_html($rate_terible); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-box review-box">
                                    <h2 class="heading"><?php echo __( 'Summary', ST_TEXTDOMAIN ); ?></h2>
                                    <?php
                                        $stats = STReview::get_review_summary();
                                        if ( $stats ) {
                                            foreach ( $stats as $stat ) {
                                                ?>
                                                <div class="item">
                                                    <div class="progress">
                                                        <div class="percent"
                                                             style="width: <?php echo esc_attr($stat[ 'percent' ]); ?>%;"></div>
                                                    </div>
                                                    <div class="label">
                                                        <?php echo esc_html($stat[ 'name' ]); ?>
                                                        <div class="number"><?php echo esc_html($stat[ 'summary' ]) ?>
                                                            /5
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="st-hr x-large"></div>
                <h2 class="st-heading text-center"><?php echo __( 'Hotel Nearby', ST_TEXTDOMAIN ) ?></h2>
                <div class="services-grid services-nearby hotel-nearby grid mt50">
                    <div class="row">
                        <?php
                            global $post;
                            $hotel        = new STHotel();
                            $nearby_posts = $hotel->get_near_by();
                            if ( $nearby_posts ) {
                                foreach ( $nearby_posts as $key => $post ) {
                                    setup_postdata( $post );
                                    $hotel_star  = (int)get_post_meta( get_the_ID(), 'hotel_star', true );
                                    $price       = STHotel::get_price();
                                    $address     = get_post_meta( get_the_ID(), 'address', true );
                                    $review_rate = STReview::get_avg_rate();
                                    $is_featured = get_post_meta( get_the_ID(), 'is_featured', true );
                                    ?>
                                    <div class="col-xs-12 col-sm6 col-md-3">
                                        <div class="item">
                                            <div class="featured-image">
                                                <?php
                                                    if ( $is_featured == 'on' ) {
                                                        ?>
                                                        <div class="featured"><?php echo __( 'Featured', ST_TEXTDOMAIN ) ?></div>
                                                    <?php } ?>
                                                <a href="<?php the_permalink() ?>">
                                                    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>"
                                                         alt="" class="img-responsive img-full">
                                                </a>
                                                <?php echo st()->load_template( 'layouts/modern/common/star', '', [ 'star' => $hotel_star ] ); ?>
                                            </div>
                                            <h4 class="title">
                                                <a href="<?php the_permalink(); ?>" class="st-link c-main">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h4>
                                            <div class="sub-title">
                                                <?php if ( $address ) {
                                                    echo TravelHelper::getNewIcon( 'ico_maps_search_box', '', '10px' );
                                                    echo esc_html( $address );
                                                }
                                                ?>
                                            </div>
                                            <div class="reviews">
                                                <span class="rate"><?php echo esc_attr( $review_rate ); ?>/5
                                                    <?php echo TravelHelper::get_rate_review_text( $review_rate, $count_review ); ?></span><span
                                                        class="summary"><?php comments_number( __( '0 review', ST_TEXTDOMAIN ), __( '1 review', ST_TEXTDOMAIN ), __( '% reviews', ST_TEXTDOMAIN ) ); ?></span>
                                            </div>
                                            <div class="price-wrapper"><?php echo wp_kses( sprintf( __( 'from <span class="price">%s</span><span class="unit">/night</span>', ST_TEXTDOMAIN ), TravelHelper::format_money( $price ) ), [ 'span' => [ 'class' => [] ] ] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                wp_reset_query();
                                wp_reset_postdata();
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile;
