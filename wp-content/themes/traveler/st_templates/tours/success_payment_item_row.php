<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours payment success
 *
 * Created by ShineTheme
 *
 */

$order_token_code = STInput::get('order_token_code', '');

if($order_token_code){
    $order_code = STOrder::get_order_id_by_token($order_token_code);
}

$object_id = $key;

$check_in = get_post_meta($order_code, 'check_in', true) ;
$check_out = get_post_meta($order_code, 'check_out', true);
$data_prices = get_post_meta($order_code, 'data_prices', true);
$type_tour = get_post_meta($order_code,'type_tour',true);
$adult_number = intval(get_post_meta($order_code, 'adult_number', true));
$child_number = intval(get_post_meta($order_code, 'child_number', true));
$infant_number = intval(get_post_meta($order_code, 'infant_number', true));
$starttime = get_post_meta($order_code, 'starttime', true);
$duration = get_post_meta($order_code , 'duration' , true);
//$duration_unit = get_post_meta($order_code , 'duration_unit' , true);
$link='';
if(isset($object_id) && $object_id){
    $link = get_permalink($object_id);
}

$tour_price_type = get_post_meta($order_code, 'price_type', true);
?>
<tr>
    <td><?php echo esc_html($i+1) ?></td>
    <td>
        <a href="<?php echo esc_url($link)?>" target="_blank">
        <?php echo get_the_post_thumbnail($key,array(360,270,'bfi_thumb'=>true),array('style'=>'max-width:100%;height:auto', 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($key ))))?>
        </a>
    </td>
    <td>
        <?php if($address=get_post_meta($object_id,'address',true)){?>
        <p><strong><?php st_the_language('booking_address') ?></strong> <?php echo esc_html($address)?> </p>
        <?php }?>
        <?php if($contact_email=get_post_meta($object_id,'contact_email',true)){?>
        <p><strong><?php st_the_language('booking_email') ?></strong> <?php echo esc_html($contact_email)?> </p>
        <?php }?>
        <p><strong><?php st_the_language('booking_tour') ?></strong> <?php  echo get_the_title($object_id)?></p>
        <?php if($max_people=get_post_meta($object_id,'max_people',true)){ ?>
        <p><strong><?php st_the_language('tour_max_people') ?>: </strong> <?php 
            if( (int) $max_people == 0 ){
                $max_people = __('Unlimited', ST_TEXTDOMAIN);
            }
            echo $max_people;
        ?> </p>
        <?php }?>
        <?php if($adult_number){?>
        <p><strong><?php _e('Number of Adult',ST_TEXTDOMAIN) ?>: </strong>
            <?php echo $adult_number; ?>
        </p>
        <?php } ?>
        <?php if($child_number){?>
        <p><strong><?php _e('Number of Children',ST_TEXTDOMAIN) ?>: </strong>
            <?php echo $child_number; ?>
        </p>
        <?php }?>
        <?php if($infant_number){?>
        <p><strong><?php _e('Number of Infant',ST_TEXTDOMAIN) ?>: </strong>
            <?php echo $infant_number; ?>
        </p>
        <?php }?>
        <?php
        if($tour_price_type != 'fixed_depart') {
	        if ( $type_tour == 'daily_tour' ) { ?>
		        <?php if ( $check_in ) { ?>
                    <p>
                        <strong><?php st_the_language( 'tour_date' ) ?> : </strong>
				        <?php echo date_i18n( TravelHelper::getDateFormat(), strtotime( $check_in ) ) . ( $starttime == '' ? '' : ' - ' . $starttime ); ?>
                    </p>
		        <?php } ?>
		        <?php if ( $duration ) { ?>
                    <p><strong><?php st_the_language( 'duration' ) ?> : </strong>
				        <?php echo esc_html( $duration ); ?>
                    </p>
		        <?php } ?>
	        <?php } else if ( $type_tour == 'specific_date' ) { ?>
		        <?php if ( $check_in and $check_out ) {
			        $period = STDate::dateDiff( $check_in, $check_out );
			        ?>
                    <p>
                        <strong><?php st_the_language( 'tour_date' ) ?> : </strong>
				        <?php echo date_i18n( TravelHelper::getDateFormat(), strtotime( $check_in ) ); ?> -
				        <?php echo date_i18n( TravelHelper::getDateFormat(), strtotime( $check_out ) ) . ( $starttime == '' ? '' : ' - ' . $starttime ); ?>
                    </p>
		        <?php } ?>
		        <?php if ( $duration ) { ?>
                    <p><strong><?php st_the_language( 'duration' ) ?> : </strong>
				        <?php
				        if ( $period ) {
					        echo esc_html( $period ) . " ";
					        echo ( $period > 1 ) ? __( "days", ST_TEXTDOMAIN ) : __( "day", ST_TEXTDOMAIN );

				        } elseif ( $period == 0 ) {
					        echo __( 'During the day', ST_TEXTDOMAIN );
				        }

				        ?>
                    </p>
		        <?php } ?>
		        <?php
	        }
        }else{
            echo '<p><strong>'. __('Tour type', ST_TEXTDOMAIN) .'</strong>: '. __('Fixed Departure', ST_TEXTDOMAIN) .'</p>';
	        ?>
	        <?php if ( $check_in ) { ?>
                <p>
                    <strong><?php echo __('Start', ST_TEXTDOMAIN) ?>: </strong>
                    <?php
                    $day_of_start_date = @date('N', strtotime($check_in));
                    echo TourHelper::getDayFromNumber($day_of_start_date) . ' ';
                    ?>
			        <?php echo date_i18n( TravelHelper::getDateFormat(), strtotime( $check_in ) ); ?>
                </p>
	        <?php } ?>
	        <?php if ( $check_out ) { ?>
                <p>
                    <strong><?php echo __('End', ST_TEXTDOMAIN) ?>: </strong>
	                <?php
	                $day_of_end_date = @date('N', strtotime($check_out));
	                echo TourHelper::getDayFromNumber($day_of_end_date) . ' ';
	                ?>
			        <?php echo date_i18n( TravelHelper::getDateFormat(), strtotime( $check_out ) ); ?>
                </p>
	        <?php } ?>
            <?php
        }
        ?>
        <?php st_print_order_item_guest_name($data['data']) ?>
        
    </td>
