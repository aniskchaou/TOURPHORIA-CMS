/**
 * Created by Administrator on 07/05/2015.
 */
jQuery(document).ready(function($){
    $('input[name="st_icon"], input[name*="tab_icon_"]').iconpicker({
        icons : st_icon_picker.icon_list,
        iconClassPrefix: ''
    });
});