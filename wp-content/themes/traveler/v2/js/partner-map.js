/**
 * Created by me664 on 1/20/15.
 */
jQuery(document).ready(function($){
    $('.st-field-map').each(function(){
        var self=$(this);
        var gmap_el=$(this).find('.st-map-box');
        var bt_ot_gmap_input_zoom=$(this).find('#st-map-zoom');
        var bt_ot_gmap_input_lat=$(this).find('#st-map-lat');
        var bt_ot_gmap_input_lng=$(this).find('#st-map-lng');
        var bt_ot_gmap_input_type=$(this).find('#st-map-style');

        var bt_ot_searchbox=$(this).find('.bt_ot_searchbox');
        var gmap_obj;
        var current_marker,old_lat=37,old_lng=2,old_zoom=13;
        var    markers=[];

        if(bt_ot_gmap_input_lat.val()){
            old_lat=bt_ot_gmap_input_lat.val();
            old_lat=parseFloat(old_lat);
        }
        if(bt_ot_gmap_input_lng.val()){
            old_lng=bt_ot_gmap_input_lng.val();
            old_lng=parseFloat(old_lng);
        }
        if(bt_ot_gmap_input_zoom.val()){
            old_zoom=bt_ot_gmap_input_zoom.val();
            old_zoom=parseFloat(old_zoom);
        }

        gmap_el.gmap3({
            map:{
                options:{
                    center:[old_lat, old_lng],
                    zoom:old_zoom,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                    },
                    navigationControl: true,
                    scrollwheel: true,
                    streetViewControl: true
                },
                events:{
                    click: function(map){
                    }
                }
            }
        });


        $('body').on('change', 'select[name="level_location"]', function(event) {
            gmap_el.gmap3('destroy');
            setTimeout(function(){
                gmap_el.gmap3({
                map:{
                    options:{
                        center:[old_lat, old_lng],
                        zoom:old_zoom,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        mapTypeControl: true,
                        mapTypeControlOptions: {
                            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                        },
                        navigationControl: true,
                        scrollwheel: true,
                        streetViewControl: true
                    },
                    events:{
                        click: function(map){
                        }
                    }
                }
            }, 500);

        });
            event.preventDefault();
        });


        gmap_obj=gmap_el.gmap3('get');
        var geocoder = new google.maps.Geocoder;

        var map_type = "roadmap";
        if(bt_ot_gmap_input_type.val() != ""){
            map_type = bt_ot_gmap_input_type.val();
        }
        gmap_obj.setMapTypeId( map_type );

        if(bt_ot_searchbox.length){

            //gmap_obj.controls[google.maps.ControlPosition.TOP_LEFT].push(bt_ot_searchbox[0]);
            var searchBox = new google.maps.places.SearchBox((bt_ot_searchbox[0]));

            google.maps.event.addListener(searchBox, 'places_changed', function() {
                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }

                // For each place, get the icon, place name, and location.
                var bounds = new google.maps.LatLngBounds();
                for (var i = 0, place; place = places[i]; i++) {

                    bounds.extend(place.geometry.location);

                    if(i==0){
                        current_marker.setPosition(place.geometry.location);
                        bt_ot_gmap_input_lat.val(place.geometry.location.lat());
                        bt_ot_gmap_input_lng.val(place.geometry.location.lng());
                        bt_ot_gmap_input_zoom.val(gmap_obj.getZoom());

                    }
                }
                gmap_obj.fitBounds(bounds);
                /*var listener = google.maps.event.addListener(gmap_obj, "idle", function() {
                  if (gmap_obj.getZoom() > 17) gmap_obj.setZoom(17);
                  google.maps.event.removeListener(listener);
                });*/

            });

        }


        current_marker=new google.maps.Marker({
            position:new google.maps.LatLng(old_lat,old_lng),
            map:gmap_obj
        });

        google.maps.event.addListener(gmap_obj, "click", function(event) {
            console.log(event);

            bt_ot_gmap_input_lat.val(event.latLng.lat());
            bt_ot_gmap_input_lng.val(event.latLng.lng());
            current_marker.setPosition(event.latLng);
            var newMapType = gmap_obj.getMapTypeId();
            bt_ot_gmap_input_type.val(newMapType);
            var z = (bt_ot_gmap_input_zoom.val() == '') ? 13 : bt_ot_gmap_input_zoom.val();

            var geocoder = new google.maps.Geocoder;
            var infowindow = new google.maps.InfoWindow;

            geocodeLatLng(geocoder, gmap_el, infowindow);

        });

        function geocodeLatLng(geocoder, map, infowindow) {
          var latlng = {lat: parseFloat(bt_ot_gmap_input_lat.val()), lng: parseFloat(bt_ot_gmap_input_lng.val())};
          geocoder.geocode({'location': latlng}, function(results, status) {

          });
        }

        google.maps.event.addListener(gmap_obj, "maptypeid_changed", function() {
            var newMapType = gmap_obj.getMapTypeId();
            bt_ot_gmap_input_type.val(newMapType);
        });
        google.maps.event.addListener(gmap_obj, "zoom_changed", function(event) {
            bt_ot_gmap_input_zoom.val(gmap_obj.getZoom());
        });



       $('.bt_ot_gmap_search',$(this)).click(function(){
           var addr=self.find('.bt_ot_gmap_input_addr').val();

           if(addr){

           }
       });

    });

});