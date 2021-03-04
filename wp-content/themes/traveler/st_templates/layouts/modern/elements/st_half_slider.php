<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 1/9/2019
 * Time: 4:22 PM
 */

$link = vc_build_link($attr['link']);
?>
<div class="st-half-slider-wrapper clearfix">
    <div class="st-half-slider-text has-matchHeight has-gutterLeft">
        <div class="text-wrapper">
            <?php
            if (!empty($attr['heading'])) {
                echo '<h1 class="st-heading">' . esc_html($attr['heading']) . '</h1>';
            }
            if (!empty($attr['description'])) {
                echo '<div class="st-description mt30">' . esc_html($attr['description']) . '</div>';
            }
            if (!empty($link) && $link != '|||') {
                echo '<a class="btn btn-primary btn-md" href="' . $link['url'] . '" target="' . $link['target'] . '">' . $link['title'] . '</a>';
            }
            ?>
        </div>
    </div>
    <div class="st-half-slider-gallery has-matchHeight">
        <?php
        $gallery = explode(',', $attr['gallery']);
        if (!empty($gallery) && is_array($gallery)) { ?>
            <div class="st-owl-carousel owl-carousel">
                <?php
                foreach ($gallery as $galleryID) {
                    $img = wp_get_attachment_image_url($galleryID, 'full');
                    $class = Assets::build_css('background-image: url(' . $img . ');');
                    echo '<div class="item ' . $class . '"></div>';
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    $result_page = st()->get_option('tours_search_result_page');
    ?>
    <div class="tour-search-form-home has-gutterLeft">
        <div class="search-form clearfix">
            <form action="<?php echo esc_url(get_the_permalink($result_page)); ?>" class="form" method="get">
                <div class="field-wrapper clearfix">
                    <?php echo st()->load_template('layouts/modern/tour/elements/search/location', '', ['has_icon' => false]); ?>
                    <?php echo st()->load_template('layouts/modern/tour/elements/search/date', '', ['has_icon' => false]); ?>
                    <?php echo st()->load_template('layouts/modern/tour/elements/search/type', '', ['has_icon' => false]); ?>
                </div>
                <input type="submit" class="btn btn-primary" name="submit"
                       value="<?php echo __('Find a Tour', ST_TEXTDOMAIN); ?>">
            </form>
        </div>
    </div>
</div>
