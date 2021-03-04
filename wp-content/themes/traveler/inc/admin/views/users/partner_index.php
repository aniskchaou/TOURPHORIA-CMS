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
$data=STUser::get_list_partner($st_tab,$offset,$limit);
$posts=$data['rows'];
$total=ceil($data['total']/$limit);
global $wp_query;
$paging=array();
$paging['base']=admin_url('admin.php?page=st-users-list-partner-menu&st_tab='.$st_tab.'%_%');
$paging['format']='&paged=%#%';
$paging['total']=$total;
$paging['current']=$page;
$paging['current']=$page;
echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
echo '<h2>'.__('User Partner',ST_TEXTDOMAIN).'</h2>';
$base_url = admin_url("admin.php?page=st-users-list-partner-menu&st_tab=".$st_tab);
STAdmin::message();

$total_partner=STUser::get_list_partner('partner',0,1);
$total_partner_pending=STUser::get_list_partner('partner_pending',0,1);
$total_partner_update=STUser::get_list_partner('partner_update',0,1);
?>
<ul class="subsubsub">
    <li><a class="<?php if($st_tab=="partner") echo "current"; ?>" href="<?php echo admin_url("admin.php?page=st-users-list-partner-menu&st_tab=partner"); ?>"><?php _e("Partner",ST_TEXTDOMAIN) ?> (<?php echo esc_html($total_partner['total']) ?>) </a> |</li>
    <li><a class="<?php if($st_tab=="partner_pending") echo "current"; ?>" href="<?php echo admin_url("admin.php?page=st-users-list-partner-menu&st_tab=partner_pending"); ?>"><?php _e("Partner Pending",ST_TEXTDOMAIN) ?> (<?php echo esc_html($total_partner_pending['total']) ?>) </a> |</li>
    <li><a class="<?php if($st_tab=="partner_update") echo "current"; ?>" href="<?php echo admin_url("admin.php?page=st-users-list-partner-menu&st_tab=partner_update"); ?>"><?php _e("Partner Upgrade",ST_TEXTDOMAIN) ?> (<?php echo esc_html($total_partner_update['total']) ?>)</a> |</li>
    <li class="partner-expire-date"><a class="<?php if($st_tab=="partner_expire") echo "current"; ?>" href="<?php echo admin_url("admin.php?page=st-users-list-partner-menu&st_tab=partner_expire"); ?>"><?php _e("Partner Expires",ST_TEXTDOMAIN) ?></a></li>
</ul>


<div class="tablenav top filter-admin-partner">
    <div class="alignleft actions bulkactions">
        <label for="bulk-action-selector-top" class="screen-reader-text"><?php _e('Select bulk action',ST_TEXTDOMAIN)?></label>
        <form id="posts-filter" action="<?php echo admin_url('admin.php?page=st-users-list-partner-menu')?>" method="get" style="display: inline-block">
            <input type="hidden" name="page" value="st-users-list-partner-menu">
            <input type="hidden" name="st_tab" value="<?php echo esc_html(STInput::request('st_tab','partner')) ?>">
            <input type="text" class="st_custommer_name" name="st_custommer_name" placeholder="<?php _e('Filter by customer name',ST_TEXTDOMAIN)  ?>" value="<?php echo STInput::get('st_custommer_name') ?>"/>
            <?php if($st_tab == 'partner_expire'){ ?>
                <input type="number" class="st_custommer_daydiff" name="st_custommer_daydiff" placeholder="<?php _e('Number of days',ST_TEXTDOMAIN)  ?>" value="<?php echo STInput::get('st_custommer_daydiff') ?>"/>
            <?php } ?>
            <input type="submit" name="filter_action" id="post-query-submit" class="button" value="<?php _e('Search',ST_TEXTDOMAIN)?>">
        </form>
    </div>
    <div class="tablenav-pages">
        <span class="displaying-num"><?php echo sprintf(_n('%s item','%s items',$data['total']),$data['total'],ST_TEXTDOMAIN)  ?></span>
        <?php echo paginate_links($paging)?>
    </div>
</div>
<?php if($st_tab != 'partner_expire'){ ?>
    <form id="posts-filter" action="<?php echo admin_url("admin.php?page=st-users-list-partner-menu&st_tab=".$st_tab)?>" method="post">
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
                    <span><?php _e("Service",ST_TEXTDOMAIN) ?></span>
                </th>
                <th class="manage-column column-date" id="date" scope="col">
                    <?php _e("Member package",ST_TEXTDOMAIN) ?>
                </th>
                <th class="manage-column column-date" id="date" scope="col">
                    <?php _e("Package Status",ST_TEXTDOMAIN) ?>
                </th>
                <th class="manage-column column-date" id="date" scope="col">
                    <?php _e("Expiration date",ST_TEXTDOMAIN) ?>
                </th>
                <th class="manage-column column-date" id="date" scope="col">
                    <?php _e("Date Register",ST_TEXTDOMAIN) ?>
                </th>
                <?php if($st_tab == 'partner'){ ?>
                    <th class="manage-column column-date" id="date" scope="col">
                        <?php _e("Verifications",ST_TEXTDOMAIN) ?>
                    </th>
                    <th></th>
                <?php } ?>
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
                            <label for="user_<?php  echo esc_attr($user_id) ?>" class="screen-reader-text">Select admin</label>
                            <input type="checkbox" value="<?php  echo esc_attr($user_id) ?>" class="administrator" id="user_<?php  echo esc_attr($user_id) ?>" name="users[]">
                        </th>
                        <td class="username column-username has-row-actions column-primary">
                            <?php echo get_avatar( $user_id, 32, null, TravelHelper::get_alt_image() ); ?>
                            <strong>
                                <a target="_blank" href="<?php echo admin_url("/user-edit.php?user_id=" . $user_id); ?>">
                                    <?php echo esc_html($value->user_nicename) ?>
                                </a>
                            </strong>
                            <br>
                            <?php if($st_tab != "partner"){ ?>
                                <div class="row-actions">
                            <span class="edit">
                                <a href="<?php echo admin_url("admin.php?page=st-users-list-partner-menu&st_action=approve_role&user_id=".$user_id."&st_tab=".$st_tab); ?>" class="button"><?php _e("Approved",ST_TEXTDOMAIN) ?></a>
                                <a href="<?php echo admin_url("admin.php?page=st-users-list-partner-menu&st_action=cancel_role&user_id=".$user_id."&st_tab=".$st_tab); ?>" class="button"><?php _e("Cancel",ST_TEXTDOMAIN) ?></a>
                            </span>
                                </div>
                            <?php } ?>
                        </td>
                        <td data-colname="Name" class="name column-name"><?php echo esc_html($value->display_name) ?></td>
                        <td data-colname="Email" class="email column-email">
                            <a href="mailto:<?php echo esc_html($value->user_email) ?>"><?php echo esc_html($value->user_email) ?></a>
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
                            $cls_package = STPackages::get_inst();
                            $order       = $cls_package->get_order_package_by( "partner = {$user_id}" );
                            if ( $order ) {
                                $currency = get_post_meta( $order->id , 'currency' , true );
                                $currency = ( isset( $currency[ 'symbol' ] ) ) ? $currency[ 'symbol' ] : '';
                                echo esc_attr( $order->package_name ) . ' (' . TravelHelper::format_money_raw( $order->package_price, $currency ) . ')';
                            }
                            ?>
                        </td>
                        <td data-colname="date" class="role column-date">
                            <?php
                            if ( $order ) {
                                $link_completed = add_query_arg( [
                                    'order_id'     => $order->id,
                                    'order_status' => 'completed',
                                    'order_user'   => $user_id,
                                    'security'     => wp_create_nonce( 'st-security' )
                                ], admin_url( '/admin.php?page=st-users-list-partner-menu' ) );

                                $link_incomplete = add_query_arg( [
                                    'order_id'     => $order->id,
                                    'order_status' => 'incomplete',
                                    'order_user'   => $user_id,
                                    'security'     => wp_create_nonce( 'st-security' )
                                ], admin_url( '/admin.php?page=st-users-list-partner-menu' ) );

                                $link_cancelled = add_query_arg( [
                                    'order_id'     => $order->id,
                                    'order_status' => 'cancelled',
                                    'order_user'   => $user_id,
                                    'security'     => wp_create_nonce( 'st-security' )
                                ], admin_url( '/admin.php?page=st-users-list-partner-menu' ) );

                                $link_deleted = add_query_arg( [
                                    'order_id'     => $order->id,
                                    'order_status' => 'deleted',
                                    'order_user'   => $user_id,
                                    'security'     => wp_create_nonce( 'st-security' )
                                ], admin_url( '/admin.php?page=st-users-list-partner-menu' ) );

                                $rows_action = '<div class="row-actions">
                                                <span><a href="' . esc_url( $link_completed ) . '" title="' . __( 'Completed', ST_TEXTDOMAIN ) . '">' . __( 'Completed', ST_TEXTDOMAIN ) . '</a></span> |
                                                <span><a href="' . esc_url( $link_incomplete ) . '" title="' . __( 'Incomplete', ST_TEXTDOMAIN ) . '">' . __( 'Incomplete', ST_TEXTDOMAIN ) . '</a></span> |
                                                <span><a href="' . esc_url( $link_cancelled ) . '" title="' . __( 'Cancelled', ST_TEXTDOMAIN ) . '">' . __( 'Cancelled', ST_TEXTDOMAIN ) . '</a></span> | 
                                                <span><a href="' . esc_url( $link_deleted ) . '" title="' . __( 'Delete', ST_TEXTDOMAIN ) . '">' . __( 'Delete', ST_TEXTDOMAIN ) . '</a></span>
                                            </div>';
                                echo  esc_attr( $order->status ) . $rows_action;
                            }
                            ?>
                        </td>
                        <td data-colname="date" class="role column-date">
                            <?php
                            if ( $order ) {
                                $created    = (int) $order->created;
                                $time       =  $order->package_time;
                                if($time == 'unlimited'){
                                    $expiration = esc_html__('Unlimited', ST_TEXTDOMAIN );
                                }else{
                                    $expiration = date( 'Y-m-d', strtotime( '+' . (int)$time . ' days', $created ) );
                                    $expiration = date_i18n(get_option('date_format'),strtotime($expiration));
                                }
                                echo esc_attr( $expiration );
                            }
                            ?>
                        </td>
                        <td data-colname="date" class="role column-date">
                            <?php
                            echo esc_html(date_i18n(get_option('date_format')." ".get_option('time_format'),strtotime($value->user_registered)));
                            ?>
                        </td>
	                    <?php if($st_tab == 'partner'){ ?>
                            <td colspan="2">
                                <div class="verify-info">
                                    <button class="verify-view btn btn-primary" data-user_id ="<?php echo $user_id; ?>" data-nonce="<?php echo wp_create_nonce( 'user_verifications' ); ?>">
                                        <?php echo __("View detail", ST_TEXTDOMAIN); ?>
                                    </button>
                                    &nbsp;
                                    <?php echo STUser::verify_status($user_id)['html']; ?>
                                </div>
                            </td>
                        <?php } ?>
                    </tr>
                    <?php
                }
            }else{
                ?>
                <th colspan="9" class="text-center">
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
                <th class="manage-column column-username column-primary desc" scope="col">
                    <span><?php _e("Username",ST_TEXTDOMAIN) ?></span>
                </th>
                <th class="manage-column column-name sortable desc" scope="col">
                    <span><?php _e("Name",ST_TEXTDOMAIN) ?></span>
                </th>
                <th class="manage-column column-email sortable desc" scope="col">
                    <span><?php _e("Email",ST_TEXTDOMAIN) ?></span>
                </th>
                <th class="manage-column column-email  desc" id="email" scope="col">
                    <span><?php _e("Service",ST_TEXTDOMAIN) ?></span>
                </th>
                <th class="manage-column column-date" id="date" scope="col">
                    <?php _e("Member package",ST_TEXTDOMAIN) ?>
                </th>
                <th class="manage-column column-date" id="date" scope="col">
                    <?php _e("Package Status",ST_TEXTDOMAIN) ?>
                </th>
                <th class="manage-column column-date" id="date" scope="col">
                    <?php _e("Expiration date",ST_TEXTDOMAIN) ?>
                </th>
                <th class="manage-column column-certificates" scope="col"><?php _e("Date Register",ST_TEXTDOMAIN) ?></th>
	            <?php if($st_tab == 'partner'){ ?>
                <th class="manage-column column-date" id="date" scope="col">
		            <?php _e("Verifications",ST_TEXTDOMAIN) ?>
                </th>
                <th></th>
                <?php } ?>
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
<?php }else{
    include_once ('partner_expire.php');
} ?>
</div>

<div id="user-verify-detail" class="user-verify-detail" data-id="outsite">
    <div class="modal-content">
        <div class="close">+</div>
        <div class="loader">Loading...</div>
        <div class="content-append"></div>
    </div>
    <div class="st-text" data-text_verfied="<?php echo __('Verified', ST_TEXTDOMAIN); ?>" data-text_apart="<?php echo __('A Part', ST_TEXTDOMAIN); ?>" data-text_notverify="<?php echo __('Not Verified', ST_TEXTDOMAIN); ?>" data-text_sendnotice="<?php echo __('Send notice', ST_TEXTDOMAIN); ?>" data-text_noticerequired="<?php echo __('Notice is required.', ST_TEXTDOMAIN); ?>"></div>
</div>