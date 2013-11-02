<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html {
        height: 100%;
      }
      body {
        height: 100%;
        margin: 0;
        padding: 0;
        background-color:#F0F0F0;
      }
      #map-canvas {
        height: 80%;
        width: 80%;
        margin-top: 50px;
        margin:0 auto;
        vertical-align: middle;
        position: fixed;
        top: 50%;
        left: 50%;
        width: 800px;
        margin-left: -400px;
        height: 600px;
        margin-top: -300px;
      }
    </style>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7e3d2P1K0BUdOKRM42GblFpJAc1rfZms&sensor=true"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  </head>
  <body>
    <div id="map-canvas" />
    <script type="text/javascript">
      function initialize() {
        var mapStyle = [{
            "featureType": "water",
            "stylers": [{
                "color": "#aaaaaa"
              }, {
                "saturation": -100
              }
            ]
          }, {
            "featureType": "transit",
            "stylers": [{
                "visibility": "simplified"
              }, {
                "saturation": -100
              }, {
                "hue": "#80ff00"
              }, {
                "lightness": 28
              }
            ]
          }, {
            "featureType": "transit",
            "elementType": "labels",
            "stylers": [{
                "saturation": -100
              }, {
                "lightness": 12
              }, {
                "visibility": "off"
              }
            ]
          }, {
            "featureType": "road",
            "elementType": "labels",
            "stylers": [{
                "visibility": "off"
              }
            ]
          }, {
            "featureType": "road",
            "stylers": [{
                "saturation": -100
              }, {
                "visibility": "simplified"
              }
            ]
          }, {
            "featureType": "landscape.natural",
            "stylers": [{
                "saturation": -100
              }
            ]
          }, {
            "featureType": "landscape.man_made",
            "stylers": [{
                "saturation": -100
              }, {
                "visibility": "on"
              }
            ]
          }, {
            "featureType": "administrative",
            "stylers": [{
                "visibility": "on"
              }, {
                "lightness": 56
              }, {
                "saturation": -100
              }
            ]
          }, {
            "featureType": "poi",
            "stylers": [{
                "visibility": "off"
              }
            ]
          }, {
            "featureType": "poi",
            "stylers": [{
                "visibility": "off"
              }
            ]
          }, {
            "featureType": "road.highway",
            "stylers": [{
                "visibility": "on"
              }, {
                "saturation": -100
              }, {
                "lightness": 43
              }
            ]
          }, {
            "featureType": "road.highway",
            "elementType": "labels",
            "stylers": [{
                "visibility": "off"
              }
            ]
          }, {
            "featureType": "administrative",
            "stylers": [{
                "visibility": "on"
              }
            ]
          }, {
            "featureType": "road.highway",
            "elementType": "labels",
            "stylers": [{
                "visibility": "off"
              }
            ]
          }, {
            "featureType": "road.highway",
            "stylers": [{
                "visibility": "on"
              }, {
                "lightness": -14
              }
            ]
          }, {
            "featureType": "road.highway",
            "elementType": "labels",
            "stylers": [{
                "visibility": "off"
              }
            ]
          }, {}
        ];
        
        var speed = <?php echo '30'?>;
        
        var coordsCSV = [
          <?php echo "51.45178992808702, 5.4803312853325385,
            51.45191764968443, 5.480577425103211,
            51.45194543736916, 5.480734114083981,
            51.45194785514837, 5.480814586212715";
          ?>
        ]

        var CSVtoLatLng = function (coords) {
          if (coords.length % 2 !== 0) return [];

          var latLngPairs = [];
          for (var i = 0; i < coords.length / 2; i += 2) {
            latLngPairs.push(new google.maps.LatLng(coords[i], coords[i + 1]));
          }
          return latLngPairs;
        };

        var speedToColor = function(speed) {
          if(speed <= 0 ) {
            return "#000";
          } else if (speed <= 10) {
            return "#0f0";
          } else if (speed <= 30) {
            return "#00f";
          } else {
            return "#0ff";
          }
        }
        
        var flightPath = new google.maps.Polyline({
            path: CSVtoLatLng(coordsCSV),
            strokeColor: speedToColor(speed),
            strokeOpacity: 0.8,
            strokeWeight: 1
          });

        var mapOptions = {
          center: new google.maps.LatLng(51.451592, 5.480133),
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          styles: mapStyle
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
        flightPath.setMap(map);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </body>
</html>