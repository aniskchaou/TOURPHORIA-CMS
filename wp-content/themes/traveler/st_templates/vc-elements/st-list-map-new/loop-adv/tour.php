<?php
$tours = new STTour();
$link=st_get_link_with_search(get_permalink(),array('start','end','duration','people'),$_GET);
?>
<div class="">
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <header class="thumb-header">
            <?php if(!empty( $count_sale )) { ?>
                <?php STFeatured::get_sale($count_sale); ?>
            <?php } ?>
            <a href="<?php echo esc_url($link) ?>" class="hover-img">
                <?php
                $img = get_the_post_thumbnail( get_the_ID() , array( 800 , 600 , 'bfi_thumb' => true ), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))) );
                if(!empty( $img )) {
                    echo balanceTags( $img );
                } else {
                    echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="' . bfi_thumb( ST_TRAVELER_URI . '/img/no-image.png' , array(
                            'width'  => 800 ,
                            'height' => 600
                        ) ) . '">';
                }
                ?>
                <h5 class="hover-title hover-hold">
                    <?php the_title(); ?>
                </h5>
            </a>
        </header>
        <div class="thumb-caption">
            <div class="row mt10">
                <div class="col-md-5 col-sm-5 col-xs-5">
                    <i class="fa fa-map-marker"> &nbsp;</i>
                    <?php $address = get_post_meta( get_the_ID() , 'address' , true ); ?>
                    <?php
                    if(!empty( $address )) {
                        echo esc_html( $address );
                    }
                    ?>
                </div>
                <div class="col-md-7 col-sm-7 col-xs-7 text-right">
                    <div class="package-info">
                        <i class="fa fa-calendar">&nbsp;</i>
                        <span class=""><?php esc_html_e('Date','traveler')?>: </span>
                        <?php
                        $type_tour = get_post_meta( get_the_ID() , 'type_tour' , true );
                        if($type_tour == 'daily_tour') {
                            $day = STTour::get_duration_unit();
                            echo esc_html( $day );
                        } else {
                            $check_in  = get_post_meta( get_the_ID() , 'check_in' , true );
                            $check_out = get_post_meta( get_the_ID() , 'check_out' , true );
                            if(!empty( $check_in ) and !empty( $check_out )) {
                                $date = date_i18n( TravelHelper::getDateFormat() , strtotime($check_in) ) . ' <i class="fa fa-long-arrow-right"></i> ' . date_i18n( TravelHelper::getDateFormat() , strtotime($check_out ));
                                echo balanceTags( $date );
                            } else {
                                esc_html_e('none','traveler');
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
            <div class="row mt10">
                <div class="col-md-6 col-sm-6 col-xs-6">
                   <p class="mb0 text-darken">
                       <i class="fa fa-money">&nbsp;</i>
                       <?php _e( 'Price' , ST_TEXTDOMAIN ) ?>:
                      <span> <?php echo STTour::get_price_html( false , false , ' <br> -' ); ?></span>
                   </p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                    <i class="fa fa-thumbs-o-up icon-like"> &nbsp;</i>
                    <ul class="icon-group  text-color pull-right">
                        <?php echo TravelHelper::rate_to_string( STReview::get_avg_rate() ); ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <div class="gap"></div>
</div>

