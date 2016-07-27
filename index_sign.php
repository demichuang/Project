<?php 
header('Content-type: text/html; charset=utf-8');   //使用萬用字元碼utf-8
include_once("mysql.php");                          // 連結資料庫new
$Table_user="user";      // 取user資料表(影響：signup按鈕)
$Table_dst="dst";        // 取dst資料表(影響：signup按鈕<-如果成功註冊才使用)
$Table_file="file";      // 取file資料表(影響：signup按鈕<-如果成功註冊才使用)
$Table_file2="file2";    // 取file2資料表(影響：signup按鈕<-如果成功註冊才使用)

// 點選"signup按鈕"
if (isset($_POST["signup"]))    
{
  // 檢查user資料表內是否有與輸入的username相符的資料
	$result=mysqli_query($conn,"SELECT * FROM $Table_user 
	                            WHERE username ='{$_POST['newtxtUserName']}'");
	$row = mysqli_fetch_array($result);
  
  // 如果有與輸入的username相符的資料
	if (mysqli_num_rows($result)>0)                         
	{
	  // 如果輸入的userpassword也相符
	  if($row['userpassword']==$_POST['newtxtPassword'])    
	  {
  		header("Location: index.php?id=3");   // 跳轉回頁面index.php，傳id=3值，顯示你本來就是會員
  		exit();                               // 離開php程式
	  }
	  // 如果輸入的userpassword不相符
	  else    
	  {
	    header("Location: index_sign.php?id=4");    // 跳轉回原頁面(index_sign.php)，傳id=4值，顯示帳號名已被使用
  		exit();                                     // 離開php程式
	  }
	}
	// 如果沒有與輸入的username相符的資料
	else    
	{
	  // 新增輸入的username和userpassword至user資料表
    mysqli_query($conn,"INSERT $Table_user(username,userpassword)
                        VALUES('{$_POST['newtxtUserName']}','{$_POST['newtxtPassword']}')");
  
    // 從dst資料表取Taichung景點名稱
    $result=mysqli_query($conn,"SELECT * FROM $Table_dst 
	                              WHERE d=1");
	  // 幫新使用者新增Taichung景點名稱列表  
	  while($row = mysqli_fetch_array($result))
	  {
	    mysqli_query($conn,"INSERT $Table_file(username,dnum,dname,additem,gone)
	                        VALUES('{$_POST['newtxtUserName']}','{$row['dnum']}','{$row['dname']}',0,0)");
    }
    // 從dst資料表取Tainan景點名稱
	  $result=mysqli_query($conn,"SELECT * FROM $Table_dst 
	                                WHERE d=2");
	  // 幫新使用者新增Tainan景點名稱列表 
    while($row = mysqli_fetch_array($result))
	  {
	    mysqli_query($conn,"INSERT $Table_file2(username,dnum,dname,additem,gone)
	                        VALUES('{$_POST['newtxtUserName']}','{$row['dnum']}','{$row['dname']}',0,0)");
	  }

    header("Location: index.php?id=5");   // 跳轉回頁面index.php，傳id=5值，顯示現在是會員了
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
        
         <!-- 尚未登入，顯示註冊連結 -->
         <a class="navbar-brand active" href="index_sign.php"><h2>Sign Up</h2></a>

            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
                
                 <!-- 尚未登入前點選其他頁面的連結，傳id=1值給頁面index.php，顯示要先登入 -->
                 <li class="active"><a href="index.php">Home</a></li>
                 <li ><a href="index.php?id=1">View</a></li>
                 <li ><a href="index.php?id=1">My Travel</a></li>
                 <li ><a href="index.php?id=1">My Achievement</a></li>
                 <li ><a href="index.php?id=1">Forum</a></li>
                 
              </ul>
            </div>

      </div>
     </div>
   </div>
</div>
<h1>1</h1>
<!-- Header Ends -->


<!-- Signup Starts-->
<div id="contact" class="mail">
  <div class="container contactform center">
    
    <!-- 顯示"Please Sign Up" -->
    <h2 class="text-center  wowload fadeInUp">Please Sign Up</h2>
    <div class="row wowload fadeInLeftBig">      
      <div class="col-sm-6 col-sm-offset-3 col-xs-12">
        <!-- 顯示註冊畫面 --> 
        <form method="post" action="index_sign.php" >
          <input type="text" placeholder="Username" name="newtxtUserName" required>
          <input type="text"  placeholder="Password" name="newtxtPassword"  required>
          <button class="btn btn-primary" name="reset" type="reset">Clear</button>&nbsp;
          &nbsp;<button class="btn btn-primary" name="signup" type="submit">Sign Up</button> 
        </form>
      </div>
    </div>
    &nbsp;&nbsp;
    
    <!-- 得id=4值，顯示帳號名已被使用 -->
    <?php if ($_GET["id"]==4):?> 
      <h4 class="text-center  wowload fadeInUp">This name has already been used.</h4>
      <h4 class="text-center  wowload fadeInUp">Please change another.</h4>
    <?php endif; ?>
    
  
  </div>
</div>
<!-- Signup Ends-->

</body>
</html>