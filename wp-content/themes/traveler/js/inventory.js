/**
 * Created by Administrator on 11/29/2017.
 */
;(function ($, window, document) {
    if (typeof Object.create !== "function") {
        Object.create = function (obj) {
            function F() {
            }

            F.prototype = obj;
            return new F();
        };
    }

    var Inventory = {
        init    : function (options, el) {
            var base          = this;
            base.$elem        = $(el);
            base.curr_options = $.extend({}, $.fn.wpInventoryAdvanced.options, options);
            base.gantt        = null;
            base.rooms        = null;
            base.render();
        },
        render  : function (start, end, ajax_url, ajax) {
            var base = this;
            base.setStart(start);
            base.setEnd(end);
            base._fetch(false);
            if (typeof ajax !== 'undefined') {

                $.post(ajax_url, ajax, function (respon) {
                    if (typeof respon == 'object') {
                        base.setRoom(respon.rooms);
                        base._fetch();
                    }
                }, 'json');
            }
        },
        _fetch  : function (loader) {
            if (typeof loader == 'undefined') {
                loader = true;
            }
            var base   = this;
            base.gantt = base.$elem.gantt({
                source      : base.rooms,
                navigate    : "scroll",
                maxScale    : "days",
                itemsPerPage: 20,
                dateStart   : base.startDate,
                dateEnd     : base.endDate,
                loader      : loader,
                onAddClick  : function (dt, row, col) {
                }
            });

            base.gantt = base.gantt.data('Gantt');
        },
        setStart: function (start) {
            var base       = this;
            base.startDate = moment().format();
            if (typeof start != 'undefined') {
                base.startDate = start;
            }
        },
        setEnd  : function (end) {
            var base     = this;
            base.endDate = moment().add(30, 'days').format();
            if (typeof end != 'undefined') {
                base.endDate = end;
            }
        },
        setRoom : function (rooms) {
            var base   = this;
            base.rooms = [];
            base.rooms = rooms;
        }
    };

    $.fn.wpInventoryAdvanced = function (options) {
        return this.each(function () {
            if ($(this).data("inventory-init") === true) {
                return false;
            }
            $(this).data("inventory-init", true);
            var inventory = Object.create(Inventory);
            inventory.init(options, this);
            $.data(this, "Inventory", inventory);
        });
    };

    $.fn.wpInventoryAdvanced.options = {};

    jQuery(document).ready(function ($) {
        'use strict';

        var body = $('body');
        $('.st-inventory', body).each(function () {
            var t              = $(this);
            var parent = t.closest('.st-calendar-wrapper');
            var inventory      = t.wpInventoryAdvanced();
            var inventory_data = inventory.data('Inventory');
            var start          = moment().format();
            var end            = moment().add(30, 'days').format();
            var data           = {
                'action' : 'st_fetch_inventory',
                'start'  : moment(start).format("YYYY-MM-DD"),
                'end'    : moment(end).format("YYYY-MM-DD"),
                'post_id': t.data('id')
            };
            inventory_data.render(start, end, st_params.ajax_url, data);
            t.on('wpbooking_update_price_inventory', function (ev, start, end) {
                var data = {
                    'action' : 'st_fetch_inventory',
                    'start'  : moment(start).format("YYYY-MM-DD"),
                    'end'    : moment(end).format("YYYY-MM-DD"),
                    'post_id': t.data('id')
                };
                inventory_data.render(start, end, st_params.ajax_url, data);
            });
            t.on('wpbooking_next_month_inventory', function (ev, start, end) {
                var data = {
                    'action' : 'st_fetch_inventory',
                    'start'  : moment(end).format("YYYY-MM-DD"),
                    'end'    : moment(end).add(30, 'days').format("YYYY-MM-DD"),
                    'post_id': t.data('id')
                };
                inventory_data.render(moment(end).format(), moment(end).add(30, 'days').format(), st_params.ajax_url, data);
            });
            t.on('wpbooking_prev_month_inventory', function (ev, start, end) {
                var data = {
                    'action' : 'st_fetch_inventory',
                    'start'  : moment(start).subtract(30, 'days').format("YYYY-MM-DD"),
                    'end'    : moment(start).format("YYYY-MM-DD"),
                    'post_id': t.data('id')
                };
                inventory_data.render(moment(start).subtract(30, 'days').format(), moment(start).format(), st_params.ajax_url, data);
            });
            t.on('wpbooking_now_inventory', function (ev, start, end) {
                var data = {
                    'action' : 'st_fetch_inventory',
                    'start'  : moment().format("YYYY-MM-DD"),
                    'end'    : moment().add(30, 'days').format("YYYY-MM-DD"),
                    'post_id': t.data('id')
                };
                inventory_data.render(moment().format(), moment().add(30, 'days').format(), st_params.ajax_url, data);
            });
            var form = $('.st-inventory-form', parent);

            var check_out = $('.st-inventory-end', form).datepicker({
                dateFormat: 'yy-mm-dd'
            });
            var check_in = $('.st-inventory-start', form).datepicker({
                dateFormat: 'yy-mm-dd',
                onSelect  : function (selected) {
                    var m    = new moment(selected, 'YYYY-MM-DD');
                    selected = m.format('YYYY-MM-DD');
                    check_out.datepicker("option", "minDate", selected);
                    window.setTimeout(function () {
                        check_out.datepicker("show");
                    }, 100);
                }
            });
            $(document).on('click', '.panel-room-number-wrapper .btn-add-number-room', function(){
                var me = $(this);
                var parent = me.closest('.panel-room-number-wrapper');
                var number_room = $('input[name="input-room-number"]', parent).val();
                $('input[name="input-room-number"]', parent).removeClass('ivt-error-field');
                if(number_room == ''){
                    $('input[name="input-room-number"]', parent).addClass('ivt-error-field');
                    return false;
                }
                me.find('i').css({'display' : 'inline-block'});
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    url: ajaxurl,
                    data: {
                        'room_id' : $('input[name="input-room-id"]', parent).val(),
                        'number_room' : number_room,
                        'action' : 'st_add_room_number_inventory'
                    },
                    success: function (response) {
                        if(response.status == '1'){
                            $('.panel-room-number-wrapper .message-box').html('<span class="ivt-text-success">'+ response.message +'</span>');
                        }else{
                            $('.panel-room-number-wrapper .message-box').html('<span class="ivt-text-error">'+ response.message +'</span>');
                        }
                        me.find('i').fadeOut();
                        var data = {
                            'action' : 'st_fetch_inventory',
                            'start'  : moment().format("YYYY-MM-DD"),
                            'end'    : moment().add(30, 'days').format("YYYY-MM-DD"),
                            'post_id': $('.st-inventory', body).data('id')
                        };
                        inventory_data.render(moment().format(), moment().add(30, 'days').format(), ajaxurl, data);
                    },
                    error: function(){
                        me.find('i').fadeOut();
                    }
                });

            });
            $(document).on('click', '.inventory-edit-room-number', function(){
                var me = $(this);
                var parent = me.closest('.calendar-wrapper');
                var room_id = me.parent().data('id');
                $('.panel-room-number-wrapper .input-room-id', parent).val(room_id);
                $('.panel-room-number-wrapper', parent).fadeIn();
            });
            $(document).on('click', '.panel-room-number-wrapper .panel-room .close', function(ev){
                ev.preventDefault()
                var me = $(this);
                var parent = me.closest('.calendar-wrapper');
                $('input[name="input-room-number"]', parent).val('');
                $('.panel-room-number-wrapper .message-box', parent).html('');
                $('.panel-room-number-wrapper', parent).fadeOut();
            });

            var goto = $('.st-inventory-goto', form).click(function (ev) {
                ev.preventDefault();
                var start = check_in.val();
                var end   = check_out.val();
                if (start != '' && end != '') {
                    var data = {
                        'action' : 'st_fetch_inventory',
                        'start'  : moment(start).format("YYYY-MM-DD"),
                        'end'    : moment(end).format("YYYY-MM-DD"),
                        'post_id': $('.st-inventory', body).data('id')
                    };
                    inventory_data.render(moment(start).format(), moment(end).format(), st_params.ajax_url, data);
                }
            });

        });

    });
})(jQuery, window, document);