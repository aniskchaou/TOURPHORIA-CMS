<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/15/14
 * Time: 11:23 AM
 */

if(!function_exists( 'st_post_data' )) {
    function st_post_data( $attr = array() )
    {
        $default = array(
            'title'   => '' ,
            'font_size'   => '3' ,
            'field'   => 'title' ,
            'post_id' => false,
            'thumb_size'=> 'thumbnail'
        );
        extract( wp_parse_args( $attr , $default ) );

        if(!$post_id and is_single()) {
            $post_id = get_the_ID();
        }

        if($post_id and is_single()) {
            $content = '';
            switch( $field ) {
                case "content":
                    $post = get_post( $post_id );
                    $content .= $post->post_content;
                    $content = apply_filters( 'the_content' , $content );
                    $content = str_replace( ']]>' , ']]&gt;' , $content );
                    if(!empty( $title ) and !empty( $content )) {
                        $content = '<h'.$font_size.'>' . $title . '</h'.$font_size.'>' . $content;
                    }
                    break;
                case "excerpt":
                    $post = get_post( $post_id );
                    if(isset( $post->post_excerpt )) {
                        $content .= $post->post_excerpt;
                    }
                    if(!empty( $title ) and !empty( $content )) {
                        $content = '<h'.$font_size.'>' . $title . '</h'.$font_size.'>' . $content;
                    }
                    break;
                case "title":
                    $content = get_the_title( $post_id );
                    if(!empty( $title ) and !empty( $content )) {
                        $content = '<h'.$font_size.'>' . $title . '</h'.$font_size.'>' . $content;
                    }
                    break;
                case "thumbnail":
                    if(has_post_thumbnail($post_id)){
                        $content .= get_the_post_thumbnail($post_id , $thumb_size , array("class"=> "st_post_data_thumb", 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($post_id ))));
                    }                     
            }
            return $content;
        }

    }
}

st_reg_shortcode( 'st_post_data' , 'st_post_data' );

if(!function_exists( 'st_post_share' )) {
    function st_post_share()
    {
        return '<div class="package-info tour_share" style="clear: both;text-align: right">
            ' . st()->load_template( 'hotel/share' ) . '
        </div>';
    }
}
st_reg_shortcode( 'st_post_share' , 'st_post_share' );

