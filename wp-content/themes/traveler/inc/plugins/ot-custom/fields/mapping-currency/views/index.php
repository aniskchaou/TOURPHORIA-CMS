<?php
$wpml_options = get_option('icl_sitepress_settings');
if ($wpml_options['automatic_redirect'] == 1 || $wpml_options['automatic_redirect'] == 2) {
    if (function_exists('icl_get_languages')) {
        require_once 'wpml_index.php';
    }
}
if(function_exists('qtranxf_init_language')){
    require_once 'qtrans_index.php';
}
?>