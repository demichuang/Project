<?php 
header('Content-type: text/html; charset=utf-8');
include_once("mysql.php");
$Table="user";

session_start();
if (isset($_SESSION["userName"]))
  $sUserName = $_SESSION["userName"];
else 
  $sUserName = "Guest";

if (isset($_POST["signin"]))    // Signin button click
{
	$result=mysqli_query($conn,"SELECT * FROM $Table 
	                      WHERE username ='{$_POST['newtxtUserName']}'");
	$row = mysqli_fetch_array($result);

	if (mysqli_num_rows($result)>0)
	{
	  if($row['userpassword']==$_POST['newtxtPassword'])  // Already a member
	  {
  		header("Location: index.php?id=3");
  		exit();
	  }
	  else    // Change username
	  {
	    header("Location: index_sign.php?id=4");
		  exit();
	  }
	}
	else    // Succeed
	  {
	    $sql="INSERT $Table(username,userpassword)
	                      VALUES('{$_POST['newtxtUserName']}','{$_POST['newtxtPassword']}')";
      mysqli_query($conn,$sql);
      header("Location: index.php?id=5");
      exit();
	  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        
         <a class="navbar-brand active" href="index_sign.php"><h2>Sign In</h2></a>
        
            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
                
                 <li class="active"><a href="index.php">Home</a></li>
                 <li ><a href="index.php?id=1">View</a></li>
                 <li ><a href="index.php?id=1">My Travel</a></li>
                 <li ><a href="index.php?id=1">My Ahievement</a></li>
                 <li ><a href="index.php?id=1">Forum</a></li>
                 
              </ul>
            </div>
            <!-- #Nav Ends -->

      </div>
     </div>
   </div>
</div>
<!-- Header Ends -->

<h1>1</h1>

<!-- Signin Starts-->
<div id="contact" class="mail">

  <div class="container contactform center">
  
    <h2 class="text-center  wowload fadeInUp">Please Sign In</h2>
    <div class="row wowload fadeInLeftBig">      
      <div class="col-sm-6 col-sm-offset-3 col-xs-12"> 
        <form method="post" action="index_sign.php" >
          <input type="text" placeholder="Username" name="newtxtUserName" required>
          <input type="text"  placeholder="Password" name="newtxtPassword"  required>
          <button class="btn btn-primary" name="reset" type="reset">Clear</button>&nbsp;
          &nbsp;<button class="btn btn-primary" name="signin" type="submit">Sign In</button> 
        </form>
      </div>
    </div>
    &nbsp;&nbsp;
    
    <?php if ($_GET["id"]==4):?> <!-- Change username -->
      <h4 class="text-center  wowload fadeInUp">This name has already been used.</h4>
      <h4 class="text-center  wowload fadeInUp">Please change another.</h4>
    <?php endif; ?>
    
  
  </div>
</div>
<!-- Signin Ends-->

</body>
</html>