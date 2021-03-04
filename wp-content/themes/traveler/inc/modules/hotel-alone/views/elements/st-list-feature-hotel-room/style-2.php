<?php
global $wp_query;
Hotel_Alone_Helper::inst()->search_room($data);
if (have_posts()) {
    ?>
    <div class="st-list-feature-hotel-room style-2">

        <div class="content container">
            <div class="row list-room owl-carousel">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        $terms = wp_get_post_terms(get_the_ID(), 'room_type');
                        $cat = '';
                        if (!empty($terms)) {
                            foreach ($terms as $k => $v) {
                                $cat .= " filter-" . esc_attr($v->term_id);
                            }
                        }
                        ?>
                        <div class="col-md-12 col-sm-12 item-room <?php echo esc_attr($cat) ?>">
                            <div class="item">
                                <div class="feature">
                                    <?php
                                    if (has_post_thumbnail() and get_the_post_thumbnail()) {
                                        the_post_thumbnail(array(340,240,'bfi_thumb' => true ), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))));
                                    } else {
                                        if (function_exists('st_get_default_image'))
                                            echo st_get_default_image();
                                    }
                                    ?>
                                </div>
                                <div class="info">
                                    <div class="name">
                                        <a href="<?php the_permalink() ?>">
                                            <?php the_title() ?>
                                        </a>
                                    </div>
                                    <div class="price">
                                        <?php $price = get_post_meta(get_the_ID(), 'price', true);
                                        echo TravelHelper::format_money($price); ?><span
                                                class="small"><?php esc_html_e("/night", ST_TEXTDOMAIN) ?></span>
                                    </div>
                                    <div class="desc">
                                        <?php echo wp_trim_words(get_the_excerpt(), 9); ?>
                                    </div>
                                    <div class="guest">
                                        <?php
                                        $number_adult = get_post_meta(get_the_ID(), 'adult_number', true);
                                        $number_child = get_post_meta(get_the_ID(), 'children_number', true);
                                        if (!empty($number_adult) || !empty($number_child)) {
                                            ?>
                                            <span>
                                                <?php echo esc_attr($number_adult + $number_child); ?> <?php esc_html_e("GUESTS", ST_TEXTDOMAIN) ?>
                                            </span>
                                        <?php } ?>
                                        <?php
                                        $room_size = get_post_meta(get_the_ID(), 'room_footage', true);
                                        if (!empty($room_size)) {
                                            echo esc_attr($room_size);
                                            echo '<span>';
                                            echo 'm<sup>2</sup>';
                                            echo '</span>';
                                        }
                                        ?>
                                    </div>
                                    <div class="button">
                                        <a href="<?php the_permalink() ?>"><?php esc_html_e("BOOK NOW", ST_TEXTDOMAIN) ?>
                                            <i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php wp_reset_query(); ?>
