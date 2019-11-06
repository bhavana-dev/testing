@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
        <div class="col-md-2">
            <div id='printoutPanel'></div>
            <div id='directionsInputContainer'></div>
            <div id='myMap' style='width: 87vw; height: 100vh;'></div>
        </div>
    </div>
  </div>
  <script type='text/javascript'>
            function loadMapScenario() {
              navigator.geolocation.getCurrentPosition(function (position) {
                  var loc = new Microsoft.Maps.Location(
                      position.coords.latitude,
                      position.coords.longitude);
                  
                  var map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
                      /* No need to set credentials if already passed in URL */
                      center: loc,
                      zoom: 12
                  });
                  Microsoft.Maps.loadModule('Microsoft.Maps.Directions', function () {
                      var directionsManager = new Microsoft.Maps.Directions.DirectionsManager(map);
                      directionsManager.setRenderOptions({ itineraryContainer: document.getElementById('printoutPanel') });
                      directionsManager.showInputPanel('directionsInputContainer');
                      directionsManager.setRequestOptions({ routeMode: Microsoft.Maps.Directions.RouteMode.transit });//bing doesn't offer 
                  });
              });
                
                
            }
        </script>
        <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=YOUR_API_KEY&callback=loadMapScenario' async defer></script>
@endsection
