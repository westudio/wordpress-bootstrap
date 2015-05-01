<?php

wp_enqueue_script('access_map');

if (!isset($lat)) {
  $lat = 46.256578;
}

if (!isset($lng)) {
  $lng = 6.993058;
}

if (!isset($zoom)) {
  $zoom = 11;
}

$icon = get_template_directory_uri().'/ico/favicon.png';

?>
  <div class="map">
    <div id="map" class="map-inner"></div>
  </div>

  <script>
    jQuery(function ($) {
      $('#map').accessmap({
        places: [{
          lat: <?php echo $lat ?>,
          lng: <?php echo $lng ?>,
          url: 'http://we-studio.ch'
        }],
        map: {
          zoom: <?php echo $zoom ?>
        },
        marker: {
          icon: {
            size: new google.maps.Size(32, 32),
            anchor: new google.maps.Point(16, 16),
            url: "<?php echo $icon ?>"
          }
        }
      });
    });
  </script>
