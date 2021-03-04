<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 20-12-2018
     * Time: 1:55 PM
     * Since: 1.0.0
     * Updated: 1.0.0
     */
    while ( have_posts() ): the_post();
        $post_id     = get_the_ID();
        $address     = get_post_meta( $post_id, 'address', true );
        $count_review = get_comment_count($post_id)['approved'];
        $review_rate = STReview::get_avg_rate();
        $lat         = get_post_meta( $post_id, 'map_lat', true );
        $lng         = get_post_meta( $post_id, 'map_lng', true );
        $zoom        = get_post_meta( $post_id, 'map_zoom', true );

        $gallery       = get_post_meta( $post_id, 'gallery', true );
        $gallery_array = explode( ',', $gallery );
        $marker_icon   = st()->get_option( 'st_activity_icon_map_marker', '' );

        $activity_external = get_post_meta(get_the_ID(), 'st_activity_external_booking', true);
        $activity_external_link = get_post_meta(get_the_ID(), 'st_activity_external_booking_link', true);
        ?>
        <div id="st-content-wrapper" class="st-single-tour">
            <?php st_breadcrumbs_new() ?>
            <div class="hotel-target-book-mobile">
                <div class="price-wrapper">
                    <?php echo wp_kses( sprintf( __( 'from <span class="price">%s</span>', ST_TEXTDOMAIN ),STActivity::inst()->get_price_html( get_the_ID() )), [ 'span' => [ 'class' => [] ] ] ) ?>
                </div>
                <?php
                if($activity_external == 'off' || empty($activity_external)){
                    ?>
                    <a href=""
                       class="btn btn-mpopup btn-green"><?php echo esc_html__( 'Check Availability', ST_TEXTDOMAIN ) ?></a>
                    <?php
                }else{
                    ?>
                    <a href="<?php echo esc_url($activity_external_link); ?>"
                       class="btn btn-green"><?php echo esc_html__( 'Book Now', ST_TEXTDOMAIN ) ?></a>
                    <?php
                }
                ?>
            </div>
            <div class="st-tour-content style3">
                <div class="container">

                    <!--Tour header-->
                    <div class="st-hotel-header">
                        <div class="left">
                            <h2 class="st-heading"><?php the_title(); ?></h2>
                            <div class="sub-heading">
                                <?php if ( $address ) {
                                    echo TravelHelper::getNewIcon( 'ico_maps_add_2', '#5E6D77', '16px', '16px' );
                                    echo esc_html( $address );
                                }
                                ?>
                            </div>
                        </div>
                        <div class="right">
                            <div class="review-score style-2">
                                <span class="head-rating"><?php echo TravelHelper::get_rate_review_text( $review_rate, $count_review ); ?></span>
                                <?php echo st()->load_template( 'layouts/modern/common/star', '', [ 'star' => $review_rate, 'style' => 'style-2' ] ); ?>
                                <p class="st-link"><?php comments_number( __( 'from 0 review', ST_TEXTDOMAIN ), __( 'from 1 review', ST_TEXTDOMAIN ), __( 'from % reviews', ST_TEXTDOMAIN ) ); ?></p>
                            </div>
                        </div>
                    </div>

                    <!--Tour Banner-->
                    <?php
                    if ( has_post_thumbnail() ) {
                        $url = get_the_post_thumbnail_url( $post_id, 'full' );
                        ?>
                        <div class="tour-featured-image featured-image-background"
                             style="background-image: url('<?php echo esc_url( $url ); ?>')">

                                <div class="st-gallery">
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
                                        <?php echo st()->load_template( 'layouts/modern/hotel/loop/wishlist' ); ?>
                                    </div>
                                    <div class="btn-group">
                                        <?php $video_url = get_post_meta(get_the_ID(), 'video', true);
                                        if(!empty($video_url)){
                                            ?>
                                            <a href="<?php echo esc_url($video_url); ?>"
                                               class="btn btn-transparent has-icon radius st-video-popup"><?php echo TravelHelper::getNewIcon( 'video-player', '#FFFFFF', '18px', '18px' ) ?><?php echo __( 'Video', ST_TEXTDOMAIN ) ?></a>
                                        <?php } ?>
                                        <a href="#st-gallery-popup"
                                           class="btn btn-transparent has-icon radius st-gallery-popup"><?php echo TravelHelper::getNewIcon( 'camera-retro', '#FFFFFF', '18px', '18px' ) ?><?php echo __( 'More Photo', ST_TEXTDOMAIN ) ?></a>
                                        <div id="st-gallery-popup" class="hidden">
                                            <?php
                                            if(!empty($gallery_array)){
                                                foreach ($gallery_array as $k => $v){
                                                    echo '<a href="'. wp_get_attachment_image_url($v, 'full') .'">Image</a>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    <?php }
                    ?>

                    <div class="row">
                        <div class="col-xs-12 col-md-9">

                            <!--Tour Info-->
                            <div class="st-tour-feature">
                                <div class="row">
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="item">
                                            <div class="icon">
                                                <?php echo TravelHelper::getNewIcon( 'ico_clock', '#5E6D77', '32px', '32px' ); ?>
                                            </div>
                                            <div class="info">
                                                <h4 class="name"><?php echo __( 'Duration', ST_TEXTDOMAIN ); ?></h4>
                                                <p class="value">
                                                    <?php
                                                        $duration = get_post_meta( get_the_ID(), 'duration', true );
                                                        echo esc_html( $duration );
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="item">
                                            <div class="icon">
                                                <?php echo TravelHelper::getNewIcon( 'money_1', '#5E6D77', '32px', '32px' ); ?>
                                            </div>
                                            <div class="info">
                                                <h4 class="name"><?php echo __( 'Cancellation', ST_TEXTDOMAIN ); ?></h4>
                                                <p class="value">
                                                    <?php
                                                        $cancellation= get_post_meta( get_the_ID(), 'st_allow_cancel', true );
                                                        $cancellation_day= (int)get_post_meta( get_the_ID(), 'st_cancel_number_days', true );
                                                        if ( $cancellation== 'on' ) {
                                                            echo sprintf(__( 'Up to %s', ST_TEXTDOMAIN ), $cancellation_day);
                                                        } else {
                                                            echo __( 'No Cancellation', ST_TEXTDOMAIN );
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="item">
                                            <div class="icon">
                                                <?php echo TravelHelper::getNewIcon( 'ico_adults_blue', '#5E6D77', '32px', '32px' ); ?>
                                            </div>
                                            <div class="info">
                                                <h4 class="name"><?php echo __( 'Group Size', ST_TEXTDOMAIN ); ?></h4>
                                                <p class="value">
                                                    <?php
                                                        $max_people = get_post_meta( get_the_ID(), 'max_people', true );
                                                        if ( empty( $max_people ) or $max_people == 0 or $max_people < 0 ) {
                                                            echo __( 'Unlimited', ST_TEXTDOMAIN );
                                                        } else {
                                                            if ( $max_people == 1 )
                                                                echo sprintf( __( '%s people', ST_TEXTDOMAIN ), $max_people );
                                                            else
                                                                echo sprintf( __( '%s peoples', ST_TEXTDOMAIN ), $max_people );
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="item">
                                            <div class="icon">
                                                <?php echo TravelHelper::getNewIcon( 'Group', '#5E6D77', '32px', '32px' ); ?>
                                            </div>
                                            <div class="info">
                                                <h4 class="name"><?php echo __( 'Languages', ST_TEXTDOMAIN ); ?></h4>
                                                <p class="value">
                                                    <?php
                                                        $term_list    = wp_get_post_terms( get_the_ID(), 'languages' );
                                                        $str_term_arr = [];
                                                        if ( !is_wp_error( $term_list ) && !empty( $term_list ) ) {
                                                            foreach ( $term_list as $k => $v ) {
                                                                array_push( $str_term_arr, $v->name );
                                                            }

                                                            echo implode( ', ', $str_term_arr );
                                                        } else {
                                                            echo '___';
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Tour info-->

                            <!--Tour Overview-->
                            <?php
                            global $post;
                            $content = $post->post_content;
                            $count   = str_word_count( $content );
                            if(!empty($content)){
                            ?>
                            <div class="st-overview">
                                <h3 class="st-section-title"><?php echo __('Overview', ST_TEXTDOMAIN); ?></h3>
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
                            <?php } ?>
                            <!--End Tour Overview-->

                            <!--Tour highlight-->

                            <?php
                            $tours_highlight = get_post_meta(get_the_ID(), 'activity_highlight', true);
                            if(!empty($tours_highlight)){
                                $arr_highlight = explode("\n", trim($tours_highlight));
                            ?>
                            <div class="st-highlight">
                                <h3 class="st-section-title"><?php echo __('HIGHLIGHTS', ST_TEXTDOMAIN); ?></h3>
                                <ul>
                                    <?php
                                    if(!empty($arr_highlight)){
                                        foreach ($arr_highlight as $k => $v) {
                                            echo '<li>' . $v  .'</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php } ?>
                            <!--End Tour highlight-->

                            <!--Tour program-->
                            <?php
                            $tour_program_style = get_post_meta(get_the_ID(), 'activity_program_style', true);
                            if(empty($tour_program_style))
                                $tour_program_style = 'style1';
                            if($tour_program_style == 'style1' or $tour_program_style == 'style3')
                                $tour_programs = get_post_meta(get_the_ID(), 'activity_program', true);
                            else
                                $tour_programs = get_post_meta(get_the_ID(), 'activity_program_bgr', true);
                            if(!empty($tour_programs)){
                            ?>
                                <div class="st-program">
                                    <div class="st-title-wrapper">
                                        <h3 class="st-section-title"><?php echo __('What you will do', ST_TEXTDOMAIN); ?></h3>
                                        <?php if($tour_program_style == 'style1'){ ?>
                                            <span class="expand" data-ex="1" data-text-more="<?php echo __('Expand All', ST_TEXTDOMAIN); ?>" data-text-less="<?php echo __('Collapse All', ST_TEXTDOMAIN); ?>"><?php echo __('Expand All', ST_TEXTDOMAIN); ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="st-program-list <?php echo $tour_program_style; ?>">
                                        <?php
                                        echo st()->load_template('layouts/modern/activity/single/items/itenirary/' . $tour_program_style);
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <!--End Tour program-->

                            <!--Tour Include/Exclude-->
                            <?php
                            $include = get_post_meta(get_the_ID(), 'activity_include', true);
                            $exclude = get_post_meta(get_the_ID(), 'activity_exclude', true);
                            if(!empty($include) or !empty($exclude)){
                                ?>
                                <div class="st-include">
                                    <h3 class="st-section-title">
                                        <?php echo __('Included/Exclude', ST_TEXTDOMAIN); ?>
                                    </h3>
                                    <div class="row">
                                        <?php if(!empty($include)){ ?>
                                            <div class="col-lg-6">
                                                <ul class="include">
                                                    <?php
                                                    $in_arr = explode("\n", $include);
                                                    if(!empty($in_arr)) {
                                                        foreach ($in_arr as $k => $v) {
                                                            echo '<li>'. TravelHelper::getNewIcon('check-1', '#2ECC71', '14px', '14px', false) . $v .'</li>';
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        <?php } ?>
                                        <?php if(!empty($exclude)){ ?>
                                            <div class="col-lg-6">
                                                <ul class="exclude">
                                                    <?php
                                                    $ex_arr = explode("\n", $exclude);
                                                    if(!empty($ex_arr)) {
                                                        foreach ($ex_arr as $k => $v) {
                                                            echo '<li>'. TravelHelper::getNewIcon('remove', '#FA5636', '18px', '18px', false) . $v .'</li>';
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <!--End Tour Include/Exclude-->

                            <!--Tour Map-->
                            <div class="st-hr large st-height2"></div>
                                <div class="st-map-wrapper">
                                <?php
                                if(!$zoom){
                                    $zoom = 13;
                                }
                                ?>
                                <div class="st-flex space-between">
                                    <h2 class="st-heading-section mg0"><?php echo __( 'Activity\'s Location', ST_TEXTDOMAIN ) ?></h2>
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
                            </div>
                            <!--End Tour Map-->

                            <!--Tour FAQ-->
                            <?php
                            $tour_faq = get_post_meta(get_the_ID(), 'activity_faq', true);
                            if(!empty($tour_faq)){
                                ?>
                                <div class="st-faq">
                                    <h3 class="st-section-title">
		                                <?php echo __('FAQs', ST_TEXTDOMAIN); ?>
                                    </h3>
                                    <?php $i = 0; foreach ($tour_faq as $k => $v){ ?>
                                    <div class="item <?php echo $i == 0 ? 'active' : ''; ?>">
                                        <div class="header">
                                            <?php echo TravelHelper::getNewIcon( 'question-help-message', '#5E6D77', '18px', '18px' ); ?>
                                            <h5><?php echo esc_html($v['title']); ?></h5>
                                            <span class="arrow">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </div>
                                        <div class="body">
                                            <?php echo esc_html($v['desc']); ?>
                                        </div>
                                    </div>
                                    <?php $i++; } ?>
                                </div>
                                <?php
                            }
                            ?>
                            <!--End Tour FAQ-->

                            <!--Review Option-->
                            <div class="st-hr large st-height2 st-hr-comment"></div>
                            <h2 class="st-heading-section"><?php echo esc_html__( 'Reviews', ST_TEXTDOMAIN ) ?></h2>
                            <div id="reviews" data-toggle-section="st-reviews" class=" stoped-scroll-section">
                                <div class="review-box">
                                    <div class="row">
                                        <div class="col-lg-5">
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
                                        <div class="col-lg-7">
                                            <div class="review-sumary">
                                                <?php $total = get_comments_number(); ?>
                                                <?php $rate_exe = STReview::count_review_by_rate( null, 5 ); ?>
                                                <div class="item">
                                                    <div class="label">
                                                        <?php echo esc_html__( 'Excellent', ST_TEXTDOMAIN ) ?>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="percent green"
                                                             style="width: <?php echo TravelHelper::cal_rate( $rate_exe, $total ) ?>%;"></div>
                                                    </div>
                                                    <div class="number"><?php echo $rate_exe; ?></div>
                                                </div>
                                                <?php $rate_good = STReview::count_review_by_rate( null, 4 ); ?>
                                                <div class="item">
                                                    <div class="label">
                                                        <?php echo __( 'Very Good', ST_TEXTDOMAIN ) ?>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="percent darkgreen"
                                                             style="width: <?php echo TravelHelper::cal_rate( $rate_good, $total ) ?>%;"></div>
                                                    </div>
                                                    <div class="number"><?php echo $rate_good; ?></div>
                                                </div>
                                                <?php $rate_avg = STReview::count_review_by_rate( null, 3 ); ?>
                                                <div class="item">
                                                    <div class="label">
                                                        <?php echo __( 'Average', ST_TEXTDOMAIN ) ?>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="percent yellow"
                                                             style="width: <?php echo TravelHelper::cal_rate( $rate_avg, $total ) ?>%;"></div>
                                                    </div>
                                                    <div class="number"><?php echo $rate_avg; ?></div>
                                                </div>
                                                <?php $rate_poor = STReview::count_review_by_rate( null, 2 ); ?>
                                                <div class="item">
                                                    <div class="label">
                                                        <?php echo __( 'Poor', ST_TEXTDOMAIN ) ?>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="percent orange"
                                                             style="width: <?php echo TravelHelper::cal_rate( $rate_poor, $total ) ?>%;"></div>
                                                    </div>
                                                    <div class="number"><?php echo $rate_poor; ?></div>
                                                </div>
                                                <?php $rate_terible = STReview::count_review_by_rate( null, 1 ); ?>
                                                <div class="item">
                                                    <div class="label">
                                                        <?php echo __( 'Terrible', ST_TEXTDOMAIN ) ?>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="percent red"
                                                             style="width: <?php echo TravelHelper::cal_rate( $rate_terible, $total ) ?>%;"></div>
                                                    </div>
                                                    <div class="number"><?php echo $rate_terible; ?></div>
                                                </div>
                                            </div>
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
                                                echo st()->load_template( 'layouts/modern/common/reviews/review', 'list', [ 'comment' => (object)$comment, 'post_type' => 'st_activity' ] );
                                            endforeach;
                                        endif;
                                        ?>
                                    </div>
                                </div>
                                <div class="review-pag-wrapper">
                                    <div class="review-pag-text">
                                        <?php echo sprintf( __( 'Showing %s - %s of %s in total', ST_TEXTDOMAIN ), $from, $to, get_comments_number_text('0', '1', '%') ) ?>
                                    </div>
                                    <?php TravelHelper::pagination_comment( [ 'total' => $total ] ) ?>
                                </div>
                                <?php
                                if ( comments_open( $post_id ) ) {
                                    ?>
                                    <div id="write-review">
                                        <h4 class="heading">
                                            <a href="" class="toggle-section c-main f16"
                                               data-target="st-review-form"><?php echo __( 'Write a review', ST_TEXTDOMAIN ) ?>
                                                <i class="fa fa-angle-down ml5"></i></a>
                                        </h4>
                                        <?php
                                        TravelHelper::comment_form();
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <!--End Review Option-->

                        </div>
                        <div class="col-xs-12 col-md-3">
                            <?php
                            $info_price = STActivity::inst()->get_info_price();
                            ?>
                            <div class="widgets">
                                <div class="fixed-on-mobile" id="booking-request" data-screen="992px">
                                    <div class="close-icon hide">
                                        <?php echo TravelHelper::getNewIcon( 'Ico_close' ); ?>
                                    </div>
                                    <div class="form-book-wrapper relative">
                                        <?php if(!empty( $info_price['discount'] ) and $info_price['discount']>0 and $info_price['price_new'] >0) { ?>
                                            <div class="tour-sale-box">
                                                <?php echo STFeatured::get_sale($info_price['discount']); ?>
                                            </div>
                                        <?php } ?>
                                        <?php echo st()->load_template( 'layouts/modern/common/loader' ); ?>
                                        <div class="form-head">
                                            <div class="price">
                                                <span class="label">
                                                    <?php _e("from", ST_TEXTDOMAIN) ?>
                                                </span>
                                                <span class="value">
                                                    <?php
                                                    echo STActivity::inst()->get_price_html(get_the_ID());
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                        <?php if(empty($activity_external) || $activity_external == 'off'){ ?>
                                            <form id="form-booking-inpage" method="post" action="#booking-request">
                                                <input type="hidden" name="action" value="activity_add_to_cart">
                                                <input type="hidden" name="item_id" value="<?php echo get_the_ID(); ?>">
                                                <?php
                                                    $start = STInput::request('check_in', date(TravelHelper::getDateFormat()));
                                                    $end = STInput::request('check_out', date(TravelHelper::getDateFormat()));
                                                    $date = STInput::request('date', date('d/m/Y h:i a'). '-'. date('d/m/Y h:i a'));
                                                    $has_icon = (isset($has_icon))? $has_icon: false;
                                                ?>
                                                <div class="form-group form-date-field form-date-search clearfix <?php if($has_icon) echo ' has-icon '; ?>" data-format="<?php echo TravelHelper::getDateFormatMoment() ?>">
                                                    <?php
                                                        if($has_icon){
                                                            echo TravelHelper::getNewIcon('ico_calendar_search_box');
                                                        }
                                                    ?>
                                                    <div class="date-wrapper clearfix">
                                                        <div class="check-in-wrapper">
                                                            <label><?php echo __('Date', ST_TEXTDOMAIN); ?></label>
                                                            <div class="render check-in-render"><?php echo $start; ?></div>
                                                            <?php
                                                            $class_hidden_enddate = 'hidden';
                                                            $activity_type = get_post_meta(get_the_ID(), 'type_activity', true);
                                                            if($activity_type != 'daily_activity' && (strtotime($end) - strtotime($start)) > 0 ){
                                                                $class_hidden_enddate = '';
                                                            }
                                                            ?>
                                                            <span class="sts-tour-checkout-label <?php echo $class_hidden_enddate; ?>"><span> - </span><div class="render check-out-render"><?php echo $end; ?></div></span>
                                                        </div>
                                                        <i class="fa fa-angle-down arrow"></i>
                                                    </div>
                                                    <input type="text" class="check-in-input" value="<?php echo esc_attr($start) ?>" name="check_in">
                                                    <input type="hidden" class="check-out-input" value="<?php echo esc_attr($end) ?>" name="check_out" >
                                                    <input type="text" class="check-in-out-input" value="<?php echo esc_attr($date) ?>" name="check_in_out" data-action="st_get_availability_activity_frontend" data-tour-id="<?php the_ID(); ?>" data-posttype="st_activity">
                                                </div>

                                                <?php
                                                /*Starttime*/
                                                $starttime_value = STInput::request('starttime_tour', '');
                                                ?>

                                                <div class="form-group form-more-extra st-form-starttime" <?php echo $starttime_value != '' ? '' : 'style="display: none"' ?>>
                                                    <input type="hidden" data-starttime="<?php echo $starttime_value; ?>"
                                                           data-checkin="<?php echo $start; ?>" data-checkout="<?php echo $end; ?>"
                                                           data-tourid="<?php echo get_the_ID(); ?>" id="starttime_hidden_load_form"  data-posttype="st_activity"/>
                                                    <div class="" id="starttime_box">
                                                        <label><?php echo __('Start time', ST_TEXTDOMAIN); ?></label>
                                                        <select class="form-control st_tour_starttime" name="starttime"
                                                                id="starttime_tour"></select>
                                                    </div>
                                                </div>
                                                <!--End starttime-->

                                                <?php echo st()->load_template( 'layouts/modern/activity/elements/search/single/guest', '' ); ?>
                                                <?php echo st()->load_template( 'layouts/modern/activity/elements/search/single/extra', '' ); ?>
                                                <div class="submit-group">
                                                    <input class="btn btn-green btn-large btn-full upper"
                                                           type="submit"
                                                           name="submit"
                                                           value="<?php echo esc_html__( 'Book Now', ST_TEXTDOMAIN ) ?>">
                                                </div>
                                                <div class="message-wrapper mt30">
                                                    <?php echo STTemplate::message() ?>
                                                </div>
                                            </form>
                                        <?php }else{ ?>
                                            <div class="submit-group mb30">
                                                <a href="<?php echo esc_url($activity_external_link); ?>" class="btn btn-green btn-large btn-full upper"><?php echo esc_html__( 'Book Now', ST_TEXTDOMAIN ); ?></a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="owner-info widget-box">
                                        <h4 class="heading"><?php echo __( 'Organized by', ST_TEXTDOMAIN ) ?></h4>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        $args = [
                            'posts_per_page' => 4,
                            'post_type'      => 'st_activity',
                            'post_author'    => get_post_field( 'post_author', get_the_ID() )
                        ];
                        global $post;
                        $old_post = $post;
                        $query    = new WP_Query( $args );
                        if ( $query->have_posts() ):
                            $info_price = STActivity::inst()->get_info_price();
                            $url=st_get_link_with_search(get_permalink(),array('start'),$_GET);
                            ?>
                            <div class="st-hr large"></div>
                            <h2 class="heading text-center f28 mt50"><?php echo esc_html__( 'You might also like', ST_TEXTDOMAIN ) ?></h2>
                            <div class="st-list-tour-related row mt50">
                                <?php
                                    while ( $query->have_posts() ): $query->the_post();
                                        $info_price = STActivity::inst()->get_info_price();
                                        $url=st_get_link_with_search(get_permalink(),array('start'),$_GET);
                                        ?>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="item-service grid-item has-matchHeight">
                                                <div class="service-border">
                                                    <div class="thumb">
                                                        <?php if(!empty( $info_price['discount'] ) and $info_price['discount']>0 and $info_price['price_new'] >0) { ?>
                                                            <?php echo STFeatured::get_sale($info_price['discount']); ?>
                                                        <?php } ?>
                                                        <?php if(is_user_logged_in()){ ?>
                                                            <?php $data = STUser_f::get_icon_wishlist();?>
                                                            <div class="service-add-wishlist login <?php echo $data['status'] ? 'added' : ''; ?>" data-id="<?php echo get_the_ID(); ?>" data-type="<?php echo get_post_type(get_the_ID()); ?>" title="<?php echo $data['status'] ? __('Remove from wishlist', ST_TEXTDOMAIN) : __('Add to wishlist', ST_TEXTDOMAIN); ?>">
                                                                <i class="fa fa-heart"></i>
                                                                <div class="lds-dual-ring"></div>
                                                            </div>
                                                        <?php }else{ ?>
                                                            <a href="" class="login" data-toggle="modal" data-target="#st-login-form">
                                                                <div class="service-add-wishlist" title="<?php echo __('Add to wishlist', ST_TEXTDOMAIN); ?>">
                                                                    <i class="fa fa-heart"></i>
                                                                    <div class="lds-dual-ring"></div>
                                                                </div>
                                                            </a>
                                                        <?php } ?>
                                                        <div class="service-tag bestseller">
                                                            <?php echo STFeatured::get_featured(); ?>
                                                        </div>
                                                        <a href="<?php echo esc_url($url); ?>">
                                                            <?php
                                                                if(has_post_thumbnail()){
                                                                    the_post_thumbnail(array(680, 500), array('alt' => TravelHelper::get_alt_image(), 'class' => 'img-responsive'));
                                                                }else{
                                                                    echo '<img src="'. get_template_directory_uri() . '/img/no-image.png' .'" alt="Default Thumbnail" class="img-responsive" />';
                                                                }
                                                            ?>
                                                        </a>
                                                        <?php echo st_get_avatar_in_list_service(get_the_ID(),35)?>
                                                    </div>
                                                    <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
                                                        <p class="service-location plr15 st-flex justify-left"><?php echo TravelHelper::getNewIcon('Ico_maps', '#666666', '15px', '15px', true); ?><span class="ml5"><?php echo $address; ?></span></p>
                                                    <?php endif;?>
                                                    <h4 class="service-title plr15"><a href="<?php echo esc_url($url); ?>"><?php echo get_the_title(); ?></a></h4>

                                                    <div class="service-review plr15">
                                                        <ul class="icon-group text-color booking-item-rating-stars">
                                                            <?php
                                                                $avg = STReview::get_avg_rate();
                                                                echo TravelHelper::rate_to_string($avg);
                                                            ?>
                                                        </ul>
                                                        <?php
                                                            $count_review = STReview::count_comment(get_the_ID());
                                                        ?>
                                                        <span class="review"><?php echo $count_review . ' ' . _n(esc_html__('Review', ST_TEXTDOMAIN),esc_html__('Reviews', ST_TEXTDOMAIN),$count_review); ?></span>
                                                    </div>

                                                    <div class="section-footer">
                                                        <div class="footer-inner plr15">

                                                            <div class="service-price">
                                                                <span>
                                                                    <?php echo TravelHelper::getNewIcon('thunder', '#ffab53', '10px', '16px'); ?>
                                                                    <span class="fr_text"><?php _e("from", ST_TEXTDOMAIN) ?></span>
                                                                </span>
                                                                <span class="price">
                                                                    <?php
                                                                        echo STActivity::inst()->get_price_html(get_the_ID());
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endwhile;
                                ?>
                            </div>
                        <?php
                        endif;
                        wp_reset_postdata();
                        $post = $old_post;
                    ?>
                </div>
            </div>
        </div>
    <?php
    endwhile;
