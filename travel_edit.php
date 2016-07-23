<?php
header('Content-type: text/html; charset=utf-8');   //使用萬用字元碼utf-8
include_once("mysql.php");                          // 連結資料庫new
$Table="user";  // user資料表(影響：edit按鈕)

session_start();    // 啟動session(使用：$_SESSION['userName'])

//  點選Taichung Edit 按鈕
if(($_GET['edit'])!="")     
{
  // 從user資料表內取Taichung的規劃資料
  $result=mysqli_query($conn,"SELECT * FROM $Table 
                              WHERE username='{$_GET['edit']}'"); 
  $row = mysqli_fetch_array($result);                 // 取每筆資料 
  $edit = ereg_replace("<br />", "", $row['edit']);   // 消除資料內的換行符號
  $plan = 0;                                          // 設$plan為0
}

//  點選Tainan Edit 按鈕
if(($_GET['edit2'])!="")     
{
  // 從user資料表內取Tainan的規劃資料
  $result=mysqli_query($conn,"SELECT * FROM $Table 
                              WHERE username='{$_GET['edit2']}'"); 
  $row = mysqli_fetch_array($result);                 // 取每筆資料
  $edit = ereg_replace("<br />", "", $row['edit2']);  // 消除資料內的換行符號
  $plan = 1;                                          // 設$plan為1
}
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
        
        <!-- 顯示使用者名稱 -->
        <a class="navbar-brand active"><h2><?php echo $_SESSION['userName'];?></h2></a>
            
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
            
      </div>
     </div>
   </div>
</div>
<!-- Header Ends -->

<h1>1</h1>

<!-- Edit Starts-->
<div id="contact" class="mail">

  <div class="container contactform center">
    
    <!-- 顯示"Enter your words" -->
    <h2 class="text-center  wowload fadeInUp">Enter your words</h2>
    <div class="row wowload fadeInLeftBig">      
      <div class="col-sm-6 col-sm-offset-3 col-xs-12">
        <!-- 顯示編輯畫面 --> 
        <form method="post" action="travel_done.php?plan=<?php echo $plan?>" >
          <textarea rows="5" name="word"><?php echo $edit;?></textarea>
          <button class="btn btn-primary" name="reset" type="reset">Reset</button>&nbsp;
          &nbsp;<button class="btn btn-primary" name="signin" type="submit">Send</button> 
        </form>
      </div>
    </div>
 
   </div>
</div>
<!-- Edit Ends-->

</body>
</html>