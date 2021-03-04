<?php

$user_id = $user->ID;
$st_certificates = get_user_meta($user_id,'st_certificates',true);
?>

<?php if(!empty($st_certificates)){ ?>
    <table class="form-table">
        <tbody>
            <tr>
                <th><label for="certificates"><?php _e("Certificates",ST_TEXTDOMAIN) ?></label></th>
                <td>
                    <?php foreach($st_certificates as $k=>$v){ ?>
                        <?php echo esc_html($v['name']) ?> : <a href="<?php echo esc_url($v['image']) ?>" class="thickbox" ><?php _e("Click Here",ST_TEXTDOMAIN) ?></a> <br>
                    <?php } ?>
                </td>
            </tr>
        </tbody>
    </table>
<?php } ?>