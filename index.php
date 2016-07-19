<?php 
header('Content-type: text/html; charset=utf-8');
include_once("mysql.php");
$Table="user";

session_start();

if (isset($_SESSION["userName"]))
  $sUserName = $_SESSION["userName"];
else 
  $sUserName = "Guest";


if (isset($_GET["logout"]))     //  Logout button click   
{
	setcookie("userName", "Guest");
	header("Location: index.php");
	exit();
}


if (isset($_POST["login"]))     //  Login button click
{
	$sUserName = $_POST["txtUserName"];
	$result=mysqli_query($conn,"SELECT * FROM $Table 
	                      WHERE username ='{$_POST['txtUserName']}'
	                          AND userpassword='{$_POST['txtPassword']}'"); 

	if (trim($sUserName) !="" & mysqli_num_rows($result) == 1)    //  Login Succeed   
	{
		$_SESSION["userName"]=$sUserName;
		header("Location: index.php");
		exit();
	}
	else      //  Login Failed
	{
	  $_SESSION["userName"]="Guest";
  	header("Location: index.php?id=2");
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
        
        <?php if ($sUserName == "Guest"): ?>
         <a class="navbar-brand active" href="index_sign.php"><h2>Sign In</h2></a>
        <?php else: ?>
         <a class="navbar-brand active"><h2><?php echo $sUserName?></h2></a>
        <?php endif; ?>    
        
            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
                
                <?php if ($sUserName != "Guest"): ?>
                 <li class="active"><a href="index.php">Home</a></li>
                 <li ><a href="view.php">View</a></li>
                 <li ><a href="travel.php">My Travel</a></li>
                 <li ><a href="achievement.php">My Ahievement</a></li>
                 <li ><a href="contact.php">Forum</a></li>
                 <li ><a href="index.php?logout=1">Logout</a></li>
                <?php endif; ?> 
                
                <?php if ($sUserName == "Guest"): ?>
                 <li class="active"><a href="index.php">Home</a></li>
                 <li ><a href="index.php?id=1">View</a></li>
                 <li ><a href="index.php?id=1">My Travel</a></li>
                 <li ><a href="index.php?id=1">My Ahievement</a></li>
                 <li ><a href="index.php?id=1">Forum</a></li>
                <?php endif; ?>  
              </ul>
            </div>
            <!-- #Nav Ends -->

      </div>
     </div>
   </div>
</div>
<!-- Header Ends -->

<h1>1</h1>

<!-- Login Starts -->
<div id="contact" class="mail">

  <div class="container contactform center">
   
  <?php if ($sUserName != "Guest"): ?>
    <h2 class="text-center  wowload fadeInUp"><?php echo "Welcome! " . $sUserName ?></h2>
    <div class="row wowload fadeInLeftBig">      
      <div class="col-sm-6 col-sm-offset-3 col-xs-12"> 
        <form method="post" action="index.php" name="addmessage">
          <input class="btn btn-primary" name="logout" type="button" value="Logout"  onclick="location.href='index.php?logout=1'">
        </form>
      </div>
    </div>
  <?php endif; ?>    
    
    
  <?php if ($sUserName == "Guest"): ?>
    <h2 class="text-center  wowload fadeInUp">Please Login</h2>
    <div class="row wowload fadeInLeftBig">      
      <div class="col-sm-6 col-sm-offset-3 col-xs-12"> 
        <form method="post" action="index.php">
          <input type="text" placeholder="Username" name="txtUserName" required>
          <input type="password"  placeholder="Password" name="txtPassword"  required>
          <button class="btn btn-primary" name="reset" type="reset">Clear</button>&nbsp;
          &nbsp;<button class="btn btn-primary" name="login" type="submit">Login</button> 
        </form>
      </div>
    </div>
    &nbsp;&nbsp;
  <?php endif; ?>
  
  <?php if ($_GET["id"]==1):?> <!-- Not login -->
      <h4 class="text-center  wowload fadeInUp">You need to login first.</h4>
    <?php endif; ?>
    
    <?php if ($_GET["id"]==2):?> <!-- Login Failed -->
      <h4 class="text-center  wowload fadeInUp">You have wrong enter or you are not a member.</h4>
      <h4 class="text-center  wowload fadeInUp">Please enter again or sign in first.</h4>
    <?php endif; ?>
    
    <?php if ($_GET["id"]==3):?> <!-- Already a member -->
      <h4 class="text-center  wowload fadeInUp">You are already a member.</h4>
      <h4 class="text-center  wowload fadeInUp">Please login.</h>
    <?php endif; ?>
    
    <?php if ($_GET["id"]==5):?> <!-- Signin Succeed -->
      <h4 class="text-center  wowload fadeInUp">You are a member now.</h4>
      <h4 class="text-center  wowload fadeInUp">Go back and login.</h4>
    <?php endif; ?>
  
  </div>
</div>
<!-- Login Ends -->

</body>
</html>