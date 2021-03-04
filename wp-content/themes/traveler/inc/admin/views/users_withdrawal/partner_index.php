<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Admin
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' ); 
wp_enqueue_script( 'st-custom-partner' );

$st_tab = STInput::request('st_tab','all');
$page=isset($_GET['paged'])?$_GET['paged']:1;
$limit=20;
$offset=($page-1)*$limit;
$data=STAdminWithdrawal::_get_list_withdrawal($st_tab,$offset,$limit);
$posts=$data['rows'];
$total=ceil($data['total']/$limit);
global $wp_query;
$paging=array();
$name_page = "st-users-partner-withdrawal-menu";
$paging['base']=admin_url('admin.php?page='.$name_page.'&st_tab='.$st_tab.'%_%');
$paging['format']='&paged=%#%';
$paging['total']=$total;
$paging['current']=$page;
$paging['current']=$page;
echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
echo '<h2>'.__('Partner Withdrawal',ST_TEXTDOMAIN).'</h2>';
$base_url = admin_url("admin.php?page=".$name_page."&st_tab=".$st_tab);
STAdmin::message();
?>
<ul class="subsubsub">
    <li><a class="<?php if($st_tab=="all") echo "current"; ?>" href="<?php echo admin_url("admin.php?page=".$name_page."&st_tab=all"); ?>"><?php _e("All",ST_TEXTDOMAIN) ?></a> |</li>
    <li><a class="<?php if($st_tab=="partner_request") echo "current"; ?>" href="<?php echo admin_url("admin.php?page=".$name_page."&st_tab=partner_request"); ?>"><?php _e("Request",ST_TEXTDOMAIN) ?></a> |</li>
    <li><a class="<?php if($st_tab=="partner_completed") echo "current"; ?>" href="<?php echo admin_url("admin.php?page=".$name_page."&st_tab=partner_completed"); ?>"><?php _e("Completed",ST_TEXTDOMAIN) ?></a> |</li>
    <li><a class="<?php if($st_tab=="partner_cancel") echo "current"; ?>" href="<?php echo admin_url("admin.php?page=".$name_page."&st_tab=partner_cancel"); ?>"><?php _e("Cancel",ST_TEXTDOMAIN) ?></a></li>
</ul>
<div class="tablenav top">
    <div class="alignleft actions bulkactions">
        <form id="posts-filter" action="<?php echo admin_url('admin.php?page='.$name_page.'&st_tab='.$st_tab)?>" method="get">
            <input type="hidden" name="page" value="<?php echo esc_html($name_page) ?>">
            <input type="hidden" name="st_tab" value="<?php echo esc_html($st_tab) ?>">
            <input type="text" class="st_custommer_name"   name="st_custommer_name" placeholder="<?php _e('Filter by customer name',ST_TEXTDOMAIN)  ?>" value="<?php echo STInput::get('st_custommer_name') ?>"/>
            <input type="text" class="st_datepicker_withdrawal" format="yyyy-mm-dd"  name="st_date_start" placeholder="<?php _e('Filter by Date from',ST_TEXTDOMAIN)  ?>" value="<?php echo STInput::get('st_date_start') ?>"/>
            <input type="text" class="st_datepicker_withdrawal" format="yyyy-mm-dd" name="st_date_end" placeholder="<?php _e('Filter by Date to',ST_TEXTDOMAIN)  ?>" value="<?php echo STInput::get('st_date_end') ?>"/>
            <input type="submit" name="filter_action" id="post-query-submit" class="button" value="<?php _e('Apply',ST_TEXTDOMAIN)?>">
        </form>
    </div>
    <div class="tablenav-pages">
        <span class="displaying-num"><?php echo sprintf(_n('%s item','%s items',$data['total']),$data['total'],ST_TEXTDOMAIN)  ?></span>
        <?php echo paginate_links($paging)?>
    </div>
</div>
<form id="posts-filter" action="<?php echo admin_url("admin.php?page=".$name_page."&st_tab=".$st_tab)?>" method="post">
    <?php wp_nonce_field('shb_action','shb_field')?>
    <table class="wp-list-table widefat fixed striped users">
        <thead>
            <tr>
                <td class="manage-column column-cb check-column" id="cb">
                    <label for="cb-select-all-1" class="screen-reader-text"><?php _e("Select All",ST_TEXTDOMAIN) ?></label>
                    <input type="checkbox" id="cb-select-all-1">
                </td>
                <th class="manage-column column-username column-primary  desc" id="username" scope="col">
                    <span><?php _e("Username",ST_TEXTDOMAIN) ?></span>
                </th>
                <th class="manage-column column-name  desc" id="name" scope="col">
                    <span><?php _e("Name",ST_TEXTDOMAIN) ?></span>
                </th>
                <th class="manage-column column-certificates"  scope="col">
                    <?php _e("Amount",ST_TEXTDOMAIN) ?>
                </th>
                <th class="manage-column column-certificates" scope="col">
                    <?php _e("Payment",ST_TEXTDOMAIN) ?>
                </th>
                <th class="manage-column column-certificates" scope="col">
                    <?php _e("Info Payment",ST_TEXTDOMAIN) ?>
                </th>
                <th class="manage-column column-certificates" scope="col">
                    <?php _e("Created",ST_TEXTDOMAIN) ?>
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
                    <td class="username column-username has-row-actions column-primary">
                        <?php echo st_get_profile_avatar( $user_id, 32 ); ?>
                        <strong>
                            <a target="_blank" href="<?php echo admin_url("admin.php?page=".$name_page."&st_action=partner_profile&st_user_id=".$user_id); ?>">
                                <?php echo esc_html($value->user_nicename) ?>
                            </a>
                        </strong>
                        <br>
                    </td>
                    <td data-colname="Name" class="name column-name"><?php echo esc_html($value->display_name) ?></td>
                    <td data-colname="" class="role">
                        <?php echo esc_html(TravelHelper::format_money($value->price)) ?>
                    </td>
                    <td data-colname="" class="role">
                       <?php echo esc_html(ucwords($value->payout)) ?>
                    </td>
                    <td data-colname="" class="role">
                        <?php echo esc_html($value->data_payout) ?>
                    </td>
                    <td data-colname="" class="role">
                        <?php
                        $format=TravelHelper::getDateFormat();
                        $date = date_i18n( $format , strtotime($value->created) );
                        ?>
                        <?php echo esc_html($date) ?>
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
            <th colspan="7" class="text-center">
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
                <span><?php _e("Username",ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-name  desc" id="name" scope="col">
                <span><?php _e("Name",ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-certificates"  scope="col">
                <?php _e("Amount",ST_TEXTDOMAIN) ?>
            </th>
            <th class="manage-column column-certificates" scope="col">
                <?php _e("Payment",ST_TEXTDOMAIN) ?>
            </th>
            <th class="manage-column column-certificates" scope="col">
                <?php _e("Info Payment",ST_TEXTDOMAIN) ?>
            </th>
            <th class="manage-column column-certificates" scope="col">
                <?php _e("Created",ST_TEXTDOMAIN) ?>
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
</form>
</div>

