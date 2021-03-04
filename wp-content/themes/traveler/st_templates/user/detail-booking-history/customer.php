
<div class="info">
    <table cellpadding="0" cellspacing="0" width="100%" border="0px" class="tb_cart_customer">
        <tbody>
        <tr>
            <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <strong><?php echo __('First name ' , ST_TEXTDOMAIN) ;  ?></strong></td>
            <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <?php echo get_post_meta($order_id, 'st_first_name', true) ?>
            </td>
        </tr>
        <tr>
            <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <strong><?php echo __('Last name ' , ST_TEXTDOMAIN) ; ?></strong></td>
            <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <?php echo get_post_meta($order_id, 'st_last_name', true) ?>
            </td>
        </tr>
        <tr>
            <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <strong><?php echo __('Email ' , ST_TEXTDOMAIN) ;  ?></strong></td>
            <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <?php echo get_post_meta($order_id, 'st_email', true) ?>
            </td>
        </tr>
        <tr>
            <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <strong><?php echo __('Phone ' , ST_TEXTDOMAIN) ;  ?></strong></td>
            <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <?php echo get_post_meta($order_id, 'st_phone', true) ?>
            </td>
        </tr>

        <tr>
            <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <strong><?php echo __('Address Line 1' , ST_TEXTDOMAIN) ;  ?></strong></td>
            <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <?php echo get_post_meta($order_id, 'st_address', true) ?>
            </td>
        </tr>
        <tr>
            <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <strong><?php echo __('Address Line 2' , ST_TEXTDOMAIN ) ;  ?></strong></td>
            <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <?php echo get_post_meta($order_id, 'st_address2', true) ?>
            </td>
        </tr>
        <tr>
            <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <strong><?php echo __('City' , ST_TEXTDOMAIN) ;  ?></strong></td>
            <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <?php echo get_post_meta($order_id, 'st_city', true) ?>
            </td>
        </tr>
        <tr>
            <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <strong><?php echo __('State/Province/Region' , ST_TEXTDOMAIN) ;  ?></strong></td>
            <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <?php echo get_post_meta($order_id, 'st_province', true) ?>
            </td>
        </tr>
        <tr>
            <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <strong><?php echo __('ZIP code/Postal code' , ST_TEXTDOMAIN) ;  ?></strong></td>
            <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <?php echo get_post_meta($order_id, 'st_zip_code', true) ?>
            </td>
        </tr>
        <tr>
            <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <strong><?php echo __('Country' , ST_TEXTDOMAIN) ;  ?></strong></td>
            <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <?php echo get_post_meta($order_id, 'st_country', true) ?>
            </td>
        </tr>
        <tr>
            <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
                <strong><?php echo __('Special Requirements' , ST_TEXTDOMAIN) ;  ?></strong></td>
            <td align="right" class="text-right"
                style="border-bottom: 1px dashed #ccc;padding:10px;vertical-align: top">
                <?php echo get_post_meta($order_id, 'st_note', true) ?>
            </td>
        </tr>
        </tbody>
    </table>
</div>