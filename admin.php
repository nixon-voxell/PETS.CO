<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Admin Panel</title>
</head>
<?php include "header.php"; ?>

<style>
body
{
  background-image: url('admin_background.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>

<!-- Nav bar-->
<nav class="blue">
  <div class="nav wrapper">
    <a href="admin.php" class="brand-logo center">Admin Panel</a>
    <a href="" data-target="slide-out" class="sidenav-trigger show-on-large" style="margin-top: 15px" data-activates="slide-out"><i class="material-icons">menu</i></a>
  </div>
</nav>
<!-- Nav bar end-->

<!-- Side nav start-->
<ul class="sidenav grey darken-4" style="height: 100%" id="slide-out">

  <!-- admin profile -->
  <li>
    <div class="user-view">
      <div class="background">
        <img src="admin_image.jpg" style="height: 180px; opacity: 70%">
      </div>
      <span class="white-text glow-text"><?php echo "Welcome back, $username" ?></span>
      <span class="white-text glow-text"><?php echo "$email" ?></span>
    </div>
  </li>
  <!-- admin profile end -->

  <div>
    <li>
      <a class="glow-title">
        <i class="material-icons blue-text">supervisor_account</i>Account Management
      </a>
    </li>

    <li>
      <a class="white-text" href="admin_manage_users.php">
        <i class="material-icons blue-text">account_box</i>View/Manage Users
      </a>
    </li>

    <li>
      <a class="glow-title">
        <i class="material-icons blue-text">view_carousel</i>Product/Orders
      </a>
    </li>

    <li>
      <a class="white-text" href="">
        <i class="material-icons blue-text">border_color</i>View/Manage Products</a>
    </li>
    <li>
      <a class="white-text" href="admin_view_orders.php">
        <i class="material-icons blue-text">view_agenda</i>View Customer Cart/Orders </a>
    </li>
  </div>
</ul>

<!--SideNav Finished-->

<div class="container">
<div class="container center">
<!-- <h3 class="white-text"> Home - Shortcuts</h3> -->

<div class="row">
<div class="container center; z-depth-5" style= "text-align: center; margin-top: 50px">
    <div class="col s12 m12; z-depth-5">
    <div class="card blue-grey darken-3">
        <div class="card-content white-text">
          <span class="card-title">Manage Products</span>
        <i class="material-icons blue-text" style="margin-right: 10px;">border_color</i>
        <i class="material-icons blue-text">view_agenda</i>
        </div>
        <div class="card-action">
          <a class="glow-gradient" href="#">Go To Manage Products Page</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
  <div class="container center; z-depth-5" style= "text-align: center; margin-top: 50px";>
    <div class="col s12 m12; z-depth-5">
    <div class="card blue-grey darken-3">
        <div class="card-content white-text">
          <span class="card-title">View Customer Cart/Orders </span>
          <i class="material-icons blue-text">supervisor_account</i>
          <i class="material-icons blue-text">view_agenda</i>
        </div>
        <div class="card-action">
          <a class="glow-gradient" href="admin_view_orders.php">Go To View Customer Cart/Orders Page</a>
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
    </div>