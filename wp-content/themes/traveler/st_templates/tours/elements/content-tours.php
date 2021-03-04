<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours content
 *
 * Created by ShineTheme
 *
 */
while(have_posts()){
    the_post();
    echo apply_filters('the_content' , get_the_content());
    // don't change . fix visual composer tab confict the_content()
}
