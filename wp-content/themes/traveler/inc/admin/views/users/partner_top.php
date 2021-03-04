<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Admin hotel booking index
 *
 * Created by ShineTheme
 *
 */
$st_tab = STInput::request('st_tab','partner');
$page=isset($_GET['paged'])?$_GET['paged']:1;
$limit=20;
$offset=($page-1)*$limit;
$data=STUser::_admin_get_list_top_partner($offset,$limit);
$posts=$data['rows'];
$total=ceil($data['total']/$limit);
global $wp_query;
$paging=array();
$paging['base']=admin_url('admin.php?page=st-users-top-partner-menu&st_tab='.$st_tab.'%_%');
$paging['format']='&paged=%#%';
$paging['total']=$total;
$paging['current']=$page;
$paging['current']=$page;
echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
echo '<h2>'.__('Top Partner',ST_TEXTDOMAIN).'</h2>';
$base_url = admin_url("admin.php?page=st-users-top-partner-menu&st_tab=".$st_tab);
STAdmin::message();
?>
<div class="tablenav top filter-admin-partner">
    <div class="alignleft actions bulkactions">
        <label for="bulk-action-selector-top" class="screen-reader-text"><?php _e('Select bulk action',ST_TEXTDOMAIN)?></label>
        <form id="posts-filter" action="<?php echo admin_url('admin.php?page=st-users-top-partner-menu')?>" method="get">
            <input type="hidden" name="page" value="<?php echo esc_html('st-users-top-partner-menu') ?>">
            <input type="text" class="st_custommer_name" name="st_custommer_name" placeholder="<?php _e('Filter by customer name',ST_TEXTDOMAIN)  ?>" value="<?php echo STInput::get('st_custommer_name') ?>"/>
            <input type="submit" name="filter_action" id="post-query-submit" class="button" value="<?php _e('Search',ST_TEXTDOMAIN)?>">
        </form>
    </div>
    <div class="tablenav-pages">
        <span class="displaying-num"><?php echo sprintf(_n('%s item','%s items',$data['total']),$data['total'],ST_TEXTDOMAIN)  ?></span>
        <?php echo paginate_links($paging)?>
    </div>
</div>
<form id="posts-filter" action="<?php echo admin_url("admin.php?page=st-users-top-partner-menu&st_tab=".$st_tab)?>" method="post">
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
            <th class="manage-column column-email  desc" id="email" scope="col">
                <span><?php _e("Email",ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-email  desc" id="email" scope="col">
                <span><?php _e("Amount",ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-email  desc" id="email" scope="col">
                <span><?php _e("Service",ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-date" id="date" scope="col">
                <?php _e("Date Register",ST_TEXTDOMAIN) ?>
            </th>
        </tr>
        </thead>
        <tbody id="the-list">
        <?php
        $i=0;
        if(!empty($posts)) {
            foreach($posts as $key=>$value) {
                $i++;
                $user_id=$value->user_id;
                ?>
                <tr id="user-<?php  echo esc_attr($user_id) ?>">
                    <th class="check-column" scope="row">
                        <input type="checkbox" value="<?php  echo esc_attr($user_id) ?>" class="administrator" id="user_<?php  echo esc_attr($user_id) ?>" name="users[]">
                    </th>
                    <td class="username column-username has-row-actions column-primary">
                        <?php echo st_get_profile_avatar( $user_id, 32 ); ?>
                        <strong>
                            <a target="_blank" href="<?php echo admin_url("admin.php?page=st-users-partner-withdrawal-menu&st_action=partner_profile&st_user_id=".$user_id); ?>">
                                <?php echo esc_html($value->user_nicename) ?>
                            </a>
                        </strong>
                        <br>
                        <?php if($st_tab != "partner"){ ?>
                            <div class="row-actions">
                            <span class="edit">
                                <a href="<?php echo admin_url("admin.php?page=st-users-top-partner-menu&st_action=approve_role&user_id=".$user_id."&st_tab=".$st_tab); ?>" class="button"><?php _e("Approved",ST_TEXTDOMAIN) ?></a>
                                <a href="<?php echo admin_url("admin.php?page=st-users-top-partner-menu&st_action=cancel_role&user_id=".$user_id."&st_tab=".$st_tab); ?>" class="button"><?php _e("Cancel",ST_TEXTDOMAIN) ?></a>
                            </span>
                            </div>
                        <?php } ?>
                    </td>
                    <td data-colname="Name" class="name column-name"><?php echo esc_html($value->display_name) ?></td>
                    <td data-colname="Email" class="email column-email">
                        <a href="mailto:<?php echo esc_html($value->user_email) ?>"><?php echo esc_html($value->user_email) ?></a>
                    </td>
                     <td class="manage-column column-email  desc" id="email" scope="col">
                         <?php
                         $total_price_payout = STAdminWithdrawal::_get_total_price_payout($user_id);
                         ?>
                        <span><?php echo esc_html(TravelHelper::format_money($total_price_payout)) ?></span>
                    </td>
                    <td class="content-admin">
                        <div class="row" >
                        <?php $post_type = array('st_hotel','st_rental','st_tours','st_cars','st_activity');
                        foreach($post_type as $k=>$v){
                            if (STUser_f::_check_service_available_partner($v,$user_id)){
                                $obj = get_post_type_object( $v );
                                ?>
                                <div class="col-md-6">
                                    <strong><?php echo $obj->labels->singular_name; ?></strong>:
                                    <?php echo STAdminWithdrawal::_count_item_post_type_by_user($v,$user_id); ?>
                                </div>
                            <?php }
                        } ?>
                        </div>
                    </td>
                    <td data-colname="date" class="role column-date">
                        <?php
                        echo esc_html(date_i18n(get_option('date_format')." ".get_option('time_format'),strtotime($value->user_registered)));
                        ?>
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
            <td class="manage-column column-cb check-column">
                <label for="cb-select-all-2" class="screen-reader-text"><?php _e("Select All",ST_TEXTDOMAIN) ?></label>
                <input type="checkbox" id="cb-select-all-2">
            </td>
            <th class="manage-column column-username column-primary  desc" id="username" scope="col">
                <span><?php _e("Username",ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-name  desc" id="name" scope="col">
                <span><?php _e("Name",ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-email  desc" id="email" scope="col">
                <span><?php _e("Email",ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-email  desc" id="email" scope="col">
                <span><?php _e("Amount",ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-email  desc" id="email" scope="col">
                <span><?php _e("Service",ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-certificates" scope="col"><?php _e("Date Register",ST_TEXTDOMAIN) ?></th>
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

