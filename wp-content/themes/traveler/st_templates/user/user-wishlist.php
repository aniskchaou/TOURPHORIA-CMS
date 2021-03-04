<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User wishlist
 *
 * Created by ShineTheme
 *
 */
?>
<div class="st-create">
    <h2><?php STUser_f::get_title_account_setting() ?></h2>
</div>
<ul id="data_whislist" class="booking-list booking-list-wishlist">
    <?php
    $data_list = get_user_meta( $data->ID , 'st_wishlist' , true);
    if($data_list != '[]') {
        if(!empty($data_list)) {
            $data_list = json_decode($data_list);
            $i = 0;
            foreach ($data_list as $k => $v):
                if ($i < 5):
                    $args = array(
                        'post_type' => $v->type,
                        'post__in' => array($v->id),
                    );
                    query_posts($args);
                    echo st()->load_template('user/loop/loop', 'wishlist', get_object_vars($data_list[$i]));
                    wp_reset_query();
                endif;
                $i++;
            endforeach;
        }else{
            echo '<h1>'.st_get_language('no_wishlist').'</h1>';
        }
    }else{
        echo '<h1>'.st_get_language('no_wishlist').'</h1>';
    } ?>
</ul>
<?php
if($data_list != '[]'){
    if(!empty($data_list)){
?>
    <div>
        <button data-per="5" data-next="5" type="button" class="btn_load_more_wishlist btn btn-primary">
            <?php st_the_language('load_more') ?>
        </button>
    </div>
<?php }} ?>