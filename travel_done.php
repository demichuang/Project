<?php
header('Content-type: text/html; charset=utf-8');   //使用萬用字元碼utf-8
include_once("mysql.php");                          // 連結資料庫new
$Table_file="file";      // 取file資料表(影響：delete按鈕，no按鈕)
$Table_user="user";      // 取user資料表(影響：edit按鈕)
$Table_file2="file2";    // 取file2資料表(影響：delete按鈕，no按鈕)

session_start();    // 啟動session(使用：$_SESSION['userName']，$_SESSION["ds"])

// 如果有規劃資料
if(!empty($_POST['word']))
{
    $word = ereg_replace("\n", "<br />\n", $_POST['word']); // 將換行轉成資料庫存取的換行符號
    
    // 修改的是Taichung的規劃資料
    if($_GET['plan']==0)
        //更新Taichung的規劃資料
        $sql = "UPDATE $Table_user SET edit ='$word'
                WHERE username='{$_SESSION['userName']}'";
    // 修改的是Tainan的規劃資料
    else
        //更新Tainan的規劃資料
        $sql = "UPDATE $Table_user SET edit2 ='$word'
                WHERE username='{$_SESSION['userName']}'";
    mysqli_query($conn,$sql);
    header('Location:travel.php');      // 跳轉頁面(travel.php)
}


// 點選"delete按鈕"
if(($_GET['del'])!="")
{
    // 如果點選"Taichung按鈕"
    if($_SESSION['ds']=="0")
        // 將file的additem欄位更改為0(刪除加入景點)
        mysqli_query($conn,$sql = "UPDATE $Table_file SET additem=0
                                    WHERE dnum='{$_GET['del']}' 
                                    AND username='{$_SESSION['userName']}'");
    // 如果點選"Tainan按鈕"
    if($_SESSION['ds']=="1") 
        // 將file2的additem欄位更改為0(刪除加入景點)
        mysqli_query($conn,"UPDATE $Table_file2 SET additem=0
                            WHERE dnum='{$_GET['del']}' 
                            AND username='{$_SESSION['userName']}'");
    header('Location:travel.php');      // 跳轉頁面(travel.php)
}

// 點選"no按鈕"
if(($_GET['gone'])!="")
{ 
    // 如果點選"Taichung按鈕"
        // 將file的gone欄位更改為0(刪除已去景點)
        mysqli_query($conn,"UPDATE $Table_file SET gone=0
                            WHERE dname='{$_GET['gone']}' 
                            AND username='{$_SESSION['userName']}'");
    // 如果點選"Tainan按鈕"
        // 將file2的gone欄位更改為0(刪除已去景點)
        mysqli_query($conn,"UPDATE $Table_file2 SET gone=0
                            WHERE dname='{$_GET['gone']}' 
                            AND username='{$_SESSION['userName']}'");
    header("Location:achievement.php");     // 跳轉頁面(achievement.php)
}
?>

