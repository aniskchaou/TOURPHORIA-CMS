<footer id="st-footer-hotel-activity" class="st-ite-footer">
    <?php
        $page_id = st()->get_option('st_hotel_alone_footer_page');
        if (!empty($page_id)) {
            echo '<div class="container">';
            echo st_hotel_alone_get_vc_pagecontent($page_id);
            echo '</div>';
        } else { ?>
            <div class="default-footer">
                <div class="container">
                    <a href="<?php echo esc_url(esc_html__('http://wordpress.org/', ST_TEXTDOMAIN)); ?>"><?php printf(esc_html__('Proudly powered by %s', ST_TEXTDOMAIN), 'WordPress'); ?></a>
                    <span class="sep"> | </span>
                    <?php printf(esc_html__('Theme: %1$s by %2$s.', ST_TEXTDOMAIN), 'traveler', '<a href="'.esc_url('http://shinetheme.com').'">Shinetheme</a>'); ?>
                </div>
            </div>
        <?php }
        ?>

    <?php wp_footer(); ?>
</body>
</html>