<?php
$info_price = STPrice::get_info_price();
wp_enqueue_script('magnific.js' );

$status = get_post_status(get_the_ID());
$icon_class = STUser_f::st_get_icon_status_partner();
$page_my_account_dashboard = st()->get_option('page_my_account_dashboard');
?>
<div class="st-item-list">
    <a data-id="<?php the_ID() ?>" data-id-user="<?php echo esc_html($data['ID']) ?>" data-placement="top" rel="tooltip"  class="btn_remove_post_type cursor fa fa-times booking-item-wishlist-remove" data-original-title="<?php st_the_language('user_remove') ?>"></a>
    <a rel="tooltip" data-original-title="<?php st_the_language('user_edit') ?>" href="<?php echo esc_url(add_query_arg(array('sc'=>'edit-hotel','id'=>get_the_ID()),get_the_permalink($page_my_account_dashboard))) ?>"  class="btn_remove_post_type cursor fa fa-edit booking-item-wishlist-remove" style="top:60px ; background: #ed8323 ; color: #fff"></a>
    <i rel="tooltip" data-original-title="<?php st_the_language('user_status') ?>" data-placement="top"  class="<?php echo esc_attr($icon_class) ?> cursor fa  booking-item-wishlist-remove" style="top: 30px;"></i>

    <a data-id="<?php the_ID() ?>" data-id-user="<?php echo esc_attr($data['ID']) ?>" data-status="<?php if($status == 'trash' ) echo "on";else echo 'off'; ?>" data-placement="top" rel="tooltip"  class="btn_on_off_post_type_partner cursor fa <?php if($status == 'trash' ) echo "fa-eye-slash";else echo 'fa-eye'; ?> booking-item-wishlist-remove" data-original-title="<?php _e("On/Off",ST_TEXTDOMAIN) ?>" style="top:90px"></a>

    <div class="spinner user_img_loading ">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
    <div class="item-service">
        <div class="row item-service-wrapper has-matchHeight">
            <div class="col-lg-3 col-md-3 col-sm-12 thumb-wrapper">
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
                    <a href="<?php the_permalink() ?>">
                        <?php
                        if(has_post_thumbnail()){
                            the_post_thumbnail(array(450, 417), array('alt' => TravelHelper::get_alt_image(), 'class' => 'img-responsive'));
                        }else{
                            echo '<img src="'. get_template_directory_uri() . '/img/no-image.png' .'" alt="Default Thumbnail" class="img-responsive" />';
                        }
                        ?>
                    </a>
                    <?php
                    $view_star_review = st()->get_option('view_star_review', 'review');
                    if($view_star_review == 'review') :
                        ?>
                        <ul class="icon-group text-color booking-item-rating-stars">
                            <?php
                            $avg = STReview::get_avg_rate();
                            echo TravelHelper::rate_to_string($avg);
                            ?>
                        </ul>
                    <?php elseif($view_star_review == 'star'): ?>
                        <ul class="icon-list icon-group booking-item-rating-stars">
                            <span class="pull-left mr10"><?php echo __('Hotel star', ST_TEXTDOMAIN); ?></span>
                            <?php
                            $star = STHotel::getStar();
                            echo  TravelHelper::rate_to_string($star, $star);
                            ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 item-content">
                <div class="item-content-w">
                    <?php
                        $view_star_review = st()->get_option('view_star_review', 'review');
                        if($view_star_review == 'review') :
                            ?>
                            <ul class="icon-group text-color booking-item-rating-stars">
                                <?php
                                $avg = STReview::get_avg_rate();
                                echo TravelHelper::rate_to_string($avg);
                                ?>
                            </ul>
                        <?php elseif($view_star_review == 'star'): ?>
                            <ul class="icon-list icon-group booking-item-rating-stars">
                                <span class="pull-left mr10"><?php echo __('Hotel star', ST_TEXTDOMAIN); ?></span>
                                <?php
                                $star = STHotel::getStar();
                                echo  TravelHelper::rate_to_string($star, $star);
                                ?>
                            </ul>
                    <?php endif; ?>
                    <h4 class="service-title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                    <?php
                        $hotel_facilities = TravelHelper::getHotelTerm();
                        if($hotel_facilities){
                            echo '<ul class="facilities">';
                            foreach ($hotel_facilities as $k => $v){
                                echo '<li>'. $v->name .'</li>';
                            }
                            echo '</ul>';
                        }
                    ?>
                    <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
                        <p class="service-location"><?php echo TravelHelper::getNewIcon('Ico_maps', '#666666', '15px', '15px', true); ?><?php echo $address; ?></p>
                    <?php endif;?>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 section-footer">
                <div class="service-review hidden-xs">
                    <?php
                    $count_review = STReview::count_comment(get_the_ID());
                    $avg = STReview::get_avg_rate();
                    ?>
                    <div class="count-review">
                        <span class="text-rating"><?php echo TravelHelper::get_rate_review_text($avg, $count_review); ?></span>
                        <span class="review"><?php echo $count_review . ' ' . _n(esc_html__('Review', ST_TEXTDOMAIN),esc_html__('Reviews', ST_TEXTDOMAIN),$count_review); ?></span>
                    </div>
                    <span class="rating"><?php echo $avg; ?><small>/5</small></span>
                </div>
                <div class="service-review hidden-lg hidden-md hidden-sm">
                    <?php
                    $avg = STReview::get_avg_rate();
                    ?>
                    <span class="rating"><?php echo $avg; ?>/5 <?php echo TravelHelper::get_rate_review_text($avg, $count_review); ?></span>
                    <span class="st-dot"></span>
                    <span class="review"><?php echo $count_review . ' ' . _n(esc_html__('Review', ST_TEXTDOMAIN),esc_html__('Reviews', ST_TEXTDOMAIN),$count_review); ?></span>
                </div>
                <div class="service-price">
                    <span>
                        <?php echo TravelHelper::getNewIcon('thunder', '#ffab53', '14px', '18px'); ?>
                        <?php if(STHotel::is_show_min_price()): ?>
                            <?php _e("From", ST_TEXTDOMAIN) ?>
                        <?php else:?>
                            <?php _e("Avg", ST_TEXTDOMAIN) ?>
                        <?php endif;?>
                    </span>
                    <span class="price">
                        <?php
                        $price = isset($post->st_price)?$post->st_price:0;
                        echo TravelHelper::format_money($price);
                        ?>
                    </span>
                    <span class="unit"><?php echo __('/night', ST_TEXTDOMAIN); ?></span>
                </div>
            </div>
        </div>

    </div>
</div>
