<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Custom user menu
 *
 * Created by ShineTheme
 *
 */

?>
<?php
    ob_start();
?>
<div class="col-md-9">
    <div class="top-user-area clearfix">
    <?php 
        /**
        *@since 1.2.5
        *   Show menu header item by option
        **/

        $sort_header_menu = st()->get_option( 'sort_header_menu', '' );
        if( !$sort_header_menu ):
    ?>
        <ul class="top-user-area-list list list-horizontal list-border">
            <?php if (apply_filters('st_is_header_login', true )) {echo st()->load_template("menu/login_select" , null ,  array('container' =>"li"  , "class"=>"top-user-area-avatar")); }?>
            <?php if (apply_filters('st_is_header_currency', true )) {echo st()->load_template("menu/currency_select" , null ,  array('container' =>"li"  , "class"=>"nav-drop nav-symbol")); }?>
            <?php if (apply_filters('st_is_header_language', true )) {echo st()->load_template("menu/language_select" , null ,  array('container' =>"li"  , "class"=>"top-user-area-lang nav-drop")); }?>
        </ul>
        <?php
            $search_header_onoff = st()->get_option('search_header_onoff', 'on');
            if($search_header_onoff == 'on'):
                wp_enqueue_script( 'typeahead.js' );
                wp_enqueue_script( 'handlebars-v2.0.0.js' );
        ?>
        <form class="main-header-search" action="<?php echo home_url( '/' ); ?>" method="get">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-search input-icon"></i>
                <input type="text" placeholder="<?php echo apply_filters('st_header_search_placeholder',"")?>" data-lang="<?php echo (defined('ICL_LANGUAGE_CODE'))?ICL_LANGUAGE_CODE:false; ?>" name="s" value="<?php echo get_search_query() ?>" class="form-control st-top-ajax-search">
                <input type="hidden" name="post_type" value="post">
            </div>
        </form>
        <?php endif; ?>
    <?php else: ?>
        <ul class="top-user-area-list list list-horizontal list-border">
            <?php 
                do_action('traveler_before_show_header_menu');

                foreach( $sort_header_menu as $key => $val ):
                    if( !empty( $val['header_item'] ) ){
                        if( $val['header_item'] == 'login' ){
                            echo st()->load_template("menu/login_select" , null ,  array('container' =>"li"  , "class"=>"top-user-area-avatar"));
                        }
                        if( $val['header_item'] == 'currency' ){
                            echo st()->load_template("menu/currency_select" , null ,  array('container' =>"li"  , "class"=>"nav-drop nav-symbol"));
                        }
                        if( $val['header_item'] == 'language' ){
                            echo st()->load_template("menu/language_select" , null ,  array('container' =>"li"  , "class"=>"top-user-area-lang nav-drop"));
                        }
                        if( $val['header_item'] == 'link' ){
                            $icon = '';
                            if( !empty( $val['header_custom_link_icon'] ) ){
                                $icon = esc_html( $val['header_custom_link_icon'] );
                            }
                            echo '<li><a href="'. esc_url( $val['header_custom_link'] ).'"> <i class="fa '. $icon .' mr5"></i>'. esc_html( $val['header_custom_link_title'] ).'</a></li>';
                        }
                        if( $val['header_item'] == 'shopping_cart' ){
                            echo st()->load_template("menu/shopping_cart" , null ,  array('container' =>"li"  , "class"=>"top-user-area-shopping"));
                        }
                        if( $val['header_item'] == 'search' ){
                            $search_header_onoff = st()->get_option('search_header_onoff', 'on');
                            if($search_header_onoff == 'on'):
                                wp_enqueue_script( 'typeahead.js' );
                                wp_enqueue_script( 'handlebars-v2.0.0.js' );
                        ?>
                        <li>
                            <form class="main-header-search" action="<?php echo home_url( '/' ); ?>" method="get">
                                <div class="form-group form-group-icon-left">
                                    <i class="fa fa-search input-icon"></i>
                                    <input type="text" placeholder="<?php echo apply_filters('st_header_search_placeholder',"")?>" data-lang="<?php echo (defined('ICL_LANGUAGE_CODE'))?ICL_LANGUAGE_CODE:false; ?>" name="s" value="<?php echo get_search_query() ?>" class="form-control st-top-ajax-search">
                                    <input type="hidden" name="post_type" value="post">
                                </div>
                            </form>
                        </li>    
                        <?php endif;
                        }
                    }
            ?>  
            <?php 
                endforeach; 

                do_action('traveler_after_show_header_menu');
            ?>
        </ul>
    <?php endif; ?>    
    </div>
</div>
<?php
    echo  apply_filters("st_header_right_content" ,@ob_get_clean() ) ;
?>