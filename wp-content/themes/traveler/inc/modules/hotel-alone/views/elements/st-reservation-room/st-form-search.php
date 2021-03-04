<?php
extract($data);
$form_search_data = vc_param_group_parse_atts($hotel_room_fields);
?>
<div id="st-form-reservation-room" class="st-form-reservation-room ">
    <form class="wpbooking-search-form-wrap" action="<?php echo get_the_permalink(get_the_ID()); ?>">
        <?php wp_nonce_field('room_search','room_search')?>
        <input name="action" value="ajax_search_room_hotel_alone" type="hidden">
        <input name="hotel_id" value="<?php echo esc_html($service_id) ?>" type="hidden">
        <input name="helios-style" value="style-1" type="hidden">
        <input class="wpbooking_paged" type="hidden" value="1" name="wpbooking_paged">
        <div class="title">
            <?php echo do_shortcode($title) ?>
        </div>
        <div class="field">
            <div class="center">
                <div class="row">
                    <?php
                    if(!empty($form_search_data)){
                        foreach($form_search_data as $k => $v){
                           echo st_hotel_alone_load_view('elements/st-form-search-room/fields/' . $v['field_attribute'], false, $v, true);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="control">
            <button class="btn btn-primary btn-loading helios-btn-do-search-room" type="button">
                    <?php esc_html_e("CHECK AVAILABILITY", ST_TEXTDOMAIN) ?>
            </button>
        </div>
    </form>
</div>
