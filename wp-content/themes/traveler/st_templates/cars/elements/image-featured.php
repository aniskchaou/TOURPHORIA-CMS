<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars element image featured
 *
 * Created by ShineTheme
 *
 */
?>
<div class="hover-img st_lazy_load" style="overflow: initial;">
    <?php
    /*if(has_post_thumbnail() and get_the_post_thumbnail()){
        the_post_thumbnail( array( 273, 137, 'bfi_thumb' => true ), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id(get_the_ID() ))) );
    }else{
        echo st_get_default_image() ;
    }*/
    TravelHelper::getLazyLoadingImage(array( 273, 137, 'bfi_thumb' => true ));
    ?>
</div>
