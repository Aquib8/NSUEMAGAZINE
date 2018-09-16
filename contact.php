<!DOCTYPE html>
<html>
  <head>
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      #right-panel {
        height: 100%;
        float: right;
        width: 390px;
        overflow: auto;
      }
      #map {
        height: 100%;
        margin-right: 400px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
            @media print {
        #map {
          height: 500px;
          margin: 0;
        }
        #right-panel {
          float: none;
          width: auto;
        }
      } 
    </style>
  </head>
  <body>
        
  <header>
        
        <div class="container">
            <a href="index.php" class="logo">
                <img src="logo.jpg" alt="NSU E-magazine" id="nylogo">
            </a>
        </div>
        <div class="navbar">
            <ul id="navItems">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="newPost.php">Compose</a></li>
                <li><a href="allArticles.php">Browse Articles</a></li>
                
            </ul>
        </div>

    </header>


    
    <div id="right-panel"></div>
    <div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow, pos;
      function initMap() {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 41.85, lng: -87.65},
          zoom: 1
        });
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('right-panel'));

        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
             pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('You are Here.');
            infoWindow.open(map);
            map.setCenter(pos);
            calculateAndDisplayRoute(directionsService, directionsDisplay);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        // var start = document.getElementById('start').value;
        // var end = document.getElementById('end').value;
        //var start ="chicago, il";
        var start = pos;
        directionsService.route({
          origin: start,
          destination: {lat: 23.814893,lng: 90.425735},
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvybibU7s23-D58Z4_4basp0_C24KIHXc&callback=initMap">
    </script>




    <footer align="center">
        <div class="copyright">
            <a href="www.google.com">© 2018 NSU E-magazine</a>
        </div>
        <div class="helpfulLinks">
            <ul>
                <li><a href="www.google.com">Help</a></li>
                <li><a href="www.google.com">Feedback</a></li>
            </ul>
        </div>
        <div class="socialLinks">
            <ul>
                <li><a href="www.facebook.com">Facebook</a></li>
                <li><a href="www.twitter.com">Twitter</a></li>
            </ul>
        </div>
        
    </footer>
  </body>
</html>