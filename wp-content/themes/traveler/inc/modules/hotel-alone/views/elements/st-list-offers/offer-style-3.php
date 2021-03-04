<?php
/**
 * Created by ShineTheme.
 * Developer: nasanji
 * Date: 9/4/2017
 * Version: 1.0
 */
extract($atts);
if (!empty($list_offfer)) {
    $data = vc_param_group_parse_atts($list_offfer);
    ?>
    <div class="st-offer-element style-3">
        <div class="offer-carousel-slider-3 owl-carousel">
            <?php
            if (!empty($data)) {
                foreach ($data as $key => $val) {
                    $class_bg = '';
                    if ($val['image'] != '') {
                        $data_img = wp_get_attachment_image_src($val['image'], 'full', false);
                        if (!empty($data_img)) {
                            $class_bg = Hotel_Alone_Helper::inst()->build_css('background: #ccc url(' . $data_img[0] . ')');
                        }
                    }
                    ?>
                    <div class="item <?php echo esc_attr($class_bg); ?>">
                        <div class="caption-offer">
                            <?php if (!empty($val['title'])) { ?>
                                <h3 class="title"><?php echo $val['title']; ?></h3>
                            <?php } ?>
                            <?php if (!empty($val['desc'])) { ?>
                                <p class="desc"><?php echo $val['desc']; ?></p>
                            <?php } ?>
                            <?php if (!empty($val['price'])) { ?>
                                <?php
                                $price = $val['price'];
                                if (!empty($price)) {
                                    ?>
                                    <span class="offer-price"><span
                                                class="per-person"><?php echo esc_html__('Price Per Person: ', ST_TEXTDOMAIN); ?></span><span
                                                class="o-price"><?php echo TravelHelper::format_money($price); ?></span></span>
                                <?php } ?>
                            <?php } ?>
                            <?php
                            $s_link = !empty($val['link']) ? $val['link'] : '';
                            $link = vc_build_link($s_link);
                            if (!empty($link['url'])) {
                                echo '<a class="book-now btn btn-primary" href="' . $link['url'] . '" target="' . (!empty($link['target']) ? $link['target'] : '_self') . '">' . (!empty($link['title']) ? $link['title'] : __('Book now', ST_TEXTDOMAIN)) . '<i class="fa fa-long-arrow-right"></i></a>';
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            } ?>
        </div>
    </div>
<?php } ?>