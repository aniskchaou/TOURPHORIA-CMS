<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single cars
 *
 * Created by ShineTheme
 *
 */

$new_layout = st()->get_option( 'st_theme_style', 'classic' );
if ( $new_layout == 'modern' ) {
    get_header();
    $style = get_post_meta( get_the_ID(), 'st_custom_layout_new', true );
    if ( !$style ) {
        $style = st()->get_option('car_layout_v2', 1);
    }
    echo st()->load_template( 'layouts/modern/car/single/single', $style );
    get_footer();

    return;
}


get_header();

$booking_period = get_post_meta(get_the_ID(), 'cars_booking_period', true);
if(empty($booking_period)) $booking_period = 0;
$detail_cars_layout=apply_filters('st_cars_detail_layout',st()->get_option('cars_single_layout'));
if(get_post_meta($detail_cars_layout , 'is_breadcrumb' , true) !=='off'){
    get_template_part('breadcrumb');
}

//Price discount
$pick_up_date=TravelHelper::convertDateFormat(STInput::request('pick-up-date'));
if(empty($pick_up_date)) $pick_up_date = date('m/d/Y',strtotime("now"));
$drop_off_date=TravelHelper::convertDateFormat(STInput::request('drop-off-date'));
if(empty($drop_off_date)) $drop_off_date = date('m/d/Y',strtotime("+1 day"));
$pick_up_time = STInput::request('pick-up-time','12:00 PM');
$drop_off_time = STInput::request('drop-off-time','12:00 PM');
$start = $pick_up_date.' '.$pick_up_time;
$start = strtotime($start);
$end = $drop_off_date.' '.$drop_off_time;
$end = strtotime($end);

$layout_class = get_post_meta($detail_cars_layout , 'layout_size' , true);
if (!$layout_class) $layout_class = "container";

$date= new DateTime();
if($booking_period){
    if($booking_period==1) $date->modify('+1 day');
    else $date->modify('+'.$booking_period.' days');
}
?>

<div itemscope itemtype="http://schema.org/Product">
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="search-dialog" data-period="<?php echo esc_attr($date->format(TravelHelper::getDateFormat())) ?>" data-booking-period="<?php echo esc_attr($booking_period); ?>">
        <div class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
        <?php echo st()->load_template('cars/change-search-form');?>
    </div>
    <div class="<?php echo balanceTags($layout_class) ; ?>">
        <div class="booking-item-details no-border-top">
            <header class="booking-item-header ">
                <?php echo STTemplate::message()?>
                <div class="row">
                    <div class="col-md-8">
						<?php echo st()->load_template('cars/elements/header') ?>

                    </div>
                    <div class="col-md-4">
                        <?php
                        if(!empty($pick_up_date) && !empty($drop_off_date)){
                            $info_price = STCars::get_info_price(get_the_ID(),$start,$end);
                        }else{
                            $info_price = STCars::get_info_price();
                        }
                        $price = $info_price['price'];
                        $price_origin = $info_price['price_origin'];
                        $count_sale = $info_price['discount'];
                        $show_price = st()->get_option('show_price_free');
                        if($show_price == 'on' || !empty($price)) :?>
                            <p class="booking-item-header-price">
                                <small><?php  esc_html_e('Price','traveler') ?></small>
                                <?php if($price_origin != $price){ ?>
                                     <span class=" onsale">
                                      <?php echo TravelHelper::format_money( $price_origin )?>
                                     </span>
                                    <i class="fa fa-long-arrow-right"></i>
                                <?php } ?>
                                <span class="text-lg">
                                        <?php echo TravelHelper::format_money($price) ?>
                                </span>/<?php echo strtolower(STCars::get_price_unit('label')) ?>
                            </p>
                        <?php endif; ?>    
                    </div>
                </div>
            </header>
            <!--<div class="gap gap-small"></div>-->
            <?php
            
            if($detail_cars_layout)
            {
                echo  STTemplate::get_vc_pagecontent($detail_cars_layout);
            }else{
                echo st()->load_template('cars/single','default');
            }
            ?>
        </div><!-- End .booking-item-details-->
    </div>
	<!--Review Rich Snippets-->
	<div itemprop="aggregateRating" class="hidden" itemscope itemtype="http://schema.org/AggregateRating">
		<div><?php _e('Book rating:',ST_TEXTDOMAIN)?>
			<?php printf(__('%s out of %s with %s ratings',ST_TEXTDOMAIN),
				'<span itemprop="ratingValue">'.(get_comments_number() > 0 ? (STReview::get_avg_rate() > 0 ? STReview::get_avg_rate() : 5) : 5).'</span>',
				'<span itemprop="bestRating">5</span>',
				'<span itemprop="ratingCount">'.(get_comments_number() > 0 ? get_comments_number() : 1).'</span>'
			); ?>
		</div>
	</div>
	<!--End Review Rich Snippets-->
</div>
    <span class="hidden st_single_car"></span>

<?php get_footer( ) ?>