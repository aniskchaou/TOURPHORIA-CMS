<?php
$checkout_fields = $form_data;

if(!empty($checkout_fields)){
?>
<div class="info">
    <table cellpadding="0" cellspacing="0" width="100%" border="0px" class="tb_cart_customer">
        <tbody>
        <?php foreach($checkout_fields as $key => $val){ ?>
        <tr>
            <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <strong><?php echo esc_attr($val['label']);  ?></strong></td>
            <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <?php
                $field_meta = get_post_meta($order_id, $val['name'], true);
                if(!empty($field_meta)){
                    switch($val['type']){
                        case 'country_dropdown':
                            $list_country = wb_list_country();
                        
                            echo esc_html($list_country[$field_meta]);
                            break;
                        case 'post_select':
                            echo get_the_title($field_meta);
                            break;
                        case 'taxonomy_select':
                            $term = get_term_by('id', $field_meta, $val['taxonomy']);
                            if(!empty($term->name)){
                                echo esc_html($term->name);
                            }
                            break;
                        case 'image_upload':
                            $size_image = 'thumbnail';
                            $size_image = apply_filters('st_form_builder_custommer_image_size', $size_image);
                            $type = get_post_mime_type($field_meta);
                            $text_info = '';
                            switch ($type) {
                                case 'application/zip':
                                case 'application/javascript':
                                    $text_info .= '<i class="fa fa-download" aria-hidden="true"></i> <a download href="'. wp_get_attachment_url($field_meta) .'">'. __('Download file', ST_TEXTDOMAIN) .'</a> ';
                                    break;
                                default:
                                    break;
                            }
                            echo $text_info . wp_get_attachment_image($field_meta, $size_image, true);
                            break;
                        case 'radio':
                        case 'dropdown':
                            echo esc_html($val['option_value'][$field_meta]);
                            break;
                        case 'checkbox':
                            if(!empty($field_meta)){
                                echo esc_html($val['title']);
                            }
                            break;
                        default:
                            echo esc_html($field_meta);
                            break;
                        }
                    }

                  ?>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php } ?>