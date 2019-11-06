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
    <!-- <div id="loading"></div>
    <div id="isLoaded"> -->
    <div class="card row">

      <div class="col-md-12">   
       <h4>Nearby Places </h4>     
        <div class="col-md-6">
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" value="restaurant" id="defaultCheckedHotels" name="defaultExample2" >
            <label class="custom-control-label" for="defaultCheckedHotels">Restaurant</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" value="atm" id="defaultCheckedatm" name="defaultExample2" >
            <label class="custom-control-label" for="defaultCheckedatm">Atm</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" value="airport" id="defaultCheckedairport" name="defaultExample2" >
            <label class="custom-control-label" for="defaultCheckedairport">Airport</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" value="bank" id="defaultCheckedbank" name="defaultExample2" >
            <label class="custom-control-label" for="defaultCheckedbank">Bank</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map" id="map"></div>
        </div>
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
initMap();

var map ,infowindow ,myPlace ,markerCluster ,lat ,lng ,pos;
var  typeNearBy= 'restaurant';
var homemarkers = [];

//Map initialization
function initMap() {
  //current location check
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position){
      lat = position.coords.latitude;
      lng = position.coords.longitude;
      pos = {
              lat: lat,
              lng: lng
            };

      infowindow = new google.maps.InfoWindow();
 
      var elevator;
      var polygonArray = [];
      var myOptions = {
          zoom: 9,
          center: pos,
          scrollwheel:true
      };

      map = new google.maps.Map($('#map')[0], myOptions);  
       
      marker = new google.maps.Marker({
        position: pos,
        map: map,
        animation: google.maps.Animation.DROP,    
      });

      //code to add custom icon on map
      var controlDiv = document.createElement('div');
      var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.border = '2px solid #fff';
        controlUI.style.borderRadius = '2px';
        controlUI.style.boxShadow = 'rgba(0, 0, 0, 0.3) 0px 1px 4px -1px';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginLeft = '216px';
        controlUI.style.marginTop = '5px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Click to recenter the map';
        controlDiv.appendChild(controlUI);

      // Set CSS for the control interior.
      var controlText = document.createElement('div');
        controlText.style.color = 'rgb(25,25,25)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '16px';
        controlText.style.lineHeight = '20px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = '<i class="fa fa-trash-o"></i>';
        //<i class="fa fa-trash-o"></i>
        controlUI.appendChild(controlText);

        controlUI.addEventListener('click', function() {
          alert("manager clicked");
        }); 

      map.controls[google.maps.ControlPosition.TOP_LEFT].push(controlUI);

      //nearby places marked on map
      var service = new google.maps.places.PlacesService(map);
                service.nearbySearch({
                    location : new google.maps.LatLng(lat,lng),
                    radius : 5000,
                    type : [ typeNearBy ]
                }, callback);

      //drawing manager tool
      var drawingManager = new google.maps.drawing.DrawingManager({
        drawingControl: true,
        drawingControlOptions: {
          position: google.maps.ControlPosition.TOP_CENTER,
          drawingModes: ['circle', 'polygon', 'polyline', 'rectangle','marker']
        },      
        circleOptions: {
          fillColor: '#ffff00',
          fillOpacity: 1,
          strokeWeight: 5,
          clickable: false,
          editable: true,
          zIndex: 1
        }
      });
      drawingManager.setMap(map);

      //drawing tools complete events 
      google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
          // console.log(polygon);
              for (var i = 0; i < polygon.getPath().getLength(); i++) {
                 polygonArray[i]= polygon.getPath().getAt(i).toUrlValue(6) ;
                 console.log("LatLong "+[i]+": "+polygonArray[i]);
                 // 
              }
              polygonArray.push(polygon);
      });
      google.maps.event.addListener(drawingManager, 'circlecomplete', function(circle) {
        var radius = circle.getRadius();
        console.log(circle.getCenter());
      });
      google.maps.event.addListener(drawingManager, 'markercomplete', function(marker) {
        
        console.log(marker.getPosition());
      });
      google.maps.event.addListener(drawingManager, 'polylinecomplete', function(line) {
      });
      google.maps.event.addListener(drawingManager, 'rectanglecomplete', function(rectangle) {  
      });
      
    });
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}

//nearby radio change event
$('input:radio[name=defaultExample2]').change(function() {
    typeNearBy = $(this).val();
    // markerCluster.clearMarkers();
    setMapOnAll(null);

    var service = new google.maps.places.PlacesService(map);
            service.nearbySearch({
                location : pos,
                radius : 5000,
                type : [ typeNearBy ]
            }, callback);
});

//callback function of nearby places
function callback(results, status) {
  
  if (status === google.maps.places.PlacesServiceStatus.OK) {
      for (var i = 0; i < results.length; i++) {
          createMarker(results[i]);        
      }
      markerCluster = new MarkerClusterer(map, homemarkers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
  }
}

//clear all marker
function setMapOnAll(map) {
  
  for (var i = 0; i < homemarkers.length; i++) {
    
      homemarkers[i].setMap(null);
  }
  homemarkers = [];

  // Clears all clusters and markers from the clusterer.
  markerCluster.clearMarkers();
}

//placed all marker on map with infowindow
function createMarker(place) {
    
    var placeLoc = place.geometry.location;
    marker = new google.maps.Marker({
        map : map,
        position : place.geometry.location,
        icon: 'Img/icons/pin.png'
    });

    google.maps.event.addListener(marker, 'click', function() {
      
      var html = "<br> <a href='get/direction?destination="+place.vicinity+"' target='_blank'>Show Direction</a>";
        infowindow.setContent(place.name+html);
        infowindow.open(map, this);
    });
    homemarkers.push(marker);
}

</script>
</body>
</html>