(($, maps, window) ->

  "use strict"


  # CLASS DEFINITION
  # ================

  class AccessMap


    constructor: (element, options) ->
      @element = $ element
      @_setOptions options

      @map     = new maps.Map element, @options.map

      @markers = []
      @addMarker place for place in @options.places

      @fit()


    DEFAULTS:

      # places
      places: [
        {
          lat: 46.521533,
          lng: 6.625276,
          url: 'http://we-studio.ch'
        }
      ]

      # default markers options
      marker: {}

      # default infoWindows options
      infoWindow: {}

      # map options
      map:
        zoom:                   12
        center:                 undefined
        mapTypeId:              maps.MapTypeId.ROADMAP
        disableDefaultUI:       true
        disableDoubleClickZoom: true
        draggable:              false
        scrollwheel:            false


    _setOptions: (options) ->
      @options = $.extend true, {}, @DEFAULTS, options

      if @options.places.length is 0
        throw new Error '`places` is required'

      # normalize place options
      for place in @options.places
        do (place) =>
          if not place.position
            if place.lat and place.lng
              place.position = @createLatLng(place, 'position')
            else
              throw new Error '`position` or `lat`, `lng` required'

      # normalize map options
      if not @options.map.center
        if @options.map.lat and @options.map.lng
          @options.map.center = @createLatLng(@options.map, 'center')
        else
          @options.map.center = @options.places[0].position


    createLatLng: (options, attr = 'position') ->
      if options[attr]
        return options[attr]

      if (options.lat and options.lng)
        return new maps.LatLng options.lat, options.lng

      throw new Error '`'+attr+'` or `lat`, `lng` required'

      return


    addMarker: (place) ->
      self = this
      options = $.extend(
        {},
        @options.marker,
        place.marker or {}
      )
      options.map = @map
      options.position = place.position

      marker = new maps.Marker options
      marker.content = place.content if place.content
      marker.url = place.url if place.url

      @markers.push marker

      if marker.content
        infoWindowOptions = $.extend(
          {},
          @options.infoWindow,
          place.infoWindow or {}
        )
        infoWindowOptions.content = marker.content
        infoWindowOptions.position = marker.position
        infoWindow = new maps.InfoWindow infoWindowOptions

        marker.infoWindow = infoWindow
        marker.addListener 'click', ->
          self.openInfoWindow this

      else if marker.url
        marker.addListener 'click', ->
          self.openUrl this

      return


    getMarker: (i) ->
      return @markers[i]


    removeMarker: (i) ->
      marker = @getMarker(i)
      if marker
        maps.event.clearListeners marker, 'click'
        marker.setMap null
        delete @markers[i]

      return


    openInfoWindow: (marker) ->
      if typeof marker is 'number'
        marker = @getMarker marker

      if marker && marker.infoWindow
        marker.infoWindow.open @map, marker

      return


    closeInfoWindow : (marker) ->
      if typeof marker is 'number'
        marker = @getMarker marker

      if marker and marker.infoWindow
        marker.infoWindow.close()

      return


    openUrl: (marker) ->
      if typeof marker is 'number'
        marker = @getMarker marker

      console.log "openUrl"

      if marker.url
        window.open marker.url, '_blank'

      return


    fit: () ->
      if @markers.length is 0
        return

      if @markers.length is 1
        @map.setCenter @markers[0].getPosition()
        return

      s = n = @markers[0].getPosition().lat()
      w = e = @markers[0].getPosition().lng()

      for marker in @markers
        pos = marker.getPosition()
        s = pos.lat() if pos.lat() < s
        n = pos.lat() if pos.lat() > n
        w = pos.lat() if pos.lng() < w
        e = pos.lat() if pos.lng() > n

      sw = new maps.LatLng s, w
      ne = new maps.LatLng n, e

      @map.fitBounds new maps.LatLngBounds sw, ne

      return


  # PLUGIN DEFINITION
  # =================

  old = $.fn.accessmap

  $.fn.accessmap = (o, args...) ->
    return @each ->
      $this   = $(this)
      data    = $this.data 'accessmap'
      options = typeof o is 'object' && o

      if not data
        $this.data 'accessmap', data = new AccessMap this, options

      if typeof o is 'string' and
         o.charAt(0) isnt '_' and
         typeof data[o] is 'function'
        data[o].apply data, args

      return

  $.fn.accessmap.Constructor = AccessMap


  # NO CONFLICT
  # ===========

  $.fn.accessmap.noConflict = ->
    $.fn.accessmap = old

    return this

  return

) jQuery, google.maps, window
