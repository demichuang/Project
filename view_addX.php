<?php
header('Content-type: text/html; charset=utf-8');
include_once("mysql.php");
$Table2="list";
$Table3="gone";

$url = "view.php";

$result1=mysqli_query($conn,"SELECT * FROM dst WHERE dnum='{$_GET['add']}'"); 
$result2=mysqli_query($conn,"SELECT * FROM dst WHERE dnum='{$_GET['gone']}'"); 

$row1 = mysqli_fetch_array($result1);
$row2 = mysqli_fetch_array($result2);

if(($_GET['add'])!="")          // Add button click 
{
    $result=mysqli_query($conn,"SELECT * FROM $Table2 WHERE dnum='{$_GET['add']}'");
    $row = mysqli_fetch_array($result);
    
    if($row['dname']!=$row1['dname'])
    {
        $sql = "INSERT $Table2 (username,dnum,dname) 
                    VALUES('{$_COOKIE['userName']}',{$_GET['add']},'{$row1['dname']}')";
        mysqli_query($conn,$sql);
        $numadd=mysqli_affected_rows($conn);
    }
}

if(($_GET['gone'])!="")         // Gone button click 
{
    $result=mysqli_query($conn,"SELECT * FROM $Table3 WHERE dnum='{$_GET['gone']}'");
    $row = mysqli_fetch_array($result);
    
    if($row['dname']!=$row2['dname'])
    {
        if($_GET['gone']<=3)
        {
        $sql = "INSERT $Table3 (username,d,dnum,dname) 
                    VALUES('{$_COOKIE['userName']}',1,{$_GET['gone']},'{$row2['dname']}')";
        }
        else
        {
         $sql = "INSERT $Table3 (username,d,dnum,dname) 
                    VALUES('{$_COOKIE['userName']}',2,{$_GET['gone']},'{$row2['dname']}')";   
        }
        mysqli_query($conn,$sql);
        $numadd=mysqli_affected_rows($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="refresh" content="3;url=<?php echo $url; ?> ">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Life is Travel</title>
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
        
         <a class="navbar-brand active"><h2><?php echo $_COOKIE["userName"]?></h2></a>
          
            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
                
                 <li ><a href="index.php">Home</a></li>
                 <li class="active"><a href="view.php">View</a></li>
                 <li ><a href="travel.php">My Travel</a></li>
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

<h1>head</h1>
<div id="contact" class="mail">

  <div class="container contactform center">
    
    <?php if($numadd):{?> 
      <h2 class="text-center  wowload fadeInUp">Add Succeed.</h2>
    <?php }else:{?> 
      <h2 class="text-center  wowload fadeInUp">Add Failed or already added.</h2>
    <?php } ?>
    <?php endif; ?>
    
    <h4 class="text-center  wowload fadeInUp">Go back after 3 seconds.</h4>
  </div>
</div>

</body>
</html>