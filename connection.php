<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "data_mhs";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$conn) {
    die("Error");
}