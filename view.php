<?php
header('Content-type: text/html; charset=utf-8');   //使用萬用字元碼utf-8
include_once("mysql.php");                          // 連結資料庫new
$Table="file";    // 取file資料表(影響：add按鈕，gone按鈕)
$Table2="dst";    // 取dst資料表(影響：see more按鈕)
$Table3="file2";  // 取file2資料表(影響：add按鈕，gone按鈕)

session_start();    // 啟動session(使用：$_SESSION['userName']，$_SESSION["see"]，$_SESSION["dst"])


// 點選"see more按鈕" 
if(isset($_GET['see']))               
  $_SESSION["see"]=$_GET['see'];  // 設$_SESSION["see"]為$_GET['see']
// 已點選過"see more按鈕" 
else
  $_SESSION["see"]=0;            // 設$_SESSION["see"]為0
 

// 點選"Taichung按鈕"     
if(isset($_POST['taichung']))  
   $_SESSION["dst"]=0;       // 設$_SESSION["dst"]為0
   

// 點選"Tainan按鈕"  
if(isset($_POST['tainan']))     
   $_SESSION["dst"]=1;       // 設$_SESSION["dst"]為1


// 點選"add按鈕"
if(($_GET['additem'])!="")    
{  
  // 如果點選"Taichung按鈕"
  if($_SESSION['dst']=="0")
  {
    // 從file資料表內取和景點編號($_GET['additem'])及username對應的資料
    $result=mysqli_query($conn,"SELECT * FROM $Table 
                                WHERE dnum='{$_GET['additem']}' 
                                AND username='{$_SESSION['userName']}'");
    $row = mysqli_fetch_array($result);
     
    // 如果景點未被使用者加入
    if($row['additem']=="0")
    {
        // 將file的additem欄位更改為1(加入景點)
        $sql = "UPDATE $Table SET additem=1
                WHERE dnum='{$_GET['additem']}' 
                AND username='{$_SESSION['userName']}'";
        mysqli_query($conn,$sql);
    }
  }
  // 如果點選"Tainan按鈕"
  else
  {
    // 從file2資料表內和景點編號($_GET['additem'])及username對應的資料
    $result=mysqli_query($conn,"SELECT * FROM $Table3 
                                WHERE dnum='{$_GET['additem']}' 
                                AND username='{$_SESSION['userName']}'");
    $row = mysqli_fetch_array($result);
     
    // 如果景點未被使用者加入
    if($row['additem']=="0"){
          
        // 將file2的additem欄位更改為1(加入景點)
        $sql = "UPDATE $Table3 SET additem=1
                WHERE dnum='{$_GET['additem']}' 
                AND username='{$_SESSION['userName']}'";
        mysqli_query($conn,$sql);
    }
  }
}


// 點選"gone按鈕"
if(($_GET['gone'])!="")        
{
  // 如果點選"Taichung按鈕"
  if($_SESSION['dst']=="0")
  {
    // 從file資料表內取和景點編號($_GET['gone'])及username對應的資料
    $result=mysqli_query($conn,"SELECT * FROM $Table 
                                WHERE dnum='{$_GET['gone']}' 
                                AND username='{$_SESSION['userName']}'");
    $row = mysqli_fetch_array($result);
    
    // 如果景點未被使用者標示去過  
    if($row['gone']=="0")
    {
      // 將file的gone欄位更改為1(標示景點已去)
      $sql = "UPDATE $Table SET gone=1
              WHERE dnum='{$_GET['gone']}' 
              AND username='{$_SESSION['userName']}'";
      mysqli_query($conn,$sql);
    }
  }
  // 如果點選"Tainan按鈕"
  else
  {
    // 從file2資料表內取和景點編號($_GET['gone'])及username對應的資料
    $result=mysqli_query($conn,"SELECT * FROM $Table3 
                                WHERE dnum='{$_GET['gone']}' 
                                AND username='{$_SESSION['userName']}'");
    $row = mysqli_fetch_array($result);
    
    // 如果景點未被使用者標示去過 
    if($row['gone']=="0")
    {
      // 將file的gone欄位更改為1(標示景點已去)
      $sql = "UPDATE $Table3 SET gone=1
              WHERE dnum='{$_GET['gone']}' 
              AND username='{$_SESSION['userName']}'";
      mysqli_query($conn,$sql);
    }
  }
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

<script type="text/javascript" src="jquery.min.js"></script>

</head>


<body>
<div class="topbar animated fadeInLeftBig"></div>

<!-- Header Starts -->
<div class="navbar-wrapper">
  <div class="container">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="top-nav">
      <div class="container">
        
        <!-- 顯示使用者名稱 -->
        <a class="navbar-brand active"><h2><?php echo $_SESSION["userName"]?></h2></a>
            
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
                
                 <li ><a href="index.php">Home</a></li>
                 <li class="active"><a href="view.php">View</a></li>
                 <li ><a href="travel.php">My Travel</a></li>
                 <li ><a href="achievement.php">My Achievement</a></li>
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


<!-- Taichung & Tainan Button -->
<form method="post" action="view.php">
  <button  name="taichung" type="submit">Taichung</button> 
  <button  name="tainan" type="submit">Tainan</button> 
</form>


<!-- See Button click  Starts -->
<?php
// 如果點選"Taichung按鈕"// 如果點選"Taichung按鈕"
if($_SESSION['dst']=="0")
  // 從dst資料表內取Taichung景點的資料
  $result=mysqli_query($conn,"SELECT * FROM $Table2 
                              WHERE dnum ='{$_GET['id']}' 
                              AND d=1"); 
// 如果點選"Tainan按鈕"
else
  // 取dst資料表內取Tainan景點的資料
  $result=mysqli_query($conn,"SELECT * FROM $Table2 
                              WHERE dnum ='{$_GET['id']}'
                              AND d=2"); 

// 呼叫dst資料
echo "<div class='highlight-info'>
        <div class='container'>
            <div class='row text-center  wowload fadeInDownBig'> ";
    // 取每筆資料 
    while($row =mysqli_fetch_array($result))
    {
        echo "<h3>{$row['dname']}</h3>";    // 印出景點名      
        echo "<h4>{$row['dinfo']}</h4>";    // 印出景點資訊
        echo "<h3></h3>";       
    }
    echo    "</div>
          </div>
        </div>";
?>
<!-- See Button click Ends -->


<!-- Picture Starts -->
<div id="works"  class=" clearfix grid" > 
<form method ="post" action="view.php">

<?php
// 如果點選"Taichung按鈕"
if($_SESSION['dst']=="0")
  //從file資料表內取與username對應的資料
  $result=mysqli_query($conn,"SELECT * FROM $Table 
                              WHERE username='{$_SESSION['userName']}'");
// 如果點選"Tainan按鈕"
else                              
  //從file2資料表內取與username對應的資料
  $result=mysqli_query($conn,"SELECT * FROM $Table3 
                              WHERE username='{$_SESSION['userName']}'");
  // 取每筆資料
  while($row = mysqli_fetch_array($result)){
    echo "<figure class='effect-oscar  wowload fadeInUp' >";
    
    // 如果點選"Taichung按鈕"
    if($_SESSION['dst']=="0")
      //顯示Taichung景點圖片
      echo "<img name ='face'src='images/portfolio/0{$row['dnum']}.jpg' width='500' height='300'alt='img01'/>";
    // 如果點選"Tainan按鈕"
    else
      //顯示Tainan景點圖片
      echo "<img name ='face'src='images/portfolio/1{$row['dnum']}.jpg' width='500' height='300'alt='img01'/>";
    
    //顯示景點名字
    echo "<figcaption>
          <h2>{$row['dname']}</h2>      
            <p><br>";
            
            //未加入該景點      
            if($row['additem']==0)             
              echo "<a href='view.php?additem={$row['dnum']}'>add</a>";   //顯示"add"按鈕
            //已加入該景點
           else
              echo "<a>已加</a>" ;                                        //顯示"已加"按鈕
              
            //未去過該景點
            if($row['gone']==0)                
              echo "<a href='view.php?gone={$row['dnum']}'>gone</a></p>";  //顯示"gone"按鈕
            //已去過該景點
            else
              echo "<a>已選</a></p>" ;                                    //顯示"已選"按鈕
            
            //尚未點選"see more按鈕" 
            if($_SESSION["see"]==0)     
              echo"<p><a href='view.php?id={$row['dnum']}'>see more</a>";   //顯示"see more"按鈕
            //已點選過"see more按鈕"
            else
              //判斷哪一景點按了see more按鈕
              if($row['dnum']==$_SESSION['see'])
                echo"<p><a href='view.php?id=0'>close</a>";                   //顯示"close"按鈕
              //其餘景點  
              else
                echo"<p><a href='view.php?id={$row['dnum']}'>see more</a>";   
                  
    echo    "</p>
          </figcaption>
        </figure>";
  }
?>

</form>
</div>
<!-- Picture Ends -->

</body>
</html>