<?php
include("mysql.php");
$Table="talk";

if (!empty($_POST['name']) && !empty($_POST['word'])){    // Input Button click
  date_default_timezone_set('Asia/Taipei');    
  $stmt = mysqli_prepare($conn,      
               "INSERT $Table (`name`, `word`, `time`)VALUES (?, ?, ?)");
  $now = date("Y-m-d H:i:s");

  mysqli_stmt_bind_param($stmt, 'sss',$_POST['name'], $_POST['word'], $now);
  mysqli_stmt_execute($stmt);
}

session_start();
$result=mysqli_query($conn,"SELECT * FROM $Table ORDER BY num DESC");
$numwords = mysqli_num_rows($result);

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
                 <li ><a href="achievement.php">My Ahievement</a></li>
                 <li class="active"><a href="contact.php">Forum</a></li>
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

<!--Forum Starts -->
<div class="container contactform center">
<h2 class="text-center  wowload fadeInUp">Say Something ...</h2>

<h4><?php echo "Total：$numwords messages "; ?></h4>
<h4 class="text-right  wowload fadeInUp"><a href="contact_send.php">I want say something...</a></h4>

<?php
if ($numwords>0) {
  echo '<form cols="35" rows="7" >';
  echo '<ul>';
  $i=1;
  while ($row = mysqli_fetch_array($result))
  {
    $name=htmlspecialchars($row['name'], ENT_QUOTES);
    $word=htmlspecialchars($row['word'], ENT_QUOTES);
    $word=str_replace('  ', '&nbsp;&nbsp;', nl2br($word));
   
    echo "
    <li text-align: center><p><h5><strong>$name</strong>
	      <em>({$row['time']})</em></h5></p>
		  <div class='text-center  wowload fadeInUp'><p><h5>$word</h5></p></div></li>";
    $i++;
  }
  echo '</ul>';
  echo '</form>';
}
?>

</div>
<!--Forum Ends -->

</body>
</html>