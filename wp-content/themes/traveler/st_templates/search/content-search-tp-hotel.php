<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Content search flight
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' );
wp_enqueue_script('st.travelpayouts');

$fields = array(
    array(
        'title' => esc_html__('City or hotel name', ST_TEXTDOMAIN),
        'name' => 'destination',
        'placeholder' => esc_html__('City or hotel name', ST_TEXTDOMAIN),
        'layout_col' => '12',
        'layout2_col' => '12',
        'is_required' => 'on'
    ),
    array(
        'title' => esc_html__('Check In', ST_TEXTDOMAIN),
        'name' => 'checkin',
        'placeholder' => esc_html__('Check In', ST_TEXTDOMAIN),
        'layout_col' => '3',
        'layout2_col' => '3',
        'is_required' => 'on'
    ),
    array(
        'title' => esc_html__('Check Out', ST_TEXTDOMAIN),
        'name' => 'checkout',
        'placeholder' => esc_html__('Check Out', ST_TEXTDOMAIN),
        'layout_col' => '3',
        'layout2_col' => '3',
        'is_required' => 'on'
    ),
    array(
        'title' => esc_html__('Guests', ST_TEXTDOMAIN),
        'name' => 'guest',
        'placeholder' => esc_html__('Guest', ST_TEXTDOMAIN),
        'layout_col' => '4',
        'layout2_col' => '4',
        'is_required' => 'off'
    )
);

$st_direction = !empty($st_direction) ? $st_direction : "horizontal";

$marker = st()->get_option('tp_marker', '124778');

if (!isset($field_size)) $field_size = '';
?>
<h2 class='mb20'><?php echo esc_html($st_title_search) ?></h2>
<?php
$tp_show_api_info = st()->get_option('tp_show_api_info', 'on');
$use_whitelabel = st()->get_option('tp_redirect_option', 'off');
$action = 'https://search.hotellook.com';
$target = '_blank';
$button_class = '';
if($use_whitelabel == 'on'){
    $button_class = 'btn-tp-search-hotels';
    $action = '';
    $target = '_self';
    $page_id = st()->get_option('tp_whitelabel_page','');
    if(empty($page_id)){
        $whitelabel_name = st()->get_option('tp_whitelabel', 'whilelabel.travelerwp.com');
    }else{
        $whitelabel_name = get_permalink($page_id).'/#';
    }
    echo '<input type="hidden" id="current_url_hotel" name="current_url_hotel" value="'.esc_url($whitelabel_name).'">';
}

?>
<form role="search" method="get" class="search main-search" action="<?php echo esc_url($action)?>" target="<?php echo esc_attr($target)?>">
    <input type="hidden" name="marker" value="<?php echo esc_attr($marker); ?>">
    <div class="row">
        <?php
        if (!empty($fields)) {
            foreach ($fields as $key => $value) {
                $default = array(
                    'placeholder' => ''
                );
                $value = wp_parse_args($value, $default);
                $name = $value['name'];

                $size = '4';
                if ($st_style_search == "style_1") {
                    $size = $value['layout_col'];
                } else {
                    if (!empty($value['layout2_col'])) {
                        $size = $value['layout2_col'];
                    }
                }

                if ($st_direction == 'vertical') {
                    $size = '12';
                }
                $size_class = " col-md-" . $size . " col-lg-" . $size . " col-sm-12 col-xs-12 ";
                ?>
                <div class="<?php echo esc_attr($size_class); ?>">
                    <?php echo st()->load_template('travelpayouts_api/search/hotel/field-' . $name, false, array('data' => $value, 'field_size' => $field_size, 'placeholder' => $value['placeholder'], 'st_direction' => $st_direction, 'is_required' => $value['is_required'])) ?>
                </div>
                <?php
            }
        } ?>
    </div>

    <button class="btn btn-primary btn-lg <?php echo esc_attr($button_class)?>" type="submit"><?php echo esc_html__('Search For Hotels', ST_TEXTDOMAIN); ?></button>
    <?php if($tp_show_api_info == 'on'){ ?>
    <span class="api_info"><i class="fa fa-info-circle"></i> <?php echo esc_html__('Search hotels API of ', ST_TEXTDOMAIN)?><a href="https://travelpayouts.com" target="_blank">TravelPayouts</a></span>
    <?php } ?>
</form>
