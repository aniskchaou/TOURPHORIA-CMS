<?php
/**
 * Created by ShineTheme.
 * User: Nasanji
 * Date: 12/22/2016
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$forms = ST_Form_Builder_Models::inst()->get_all_form();

$create_url = add_query_arg(array(
    'page' => 'wb_page_form_builder',
    'action' => 'create_new'
), admin_url('admin.php'));

?>
<div class="manage-menus">

        <?php
        if(is_array($forms) && count($forms) > 0){
            ?>
            <form method="get" action="<?php echo esc_url(admin_url('admin.php'))?>">
                <input type="hidden" name="page" value="wb_page_form_builder">
                <label for="select-form-to-edit" class="selected-menu"><?php echo esc_html__('Select a form to edit:',ST_TEXTDOMAIN)?></label>
                <select name="form" id="select-form-to-edit" >
                    <?php
                    if(WB_Form_Builder_Input::get('action') == 'create_new'){
                        $form_id = '';
                        echo '<option selected="selected" value="0">'.esc_html__('--Select form--',ST_TEXTDOMAIN).'</option>';
                    }
                    ?>

                    <?php
                    foreach ($forms as $key => $val) {
                        echo '<option value="'.$val['id'].'" '.selected($val['id'],$form_id, false).'>'.$val['name'].'</option>';
                    }
                        
                    wp_reset_postdata();
                    ?>
                </select>
                <span class="submit-btn"><input type="submit" class="button" value="Select"></span>
			<span class="add-new-menu-action">
				<?php echo esc_html__('or',ST_TEXTDOMAIN)?> <a href="<?php echo esc_url($create_url);?>"><?php echo esc_html__('create a new form',ST_TEXTDOMAIN)?></a>.
            </span>
            </form>
            <?php
        }else{
            ?>
            <span class="add-edit-menu-action">
                <?php echo esc_html__('Edit your form below, or',ST_TEXTDOMAIN);?>
                <a href="<?php echo esc_url($create_url);?>"><?php echo esc_html__('create a new form',ST_TEXTDOMAIN)?></a>.
            </span>
        <?php
        }
        ?>

</div>
