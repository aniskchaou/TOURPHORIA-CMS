<?php
extract($data);
$form_search_data = vc_param_group_parse_atts($hotel_room_fields);
$page_search = st()->get_option('st_hotel_alone_room_search_page');
$page_search = get_permalink($page_search);
?>
<div id="st-form-search-room" class="st-form-search-room">
    <form class="wpbooking-search-form-wrap" method="get" action="<?php echo esc_url($page_search) ?>">
        <div class="field">
            <div class="center">
                <div class="title">
                    <?php echo do_shortcode($title) ?>
                </div>
                <div class="row">
                    <?php
                    if(!empty($form_search_data)){
                        foreach($form_search_data as $k => $v){
                            echo st_hotel_alone_load_view('elements/st-form-search-room/fields/' . $v['field_attribute'], false, $v);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="control">
            <button class="btn btn-primary">
                <?php echo wp_kses(__('CHECK <br> AVAILABILITY', ST_TEXTDOMAIN), array('br' => array()))?>
            </button>
        </div>
    </form>
</div>
