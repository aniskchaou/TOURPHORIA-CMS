(function ($) {
    var STNotice;
    STNotice = function () {
        var self = this;
        this.make = function (text, type, layout) {
            var n;
            if (typeof type == 'undefined') {
                type = 'infomation'
            }
            if (typeof layout == 'undefined') {
                layout = 'topRight'
            }
            n = noty({
                text: text,
                layout: layout,
                type: type,
                animation: {
                    open: 'animated bounceInRight',
                    close: 'animated bounceOutRight',
                    easing: 'swing',
                    speed: 500
                },
                theme: 'relax',
                timeout: 6000
            })
        };
        this.template = function (icon, html) {
            if (typeof icon != "undefined") {
                icon = "<i class='fa fa-" + icon + "'></i>"
            }
            return "<div class='st_notice_template'>" + icon + " <div class='display_table'>" + html + "</div>  </div>"
        }
    };
    STNotice = new STNotice;
    window.STNotice = STNotice;
    var i = 0;

    function show_noty(i) {
        if (typeof stanalytics.noty == "undefined")return !1;
        if (i >= stanalytics.noty.length)return !1;
        window.setTimeout(function () {
            var val = stanalytics.noty[i];
            var layout = stanalytics.noti_position;
            STNotice.make(STNotice.template(val.icon, val.message), val.type, layout);
            i++;
            show_noty(i)
        }, 500 * i)
    }

    if (typeof stanalytics != 'undefined')
        show_noty(0)
})(jQuery)