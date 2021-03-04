<?php
$fields = [
    [
        'title' => __('Destination', ST_TEXTDOMAIN),
        'field_search' => 'address',
        'placeholder' => __('e.g. city, region, district or specific hotel', ST_TEXTDOMAIN),
        'layout_col' => '6',
        'layout2_col' => '6',
        'max_num' => '20',
        'is_required' => 'on',
    ],
    [
        'title' => __('Check-in', ST_TEXTDOMAIN),
        'field_search' => 'check_in',
        'placeholder' => '',
        'layout_col' => '3',
        'layout2_col' => '3',
        'max_num' => '20',
        'is_required' => 'on',
    ],
    [
        'title' => __('Check-out', ST_TEXTDOMAIN),
        'field_search' => 'check_out',
        'placeholder' => '',
        'layout_col' => '3',
        'layout2_col' => '3',
        'max_num' => '20',
        'is_required' => 'on',
    ],
    [
        'title' => __('Room(s)', ST_TEXTDOMAIN),
        'field_search' => 'room_num',
        'placeholder' => '',
        'layout_col' => '4',
        'layout2_col' => '4',
        'max_num' => '20',
        'is_required' => 'on',
    ],
    [
        'title' => __('Adults', ST_TEXTDOMAIN),
        'field_search' => 'adult',
        'placeholder' => '',
        'layout_col' => '4',
        'layout2_col' => '4',
        'max_num' => '20',
        'is_required' => 'on',
    ],
    [
        'title' => __('Children', ST_TEXTDOMAIN),
        'field_search' => 'children',
        'placeholder' => '',
        'layout_col' => '4',
        'layout2_col' => '4',
        'max_num' => '20',
        'is_required' => 'on',
    ],

];

$bdc_status_iframe = st()->get_option('bookingdc_iframe', '');
if ($bdc_status_iframe == 'on') {
    $bdc_code_iframe = st()->get_option('bookingdc_iframe_code', '');
    echo balanceTags($bdc_code_iframe);
} else {
    $aid = st()->get_option('bookingdc_aid', '1384277');
    $aid_default = '382821';
    $cname = st()->get_option('bookingdc_cname', '');
    $lang = st()->get_option('bookingdc_lang', 'en');
    $currency = st()->get_option('bookingdc_currency', 'USD');

    $domain = $cname != '' ? '//' . $cname . '/' : '//www.booking.com/';
    $target_page = 'searchresults.html';
    ?>
    <h2 class='mb20'><?php echo esc_html($st_title_search) ?></h2>
    <form role="search" method="get" class="search main-search main-bookingdc-search" autocomplete="off"
          action="<?php echo esc_url($domain . $target_page); ?>" target="_blank">
        <input type="hidden" name="si" value="ai,co,ci,re,di"/>
        <input type="hidden" name="utm_campaign" value="search_box"/>
        <input type="hidden" name="utm_medium" value="sp"/>
        <input type="hidden" name="lang" value="<?php echo esc_html($lang); ?>" />
        <input type="hidden" name="lang_click" value="other" />
        <input type="hidden" name="lang_changed" value="1" />
        <input type="hidden" name="selected_currency" value="<?php echo strtoupper($currency); ?>" />
        <input type="hidden" name="changed_currency" value="1" />

        <?php
        if ( $cname == '' || ( $cname != '' && $aid != $aid_default ) ) {
            echo '<input type="hidden" name="aid" value="' . $aid . '" />';
            echo '<input type="hidden" name="label" value="wp-searchbox-widget-' . $aid . '" />';
            echo '<input type="hidden" name="utm_term" value="wp-searchbox-widget-' . $aid . '" />';
            echo '<input type="hidden" name="error_url" value="' . $domain . $target_page . '?aid=' . $aid . ';" />';
        }
        elseif ( $cname != '' ) {
            echo '<input type="hidden" name="ifl" value="1" />';
            echo '<input type="hidden" name="label" value="wp-searchbox-widget-' . $cname . '" />';
            echo '<input type="hidden" name="utm_term" value="wp-searchbox-widget-' . $cname . '" />';
            echo '<input type="hidden" name="error_url" value="' . $domain . $target_page . '" />';
        }
        else {
            echo '<input type="hidden" name="label" value="wp-searchbox-widget-' . $aid . '" />';
        }

        ?>

        <div class="row">
            <?php
            if (!empty($fields)) {
                foreach ($fields as $key => $value) {
                    $default = array(
                        'placeholder' => ''
                    );
                    $value = wp_parse_args($value, $default);
                    $name = $value['field_search'];
                    if ($name == 'google_map_location') {
                        $name = 'address';
                    }
                    $size = '4';
                    if ($st_style_search == "style_1") {
                        $size = $value['layout_col'];
                    } else {
                        if ($value['layout2_col']) {
                            $size = $value['layout2_col'];
                        }
                    }
                    if ($st_direction == 'vertical') {
                        $size = '12';
                    }
                    $size_class = " col-md-" . $size . " col-lg-" . $size . " col-sm-12 col-xs-12 ";
                    ?>
                    <div class="<?php echo esc_attr($size_class); ?>">
                        <?php echo st()->load_template('bookingdc/search/field', $name, array('data' => $value, 'field_size' => $field_size, 'location_name' => 'location_name', 'placeholder' => $value['placeholder'], 'st_direction' => $st_direction)) ?>
                    </div>
                    <?php
                }
            } ?>
        </div>
        <button class="btn btn-primary btn-lg"
                type="submit"><?php echo __('Search for hotels', ST_TEXTDOMAIN); ?></button>
    </form>
    <?php
}
?>
