<?php
    /**
     * @package WordPress
     * @subpackage Traveler
     * @since 1.0
     *
     * Custom vc tabs
     *
     * Created by ShineTheme
     *
     */
    $output = $title = $interval = $el_class = '';
    extract( shortcode_atts( array(
        'title' => '',
        'interval' => 0,
        'el_class' => '',
        'tab_style'=>'single_tab'
    ), $atts ) );
    wp_enqueue_script( 'jquery-ui-tabs' );
    $el_class = $this->getExtraClass( $el_class );
    $element = 'wpb_tabs';
    if ( 'vc_tour' == $this->shortcode ) $element = 'wpb_tour';
// Extract tab titles
    preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
    $tab_titles = array();
    /**
     * vc_tabs
     *
     */
    if ( isset( $matches[1] ) ) {
        $tab_titles = $matches[1];
    }
    global $st_style_tab;
    $st_style_tab = $tab_style;
    global $st_stt_tab;
    $st_stt_tab=1;
    if($tab_style == "single_tab"){
        $tabs_nav = '';
        $tabs_nav .= '<ul class=" nav nav-tabs ui-tabs-nav vc_clearfix">';
        foreach ( $tab_titles as $tab ) {
            $tab_atts = shortcode_parse_atts($tab[0]);
            $tab_icon='';
            if(isset($tab_atts['tab_icon']))
            {
                $tab_icon=$tab_atts['tab_icon'];
            }
            $tab_icon=st_handle_icon_tag($tab_icon);
            if(isset($tab_atts['title'])) {
                $tabs_nav .= '<li><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '">' .$tab_icon.' '. $tab_atts['title'] . '</a></li>';
            }
        }
        $tabs_nav .= '</ul>' . "\n";
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );
        $output .= "\n\t" . '<div class="' . $css_class . '" data-interval="' . $interval . '">';
        $output .= "\n\t\t" . '<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix">';
        $output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => $element . '_heading' ) );
        $output .= "\n\t\t\t" . $tabs_nav;
        $output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
        if ( 'vc_tour' == $this->shortcode ) {
            $output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav vc_clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="' . __( 'Previous tab', ST_TEXTDOMAIN ) . '">' . __( 'Previous tab', ST_TEXTDOMAIN ) . '</a></span> <span class="wpb_next_slide"><a href="#next" title="' . __( 'Next tab', ST_TEXTDOMAIN ) . '">' . __( 'Next tab', ST_TEXTDOMAIN ) . '</a></span></div>';
        }
        $output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
        $output .= "\n\t" . '</div> ' . $this->endBlockComment( $element );
    }else{

        $tabs_nav = '';
        $tabs_nav .= '<ul class=" nav nav-tabs ">';
        foreach ( $tab_titles as $k=>$tab ) {
            $tab_atts = shortcode_parse_atts($tab[0]);
            $tab_icon='';
            if(isset($tab_atts['tab_icon']))
            {
                $tab_icon=$tab_atts['tab_icon'];
            }
            $tab_icon=st_handle_icon_tag($tab_icon);
            $k==0?$class_active=" active ":$class_active="";
            if(isset($tab_atts['title'])) {
                $tabs_nav .= '<li class="'.$class_active.'"><a  href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '" data-toggle="tab" >' .$tab_icon.' '. $tab_atts['title'] . '</a></li>';
            }
        }
        $tabs_nav .= '</ul>' . "\n";
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . '  search-tabs search-tabs-bg  no-boder-search  ' . $el_class ), $this->settings['base'], $atts );
        $output .= "\n\t" . '<div class="' . $css_class . '" data-interval="' . $interval . '">';
        $output .= "\n\t\t" . '<div class="tabbable">';
        $output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => $element . '_heading' ) );
        $output .= "\n\t\t\t" . $tabs_nav;
        $output .= "\n\t\t\t <div class='tab-content'>" . wpb_js_remove_wpautop( $content ) ."</div>";
        if ( 'vc_tour' == $this->shortcode ) {
            $output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav vc_clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="' . __( 'Previous tab', ST_TEXTDOMAIN ) . '">' . __( 'Previous tab', ST_TEXTDOMAIN ) . '</a></span> <span class="wpb_next_slide"><a href="#next" title="' . __( 'Next tab', ST_TEXTDOMAIN ) . '">' . __( 'Next tab', ST_TEXTDOMAIN ) . '</a></span></div>';
        }
        $output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
        $output .= "\n\t" . '</div> ' . $this->endBlockComment( $element );
        unset( $st_style_tab );
        unset ($st_stt_tab );
    }
    echo ($output);