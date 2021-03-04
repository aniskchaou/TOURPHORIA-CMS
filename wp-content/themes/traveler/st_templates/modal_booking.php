<?php 
/**
*@since 1.2.9
*@updated 1.2.9
**/
global $firstname , $user_email;
wp_get_current_user();


$all_items = isset( $cart )? $cart : STCart::get_items();
$prefix = 'hotel';
$post_type = get_post_type( $post_id );
switch ( $post_type) {
	case 'st_hotel':
		$prefix = 'hotel';
		break;
	case 'st_rental':
		$prefix = 'rental';
		break;
	case 'st_cars':
		$prefix = 'car';
	break;
	case 'st_tours':
		$prefix = 'tour';
	break;
	case 'st_activity':
		$prefix = 'activity';
	break;
	default:
		$prefix = 'hotel';
		break;
}
?>
<div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="<?php echo esc_attr($prefix); ?>_booking_<?php echo esc_attr($post_id); ?>">
	<div class="row">
	    <div class="col-xs-12 col-md-8">
	        <h3><?php printf(st_get_language('you_are_booking_for_s'),get_the_title( $post_id ))?></h3>
	        <form id="booking_modal_<?php echo esc_attr($post_id); ?>" class="booking_modal_form" action="" method="post" onsubmit="return false">
	            <div>
	                <?php echo st()->load_template('check_out/check_out',null,array('post_id'=> $post_id ))?>
	            </div>
	        </form>
	    </div>
	    <div class="col-xs-12 col-md-4">
	        <h4><?php esc_html_e('Your Booking','traveler') ?>:</h4>
	        <div class="booking-item-payment">
	            <?php
	            if (!empty($all_items) and is_array($all_items)) {
	                foreach ($all_items as $key => $value) {
	                    if (get_post_status($key)) {
	                        $post_type = get_post_type($key);

	                        switch ($post_type) {
	                            case "st_hotel":
	                                if(st_check_service_available($post_type)) {
		                                $hotel = new STHotel();
		                                echo balanceTags( $hotel->get_cart_item_html( $key ) );
	                                }
	                                break;
	                            case "hotel_room":
		                            if(st_check_service_available($post_type)) {
			                            $room = new STRoom();
			                            echo balanceTags( $room->get_cart_item_html( $key ) );
		                            }
	                                break;
	                            case "st_cars":
		                            if(st_check_service_available($post_type)) {
			                            $cars = new STCars();
			                            echo balanceTags( $cars->get_cart_item_html( $key ) );
		                            }
	                                break;
	                            case "st_tours":
		                            if(st_check_service_available($post_type)) {
			                            $tours = new STTour();
			                            echo balanceTags( $tours->get_cart_item_html( $key ) );
		                            }
	                                break;
	                            case "st_rental":
		                            if(st_check_service_available($post_type)) {
			                            $object = STRental::inst();
			                            echo balanceTags( $object->get_cart_item_html( $key ) );
		                            }
	                                break;
	                            case "st_activity":
		                            if(st_check_service_available($post_type)) {
			                            $object = STActivity::inst();
			                            echo balanceTags( $object->get_cart_item_html( $key ) );
		                            }
	                                break;
	                        }
	                    }
	                }
	            }
	            ?>
	        </div>
	    </div>
	</div>
</div>