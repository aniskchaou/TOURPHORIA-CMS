<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * hotel payment item row
 *
 * Created by ShineTheme
 *
 */
$order_token_code = STInput::get('order_token_code');

if($order_token_code){
    $order_code = STOrder::get_order_id_by_token($order_token_code);
}

$tour_id = $key;

$object_id = $key;
$total = 0;


$check_in = get_post_meta($order_code, 'check_in', true) ;
$check_out = get_post_meta($order_code, 'check_out', true);
$data_prices = get_post_meta($order_code, 'data_prices', true);
$type_tour = get_post_meta($order_code,'type_tour',true);
$adult_number = intval(get_post_meta($order_code, 'adult_number', true));
$child_number = intval(get_post_meta($order_code, 'child_number', true));
$infant_number = intval(get_post_meta($order_code, 'infant_number', true));
$duration = get_post_meta($order_code , 'duration' , true);
$starttime = get_post_meta($order_code , 'starttime' , true);
$link='';
if(isset($object_id) && $object_id){
    $link = get_permalink($object_id);
}

$tour_price_type = get_post_meta($order_code, 'price_type', true);

$price = floatval($data_prices['sale_price']);

$tour_link='';
if(isset($tour_id) and $tour_id){
    $tour_link = get_permalink($tour_id);
}
$currency = get_post_meta($order_code, 'currency', true);

?>
<?php if(isset($tour_id) and $tour_id):?>
<div class="service-section">
    <div class="service-left">
        <h4 class="title"><a href="<?php echo esc_url($tour_link)?>"><?php echo get_the_title($tour_id); ?></a></h4>
        <?php
        $address = get_post_meta($tour_id,'address',true);
        if($address){
        ?>
            <p class="address"><i class="fa fa-map-marker"></i> <?php echo $address; ?></p>
        <?php } ?>
    </div>
    <div class="service-right">
        <?php echo get_the_post_thumbnail($key,array(110,110,'bfi_thumb'=>true),array('style'=>'max-width:100%;height:auto', 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($key ))))?>
    </div>
</div>
<?php endif;?>
<div class="info-section">
    <ul>
        <?php
        $theme_option=st()->get_option('partner_show_contact_info');
        $metabox=get_post_meta($tour_id,'show_agent_contact_info',true);
        $use_agent_info=FALSE;
        if($theme_option=='on') $use_agent_info=true;
        if($metabox=='user_agent_info') $use_agent_info=true;
        if($metabox=='user_item_info') $use_agent_info=FALSE;
        $obj_hotel = get_post( $tour_id );
        $user_id = $obj_hotel->post_author;
        ?>
        <?php if($contact_email=get_post_meta($object_id,'contact_email',true)){?>
            <li><span class="label"><?php echo __('Email', ST_TEXTDOMAIN); ?></span><span class="value"><?php  echo esc_html($contact_email); ?></span></li>
        <?php }?>

        <?php if($max_people=get_post_meta($object_id,'max_people',true)){ ?>
            <li>
                <span class="label">
                    <?php echo __('Max people', ST_TEXTDOMAIN) ?>
                </span>
                <span class="value">
                    <?php
                    if( (int) $max_people == 0 ){
                        $max_people = __('Unlimited', ST_TEXTDOMAIN);
                    }
                    echo $max_people;
                    ?>
                </span>
            </li>
        <?php }?>

        <?php if($adult_number){?>
            <li>
                <span class="label">
                    <?php _e('No. Adult',ST_TEXTDOMAIN) ?>
                </span>
                <span class="value">
                    <?php echo esc_html($adult_number)?>
                </span>
            </li>
        <?php } ?>
        <?php if($child_number){?>
            <li>
                <span class="label">
                    <?php _e('No. Children',ST_TEXTDOMAIN) ?>
                </span>
                <span class="value">
                    <?php echo esc_html($child_number)?>
                </span>
            </li>
        <?php }?>
        <?php if($infant_number){?>
            <li>
                <span class="label">
                    <?php _e('No. Infant',ST_TEXTDOMAIN) ?>
                </span>
                <span class="value">
                    <?php echo esc_html($infant_number)?>
                </span>
            </li>
        <?php }?>

        <?php
        if($tour_price_type != 'fixed_depart') {
            if ( $type_tour == 'daily_tour' ) { ?>
                <?php if ( $check_in ) { ?>
                    <li>
                        <span class="label">
                            <?php st_the_language( 'tour_date' ) ?>
                        </span>
                        <span class="value">
                            <?php echo date_i18n( TravelHelper::getDateFormat(), strtotime( $check_in ) ); ?>
                        </span>
                    </li>
                <?php } ?>
                <?php if ( $duration ) { ?>
                    <li>
                        <span class="label">
                            <?php st_the_language( 'duration' ) ?>
                        </span>
                        <span class="value">
                            <?php echo esc_html($duration); ?>
                        </span>
                    </li>
                <?php } ?>
            <?php } else if ( $type_tour == 'specific_date' ) { ?>
                <?php if ( $check_in and $check_out ) {
                    $period = STDate::dateDiff( $check_in, $check_out );
                    ?>
                    <li>
                        <span class="label">
                            <?php st_the_language( 'tour_date' ) ?>
                        </span>
                        <span class="value">
                            <?php echo date_i18n( TravelHelper::getDateFormat(), strtotime( $check_in ) ); ?> -
                            <?php echo date_i18n( TravelHelper::getDateFormat(), strtotime( $check_out ) ); ?>
                        </span>
                    </li>
                <?php } ?>
                <?php if ( $duration ) { ?>
                    <li>
                        <span class="label">
                            <?php st_the_language( 'duration' ) ?>
                        </span>
                        <span class="value">
                            <?php
                            if ( $period ) {
                                echo esc_html( $period ) . " ";
                                echo ( $period > 1 ) ? __( "days", ST_TEXTDOMAIN ) : __( "day", ST_TEXTDOMAIN );

                            } elseif ( $period == 0 ) {
                                echo __( 'During the day', ST_TEXTDOMAIN );
                            }
                            ?>
                        </span>
                    </li>
                <?php } ?>
                <?php
            }

        }else{
            echo '<li><strong>'. __('Tour type', ST_TEXTDOMAIN) .'</strong>: '. __('Fixed Departure', ST_TEXTDOMAIN) .'</li>';
            ?>
            <?php if ( $check_in ) { ?>
                <li>
                    <span class="label">
                        <?php echo __('Start', ST_TEXTDOMAIN) ?>
                    </span>
                    <span class="value">
                        <?php
                        $day_of_start_date = @date('N', strtotime($check_in));
                        echo TourHelper::getDayFromNumber($day_of_start_date) . ' ';
                        ?>
                        <?php echo date_i18n( TravelHelper::getDateFormat(), strtotime( $check_in ) ); ?>
                    </span>
                </li>
            <?php } ?>
            <?php if ( $check_out ) { ?>
                <li>
                    <span class="label">
                        <?php echo __('End', ST_TEXTDOMAIN) ?>
                    </span>
                    <span class="value">
                       <?php
                       $day_of_end_date = @date('N', strtotime($check_out));
                       echo TourHelper::getDayFromNumber($day_of_end_date) . ' ';
                       ?>
                       <?php echo date_i18n( TravelHelper::getDateFormat(), strtotime( $check_out ) ); ?>
                    </span>
                </li>
            <?php } ?>
            <?php
        }
        ?>

        <?php
            if(!empty($starttime)){
                ?>
                    <li>
                        <span class="label"><?php echo __('Start time:', ST_TEXTDOMAIN); ?></span>
                        <span class="value">
                            <?php echo $starttime; ?>
                        </span>
                    </li>
                <?php
            }
        ?>


        <?php
        $extras = get_post_meta($order_code, 'extras', true);
        if(isset($extras['value']) && is_array($extras['value']) && count($extras['value'])):
        ?>
            <li><span class="label"><?php echo __('Extra:', ST_TEXTDOMAIN); ?></span>
                <span class="value">

                </span>
            </li>
            <li class="extra-value">
                <?php
                    foreach ($extras['value'] as $name => $number):
                        $price_item = floatval($extras['price'][$name]);
                        if ($price_item <= 0) $price_item = 0;
                        $number_item = intval($extras['value'][$name]);
                        if ($number_item <= 0) $number_item = 0;
                        if ($number_item > 0) {
                            ?>
                            <span>
                    <?php echo $extras['title'][$name] . ' (' . TravelHelper::format_money($price_item) . ') x ' . $number_item . ' ' . __('Item(s)', ST_TEXTDOMAIN); ?>
                </span> <br/>
                            <?php
                        }
                    endforeach;
                ?>
            </li>
        <?php endif; ?>
        <li class="guest-value">
            <?php st_print_order_item_guest_name($data['data']) ?>
        </li>
    </ul>
</div>