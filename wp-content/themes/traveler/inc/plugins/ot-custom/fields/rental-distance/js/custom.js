var modal = document.getElementById('rental-distance-wrapper');
var btn = document.getElementById("btn-rental-distance");
var span = document.getElementsByClassName("rd-close")[0];
btn.onclick = function () {
    modal.style.display = "block";
}
span.onclick = function () {
    modal.style.display = "none";
}
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

jQuery(function($){
    jQuery(document).ready(function($) {
        function initialize() {
            var lat = $('#bt_ot_gmap_input_lat').val();
            var lng = $('#bt_ot_gmap_input_lng').val();
            var message = $('#rd-error');
            message.hide();
            var messageContent = '';
            if(lat == '' || lng == ''){
                messageContent += message.data('latlng');
                message.show();
                message.html('');
                message.html(messageContent);
            }else{
                var rdType = $('#rd-elm-type').val();
                if(rdType == '-1'){
                    messageContent += message.data('type') + "<br />";
                }
                var rdRadius = $('#rd-elm-radius').val();
                if(rdRadius == ''){
                    messageContent += message.data('radius') + "\n";
                }
                message.show();
                message.html('');
                message.html(messageContent);
                if(rdType != '-1' && rdRadius != '') {
                    var pyrmont = {lat: parseFloat(lat), lng: parseFloat(lng)};
                    map = new google.maps.Map(document.getElementById('rd-map'), {
                        center: pyrmont,
                        zoom: 15
                    });
                    infowindow = new google.maps.InfoWindow();
                    var service = new google.maps.places.PlacesService(map);
                    service.nearbySearch({
                        location: pyrmont,
                        radius: parseInt(rdRadius)*1000,
                        type: [rdType]
                    }, callback);
                }
            }
        }

        function callback(results, status) {
            $('#rd-select-result').hide();
            var overlay = $('#rd-result .overlay');
            //overlay.addClass('open');
            var lat = $('#bt_ot_gmap_input_lat').val();
            var lng = $('#bt_ot_gmap_input_lng').val();
            var message = $('#rd-error');
            var content = $('#rd-result .rd-result-content table tbody');
            content.html('');
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                message.hide();
                var te = '';
                var placeID = [];
                for (var i = 0; i < results.length; i++) {
                    te += '<tr data-placeid="'+ results[i].place_id +'" data-name="'+ results[i].name +'"  data-vicinity="'+ results[i].vicinity +'" data-placeid="'+results[i].place_id+'">';
                    te += '<td class="check-column"><input type="checkbox" value=""/></td>';
                    te += '<td>'+ results[i].name +'</td>';
                    te += '<td>'+ results[i].vicinity +'</td>';
                    te += '<td class="rd-distance" data-placeid="'+results[i].place_id+'">...</td>';
                    te += '</tr>';
                    placeID.push(results[i].place_id);
                }
                content.html(te);
                $('#rd-select-result').show();
                /*$.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: {
                        action          : "get_distance_placeid",
                        lat       : lat,
                        lng       : lng,
                        placeid    : placeID,
                    },
                    dataType: "json"
                }).done(function( resp ) {
                    content.find('tr').each(function (ev) {
                        $(this).find('.rd-distance').html(resp[$(this).find('.rd-distance').data('placeid')].distance);
                        $(this).attr('data-distance', resp[$(this).find('.rd-distance').data('placeid')].distance);
                    });
                    overlay.removeClass('open');
                    $('#rd-select-result').show();
                });*/
            }else{
                message.html(status);
                message.show();
            }
        }
        $('#rd-get-result').on('click', initialize);
        $('#rd-select-result').click(function (e) {
            var dataSelect = new Array();
            $('#rd-result .rd-result-content table tbody tr').each(function (ev) {
                var me = $(this);
                if(me.find('input').is(':checked')){
                    dataSelect.push({
                            'place_id': me.data('placeid'),
                            'name': me.data('name'),
                            'vicinity': me.data('vicinity'),
                            'distance': me.data('distance')
                    });
                }
            });
            if(dataSelect.length){
                var type = $('#rd-elm-type').val();
                var typeName = $('#rd-elm-type option[value="'+type+'"]').text();
                var te = '';
                if($('.' + type).length){
                    $('#rd-item .item-wrapper.rdtype-' + type).html('');
                }else{
                    $('#rd-item').append('<div class="'+type+'"><span class="rd-title">'+typeName+'</span><div class="item-wrapper rdtype-'+ type +'"></div></div>');
                }

                $.each(dataSelect, function (index, value) {
                    te += value.name + '|' + value.distance + ',';
                    $('#rd-item .item-wrapper.rdtype-' + type).append('<div class="item">'+ value.name +' - '+ value.distance +'<div class="close">+</div></div>');
                });
                //if($('input[name="st_rental_distance['+$('#rd-elm-type').val()+']"]').length){
                //    $('input[name="st_rental_distance['+$('#rd-elm-type').val()+']"]').val(te);
                //}else{
                //    $('#rd-item').append('<input name="st_rental_distance['+$('#rd-elm-type').val()+']" type="text" value="'+te+'" />');
                //}
            }
        });
    });
});