/**
 * Created by PA25072016 on 6/8/2017.
 */

jQuery(function($){
   $(document).ready(function(){
       var media_uploader;
       $('body').on('click', '.upload-button', function(event){
           event.preventDefault();
           var parent = $(this).closest('.upload-wrapper');
           media_uploader = wp.media.frames.file_frame = wp.media({
               title: $(this).data( 'uploader_title' ),
               button: {
                   text: $(this).data( 'uploader_button_text' )
               },
               multiple: false
           });
           media_uploader.open();
           select_media( parent );
       });

       $('body').on('click', '.delete-button', function(event){
           event.preventDefault();
           var title = $(this).data('delete-title');
           if(confirm(title)) {
               var parent = $(this).closest('.upload-wrapper');
               parent.find('.save-image-id').val('');
               parent.find('.upload-items').empty();
               $(this).addClass('none');
           }
       });

       function select_media( parent ){
           media_uploader.on("select", function(event){

               var json = media_uploader.state().get("selection").first().toJSON();
               var image_url = json.url;
               if( typeof image_url == 'string' && image_url != ''){
                   console.log(image_url);
                   var html = '<div class="upload-item"> '+
                       '<img src="'+ image_url+'" alt="" class="frontend-image img-responsive">'+
                       '</div>';
                   $('.upload-items',parent).html(html);
                   parent.find('.upload-button').removeClass('no_image');
               }else{
                   $('.upload-items', parent).empty();
               }
               $('.save-image-id', parent).val(json.id);
               $('.delete-button', parent).removeClass('none');
           });
       }


       $('.st-location-airport').select2();

        body = $('body');
        $('.map-field-wrapper', body).each(function () {
            var t = $(this),
                mapCanvas = $('.map-field-content', t).get(0),
                markers = [],
                search = $('.search', t);

            var bounds = new google.maps.LatLngBounds();

            var mapOptions = {
                center: new google.maps.LatLng(51.5, -0.2),
                zoom: 8
            };
            var map = new google.maps.Map(mapCanvas, mapOptions);

            var searchBox = new google.maps.places.SearchBox(search.get(0));

            var lat = parseFloat($('input[name="map_lat"]', t).val());
            var lng = parseFloat($('input[name="map_lng"]', t).val());
            var zoom = parseFloat($('input[name="map_zoom"]', t).val());
            
            if( zoom <= 0){
              zoom = 13;
            }

            setMarker({lat: lat, lng: lng});
            var latlng = new google.maps.LatLng(lat, lng);
            bounds.extend(latlng);
            map.setCenter(latlng);
            map.setZoom(zoom);

            google.maps.event.addListener(searchBox, 'places_changed', function () {

                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }
                var place = places[0];
                setMarker({lat: place.geometry.location.lat(), lng: place.geometry.location.lng()});
                bounds.extend(place.geometry.location);
                $('input[name="map_lat"]', t).val(place.geometry.location.lat());
                $('input[name="map_lng"]', t).val(place.geometry.location.lng());
                $('input[name="map_address"]', t).val(place.formatted_address);

                $.each(place.address_components, function (index, names) {
                    if ($.inArray('country', names.types) != -1) {
                        $('input[name="map_country"]', t).val(names.short_name);
                    }
                });
                map.fitBounds(bounds);
            });

            google.maps.event.addListener(map, 'zoom_changed', function () {
                var z = map.getZoom();
                $('input[name="map_zoom"]', t).val(z);
            });

            var geocoder = new google.maps.Geocoder();
            google.maps.event.addListener(map, 'click', function (event) {
                geocoder.geocode({
                    'latLng': event.latLng
                }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            setMarker({lat: event.latLng.lat(), lng: event.latLng.lng()});
                            var latlng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
                            bounds.extend(latlng);
                            $('input[name="map_lat"]', t).val(event.latLng.lat());
                            $('input[name="map_lng"]', t).val(event.latLng.lng());
                            $('input[name="map_address"]', t).val(results[0].formatted_address);
                            $.each(results[0].address_components, function (index, names) {
                                if ($.inArray('country', names.types) != -1) {
                                    $('input[name="map_country"]', t).val(names.short_name);
                                }
                            });
                        }
                    }
                });
            });

            function setMarker(latLng) {
                deleteMarkers();
                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    draggable: false
                });
                markers.push(marker);
            }

            function deleteMarkers() {
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(null);
                    markers = [];
                }

            }
        });

   });
});