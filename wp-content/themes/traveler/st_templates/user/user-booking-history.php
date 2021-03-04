<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User booking history
 *
 * Created by ShineTheme
 *
 */
$class_user = new STUser_f();
?>
<div class="st-create">
    <h2><?php STUser_f::get_title_account_setting() ?></h2>
</div>
<?php echo STTemplate::message()?>
<?php
$html_all = $class_user->get_book_history('');
$data_order_statuses = STUser_f::_get_order_statuses();
?>
<div class="infor-st-setting">
    <div class="tabbable">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#tab-all" data-toggle="tab"><?php _e("All",ST_TEXTDOMAIN) ?></a></li>
            <?php
            if(!empty($data_order_statuses)){
                foreach($data_order_statuses as $k=>$v){
                    ?>
                    <li><a href="#tab-<?php echo esc_html($k) ?>" data-toggle="tab"><?php echo esc_html($v) ?></a></li>
                <?php
                }
            }
            ?>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-all">
                <?php
                if(!empty($html_all)){?>
                    <table class="table table-bordered table-striped table-booking-history">
                        <thead>
                            <tr>
                                <th><?php st_the_language('user_type')?></th>
                                <th class="hidden-xs"><?php echo __('#ID',ST_TEXTDOMAIN ); ?></th>
                                <th><?php st_the_language('user_title')?></th>
                                <th class="hidden-xs"><?php st_the_language('user_order_date')?></th>
                                <th class="hidden-xs"><?php st_the_language('user_execution_date') ?></th>
                                <th><?php st_the_language('user_cost') ?></th>
                                <th class="hidden-xs"><?php _e("Status",ST_TEXTDOMAIN) ?></th>
                                <th><?php st_the_language('action') ?></th>
                            </tr>
                        </thead>
                        <tbody id="data_history_book">
                        <?php
                        echo balanceTags($html_all);
                        ?>
                        </tbody>
                    </table>
                    <span class="btn btn-primary btn_load_his_book" data-per="2" data-type=""><?php st_the_language('user_load_more') ?></span>
                <?php
                }else{
                    echo '<p class="no-booking-his">'.st_the_language('user_no_booking_history').'</p>';
                } ?>
            </div>
            <?php
            if(!empty($data_order_statuses)){
                foreach($data_order_statuses as $k=>$v){
                    $html = $class_user->get_book_history($k);
                    ?>
                    <div class="tab-pane fade" id="tab-<?php echo esc_html($k) ?>">
                        <?php
                        if(!empty($html)){?>
                            <table class="table table-bordered table-striped table-booking-history">
                                <thead>
                                <tr>
                                    <th><?php st_the_language('user_type')?></th>
                                    <th class="hidden-xs"><?php echo __('#ID',ST_TEXTDOMAIN ); ?></th>
                                    <th><?php st_the_language('user_title')?></th>
                                    <th class="hidden-xs"><?php st_the_language('user_order_date')?></th>
                                    <th class="hidden-xs"><?php st_the_language('user_execution_date') ?></th>
                                    <th><?php st_the_language('user_cost') ?></th>
                                    <th class="hidden-xs"><?php _e("Status",ST_TEXTDOMAIN) ?></th>
                                    <th><?php st_the_language('action') ?></th>
                                </tr>
                                </thead>
                                <tbody id="data_history_book">
                                <?php
                                echo balanceTags($html);
                                ?>
                                </tbody>
                            </table>
                            <span class="btn btn-primary btn_load_his_book" data-per="2" data-type="<?php echo esc_html($k) ?>"><?php st_the_language('user_load_more') ?></span>
                        <?php
                        }else{
                            echo '<p class="no-booking-his">'.st_the_language('user_no_booking_history').'</p>';
                        } ?>
                    </div>
                <?php
                }
            }
            ?>
        </div>
    </div>
</div>


<!-- Modal cancel booking -->

<div class="modal fade modal-cancel-booking" id="cancel-booking-modal" tabindex="-1" role="dialog" aria-labelledby="cancelBookingLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo __('Close', ST_TEXTDOMAIN); ?>"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="cancelBookingLabel"><?php echo __('Cancel Booking Information', ST_TEXTDOMAIN); ?></h4>
            </div>
            <div class="modal-body">
                <div style="display: none;" class="overlay-form"><i class="fa fa-spinner text-color"></i></div>
                <div class="modal-content-inner">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button id="" type="button" class="next btn btn-primary hidden"><?php echo __('Next', ST_TEXTDOMAIN); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-cancel-booking modal-info-booking" id="info-booking-modal" tabindex="-1" role="dialog" aria-labelledby="cancelBookingLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo __('Close', ST_TEXTDOMAIN); ?>"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="cancelBookingLabel"><?php echo __('Booking Details', ST_TEXTDOMAIN); ?></h4>
            </div>
            <div class="modal-body">
                <div style="display: none;" class="overlay-form"><i class="fa fa-spinner text-color"></i></div>
                <div class="modal-content-inner"></div>
            </div>
        </div>
    </div>
</div>