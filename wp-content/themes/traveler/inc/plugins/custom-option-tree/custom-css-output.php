<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 2/27/15
 * Time: 9:39 AM
 */
if(!class_exists('STCustomCSSOutput'))
{

    class STCustomCSSOutput
    {
        static function _init()
        {
            if(is_admin()) return;

            add_action( defined('W3TC') ? 'st_after_footer': 'wp_head' ,array(__CLASS__,'add_custom_css'),100);
            add_filter( 'ot_recognized_font_families', array(__CLASS__,'ot_google_font_stack'), 1, 2 );
        }

	    static  function ot_google_font_stack( $families, $field_id ) {
            $font_data = st()->get_option('google_fonts');
			if ( ! empty( $font_data ) ) {
				foreach( $font_data as $id => $value ) {

						$family = isset( $value['fontVal'] ) ? $value['fontVal'] : '';
						if ( $family ) {
							$spaces = explode(' ', $value['family'] );
							$font_stack = count( $spaces ) > 1 ? '"' . $value['family'] . '"': $value['family'];
							$families[$family] = apply_filters( 'ot_google_font_stack', $font_stack, $family, $field_id );
						}

				}
			}
			return $families;
		}

        static function add_custom_css()
        {
            $css=self::_get_custom_css();
            echo "\r\n";
            ?>
        <!-- Begin Custom CSS        -->
        <style>
            <?php echo ($css); ?>
        </style>
        <!-- End Custom CSS -->
        <?php
        }

        static function  _get_custom_css()
        {
            $html=false;


            /* grab a copy of the settings */
            $settings = get_option( 'st_option_tree_settings_new' );
            $options = get_option( st_options_id() );
            /* has settings */
            if ( !empty($settings) ) {
                /* loop through sections and insert CSS when needed */
                foreach ($settings as $k => $setting) {

                    $allows=self::_options_allow_output();
                    if(!empty($allows) and isset($setting['type']) and in_array($setting['type'],$allows) and isset($setting['output']) and  $setting['output'])
                    {
                        if(isset($options[$setting['id']]))
                        $html.=self::_get_output_item_css($setting, $options[$setting['id']]);

                    }

                }
            }


            return $html;
        }

        static function _options_allow_output()
        {
            $array=array(
                'typography',
                'colorpicker',
                'background',
                'border'
            );

            return apply_filters('st_options_allow_output',$array);
        }

        static function  _get_output_item_css($fields,$settings)
        {
            $option_id=$fields['id'];
            $output=$fields['output'];
            $marker=$fields['id'];
            $value=$settings;

            if ( is_array( $value ) ) {

                /* Measurement */
                if ( isset( $value[0] ) && isset( $value[1] ) ) {

                    /* set $value with measurement properties */
                    $value = $value[0].$value[1];

                    /* Border */
                } else if ( ot_array_keys_exists( $value, array( 'width', 'unit', 'style', 'color' ) ) && ! ot_array_keys_exists( $value, array( 'top', 'right', 'bottom', 'left', 'height', 'inset', 'offset-x', 'offset-y', 'blur-radius', 'spread-radius' ) ) ) {
                    $border = array('border:');

                    $unit = ! empty( $value['unit'] ) ? $value['unit'] : 'px';

                    if ( ! empty( $value['width'] ) )
                        $border[] = $value['width'].$unit;

                    if ( ! empty( $value['style'] ) )
                        $border[] = $value['style'];

                    if ( ! empty( $value['color'] ) )
                        $border[] = $value['color'];

                    /* set $value with border properties or empty string */
                    $value = ! empty( $border ) ? implode( ' ', $border ) : '';

                    /* Box Shadow */
                } else if ( ot_array_keys_exists( $value, array( 'inset', 'offset-x', 'offset-y', 'blur-radius', 'spread-radius', 'color' ) ) && ! ot_array_keys_exists( $value, array( 'width', 'height', 'unit', 'style', 'top', 'right', 'bottom', 'left' ) ) ) {

                    /* set $value with box-shadow properties or empty string */
                    $value = ! empty( $value ) ? implode( ' ', $value ) : '';

                    /* Dimension */
                } else if ( ot_array_keys_exists( $value, array( 'width', 'height', 'unit' ) ) && ! ot_array_keys_exists( $value, array( 'style', 'color', 'top', 'right', 'bottom', 'left' ) ) ) {
                    $dimension = array();

                    $unit = ! empty( $value['unit'] ) ? $value['unit'] : 'px';

                    if ( ! empty( $value['width'] ) )
                        $dimension[] = $value['width'].$unit;

                    if ( ! empty( $value['height'] ) )
                        $dimension[] = $value['height'].$unit;

                    /* set $value with dimension properties or empty string */
                    $value = ! empty( $dimension ) ? implode( ' ', $dimension ) : '';

                    /* Spacing */
                } else if ( ot_array_keys_exists( $value, array( 'top', 'right', 'bottom', 'left', 'unit' ) ) && ! ot_array_keys_exists( $value, array( 'width', 'height', 'style', 'color' ) ) ) {
                    $spacing = array();

                    $unit = ! empty( $value['unit'] ) ? $value['unit'] : 'px';

                    if ( ! empty( $value['top'] ) )
                        $spacing[] = $value['top'].$unit;

                    if ( ! empty( $value['right'] ) )
                        $spacing[] = $value['right'].$unit;

                    if ( ! empty( $value['bottom'] ) )
                        $spacing[] = $value['bottom'].$unit;

                    if ( ! empty( $value['left'] ) )
                        $spacing[] = $value['left'].$unit;

                    /* set $value with spacing properties or empty string */
                    $value = ! empty( $spacing ) ? implode( ' ', $spacing ) : '';

                    /* typography */
                } else if ( ot_array_keys_exists( $value, array( 'font-color', 'font-family', 'font-size', 'font-style', 'font-variant', 'font-weight', 'letter-spacing', 'line-height', 'text-decoration', 'text-transform' ) ) ) {
                    $font = array();

                    if ( ! empty( $value['font-color'] ) ){
	                    $font[] = "color: " . $value['font-color'] . ";";
                    }

                    if ( ! empty( $value['font-family'] ) ) {
                        foreach ( ot_recognized_font_families( $marker ) as $key => $v ) {
                            if ( $key == $value['font-family'] ) {
                                $font[] = "font-family: " . $v . ";";
                            }
                        }
                    }



                    if ( ! empty( $value['font-size'] ) )
                        $font[] = "font-size: " . $value['font-size'] . ";";

                    if ( ! empty( $value['font-style'] ) )
                        $font[] = "font-style: " . $value['font-style'] . ";";

                    if ( ! empty( $value['font-variant'] ) )
                        $font[] = "font-variant: " . $value['font-variant'] . ";";

                    if ( ! empty( $value['font-weight'] ) )
                        $font[] = "font-weight: " . $value['font-weight'] . ";";

                    if ( ! empty( $value['letter-spacing'] ) )
                        $font[] = "letter-spacing: " . $value['letter-spacing'] . ";";

                    if ( ! empty( $value['line-height'] ) )
                        $font[] = "line-height: " . $value['line-height'] . ";";

                    if ( ! empty( $value['text-decoration'] ) )
                        $font[] = "text-decoration: " . $value['text-decoration'] . ";";

                    if ( ! empty( $value['text-transform'] ) )
                        $font[] = "text-transform: " . $value['text-transform'] . ";";


                    /* set $value with font properties or empty string */
                    $value = ! empty( $font ) ? implode( "\n", $font ) : '';


                    /* background */
                } else if ( ot_array_keys_exists( $value, array( 'background-color', 'background-image', 'background-repeat', 'background-attachment', 'background-position', 'background-size' ) ) ) {
                    $bg = array();

                    if ( ! empty( $value['background-color'] ) )
                        $bg[] = $value['background-color'];

                    if ( ! empty( $value['background-image'] ) ) {

                        /* If an attachment ID is stored here fetch its URL and replace the value */
                        if ( wp_attachment_is_image( $value['background-image'] ) ) {

                            $attachment_data = wp_get_attachment_image_src( $value['background-image'], 'original' );

                            /* check for attachment data */
                            if ( $attachment_data ) {

                                $value['background-image'] = $attachment_data[0];

                            }

                        }

                        $bg[] = 'url("' . $value['background-image'] . '")';

                    }

                    if ( ! empty( $value['background-repeat'] ) )
                        $bg[] = $value['background-repeat'];

                    if ( ! empty( $value['background-attachment'] ) )
                        $bg[] = $value['background-attachment'];

                    if ( ! empty( $value['background-position'] ) )
                        $bg[] = $value['background-position'];

                    if ( ! empty( $value['background-size'] ) )
                        $size = $value['background-size'];

                    /* set $value with background properties or empty string */
                    $value = ! empty( $bg ) ? 'background: ' . implode( " ", $bg ) . ';' : '';

                    if ( isset( $size ) ) {
                        if ( ! empty( $bg ) ) {
                            $value.= apply_filters( 'ot_insert_css_with_markers_bg_size_white_space', "\n\x20\x20", $option_id );
                        }
                        $value.= "background-size: $size;";
                    }



                }

            }

            if(empty($value)) $value = '';

            return "\r\n$output{
                $value
            }\r\n";
        }


    }

    STCustomCSSOutput::_init();

}


if ( ! function_exists( 'ot_normalize_css' ) ) {

    function ot_normalize_css( $css ) {

        /* Normalize & Convert */
        $css = str_replace( "\r\n", "\n", $css );
        $css = str_replace( "\r", "\n", $css );

        /* Don't allow out-of-control blank lines */
        $css = preg_replace( "/\n{2,}/", "\n\n", $css );

        return $css;
    }

}
if ( ! function_exists( 'ot_get_option_type_by_id' ) ) {

    function ot_get_option_type_by_id( $option_id, $settings_id = '' ) {

        if ( empty( $settings_id ) ) {

            $settings_id = ot_settings_id();

        }

        $settings = get_option( $settings_id, array() );

        if ( isset( $settings['settings'] ) ) {

            foreach( $settings['settings'] as $value ) {

                if ( $option_id == $value['id'] && isset( $value['type'] ) ) {

                    return $value['type'];

                }

            }

        }

        return false;

    }

}
if ( ! function_exists( 'ot_array_keys_exists' ) ) {

    function ot_array_keys_exists( $array, $keys ) {

        foreach($keys as $k) {

            if(key_exists($k, $array)){
                return true;
            }

            /*if ( isset($array[$k]) ) {
                return true;
            }*/
        }

        return false;
    }

}
if ( ! function_exists( 'ot_recognized_font_families' ) ) {

    function ot_recognized_font_families( $field_id = '' ) {

        $families = array(
            'arial'     => 'Arial',
            'georgia'   => 'Georgia',
            'helvetica' => 'Helvetica',
            'palatino'  => 'Palatino',
            'tahoma'    => 'Tahoma',
            'times'     => '"Times New Roman", sans-serif',
            'trebuchet' => 'Trebuchet',
            'verdana'   => 'Verdana'
        );

        return apply_filters( 'ot_recognized_font_families', $families, $field_id );

    }

}