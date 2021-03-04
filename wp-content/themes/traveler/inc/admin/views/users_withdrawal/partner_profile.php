<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 *
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' ); 
wp_enqueue_script( 'st-custom-partner' );

global $wp_query;
echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
echo '<h2>'.__('Partner Profile',ST_TEXTDOMAIN).'</h2>';
$user_id = STInput::request('st_user_id');
$data_user = get_userdata( $user_id );
$total_earning = STUser_f::st_get_data_reports_total_all_time_partner($user_id);
$total_price_payout = STAdminWithdrawal::_get_total_price_payout($user_id);
$your_balance = $total_earning['average_total'] - $total_price_payout;
?>
<div class="container-fluid content-admin">
    <div class="row">
        <div class="col-md-2">
            <div class="st_withdrawal_info_avatar"> <?php echo st_get_profile_avatar( $user_id, 150 ); ?></div>
        </div>

        <div class="col-md-3">
            <div class="st_withdrawal_info_name">
                <h1><?php echo esc_html($data_user->display_name) ?></h1>
                <h4><strong><?php _e("User Name",ST_TEXTDOMAIN) ?></strong>: <?php echo esc_html($data_user->user_nicename) ?>  </h4>
                <h4><strong><?php _e("Email",ST_TEXTDOMAIN) ?></strong>: <?php echo esc_html($data_user->user_email) ?> </h4>
                <?php if($st_phone = get_user_meta($user_id , 'st_phone' , true)){ ?>
                    <h4><strong><?php _e("Phone",ST_TEXTDOMAIN) ?></strong>: <?php echo esc_html($st_phone) ?> </h4>
                <?php } ?>
                <?php if( $website = get_the_author_meta('user_url',$user_id)){ ?>
                    <h4><strong><?php _e("Website",ST_TEXTDOMAIN) ?></strong>: <?php echo esc_html($website) ?> </h4>
                <?php } ?>

                <strong>Service</strong>:
                <?php $post_type = array('st_hotel','st_rental','st_tours','st_cars','st_activity');
                foreach($post_type as $k=>$v){
                    if (STUser_f::_check_service_available_partner($v,$user_id)){
                        $obj = get_post_type_object( $v );
                        ?>

                           <a href="#content-detail-service"
                              data-post-type="<?php echo esc_html($v) ?>" class="st_nav_top_service_partner"
                               >
                               <?php echo $obj->labels->singular_name; ?>
                               (<?php echo STAdminWithdrawal::_count_item_post_type_by_user($v,$user_id); ?>)
                           </a>

                    <?php }
                } ?>

            </div>
        </div>
        <div class="col-md-4">
            <h1> &nbsp </h1>
            <h4><strong><?php _e("Joined",ST_TEXTDOMAIN) ?></strong>: <?php echo esc_html(date_i18n(TravelHelper::getDateFormat(),strtotime($data_user->user_registered))) ?>
            <h4><strong><?php _e("Total Earning",ST_TEXTDOMAIN) ?></strong>: <?php echo esc_html(TravelHelper::format_money($total_earning['total']))  ?>
            <h4><strong><?php _e("Total Profit",ST_TEXTDOMAIN) ?></strong>: <?php echo esc_html(TravelHelper::format_money($total_earning['average_total']))  ?>
            <h4><strong><?php _e("Total Balance",ST_TEXTDOMAIN) ?></strong>: <?php echo esc_html(TravelHelper::format_money($your_balance))  ?>
            <h4><strong><?php _e("Total Payout",ST_TEXTDOMAIN) ?></strong>: <?php echo esc_html(TravelHelper::format_money($total_price_payout))  ?>

        </div>
    </div>
</div>
<div class="container-fluid content-admin">
    <div class="row">
        <div class="col-md-12">
            <h2><?php _e("Withdrawal History",ST_TEXTDOMAIN) ?></h2>
        </div>
        <div class="col-md-12">

            <?php
            $st_tab = STInput::request('st_tab','all');
            $page=isset($_GET['paged'])?$_GET['paged']:1;
            $limit=10;
            $offset=($page-1)*$limit;
            $data=STAdminWithdrawal::_get_list_withdrawal($st_tab,$offset,$limit,$user_id);
            $posts=$data['rows'];
            $total=ceil($data['total']/$limit);
            global $wp_query;
            $paging=array();
            $name_page = "st-users-partner-withdrawal-menu";
            $paging['base']=admin_url('admin.php?page='.$name_page.'&st_tab='.$st_tab.'&st_action=partner_profile&st_user_id='.$user_id.'%_%');
            $paging['format']='&paged=%#%';
            $paging['total']=$total;
            $paging['current']=$page;
            $paging['current']=$page;
            ?>
            <ul class="subsubsub">
                <li><a class="<?php if($st_tab=="all") echo "current"; ?>" href="<?php echo admin_url("admin.php?page=".$name_page."&st_tab=all&st_action=partner_profile&st_user_id={$user_id}"); ?>"><?php _e("All",ST_TEXTDOMAIN) ?></a> |</li>
                <li><a class="<?php if($st_tab=="partner_request") echo "current"; ?>" href="<?php echo admin_url("admin.php?page=".$name_page."&st_tab=partner_request&st_action=partner_profile&st_user_id={$user_id}"); ?>"><?php _e("Request",ST_TEXTDOMAIN) ?></a> |</li>
                <li><a class="<?php if($st_tab=="partner_completed") echo "current"; ?>" href="<?php echo admin_url("admin.php?page=".$name_page."&st_tab=partner_completed&st_action=partner_profile&st_user_id={$user_id}"); ?>"><?php _e("Completed",ST_TEXTDOMAIN) ?></a> |</li>
                <li><a class="<?php if($st_tab=="partner_cancel") echo "current"; ?>" href="<?php echo admin_url("admin.php?page=".$name_page."&st_tab=partner_cancel&st_action=partner_profile&st_user_id={$user_id}"); ?>"><?php _e("Cancel",ST_TEXTDOMAIN) ?></a></li>
            </ul>
            <div class="tablenav top">
                <div class="alignleft actions bulkactions">
                    <form id="posts-filter" action="<?php echo admin_url('admin.php?page='.$name_page.'&st_tab='.$st_tab.'&st_action=partner_profile&st_user_id='.$user_id)?>" method="get">
                        <input type="hidden" name="page" value="<?php echo esc_html($name_page) ?>">
                        <input type="hidden" name="st_tab" value="<?php echo esc_html($st_tab) ?>">
                        <input type="hidden" name="st_action" value="partner_profile">
                        <input type="hidden" name="st_user_id" value="<?php echo esc_html($user_id) ?>">
                        <input type="text" class="st_datepicker_withdrawal" format="yyyy-mm-dd"  name="st_date_start" placeholder="<?php _e('Filter by Date from',ST_TEXTDOMAIN)  ?>" value="<?php echo STInput::get('st_date_start') ?>"/>
                        <input type="text" class="st_datepicker_withdrawal" format="yyyy-mm-dd" name="st_date_end" placeholder="<?php _e('Filter by Date to',ST_TEXTDOMAIN)  ?>" value="<?php echo STInput::get('st_date_end') ?>"/>
                        <input type="submit" name="filter_action" id="post-query-submit" class="button" value="<?php _e('Filter',ST_TEXTDOMAIN)?>">
                    </form>
                </div>
                <div class="tablenav-pages">
                    <span class="displaying-num"><?php echo sprintf(_n('%s item','%s items',$data['total']),$data['total'],ST_TEXTDOMAIN)  ?></span>
                    <?php echo paginate_links($paging)?>
                </div>
            </div>
                <table class="wp-list-table widefat fixed striped users">
                    <thead>
                    <tr>
                        <td class="manage-column column-cb check-column" id="cb">
                            <label for="cb-select-all-1" class="screen-reader-text"><?php _e("Select All",ST_TEXTDOMAIN) ?></label>
                            <input type="checkbox" id="cb-select-all-1">
                        </td>
                        <th class="manage-column column-username column-primary  desc" id="username" scope="col">
                            <span><?php _e("Created",ST_TEXTDOMAIN) ?></span>
                        </th>
                        <th class="manage-column column-certificates"  scope="col">
                            <?php _e("Amount",ST_TEXTDOMAIN) ?>
                        </th>
                        <th class="manage-column column-certificates" scope="col">
                            <?php _e("Payment",ST_TEXTDOMAIN) ?>
                        </th>
                        <th class="manage-column column-certificates" scope="col">
                            <?php _e("Payment Info",ST_TEXTDOMAIN) ?>
                        </th>
                        <th class="manage-column column-certificates" scope="col">
                            <?php _e("Status",ST_TEXTDOMAIN) ?>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="the-list">
                    <?php

                    $i=0;
                    if(!empty($posts)) {
                        foreach($posts as $key=>$value) {
                            $i++;
                            $user_id=$value->ID;

                            ?>
                            <tr id="user-<?php  echo esc_attr($user_id) ?>">
                                <th class="check-column" scope="row">
                                    <label for="user_<?php  echo esc_attr($user_id) ?>" class="screen-reader-text"></label>
                                    <input type="checkbox" value="<?php  echo esc_attr($user_id) ?>" class="administrator" id="user_<?php  echo esc_attr($user_id) ?>" name="users[]">
                                </th>
                                <td data-colname="" class="role">
                                    <?php
                                    $format=TravelHelper::getDateFormat();
                                    $date = date_i18n( $format , strtotime($value->created) );
                                    ?>
                                    <?php echo esc_html($date) ?>
                                </td>
                                <td data-colname="" class="role">
                                    <?php echo esc_html(TravelHelper::format_money($value->price)) ?>
                                </td>
                                <td data-colname="" class="role">
                                    <?php echo esc_html(ucwords($value->payout)) ?>
                                </td>
                                <td data-colname="" class="role">
                                    <?php echo esc_html(($value->data_payout)) ?>
                                </td>
                                <td data-colname="" class="role">
                                    <span class="title-status">
                                         <?php
                                         if($value->status == "request"){
                                             _e("Request",ST_TEXTDOMAIN);
                                         }
                                         if($value->status == "completed"){
                                             _e("Completed",ST_TEXTDOMAIN);
                                         }
                                         if($value->status == "cancel"){
                                             _e("Cancel",ST_TEXTDOMAIN);
                                         }
                                         ?>
                                    </span>
                                    <div class="row-actions">
                                        <span class="edit">
                                            <a href="javascript:void(0)" class="btn_change_withdrawal_partner_admin"><?php _e("Edit",ST_TEXTDOMAIN) ?></a>
                                        </span>
                                    </div>
                                    <div class="hide content-change content-admin content-<?php  echo esc_attr($user_id) ?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <strong><?php _e("Status",ST_TEXTDOMAIN) ?>:</strong>
                                                <select class="st_status">
                                                    <option value="completed"><?php _e("Completed",ST_TEXTDOMAIN) ?></option>
                                                    <option value="cancel"><?php _e("Cancel",ST_TEXTDOMAIN) ?></option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 content-message" >
                                                <strong><?php _e("Reasons for cancellation",ST_TEXTDOMAIN) ?>:</strong>
                                                <textarea class="st_message" rows="2" ></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="button" class="btn_apply_withdrawal_partner_admin button" data-user-id="<?php  echo esc_attr($user_id) ?>" data-withdrawal-id="<?php  echo esc_attr($value->withdrawal_id) ?>"><?php _e("Apply",ST_TEXTDOMAIN) ?></button>
                                                <button type="button" class="btn_cancel_withdrawal_partner_admin button" ><?php _e("Cancel",ST_TEXTDOMAIN) ?></button>
                                                <img class="st_change_loading" src="<?php echo esc_url(admin_url('/images/wpspin_light.gif')) ?>" alt="<?php echo TravelHelper::get_alt_image(); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    }else{
                        ?>
                        <th colspan="6" class="text-center">
                            <?php _e("No Data",ST_TEXTDOMAIN) ?>
                        </th>
                    <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="manage-column column-cb check-column" id="cb">
                            <label for="cb-select-all-1" class="screen-reader-text"><?php _e("Select All",ST_TEXTDOMAIN) ?></label>
                            <input type="checkbox" id="cb-select-all-1">
                        </td>
                        <th class="manage-column column-username column-primary  desc" id="username" scope="col">
                            <span><?php _e("Created",ST_TEXTDOMAIN) ?></span>
                        </th>
                        <th class="manage-column column-certificates"  scope="col">
                            <?php _e("Amount",ST_TEXTDOMAIN) ?>
                        </th>
                        <th class="manage-column column-certificates" scope="col">
                            <?php _e("Payment",ST_TEXTDOMAIN) ?>
                        </th>
                        <th class="manage-column column-certificates" scope="col">
                            <?php _e("Payment Info",ST_TEXTDOMAIN) ?>
                        </th>
                        <th class="manage-column column-certificates" scope="col">
                            <?php _e("Status",ST_TEXTDOMAIN) ?>
                        </th>
                    </tr>
                    </tfoot>
                </table>
                <div class="tablenav bottom">
                    <div class="tablenav-pages">
                        <span class="displaying-num"><?php echo sprintf(_n('%s item','%s items',$data['total']),$data['total'],ST_TEXTDOMAIN)  ?></span>
                        <?php echo paginate_links($paging)?>
                    </div>
                </div>
                <?php wp_reset_query();?>
        </div>
    </div>
    </div>

<?php
$post_type = array('st_hotel','st_rental','st_tours','st_cars','st_activity');
$check_service = false;
foreach($post_type as $k=>$v){
    if (STUser_f::_check_service_available_partner($v,$user_id)){
        $check_service = true;
    }
} ?>
<?php if($check_service){ ?>
    <div class="container-fluid content-admin" id="content-detail-service">
        <div class="row">
            <div class="col-md-12">
                <h2><?php _e("Detail Service",ST_TEXTDOMAIN) ?></h2>
            </div>
            <div class="col-md-12">
                <h2 class="nav-tab-wrapper">
                    <?php
                    foreach($post_type as $k=>$v){
                        if (STUser_f::_check_service_available_partner($v,$user_id)){
                            $obj = get_post_type_object( $v );
                            ?>
                            <span data-post-type="<?php echo esc_html($v) ?>" class=" st_nav_service_partner nav-tab st-nav-<?php echo esc_html($v) ?> <?php if($k == 0) echo "nav-tab-active"; ?>"><?php echo $obj->labels->singular_name; ?> (<?php echo STAdminWithdrawal::_count_item_post_type_by_user($v,$user_id); ?>)</span>
                        <?php }
                    } ?>
                </h2>
            </div>
            <div class="col-md-12">
                <?php
                foreach($post_type as $k=>$v){
                    if (STUser_f::_check_service_available_partner($v,$user_id)){
                        $data_post_type = STUser::_load_more_service_partner($v,$user_id);
                        $html_post_type = $data_post_type['html'];
                        $number_post = $data_post_type['number_post'];
                        ?>
                        <div class="content-hide content-<?php echo esc_attr($v) ?> <?php if($k==0) echo 'active' ?>">
                            <table class="wp-list-table widefat fixed striped">
                                <thead>
                                <tr>
                                    <th scope="col" id="username" class="manage-column column-username column-primary  desc" style="width: 3%; text-align: center;">
                                        <span>#</span>
                                    </th>
                                    <th scope="col" id="username" class="manage-column column-username column-primary  desc" style="width: 10%;">
                                        <span><?php _e("Image",ST_TEXTDOMAIN) ?></span>
                                    </th>
                                    <th scope="col" id="username" class="manage-column column-username column-primary  desc">
                                        <span><?php _e("Title Service",ST_TEXTDOMAIN) ?></span>
                                    </th>
                                    <th scope="col" class="manage-column">
                                        <?php _e("Price from",ST_TEXTDOMAIN) ?>
                                    </th>
                                    <th scope="col" class="manage-column" width='30%'>
                                        <?php _e("Address",ST_TEXTDOMAIN) ?>
                                    </th>
                                    <th scope="col" class="manage-column">
                                        <?php _e("Date Create",ST_TEXTDOMAIN) ?>
                                    </th>
                                    <th scope="col" class="manage-column" width='10%'>
                                        <?php _e("Status",ST_TEXTDOMAIN) ?>
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="the-list">
                                <?php if(!empty($html_post_type)){ ?>
                                    <?php echo balanceTags($html_post_type) ?>
                                <?php } else{
                                    ?>
                                    <th colspan="6" class="text-center">
                                        <?php _e("No Data",ST_TEXTDOMAIN) ?>
                                    </th>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>

                            <br>
                            <?php if($number_post > 10){ ?>
                                <button class="button btn_load_more_service_partner"
                                        data-post-type="<?php echo esc_html($v) ?>"
                                        data-user-id="<?php echo esc_html($user_id) ?>"
                                        data-paged="2">
                                    <?php _e("Load More",ST_TEXTDOMAIN) ?>
                                </button>
                            <?php } ?>

                        </div>

                    <?php }
                } ?>

            </div>
        </div>
    </div>
<?php } ?>
</div>