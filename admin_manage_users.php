<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Manage Users Panel</title>
</head>
<?php 
include "header.php"; 
include "includes/admin/controller_admin.php";
$username = $_SESSION["Username"];
$email = $_SESSION["Email"]; 
?>

<style>
body {
  background-image: url('admin_background.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>

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
    <li style="color: purple; font-weight: bold">
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
    <li style="color: purple; font-weight: bold">
      <i class="material-icons blue-text">view_carousel</i>Product/Orders
    </li>
  </div>
  <div class="divider"></div>

  <li>
      <a href=""><i class="material-icons blue-text">border_color</i>View/Manage Products</a>
  </li>
  <li>
      <a href="admin_view_orders.php"><i class="material-icons blue-text">view_agenda</i>View Customer Cart/Orders </a>
  </li>
</ul>

<!--SideNav Finished-->

<!-- manage users start -->
<div class="container">
  <h3 class="white-text"> Manage Users </h3>

  <div class="row">
    <div class="col s12 m10; z-depth-5">
      <div class="card #212121 grey darken-4">
        <div class="card-content white-text">
          <span class="card-title" style="color: orange; font-weight: bold; text-align: center">Users List</span>
          <table class="centered; responsive-table">
            <thead class="text-primary">
              <tr><th>ID</th><th>Username</th><th>Email</th><th>Password</th><th>Privilege Level</th></tr>
            </thead>
            <tbody>
            <?php
              $result = mysqli_query($conn,"select memberid, username, email, password, PrivilegeLevel from members order by username")or die ("Select statement FAILED!");

              while (list($id, $username, $email, $password, $priviledge_level) = mysqli_fetch_array($result))
                echo "<tr><td>$id</td><td>$username</td><td>$email</td><td>$password</td><td>$priviledge_level</td></tr>";
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="card-panel orange lighten-2; white-text" style="font-size: 20px">Create Users</div>      
    <form class="col s12" action="admin_manage_users.php" method="post">
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix">account_circle</i>
        <input name="username" type="text" class="validate" minlength="5" maxlength="12">
        <span class="helper-text" style = "color:azure" data-error="Min 5, Max 12 characters" data-success="correct">Min 5, Max 12 characters</span>
        <label for="username"> Username</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix"> password</i>
        <input name="pwd" type="password" class="validate" minlength="6" maxlength="20">
        <span class="helper-text" style = "color:azure" data-error="Min 8, Max 20 characters" data-success="correct">Min 8, Max 20 characters</span>
        <label for="pwd"> Password</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix"> password</i>
        <input name="repeatPwd" type="password" class="validate" maxlength="14">
        <label for="repeatPwd"> Repeat Password</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix">assignment_ind</i>
        <input name="level" type="text" class="validate" maxlength="1">
        <label for="text">Privilege Level (0-User, 1-Admin)</label>
        <span class="helper-text" data-error="wrong" data-success="correct"></span>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix">email</i>
        <input name="email" type="email" class="validate" maxlength="25">
        <label for="email">Email</label>
        <span class="helper-text" data-error="wrong" data-success="correct"></span>
        <div class="errormsg">
        <?php
          if (isset($_GET["error"]))
          {
            if ($_GET["error"] == "emptyinput")
              echo "<p>*Fill in all fields!<p>";

            else if ($_GET["error"] == "invaliduid")
              echo "<p>*Choose a proper username!</p>";

            else if ($_GET["error"] == "passwordsdontmatch")
              echo "<p>*Passwords doesn't match!</p>";

            else if ($_GET["error"] == "usrnametaken")
              echo "<p>*Username/Email already taken!</p>";

            else if ($_GET["error"] == "none")
              echo "<p>Added User.</p>";
          }
        ?>
        </div>
      </div>
    </div>
    <input class="btn orange btn-block; z-depth-5" type="submit" name="submituser" value="Create User">
    </form>
  </div>

  <div class="row">
    <div class="card-panel red lighten-2; white-text" style="font-size: 20px">Delete User</div>      
    <form class="col s12" action="admin_manage_users.php" method="post">
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix">account_circle</i>
        <input name="userid" type="text" class="validate" minlength="1" maxlength="3">
        <label for="username">ID</label>
        <span class="helper-text" style = "color:azure" data-error="Max 3 Characters" data-success="correct">Max 3 Characters</span>
        <div class="errormsg">
        <?php
          if (isset($_GET["error"]))
          {
            if ($_GET["error"] == "emptyid")
              echo "<p>Please Enter An ID!<p>";
            elseif ($_GET["error"] == "deleted")
              echo "<p>Deleted User.</p>";
          }
        ?>
        </div>
      </div>
    </div>
    <input class="btn red btn-block; z-depth-5" type="submit" name="deleteuser" value="Delete User">
    </form>
  </div>
</div>

<script>
  $(document).ready(function () 
  {
    $(".sidenav").sidenav();
  });
</script>

<?php include "footer.php"; ?>