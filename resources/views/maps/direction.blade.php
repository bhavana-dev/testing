<!doctype html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.6/css/swiper.min.css"/>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
      <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clusterize.js/0.18.0/clusterize.min.css">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <script src="https://cdn.tiny.cloud/1/zhx39j2ohsweb3po62947uwrnum0n1xhy3t5ospk0vkgobcs/tinymce/5/tinymce.min.js"></script>
      <script>tinymce.init({selector: 'textarea', height: 500});</script>
      <link rel="stylesheet" href="{{ url('/css/main.css') }}">
      <link rel="stylesheet" href="{{url('/css/loading-bar.css')}}">
      
      @yield('head')
      <title>@yield('title')</title>
      <style type="text/css">
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
        }
        #floating-panel {
          position: absolute;
          top: 10px;
          left: 25%;
          z-index: 5;
          background-color: #fff;
          padding: 5px;
          border: 1px solid #999;
          text-align: center;
          font-family: 'Roboto','sans-serif';
          line-height: 30px;
          padding-left: 10px;
        }
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
          overflow: auto;
        }
        #floating-panel {
          background: #fff;
          padding: 5px;
          font-size: 14px;
          font-family: Arial;
          border: 1px solid #ccc;
          box-shadow: 0 2px 2px rgba(33, 33, 33, 0.4);
          display: none;
        }
        @media print {
          #right-panel {
            float: none;
            width: auto;
          }
        }
      </style>
  </head>

  <body>
    <!-- <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li>
                    <a class="nav-link" href="/">LotHub</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <a class="nav-link" id="menu1" href="/">Historically Platted Lots</a>
                </li>
                <li>
                    <a class="nav-link " id="menu2" href="/VacantProperties">Vacant Lots</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="menu3" href="/location">Address Search </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="menu4" href="/person">Person Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="menu4" href="/hpl2">hpl2</a>
                </li>
                <li class="nav-item">
                    <a href="/savedproperties" target="_blank" id="menu5" class="nav-link">Saved Properties</a>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>
    </nav> -->
    <!-- <div id="loading"></div>
    <div id="isLoaded"> -->
    <div class="card" style="flex-direction: unset;">
      <div class="col-md-6">
        <div class="map" id="map"></div>
      </div>
      <div class="col-md-6">
        <div id="right-panel"></div>
      </div>
      
    </div>
  

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.6/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clusterize.js/0.18.0/clusterize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
    <script src="{{ url('/js/bootstrap-notify.min.js') }}"></script>
    <script src="{{ url('/js/cookies.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="module" src=" {{ url('/js/siema.js') }}"></script>
    <script src="{{url('/js/loading-bar.js')}}"></script>
    <script src=" {{ url('/js/MapLibrary.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.6/js/swiper.min.js"></script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places,drawing"></script>
    
    <script src=" {{ url('/js/notify.js') }}"></script>


    
    <script>
      var lat ,lng , directionsRenderer ,pos ,start ,map, marker;
      var pointsArray = [];
      initMap();

      //intialization of map
      function initMap() {
        
        //check for current location of user
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position){
              lat = position.coords.latitude;
              lng = position.coords.longitude;
              pos = {
                      lat: lat,
                      lng: lng
                    };

              var latlng = new google.maps.LatLng(lat, lng);
              //geocoding to get address from lat long 
              var geocoder = geocoder = new google.maps.Geocoder();
              geocoder.geocode( { 'latLng': latlng}, function(results, status) {
                  if (status == 'OK') {
                      start =  results[1].formatted_address;
                      var markerOption = {
                          clickable: true,
                          icon: '/Img/icons/pin_b.png',
                      };
                      directionsRenderer = new google.maps.DirectionsRenderer({draggable : true},{ markerOptions: markerOption });
                      var directionsService = new google.maps.DirectionsService;
                     
                      map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 7,
                        center: pos,
                        scrollwheel:true,
                      });

                      directionsRenderer.setMap(map);
                      directionsRenderer.setPanel(document.getElementById('right-panel'));

                      //function to set line on map between two points
                      calculateAndDisplayRoute(directionsService, directionsRenderer,start);
                      
                  } else {
                      alert('Geocode was not successful for the following reason: ' + status);
                  }
              });

            });

        }else{
          alert("Something went wierd...");
        }
       
      }

      function calculateAndDisplayRoute(directionsService, directionsRenderer,start) {
       
        var end = "{{$destination}}";
        directionsService.route({
          origin: start,
          destination: end,
          travelMode: 'WALKING' //WALKING ,DRIVING, TRANSIT
        }, function(response, status) {
          if (status === 'OK') {
              pointsArray = response.routes[0].overview_path;
             
              directionsRenderer.setDirections(response);
              //refresh marker with set time
              autoRefresh(map, pointsArray);
              
          } else {
            alert('Directions request failed due to ' + status);
          }
        });
      }

      //code to set position of marker on map
      function moveMarker(map, marker, latlng) {
          marker.setPosition(latlng);
          map.panTo(latlng);
      }

      function autoRefresh(map, pathCoords) {
          var i, route, marker;
          
          route = new google.maps.Polyline({
              path: [],
              geodesic : true,
              strokeColor: '#FF0000',
              strokeOpacity: 1.0,
              strokeWeight: 2,
              editable: false,
              map:map
          });

          //car icon svg
          var car = "M17.402,0H5.643C2.526,0,0,3.467,0,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759c3.116,0,5.644-2.527,5.644-5.644 V6.584C23.044,3.467,20.518,0,17.402,0z M22.057,14.188v11.665l-2.729,0.351v-4.806L22.057,14.188z M20.625,10.773 c-1.016,3.9-2.219,8.51-2.219,8.51H4.638l-2.222-8.51C2.417,10.773,11.3,7.755,20.625,10.773z M3.748,21.713v4.492l-2.73-0.349 V14.502L3.748,21.713z M1.018,37.938V27.579l2.73,0.343v8.196L1.018,37.938z M2.575,40.882l2.218-3.336h13.771l2.219,3.336H2.575z M19.328,35.805v-7.872l2.729-0.355v10.048L19.328,35.805z";
          var icon2 = {
              path: car,
              scale: .7,
              strokeColor: 'white',
              strokeWeight: .10,
              fillOpacity: 1,
              fillColor: '#404040',
              offset: '5%',
              // rotation: parseInt(heading[i]),
              anchor: new google.maps.Point(10, 25) // orig 10,50 back of car, 10,0 front of car, 10,25 center of car
          };
          
          marker=new google.maps.Marker({map:map, icon:icon2});

          for (i = 0; i < pathCoords.length; i++) {                
              setTimeout(function(coords) {
                  // route.getPath().push(coords);
                  moveMarker(map, marker, coords);
              }, 2000 * i, pathCoords[i]);
          }
      }



    </script>

</body>
</html>