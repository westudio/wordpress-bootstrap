var __slice = [].slice;

(function($, maps, window) {
  "use strict";
  var AccessMap, old;
  AccessMap = (function() {
    function AccessMap(element, options) {
      var place, _i, _len, _ref;
      this.element = $(element);
      this._setOptions(options);
      this.map = new maps.Map(element, this.options.map);
      this.markers = [];
      _ref = this.options.places;
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        place = _ref[_i];
        this.addMarker(place);
      }
      this.fit();
    }

    AccessMap.prototype.DEFAULTS = {
      places: [
        {
          lat: 46.521533,
          lng: 6.625276,
          url: 'http://we-studio.ch'
        }
      ],
      marker: {},
      infoWindow: {},
      map: {
        zoom: 12,
        center: void 0,
        mapTypeId: maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        disableDoubleClickZoom: true,
        draggable: false,
        scrollwheel: false
      }
    };

    AccessMap.prototype._setOptions = function(options) {
      var place, _fn, _i, _len, _ref;
      this.options = $.extend(true, {}, this.DEFAULTS, options);
      if (this.options.places.length === 0) {
        throw new Error('`places` is required');
      }
      _ref = this.options.places;
      _fn = (function(_this) {
        return function(place) {
          if (!place.position) {
            if (place.lat && place.lng) {
              return place.position = _this.createLatLng(place, 'position');
            } else {
              throw new Error('`position` or `lat`, `lng` required');
            }
          }
        };
      })(this);
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        place = _ref[_i];
        _fn(place);
      }
      if (!this.options.map.center) {
        if (this.options.map.lat && this.options.map.lng) {
          return this.options.map.center = this.createLatLng(this.options.map, 'center');
        } else {
          return this.options.map.center = this.options.places[0].position;
        }
      }
    };

    AccessMap.prototype.createLatLng = function(options, attr) {
      if (attr == null) {
        attr = 'position';
      }
      if (options[attr]) {
        return options[attr];
      }
      if (options.lat && options.lng) {
        return new maps.LatLng(options.lat, options.lng);
      }
      throw new Error('`' + attr + '` or `lat`, `lng` required');
    };

    AccessMap.prototype.addMarker = function(place) {
      var infoWindow, infoWindowOptions, marker, options, self;
      self = this;
      options = $.extend({}, this.options.marker, place.marker || {});
      options.map = this.map;
      options.position = place.position;
      marker = new maps.Marker(options);
      if (place.content) {
        marker.content = place.content;
      }
      if (place.url) {
        marker.url = place.url;
      }
      this.markers.push(marker);
      if (marker.content) {
        infoWindowOptions = $.extend({}, this.options.infoWindow, place.infoWindow || {});
        infoWindowOptions.content = marker.content;
        infoWindowOptions.position = marker.position;
        infoWindow = new maps.InfoWindow(infoWindowOptions);
        marker.infoWindow = infoWindow;
        marker.addListener('click', function() {
          return self.openInfoWindow(this);
        });
      } else if (marker.url) {
        marker.addListener('click', function() {
          return self.openUrl(this);
        });
      }
    };

    AccessMap.prototype.getMarker = function(i) {
      return this.markers[i];
    };

    AccessMap.prototype.removeMarker = function(i) {
      var marker;
      marker = this.getMarker(i);
      if (marker) {
        maps.event.clearListeners(marker, 'click');
        marker.setMap(null);
        delete this.markers[i];
      }
    };

    AccessMap.prototype.openInfoWindow = function(marker) {
      if (typeof marker === 'number') {
        marker = this.getMarker(marker);
      }
      if (marker && marker.infoWindow) {
        marker.infoWindow.open(this.map, marker);
      }
    };

    AccessMap.prototype.closeInfoWindow = function(marker) {
      if (typeof marker === 'number') {
        marker = this.getMarker(marker);
      }
      if (marker && marker.infoWindow) {
        marker.infoWindow.close();
      }
    };

    AccessMap.prototype.openUrl = function(marker) {
      if (typeof marker === 'number') {
        marker = this.getMarker(marker);
      }
      console.log("openUrl");
      if (marker.url) {
        window.open(marker.url, '_blank');
      }
    };

    AccessMap.prototype.fit = function() {
      var e, marker, n, ne, pos, s, sw, w, _i, _len, _ref;
      if (this.markers.length === 0) {
        return;
      }
      if (this.markers.length === 1) {
        this.map.setCenter(this.markers[0].getPosition());
        return;
      }
      s = n = this.markers[0].getPosition().lat();
      w = e = this.markers[0].getPosition().lng();
      _ref = this.markers;
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        marker = _ref[_i];
        pos = marker.getPosition();
        if (pos.lat() < s) {
          s = pos.lat();
        }
        if (pos.lat() > n) {
          n = pos.lat();
        }
        if (pos.lng() < w) {
          w = pos.lat();
        }
        if (pos.lng() > n) {
          e = pos.lat();
        }
      }
      sw = new maps.LatLng(s, w);
      ne = new maps.LatLng(n, e);
      this.map.fitBounds(new maps.LatLngBounds(sw, ne));
    };

    return AccessMap;

  })();
  old = $.fn.accessmap;
  $.fn.accessmap = function() {
    var args, o;
    o = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
    return this.each(function() {
      var $this, data, options;
      $this = $(this);
      data = $this.data('accessmap');
      options = typeof o === 'object' && o;
      if (!data) {
        $this.data('accessmap', data = new AccessMap(this, options));
      }
      if (typeof o === 'string' && o.charAt(0) !== '_' && typeof data[o] === 'function') {
        data[o].apply(data, args);
      }
    });
  };
  $.fn.accessmap.Constructor = AccessMap;
  $.fn.accessmap.noConflict = function() {
    $.fn.accessmap = old;
    return this;
  };
})(jQuery, google.maps, window);
