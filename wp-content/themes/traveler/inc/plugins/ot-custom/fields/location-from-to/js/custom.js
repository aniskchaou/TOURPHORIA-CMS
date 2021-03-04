jQuery(document).ready(function($) {

	$('.car_location_pick_up').each(function(index, el) {
		var t = $(this);

		t.select2({
            placeholder: t.data('placeholder'),
            minimumInputLength:2,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: ajaxurl,
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term, // search term,
                        action:'st_post_select_ajax',
                        post_type: 'location'
                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter the remote JSON data
                    return { results: data.items };
                },
                cache: true
            },/*
            initSelection: function(element, callback) {
                // the input tag hsas a value attribute preloaded that points to a preselected repository's id
                // this function resolves that id attribute to an object that select2 can render
                // using its formatResult renderer - that way the repository name is shown preselected
                var id = $(element).val();
                if (id !== "") {
                    var data={
                        id:id,
                        name:$(element).data('pl-name'),
                        description:$(element).data('pl-desc')
                    };
                    callback(data);
                }
            },*/
            formatResult: function(state){
            	
                if (!state.id) return state.name; // optgroup
                return state.name+'<p><em>'+state.description+'</em></p>';
            },
            formatSelection: function(state){
                if (!state.id) return state.name; // optgroup
                return state.name+'<p><em>'+state.description+'</em></p>';
            },
            escapeMarkup: function(m) { return m; }
        });

		t.on("change", function (e) {
			console.log(typeof e.added);
			if( typeof e.added != 'undefined' && typeof e.added.name != 'undefined'){
				t.attr('data-name', e.added.name);
			}
			

			var location = e.val;
			var t2;

			if( location != '' ){
				$('.car_location_drop_off').each(function(index, el) {
					t2 = $(this);

					t2.select2({
			            placeholder: t.data('placeholder'),
			            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
			                url: ajaxurl,
			                dataType: 'json',
			                quietMillis: 250,
			                data: function (term, page) {
			                    return {
			                        action:'st_get_location_childs',
			                        location_id: location
			                    };
			                },
			                results: function (data, page) { // parse the results into the format expected by Select2.
			                    // since we are using custom formatting functions we do not need to alter the remote JSON data
			                    return { results: data.items };
			                },
			                cache: true
			            },/*
			            initSelection: function(element, callback) {
			                // the input tag hsas a value attribute preloaded that points to a preselected repository's id
			                // this function resolves that id attribute to an object that select2 can render
			                // using its formatResult renderer - that way the repository name is shown preselected
			                var id = $(element).val();
			                if (id !== "") {
			                    var data={
			                        id:id,
			                        name:$(element).data('pl-name'),
			                        description:$(element).data('pl-desc')
			                    };
			                    callback(data);
			                }
			            },*/
			            formatResult: function(state){
			            	
			                if (!state.id) return state.name; // optgroup
			                return state.name+'<p><em>'+state.description+'</em></p>';
			            },
			            formatSelection: function(state){
			                if (!state.id) return state.name; // optgroup
			                return state.name+'<p><em>'+state.description+'</em></p>';
			            },
			            escapeMarkup: function(m) { return m; }
			        });

					

					t2.on("change", function (e) {
						if( typeof e.added != 'undefined' && typeof e.added.name != 'undefined'){
							t2.attr('data-name', e.added.name);
						}
					})
				});
			}
		});
	});
	
	function add_list_location_selected( lists ){
		var string = "";
		var data = "";
		if( locations.length ){
			$.each(locations, function(index, val) {
				string += "<p class='item-location-from-to' data-index="+index+" style='padding: 5px; margin-top: 5px; border-bottom: 1px solid #CCC; background: #EEE; font-weight: bold;'>"+val.pickup_text+" -> "+val.dropoff_text+" <span class='delete-item-location-from-to'>x</span></p>";
				data += '<input type="hidden" name="locations_from_to[pickup][]" value="'+ val.pickup+'"><input type="hidden" name="locations_from_to[dropoff][]" value="'+ val.dropoff+'">';
				
			});
		}

		$('#location-car-selected').html( string );
		$('.location-save-data').html(data);
	}

	var locations = st_location_from_to.lists;

	add_list_location_selected( locations );

	$('#add-location-from-to').click(function(event) {
		/* Act on the event */
		$('p.location-message').html('');

		var pickup = $('input.car_location_pick_up').val();
		
		var dropoff = $('input.car_location_drop_off').val();
		
		if( pickup != '' && dropoff != ''){
			var pickup_text = $('input.car_location_pick_up').attr('data-name');
			var dropoff_text = $('input.car_location_drop_off').attr('data-name');
			locations.push({
				pickup: pickup,
				pickup_text: pickup_text,
				dropoff: dropoff,
				dropoff_text: dropoff_text
			});

			$('.car_location_drop_off').select2('data', null);
		}else{
			$('p.location-message').html('Please select pick up and drop off location!');
		}

		add_list_location_selected( locations );

		return false;
	});
	

	$('body').on('click','.delete-item-location-from-to',function(event) {
		var parent = $(this).parent('.item-location-from-to')
		var index = parent.data('index');
		locations.splice(index, 1);
		add_list_location_selected( locations );
	});
	
});