<?php

// default XAMPP credentials 
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "test";      //test / petscodatabase.

// secure connection to database
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

// if connection failed
if (!$conn)
  die("Connection failed: " . mysqli_connect_error());