<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 4/8/2019
 * Time: 3:44 PM
 */
?>
<div class="user-inventory">
    <?php
    if (class_exists('ST_Inventory_Field')) {
        ot_type_inventory_html();
    }
    ?>
</div>
