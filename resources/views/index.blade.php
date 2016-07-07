<!DOCTYPE html>
<html>
    <head>
        <title>IATA code reader</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/style.css')}}" rel="stylesheet">


    </head>
    <body>


            <div class="container" style="font-family: arial, helvetica, sans-serif;color: #000000; ">

 <div class="row">
    <div class="col-md-offset-5 ">
        <form action="{{url('form/submit')}}" method="post">
            <div class="col-md-4">
                <h6><small class="disabled">Ex : (SLK ,SLP,CMB )</small></h6>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="text" class="form-control" placeholder="IATA code" value="{{$data['name'] or ''}}" name="a">

            <input type="submit" class="btn btn-success" style="margin-top:20px;"></div>
        </form>
    </div>
 </div>
@if(!isset($error))
   {{$error=false}}
@endif

    @if (isset($name) && !empty($name))


    <div class="row">
        <div class="col-md-offset-4 " style="margin-top:10px;//text-align: left">
        <div class="col-md-6">
            <label>Airport Name : <small>{{$name or ''}}</small></label><br>
            <label>Country : <small>{{$country or ''}}</small></label><br>
            <label>City : <small>{{$city or ''}}</small></label><br>

             </div>
        </div>
    </div>
<div class="col-md-offset-4">
        <div id="map" class="col-md-6"></div>
</div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAV_uHZx3HNvDLRJdRFdbjcA6jMu1fY4dY"></script>
        <script>



            var lat= {{$lat}};
            var lng= {{$lng}};

            //var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            //var labelIndex = 0;


            function initialize() {



                var customMapType = new google.maps.StyledMapType([
                    {
                        stylers: [
                            {hue: '#f2dede'},//#890000
                            {visibility: 'simplified'},
                            {gamma: 0.5},
                            {weight: 0.5}
                        ]
                    },
                    {
                        elementType: 'labels',
                        stylers: [{visibility: 'off'}]
                    },
                    {
                        featureType: 'water',
                        stylers: [{color: '#bce8f1'}]
                    }
                ], {
                    name: 'Custom Style'
                });
                var customMapTypeId = 'custom_style';



                var locations={ lat: lat, lng: lng };
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    center: locations,
                    mapTypeControl:false,
                    mapTypeControlOptions: {
                        mapTypeIds: [google.maps.MapTypeId.ROADMAP, customMapTypeId]
                    }
                });

                // This event listener calls addMarker() when the map is clicked.
                /*google.maps.event.addListener(map, 'click', function(event) {
                    addMarker(event.latLng, map);
                });*/

                // Add a marker at the center of the map.
                addMarker(locations, map);

                map.mapTypes.set(customMapTypeId, customMapType);
                map.setMapTypeId(customMapTypeId);
            }

            // Adds a marker to the map.
            function addMarker(location, map) {
                // Add the marker at the clicked location, and add the next-available label
                // from the array of alphabetical characters.
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }

            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
@elseif($error==true)
  <div class="margin">
   <div class="col-md-4 col-md-offset-4">
        <div class="alert alert-danger">Error in IATA Code</div>
   </div>
  </div>
@endif

        </div>


    <footer>
        <div class="container">
        <h5><small class="disabled">Developed by Chathura Jayaranga Siriwardhana</small></h5>
        </div>
    </footer>
    </body>
</html>
