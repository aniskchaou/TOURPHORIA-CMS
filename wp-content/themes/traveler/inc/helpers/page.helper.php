<?php
if (!function_exists('custom_page_menu_color')){
    function custom_page_menu_color ($a){
        //5157
        $color = get_post_meta(get_the_ID(),'menu_color',true);
        if (!empty($color)){
            return $a."@media (min-width: 991px) { .st_menu a, .st_menu * {color: ".$color ." !important}}";
        }
    }
    add_filter('st_custom_css','custom_page_menu_color');
}
