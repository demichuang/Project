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
<div class="topbar animated fadeInLeftBig"></div>

<!-- Header Starts -->
<div class="navbar-wrapper">
  <div class="container">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="top-nav">
      <div class="container">
        
        <a class="navbar-brand active"><h2><?php echo $_SESSION["userName"];?></h2></a>
            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
                
                 <li ><a href="index.php">Home</a></li>
                 <li ><a href="view.php">View</a></li>
                 <li class="active"><a href="travel.php">My Travel</a></li>
                 <li ><a href="achievement.php">My Ahievement</a></li>
                 <li ><a href="contact.php">Forum</a></li>
                 <li ><a href="index.php?logout=1">Logout</a></li>
               
              </ul>
            </div>
            <!-- #Nav Ends -->
      </div>
     </div>
   </div>
</div>
<!-- Header Ends -->




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
<?php        
echo "    <h3>Your list：</h3>
            <div class='row text-center'>";
if(mysqli_num_rows($result)>0){    
    while($row =mysqli_fetch_array($result))
    {
        echo "<h4>{$row['dname']}
            <a href='travel_done.php?del={$row['dnum']}'>delete</a>
            </h4>";       
    }
    echo"</div>
        </div>
       </div>";
}
?>
<!-- List Ends -->

<div class="clearfix">


<!-- Plan Starts -->
  <div class="col-sm-6">
    <div id="carousel-testimonials" class="carousel slide testimonails  wowload fadeInLeft" data-ride="carousel">
      <div class="item  animated bounceInLeft row">
        <div  class="col-xs-10">
            
        <?php
        $result2=mysqli_query($conn,"SELECT * FROM $Table2 WHERE username='{$_SESSION['userName']}'");
                
        if(mysqli_num_rows($result2)>0){
            while($row2 =mysqli_fetch_array($result2)){
                echo "<h4>{$row2['edit']}</h4>";
                echo "<h5><a href='travel_edit.php?edit={$_SESSION['userName']}'>edit</a><h5>";
            }
        }
        ?>
      
         </div>
      </div>
    </div>
  </div>
<!-- Plan Ends -->

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
            zoom: 15,
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