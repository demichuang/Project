<?php
$dbServer="127.0.0.1";
$dbUser="root";
$dbPass="";
$dbName="new";

$conn=@mysqli_connect($dbServer,$dbUser,$dbPass,$dbName);

if(!($conn)){    
    die("not connect database");
}

mysqli_set_charset($conn,"utf8");
?>