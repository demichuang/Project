<?php
header('Content-type: text/html; charset=utf-8');
include_once("mysql.php");
$Table="gone";

session_start();
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
        
        <a class="navbar-brand active"><h2><?php echo $_SESSION['userName'];?></h2></a>
            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
                
                 <li ><a href="index.php">Home</a></li>
                 <li ><a href="view.php">View</a></li>
                 <li ><a href="travel.php">My Travel</a></li>
                 <li class="active"><a href="achievement.php">My Ahievement</a></li>
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

<h1>1</h1>
<?php

$result=mysqli_query($conn,"SELECT * FROM $Table 
                            WHERE username ='{$_SESSION['userName']}'
                            AND d=1"); 
$result2=mysqli_query($conn,"SELECT * FROM $Table 
                            WHERE username ='{$_SESSION['userName']}'
                            AND d=2");                            
$gone = mysqli_num_rows($result);
$gone2 = mysqli_num_rows($result2);
$gonenumber = round(($gone/3)*100,2);
$gonenumber2 = round(($gone2/3)*100,2);

// Taichung Number  
echo "<div class='overlay spacer'>
        <div class='container'>
          <div class='row text-center'>";
          
if($gone>0){               
    while($row =mysqli_fetch_array($result))
    {
        echo "<h4>{$row['dname']}
            <a href='travel_done.php?gone={$row['dname']}'>no gone</a>
            </h4>";       
    }
    echo"</div>
        </div>
       </div>";
}

echo "<div class='highlight-info'>
        <div class='container'>
          <div class='row text-center  wowload fadeInDownBig'> 
            <h4>Taichung：complete $gonenumber %</h4>
          </div>
        </div>
     </div>";

 // Tainan Number
echo "<div class='overlay spacer'>
        <div class='container'>
          <div class='row text-center'>";
if($gone2>0){               
    while($row =mysqli_fetch_array($result2))
    {
        echo "<h4>{$row['dname']}
            <a href='travel_done.php?gone={$row['dname']}'>no gone</a>
            </h4>";       
    }
    echo"</div>
        </div>
       </div>";
}

echo "<div class='highlight-info'>
        <div class='container'>
          <div class='row text-center  wowload fadeInDownBig'>
            <h4>Tainan：complete $gonenumber2 %</h4>
          </div>
        </div>
     </div>";
?>


</body>
</html>