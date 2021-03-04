<?php wp_enqueue_script('magnific.js' ); ?>
<div class="div_item_map <?php echo 'div_map_item_'.get_the_ID() ?>">
    <?php
    $link = st_get_link_with_search(get_permalink(), array('start', 'end', 'room_num_search', 'adult_number','children_num'), $_GET);
    $thumb_obj= $data['featured'];
    ?>
    <div class="thumb item_map">
        <header class="thumb-header">
            <div class="booking-item-img-wrap st-popup-gallery">
                <a href="<?php echo (!empty($thumb_obj[0]))?$thumb_obj[0]:'#' ?>" class="st-gp-item">
                     <?php 
                    if(!empty( $data['featured'])){
                        echo '<img alt="'.TravelHelper::get_alt_image().'" class="img-responsive" src="'. esc_url( $data['featured'] ).'">';
                    }else {
                        echo st_get_default_image();
                    }
                    ?>
                </a>
            </div>
        </header>
        <div class="thumb-caption">
            <h5 class="thumb-title"><a class="text-darken" href="javascript: void(0);"><?php echo esc_html($data['name']); ?></a></h5>
            <div>
                <?php echo ($data['description']); ?>
            </div>
            <div class="clearfix">
                <button class="btn btn-default pull-right close_map" onclick="closeGmapThumbItem(this)" ><?php _e("Close",ST_TEXTDOMAIN) ?></button>
            </div>
        </div>
    </div>
</div>
