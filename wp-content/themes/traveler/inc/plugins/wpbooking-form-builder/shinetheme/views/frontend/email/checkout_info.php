<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 1/3/2017
 * Version: 1.0
 */

$form_billing_data = '';
if(!empty($order_id)){
    $form_billing_data = get_post_meta($order_id, 'wb_form_for_order', true);
}
do_action('wpbooking_before_checkout_form_data_preview');

?>
<div class=content-row>

    <?php
    if(!empty($form_billing_data)){
        foreach($form_billing_data as $key => $value){
            $field_meta = get_post_meta($order_id, 'wpbooking_'.$value['name'], true);
            if(!empty($field_meta)){
                switch($value['field_type']){
                    case 'country_dropdown':
                        $list_country = wb_list_country();
                        ?>
                        <div class="col-5 wb_form_builder_<?php echo esc_attr($value['name'])?>">
                            <label><?php echo esc_html($value['title']); ?> </label>
                            <p><?php echo esc_html($list_country[$field_meta]) ?></p>
                        </div>
                        <?php
                        break;
                    case 'post_select':
                        ?>
                        <div class="col-5 wb_form_builder_<?php echo esc_attr($value['name'])?>">
                            <label><?php echo esc_html($value['title']); ?> </label>
                            <p><?php echo get_the_title($field_meta); ?></p>
                        </div>
                        <?php
                        break;
                    case 'taxonomy_select':
                        $term = get_term_by('id', $field_meta, $value['taxonomy']);
                        ?>
                        <div class="col-5 wb_form_builder_<?php echo esc_attr($value['name'])?>">
                            <label><?php echo esc_html($value['title']); ?> </label>
                            <p><?php echo esc_html($term->name); ?></p>
                        </div>
                        <?php
                        break;
                    case 'image_upload':
                        ?>
                        <div class="col-5 wb_form_builder_<?php echo esc_attr($value['name'])?>">
                            <label><?php echo esc_html($value['title']); ?> </label>
                            <p><?php echo wp_get_attachment_image($field_meta, array(100,50), true); ?></p>
                        </div>
                        <?php
                        break;
                    case 'radio':
                    case 'dropdown':
                        ?>
                        <div class="col-5 wb_form_builder_<?php echo esc_attr($value['name'])?>">
                            <label><?php echo esc_html($value['title']); ?> </label>
                            <p><?php echo esc_html($value['option_value'][$field_meta]); ?></p>
                        </div>
                        <?php
                        break;
                    case 'checkbox':
                        ?>
                        <div class="col-5 wb_form_builder_<?php echo esc_attr($value['name'])?>">
                            <label><?php echo esc_html($value['title']); ?> </label>
                        </div>
                        <?php
                        break;
                    default:
                        ?>
                        <div class="col-5 wb_form_builder_<?php echo esc_attr($value['name'])?>">
                            <label><?php echo esc_html($value['title']); ?> </label>
                            <p><?php echo esc_html($field_meta) ?></p>
                        </div>
                        <?php
                        break;
                }

            }
        }
    }
    ?>
    <div class=col-12>
        <div class=text-center>
            <?php
            $page_account = wpbooking_get_option('myaccount-page');
            if(!empty($page_account)){
                $link_page = get_permalink($page_account);
                ?>
                <a href="<?php echo esc_url($link_page) ?>tab/booking_history/" class="btn_history"><?php esc_html_e("Booking History","wpbooking") ?></a>
            <?php } ?>
        </div>
    </div>
</div>
<?php do_action('wpbooking_end_checkout_form_data_preview');?>

