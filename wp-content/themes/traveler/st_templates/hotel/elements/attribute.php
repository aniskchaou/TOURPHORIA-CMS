<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel attribute
 *
 * Created by ShineTheme
 *
 */
if(isset( $attr )) {
    $default = array(
        'taxonomy'  => '' ,
        'item_col'  => '' ,
        'title'     => '' ,
        'font_size' => '4' ,
    );
    extract( wp_parse_args( $attr , $default ) );
    if($taxonomy and taxonomy_exists( $taxonomy )) {

        $value = get_taxonomy( $taxonomy );
        if(!$title) {
            $title = $value->labels->name;
        }
        //Check is attribute
        $terms = get_the_terms( get_the_ID() , $taxonomy );

        if(!empty( $terms )) {
            ?>
            <h<?php echo esc_attr( $font_size ) ?>><?php echo apply_filters( 'widget_title',$title); ?></h<?php echo esc_attr( $font_size ) ?>>

            <ul class="booking-item-features booking-item-features-expand mb30 clearfix">
                <?php

                foreach( $terms as $key2 => $value2 ) {
                    ?>
                    <li class="<?php if($item_col)
                        echo 'col-sm-' . $item_col ?>">
                        <?php if(function_exists( 'get_tax_meta' )): ?>
                            <i class="<?php echo TravelHelper::handle_icon( get_tax_meta( $value2->term_id , 'st_icon' ) ) ?>"></i>
                        <?php endif; ?>
                        <span class="booking-item-feature-title"><?php echo esc_html( $value2->name ) ?></span>
                    </li>
                <?php
                }

                ?>

            </ul>
        <?php
        }
    }


}