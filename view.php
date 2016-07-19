<?php
header('Content-type: text/html; charset=utf-8');
include_once("mysql.php");
$Table="file";
$Table2="dst";
$Table3="file2";

session_start();
$_SESSION["letter"]=$_POST["letter"];

if(isset($_GET['id']))          // See Button click
   $_SESSION["id"]=$_GET['id'];
else
    $_SESSION["id"]=0;
    
if(isset($_POST['tainan']))     // dst Button click
   $_SESSION["dst"]=1;
 
else
    $_SESSION["dst"]=0;




if(($_GET['additem'])!="")      // Add button click 
{   if($_SESSION['dst']=="0"){
      $result=mysqli_query($conn,"SELECT * FROM $Table WHERE dnum='{$_GET['additem']}' AND username='{$_SESSION['userName']}'");
      $row = mysqli_fetch_array($result);
     
      if($row['additem']=="0"){
          
          $sql = "UPDATE $Table SET additem=1
                      WHERE dnum='{$_GET['additem']}' AND username='{$_SESSION['userName']}'";
          mysqli_query($conn,$sql);
      }
    }
    else{
      $result=mysqli_query($conn,"SELECT * FROM $Table3 WHERE dnum='{$_GET['additem']}' AND username='{$_SESSION['userName']}'");
      $row = mysqli_fetch_array($result);
     
      if($row['additem']=="0"){
          
          $sql = "UPDATE $Table3 SET additem=1
                      WHERE dnum='{$_GET['additem']}' AND username='{$_SESSION['userName']}'";
          mysqli_query($conn,$sql);
      }
    }
}

if(($_GET['gone'])!="")         // Gone button click 
{
    if($_SESSION['dst']=="0"){
      $result=mysqli_query($conn,"SELECT * FROM $Table WHERE dnum='{$_GET['gone']}' AND username='{$_SESSION['userName']}'");
      $row = mysqli_fetch_array($result);
      
      if($row['gone']=="0")
      {
          $sql = "UPDATE $Table SET gone=1
                      WHERE dnum='{$_GET['gone']}' AND username='{$_SESSION['userName']}'";
          mysqli_query($conn,$sql);
      }
    }
    else{
      $result=mysqli_query($conn,"SELECT * FROM $Table3 WHERE dnum='{$_GET['gone']}' AND username='{$_SESSION['userName']}'");
      $row = mysqli_fetch_array($result);
      
      if($row['gone']=="0")
      {
          $sql = "UPDATE $Table3 SET gone=1
                      WHERE dnum='{$_GET['gone']}' AND username='{$_SESSION['userName']}'";
          mysqli_query($conn,$sql);
      }
    }
}

$result1=mysqli_query($conn,"SELECT * FROM $Table WHERE username='{$_SESSION['userName']}'");
$result2=mysqli_query($conn,"SELECT * FROM $Table3 WHERE username='{$_SESSION['userName']}'");

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
<div class="topbar animated fadeInLeftBig"></div>

<!-- Header Starts -->
<div class="navbar-wrapper">
  <div class="container">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="top-nav">
      <div class="container">
        
        <a class="navbar-brand active"><h2><?php echo $_SESSION["userName"]?></h2></a>
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

<h1>1</h1>

<!--List-->
<form method="post" action="view.php">
  <button  name="taichung" type="submit">Taichung</button> 
  <button  name="tainan" type="submit">Tainan</button> 
</form>

<!-- Information  Starts-->
<?php
if($_SESSION['dst']=="0")
  $result=mysqli_query($conn,"SELECT * FROM $Table2 WHERE dnum ='{$_GET['id']}' AND d=1"); 
else
  $result=mysqli_query($conn,"SELECT * FROM $Table2 WHERE dnum ='{$_GET['id']}'AND d=2"); 
echo "<div class='highlight-info'>
        <div class='container'>
            <div class='row text-center  wowload fadeInDownBig'> ";
    
    while($row =mysqli_fetch_array($result))
    {
        echo "<h3>{$row['dname']}</h3>";
        echo "<h4>{$row['dinfo']}</h4>";
        echo "<h3></h3>";       
    }
    echo    "</div>
          </div>
        </div>";
?>
<!-- Information  Ends-->

<!-- Picture Starts -->
<div id="works"  class=" clearfix grid" > 
<form method ="post" action="view.php">

<?php 
if($_SESSION['dst']=="0"){
  while($row1 = mysqli_fetch_array($result1)){
    echo "<figure class='effect-oscar  wowload fadeInUp' >
            <img name ='face'src='images/portfolio/0{$row1['dnum']}.jpg' width='500' height='300'alt='img01'/>
            <figcaption>
              <h2>{$row1['dname']}</h2>
              <p><br>";
                
              if($row1['additem']==0)             // add button
                echo "<a href='view.php?additem={$row1['dnum']}'>add</a>";
              else
                echo "<a>已加</a>" ;
              
              if($row1['gone']==0)                // gone button
                echo "<a href='view.php?gone={$row1['dnum']}'>gone</a></p>";
              else
                echo "<a>已選</a></p>" ;
                  
              if($_SESSION["id"]==0)              // see more button
                echo"<p><a href='view.php?id={$row1['dnum']}'>see more</a>";
              else
                if($row1['dnum']==$_SESSION['id'])
                  echo"<p><a href='view.php?id=0'>close</a>";
                else
                  echo"<p><a href='view.php?id={$row1['dnum']}'>see more</a>";
                  
    echo      "</p>
            </figcaption>
          </figure>";
  }
}
else
{
  while($row2 = mysqli_fetch_array($result2)){
    echo "<figure class='effect-oscar  wowload fadeInUp' >
            <img name ='face'src='images/portfolio/1{$row2['dnum']}.jpg' width='500' height='300'alt='img01'/>
            <figcaption>
              <h2>{$row2['dname']}</h2>
              <p><br>";
                
              if($row2['additem']==0)             // add button
                echo "<a href='view.php?additem={$row2['dnum']}'>add</a>";
              else
                echo "<a>已加</a>" ;
              
              if($row2['gone']==0)                // gone button
                echo "<a href='view.php?gone={$row2['dnum']}'>gone</a></p>";
              else
                echo "<a>已選</a></p>" ;
                  
              if($_SESSION["id"]==0)              // see more button
                echo"<p><a href='view.php?id={$row2['dnum']}'>see more</a>";
              else
                if($row2['dnum']==$_SESSION['id'])
                  echo"<p><a href='view.php?id=0'>close</a>";
                else
                  echo"<p><a href='view.php?id={$row2['dnum']}'>see more</a>";
                  
    echo      "</p>
            </figcaption>
          </figure>";
}
}
?>

</form>
</div>
<!-- Picture Ends -->

</body>
</html>