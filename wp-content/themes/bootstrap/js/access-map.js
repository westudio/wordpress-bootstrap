;(function ($, window, undefined) {

    "use strict";

    // Requires Google Maps
    if (!window.google || !window.google.maps) {
        return;
    }

    var AccessMap = function (element, options) {
        this.$element = $(element);
        this.options = options;

        if (!this.options.center) {
            throw new Error('`center` option is required');
        }

        this.map = new google.maps.Map(this.$element.get(0), this.options);

        this.marker = new google.maps.Marker({
            map: this.map,
            position: this.options.position || this.options.center,
            icon: this.options.icon
        });

        this.infoWindow = new google.maps.InfoWindow({
            content: this.options.content
        });

        google.maps.event.addListener(this.map, 'idle', $.proxy(this.openInfoWindow, this));
        google.maps.event.addListener(this.marker, 'click', $.proxy(this.openInfoWindow, this));
    };

    AccessMap.prototype = {
        openInfoWindow: function () {
            this.infoWindow.open(this.map, this.marker);
        },

        closeInfowWindow: function () {
            this.infoWindow.close();
        },

        log: function (msg) {
            console.log(msg);
        }
    };

    $.fn.accessmap = function (o) {
        return this.each(function () {
            var $this   = $(this),
                data    = $this.data('accessmap'),
                options = $.extend({}, $.fn.accessmap.defaults, typeof o == 'object' && o),
                action  = typeof o == 'string' ? o : undefined;

            if (!data) {
                $this.data('accessmap', data = new AccessMap(this, options));
            }

            if (action) {
                if (arguments.length > 1) {
                    return data[action].apply(
                        data,
                        Array.prototype.slice.call(arguments).slice(1)
                    );
                } else {
                    return data[action]();
                }
            }
        });
    };

    $.fn.accessmap.defaults = {
        zoom                   : 12,
        center                 : undefined,
        mapTypeId              : google.maps.MapTypeId.ROADMAP,
        disableDefaultUI       : true,
        disableDoubleClickZoom : true,
        draggable              : false,
        scrollwheel            : false,
        content                : ''
    };

    $.fn.accessmap.constructor = AccessMap;

})(window.jQuery, window);