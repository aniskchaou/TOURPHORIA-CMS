<?php
while(have_posts()):
    the_post();?>
    <ul class="booking-list">
        <li>
            <a href="<?php the_permalink() ?>">
                <?php echo STFeatured::get_featured(); ?>
                <div class="booking-item booking-item-small">
                    <div class="row">
                        <div class="col-xs-4 st_avatar_service">
                            <?php
                            $img = get_the_post_thumbnail( get_the_ID() , array(70,60,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( )))) ;
                            if(!empty($img)){
                                echo balanceTags($img);
                            }else{
                                echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.bfi_thumb(ST_TRAVELER_URI.'/img/no-image.png',array('width'=>800,'height'=>600)).'">';
                            }
                            ?>
                            <?php echo st_get_avatar_in_list_service(get_the_ID(),35); ?>
                        </div>
                        <div class="col-xs-5">
                            <h5 class="booking-item-title"><?php the_title() ?></h5>
                            <?php
                            $view_star_review = st()->get_option('view_star_review', 'review');
                            if($view_star_review == 'review') :
                                ?>
                                <ul class="icon-group booking-item-rating-stars">
                                    <?php
                                    $avg = STReview::get_avg_rate();
                                    echo TravelHelper::rate_to_string($avg);
                                    ?>
                                </ul>
                            <?php elseif($view_star_review == 'star'): ?>
                                <ul class="icon-group booking-item-rating-stars">
                                    <?php
                                    $star = STHotel::getStar();
                                    echo  TravelHelper::rate_to_string($star);
                                    ?>
                                </ul>
                            <?php endif;  ?>
                        </div>
                        <?php
                        $price=0;
                        $price = STHotel::get_price();

                        ?>
                        <div class="col-xs-3">
                            <span class="booking-item-price-from">

                                <?php
                                if(STHotel::is_show_min_price()){
                                    _e('price from',ST_TEXTDOMAIN);
                                }else{
                                    _e('price avg',ST_TEXTDOMAIN);
                                }
                                ?>

                            </span>
                            <span class="booking-item-price"><?php echo TravelHelper::format_money( $price )?></span>
                        </div>
                    </div>
                </div>
            </a>
        </li>
    </ul>

<?php endwhile; ?>