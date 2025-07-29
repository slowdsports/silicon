<?php
//$conn = mysqli_connect("localhost","megaaxmg","UEkpjZOIzDnJk","megaaxmg_matte");
//$conn = mysqli_connect("localhost","root","root","besoccer"); //local
$conn = mysqli_connect("localhost","u5855787_root","SlowD2019","u5855787_besoccer"); //localHost
//$conn = mysqli_connect("localhost","iraffle1_root","z1CnB-*XSJ-W","iraffle1_besoccer"); //prod

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
