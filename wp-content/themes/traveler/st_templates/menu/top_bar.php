<?php
$hidden_topbar_in_mobile = st()->get_option('hidden_topbar_in_mobile','on');
if($hidden_topbar_in_mobile == 'on'){
	if(wp_is_mobile())
		return;
}
wp_enqueue_script('handlebars-v2.0.0.js');
?>
<div id='top_toolbar' class="<?php echo ($hidden_topbar_in_mobile=='on'?'hidden_topbar_in_mobile':'')?>" style= 'background-color: <?php echo st()->get_option('topbar_bgr', "#333"); ?> ' >
    <div class='container'>
        <div class="row">
            <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left left_topbar'>                
                    <!-- <?php 
                                 $topbar_left = st()->get_option('topbar_left' , 'text');
                                 switch ($topbar_left) {
                                     case 'menu':
                                         echo st()->load_template('menu/dropdown-menu' , null , array('menu'=>st()->get_option('topbar_left_menu')));
                                         break;
                                     default:
                                         echo do_shortcode(st()->get_option('topbar_left_text'));
                                         break;
                                 }
                                     
                                 ?>    -->   

                <?php 
                    /**
                    *@since 1.2.5
                    *   Show topbar menu in left
                    **/
                    $sort_topbar_menu = st()->get_option( 'sort_topbar_menu', false );
                    if( $sort_topbar_menu ):
                ?>          
                <ul class="top-user-area-list list list-horizontal list-border clearfix">
                    <?php 
                        do_action('traveler_before_show_topbar_left');

                        foreach( $sort_topbar_menu as $key => $val ):
                            if( !empty( $val['topbar_item'] ) && $val['topbar_position'] == 'left' ){
                                if( $val['topbar_item'] == 'login' ){
                                    echo st()->load_template("menu/login_select" , null ,  array('container' =>"li"  , "class"=>"top-user-area-avatar"));
                                }
                                if( $val['topbar_item'] == 'currency' ){
                                    echo st()->load_template("menu/currency_select" , null ,  array('container' =>"li"  , "class"=>"nav-drop nav-symbol"));
                                }
                                if( $val['topbar_item'] == 'language' ){
                                    echo st()->load_template("menu/language_select" , null ,  array('container' =>"li"  , "class"=>"top-user-area-lang nav-drop"));
                                }
                                if( $val['topbar_item'] == 'shopping_cart' ){
                                    echo st()->load_template("menu/shopping_cart" , null ,  array('container' =>"li"  , "class"=>"top-user-area-shopping"));
                                }
                                if( $val['topbar_item'] == 'link' ){
                                    $icon = '';
                                    if( !empty( $val['topbar_custom_link_icon'] ) ){
                                        $icon = esc_html( $val['topbar_custom_link_icon'] );
                                    }
                                    $target= '';
                                    if( !empty($val['topbar_custom_link_target']) && $val['topbar_custom_link_target'] == 'on'){
                                        $target = '_blank';
                                    }
                                    echo '<li><a href="'. esc_url( $val['topbar_custom_link'] ).'" target="'.$target.'"> <i class="fa '. $icon .' mr5"></i>'. esc_html( $val['topbar_custom_link_title'] ).'</a></li>';
                                }
                                if( $val['topbar_item'] == 'search' ){
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

                        do_action('traveler_after_show_topbar_left');
                    ?>
                </ul>
                <?php endif; ?>
            </div>
            <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right right_topbar top-user-area'>                
                    <!-- <?php 
                                  $topbar_right = st()->get_option('topbar_right' , 'text');
                                  switch ($topbar_right) {
                                      case 'menu':
                                          echo st()->load_template('menu/dropdown-menu' , null , array('menu'=>st()->get_option('topbar_right_menu')));
                                          break;
                                      default:
                                          echo do_shortcode(st()->get_option('topbar_right_text'));
                                          break;
                                  }                        
                                  ?>   -->  
                <?php 
                    /**
                    *@since 1.2.5
                    *   Show topbar menu in left
                    **/
                    $sort_topbar_menu = st()->get_option( 'sort_topbar_menu', false );
                    if( $sort_topbar_menu ):
                ?>          
                <ul class="top-user-area-list list list-horizontal list-border clearfix">
                    <?php 
                        do_action('traveler_before_show_topbar_right');

                        foreach( $sort_topbar_menu as $key => $val ):
                            if( !empty( $val['topbar_item'] ) && $val['topbar_position'] == 'right' ){
                                if( $val['topbar_item'] == 'login' ){
                                    echo st()->load_template("menu/login_select" , null ,  array('container' =>"li"  , "class"=>"top-user-area-avatar"));
                                }
                                if( $val['topbar_item'] == 'currency' ){
                                    echo st()->load_template("menu/currency_select" , null ,  array('container' =>"li"  , "class"=>"nav-drop nav-symbol"));
                                }
                                if( $val['topbar_item'] == 'language' ){
                                    echo st()->load_template("menu/language_select" , null ,  array('container' =>"li"  , "class"=>"top-user-area-lang nav-drop"));
                                }
                                if( $val['topbar_item'] == 'shopping_cart' ){
                                    echo st()->load_template("menu/shopping_cart" , null ,  array('container' =>"li"  , "class"=>"top-user-area-shopping"));
                                }
                                if( $val['topbar_item'] == 'link' ){
                                    $icon = '';
                                    if( !empty( $val['topbar_custom_link_icon'] ) ){
                                        $icon = esc_html( $val['topbar_custom_link_icon'] );
                                    }
                                    $target= '';
                                    if( !empty($val['topbar_custom_link_target']) && $val['topbar_custom_link_target'] == 'on'){
                                        $target = '_blank';
                                    }
                                    echo '<li><a href="'. esc_url( $val['topbar_custom_link'] ).'" target="'.$target.'"> <i class="fa '. $icon .' mr5"></i>'. esc_html( $val['topbar_custom_link_title'] ).'</a></li>';
                                }
                                if( $val['topbar_item'] == 'search' ){
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

                        do_action('traveler_after_show_topbar_right');
                    ?>
                </ul>
                <?php endif; ?>            
            </div>
        </div>
    </div>
</div>