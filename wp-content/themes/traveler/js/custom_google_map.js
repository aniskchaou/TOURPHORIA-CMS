function closeGmapThumbItem(me) {
    jQuery(me).closest(".div_item_map").remove()
}
jQuery(document).ready(function ($) {
    $(".st_list_map .div_item_map").hide();
    $(".st_list_map .div_item_map").fadeIn(1E3)
});
jQuery(document).ready(function ($) {
    if ($(".st_detailed_map").length > 0) {
        var me = $(".st_detailed_map");
        var my_div_map = jQuery("#list_map");
        var data_show = me.data("data_show");
        var map_height = me.data("map_height");
        var style_map = me.data("style_map");
        var type_map = me.data("type_map");
        var street_views = me.data("street_views");
        var height = me.data("height");
        var location_center = me.data("location_center");
        var zoom = me.data("zoom");
        var range = me.data("range");
        jQuery(function ($) {
            var waypoint = new Waypoint({
                element: document.getElementById('list_map'),
                handler: function () {
                    init_list_map(my_div_map, data_show, location_center, zoom, style_map);
                    this.destroy()
                },
                offset: $(window).height()
            });
            // init_list_map(my_div_map, data_show, location_center,
            //     zoom, style_map);
            $("a[data-vc-tabs],a[data-vc-accordion]").on("click", function () {
                setTimeout(function () {
                    /*var gmap_obj = my_div_map.gmap3("get");
                    google.maps.event.trigger(gmap_obj, "resize");
                    gmap_obj.setCenter(new google.maps.LatLng(location_center[0], location_center[1]))*/
                    if($('#list_map iframe').length) {
                        var iframe = $('#list_map iframe').get(0);
                        iframe.src = iframe.src;
                    }
                }, 100)
            });
            function init_list_map(div_map, data_map, map_center, data_zoom, style_map) {
                var map = div_map;
                var markers = [];
                var bounds = new google.maps.LatLngBounds;
                data_zoom = parseInt(data_zoom);
                var options = {
                    map: {
                        options: {
                            center: map_center,
                            zoom: data_zoom,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            navigationControl: !0,
                            scrollwheel: !0,
                            streetViewControl: !1,
                            scaleControl: !0,
                            mapTypeControl: !0,
                            zoomControl: !0,
                            zoomControlOptions: {style: google.maps.ZoomControlStyle.SMALL}
                        }, events: {
                            zoom_changed: function (map) {
                                $(this).attr("data-zoom", map.getZoom())
                            }, tilesloaded: function (map) {
                                jQuery("#st-gmap-loading").fadeOut(700);
                                jQuery(".st-gmap-loading-bg").fadeOut(700);
                                setTimeout(function () {
                                        $(div_map).find(".st-popup-gallery").each(function () {
                                            $(this).magnificPopup({
                                                delegate: ".st-gp-item",
                                                type: "image",
                                                gallery: {enabled: !0}
                                            })
                                        })
                                    },
                                    200)
                            }
                        }
                    },
                    circle: {
                        options: {
                            center: location_center,
                            radius: range * 1E3,
                            fillColor: "#A3D5CB",
                            strokeColor: "#499195",
                            strokeWidth: 1
                        }
                    },
                    overlay: {
                        latLng: location_center,
                        options: {content: $(".data_content").html(), offset: {y: -210, x: 20}}
                    }
                };
                if (street_views == "on")options.map.options.streetViewControl = !0;
                map.gmap3(options);
                var gmap_obj = map.gmap3("get");
                var tmp_map_type = "roadmap";
                if (type_map != "")tmp_map_type = type_map;
                gmap_obj.setMapTypeId(tmp_map_type);
                for (var key in data_map) {
                    var tmp_data = data_map[key];
                    var myLatLng = new google.maps.LatLng(tmp_data.lat, tmp_data.lng);
                    bounds.extend(myLatLng);
                    var marker = ST_addMarker(myLatLng, gmap_obj, tmp_data, map);
                    markers.push(marker)
                }
                var mcOptions = {
                    styles: [{height: 53, url: st_list_map_params.cluster_m1, width: 53}, {
                        height: 56,
                        url: st_list_map_params.cluster_m2,
                        width: 56
                    }, {height: 66, url: st_list_map_params.cluster_m3, width: 66}, {
                        height: 78,
                        url: st_list_map_params.cluster_m4,
                        width: 78
                    }, {height: 90, url: st_list_map_params.cluster_m5, width: 90}]
                };
                var mc = new MarkerClusterer(gmap_obj, markers,
                    mcOptions);
                if (map.data("fitbounds") == "on") {
                    var gmap_object = map.gmap3("get");
                    gmap_object.fitBounds(bounds)
                }
                function ST_addMarker(location, gmap_object, tmp_data, map) {
                    var marker = new google.maps.Marker({
                        position: location,
                        options: {icon: tmp_data.icon_mk, animation: google.maps.Animation.DROP},
                        tag: "st_tag_" + tmp_data.id,
                        data: tmp_data
                    });
                    marker.addListener("click", function () {
                        gmap_object.panTo(location);
                        map.gmap3({clear: "overlay"}, {
                            overlay: {
                                pane: "floatPane", latLng: location, options: {
                                    content: tmp_data.content_html,
                                    offset: {x: 20, y: -210}
                                }
                            }
                        });
                        setTimeout(function () {
                            $(map).find(".st-popup-gallery").each(function () {
                                $(this).magnificPopup({delegate: ".st-gp-item", type: "image", gallery: {enabled: !0}})
                            })
                        }, 200)
                    });
                    return marker
                }

                return map
            }
        })
    }
});
jQuery(document).ready(function ($) {
    if ($(".st_list_map_html").length > 0) {
        var me = $(".st_list_map_html");
        var my_div_map = jQuery("#list_map");
        var data_show = me.data("data_show");
        var map_height = me.data("map_height");
        var style_map = me.data("style_map");
        var fit_bounds = me.data("fit_bounds");
        var location_center = me.data("location_center");
        var zoom = me.data("zoom");
        jQuery(function ($) {
            var filter_search_map = $(".search_list_map .filter_search_map");
            $(".search_list_map .filter_search_map .btn_search").click(function () {
                var $this =
                    $(this);
                var options = {
                    url: st_params.ajax_url, dataType: "json", beforeSend: function () {
                        jQuery("#st-gmap-loading").show();
                        jQuery(".st-gmap-loading-bg").show();
                        $this.html(st_params.text_loading);
                        $(".data_list_map").css("opacity", "0.5")
                    }, success: function (data) {
                        $("#list_map").gmap3({action: "destroy"});
                        var container = $("#list_map").parent();
                        $("#list_map").remove();
                        container.append('<div id="list_map"></div>');
                        $("#list_map").height(map_height);
                        $("#list_map").attr("data-fitbounds", fit_bounds);
                        if (data.location_center ==
                            "[0,0]")$("#list_map").attr("data-fitbounds", "on");
                        location_center = [data.map_lat_center, data.map_lng_center];
                        init_list_map($("#list_map"), data.data_map, location_center, data.zoom, style_map);
                        $(".data_list_map").html("");
                        var count = 0;
                        for (var key in data.data_map) {
                            var tmp_data = data.data_map[key];
                            var res = tmp_data.content_adv_html.replace("item_price_map", "");
                            $(".data_list_map").append('<div class="col-md-3 col-sm-6">' + res + "</div>");
                            count++
                        }

                        $(".count_advan_saerch").html("(" + count + ")");
                        if (count == 0)$(".data_list_map").append('<div class="alert alert-warning"> <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">\u00d7</span> </button> <p class="text-small">' +
                            st_list_map_params.text_no_result + "</p> </div>");
                        $(".data_list_map").css("opacity", "1");
                        $this.html($this.data("title"))
                    }, complete: function () {
                        jQuery("#st-gmap-loading").fadeOut(700);
                        jQuery(".st-gmap-loading-bg").fadeOut(700)
                    }
                };
                filter_search_map.ajaxForm(options)
            });
            $(".st_list_map .map-view").click(function () {
                if ($(this).hasClass("view")) {
                    $(this).removeClass("view");
                    $(".st_list_map").find(".st-map-type").hide()
                } else {
                    $(this).addClass("view");
                    $(".st_list_map").find(".st-map-type").show()
                }
            });
            $(".st_list_map .st-map-type").click(function () {
                var name =
                    $(this).data("name");
                var style = "";
                if (name == "style_normal")style = [{
                    featureType: "road.highway",
                    elementType: "geometry",
                    stylers: [{hue: "#ff0022"}, {saturation: 60}, {lightness: -20}]
                }];
                if (name == "style_midnight")style = [{
                    "featureType": "all",
                    "elementType": "labels.text.fill",
                    "stylers": [{"saturation": 36}, {"color": "#000000"}, {"lightness": 40}]
                }, {
                    "featureType": "all",
                    "elementType": "labels.text.stroke",
                    "stylers": [{"visibility": "on"}, {"color": "#000000"}, {"lightness": 16}]
                }, {
                    "featureType": "all", "elementType": "labels.icon",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [{"color": "#000000"}, {"lightness": 20}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#000000"}, {"lightness": 17}, {"weight": 1.2}]
                }, {
                    "featureType": "administrative.country",
                    "elementType": "labels",
                    "stylers": [{"visibility": "on"}, {"lightness": "0"}]
                }, {
                    "featureType": "administrative.country",
                    "elementType": "labels.text.fill",
                    "stylers": [{"visibility": "on"}, {"lightness": "13"}]
                },
                    {
                        "featureType": "landscape",
                        "elementType": "geometry",
                        "stylers": [{"color": "#000000"}, {"lightness": 20}]
                    }, {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [{"color": "#000000"}, {"lightness": 21}]
                    }, {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [{"visibility": "on"}, {"saturation": "-100"}, {"lightness": "-20"}, {"invert_lightness": !0}]
                    }, {"featureType": "road", "elementType": "geometry.stroke", "stylers": [{"color": "#bebebe"}]}, {
                        "featureType": "road", "elementType": "labels.text.fill", "stylers": [{"visibility": "on"},
                            {"lightness": "-47"}]
                    }, {
                        "featureType": "road",
                        "elementType": "labels.text.stroke",
                        "stylers": [{"lightness": "-33"}, {"weight": "0.52"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "on"}, {"color": "#b5b5b5"}, {"saturation": "-1"}, {"gamma": "0.00"}, {"weight": "2.22"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [{"lightness": "0"}, {"visibility": "on"}, {"weight": "2.8"},
                            {"color": "#585858"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [{"color": "#909090"}, {"lightness": "2"}, {"weight": "0.2"}, {"visibility": "off"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [{"lightness": "16"}, {"color": "#595959"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "labels.text.stroke",
                        "stylers": [{"lightness": "-63"}, {"weight": "1"}]
                    }, {
                        "featureType": "road.arterial",
                        "elementType": "geometry",
                        "stylers": [{"color": "#000000"}, {"lightness": 18},
                            {"visibility": "on"}]
                    }, {
                        "featureType": "road.arterial",
                        "elementType": "geometry.fill",
                        "stylers": [{"visibility": "on"}, {"lightness": "10"}]
                    }, {
                        "featureType": "road.arterial",
                        "elementType": "labels.text.fill",
                        "stylers": [{"visibility": "on"}, {"lightness": "28"}]
                    }, {
                        "featureType": "road.arterial",
                        "elementType": "labels.text.stroke",
                        "stylers": [{"visibility": "on"}, {"weight": "0.1"}, {"lightness": "-96"}]
                    }, {
                        "featureType": "road.local",
                        "elementType": "geometry",
                        "stylers": [{"color": "#000000"}, {"lightness": 16}]
                    }, {
                        "featureType": "transit",
                        "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 19}]
                    }, {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [{"color": "#12161a"}, {"lightness": 17}]
                    }];
                if (name == "style_family_fest")style = [{
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [{"color": "#444444"}]
                }, {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [{"color": "#f2f2f2"}]
                }, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]}, {
                    "featureType": "poi", "elementType": "geometry.fill",
                    "stylers": [{"visibility": "on"}, {"saturation": "-6"}]
                }, {
                    "featureType": "poi",
                    "elementType": "geometry.stroke",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "poi",
                    "elementType": "labels",
                    "stylers": [{"visibility": "on"}, {"weight": "1.30"}]
                }, {
                    "featureType": "poi",
                    "elementType": "labels.text",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "poi",
                    "elementType": "labels.text.fill",
                    "stylers": [{"visibility": "on"}]
                }, {"featureType": "poi", "elementType": "labels.icon", "stylers": [{"visibility": "on"}]}, {
                    "featureType": "road",
                    "elementType": "all", "stylers": [{"saturation": -100}, {"lightness": 45}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [{"color": "#52978e"}, {"visibility": "on"}]
                }];
                if (name == "style_open_dark")style = [{
                    "featureType": "all", "elementType": "labels.text.fill",
                    "stylers": [{"color": "#ffffff"}]
                }, {
                    "featureType": "all",
                    "elementType": "labels.text.stroke",
                    "stylers": [{"visibility": "on"}, {"color": "#3e606f"}, {"weight": 2}, {"gamma": .84}]
                }, {
                    "featureType": "all",
                    "elementType": "labels.icon",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "administrative",
                    "elementType": "all",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry",
                    "stylers": [{"weight": .6}, {"color": "#1a3541"}]
                }, {
                    "featureType": "landscape", "elementType": "all", "stylers": [{"visibility": "on"},
                        {"color": "#293c4d"}]
                }, {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [{"color": "#2c5a71"}]
                }, {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [{"color": "#293c4d"}]
                }, {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{"color": "#406d80"}]
                }, {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [{"color": "#2c5a71"}]
                }, {"featureType": "road", "elementType": "all", "stylers": [{"visibility": "on"}]}, {
                    "featureType": "road", "elementType": "geometry", "stylers": [{"color": "#1f3035"},
                        {"lightness": -37}]
                }, {
                    "featureType": "road",
                    "elementType": "labels",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [{"color": "#406d80"}]
                }, {
                    "featureType": "transit",
                    "elementType": "labels.icon",
                    "stylers": [{"hue": "#00d1ff"}]
                }, {"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#193341"}]}];
                if (name == "style_riverside")style = [{
                    "featureType": "administrative", "elementType": "all",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "administrative",
                    "elementType": "labels",
                    "stylers": [{"visibility": "on"}, {"color": "#716464"}, {"weight": "0.01"}]
                }, {
                    "featureType": "administrative.country",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "administrative.country",
                    "elementType": "labels",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "administrative.country", "elementType": "labels.text",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "landscape.natural",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "landscape.natural.landcover",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [{"visibility": "simplified"}]
                }, {"featureType": "poi", "elementType": "geometry.fill", "stylers": [{"visibility": "simplified"}]},
                    {
                        "featureType": "poi",
                        "elementType": "geometry.stroke",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "labels.text",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "labels.text.stroke",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "poi.attraction",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "poi.business", "elementType": "geometry",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "poi.business",
                        "elementType": "geometry.fill",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "poi.government",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "poi.school",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "off"}]
                    }, {"featureType": "road", "elementType": "all", "stylers": [{"visibility": "on"}]}, {
                        "featureType": "road.highway", "elementType": "all",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [{"visibility": "on"}, {"color": "#787878"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [{"visibility": "simplified"}, {"color": "#a05519"}, {"saturation": "-13"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "labels.text",
                        "stylers": [{"color": "#fcfcfc"}, {"visibility": "on"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill", "stylers": [{"color": "#636363"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "labels.text.stroke",
                        "stylers": [{"weight": "4.27"}, {"color": "#ffffff"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "labels.icon",
                        "stylers": [{"visibility": "on"}, {"weight": "0.01"}]
                    }, {
                        "featureType": "road.local",
                        "elementType": "all",
                        "stylers": [{"visibility": "on"}]
                    }, {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "simplified"}]}, {
                        "featureType": "transit", "elementType": "geometry",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "transit.station",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [{"visibility": "simplified"}, {"color": "#84afa3"}, {"lightness": 52}]
                    }, {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [{"visibility": "on"}, {"color": "#7ca0a4"}]
                    }, {"featureType": "water", "elementType": "labels.text.fill", "stylers": [{"color": "#ffffff"}]}];
                if (name == "style_ozan")style = [{
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [{"visibility": "on"}, {"weight": 1}, {"color": "#003867"}]
                }, {
                    "featureType": "administrative",
                    "elementType": "labels.text.stroke",
                    "stylers": [{"visibility": "on"}, {"weight": 8}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}, {"color": "#E1001A"}, {"weight": .4}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}, {"color": "#edeff1"},
                        {"weight": .2}]
                }, {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}, {"color": "#edeff1"}, {"weight": .4}]
                }];
                init_list_map(my_div_map, "", location_center, zoom, style);
                $(".st_list_map .map-view").removeClass("view");
                $(".st-map-type").hide()
            });
            init_list_map(my_div_map, data_show, location_center, zoom, style_map);
            function init_list_map(div_map, data_map, map_center, data_zoom, style_map) {
                var map = div_map;
                var markers = [];
                var bounds = new google.maps.LatLngBounds;
                data_zoom = parseInt(data_zoom);
                var options = {
                    map: {
                        options: {
                            center: map_center,
                            zoom: data_zoom,
                            mapTypeId: google.maps.MapTypeId.TERRAIN,
                            styles: style_map,
                            navigationControl: !0,
                            scrollwheel: !0,
                            streetViewControl: !0,
                            scaleControl: !0,
                            mapTypeControl: !0,
                            mapTypeControlOptions: {
                                style: google.maps.MapTypeControlStyle.DEFAULT,
                                mapTypeIds: [google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.TERRAIN]
                            },
                            draggable: !0,
                            disableDefaultUI: !0,
                            zoomControl: !1,
                            zoomControlOptions: {style: google.maps.ZoomControlStyle.SMALL}
                        }, events: {
                            zoom_changed: function (map) {
                                $(this).attr("data-zoom",
                                    map.getZoom())
                            }, tilesloaded: function (map) {
                                jQuery("#st-gmap-loading").fadeOut(700);
                                jQuery(".st-gmap-loading-bg").fadeOut(700)
                            }
                        }
                    }
                };
                var $container = $(window).width();
                map.gmap3(options);
                var gmap_object = map.gmap3("get");
                for (var key in data_map) {
                    var tmp_data = data_map[key];
                    var myLatLng = new google.maps.LatLng(tmp_data.lat, tmp_data.lng);
                    bounds.extend(myLatLng);
                    var marker = ST_addMarker(myLatLng, gmap_object, tmp_data, map);
                    markers.push(marker)
                }
                var mcOptions = {
                    styles: [{
                        height: 53, url: st_list_map_params.cluster_m1,
                        width: 53
                    }, {height: 56, url: st_list_map_params.cluster_m2, width: 56}, {
                        height: 66,
                        url: st_list_map_params.cluster_m3,
                        width: 66
                    }, {height: 78, url: st_list_map_params.cluster_m4, width: 78}, {
                        height: 90,
                        url: st_list_map_params.cluster_m5,
                        width: 90
                    }]
                };
                var mc = new MarkerClusterer(gmap_object, markers, mcOptions);
                if (map.data("fitbounds") == "on") {
                    var gmap_object = map.gmap3("get");
                    gmap_object.fitBounds(bounds)
                }
            }

            function ST_addMarker(location, gmap_object, tmp_data, map) {
                var marker = new google.maps.Marker({
                    position: location, options: {
                        icon: tmp_data.icon_mk,
                        animation: google.maps.Animation.DROP
                    }, tag: "st_tag_" + tmp_data.id, data: tmp_data
                });
                marker.addListener("click", function () {
                    gmap_object.panTo(location);
                    map.gmap3({clear: "overlay"}, {
                        overlay: {
                            pane: "floatPane",
                            latLng: location,
                            options: {content: tmp_data.content_html, offset: {x: 20, y: -210}}
                        }
                    });
                    setTimeout(function () {
                        $(map).find(".st-popup-gallery").each(function () {
                            $(this).magnificPopup({delegate: ".st-gp-item", type: "image", gallery: {enabled: !0}})
                        })
                    }, 200)
                });
                return marker
            }
        })
    }
});
jQuery(document).ready(function ($) {
    if ($(".st_list_map_new_data").length > 0) {
        var me = $(".st_list_map_new_data");
        var my_div_map = jQuery("#list_map_new");
        var data_show = me.data("data_show");
        var map_height = me.data("map_height");
        var style_map = me.data("style_map");
        var type_map = me.data("type_map");
        var street_views = me.data("street_views");
        var height = me.data("height");
        var location_center = me.data("location_center");
        var zoom = me.data("zoom");
        var range = me.data("range");
        jQuery(function ($) {
            $(".st_list_map_new .map-view").click(function () {
                if ($(this).hasClass("view")) {
                    $(this).removeClass("view");
                    $(".st_list_map_new").find(".st-map-type").hide()
                } else {
                    $(this).addClass("view");
                    $(".st_list_map_new").find(".st-map-type").show()
                }
            });
            $(".st_list_map_new .st-map-type").click(function () {
                var name = $(this).data("name");
                var style = "";
                if (name == "style_normal")style = [{
                    featureType: "road.highway",
                    elementType: "geometry",
                    stylers: [{hue: "#ff0022"}, {saturation: 60}, {lightness: -20}]
                }];
                if (name == "style_midnight")style = [{
                    "featureType": "all",
                    "elementType": "labels.text.fill",
                    "stylers": [{"saturation": 36}, {"color": "#000000"},
                        {"lightness": 40}]
                }, {
                    "featureType": "all",
                    "elementType": "labels.text.stroke",
                    "stylers": [{"visibility": "on"}, {"color": "#000000"}, {"lightness": 16}]
                }, {
                    "featureType": "all",
                    "elementType": "labels.icon",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [{"color": "#000000"}, {"lightness": 20}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#000000"}, {"lightness": 17}, {"weight": 1.2}]
                }, {
                    "featureType": "administrative.country",
                    "elementType": "labels", "stylers": [{"visibility": "on"}, {"lightness": "0"}]
                }, {
                    "featureType": "administrative.country",
                    "elementType": "labels.text.fill",
                    "stylers": [{"visibility": "on"}, {"lightness": "13"}]
                }, {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [{"color": "#000000"}, {"lightness": 20}]
                }, {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{"color": "#000000"}, {"lightness": 21}]
                }, {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [{"visibility": "on"}, {"saturation": "-100"}, {"lightness": "-20"},
                        {"invert_lightness": !0}]
                }, {
                    "featureType": "road",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#bebebe"}]
                }, {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [{"visibility": "on"}, {"lightness": "-47"}]
                }, {
                    "featureType": "road",
                    "elementType": "labels.text.stroke",
                    "stylers": [{"lightness": "-33"}, {"weight": "0.52"}]
                }, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "on"}]}, {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}, {"color": "#b5b5b5"},
                        {"saturation": "-1"}, {"gamma": "0.00"}, {"weight": "2.22"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{"lightness": "0"}, {"visibility": "on"}, {"weight": "2.8"}, {"color": "#585858"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#909090"}, {"lightness": "2"}, {"weight": "0.2"}, {"visibility": "off"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "labels.text.fill",
                    "stylers": [{"lightness": "16"}, {"color": "#595959"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "labels.text.stroke", "stylers": [{"lightness": "-63"}, {"weight": "1"}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{"color": "#000000"}, {"lightness": 18}, {"visibility": "on"}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "geometry.fill",
                    "stylers": [{"visibility": "on"}, {"lightness": "10"}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "labels.text.fill",
                    "stylers": [{"visibility": "on"}, {"lightness": "28"}]
                }, {
                    "featureType": "road.arterial", "elementType": "labels.text.stroke",
                    "stylers": [{"visibility": "on"}, {"weight": "0.1"}, {"lightness": "-96"}]
                }, {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{"color": "#000000"}, {"lightness": 16}]
                }, {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [{"color": "#000000"}, {"lightness": 19}]
                }, {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{"color": "#12161a"}, {"lightness": 17}]
                }];
                if (name == "style_family_fest")style = [{
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [{"color": "#444444"}]
                },
                    {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [{"color": "#f2f2f2"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "geometry.fill",
                        "stylers": [{"visibility": "on"}, {"saturation": "-6"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "geometry.stroke",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "labels",
                        "stylers": [{"visibility": "on"}, {"weight": "1.30"}]
                    }, {"featureType": "poi", "elementType": "labels.text", "stylers": [{"visibility": "on"}]},
                    {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "labels.icon",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [{"saturation": -100}, {"lightness": 45}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "road.arterial",
                        "elementType": "labels.icon",
                        "stylers": [{"visibility": "off"}]
                    }, {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"}]},
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [{"color": "#52978e"}, {"visibility": "on"}]
                    }];
                if (name == "style_open_dark")style = [{
                    "featureType": "all",
                    "elementType": "labels.text.fill",
                    "stylers": [{"color": "#ffffff"}]
                }, {
                    "featureType": "all",
                    "elementType": "labels.text.stroke",
                    "stylers": [{"visibility": "on"}, {"color": "#3e606f"}, {"weight": 2}, {"gamma": .84}]
                }, {
                    "featureType": "all",
                    "elementType": "labels.icon",
                    "stylers": [{"visibility": "off"}]
                }, {"featureType": "administrative", "elementType": "all", "stylers": [{"visibility": "on"}]},
                    {
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [{"weight": .6}, {"color": "#1a3541"}]
                    }, {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [{"visibility": "on"}, {"color": "#293c4d"}]
                    }, {
                        "featureType": "landscape",
                        "elementType": "geometry",
                        "stylers": [{"color": "#2c5a71"}]
                    }, {
                        "featureType": "landscape",
                        "elementType": "geometry.fill",
                        "stylers": [{"color": "#293c4d"}]
                    }, {"featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#406d80"}]}, {
                        "featureType": "poi.park", "elementType": "geometry",
                        "stylers": [{"color": "#2c5a71"}]
                    }, {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [{"color": "#1f3035"}, {"lightness": -37}]
                    }, {
                        "featureType": "road",
                        "elementType": "labels",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "transit",
                        "elementType": "geometry",
                        "stylers": [{"color": "#406d80"}]
                    }, {"featureType": "transit", "elementType": "labels.icon", "stylers": [{"hue": "#00d1ff"}]},
                    {"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#193341"}]}];
                if (name == "style_riverside")style = [{
                    "featureType": "administrative",
                    "elementType": "all",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "administrative",
                    "elementType": "labels",
                    "stylers": [{"visibility": "on"}, {"color": "#716464"}, {"weight": "0.01"}]
                }, {
                    "featureType": "administrative.country",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}]
                },
                    {
                        "featureType": "administrative.country",
                        "elementType": "labels",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "administrative.country",
                        "elementType": "labels.text",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "landscape.natural",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "landscape.natural.landcover",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "all", "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "geometry.fill",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "geometry.stroke",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "labels.text",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "labels.text.stroke",
                        "stylers": [{"visibility": "simplified"}]
                    },
                    {
                        "featureType": "poi.attraction",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "poi.business",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "poi.business",
                        "elementType": "geometry.fill",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "poi.government",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "off"}]
                    }, {"featureType": "poi.park", "elementType": "geometry", "stylers": [{"visibility": "off"}]}, {
                        "featureType": "poi.school", "elementType": "geometry",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [{"visibility": "on"}, {"color": "#787878"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [{"visibility": "simplified"}, {"color": "#a05519"},
                            {"saturation": "-13"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "labels.text",
                        "stylers": [{"color": "#fcfcfc"}, {"visibility": "on"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [{"color": "#636363"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "labels.text.stroke",
                        "stylers": [{"weight": "4.27"}, {"color": "#ffffff"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "labels.icon",
                        "stylers": [{"visibility": "on"}, {"weight": "0.01"}]
                    }, {
                        "featureType": "road.local", "elementType": "all",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "transit",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "simplified"}]
                    }, {
                        "featureType": "transit.station",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [{"visibility": "simplified"}, {"color": "#84afa3"}, {"lightness": 52}]
                    }, {"featureType": "water", "elementType": "geometry", "stylers": [{"visibility": "on"}]},
                    {
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [{"visibility": "on"}, {"color": "#7ca0a4"}]
                    }, {"featureType": "water", "elementType": "labels.text.fill", "stylers": [{"color": "#ffffff"}]}];
                if (name == "style_ozan")style = [{
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [{"visibility": "on"}, {"weight": 1}, {"color": "#003867"}]
                }, {
                    "featureType": "administrative",
                    "elementType": "labels.text.stroke",
                    "stylers": [{"visibility": "on"}, {"weight": 8}]
                }, {
                    "featureType": "road.highway", "elementType": "geometry",
                    "stylers": [{"visibility": "on"}, {"color": "#E1001A"}, {"weight": .4}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}, {"color": "#edeff1"}, {"weight": .2}]
                }, {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}, {"color": "#edeff1"}, {"weight": .4}]
                }];
                my_div_map.attr("data-circle-color", "transparent");
                var map_g = my_div_map.gmap3("get");
                var map_center = map_g.getCenter();
                var map_zoom = map_g.getZoom();
                init_list_map(my_div_map, "", map_center, map_zoom,
                    style);
                map_g.panTo(map_center);
                map_g.setZoom(map_zoom);
                $(".st_list_map_new .map-view").removeClass("view");
                $(".st-map-type").hide()
            });
            init_list_map(my_div_map, data_show, location_center, zoom, type_map);

            $('.location_tab  ul li a[data-toggle="tab"]').on("click", function () {
                setTimeout(function () {
                    if($('#list_map_new iframe' ).length) {
                        var iframe = $('#list_map_new iframe').get(0);
                        iframe.src = iframe.src;
                    }
                }, 1000);
            });
            function init_list_map(div_map, data_map, map_center, data_zoom, style_map) {
                var map = div_map;
                var bounds = new google.maps.LatLngBounds;
                var markers = [];
                data_zoom = parseInt(data_zoom);
                var options = {
                    map: {
                        options: {
                            center: location_center,
                            zoom: data_zoom,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            styles: style_map,
                            navigationControl: !0,
                            scrollwheel: !1,
                            streetViewControl: !0,
                            scaleControl: !0,
                            mapTypeControl: !0,
                            mapTypeControlOptions: {
                                style: google.maps.MapTypeControlStyle.DEFAULT,
                                mapTypeIds: [google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.TERRAIN]
                            },
                            disableDefaultUI: !0,
                            zoomControl: !1,
                            zoomControlOptions: {style: google.maps.ZoomControlStyle.SMALL}
                        }, events: {
                            zoom_changed: function (map) {
                                $(this).attr("data-zoom", map.getZoom())
                            }, tilesloaded: function (map) {
                                var is_check_room = $(this).attr("data-check-zoom");
                                var tmp_zoom = map.getZoom();
                                if (tmp_zoom > data_zoom && is_check_room == "true")map.setZoom(data_zoom);
                                $(this).attr("data-check-zoom", "false");
                                jQuery("#st-gmap-loading").fadeOut(700);
                                jQuery(".st-gmap-loading-bg").fadeOut(700)
                            }
                        }
                    },
                    circle: {
                        options: {
                            center: location_center,
                            radius: range * 1E3,
                            fillColor: map.attr("data-circle-color"),
                            strokeColor: "transparent"
                        }
                    }
                };
                var $container = $(window).width();
                if ($container < 520) {
                    options.map.options.draggable = !1
                }
                map.gmap3(options);
                var gmap_object = map.gmap3("get");
                for (var key in data_map) {
                    var tmp_data = data_map[key];
                    var myLatLng = new google.maps.LatLng(tmp_data.lat, tmp_data.lng);
                    bounds.extend(myLatLng);
                    var marker = ST_addMarker(myLatLng, gmap_object, tmp_data, map);
                    markers.push(marker)
                }
                var mcOptions = {
                    styles: [{height: 53, url: st_list_map_params.cluster_m1, width: 53}, {
                        height: 56,
                        url: st_list_map_params.cluster_m2,
                        width: 56
                    }, {height: 66, url: st_list_map_params.cluster_m3, width: 66}, {
                        height: 78,
                        url: st_list_map_params.cluster_m4,
                        width: 78
                    }, {
                        height: 90, url: st_list_map_params.cluster_m5,
                        width: 90
                    }]
                };
                var mc = new MarkerClusterer(gmap_object, markers, mcOptions);
                var gmap_object = map.gmap3("get");
                gmap_object.fitBounds(bounds);
                function ST_addMarker(location, gmap_object, tmp_data, map) {
                    var marker = new google.maps.Marker({
                        position: location,
                        options: {icon: tmp_data.icon_mk, animation: google.maps.Animation.DROP},
                        tag: "st_tag_" + tmp_data.id,
                        data: tmp_data
                    });
                    marker.addListener("click", function () {
                        gmap_object.panTo(location);
                        map.gmap3({clear: "overlay"}, {
                            overlay: {
                                pane: "floatPane", latLng: location, options: {
                                    content: tmp_data.content_html,
                                    offset: {x: 20, y: -210}
                                }
                            }
                        });
                        setTimeout(function () {
                            $(map).find(".st-popup-gallery").each(function () {
                                $(this).magnificPopup({delegate: ".st-gp-item", type: "image", gallery: {enabled: !0}})
                            })
                        }, 200)
                    });
                    return marker
                }
            }
        })
    }
});
jQuery(function ($) {
    if ($(".st_list_half_map_before").length > 0) {
        var map_full_height = parseInt($(window).height());
        if ($("#st_header_wrap").length)map_full_height -= $("#st_header_wrap").outerHeight(!0);
        if ($("body>.global-wrap.container").length)map_full_height -= parseInt($("body>.global-wrap.container").css("margin-bottom").replace("px", ""));
        if ($("#main-footer").length) {
            map_full_height -= $("#main-footer").outerHeight();
            $("#main-footer").addClass("mt0")
        }
        if ($("#wpadminbar").length)map_full_height -= $("#wpadminbar").outerHeight(!0);
        if (map_full_height < 500)map_full_height = 480;
        var map_height = $(".st_list_half_map_before").data("map_height");
        if (map_height == "map_full_height")map_height = map_full_height;
        $(".div_half_map, .half_map_container .st_gmap , .st_list_half_map , .content_map ,#list_half_map").height(map_height)
    }
});
jQuery(document).ready(function ($) {
    if ($(".st_list_half_map_data").length > 0)jQuery(function ($) {
        var me = $(".st_list_half_map_data");
        var auto_height = me.data("auto_height");
        var height = me.data("height");
        var data_show = me.data("data_map");
        var style_map = me.data("style_map");
        var map_zoom = me.data("zoom");
        var location_center = me.data("location_center");
        var fit_bounds = me.data("fit_bounds");
        var map_full_height = parseInt($(window).height());
        if ($("#st_header_wrap").length)map_full_height -= $("#st_header_wrap").outerHeight(!0);
        if ($("#main-footer").length) {
            map_full_height -= $("#main-footer").outerHeight();
            $("#main-footer").addClass("mt0")
        }
        if ($("#wpadminbar").length)map_full_height -= $("#wpadminbar").outerHeight(!0);
        var map_height = map_full_height;
        if (auto_height == "fixed")var map_height = height;
        var my_div_map = jQuery("#list_half_map");
        var hotel_search_half_map = $("#hotel_search_half_map");
        $("#hotel_search_half_map .btn_search").click(function () {
            var $this = $(this);
            var options = {
                url: st_params.ajax_url, dataType: "json", beforeSend: function () {
                    jQuery("#st-gmap-loading").show();
                    jQuery(".st-gmap-loading-bg").show();
                    $this.html(st_params.text_loading);
                    $(".data_list_hafl_map").css("opacity", "0.5");
                    $(".data_list_hafl_map").trigger("st_load_halfmap")
                }, success: function (data) {
                    $("#list_half_map").gmap3({action: "destroy"});
                    var container = $("#list_half_map").parent();
                    $("#list_half_map").remove();
                    container.append('<div id="list_half_map"></div>');
                    $("#list_half_map").height(map_height);
                    $("#list_half_map").attr("data-fitbounds", fit_bounds);
                    if (data.location_center == "[0,0]")$("#list_map").attr("data-fitbounds",
                        "on");
                    location_center = [data.map_lat_center, data.map_lng_center];
                    init_list_half_map($("#list_half_map"), data.data_map, location_center, data.zoom, style_map);
                    $(".data_list_hafl_map .content").html("");
                    var count = 0;
                    for (var key in data.data_map) {
                        var tmp_data = data.data_map[key];
                        $(".data_list_hafl_map .content").append('<div class="col-md-6">' + tmp_data.content_adv_html + "</div>");
                        count++
                    }
                    $(".count_advan_saerch").html("(" + count + ")");
                    if (count == 0)$(".data_list_hafl_map .content").append('<div class="alert alert-warning"> <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">\u00d7</span> </button> <p class="text-small">' +
                        st_list_map_params.text_no_result + "</p> </div>");
                    setTimeout(function () {
                        $(".data_list_hafl_map").css("opacity", "1")
                    }, 500);
                    $this.html($this.data("title"));

                }, complete: function () {
                    jQuery("#st-gmap-loading").fadeOut(700);
                    jQuery(".st-gmap-loading-bg").fadeOut(700)
                }
            };
            hotel_search_half_map.ajaxForm(options)
        });
        $(".st_list_half_map .map-view").click(function () {
            if ($(this).hasClass("view")) {
                $(this).removeClass("view");
                $(".st_list_half_map").find(".st-map-type").hide()
            } else {
                $(this).addClass("view");
                $(".st_list_half_map").find(".st-map-type").show()
            }
        });
        $(".st_list_half_map .st-map-type").click(function () {
            var name = $(this).data("name");
            var style = "";
            if (name == "style_normal")style = [{
                featureType: "road.highway",
                elementType: "geometry",
                stylers: [{hue: "#ff0022"}, {saturation: 60}, {lightness: -20}]
            }];
            if (name == "style_midnight")style = [{
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers": [{"saturation": 36}, {"color": "#000000"}, {"lightness": 40}]
            }, {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers": [{"visibility": "on"}, {"color": "#000000"}, {"lightness": 16}]
            },
                {
                    "featureType": "all",
                    "elementType": "labels.icon",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [{"color": "#000000"}, {"lightness": 20}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#000000"}, {"lightness": 17}, {"weight": 1.2}]
                }, {
                    "featureType": "administrative.country",
                    "elementType": "labels",
                    "stylers": [{"visibility": "on"}, {"lightness": "0"}]
                }, {
                    "featureType": "administrative.country", "elementType": "labels.text.fill",
                    "stylers": [{"visibility": "on"}, {"lightness": "13"}]
                }, {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [{"color": "#000000"}, {"lightness": 20}]
                }, {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{"color": "#000000"}, {"lightness": 21}]
                }, {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [{"visibility": "on"}, {"saturation": "-100"}, {"lightness": "-20"}, {"invert_lightness": !0}]
                }, {"featureType": "road", "elementType": "geometry.stroke", "stylers": [{"color": "#bebebe"}]}, {
                    "featureType": "road", "elementType": "labels.text.fill",
                    "stylers": [{"visibility": "on"}, {"lightness": "-47"}]
                }, {
                    "featureType": "road",
                    "elementType": "labels.text.stroke",
                    "stylers": [{"lightness": "-33"}, {"weight": "0.52"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}, {"color": "#b5b5b5"}, {"saturation": "-1"}, {"gamma": "0.00"}, {"weight": "2.22"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{"lightness": "0"}, {"visibility": "on"},
                        {"weight": "2.8"}, {"color": "#585858"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#909090"}, {"lightness": "2"}, {"weight": "0.2"}, {"visibility": "off"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "labels.text.fill",
                    "stylers": [{"lightness": "16"}, {"color": "#595959"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "labels.text.stroke",
                    "stylers": [{"lightness": "-63"}, {"weight": "1"}]
                }, {
                    "featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#000000"},
                        {"lightness": 18}, {"visibility": "on"}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "geometry.fill",
                    "stylers": [{"visibility": "on"}, {"lightness": "10"}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "labels.text.fill",
                    "stylers": [{"visibility": "on"}, {"lightness": "28"}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "labels.text.stroke",
                    "stylers": [{"visibility": "on"}, {"weight": "0.1"}, {"lightness": "-96"}]
                }, {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{"color": "#000000"}, {"lightness": 16}]
                },
                {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [{"color": "#000000"}, {"lightness": 19}]
                }, {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{"color": "#12161a"}, {"lightness": 17}]
                }];
            if (name == "style_family_fest")style = [{
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [{"color": "#444444"}]
            }, {
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [{"color": "#f2f2f2"}]
            }, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]}, {
                "featureType": "poi",
                "elementType": "geometry.fill", "stylers": [{"visibility": "on"}, {"saturation": "-6"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry.stroke",
                "stylers": [{"visibility": "on"}]
            }, {
                "featureType": "poi",
                "elementType": "labels",
                "stylers": [{"visibility": "on"}, {"weight": "1.30"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.text",
                "stylers": [{"visibility": "on"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.text.fill",
                "stylers": [{"visibility": "on"}]
            }, {"featureType": "poi", "elementType": "labels.icon", "stylers": [{"visibility": "on"}]},
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [{"saturation": -100}, {"lightness": 45}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [{"color": "#52978e"}, {"visibility": "on"}]
                }];
            if (name == "style_open_dark")style = [{
                "featureType": "all",
                "elementType": "labels.text.fill", "stylers": [{"color": "#ffffff"}]
            }, {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers": [{"visibility": "on"}, {"color": "#3e606f"}, {"weight": 2}, {"gamma": .84}]
            }, {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "administrative",
                "elementType": "all",
                "stylers": [{"visibility": "on"}]
            }, {
                "featureType": "administrative",
                "elementType": "geometry",
                "stylers": [{"weight": .6}, {"color": "#1a3541"}]
            }, {
                "featureType": "landscape",
                "elementType": "all", "stylers": [{"visibility": "on"}, {"color": "#293c4d"}]
            }, {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [{"color": "#2c5a71"}]
            }, {
                "featureType": "landscape",
                "elementType": "geometry.fill",
                "stylers": [{"color": "#293c4d"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [{"color": "#406d80"}]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers": [{"color": "#2c5a71"}]
            }, {"featureType": "road", "elementType": "all", "stylers": [{"visibility": "on"}]}, {
                "featureType": "road",
                "elementType": "geometry", "stylers": [{"color": "#1f3035"}, {"lightness": -37}]
            }, {
                "featureType": "road",
                "elementType": "labels",
                "stylers": [{"visibility": "on"}]
            }, {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [{"visibility": "on"}]
            }, {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [{"color": "#406d80"}]
            }, {
                "featureType": "transit",
                "elementType": "labels.icon",
                "stylers": [{"hue": "#00d1ff"}]
            }, {"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#193341"}]}];
            if (name == "style_riverside")style =
                [{
                    "featureType": "administrative",
                    "elementType": "all",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "administrative",
                    "elementType": "labels",
                    "stylers": [{"visibility": "on"}, {"color": "#716464"}, {"weight": "0.01"}]
                }, {
                    "featureType": "administrative.country",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "administrative.country",
                    "elementType": "labels",
                    "stylers": [{"visibility": "on"}]
                },
                    {
                        "featureType": "administrative.country",
                        "elementType": "labels.text",
                        "stylers": [{"visibility": "off"}]
                    }, {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "landscape.natural",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "landscape.natural.landcover",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "simplified"}]
                }, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "simplified"}]}, {
                    "featureType": "poi",
                    "elementType": "geometry.fill", "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "poi",
                    "elementType": "geometry.stroke",
                    "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "poi",
                    "elementType": "labels.text",
                    "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "poi",
                    "elementType": "labels.text.fill",
                    "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "poi",
                    "elementType": "labels.text.stroke",
                    "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "poi.attraction", "elementType": "geometry",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "poi.business",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "poi.business",
                    "elementType": "geometry.fill",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "poi.government",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "off"}]
                }, {"featureType": "poi.school", "elementType": "geometry", "stylers": [{"visibility": "off"}]}, {
                    "featureType": "road",
                    "elementType": "all", "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{"visibility": "on"}, {"color": "#787878"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{"visibility": "simplified"}, {"color": "#a05519"}, {"saturation": "-13"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "labels.text", "stylers": [{"color": "#fcfcfc"}, {"visibility": "on"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "labels.text.fill",
                    "stylers": [{"color": "#636363"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "labels.text.stroke",
                    "stylers": [{"weight": "4.27"}, {"color": "#ffffff"}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "labels.icon",
                    "stylers": [{"visibility": "on"}, {"weight": "0.01"}]
                }, {"featureType": "road.local", "elementType": "all", "stylers": [{"visibility": "on"}]}, {
                    "featureType": "transit",
                    "elementType": "all", "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "transit.station",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}]
                }, {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [{"visibility": "simplified"}, {"color": "#84afa3"}, {"lightness": 52}]
                }, {"featureType": "water", "elementType": "geometry", "stylers": [{"visibility": "on"}]}, {
                    "featureType": "water", "elementType": "geometry.fill", "stylers": [{"visibility": "on"},
                        {"color": "#7ca0a4"}]
                }, {"featureType": "water", "elementType": "labels.text.fill", "stylers": [{"color": "#ffffff"}]}];
            if (name == "style_ozan")style = [{
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [{"visibility": "on"}, {"weight": 1}, {"color": "#003867"}]
            }, {
                "featureType": "administrative",
                "elementType": "labels.text.stroke",
                "stylers": [{"visibility": "on"}, {"weight": 8}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers": [{"visibility": "on"}, {"color": "#E1001A"}, {"weight": .4}]
            },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}, {"color": "#edeff1"}, {"weight": .2}]
                }, {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{"visibility": "on"}, {"color": "#edeff1"}, {"weight": .4}]
                }];
            init_list_half_map(my_div_map, "", location_center, map_zoom, style);
            $(".st_list_half_map .map-view").removeClass("view");
            $(".st-map-type").hide()
        });
        init_list_half_map($("#list_half_map"), data_show, location_center, map_zoom, style_map);
        function init_list_half_map(div_map,
                                    data_map, map_center, data_zoom, style) {
            var map = div_map;
            var list = [];
            var markers = [];
            data_zoom = parseInt(data_zoom);
            var bounds = new google.maps.LatLngBounds;
            var options = {
                map: {
                    options: {
                        center: map_center,
                        zoom: data_zoom,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        styles: style,
                        disableDefaultUI: !0,
                        zoomControl: !1,
                        navigationControl: !0,
                        scrollwheel: !1,
                        streetViewControl: !0,
                        scaleControl: !0,
                        mapTypeControl: !0
                    }, events: {
                        zoom_changed: function (map) {
                            $(this).attr("data-zoom", map.getZoom())
                        }, tilesloaded: function (map) {
                            jQuery("#st-gmap-loading").fadeOut(700);
                            jQuery(".st-gmap-loading-bg").fadeOut(700)
                        }
                    }
                }, marker: {
                    values: list, events: {
                        mouseover: function (marker, event, context) {
                        }, mouseout: function (marker, event, context) {
                        }, click: function (marker, event, context) {
                            var zoom = parseInt(map.attr("data-zoom"));
                            if (!zoom)zoom = data_zoom;
                            var map_g = $(this).gmap3("get");
                            map_g.panTo(marker.getPosition());
                            $(this).gmap3({clear: "overlay"}, {
                                overlay: {
                                    pane: "floatPane",
                                    latLng: marker.getPosition(),
                                    options: {content: context.data.content_html, offset: {x: 20, y: -210}}
                                }
                            });
                            setTimeout(function () {
                                $(div_map).find(".st-popup-gallery").each(function () {
                                    $(this).magnificPopup({
                                        delegate: ".st-gp-item",
                                        type: "image", gallery: {enabled: !0}
                                    })
                                })
                            }, 200)
                        }
                    }
                }
            };
            var $container = $(window).width();
            map.gmap3(options);
            var gmap_object = map.gmap3("get");
            for (var key in data_map) {
                var tmp_data = data_map[key];
                var myLatLng = new google.maps.LatLng(tmp_data.lat, tmp_data.lng);
                bounds.extend(myLatLng);
                list.push({
                    latLng: [tmp_data.lat, tmp_data.lng],
                    options: {icon: tmp_data.icon_mk},
                    tag: "st_tag_" + tmp_data.id,
                    data: tmp_data
                });
                var marker = ST_addMarker(myLatLng, gmap_object, tmp_data, map);
                markers.push(marker)
            }
            if (map.data("fitbounds") == "on") {
                var gmap_object = map.gmap3("get");
                gmap_object.fitBounds(bounds)
            }
            var mcOptions = {
                styles: [{height: 53, url: st_list_map_params.cluster_m1, width: 53}, {
                    height: 56,
                    url: st_list_map_params.cluster_m2,
                    width: 56
                }, {height: 66, url: st_list_map_params.cluster_m3, width: 66}, {
                    height: 78,
                    url: st_list_map_params.cluster_m4,
                    width: 78
                }, {height: 90, url: st_list_map_params.cluster_m5, width: 90}]
            };
            var mc = new MarkerClusterer(gmap_object, markers, mcOptions);

            function ST_addMarker(location, gmap_object, tmp_data,
                                  map) {
                var marker = new google.maps.Marker({
                    position: location,
                    options: {icon: tmp_data.icon_mk, animation: google.maps.Animation.DROP},
                    tag: "st_tag_" + tmp_data.id,
                    data: tmp_data
                });
                marker.addListener("click", function () {
                    gmap_object.panTo(location);
                    map.gmap3({clear: "overlay"}, {
                        overlay: {
                            pane: "floatPane",
                            latLng: location,
                            options: {content: tmp_data.content_html, offset: {x: 20, y: -210}}
                        }
                    });
                    setTimeout(function () {
                        $(map).find(".st-popup-gallery").each(function () {
                            $(this).magnificPopup({
                                delegate: ".st-gp-item",
                                type: "image", gallery: {enabled: !0}
                            })
                        })
                    }, 200)
                });
                return marker
            }
        }
    })
});
jQuery(document).ready(function ($) {
    var lat = $(".st-room-map").data("lat");
    var lng = $(".st-room-map").data("lng");
    var zoom = $(".st-room-map").data("zoom");
    var ct = $("#st-room-map-content-wrapper").html();
    $(".st-room-map").css({"width": "100%", "height": "500px"}).gmap3({
        circle: {
            options: {
                center: [lat, lng],
                radius: 200,
                fillColor: "#F3DCB1",
                strokeColor: "#ED8323"
            }, events: {}, callback: function () {
                $(this).gmap3("get").setZoom(15)
            }
        },
        overlay: {latLng: [lat, lng], options: {content: ct, offset: {y: -120, x: -320}}},
        map: {options: {scrollwheel: !1}}
    })
});
jQuery(document).ready(function ($) {
    if ($("#car_show_info_distance").length > 0) {
        var origin_lat = $("#car_show_info_distance").data("origin-lat");
        var origin_lng = $("#car_show_info_distance").data("origin-lng");
        var destination_lat = $("#car_show_info_distance").data("destination-lat");
        var destination_lng = $("#car_show_info_distance").data("destination-lng");
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById("car_show_info_distance"), {mapTypeId: google.maps.MapTypeId.ROADMAP});
        directionsDisplay.setMap(map);
        directionsService.route({
            origin: {lat: origin_lat, lng: origin_lng},
            destination: {lat: destination_lat, lng: destination_lng},
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        }, function (response, status) {
            if (status === google.maps.DirectionsStatus.OK)directionsDisplay.setDirections(response); else window.alert("Directions request failed due to " +
                status)
        })
    }
});