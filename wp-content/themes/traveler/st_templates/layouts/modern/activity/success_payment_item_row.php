<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * hotel payment item row
 *
 * Created by ShineTheme
 *
 */
$order_token_code = STInput::get('order_token_code', '');

if ($order_token_code) {
    $order_code = STOrder::get_order_id_by_token($order_token_code);
}

$object_id = $key;

$check_in = get_post_meta($order_code, 'check_in', true);
$check_out = get_post_meta($order_code, 'check_out', true);
$starttime = get_post_meta($order_code, 'starttime', true);
$data_prices = get_post_meta($order_code, 'data_prices', true);
$type_activity = get_post_meta($order_code, 'type_activity', true);
$adult_number = intval(get_post_meta($order_code, 'adult_number', true));
$child_number = intval(get_post_meta($order_code, 'child_number', true));
$infant_number = intval(get_post_meta($order_code, 'infant_number', true));
$link = '';
if (isset($object_id) && $object_id) {
    $link = get_permalink($object_id);
}

?>
<?php if (isset($object_id) and $object_id): ?>
    <div class="service-section">
        <div class="service-left">
            <h4 class="title"><a href="<?php echo esc_url($link) ?>"><?php echo get_the_title($object_id); ?></a>
            </h4>
            <?php
            $address = get_post_meta($object_id, 'address', true);
            if ($address) {
                ?>
                <p class="address"><i class="fa fa-map-marker"></i> <?php echo $address; ?></p>
            <?php } ?>
        </div>
        <div class="service-right">
            <?php echo get_the_post_thumbnail($object_id, array(110, 110, 'bfi_thumb' => true), array('style' => 'max-width:100%;height:auto', 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($object_id)))) ?>
        </div>
    </div>
<?php endif; ?>
<div class="info-section">
    <ul>
        <?php
        $theme_option = st()->get_option('partner_show_contact_info');
        $metabox = get_post_meta($object_id, 'show_agent_contact_info', true);
        $use_agent_info = FALSE;
        if ($theme_option == 'on') $use_agent_info = true;
        if ($metabox == 'user_agent_info') $use_agent_info = true;
        if ($metabox == 'user_item_info') $use_agent_info = FALSE;
        $obj_hotel = get_post($object_id);
        $user_id = $obj_hotel->post_author;
        ?>
        <?php if ($contact_email = get_post_meta($object_id, 'contact_email', true)) { ?>
            <li><span class="label"><?php echo __('Email', ST_TEXTDOMAIN); ?></span><span
                        class="value"><?php echo esc_html($contact_email); ?></span></li>
        <?php } ?>

        <?php if ($max_people = get_post_meta($object_id, 'max_people', true)) { ?>
            <li>
                <span class="label">
                    <?php echo __('Max people', ST_TEXTDOMAIN) ?>
                </span>
                <span class="value">
                    <?php
                    if ((int)$max_people == 0) {
                        $max_people = __('Unlimited', ST_TEXTDOMAIN);
                    }
                    echo $max_people;
                    ?>
                </span>
            </li>
        <?php } ?>

        <?php if ($adult_number) { ?>
            <li>
                <span class="label">
                    <?php _e('No. Adult', ST_TEXTDOMAIN) ?>
                </span>
                <span class="value">
                    <?php echo esc_html($adult_number) ?>
                </span>
            </li>
        <?php } ?>
        <?php if ($child_number) { ?>
            <li>
                <span class="label">
                    <?php _e('No. Children', ST_TEXTDOMAIN) ?>
                </span>
                <span class="value">
                    <?php echo esc_html($child_number) ?>
                </span>
            </li>
        <?php } ?>
        <?php if ($infant_number) { ?>
            <li>
                <span class="label">
                    <?php _e('No. Infant', ST_TEXTDOMAIN) ?>
                </span>
                <span class="value">
                    <?php echo esc_html($infant_number) ?>
                </span>
            </li>
        <?php } ?>

        <?php
        if ($type_activity == 'daily_activity') {
            if ($check_in) { ?>
                <li>
                        <span class="label">
                            <?php echo __('Date', ST_TEXTDOMAIN) ?>
                        </span>
                    <span class="value">
                            <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_in)); ?>
                            <?php
                            if(!empty($starttime))
                                echo ' - ' . $starttime;
                            ?>
                        </span>
                </li>
            <?php }
        } else {
            if ($check_in and $check_out) {
                $period = STDate::dateDiff($check_in, $check_out);
                ?>
                <li>
                        <span class="label">
                            <?php echo __('Date', ST_TEXTDOMAIN); ?>
                        </span>
                    <span class="value">
                            <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_in)); ?> -
                        <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_out)); ?>
                        <?php
                        if(!empty($starttime))
                            echo ' - ' . $starttime;
                        ?>
                        </span>
                </li>
            <?php }
        }
        ?>


        <?php
        $extras = get_post_meta($order_code, 'extras', true);
        if (isset($extras['value']) && is_array($extras['value']) && count($extras['value'])):
            ?>
            <li><span class="label"><?php echo __('Extra:', ST_TEXTDOMAIN); ?></span>
                <span class="value">

                </span>
            </li>
            <li class="extra-value">
                <?php
                foreach ($extras['value'] as $name => $number):
                    $price_item = floatval($extras['price'][$name]);
                    if ($price_item <= 0) $price_item = 0;
                    $number_item = intval($extras['value'][$name]);
                    if ($number_item <= 0) $number_item = 0;
                    if ($number_item > 0) {
                        ?>
                        <span>
                    <?php echo $extras['title'][$name] . ' (' . TravelHelper::format_money($price_item) . ') x ' . $number_item . ' ' . __('Item(s)', ST_TEXTDOMAIN); ?>
                </span> <br/>
                        <?php
                    }
                endforeach;
                ?>
            </li>
        <?php endif; ?>
        <li class="guest-value">
            <?php st_print_order_item_guest_name($data['data']) ?>
        </li>
    </ul>
</div>