<?php
$conn = mysqli_connect("localhost", "root", "root", "besoccer"); //local
//$conn = mysqli_connect("localhost","n57whzfm2yvo","SlowD2019","cookiename"); //localHost
//$conn = mysqli_connect("localhost","iraffle1_root","z1CnB-*XSJ-W","iraffle1_besoccer"); //prod

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>