(function ($) {
    'use strict';

    $.fn.vinhomeSlider = function (options) {
        var defaults = {
            effect: 'vinhome-slider-scale-transform',
            container: '.vinhome-slider',
            itemClass: '.item',
            controlsClass: '.vinhome-slider-controls',
            showPag: true,
            pagClass: '.vinhome-slider-pag',
            zIndexFrom: 99,
            autoplay: false,
            stopHover: false,
            interval: 5000,
            items: null,
            margin: 20,
            currentClass: 'is-showing',
            iconNext: '<svg stroke="#FFFFFF" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"' +
                '                 viewBox="0 0 32.635 32.635" style="enable-background:new 0 0 32.635 32.635;" xml:space="preserve">' +
                '            <g>' +
                '                <path d="M32.135,16.817H0.5c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h31.635c0.276,0,0.5,0.224,0.5,0.5' +
                '                    S32.411,16.817,32.135,16.817z"/>' +
                '                <path d="M19.598,29.353c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l12.184-12.184L19.244,4.136' +
                '                    c-0.195-0.195-0.195-0.512,0-0.707s0.512-0.195,0.707,0l12.537,12.533c0.094,0.094,0.146,0.221,0.146,0.354' +
                '                    s-0.053,0.26-0.146,0.354L19.951,29.206C19.854,29.304,19.726,29.353,19.598,29.353z"/>' +
                '            </g>' +
                '            </svg>',
            iconPrev: '<svg stroke="#FFFFFF" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" x="0px"' +
                '                 y="0px"' +
                '                 viewBox="0 0 32.635 32.635" style="enable-background:new 0 0 32.635 32.635;" xml:space="preserve">' +
                '            <g>' +
                '                <path d="M32.135,16.817H0.5c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h31.635c0.276,0,0.5,0.224,0.5,0.5' +
                '                    S32.411,16.817,32.135,16.817z"/>' +
                '                <path d="M13.037,29.353c-0.128,0-0.256-0.049-0.354-0.146L0.146,16.669C0.053,16.575,0,16.448,0,16.315s0.053-0.26,0.146-0.354' +
                '                    L12.684,3.429c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L1.207,16.315l12.184,12.184c0.195,0.195,0.195,0.512,0,0.707' +
                '                    C13.293,29.304,13.165,29.353,13.037,29.353z"/>' +
                '            </g>' +
                '            </svg>'
        };

        var animationEffect = {
            'vinhome-slider-scale-transform': {
                next: 'vinhome-slider-scale-transform-next',
                prev: 'vinhome-slider-scale-transform-prev',
                current: 'vinhome-slider-scale-transform-current',
            },
            'vinhome-slider-slick': {
                next: 'vinhome-slider-slick-next',
                prev: 'vinhome-slider-slick-prev',
                current: 'vinhome-slider-slick-current'
            },
            'vinhome-text-transform':{
                text: 'vinhome-text'
            }
        };

        function whichTransitionEvent() {
            var t;
            var el = document.createElement('fakeelement');
            var transitions = {
                'transition': 'transitionend',
                'OTransition': 'oTransitionEnd',
                'MozTransition': 'transitionend',
                'WebkitTransition': 'webkitTransitionEnd'
            };

            for (t in transitions) {
                if (el.style[t] !== undefined) {
                    return transitions[t];
                }
            }
        }


        this.each(function () {
            var t = $(this);
            var currentOptions = $.extend({}, defaults, options);

            var container = $(currentOptions.container, t);
            var items = $(currentOptions.itemClass, container);
            var total = items.length;
            var currentPos = [];
            var delayTime = [];
            var controls = $(currentOptions.controlsClass, t);
            var pags = $(currentOptions.pagClass, t);
            var endEffect = true;
            var transitionEvent = whichTransitionEvent();
            var timeInterval;

            buildControls();
            buildPags();
            if (typeof currentOptions.items === 'number') {
                calculateItemsPerPage();
                setDefaultDelayTime();
            }

            setDefaultCurrentPos();

            setEffect();
            setZIndex();
            setState();
            setAutoPlay();

            openWhenRendered();

            function openWhenRendered() {
                t.imagesLoaded(function () {
                    t.fadeIn();
                });
            }

            function setDefaultCurrentPos() {
                if (typeof currentOptions.items === 'number') {
                    for (let i = 0; i < currentOptions.items; i++) {
                        currentPos.push(i);
                    }
                } else {
                    currentPos.push(0);
                }
            }

            function setDefaultDelayTime() {
                var time = 0.1;
                for (let i = 0; i < currentOptions.items; i++) {
                    time += 0.1;
                    time = Math.round(time * 100) / 100;
                    delayTime.push('' + time + 's');
                }
            }

            function setDelayTime(item, index) {
                if(typeof currentOptions.items === 'number'){
                    item.css({
                        '-webkit-transition-delay': delayTime[index],
                        '-o-transition-delay': delayTime[index],
                        'transition-delay': delayTime[index],
                    });
                }
            }

            function buildControls() {
                t.append('<div class="' + currentOptions.controlsClass.substr(1) + '">');
                $(currentOptions.controlsClass, t).append('<a href="javascript: void(0)" class="vinhome-slider-control prev">' + currentOptions.iconPrev + '</a><a href="javascript: void(0)" class="vinhome-slider-control next">' + currentOptions.iconNext + '</a>');
            }

            function buildPags() {
                if(items.length > 0 && currentOptions.showPag) {
                    t.append('<div class="' + currentOptions.pagClass.substr(1) + '">');

                    for(var iPag = 0; iPag < items.length; iPag++) {
                        var classPagActive = '';
                        if(iPag === 0){
                            classPagActive = 'active';
                        }
                        $(currentOptions.pagClass, t).append('<div class="pag-item '+ classPagActive +'" data-value="'+ iPag +'"></div>');
                    }
                }
            }

            function calculateItemsPerPage() {
                var _width = t.innerWidth();
                var _widthItem = (_width - ((currentOptions.items + 1) * currentOptions.margin)) / currentOptions.items;
                items.each(function (index) {
                    $(this).css({
                        'width': _widthItem,
                        'margin-right': currentOptions.margin
                    });
                    if (index === 0) {
                        $(this).css('margin-left', currentOptions.margin);
                    }
                    if (index === total - 1) {
                        $(this).css('margin-right', '');
                    }
                });
                container.css('width', total * _widthItem + ((total) * currentOptions.margin));
            }

            function setZIndex() {
                items.each(function (index) {
                    if ($.inArray(index, currentPos) === -1) {
                        $(this).css('z-index', currentOptions.zIndexFrom - (index + 1));
                    } else {
                        $(this).css('z-index', currentOptions.zIndexFrom);
                    }
                });
            }

            function getPosition(current, control) {
                if (control === 'next') {
                    current++;
                    if (current === total) {
                        current = 0;
                    }
                } else {

                    current--;
                    if (current < 0) {
                        current = total - 1;
                    }
                }

                return current;
            }

            function setEffect() {
                items.each(function () {
                    $(this).addClass(currentOptions.effect);
                });
            }

            function setState(control) {
                setZIndex();
                if (!control) {
                    for (let i = 0; i < currentPos.length; i++) {
                        items.eq(currentPos[i]).addClass(animationEffect[currentOptions.effect].current);
                    }

                    for (let i = 0; i <= total; i++) {
                        if ($.inArray(i, currentPos) === -1) {
                            items.eq(i).addClass(animationEffect[currentOptions.effect].next);
                        }
                    }
                } else {
                    endEffect = false;
                    if (control === 'next') {
                        for (let i = 0; i < currentPos.length; i++) {
                            setDelayTime(items.eq(getPosition(currentPos[i], 'prev')), i);
                            items.eq(getPosition(currentPos[i], 'prev')).removeClass(animationEffect[currentOptions.effect].current).addClass(animationEffect[currentOptions.effect].prev);
                            items.eq(getPosition(currentPos[i], 'prev')).one(transitionEvent, function () {
                                items.eq(getPosition(currentPos[i], 'prev')).removeClass(' ' + animationEffect[currentOptions.effect].current + ' ' + animationEffect[currentOptions.effect].prev).addClass(animationEffect[currentOptions.effect].next);
                            });
                        }
                        for (let i = 0; i < currentPos.length; i++) {
                            setDelayTime(items.eq(currentPos[i]), i);
                            items.eq(currentPos[i]).removeClass(animationEffect[currentOptions.effect].next).addClass(animationEffect[currentOptions.effect].current);
                            if (i === currentPos.length - 1) {
                                items.eq(currentPos[currentPos.length - 1]).one(transitionEvent, function () {
                                    endEffect = true;
                                });
                            }
                        }
                    } else {
                        for (let i = 0; i < currentPos.length; i++) {
                            items.eq(getPosition(currentPos[i], 'next')).removeClass(animationEffect[currentOptions.effect].current).addClass(animationEffect[currentOptions.effect].prev);
                            items.eq(getPosition(currentPos[i], 'next')).one(transitionEvent, function () {
                                items.eq(getPosition(currentPos, 'next')).removeClass(' ' + animationEffect[currentOptions.effect].current + ' ' + animationEffect[currentOptions.effect].prev).addClass(animationEffect[currentOptions.effect].next);
                            });
                        }
                        for (let i = 0; i < currentPos.length; i++) {
                            items.eq(currentPos[i]).removeClass(animationEffect[currentOptions.effect].next).addClass(animationEffect[currentOptions.effect].current);
                            if (i === currentPos.length - 1) {
                                items.eq(currentPos[currentPos.length - 1]).one(transitionEvent, function () {
                                    endEffect = true;
                                });
                            }
                        }
                    }
                }
            }

            function setAutoPlay() {
                if (currentOptions.autoplay) {
                    timeInterval = setInterval(function () {
                        $('.vinhome-slider-control.next', t).trigger('click');
                    }, currentOptions.interval);
                }
            }

            t.hover(function () {
                if (currentOptions.autoplay && currentOptions.stopHover) {
                    clearInterval(timeInterval);
                }
            }, function () {
                setAutoPlay();
            });
            t.on('click', '.vinhome-slider-control.next', function (ev) {
                ev.preventDefault();
                if (endEffect) {
                    for (let i = 0; i < currentPos.length; i++) {
                        let _c = currentPos[i];
                        _c++;
                        if (_c >= total) {
                            _c = 0;
                        }
                        currentPos[i] = _c;
                    }
                    setState('next');
                    changePagItem();
                    t.trigger('vinhome_slider_next', currentPos, items, t);
                }
            });
            t.on('click', '.vinhome-slider-control.prev', function (ev) {
                ev.preventDefault();
                if (endEffect) {
                    for (let i = 0; i < currentPos.length; i++) {
                        let _c = currentPos[i];
                        _c--;
                        if (_c < 0) {
                            _c = total - 1;
                        }
                        currentPos[i] = _c;
                    }
                    setState('prev');
                    changePagItem();
                    t.trigger('vinhome_slider_prev', currentPos, items, t);
                }
            });

            function changePagItem(){
                $('.vinhome-slider-pag .pag-item').removeClass('active');
                $('.vinhome-slider-pag .pag-item[data-value="'+ currentPos[0] +'"]').addClass('active');
            }

            //Pag click
            t.on('click', '.vinhome-slider-pag .pag-item:not(".active")', function (ev) {
                $('.vinhome-slider-pag .pag-item').removeClass('active');
                $(this).addClass('active');
                var dataValue = $(this).data('value');
                var currentValue = currentPos[0];
                if(dataValue < 0)
                    dataValue = 0;
                if(dataValue > items.length - 1)
                    dataValue = items.length - 1;

                currentPos[0] = dataValue;
                if(dataValue > currentValue){
                    setState('next');
                    t.trigger('vinhome_slider_next', currentPos, items, t);
                }else{
                    setState('prev');
                    t.trigger('vinhome_slider_prev', currentPos, items, t);
                }
            })
        });
    }
})(jQuery);