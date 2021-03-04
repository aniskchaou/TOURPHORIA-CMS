<?php 
	if(!class_exists('PartnerBooking')){
		class PartnerBooking{
			public function __construct(){
				add_action('wp_ajax_st_partnerGetListRoom',array(&$this,'partnerGetListRoom'));
				add_action('wp_ajax_nopriv_st_partnerGetListRoom',array(&$this,'partnerGetListRoom'));
			}

			public function partnerGetListRoom(){
				$result = array('');
				$hotel_id = intval(STInput::request('hotel_id', ''));
				if($hotel_id <= 0 || get_post_type($hotel_id) != 'st_hotel'){
					echo json_encode($result);
					die();
				}
				$user_id = STInput::request('user_id');

				$query = array(
					'post_type' => 'hotel_room',
					'posts_per_page' => -1,
					'post_status' => array('publish', 'private'),
					'author' => $user_id,
					'orderby' => 'title',
                    'order' => 'DESC',
                    'meta_query' => array(
                        array(
                            'key'     => 'room_parent',
                            'value'   => $hotel_id,
                            'compare' => 'IN',
                        ),
                    ),
				);

				query_posts($query);
				if(have_posts()) : 
				$result = array();
				$result[] = array(
					'id' => '',
					'text' => __('----Select a Room----', ST_TEXTDOMAIN)
				);
				while(have_posts()) : the_post();
					$result[] = array(
						'id' => get_the_ID(),
						'text' => get_the_title()
					);
				endwhile;
				endif;
				wp_reset_query(); wp_reset_postdata();

				echo json_encode($result);
				die();
			}
		}
	}
	new PartnerBooking();
?>