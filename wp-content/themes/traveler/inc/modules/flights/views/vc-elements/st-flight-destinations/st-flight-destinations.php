<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/26/2017
 * Version: 1.0
 */

extract($atts);

if(!empty($st_ids)){
    $location_ids = explode(',', $st_ids);
    ?>
    <div class="st-flight-destination">
        <div class="row row-wrap">
            <?php
            foreach($location_ids as $key => $val){
            ?>
            <div class="<?php echo esc_attr($column); ?>">
                <div class="thumb">
                    <div class="hover-img">
                        <?php

                        if(has_post_thumbnail($val)){
                            echo get_the_post_thumbnail((int)$val, array(720,553));
                        }else{
                            echo '<img src="'.ST_TRAVELER_URI.'/inc/modules/flights/img/default.jpg'.'" alt="default">';
                        }
                        ?>
                        <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                            <div class="text-small">
                                <h5><?php echo get_the_title($val); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
<?php
}
