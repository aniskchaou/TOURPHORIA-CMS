var last_search_room_error;
jQuery(document).ready(function ($) {
    var last_error = '';
    $('.btn-do-search-room').click(function () {
        var searchbox = $(this).parents('.booking-item-dates-change');
        do_search_room(searchbox)
    });
    $(".btn-show-price").click(function () {
        var searchbox = $('.booking-item-dates-change');
        do_search_room(searchbox)
    });
    $('.btn-clr-search-room').click(function () {
        var searchbox = $(this).parents('.booking-item-dates-change');
        do_clear_search_form(searchbox);
        do_search_room(searchbox)
    });

    function do_clear_search_form(searchbox) {
        searchbox.find('input[type=text]').val('');
        searchbox.find('select').each(function (i, v) {
            v.selectedIndex = 0
        });
        searchbox.find('.btn-group-select-num .btn-primary').removeClass('active');
        $('.search_room_alert').html('');
        $('.age_of_child_input').removeClass('error');
        searchbox.find('.form-control').removeClass('error')
    }

    function do_search_room(searchbox) {
        var me = $('.booking-list.loop-room');
        var data = {'nonce': $('input[name=room_search]').val()};
        if (typeof searchbox != "undefined") {
            data = searchbox.find('input,select,textarea').serializeArray()
        }
        var dataobj = {};
        for (var i = 0; i < data.length; i++) {
            dataobj[data[i].name] = data[i].value
        }
        var holder = $('.search_room_alert');
        holder.html('');
        searchbox.find('.age_of_child_input').removeClass('error');
        searchbox.find('.form-control').removeClass('error');
        searchbox.find('.form_input').removeClass('error');
        if (dataobj.start == "" && dataobj.end == "") {
            if (dataobj.start == "") {
                searchbox.find('[name=start]').addClass('error')
            }
            if (dataobj.end == "") {
                searchbox.find('[name=end]').addClass('error')
            }
            setMessage(holder, st_hotel_localize.is_not_select_date, 'danger');
            return !1
        }
        if (dataobj.start == "") {
            if (dataobj.start == "") {
                searchbox.find('[name=start]').addClass('error')
            }
            setMessage(holder, st_hotel_localize.is_not_select_check_in_date, 'danger');
            return !1
        }
        if (dataobj.end == '') {
            if (dataobj.end == "") {
                searchbox.find('[name=end]').addClass('error')
            }
            setMessage(holder, st_hotel_localize.is_not_select_check_out_date, 'danger');
            return !1
        }
        if (dataobj.room_num_search == 1) {
            if (dataobj.adult_num == "" || dataobj.child_num == '') {
                setMessage(holder, st_hotel_localize.booking_required_adult_children, 'danger');
                return !1
            }
        } else {
            var is_aoc_fail = !1;
            searchbox.find('.room_num_children_input').each(function () {
                if ($(this).val() > 0) {
                    $(this).closest('tr').find('.age_of_child_input').each(function () {
                        if ($(this).val() == '-1') {
                            $(this).addClass('error');
                            is_aoc_fail = !0
                        } else {
                            $(this).removeClass('error')
                        }
                    })
                }
            });
            if (is_aoc_fail) {
                setMessage(holder, st_hotel_localize.is_aoc_fail, 'danger');
                return !1
            }
            var is_host_name_fail = !1;
            searchbox.find('.room_num_host_name_input').each(function () {
                if ($(this).val() == '') {
                    $(this).addClass('error');
                    is_host_name_fail = !0
                } else {
                    $(this).removeClass('error')
                }
            });
            if (is_host_name_fail) {
                setMessage(holder, st_hotel_localize.is_host_name_fail, 'danger');
                return !1
            }
        }
        if (me.hasClass('loading')) {
            alert('Still loading');
            return
        }
        me.addClass('loading');
        $.ajax({
            'type': 'post', 'dataType': 'json', 'url': "", 'data': data, 'success': function (data) {
                me.removeClass('loading');
                if (data.status) {
                    if (typeof data.data != "undefined" && data.data) {
                        me.html(data.data)
                    } else {
                        me.html('')
                    }
                    $('body').tooltip({selector: '[rel=tooltip]'});
                    $('.i-check, .i-radio').iCheck({checkboxClass: 'i-check', radioClass: 'i-radio'})
                }
                if (data.message) {
                    setMessage(holder, data.message, 'danger');
                    me.html('')
                }
                $('.div_paged_room').html(data.paging);
                $('.booking-item-dates-change .paged_room').val(1)
            }, error: function (data) {
                me.removeClass('loading')
            }
        })
    }

    function setMessage(holder, message, type) {
        if (typeof type == 'undefined') {
            type = 'infomation'
        }
        var html = '<div class="alert alert-' + type + '">' + message + '</div>';
        if (!holder.length) return;
        holder.html('');
        holder.html(html);
        do_scrollTo(holder)
    }

    $(document).on('change', '.room_num_children_input', function () {
        var val = $(this).val();
        var parent = $(this).closest('tr');
        show_child_age_col();
        if (val == 0) {
            parent.find('.room_num_age_of_children').html('')
        } else {
            parent.find('.room_num_age_of_children').html('');
            var room_num = $(this).closest('.room-item').data('room-num');
            for (i = 1; i <= val; i++) {
                var html = $('#example_age_of_child').clone();
                html.removeAttr('id');
                html.removeClass('hidden');
                html.addClass('required');
                html.attr('name', 'room_data[' + room_num + '][age_of_children][' + i + ']');
                parent.find('.room_num_age_of_children').append(html)
            }
        }
    });

    function show_child_age_col() {
        $('.room_num_config tbody tr').each(function () {
            var select = $(this).find('.room_num_children_input');
            if (select.val() > 0) {
                $('.age_of_children_col').removeClass('hidden')
            }
        })
    }

    show_child_age_col();

    function do_scrollTo(el) {
        if (el.length) {
            var top = el.offset().top;
            if ($('#wpadminbar').length && $('#wpadminbar').css('position') == 'fixed') {
                top -= 32
            }
            top -= 50;
            $('html,body').animate({'scrollTop': top}, 500)
        }
    }
})