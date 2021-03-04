<?php 

	$html_price = get_post_meta(get_the_ID(), 'price', true);
    $discount = get_post_meta(get_the_ID(), 'discount_rate', TRUE);
    if($discount) {
        if($discount > 100) $discount = 100;
        $html_price = $html_price - ( $html_price / 100 ) * $discount;
    }
    $adult_number = intval(get_post_meta(get_the_ID(), 'adult_number', true));
    $children_number = intval(get_post_meta(get_the_ID(), 'children_number', true));
    $bed_number = intval(get_post_meta(get_the_ID(), 'bed_number', true));
    $room_footage = intval(get_post_meta(get_the_ID(), 'room_footage', true));

    $st_items_in_row = $st_items_in_row; 
    if (empty($st_items_in_row)) $st_items_in_row = 3 ; 
    $col = 12/$st_items_in_row ; 

?>

<div class="col-lg-<?php echo esc_attr($col); ?> col-md-6  col-xs-12 grid_hotel_room">
    <div class="grid">
        <figure class="effect-goliath">
        	<?php 
        		  if(has_post_thumbnail(get_the_ID())){
                        the_post_thumbnail('full' , array("class"=> "st_hotel_list_room_img"), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))));
                   }    else {
                    echo st_get_default_image();
                   } 
        	?>             
            <figcaption>
                <?php if (!empty($is_title) and $is_title =='yes') :?><h2 class="text-white full_width small"><span><?php the_title() ; ?></span></h2> <?php endif ; ?>               
                <p class="bottom_grid_ no_margin">
                	<?php if (!empty($is_facilities) and $is_facilities =='yes' ) :?>
                    <span class="block left">
	                    <?php if ($adult_number) : ?><i class="im im-children"></i> <?php echo esc_attr($adult_number) ;  endif ; ?> 
	                    <?php if ($children_number) : ?><i class="fa fa-male"></i> <?php echo esc_attr($children_number) ;  endif ; ?> 
	                    <?php if ($bed_number) : ?><i class="im im-bed"></i> <?php echo esc_attr($bed_number) ;  endif ; ?> 
	                    <?php if ($room_footage) : ?><i class="im im-width"></i> <?php echo esc_attr($room_footage) ;  endif ; ?> 
	                </span>
	            	<?php endif; ?>
                    <?php if (!empty($is_price) and $is_price =='yes') :?>
                    	<span class="right block"><?php echo TravelHelper::format_money($html_price) ;?> <?php echo __('/ day',ST_TEXTDOMAIN) ; ?> </span>
                    <?php endif; ?>
                </p>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </figcaption>
        </figure>
    </div>
</div>