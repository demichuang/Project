<?php
header('Content-type: text/html; charset=utf-8');
include_once("mysql.php");
$Table="list";

$result=mysqli_query($conn,"SELECT * FROM $Table WHERE username='{$_COOKIE['userName']}'");
$row = mysqli_fetch_array($result);

$id = $_GET["add"];

while ($row) {
    if($row['dnum']==$_GET['add'])
	    echo $_GET['add']; 
}
?>