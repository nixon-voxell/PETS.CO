<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Manage Users Panel</title>
</head>
<?php 
  include "header.php"; 
  include "includes/admin/controller_admin.php";
  include "includes/utils/dbhandler.php";
?>

<style>
body {
  background-image: url('admin_background.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>

<?php include "admin_nav_bar.php"; ?>

<?php include "side_nav.html"; ?>

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

              while (list($memberID, $username, $email, $password, $priviledge_level) = mysqli_fetch_array($result))
                echo "<tr><td>$memberID</td><td>$username</td><td>$email</td><td>$password</td><td>$priviledge_level</td></tr>";
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
        <span class="helper-text" data-error="Min 5, Max 12 characters" data-success="correct">Min 5, Max 12 characters</span>
        <label for="username"> Username</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix"> password</i>
        <input name="pwd" type="password" class="validate" minlength="6" maxlength="20">
        <span class="helper-text" data-error="Min 8, Max 20 characters" data-success="correct">Min 8, Max 20 characters</span>
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
    <input class="btn orange btn-block z-depth-5" type="submit" name="submituser" value="Create User">
    </form>
  </div>

  <div class="row">
    <div class="card-panel red lighten-2; white-text" style="font-size: 20px">Delete User</div>      
    <form class="col s12" action="admin_manage_users.php" method="post">
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix">account_circle</i>
        <input name="userid" type="text" class="validate" minlength="1" maxlength="3">
        <label for="userid">ID</label>
        <span class="helper-text" data-error="Max 3 Characters" data-success="correct">Max 3 Characters</span>
        <div class="errormsg">
        <?php
          if (isset($_GET["error"]))
          {
            if ($_GET["error"] == "emptyid")
              echo "<p>Please Enter An ID!<p>";
            else if ($_GET["error"] == "deleted")
              echo "<p>Deleted User.</p>";
          }
        ?>
        </div>
      </div>
    </div>
    <input class="btn red btn-block z-depth-5" type="submit" name="deleteuser" value="Delete User">
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