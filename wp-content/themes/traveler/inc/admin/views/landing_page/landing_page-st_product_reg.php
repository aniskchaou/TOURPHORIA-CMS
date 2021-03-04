<?php
$_purchase_code= get_option('envato_purchasecode');
$has_error = STInput::get('has_error', '');
$deregister = STInput::get('deregister', '');
$has_register = STAdminlandingpage::checkValidatePurchaseCode($_purchase_code);
if(empty($has_error)):
    if(!empty($_purchase_code)){
        if($has_register){
            ?>
            <div class="updated" style="padding: 8px 10px 5px 10px !important; margin-left: 0px; margin-top: 15px;">
                <?php _e('Thank you for registration our theme',ST_TEXTDOMAIN)?>
            </div>
            <?php
        }else{
            ?>
            <div class="error" style="padding: 8px 10px 5px 10px !important; margin-left: 0px; margin-top: 15px;">
                <?php _e('Your Purchase Code is invalid',ST_TEXTDOMAIN)?>
            </div>
            <?php
        }
    }
    ?>
<?php
else:
    if(in_array($has_error, array('1', '2', '3'))) {
        ?>
        <div class="error" style="padding: 8px 10px 5px 10px !important; margin-left: 0px; margin-top: 15px;">
            <?php
            if ($has_error == '1') {
                _e('Your Purchase Code is empty', ST_TEXTDOMAIN);
            } elseif ($has_error == '2') {
                _e('Your Purchase Code is invalid', ST_TEXTDOMAIN);
            } elseif($has_error == '3'){
                _e('Purchase code has been used by another site', ST_TEXTDOMAIN);
            }
            ?>
        </div>
        <?php
    }
endif;
if(in_array($deregister, array('1', '2'))) {
    if($deregister == '1'){
        ?>
        <div class="updated" style="padding: 8px 10px 5px 10px !important; margin-left: 0px; margin-top: 15px;">
            <?php
            _e('Deregistration you purchase code successfully.', ST_TEXTDOMAIN);
            ?>
        </div>
        <?php
    }else{
        ?>
        <div class="error" style="padding: 8px 10px 5px 10px !important; margin-left: 0px; margin-top: 15px;">
            <?php
            _e('Have an error when you deregister purchase code.', ST_TEXTDOMAIN);
            ?>
        </div>
        <?php
    }
}
?>
<div class="traveler-registration-steps">
    <div class="feature-section col three-col">
        <div>
            <h4><?php echo __("Purchase code registration", ST_TEXTDOMAIN) ; ?></h4>
            <form id="traveler_product_registration" method="post" action="<?php echo admin_url('admin.php?page=st_product_reg') ?>">
                <div class="traveler-registration-form">
                    <?php wp_nonce_field( 'traveler_update_registration','traveler_update_registration_nonce' ); ?>
                    <input autocomplete="off" type="text" name="tf_purchase_code" id="tf_purchase_code" placeholder="<?php _e('Enter Themeforest Purchase Code',ST_TEXTDOMAIN)?>" value="<?php echo ($_purchase_code) ?>">

                </div>
                <?php if(empty($_purchase_code) or !$has_register){ ?>
                    <input type="hidden" name="st_action" value="save_product_registration">
                    <button class="button button-large button-primary traveler-large-button traveler-register" type="submit"><?php echo __("Submit", ST_TEXTDOMAIN ) ; ?></button>
                <?php }else{ ?>
                    <input type="hidden" name="st_action" value="un_save_product_registration">
                    <button class="button button-large button-default traveler-large-button traveler-register" type="submit"><?php echo __("Deregistration", ST_TEXTDOMAIN ) ; ?></button>
                <?php } ?>
                <span class="traveler-loader"><i class="dashicons dashicons-update loader-icon"></i><span></span></span>
            </form>
        </div>
    </div>
</div>
<br />