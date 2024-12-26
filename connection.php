<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "sql_learn";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$conn) {
    die("Error");
}