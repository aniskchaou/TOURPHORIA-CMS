<?php
global $post;
$post_id = $post->ID;
if (!empty($post_id) && (st_check_service_available('st_hotel') || st_check_service_available('st_activity') || st_check_service_available('st_cars') || st_check_service_available('st_flight'))) {
    ?>
    <div class="stour-package">
        <div class="form-message"></div>
        <div id="stour-list-hotel">
            <div class="overlay">
                <span class="spinner is-active"></span>
            </div>
            <!-- Tab -->
            <div class="ot-metabox-tabs">
                <ul class="ot-metabox-nav">
                    <?php if(st_check_service_available('st_hotel')){ ?>
                    <li>
                        <a href="#tour-package-hotel"><?php echo __('Hotel service', ST_TEXTDOMAIN); ?></a>
                    </li>
                    <?php } ?>
                    <?php if(st_check_service_available('st_activity')){ ?>
                    <li>
                        <a href="#tour-package-activity"><?php echo __('Activity service', ST_TEXTDOMAIN); ?></a>
                    </li>
                    <?php } ?>
                    <?php if(st_check_service_available('st_cars')){ ?>
                    <li>
                        <a href="#tour-package-car"><?php echo __('Car service', ST_TEXTDOMAIN); ?></a>
                    </li>
                    <?php } ?>
                    <?php if(st_check_service_available('st_flight')){ ?>
                    <li>
                        <a href="#tour-package-flight"><?php echo __('Flight service', ST_TEXTDOMAIN); ?></a>
                    </li>
                    <?php } ?>
                </ul>
                <div class="stour-package-tab-content">
                    <?php if(st_check_service_available('st_hotel')){ ?>
                    <div id="tour-package-hotel" class="tab-content stour-tab-content">
                        <?php if (STUser_f::_check_service_available_partner('st_hotel')) { ?>
                        <input type="submit"
                               class="option-tree-ui-button button button-primary btn-load-hotel tour-package-load-hotel" name="tour-package-load-hotel"
                               value="<?php echo __('Getting Hotels By Location', ST_TEXTDOMAIN); ?>" data-post-id="<?php echo $post_id; ?>" data-type="hotel">
                        <div class="list-content">
                            <?php
                            $tour_package = get_post_meta($post_id, 'tour_packages', true);
                            $hotel_ids = [];
                            if(is_object($tour_package)){
                                if(!empty((array)$tour_package)){
                                    $i = 0;
                                    foreach ($tour_package as $k => $v){
                                        $hotel_ids[$i] = array('ID' => $v->hotel_id);
                                        $i++;
                                    }
                                }
                            }

                            if(!empty($hotel_ids)){
                                echo st()->load_template('tours/elements/stour', 'package', array('ids' => $hotel_ids, 'post_id' => $post_id));
                            }
                            ?>
                        </div>
                        <?php } ?>
                        <div class="list-custom-hotel">
                            <h4><?php echo __('Custom hotel data', ST_TEXTDOMAIN); ?></h4>
                            <?php echo st()->load_template('tours/elements/stour', 'package-custom', array('post_id' => $post_id)); ?>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if(st_check_service_available('st_activity')){ ?>
                    <div id="tour-package-activity" class="tab-content stour-tab-content">
                        <?php if (STUser_f::_check_service_available_partner('st_activity')) { ?>
                        <input type="submit"
                               class="option-tree-ui-button button button-primary btn-load-hotel tour-package-load-hotel" name="tour-package-load-hotel"
                               value="<?php echo __('Getting Activities By Location', ST_TEXTDOMAIN); ?>" data-post-id="<?php echo $post_id; ?>" data-type="activity">
                        <div class="list-content">
                            <?php
                            $tour_package_activity = get_post_meta($post_id, 'tour_packages_activity', true);
                            $activity_ids = [];
                            if(is_object($tour_package_activity)) {
                                if (!empty((array)$tour_package_activity)) {
                                    $i = 0;
                                    foreach ($tour_package_activity as $k => $v) {
                                        $activity_ids[$i] = array('ID' => $v->activity_id);
                                        $i++;
                                    }
                                }
                            }
                            if(!empty($activity_ids)){
                                echo st()->load_template('tours/elements/stour', 'package-activity', array('ids' => $activity_ids, 'post_id' => $post_id));
                            }
                            ?>
                        </div>
                        <?php } ?>
                        <div class="list-custom-hotel">
                            <h4><?php echo __('Custom activity data', ST_TEXTDOMAIN); ?></h4>
                            <?php echo st()->load_template('tours/elements/stour', 'package-custom-activity', array('post_id' => $post_id)); ?>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if(st_check_service_available('st_cars')){ ?>
                    <div id="tour-package-car" class="tab-content  stour-tab-content">
                        <?php if (STUser_f::_check_service_available_partner('st_cars')) { ?>
                        <input type="submit"
                               class="option-tree-ui-button button button-primary btn-load-hotel tour-package-load-hotel" name="tour-package-load-hotel"
                               value="<?php echo __('Getting Cars By Location', ST_TEXTDOMAIN); ?>" data-post-id="<?php echo $post_id; ?>" data-type="car">
                        <div class="list-content">
                            <?php
                            $tour_package_car = get_post_meta($post_id, 'tour_packages_car', true);
                            $car_ids = [];
                            if(is_object($tour_package_car)) {
                                if (!empty((array)$tour_package_car)) {
                                    $i = 0;
                                    foreach ($tour_package_car as $k => $v) {
                                        $car_ids[$i] = array('ID' => $v->car_id);
                                        $i++;
                                    }
                                }
                            }
                            if(!empty($car_ids)){
                                echo st()->load_template('tours/elements/stour', 'package-car', array('ids' => $car_ids, 'post_id' => $post_id));
                            }
                            ?>
                        </div>
                        <?php } ?>
                        <div class="list-custom-hotel">
                            <h4><?php echo __('Custom car data', ST_TEXTDOMAIN); ?></h4>
                            <?php echo st()->load_template('tours/elements/stour', 'package-custom-car', array('post_id' => $post_id)); ?>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if(st_check_service_available('st_flight')){ ?>
                    <div id="tour-package-flight" class="tab-content stour-tab-content">
		                <?php if (STUser_f::_check_service_available_partner('st_flight')) { ?>
                            <input type="submit"
                                   class="option-tree-ui-button button button-primary btn-load-hotel tour-package-load-hotel" name="tour-package-load-hotel"
                                   value="<?php echo __('Getting Flight', ST_TEXTDOMAIN); ?>" data-post-id="<?php echo $post_id; ?>" data-type="flight">
                            <div class="list-content">
				                <?php
				                $tour_package = get_post_meta($post_id, 'tour_packages_flight', true);
				                $hotel_ids = [];
				                if(is_object($tour_package)){
					                if(!empty((array)$tour_package)){
						                $i = 0;
						                foreach ($tour_package as $k => $v){
							                $hotel_ids[$i] = array('ID' => $v->flight_id);
							                $i++;
						                }
					                }
				                }

				                if(!empty($hotel_ids)){
					                echo st()->load_template('tours/elements/stour', 'package-flight', array('ids' => $hotel_ids, 'post_id' => $post_id));
				                }
				                ?>
                            </div>
		                <?php } ?>
                        <div class="list-custom-hotel">
                            <h4><?php echo __('Custom flight data', ST_TEXTDOMAIN); ?></h4>
			                <?php echo st()->load_template('tours/elements/stour', 'package-custom-flight', array('post_id' => $post_id)); ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- End Tab -->
            <input type="submit" id="tour-package-save-hotel"
                   class="option-tree-ui-button button button-primary stour-package-button" name="tour-package-save-hotel"
                   data-post-id="<?php echo $post_id; ?>"
                   value="<?php echo __('Save data', ST_TEXTDOMAIN); ?>">
        </div>
    </div>
    <?php
} else {
    echo __('No services are enabled for this function!', ST_TEXTDOMAIN);
}
?>
