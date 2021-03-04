<?php
return;
$user_id = $user->ID;
$st_partner_service = get_user_meta($user_id,'st_partner_service',true);
$roles = $user->roles;
$roles = array_shift($roles);
?>
<table id="partner_service" class="form-table <?php if($roles == 'partner') echo "show" ; else echo "hide"?>">
    <tbody>
        <tr>
            <th><label for="certificates"><?php _e("Partner Service",ST_TEXTDOMAIN) ?></label></th>
            <td>
                <?php if(st_check_service_available('st_hotel')){ ?>
                    <input type="checkbox" style="width: auto" <?php if(!empty($st_partner_service['st_hotel'])) echo "checked"; ?> class="regular-text" value="st_hotel" id="" name="st_partner_service[]">
                    <?php _e("Hotel",ST_TEXTDOMAIN) ?>
                    <br>
                <?php } ?>

                <?php if(st_check_service_available('st_rental')){ ?>
                    <input type="checkbox" style="width: auto" <?php if(!empty($st_partner_service['st_rental'])) echo "checked"; ?> class="regular-text" value="st_rental" id="" name="st_partner_service[]">
                    <?php _e("Rental",ST_TEXTDOMAIN) ?>
                    <br>
                <?php } ?>

                <?php if(st_check_service_available('st_cars')){ ?>
                    <input type="checkbox" style="width: auto" <?php if(!empty($st_partner_service['st_cars'])) echo "checked"; ?> class="regular-text" value="st_cars" id="" name="st_partner_service[]">
                    <?php _e("Car",ST_TEXTDOMAIN) ?>
                    <br>
                <?php } ?>

                <?php if(st_check_service_available('st_tours')){ ?>
                    <input type="checkbox" style="width: auto" <?php if(!empty($st_partner_service['st_tours'])) echo "checked"; ?> class="regular-text" value="st_tours" id="" name="st_partner_service[]">
                    <?php _e("Tour",ST_TEXTDOMAIN) ?>
                    <br>
                <?php } ?>

                <?php if(st_check_service_available('st_activity')){ ?>
                    <input type="checkbox" style="width: auto" <?php if(!empty($st_partner_service['st_activity'])) echo "checked"; ?> class="regular-text" value="st_activity" id="" name="st_partner_service[]">
                    <?php _e("Activity",ST_TEXTDOMAIN) ?>
                    <br>
                <?php } ?>
            </td>
        </tr>
    </tbody>
</table>

