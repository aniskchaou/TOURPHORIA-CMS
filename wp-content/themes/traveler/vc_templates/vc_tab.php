<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Custom vc tab
 *
 * Created by ShineTheme
 *
 */
global $st_style_tab;
global $st_stt_tab;
if($st_style_tab == "single_tab"){
    $output = $title = $tab_id = '';
    extract(shortcode_atts($this->predefined_atts, $atts));
    wp_enqueue_script('jquery_ui_tabs_rotate');
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ui-tabs-panel wpb_ui-tabs-hide vc_clearfix', $this->settings['base'], $atts );
    $output .= "\n\t\t\t" . '<div id="tab-'. (empty($tab_id) ? sanitize_title( $title ) : $tab_id) .'" class="'.$css_class.'">';
    $output .= ($content=='' || $content==' ') ? __("Empty tab. Edit page to add content here.", ST_TEXTDOMAIN) : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_tab');
    echo  ($output);
}else{
    $st_stt_tab==1?$class_active = " active in ":$class_active="";
    $output = $title = $tab_id = '';
    extract(shortcode_atts($this->predefined_atts, $atts));
    wp_enqueue_script('jquery_ui_tabs_rotate');
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' tab-pane fade '.$class_active, $this->settings['base'], $atts );
    $output .= "\n\t\t\t" . '<div id="tab-'. (empty($tab_id) ? sanitize_title( $title ) : $tab_id) .'" class="'.$css_class.'">';
    $output .= ($content=='' || $content==' ') ? __("Empty tab. Edit page to add content here.", ST_TEXTDOMAIN) : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_tab');
    echo  ($output);
    $st_stt_tab++;
}



