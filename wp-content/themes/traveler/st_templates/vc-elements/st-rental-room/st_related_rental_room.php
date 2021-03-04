<?php 
	extract($attr);
	$rental_id = get_post_meta(get_the_ID(), 'room_parent', true);
	$query = array(
		'post_type' => 'rental_room',
		'posts_per_page' => $number_of_room,
		'post__not_in' => array(get_the_ID()),
		'meta_query' => array(
		array(
			'key' => 'room_parent',
			'value' => $rental_id ,
			'compare' => '='
			)
		)
	);
	if(!isset($header_title)) $header_title = __('Room Related', ST_TEXTDOMAIN);
	if(!isset($show_excerpt)) $show_excerpt = 'yes';
echo '
	<div class="booking-item-details no-border-top">
	<div class="wpb_wrapper">
		<h3>'.$header_title.'</h3>
	</div> 
	<ul class="booking-list">
';
	query_posts( $query );
	while(have_posts()): the_post();
?>
<li class="item">
	<div class="booking-item booking-item-small">
		<div class="row">
            <div class="col-xs-4">
                <a href="<?php the_permalink(); ?>">
                	<?php
	                    $img = get_the_post_thumbnail( get_the_ID() , array(89,67,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( )))) ;
	                    if(!empty($img)){
	                        echo balanceTags($img);
	                    }else{
	                        echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.bfi_thumb(ST_TRAVELER_URI.'/img/no-image.png',array('width'=>800,'height'=>600)) .'">';
	                    }
	                ?>  
                </a>
            </div>
            <div class="col-xs-8">
                <h5 class="booking-item-title">
                	<a href="<?php the_permalink(); ?>"><?php the_title(); ?>
                	</a> 
                </h5>
                <?php if($show_excerpt == 'yes'): ?>
                <div class="description text-justify">
                	<?php the_excerpt(); ?>
                </div>
            	<?php endif; ?>
            </div>
        </div>
	</div>
</li>
<?php 
	endwhile; wp_reset_postdata(); wp_reset_query();
	echo '</ul></div>';
?>
  