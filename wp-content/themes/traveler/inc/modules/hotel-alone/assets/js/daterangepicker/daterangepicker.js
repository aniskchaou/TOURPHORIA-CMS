/**
 * @version: 2.1.24
 * @author: Dan Grossman http://www.dangrossman.info/
 * @copyright: Copyright (c) 2012-2016 Dan Grossman. All rights reserved.
 * @license: Licensed under the MIT license. See http://www.opensource.org/licenses/mit-license.php
 * @website: https://www.improvely.com/
 */
// Follow the UMD template https://github.com/umdjs/umd/blob/master/templates/returnExportsGlobal.js
(function (root, factory) {
    "use strict";
    if (typeof define === 'function' && define.amd) {
        // AMD. Make globaly available as well
        define(['moment', 'jquery'], function (moment, jquery) {
            return (root.daterangepicker = factory(moment, jquery));
        });
    } else if (typeof module === 'object' && module.exports) {
        // Node / Browserify
        //isomorphic issue
        var jQuery = (typeof window != 'undefined') ? window.jQuery : undefined;
        if (!jQuery) {
            jQuery = require('jquery');
            if (!jQuery.fn) jQuery.fn = {};
        }
        module.exports = factory(require('moment'), jQuery);
    } else {
        // Browser globals
        root.daterangepicker = factory(root.moment, root.jQuery);
    }
}(this, function (moment, $) {
    "use strict";
    var DateRangePicker = function (element, options, cb) {

        //default settings for options
        this.parentEl             = 'body';
        this.element              = $(element);
        this.startDate            = moment().startOf('day');
        this.endDate              = moment().endOf('day');
        this.minDate              = false;
        this.maxDate              = false;
        this.dateLimit            = false;
        this.autoApply            = false;
        this.singleDatePicker     = false;
        this.showDropdowns        = false;
        this.showWeekNumbers      = false;
        this.showISOWeekNumbers   = false;
        this.showCustomRangeLabel = true;
        this.timePicker           = false;
        this.timePicker24Hour     = false;
        this.timePickerIncrement  = 1;
        this.timePickerSeconds    = false;
        this.linkedCalendars      = true;
        this.autoUpdateInput      = true;
        this.alwaysShowCalendars  = false;
        this.ranges               = {};
        this.alwaysShow           = false;
        this.showTodayButton      = false;
        this.disabledPast         = false;
        this.dateFormat           = 'YYYY-MM-DD';
        this.timeFormat           = 'hh:mm a';
        this.singleDay            = false;
        this.hideOldMonth         = false;

        this.opens = 'right';
        if (this.element.hasClass('pull-right'))
            this.opens = 'left';

        this.drops = 'down';
        if (this.element.hasClass('dropup'))
            this.drops = 'up';

        this.buttonClasses = 'btn btn-small';
        this.applyClass    = 'btn-primary ';
        this.cancelClass   = 'btn-ghost';

        this.locale = {
            direction       : 'ltr',
            format          : 'MM/DD/YYYY HH:mm',
            separator       : '-',
            applyLabel      : 'Apply',
            cancelLabel     : 'Cancel',
            weekLabel       : 'W',
            customRangeLabel: 'Custom Range',
            daysOfWeek      : moment.weekdaysMin(),
            monthNames      : moment.monthsShort(),
            firstDay        : moment.localeData().firstDayOfWeek(),
            today           : 'Today'
        };

        this.callback = function () {

        };

        //some state information
        this.isShowing       = false;
        this.leftCalendar    = {};
        this.rightCalendar   = {};
        this.enableLoading   = false;
        this.loadingText     = '<div class="preloader8"><span></span><span></span></div>';
        this.allEvents       = [];
        this.flag_get_events = false;
        this.clickedDate     = false;
        this.fetchEvents     = null;
        this.positionFixed   = false;
        this.customClass     = '';
        this.sameDate        = false;
        this.minimumCheckin  = 0;

        //custom options from user
        if (typeof options !== 'object' || options === null)
            options = {};

        //allow setting options with data attributes
        //data-api options will be overwritten with custom javascript options
        options = $.extend(this.element.data(), options);

        if (typeof options.disabledDates == 'object') {
            this.disabledDates = options.disabledDates;
        }

        if (typeof options.showCalendar == 'boolean') {
            this.showCalendar = options.showCalendar;
        }

        this.responSingle = false;

        if (typeof options.alwaysShow == 'boolean') {
            this.alwaysShow = options.alwaysShow;
        }

        if (typeof options.showTodayButton == 'boolean') {
            this.showTodayButton = options.showTodayButton;
        }
        if (typeof options.disabledPast == 'boolean') {
            this.disabledPast = options.disabledPast;
        }
        if (typeof  options.enableLoading == 'boolean') {
            this.enableLoading = options.enableLoading;
        }
        if (typeof options.loadingText == 'string') {
            this.loadingText = options.loadingText;
        }
        if (typeof options.allEvents == 'object') {
            this.allEvents = options.allEvents;
        }
        if (typeof options.fetchEvents == 'function') {
            this.fetchEvents = options.fetchEvents;
        }
        if (typeof options.positionFixed == 'boolean') {
            this.positionFixed = options.positionFixed;
        }
        if (typeof  options.customClass == 'string') {
            this.customClass = options.customClass;
        }
        if (typeof  options.sameDate == 'boolean') {
            this.sameDate = options.sameDate;
        }
        if (typeof options.dateFormat == 'string') {
            this.dateFormat = options.dateFormat;

        }
        if (typeof options.minimumCheckin == 'number') {
            this.minimumCheckin = options.minimumCheckin;
        }
        if (typeof options.classNotAvailable == 'object') {
            this.classNotAvailable = options.classNotAvailable;
        }
        if (typeof options.showEventTooltip == 'boolean') {
            this.showEventTooltip = options.showEventTooltip;
        }
        if (typeof options.singleDay == 'boolean') {
            this.singleDay = options.singleDay;
        }

        if (typeof options.hideOldMonth == 'boolean') {
            this.hideOldMonth = options.hideOldMonth;
        }

        //html template for the picker UI
        if (typeof options.template !== 'string' && !(options.template instanceof $)) {
            options.template = '<div class="daterangepicker dropdown-menu ' + this.customClass + '">' +
                '<div class="ranges">' +
                '<div class="range_inputs">' +
                '<button class="applyBtn" disabled="disabled" type="button"></button> ' +
                '<button class="cancelBtn" type="button"></button>' +
                '</div>' +
                '</div>' +
                '<div class="calendar left">' +
                '<div class="daterangepicker_input">' +
                '<input class="input-mini form-control" type="text" name="daterangepicker_start" value="" />' +
                //'<i class="fa fa-calendar glyphicon glyphicon-calendar"></i>' +
                '<div class="calendar-time">' +
                '<div></div>' +
                //'<i class="fa fa-clock-o glyphicon glyphicon-time"></i>' +
                '</div>' +
                '</div>' +
                '<div class="calendar-table"></div>' +
                '</div>' +
                '<div class="calendar right">' +
                '<div class="daterangepicker_input">' +
                '<input class="input-mini form-control" type="text" name="daterangepicker_enddaterangepicker_end" value="" />' +
                //'<i class="fa fa-calendar glyphicon glyphicon-calendar"></i>' +
                '<div class="calendar-time">' +
                '<div></div>' +
                //'<i class="fa fa-clock-o glyphicon glyphicon-time"></i>' +
                '</div>' +
                '</div>' +
                '<div class="calendar-table"></div>' +
                '</div>';

            var loader = '';
            if (this.enableLoading) {
                loader += '<div class="overlay-load hidden">' + this.loadingText + '</div>';
            }
            options.template += loader;
            options.template += '</div>';
        }

        this.parentEl = (options.parentEl && $(options.parentEl).length) ? $(options.parentEl) : $(this.parentEl);
        if (this.showCalendar) {
            this.container = $(options.template).appendTo(this.parentEl);
        } else {
            this.container = $(options.template).appendTo($('body'));
        }


        //
        // handle all the possible options overriding defaults
        //
        if (typeof options.locale === 'object') {

            if (typeof options.locale.direction === 'string')
                this.locale.direction = options.locale.direction;

            if (typeof options.locale.separator === 'string')
                this.locale.separator = options.locale.separator;

            if (typeof options.locale.daysOfWeek === 'object')
                this.locale.daysOfWeek = options.locale.daysOfWeek.slice();

            if (typeof options.locale.monthNames === 'object')
                this.locale.monthNames = options.locale.monthNames.slice();

            if (typeof options.locale.firstDay === 'number')
                this.locale.firstDay = options.locale.firstDay;

            if (typeof options.locale.applyLabel === 'string')
                this.locale.applyLabel = options.locale.applyLabel;

            if (typeof options.locale.cancelLabel === 'string')
                this.locale.cancelLabel = options.locale.cancelLabel;

            if (typeof options.locale.weekLabel === 'string')
                this.locale.weekLabel = options.locale.weekLabel;

            if (typeof options.locale.customRangeLabel === 'string')
                this.locale.customRangeLabel = options.locale.customRangeLabel;

        }
        this.container.addClass(this.locale.direction);

        if (typeof options.startDate === 'string')
            this.startDate = moment(options.startDate, this.locale.format);

        if (typeof options.endDate === 'string')
            this.endDate = moment(options.endDate, this.locale.format);

        if (typeof options.minDate === 'string')
            this.minDate = moment(options.minDate, this.locale.format);

        if (typeof options.maxDate === 'string')
            this.maxDate = moment(options.maxDate, this.locale.format);

        if (typeof options.startDate === 'object')
            this.startDate = moment(options.startDate);

        if (typeof options.endDate === 'object')
            this.endDate = moment(options.endDate);

        if (typeof options.minDate === 'object')
            this.minDate = moment(options.minDate);

        if (typeof options.maxDate === 'object')
            this.maxDate = moment(options.maxDate);

        // sanity check for bad options
        if (this.minDate && this.startDate.isBefore(this.minDate))
            this.startDate = this.minDate.clone();

        // sanity check for bad options
        if (this.maxDate && this.endDate.isAfter(this.maxDate))
            this.endDate = this.maxDate.clone();

        if (typeof options.applyClass === 'string')
            this.applyClass = options.applyClass;

        if (typeof options.cancelClass === 'string')
            this.cancelClass = options.cancelClass;

        if (typeof options.dateLimit === 'object')
            this.dateLimit = options.dateLimit;

        if (typeof options.opens === 'string')
            this.opens = options.opens;

        if (typeof options.drops === 'string')
            this.drops = options.drops;

        if (typeof options.showWeekNumbers === 'boolean')
            this.showWeekNumbers = options.showWeekNumbers;

        if (typeof options.showISOWeekNumbers === 'boolean')
            this.showISOWeekNumbers = options.showISOWeekNumbers;

        if (typeof options.buttonClasses === 'string')
            this.buttonClasses = options.buttonClasses;

        if (typeof options.buttonClasses === 'object')
            this.buttonClasses = options.buttonClasses.join(' ');

        if (typeof options.showDropdowns === 'boolean')
            this.showDropdowns = options.showDropdowns;

        if (typeof options.showCustomRangeLabel === 'boolean')
            this.showCustomRangeLabel = options.showCustomRangeLabel;

        if (typeof options.singleDatePicker === 'boolean') {
            this.singleDatePicker = options.singleDatePicker;
            if (this.singleDatePicker)
                this.endDate = this.startDate.clone();
        }

        if (typeof options.timePicker === 'boolean')
            this.timePicker = options.timePicker;

        if (typeof options.timePickerSeconds === 'boolean')
            this.timePickerSeconds = options.timePickerSeconds;

        if (typeof options.timePickerIncrement === 'number')
            this.timePickerIncrement = options.timePickerIncrement;

        if (typeof options.timePicker24Hour === 'boolean')
            this.timePicker24Hour = options.timePicker24Hour;

        if (typeof options.autoApply === 'boolean')
            this.autoApply = options.autoApply;

        if (typeof options.autoUpdateInput === 'boolean')
            this.autoUpdateInput = options.autoUpdateInput;

        if (typeof options.linkedCalendars === 'boolean')
            this.linkedCalendars = options.linkedCalendars;

        if (typeof options.isInvalidDate === 'function')
            this.isInvalidDate = options.isInvalidDate;

        if (typeof options.isCustomDate === 'function')
            this.isCustomDate = options.isCustomDate;

        if (typeof options.alwaysShowCalendars === 'boolean')
            this.alwaysShowCalendars = options.alwaysShowCalendars;

        // update day names order to firstDay
        if (this.locale.firstDay != 0) {
            var iterator = this.locale.firstDay;
            while (iterator > 0) {
                this.locale.daysOfWeek.push(this.locale.daysOfWeek.shift());
                iterator--;
            }
        }

        this.locale.format = this.dateFormat + ' ' + this.timeFormat;

        var start, end, range;

        //if no start/end dates set, check if an input element contains initial values
        if (typeof options.startDate === 'undefined' && typeof options.endDate === 'undefined') {
            if ($(this.element).is('input[type=text]')) {
                var val   = $(this.element).val(),
                    split = val.split(this.locale.separator);
                start     = end = null;

                if (split.length == 2) {
                    start = moment(split[0], this.locale.format);
                    end   = moment(split[1], this.locale.format);
                } else if (this.singleDatePicker && val !== "") {
                    start = moment(val, this.locale.format);
                    end   = moment(val, this.locale.format);
                }
                if (start !== null && end !== null) {
                    this.setStartDate(start);
                    this.setEndDate(end);
                }
            }
        }

        if (typeof options.ranges === 'object') {
            for (range in options.ranges) {

                if (typeof options.ranges[range][0] === 'string')
                    start = moment(options.ranges[range][0], this.locale.format);
                else
                    start = moment(options.ranges[range][0]);

                if (typeof options.ranges[range][1] === 'string')
                    end = moment(options.ranges[range][1], this.locale.format);
                else
                    end = moment(options.ranges[range][1]);

                // If the start or end date exceed those allowed by the minDate or dateLimit
                // options, shorten the range to the allowable period.
                if (this.minDate && start.isBefore(this.minDate))
                    start = this.minDate.clone();

                var maxDate = this.maxDate;
                if (this.dateLimit && maxDate && start.clone().add(this.dateLimit).isAfter(maxDate))
                    maxDate = start.clone().add(this.dateLimit);
                if (maxDate && end.isAfter(maxDate))
                    end = maxDate.clone();

                // If the end of the range is before the minimum or the start of the range is
                // after the maximum, don't display this range option at all.
                if ((this.minDate && end.isBefore(this.minDate, this.timepicker ? 'minute' : 'day'))
                    || (maxDate && start.isAfter(maxDate, this.timepicker ? 'minute' : 'day')))
                    continue;

                //Support unicode chars in the range names.
                var elem       = document.createElement('textarea');
                elem.innerHTML = range;
                var rangeHtml  = elem.value;

                this.ranges[rangeHtml] = [start, end];
            }

            var list = '<ul>';
            for (range in this.ranges) {
                list += '<li data-range-key="' + range + '">' + range + '</li>';
            }
            if (this.showCustomRangeLabel) {
                list += '<li data-range-key="' + this.locale.customRangeLabel + '">' + this.locale.customRangeLabel + '</li>';
            }
            list += '</ul>';
            this.container.find('.ranges').prepend(list);
        }

        if (typeof cb === 'function') {
            this.callback = cb;
        }

        if (!this.timePicker) {
            this.startDate = this.startDate.startOf('day');
            this.endDate   = this.endDate.endOf('day');
            this.container.find('.calendar-time').hide();
        }

        //can't be used together for now
        if (this.timePicker && this.autoApply)
            this.autoApply = false;

        if (this.autoApply && typeof options.ranges !== 'object') {
            this.container.find('.ranges').hide();
        } else if (this.autoApply) {
            this.container.find('.applyBtn, .cancelBtn').addClass('hide');
        }

        if (this.singleDatePicker) {
            this.container.addClass('single');
            this.container.find('.calendar.left').addClass('single');
            this.container.find('.calendar.left').show();
            this.container.find('.calendar.right').hide();
            this.container.find('.daterangepicker_input input, .daterangepicker_input > i').hide();
            if (this.timePicker) {
                this.container.find('.ranges ul').hide();
            } else {
                this.container.find('.ranges').hide();
            }
        }

        this.container.find('.input-mini').hide();

        if ((typeof options.ranges === 'undefined' && !this.singleDatePicker) || this.alwaysShowCalendars) {
            this.container.addClass('show-calendar');
        }

        this.container.addClass('opens' + this.opens);

        //swap the position of the predefined ranges if opens right
        if (typeof options.ranges !== 'undefined' && this.opens == 'right') {
            this.container.find('.ranges').prependTo(this.container.find('.calendar.left').parent());
        }

        //apply CSS classes and labels to buttons
        this.container.find('.applyBtn, .cancelBtn').addClass(this.buttonClasses);
        if (this.applyClass.length)
            this.container.find('.applyBtn').addClass(this.applyClass);
        if (this.cancelClass.length)
            this.container.find('.cancelBtn').addClass(this.cancelClass);
        this.container.find('.applyBtn').html(this.locale.applyLabel);
        this.container.find('.cancelBtn').html(this.locale.cancelLabel);
        //
        // event listeners
        //

        this.container.find('.calendar')
            .on('click.daterangepicker', '.prev', $.proxy(this.clickPrev, this))
            .on('click.daterangepicker', '.next', $.proxy(this.clickNext, this))
            .on('click.daterangepicker', '.btn-today', $.proxy(this.clickToday, this))
            .on('mousedown.daterangepicker', 'td.available .date', $.proxy(this.clickDate, this))
            .on('mouseenter.daterangepicker', 'td.available .date', $.proxy(this.hoverDate, this))
            .on('mouseleave.daterangepicker', 'td.available .date', $.proxy(this.updateFormInputs, this))
            .on('change.daterangepicker', 'select.yearselect', $.proxy(this.monthOrYearChanged, this))
            .on('change.daterangepicker', 'select.monthselect', $.proxy(this.monthOrYearChanged, this))
            .on('change.daterangepicker', 'select.hourselect,select.minuteselect,select.secondselect,select.ampmselect', $.proxy(this.timeChanged, this))
            .on('click.daterangepicker', '.daterangepicker_input input', $.proxy(this.showCalendars, this))
            .on('focus.daterangepicker', '.daterangepicker_input input', $.proxy(this.formInputsFocused, this))
            .on('blur.daterangepicker', '.daterangepicker_input input', $.proxy(this.formInputsBlurred, this))
            .on('change.daterangepicker', '.daterangepicker_input input', $.proxy(this.formInputsChanged, this));

        this.container.find('.ranges')
            .on('click.daterangepicker', 'button.applyBtn', $.proxy(this.clickApply, this))
            .on('click.daterangepicker', 'button.cancelBtn', $.proxy(this.clickCancel, this))
            .on('click.daterangepicker', 'li', $.proxy(this.clickRange, this))
            .on('mouseenter.daterangepicker', 'li', $.proxy(this.hoverRange, this))
            .on('mouseleave.daterangepicker', 'li', $.proxy(this.updateFormInputs, this));

        if (this.element.is('input') || this.element.is('button')) {
            this.element.on({
                'click.daterangepicker'  : $.proxy(this.show, this),
                'focus.daterangepicker'  : $.proxy(this.show, this),
                'keyup.daterangepicker'  : $.proxy(this.elementChanged, this),
                'keydown.daterangepicker': $.proxy(this.keydown, this)
            });
        } else {
            this.element.on('click.daterangepicker', $.proxy(this.toggle, this));
        }

        //
        // if attached to a text input, set the initial value
        //

        if (this.element.is('input') && !this.singleDatePicker && this.autoUpdateInput) {
            this.element.val(this.startDate.format(this.locale.format) + this.locale.separator + this.endDate.format(this.locale.format));
            this.element.trigger('change');
        } else if (this.element.is('input') && this.autoUpdateInput) {
            this.element.val(this.startDate.format(this.locale.format));
            this.element.trigger('change');
        }

    };

    DateRangePicker.prototype = {

        constructor: DateRangePicker,

        setStartDate: function (startDate) {
            if (typeof startDate === 'string')
                this.startDate = moment(startDate, this.locale.format);

            if (typeof startDate === 'object')
                this.startDate = moment(startDate);

            if (!this.timePicker)
                this.startDate = this.startDate.startOf('day');

            if (this.timePicker && this.timePickerIncrement)
                this.startDate.minute(Math.round(this.startDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);

            if (this.minDate && this.startDate.isBefore(this.minDate)) {
                this.startDate = this.minDate;
                if (this.timePicker && this.timePickerIncrement)
                    this.startDate.minute(Math.round(this.startDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);
            }

            if (this.maxDate && this.startDate.isAfter(this.maxDate)) {
                this.startDate = this.maxDate;
                if (this.timePicker && this.timePickerIncrement)
                    this.startDate.minute(Math.floor(this.startDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);
            }

            if (!this.isShowing)
                this.updateElement();

            this.updateMonthsInView();
        },

        setEndDate: function (endDate) {
            if (typeof endDate === 'string')
                this.endDate = moment(endDate, this.locale.format);

            if (typeof endDate === 'object')
                this.endDate = moment(endDate);

            if (!this.timePicker)
                this.endDate = this.endDate.endOf('day');

            if (this.timePicker && this.timePickerIncrement)
                this.endDate.minute(Math.round(this.endDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);

            if (this.endDate.isBefore(this.startDate))
                this.endDate = this.startDate.clone();

            if (this.maxDate && this.endDate.isAfter(this.maxDate))
                this.endDate = this.maxDate;

            if (this.dateLimit && this.startDate.clone().add(this.dateLimit).isBefore(this.endDate))
                this.endDate = this.startDate.clone().add(this.dateLimit);

            this.previousRightTime = this.endDate.clone();

            if (!this.isShowing)
                this.updateElement();

            this.updateMonthsInView();
        },

        isInvalidDate: function () {
            return false;
        },

        isCustomDate: function () {
            return false;
        },

        updateView: function () {
            if (this.timePicker) {
                this.renderTimePicker('left');
                this.renderTimePicker('right');
                if (!this.endDate) {
                    this.container.find('.right .calendar-time select').attr('disabled', 'disabled').addClass('disabled');
                } else {
                    this.container.find('.right .calendar-time select').removeAttr('disabled').removeClass('disabled');
                }
            }
            if (this.endDate) {
                this.container.find('input[name="daterangepicker_end"]').removeClass('active');
                this.container.find('input[name="daterangepicker_start"]').addClass('active');
            } else {
                this.container.find('input[name="daterangepicker_end"]').addClass('active');
                this.container.find('input[name="daterangepicker_start"]').removeClass('active');
            }
            this.updateMonthsInView();
            this.updateCalendars();

            this.updateFormInputs();
        },

        updateMonthsInView: function () {
            if (this.endDate) {

                //if both dates are visible already, do nothing
                if (!this.singleDatePicker && this.leftCalendar.month && this.rightCalendar.month &&
                    (this.startDate.format('YYYY-MM') == this.leftCalendar.month.format('YYYY-MM') || this.startDate.format('YYYY-MM') == this.rightCalendar.month.format('YYYY-MM'))
                    &&
                    (this.endDate.format('YYYY-MM') == this.leftCalendar.month.format('YYYY-MM') || this.endDate.format('YYYY-MM') == this.rightCalendar.month.format('YYYY-MM'))
                ) {
                    return;
                }

                this.leftCalendar.month = this.startDate.clone().date(2);
                if (!this.linkedCalendars && (this.endDate.month() != this.startDate.month() || this.endDate.year() != this.startDate.year())) {
                    this.rightCalendar.month = this.endDate.clone().date(2);
                } else {
                    this.rightCalendar.month = this.startDate.clone().date(2).add(1, 'month');
                }

            } else {
                if (this.leftCalendar.month.format('YYYY-MM') != this.startDate.format('YYYY-MM') && this.rightCalendar.month.format('YYYY-MM') != this.startDate.format('YYYY-MM')) {
                    this.leftCalendar.month  = this.startDate.clone().date(2);
                    this.rightCalendar.month = this.startDate.clone().date(2).add(1, 'month');
                }
            }
            if (this.maxDate && this.linkedCalendars && !this.singleDatePicker && this.rightCalendar.month > this.maxDate) {
                this.rightCalendar.month = this.maxDate.clone().date(2);
                this.leftCalendar.month  = this.maxDate.clone().date(2).subtract(1, 'month');
            }
        },

        updateCalendars: function () {

            if (this.timePicker) {
                var hour, minute, second;
                if (this.endDate) {
                    hour   = parseInt(this.container.find('.left .hourselect').val(), 10);
                    minute = parseInt(this.container.find('.left .minuteselect').val(), 10);
                    second = this.timePickerSeconds ? parseInt(this.container.find('.left .secondselect').val(), 10) : 0;
                    if (!this.timePicker24Hour) {
                        var ampm = this.container.find('.left .ampmselect').val();
                        if (ampm === 'PM' && hour < 12)
                            hour += 12;
                        if (ampm === 'AM' && hour === 12)
                            hour = 0;
                    }
                } else {
                    hour   = parseInt(this.container.find('.right .hourselect').val(), 10);
                    minute = parseInt(this.container.find('.right .minuteselect').val(), 10);
                    second = this.timePickerSeconds ? parseInt(this.container.find('.right .secondselect').val(), 10) : 0;
                    if (!this.timePicker24Hour) {
                        var ampm = this.container.find('.right .ampmselect').val();
                        if (ampm === 'PM' && hour < 12)
                            hour += 12;
                        if (ampm === 'AM' && hour === 12)
                            hour = 0;
                    }
                }
                this.leftCalendar.month.hour(hour).minute(minute).second(second);
                this.rightCalendar.month.hour(hour).minute(minute).second(second);
            }

            this.createCalendarData('left');
            if (this.clickedDate) {
                this.renderCalendar('left');
                if (!this.singleDatePicker) {
                    this.createCalendarData('right');
                    this.renderCalendar('right');
                }
                this.clickedDate = false;
            } else {
                if (typeof  this.fetchEvents == 'function') {
                    if (!this.singleDatePicker) {
                        this.createCalendarData('right');
                    }
                    if (this.singleDatePicker) {
                        this.fetchEvents(this.leftCalendar.calendar[0][0], this.leftCalendar.calendar[5][6], this, this.setEvents);
                    } else {
                        this.fetchEvents(this.leftCalendar.calendar[0][0], this.rightCalendar.calendar[5][6], this, this.setEvents);
                    }
                } else {
                    this.renderCalendar('left');
                    if (!this.singleDatePicker) {
                        this.renderCalendar('right');
                    }
                }
            }
            //highlight any predefined range matching the current start and end dates
            this.container.find('.ranges li').removeClass('active');
            if (this.endDate == null) return;

            this.calculateChosenLabel();
        },

        createCalendarData: function (side) {
//
            // Build the matrix of dates that will populate the calendar
            //
            var calendar        = side == 'left' ? this.leftCalendar : this.rightCalendar;
            var month           = calendar.month.month();
            var year            = calendar.month.year();
            var hour            = calendar.month.hour();
            var minute          = calendar.month.minute();
            var second          = calendar.month.second();
            var daysInMonth     = moment([year, month]).daysInMonth();
            var firstDay        = moment([year, month, 1]);
            var lastDay         = moment([year, month, daysInMonth]);
            var lastMonth       = moment(firstDay).subtract(1, 'month').month();
            var lastYear        = moment(firstDay).subtract(1, 'month').year();
            var daysInLastMonth = moment([lastYear, lastMonth]).daysInMonth();
            var dayOfWeek       = firstDay.day();

            //initialize a 6 rows x 7 columns array for the calendar
            var calendar      = [];
            calendar.firstDay = firstDay;
            calendar.lastDay  = lastDay;

            for (var i = 0; i < 6; i++) {
                calendar[i] = [];
            }

            //populate the calendar with date objects
            var startDay = daysInLastMonth - dayOfWeek + this.locale.firstDay + 1;
            if (startDay > daysInLastMonth)
                startDay -= 7;

            if (dayOfWeek == this.locale.firstDay)
                startDay = daysInLastMonth - 6;

            var curDate = moment([lastYear, lastMonth, startDay, 12, minute, second]);

            var col, row;
            for (var i = 0, col = 0, row = 0; i < 42; i++, col++, curDate = moment(curDate).add(24, 'hour')) {
                if (i > 0 && col % 7 === 0) {
                    col = 0;
                    row++;
                }
                calendar[row][col] = curDate.clone().hour(hour).minute(minute).second(second);
                curDate.hour(12);

                if (this.minDate && calendar[row][col].format('YYYY-MM-DD') == this.minDate.format('YYYY-MM-DD') && calendar[row][col].isBefore(this.minDate) && side == 'left') {
                    calendar[row][col] = this.minDate.clone();
                }

                if (this.maxDate && calendar[row][col].format('YYYY-MM-DD') == this.maxDate.format('YYYY-MM-DD') && calendar[row][col].isAfter(this.maxDate) && side == 'right') {
                    calendar[row][col] = this.maxDate.clone();
                }
            }

            //make the calendar object available to hoverDate/clickDate
            if (side == 'left') {
                this.leftCalendar.calendar = calendar;
            } else {
                if (side == 'right' && !this.singleDatePicker) {
                    this.rightCalendar.calendar = calendar;
                }
            }
        },
        setEvents         : function (events, el) {
            el.allEvents = events;
            el.renderCalendar('left');
            if (!el.singleDatePicker) {
                el.renderCalendar('right');
            }
        },
        renderCalendar    : function (side) {
            this.createCalendarData(side);
            var calendar = {};
            if (side == 'left') {
                calendar = this.leftCalendar.calendar;
            } else {
                calendar = this.rightCalendar.calendar;
            }
            //
            // Display the calendar
            //

            var minDate  = side == 'left' ? this.minDate : this.startDate;
            var maxDate  = this.maxDate;
            var selected = side == 'left' ? this.startDate : this.endDate;
            var arrow    = this.locale.direction == 'ltr' ? {
                left : 'chevron-left',
                right: 'chevron-right'
            } : {left: 'chevron-right', right: 'chevron-left'};

            var dateHtml = '<div class="calendar-header">' + this.locale.monthNames[calendar[1][1].month()] + calendar[1][1].format(" YYYY") + '</div>';

            var currentMonth = calendar[1][1].month();
            if (this.showDropdowns) {
                var currentYear = calendar[1][1].year();
                var maxYear     = (maxDate && maxDate.year()) || (currentYear + 5);
                var minYear     = (minDate && minDate.year()) || (currentYear - 50);
                var inMinYear   = currentYear == minYear;
                var inMaxYear   = currentYear == maxYear;

                var monthHtml = '<select class="monthselect">';
                for (var m = 0; m < 12; m++) {
                    if ((!inMinYear || m >= minDate.month()) && (!inMaxYear || m <= maxDate.month())) {
                        monthHtml += "<option value='" + m + "'" +
                            (m === currentMonth ? " selected='selected'" : "") +
                            ">" + this.locale.monthNames[m] + "</option>";
                    } else {
                        monthHtml += "<option value='" + m + "'" +
                            (m === currentMonth ? " selected='selected'" : "") +
                            " disabled='disabled'>" + this.locale.monthNames[m] + "</option>";
                    }
                }
                monthHtml += "</select>";

                var yearHtml = '<select class="yearselect">';
                for (var y = minYear; y <= maxYear; y++) {
                    yearHtml += '<option value="' + y + '"' +
                        (y === currentYear ? ' selected="selected"' : '') +
                        '>' + y + '</option>';
                }
                yearHtml += '</select>';

                dateHtml = '<div class="calendar-header"><h2>' + monthHtml + '</h2> ' + '<h5>' + yearHtml + '</h5></div>';
            }
            var html = '<table class="table-condensed">';
            html += '<thead>';
            html += '<tr>';

            // add empty cell for week number
            if (this.showWeekNumbers || this.showISOWeekNumbers)
                html += '<th></th>';

            if ((!minDate || minDate.isBefore(calendar.firstDay)) && (!this.linkedCalendars || side == 'left')) {
                html += '<th class="prev available"><i class="fa fa-' + arrow.left + ' glyphicon glyphicon-' + arrow.left + '"></i></th>';
            } else {
                html += '<th></th>';
            }

            var dateHtml = this.locale.monthNames[calendar[1][1].month()] + calendar[1][1].format(" YYYY");

            if (this.showDropdowns) {
                var currentMonth = calendar[1][1].month();
                var currentYear  = calendar[1][1].year();
                var maxYear      = (maxDate && maxDate.year()) || (currentYear + 5);
                var minYear      = (minDate && minDate.year()) || (currentYear - 50);
                var inMinYear    = currentYear == minYear;
                var inMaxYear    = currentYear == maxYear;

                var monthHtml = '<select class="monthselect">';
                for (var m = 0; m < 12; m++) {
                    if ((!inMinYear || m >= minDate.month()) && (!inMaxYear || m <= maxDate.month())) {
                        monthHtml += "<option value='" + m + "'" +
                            (m === currentMonth ? " selected='selected'" : "") +
                            ">" + this.locale.monthNames[m] + "</option>";
                    } else {
                        monthHtml += "<option value='" + m + "'" +
                            (m === currentMonth ? " selected='selected'" : "") +
                            " disabled='disabled'>" + this.locale.monthNames[m] + "</option>";
                    }
                }
                monthHtml += "</select>";

                var yearHtml = '<select class="yearselect">';
                for (var y = minYear; y <= maxYear; y++) {
                    yearHtml += '<option value="' + y + '"' +
                        (y === currentYear ? ' selected="selected"' : '') +
                        '>' + y + '</option>';
                }
                yearHtml += '</select>';

                dateHtml = monthHtml + yearHtml;
            }

            html += '<th colspan="5" class="month">' + dateHtml + '</th>';
            if ((!maxDate || maxDate.isAfter(calendar.lastDay)) && (!this.linkedCalendars || side == 'right' || this.singleDatePicker)) {
                html += '<th class="next available"><i class="fa fa-' + arrow.right + ' glyphicon glyphicon-' + arrow.right + '"></i></th>';
            } else {
                html += '<th></th>';
            }

            html += '</tr>';
            html += '<tr>';

            // add week number label
            if (this.showWeekNumbers || this.showISOWeekNumbers)
                html += '<th class="week">' + this.locale.weekLabel + '</th>';

            $.each(this.locale.daysOfWeek, function (index, dayOfWeek) {
                html += '<th class="day-off-week">' + dayOfWeek + '</th>';
            });

            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //adjust maxDate to reflect the dateLimit setting in order to
            //grey out end dates beyond the dateLimit
            if (this.endDate == null && this.dateLimit) {
                var maxLimit = this.startDate.clone().add(this.dateLimit).endOf('day');
                if (!maxDate || maxLimit.isBefore(maxDate)) {
                    maxDate = maxLimit;
                }
            }

            for (var row = 0; row < 6; row++) {
                html += '<tr>';

                // add week number
                if (this.showWeekNumbers)
                    html += '<td class="week">' + calendar[row][0].week() + '</td>';
                else if (this.showISOWeekNumbers)
                    html += '<td class="week">' + calendar[row][0].isoWeek() + '</td>';

                for (var col = 0; col < 7; col++) {

                    var classes = [];

                    //highlight today's date
                    if (calendar[row][col].isSame(new Date(), "day"))
                        classes.push('today');
                    //hightlight minimum day from today
                    if (this.minimumCheckin > 0) {
                        for (var _i = 0; _i < this.minimumCheckin; _i++) {
                            var _today = new Date(new Date().getTime() + (_i * 24 * 60 * 60 * 1000));
                            if (calendar[row][col].isSame(_today, "day")) {
                                classes.push('off', 'disabled');
                            }
                        }
                    }
                    //highlight weekends
                    if (calendar[row][col].isoWeekday() > 5)
                        classes.push('weekend');

                    //grey out the dates in other months displayed at beginning and end of this calendar
                    if (calendar[row][col].month() != calendar[1][1].month())
                        classes.push('off');

                    //don't allow selection of dates before the minimum date
                    if (this.minDate && calendar[row][col].isBefore(this.minDate, 'day'))
                        classes.push('off', 'disabled');

                    //don't allow selection of dates after the maximum date
                    if (maxDate && calendar[row][col].isAfter(maxDate, 'day'))
                        classes.push('off', 'disabled');

                    //don't allow selection of date if a custom function decides it's invalid
                    if (this.isInvalidDate(calendar[row][col]))
                        classes.push('off', 'disabled');

                    //highlight the currently selected start date
                    if (calendar[row][col].format('YYYY-MM-DD') == this.startDate.format('YYYY-MM-DD'))
                        classes.push('active', 'start-date');
                    //highlight the currently selected end date
                    if (this.endDate != null && calendar[row][col].format('YYYY-MM-DD') == this.endDate.format('YYYY-MM-DD'))
                        classes.push('active', 'end-date');

                    //highlight dates in-between the selected dates
                    if (this.endDate != null && calendar[row][col] > this.startDate && calendar[row][col] < this.endDate)
                        classes.push('in-range');

                    //disabled dates
                    if (this.disabledDates != null) {
                        var currentDate = calendar[row][col].format('YYYY-MM-DD');
                        if (this.disabledDates.indexOf(currentDate) != -1) {
                            classes.push('off', 'disabled');
                        }
                    }
                    var in_pass = false;
                    if (this.disabledPast) {
                        var currentDate = calendar[row][col].format('YYYY-MM-DD');
                        var today       = moment().format('YYYY-MM-DD');
                        if (currentDate < today) {
                            classes.push('off', 'disabled');
                            in_pass = true;
                        }
                    }
                    var event_html  = '',
                        event_class = '';

                    for (i = 0; i < this.allEvents.length; i++) {
                        var currentDate = calendar[row][col],
                            start       = moment(this.allEvents[i].start, 'YYYY-MM-DD'),
                            end         = moment(this.allEvents[i].end, 'YYYY-MM-DD');
                        if (start.isSame(currentDate, 'day') || end.isSame(currentDate, 'day') || ( currentDate.isAfter(start) && currentDate.isBefore(end) )) {
                            if (this.showEventTooltip) {
                                event_class = 'event-tooltip';
                                event_html  = '<div class="event-tooltip-wrap"><div class="' + event_class + ' event event-' + row + '-' + col + '">' + this.allEvents[i].event + '</div>';
                            } else {
                                event_html = '<div class="event event-' + row + '-' + col + '">' + this.allEvents[i].event + '</div>';
                            }
                            if (typeof this.allEvents[i].status == 'string' && this.allEvents[i].status == 'not_available') {
                                if (typeof this.classNotAvailable == 'object') {
                                    $.each(this.classNotAvailable, function (index, val) {
                                        classes.push(val);
                                    });
                                } else {
                                    classes.push('not-available');
                                }

                            } else {
                                if (in_pass) {
                                    classes.push('not-available');
                                }
                            }
                        }

                    }

                    //apply custom classes for this date
                    var isCustom = this.isCustomDate(calendar[row][col]);
                    if (isCustom !== false) {
                        if (typeof isCustom === 'string')
                            classes.push(isCustom);
                        else
                            Array.prototype.push.apply(classes, isCustom);
                    }

                    var cname = '', disabled = false;
                    for (var i = 0; i < classes.length; i++) {
                        cname += classes[i] + ' ';
                        if (classes[i] == 'disabled')
                            disabled = true;
                    }
                    if (!disabled)
                        cname += ' available';
                    if (event_html) {
                        cname += ' has-event';
                    }
                    if (this.showEventTooltip) {
                        cname += ' has-tooltip';
                    }
                    html += '<td class="td-date ' + cname.replace(/^\s+|\s+$/g, '') + '"' + ' data-title="' + 'r' + row + 'c' + col + '">' + '<div class="date">' + calendar[row][col].date() + '</div>' + event_html + '</td>';

                }
                html += '</tr>';
            }

            html += '</tbody>';
            html += '</table>';
            if (this.showTodayButton && side == 'left') {
                html += '<a href="javascript: void(0);" class="button button-default btn btn-success btn-small btn-today">' + this.locale.today + '</a>';
            }
            if (side == 'left') {
                this.container.find('.calendar.left .calendar-table').html(html);
            }

            if (!this.singleDatePicker && side == 'right') {
                this.container.find('.calendar.right .calendar-table').html(html);
            }

        },

        renderTimePicker: function (side) {

            // Don't bother updating the time picker if it's currently disabled
            // because an end date hasn't been clicked yet
            if (side == 'right' && !this.endDate) return;

            var html, selected, minDate, maxDate = this.maxDate;

            if (this.dateLimit && (!this.maxDate || this.startDate.clone().add(this.dateLimit).isAfter(this.maxDate)))
                maxDate = this.startDate.clone().add(this.dateLimit);

            if (side == 'left') {
                selected = this.startDate.clone();
                minDate  = this.minDate;
            } else if (side == 'right') {
                selected = this.endDate.clone();
                minDate  = this.startDate;

                //Preserve the time already selected
                var timeSelector = this.container.find('.calendar.right .calendar-time div');
                if (!this.endDate && timeSelector.html() != '') {

                    selected.hour(timeSelector.find('.hourselect option:selected').val() || selected.hour());
                    selected.minute(timeSelector.find('.minuteselect option:selected').val() || selected.minute());
                    selected.second(timeSelector.find('.secondselect option:selected').val() || selected.second());

                    if (!this.timePicker24Hour) {
                        var ampm = timeSelector.find('.ampmselect option:selected').val();
                        if (ampm === 'PM' && selected.hour() < 12)
                            selected.hour(selected.hour() + 12);
                        if (ampm === 'AM' && selected.hour() === 12)
                            selected.hour(0);
                    }

                }

                if (selected.isBefore(this.startDate))
                    selected = this.startDate.clone();

                if (maxDate && selected.isAfter(maxDate))
                    selected = maxDate.clone();

            }

            //
            // hours
            //

            html = '<select class="select-dropdown hourselect">';

            var start = this.timePicker24Hour ? 0 : 1;
            var end   = this.timePicker24Hour ? 23 : 12;

            for (var i = start; i <= end; i++) {
                var i_in_24 = i;
                if (!this.timePicker24Hour)
                    i_in_24 = selected.hour() >= 12 ? (i == 12 ? 12 : i + 12) : (i == 12 ? 0 : i);

                var time     = selected.clone().hour(i_in_24);
                var disabled = false;
                if (minDate && time.minute(59).isBefore(minDate))
                    disabled = true;
                if (maxDate && time.minute(0).isAfter(maxDate))
                    disabled = true;

                if (i_in_24 == selected.hour() && !disabled) {
                    html += '<option value="' + i + '" selected="selected">' + i + '</option>';
                } else if (disabled) {
                    html += '<option value="' + i + '" disabled="disabled" class="disabled">' + i + '</option>';
                } else {
                    html += '<option value="' + i + '">' + i + '</option>';
                }
            }

            html += '</select> ';

            //
            // minutes
            //

            html += ': <select class="select-dropdown minuteselect">';

            for (var i = 0; i < 60; i += this.timePickerIncrement) {
                var padded = i < 10 ? '0' + i : i;
                var time   = selected.clone().minute(i);

                var disabled = false;
                if (minDate && time.second(59).isBefore(minDate))
                    disabled = true;
                if (maxDate && time.second(0).isAfter(maxDate))
                    disabled = true;

                if (selected.minute() == i && !disabled) {
                    html += '<option value="' + i + '" selected="selected">' + padded + '</option>';
                } else if (disabled) {
                    html += '<option value="' + i + '" disabled="disabled" class="disabled">' + padded + '</option>';
                } else {
                    html += '<option value="' + i + '">' + padded + '</option>';
                }
            }

            html += '</select> ';

            //
            // seconds
            //

            if (this.timePickerSeconds) {
                html += ': <select class="select-dropdown secondselect">';

                for (var i = 0; i < 60; i++) {
                    var padded = i < 10 ? '0' + i : i;
                    var time   = selected.clone().second(i);

                    var disabled = false;
                    if (minDate && time.isBefore(minDate))
                        disabled = true;
                    if (maxDate && time.isAfter(maxDate))
                        disabled = true;

                    if (selected.second() == i && !disabled) {
                        html += '<option value="' + i + '" selected="selected">' + padded + '</option>';
                    } else if (disabled) {
                        html += '<option value="' + i + '" disabled="disabled" class="disabled">' + padded + '</option>';
                    } else {
                        html += '<option value="' + i + '">' + padded + '</option>';
                    }
                }

                html += '</select> ';
            }

            //
            // AM/PM
            //

            if (!this.timePicker24Hour) {
                html += '<select class="select-dropdown ampmselect">';

                var am_html = '';
                var pm_html = '';

                if (minDate && selected.clone().hour(12).minute(0).second(0).isBefore(minDate))
                    am_html = ' disabled="disabled" class="disabled"';

                if (maxDate && selected.clone().hour(0).minute(0).second(0).isAfter(maxDate))
                    pm_html = ' disabled="disabled" class="disabled"';

                if (selected.hour() >= 12) {
                    html += '<option value="AM"' + am_html + '>AM</option><option value="PM" selected="selected"' + pm_html + '>PM</option>';
                } else {
                    html += '<option value="AM" selected="selected"' + am_html + '>AM</option><option value="PM"' + pm_html + '>PM</option>';
                }

                html += '</select>';
            }

            this.container.find('.calendar.' + side + ' .calendar-time div').html(html);

        },

        updateFormInputs: function () {

            //ignore mouse movements while an above-calendar text input has focus
            if (this.container.find('input[name=daterangepicker_start]').is(":focus") || this.container.find('input[name=daterangepicker_end]').is(":focus"))
                return;

            this.container.find('input[name=daterangepicker_start]').val(this.startDate.format(this.locale.format));
            if (this.endDate)
                this.container.find('input[name=daterangepicker_end]').val(this.endDate.format(this.locale.format));

            if (this.singleDatePicker || (this.endDate && (this.startDate.isBefore(this.endDate) || this.startDate.isSame(this.endDate)))) {
                this.container.find('button.applyBtn').removeAttr('disabled');
            } else {
                this.container.find('button.applyBtn').attr('disabled', 'disabled');
            }

        },

        move: function () {
            var parentOffset    = {top: 0, left: 0},
                containerTop;
            var parentRightEdge = $(window).width();
            if (!this.parentEl.is('body')) {
                parentOffset    = {
                    top : this.parentEl.offset().top - this.parentEl.scrollTop(),
                    left: this.parentEl.offset().left - this.parentEl.scrollLeft()
                };
                parentRightEdge = this.parentEl[0].clientWidth + this.parentEl.offset().left;
            }

            if (this.drops == 'up')
                containerTop = this.element.offset().top - this.container.outerHeight() - parentOffset.top;
            else
                containerTop = this.element.offset().top + this.element.outerHeight() - parentOffset.top;
            this.container[this.drops == 'up' ? 'addClass' : 'removeClass']('dropup');
            if (this.positionFixed) {
                if (this.container.hasClass('moveleft')) {
                    this.container.css({
                        top  : this.parentEl.offset().top + this.parentEl.height(),
                        left : this.parentEl.offset().left - this.parentEl.width(),
                        right: 'auto'
                    });
                } else {
                    this.container.css({
                        top  : this.parentEl.offset().top + this.parentEl.height(),
                        left : this.parentEl.offset().left,
                        right: 'auto'
                    });
                }

            } else {
                if (this.opens == 'left') {
                    this.container.css({
                        top  : containerTop,
                        right: parentRightEdge - this.element.offset().left - this.element.outerWidth(),
                        left : 'auto'
                    });
                    if (this.container.offset().left < 0) {
                        this.container.css({
                            right: 'auto',
                            left : 9
                        });
                    }


                } else if (this.opens == 'center') {
                    this.container.css({
                        top  : containerTop,
                        left : this.element.offset().left - parentOffset.left + this.element.outerWidth() / 2
                        - this.container.outerWidth() / 2,
                        right: 'auto'
                    });
                    if (this.container.offset().left < 0) {
                        this.container.css({
                            right: 'auto',
                            left : 9
                        });
                    }
                } else {
                    this.container.css({
                        top  : containerTop,
                        left : this.element.offset().left - parentOffset.left,
                        right: 'auto'
                    });
                    this.container.removeClass('but-move-left');
                    if (this.container.offset().left + this.container.outerWidth() >= $(window).width()) {
                        this.container.css({
                            left : 'auto',
                            right: $(window).width()- ((this.element.offset().left - parentOffset.left) + this.element.outerWidth() - 9)
                        });
                        this.container.addClass('but-move-left');
                    }
                }
                if(this.element.hasClass('fixed')){
                    this.container.css({
                        top: this.element.offset().top +  this.element.height() - $(window).scrollTop()
                    });
                }
            }

        },

        show          : function (e) {
            if (this.isShowing) return;

            // Create a click proxy that is private to this instance of datepicker, for unbinding
            this._outsideClickProxy = $.proxy(function (e) {
                this.outsideClick(e);
            }, this);

            // Bind global datepicker mousedown for hiding and
            $(document)
                .on('mousedown.daterangepicker', this._outsideClickProxy)
                // also support mobile devices
                .on('touchend.daterangepicker', this._outsideClickProxy)
                // also explicitly play nice with Bootstrap dropdowns, which stopPropagation when clicking them
                .on('click.daterangepicker', '[data-toggle=dropdown]', this._outsideClickProxy)
                // and also close when focus changes to outside the picker (eg. tabbing between controls)
                .on('focusin.daterangepicker', this._outsideClickProxy);

            // Reposition the picker if the window is resized while it's open
            this.respontosingle(e);
            $(window).on('resize.daterangepicker', $.proxy(function (e) {
                this.move(e);
                this.respontosingle(e);
            }, this));

            this.oldStartDate = this.startDate.clone();

            this.oldEndDate = this.endDate.clone();

            this.previousRightTime = this.endDate.clone();
            this.updateView();
            this.container.show();
            this.move();
            this.element.trigger('show.daterangepicker', this);
            this.isShowing = true;
        },
        respontosingle: function (e) {
            if (this.showCalendar) {
                return;
            }
            var _width        = 560;
            var _width_single = 300;
            if ($(window).width() - this.parentEl.offset().left < _width) {
                this.responSingle = true;
                this.container.addClass('respon-single');
            } else {
                this.responSingle = false;
                this.container.removeClass('respon-single');

            }
            if (($(window).width() - this.parentEl.offset().left < _width_single) && (this.parentEl.offset() >= _width_single)) {
                this.container.removeClass('opensleft opensright openscenter').addClass('moveleft opensleft');
            } else {
                this.container.removeClass('moveleft opensleft opensright openscenter').addClass('opens' + this.opens);
            }
            this.move(e);
            this.updateView();
        },
        hide          : function (e) {
            if (!this.isShowing) return;

            //incomplete date selection, revert to last values
            if (!this.endDate) {
                this.startDate = this.oldStartDate.clone();
                this.endDate   = this.oldEndDate.clone();
                if (this.sameDate) {
                    this.endDate = this.startDate;
                } else {
                    var start = moment(this.startDate.format('YYYY-MM-DD'));
                    var end   = moment(this.endDate.format('YYYY-MM-DD'));
                    if (end.isSame(start)) {
                        this.endDate = this.endDate.add(1, 'days');
                    }
                }

            } else {
                var start = moment(this.startDate.format('YYYY-MM-DD'));
                var end   = moment(this.endDate.format('YYYY-MM-DD'));
                if (end.isSame(start) && !this.sameDate && !this.showCalendar) {
                    this.endDate = this.endDate.add(1, 'days');
                }
            }

            //if a new date range was selected, invoke the user callback function
            //if (!this.startDate.isSame(this.oldStartDate) || !this.endDate.isSame(this.oldEndDate))
            this.callback(this.startDate, this.endDate, this.chosenLabel);

            //if picker is attached to a text input, update it
            this.updateElement();

            if (this.alwaysShow) {
                return;
            }
            $(document).off('.daterangepicker');
            $(window).off('.daterangepicker');
            this.container.hide();
            this.element.trigger('hide.daterangepicker', this);
            this.isShowing = false;
        },

        toggle: function (e) {
            if (this.isShowing) {
                this.hide();
            } else {
                this.show();
            }
        },

        outsideClick: function (e) {
            var target = $(e.target);
            // if the page is clicked anywhere except within the daterangerpicker/button
            // itself then call this.hide()
            if (
                // ie modal dialog fix
            e.type == "focusin" ||
            target.closest(this.element).length ||
            target.closest(this.container).length ||
            target.closest('.calendar-table').length
            ) return;
            this.hide();
            this.element.trigger('outsideClick.daterangepicker', this);
        },

        showCalendars: function () {
            this.container.addClass('show-calendar');
            this.move();
            this.element.trigger('showCalendar.daterangepicker', this);
        },

        hideCalendars: function () {
            this.container.removeClass('show-calendar');
            this.element.trigger('hideCalendar.daterangepicker', this);
        },

        hoverRange: function (e) {

            //ignore mouse movements while an above-calendar text input has focus
            if (this.container.find('input[name=daterangepicker_start]').is(":focus") || this.container.find('input[name=daterangepicker_end]').is(":focus"))
                return;

            var label = e.target.getAttribute('data-range-key');

            if (label == this.locale.customRangeLabel) {
                this.updateView();
            } else {
                var dates = this.ranges[label];
                this.container.find('input[name=daterangepicker_start]').val(dates[0].format(this.locale.format));
                this.container.find('input[name=daterangepicker_end]').val(dates[1].format(this.locale.format));
            }

        },

        clickRange: function (e) {
            var label        = e.target.getAttribute('data-range-key');
            this.chosenLabel = label;
            if (label == this.locale.customRangeLabel) {
                this.showCalendars();
            } else {
                var dates      = this.ranges[label];
                this.startDate = dates[0];
                this.endDate   = dates[1];

                if (!this.timePicker) {
                    this.startDate.startOf('day');
                    this.endDate.endOf('day');
                }

                if (!this.alwaysShowCalendars)
                    this.hideCalendars();
                this.clickApply(e);
            }
        },

        clickPrev: function (e) {
            var cal = $(e.target).parents('.calendar');
            if (cal.hasClass('left')) {
                this.leftCalendar.month.subtract(1, 'month');
                if (this.linkedCalendars)
                    this.rightCalendar.month.subtract(1, 'month');
            } else {
                this.rightCalendar.month.subtract(1, 'month');
            }
            this.updateCalendars();
        },

        clickNext : function (e) {
            var cal = $(e.target).parents('.calendar');
            if (cal.hasClass('left')) {
                this.leftCalendar.month.add(1, 'month');
            } else {
                this.rightCalendar.month.add(1, 'month');
                if (this.linkedCalendars)
                    this.leftCalendar.month.add(1, 'month');
            }
            this.updateCalendars();
        },
        clickToday: function (e) {
            this.leftCalendar.month = moment();
            if (!this.singleDatePicker) {
                this.rightCalendar.month = moment().add(1, 'month');
            }
            this.updateCalendars();
        },

        hoverDate: function (e) {

            //ignore mouse movements while an above-calendar text input has focus
            //if (this.container.find('input[name=daterangepicker_start]').is(":focus") || this.container.find('input[name=daterangepicker_end]').is(":focus"))
            //    return;

            //ignore dates that can't be selected
            if (!$(e.target).parent().hasClass('available')) return;

            //have the text inputs above calendars reflect the date being hovered over
            var title = $(e.target).parent().attr('data-title');
            var row   = title.substr(1, 1);
            var col   = title.substr(3, 1);
            var cal   = $(e.target).parents('.calendar');
            var date  = cal.hasClass('left') ? this.leftCalendar.calendar[row][col] : this.rightCalendar.calendar[row][col];

            if (this.endDate && !this.container.find('input[name=daterangepicker_start]').is(":focus")) {
                this.container.find('input[name=daterangepicker_start]').val(date.format(this.locale.format));
            } else if (!this.endDate && !this.container.find('input[name=daterangepicker_end]').is(":focus")) {
                this.container.find('input[name=daterangepicker_end]').val(date.format(this.locale.format));
            }

            //highlight the dates between the start date and the date being hovered as a potential end date
            var leftCalendar  = this.leftCalendar;
            var rightCalendar = this.rightCalendar;
            var startDate     = this.startDate;
            if (!this.endDate) {
                this.container.find('.calendar td').each(function (index, el) {

                    //skip week numbers, only look at dates
                    if ($(el).hasClass('week')) return;

                    var title = $(el).attr('data-title');
                    var row   = title.substr(1, 1);
                    var col   = title.substr(3, 1);
                    var cal   = $(el).parents('.calendar');
                    var dt    = cal.hasClass('left') ? leftCalendar.calendar[row][col] : rightCalendar.calendar[row][col];

                    if ((dt.isAfter(startDate) && dt.isBefore(date)) || dt.isSame(date, 'day')) {
                        $(el).addClass('in-range');
                    } else {
                        $(el).removeClass('in-range');
                    }

                });
            }

        },

        clickDate: function (e) {
            if (!$(e.target).parent().hasClass('available')) return;
            var title = $(e.target).parent().attr('data-title');
            var row   = title.substr(1, 1);
            var col   = title.substr(3, 1);
            var cal   = $(e.target).parents('.calendar');
            var date  = cal.hasClass('left') ? this.leftCalendar.calendar[row][col] : this.rightCalendar.calendar[row][col];

            //
            // this function needs to do a few things:
            // * alternate between selecting a start and end date for the range,
            // * if the time picker is enabled, apply the hour/minute/second from the select boxes to the clicked date
            // * if autoapply is enabled, and an end date was chosen, apply the selection
            // * if single date picker mode, and time picker isn't enabled, apply the selection immediately
            // * if one of the inputs above the calendars was focused, cancel that manual input
            //

            if (this.endDate || date.isBefore(this.startDate, 'day')) { //picking start
                if (this.timePicker) {
                    var hour = parseInt(this.container.find('.left .hourselect').val(), 10);
                    if (!this.timePicker24Hour) {
                        var ampm = this.container.find('.left .ampmselect').val();
                        if (ampm === 'PM' && hour < 12)
                            hour += 12;
                        if (ampm === 'AM' && hour === 12)
                            hour = 0;
                    }
                    var minute = parseInt(this.container.find('.left .minuteselect').val(), 10);
                    var second = this.timePickerSeconds ? parseInt(this.container.find('.left .secondselect').val(), 10) : 0;
                    date       = date.clone().hour(hour).minute(minute).second(second);
                }
                this.endDate = null;
                this.setStartDate(date.clone());
            } else if (!this.endDate && date.isBefore(this.startDate)) {
                //special case: clicking the same date for start/end,
                //but the time of the end date is before the start date
                this.setEndDate(this.startDate.clone());
            } else { // picking end
                if (this.timePicker) {
                    var hour = parseInt(this.container.find('.right .hourselect').val(), 10);
                    if (!this.timePicker24Hour) {
                        var ampm = this.container.find('.right .ampmselect').val();
                        if (ampm === 'PM' && hour < 12)
                            hour += 12;
                        if (ampm === 'AM' && hour === 12)
                            hour = 0;
                    }
                    var minute = parseInt(this.container.find('.right .minuteselect').val(), 10);
                    var second = this.timePickerSeconds ? parseInt(this.container.find('.right .secondselect').val(), 10) : 0;
                    date       = date.clone().hour(hour).minute(minute).second(second);
                }
                if (this.showCalendar) {
                    if (this.sameDate && date.isSame(this.startDate)) {
                        return;
                    }
                }
                this.setEndDate(date.clone());
                if (this.disabledDates) {
                    var start = this.startDate,
                        end   = this.endDate;
                    for (var i = 0; i < this.disabledDates.length; i++) {
                        var val = moment(this.disabledDates[i], 'YYYY-MM-DD');
                        if (val.isSame(start) || val.isSame(end) || ( val.isAfter(start) ) && val.isBefore(end)) {
                            this.endDate = null;
                            this.setEndDate(this.startDate.add(1, 'days'));
                        }
                    }
                }

                if (this.autoApply) {
                    this.calculateChosenLabel();
                    this.clickApply(e);
                }
            }

            if (this.singleDatePicker) {
                if (!this.showCalendar) {
                    if (this.sameDate) {
                        this.setEndDate(this.startDate);
                    } else {
                        this.setEndDate(this.startDate.add(1, 'days'));
                    }
                    if (!this.timePicker)
                        this.clickApply(e);
                }

            }
            this.clickedDate = true;
            this.updateView();

            //This is to cancel the blur event handler if the mouse was in one of the inputs
            e.stopPropagation();

        },

        calculateChosenLabel: function () {
            var customRange = true;
            var i           = 0;
            for (var range in this.ranges) {
                if (this.timePicker) {
                    if (this.startDate.isSame(this.ranges[range][0]) && this.endDate.isSame(this.ranges[range][1])) {
                        customRange      = false;
                        this.chosenLabel = this.container.find('.ranges li:eq(' + i + ')').addClass('active').html();
                        break;
                    }
                } else {
                    //ignore times when comparing dates if time picker is not enabled
                    if (this.startDate.format('YYYY-MM-DD') == this.ranges[range][0].format('YYYY-MM-DD') && this.endDate.format('YYYY-MM-DD') == this.ranges[range][1].format('YYYY-MM-DD')) {
                        customRange      = false;
                        this.chosenLabel = this.container.find('.ranges li:eq(' + i + ')').addClass('active').html();
                        break;
                    }
                }
                i++;
            }
            if (customRange && this.showCustomRangeLabel) {
                this.chosenLabel = this.container.find('.ranges li:last').addClass('active').html();
                this.showCalendars();
            }
        },

        clickApply: function (e) {
            this.hide();
            this.element.trigger('apply.daterangepicker', [this, e.target]);
        },

        clickCancel: function (e) {
            this.startDate = this.oldStartDate;
            this.endDate   = this.oldEndDate;
            this.hide();
            this.element.trigger('cancel.daterangepicker', this);
        },

        monthOrYearChanged: function (e) {
            var isLeft      = $(e.target).closest('.calendar').hasClass('left'),
                leftOrRight = isLeft ? 'left' : 'right',
                cal         = this.container.find('.calendar.' + leftOrRight);

            // Month must be Number for new moment versions
            var month = parseInt(cal.find('.monthselect').val(), 10);
            var year  = cal.find('.yearselect').val();

            if (!isLeft) {
                if (year < this.startDate.year() || (year == this.startDate.year() && month < this.startDate.month())) {
                    month = this.startDate.month();
                    year  = this.startDate.year();
                }
            }

            if (this.minDate) {
                if (year < this.minDate.year() || (year == this.minDate.year() && month < this.minDate.month())) {
                    month = this.minDate.month();
                    year  = this.minDate.year();
                }
            }

            if (this.maxDate) {
                if (year > this.maxDate.year() || (year == this.maxDate.year() && month > this.maxDate.month())) {
                    month = this.maxDate.month();
                    year  = this.maxDate.year();
                }
            }

            if (isLeft) {
                this.leftCalendar.month.month(month).year(year);
                if (this.linkedCalendars)
                    this.rightCalendar.month = this.leftCalendar.month.clone().add(1, 'month');
            } else {
                this.rightCalendar.month.month(month).year(year);
                if (this.linkedCalendars)
                    this.leftCalendar.month = this.rightCalendar.month.clone().subtract(1, 'month');
            }
            this.updateCalendars();
        },

        timeChanged: function (e) {

            var cal    = $(e.target).closest('.calendar'),
                isLeft = cal.hasClass('left');

            var hour   = parseInt(cal.find('.hourselect').val(), 10);
            var minute = parseInt(cal.find('.minuteselect').val(), 10);
            var second = this.timePickerSeconds ? parseInt(cal.find('.secondselect').val(), 10) : 0;

            if (!this.timePicker24Hour) {
                var ampm = cal.find('.ampmselect').val();
                if (ampm === 'PM' && hour < 12)
                    hour += 12;
                if (ampm === 'AM' && hour === 12)
                    hour = 0;
            }

            if (isLeft) {
                var start = this.startDate.clone();
                start.hour(hour);
                start.minute(minute);
                start.second(second);
                this.setStartDate(start);
                if (this.singleDatePicker) {
                    this.endDate = this.startDate.clone();
                } else if (this.endDate && this.endDate.format('YYYY-MM-DD') == start.format('YYYY-MM-DD') && this.endDate.isBefore(start)) {
                    this.setEndDate(start.clone());
                }
            } else if (this.endDate) {
                var end = this.endDate.clone();
                end.hour(hour);
                end.minute(minute);
                end.second(second);
                this.setEndDate(end);
            }

            //update the calendars so all clickable dates reflect the new time component
            this.updateCalendars();

            //update the form inputs above the calendars with the new time
            this.updateFormInputs();

            //re-render the time pickers because changing one selection can affect what's enabled in another
            this.renderTimePicker('left');
            this.renderTimePicker('right');

        },

        formInputsChanged: function (e) {
            var isRight = $(e.target).closest('.calendar').hasClass('right');
            var start   = moment(this.container.find('input[name="daterangepicker_start"]').val(), this.locale.format);
            var end     = moment(this.container.find('input[name="daterangepicker_end"]').val(), this.locale.format);

            if (start.isValid() && end.isValid()) {

                if (isRight && end.isBefore(start))
                    start = end.clone();

                this.setStartDate(start);
                this.setEndDate(end);

                if (isRight) {
                    this.container.find('input[name="daterangepicker_start"]').val(this.startDate.format(this.locale.format));
                } else {
                    this.container.find('input[name="daterangepicker_end"]').val(this.endDate.format(this.locale.format));
                }

            }

            this.updateView();
        },

        formInputsFocused: function (e) {

            // Highlight the focused input
            this.container.find('input[name="daterangepicker_start"], input[name="daterangepicker_end"]').removeClass('active');
            $(e.target).addClass('active');

            // Set the state such that if the user goes back to using a mouse,
            // the calendars are aware we're selecting the end of the range, not
            // the start. This allows someone to edit the end of a date range without
            // re-selecting the beginning, by clicking on the end date input then
            // using the calendar.
            var isRight = $(e.target).closest('.calendar').hasClass('right');
            if (isRight) {
                this.endDate = null;
                this.setStartDate(this.startDate.clone());
                this.updateView();
            }

        },

        formInputsBlurred: function (e) {

            // this function has one purpose right now: if you tab from the first
            // text input to the second in the UI, the endDate is nulled so that
            // you can click another, but if you tab out without clicking anything
            // or changing the input value, the old endDate should be retained

            if (!this.endDate) {
                var val = this.container.find('input[name="daterangepicker_end"]').val();
                var end = moment(val, this.locale.format);
                if (end.isValid()) {
                    this.setEndDate(end);
                    this.updateView();
                }
            }

        },

        elementChanged: function () {
            if (!this.element.is('input')) return;
            if (!this.element.val().length) return;
            if (this.element.val().length < this.locale.format.length) return;

            var dateString = this.element.val().split(this.locale.separator),
                start      = null,
                end        = null;
            if (dateString.length === 2) {
                start = moment(dateString[0], this.locale.format);
                end   = moment(dateString[1], this.locale.format);
            }
            if (this.singleDatePicker || start === null || end === null) {
                start = moment(this.element.val(), this.locale.format);
                end   = start;
            }
            if (!start.isValid() || !end.isValid()) return;

            if (moment(end.format('YYYY-MM-DD')).isSame(moment(start.format('YYYY-MM-DD'))) && !this.singleDay && !this.sameDate) {
                end = end.add(1, 'days');
            }

            this.setStartDate(start);
            this.setEndDate(end);
            this.updateView();
        },

        keydown: function (e) {
            //hide on tab or enter
            if ((e.keyCode === 9) || (e.keyCode === 13)) {
                this.hide();
            }
        },

        updateElement: function () {
            if (this.element.is('input') && !this.singleDatePicker && this.autoUpdateInput) {
                this.element.val(this.startDate.format(this.locale.format) + this.locale.separator + this.endDate.format(this.locale.format));
                this.element.trigger('change', this);
            } else if (this.element.is('input') && this.autoUpdateInput) {
                if (this.showCalendar) {
                    this.element.val(this.startDate.format(this.locale.format) + this.locale.separator + this.endDate.format(this.locale.format));
                } else {
                    this.element.val(this.startDate.format(this.locale.format));
                }

                this.element.trigger('change', this);
            }
        },
        remove       : function () {
            this.container.remove();
            this.element.off('.daterangepicker');
            this.element.removeData();
        }

    };

    $.fn.daterangepicker = function (options, callback) {
        this.each(function () {
            var el = $(this);
            if (el.data('daterangepicker'))
                el.data('daterangepicker').remove();
            el.data('daterangepicker', new DateRangePicker(el, options, callback));
        });
        return this;
    };

    return DateRangePicker;

}));
