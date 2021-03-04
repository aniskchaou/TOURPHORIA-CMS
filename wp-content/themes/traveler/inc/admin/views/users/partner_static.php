<?php 
    wp_enqueue_script('gmapv3');
    wp_enqueue_script('template-user-js');
    wp_enqueue_script( 'st-custom-partner' );
?>
<?php
echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
echo '<h2>'.__('Partner Statistic',ST_TEXTDOMAIN).'</h2>';


?>
<div class="container-fluid content-admin">
    <div class="row">
        <?php
        $total_price_payout = STAdminWithdrawal::_admin_get_total_price_payout();
        $total_price_payout_this_month = STAdminWithdrawal::_admin_get_total_price_payout_this_month();
        $number_new_user_pending = STAdminWithdrawal::_admin_count_new_user_pending_partner();
        $number_new_user_this_moth = STAdminWithdrawal::_admin_count_new_user_partner_this_month();
        ?>
        <div class="col-md-3">
            <div class="st-dashboard-stat st-month-madison st-dashboard-new st-month-1">
                <div class="visual">
                    <i class="fa fa-calculator"></i>
                </div>
                <div class="title">
                    <?php _e("Total Payout",ST_TEXTDOMAIN) ?>
                </div>
                <div class="details">
                    <div class="number">
                        <?php echo TravelHelper::format_money($total_price_payout) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="st-dashboard-stat st-month-madison st-dashboard-new st-month-2">
                <div class="visual">
                    <i class="fa fa fa-bar-chart"></i>
                </div>
                <div class="title">
                    <?php _e("Payout this Month",ST_TEXTDOMAIN) ?>
                </div>
                <div class="details">
                    <div class="number">
                        <?php echo esc_html(TravelHelper::format_money($total_price_payout_this_month)) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <?php if($number_new_user_pending > 0){ ?>
                <a href="<?php echo admin_url("admin.php?page=st-users-list-partner-menu&st_tab=partner_pending"); ?>">
            <?php } ?>
                <div class="st-dashboard-stat st-month-madison st-dashboard-new st-month-3">
                    <div class="visual">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="title">
                        <?php _e("Pending Partner",ST_TEXTDOMAIN) ?>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php echo esc_html($number_new_user_pending) ?>
                        </div>
                    </div>
                </div>
             <?php if($number_new_user_pending>0){ ?>
                </a>
            <?php } ?>
        </div>
        <div class="col-md-3">
            <div class="st-dashboard-stat st-month-madison st-dashboard-new st-month-4">
                <div class="visual">
                    <i class="fa fa fa-user"></i>
                </div>
                <div class="title">
                    <?php _e("New Partner / Month",ST_TEXTDOMAIN) ?>
                </div>
                <div class="details">
                    <div class="number">
                        <?php echo esc_html($number_new_user_this_moth) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid content-admin ">
    <div class="row bot-content">
        <div class="col-md-9">
            <div class="div_single_year">
                <?php
                $data = STUser::_admin_get_data_chart_number_user_partner();
                $fist_year = STUser::_admin_get_fist_date_approved_user_partner();
                ?>
                <div class="st_div_canvas">
                    <div class="head_reports head-st_hotel">
                        <div class="head_control">
                            <div class="head_time bc_single">
                                <div class="row">
                                    <div class="col-md-5"><?php _e("Statistical graphs register",ST_TEXTDOMAIN) ?></div>
                                    <form method="get" action="<?php echo admin_url("admin.php?page=st-users-partner-static-menu") ?>">
                                        <input name="page" type="hidden" value="st-users-partner-static-menu">
                                        <div class="col-md-7" style="text-align: right">
                                            <?php $st_year = STInput::request('st_year', date('Y')) ?>
                                                <?php _e("Select Year",ST_TEXTDOMAIN) ?>:
                                                <select name="st_year" style="margin-right: 20px;">
                                                    <option <?php if($st_year == "all") echo "selected"; ?>  value="all"><?php _e("All",ST_TEXTDOMAIN) ?></option>
                                                    <?php for($i= date("Y") ; $i >=$fist_year  ; $i-- ){
                                                           if($i == $st_year){
                                                               echo "<option selected value='{$i}'>{$i}</option>";
                                                           }else{
                                                               echo "<option value='{$i}'>{$i}</option>";
                                                           }

                                                    } ?>

                                                </select>
                                                <?php  if($st_year != "all"){ ?>
                                                    <?php _e("Month",ST_TEXTDOMAIN) ?>:
                                                    <?php $st_month = STInput::request('st_month', date('m')) ?>
                                                    <select name="st_month">
                                                        <option <?php if($st_month == "all") echo "selected"; ?>  value="all"><?php _e("All",ST_TEXTDOMAIN) ?></option>
                                                        <option <?php if($st_month == "01") echo "selected"; ?>  value="01"><?php _e("January",ST_TEXTDOMAIN) ?></option>
                                                        <option <?php if($st_month == "02") echo "selected"; ?> value="02"><?php _e("February",ST_TEXTDOMAIN) ?></option>
                                                        <option <?php if($st_month == "03") echo "selected"; ?> value="03"><?php _e("March",ST_TEXTDOMAIN) ?></option>
                                                        <option <?php if($st_month == "04") echo "selected"; ?> value="04"><?php _e("April",ST_TEXTDOMAIN) ?></option>
                                                        <option <?php if($st_month == "05") echo "selected"; ?> value="05"><?php _e("May",ST_TEXTDOMAIN) ?></option>
                                                        <option <?php if($st_month == "06") echo "selected"; ?> value="06"><?php _e("June",ST_TEXTDOMAIN) ?></option>
                                                        <option <?php if($st_month == "07") echo "selected"; ?> value="07"><?php _e("July",ST_TEXTDOMAIN) ?></option>
                                                        <option <?php if($st_month == "08") echo "selected"; ?> value="08"><?php _e("August",ST_TEXTDOMAIN) ?></option>
                                                        <option <?php if($st_month == "09") echo "selected"; ?> value="09"><?php _e("September",ST_TEXTDOMAIN) ?></option>
                                                        <option <?php if($st_month == "10") echo "selected"; ?> value="10"><?php _e("October",ST_TEXTDOMAIN) ?></option>
                                                        <option <?php if($st_month == "11") echo "selected"; ?> value="11"><?php _e("November",ST_TEXTDOMAIN) ?></option>
                                                        <option <?php if($st_month == "12") echo "selected"; ?> value="12"><?php _e("December",ST_TEXTDOMAIN) ?></option>
                                                    </select>
                                                <?php } ?>
                                                <input type="submit" name="" class="button" value="Filter" >

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="st_div_item_canvas_year"><canvas id="canvas_this_month"></canvas></div>
                </div>

            </div>
        </div>
        <div class="col-md-3">
            <div class="st_bortlet box st_hotel st_bortlet_new_admin">
                <div class="st_bortlet-title">
                    <div class="caption"><?php _e("Detailed statistics",ST_TEXTDOMAIN) ?></div>
                </div>
                <div class="st_bortlet-body">
                    <strong><?php _e("Total Partner",ST_TEXTDOMAIN) ?></strong>: <?php echo esc_html($data['total']) ?>
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover st_table_partner">
                            <thead>
                                <tr class="text-center">
                                    <th width="50%">
                                        <?php
                                        $st_month = STInput::request('st_month',date('m'));
                                        $st_year = STInput::request('st_year',date('Y'));
                                        if($st_year == "all"){
                                            _e("Year",ST_TEXTDOMAIN);
                                        }else{
                                            if($st_month == "all"){
                                                _e("Month",ST_TEXTDOMAIN);
                                            }else{
                                                _e("Date",ST_TEXTDOMAIN);
                                            }
                                        }
                                        ?>
                                    </th>
                                    <th width="50%"><?php _e("Number Partner",ST_TEXTDOMAIN) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $check = false;
                            if(!empty($data)){
                                foreach($data['php'] as $k=>$v){
                                    $st_month = STInput::request('st_month',date('m'));
                                    $st_year = STInput::request('st_year',date('Y'));
                                    if($st_year == "all"){
                                        $date = $k;
                                        $link = "<a href='".admin_url("admin.php?page=st-users-partner-static-menu&st_year={$date}&st_month=all")."'>{$date}</a>";
                                    }else{
                                        if($st_month == 'all'){
                                            $date = date("F", strtotime($st_year."-".$k.'-01'));
                                            $link = "<a href='".admin_url("admin.php?page=st-users-partner-static-menu&st_year={$st_year}&st_month={$k}")."'>{$date}</a>";
                                        }else{
                                            $date  = date($st_year.'-'.$st_month.'-'.$k);
                                            $date = date_i18n(TravelHelper::getDateFormat(),strtotime($date));
                                            $link =$date;
                                        }

                                    }

                                    if($v['number'] > 0 ){
                                        $check = true;
                                        echo balanceTags("<tr class='text-center'>
                                                        <td>{$link}</td>
                                                        <td>{$v['number']}</td>
                                                    </tr>");
                                    }

                                }
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                        if($check == false){
                            echo "<h3 class='text-center'>".__("No Data",ST_TEXTDOMAIN)."</h3>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php  ?>
    <span
        data-data_label  = '<?php echo str_ireplace(array("'"),'\"',balanceTags($data['js']['lable'])) ;?>'
        data-data_sets  = '<?php echo str_ireplace(array("'"),'\"',balanceTags($data['js']['number'])) ;?>'
        class="hidden st_user_dashboard_info lineChartData_total">

    </span>
</div>
