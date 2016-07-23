
<?php 
/*
header('Content-type: text/html; charset=utf-8');
include_once("mysql.php");
$Table="file";
$Table2="dst";

session_start();

$result =mysqli_query($conn,"SELECT * FROM $Table 
                            WHERE additem='1'
                            AND username='{$_SESSION['userName']}'");
$num =mysqli_num_rows($result);
echo $num;

$arr=array();
for ($i=0;$i<$num;$i++){
  $row=mysqli_fetch_array($result);
  array_push($arr,$row['dnum']);
}
print_r($arr) ;
json_encode($arr);
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Life is Travel.</title>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="assets/animate/animate.css" />
<link rel="stylesheet" href="assets/animate/set.css" />
<link rel="stylesheet" href="assets/gallery/blueimp-gallery.min.css">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">

<link rel="stylesheet" href="assets/style.css">

<script type="text/javascript" src="jquery.min.js"></script>
</head>


<body>
<button onclick="drop()">555</button>
<!-- Map Starts-->
<div id="floating-panel">
    <input id="address" type="textbox" value="Taichung Train Station">
    <input id="submit" type="button" value="Search">
</div>

<div id="map" style="width: 500px; height: 300px"></div>

<script>
/*
var s= JSON.stringify(arr);
alert(s);
*/
var neighborhoods = [
  {lat: 24.1378, lng: 120.683},
  {lat: 22.997116, lng: 120.641},
  {lat: 24.183596, lng: 120.610653},
  {lat: 24.17, lng: 120.63},
  {lat: 24.15, lng: 120.66},
  {lat: 24.14, lng: 120.65}
];

var neighborhoods2 = [
  "宮原眼科",
  "台中歌劇院",
  "東海大學",
  "東海",
  "5",
  "6"
];



var markers = [];
var map;

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: {lat:24.136918 ,lng:120.685148}
  });
}

function drop() {
  clearMarkers();
  for(i=0;i<s.length;i++){
    addMarkerWithTimeout(neighborhoods[i], i * 200,neighborhoods2[i]);
  }
}

function addMarkerWithTimeout(position, timeout,index) {
  window.setTimeout(function() {
    markers.push(new google.maps.Marker({
      position: position,
      map: map,
      title:index,
      animation: google.maps.Animation.DROP
    }));
  }, timeout);
}

function clearMarkers() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
  markers = [];
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJHpvTDXyRQ_vf2DLT1tlFytkLSB2WbPQ&signed_in=true&callback=initMap"
async defer></script>
<!-- Map Ends-->

</body>
</html>