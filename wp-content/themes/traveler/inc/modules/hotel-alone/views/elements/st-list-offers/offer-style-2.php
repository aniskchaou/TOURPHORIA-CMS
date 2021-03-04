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
    <div class="st-offer-element style-2">
        <div class="offer-list-2">
            <?php
            $i = 0;
            if (!empty($data)) {
                foreach ($data as $key => $val) {
                    $i++;
                    $class_bg = '';
                    if ($val['image'] != '') {
                        $data_img = wp_get_attachment_image_src($val['image'], 'full', false);
                        if(!empty($data_img)){
                            $class_bg = Hotel_Alone_Helper::inst()->build_css('background: #ccc url(' . $data_img[0] . ')');
                        }
                    }
                    ?>
                    <div class="offer-item <?php echo($i % 2 == 0 ? 'even-item' : '') ?>">
                        <div class="header-thumb <?php echo esc_attr($class_bg); ?>">
                            <?php
                            $s_link = !empty($val['link']) ? $val['link'] : '';
                            $link = vc_build_link($s_link);
                            if (!empty($link['url'])) {
                                echo '<a class="book-now" href="' . $link['url'] . '" target="' . (!empty($link['target']) ? $link['target'] : '_self') . '">'. (!empty($link['title']) ? $link['title'] : __('Book now', ST_TEXTDOMAIN) ) .'<i class="fa fa-long-arrow-right"></i></a>';
                            }
                            ?>
                        </div>
                        <div class="caption">
                            <div class="d-flex">
                                <?php
                                $link_to = '#';
                                if (!empty($link['url'])) {
                                    $link_to = $link['url'];
                                }
                                ?>
                                <?php if (!empty($val['title'])) { ?>
                                    <h3 class="title"><a href="<?php echo $link_to; ?>"><?php echo $val['title']; ?></a>
                                    </h3>
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
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } ?>
        </div>
    </div>
<?php } ?>