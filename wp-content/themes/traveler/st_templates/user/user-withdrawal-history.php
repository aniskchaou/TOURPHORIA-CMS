<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User Withdrawal
 *
 * Created by ShineTheme
 *
 */
$html = STWithdrawal::get_list_withdrawal();
?>
<div class="st-create">
    <h2  class="pull-left"><?php _e("Withdrawal History",ST_TEXTDOMAIN) ?></h2>
</div>
<div class="msg"></div>
<?php
if(!empty($html)) {
    ?>
    <table class="table table-bordered table-striped table-booking-history">
        <thead>
        <tr class="bg-green">
            <th width="20%"><?php _e( "Created" , ST_TEXTDOMAIN ) ?></th>
            <th><?php _e( "Price" , ST_TEXTDOMAIN ) ?></th>
            <th width="20%"><?php _e( "Payment gateway" , ST_TEXTDOMAIN ) ?></th>
            <th><?php _e( "Payment info" , ST_TEXTDOMAIN ) ?></th>
            <th width="10%"><?php _e( "Status" , ST_TEXTDOMAIN ) ?></th>
            <th width="10%"><?php _e( "Control" , ST_TEXTDOMAIN ) ?></th>
        </tr>
        </thead>
        <tbody id="data_history_withdrawal">
        <?php echo $html ?>
        </tbody>
    </table>
    <span data-per="2" class="btn btn-primary btn_load_his_withdrawal"><?php _e( "Load More" , ST_TEXTDOMAIN ) ?></span>
<?php
}else{
    echo '<h5>'.__("No Withdrawal History",ST_TEXTDOMAIN).'</h5>';
}