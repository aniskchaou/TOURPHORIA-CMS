<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity field taxonomy
 *
 * Created by ShineTheme
 *
 */
$default = array(
    'title'                    => '' ,
    'taxonomy'                 => '' ,
    'is_required'              => 'on' ,
    'type_show_taxonomy_hotel' => 'checkbox' ,
);
if(isset( $data )) {
    extract( wp_parse_args( $data , $default ) );
    if(!empty( $data[ 'custom_terms_' . $taxonomy ] )) {
        $terms_custom = $data[ 'custom_terms_' . $taxonomy ];
        $terms_custom = array_values( $terms_custom );
    }
} else {
    extract( $default );
}

if(!isset( $field_size ))
    $field_size = 'lg';



if($is_required == 'on') {
    $is_required = 'required';
}

$checkbox_item_size = 4;
if(!empty( $st_direction ) and $st_direction == 'vertical') {
    $checkbox_item_size = apply_filters( "st_taxonomy_checkbox_size" , '6' );
} // from 1.2.1



    if($type_show_taxonomy_hotel == "select") {
        ?>
        <div class="form-group form-group-<?php echo esc_attr( $field_size )?>" taxonomy="<?php echo esc_html( $taxonomy ) ?>">
            <label for="field-hotel-tax-<?php echo esc_html( $taxonomy ) ?>"><?php echo esc_html( $title )?></label>
            <?php
            $args = array(
                'show_option_none' => __( '-- Select --' , ST_TEXTDOMAIN ),
                'option_none_value' => "",
                'hierarchical'      => 1 ,
                'name'              => 'taxonomy['.$taxonomy.']' ,
                'class'             => 'form-control' ,
                'id'             => 'field-hotel-tax-'.$taxonomy ,
                'taxonomy'          => $taxonomy ,
            );
            if(!empty( $terms_custom ) and $terms_custom[ 0 ] != "all") {
                $tmp_data = array();
                foreach( $terms_custom as $k => $v ) {
                    $tmp        = explode( "|" , $v );
                    $key_id     = $tmp[ 0 ];
                    $value_name = $tmp[ 1 ];
                    $tmp_data[] = $key_id;
                }

                $args['include'] = $tmp_data;
            }
            $is_taxonomy = STInput::request('taxonomy');
            if(!empty($is_taxonomy[$taxonomy])){
                $args['selected'] = $is_taxonomy[$taxonomy];
            }
            wp_dropdown_categories( $args );
            ?>
        </div>
    <?php } else { ?>
        <div class="form-custom-taxonomy form-group form-group-<?php echo esc_attr( $field_size )?>"
             taxonomy="<?php echo esc_html( $taxonomy ) ?>">
            <label for="field-hotel-tax-<?php echo esc_html( $taxonomy ) ?>"><?php echo esc_html( $title )?></label>

            <div class="row">
                <?php

                if(!empty( $terms_custom ) and $terms_custom[ 0 ] != "all") {
                    $terms = $terms_custom;
                } else {
                    $terms = get_terms($taxonomy,array('hide_empty'=> false));
                }

                if(is_array( $terms )) { ?>
                    <?php
                    $i = 0;
                    foreach( $terms as $k => $v ) {
                        $key_id = $value_name = "";
                        if(!empty( $v->term_id )) {
                            $key_id     = $v->term_id;
                            $value_name = $v->name;
                        } else {
                            $tmp        = explode( "|" , $v );
                            $key_id     = $tmp[ 0 ];
                            $value_name = $tmp[ 1 ];
                        }

                        $is_taxonomy = STInput::request( 'taxonomy' );
                        $is_check    = '';
                        if(!empty( $is_taxonomy[ $taxonomy ] )) {
                            $data = explode( ',' , $is_taxonomy[ $taxonomy ] );
                            if(in_array( $key_id , $data )) {
                                $is_check = 'checked';
                            }
                        }
                        ?>
                        <div <?php if(( $i + 1 ) % ( 12 / $checkbox_item_size ) == 1) {
                            echo " style='clear:both'";
                        } ?> class="checkbox col-xs-12 col-sm-<?php echo esc_attr( $checkbox_item_size );?>">
                            <label>
                                <input class="i-check item_tanoxomy" <?php echo esc_html( $is_check ) ?>
                                       type="checkbox"
                                       value="<?php echo esc_attr( $key_id ) ?>"/><?php echo esc_html( $value_name ) ?>
                            </label>
                        </div>
                        <?php $i++;
                    }
                    unset ( $i );
                    ?>
                <?php } ?>
            </div>
            <input type="hidden" class="data_taxonomy" name="taxonomy[<?php echo esc_html( $taxonomy ) ?>]" value="">
        </div>
    <?php } ?>

