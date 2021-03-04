<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity element image featured
 *
 * Created by ShineTheme
 *
 */
    if(has_post_thumbnail()){
        the_post_thumbnail( array( 1024, 420, 'bfi_thumb' => true, array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( get_the_ID() ))) ) );
    }else{
        echo st_get_default_image() ;
    }