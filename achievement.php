<?php
header('Content-type: text/html; charset=utf-8');   //使用萬用字元碼utf-8
include_once("mysql.php");                          // 連結資料庫new
$Table_dst="dst";       // 取dat資料表(影響：no按鈕)
$Table_file="file";     // 取file資料表(影響：no按鈕)
$Table_file2="file2";    // 取file2資料表(影響：no按鈕)

session_start();    // 啟動session(使用：$_SESSION['userName'])
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
                 <li ><a href="travel.php">My Travel</a></li>
                 <li class="active"><a href="achievement.php">My Ahievement</a></li>
                 <li ><a href="contact.php">Forum</a></li>
                 <li ><a href="index.php?logout=1">Logout</a></li>
               
              </ul>
            </div>
            
      </div>
     </div>
   </div>
</div>
<h1>1</h1>
<!-- Header Ends -->


<?php

$row1=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM $Table_dst WHERE d=1"));    // 從dst資料夾取Taichung的景點數
$row2=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM $Table_dst WHERE d=2"));    // 從dst資料夾取Tainan的景點數

// 從file資料夾取去過的Taichung景點數
$result1=mysqli_query($conn,"SELECT * FROM $Table_file
                            WHERE username ='{$_SESSION['userName']}'
                            AND gone=1"); 
$gone = mysqli_num_rows($result1);

// 從file2資料夾取去過的Tainan景點數
$result2=mysqli_query($conn,"SELECT * FROM $Table_file2
                            WHERE username ='{$_SESSION['userName']}'
                            AND gone=1");                       
$gone2 = mysqli_num_rows($result2);

$gonenumber = round(($gone/$row1)*100,2);       // 計算去過Taichung景點數的%
$gonenumber2 = round(($gone2/$row2)*100,2);     // 計算去過Tainan景點數的%


echo "<div class='overlay spacer'>
        <div class='container'>
          <div class='row text-center'>";

// 取Taichung去過的景點          
if($gone>0){
    // 取每筆資料
    while($row =mysqli_fetch_array($result1))
    {
        echo "<h4>{$row['dname']}";                                     // 印出景點名
        echo "<a href='travel_done.php?gone={$row['dname']}'>no</a>";   // 刪除景點
        echo "</h4>";       
    }
    echo"</div>
        </div>
       </div>";
}

// 印出Taichung的%
echo "<div class='highlight-info'>
        <div class='container'>
          <div class='row text-center  wowload fadeInDownBig'> 
            <h4>Taichung：complete $gonenumber %</h4>
          </div>
        </div>
     </div>";



 
echo "<div class='overlay spacer'>
        <div class='container'>
          <div class='row text-center'>";
// 取Tainan去過的景點 
if($gone2>0){ 
    // 取每筆資料
    while($row =mysqli_fetch_array($result2))
    {
        echo "<h4>{$row['dname']}";                                     // 印出景點名
        echo "<a href='travel_done.php?gone={$row['dname']}'>no</a>";   // 刪除景點
        echo "</h4>";       
    }
    echo"</div>
        </div>
       </div>";
}

// 印出Tainan的%
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