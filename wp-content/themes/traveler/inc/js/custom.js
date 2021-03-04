

jQuery(document).ready(function($){

    $('form.main-search').each(function(index, el) {
        var t = $(this);
        // Change same location car
        $('a.diff-location', t).click(function(event) {
            /* Act on the event */
            $(this).toggleClass('hide');
            $('a.same-location', t).toggleClass('hide');
            $('#st_google_location_dropoff', t).parents('.form-group').toggleClass('hide');
            return false;
        });

        $('a.same-location', t).click(function(event) {
            /* Act on the event */
            $(this).toggleClass('hide');
            $('a.diff-location', t).toggleClass('hide');
            $('#st_google_location_dropoff', t).parents('.form-group').toggleClass('hide');

            street_number_off.val( street_number_up.val() );
            locality_off.val( locality_up.val() );
            route_off.val( route_up.val() );
            sublocality_level_1_off.val( sublocality_level_1_up.val() );
            administrative_area_level_2_off.val( administrative_area_level_2_up.val() );
            administrative_area_level_1_off.val( administrative_area_level_1_up.val() );
            country_off.val( country_up.val()) ;

            t.find('#st_google_location_dropoff').val(t.find('#st_google_location_pickup').val());

            return false;
        });

        var pickup = t.find('#st_google_location_pickup')[0];
        var pickup_container = $('#st_google_location_pickup', t).parent('.st-google-location-wrapper');
        var autocomplete_pickup = new google.maps.places.Autocomplete(pickup);
        var street_number_up = $('input[name="st_street_number_up"]', pickup_container);
        var locality_up = $('input[name="st_locality_up"]', pickup_container);
        var route_up = $('input[name="st_route_up"]', pickup_container);
        var sublocality_level_1_up = $('input[name="st_sublocality_level_1_up"]', pickup_container);
        var administrative_area_level_2_up = $('input[name="st_administrative_area_level_2_up"]', pickup_container);
        var administrative_area_level_1_up = $('input[name="st_administrative_area_level_1_up"]', pickup_container);
        var country_up = $('input[name="st_country_up"]', pickup_container);

        var dropoff = t.find('#st_google_location_dropoff')[0];
        var dropoff_container = $('#st_google_location_dropoff', t).parent('.st-google-location-wrapper');
        var autocomplete_dropoff = new google.maps.places.Autocomplete(dropoff);
        autocomplete_dropoff.setComponentRestrictions([]);

        var street_number_off = $('input[name="st_street_number_off"]', dropoff_container);
        var locality_off = $('input[name="st_locality_off"]', dropoff_container);
        var route_off = $('input[name="st_route_off"]', dropoff_container);
        var sublocality_level_1_off = $('input[name="st_sublocality_level_1_off"]', dropoff_container);
        var administrative_area_level_2_off = $('input[name="st_administrative_area_level_2_off"]', dropoff_container);
        var administrative_area_level_1_off = $('input[name="st_administrative_area_level_1_off"]', dropoff_container);
        var country_off = $('input[name="st_country_off"]', dropoff_container);

        autocomplete_pickup.addListener('place_changed', function() {
            street_number_up.val('');
            locality_up.val('');
            route_up.val('');
            sublocality_level_1_up.val('');
            administrative_area_level_2_up.val('');
            administrative_area_level_1_up.val('');
            country_up.val('');

            street_number_off.val('');
            locality_off.val('');
            route_off.val('');
            sublocality_level_1_off.val('');
            administrative_area_level_2_off.val('');
            administrative_area_level_1_off.val('');
            country_off.val('');
            autocomplete_dropoff.setComponentRestrictions([]);

            t.find('#st_google_location_dropoff').val(t.find('#st_google_location_pickup').val());

            var place = autocomplete_pickup.getPlace();
            if (place.geometry) {
                $.each(place.address_components, function(index, names) {
                    if($.inArray('street_number', names.types) != -1){
                        street_number_up.val(names.long_name);
                        street_number_off.val(names.long_name);

                    }
                    if($.inArray('locality', names.types) != -1){
                        locality_up.val(names.long_name);
                        locality_off.val(names.long_name);
                    }
                    if($.inArray('route', names.types) != -1){
                        route_up.val(names.long_name);
                        route_off.val(names.long_name);
                    }
                    if($.inArray('sublocality_level_1', names.types) != -1){
                        sublocality_level_1_up.val(names.long_name);
                        sublocality_level_1_off.val(names.long_name);
                    }
                    if($.inArray('administrative_area_level_2', names.types) != -1){
                        administrative_area_level_2_up.val(names.long_name);
                        administrative_area_level_2_off.val(names.long_name);
                    }
                    if($.inArray('administrative_area_level_1', names.types) != -1){
                        administrative_area_level_1_up.val(names.long_name);
                        administrative_area_level_1_off.val(names.long_name);
                    }
                    if($.inArray('country', names.types) != -1){
                        country_up.val(names.long_name);
                        country_off.val(names.long_name);
                        if(names.short_name != ''){
                            var ct = names.short_name.toLowerCase();
                            autocomplete_dropoff.setComponentRestrictions({'country': ct});
                        }

                    }
                });
            }

            if($('a.diff-location').hasClass('hide') && ! dropoff_container.parents('.form-group').hasClass('hide')){
                street_number_off.val('');
                locality_off.val('');
                route_off.val('');
                sublocality_level_1_off.val('');
                administrative_area_level_2_off.val('');
                administrative_area_level_1_off.val('');
                country_off.val('');
            }

        });

        autocomplete_dropoff.addListener('place_changed', function() {
            street_number_off.val('');
            locality_off.val('');
            route_off.val('');
            sublocality_level_1_off.val('');
            administrative_area_level_2_off.val('');
            administrative_area_level_1_off.val('');
            country_off.val('');

            var place = autocomplete_dropoff.getPlace();
            if (place.geometry) {
                $.each(place.address_components, function(index, names) {
                    if($.inArray('street_number', names.types) != -1){
                        street_number_off.val(names.long_name);

                    }
                    if($.inArray('locality', names.types) != -1){
                        locality_off.val(names.long_name);
                    }
                    if($.inArray('route', names.types) != -1){
                        route_off.val(names.long_name);
                    }
                    if($.inArray('sublocality_level_1', names.types) != -1){
                        sublocality_level_1_off.val(names.long_name);
                    }
                    if($.inArray('administrative_area_level_2', names.types) != -1){
                        administrative_area_level_2_off.val(names.long_name);
                    }
                    if($.inArray('administrative_area_level_1', names.types) != -1){
                        administrative_area_level_1_off.val(names.long_name);
                    }
                    if($.inArray('country', names.types) != -1){
                        country_off.val(names.long_name);
                    }
                });
            }

        });

        $('#st_google_location_dropoff', t).focus(function(event) {
            if($('#st_google_location_pickup', t).val() == ''){
                $('#st_google_location_pickup', t).focus();
            }
        });
    });






    /*$(document).on('click','#btn_add_filter','',function(){
        $('.tmp_data_add_type').show();
        $('.div_title_filter').show();
    });

    $(document).on('click','.add_type','',function(){
        var $this = $(this);
        var data_type = $this.attr('data-type');
        var data_value =$this.attr('data-value');

        var data_json = '';
        $('.data_json').each(function(){
            data_json = $(this).val();
        });
        if(data_json != ''){
            data_json = JSON.parse(data_json);
        }
        var title_filter ='';
        $('.title_filter').each(function(){
             title_filter = $(this).val();
        });


        $.ajax({
            url: ajaxurl,
            type: "GET",
            data: {
                action          : "add_type_widget",
                data_type       : data_type ,
                data_json       : data_json ,
                title_filter    : title_filter,
                data_value      : data_value
            },
            dataType: "json",
            beforeSend: function() {

            }
        }).done(function( html ) {
            $('.data_json').each(function(){
               $(this).val( JSON.stringify(html) );
            });
            $('.data_widget').each(function(){
              $(this).append(html.data_html)
            });
            $('.title_filter').each(function(){
                $(this).val('');
            });

        });

    });

    $(document).on('click','.list_taxonomy','',function(){
        $.ajax({
            url: ajaxurl,
            type: "GET",
            data: {
                action          : "load_list_taxonomy"
            },
            dataType: "html",
            beforeSend: function() {

            }
        }).done(function( html ) {
            $('.tmp_data_add_type').each(function(){
                $(this).hide();
            });

            $('.tmp_data_taxonomy').each(function(){
                $(this).show();
                $(this).html( html );
            });

        });

    });

    $(document).on('click','.btn_del_tmp_data_taxonomy','',function(){
          $('.tmp_data_taxonomy').each(function(){
              $(this).html('');
          });
    });
*/

    $('a.delete').on("click",function(){
        var answer = confirm ("Are you sure you want to delete this attribute?");
        if (answer) return true;
        return false;
    });

    $('.st_datepicker_withdrawal').each(function(){
        $(this).datepicker({
            dateFormat : 'mm/dd/yy',
            firstDay: 1
        });
    });


    // ===========================================================   User dashboard Info

    var me = jQuery("span.st_user_dashboard_info.lineChartData_total");
    if (me.length >0){
        var data_lable = me.data("data_label");
        var data_sets = me.data("data_sets");
        var lineChartData_total = {
            labels : data_lable,
            datasets : [
                {
                    label: "",
                    fillColor : "rgba(87, 142, 190, 0.5)",
                    strokeColor : "rgba(87, 142, 190, 0.8)",
                    pointColor : "rgba(87, 142, 190, 0.75)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(87, 142, 190, 1)",
                    data : data_sets
                }
            ]
        };
        jQuery(function($){
            var ctx = document.getElementById("canvas_this_month").getContext("2d");
            new Chart(ctx).Line(lineChartData_total, {
                responsive: true,
                animationEasing: "easeOutBounce"
            });
        });
    };
    var div_single_year = $(".content-admin .div_single_year");
    if (div_single_year.length >0){
        setTimeout(function(){
            var height = div_single_year.height();
            console.log(height);
            $(".st_bortlet.box.st_hotel.st_bortlet_new_admin .table-scrollable").height(height-111);
        },100);
    }

    $(document).on('click', '.st_nav_service_partner', function(event) {
        $(this).parent().find('.st_nav_service_partner').removeClass("nav-tab-active");
        $(this).addClass('nav-tab-active');
        var post_type = $(this).data("post-type");
        $(".content-hide").hide();
        $(".content-"+post_type).fadeIn(500);


    });
    $(document).on('click', '.st_nav_top_service_partner', function(event) {
        var post_type = $(this).data("post-type");
        $(".content-hide").hide();
        $(".content-"+post_type).fadeIn(500);
        var $container = $(".content-"+post_type).parent().parent();
        $container.find(".st_nav_service_partner").removeClass("nav-tab-active");
        $container.find(".st-nav-"+post_type).addClass("nav-tab-active");
    });
    $(document).on('click', '.btn_load_more_service_partner', function(event) {
        var this_btn = $(this);
        var st_post_type = $(this).data('post-type');
        var st_user_id = $(this).data('user-id');
        var st_paged = $(this).attr('data-paged');
        var text_me = $(this).html();
        $(this).html(st_params_partner.text_loading);
        $.ajax({
            url: st_params_partner.ajax_url,
            type: 'post',
            dataType: 'json',
            data: {
                action: 'st_load_more_service_partner',
                st_post_type: st_post_type,
                st_user_id: st_user_id,
                st_paged: st_paged,
                st_show: "true"
            },
            success: function(res) {
                if(res.data_html != ""){
                    $(".content-"+st_post_type).find('#the-list').append(res.data_html);
                    this_btn.html(text_me)
                }else{
                    this_btn.html(st_params_partner.text_no_more);
                    this_btn.attr('disabled',"disabled");;
                }
            },
            error: function(res) {
                console.log(res);
                alert('Ajax Faild');
            }
        });
        st_paged = parseInt(st_paged) + 1;
        this_btn.attr('data-paged',st_paged);
    });

    $(document).on('click', '.btn_change_withdrawal_partner_admin', function(event) {
        var $container = $(this).parent().parent().parent();
        $container.find('.content-change').fadeIn();
        $container.find('.row-actions').hide();
        $container.find('.title-status').hide();
    });
    $(document).on('click', '.btn_cancel_withdrawal_partner_admin', function(event) {
        var $container = $(this).parent().parent().parent().parent();
        $container.find('.content-change').hide();
        $container.find('.row-actions').show();
        $container.find('.title-status').show();
    });

    $(document).on('click', '.btn_apply_withdrawal_partner_admin', function(event) {
        var $container = $(this).parent().parent();
        var st_withdrawal_id=  $(this).data('withdrawal-id');
        var st_user_id=  $(this).data('user-id');
        var st_status = $container.find('.st_status').val();
        var st_message = $container.find('.st_message').val();
        $container.find('.st_change_loading').show();
        $.ajax({
            url: st_params_partner.ajax_url,
            type: 'post',
            dataType: 'json',
            data: {
                action: 'st_change_status_withdrawal',
                st_user_id: st_user_id,
                st_withdrawal_id: st_withdrawal_id,
                st_status: st_status,
                st_message: st_message
            },
            success: function(res) {
                if(res.status == 'true'){
                    $container.parent().parent().find('.title-status').html(res.html_status).show();
                    $container.parent().parent().find('.content-change').hide();
                    $container.find('.st_change_loading').hide();
                    $container.parent().parent().find('.row-actions').show();
                }
            },
            error: function(res) {
                console.log(res);
                alert('Ajax Faild');
            }
        });
    });

//st_load_more_service_partner
});



