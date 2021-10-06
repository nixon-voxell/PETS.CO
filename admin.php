<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Admin Panel</title>
</head>
<?php 
include "header.php"; 
$username = $_SESSION["username"];
$email = $_SESSION["email"]; 
?>
<!-- Nav bar-->
<nav>
  <div class="nav wrapper">
    <div class="container">
      <a href="admin.php" class="brand-logo center">Admin Panel</a>
      <a href="" data-target="slide-out" class="sidenav-trigger show-on-large" data-activates="slide-out"><i class="material-icons">menu</i></a>
    </div>
  </div>
</nav>
<!-- Nav bar end-->

<!-- Side nav start-->
<ul class="sidenav" id="slide-out">

  <!-- admin profile -->
  <li>
    <div class="user-view">
      <div class="background">
        <img src="adminimage.jpg" style="width: 300px; height: 220px;">
      </div>
      <span class="black-text name"><?php echo "Welcome back, $username" ?></span>
      <span class="black-text email"><?php echo "$email" ?></span>
    </div>
  </li>
  <!-- admin profile end -->
  <div class="container">
    <div class="divider"></div>
    <li>
      <i class="material-icons blue-text">supervisor_account</i>Account Management
    </li>
  </div>

  <div class="divider"></div>
  <li>
    <a href="admin_manage_users.php"><i class="material-icons blue-text">account_box</i>View/Manage Users
    </a>
  </li>

  <div class="divider"></div>

  <div class="container">
    <li>
      <i class="material-icons blue-text">view_carousel</i>Product/Orders
    </li>
  </div>
  <div class="divider"></div>

  <li>
      <a href=""><i class="material-icons blue-text">border_color</i>View/Manage Products</a>
  </li>
  <li>
      <a href=""><i class="material-icons blue-text">view_agenda</i>View Customer Cart/Orders </a>
  </li>
</ul>

<!--SideNav Finished-->

<div class="container">
<h3 class="black-text"> Home - Shortcuts</h3>
  
<div class="row">
    <div class="col s12 m4">
    <div class="card blue-grey">
        <div class="card-content white-text">
          <span class="card-title">Manage Products</span>
        </div>
        <div class="card-action">
          <a href="#">Go To Manage Products Page</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col s12 m4">
    <div class="card blue-grey">
        <div class="card-content white-text">
          <span class="card-title">Manage Customer Cart/Orders </span>
        </div>
        <div class="card-action">
          <a href="#">Go To Customer Cart/Orders Page</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () 
  {
    $(".sidenav").sidenav();
  });
</script>