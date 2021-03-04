jQuery(document).ready(function($) {
    var bt_ot_gmap_input_lat=$('.st-field-map input#st-map-lat');
    var bt_ot_gmap_input_lng=$('.st-field-map input#st-map-lng');
    var bt_ot_gmap_input_zoom=$('.st-field-map input#st-map-zoom');

    $('.st-field-address_autocomplete .st-partner-field').each(function(index, el) {
        var gmap_el = $('.st-field-map .st-map-box');

        var input = $(this).get(0);
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function() {
            var gmap_obj=gmap_el.gmap3('get');

            current_marker=new google.maps.Marker({
                position:new google.maps.LatLng(bt_ot_gmap_input_lat.val(),bt_ot_gmap_input_lng.val()),
                map:gmap_obj
            });

            var map_type = "roadmap";
            var current_marker;

            gmap_obj.setMapTypeId( map_type );

            var places = autocomplete.getPlace();
            if (places.length == 0) {
                return;
            }

            // For each place, get the icon, place name, and location.
            var bounds = new google.maps.LatLngBounds();

            bounds.extend(places.geometry.location);

            current_marker.setPosition(places.geometry.location);
            bt_ot_gmap_input_lat.val(places.geometry.location.lat());
            bt_ot_gmap_input_lng.val(places.geometry.location.lng());
            bt_ot_gmap_input_zoom.val(gmap_obj.getZoom());

            gmap_obj.fitBounds(bounds);
        });

    }); 
});