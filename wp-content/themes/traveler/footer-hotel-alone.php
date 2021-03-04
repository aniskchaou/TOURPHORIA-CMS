<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Footer
 *
 * Created by ShineTheme
 *
 */
?>
<footer id="colophon" class="site-footer">
    <?php
    $page_id = st()->get_option('st_hotel_alone_footer_page');
    $custom_footer = get_post_meta(get_the_ID() , 'custom_footer' , true );
    if($custom_footer == 'on'){
        $page_id =  get_post_meta(get_the_ID() , 'st_footer_page' , true );
    }

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
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>