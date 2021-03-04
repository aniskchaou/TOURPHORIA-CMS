<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Custom vc row
 *
 * Created by ShineTheme
 *
 */
$el_class = $full_height = $full_width = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$output = $after_output = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'css' => '',
    'row_fullwidth'=>'no',
    'parallax_class'=>"no",
    'bg_video'=>'no',
    'st_media'=>'',
    'st_poster_media'=>'',
    'row_id'=>''
), $atts));
wp_enqueue_script( 'wpb_composer_front_js' );
//wp_enqueue_style( 'js_composer_front' );
//wp_enqueue_script( 'wpb_composer_front_js' );
//wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_classes = array(
    'vc_row',
    'wpb_row', //deprecated
    'vc_row-fluid',
    'st bg-holder',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
if (!empty($atts['gap'])) {
	$css_classes[] = 'vc_column-gap-'.$atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
    $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
    $wrapper_attributes[] = 'data-vc-full-width="true"';
    $wrapper_attributes[] = 'data-vc-full-width-init="false"';
    if ( 'stretch_row_content' === $full_width ) {
        $wrapper_attributes[] = 'data-vc-stretch-content="true"';
    } elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
        $wrapper_attributes[] = 'data-vc-stretch-content="true"';
        $css_classes[] = 'vc_row-no-padding';
    }
    $after_output .= '<div class="vc_row-full-width"></div>';
}

if ( ! empty( $full_height ) ) {
    $css_classes[] = ' vc_row-o-full-height';
    if ( ! empty( $content_placement ) ) {
        $css_classes[] = ' vc_row-o-content-' . $content_placement;
    }
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

if ( $has_video_bg ) {
    $parallax = $video_bg_parallax;
    $parallax_image = $video_bg_url;
    $css_classes[] = ' vc_video-bg-container';
    wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
    wp_enqueue_script( 'vc_jquery_skrollr_js' );
    $wrapper_attributes[] = 'data-vc-parallax="1.5"'; // parallax speed
    $css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
    if ( false !== strpos( $parallax, 'fade' ) ) {
        $css_classes[] = 'js-vc_parallax-o-fade';
        $wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
    } elseif ( false !== strpos( $parallax, 'fixed' ) ) {
        $css_classes[] = 'js-vc_parallax-o-fixed';
    }
}

if ( ! empty( $parallax_image ) ) {
    if ( $has_video_bg ) {
        $parallax_image_src = $parallax_image;
    } else {
        $parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
        $parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
        if ( ! empty( $parallax_image_src[0] ) ) {
            $parallax_image_src = $parallax_image_src[0];
        }
    }
    $wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
    $wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

if($parallax_class =='yes' ){

    $css_class .= " bg-parallax ";

}

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

//$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);



if(!empty($row_id)){
    $row_id = 'id="'.$row_id.'"';
}



$output .= '<div '.$row_id.' ' . implode( ' ', $wrapper_attributes ) . '>';

if($parallax_class =='yes' ){

    $output .= '<div class="bg-mask"></div>';

}

if($bg_video == 'yes'){
    if(!empty($st_media)){
        $output .= '<video width=\'100%\' height=\'100%\' class="bg-video" src="'.$st_media.'" type="video/mp4" preload="auto" autoplay="true" loop="loop" muted="muted" poster="'.$st_poster_media.'">
                    <source src="'.$st_media.'" type="video/webm" />
                    <source src="'.$st_media.'" type="video/mp4" />
                </video>';
    }

}

if($row_fullwidth == "yes")
{
    $output.="<div class='container-fluid'> ";

}else
{
    $output.="<div class='container '>";
}

$output.="<div class='row'>";

$output .= wpb_js_remove_wpautop($content);

$output.="</div><!--End .row-->";

$output.="</div><!--End .container-->";




$output .= '</div>';


$output.$this->endBlockComment('row');

$st_row_fullwidth=0;

echo balanceTags($output);