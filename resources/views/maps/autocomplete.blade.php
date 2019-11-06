<!DOCTYPE html>
<html>
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
      
    <title>Autocomplete Address Search Box using Google Maps Javascript API</title>
    <style type="text/css">
        .mapControls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }
        #searchMapInput {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 50%;
        }
        #searchMapInput:focus {
            border-color: #4d90fe;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark">

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
    </nav>
    <div class="card row">
        <div class="col-md-12">  
            <h1>Autocomplete Address Search Box using Google Maps Javascript API</h1>
              
            <input id="searchMapInput" class="mapControls" type="text" placeholder="Enter a location">
            <ul id="geoData">
                <li>Full Address: <span id="location-snap"></span></li>
                <li>Latitude: <span id="lat-span"></span></li>
                <li>Longitude: <span id="lon-span"></span></li>
            </ul>
              <div class="col-md-6">
              <div class="map" id="map"></div>
            </div>
        </div>
    </div>
</body>
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
<script>
//intializtion of map for autocomplete suggation
function initMap() {
    var input = document.getElementById('searchMapInput');
    var bangaloreBounds = new google.maps.LatLngBounds(
          new google.maps.LatLng(12.864162, 77.438610),
          new google.maps.LatLng(13.139807, 77.711895));
    var options = { 
          types: ['(cities)'],
          bounds: bangaloreBounds,
          componentRestrictions: {country: 'in'},
          strictBounds: true,
        };

        
        var autocomplete = new google.maps.places.Autocomplete(input, options);
   
    // autocomplete.setComponentRestrictions({'country': ['in']});
      
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        document.getElementById('location-snap').innerHTML = place.formatted_address;
        document.getElementById('lat-span').innerHTML = place.geometry.location.lat();
        document.getElementById('lon-span').innerHTML = place.geometry.location.lng();
    });
}


//code to move marker when device moves
var map ,marker ;

function initMap2(){
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
            lat = position.coords.latitude;
            lng = position.coords.longitude;
            pos = {
                lat: lat,
                lng: lng
            };
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 7,
                center: pos,
                scrollwheel:true,
            });
            latlng =  new google.maps.LatLng(lat,lng);
            marker = new google.maps.Marker({
                position: latlng,
                map: map,
          });
            
        });   
    } 
}

function moveMarker(map, marker, latlng) {
    console.log("latlng",latlng);
    marker.setPosition(latlng);
    map.panTo(latlng);
    setTimeout(function(latlng) {        
        // autoRefresh(map, marker, latlng);
    }, 3000 , latlng);
}

function autoUpdate() {

  navigator.geolocation.getCurrentPosition(function(position) {  
    var newPoint = new google.maps.LatLng(position.coords.latitude, 
                                          position.coords.longitude);

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


    if (marker) {
      // Marker already created - Move it
      marker.setPosition(newPoint);
    }
    else {
      // Marker does not exist - Create it
      marker = new google.maps.Marker({
        position: newPoint,
        map: map,
        // icon:icon2
      });
    }

    // Center the map on the new position
    // map.setCenter(newPoint);
  }); 

  // Call the autoUpdate() function every 5 seconds
  setTimeout(autoUpdate, 5000);
}

autoUpdate();
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&&key=YOUR_API_KEY&callback=initMap" async defer></script>
  
</body>
</html>