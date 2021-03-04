<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Search loading
 *
 * Created by ShineTheme
 *
 */
$loading_img = st()->get_option('search_preload_image');
?>
<div class="full-page-absolute" style="position: fixed;
    top: 0px;
    left: 0px;
    right:0px;
    bottom: 0px;
    z-index: 99999;">
    <div class="bg-holder full">
        <div class="bg-mask"></div>
        <div class="bg-img"
             style="<?php if ($loading_img) echo 'background-image:url(' . esc_url($loading_img) . ')'; ?>"></div>
        <div class="bg-holder-content full text-white text-center">
            <a class="logo-holder" href="<?php echo home_url() ?>">
                <img src="<?php echo st()->get_option('logo') ?>" alt="<?php esc_html_e('Logo','traveler') ?>"
                     title="<?php esc_html_e('Logo','traveler') ?>"/>
            </a>
            <div class="full-center">
                <div class="container">
                    <?php
                    $enable_preload_icon = st()->get_option('search_preload_icon_default', 'off');
                    if ($enable_preload_icon == 'on') {
                        echo '<img src="'. st()->get_option('search_preload_icon_custom') .'" alt="'. __('Preload Icon', ST_TEXTDOMAIN) .'" style="width: 150px"/>';
                    } else {
                        ?>
                        <div class="spinner-clock">
                            <div class="spinner-clock-hour"></div>
                            <div class="spinner-clock-minute"></div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php if (TravelHelper::is_service_search()) : ?>
                        <h2 class="mb5">
                            <?php echo sprintf(esc_html__('Looking for %s','traveler'), apply_filters('st_search_preload_page', false)) ?>
                        </h2>
                        <p class="text-bigger"><?php esc_html_e('it will take a couple of seconds','traveler')?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>