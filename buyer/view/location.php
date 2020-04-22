<?php
include('../../connect.php');

$result = $conn->query("SELECT * FROM buyers WHERE id = '$id'");
$row = $result->fetch_assoc();

?>

<div class="container py-3">
    <script>
        $(document).ready(function() {

            // Where you want to render the map.
            // var element = document.getElementById('osm-map');

            // // Height has to be set. You can do this in CSS too.
            // element.style = 'height:300px;';


            // // Create Leaflet map on map element.
            // var map = new L.map(element);

            // Add OSM tile leayer to the Leaflet map.
            // L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            //     attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            // }).addTo(map);
            // L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);

            // Target's GPS coordinates.
            // var target = L.latLng('27.2038', '77.5011');

            // // Set map's center to target with zoom 14.
            // map.setView(target, 14);

            // Place a marker on the same location.
            // L.marker(target).addTo(map);

            // map.on('click', function(e) {
            //     var coord = e.latlng;
            //     var lat = coord.lat;
            //     var lng = coord.lng;
            //     console.log("You clicked the map at latitude: " + lat + " and longitude: " + lng);

            //     target = L.latLng(lat, lng);
            //     L.marker(target).addTo(map);

            // });
            // var theMarker = {};

            // map.on('click', function(e) {
            //     lat = e.latlng.lat;
            //     lon = e.latlng.lng;

            //     console.log("You clicked the map at LAT: " + lat + " and LONG: " + lon);
            //     //Clear existing marker, 

            //     if (theMarker != undefined) {
            //         map.removeLayer(theMarker);
            //     };

            //     //Add a marker to show where you clicked.
            //     theMarker = L.marker([lat, lon]).addTo(map);
            // });

            // if (navigator.geolocation) {
            //     navigator.geolocation.getCurrentPosition(showPosition);
            // } else {
            //     x = "Geolocation is not supported by this browser.";
            // }

            // function showPosition(position) {
            //     x = "Latitude: " + position.coords.latitude +
            //         "<br>Longitude: " + position.coords.longitude;
            //     console.log(x);
            // }

            navigator.geolocation.getCurrentPosition(function(location) {
                var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

                var mymap = L.map('mapid').setView(latlng, 16)
                L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                    // attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://mapbox.com">Mapbox</a>',
                    maxZoom: 18,
                    id: 'mapbox.streets',
                    accessToken: 'pk.eyJ1IjoiYmJyb29rMTU0IiwiYSI6ImNpcXN3dnJrdDAwMGNmd250bjhvZXpnbWsifQ.Nf9Zkfchos577IanoKMoYQ'
                }).addTo(mymap);

                mymap.attributionControl.setPrefix(''); // Don't show the 'Powered by Leaflet' text. Attribution overload


                // var marker = L.marker(['51.062061699999997', '72.878826']).addTo(mymap);
                var marker = L.marker(latlng).addTo(mymap);
            });
        })
    </script>
    <style>
        #mapid {
            height: 200px;
            z-index: 1;
            width: 100%;
        }
    </style>


    <p class="display-4 text-center">Location</p>
    <div class="card my-3 <?php echo ($row['pincode'] == '0') ? 'd-none' : ''; ?> ">
        <div class="card-body small">
            <p class=""><b>Address : </b> <?php echo $row['address'] ?></p>
            <div class="divider mb-3"></div>
            <p class="h5 text-center"><i class="fa fa-map-marker text-danger"></i> Your Location Pointer </p>
            <p class="mb-0 text-center">
                <?php echo  $row['area'] . ' - ' . $row['region'] . ', ' . $row['district'] . ', ' . $row['state'] . ' - ' . $row['pincode'] ?>
            </p>
        </div>
    </div>
    <!-- <div class="card mb-3">
        <div id="mapid"></div>
        <div id="osm-map"></div>
    </div> -->

    <div class="card">
        <div class="card-body">
            <form id="address_form" action="" method="post">
                <p class="h5 text-center mb-3 text-info"><i class="fa fa-street-view"></i> Update Location</p>
                <div class="divider mb-2"></div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" rows="4" style="resize:unset" maxlength="200" class="form-control text-justify"><?php echo $row['address'] ?></textarea>
                </div>

                <p class="h6 text-center mb-3"><i class="fa fa-map-marker text-danger"></i> Set Location Pointer</p>
                <div class="form-group">
                    <label>Pincode</label>
                    <input type="number" class="form-control" maxlength="6" value="<?php echo ($row['pincode'] == '0') ? '' : $row['pincode'] ?>" name="pincode" placeholder="000000" required>
                    <small class="text-danger">*This can take lang time to search. Please Wait</small>
                </div>
                <div class="form-group">
                    <label>State</label>
                    <input type="input" class="form-control" name="state" value="<?php echo $row['state'] ?>" placeholder="State" readonly required>
                </div>
                <div class="form-group">
                    <label>District</label>
                    <input type="input" class="form-control" name="district" value="<?php echo $row['district'] ?>" placeholder="District" readonly required>
                </div>
                <div class="form-group">
                    <label>Area</label>
                    <select class="form-control" name="area" required>
                        <?php echo (isset($row['area'])) ?
                            ' <option value="' . $row['area'] . '">' . $row['area'] . '</option>' :
                            ' <option value="">--- Select Area ---</option>'
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Region</label>
                    <select class="form-control" name="region" required>
                        <option value="">--- Select Area ---</option>;
                        <option value="E">East (E)</option>
                        <option value="W">West (W)</option>
                        <option value="U">None</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" name="update_address">Update</button>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    $('#address_form').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "request/manage_location.php",
            data: ($(this).serialize() + '&' + $.param({
                'operation': 'update_address'
            })),
            success: function(data) {
                location.reload();
            }
        });
    })

    $('[name="pincode"]').on("input propertychange", function() {
        var searchField = $(this).val();

        if (searchField.length == 6) {
            $('.overlay').fadeIn();
            $('.loading').fadeIn();

            $.ajax({
                dataType: "json",
                url: '../address_map.json',
                success: function(data) {
                    $.each(data, function(key, val) {
                        if (val.p == searchField) {
                            $('[name="state"]').val(val.s);
                            $('[name="district"]').val(val.d);
                            $('[name="area"]').append('<option class="dynamic" value="' + val.a + '">' + val.a + '</option>');
                        }
                    });
                    $('.overlay').fadeOut();
                    $('[name="area"]').focus();
                    $('.loading').fadeOut();
                }
            });
        } else {
            $('[name="state"]').val('');
            $('[name="district"]').val('');
            $('[name="area"]').html('<option value="">--- Select Distict ---</option>');
        }
    });
</script>