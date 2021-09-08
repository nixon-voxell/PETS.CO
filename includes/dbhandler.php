<?php

//default XAMPP credentials 
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "petstore_acc";

//secure connection to database
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

//if connection failed
if (!$conn){
  die("Connection failed: " . mysqli_connect_error());
}
?>