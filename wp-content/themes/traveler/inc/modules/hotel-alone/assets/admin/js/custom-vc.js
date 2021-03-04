/**
 * Created by PA25072016 on 3/14/2017.
 */

(function($){

    'use strict';

    $(document).ready(function(){
        $('.vc_ui-button-fw').on('click', function() {
            if($('.destinations-body').length >0) {
                var value = $('.destinations-body').find('.helios-des-save').serialize();
                $('.helios-destination-value').val( encodeURIComponent(value) );
            }
            if($('.st-custom-location-map').length > 0){
                var value = $('.st-custom-location-map').find('.helios-map-save').serialize();
                $('.helios-google-map-value').val( encodeURIComponent(value) );
            }
        });
        $('.destinations-body').each(function(){
            var frame;
            var p = $(this);
            //Upload Image Background
            $('.helios-upload', this).on('click', function(e){

                e.preventDefault();
                if ( frame ) {
                    frame.open();
                    return;
                }

                // Create a new media frame
                frame = wp.media({
                    title: 'Select or Upload Media for background',
                    button: {
                        text: 'Use this media'
                    },
                    multiple: false  // Set to true to allow multiple files to be selected
                });

                // When an image is selected in the media frame...
                frame.on( 'select', function() {

                    // Get media attachment details from the frame state
                    var attachment = frame.state().get('selection').first().toJSON();

                    p.find('.destinations-content').css({background: 'url('+attachment.url+')'});
                    p.find('.des-background').attr('value',attachment.id);

                });

                // Finally, open the modal on click
                frame.open();
            });

            // Add destination
            var index = $('.destinations-content .marker', this).length;


            $('.add-destination', this).on('click', function (e) {
                e.preventDefault();

                var param_name = $(this).data('param_name');
                var template = wp.template('destination-marker');

                var tax = p.find('#taxonomy_dropdown_destination option:selected').val();
                var size = p.find('.location-marker-size option:selected').val();
                var tax_name = p.find('#taxonomy_dropdown_destination option:selected').text();

                $('.destinations-content').append(template({param_name: param_name, index: index, tax: tax, tax_name: tax_name,size: size}));

                // Drag destination
                $('.marker').draggable({
                    containment: '.destinations-content',
                    cursor: "move",
                    stop: function (even, ui) {
                        var w_wrapper = $(".destinations-content").width();
                        var h_wrapper = $(".destinations-content").height();
                        var pos_top = ui.position.top;
                        var pos_left= ui.position.left;
                        var top = (parseFloat(pos_top) + 15)/parseFloat(h_wrapper)*100;
                        var left = (parseFloat(pos_left))/parseFloat(w_wrapper)*100;
                        $(this).find('.location-top').val(top);
                        $(this).find('.location-left').val(left);
                    }
                });

                index++;
            });

            // Drag destination
            $('.marker', this).draggable({
                containment: '.destinations-content',
                cursor: "move",
                stop: function (even, ui) {
                    var w_wrapper = $(".destinations-content").width();
                    var h_wrapper = $(".destinations-content").height();
                    var pos_top = ui.position.top;
                    var pos_left= ui.position.left;
                    var top = (parseFloat(pos_top) + 15)/parseFloat(h_wrapper)*100;
                    var left = parseFloat(pos_left)/parseFloat(w_wrapper)*100;
                    $(this).find('.location-top').val(top);
                    $(this).find('.location-left').val(left);
                }
            });

            $("body").on('click', '.marker .marker-close', function(e){
                e.preventDefault();
                $(this).parent('.marker').slideDown(200, function() {
                    $(this).remove();
                });
            });
        });

        $('.st-dropdown-image').on('change', function(){
            var img = '';
            var p = $(this).closest('.st-dropdown-image-body');
            $( ".st-dropdown-image option:selected" ).each(function() {
                img = $(this).data('image');
            });
            p.find('.show-demo').empty().append('<img src="'+ img +'" alt="image demo"/>')
        });

        $('.st_vc_list_image .item').on('click', function() {
            $(this).closest('.st_vc_list_image').find('.item').removeClass('active');
            $(this).addClass('active');
            $(this).find('.radio_item').prop("checked", true);
            var $value = $(this).find('.radio_item').val();
            $(this).closest('.st_vc_list_image').find('.radio_item_value').val($value);
            $(".radio_item_value").trigger("change");
        });

        $( ".st_vc_list_image .item" ).hover(
            function() {
                $( ".vc_ui-panel-window.vc_active " ).find('.st_vc_list_image_content').remove();
                var img = $(this).data('image');
                var w = $(this).data('w');
                $( ".vc_ui-panel-window.vc_active " ).append('<div class="st_vc_list_image_content '+w+'"><img src="'+img+'"></div>');
            }, function() {
                $( ".vc_ui-panel-window.vc_active " ).find('.st_vc_list_image_content').remove();
            }
        );

        //google map
        if(typeof google === 'object') {

            if( $('.st_location_map').length ){
                $('.st_location_map').each(function(index, el) {
                    var t = $(this);
                    var gmap = $('.gmap-content', t);
                    var map_lat = parseFloat( $('input[name="map_lat"]', t).val() );
                    var map_long = parseFloat( $('input[name="map_long"]', t).val() );
                    var map_zoom = parseInt( $('input[name="map_zoom"]', t).val() );
                    var bt_ot_searchbox = $('input.gmap-search', t);
                    var map_options={
                        options:{
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            mapTypeControl: true,
                            mapTypeControlOptions: {
                                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                            },
                            navigationControl: true,
                            scrollwheel: true
                        }
                    };
                    if(map_zoom){
                        map_options.options.zoom=map_zoom;
                    }
                    var obj = {
                        map:map_options
                    };
                    if(map_lat && map_long){

                        obj.map.options.center=[map_lat, map_long];
                        obj.marker={
                            values:[ [map_lat, map_long] ],
                            options:{
                                draggable: false
                            }
                        };
                    }
                    gmap.gmap3(obj);
                    var gmap_obj = gmap.gmap3('get');
                    // Map Click
                    gmap_obj.addListener('click', function(e) {

                        $('input[name="map_lat"]', t).val( e.latLng.lat() );
                        $('input[name="map_long"]', t).val( e.latLng.lng() );

                        gmap.gmap3({
                            clear: {
                                name:["marker"],
                                last: true
                            }
                        });
                        gmap.gmap3({
                            marker:{
                                values:[
                                    {latLng:e.latLng }
                                ],
                                options:{
                                    draggable: false
                                }
                            }
                        });
                    });
                    if( bt_ot_searchbox.length ){
                        var searchBox = new google.maps.places.SearchBox( bt_ot_searchbox[0] );
                        google.maps.event.addListener(searchBox, 'places_changed', function() {
                            var places = searchBox.getPlaces();
                            if (places.length == 0) {
                                return;
                            }
                            // For each place, get the icon, place name, and location.
                            var bounds = new google.maps.LatLngBounds();
                            for (var i = 0, place; place = places[i]; i++) {

                                bounds.extend(place.geometry.location);

                                if(i == 0){

                                    gmap.gmap3({
                                        clear: {
                                            name:["marker"],
                                            last: true
                                        }
                                    });
                                    gmap.gmap3({
                                        marker:{
                                            values:[
                                                {latLng: place.geometry.location }
                                            ],
                                            options:{
                                                draggable: false
                                            }
                                        }
                                    });

                                    $('input[name="map_lat"]', t).val( place.geometry.location.lat() );
                                    $('input[name="map_long"]', t).val( place.geometry.location.lng() );
                                    $('input[name="map_zoom"]', t).val( gmap_obj.getZoom() );

                                }
                            }
                            gmap_obj.fitBounds(bounds);
                        });
                    }
                    bt_ot_searchbox.keypress(function(e){
                        if(e.which  == 13)
                        {
                            return false; // returning false will prevent the event from bubbling up.
                        }
                    });
                    google.maps.event.addListener(gmap_obj, "zoom_changed", function(event) {
                        $('input[name="map_zoom"]', t).val( gmap_obj.getZoom() );
                    });
                    $(window).resize(function(){
                        google.maps.event.trigger(gmap_obj, 'resize');
                    });
                });
            }
        }

        //Show Image
        $('.st-image-show').each(function () {
            if($(this).closest('.vc_ui-panel-window-inner').length > 0){
                var t = $(this);
                var el = $(this).data('element');
                var param_name = $(this).data('param_name');
                var img_url = $(this).data('img_url');
                $('select.'+el).closest('.wpb_el_type_dropdown').addClass('has-show-image');
                $('.wpb_el_type_dropdown select.'+el).change(function() {
                    var selected = $(this).find('option:selected').val();
                    var link = img_url + param_name+'/'+selected+'.jpg';
                    t.find('img').attr('src',link);
                });
            }
        });
    });
})(jQuery);