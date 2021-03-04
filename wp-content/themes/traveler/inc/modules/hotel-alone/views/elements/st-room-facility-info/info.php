<?php

extract($atts);

$facilities = get_post_meta(get_the_ID(), 'add_new_facility', true);

?>

<div class="helios-room-facilities-info">
    <div class="title">
        <?php echo esc_html($title) ?>
    </div>
    <div class="info">
        <div class="list-facilities number_<?php echo esc_attr($number_of_row) ?>">
            <?php if (is_array($facilities) && count($facilities)) { ?>
                <?php
                foreach ($facilities as $fac => $item) {
                    ?>
                    <span class="icon-item">
                        <?php if (!empty($item['facility_icon'])): ?><i
                            class="<?php echo TravelHelper::handle_icon($item['facility_icon']); ?>"></i><?php endif; ?>
                        <?php echo esc_html($item['title']); ?>
                    </span>
                    <?php
                }
            } ?>
        </div>
    </div>
</div>