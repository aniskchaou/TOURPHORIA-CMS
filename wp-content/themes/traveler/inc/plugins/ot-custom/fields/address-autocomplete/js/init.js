jQuery(document).ready(function($) {
    var bt_ot_gmap_st_street_number = $('#bt_ot_gmap_st_street_number');
    var bt_ot_gmap_st_locality = $('#bt_ot_gmap_st_locality');
    var bt_ot_gmap_st_route = $('#bt_ot_gmap_st_route');
    var bt_ot_gmap_st_sublocality_level_1 = $('#bt_ot_gmap_st_sublocality_level_1');
    var bt_ot_gmap_st_administrative_area_level_2 = $('#bt_ot_gmap_st_administrative_area_level_2');
    var bt_ot_gmap_st_administrative_area_level_1 = $('#bt_ot_gmap_st_administrative_area_level_1');
    var bt_ot_gmap_st_country = $('#bt_ot_gmap_st_country');

    var bt_ot_gmap_input_lat=$('input.bt_ot_gmap_input_lat');
    var bt_ot_gmap_input_lng=$('input.bt_ot_gmap_input_lng');

    $('.bt_ot_address_autocomplete').each(function(index, el) {

        var input = $(this).get(0);
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function() {
            var places = autocomplete.getPlace();
            if (places.length == 0) {
                return;
            }
            bt_ot_gmap_input_lat.val(places.geometry.location.lat());
            bt_ot_gmap_input_lng.val(places.geometry.location.lng());
            
            bt_ot_gmap_st_street_number.val('');
            bt_ot_gmap_st_locality.val('');
            bt_ot_gmap_st_route.val('');
            bt_ot_gmap_st_sublocality_level_1.val('');
            bt_ot_gmap_st_administrative_area_level_2.val('');
            bt_ot_gmap_st_administrative_area_level_1.val('');
            bt_ot_gmap_st_country.val('');
            $.each(places.address_components, function(index, names) {
                if($.inArray('street_number', names.types) != -1){
                    bt_ot_gmap_st_street_number.val(names.long_name);
                }
                if($.inArray('locality', names.types) != -1){
                    bt_ot_gmap_st_locality.val(names.long_name);
                }
                if($.inArray('route', names.types) != -1){
                    bt_ot_gmap_st_route.val(names.long_name);
                }
                if($.inArray('sublocality_level_1', names.types) != -1){
                    bt_ot_gmap_st_sublocality_level_1.val(names.long_name);
                }
                if($.inArray('administrative_area_level_2', names.types) != -1){
                    bt_ot_gmap_st_administrative_area_level_2.val(names.long_name);
                }
                if($.inArray('administrative_area_level_1', names.types) != -1){
                    bt_ot_gmap_st_administrative_area_level_1.val(names.long_name);
                }
                if($.inArray('country', names.types) != -1){
                    bt_ot_gmap_st_country.val(names.long_name);
                }
            });
        });

    }); 
});