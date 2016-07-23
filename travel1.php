<?php
header('Content-type: text/html; charset=utf-8');
include_once("mysql.php");
$Table="file";
$Table2="user";
$Table3="file2";

session_start();

if (!empty($_POST['name'])&!empty($_POST['content'])){          // Edit Button send  
  $sql="INSERT edit (username, edit)
        VALUES ('{$_POST['name']}','{$_POST['content']}')";
  mysqli_query($conn, $sql);
}

if(isset($_POST['tain']))     // dst Button click
   $_SESSION["ds"]=1;
 
else
    $_SESSION["ds"]=0;
    
$result1 =mysqli_query($conn,"SELECT * FROM $Table 
                            WHERE additem='1'
                            AND username='{$_SESSION['userName']}'");
$num =mysqli_num_rows($result1);
echo $num;

$arr=array();
for ($i=0;$i<$num;$i++){
  $row=mysqli_fetch_array($result1);
  array_push($arr,$row['dnum']);
}
print_r($arr) ;
echo json_encode( $arr );
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

</head>


<body>
    <button onclick="drop()">555</button>
<div class="topbar animated fadeInLeftBig"></div>

<!-- List Starts -->
<?php

if($_SESSION['ds']=="0")
$result=mysqli_query($conn,"SELECT * FROM $Table WHERE username ='{$_SESSION['userName']}' AND additem ='1'"); 
else
$result=mysqli_query($conn,"SELECT * FROM $Table3 WHERE username ='{$_SESSION['userName']}' AND additem ='1'"); 

echo "<div class='overlay spacer'>
        <div class='container'>";
?>        
 <form method="post" action="">
  <button  name="taic" type="submit">Taichung</button> 
  <button  name="tain" type="submit">Tainan</button> 
</form>       


<div class="clearfix">


  <div class="col-sm-6 partners  wowload fadeInRight">
    <div id="floating-panel">
        <input id="address" type="textbox" value="Taichung Train Station">
        <input id="submit" type="button" value="Search">
    </div>
    <div id="map" style="width: 500px; height: 300px"></div>
        
  </div>

</div>

<!-- Map Starts -->
<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center:  new google.maps.LatLng(24.136918, 120.685148)
    });
  
    var marker = new google.maps.Marker({
    		position : new google.maps.LatLng(24.136918, 120.685148)
    });
		
	marker.setMap(map);

	var infowindow = new google.maps.InfoWindow({
			content : "Here!"
	});

	infowindow.open(map, marker);
    var geocoder = new google.maps.Geocoder();
  
  
    document.getElementById('submit').addEventListener('click', function() {
        geocodeAddress(geocoder, map);
    });
}

function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('address').value;
    geocoder.geocode({'address': address}, function(results, status) {
    
    if (status === google.maps.GeocoderStatus.OK) 
    {
        resultsMap.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: resultsMap,
            position: results[0].geometry.location
        });
    } 
    else 
    {
      alert('Geocode was not successful for the following reason: ' + status);
    }
    });
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJHpvTDXyRQ_vf2DLT1tlFytkLSB2WbPQ&signed_in=true&callback=initMap"
async defer></script>
<!-- Map Ends -->

</body>
</html>