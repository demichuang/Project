<?php
header('Content-type: text/html; charset=utf-8');
include_once("mysql.php");
$Table="file";
$Table2="user";
$Table3="gone";
session_start();


if(!empty($_POST['word']))      // Edit send      
{
    $word = $_POST['word'];
    $word = ereg_replace("\n", "<br />\n", $word);
    $sql = "UPDATE $Table2 SET edit ='$word'
            WHERE username='{$_SESSION['userName']}'";
    mysqli_query($conn,$sql);
}

if(($_GET['del'])!=""){         // Delete button click
    $sql = "UPDATE $Table SET additem=0
                    WHERE dnum='{$_GET['del']}' AND username='{$_SESSION['userName']}'";
    mysqli_query($conn,$sql);
    
    $numdel=mysqli_affected_rows($conn);
}

if(($_GET['gone'])!=""){      // GoneDelete button click
    $sql = "DELETE FROM $Table3 
            WHERE username='{$_SESSION['userName']}'
            AND dname='{$_GET['gone']}'";
    mysqli_query($conn,$sql);
    header("Location:achievement.php");
}

header('Location:travel.php');
?>

