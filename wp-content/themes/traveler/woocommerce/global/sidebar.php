<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 4/16/15
 * Time: 9:16 AM
 * @version 1.6.4
 */
$sidebar=apply_filters('st_shop_sidebar',array('position'=>'left','id'=>'shop'));
$sidebar_pos=$sidebar['position'];
?>
<div class="col-sm-3 <?php echo ($sidebar_pos=='left')?'sidebar_left_wrap':'sidebar_right_wrap'; ?>">
    <?php
    if($sidebar_pos=="left"){
        echo "<aside class='sidebar-left'>";
    }elseif($sidebar_pos=="right"){
        echo "<aside class='sidebar-right'>";
    }
    ?>
    <?php dynamic_sidebar($sidebar['id']); ?>
    </aside>
</div>