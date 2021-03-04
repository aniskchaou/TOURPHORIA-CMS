<?php

    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class Featured
     *
     * Created by ShineTheme
     *
     */
    class STFeatured extends TravelerObject
    {
        function __construct()
        {

        }

        function init()
        {
            parent::init();
        }

        static function get_featured( $id = null )
        {
            if ( empty( $id ) ) $id = get_the_ID();
            $check_featured = get_post_meta( $id, 'is_featured', true );
            $feature_style  = st()->get_option( 'feature_style', "" );
            $feature_text   = st()->get_option( 'st_text_featured', __( 'Featured', ST_TEXTDOMAIN ) );
            if ( !empty( $check_featured ) and $check_featured == 'on' ) {
                switch ( $feature_style ) {
                    case "simple":
                        return '<div class="feature_class st_featured_simple featured"><div>' . $feature_text . '</div></div>';
                        break;
                    case "label":
                        $feature_star_div = "<div class='st_label_star'><i class=\"fa fa-star\"></i><i class=\"fa fa-star\"></i><i class=\"fa fa-star\"></i><div class='feature_class st_label_star_border_div'></div></div>";

                        return '<div class="feature_class st_featured_label featured"><div>' . $feature_text . '</div>' . $feature_star_div . '</div>';
                        break;
                    default :
                        return '<div class="feature_class st_featured featured">' . $feature_text . '</div>';
                        break;
                }
            }

            return false;
        }

        // from 1.2.3 - sale template

        static function get_sale( $count_sale = false, $post_id = false)
        {
            if ( empty( $count_sale ) or !$count_sale ) {
                return '';
            }
            $sale_style = st()->get_option( 'sale_style', '' );
            $sale_text  = st()->get_option( 'st_text_sale', __( "Sale ", ST_TEXTDOMAIN ) );
            $sale_text  = str_replace( "[st_sale_value]", $count_sale, $sale_text );
            $sale_text  = str_replace( "%", "", $sale_text );
            switch ( $sale_style ) {
                case "simple":
                    return '<div class="st_sale_class st_sale_simple"><div>' . $sale_text . '</div></div>';
                    break;
                case "label":
                    $sale_star_div = "<div class='st_label_star'><i class=\"fa fa-star\"></i><i class=\"fa fa-star\"></i><i class=\"fa fa-star\"></i><div class='st_star_label_sale_div'></div></div>";

                    return '<div class="st_sale_class st_sale_label st_sale_label_1"><div>' . $sale_text . '</div>' . $sale_star_div . '</div>';
                    break;
                default :
                    if ( !intval( $count_sale ) ) {
                        break;
                    }

                    if(empty($post_id))
                        $post_id = get_the_ID();

                    $discount_type = get_post_meta($post_id, 'discount_type', true);

                    if($discount_type == 'amount'){
                        echo "<span class=\"st_sale_class box_sale sale_small\">" . TravelHelper::format_money($count_sale) . "</span>";
                    }else{
                        echo "<span class=\"st_sale_class box_sale sale_small\">" . $count_sale . "% </span>";
                    }
                    break;
            }
        }
    }

    $st = new STFeatured();
    $st->init();