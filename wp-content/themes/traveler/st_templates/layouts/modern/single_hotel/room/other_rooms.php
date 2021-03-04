<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/7/2019
 * Time: 5:11 PM
 */
$args = [
    'post_type'   => 'hotel_room',
    's'           => '',
    'post_status' => [ 'publish' ],
    'posts_per_page' => 2,
    'post__not_in ' => array(get_the_ID())
];
$query = new WP_Query($args);
?>
<div class="sts-other-rooms">
    <div class="container">
        <div class="section-title sts-pf-font"><?php echo __('Other Rooms', ST_TEXTDOMAIN); ?></div>
        <?php
        if($query->have_posts()){
            echo '<div class="sts-room-wrapper grid"><div class="row">';
            while($query->have_posts()){
                $query->the_post();
                echo st()->load_template('layouts/modern/single_hotel/elements/loop/grid', '', array('other_room' => true));
            }
            echo '</div></div>';
        }
        wp_reset_postdata();
        ?>
    </div>
</div>