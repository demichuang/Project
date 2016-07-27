<?php
header('Content-type: text/html; charset=utf-8');   //使用萬用字元碼utf-8
include_once("mysql.php");                          // 連結資料庫new
$Table_talk="talk";    // 取talk資料表(影響：留言send按鈕)

// 點選"留言send"按鈕(如果名字和留言內容非空值)
if (!empty($_POST['name']) && !empty($_POST['word']))
{    
  $name = $_POST['name'];   
  $word = $_POST['word'];
  
  date_default_timezone_set('Asia/Taipei');   //時間設定:Taipei時間 
  $now = date("Y-m-d H:i:s");                 //時間設定(年、月、日 時、分、秒)
  
  $stmt = mysqli_prepare($conn,"INSERT $Table_talk (name,word,time)
                                VALUES (?, ?, ?)");             //準備查詢
  mysqli_stmt_bind_param($stmt, 'sss', $name, $word, $now);     // 指定資料類型為字串，連結參數
  mysqli_stmt_execute($stmt);                                   // 寫入talk資料表
}

$result=mysqli_query($conn,"SELECT * FROM $Table_talk ORDER BY num DESC");   //從talk資料表最新資料開始取
$numwords = mysqli_num_rows($result);   //總留言數
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
                 <li ><a href="achievement.php">My Ahievement</a></li>
                 <li class="active"><a href="contact.php">Forum</a></li>
                 <li ><a href="index.php?logout=1">Logout</a></li>
               
              </ul>
            </div>
            
      </div>
     </div>
   </div>
</div>
<h1>1</h1>
<!-- Header Ends -->


<!--Forum Starts -->
<div class="container contactform center">
<!-- 顯示"Say Something" -->
<h2 class="text-center  wowload fadeInUp">Say Something ...</h2>
<!-- 顯示總留言數 -->
<h4><?php echo "Total：$numwords messages "; ?></h4>
<!-- 顯示我想留言 -->
<h4 class="text-right  wowload fadeInUp"><a href="contact_send.php">I want say something...</a></h4>

<?php
echo '<form cols="35" rows="7" >
      <ul>';

//印出每筆留言
while ($row = mysqli_fetch_array($result))
  {
    echo "<li text-align: center>
          <p><h5><strong>{$row['name']}</strong>";      // 印出名字
	  echo " <em>({$row['time']})</em></h5></p>";         // 印出時間
		echo "<div class='text-center  wowload fadeInUp'>
		        <p><h5>{$row['word']}</h5></p>
		        </div>
		      </li>";         // 印出留言
  }
  echo '</ul>';
  echo '</form>';
?>
</div>
<!--Forum Ends -->

</body>
</html>