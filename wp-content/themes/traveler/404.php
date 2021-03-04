<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * 404
 *
 * Created by ShineTheme
 *
 */
$hotel_parent = st()->get_option('hotel_alone_assign_hotel');
if(!empty($hotel_parent)){
    echo st()->load_template('layouts/modern/single_hotel/page/404');
    return;
}

if(New_Layout_Helper::isNewLayout()){
    echo st()->load_template('layouts/modern/page/404');
    return;
}
get_header("full");
?>
    <div class="full-center class404">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 class_text_404">
                    <p class="text-hero"><?php st_the_language('404') ?></p>
                    <?php echo ( st()->get_option('404_text') ) ?><br>
                    <a class="btn btn-white btn-ghost btn-lg mt5" href="<?php echo home_url() ?>">
                        <i class="fa fa-long-arrow-left"></i> <?php esc_html_e('to Homepage','traveler') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php get_footer("full"); ?>