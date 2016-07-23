<?php 
header('Content-type: text/html; charset=utf-8');   //使用萬用字元碼utf-8
include_once("mysql.php");                          // 連結資料庫new
$Table="user";    // 取user資料表(影響：login按鈕)

session_start();    // 啟動session(使用：$_SESSION['userName'])


// 如果$_SESSION['userName']存在
if (isset($_SESSION["userName"]))       
  $sUserName = $_SESSION["userName"];   // $sUserName設為$_SESSION['userName'](使用者名稱)
// 如果$_SESSION['userName']不存在
else                                    
  $sUserName = "Guest";                 // $sUserName設為"Guest"(訪客)


// 點選"logout按鈕" 
if (isset($_POST["logout"]))         
{
	$_SESSION["userName"]= "Guest";   // $_SESSION["userName"]設為"Guest"
	header("Location: index.php");    // 跳轉回到原頁面(index.php)
	exit();                           // 離開php程式
}


// 點選"login按鈕"
if (isset($_POST["login"]))     
{
	// 檢查user資料表內是否有與輸入的username和userpassword相符的資料
	$result=mysqli_query($conn,"SELECT * FROM $Table                     
	                            WHERE username ='{$_POST['txtUserName']}'
	                            AND userpassword='{$_POST['txtPassword']}'");  

  // 登入成功(如果輸入的username非空值，且user資料表內有一筆相符的資料)
	if (trim($_POST["txtUserName"]) !="" & mysqli_num_rows($result) == 1)       
	{
		$_SESSION["userName"]=$_POST["txtUserName"];    // $_SESSION['userName']設為輸入的username
		header("Location: index.php");                  // 跳轉回到原頁面(index.php)
		exit();                                         // 離開php程式
	}
	// 登入失敗
	else                                    
	{
	  $_SESSION["userName"]="Guest";        // $_SESSION["userName"]設為"Guest"
  	header("Location: index.php?id=2");   // 跳轉回到原頁面(index.php)，傳id=2值，顯示輸入錯誤或不是會員
  	exit();                               // 離開php程式
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
        
        <!-- 尚未登入時，顯示註冊連結 -->
        <?php if ($sUserName == "Guest"): ?>
         <a class="navbar-brand active" href="index_sign.php"><h2>Sign Up</h2></a>
        <!-- 已登入時，顯示使用者名稱 -->
        <?php else: ?>
         <a class="navbar-brand active"><h2><?php echo $sUserName?></h2></a>
        <?php endif; ?>    
        
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
                
                <!-- 已會員登入， 網站可以連結 -->
                <?php if ($sUserName != "Guest"): ?>
                 <li class="active"><a href="index.php">Home</a></li>
                 <li ><a href="view.php">View</a></li>
                 <li ><a href="travel.php">My Travel</a></li>
                 <li ><a href="achievement.php">My Achievement</a></li>
                 <li ><a href="contact.php">Forum</a></li>
                 <li ><a href="index.php?logout=1">Logout</a></li>
                <?php endif; ?> 
                
                <!-- 尚未登入前點選其他頁面的連結，傳id=1值給原頁面(index.php)，顯示要先登入 -->
                <?php if ($sUserName == "Guest"): ?>
                 <li class="active"><a href="index.php">Home</a></li>
                 <li ><a href="index.php?id=1">View</a></li>
                 <li ><a href="index.php?id=1">My Travel</a></li>
                 <li ><a href="index.php?id=1">My Achievement</a></li>
                 <li ><a href="index.php?id=1">Forum</a></li>
                <?php endif; ?>  
              </ul>
            </div>

      </div>
     </div>
   </div>
</div>
<h1>1</h1>
<!-- Header Ends -->


<!-- Login Starts -->
<div id="contact" class="mail">

  <div class="container contactform center">
   
  <!-- 已會員登入 -->
  <?php if ($sUserName != "Guest"): ?>
    <!-- 顯示"Welcome, 使用者名稱" -->
    <h2 class="text-center  wowload fadeInUp"><?php echo "Welcome! " . $sUserName ?></h2>
    <div class="row wowload fadeInLeftBig">      
      <div class="col-sm-6 col-sm-offset-3 col-xs-12"> 
        <!-- 顯示登出畫面， -->
        <form method="post" action="index.php">
          <button class="btn btn-primary" name="logout" type="submit">Logout</button>
        </form>
      </div>
    </div>
  <?php endif; ?>    
    
  <!-- 尚未登入 -->    
  <?php if ($sUserName == "Guest"): ?>
    <!-- 顯示"Please Login" -->
    <h2 class="text-center  wowload fadeInUp">Please Login</h2>
    <div class="row wowload fadeInLeftBig">      
      <div class="col-sm-6 col-sm-offset-3 col-xs-12"> 
        <!-- 顯示登入畫面 -->
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
  
    <!-- 得id=1值，顯示要先登入 -->
    <?php if ($_GET["id"]==1):?> 
      <h4 class="text-center  wowload fadeInUp">You need to login first.</h4>
    <?php endif; ?>
    
    <!-- 得id=2值，顯示輸入錯誤，或還不是會員 -->
    <?php if ($_GET["id"]==2):?> 
      <h4 class="text-center  wowload fadeInUp">You have wrong enter or you are not a member.</h4>
      <h4 class="text-center  wowload fadeInUp">Please enter again or sign up first.</h4>
    <?php endif; ?>
    
    <!-- 得id=3值，顯示本來就是會員了，登入即可 -->
    <?php if ($_GET["id"]==3):?> 
      <h4 class="text-center  wowload fadeInUp">You are already a member.</h4>
      <h4 class="text-center  wowload fadeInUp">Please login.</h>
    <?php endif; ?>
    
    <!-- 得id=5值，顯示現在是會員了，請登入 -->
    <?php if ($_GET["id"]==5):?> 
      <h4 class="text-center  wowload fadeInUp">You are a member now.</h4>
      <h4 class="text-center  wowload fadeInUp">Please login.</h4>
    <?php endif; ?>
  
  </div>
</div>
<!-- Login Ends -->

</body>
</html>