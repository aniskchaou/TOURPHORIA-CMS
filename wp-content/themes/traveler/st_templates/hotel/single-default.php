<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * hotel single default
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script('wpb_composer_front_js');
?>
<style>
    .vc_custom_1419825856635{margin-top: 15px !important;margin-bottom: 20px !important;}
    .vc_custom_1479787747854{padding-top: 60px !important;padding-bottom: 60px !important;}
    .vc_custom_1422582053377{margin-top: 40px !important;}
    .vc_custom_1418615256584{margin-top: 60px !important;}
    .vc_custom_1479787778799{padding-bottom: 40px !important;}
    .vc_custom_1479787805742{padding-top: 60px !important;padding-bottom: 60px !important;}
    .vc_custom_1479787818263{padding-bottom: 30px !important;}
</style>
<?php
echo do_shortcode('[vc_row css=".vc_custom_1419825856635{margin-top: 15px !important;margin-bottom: 20px !important;}"][vc_column width="3/4"][st_hotel_header][/vc_column][vc_column width="1/4"][st_hotel_price][/vc_column][/vc_row][vc_row css=".vc_custom_1479787747854{padding-top: 60px !important;padding-bottom: 60px !important;}"][vc_column width="1/2"][vc_tta_tabs][vc_tta_section title="Photos" tab_id="1480063767063-07b58ace-6748"][st_hotel_detail_photo style="slide"][/vc_tta_section][vc_tta_section title="On the Map" tab_id="1480063767124-9f7b42f1-2055"][st_hotel_detail_map][/vc_tta_section][vc_tta_section title="Video" tab_id="1480063786582-875bebc5-bcb5"][st_hotel_video][/vc_tta_section][/vc_tta_tabs][vc_empty_space height="22px"][/vc_column][vc_column width="1/2" css=".vc_custom_1422582053377{margin-top: 40px !important;}"][st_hotel_detail_review_summary][vc_empty_space][st_hotel_detail_review_detail][/vc_column][/vc_row][vc_row css=".vc_custom_1479787770366{padding-top: 60px !important;padding-bottom: 60px !important;}"][vc_column][st_post_data title="Hotel Description" field="content"][vc_empty_space][st_hotel_policy][/vc_column][/vc_row][vc_row css=".vc_custom_1418615256584{margin-top: 60px !important;}"][vc_column][vc_row_inner][vc_column_inner width="3/4"][vc_column_text css=".vc_custom_1479787778799{padding-bottom: 40px !important;}"]
    Available Rooms

    [/vc_column_text][st_hotel_detail_search_room][st_hotel_detail_list_rooms][/vc_column_inner][vc_column_inner width="1/4"][st_hotel_logo title="About Hotel" font_size="3"][vc_empty_space height="20px"][st_post_data field="excerpt"][vc_empty_space height="20px"][st_hotel_detail_attribute taxonomy="hotel_facilities" item_col="12"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css=".vc_custom_1479787805742{padding-top: 60px !important;padding-bottom: 60px !important;}"][vc_column][vc_row_inner][vc_column_inner width="2/3"][vc_column_text css=".vc_custom_1479787818263{padding-bottom: 30px !important;}"]
    Hotel Reviews

    [/vc_column_text][st_hotel_review font_size="3"][/vc_column_inner][vc_column_inner width="1/3"][st_hotel_nearby title="Hotel Nearby" font_size="4"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]');