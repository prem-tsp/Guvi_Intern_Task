<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "guvi_task";

$conn = mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);

if(!$conn){
    die("Failed".mysqli_connect_error());
}
?>