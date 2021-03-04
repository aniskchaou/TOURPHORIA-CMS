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
    'title'                         => '' ,
    'taxonomy_room'                 => '' ,
    'is_required'                   => 'on' ,
    'type_show_taxonomy_hotel_room' => 'checkbox'
);

if(isset( $data )) {
    extract( wp_parse_args( $data , $default ) );
} else {
    extract( $default );
}

if(!isset( $field_size ))
    $field_size = 'lg';

$terms = get_terms( $taxonomy_room );

if($is_required == 'on') {
    $is_required = 'required';
}

$checkbox_item_size = 4;
if(!empty( $st_direction ) and $st_direction == 'vertical') {
    $checkbox_item_size = apply_filters( "st_taxonomy_checkbox_size" , '6' );
} // from 1.2.1


if($type_show_taxonomy_hotel_room == "select") {
    ?>
    <div class="form-group form-group-<?php echo esc_attr( $field_size )?>"
         taxonomy="<?php echo esc_html( $taxonomy_room ) ?>">
        <label
            for="field-hotelroom-tax-<?php echo esc_html( $taxonomy_room ) ?>"><?php echo esc_html( $title )?></label>
        <?php
        $args        = array(
            'show_option_none' => __( '-- Select --' , ST_TEXTDOMAIN ) ,
            'option_none_value' => "",
            'hierarchical'     => 1 ,
            'name'             => 'taxonomy_hotel_room[' . $taxonomy . ']' ,
            'class'            => 'form-control' ,
            'id'               => 'field-hotelroom-tax-' . $taxonomy ,
            'taxonomy'         => $taxonomy ,
        );
        $is_taxonomy = STInput::request( 'taxonomy' );
        if(!empty( $is_taxonomy[ $taxonomy ] )) {
            $args[ 'selected' ] = $is_taxonomy[ $taxonomy ];
        }
        wp_dropdown_categories( $args );
        ?>
    </div>
<?php } else { ?>
    <div class="form-custom-taxonomy form-group form-group-<?php echo esc_attr( $field_size )?>"
         taxonomy="<?php echo esc_html( $taxonomy_room ) ?>">
        <label for="field-hotelroom-tax-<?php echo esc_html( $taxonomy_room ) ?>"><?php echo esc_html( $title )?></label>
        <div class="row">
            <?php if(is_array( $terms )) { ?>
                <?php
                $i = 0;
                foreach( $terms as $k => $v ) { ?>
                    <?php $is_taxonomy = STInput::request( 'taxonomy_hotel_room' );
                    $is_check          = '';
                    if(!empty( $is_taxonomy[ $taxonomy_room ] )) {
                        $data = explode( ',' , $is_taxonomy[ $taxonomy_room ] );
                        if(in_array( $v->term_id , $data )) {
                            $is_check = 'checked';
                        }
                    }
                    ?>
                    <div <?php if(( $i + 1 ) % ( 12 / $checkbox_item_size ) == 1) {
                        echo " style='clear:both'";
                    } ?> class="checkbox col-xs-12 col-sm-<?php echo esc_attr( $checkbox_item_size );?>">
                        <label>
                            <input class="i-check item_tanoxomy" <?php echo esc_html( $is_check ) ?>  type="checkbox"
                                   value="<?php echo esc_attr( $v->term_id ) ?>"/><?php echo esc_html( $v->name ) ?>
                        </label>
                    </div>
                    <?php $i++;
                }
                unset( $i ); ?>
            <?php } ?>
        </div>
        <input type="hidden" class="data_taxonomy" name="taxonomy_hotel_room[<?php echo esc_html( $taxonomy_room ) ?>]" value="">
    </div>
<?php } ?>

