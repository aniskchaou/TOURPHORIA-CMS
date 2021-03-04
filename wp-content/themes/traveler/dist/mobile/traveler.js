window.Modernizr=function(e,t,n){function r(e){g.cssText=e}function o(e,t){return typeof e===t}function i(e,t){return!!~(""+e).indexOf(t)}function a(e,t){for(var r in e){var o=e[r];if(!i(o,"-")&&g[o]!==n)return"pfx"==t?o:!0}return!1}function c(e,t,r){for(var i in e){var a=t[e[i]];if(a!==n)return r===!1?e[i]:o(a,"function")?a.bind(r||t):a}return!1}function s(e,t,n){var r=e.charAt(0).toUpperCase()+e.slice(1),i=(e+" "+j.join(r+" ")+r).split(" ");return o(t,"string")||o(t,"undefined")?a(i,t):(i=(e+" "+C.join(r+" ")+r).split(" "),c(i,t,n))}var l,u,f,d="2.6.2",p={},m=!0,h=t.documentElement,y="modernizr",v=t.createElement(y),g=v.style,b=({}.toString," -webkit- -moz- -o- -ms- ".split(" ")),E="Webkit Moz O ms",j=E.split(" "),C=E.toLowerCase().split(" "),w={},x=[],S=x.slice,N=function(e,n,r,o){var i,a,c,s,l=t.createElement("div"),u=t.body,f=u||t.createElement("body");if(parseInt(r,10))for(;r--;)c=t.createElement("div"),c.id=o?o[r]:y+(r+1),l.appendChild(c);return i=["&#173;",'<style id="s',y,'">',e,"</style>"].join(""),l.id=y,(u?l:f).innerHTML+=i,f.appendChild(l),u||(f.style.background="",f.style.overflow="hidden",s=h.style.overflow,h.style.overflow="hidden",h.appendChild(f)),a=n(l,e),u?l.parentNode.removeChild(l):(f.parentNode.removeChild(f),h.style.overflow=s),!!a},k={}.hasOwnProperty;f=o(k,"undefined")||o(k.call,"undefined")?function(e,t){return t in e&&o(e.constructor.prototype[t],"undefined")}:function(e,t){return k.call(e,t)},Function.prototype.bind||(Function.prototype.bind=function(e){var t=this;if("function"!=typeof t)throw new TypeError;var n=S.call(arguments,1),r=function(){if(this instanceof r){var o=function(){};o.prototype=t.prototype;var i=new o,a=t.apply(i,n.concat(S.call(arguments)));return Object(a)===a?a:i}return t.apply(e,n.concat(S.call(arguments)))};return r}),w.touch=function(){var n;return"ontouchstart"in e||e.DocumentTouch&&t instanceof DocumentTouch?n=!0:N(["@media (",b.join("touch-enabled),("),y,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(e){n=9===e.offsetTop}),n},w.backgroundsize=function(){return s("backgroundSize")},w.csstransforms3d=function(){var e=!!s("perspective");return e&&"webkitPerspective"in h.style&&N("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(t,n){e=9===t.offsetLeft&&3===t.offsetHeight}),e},w.csstransitions=function(){return s("transition")};for(var T in w)f(w,T)&&(u=T.toLowerCase(),p[u]=w[T](),x.push((p[u]?"":"no-")+u));return p.addTest=function(e,t){if("object"==typeof e)for(var r in e)f(e,r)&&p.addTest(r,e[r]);else{if(e=e.toLowerCase(),p[e]!==n)return p;t="function"==typeof t?t():t,"undefined"!=typeof m&&m&&(h.className+=" "+(t?"":"no-")+e),p[e]=t}return p},r(""),v=l=null,function(e,t){function n(e,t){var n=e.createElement("p"),r=e.getElementsByTagName("head")[0]||e.documentElement;return n.innerHTML="x<style>"+t+"</style>",r.insertBefore(n.lastChild,r.firstChild)}function r(){var e=v.elements;return"string"==typeof e?e.split(" "):e}function o(e){var t=y[e[m]];return t||(t={},h++,e[m]=h,y[h]=t),t}function i(e,n,r){if(n||(n=t),u)return n.createElement(e);r||(r=o(n));var i;return i=r.cache[e]?r.cache[e].cloneNode():p.test(e)?(r.cache[e]=r.createElem(e)).cloneNode():r.createElem(e),i.canHaveChildren&&!d.test(e)?r.frag.appendChild(i):i}function a(e,n){if(e||(e=t),u)return e.createDocumentFragment();n=n||o(e);for(var i=n.frag.cloneNode(),a=0,c=r(),s=c.length;s>a;a++)i.createElement(c[a]);return i}function c(e,t){t.cache||(t.cache={},t.createElem=e.createElement,t.createFrag=e.createDocumentFragment,t.frag=t.createFrag()),e.createElement=function(n){return v.shivMethods?i(n,e,t):t.createElem(n)},e.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+r().join().replace(/\w+/g,function(e){return t.createElem(e),t.frag.createElement(e),'c("'+e+'")'})+");return n}")(v,t.frag)}function s(e){e||(e=t);var r=o(e);return v.shivCSS&&!l&&!r.hasCSS&&(r.hasCSS=!!n(e,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),u||c(e,r),e}var l,u,f=e.html5||{},d=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,p=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,m="_html5shiv",h=0,y={};!function(){try{var e=t.createElement("a");e.innerHTML="<xyz></xyz>",l="hidden"in e,u=1==e.childNodes.length||function(){t.createElement("a");var e=t.createDocumentFragment();return"undefined"==typeof e.cloneNode||"undefined"==typeof e.createDocumentFragment||"undefined"==typeof e.createElement}()}catch(n){l=!0,u=!0}}();var v={elements:f.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:f.shivCSS!==!1,supportsUnknownElements:u,shivMethods:f.shivMethods!==!1,type:"default",shivDocument:s,createElement:i,createDocumentFragment:a};e.html5=v,s(t)}(this,t),p._version=d,p._prefixes=b,p._domPrefixes=C,p._cssomPrefixes=j,p.testProp=function(e){return a([e])},p.testAllProps=s,p.testStyles=N,p.prefixed=function(e,t,n){return t?s(e,t,n):s(e,"pfx")},h.className=h.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(m?" js "+x.join(" "):""),p}(this,this.document),function(e,t,n){function r(e){return"[object Function]"==y.call(e)}function o(e){return"string"==typeof e}function i(){}function a(e){return!e||"loaded"==e||"complete"==e||"uninitialized"==e}function c(){var e=v.shift();g=1,e?e.t?m(function(){("c"==e.t?d.injectCss:d.injectJs)(e.s,0,e.a,e.x,e.e,1)},0):(e(),c()):g=0}function s(e,n,r,o,i,s,l){function u(t){if(!p&&a(f.readyState)&&(b.r=p=1,!g&&c(),f.onload=f.onreadystatechange=null,t)){"img"!=e&&m(function(){j.removeChild(f)},50);for(var r in N[n])N[n].hasOwnProperty(r)&&N[n][r].onload()}}var l=l||d.errorTimeout,f=t.createElement(e),p=0,y=0,b={t:r,s:n,e:i,a:s,x:l};1===N[n]&&(y=1,N[n]=[]),"object"==e?f.data=n:(f.src=n,f.type=e),f.width=f.height="0",f.onerror=f.onload=f.onreadystatechange=function(){u.call(this,y)},v.splice(o,0,b),"img"!=e&&(y||2===N[n]?(j.insertBefore(f,E?null:h),m(u,l)):N[n].push(f))}function l(e,t,n,r,i){return g=0,t=t||"j",o(e)?s("c"==t?w:C,e,t,this.i++,n,r,i):(v.splice(this.i++,0,e),1==v.length&&c()),this}function u(){var e=d;return e.loader={load:l,i:0},e}var f,d,p=t.documentElement,m=e.setTimeout,h=t.getElementsByTagName("script")[0],y={}.toString,v=[],g=0,b="MozAppearance"in p.style,E=b&&!!t.createRange().compareNode,j=E?p:h.parentNode,p=e.opera&&"[object Opera]"==y.call(e.opera),p=!!t.attachEvent&&!p,C=b?"object":p?"script":"img",w=p?"script":C,x=Array.isArray||function(e){return"[object Array]"==y.call(e)},S=[],N={},k={timeout:function(e,t){return t.length&&(e.timeout=t[0]),e}};d=function(e){function t(e){var t,n,r,e=e.split("!"),o=S.length,i=e.pop(),a=e.length,i={url:i,origUrl:i,prefixes:e};for(n=0;a>n;n++)r=e[n].split("="),(t=k[r.shift()])&&(i=t(i,r));for(n=0;o>n;n++)i=S[n](i);return i}function a(e,o,i,a,c){var s=t(e),l=s.autoCallback;s.url.split(".").pop().split("?").shift(),s.bypass||(o&&(o=r(o)?o:o[e]||o[a]||o[e.split("/").pop().split("?")[0]]),s.instead?s.instead(e,o,i,a,c):(N[s.url]?s.noexec=!0:N[s.url]=1,i.load(s.url,s.forceCSS||!s.forceJS&&"css"==s.url.split(".").pop().split("?").shift()?"c":n,s.noexec,s.attrs,s.timeout),(r(o)||r(l))&&i.load(function(){u(),o&&o(s.origUrl,c,a),l&&l(s.origUrl,c,a),N[s.url]=2})))}function c(e,t){function n(e,n){if(e){if(o(e))n||(f=function(){var e=[].slice.call(arguments);d.apply(this,e),p()}),a(e,f,t,0,l);else if(Object(e)===e)for(s in c=function(){var t,n=0;for(t in e)e.hasOwnProperty(t)&&n++;return n}(),e)e.hasOwnProperty(s)&&(!n&&!--c&&(r(f)?f=function(){var e=[].slice.call(arguments);d.apply(this,e),p()}:f[s]=function(e){return function(){var t=[].slice.call(arguments);e&&e.apply(this,t),p()}}(d[s])),a(e[s],f,t,s,l))}else!n&&p()}var c,s,l=!!e.test,u=e.load||e.both,f=e.callback||i,d=f,p=e.complete||i;n(l?e.yep:e.nope,!!u),u&&n(u)}var s,l,f=this.yepnope.loader;if(o(e))a(e,0,f,0);else if(x(e))for(s=0;s<e.length;s++)l=e[s],o(l)?a(l,0,f,0):x(l)?d(l):Object(l)===l&&c(l,f);else Object(e)===e&&c(e,f)},d.addPrefix=function(e,t){k[e]=t},d.addFilter=function(e){S.push(e)},d.errorTimeout=1e4,null==t.readyState&&t.addEventListener&&(t.readyState="loading",t.addEventListener("DOMContentLoaded",f=function(){t.removeEventListener("DOMContentLoaded",f,0),t.readyState="complete"},0)),e.yepnope=u(),e.yepnope.executeStack=c,e.yepnope.injectJs=function(e,n,r,o,s,l){var u,f,p=t.createElement("script"),o=o||d.errorTimeout;p.src=e;for(f in r)p.setAttribute(f,r[f]);n=l?c:n||i,p.onreadystatechange=p.onload=function(){!u&&a(p.readyState)&&(u=1,n(),p.onload=p.onreadystatechange=null)},m(function(){u||(u=1,n(1))},o),s?p.onload():h.parentNode.insertBefore(p,h)},e.yepnope.injectCss=function(e,n,r,o,a,s){var l,o=t.createElement("link"),n=s?c:n||i;o.href=e,o.rel="stylesheet",o.type="text/css";for(l in r)o.setAttribute(l,r[l]);a||(h.parentNode.insertBefore(o,h),m(n,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};;if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(a){"use strict";var b=a.fn.jquery.split(" ")[0].split(".");if(b[0]<2&&b[1]<9||1==b[0]&&9==b[1]&&b[2]<1||b[0]>2)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 3")}(jQuery),+function(a){"use strict";function b(){var a=document.createElement("bootstrap"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return{end:b[c]};return!1}a.fn.emulateTransitionEnd=function(b){var c=!1,d=this;a(this).one("bsTransitionEnd",function(){c=!0});var e=function(){c||a(d).trigger(a.support.transition.end)};return setTimeout(e,b),this},a(function(){a.support.transition=b(),a.support.transition&&(a.event.special.bsTransitionEnd={bindType:a.support.transition.end,delegateType:a.support.transition.end,handle:function(b){return a(b.target).is(this)?b.handleObj.handler.apply(this,arguments):void 0}})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var c=a(this),e=c.data("bs.alert");e||c.data("bs.alert",e=new d(this)),"string"==typeof b&&e[b].call(c)})}var c='[data-dismiss="alert"]',d=function(b){a(b).on("click",c,this.close)};d.VERSION="3.3.6",d.TRANSITION_DURATION=150,d.prototype.close=function(b){function c(){g.detach().trigger("closed.bs.alert").remove()}var e=a(this),f=e.attr("data-target");f||(f=e.attr("href"),f=f&&f.replace(/.*(?=#[^\s]*$)/,""));var g=a(f);b&&b.preventDefault(),g.length||(g=e.closest(".alert")),g.trigger(b=a.Event("close.bs.alert")),b.isDefaultPrevented()||(g.removeClass("in"),a.support.transition&&g.hasClass("fade")?g.one("bsTransitionEnd",c).emulateTransitionEnd(d.TRANSITION_DURATION):c())};var e=a.fn.alert;a.fn.alert=b,a.fn.alert.Constructor=d,a.fn.alert.noConflict=function(){return a.fn.alert=e,this},a(document).on("click.bs.alert.data-api",c,d.prototype.close)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.button"),f="object"==typeof b&&b;e||d.data("bs.button",e=new c(this,f)),"toggle"==b?e.toggle():b&&e.setState(b)})}var c=function(b,d){this.$element=a(b),this.options=a.extend({},c.DEFAULTS,d),this.isLoading=!1};c.VERSION="3.3.6",c.DEFAULTS={loadingText:"loading..."},c.prototype.setState=function(b){var c="disabled",d=this.$element,e=d.is("input")?"val":"html",f=d.data();b+="Text",null==f.resetText&&d.data("resetText",d[e]()),setTimeout(a.proxy(function(){d[e](null==f[b]?this.options[b]:f[b]),"loadingText"==b?(this.isLoading=!0,d.addClass(c).attr(c,c)):this.isLoading&&(this.isLoading=!1,d.removeClass(c).removeAttr(c))},this),0)},c.prototype.toggle=function(){var a=!0,b=this.$element.closest('[data-toggle="buttons"]');if(b.length){var c=this.$element.find("input");"radio"==c.prop("type")?(c.prop("checked")&&(a=!1),b.find(".active").removeClass("active"),this.$element.addClass("active")):"checkbox"==c.prop("type")&&(c.prop("checked")!==this.$element.hasClass("active")&&(a=!1),this.$element.toggleClass("active")),c.prop("checked",this.$element.hasClass("active")),a&&c.trigger("change")}else this.$element.attr("aria-pressed",!this.$element.hasClass("active")),this.$element.toggleClass("active")};var d=a.fn.button;a.fn.button=b,a.fn.button.Constructor=c,a.fn.button.noConflict=function(){return a.fn.button=d,this},a(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(c){var d=a(c.target);d.hasClass("btn")||(d=d.closest(".btn")),b.call(d,"toggle"),a(c.target).is('input[type="radio"]')||a(c.target).is('input[type="checkbox"]')||c.preventDefault()}).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',function(b){a(b.target).closest(".btn").toggleClass("focus",/^focus(in)?$/.test(b.type))})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.carousel"),f=a.extend({},c.DEFAULTS,d.data(),"object"==typeof b&&b),g="string"==typeof b?b:f.slide;e||d.data("bs.carousel",e=new c(this,f)),"number"==typeof b?e.to(b):g?e[g]():f.interval&&e.pause().cycle()})}var c=function(b,c){this.$element=a(b),this.$indicators=this.$element.find(".carousel-indicators"),this.options=c,this.paused=null,this.sliding=null,this.interval=null,this.$active=null,this.$items=null,this.options.keyboard&&this.$element.on("keydown.bs.carousel",a.proxy(this.keydown,this)),"hover"==this.options.pause&&!("ontouchstart"in document.documentElement)&&this.$element.on("mouseenter.bs.carousel",a.proxy(this.pause,this)).on("mouseleave.bs.carousel",a.proxy(this.cycle,this))};c.VERSION="3.3.6",c.TRANSITION_DURATION=600,c.DEFAULTS={interval:5e3,pause:"hover",wrap:!0,keyboard:!0},c.prototype.keydown=function(a){if(!/input|textarea/i.test(a.target.tagName)){switch(a.which){case 37:this.prev();break;case 39:this.next();break;default:return}a.preventDefault()}},c.prototype.cycle=function(b){return b||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(a.proxy(this.next,this),this.options.interval)),this},c.prototype.getItemIndex=function(a){return this.$items=a.parent().children(".item"),this.$items.index(a||this.$active)},c.prototype.getItemForDirection=function(a,b){var c=this.getItemIndex(b),d="prev"==a&&0===c||"next"==a&&c==this.$items.length-1;if(d&&!this.options.wrap)return b;var e="prev"==a?-1:1,f=(c+e)%this.$items.length;return this.$items.eq(f)},c.prototype.to=function(a){var b=this,c=this.getItemIndex(this.$active=this.$element.find(".item.active"));return a>this.$items.length-1||0>a?void 0:this.sliding?this.$element.one("slid.bs.carousel",function(){b.to(a)}):c==a?this.pause().cycle():this.slide(a>c?"next":"prev",this.$items.eq(a))},c.prototype.pause=function(b){return b||(this.paused=!0),this.$element.find(".next, .prev").length&&a.support.transition&&(this.$element.trigger(a.support.transition.end),this.cycle(!0)),this.interval=clearInterval(this.interval),this},c.prototype.next=function(){return this.sliding?void 0:this.slide("next")},c.prototype.prev=function(){return this.sliding?void 0:this.slide("prev")},c.prototype.slide=function(b,d){var e=this.$element.find(".item.active"),f=d||this.getItemForDirection(b,e),g=this.interval,h="next"==b?"left":"right",i=this;if(f.hasClass("active"))return this.sliding=!1;var j=f[0],k=a.Event("slide.bs.carousel",{relatedTarget:j,direction:h});if(this.$element.trigger(k),!k.isDefaultPrevented()){if(this.sliding=!0,g&&this.pause(),this.$indicators.length){this.$indicators.find(".active").removeClass("active");var l=a(this.$indicators.children()[this.getItemIndex(f)]);l&&l.addClass("active")}var m=a.Event("slid.bs.carousel",{relatedTarget:j,direction:h});return a.support.transition&&this.$element.hasClass("slide")?(f.addClass(b),f[0].offsetWidth,e.addClass(h),f.addClass(h),e.one("bsTransitionEnd",function(){f.removeClass([b,h].join(" ")).addClass("active"),e.removeClass(["active",h].join(" ")),i.sliding=!1,setTimeout(function(){i.$element.trigger(m)},0)}).emulateTransitionEnd(c.TRANSITION_DURATION)):(e.removeClass("active"),f.addClass("active"),this.sliding=!1,this.$element.trigger(m)),g&&this.cycle(),this}};var d=a.fn.carousel;a.fn.carousel=b,a.fn.carousel.Constructor=c,a.fn.carousel.noConflict=function(){return a.fn.carousel=d,this};var e=function(c){var d,e=a(this),f=a(e.attr("data-target")||(d=e.attr("href"))&&d.replace(/.*(?=#[^\s]+$)/,""));if(f.hasClass("carousel")){var g=a.extend({},f.data(),e.data()),h=e.attr("data-slide-to");h&&(g.interval=!1),b.call(f,g),h&&f.data("bs.carousel").to(h),c.preventDefault()}};a(document).on("click.bs.carousel.data-api","[data-slide]",e).on("click.bs.carousel.data-api","[data-slide-to]",e),a(window).on("load",function(){a('[data-ride="carousel"]').each(function(){var c=a(this);b.call(c,c.data())})})}(jQuery),+function(a){"use strict";function b(b){var c,d=b.attr("data-target")||(c=b.attr("href"))&&c.replace(/.*(?=#[^\s]+$)/,"");return a(d)}function c(b){return this.each(function(){var c=a(this),e=c.data("bs.collapse"),f=a.extend({},d.DEFAULTS,c.data(),"object"==typeof b&&b);!e&&f.toggle&&/show|hide/.test(b)&&(f.toggle=!1),e||c.data("bs.collapse",e=new d(this,f)),"string"==typeof b&&e[b]()})}var d=function(b,c){this.$element=a(b),this.options=a.extend({},d.DEFAULTS,c),this.$trigger=a('[data-toggle="collapse"][href="#'+b.id+'"],[data-toggle="collapse"][data-target="#'+b.id+'"]'),this.transitioning=null,this.options.parent?this.$parent=this.getParent():this.addAriaAndCollapsedClass(this.$element,this.$trigger),this.options.toggle&&this.toggle()};d.VERSION="3.3.6",d.TRANSITION_DURATION=350,d.DEFAULTS={toggle:!0},d.prototype.dimension=function(){var a=this.$element.hasClass("width");return a?"width":"height"},d.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var b,e=this.$parent&&this.$parent.children(".panel").children(".in, .collapsing");if(!(e&&e.length&&(b=e.data("bs.collapse"),b&&b.transitioning))){var f=a.Event("show.bs.collapse");if(this.$element.trigger(f),!f.isDefaultPrevented()){e&&e.length&&(c.call(e,"hide"),b||e.data("bs.collapse",null));var g=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded",!0),this.$trigger.removeClass("collapsed").attr("aria-expanded",!0),this.transitioning=1;var h=function(){this.$element.removeClass("collapsing").addClass("collapse in")[g](""),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!a.support.transition)return h.call(this);var i=a.camelCase(["scroll",g].join("-"));this.$element.one("bsTransitionEnd",a.proxy(h,this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i])}}}},d.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var b=a.Event("hide.bs.collapse");if(this.$element.trigger(b),!b.isDefaultPrevented()){var c=this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded",!1),this.$trigger.addClass("collapsed").attr("aria-expanded",!1),this.transitioning=1;var e=function(){this.transitioning=0,this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")};return a.support.transition?void this.$element[c](0).one("bsTransitionEnd",a.proxy(e,this)).emulateTransitionEnd(d.TRANSITION_DURATION):e.call(this)}}},d.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()},d.prototype.getParent=function(){return a(this.options.parent).find('[data-toggle="collapse"][data-parent="'+this.options.parent+'"]').each(a.proxy(function(c,d){var e=a(d);this.addAriaAndCollapsedClass(b(e),e)},this)).end()},d.prototype.addAriaAndCollapsedClass=function(a,b){var c=a.hasClass("in");a.attr("aria-expanded",c),b.toggleClass("collapsed",!c).attr("aria-expanded",c)};var e=a.fn.collapse;a.fn.collapse=c,a.fn.collapse.Constructor=d,a.fn.collapse.noConflict=function(){return a.fn.collapse=e,this},a(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(d){var e=a(this);e.attr("data-target")||d.preventDefault();var f=b(e),g=f.data("bs.collapse"),h=g?"toggle":e.data();c.call(f,h)})}(jQuery),+function(a){"use strict";function b(b){var c=b.attr("data-target");c||(c=b.attr("href"),c=c&&/#[A-Za-z]/.test(c)&&c.replace(/.*(?=#[^\s]*$)/,""));var d=c&&a(c);return d&&d.length?d:b.parent()}function c(c){c&&3===c.which||(a(e).remove(),a(f).each(function(){var d=a(this),e=b(d),f={relatedTarget:this};e.hasClass("open")&&(c&&"click"==c.type&&/input|textarea/i.test(c.target.tagName)&&a.contains(e[0],c.target)||(e.trigger(c=a.Event("hide.bs.dropdown",f)),c.isDefaultPrevented()||(d.attr("aria-expanded","false"),e.removeClass("open").trigger(a.Event("hidden.bs.dropdown",f)))))}))}function d(b){return this.each(function(){var c=a(this),d=c.data("bs.dropdown");d||c.data("bs.dropdown",d=new g(this)),"string"==typeof b&&d[b].call(c)})}var e=".dropdown-backdrop",f='[data-toggle="dropdown"]',g=function(b){a(b).on("click.bs.dropdown",this.toggle)};g.VERSION="3.3.6",g.prototype.toggle=function(d){var e=a(this);if(!e.is(".disabled, :disabled")){var f=b(e),g=f.hasClass("open");if(c(),!g){"ontouchstart"in document.documentElement&&!f.closest(".navbar-nav").length&&a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click",c);var h={relatedTarget:this};if(f.trigger(d=a.Event("show.bs.dropdown",h)),d.isDefaultPrevented())return;e.trigger("focus").attr("aria-expanded","true"),f.toggleClass("open").trigger(a.Event("shown.bs.dropdown",h))}return!1}},g.prototype.keydown=function(c){if(/(38|40|27|32)/.test(c.which)&&!/input|textarea/i.test(c.target.tagName)){var d=a(this);if(c.preventDefault(),c.stopPropagation(),!d.is(".disabled, :disabled")){var e=b(d),g=e.hasClass("open");if(!g&&27!=c.which||g&&27==c.which)return 27==c.which&&e.find(f).trigger("focus"),d.trigger("click");var h=" li:not(.disabled):visible a",i=e.find(".dropdown-menu"+h);if(i.length){var j=i.index(c.target);38==c.which&&j>0&&j--,40==c.which&&j<i.length-1&&j++,~j||(j=0),i.eq(j).trigger("focus")}}}};var h=a.fn.dropdown;a.fn.dropdown=d,a.fn.dropdown.Constructor=g,a.fn.dropdown.noConflict=function(){return a.fn.dropdown=h,this},a(document).on("click.bs.dropdown.data-api",c).on("click.bs.dropdown.data-api",".dropdown form",function(a){a.stopPropagation()}).on("click.bs.dropdown.data-api",f,g.prototype.toggle).on("keydown.bs.dropdown.data-api",f,g.prototype.keydown).on("keydown.bs.dropdown.data-api",".dropdown-menu",g.prototype.keydown)}(jQuery),+function(a){"use strict";function b(b,d){return this.each(function(){var e=a(this),f=e.data("bs.modal"),g=a.extend({},c.DEFAULTS,e.data(),"object"==typeof b&&b);f||e.data("bs.modal",f=new c(this,g)),"string"==typeof b?f[b](d):g.show&&f.show(d)})}var c=function(b,c){this.options=c,this.$body=a(document.body),this.$element=a(b),this.$dialog=this.$element.find(".modal-dialog"),this.$backdrop=null,this.isShown=null,this.originalBodyPad=null,this.scrollbarWidth=0,this.ignoreBackdropClick=!1,this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,a.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};c.VERSION="3.3.6",c.TRANSITION_DURATION=300,c.BACKDROP_TRANSITION_DURATION=150,c.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},c.prototype.toggle=function(a){return this.isShown?this.hide():this.show(a)},c.prototype.show=function(b){var d=this,e=a.Event("show.bs.modal",{relatedTarget:b});this.$element.trigger(e),this.isShown||e.isDefaultPrevented()||(this.isShown=!0,this.checkScrollbar(),this.setScrollbar(),this.$body.addClass("modal-open"),this.escape(),this.resize(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.$dialog.on("mousedown.dismiss.bs.modal",function(){d.$element.one("mouseup.dismiss.bs.modal",function(b){a(b.target).is(d.$element)&&(d.ignoreBackdropClick=!0)})}),this.backdrop(function(){var e=a.support.transition&&d.$element.hasClass("fade");d.$element.parent().length||d.$element.appendTo(d.$body),d.$element.show().scrollTop(0),d.adjustDialog(),e&&d.$element[0].offsetWidth,d.$element.addClass("in"),d.enforceFocus();var f=a.Event("shown.bs.modal",{relatedTarget:b});e?d.$dialog.one("bsTransitionEnd",function(){d.$element.trigger("focus").trigger(f)}).emulateTransitionEnd(c.TRANSITION_DURATION):d.$element.trigger("focus").trigger(f)}))},c.prototype.hide=function(b){b&&b.preventDefault(),b=a.Event("hide.bs.modal"),this.$element.trigger(b),this.isShown&&!b.isDefaultPrevented()&&(this.isShown=!1,this.escape(),this.resize(),a(document).off("focusin.bs.modal"),this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"),this.$dialog.off("mousedown.dismiss.bs.modal"),a.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",a.proxy(this.hideModal,this)).emulateTransitionEnd(c.TRANSITION_DURATION):this.hideModal())},c.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(a){this.$element[0]===a.target||this.$element.has(a.target).length||this.$element.trigger("focus")},this))},c.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keydown.dismiss.bs.modal",a.proxy(function(a){27==a.which&&this.hide()},this)):this.isShown||this.$element.off("keydown.dismiss.bs.modal")},c.prototype.resize=function(){this.isShown?a(window).on("resize.bs.modal",a.proxy(this.handleUpdate,this)):a(window).off("resize.bs.modal")},c.prototype.hideModal=function(){var a=this;this.$element.hide(),this.backdrop(function(){a.$body.removeClass("modal-open"),a.resetAdjustments(),a.resetScrollbar(),a.$element.trigger("hidden.bs.modal")})},c.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},c.prototype.backdrop=function(b){var d=this,e=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var f=a.support.transition&&e;if(this.$backdrop=a(document.createElement("div")).addClass("modal-backdrop "+e).appendTo(this.$body),this.$element.on("click.dismiss.bs.modal",a.proxy(function(a){return this.ignoreBackdropClick?void(this.ignoreBackdropClick=!1):void(a.target===a.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus():this.hide()))},this)),f&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!b)return;f?this.$backdrop.one("bsTransitionEnd",b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):b()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var g=function(){d.removeBackdrop(),b&&b()};a.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):g()}else b&&b()},c.prototype.handleUpdate=function(){this.adjustDialog()},c.prototype.adjustDialog=function(){var a=this.$element[0].scrollHeight>document.documentElement.clientHeight;this.$element.css({paddingLeft:!this.bodyIsOverflowing&&a?this.scrollbarWidth:"",paddingRight:this.bodyIsOverflowing&&!a?this.scrollbarWidth:""})},c.prototype.resetAdjustments=function(){this.$element.css({paddingLeft:"",paddingRight:""})},c.prototype.checkScrollbar=function(){var a=window.innerWidth;if(!a){var b=document.documentElement.getBoundingClientRect();a=b.right-Math.abs(b.left)}this.bodyIsOverflowing=document.body.clientWidth<a,this.scrollbarWidth=this.measureScrollbar()},c.prototype.setScrollbar=function(){var a=parseInt(this.$body.css("padding-right")||0,10);this.originalBodyPad=document.body.style.paddingRight||"",this.bodyIsOverflowing&&this.$body.css("padding-right",a+this.scrollbarWidth)},c.prototype.resetScrollbar=function(){this.$body.css("padding-right",this.originalBodyPad)},c.prototype.measureScrollbar=function(){var a=document.createElement("div");a.className="modal-scrollbar-measure",this.$body.append(a);var b=a.offsetWidth-a.clientWidth;return this.$body[0].removeChild(a),b};var d=a.fn.modal;a.fn.modal=b,a.fn.modal.Constructor=c,a.fn.modal.noConflict=function(){return a.fn.modal=d,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(c){var d=a(this),e=d.attr("href"),f=a(d.attr("data-target")||e&&e.replace(/.*(?=#[^\s]+$)/,"")),g=f.data("bs.modal")?"toggle":a.extend({remote:!/#/.test(e)&&e},f.data(),d.data());d.is("a")&&c.preventDefault(),f.one("show.bs.modal",function(a){a.isDefaultPrevented()||f.one("hidden.bs.modal",function(){d.is(":visible")&&d.trigger("focus")})}),b.call(f,g,this)})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tooltip"),f="object"==typeof b&&b;(e||!/destroy|hide/.test(b))&&(e||d.data("bs.tooltip",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.type=null,this.options=null,this.enabled=null,this.timeout=null,this.hoverState=null,this.$element=null,this.inState=null,this.init("tooltip",a,b)};c.VERSION="3.3.6",c.TRANSITION_DURATION=150,c.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0}},c.prototype.init=function(b,c,d){if(this.enabled=!0,this.type=b,this.$element=a(c),this.options=this.getOptions(d),this.$viewport=this.options.viewport&&a(a.isFunction(this.options.viewport)?this.options.viewport.call(this,this.$element):this.options.viewport.selector||this.options.viewport),this.inState={click:!1,hover:!1,focus:!1},this.$element[0]instanceof document.constructor&&!this.options.selector)throw new Error("`selector` option must be specified when initializing "+this.type+" on the window.document object!");for(var e=this.options.trigger.split(" "),f=e.length;f--;){var g=e[f];if("click"==g)this.$element.on("click."+this.type,this.options.selector,a.proxy(this.toggle,this));else if("manual"!=g){var h="hover"==g?"mouseenter":"focusin",i="hover"==g?"mouseleave":"focusout";this.$element.on(h+"."+this.type,this.options.selector,a.proxy(this.enter,this)),this.$element.on(i+"."+this.type,this.options.selector,a.proxy(this.leave,this))}}this.options.selector?this._options=a.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.getOptions=function(b){return b=a.extend({},this.getDefaults(),this.$element.data(),b),b.delay&&"number"==typeof b.delay&&(b.delay={show:b.delay,hide:b.delay}),b},c.prototype.getDelegateOptions=function(){var b={},c=this.getDefaults();return this._options&&a.each(this._options,function(a,d){c[a]!=d&&(b[a]=d)}),b},c.prototype.enter=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusin"==b.type?"focus":"hover"]=!0),c.tip().hasClass("in")||"in"==c.hoverState?void(c.hoverState="in"):(clearTimeout(c.timeout),c.hoverState="in",c.options.delay&&c.options.delay.show?void(c.timeout=setTimeout(function(){"in"==c.hoverState&&c.show()},c.options.delay.show)):c.show())},c.prototype.isInStateTrue=function(){for(var a in this.inState)if(this.inState[a])return!0;return!1},c.prototype.leave=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusout"==b.type?"focus":"hover"]=!1),c.isInStateTrue()?void 0:(clearTimeout(c.timeout),c.hoverState="out",c.options.delay&&c.options.delay.hide?void(c.timeout=setTimeout(function(){"out"==c.hoverState&&c.hide()},c.options.delay.hide)):c.hide())},c.prototype.show=function(){var b=a.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(b);var d=a.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(b.isDefaultPrevented()||!d)return;var e=this,f=this.tip(),g=this.getUID(this.type);this.setContent(),f.attr("id",g),this.$element.attr("aria-describedby",g),this.options.animation&&f.addClass("fade");var h="function"==typeof this.options.placement?this.options.placement.call(this,f[0],this.$element[0]):this.options.placement,i=/\s?auto?\s?/i,j=i.test(h);j&&(h=h.replace(i,"")||"top"),f.detach().css({top:0,left:0,display:"block"}).addClass(h).data("bs."+this.type,this),this.options.container?f.appendTo(this.options.container):f.insertAfter(this.$element),this.$element.trigger("inserted.bs."+this.type);var k=this.getPosition(),l=f[0].offsetWidth,m=f[0].offsetHeight;if(j){var n=h,o=this.getPosition(this.$viewport);h="bottom"==h&&k.bottom+m>o.bottom?"top":"top"==h&&k.top-m<o.top?"bottom":"right"==h&&k.right+l>o.width?"left":"left"==h&&k.left-l<o.left?"right":h,f.removeClass(n).addClass(h)}var p=this.getCalculatedOffset(h,k,l,m);this.applyPlacement(p,h);var q=function(){var a=e.hoverState;e.$element.trigger("shown.bs."+e.type),e.hoverState=null,"out"==a&&e.leave(e)};a.support.transition&&this.$tip.hasClass("fade")?f.one("bsTransitionEnd",q).emulateTransitionEnd(c.TRANSITION_DURATION):q()}},c.prototype.applyPlacement=function(b,c){var d=this.tip(),e=d[0].offsetWidth,f=d[0].offsetHeight,g=parseInt(d.css("margin-top"),10),h=parseInt(d.css("margin-left"),10);isNaN(g)&&(g=0),isNaN(h)&&(h=0),b.top+=g,b.left+=h,a.offset.setOffset(d[0],a.extend({using:function(a){d.css({top:Math.round(a.top),left:Math.round(a.left)})}},b),0),d.addClass("in");var i=d[0].offsetWidth,j=d[0].offsetHeight;"top"==c&&j!=f&&(b.top=b.top+f-j);var k=this.getViewportAdjustedDelta(c,b,i,j);k.left?b.left+=k.left:b.top+=k.top;var l=/top|bottom/.test(c),m=l?2*k.left-e+i:2*k.top-f+j,n=l?"offsetWidth":"offsetHeight";d.offset(b),this.replaceArrow(m,d[0][n],l)},c.prototype.replaceArrow=function(a,b,c){this.arrow().css(c?"left":"top",50*(1-a/b)+"%").css(c?"top":"left","")},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle();a.find(".tooltip-inner")[this.options.html?"html":"text"](b),a.removeClass("fade in top bottom left right")},c.prototype.hide=function(b){function d(){"in"!=e.hoverState&&f.detach(),e.$element.removeAttr("aria-describedby").trigger("hidden.bs."+e.type),b&&b()}var e=this,f=a(this.$tip),g=a.Event("hide.bs."+this.type);return this.$element.trigger(g),g.isDefaultPrevented()?void 0:(f.removeClass("in"),a.support.transition&&f.hasClass("fade")?f.one("bsTransitionEnd",d).emulateTransitionEnd(c.TRANSITION_DURATION):d(),this.hoverState=null,this)},c.prototype.fixTitle=function(){var a=this.$element;(a.attr("title")||"string"!=typeof a.attr("data-original-title"))&&a.attr("data-original-title",a.attr("title")||"").attr("title","")},c.prototype.hasContent=function(){return this.getTitle()},c.prototype.getPosition=function(b){b=b||this.$element;var c=b[0],d="BODY"==c.tagName,e=c.getBoundingClientRect();null==e.width&&(e=a.extend({},e,{width:e.right-e.left,height:e.bottom-e.top}));var f=d?{top:0,left:0}:b.offset(),g={scroll:d?document.documentElement.scrollTop||document.body.scrollTop:b.scrollTop()},h=d?{width:a(window).width(),height:a(window).height()}:null;return a.extend({},e,g,h,f)},c.prototype.getCalculatedOffset=function(a,b,c,d){return"bottom"==a?{top:b.top+b.height,left:b.left+b.width/2-c/2}:"top"==a?{top:b.top-d,left:b.left+b.width/2-c/2}:"left"==a?{top:b.top+b.height/2-d/2,left:b.left-c}:{top:b.top+b.height/2-d/2,left:b.left+b.width}},c.prototype.getViewportAdjustedDelta=function(a,b,c,d){var e={top:0,left:0};if(!this.$viewport)return e;var f=this.options.viewport&&this.options.viewport.padding||0,g=this.getPosition(this.$viewport);if(/right|left/.test(a)){var h=b.top-f-g.scroll,i=b.top+f-g.scroll+d;h<g.top?e.top=g.top-h:i>g.top+g.height&&(e.top=g.top+g.height-i)}else{var j=b.left-f,k=b.left+f+c;j<g.left?e.left=g.left-j:k>g.right&&(e.left=g.left+g.width-k)}return e},c.prototype.getTitle=function(){var a,b=this.$element,c=this.options;return a=b.attr("data-original-title")||("function"==typeof c.title?c.title.call(b[0]):c.title)},c.prototype.getUID=function(a){do a+=~~(1e6*Math.random());while(document.getElementById(a));return a},c.prototype.tip=function(){if(!this.$tip&&(this.$tip=a(this.options.template),1!=this.$tip.length))throw new Error(this.type+" `template` option must consist of exactly 1 top-level element!");return this.$tip},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},c.prototype.enable=function(){this.enabled=!0},c.prototype.disable=function(){this.enabled=!1},c.prototype.toggleEnabled=function(){this.enabled=!this.enabled},c.prototype.toggle=function(b){var c=this;b&&(c=a(b.currentTarget).data("bs."+this.type),c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c))),b?(c.inState.click=!c.inState.click,c.isInStateTrue()?c.enter(c):c.leave(c)):c.tip().hasClass("in")?c.leave(c):c.enter(c)},c.prototype.destroy=function(){var a=this;clearTimeout(this.timeout),this.hide(function(){a.$element.off("."+a.type).removeData("bs."+a.type),a.$tip&&a.$tip.detach(),a.$tip=null,a.$arrow=null,a.$viewport=null})};var d=a.fn.tooltip;a.fn.tooltip=b,a.fn.tooltip.Constructor=c,a.fn.tooltip.noConflict=function(){return a.fn.tooltip=d,this}}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.popover"),f="object"==typeof b&&b;(e||!/destroy|hide/.test(b))&&(e||d.data("bs.popover",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.init("popover",a,b)};if(!a.fn.tooltip)throw new Error("Popover requires tooltip.js");c.VERSION="3.3.6",c.DEFAULTS=a.extend({},a.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'}),c.prototype=a.extend({},a.fn.tooltip.Constructor.prototype),c.prototype.constructor=c,c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle(),c=this.getContent();a.find(".popover-title")[this.options.html?"html":"text"](b),a.find(".popover-content").children().detach().end()[this.options.html?"string"==typeof c?"html":"append":"text"](c),a.removeClass("fade top bottom left right in"),a.find(".popover-title").html()||a.find(".popover-title").hide()},c.prototype.hasContent=function(){return this.getTitle()||this.getContent()},c.prototype.getContent=function(){var a=this.$element,b=this.options;return a.attr("data-content")||("function"==typeof b.content?b.content.call(a[0]):b.content)},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")};var d=a.fn.popover;a.fn.popover=b,a.fn.popover.Constructor=c,a.fn.popover.noConflict=function(){return a.fn.popover=d,this}}(jQuery),+function(a){"use strict";function b(c,d){this.$body=a(document.body),this.$scrollElement=a(a(c).is(document.body)?window:c),this.options=a.extend({},b.DEFAULTS,d),this.selector=(this.options.target||"")+" .nav li > a",this.offsets=[],this.targets=[],this.activeTarget=null,this.scrollHeight=0,this.$scrollElement.on("scroll.bs.scrollspy",a.proxy(this.process,this)),this.refresh(),this.process()}function c(c){return this.each(function(){var d=a(this),e=d.data("bs.scrollspy"),f="object"==typeof c&&c;e||d.data("bs.scrollspy",e=new b(this,f)),"string"==typeof c&&e[c]()})}b.VERSION="3.3.6",b.DEFAULTS={offset:10},b.prototype.getScrollHeight=function(){return this.$scrollElement[0].scrollHeight||Math.max(this.$body[0].scrollHeight,document.documentElement.scrollHeight)},b.prototype.refresh=function(){var b=this,c="offset",d=0;this.offsets=[],this.targets=[],this.scrollHeight=this.getScrollHeight(),a.isWindow(this.$scrollElement[0])||(c="position",d=this.$scrollElement.scrollTop()),this.$body.find(this.selector).map(function(){var b=a(this),e=b.data("target")||b.attr("href"),f=/^#./.test(e)&&a(e);return f&&f.length&&f.is(":visible")&&[[f[c]().top+d,e]]||null}).sort(function(a,b){return a[0]-b[0]}).each(function(){b.offsets.push(this[0]),b.targets.push(this[1])})},b.prototype.process=function(){var a,b=this.$scrollElement.scrollTop()+this.options.offset,c=this.getScrollHeight(),d=this.options.offset+c-this.$scrollElement.height(),e=this.offsets,f=this.targets,g=this.activeTarget;if(this.scrollHeight!=c&&this.refresh(),b>=d)return g!=(a=f[f.length-1])&&this.activate(a);if(g&&b<e[0])return this.activeTarget=null,this.clear();for(a=e.length;a--;)g!=f[a]&&b>=e[a]&&(void 0===e[a+1]||b<e[a+1])&&this.activate(f[a])},b.prototype.activate=function(b){this.activeTarget=b,this.clear();var c=this.selector+'[data-target="'+b+'"],'+this.selector+'[href="'+b+'"]',d=a(c).parents("li").addClass("active");
    d.parent(".dropdown-menu").length&&(d=d.closest("li.dropdown").addClass("active")),d.trigger("activate.bs.scrollspy")},b.prototype.clear=function(){a(this.selector).parentsUntil(this.options.target,".active").removeClass("active")};var d=a.fn.scrollspy;a.fn.scrollspy=c,a.fn.scrollspy.Constructor=b,a.fn.scrollspy.noConflict=function(){return a.fn.scrollspy=d,this},a(window).on("load.bs.scrollspy.data-api",function(){a('[data-spy="scroll"]').each(function(){var b=a(this);c.call(b,b.data())})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tab");e||d.data("bs.tab",e=new c(this)),"string"==typeof b&&e[b]()})}var c=function(b){this.element=a(b)};c.VERSION="3.3.6",c.TRANSITION_DURATION=150,c.prototype.show=function(){var b=this.element,c=b.closest("ul:not(.dropdown-menu)"),d=b.data("target");if(d||(d=b.attr("href"),d=d&&d.replace(/.*(?=#[^\s]*$)/,"")),!b.parent("li").hasClass("active")){var e=c.find(".active:last a"),f=a.Event("hide.bs.tab",{relatedTarget:b[0]}),g=a.Event("show.bs.tab",{relatedTarget:e[0]});if(e.trigger(f),b.trigger(g),!g.isDefaultPrevented()&&!f.isDefaultPrevented()){var h=a(d);this.activate(b.closest("li"),c),this.activate(h,h.parent(),function(){e.trigger({type:"hidden.bs.tab",relatedTarget:b[0]}),b.trigger({type:"shown.bs.tab",relatedTarget:e[0]})})}}},c.prototype.activate=function(b,d,e){function f(){g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!1),b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded",!0),h?(b[0].offsetWidth,b.addClass("in")):b.removeClass("fade"),b.parent(".dropdown-menu").length&&b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!0),e&&e()}var g=d.find("> .active"),h=e&&a.support.transition&&(g.length&&g.hasClass("fade")||!!d.find("> .fade").length);g.length&&h?g.one("bsTransitionEnd",f).emulateTransitionEnd(c.TRANSITION_DURATION):f(),g.removeClass("in")};var d=a.fn.tab;a.fn.tab=b,a.fn.tab.Constructor=c,a.fn.tab.noConflict=function(){return a.fn.tab=d,this};var e=function(c){c.preventDefault(),b.call(a(this),"show")};a(document).on("click.bs.tab.data-api",'[data-toggle="tab"]',e).on("click.bs.tab.data-api",'[data-toggle="pill"]',e)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.affix"),f="object"==typeof b&&b;e||d.data("bs.affix",e=new c(this,f)),"string"==typeof b&&e[b]()})}var c=function(b,d){this.options=a.extend({},c.DEFAULTS,d),this.$target=a(this.options.target).on("scroll.bs.affix.data-api",a.proxy(this.checkPosition,this)).on("click.bs.affix.data-api",a.proxy(this.checkPositionWithEventLoop,this)),this.$element=a(b),this.affixed=null,this.unpin=null,this.pinnedOffset=null,this.checkPosition()};c.VERSION="3.3.6",c.RESET="affix affix-top affix-bottom",c.DEFAULTS={offset:0,target:window},c.prototype.getState=function(a,b,c,d){var e=this.$target.scrollTop(),f=this.$element.offset(),g=this.$target.height();if(null!=c&&"top"==this.affixed)return c>e?"top":!1;if("bottom"==this.affixed)return null!=c?e+this.unpin<=f.top?!1:"bottom":a-d>=e+g?!1:"bottom";var h=null==this.affixed,i=h?e:f.top,j=h?g:b;return null!=c&&c>=e?"top":null!=d&&i+j>=a-d?"bottom":!1},c.prototype.getPinnedOffset=function(){if(this.pinnedOffset)return this.pinnedOffset;this.$element.removeClass(c.RESET).addClass("affix");var a=this.$target.scrollTop(),b=this.$element.offset();return this.pinnedOffset=b.top-a},c.prototype.checkPositionWithEventLoop=function(){setTimeout(a.proxy(this.checkPosition,this),1)},c.prototype.checkPosition=function(){if(this.$element.is(":visible")){var b=this.$element.height(),d=this.options.offset,e=d.top,f=d.bottom,g=Math.max(a(document).height(),a(document.body).height());"object"!=typeof d&&(f=e=d),"function"==typeof e&&(e=d.top(this.$element)),"function"==typeof f&&(f=d.bottom(this.$element));var h=this.getState(g,b,e,f);if(this.affixed!=h){null!=this.unpin&&this.$element.css("top","");var i="affix"+(h?"-"+h:""),j=a.Event(i+".bs.affix");if(this.$element.trigger(j),j.isDefaultPrevented())return;this.affixed=h,this.unpin="bottom"==h?this.getPinnedOffset():null,this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix","affixed")+".bs.affix")}"bottom"==h&&this.$element.offset({top:g-b-f})}};var d=a.fn.affix;a.fn.affix=b,a.fn.affix.Constructor=c,a.fn.affix.noConflict=function(){return a.fn.affix=d,this},a(window).on("load",function(){a('[data-spy="affix"]').each(function(){var c=a(this),d=c.data();d.offset=d.offset||{},null!=d.offsetBottom&&(d.offset.bottom=d.offsetBottom),null!=d.offsetTop&&(d.offset.top=d.offsetTop),b.call(c,d)})})}(jQuery);;/*!
Waypoints - 4.0.1
Copyright © 2011-2016 Caleb Troughton
Licensed under the MIT license.
https://github.com/imakewebthings/waypoints/blob/master/licenses.txt
*/
!function(){"use strict";function t(o){if(!o)throw new Error("No options passed to Waypoint constructor");if(!o.element)throw new Error("No element option passed to Waypoint constructor");if(!o.handler)throw new Error("No handler option passed to Waypoint constructor");this.key="waypoint-"+e,this.options=t.Adapter.extend({},t.defaults,o),this.element=this.options.element,this.adapter=new t.Adapter(this.element),this.callback=o.handler,this.axis=this.options.horizontal?"horizontal":"vertical",this.enabled=this.options.enabled,this.triggerPoint=null,this.group=t.Group.findOrCreate({name:this.options.group,axis:this.axis}),this.context=t.Context.findOrCreateByElement(this.options.context),t.offsetAliases[this.options.offset]&&(this.options.offset=t.offsetAliases[this.options.offset]),this.group.add(this),this.context.add(this),i[this.key]=this,e+=1}var e=0,i={};t.prototype.queueTrigger=function(t){this.group.queueTrigger(this,t)},t.prototype.trigger=function(t){this.enabled&&this.callback&&this.callback.apply(this,t)},t.prototype.destroy=function(){this.context.remove(this),this.group.remove(this),delete i[this.key]},t.prototype.disable=function(){return this.enabled=!1,this},t.prototype.enable=function(){return this.context.refresh(),this.enabled=!0,this},t.prototype.next=function(){return this.group.next(this)},t.prototype.previous=function(){return this.group.previous(this)},t.invokeAll=function(t){var e=[];for(var o in i)e.push(i[o]);for(var n=0,r=e.length;r>n;n++)e[n][t]()},t.destroyAll=function(){t.invokeAll("destroy")},t.disableAll=function(){t.invokeAll("disable")},t.enableAll=function(){t.Context.refreshAll();for(var e in i)i[e].enabled=!0;return this},t.refreshAll=function(){t.Context.refreshAll()},t.viewportHeight=function(){return window.innerHeight||document.documentElement.clientHeight},t.viewportWidth=function(){return document.documentElement.clientWidth},t.adapters=[],t.defaults={context:window,continuous:!0,enabled:!0,group:"default",horizontal:!1,offset:0},t.offsetAliases={"bottom-in-view":function(){return this.context.innerHeight()-this.adapter.outerHeight()},"right-in-view":function(){return this.context.innerWidth()-this.adapter.outerWidth()}},window.Waypoint=t}(),function(){"use strict";function t(t){window.setTimeout(t,1e3/60)}function e(t){this.element=t,this.Adapter=n.Adapter,this.adapter=new this.Adapter(t),this.key="waypoint-context-"+i,this.didScroll=!1,this.didResize=!1,this.oldScroll={x:this.adapter.scrollLeft(),y:this.adapter.scrollTop()},this.waypoints={vertical:{},horizontal:{}},t.waypointContextKey=this.key,o[t.waypointContextKey]=this,i+=1,n.windowContext||(n.windowContext=!0,n.windowContext=new e(window)),this.createThrottledScrollHandler(),this.createThrottledResizeHandler()}var i=0,o={},n=window.Waypoint,r=window.onload;e.prototype.add=function(t){var e=t.options.horizontal?"horizontal":"vertical";this.waypoints[e][t.key]=t,this.refresh()},e.prototype.checkEmpty=function(){var t=this.Adapter.isEmptyObject(this.waypoints.horizontal),e=this.Adapter.isEmptyObject(this.waypoints.vertical),i=this.element==this.element.window;t&&e&&!i&&(this.adapter.off(".waypoints"),delete o[this.key])},e.prototype.createThrottledResizeHandler=function(){function t(){e.handleResize(),e.didResize=!1}var e=this;this.adapter.on("resize.waypoints",function(){e.didResize||(e.didResize=!0,n.requestAnimationFrame(t))})},e.prototype.createThrottledScrollHandler=function(){function t(){e.handleScroll(),e.didScroll=!1}var e=this;this.adapter.on("scroll.waypoints",function(){(!e.didScroll||n.isTouch)&&(e.didScroll=!0,n.requestAnimationFrame(t))})},e.prototype.handleResize=function(){n.Context.refreshAll()},e.prototype.handleScroll=function(){var t={},e={horizontal:{newScroll:this.adapter.scrollLeft(),oldScroll:this.oldScroll.x,forward:"right",backward:"left"},vertical:{newScroll:this.adapter.scrollTop(),oldScroll:this.oldScroll.y,forward:"down",backward:"up"}};for(var i in e){var o=e[i],n=o.newScroll>o.oldScroll,r=n?o.forward:o.backward;for(var s in this.waypoints[i]){var a=this.waypoints[i][s];if(null!==a.triggerPoint){var l=o.oldScroll<a.triggerPoint,h=o.newScroll>=a.triggerPoint,p=l&&h,u=!l&&!h;(p||u)&&(a.queueTrigger(r),t[a.group.id]=a.group)}}}for(var c in t)t[c].flushTriggers();this.oldScroll={x:e.horizontal.newScroll,y:e.vertical.newScroll}},e.prototype.innerHeight=function(){return this.element==this.element.window?n.viewportHeight():this.adapter.innerHeight()},e.prototype.remove=function(t){delete this.waypoints[t.axis][t.key],this.checkEmpty()},e.prototype.innerWidth=function(){return this.element==this.element.window?n.viewportWidth():this.adapter.innerWidth()},e.prototype.destroy=function(){var t=[];for(var e in this.waypoints)for(var i in this.waypoints[e])t.push(this.waypoints[e][i]);for(var o=0,n=t.length;n>o;o++)t[o].destroy()},e.prototype.refresh=function(){var t,e=this.element==this.element.window,i=e?void 0:this.adapter.offset(),o={};this.handleScroll(),t={horizontal:{contextOffset:e?0:i.left,contextScroll:e?0:this.oldScroll.x,contextDimension:this.innerWidth(),oldScroll:this.oldScroll.x,forward:"right",backward:"left",offsetProp:"left"},vertical:{contextOffset:e?0:i.top,contextScroll:e?0:this.oldScroll.y,contextDimension:this.innerHeight(),oldScroll:this.oldScroll.y,forward:"down",backward:"up",offsetProp:"top"}};for(var r in t){var s=t[r];for(var a in this.waypoints[r]){var l,h,p,u,c,d=this.waypoints[r][a],f=d.options.offset,w=d.triggerPoint,y=0,g=null==w;d.element!==d.element.window&&(y=d.adapter.offset()[s.offsetProp]),"function"==typeof f?f=f.apply(d):"string"==typeof f&&(f=parseFloat(f),d.options.offset.indexOf("%")>-1&&(f=Math.ceil(s.contextDimension*f/100))),l=s.contextScroll-s.contextOffset,d.triggerPoint=Math.floor(y+l-f),h=w<s.oldScroll,p=d.triggerPoint>=s.oldScroll,u=h&&p,c=!h&&!p,!g&&u?(d.queueTrigger(s.backward),o[d.group.id]=d.group):!g&&c?(d.queueTrigger(s.forward),o[d.group.id]=d.group):g&&s.oldScroll>=d.triggerPoint&&(d.queueTrigger(s.forward),o[d.group.id]=d.group)}}return n.requestAnimationFrame(function(){for(var t in o)o[t].flushTriggers()}),this},e.findOrCreateByElement=function(t){return e.findByElement(t)||new e(t)},e.refreshAll=function(){for(var t in o)o[t].refresh()},e.findByElement=function(t){return o[t.waypointContextKey]},window.onload=function(){r&&r(),e.refreshAll()},n.requestAnimationFrame=function(e){var i=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||t;i.call(window,e)},n.Context=e}(),function(){"use strict";function t(t,e){return t.triggerPoint-e.triggerPoint}function e(t,e){return e.triggerPoint-t.triggerPoint}function i(t){this.name=t.name,this.axis=t.axis,this.id=this.name+"-"+this.axis,this.waypoints=[],this.clearTriggerQueues(),o[this.axis][this.name]=this}var o={vertical:{},horizontal:{}},n=window.Waypoint;i.prototype.add=function(t){this.waypoints.push(t)},i.prototype.clearTriggerQueues=function(){this.triggerQueues={up:[],down:[],left:[],right:[]}},i.prototype.flushTriggers=function(){for(var i in this.triggerQueues){var o=this.triggerQueues[i],n="up"===i||"left"===i;o.sort(n?e:t);for(var r=0,s=o.length;s>r;r+=1){var a=o[r];(a.options.continuous||r===o.length-1)&&a.trigger([i])}}this.clearTriggerQueues()},i.prototype.next=function(e){this.waypoints.sort(t);var i=n.Adapter.inArray(e,this.waypoints),o=i===this.waypoints.length-1;return o?null:this.waypoints[i+1]},i.prototype.previous=function(e){this.waypoints.sort(t);var i=n.Adapter.inArray(e,this.waypoints);return i?this.waypoints[i-1]:null},i.prototype.queueTrigger=function(t,e){this.triggerQueues[e].push(t)},i.prototype.remove=function(t){var e=n.Adapter.inArray(t,this.waypoints);e>-1&&this.waypoints.splice(e,1)},i.prototype.first=function(){return this.waypoints[0]},i.prototype.last=function(){return this.waypoints[this.waypoints.length-1]},i.findOrCreate=function(t){return o[t.axis][t.name]||new i(t)},n.Group=i}(),function(){"use strict";function t(t){this.$element=e(t)}var e=window.jQuery,i=window.Waypoint;e.each(["innerHeight","innerWidth","off","offset","on","outerHeight","outerWidth","scrollLeft","scrollTop"],function(e,i){t.prototype[i]=function(){var t=Array.prototype.slice.call(arguments);return this.$element[i].apply(this.$element,t)}}),e.each(["extend","inArray","isEmptyObject"],function(i,o){t[o]=e[o]}),i.adapters.push({name:"jquery",Adapter:t}),i.Adapter=t}(),function(){"use strict";function t(t){return function(){var i=[],o=arguments[0];return t.isFunction(arguments[0])&&(o=t.extend({},arguments[1]),o.handler=arguments[0]),this.each(function(){var n=t.extend({},o,{element:this});"string"==typeof n.context&&(n.context=t(this).closest(n.context)[0]),i.push(new e(n))}),i}}var e=window.Waypoint;window.jQuery&&(window.jQuery.fn.waypoint=t(window.jQuery)),window.Zepto&&(window.Zepto.fn.waypoint=t(window.Zepto))}();;!function(a){var n,q,s,t,u,v,w,b="Close",c="BeforeClose",d="AfterClose",e="BeforeAppend",f="MarkupParse",g="Open",h="Change",i="mfp",j="."+i,k="mfp-ready",l="mfp-removing",m="mfp-prevent-close",o=function(){},p=!!window.jQuery,r=a(window),x=function(a,b){n.ev.on(i+a+j,b)},y=function(b,c,d,e){var f=document.createElement("div");return f.className="mfp-"+b,d&&(f.innerHTML=d),e?c&&c.appendChild(f):(f=a(f),c&&f.appendTo(c)),f},z=function(b,c){n.ev.triggerHandler(i+b,c),n.st.callbacks&&(b=b.charAt(0).toLowerCase()+b.slice(1),n.st.callbacks[b]&&n.st.callbacks[b].apply(n,a.isArray(c)?c:[c]))},A=function(){(n.st.focus?n.content.find(n.st.focus).eq(0):n.wrap).trigger("focus")},B=function(b){return b===w&&n.currTemplate.closeBtn||(n.currTemplate.closeBtn=a(n.st.closeMarkup.replace("%title%",n.st.tClose)),w=b),n.currTemplate.closeBtn},C=function(){a.magnificPopup.instance||(n=new o,n.init(),a.magnificPopup.instance=n)},D=function(b){if(!a(b).hasClass(m)){var c=n.st.closeOnContentClick,d=n.st.closeOnBgClick;if(c&&d)return!0;if(!n.content||a(b).hasClass("mfp-close")||n.preloader&&b===n.preloader[0])return!0;if(b===n.content[0]||a.contains(n.content[0],b)){if(c)return!0}else if(d&&a.contains(document,b))return!0;return!1}},E=function(){var a=document.createElement("p").style,b=["ms","O","Moz","Webkit"];if(void 0!==a.transition)return!0;for(;b.length;)if(b.pop()+"Transition"in a)return!0;return!1};o.prototype={constructor:o,init:function(){var b=navigator.appVersion;n.isIE7=-1!==b.indexOf("MSIE 7."),n.isIE8=-1!==b.indexOf("MSIE 8."),n.isLowIE=n.isIE7||n.isIE8,n.isAndroid=/android/gi.test(b),n.isIOS=/iphone|ipad|ipod/gi.test(b),n.supportsTransition=E(),n.probablyMobile=n.isAndroid||n.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),s=a(document.body),t=a(document),n.popupsCache={}},open:function(b){var c;if(b.isObj===!1){n.items=b.items.toArray(),n.index=0;var e,d=b.items;for(c=0;c<d.length;c++)if(e=d[c],e.parsed&&(e=e.el[0]),e===b.el[0]){n.index=c;break}}else n.items=a.isArray(b.items)?b.items:[b.items],n.index=b.index||0;if(n.isOpen)return void n.updateItemHTML();n.types=[],v="",b.mainEl&&b.mainEl.length?n.ev=b.mainEl.eq(0):n.ev=t,b.key?(n.popupsCache[b.key]||(n.popupsCache[b.key]={}),n.currTemplate=n.popupsCache[b.key]):n.currTemplate={},n.st=a.extend(!0,{},a.magnificPopup.defaults,b),n.fixedContentPos="auto"===n.st.fixedContentPos?!n.probablyMobile:n.st.fixedContentPos,n.st.modal&&(n.st.closeOnContentClick=!1,n.st.closeOnBgClick=!1,n.st.showCloseBtn=!1,n.st.enableEscapeKey=!1),n.bgOverlay||(n.bgOverlay=y("bg").on("click"+j,function(){n.close()}),n.wrap=y("wrap").attr("tabindex",-1).on("click"+j,function(a){D(a.target)&&n.close()}),n.container=y("container",n.wrap)),n.contentContainer=y("content"),n.st.preloader&&(n.preloader=y("preloader",n.container,n.st.tLoading));var h=a.magnificPopup.modules;for(c=0;c<h.length;c++){var i=h[c];i=i.charAt(0).toUpperCase()+i.slice(1),n["init"+i].call(n)}z("BeforeOpen"),n.st.showCloseBtn&&(n.st.closeBtnInside?(x(f,function(a,b,c,d){c.close_replaceWith=B(d.type)}),v+=" mfp-close-btn-in"):n.wrap.append(B())),n.st.alignTop&&(v+=" mfp-align-top"),n.fixedContentPos?n.wrap.css({overflow:n.st.overflowY,overflowX:"hidden",overflowY:n.st.overflowY}):n.wrap.css({top:r.scrollTop(),position:"absolute"}),(n.st.fixedBgPos===!1||"auto"===n.st.fixedBgPos&&!n.fixedContentPos)&&n.bgOverlay.css({height:t.height(),position:"absolute"}),n.st.enableEscapeKey&&t.on("keyup"+j,function(a){27===a.keyCode&&n.close()}),r.on("resize"+j,function(){n.updateSize()}),n.st.closeOnContentClick||(v+=" mfp-auto-cursor"),v&&n.wrap.addClass(v);var l=n.wH=r.height(),m={},o=n.st.mainClass;n.isIE7&&(o+=" mfp-ie7"),o&&n._addClassToMFP(o),n.updateItemHTML(),z("BuildControls"),a("html").css(m),n.bgOverlay.add(n.wrap).prependTo(document.body),n._lastFocusedEl=document.activeElement,setTimeout(function(){n.content?(n._addClassToMFP(k),A()):n.bgOverlay.addClass(k),t.on("focusin"+j,function(b){return b.target===n.wrap[0]||a.contains(n.wrap[0],b.target)?void 0:(A(),!1)})},16),n.isOpen=!0,n.updateSize(l),z(g)},close:function(){n.isOpen&&(z(c),n.isOpen=!1,n.st.removalDelay&&!n.isLowIE&&n.supportsTransition?(n._addClassToMFP(l),setTimeout(function(){n._close()},n.st.removalDelay)):n._close())},_close:function(){z(b);var c=l+" "+k+" ";if(n.bgOverlay.detach(),n.wrap.detach(),n.container.empty(),n.st.mainClass&&(c+=n.st.mainClass+" "),n._removeClassFromMFP(c),n.fixedContentPos){var e={paddingRight:""};a("html").css(e)}t.off("keyup"+j+" focusin"+j),n.ev.off(j),n.wrap.attr("class","mfp-wrap").removeAttr("style"),n.bgOverlay.attr("class","mfp-bg"),n.container.attr("class","mfp-container"),!n.st.showCloseBtn||n.st.closeBtnInside&&n.currTemplate[n.currItem.type]!==!0||n.currTemplate.closeBtn&&n.currTemplate.closeBtn.detach(),n._lastFocusedEl&&a(n._lastFocusedEl).trigger("focus"),n.currItem=null,n.content=null,n.currTemplate=null,n.prevHeight=0,z(d)},updateSize:function(a){if(n.isIOS){var b=document.documentElement.clientWidth/window.innerWidth,c=window.innerHeight*b;n.wrap.css("height",c),n.wH=c}else n.wH=a||r.height();n.fixedContentPos||n.wrap.css("height",n.wH),z("Resize")},updateItemHTML:function(){var b=n.items[n.index];n.contentContainer.detach(),n.content&&n.content.detach(),b.parsed||(b=n.parseEl(n.index));var c=b.type;if(z("BeforeChange",[n.currItem?n.currItem.type:"",c]),n.currItem=b,!n.currTemplate[c]){var d=n.st[c]?n.st[c].markup:!1;z("FirstMarkupParse",d),d?n.currTemplate[c]=a(d):n.currTemplate[c]=!0}u&&u!==b.type&&n.container.removeClass("mfp-"+u+"-holder");var e=n["get"+c.charAt(0).toUpperCase()+c.slice(1)](b,n.currTemplate[c]);n.appendContent(e,c),b.preloaded=!0,z(h,b),u=b.type,n.container.prepend(n.contentContainer),z("AfterChange")},appendContent:function(a,b){n.content=a,a?n.st.showCloseBtn&&n.st.closeBtnInside&&n.currTemplate[b]===!0?n.content.find(".mfp-close").length||n.content.append(B()):n.content=a:n.content="",z(e),n.container.addClass("mfp-"+b+"-holder"),n.contentContainer.append(n.content)},parseEl:function(b){var c=n.items[b],d=c.type;if(c=c.tagName?{el:a(c)}:{data:c,src:c.src},c.el){for(var e=n.types,f=0;f<e.length;f++)if(c.el.hasClass("mfp-"+e[f])){d=e[f];break}c.src=c.el.attr("data-mfp-src"),c.src||(c.src=c.el.attr("href"))}return c.type=d||n.st.type||"inline",c.index=b,c.parsed=!0,n.items[b]=c,z("ElementParse",c),n.items[b]},addGroup:function(a,b){var c=function(c){c.mfpEl=this,n._openClick(c,a,b)};b||(b={});var d="click.magnificPopup";b.mainEl=a,b.items?(b.isObj=!0,a.off(d).on(d,c)):(b.isObj=!1,b.delegate?a.off(d).on(d,b.delegate,c):(b.items=a,a.off(d).on(d,c)))},_openClick:function(b,c,d){var e=void 0!==d.midClick?d.midClick:a.magnificPopup.defaults.midClick;if(e||2!==b.which&&!b.ctrlKey&&!b.metaKey){var f=void 0!==d.disableOn?d.disableOn:a.magnificPopup.defaults.disableOn;if(f)if(a.isFunction(f)){if(!f.call(n))return!0}else if(r.width()<f)return!0;b.type&&(b.preventDefault(),n.isOpen&&b.stopPropagation()),d.el=a(b.mfpEl),d.delegate&&(d.items=c.find(d.delegate)),n.open(d)}},updateStatus:function(a,b){if(n.preloader){q!==a&&n.container.removeClass("mfp-s-"+q),b||"loading"!==a||(b=n.st.tLoading);var c={status:a,text:b};z("UpdateStatus",c),a=c.status,b=c.text,n.preloader.html(b),n.preloader.find("a").on("click",function(a){a.stopImmediatePropagation()}),n.container.addClass("mfp-s-"+a),q=a}},_addClassToMFP:function(a){n.bgOverlay.addClass(a),n.wrap.addClass(a)},_removeClassFromMFP:function(a){this.bgOverlay.removeClass(a),n.wrap.removeClass(a)},_hasScrollBar:function(a){return(n.isIE7?t.height():document.body.scrollHeight)>(a||r.height())},_parseMarkup:function(b,c,d){var e;d.data&&(c=a.extend(d.data,c)),z(f,[b,c,d]),a.each(c,function(a,c){if(void 0===c||c===!1)return!0;if(e=a.split("_"),e.length>1){var d=b.find(j+"-"+e[0]);if(d.length>0){var f=e[1];"replaceWith"===f?d[0]!==c[0]&&d.replaceWith(c):"img"===f?d.is("img")?d.attr("src",c):d.replaceWith('<img src="'+c+'" class="'+d.attr("class")+'" />'):d.attr(e[1],c)}}else b.find(j+"-"+a).html(c)})},_getScrollbarSize:function(){if(void 0===n.scrollbarSize){var a=document.createElement("div");a.id="mfp-sbm",a.style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(a),n.scrollbarSize=a.offsetWidth-a.clientWidth,document.body.removeChild(a)}return n.scrollbarSize}},a.magnificPopup={instance:null,proto:o.prototype,modules:[],open:function(a,b){return C(),a||(a={}),a.isObj=!0,a.index=b||0,this.instance.open(a)},close:function(){return a.magnificPopup.instance.close()},registerModule:function(b,c){c.options&&(a.magnificPopup.defaults[b]=c.options),a.extend(this.proto,c.proto),this.modules.push(b)},defaults:{disableOn:0,key:null,midClick:!0,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!1,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:300,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&times;</button>',tClose:"Close (Esc)",tLoading:"Loading...",callbacks:{beforeOpen:function(){this.st.image.markup=this.st.image.markup.replace("mfp-figure","mfp-figure mfp-with-anim"),"undefined"!=typeof this.st&&"undefined"!=typeof this.st.el&&(this.st.mainClass=this.st.el.attr("data-effect"))}}}},a.fn.magnificPopup=function(b){C();var c=a(this);if("string"==typeof b)if("open"===b){var d,e=p?c.data("magnificPopup"):c[0].magnificPopup,f=parseInt(arguments[1],10)||0;e.items?d=e.items[f]:(d=c,e.delegate&&(d=d.find(e.delegate)),d=d.eq(f)),n._openClick({mfpEl:d},c,e)}else n.isOpen&&n[b].apply(n,Array.prototype.slice.call(arguments,1));else p?c.data("magnificPopup",b):c[0].magnificPopup=b,n.addGroup(c,b);return c};var G,H,I,F="inline",J=function(){I&&(H.after(I.addClass(G)).detach(),I=null)};a.magnificPopup.registerModule(F,{options:{hiddenClass:"hide",markup:"",tNotFound:"Content not found"},proto:{initInline:function(){n.types.push(F),x(b+"."+F,function(){J()})},getInline:function(b,c){if(J(),b.src){var d=n.st.inline,e=a(b.src);if(e.length){var f=e[0].parentNode;f&&f.tagName&&(H||(G=d.hiddenClass,H=y(G),G="mfp-"+G),I=e.after(H).detach().removeClass(G)),n.updateStatus("ready")}else n.updateStatus("error",d.tNotFound),e=a("<div>");return b.inlineElement=e,e}return n.updateStatus("ready"),n._parseMarkup(c,{},b),c}}});var L,K="ajax",M=function(){L&&s.removeClass(L)};a.magnificPopup.registerModule(K,{options:{settings:null,cursor:"mfp-ajax-cur",tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){n.types.push(K),L=n.st.ajax.cursor,x(b+"."+K,function(){M(),n.req&&n.req.abort()})},getAjax:function(b){L&&s.addClass(L),n.updateStatus("loading");var c=a.extend({url:b.src,success:function(c,d,e){var f={data:c,xhr:e};z("ParseAjax",f),n.appendContent(a(f.data),K),b.finished=!0,M(),A(),setTimeout(function(){n.wrap.addClass(k)},16),n.updateStatus("ready"),z("AjaxContentAdded")},error:function(){M(),b.finished=b.loadError=!0,n.updateStatus("error",n.st.ajax.tError.replace("%url%",b.src))}},n.st.ajax.settings);return n.req=a.ajax(c),""}}});var N,O=function(b){if(b.data&&void 0!==b.data.title)return b.data.title;var c=n.st.image.titleSrc;if(c){if(a.isFunction(c))return c.call(n,b);if(b.el)return b.el.attr(c)||""}return""};a.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><div class="mfp-img"></div><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var a=n.st.image,c=".image";n.types.push("image"),x(g+c,function(){"image"===n.currItem.type&&a.cursor&&s.addClass(a.cursor)}),x(b+c,function(){a.cursor&&s.removeClass(a.cursor),r.off("resize"+j)}),x("Resize"+c,n.resizeImage),n.isLowIE&&x("AfterChange",n.resizeImage)},resizeImage:function(){var a=n.currItem;if(a.img&&n.st.image.verticalFit){var b=0;n.isLowIE&&(b=parseInt(a.img.css("padding-top"),10)+parseInt(a.img.css("padding-bottom"),10)),a.img.css("max-height",n.wH-b)}},_onImageHasSize:function(a){a.img&&(a.hasSize=!0,N&&clearInterval(N),a.isCheckingImgSize=!1,z("ImageHasSize",a),a.imgHidden&&(n.content&&n.content.removeClass("mfp-loading"),a.imgHidden=!1))},findImageSize:function(a){var b=0,c=a.img[0],d=function(e){N&&clearInterval(N),N=setInterval(function(){return c.naturalWidth>0?void n._onImageHasSize(a):(b>200&&clearInterval(N),b++,void(3===b?d(10):40===b?d(50):100===b&&d(500)))},e)};d(1)},getImage:function(b,c){var d=0,e=function(){b&&(b.img[0].complete?(b.img.off(".mfploader"),b===n.currItem&&(n._onImageHasSize(b),n.updateStatus("ready")),b.hasSize=!0,b.loaded=!0,z("ImageLoadComplete")):(d++,200>d?setTimeout(e,100):f()))},f=function(){b&&(b.img.off(".mfploader"),b===n.currItem&&(n._onImageHasSize(b),n.updateStatus("error",g.tError.replace("%url%",b.src))),b.hasSize=!0,b.loaded=!0,b.loadError=!0)},g=n.st.image,h=c.find(".mfp-img");if(h.length){var i=new Image;i.className="mfp-img",b.img=a(i).on("load.mfploader",e).on("error.mfploader",f),i.src=b.src,h.is("img")&&(b.img=b.img.clone()),b.img[0].naturalWidth>0&&(b.hasSize=!0)}return n._parseMarkup(c,{title:O(b),img_replaceWith:b.img},b),n.resizeImage(),b.hasSize?(N&&clearInterval(N),b.loadError?(c.addClass("mfp-loading"),n.updateStatus("error",g.tError.replace("%url%",b.src))):(c.removeClass("mfp-loading"),n.updateStatus("ready")),c):(n.updateStatus("loading"),b.loading=!0,b.hasSize||(b.imgHidden=!0,c.addClass("mfp-loading"),n.findImageSize(b)),c)}}});var P,Q=function(){return void 0===P&&(P=void 0!==document.createElement("p").style.MozTransform),P};a.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(a){return a.is("img")?a:a.find("img")}},proto:{initZoom:function(){var a=n.st.zoom,d=".zoom";if(a.enabled&&n.supportsTransition){var h,i,e=a.duration,f=function(b){var c=b.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),d="all "+a.duration/1e3+"s "+a.easing,e={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},f="transition";return e["-webkit-"+f]=e["-moz-"+f]=e["-o-"+f]=e[f]=d,c.css(e),c},g=function(){n.content.css("visibility","visible")};x("BuildControls"+d,function(){if(n._allowZoom()){if(clearTimeout(h),n.content.css("visibility","hidden"),image=n._getItemToZoom(),!image)return void g();i=f(image),i.css(n._getOffset()),n.wrap.append(i),h=setTimeout(function(){i.css(n._getOffset(!0)),h=setTimeout(function(){g(),setTimeout(function(){i.remove(),image=i=null,z("ZoomAnimationEnded")},16)},e)},16)}}),x(c+d,function(){if(n._allowZoom()){if(clearTimeout(h),n.st.removalDelay=e,!image){if(image=n._getItemToZoom(),!image)return;i=f(image)}i.css(n._getOffset(!0)),n.wrap.append(i),n.content.css("visibility","hidden"),setTimeout(function(){i.css(n._getOffset())},16)}}),x(b+d,function(){n._allowZoom()&&(g(),i&&i.remove())})}},_allowZoom:function(){return"image"===n.currItem.type},_getItemToZoom:function(){return n.currItem.hasSize?n.currItem.img:!1},_getOffset:function(b){var c;c=b?n.currItem.img:n.st.zoom.opener(n.currItem.el||n.currItem);var d=c.offset(),e=parseInt(c.css("padding-top"),10),f=parseInt(c.css("padding-bottom"),10);d.top-=a(window).scrollTop()-e;var g={width:c.width(),height:(p?c.innerHeight():c[0].offsetHeight)-f-e};return Q()?g["-moz-transform"]=g.transform="translate("+d.left+"px,"+d.top+"px)":(g.left=d.left,g.top=d.top),g}}});var R="iframe",S="//about:blank",T=function(a){if(n.currTemplate[R]){var b=n.currTemplate[R].find("iframe");b.length&&(a||(b[0].src=S),n.isIE8&&b.css("display",a?"block":"none"))}};a.magnificPopup.registerModule(R,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){n.types.push(R),x("BeforeChange",function(a,b,c){b!==c&&(b===R?T():c===R&&T(!0))}),x(b+"."+R,function(){T()})},getIframe:function(b,c){var d=b.src,e=n.st.iframe;a.each(e.patterns,function(){return d.indexOf(this.index)>-1?(this.id&&(d="string"==typeof this.id?d.substr(d.lastIndexOf(this.id)+this.id.length,d.length):this.id.call(this,d)),d=this.src.replace("%id%",d),!1):void 0});var f={};return e.srcAction&&(f[e.srcAction]=d),n._parseMarkup(c,f,b),n.updateStatus("ready"),c}}});var U=function(a){var b=n.items.length;return a>b-1?a-b:0>a?b+a:a},V=function(a,b,c){return a.replace("%curr%",b+1).replace("%total%",c)};a.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var c=n.st.gallery,d=".mfp-gallery",e=Boolean(a.fn.mfpFastClick);return n.direction=!0,c&&c.enabled?(v+=" mfp-gallery",x(g+d,function(){c.navigateByImgClick&&n.wrap.on("click"+d,".mfp-img",function(){return n.items.length>1?(n.next(),!1):void 0}),t.on("keydown"+d,function(a){37===a.keyCode?n.prev():39===a.keyCode&&n.next()})}),x("UpdateStatus"+d,function(a,b){b.text&&(b.text=V(b.text,n.currItem.index,n.items.length))}),x(f+d,function(a,b,d,e){var f=n.items.length;d.counter=f>1?V(c.tCounter,e.index,f):""}),x("BuildControls"+d,function(){if(n.items.length>1&&c.arrows&&!n.arrowLeft){var b=c.arrowMarkup,d=n.arrowLeft=a(b.replace("%title%",c.tPrev).replace("%dir%","left")).addClass(m),f=n.arrowRight=a(b.replace("%title%",c.tNext).replace("%dir%","right")).addClass(m),g=e?"mfpFastClick":"click";d[g](function(){n.prev()}),f[g](function(){n.next()}),n.isIE7&&(y("b",d[0],!1,!0),y("a",d[0],!1,!0),y("b",f[0],!1,!0),y("a",f[0],!1,!0)),n.container.append(d.add(f))}}),x(h+d,function(){n._preloadTimeout&&clearTimeout(n._preloadTimeout),n._preloadTimeout=setTimeout(function(){n.preloadNearbyImages(),n._preloadTimeout=null},16)}),void x(b+d,function(){t.off(d),n.wrap.off("click"+d),n.arrowLeft&&e&&n.arrowLeft.add(n.arrowRight).destroyMfpFastClick(),n.arrowRight=n.arrowLeft=null})):!1},next:function(){n.direction=!0,n.index=U(n.index+1),n.updateItemHTML()},prev:function(){n.direction=!1,n.index=U(n.index-1),n.updateItemHTML()},goTo:function(a){n.direction=a>=n.index,n.index=a,n.updateItemHTML()},preloadNearbyImages:function(){var d,a=n.st.gallery.preload,b=Math.min(a[0],n.items.length),c=Math.min(a[1],n.items.length);for(d=1;d<=(n.direction?c:b);d++)n._preloadItem(n.index+d);for(d=1;d<=(n.direction?b:c);d++)n._preloadItem(n.index-d)},_preloadItem:function(b){if(b=U(b),!n.items[b].preloaded){var c=n.items[b];c.parsed||(c=n.parseEl(b)),z("LazyLoad",c),"image"===c.type&&(c.img=a('<img class="mfp-img" />').on("load.mfploader",function(){c.hasSize=!0}).on("error.mfploader",function(){c.hasSize=!0,c.loadError=!0}).attr("src",c.src)),c.preloaded=!0}}}});var W="retina";a.magnificPopup.registerModule(W,{options:{replaceSrc:function(a){return a.src.replace(/\.\w+$/,function(a){return"@2x"+a})},ratio:1},proto:{initRetina:function(){if(window.devicePixelRatio>1){var a=n.st.retina,b=a.ratio;b=isNaN(b)?b():b,b>1&&(x("ImageHasSize."+W,function(a,c){c.img.css({"max-width":c.img[0].naturalWidth/b,width:"100%"})}),x("ElementParse."+W,function(c,d){d.src=a.replaceSrc(d,b)}))}}}}),function(){var b=1e3,c="ontouchstart"in window,d=function(){r.off("touchmove"+f+" touchend"+f)},e="mfpFastClick",f="."+e;a.fn.mfpFastClick=function(e){return a(this).each(function(){var h,g=a(this);if(c){var i,j,k,l,m,n;g.on("touchstart"+f,function(a){l=!1,n=1,m=a.originalEvent?a.originalEvent.touches[0]:a.touches[0],j=m.clientX,k=m.clientY,r.on("touchmove"+f,function(a){m=a.originalEvent?a.originalEvent.touches:a.touches,n=m.length,m=m[0],(Math.abs(m.clientX-j)>10||Math.abs(m.clientY-k)>10)&&(l=!0,d())}).on("touchend"+f,function(a){d(),l||n>1||(h=!0,a.preventDefault(),clearTimeout(i),i=setTimeout(function(){h=!1},b),e())})})}g.on("click"+f,function(){h||e()})})},a.fn.destroyMfpFastClick=function(){a(this).off("touchstart"+f+" click"+f),c&&r.off("touchmove"+f+" touchend"+f)}}()}(window.jQuery||window.Zepto);;!function(t,e){function a(){return new Date(Date.UTC.apply(Date,arguments))}function i(){var t=new Date;return a(t.getFullYear(),t.getMonth(),t.getDate())}function s(t,e){return t.getUTCFullYear()===e.getUTCFullYear()&&t.getUTCMonth()===e.getUTCMonth()&&t.getUTCDate()===e.getUTCDate()}function n(t){return function(){return this[t].apply(this,arguments)}}function r(e,a){function i(t,e){return e.toLowerCase()}var s,n=t(e).data(),r={},h=new RegExp("^"+a.toLowerCase()+"([A-Z])");a=new RegExp("^"+a.toLowerCase());for(var o in n)a.test(o)&&(s=o.replace(h,i),r[s]=n[o]);return r}function h(e){var a={};if(g[e]||(e=e.split("-")[0],g[e])){var i=g[e];return t.each(f,function(t,e){e in i&&(a[e]=i[e])}),a}}var o=function(){var e={get:function(t){return this.slice(t)[0]},contains:function(t){for(var e=t&&t.valueOf(),a=0,i=this.length;i>a;a++)if(this[a].valueOf()===e)return a;return-1},remove:function(t){this.splice(t,1)},replace:function(e){e&&(t.isArray(e)||(e=[e]),this.clear(),this.push.apply(this,e))},clear:function(){this.length=0},copy:function(){var t=new o;return t.replace(this),t}};return function(){var a=[];return a.push.apply(a,arguments),t.extend(a,e),a}}(),l=function(e,a){this._process_options(a),this.dates=new o,this.viewDate=this.o.defaultViewDate,this.focusDate=null,this.element=t(e),this.isInline=!1,this.isInput=this.element.is("input"),this.component=this.element.hasClass("date")?this.element.find(".add-on, .input-group-addon, .btn"):!1,this.hasInput=this.component&&this.element.find("input").length,this.component&&0===this.component.length&&(this.component=!1),this.picker=t(D.template),this._buildEvents(),this._attachEvents(),this.isInline?this.picker.addClass("datepicker-inline").appendTo(this.element):this.picker.addClass("datepicker-dropdown dropdown-menu"),this.o.rtl&&this.picker.addClass("datepicker-rtl"),this.viewMode=this.o.startView,this.o.calendarWeeks&&this.picker.find("tfoot .today, tfoot .clear").attr("colspan",function(t,e){return parseInt(e)+1}),this._allow_update=!1,this.setStartDate(this._o.startDate),this.setEndDate(this._o.endDate),this.setDaysOfWeekDisabled(this.o.daysOfWeekDisabled),this.setDatesDisabled(this.o.datesDisabled),this.setRefresh(this.o.refresh),this.fillDow(),this.fillMonths(),this._allow_update=!0,this.update(),this.showMode(),this.isInline&&this.show()};l.prototype={constructor:l,_process_options:function(s){this._o=t.extend({},this._o,s);var n=this.o=t.extend({},this._o),r=n.language;switch(g[r]||(r=r.split("-")[0],g[r]||(r=p.language)),n.language=r,n.startView){case 2:case"decade":n.startView=2;break;case 1:case"year":n.startView=1;break;default:n.startView=0}switch(n.minViewMode){case 1:case"months":n.minViewMode=1;break;case 2:case"years":n.minViewMode=2;break;default:n.minViewMode=0}n.startView=Math.max(n.startView,n.minViewMode),n.multidate!==!0&&(n.multidate=Number(n.multidate)||!1,n.multidate!==!1&&(n.multidate=Math.max(0,n.multidate))),n.multidateSeparator=String(n.multidateSeparator),n.weekStart%=7,n.weekEnd=(n.weekStart+6)%7;var h=D.parseFormat(n.format);if(n.startDate!==-(1/0)&&(n.startDate?n.startDate instanceof Date?n.startDate=this._local_to_utc(this._zero_time(n.startDate)):n.startDate=D.parseDate(n.startDate,h,n.language):n.startDate=-(1/0)),n.endDate!==1/0&&(n.endDate?n.endDate instanceof Date?n.endDate=this._local_to_utc(this._zero_time(n.endDate)):n.endDate=D.parseDate(n.endDate,h,n.language):n.endDate=1/0),n.daysOfWeekDisabled=n.daysOfWeekDisabled||[],t.isArray(n.daysOfWeekDisabled)||(n.daysOfWeekDisabled=n.daysOfWeekDisabled.split(/[,\s]*/)),n.daysOfWeekDisabled=t.map(n.daysOfWeekDisabled,function(t){return parseInt(t,10)}),n.datesDisabled=n.datesDisabled||[],!t.isArray(n.datesDisabled)){var o=[];o.push(D.parseDate(n.datesDisabled,h,n.language)),n.datesDisabled=o}n.datesDisabled=t.map(n.datesDisabled,function(t){return D.parseDate(t,h,n.language)});var l=String(n.orientation).toLowerCase().split(/\s+/g),d=n.orientation.toLowerCase();if(l=t.grep(l,function(t){return/^auto|left|right|top|bottom$/.test(t)}),n.orientation={x:"auto",y:"auto"},d&&"auto"!==d)if(1===l.length)switch(l[0]){case"top":case"bottom":n.orientation.y=l[0];break;case"left":case"right":n.orientation.x=l[0]}else d=t.grep(l,function(t){return/^left|right$/.test(t)}),n.orientation.x=d[0]||"auto",d=t.grep(l,function(t){return/^top|bottom$/.test(t)}),n.orientation.y=d[0]||"auto";else;if(n.defaultViewDate){var c=n.defaultViewDate.year||(new Date).getFullYear(),u=n.defaultViewDate.month||0,f=n.defaultViewDate.day||1;n.defaultViewDate=a(c,u,f)}else n.defaultViewDate=i();n.showOnFocus=n.showOnFocus!==e?n.showOnFocus:!0},_events:[],_secondaryEvents:[],_applyEvents:function(t){for(var a,i,s,n=0;n<t.length;n++)a=t[n][0],2===t[n].length?(i=e,s=t[n][1]):3===t[n].length&&(i=t[n][1],s=t[n][2]),a.on(s,i)},_unapplyEvents:function(t){for(var a,i,s,n=0;n<t.length;n++)a=t[n][0],2===t[n].length?(s=e,i=t[n][1]):3===t[n].length&&(s=t[n][1],i=t[n][2]),a.off(i,s)},_buildEvents:function(){var e={keyup:t.proxy(function(e){-1===t.inArray(e.keyCode,[27,37,39,38,40,32,13,9])&&this.update()},this),keydown:t.proxy(this.keydown,this)};this.o.showOnFocus===!0&&(e.focus=t.proxy(this.show,this)),this.isInput?this._events=[[this.element,e]]:this.component&&this.hasInput?this._events=[[this.element.find("input"),e],[this.component,{click:t.proxy(this.show,this)}]]:this.element.is("div")?this.isInline=!0:this._events=[[this.element,{click:t.proxy(this.show,this)}]],this._events.push([this.element,"*",{blur:t.proxy(function(t){this._focused_from=t.target},this)}],[this.element,{blur:t.proxy(function(t){this._focused_from=t.target},this)}]),this._secondaryEvents=[[this.picker,{click:t.proxy(this.click,this)}],[t(window),{resize:t.proxy(this.place,this)}],[t(document),{"mousedown touchstart":t.proxy(function(t){this.element.is(t.target)||this.element.find(t.target).length||this.picker.is(t.target)||this.picker.find(t.target).length||this.hide()},this)}]]},_attachEvents:function(){this._detachEvents(),this._applyEvents(this._events)},_detachEvents:function(){this._unapplyEvents(this._events)},_attachSecondaryEvents:function(){this._detachSecondaryEvents(),this._applyEvents(this._secondaryEvents)},_detachSecondaryEvents:function(){this._unapplyEvents(this._secondaryEvents)},_trigger:function(e,a){var i=a||this.dates.get(-1),s=this._utc_to_local(i);this.element.trigger({type:e,date:s,dates:t.map(this.dates,this._utc_to_local),format:t.proxy(function(t,e){0===arguments.length?(t=this.dates.length-1,e=this.o.format):"string"==typeof t&&(e=t,t=this.dates.length-1),e=e||this.o.format;var a=this.dates.get(t);return D.formatDate(a,e,this.o.language)},this)})},show:function(){return this.element.attr("readonly")&&this.o.enableOnReadonly===!1?void 0:(this.isInline||this.picker.appendTo(this.o.container),this.place(),this.picker.show(),this._attachSecondaryEvents(),this._trigger("show"),(window.navigator.msMaxTouchPoints||"ontouchstart"in document)&&this.o.disableTouchKeyboard&&t(this.element).blur(),this)},hide:function(){return this.isInline?this:this.picker.is(":visible")?(this.focusDate=null,this.picker.hide().detach(),this._detachSecondaryEvents(),this.viewMode=this.o.startView,this.showMode(),this.o.forceParse&&(this.isInput&&this.element.val()||this.hasInput&&this.element.find("input").val())&&this.setValue(),this._trigger("hide"),this):this},remove:function(){return this.hide(),this._detachEvents(),this._detachSecondaryEvents(),this.picker.remove(),delete this.element.data().datepicker,this.isInput||delete this.element.data().date,this},_utc_to_local:function(t){return t&&new Date(t.getTime()+6e4*t.getTimezoneOffset())},_local_to_utc:function(t){return t&&new Date(t.getTime()-6e4*t.getTimezoneOffset())},_zero_time:function(t){return t&&new Date(t.getFullYear(),t.getMonth(),t.getDate())},_zero_utc_time:function(t){return t&&new Date(Date.UTC(t.getUTCFullYear(),t.getUTCMonth(),t.getUTCDate()))},getDates:function(){return t.map(this.dates,this._utc_to_local)},getUTCDates:function(){return t.map(this.dates,function(t){return new Date(t)})},getDate:function(){return this._utc_to_local(this.getUTCDate())},getUTCDate:function(){var t=this.dates.get(-1);return"undefined"!=typeof t?new Date(t):null},clearDates:function(){var t;this.isInput?t=this.element:this.component&&(t=this.element.find("input")),t&&t.val("").change(),this.update(),this._trigger("changeDate"),this.o.autoclose&&this.hide()},setDates:function(){var e=t.isArray(arguments[0])?arguments[0]:arguments;return this.update.apply(this,e),this._trigger("changeDate"),this.setValue(),this},setUTCDates:function(){var e=t.isArray(arguments[0])?arguments[0]:arguments;return this.update.apply(this,t.map(e,this._utc_to_local)),this._trigger("changeDate"),this.setValue(),this},setDate:n("setDates"),setUTCDate:n("setUTCDates"),setValue:function(){var t=this.getFormattedDate();return this.isInput?this.element.val(t).change():this.component&&this.element.find("input").val(t).change(),this},getFormattedDate:function(a){a===e&&(a=this.o.format);var i=this.o.language;return t.map(this.dates,function(t){return D.formatDate(t,a,i)}).join(this.o.multidateSeparator)},setStartDate:function(t){return this._process_options({startDate:t}),this.update(),this.updateNavArrows(),this},setEndDate:function(t){return this._process_options({endDate:t}),this.update(),this.updateNavArrows(),this},setDaysOfWeekDisabled:function(t){return this._process_options({daysOfWeekDisabled:t}),this.update(),this.updateNavArrows(),this},setDatesDisabled:function(t){this._process_options({datesDisabled:t}),this.update(),this.updateNavArrows()},setRefresh:function(t){this._process_options({refresh:t})},place:function(){if(this.isInline)return this;var e=this.picker.outerWidth(),a=this.picker.outerHeight(),i=10,s=t(this.o.container).width(),n=t(this.o.container).height(),r=t(this.o.container).scrollTop(),h=t(this.o.container).offset(),o=[];this.element.parents().each(function(){var e=t(this).css("z-index");"auto"!==e&&0!==e&&o.push(parseInt(e))});var l=Math.max.apply(Math,o)+10,d=this.component?this.component.parent().offset():this.element.offset(),c=this.component?this.component.outerHeight(!0):this.element.outerHeight(!1),u=this.component?this.component.outerWidth(!0):this.element.outerWidth(!1),p=d.left-h.left,f=d.top-h.top+30;this.picker.removeClass("datepicker-orient-top datepicker-orient-bottom datepicker-orient-right datepicker-orient-left"),"auto"!==this.o.orientation.x?(this.picker.addClass("datepicker-orient-"+this.o.orientation.x),"right"===this.o.orientation.x&&(p-=e-u)):d.left<0?(this.picker.addClass("datepicker-orient-left"),p-=d.left-i):p+e>s?(this.picker.addClass("datepicker-orient-right"),p=d.left+u-e):this.picker.addClass("datepicker-orient-left");var g,D,v=this.o.orientation.y;if("auto"===v&&(g=-r+f-a,D=r+n-(f+c+a),v=Math.max(g,D)===D?"top":"bottom"),this.picker.addClass("datepicker-orient-"+v),"top"===v?f+=c:f-=a+parseInt(this.picker.css("padding-top")),this.o.rtl){var m=s-(p+u);this.picker.css({top:f,right:m,zIndex:l})}else this.picker.css({top:f,left:p,zIndex:l});return this},_allow_update:!0,update:function(){if(!this._allow_update)return this;var e=this.dates.copy(),a=[],i=!1;return arguments.length?(t.each(arguments,t.proxy(function(t,e){e instanceof Date&&(e=this._local_to_utc(e)),a.push(e)},this)),i=!0):(a=this.o.refresh?"":this.isInput?this.element.val():this.element.data("date")||this.element.find("input").val(),a=a&&this.o.multidate?a.split(this.o.multidateSeparator):[a],delete this.element.data().date),a=t.map(a,t.proxy(function(t){return D.parseDate(t,this.o.format,this.o.language)},this)),a=t.grep(a,t.proxy(function(t){return t<this.o.startDate||t>this.o.endDate||!t},this),!0),this.dates.replace(a),this.dates.length?this.viewDate=new Date(this.dates.get(-1)):this.viewDate<this.o.startDate?this.viewDate=new Date(this.o.startDate):this.viewDate>this.o.endDate&&(this.viewDate=new Date(this.o.endDate)),i?this.setValue():a.length&&String(e)!==String(this.dates)&&this._trigger("changeDate"),!this.dates.length&&e.length&&this._trigger("clearDate"),this.fill(),this},fillDow:function(){var t=this.o.weekStart,e="<tr>";if(this.o.calendarWeeks){this.picker.find(".datepicker-days thead tr:first-child .datepicker-switch").attr("colspan",function(t,e){return parseInt(e)+1});var a='<th class="cw">&#160;</th>';e+=a}for(;t<this.o.weekStart+7;)e+='<th class="dow">'+g[this.o.language].daysMin[t++%7]+"</th>";e+="</tr>",this.picker.find(".datepicker-days thead").append(e)},fillMonths:function(){for(var t="",e=0;12>e;)t+='<span class="month">'+g[this.o.language].monthsShort[e++]+"</span>";this.picker.find(".datepicker-months td").html(t)},setRange:function(e){e&&e.length?this.range=t.map(e,function(t){return t.valueOf()}):delete this.range,this.fill()},getClassNames:function(e){var a=[],i=this.viewDate.getUTCFullYear(),n=this.viewDate.getUTCMonth(),r=new Date;return e.getUTCFullYear()<i||e.getUTCFullYear()===i&&e.getUTCMonth()<n?a.push("old"):(e.getUTCFullYear()>i||e.getUTCFullYear()===i&&e.getUTCMonth()>n)&&a.push("new"),this.focusDate&&e.valueOf()===this.focusDate.valueOf()&&a.push("focused"),this.o.todayHighlight&&e.getUTCFullYear()===r.getFullYear()&&e.getUTCMonth()===r.getMonth()&&e.getUTCDate()===r.getDate()&&a.push("today"),-1!==this.dates.contains(e)&&a.push("active"),(e.valueOf()<this.o.startDate||e.valueOf()>this.o.endDate||-1!==t.inArray(e.getUTCDay(),this.o.daysOfWeekDisabled))&&a.push("disabled"),this.o.datesDisabled.length>0&&t.grep(this.o.datesDisabled,function(t){return s(e,t)}).length>0&&(a.push("disabled","disabled-date"),this.o.datesDisabled.length>0&&a.push(this.o.classBooked)),this.range&&(e>this.range[0]&&e<this.range[this.range.length-1]&&a.push("range"),-1!==t.inArray(e.valueOf(),this.range)&&a.push("selected")),a},fill:function(){var i,s=new Date(this.viewDate),n=s.getUTCFullYear(),r=s.getUTCMonth(),h=this.o.startDate!==-(1/0)?this.o.startDate.getUTCFullYear():-(1/0),o=this.o.startDate!==-(1/0)?this.o.startDate.getUTCMonth():-(1/0),l=this.o.endDate!==1/0?this.o.endDate.getUTCFullYear():1/0,d=this.o.endDate!==1/0?this.o.endDate.getUTCMonth():1/0,c=g[this.o.language].today||g.en.today||"",u=g[this.o.language].clear||g.en.clear||"";if(!isNaN(n)&&!isNaN(r)){this.picker.find(".datepicker-days thead .datepicker-switch").text(g[this.o.language].months[r]+" "+n),this.picker.find("tfoot .today").text(c).toggle(this.o.todayBtn!==!1),this.picker.find("tfoot .clear").text(u).toggle(this.o.clearBtn!==!1),this.updateNavArrows(),this.fillMonths();var p=a(n,r-1,28),f=D.getDaysInMonth(p.getUTCFullYear(),p.getUTCMonth());p.setUTCDate(f),p.setUTCDate(f-(p.getUTCDay()-this.o.weekStart+7)%7);var v=new Date(p);v.setUTCDate(v.getUTCDate()+42),v=v.valueOf();for(var m,y=[];p.valueOf()<v;){if(p.getUTCDay()===this.o.weekStart&&(y.push("<tr>"),this.o.calendarWeeks)){var w=new Date(+p+(this.o.weekStart-p.getUTCDay()-7)%7*864e5),k=new Date(Number(w)+(11-w.getUTCDay())%7*864e5),C=new Date(Number(C=a(k.getUTCFullYear(),0,1))+(11-C.getUTCDay())%7*864e5),b=(k-C)/864e5/7+1;y.push('<td class="cw">'+b+"</td>")}if(m=this.getClassNames(p),m.push("day"),this.o.beforeShowDay!==t.noop){var T=this.o.beforeShowDay(this._utc_to_local(p));T===e?T={}:"boolean"==typeof T?T={enabled:T}:"string"==typeof T&&(T={classes:T}),T.enabled===!1&&m.push("disabled"),T.classes&&(m=m.concat(T.classes.split(/\s+/))),T.tooltip&&(i=T.tooltip)}m=t.unique(m),y.push('<td class="'+m.join(" ")+'"'+(i?' title="'+i+'"':"")+">"+p.getUTCDate()+"</td>"),i=null,p.getUTCDay()===this.o.weekEnd&&y.push("</tr>"),p.setUTCDate(p.getUTCDate()+1)}this.picker.find(".datepicker-days tbody").empty().append(y.join(""));var _=this.picker.find(".datepicker-months").find("th:eq(1)").text(n).end().find("span").removeClass("active");if(t.each(this.dates,function(t,e){e.getUTCFullYear()===n&&_.eq(e.getUTCMonth()).addClass("active")}),(h>n||n>l)&&_.addClass("disabled"),n===h&&_.slice(0,o).addClass("disabled"),n===l&&_.slice(d+1).addClass("disabled"),this.o.beforeShowMonth!==t.noop){var U=this;t.each(_,function(e,a){if(!t(a).hasClass("disabled")){var i=new Date(n,e,1),s=U.o.beforeShowMonth(i);s===!1&&t(a).addClass("disabled")}})}y="",n=10*parseInt(n/10,10);var M=this.picker.find(".datepicker-years").find("th:eq(1)").text(n+"-"+(n+9)).end().find("td");n-=1;for(var x,F=t.map(this.dates,function(t){return t.getUTCFullYear()}),S=-1;11>S;S++)x=["year"],-1===S?x.push("old"):10===S&&x.push("new"),-1!==t.inArray(n,F)&&x.push("active"),(h>n||n>l)&&x.push("disabled"),y+='<span class="'+x.join(" ")+'">'+n+"</span>",n+=1;M.html(y)}},updateNavArrows:function(){if(this._allow_update){var t=new Date(this.viewDate),e=t.getUTCFullYear(),a=t.getUTCMonth();switch(this.viewMode){case 0:this.o.startDate!==-(1/0)&&e<=this.o.startDate.getUTCFullYear()&&a<=this.o.startDate.getUTCMonth()?this.picker.find(".prev").css({visibility:"hidden"}):this.picker.find(".prev").css({visibility:"visible"}),this.o.endDate!==1/0&&e>=this.o.endDate.getUTCFullYear()&&a>=this.o.endDate.getUTCMonth()?this.picker.find(".next").css({visibility:"hidden"}):this.picker.find(".next").css({visibility:"visible"});break;case 1:case 2:this.o.startDate!==-(1/0)&&e<=this.o.startDate.getUTCFullYear()?this.picker.find(".prev").css({visibility:"hidden"}):this.picker.find(".prev").css({visibility:"visible"}),this.o.endDate!==1/0&&e>=this.o.endDate.getUTCFullYear()?this.picker.find(".next").css({visibility:"hidden"}):this.picker.find(".next").css({visibility:"visible"})}}},click:function(e){e.preventDefault();var i,s,n,r=t(e.target).closest("span, td, th");if(1===r.length)switch(r[0].nodeName.toLowerCase()){case"th":switch(r[0].className){case"datepicker-switch":this.showMode(1);break;case"prev":case"next":var h=D.modes[this.viewMode].navStep*("prev"===r[0].className?-1:1);switch(this.viewMode){case 0:this.viewDate=this.moveMonth(this.viewDate,h),this._trigger("changeMonth",this.viewDate);break;case 1:case 2:this.viewDate=this.moveYear(this.viewDate,h),1===this.viewMode&&this._trigger("changeYear",this.viewDate)}this.fill();break;case"today":var o=new Date;o=a(o.getFullYear(),o.getMonth(),o.getDate(),0,0,0),this.showMode(-2);var l="linked"===this.o.todayBtn?null:"view";this._setDate(o,l);break;case"clear":this.clearDates()}break;case"span":r.hasClass("disabled")||(this.viewDate.setUTCDate(1),r.hasClass("month")?(n=1,s=r.parent().find("span").index(r),i=this.viewDate.getUTCFullYear(),this.viewDate.setUTCMonth(s),this._trigger("changeMonth",this.viewDate),1===this.o.minViewMode&&this._setDate(a(i,s,n))):(n=1,s=0,i=parseInt(r.text(),10)||0,this.viewDate.setUTCFullYear(i),this._trigger("changeYear",this.viewDate),2===this.o.minViewMode&&this._setDate(a(i,s,n))),this.showMode(-1),this.fill());break;case"td":r.hasClass("day")&&!r.hasClass("disabled")&&(n=parseInt(r.text(),10)||1,i=this.viewDate.getUTCFullYear(),s=this.viewDate.getUTCMonth(),r.hasClass("old")?0===s?(s=11,i-=1):s-=1:r.hasClass("new")&&(11===s?(s=0,i+=1):s+=1),this._setDate(a(i,s,n)))}this.picker.is(":visible")&&this._focused_from&&t(this._focused_from).focus(),delete this._focused_from},_toggle_multidate:function(t){var e=this.dates.contains(t);if(t||this.dates.clear(),-1!==e?(this.o.multidate===!0||this.o.multidate>1||this.o.toggleActive)&&this.dates.remove(e):this.o.multidate===!1?(this.dates.clear(),this.dates.push(t)):this.dates.push(t),"number"==typeof this.o.multidate)for(;this.dates.length>this.o.multidate;)this.dates.remove(0)},_setDate:function(t,e){e&&"date"!==e||this._toggle_multidate(t&&new Date(t)),e&&"view"!==e||(this.viewDate=t&&new Date(t)),this.fill(),this.setValue(),e&&"view"===e||this._trigger("changeDate");var a;this.isInput?a=this.element:this.component&&(a=this.element.find("input")),a&&a.change(),!this.o.autoclose||e&&"date"!==e||this.hide()},moveMonth:function(t,a){if(!t)return e;if(!a)return t;var i,s,n=new Date(t.valueOf()),r=n.getUTCDate(),h=n.getUTCMonth(),o=Math.abs(a);if(a=a>0?1:-1,1===o)s=-1===a?function(){return n.getUTCMonth()===h}:function(){return n.getUTCMonth()!==i},i=h+a,n.setUTCMonth(i),(0>i||i>11)&&(i=(i+12)%12);else{for(var l=0;o>l;l++)n=this.moveMonth(n,a);i=n.getUTCMonth(),n.setUTCDate(r),s=function(){return i!==n.getUTCMonth()}}for(;s();)n.setUTCDate(--r),n.setUTCMonth(i);return n},moveYear:function(t,e){return this.moveMonth(t,12*e)},dateWithinRange:function(t){return t>=this.o.startDate&&t<=this.o.endDate},keydown:function(t){if(!this.picker.is(":visible"))return void(27===t.keyCode&&this.show());var e,a,s,n=!1,r=this.focusDate||this.viewDate;switch(t.keyCode){case 27:this.focusDate?(this.focusDate=null,this.viewDate=this.dates.get(-1)||this.viewDate,this.fill()):this.hide(),t.preventDefault();break;case 37:case 39:if(!this.o.keyboardNavigation)break;e=37===t.keyCode?-1:1,t.ctrlKey?(a=this.moveYear(this.dates.get(-1)||i(),e),s=this.moveYear(r,e),this._trigger("changeYear",this.viewDate)):t.shiftKey?(a=this.moveMonth(this.dates.get(-1)||i(),e),s=this.moveMonth(r,e),this._trigger("changeMonth",this.viewDate)):(a=new Date(this.dates.get(-1)||i()),a.setUTCDate(a.getUTCDate()+e),s=new Date(r),s.setUTCDate(r.getUTCDate()+e)),this.dateWithinRange(s)&&(this.focusDate=this.viewDate=s,this.setValue(),this.fill(),t.preventDefault());break;case 38:case 40:if(!this.o.keyboardNavigation)break;e=38===t.keyCode?-1:1,t.ctrlKey?(a=this.moveYear(this.dates.get(-1)||i(),e),s=this.moveYear(r,e),this._trigger("changeYear",this.viewDate)):t.shiftKey?(a=this.moveMonth(this.dates.get(-1)||i(),e),s=this.moveMonth(r,e),this._trigger("changeMonth",this.viewDate)):(a=new Date(this.dates.get(-1)||i()),a.setUTCDate(a.getUTCDate()+7*e),s=new Date(r),s.setUTCDate(r.getUTCDate()+7*e)),this.dateWithinRange(s)&&(this.focusDate=this.viewDate=s,this.setValue(),this.fill(),t.preventDefault());break;case 32:break;case 13:r=this.focusDate||this.dates.get(-1)||this.viewDate,this.o.keyboardNavigation&&(this._toggle_multidate(r),n=!0),this.focusDate=null,this.viewDate=this.dates.get(-1)||this.viewDate,this.setValue(),this.fill(),this.picker.is(":visible")&&(t.preventDefault(),"function"==typeof t.stopPropagation?t.stopPropagation():t.cancelBubble=!0,this.o.autoclose&&this.hide());break;case 9:this.focusDate=null,this.viewDate=this.dates.get(-1)||this.viewDate,this.fill(),this.hide()}if(n){this.dates.length?this._trigger("changeDate"):this._trigger("clearDate");var h;this.isInput?h=this.element:this.component&&(h=this.element.find("input")),h&&h.change()}},showMode:function(t){t&&(this.viewMode=Math.max(this.o.minViewMode,Math.min(2,this.viewMode+t))),this.picker.children("div").hide().filter(".datepicker-"+D.modes[this.viewMode].clsName).css("display","block"),this.updateNavArrows()}};var d=function(e,a){this.element=t(e),this.inputs=t.map(a.inputs,function(t){return t.jquery?t[0]:t}),delete a.inputs,u.call(t(this.inputs),a).bind("changeDate",t.proxy(this.dateUpdated,this)),this.pickers=t.map(this.inputs,function(e){return t(e).data("datepicker")}),this.updateDates()};d.prototype={updateDates:function(){this.dates=t.map(this.pickers,function(t){return t.getUTCDate()}),this.updateRanges()},updateRanges:function(){var e=t.map(this.dates,function(t){return t.valueOf()});t.each(this.pickers,function(t,a){a.setRange(e)})},dateUpdated:function(e){if(!this.updating){this.updating=!0;var a=t(e.target).data("datepicker"),i=a.getUTCDate(),s=t.inArray(e.target,this.inputs),n=s-1,r=s+1,h=this.inputs.length;if(-1!==s){if(t.each(this.pickers,function(t,e){e.getUTCDate()||e.setUTCDate(i)}),i<this.dates[n])for(;n>=0&&i<this.dates[n];)this.pickers[n--].setUTCDate(i);else if(i>this.dates[r])for(;h>r&&i>this.dates[r];)this.pickers[r++].setUTCDate(i);this.updateDates(),delete this.updating}}},remove:function(){t.map(this.pickers,function(t){t.remove()}),delete this.element.data().datepicker}};var c=t.fn.datepicker,u=function(a){var i=Array.apply(null,arguments);i.shift();var s;return this.each(function(){var n=t(this),o=n.data("datepicker"),c="object"==typeof a&&a;if(!o){var u=r(this,"date"),f=t.extend({},p,u,c),g=h(f.language),D=t.extend({},p,g,u,c);if(n.hasClass("input-daterange")||D.inputs){var v={inputs:D.inputs||n.find("input").toArray()};n.data("datepicker",o=new d(this,t.extend(D,v)))}else n.data("datepicker",o=new l(this,D))}return"string"==typeof a&&"function"==typeof o[a]&&(s=o[a].apply(o,i),s!==e)?!1:void 0}),s!==e?s:this};t.fn.datepicker=u;var p=t.fn.datepicker.defaults={autoclose:!1,beforeShowDay:t.noop,beforeShowMonth:t.noop,calendarWeeks:!1,clearBtn:!1,toggleActive:!1,daysOfWeekDisabled:[],datesDisabled:[],endDate:1/0,forceParse:!0,format:"mm/dd/yyyy",keyboardNavigation:!0,language:"en",minViewMode:0,multidate:!1,multidateSeparator:",",orientation:"auto",rtl:!1,startDate:-(1/0),startView:0,todayBtn:!1,todayHighlight:!1,weekStart:0,disableTouchKeyboard:!1,enableOnReadonly:!0,container:"body",refresh:!1,classBooked:"booked"},f=t.fn.datepicker.locale_opts=["format","rtl","weekStart"];t.fn.datepicker.Constructor=l;var g=t.fn.datepicker.dates={en:{days:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],daysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],daysMin:["Su","Mo","Tu","We","Th","Fr","Sa","Su"],months:["January","February","March","April","May","June","July","August","September","October","November","December"],monthsShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],today:"Today",clear:"Clear"}},D={modes:[{clsName:"days",navFnc:"Month",navStep:1},{clsName:"months",navFnc:"FullYear",navStep:1},{clsName:"years",navFnc:"FullYear",navStep:10}],isLeapYear:function(t){return t%4===0&&t%100!==0||t%400===0},getDaysInMonth:function(t,e){return[31,D.isLeapYear(t)?29:28,31,30,31,30,31,31,30,31,30,31][e]},validParts:/dd?|DD?|mm?|MM?|yy(?:yy)?/g,nonpunctuation:/[^ -\/:-@\[\u3400-\u9fff-`{-~\t\n\r]+/g,parseFormat:function(t){var e=t.replace(this.validParts,"\x00").split("\x00"),a=t.match(this.validParts);if(!e||!e.length||!a||0===a.length)throw new Error("Invalid date format.");return{separators:e,parts:a}},parseDate:function(i,s,n){function r(){var t=this.slice(0,u[d].length),e=u[d].slice(0,t.length);return t.toLowerCase()===e.toLowerCase()}if(!i)return e;if(i instanceof Date)return i;"string"==typeof s&&(s=D.parseFormat(s));var h,o,d,c=/([\-+]\d+)([dmwy])/,u=i.match(/([\-+]\d+)([dmwy])/g);if(/^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/.test(i)){for(i=new Date,d=0;d<u.length;d++)switch(h=c.exec(u[d]),o=parseInt(h[1]),h[2]){case"d":i.setUTCDate(i.getUTCDate()+o);break;case"m":i=l.prototype.moveMonth.call(l.prototype,i,o);break;case"w":i.setUTCDate(i.getUTCDate()+7*o);break;case"y":i=l.prototype.moveYear.call(l.prototype,i,o)}return a(i.getUTCFullYear(),i.getUTCMonth(),i.getUTCDate(),0,0,0)}u=i&&i.match(this.nonpunctuation)||[],i=new Date;var p,f,v={},m=["yyyy","yy","M","MM","m","mm","d","dd"],y={yyyy:function(t,e){return t.setUTCFullYear(e)},yy:function(t,e){return t.setUTCFullYear(2e3+e)},m:function(t,e){if(isNaN(t))return t;for(e-=1;0>e;)e+=12;for(e%=12,t.setUTCMonth(e);t.getUTCMonth()!==e;)t.setUTCDate(t.getUTCDate()-1);return t},d:function(t,e){return t.setUTCDate(e)}};y.M=y.MM=y.mm=y.m,y.dd=y.d,i=a(i.getFullYear(),i.getMonth(),i.getDate(),0,0,0);var w=s.parts.slice();if(u.length!==w.length&&(w=t(w).filter(function(e,a){return-1!==t.inArray(a,m)}).toArray()),u.length===w.length){var k;for(d=0,k=w.length;k>d;d++){if(p=parseInt(u[d],10),h=w[d],isNaN(p))switch(h){case"MM":f=t(g[n].months).filter(r),p=t.inArray(f[0],g[n].months)+1;break;case"M":f=t(g[n].monthsShort).filter(r),p=t.inArray(f[0],g[n].monthsShort)+1}v[h]=p}var C,b;for(d=0;d<m.length;d++)b=m[d],b in v&&!isNaN(v[b])&&(C=new Date(i),y[b](C,v[b]),isNaN(C)||(i=C))}return i},formatDate:function(e,a,i){if(!e)return"";"string"==typeof a&&(a=D.parseFormat(a));var s={d:e.getUTCDate(),D:g[i].daysShort[e.getUTCDay()],DD:g[i].days[e.getUTCDay()],m:e.getUTCMonth()+1,M:g[i].monthsShort[e.getUTCMonth()],MM:g[i].months[e.getUTCMonth()],yy:e.getUTCFullYear().toString().substring(2),yyyy:e.getUTCFullYear()};s.dd=(s.d<10?"0":"")+s.d,s.mm=(s.m<10?"0":"")+s.m,e=[];for(var n=t.extend([],a.separators),r=0,h=a.parts.length;h>=r;r++)n.length&&e.push(n.shift()),e.push(s[a.parts[r]]);return e.join("")},headTemplate:'<thead><tr><th class="prev"></th><th colspan="5" class="datepicker-switch"></th><th class="next"></th></tr></thead>',contTemplate:'<tbody><tr><td colspan="7"></td></tr></tbody>',footTemplate:'<tfoot><tr><th colspan="7" class="today"></th></tr><tr><th colspan="7" class="clear"></th></tr></tfoot>'};D.template='<div class="datepicker"><div class="date-overlay"></div><div class="datepicker-days"><table class=" table-condensed">'+D.headTemplate+"<tbody></tbody>"+D.footTemplate+'</table></div><div class="datepicker-months"><table class="table-condensed">'+D.headTemplate+D.contTemplate+D.footTemplate+'</table></div><div class="datepicker-years"><table class="table-condensed">'+D.headTemplate+D.contTemplate+D.footTemplate+"</table></div></div>",t.fn.datepicker.DPGlobal=D,t.fn.datepicker.noConflict=function(){return t.fn.datepicker=c,this},t.fn.datepicker.version="1.4.0",t(document).on("focus.datepicker.data-api click.datepicker.data-api",'[data-provide="datepicker"]',function(e){var a=t(this);a.data("datepicker")||(e.preventDefault(),u.call(a,"show"))}),t(function(){u.call(t('[data-provide="datepicker-inline"]'))})}(window.jQuery);;!function(t,i,e,s){"use strict";var n=function(i,e){this.widget="",this.$element=t(i),this.defaultTime=e.defaultTime,this.disableFocus=e.disableFocus,this.disableMousewheel=e.disableMousewheel,this.isOpen=e.isOpen,this.minuteStep=e.minuteStep,this.modalBackdrop=e.modalBackdrop,this.orientation=e.orientation,this.secondStep=e.secondStep,this.showInputs=e.showInputs,this.showMeridian=e.showMeridian,this.showSeconds=e.showSeconds,this.template=e.template,this.appendWidgetTo=e.appendWidgetTo,this.showWidgetOnAddonClick=e.showWidgetOnAddonClick,this._init()};n.prototype={constructor:n,_init:function(){var i=this;this.showWidgetOnAddonClick&&(this.$element.parent().hasClass("input-append")||this.$element.parent().hasClass("input-prepend"))?(this.$element.parent(".input-append, .input-prepend").find(".add-on").on({"click.timepicker":t.proxy(this.showWidget,this)}),this.$element.on({"focus.timepicker":t.proxy(this.highlightUnit,this),"click.timepicker":t.proxy(this.highlightUnit,this),"keydown.timepicker":t.proxy(this.elementKeydown,this),"blur.timepicker":t.proxy(this.blurElement,this),"mousewheel.timepicker DOMMouseScroll.timepicker":t.proxy(this.mousewheel,this)})):this.template?this.$element.on({"focus.timepicker":t.proxy(this.showWidget,this),"click.timepicker":t.proxy(this.showWidget,this),"blur.timepicker":t.proxy(this.blurElement,this),"mousewheel.timepicker DOMMouseScroll.timepicker":t.proxy(this.mousewheel,this)}):this.$element.on({"focus.timepicker":t.proxy(this.highlightUnit,this),"click.timepicker":t.proxy(this.highlightUnit,this),"keydown.timepicker":t.proxy(this.elementKeydown,this),"blur.timepicker":t.proxy(this.blurElement,this),"mousewheel.timepicker DOMMouseScroll.timepicker":t.proxy(this.mousewheel,this)}),this.template!==!1?this.$widget=t(this.getTemplate()).on("click",t.proxy(this.widgetClick,this)):this.$widget=!1,this.showInputs&&this.$widget!==!1&&this.$widget.find("input").each(function(){t(this).on({"click.timepicker":function(){t(this).select()},"keydown.timepicker":t.proxy(i.widgetKeydown,i),"keyup.timepicker":t.proxy(i.widgetKeyup,i)})}),this.setDefaultTime(this.defaultTime)},blurElement:function(){this.highlightedUnit=null,this.updateFromElementVal()},clear:function(){this.hour="",this.minute="",this.second="",this.meridian="",this.$element.val("")},decrementHour:function(){if(this.showMeridian)if(1===this.hour)this.hour=12;else{if(12===this.hour)return this.hour--,this.toggleMeridian();if(0===this.hour)return this.hour=11,this.toggleMeridian();this.hour--}else this.hour<=0?this.hour=23:this.hour--},decrementMinute:function(t){var i;i=t?this.minute-t:this.minute-this.minuteStep,0>i?(this.decrementHour(),this.minute=i+60):this.minute=i},decrementSecond:function(){var t=this.second-this.secondStep;0>t?(this.decrementMinute(!0),this.second=t+60):this.second=t},elementKeydown:function(t){switch(t.keyCode){case 9:case 27:this.updateFromElementVal();break;case 37:t.preventDefault(),this.highlightPrevUnit();break;case 38:switch(t.preventDefault(),this.highlightedUnit){case"hour":this.incrementHour(),this.highlightHour();break;case"minute":this.incrementMinute(),this.highlightMinute();break;case"second":this.incrementSecond(),this.highlightSecond();break;case"meridian":this.toggleMeridian(),this.highlightMeridian()}this.update();break;case 39:t.preventDefault(),this.highlightNextUnit();break;case 40:switch(t.preventDefault(),this.highlightedUnit){case"hour":this.decrementHour(),this.highlightHour();break;case"minute":this.decrementMinute(),this.highlightMinute();break;case"second":this.decrementSecond(),this.highlightSecond();break;case"meridian":this.toggleMeridian(),this.highlightMeridian()}this.update()}},getCursorPosition:function(){var t=this.$element.get(0);if("selectionStart"in t)return t.selectionStart;if(e.selection){t.focus();var i=e.selection.createRange(),s=e.selection.createRange().text.length;return i.moveStart("character",-t.value.length),i.text.length-s}},getTemplate:function(){var t,i,e,s,n,h;switch(this.showInputs?(i='<input type="text" class="bootstrap-timepicker-hour" maxlength="2"/>',e='<input type="text" class="bootstrap-timepicker-minute" maxlength="2"/>',s='<input type="text" class="bootstrap-timepicker-second" maxlength="2"/>',n='<input type="text" class="bootstrap-timepicker-meridian" maxlength="2"/>'):(i='<span class="bootstrap-timepicker-hour"></span>',e='<span class="bootstrap-timepicker-minute"></span>',s='<span class="bootstrap-timepicker-second"></span>',n='<span class="bootstrap-timepicker-meridian"></span>'),h='<table><tr><td><a href="#" data-action="incrementHour"><i class="fa fa-angle-up"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="incrementMinute"><i class="fa fa-angle-up"></i></a></td>'+(this.showSeconds?'<td class="separator">&nbsp;</td><td><a href="#" data-action="incrementSecond"><i class="fa fa-angle-up"></i></a></td>':"")+(this.showMeridian?'<td class="separator">&nbsp;</td><td class="meridian-column"><a href="#" data-action="toggleMeridian"><i class="fa fa-angle-up"></i></a></td>':"")+"</tr><tr><td>"+i+'</td> <td class="separator">:</td><td>'+e+"</td> "+(this.showSeconds?'<td class="separator">:</td><td>'+s+"</td>":"")+(this.showMeridian?'<td class="separator">&nbsp;</td><td>'+n+"</td>":"")+'</tr><tr><td><a href="#" data-action="decrementHour"><i class="fa fa-angle-down"></i></a></td><td class="separator"></td><td><a href="#" data-action="decrementMinute"><i class="fa fa-angle-down"></i></a></td>'+(this.showSeconds?'<td class="separator">&nbsp;</td><td><a href="#" data-action="decrementSecond"><i class="fa fa-angle-down"></i></a></td>':"")+(this.showMeridian?'<td class="separator">&nbsp;</td><td><a href="#" data-action="toggleMeridian"><i class="fa fa-angle-down"></i></a></td>':"")+"</tr></table>",this.template){case"modal":t='<div class="bootstrap-timepicker-widget modal hide fade in" data-backdrop="'+(this.modalBackdrop?"true":"false")+'"><div class="modal-header"><a href="#" class="close" data-dismiss="modal">×</a><h3>Pick a Time</h3></div><div class="modal-content">'+h+'</div><div class="modal-footer"><a href="#" class="btn btn-primary" data-dismiss="modal">OK</a></div></div>';break;case"dropdown":t='<div class="bootstrap-timepicker-widget dropdown-menu">'+h+"</div>"}return t},getTime:function(){return""===this.hour?"":this.hour+":"+(1===this.minute.toString().length?"0"+this.minute:this.minute)+(this.showSeconds?":"+(1===this.second.toString().length?"0"+this.second:this.second):"")+(this.showMeridian?" "+this.meridian:"")},hideWidget:function(){this.isOpen!==!1&&(this.$element.trigger({type:"hide.timepicker",time:{value:this.getTime(),hours:this.hour,minutes:this.minute,seconds:this.second,meridian:this.meridian}}),"modal"===this.template&&this.$widget.modal?this.$widget.modal("hide"):this.$widget.removeClass("open"),t(e).off("mousedown.timepicker, touchend.timepicker"),this.isOpen=!1,this.$widget.detach())},highlightUnit:function(){this.position=this.getCursorPosition(),this.position>=0&&this.position<=2?this.highlightHour():this.position>=3&&this.position<=5?this.highlightMinute():this.position>=6&&this.position<=8?this.showSeconds?this.highlightSecond():this.highlightMeridian():this.position>=9&&this.position<=11&&this.highlightMeridian()},highlightNextUnit:function(){switch(this.highlightedUnit){case"hour":this.highlightMinute();break;case"minute":this.showSeconds?this.highlightSecond():this.showMeridian?this.highlightMeridian():this.highlightHour();break;case"second":this.showMeridian?this.highlightMeridian():this.highlightHour();break;case"meridian":this.highlightHour()}},highlightPrevUnit:function(){switch(this.highlightedUnit){case"hour":this.showMeridian?this.highlightMeridian():this.showSeconds?this.highlightSecond():this.highlightMinute();break;case"minute":this.highlightHour();break;case"second":this.highlightMinute();break;case"meridian":this.showSeconds?this.highlightSecond():this.highlightMinute()}},highlightHour:function(){var t=this.$element.get(0),i=this;this.highlightedUnit="hour",t.setSelectionRange&&setTimeout(function(){i.hour<10?t.setSelectionRange(0,1):t.setSelectionRange(0,2)},0)},highlightMinute:function(){var t=this.$element.get(0),i=this;this.highlightedUnit="minute",t.setSelectionRange&&setTimeout(function(){i.hour<10?t.setSelectionRange(2,4):t.setSelectionRange(3,5)},0)},highlightSecond:function(){var t=this.$element.get(0),i=this;this.highlightedUnit="second",t.setSelectionRange&&setTimeout(function(){i.hour<10?t.setSelectionRange(5,7):t.setSelectionRange(6,8)},0)},highlightMeridian:function(){var t=this.$element.get(0),i=this;this.highlightedUnit="meridian",t.setSelectionRange&&(this.showSeconds?setTimeout(function(){i.hour<10?t.setSelectionRange(8,10):t.setSelectionRange(9,11)},0):setTimeout(function(){i.hour<10?t.setSelectionRange(5,7):t.setSelectionRange(6,8)},0))},incrementHour:function(){if(this.showMeridian){if(11===this.hour)return this.hour++,this.toggleMeridian();12===this.hour&&(this.hour=0)}return 23===this.hour?void(this.hour=0):void this.hour++},incrementMinute:function(t){var i;i=t?this.minute+t:this.minute+this.minuteStep-this.minute%this.minuteStep,i>59?(this.incrementHour(),this.minute=i-60):this.minute=i},incrementSecond:function(){var t=this.second+this.secondStep-this.second%this.secondStep;t>59?(this.incrementMinute(!0),this.second=t-60):this.second=t},mousewheel:function(i){if(!this.disableMousewheel){i.preventDefault(),i.stopPropagation();var e=i.originalEvent.wheelDelta||-i.originalEvent.detail,s=null;switch("mousewheel"===i.type?s=-1*i.originalEvent.wheelDelta:"DOMMouseScroll"===i.type&&(s=40*i.originalEvent.detail),s&&(i.preventDefault(),t(this).scrollTop(s+t(this).scrollTop())),this.highlightedUnit){case"minute":e>0?this.incrementMinute():this.decrementMinute(),this.highlightMinute();break;case"second":e>0?this.incrementSecond():this.decrementSecond(),this.highlightSecond();break;case"meridian":this.toggleMeridian(),this.highlightMeridian();break;default:e>0?this.incrementHour():this.decrementHour(),this.highlightHour()}return!1}},place:function(){if(!this.isInline){var e=this.$widget.outerWidth(),s=this.$widget.outerHeight(),n=10,h=t(i).width(),o=t(i).height(),a=t(i).scrollTop(),r=parseInt(this.$element.parents().filter(function(){}).first().css("z-index"),10)+10,d=this.component?this.component.parent().offset():this.$element.offset(),c=this.component?this.component.outerHeight(!0):this.$element.outerHeight(!1),l=this.component?this.component.outerWidth(!0):this.$element.outerWidth(!1),u=d.left,p=d.top;this.$widget.removeClass("timepicker-orient-top timepicker-orient-bottom timepicker-orient-right timepicker-orient-left"),"auto"!==this.orientation.x?(this.picker.addClass("datepicker-orient-"+this.orientation.x),"right"===this.orientation.x&&(u-=e-l)):(this.$widget.addClass("timepicker-orient-left"),d.left<0?u-=d.left-n:d.left+e>h&&(u=h-e-n));var m,g,f=this.orientation.y;"auto"===f&&(m=-a+d.top-s,g=a+o-(d.top+c+s),f=Math.max(m,g)===g?"top":"bottom"),this.$widget.addClass("timepicker-orient-"+f),"top"===f?p+=c:p-=s+parseInt(this.$widget.css("padding-top"),10),this.$widget.css({top:p,left:u,zIndex:r})}},remove:function(){t("document").off(".timepicker"),this.$widget&&this.$widget.remove(),delete this.$element.data().timepicker},setDefaultTime:function(t){if(this.$element.val())this.updateFromElementVal();else if("current"===t){var i=new Date,e=i.getHours(),s=i.getMinutes(),n=i.getSeconds(),h="AM";0!==n&&(n=Math.ceil(i.getSeconds()/this.secondStep)*this.secondStep,60===n&&(s+=1,n=0)),0!==s&&(s=Math.ceil(i.getMinutes()/this.minuteStep)*this.minuteStep,60===s&&(e+=1,s=0)),this.showMeridian&&(0===e?e=12:e>=12?(e>12&&(e-=12),h="PM"):h="AM"),this.hour=e,this.minute=s,this.second=n,this.meridian=h,this.update()}else t===!1?(this.hour=0,this.minute=0,this.second=0,this.meridian="AM"):this.setTime(t)},setTime:function(t,i){if(!t)return void this.clear();var e,s,n,h,o;"object"==typeof t&&t.getMonth?(s=t.getHours(),n=t.getMinutes(),h=t.getSeconds(),this.showMeridian&&(o="AM",s>12&&(o="PM",s%=12),12===s&&(o="PM"))):(o=null!==t.match(/p/i)?"PM":"AM",t=t.replace(/[^0-9\:]/g,""),e=t.split(":"),s=e[0]?e[0].toString():e.toString(),n=e[1]?e[1].toString():"",h=e[2]?e[2].toString():"",s.length>4&&(h=s.substr(4,2)),s.length>2&&(n=s.substr(2,2),s=s.substr(0,2)),n.length>2&&(h=n.substr(2,2),n=n.substr(0,2)),h.length>2&&(h=h.substr(2,2)),s=parseInt(s,10),n=parseInt(n,10),h=parseInt(h,10),isNaN(s)&&(s=0),isNaN(n)&&(n=0),isNaN(h)&&(h=0),this.showMeridian?1>s?s=1:s>12&&(s=12):(s>=24?s=23:0>s&&(s=0),13>s&&"PM"===o&&(s+=12)),0>n?n=0:n>=60&&(n=59),this.showSeconds&&(isNaN(h)?h=0:0>h?h=0:h>=60&&(h=59))),this.hour=s,this.minute=n,this.second=h,this.meridian=o,this.update(i)},showWidget:function(){if(!this.isOpen&&!this.$element.is(":disabled")){this.$widget.appendTo(this.appendWidgetTo);var i=this;t(e).on("mousedown.timepicker, touchend.timepicker",function(t){i.$element.parent().find(t.target).length||i.$widget.is(t.target)||i.$widget.find(t.target).length||i.hideWidget()}),this.$element.trigger({type:"show.timepicker",time:{value:this.getTime(),hours:this.hour,minutes:this.minute,seconds:this.second,meridian:this.meridian}}),this.place(),this.disableFocus&&this.$element.blur(),""===this.hour&&(this.defaultTime?this.setDefaultTime(this.defaultTime):this.setTime("0:0:0")),"modal"===this.template&&this.$widget.modal?this.$widget.modal("show").on("hidden",t.proxy(this.hideWidget,this)):this.isOpen===!1&&this.$widget.addClass("open"),this.isOpen=!0}},toggleMeridian:function(){this.meridian="AM"===this.meridian?"PM":"AM"},update:function(t){this.updateElement(),t||this.updateWidget(),this.$element.trigger({type:"changeTime.timepicker",time:{value:this.getTime(),hours:this.hour,minutes:this.minute,seconds:this.second,meridian:this.meridian}})},updateElement:function(){this.$element.val(this.getTime()).change()},updateFromElementVal:function(){this.setTime(this.$element.val())},updateWidget:function(){if(this.$widget!==!1){var t=this.hour,i=1===this.minute.toString().length?"0"+this.minute:this.minute,e=1===this.second.toString().length?"0"+this.second:this.second;this.showInputs?(this.$widget.find("input.bootstrap-timepicker-hour").val(t),this.$widget.find("input.bootstrap-timepicker-minute").val(i),this.showSeconds&&this.$widget.find("input.bootstrap-timepicker-second").val(e),this.showMeridian&&this.$widget.find("input.bootstrap-timepicker-meridian").val(this.meridian)):(this.$widget.find("span.bootstrap-timepicker-hour").text(t),this.$widget.find("span.bootstrap-timepicker-minute").text(i),this.showSeconds&&this.$widget.find("span.bootstrap-timepicker-second").text(e),this.showMeridian&&this.$widget.find("span.bootstrap-timepicker-meridian").text(this.meridian))}},updateFromWidgetInputs:function(){if(this.$widget!==!1){var t=this.$widget.find("input.bootstrap-timepicker-hour").val()+":"+this.$widget.find("input.bootstrap-timepicker-minute").val()+(this.showSeconds?":"+this.$widget.find("input.bootstrap-timepicker-second").val():"")+(this.showMeridian?this.$widget.find("input.bootstrap-timepicker-meridian").val():"");this.setTime(t,!0)}},widgetClick:function(i){i.stopPropagation(),i.preventDefault();var e=t(i.target),s=e.closest("a").data("action");s&&this[s](),this.update(),e.is("input")&&e.get(0).setSelectionRange(0,2)},widgetKeydown:function(i){var e=t(i.target),s=e.attr("class").replace("bootstrap-timepicker-","");switch(i.keyCode){case 9:if(this.showMeridian&&"meridian"===s||this.showSeconds&&"second"===s||!this.showMeridian&&!this.showSeconds&&"minute"===s)return this.hideWidget();break;case 27:this.hideWidget();break;case 38:switch(i.preventDefault(),s){case"hour":this.incrementHour();break;case"minute":this.incrementMinute();break;case"second":this.incrementSecond();break;case"meridian":this.toggleMeridian()}this.setTime(this.getTime()),e.get(0).setSelectionRange(0,2);break;case 40:switch(i.preventDefault(),s){case"hour":this.decrementHour();break;case"minute":this.decrementMinute();break;case"second":this.decrementSecond();break;case"meridian":this.toggleMeridian()}this.setTime(this.getTime()),e.get(0).setSelectionRange(0,2)}},widgetKeyup:function(t){(65===t.keyCode||77===t.keyCode||80===t.keyCode||46===t.keyCode||8===t.keyCode||t.keyCode>=46&&t.keyCode<=57)&&this.updateFromWidgetInputs()}},t.fn.timepicker=function(i){var e=Array.apply(null,arguments);return e.shift(),this.each(function(){var s=t(this),h=s.data("timepicker"),o="object"==typeof i&&i;h||s.data("timepicker",h=new n(this,t.extend({},t.fn.timepicker.defaults,o,t(this).data()))),"string"==typeof i&&h[i].apply(h,e)})},t.fn.timepicker.defaults={defaultTime:"current",disableFocus:!1,disableMousewheel:!1,isOpen:!1,minuteStep:15,modalBackdrop:!1,orientation:{x:"auto",y:"auto"},secondStep:15,showSeconds:!1,showInputs:!0,showMeridian:!0,template:"dropdown",appendWidgetTo:"body",showWidgetOnAddonClick:!0},t.fn.timepicker.Constructor=n}(jQuery,window,document);;!function(t,n){function e(t){return"object"==typeof t}function o(t){return"string"==typeof t}function i(t){return"number"==typeof t}function a(t){return t===n}function r(){q=google.maps,A||(A={verbose:!1,queryLimit:{attempt:5,delay:250,random:250},classes:function(){var n={};return t.each("Map Marker InfoWindow Circle Rectangle OverlayView StreetViewPanorama KmlLayer TrafficLayer BicyclingLayer GroundOverlay StyledMapType ImageMapType".split(" "),function(t,e){n[e]=q[e]}),n}(),map:{mapTypeId:q.MapTypeId.ROADMAP,center:[46.578498,2.457275],zoom:2},overlay:{pane:"floatPane",content:"",offset:{x:0,y:0}},geoloc:{getCurrentPosition:{maximumAge:6e4,timeout:5e3}}})}function s(t,n){return a(t)?"gmap3_"+(n?Z+1:++Z):t}function u(t){var n,e=q.version.split(".");for(t=t.split("."),n=0;n<e.length;n++)e[n]=parseInt(e[n],10);for(n=0;n<t.length;n++){if(t[n]=parseInt(t[n],10),!e.hasOwnProperty(n))return!1;if(e[n]<t[n])return!1}return!0}function l(n,e,o,i,a){function r(e,i){e&&t.each(e,function(t,e){var r=n,s=e;R(e)&&(r=e[0],s=e[1]),i(o,t,function(t){s.apply(r,[a||o,t,u])})})}var s=e.td||{},u={id:i,data:s.data,tag:s.tag};r(s.events,q.event.addListener),r(s.onces,q.event.addListenerOnce)}function d(t){var n,e=[];for(n in t)t.hasOwnProperty(n)&&e.push(n);return e}function c(t,n){var e,o=arguments;for(e=2;e<o.length;e++)if(n in o[e]&&o[e].hasOwnProperty(n))return void(t[n]=o[e][n])}function p(n,e){var o,i,a=["data","tag","id","events","onces"],r={};if(n.td)for(o in n.td)n.td.hasOwnProperty(o)&&"options"!==o&&"values"!==o&&(r[o]=n.td[o]);for(i=0;i<a.length;i++)c(r,a[i],e,n.td);return r.options=t.extend({},n.opts||{},e.options||{}),r}function f(){if(A.verbose){var t,n=[];if(window.console&&z(console.error)){for(t=0;t<arguments.length;t++)n.push(arguments[t]);console.error.apply(console,n)}else{for(n="",t=0;t<arguments.length;t++)n+=arguments[t].toString()+" ";alert(n)}}}function g(t){return(i(t)||o(t))&&""!==t&&!isNaN(t)}function h(t){var n,o=[];if(!a(t))if(e(t))if(i(t.length))o=t;else for(n in t)o.push(t[n]);else o.push(t);return o}function v(n){return n?z(n)?n:(n=h(n),function(o){var i;if(a(o))return!1;if(e(o)){for(i=0;i<o.length;i++)if(t.inArray(o[i],n)>=0)return!0;return!1}return t.inArray(o,n)>=0}):void 0}function m(t,n,e){var i=n?t:null;return!t||o(t)?i:t.latLng?m(t.latLng):t instanceof q.LatLng?t:g(t.lat)?new q.LatLng(t.lat,t.lng):!e&&R(t)&&g(t[0])&&g(t[1])?new q.LatLng(t[0],t[1]):i}function y(t){var n,e;return!t||t instanceof q.LatLngBounds?t||null:(R(t)?2===t.length?(n=m(t[0]),e=m(t[1])):4===t.length&&(n=m([t[0],t[1]]),e=m([t[2],t[3]])):"ne"in t&&"sw"in t?(n=m(t.ne),e=m(t.sw)):"n"in t&&"e"in t&&"s"in t&&"w"in t&&(n=m([t.n,t.e]),e=m([t.s,t.w])),n&&e?new q.LatLngBounds(e,n):null)}function w(t,n,e,i,a){var r=e?m(i.td,!1,!0):!1,s=r?{latLng:r}:i.td.address?o(i.td.address)?{address:i.td.address}:i.td.address:!1,u=s?G.get(s):!1,l=this;s?(a=a||0,u?(i.latLng=u.results[0].geometry.location,i.results=u.results,i.status=u.status,n.apply(t,[i])):(s.location&&(s.location=m(s.location)),s.bounds&&(s.bounds=y(s.bounds)),M().geocode(s,function(o,r){r===q.GeocoderStatus.OK?(G.store(s,{results:o,status:r}),i.latLng=o[0].geometry.location,i.results=o,i.status=r,n.apply(t,[i])):r===q.GeocoderStatus.OVER_QUERY_LIMIT&&a<A.queryLimit.attempt?setTimeout(function(){w.apply(l,[t,n,e,i,a+1])},A.queryLimit.delay+Math.floor(Math.random()*A.queryLimit.random)):(f("geocode failed",r,s),i.latLng=i.results=!1,i.status=r,n.apply(t,[i]))}))):(i.latLng=m(i.td,!1,!0),n.apply(t,[i]))}function L(n,e,o,i){function a(){do s++;while(s<n.length&&!("address"in n[s]));return s>=n.length?void o.apply(e,[i]):void w(r,function(e){delete e.td,t.extend(n[s],e),a.apply(r,[])},!0,{td:n[s]})}var r=this,s=-1;a()}function b(t,n,e){var o=!1;navigator&&navigator.geolocation?navigator.geolocation.getCurrentPosition(function(i){o||(o=!0,e.latLng=new q.LatLng(i.coords.latitude,i.coords.longitude),n.apply(t,[e]))},function(){o||(o=!0,e.latLng=!1,n.apply(t,[e]))},e.opts.getCurrentPosition):(e.latLng=!1,n.apply(t,[e]))}function x(t){var n,o=!1;if(e(t)&&t.hasOwnProperty("get")){for(n in t)if("get"!==n)return!1;o=!t.get.hasOwnProperty("callback")}return o}function M(){return V.geocoder||(V.geocoder=new q.Geocoder),V.geocoder}function I(){var t=[];this.get=function(n){if(t.length){var o,i,a,r,s,u=d(n);for(o=0;o<t.length;o++){for(r=t[o],s=u.length===r.keys.length,i=0;i<u.length&&s;i++)a=u[i],s=a in r.request,s&&(s=e(n[a])&&"equals"in n[a]&&z(n[a])?n[a].equals(r.request[a]):n[a]===r.request[a]);if(s)return r.results}}},this.store=function(n,e){t.push({request:n,keys:d(n),results:e})}}function P(){var t=[],n=this;n.empty=function(){return!t.length},n.add=function(n){t.push(n)},n.get=function(){return t.length?t[0]:!1},n.ack=function(){t.shift()}}function k(){function n(t){return{id:t.id,name:t.name,object:t.obj,tag:t.tag,data:t.data}}function e(t){z(t.setMap)&&t.setMap(null),z(t.remove)&&t.remove(),z(t.free)&&t.free(),t=null}var o={},i={},r=this;r.add=function(t,n,e,a){var u=t.td||{},l=s(u.id);return o[n]||(o[n]=[]),l in i&&r.clearById(l),i[l]={obj:e,sub:a,name:n,id:l,tag:u.tag,data:u.data},o[n].push(l),l},r.getById=function(t,e,o){var a=!1;return t in i&&(a=e?i[t].sub:o?n(i[t]):i[t].obj),a},r.get=function(t,e,a,r){var s,u,l=v(a);if(!o[t]||!o[t].length)return null;for(s=o[t].length;s;)if(s--,u=o[t][e?s:o[t].length-s-1],u&&i[u]){if(l&&!l(i[u].tag))continue;return r?n(i[u]):i[u].obj}return null},r.all=function(t,e,r){var s=[],u=v(e),l=function(t){var e,a;for(e=0;e<o[t].length;e++)if(a=o[t][e],a&&i[a]){if(u&&!u(i[a].tag))continue;s.push(r?n(i[a]):i[a].obj)}};if(t in o)l(t);else if(a(t))for(t in o)l(t);return s},r.rm=function(t,n,e){var a,s;if(!o[t])return!1;if(n)if(e)for(a=o[t].length-1;a>=0&&(s=o[t][a],!n(i[s].tag));a--);else for(a=0;a<o[t].length&&(s=o[t][a],!n(i[s].tag));a++);else a=e?o[t].length-1:0;return a in o[t]?r.clearById(o[t][a],a):!1},r.clearById=function(t,n){if(t in i){var r,s=i[t].name;for(r=0;a(n)&&r<o[s].length;r++)t===o[s][r]&&(n=r);return e(i[t].obj),i[t].sub&&e(i[t].sub),delete i[t],o[s].splice(n,1),!0}return!1},r.objGetById=function(t){var n,e;if(o.clusterer)for(e in o.clusterer)if((n=i[o.clusterer[e]].obj.getById(t))!==!1)return n;return!1},r.objClearById=function(t){var n;if(o.clusterer)for(n in o.clusterer)if(i[o.clusterer[n]].obj.clearById(t))return!0;return null},r.clear=function(t,n,e,i){var a,s,u,l=v(i);if(t&&t.length)t=h(t);else{t=[];for(a in o)t.push(a)}for(s=0;s<t.length;s++)if(u=t[s],n)r.rm(u,l,!0);else if(e)r.rm(u,l,!1);else for(;r.rm(u,l,!1););},r.objClear=function(n,e,a,r){var s;if(o.clusterer&&(t.inArray("marker",n)>=0||!n.length))for(s in o.clusterer)i[o.clusterer[s]].obj.clear(e,a,r)}}function B(n,e,i){function a(t){var n={};return n[t]={},n}function r(){var t;for(t in i)if(i.hasOwnProperty(t)&&!u.hasOwnProperty(t))return t}var s,u={},l=this,d={latLng:{map:!1,marker:!1,infowindow:!1,circle:!1,overlay:!1,getlatlng:!1,getmaxzoom:!1,getelevation:!1,streetviewpanorama:!1,getaddress:!0},geoloc:{getgeoloc:!0}};o(i)&&(i=a(i)),l.run=function(){for(var o,a;o=r();){if(z(n[o]))return s=o,a=t.extend(!0,{},A[o]||{},i[o].options||{}),void(o in d.latLng?i[o].values?L(i[o].values,n,n[o],{td:i[o],opts:a,session:u}):w(n,n[o],d.latLng[o],{td:i[o],opts:a,session:u}):o in d.geoloc?b(n,n[o],{td:i[o],opts:a,session:u}):n[o].apply(n,[{td:i[o],opts:a,session:u}]));u[o]=null}e.apply(n,[i,u])},l.ack=function(t){u[s]=t,l.run.apply(l,[])}}function j(){return V.ds||(V.ds=new q.DirectionsService),V.ds}function O(){return V.dms||(V.dms=new q.DistanceMatrixService),V.dms}function C(){return V.mzs||(V.mzs=new q.MaxZoomService),V.mzs}function E(){return V.es||(V.es=new q.ElevationService),V.es}function S(t){function n(){var t=this;return t.onAdd=function(){},t.onRemove=function(){},t.draw=function(){},A.classes.OverlayView.apply(t,[])}n.prototype=A.classes.OverlayView.prototype;var e=new n;return e.setMap(t),e}function T(n,o,i){function a(t){T[t]||(delete _[t].options.map,T[t]=new A.classes.Marker(_[t].options),l(n,{td:_[t]},T[t],_[t].id))}function r(){return(y=U.getProjection())?(P=!0,j.push(q.event.addListener(o,"zoom_changed",f)),j.push(q.event.addListener(o,"bounds_changed",f)),void h()):void setTimeout(function(){r.apply(B,[])},25)}function u(t){e(O[t])?(z(O[t].obj.setMap)&&O[t].obj.setMap(null),z(O[t].obj.remove)&&O[t].obj.remove(),z(O[t].shadow.remove)&&O[t].obj.remove(),z(O[t].shadow.setMap)&&O[t].shadow.setMap(null),delete O[t].obj,delete O[t].shadow):T[t]&&T[t].setMap(null),delete O[t]}function d(){var t,n,e,o,i,a,r,s,u=Math.cos,l=Math.sin,d=arguments;return d[0]instanceof q.LatLng?(t=d[0].lat(),e=d[0].lng(),d[1]instanceof q.LatLng?(n=d[1].lat(),o=d[1].lng()):(n=d[1],o=d[2])):(t=d[0],e=d[1],d[2]instanceof q.LatLng?(n=d[2].lat(),o=d[2].lng()):(n=d[2],o=d[3])),i=Math.PI*t/180,a=Math.PI*e/180,r=Math.PI*n/180,s=Math.PI*o/180,6371e3*Math.acos(Math.min(u(i)*u(r)*u(a)*u(s)+u(i)*l(a)*u(r)*l(s)+l(i)*l(r),1))}function c(){var t=d(o.getCenter(),o.getBounds().getNorthEast()),n=new q.Circle({center:o.getCenter(),radius:1.25*t});return n.getBounds()}function p(){var t,n={};for(t in O)n[t]=!0;return n}function f(){clearTimeout(m),m=setTimeout(h,25)}function g(t){var n=y.fromLatLngToDivPixel(t),e=y.fromDivPixelToLatLng(new q.Point(n.x+i.radius,n.y-i.radius)),o=y.fromDivPixelToLatLng(new q.Point(n.x-i.radius,n.y+i.radius));return new q.LatLngBounds(o,e)}function h(){if(!x&&!I&&P){var n,e,a,r,s,l,d,f,h,v,m,y=!1,b=[],B={},j=o.getZoom(),C="maxZoom"in i&&j>i.maxZoom,E=p();for(M=!1,j>3&&(s=c(),y=s.getSouthWest().lng()<s.getNorthEast().lng()),n=0;n<_.length;n++)!_[n]||y&&!s.contains(_[n].options.position)||w&&!w(D[n])||b.push(n);for(;;){for(n=0;B[n]&&n<b.length;)n++;if(n===b.length)break;if(r=[],k&&!C){m=10;do for(f=r,r=[],m--,d=f.length?s.getCenter():_[b[n]].options.position,s=g(d),e=n;e<b.length;e++)B[e]||s.contains(_[b[e]].options.position)&&r.push(e);while(f.length<r.length&&r.length>1&&m)}else for(e=n;e<b.length;e++)if(!B[e]){r.push(e);break}for(l={indexes:[],ref:[]},h=v=0,a=0;a<r.length;a++)B[r[a]]=!0,l.indexes.push(b[r[a]]),l.ref.push(b[r[a]]),h+=_[b[r[a]]].options.position.lat(),v+=_[b[r[a]]].options.position.lng();h/=r.length,v/=r.length,l.latLng=new q.LatLng(h,v),l.ref=l.ref.join("-"),l.ref in E?delete E[l.ref]:(1===r.length&&(O[l.ref]=!0),L(l))}t.each(E,function(t){u(t)}),I=!1}}var m,y,w,L,b,x=!1,M=!1,I=!1,P=!1,k=!0,B=this,j=[],O={},C={},E={},T=[],_=[],D=[],U=S(o,i.radius);r(),B.getById=function(t){return t in C?(a(C[t]),T[C[t]]):!1},B.rm=function(t){var n=C[t];T[n]&&T[n].setMap(null),delete T[n],T[n]=!1,delete _[n],_[n]=!1,delete D[n],D[n]=!1,delete C[t],delete E[n],M=!0},B.clearById=function(t){return t in C?(B.rm(t),!0):void 0},B.clear=function(t,n,e){var o,i,a,r,s,u=[],l=v(e);for(t?(o=_.length-1,i=-1,a=-1):(o=0,i=_.length,a=1),r=o;r!==i&&(!_[r]||l&&!l(_[r].tag)||(u.push(E[r]),!n&&!t));r+=a);for(s=0;s<u.length;s++)B.rm(u[s])},B.add=function(t,n){t.id=s(t.id),B.clearById(t.id),C[t.id]=T.length,E[T.length]=t.id,T.push(null),_.push(t),D.push(n),M=!0},B.addMarker=function(t,e){e=e||{},e.id=s(e.id),B.clearById(e.id),e.options||(e.options={}),e.options.position=t.getPosition(),l(n,{td:e},t,e.id),C[e.id]=T.length,E[T.length]=e.id,T.push(t),_.push(e),D.push(e.data||{}),M=!0},B.td=function(t){return _[t]},B.value=function(t){return D[t]},B.marker=function(t){return t in T?(a(t),T[t]):!1},B.markerIsSet=function(t){return Boolean(T[t])},B.setMarker=function(t,n){T[t]=n},B.store=function(t,n,e){O[t.ref]={obj:n,shadow:e}},B.free=function(){var n;for(n=0;n<j.length;n++)q.event.removeListener(j[n]);j=[],t.each(O,function(t){u(t)}),O={},t.each(_,function(t){_[t]=null}),_=[],t.each(T,function(t){T[t]&&(T[t].setMap(null),delete T[t])}),T=[],t.each(D,function(t){delete D[t]}),D=[],C={},E={}},B.filter=function(t){w=t,h()},B.enable=function(t){k!==t&&(k=t,h())},B.display=function(t){L=t},B.error=function(t){b=t},B.beginUpdate=function(){x=!0},B.endUpdate=function(){x=!1,M&&h()},B.autofit=function(t){var n;for(n=0;n<_.length;n++)_[n]&&t.extend(_[n].options.position)}}function _(t,n){var e=this;e.id=function(){return t},e.filter=function(t){n.filter(t)},e.enable=function(){n.enable(!0)},e.disable=function(){n.enable(!1)},e.add=function(t,e,o){o||n.beginUpdate(),n.addMarker(t,e),o||n.endUpdate()},e.getById=function(t){return n.getById(t)},e.clearById=function(t,e){var o;return e||n.beginUpdate(),o=n.clearById(t),e||n.endUpdate(),o},e.clear=function(t,e,o,i){i||n.beginUpdate(),n.clear(t,e,o),i||n.endUpdate()}}function D(n,e,o,i){var a=this,r=[];A.classes.OverlayView.call(a),a.setMap(n),a.onAdd=function(){var n=a.getPanes();e.pane in n&&t(n[e.pane]).append(i),t.each("dblclick click mouseover mousemove mouseout mouseup mousedown".split(" "),function(n,e){r.push(q.event.addDomListener(i[0],e,function(n){t.Event(n).stopPropagation(),q.event.trigger(a,e,[n]),a.draw()}))}),r.push(q.event.addDomListener(i[0],"contextmenu",function(n){t.Event(n).stopPropagation(),q.event.trigger(a,"rightclick",[n]),a.draw()}))},a.getPosition=function(){return o},a.setPosition=function(t){o=t,a.draw()},a.draw=function(){var t=a.getProjection().fromLatLngToDivPixel(o);i.css("left",t.x+e.offset.x+"px").css("top",t.y+e.offset.y+"px")},a.onRemove=function(){var t;for(t=0;t<r.length;t++)q.event.removeListener(r[t]);i.remove()},a.hide=function(){i.hide()},a.show=function(){i.show()},a.toggle=function(){i&&(i.is(":visible")?a.show():a.hide())},a.toggleDOM=function(){a.setMap(a.getMap()?null:n)},a.getDOMElement=function(){return i[0]}}function U(i){function r(){!b&&(b=M.get())&&b.run()}function d(){b=null,M.ack(),r.call(x)}function c(t){var n,e=t.td.callback;e&&(n=Array.prototype.slice.call(arguments,1),z(e)?e.apply(i,n):R(e)&&z(e[1])&&e[1].apply(e[0],n))}function g(t,n,e){e&&l(i,t,n,e),c(t,n),b.ack(n)}function v(n,e){e=e||{};var o=e.td&&e.td.options?e.td.options:0;S?o&&(o.center&&(o.center=m(o.center)),S.setOptions(o)):(o=e.opts||t.extend(!0,{},A.map,o||{}),o.center=n||m(o.center),S=new A.classes.Map(i.get(0),o))}function w(e){var o,a,r=new T(i,S,e),s={},u={},d=[],c=/^[0-9]+$/;for(a in e)c.test(a)?(d.push(1*a),u[a]=e[a],u[a].width=u[a].width||0,u[a].height=u[a].height||0):s[a]=e[a];return d.sort(function(t,n){return t>n}),o=s.calculator?function(n){var e=[];return t.each(n,function(t,n){e.push(r.value(n))}),s.calculator.apply(i,[e])}:function(t){return t.length},r.error(function(){f.apply(x,arguments)}),r.display(function(a){var c,p,f,g,h,v,y=o(a.indexes);if(e.force||y>1)for(c=0;c<d.length;c++)d[c]<=y&&(p=u[d[c]]);p?(h=p.offset||[-p.width/2,-p.height/2],f=t.extend({},s),f.options=t.extend({pane:"overlayLayer",content:p.content?p.content.replace("CLUSTER_COUNT",y):"",offset:{x:("x"in h?h.x:h[0])||0,y:("y"in h?h.y:h[1])||0}},s.options||{}),g=x.overlay({td:f,opts:f.options,latLng:m(a)},!0),f.options.pane="floatShadow",f.options.content=t(document.createElement("div")).width(p.width+"px").height(p.height+"px").css({cursor:"pointer"}),v=x.overlay({td:f,opts:f.options,latLng:m(a)},!0),s.data={latLng:m(a),markers:[]},t.each(a.indexes,function(t,n){s.data.markers.push(r.value(n)),r.markerIsSet(n)&&r.marker(n).setMap(null)}),l(i,{td:s},v,n,{main:g,shadow:v}),r.store(a,g,v)):t.each(a.indexes,function(t,n){r.marker(n).setMap(S)})}),r}function L(n,e,o){var a=[],r="values"in n.td;return r||(n.td.values=[{options:n.opts}]),n.td.values.length?(v(),t.each(n.td.values,function(t,r){var s,u,d,c,f=p(n,r);if(f.options[o])if(f.options[o][0][0]&&R(f.options[o][0][0]))for(u=0;u<f.options[o].length;u++)for(d=0;d<f.options[o][u].length;d++)f.options[o][u][d]=m(f.options[o][u][d]);else for(u=0;u<f.options[o].length;u++)f.options[o][u]=m(f.options[o][u]);f.options.map=S,c=new q[e](f.options),a.push(c),s=I.add({td:f},e.toLowerCase(),c),l(i,{td:f},c,s)}),void g(n,r?a:a[0])):void g(n,!1)}var b,x=this,M=new P,I=new k,S=null;x._plan=function(t){var n;for(n=0;n<t.length;n++)M.add(new B(x,d,t[n]));r()},x.map=function(t){v(t.latLng,t),l(i,t,S),g(t,S)},x.destroy=function(t){I.clear(),i.empty(),S&&(S=null),g(t,!0)},x.overlay=function(n,e){var o=[],a="values"in n.td;return a||(n.td.values=[{latLng:n.latLng,options:n.opts}]),n.td.values.length?(D.__initialised||(D.prototype=new A.classes.OverlayView,D.__initialised=!0),t.each(n.td.values,function(a,r){var s,u,d=p(n,r),c=t(document.createElement("div")).css({border:"none",borderWidth:0,position:"absolute"});c.append(d.options.content),u=new D(S,d.options,m(d)||m(r),c),o.push(u),c=null,e||(s=I.add(n,"overlay",u),l(i,{td:d},u,s))}),e?o[0]:void g(n,a?o:o[0])):void g(n,!1)},x.marker=function(n){var e,o,a,r="values"in n.td,u=!S;return r||(n.opts.position=n.latLng||m(n.opts.position),n.td.values=[{options:n.opts}]),n.td.values.length?(u&&v(),n.td.cluster&&!S.getBounds()?void q.event.addListenerOnce(S,"bounds_changed",function(){x.marker.apply(x,[n])}):void(n.td.cluster?(n.td.cluster instanceof _?(o=n.td.cluster,a=I.getById(o.id(),!0)):(a=w(n.td.cluster),o=new _(s(n.td.id,!0),a),I.add(n,"clusterer",o,a)),a.beginUpdate(),t.each(n.td.values,function(t,e){var o=p(n,e);o.options.position=m(o.options.position?o.options.position:e),o.options.position&&(o.options.map=S,u&&(S.setCenter(o.options.position),u=!1),a.add(o,e))}),a.endUpdate(),g(n,o)):(e=[],t.each(n.td.values,function(t,o){var a,r,s=p(n,o);s.options.position=m(s.options.position?s.options.position:o),s.options.position&&(s.options.map=S,u&&(S.setCenter(s.options.position),u=!1),r=new A.classes.Marker(s.options),e.push(r),a=I.add({td:s},"marker",r),l(i,{td:s},r,a))}),g(n,r?e:e[0])))):void g(n,!1)},x.getroute=function(t){t.opts.origin=m(t.opts.origin,!0),t.opts.destination=m(t.opts.destination,!0),j().route(t.opts,function(n,e){c(t,e===q.DirectionsStatus.OK?n:!1,e),b.ack()})},x.getdistance=function(t){var n;for(t.opts.origins=h(t.opts.origins),n=0;n<t.opts.origins.length;n++)t.opts.origins[n]=m(t.opts.origins[n],!0);for(t.opts.destinations=h(t.opts.destinations),n=0;n<t.opts.destinations.length;n++)t.opts.destinations[n]=m(t.opts.destinations[n],!0);O().getDistanceMatrix(t.opts,function(n,e){c(t,e===q.DistanceMatrixStatus.OK?n:!1,e),b.ack()})},x.infowindow=function(e){var o=[],r="values"in e.td;r||(e.latLng&&(e.opts.position=e.latLng),e.td.values=[{options:e.opts}]),t.each(e.td.values,function(t,s){var u,d,c=p(e,s);c.options.position=m(c.options.position?c.options.position:s.latLng),S||v(c.options.position),d=new A.classes.InfoWindow(c.options),d&&(a(c.open)||c.open)&&(r?d.open(S,c.anchor||n):d.open(S,c.anchor||(e.latLng?n:e.session.marker?e.session.marker:n))),o.push(d),u=I.add({td:c},"infowindow",d),l(i,{td:c},d,u)}),g(e,r?o:o[0])},x.circle=function(n){var e=[],o="values"in n.td;return o||(n.opts.center=n.latLng||m(n.opts.center),n.td.values=[{options:n.opts}]),n.td.values.length?(t.each(n.td.values,function(t,o){var a,r,s=p(n,o);s.options.center=m(s.options.center?s.options.center:o),S||v(s.options.center),s.options.map=S,r=new A.classes.Circle(s.options),e.push(r),a=I.add({td:s},"circle",r),l(i,{td:s},r,a)}),void g(n,o?e:e[0])):void g(n,!1)},x.getaddress=function(t){c(t,t.results,t.status),b.ack()},x.getlatlng=function(t){c(t,t.results,t.status),b.ack()},x.getmaxzoom=function(t){C().getMaxZoomAtLatLng(t.latLng,function(n){c(t,n.status===q.MaxZoomStatus.OK?n.zoom:!1,status),b.ack()})},x.getelevation=function(t){var n,e=[],o=function(n,e){c(t,e===q.ElevationStatus.OK?n:!1,e),b.ack()};if(t.latLng)e.push(t.latLng);else for(e=h(t.td.locations||[]),n=0;n<e.length;n++)e[n]=m(e[n]);if(e.length)E().getElevationForLocations({locations:e},o);else{if(t.td.path&&t.td.path.length)for(n=0;n<t.td.path.length;n++)e.push(m(t.td.path[n]));e.length?E().getElevationAlongPath({path:e,samples:t.td.samples},o):b.ack()}},x.defaults=function(n){t.each(n.td,function(n,o){A[n]=e(A[n])?t.extend({},A[n],o):o}),b.ack(!0)},x.rectangle=function(n){var e=[],o="values"in n.td;return o||(n.td.values=[{options:n.opts}]),n.td.values.length?(t.each(n.td.values,function(t,o){var a,r,s=p(n,o);s.options.bounds=y(s.options.bounds?s.options.bounds:o),S||v(s.options.bounds.getCenter()),s.options.map=S,r=new A.classes.Rectangle(s.options),e.push(r),a=I.add({td:s},"rectangle",r),l(i,{td:s},r,a)}),void g(n,o?e:e[0])):void g(n,!1)},x.polyline=function(t){L(t,"Polyline","path")},x.polygon=function(t){L(t,"Polygon","paths")},x.trafficlayer=function(t){v();var n=I.get("trafficlayer");n||(n=new A.classes.TrafficLayer,n.setMap(S),I.add(t,"trafficlayer",n)),g(t,n)},x.bicyclinglayer=function(t){v();var n=I.get("bicyclinglayer");n||(n=new A.classes.BicyclingLayer,n.setMap(S),I.add(t,"bicyclinglayer",n)),g(t,n)},x.groundoverlay=function(t){t.opts.bounds=y(t.opts.bounds),t.opts.bounds&&v(t.opts.bounds.getCenter());var n,e=new A.classes.GroundOverlay(t.opts.url,t.opts.bounds,t.opts.opts);e.setMap(S),n=I.add(t,"groundoverlay",e),g(t,e,n)},x.streetviewpanorama=function(n){n.opts.opts||(n.opts.opts={}),n.latLng?n.opts.opts.position=n.latLng:n.opts.opts.position&&(n.opts.opts.position=m(n.opts.opts.position)),n.td.divId?n.opts.container=document.getElementById(n.td.divId):n.opts.container&&(n.opts.container=t(n.opts.container).get(0));var e,o=new A.classes.StreetViewPanorama(n.opts.container,n.opts.opts);o&&S.setStreetView(o),e=I.add(n,"streetviewpanorama",o),g(n,o,e)},x.kmllayer=function(n){var e=[],o="values"in n.td;return o||(n.td.values=[{options:n.opts}]),n.td.values.length?(t.each(n.td.values,function(t,o){var a,r,s,d=p(n,o);S||v(),s=d.options,d.options.opts&&(s=d.options.opts,d.options.url&&(s.url=d.options.url)),s.map=S,r=u("3.10")?new A.classes.KmlLayer(s):new A.classes.KmlLayer(s.url,s),e.push(r),a=I.add({td:d},"kmllayer",r),l(i,{td:d},r,a)}),void g(n,o?e:e[0])):void g(n,!1)},x.panel=function(n){v();var e,o,r=0,s=0,u=t(document.createElement("div"));u.css({position:"absolute",zIndex:1e3,visibility:"hidden"}),n.opts.content&&(o=t(n.opts.content),u.append(o),i.first().prepend(u),a(n.opts.left)?a(n.opts.right)?n.opts.center&&(r=(i.width()-o.width())/2):r=i.width()-o.width()-n.opts.right:r=n.opts.left,a(n.opts.top)?a(n.opts.bottom)?n.opts.middle&&(s=(i.height()-o.height())/2):s=i.height()-o.height()-n.opts.bottom:s=n.opts.top,u.css({top:s,left:r,visibility:"visible"})),e=I.add(n,"panel",u),g(n,u,e),u=null},x.directionsrenderer=function(n){n.opts.map=S;var e,o=new q.DirectionsRenderer(n.opts);n.td.divId?o.setPanel(document.getElementById(n.td.divId)):n.td.container&&o.setPanel(t(n.td.container).get(0)),e=I.add(n,"directionsrenderer",o),g(n,o,e)},x.getgeoloc=function(t){g(t,t.latLng)},x.styledmaptype=function(t){v();var n=new A.classes.StyledMapType(t.td.styles,t.opts);S.mapTypes.set(t.td.id,n),g(t,n)},x.imagemaptype=function(t){v();var n=new A.classes.ImageMapType(t.opts);S.mapTypes.set(t.td.id,n),g(t,n)},x.autofit=function(n){var e=new q.LatLngBounds;t.each(I.all(),function(t,n){n.getPosition?e.extend(n.getPosition()):n.getBounds?(e.extend(n.getBounds().getNorthEast()),e.extend(n.getBounds().getSouthWest())):n.getPaths?n.getPaths().forEach(function(t){t.forEach(function(t){e.extend(t)})}):n.getPath?n.getPath().forEach(function(t){e.extend(t)}):n.getCenter?e.extend(n.getCenter()):"function"==typeof _&&n instanceof _&&(n=I.getById(n.id(),!0),n&&n.autofit(e))}),e.isEmpty()||S.getBounds()&&S.getBounds().equals(e)||("maxZoom"in n.td&&q.event.addListenerOnce(S,"bounds_changed",function(){this.getZoom()>n.td.maxZoom&&this.setZoom(n.td.maxZoom)}),S.fitBounds(e)),g(n,!0)},x.clear=function(n){if(o(n.td)){if(I.clearById(n.td)||I.objClearById(n.td))return void g(n,!0);n.td={name:n.td}}n.td.id?t.each(h(n.td.id),function(t,n){I.clearById(n)||I.objClearById(n)}):(I.clear(h(n.td.name),n.td.last,n.td.first,n.td.tag),I.objClear(h(n.td.name),n.td.last,n.td.first,n.td.tag)),g(n,!0)},x.get=function(e,i,a){var r,s,u=i?e:e.td;return i||(a=u.full),o(u)?(s=I.getById(u,!1,a)||I.objGetById(u),s===!1&&(r=u,u={})):r=u.name,"map"===r&&(s=S),s||(s=[],u.id?(t.each(h(u.id),function(t,n){s.push(I.getById(n,!1,a)||I.objGetById(n))}),R(u.id)||(s=s[0])):(t.each(r?h(r):[n],function(n,e){var o;u.first?(o=I.get(e,!1,u.tag,a),o&&s.push(o)):u.all?t.each(I.all(e,u.tag,a),function(t,n){s.push(n)}):(o=I.get(e,!0,u.tag,a),o&&s.push(o))}),u.all||R(r)||(s=s[0]))),s=R(s)||!u.all?s:[s],i?s:void g(e,s)},x.exec=function(n){t.each(h(n.td.func),function(e,o){t.each(x.get(n.td,!0,n.td.hasOwnProperty("full")?n.td.full:!0),function(t,n){o.call(i,n)})}),g(n,!0)},x.trigger=function(n){if(o(n.td))q.event.trigger(S,n.td);else{var e=[S,n.td.eventName];n.td.var_args&&t.each(n.td.var_args,function(t,n){e.push(n)}),q.event.trigger.apply(q.event,e)}c(n),b.ack()}}var A,q,Z=0,z=t.isFunction,R=t.isArray,V={},G=new I;t.fn.gmap3=function(){var n,e=[],o=!0,i=[];for(r(),n=0;n<arguments.length;n++)arguments[n]&&e.push(arguments[n]);return e.length||e.push("map"),t.each(this,function(){var n=t(this),a=n.data("gmap3");o=!1,a||(a=new U(n),n.data("gmap3",a)),1!==e.length||"get"!==e[0]&&!x(e[0])?a._plan(e):i.push("get"===e[0]?a.get("map",!0):a.get(e[0].get,!0,e[0].get.full))}),i.length?1===i.length?i[0]:i:this}}(jQuery);;function MarkerClusterer(t,e,r){this.extend(MarkerClusterer,google.maps.OverlayView),this.map_=t,this.markers_=[],this.clusters_=[],this.sizes=[53,56,66,78,90],this.styles_=[],this.ready_=!1;var s=r||{};this.gridSize_=s.gridSize||60,this.minClusterSize_=s.minimumClusterSize||2,this.maxZoom_=s.maxZoom||null,this.styles_=s.styles||[],this.imagePath_=s.imagePath||this.MARKER_CLUSTER_IMAGE_PATH_,this.imageExtension_=s.imageExtension||this.MARKER_CLUSTER_IMAGE_EXTENSION_,this.zoomOnClick_=!0,void 0!=s.zoomOnClick&&(this.zoomOnClick_=s.zoomOnClick),this.averageCenter_=!1,void 0!=s.averageCenter&&(this.averageCenter_=s.averageCenter),this.setupStyles_(),this.setMap(t),this.prevZoom_=this.map_.getZoom();var o=this;google.maps.event.addListener(this.map_,"zoom_changed",function(){var t=o.map_.getZoom();o.prevZoom_!=t&&(o.prevZoom_=t,o.resetViewport())}),google.maps.event.addListener(this.map_,"idle",function(){o.redraw()}),e&&e.length&&this.addMarkers(e,!1)}function Cluster(t){this.markerClusterer_=t,this.map_=t.getMap(),this.gridSize_=t.getGridSize(),this.minClusterSize_=t.getMinClusterSize(),this.averageCenter_=t.isAverageCenter(),this.center_=null,this.markers_=[],this.bounds_=null,this.clusterIcon_=new ClusterIcon(this,t.getStyles(),t.getGridSize())}function ClusterIcon(t,e,r){t.getMarkerClusterer().extend(ClusterIcon,google.maps.OverlayView),this.styles_=e,this.padding_=r||0,this.cluster_=t,this.center_=null,this.map_=t.getMap(),this.div_=null,this.sums_=null,this.visible_=!1,this.setMap(this.map_)}MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_PATH_="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/images/m",MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_EXTENSION_="png",MarkerClusterer.prototype.extend=function(t,e){return function(t){for(var e in t.prototype)this.prototype[e]=t.prototype[e];return this}.apply(t,[e])},MarkerClusterer.prototype.onAdd=function(){this.setReady_(!0)},MarkerClusterer.prototype.draw=function(){},MarkerClusterer.prototype.setupStyles_=function(){if(!this.styles_.length)for(var t,e=0;t=this.sizes[e];e++)this.styles_.push({url:this.imagePath_+(e+1)+"."+this.imageExtension_,height:t,width:t})},MarkerClusterer.prototype.fitMapToMarkers=function(){for(var t,e=this.getMarkers(),r=new google.maps.LatLngBounds,s=0;t=e[s];s++)r.extend(t.getPosition());this.map_.fitBounds(r)},MarkerClusterer.prototype.setStyles=function(t){this.styles_=t},MarkerClusterer.prototype.getStyles=function(){return this.styles_},MarkerClusterer.prototype.isZoomOnClick=function(){return this.zoomOnClick_},MarkerClusterer.prototype.isAverageCenter=function(){return this.averageCenter_},MarkerClusterer.prototype.getMarkers=function(){return this.markers_},MarkerClusterer.prototype.getTotalMarkers=function(){return this.markers_.length},MarkerClusterer.prototype.setMaxZoom=function(t){this.maxZoom_=t},MarkerClusterer.prototype.getMaxZoom=function(){return this.maxZoom_},MarkerClusterer.prototype.calculator_=function(t,e){for(var r=0,s=t.length,o=s;0!==o;)o=parseInt(o/10,10),r++;return r=Math.min(r,e),{text:s,index:r}},MarkerClusterer.prototype.setCalculator=function(t){this.calculator_=t},MarkerClusterer.prototype.getCalculator=function(){return this.calculator_},MarkerClusterer.prototype.addMarkers=function(t,e){for(var r,s=0;r=t[s];s++)this.pushMarkerTo_(r);e||this.redraw()},MarkerClusterer.prototype.pushMarkerTo_=function(t){if(t.isAdded=!1,t.draggable){var e=this;google.maps.event.addListener(t,"dragend",function(){t.isAdded=!1,e.repaint()})}this.markers_.push(t)},MarkerClusterer.prototype.addMarker=function(t,e){this.pushMarkerTo_(t),e||this.redraw()},MarkerClusterer.prototype.removeMarker_=function(t){var e=-1;if(this.markers_.indexOf)e=this.markers_.indexOf(t);else for(var r,s=0;r=this.markers_[s];s++)if(r==t){e=s;break}return-1==e?!1:(t.setMap(null),this.markers_.splice(e,1),!0)},MarkerClusterer.prototype.removeMarker=function(t,e){var r=this.removeMarker_(t);return!e&&r?(this.resetViewport(),this.redraw(),!0):!1},MarkerClusterer.prototype.removeMarkers=function(t,e){for(var r,s=!1,o=0;r=t[o];o++){var i=this.removeMarker_(r);s=s||i}return!e&&s?(this.resetViewport(),this.redraw(),!0):void 0},MarkerClusterer.prototype.setReady_=function(t){this.ready_||(this.ready_=t,this.createClusters_())},MarkerClusterer.prototype.getTotalClusters=function(){return this.clusters_.length},MarkerClusterer.prototype.getMap=function(){return this.map_},MarkerClusterer.prototype.setMap=function(t){this.map_=t},MarkerClusterer.prototype.getGridSize=function(){return this.gridSize_},MarkerClusterer.prototype.setGridSize=function(t){this.gridSize_=t},MarkerClusterer.prototype.getMinClusterSize=function(){return this.minClusterSize_},MarkerClusterer.prototype.setMinClusterSize=function(t){this.minClusterSize_=t},MarkerClusterer.prototype.getExtendedBounds=function(t){var e=this.getProjection(),r=new google.maps.LatLng(t.getNorthEast().lat(),t.getNorthEast().lng()),s=new google.maps.LatLng(t.getSouthWest().lat(),t.getSouthWest().lng()),o=e.fromLatLngToDivPixel(r);o.x+=this.gridSize_,o.y-=this.gridSize_;var i=e.fromLatLngToDivPixel(s);i.x-=this.gridSize_,i.y+=this.gridSize_;var n=e.fromDivPixelToLatLng(o),a=e.fromDivPixelToLatLng(i);return t.extend(n),t.extend(a),t},MarkerClusterer.prototype.isMarkerInBounds_=function(t,e){return e.contains(t.getPosition())},MarkerClusterer.prototype.clearMarkers=function(){this.resetViewport(!0),this.markers_=[]},MarkerClusterer.prototype.resetViewport=function(t){for(var e,r=0;e=this.clusters_[r];r++)e.remove();for(var s,r=0;s=this.markers_[r];r++)s.isAdded=!1,t&&s.setMap(null);this.clusters_=[]},MarkerClusterer.prototype.repaint=function(){var t=this.clusters_.slice();this.clusters_.length=0,this.resetViewport(),this.redraw(),window.setTimeout(function(){for(var e,r=0;e=t[r];r++)e.remove()},0)},MarkerClusterer.prototype.redraw=function(){this.createClusters_()},MarkerClusterer.prototype.distanceBetweenPoints_=function(t,e){if(!t||!e)return 0;var r=6371,s=(e.lat()-t.lat())*Math.PI/180,o=(e.lng()-t.lng())*Math.PI/180,i=Math.sin(s/2)*Math.sin(s/2)+Math.cos(t.lat()*Math.PI/180)*Math.cos(e.lat()*Math.PI/180)*Math.sin(o/2)*Math.sin(o/2),n=2*Math.atan2(Math.sqrt(i),Math.sqrt(1-i)),a=r*n;return a},MarkerClusterer.prototype.addToClosestCluster_=function(t){for(var e,r=4e4,s=null,o=(t.getPosition(),0);e=this.clusters_[o];o++){var i=e.getCenter();if(i){var n=this.distanceBetweenPoints_(i,t.getPosition());r>n&&(r=n,s=e)}}if(s&&s.isMarkerInClusterBounds(t))s.addMarker(t);else{var e=new Cluster(this);e.addMarker(t),this.clusters_.push(e)}},MarkerClusterer.prototype.createClusters_=function(){if(this.ready_)for(var t,e=new google.maps.LatLngBounds(this.map_.getBounds().getSouthWest(),this.map_.getBounds().getNorthEast()),r=this.getExtendedBounds(e),s=0;t=this.markers_[s];s++)!t.isAdded&&this.isMarkerInBounds_(t,r)&&this.addToClosestCluster_(t)},Cluster.prototype.isMarkerAlreadyAdded=function(t){if(this.markers_.indexOf)return-1!=this.markers_.indexOf(t);for(var e,r=0;e=this.markers_[r];r++)if(e==t)return!0;return!1},Cluster.prototype.addMarker=function(t){if(this.isMarkerAlreadyAdded(t))return!1;if(this.center_){if(this.averageCenter_){var e=this.markers_.length+1,r=(this.center_.lat()*(e-1)+t.getPosition().lat())/e,s=(this.center_.lng()*(e-1)+t.getPosition().lng())/e;this.center_=new google.maps.LatLng(r,s),this.calculateBounds_()}}else this.center_=t.getPosition(),this.calculateBounds_();t.isAdded=!0,this.markers_.push(t);var o=this.markers_.length;if(o<this.minClusterSize_&&t.getMap()!=this.map_&&t.setMap(this.map_),o==this.minClusterSize_)for(var i=0;o>i;i++)this.markers_[i].setMap(null);return o>=this.minClusterSize_&&t.setMap(null),this.updateIcon(),!0},Cluster.prototype.getMarkerClusterer=function(){return this.markerClusterer_},Cluster.prototype.getBounds=function(){for(var t,e=new google.maps.LatLngBounds(this.center_,this.center_),r=this.getMarkers(),s=0;t=r[s];s++)e.extend(t.getPosition());return e},Cluster.prototype.remove=function(){this.clusterIcon_.remove(),this.markers_.length=0,delete this.markers_},Cluster.prototype.getSize=function(){return this.markers_.length},Cluster.prototype.getMarkers=function(){return this.markers_},Cluster.prototype.getCenter=function(){return this.center_},Cluster.prototype.calculateBounds_=function(){var t=new google.maps.LatLngBounds(this.center_,this.center_);this.bounds_=this.markerClusterer_.getExtendedBounds(t)},Cluster.prototype.isMarkerInClusterBounds=function(t){return this.bounds_.contains(t.getPosition())},Cluster.prototype.getMap=function(){return this.map_},Cluster.prototype.updateIcon=function(){var t=this.map_.getZoom(),e=this.markerClusterer_.getMaxZoom();if(e&&t>e)for(var r,s=0;r=this.markers_[s];s++)r.setMap(this.map_);else{if(this.markers_.length<this.minClusterSize_)return void this.clusterIcon_.hide();var o=this.markerClusterer_.getStyles().length,i=this.markerClusterer_.getCalculator()(this.markers_,o);this.clusterIcon_.setCenter(this.center_),this.clusterIcon_.setSums(i),this.clusterIcon_.show()}},ClusterIcon.prototype.triggerClusterClick=function(){var t=this.cluster_.getMarkerClusterer();google.maps.event.trigger(t,"clusterclick",this.cluster_),t.isZoomOnClick()&&this.map_.fitBounds(this.cluster_.getBounds())},ClusterIcon.prototype.onAdd=function(){if(this.div_=document.createElement("DIV"),this.visible_){var t=this.getPosFromLatLng_(this.center_);this.div_.style.cssText=this.createCss(t),this.div_.innerHTML=this.sums_.text}var e=this.getPanes();e.overlayMouseTarget.appendChild(this.div_);var r=this;google.maps.event.addDomListener(this.div_,"click",function(){r.triggerClusterClick()})},ClusterIcon.prototype.getPosFromLatLng_=function(t){var e=this.getProjection().fromLatLngToDivPixel(t);return"object"==typeof this.iconAnchor_&&2===this.iconAnchor_.length?(e.x-=this.iconAnchor_[0],e.y-=this.iconAnchor_[1]):(e.x-=parseInt(this.width_/2,10),e.y-=parseInt(this.height_/2,10)),e},ClusterIcon.prototype.draw=function(){if(this.visible_){var t=this.getPosFromLatLng_(this.center_);this.div_.style.top=t.y+"px",this.div_.style.left=t.x+"px"}},ClusterIcon.prototype.hide=function(){this.div_&&(this.div_.style.display="none"),this.visible_=!1},ClusterIcon.prototype.show=function(){if(this.div_){var t=this.getPosFromLatLng_(this.center_);this.div_.style.cssText=this.createCss(t),this.div_.style.display=""}this.visible_=!0},ClusterIcon.prototype.remove=function(){this.setMap(null)},ClusterIcon.prototype.onRemove=function(){this.div_&&this.div_.parentNode&&(this.hide(),this.div_.parentNode.removeChild(this.div_),this.div_=null)},ClusterIcon.prototype.setSums=function(t){this.sums_=t,this.text_=t.text,this.index_=t.index,this.div_&&(this.div_.innerHTML=t.text),this.useStyle()},ClusterIcon.prototype.useStyle=function(){var t=Math.max(0,this.sums_.index-1);t=Math.min(this.styles_.length-1,t);var e=this.styles_[t];this.url_=e.url,this.height_=e.height,this.width_=e.width,this.textColor_=e.textColor,this.anchor_=e.anchor,this.textSize_=e.textSize,this.backgroundPosition_=e.backgroundPosition,this.iconAnchor_=e.iconAnchor},ClusterIcon.prototype.setCenter=function(t){this.center_=t},ClusterIcon.prototype.createCss=function(t){var e=[];e.push("background-image:url("+this.url_+");");var r=this.backgroundPosition_?this.backgroundPosition_:"0 0";e.push("background-position:"+r+";"),"object"==typeof this.anchor_?("number"==typeof this.anchor_[0]&&this.anchor_[0]>0&&this.anchor_[0]<this.height_?e.push("height:"+(this.height_-this.anchor_[0])+"px; padding-top:"+this.anchor_[0]+"px;"):"number"==typeof this.anchor_[0]&&this.anchor_[0]<0&&-this.anchor_[0]<this.height_?e.push("height:"+this.height_+"px; line-height:"+(this.height_+this.anchor_[0])+"px;"):e.push("height:"+this.height_+"px; line-height:"+this.height_+"px;"),"number"==typeof this.anchor_[1]&&this.anchor_[1]>0&&this.anchor_[1]<this.width_?e.push("width:"+(this.width_-this.anchor_[1])+"px; padding-left:"+this.anchor_[1]+"px;"):e.push("width:"+this.width_+"px; text-align:center;")):e.push("height:"+this.height_+"px; line-height:"+this.height_+"px; width:"+this.width_+"px; text-align:center;");var s=this.textColor_?this.textColor_:"black",o=this.textSize_?this.textSize_:11;return e.push("cursor:pointer; top:"+t.y+"px; left:"+t.x+"px; color:"+s+"; position:absolute; font-size:"+o+"px; font-family:Arial,sans-serif; font-weight:bold"),e.join("")},window.MarkerClusterer=MarkerClusterer,MarkerClusterer.prototype.addMarker=MarkerClusterer.prototype.addMarker,MarkerClusterer.prototype.addMarkers=MarkerClusterer.prototype.addMarkers,MarkerClusterer.prototype.clearMarkers=MarkerClusterer.prototype.clearMarkers,MarkerClusterer.prototype.fitMapToMarkers=MarkerClusterer.prototype.fitMapToMarkers,MarkerClusterer.prototype.getCalculator=MarkerClusterer.prototype.getCalculator,MarkerClusterer.prototype.getGridSize=MarkerClusterer.prototype.getGridSize,MarkerClusterer.prototype.getExtendedBounds=MarkerClusterer.prototype.getExtendedBounds,MarkerClusterer.prototype.getMap=MarkerClusterer.prototype.getMap,MarkerClusterer.prototype.getMarkers=MarkerClusterer.prototype.getMarkers,MarkerClusterer.prototype.getMaxZoom=MarkerClusterer.prototype.getMaxZoom,MarkerClusterer.prototype.getStyles=MarkerClusterer.prototype.getStyles,MarkerClusterer.prototype.getTotalClusters=MarkerClusterer.prototype.getTotalClusters,MarkerClusterer.prototype.getTotalMarkers=MarkerClusterer.prototype.getTotalMarkers,MarkerClusterer.prototype.redraw=MarkerClusterer.prototype.redraw,MarkerClusterer.prototype.removeMarker=MarkerClusterer.prototype.removeMarker,MarkerClusterer.prototype.removeMarkers=MarkerClusterer.prototype.removeMarkers,MarkerClusterer.prototype.resetViewport=MarkerClusterer.prototype.resetViewport,MarkerClusterer.prototype.repaint=MarkerClusterer.prototype.repaint,MarkerClusterer.prototype.setCalculator=MarkerClusterer.prototype.setCalculator,MarkerClusterer.prototype.setGridSize=MarkerClusterer.prototype.setGridSize,MarkerClusterer.prototype.setMaxZoom=MarkerClusterer.prototype.setMaxZoom,MarkerClusterer.prototype.onAdd=MarkerClusterer.prototype.onAdd,MarkerClusterer.prototype.draw=MarkerClusterer.prototype.draw,Cluster.prototype.getCenter=Cluster.prototype.getCenter,Cluster.prototype.getSize=Cluster.prototype.getSize,Cluster.prototype.getMarkers=Cluster.prototype.getMarkers,ClusterIcon.prototype.onAdd=ClusterIcon.prototype.onAdd,ClusterIcon.prototype.draw=ClusterIcon.prototype.draw,ClusterIcon.prototype.onRemove=ClusterIcon.prototype.onRemove;;!function (a) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], a) : a("undefined" != typeof jQuery ? jQuery : window.Zepto)
}(function (a) {
    "use strict";

    function d(b) {
        var c = b.data;
        b.isDefaultPrevented() || (b.preventDefault(), a(b.target).ajaxSubmit(c))
    }

    function e(b) {
        var c = b.target, d = a(c);
        if (!d.is("[type=submit],[type=image]")) {
            var e = d.closest("[type=submit]");
            if (0 === e.length) return;
            c = e[0]
        }
        var f = this;
        if (f.clk = c, "image" == c.type) if (void 0 !== b.offsetX) f.clk_x = b.offsetX, f.clk_y = b.offsetY; else if ("function" == typeof a.fn.offset) {
            var g = d.offset();
            f.clk_x = b.pageX - g.left, f.clk_y = b.pageY - g.top
        } else f.clk_x = b.pageX - c.offsetLeft, f.clk_y = b.pageY - c.offsetTop;
        setTimeout(function () {
            f.clk = f.clk_x = f.clk_y = null
        }, 100)
    }

    function f() {
        if (a.fn.ajaxSubmit.debug) {
            var b = "[jquery.form] " + Array.prototype.join.call(arguments, "");
            window.console && window.console.log ? window.console.log(b) : window.opera && window.opera.postError && window.opera.postError(b)
        }
    }

    var b = {};
    b.fileapi = void 0 !== a("<input type='file'/>").get(0).files, b.formdata = void 0 !== window.FormData;
    var c = !!a.fn.prop;
    a.fn.attr2 = function () {
        if (!c) return this.attr.apply(this, arguments);
        var a = this.prop.apply(this, arguments);
        return a && a.jquery || "string" == typeof a ? a : this.attr.apply(this, arguments)
    }, a.fn.ajaxSubmit = function (d) {
        function B(b) {
            var g, h, c = a.param(b, d.traditional).split("&"), e = c.length, f = [];
            for (g = 0; e > g; g++) c[g] = c[g].replace(/\+/g, " "), h = c[g].split("="), f.push([decodeURIComponent(h[0]), decodeURIComponent(h[1])]);
            return f
        }

        function C(b) {
            for (var c = new FormData, f = 0; f < b.length; f++) c.append(b[f].name, b[f].value);
            if (d.extraData) {
                var g = B(d.extraData);
                for (f = 0; f < g.length; f++) g[f] && c.append(g[f][0], g[f][1])
            }
            d.data = null;
            var h = a.extend(!0, {}, a.ajaxSettings, d, {
                contentType: !1,
                processData: !1,
                cache: !1,
                type: e || "POST"
            });
            d.uploadProgress && (h.xhr = function () {
                var b = a.ajaxSettings.xhr();
                return b.upload && b.upload.addEventListener("progress", function (a) {
                    var b = 0, c = a.loaded || a.position, e = a.total;
                    a.lengthComputable && (b = Math.ceil(c / e * 100)), d.uploadProgress(a, c, e, b)
                }, !1), b
            }), h.data = null;
            var i = h.beforeSend;
            return h.beforeSend = function (a, b) {
                d.formData ? b.data = d.formData : b.data = c, i && i.call(this, a, b)
            }, a.ajax(h)
        }

        function D(b) {
            function y(a) {
                var b = null;
                try {
                    a.contentWindow && (b = a.contentWindow.document)
                } catch (c) {
                    f("cannot get iframe.contentWindow document: " + c)
                }
                if (b) return b;
                try {
                    b = a.contentDocument ? a.contentDocument : a.document
                } catch (c) {
                    f("cannot get iframe.contentDocument: " + c), b = a.document
                }
                return b
            }

            function B() {
                function j() {
                    try {
                        var a = y(p).readyState;
                        f("state = " + a), a && "uninitialized" == a.toLowerCase() && setTimeout(j, 50)
                    } catch (b) {
                        f("Server abort: ", b, " (", b.name, ")"), G(x), u && clearTimeout(u), u = void 0
                    }
                }

                var b = i.attr2("target"), c = i.attr2("action"), d = "multipart/form-data",
                    h = i.attr("enctype") || i.attr("encoding") || d;
                g.setAttribute("target", n), (!e || /post/i.test(e)) && g.setAttribute("method", "POST"), c != k.url && g.setAttribute("action", k.url), k.skipEncodingOverride || e && !/post/i.test(e) || i.attr({
                    encoding: "multipart/form-data",
                    enctype: "multipart/form-data"
                }), k.timeout && (u = setTimeout(function () {
                    t = !0, G(w)
                }, k.timeout));
                var l = [];
                try {
                    if (k.extraData) for (var m in k.extraData) k.extraData.hasOwnProperty(m) && (a.isPlainObject(k.extraData[m]) && k.extraData[m].hasOwnProperty("name") && k.extraData[m].hasOwnProperty("value") ? l.push(a('<input type="hidden" name="' + k.extraData[m].name + '">').val(k.extraData[m].value).appendTo(g)[0]) : l.push(a('<input type="hidden" name="' + m + '">').val(k.extraData[m]).appendTo(g)[0]));
                    k.iframeTarget || o.appendTo("body"), p.attachEvent ? p.attachEvent("onload", G) : p.addEventListener("load", G, !1), setTimeout(j, 15);
                    try {
                        g.submit()
                    } catch (q) {
                        var r = document.createElement("form").submit;
                        r.apply(g)
                    }
                } finally {
                    g.setAttribute("action", c), g.setAttribute("enctype", h), b ? g.setAttribute("target", b) : i.removeAttr("target"), a(l).remove()
                }
            }

            function G(b) {
                if (!q.aborted && !F) {
                    if (D = y(p), D || (f("cannot access response document"), b = x), b === w && q) return q.abort("timeout"), void v.reject(q, "timeout");
                    if (b == x && q) return q.abort("server abort"), void v.reject(q, "error", "server abort");
                    if (D && D.location.href != k.iframeSrc || t) {
                        p.detachEvent ? p.detachEvent("onload", G) : p.removeEventListener("load", G, !1);
                        var d, c = "success";
                        try {
                            if (t) throw"timeout";
                            var e = "xml" == k.dataType || D.XMLDocument || a.isXMLDoc(D);
                            if (f("isXml=" + e), !e && window.opera && (null === D.body || !D.body.innerHTML) && --E) return f("requeing onLoad callback, DOM not available"), void setTimeout(G, 250);
                            var g = D.body ? D.body : D.documentElement;
                            q.responseText = g ? g.innerHTML : null, q.responseXML = D.XMLDocument ? D.XMLDocument : D, e && (k.dataType = "xml"), q.getResponseHeader = function (a) {
                                var b = {"content-type": k.dataType};
                                return b[a.toLowerCase()]
                            }, g && (q.status = Number(g.getAttribute("status")) || q.status, q.statusText = g.getAttribute("statusText") || q.statusText);
                            var h = (k.dataType || "").toLowerCase(), i = /(json|script|text)/.test(h);
                            if (i || k.textarea) {
                                var j = D.getElementsByTagName("textarea")[0];
                                if (j) q.responseText = j.value, q.status = Number(j.getAttribute("status")) || q.status, q.statusText = j.getAttribute("statusText") || q.statusText; else if (i) {
                                    var l = D.getElementsByTagName("pre")[0], n = D.getElementsByTagName("body")[0];
                                    l ? q.responseText = l.textContent ? l.textContent : l.innerText : n && (q.responseText = n.textContent ? n.textContent : n.innerText)
                                }
                            } else "xml" == h && !q.responseXML && q.responseText && (q.responseXML = H(q.responseText));
                            try {
                                C = J(q, h, k)
                            } catch (r) {
                                c = "parsererror", q.error = d = r || c
                            }
                        } catch (r) {
                            f("error caught: ", r), c = "error", q.error = d = r || c
                        }
                        q.aborted && (f("upload aborted"), c = null), q.status && (c = q.status >= 200 && q.status < 300 || 304 === q.status ? "success" : "error"), "success" === c ? (k.success && k.success.call(k.context, C, "success", q), v.resolve(q.responseText, "success", q), m && a.event.trigger("ajaxSuccess", [q, k])) : c && (void 0 === d && (d = q.statusText), k.error && k.error.call(k.context, q, c, d), v.reject(q, "error", d), m && a.event.trigger("ajaxError", [q, k, d])), m && a.event.trigger("ajaxComplete", [q, k]), m && !--a.active && a.event.trigger("ajaxStop"), k.complete && k.complete.call(k.context, q, c), F = !0, k.timeout && clearTimeout(u), setTimeout(function () {
                            k.iframeTarget ? o.attr("src", k.iframeSrc) : o.remove(), q.responseXML = null
                        }, 100)
                    }
                }
            }

            var h, j, k, m, n, o, p, q, r, s, t, u, g = i[0], v = a.Deferred();
            if (v.abort = function (a) {
                    q.abort(a)
                }, b) for (j = 0; j < l.length; j++) h = a(l[j]), c ? h.prop("disabled", !1) : h.removeAttr("disabled");
            if (k = a.extend(!0, {}, a.ajaxSettings, d), k.context = k.context || k, n = "jqFormIO" + (new Date).getTime(), k.iframeTarget ? (o = a(k.iframeTarget), s = o.attr2("name"), s ? n = s : o.attr2("name", n)) : (o = a('<iframe name="' + n + '" src="' + k.iframeSrc + '" />'), o.css({
                    position: "absolute",
                    top: "-1000px",
                    left: "-1000px"
                })), p = o[0], q = {
                    aborted: 0,
                    responseText: null,
                    responseXML: null,
                    status: 0,
                    statusText: "n/a",
                    getAllResponseHeaders: function () {
                    },
                    getResponseHeader: function () {
                    },
                    setRequestHeader: function () {
                    },
                    abort: function (b) {
                        var c = "timeout" === b ? "timeout" : "aborted";
                        f("aborting upload... " + c), this.aborted = 1;
                        try {
                            p.contentWindow.document.execCommand && p.contentWindow.document.execCommand("Stop")
                        } catch (d) {
                        }
                        o.attr("src", k.iframeSrc), q.error = c, k.error && k.error.call(k.context, q, c, b), m && a.event.trigger("ajaxError", [q, k, c]), k.complete && k.complete.call(k.context, q, c)
                    }
                }, m = k.global, m && 0 === a.active++ && a.event.trigger("ajaxStart"), m && a.event.trigger("ajaxSend", [q, k]), k.beforeSend && k.beforeSend.call(k.context, q, k) === !1) return k.global && a.active--, v.reject(), v;
            if (q.aborted) return v.reject(), v;
            r = g.clk, r && (s = r.name, s && !r.disabled && (k.extraData = k.extraData || {}, k.extraData[s] = r.value, "image" == r.type && (k.extraData[s + ".x"] = g.clk_x, k.extraData[s + ".y"] = g.clk_y)));
            var w = 1, x = 2, z = a("meta[name=csrf-token]").attr("content"),
                A = a("meta[name=csrf-param]").attr("content");
            A && z && (k.extraData = k.extraData || {}, k.extraData[A] = z), k.forceSync ? B() : setTimeout(B, 10);
            var C, D, F, E = 50, H = a.parseXML || function (a, b) {
                return window.ActiveXObject ? (b = new ActiveXObject("Microsoft.XMLDOM"), b.async = "false", b.loadXML(a)) : b = (new DOMParser).parseFromString(a, "text/xml"), b && b.documentElement && "parsererror" != b.documentElement.nodeName ? b : null
            }, I = a.parseJSON || function (a) {
                return window.eval("(" + a + ")")
            }, J = function (b, c, d) {
                var e = b.getResponseHeader("content-type") || "", f = "xml" === c || !c && e.indexOf("xml") >= 0,
                    g = f ? b.responseXML : b.responseText;
                return f && "parsererror" === g.documentElement.nodeName && a.error && a.error("parsererror"), d && d.dataFilter && (g = d.dataFilter(g, c)), "string" == typeof g && ("json" === c || !c && e.indexOf("json") >= 0 ? g = I(g) : ("script" === c || !c && e.indexOf("javascript") >= 0) && a.globalEval(g)), g
            };
            return v
        }

        if (!this.length) return f("ajaxSubmit: skipping submit process - no element selected"), this;
        var e, g, h, i = this;
        "function" == typeof d ? d = {success: d} : void 0 === d && (d = {}), e = d.type || this.attr2("method"), g = d.url || this.attr2("action"), h = "string" == typeof g ? a.trim(g) : "", h = h || window.location.href || "", h && (h = (h.match(/^([^#]+)/) || [])[1]), d = a.extend(!0, {
            url: h,
            success: a.ajaxSettings.success,
            type: e || a.ajaxSettings.type,
            iframeSrc: /^https/i.test(window.location.href || "") ? "javascript:false" : "about:blank"
        }, d);
        var j = {};
        if (this.trigger("form-pre-serialize", [this, d, j]), j.veto) return f("ajaxSubmit: submit vetoed via form-pre-serialize trigger"), this;
        if (d.beforeSerialize && d.beforeSerialize(this, d) === !1) return f("ajaxSubmit: submit aborted via beforeSerialize callback"), this;
        var k = d.traditional;
        void 0 === k && (k = a.ajaxSettings.traditional);
        var m, l = [], n = this.formToArray(d.semantic, l);
        if (d.data && (d.extraData = d.data, m = a.param(d.data, k)), d.beforeSubmit && d.beforeSubmit(n, this, d) === !1) return f("ajaxSubmit: submit aborted via beforeSubmit callback"), this;
        if (this.trigger("form-submit-validate", [n, this, d, j]), j.veto) return f("ajaxSubmit: submit vetoed via form-submit-validate trigger"), this;
        var o = a.param(n, k);
        m && (o = o ? o + "&" + m : m), "GET" == d.type.toUpperCase() ? (d.url += (d.url.indexOf("?") >= 0 ? "&" : "?") + o, d.data = null) : d.data = o;
        var p = [];
        if (d.resetForm && p.push(function () {
                i.resetForm()
            }), d.clearForm && p.push(function () {
                i.clearForm(d.includeHidden)
            }), !d.dataType && d.target) {
            var q = d.success || function () {
            };
            p.push(function (b) {
                var c = d.replaceTarget ? "replaceWith" : "html";
                a(d.target)[c](b).each(q, arguments)
            })
        } else d.success && p.push(d.success);
        if (d.success = function (a, b, c) {
                for (var e = d.context || this, f = 0, g = p.length; g > f; f++) p[f].apply(e, [a, b, c || i, i])
            }, d.error) {
            var r = d.error;
            d.error = function (a, b, c) {
                var e = d.context || this;
                r.apply(e, [a, b, c, i])
            }
        }
        if (d.complete) {
            var s = d.complete;
            d.complete = function (a, b) {
                var c = d.context || this;
                s.apply(c, [a, b, i])
            }
        }
        var t = a("input[type=file]:enabled", this).filter(function () {
                return "" !== a(this).val()
            }), u = t.length > 0, v = "multipart/form-data", w = i.attr("enctype") == v || i.attr("encoding") == v,
            x = b.fileapi && b.formdata;
        f("fileAPI :" + x);
        var z, y = (u || w) && !x;
        d.iframe !== !1 && (d.iframe || y) ? d.closeKeepAlive ? a.get(d.closeKeepAlive, function () {
            z = D(n)
        }) : z = D(n) : z = (u || w) && x ? C(n) : a.ajax(d), i.removeData("jqxhr").data("jqxhr", z);
        for (var A = 0; A < l.length; A++) l[A] = null;
        return this.trigger("form-submit-notify", [this, d]), this
    }, a.fn.ajaxForm = function (b) {
        if (b = b || {}, b.delegation = b.delegation && a.isFunction(a.fn.on), !b.delegation && 0 === this.length) {
            var c = {s: this.selector, c: this.context};
            return !a.isReady && c.s ? (f("DOM not ready, queuing ajaxForm"), a(function () {
                a(c.s, c.c).ajaxForm(b)
            }), this) : (f("terminating; zero elements found by selector" + (a.isReady ? "" : " (DOM not ready)")), this)
        }
        return b.delegation ? (a(document).off("submit.form-plugin", this.selector, d).off("click.form-plugin", this.selector, e).on("submit.form-plugin", this.selector, b, d).on("click.form-plugin", this.selector, b, e), this) : this.ajaxFormUnbind().bind("submit.form-plugin", b, d).bind("click.form-plugin", b, e)
    }, a.fn.ajaxFormUnbind = function () {
        return this.unbind("submit.form-plugin click.form-plugin")
    }, a.fn.formToArray = function (c, d) {
        var e = [];
        if (0 === this.length) return e;
        var i, f = this[0], g = this.attr("id"), h = c ? f.getElementsByTagName("*") : f.elements;
        if (h && !/MSIE [678]/.test(navigator.userAgent) && (h = a(h).get()), g && (i = a(':input[form="' + g + '"]').get(), i.length && (h = (h || []).concat(i))), !h || !h.length) return e;
        var j, k, l, m, n, o, p;
        for (j = 0, o = h.length; o > j; j++) if (n = h[j], l = n.name, l && !n.disabled) if (c && f.clk && "image" == n.type) f.clk == n && (e.push({
            name: l,
            value: a(n).val(),
            type: n.type
        }), e.push({name: l + ".x", value: f.clk_x}, {
            name: l + ".y",
            value: f.clk_y
        })); else if (m = a.fieldValue(n, !0), m && m.constructor == Array) for (d && d.push(n), k = 0, p = m.length; p > k; k++) e.push({
            name: l,
            value: m[k]
        }); else if (b.fileapi && "file" == n.type) {
            d && d.push(n);
            var q = n.files;
            if (q.length) for (k = 0; k < q.length; k++) e.push({
                name: l,
                value: q[k],
                type: n.type
            }); else e.push({name: l, value: "", type: n.type})
        } else null !== m && "undefined" != typeof m && (d && d.push(n), e.push({
            name: l,
            value: m,
            type: n.type,
            required: n.required
        }));
        if (!c && f.clk) {
            var r = a(f.clk), s = r[0];
            l = s.name, l && !s.disabled && "image" == s.type && (e.push({
                name: l,
                value: r.val()
            }), e.push({name: l + ".x", value: f.clk_x}, {name: l + ".y", value: f.clk_y}))
        }
        return e
    }, a.fn.formSerialize = function (b) {
        return a.param(this.formToArray(b))
    }, a.fn.fieldSerialize = function (b) {
        var c = [];
        return this.each(function () {
            var d = this.name;
            if (d) {
                var e = a.fieldValue(this, b);
                if (e && e.constructor == Array) for (var f = 0, g = e.length; g > f; f++) c.push({
                    name: d,
                    value: e[f]
                }); else null !== e && "undefined" != typeof e && c.push({name: this.name, value: e})
            }
        }), a.param(c)
    }, a.fn.fieldValue = function (b) {
        for (var c = [], d = 0, e = this.length; e > d; d++) {
            var f = this[d], g = a.fieldValue(f, b);
            null === g || "undefined" == typeof g || g.constructor == Array && !g.length || (g.constructor == Array ? a.merge(c, g) : c.push(g))
        }
        return c
    }, a.fieldValue = function (b, c) {
        var d = b.name, e = b.type, f = b.tagName.toLowerCase();
        if (void 0 === c && (c = !0), c && (!d || b.disabled || "reset" == e || "button" == e || ("checkbox" == e || "radio" == e) && !b.checked || ("submit" == e || "image" == e) && b.form && b.form.clk != b || "select" == f && -1 == b.selectedIndex)) return null;
        if ("select" == f) {
            var g = b.selectedIndex;
            if (0 > g) return null;
            for (var h = [], i = b.options, j = "select-one" == e, k = j ? g + 1 : i.length, l = j ? g : 0; k > l; l++) {
                var m = i[l];
                if (m.selected) {
                    var n = m.value;
                    if (n || (n = m.attributes && m.attributes.value && !m.attributes.value.specified ? m.text : m.value), j) return n;
                    h.push(n)
                }
            }
            return h
        }
        return a(b).val()
    }, a.fn.clearForm = function (b) {
        return this.each(function () {
            a("input,select,textarea", this).clearFields(b)
        })
    }, a.fn.clearFields = a.fn.clearInputs = function (b) {
        var c = /^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;
        return this.each(function () {
            var d = this.type, e = this.tagName.toLowerCase();
            c.test(d) || "textarea" == e ? this.value = "" : "checkbox" == d || "radio" == d ? this.checked = !1 : "select" == e ? this.selectedIndex = -1 : "file" == d ? /MSIE/.test(navigator.userAgent) ? a(this).replaceWith(a(this).clone(!0)) : a(this).val("") : b && (b === !0 && /hidden/.test(d) || "string" == typeof b && a(this).is(b)) && (this.value = "")
        })
    }, a.fn.resetForm = function () {
        return this.each(function () {
            ("function" == typeof this.reset || "object" == typeof this.reset && !this.reset.nodeType) && this.reset()
        })
    }, a.fn.enable = function (a) {
        return void 0 === a && (a = !0), this.each(function () {
            this.disabled = !a
        })
    }, a.fn.selected = function (b) {
        return void 0 === b && (b = !0), this.each(function () {
            var c = this.type;
            if ("checkbox" == c || "radio" == c) this.checked = b; else if ("option" == this.tagName.toLowerCase()) {
                var d = a(this).parent("select");
                b && d[0] && "select-one" == d[0].type && d.find("option").selected(!1), this.selected = b
            }
        })
    }, a.fn.ajaxSubmit.debug = !1
});;!function(e){function t(e,t,r){var n=e[0],o=/er/.test(r)?_indeterminate:/bl/.test(r)?f:_,s=r==_update?{checked:n[_],disabled:n[f],indeterminate:"true"==e.attr(_indeterminate)||"false"==e.attr(_determinate)}:n[o];if(/^(ch|di|in)/.test(r)&&!s)i(e,o);else if(/^(un|en|de)/.test(r)&&s)a(e,o);else if(r==_update)for(var d in s)s[d]?i(e,d,!0):a(e,d,!0);else t&&"toggle"!=r||(t||e[_callback]("ifClicked"),s?n[_type]!==u&&a(e,o):i(e,o))}function i(t,i,r){var l=t[0],h=t.parent(),b=i==_,m=i==_indeterminate,v=i==f,y=m?_determinate:b?p:"enabled",k=n(t,y+o(l[_type])),g=n(t,i+o(l[_type]));if(l[i]!==!0){if(!r&&i==_&&l[_type]==u&&l.name){var C=t.closest("form"),w='input[name="'+l.name+'"]';w=C.length?C.find(w):e(w),w.each(function(){this!==l&&e(this).data(d)&&a(e(this),i)})}m?(l[i]=!0,l[_]&&a(t,_,"force")):(r||(l[i]=!0),b&&l[_indeterminate]&&a(t,_indeterminate,!1)),s(t,b,i,r)}l[f]&&n(t,_cursor,!0)&&h.find("."+c).css(_cursor,"default"),h[_add](g||n(t,i)||""),h.attr("role")&&!m&&h.attr("aria-"+(v?f:_),"true"),h[_remove](k||n(t,y)||"")}function a(e,t,i){var a=e[0],r=e.parent(),d=t==_,l=t==_indeterminate,u=t==f,h=l?_determinate:d?p:"enabled",b=n(e,h+o(a[_type])),m=n(e,t+o(a[_type]));a[t]!==!1&&((l||!i||"force"==i)&&(a[t]=!1),s(e,d,h,i)),!a[f]&&n(e,_cursor,!0)&&r.find("."+c).css(_cursor,"pointer"),r[_remove](m||n(e,t)||""),r.attr("role")&&!l&&r.attr("aria-"+(u?f:_),"false"),r[_add](b||n(e,h)||"")}function r(t,i){t.data(d)&&(t.parent().html(t.attr("style",t.data(d).s||"")),i&&t[_callback](i),t.off(".i").unwrap(),e(_label+'[for="'+t[0].id+'"]').add(t.closest(_label)).off(".i"))}function n(e,t,i){return e.data(d)?e.data(d).o[t+(i?"":"Class")]:void 0}function o(e){return e.charAt(0).toUpperCase()+e.slice(1)}function s(e,t,i,a){a||(t&&e[_callback]("ifToggled"),e[_callback]("ifChanged")[_callback]("if"+o(i)))}var d="iCheck",c=d+"-helper",l="checkbox",u="radio",_="checked",p="un"+_,f="disabled";_determinate="determinate",_indeterminate="in"+_determinate,_update="update",_type="type",_click="click",_touch="touchbegin.i touchend.i",_add="addClass",_remove="removeClass",_callback="trigger",_label="label",_cursor="cursor",_mobile=/ipad|iphone|ipod|android|blackberry|windows phone|opera mini|silk/i.test(navigator.userAgent),e.fn[d]=function(n,o){var s='input[type="'+l+'"], input[type="'+u+'"]',p=e(),h=function(t){t.each(function(){var t=e(this);p=t.is(s)?p.add(t):p.add(t.find(s))})};if(/^(check|uncheck|toggle|indeterminate|determinate|disable|enable|update|destroy)$/i.test(n))return n=n.toLowerCase(),h(this),p.each(function(){var i=e(this);"destroy"==n?r(i,"ifDestroyed"):t(i,!0,n),e.isFunction(o)&&o()});if("object"!=typeof n&&n)return this;var b=e.extend({checkedClass:_,disabledClass:f,indeterminateClass:_indeterminate,labelHover:!0},n),m=b.handle,v=b.hoverClass||"hover",y=b.focusClass||"focus",k=b.activeClass||"active",g=!!b.labelHover,C=b.labelHoverClass||"hover",w=0|(""+b.increaseArea).replace("%","");return(m==l||m==u)&&(s='input[type="'+m+'"]'),-50>w&&(w=-50),h(this),p.each(function(){var n=e(this);r(n);var o,s=this,p=s.id,h=-w+"%",m=100+2*w+"%",x={position:"absolute",top:h,left:h,display:"block",width:m,height:m,margin:0,padding:0,background:"#fff",border:0,opacity:0},A=_mobile?{position:"absolute",visibility:"hidden"}:w?x:{position:"absolute",opacity:0},H=s[_type]==l?b.checkboxClass||"i"+l:b.radioClass||"i"+u,j=e(_label+'[for="'+p+'"]').add(n.closest(_label)),D=!!b.aria,P=d+"-"+Math.random().toString(36).substr(2,6),T='<div class="'+H+'" '+(D?'role="'+s[_type]+'" ':"");D&&j.each(function(){T+='aria-labelledby="',this.id?T+=this.id:(this.id=P,T+=P),T+='"'}),T=n.wrap(T+"/>")[_callback]("ifCreated").parent().append(b.insert),o=e('<ins class="'+c+'"/>').css(x).appendTo(T),n.data(d,{o:b,s:n.attr("style")}).css(A),!!b.inheritClass&&T[_add](s.className||""),!!b.inheritID&&p&&T.attr("id",d+"-"+p),"static"==T.css("position")&&T.css("position","relative"),t(n,!0,_update),j.length&&j.on(_click+".i mouseover.i mouseout.i "+_touch,function(i){var a=i[_type],r=e(this);if(!s[f]){if(a==_click){if(e(i.target).is("a"))return;t(n,!1,!0)}else g&&(/ut|nd/.test(a)?(T[_remove](v),r[_remove](C)):(T[_add](v),r[_add](C)));if(!_mobile)return!1;i.stopPropagation()}}),n.on(_click+".i focus.i blur.i keyup.i keydown.i keypress.i",function(e){var t=e[_type],r=e.keyCode;return t==_click?!1:"keydown"==t&&32==r?(s[_type]==u&&s[_]||(s[_]?a(n,_):i(n,_)),!1):void("keyup"==t&&s[_type]==u?!s[_]&&i(n,_):/us|ur/.test(t)&&T["blur"==t?_remove:_add](y))}),o.on(_click+" mousedown mouseup mouseover mouseout "+_touch,function(e){var i=e[_type],a=/wn|up/.test(i)?k:v;if(!s[f]){if(i==_click?t(n,!1,!0):(/wn|er|in/.test(i)?T[_add](a):T[_remove](a+" "+k),j.length&&g&&a==v&&j[/ut|nd/.test(i)?_remove:_add](C)),!_mobile)return!1;e.stopPropagation()}})})}}(window.jQuery||window.Zepto);;(function ($) {
    $(document).ready(function () {
        var $window = $(window);
        $('#btn-booking-now').click(function () {
            $("html, body").animate({scrollTop: $('#hotel-room-box').offset().top}, 1000);
        });

        checkWidth();
        $(window).resize(checkWidth);

        function checkWidth() {
            if ($('#hotel-room-box').length) {
                var windowsize = $window.width();
                if (windowsize < 992) {
                    $(window).scroll(function () {
                        if ($(this).scrollTop() > ($('#hotel-room-box').offset().top - ($('#hotel-room-box').height()))) {
                            $('#btn-booking-now').fadeOut();
                        } else {
                            $('#btn-booking-now').fadeIn();
                        }
                    });
                }
            }
        }

        if ($('.mega-menu').length > 0) {
            $('.mega-menu').each(function (e) {
                if ($(this).find('.current-menu-item').length !== 0) {
                    $(this).parent().addClass('current-menu-ancestor');
                }
            })
        }

        /* Contact form author page*/
        $('.author-contact-form').submit(function (e) {
            e.preventDefault();
            var t = $(this);
            var check = true;
            var data = t.serializeArray();
            t.find('input[type="text"], textarea').removeClass('error');
            t.find('input[type="text"], textarea').each(function () {
                if ($(this).val() == '') {
                    check = false;
                    $(this).addClass('error');
                }
            })
            var checkEmail = ValidateEmail(data[2]['value']);
            if (!check || !checkEmail) {
                if (!checkEmail && data[2]['value'] != '') {
                    t.find('input[name="au_email"]').addClass('error');
                    if (data[0]['value'] == '' || data[3]['value'] == '') {
                        t.find('#author-message').html('<div class="alert alert-danger">' + st_checkout_text.validate_form + '<br />' + st_checkout_text.email_validate + '</div>');
                    } else {
                        t.find('#author-message').html('<div class="alert alert-danger">' + st_checkout_text.email_validate + '</div>');
                    }
                } else {
                    t.find('#author-message').html('<div class="alert alert-danger">' + st_checkout_text.validate_form + '</div>');
                }
            } else {
                t.find('#author-message').empty();
                t.find('input[type="submit"]').attr('disabled', 'disabled');
                t.find('i.fa-spin').show();
                $.ajax({
                    url: st_params.ajax_url,
                    dataType: 'json',
                    type: 'post',
                    data: {
                        action: 'st_author_contact',
                        data: data,
                    },
                    success: function (doc) {
                        if (doc.status == true) {
                            t.find('#author-message').html('<div class="alert alert-success">' + doc.message + '</div>');
                        } else {
                            t.find('#author-message').html('<div class="alert alert-danger">' + doc.message + '</div>');
                        }
                        t.find('i.fa-spin').hide();
                        t.find('input[type="submit"]').removeAttr('disabled', 'disabled');
                    },
                    complete: function () {
                    }
                });
            }
        })

        function ValidateEmail(mail) {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
                return (true)
            }
            return (false)
        }

        $('#author-write-review-form').submit(function (e) {
            e.preventDefault();
            var t = $(this);

            //var data = t.serializeArray();
            t.find('input[type="text"], textarea').removeClass('error');
            var check = true;
            t.find('input[type="text"], textarea').each(function () {
                if ($(this).val() == '') {
                    check = false;
                    $(this).addClass('error');
                }
            });
            if (!check) {
                t.find('#author-wreview-message').html('<div class="alert alert-danger">' + st_checkout_text.validate_form + '</div>');
            } else {
                var arr_star = [];
                /*t.find("input[name='au_review_star[]']").each(function () {
                    arr_star.push($(this).data('title') + '|' + $(this).val());
                });*/
                var values = $("input[name='au_review_star[]']")
                    .map(function () {
                        return $(this).data('title') + '|' + $(this).val();
                    }).get();

                t.find('#author-wreview-message').empty();
                t.find('i.fa-spin').show();
                $.ajax({
                    url: st_params.ajax_url,
                    dataType: 'json',
                    type: 'post',
                    data: {
                        action: 'st_author_write_review',
                        title: t.find('input[name="au_review_title"]').val(),
                        content: t.find('textarea[name="au_review_content"]').val(),
                        user_id: t.find('input[name="user_id"]').val(),
                        partner_id: t.find('input[name="partner_id"]').val(),
                        star: JSON.stringify(values),
                    },
                    success: function (doc) {
                        if (doc.status == true) {
                            t.find('#author-wreview-message').html('<div class="alert alert-success">' + doc.message + '</div>');
                        }
                        t.find('i.fa-spin').hide();
                        t.find('input[type="submit"]').removeAttr('disabled', 'disabled');
                    },
                    complete: function () {
                    }
                });
            }


        });


        /**
         * Friendly select
         * Nếu focus vào input text kiểm tra sụ kiện
         * Nếu List location mà có length > 0 thì bắt đầu bắt sự kiện dùng phím để select + phím enter
         */
        /*$('#field-rental-locationid').focusin(function(){
            if($('.st-option-wrapper').length > 0){
                console.log('Focus');
                var li = $('.st-option-wrapper .option');
                var liSelected;
                $(window).keydown(function(e){
                    if(e.which === 40){
                        if(liSelected){
                            liSelected.removeClass('active');
                            next = liSelected.next();
                            if(next.length > 0){
                                liSelected = next.addClass('active');
                            }else{
                                liSelected = $('.st-option-wrapper .option').eq(0).addClass('active');
                            }
                        }else{
                            liSelected = $('.st-option-wrapper .option').eq(0).addClass('active');
                        }
                    }else if(e.which === 38){
                        if(liSelected){
                            liSelected.removeClass('active');
                            next = liSelected.prev();
                            if(next.length > 0){
                                liSelected = next.addClass('active');
                            }else{
                                liSelected = $('.st-option-wrapper .option').last().addClass('active');
                            }
                        }else{
                            liSelected = $('.st-option-wrapper .option').last().addClass('active');
                        }
                    }

                });
            }

        });
        $("#field-rental-locationid").on('keyup', function (e) {
            if (e.keyCode == 13) {
                console.log('ENTER111');
                $('.option-wrapper').html('').hide();
                $('#field-rental-checkin').focus();
            }
        });*/
    });
    $(document).on('show','.accordion', function (e) {
        //$('.accordion-heading i').toggleClass(' ');
        alert('OK');
        $(e.target).prev('.accordion-heading').addClass('accordion-opened');
    });

    $(document).on('hide','.accordion', function (e) {
        $(this).find('.accordion-heading').not($(e.target)).removeClass('accordion-opened');
        //$('.accordion-heading i').toggleClass('fa-chevron-right fa-chevron-down');
    });

    var body = $('body');
    var flag = false;
    body.on('click', '#save_ical', function(event){
        event.preventDefault();
        var parent = $(this).parent(),
            t = $(this),
            spinner = $('.spinner-import', parent),
            message = $('.form-message', parent);
        if(flag){
            return false;
        }
        flag = true;
        spinner.show();
        var data = {
            'action' : 'st_import_ical',
            'url' : $('input.ical_input', parent).val(),
            'post_id' : $('input[name="post_id"]', parent).val()
        };

        $.post(st_params.ajax_url, data, function(respon){
            if(typeof respon === 'object'){
                message.html(respon.message);
            }
            flag = false;
            spinner.hide();
        },'json');
    });

    // Tour package
    $(document).on('click', 'a[href="#package_tab"]', function () {
        var t = $(this);
        var parent = $(this).closest('.tabs_partner');
        var parentType = $('.stour-package');

        var locations = [];
        $('.list-location-wrapper .item', parent).each(function () {
            var me = $(this);
            if (me.find('input').is(':checked')) {
                locations.push(me.find('input').val());
            }
        });

        var address = $('input[name="address"]', parent).val();

        if (locations.length == 0 && address == '') {
            $('.form-message', parentType).html('<div class="alert alert-danger">' + $('#stour-no-location').val() + '</div>');
        } else {
            $('.form-message', parentType).html('');
        }
    });

    $(document).on('click', '.tour-package-load-hotel', function (e) {
        e.preventDefault();

        var t = $(this);
        var parent = t.closest('.add_service_step_wraps');
        var parentType = t.closest('.stour-tab-content');
        var parentBox = t.closest('.stour-package');

        var locations = [];
        $('.list-location-wrapper .item', parent).each(function () {
            var me = $(this);
            if (me.find('input').is(':checked')) {
                locations.push(me.find('input').val());
            }
        });

        var address = $('input[name="address"]', parent).val();

        parentBox.find('.overlay-form').show();
        $('.form-message', parentBox).html('');

        $.ajax({
            url: st_params.ajax_url,
            dataType: 'json',
            type: 'post',
            data: {
                action: 'st_load_hotel_tour_package',
                locations: locations.toString(),
                address: address,
                post_id: t.data('post-id'),
                post_type: t.data('type')
            },
            success: function (respond) {
                if (respond.status == false) {
                    $('.form-message', parentBox).html('<div class="alert alert-danger">' + respond.message + '</div>');
                } else {
                    $('.form-message', parentBox).html('<div class="alert alert-success">' + respond.message + '</div>');
                    $('.list-content', parentType).html(respond.content);
                }
                parentBox.find('.overlay-form').hide();
            },
            error: function (e) {
                console.log('Can not get the availability slot. Lost connect with your sever');
            }
        });
    });

    if($('.stour-list-hotel').length) {
        $(document).on('click', '#cb-select-all-1', function (e) {
            var t = $(this);
            var parent = $(this).closest('.stour-list-hotel');
            parent.find('input:checkbox').not(this).prop('checked', this.checked);
        });
        $(document).on('click', '.stour-list-hotel .cb-select-child1', function (e) {
            var t = $(this);
            var parent = $(this).closest('.stour-list-hotel');
            parent.find('input#cb-select-all-1').prop('checked', false);
            var check = 0;
            $('.stour-list-hotel .cb-select-child1').each(function (e) {
                if (!$(this).is(":checked")) {
                    check++;
                }
            });
            if (check == 0) {
                parent.find('input#cb-select-all-1').prop('checked', true);
            }
        });
    }

    $(document).on('click', '#tour-package-save-hotel', function (e) {
        e.preventDefault();
        var t = $(this);
        var table = $('.stour-list-hotel');
        var data = {};
        var data_activity = {};
        var data_car = {};
        var data_flight = {};

        table.each(function (index) {
            var i = 0;
            var me = $(this);
            var type = me.data('type');
            if(type == 'hotel') {
                me.find('.the-list tr').each(function () {
                    var item = $(this);
                    if ($('input[type="checkbox"]', item).is(':checked')) {
                        data[i] = {
                            'hotel_id': $('input[type="checkbox"]', item).data('id'),
                            'hotel_price': $('input[type="text"]', item).val()
                        };
                        i++;
                    }
                });
            }
            if(type == 'activity') {
                me.find('.the-list tr').each(function () {
                    var item = $(this);
                    if ($('input[type="checkbox"]', item).is(':checked')) {
                        data_activity[i] = {
                            'activity_id': $('input[type="checkbox"]', item).data('id'),
                            'activity_price': $('input[type="text"]', item).val()
                        };
                        i++;
                    }
                });
            }
            if(type == 'car') {
                me.find('.the-list tr').each(function () {
                    var item = $(this);
                    if ($('input[type="checkbox"]', item).is(':checked')) {
                        data_car[i] = {
                            'car_id': $('input[type="checkbox"]', item).data('id'),
                            'car_price': $('input[type="text"]', item).val(),
                            'car_quantity': $('input[type="number"]', item).val(),
                        };
                        i++;
                    }
                });
            }
            if(type == 'flight'){
                me.find('.the-list tr').each(function () {
                    var item = $(this);
                    if ($('input[type="checkbox"]', item).is(':checked')) {
                        data_flight[i] = {
                            'flight_id': $('input[type="checkbox"]', item).data('id'),
                            'flight_price_economy': $('input.price-economy[type="text"]', item).val(),
                            'flight_price_business': $('input.price-business[type="text"]', item).val(),
                        };
                        i++;
                    }
                });
            }
        });

        //Data custom
        var table_custom = $('.stour-list-custom-hotel');
        var data_custom = {};
        var data_custom_car = {};
        var data_custom_activity = {};
        var data_custom_flight = {};
        table_custom.each(function(index){
            var me = $(this);
            var type = me.data('type');
            if(type == 'hotel'){
                var j = 0;
                me.find('tbody tr').not('.parent-row').each(function () {
                    var item_custom = $(this);
                    data_custom[j] = {
                        'hotel_name': $('input.hotel-name', item_custom).val(),
                        'hotel_star': $('input.hotel-star', item_custom).val(),
                        'hotel_price': $('input.hotel-price', item_custom).val(),
                    };
                    j++;
                });
            }
            if(type == 'activity'){
                var j = 0;
                me.find('tbody tr').not('.parent-row').each(function () {
                    var item_custom = $(this);
                    data_custom_activity[j] = {
                        'activity_name': $('input.activity-name', item_custom).val(),
                        'activity_price': $('input.activity-price', item_custom).val(),
                    };
                    j++;
                });
            }
            if(type == 'car'){
                var j = 0;
                me.find('tbody tr').not('.parent-row').each(function () {
                    var item_custom = $(this);
                    data_custom_car[j] = {
                        'car_name': $('input.car-name', item_custom).val(),
                        'car_price': $('input.car-price', item_custom).val(),
                        'car_quantity': $('input.car-quantity', item_custom).val(),
                    };
                    j++;
                });
            }
            if(type == 'flight'){
                var j = 0;
                me.find('tbody tr').not('.parent-row').each(function () {
                    var item_custom = $(this);
                    data_custom_flight[j] = {
                        'flight_origin': $('input.flight-origin', item_custom).val(),
                        'flight_destination': $('input.flight-destination', item_custom).val(),
                        'flight_departure_time': $('input.flight-depature-time', item_custom).val(),
                        'flight_duration': $('input.flight-duration', item_custom).val(),
                        'flight_price_economy': $('input.flight-price-economy', item_custom).val(),
                        'flight_price_business': $('input.flight-price-business', item_custom).val(),
                    };
                    j++;
                });
            }
        });

        var parentType = $('.stour-package');
        var boxList = $('#stour-list-hotel', parentType);
        boxList.find('.overlay-form').show();
        $('.form-message', parentType).html('');

        $.ajax({
            url: st_params.ajax_url,
            dataType: 'json',
            type: 'post',
            data: {
                action: 'st_save_hotel_tour_package',
                tour_package: JSON.stringify(data),
                tour_package_car: JSON.stringify(data_car),
                tour_package_activity: JSON.stringify(data_activity),
                tour_package_flight: JSON.stringify(data_flight),
                tour_package_custom: JSON.stringify(data_custom),
                tour_package_custom_car: JSON.stringify(data_custom_car),
                tour_package_custom_activity: JSON.stringify(data_custom_activity),
                tour_package_custom_flight: JSON.stringify(data_custom_flight),
                post_id: t.data('post-id')
            },
            success: function (respond) {
                if (respond.status == false) {
                    $('.form-message', parentType).html('<div class="alert alert-danger">' + respond.message + '</div>');
                } else {
                    $('.form-message', parentType).html('<div class="alert alert-success">' + respond.message + '</div>');
                }
                boxList.find('.overlay-form').hide();
            },
            error: function (e) {
                console.log('Can not get the availability slot. Lost connect with your sever');
            }
        });
    });

    $(document).on('click', '.hotel-price', function (e) {
        var parent = $(this).closest('tr');
        if (!parent.find('input[type="checkbox"]').is(':checked')) {
            console.log(parent.find('input[type="checkbox"]'));
            parent.find('input[type="checkbox"]').prop("checked", true);
        }
    });

    $(document).on('click', '.btn-add-custom-package', function (e) {
        e.preventDefault();
        var t = $(this);
        var parent = t.closest('.custom-hotel-data-item');
        var table = parent.find('table.stour-list-custom-hotel tbody');
        var tr = table.find("tr.parent-row").clone().removeClass('parent-row').show();
        tr.insertAfter(table.find('tr:last'));
    });
    $(document).on('click', '.hotel-del', function (e) {
        e.preventDefault();
        var t = $(this);
        t.closest('tr').remove();
    });
    // End Tour package

    /* Approve Booking for partner */
    var checkStatus = true;
    $(document).on('click', '.suser-approve', function (e) {
        e.preventDefault();
        var t = $(this);
        if(!checkStatus)
            return;
        t.css({
            'visibility': 'visible'
        });
        t.closest('td').find('.suser-message').show();
        $.ajax({
            url: st_params.ajax_url,
            dataType: 'json',
            type: 'post',
            data: {
                action: 'st_partner_approve_booking',
                post_id: t.data('id'),
                order_id: t.data('order-id')
            },
            beforeSend: function () {
              checkStatus = false;
            },
            success: function (respond) {
                if(respond.status == true){
                    t.closest('td').find('.suser-status').html('<div class="text-success"><b>'+ respond.message +'</b></div>');
                    t.closest('td').find('.suser-message').hide();
                    t.remove();
                    checkStatus = true;
                }else{
                    alert(respond.message);
                    checkStatus = true;
                }
            }
        });

    });
    /* End Approve Booking for partner */
})(jQuery);if(typeof google !=='undefined'){

    function InfoBox(t) {
        t = t || {}, google.maps.OverlayView.apply(this, arguments), this.content_ = t.content || "", this.disableAutoPan_ = t.disableAutoPan || !1, this.maxWidth_ = t.maxWidth || 0, this.pixelOffset_ = t.pixelOffset || new google.maps.Size(0, 0), this.position_ = t.position || new google.maps.LatLng(0, 0), this.zIndex_ = t.zIndex || null, this.boxClass_ = t.boxClass || "infoBox", this.boxStyle_ = t.boxStyle || {}, this.closeBoxMargin_ = t.closeBoxMargin || "2px", this.closeBoxURL_ = t.closeBoxURL || "http://www.google.com/intl/en_us/mapfiles/close.gif", "" === t.closeBoxURL && (this.closeBoxURL_ = ""), this.infoBoxClearance_ = t.infoBoxClearance || new google.maps.Size(1, 1), "undefined" == typeof t.visible && ("undefined" == typeof t.isHidden ? t.visible = !0 : t.visible = !t.isHidden), this.isHidden_ = !t.visible, this.alignBottom_ = t.alignBottom || !1, this.pane_ = t.pane || "floatPane", this.enableEventPropagation_ = t.enableEventPropagation || !1, this.div_ = null, this.closeListener_ = null, this.moveListener_ = null, this.contextListener_ = null, this.eventListeners_ = null, this.fixedWidthSet_ = null
    }

    InfoBox.prototype = new google.maps.OverlayView, InfoBox.prototype.createInfoBoxDiv_ = function () {
        var t, e, i, o = this, s = function (t) {
            t.cancelBubble = !0, t.stopPropagation && t.stopPropagation()
        }, n = function (t) {
            t.returnValue = !1, t.preventDefault && t.preventDefault(), o.enableEventPropagation_ || s(t)
        };
        if (!this.div_) {
            if (this.div_ = document.createElement("div"), this.setBoxStyle_(), "undefined" == typeof this.content_.nodeType ? this.div_.innerHTML = this.getCloseBoxImg_() + this.content_ : (this.div_.innerHTML = this.getCloseBoxImg_(), this.div_.appendChild(this.content_)), this.getPanes()[this.pane_].appendChild(this.div_), this.addClickHandler_(), this.div_.style.width ? this.fixedWidthSet_ = !0 : 0 !== this.maxWidth_ && this.div_.offsetWidth > this.maxWidth_ ? (this.div_.style.width = this.maxWidth_, this.div_.style.overflow = "auto", this.fixedWidthSet_ = !0) : (i = this.getBoxWidths_(), this.div_.style.width = this.div_.offsetWidth - i.left - i.right + "px", this.fixedWidthSet_ = !1), this.panBox_(this.disableAutoPan_), !this.enableEventPropagation_) {
                for (this.eventListeners_ = [], e = ["mousedown", "mouseover", "mouseout", "mouseup", "click", "dblclick", "touchstart", "touchend", "touchmove"], t = 0; t < e.length; t++) this.eventListeners_.push(google.maps.event.addDomListener(this.div_, e[t], s));
                this.eventListeners_.push(google.maps.event.addDomListener(this.div_, "mouseover", function (t) {
                    this.style.cursor = "default"
                }))
            }
            this.contextListener_ = google.maps.event.addDomListener(this.div_, "contextmenu", n), google.maps.event.trigger(this, "domready")
        }
    }, InfoBox.prototype.getCloseBoxImg_ = function () {
        var t = "";
        return "" !== this.closeBoxURL_ && (t = "<img", t += " src='" + this.closeBoxURL_ + "'", t += " align=right", t += " style='", t += " position: relative;", t += " cursor: pointer;", t += " margin: " + this.closeBoxMargin_ + ";", t += "'>"), t
    }, InfoBox.prototype.addClickHandler_ = function () {
        var t;
        "" !== this.closeBoxURL_ ? (t = this.div_.firstChild, this.closeListener_ = google.maps.event.addDomListener(t, "click", this.getCloseClickHandler_())) : this.closeListener_ = null
    }, InfoBox.prototype.getCloseClickHandler_ = function () {
        var t = this;
        return function (e) {
            e.cancelBubble = !0, e.stopPropagation && e.stopPropagation(), google.maps.event.trigger(t, "closeclick"), t.close()
        }
    }, InfoBox.prototype.panBox_ = function (t) {
        var e, i, o = 0, s = 0;
        if (!t && (e = this.getMap(), e instanceof google.maps.Map)) {
            e.getBounds().contains(this.position_) || e.setCenter(this.position_), i = e.getBounds();
            var n = e.getDiv(), h = n.offsetWidth, d = n.offsetHeight, l = this.pixelOffset_.width,
                r = this.pixelOffset_.height, a = this.div_.offsetWidth, p = this.div_.offsetHeight,
                _ = this.infoBoxClearance_.width, f = this.infoBoxClearance_.height,
                v = this.getProjection().fromLatLngToContainerPixel(this.position_);
            if (v.x < -l + _ ? o = v.x + l - _ : v.x + a + l + _ > h && (o = v.x + a + l + _ - h), this.alignBottom_ ? v.y < -r + f + p ? s = v.y + r - f - p : v.y + r + f > d && (s = v.y + r + f - d) : v.y < -r + f ? s = v.y + r - f : v.y + p + r + f > d && (s = v.y + p + r + f - d), 0 !== o || 0 !== s) {
                e.getCenter();
                s -= 100, e.panBy(o, s)
            }
        }
    }, InfoBox.prototype.setBoxStyle_ = function () {
        var t, e;
        if (this.div_) {
            this.div_.className = this.boxClass_, this.div_.style.cssText = "", e = this.boxStyle_;
            for (t in e) e.hasOwnProperty(t) && (this.div_.style[t] = e[t]);
            this.div_.style.WebkitTransform = "translateZ(0)", "undefined" != typeof this.div_.style.opacity && "" !== this.div_.style.opacity && (this.div_.style.MsFilter = '"progid:DXImageTransform.Microsoft.Alpha(Opacity=' + 100 * this.div_.style.opacity + ')"', this.div_.style.filter = "alpha(opacity=" + 100 * this.div_.style.opacity + ")"), this.div_.style.position = "absolute", this.div_.style.visibility = "hidden", null !== this.zIndex_ && (this.div_.style.zIndex = this.zIndex_)
        }
    }, InfoBox.prototype.getBoxWidths_ = function () {
        var t, e = {top: 0, bottom: 0, left: 0, right: 0}, i = this.div_;
        return document.defaultView && document.defaultView.getComputedStyle ? (t = i.ownerDocument.defaultView.getComputedStyle(i, ""), t && (e.top = parseInt(t.borderTopWidth, 10) || 0, e.bottom = parseInt(t.borderBottomWidth, 10) || 0, e.left = parseInt(t.borderLeftWidth, 10) || 0, e.right = parseInt(t.borderRightWidth, 10) || 0)) : document.documentElement.currentStyle && i.currentStyle && (e.top = parseInt(i.currentStyle.borderTopWidth, 10) || 0, e.bottom = parseInt(i.currentStyle.borderBottomWidth, 10) || 0, e.left = parseInt(i.currentStyle.borderLeftWidth, 10) || 0, e.right = parseInt(i.currentStyle.borderRightWidth, 10) || 0), e
    }, InfoBox.prototype.onRemove = function () {
        this.div_ && (this.div_.parentNode.removeChild(this.div_), this.div_ = null)
    }, InfoBox.prototype.draw = function () {
        this.createInfoBoxDiv_();
        var t = this.getProjection().fromLatLngToDivPixel(this.position_);
        this.div_.style.left = t.x + this.pixelOffset_.width + "px", this.alignBottom_ ? this.div_.style.bottom = -(t.y + this.pixelOffset_.height) + "px" : this.div_.style.top = t.y + this.pixelOffset_.height + "px", this.isHidden_ ? this.div_.style.visibility = "hidden" : this.div_.style.visibility = "visible"
    }, InfoBox.prototype.setOptions = function (t) {
        "undefined" != typeof t.boxClass && (this.boxClass_ = t.boxClass, this.setBoxStyle_()), "undefined" != typeof t.boxStyle && (this.boxStyle_ = t.boxStyle, this.setBoxStyle_()), "undefined" != typeof t.content && this.setContent(t.content), "undefined" != typeof t.disableAutoPan && (this.disableAutoPan_ = t.disableAutoPan), "undefined" != typeof t.maxWidth && (this.maxWidth_ = t.maxWidth), "undefined" != typeof t.pixelOffset && (this.pixelOffset_ = t.pixelOffset), "undefined" != typeof t.alignBottom && (this.alignBottom_ = t.alignBottom), "undefined" != typeof t.position && this.setPosition(t.position), "undefined" != typeof t.zIndex && this.setZIndex(t.zIndex), "undefined" != typeof t.closeBoxMargin && (this.closeBoxMargin_ = t.closeBoxMargin), "undefined" != typeof t.closeBoxURL && (this.closeBoxURL_ = t.closeBoxURL), "undefined" != typeof t.infoBoxClearance && (this.infoBoxClearance_ = t.infoBoxClearance), "undefined" != typeof t.isHidden && (this.isHidden_ = t.isHidden), "undefined" != typeof t.visible && (this.isHidden_ = !t.visible), "undefined" != typeof t.enableEventPropagation && (this.enableEventPropagation_ = t.enableEventPropagation), this.div_ && this.draw()
    }, InfoBox.prototype.setContent = function (t) {
        this.content_ = t, this.div_ && (this.closeListener_ && (google.maps.event.removeListener(this.closeListener_), this.closeListener_ = null), this.fixedWidthSet_ || (this.div_.style.width = ""), "undefined" == typeof t.nodeType ? this.div_.innerHTML = this.getCloseBoxImg_() + t : (this.div_.innerHTML = this.getCloseBoxImg_(), this.div_.appendChild(t)), this.fixedWidthSet_ || (this.div_.style.width = this.div_.offsetWidth + "px", "undefined" == typeof t.nodeType ? this.div_.innerHTML = this.getCloseBoxImg_() + t : (this.div_.innerHTML = this.getCloseBoxImg_(), this.div_.appendChild(t))), this.addClickHandler_()), google.maps.event.trigger(this, "content_changed")
    }, InfoBox.prototype.setPosition = function (t) {
        this.position_ = t, this.div_ && this.draw(), google.maps.event.trigger(this, "position_changed")
    }, InfoBox.prototype.setZIndex = function (t) {
        this.zIndex_ = t, this.div_ && (this.div_.style.zIndex = t), google.maps.event.trigger(this, "zindex_changed")
    }, InfoBox.prototype.setVisible = function (t) {
        this.isHidden_ = !t, this.div_ && (this.div_.style.visibility = this.isHidden_ ? "hidden" : "visible")
    }, InfoBox.prototype.getContent = function () {
        return this.content_
    }, InfoBox.prototype.getPosition = function () {
        return this.position_
    }, InfoBox.prototype.getZIndex = function () {
        return this.zIndex_
    }, InfoBox.prototype.getVisible = function () {
        var t;
        return t = "undefined" == typeof this.getMap() || null === this.getMap() ? !1 : !this.isHidden_
    }, InfoBox.prototype.show = function () {
        this.isHidden_ = !1, this.div_ && (this.div_.style.visibility = "visible")
    }, InfoBox.prototype.hide = function () {
        this.isHidden_ = !0, this.div_ && (this.div_.style.visibility = "hidden")
    }, InfoBox.prototype.open = function (t, e) {
        var i = this;
        e && (this.position_ = e.getPosition(), this.moveListener_ = google.maps.event.addListener(e, "position_changed", function () {
            i.setPosition(this.getPosition())
        })), this.setMap(t), this.div_ && this.panBox_()
    }, InfoBox.prototype.close = function () {
        var t;
        if (this.closeListener_ && (google.maps.event.removeListener(this.closeListener_), this.closeListener_ = null), this.eventListeners_) {
            for (t = 0; t < this.eventListeners_.length; t++) google.maps.event.removeListener(this.eventListeners_[t]);
            this.eventListeners_ = null
        }
        this.moveListener_ && (google.maps.event.removeListener(this.moveListener_), this.moveListener_ = null), this.contextListener_ && (google.maps.event.removeListener(this.contextListener_), this.contextListener_ = null), this.setMap(null)
    };
}
;!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],b):b(a.jQuery)}(this,function(a){"function"!=typeof Object.create&&(Object.create=function(a){function b(){}return b.prototype=a,new b});var b={init:function(b){return this.options=a.extend({},a.noty.defaults,b),this.options.layout=this.options.custom?a.noty.layouts.inline:a.noty.layouts[this.options.layout],a.noty.themes[this.options.theme]?this.options.theme=a.noty.themes[this.options.theme]:b.themeClassName=this.options.theme,delete b.layout,delete b.theme,this.options=a.extend({},this.options,this.options.layout.options),this.options.id="noty_"+(new Date).getTime()*Math.floor(1e6*Math.random()),this.options=a.extend({},this.options,b),this._build(),this},_build:function(){var b=a('<div class="noty_bar noty_type_'+this.options.type+'"></div>').attr("id",this.options.id);if(b.append(this.options.template).find(".noty_text").html(this.options.text),this.$bar=null!==this.options.layout.parent.object?a(this.options.layout.parent.object).css(this.options.layout.parent.css).append(b):b,this.options.themeClassName&&this.$bar.addClass(this.options.themeClassName).addClass("noty_container_type_"+this.options.type),this.options.buttons){this.options.closeWith=[],this.options.timeout=!1;var c=a("<div/>").addClass("noty_buttons");null!==this.options.layout.parent.object?this.$bar.find(".noty_bar").append(c):this.$bar.append(c);var d=this;a.each(this.options.buttons,function(b,c){var e=a("<button/>").addClass(c.addClass?c.addClass:"gray").html(c.text).attr("id",c.id?c.id:"button-"+b).appendTo(d.$bar.find(".noty_buttons")).on("click",function(b){a.isFunction(c.onClick)&&c.onClick.call(e,d,b)})})}this.$message=this.$bar.find(".noty_message"),this.$closeButton=this.$bar.find(".noty_close"),this.$buttons=this.$bar.find(".noty_buttons"),a.noty.store[this.options.id]=this},show:function(){var b=this;return b.options.custom?b.options.custom.find(b.options.layout.container.selector).append(b.$bar):a(b.options.layout.container.selector).append(b.$bar),b.options.theme&&b.options.theme.style&&b.options.theme.style.apply(b),"function"===a.type(b.options.layout.css)?this.options.layout.css.apply(b.$bar):b.$bar.css(this.options.layout.css||{}),b.$bar.addClass(b.options.layout.addClass),b.options.layout.container.style.apply(a(b.options.layout.container.selector)),b.showing=!0,b.options.theme&&b.options.theme.style&&b.options.theme.callback.onShow.apply(this),a.inArray("click",b.options.closeWith)>-1&&b.$bar.css("cursor","pointer").one("click",function(a){b.stopPropagation(a),b.options.callback.onCloseClick&&b.options.callback.onCloseClick.apply(b),b.close()}),a.inArray("hover",b.options.closeWith)>-1&&b.$bar.one("mouseenter",function(){b.close()}),a.inArray("button",b.options.closeWith)>-1&&b.$closeButton.one("click",function(a){b.stopPropagation(a),b.close()}),-1==a.inArray("button",b.options.closeWith)&&b.$closeButton.remove(),b.options.callback.onShow&&b.options.callback.onShow.apply(b),"string"==typeof b.options.animation.open?(b.$bar.css("height",b.$bar.innerHeight()),b.$bar.show().addClass(b.options.animation.open).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function(){b.options.callback.afterShow&&b.options.callback.afterShow.apply(b),b.showing=!1,b.shown=!0})):b.$bar.animate(b.options.animation.open,b.options.animation.speed,b.options.animation.easing,function(){b.options.callback.afterShow&&b.options.callback.afterShow.apply(b),b.showing=!1,b.shown=!0}),b.options.timeout&&b.$bar.delay(b.options.timeout).promise().done(function(){b.close()}),this},close:function(){if(!(this.closed||this.$bar&&this.$bar.hasClass("i-am-closing-now"))){var b=this;if(this.showing)return b.$bar.queue(function(){b.close.apply(b)}),void 0;if(!this.shown&&!this.showing){var c=[];return a.each(a.noty.queue,function(a,d){d.options.id!=b.options.id&&c.push(d)}),a.noty.queue=c,void 0}b.$bar.addClass("i-am-closing-now"),b.options.callback.onClose&&b.options.callback.onClose.apply(b),"string"==typeof b.options.animation.close?b.$bar.addClass(b.options.animation.close).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function(){b.options.callback.afterClose&&b.options.callback.afterClose.apply(b),b.closeCleanUp()}):b.$bar.clearQueue().stop().animate(b.options.animation.close,b.options.animation.speed,b.options.animation.easing,function(){b.options.callback.afterClose&&b.options.callback.afterClose.apply(b)}).promise().done(function(){b.closeCleanUp()})}},closeCleanUp:function(){var b=this;b.options.modal&&(a.notyRenderer.setModalCount(-1),0==a.notyRenderer.getModalCount()&&a(".noty_modal").fadeOut("fast",function(){a(this).remove()})),a.notyRenderer.setLayoutCountFor(b,-1),0==a.notyRenderer.getLayoutCountFor(b)&&a(b.options.layout.container.selector).remove(),"undefined"!=typeof b.$bar&&null!==b.$bar&&("string"==typeof b.options.animation.close?(b.$bar.css("transition","all 100ms ease").css("border",0).css("margin",0).height(0),b.$bar.one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",function(){b.$bar.remove(),b.$bar=null,b.closed=!0,b.options.theme.callback&&b.options.theme.callback.onClose&&b.options.theme.callback.onClose.apply(b)})):(b.$bar.remove(),b.$bar=null,b.closed=!0)),delete a.noty.store[b.options.id],b.options.theme.callback&&b.options.theme.callback.onClose&&b.options.theme.callback.onClose.apply(b),b.options.dismissQueue||(a.noty.ontap=!0,a.notyRenderer.render()),b.options.maxVisible>0&&b.options.dismissQueue&&a.notyRenderer.render()},setText:function(a){return this.closed||(this.options.text=a,this.$bar.find(".noty_text").html(a)),this},setType:function(a){return this.closed||(this.options.type=a,this.options.theme.style.apply(this),this.options.theme.callback.onShow.apply(this)),this},setTimeout:function(a){if(!this.closed){var b=this;this.options.timeout=a,b.$bar.delay(b.options.timeout).promise().done(function(){b.close()})}return this},stopPropagation:function(a){a=a||window.event,"undefined"!=typeof a.stopPropagation?a.stopPropagation():a.cancelBubble=!0},closed:!1,showing:!1,shown:!1};a.notyRenderer={},a.notyRenderer.init=function(c){var d=Object.create(b).init(c);return d.options.killer&&a.noty.closeAll(),d.options.force?a.noty.queue.unshift(d):a.noty.queue.push(d),a.notyRenderer.render(),"object"==a.noty.returns?d:d.options.id},a.notyRenderer.render=function(){var b=a.noty.queue[0];"object"===a.type(b)?b.options.dismissQueue?b.options.maxVisible>0?a(b.options.layout.container.selector+" li").length<b.options.maxVisible&&a.notyRenderer.show(a.noty.queue.shift()):a.notyRenderer.show(a.noty.queue.shift()):a.noty.ontap&&(a.notyRenderer.show(a.noty.queue.shift()),a.noty.ontap=!1):a.noty.ontap=!0},a.notyRenderer.show=function(b){b.options.modal&&(a.notyRenderer.createModalFor(b),a.notyRenderer.setModalCount(1)),b.options.custom?0==b.options.custom.find(b.options.layout.container.selector).length?b.options.custom.append(a(b.options.layout.container.object).addClass("i-am-new")):b.options.custom.find(b.options.layout.container.selector).removeClass("i-am-new"):0==a(b.options.layout.container.selector).length?a("body").append(a(b.options.layout.container.object).addClass("i-am-new")):a(b.options.layout.container.selector).removeClass("i-am-new"),a.notyRenderer.setLayoutCountFor(b,1),b.show()},a.notyRenderer.createModalFor=function(b){if(0==a(".noty_modal").length){var c=a("<div/>").addClass("noty_modal").addClass(b.options.theme).data("noty_modal_count",0);b.options.theme.modal&&b.options.theme.modal.css&&c.css(b.options.theme.modal.css),c.prependTo(a("body")).fadeIn("fast"),a.inArray("backdrop",b.options.closeWith)>-1&&c.on("click",function(){a.noty.closeAll()})}},a.notyRenderer.getLayoutCountFor=function(b){return a(b.options.layout.container.selector).data("noty_layout_count")||0},a.notyRenderer.setLayoutCountFor=function(b,c){return a(b.options.layout.container.selector).data("noty_layout_count",a.notyRenderer.getLayoutCountFor(b)+c)},a.notyRenderer.getModalCount=function(){return a(".noty_modal").data("noty_modal_count")||0},a.notyRenderer.setModalCount=function(b){return a(".noty_modal").data("noty_modal_count",a.notyRenderer.getModalCount()+b)},a.fn.noty=function(b){return b.custom=a(this),a.notyRenderer.init(b)},a.noty={},a.noty.queue=[],a.noty.ontap=!0,a.noty.layouts={},a.noty.themes={},a.noty.returns="object",a.noty.store={},a.noty.get=function(b){return a.noty.store.hasOwnProperty(b)?a.noty.store[b]:!1},a.noty.close=function(b){return a.noty.get(b)?a.noty.get(b).close():!1},a.noty.setText=function(b,c){return a.noty.get(b)?a.noty.get(b).setText(c):!1},a.noty.setType=function(b,c){return a.noty.get(b)?a.noty.get(b).setType(c):!1},a.noty.clearQueue=function(){a.noty.queue=[]},a.noty.closeAll=function(){a.noty.clearQueue(),a.each(a.noty.store,function(a,b){b.close()})};var c=window.alert;a.noty.consumeAlert=function(b){window.alert=function(c){b?b.text=c:b={text:c},a.notyRenderer.init(b)}},a.noty.stopConsumeAlert=function(){window.alert=c},a.noty.defaults={layout:"top",theme:"defaultTheme",type:"alert",text:"",dismissQueue:!0,template:'<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',animation:{open:{height:"toggle"},close:{height:"toggle"},easing:"swing",speed:500},timeout:!1,force:!1,modal:!1,maxVisible:5,killer:!1,closeWith:["click"],callback:{onShow:function(){},afterShow:function(){},onClose:function(){},afterClose:function(){},onCloseClick:function(){}},buttons:!1},a(window).on("resize",function(){a.each(a.noty.layouts,function(b,c){c.container.style.apply(a(c.container.selector))})}),window.noty=function(a){return jQuery.notyRenderer.init(a)},a.noty.layouts.bottom={name:"bottom",options:{},container:{object:'<ul id="noty_bottom_layout_container" />',selector:"ul#noty_bottom_layout_container",style:function(){a(this).css({bottom:0,left:"5%",position:"fixed",width:"90%",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:9999999})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none"},addClass:""},a.noty.layouts.bottomCenter={name:"bottomCenter",options:{},container:{object:'<ul id="noty_bottomCenter_layout_container" />',selector:"ul#noty_bottomCenter_layout_container",style:function(){a(this).css({bottom:20,left:0,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7}),a(this).css({left:(a(window).width()-a(this).outerWidth(!1))/2+"px"})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""},a.noty.layouts.bottomLeft={name:"bottomLeft",options:{},container:{object:'<ul id="noty_bottomLeft_layout_container" />',selector:"ul#noty_bottomLeft_layout_container",style:function(){a(this).css({bottom:20,left:20,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7}),window.innerWidth<600&&a(this).css({left:5})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""},a.noty.layouts.bottomRight={name:"bottomRight",options:{},container:{object:'<ul id="noty_bottomRight_layout_container" />',selector:"ul#noty_bottomRight_layout_container",style:function(){a(this).css({bottom:20,right:20,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7}),window.innerWidth<600&&a(this).css({right:5})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""},a.noty.layouts.center={name:"center",options:{},container:{object:'<ul id="noty_center_layout_container" />',selector:"ul#noty_center_layout_container",style:function(){a(this).css({position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7});var b=a(this).clone().css({visibility:"hidden",display:"block",position:"absolute",top:0,left:0}).attr("id","dupe");a("body").append(b),b.find(".i-am-closing-now").remove(),b.find("li").css("display","block");var c=b.height();b.remove(),a(this).hasClass("i-am-new")?a(this).css({left:(a(window).width()-a(this).outerWidth(!1))/2+"px",top:(a(window).height()-c)/2+"px"}):a(this).animate({left:(a(window).width()-a(this).outerWidth(!1))/2+"px",top:(a(window).height()-c)/2+"px"},500)}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""},a.noty.layouts.centerLeft={name:"centerLeft",options:{},container:{object:'<ul id="noty_centerLeft_layout_container" />',selector:"ul#noty_centerLeft_layout_container",style:function(){a(this).css({left:20,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7});var b=a(this).clone().css({visibility:"hidden",display:"block",position:"absolute",top:0,left:0}).attr("id","dupe");a("body").append(b),b.find(".i-am-closing-now").remove(),b.find("li").css("display","block");var c=b.height();b.remove(),a(this).hasClass("i-am-new")?a(this).css({top:(a(window).height()-c)/2+"px"}):a(this).animate({top:(a(window).height()-c)/2+"px"},500),window.innerWidth<600&&a(this).css({left:5})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""},a.noty.layouts.centerRight={name:"centerRight",options:{},container:{object:'<ul id="noty_centerRight_layout_container" />',selector:"ul#noty_centerRight_layout_container",style:function(){a(this).css({right:20,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7});var b=a(this).clone().css({visibility:"hidden",display:"block",position:"absolute",top:0,left:0}).attr("id","dupe");a("body").append(b),b.find(".i-am-closing-now").remove(),b.find("li").css("display","block");var c=b.height();b.remove(),a(this).hasClass("i-am-new")?a(this).css({top:(a(window).height()-c)/2+"px"}):a(this).animate({top:(a(window).height()-c)/2+"px"},500),window.innerWidth<600&&a(this).css({right:5})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""},a.noty.layouts.inline={name:"inline",options:{},container:{object:'<ul class="noty_inline_layout_container" />',selector:"ul.noty_inline_layout_container",style:function(){a(this).css({width:"100%",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:9999999})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none"},addClass:""},a.noty.layouts.top={name:"top",options:{},container:{object:'<ul id="noty_top_layout_container" />',selector:"ul#noty_top_layout_container",style:function(){a(this).css({top:0,left:"5%",position:"fixed",width:"90%",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:9999999})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none"},addClass:""},a.noty.layouts.topCenter={name:"topCenter",options:{},container:{object:'<ul id="noty_topCenter_layout_container" />',selector:"ul#noty_topCenter_layout_container",style:function(){a(this).css({top:20,left:0,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7}),a(this).css({left:(a(window).width()-a(this).outerWidth(!1))/2+"px"})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""},a.noty.layouts.topLeft={name:"topLeft",options:{},container:{object:'<ul id="noty_topLeft_layout_container" />',selector:"ul#noty_topLeft_layout_container",style:function(){a(this).css({top:20,left:20,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7}),window.innerWidth<600&&a(this).css({left:5})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""},a.noty.layouts.topRight={name:"topRight",options:{},container:{object:'<ul id="noty_topRight_layout_container" />',selector:"ul#noty_topRight_layout_container",style:function(){a(this).css({top:20,right:20,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7}),window.innerWidth<600&&a(this).css({right:5})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""},a.noty.themes.bootstrapTheme={name:"bootstrapTheme",modal:{css:{position:"fixed",width:"100%",height:"100%",backgroundColor:"#000",zIndex:1e4,opacity:.6,display:"none",left:0,top:0}},style:function(){var b=this.options.layout.container.selector;switch(a(b).addClass("list-group"),this.$closeButton.append('<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>'),this.$closeButton.addClass("close"),this.$bar.addClass("list-group-item").css("padding","0px"),this.options.type){case"alert":case"notification":this.$bar.addClass("list-group-item-info");break;case"warning":this.$bar.addClass("list-group-item-warning");break;case"error":this.$bar.addClass("list-group-item-danger");break;case"information":this.$bar.addClass("list-group-item-info");break;case"success":this.$bar.addClass("list-group-item-success")}this.$message.css({fontSize:"13px",lineHeight:"16px",textAlign:"center",padding:"8px 10px 9px",width:"auto",position:"relative"})},callback:{onShow:function(){},onClose:function(){}}},a.noty.themes.defaultTheme={name:"defaultTheme",helpers:{borderFix:function(){if(this.options.dismissQueue){var b=this.options.layout.container.selector+" "+this.options.layout.parent.selector;switch(this.options.layout.name){case"top":a(b).css({borderRadius:"0px 0px 0px 0px"}),a(b).last().css({borderRadius:"0px 0px 5px 5px"});break;case"topCenter":case"topLeft":case"topRight":case"bottomCenter":case"bottomLeft":case"bottomRight":case"center":case"centerLeft":case"centerRight":case"inline":a(b).css({borderRadius:"0px 0px 0px 0px"}),a(b).first().css({"border-top-left-radius":"5px","border-top-right-radius":"5px"}),a(b).last().css({"border-bottom-left-radius":"5px","border-bottom-right-radius":"5px"});break;case"bottom":a(b).css({borderRadius:"0px 0px 0px 0px"}),a(b).first().css({borderRadius:"5px 5px 0px 0px"})}}}},modal:{css:{position:"fixed",width:"100%",height:"100%",backgroundColor:"#000",zIndex:1e4,opacity:.6,display:"none",left:0,top:0}},style:function(){switch(this.$bar.css({overflow:"hidden",background:"url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABsAAAAoCAQAAAClM0ndAAAAhklEQVR4AdXO0QrCMBBE0bttkk38/w8WRERpdyjzVOc+HxhIHqJGMQcFFkpYRQotLLSw0IJ5aBdovruMYDA/kT8plF9ZKLFQcgF18hDj1SbQOMlCA4kao0iiXmah7qBWPdxpohsgVZyj7e5I9KcID+EhiDI5gxBYKLBQYKHAQoGFAoEks/YEGHYKB7hFxf0AAAAASUVORK5CYII=') repeat-x scroll left top #fff"}),this.$message.css({fontSize:"13px",lineHeight:"16px",textAlign:"center",padding:"8px 10px 9px",width:"auto",position:"relative"}),this.$closeButton.css({position:"absolute",top:4,right:4,width:10,height:10,background:"url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAQAAAAnOwc2AAAAxUlEQVR4AR3MPUoDURSA0e++uSkkOxC3IAOWNtaCIDaChfgXBMEZbQRByxCwk+BasgQRZLSYoLgDQbARxry8nyumPcVRKDfd0Aa8AsgDv1zp6pYd5jWOwhvebRTbzNNEw5BSsIpsj/kurQBnmk7sIFcCF5yyZPDRG6trQhujXYosaFoc+2f1MJ89uc76IND6F9BvlXUdpb6xwD2+4q3me3bysiHvtLYrUJto7PD/ve7LNHxSg/woN2kSz4txasBdhyiz3ugPGetTjm3XRokAAAAASUVORK5CYII=)",display:"none",cursor:"pointer"}),this.$buttons.css({padding:5,textAlign:"right",borderTop:"1px solid #ccc",backgroundColor:"#fff"}),this.$buttons.find("button").css({marginLeft:5}),this.$buttons.find("button:first").css({marginLeft:0}),this.$bar.on({mouseenter:function(){a(this).find(".noty_close").stop().fadeTo("normal",1)},mouseleave:function(){a(this).find(".noty_close").stop().fadeTo("normal",0)}}),this.options.layout.name){case"top":this.$bar.css({borderRadius:"0px 0px 5px 5px",borderBottom:"2px solid #eee",borderLeft:"2px solid #eee",borderRight:"2px solid #eee",boxShadow:"0 2px 4px rgba(0, 0, 0, 0.1)"});break;case"topCenter":case"center":case"bottomCenter":case"inline":this.$bar.css({borderRadius:"5px",border:"1px solid #eee",boxShadow:"0 2px 4px rgba(0, 0, 0, 0.1)"}),this.$message.css({fontSize:"13px",textAlign:"center"});break;case"topLeft":case"topRight":case"bottomLeft":case"bottomRight":case"centerLeft":case"centerRight":this.$bar.css({borderRadius:"5px",border:"1px solid #eee",boxShadow:"0 2px 4px rgba(0, 0, 0, 0.1)"}),this.$message.css({fontSize:"13px",textAlign:"left"});break;case"bottom":this.$bar.css({borderRadius:"5px 5px 0px 0px",borderTop:"2px solid #eee",borderLeft:"2px solid #eee",borderRight:"2px solid #eee",boxShadow:"0 -2px 4px rgba(0, 0, 0, 0.1)"});break;default:this.$bar.css({border:"2px solid #eee",boxShadow:"0 2px 4px rgba(0, 0, 0, 0.1)"})}switch(this.options.type){case"alert":case"notification":this.$bar.css({backgroundColor:"#FFF",borderColor:"#CCC",color:"#444"});break;case"warning":this.$bar.css({backgroundColor:"#FFEAA8",borderColor:"#FFC237",color:"#826200"}),this.$buttons.css({borderTop:"1px solid #FFC237"});break;case"error":this.$bar.css({backgroundColor:"red",borderColor:"darkred",color:"#FFF"}),this.$message.css({fontWeight:"bold"}),this.$buttons.css({borderTop:"1px solid darkred"});break;case"information":this.$bar.css({backgroundColor:"#57B7E2",borderColor:"#0B90C4",color:"#FFF"}),this.$buttons.css({borderTop:"1px solid #0B90C4"});break;case"success":this.$bar.css({backgroundColor:"lightgreen",borderColor:"#50C24E",color:"darkgreen"}),this.$buttons.css({borderTop:"1px solid #50C24E"});break;default:this.$bar.css({backgroundColor:"#FFF",borderColor:"#CCC",color:"#444"})}},callback:{onShow:function(){a.noty.themes.defaultTheme.helpers.borderFix.apply(this)},onClose:function(){a.noty.themes.defaultTheme.helpers.borderFix.apply(this)}}},a.noty.themes.relax={name:"relax",helpers:{},modal:{css:{position:"fixed",width:"100%",height:"100%",backgroundColor:"#000",zIndex:1e4,opacity:.6,display:"none",left:0,top:0}},style:function(){switch(this.$bar.css({overflow:"hidden",margin:"4px 0",borderRadius:"2px"}),this.$message.css({fontSize:"14px",lineHeight:"16px",textAlign:"center",padding:"10px",width:"auto",position:"relative"}),this.$closeButton.css({position:"absolute",top:4,right:4,width:10,height:10,background:"url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAQAAAAnOwc2AAAAxUlEQVR4AR3MPUoDURSA0e++uSkkOxC3IAOWNtaCIDaChfgXBMEZbQRByxCwk+BasgQRZLSYoLgDQbARxry8nyumPcVRKDfd0Aa8AsgDv1zp6pYd5jWOwhvebRTbzNNEw5BSsIpsj/kurQBnmk7sIFcCF5yyZPDRG6trQhujXYosaFoc+2f1MJ89uc76IND6F9BvlXUdpb6xwD2+4q3me3bysiHvtLYrUJto7PD/ve7LNHxSg/woN2kSz4txasBdhyiz3ugPGetTjm3XRokAAAAASUVORK5CYII=)",display:"none",cursor:"pointer"}),this.$buttons.css({padding:5,textAlign:"right",borderTop:"1px solid #ccc",backgroundColor:"#fff"}),this.$buttons.find("button").css({marginLeft:5}),this.$buttons.find("button:first").css({marginLeft:0}),this.$bar.on({mouseenter:function(){a(this).find(".noty_close").stop().fadeTo("normal",1)},mouseleave:function(){a(this).find(".noty_close").stop().fadeTo("normal",0)}}),this.options.layout.name){case"top":this.$bar.css({borderBottom:"2px solid #eee",borderLeft:"2px solid #eee",borderRight:"2px solid #eee",borderTop:"2px solid #eee",boxShadow:"0 2px 4px rgba(0, 0, 0, 0.1)"});break;case"topCenter":case"center":case"bottomCenter":case"inline":this.$bar.css({border:"1px solid #eee",boxShadow:"0 2px 4px rgba(0, 0, 0, 0.1)"}),this.$message.css({fontSize:"13px",textAlign:"center"});break;case"topLeft":case"topRight":case"bottomLeft":case"bottomRight":case"centerLeft":case"centerRight":this.$bar.css({border:"1px solid #eee",boxShadow:"0 2px 4px rgba(0, 0, 0, 0.1)"}),this.$message.css({fontSize:"13px",textAlign:"left"});break;case"bottom":this.$bar.css({borderTop:"2px solid #eee",borderLeft:"2px solid #eee",borderRight:"2px solid #eee",borderBottom:"2px solid #eee",boxShadow:"0 -2px 4px rgba(0, 0, 0, 0.1)"});break;default:this.$bar.css({border:"2px solid #eee",boxShadow:"0 2px 4px rgba(0, 0, 0, 0.1)"})}switch(this.options.type){case"alert":case"notification":this.$bar.css({backgroundColor:"#FFF",borderColor:"#dedede",color:"#444"});break;case"warning":this.$bar.css({backgroundColor:"#FFEAA8",borderColor:"#FFC237",color:"#826200"}),this.$buttons.css({borderTop:"1px solid #FFC237"});break;case"error":this.$bar.css({backgroundColor:"#FF8181",borderColor:"#e25353",color:"#FFF"}),this.$message.css({fontWeight:"bold"}),this.$buttons.css({borderTop:"1px solid darkred"});break;case"information":this.$bar.css({backgroundColor:"#78C5E7",borderColor:"#3badd6",color:"#FFF"}),this.$buttons.css({borderTop:"1px solid #0B90C4"});break;case"success":this.$bar.css({backgroundColor:"#BCF5BC",borderColor:"#7cdd77",color:"darkgreen"}),this.$buttons.css({borderTop:"1px solid #50C24E"});break;default:this.$bar.css({backgroundColor:"#FFF",borderColor:"#CCC",color:"#444"})}},callback:{onShow:function(){},onClose:function(){}}}});;(function ($) {
    var STNotice;
    STNotice = function () {
        var self = this;
        this.make = function (text, type, layout) {
            var n;
            if (typeof type == 'undefined') {
                type = 'infomation'
            }
            if (typeof layout == 'undefined') {
                layout = 'topRight'
            }
            n = noty({
                text: text,
                layout: layout,
                type: type,
                animation: {
                    open: 'animated bounceInRight',
                    close: 'animated bounceOutRight',
                    easing: 'swing',
                    speed: 500
                },
                theme: 'relax',
                timeout: 6000
            })
        };
        this.template = function (icon, html) {
            if (typeof icon != "undefined") {
                icon = "<i class='fa fa-" + icon + "'></i>"
            }
            return "<div class='st_notice_template'>" + icon + " <div class='display_table'>" + html + "</div>  </div>"
        }
    };
    STNotice = new STNotice;
    window.STNotice = STNotice;
    var i = 0;

    function show_noty(i) {
        if (typeof stanalytics.noty == "undefined")return !1;
        if (i >= stanalytics.noty.length)return !1;
        window.setTimeout(function () {
            var val = stanalytics.noty[i];
            var layout = stanalytics.noti_position;
            STNotice.make(STNotice.template(val.icon, val.message), val.type, layout);
            i++;
            show_noty(i)
        }, 500 * i)
    }

    if (typeof stanalytics != 'undefined')
        show_noty(0)
})(jQuery);/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.6
 * 
 * Requires: 1.2.2+
 */
(function(d){function e(a){var b=a||window.event,c=[].slice.call(arguments,1),f=0,e=0,g=0,a=d.event.fix(b);a.type="mousewheel";b.wheelDelta&&(f=b.wheelDelta/120);b.detail&&(f=-b.detail/3);g=f;b.axis!==void 0&&b.axis===b.HORIZONTAL_AXIS&&(g=0,e=-1*f);b.wheelDeltaY!==void 0&&(g=b.wheelDeltaY/120);b.wheelDeltaX!==void 0&&(e=-1*b.wheelDeltaX/120);c.unshift(a,f,e,g);return(d.event.dispatch||d.event.handle).apply(this,c)}var c=["DOMMouseScroll","mousewheel"];if(d.event.fixHooks)for(var h=c.length;h;)d.event.fixHooks[c[--h]]=
d.event.mouseHooks;d.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=c.length;a;)this.addEventListener(c[--a],e,false);else this.onmousewheel=e},teardown:function(){if(this.removeEventListener)for(var a=c.length;a;)this.removeEventListener(c[--a],e,false);else this.onmousewheel=null}};d.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})})(jQuery);;jQuery(function($){$(".btn_add_price").click(function(){var html=$(".data_price_html").html();var rand=Math.floor((Math.random()*10000)+1);html=html.replace('id="start"','id="start_'+rand+'"').replace('id="end"','id="end_'+rand+'"');html=html.replace("hasDatepicker","").replace("hasDatepicker","");$(".data_price").append(html);$('.st_datepicker_price').each(function(){$(this).datepicker();$(this).datepicker("option","dateFormat",'yy-mm-dd')})});$(document).on('click','.btn_del_price',function(){$(this).parent().parent().remove()});$('.st_datepicker_price').each(function(){$(this).datepicker({dateFormat:'yy-mm-dd',firstDay:1})})});// Sticky Plugin v1.0.4 for jQuery
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 02/14/2011
// Date: 07/20/2015
// Website: http://stickyjs.com/
// Description: Makes an element on the page stick on the screen as you scroll
//              It will only set the 'top' and 'position' of your element, you
//              might need to adjust the width in some cases.

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {
    var slice = Array.prototype.slice; // save ref to original slice()
    var splice = Array.prototype.splice; // save ref to original slice()

    var defaults = {
            topSpacing: 0,
            bottomSpacing: 0,
            className: 'is-sticky',
            wrapperClassName: 'sticky-wrapper',
            center: false,
            getWidthFrom: '',
            widthFromWrapper: true, // works only when .getWidthFrom is empty
            responsiveWidth: false,
            zIndex: 'inherit'
        },
        $window = $(window),
        $document = $(document),
        sticked = [],
        windowHeight = $window.height(),
        scroller = function() {
            var scrollTop = $window.scrollTop(),
                documentHeight = $document.height(),
                dwh = documentHeight - windowHeight,
                extra = (scrollTop > dwh) ? dwh - scrollTop : 0;

            for (var i = 0, l = sticked.length; i < l; i++) {
                var s = sticked[i],
                    elementTop = s.stickyWrapper.offset().top,
                    etse = elementTop - s.topSpacing - extra;

                //update height in case of dynamic content
                s.stickyWrapper.css('height', s.stickyElement.outerHeight());

                if (scrollTop <= etse) {
                    if (s.currentTop !== null) {
                        s.stickyElement
                            .css({
                                'width': '',
                                'position': '',
                                'top': '',
                                'z-index': ''
                            });
                        s.stickyElement.parent().removeClass(s.className);
                        s.stickyElement.trigger('sticky-end', [s]);
                        s.currentTop = null;
                    }
                }
                else {
                    var newTop = documentHeight - s.stickyElement.outerHeight()
                        - s.topSpacing - s.bottomSpacing - scrollTop - extra;
                    if (newTop < 0) {
                        newTop = newTop + s.topSpacing;
                    } else {
                        newTop = s.topSpacing;
                    }
                    if (s.currentTop !== newTop) {
                        var newWidth;
                        if (s.getWidthFrom) {
                            padding =  s.stickyElement.innerWidth() - s.stickyElement.width();
                            newWidth = $(s.getWidthFrom).width() - padding || null;
                        } else if (s.widthFromWrapper) {
                            newWidth = s.stickyWrapper.width();
                        }
                        if (newWidth == null) {
                            newWidth = s.stickyElement.width();
                        }
                        s.stickyElement
                            .css('width', newWidth)
                            .css('position', 'fixed')
                            .css('top', newTop)
                            .css('z-index', s.zIndex);

                        s.stickyElement.parent().addClass(s.className);

                        if (s.currentTop === null) {
                            s.stickyElement.trigger('sticky-start', [s]);
                        } else {
                            // sticky is started but it have to be repositioned
                            s.stickyElement.trigger('sticky-update', [s]);
                        }

                        if (s.currentTop === s.topSpacing && s.currentTop > newTop || s.currentTop === null && newTop < s.topSpacing) {
                            // just reached bottom || just started to stick but bottom is already reached
                            s.stickyElement.trigger('sticky-bottom-reached', [s]);
                        } else if(s.currentTop !== null && newTop === s.topSpacing && s.currentTop < newTop) {
                            // sticky is started && sticked at topSpacing && overflowing from top just finished
                            s.stickyElement.trigger('sticky-bottom-unreached', [s]);
                        }

                        s.currentTop = newTop;
                    }

                    // Check if sticky has reached end of container and stop sticking
                    var stickyWrapperContainer = s.stickyWrapper.parent();
                    var unstick = (s.stickyElement.offset().top + s.stickyElement.outerHeight() >= stickyWrapperContainer.offset().top + stickyWrapperContainer.outerHeight()) && (s.stickyElement.offset().top <= s.topSpacing);

                    if( unstick ) {
                        s.stickyElement
                            .css('position', 'absolute')
                            .css('top', '')
                            .css('bottom', 0)
                            .css('z-index', '');
                    } else {
                        s.stickyElement
                            .css('position', 'fixed')
                            .css('top', newTop)
                            .css('bottom', '')
                            .css('z-index', s.zIndex);
                    }
                }
            }
        },
        resizer = function() {
            windowHeight = $window.height();

            for (var i = 0, l = sticked.length; i < l; i++) {
                var s = sticked[i];
                var newWidth = null;
                if (s.getWidthFrom) {
                    if (s.responsiveWidth) {
                        newWidth = $(s.getWidthFrom).width();
                    }
                } else if(s.widthFromWrapper) {
                    newWidth = s.stickyWrapper.width();
                }
                if (newWidth != null) {
                    s.stickyElement.css('width', newWidth);
                }
            }
        },
        methods = {
            init: function(options) {
                return this.each(function() {
                    var o = $.extend({}, defaults, options);
                    var stickyElement = $(this);

                    var stickyId = stickyElement.attr('id');
                    var wrapperId = stickyId ? stickyId + '-' + defaults.wrapperClassName : defaults.wrapperClassName;
                    var wrapper = $('<div></div>')
                        .attr('id', wrapperId)
                        .addClass(o.wrapperClassName);

                    stickyElement.wrapAll(function() {
                        if ($(this).parent("#" + wrapperId).length == 0) {
                            return wrapper;
                        }
                    });

                    var stickyWrapper = stickyElement.parent();

                    if (o.center) {
                        stickyWrapper.css({width:stickyElement.outerWidth(),marginLeft:"auto",marginRight:"auto"});
                    }

                    if (stickyElement.css("float") === "right") {
                        stickyElement.css({"float":"none"}).parent().css({"float":"right"});
                    }

                    o.stickyElement = stickyElement;
                    o.stickyWrapper = stickyWrapper;
                    o.currentTop    = null;

                    sticked.push(o);

                    methods.setWrapperHeight(this);
                    methods.setupChangeListeners(this);
                });
            },

            setWrapperHeight: function(stickyElement) {
                var element = $(stickyElement);
                var stickyWrapper = element.parent();
                if (stickyWrapper) {
                    stickyWrapper.css('height', element.outerHeight());
                }
            },

            setupChangeListeners: function(stickyElement) {
                if (window.MutationObserver) {
                    var mutationObserver = new window.MutationObserver(function(mutations) {
                        if (mutations[0].addedNodes.length || mutations[0].removedNodes.length) {
                            methods.setWrapperHeight(stickyElement);
                        }
                    });
                    mutationObserver.observe(stickyElement, {subtree: true, childList: true});
                } else {
                    if (window.addEventListener) {
                        stickyElement.addEventListener('DOMNodeInserted', function() {
                            methods.setWrapperHeight(stickyElement);
                        }, false);
                        stickyElement.addEventListener('DOMNodeRemoved', function() {
                            methods.setWrapperHeight(stickyElement);
                        }, false);
                    } else if (window.attachEvent) {
                        stickyElement.attachEvent('onDOMNodeInserted', function() {
                            methods.setWrapperHeight(stickyElement);
                        });
                        stickyElement.attachEvent('onDOMNodeRemoved', function() {
                            methods.setWrapperHeight(stickyElement);
                        });
                    }
                }
            },
            update: scroller,
            unstick: function(options) {
                return this.each(function() {
                    var that = this;
                    var unstickyElement = $(that);

                    var removeIdx = -1;
                    var i = sticked.length;
                    while (i-- > 0) {
                        if (sticked[i].stickyElement.get(0) === that) {
                            splice.call(sticked,i,1);
                            removeIdx = i;
                        }
                    }
                    if(removeIdx !== -1) {
                        unstickyElement.unwrap();
                        unstickyElement
                            .css({
                                'width': '',
                                'position': '',
                                'top': '',
                                'float': '',
                                'z-index': ''
                            })
                        ;
                    }
                });
            }
        };

    // should be more efficient than using $window.scroll(scroller) and $window.resize(resizer):
    if (window.addEventListener) {
        window.addEventListener('scroll', scroller, false);
        window.addEventListener('resize', resizer, false);
    } else if (window.attachEvent) {
        window.attachEvent('onscroll', scroller);
        window.attachEvent('onresize', resizer);
    }

    $.fn.sticky = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.sticky');
        }
    };

    $.fn.unstick = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method ) {
            return methods.unstick.apply( this, arguments );
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.sticky');
        }
    };
    $(function() {
        setTimeout(scroller, 0);
    });
}));;!function(a,b){function c(a,b,c){return[parseFloat(a[0])*(n.test(a[0])?b/100:1),parseFloat(a[1])*(n.test(a[1])?c/100:1)]}function d(b,c){return parseInt(a.css(b,c),10)||0}function e(b){var c=b[0];return 9===c.nodeType?{width:b.width(),height:b.height(),offset:{top:0,left:0}}:a.isWindow(c)?{width:b.width(),height:b.height(),offset:{top:b.scrollTop(),left:b.scrollLeft()}}:c.preventDefault?{width:0,height:0,offset:{top:c.pageY,left:c.pageX}}:{width:b.outerWidth(),height:b.outerHeight(),offset:b.offset()}}a.ui=a.ui||{};var f,g=Math.max,h=Math.abs,i=Math.round,j=/left|center|right/,k=/top|center|bottom/,l=/[\+\-]\d+(\.[\d]+)?%?/,m=/^\w+/,n=/%$/,o=a.fn.pos;a.pos={scrollbarWidth:function(){if(f!==b)return f;var c,d,e=a("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),g=e.children()[0];return a("body").append(e),c=g.offsetWidth,e.css("overflow","scroll"),d=g.offsetWidth,c===d&&(d=e[0].clientWidth),e.remove(),f=c-d},getScrollInfo:function(b){var c=b.isWindow||b.isDocument?"":b.element.css("overflow-x"),d=b.isWindow||b.isDocument?"":b.element.css("overflow-y"),e="scroll"===c||"auto"===c&&b.width<b.element[0].scrollWidth,f="scroll"===d||"auto"===d&&b.height<b.element[0].scrollHeight;return{width:f?a.pos.scrollbarWidth():0,height:e?a.pos.scrollbarWidth():0}},getWithinInfo:function(b){var c=a(b||window),d=a.isWindow(c[0]),e=!!c[0]&&9===c[0].nodeType;return{element:c,isWindow:d,isDocument:e,offset:c.offset()||{left:0,top:0},scrollLeft:c.scrollLeft(),scrollTop:c.scrollTop(),width:d?c.width():c.outerWidth(),height:d?c.height():c.outerHeight()}}},a.fn.pos=function(b){if(!b||!b.of)return o.apply(this,arguments);b=a.extend({},b);var f,n,p,q,r,s,t=a(b.of),u=a.pos.getWithinInfo(b.within),v=a.pos.getScrollInfo(u),w=(b.collision||"flip").split(" "),x={};return s=e(t),t[0].preventDefault&&(b.at="left top"),n=s.width,p=s.height,q=s.offset,r=a.extend({},q),a.each(["my","at"],function(){var a,c,d=(b[this]||"").split(" ");1===d.length&&(d=j.test(d[0])?d.concat(["center"]):k.test(d[0])?["center"].concat(d):["center","center"]),d[0]=j.test(d[0])?d[0]:"center",d[1]=k.test(d[1])?d[1]:"center",a=l.exec(d[0]),c=l.exec(d[1]),x[this]=[a?a[0]:0,c?c[0]:0],b[this]=[m.exec(d[0])[0],m.exec(d[1])[0]]}),1===w.length&&(w[1]=w[0]),"right"===b.at[0]?r.left+=n:"center"===b.at[0]&&(r.left+=n/2),"bottom"===b.at[1]?r.top+=p:"center"===b.at[1]&&(r.top+=p/2),f=c(x.at,n,p),r.left+=f[0],r.top+=f[1],this.each(function(){var e,j,k=a(this),l=k.outerWidth(),m=k.outerHeight(),o=d(this,"marginLeft"),s=d(this,"marginTop"),y=l+o+d(this,"marginRight")+v.width,z=m+s+d(this,"marginBottom")+v.height,A=a.extend({},r),B=c(x.my,k.outerWidth(),k.outerHeight());"right"===b.my[0]?A.left-=l:"center"===b.my[0]&&(A.left-=l/2),"bottom"===b.my[1]?A.top-=m:"center"===b.my[1]&&(A.top-=m/2),A.left+=B[0],A.top+=B[1],a.support.offsetFractions||(A.left=i(A.left),A.top=i(A.top)),e={marginLeft:o,marginTop:s},a.each(["left","top"],function(c,d){a.ui.pos[w[c]]&&a.ui.pos[w[c]][d](A,{targetWidth:n,targetHeight:p,elemWidth:l,elemHeight:m,collisionPosition:e,collisionWidth:y,collisionHeight:z,offset:[f[0]+B[0],f[1]+B[1]],my:b.my,at:b.at,within:u,elem:k})}),b.using&&(j=function(a){var c=q.left-A.left,d=c+n-l,e=q.top-A.top,f=e+p-m,i={target:{element:t,left:q.left,top:q.top,width:n,height:p},element:{element:k,left:A.left,top:A.top,width:l,height:m},horizontal:0>d?"left":c>0?"right":"center",vertical:0>f?"top":e>0?"bottom":"middle"};l>n&&h(c+d)<n&&(i.horizontal="center"),m>p&&h(e+f)<p&&(i.vertical="middle"),i.important=g(h(c),h(d))>g(h(e),h(f))?"horizontal":"vertical",b.using.call(this,a,i)}),k.offset(a.extend(A,{using:j}))})},a.ui.pos={_trigger:function(a,b,c,d){b.elem&&b.elem.trigger({type:c,position:a,positionData:b,triggered:d})},fit:{left:function(b,c){a.ui.pos._trigger(b,c,"posCollide","fitLeft");var d,e=c.within,f=e.isWindow?e.scrollLeft:e.offset.left,h=e.width,i=b.left-c.collisionPosition.marginLeft,j=f-i,k=i+c.collisionWidth-h-f;c.collisionWidth>h?j>0&&0>=k?(d=b.left+j+c.collisionWidth-h-f,b.left+=j-d):b.left=k>0&&0>=j?f:j>k?f+h-c.collisionWidth:f:j>0?b.left+=j:k>0?b.left-=k:b.left=g(b.left-i,b.left),a.ui.pos._trigger(b,c,"posCollided","fitLeft")},top:function(b,c){a.ui.pos._trigger(b,c,"posCollide","fitTop");var d,e=c.within,f=e.isWindow?e.scrollTop:e.offset.top,h=c.within.height,i=b.top-c.collisionPosition.marginTop,j=f-i,k=i+c.collisionHeight-h-f;c.collisionHeight>h?j>0&&0>=k?(d=b.top+j+c.collisionHeight-h-f,b.top+=j-d):b.top=k>0&&0>=j?f:j>k?f+h-c.collisionHeight:f:j>0?b.top+=j:k>0?b.top-=k:b.top=g(b.top-i,b.top),a.ui.pos._trigger(b,c,"posCollided","fitTop")}},flip:{left:function(b,c){a.ui.pos._trigger(b,c,"posCollide","flipLeft");var d,e,f=c.within,g=f.offset.left+f.scrollLeft,i=f.width,j=f.isWindow?f.scrollLeft:f.offset.left,k=b.left-c.collisionPosition.marginLeft,l=k-j,m=k+c.collisionWidth-i-j,n="left"===c.my[0]?-c.elemWidth:"right"===c.my[0]?c.elemWidth:0,o="left"===c.at[0]?c.targetWidth:"right"===c.at[0]?-c.targetWidth:0,p=-2*c.offset[0];0>l?(d=b.left+n+o+p+c.collisionWidth-i-g,(0>d||d<h(l))&&(b.left+=n+o+p)):m>0&&(e=b.left-c.collisionPosition.marginLeft+n+o+p-j,(e>0||h(e)<m)&&(b.left+=n+o+p)),a.ui.pos._trigger(b,c,"posCollided","flipLeft")},top:function(b,c){a.ui.pos._trigger(b,c,"posCollide","flipTop");var d,e,f=c.within,g=f.offset.top+f.scrollTop,i=f.height,j=f.isWindow?f.scrollTop:f.offset.top,k=b.top-c.collisionPosition.marginTop,l=k-j,m=k+c.collisionHeight-i-j,n="top"===c.my[1],o=n?-c.elemHeight:"bottom"===c.my[1]?c.elemHeight:0,p="top"===c.at[1]?c.targetHeight:"bottom"===c.at[1]?-c.targetHeight:0,q=-2*c.offset[1];0>l?(e=b.top+o+p+q+c.collisionHeight-i-g,b.top+o+p+q>l&&(0>e||e<h(l))&&(b.top+=o+p+q)):m>0&&(d=b.top-c.collisionPosition.marginTop+o+p+q-j,b.top+o+p+q>m&&(d>0||h(d)<m)&&(b.top+=o+p+q)),a.ui.pos._trigger(b,c,"posCollided","flipTop")}},flipfit:{left:function(){a.ui.pos.flip.left.apply(this,arguments),a.ui.pos.fit.left.apply(this,arguments)},top:function(){a.ui.pos.flip.top.apply(this,arguments),a.ui.pos.fit.top.apply(this,arguments)}}},function(){var b,c,d,e,f,g=document.getElementsByTagName("body")[0],h=document.createElement("div");b=document.createElement(g?"div":"body"),d={visibility:"hidden",width:0,height:0,border:0,margin:0,background:"none"},g&&a.extend(d,{position:"absolute",left:"-1000px",top:"-1000px"});for(f in d)b.style[f]=d[f];b.appendChild(h),c=g||document.documentElement,c.insertBefore(b,c.firstChild),h.style.cssText="position: absolute; left: 10.7432222px;",e=a(h).offset().left,a.support.offsetFractions=e>10&&11>e,b.innerHTML="",c.removeChild(b)}()}(jQuery),function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery"],a):window.jQuery&&!window.jQuery.fn.iconpicker&&a(window.jQuery)}(function(a){"use strict";var b={isEmpty:function(a){return a===!1||""===a||null===a||void 0===a},isEmptyObject:function(a){return this.isEmpty(a)===!0||0===a.length},isElement:function(b){return a(b).length>0},isString:function(a){return"string"==typeof a||a instanceof String},isArray:function(b){return a.isArray(b)},inArray:function(b,c){return-1!==a.inArray(b,c)},throwError:function(a){throw"Font Awesome Icon Picker Exception: "+a}},c=function(d,e){this._id=c._idCounter++,this.element=a(d).addClass("iconpicker-element"),this._trigger("iconpickerCreate"),this.options=a.extend({},c.defaultOptions,this.element.data(),e),this.options.templates=a.extend({},c.defaultOptions.templates,this.options.templates),this.options.originalPlacement=this.options.placement,this.container=b.isElement(this.options.container)?a(this.options.container):!1,this.container===!1&&(this.container=this.element.is("input")?this.element.parent():this.element),this.container.addClass("iconpicker-container").is(".dropdown-menu")&&(this.options.placement="inline"),this.input=this.element.is("input")?this.element.addClass("iconpicker-input"):!1,this.input===!1&&(this.input=this.container.find(this.options.input)),this.component=this.container.find(this.options.component).addClass("iconpicker-component"),0===this.component.length?this.component=!1:this.component.find("i").addClass(this.options.iconComponentBaseClass),this._createPopover(),this._createIconpicker(),0===this.getAcceptButton().length&&(this.options.mustAccept=!1),this.container.is(".input-group")?this.container.parent().append(this.popover):this.container.append(this.popover),this._bindElementEvents(),this._bindWindowEvents(),this.update(this.options.selected),this.isInline()&&this.show(),this._trigger("iconpickerCreated")};c._idCounter=0,c.defaultOptions={title:!1,selected:!1,defaultValue:!1,placement:"bottom",collision:"none",animation:!0,hideOnSelect:!1,showFooter:!1,searchInFooter:!1,mustAccept:!1,selectedCustomClass:"bg-primary",icons:[],iconBaseClass:"fa",iconComponentBaseClass:"fa fa-fw",iconClassPrefix:"fa-",input:"input",component:".input-group-addon",container:!1,templates:{popover:'<div class="iconpicker-popover popover"><div class="arrow"></div><div class="popover-title"></div><div class="popover-content"></div></div>',footer:'<div class="popover-footer"></div>',buttons:'<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button> <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',search:'<input type="search" class="form-control iconpicker-search" placeholder="Type to filter" />',iconpicker:'<div class="iconpicker"><div class="iconpicker-items"></div></div>',iconpickerItem:'<div class="iconpicker-item"><i></i></div>'}},c.batch=function(b,c){var d=Array.prototype.slice.call(arguments,2);return a(b).each(function(){var b=a(this).data("iconpicker");b&&b[c].apply(b,d)})},c.prototype={constructor:c,options:{},_id:0,_trigger:function(b,c){c=c||{},this.element.trigger(a.extend({type:b,iconpickerInstance:this},c))},_createPopover:function(){this.popover=a(this.options.templates.popover);var c=this.popover.find(".popover-title");if(this.options.title&&c.append(a('<div class="popover-title-text">'+this.options.title+"</div>")),this.options.searchInFooter||b.isEmpty(this.options.templates.buttons)?this.options.title||c.remove():c.append(this.options.templates.search),this.options.showFooter&&!b.isEmpty(this.options.templates.footer)){var d=a(this.options.templates.footer);!b.isEmpty(this.options.templates.search)&&this.options.searchInFooter&&d.append(a(this.options.templates.search)),b.isEmpty(this.options.templates.buttons)||d.append(a(this.options.templates.buttons)),this.popover.append(d)}return this.options.animation===!0&&this.popover.addClass("fade"),this.popover},_createIconpicker:function(){var b=this;this.iconpicker=a(this.options.templates.iconpicker);var c=function(){var c=a(this);c.is("."+b.options.iconBaseClass)&&(c=c.parent()),b._trigger("iconpickerSelect",{iconpickerItem:c,iconpickerValue:b.iconpickerValue}),b.options.mustAccept===!1?(b.update(c.data("iconpickerValue")),b._trigger("iconpickerSelected",{iconpickerItem:this,iconpickerValue:b.iconpickerValue})):b.update(c.data("iconpickerValue"),!0),b.options.hideOnSelect&&b.options.mustAccept===!1&&b.hide()};for(var d in this.options.icons){var e=a(this.options.templates.iconpickerItem);e.find("i").addClass(b.options.iconBaseClass+" "+this.options.iconClassPrefix+this.options.icons[d]),e.data("iconpickerValue",this.options.icons[d]).on("click.iconpicker",c),this.iconpicker.find(".iconpicker-items").append(e.attr("title","."+this.getValue(this.options.icons[d])))}return this.popover.find(".popover-content").append(this.iconpicker),this.iconpicker},_isEventInsideIconpicker:function(b){var c=a(b.target);return c.hasClass("iconpicker-element")&&(!c.hasClass("iconpicker-element")||c.is(this.element))||0!==c.parents(".iconpicker-popover").length?!0:!1},_bindElementEvents:function(){var c=this;this.getSearchInput().on("keyup",function(){c.filter(a(this).val().toLowerCase())}),this.getAcceptButton().on("click.iconpicker",function(){var a=c.iconpicker.find(".iconpicker-selected").get(0);c.update(c.iconpickerValue),c._trigger("iconpickerSelected",{iconpickerItem:a,iconpickerValue:c.iconpickerValue}),c.isInline()||c.hide()}),this.getCancelButton().on("click.iconpicker",function(){c.isInline()||c.hide()}),this.element.on("focus.iconpicker",function(a){c.show(),a.stopPropagation()}),this.hasComponent()&&this.component.on("click.iconpicker",function(){c.toggle()}),this.hasInput()&&this.input.on("keyup.iconpicker",function(a){b.inArray(a.keyCode,[38,40,37,39,16,17,18,9,8,91,93,20,46,186,190,46,78,188,44,86])?c._updateFormGroupStatus(c.getValid(this.value)!==!1):c.update()})},_bindWindowEvents:function(){var b=a(window.document),c=this,d=".iconpicker.inst"+this._id;return a(window).on("resize.iconpicker"+d+" orientationchange.iconpicker"+d,function(){c.popover.hasClass("in")&&c.updatePlacement()}),c.isInline()||b.on("mouseup"+d,function(a){return c._isEventInsideIconpicker(a)||c.isInline()||c.hide(),a.stopPropagation(),a.preventDefault(),!1}),!1},_unbindElementEvents:function(){this.popover.off(".iconpicker"),this.element.off(".iconpicker"),this.hasInput()&&this.input.off(".iconpicker"),this.hasComponent()&&this.component.off(".iconpicker"),this.hasContainer()&&this.container.off(".iconpicker")},_unbindWindowEvents:function(){a(window).off(".iconpicker.inst"+this._id),a(window.document).off(".iconpicker.inst"+this._id)},updatePlacement:function(b,c){b=b||this.options.placement,this.options.placement=b,c=c||this.options.collision,c=c===!0?"flip":c;var d={at:"right bottom",my:"right top",of:this.hasInput()?this.input:this.container,collision:c===!0?"flip":c,within:window};if(this.popover.removeClass("inline topLeftCorner topLeft top topRight topRightCorner rightTop right rightBottom bottomRight bottomRightCorner bottom bottomLeft bottomLeftCorner leftBottom left leftTop"),"object"==typeof b)return this.popover.pos(a.extend({},d,b));switch(b){case"inline":d=!1;break;case"topLeftCorner":d.my="right bottom",d.at="left top";break;case"topLeft":d.my="left bottom",d.at="left top";break;case"top":d.my="center bottom",d.at="center top";break;case"topRight":d.my="right bottom",d.at="right top";break;case"topRightCorner":d.my="left bottom",d.at="right top";break;case"rightTop":d.my="left bottom",d.at="right center";break;case"right":d.my="left center",d.at="right center";break;case"rightBottom":d.my="left top",d.at="right center";break;case"bottomRightCorner":d.my="left top",d.at="right bottom";break;case"bottomRight":d.my="right top",d.at="right bottom";break;case"bottom":d.my="center top",d.at="center bottom";break;case"bottomLeft":d.my="left top",d.at="left bottom";break;case"bottomLeftCorner":d.my="right top",d.at="left bottom";break;case"leftBottom":d.my="right top",d.at="left center";break;case"left":d.my="right center",d.at="left center";break;case"leftTop":d.my="right bottom",d.at="left center";break;default:return!1}return this.popover.css({display:"inline"===this.options.placement?"":"block"}),d!==!1?this.popover.pos(d).css("maxWidth",a(window).width()-this.container.offset().left-5):this.popover.css({top:"auto",right:"auto",bottom:"auto",left:"auto",maxWidth:"none"}),this.popover.addClass(this.options.placement),!0},_updateComponents:function(){if(this.iconpicker.find(".iconpicker-item.iconpicker-selected").removeClass("iconpicker-selected "+this.options.selectedCustomClass),this.iconpicker.find("."+this.options.iconBaseClass+"."+this.options.iconClassPrefix+this.iconpickerValue).parent().addClass("iconpicker-selected "+this.options.selectedCustomClass),this.hasComponent()){var a=this.component.find("i");a.length>0?a.attr("class",this.options.iconComponentBaseClass+" "+this.getValue()):this.component.html(this.getValueHtml())}},_updateFormGroupStatus:function(a){return this.hasInput()?(a!==!1?this.input.parents(".form-group:first").removeClass("has-error"):this.input.parents(".form-group:first").addClass("has-error"),!0):!1},getValid:function(c){b.isString(c)||(c="");var d=""===c;return c=a.trim(c.replace(this.options.iconClassPrefix,"")),b.inArray(c,this.options.icons)||d?c:!1},setValue:function(a){var b=this.getValid(a);return b!==!1?(this.iconpickerValue=b,this._trigger("iconpickerSetValue",{iconpickerValue:b}),this.iconpickerValue):(this._trigger("iconpickerInvalid",{iconpickerValue:a}),!1)},getValue:function(a){return this.options.iconClassPrefix+(a?a:this.iconpickerValue)},getValueHtml:function(){return'<i class="'+this.options.iconBaseClass+" "+this.getValue()+'"></i>'},setSourceValue:function(a){return a=this.setValue(a),a!==!1&&""!==a&&(this.hasInput()?this.input.val(this.getValue()):this.element.data("iconpickerValue",this.getValue()),this._trigger("iconpickerSetSourceValue",{iconpickerValue:a})),a},getSourceValue:function(a){a=a||this.options.defaultValue;var b=a;return b=this.hasInput()?this.input.val():this.element.data("iconpickerValue"),(void 0===b||""===b||null===b||b===!1)&&(b=a),b},hasInput:function(){return this.input!==!1},hasComponent:function(){return this.component!==!1},hasContainer:function(){return this.container!==!1},getAcceptButton:function(){return this.popover.find(".iconpicker-btn-accept")},getCancelButton:function(){return this.popover.find(".iconpicker-btn-cancel")},getSearchInput:function(){return this.popover.find(".iconpicker-search")},filter:function(c){if(b.isEmpty(c))return this.iconpicker.find(".iconpicker-item").show(),a(!1);var d=[];return this.iconpicker.find(".iconpicker-item").each(function(){var b=a(this),e=b.attr("title").toLowerCase(),f=!1;try{f=new RegExp(c,"g")}catch(g){f=!1}f!==!1&&e.match(f)?(d.push(b),b.show()):b.hide()}),d},show:function(){return this.popover.hasClass("in")?!1:(a.iconpicker.batch(a(".iconpicker-popover.in:not(.inline)").not(this.popover),"hide"),this._trigger("iconpickerShow"),this.updatePlacement(),this.popover.addClass("in"),void setTimeout(a.proxy(function(){this.popover.css("display",this.isInline()?"":"block"),this._trigger("iconpickerShown")},this),this.options.animation?300:1))},hide:function(){return this.popover.hasClass("in")?(this._trigger("iconpickerHide"),this.popover.removeClass("in"),void setTimeout(a.proxy(function(){this.popover.css("display","none"),this.getSearchInput().val(""),this.filter(""),this._trigger("iconpickerHidden")},this),this.options.animation?300:1)):!1},toggle:function(){this.popover.is(":visible")?this.hide():this.show(!0)},update:function(a,b){return a=a?a:this.getSourceValue(this.iconpickerValue),this._trigger("iconpickerUpdate"),b===!0?a=this.setValue(a):(a=this.setSourceValue(a),this._updateFormGroupStatus(a!==!1)),a!==!1&&this._updateComponents(),this._trigger("iconpickerUpdated"),a},destroy:function(){this._trigger("iconpickerDestroy"),this.element.removeData("iconpicker").removeData("iconpickerValue").removeClass("iconpicker-element"),this._unbindElementEvents(),this._unbindWindowEvents(),a(this.popover).remove(),this._trigger("iconpickerDestroyed")},disable:function(){return this.hasInput()?(this.input.prop("disabled",!0),!0):!1},enable:function(){return this.hasInput()?(this.input.prop("disabled",!1),!0):!1},isDisabled:function(){return this.hasInput()?this.input.prop("disabled")===!0:!1},isInline:function(){return"inline"===this.options.placement||this.popover.hasClass("inline")}},a.iconpicker=c,a.fn.iconpicker=function(b){return this.each(function(){var d=a(this);d.data("iconpicker")||d.data("iconpicker",new c(this,"object"==typeof b?b:{}))})},c.defaultOptions.icons=["adjust","adn","align-center","align-justify","align-left","align-right","ambulance","anchor","android","angle-double-down","angle-double-left","angle-double-right","angle-double-up","angle-down","angle-left","angle-right","angle-up","apple","archive","arrow-circle-down","arrow-circle-left","arrow-circle-o-down","arrow-circle-o-left","arrow-circle-o-right","arrow-circle-o-up","arrow-circle-right","arrow-circle-up","arrow-down","arrow-left","arrow-right","arrow-up","arrows","arrows-alt","arrows-h","arrows-v","asterisk","automobile","backward","ban","bank","bar-chart-o","barcode","bars","beer","behance","behance-square","bell","bell-o","bitbucket","bitbucket-square","bitcoin","bold","bolt","bomb","book","bookmark","bookmark-o","briefcase","btc","bug","building","building-o","bullhorn","bullseye","cab","calendar","calendar-o","camera","camera-retro","car","caret-down","caret-left","caret-right","caret-square-o-down","caret-square-o-left","caret-square-o-right","caret-square-o-up","caret-up","certificate","chain","chain-broken","check","check-circle","check-circle-o","check-square","check-square-o","chevron-circle-down","chevron-circle-left","chevron-circle-right","chevron-circle-up","chevron-down","chevron-left","chevron-right","chevron-up","child","circle","circle-o","circle-o-notch","circle-thin","clipboard","clock-o","cloud","cloud-download","cloud-upload","cny","code","code-fork","codepen","coffee","cog","cogs","columns","comment","comment-o","comments","comments-o","compass","compress","copy","credit-card","crop","crosshairs","css3","cube","cubes","cut","cutlery","dashboard","database","dedent","delicious","desktop","deviantart","digg","dollar","dot-circle-o","download","dribbble","dropbox","drupal","edit","eject","ellipsis-h","ellipsis-v","empire","envelope","envelope-o","envelope-square","eraser","eur","euro","exchange","exclamation","exclamation-circle","exclamation-triangle","expand","external-link","external-link-square","eye","eye-slash","facebook","facebook-square","fast-backward","fast-forward","fax","female","fighter-jet","file","file-archive-o","file-audio-o","file-code-o","file-excel-o","file-image-o","file-movie-o","file-o","file-pdf-o","file-photo-o","file-picture-o","file-powerpoint-o","file-sound-o","file-text","file-text-o","file-video-o","file-word-o","file-zip-o","files-o","film","filter","fire","fire-extinguisher","flag","flag-checkered","flag-o","flash","flask","flickr","floppy-o","folder","folder-o","folder-open","folder-open-o","font","forward","foursquare","frown-o","gamepad","gavel","gbp","ge","gear","gears","gift","git","git-square","github","github-alt","github-square","gittip","glass","globe","google","google-plus","google-plus-square","graduation-cap","group","h-square","hacker-news","hand-o-down","hand-o-left","hand-o-right","hand-o-up","hdd-o","header","headphones","heart","heart-o","history","home","hospital-o","html5","image","inbox","indent","info","info-circle","inr","instagram","institution","italic","joomla","jpy","jsfiddle","key","keyboard-o","krw","language","laptop","leaf","legal","lemon-o","level-down","level-up","life-bouy","life-ring","life-saver","lightbulb-o","link","linkedin","linkedin-square","linux","list","list-alt","list-ol","list-ul","location-arrow","lock","long-arrow-down","long-arrow-left","long-arrow-right","long-arrow-up","magic","magnet","mail-forward","mail-reply","mail-reply-all","male","map-marker","maxcdn","medkit","meh-o","microphone","microphone-slash","minus","minus-circle","minus-square","minus-square-o","mobile","mobile-phone","money","moon-o","mortar-board","music","navicon","openid","outdent","pagelines","paper-plane","paper-plane-o","paperclip","paragraph","paste","pause","paw","pencil","pencil-square","pencil-square-o","phone","phone-square","photo","picture-o","pied-piper","pied-piper-alt","pied-piper-square","pinterest","pinterest-square","plane","play","play-circle","play-circle-o","plus","plus-circle","plus-square","plus-square-o","power-off","print","puzzle-piece","qq","qrcode","question","question-circle","quote-left","quote-right","ra","random","rebel","recycle","reddit","reddit-square","refresh","renren","reorder","repeat","reply","reply-all","retweet","rmb","road","rocket","rotate-left","rotate-right","rouble","rss","rss-square","rub","ruble","rupee","save","scissors","search","search-minus","search-plus","send","send-o","share","share-alt","share-alt-square","share-square","share-square-o","shield","shopping-cart","sign-in","sign-out","signal","sitemap","skype","slack","sliders","smile-o","sort","sort-alpha-asc","sort-alpha-desc","sort-amount-asc","sort-amount-desc","sort-asc","sort-desc","sort-down","sort-numeric-asc","sort-numeric-desc","sort-up","soundcloud","space-shuttle","spinner","spoon","spotify","square","square-o","stack-exchange","stack-overflow","star","star-half","star-half-empty","star-half-full","star-half-o","star-o","steam","steam-square","step-backward","step-forward","stethoscope","stop","strikethrough","stumbleupon","stumbleupon-circle","subscript","suitcase","sun-o","superscript","support","table","tablet","tachometer","tag","tags","tasks","taxi","tencent-weibo","terminal","text-height","text-width","th","th-large","th-list","thumb-tack","thumbs-down","thumbs-o-down","thumbs-o-up","thumbs-up","ticket","times","times-circle","times-circle-o","tint","toggle-down","toggle-left","toggle-right","toggle-up","trash-o","tree","trello","trophy","truck","try","tumblr","tumblr-square","turkish-lira","twitter","twitter-square","umbrella","underline","undo","university","unlink","unlock","unlock-alt","unsorted","upload","usd","user","user-md","users","video-camera","vimeo-square","vine","vk","volume-down","volume-off","volume-up","warning","wechat","weibo","weixin","wheelchair","windows","won","wordpress","wrench","xing","xing-square","yahoo","yen","youtube","youtube-play","youtube-square"]});;/**
 * Copyright (c) 2007-2015 Ariel Flesler - aflesler<a>gmail<d>com | http://flesler.blogspot.com
 * Licensed under MIT
 * @author Ariel Flesler
 * @version 2.1.2
 */
;(function(f){"use strict";"function"===typeof define&&define.amd?define(["jquery"],f):"undefined"!==typeof module&&module.exports?module.exports=f(require("jquery")):f(jQuery)})(function($){"use strict";function n(a){return!a.nodeName||-1!==$.inArray(a.nodeName.toLowerCase(),["iframe","#document","html","body"])}function h(a){return $.isFunction(a)||$.isPlainObject(a)?a:{top:a,left:a}}var p=$.scrollTo=function(a,d,b){return $(window).scrollTo(a,d,b)};p.defaults={axis:"xy",duration:0,limit:!0};$.fn.scrollTo=function(a,d,b){"object"=== typeof d&&(b=d,d=0);"function"===typeof b&&(b={onAfter:b});"max"===a&&(a=9E9);b=$.extend({},p.defaults,b);d=d||b.duration;var u=b.queue&&1<b.axis.length;u&&(d/=2);b.offset=h(b.offset);b.over=h(b.over);return this.each(function(){function k(a){var k=$.extend({},b,{queue:!0,duration:d,complete:a&&function(){a.call(q,e,b)}});r.animate(f,k)}if(null!==a){var l=n(this),q=l?this.contentWindow||window:this,r=$(q),e=a,f={},t;switch(typeof e){case "number":case "string":if(/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(e)){e= h(e);break}e=l?$(e):$(e,q);case "object":if(e.length===0)return;if(e.is||e.style)t=(e=$(e)).offset()}var v=$.isFunction(b.offset)&&b.offset(q,e)||b.offset;$.each(b.axis.split(""),function(a,c){var d="x"===c?"Left":"Top",m=d.toLowerCase(),g="scroll"+d,h=r[g](),n=p.max(q,c);t?(f[g]=t[m]+(l?0:h-r.offset()[m]),b.margin&&(f[g]-=parseInt(e.css("margin"+d),10)||0,f[g]-=parseInt(e.css("border"+d+"Width"),10)||0),f[g]+=v[m]||0,b.over[m]&&(f[g]+=e["x"===c?"width":"height"]()*b.over[m])):(d=e[m],f[g]=d.slice&& "%"===d.slice(-1)?parseFloat(d)/100*n:d);b.limit&&/^\d+$/.test(f[g])&&(f[g]=0>=f[g]?0:Math.min(f[g],n));!a&&1<b.axis.length&&(h===f[g]?f={}:u&&(k(b.onAfterFirst),f={}))});k(b.onAfter)}})};p.max=function(a,d){var b="x"===d?"Width":"Height",h="scroll"+b;if(!n(a))return a[h]-$(a)[b.toLowerCase()]();var b="client"+b,k=a.ownerDocument||a.document,l=k.documentElement,k=k.body;return Math.max(l[h],k[h])-Math.min(l[b],k[b])};$.Tween.propHooks.scrollLeft=$.Tween.propHooks.scrollTop={get:function(a){return $(a.elem)[a.prop]()}, set:function(a){var d=this.get(a);if(a.options.interrupt&&a._last&&a._last!==d)return $(a.elem).stop();var b=Math.round(a.now);d!==b&&($(a.elem)[a.prop](b),a._last=this.get(a))}};return p});;/**
 * Created by PA25072016 on 6/15/2017.
 */

jQuery(function($){
    $(document).ready(function () {
        if($('.st-flight-search').length > 0){
            var el = $('.st-flight-search');
            el.find('.nav li').click(function () {
                if($(this).hasClass('one_way')){
                    el.addClass('one_way');
                    $('input[name="flight_type"]').val('one_way');
                }else{
                    el.removeClass('one_way');
                    $('input[name="flight_type"]').val('return');
                }
            });
        }

        var flight_data = {
            price_depart: 0,
            price_depart_html: '',
            total_price_depart: 0,
            total_price_depart_html: '',
            tax_price_depart: '',
            enable_tax_depart: 'no',
            price_return: 0,
            price_return_html: '',
            total_price_return: 0,
            total_price_return_html: '',
            tax_price_return: '',
            enable_tax_return: 'no',
            total_price: 0,
            total_price_html: '',
            flight_type: $('.st-booking-list-flight').data('flight_type')
        };

        $('input[name="flight1"]').iCheck('uncheck');
        $('input[name="flight2"]').iCheck('uncheck');
        $('.st-cal-flight-depart').each(function () {
            var t = $(this);
            //$(document).on('click', 'input[name="flight1"]', function(event){
            $('input[name="flight1"]').on('ifChecked', function(event){
                $('.st-cal-flight-depart').removeClass('active');
                t.addClass('active');

                var elink = $(this).closest('li').data('external-link');
                var emode = $(this).closest('li').data('external');
                if(emode == 'on'){
                    $('.flight-book-now').hide();
                    var emessage = $('.flight-message');
                    if($('.e-external-alter').length == 0) {
                        $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').hide();
                        emessage.after('<p class="e-external-alter"><b>'+$(this).closest('li').data('external-text')+'</b></p>');
                        $('.e-external-alter').after('<a href="'+ elink +'" class="btn btn-primary btn-external-link">'+$('.flight-book-now').text()+'</a>');
                    }else{
                        $('.btn-external-link').attr('href', elink);
                    }
                }else{
                    eftype = 'on_way';
                    var eftype = $('.st-booking-list-flight').data('flight_type');
                    if(eftype == 'on_way') {
                        $('.flight-book-now').show();
                        $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').show();
                        if ($('.e-external-alter').length > 0) {
                            $('.e-external-alter, .btn-external-link').remove();
                        }
                    }else{
                        var echeck = 0;
                        var eelink = '#';
                        $('input[name="flight2"]:checked').each(function (el) {
                            if($(this).data('external') == 'on'){
                                echeck = 1;
                                eelink = $(this).closest('li').data('external-link');
                            }else{
                                echeck = 2;
                            }
                        });
                        if(echeck == 0 || echeck == 2){
                            $('.flight-book-now').show();
                            $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').show();
                            if ($('.e-external-alter').length > 0) {
                                $('.e-external-alter, .btn-external-link').remove();
                            }
                        }else{
                            $('.flight-book-now').hide();
                            var emessage = $('.flight-message');
                            if($('.e-external-alter').length == 0) {
                                $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').hide();
                                emessage.after('<p class="e-external-alter"><b>'+$(this).closest('li').data('external-text')+'</b></p>');
                                $('.e-external-alter').after('<a href="'+ eelink +'" class="btn btn-primary btn-external-link">'+$('.flight-book-now').text()+'</a>');
                            }else{
                                $('.btn-external-link').attr('href', eelink);
                            }
                            echeck = 0;
                        }
                    }
                }

                var price_depart = $(this).data('price');
                if(price_depart){
                    flight_data.price_depart = price_depart;
                    flight_data.total_price_depart = flight_data.price_depart;
                    $('.st-booking-select-depart').removeClass('hidden');
                    $('.st-booking-select-depart').find('.fare .price').html(format_money(flight_data.price_depart ));

                    var tax_enable = $(this).data('tax');
                    var tax_amount = $(this).data('tax_amount');
                    if(tax_enable != 'no'){
                        console.log(parseFloat(tax_amount));
                        tax_price = (parseFloat(tax_amount) * parseFloat(flight_data.price_depart))/100;
                        if(tax_price > 0){
                            flight_data.total_price_depart = flight_data.price_depart + tax_price;
                            $('.st-booking-select-depart').find('.tax').removeClass('hidden');

                            $('.st-booking-select-depart').find('.tax .price').html(format_money(tax_price))
                        }else{
                            $('.st-booking-select-depart').find('.tax').addClass('hidden');
                        }
                    }else{
                        $('.st-booking-select-depart').find('.tax').addClass('hidden');
                    }

                    $('.st-booking-select-depart').find('.total .price').html(format_money(flight_data.total_price_depart ));
                    $('.booking-flight-form input[name="depart_id"]').val($(this).data('post_id'));
                    if($(this).data('business') == 1){
                        $('.booking-flight-form input[name="price_class_depart"]').val('business_price');
                    }else{
                        $('.booking-flight-form input[name="price_class_depart"]').val('eco_price');
                    }
                }
                calculate_total_price();
            });
        });

        $('.st-cal-flight-return').each(function () {
            var t = $(this);
            t.find('input[name="flight2"]').on('ifChecked', function(event){
                $('.st-select-item-flight-return').removeClass('active');
                t.addClass('active');

                var elink = $(this).closest('li').data('external-link');
                var emode = $(this).closest('li').data('external');
                if(emode == 'on'){
                    $('.flight-book-now').hide();
                    var emessage = $('.flight-message');
                    if($('.e-external-alter').length == 0) {
                        $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').hide();
                        emessage.after('<p class="e-external-alter"><b>'+$(this).closest('li').data('external-text')+'</b></p>');
                        $('.e-external-alter').after('<a href="'+ elink +'" class="btn btn-primary btn-external-link">'+$('.flight-book-now').text()+'</a>');
                    }
                }else{
                    var echeck = 0;
                    var eelink = '#';
                    $('input[name="flight1"]:checked').each(function (el) {
                        if($(this).data('external') == 'on'){
                            echeck = 1;
                            eelink = $(this).closest('li').data('external-link');
                        }else{
                            echeck = 2;
                        }
                    });
                    if(echeck == 0 || echeck == 2){
                        $('.flight-book-now').show();
                        $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').show();
                        if ($('.e-external-alter').length > 0) {
                            $('.e-external-alter, .btn-external-link').remove();
                        }
                    }else{
                        $('.flight-book-now').hide();
                        var emessage = $('.flight-message');
                        if($('.e-external-alter').length == 0) {
                            $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').hide();
                            emessage.after('<p class="e-external-alter"><b>'+$(this).closest('li').data('external-text')+'</b></p>');
                            $('.e-external-alter').after('<a href="'+ eelink +'" class="btn btn-primary btn-external-link">'+$('.flight-book-now').text()+'</a>');
                        }else{
                            $('.btn-external-link').attr('href', eelink);
                        }
                        echeck = 0;
                    }
                }

                var price_return = $(this).data('price');
                if(price_return){
                    flight_data.price_return = price_return;
                    flight_data.total_price_return = price_return;
                    $('.st-booking-select-return').removeClass('hidden');
                    $('.st-booking-select-return').find('.fare .price').html(format_money(flight_data.price_return ));

                    var tax_enable = $(this).data('tax');
                    var tax_amount = $(this).data('tax_amount');
                    if(tax_enable != 'no'){
                        tax_price = (parseFloat(tax_amount) * flight_data.price_return)/100;
                        if(tax_price > 0){

                            flight_data.total_price_return = flight_data.price_return + tax_price;

                            $('.st-booking-select-return').find('.tax').removeClass('hidden');

                            $('.st-booking-select-return').find('.tax .price').html(format_money(tax_price))
                        }else{
                            $('.st-booking-select-return').find('.tax').addClass('hidden');
                        }
                    }else{
                        $('.st-booking-select-return').find('.tax').addClass('hidden');
                    }

                    $('.st-booking-select-return').find('.total .price').html(format_money(flight_data.total_price_return ));
                    $('.booking-flight-form input[name="return_id"]').val($(this).data('post_id'));
                    if($(this).data('business') == 1){
                        $('.booking-flight-form input[name="price_class_return"]').val('business_price');
                    }else{
                        $('.booking-flight-form input[name="price_class_return"]').val('eco_price');
                    }

                }
                calculate_total_price();
            });
        });

        function calculate_total_price(){

            var passenger = $('input[name="passenger"]').val();
            if(parseInt(passenger) < 1){
                passenger = 1;
            }

            if(flight_data.flight_type == 'on_way'){
                flight_data.total_price = flight_data.total_price_depart * parseInt(passenger);
                flight_data.total_price_html = format_money(flight_data.total_price);
            }else{
                if(parseFloat(flight_data.total_price_depart) > 0 && parseFloat(flight_data.total_price_return) > 0){
                    flight_data.total_price = (parseFloat(flight_data.total_price_depart) + parseFloat(flight_data.total_price_return))*parseInt(passenger);
                    flight_data.total_price_html = format_money(flight_data.total_price);
                }
            }

            if(parseFloat(flight_data.total_price) > 0){
                $('.st-flight-booking .st-flight-total-price .price').html(flight_data.total_price_html);
            }
        }

        function format_money($money) {

            if (!$money) {
                return st_params.free_text;
            }

            $money = st_number_format($money, st_params.booking_currency_precision, st_params.decimal_separator, st_params.thousand_separator);
            var $symbol = st_params.currency_symbol;
            var $money_string = '';

            switch (st_params.currency_position) {
                case "right":
                    $money_string = $money + $symbol;
                    break;
                case "left_space":
                    $money_string = $symbol + " " + $money;
                    break;

                case "right_space":
                    $money_string = $money + " " + $symbol;
                    break;
                case "left":
                default:
                    $money_string = $symbol + $money;
                    break;
            }

            return $money_string;
        }

        function st_number_format(number, decimals, dec_point, thousands_sep) {


            number = (number + '')
                .replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + (Math.round(n * k) / k)
                            .toFixed(prec);
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
                .split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '')
                    .length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1)
                    .join('0');
            }
            return s.join(dec);
        }

        var ww = $(window).width();
        if($('.st-sticky').length > 0 && ww > 991) {
            var offset = $('.st-sticky').offset();
            var topPadding = 15;
            $(window).scroll(function () {
                var header = $('.sticky-wrapper.is-sticky').height();
                if(header == 0){
                    header = $('#top_toolbar').height() + 50;
                }
                var adminbar = $('#wpadminbar').height();

                var list_height = $('.st-booking-list').height();
                var booking_height = $('.st-flight-booking').height();
                if (parseInt($(window).scrollTop()) > (parseInt(offset.top) - adminbar - header - topPadding)) {
                    if (parseInt($(window).scrollTop()) < (list_height - booking_height)) {
                        $('.st-sticky').stop().animate({
                            marginTop: ($(window).scrollTop() - offset.top) + adminbar + header + topPadding
                        });
                    }
                } else {
                    $('.st-sticky').stop().animate({
                        marginTop: 0
                    });
                }
            });
        }

        $('.flight-book-now').on( 'click', function(e){

            var t = $(this);

            var form = $(this).closest('.booking-flight-form');

            var data = form.serialize();
            t.addClass('loading');
            form.find('.flight-message').empty();

            $.ajax({
                dataType: 'json',
                type: 'post',
                data: data,
                url: st_params.ajax_url,
                success: function (res) {
                    t.removeClass('loading');

                    if(typeof res.message != 'undefined'){
                        form.find('.flight-message').append(res.message);
                    }

                    if(typeof res.redirect != 'undefined'){
                        window.location = res.redirect;
                    }
                },
                error: function(e){
                    t.removeClass('loading');
                    console.log(e.responseText);
                }
            });
            return false;
        });

        $('.st-flight-search-form').submit(function(){
            var check = false;
            $(this).find('.required').removeClass('input-error');
            $(this).find('.required').each(function () {
                if($(this).val() == false){
                    $(this).addClass('input-error');
                    check = true;
                }
            });
            var destination = $(this).find('input[name=destination_name]');
            if($(this).find('input[name=origin_name]').val() == destination.val()){
                check = true;
                destination.addClass('input-error');
            }
            if(check) {
                return false;
            }
        });
    });
});;/*
Copyright 2014 Igor Vaynberg

Version: 3.5.2 Timestamp: Sat Nov  1 14:43:36 EDT 2014

This software is licensed under the Apache License, Version 2.0 (the "Apache License") or the GNU
General Public License version 2 (the "GPL License"). You may choose either license to govern your
use of this software only upon the condition that you accept all of the terms of either the Apache
License or the GPL License.

You may obtain a copy of the Apache License and the GPL License at:

http://www.apache.org/licenses/LICENSE-2.0
http://www.gnu.org/licenses/gpl-2.0.html

Unless required by applicable law or agreed to in writing, software distributed under the Apache License
or the GPL Licesnse is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
either express or implied. See the Apache License and the GPL License for the specific language governing
permissions and limitations under the Apache License and the GPL License.
*/
!function(a){"undefined"==typeof a.fn.each2&&a.extend(a.fn,{each2:function(b){for(var c=a([0]),d=-1,e=this.length;++d<e&&(c.context=c[0]=this[d])&&b.call(c[0],d,c)!==!1;);return this}})}(jQuery),function(a,b){"use strict";function n(b){var c=a(document.createTextNode(""));b.before(c),c.before(b),c.remove()}function o(a){function b(a){return m[a]||a}return a.replace(/[^\u0000-\u007E]/g,b)}function p(a,b){for(var c=0,d=b.length;d>c;c+=1)if(r(a,b[c]))return c;return-1}function q(){var b=a(l);b.appendTo(document.body);var c={width:b.width()-b[0].clientWidth,height:b.height()-b[0].clientHeight};return b.remove(),c}function r(a,c){return a===c?!0:a===b||c===b?!1:null===a||null===c?!1:a.constructor===String?a+""==c+"":c.constructor===String?c+""==a+"":!1}function s(a,b,c){var d,e,f;if(null===a||a.length<1)return[];for(d=a.split(b),e=0,f=d.length;f>e;e+=1)d[e]=c(d[e]);return d}function t(a){return a.outerWidth(!1)-a.width()}function u(c){var d="keyup-change-value";c.on("keydown",function(){a.data(c,d)===b&&a.data(c,d,c.val())}),c.on("keyup",function(){var e=a.data(c,d);e!==b&&c.val()!==e&&(a.removeData(c,d),c.trigger("keyup-change"))})}function v(c){c.on("mousemove",function(c){var d=h;(d===b||d.x!==c.pageX||d.y!==c.pageY)&&a(c.target).trigger("mousemove-filtered",c)})}function w(a,c,d){d=d||b;var e;return function(){var b=arguments;window.clearTimeout(e),e=window.setTimeout(function(){c.apply(d,b)},a)}}function x(a,b){var c=w(a,function(a){b.trigger("scroll-debounced",a)});b.on("scroll",function(a){p(a.target,b.get())>=0&&c(a)})}function y(a){a[0]!==document.activeElement&&window.setTimeout(function(){var d,b=a[0],c=a.val().length;a.focus();var e=b.offsetWidth>0||b.offsetHeight>0;e&&b===document.activeElement&&(b.setSelectionRange?b.setSelectionRange(c,c):b.createTextRange&&(d=b.createTextRange(),d.collapse(!1),d.select()))},0)}function z(b){b=a(b)[0];var c=0,d=0;if("selectionStart"in b)c=b.selectionStart,d=b.selectionEnd-c;else if("selection"in document){b.focus();var e=document.selection.createRange();d=document.selection.createRange().text.length,e.moveStart("character",-b.value.length),c=e.text.length-d}return{offset:c,length:d}}function A(a){a.preventDefault(),a.stopPropagation()}function B(a){a.preventDefault(),a.stopImmediatePropagation()}function C(b){if(!g){var c=b[0].currentStyle||window.getComputedStyle(b[0],null);g=a(document.createElement("div")).css({position:"absolute",left:"-10000px",top:"-10000px",display:"none",fontSize:c.fontSize,fontFamily:c.fontFamily,fontStyle:c.fontStyle,fontWeight:c.fontWeight,letterSpacing:c.letterSpacing,textTransform:c.textTransform,whiteSpace:"nowrap"}),g.attr("class","select2-sizer"),a(document.body).append(g)}return g.text(b.val()),g.width()}function D(b,c,d){var e,g,f=[];e=a.trim(b.attr("class")),e&&(e=""+e,a(e.split(/\s+/)).each2(function(){0===this.indexOf("select2-")&&f.push(this)})),e=a.trim(c.attr("class")),e&&(e=""+e,a(e.split(/\s+/)).each2(function(){0!==this.indexOf("select2-")&&(g=d(this),g&&f.push(g))})),b.attr("class",f.join(" "))}function E(a,b,c,d){var e=o(a.toUpperCase()).indexOf(o(b.toUpperCase())),f=b.length;return 0>e?(c.push(d(a)),void 0):(c.push(d(a.substring(0,e))),c.push("<span class='select2-match'>"),c.push(d(a.substring(e,e+f))),c.push("</span>"),c.push(d(a.substring(e+f,a.length))),void 0)}function F(a){var b={"\\":"&#92;","&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;","/":"&#47;"};return String(a).replace(/[&<>"'\/\\]/g,function(a){return b[a]})}function G(c){var d,e=null,f=c.quietMillis||100,g=c.url,h=this;return function(i){window.clearTimeout(d),d=window.setTimeout(function(){var d=c.data,f=g,j=c.transport||a.fn.select2.ajaxDefaults.transport,k={type:c.type||"GET",cache:c.cache||!1,jsonpCallback:c.jsonpCallback||b,dataType:c.dataType||"json"},l=a.extend({},a.fn.select2.ajaxDefaults.params,k);d=d?d.call(h,i.term,i.page,i.context):null,f="function"==typeof f?f.call(h,i.term,i.page,i.context):f,e&&"function"==typeof e.abort&&e.abort(),c.params&&(a.isFunction(c.params)?a.extend(l,c.params.call(h)):a.extend(l,c.params)),a.extend(l,{url:f,dataType:c.dataType,data:d,success:function(a){var b=c.results(a,i.page,i);i.callback(b)},error:function(a,b,c){var d={hasError:!0,jqXHR:a,textStatus:b,errorThrown:c};i.callback(d)}}),e=j.call(h,l)},f)}}function H(b){var d,e,c=b,f=function(a){return""+a.text};a.isArray(c)&&(e=c,c={results:e}),a.isFunction(c)===!1&&(e=c,c=function(){return e});var g=c();return g.text&&(f=g.text,a.isFunction(f)||(d=g.text,f=function(a){return a[d]})),function(b){var g,d=b.term,e={results:[]};return""===d?(b.callback(c()),void 0):(g=function(c,e){var h,i;if(c=c[0],c.children){h={};for(i in c)c.hasOwnProperty(i)&&(h[i]=c[i]);h.children=[],a(c.children).each2(function(a,b){g(b,h.children)}),(h.children.length||b.matcher(d,f(h),c))&&e.push(h)}else b.matcher(d,f(c),c)&&e.push(c)},a(c().results).each2(function(a,b){g(b,e.results)}),b.callback(e),void 0)}}function I(c){var d=a.isFunction(c);return function(e){var f=e.term,g={results:[]},h=d?c(e):c;a.isArray(h)&&(a(h).each(function(){var a=this.text!==b,c=a?this.text:this;(""===f||e.matcher(f,c))&&g.results.push(a?this:{id:this,text:this})}),e.callback(g))}}function J(b,c){if(a.isFunction(b))return!0;if(!b)return!1;if("string"==typeof b)return!0;throw new Error(c+" must be a string, function, or falsy value")}function K(b,c){if(a.isFunction(b)){var d=Array.prototype.slice.call(arguments,2);return b.apply(c,d)}return b}function L(b){var c=0;return a.each(b,function(a,b){b.children?c+=L(b.children):c++}),c}function M(a,c,d,e){var h,i,j,k,l,f=a,g=!1;if(!e.createSearchChoice||!e.tokenSeparators||e.tokenSeparators.length<1)return b;for(;;){for(i=-1,j=0,k=e.tokenSeparators.length;k>j&&(l=e.tokenSeparators[j],i=a.indexOf(l),!(i>=0));j++);if(0>i)break;if(h=a.substring(0,i),a=a.substring(i+l.length),h.length>0&&(h=e.createSearchChoice.call(this,h,c),h!==b&&null!==h&&e.id(h)!==b&&null!==e.id(h))){for(g=!1,j=0,k=c.length;k>j;j++)if(r(e.id(h),e.id(c[j]))){g=!0;break}g||d(h)}}return f!==a?a:void 0}function N(){var b=this;a.each(arguments,function(a,c){b[c].remove(),b[c]=null})}function O(b,c){var d=function(){};return d.prototype=new b,d.prototype.constructor=d,d.prototype.parent=b.prototype,d.prototype=a.extend(d.prototype,c),d}if(window.Select2===b){var c,d,e,f,g,i,j,h={x:0,y:0},k={TAB:9,ENTER:13,ESC:27,SPACE:32,LEFT:37,UP:38,RIGHT:39,DOWN:40,SHIFT:16,CTRL:17,ALT:18,PAGE_UP:33,PAGE_DOWN:34,HOME:36,END:35,BACKSPACE:8,DELETE:46,isArrow:function(a){switch(a=a.which?a.which:a){case k.LEFT:case k.RIGHT:case k.UP:case k.DOWN:return!0}return!1},isControl:function(a){var b=a.which;switch(b){case k.SHIFT:case k.CTRL:case k.ALT:return!0}return a.metaKey?!0:!1},isFunctionKey:function(a){return a=a.which?a.which:a,a>=112&&123>=a}},l="<div class='select2-measure-scrollbar'></div>",m={"\u24b6":"A","\uff21":"A","\xc0":"A","\xc1":"A","\xc2":"A","\u1ea6":"A","\u1ea4":"A","\u1eaa":"A","\u1ea8":"A","\xc3":"A","\u0100":"A","\u0102":"A","\u1eb0":"A","\u1eae":"A","\u1eb4":"A","\u1eb2":"A","\u0226":"A","\u01e0":"A","\xc4":"A","\u01de":"A","\u1ea2":"A","\xc5":"A","\u01fa":"A","\u01cd":"A","\u0200":"A","\u0202":"A","\u1ea0":"A","\u1eac":"A","\u1eb6":"A","\u1e00":"A","\u0104":"A","\u023a":"A","\u2c6f":"A","\ua732":"AA","\xc6":"AE","\u01fc":"AE","\u01e2":"AE","\ua734":"AO","\ua736":"AU","\ua738":"AV","\ua73a":"AV","\ua73c":"AY","\u24b7":"B","\uff22":"B","\u1e02":"B","\u1e04":"B","\u1e06":"B","\u0243":"B","\u0182":"B","\u0181":"B","\u24b8":"C","\uff23":"C","\u0106":"C","\u0108":"C","\u010a":"C","\u010c":"C","\xc7":"C","\u1e08":"C","\u0187":"C","\u023b":"C","\ua73e":"C","\u24b9":"D","\uff24":"D","\u1e0a":"D","\u010e":"D","\u1e0c":"D","\u1e10":"D","\u1e12":"D","\u1e0e":"D","\u0110":"D","\u018b":"D","\u018a":"D","\u0189":"D","\ua779":"D","\u01f1":"DZ","\u01c4":"DZ","\u01f2":"Dz","\u01c5":"Dz","\u24ba":"E","\uff25":"E","\xc8":"E","\xc9":"E","\xca":"E","\u1ec0":"E","\u1ebe":"E","\u1ec4":"E","\u1ec2":"E","\u1ebc":"E","\u0112":"E","\u1e14":"E","\u1e16":"E","\u0114":"E","\u0116":"E","\xcb":"E","\u1eba":"E","\u011a":"E","\u0204":"E","\u0206":"E","\u1eb8":"E","\u1ec6":"E","\u0228":"E","\u1e1c":"E","\u0118":"E","\u1e18":"E","\u1e1a":"E","\u0190":"E","\u018e":"E","\u24bb":"F","\uff26":"F","\u1e1e":"F","\u0191":"F","\ua77b":"F","\u24bc":"G","\uff27":"G","\u01f4":"G","\u011c":"G","\u1e20":"G","\u011e":"G","\u0120":"G","\u01e6":"G","\u0122":"G","\u01e4":"G","\u0193":"G","\ua7a0":"G","\ua77d":"G","\ua77e":"G","\u24bd":"H","\uff28":"H","\u0124":"H","\u1e22":"H","\u1e26":"H","\u021e":"H","\u1e24":"H","\u1e28":"H","\u1e2a":"H","\u0126":"H","\u2c67":"H","\u2c75":"H","\ua78d":"H","\u24be":"I","\uff29":"I","\xcc":"I","\xcd":"I","\xce":"I","\u0128":"I","\u012a":"I","\u012c":"I","\u0130":"I","\xcf":"I","\u1e2e":"I","\u1ec8":"I","\u01cf":"I","\u0208":"I","\u020a":"I","\u1eca":"I","\u012e":"I","\u1e2c":"I","\u0197":"I","\u24bf":"J","\uff2a":"J","\u0134":"J","\u0248":"J","\u24c0":"K","\uff2b":"K","\u1e30":"K","\u01e8":"K","\u1e32":"K","\u0136":"K","\u1e34":"K","\u0198":"K","\u2c69":"K","\ua740":"K","\ua742":"K","\ua744":"K","\ua7a2":"K","\u24c1":"L","\uff2c":"L","\u013f":"L","\u0139":"L","\u013d":"L","\u1e36":"L","\u1e38":"L","\u013b":"L","\u1e3c":"L","\u1e3a":"L","\u0141":"L","\u023d":"L","\u2c62":"L","\u2c60":"L","\ua748":"L","\ua746":"L","\ua780":"L","\u01c7":"LJ","\u01c8":"Lj","\u24c2":"M","\uff2d":"M","\u1e3e":"M","\u1e40":"M","\u1e42":"M","\u2c6e":"M","\u019c":"M","\u24c3":"N","\uff2e":"N","\u01f8":"N","\u0143":"N","\xd1":"N","\u1e44":"N","\u0147":"N","\u1e46":"N","\u0145":"N","\u1e4a":"N","\u1e48":"N","\u0220":"N","\u019d":"N","\ua790":"N","\ua7a4":"N","\u01ca":"NJ","\u01cb":"Nj","\u24c4":"O","\uff2f":"O","\xd2":"O","\xd3":"O","\xd4":"O","\u1ed2":"O","\u1ed0":"O","\u1ed6":"O","\u1ed4":"O","\xd5":"O","\u1e4c":"O","\u022c":"O","\u1e4e":"O","\u014c":"O","\u1e50":"O","\u1e52":"O","\u014e":"O","\u022e":"O","\u0230":"O","\xd6":"O","\u022a":"O","\u1ece":"O","\u0150":"O","\u01d1":"O","\u020c":"O","\u020e":"O","\u01a0":"O","\u1edc":"O","\u1eda":"O","\u1ee0":"O","\u1ede":"O","\u1ee2":"O","\u1ecc":"O","\u1ed8":"O","\u01ea":"O","\u01ec":"O","\xd8":"O","\u01fe":"O","\u0186":"O","\u019f":"O","\ua74a":"O","\ua74c":"O","\u01a2":"OI","\ua74e":"OO","\u0222":"OU","\u24c5":"P","\uff30":"P","\u1e54":"P","\u1e56":"P","\u01a4":"P","\u2c63":"P","\ua750":"P","\ua752":"P","\ua754":"P","\u24c6":"Q","\uff31":"Q","\ua756":"Q","\ua758":"Q","\u024a":"Q","\u24c7":"R","\uff32":"R","\u0154":"R","\u1e58":"R","\u0158":"R","\u0210":"R","\u0212":"R","\u1e5a":"R","\u1e5c":"R","\u0156":"R","\u1e5e":"R","\u024c":"R","\u2c64":"R","\ua75a":"R","\ua7a6":"R","\ua782":"R","\u24c8":"S","\uff33":"S","\u1e9e":"S","\u015a":"S","\u1e64":"S","\u015c":"S","\u1e60":"S","\u0160":"S","\u1e66":"S","\u1e62":"S","\u1e68":"S","\u0218":"S","\u015e":"S","\u2c7e":"S","\ua7a8":"S","\ua784":"S","\u24c9":"T","\uff34":"T","\u1e6a":"T","\u0164":"T","\u1e6c":"T","\u021a":"T","\u0162":"T","\u1e70":"T","\u1e6e":"T","\u0166":"T","\u01ac":"T","\u01ae":"T","\u023e":"T","\ua786":"T","\ua728":"TZ","\u24ca":"U","\uff35":"U","\xd9":"U","\xda":"U","\xdb":"U","\u0168":"U","\u1e78":"U","\u016a":"U","\u1e7a":"U","\u016c":"U","\xdc":"U","\u01db":"U","\u01d7":"U","\u01d5":"U","\u01d9":"U","\u1ee6":"U","\u016e":"U","\u0170":"U","\u01d3":"U","\u0214":"U","\u0216":"U","\u01af":"U","\u1eea":"U","\u1ee8":"U","\u1eee":"U","\u1eec":"U","\u1ef0":"U","\u1ee4":"U","\u1e72":"U","\u0172":"U","\u1e76":"U","\u1e74":"U","\u0244":"U","\u24cb":"V","\uff36":"V","\u1e7c":"V","\u1e7e":"V","\u01b2":"V","\ua75e":"V","\u0245":"V","\ua760":"VY","\u24cc":"W","\uff37":"W","\u1e80":"W","\u1e82":"W","\u0174":"W","\u1e86":"W","\u1e84":"W","\u1e88":"W","\u2c72":"W","\u24cd":"X","\uff38":"X","\u1e8a":"X","\u1e8c":"X","\u24ce":"Y","\uff39":"Y","\u1ef2":"Y","\xdd":"Y","\u0176":"Y","\u1ef8":"Y","\u0232":"Y","\u1e8e":"Y","\u0178":"Y","\u1ef6":"Y","\u1ef4":"Y","\u01b3":"Y","\u024e":"Y","\u1efe":"Y","\u24cf":"Z","\uff3a":"Z","\u0179":"Z","\u1e90":"Z","\u017b":"Z","\u017d":"Z","\u1e92":"Z","\u1e94":"Z","\u01b5":"Z","\u0224":"Z","\u2c7f":"Z","\u2c6b":"Z","\ua762":"Z","\u24d0":"a","\uff41":"a","\u1e9a":"a","\xe0":"a","\xe1":"a","\xe2":"a","\u1ea7":"a","\u1ea5":"a","\u1eab":"a","\u1ea9":"a","\xe3":"a","\u0101":"a","\u0103":"a","\u1eb1":"a","\u1eaf":"a","\u1eb5":"a","\u1eb3":"a","\u0227":"a","\u01e1":"a","\xe4":"a","\u01df":"a","\u1ea3":"a","\xe5":"a","\u01fb":"a","\u01ce":"a","\u0201":"a","\u0203":"a","\u1ea1":"a","\u1ead":"a","\u1eb7":"a","\u1e01":"a","\u0105":"a","\u2c65":"a","\u0250":"a","\ua733":"aa","\xe6":"ae","\u01fd":"ae","\u01e3":"ae","\ua735":"ao","\ua737":"au","\ua739":"av","\ua73b":"av","\ua73d":"ay","\u24d1":"b","\uff42":"b","\u1e03":"b","\u1e05":"b","\u1e07":"b","\u0180":"b","\u0183":"b","\u0253":"b","\u24d2":"c","\uff43":"c","\u0107":"c","\u0109":"c","\u010b":"c","\u010d":"c","\xe7":"c","\u1e09":"c","\u0188":"c","\u023c":"c","\ua73f":"c","\u2184":"c","\u24d3":"d","\uff44":"d","\u1e0b":"d","\u010f":"d","\u1e0d":"d","\u1e11":"d","\u1e13":"d","\u1e0f":"d","\u0111":"d","\u018c":"d","\u0256":"d","\u0257":"d","\ua77a":"d","\u01f3":"dz","\u01c6":"dz","\u24d4":"e","\uff45":"e","\xe8":"e","\xe9":"e","\xea":"e","\u1ec1":"e","\u1ebf":"e","\u1ec5":"e","\u1ec3":"e","\u1ebd":"e","\u0113":"e","\u1e15":"e","\u1e17":"e","\u0115":"e","\u0117":"e","\xeb":"e","\u1ebb":"e","\u011b":"e","\u0205":"e","\u0207":"e","\u1eb9":"e","\u1ec7":"e","\u0229":"e","\u1e1d":"e","\u0119":"e","\u1e19":"e","\u1e1b":"e","\u0247":"e","\u025b":"e","\u01dd":"e","\u24d5":"f","\uff46":"f","\u1e1f":"f","\u0192":"f","\ua77c":"f","\u24d6":"g","\uff47":"g","\u01f5":"g","\u011d":"g","\u1e21":"g","\u011f":"g","\u0121":"g","\u01e7":"g","\u0123":"g","\u01e5":"g","\u0260":"g","\ua7a1":"g","\u1d79":"g","\ua77f":"g","\u24d7":"h","\uff48":"h","\u0125":"h","\u1e23":"h","\u1e27":"h","\u021f":"h","\u1e25":"h","\u1e29":"h","\u1e2b":"h","\u1e96":"h","\u0127":"h","\u2c68":"h","\u2c76":"h","\u0265":"h","\u0195":"hv","\u24d8":"i","\uff49":"i","\xec":"i","\xed":"i","\xee":"i","\u0129":"i","\u012b":"i","\u012d":"i","\xef":"i","\u1e2f":"i","\u1ec9":"i","\u01d0":"i","\u0209":"i","\u020b":"i","\u1ecb":"i","\u012f":"i","\u1e2d":"i","\u0268":"i","\u0131":"i","\u24d9":"j","\uff4a":"j","\u0135":"j","\u01f0":"j","\u0249":"j","\u24da":"k","\uff4b":"k","\u1e31":"k","\u01e9":"k","\u1e33":"k","\u0137":"k","\u1e35":"k","\u0199":"k","\u2c6a":"k","\ua741":"k","\ua743":"k","\ua745":"k","\ua7a3":"k","\u24db":"l","\uff4c":"l","\u0140":"l","\u013a":"l","\u013e":"l","\u1e37":"l","\u1e39":"l","\u013c":"l","\u1e3d":"l","\u1e3b":"l","\u017f":"l","\u0142":"l","\u019a":"l","\u026b":"l","\u2c61":"l","\ua749":"l","\ua781":"l","\ua747":"l","\u01c9":"lj","\u24dc":"m","\uff4d":"m","\u1e3f":"m","\u1e41":"m","\u1e43":"m","\u0271":"m","\u026f":"m","\u24dd":"n","\uff4e":"n","\u01f9":"n","\u0144":"n","\xf1":"n","\u1e45":"n","\u0148":"n","\u1e47":"n","\u0146":"n","\u1e4b":"n","\u1e49":"n","\u019e":"n","\u0272":"n","\u0149":"n","\ua791":"n","\ua7a5":"n","\u01cc":"nj","\u24de":"o","\uff4f":"o","\xf2":"o","\xf3":"o","\xf4":"o","\u1ed3":"o","\u1ed1":"o","\u1ed7":"o","\u1ed5":"o","\xf5":"o","\u1e4d":"o","\u022d":"o","\u1e4f":"o","\u014d":"o","\u1e51":"o","\u1e53":"o","\u014f":"o","\u022f":"o","\u0231":"o","\xf6":"o","\u022b":"o","\u1ecf":"o","\u0151":"o","\u01d2":"o","\u020d":"o","\u020f":"o","\u01a1":"o","\u1edd":"o","\u1edb":"o","\u1ee1":"o","\u1edf":"o","\u1ee3":"o","\u1ecd":"o","\u1ed9":"o","\u01eb":"o","\u01ed":"o","\xf8":"o","\u01ff":"o","\u0254":"o","\ua74b":"o","\ua74d":"o","\u0275":"o","\u01a3":"oi","\u0223":"ou","\ua74f":"oo","\u24df":"p","\uff50":"p","\u1e55":"p","\u1e57":"p","\u01a5":"p","\u1d7d":"p","\ua751":"p","\ua753":"p","\ua755":"p","\u24e0":"q","\uff51":"q","\u024b":"q","\ua757":"q","\ua759":"q","\u24e1":"r","\uff52":"r","\u0155":"r","\u1e59":"r","\u0159":"r","\u0211":"r","\u0213":"r","\u1e5b":"r","\u1e5d":"r","\u0157":"r","\u1e5f":"r","\u024d":"r","\u027d":"r","\ua75b":"r","\ua7a7":"r","\ua783":"r","\u24e2":"s","\uff53":"s","\xdf":"s","\u015b":"s","\u1e65":"s","\u015d":"s","\u1e61":"s","\u0161":"s","\u1e67":"s","\u1e63":"s","\u1e69":"s","\u0219":"s","\u015f":"s","\u023f":"s","\ua7a9":"s","\ua785":"s","\u1e9b":"s","\u24e3":"t","\uff54":"t","\u1e6b":"t","\u1e97":"t","\u0165":"t","\u1e6d":"t","\u021b":"t","\u0163":"t","\u1e71":"t","\u1e6f":"t","\u0167":"t","\u01ad":"t","\u0288":"t","\u2c66":"t","\ua787":"t","\ua729":"tz","\u24e4":"u","\uff55":"u","\xf9":"u","\xfa":"u","\xfb":"u","\u0169":"u","\u1e79":"u","\u016b":"u","\u1e7b":"u","\u016d":"u","\xfc":"u","\u01dc":"u","\u01d8":"u","\u01d6":"u","\u01da":"u","\u1ee7":"u","\u016f":"u","\u0171":"u","\u01d4":"u","\u0215":"u","\u0217":"u","\u01b0":"u","\u1eeb":"u","\u1ee9":"u","\u1eef":"u","\u1eed":"u","\u1ef1":"u","\u1ee5":"u","\u1e73":"u","\u0173":"u","\u1e77":"u","\u1e75":"u","\u0289":"u","\u24e5":"v","\uff56":"v","\u1e7d":"v","\u1e7f":"v","\u028b":"v","\ua75f":"v","\u028c":"v","\ua761":"vy","\u24e6":"w","\uff57":"w","\u1e81":"w","\u1e83":"w","\u0175":"w","\u1e87":"w","\u1e85":"w","\u1e98":"w","\u1e89":"w","\u2c73":"w","\u24e7":"x","\uff58":"x","\u1e8b":"x","\u1e8d":"x","\u24e8":"y","\uff59":"y","\u1ef3":"y","\xfd":"y","\u0177":"y","\u1ef9":"y","\u0233":"y","\u1e8f":"y","\xff":"y","\u1ef7":"y","\u1e99":"y","\u1ef5":"y","\u01b4":"y","\u024f":"y","\u1eff":"y","\u24e9":"z","\uff5a":"z","\u017a":"z","\u1e91":"z","\u017c":"z","\u017e":"z","\u1e93":"z","\u1e95":"z","\u01b6":"z","\u0225":"z","\u0240":"z","\u2c6c":"z","\ua763":"z","\u0386":"\u0391","\u0388":"\u0395","\u0389":"\u0397","\u038a":"\u0399","\u03aa":"\u0399","\u038c":"\u039f","\u038e":"\u03a5","\u03ab":"\u03a5","\u038f":"\u03a9","\u03ac":"\u03b1","\u03ad":"\u03b5","\u03ae":"\u03b7","\u03af":"\u03b9","\u03ca":"\u03b9","\u0390":"\u03b9","\u03cc":"\u03bf","\u03cd":"\u03c5","\u03cb":"\u03c5","\u03b0":"\u03c5","\u03c9":"\u03c9","\u03c2":"\u03c3"};i=a(document),f=function(){var a=1;return function(){return a++}}(),c=O(Object,{bind:function(a){var b=this;return function(){a.apply(b,arguments)}},init:function(c){var d,e,g=".select2-results";this.opts=c=this.prepareOpts(c),this.id=c.id,c.element.data("select2")!==b&&null!==c.element.data("select2")&&c.element.data("select2").destroy(),this.container=this.createContainer(),this.liveRegion=a(".select2-hidden-accessible"),0==this.liveRegion.length&&(this.liveRegion=a("<span>",{role:"status","aria-live":"polite"}).addClass("select2-hidden-accessible").appendTo(document.body)),this.containerId="s2id_"+(c.element.attr("id")||"autogen"+f()),this.containerEventName=this.containerId.replace(/([.])/g,"_").replace(/([;&,\-\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g,"\\$1"),this.container.attr("id",this.containerId),this.container.attr("title",c.element.attr("title")),this.body=a(document.body),D(this.container,this.opts.element,this.opts.adaptContainerCssClass),this.container.attr("style",c.element.attr("style")),this.container.css(K(c.containerCss,this.opts.element)),this.container.addClass(K(c.containerCssClass,this.opts.element)),this.elementTabIndex=this.opts.element.attr("tabindex"),this.opts.element.data("select2",this).attr("tabindex","-1").before(this.container).on("click.select2",A),this.container.data("select2",this),this.dropdown=this.container.find(".select2-drop"),D(this.dropdown,this.opts.element,this.opts.adaptDropdownCssClass),this.dropdown.addClass(K(c.dropdownCssClass,this.opts.element)),this.dropdown.data("select2",this),this.dropdown.on("click",A),this.results=d=this.container.find(g),this.search=e=this.container.find("input.select2-input"),this.queryCount=0,this.resultsPage=0,this.context=null,this.initContainer(),this.container.on("click",A),v(this.results),this.dropdown.on("mousemove-filtered",g,this.bind(this.highlightUnderEvent)),this.dropdown.on("touchstart touchmove touchend",g,this.bind(function(a){this._touchEvent=!0,this.highlightUnderEvent(a)})),this.dropdown.on("touchmove",g,this.bind(this.touchMoved)),this.dropdown.on("touchstart touchend",g,this.bind(this.clearTouchMoved)),this.dropdown.on("click",this.bind(function(){this._touchEvent&&(this._touchEvent=!1,this.selectHighlighted())})),x(80,this.results),this.dropdown.on("scroll-debounced",g,this.bind(this.loadMoreIfNeeded)),a(this.container).on("change",".select2-input",function(a){a.stopPropagation()}),a(this.dropdown).on("change",".select2-input",function(a){a.stopPropagation()}),a.fn.mousewheel&&d.mousewheel(function(a,b,c,e){var f=d.scrollTop();e>0&&0>=f-e?(d.scrollTop(0),A(a)):0>e&&d.get(0).scrollHeight-d.scrollTop()+e<=d.height()&&(d.scrollTop(d.get(0).scrollHeight-d.height()),A(a))}),u(e),e.on("keyup-change input paste",this.bind(this.updateResults)),e.on("focus",function(){e.addClass("select2-focused")}),e.on("blur",function(){e.removeClass("select2-focused")}),this.dropdown.on("mouseup",g,this.bind(function(b){a(b.target).closest(".select2-result-selectable").length>0&&(this.highlightUnderEvent(b),this.selectHighlighted(b))})),this.dropdown.on("click mouseup mousedown touchstart touchend focusin",function(a){a.stopPropagation()}),this.nextSearchTerm=b,a.isFunction(this.opts.initSelection)&&(this.initSelection(),this.monitorSource()),null!==c.maximumInputLength&&this.search.attr("maxlength",c.maximumInputLength);var h=c.element.prop("disabled");h===b&&(h=!1),this.enable(!h);var i=c.element.prop("readonly");i===b&&(i=!1),this.readonly(i),j=j||q(),this.autofocus=c.element.prop("autofocus"),c.element.prop("autofocus",!1),this.autofocus&&this.focus(),this.search.attr("placeholder",c.searchInputPlaceholder)},destroy:function(){var a=this.opts.element,c=a.data("select2"),d=this;this.close(),a.length&&a[0].detachEvent&&d._sync&&a.each(function(){d._sync&&this.detachEvent("onpropertychange",d._sync)}),this.propertyObserver&&(this.propertyObserver.disconnect(),this.propertyObserver=null),this._sync=null,c!==b&&(c.container.remove(),c.liveRegion.remove(),c.dropdown.remove(),a.show().removeData("select2").off(".select2").prop("autofocus",this.autofocus||!1),this.elementTabIndex?a.attr({tabindex:this.elementTabIndex}):a.removeAttr("tabindex"),a.show()),N.call(this,"container","liveRegion","dropdown","results","search")},optionToData:function(a){return a.is("option")?{id:a.prop("value"),text:a.text(),element:a.get(),css:a.attr("class"),disabled:a.prop("disabled"),locked:r(a.attr("locked"),"locked")||r(a.data("locked"),!0)}:a.is("optgroup")?{text:a.attr("label"),children:[],element:a.get(),css:a.attr("class")}:void 0},prepareOpts:function(c){var d,e,g,h,i=this;if(d=c.element,"select"===d.get(0).tagName.toLowerCase()&&(this.select=e=c.element),e&&a.each(["id","multiple","ajax","query","createSearchChoice","initSelection","data","tags"],function(){if(this in c)throw new Error("Option '"+this+"' is not allowed for Select2 when attached to a <select> element.")}),c=a.extend({},{populateResults:function(d,e,g){var h,j=this.opts.id,k=this.liveRegion;h=function(d,e,l){var m,n,o,p,q,r,s,t,u,v;d=c.sortResults(d,e,g);var w=[];for(m=0,n=d.length;n>m;m+=1)o=d[m],q=o.disabled===!0,p=!q&&j(o)!==b,r=o.children&&o.children.length>0,s=a("<li></li>"),s.addClass("select2-results-dept-"+l),s.addClass("select2-result"),s.addClass(p?"select2-result-selectable":"select2-result-unselectable"),q&&s.addClass("select2-disabled"),r&&s.addClass("select2-result-with-children"),s.addClass(i.opts.formatResultCssClass(o)),s.attr("role","presentation"),t=a(document.createElement("div")),t.addClass("select2-result-label"),t.attr("id","select2-result-label-"+f()),t.attr("role","option"),v=c.formatResult(o,t,g,i.opts.escapeMarkup),v!==b&&(t.html(v),s.append(t)),r&&(u=a("<ul></ul>"),u.addClass("select2-result-sub"),h(o.children,u,l+1),s.append(u)),s.data("select2-data",o),w.push(s[0]);e.append(w),k.text(c.formatMatches(d.length))},h(e,d,0)}},a.fn.select2.defaults,c),"function"!=typeof c.id&&(g=c.id,c.id=function(a){return a[g]}),a.isArray(c.element.data("select2Tags"))){if("tags"in c)throw"tags specified as both an attribute 'data-select2-tags' and in options of Select2 "+c.element.attr("id");c.tags=c.element.data("select2Tags")}if(e?(c.query=this.bind(function(a){var f,g,h,c={results:[],more:!1},e=a.term;h=function(b,c){var d;b.is("option")?a.matcher(e,b.text(),b)&&c.push(i.optionToData(b)):b.is("optgroup")&&(d=i.optionToData(b),b.children().each2(function(a,b){h(b,d.children)}),d.children.length>0&&c.push(d))},f=d.children(),this.getPlaceholder()!==b&&f.length>0&&(g=this.getPlaceholderOption(),g&&(f=f.not(g))),f.each2(function(a,b){h(b,c.results)}),a.callback(c)}),c.id=function(a){return a.id}):"query"in c||("ajax"in c?(h=c.element.data("ajax-url"),h&&h.length>0&&(c.ajax.url=h),c.query=G.call(c.element,c.ajax)):"data"in c?c.query=H(c.data):"tags"in c&&(c.query=I(c.tags),c.createSearchChoice===b&&(c.createSearchChoice=function(b){return{id:a.trim(b),text:a.trim(b)}}),c.initSelection===b&&(c.initSelection=function(b,d){var e=[];a(s(b.val(),c.separator,c.transformVal)).each(function(){var b={id:this,text:this},d=c.tags;a.isFunction(d)&&(d=d()),a(d).each(function(){return r(this.id,b.id)?(b=this,!1):void 0}),e.push(b)}),d(e)}))),"function"!=typeof c.query)throw"query function not defined for Select2 "+c.element.attr("id");if("top"===c.createSearchChoicePosition)c.createSearchChoicePosition=function(a,b){a.unshift(b)};else if("bottom"===c.createSearchChoicePosition)c.createSearchChoicePosition=function(a,b){a.push(b)};else if("function"!=typeof c.createSearchChoicePosition)throw"invalid createSearchChoicePosition option must be 'top', 'bottom' or a custom function";return c},monitorSource:function(){var d,c=this.opts.element,e=this;c.on("change.select2",this.bind(function(){this.opts.element.data("select2-change-triggered")!==!0&&this.initSelection()})),this._sync=this.bind(function(){var a=c.prop("disabled");a===b&&(a=!1),this.enable(!a);var d=c.prop("readonly");d===b&&(d=!1),this.readonly(d),this.container&&(D(this.container,this.opts.element,this.opts.adaptContainerCssClass),this.container.addClass(K(this.opts.containerCssClass,this.opts.element))),this.dropdown&&(D(this.dropdown,this.opts.element,this.opts.adaptDropdownCssClass),this.dropdown.addClass(K(this.opts.dropdownCssClass,this.opts.element)))}),c.length&&c[0].attachEvent&&c.each(function(){this.attachEvent("onpropertychange",e._sync)}),d=window.MutationObserver||window.WebKitMutationObserver||window.MozMutationObserver,d!==b&&(this.propertyObserver&&(delete this.propertyObserver,this.propertyObserver=null),this.propertyObserver=new d(function(b){a.each(b,e._sync)}),this.propertyObserver.observe(c.get(0),{attributes:!0,subtree:!1}))},triggerSelect:function(b){var c=a.Event("select2-selecting",{val:this.id(b),object:b,choice:b});return this.opts.element.trigger(c),!c.isDefaultPrevented()},triggerChange:function(b){b=b||{},b=a.extend({},b,{type:"change",val:this.val()}),this.opts.element.data("select2-change-triggered",!0),this.opts.element.trigger(b),this.opts.element.data("select2-change-triggered",!1),this.opts.element.click(),this.opts.blurOnChange&&this.opts.element.blur()},isInterfaceEnabled:function(){return this.enabledInterface===!0},enableInterface:function(){var a=this._enabled&&!this._readonly,b=!a;return a===this.enabledInterface?!1:(this.container.toggleClass("select2-container-disabled",b),this.close(),this.enabledInterface=a,!0)},enable:function(a){a===b&&(a=!0),this._enabled!==a&&(this._enabled=a,this.opts.element.prop("disabled",!a),this.enableInterface())},disable:function(){this.enable(!1)},readonly:function(a){a===b&&(a=!1),this._readonly!==a&&(this._readonly=a,this.opts.element.prop("readonly",a),this.enableInterface())},opened:function(){return this.container?this.container.hasClass("select2-dropdown-open"):!1},positionDropdown:function(){var v,w,x,y,z,b=this.dropdown,c=this.container,d=c.offset(),e=c.outerHeight(!1),f=c.outerWidth(!1),g=b.outerHeight(!1),h=a(window),i=h.width(),k=h.height(),l=h.scrollLeft()+i,m=h.scrollTop()+k,n=d.top+e,o=d.left,p=m>=n+g,q=d.top-g>=h.scrollTop(),r=b.outerWidth(!1),s=function(){return l>=o+r},t=function(){return d.left+l+c.outerWidth(!1)>r},u=b.hasClass("select2-drop-above");u?(w=!0,!q&&p&&(x=!0,w=!1)):(w=!1,!p&&q&&(x=!0,w=!0)),x&&(b.hide(),d=this.container.offset(),e=this.container.outerHeight(!1),f=this.container.outerWidth(!1),g=b.outerHeight(!1),l=h.scrollLeft()+i,m=h.scrollTop()+k,n=d.top+e,o=d.left,r=b.outerWidth(!1),b.show(),this.focusSearch()),this.opts.dropdownAutoWidth?(z=a(".select2-results",b)[0],b.addClass("select2-drop-auto-width"),b.css("width",""),r=b.outerWidth(!1)+(z.scrollHeight===z.clientHeight?0:j.width),r>f?f=r:r=f,g=b.outerHeight(!1)):this.container.removeClass("select2-drop-auto-width"),"static"!==this.body.css("position")&&(v=this.body.offset(),n-=v.top,o-=v.left),!s()&&t()&&(o=d.left+this.container.outerWidth(!1)-r),y={left:o,width:f},w?(y.top=d.top-g,y.bottom="auto",this.container.addClass("select2-drop-above"),b.addClass("select2-drop-above")):(y.top=n,y.bottom="auto",this.container.removeClass("select2-drop-above"),b.removeClass("select2-drop-above")),y=a.extend(y,K(this.opts.dropdownCss,this.opts.element)),b.css(y)},shouldOpen:function(){var b;return this.opened()?!1:this._enabled===!1||this._readonly===!0?!1:(b=a.Event("select2-opening"),this.opts.element.trigger(b),!b.isDefaultPrevented())},clearDropdownAlignmentPreference:function(){this.container.removeClass("select2-drop-above"),this.dropdown.removeClass("select2-drop-above")},open:function(){return this.shouldOpen()?(this.opening(),i.on("mousemove.select2Event",function(a){h.x=a.pageX,h.y=a.pageY}),!0):!1},opening:function(){var f,b=this.containerEventName,c="scroll."+b,d="resize."+b,e="orientationchange."+b;this.container.addClass("select2-dropdown-open").addClass("select2-container-active"),this.clearDropdownAlignmentPreference(),this.dropdown[0]!==this.body.children().last()[0]&&this.dropdown.detach().appendTo(this.body),f=a("#select2-drop-mask"),0===f.length&&(f=a(document.createElement("div")),f.attr("id","select2-drop-mask").attr("class","select2-drop-mask"),f.hide(),f.appendTo(this.body),f.on("mousedown touchstart click",function(b){n(f);var d,c=a("#select2-drop");c.length>0&&(d=c.data("select2"),d.opts.selectOnBlur&&d.selectHighlighted({noFocus:!0}),d.close(),b.preventDefault(),b.stopPropagation())})),this.dropdown.prev()[0]!==f[0]&&this.dropdown.before(f),a("#select2-drop").removeAttr("id"),this.dropdown.attr("id","select2-drop"),f.show(),this.positionDropdown(),this.dropdown.show(),this.positionDropdown(),this.dropdown.addClass("select2-drop-active");var g=this;this.container.parents().add(window).each(function(){a(this).on(d+" "+c+" "+e,function(){g.opened()&&g.positionDropdown()})})},close:function(){if(this.opened()){var b=this.containerEventName,c="scroll."+b,d="resize."+b,e="orientationchange."+b;this.container.parents().add(window).each(function(){a(this).off(c).off(d).off(e)}),this.clearDropdownAlignmentPreference(),a("#select2-drop-mask").hide(),this.dropdown.removeAttr("id"),this.dropdown.hide(),this.container.removeClass("select2-dropdown-open").removeClass("select2-container-active"),this.results.empty(),i.off("mousemove.select2Event"),this.clearSearch(),this.search.removeClass("select2-active"),this.opts.element.trigger(a.Event("select2-close"))}},externalSearch:function(a){this.open(),this.search.val(a),this.updateResults(!1)},clearSearch:function(){},getMaximumSelectionSize:function(){return K(this.opts.maximumSelectionSize,this.opts.element)},ensureHighlightVisible:function(){var c,d,e,f,g,h,i,j,b=this.results;if(d=this.highlight(),!(0>d)){if(0==d)return b.scrollTop(0),void 0;c=this.findHighlightableChoices().find(".select2-result-label"),e=a(c[d]),j=(e.offset()||{}).top||0,f=j+e.outerHeight(!0),d===c.length-1&&(i=b.find("li.select2-more-results"),i.length>0&&(f=i.offset().top+i.outerHeight(!0))),g=b.offset().top+b.outerHeight(!1),f>g&&b.scrollTop(b.scrollTop()+(f-g)),h=j-b.offset().top,0>h&&"none"!=e.css("display")&&b.scrollTop(b.scrollTop()+h)}},findHighlightableChoices:function(){return this.results.find(".select2-result-selectable:not(.select2-disabled):not(.select2-selected)")},moveHighlight:function(b){for(var c=this.findHighlightableChoices(),d=this.highlight();d>-1&&d<c.length;){d+=b;
var e=a(c[d]);if(e.hasClass("select2-result-selectable")&&!e.hasClass("select2-disabled")&&!e.hasClass("select2-selected")){this.highlight(d);break}}},highlight:function(b){var d,e,c=this.findHighlightableChoices();return 0===arguments.length?p(c.filter(".select2-highlighted")[0],c.get()):(b>=c.length&&(b=c.length-1),0>b&&(b=0),this.removeHighlight(),d=a(c[b]),d.addClass("select2-highlighted"),this.search.attr("aria-activedescendant",d.find(".select2-result-label").attr("id")),this.ensureHighlightVisible(),this.liveRegion.text(d.text()),e=d.data("select2-data"),e&&this.opts.element.trigger({type:"select2-highlight",val:this.id(e),choice:e}),void 0)},removeHighlight:function(){this.results.find(".select2-highlighted").removeClass("select2-highlighted")},touchMoved:function(){this._touchMoved=!0},clearTouchMoved:function(){this._touchMoved=!1},countSelectableResults:function(){return this.findHighlightableChoices().length},highlightUnderEvent:function(b){var c=a(b.target).closest(".select2-result-selectable");if(c.length>0&&!c.is(".select2-highlighted")){var d=this.findHighlightableChoices();this.highlight(d.index(c))}else 0==c.length&&this.removeHighlight()},loadMoreIfNeeded:function(){var c,a=this.results,b=a.find("li.select2-more-results"),d=this.resultsPage+1,e=this,f=this.search.val(),g=this.context;0!==b.length&&(c=b.offset().top-a.offset().top-a.height(),c<=this.opts.loadMorePadding&&(b.addClass("select2-active"),this.opts.query({element:this.opts.element,term:f,page:d,context:g,matcher:this.opts.matcher,callback:this.bind(function(c){e.opened()&&(e.opts.populateResults.call(this,a,c.results,{term:f,page:d,context:g}),e.postprocessResults(c,!1,!1),c.more===!0?(b.detach().appendTo(a).html(e.opts.escapeMarkup(K(e.opts.formatLoadMore,e.opts.element,d+1))),window.setTimeout(function(){e.loadMoreIfNeeded()},10)):b.remove(),e.positionDropdown(),e.resultsPage=d,e.context=c.context,this.opts.element.trigger({type:"select2-loaded",items:c}))})})))},tokenize:function(){},updateResults:function(c){function m(){d.removeClass("select2-active"),h.positionDropdown(),e.find(".select2-no-results,.select2-selection-limit,.select2-searching").length?h.liveRegion.text(e.text()):h.liveRegion.text(h.opts.formatMatches(e.find('.select2-result-selectable:not(".select2-selected")').length))}function n(a){e.html(a),m()}var g,i,l,d=this.search,e=this.results,f=this.opts,h=this,j=d.val(),k=a.data(this.container,"select2-last-term");if((c===!0||!k||!r(j,k))&&(a.data(this.container,"select2-last-term",j),c===!0||this.showSearchInput!==!1&&this.opened())){l=++this.queryCount;var o=this.getMaximumSelectionSize();if(o>=1&&(g=this.data(),a.isArray(g)&&g.length>=o&&J(f.formatSelectionTooBig,"formatSelectionTooBig")))return n("<li class='select2-selection-limit'>"+K(f.formatSelectionTooBig,f.element,o)+"</li>"),void 0;if(d.val().length<f.minimumInputLength)return J(f.formatInputTooShort,"formatInputTooShort")?n("<li class='select2-no-results'>"+K(f.formatInputTooShort,f.element,d.val(),f.minimumInputLength)+"</li>"):n(""),c&&this.showSearch&&this.showSearch(!0),void 0;if(f.maximumInputLength&&d.val().length>f.maximumInputLength)return J(f.formatInputTooLong,"formatInputTooLong")?n("<li class='select2-no-results'>"+K(f.formatInputTooLong,f.element,d.val(),f.maximumInputLength)+"</li>"):n(""),void 0;f.formatSearching&&0===this.findHighlightableChoices().length&&n("<li class='select2-searching'>"+K(f.formatSearching,f.element)+"</li>"),d.addClass("select2-active"),this.removeHighlight(),i=this.tokenize(),i!=b&&null!=i&&d.val(i),this.resultsPage=1,f.query({element:f.element,term:d.val(),page:this.resultsPage,context:null,matcher:f.matcher,callback:this.bind(function(g){var i;if(l==this.queryCount){if(!this.opened())return this.search.removeClass("select2-active"),void 0;if(g.hasError!==b&&J(f.formatAjaxError,"formatAjaxError"))return n("<li class='select2-ajax-error'>"+K(f.formatAjaxError,f.element,g.jqXHR,g.textStatus,g.errorThrown)+"</li>"),void 0;if(this.context=g.context===b?null:g.context,this.opts.createSearchChoice&&""!==d.val()&&(i=this.opts.createSearchChoice.call(h,d.val(),g.results),i!==b&&null!==i&&h.id(i)!==b&&null!==h.id(i)&&0===a(g.results).filter(function(){return r(h.id(this),h.id(i))}).length&&this.opts.createSearchChoicePosition(g.results,i)),0===g.results.length&&J(f.formatNoMatches,"formatNoMatches"))return n("<li class='select2-no-results'>"+K(f.formatNoMatches,f.element,d.val())+"</li>"),void 0;e.empty(),h.opts.populateResults.call(this,e,g.results,{term:d.val(),page:this.resultsPage,context:null}),g.more===!0&&J(f.formatLoadMore,"formatLoadMore")&&(e.append("<li class='select2-more-results'>"+f.escapeMarkup(K(f.formatLoadMore,f.element,this.resultsPage))+"</li>"),window.setTimeout(function(){h.loadMoreIfNeeded()},10)),this.postprocessResults(g,c),m(),this.opts.element.trigger({type:"select2-loaded",items:g})}})})}},cancel:function(){this.close()},blur:function(){this.opts.selectOnBlur&&this.selectHighlighted({noFocus:!0}),this.close(),this.container.removeClass("select2-container-active"),this.search[0]===document.activeElement&&this.search.blur(),this.clearSearch(),this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus")},focusSearch:function(){y(this.search)},selectHighlighted:function(a){if(this._touchMoved)return this.clearTouchMoved(),void 0;var b=this.highlight(),c=this.results.find(".select2-highlighted"),d=c.closest(".select2-result").data("select2-data");d?(this.highlight(b),this.onSelect(d,a)):a&&a.noFocus&&this.close()},getPlaceholder:function(){var a;return this.opts.element.attr("placeholder")||this.opts.element.attr("data-placeholder")||this.opts.element.data("placeholder")||this.opts.placeholder||((a=this.getPlaceholderOption())!==b?a.text():b)},getPlaceholderOption:function(){if(this.select){var c=this.select.children("option").first();if(this.opts.placeholderOption!==b)return"first"===this.opts.placeholderOption&&c||"function"==typeof this.opts.placeholderOption&&this.opts.placeholderOption(this.select);if(""===a.trim(c.text())&&""===c.val())return c}},initContainerWidth:function(){function c(){var c,d,e,f,g,h;if("off"===this.opts.width)return null;if("element"===this.opts.width)return 0===this.opts.element.outerWidth(!1)?"auto":this.opts.element.outerWidth(!1)+"px";if("copy"===this.opts.width||"resolve"===this.opts.width){if(c=this.opts.element.attr("style"),c!==b)for(d=c.split(";"),f=0,g=d.length;g>f;f+=1)if(h=d[f].replace(/\s/g,""),e=h.match(/^width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/i),null!==e&&e.length>=1)return e[1];return"resolve"===this.opts.width?(c=this.opts.element.css("width"),c.indexOf("%")>0?c:0===this.opts.element.outerWidth(!1)?"auto":this.opts.element.outerWidth(!1)+"px"):null}return a.isFunction(this.opts.width)?this.opts.width():this.opts.width}var d=c.call(this);null!==d&&this.container.css("width",d)}}),d=O(c,{createContainer:function(){var b=a(document.createElement("div")).attr({"class":"select2-container"}).html(["<a href='javascript:void(0)' class='select2-choice' tabindex='-1'>","   <span class='select2-chosen'>&#160;</span><abbr class='select2-search-choice-close'></abbr>","   <span class='select2-arrow' role='presentation'><b role='presentation'></b></span>","</a>","<label for='' class='select2-offscreen'></label>","<input class='select2-focusser select2-offscreen' type='text' aria-haspopup='true' role='button' />","<div class='select2-drop select2-display-none'>","   <div class='select2-search'>","       <label for='' class='select2-offscreen'></label>","       <input type='text' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' class='select2-input' role='combobox' aria-expanded='true'","       aria-autocomplete='list' />","   </div>","   <ul class='select2-results' role='listbox'>","   </ul>","</div>"].join(""));return b},enableInterface:function(){this.parent.enableInterface.apply(this,arguments)&&this.focusser.prop("disabled",!this.isInterfaceEnabled())},opening:function(){var c,d,e;this.opts.minimumResultsForSearch>=0&&this.showSearch(!0),this.parent.opening.apply(this,arguments),this.showSearchInput!==!1&&this.search.val(this.focusser.val()),this.opts.shouldFocusInput(this)&&(this.search.focus(),c=this.search.get(0),c.createTextRange?(d=c.createTextRange(),d.collapse(!1),d.select()):c.setSelectionRange&&(e=this.search.val().length,c.setSelectionRange(e,e))),""===this.search.val()&&this.nextSearchTerm!=b&&(this.search.val(this.nextSearchTerm),this.search.select()),this.focusser.prop("disabled",!0).val(""),this.updateResults(!0),this.opts.element.trigger(a.Event("select2-open"))},close:function(){this.opened()&&(this.parent.close.apply(this,arguments),this.focusser.prop("disabled",!1),this.opts.shouldFocusInput(this)&&this.focusser.focus())},focus:function(){this.opened()?this.close():(this.focusser.prop("disabled",!1),this.opts.shouldFocusInput(this)&&this.focusser.focus())},isFocused:function(){return this.container.hasClass("select2-container-active")},cancel:function(){this.parent.cancel.apply(this,arguments),this.focusser.prop("disabled",!1),this.opts.shouldFocusInput(this)&&this.focusser.focus()},destroy:function(){a("label[for='"+this.focusser.attr("id")+"']").attr("for",this.opts.element.attr("id")),this.parent.destroy.apply(this,arguments),N.call(this,"selection","focusser")},initContainer:function(){var b,g,c=this.container,d=this.dropdown,e=f();this.opts.minimumResultsForSearch<0?this.showSearch(!1):this.showSearch(!0),this.selection=b=c.find(".select2-choice"),this.focusser=c.find(".select2-focusser"),b.find(".select2-chosen").attr("id","select2-chosen-"+e),this.focusser.attr("aria-labelledby","select2-chosen-"+e),this.results.attr("id","select2-results-"+e),this.search.attr("aria-owns","select2-results-"+e),this.focusser.attr("id","s2id_autogen"+e),g=a("label[for='"+this.opts.element.attr("id")+"']"),this.opts.element.focus(this.bind(function(){this.focus()})),this.focusser.prev().text(g.text()).attr("for",this.focusser.attr("id"));var h=this.opts.element.attr("title");this.opts.element.attr("title",h||g.text()),this.focusser.attr("tabindex",this.elementTabIndex),this.search.attr("id",this.focusser.attr("id")+"_search"),this.search.prev().text(a("label[for='"+this.focusser.attr("id")+"']").text()).attr("for",this.search.attr("id")),this.search.on("keydown",this.bind(function(a){if(this.isInterfaceEnabled()&&229!=a.keyCode){if(a.which===k.PAGE_UP||a.which===k.PAGE_DOWN)return A(a),void 0;switch(a.which){case k.UP:case k.DOWN:return this.moveHighlight(a.which===k.UP?-1:1),A(a),void 0;case k.ENTER:return this.selectHighlighted(),A(a),void 0;case k.TAB:return this.selectHighlighted({noFocus:!0}),void 0;case k.ESC:return this.cancel(a),A(a),void 0}}})),this.search.on("blur",this.bind(function(){document.activeElement===this.body.get(0)&&window.setTimeout(this.bind(function(){this.opened()&&this.search.focus()}),0)})),this.focusser.on("keydown",this.bind(function(a){if(this.isInterfaceEnabled()&&a.which!==k.TAB&&!k.isControl(a)&&!k.isFunctionKey(a)&&a.which!==k.ESC){if(this.opts.openOnEnter===!1&&a.which===k.ENTER)return A(a),void 0;if(a.which==k.DOWN||a.which==k.UP||a.which==k.ENTER&&this.opts.openOnEnter){if(a.altKey||a.ctrlKey||a.shiftKey||a.metaKey)return;return this.open(),A(a),void 0}return a.which==k.DELETE||a.which==k.BACKSPACE?(this.opts.allowClear&&this.clear(),A(a),void 0):void 0}})),u(this.focusser),this.focusser.on("keyup-change input",this.bind(function(a){if(this.opts.minimumResultsForSearch>=0){if(a.stopPropagation(),this.opened())return;this.open()}})),b.on("mousedown touchstart","abbr",this.bind(function(a){this.isInterfaceEnabled()&&(this.clear(),B(a),this.close(),this.selection&&this.selection.focus())})),b.on("mousedown touchstart",this.bind(function(c){n(b),this.container.hasClass("select2-container-active")||this.opts.element.trigger(a.Event("select2-focus")),this.opened()?this.close():this.isInterfaceEnabled()&&this.open(),A(c)})),d.on("mousedown touchstart",this.bind(function(){this.opts.shouldFocusInput(this)&&this.search.focus()})),b.on("focus",this.bind(function(a){A(a)})),this.focusser.on("focus",this.bind(function(){this.container.hasClass("select2-container-active")||this.opts.element.trigger(a.Event("select2-focus")),this.container.addClass("select2-container-active")})).on("blur",this.bind(function(){this.opened()||(this.container.removeClass("select2-container-active"),this.opts.element.trigger(a.Event("select2-blur")))})),this.search.on("focus",this.bind(function(){this.container.hasClass("select2-container-active")||this.opts.element.trigger(a.Event("select2-focus")),this.container.addClass("select2-container-active")})),this.initContainerWidth(),this.opts.element.hide(),this.setPlaceholder()},clear:function(b){var c=this.selection.data("select2-data");if(c){var d=a.Event("select2-clearing");if(this.opts.element.trigger(d),d.isDefaultPrevented())return;var e=this.getPlaceholderOption();this.opts.element.val(e?e.val():""),this.selection.find(".select2-chosen").empty(),this.selection.removeData("select2-data"),this.setPlaceholder(),b!==!1&&(this.opts.element.trigger({type:"select2-removed",val:this.id(c),choice:c}),this.triggerChange({removed:c}))}},initSelection:function(){if(this.isPlaceholderOptionSelected())this.updateSelection(null),this.close(),this.setPlaceholder();else{var c=this;this.opts.initSelection.call(null,this.opts.element,function(a){a!==b&&null!==a&&(c.updateSelection(a),c.close(),c.setPlaceholder(),c.nextSearchTerm=c.opts.nextSearchTerm(a,c.search.val()))})}},isPlaceholderOptionSelected:function(){var a;return this.getPlaceholder()===b?!1:(a=this.getPlaceholderOption())!==b&&a.prop("selected")||""===this.opts.element.val()||this.opts.element.val()===b||null===this.opts.element.val()},prepareOpts:function(){var b=this.parent.prepareOpts.apply(this,arguments),c=this;return"select"===b.element.get(0).tagName.toLowerCase()?b.initSelection=function(a,b){var d=a.find("option").filter(function(){return this.selected&&!this.disabled});b(c.optionToData(d))}:"data"in b&&(b.initSelection=b.initSelection||function(c,d){var e=c.val(),f=null;b.query({matcher:function(a,c,d){var g=r(e,b.id(d));return g&&(f=d),g},callback:a.isFunction(d)?function(){d(f)}:a.noop})}),b},getPlaceholder:function(){return this.select&&this.getPlaceholderOption()===b?b:this.parent.getPlaceholder.apply(this,arguments)},setPlaceholder:function(){var a=this.getPlaceholder();if(this.isPlaceholderOptionSelected()&&a!==b){if(this.select&&this.getPlaceholderOption()===b)return;this.selection.find(".select2-chosen").html(this.opts.escapeMarkup(a)),this.selection.addClass("select2-default"),this.container.removeClass("select2-allowclear")}},postprocessResults:function(a,b,c){var d=0,e=this;if(this.findHighlightableChoices().each2(function(a,b){return r(e.id(b.data("select2-data")),e.opts.element.val())?(d=a,!1):void 0}),c!==!1&&(b===!0&&d>=0?this.highlight(d):this.highlight(0)),b===!0){var g=this.opts.minimumResultsForSearch;g>=0&&this.showSearch(L(a.results)>=g)}},showSearch:function(b){this.showSearchInput!==b&&(this.showSearchInput=b,this.dropdown.find(".select2-search").toggleClass("select2-search-hidden",!b),this.dropdown.find(".select2-search").toggleClass("select2-offscreen",!b),a(this.dropdown,this.container).toggleClass("select2-with-searchbox",b))},onSelect:function(a,b){if(this.triggerSelect(a)){var c=this.opts.element.val(),d=this.data();this.opts.element.val(this.id(a)),this.updateSelection(a),this.opts.element.trigger({type:"select2-selected",val:this.id(a),choice:a}),this.nextSearchTerm=this.opts.nextSearchTerm(a,this.search.val()),this.close(),b&&b.noFocus||!this.opts.shouldFocusInput(this)||this.focusser.focus(),r(c,this.id(a))||this.triggerChange({added:a,removed:d})}},updateSelection:function(a){var d,e,c=this.selection.find(".select2-chosen");this.selection.data("select2-data",a),c.empty(),null!==a&&(d=this.opts.formatSelection(a,c,this.opts.escapeMarkup)),d!==b&&c.append(d),e=this.opts.formatSelectionCssClass(a,c),e!==b&&c.addClass(e),this.selection.removeClass("select2-default"),this.opts.allowClear&&this.getPlaceholder()!==b&&this.container.addClass("select2-allowclear")},val:function(){var a,c=!1,d=null,e=this,f=this.data();if(0===arguments.length)return this.opts.element.val();if(a=arguments[0],arguments.length>1&&(c=arguments[1]),this.select)this.select.val(a).find("option").filter(function(){return this.selected}).each2(function(a,b){return d=e.optionToData(b),!1}),this.updateSelection(d),this.setPlaceholder(),c&&this.triggerChange({added:d,removed:f});else{if(!a&&0!==a)return this.clear(c),void 0;if(this.opts.initSelection===b)throw new Error("cannot call val() if initSelection() is not defined");this.opts.element.val(a),this.opts.initSelection(this.opts.element,function(a){e.opts.element.val(a?e.id(a):""),e.updateSelection(a),e.setPlaceholder(),c&&e.triggerChange({added:a,removed:f})})}},clearSearch:function(){this.search.val(""),this.focusser.val("")},data:function(a){var c,d=!1;return 0===arguments.length?(c=this.selection.data("select2-data"),c==b&&(c=null),c):(arguments.length>1&&(d=arguments[1]),a?(c=this.data(),this.opts.element.val(a?this.id(a):""),this.updateSelection(a),d&&this.triggerChange({added:a,removed:c})):this.clear(d),void 0)}}),e=O(c,{createContainer:function(){var b=a(document.createElement("div")).attr({"class":"select2-container select2-container-multi"}).html(["<ul class='select2-choices'>","  <li class='select2-search-field'>","    <label for='' class='select2-offscreen'></label>","    <input type='text' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' class='select2-input'>","  </li>","</ul>","<div class='select2-drop select2-drop-multi select2-display-none'>","   <ul class='select2-results'>","   </ul>","</div>"].join(""));return b},prepareOpts:function(){var b=this.parent.prepareOpts.apply(this,arguments),c=this;return"select"===b.element.get(0).tagName.toLowerCase()?b.initSelection=function(a,b){var d=[];a.find("option").filter(function(){return this.selected&&!this.disabled}).each2(function(a,b){d.push(c.optionToData(b))}),b(d)}:"data"in b&&(b.initSelection=b.initSelection||function(c,d){var e=s(c.val(),b.separator,b.transformVal),f=[];b.query({matcher:function(c,d,g){var h=a.grep(e,function(a){return r(a,b.id(g))}).length;return h&&f.push(g),h},callback:a.isFunction(d)?function(){for(var a=[],c=0;c<e.length;c++)for(var g=e[c],h=0;h<f.length;h++){var i=f[h];if(r(g,b.id(i))){a.push(i),f.splice(h,1);break}}d(a)}:a.noop})}),b},selectChoice:function(a){var b=this.container.find(".select2-search-choice-focus");b.length&&a&&a[0]==b[0]||(b.length&&this.opts.element.trigger("choice-deselected",b),b.removeClass("select2-search-choice-focus"),a&&a.length&&(this.close(),a.addClass("select2-search-choice-focus"),this.opts.element.trigger("choice-selected",a)))},destroy:function(){a("label[for='"+this.search.attr("id")+"']").attr("for",this.opts.element.attr("id")),this.parent.destroy.apply(this,arguments),N.call(this,"searchContainer","selection")},initContainer:function(){var c,b=".select2-choices";this.searchContainer=this.container.find(".select2-search-field"),this.selection=c=this.container.find(b);var d=this;this.selection.on("click",".select2-container:not(.select2-container-disabled) .select2-search-choice:not(.select2-locked)",function(){d.search[0].focus(),d.selectChoice(a(this))}),this.search.attr("id","s2id_autogen"+f()),this.search.prev().text(a("label[for='"+this.opts.element.attr("id")+"']").text()).attr("for",this.search.attr("id")),this.opts.element.focus(this.bind(function(){this.focus()})),this.search.on("input paste",this.bind(function(){this.search.attr("placeholder")&&0==this.search.val().length||this.isInterfaceEnabled()&&(this.opened()||this.open())})),this.search.attr("tabindex",this.elementTabIndex),this.keydowns=0,this.search.on("keydown",this.bind(function(a){if(this.isInterfaceEnabled()){++this.keydowns;var b=c.find(".select2-search-choice-focus"),d=b.prev(".select2-search-choice:not(.select2-locked)"),e=b.next(".select2-search-choice:not(.select2-locked)"),f=z(this.search);if(b.length&&(a.which==k.LEFT||a.which==k.RIGHT||a.which==k.BACKSPACE||a.which==k.DELETE||a.which==k.ENTER)){var g=b;return a.which==k.LEFT&&d.length?g=d:a.which==k.RIGHT?g=e.length?e:null:a.which===k.BACKSPACE?this.unselect(b.first())&&(this.search.width(10),g=d.length?d:e):a.which==k.DELETE?this.unselect(b.first())&&(this.search.width(10),g=e.length?e:null):a.which==k.ENTER&&(g=null),this.selectChoice(g),A(a),g&&g.length||this.open(),void 0}if((a.which===k.BACKSPACE&&1==this.keydowns||a.which==k.LEFT)&&0==f.offset&&!f.length)return this.selectChoice(c.find(".select2-search-choice:not(.select2-locked)").last()),A(a),void 0;if(this.selectChoice(null),this.opened())switch(a.which){case k.UP:case k.DOWN:return this.moveHighlight(a.which===k.UP?-1:1),A(a),void 0;case k.ENTER:return this.selectHighlighted(),A(a),void 0;case k.TAB:return this.selectHighlighted({noFocus:!0}),this.close(),void 0;case k.ESC:return this.cancel(a),A(a),void 0}if(a.which!==k.TAB&&!k.isControl(a)&&!k.isFunctionKey(a)&&a.which!==k.BACKSPACE&&a.which!==k.ESC){if(a.which===k.ENTER){if(this.opts.openOnEnter===!1)return;if(a.altKey||a.ctrlKey||a.shiftKey||a.metaKey)return}this.open(),(a.which===k.PAGE_UP||a.which===k.PAGE_DOWN)&&A(a),a.which===k.ENTER&&A(a)}}})),this.search.on("keyup",this.bind(function(){this.keydowns=0,this.resizeSearch()})),this.search.on("blur",this.bind(function(b){this.container.removeClass("select2-container-active"),this.search.removeClass("select2-focused"),this.selectChoice(null),this.opened()||this.clearSearch(),b.stopImmediatePropagation(),this.opts.element.trigger(a.Event("select2-blur"))})),this.container.on("click",b,this.bind(function(b){this.isInterfaceEnabled()&&(a(b.target).closest(".select2-search-choice").length>0||(this.selectChoice(null),this.clearPlaceholder(),this.container.hasClass("select2-container-active")||this.opts.element.trigger(a.Event("select2-focus")),this.open(),this.focusSearch(),b.preventDefault()))})),this.container.on("focus",b,this.bind(function(){this.isInterfaceEnabled()&&(this.container.hasClass("select2-container-active")||this.opts.element.trigger(a.Event("select2-focus")),this.container.addClass("select2-container-active"),this.dropdown.addClass("select2-drop-active"),this.clearPlaceholder())})),this.initContainerWidth(),this.opts.element.hide(),this.clearSearch()},enableInterface:function(){this.parent.enableInterface.apply(this,arguments)&&this.search.prop("disabled",!this.isInterfaceEnabled())},initSelection:function(){if(""===this.opts.element.val()&&""===this.opts.element.text()&&(this.updateSelection([]),this.close(),this.clearSearch()),this.select||""!==this.opts.element.val()){var c=this;this.opts.initSelection.call(null,this.opts.element,function(a){a!==b&&null!==a&&(c.updateSelection(a),c.close(),c.clearSearch())})}},clearSearch:function(){var a=this.getPlaceholder(),c=this.getMaxSearchWidth();a!==b&&0===this.getVal().length&&this.search.hasClass("select2-focused")===!1?(this.search.val(a).addClass("select2-default"),this.search.width(c>0?c:this.container.css("width"))):this.search.val("").width(10)},clearPlaceholder:function(){this.search.hasClass("select2-default")&&this.search.val("").removeClass("select2-default")},opening:function(){this.clearPlaceholder(),this.resizeSearch(),this.parent.opening.apply(this,arguments),this.focusSearch(),""===this.search.val()&&this.nextSearchTerm!=b&&(this.search.val(this.nextSearchTerm),this.search.select()),this.updateResults(!0),this.opts.shouldFocusInput(this)&&this.search.focus(),this.opts.element.trigger(a.Event("select2-open"))},close:function(){this.opened()&&this.parent.close.apply(this,arguments)},focus:function(){this.close(),this.search.focus()},isFocused:function(){return this.search.hasClass("select2-focused")},updateSelection:function(b){var c=[],d=[],e=this;a(b).each(function(){p(e.id(this),c)<0&&(c.push(e.id(this)),d.push(this))}),b=d,this.selection.find(".select2-search-choice").remove(),a(b).each(function(){e.addSelectedChoice(this)}),e.postprocessResults()},tokenize:function(){var a=this.search.val();a=this.opts.tokenizer.call(this,a,this.data(),this.bind(this.onSelect),this.opts),null!=a&&a!=b&&(this.search.val(a),a.length>0&&this.open())},onSelect:function(a,c){this.triggerSelect(a)&&""!==a.text&&(this.addSelectedChoice(a),this.opts.element.trigger({type:"selected",val:this.id(a),choice:a}),this.nextSearchTerm=this.opts.nextSearchTerm(a,this.search.val()),this.clearSearch(),this.updateResults(),(this.select||!this.opts.closeOnSelect)&&this.postprocessResults(a,!1,this.opts.closeOnSelect===!0),this.opts.closeOnSelect?(this.close(),this.search.width(10)):this.countSelectableResults()>0?(this.search.width(10),this.resizeSearch(),this.getMaximumSelectionSize()>0&&this.val().length>=this.getMaximumSelectionSize()?this.updateResults(!0):this.nextSearchTerm!=b&&(this.search.val(this.nextSearchTerm),this.updateResults(),this.search.select()),this.positionDropdown()):(this.close(),this.search.width(10)),this.triggerChange({added:a}),c&&c.noFocus||this.focusSearch())},cancel:function(){this.close(),this.focusSearch()},addSelectedChoice:function(c){var j,k,d=!c.locked,e=a("<li class='select2-search-choice'>    <div></div>    <a href='#' class='select2-search-choice-close' tabindex='-1'></a></li>"),f=a("<li class='select2-search-choice select2-locked'><div></div></li>"),g=d?e:f,h=this.id(c),i=this.getVal();j=this.opts.formatSelection(c,g.find("div"),this.opts.escapeMarkup),j!=b&&g.find("div").replaceWith(a("<div></div>").html(j)),k=this.opts.formatSelectionCssClass(c,g.find("div")),k!=b&&g.addClass(k),d&&g.find(".select2-search-choice-close").on("mousedown",A).on("click dblclick",this.bind(function(b){this.isInterfaceEnabled()&&(this.unselect(a(b.target)),this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus"),A(b),this.close(),this.focusSearch())})).on("focus",this.bind(function(){this.isInterfaceEnabled()&&(this.container.addClass("select2-container-active"),this.dropdown.addClass("select2-drop-active"))})),g.data("select2-data",c),g.insertBefore(this.searchContainer),i.push(h),this.setVal(i)},unselect:function(b){var d,e,c=this.getVal();if(b=b.closest(".select2-search-choice"),0===b.length)throw"Invalid argument: "+b+". Must be .select2-search-choice";if(d=b.data("select2-data")){var f=a.Event("select2-removing");if(f.val=this.id(d),f.choice=d,this.opts.element.trigger(f),f.isDefaultPrevented())return!1;for(;(e=p(this.id(d),c))>=0;)c.splice(e,1),this.setVal(c),this.select&&this.postprocessResults();return b.remove(),this.opts.element.trigger({type:"select2-removed",val:this.id(d),choice:d}),this.triggerChange({removed:d}),!0}},postprocessResults:function(a,b,c){var d=this.getVal(),e=this.results.find(".select2-result"),f=this.results.find(".select2-result-with-children"),g=this;e.each2(function(a,b){var c=g.id(b.data("select2-data"));p(c,d)>=0&&(b.addClass("select2-selected"),b.find(".select2-result-selectable").addClass("select2-selected"))}),f.each2(function(a,b){b.is(".select2-result-selectable")||0!==b.find(".select2-result-selectable:not(.select2-selected)").length||b.addClass("select2-selected")}),-1==this.highlight()&&c!==!1&&this.opts.closeOnSelect===!0&&g.highlight(0),!this.opts.createSearchChoice&&!e.filter(".select2-result:not(.select2-selected)").length>0&&(!a||a&&!a.more&&0===this.results.find(".select2-no-results").length)&&J(g.opts.formatNoMatches,"formatNoMatches")&&this.results.append("<li class='select2-no-results'>"+K(g.opts.formatNoMatches,g.opts.element,g.search.val())+"</li>")},getMaxSearchWidth:function(){return this.selection.width()-t(this.search)},resizeSearch:function(){var a,b,c,d,e,f=t(this.search);a=C(this.search)+10,b=this.search.offset().left,c=this.selection.width(),d=this.selection.offset().left,e=c-(b-d)-f,a>e&&(e=c-f),40>e&&(e=c-f),0>=e&&(e=a),this.search.width(Math.floor(e))},getVal:function(){var a;return this.select?(a=this.select.val(),null===a?[]:a):(a=this.opts.element.val(),s(a,this.opts.separator,this.opts.transformVal))},setVal:function(b){var c;this.select?this.select.val(b):(c=[],a(b).each(function(){p(this,c)<0&&c.push(this)}),this.opts.element.val(0===c.length?"":c.join(this.opts.separator)))},buildChangeDetails:function(a,b){for(var b=b.slice(0),a=a.slice(0),c=0;c<b.length;c++)for(var d=0;d<a.length;d++)r(this.opts.id(b[c]),this.opts.id(a[d]))&&(b.splice(c,1),c>0&&c--,a.splice(d,1),d--);return{added:b,removed:a}},val:function(c,d){var e,f=this;if(0===arguments.length)return this.getVal();if(e=this.data(),e.length||(e=[]),!c&&0!==c)return this.opts.element.val(""),this.updateSelection([]),this.clearSearch(),d&&this.triggerChange({added:this.data(),removed:e}),void 0;if(this.setVal(c),this.select)this.opts.initSelection(this.select,this.bind(this.updateSelection)),d&&this.triggerChange(this.buildChangeDetails(e,this.data()));else{if(this.opts.initSelection===b)throw new Error("val() cannot be called if initSelection() is not defined");this.opts.initSelection(this.opts.element,function(b){var c=a.map(b,f.id);f.setVal(c),f.updateSelection(b),f.clearSearch(),d&&f.triggerChange(f.buildChangeDetails(e,f.data()))})}this.clearSearch()},onSortStart:function(){if(this.select)throw new Error("Sorting of elements is not supported when attached to <select>. Attach to <input type='hidden'/> instead.");this.search.width(0),this.searchContainer.hide()},onSortEnd:function(){var b=[],c=this;this.searchContainer.show(),this.searchContainer.appendTo(this.searchContainer.parent()),this.resizeSearch(),this.selection.find(".select2-search-choice").each(function(){b.push(c.opts.id(a(this).data("select2-data")))}),this.setVal(b),this.triggerChange()},data:function(b,c){var e,f,d=this;return 0===arguments.length?this.selection.children(".select2-search-choice").map(function(){return a(this).data("select2-data")}).get():(f=this.data(),b||(b=[]),e=a.map(b,function(a){return d.opts.id(a)}),this.setVal(e),this.updateSelection(b),this.clearSearch(),c&&this.triggerChange(this.buildChangeDetails(f,this.data())),void 0)}}),a.fn.select2=function(){var d,e,f,g,h,c=Array.prototype.slice.call(arguments,0),i=["val","destroy","opened","open","close","focus","isFocused","container","dropdown","onSortStart","onSortEnd","enable","disable","readonly","positionDropdown","data","search"],j=["opened","isFocused","container","dropdown"],k=["val","data"],l={search:"externalSearch"};return this.each(function(){if(0===c.length||"object"==typeof c[0])d=0===c.length?{}:a.extend({},c[0]),d.element=a(this),"select"===d.element.get(0).tagName.toLowerCase()?h=d.element.prop("multiple"):(h=d.multiple||!1,"tags"in d&&(d.multiple=h=!0)),e=h?new window.Select2["class"].multi:new window.Select2["class"].single,e.init(d);else{if("string"!=typeof c[0])throw"Invalid arguments to select2 plugin: "+c;if(p(c[0],i)<0)throw"Unknown method: "+c[0];if(g=b,e=a(this).data("select2"),e===b)return;if(f=c[0],"container"===f?g=e.container:"dropdown"===f?g=e.dropdown:(l[f]&&(f=l[f]),g=e[f].apply(e,c.slice(1))),p(c[0],j)>=0||p(c[0],k)>=0&&1==c.length)return!1}}),g===b?this:g},a.fn.select2.defaults={width:"copy",loadMorePadding:0,closeOnSelect:!0,openOnEnter:!0,containerCss:{},dropdownCss:{},containerCssClass:"",dropdownCssClass:"",formatResult:function(a,b,c,d){var e=[];return E(this.text(a),c.term,e,d),e.join("")},transformVal:function(b){return a.trim(b)},formatSelection:function(a,c,d){return a?d(this.text(a)):b},sortResults:function(a){return a},formatResultCssClass:function(a){return a.css},formatSelectionCssClass:function(){return b},minimumResultsForSearch:0,minimumInputLength:0,maximumInputLength:null,maximumSelectionSize:0,id:function(a){return a==b?null:a.id},text:function(b){return b&&this.data&&this.data.text?a.isFunction(this.data.text)?this.data.text(b):b[this.data.text]:b.text
},matcher:function(a,b){return o(""+b).toUpperCase().indexOf(o(""+a).toUpperCase())>=0},separator:",",tokenSeparators:[],tokenizer:M,escapeMarkup:F,blurOnChange:!1,selectOnBlur:!1,adaptContainerCssClass:function(a){return a},adaptDropdownCssClass:function(){return null},nextSearchTerm:function(){return b},searchInputPlaceholder:"",createSearchChoicePosition:"top",shouldFocusInput:function(a){var b="ontouchstart"in window||navigator.msMaxTouchPoints>0;return b?a.opts.minimumResultsForSearch<0?!1:!0:!0}},a.fn.select2.locales=[],a.fn.select2.locales.en={formatMatches:function(a){return 1===a?"One result is available, press enter to select it.":a+" results are available, use up and down arrow keys to navigate."},formatNoMatches:function(){return"No matches found"},formatAjaxError:function(){return"Loading failed"},formatInputTooShort:function(a,b){var c=b-a.length;return"Please enter "+c+" or more character"+(1==c?"":"s")},formatInputTooLong:function(a,b){var c=a.length-b;return"Please delete "+c+" character"+(1==c?"":"s")},formatSelectionTooBig:function(a){return"You can only select "+a+" item"+(1==a?"":"s")},formatLoadMore:function(){return"Loading more results\u2026"},formatSearching:function(){return"Searching\u2026"}},a.extend(a.fn.select2.defaults,a.fn.select2.locales.en),a.fn.select2.ajaxDefaults={transport:a.ajax,params:{type:"GET",cache:!1,dataType:"json"}},window.Select2={query:{ajax:G,local:H,tags:I},util:{debounce:w,markMatch:E,escapeMarkup:F,stripDiacritics:o},"class":{"abstract":c,single:d,multi:e}}}}(jQuery);;jQuery(document).ready(function($) {
    var last_select_clicked=false;
    $('body').append('<div class="option-wrapper st-option-wrapper"></div>');
    var t_temp;
    $('.st-location-name').each(function(index, el) {
        var form = $(this).parents('form');
        var parent = $(this).parents('.st-select-wrapper');
        var t = $(this);
        var flag = true;
        $('.option-wrapper',parent).remove();
        t.keyup(function(event) {
            t_temp = t;
            last_select_clicked=t;
            if (event.which != 40 && event.which != 38 && event.which != 9) {
                val = $(this).val();
                if (event.which != 13) {

                    flag = false;
                    if( val != '' ){
                        html = '';
                        $('select option', parent).prop('selected', false);
                        $('select option', parent).each(function(index, el) {
                            var country = $(this).data('country');
                            var text = $(this).text();
                            var text_split = text.split("||");
                            text_split = text_split[0];
                            var highlight = get_highlight(text, val);
                            if (highlight.indexOf('</span>') > 0) {
                                var current_country = $(this).parent('select').attr('data-current-country');
                                if (typeof current_country != 'undefined' && current_country != '') {
                                    if (country == current_country) {
                                        html += '<div style="'+ $(this).data('style') +'" data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                            '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                            '</div>';
                                    }
                                } else {
                                    html += '<div style="'+ $(this).data('style') +'" data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                        '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                        '</div>';
                                }
                            }
                        });
                        $('.option-wrapper').html(html).show();
                        t.caculatePosition($('.option-wrapper'),t);
                    }else{
                        html = '';
                        $('select option', parent).prop('selected', false);

                        $('select option', parent).each(function(index, el) {
                            var country = $(this).data('country');
                            var text = $(this).text();
                            var text_split = text.split("||");
                            text_split = text_split[0];
                            if (text != '') {
                                var current_country = $(this).parent('select').attr('data-current-country');
                                if (typeof current_country != 'undefined' && current_country != '') {
                                    if (country == current_country) {
                                        html += '<div style="'+ $(this).data('style') +'" data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                            '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                            '</div>';
                                    }
                                } else {
                                    html += '<div style="'+ $(this).data('style') +'" data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                        '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                        '</div>';
                                }
                            }
                        });
                        $('.option-wrapper').html(html).show();
                        t.caculatePosition($('.option-wrapper', parent),t);
                    }
                }

                if (event.which == 13){
                    //$('.option-wrapper .option').trigger('click');
                    //console.log('Event2');
                    //return false;
                    /*html = '';
                    $('select option', parent).prop('selected', false);

                    $('select option', parent).each(function(index, el) {
                        var country = $(this).data('country');
                        var text = $(this).text();
                        var text_split = text.split("||");
                        text_split = text_split[0];
                        if (text != '') {
                            var current_country = $(this).parent('select').attr('data-current-country');
                            if (typeof current_country != 'undefined' && current_country != '') {
                                if (country == current_country) {
                                    html += '<div data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                        '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                        '</div>';
                                }
                            } else {
                                html += '<div data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                    '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                    '</div>';
                            }
                        }
                    });
                    $('.option-wrapper').html(html).show();
                    t.caculatePosition($('.option-wrapper'),t);*/
                }
                if (event.which == 13 && val != ""){

                }
                if (typeof t.data('children') != 'undefined' && t.data('children') != "") {
                    name = t.data('children');
                    $('select[name="' + name + '"]', form).attr('data-current-country', '');
                    $('input[name="drop-off"]', form).val('');
                    $('select[name="' + name + '"] option', form).prop('selected', false);
                }
            }
        });

        var liSelected;
        t.keydown(function(event) {
            last_select_clicked=t;
            if (event.which == 13) {
                /*var text = t.val();
                var val = $('div.option-wrapper .option.active').data('value');
                var country = $('div.option-wrapper .option.active').data('country');
                if( typeof text != 'undefined' && typeof val != 'undefined' ){
                    t.val(text);
                    $('select option[value="' + val + '"]').prop('selected', true);

                    $('.option-wrapper').html('').hide();

                    if (typeof t.data('children') != 'undefined' && t.data('children') != "") {
                        name = t.data('children');
                        $('select[name="' + name + '"]', form).attr('data-current-country', country);
                    }
                }*/
                var form = last_select_clicked.closest('form');
                $('.option-wrapper').html('').hide();
                t.focusNextInputField();

                return false;
            }

            if (event.which == 9) {
                var form = last_select_clicked.closest('form');
                $('.option-wrapper').html('').hide();
                //t.focusNextInputField();
                return false;
            }

            if (event.which == 40 || event.which == 38 || event.which == 9) {
                if(event.which === 40){
                    var index = $('.option-wrapper .option.active').index();
                    if(liSelected){
                        liSelected.removeClass('active');
                        next = liSelected.next();
                        if(next.length > 0){
                            liSelected = next.addClass('active');
                        }else{
                            if($('.option-wrapper .option.active').length > 0){
                                $('.st-option-wrapper .option').eq(index).removeClass('active');
                                if(($('.option-wrapper .option').length - 1) == index){
                                    liSelected = $('.st-option-wrapper .option').eq(0).addClass('active');
                                }else{
                                    liSelected = $('.st-option-wrapper .option').eq(index + 1).addClass('active');
                                }
                            }else{
                                liSelected = $('.st-option-wrapper .option').eq(0).addClass('active');
                            }
                        }
                    }else{
                        liSelected = $('.st-option-wrapper .option').eq(0).addClass('active');
                    }
                }else if(event.which === 38){
                    var index = $('.option-wrapper .option.active').index();
                    if(liSelected){
                        liSelected.removeClass('active');
                        next = liSelected.prev();
                        if(next.length > 0){
                            liSelected = next.addClass('active');
                        }else{
                            if($('.option-wrapper .option.active').length > 0) {
                                $('.st-option-wrapper .option').eq(index).removeClass('active');
                                liSelected = $('.st-option-wrapper .option').eq(index-1).addClass('active');
                            }else{
                                liSelected = $('.st-option-wrapper .option').last().addClass('active');
                            }
                        }
                    }else{
                        liSelected = $('.st-option-wrapper .option').last().addClass('active');
                    }
                }

                $('.option-wrapper').scrollTo($('.option-wrapper .option.active'), 400);

                event.preventDefault();
                flag = true;

                var value = $('.option-wrapper .option.active').data('value');
                var text = $('.option-wrapper .option.active').text();

                var country = $('.option-wrapper .option.active').data('country');
                t.val(text);
                $('select option[value="' + value + '"]', parent).prop('selected', true);


                if (typeof t.data('children') != 'undefined' && t.data('children') != "") {
                    name = t.data('children');
                    $('select[name="' + name + '"]', form).attr('data-current-country', country);
                }
            }

        });
        t.blur(function(event) {
            if (t.data('clear') == 'clear' && $('select option:selected', parent).val() == "") {
                t.val('');
            }
        });
        t.on("focus",function(event) {
        	if(t.data('id') != 'location_origin' && t.data('id') != 'location_destination'){
                last_select_clicked=t;
			}
            //last_select_clicked=t;
            //if (t.val() == '') {
            html = '';
            $('select option', parent).prop('selected', false);

            $('select option', parent).each(function(index, el) {
                var country = $(this).data('country');
                var text = $(this).text();
                var text_split = text.split("||");
                text_split = text_split[0];

                var activeOption = '';

                if (text != '') {
                    var current_country = $(this).parent('select').attr('data-current-country');
                    if (typeof current_country != 'undefined' && current_country != '') {
                        if (country == current_country) {
                            html += '<div style="'+ $(this).data('style') +'" data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option '+ activeOption +'">' +
                                '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                '</div>';
                        }
                    } else {
                        html += '<div  style="'+ $(this).data('style') +'" data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option '+ activeOption +'">' +
                            '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                            '</div>';
                    }
                }
            });

            if (typeof t.data('parent') != 'undefined' && t.data('parent') != "") {
                name = t.data('parent');

                if ($('select[name="' + name + '"]', form).length) {
                    var val = $('select[name="' + name + '"]', form).parent().find('input.st-location-name').val();
                    if (typeof val == 'undefined' || val == '') {
                        t.val('');
                        $('select[name="' + name + '"]', form).parent().find('input.st-location-name').focus();
                    }else{
                        $('.option-wrapper').html(html).show();
                    }
                }
            }else{
                $('.option-wrapper').html(html).show();
            }
            //}

            t.caculatePosition();
        });
        $(document).on('click', '.option-wrapper .option', function(event) {
            if(last_select_clicked.length > 0) {
                var form = last_select_clicked.closest('form');
                var parent = last_select_clicked.closest('.st-select-wrapper');
                setTimeout(function () {
                    if (typeof form.find('input[name="start"]').attr('value') != 'undefined') {
                        var $tmp = form.find('input[name="start"]').attr('value');
                        if ($tmp.length <= 0) {
                            form.find('input[name="start"]').datepicker('show');
                        }
                    }
                }, 100);
                event.preventDefault();
                flag = true;

                var value = $(this).data('value');
                var text = $(this).text();
                var country = $(this).data('country');
                if (text != "") {

                    last_select_clicked.val(text);

                    $('select option[value="' + value + '"]', parent).prop('selected', true);

                    $('.option-wrapper').html('').hide();

                    if (typeof t.data('children') != 'undefined' && t.data('children') != "") {
                        name = t.data('children');
                        $('select[name="' + name + '"]', form).attr('data-current-country', country);
                    }
                }
            }

            last_select_clicked.focusNextInputField();

        });
        $(document).click(function(event) {
            if (!$(event.target).is('.st-location-name')) {
                $('.option-wrapper').html('').hide();
            }
        });
        t.caculatePosition=function(){
            if(!last_select_clicked || !last_select_clicked.length) return;
            var wraper= $('.option-wrapper');
            var input_tag= last_select_clicked;
            var offset=parent.offset();
            var top=offset.top+parent.height();
            var left=offset.left;
            var width=input_tag.outerWidth();
            var wpadminbar = 0;
            if( $('#wpadminbar').length && $(window).width() >= 783 ){
                wpadminbar = $('#wpadminbar').height();
            }else{
                wpadminbar = 0
            }
            if($('body').hasClass('boxed')){
                left = left  - $('body').offset().left;
            }

            top = top - wpadminbar;

            var z_index = 99999;
            var position = 'absolute';

            if( $('#search-dialog').length ){
                position = 'fixed';
                top = top + wpadminbar - $(window).scrollTop();
                z_index = 99999;
            }


            wraper.css({
                position:position,
                top:top,
                left:left,
                width:width,
                'z-index': z_index
            });
        };

        $( window ).resize(function() {
            t.caculatePosition();
        });
        form.submit(function(event) {

            if (t.val() == "" && t.hasClass('required')) {
                t.focus();
                return false;
            } else {
                if ($('input.required-field').length && $('input.required-field').prop('checked') == true) {
                    var val = $('select[name="location_id_pick_up"] option:selected', form).val();
                    var text = $('input[name="pick-up"]', form).val();
                    $('select[name="location_id_drop_off"] option[value="' + val + '"]', form).prop('selected', true);
                    $('input[name="drop-off"]', form).val(text);
                }
                if ($('input.required-field').length && $('input.required-field').prop('checked') == false && $('input[name="drop-off"]', form).val() == "") {
                    $('input[name="drop-off"]', form).focus();
                    $('select[name="location_id_drop_off"] option', form).prop('selected', false);
                    return false;
                }
            }
        });
    });

    function get_highlight(text, val) {
        var highlight = text.replace(
            new RegExp(val + '(?!([^<]+)?>)', 'gi'),
            '<span class="highlight">$&</span>'
        );
        return highlight;
    }

    $.fn.focusNextInputField = function() {
        return this.each(function() {
            var fields = $(this).parents('form:eq(0),body').find('button:visible,input:visible,textarea:visible,select:visible');
            var index = fields.index( this );
            if ( index > -1 && ( index + 1 ) < fields.length ) {
                fields.eq( index + 1 ).focus();
            }
            return false;
        });
    };

});


;!function(t,i,s,o,e){"use strict";var h=0,r=function(){var i,s=o.userAgent,e=/msie\s\d+/i;return s.search(e)>0&&(i=e.exec(s).toString(),i=i.split(" ")[1],9>i)?(t("html").addClass("lt-ie9"),!0):!1}();Function.prototype.bind||(Function.prototype.bind=function(t){var i=this,s=[].slice;if("function"!=typeof i)throw new TypeError;var o=s.call(arguments,1),e=function(){if(this instanceof e){var h=function(){};h.prototype=i.prototype;var r=new h,a=i.apply(r,o.concat(s.call(arguments)));return Object(a)===a?a:r}return i.apply(t,o.concat(s.call(arguments)))};return e}),Array.prototype.indexOf||(Array.prototype.indexOf=function(t,i){var s;if(null==this)throw new TypeError('"this" is null or not defined');var o=Object(this),e=o.length>>>0;if(0===e)return-1;var h=+i||0;if(Math.abs(h)===1/0&&(h=0),h>=e)return-1;for(s=Math.max(h>=0?h:e-Math.abs(h),0);e>s;){if(s in o&&o[s]===t)return s;s++}return-1});var a='<span class="irs"><span class="irs-line" tabindex="-1"><span class="irs-line-left"></span><span class="irs-line-mid"></span><span class="irs-line-right"></span></span><span class="irs-min">0</span><span class="irs-max">1</span><span class="irs-from">0</span><span class="irs-to">0</span><span class="irs-single">0</span></span><span class="irs-grid"></span><span class="irs-bar"></span>',n='<span class="irs-bar-edge"></span><span class="irs-shadow shadow-single"></span><span class="irs-slider single"></span>',c='<span class="irs-shadow shadow-from"></span><span class="irs-shadow shadow-to"></span><span class="irs-slider from"></span><span class="irs-slider to"></span>',l='<span class="irs-disable-mask"></span>',p=function(o,e,h){this.VERSION="2.0.13",this.input=o,this.plugin_count=h,this.current_plugin=0,this.calc_count=0,this.update_tm=0,this.old_from=0,this.old_to=0,this.raf_id=null,this.dragging=!1,this.force_redraw=!1,this.is_key=!1,this.is_update=!1,this.is_start=!0,this.is_finish=!1,this.is_active=!1,this.is_resize=!1,this.is_click=!1,this.$cache={win:t(s),body:t(i.body),input:t(o),cont:null,rs:null,min:null,max:null,from:null,to:null,single:null,bar:null,line:null,s_single:null,s_from:null,s_to:null,shad_single:null,shad_from:null,shad_to:null,edge:null,grid:null,grid_labels:[]};var r=this.$cache.input,a={type:r.data("type"),min:r.data("min"),max:r.data("max"),from:r.data("from"),to:r.data("to"),step:r.data("step"),min_interval:r.data("minInterval"),max_interval:r.data("maxInterval"),drag_interval:r.data("dragInterval"),values:r.data("values"),from_fixed:r.data("fromFixed"),from_min:r.data("fromMin"),from_max:r.data("fromMax"),from_shadow:r.data("fromShadow"),to_fixed:r.data("toFixed"),to_min:r.data("toMin"),to_max:r.data("toMax"),to_shadow:r.data("toShadow"),prettify_enabled:r.data("prettifyEnabled"),prettify_separator:r.data("prettifySeparator"),force_edges:r.data("forceEdges"),keyboard:r.data("keyboard"),keyboard_step:r.data("keyboardStep"),grid:r.data("grid"),grid_margin:r.data("gridMargin"),grid_num:r.data("gridNum"),grid_snap:r.data("gridSnap"),hide_min_max:r.data("hideMinMax"),hide_from_to:r.data("hideFromTo"),prefix:r.data("prefix"),postfix:r.data("postfix"),max_postfix:r.data("maxPostfix"),decorate_both:r.data("decorateBoth"),values_separator:r.data("valuesSeparator"),disable:r.data("disable")};a.values=a.values&&a.values.split(",");var n=r.prop("value");n&&(n=n.split(";"),n[0]&&n[0]==+n[0]&&(n[0]=+n[0]),n[1]&&n[1]==+n[1]&&(n[1]=+n[1]),e&&e.values&&e.values.length?(a.from=n[0]&&e.values.indexOf(n[0]),a.to=n[1]&&e.values.indexOf(n[1])):(a.from=n[0]&&+n[0],a.to=n[1]&&+n[1])),e=t.extend(a,e),this.options=t.extend({type:"single",min:10,max:100,from:null,to:null,step:1,min_interval:0,max_interval:0,drag_interval:!1,values:[],p_values:[],from_fixed:!1,from_min:null,from_max:null,from_shadow:!1,to_fixed:!1,to_min:null,to_max:null,to_shadow:!1,prettify_enabled:!0,prettify_separator:" ",prettify:null,force_edges:!1,keyboard:!1,keyboard_step:5,grid:!1,grid_margin:!0,grid_num:4,grid_snap:!1,hide_min_max:!1,hide_from_to:!1,prefix:"",postfix:"",max_postfix:"",decorate_both:!0,values_separator:" — ",disable:!1,onStart:null,onChange:null,onFinish:null,onUpdate:null},e),this.validate(),this.result={input:this.$cache.input,slider:null,min:this.options.min,max:this.options.max,from:this.options.from,from_percent:0,from_value:null,to:this.options.to,to_percent:0,to_value:null},this.coords={x_gap:0,x_pointer:0,w_rs:0,w_rs_old:0,w_handle:0,p_gap:0,p_gap_left:0,p_gap_right:0,p_step:0,p_pointer:0,p_handle:0,p_single:0,p_single_real:0,p_from:0,p_from_real:0,p_to:0,p_to_real:0,p_bar_x:0,p_bar_w:0,grid_gap:0,big_num:0,big:[],big_w:[],big_p:[],big_x:[]},this.labels={w_min:0,w_max:0,w_from:0,w_to:0,w_single:0,p_min:0,p_max:0,p_from:0,p_from_left:0,p_to:0,p_to_left:0,p_single:0,p_single_left:0},this.init()};p.prototype={init:function(t){this.coords.p_step=this.options.step/((this.options.max-this.options.min)/100),this.target="base",this.toggleInput(),this.append(),this.setMinMax(),t?(this.force_redraw=!0,this.calc(!0),this.callOnUpdate()):(this.force_redraw=!0,this.calc(!0),this.callOnStart()),this.updateScene()},append:function(){var t='<span class="irs js-irs-'+this.plugin_count+'"></span>';this.$cache.input.before(t),this.$cache.input.prop("readonly",!0),this.$cache.cont=this.$cache.input.prev(),this.result.slider=this.$cache.cont,this.$cache.cont.html(a),this.$cache.rs=this.$cache.cont.find(".irs"),this.$cache.min=this.$cache.cont.find(".irs-min"),this.$cache.max=this.$cache.cont.find(".irs-max"),this.$cache.from=this.$cache.cont.find(".irs-from"),this.$cache.to=this.$cache.cont.find(".irs-to"),this.$cache.single=this.$cache.cont.find(".irs-single"),this.$cache.bar=this.$cache.cont.find(".irs-bar"),this.$cache.line=this.$cache.cont.find(".irs-line"),this.$cache.grid=this.$cache.cont.find(".irs-grid"),"single"===this.options.type?(this.$cache.cont.append(n),this.$cache.edge=this.$cache.cont.find(".irs-bar-edge"),this.$cache.s_single=this.$cache.cont.find(".single"),this.$cache.from[0].style.visibility="hidden",this.$cache.to[0].style.visibility="hidden",this.$cache.shad_single=this.$cache.cont.find(".shadow-single")):(this.$cache.cont.append(c),this.$cache.s_from=this.$cache.cont.find(".from"),this.$cache.s_to=this.$cache.cont.find(".to"),this.$cache.shad_from=this.$cache.cont.find(".shadow-from"),this.$cache.shad_to=this.$cache.cont.find(".shadow-to"),this.setTopHandler()),this.options.hide_from_to&&(this.$cache.from[0].style.display="none",this.$cache.to[0].style.display="none",this.$cache.single[0].style.display="none"),this.appendGrid(),this.options.disable?(this.appendDisableMask(),this.$cache.input[0].disabled=!0):(this.$cache.cont.removeClass("irs-disabled"),this.$cache.input[0].disabled=!1,this.bindEvents())},setTopHandler:function(){var t=this.options.min,i=this.options.max,s=this.options.from,o=this.options.to;s>t&&o===i?this.$cache.s_from.addClass("type_last"):i>o&&this.$cache.s_to.addClass("type_last")},appendDisableMask:function(){this.$cache.cont.append(l),this.$cache.cont.addClass("irs-disabled")},remove:function(){this.$cache.cont.remove(),this.$cache.cont=null,this.$cache.line.off("keydown.irs_"+this.plugin_count),this.$cache.body.off("touchmove.irs_"+this.plugin_count),this.$cache.body.off("mousemove.irs_"+this.plugin_count),this.$cache.win.off("touchend.irs_"+this.plugin_count),this.$cache.win.off("mouseup.irs_"+this.plugin_count),r&&(this.$cache.body.off("mouseup.irs_"+this.plugin_count),this.$cache.body.off("mouseleave.irs_"+this.plugin_count)),this.$cache.grid_labels=[],this.coords.big=[],this.coords.big_w=[],this.coords.big_p=[],this.coords.big_x=[],cancelAnimationFrame(this.raf_id)},bindEvents:function(){this.$cache.body.on("touchmove.irs_"+this.plugin_count,this.pointerMove.bind(this)),this.$cache.body.on("mousemove.irs_"+this.plugin_count,this.pointerMove.bind(this)),this.$cache.win.on("touchend.irs_"+this.plugin_count,this.pointerUp.bind(this)),this.$cache.win.on("mouseup.irs_"+this.plugin_count,this.pointerUp.bind(this)),this.$cache.line.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.line.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.options.drag_interval&&"double"===this.options.type?(this.$cache.bar.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"both")),this.$cache.bar.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"both"))):(this.$cache.bar.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.bar.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click"))),"single"===this.options.type?(this.$cache.single.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.s_single.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.shad_single.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.single.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.s_single.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.edge.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.shad_single.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click"))):(this.$cache.single.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.single.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.from.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.s_from.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.to.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.s_to.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.shad_from.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.shad_to.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.from.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.s_from.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.to.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.s_to.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.shad_from.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.shad_to.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click"))),this.options.keyboard&&this.$cache.line.on("keydown.irs_"+this.plugin_count,this.key.bind(this,"keyboard")),r&&(this.$cache.body.on("mouseup.irs_"+this.plugin_count,this.pointerUp.bind(this)),this.$cache.body.on("mouseleave.irs_"+this.plugin_count,this.pointerUp.bind(this)))},pointerMove:function(t){if(this.dragging){var i=t.pageX||t.originalEvent.touches&&t.originalEvent.touches[0].pageX;this.coords.x_pointer=i-this.coords.x_gap,this.calc()}},pointerUp:function(i){this.current_plugin===this.plugin_count&&this.is_active&&(this.is_active=!1,(t.contains(this.$cache.cont[0],i.target)||this.dragging)&&(this.is_finish=!0,this.callOnFinish()),this.$cache.cont.find(".state_hover").removeClass("state_hover"),this.force_redraw=!0,this.dragging=!1,r&&t("*").prop("unselectable",!1),this.updateScene())},changeLevel:function(t){switch(t){case"single":this.coords.p_gap=this.toFixed(this.coords.p_pointer-this.coords.p_single);break;case"from":this.coords.p_gap=this.toFixed(this.coords.p_pointer-this.coords.p_from),this.$cache.s_from.addClass("state_hover"),this.$cache.s_from.addClass("type_last"),this.$cache.s_to.removeClass("type_last");break;case"to":this.coords.p_gap=this.toFixed(this.coords.p_pointer-this.coords.p_to),this.$cache.s_to.addClass("state_hover"),this.$cache.s_to.addClass("type_last"),this.$cache.s_from.removeClass("type_last");break;case"both":this.coords.p_gap_left=this.toFixed(this.coords.p_pointer-this.coords.p_from),this.coords.p_gap_right=this.toFixed(this.coords.p_to-this.coords.p_pointer),this.$cache.s_to.removeClass("type_last"),this.$cache.s_from.removeClass("type_last")}},pointerDown:function(i,s){s.preventDefault();var o=s.pageX||s.originalEvent.touches&&s.originalEvent.touches[0].pageX;2!==s.button&&(this.current_plugin=this.plugin_count,this.target=i,this.is_active=!0,this.dragging=!0,this.coords.x_gap=this.$cache.rs.offset().left,this.coords.x_pointer=o-this.coords.x_gap,this.calcPointer(),this.changeLevel(i),r&&t("*").prop("unselectable",!0),this.$cache.line.trigger("focus"),this.updateScene())},pointerClick:function(t,i){i.preventDefault();var s=i.pageX||i.originalEvent.touches&&i.originalEvent.touches[0].pageX;2!==i.button&&(this.current_plugin=this.plugin_count,this.target=t,this.is_click=!0,this.coords.x_gap=this.$cache.rs.offset().left,this.coords.x_pointer=+(s-this.coords.x_gap).toFixed(),this.force_redraw=!0,this.calc(),this.$cache.line.trigger("focus"))},key:function(t,i){if(!(this.current_plugin!==this.plugin_count||i.altKey||i.ctrlKey||i.shiftKey||i.metaKey)){switch(i.which){case 83:case 65:case 40:case 37:i.preventDefault(),this.moveByKey(!1);break;case 87:case 68:case 38:case 39:i.preventDefault(),this.moveByKey(!0)}return!0}},moveByKey:function(t){var i=this.coords.p_pointer;t?i+=this.options.keyboard_step:i-=this.options.keyboard_step,this.coords.x_pointer=this.toFixed(this.coords.w_rs/100*i),this.is_key=!0,this.calc()},setMinMax:function(){if(this.options){if(this.options.hide_min_max)return this.$cache.min[0].style.display="none",void(this.$cache.max[0].style.display="none");this.options.values.length?(this.$cache.min.html(this.decorate(this.options.p_values[this.options.min])),this.$cache.max.html(this.decorate(this.options.p_values[this.options.max]))):(this.$cache.min.html(this.decorate(this._prettify(this.options.min),this.options.min)),this.$cache.max.html(this.decorate(this._prettify(this.options.max),this.options.max))),this.labels.w_min=this.$cache.min.outerWidth(!1),this.labels.w_max=this.$cache.max.outerWidth(!1)}},calc:function(t){if(this.options&&(this.calc_count++,(10===this.calc_count||t)&&(this.calc_count=0,this.coords.w_rs=this.$cache.rs.outerWidth(!1),"single"===this.options.type?this.coords.w_handle=this.$cache.s_single.outerWidth(!1):this.coords.w_handle=this.$cache.s_from.outerWidth(!1)),this.coords.w_rs)){this.calcPointer(),this.coords.p_handle=this.toFixed(this.coords.w_handle/this.coords.w_rs*100);var i=100-this.coords.p_handle,s=this.toFixed(this.coords.p_pointer-this.coords.p_gap);switch("click"===this.target&&(this.coords.p_gap=this.coords.p_handle/2,s=this.toFixed(this.coords.p_pointer-this.coords.p_gap),this.target=this.chooseHandle(s)),0>s?s=0:s>i&&(s=i),this.target){case"base":var o=(this.options.max-this.options.min)/100,e=(this.result.from-this.options.min)/o,h=(this.result.to-this.options.min)/o;this.coords.p_single_real=this.toFixed(e),this.coords.p_from_real=this.toFixed(e),this.coords.p_to_real=this.toFixed(h),this.coords.p_single_real=this.checkDiapason(this.coords.p_single_real,this.options.from_min,this.options.from_max),this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max),this.coords.p_to_real=this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max),this.coords.p_single=this.toFixed(e-this.coords.p_handle/100*e),this.coords.p_from=this.toFixed(e-this.coords.p_handle/100*e),this.coords.p_to=this.toFixed(h-this.coords.p_handle/100*h),this.target=null;break;case"single":if(this.options.from_fixed)break;this.coords.p_single_real=this.calcWithStep(s/i*100),this.coords.p_single_real=this.checkDiapason(this.coords.p_single_real,this.options.from_min,this.options.from_max),this.coords.p_single=this.toFixed(this.coords.p_single_real/100*i);break;case"from":if(this.options.from_fixed)break;this.coords.p_from_real=this.calcWithStep(s/i*100),this.coords.p_from_real>this.coords.p_to_real&&(this.coords.p_from_real=this.coords.p_to_real),this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max),this.coords.p_from_real=this.checkMinInterval(this.coords.p_from_real,this.coords.p_to_real,"from"),this.coords.p_from_real=this.checkMaxInterval(this.coords.p_from_real,this.coords.p_to_real,"from"),this.coords.p_from=this.toFixed(this.coords.p_from_real/100*i);break;case"to":if(this.options.to_fixed)break;this.coords.p_to_real=this.calcWithStep(s/i*100),this.coords.p_to_real<this.coords.p_from_real&&(this.coords.p_to_real=this.coords.p_from_real),this.coords.p_to_real=this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max),this.coords.p_to_real=this.checkMinInterval(this.coords.p_to_real,this.coords.p_from_real,"to"),this.coords.p_to_real=this.checkMaxInterval(this.coords.p_to_real,this.coords.p_from_real,"to"),this.coords.p_to=this.toFixed(this.coords.p_to_real/100*i);break;case"both":if(this.options.from_fixed||this.options.to_fixed)break;s=this.toFixed(s+.1*this.coords.p_handle),this.coords.p_from_real=this.calcWithStep((s-this.coords.p_gap_left)/i*100),this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max),this.coords.p_from_real=this.checkMinInterval(this.coords.p_from_real,this.coords.p_to_real,"from"),this.coords.p_from=this.toFixed(this.coords.p_from_real/100*i),this.coords.p_to_real=this.calcWithStep((s+this.coords.p_gap_right)/i*100),this.coords.p_to_real=this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max),this.coords.p_to_real=this.checkMinInterval(this.coords.p_to_real,this.coords.p_from_real,"to"),this.coords.p_to=this.toFixed(this.coords.p_to_real/100*i)}"single"===this.options.type?(this.coords.p_bar_x=this.coords.p_handle/2,this.coords.p_bar_w=this.coords.p_single,this.result.from_percent=this.coords.p_single_real,this.result.from=this.calcReal(this.coords.p_single_real),this.options.values.length&&(this.result.from_value=this.options.values[this.result.from])):(this.coords.p_bar_x=this.toFixed(this.coords.p_from+this.coords.p_handle/2),this.coords.p_bar_w=this.toFixed(this.coords.p_to-this.coords.p_from),this.result.from_percent=this.coords.p_from_real,this.result.from=this.calcReal(this.coords.p_from_real),this.result.to_percent=this.coords.p_to_real,this.result.to=this.calcReal(this.coords.p_to_real),this.options.values.length&&(this.result.from_value=this.options.values[this.result.from],this.result.to_value=this.options.values[this.result.to])),this.calcMinMax(),this.calcLabels()}},calcPointer:function(){return this.coords.w_rs?(this.coords.x_pointer<0||isNaN(this.coords.x_pointer)?this.coords.x_pointer=0:this.coords.x_pointer>this.coords.w_rs&&(this.coords.x_pointer=this.coords.w_rs),void(this.coords.p_pointer=this.toFixed(this.coords.x_pointer/this.coords.w_rs*100))):void(this.coords.p_pointer=0)},chooseHandle:function(t){if("single"===this.options.type)return"single";var i=this.coords.p_from_real+(this.coords.p_to_real-this.coords.p_from_real)/2;return t>=i?this.options.to_fixed?"from":"to":this.options.from_fixed?"to":"from"},calcMinMax:function(){this.coords.w_rs&&(this.labels.p_min=this.labels.w_min/this.coords.w_rs*100,this.labels.p_max=this.labels.w_max/this.coords.w_rs*100)},calcLabels:function(){this.coords.w_rs&&!this.options.hide_from_to&&("single"===this.options.type?(this.labels.w_single=this.$cache.single.outerWidth(!1),this.labels.p_single=this.labels.w_single/this.coords.w_rs*100,this.labels.p_single_left=this.coords.p_single+this.coords.p_handle/2-this.labels.p_single/2,this.labels.p_single_left=this.checkEdges(this.labels.p_single_left,this.labels.p_single)):(this.labels.w_from=this.$cache.from.outerWidth(!1),this.labels.p_from=this.labels.w_from/this.coords.w_rs*100,this.labels.p_from_left=this.coords.p_from+this.coords.p_handle/2-this.labels.p_from/2,this.labels.p_from_left=this.toFixed(this.labels.p_from_left),this.labels.p_from_left=this.checkEdges(this.labels.p_from_left,this.labels.p_from),this.labels.w_to=this.$cache.to.outerWidth(!1),this.labels.p_to=this.labels.w_to/this.coords.w_rs*100,this.labels.p_to_left=this.coords.p_to+this.coords.p_handle/2-this.labels.p_to/2,this.labels.p_to_left=this.toFixed(this.labels.p_to_left),this.labels.p_to_left=this.checkEdges(this.labels.p_to_left,this.labels.p_to),this.labels.w_single=this.$cache.single.outerWidth(!1),this.labels.p_single=this.labels.w_single/this.coords.w_rs*100,this.labels.p_single_left=(this.labels.p_from_left+this.labels.p_to_left+this.labels.p_to)/2-this.labels.p_single/2,this.labels.p_single_left=this.toFixed(this.labels.p_single_left),this.labels.p_single_left=this.checkEdges(this.labels.p_single_left,this.labels.p_single)))},updateScene:function(){this.raf_id&&(cancelAnimationFrame(this.raf_id),this.raf_id=null),clearTimeout(this.update_tm),this.update_tm=null,this.options&&(this.drawHandles(),this.is_active?this.raf_id=requestAnimationFrame(this.updateScene.bind(this)):this.update_tm=setTimeout(this.updateScene.bind(this),300))},drawHandles:function(){this.coords.w_rs=this.$cache.rs.outerWidth(!1),this.coords.w_rs&&(this.coords.w_rs!==this.coords.w_rs_old&&(this.target="base",this.is_resize=!0),(this.coords.w_rs!==this.coords.w_rs_old||this.force_redraw)&&(this.setMinMax(),this.calc(!0),this.drawLabels(),this.options.grid&&(this.calcGridMargin(),this.calcGridLabels()),this.force_redraw=!0,this.coords.w_rs_old=this.coords.w_rs,this.drawShadow()),this.coords.w_rs&&(this.dragging||this.force_redraw||this.is_key)&&((this.old_from!==this.result.from||this.old_to!==this.result.to||this.force_redraw||this.is_key)&&(this.drawLabels(),this.$cache.bar[0].style.left=this.coords.p_bar_x+"%",this.$cache.bar[0].style.width=this.coords.p_bar_w+"%","single"===this.options.type?(this.$cache.s_single[0].style.left=this.coords.p_single+"%",this.$cache.single[0].style.left=this.labels.p_single_left+"%",this.options.values.length?(this.$cache.input.prop("value",this.result.from_value),this.$cache.input.data("from",this.result.from_value)):(this.$cache.input.prop("value",this.result.from),this.$cache.input.data("from",this.result.from))):(this.$cache.s_from[0].style.left=this.coords.p_from+"%",this.$cache.s_to[0].style.left=this.coords.p_to+"%",(this.old_from!==this.result.from||this.force_redraw)&&(this.$cache.from[0].style.left=this.labels.p_from_left+"%"),(this.old_to!==this.result.to||this.force_redraw)&&(this.$cache.to[0].style.left=this.labels.p_to_left+"%"),this.$cache.single[0].style.left=this.labels.p_single_left+"%",this.options.values.length?(this.$cache.input.prop("value",this.result.from_value+";"+this.result.to_value),this.$cache.input.data("from",this.result.from_value),this.$cache.input.data("to",this.result.to_value)):(this.$cache.input.prop("value",this.result.from+";"+this.result.to),this.$cache.input.data("from",this.result.from),this.$cache.input.data("to",this.result.to))),this.old_from===this.result.from&&this.old_to===this.result.to||this.is_start||this.$cache.input.trigger("change"),this.old_from=this.result.from,this.old_to=this.result.to,this.is_resize||this.is_update||this.is_start||this.is_finish||this.callOnChange(),(this.is_key||this.is_click)&&this.callOnFinish(),this.is_update=!1,this.is_resize=!1,this.is_finish=!1),this.is_start=!1,this.is_key=!1,this.is_click=!1,this.force_redraw=!1))},callOnStart:function(){this.options.onStart&&"function"==typeof this.options.onStart&&this.options.onStart(this.result)},callOnChange:function(){this.options.onChange&&"function"==typeof this.options.onChange&&this.options.onChange(this.result)},callOnFinish:function(){this.options.onFinish&&"function"==typeof this.options.onFinish&&this.options.onFinish(this.result)},callOnUpdate:function(){this.options.onUpdate&&"function"==typeof this.options.onUpdate&&this.options.onUpdate(this.result)},drawLabels:function(){if(this.options){var t,i,s,o=this.options.values.length,e=this.options.p_values;if(!this.options.hide_from_to)if("single"===this.options.type)o?(t=this.decorate(e[this.result.from]),this.$cache.single.html(t)):(t=this.decorate(this._prettify(this.result.from),this.result.from),this.$cache.single.html(t)),this.calcLabels(),this.labels.p_single_left<this.labels.p_min+1?this.$cache.min[0].style.visibility="hidden":this.$cache.min[0].style.visibility="visible",this.labels.p_single_left+this.labels.p_single>100-this.labels.p_max-1?this.$cache.max[0].style.visibility="hidden":this.$cache.max[0].style.visibility="visible";else{o?(this.options.decorate_both?(t=this.decorate(e[this.result.from]),t+=this.options.values_separator,t+=this.decorate(e[this.result.to])):t=this.decorate(e[this.result.from]+this.options.values_separator+e[this.result.to]),i=this.decorate(e[this.result.from]),s=this.decorate(e[this.result.to]),this.$cache.single.html(t),this.$cache.from.html(i),this.$cache.to.html(s)):(this.options.decorate_both?(t=this.decorate(this._prettify(this.result.from),this.result.from),t+=this.options.values_separator,t+=this.decorate(this._prettify(this.result.to),this.result.to)):t=this.decorate(this._prettify(this.result.from)+this.options.values_separator+this._prettify(this.result.to),this.result.to),i=this.decorate(this._prettify(this.result.from),this.result.from),s=this.decorate(this._prettify(this.result.to),this.result.to),this.$cache.single.html(t),this.$cache.from.html(i),this.$cache.to.html(s)),this.calcLabels();var h=Math.min(this.labels.p_single_left,this.labels.p_from_left),r=this.labels.p_single_left+this.labels.p_single,a=this.labels.p_to_left+this.labels.p_to,n=Math.max(r,a);this.labels.p_from_left+this.labels.p_from>=this.labels.p_to_left?(this.$cache.from[0].style.visibility="hidden",this.$cache.to[0].style.visibility="hidden",this.$cache.single[0].style.visibility="visible",this.result.from===this.result.to?(this.$cache.from[0].style.visibility="visible",this.$cache.single[0].style.visibility="hidden",n=a):(this.$cache.from[0].style.visibility="hidden",this.$cache.single[0].style.visibility="visible",n=Math.max(r,a))):(this.$cache.from[0].style.visibility="visible",this.$cache.to[0].style.visibility="visible",this.$cache.single[0].style.visibility="hidden"),h<this.labels.p_min+1?this.$cache.min[0].style.visibility="hidden":this.$cache.min[0].style.visibility="visible",n>100-this.labels.p_max-1?this.$cache.max[0].style.visibility="hidden":this.$cache.max[0].style.visibility="visible"}}},drawShadow:function(){var t,i,s,o,e=this.options,h=this.$cache,r="number"==typeof e.from_min&&!isNaN(e.from_min),a="number"==typeof e.from_max&&!isNaN(e.from_max),n="number"==typeof e.to_min&&!isNaN(e.to_min),c="number"==typeof e.to_max&&!isNaN(e.to_max);"single"===e.type?e.from_shadow&&(r||a)?(t=this.calcPercent(r?e.from_min:e.min),i=this.calcPercent(a?e.from_max:e.max)-t,t=this.toFixed(t-this.coords.p_handle/100*t),i=this.toFixed(i-this.coords.p_handle/100*i),t+=this.coords.p_handle/2,h.shad_single[0].style.display="block",h.shad_single[0].style.left=t+"%",h.shad_single[0].style.width=i+"%"):h.shad_single[0].style.display="none":(e.from_shadow&&(r||a)?(t=this.calcPercent(r?e.from_min:e.min),i=this.calcPercent(a?e.from_max:e.max)-t,t=this.toFixed(t-this.coords.p_handle/100*t),i=this.toFixed(i-this.coords.p_handle/100*i),t+=this.coords.p_handle/2,h.shad_from[0].style.display="block",h.shad_from[0].style.left=t+"%",h.shad_from[0].style.width=i+"%"):h.shad_from[0].style.display="none",e.to_shadow&&(n||c)?(s=this.calcPercent(n?e.to_min:e.min),o=this.calcPercent(c?e.to_max:e.max)-s,s=this.toFixed(s-this.coords.p_handle/100*s),o=this.toFixed(o-this.coords.p_handle/100*o),s+=this.coords.p_handle/2,h.shad_to[0].style.display="block",h.shad_to[0].style.left=s+"%",h.shad_to[0].style.width=o+"%"):h.shad_to[0].style.display="none")},toggleInput:function(){this.$cache.input.toggleClass("irs-hidden-input")},calcPercent:function(t){var i=(this.options.max-this.options.min)/100,s=(t-this.options.min)/i;return this.toFixed(s)},calcReal:function(t){var i,s,o=this.options.min,e=this.options.max,h=o.toString().split(".")[1],r=e.toString().split(".")[1],a=0,n=0;if(0===t)return this.options.min;if(100===t)return this.options.max;h&&(i=h.length,a=i),r&&(s=r.length,a=s),i&&s&&(a=i>=s?i:s),0>o&&(n=Math.abs(o),o=+(o+n).toFixed(a),e=+(e+n).toFixed(a));var c,l=(e-o)/100*t+o,p=this.options.step.toString().split(".")[1];return p?l=+l.toFixed(p.length):(l/=this.options.step,l*=this.options.step,l=+l.toFixed(0)),n&&(l-=n),c=p?+l.toFixed(p.length):this.toFixed(l),c<this.options.min?c=this.options.min:c>this.options.max&&(c=this.options.max),c},calcWithStep:function(t){var i=Math.round(t/this.coords.p_step)*this.coords.p_step;return i>100&&(i=100),100===t&&(i=100),this.toFixed(i)},checkMinInterval:function(t,i,s){var o,e,h=this.options;return h.min_interval?(o=this.calcReal(t),e=this.calcReal(i),"from"===s?e-o<h.min_interval&&(o=e-h.min_interval):o-e<h.min_interval&&(o=e+h.min_interval),this.calcPercent(o)):t},checkMaxInterval:function(t,i,s){var o,e,h=this.options;return h.max_interval?(o=this.calcReal(t),e=this.calcReal(i),"from"===s?e-o>h.max_interval&&(o=e-h.max_interval):o-e>h.max_interval&&(o=e+h.max_interval),this.calcPercent(o)):t},checkDiapason:function(t,i,s){var o=this.calcReal(t),e=this.options;return"number"!=typeof i&&(i=e.min),"number"!=typeof s&&(s=e.max),i>o&&(o=i),o>s&&(o=s),this.calcPercent(o)},toFixed:function(t){return t=t.toFixed(9),+t},_prettify:function(t){return this.options.prettify_enabled?this.options.prettify&&"function"==typeof this.options.prettify?this.options.prettify(t):this.prettify(t):t},prettify:function(t){var i=t.toString();return i.replace(/(\d{1,3}(?=(?:\d\d\d)+(?!\d)))/g,"$1"+this.options.prettify_separator)},checkEdges:function(t,i){return this.options.force_edges?(0>t?t=0:t>100-i&&(t=100-i),this.toFixed(t)):this.toFixed(t)},validate:function(){var t,i,s=this.options,o=this.result,e=s.values,h=e.length;if("string"==typeof s.min&&(s.min=+s.min),"string"==typeof s.max&&(s.max=+s.max),"string"==typeof s.from&&(s.from=+s.from),"string"==typeof s.to&&(s.to=+s.to),"string"==typeof s.step&&(s.step=+s.step),"string"==typeof s.from_min&&(s.from_min=+s.from_min),"string"==typeof s.from_max&&(s.from_max=+s.from_max),"string"==typeof s.to_min&&(s.to_min=+s.to_min),"string"==typeof s.to_max&&(s.to_max=+s.to_max),"string"==typeof s.keyboard_step&&(s.keyboard_step=+s.keyboard_step),"string"==typeof s.grid_num&&(s.grid_num=+s.grid_num),s.max<=s.min&&(s.min?s.max=2*s.min:s.max=s.min+1,s.step=1),h)for(s.p_values=[],s.min=0,s.max=h-1,s.step=1,s.grid_num=s.max,s.grid_snap=!0,i=0;h>i;i++)t=+e[i],isNaN(t)?t=e[i]:(e[i]=t,t=this._prettify(t)),s.p_values.push(t);("number"!=typeof s.from||isNaN(s.from))&&(s.from=s.min),("number"!=typeof s.to||isNaN(s.from))&&(s.to=s.max),"single"===s.type?(s.from<s.min&&(s.from=s.min),s.from>s.max&&(s.from=s.max)):((s.from<s.min||s.from>s.max)&&(s.from=s.min),(s.to>s.max||s.to<s.min)&&(s.to=s.max),s.from>s.to&&(s.from=s.to)),("number"!=typeof s.step||isNaN(s.step)||!s.step||s.step<0)&&(s.step=1),("number"!=typeof s.keyboard_step||isNaN(s.keyboard_step)||!s.keyboard_step||s.keyboard_step<0)&&(s.keyboard_step=5),"number"==typeof s.from_min&&s.from<s.from_min&&(s.from=s.from_min),"number"==typeof s.from_max&&s.from>s.from_max&&(s.from=s.from_max),"number"==typeof s.to_min&&s.to<s.to_min&&(s.to=s.to_min),"number"==typeof s.to_max&&s.from>s.to_max&&(s.to=s.to_max),o&&(o.min!==s.min&&(o.min=s.min),o.max!==s.max&&(o.max=s.max),(o.from<o.min||o.from>o.max)&&(o.from=s.from),(o.to<o.min||o.to>o.max)&&(o.to=s.to)),("number"!=typeof s.min_interval||isNaN(s.min_interval)||!s.min_interval||s.min_interval<0)&&(s.min_interval=0),("number"!=typeof s.max_interval||isNaN(s.max_interval)||!s.max_interval||s.max_interval<0)&&(s.max_interval=0),s.min_interval&&s.min_interval>s.max-s.min&&(s.min_interval=s.max-s.min),s.max_interval&&s.max_interval>s.max-s.min&&(s.max_interval=s.max-s.min);
},decorate:function(t,i){var s="",o=this.options;return o.prefix&&(s+=o.prefix),s+=t,o.max_postfix&&(o.values.length&&t===o.p_values[o.max]?(s+=o.max_postfix,o.postfix&&(s+=" ")):i===o.max&&(s+=o.max_postfix,o.postfix&&(s+=" "))),o.postfix&&(s+=o.postfix),s},updateFrom:function(){this.result.from=this.options.from,this.result.from_percent=this.calcPercent(this.result.from),this.options.values&&(this.result.from_value=this.options.values[this.result.from])},updateTo:function(){this.result.to=this.options.to,this.result.to_percent=this.calcPercent(this.result.to),this.options.values&&(this.result.to_value=this.options.values[this.result.to])},updateResult:function(){this.result.min=this.options.min,this.result.max=this.options.max,this.updateFrom(),this.updateTo()},appendGrid:function(){if(this.options.grid){var t,i,s,o,e,h=this.options,r=h.max-h.min,a=h.grid_num,n=0,c=0,l=4,p=0,_="";for(this.calcGridMargin(),h.grid_snap?(a=r/h.step,n=this.toFixed(h.step/(r/100))):n=this.toFixed(100/a),a>4&&(l=3),a>7&&(l=2),a>14&&(l=1),a>28&&(l=0),t=0;a+1>t;t++){for(s=l,c=this.toFixed(n*t),c>100&&(c=100,s-=2,0>s&&(s=0)),this.coords.big[t]=c,o=(c-n*(t-1))/(s+1),i=1;s>=i&&0!==c;i++)p=this.toFixed(c-o*i),_+='<span class="irs-grid-pol small" style="left: '+p+'%"></span>';_+='<span class="irs-grid-pol" style="left: '+c+'%"></span>',e=this.calcReal(c),e=h.values.length?h.p_values[e]:this._prettify(e),_+='<span class="irs-grid-text js-grid-text-'+t+'" style="left: '+c+'%">'+e+"</span>"}this.coords.big_num=Math.ceil(a+1),this.$cache.cont.addClass("irs-with-grid"),this.$cache.grid.html(_),this.cacheGridLabels()}},cacheGridLabels:function(){var t,i,s=this.coords.big_num;for(i=0;s>i;i++)t=this.$cache.grid.find(".js-grid-text-"+i),this.$cache.grid_labels.push(t);this.calcGridLabels()},calcGridLabels:function(){var t,i,s=[],o=[],e=this.coords.big_num;for(t=0;e>t;t++)this.coords.big_w[t]=this.$cache.grid_labels[t].outerWidth(!1),this.coords.big_p[t]=this.toFixed(this.coords.big_w[t]/this.coords.w_rs*100),this.coords.big_x[t]=this.toFixed(this.coords.big_p[t]/2),s[t]=this.toFixed(this.coords.big[t]-this.coords.big_x[t]),o[t]=this.toFixed(s[t]+this.coords.big_p[t]);for(this.options.force_edges&&(s[0]<-this.coords.grid_gap&&(s[0]=-this.coords.grid_gap,o[0]=this.toFixed(s[0]+this.coords.big_p[0]),this.coords.big_x[0]=this.coords.grid_gap),o[e-1]>100+this.coords.grid_gap&&(o[e-1]=100+this.coords.grid_gap,s[e-1]=this.toFixed(o[e-1]-this.coords.big_p[e-1]),this.coords.big_x[e-1]=this.toFixed(this.coords.big_p[e-1]-this.coords.grid_gap))),this.calcGridCollision(2,s,o),this.calcGridCollision(4,s,o),t=0;e>t;t++)i=this.$cache.grid_labels[t][0],i.style.marginLeft=-this.coords.big_x[t]+"%"},calcGridCollision:function(t,i,s){var o,e,h,r=this.coords.big_num;for(o=0;r>o&&(e=o+t/2,!(e>=r));o+=t)h=this.$cache.grid_labels[e][0],s[o]<=i[e]?h.style.visibility="visible":h.style.visibility="hidden"},calcGridMargin:function(){this.options.grid_margin&&(this.coords.w_rs=this.$cache.rs.outerWidth(!1),this.coords.w_rs&&("single"===this.options.type?this.coords.w_handle=this.$cache.s_single.outerWidth(!1):this.coords.w_handle=this.$cache.s_from.outerWidth(!1),this.coords.p_handle=this.toFixed(this.coords.w_handle/this.coords.w_rs*100),this.coords.grid_gap=this.toFixed(this.coords.p_handle/2-.1),this.$cache.grid[0].style.width=this.toFixed(100-this.coords.p_handle)+"%",this.$cache.grid[0].style.left=this.coords.grid_gap+"%"))},update:function(i){this.input&&(this.is_update=!0,this.options.from=this.result.from,this.options.to=this.result.to,this.options=t.extend(this.options,i),this.validate(),this.updateResult(i),this.toggleInput(),this.remove(),this.init(!0))},reset:function(){this.input&&(this.updateResult(),this.update())},destroy:function(){this.input&&(this.toggleInput(),this.$cache.input.prop("readonly",!1),t.data(this.input,"ionRangeSlider",null),this.remove(),this.input=null,this.options=null)}},t.fn.ionRangeSlider=function(i){return this.each(function(){t.data(this,"ionRangeSlider")||t.data(this,"ionRangeSlider",new p(this,i,h++))})},function(){for(var t=0,i=["ms","moz","webkit","o"],o=0;o<i.length&&!s.requestAnimationFrame;++o)s.requestAnimationFrame=s[i[o]+"RequestAnimationFrame"],s.cancelAnimationFrame=s[i[o]+"CancelAnimationFrame"]||s[i[o]+"CancelRequestAnimationFrame"];s.requestAnimationFrame||(s.requestAnimationFrame=function(i,o){var e=(new Date).getTime(),h=Math.max(0,16-(e-t)),r=s.setTimeout(function(){i(e+h)},h);return t=e+h,r}),s.cancelAnimationFrame||(s.cancelAnimationFrame=function(t){clearTimeout(t)})}()}(jQuery,document,window,navigator);;/**
 * Created by PA25072016 on 6/14/2017.
 */

jQuery(document).ready(function($) {
    var last_select_clicked = false;
    $('body').append('<div class="option-wrapper1 st-option-wrapper1 st-flight-location"></div>');
    var j = 0;
    $('.st-flight-location-name').each(function(index, el) {
        var form = $(this).parents('form');
        var parent = $(this).parents('.st-select-wrapper');
        var t = $(this);
        var flag = true;
        $('.option-wrapper1',parent).remove();
        t.keyup(function(event) {
            last_select_clicked=t;
            if (event.which != 40 && event.which != 38 && event.which != 9) {
                val = $(this).val();
                if (event.which != 13) {

                    flag = false;
                    if( val != '' ){
                        html = '';
                        $('select option', parent).prop('selected', false);

                        $('select option', parent).each(function(index, el) {
                            var country = $(this).data('country');
                            var text = $(this).text();
                            var text_split = text.split("||");
                            text_split = text_split[0];
                            var highlight = get_highlight(text, val);
                            if (highlight.indexOf('</span>') > 0) {
                                var current_country = $(this).parent('select').attr('data-current-country');
                                if (typeof current_country != 'undefined' && current_country != '') {
                                    if (country == current_country) {
                                        html += '<div data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                            '<span class="label"><a href="#">' + text_split + '<i class="fa fa-planer"></i></a>' +
                                            '</div>';
                                    }
                                } else {
                                    html += '<div data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                        '<span class="label"><a href="#">' + text_split + '<i class="fa fa-plane"></i></a>' +
                                        '</div>';
                                }
                            }
                        });
                        $('.option-wrapper1').html(html).show();
                        t.caculatePosition($('.option-wrapper1'),t);
                    }else{
                        html = '';
                        $('select option', parent).prop('selected', false);

                        $('select option', parent).each(function(index, el) {
                            var country = $(this).data('country');
                            var text = $(this).text();
                            var text_split = text.split("||");
                            text_split = text_split[0];
                            if (text != '') {
                                var current_country = $(this).parent('select').attr('data-current-country');
                                if (typeof current_country != 'undefined' && current_country != '') {
                                    if (country == current_country) {
                                        html += '<div data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                            '<span class="label"><a href="#">' + text_split + '<i class="fa fa-plane"></i></a>' +
                                            '</div>';
                                    }
                                } else {
                                    html += '<div data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                        '<span class="label"><a href="#">' + text_split + '<i class="fa fa-plane"></i></a>' +
                                        '</div>';
                                }
                            }
                        });
                        $('.option-wrapper1').html(html).show();
                        t.caculatePosition($('.option-wrapper1', parent),t);
                    }

                }
                if (event.which == 13 && val != ""){

                }
                if (typeof t.data('children') != 'undefined' && t.data('children') != "") {
                    name = t.data('children');
                    $('select[name="' + name + '"]', form).attr('data-current-country', '');
                    $('input[name="drop-off"]', form).val('');
                    $('select[name="' + name + '"] option', form).prop('selected', false);
                }
            }


        });
        var liSelected;
        t.keydown(function(event) {
            last_select_clicked=t;
            if (event.which == 13) {
                var form = last_select_clicked.closest('form');
                $('.option-wrapper1').html('').hide();
                t.focusNextInputField();
                return false;
            }

            if (event.which == 9) {
                var form = last_select_clicked.closest('form');
                $('.option-wrapper1').html('').hide();
                t.focusNextInputField();
                return false;
            }

            if (event.which == 40 || event.which == 38) {
                if(event.which === 40){
                    var index = $('.option-wrapper1 .option.active').index();
                    if(liSelected){
                        liSelected.removeClass('active');
                        next = liSelected.next();
                        if(next.length > 0){
                            liSelected = next.addClass('active');
                        }else{
                            if($('.option-wrapper1 .option.active').length > 0){
                                $('.st-option-wrapper1 .option').eq(index).removeClass('active');
                                if(($('.option-wrapper1 .option').length - 1) == index){
                                    liSelected = $('.st-option-wrapper1 .option').eq(0).addClass('active');
                                }else{
                                    liSelected = $('.st-option-wrapper1 .option').eq(index + 1).addClass('active');
                                }
                            }else{
                                liSelected = $('.st-option-wrapper1 .option').eq(0).addClass('active');
                            }
                        }
                    }else{
                        liSelected = $('.st-option-wrapper1 .option').eq(0).addClass('active');
                    }
                }else if(event.which === 38){
                    var index = $('.option-wrapper1 .option.active').index();
                    if(liSelected){
                        liSelected.removeClass('active');
                        next = liSelected.prev();
                        if(next.length > 0){
                            liSelected = next.addClass('active');
                        }else{
                            if($('.option-wrapper1 .option.active').length > 0) {
                                $('.st-option-wrapper1 .option').eq(index).removeClass('active');
                                liSelected = $('.st-option-wrapper1 .option').eq(index-1).addClass('active');
                            }else{
                                liSelected = $('.st-option-wrapper1 .option').last().addClass('active');
                            }
                        }
                    }else{
                        liSelected = $('.st-option-wrapper1 .option').last().addClass('active');
                    }
                }

                $('.option-wrapper1').scrollTo($('.option-wrapper1 .option.active'), 400);

                event.preventDefault();
                flag = true;

                var value = $('.option-wrapper1 .option.active').data('value');
                var text = $('.option-wrapper1 .option.active').text();
                var country = $('.option-wrapper1 .option.active').data('country');
                t.val(text);
                $('select option[value="' + value + '"]', parent).prop('selected', true);


                if (typeof t.data('children') != 'undefined' && t.data('children') != "") {
                    name = t.data('children');
                    $('select[name="' + name + '"]', form).attr('data-current-country', country);
                }
            }

        });
        t.blur(function(event) {
            if (t.data('clear') == 'clear' && $('select option:selected', parent).val() == "") {
                t.val('');
            }
        });
        t.on("focus",function(event) {
            last_select_clicked=t;
            if (t.val() == '') {
                html = '';
                $('select option', parent).prop('selected', false);

                $('select option', parent).each(function(index, el) {
                    var country = $(this).data('country');
                    var text = $(this).text();
                    var text_split = text.split("||");
                    text_split = text_split[0];
                    if (text != '') {
                        var current_country = $(this).parent('select').attr('data-current-country');
                        if (typeof current_country != 'undefined' && current_country != '') {
                            if (country == current_country) {
                                html += '<div data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                    '<span class="label"><a href="#">' + text_split + '<i class="fa fa-plane"></i></a>' +
                                    '</div>';
                            }
                        } else {
                            html += '<div data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                '<span class="label"><a href="#">' + text_split + '<i class="fa fa-plane"></i></a>' +
                                '</div>';
                        }
                    }
                });

                if (typeof t.data('parent') != 'undefined' && t.data('parent') != "") {
                    name = t.data('parent');

                    if ($('select[name="' + name + '"]', form).length) {
                        var val = $('select[name="' + name + '"]', form).parent().find('input.st-flight-location-name').val();
                        if (typeof val == 'undefined' || val == '') {
                            t.val('');
                            $('select[name="' + name + '"]', form).parent().find('input.st-flight-location-name').focus();
                        }else{
                            $('.st-flight-location').html(html).show();
                        }
                    }
                }else{
                    $('.st-flight-location').html(html).show();
                }
            }
            t.caculatePosition();
        });
        $(document).on('click', '.option-wrapper1 .option', function(event) {
            if(last_select_clicked.length > 0) {
                var form = last_select_clicked.closest('form');
                var parent = last_select_clicked.closest('.st-select-wrapper');
                if(last_select_clicked.hasClass('destination')) {
                    setTimeout(function () {
                        if (typeof form.find('input[name="start"]').attr('value') != 'undefined') {
                            var $tmp = form.find('input[name="start"]').attr('value');
                            if ($tmp.length <= 0) {
                                form.find('input[name="start"]').datepicker('show');
                            }
                        }
                    }, 100);
                }
                event.preventDefault();
                flag = true;

                var value = $(this).data('value');
                var text = $(this).text();
                var country = $(this).data('country');
                if (text != "") {

                    last_select_clicked.val(text);

                    $('select option[value="' + value + '"]', parent).prop('selected', true);

                    $('.option-wrapper1').html('').hide();

                    if (typeof t.data('children') != 'undefined' && t.data('children') != "") {
                        name = t.data('children');
                        $('select[name="' + name + '"]', form).attr('data-current-country', country);
                    }
                }
            }
            //last_select_clicked.focusNextInputField();
        });
        $(document).click(function(event) {
            if (!$(event.target).is('.st-flight-location-name')) {
                $('.option-wrapper1').html('').hide();
            }
        });
        t.caculatePosition=function(){
            if(!last_select_clicked || !last_select_clicked.length) return;
            var wraper= $('.option-wrapper1');
            var input_tag= last_select_clicked;
            var offset=parent.offset();
            var top=offset.top+parent.height();
            var left=offset.left;
            var width=input_tag.outerWidth();
            var wpadminbar = 0;
            if( $('#wpadminbar').length && $(window).width() >= 783 ){
                wpadminbar = $('#wpadminbar').height();
            }else{
                wpadminbar = 0
            }
            if($('body').hasClass('boxed')){
                left = left  - $('body').offset().left;
            }

            top = top - wpadminbar;

            var z_index = 99999;
            var position = 'absolute';

            if( $('#search-dialog').length ){
                position = 'fixed';
                top = top + wpadminbar - $(window).scrollTop();
                z_index = 99999;
            }


            wraper.css({
                position:position,
                top:top,
                left:left,
                width:width,
                'z-index': z_index
            });
        };

        $( window ).resize(function() {
            t.caculatePosition();
        });
        form.submit(function(event) {

            if (t.val() == "" && t.hasClass('required')) {
                t.focus();
                return false;
            } else {
                if ($('input.required-field').length && $('input.required-field').prop('checked') == true) {
                    var val = $('select[name="location_id_pick_up"] option:selected', form).val();
                    var text = $('input[name="pick-up"]', form).val();
                    $('select[name="location_id_drop_off"] option[value="' + val + '"]', form).prop('selected', true);
                    $('input[name="drop-off"]', form).val(text);
                }
                if ($('input.required-field').length && $('input.required-field').prop('checked') == false && $('input[name="drop-off"]', form).val() == "") {
                    $('input[name="drop-off"]', form).focus();
                    $('select[name="location_id_drop_off"] option', form).prop('selected', false);
                    return false;
                }
            }
        });
    });

    function get_highlight(text, val) {
        var highlight = text.replace(
            new RegExp(val + '(?!([^<]+)?>)', 'gi'),
            '<span class="highlight">$&</span>'
        );
        return highlight;
    }

    $.fn.focusNextInputField = function() {
        return this.each(function() {
            var fields = $(this).parents('form:eq(0),body').find('button:visible,input:visible,textarea:visible,select:visible');
            var index = fields.index( this );
            if ( index > -1 && ( index + 1 ) < fields.length ) {
                fields.eq( index + 1 ).focus();
            }
            return false;
        });
    };

});;jQuery(document).ready(function ($) {
    "use strict";
    var last_select_clicked = !1;
    $('.tp-flight-location').each(function () {
        var t = $(this);
        var parent = t.closest('.tp-flight-wrapper');
        $(this).keyup(function (event) {
            last_select_clicked = t;
            parent.find('.st-location-id').remove();
            var name = t.attr('data-name');
            var locale = t.attr('data-locale');
            var val = t.val();
            if (val.length >= 2) {
                $.getJSON("https://autocomplete.travelpayouts.com/jravia?locale=" + locale + "&with_countries=false&q=" + val, function (data) {
                    if (typeof data == 'object') {
                        var html = '';
                        html += '<select name="' + name + '" class="st-location-id st-hidden" tabindex="-1">';
                        $.each(data, function (key, value) {
                            var f_name = '';
                            if (value.name != null) {
                                f_name = '(' + value.name + ')'
                            }
                            html += '<option value="' + value.code + '">' + value.city_fullname + ' ' + f_name + ' - ' + value.code + '</option>'
                        });
                        html += '</select>';
                        parent.find('.st-location-id').remove();
                        parent.append(html);
                        html = '';
                        $('select option', parent).prop('selected', !1);
                        $('select option', parent).each(function (index, el) {
                            var country = $(this).data('country');
                            var text = $(this).text();
                            var text_split = text.split("||");
                            text_split = text_split[0];
                            var highlight = get_highlight(text, val);
                            if (highlight.indexOf('</span>') >= 0) {
                                var current_country = $(this).parent('select').attr('data-current-country');
                                if (typeof current_country != 'undefined' && current_country != '') {
                                    if (country == current_country) {
                                        html += '<div data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' + '<span class="label"><a href="#">' + text_split + ' <i class="fa fa-plane"></i></a>' + '</div>'
                                    }
                                } else {
                                    html += '<div data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' + '<span class="label"><a href="#">' + text_split + ' <i class="fa fa-plane"></i></a>' + '</div>'
                                }
                            }
                        });
                        $('.option-wrapper').html(html).show();
                        t.caculatePosition($('.option-wrapper'), t)
                    }
                })
            }
        });
        t.caculatePosition = function () {
            if (!last_select_clicked || !last_select_clicked.length) return;
            var wraper = $('.option-wrapper');
            var input_tag = last_select_clicked;
            var offset = parent.offset();
            var top = offset.top + parent.height();
            var left = offset.left;
            var width = input_tag.outerWidth();
            var wpadminbar = 0;
            if ($('#wpadminbar').length && $(window).width() >= 783) {
                wpadminbar = $('#wpadminbar').height()
            } else {
                wpadminbar = 0
            }
            top = top - wpadminbar;
            var z_index = 99999;
            var position = 'absolute';
            if ($('#search-dialog').length) {
                position = 'fixed';
                top = top + wpadminbar - $(window).scrollTop();
                z_index = 99999
            }
            wraper.css({position: position, top: top, left: left, width: width, 'z-index': z_index})
        };
        $(window).resize(function () {
            t.caculatePosition()
        })
    });

    function get_highlight(text, val) {
        var highlight = text.replace(new RegExp(val + '(?!([^<]+)?>)', 'gi'), '<span class="highlight">$&</span>');
        return highlight
    }

    var flight_to = '';
    $('.input-daterange .tp_depart_date').each(function () {
        var form = $(this).closest('form');
        var p = $(this).parent();
        var me = $(this);
        $(this).datepicker({
            language: st_params.locale,
            autoclose: !0,
            todayHighlight: !0,
            startDate: 'today',
            format: p.data('tp-date-format'),
            weekStart: 1,
        }).on('changeDate', function (e) {
            var m = e.date.getMonth() + 1;
            if ((e.date.getMonth() + 1) < 10) {
                m = '0' + m
            }
            var d = e.date.getDate();
            if (e.date.getDate() < 10) {
                d = '0' + d
            }
            $(this).parent().find('.tp-date-from').val(e.date.getFullYear() + '-' + (m) + '-' + d);
            var new_date = e.date;
            new_date.setDate(new_date.getDate() + 1);
            $('.input-daterange .tp_return_date', form).datepicker("remove");
            $('.input-daterange .tp_return_date', form).datepicker({
                language: st_params.locale,
                startDate: '+1d',
                format: p.data('tp-date-format'),
                autoclose: !0,
                todayHighlight: !0,
                weekStart: 1
            });
            $('.input-daterange .tp_return_date', form).datepicker('setDates', new_date);
            $('.input-daterange .tp_return_date', form).datepicker('setStartDate', new_date);
            update_link()
        });
        $('.input-daterange .tp_return_date', form).datepicker({
            language: st_params.locale,
            startDate: '+1d',
            format: p.data('tp-date-format'),
            autoclose: !0,
            todayHighlight: !0,
            weekStart: 1
        }).on('changeDate', function (e) {
            var m = e.date.getMonth() + 1;
            if ((e.date.getMonth() + 1) < 10) {
                m = '0' + m
            }
            var d = e.date.getDate();
            if (e.date.getDate() < 10) {
                d = '0' + d
            }
            flight_to = e.date.getFullYear() + '-' + (m) + '-' + d;
            $(this).parent().find('.tp-date-to').val(flight_to);
            var del_html = '<i class="fa fa-times tp-icon-return-del"></i>';
            $('.input-daterange-return').append(del_html);
            update_link()
        })
    });
    $(document).on('click', '.tp-icon-return-del', function () {
        $('.input-daterange .tp_return_date').val('');
        $('input.tp-date-to').val('');
        $(this).remove();
        update_link()
    });
    $('.form-passengers-class .tp_group_display').click(function () {
        $(this).parent().find('.tp-form-passengers-class').toggleClass('none');
        $(this).find('.fa').toggleClass('fa-chevron-up');
        $(this).find('.fa').toggleClass('fa-chevron-down')
    });
    $('.tp-checkbox-class .checkbox-class').on('ifChecked', function (event) {
        $('.tp-checkbox-class input[name=trip_class]').val('1');
        var text = $('.form-passengers-class .display-class').data('business');
        $('.form-passengers-class .display-class').text(text)
    });
    $('.tp-checkbox-class .checkbox-class').on('ifUnchecked', function (event) {
        $('.tp-checkbox-class input[name=trip_class]').val('0');
        var text = $('.form-passengers-class .display-class').data('economy');
        $('.form-passengers-class .display-class').text(text)
    });
    $(document).on('keyup mouseup', '.passengers-class input[name=adults]', function () {
        if ($(this).val() == '') {
            //$(this).val(1)
        } else {
            var infants = $('.twidget-age-group input[name=infants]').val();
            if(infants == '')
                infants = 0;
            var children = $('.twidget-age-group input[name=children]').val();
            if(children == '')
                children = 0;
            var total = parseInt(infants) + parseInt(children) + parseInt($(this).val());
            if (total > 9) {
                var adults = 9 - (parseInt(infants) + parseInt(children));
                $(this).val(adults);
                $('.tp-form-passengers-class .notice').fadeIn()
            } else {
                $('.tp_group_display .quantity-passengers').text(total);
                $('.tp-form-passengers-class .notice').fadeOut()
            }
        }
    });
    $(document).on('keyup mouseup', '.passengers-class input[name=children]', function () {
        if ($(this).val() == '') {
            //$(this).val(0)
        } else {
            var infants = $('.twidget-age-group input[name=infants]').val();
            if(infants == '')
                infants = 0;
            var adults = $('.twidget-age-group input[name=adults]').val();
            if(adults == '')
                adults = 0;
            var total = parseInt(infants) + parseInt(adults) + parseInt($(this).val());
            if (total > 9) {
                var children = 9 - (parseInt(infants) + parseInt(adults));
                $(this).val(children);
                $('.tp-form-passengers-class .notice').fadeIn()
            } else {
                $('.tp_group_display .quantity-passengers').text(total);
                $('.tp-form-passengers-class .notice').fadeOut()
            }
        }
    });
    $(document).on('keyup mouseup', '.passengers-class input[name=infants]', function () {
        if ($(this).val() == '') {
            //$(this).val(0)
        } else {
            var adults = $('.twidget-age-group input[name=adults]').val();
            if(adults == '')
                adults = 0;
            var children = $('.twidget-age-group input[name=children]').val();
            if(children == '')
                children = 0;
            var total = parseInt(adults) + parseInt(children) + parseInt($(this).val());
            if (total > 9) {
                var infants = 9 - (parseInt(children) + parseInt(adults));
                $(this).val(infants);
                $('.tp-form-passengers-class .notice').fadeIn()
            } else {
                $('.tp_group_display .quantity-passengers').text(total);
                $('.tp-form-passengers-class .notice').fadeOut()
            }
        }
    });
    $(document).on('focusout', '.passengers-class input[name=adults]', function () {
        if ($(this).val() == '' || $(this).val() == 0) {
            $(this).val(1)
        }
    });
    $(document).on('focusout', '.passengers-class input[name=children], .passengers-class input[name=infants]', function () {
        if ($(this).val() == '') {
            $(this).val(0)
        }
    });
    var last_select_clicked = !1;
    $('.tp-hotel-destination').each(function () {
        var t = $(this);
        var parent = t.closest('.tp-hotel-wrapper');
        $(this).keyup(function (event) {
            last_select_clicked = t;
            parent.find('.st-location-id').remove();
            var name = t.attr('data-name');
            var locale = t.attr('data-locale');
            var val = t.val();
            if (val.length >= 2) {
                $.getJSON("https://engine.hotellook.com/api/v2/lookup.json?query=" + val + "&lang=" + locale + "&limit=5", function (data) {
                    if (typeof data == 'object') {
                        var html = '';
                        html += '<select name="' + name + '" class="st-location-id st-hidden" tabindex="-1">';
                        $.each(data.results.locations, function (key, value) {
                            html += '<option data-type="location" value="' + value.id + '">' + value.fullName + ' - ' + value.hotelsCount + ' ' + t.attr('data-text') + '</option>'
                        });
                        $.each(data.results.hotels, function (key, value) {
                            html += '<option data-type="hotel" value="' + value.id + '">' + value.fullName + '</option>'
                        });
                        html += '</select>';
                        parent.find('.st-location-id').remove();
                        parent.append(html);
                        html = '';
                        $('select option', parent).prop('selected', !1);
                        $('select option', parent).each(function (index, el) {
                            var country = $(this).data('country');
                            var text = $(this).text();
                            var text_split = text.split("||");
                            text_split = text_split[0];
                            var highlight = get_highlight(text, val);
                            if (highlight.indexOf('</span>') >= 0) {
                                if ($(this).data('type') == 'location') {
                                    html += '<div data-text="' + text + '" data-value="' + $(this).val() + '" class="option1">' + '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' + '</div>'
                                } else {
                                    html += '<div data-text="' + text + '" data-value="' + $(this).val() + '" class="option1">' + '<span class="label"><a href="#">' + text_split + '<i class="fa fa-building"></i></a>' + '</div>'
                                }
                            }
                        });
                        $('.option-wrapper').html(html).show();
                        t.caculatePosition($('.option-wrapper'), t)
                    }
                })
            }
        });
        $(document).on('click', '.option-wrapper .option1', function (event) {
            if (last_select_clicked.length > 0) {
                var parent = last_select_clicked.closest('.st-select-wrapper');
                event.preventDefault();
                var value = $(this).data('value');
                var text = $(this).text();
                if (text != "") {
                    last_select_clicked.val(text);
                    $('select option[value="' + value + '"]', parent).prop('selected', !0);
                    $('.option-wrapper').html('').hide()
                }
            }
        });
        t.caculatePosition = function () {
            if (!last_select_clicked || !last_select_clicked.length) return;
            var wraper = $('.option-wrapper');
            var input_tag = last_select_clicked;
            var offset = parent.offset();
            var top = offset.top + parent.height();
            var left = offset.left;
            var width = input_tag.outerWidth();
            var wpadminbar = 0;
            if ($('#wpadminbar').length && $(window).width() >= 783) {
                wpadminbar = $('#wpadminbar').height()
            } else {
                wpadminbar = 0
            }
            top = top - wpadminbar;
            var z_index = 99999;
            var position = 'absolute';
            if ($('#search-dialog').length) {
                position = 'fixed';
                top = top + wpadminbar - $(window).scrollTop();
                z_index = 99999
            }
            wraper.css({position: position, top: top, left: left, width: width, 'z-index': z_index})
        };
        $(window).resize(function () {
            t.caculatePosition()
        })
    });
    $(document).on('keyup mouseup', '.guests input[name=adults]', function () {
        if ($(this).val() == '') {
        } else {
            var children = $('.guests .children').val();
            if (parseInt($(this).val()) > 4) {
                $(this).val(4);
                $(this).closest('.tp-form-passengers-class').find('.notice').fadeIn()
            } else {
                var num_ad = parseInt($(this).val());
                if (typeof num_ad != 'number') {
                    num_ad = 1
                }
                var total = parseInt(children) + num_ad;
                $('.tp_guests_field .quantity-guests').text(total);
                $(this).closest('.tp-form-passengers-class').find('.notice').fadeOut()
            }
        }
    });
    var gl_index = 0;
    $(document).on('keyup mouseup', '.guests input.children', function () {
        if ($(this).val() == '') {
            gl_index = 0;
            $('.tp-children-group').empty()
        } else {
            var adults = $('.guests input[name=adults]').val();
            if (parseInt($(this).val()) > 3) {
                $(this).val(0);
                $(this).closest('.tp-form-passengers-class').find('.notice').fadeIn();
                gl_index = 0;
                $('.tp-children-group').empty();
                var total = parseInt(adults);
                $('.tp_guests_field .quantity-guests').text(total)
            } else {
                var total = parseInt(adults) + parseInt($(this).val());
                $('.tp_guests_field .quantity-guests').text(total);
                $(this).closest('.tp-form-passengers-class').find('.notice').fadeOut();
                if (gl_index > parseInt($(this).val())) {
                    for (var i = gl_index; i > parseInt($(this).val()); i--) {
                        $('.tp-children-group').find('.children-input-' + (i - 1)).remove()
                    }
                }
                if (gl_index < parseInt($(this).val())) {
                    for (var i = gl_index; i < parseInt($(this).val()); i++) {
                        var html = '<div class="children-input-' + i + '"><label>' + $(this).data('text') + ' ' + (i + 1) + ')</label><span><input type="number" class="" name="children[' + i + ']" value="7" max="17" min="0"></span></div>';
                        $('.tp-children-group').append(html)
                    }
                }
                gl_index = parseInt($(this).val())
            }
        }
    });
    var last_select_clicked = !1;
    $('.ss-flight-location').each(function () {
        var t = $(this);
        var parent = t.closest('.ss-flight-wrapper');
        $(this).keyup(function (event) {
            last_select_clicked = t;
            parent.find('.st-location-id').remove();
            var locale = $('.skyscanner-search-flights-data').data('locale');
            var name = t.attr('data-name');
            var val = t.val();
            if (val.length >= 2) {
                var l = locale.split('-');
                var url = "https://autocomplete.travelpayouts.com/jravia?locale=" + l[0] + "&with_countries=false&q=" + val;
                $.getJSON(url, function (data) {
                    if (typeof data == 'object') {
                        if (typeof data == 'object') {
                            var html = '';
                            html += '<select class="st-location-id st-hidden" tabindex="-1">';
                            $.each(data, function (key, value) {
                                var n = value.name;
                                if (value.name == null) {
                                    n = value.title
                                }
                                html += '<option value="' + value.code + '">' + value.city_fullname + ' (' + n + ') - ' + value.code + '</option>'
                            });
                            html += '</select>';
                            parent.find('.st-location-id').remove();
                            parent.append(html);
                            html = '';
                            $('select option', parent).prop('selected', !1);
                            $('select option', parent).each(function (index, el) {
                                var country = $(this).data('country');
                                var text = $(this).text();
                                var text_split = text.split("||");
                                text_split = text_split[0];
                                var highlight = get_highlight(text, val);
                                if (highlight.indexOf('</span>') >= 0) {
                                    html += '<div data-text="' + text + '" data-value="' + $(this).val() + '" class="option2">' + '<span class="label"><a href="#">' + text_split + '</a>' + '</div>'
                                }
                            });
                            $('.option-wrapper').html(html).show();
                            t.caculatePosition($('.option-wrapper'), t)
                        }
                    }
                })
            }
        });
        $(document).on('click', '.option-wrapper .option2', function (event) {
            if (last_select_clicked.length > 0) {
                var parent = last_select_clicked.closest('.st-select-wrapper');
                event.preventDefault();
                var value = $(this).data('value');
                var text = $(this).text();
                if (text != "") {
                    last_select_clicked.val(text);
                    last_select_clicked.attr('data-value', $(this).data('value'));
                    $('select option[value="' + value + '"]', parent).prop('selected', !0);
                    $('.option-wrapper').html('').hide();
                    update_link()
                }
            }
        });
        t.caculatePosition = function () {
            if (!last_select_clicked || !last_select_clicked.length) return;
            var wraper = $('.option-wrapper');
            var input_tag = last_select_clicked;
            var offset = parent.offset();
            var top = offset.top + parent.height();
            var left = offset.left;
            var width = input_tag.outerWidth();
            var wpadminbar = 0;
            if ($('#wpadminbar').length && $(window).width() >= 783) {
                wpadminbar = $('#wpadminbar').height()
            } else {
                wpadminbar = 0
            }
            top = top - wpadminbar;
            var z_index = 99999;
            var position = 'absolute';
            if ($('#search-dialog').length) {
                position = 'fixed';
                top = top + wpadminbar - $(window).scrollTop();
                z_index = 99999
            }
            wraper.css({position: position, top: top, left: left, width: width, 'z-index': z_index})
        };
        $(window).resize(function () {
            t.caculatePosition()
        })
    });

    function update_link() {
        var locale = $('.skyscanner-search-flights-data').data('locale');
        var market = $('.skyscanner-search-flights-data').data('country');
        var currency = $('.skyscanner-search-flights-data').data('currency');
        var old = 'http://partners.api.skyscanner.net/apiservices/referral/v1.0/' + market + '/' + currency + '/' + locale + '/';
        var or = $('#ss_location_origin').attr('data-value');
        var de = $('#ss_location_destination').attr('data-value');
        var dp = $('.tp-date-from.ss_depart').attr('value');
        var rt = '';
        if ($('.tp-date-to.ss_return').attr('value') != null) {
            rt = '/' + $('.tp-date-to.ss_return').attr('value')
        }
        var key = $('.skyscanner-search-flights-data').data('api');
        var new_url = old + or + '/' + de + '/' + dp + rt;
        $('.ss-search-flights-link').attr('action', new_url)
    }

    jQuery(function ($) {
        $(document).ready(function () {
            $(document).on('click', '.btn-tp-search-flights', function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var required = !1;
                $('input', form).each(function () {
                    if($(this).prop('required')){
                        if ($(this).val() == '') {
                            required = !0;
                            $(this).addClass('error')
                        } else {
                            $(this).removeClass('error')
                        }
                    }
                });
                var marker = form.find('input[name="marker"]').val();
                var origin_iata = form.find('select[name="origin_iata"] option:selected').val();
                var destination_iata = form.find('select[name="destination_iata"] option:selected').val();
                var depart_date = form.find('input[name="depart_date"]').val();
                var return_date = form.find('input[name="return_date"]').val();
                var adults = form.find('input[name="adults"]').val();
                var children = form.find('input[name="children"]').val();
                var infants = form.find('input[name="infants"]').val();
                var trip_class = form.find('input[name="trip_class"]').val();
                var with_request = form.find('input[name="with_request"]').val();
                var param = 'marker=' + marker + '&origin_iata=' + origin_iata + '&destination_iata=' + destination_iata + '&depart_date=' + depart_date + '&return_date=' + return_date + '&adults=' + adults + '&children=' + children + '&infants=' + infants + '&trip_class=' + trip_class + '&with_request=' + with_request;
                var current_url = $('#current_url').val();
                console.log(current_url + '?' + param);
                if (!required) {
                    window.location.href = current_url + '?' + param
                }
            });
            $(document).on('click', '.btn-tp-search-hotels', function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var required = !1;
                if ($('#location_destination_h').val() == '') {
                    required = !0;
                    $('#location_destination_h').addClass('error')
                } else {
                    required = !1;
                    $('#location_destination_h').removeClass('error')
                }
                var marker = form.find('input[name="marker"]').val();
                var destination = form.find('select[name="destination"] option:selected').val();
                var checkIn = form.find('input[name="checkIn"]').val();
                var checkOut = form.find('input[name="checkOut"]').val();
                var adults = form.find('input[name="adults"]').val();
                if ($('input[name="children[0]"]').length > 0) {
                    var children = form.find('input[name="children[0]"]').val()
                }
                if ($('input[name="children[1]"]').length > 0) {
                    var children1 = form.find('input[name="children[1]"]').val()
                }
                if ($('input[name="children[2]"]').length > 0) {
                    var children2 = form.find('input[name="children[2]"]').val()
                }
                var param = 'marker=' + marker + '&destination=' + destination + '&checkIn=' + checkIn + '&checkOut=' + checkOut + '&adults=' + adults;
                if (children != undefined) {
                    param += '&children%5B0%5D=' + children
                }
                if (children1 != undefined) {
                    param += '&children%5B1%5D=' + children
                }
                if (children2 != undefined) {
                    param += '&children%5B2%5D=' + children
                }
                var current_url = $('#current_url_hotel').val();
                if (!required) {
                    window.location.href = current_url + '/hotels/?' + param
                }
            })
        })
    })
});!function($){'use strict';$.expr[':'].icontains=function(obj,index,meta){return $(obj).text().toUpperCase().indexOf(meta[3].toUpperCase())>=0};var Selectpicker=function(element,options,e){if(e){e.stopPropagation();e.preventDefault()}
this.$element=$(element);this.$newElement=null;this.$button=null;this.$menu=null;this.$lis=null;this.options=$.extend({},$.fn.selectpicker.defaults,this.$element.data(),typeof options=='object'&&options);if(this.options.title===null){this.options.title=this.$element.attr('title')}
this.val=Selectpicker.prototype.val;this.render=Selectpicker.prototype.render;this.refresh=Selectpicker.prototype.refresh;this.setStyle=Selectpicker.prototype.setStyle;this.selectAll=Selectpicker.prototype.selectAll;this.deselectAll=Selectpicker.prototype.deselectAll;this.init()};Selectpicker.prototype={constructor:Selectpicker,init:function(){var that=this,id=this.$element.attr('id');this.$element.hide();this.multiple=this.$element.prop('multiple');this.autofocus=this.$element.prop('autofocus');this.$newElement=this.createView();this.$element.after(this.$newElement);this.$menu=this.$newElement.find('> .dropdown-menu');this.$button=this.$newElement.find('> button');this.$searchbox=this.$newElement.find('input');if(id!==undefined){this.$button.attr('data-id',id);$('label[for="'+id+'"]').click(function(e){e.preventDefault();that.$button.focus()})}
this.checkDisabled();this.clickListener();if(this.options.liveSearch)this.liveSearchListener();this.render();this.liHeight();this.setStyle();this.setWidth();if(this.options.container)this.selectPosition();this.$menu.data('this',this);this.$newElement.data('this',this)},createDropdown:function(){var multiple=this.multiple?' show-tick':'';var inputGroup=this.$element.parent().hasClass('input-group')?' input-group-btn':'';var autofocus=this.autofocus?' autofocus':'';var header=this.options.header?'<div class="popover-title"><button type="button" class="close" aria-hidden="true">&times;</button>'+this.options.header+'</div>':'';var searchbox=this.options.liveSearch?'<div class="bootstrap-select-searchbox"><input type="text" class="input-block-level form-control" /></div>':'';var actionsbox=this.options.actionsBox?'<div class="bs-actionsbox">'+'<div class="btn-group btn-block">'+'<button class="actions-btn bs-select-all btn btn-sm btn-default">'+'Select All'+'</button>'+'<button class="actions-btn bs-deselect-all btn btn-sm btn-default">'+'Deselect All'+'</button>'+'</div>'+'</div>':'';var drop='<div class="btn-group bootstrap-select'+multiple+inputGroup+'">'+'<button type="button" class="btn dropdown-toggle selectpicker" data-toggle="dropdown"'+autofocus+'>'+'<span class="filter-option pull-left"></span>&nbsp;'+'<span class="caret"></span>'+'</button>'+'<div class="dropdown-menu open">'+header+searchbox+actionsbox+'<ul class="dropdown-menu inner selectpicker" role="menu">'+'</ul>'+'</div>'+'</div>';return $(drop)},createView:function(){var $drop=this.createDropdown();var $li=this.createLi();$drop.find('ul').append($li);return $drop},reloadLi:function(){this.destroyLi();var $li=this.createLi();this.$menu.find('ul').append($li)},destroyLi:function(){this.$menu.find('li').remove()},createLi:function(){var that=this,_liA=[],_liHtml='';this.$element.find('option').each(function(){var $this=$(this);var optionClass=$this.attr('class')||'';var inline=$this.attr('style')||'';var text=$this.data('content')?$this.data('content'):$this.html();var subtext=$this.data('subtext')!==undefined?'<small class="muted text-muted">'+$this.data('subtext')+'</small>':'';var icon=$this.data('icon')!==undefined?'<i class="'+that.options.iconBase+' '+$this.data('icon')+'"></i> ':'';if(icon!==''&&($this.is(':disabled')||$this.parent().is(':disabled'))){icon='<span>'+icon+'</span>'}
if(!$this.data('content')){text=icon+'<span class="text">'+text+subtext+'</span>'}
if(that.options.hideDisabled&&($this.is(':disabled')||$this.parent().is(':disabled'))){_liA.push('<a style="min-height: 0; padding: 0"></a>')}else if($this.parent().is('optgroup')&&$this.data('divider')!==!0){if($this.index()===0){var label=$this.parent().attr('label');var labelSubtext=$this.parent().data('subtext')!==undefined?'<small class="muted text-muted">'+$this.parent().data('subtext')+'</small>':'';var labelIcon=$this.parent().data('icon')?'<i class="'+$this.parent().data('icon')+'"></i> ':'';label=labelIcon+'<span class="text">'+label+labelSubtext+'</span>';if($this[0].index!==0){_liA.push('<div class="div-contain"><div class="divider"></div></div>'+'<dt>'+label+'</dt>'+that.createA(text,'opt '+optionClass,inline))}else{_liA.push('<dt>'+label+'</dt>'+that.createA(text,'opt '+optionClass,inline))}}else{_liA.push(that.createA(text,'opt '+optionClass,inline))}}else if($this.data('divider')===!0){_liA.push('<div class="div-contain"><div class="divider"></div></div>')}else if($(this).data('hidden')===!0){_liA.push('<a></a>')}else{_liA.push(that.createA(text,optionClass,inline))}});$.each(_liA,function(i,item){var hide=item==='<a></a>'?'class="hide is-hidden"':'';_liHtml+='<li rel="'+i+'"'+hide+'>'+item+'</li>'});if(!this.multiple&&this.$element.find('option:selected').length===0&&!this.options.title){this.$element.find('option').eq(0).prop('selected',!0).attr('selected','selected')}
return $(_liHtml)},createA:function(text,classes,inline){return '<a tabindex="0" class="'+classes+'" style="'+inline+'">'+text+'<i class="'+this.options.iconBase+' '+this.options.tickIcon+' icon-ok check-mark"></i>'+'</a>'},render:function(updateLi){var that=this;if(updateLi!==!1){this.$element.find('option').each(function(index){that.setDisabled(index,$(this).is(':disabled')||$(this).parent().is(':disabled'));that.setSelected(index,$(this).is(':selected'))})}
this.tabIndex();var selectedItems=this.$element.find('option:selected').map(function(){var $this=$(this);var icon=$this.data('icon')&&that.options.showIcon?'<i class="'+that.options.iconBase+' '+$this.data('icon')+'"></i> ':'';var subtext;if(that.options.showSubtext&&$this.attr('data-subtext')&&!that.multiple){subtext=' <small class="muted text-muted">'+$this.data('subtext')+'</small>'}else{subtext=''}
if($this.data('content')&&that.options.showContent){return $this.data('content')}else if($this.attr('title')!==undefined){return $this.attr('title')}else{return icon+$this.html()+subtext}}).toArray();var title=!this.multiple?selectedItems[0]:selectedItems.join(this.options.multipleSeparator);if(this.multiple&&this.options.selectedTextFormat.indexOf('count')>-1){var max=this.options.selectedTextFormat.split('>');var notDisabled=this.options.hideDisabled?':not([disabled])':'';if((max.length>1&&selectedItems.length>max[1])||(max.length==1&&selectedItems.length>=2)){title=this.options.countSelectedText.replace('{0}',selectedItems.length).replace('{1}',this.$element.find('option:not([data-divider="true"]):not([data-hidden="true"])'+notDisabled).length)}}
this.options.title=this.$element.attr('title');if(!title){title=this.options.title!==undefined?this.options.title:this.options.noneSelectedText}
this.$button.attr('title',$.trim(title));this.$newElement.find('.filter-option').html(title)},setStyle:function(style,status){if(this.$element.attr('class')){this.$newElement.addClass(this.$element.attr('class').replace(/selectpicker|mobile-device/gi,''))}
var buttonClass=style?style:this.options.style;if(status=='add'){this.$button.addClass(buttonClass)}else if(status=='remove'){this.$button.removeClass(buttonClass)}else{this.$button.removeClass(this.options.style);this.$button.addClass(buttonClass)}},liHeight:function(){if(this.options.size===!1)return;var $selectClone=this.$menu.parent().clone().find('> .dropdown-toggle').prop('autofocus',!1).end().appendTo('body'),$menuClone=$selectClone.addClass('open').find('> .dropdown-menu'),liHeight=$menuClone.find('li > a').outerHeight(),headerHeight=this.options.header?$menuClone.find('.popover-title').outerHeight():0,searchHeight=this.options.liveSearch?$menuClone.find('.bootstrap-select-searchbox').outerHeight():0,actionsHeight=this.options.actionsBox?$menuClone.find('.bs-actionsbox').outerHeight():0;$selectClone.remove();this.$newElement.data('liHeight',liHeight).data('headerHeight',headerHeight).data('searchHeight',searchHeight).data('actionsHeight',actionsHeight)},setSize:function(){var that=this,menu=this.$menu,menuInner=menu.find('.inner'),selectHeight=this.$newElement.outerHeight(),liHeight=this.$newElement.data('liHeight'),headerHeight=this.$newElement.data('headerHeight'),searchHeight=this.$newElement.data('searchHeight'),actionsHeight=this.$newElement.data('actionsHeight'),divHeight=menu.find('li .divider').outerHeight(!0),menuPadding=parseInt(menu.css('padding-top'))+parseInt(menu.css('padding-bottom'))+parseInt(menu.css('border-top-width'))+parseInt(menu.css('border-bottom-width')),notDisabled=this.options.hideDisabled?':not(.disabled)':'',$window=$(window),menuExtras=menuPadding+parseInt(menu.css('margin-top'))+parseInt(menu.css('margin-bottom'))+2,menuHeight,selectOffsetTop,selectOffsetBot,posVert=function(){selectOffsetTop=that.$newElement.offset().top-$window.scrollTop();selectOffsetBot=$window.height()-selectOffsetTop-selectHeight};posVert();if(this.options.header)menu.css('padding-top',0);if(this.options.size=='auto'){var getSize=function(){var minHeight,lisVis=that.$lis.not('.hide');posVert();menuHeight=selectOffsetBot-menuExtras;if(that.options.dropupAuto){that.$newElement.toggleClass('dropup',(selectOffsetTop>selectOffsetBot)&&((menuHeight-menuExtras)<menu.height()))}
if(that.$newElement.hasClass('dropup')){menuHeight=selectOffsetTop-menuExtras}
if((lisVis.length+lisVis.find('dt').length)>3){minHeight=liHeight*3+menuExtras-2}else{minHeight=0}
menu.css({'max-height':menuHeight+'px','overflow':'hidden','min-height':minHeight+headerHeight+searchHeight+actionsHeight+'px'});menuInner.css({'max-height':menuHeight-headerHeight-searchHeight-actionsHeight-menuPadding+'px','overflow-y':'auto','min-height':Math.max(minHeight-menuPadding,0)+'px'})};getSize();this.$searchbox.off('input.getSize propertychange.getSize').on('input.getSize propertychange.getSize',getSize);$(window).off('resize.getSize').on('resize.getSize',getSize);$(window).off('scroll.getSize').on('scroll.getSize',getSize)}else if(this.options.size&&this.options.size!='auto'&&menu.find('li'+notDisabled).length>this.options.size){var optIndex=menu.find('li'+notDisabled+' > *').filter(':not(.div-contain)').slice(0,this.options.size).last().parent().index();var divLength=menu.find('li').slice(0,optIndex+1).find('.div-contain').length;menuHeight=liHeight*this.options.size+divLength*divHeight+menuPadding;if(that.options.dropupAuto){this.$newElement.toggleClass('dropup',(selectOffsetTop>selectOffsetBot)&&(menuHeight<menu.height()))}
menu.css({'max-height':menuHeight+headerHeight+searchHeight+actionsHeight+'px','overflow':'hidden'});menuInner.css({'max-height':menuHeight-menuPadding+'px','overflow-y':'auto'})}},setWidth:function(){if(this.options.width=='auto'){this.$menu.css('min-width','0');var selectClone=this.$newElement.clone().appendTo('body');var ulWidth=selectClone.find('> .dropdown-menu').css('width');var btnWidth=selectClone.css('width','auto').find('> button').css('width');selectClone.remove();this.$newElement.css('width',Math.max(parseInt(ulWidth),parseInt(btnWidth))+'px')}else if(this.options.width=='fit'){this.$menu.css('min-width','');this.$newElement.css('width','').addClass('fit-width')}else if(this.options.width){this.$menu.css('min-width','');this.$newElement.css('width',this.options.width)}else{this.$menu.css('min-width','');this.$newElement.css('width','')}
if(this.$newElement.hasClass('fit-width')&&this.options.width!=='fit'){this.$newElement.removeClass('fit-width')}},selectPosition:function(){var that=this,drop='<div />',$drop=$(drop),pos,actualHeight,getPlacement=function($element){$drop.addClass($element.attr('class').replace(/form-control/gi,'')).toggleClass('dropup',$element.hasClass('dropup'));pos=$element.offset();actualHeight=$element.hasClass('dropup')?0:$element[0].offsetHeight;$drop.css({'top':pos.top+actualHeight,'left':pos.left,'width':$element[0].offsetWidth,'position':'absolute'})};this.$newElement.on('click',function(){if(that.isDisabled()){return}
getPlacement($(this));$drop.appendTo(that.options.container);$drop.toggleClass('open',!$(this).hasClass('open'));$drop.append(that.$menu)});$(window).resize(function(){getPlacement(that.$newElement)});$(window).on('scroll',function(){getPlacement(that.$newElement)});$('html').on('click',function(e){if($(e.target).closest(that.$newElement).length<1){$drop.removeClass('open')}})},mobile:function(){this.$element.addClass('mobile-device').appendTo(this.$newElement);if(this.options.container)this.$menu.hide()},refresh:function(){this.$lis=null;this.reloadLi();this.render();this.setWidth();this.setStyle();this.checkDisabled();this.liHeight()},update:function(){this.reloadLi();this.setWidth();this.setStyle();this.checkDisabled();this.liHeight()},setSelected:function(index,selected){if(this.$lis==null)this.$lis=this.$menu.find('li');$(this.$lis[index]).toggleClass('selected',selected)},setDisabled:function(index,disabled){if(this.$lis==null)this.$lis=this.$menu.find('li');if(disabled){$(this.$lis[index]).addClass('disabled').find('a').attr('href','#').attr('tabindex',-1)}else{$(this.$lis[index]).removeClass('disabled').find('a').removeAttr('href').attr('tabindex',0)}},isDisabled:function(){return this.$element.is(':disabled')},checkDisabled:function(){var that=this;if(this.isDisabled()){this.$button.addClass('disabled').attr('tabindex',-1)}else{if(this.$button.hasClass('disabled')){this.$button.removeClass('disabled')}
if(this.$button.attr('tabindex')==-1){if(!this.$element.data('tabindex'))this.$button.removeAttr('tabindex')}}
this.$button.click(function(){return!that.isDisabled()})},tabIndex:function(){if(this.$element.is('[tabindex]')){this.$element.data('tabindex',this.$element.attr('tabindex'));this.$button.attr('tabindex',this.$element.data('tabindex'))}},clickListener:function(){var that=this;$('body').on('touchstart.dropdown','.dropdown-menu',function(e){e.stopPropagation()});this.$newElement.on('click',function(){that.setSize();if(!that.options.liveSearch&&!that.multiple){setTimeout(function(){that.$menu.find('.selected a').focus()},10)}});this.$menu.on('click','li a',function(e){var clickedIndex=$(this).parent().index(),prevValue=that.$element.val(),prevIndex=that.$element.prop('selectedIndex');if(that.multiple){e.stopPropagation()}
e.preventDefault();if(!that.isDisabled()&&!$(this).parent().hasClass('disabled')){var $options=that.$element.find('option'),$option=$options.eq(clickedIndex),state=$option.prop('selected'),$optgroup=$option.parent('optgroup'),maxOptions=that.options.maxOptions,maxOptionsGrp=$optgroup.data('maxOptions')||!1;if(!that.multiple){$options.prop('selected',!1);$option.prop('selected',!0);that.$menu.find('.selected').removeClass('selected');that.setSelected(clickedIndex,!0)}
else{$option.prop('selected',!state);that.setSelected(clickedIndex,!state);if((maxOptions!==!1)||(maxOptionsGrp!==!1)){var maxReached=maxOptions<$options.filter(':selected').length,maxReachedGrp=maxOptionsGrp<$optgroup.find('option:selected').length,maxOptionsArr=that.options.maxOptionsText,maxTxt=maxOptionsArr[0].replace('{n}',maxOptions),maxTxtGrp=maxOptionsArr[1].replace('{n}',maxOptionsGrp),$notify=$('<div class="notify"></div>');if((maxOptions&&maxReached)||(maxOptionsGrp&&maxReachedGrp)){if(maxOptionsArr[2]){maxTxt=maxTxt.replace('{var}',maxOptionsArr[2][maxOptions>1?0:1]);maxTxtGrp=maxTxtGrp.replace('{var}',maxOptionsArr[2][maxOptionsGrp>1?0:1])}
$option.prop('selected',!1);that.$menu.append($notify);if(maxOptions&&maxReached){$notify.append($('<div>'+maxTxt+'</div>'));that.$element.trigger('maxReached.bs.select')}
if(maxOptionsGrp&&maxReachedGrp){$notify.append($('<div>'+maxTxtGrp+'</div>'));that.$element.trigger('maxReachedGrp.bs.select')}
setTimeout(function(){that.setSelected(clickedIndex,!1)},10);$notify.delay(750).fadeOut(300,function(){$(this).remove()})}}}
if(!that.multiple){that.$button.focus()}else if(that.options.liveSearch){that.$searchbox.focus()}
if((prevValue!=that.$element.val()&&that.multiple)||(prevIndex!=that.$element.prop('selectedIndex')&&!that.multiple)){that.$element.change()}}});this.$menu.on('click','li.disabled a, li dt, li .div-contain, .popover-title, .popover-title :not(.close)',function(e){if(e.target==this){e.preventDefault();e.stopPropagation();if(!that.options.liveSearch){that.$button.focus()}else{that.$searchbox.focus()}}});this.$menu.on('click','.popover-title .close',function(){that.$button.focus()});this.$searchbox.on('click',function(e){e.stopPropagation()});this.$menu.on('click','.actions-btn',function(e){if(that.options.liveSearch){that.$searchbox.focus()}else{that.$button.focus()}
e.preventDefault();e.stopPropagation();if($(this).is('.bs-select-all')){that.selectAll()}else{that.deselectAll()}
that.$element.change()});this.$element.change(function(){that.render(!1)})},liveSearchListener:function(){var that=this,no_results=$('<li class="no-results"></li>');this.$newElement.on('click.dropdown.data-api',function(){that.$menu.find('.active').removeClass('active');if(!!that.$searchbox.val()){that.$searchbox.val('');that.$lis.not('.is-hidden').removeClass('hide');if(!!no_results.parent().length)no_results.remove()}
if(!that.multiple)that.$menu.find('.selected').addClass('active');setTimeout(function(){that.$searchbox.focus()},10)});this.$searchbox.on('input propertychange',function(){if(that.$searchbox.val()){that.$lis.not('.is-hidden').removeClass('hide').find('a').not(':icontains('+that.$searchbox.val()+')').parent().addClass('hide');if(!that.$menu.find('li').filter(':visible:not(.no-results)').length){if(!!no_results.parent().length)no_results.remove();no_results.html(that.options.noneResultsText+' "'+that.$searchbox.val()+'"').show();that.$menu.find('li').last().after(no_results)}else if(!!no_results.parent().length){no_results.remove()}}else{that.$lis.not('.is-hidden').removeClass('hide');if(!!no_results.parent().length)no_results.remove()}
that.$menu.find('li.active').removeClass('active');that.$menu.find('li').filter(':visible:not(.divider)').eq(0).addClass('active').find('a').focus();$(this).focus()});this.$menu.on('mouseenter','a',function(e){that.$menu.find('.active').removeClass('active');$(e.currentTarget).parent().not('.disabled').addClass('active')});this.$menu.on('mouseleave','a',function(){that.$menu.find('.active').removeClass('active')})},val:function(value){if(value!==undefined){this.$element.val(value);this.$element.change();return this.$element}else{return this.$element.val()}},selectAll:function(){if(this.$lis==null)this.$lis=this.$menu.find('li');this.$element.find('option:enabled').prop('selected',!0);$(this.$lis).filter(':not(.disabled)').addClass('selected');this.render(!1)},deselectAll:function(){if(this.$lis==null)this.$lis=this.$menu.find('li');this.$element.find('option:enabled').prop('selected',!1);$(this.$lis).filter(':not(.disabled)').removeClass('selected');this.render(!1)},keydown:function(e){var $this,$items,$parent,index,next,first,last,prev,nextPrev,that,prevIndex,isActive,keyCodeMap={32:' ',48:'0',49:'1',50:'2',51:'3',52:'4',53:'5',54:'6',55:'7',56:'8',57:'9',59:';',65:'a',66:'b',67:'c',68:'d',69:'e',70:'f',71:'g',72:'h',73:'i',74:'j',75:'k',76:'l',77:'m',78:'n',79:'o',80:'p',81:'q',82:'r',83:'s',84:'t',85:'u',86:'v',87:'w',88:'x',89:'y',90:'z',96:'0',97:'1',98:'2',99:'3',100:'4',101:'5',102:'6',103:'7',104:'8',105:'9'};$this=$(this);$parent=$this.parent();if($this.is('input'))$parent=$this.parent().parent();that=$parent.data('this');if(that.options.liveSearch)$parent=$this.parent().parent();if(that.options.container)$parent=that.$menu;$items=$('[role=menu] li:not(.divider) a',$parent);isActive=that.$menu.parent().hasClass('open');if(!isActive&&/([0-9]|[A-z])/.test(String.fromCharCode(e.keyCode))){if(!that.options.container){that.setSize();that.$menu.parent().addClass('open');isActive=that.$menu.parent().hasClass('open')}else{that.$newElement.trigger('click')}
that.$searchbox.focus()}
if(that.options.liveSearch){if(/(^9$|27)/.test(e.keyCode)&&isActive&&that.$menu.find('.active').length===0){e.preventDefault();that.$menu.parent().removeClass('open');that.$button.focus()}
$items=$('[role=menu] li:not(.divider):visible',$parent);if(!$this.val()&&!/(38|40)/.test(e.keyCode)){if($items.filter('.active').length===0){$items=that.$newElement.find('li').filter(':icontains('+keyCodeMap[e.keyCode]+')')}}}
if(!$items.length)return;if(/(38|40)/.test(e.keyCode)){index=$items.index($items.filter(':focus'));first=$items.parent(':not(.disabled):visible').first().index();last=$items.parent(':not(.disabled):visible').last().index();next=$items.eq(index).parent().nextAll(':not(.disabled):visible').eq(0).index();prev=$items.eq(index).parent().prevAll(':not(.disabled):visible').eq(0).index();nextPrev=$items.eq(next).parent().prevAll(':not(.disabled):visible').eq(0).index();if(that.options.liveSearch){$items.each(function(i){if($(this).is(':not(.disabled)')){$(this).data('index',i)}});index=$items.index($items.filter('.active'));first=$items.filter(':not(.disabled):visible').first().data('index');last=$items.filter(':not(.disabled):visible').last().data('index');next=$items.eq(index).nextAll(':not(.disabled):visible').eq(0).data('index');prev=$items.eq(index).prevAll(':not(.disabled):visible').eq(0).data('index');nextPrev=$items.eq(next).prevAll(':not(.disabled):visible').eq(0).data('index')}
prevIndex=$this.data('prevIndex');if(e.keyCode==38){if(that.options.liveSearch)index-=1;if(index!=nextPrev&&index>prev)index=prev;if(index<first)index=first;if(index==prevIndex)index=last}
if(e.keyCode==40){if(that.options.liveSearch)index+=1;if(index==-1)index=0;if(index!=nextPrev&&index<next)index=next;if(index>last)index=last;if(index==prevIndex)index=first}
$this.data('prevIndex',index);if(!that.options.liveSearch){$items.eq(index).focus()}else{e.preventDefault();if(!$this.is('.dropdown-toggle')){$items.removeClass('active');$items.eq(index).addClass('active').find('a').focus();$this.focus()}}}else if(!$this.is('input')){var keyIndex=[],count,prevKey;$items.each(function(){if($(this).parent().is(':not(.disabled)')){if($.trim($(this).text().toLowerCase()).substring(0,1)==keyCodeMap[e.keyCode]){keyIndex.push($(this).parent().index())}}});count=$(document).data('keycount');count++;$(document).data('keycount',count);prevKey=$.trim($(':focus').text().toLowerCase()).substring(0,1);if(prevKey!=keyCodeMap[e.keyCode]){count=1;$(document).data('keycount',count)}else if(count>=keyIndex.length){$(document).data('keycount',0);if(count>keyIndex.length)count=1}
$items.eq(keyIndex[count-1]).focus()}
if(/(13|32|^9$)/.test(e.keyCode)&&isActive){if(!/(32)/.test(e.keyCode))e.preventDefault();if(!that.options.liveSearch){$(':focus').click()}else if(!/(32)/.test(e.keyCode)){that.$menu.find('.active a').click();$this.focus()}
$(document).data('keycount',0)}
if((/(^9$|27)/.test(e.keyCode)&&isActive&&(that.multiple||that.options.liveSearch))||(/(27)/.test(e.keyCode)&&!isActive)){that.$menu.parent().removeClass('open');that.$button.focus()}},hide:function(){this.$newElement.hide()},show:function(){this.$newElement.show()},destroy:function(){this.$newElement.remove();this.$element.remove()}};$.fn.selectpicker=function(option,event){var args=arguments;var value;var chain=this.each(function(){if($(this).is('select')){var $this=$(this),data=$this.data('selectpicker'),options=typeof option=='object'&&option;if(!data){$this.data('selectpicker',(data=new Selectpicker(this,options,event)))}else if(options){for(var i in options){data.options[i]=options[i]}}
if(typeof option=='string'){var property=option;if(data[property]instanceof Function){[].shift.apply(args);value=data[property].apply(data,args)}else{value=data.options[property]}}}});if(value!==undefined){return value}else{return chain}};$.fn.selectpicker.defaults={style:'btn-default',size:'auto',title:null,selectedTextFormat:'values',noneSelectedText:'Nothing selected',noneResultsText:'No results match',countSelectedText:'{0} of {1} selected',maxOptionsText:['Limit reached ({n} {var} max)','Group limit reached ({n} {var} max)',['items','item']],width:!1,container:!1,hideDisabled:!1,showSubtext:!1,showIcon:!0,showContent:!0,dropupAuto:!0,header:!1,liveSearch:!1,actionsBox:!1,multipleSeparator:', ',iconBase:'glyphicon',tickIcon:'glyphicon-ok',maxOptions:!1};$(document).data('keycount',0).on('keydown','.bootstrap-select [data-toggle=dropdown], .bootstrap-select [role=menu], .bootstrap-select-searchbox input',Selectpicker.prototype.keydown).on('focusin.modal','.bootstrap-select [data-toggle=dropdown], .bootstrap-select [role=menu], .bootstrap-select-searchbox input',function(e){e.stopPropagation()})}(window.jQuery);jQuery(document).ready(function ($) {
    "use strict";
    /* Select date */
    var flight_to = '';
    $('.input-daterange .amd_depart_date').each(function () {
        var form = $(this).closest('form');
        var p = $(this).parent();
        var me = $(this);
        $(this).datepicker({
            language: st_params.locale,
            autoclose: !0,
            todayHighlight: !0,
            startDate: 'today',
            format: p.data('tp-date-format'),
            weekStart: 1,
        }).on('changeDate', function (e) {
            var m = e.date.getMonth() + 1;
            if ((e.date.getMonth() + 1) < 10) {
                m = '0' + m
            }
            var d = e.date.getDate();
            if (e.date.getDate() < 10) {
                d = '0' + d
            }
            $(this).parent().find('.amd-date-from').val(e.date.getFullYear() + '-' + (m) + '-' + d);
            var new_date = e.date;
            new_date.setDate(new_date.getDate() + 0);
            $('.input-daterange .amd_return_date', form).datepicker("remove");
            $('.input-daterange .amd_return_date', form).datepicker({
                language: st_params.locale,
                startDate: '+0d',
                format: p.data('tp-date-format'),
                autoclose: !0,
                todayHighlight: !0,
                weekStart: 1
            });
            $('.input-daterange .amd_return_date', form).datepicker('setDates', new_date);
            $('.input-daterange .amd_return_date', form).datepicker('setStartDate', new_date);
        });
        $('.input-daterange .amd_return_date', form).datepicker({
            language: st_params.locale,
            startDate: '+0d',
            format: p.data('tp-date-format'),
            autoclose: !0,
            todayHighlight: !0,
            weekStart: 1
        }).on('changeDate', function (e) {
            var m = e.date.getMonth() + 1;
            if ((e.date.getMonth() + 1) < 10) {
                m = '0' + m
            }
            var d = e.date.getDate();
            if (e.date.getDate() < 10) {
                d = '0' + d
            }
            flight_to = e.date.getFullYear() + '-' + (m) + '-' + d;
            $(this).parent().find('.amd-date-to').val(flight_to);
            var del_html = '<i class="fa fa-times tp-icon-return-del"></i>';
            if($('.input-daterange-return .tp-icon-return-del').length)
                $('.input-daterange-return .tp-icon-return-del').remove();
            $('.input-daterange-return').append(del_html);
        })
    });
    $(document).on('click', '.tp-icon-return-del', function () {
        $('.input-daterange .amd_return_date').val('');
        $('input.amd-date-to').val('');
        $(this).remove();
    });
    /* End select date */
    $('.amd-form-passengers .amd_group_display').click(function () {
        $(this).parent().find('.amd-form-passengers-class').toggleClass('none');
        $(this).find('.fa').toggleClass('fa-chevron-up');
        $(this).find('.fa').toggleClass('fa-chevron-down')
    });

    $(document).on('keyup mouseup', '.amd-passengers-class input[name=adults]', function () {
        var sparent = $(this).closest('.amd-passengers-class');
        if ($(this).val() == '') {
            //$(this).val(1)
        } else {
            var infants = $('input[name=infants]', sparent).val();
            if(infants == '')
                infants = 0;
            var children = $('input[name=children]', sparent).val();
            if(children == '')
                children = 0;
            var total = parseInt(infants) + parseInt(children) + parseInt($(this).val());
            if (total > 9) {
                var adults = 9 - (parseInt(infants) + parseInt(children));
                $(this).val(adults);
                $('.amd-form-passengers-class .notice').html($('.amd-form-passengers-class .notice').data('maxup')).fadeIn();
            } else {
                $('.amd_group_display .quantity-passengers').text(total);
                $('.amd-form-passengers-class .notice').html('').fadeOut();
            }
        }
    });
    $(document).on('keyup mouseup', '.amd-passengers-class input[name=children]', function () {
        var sparent = $(this).closest('.amd-passengers-class');
        if ($(this).val() == '') {
            //$(this).val(0)
        } else {
            var infants = $('input[name=infants]', sparent).val();
            if(infants == '')
                infants = 0;
            var adults = $('input[name=adults]', sparent).val();
            if(adults == '')
                adults = 0;
            var total = parseInt(infants) + parseInt(adults) + parseInt($(this).val());
            if (total > 9) {
                var children = 9 - (parseInt(infants) + parseInt(adults));
                $(this).val(children);
                $('.amd-form-passengers-class .notice').html($('.amd-form-passengers-class .notice').data('maxup')).fadeIn();
            } else {
                $('.amd_group_display .quantity-passengers').text(total);
                $('.amd-form-passengers-class .notice').html('').fadeOut()
            }
        }
    });
    $(document).on('keyup mouseup', '.amd-passengers-class input[name=infants]', function () {
        var sparent = $(this).closest('.amd-passengers-class');
        if ($(this).val() == '') {
            //$(this).val(0)
        } else {
            var adults = $('input[name=adults]', sparent).val();
            if(adults == '')
                adults = 0;
            var children = $('input[name=children]', sparent).val();
            if(children == '')
                children = 0;
            var total = parseInt(adults) + parseInt(children) + parseInt($(this).val());
            if (total > 9) {
                var infants = 9 - (parseInt(children) + parseInt(adults));
                $(this).val(infants);
                $('.amd-form-passengers-class .notice').html($('.amd-form-passengers-class .notice').data('maxup')).fadeIn();
            } else {
                if(parseInt($(this).val()) > adults){
                    $(this).val(adults);
                    $('.amd-form-passengers-class .notice').html($('.amd-form-passengers-class .notice').data('maxinf')).fadeIn();
                }else{
                    $('.amd_group_display .quantity-passengers').text(total);
                    $('.amd-form-passengers-class .notice').html('').fadeOut()
                }
            }
        }
    });
    $(document).on('focusout', '.amd-passengers-class input[name=adults]', function () {
        if ($(this).val() == '' || $(this).val() == 0) {
            $(this).val(1)
        }
    });
    $(document).on('focusout', '.amd-passengers-class input[name=children], .amd-passengers-class input[name=infants]', function () {
        if ($(this).val() == '') {
            $(this).val(0)
        }
    });

    /*var sparent = $('.amd-passengers-class');
    var adults = $('input[name=adults]', sparent).val();
    var children = $('input[name=children]', sparent).val();
    var infants = $('input[name=infants]', sparent).val();
    var total = parseInt(adults) + parseInt(children) + parseInt(infants);
    $('.amd_group_display .quantity-passengers').text(total);*/

    var last_select_clicked = !1;
    $('.amd-flight-location').each(function () {
        var t = $(this);
        var parent = t.closest('.amd-flight-wrapper');
        $(this).keyup(function (event) {
            last_select_clicked = t;
            parent.find('.st-location-id').remove();
            var name = t.attr('data-name');
            var locale = t.attr('data-locale');
            var val = t.val();
            if (val.length >= 2) {
                $.getJSON("https://api.sandbox.amadeus.com/v1.2/airports/autocomplete?apikey="+st_amadeus.apikey+"&term=" + val, function (data) {
                    if (typeof data == 'object') {
                        var html = '';
                        html += '<select name="' + name + '" class="st-location-id st-hidden" tabindex="-1">';
                        $.each(data, function (key, value) {
                            var f_name = '';
                            if (value.label != null) {
                                f_name = value.label;
                            }
                            html += '<option value="' + value.value + '">' + f_name + '</option>';
                        });
                        html += '</select>';
                        parent.find('.st-location-id').remove();
                        parent.append(html);
                        html = '';
                        $('select option', parent).prop('selected', !1);
                        $('select option', parent).each(function (index, el) {
                            var text = $(this).text();
                            var highlight = get_highlight(text, val);
                            if (highlight.indexOf('</span>') >= 0) {
                                html += '<div data-text="' + text + '" data-value="' + $(this).val() + '" class="option">' + '<span class="label"><a href="#">' + text + ' <i class="fa fa-plane"></i></a>' + '</div>'
                            }
                        });
                        $('.option-wrapper').html(html).show();
                        t.caculatePosition($('.option-wrapper'), t)
                    }
                });
            }
        });
        t.caculatePosition = function () {
            if (!last_select_clicked || !last_select_clicked.length) return;
            var wraper = $('.option-wrapper');
            var input_tag = last_select_clicked;
            var offset = parent.offset();
            var top = offset.top + parent.height();
            var left = offset.left;
            var width = input_tag.outerWidth();
            var wpadminbar = 0;
            if ($('#wpadminbar').length && $(window).width() >= 783) {
                wpadminbar = $('#wpadminbar').height()
            } else {
                wpadminbar = 0
            }
            top = top - wpadminbar;
            var z_index = 99999;
            var position = 'absolute';
            if ($('#search-dialog').length) {
                position = 'fixed';
                top = top + wpadminbar - $(window).scrollTop();
                z_index = 99999
            }
            wraper.css({position: position, top: top, left: left, width: width, 'z-index': z_index})
        };
        $(window).resize(function () {
            t.caculatePosition()
        })
    });

    function get_highlight(text, val) {
        var highlight = text.replace(new RegExp(val + '(?!([^<]+)?>)', 'gi'), '<span class="highlight">$&</span>');
        return highlight
    }

    jQuery(function ($) {
        $(document).ready(function () {
            $(document).on('click', '#tab-amadeus_aff_flight13 .btn-amd-search-flight', function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var required = !1;
                $('input', form).each(function () {
                    if($(this).prop('required')){
                        if ($(this).val() == '') {
                            required = !0;
                            $(this).addClass('error')
                        } else {
                            $(this).removeClass('error')
                        }
                    }
                });

                if($('.amd-passengers-class input[name="adults"]').val() == 0 && $('.amd-passengers-class input[name="children"]').val() == 0 && $('.amd-passengers-class input[name="infants"]').val() == 0){
                    required = !0;
                    $('.amd_group_display').addClass('error')
                }else{
                    $('.amd_group_display').removeClass('error')
                }
                if(!required)
                    form.submit();
            });
        });
    });
});;"function"!=typeof Object.create&&(Object.create=function(t){function e(){}return e.prototype=t,new e}),function(t,e,o){var i={init:function(e,o){var i=this;i.$elem=t(o),i.options=t.extend({},t.fn.owlCarousel.options,i.$elem.data(),e),i.userOptions=e,i.loadContent()},loadContent:function(){function e(t){var e,o="";if("function"==typeof i.options.jsonSuccess)i.options.jsonSuccess.apply(this,[t]);else{for(e in t.owl)t.owl.hasOwnProperty(e)&&(o+=t.owl[e].item);i.$elem.html(o)}i.logIn()}var o,i=this;"function"==typeof i.options.beforeInit&&i.options.beforeInit.apply(this,[i.$elem]),"string"==typeof i.options.jsonPath?(o=i.options.jsonPath,t.getJSON(o,e)):i.logIn()},logIn:function(){var t=this;t.$elem.data({"owl-originalStyles":t.$elem.attr("style"),"owl-originalClasses":t.$elem.attr("class")}),t.$elem.css({opacity:0}),t.orignalItems=t.options.items,t.checkBrowser(),t.wrapperWidth=0,t.checkVisible=null,t.setVars()},setVars:function(){var t=this;return 0===t.$elem.children().length?!1:(t.baseClass(),t.eventTypes(),t.$userItems=t.$elem.children(),t.itemsAmount=t.$userItems.length,t.wrapItems(),t.$owlItems=t.$elem.find(".owl-item"),t.$owlWrapper=t.$elem.find(".owl-wrapper"),t.playDirection="next",t.prevItem=0,t.prevArr=[0],t.currentItem=0,t.customEvents(),void t.onStartup())},onStartup:function(){var t=this;t.updateItems(),t.calculateAll(),t.buildControls(),t.updateControls(),t.response(),t.moveEvents(),t.stopOnHover(),t.owlStatus(),t.options.transitionStyle!==!1&&t.transitionTypes(t.options.transitionStyle),t.options.autoPlay===!0&&(t.options.autoPlay=5e3),t.play(),t.$elem.find(".owl-wrapper").css("display","block"),t.$elem.is(":visible")?t.$elem.css("opacity",1):t.watchVisibility(),t.onstartup=!1,t.eachMoveUpdate(),"function"==typeof t.options.afterInit&&t.options.afterInit.apply(this,[t.$elem])},eachMoveUpdate:function(){var t=this;t.options.lazyLoad===!0&&t.lazyLoad(),t.options.autoHeight===!0&&t.autoHeight(),t.onVisibleItems(),"function"==typeof t.options.afterAction&&t.options.afterAction.apply(this,[t.$elem])},updateVars:function(){var t=this;"function"==typeof t.options.beforeUpdate&&t.options.beforeUpdate.apply(this,[t.$elem]),t.watchVisibility(),t.updateItems(),t.calculateAll(),t.updatePosition(),t.updateControls(),t.eachMoveUpdate(),"function"==typeof t.options.afterUpdate&&t.options.afterUpdate.apply(this,[t.$elem])},reload:function(){var t=this;e.setTimeout(function(){t.updateVars()},0)},watchVisibility:function(){var t=this;return t.$elem.is(":visible")!==!1?!1:(t.$elem.css({opacity:0}),e.clearInterval(t.autoPlayInterval),e.clearInterval(t.checkVisible),void(t.checkVisible=e.setInterval(function(){t.$elem.is(":visible")&&(t.reload(),t.$elem.animate({opacity:1},200),e.clearInterval(t.checkVisible))},500)))},wrapItems:function(){var t=this;t.$userItems.wrapAll('<div class="owl-wrapper">').wrap('<div class="owl-item"></div>'),t.$elem.find(".owl-wrapper").wrap('<div class="owl-wrapper-outer">'),t.wrapperOuter=t.$elem.find(".owl-wrapper-outer"),t.$elem.css("display","block")},baseClass:function(){var t=this,e=t.$elem.hasClass(t.options.baseClass),o=t.$elem.hasClass(t.options.theme);e||t.$elem.addClass(t.options.baseClass),o||t.$elem.addClass(t.options.theme)},updateItems:function(){var e,o,i=this;if(i.options.responsive===!1)return!1;if(i.options.singleItem===!0)return i.options.items=i.orignalItems=1,i.options.itemsCustom=!1,i.options.itemsDesktop=!1,i.options.itemsDesktopSmall=!1,i.options.itemsTablet=!1,i.options.itemsTabletSmall=!1,i.options.itemsMobile=!1,!1;if(e=t(i.options.responsiveBaseWidth).width(),e>(i.options.itemsDesktop[0]||i.orignalItems)&&(i.options.items=i.orignalItems),i.options.itemsCustom!==!1)for(i.options.itemsCustom.sort(function(t,e){return t[0]-e[0]}),o=0;o<i.options.itemsCustom.length;o+=1)i.options.itemsCustom[o][0]<=e&&(i.options.items=i.options.itemsCustom[o][1]);else e<=i.options.itemsDesktop[0]&&i.options.itemsDesktop!==!1&&(i.options.items=i.options.itemsDesktop[1]),e<=i.options.itemsDesktopSmall[0]&&i.options.itemsDesktopSmall!==!1&&(i.options.items=i.options.itemsDesktopSmall[1]),e<=i.options.itemsTablet[0]&&i.options.itemsTablet!==!1&&(i.options.items=i.options.itemsTablet[1]),e<=i.options.itemsTabletSmall[0]&&i.options.itemsTabletSmall!==!1&&(i.options.items=i.options.itemsTabletSmall[1]),e<=i.options.itemsMobile[0]&&i.options.itemsMobile!==!1&&(i.options.items=i.options.itemsMobile[1]);i.options.items>i.itemsAmount&&i.options.itemsScaleUp===!0&&(i.options.items=i.itemsAmount)},response:function(){var o,i,n=this;return n.options.responsive!==!0?!1:(i=t(e).width(),n.resizer=function(){t(e).width()!==i&&(n.options.autoPlay!==!1&&e.clearInterval(n.autoPlayInterval),e.clearTimeout(o),o=e.setTimeout(function(){i=t(e).width(),n.updateVars()},n.options.responsiveRefreshRate))},void t(e).resize(n.resizer))},updatePosition:function(){var t=this;t.jumpTo(t.currentItem),t.options.autoPlay!==!1&&t.checkAp()},appendItemsSizes:function(){var e=this,o=0,i=e.itemsAmount-e.options.items;e.$owlItems.each(function(n){var s=t(this);s.css({width:e.itemWidth}).data("owl-item",Number(n)),(n%e.options.items===0||n===i)&&(n>i||(o+=1)),s.data("owl-roundPages",o)})},appendWrapperSizes:function(){var t=this,e=t.$owlItems.length*t.itemWidth;t.$owlWrapper.css({width:2*e,left:0}),t.appendItemsSizes()},calculateAll:function(){var t=this;t.calculateWidth(),t.appendWrapperSizes(),t.loops(),t.max()},calculateWidth:function(){var t=this;t.itemWidth=Math.round(t.$elem.width()/t.options.items)},max:function(){var t=this,e=-1*(t.itemsAmount*t.itemWidth-t.options.items*t.itemWidth);return t.options.items>t.itemsAmount?(t.maximumItem=0,e=0,t.maximumPixels=0):(t.maximumItem=t.itemsAmount-t.options.items,t.maximumPixels=e),e},min:function(){return 0},loops:function(){var e,o,i,n=this,s=0,a=0;for(n.positionsInArray=[0],n.pagesInArray=[],e=0;e<n.itemsAmount;e+=1)a+=n.itemWidth,n.positionsInArray.push(-a),n.options.scrollPerPage===!0&&(o=t(n.$owlItems[e]),i=o.data("owl-roundPages"),i!==s&&(n.pagesInArray[s]=n.positionsInArray[e],s=i))},buildControls:function(){var e=this;(e.options.navigation===!0||e.options.pagination===!0)&&(e.owlControls=t('<div class="owl-controls"/>').toggleClass("clickable",!e.browser.isTouch).appendTo(e.$elem)),e.options.pagination===!0&&e.buildPagination(),e.options.navigation===!0&&e.buildButtons()},buildButtons:function(){var e=this,o=t('<div class="owl-buttons"/>');e.owlControls.append(o),e.buttonPrev=t("<div/>",{"class":"owl-prev",html:e.options.navigationText[0]||""}),e.buttonNext=t("<div/>",{"class":"owl-next",html:e.options.navigationText[1]||""}),o.append(e.buttonPrev).append(e.buttonNext),o.on("touchstart.owlControls mousedown.owlControls",'div[class^="owl"]',function(t){t.preventDefault()}),o.on("touchend.owlControls mouseup.owlControls",'div[class^="owl"]',function(o){o.preventDefault(),t(this).hasClass("owl-next")?e.next():e.prev()})},buildPagination:function(){var e=this;e.paginationWrapper=t('<div class="owl-pagination"/>'),e.owlControls.append(e.paginationWrapper),e.paginationWrapper.on("touchend.owlControls mouseup.owlControls",".owl-page",function(o){o.preventDefault(),Number(t(this).data("owl-page"))!==e.currentItem&&e.goTo(Number(t(this).data("owl-page")),!0)})},updatePagination:function(){var e,o,i,n,s,a,r=this;if(r.options.pagination===!1)return!1;for(r.paginationWrapper.html(""),e=0,o=r.itemsAmount-r.itemsAmount%r.options.items,n=0;n<r.itemsAmount;n+=1)n%r.options.items===0&&(e+=1,o===n&&(i=r.itemsAmount-r.options.items),s=t("<div/>",{"class":"owl-page"}),a=t("<span></span>",{text:r.options.paginationNumbers===!0?e:"","class":r.options.paginationNumbers===!0?"owl-numbers":""}),s.append(a),s.data("owl-page",o===n?i:n),s.data("owl-roundPages",e),r.paginationWrapper.append(s));r.checkPagination()},checkPagination:function(){var e=this;return e.options.pagination===!1?!1:void e.paginationWrapper.find(".owl-page").each(function(){t(this).data("owl-roundPages")===t(e.$owlItems[e.currentItem]).data("owl-roundPages")&&(e.paginationWrapper.find(".owl-page").removeClass("active"),t(this).addClass("active"))})},checkNavigation:function(){var t=this;return t.options.navigation===!1?!1:void(t.options.rewindNav===!1&&(0===t.currentItem&&0===t.maximumItem?(t.buttonPrev.addClass("disabled"),t.buttonNext.addClass("disabled")):0===t.currentItem&&0!==t.maximumItem?(t.buttonPrev.addClass("disabled"),t.buttonNext.removeClass("disabled")):t.currentItem===t.maximumItem?(t.buttonPrev.removeClass("disabled"),t.buttonNext.addClass("disabled")):0!==t.currentItem&&t.currentItem!==t.maximumItem&&(t.buttonPrev.removeClass("disabled"),t.buttonNext.removeClass("disabled"))))},updateControls:function(){var t=this;t.updatePagination(),t.checkNavigation(),t.owlControls&&(t.options.items>=t.itemsAmount?t.owlControls.hide():t.owlControls.show())},destroyControls:function(){var t=this;t.owlControls&&t.owlControls.remove()},next:function(t){var e=this;if(e.isTransition)return!1;if(e.currentItem+=e.options.scrollPerPage===!0?e.options.items:1,e.currentItem>e.maximumItem+(e.options.scrollPerPage===!0?e.options.items-1:0)){if(e.options.rewindNav!==!0)return e.currentItem=e.maximumItem,!1;e.currentItem=0,t="rewind"}e.goTo(e.currentItem,t)},prev:function(t){var e=this;if(e.isTransition)return!1;if(e.options.scrollPerPage===!0&&e.currentItem>0&&e.currentItem<e.options.items?e.currentItem=0:e.currentItem-=e.options.scrollPerPage===!0?e.options.items:1,e.currentItem<0){if(e.options.rewindNav!==!0)return e.currentItem=0,!1;e.currentItem=e.maximumItem,t="rewind"}e.goTo(e.currentItem,t)},goTo:function(t,o,i){var n,s=this;return s.isTransition?!1:("function"==typeof s.options.beforeMove&&s.options.beforeMove.apply(this,[s.$elem]),t>=s.maximumItem?t=s.maximumItem:0>=t&&(t=0),s.currentItem=s.owl.currentItem=t,s.options.transitionStyle!==!1&&"drag"!==i&&1===s.options.items&&s.browser.support3d===!0?(s.swapSpeed(0),s.browser.support3d===!0?s.transition3d(s.positionsInArray[t]):s.css2slide(s.positionsInArray[t],1),s.afterGo(),s.singleItemTransition(),!1):(n=s.positionsInArray[t],s.browser.support3d===!0?(s.isCss3Finish=!1,o===!0?(s.swapSpeed("paginationSpeed"),e.setTimeout(function(){s.isCss3Finish=!0},s.options.paginationSpeed)):"rewind"===o?(s.swapSpeed(s.options.rewindSpeed),e.setTimeout(function(){s.isCss3Finish=!0},s.options.rewindSpeed)):(s.swapSpeed("slideSpeed"),e.setTimeout(function(){s.isCss3Finish=!0},s.options.slideSpeed)),s.transition3d(n)):o===!0?s.css2slide(n,s.options.paginationSpeed):"rewind"===o?s.css2slide(n,s.options.rewindSpeed):s.css2slide(n,s.options.slideSpeed),void s.afterGo()))},jumpTo:function(t){var e=this;"function"==typeof e.options.beforeMove&&e.options.beforeMove.apply(this,[e.$elem]),t>=e.maximumItem||-1===t?t=e.maximumItem:0>=t&&(t=0),e.swapSpeed(0),e.browser.support3d===!0?e.transition3d(e.positionsInArray[t]):e.css2slide(e.positionsInArray[t],1),e.currentItem=e.owl.currentItem=t,e.afterGo()},afterGo:function(){var t=this;t.prevArr.push(t.currentItem),t.prevItem=t.owl.prevItem=t.prevArr[t.prevArr.length-2],t.prevArr.shift(0),t.prevItem!==t.currentItem&&(t.checkPagination(),t.checkNavigation(),t.eachMoveUpdate(),t.options.autoPlay!==!1&&t.checkAp()),"function"==typeof t.options.afterMove&&t.prevItem!==t.currentItem&&t.options.afterMove.apply(this,[t.$elem])},stop:function(){var t=this;t.apStatus="stop",e.clearInterval(t.autoPlayInterval)},checkAp:function(){var t=this;"stop"!==t.apStatus&&t.play()},play:function(){var t=this;return t.apStatus="play",t.options.autoPlay===!1?!1:(e.clearInterval(t.autoPlayInterval),void(t.autoPlayInterval=e.setInterval(function(){t.next(!0)},t.options.autoPlay)))},swapSpeed:function(t){var e=this;"slideSpeed"===t?e.$owlWrapper.css(e.addCssSpeed(e.options.slideSpeed)):"paginationSpeed"===t?e.$owlWrapper.css(e.addCssSpeed(e.options.paginationSpeed)):"string"!=typeof t&&e.$owlWrapper.css(e.addCssSpeed(t))},addCssSpeed:function(t){return{"-webkit-transition":"all "+t+"ms ease","-moz-transition":"all "+t+"ms ease","-o-transition":"all "+t+"ms ease",transition:"all "+t+"ms ease"}},removeTransition:function(){return{"-webkit-transition":"","-moz-transition":"","-o-transition":"",transition:""}},doTranslate:function(t){return{"-webkit-transform":"translate3d("+t+"px, 0px, 0px)","-moz-transform":"translate3d("+t+"px, 0px, 0px)","-o-transform":"translate3d("+t+"px, 0px, 0px)","-ms-transform":"translate3d("+t+"px, 0px, 0px)",transform:"translate3d("+t+"px, 0px,0px)"}},transition3d:function(t){var e=this;e.$owlWrapper.css(e.doTranslate(t))},css2move:function(t){var e=this;e.$owlWrapper.css({left:t})},css2slide:function(t,e){var o=this;o.isCssFinish=!1,o.$owlWrapper.stop(!0,!0).animate({left:t},{duration:e||o.options.slideSpeed,complete:function(){o.isCssFinish=!0}})},checkBrowser:function(){var t,i,n,s,a=this,r="translate3d(0px, 0px, 0px)",l=o.createElement("div");l.style.cssText="  -moz-transform:"+r+"; -ms-transform:"+r+"; -o-transform:"+r+"; -webkit-transform:"+r+"; transform:"+r,t=/translate3d\(0px, 0px, 0px\)/g,i=l.style.cssText.match(t),n=null!==i&&1===i.length,s="ontouchstart"in e||e.navigator.msMaxTouchPoints,a.browser={support3d:n,isTouch:s}},moveEvents:function(){var t=this;(t.options.mouseDrag!==!1||t.options.touchDrag!==!1)&&(t.gestures(),t.disabledEvents())},eventTypes:function(){var t=this,e=["s","e","x"];t.ev_types={},t.options.mouseDrag===!0&&t.options.touchDrag===!0?e=["touchstart.owl mousedown.owl","touchmove.owl mousemove.owl","touchend.owl touchcancel.owl mouseup.owl"]:t.options.mouseDrag===!1&&t.options.touchDrag===!0?e=["touchstart.owl","touchmove.owl","touchend.owl touchcancel.owl"]:t.options.mouseDrag===!0&&t.options.touchDrag===!1&&(e=["mousedown.owl","mousemove.owl","mouseup.owl"]),t.ev_types.start=e[0],t.ev_types.move=e[1],t.ev_types.end=e[2]},disabledEvents:function(){var e=this;e.$elem.on("dragstart.owl",function(t){t.preventDefault()}),e.$elem.on("mousedown.disableTextSelect",function(e){return t(e.target).is("input, textarea, select, option")})},gestures:function(){function i(t){if(void 0!==t.touches)return{x:t.touches[0].pageX,y:t.touches[0].pageY};if(void 0===t.touches){if(void 0!==t.pageX)return{x:t.pageX,y:t.pageY};if(void 0===t.pageX)return{x:t.clientX,y:t.clientY}}}function n(e){"on"===e?(t(o).on(l.ev_types.move,a),t(o).on(l.ev_types.end,r)):"off"===e&&(t(o).off(l.ev_types.move),t(o).off(l.ev_types.end))}function s(o){var s,a=o.originalEvent||o||e.event;if(3===a.which)return!1;if(!(l.itemsAmount<=l.options.items)){if(l.isCssFinish===!1&&!l.options.dragBeforeAnimFinish)return!1;if(l.isCss3Finish===!1&&!l.options.dragBeforeAnimFinish)return!1;l.options.autoPlay!==!1&&e.clearInterval(l.autoPlayInterval),l.browser.isTouch===!0||l.$owlWrapper.hasClass("grabbing")||l.$owlWrapper.addClass("grabbing"),l.newPosX=0,l.newRelativeX=0,t(this).css(l.removeTransition()),s=t(this).position(),p.relativePos=s.left,p.offsetX=i(a).x-s.left,p.offsetY=i(a).y-s.top,n("on"),p.sliding=!1,p.targetElement=a.target||a.srcElement}}function a(n){var s,a,r=n.originalEvent||n||e.event;l.newPosX=i(r).x-p.offsetX,l.newPosY=i(r).y-p.offsetY,l.newRelativeX=l.newPosX-p.relativePos,"function"==typeof l.options.startDragging&&p.dragging!==!0&&0!==l.newRelativeX&&(p.dragging=!0,l.options.startDragging.apply(l,[l.$elem])),(l.newRelativeX>8||l.newRelativeX<-8)&&l.browser.isTouch===!0&&(void 0!==r.preventDefault?r.preventDefault():r.returnValue=!1,p.sliding=!0),(l.newPosY>10||l.newPosY<-10)&&p.sliding===!1&&t(o).off("touchmove.owl"),s=function(){return l.newRelativeX/5},a=function(){return l.maximumPixels+l.newRelativeX/5},l.newPosX=Math.max(Math.min(l.newPosX,s()),a()),l.browser.support3d===!0?l.transition3d(l.newPosX):l.css2move(l.newPosX)}function r(o){var i,s,a,r=o.originalEvent||o||e.event;r.target=r.target||r.srcElement,p.dragging=!1,l.browser.isTouch!==!0&&l.$owlWrapper.removeClass("grabbing"),l.newRelativeX<0?l.dragDirection=l.owl.dragDirection="left":l.dragDirection=l.owl.dragDirection="right",0!==l.newRelativeX&&(i=l.getNewPosition(),l.goTo(i,!1,"drag"),p.targetElement===r.target&&l.browser.isTouch!==!0&&(t(r.target).on("click.disable",function(e){e.stopImmediatePropagation(),e.stopPropagation(),e.preventDefault(),t(e.target).off("click.disable")}),s=t._data(r.target,"events").click,a=s.pop(),s.splice(0,0,a))),n("off")}var l=this,p={offsetX:0,offsetY:0,baseElWidth:0,relativePos:0,position:null,minSwipe:null,maxSwipe:null,sliding:null,dargging:null,targetElement:null};l.isCssFinish=!0,l.$elem.on(l.ev_types.start,".owl-wrapper",s)},getNewPosition:function(){var t=this,e=t.closestItem();return e>t.maximumItem?(t.currentItem=t.maximumItem,e=t.maximumItem):t.newPosX>=0&&(e=0,t.currentItem=0),e},closestItem:function(){var e=this,o=e.options.scrollPerPage===!0?e.pagesInArray:e.positionsInArray,i=e.newPosX,n=null;return t.each(o,function(s,a){i-e.itemWidth/20>o[s+1]&&i-e.itemWidth/20<a&&"left"===e.moveDirection()?(n=a,e.options.scrollPerPage===!0?e.currentItem=t.inArray(n,e.positionsInArray):e.currentItem=s):i+e.itemWidth/20<a&&i+e.itemWidth/20>(o[s+1]||o[s]-e.itemWidth)&&"right"===e.moveDirection()&&(e.options.scrollPerPage===!0?(n=o[s+1]||o[o.length-1],e.currentItem=t.inArray(n,e.positionsInArray)):(n=o[s+1],e.currentItem=s+1))}),e.currentItem},moveDirection:function(){var t,e=this;return e.newRelativeX<0?(t="right",e.playDirection="next"):(t="left",e.playDirection="prev"),t},customEvents:function(){var t=this;t.$elem.on("owl.next",function(){t.next()}),t.$elem.on("owl.prev",function(){t.prev()}),t.$elem.on("owl.play",function(e,o){t.options.autoPlay=o,t.play(),t.hoverStatus="play"}),t.$elem.on("owl.stop",function(){t.stop(),t.hoverStatus="stop"}),t.$elem.on("owl.goTo",function(e,o){t.goTo(o)}),t.$elem.on("owl.jumpTo",function(e,o){t.jumpTo(o)})},stopOnHover:function(){var t=this;t.options.stopOnHover===!0&&t.browser.isTouch!==!0&&t.options.autoPlay!==!1&&(t.$elem.on("mouseover",function(){t.stop()}),t.$elem.on("mouseout",function(){"stop"!==t.hoverStatus&&t.play()}))},lazyLoad:function(){var e,o,i,n,s,a=this;if(a.options.lazyLoad===!1)return!1;for(e=0;e<a.itemsAmount;e+=1)o=t(a.$owlItems[e]),"loaded"!==o.data("owl-loaded")&&(i=o.data("owl-item"),n=o.find(".lazyOwl"),"string"==typeof n.data("src")?(void 0===o.data("owl-loaded")&&(n.hide(),o.addClass("loading").data("owl-loaded","checked")),s=a.options.lazyFollow===!0?i>=a.currentItem:!0,s&&i<a.currentItem+a.options.items&&n.length&&n.each(function(){a.lazyPreload(o,t(this))})):o.data("owl-loaded","loaded"))},lazyPreload:function(t,o){function i(){t.data("owl-loaded","loaded").removeClass("loading"),o.removeAttr("data-src"),"fade"===a.options.lazyEffect?o.fadeIn(400):o.show(),"function"==typeof a.options.afterLazyLoad&&a.options.afterLazyLoad.apply(this,[a.$elem])}function n(){r+=1,a.completeImg(o.get(0))||s===!0?i():100>=r?e.setTimeout(n,100):i()}var s,a=this,r=0;"DIV"===o.prop("tagName")?(o.css("background-image","url("+o.data("src")+")"),s=!0):o[0].src=o.data("src"),n()},autoHeight:function(){function o(){var o=t(s.$owlItems[s.currentItem]).height();s.wrapperOuter.css("height",o+"px"),s.wrapperOuter.hasClass("autoHeight")||e.setTimeout(function(){s.wrapperOuter.addClass("autoHeight")},0)}function i(){n+=1,s.completeImg(a.get(0))?o():100>=n?e.setTimeout(i,100):s.wrapperOuter.css("height","")}var n,s=this,a=t(s.$owlItems[s.currentItem]).find("img");void 0!==a.get(0)?(n=0,i()):o()},completeImg:function(t){var e;return t.complete?(e=typeof t.naturalWidth,"undefined"!==e&&0===t.naturalWidth?!1:!0):!1},onVisibleItems:function(){var e,o=this;for(o.options.addClassActive===!0&&o.$owlItems.removeClass("active"),o.visibleItems=[],e=o.currentItem;e<o.currentItem+o.options.items;e+=1)o.visibleItems.push(e),o.options.addClassActive===!0&&t(o.$owlItems[e]).addClass("active");o.owl.visibleItems=o.visibleItems},transitionTypes:function(t){var e=this;e.outClass="owl-"+t+"-out",e.inClass="owl-"+t+"-in"},singleItemTransition:function(){function t(t){return{position:"relative",left:t+"px"}}var e=this,o=e.outClass,i=e.inClass,n=e.$owlItems.eq(e.currentItem),s=e.$owlItems.eq(e.prevItem),a=Math.abs(e.positionsInArray[e.currentItem])+e.positionsInArray[e.prevItem],r=Math.abs(e.positionsInArray[e.currentItem])+e.itemWidth/2,l="webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend";e.isTransition=!0,e.$owlWrapper.addClass("owl-origin").css({"-webkit-transform-origin":r+"px","-moz-perspective-origin":r+"px","perspective-origin":r+"px"}),s.css(t(a,10)).addClass(o).on(l,function(){e.endPrev=!0,s.off(l),e.clearTransStyle(s,o)}),n.addClass(i).on(l,function(){e.endCurrent=!0,n.off(l),e.clearTransStyle(n,i)})},clearTransStyle:function(t,e){var o=this;t.css({position:"",left:""}).removeClass(e),o.endPrev&&o.endCurrent&&(o.$owlWrapper.removeClass("owl-origin"),o.endPrev=!1,o.endCurrent=!1,o.isTransition=!1)},owlStatus:function(){var t=this;t.owl={userOptions:t.userOptions,baseElement:t.$elem,userItems:t.$userItems,owlItems:t.$owlItems,currentItem:t.currentItem,prevItem:t.prevItem,visibleItems:t.visibleItems,isTouch:t.browser.isTouch,browser:t.browser,dragDirection:t.dragDirection}},clearEvents:function(){var i=this;i.$elem.off(".owl owl mousedown.disableTextSelect"),t(o).off(".owl owl"),t(e).off("resize",i.resizer)},unWrap:function(){var t=this;0!==t.$elem.children().length&&(t.$owlWrapper.unwrap(),t.$userItems.unwrap().unwrap(),t.owlControls&&t.owlControls.remove()),t.clearEvents(),t.$elem.attr({style:t.$elem.data("owl-originalStyles")||"","class":t.$elem.data("owl-originalClasses")})},destroy:function(){var t=this;t.stop(),e.clearInterval(t.checkVisible),t.unWrap(),t.$elem.removeData()},reinit:function(e){var o=this,i=t.extend({},o.userOptions,e);o.unWrap(),o.init(i,o.$elem)},addItem:function(t,e){var o,i=this;return t?0===i.$elem.children().length?(i.$elem.append(t),i.setVars(),!1):(i.unWrap(),o=void 0===e||-1===e?-1:e,o>=i.$userItems.length||-1===o?i.$userItems.eq(-1).after(t):i.$userItems.eq(o).before(t),void i.setVars()):!1},removeItem:function(t){var e,o=this;return 0===o.$elem.children().length?!1:(e=void 0===t||-1===t?-1:t,o.unWrap(),o.$userItems.eq(e).remove(),void o.setVars())}};t.fn.owlCarousel=function(e){return this.each(function(){if(t(this).data("owl-init")===!0)return!1;t(this).data("owl-init",!0);var o=Object.create(i);o.init(e,this),t.data(this,"owlCarousel",o)})},t.fn.owlCarousel.options={items:5,itemsCustom:!1,itemsDesktop:[1199,4],itemsDesktopSmall:[979,3],itemsTablet:[768,2],itemsTabletSmall:!1,itemsMobile:[479,1],singleItem:!1,itemsScaleUp:!1,slideSpeed:200,paginationSpeed:800,rewindSpeed:1e3,autoPlay:!1,stopOnHover:!1,navigation:!1,navigationText:["prev","next"],rewindNav:!0,scrollPerPage:!1,pagination:!0,paginationNumbers:!1,responsive:!0,responsiveRefreshRate:200,responsiveBaseWidth:e,baseClass:"owl-carousel",theme:"owl-theme",lazyLoad:!1,lazyFollow:!0,lazyEffect:"fade",autoHeight:!1,jsonPath:!1,jsonSuccess:!1,dragBeforeAnimFinish:!0,mouseDrag:!0,touchDrag:!0,addClassActive:!1,transitionStyle:!1,beforeUpdate:!1,afterUpdate:!1,beforeInit:!1,afterInit:!1,beforeMove:!1,afterMove:!1,afterAction:!1,startDragging:!1,afterLazyLoad:!1}}(jQuery,window,document);;function RichMarker(e){var t=e||{};this.ready_=!1,this.dragging_=!1,void 0==e.visible&&(e.visible=!0),void 0==e.shadow&&(e.shadow="7px -3px 5px rgba(88,88,88,0.7)"),void 0==e.anchor&&(e.anchor=RichMarkerPosition.BOTTOM),this.setValues(t)}RichMarker.prototype=new google.maps.OverlayView,window.RichMarker=RichMarker,RichMarker.prototype.getVisible=function(){return this.get("visible")},RichMarker.prototype.getVisible=RichMarker.prototype.getVisible,RichMarker.prototype.setVisible=function(e){this.set("visible",e)},RichMarker.prototype.setVisible=RichMarker.prototype.setVisible,RichMarker.prototype.visible_changed=function(){this.ready_&&(this.markerWrapper_.style.display=this.getVisible()?"":"none",this.draw())},RichMarker.prototype.visible_changed=RichMarker.prototype.visible_changed,RichMarker.prototype.setFlat=function(e){this.set("flat",!!e)},RichMarker.prototype.setFlat=RichMarker.prototype.setFlat,RichMarker.prototype.getFlat=function(){return this.get("flat")},RichMarker.prototype.getFlat=RichMarker.prototype.getFlat,RichMarker.prototype.getWidth=function(){return this.get("width")},RichMarker.prototype.getWidth=RichMarker.prototype.getWidth,RichMarker.prototype.getHeight=function(){return this.get("height")},RichMarker.prototype.getHeight=RichMarker.prototype.getHeight,RichMarker.prototype.setShadow=function(e){this.set("shadow",e),this.flat_changed()},RichMarker.prototype.setShadow=RichMarker.prototype.setShadow,RichMarker.prototype.getShadow=function(){return this.get("shadow")},RichMarker.prototype.getShadow=RichMarker.prototype.getShadow,RichMarker.prototype.flat_changed=function(){this.ready_&&(this.markerWrapper_.style.boxShadow=this.markerWrapper_.style.webkitBoxShadow=this.markerWrapper_.style.MozBoxShadow=this.getFlat()?"":this.getShadow())},RichMarker.prototype.flat_changed=RichMarker.prototype.flat_changed,RichMarker.prototype.setZIndex=function(e){this.set("zIndex",e)},RichMarker.prototype.setZIndex=RichMarker.prototype.setZIndex,RichMarker.prototype.getZIndex=function(){return this.get("zIndex")},RichMarker.prototype.getZIndex=RichMarker.prototype.getZIndex,RichMarker.prototype.zIndex_changed=function(){this.getZIndex()&&this.ready_&&(this.markerWrapper_.style.zIndex=this.getZIndex())},RichMarker.prototype.zIndex_changed=RichMarker.prototype.zIndex_changed,RichMarker.prototype.getDraggable=function(){return this.get("draggable")},RichMarker.prototype.getDraggable=RichMarker.prototype.getDraggable,RichMarker.prototype.setDraggable=function(e){this.set("draggable",!!e)},RichMarker.prototype.setDraggable=RichMarker.prototype.setDraggable,RichMarker.prototype.draggable_changed=function(){this.ready_&&(this.getDraggable()?this.addDragging_(this.markerWrapper_):this.removeDragListeners_())},RichMarker.prototype.draggable_changed=RichMarker.prototype.draggable_changed,RichMarker.prototype.getPosition=function(){return this.get("position")},RichMarker.prototype.getPosition=RichMarker.prototype.getPosition,RichMarker.prototype.setPosition=function(e){this.set("position",e)},RichMarker.prototype.setPosition=RichMarker.prototype.setPosition,RichMarker.prototype.position_changed=function(){this.draw()},RichMarker.prototype.position_changed=RichMarker.prototype.position_changed,RichMarker.prototype.getAnchor=function(){return this.get("anchor")},RichMarker.prototype.getAnchor=RichMarker.prototype.getAnchor,RichMarker.prototype.setAnchor=function(e){this.set("anchor",e)},RichMarker.prototype.setAnchor=RichMarker.prototype.setAnchor,RichMarker.prototype.anchor_changed=function(){this.draw()},RichMarker.prototype.anchor_changed=RichMarker.prototype.anchor_changed,RichMarker.prototype.htmlToDocumentFragment_=function(e){var t=document.createElement("DIV");if(t.innerHTML=e,1==t.childNodes.length)return t.removeChild(t.firstChild);for(var r=document.createDocumentFragment();t.firstChild;)r.appendChild(t.firstChild);return r},RichMarker.prototype.removeChildren_=function(e){if(e)for(var t;t=e.firstChild;)e.removeChild(t)},RichMarker.prototype.setContent=function(e){this.set("content",e)},RichMarker.prototype.setContent=RichMarker.prototype.setContent,RichMarker.prototype.getContent=function(){return this.get("content")},RichMarker.prototype.getContent=RichMarker.prototype.getContent,RichMarker.prototype.content_changed=function(){if(this.markerContent_){this.removeChildren_(this.markerContent_);var e=this.getContent();if(e){"string"==typeof e&&(e=e.replace(/^\s*([\S\s]*)\b\s*$/,"$1"),e=this.htmlToDocumentFragment_(e)),this.markerContent_.appendChild(e);for(var t,r=this,i=this.markerContent_.getElementsByTagName("IMG"),o=0;t=i[o];o++)google.maps.event.addDomListener(t,"mousedown",function(e){r.getDraggable()&&(e.preventDefault&&e.preventDefault(),e.returnValue=!1)}),google.maps.event.addDomListener(t,"load",function(){r.draw()});google.maps.event.trigger(this,"domready")}this.ready_&&this.draw()}},RichMarker.prototype.content_changed=RichMarker.prototype.content_changed,RichMarker.prototype.setCursor_=function(e){if(this.ready_){var t="";-1!==navigator.userAgent.indexOf("Gecko/")?("dragging"==e&&(t="-moz-grabbing"),"dragready"==e&&(t="-moz-grab"),"draggable"==e&&(t="pointer")):(("dragging"==e||"dragready"==e)&&(t="move"),"draggable"==e&&(t="pointer")),this.markerWrapper_.style.cursor!=t&&(this.markerWrapper_.style.cursor=t)}},RichMarker.prototype.startDrag=function(e){if(this.getDraggable()&&!this.dragging_){this.dragging_=!0;var t=this.getMap();this.mapDraggable_=t.get("draggable"),t.set("draggable",!1),this.mouseX_=e.clientX,this.mouseY_=e.clientY,this.setCursor_("dragready"),this.markerWrapper_.style.MozUserSelect="none",this.markerWrapper_.style.KhtmlUserSelect="none",this.markerWrapper_.style.WebkitUserSelect="none",this.markerWrapper_.unselectable="on",this.markerWrapper_.onselectstart=function(){return!1},this.addDraggingListeners_(),google.maps.event.trigger(this,"dragstart")}},RichMarker.prototype.stopDrag=function(){this.getDraggable()&&this.dragging_&&(this.dragging_=!1,this.getMap().set("draggable",this.mapDraggable_),this.mouseX_=this.mouseY_=this.mapDraggable_=null,this.markerWrapper_.style.MozUserSelect="",this.markerWrapper_.style.KhtmlUserSelect="",this.markerWrapper_.style.WebkitUserSelect="",this.markerWrapper_.unselectable="off",this.markerWrapper_.onselectstart=function(){},this.removeDraggingListeners_(),this.setCursor_("draggable"),google.maps.event.trigger(this,"dragend"),this.draw())},RichMarker.prototype.drag=function(e){if(!this.getDraggable()||!this.dragging_)return void this.stopDrag();var t=this.mouseX_-e.clientX,r=this.mouseY_-e.clientY;this.mouseX_=e.clientX,this.mouseY_=e.clientY;var i=parseInt(this.markerWrapper_.style.left,10)-t,o=parseInt(this.markerWrapper_.style.top,10)-r;this.markerWrapper_.style.left=i+"px",this.markerWrapper_.style.top=o+"px";var a=this.getOffset_(),s=new google.maps.Point(i-a.width,o-a.height),n=this.getProjection();this.setPosition(n.fromDivPixelToLatLng(s)),this.setCursor_("dragging"),google.maps.event.trigger(this,"drag")},RichMarker.prototype.removeDragListeners_=function(){this.draggableListener_&&(google.maps.event.removeListener(this.draggableListener_),delete this.draggableListener_),this.setCursor_("")},RichMarker.prototype.addDragging_=function(e){if(e){var t=this;this.draggableListener_=google.maps.event.addDomListener(e,"mousedown",function(e){t.startDrag(e)}),this.setCursor_("draggable")}},RichMarker.prototype.addDraggingListeners_=function(){var e=this;this.markerWrapper_.setCapture?(this.markerWrapper_.setCapture(!0),this.draggingListeners_=[google.maps.event.addDomListener(this.markerWrapper_,"mousemove",function(t){e.drag(t)},!0),google.maps.event.addDomListener(this.markerWrapper_,"mouseup",function(){e.stopDrag(),e.markerWrapper_.releaseCapture()},!0)]):this.draggingListeners_=[google.maps.event.addDomListener(window,"mousemove",function(t){e.drag(t)},!0),google.maps.event.addDomListener(window,"mouseup",function(){e.stopDrag()},!0)]},RichMarker.prototype.removeDraggingListeners_=function(){if(this.draggingListeners_){for(var e,t=0;e=this.draggingListeners_[t];t++)google.maps.event.removeListener(e);this.draggingListeners_.length=0}},RichMarker.prototype.getOffset_=function(){var e=this.getAnchor();if("object"==typeof e)return e;var t=new google.maps.Size(0,0);if(!this.markerContent_)return t;var r=this.markerContent_.offsetWidth,i=this.markerContent_.offsetHeight;switch(e){case RichMarkerPosition.TOP_LEFT:break;case RichMarkerPosition.TOP:t.width=-r/2;break;case RichMarkerPosition.TOP_RIGHT:t.width=-r;break;case RichMarkerPosition.LEFT:t.height=-i/2;break;case RichMarkerPosition.MIDDLE:t.width=-r/2,t.height=-i/2;break;case RichMarkerPosition.RIGHT:t.width=-r,t.height=-i/2;break;case RichMarkerPosition.BOTTOM_LEFT:t.height=-i;break;case RichMarkerPosition.BOTTOM:t.width=-r/2,t.height=-i;break;case RichMarkerPosition.BOTTOM_RIGHT:t.width=-r,t.height=-i}return t},RichMarker.prototype.onAdd=function(){if(this.markerWrapper_||(this.markerWrapper_=document.createElement("DIV"),this.markerWrapper_.style.position="absolute"),this.getZIndex()&&(this.markerWrapper_.style.zIndex=this.getZIndex()),this.markerWrapper_.style.display=this.getVisible()?"":"none",!this.markerContent_){this.markerContent_=document.createElement("DIV"),this.markerWrapper_.appendChild(this.markerContent_);var e=this;google.maps.event.addDomListener(this.markerContent_,"click",function(t){google.maps.event.trigger(e,"click")}),google.maps.event.addDomListener(this.markerContent_,"mouseover",function(t){google.maps.event.trigger(e,"mouseover")}),google.maps.event.addDomListener(this.markerContent_,"mouseout",function(t){google.maps.event.trigger(e,"mouseout")})}this.ready_=!0,this.content_changed(),this.flat_changed(),this.draggable_changed();var t=this.getPanes();t&&t.overlayMouseTarget.appendChild(this.markerWrapper_),google.maps.event.trigger(this,"ready")},RichMarker.prototype.onAdd=RichMarker.prototype.onAdd,RichMarker.prototype.draw=function(){if(this.ready_&&!this.dragging_){var e=this.getProjection();if(e){var t=this.get("position"),r=e.fromLatLngToDivPixel(t),i=this.getOffset_();this.markerWrapper_.style.top=r.y+i.height+"px",this.markerWrapper_.style.left=r.x+i.width+"px";var o=this.markerContent_.offsetHeight,a=this.markerContent_.offsetWidth;a!=this.get("width")&&this.set("width",a),o!=this.get("height")&&this.set("height",o)}}},RichMarker.prototype.draw=RichMarker.prototype.draw,RichMarker.prototype.onRemove=function(){this.markerWrapper_&&this.markerWrapper_.parentNode&&this.markerWrapper_.parentNode.removeChild(this.markerWrapper_),this.removeDragListeners_()},RichMarker.prototype.onRemove=RichMarker.prototype.onRemove;var RichMarkerPosition={TOP_LEFT:1,TOP:2,TOP_RIGHT:3,LEFT:4,MIDDLE:5,RIGHT:6,BOTTOM_LEFT:7,BOTTOM:8,BOTTOM_RIGHT:9};window.RichMarkerPosition=RichMarkerPosition;;!function(a){function b(b,c,d){var f=this;f.id=d,f.options=c,f.status={animated:!1,rendered:!1,disabled:!1,focused:!1},f.elements={target:b.addClass(f.options.style.classes.target),tooltip:null,wrapper:null,content:null,contentWrapper:null,title:null,button:null,tip:null,bgiframe:null},f.cache={mouse:{},position:{},toggle:0},f.timers={},a.extend(f,f.options.api,{show:function(b){function c(){"static"!==f.options.position.type&&f.focus(),f.onShow.call(f,b),a.browser.msie&&f.elements.tooltip.get(0).style.removeAttribute("filter")}var d,e;if(!f.status.rendered)return a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.TOOLTIP_NOT_RENDERED,"show");if("none"!==f.elements.tooltip.css("display"))return f;if(f.elements.tooltip.stop(!0,!1),d=f.beforeShow.call(f,b),d===!1)return f;if(f.cache.toggle=1,"static"!==f.options.position.type&&f.updatePosition(b,f.options.show.effect.length>0),"object"==typeof f.options.show.solo?e=a(f.options.show.solo):f.options.show.solo===!0&&(e=a("div.qtip").not(f.elements.tooltip)),e&&e.each(function(){a(this).qtip("api").status.rendered===!0&&a(this).qtip("api").hide()}),"function"==typeof f.options.show.effect.type)f.options.show.effect.type.call(f.elements.tooltip,f.options.show.effect.length),f.elements.tooltip.queue(function(){c(),a(this).dequeue()});else{switch(f.options.show.effect.type.toLowerCase()){case"fade":f.elements.tooltip.fadeIn(f.options.show.effect.length,c);break;case"slide":f.elements.tooltip.slideDown(f.options.show.effect.length,function(){c(),"static"!==f.options.position.type&&f.updatePosition(b,!0)});break;case"grow":f.elements.tooltip.show(f.options.show.effect.length,c);break;default:f.elements.tooltip.show(null,c)}f.elements.tooltip.addClass(f.options.style.classes.active)}return a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.EVENT_SHOWN,"show")},hide:function(b){function c(){f.onHide.call(f,b)}var d;if(!f.status.rendered)return a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.TOOLTIP_NOT_RENDERED,"hide");if("none"===f.elements.tooltip.css("display"))return f;if(clearTimeout(f.timers.show),f.elements.tooltip.stop(!0,!1),d=f.beforeHide.call(f,b),d===!1)return f;if(f.cache.toggle=0,"function"==typeof f.options.hide.effect.type)f.options.hide.effect.type.call(f.elements.tooltip,f.options.hide.effect.length),f.elements.tooltip.queue(function(){c(),a(this).dequeue()});else{switch(f.options.hide.effect.type.toLowerCase()){case"fade":f.elements.tooltip.fadeOut(f.options.hide.effect.length,c);break;case"slide":f.elements.tooltip.slideUp(f.options.hide.effect.length,c);break;case"grow":f.elements.tooltip.hide(f.options.hide.effect.length,c);break;default:f.elements.tooltip.hide(null,c)}f.elements.tooltip.removeClass(f.options.style.classes.active)}return a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.EVENT_HIDDEN,"hide")},updatePosition:function(b,c){var d,e,g,h,i,j,k,m,n,o,p,q,s;if(!f.status.rendered)return a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.TOOLTIP_NOT_RENDERED,"updatePosition");if("static"==f.options.position.type)return a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.CANNOT_POSITION_STATIC,"updatePosition");if(e={position:{left:0,top:0},dimensions:{height:0,width:0},corner:f.options.position.corner.target},g={position:f.getPosition(),dimensions:f.getDimensions(),corner:f.options.position.corner.tooltip},"mouse"!==f.options.position.target){if("area"==f.options.position.target.get(0).nodeName.toLowerCase()){for(h=f.options.position.target.attr("coords").split(","),d=0;d<h.length;d++)h[d]=parseInt(h[d]);switch(i=f.options.position.target.parent("map").attr("name"),j=a('img[usemap="#'+i+'"]:first').offset(),e.position={left:Math.floor(j.left+h[0]),top:Math.floor(j.top+h[1])},f.options.position.target.attr("shape").toLowerCase()){case"rect":e.dimensions={width:Math.ceil(Math.abs(h[2]-h[0])),height:Math.ceil(Math.abs(h[3]-h[1]))};break;case"circle":e.dimensions={width:h[2]+1,height:h[2]+1};break;case"poly":for(e.dimensions={width:h[0],height:h[1]},d=0;d<h.length;d++)d%2==0?(h[d]>e.dimensions.width&&(e.dimensions.width=h[d]),h[d]<h[0]&&(e.position.left=Math.floor(j.left+h[d]))):(h[d]>e.dimensions.height&&(e.dimensions.height=h[d]),h[d]<h[1]&&(e.position.top=Math.floor(j.top+h[d])));e.dimensions.width=e.dimensions.width-(e.position.left-j.left),e.dimensions.height=e.dimensions.height-(e.position.top-j.top);break;default:return a.fn.qtip.log.error.call(f,4,a.fn.qtip.constants.INVALID_AREA_SHAPE,"updatePosition")}e.dimensions.width-=2,e.dimensions.height-=2}else 1===f.options.position.target.add(document.body).length?(e.position={left:a(document).scrollLeft(),top:a(document).scrollTop()},e.dimensions={height:a(window).height(),width:a(window).width()}):("undefined"!=typeof f.options.position.target.attr("qtip")?e.position=f.options.position.target.qtip("api").cache.position:e.position=f.options.position.target.offset(),e.dimensions={height:f.options.position.target.outerHeight(),width:f.options.position.target.outerWidth()});k=a.extend({},e.position),-1!==e.corner.search(/right/i)&&(k.left+=e.dimensions.width),-1!==e.corner.search(/bottom/i)&&(k.top+=e.dimensions.height),-1!==e.corner.search(/((top|bottom)Middle)|center/)&&(k.left+=e.dimensions.width/2),-1!==e.corner.search(/((left|right)Middle)|center/)&&(k.top+=e.dimensions.height/2)}else e.position=k={left:f.cache.mouse.x,top:f.cache.mouse.y},e.dimensions={height:1,width:1};if(-1!==g.corner.search(/right/i)&&(k.left-=g.dimensions.width),-1!==g.corner.search(/bottom/i)&&(k.top-=g.dimensions.height),-1!==g.corner.search(/((top|bottom)Middle)|center/)&&(k.left-=g.dimensions.width/2),-1!==g.corner.search(/((left|right)Middle)|center/)&&(k.top-=g.dimensions.height/2),m=a.browser.msie?1:0,n=a.browser.msie&&6===parseInt(a.browser.version.charAt(0))?1:0,f.options.style.border.radius>0&&(-1!==g.corner.search(/Left/)?k.left-=f.options.style.border.radius:-1!==g.corner.search(/Right/)&&(k.left+=f.options.style.border.radius),-1!==g.corner.search(/Top/)?k.top-=f.options.style.border.radius:-1!==g.corner.search(/Bottom/)&&(k.top+=f.options.style.border.radius)),m&&(-1!==g.corner.search(/top/)?k.top-=m:-1!==g.corner.search(/bottom/)&&(k.top+=m),-1!==g.corner.search(/left/)?k.left-=m:-1!==g.corner.search(/right/)&&(k.left+=m),-1!==g.corner.search(/leftMiddle|rightMiddle/)&&(k.top-=1)),f.options.position.adjust.screen===!0&&(k=l.call(f,k,e,g)),"mouse"===f.options.position.target&&f.options.position.adjust.mouse===!0&&(o=f.options.position.adjust.screen===!0&&f.elements.tip?f.elements.tip.attr("rel"):f.options.position.corner.tooltip,k.left+=-1!==o.search(/right/i)?-6:6,k.top+=-1!==o.search(/bottom/i)?-6:6),!f.elements.bgiframe&&a.browser.msie&&6==parseInt(a.browser.version.charAt(0))&&a("select, object").each(function(){p=a(this).offset(),p.bottom=p.top+a(this).height(),p.right=p.left+a(this).width(),k.top+g.dimensions.height>=p.top&&k.left+g.dimensions.width>=p.left&&r.call(f)}),k.left+=f.options.position.adjust.x,k.top+=f.options.position.adjust.y,q=f.getPosition(),k.left!=q.left||k.top!=q.top){if(s=f.beforePositionUpdate.call(f,b),s===!1)return f;f.cache.position=k,c===!0?(f.status.animated=!0,f.elements.tooltip.animate(k,200,"swing",function(){f.status.animated=!1})):f.elements.tooltip.css(k),f.onPositionUpdate.call(f,b),"undefined"!=typeof b&&b.type&&"mousemove"!==b.type&&a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.EVENT_POSITION_UPDATED,"updatePosition")}return f},updateWidth:function(b){var c;return f.status.rendered?b&&"number"!=typeof b?a.fn.qtip.log.error.call(f,2,"newWidth must be of type number","updateWidth"):(c=f.elements.contentWrapper.siblings().add(f.elements.tip).add(f.elements.button),b||("number"==typeof f.options.style.width.value?b=f.options.style.width.value:(f.elements.tooltip.css({width:"auto"}),c.hide(),a.browser.msie&&f.elements.wrapper.add(f.elements.contentWrapper.children()).css({zoom:"normal"}),b=f.getDimensions().width+1,f.options.style.width.value||(b>f.options.style.width.max&&(b=f.options.style.width.max),b<f.options.style.width.min&&(b=f.options.style.width.min)))),b%2!==0&&(b-=1),f.elements.tooltip.width(b),c.show(),f.options.style.border.radius&&f.elements.tooltip.find(".qtip-betweenCorners").each(function(c){a(this).width(b-2*f.options.style.border.radius)}),a.browser.msie&&(f.elements.wrapper.add(f.elements.contentWrapper.children()).css({zoom:"1"}),f.elements.wrapper.width(b),f.elements.bgiframe&&f.elements.bgiframe.width(b).height(f.getDimensions.height)),a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.EVENT_WIDTH_UPDATED,"updateWidth")):a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.TOOLTIP_NOT_RENDERED,"updateWidth")},updateStyle:function(b){var c,d,h,i,j;return f.status.rendered?"string"==typeof b&&a.fn.qtip.styles[b]?(f.options.style=o.call(f,a.fn.qtip.styles[b],f.options.user.style),f.elements.content.css(m(f.options.style)),f.options.content.title.text!==!1&&f.elements.title.css(m(f.options.style.title,!0)),f.elements.contentWrapper.css({borderColor:f.options.style.border.color}),f.options.style.tip.corner!==!1&&(a("<canvas>").get(0).getContext?(c=f.elements.tooltip.find(".qtip-tip canvas:first"),h=c.get(0).getContext("2d"),h.clearRect(0,0,300,300),i=c.parent("div[rel]:first").attr("rel"),j=p(i,f.options.style.tip.size.width,f.options.style.tip.size.height),g.call(f,c,j,f.options.style.tip.color||f.options.style.border.color)):a.browser.msie&&(c=f.elements.tooltip.find('.qtip-tip [nodeName="shape"]'),c.attr("fillcolor",f.options.style.tip.color||f.options.style.border.color))),f.options.style.border.radius>0&&(f.elements.tooltip.find(".qtip-betweenCorners").css({backgroundColor:f.options.style.border.color}),a("<canvas>").get(0).getContext?(d=q(f.options.style.border.radius),f.elements.tooltip.find(".qtip-wrapper canvas").each(function(){h=a(this).get(0).getContext("2d"),h.clearRect(0,0,300,300),i=a(this).parent("div[rel]:first").attr("rel"),e.call(f,a(this),d[i],f.options.style.border.radius,f.options.style.border.color)})):a.browser.msie&&f.elements.tooltip.find('.qtip-wrapper [nodeName="arc"]').each(function(){a(this).attr("fillcolor",f.options.style.border.color)})),a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.EVENT_STYLE_UPDATED,"updateStyle")):a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.STYLE_NOT_DEFINED,"updateStyle"):a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.TOOLTIP_NOT_RENDERED,"updateStyle")},updateContent:function(b,c){function d(){f.updateWidth(),c!==!1&&("static"!==f.options.position.type&&f.updatePosition(f.elements.tooltip.is(":visible"),!0),f.options.style.tip.corner!==!1&&h.call(f))}var e,g,i;if(!f.status.rendered)return a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.TOOLTIP_NOT_RENDERED,"updateContent");if(!b)return a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.NO_CONTENT_PROVIDED,"updateContent");if(e=f.beforeContentUpdate.call(f,b),"string"==typeof e)b=e;else if(e===!1)return;return a.browser.msie&&f.elements.contentWrapper.children().css({zoom:"normal"}),b.jquery&&b.length>0?b.clone(!0).appendTo(f.elements.content).show():f.elements.content.html(b),g=f.elements.content.find("img[complete=false]"),g.length>0?(i=0,g.each(function(b){a('<img src="'+a(this).attr("src")+'" />').load(function(){++i==g.length&&d()})})):d(),f.onContentUpdate.call(f),a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.EVENT_CONTENT_UPDATED,"loadContent")},loadContent:function(b,c,d){function e(b){f.onContentLoad.call(f),a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.EVENT_CONTENT_LOADED,"loadContent"),f.updateContent(b)}var g;return f.status.rendered?(g=f.beforeContentLoad.call(f),g===!1?f:("post"==d?a.post(b,c,e):a.get(b,c,e),f)):a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.TOOLTIP_NOT_RENDERED,"loadContent")},updateTitle:function(b){return f.status.rendered?b?(returned=f.beforeTitleUpdate.call(f),returned===!1?f:(f.elements.button&&(f.elements.button=f.elements.button.clone(!0)),f.elements.title.html(b),f.elements.button&&f.elements.title.prepend(f.elements.button),f.onTitleUpdate.call(f),a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.EVENT_TITLE_UPDATED,"updateTitle"))):a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.NO_CONTENT_PROVIDED,"updateTitle"):a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.TOOLTIP_NOT_RENDERED,"updateTitle")},focus:function(b){var c,d,e,g;if(!f.status.rendered)return a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.TOOLTIP_NOT_RENDERED,"focus");if("static"==f.options.position.type)return a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.CANNOT_FOCUS_STATIC,"focus");if(c=parseInt(f.elements.tooltip.css("z-index")),d=6e3+a("div.qtip[qtip]").length-1,!f.status.focused&&c!==d){if(g=f.beforeFocus.call(f,b),g===!1)return f;a("div.qtip[qtip]").not(f.elements.tooltip).each(function(){a(this).qtip("api").status.rendered===!0&&(e=parseInt(a(this).css("z-index")),"number"==typeof e&&e>-1&&a(this).css({zIndex:parseInt(a(this).css("z-index"))-1}),a(this).qtip("api").status.focused=!1)}),f.elements.tooltip.css({zIndex:d}),f.status.focused=!0,f.onFocus.call(f,b),a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.EVENT_FOCUSED,"focus")}return f},disable:function(b){return f.status.rendered?(b?f.status.disabled?a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.TOOLTIP_ALREADY_DISABLED,"disable"):(f.status.disabled=!0,a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.EVENT_DISABLED,"disable")):f.status.disabled?(f.status.disabled=!1,a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.EVENT_ENABLED,"disable")):a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.TOOLTIP_ALREADY_ENABLED,"disable"),f):a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.TOOLTIP_NOT_RENDERED,"disable")},destroy:function(){var b,c,d;if(c=f.beforeDestroy.call(f),c===!1)return f;if(f.status.rendered?(f.options.show.when.target.unbind("mousemove.qtip",f.updatePosition),f.options.show.when.target.unbind("mouseout.qtip",f.hide),f.options.show.when.target.unbind(f.options.show.when.event+".qtip"),f.options.hide.when.target.unbind(f.options.hide.when.event+".qtip"),f.elements.tooltip.unbind(f.options.hide.when.event+".qtip"),f.elements.tooltip.unbind("mouseover.qtip",f.focus),f.elements.tooltip.remove()):f.options.show.when.target.unbind(f.options.show.when.event+".qtip-create"),"object"==typeof f.elements.target.data("qtip")&&(d=f.elements.target.data("qtip").interfaces,"object"==typeof d&&d.length>0))for(b=0;b<d.length-1;b++)d[b].id==f.id&&d.splice(b,1);return delete a.fn.qtip.interfaces[f.id],"object"==typeof d&&d.length>0?f.elements.target.data("qtip").current=d.length-1:f.elements.target.removeData("qtip"),f.onDestroy.call(f),a.fn.qtip.log.error.call(f,1,a.fn.qtip.constants.EVENT_DESTROYED,"destroy"),f.elements.target},getPosition:function(){var b,c;return f.status.rendered?(b="none"!==f.elements.tooltip.css("display")?!1:!0,b&&f.elements.tooltip.css({visiblity:"hidden"}).show(),c=f.elements.tooltip.offset(),b&&f.elements.tooltip.css({visiblity:"visible"}).hide(),c):a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.TOOLTIP_NOT_RENDERED,"getPosition")},getDimensions:function(){var b,c;return f.status.rendered?(b=f.elements.tooltip.is(":visible")?!1:!0,b&&f.elements.tooltip.css({visiblity:"hidden"}).show(),c={height:f.elements.tooltip.outerHeight(),width:f.elements.tooltip.outerWidth()},b&&f.elements.tooltip.css({visiblity:"visible"}).hide(),c):a.fn.qtip.log.error.call(f,2,a.fn.qtip.constants.TOOLTIP_NOT_RENDERED,"getDimensions")}})}function c(){var b,c,e,g,h;b=this,b.beforeRender.call(b),b.status.rendered=!0,b.elements.tooltip='<div qtip="'+b.id+'" class="qtip '+(b.options.style.classes.tooltip||b.options.style)+'"style="display:none; -moz-border-radius:0; -webkit-border-radius:0; border-radius:0;position:'+b.options.position.type+';">  <div class="qtip-wrapper" style="position:relative; overflow:hidden; text-align:left;">    <div class="qtip-contentWrapper" style="overflow:hidden;">       <div class="qtip-content '+b.options.style.classes.content+'"></div></div></div></div>',b.elements.tooltip=a(b.elements.tooltip),b.elements.tooltip.appendTo(b.options.position.container),b.elements.tooltip.data("qtip",{current:0,interfaces:[b]}),b.elements.wrapper=b.elements.tooltip.children("div:first"),b.elements.contentWrapper=b.elements.wrapper.children("div:first").css({background:b.options.style.background}),b.elements.content=b.elements.contentWrapper.children("div:first").css(m(b.options.style)),a.browser.msie&&b.elements.wrapper.add(b.elements.content).css({zoom:1}),"unfocus"==b.options.hide.when.event&&b.elements.tooltip.attr("unfocus",!0),"number"==typeof b.options.style.width.value&&b.updateWidth(),a("<canvas>").get(0).getContext||a.browser.msie?(b.options.style.border.radius>0?d.call(b):b.elements.contentWrapper.css({border:b.options.style.border.width+"px solid "+b.options.style.border.color}),b.options.style.tip.corner!==!1&&f.call(b)):(b.elements.contentWrapper.css({border:b.options.style.border.width+"px solid "+b.options.style.border.color}),b.options.style.border.radius=0,b.options.style.tip.corner=!1,a.fn.qtip.log.error.call(b,2,a.fn.qtip.constants.CANVAS_VML_NOT_SUPPORTED,"render")),"string"==typeof b.options.content.text&&b.options.content.text.length>0||b.options.content.text.jquery&&b.options.content.text.length>0?c=b.options.content.text:"string"==typeof b.elements.target.attr("title")&&b.elements.target.attr("title").length>0?(c=b.elements.target.attr("title").replace("\\n","<br />"),b.elements.target.attr("title","")):"string"==typeof b.elements.target.attr("alt")&&b.elements.target.attr("alt").length>0?(c=b.elements.target.attr("alt").replace("\\n","<br />"),b.elements.target.attr("alt","")):(c=" ",a.fn.qtip.log.error.call(b,1,a.fn.qtip.constants.NO_VALID_CONTENT,"render")),b.options.content.title.text!==!1&&j.call(b),b.updateContent(c),k.call(b),b.options.show.ready===!0&&b.show(),b.options.content.url!==!1&&(e=b.options.content.url,g=b.options.content.data,h=b.options.content.method||"get",b.loadContent(e,g,h)),b.onRender.call(b),a.fn.qtip.log.error.call(b,1,a.fn.qtip.constants.EVENT_RENDERED,"render")}function d(){var b,c,d,f,g,h,i,j,k,l,m,n,o,p,r;b=this,b.elements.wrapper.find(".qtip-borderBottom, .qtip-borderTop").remove(),d=b.options.style.border.width,f=b.options.style.border.radius,g=b.options.style.border.color||b.options.style.tip.color,h=q(f),i={};for(c in h)i[c]='<div rel="'+c+'" style="'+(-1!==c.search(/Left/)?"left":"right")+":0; position:absolute; height:"+f+"px; width:"+f+'px; overflow:hidden; line-height:0.1px; font-size:1px">',a("<canvas>").get(0).getContext?i[c]+='<canvas height="'+f+'" width="'+f+'" style="vertical-align: top"></canvas>':a.browser.msie&&(j=2*f+3,i[c]+='<v:arc stroked="false" fillcolor="'+g+'" startangle="'+h[c][0]+'" endangle="'+h[c][1]+'" style="width:'+j+"px; height:"+j+"px; margin-top:"+(-1!==c.search(/bottom/)?-2:-1)+"px; margin-left:"+(-1!==c.search(/Right/)?h[c][2]-3.5:-1)+'px; vertical-align:top; display:inline-block; behavior:url(#default#VML)"></v:arc>'),i[c]+="</div>";k=b.getDimensions().width-2*Math.max(d,f),l='<div class="qtip-betweenCorners" style="height:'+f+"px; width:"+k+"px; overflow:hidden; background-color:"+g+'; line-height:0.1px; font-size:1px;">',m='<div class="qtip-borderTop" dir="ltr" style="height:'+f+"px; margin-left:"+f+'px; line-height:0.1px; font-size:1px; padding:0;">'+i.topLeft+i.topRight+l,b.elements.wrapper.prepend(m),n='<div class="qtip-borderBottom" dir="ltr" style="height:'+f+"px; margin-left:"+f+'px; line-height:0.1px; font-size:1px; padding:0;">'+i.bottomLeft+i.bottomRight+l,b.elements.wrapper.append(n),a("<canvas>").get(0).getContext?b.elements.wrapper.find("canvas").each(function(){o=h[a(this).parent("[rel]:first").attr("rel")],e.call(b,a(this),o,f,g)}):a.browser.msie&&b.elements.tooltip.append('<v:image style="behavior:url(#default#VML);"></v:image>'),p=Math.max(f,f+(d-f)),r=Math.max(d-f,0),b.elements.contentWrapper.css({border:"0px solid "+g,borderWidth:r+"px "+p+"px"})}function e(a,b,c,d){var e=a.get(0).getContext("2d");e.fillStyle=d,e.beginPath(),e.arc(b[0],b[1],c,0,2*Math.PI,!1),e.fill()}function f(b){var c,d,e,f,i;c=this,null!==c.elements.tip&&c.elements.tip.remove(),d=c.options.style.tip.color||c.options.style.border.color,c.options.style.tip.corner!==!1&&(b||(b=c.options.style.tip.corner),e=p(b,c.options.style.tip.size.width,c.options.style.tip.size.height),c.elements.tip='<div class="'+c.options.style.classes.tip+'" dir="ltr" rel="'+b+'" style="position:absolute; height:'+c.options.style.tip.size.height+"px; width:"+c.options.style.tip.size.width+'px; margin:0 auto; line-height:0.1px; font-size:1px;">',a("<canvas>").get(0).getContext?c.elements.tip+='<canvas height="'+c.options.style.tip.size.height+'" width="'+c.options.style.tip.size.width+'"></canvas>':a.browser.msie&&(f=c.options.style.tip.size.width+","+c.options.style.tip.size.height,i="m"+e[0][0]+","+e[0][1],i+=" l"+e[1][0]+","+e[1][1],i+=" "+e[2][0]+","+e[2][1],i+=" xe",c.elements.tip+='<v:shape fillcolor="'+d+'" stroked="false" filled="true" path="'+i+'" coordsize="'+f+'" style="width:'+c.options.style.tip.size.width+"px; height:"+c.options.style.tip.size.height+"px; line-height:0.1px; display:inline-block; behavior:url(#default#VML); vertical-align:"+(-1!==b.search(/top/)?"bottom":"top")+'"></v:shape>',c.elements.tip+='<v:image style="behavior:url(#default#VML);"></v:image>',c.elements.contentWrapper.css("position","relative")),c.elements.tooltip.prepend(c.elements.tip+"</div>"),c.elements.tip=c.elements.tooltip.find("."+c.options.style.classes.tip).eq(0),a("<canvas>").get(0).getContext&&g.call(c,c.elements.tip.find("canvas:first"),e,d),-1!==b.search(/top/)&&a.browser.msie&&6===parseInt(a.browser.version.charAt(0))&&c.elements.tip.css({marginTop:-4}),h.call(c,b))}function g(a,b,c){var d=a.get(0).getContext("2d");d.fillStyle=c,d.beginPath(),d.moveTo(b[0][0],b[0][1]),d.lineTo(b[1][0],b[1][1]),d.lineTo(b[2][0],b[2][1]),d.fill()}function h(b){var c,d,e,f,g;c=this,c.options.style.tip.corner!==!1&&c.elements.tip&&(b||(b=c.elements.tip.attr("rel")),d=positionAdjust=a.browser.msie?1:0,c.elements.tip.css(b.match(/left|right|top|bottom/)[0],0),-1!==b.search(/top|bottom/)?(a.browser.msie&&(6===parseInt(a.browser.version.charAt(0))?positionAdjust=-1!==b.search(/top/)?-3:1:positionAdjust=-1!==b.search(/top/)?1:2),-1!==b.search(/Middle/)?c.elements.tip.css({left:"50%",marginLeft:-(c.options.style.tip.size.width/2)}):-1!==b.search(/Left/)?c.elements.tip.css({left:c.options.style.border.radius-d}):-1!==b.search(/Right/)&&c.elements.tip.css({right:c.options.style.border.radius+d}),-1!==b.search(/top/)?c.elements.tip.css({top:-positionAdjust}):c.elements.tip.css({bottom:positionAdjust})):-1!==b.search(/left|right/)&&(a.browser.msie&&(positionAdjust=6===parseInt(a.browser.version.charAt(0))?1:-1!==b.search(/left/)?1:2),-1!==b.search(/Middle/)?c.elements.tip.css({top:"50%",marginTop:-(c.options.style.tip.size.height/2)}):-1!==b.search(/Top/)?c.elements.tip.css({top:c.options.style.border.radius-d}):-1!==b.search(/Bottom/)&&c.elements.tip.css({bottom:c.options.style.border.radius+d}),-1!==b.search(/left/)?c.elements.tip.css({left:-positionAdjust}):c.elements.tip.css({right:positionAdjust})),e="padding-"+b.match(/left|right|top|bottom/)[0],f=c.options.style.tip.size[-1!==e.search(/left|right/)?"width":"height"],c.elements.tooltip.css("padding",0),c.elements.tooltip.css(e,f),a.browser.msie&&6==parseInt(a.browser.version.charAt(0))&&(g=parseInt(c.elements.tip.css("margin-top"))||0,g+=parseInt(c.elements.content.css("margin-top"))||0,c.elements.tip.css({marginTop:g})))}function j(){var b=this;null!==b.elements.title&&b.elements.title.remove(),b.elements.title=a('<div class="'+b.options.style.classes.title+'">').css(m(b.options.style.title,!0)).css({zoom:a.browser.msie?1:0}).prependTo(b.elements.contentWrapper),b.options.content.title.text&&b.updateTitle.call(b,b.options.content.title.text),b.options.content.title.button!==!1&&"string"==typeof b.options.content.title.button&&(b.elements.button=a('<a class="'+b.options.style.classes.button+'" style="float:right; position: relative"></a>').css(m(b.options.style.button,!0)).html(b.options.content.title.button).prependTo(b.elements.title).click(function(a){b.status.disabled||b.hide(a)}))}function k(){function b(b){e.status.disabled!==!0&&(clearTimeout(e.timers.inactive),e.timers.inactive=setTimeout(function(){a(h).each(function(){g.unbind(this+".qtip-inactive"),e.elements.content.unbind(this+".qtip-inactive")}),e.hide(b)},e.options.hide.delay))}function c(c){e.status.disabled!==!0&&("inactive"==e.options.hide.when.event&&(a(h).each(function(){g.bind(this+".qtip-inactive",b),e.elements.content.bind(this+".qtip-inactive",b)}),b()),clearTimeout(e.timers.show),clearTimeout(e.timers.hide),e.timers.show=setTimeout(function(){e.show(c)},e.options.show.delay))}function d(b){if(e.status.disabled!==!0){if(e.options.hide.fixed===!0&&-1!==e.options.hide.when.event.search(/mouse(out|leave)/i)&&a(b.relatedTarget).parents("div.qtip[qtip]").length>0)return b.stopPropagation(),b.preventDefault(),clearTimeout(e.timers.hide),!1;clearTimeout(e.timers.show),clearTimeout(e.timers.hide),e.elements.tooltip.stop(!0,!0),e.timers.hide=setTimeout(function(){e.hide(b)},e.options.hide.delay)}}var e,f,g,h;e=this,f=e.options.show.when.target,g=e.options.hide.when.target,e.options.hide.fixed&&(g=g.add(e.elements.tooltip)),"inactive"==e.options.hide.when.event?h=["click","dblclick","mousedown","mouseup","mousemove","mouseout","mouseenter","mouseleave","mouseover"]:e.options.hide.fixed===!0&&e.elements.tooltip.bind("mouseover.qtip",function(){e.status.disabled!==!0&&clearTimeout(e.timers.hide)}),1===e.options.show.when.target.add(e.options.hide.when.target).length&&e.options.show.when.event==e.options.hide.when.event&&"inactive"!==e.options.hide.when.event||"unfocus"==e.options.hide.when.event?(e.cache.toggle=0,f.bind(e.options.show.when.event+".qtip",function(a){0==e.cache.toggle?c(a):d(a)})):(f.bind(e.options.show.when.event+".qtip",c),"inactive"!==e.options.hide.when.event&&g.bind(e.options.hide.when.event+".qtip",d)),-1!==e.options.position.type.search(/(fixed|absolute)/)&&e.elements.tooltip.bind("mouseover.qtip",e.focus),"mouse"===e.options.position.target&&"static"!==e.options.position.type&&f.bind("mousemove.qtip",function(a){e.cache.mouse={x:a.pageX,y:a.pageY},e.status.disabled===!1&&e.options.position.adjust.mouse===!0&&"static"!==e.options.position.type&&"none"!==e.elements.tooltip.css("display")&&e.updatePosition(a)})}function l(b,c,d){var e,g,h,i,j;return e=this,"center"==d.corner?c.position:(g=a.extend({},b),i={x:!1,y:!1},j={left:g.left<a.fn.qtip.cache.screen.scroll.left,right:g.left+d.dimensions.width+2>=a.fn.qtip.cache.screen.width+a.fn.qtip.cache.screen.scroll.left,top:g.top<a.fn.qtip.cache.screen.scroll.top,bottom:g.top+d.dimensions.height+2>=a.fn.qtip.cache.screen.height+a.fn.qtip.cache.screen.scroll.top},h={left:j.left&&(-1!=d.corner.search(/right/i)||-1==d.corner.search(/right/i)&&!j.right),right:j.right&&(-1!=d.corner.search(/left/i)||-1==d.corner.search(/left/i)&&!j.left),top:j.top&&-1==d.corner.search(/top/i),bottom:j.bottom&&-1==d.corner.search(/bottom/i)},h.left?("mouse"!==e.options.position.target?g.left=c.position.left+c.dimensions.width:g.left=e.cache.mouse.x,i.x="Left"):h.right&&("mouse"!==e.options.position.target?g.left=c.position.left-d.dimensions.width:g.left=e.cache.mouse.x-d.dimensions.width,i.x="Right"),h.top?("mouse"!==e.options.position.target?g.top=c.position.top+c.dimensions.height:g.top=e.cache.mouse.y,i.y="top"):h.bottom&&("mouse"!==e.options.position.target?g.top=c.position.top-d.dimensions.height:g.top=e.cache.mouse.y-d.dimensions.height,i.y="bottom"),g.left<0&&(g.left=b.left,i.x=!1),g.top<0&&(g.top=b.top,i.y=!1),e.options.style.tip.corner!==!1&&(g.corner=new String(d.corner),i.x!==!1&&(g.corner=g.corner.replace(/Left|Right|Middle/,i.x)),i.y!==!1&&(g.corner=g.corner.replace(/top|bottom/,i.y)),g.corner!==e.elements.tip.attr("rel")&&f.call(e,g.corner)),g)}function m(b,c){var d,e;d=a.extend(!0,{},b);for(e in d)c===!0&&-1!==e.search(/(tip|classes)/i)?delete d[e]:c||-1===e.search(/(width|border|tip|title|classes|user)/i)||delete d[e];return d}function n(a){return"object"!=typeof a.tip&&(a.tip={corner:a.tip}),"object"!=typeof a.tip.size&&(a.tip.size={width:a.tip.size,height:a.tip.size}),"object"!=typeof a.border&&(a.border={width:a.border}),"object"!=typeof a.width&&(a.width={value:a.width}),"string"==typeof a.width.max&&(a.width.max=parseInt(a.width.max.replace(/([0-9]+)/i,"$1"))),"string"==typeof a.width.min&&(a.width.min=parseInt(a.width.min.replace(/([0-9]+)/i,"$1"))),"number"==typeof a.tip.size.x&&(a.tip.size.width=a.tip.size.x,delete a.tip.size.x),"number"==typeof a.tip.size.y&&(a.tip.size.height=a.tip.size.y,delete a.tip.size.y),a}function o(){var b,c,d,e,f,g;for(b=this,d=[!0,{}],c=0;c<arguments.length;c++)d.push(arguments[c]);for(e=[a.extend.apply(a,d)];"string"==typeof e[0].name;)e.unshift(n(a.fn.qtip.styles[e[0].name]));return e.unshift(!0,{classes:{tooltip:"qtip-"+(arguments[0].name||"defaults")}},a.fn.qtip.styles.defaults),f=a.extend.apply(a,e),g=a.browser.msie?1:0,f.tip.size.width+=g,f.tip.size.height+=g,f.tip.size.width%2>0&&(f.tip.size.width+=1),f.tip.size.height%2>0&&(f.tip.size.height+=1),f.tip.corner===!0&&(f.tip.corner="center"===b.options.position.corner.tooltip?!1:b.options.position.corner.tooltip),f}function p(a,b,c){var d={bottomRight:[[0,0],[b,c],[b,0]],bottomLeft:[[0,0],[b,0],[0,c]],topRight:[[0,c],[b,0],[b,c]],topLeft:[[0,0],[0,c],[b,c]],topMiddle:[[0,c],[b/2,0],[b,c]],bottomMiddle:[[0,0],[b,0],[b/2,c]],rightMiddle:[[0,0],[b,c/2],[0,c]],leftMiddle:[[b,0],[b,c],[0,c/2]]};return d.leftTop=d.bottomRight,d.rightTop=d.bottomLeft,d.leftBottom=d.topRight,d.rightBottom=d.topLeft,d[a]}function q(b){var c;return a("<canvas>").get(0).getContext?c={topLeft:[b,b],topRight:[0,b],bottomLeft:[b,0],bottomRight:[0,0]}:a.browser.msie&&(c={topLeft:[-90,90,0],topRight:[-90,90,-b],bottomLeft:[90,270,0],bottomRight:[90,270,-b]}),c}function r(){var a,b,c;a=this,c=a.getDimensions(),b='<iframe class="qtip-bgiframe" frameborder="0" tabindex="-1" src="javascript:false" style="display:block; position:absolute; z-index:-1; filter:alpha(opacity=\'0\'); border: 1px solid red; height:'+c.height+"px; width:"+c.width+'px" />',a.elements.bgiframe=a.elements.wrapper.prepend(b).children(".qtip-bgiframe:first")}a.fn.qtip=function(d,e){var f,g,h,i,j,k,l,m;if("string"==typeof d){if("object"!=typeof a(this).data("qtip")&&a.fn.qtip.log.error.call(self,1,a.fn.qtip.constants.NO_TOOLTIP_PRESENT,!1),"api"==d)return a(this).data("qtip").interfaces[a(this).data("qtip").current];if("interfaces"==d)return a(this).data("qtip").interfaces}else d||(d={}),("object"!=typeof d.content||d.content.jquery&&d.content.length>0)&&(d.content={text:d.content}),"object"!=typeof d.content.title&&(d.content.title={text:d.content.title}),"object"!=typeof d.position&&(d.position={corner:d.position}),"object"!=typeof d.position.corner&&(d.position.corner={target:d.position.corner,tooltip:d.position.corner}),"object"!=typeof d.show&&(d.show={when:d.show}),"object"!=typeof d.show.when&&(d.show.when={event:d.show.when}),"object"!=typeof d.show.effect&&(d.show.effect={type:d.show.effect}),"object"!=typeof d.hide&&(d.hide={when:d.hide}),"object"!=typeof d.hide.when&&(d.hide.when={event:d.hide.when}),"object"!=typeof d.hide.effect&&(d.hide.effect={type:d.hide.effect}),"object"!=typeof d.style&&(d.style={name:d.style}),d.style=n(d.style),i=a.extend(!0,{},a.fn.qtip.defaults,d),i.style=o.call({options:i},i.style),i.user=a.extend(!0,{},d);return a(this).each(function(){if("string"==typeof d){if(k=d.toLowerCase(),h=a(this).qtip("interfaces"),"object"==typeof h)if(e===!0&&"destroy"==k)for(;h.length>0;)h[h.length-1].destroy();else for(e!==!0&&(h=[a(this).qtip("api")]),f=0;f<h.length;f++)"destroy"==k?h[f].destroy():h[f].status.rendered===!0&&("show"==k?h[f].show():"hide"==k?h[f].hide():"focus"==k?h[f].focus():"disable"==k?h[f].disable(!0):"enable"==k&&h[f].disable(!1))}else{for(l=a.extend(!0,{},i),l.hide.effect.length=i.hide.effect.length,l.show.effect.length=i.show.effect.length,l.position.container===!1&&(l.position.container=a(document.body)),l.position.target===!1&&(l.position.target=a(this)),l.show.when.target===!1&&(l.show.when.target=a(this)),l.hide.when.target===!1&&(l.hide.when.target=a(this)),g=a.fn.qtip.interfaces.length,f=0;g>f;f++)if("undefined"==typeof a.fn.qtip.interfaces[f]){g=f;break}j=new b(a(this),l,g),a.fn.qtip.interfaces[g]=j,"object"==typeof a(this).data("qtip")?("undefined"==typeof a(this).attr("qtip")&&(a(this).data("qtip").current=a(this).data("qtip").interfaces.length),a(this).data("qtip").interfaces.push(j)):a(this).data("qtip",{current:0,interfaces:[j]}),l.content.prerender===!1&&l.show.when.event!==!1&&l.show.ready!==!0?l.show.when.target.bind(l.show.when.event+".qtip-"+g+"-create",{qtip:g},function(b){m=a.fn.qtip.interfaces[b.data.qtip],m.options.show.when.target.unbind(m.options.show.when.event+".qtip-"+b.data.qtip+"-create"),m.cache.mouse={x:b.pageX,y:b.pageY},c.call(m),m.options.show.when.target.trigger(m.options.show.when.event)}):(j.cache.mouse={x:l.show.when.target.offset().left,y:l.show.when.target.offset().top},c.call(j))}})},a(document).ready(function(){a.fn.qtip.cache={screen:{scroll:{left:a(window).scrollLeft(),top:a(window).scrollTop()},width:a(window).width(),height:a(window).height()}};var b;a(window).bind("resize scroll",function(c){clearTimeout(b),b=setTimeout(function(){for("scroll"===c.type?a.fn.qtip.cache.screen.scroll={left:a(window).scrollLeft(),top:a(window).scrollTop()}:(a.fn.qtip.cache.screen.width=a(window).width(),a.fn.qtip.cache.screen.height=a(window).height()),i=0;i<a.fn.qtip.interfaces.length;i++){var b=a.fn.qtip.interfaces[i];b.status.rendered===!0&&("static"!==b.options.position.type||b.options.position.adjust.scroll&&"scroll"===c.type||b.options.position.adjust.resize&&"resize"===c.type)&&b.updatePosition(c,!0)}},100)}),a(document).bind("mousedown.qtip",function(b){0===a(b.target).parents("div.qtip").length&&a(".qtip[unfocus]").each(function(){var c=a(this).qtip("api");a(this).is(":visible")&&!c.status.disabled&&a(b.target).add(c.elements.target).length>1&&c.hide(b)})})}),a.fn.qtip.interfaces=[],a.fn.qtip.log={error:function(){return this}},a.fn.qtip.constants={},a.fn.qtip.defaults={content:{prerender:!1,text:!1,url:!1,data:null,title:{text:!1,button:!1}},position:{target:!1,corner:{target:"bottomRight",tooltip:"topLeft"},adjust:{x:0,y:0,mouse:!0,screen:!1,scroll:!0,resize:!0},type:"absolute",container:!1},show:{when:{target:!1,event:"mouseover"},effect:{type:"fade",length:100},delay:140,solo:!1,ready:!1},hide:{when:{target:!1,event:"mouseout"},effect:{type:"fade",length:100},delay:0,fixed:!1},api:{beforeRender:function(){},onRender:function(){},beforePositionUpdate:function(){},onPositionUpdate:function(){},beforeShow:function(){},onShow:function(){},beforeHide:function(){},onHide:function(){},beforeContentUpdate:function(){},onContentUpdate:function(){},beforeContentLoad:function(){},onContentLoad:function(){},beforeTitleUpdate:function(){},onTitleUpdate:function(){},beforeDestroy:function(){},onDestroy:function(){},beforeFocus:function(){},onFocus:function(){}}},a.fn.qtip.styles={defaults:{background:"white",color:"#111",overflow:"hidden",textAlign:"left",width:{min:0,max:250},padding:"5px 9px",border:{width:1,radius:0,color:"#d3d3d3"},tip:{corner:!1,color:!1,size:{width:13,height:13},opacity:1},title:{background:"#e1e1e1",fontWeight:"bold",padding:"7px 12px"},button:{cursor:"pointer"},classes:{target:"",tip:"qtip-tip",title:"qtip-title",button:"qtip-button",content:"qtip-content",active:"qtip-active"}},cream:{border:{width:3,radius:0,color:"#F9E98E"},title:{background:"#F0DE7D",color:"#A27D35"},background:"#FBF7AA",color:"#A27D35",classes:{tooltip:"qtip-cream"}},light:{border:{width:3,radius:0,color:"#E2E2E2"},title:{background:"#f1f1f1",color:"#454545"},background:"white",color:"#454545",classes:{tooltip:"qtip-light"}},dark:{border:{width:3,radius:0,color:"#303030"},title:{background:"#404040",color:"#f3f3f3"},background:"#505050",color:"#f3f3f3",classes:{tooltip:"qtip-dark"}},red:{border:{width:3,radius:0,color:"#CE6F6F"},title:{background:"#f28279",color:"#9C2F2F"},background:"#F79992",color:"#9C2F2F",classes:{tooltip:"qtip-red"}},green:{border:{width:3,radius:0,color:"#A9DB66"},title:{background:"#b9db8c",color:"#58792E"},background:"#CDE6AC",color:"#58792E",classes:{tooltip:"qtip-green"}},blue:{border:{width:3,radius:0,color:"#ADD9ED"},title:{background:"#D0E9F5",color:"#5E99BD"},background:"#E5F6FE",color:"#4D9FBF",classes:{tooltip:"qtip-blue"}}}}(jQuery);;jQuery(document).ready(function ($) {
    $(document).on('click', '.btn_add_wishlist', function (event) {
        var $this = $(this);
        $.ajax({
            url       : st_params.ajax_url,
            type      : "POST",
            data      : {action: "st_add_wishlist", data_id: $(this).data('id'), data_type: $(this).data('type')},
            dataType  : "json",
            beforeSend: function () {
            }
        }).done(function (html) {
            $this.html(html.icon).attr("data-original-title", html.title)
        })
    });
    $(document).on('click', '.btn_remove_wishlist', function (event) {
        var $this = $(this);
        $.ajax({
            url       : st_params.ajax_url,
            type      : "POST",
            data      : {action: "st_remove_wishlist", data_id: $(this).data('id'), data_type: $(this).data('type')},
            dataType  : "json",
            beforeSend: function () {
                $('.post-' + $this.attr('data-id') + ' .user_img_loading').show()
            }
        }).done(function (html) {
            if (html.status == 'true') {
                $('.post-' + html.msg).html(console_msg(html.type, html.content)).attr("data-original-title", html.title)
            } else {
                $('.post-' + html.msg).append(console_msg(html.type, html.content)).attr("data-original-title", html.title)
            }
        })
    });
    $('.btn_load_more_wishlist').click(function () {
        var $this  = $(this);
        var txt_me = $this.html();
        $.ajax({
            url       : st_params.ajax_url,
            type      : "GET",
            data      : {
                action   : "st_load_more_wishlist",
                data_per : $('.btn_load_more_wishlist').attr('data-per'),
                data_next: $('.btn_load_more_wishlist').attr('data-next')
            },
            dataType  : "json",
            beforeSend: function () {
                $this.html('Loading...')
            }
        }).done(function (html) {
            $this.html(txt_me);
            $('#data_whislist').append(html.msg);
            if (html.status == 'true') {
                console.log(html);
                $('.btn_load_more_wishlist').attr('data-per', html.data_per)
            } else {
                $('.btn_load_more_wishlist').attr('disabled', 'disabled');
                $('.btn_load_more_wishlist').html('No More')
            }
        })
    });
    $('#btn_add_media').click(function () {
        $('#my_image_upload').click()
    });
    $('#my_image_upload').change(function () {
        $('#submit_my_image_upload').click()
    });
    $('.btn_remove_post_type').click(function () {
        var $this = $(this);
        $.ajax({
            url       : st_params.ajax_url,
            type      : "POST",
            data      : {
                action      : "st_remove_post_type",
                data_id     : $(this).attr('data-id'),
                data_id_user: $(this).attr('data-id-user')
            },
            dataType  : "json",
            beforeSend: function () {
                $('.post-' + $this.attr('data-id') + ' .user_img_loading').show()
            }
        }).done(function (html) {
            console.log(html);
            if (html.status == 'true') {
                $('li.post-' + html.msg).html(console_msg(html.type, html.content))
            } else {
                $('li.post-' + html.msg).append(console_msg(html.type, html.content))
            }
        })
    });
    function console_msg(type, content) {
        var txt = '<div class="alert alert-' + type + ' mt10"> <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">x</span> </button> <p class="text-small">' + content + '</p> </div>';
        return txt
    }

    $('#btn_check_insert_post_type_hotel').click(function () {
        var dk = !0;
        if (dk == !0) {
            console.log('Submit create hotel !');
            $('#btn_insert_post_type_hotel').click()
        }
    });
    $('#btn_check_insert_post_type_room').click(function () {
        var dk = !0;
        if (kt_rong('title', 'Warning : Room Name could not left empty') != !0) {
            dk = !1
        }
        if (kt_chieudai('title', 'Warning : Room Name no shorter than 4 characters', 4) != !0) {
            dk = !1
        }
        if (dk == !0) {
            console.log('Submit create hotel !');
            $('#btn_insert_post_type_room').click()
        }
    });
    $(document).on('click', '.btn_del_price_custom', function () {
        $(this).parent().parent().remove()
    });
    $('#btn_add_custom_price').click(function () {
        var $item = $('.data_price_html').html();
        $('.content_data_price').append($item);
        $('input.date-pick, .input-daterange, .date-pick-inline').datepicker({todayHighlight: !0, weekStart: 1})
    });
    $('#btn_add_custom_price_by_number').click(function () {
        var $item = $('.data_price_by_number_html').html();
        $('.content_data_price_by_number').append($item)
    });
    $('#btn_add_extra_price').click(function (event) {
        var $item = $('.data-extra-price-html').html();
        $('.content_extra_price').append($item)
    });
    $(document).on('click', '.btn_del_extra_price', function () {
        $(this).parents('.item').remove()
    });
    $('#btn_check_insert_post_type_tours').click(function () {
        var dk = !0;
        if (dk == !0) {
            console.log('Submit create Tours !');
            $('#btn_insert_post_type_tours').click()
        }
    });
    $('#btn_check_insert_activity').click(function () {
        var dk = !0;
        if (dk == !0) {
            console.log('Submit create Activity !');
            $('#btn_insert_post_type_activity').click()
        }
    });
    $('#btn_check_insert_cars').click(function () {
        var dk = !0;
        if (dk == !0) {
            console.log('Submit create Cars !');
            $('#btn_insert_post_type_cars').click()
        }
    });
    $('#btn_check_insert_post_type_rental').click(function () {
        var dk = !0;
        if (dk == !0) {
            console.log('Submit create Rental !');
            $('#btn_insert_post_type_rental').click()
        }
    });
    $('#btn_check_insert_post_type_cruise').click(function () {
        var dk = !0;
        if (dk == !0) {
            console.log('Submit create cruise !');
            $('#btn_insert_post_type_cruise').click()
        }
    });
    $('#btn_check_insert_cruise_cabin').click(function () {
        var dk = !0;
        if (dk == !0) {
            console.log('Submit create cruise !');
            $('#btn_insert_cruise_cabin').click()
        }
    });
    $('#btn_check_insert_post_type_location').click(function () {
        var dk = !0;
        if (dk == !0) {
            console.log('Submit create location !');
            $('#btn_insert_post_type_location').click()
        }
    });
    function validate_fileupload(fileName, msg) {
        var allowed_extensions = new Array("jpg", "png", "gif");
        var file_extension     = fileName.split('.').pop();
        for (var i = 0; i <= allowed_extensions.length; i++) {
            if (allowed_extensions[i] == file_extension) {
                $('.msg').html('');
                return !0
            }
        }
        $('.msg').html('<div class="alert alert-danger msg_image"> <button aria-label="" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">�</span></button> <p>' + msg + '</p> </div>');
        return !1
    }

    function checkLinkUrl(div, thongbao) {
        var str     = $('#' + div).val();
        var pattern = new RegExp('^(https?:\/\/)?' + '((([a-z\d]([a-z\d-]*[a-z\d])*)\.)+[a-z]{2,}|' + '((\d{1,3}\.){3}\d{1,3}))' + '(\:\d+)?(\/[-a-z\d%_.~+]*)*' + '(\?[;&a-z\d%_.~+=-]*)?' + '(\#[-a-z\d_]*)?$', 'i');
        if (!pattern.test(str)) {
            $('.console_msg_' + div).html(console_msg('danger', thongbao));
            $('#' + div).css('borderColor', "red");
            return !1
        } else {
            $('.console_msg_' + div).html('');
            $('#' + div).css('borderColor', "#C6DBE0");
            return !0
        }
    }

    function kt_rong(div, thongbao) {
        var value = $('#' + div).val();
        if (value == "" || value == null) {
            $('.console_msg_' + div).html(console_msg('danger', thongbao));
            $('#' + div).css('borderColor', "red");
            return !1
        } else {
            $('.console_msg_' + div).html('');
            $('#' + div).css('borderColor', "#C6DBE0");
            return !0
        }
    }

    function kt_chieudai(div, thongbao, chieudai) {
        var value = $('#' + div).val();
        if (value.length == chieudai || value.length < chieudai) {
            $('.console_msg_' + div).html(console_msg('danger', thongbao));
            $('#' + div).css('borderColor', "red");
            return !1
        } else {
            $('.console_msg_' + div).html('');
            $('#' + div).css('borderColor', "#C6DBE0");
            return !0
        }
    }

    function kt_so(div, thongbao) {
        var value = $('#' + div).val();
        if (isNaN(value) == !0) {
            $('.console_msg_' + div).html(console_msg('danger', thongbao));
            $('#' + div).css('borderColor', "red");
            return !1
        } else {
            $('.console_msg_' + div).html('');
            $('#' + div).css('borderColor', "#C6DBE0");
            return !0
        }
    }

    function checkEmail(div, thongbao) {
        var value = $('#' + div).val();
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
            $('.console_msg_' + div).html('');
            $('#' + div).css('borderColor', "#C6DBE0");
            return !0
        } else {
            $('.console_msg_' + div).html(console_msg('danger', thongbao));
            $('#' + div).css('borderColor', "red");
            return !1
        }
    }

    $(document).on('change', '.btn-file :file', function () {
        var input = $(this), label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.parent().parent().parent().find(".data_lable").val(label)
    });
    $(document).on('change', '.btn-file.multiple :file', function () {
        var $this = $(this);
        var files = $this[0].files;
        var txt   = '';
        for (var i = 0; i < files.length; i++) {
            txt += files[i].name + " , "
        }
        $this.parent().parent().parent().find(".data_lable").val(txt)
    });
    $('.btn_del_avatar').click(function () {
        $('#id_avatar_user_setting').val('');
        $('.data_lable').val('')
    });
    function str2num(val) {
        val = '0' + val;
        val = parseFloat(val);
        return val
    }

    $('.btn_load_his_withdrawal').click(function () {
        var $this  = $(this);
        var txt_me = $this.html();
        $.ajax({
            url       : st_params.ajax_url,
            type      : "GET",
            data      : {action: "st_load_more_list_withdrawal", paged: $this.attr('data-per'), show: "json",},
            dataType  : "json",
            beforeSend: function () {
                $this.html(st_params.text_loading)
            }
        }).done(function (html) {
            $this.html(txt_me);
            if (html.status == 'true') {
                console.log(html);
                $this.attr('data-per', html.data_per);
                $this.parent().find('#data_history_withdrawal').append(html.html)
            } else {
                $this.attr('disabled', 'disabled');
                $this.html(st_params.text_no_more)
            }
        })
    });
    $('.btn_load_his_book').click(function () {
        var $this  = $(this);
        var txt_me = $this.html();
        $.ajax({
            url       : st_params.ajax_url,
            type      : "GET",
            data      : {
                action   : "st_load_more_history_book",
                paged    : $this.attr('data-per'),
                show     : "json",
                data_type: $this.attr('data-type')
            },
            dataType  : "json",
            beforeSend: function () {
                $this.html(st_params.text_loading)
            }
        }).done(function (html) {
            $this.html(txt_me);
            if (html.status == 'true') {
                console.log(html);
                $this.attr('data-per', html.data_per);
                $this.parent().find('#data_history_book').append(html.html)
            } else {
                $this.attr('disabled', 'disabled');
                $this.html(st_params.text_no_more)
            }
        })
    });
    $('#btn_add_program').click(function () {
        var html = $('#html_program').html();
        console.log(html);
        $('#data_program').append(html)
    });
    $('#btn_add_equipment_item').click(function () {
        var html = $('#html_equipment_item').html();
        console.log(html);
        $('#data_equipment_item').append(html)
    });
    $('#btn_add_features').click(function () {
        var html = $('#html_features').html();
        console.log(html);
        $('#data_features').append(html)
    });
    $('#btn_add_features_rental').click(function () {
        var html = $('#html_features_rental').html();
        console.log(html);
        $('#data_features_rental').append(html)
    });
    $(document).on('click', '.btn_del_program', function () {
        $(this).parent().parent().parent().remove()
    });
    $('li.menu_partner a').click(function () {
        var type = $(this).next('.sub_partner').css('display');
        console.log(type);
        if (type == "none") {
            $(this).next('.sub_partner').slideDown(500);
            $('.icon_partner', this).removeClass("fa-angle-left").addClass("fa-angle-down")
        } else {
            $(this).next('.sub_partner').slideUp(500);
            $('.icon_partner', this).removeClass("fa-angle-down").addClass("fa-angle-left")
        }
    });
    $('.btn_on_off_post_type_partner').click(function () {
        var $this = $(this);
        $.ajax({
            url       : st_params.ajax_url,
            type      : "POST",
            data      : {
                action      : "st_change_status_post_type",
                data_id     : $(this).attr('data-id'),
                data_id_user: $(this).attr('data-id-user'),
                status      : $(this).attr('data-status')
            },
            dataType  : "json",
            beforeSend: function () {
                $('.post-' + $this.attr('data-id') + ' .user_img_loading').show()
            }
        }).done(function (html) {
            console.log(html);
            $('.post-' + $this.attr('data-id') + ' .user_img_loading').hide();
            if (html.status == 'true') {
                if ($this.attr('data-status') == 'on') {
                    $this.attr('data-status', 'off');
                    $this.removeClass('fa-eye-slash').addClass('fa-eye')
                } else {
                    $this.attr('data-status', 'on');
                    $this.removeClass('fa-eye').addClass('fa-eye-slash')
                }
            } else {
            }
        })
    });
    $('#add-new-facility').click(function (event) {
        var html = $('#template').html();
        $('#facility-wrapper').append(html).find('.facility-item').show();
        event.preventDefault()
    });
    $('#facility-wrapper').on('click', '.btn_del_facility', function (event) {
        $(this).closest('.facility-item').remove()
    });
    $('.btn_featured_image').click(function () {
        var $this = $(this);
        $this.parent().parent().find('#id_featured_image').val('');
        $this.parent().parent().find('.data_lable').val('');
        $this.parent().remove()
    });
    $('.btn_del_logo').click(function () {
        var $this = $(this);
        $this.parent().parent().find('#id_logo').val('');
        $this.parent().parent().find('.data_lable').val('');
        $this.parent().remove()
    });
    $('.btn_del_gallery').click(function () {
        var $this = $(this);
        $this.parent().parent().find('#id_gallery').val('');
        $this.parent().parent().find('.data_lable').val('');
        $this.parent().remove()
    });
    $('#btn_add_custom_paid_options').click(function () {
        var html = $('.paid_options_html').html();
        console.log(html);
        $('.content_data_paid_options').append(html)
    });
    $('#btn_add_custom_add_new_facility').click(function () {
        var html = $('.add_new_facility_html').html();
        console.log(html);
        $('.content_data_add_new_facility').append(html);
        $('.st_icon').each(function () {
            $(this).iconpicker({icons: st_icon_picker.icon_list, iconClassPrefix: ' '})
        })
    });
    $(document).on('click', '.btn_del_custom_partner', function () {
        $(this).parent().parent().parent().remove()
    });
    $('#btn_discount_by_adult').click(function () {
        var html = $('#html_discount_by_adult').html();
        console.log(html);
        $('#data_discount_by_adult').append(html)
    });
    $('#btn_discount_by_child').click(function () {
        var html = $('#html_discount_by_child').html();
        console.log(html);
        $('#data_discount_by_child').append(html)
    });
    $("#btn_hotel_policy").on('click', function () {
        var html = $("#html_hotel_policy").html();
        console.log(html);
        $("#data_hotel_policy").append(html)
    });
    $('#btn_add_social').click(function () {
        var html = $('#html_add_social').html();
        console.log(html);
        $('#data_add_social').append(html)
    });
    function fix_user_menu() {
        setTimeout(function () {
            var height_conent = $('.row_content_partner').height();
            var content_width = $('body').width();
            if (height_conent > 0 && content_width > 960) {
                $('.user-left-menu>.st-page-sidebar-new').css("min-height", height_conent)
            }
        }, 1500)
    }

    jQuery(window).bind("load", function ($) {
        fix_user_menu()
    });
    jQuery(window).resize(function ($) {
        fix_user_menu()
    });
    $('#st_form_add_partner .number').each(function () {
        var $this = $(this);
        $this.change(function () {
            var number = $(this).val();
            number     = parseFloat(number);
            if (isNaN(number)) {
                number = 0
            }
            $(this).val(number)
        })
    });
    $('#st_form_add_partner input.date-pick').each(function () {
        var form = $(this).closest('form');
        $(this, form).datepicker('setStartDate', 'today')
    });
    $('.check_all').on('ifClicked', function (event) {
        var $this = $(this);
        if ($this.prop('checked')) {
            $this.parent().parent().parent().parent().parent().find('.item_tanoxomy').iCheck('uncheck')
        } else {
            $this.parent().parent().parent().parent().parent().find('.item_tanoxomy').iCheck('check')
        }
    });
    $('.item_tanoxomy').on('ifClicked', function (event) {
        var $this    = $(this);
        var is_check = !0;
        $this.parent().parent().parent().parent().parent().find('.item_tanoxomy').each(function () {
            var $this2 = $(this);
            setTimeout(function () {
                if ($this2.prop('checked') == "") {
                    is_check = !1
                }
            }, 100)
        });
        setTimeout(function () {
            if (is_check == !0) {
                $this.parent().parent().parent().parent().parent().find('.check_all').iCheck('check')
            } else {
                $this.parent().parent().parent().parent().parent().find('.check_all').iCheck('uncheck')
            }
        }, 200)
    });
    check_show_hiden('is_sale_schedule', 'data_is_sale_schedule');
    check_show_hiden('st_tour_external_booking', 'data_st_tour_external_booking');
    check_show_hiden('st_rental_external_booking', 'data_st_rental_external_booking');
    check_show_hiden('st_activity_external_booking', 'data_st_activity_external_booking');
    check_show_hiden('st_room_external_booking', 'data_st_room_external_booking');
    check_show_hiden('st_car_external_booking', 'data_st_car_external_booking');
    check_show_hiden('best-price-guarantee', 'data_best-price-guarantee');
    function check_show_hiden(div, div_data) {
        if ($("." + div).val() == 'on') {
            $('.' + div_data).fadeIn(500)
        } else {
            $('.' + div_data).fadeOut(500)
        }
        $('.' + div).change(function () {
            if ($(this).val() == 'on') {
                $('.' + div_data).fadeIn(500)
            } else {
                $('.' + div_data).fadeOut(500)
            }
        })
    }

    if ($(".deposit_payment_status").val() != '') {
        $('.data_deposit_payment_status').fadeIn(500)
    } else {
        $('.data_deposit_payment_status').fadeOut(500)
    }
    $('.deposit_payment_status').change(function () {
        if ($(this).val() != '') {
            $('.data_deposit_payment_status').fadeIn(500)
        } else {
            $('.data_deposit_payment_status').fadeOut(500)
        }
    });
    if ($(".is_auto_caculate").val() == 'off') {
        $('.data_is_auto_caculate').fadeIn(500)
    } else {
        $('.data_is_auto_caculate').fadeOut(500)
    }
    $('.is_auto_caculate').change(function () {
        if ($(this).val() == 'off') {
            $('.data_is_auto_caculate').fadeIn(500)
        } else {
            $('.data_is_auto_caculate').fadeOut(500)
        }
    });
    if ($(".is_custom_price").val() == 'price_by_date') {
        $('.data_price_by_date').fadeIn(500);
        $('.data_price_by_number').fadeOut(0)
    } else {
        $('.data_price_by_date').fadeOut(0);
        $('.data_price_by_number').fadeIn(500)
    }
    $('.is_custom_price').change(function () {
        if ($(this).val() == 'price_by_date') {
            $('.data_price_by_date').fadeIn(500);
            $('.data_price_by_number').fadeOut(0)
        } else {
            $('.data_price_by_date').fadeOut(0);
            $('.data_price_by_number').fadeIn(500)
        }
    });

    if($('#car_type').val() == 'car_transfer'){
        $('.car-price-type').fadeIn();
        $('.car-passengers').fadeIn();
        $('.car-journey').fadeIn();
    }else{
        $('.car-price-type').fadeOut();
        $('.car-passengers').fadeOut();
        $('.car-journey').fadeOut();
    }

    $('#car_type').change(function () {
        if ($(this).val() == 'car_transfer') {
            $('.car-price-type').fadeIn();
            $('.car-passengers').fadeIn();
            $('.car-journey').fadeIn();
        } else {
            $('.car-price-type').fadeOut();
            $('.car-passengers').fadeOut();
            $('.car-journey').fadeOut();
        }
    });

    setTimeout(function () {
        $('.div_btn_submit input[type=submit]').removeAttr('disabled')
    }, 5000)
});
jQuery(function ($) {
    if ($("#st_form_add_partner").hasClass('success') == !0) {
        console.log('Reset');
        $("#st_form_add_partner input[type=text]").val('');
        $("#st_form_add_partner input[type=email]").val('');
        $("#st_form_add_partner input[type=number]").val('0');
        $("#st_form_add_partner .st_content").val('');
        $("#st_form_add_partner textarea").html('');
        $("#st_form_add_partner .user-profile-avatar").html('');
        $("#st_form_add_partner .id_featured_image").val('');
        $("#st_form_add_partner .id_logo").val('');
        $("#st_form_add_partner .data_lable").val('');
        $("#st_form_add_partner .content_data_add_new_facility").html('');
        $("#st_form_add_partner .content_data_paid_options").html('');
        $("#st_form_add_partner .content_data_price").html('');
        $("#st_form_add_partner .selectize-input").html('');
        $('#st_form_add_partner select').prop('selectedIndex', 0);
        $("#st_form_add_partner").find('.item_tanoxomy').iCheck('uncheck')
    }
    $('.input-daterange input.st_date_start').each(function () {
        var form = $(this).closest('form');
        var me   = $(this);
        $(this).datepicker({
            language      : st_params.locale,
            autoclose     : !0,
            todayHighlight: !0,
            startDate     : 'today',
            format        : $('[data-date-format]').data('date-format'),
            weekStart     : 1
        }).on('changeDate', function (e) {
            var new_date = e.date;
            new_date.setDate(new_date.getDate() + 1);
            $('.input-daterange input.st_date_end', form).datepicker('setDates', new_date);
            $('.input-daterange input.st_date_end', form).datepicker('setStartDate', new_date)
        });
        $('.input-daterange input.st_date_end', form).datepicker({
            language      : st_params.locale,
            startDate     : '+1d',
            format        : $('[data-date-format]').data('date-format'),
            autoclose     : !0,
            todayHighlight: !0
        })
    })
});
jQuery(function ($) {
    $(document).on('click', '.st_menu_new li.item', function () {
        var content = $(this).parent();
        var $this   = $(this);
        if ($this.hasClass('active') == !1) {
            content.find('li.item').removeClass("active").find('.sub-menu').css('display', 'none');
            $this.find('.sub-menu').fadeIn(500);
            $this.addClass("active")
        }
    });
    $('.input-date-start').each(function () {
        var form = $(this).closest('form');
        var me   = $(this);
        $(this).datepicker({
            language      : st_params.locale,
            autoclose     : !0,
            todayHighlight: !0,
            todayBtn      : !0,
            format        : $(this).data('date-format'),
            weekStart     : 1
        }).on('changeDate', function (e) {
            var new_date = e.date;
            new_date.setDate(new_date.getDate() + 1);
            $('.input-date-end', form).datepicker('setDates', new_date)
        });
        $('.input-date-end', form).datepicker({
            language      : st_params.locale,
            format        : $(this).data('date-format'),
            autoclose     : !0,
            todayBtn      : !0,
            todayHighlight: !0,
            weekStart     : 1
        })
    });
    $(document).on('click', '.btn_show_custom_date', function () {
        var $this = $(this);
        console.log($this.hasClass('open'));
        if ($this.hasClass('open') == !0) {
            $(".div-custom-date").fadeOut();
            $this.removeClass('open')
        } else {
            $(".div-custom-date").fadeIn();
            $this.addClass('open')
        }
    });
    $(document).on('click', '.btn_cancel', function () {
        $(".div-custom-date").fadeOut();
        $('.btn_show_custom_date').removeClass('open')
    });
    if ($('.custom_select_date').val() == 'custom_date||') {
        $('.data_custom_date').fadeIn()
    } else {
        $('.data_custom_date').fadeOut()
    }
    $(document).on('change', '.custom_select_date', function () {
        var type = $(this).val();
        if (type == 'custom_date||') {
            $('.data_custom_date').fadeIn()
        } else {
            $('.data_custom_date').fadeOut()
        }
    });
    $(document).on('click', '.btn_show_month_by_year', function () {
        var $content = $(this).parent().parent().parent();
        $content.find('tr').removeClass('active');
        $(this).parent().parent().addClass('active');
        var $this      = $(this);
        var $post_type = $this.data('post-type');
        var $year      = $this.data('year');
        $.ajax({
            url       : st_params.ajax_url,
            type      : "POST",
            data      : {action: "st_load_month_by_year_partner", data_year: $year, data_post_type: $post_type},
            dataType  : "json",
            beforeSend: function () {
                $content.find('.active a.btn_show_month_by_year').html($this.data('loading'))
            }
        }).done(function (html) {
            $('.div_single_month .data_month').html(html.html);
            $('.div_single_month .bc_single').html(html.bc_title);
            $content.find('.active a.btn_show_month_by_year').html($this.data('title'));
            $('.div_single_year').hide();
            $('.div_single_day').hide();
            $('.div_single_month').fadeIn();
            $('.div_single_custom').hide();
            console.log(html.js.lable);
            init_canvas_detail_post_type('st_div_item_canvas_month', html.id_rand, $post_type, html.js.lable, html.js.data)
        }).error(function (html) {
            console.log(html)
        })
    });
    $(document).on('click', '.btn_show_day_by_month_year_partner', function () {
        var $content = $(this).parent().parent().parent();
        $content.find('tr').removeClass('active');
        $(this).parent().parent().addClass('active');
        var $this      = $(this);
        var $post_type = $this.data('post-type');
        var $year      = $this.data('year');
        var $month     = $this.data('month');
        $.ajax({
            url       : st_params.ajax_url,
            type      : "POST",
            data      : {
                action        : "st_load_day_by_month_and_year_partner",
                data_year     : $year,
                data_month    : $month,
                data_post_type: $post_type
            },
            dataType  : "json",
            beforeSend: function () {
                $content.find('.active a.btn_show_day_by_month_year_partner').html($this.data('loading'))
            }
        }).done(function (html) {
            $('.div_single_day .data_day').html(html.html);
            $('.div_single_day .bc_single').html(html.bc_title);
            $content.find('.active a.btn_show_day_by_month_year_partner').html($this.data('title'));
            $('.div_single_year').hide();
            $('.div_single_month').hide();
            $('.div_single_day').fadeIn();
            init_canvas_detail_post_type('st_div_item_canvas_day', html.id_rand, $post_type, html.js.lable, html.js.data)
        }).error(function (html) {
            console.log(html)
        })
    });
    $(document).on('click', '.btn_single_all_time', function () {
        $('.div_single_year').fadeIn();
        $('.div_single_month').hide();
        $('.div_single_day').hide()
    });
    $(document).on('click', '.btn_single_year', function () {
        $('.div_single_year').hide();
        $('.div_single_month').fadeIn();
        $('.div_single_day').hide()
    });
    $(document).on('click', '.btn_all_time_show_month_by_year', function () {
        var $content = $(this).parent().parent().parent();
        $content.find('tr').removeClass('active');
        $(this).parent().parent().addClass('active');
        var $this = $(this);
        var $year = $this.data('year');
        $.ajax({
            url       : st_params.ajax_url,
            type      : "POST",
            data      : {action: "st_load_month_all_time_by_year_partner", data_year: $year},
            dataType  : "json",
            beforeSend: function () {
                $content.find('.active a.btn_all_time_show_month_by_year').html($this.data('loading'))
            }
        }).done(function (html) {
            $('.div_all_time_month .data_all_time_month').html(html.html);
            $('.div_all_time_month .bc_all_time').html(html.bc_title);
            $content.find('.active a.btn_all_time_show_month_by_year').html($this.data('title'));
            $('.div_all_time_year').hide();
            $('.div_all_time_day').hide();
            $('.div_all_time_month').fadeIn();
            $('.div_custom_month').hide();
            init_canvas_detail_post_type('st_div_item_all_time_canvas_month', html.id_rand, 'st_hotel', html.js.lable, html.js.data)
        }).error(function (html) {
            console.log(html)
        })
    });
    $(document).on('click', '.btn_all_time_show_day_by_month_year_partner', function () {
        var $content = $(this).parent().parent().parent();
        $content.find('tr').removeClass('active');
        $(this).parent().parent().addClass('active');
        var $this  = $(this);
        var $year  = $this.data('year');
        var $month = $this.data('month');
        $.ajax({
            url       : st_params.ajax_url,
            type      : "POST",
            data      : {
                action    : "st_load_day_all_time_by_month_and_year_partner",
                data_year : $year,
                data_month: $month
            },
            dataType  : "json",
            beforeSend: function () {
                $content.find('.active a.btn_all_time_show_day_by_month_year_partner').html($this.data('loading'))
            }
        }).done(function (html) {
            $('.div_all_time_day .data_all_time_day').html(html.html);
            $('.div_all_time_day .bc_all_time').html(html.bc_title);
            $content.find('.active a.btn_all_time_show_day_by_month_year_partner').html($this.data('title'));
            $('.div_all_time_year').hide();
            $('.div_all_time_month').hide();
            $('.div_all_time_day').fadeIn();
            init_canvas_detail_post_type('st_div_item_all_time_canvas_day', html.id_rand, 'st_hotel', html.js.lable, html.js.data)
        }).error(function (html) {
            console.log(html)
        })
    });
    $(document).on('click', '.btn_all_time', function () {
        $('.div_all_time_year').fadeIn();
        $('.div_all_time_month').hide();
        $('.div_all_time_day').hide()
    });
    $(document).on('click', '.btn_all_time_year', function () {
        $('.div_all_time_year').hide();
        $('.div_all_time_month').fadeIn();
        $('.div_all_time_day').hide()
    });
    function init_canvas_detail_post_type(div_content, id_rand, post_type, lable, data_item) {
        var id_div   = 'canvas_detail_post_type_' + id_rand;
        var $content = $("." + div_content);
        $content.html('<canvas id="' + id_div + '" height="150"></canvas>');
        lable     = eval(lable);
        data_item = eval(data_item);
        var color = '237,​ 131,​ 35';
        switch (post_type) {
            case "st_hotel":
                color = '87, 142, 190';
                break;
            case "st_rental":
                color = '227, 91, 90';
                break;
            case "st_cars":
                color = '68, 182, 174';
                break;
            case "st_tours":
                color = '135, 117, 167';
                break;
            case "st_activity":
                color = '39, 174, 96';
                break
        }

        var lineChartData = {
            labels  : lable,
            datasets: [{
                label               : "My First",
                fillColor           : "rgba(" + color + ", 0.8)",
                strokeColor         : "rgba(" + color + ", 1)",
                pointColor          : "rgba(" + color + ", 1)",
                pointStrokeColor    : "#fff",
                pointHighlightFill  : "#fff",
                pointHighlightStroke: "rgba(" + color + ", 1)",
                data                : data_item,
            }]
        };
        var ctx           = document.getElementById(id_div).getContext("2d");

        var stChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data_lable_year,
                datasets: [{
                    data: data_sets_year,
                    lineTension:0,
                    borderColor: "rgba(" + color + ", 1)",
                    backgroundColor: "rgba(" + color + ", 0.8)",
                    pointBackgroundColor: "rgba(" + color + ", 1)",
                    pointBorderColor: "rgba(" + color + ", 1)",
                    pointHoverBackgroundColor: "rgba(" + color + ", 1)",
                    pointHoverBorderColor: "rgba(" + color + ", 1)",
                    borderWidth: 2
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        
        //new Chart(ctx).Line(lineChartData, {bezierCurve : false,responsive: !0, animationEasing: "easeOutBounce",})
    }

    if ($('.st_timepicker').length) {
        var time_picker_arg = {timeFormat: "hh:mm tt", showMeridian: !1};
        if (st_params.time_format == '12h') {
            time_picker_arg.showMeridian = !0
        } else {
            time_picker_arg.showMeridian = !1
        }
        $('.st_timepicker').timepicker(time_picker_arg)
    }
    $('.st_icon').each(function () {
        $(this).iconpicker({icons: st_icon_picker.icon_list, iconClassPrefix: ' '})
    })
});
jQuery(document).ready(function ($) {
    if ($(".register_form").data("reset") == !0) {
        $(".register_form .data_field :input[type=text]").each(function () {
            $(this).val('')
        });
        $(".data_image_certificates").each(function () {
            $(this).html('')
        })
    }
    $('.register_form .register_as').on('ifChecked', function (event) {
        var value = $(this).val();
        if (value == "partner") {
            $(".content_partner").slideDown(1000)
        }
        if (value == "normal") {
            $(".content_partner").slideUp(1000)
        }
        console.log(value)
    });
    if ($(".register_form .register_as:checked").val() == "partner") {
        $(".content_partner").show()
    }
    $(".register_form .st_certificates").change(function () {
        var post_type = $(this).data('type')
    });
    function upload_certificates(post_type) {
        var formData = new FormData($('.register_form')[0]);
        formData.append('action', 'update_certificates');
        formData.append('post_type', post_type);
        $(".div_" + post_type).find(".data_image_certificates").html("<img src=" + st_params.loading_url + " />");
        $(".div_" + post_type).find(".i-check").iCheck('check');
        $.ajax({
            type       : "POST",
            url        : st_params.ajax_url,
            enctype    : 'multipart/form-data',
            data       : formData,
            processData: !1,
            contentType: !1,
            dataType   : "json",
            xhr        : function () {
                var xhr = new window.XMLHttpRequest();
                xhr.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        console.log(Math.round(percentComplete * 100))
                    }
                }, !1);
                return xhr
            },
            success    : function (data) {
                console.log(data);
                if (data.erro_msg == "") {
                    $(".div_" + post_type).find(".data_lable.st_certificates_" + post_type + "_url").css("border-color", "#ccc");
                    $(".div_" + post_type).find(".data_image_certificates").html(data.html_image);
                    $(".div_" + post_type).find(".st_certificates_" + post_type + "_url").val(data.image_url)
                } else {
                    $(".div_" + post_type).find(".data_lable.st_certificates_" + post_type + "_url").css("border-color", "red");
                    $(".div_" + post_type).find(".data_lable.st_certificates_" + post_type + "_url").val(data.erro_msg);
                    $(".div_" + post_type).find(".data_image_certificates").html('')
                }
            }
        })
    }

    var register_form = $('.register_form');
    $('.register_form').submit(function () {
        if ($(this).hasClass("update_info_partner") == !1) {
            if (!validate_register()) {
                console.log("Error");
                return !1
            }
        }
    });
    function validate_register() {
        var validate = !0;
        try {
            if ($("#field-user_name").val() == "") {
                $("#field-user_name").css('border-color', 'red');
                validate = !1
            } else {
                $("#field-user_name").css('border-color', '#ccc')
            }
            ;
            if ($("#field-password").val() == "") {
                $("#field-password").css('border-color', 'red');
                validate = !1
            } else {
                $("#field-password").css('border-color', '#ccc')
            }
            ;
            if ($("#field-email").val() == "") {
                $("#field-email").css('border-color', 'red');
                validate = !1
            } else {
                $("#field-email").css('border-color', '#ccc')
            }
            ;
            if ($(".term_condition:checked").val() != "on") {
                $(".term_condition").parent().css('border-color', 'red');
                validate = !1
            } else {
                $(".term_condition").parent().css('border-color', '#ccc')
            }
        } catch (e) {
            console.log(e)
        }
        return validate
    }

    if ($('input#address').length) {
        var bt_ot_gmap_input_lat                      = $('input.bt_ot_gmap_input_lat');
        var bt_ot_gmap_input_lng                      = $('input.bt_ot_gmap_input_lng');
        var bt_ot_gmap_st_street_number               = $('#bt_ot_gmap_st_street_number');
        var bt_ot_gmap_st_locality                    = $('#bt_ot_gmap_st_locality');
        var bt_ot_gmap_st_route                       = $('#bt_ot_gmap_st_route');
        var bt_ot_gmap_st_sublocality_level_1         = $('#bt_ot_gmap_st_sublocality_level_1');
        var bt_ot_gmap_st_administrative_area_level_2 = $('#bt_ot_gmap_st_administrative_area_level_2');
        var bt_ot_gmap_st_administrative_area_level_1 = $('#bt_ot_gmap_st_administrative_area_level_1');
        var bt_ot_gmap_st_country                     = $('#bt_ot_gmap_st_country');
        var input                                     = $('input#address').get(0);
        var autocomplete                              = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function () {
            var places = autocomplete.getPlace();
            if (places.length == 0) {
                return
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
            $.each(places.address_components, function (index, names) {
                if ($.inArray('street_number', names.types) != -1) {
                    bt_ot_gmap_st_street_number.val(names.long_name)
                }
                if ($.inArray('locality', names.types) != -1) {
                    bt_ot_gmap_st_locality.val(names.long_name)
                }
                if ($.inArray('route', names.types) != -1) {
                    bt_ot_gmap_st_route.val(names.long_name)
                }
                if ($.inArray('sublocality_level_1', names.types) != -1) {
                    bt_ot_gmap_st_sublocality_level_1.val(names.long_name)
                }
                if ($.inArray('administrative_area_level_2', names.types) != -1) {
                    bt_ot_gmap_st_administrative_area_level_2.val(names.long_name)
                }
                if ($.inArray('administrative_area_level_1', names.types) != -1) {
                    bt_ot_gmap_st_administrative_area_level_1.val(names.long_name)
                }
                if ($.inArray('country', names.types) != -1) {
                    bt_ot_gmap_st_country.val(names.long_name)
                }
            })
        })
    }
    $(document).on('click', '.paged_item_service', function () {
        var container = $(this).parent().parent().parent().parent();
        var paged     = $(this).data('page');
        var user_id   = $(this).data('user-id');
        var post_type = $(this).data('post-type');
        console.log(post_type);
        $.ajax({
            url       : st_params.ajax_url,
            type      : "POST",
            data      : {
                action        : "get_list_item_service_available",
                data_page     : paged,
                data_user_id  : user_id,
                data_post_type: post_type,
                st_ajax       : 1
            },
            dataType  : "json",
            beforeSend: function () {
                container.find(".ajax_loader").show()
            }
        }).done(function (html) {
            console.log(html);
            container.find(".data_single_partner").html(html.data);
            container.find(".paging_single_partner").html(html.paging);
            container.find(".ajax_loader").hide();
            $('.st-popup-gallery').each(function () {
                $(this).magnificPopup({delegate: '.st-gp-item', type: 'image', gallery: {enabled: !0}})
            })
        })
    });
    $('.car_location_pick_up').each(function (index, el) {
        var t = $(this);
        t.select2({
            placeholder       : t.data('placeholder'),
            minimumInputLength: 2,
            ajax              : {
                url       : ajaxurl, dataType: 'json', quietMillis: 250, data: function (term, page) {
                    return {q: term, action: 'st_post_select_ajax', post_type: 'location'}
                }, results: function (data, page) {
                    return {results: data.items}
                }, cache  : !0
            },
            formatResult      : function (state) {
                if (!state.id)return state.name;
                return state.name + '<p><em>' + state.description + '</em></p>'
            },
            formatSelection   : function (state) {
                if (!state.id)return state.name;
                return state.name + '<p><em>' + state.description + '</em></p>'
            },
            escapeMarkup      : function (m) {
                return m
            }
        });
        t.on("change", function (e) {
            console.log(typeof e.added);
            if (typeof e.added != 'undefined' && typeof e.added.name != 'undefined') {
                t.attr('data-name', e.added.name)
            }
            var location = e.val;
            var t2;
            if (location != '') {
                $('.car_location_drop_off').each(function (index, el) {
                    t2 = $(this);
                    t2.select2({
                        placeholder    : t.data('placeholder'),
                        ajax           : {
                            url        : ajaxurl,
                            dataType   : 'json',
                            quietMillis: 250,
                            data       : function (term, page) {
                                return {action: 'st_get_location_childs', location_id: location}
                            },
                            results    : function (data, page) {
                                return {results: data.items}
                            },
                            cache      : !0
                        },
                        formatResult   : function (state) {
                            if (!state.id)return state.name;
                            return state.name + '<p><em>' + state.description + '</em></p>'
                        },
                        formatSelection: function (state) {
                            if (!state.id)return state.name;
                            return state.name + '<p><em>' + state.description + '</em></p>'
                        },
                        escapeMarkup   : function (m) {
                            return m
                        }
                    });
                    t2.on("change", function (e) {
                        if (typeof e.added != 'undefined' && typeof e.added.name != 'undefined') {
                            t2.attr('data-name', e.added.name)
                        }
                    })
                })
            }
        })
    });
    function add_list_location_selected(lists) {
        var string = "";
        var data   = "";
        if (locations.length) {
            $.each(locations, function (index, val) {
                string += "<p class='item-location-from-to' data-index=" + index + " style='padding: 5px; margin-top: 5px; border-bottom: 1px solid #CCC; background: #EEE; font-weight: bold;'>" + val.pickup_text + " -> " + val.dropoff_text + " <span class='delete-item-location-from-to'>x</span></p>";
                data += '<input type="hidden" name="locations_from_to[pickup][]" value="' + val.pickup + '"><input type="hidden" name="locations_from_to[dropoff][]" value="' + val.dropoff + '">'
            })
        }
        $('#location-car-selected').html(string);
        $('.location-save-data').html(data)
    }

    var locations = st_location_from_to.lists;
    add_list_location_selected(locations);
    $('#add-location-from-to').click(function (event) {
        $('p.location-message').html('');
        var pickup  = $('input.car_location_pick_up').val();
        var dropoff = $('input.car_location_drop_off').val();
        if (pickup != '' && dropoff != '') {
            var pickup_text  = $('input.car_location_pick_up').attr('data-name');
            var dropoff_text = $('input.car_location_drop_off').attr('data-name');
            locations.push({pickup: pickup, pickup_text: pickup_text, dropoff: dropoff, dropoff_text: dropoff_text});
            $('.car_location_drop_off').select2('data', null)
        } else {
            $('p.location-message').html('Please select pick up and drop off location!')
        }
        add_list_location_selected(locations);
        return !1
    });
    $('body').on('click', '.delete-item-location-from-to', function (event) {
        var parent = $(this).parent('.item-location-from-to')
        var index  = parent.data('index');
        locations.splice(index, 1);
        add_list_location_selected(locations)
    });
    if ($('select#location_type').length) {
        var val = $('select#location_type').val();
        fadeLocation(val)
    }
    $('select#location_type').change(function (event) {
        var val = $(this).val();
        fadeLocation(val)
    });
    function fadeLocation(val) {
        if (val == 'multi_location') {
            $('.multi_location_wrapper').fadeIn();
            $('.location_from_to_wrapper').fadeOut()
        }
        if (val == 'check_in_out') {
            $('.multi_location_wrapper').fadeOut();
            $('.location_from_to_wrapper').fadeIn()
        }
    }

    if ($('.st-select-loction').length) {
        $('.st-select-loction').each(function (index, el) {
            var parent = $(this);
            var input  = $('input[name="search"]', parent);
            var list   = $('.list-location-wrapper', parent);
            var timeout;
            input.keyup(function (event) {
                clearTimeout(timeout);
                var t   = $(this);
                timeout = setTimeout(function () {
                    var text = t.val().toLowerCase();
                    if (text == '') {
                        $('.item', list).show()
                    } else {
                        $('.item', list).hide();
                        $(".item", list).each(function () {
                            var name = $(this).data("name").toLowerCase();
                            var reg  = new RegExp(text, "g");
                            if (reg.test(name)) {
                                $(this).show()
                            }
                        })
                    }
                }, 100)
            })
        })
    }
    $('#st_partner_payout').change(function () {
        var is_pay = $(this).val();
        console.log(is_pay);
        if (is_pay == "paypal") {
            $('.content_partner_paypal').show();
            $('.content_partner_stripe').hide()
        }
        if (is_pay == "stripe") {
            $('.content_partner_paypal').hide();
            $('.content_partner_stripe').show()
        }
    });
    var is_pay = $('#st_partner_payout').val();
    if (is_pay == "paypal") {
        $('.content_partner_paypal').show();
        $('.content_partner_stripe').hide()
    }
    if (is_pay == "stripe") {
        $('.content_partner_paypal').hide();
        $('.content_partner_stripe').show()
    }
    $(".st_partner_payout_item .item-pay").click(function () {
        $('.st_partner_payout_item').find('.item-pay').removeClass('active');
        $(this).parent().find('.st_partner_payout').iCheck('check');
        $(this).addClass('active');
        var is_pay = $(this).parent().find('.st_partner_payout').val();
        $('.item.st_partner_payout_item').hide();
        $(".st_partner_payout_item_" + is_pay).fadeIn(500);
        $(".item.st_partner_payout_item.control").fadeIn(500)
    });
    $(".st_partner_payout_item .item-pay").each(function () {
        var check = $(this).hasClass('active');
        if (check) {
            var is_pay = $(this).parent().find('.st_partner_payout').val();
            $(".st_partner_payout_item_" + is_pay).fadeIn(500);
            $(".item.st_partner_payout_item.control").fadeIn(500)
        }
    });
    $(document).on('click', '.btn_del_withdrawal', function (event) {
        var $this    = $(this);
        var btn_html = $this.parent().html();
        var content  = $this.parent().parent();
        $.ajax({
            url       : st_params.ajax_url,
            type      : "POST",
            data      : {
                action          : "st_remove_withdrawal",
                data_user_id    : $(this).data('user-id'),
                data_date_create: $(this).data('date-create')
            },
            dataType  : "json",
            beforeSend: function () {
                $this.parent().html('<img src="' + st_params.loading_url + '" />')
            }
        }).done(function (html) {
            if (html.status == 'true') {
                content.fadeOut()
            } else {
            }
        })
    });
    $('body').on('click', '.confirm-cancel-booking', function (event) {
        event.preventDefault();
        var el = $(this);
        $('#cancel-booking-modal').on('show.bs.modal', function (event) {
            var t = $(this);
            $('.modal-content-inner', t).empty();
            $('.overlay-form', t).fadeIn()
        });
        $('#cancel-booking-modal').on('shown.bs.modal', function (event) {
            var t    = $(this);
            var data = {
                'action'       : 'st_get_cancel_booking_step_1',
                'order_id'     : el.data('order_id'),
                'order_encrypt': el.data('order_encrypt')
            };
            $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
                if (typeof respon == 'object') {
                    $('.modal-content-inner', t).html(respon.message);
                    t.data('order_id', respon.order_id);
                    t.data('order_encrypt', respon.order_encrypt);
                    $('.modal-footer button.next', t).attr('id', respon.step)
                }
                $('.overlay-form', t).fadeOut()
            }, 'json')
        })
    });
    var flag_next_step = !1;
    $('body').on('click', '#next-to-step-2', function (event) {
        event.preventDefault();
        var el     = $(this);
        var parent = el.closest('#cancel-booking-modal');
        if (flag_next_step) {
            return !1
        }
        flag_next_step = !0;
        $('.overlay-form', parent).fadeIn();
        el.addClass('hidden');
        var data = {
            'action'       : 'st_get_cancel_booking_step_2',
            'order_id'     : parent.data('order_id'),
            'order_encrypt': parent.data('order_encrypt'),
            'why_cancel'   : $('input[name="why_cancel"]', parent).val(),
            'detail'       : $('textarea', parent).val()
        };
        $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
            if (typeof respon == 'object') {
                $('.modal-content-inner', parent).html(respon.message);
                parent.data('order_id', respon.order_id);
                parent.data('order_encrypt', respon.order_encrypt);
                $('.modal-footer button.next', parent).attr('id', respon.step)
            }
            $('.overlay-form', parent).fadeOut();
            flag_next_step = !1
        }, 'json')
    });
    var flag_refresh_page = !1;
    $('body').on('click', '#next-to-step-3', function (event) {
        event.preventDefault();
        var el     = $(this);
        var parent = el.closest('#cancel-booking-modal');
        var form   = $('form', parent);
        if (flag_next_step) {
            return !1
        }
        flag_next_step    = !0;
        flag_refresh_page = !1;
        $('.overlay-form', parent).fadeIn();
        $validate = check_validate(form);
        if ($validate == !1) {
            $('.overlay-form', parent).fadeOut();
            flag_next_step = !1;
            return !1
        }
        var data = form.serializeArray();
        data.push({name: 'action', value: 'st_get_cancel_booking_step_3'}, {
            name : 'order_id',
            value: parent.data('order_id')
        }, {name: 'order_encrypt', value: parent.data('order_encrypt')});
        $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
            if (typeof respon == 'object') {
                $('.modal-content-inner', parent).html(respon.message);
                $('.overlay-form', parent).fadeOut();
                flag_next_step    = !1;
                flag_refresh_page = !0;
                $('button.next', parent).attr('id', respon.step).addClass('hidden')
            }
        }, 'json')
    });
    function check_validate(form) {
        var validate = !0;
        $('.required', form).each(function (index, el) {
            var val = $(this).val();
            if (val == '') {
                validate = !1;
                $(this).addClass('error')
            } else {
                $(this).removeClass('error')
            }
        });
        return validate
    }

    $('#cancel-booking-modal').on('hidden.bs.modal', function (event) {
        var t = $(this);
        t.off('show.bs.modal shown.bs.modal');
        $('.overlay-form', t).fadeOut();
        $('.modal-content-inner', t).empty();
        t.data('order_id', '');
        t.data('order_encrypt', '');
        if (flag_refresh_page) {
            window.location.reload()
        }
    });
    $('body').on('change', '#cancel-booking-modal input[name="why_cancel"]', function (event) {
        event.preventDefault();
        var t      = $(this);
        var parent = t.parents('form');
        var modal  = t.closest('#cancel-booking-modal');
        var value  = t.val();
        var text   = t.data('text');
        if (typeof value != 'undefined' && value != '') {
            $('.modal-footer button.next').removeClass('hidden')
        } else {
            $('.modal-footer button.next').addClass('hidden')
        }
        if (value == 'other') {
            $('textarea', parent).val('').removeClass('hide')
        } else {
            $('textarea', parent).val(text).addClass('hide')
        }
    });
    $('body').on('change', '#cancel-booking-modal input[name="select_account"]', function (event) {
        event.preventDefault();
        var t      = $(this);
        var parent = t.parents('form');
        var modal  = t.closest('#cancel-booking-modal');
        var value  = t.val();
        if (typeof value != 'undefined' && value != '') {
            $('.modal-footer button.next').removeClass('hidden')
        } else {
            $('.modal-footer button.next').addClass('hidden')
        }
        if (typeof value != 'undefined' && value != '') {
            var html = $('.form-get-account [data-value="' + value + '"]').html();
            $('.form-get-account-inner', parent).html(html)
        } else {
            $('.form-get-account-inner', parent).html('')
        }
    });
    $('body').on('click', '.with_a_refund', function (event) {
        event.preventDefault()
    });
    $('#with-refund-modal').on('hidden.bs.modal', function (event) {
        var t = $(this);
        t.off('show.bs.modal shown.bs.modal');
        $('.overlay-form', t).fadeOut();
        $('.modal-content-inner', t).empty();
        t.data('order_id', '');
        t.data('order_encrypt', '');
        if (flag_refresh_page_refund) {
            window.location.reload()
        }
    });
    $('body').on('click', '.with_a_refund', function (event) {
        event.preventDefault();
        var el = $(this);
        $('#with-refund-modal').on('show.bs.modal', function (event) {
            var t = $(this);
            $('.modal-content-inner', t).empty();
            $('.overlay-form', t).fadeIn()
        });
        $('#with-refund-modal').on('shown.bs.modal', function (event) {
            var t    = $(this);
            var data = {
                'action'       : 'st_get_refund_infomation',
                'order_id'     : el.data('order_id'),
                'order_encrypt': el.data('order_encrypt')
            };
            $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
                if (typeof respon == 'object') {
                    $('.modal-content-inner', t).html(respon.message);
                    t.data('order_id', respon.order_id);
                    t.data('order_encrypt', respon.order_encrypt);
                    $('.modal-footer button.next', t).attr('id', respon.step).removeClass('hidden')
                }
                $('.overlay-form', t).fadeOut()
            }, 'json')
        })
    });
    var flag_next_step_refund    = !1;
    var flag_refresh_page_refund = !1;
    $('body').on('click', '#st_check_complete_refund', function (event) {
        event.preventDefault();
        var el     = $(this);
        var parent = el.closest('#with-refund-modal');
        if (flag_next_step_refund) {
            return !1
        }
        flag_next_step_refund = !0;
        $('.overlay-form', parent).fadeIn();
        el.addClass('hidden');
        var data = {
            'action'       : 'st_check_complete_refund',
            'order_id'     : parent.data('order_id'),
            'order_encrypt': parent.data('order_encrypt'),
        };
        $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
            if (typeof respon == 'object') {
                $('.modal-content-inner', parent).html(respon.message);
                if (respon.status == 1) {
                    flag_refresh_page_refund = !0
                }
            }
            $('.overlay-form', parent).fadeOut();
            flag_next_step_refund = !1
        }, 'json')
    });
    $(document).on('click', '.btn_save_and_preview', function (event) {
        $(".save_and_preview").val("true");
        $(".btn_partner_submit_form").click()
    });
    $('.user-alert').each(function () {
        var t = $(this);
        $('.alert-close', t).click(function () {
            t.removeClass('open');
            $('.alert-overlay').removeClass('open');
            return !1
        })
    });
    $(document).on('click', '.refund_via_paypal_adaptive', function (event) {
        var $this      = $(this);
        var $container = $(this).parent();
        var data       = {'action': 'st_refund_via_paypal_adaptive', 'order_id': $(this).data('order-id'),};
        $this.addClass("loading");
        $container.find(".message").html('');
        $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
            $this.removeClass("loading");
            var $status = 'danger';
            if (respon.status == 'true') {
                $status = 'success'
                $this.attr('disabled', 'disabled')
            }
            var $message = '<div class="alert alert-' + $status + ' mt20">' + respon.message + '</div>';
            $container.find(".message").html($message);
            console.log(respon)
        }, 'json')
    })
    /* flight */

    $('#btn_check_insert_post_type_flight').click(function () {
        var dk = true;
        if (dk == true) {
            console.log('Submit create Tours !');
            $('#btn_insert_post_type_flight').click();
        }
    });

    /* Tour price fixed */
    if($('body').hasClass('edit-tours') || $('body').hasClass('create-tours')) {
        if ($('select#tour_price_by').length){
            if($('select#tour_price_by').val() == 'person' || $('select#tour_price_by').val() == 'fixed_depart'){
                $('.fixed_price').hide();
                $('.people_price').show();
                if($('select#tour_price_by').val() == 'fixed_depart'){
                    $('.people_price .date_fixed_depart').show();
                }else{
                    $('.people_price .date_fixed_depart').hide();
                }

                $('.tour-calendar-price-fixed').hide();
                $('.tour-calendar-price-person').show();
                $('#calendar_price_type').val('person');
                $('input#adult-price-bulk, input#children-price-bulk, input#infant-price-bulk').parent().parent().removeClass('hide');
                $('input#base-price-bulk').val('').parent().parent().addClass('hide');
            } else {
                $('.fixed_price').show();
                $('.people_price').hide();
                $('.tour-calendar-price-fixed').show();
                $('.tour-calendar-price-person').hide();
                $('#calendar_price_type').val('fixed');
                $('input#adult-price-bulk, input#children-price-bulk, input#infant-price-bulk').val('').parent().parent().addClass('hide');
                $('input#base-price-bulk').parent().parent().removeClass('hide');
            }
        }
        $('select#tour_price_by').change(function (event) {
            price_type = $(this).val();
            if (price_type == 'person' || price_type == 'fixed_depart') {
                $('.fixed_price').hide();
                $('.people_price').show();
                if(price_type == 'fixed_depart'){
                    $('.people_price .date_fixed_depart').show();
                }else{
                    $('.people_price .date_fixed_depart').hide();
                }
                $('.tour-calendar-price-fixed').hide();
                $('.tour-calendar-price-person').show();
                $('#calendar_price_type').val('person');
                $('input#adult-price-bulk, input#children-price-bulk, input#infant-price-bulk').parent().parent().removeClass('hide');
                $('input#base-price-bulk').val('').parent().parent().addClass('hide');
            } else {
                $('.fixed_price').show();
                $('.people_price').hide();
                $('.tour-calendar-price-fixed').show();
                $('.tour-calendar-price-person').hide();
                $('#calendar_price_type').val('fixed');
                $('input#adult-price-bulk, input#children-price-bulk, input#infant-price-bulk').val('').parent().parent().addClass('hide');
                $('input#base-price-bulk').parent().parent().removeClass('hide');
            }
        });
    }
}) ;(function () {
    jQuery("#st_enable_javascript").html(
        ".search-tabs-bg > .tabbable >.tab-content > .tab-pane{display: none; opacity: 0;}" +
        ".search-tabs-bg > .tabbable >.tab-content > .tab-pane.active{" +
        "display: block; " +
        "opacity: 1;" +
        "}"
    );
    // css style
})(jQuery);
jQuery(document).ready(function ($) {

    "use strict";
    var utm=$('[name=st_utm]');
    var utmHost='//travelerwp.com/utm/utm.gif?s=';
    if(utm.length){
        try{
            //var utmImg=new Image();
            //utmImg.src=utmHost+utm.attr('content');
        }catch(e){

        }
    }

    $('.top-user-area-lang a.current_langs').click(function (e) {
        e.preventDefault();
    });

    if($('#wp_is_mobile').length <= 0) {
        var $title_menu = $('ul.slimmenu').data('title');
        if ($('ul.slimmenu').length) {
            $('ul.slimmenu').slimmenu({
                resizeWidth: '992',
                collapserTitle: $title_menu,
                animSpeed: 250,
                indentChildren: true,
                childrenIndenter: '',
                expandIcon: "<i class='fa fa-angle-down'></i>",
                collapseIcon: "<i class='fa fa-angle-up'></i>",
            });
        }
    }

    // Countdown
    $('.countdown').each(function () {
        var count = $(this);
        $(this).countdown({
            zeroCallback: function (options) {
                var newDate = new Date(),
                    newDate = newDate.setHours(newDate.getHours() + 130);

                $(count).attr("data-countdown", newDate);
                $(count).countdown({
                    unixFormat: true
                });
            }
        });
    });
    $('.booking-filters-title').each(function (index, el) {
        if ($(this).text() != '') {
            $(this).addClass('arrow');
            $(this).click(function (event) {
                $(this).stop(true, false).toggleClass('closed').next().slideToggle();
            });

        }
    });

    $('.btn').button();

    $("[rel='tooltip']").tooltip();

    $('.form-group').each(function () {
        var self  = $(this),
            input = self.find('input');

        input.focus(function () {
            self.addClass('form-group-focus');
        });

        input.blur(function () {
            if (input.val()) {
                self.addClass('form-group-filled');
            } else {
                self.removeClass('form-group-filled');
            }
            self.removeClass('form-group-focus');
        });
    });

    var st_country_drop_off_address = '';
    if ($('.typeahead_drop_off_address').length) {
        $('.typeahead_drop_off_address').typeahead({
            hint     : true,
            highlight: true,
            minLength: 3,
            limit    : 8
        }, {
            source: function (q, cb) {
                console.log(st_country_drop_off_address);
                if (st_country_drop_off_address.length > 0) {
                    return $.ajax({
                        dataType: 'json',
                        type    : 'get',
                        url     : 'http://gd.geobytes.com/AutoCompleteCity?callback=?&filter=' + st_country_drop_off_address + '&q=' + q,
                        chache  : false,
                        success : function (data) {
                            var result = [];
                            $.each(data, function (index, val) {
                                result.push({
                                    value: val
                                });
                            });
                            cb(result);
                        }
                    });
                }
            }
        });
    }

    $('.typeahead_pick_up_address').keyup(function () {
        $(".typeahead_drop_off_address").each(function () {
            $(this).attr('disabled', "disabled");
            $(this).css('background', "#eee");
            $(this).val("");
        });
    });
    if ($('.typeahead_pick_up_address').length) {
        $('.typeahead_pick_up_address').typeahead({
            hint     : true,
            highlight: true,
            minLength: 3,
            limit    : 8
        }, {
            source: function (q, cb) {
                return $.ajax({
                    dataType: 'json',
                    type    : 'get',
                    url     : 'http://gd.geobytes.com/AutoCompleteCity?callback=?&q=' + q,
                    chache  : false,
                    success : function (data) {
                        var result = [];
                        $.each(data, function (index, val) {
                            result.push({
                                value: val
                            });
                        });
                        cb(result);
                    }
                });
            }
        });

        $('.typeahead_pick_up_address').bind('typeahead:selected', function (obj, datum, name) {
            var cityfqcn = $(this).val();
            var $this    = $(this);
            jQuery.getJSON(
                "http://gd.geobytes.com/GetCityDetails?callback=?&fqcn=" + cityfqcn,
                function (data) {
                    $this.attr('data-country', data.geobytesinternet);
                    st_country_drop_off_address = data.geobytesinternet;
                    console.log(st_country_drop_off_address);
                    $(".typeahead_drop_off_address").each(function () {
                        $(this).removeAttr('disabled');
                        $(this).css('background', "#fff");
                    });
                }
            );
        });

        $('.typeahead_pick_up_address').each(function () {
            var cityfqcn = $(this).val();
            var $this    = $(this);
            if (cityfqcn.length > 0) {
                jQuery.getJSON(
                    "http://gd.geobytes.com/GetCityDetails?callback=?&fqcn=" + cityfqcn,
                    function (data) {
                        $this.attr('data-country', data.geobytesinternet);
                        st_country_drop_off_address = data.geobytesinternet;
                        console.log(st_country_drop_off_address);
                    }
                );
            }
        });
    }

    $('.county_pick_up').each(function () {
        var cityfqcn = $(this).data("address");
        var $this    = $(this);
        if (cityfqcn.length > 0) {
            jQuery.getJSON(
                "http://gd.geobytes.com/GetCityDetails?callback=?&fqcn=" + cityfqcn,
                function (data) {
                    $this.val(data.geobytesinternet);
                }
            );
        }
    });
    if ($('.county_drop_off').length) {
        $('.county_drop_off').each(function () {
            var cityfqcn = $(this).data("address");
            var $this    = $(this);
            if (cityfqcn.length > 0) {
                jQuery.getJSON(
                    "http://gd.geobytes.com/GetCityDetails?callback=?&fqcn=" + cityfqcn,
                    function (data) {
                        $this.val(data.geobytesinternet);
                    }
                );
            }
        });
    }

    if ($('.typeahead_address').length) {
        $('.typeahead_address').typeahead({
            hint     : true,
            highlight: true,
            minLength: 3,
            limit    : 8
        }, {
            source: function (q, cb) {
                return $.ajax({
                    dataType: 'json',
                    type    : 'get',
                    url     : 'http://gd.geobytes.com/AutoCompleteCity?callback=?&q=' + q,
                    chache  : false,
                    success : function (data) {
                        var result = [];
                        $.each(data, function (index, val) {
                            result.push({
                                value: val
                            });
                        });
                        cb(result);
                    }
                });
            }
        });
    }


    if ($('.typeahead').length) {
        $('.typeahead').typeahead({
            hint     : true,
            highlight: true,
            minLength: 3,
            limit    : 8
        }, {
            source: function (q, cb) {
                return $.ajax({
                    dataType: 'json',
                    type    : 'get',
                    url     : 'http://gd.geobytes.com/AutoCompleteCity?callback=?&q=' + q,
                    chache  : false,
                    success : function (data) {
                        var result = [];
                        $.each(data, function (index, val) {
                            result.push({
                                value: val
                            });
                        });
                        cb(result);
                    }
                });
            }
        });
    }

    if ($('.typeahead_location').length) {
        $('.typeahead_location').typeahead({
            hint     : true,
            highlight: true,
            minLength: 3,
            limit    : 8
        }, {
            source   : function (q, cb) {
                return $.ajax({
                    dataType: 'json',
                    type    : 'get',
                    url     : st_params.ajax_url,
                    data    : {
                        security: st_params.st_search_nonce,
                        action  : 'st_search_location',
                        s       : q
                    },
                    cache   : true,
                    success : function (data) {
                        var result = [];
                        if (data.data) {
                            $.each(data.data, function (index, val) {
                                result.push({
                                    value      : val.title,
                                    location_id: val.id,
                                    type_color : 'success',
                                    type       : val.type
                                });
                            });
                            cb(result);
                        }

                    }
                });
            },
            templates: {
                suggestion: Handlebars.compile('<p><label class="label label-{{type_color}}">{{type}}</label><strong> {{value}}</strong></p>')
            }
        });
    }

    $('.typeahead_location').bind('typeahead:selected', function (obj, datum, name) {
        var parent = $(this).parents('.form-group');
        parent.find('.location_id').val(datum.location_id);
    });
    $('.typeahead_location').keyup(function () {
        var parent = $(this).parents('.form-group');
        parent.find('.location_id').val('');
    });

    if ($('input.date-pick, .date-pick-inline').length) {
        $('input.date-pick, .date-pick-inline').datepicker({
            todayHighlight: true,
            weekStart     : 1,
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
    }


    var is_single_rental     = $(".st_single_rental").length;
    var is_single_hotel_room = $(".st_single_hotel_room").length;

    if (is_single_rental > 0 || is_single_hotel_room > 0) {

    } else {
        $('.input-daterange input[name="start"]').each(function () {

            var form = $(this).closest('form');

            var me = $(this);

            $(this).datepicker({
                language      : st_params.locale,
                autoclose     : true,
                todayHighlight: true,
                startDate     : 'today',
                format        : $('[data-date-format]').data('date-format'),
                weekStart     : 1,
            }).on('changeDate', function (e) {

                var new_date = e.date;
                new_date.setDate(new_date.getDate() + 1);

                $('.input-daterange input[name="end"]', form).datepicker("remove");

                $('.input-daterange input[name="end"]', form).datepicker({
                    language      : st_params.locale,
                    startDate     : '+1d',
                    format        : $('[data-date-format]').data('date-format'),
                    autoclose     : true,
                    todayHighlight: true,
                    weekStart     : 1
                });
                $('.input-daterange input[name="end"]', form).datepicker('setDates', new_date);
                $('.input-daterange input[name="end"]', form).datepicker('setStartDate', new_date);
            });

            $('.input-daterange input[name="end"]', form).datepicker({
                language      : st_params.locale,
                startDate     : '+1d',
                format        : $('[data-date-format]').data('date-format'),
                autoclose     : true,
                todayHighlight: true,
                weekStart     : 1
            });
        });
    }


    $('.pick-up-date').each(function () {
        var form = $(this).closest('form');
        var me   = $(this);
        $(this).datepicker({
            language      : st_params.locale,
            startDate     : 'today',
            format        : $('[data-date-format]').data('date-format'),
            todayHighlight: true,
            autoclose     : true,
            weekStart     : 1
        });
        $(this).on('changeDate', function (e) {
            var new_date = e.date;
            new_date.setDate(new_date.getDate());
            $('.drop-off-date', form).datepicker('setDates', new_date);
            $('.drop-off-date', form).datepicker('setStartDate', new_date);
        });

        $('.drop-off-date', form).datepicker({
            language      : st_params.locale,
            startDate     : 'today',
            todayHighlight: true,
            autoclose     : true,
            format        : $('[data-date-format]').data('date-format'),
            weekStart     : 1
        });
    });

    if ($('.tour_book_date').length > 0 && $('.tour_book_date').val().length > 0) {
        $('.tour_book_date').datepicker(
            'setStartDate', 'today'
        );
        $('.tour_book_date').datepicker(
            'setDates', $('.tour_book_date').val()
        );
    } else {
        if ($('.tour_book_date').length) {
            $('.tour_book_date').datepicker(
                'setStartDate', 'today'
            );
            $('.tour_book_date').datepicker(
                'setDates', 'today'
            );
        }

    }

    var time_picker_arg = {
        minuteStep : 15,
        showInpunts: false,
        defaultTime: "current"
    };
    if (st_params.time_format == '12h') {
        time_picker_arg.showMeridian = true;
    } else {
        time_picker_arg.showMeridian = false;
    }
    $('input.time-pick').each(function () {
        $(this).timepicker(time_picker_arg);
    });
    $(document).on('click', '.popup-text', function (event) {
        setTimeout(function () {
            $('input.time-pick').each(function () {
                $(this).timepicker(time_picker_arg);
            });
        }, 1000);
    });
    //popup-text
    if ($('input.date-pick-years').length) {
        $('input.date-pick-years').datepicker({
            startView: 2,
            weekStart: 1
        });
    }


    $('.booking-item-price-calc .checkbox label').click(function () {
        var checkbox   = $(this).find('input'),
            // checked = $(checkboxDiv).hasClass('checked'),
            checked    = $(checkbox).prop('checked'),
            price      = parseInt($(this).find('span.pull-right').html().replace('$', '')),
            eqPrice    = $('#car-equipment-total'),
            tPrice     = $('#car-total'),
            eqPriceInt = parseInt(eqPrice.attr('data-value')),
            tPriceInt  = parseInt(tPrice.attr('data-value')),
            value,
            animateInt = function (val, el, plus) {
                value = function () {
                    if (plus) {
                        return el.attr('data-value', val + price);
                    } else {
                        return el.attr('data-value', val - price);
                    }
                };
                return $({
                    val: val
                }).animate({
                    val: parseInt(value().attr('data-value'))
                }, {
                    duration: 500,
                    easing  : 'swing',
                    step    : function () {
                        if (plus) {
                            el.text(Math.ceil(this.val));
                        } else {
                            el.text(Math.floor(this.val));
                        }
                    }
                });
            };
        if (!checked) {
            animateInt(eqPriceInt, eqPrice, true);
            animateInt(tPriceInt, tPrice, true);
        } else {
            animateInt(eqPriceInt, eqPrice, false);
            animateInt(tPriceInt, tPrice, false);
        }
    });


    $('div.bg-parallax').each(function () {
        var $obj = $(this);
        if ($(window).width() > 992) {
            $(window).scroll(function () {
                var animSpeed;
                if ($obj.hasClass('bg-blur')) {
                    animSpeed = 10;
                } else {
                    animSpeed = 15;
                }
                var yPos  = -($(window).scrollTop() / animSpeed);
                var bgpos = '50% ' + yPos + 'px';
                $obj.css('background-position', bgpos);

            });
        }
    });


    $(document).ready(
        function () {
            // Owl Carousel
            var owlCarousel       = $('#owl-carousel'),
                owlItems          = owlCarousel.attr('data-items'),
                owlCarouselSlider = $('#owl-carousel-slider, .owl-carousel-slider'),
                owlCarouselEffect = $('#owl-carousel-slider, .owl-carousel-slider').data('effect'),
                owlNav            = owlCarouselSlider.attr('data-nav');
            // owlSliderPagination = owlCarouselSlider.attr('data-pagination');
            if (owlCarousel.length) {
                owlCarousel.owlCarousel({
                    items         : owlItems,
                    navigation    : true,
                    navigationText: ['', '']
                });
            }

            if (owlCarouselSlider.length) {
                owlCarouselSlider.owlCarousel({
                    slideSpeed     : 300,
                    paginationSpeed: 400,
                    // pagination: owlSliderPagination,
                    singleItem     : true,
                    navigation     : true,
                    pagination     : false,
                    navigationText : ['', ''],
                    transitionStyle: owlCarouselEffect,
                    autoPlay       : 4500
                });
            }


            if ($('#main-footer').length) {
                // footer always on bottom
                var docHeight    = $(window).height();
                var footerHeight = $('#main-footer').height();
                var footerTop    = $('#main-footer').position().top + footerHeight;

                if (footerTop < docHeight) {
                    $('#main-footer').css('margin-top', (docHeight - footerTop) + 'px');
                }
            }

        }
    );
    fix_slider_height();
    fix_slider_height_testimonial();

    var flag_resize;
    $(window).resize(function () {
        clearTimeout(flag_resize);
        flag_resize = setTimeout(function () {
            fix_slider_height();
            fix_slider_height_testimonial();
        }, 500);

    }).resize();

    function fix_slider_height() {
        if ($("#owl-carousel-slider").length == 0) {
            return;
        }
        if ($(".bg-front .search-tabs").length != 0) {
            var need_height  = $(".bg-front .search-tabs").outerHeight(true) + 20;
            var top_position = parseInt($(".bg-front .search-tabs").css('top'), 10);
            need_height += top_position;
            $(".top-area").height(need_height);
        } else {
            var elem_height   = $(window).height() - $("#st_header_wrap").height();
            var elem_height_2 = 0.5 * $(window).height();
            if ($(".top-area").length != 0) {
                $(".top-area").height(elem_height);
            }
            if ($(".special-area").length != 0) {
                $(".special-area").height(elem_height_2);
            }
        }
    }

    function fix_slider_height_testimonial() {
        if ($(".top-area.is_form #slide-testimonial").length != 0) {
            var s_h = $(".search-tabs").height() + parseInt($(".search-tabs").css("top"), 10) + 20 + 35;
            $(".top-area.is_form").height(s_h);
        }
    }

    $(document).on('click', '#required_dropoff,.expand_search_box', function (event) {
        event.preventDefault();

        var html = $(this).html();
        $(this).html($(this).attr('data-change'));
        $(this).attr({
            'data-change': html
        });
        $(this).parent('.same_location').next(".form-drop-off ").toggleClass('field-hidden');
        var is_hidden = $(this).parent('.same_location').next(".form-drop-off ").hasClass('field-hidden');
        if (!is_hidden) {
            $('input[name="required_dropoff"]').prop('checked', false);
            $(this).parent('.same_location').next(".form-drop-off ").removeClass('field-hidden');
        } else {
            $('input[name="required_dropoff"]').prop('checked', true);
            $(this).parent('.same_location').next(".form-drop-off ").addClass('field-hidden');
        }
        setTimeout(function () {
            var h = $('.div_fleid_search_map').height();
            $('.div_btn_search_map').find('.btn_search_2').height(h);
        }, 0);
        if (typeof fix_slider_height !== 'undefined') {
            setTimeout(fix_slider_height(), 500);

        }
        if (typeof fix_slider_height_testimonial !== 'undefined') {
            setTimeout(fix_slider_height_testimonial(), 500);
        }

    });
    $("#myTab a[data-toggle='tab']").on('shown.bs.tab', function (e) {
        e.target;
        if ($(".st-slider-location").length > 0) {
            var s_h = $(".search-tabs").outerHeight(true) + 20;
            $(".top-area").height(s_h);
        }
        if ($("#slide-testimonial").length > 0) {
            var s_h = $(".search-tabs").height() + parseInt($(".search-tabs").css("top"), 10) + 20;
            $(".top-area").height(s_h);
        }
        fix_slider_height();

    });
    $(document).ready(function () {
        $('#slide-testimonial').each(function () {
            var $this = $(this);
            $this.owlCarousel({
                slideSpeed     : $(this).attr('data-speed'),
                paginationSpeed: 400,
                pagination     : false,
                itemsCustom    : [
                    [0, 1],
                    [400, 1],
                    [768, 1],
                    [1024, 1]
                ],
                navigation     : $(this).data('data-navigation'),
                navigationText : ['', ''],
                transitionStyle: $(this).data('effect'),
                autoPlay       : $this.attr('data-play')
            });
        })
    });


    $('.nav-drop').click(function () {
        if ($(this).hasClass('active-drop')) {
            $(this).removeClass('active-drop');
        } else {
            $('.nav-drop').removeClass('active-drop');
            $(this).addClass('active-drop');

        }
    });


    $(document).mouseup(function (e) {
        var container = $(".nav-drop");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $('.nav-drop').removeClass('active-drop');
        }
    });
    $(".range-slider").each(function () {
        var min  = $(this).data('min');
        var max  = $(this).data('max');
        var step = $(this).data('step');
        $(this).ionRangeSlider({
            min        : min,
            max        : max,
            from       : min,
            to         : max,
            step       : step,
            grid       : true,
            grid_snap  : true,
            prettify   : false,
            postfix    : " km",
            type       : 'double',
            force_edges: true
        });

    });
    $(".price-slider").each(function () {
        var min  = $(this).data('min');
        var max  = $(this).data('max');
        var step = $(this).data('step');

        var value = $(this).val();

        var from = value.split(';');

        var prefix_symbol = $(this).data('symbol');

        var to = from[1];
        from   = from[0];

        var arg = {
            min        : min,
            max        : max,
            type       : 'double',
            prefix     : prefix_symbol,
            //maxPostfix: "+",
            prettify   : false,
            step       : step,
            grid_snap  : true,
            grid       : true,
            onFinish   : function (data) {
                console.log(data);
                set_price_range_val(data, $('input[name="price_range"]'));
                //console.log(data);
                //console.log(window.location.href);
            },
            from       : from,
            to         : to,
            force_edges: true
        };

        //postfix
        if (st_params.currency_rtl_support == 'on') {
            delete arg.prefix;
            arg.postfix = prefix_symbol;
        }

        if (!step) {
            //delete arg.step;
            delete arg.grid_snap;
        }

        //console.log(min);
        $(this).ionRangeSlider(arg);
    });

    function set_price_range_val(data, element) {
        var exchange = 1;
        var from     = Math.round(parseInt(data.from) / exchange);
        var to       = Math.round(parseInt(data.to) / exchange);
        var text     = from + ";" + to;

        element.val(text);
    }

    $('.i-check, .i-radio').iCheck({
        checkboxClass: 'i-check',
        radioClass   : 'i-radio'
    });

    if ($('#roundtrip').prop('checked')) {
        $('#roundtrip').parents('.row').find('.form-group-transfer-end').show();
    } else {
        $('#roundtrip').parents('.row').find('.form-group-transfer-end').hide();
    }
    $('#roundtrip').on('ifChanged', function (event) {
        if ($(this).prop('checked')) {
            $(this).parents('.row').find('.form-group-transfer-end').show();
        } else {
            $(this).parents('.row').find('.form-group-transfer-end').hide();
        }
    });

    $('.transfer-map').each(function () {

        if(typeof google==='undefined') return;

        var t                 = $(this);
        var content_map       = $(".transfer-map-content", t).get(0);
        var latlng            = {lat: 0, lng: 0};
        var bounds            = new google.maps.LatLngBounds;
        var map               = new google.maps.Map(content_map, {
            zoom            : 10,
            center          : latlng,
            scrollwheel     : false,
            disableDefaultUI: true
        });
        var rendererOptions   = {preserveViewport: true, suppressMarkers: true, routeIndex: 0};
        var directionsService = new google.maps.DirectionsService;

        var routes      = [];
        var data_routes = t.data("route");
        if (typeof data_routes == 'object') {
            $.each(data_routes.routes, function (index, route) {
                var request           = {
                    origin     : new google.maps.LatLng(route.origin.lat, route.origin.lng),
                    destination: new google.maps.LatLng(route.destination.lat, route.destination.lng),
                    travelMode : google.maps.TravelMode.DRIVING
                };
                var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
                directionsDisplay.setMap(map);

                directionsService.route(request, function (result, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(result);
                        if (data_routes.routes.length > 1) {
                            if (data_routes.oneway == "oneway" && index < data_routes.routes.length - 1) {
                                var marker = new google.maps.Marker({
                                    position: new google.maps.LatLng(route.origin.lat, route.origin.lng),
                                    title   : route.origin.title,
                                    label   : route.origin.title,
                                    map     : map
                                });
                                bounds.extend(new google.maps.LatLng(route.origin.lat, route.origin.lng))
                            }
                            if (data_routes.oneway == "oneway" && index == data_routes.routes.length - 1) {
                                var marker_1 = new google.maps.Marker({
                                    position: new google.maps.LatLng(route.origin.lat, route.origin.lng),
                                    title   : route.origin.title,
                                    label   : route.origin.title,
                                    map     : map
                                });
                                bounds.extend(new google.maps.LatLng(route.origin.lat, route.origin.lng));
                                var marker_2 = new google.maps.Marker({
                                    position: new google.maps.LatLng(route.destination.lat, route.destination.lng),
                                    title   : route.destination.title,
                                    label   : route.destination.title,
                                    map     : map
                                });
                                bounds.extend(new google.maps.LatLng(route.destination.lat, route.destination.lng))
                            }
                            if (data_routes.oneway != "oneway") {
                                var marker_3 = new google.maps.Marker({
                                    position: new google.maps.LatLng(route.origin.lat, route.origin.lng),
                                    title   : route.origin.title, label: route.origin.title, map: map
                                });
                                bounds.extend(new google.maps.LatLng(route.origin.lat, route.origin.lng))
                            }
                        } else {
                            var marker_a = new google.maps.Marker({
                                position: new google.maps.LatLng(route.origin.lat, route.origin.lng),
                                title   : route.origin.title,
                                label   : route.origin.title,
                                map     : map
                            });
                            bounds.extend(new google.maps.LatLng(route.origin.lat, route.origin.lng));
                            var marker_b = new google.maps.Marker({
                                position: new google.maps.LatLng(route.destination.lat, route.destination.lng),
                                title   : route.destination.title,
                                label   : route.destination.title,
                                map     : map
                            });
                            bounds.extend(new google.maps.LatLng(route.destination.lat, route.destination.lng))
                        }
                        map.fitBounds(bounds)
                    }
                })
            });
        }
    });

    $('.form-booking-car-transfer').each(function () {
        var t       = $(this),
            parent  = t.closest('.booking-item'),
            overlay = $('.overlay-form', parent);
        $('.message', parent).attr('class', 'message').html('');

        t.submit(function (event) {
            event.preventDefault();
            overlay.fadeIn();
            var data = t.serializeArray();

            $.post(st_params.ajax_url, data, function (respon) {
                if (typeof respon == 'object') {
                    if (respon.status == 0) {
                        $('.message', parent).addClass(respon.class).html(respon.message);
                    } else {
                        window.location.href = respon.redirect;
                    }
                }
                overlay.fadeOut();
            }, 'json');
        });
    });


    $('.booking-item-review-expand').click(function (event) {
        var parent = $(this).parent('.booking-item-review-content');
        if (parent.hasClass('expanded')) {
            parent.removeClass('expanded');
        } else {
            parent.addClass('expanded');
        }
    });
    $('.expand_search_box').click(function (event) {
        var parent = $(this).parent('.search_advance');
        if (parent.hasClass('expanded')) {
            parent.removeClass('expanded');
        } else {
            parent.addClass('expanded');
        }
    });


    $('.stats-list-select > li > .booking-item-rating-stars > li').each(function () {
        var list       = $(this).parent(),
            listItems  = list.children(),
            itemIndex  = $(this).index(),
            parentItem = list.parent();

        $(this).hover(function () {
            for (var i = 0; i < listItems.length; i++) {
                if (i <= itemIndex) {
                    $(listItems[i]).addClass('hovered');
                } else {
                    break;
                }
            }
            ;
            $(this).click(function () {
                for (var i = 0; i < listItems.length; i++) {
                    if (i <= itemIndex) {
                        $(listItems[i]).addClass('selected');
                    } else {
                        $(listItems[i]).removeClass('selected');
                    }
                }
                ;

                parentItem.children('.st_review_stats').val(itemIndex + 1);

            });
        }, function () {
            listItems.removeClass('hovered');
        });
    });


    $('.booking-item-container').children('.booking-item').click(function (event) {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).parent().removeClass('active');
        } else {
            $(this).addClass('active');
            $(this).parent().addClass('active');
            $(this).delay(1500).queue(function () {
                $(this).addClass('viewed')
            });
        }
    });


    //$('.form-group-cc-number input').payment('formatCardNumber');
    //$('.form-group-cc-date input').payment('formatCardExpiry');
    //$('.form-group-cc-cvc input').payment('formatCardCVC');


    if ($('#map-canvas').length) {
        var map,
            service;
        var default_lat  = 40.7564971;
        var default_long = -73.9743277;
        if ($("#google-map-tab").attr('data-lat') && $("#google-map-tab").attr('data-long')) {
            default_lat  = ($("#google-map-tab").attr('data-lat'));
            default_long = ($("#google-map-tab").attr('data-long'));
        }
        jQuery(function ($) {
            $(document).ready(function () {
                var latlng    = new google.maps.LatLng(default_lat, default_long);
                var myOptions = {
                    zoom       : 16,
                    center     : latlng,
                    mapTypeId  : google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false
                };

                map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);


                var marker = new google.maps.Marker({
                    position: latlng,
                    map     : map
                });
                marker.setMap(map);


                $('a[href="#google-map-tab"]').on('shown.bs.tab', function (e) {
                    google.maps.event.trigger(map, 'resize');
                    map.setCenter(latlng);
                });
            });
        });
    }


    $('.card-select > li').click(function () {
        var self = this;
        $(self).addClass('card-item-selected');
        $(self).siblings('li').removeClass('card-item-selected');
        $('.form-group-cc-number input').click(function () {
            $(self).removeClass('card-item-selected');
        });
    });
    // Lighbox gallery
    $('.popup-gallery').each(function () {
        $(this).magnificPopup({
            delegate: 'a.popup-gallery-image',
            type    : 'image',
            gallery : {
                enabled: true
            }
        });
    });

    $('.st-popup-gallery').each(function () {
        $(this).magnificPopup({
            delegate: '.st-gp-item',
            type    : 'image',
            gallery : {
                enabled: true
            }
        });
    });

    // Lighbox image
    if ($('.popup-image').length) {
        $('.popup-image').magnificPopup({
            type: 'image'
        });
    }


    // Lighbox text
    if ($('.popup-text').length) {
        $('.popup-text').magnificPopup({
            removalDelay  : 500,
            closeBtnInside: true,
            callbacks     : {
                beforeOpen: function () {
                    this.st.mainClass = this.st.el.attr('data-effect');
                }
            },
            midClick      : true
        });
    }


    // Lightbox iframe
    if ($('.popup-iframe').length) {
        $('.popup-iframe').magnificPopup({
            dispableOn  : 700,
            type        : 'iframe',
            removalDelay: 160,
            mainClass   : 'mfp-fade',
            preloader   : false
        });
    }

    $('.form-group-select-plus').each(function () {
        var self     = $(this),
            btnGroup = self.find('.btn-group').first(),
            select   = self.find('select');

        if (btnGroup.children('label').last().index() == 3) {
            btnGroup.children('label').last().click(function () {
                btnGroup.addClass('hidden');
                select.removeClass('hidden');
            });
        }

        btnGroup.children('label').click(function () {
            var c = $(this);
            select.find('option[value=' + c.children('input').val() + ']').prop('selected', 'selected');
            if (!c.hasClass('active'))
                select.trigger('change');
        });
    });

    $(document).ready(function () {
        var ul     = $('#twitter-ticker').find(".tweet-list");
        var ticker = function () {
            setTimeout(function () {
                ul.find('li:first').animate({
                    marginTop: '-4.7em'
                }, 850, function () {
                    $(this).detach().appendTo(ul).removeAttr('style');
                });
                ticker();
            }, 5000);
        };
        ticker();
    });
    $(function () {

        $('.ri-grid').each(function () {
            var $girl_ri = $(this);
            if ($.fn.gridrotator !== undefined) {
                $girl_ri.gridrotator({
                    rows        : $girl_ri.attr('data-row'),
                    columns     : $girl_ri.attr('data-col'),
                    animType    : 'random',
                    animSpeed   : 1200,
                    interval    : $girl_ri.attr('data-speed'),
                    step        : 'random',
                    preventClick: false,
                    maxStep     : 2,
                    w992        : {
                        rows   : 5,
                        columns: 4
                    },
                    w768        : {
                        rows   : 6,
                        columns: 3
                    },
                    w480        : {
                        rows   : 8,
                        columns: 3
                    },
                    w320        : {
                        rows   : 8,
                        columns: 2
                    },
                    w240        : {
                        rows   : 6,
                        columns: 4
                    }
                });
            }
        });
    });


    $(function () {
        if ($.fn.gridrotator !== undefined) {
            $('#ri-grid-no-animation').gridrotator({
                rows     : 4,
                columns  : 8,
                slideshow: false,
                w1024    : {
                    rows   : 4,
                    columns: 6
                },
                w768     : {
                    rows   : 3,
                    columns: 3
                },
                w480     : {
                    rows   : 4,
                    columns: 4
                },
                w320     : {
                    rows   : 5,
                    columns: 4
                },
                w240     : {
                    rows   : 6,
                    columns: 4
                }
            });
        }

    });

    var tid = setInterval(tagline_vertical_slide, 2500);

    // vertical slide
    function tagline_vertical_slide() {
        $('.div_tagline').each(function () {
            var curr = $(this).find(".tagline ul li.active");
            curr.removeClass("active").addClass("vs-out");
            setTimeout(function () {
                curr.removeClass("vs-out");
            }, 500);

            var nextTag = curr.next('li');
            if (!nextTag.length) {
                nextTag = $(this).find(".tagline ul li").first();
            }
            nextTag.addClass("active");
        });

    }

    function abortTimer() { // to be called when you want to stop the timer
        clearInterval(tid);
    }

    $('#submit').addClass('btn btn-primary');


    //Button Like Review
    $('.st-like-review').click(function (e) {

        e.preventDefault();

        var me = $(this);


        if (!me.hasClass('loading')) {
            var comment_id = me.data('id');
            var loading    = $('<i class="loading_icon fa fa-spinner fa-spin"></i>');

            me.addClass('loading');
            me.before(loading);

            $.ajax({

                url     : st_params.ajax_url,
                type    : 'post',
                dataType: 'json',
                data    : {
                    action    : 'like_review',
                    comment_ID: comment_id
                },
                success : function (res) {
                    if (res.status) {
                        if (res.data.like_status) {
                            me.addClass('fa-thumbs-o-down').removeClass('fa-thumbs-o-up');
                        } else {
                            me.addClass('fa-thumbs-o-up').removeClass('fa-thumbs-o-down');
                        }

                        if (typeof res.data.like_count != undefined) {
                            res.data.like_count = parseInt(res.data.like_count);
                            me.parent().find('.text-color .number').html(' ' + res.data.like_count);
                        }
                    } else {
                        if (res.error.error_message) {
                            alert(res.error.error_message);
                        }
                    }
                    me.removeClass('loading');
                    loading.remove();
                },
                error   : function (res) {
                    console.log(res);
                    alert('Ajax Faild');
                    me.removeClass('loading');
                    loading.remove();
                }
            });
        }


    });

    //Button Like Review
    $('.st-like-comment').click(function (e) {

        e.preventDefault();

        var me = $(this);


        if (!me.hasClass('loading')) {
            var comment_id = me.data('id');
            var loading    = $('<i class="loading_icon fa fa-spinner fa-spin"></i>');

            me.addClass('loading');
            me.before(loading);

            $.ajax({

                url     : st_params.ajax_url,
                type    : 'post',
                dataType: 'json',
                data    : {
                    action    : 'like_review',
                    comment_ID: comment_id
                },
                success : function (res) {
                    console.log(res);
                    if (res.status) {
                        if (res.data.like_status) {
                            me.addClass('fa-heart').removeClass('fa-heart-o');
                        } else {
                            me.addClass('fa-heart-o').removeClass('fa-heart');
                        }

                        if (typeof res.data.like_count != undefined) {
                            res.data.like_count = parseInt(res.data.like_count);
                            me.next('.text-color').html(' ' + res.data.like_count);
                        }
                    } else {
                        if (res.error.error_message) {
                            alert(res.error.error_message);
                        }
                    }
                    me.removeClass('loading');
                    loading.remove();
                },
                error   : function (res) {
                    console.log(res);
                    alert('Ajax Faild');
                    me.removeClass('loading');
                    loading.remove();
                }
            });
        }


    });


    if( $('.booking-item-price-calc .equipment').length){
        // vc-element cars

        $('.booking-item-price-calc .equipment').on('ifChanged', function(event) {

            var price_total_item = 0;
            var price_convert_total_item = 0;
            var person_ob = new Object();
            var list_selected_equipment = [];
            var $total_price_equipment = 0;
            var $start_timestamp = $('.car_booking_form [name=check_in_timestamp]').val();
            var $end_timestamp = $('.car_booking_form [name=check_out_timestamp]').val();

            $('.singe_cars').find('.equipment').each(function(event) {
                if ($(this)[0].checked == true) {
                    var price = str2num($(this).attr('data-price'));
                    var price_max = str2num($(this).attr('data-price-max'));
                    var num = 1;
                    var parent = $(this).closest('.equipment-list');
                    if( $('select[name="number_equipment"]', parent).length ){
                        num = parseInt($('select[name="number_equipment"]', parent).val());
                    }

                    person_ob[$(this).attr('data-title')] = str2num($(this).attr('data-price')) * num;
                    //alert($(this).data('price-unit'));
                    price_total_item = price_total_item + ((str2num($(this).attr('data-price')) * num) * $(this).data('number-unit'));
                    price_convert_total_item              = price_convert_total_item + (str2num($(this).attr('data-convert-price')) * num * $(this).data('number-unit'));
                    list_selected_equipment.push({
                        title: $(this).attr('data-title'),
                        price: str2num($(this).attr('data-price')),
                        price_unit: $(this).data('price-unit'),
                        price_max: $(this).data('price-max'),
                        number_item: num
                    });
                    var item_price = get_amount_by_unit(str2num($(this).attr('data-price')) * num, $(this).data('price-unit'), $start_timestamp, $end_timestamp);
                    if (item_price > price_max && price_max > 0) {
                        item_price = price_max;
                    }
                    $total_price_equipment += item_price;
                }
            });
            $('.data_price_items').val(JSON.stringify(person_ob));
            $('.st_selected_equipments').val(JSON.stringify(list_selected_equipment));

            var total = 0;
            for(var i = 0; i < list_selected_equipment.length; i++){

            }

            var price_total = price_convert_total_item + str2num($('.st_cars_price').attr('data-value'));


            var regular_price = $('.car_booking_form [name=price]').val();
            var price_time = $('.car_booking_form [name=time]').val();
            var price_unit = $('.car_booking_form [name=price_unit]').val();
            var price_rate = $('.car_booking_form [name=price_rate]').val();
            regular_price = parseFloat(regular_price);
            price_time = parseFloat(price_time);

            var sub_total = $('.car_booking_form .st_cars_price').data('value');

            //$('.st_data_car_equipment_total').html(format_money(price_total_item));
            $('.st_data_car_equipment_total').html(format_money(price_convert_total_item));
            $('.st_data_car_total').html(format_money((price_total)));
            $('.data_price_total').val(price_total);

        });

        $('.booking-item-price-calc select[name="number_equipment"]').each(function(){
            var t = $(this);
            t.change(function(){

                var price_total_item = 0;
                var price_convert_total_item = 0;
                var person_ob = new Object();
                var list_selected_equipment = [];
                var $total_price_equipment = 0;
                var $start_timestamp = $('.car_booking_form [name=check_in_timestamp]').val();
                var $end_timestamp = $('.car_booking_form [name=check_out_timestamp]').val();
                var $start_timestamp = $('.car_booking_form [name=check_in_timestamp]').val();
                var $end_timestamp = $('.car_booking_form [name=check_out_timestamp]').val();

                $('.singe_cars').find('.equipment').each(function(event) {
                    if ($(this)[0].checked == true) {
                        var price = str2num($(this).attr('data-price'));
                        var price_max = str2num($(this).attr('data-price-max'));
                        var num = 1;
                        var parent = $(this).closest('.equipment-list');
                        if( $('select[name="number_equipment"]', parent).length ){
                            num = parseInt($('select[name="number_equipment"]', parent).val());
                        }

                        person_ob[$(this).attr('data-title')] = str2num($(this).attr('data-price')) * num;
                        price_total_item = price_total_item + (str2num($(this).attr('data-price')) * num * $(this).data('number-unit'));
                        price_convert_total_item              = price_convert_total_item + (str2num($(this).attr('data-convert-price')) * num * $(this).data('number-unit'));
                        list_selected_equipment.push({
                            title: $(this).attr('data-title'),
                            price: str2num($(this).attr('data-price')),
                            price_unit: $(this).data('price-unit'),
                            price_max: $(this).data('price-max'),
                            number_item: num
                        });
                        var item_price = get_amount_by_unit(str2num($(this).attr('data-price')) * num, $(this).data('price-unit'), $start_timestamp, $end_timestamp);
                        if (item_price > price_max && price_max > 0) {
                            item_price = price_max;
                        }
                        $total_price_equipment += item_price;
                    }
                });
                $('.data_price_items').val(JSON.stringify(person_ob));
                $('.st_selected_equipments').val(JSON.stringify(list_selected_equipment));

                var price_total = price_convert_total_item + str2num($('.st_cars_price').attr('data-value'));

                var regular_price = $('.car_booking_form [name=price]').val();
                var price_time = $('.car_booking_form [name=time]').val();
                var price_unit = $('.car_booking_form [name=price_unit]').val();
                var price_rate = $('.car_booking_form [name=price_rate]').val();
                regular_price = parseFloat(regular_price);
                price_time = parseFloat(price_time);

                var sub_total = $('.car_booking_form .st_cars_price').data('value');

                //$('.st_data_car_equipment_total').html(format_money(price_total_item ));
                $('.st_data_car_equipment_total').html(format_money(price_convert_total_item ));
                $('.st_data_car_total').html(format_money(price_total));
                $('.data_price_total').val(price_total);

            });

        });
    }

    function get_amount_by_unit($amount, $unit, $start_timestamp, $end_timestamp) {
        var time_diff, $hour_diff;
        var hour = time_diff = $end_timestamp - $start_timestamp;
        if (hour <= 0) {
            hour = 0;
        } else {
            hour = Math.ceil(hour / 3600 / 24);
        }
        if (st_single_car.check_booking_days_included) {
            hour++;
        }
        switch ($unit) {
            case "day":
            case "per_day":
                $amount *= (hour);
                break;
            case "hour":
            case "per_hour":
                $hour_diff = Math.ceil(time_diff / 3600);
                if (st_single_car.check_booking_days_included) {
                    $hour_diff++;
                }

                $amount *= $hour_diff;
                break;
        }
        return $amount;
    }

    function format_money($money) {

        if (!$money) {
            return st_params.free_text;
        }
        //if (typeof st_params.booking_currency_precision && st_params.booking_currency_precision) {
        //    $money = Math.round($money).toFixed(st_params.booking_currency_precision);
        //}

        $money            = st_number_format($money, st_params.booking_currency_precision, st_params.decimal_separator, st_params.thousand_separator);
        var $symbol       = st_params.currency_symbol;
        var $money_string = '';

        switch (st_params.currency_position) {
            case "right":
                $money_string = $money + $symbol;
                break;
            case "left_space":
                $money_string = $symbol + " " + $money;
                break;

            case "right_space":
                $money_string = $money + " " + $symbol;
                break;
            case "left":
            default:
                $money_string = $symbol + $money;
                break;
        }

        return $money_string;
    }

    function st_number_format(number, decimals, dec_point, thousands_sep) {


        number         = (number + '')
            .replace(/[^0-9+\-Ee.]/g, '');
        var n          = !isFinite(+number) ? 0 : +number,
            prec       = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep        = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec        = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s          = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                        .toFixed(prec);
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s              = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
            .split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '')
                .length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1)
                .join('0');
        }
        return s.join(dec);
    }

    function str2num(val) {
        val = '0' + val;
        val = parseFloat(val);
        return val;
    }

    $('.share li>a').click(function () {
        var href = $(this).attr('href');
        if (href && $(this).hasClass('no-open') == false) {


            popupwindow(href, '', 600, 600);
            return false;
        }
    });

    function popupwindow(url, title, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top  = (screen.height / 2) - (h / 2);
        return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }

    $('.social_login_nav_drop .login_social_link').click(function () {
        var href = $(this).attr('href');

        popupwindow(href, '', 600, 450);
        return false;
    });

    $(document).on('click', '.social_login_nav_drop .login_social_link', function (event) {

        var href = $(this).attr('href');

        popupwindow(href, '', 600, 450);
        return false;

    });


    $('.btn_show_year').click(function () {
        $('.head_control a').removeClass('active');
        $(this).addClass("active");
        $(".st_reports").show(1000);
    });
    if ($('.btn_show_year').hasClass('active')) {
        $(".st_reports").show(1000);
    }
    ;

    var activity_booking_form = $('.activity_booking_form');
    var message_box           = $('.activity_booking_form .message_box');

    $('.activity_booking_form input[type=submit]').click(function () {
        if (validate_activity_booking()) {
            activity_booking_form.submit();
        } else {
            return false;
        }
    });
    activity_booking_form.find('.check_in').each(function () {
        $(this).datepicker(
            'setDates', 'today'
        );
    });

    function validate_activity_booking() {
        var form_validate = true;
        message_box.html('');
        message_box.removeClass('alert');
        var check_in  = activity_booking_form.find('.check_in').val();
        var check_out = activity_booking_form.find('.check_out').val();
        try {
            if (check_in.length > 0 && check_out.length > 0) {
                form_validate = true;
            } else {
                form_validate = false;
                message_box.html('<div class="alert alert-danger">' + st_hotel_localize.is_not_select_date + '</div>');
            }

        } catch (e) {
            console.log(e);
        }
        return form_validate;
    }

    //$('.bg-video').hide();
    setTimeout(function () {
        $('.bg-video').show().css('display', 'block');
    }, 2000);
    $(window).load(function () {
        $('.bg-video').show().css('display', 'block');
    });

    $(document).on('click', '.add-item-to-wishlist', function (e) {
        e.preventDefault();
        var me = $(this);
        var post_id = me.data('id');
        var post_type = me.data('post_type');
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: {
                action: "st_add_wishlist",
                data_id: post_id,
                data_type: post_type
            },
            dataType: "json",
            beforeSend: function() {
                me.addClass('loading');
            }
        }).done(function(html) {
            me.removeClass('loading');
            me.find('i').remove();
            me.append(html.icon);
            me.append('<i class="fa fa-spinner loading""></i>');
            me.attr("data-original-title", html.title);
        });
    });
});
// VC element filter
jQuery(document).ready(function ($) {

    $('.form-custom-taxonomy .item_tanoxomy').on('ifClicked', function (event) {
        var $this  = $(this);
        var $value = '';
        $this.parent().parent().parent().parent().parent().find('.item_tanoxomy').each(function () {
            var $this2 = $(this);
            setTimeout(function () {
                if ($this2.prop('checked')) {
                    $value += $this2.val() + ",";
                }
            }, 100);
        });

        setTimeout(function () {
            console.log($value);
            $this.parent().parent().parent().parent().parent().find('.data_taxonomy').val($value);
            //$('.form-custom-taxonomy .data_taxonomy').val($value);
        }, 200)

    });


});
//List rental room
jQuery(document).ready(function ($) {
    if ($('.st_list_rental_room').length) {
        $('.st_list_rental_room').owlCarousel({
            items         : 4,
            navigation    : true,
            navigationText: ['', ''],
            slideSpeed    : 1000
        });
    }

});
jQuery(window).load(function () {
    // fix safari video display
    window.setTimeout(function () {
        jQuery('.bg-video').css("display", "table");
    }, 2000);
});
jQuery(function ($) {
    //.owl_carousel_style2 , .owl_carousel_style2 * {height: 100%;}
    if ($(".owl_carousel_style2").length > 0) {

        var h = $(window).height();
        if ($(".room_bgr_with_form").height() > 0) {
            h = $(".room_bgr_with_form").height();
        }
        var pos = $(".owl_carousel_style2").css("position");
        if (pos === "absolute") {
            h += $("#menu2").height();
        }

        $(".owl_carousel_style2").height(h);
    }
    if ($(window).width() > 1024) {
        var sheight = ($(window).height() - $(".form_bottom").height());
        //var sheight = $(window).height();
        $(".top-are-fix").height(sheight);
    }

});
/* woocommerce cart */
jQuery(document).ready(function ($) {

    $(document).on('click', '._show_wc_cart_item_information_btn', function (event) {
        event.preventDefault();
        var hide_content = ($(this).attr('data-hide'));
        var content      = $(this).html();
        $(this).attr({
            'data-hide': content
        });
        $(this).html(hide_content);
    });
});
jQuery(document).ready(function ($) {
    $(".search_advance:not(.expanded) input,.search_advance:not(.expanded) select").attr({
        "disabled": "disabled"
    });
    $(document).on('click', '.search_advance', function (event) {
        event.preventDefault();
        var is_expanded = $(this).hasClass('expanded');
        if (is_expanded) {
            $(this).find("select, input").removeAttr('disabled');
        } else {
            $(this).find("select, input").attr({
                "disabled": "disabled"
            });
        }
    });

    /* Check required validate form search*/

    $('form.main-search').submit(function (event) {
        var validate = true;
        $('input.required, select.required, textarea.required', this).each(function (index, el) {
            console.log($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('error');
                $(this).closest('.form-group').find('.bootstrap-select').addClass('error');
                if (validate) validate = false;
            } else {
                $(this).removeClass('error');
                $(this).closest('.form-group').find('.bootstrap-select').removeClass('error');
            }
        });

        if (!validate) {
            return false;
        }
        return true;
    });


    $('.register_form .st_register_service').on('ifChecked', function (event) {
        var $content = $(this).parent().parent().parent().parent().parent();
        $content.find(".col-md-7").show(500);
        $content.find(".col-md-2").show(500);
    });
    $('.register_form .st_register_service').on('ifUnchecked', function (event) {

        var $content = $(this).parent().parent().parent().parent().parent();
        $content.find(".col-md-7").hide(500);
        $content.find(".col-md-2").hide(500);
    });

    $('.register_form .st_register_service').on('ifClicked', function (event) {
        var $this    = $(this);
        var is_check = false;
        $this.parent().parent().parent().parent().parent().parent().find('.st_register_service').each(function () {
            var $this2 = $(this);
            setTimeout(function () {
                console.log($this2.prop('checked'));
                if ($this2.prop('checked') == true) {
                    is_check = true;
                }
            }, 100)
        });
        setTimeout(function () {
            console.log(is_check);
            if (is_check == true) {
                $this.parent().parent().parent().parent().parent().parent().find('.col-md-8').show();
            } else {
                $this.parent().parent().parent().parent().parent().parent().find('.col-md-8').hide();
            }
        }, 200)

    });


    var is_check = false;
    $('.register_form').find('.st_register_service').each(function () {
        var $this2 = $(this);
        setTimeout(function () {
            console.log($this2.prop('checked'));
            if ($this2.prop('checked') == true) {
                is_check = true;
            }
        }, 100)
    });
    setTimeout(function () {
        //console.log(is_check);
        if (is_check == true) {
            $('.register_form').find('.col-md-8').show();
        } else {
            $('.register_form').find('.col-md-8').hide();
        }
    }, 200);


    $('.register_form').find('.st_register_service').each(function () {
        var $this2 = $(this);
        setTimeout(function () {
            console.log($this2.prop('checked'));
            if ($this2.prop('checked') == true) {
                var $content = $this2.parent().parent().parent().parent().parent();
                $content.find(".col-md-7").show(500);
                $content.find(".col-md-2").show(500);
            }
        }, 100)
    });

    $(".btn_partner_send_email_user").click(function () {
        var container = $(this).parent().parent().parent();
        var name      = container.find(".name").val();
        var email     = container.find(".email").val();
        var content   = container.find(".message").val();
        var user_id   = container.find(".user_id").val();
        var check     = true;
        if (name == "") {
            container.find(".name").css("border-color", 'red');
            check = false;
        } else {
            container.find(".name").css("border-color", '#ccc');
            check = true;
        }
        if (email == "") {
            check = false;
            container.find(".email").css("border-color", 'red');
        } else {
            container.find(".email").css("border-color", '#ccc');
            check = true;
        }
        if (content == "") {
            check = false;
            container.find(".message").css("border-color", 'red');
        } else {
            container.find(".message").css("border-color", '#ccc');
            check = true;
        }
        if (check == true) {
            container.find(".ajax_loader").show();
            ;
            $.ajax({
                url     : st_params.ajax_url,
                type    : 'post',
                dataType: 'json',
                data    : {
                    action    : 'send_email_for_user_partner',
                    st_name   : name,
                    st_email  : email,
                    st_content: content,
                    user_id   : user_id
                },
                success : function (res) {
                    console.log(res);
                    container.find(".ajax_loader").hide();
                    ;
                    container.find(".msg").html(res.msg);
                    ;

                    //me.removeClass('loading');
                    // loading.remove();
                },
                error   : function (res) {

                }
            });
        }
    });
    if ($(".st_social_login_success_check").length > 0) {
        window.opener.location.reload();
        window.close();
    }
    ;
    $('.tours-filters input[type=checkbox],.hotel-filters input[type=checkbox],.hotel-filters input[type=checkbox],.tours-filters input[type=checkbox]').on('ifClicked', function (event) {
        var url = $(this).data('url');
        if (url) {
            window.location.href = url;
        }
    });
    $('.cars-filters input[type=checkbox]').on('ifClicked', function (event) {
        var url = $(this).attr('data-url');
        if (url) {
            window.location.href = url;
        }
    });

    //login
    $('.st_login_form_popup').on('submit', function (e) {

        e.preventDefault();

        $.ajax({
            url       : st_params.ajax_url,
            type      : "POST",
            data      : {
                'action'       : 'st_login_popup',
                'user_login'   : $(this).find('#pop-login_name').attr('value'),
                'user_password': $(this).find('#pop-login_password').attr('value')
            },
            dataType  : "json",
            beforeSend: function () {
                $('.btn-submit-form img').show();
            },
            complete  : function (res) {
                var data = res.responseText;
                data     = $.parseJSON(data);
                $('.btn-submit-form img').hide();
                if (data.error) {
                    $('.notice_login').html(data.message);
                    $('.popup_forget_pass').show();
                } else {
                    window.location.href = data.need_link;
                }
            },
            error     : function (msg) {

            }
        });

    });

    function convert_arr(data, action) {
        var res       = {};
        res['action'] = action;
        $.each(data, function (index, item) {
            res[item.name] = item.value;
        });
        return res;
    }

    //Register
    $('.register_form_popup').on('submit', function (e) {

        e.preventDefault();
        var data_form = $('.register_form_popup').serializeArray();
        var formData  = new FormData($('.register_form_popup')[0]);
        $.ajax({
            url        : st_params.ajax_url,
            type       : "POST",
            data       : formData,
            dataType   : "json",
            processData: false,
            contentType: false,
            beforeSend : function () {
                $('.btn-submit-form img').show();
            },
            complete   : function (res) {
                var data = res.responseText;
                data     = $.parseJSON(data);
                $('.btn-submit-form img').hide();

                $('.notice_register').html(data.notice);
                if (!data.error) {
                    $(".register_form_popup .data_field :input[type=text]").each(function () {
                        $(this).val('');
                    });
                    $(".register_form_popup .data_field :input[type=password]").each(function () {
                        $(this).val('');
                    });
                    $(".data_image_certificates").each(function () {
                        $(this).html('');
                    });
                }

            },
            error      : function (msg) {

            }
        });

    });
});
/*flick */
jQuery(document).ready(function ($) {
    $('.flickr_items').each(function () {

        var user_id = $(this).data('uid');
        var me      = $(this);
        var num     = $(this).data('num');
        console.log(num);
        if (user_id) {
            $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id=" + user_id + "&format=json&jsoncallback=?", function (data) {
                for (var i = 0; i <= num; i++) {
                    var pic      = data.items[i];
                    var smallpic = pic.media.m.replace('_m.jpg', '_s.jpg');
                    console.log(i);
                    var item = $("<li><a title='" + pic.title + "' href='" + pic.link + "' target='_blank'><img width=\"75px\" height=\"75px\" src='" + smallpic + "' /></a></li>");
                    me.append(item);
                }
            });
        }
    });
});

jQuery(document).ready(function ($) {
    /*  Show mini cart */
    $('#show-mini-cart-button').click(function (event) {
        /* Act on the event */
        $(this).parent().find('.traveler-cart-mini').toggleClass('open');
        return false;
    });

    $('.i-check').on('ifChanged', function () {
        var t = $(this);
        setTimeout(function () {
            var url = t.data('url');
            console.log(url);
            if (url) {
                window.location.href = url;
            }
        }, 500);
    });
});
jQuery(document).ready(function ($) {
    $('input.required-field').each(function (index, el) {
        var form = $(this).parents('form');
        //console.log($(this).prop('checked'));
        if ($(this).prop('checked') == true) {
            $('.form-drop-off', form).addClass('field-hidden');
        } else {
            $('.form-drop-off', form).removeClass('field-hidden');
        }
    });

    jQuery(window).bind("load", function ($) {
        fix_weather_();
    });
    jQuery(window).resize(function ($) {
        fix_weather_();
        full_height_init();
        full_width_init();
    });
    function fix_weather_() {
        var e = $(".top-user-area").parent(".get_location_weather");
        e.remove();
        if ($(window).width() <= 992) {
            $(".menu_div").after(e);
        } else {
            $(".slimmenu-menu-collapser").parent(".nav").parent(".col-lg-8").after(e);
        }
    }

    function full_width_init() {
        var ww   = $(window).width();
        var left = (ww - 1170 + 30) / 2;
        if (ww < 1380) {
            left = (ww - 1170 + 30) / 2;
        }
        if (ww < 1199) {
            left = (ww - 970 + 30) / 2;
        }
        if (ww < 991) {
            left = (ww - 750 + 30) / 2;
        }
        if (ww < 767) {
            left = 15;
        }
        $('.st-new-fullwidth').css({'width': ww + 'px', 'left': '-' + left + 'px', position: 'relative'});
    }

    full_width_init();

    function full_height_init() {
        var wh          = $(window).height();
        var hh          = $('#st_header_wrap').height();
        var full_height = wh - hh;
        if ($('#wpadminbar').length > 0) {
            full_height = full_height - $('#wpadminbar').height();
        }
        if (full_height < 480) {
            full_height = 480;
        }

        $('.st-full-height').css({height: full_height + 'px'});
    }

    full_height_init();

    $(window).load(function () {
        if ($('.tour-gallery').length > 0) {
            var owl = $('.tour-gallery');
            owl.owlCarousel({
                items            : 1,
                center           : true,
                loop             : true,
                autoPlay         : 7000,
                itemsDesktop     : [1199, 1],
                itemsDesktopSmall: [979, 1],
                itemsTablet      : [768, 1],
                itemsTabletSmall : false,
                itemsMobile      : [479, 1],
                dots             : false

            });
            owl.parent().find(".owl-prev").click(function () {
                owl.trigger('owl.prev');
            });
            owl.parent().find(".owl-next").click(function () {
                owl.trigger('owl.next');
            });
        }
    });


    $('.on_the_map .btn-on-map').each(function () {
        $(this).on('click', function (e) {
            e.preventDefault();

            var p = $(this).parent().parent();
            $(this).toggleClass('active');
            if ($(this).hasClass('active')) {
                $(this).text($(this).data('hide'));
            } else {
                $(this).text($(this).data('no-hide'));
            }
            p.find('.st-tour-map').toggleClass('st-hide');
            p.find('.review-price').toggleClass('active');
        });
    });
    //Map new
    function selectStyle(name) {
        var style = [];
        if (name == 'style_normal') {
            style = [{
                featureType: "road.highway",
                elementType: "geometry",
                stylers    : [{saturation: 60}, {lightness: -20}]
            }];
        }
        if (name == 'style_midnight') {
            style = [{
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers"    : [{"saturation": 36}, {"color": "#000000"}, {"lightness": 40}]
            }, {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"visibility": "on"}, {"color": "#000000"}, {"lightness": 16}]
            }, {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers"    : [{"color": "#000000"}, {"lightness": 20}]
            }, {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers"    : [{"color": "#000000"}, {"lightness": 17}, {"weight": 1.2}]
            }, {
                "featureType": "administrative.country",
                "elementType": "labels",
                "stylers"    : [{"visibility": "on"}, {"lightness": "0"}]
            }, {
                "featureType": "administrative.country",
                "elementType": "labels.text.fill",
                "stylers"    : [{"visibility": "on"}, {"lightness": "13"}]
            }, {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers"    : [{"color": "#000000"}, {"lightness": 20}]
            }, {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers"    : [{"color": "#000000"}, {"lightness": 21}]
            }, {
                "featureType": "road",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}, {"saturation": "-100"}, {"lightness": "-20"}, {"invert_lightness": true}]
            }, {
                "featureType": "road",
                "elementType": "geometry.stroke",
                "stylers"    : [{"color": "#bebebe"}]
            }, {
                "featureType": "road",
                "elementType": "labels.text.fill",
                "stylers"    : [{"visibility": "on"}, {"lightness": "-47"}]
            }, {
                "featureType": "road",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"lightness": "-33"}, {"weight": "0.52"}]
            }, {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}, {"color": "#b5b5b5"}, {"saturation": "-1"}, {"gamma": "0.00"}, {"weight": "2.22"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers"    : [{"lightness": "0"}, {"visibility": "on"}, {"weight": "2.8"}, {"color": "#585858"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers"    : [{"color": "#909090"}, {"lightness": "2"}, {"weight": "0.2"}, {"visibility": "off"}]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.text.fill",
                "stylers"    : [{"lightness": "16"}, {"color": "#595959"}]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"lightness": "-63"}, {"weight": "1"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers"    : [{"color": "#000000"}, {"lightness": 18}, {"visibility": "on"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers"    : [{"visibility": "on"}, {"lightness": "10"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "labels.text.fill",
                "stylers"    : [{"visibility": "on"}, {"lightness": "28"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"visibility": "on"}, {"weight": "0.1"}, {"lightness": "-96"}]
            }, {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers"    : [{"color": "#000000"}, {"lightness": 16}]
            }, {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers"    : [{"color": "#000000"}, {"lightness": 19}]
            }, {
                "featureType": "water",
                "elementType": "geometry",
                "stylers"    : [{"color": "#12161a"}, {"lightness": 17}]
            }];
        }
        if (name == 'style_family_fest') {
            style = [{
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers"    : [{"color": "#444444"}]
            }, {
                "featureType": "landscape",
                "elementType": "all",
                "stylers"    : [{"color": "#f2f2f2"}]
            }, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]}, {
                "featureType": "poi",
                "elementType": "geometry.fill",
                "stylers"    : [{"visibility": "on"}, {"saturation": "-6"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry.stroke",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "poi",
                "elementType": "labels",
                "stylers"    : [{"visibility": "on"}, {"weight": "1.30"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.text",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.text.fill",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.icon",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "road",
                "elementType": "all",
                "stylers"    : [{"saturation": -100}, {"lightness": 45}]
            }, {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "labels.icon",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "transit",
                "elementType": "all",
                "stylers"    : [{"visibility": "off"}]
            }, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#52978e"}, {"visibility": "on"}]}];
        }
        if (name == 'style_open_dark') {
            style = [{
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers"    : [{"color": "#ffffff"}]
            }, {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"visibility": "on"}, {"color": "#3e606f"}, {"weight": 2}, {"gamma": 0.84}]
            }, {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "administrative",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "administrative",
                "elementType": "geometry",
                "stylers"    : [{"weight": 0.6}, {"color": "#1a3541"}]
            }, {
                "featureType": "landscape",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}, {"color": "#293c4d"}]
            }, {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers"    : [{"color": "#2c5a71"}]
            }, {
                "featureType": "landscape",
                "elementType": "geometry.fill",
                "stylers"    : [{"color": "#293c4d"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers"    : [{"color": "#406d80"}]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers"    : [{"color": "#2c5a71"}]
            }, {"featureType": "road", "elementType": "all", "stylers": [{"visibility": "on"}]}, {
                "featureType": "road",
                "elementType": "geometry",
                "stylers"    : [{"color": "#1f3035"}, {"lightness": -37}]
            }, {
                "featureType": "road",
                "elementType": "labels",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "transit",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers"    : [{"color": "#406d80"}]
            }, {
                "featureType": "transit",
                "elementType": "labels.icon",
                "stylers"    : [{"hue": "#00d1ff"}]
            }, {"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#193341"}]}];
        }
        if (name == 'style_riverside') {
            style = [{
                "featureType": "administrative",
                "elementType": "all",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "administrative",
                "elementType": "labels",
                "stylers"    : [{"visibility": "on"}, {"color": "#716464"}, {"weight": "0.01"}]
            }, {
                "featureType": "administrative.country",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "administrative.country",
                "elementType": "labels",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "administrative.country",
                "elementType": "labels.text",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "landscape",
                "elementType": "all",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "landscape.natural",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "landscape.natural.landcover",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi",
                "elementType": "all",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry.fill",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry.stroke",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.text",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.text.fill",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi.attraction",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "poi.business",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "poi.business",
                "elementType": "geometry.fill",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "poi.government",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "poi.school",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "road",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers"    : [{"visibility": "on"}, {"color": "#787878"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers"    : [{"visibility": "simplified"}, {"color": "#a05519"}, {"saturation": "-13"}]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.text",
                "stylers"    : [{"color": "#fcfcfc"}, {"visibility": "on"}]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.text.fill",
                "stylers"    : [{"color": "#636363"}]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"weight": "4.27"}, {"color": "#ffffff"}]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.icon",
                "stylers"    : [{"visibility": "on"}, {"weight": "0.01"}]
            }, {
                "featureType": "road.local",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "transit",
                "elementType": "all",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "transit.station",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "water",
                "elementType": "all",
                "stylers"    : [{"visibility": "simplified"}, {"color": "#84afa3"}, {"lightness": 52}]
            }, {
                "featureType": "water",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers"    : [{"visibility": "on"}, {"color": "#7ca0a4"}]
            }, {"featureType": "water", "elementType": "labels.text.fill", "stylers": [{"color": "#ffffff"}]}];
        }
        if (name == 'style_ozan') {
            style = [{
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers"    : [{"visibility": "on"}, {"weight": 1}, {"color": "#003867"}]
            }, {
                "featureType": "administrative",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"visibility": "on"}, {"weight": 8}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}, {"color": "#E1001A"}, {"weight": 0.4}]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}, {"color": "#edeff1"}, {"weight": 0.2}]
            }, {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}, {"color": "#edeff1"}, {"weight": 0.4}]
            }];
        }
        if (name == 'style_icy_blue') {
            style = [{"stylers": [{"hue": "#2c3e50"}, {"saturation": 250}]}, {
                "featureType": "road",
                "elementType": "geometry",
                "stylers"    : [{"lightness": 50}, {"visibility": "simplified"}]
            }, {"featureType": "road", "elementType": "labels", "stylers": [{"visibility": "off"}]}]
        }

        return style
    }

    window.__ = {};

    var map_element = $('#st-tour-map-new');

    if (map_element.length > 0 && typeof google === 'object') {

        var style = 'style_normal';
        if (map_element.data('style') != undefined) {
            style = map_element.data('style');
        }

        var autoload = true;
        if (map_element.data('autoload_map') == 0) {
            autoload = false
        }
        window.__.map_data = {
            map_element: map_element,
            location   : map_element.data('location'),
            style      : selectStyle(style),
            style_name : style,
            map        : {},
            map_width  : 0,
            map_height : 0,
            marker     : {},
            marker_data: map_element.data('marker-data'),
            autoload   : autoload,
            marker_icon: map_element.data('marker-icon')
        };

        $('.on_the_map .btn-on-map').on('click', function (e) {
            e.preventDefault();
            if (!__.map_data.autoload) {
                __.map_render.loadmap();
                __.map_render.on();
                __.map_render.responsive();
                __.map_data.autoload = true;
            }
        });

        $(window).load(function () {
            if (!__.map_data.autoload) {
                __.map_render.loadmap();
                __.map_render.on();
                __.map_render.responsive();
                __.map_data.autoload = true;
            }
        });

        var map_render = function () {
        };

        map_render.prototype.init = function () {
            if (__.map_data.autoload) {
                __.map_render.loadmap();
                __.map_render.on();
            }
        };

        var map;

        map_render.prototype.loadmap = function () {

            var scroll      = false, draggable = false;
            __.map_data.map = new google.maps.Map(__.map_data.map_element[0], {
                scrollwheel          : scroll,
                zoom                 : parseInt(__.map_data.location.zoom),
                center               : new google.maps.LatLng(parseFloat(__.map_data.location.lat), parseFloat(__.map_data.location.lng)),
                styles               : __.map_data.style,
                mapTypeId            : google.maps.MapTypeId.ROADMAP,
                zoomControl          : false,
                mapTypeControl       : false,
                scaleControl         : false,
                streetViewControl    : false,
                rotateControl        : false,
                fullscreenControl    : false,
                mapTypeControlOptions: {
                    style     : google.maps.MapTypeControlStyle.DEFAULT,
                    mapTypeIds: [
                        google.maps.MapTypeId.ROADMAP,
                        google.maps.MapTypeId.TERRAIN
                    ]
                }
            });

            map = __.map_data.map;

            //Create marker

            if (__.map_data.marker_data != undefined && __.map_data.marker_data != '') {
                var class_dark = '';
                if (__.map_data.style_name == 'style_midnight') {
                    class_dark = 'dark';
                }
                __.map_data.marker = new RichMarker({
                    position : new google.maps.LatLng(parseFloat(__.map_data.location.lat), parseFloat(__.map_data.location.lng)),
                    map      : __.map_data.map,
                    draggable: draggable,
                    shadow   : 'none',
                    animation: google.maps.Animation.DROP,
                    content  : '<div class="padding-bottom30 ' + class_dark + '"><div class="large-marker-hotel "><div class="bg-thumb" style="background: url(' + __.map_data.marker_data.thumb + ')"></div><div class="caption"><h3 class="title">' + __.map_data.marker_data.title + '</h3><span class="location">' + __.map_data.marker_data.in + '</span></div></div></div>'
                });
            } else {
                var marker = new google.maps.Marker({
                    position : new google.maps.LatLng(parseFloat(__.map_data.location.lat), parseFloat(__.map_data.location.lng)),
                    map      : __.map_data.map,
                    draggable: false,
                    icon     : __.map_data.marker_icon,
                    animation: google.maps.Animation.DROP
                });
            }

            this.loadmap.fullHeight = function () {
                var ww = $(window).width();
                if (__.map_data.full_height) {
                    var hw = $(window).height();
                    if (hw < 480) {
                        hw = 480;
                    }
                    if ($('#wpadminbar').length > 0) {
                        hw = hw - $('#wpadminbar').height();
                    }

                    if ($('.topbar  .no-transparent').length > 0 && ww > 991) {
                        var ht = $('.topbar  .no-transparent').height();
                        hw     = hw - ht;
                    }

                    if (hw < 480) {
                        hw = 480;
                    }

                    if (ww < parseInt(__.map_data.check_width) && parseInt(__.map_data.check_width) > 0) {
                        hw = 300;
                    }

                    __.map_data.map_element.height(hw);

                }
            };

            __.map_render.loadmap.fullHeight();
            __.map_render.action();

        };

        map_render.prototype.responsive = function () {
            if (__.map_data.autoload) {
                __.map_render.loadmap.fullHeight();
            }
            google.maps.event.trigger(__.map_data.map, "resize");
        };

        map_render.prototype.action = function (type, args) {

            this.action.clickZoomControl = function (type) {
                switch (type) {
                    case 'my-location':
                        var my_location = new google.maps.Marker({
                            clickable: false,
                            //animation: google.maps.Animation.DROP,
                            icon     : new google.maps.MarkerImage('https://maps.gstatic.com/mapfiles/ms2/micons/green-dot.png'),
                            shadow   : null,
                            zIndex   : 999,
                            map      : __.map_data.map
                        });
                        if (navigator.geolocation) navigator.geolocation.getCurrentPosition(function (pos) {
                            var me = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
                            my_location.setPosition(me);
                            __.map_data.map.panTo(me);
                        }, function (error) {

                        });
                        break;
                    case 'zoom-in':
                        var zoom_in = __.map_data.map.getZoom();
                        __.map_data.map.setZoom(zoom_in + 1);
                        break;
                    case 'zoom-out':
                        var zoom_out = __.map_data.map.getZoom();
                        __.map_data.map.setZoom(zoom_out - 1);
                        break;
                }
            };
            this.action.clickViewControl = function (type, args) {
                switch (type) {
                    case 'full-screen':
                        __.map_data.map_width  = __.map_data.map_element.css('width');
                        __.map_data.map_height = __.map_data.map_element.css('height');
                        __.map_data.map_element.css({
                            position       : 'fixed',
                            top            : 0,
                            left           : 0,
                            width          : '100%',
                            height         : '100%',
                            backgroundColor: 'dark',
                            'z-index'      : '9999999'
                        });
                        $('.st-tour-map .zoom-control').css({
                            'z-index': 10000000,
                            position : 'fixed'
                        });
                        $('.st-tour-map .view-control').css({
                            'z-index': 10000000,
                            position : 'fixed'
                        });

                        __.map_data.map_element.closest('.st-tour-map').css({
                            position : 'fixed',
                            top      : 0,
                            left     : 0,
                            'z-index': '9999999'
                        });

                        google.maps.event.trigger(__.map_data.map, "resize");

                        $('.full-screen').toggle();
                        $('.exit-full-screen').toggle();

                        break;
                    case 'exit-full-screen':

                        __.map_data.map_element.css({
                            position       : 'relative',
                            'z-index'      : 0,
                            top            : 0,
                            width          : __.map_data.map_width,
                            height         : __.map_data.map_height,
                            backgroundColor: 'transparent'
                        });

                        __.map_data.map_element.closest('.st-tour-map').css({
                            position : 'absolute',
                            top      : 0,
                            left     : 0,
                            'z-index': '2'
                        });

                        $('.st-tour-map .zoom-control').css({
                            'z-index': 1,
                            position : 'absolute'
                        });
                        var ww = $(window).width();
                        if (ww > 640) {
                            $('.st-tour-map .view-control').css({
                                'z-index': 1,
                                position : 'absolute'
                            });
                        } else {
                            $('.st-tour-map .view-control').css({
                                'z-index': 99,
                                position : 'absolute'
                            });
                        }

                        $('.full-screen').toggle();
                        $('.exit-full-screen').toggle();
                        break;
                    case 'view':
                        if (!args.element.hasClass('active')) {
                            args.element.addClass('active');
                            $('.st-tour-map .view-control .map_type').fadeIn(300);
                        } else {
                            args.element.removeClass('active');
                            $('.st-tour-map .view-control .map_type').fadeOut(300);
                        }
                        break;
                }
            };
            this.action.clickMapType     = function (type) {
                if (__.map_data.style_name != type) {
                    __.map_data.style_name = type;
                    __.map_data.style      = selectStyle(type);
                    var customMapType      = new google.maps.StyledMapType(__.map_data.style);
                    __.map_data.map.mapTypes.set('styled_map', customMapType);
                    __.map_data.map.setMapTypeId('styled_map');
                }
            };

        };

        map_render.prototype.on = function () {
            $('body').on('click', '.map-content-marker .icon_marker', function (e) {
                e.preventDefault();
                __.map_render.action.clickMarker({element: $(this)});
            });

            $('.st-tour-map .zoom-control a').each(function () {
                $(this).on('click', function (e) {
                    e.preventDefault();
                    __.map_render.action.clickZoomControl($(this).attr('class'));
                });
            });

            $('.st-tour-map .view-control a').each(function () {
                $(this).on('click', function (e) {
                    e.preventDefault();
                    __.map_render.action.clickViewControl($(this).attr('data-class'), {element: $(this)});
                });
            });

            $('.st-tour-map .view-control .map_type span').each(function () {
                $(this).on('click', function (e) {
                    e.preventDefault();
                    __.map_render.action.clickMapType($(this).attr('data-map'));
                });
            });

        };

        window.__.map_render = new map_render();
        __.map_render.init();

        $(window).on('resize', function () {
            __.map_render.responsive();
        })
    }

    if ($('.collapse-user').length) {
        $('.collapse-user').click(function (event) {
            /* Act on the event */
            $('.user-nav-wrapper').toggleClass('open');
            return false;
        });
    }
    var width_window = $(window).width();
    if (width_window < 768) {
        $('.st-elements-filters').each(function () {
            $(this).find('li .booking-filters-title').addClass('closed');
            $(this).find('li > div').css('display', 'none');
        });
    }

    if ($('.transfer-selectpicker').length) {
        $('.transfer-selectpicker').selectpicker({
            size: 10
        });
        //$('.transfer-selectpicker').tooltip('disable');
    }
});


// Custom 2
jQuery(function ($) {
    $("#st_enable_javascript").each(function () {
        if ($(this).hasClass("allow")) {
            $("#st_enable_javascript").html(".search-tabs-bg > .tabbable >.tab-content > .tab-pane{display: none; opacity: 0;}" + ".search-tabs-bg > .tabbable >.tab-content > .tab-pane.active{display: block;opacity: 1;}" + ".search-tabs-to-top { margin-top: -120px;}")
        }
    })
});
jQuery(document).ready(function ($) {
    if (typeof $.fn.sticky != 'undefined') {
        var topSpacing = 0;
        if ($(window).width() > 481 && $('body').hasClass('admin-bar')) {
            topSpacing = $('#wpadminbar').height()
        }
        set_sticky()
    }
    function set_sticky() {
        var is_menu1 = $(".menu_style1").length;
        var is_menu2 = $(".menu_style2").length;
        var is_menu3 = $(".menu_style3").length;
        var is_menu4 = $(".menu_style4").length;
        var is_topbar = $("#top_toolbar").length;
        var sticky_topbar = $(".enable_sticky_topbar").length;
        var sticky_menu = $(".enable_sticky_menu").length;
        var sticky_header = $(".enable_sticky_header").length;
        if (sticky_header || (sticky_menu && sticky_topbar)) {
            $("#st_header_wrap_inner").sticky({topSpacing: topSpacing});
            return
        } else {
            if (sticky_topbar && is_topbar) {
                $("#top_toolbar").sticky({topSpacing: topSpacing})
            }
            if (sticky_menu && (is_menu1 || is_menu2 || is_menu3 || is_menu4)) {
                var topSpacing_topbar = topSpacing;
                if (is_topbar && sticky_topbar) {
                    topSpacing_topbar += $("#top_toolbar").height()
                }
                $("#menu1").sticky({topSpacing: topSpacing_topbar});
                $("#menu2").sticky({topSpacing: topSpacing_topbar});
                $("#menu3").sticky({topSpacing: topSpacing_topbar});
                $("#menu4").sticky({topSpacing: topSpacing_topbar});
                return
            }
        }
        return
    }

    function other_sticky(spacing) {
    }

    if ($('body').hasClass('search_enable_preload')) {
        window.setTimeout(function () {
            $('.full-page-absolute').fadeOut().addClass('.hidden')
        }, 1000)
    }
    $('#gotop').click(function () {
        $("body,html").animate({scrollTop: 0}, 1000, function () {
            $('#gotop').fadeOut()
        })
    });
    $(window).scroll(function () {
        var scrolltop = $(window).scrollTop();
        if (scrolltop > 200) {
            $('#gotop').fadeIn()
        } else {
            $('#gotop').fadeOut()
        }
        scroll_with_out_transparent()
    });
    scroll_with_out_transparent();
    function scroll_with_out_transparent() {
        var sdlfkjsdflksd_scrolltop = $(window).scrollTop();
        var header_bgr_default = {'background-color': ""};
        if ($("body").hasClass("menu_style2") && sdlfkjsdflksd_scrolltop != 0 && $('.enable_sticky_menu.header_transparent').length !== 0) {
            $(".header-top").css(st_params.header_bgr)
        } else {
            $(".header-top").css(header_bgr_default)
        }
    }

    var top_ajax_search = $('.st-top-ajax-search');
    if (top_ajax_search.length) {
        top_ajax_search.typeahead({hint: !0, highlight: !0, minLength: 3, limit: 8}, {
            source: function (q, cb) {
                $('.st-top-ajax-search').parent().addClass('loading');
                return $.ajax({
                    dataType: 'json',
                    type: 'get',
                    url: st_params.ajax_url,
                    data: {
                        security: st_params.st_search_nonce,
                        action: 'st_top_ajax_search',
                        s: q,
                        lang: top_ajax_search.data('lang')
                    },
                    cache: !0,
                    success: function (data) {
                        $('.st-top-ajax-search').parent().removeClass('loading');
                        var result = [];
                        if (data.data) {
                            $.each(data.data, function (index, val) {
                                result.push({
                                    value: val.title,
                                    location_id: val.id,
                                    type_color: 'success',
                                    type: val.type,
                                    url: val.url
                                })
                            });
                            cb(result);
                            console.log(result)
                        }
                    },
                    error: function (e) {
                        $('.st-top-ajax-search').parent().removeClass('loading')
                    }
                })
            },
            templates: {suggestion: Handlebars.compile('<p class="search-line-item"><label class="label label-{{type_color}}">{{type}}</label><strong> {{value}}</strong></p>')}
        });
        top_ajax_search.bind('typeahead:selected', function (obj, datum, name) {
            if (datum.url) {
                window.location.href = datum.url
            }
        })
    }
    if ($.fn.chosen) {
        $(".chosen_select").chosen()
    }
    $('.woocommerce-ordering .posts_per_page').change(function () {
        $('.woocommerce-ordering').submit()
    });
    var product_timeout;
    $('.woocommerce li.product').hover(function () {
        var me = $(this);
        product_timeout = window.setTimeout(function () {
            me.find('.product-info-hide').slideDown('fast')
        }, 250)
    }, function () {
        window.clearTimeout(product_timeout);
        var me = $(this);
        me.find('.product-info-hide').slideUp('fast')
    });
    var menu3_resize = null;
    $(window).resize(function (event) {
        clearTimeout(menu3_resize);
        if ($('header#menu3').length) {
            menu3_resize = setTimeout(function () {
                if (window.matchMedia("(min-width: 1200px)").matches) {
                    var container = $('#top_header .container').height();
                    var menu = $('#slimmenu').height();
                    $('header#menu3 .nav').css('margin-top', (container - menu) / 2)
                }
            }, 500)
        }
    }).resize();
    $('#search-icon').click(function (event) {
        $('.main-header-search').fadeIn('fast');
        return !1
    });
    $('#search-close').click(function (event) {
        $('.main-header-search').fadeOut('fast');
        return !1
    });
    if ($('.st-slider-list-hotel').length) {
        $('.st-slider-list-hotel').owlCarousel({
            items: 1,
            singleItem: !0,
            slideSpeed: 500,
            transitionStyle: $('.st-slider-list-hotel').data('effect'),
            autoHeight: !0
        })
    }
    if ($("#owl-twitter").length) {
        $("#owl-twitter").owlCarousel({
            navigation: !0,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: !0,
            navigationText: ["", ""],
            pagination: !1,
            autoPlay: !0
        })
    }
    var st_list_partner = $(".st_list_partner");
    setTimeout(function () {
        st_list_partner.each(function () {
            var items = $(this).data('items');
            var speed = $(this).data('speed');
            var autoplay = $(this).data('autoplay');
            autoplay = (autoplay == 'yes') ? !0 : !1;
            $(this).owlCarousel({
                slideSpeed: speed,
                paginationSpeed: 400,
                navigationText: ["", ""],
                pagination: !1,
                navigation: !1,
                autoPlay: autoplay,
                items: 4,
                itemsDesktop: [1000, 4],
                itemsDesktopSmall: [900, 3],
                itemsTablet: [600, 1],
                itemsMobile: !1
            })
        })
    }, 500);
    $(".st_list_partner_nav .next").click(function () {
        st_list_partner.trigger('owl.next')
    });
    $(".st_list_partner_nav .prev").click(function () {
        st_list_partner.trigger('owl.prev')
    });
    $(".st_tour_ver_countdown").each(function () {
        $(this).syotimer({
            year: parseInt($(this).data('year')),
            month: parseInt($(this).data('month')),
            day: parseInt($(this).data('day')),
            hour: 0,
            minute: 0,
            lang: ($(this).data('lang')),
        })
    })
    if ($('.st_tour_ver_fotorama').length) {
        $('.st_tour_ver_fotorama').fotorama({nav: !1,})
    }
    var flag_ajax_coupon = !1;
    $('body').on('click', '.add-coupon-ajax', function () {
        var t = $(this), overlay = t.closest('.booking-item-payment').find('.overlay-form'), form = t.closest('form'), alert = $('.alert', form), data = form.serializeArray();
        if (flag_ajax_coupon) {
            return !1
        }
        flag_ajax_coupon = !0;
        overlay.fadeIn();
        alert.addClass('hidden').html('');
        $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
            if (respon.status == 1) {
                overlay.fadeIn();
                var data = {'action': 'modal_get_cart_detail'};
                $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
                    t.closest('.booking-item-payment').html(respon);
                    overlay.fadeOut();
                    flag_ajax_coupon = !1
                }, 'json')
            } else {
                alert.removeClass('hidden').html(respon.message);
                overlay.fadeOut();
                flag_ajax_coupon = !1
            }
        }, 'json');
        return !1
    });
    var flagApplyCoupon = 1;
    $('body').on('click', '.booking-item-coupon form button', function (e) {
        if (!$(this).hasClass('add-coupon-ajax')) {
            if(flagApplyCoupon == 0){
                return false;
            }
            flagApplyCoupon = 0;

            e.preventDefault();

            var form = $(this).closest('form');
            $(this).append('<i class="fa fa-spinner fa-spin"></i>');
            var data = {
                'action': 'apply_mdcoupon_function',
                'code': $('#field-coupon_code', form).val()
            };
            $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
                if (respon.status == 1) {
                    form.submit();
                }
            }, 'json');
        }
    });
    $('body').on('click', '.ajax-remove-coupon', function (event) {
        event.preventDefault();
        var t = $(this), overlay = t.closest('.booking-item-payment').find('.overlay-form'), form = t.closest('form'), alert = $('.alert', form);
        if (flag_ajax_coupon) {
            return !1
        }
        flag_ajax_coupon = !0;
        overlay.fadeIn();
        var data = {'action': 'ajax_remove_coupon', 'coupon': $(this).data('coupon')};
        $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
            overlay.fadeIn();
            var data = {'action': 'modal_get_cart_detail'};
            $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
                t.closest('.booking-item-payment').html(respon);
                overlay.fadeOut();
                flag_ajax_coupon = !1
            }, 'json')
        }, 'json')
    });
    $('#myModal').modal('show')
});
jQuery(document).ready(function ($) {
    $('.extra-collapse a').click(function (e) {
        e.preventDefault();
        var p = $(this).closest('.extra-price');
        if (p.find('.extra-collapse-control').hasClass('extra-none')) {
            $(this).find('i').removeClass('fa-angle-double-down');
            $(this).find('i').addClass('fa-angle-double-up');
            p.find('.extra-collapse-control').removeClass('extra-none')
        }
        else {
            $(this).find('i').removeClass('fa-angle-double-up');
            $(this).find('i').addClass('fa-angle-double-down');
            p.find('.extra-collapse-control').addClass('extra-none')
        }
    });
    if ($('.has-matchHeight', 'body').length) {
        $('.has-matchHeight', 'body').matchHeight()
    }
});


jQuery(function ($) {
    $('.ac-gallery').each(function () {
        var owl1 = $(this);
        owl1.owlCarousel({
            items: 1,
            loop: true,
            autoplay: false,
            dots: false,
            pagination: false
        });
        $(this).parent().find(".owl-prev").click(function () {
            owl1.trigger('owl.prev');
        });
        $(this).parent().find(".owl-next").click(function () {
            owl1.trigger('owl.next');
        });
    });

    $('.accommodation-single-map .st_list_map .content_map #list_map').each(function () {
        var wh = $(window).height();
        var hh = $('#st_header_wrap').height();
        var full_height = wh - hh;
        if ($('#wpadminbar').length > 0) {
            full_height = full_height - $('#wpadminbar').height();
        }
        if (full_height < 480) {
            full_height = 480;
        }

        $(this).css({height: full_height + 'px'});
    });

    $('.on_the_map .btn-on-map').each(function () {
        $(this).on('click', function (e) {
            e.preventDefault();

            var p = $(this).parent().parent();
            $(this).toggleClass('active');
            if ($(this).hasClass('active')) {
                $(this).text($(this).data('hide'));
            } else {
                $(this).text($(this).data('no-hide'));
            }
            p.find('.accommodation-single-map').toggleClass('active');
            p.find('.review-price').toggleClass('active');
        });
    });


    //Inbox
    $('.st-inbox-send').click(function(e){
        e.preventDefault();
        var p = $(this).closest('.st-form-inbox');
        var t = $(this);
        if(p.find('input[name="inbox-title"]').val() == ''){
            p.find('input[name="inbox-title"]').addClass('wb-error');
        }else if(p.find('textarea[name="inbox-message"]').val() == '' ){
            p.find('textarea[name="inbox-message"]').addClass('wb-error');
        }else{
            var id = p.find('input[name="post_id"]').val();
            var to_user = p.find('input[name="to_user"]').val();
            var title = p.find('input[name="inbox-title"]').val();
            var message = p.find('textarea[name="inbox-message"]').val();
            t.addClass('loading');
            p.find('input[name="inbox-title"]').removeClass('wb-error');
            p.find('textarea[name="inbox-message"]').removeClass('wb-error');
            $.ajax({
                url: st_params.ajax_url,
                data: {
                    action: 'send_message_partner',
                    id: id,
                    title: title,
                    message: message,
                    to_user: to_user,
                    st_send_message : p.find('input[name="st_send_message"]').val(),
                    _wp_http_referer : p.find('input[name="_wp_http_referer"]').val(),
                },
                dataType: 'json',
                type: 'POST',
                success: function(msg){
                    if(msg.status == 1){
                        p.find('.inbox-group').hide();
                        p.find('.inbox-notice').addClass('success');
                        p.find('.inbox-notice').text(p.find('.inbox-notice').data('success'));
                        p.find('.detail-message').attr('href', msg.link_detail);
                        p.find('.detail-message').removeClass('hide');
                        p.find('.inbox-notice').addClass('alert-success').removeClass('hide').removeClass('alert-danger');
                    }else{
                        if(msg.message.length < 0){
                            p.find('.inbox-notice').text(p.find('.inbox-notice').data('error'));
                        }else{
                            p.find('.inbox-notice').html(msg.message);
                        }
                        p.find('.inbox-notice').addClass('alert-danger').removeClass('hide');
                    }
                    t.removeClass('loading');
                },
                error: function(e){
                    console.log(e);
                }
            });
        }
    });
    $('.inbox-reply-btn').click(function (e) {
        e.preventDefault();
        var p = $(this).closest('.form-reply');
        var t = $(this);
        if(p.find('textarea[name="reply-content"]').val() == ''){
            p.find('textarea[name="reply-content"]').addClass('wb-error');
        }else{
            var content = p.find('textarea[name="reply-content"]').val();
            t.addClass('loading');
            $.ajax({
                url: st_params.ajax_url,
                data:{
                    action: 'inbox_reply_message',
                    content: content,
                    to_user: p.find('input[name="to_user"]').val(),
                    parent_id: p.find('input[name="message_id"]').val(),
                    post_id: p.find('input[name="post_id"]').val()
                },
                dataType: 'json',
                type: 'POST',
                success: function(msg){
                    if(msg.status == 1){
                        var html = '<div class="message-item from">' +
                            '<div class="user-avatar">' +msg.data.avatar+
                            '<span>'+msg.data.username+'</span>' +
                            '</div>' +
                            '<div class="message-item-content">'
                            +'<span>'+msg.data.content+'</span>'
                            +'<span>'+msg.data.created_at+'</span>' +
                            '</div>'
                            +'</div>';
                        $('.st-inbox-body-detail .message-box').append(html);
                        p.find('textarea[name="reply-content"]').val('');
                        p.find('textarea[name="reply-content"]').removeClass('wb-error');
                        if(jQuery().niceScroll){
                            $('.st-inbox-body-detail .message-box').niceScroll();
                        }
                        //var pos = $('.message-box .message-item').last().position().top;
                        //$('.st-inbox-body-detail .message-box').animate({scrollTop: pos}, 'slow');
                    }
                    t.removeClass('loading');
                },
                error: function(e){
                    console.log(e);
                }
            });
        }
    });
    $('.btn_remove_message').click(function () {
        var container = $(this).closest('.st-inbox-body');
        var p = $(this).closest('.message-item');
        var t = $(this);
        t.addClass('loading');
        $.ajax({
            url: st_params.ajax_url,
            data:{
                action: 'inbox_remove_message',
                message_id: t.data('message-id'),
            },
            dataType: 'json',
            type: 'POST',
            success: function(msg){
                p.remove();
                container.find('.count_message').html(msg.total_message);
            },
            error: function(e){
                t.removeClass('loading');
            }
        });
    });

    $('.message-box').each(function(){
        if(jQuery().niceScroll){
            $('.st-inbox-body-detail .message-box').niceScroll();
        }
        /*if($('.message-box .message-item').length > 0) {
            var pos = $('.message-box .message-item').last().position().top;
            $('.st-inbox-body-detail .message-box').animate({scrollTop: pos}, 'slow');
        }*/
    });

    $('.st_last_message_id').each(function(){
        var $this = $(this);
        var container = $(this).closest('.st-inbox-body-detail');
        var is_get_data = true;
        setInterval(function(){
            var last_message_id = $this.val();
            if(is_get_data == false ) return false;
            is_get_data = false;
            $.ajax({
                url: st_params.ajax_url,
                data:{
                    action: 'inbox_get_last_message',
                    last_message_id: last_message_id,
                    message_id: $this.data('message_id'),
                    user_id: $this.data('user_id'),
                    post_id: $this.data('post_id')
                },
                dataType: 'json',
                type: 'POST',
                success: function(msg){
                    is_get_data = true;
                    if(msg.length > 0){
                        for (var key in msg){
                            var attrValue = msg[key];
                            var html = '<div class="message-item to">' +
                                '<div class="user-avatar">' +attrValue.avatar+
                                '<span>'+attrValue.username+'</span>' +
                                '</div>' +
                                '<div class="message-item-content">'
                                +'<span>'+attrValue.content+'</span>'
                                +'<span>'+attrValue.created_at+'</span>' +
                                '</div>'
                                +'</div>';
                            container.find('.message-box').append(html);
                            container.find('.st_last_message_id').val(attrValue.id);
                        }
                    }
                    if(jQuery().niceScroll){
                        container.find('.message-box').niceScroll();
                    }
                    //var pos = $('.message-box .message-item').last().position().top;
                    //container.find('.message-box').animate({scrollTop: pos}, 'slow');
                },
                error: function(e){
                }
            });
        },10000);
    });
    $.ajax({
        url: st_params.ajax_url,
        data: {
            action: 'check_inbox_notification'
        },
        dataType: 'json',
        type: 'POST',
        success: function (msg) {
            if(msg.status == 1 && (msg.old_count === undefined || msg.new_message != msg.old_count)){
                var html = "<a href='"+msg.inbox_link+"' target='_blank' ><div class='st_notice_template'><i class='fa fa-comment'></i> <div class='display_table'>" + msg.message + "</div>  </div></a>";
                noty({
                    text: html,
                    layout: 'topRight',
                    type: 'info',
                    closeWith: ['click', 'button'],
                    animation: {
                        open: 'animated bounceInRight',
                        close: 'animated bounceOutRight',
                        easing: 'swing',
                        speed: 500
                    },
                    theme: 'relax',
                    progressBar: true,
                    timeout: 6000
                })
            }
        },
        error: function (e) {
            console.log(e);
        }
    });

    $('.st-inbox').click(function () {
        $(this).find('.st-form-inbox').addClass('active');
    });


    $('.st-hotel-tabs-content .nav-tabs li a, .st-tour-tabs-content .nav-tabs li a').click(function () {
        var href = $(this).attr('href');
        window.location.replace(href);
    });

    $('.st-hotel-tabs-content,.st-tour-tabs-content').each(function () {
        if(window.location.href.indexOf('#') > 0 ){
            var hashes = window.location.href.slice(window.location.href.indexOf('#') + 1).split('&');
            var hash = hashes[0];

            var check_comment = hash.split('-');
            if(hash.length > 0 && check_comment[0] == 'comment'){
                hash = 'review';
            }
            if(hash.length > 0){
                $(this).find('li').removeClass('active');
                $(this).find('.tab-pane').removeClass('active').removeClass('in');

                $(this).find('a[href=#'+hash+']').parent().addClass('active');
                $(this).find('#'+hash).addClass('active').addClass('in');

            }
        }
    });






});

jQuery(function ($) {
    $(document).on('click', '.btn-info-booking', function(event) {
        var modal = $(this).data('target');
        modal = $(modal);
        modal.find('.modal-content-inner').empty();
        modal.find('.overlay-form').fadeIn();
        $.ajax({
            url: st_params.ajax_url,
            data: {
                action: 'st_get_info_booking_history',
                order_id: $(this).data('order_id'),
                service_id: $(this).data('service_id')
            },
            dataType: 'json',
            type: 'GET',
            success: function (res) {
                if(res.status == 1){
                    modal.find('.modal-content-inner').html(res.html);
                }
                if(res.msg != ""){
                    modal.find('.modal-content-inner').html(res.msg);
                }
                modal.find('.overlay-form').fadeOut();
            },
            error: function (e) {
                console.log(e);
            }
        });
    });
    $('.btn-user-update-to-partner').click(function(e){
        var data = confirm($(this).data('confirm'));
        if(data == false)
            e.preventDefault();
    });

    /* Send email to customer by date */
    if($('.booking-email-form').length) {
        $('#cb-select-all').click(function () {
            var t = $(this);
            var parent = $(this).closest('.booking-email-form');
            parent.find('input:checkbox').not(this).prop('checked', this.checked);
        });
        $('.cb-select-child').click(function () {
            var t = $(this);
            var parent = $(this).closest('.booking-email-form');
            parent.find('input#cb-select-all').prop('checked', false);
            var check = 0;
            $('.cb-select-child').each(function (e) {
                if (!$(this).is(":checked")) {
                    check++;
                }
            });
            if (check == 0) {
                parent.find('input#cb-select-all').prop('checked', true);
            }
        });
    }
    $('#booking-email-form-btn').click(function (e) {
        e.preventDefault();
        var t = $(this).closest('.booking-email-form');
        var data = t.serializeArray();
        t.find('.form-message').html('').hide();
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: data,
            dataType: "json",
            beforeSend: function () {
                t.find('.overlay-form').show();
            }
        }).done(function (respond) {
            if(respond.status == true){
                t.find('.form-message').html('<div class="alert alert-success">'+ respond.message +'</div>').show();
            }else{
                t.find('.form-message').html('<div class="alert alert-danger">'+ respond.message +'</div>').show();
            }
            t.find('.overlay-form').hide();
        })
    });

    if($('input.flight_package').length) {
        $('input.flight_package').on('ifClicked', function (event) {
            var me = $(this);
            if (this.checked) {
                setTimeout(function () {
                    me.iCheck('uncheck');
                }, 1);
            }
        });
    }

});
//End Custom 2;(function ($) {
    "use strict";
    $(document).ready(function () {
        if($('#wp_is_mobile').length){
            $('#slimmenu .menu-item.menu-item-has-children>a').append("<span class=\"sub-toggle\"><i class=\"fa fa-angle-down\"></i></span>");
            $(document).on('click', '.menu-item .sub-toggle', function (e) {
               e.preventDefault();
               var me = $(this);
               me.parent().next('.sub-menu').stop(true, true).slideToggle();

               var faicon = me.find('i');
               if(faicon.hasClass('fa-angle-down')){
                   faicon.removeClass('fa-angle-down').addClass('fa-angle-up');
               }else{
                   faicon.removeClass('fa-angle-up').addClass('fa-angle-down');
               }
            });
            $('.collapse-button').click(function () {
               $('#slimmenu').stop(true, true).slideToggle();
               $('.sub-menu').slideUp();
               if($('.sub-toggle i').hasClass('fa-angle-up')){
                   $('.sub-toggle i').removeClass('fa-angle-up').addClass('fa-angle-down');
               }
            });
        }

        if (typeof $.fn.sticky != 'undefined') {
            var topSpacing = 0;
            if ($(window).width() > 481 && $('body').hasClass('admin-bar')) {
                topSpacing = $('#wpadminbar').height()
            }
            set_sticky()
        }
        function set_sticky() {
            var is_menu1 = $(".menu_style1").length;
            var is_menu2 = $(".menu_style2").length;
            var is_topbar = $("#top_toolbar").length;
            var sticky_topbar = $(".enable_sticky_topbar").length;
            var sticky_menu = $(".enable_sticky_menu").length;
            var sticky_header = $(".enable_sticky_header").length;
            if (sticky_header || (sticky_menu && sticky_topbar)) {
                $("#st_header_wrap_inner").sticky({topSpacing: topSpacing});
                return
            } else {
                if (sticky_topbar && is_topbar) {
                    $("#top_toolbar").sticky({topSpacing: topSpacing})
                }
                if (sticky_menu && (is_menu1 || is_menu2 || is_menu3 || is_menu4)) {
                    var topSpacing_topbar = topSpacing;
                    if (is_topbar && sticky_topbar) {
                        topSpacing_topbar += $("#top_toolbar").height()
                    }
                    $("#menu1").sticky({topSpacing: topSpacing_topbar});
                    $("#menu2").sticky({topSpacing: topSpacing_topbar});
                    return
                }
            }
            return
        }

        //if($('#wp_is_mobile').length && $('.single ').length){
        if($('#wp_is_mobile').length){
            if($('.st_above_on_mobile').length && $('.st_below_on_mobile').length) {
                var elAbove = $('.st_above_on_mobile');
                var elBelow = $('.st_below_on_mobile');
                var elBelow_clone = elBelow.clone();
                elBelow.remove();
                elBelow_clone.css({
                    'margin-top': '30px'
                });
                elAbove.parent().append(elBelow_clone);
            }
        }
    });
})(jQuery);;(function ($) {
    "use strict";
    $(document).ready(function () {

        if($('.st_lazy_load').length){
            $('.st_lazy_load').each(function() {
                var me = $(this);
                new Waypoint({
                    element: me,
                    handler: function () {
                        var stLazy = me.find('.st-lazy');
                        stLazy.each(function () {
                            var imgItem = $(this);
                            var imgSRC = imgItem.data('src');
                            me.find('.layzyload-wrapper .layzyload-item').fadeOut(10, 'linear', function () {
                                me.find('.layzyload-wrapper').addClass('layzyload-noafter');
                                imgItem.attr('src', imgSRC).show();
                            });
                        });
                        this.destroy()
                    },
                    offset: $(window).height()
                });
            });
        }

        if($('.fotorama').length){
            $('.fotorama').each(function () {
                var me = $(this);
                if(me.data('auto') == false){
                    new Waypoint({
                        element: me,
                        handler: function () {
                            me.fotorama();
                            this.destroy()
                        },
                        offset: $(window).height()
                    });
                }
            });
        }
    });
})(jQuery);