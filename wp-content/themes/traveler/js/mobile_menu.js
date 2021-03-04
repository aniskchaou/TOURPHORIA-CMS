(function ($) {
    "use strict";
    $(document).ready(function () {
        if($('#wp_is_mobile').length){
            $('#slimmenu .menu-item.menu-item-has-children>a').append("<span class=\"sub-toggle\"><i class=\"fa fa-angle-down\"></i></span>");
            $(document).on('click', '.menu-item .sub-toggle', function (e) {
               e.preventDefault();
               var me = $(this);
               me.parent().next('.sub-menu').stop(true, true).slideToggle();

               var faicon = me.find('i');
               if(faicon.hasClass('fa-angle-down')){
                   faicon.removeClass('fa-angle-down').addClass('fa-angle-up');
               }else{
                   faicon.removeClass('fa-angle-up').addClass('fa-angle-down');
               }
            });
            $('.collapse-button').click(function () {
               $('#slimmenu').stop(true, true).slideToggle();
               $('.sub-menu').slideUp();
               if($('.sub-toggle i').hasClass('fa-angle-up')){
                   $('.sub-toggle i').removeClass('fa-angle-up').addClass('fa-angle-down');
               }
            });
        }

        if (typeof $.fn.sticky != 'undefined') {
            var topSpacing = 0;
            if ($(window).width() > 481 && $('body').hasClass('admin-bar')) {
                topSpacing = $('#wpadminbar').height()
            }
            set_sticky()
        }
        function set_sticky() {
            var is_menu1 = $(".menu_style1").length;
            var is_menu2 = $(".menu_style2").length;
            var is_topbar = $("#top_toolbar").length;
            var sticky_topbar = $(".enable_sticky_topbar").length;
            var sticky_menu = $(".enable_sticky_menu").length;
            var sticky_header = $(".enable_sticky_header").length;
            if (sticky_header || (sticky_menu && sticky_topbar)) {
                $("#st_header_wrap_inner").sticky({topSpacing: topSpacing});
                return
            } else {
                if (sticky_topbar && is_topbar) {
                    $("#top_toolbar").sticky({topSpacing: topSpacing})
                }
                if (sticky_menu && (is_menu1 || is_menu2 || is_menu3 || is_menu4)) {
                    var topSpacing_topbar = topSpacing;
                    if (is_topbar && sticky_topbar) {
                        topSpacing_topbar += $("#top_toolbar").height()
                    }
                    $("#menu1").sticky({topSpacing: topSpacing_topbar});
                    $("#menu2").sticky({topSpacing: topSpacing_topbar});
                    return
                }
            }
            return
        }

        //if($('#wp_is_mobile').length && $('.single ').length){
        if($('#wp_is_mobile').length){
            if($('.st_above_on_mobile').length && $('.st_below_on_mobile').length) {
                var elAbove = $('.st_above_on_mobile');
                var elBelow = $('.st_below_on_mobile');
                var elBelow_clone = elBelow.clone();
                elBelow.remove();
                elBelow_clone.css({
                    'margin-top': '30px'
                });
                elAbove.parent().append(elBelow_clone);
            }
        }
    });
})(jQuery);