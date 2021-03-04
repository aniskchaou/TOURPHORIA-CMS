<?php
global $post;
$info_price = STActivity::inst()->get_info_price();
$url=st_get_link_with_search(get_permalink(),array('start'),$_GET);
?>
<div class="item-service">
    <div class="row item-service-wrapper has-matchHeight">
        <div class="col-sm-4 thumb-wrapper">
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
                        the_post_thumbnail(array(450, 417), array('alt' => TravelHelper::get_alt_image(), 'class' => 'img-responsive'));
                    }else{
                        echo '<img src="'. get_template_directory_uri() . '/img/no-image.png' .'" alt="Default Thumbnail" class="img-responsive" />';
                    }
                    ?>
                </a>
            </div>
        </div>
        <div class="col-sm-5 item-content">
            <div class="item-content-w">
                <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
                    <p class="service-location hidden-lg hidden-md hidden-sm"><?php echo TravelHelper::getNewIcon('Ico_maps', '#666666', '15px', '15px', true); ?><?php echo $address; ?></p>
                <?php endif;?>
                <h4 class="service-title"><a href="<?php echo esc_url($url); ?>"><?php echo get_the_title(); ?></a></h4>
                <div class="service-review">
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
                <div class="service-excerpt">
                    <?php echo New_Layout_Helper::cutStringByNumWord(get_the_excerpt(), 17); ?>
                </div>

                <div class="service-content-footer hidden-xs">
                    <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
                        <p class="service-location"><?php echo TravelHelper::getNewIcon('Ico_maps', '#666666', '15px', '15px', true); ?><?php echo $address; ?></p>
                    <?php endif;?>

                    <?php
                    $duration = get_post_meta(get_the_ID(), 'duration', true);
                    if(!empty($duration)){
                        ?>
                        <div class="service-duration">
                            <?php echo TravelHelper::getNewIcon('time-clock-circle-1', '#5E6D77', '17px', '17px'); ?>
                            <?php echo esc_html($duration); ?>
                        </div>
                        <?php
                    }

                    $is_cancel = get_post_meta(get_the_ID(), 'st_allow_cancel', true);
                    echo '<div class="service-cancel">';
                        echo TravelHelper::getNewIcon('currency-dollar-bubble', '#5E6D77', '17px', '17px');
                        echo $is_cancel == 'on' ? __('Cancellation', ST_TEXTDOMAIN) : __('No Cancel', ST_TEXTDOMAIN);
                    echo '</div>';
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-3 section-footer">

            <div class="st-center-y">
                <div class="service-price">
                        <span class="price-text">
                            <?php echo TravelHelper::getNewIcon('thunder', '#ffab53', '16px', '16px'); ?>
                            <span class="fr_text"><?php _e("from", ST_TEXTDOMAIN) ?></span>
                        </span>
                    <span class="price">
                            <?php
                            echo STActivity::inst()->get_price_html(get_the_ID());
                            ?>
                        </span>
                </div>
                <a href="<?php echo esc_url($url) ?>" class="btn btn-primary btn-view-more"><?php echo __('VIEW DETAIL', ST_TEXTDOMAIN); ?></a>
            </div>

            <?php if(!empty( $info_price['discount'] ) and $info_price['discount']>0 and $info_price['price_new'] >0) { ?>
                <?php echo STFeatured::get_sale($info_price['discount']); ?>
            <?php } ?>
        </div>
    </div>
</div>