<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 4/10/2019
 * Time: 8:49 AM
 */
?>
<!-- Tour Package -->
<div id="package_tab">
    <div class="stour-package">
        <div class="form-message"></div>
        <input type="hidden" id="stour-no-location" value="<?php echo __('Please select location or put address value', ST_TEXTDOMAIN); ?>" />
        <div id="stour-list-hotel">
            <div class="overlay-form" style="display: none;"><i class="fa fa-refresh text-color"></i></div>
            <div class="panel-group stour-package-user" id="accordion" role="tablist"
                 aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseHotel" aria-expanded="true"
                               aria-controls="collapseHotel">
                                <?php echo __('Hotel Service', ST_TEXTDOMAIN); ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseHotel" class="panel-collapse collapse in"
                         role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div id="tour-package-hotel"
                                 class="tab-content stour-tab-content">
                                <?php if (STUser_f::_check_service_available_partner('st_hotel')) { ?>
                                    <input type="submit"
                                           class="option-tree-ui-button button button-primary btn-load-hotel tour-package-load-hotel btn btn-primary btn-sm"
                                           name="tour-package-load-hotel"
                                           value="<?php echo __('Getting Hotels By Location', ST_TEXTDOMAIN); ?>"
                                           data-post-id="<?php echo esc_attr($post_id); ?>"
                                           data-type="hotel">
                                    <div class="list-content">
                                        <?php
                                        $tour_package = get_post_meta($post_id, 'tour_packages', true);
                                        $hotel_ids = [];
                                        if (is_object($tour_package)) {
                                            if (!empty((array)$tour_package)) {
                                                $i = 0;
                                                foreach ($tour_package as $k => $v) {
                                                    $hotel_ids[$i] = array('ID' => $v->hotel_id);
                                                    $i++;
                                                }
                                            }
                                        }

                                        if (!empty($hotel_ids)) {
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
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse"
                               data-parent="#accordion" href="#collapseTwo"
                               aria-expanded="false" aria-controls="collapseTwo">
                                <?php echo __('Activity Service', ST_TEXTDOMAIN); ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <div id="tour-package-activity" class="tab-content stour-tab-content">
                                <?php if (STUser_f::_check_service_available_partner('st_activity')) { ?>
                                    <input type="submit"
                                           class="option-tree-ui-button button button-primary btn-load-hotel tour-package-load-hotel btn btn-primary btn-sm" name="tour-package-load-hotel"
                                           value="<?php echo __('Getting Activities By Location', ST_TEXTDOMAIN); ?>" data-post-id="<?php echo esc_attr($post_id); ?>" data-type="activity">
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
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse"
                               data-parent="#accordion" href="#collapseThree"
                               aria-expanded="false" aria-controls="collapseThree">
                                <?php echo __('Car Service', ST_TEXTDOMAIN); ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingThree">
                        <div class="panel-body">
                            <div id="tour-package-car" class="tab-content  stour-tab-content">
                                <?php if (STUser_f::_check_service_available_partner('st_cars')) { ?>
                                    <input type="submit"
                                           class="option-tree-ui-button button button-primary btn-load-hotel tour-package-load-hotel btn btn-primary btn-sm" name="tour-package-load-hotel"
                                           value="<?php echo __('Getting Cars By Location', ST_TEXTDOMAIN); ?>" data-post-id="<?php echo esc_attr($post_id); ?>" data-type="car">
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
                        </div>
                    </div>
                </div>

                <!--Flight service-->
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse"
                               data-parent="#accordion" href="#collapseFour"
                               aria-expanded="false" aria-controls="collapseFour">
                                <?php echo __('Flight Service', ST_TEXTDOMAIN); ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingFour">
                        <div class="panel-body">
                            <div id="tour-package-flight" class="tab-content  stour-tab-content">
                                <?php if (STUser_f::_check_service_available_partner('st_flight')) { ?>
                                    <input type="submit"
                                           class="option-tree-ui-button button button-primary btn-load-hotel tour-package-load-hotel btn btn-primary btn-sm"
                                           name="tour-package-load-hotel"
                                           value="<?php echo __('Getting Flight', ST_TEXTDOMAIN); ?>"
                                           data-post-id="<?php echo esc_attr($post_id); ?>"
                                           data-type="flight">
                                    <div class="list-content">
                                        <?php
                                        $tour_package = get_post_meta($post_id, 'tour_packages_flight', true);
                                        $hotel_ids = [];
                                        if (is_object($tour_package)) {
                                            if (!empty((array)$tour_package)) {
                                                $i = 0;
                                                foreach ($tour_package as $k => $v) {
                                                    $hotel_ids[$i] = array('ID' => $v->flight_id);
                                                    $i++;
                                                }
                                            }
                                        }

                                        if (!empty($hotel_ids)) {
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
                        </div>
                    </div>
                </div>
                <!--End Flight service-->

            </div>
            <input type="submit" id="tour-package-save-hotel"
                   class="option-tree-ui-button button button-primary stour-package-button btn btn-primary btn-sm" name="tour-package-save-hotel"
                   data-post-id="<?php echo esc_attr($post_id); ?>"
                   value="<?php echo __('Save Tour Packages', ST_TEXTDOMAIN); ?>">
        </div>
    </div>
</div>
<!-- Tour Package -->
