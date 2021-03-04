<?php
$image = '';
if (has_post_thumbnail() and get_the_post_thumbnail()) {
    $image = wp_get_attachment_image_url(get_post_thumbnail_id(), array(900, 800));
}
$class = Hotel_Alone_Helper::inst()->build_css('background-image:url(' . $image . ')  !important ;  background-size: cover;');
?>
<div class="tableDis item item_<?php the_ID() ?> <?php echo esc_attr($class) ?>">
    <div class="tableCell">
        <div class="wrapNav">
            <div class="navDetailRoom">
                <div class="titleNavRoom">
                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                </div>
                <div class="fourItem">

                    <div class="facilities">
                        <?php
                        $term = get_the_terms(get_the_ID(), 'room_facilities');
                        if (is_array($term) && count($term)):
                            ?>
                            <?php if ($term) { ?>
                            <?php
                            $i = 0;
                            foreach ($term as $key => $value) {
                                if (!is_wp_error($term) and !empty($value->name)) {
                                    if ($i == 4) {
                                        continue;
                                    }
                                    $i++;
                                    ?>
                                    <span class="icon-item">
                                        <?php if (function_exists('get_tax_meta') and $icon = get_tax_meta($value->term_id, 'st_icon')) { ?>
                                            <i class="<?php echo TravelHelper::handle_icon($icon) ?>"></i>
                                        <?php } ?>
                                        <?php echo esc_html($value->name); ?>
                                    </span>
                                    <?php
                                }
                            }
                        }
                        endif;
                        ?>
                    </div>

                </div>
            </div>
            <a href="<?php the_permalink() ?>" class="buttonNow"><?php esc_html_e("BOOK NOW", ST_TEXTDOMAIN) ?></a>
        </div>
    </div>
</div>