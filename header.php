<?php
  session_start();
  require "includes/utils/dbhandler.php";
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="./static/css/base.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="./static/materialize/js/materialize.js"></script>
</head>

<body>
  <nav>
    <div class="nav-wrapper blue-grey darken-4">
      <a href="index.php"><img src = "logo.svg" alt="logo" class="brand-logo" height="100"/></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <?php
          if(isset($_SESSION["MemberID"]))
          {
            echo "<li><a id='cart' href='cart.php'>Cart<span class='new badge' id='cart_badge'>0</span></a></li>";
            echo "<li><a id='manage_profile' href='manage_profile.php'>Manage Profile</a></li>";
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