<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours image featured
 *
 * Created by ShineTheme
 *
 */
    if(has_post_thumbnail() and get_the_post_thumbnail()){
        the_post_thumbnail( 'full', array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))));
    }else{
        echo st_get_default_image() ;
    }
