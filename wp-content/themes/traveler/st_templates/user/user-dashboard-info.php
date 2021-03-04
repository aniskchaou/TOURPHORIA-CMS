<?php
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
//$info = STUser_f::st_get_data_reports_partner(array('st_cars','st_hotel'),'10-9-2015','20-9-2015');
$_custom_date = STUser_f::get_custom_date_reports_partner();
$request_custom_date = STUser_f::get_request_custom_date_partner();


$post_type = STInput::request('type');
$obj_post_type = get_post_type_object( $post_type );
$title_dashboard = array(
    'st_hotel' => __("Hotel Statistics",ST_TEXTDOMAIN),
    'hotel_room' => __("Room Statistics",ST_TEXTDOMAIN),
    'st_rental' => __("Rental Statistics",ST_TEXTDOMAIN),
    'st_cars' => __("Car Statistics",ST_TEXTDOMAIN),
    'st_tours' => __("Tour Statistics",ST_TEXTDOMAIN),
    'st_activity' => __("Activity Statistics",ST_TEXTDOMAIN),
);
$custom_layout = st()->get_option('partner_custom_layout','off');
$custom_layout_total_earning = st()->get_option('partner_custom_layout_total_earning','on');
$custom_layout_service = st()->get_option('partner_custom_layout_service_earning','on');
$custom_layout_chart_info = st()->get_option('partner_custom_layout_chart_info','on');
if($custom_layout == "off"){
    $custom_layout_total_earning = $custom_layout_service = $custom_layout_chart_info = "on";
}

$total_earning = STUser_f::st_get_data_reports_total_all_time_partner();

$currency = TravelHelper::get_current_currency('symbol');
?>
<?php if($custom_layout_total_earning == "on"){ ?>
    <div class="row div-partner-page-title">
        <div class="col-md-7">
            <h3 class="partner-page-title">
                <?php
                    foreach ($title_dashboard as $key => $tit_das) {
                        if($key===$post_type){
                            echo $tit_das;
                        }
                    }
                ?>
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
                                if($total_earning['average_total'] > 0){
                                    echo TravelHelper::format_money_raw($total_earning['average_total'], $currency) ;
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
            <div class="st-dashboard-stat st-month-madison st-dashboard-new st-month-3">
                <div class="st-wrap-box">
                    <div class="title">
                        <?php _e("Net Earning",ST_TEXTDOMAIN) ?>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                                if($total_earning['total'] > 0){
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
<?php if($custom_layout_service == "on"){  ?>
    <div class="row" style="margin-top: 30px;">
        <?php
        $start  = $_custom_date['y'].'-'.$_custom_date['m'].'-1';
        $end  = $_custom_date['y'].'-'.$_custom_date['m'].'-31';
        $this_month = STUser_f::st_get_data_reports_partner(array($post_type),'custom_date',$start,$end);
        ?>
        <div class="col-md-12">
            <div class="panel panel-primary panel-<?php echo STInput::request('type') ?> panel-single">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="item-box-static">
                                <i class="fa <?php echo apply_filters('st_post_type_'.$post_type.'_icon','') ?> fa-5x"></i>
                                <span class="title_post_type"><?php  echo esc_html($obj_post_type->labels->singular_name); ?>  <?php _e(" Statistics",ST_TEXTDOMAIN) ?></span>
                            </div>
                            
                        </div>
                        <div class="col-md-5 text-right average_total">
                            <div class="huge">
                                <?php
                                if($this_month['average_total'] > 0){
                                    echo TravelHelper::format_money_raw($this_month['average_total'], $currency);
                                }else {
                                    echo "0";
                                }
                                ?>
                            </div>
                            <div class="title"><?php _e("Total Price",ST_TEXTDOMAIN) ?></div>
                        </div>
                        <div class="col-md-2 text-right average_total">
                            <div class="huge">
                                <?php echo esc_html($this_month['number_orders']) ?>
                            </div>
                            <div class="title"><?php _e("Total Order",ST_TEXTDOMAIN) ?></div>
                        </div>
                        <div class="col-md-2 text-right average_total">
                            <div class="huge">
                                <?php echo date_i18n('m/Y',strtotime($_custom_date['date_now'])) ?>
                            </div>
                            <div class="title"><?php _e("Date",ST_TEXTDOMAIN) ?></div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo  esc_url( add_query_arg( array('sc'=>'dashboard') , get_the_permalink() ) ) ?>">
                    <div class="panel-footer static-info-footer">
                        <span class="pull-left"><?php _e("View All",ST_TEXTDOMAIN) ?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
<?php } ?>
<?php if($custom_layout_chart_info == "on"){  ?>
    <?php
    $start  = $_custom_date['y'].'-'.$_custom_date['m'].'-1';
    $end  = $_custom_date['y'].'-'.$_custom_date['m'].'-31';
    $this_month = STUser_f::st_get_data_reports_partner(array($post_type),'custom_date',$start,$end);
    $data_js = STUser_f::_conver_array_to_data_js_reports($this_month['date'],'all','custom');
    ?>
    <div class="st_div_canvas div_single_custom">
        <div class="head_reports head-<?php echo STInput::request('type') ?>">
            <div class="head_control">
                <div class="head_time">
                    <span class="btn_single_all_time"><?php _e("All Time",ST_TEXTDOMAIN) ?></span>
                 <span class="btn_show_month_by_year" data-title="<?php _e("View",ST_TEXTDOMAIN) ?>" data-loading="<?php _e("Loading...",ST_TEXTDOMAIN) ?>" data-post-type="<?php echo esc_html($post_type) ?>" data-year="<?php echo esc_html($_custom_date['y']) ?>" href="javascript:;">
                        <?php echo esc_html($_custom_date['y']) ?>
                 </span>
                <span class="active">
                     <?php
                     $dt = DateTime::createFromFormat('!m', $_custom_date['m']);
                     echo esc_html($dt->format('F'))
                     ?>
                </span>
                </div>
            </div>
        </div>
        <div class="st_div_canvas">
            <canvas id="canvas_this_month"></canvas>
        </div>
        <div class="st_bortlet box <?php echo STInput::request('type') ?>" data-type="<?php echo STInput::request('type') ?>">
            <div class="st_bortlet-title">
                <div class="caption"> <?php  echo esc_html($obj_post_type->labels->singular_name); ?>  <?php _e(" Statistic Details",ST_TEXTDOMAIN) ?> </div>
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
                                <td class="text-center"><?php echo esc_html($v['number_orders']); ?></td>
                                <td class="text-center"><?php
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
                            <td class="text-center">
                                <?php echo esc_html($data_js['info_total']['number_orders']); ?>
                            </td>
                            <td class="text-center">
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
<?php } ?>
<div class="div_single_year">
    <?php
    $data_year = STUser_f::st_get_data_reports_partner_info_year($post_type);
    $data_year_js = STUser_f::_conver_array_to_data_js_reports($data_year,'all','year')
    ;?>
    <div class="st_div_canvas">
        <div class="head_reports head-<?php echo STInput::request('type') ?>">
            <div class="head_control">
                <div class="head_time bc_single">
                    <?php _e("All Time",ST_TEXTDOMAIN) ?>
                </div>
            </div>
        </div>
        <div class="st_div_item_canvas_year"><canvas id="canvas_year"></canvas></div>
    </div>
    <div class="st_bortlet box <?php echo STInput::request('type') ?>" data-type="<?php echo STInput::request('type') ?>">
        <div class="st_bortlet-title">
            <div class="caption"> <?php  echo esc_html($obj_post_type->labels->singular_name); ?>  <?php _e(" Statistic Details",ST_TEXTDOMAIN) ?> </div>
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
                    <?php $i=1;
                    $total_price = 0;
                    $number_orders = 0;
                    foreach($data_year as $k=>$v):
                        $total_price += $v['average_total'];
                        $number_orders += $v['number_orders'];
                        ?>
                        <tr>
                            <td><?php echo esc_html($i) ?></td>
                            <td>
                            <span class="btn_show_month_by_year text-color" data-title="<?php _e("View",ST_TEXTDOMAIN) ?>" data-loading="<?php _e("Loading...",ST_TEXTDOMAIN) ?>" data-post-type="<?php echo esc_html($post_type) ?>" data-year="<?php echo esc_html($k) ?>" href="javascript:;">
                                <?php echo esc_html($k) ?>
                            </span>
                            </td>
                            <td class="text-center"><?php echo esc_html($v['number_orders']); ?></td>
                            <td class="text-center">
                                <?php
                                if($v['average_total'] > 0 ){
                                    echo TravelHelper::format_money_raw($v['average_total'], $currency);
                                }else{
                                    echo "0";
                                }
                                ?>
                            </td>
                        </tr>
                        <?php $i++; endforeach;?>
                    </tbody>
                    <tr class="bg-white">
                        <th colspan="2">
                            <?php _e("Total",ST_TEXTDOMAIN) ?>
                        </th>
                        <td class="text-center">
                            <?php echo esc_html($number_orders); ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if($total_price > 0){
                                echo TravelHelper::format_money_raw($total_price, $currency);
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

<div class="div_single_month">
    <div class="st_div_canvas">
        <div class="head_reports head-<?php echo STInput::request('type') ?>">
            <div class="head_control">
                <div class="head_time bc_single"></div>
            </div>
        </div>
        <div class="st_div_item_canvas_month"></div>
    </div>
    <div class="st_bortlet box <?php echo STInput::request('type') ?>" data-type="<?php echo STInput::request('type') ?>">
        <div class="st_bortlet-title">
            <div class="caption"> <?php  echo esc_html($obj_post_type->labels->singular_name); ?>  <?php _e(" Statistic Details",ST_TEXTDOMAIN) ?> </div>
        </div>
        <div class="st_bortlet-body">
            <div class="table-scrollable">
                <table class="table table-bordered table-hover st_table_partner">
                    <thead>
                    <tr>
                        <th><?php _e("Month",ST_TEXTDOMAIN) ?></th>
                        <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                        <th><?php _e("Net Income",ST_TEXTDOMAIN) ?></th>
                    </tr>
                    </thead>
                    <tbody class="data_month"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="div_single_day">
    <div class="st_div_canvas">
        <div class="head_reports head-<?php echo STInput::request('type') ?>">
            <div class="head_control">
                <div class="head_time bc_single"></div>
            </div>
        </div>
        <div class="st_div_item_canvas_day"></div>
    </div>
    <div class="st_bortlet box <?php echo STInput::request('type') ?>" data-type="<?php echo STInput::request('type') ?>">
        <div class="st_bortlet-title">
            <div class="caption"> <?php  echo esc_html($obj_post_type->labels->singular_name); ?>  <?php _e(" Statistic Details",ST_TEXTDOMAIN) ?> </div>
        </div>
        <div class="st_bortlet-body">
            <div class="table-scrollable">
                <table class="table table-bordered table-hover st_table_partner">
                    <thead>
                    <tr>
                        <th><?php _e("Month",ST_TEXTDOMAIN) ?></th>
                        <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                        <th><?php _e("Net Income",ST_TEXTDOMAIN) ?></th>
                    </tr>
                    </thead>
                    <tbody class="data_day"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<span class="hidden st_user_dashboard_info lineChartData_total"
    data-data_label  = '<?php echo str_ireplace(array("'"),'\"',balanceTags($data_js['lable'])) ;?>'
    data-data_sets  = '<?php echo str_ireplace(array("'"),'\"',balanceTags($data_js['data'])) ;?>'
></span>
<?php
$lable_year = str_ireplace(array("'"),'\"',balanceTags($data_year_js['lable']));
    if(isset($lable_year) && !empty($lable_year)){
        $lable_year = $lable_year;
    } else {
        $lable_year = '["'.date("Y").'"]';
    }
    $data_year_js = str_ireplace(array("'"),'\"',balanceTags($data_year_js['data']));
    if(isset($data_year_js) && !empty($data_year_js)){
        $data_year_js = $data_year_js;
    } else {
        $data_year_js = '["0"]';
    }
?>
<span class="hidden st_user_dashboard_info lineChartData_total_year"
    data-data_lable_year  = '<?php echo $lable_year ;?>'
    data-data_sets_year  = '<?php echo $data_year_js ;?>'
></span>