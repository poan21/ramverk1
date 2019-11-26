<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>
<h1>Weather Checker</h1>

<?php
if ($valid) {?>
    <div id="map"></div>
      <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
      <script>
        map = new OpenLayers.Map("map");
        map.addLayer(new OpenLayers.Layer.OSM());

        var lonLat = new OpenLayers.LonLat(<?=$res[0]['longitude']?> ,<?=$res[0]['latitude']?> )
              .transform(
                new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                map.getProjectionObject() // to Spherical Mercator Projection
              );

        var zoom=12;

        var markers = new OpenLayers.Layer.Markers( "Markers" );
        map.addLayer(markers);

        markers.addMarker(new OpenLayers.Marker(lonLat));

        map.setCenter (lonLat, zoom);
      </script>
      <?php
        if (isset($res['error'])) {
            ?><p>Kan inte läsa väder.</p><?php
        } else {
            foreach ($res as $oneday) {?>
              <div class="weather">
                  <p><?= date("Y-m-d", $oneday['daily']['data'][0]['time']); ?></p>
                  <p><?= $oneday['daily']['data'][0]['summary']; ?></p>
                  <p>Högsta temp: <?= number_format((($oneday['daily']['data'][0]['temperatureMax']-32)/1.8), 1); ?>℃</p>
                  <p>Lägsta temp: <?= number_format((($oneday['daily']['data'][0]['temperatureMin']-32)/1.8), 1); ?>℃</p>
              </div>
                <?php
            }
        }
} else {
    ?>
    <p>Ingen hittad plats</p>
    <?php
}
?>
<a href="">Gå tillbaka?</a>
