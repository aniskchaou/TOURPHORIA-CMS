<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/7/2019
 * Time: 11:19 AM
 */
get_header('hotel-activity'); ?>
    <div class="st-single-hotel-modern-page sts-single-room-alone">
        <?php echo st()->load_template('layouts/modern/single_hotel/elements/banner', '', array('is_room_alone' => true)); ?>

        <?php
        while (have_posts()) {
            the_post();
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-lg-push-9 col-md-push-8">
                        <?php echo st()->load_template('layouts/modern/single_hotel/room/book-form'); ?>
                    </div>
                    <div class="col-lg-9 col-md-8 col-lg-pull-3 col-md-pull-4">
                        <h3 class="section-title sts-pf-font"><?php echo __('Summary', ST_TEXTDOMAIN); ?></h3>
                        <?php echo st()->load_template('layouts/modern/single_hotel/room/facility'); ?>
                        <div class="desc">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <div class="sts-hr"></div>
                <?php
                echo st()->load_template('layouts/modern/single_hotel/room/attributes');
                ?>
            </div>
            <?php
            echo st()->load_template('layouts/modern/single_hotel/room/gallery');
            echo st()->load_template('layouts/modern/single_hotel/room/other_rooms');
            echo do_shortcode('[st_single_hotel_check_availability_new title="'. __('BOOK YOUR STAY', ST_TEXTDOMAIN) .'"]');
        }
        wp_reset_query();
        ?>
    </div>

<?php get_footer('hotel-activity'); ?>