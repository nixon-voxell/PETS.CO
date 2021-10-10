<?php 
session_start(); 
require "includes/utils/dbhandler.php";
require "includes/utils/common_util.php";

if (isset($_SESSION["MemberID"]))
{
$id = $_SESSION["MemberID"];
$sql = "SELECT * FROM Members WHERE MemberID='$id'";
write_log('pass3-'.$id);
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
$email = $row["Email"];
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="./static/css/base.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="./static/materialize/js/materialize.js"></script>
</head>

<body>
  <nav style="height: 100px";>
    <div class="nav-wrapper blue-grey darken-4">
      <a href="index.php"><img src = "logo.svg" alt="logo" class="brand-logo" height="100"/></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <?php
          if (isset($_SESSION["MemberID"]))
          {
            if (isAdmin())
              echo "<li><a id='admin' href='admin.php'>Admin Panel</a></li>";
            echo "<li><a id='cart' href='cart.php'>Cart</a></li>";
            echo "<li><a id='manage_profile' href='manage_profile.php?email = $email'>Manage Profile</a></li>";
            echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
          } else
          {
            echo "<li><a id='login' href='login.php'>Login</a></li>";
            echo "<li><a id='signup' href='signup.php'>Sign Up</a></li>";
          }
          ?>
      </ul>
    </div>
  </nav>
    
  <script src="./static/js/header.js"></script>
  <div class="content">