<?php
wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' ); 

$current_user = wp_get_current_user();
$user_id = $current_user->ID;
//$info = STUser_f::st_get_data_reports_partner(array('st_cars','st_hotel'),'10-9-2015','20-9-2015');
$_custom_date = STUser_f::get_custom_date_reports_partner();
$request_custom_date = STUser_f::get_request_custom_date_partner();
$custom_layout = st()->get_option('partner_custom_layout','off');
$custom_layout_total_earning = st()->get_option('partner_custom_layout_total_earning','on');
$custom_layout_service = st()->get_option('partner_custom_layout_service_earning','on');
$custom_layout_chart_info = st()->get_option('partner_custom_layout_chart_info','on');
if($custom_layout == "off"){
    $custom_layout_total_earning = $custom_layout_service = $custom_layout_chart_info = "on";
}

$total_earning = STUser_f::st_get_data_reports_total_all_time_partner();
$total_price_payout = STAdminWithdrawal::_get_total_price_payout($user_id);
$your_balance = $total_earning['average_total'] - $total_price_payout;

$currency = TravelHelper::get_current_currency('symbol');
?>
<?php if($custom_layout_total_earning == "on"){ ?>
    <div class="row div-partner-page-title">
        <div class="col-md-7">
            <h3 class="partner-page-title">
                <?php _e("Dashboard",ST_TEXTDOMAIN) ?>
            </h3>
        </div>
        
    </div>
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-4 item-st-month">
            <?php
            $start  = $_custom_date['y'].'-'.$_custom_date['m'].'-1';
            $end  = $_custom_date['y'].'-'.$_custom_date['m'].'-31';
            
            $this_month = STUser_f::st_get_data_reports_partner('all','custom_date',$start,$end);
            ?>
            <div class="st-dashboard-stat st-month-madison st-dashboard-new st-month-1">
                <div class="st-wrap-box">
                    <div class="title">
                        <?php _e("Net Earning This Month",ST_TEXTDOMAIN) ?>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            if($this_month['average_total'] > 0){
                                
                                echo TravelHelper::format_money_raw($this_month['average_total'], $currency);
                            }else{
                                echo "0";
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 item-st-month">
            <div class="st-dashboard-stat st-month-madison st-dashboard-new st-month-2">
                 <div class="st-wrap-box">
                    <div class="title">
                        <?php _e("Your Balance",ST_TEXTDOMAIN) ?>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            if($your_balance){
                                
                                echo TravelHelper::format_money_raw($your_balance, $currency) ;
                            }else{
                                echo "0";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 item-st-month">
            <?php
            //$total_earning = STUser_f::st_get_data_reports_total_earning_partner();
            ?>
            <div class="st-dashboard-stat st-month-madison st-dashboard-new st-month-3">
                <div class="st-wrap-box">
                    <div class="title">
                        <?php _e("Earning",ST_TEXTDOMAIN) ?>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            if(!empty($total_earning['total']) and $total_earning['total'] > 0){
                                
                                echo TravelHelper::format_money_raw($total_earning['total'], $currency) ;
                            }else{
                                echo "0";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }?>
<?php if($custom_layout_service == "on"){ ?>
    <!-- <div class="head_reports bg-warning">
        <div class="head_control">
            <div class="head_time">
                <span><?php
                    echo sprintf( __('Sales Earning %s for each service',ST_TEXTDOMAIN) ,$request_custom_date['title'])
                    ?></span>
            </div>
        </div>
    </div> -->
    <?php
    if($request_custom_date['type'] == 'all_time'){
        $this_data_custom = $total_earning;
    }else{
        $this_data_custom = STUser_f::st_get_data_reports_partner('all','custom_date',$request_custom_date['start'],$request_custom_date['end']);
    }
    ?>
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-12 item-st-month">
            <div class="st-dashboard-stat head_reports bg-warning">
                <div class="head_control">
                    <div class="head_time">
                        <span><?php
                            echo sprintf( __('Sales Earning %s for each service',ST_TEXTDOMAIN) ,$request_custom_date['title'])
                            ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 item-st-month padding-15">
            <div class="st-dashboard-stat head_reports list-st">
                <?php if (STUser_f::_check_service_available_partner('st_hotel')):?>
                    <div class="col-md-4 st-bg-dashboard">
                        <div class="panel panel-primary panel-st_hotel panel-single">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <div class="title"><?php _e("Hotel",ST_TEXTDOMAIN) ?></div>
                                        <div class="huge">
                                            <?php
                                            $price = (float)$this_data_custom['post_type']['st_hotel']['average_total'];
                                            if(empty($price)){
                                                echo esc_html($price);
                                            }else{
                                                echo TravelHelper::format_money_raw($price, $currency);
                                            }?>
                                        </div>
                                        <div class="st_view">
                                            <a href="<?php echo  esc_url( add_query_arg( array('sc'=>'dashboard-info','type'=>'st_hotel') , get_the_permalink() ) ) ?>"><span class="pull-right"><img src="<?php echo get_template_directory_uri().'/v2/images/dashboard/ico_arrow_3.svg'; ?>"</span></a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <?php if (STUser_f::_check_service_available_partner('st_hotel')):?>
                    <div class="col-md-4 st-bg-dashboard">
                        <div class="panel panel-primary panel-st_hotel panel-single">
                            <div class="panel-heading red-st">
                                <div class="row">
                                    <div class="col-xs-12 text-right">
                                        <div class="title"><?php _e("Room",ST_TEXTDOMAIN) ?></div>
                                        <div class="huge">
                                            <?php
                                            $price = $this_data_custom['post_type']['hotel_room']['average_total'];
                                            if(empty($price)){
                                                echo esc_html($price);
                                            }else{
                                                echo TravelHelper::format_money_raw($price, $currency);
                                            }?>
                                        </div>
                                        <div class="st_view">
                                            <a href="<?php echo  esc_url( add_query_arg( array('sc'=>'dashboard-info','type'=>'hotel_room') , get_the_permalink() ) ) ?>">
                                                <span class="pull-right"><img src="<?php echo get_template_directory_uri().'/v2/images/dashboard/ico_arrow_3.svg'; ?>" ></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                 <?php if (STUser_f::_check_service_available_partner('st_tours')):?>
                    <div class="col-md-4 st-bg-dashboard">
                        <div class="panel panel-primary panel-st_tours panel-single">
                            <div class="panel-heading green-st">
                                <div class="row">
                                    <div class="col-xs-12 text-right">
                                        <div class="title"><?php _e("Tour",ST_TEXTDOMAIN) ?></div>
                                        <div class="huge">
                                            <?php
                                            $price = $this_data_custom['post_type']['st_tours']['average_total'];
                                            if(empty($price)){
                                                echo esc_html($price);
                                            }else{
                                                echo TravelHelper::format_money_raw($price, $currency);
                                            }?>
                                        </div>
                                        <div class="st_view">
                                            <a href="<?php echo  esc_url( add_query_arg( array('sc'=>'dashboard-info','type'=>'st_tours') , get_the_permalink() ) ) ?>">
                                                <span class="pull-right"><img src="<?php echo get_template_directory_uri().'/v2/images/dashboard/ico_arrow_3.svg'; ?>"</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <?php if (STUser_f::_check_service_available_partner('st_activity')):?>
                    <div class="col-md-4 st-bg-dashboard">
                        <div class="panel panel-primary panel-st_activity panel-single">
                            <div class="panel-heading st-yellow">
                                <div class="row">
                                    <div class="col-xs-12 text-right">
                                        <div class="title"><?php _e("Activity",ST_TEXTDOMAIN) ?></div>
                                        <div class="huge">
                                            <?php
                                            $price = $this_data_custom['post_type']['st_activity']['average_total'];
                                            if(empty($price)){
                                                echo esc_html($price);
                                            }else{
                                                echo TravelHelper::format_money_raw($price, $currency);
                                            }?>
                                        </div>
                                        <div class="st_view">
                                            <a href="<?php echo  esc_url( add_query_arg( array('sc'=>'dashboard-info','type'=>'st_activity') , get_the_permalink() ) ) ?>">
                                                <span class="pull-right"><img src="<?php echo get_template_directory_uri().'/v2/images/dashboard/ico_arrow_3.svg'; ?>"</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;?>

                <?php if (STUser_f::_check_service_available_partner('st_rental')):?>
                    <div class="col-md-4 st-bg-dashboard">
                        <div class="panel panel-primary panel-st_rental panel-single">
                            <div class="panel-heading turquoise-st">
                                <div class="row">
                                    <div class="col-xs-12 text-right">
                                        <div class="title"><?php _e("Rental",ST_TEXTDOMAIN) ?></div>
                                        <div class="huge">
                                            <?php
                                            $price = $this_data_custom['post_type']['st_rental']['average_total'];
                                            if(empty($price)){
                                                echo esc_html($price);
                                            }else{
                                                echo TravelHelper::format_money_raw($price, $currency);
                                            }?>
                                        </div>
                                        <div class="st_view">
                                            <a href="<?php echo  esc_url( add_query_arg( array('sc'=>'dashboard-info','type'=>'st_rental') , get_the_permalink() ) ) ?>">
                                                <span class="pull-right"><img src="<?php echo get_template_directory_uri().'/v2/images/dashboard/ico_arrow_3.svg'; ?>"</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <?php if (STUser_f::_check_service_available_partner('st_flight')):?>
                    <div class="col-md-4 st-bg-dashboard">
                        <div class="panel panel-primary panel-st_flight panel-single">
                            <div class="panel-heading st-violet">
                                <div class="row">
                                    <div class="col-xs-12 text-right">
                                        <div class="title"><?php _e("Flight",ST_TEXTDOMAIN) ?></div>
                                        <div class="huge">
                                            <?php
                                            $price = $this_data_custom['post_type']['st_flight']['average_total'];
                                            if(empty($price)){
                                                echo esc_html($price);
                                            }else{
                                                echo TravelHelper::format_money_raw($price, $currency);
                                            }?>
                                        </div>
                                        <div class="st_view">
                                            <a href="<?php echo  esc_url( add_query_arg( array('sc'=>'dashboard-info','type'=>'st_flight') , get_the_permalink() ) ) ?>">
                                                <span class="pull-right"><img src="<?php echo get_template_directory_uri().'/v2/images/dashboard/ico_arrow_3.svg'; ?>"</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <?php if (STUser_f::_check_service_available_partner('st_cars')):?>
                    <div class="col-md-4 st-bg-dashboard">
                        <div class="panel panel-primary panel-st_cars panel-single">
                            <div class="panel-heading st-black">
                                <div class="row">
                                    <div class="col-xs-12 text-right">
                                        <div class="title"><?php _e("Car",ST_TEXTDOMAIN) ?></div>
                                        <div class="huge">
                                            <?php
                                            $price = $this_data_custom['post_type']['st_cars']['average_total'];
                                            if(empty($price)){
                                                echo esc_html($price);
                                            }else{
                                                echo TravelHelper::format_money_raw($price, $currency);
                                            }?>
                                        </div>
                                        <div class="st_view">
                                            <a href="<?php echo  esc_url( add_query_arg( array('sc'=>'dashboard-info','type'=>'st_cars') , get_the_permalink() ) ) ?>">
                                                <span class="pull-right"><img src="<?php echo get_template_directory_uri().'/v2/images/dashboard/ico_arrow_3.svg'; ?>"</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;?>               
            </div>
        </div>
    </div>
<?php } ?>
<div class="infor-st-setting">
    <div class="st-filter_time_dashboard">
        <div  class="btn btn-sm btn-default pull-right btn_show_custom_date">
            <i class="fa fa-calendar"></i>
            &nbsp;
        <span class="thin uppercase">
            <?php
            if($request_custom_date['type'] == 'all_time'){
                _e("All Time",ST_TEXTDOMAIN);
            }else{?>
                <span class="hidden-sm hidden-md hidden-lg">
                    <?php echo date_i18n( 'd/m/Y', strtotime( $request_custom_date['start'] ) ); ?>
                </span>
                <span class="hidden-xs">
                    <?php echo date_i18n( 'F j, Y', strtotime( $request_custom_date['start'] ) ); ?>
                </span>
                -
                <span class="hidden-sm hidden-md hidden-lg">
                    <?php echo date_i18n( 'd/m/Y', strtotime( $request_custom_date['end'] ) ); ?>
                </span>
                <span class="hidden-xs">
                    <?php echo date_i18n( 'F j, Y', strtotime( $request_custom_date['end'] ) ); ?>
                </span>
            <?php } ?>
        </span>
            &nbsp;
            <i class="fa fa-angle-down"></i>
        </div>
        <div class="div-custom-date st-calendar" style="display: none">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?php the_permalink() ?>">
                        <input type="hidden" name="sc" value="dashboard">
                        <div class="form-group form-group-icon-left">

                            <label for="custom_select_date"><?php _e("Select Date",ST_TEXTDOMAIN) ?></label>
                            <i class="fa fa-cogs input-icon input-icon-highlight"></i>
                            <select class="form-control custom_select_date" name="custom_select_date">
                                <option <?php if($request_custom_date['type'] == 'this_week') echo "selected"; ?> value="this_week|<?php echo esc_html($_custom_date['the_week']['this_week']['start']) ?>|<?php echo esc_html($_custom_date['the_week']['this_week']['end']) ?>"><?php _e("This week",ST_TEXTDOMAIN) ?></option>
                                <option <?php if($request_custom_date['type'] == 'this_month') echo "selected"; ?> value="this_month|<?php echo date('Y-m-01') ?>|<?php echo date('Y-m-t') ?>"><?php _e("This month",ST_TEXTDOMAIN) ?></option>
                                <option <?php if($request_custom_date['type'] == 'this_year') echo "selected"; ?> value="this_year|<?php echo date('Y-01-01')  ?>|<?php echo date('Y-12-31')  ?>"><?php _e("This year",ST_TEXTDOMAIN) ?></option>
                                <option <?php if($request_custom_date['type'] == 'all_time') echo "selected"; ?> value="all_time||"><?php _e("All Time",ST_TEXTDOMAIN) ?></option>
                                <option <?php if($request_custom_date['type'] == 'custom_date') echo "selected"; ?> value="custom_date||"><?php _e("Custom Date",ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                        <div class="data_custom_date">
                            <div class="form-group form-group-icon-left">

                                <label for="date_start"><?php _e("From",ST_TEXTDOMAIN) ?></label>
                                <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                <?php
                                $date_start=$request_custom_date['start'];
                                $date_end=$request_custom_date['end'];
                                ?>
                                <input id="date_start" class="form-control input-date-start" data-format-php="<?php echo esc_html(TravelHelper::getDateFormat()) ?>" data-value="<?php echo esc_html($request_custom_date['start']) ?>" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" placeholder="<?php echo TravelHelper::getDateFormatJs(__("Select date", ST_TEXTDOMAIN)); ?>" type="text" name="date_start" value="<?php echo date_i18n(TravelHelper::getDateFormat(),strtotime($date_start)) ?>" required="" readonly>
                            </div>
                            <div class="form-group form-group-icon-left">

                                <label for="date_end"><?php _e("To",ST_TEXTDOMAIN) ?></label>
                                <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                <input id="date_end" class="form-control input-date-end"  data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" type="text" name="date_end" value="<?php echo date_i18n(TravelHelper::getDateFormat(),strtotime($date_end)) ?>" required="" readonly>
                            </div>
                        </div>
                        <div class="form-group form-group-icon-left">
                            <button type="submit" class="btn btn-primary btn-sm"><?php _e("Apply",ST_TEXTDOMAIN) ?></button>
                            <button type="button" class="btn btn-default btn-sm pull-right btn_cancel"><?php _e("Cancel",ST_TEXTDOMAIN) ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 

    <?php if($custom_layout_chart_info == "on"){ ?>
        <?php if($request_custom_date['type'] == 'all_time'){ ?>
            <?php $data_year_js = STUser_f::_conver_array_to_data_js_reports($total_earning['date'],'all','year');?>
            <div class="div_all_time_year" style="display: block">
                <div class="st_div_canvas">
                    <div class="head_reports bg-green">
                        <div class="head_control">
                            <div class="head_time bc_all_time">
                                <?php _e("All Time",ST_TEXTDOMAIN) ?>
                            </div>
                        </div>
                    </div>
                    <div class="st_div_item_canvas_year"><canvas id="canvas_year_new"></canvas></div>
                </div>
                <div class="st_bortlet box st_hotel " data-type="st_hotel">
                    <div class="st_bortlet-title">
                        <div class="caption"> <?php _e("Details",ST_TEXTDOMAIN) ?> </div>
                    </div>
                    <div class="st_bortlet-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover st_table_partner">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php _e("Year",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Net Income",ST_TEXTDOMAIN) ?></th>
                                    <!--<th style="width: 85px;"><?php /*_e("Action",ST_TEXTDOMAIN) */?></th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1;foreach($total_earning['date'] as $k=>$v): ?>
                                    <tr>
                                        <td><?php echo esc_html($i) ?></td>
                                        <td>
                                        <span class="btn_all_time_show_month_by_year text-color" data-title="<?php _e("View",ST_TEXTDOMAIN) ?>" data-loading="<?php _e("Loading...",ST_TEXTDOMAIN) ?>"  data-year="<?php echo esc_html($k) ?>" href="javascript:;">
                                            <?php echo esc_html($k) ?>
                                        </span>
                                        </td>
                                        <td><?php echo esc_html($v['number_orders']); ?></td>
                                        <td>
                                            <?php
                                            if($v['average_total'] > 0){
                                                echo TravelHelper::format_money_raw($v['average_total'], $currency);
                                            }else {
                                                echo "0";
                                            }
                                            ?>
                                        </td>
                                        <!--<td class="text-center">
                                        <a class="btn default btn-xs green-stripe btn_all_time_show_month_by_year" data-title="<?php /*_e("View",ST_TEXTDOMAIN) */?>" data-loading="<?php /*_e("Loading...",ST_TEXTDOMAIN) */?>" data-year="<?php /*echo esc_html($k) */?>" href="javascript:;">
                                            <?php /*_e("View",ST_TEXTDOMAIN) */?>
                                        </a>
                                    </td>-->
                                    </tr>
                                    <?php $i++; endforeach;?>
                                    <tr class="bg-white">
                                        <th colspan="2">
                                            <?php _e("Total",ST_TEXTDOMAIN) ?>
                                        </th>
                                        <td>
                                            <?php echo esc_html($total_earning['number_orders']); ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($total_earning['average_total'] > 0){
                                                echo TravelHelper::format_money_raw($total_earning['average_total'], $currency);
                                            }else {
                                                echo "0";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div_all_time_month">
                <div class="st_div_canvas">
                    <div class="head_reports bg-green">
                        <div class="head_control">
                            <div class="head_time bc_all_time"></div>
                        </div>
                    </div>
                    <div class="st_div_item_all_time_canvas_month"></div>
                </div>
                <div class="st_bortlet box st_hotel " data-type="st_hotel">
                    <div class="st_bortlet-title">
                        <div class="caption"> <?php _e("Details Month",ST_TEXTDOMAIN) ?> </div>
                    </div>
                    <div class="st_bortlet-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover st_table_partner">
                                <thead>
                                <tr>
                                    <th><?php _e("Date",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Net Income",ST_TEXTDOMAIN) ?></th>
                                    <!-- <th style="width: 85px;" class="text-center"><?php /*_e("Action",ST_TEXTDOMAIN) */?></th>-->
                                </tr>
                                </thead>
                                <tbody class="data_all_time_month"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div_all_time_day">
                <div class="st_div_canvas">
                    <div class="head_reports bg-green">
                        <div class="head_control">
                            <div class="head_time bc_all_time"></div>
                        </div>
                    </div>
                    <div class="st_div_item_all_time_canvas_day"></div>
                </div>
                <div class="st_bortlet box st_hotel " data-type="st_hotel">
                    <div class="st_bortlet-title">
                        <div class="caption"> <?php _e("Details Days",ST_TEXTDOMAIN) ?> </div>
                    </div>
                    <div class="st_bortlet-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover st_table_partner">
                                <thead>
                                <tr>
                                    <th><?php _e("Date",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Net Income",ST_TEXTDOMAIN) ?></th>
                                </tr>
                                </thead>
                                <tbody class="data_all_time_day"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <span class="hidden all_time user_dashboard"
                data-data_lable_year   = '<?php echo str_ireplace(array("'"),'\"',balanceTags($data_year_js['lable'])); ?>';
                data-data_sets_year   = '<?php echo str_ireplace(array("'"),'\"',balanceTags($data_year_js['data'])); ?>';
            ></span>
        <?php }elseif($request_custom_date['type']=="this_month" or $request_custom_date['type']=="this_year" ){ ?>
            <?php
            $start = $request_custom_date['start'];
            $end = $request_custom_date['end'];
            $this_data_info_month = STUser_f::st_get_data_reports_partner('all','custom_date',$start,$end);
            if(empty($this_data_info_month['date']))$this_data_info_month['date'] = array();
            $data_js = STUser_f::_conver_array_to_data_js_reports($this_data_info_month['date'],'all',$request_custom_date['type']);
            ?>
            <div class="st_div_canvas div_custom_month">
                <div class="head_reports bg-green">
                    <div class="head_control">
                        <div class="head_time">
                            <span class="btn_all_time"><?php _e("ALL TIME",ST_TEXTDOMAIN) ?></span> 
                            <span class="btn_all_time_show_month_by_year" data-title="<?php _e("View",ST_TEXTDOMAIN) ?>" data-loading="<?php _e("Loading...",ST_TEXTDOMAIN)?>"  data-year="<?php echo date_i18n( 'Y', strtotime( $start ) ); ?>"><?php echo date_i18n( 'Y', strtotime( $start ) ); ?></span>
                            <span class="active btn_all_time_show_month_by_month"><?php echo date_i18n( 'F', strtotime( $start ) ); ?></span>
                        </div>
                    </div>
                </div>
                <div class="st_div_item_canvas"><canvas id="canvas_month"></canvas></div>
                <div class="st_bortlet box st_hotel">
                    <div class="st_bortlet-title">
                        <div class="caption"><?php _e("Details",ST_TEXTDOMAIN) ?> </div>
                    </div>
                    <div class="st_bortlet-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover st_table_partner">
                                <thead>
                                <tr>
                                    <th><?php _e("Date",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Net Income",ST_TEXTDOMAIN) ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($data_js['data_array_php']) and is_array($data_js['data_array_php']) ){ foreach($data_js['data_array_php'] as $k=>$v): ?>
                                    <tr>
                                        <td><?php echo esc_html($v['title']) ?></td>
                                        <td><?php echo esc_html($v['number_orders']); ?></td>
                                        <td><?php
                                            if($v['average_total'] > 0 ){
                                                echo TravelHelper::format_money_raw($v['average_total'], $currency);
                                            }else{
                                                echo "0";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach;}?>
                                </tbody>
                                <tr class="bg-white">
                                    <th>
                                        <?php _e("Total",ST_TEXTDOMAIN) ?>
                                    </th>
                                    <td>
                                        <?php echo esc_html($data_js['info_total']['number_orders']); ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($data_js['info_total']['average_total'] > 0){
                                            echo TravelHelper::format_money_raw($data_js['info_total']['average_total'], $currency);
                                        }else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <span class="hidden this_month user_dashboard"
                data-data_lable   = '<?php echo str_ireplace(array("'"),'\"',balanceTags($data_js['lable'])); ?>';
                data-data_sets   = '<?php echo str_ireplace(array("'"),'\"',balanceTags($data_js['data'])); ?>';
            ></span>
            <?php $data_year_js = STUser_f::_conver_array_to_data_js_reports($total_earning['date'],'all','year');?>
            <div class="div_all_time_year">
                <div class="st_div_canvas">
                    <div class="head_reports bg-green">
                        <div class="head_control">
                            <div class="head_time bc_all_time">
                                <?php _e("All Time",ST_TEXTDOMAIN) ?>
                            </div>
                        </div>
                    </div>
                    <div class="st_div_item_canvas_year"><canvas id="canvas_year"></canvas></div>
                </div>
                <div class="st_bortlet box st_hotel " data-type="st_hotel">
                    <div class="st_bortlet-title">
                        <div class="caption"> <?php _e("Details All Time",ST_TEXTDOMAIN) ?> </div>
                    </div>
                    <div class="st_bortlet-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover st_table_partner">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php _e("Year",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Net Income",ST_TEXTDOMAIN) ?></th>
                                    <!--<th style="width: 85px;" class="text-center"><?php /*_e("Action",ST_TEXTDOMAIN) */?></th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1;foreach($total_earning['date'] as $k=>$v): ?>
                                    <tr>
                                        <td><?php echo esc_html($i) ?></td>
                                        <td>
                                        <span class="btn_all_time_show_month_by_year text-color" data-title="<?php _e("View",ST_TEXTDOMAIN) ?>" data-loading="<?php _e("Loading...",ST_TEXTDOMAIN) ?>"  data-year="<?php echo esc_html($k) ?>" href="javascript:;">
                                            <?php echo esc_html($k) ?>
                                        </span>
                                        </td>
                                        <td><?php echo esc_html($v['number_orders']); ?></td>
                                        <td>
                                            <?php
                                            if($v['average_total'] > 0){
                                                echo TravelHelper::format_money_raw($v['average_total'], $currency);
                                            }else {
                                                echo "0";
                                            }
                                            ?>
                                        </td>
                                        <!--<td class="text-center">
                                        <a class="btn default btn-xs green-stripe btn_all_time_show_month_by_year" data-title="<?php /*_e("View",ST_TEXTDOMAIN) */?>" data-loading="<?php /*_e("Loading...",ST_TEXTDOMAIN) */?>" data-year="<?php /*echo esc_html($k) */?>" href="javascript:;">
                                            <?php /*_e("View",ST_TEXTDOMAIN) */?>
                                        </a>
                                    </td>-->
                                    </tr>
                                    <?php $i++; endforeach;?>
                                </tbody>
                                <tr class="bg-white">
                                    <th colspan="2">
                                        <?php _e("Total",ST_TEXTDOMAIN) ?>
                                    </th>
                                    <td>
                                        <?php echo esc_html($data_year_js['info_total']['number_orders']); ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($data_year_js['info_total']['average_total'] > 0){
                                            
                                            echo TravelHelper::format_money_raw($data_year_js['info_total']['average_total'], $currency);
                                        }else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div_all_time_month">
                <div class="st_div_canvas">
                    <div class="head_reports bg-green">
                        <div class="head_control">
                            <div class="head_time bc_all_time"></div>
                        </div>
                    </div>
                    <div class="st_div_item_all_time_canvas_month"></div>
                </div>
                <div class="st_bortlet box st_hotel " data-type="st_hotel">
                    <div class="st_bortlet-title">
                        <div class="caption"> <?php _e("Details Month",ST_TEXTDOMAIN) ?> </div>
                    </div>
                    <div class="st_bortlet-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover st_table_partner">
                                <thead>
                                <tr>
                                    <th><?php _e("Date",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Net Income",ST_TEXTDOMAIN) ?></th>
                                    <!--<th style="width: 85px;"><?php /*_e("Action",ST_TEXTDOMAIN) */?></th>-->
                                </tr>
                                </thead>
                                <tbody class="data_all_time_month"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div_all_time_day">
                <div class="st_div_canvas">
                    <div class="head_reports bg-green">
                        <div class="head_control">
                            <div class="head_time bc_all_time"></div>
                        </div>
                    </div>
                    <div class="st_div_item_all_time_canvas_day"></div>
                </div>
                <div class="st_bortlet box st_hotel " data-type="st_hotel">
                    <div class="st_bortlet-title">
                        <div class="caption"> <?php _e("Details Days",ST_TEXTDOMAIN) ?> </div>
                    </div>
                    <div class="st_bortlet-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover st_table_partner">
                                <thead>
                                <tr>
                                    <th><?php _e("Date",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Net Income",ST_TEXTDOMAIN) ?></th>
                                </tr>
                                </thead>
                                <tbody class="data_all_time_day"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <span class="hidden year user_dashboard"
                data-data_lable_year   = '<?php echo str_ireplace(array("'"),'\"',balanceTags($data_year_js['lable'])); ?>';
                data-data_sets_year   = '<?php echo str_ireplace(array("'"),'\"',balanceTags($data_year_js['data'])); ?>';
            ></span>
        <?php }else{ ?>
            <?php
            $start = $request_custom_date['start'];
            $end = $request_custom_date['end'];
            $this_data_info_month = STUser_f::st_get_data_reports_partner('all','custom_date',$start,$end);
            $data_js = STUser_f::_conver_array_to_data_js_reports($this_data_info_month['date'],'all',$request_custom_date['type']);
            ?>
            <div class="st_div_canvas">
                <div class="head_reports bg-green">
                    <div class="head_control">
                        <div class="head_time">
                            <span><?php _e("Info Month",ST_TEXTDOMAIN) ?>:<?php echo date_i18n( 'F j, Y', strtotime( $start ) ); ?> - <?php echo date_i18n( 'F j, Y', strtotime( $end ) ); ?></span>
                        </div>
                    </div>
                </div>
                <div class="st_div_item_canvas"><canvas id="canvas_month"></canvas></div>
                <div class="st_bortlet box st_hotel">
                    <div class="st_bortlet-title">
                        <div class="caption"><?php _e("Details",ST_TEXTDOMAIN) ?> </div>
                    </div>
                    <div class="st_bortlet-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover st_table_partner">
                                <thead>
                                <tr>
                                    <th><?php _e("Date",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                    <th><?php _e("Net Income",ST_TEXTDOMAIN) ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($data_js['data_array_php'] as $k=>$v): ?>
                                    <tr>
                                        <td><?php echo esc_html($v['title']) ?></td>
                                        <td><?php echo esc_html($v['number_orders']); ?></td>
                                        <td><?php
                                            if($v['average_total'] > 0 ){
                                                
                                                echo TravelHelper::format_money_raw($v['average_total'], $currency);
                                            }else{
                                                echo "0";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                                <tr class="bg-white">
                                    <th>
                                        <?php _e("Total",ST_TEXTDOMAIN) ?>
                                    </th>
                                    <td>
                                        <?php echo esc_html($data_js['info_total']['number_orders']); ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($data_js['info_total']['average_total'] > 0){
                                            
                                            echo TravelHelper::format_money_raw($data_js['info_total']['average_total'], $currency);
                                        }else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <span class="hidden else user_dashboard"
                data-data_lable   = '<?php echo str_ireplace(array("'"),'\"',balanceTags($data_js['lable'])); ?>';
                data-data_sets   = '<?php echo str_ireplace(array("'"),'\"',balanceTags($data_js['data'])); ?>';
            ></span>
        <?php } ?>
    <?php } ?>
</div>
