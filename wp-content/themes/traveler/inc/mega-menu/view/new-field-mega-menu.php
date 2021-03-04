<?php
//Render data for select mega menu
$args = array(
    'post_type' => 'st_mega_menu',
    'posts_per_page' => -1,
);

$megamenu_query = new WP_Query($args);
?>
<p class="field-custom description description-wide">
    <label for="edit-menu-item-subtitle-<?php echo $item_id; ?>">
        <?php _e( 'Mega Menu' ); ?><br />
        <select id="edit-menu-item-subtitle-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu-item-megamenu[<?php echo $item_id; ?>]">
            <option value="-1"><?php echo __('Disable', ST_TEXTDOMAIN); ?></option>
            <?php
            if ( $megamenu_query->have_posts() ) {
                while ($megamenu_query->have_posts()) {
                    $megamenu_query->the_post();
                    if(get_the_ID() == $item->megamenu){
                        echo '<option value="'. get_the_ID() .'" selected>'. get_the_title() .'</option>';
                    }else{
                        echo '<option value="'. get_the_ID() .'">'. get_the_title() .'</option>';
                    }
                }
            }else{
                echo 'No mega menu found!';
            };
            wp_reset_postdata();
            ?>
        </select>
    </label>
    <small><i><?php echo __('If select Mega Menu, the children item will hidden', ST_TEXTDOMAIN); ?></i></small>
</p>