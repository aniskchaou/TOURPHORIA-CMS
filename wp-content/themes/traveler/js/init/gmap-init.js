jQuery(document).ready(function($) {
    $.each($(".st_google_map"), function(i, value) {
        var address, icon, v, saturation, lightness, gamma, map_config;
        v = $(value);
        address = v.data('address');
        icon = v.data('marker');
        saturation = v.data('saturation');
        lightness = v.data('lightness');
        gamma = v.data('gamma');
        map_config = {
            map: {
                options: {
                    styles: [{
                        stylers: [{
                            "saturation": v.data('saturation')
                        }, {
                            "lightness": v.data('lightness')
                        }, {
                            "gamma": v.data('gamma')
                        }]
                    }],
                    zoom: v.data('zoom'),
                    scrollwheel: !1,
                    draggable: !0
                }
            }
        };
        if (v.data('type') == 1) {
            map_config.marker = {
                address: v.data('address')
            };
            map_config.map.address = v.data('address')
        } else {
            map_config.marker = {
                latLng: [v.data('lat'), v.data('lng')]
            };
            map_config.map.options.center = [v.data('lat'), v.data('lng')]
        }
        map_config.marker.options = {
            icon: icon
        };
        try {
            v.gmap3(map_config);
            var index = v.parents('.ui-tabs-panel').index();
            index--;
            var item_click = v.parents('.ui-tabs').children('.nav-tabs').find('li:eq(' + index + ')');
            console.log(item_click);
            if (item_click.length) {
                item_click.click(function() {
                    v.gmap3({
                        trigger: "resize"
                    });
                    v.gmap3('get').setCenter({
                        lat: parseFloat(v.data('lat')),
                        lng: parseFloat(v.data('lng'))
                    })
                })
            }
            var index2 = $('.vc_tta-tabs-list');
            if (index2.length) {
                index2.click(function() {
                    setTimeout(function() {
                        console.log(index2);
                        v.gmap3({
                            trigger: "resize"
                        });
                        v.gmap3('get').setCenter({
                            lat: parseFloat(v.data('lat')),
                            lng: parseFloat(v.data('lng'))
                        })
                    }, 200)
                })
            }
            $(document).on('click', '.nav-tabs>li>a, .ult_tabmenu .ult_tab_li a', function() {
                window.setTimeout(function() {
                    v.gmap3({
                        trigger: "resize"
                    })
                    v.gmap3('get').setCenter({
                            lat: parseFloat(v.data('lat')),
                            lng: parseFloat(v.data('lng'))
                        })
                }, 500)
            })
        } catch (e) {
            console.log(e)
        }
    })
})