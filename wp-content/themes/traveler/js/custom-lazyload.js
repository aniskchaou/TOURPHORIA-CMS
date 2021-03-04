(function ($) {
    "use strict";
    $(document).ready(function () {

        if($('.st_lazy_load').length){
            $('.st_lazy_load').each(function() {
                var me = $(this);
                new Waypoint({
                    element: me,
                    handler: function () {
                        var stLazy = me.find('.st-lazy');
                        stLazy.each(function () {
                            var imgItem = $(this);
                            var imgSRC = imgItem.data('src');
                            me.find('.layzyload-wrapper .layzyload-item').fadeOut(10, 'linear', function () {
                                me.find('.layzyload-wrapper').addClass('layzyload-noafter');
                                imgItem.attr('src', imgSRC).show();
                            });
                        });
                        this.destroy()
                    },
                    offset: $(window).height()
                });
            });
        }

        if($('.fotorama').length){
            $('.fotorama').each(function () {
                var me = $(this);
                if(me.data('auto') == false){
                    new Waypoint({
                        element: me,
                        handler: function () {
                            me.fotorama();
                            this.destroy()
                        },
                        offset: $(window).height()
                    });
                }
            });
        }
    });
})(jQuery);