<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Admin Panel</title>
</head>
<?php
  include "header.php";
  include "admin_nav_bar.php";
  include "side_nav.html";
?>

<div class="row">
  <div class="container center; z-depth-5" style= "text-align: center; margin-top: 50px">
    <div class="col s12 m12; z-depth-5">
      <div class="card blue-grey darken-3">
        <div class="card-content white-text">
          <span class="card-title">Manage Users</span>
          <i class="material-icons blue-text">supervisor_account</i>
        </div>
        <div class="card-action">
          <a class="glow-gradient" href="admin_manage_users.php">Go to Manage Users Page</a>
        </div>
      </div>
    </div>
  </div>
</div>

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
          <a class="glow-gradient" href="admin_manage_products2.php">Go To Manage Products Page</a>
        </div>
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

<?php include "footer.php"; ?>