<?php $room_alone_search_page = get_permalink(st()->get_option('st_hotel_alone_room_search_page'));?>
<section class="st-filter">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="filter-search">
                    <form action="<?php echo esc_url($room_alone_search_page); ?>" class="template-hotel-activity_submit" method="get" accept-charset="utf-8">
                        <div class="row-5">
                            <?php
                                $picker_style = ( isset( $picker_style ) ) ? $picker_style : '';
                                $date_now     = current_time( 'timestamp' );
                                $date_next    = strtotime( '+1 day', $date_now );
                                $check_in     = STInput::get( 'checkin_y' ) . "-" . STInput::get( 'checkin_m' ) . "-" . STInput::get( 'checkin_d' );
                                if ( $check_in == '--' ) $check_in = ''; else$check_in = date( TravelHelper::getDateFormat(), strtotime( $check_in ) );
                                if ( empty( $check_in ) ) {
                                    $check_in = date( TravelHelper::getDateFormat() );
                                }

                                $check_out = STInput::get( 'checkout_y' ) . "-" . STInput::get( 'checkout_m' ) . "-" . STInput::get( 'checkout_d' );
                                if ( $check_out == '--' ) $check_out = ''; else$check_out = date( TravelHelper::getDateFormat(), strtotime( $check_out ) );
                                if ( empty( $check_out ) ) {
                                    $check_out = date( TravelHelper::getDateFormat(), strtotime( '+1 day', strtotime( date( 'Y-m-d' ) ) ) );
                                }
                                $check_in_out = current_time( TravelHelper::getDateFormat() ) . '-' . date( TravelHelper::getDateFormat(), strtotime( '+1 day', current_time( 'timestamp' ) ) );

                                $id = 'check-in-out_' . rand( 0, time() );
                            ?>
                            <div class="col5 col6">
                                <div class="choose-date">
                                    <label><?php echo __('Check In', ST_TEXTDOMAIN); ?></label>
                                    <div class="item-search-content">
                                        <div class="options">
                                            <div class="day">
                                                <span><?php echo date('d');?></span>
                                            </div>
                                            <div class="month-year">
                                                <span><?php echo date('F, Y');?></span>
                                            </div>
                                        </div>
                                        <input type="hidden" class="checkin_d" name="checkin_d" value="<?php echo STInput::get( 'checkin_d', date( 'j', $date_now ) ) ?>"/>
                                        <input type="hidden" class="checkin_m" name="checkin_m" value="<?php echo STInput::get( 'checkin_m', date( 'n', $date_now ) ) ?>"/>
                                        <input type="hidden" class="checkin_y" name="checkin_y" value="<?php echo STInput::get( 'checkin_y', date( 'Y', $date_now ) ) ?>"/>
                                        <input type="hidden" name="check_in" class="wpbooking-date-start helios-input wb-" readonly value="<?php echo esc_html( $check_in ) ?>">
                                        <input class="wpbooking-check-in-out <?php echo esc_attr( $picker_style ); ?>"
                                               data-custom-class="<?php echo esc_attr( $picker_style ); ?>" type="text" name="check_in_out" value="<?php echo esc_html( STInput::get( 'check_in_out', $check_in_out ) ); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col5 col6">
                                <div class="choose-date">
                                    <label><?php echo __('Check Out', ST_TEXTDOMAIN); ?></label>
                                    <div class="item-search-content">
                                        <div class="options">
                                            <div class="day">
                                                <span><?php echo (date('d')+1);?></span>
                                            </div>
                                            <div class="month-year">
                                                <span><?php echo date('F, Y');?></span>
                                            </div>
                                        </div>
                                        <input type="hidden" class="checkout_d" name="checkout_d" value="<?php echo STInput::get( 'checkout_d', date( 'j', $date_next ) ) ?>"/>
                                        <input type="hidden" class="checkout_m" name="checkout_m" value="<?php echo STInput::get( 'checkout_m', date( 'n', $date_next ) ) ?>"/>
                                        <input type="hidden" class="checkout_y" name="checkout_y" value="<?php echo STInput::get( 'checkout_y', date( 'Y', $date_next ) ) ?>"/>
                                        <input type="text" name="check_out" class="wpbooking-date-end helios-input" readonly value="<?php echo esc_html( $check_out ) ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col5 col6">
                                <div class="choose-date">
                                    <label><?php echo __('Number', ST_TEXTDOMAIN); ?></label>
                                    <div class="item-search-content">
                                        <div class="st-number">
                                            <div class="adult">
                                                <span class="minus"><?php echo TravelHelper::getNewIcon('ico_subtract', '#ddddd', '16px', '16px'); ?></span>
                                                <?php
                                                $adult_num_search = STInput::get('adult_num_search', 1);
                                                $max_adult = ST_Single_Hotel::inst()->getMaxPeopleSearchForm();

                                                if($adult_num_search > $max_adult)
                                                    $adult_num_search = $max_adult;

                                                if($adult_num_search < 1)
                                                    $adult_num_search = 1;
                                                ?>
                                                <strong class="num"><?php echo esc_attr($adult_num_search); ?></strong>
                                                <input type="hidden" name="adult_num_search" value="<?php echo esc_attr($adult_num_search); ?>" class="form-control st-input-number" autocomplete="off" readonly="" data-min="<?php echo esc_attr($adult_num_search); ?>" data-max="<?php echo $max_adult; ?>">
                                                <span class="plus"><?php echo TravelHelper::getNewIcon('ico_add', '#ddddd', '16px', '16px'); ?></span>
                                            </div>
                                            <div class="type-person">
                                                <span><?php echo __('Adults', ST_TEXTDOMAIN); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col5 col6">
                                <div class="choose-date">
                                    <label><?php echo __('Number', ST_TEXTDOMAIN); ?></label>
                                    <div class="item-search-content">
                                        <div class="st-number">
                                            <div class="adult">
                                                <span class="minus"><?php echo TravelHelper::getNewIcon('ico_subtract', '#ddddd', '16px', '16px'); ?></span>
                                                 <?php
                                                $children_num_search = STInput::get('children_num_search', 0);
                                                $max_child = ST_Single_Hotel::inst()->getMaxPeopleSearchForm('child');
                                                if($children_num_search > $max_child)
                                                    $children_num_search = $max_child;

                                                if($children_num_search < 0)
                                                    $children_num_search = 0;
                                                ?>
                                                <strong class="num"><?php echo esc_attr($children_num_search); ?></strong>
                                                <input type="hidden" name="children_num_search" value="<?php echo esc_attr($children_num_search); ?>" class="form-control st-input-number" autocomplete="off" readonly="" data-min="<?php echo esc_attr($children_num_search); ?>" data-max="<?php echo $max_child; ?>">
                                                <span class="plus"><?php echo TravelHelper::getNewIcon('ico_add', '#ddddd', '16px', '16px'); ?></span>
                                            </div>
                                            <div class="type-person">
                                                <span><?php echo __('Children', ST_TEXTDOMAIN); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col5 col12">
                                <div class="control">
                                    <button class="btn btn-primary"><?php echo __('CHECK <br> AVAILABILITY', ST_TEXTDOMAIN); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
    </div>
</section>