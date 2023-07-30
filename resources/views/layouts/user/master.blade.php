<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title','')</title>
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCDv4AewhqtQJzy1Dy7CbDpTH8dA_6mzEU&callback=initMap&libraries=&v=weekly&sensor=false"
        defer></script>
     <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #gmp-map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
   
<script>
 "use strict"; 
 
    


    //var geocoder;
    //function initialize() {
    //geocoder = new google.maps.Geocoder();



    //}
   
    function initMap() {
      /** var myLatLng = {
            lat: 40.12150192260742,
            lng: -100.45039367675781
        }; **/
        const map = new google.maps.Map(document.getElementById("gmp-map"), {
            zoom: 4,
           // center: myLatLng,
            fullscreenControl: false,
            zoomControl: true,
            streetViewControl: false
        });
        //new google.maps.Marker({
         //   position: myLatLng,
         //   map,
         //   title: "My location"
      //  });

         let infoWindow = new google.maps.InfoWindow();
       
     //    map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);



const options = {
        enableHighAccuracy: true,
        // Get high accuracy reading, if available (default false)
        timeout: 5000,
        // Time to return a position successfully before error (default infinity)
        maximumAge: 2000,
        // Milliseconds for which it is acceptable to use cached position (default 0)
    };
    navigator.geolocation.watchPosition(success, error, options);
    // Fires success function immediately and when user position changes
    function success(pos) {
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;
        const accuracy = pos.coords.accuracy; // Accuracy in metres
        document.getElementById('latlng').value = `[${lat},${lng}]`

        //codeLatLng(lat, lng) 
        document.getElementById('output').innerText = `
            User coordinates: 
            Latitude ${lat}.
            Longitude ${lng}.
            Estimation accurate within ${Math.round(accuracy)} metres.`;



const poss = {
            lat: pos.coords.latitude,
            lng: pos.coords.longitude,
          };

          infoWindow.setPosition(poss);
          infoWindow.setContent("Location found.");
          infoWindow.open(map);
          map.setCenter(poss);


 new google.maps.Marker({
            position: poss,
            map,
            title: "My location"
        });

         codeLatLng(lat, lng) 

            
    }

    function error(err) {
        if (err.code === 1) {
            alert("Please allow geolocation access");
            // Runs if user refuses access
        } else {
            alert("Cannot get current location");
            // Runs if there was a technical problem.
        }
    }

    map.addListener('click', function(e) {
  var lat = e.latLng.lat();
  var lng = e.latLng.lng();
  
   codeLatLng(lat, lng) 
});

    }
//window.initMap = initMap;
   var city, country;
    function codeLatLng(lat, lng) {
  
         var geocoder = new google.maps.Geocoder();

        var latlng = new google.maps.LatLng(lat, lng);
        geocoder.geocode({
            'latLng': latlng
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
           //     console.log(results)
                
                if (results[1]) {
                    //formatted address
                 //   alert(results[0].formatted_address)
                    //find country name
                    for (var i = 0; i < results[0].address_components.length; i++) {
                        for (var b = 0; b < results[0].address_components[i].types.length; b++) {

                            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                            if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                                //this is the object you are looking for
                                city = results[0].address_components[i];
                                break;
                            }

                             if (results[0].address_components[i].types[b] == "country") {
                                //this is the object you are looking for
                                country = results[0].address_components[i];
                                break;
                            }
                        }
                    }
                    //city data
                    //console.log(country)
                   // console.log(city.short_name + " " + city.long_name)
                     document.getElementById('name').value = city.long_name + ", " + country.long_name

 

                } else {
                    alert("No results found");
                }
            } else {
                alert("Geocoder failed due to: " + status);
            }
        });
         

    }

</script>
</head>

<body id="page-top">
    @if (session()->has('message'))
    <div class="alert alert-success">
        hello
        {{-- {{ session('message') }} --}}
    </div>
    @endif
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.user.navigation')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.user.header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                @yield('content')

            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>

        </div>

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>
    {{-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAoIgr3FWS30QCCWmLdp8C0DRQFf4GxHEc&sensor=false"></script>  --}}

    <!-- Page level plugins -->
    {{-- <script src="{{asset('assets/vendor/chart.js/Chart.min.js')}}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{asset('assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('assets/js/demo/chart-pie-demo.js')}}"></script> --}}



</body>

</html>
