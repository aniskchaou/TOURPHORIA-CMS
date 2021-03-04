<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 2/25/2019
 * Time: 10:07 AM
 */
echo st()->load_template('layouts/modern/single_hotel/elements/toolbar', '', $attr);
$layout_val = isset($_GET['layout']) ? $_GET['layout'] : $attr['layout'];
?>
<div class="sts-room-wrapper <?php echo $layout_val; ?>">
    <div class="st-loader"></div>
    <?php
    ST_Single_Hotel::inst()->setQueryRoomSearch();
    if (have_posts()) {
        if($layout_val == 'grid')
            echo '<div class="row">';
        while (have_posts()) {
            the_post();
            echo st()->load_template('layouts/modern/single_hotel/elements/loop/' . $layout_val);
        }
        if($layout_val == 'grid')
            echo '</div>';
        echo st()->load_template('layouts/modern/single_hotel/elements/pag');
    } else {
        echo st()->load_template('layouts/modern/single_hotel/elements/loop/none');
    }
    wp_reset_postdata();
    wp_reset_query();
    ?>
</div>
