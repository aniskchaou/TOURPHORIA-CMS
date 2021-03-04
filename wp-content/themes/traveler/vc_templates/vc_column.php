<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Custom vc column
 *
 * Created by ShineTheme
 *
 */
$output = $font_color = $el_class = $width = $offset = '';
extract(shortcode_atts(array(
    'font_color'      => '',
    'el_class' => '',
    'width' => '1/1',
    'css' => '',
    'offset' => '',
    'data_effect'=>''
), $atts));

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$class_effect="";
if($data_effect !=""){
    $class_effect = " wow ".$data_effect." ";
}

$css_classes = array(
    $this->getExtraClass( $el_class ),
    'wpb_column',
    'vc_column_container',
    $class_effect,
    $width,
	vc_shortcode_custom_css_class( $css )
);

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
$inner_class=	vc_shortcode_custom_css_class( $css );

$output .= "\n\t".'<div ' . implode( ' ', $wrapper_attributes ) . '>';

$output .= '<div class="vc_column-inner wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= '</div>';
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo balanceTags($output);