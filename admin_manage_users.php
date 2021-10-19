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
  <h3 class="white-text page-title">Manage Users</h3>
      <div class="row">
      <form class="col s14" action="admin_manage_users.php" method="post" style="margin-left: 1000px">   
        <div class="input-field col s8" style="color:azure">
          <input name="userid" type="text" class="validate white-text" minlength="1" maxlength="3" style="margin-bottom: 0px">
          <label for="userid" class="white-text">Delete User (ID)</label>
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
      </form>
      </div>
  <div class="row">
    <div class="col s12 z-depth-5 rounded-card">
      <div class="card grey darken-4 rounded-card">
        <div class="card-content white-text">
          <span class="card-title" style="color: orange; font-weight: bold; text-align: center">User List</span>
          <form class="col s12" action="admin_manage_users.php" method="post">
        <div class="input-field col s2" style = "color:azure">
          <input name="searchmember" type="text" class="validate white-text" maxlength="20">
          <label for="searchmember">Search Member by Name</label>
          <div class="errormsg">
            <?php
              if (isset($_GET["error"]))
              {
                if ($_GET["error"] == "emptysearch")
                  echo "<p>Empty Input!</p>";
              }
            ?>
          </div>
        </div>
      </form>
          <table class="centered; responsive-table">
            <thead class="text-primary">
              <tr><th>ID</th><th>Username</th><th>Email</th><th>Password</th><th>Privilege Level</th></tr>
            </thead>
            <tbody>
            <?php
              if (isset($_POST["submitlevel"]))
              {
                $privilegelevel = $_POST["privilegelevel"];
              
                require_once "includes/utils/dbhandler.php";
              
                if (EmptyInputSelectUser($privilegelevel) !== false)
                  echo "<p>Please Enter A Value!<p>";
  
                ChooseUser($conn, $privilegelevel);
              }else if (isset($_POST["searchmember"]))
              {
                $searchmember = $_POST["searchmember"];

                require_once "includes/utils/dbhandler.php";

                if (EmptyInputSelectUser($searchmember) !== false)
                  echo "<p>Please Enter A Value!<p>";

                SearchUser($conn, $searchmember);
              }else
              {
                $result = mysqli_query($conn,"select memberid, username, email, password, PrivilegeLevel from members order by username")or die ("Select statement FAILED!");
                
                while (list($memberID, $username, $email, $password, $priviledge_level) = mysqli_fetch_array($result))
                  echo "<tr><td>$memberID</td><td>$username</td><td>$email</td><td>$password</td><td>$priviledge_level</td></tr>";
              }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row; z-depth-5" style="margin: 50px 0 50px 0; padding: 10px; display: block !important">
    <div class="card-panel #4a148c purple darken-4; white-text" style="font-size: 20px">Generate User List Based on Privilege Level</div>      
    <form class="col s12" action="admin_manage_users.php" method="post">
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix">account_circle</i>
        <input name="privilegelevel" type="text" class="validate white-text" maxlength="1">
        <label for="privilegelevel" class="white-text">Privilege Level</label>
        <span class="helper-text white-text" data-error="Max 1 Character" data-success="Max 1 Character">Max 1 Character</span>
        <div class="errormsg">
        <?php
          if (isset($_GET["error"]))
          {
            if ($_GET["error"] == "chooseempty")
              echo "<p>*Fill in all fields!<p>";
          }
        ?>
        </div>
      </div>
    </div>
    <input class="btn #4a148c purple darken-4 btn-block z-depth-5" type="submit" name="submitlevel" value="Generate">
    </form>
  </div>

  <div class="row; z-depth-5" style="padding: 10px">
    <div class="card-panel orange lighten-2; white-text" style="font-size: 20px">Create Users</div>      
    <form class="col s12" action="admin_manage_users.php" method="post">
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix">account_circle</i>
        <input name="username" type="text" class="validate white-text" minlength="5" maxlength="12">
        <span class="helper-text white-text" data-error="Min 5, Max 12 characters" data-success="Min 5, Max 12 characters">Min 5, Max 12 characters</span>
        <label for="username" class="white-text"> Username</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix"> password</i>
        <input name="pwd" type="password" class="validate white-text" minlength="6" maxlength="20">
        <span class="helper-text white-text" data-error="Min 8, Max 20 characters" data-success="Min 8, Max 20 characters">Min 8, Max 20 characters</span>
        <label for="pwd" class="white-text"> Password</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix"> password</i>
        <input name="repeatPwd" type="password" class="validate white-text" maxlength="14">
        <label for="repeatPwd" class="white-text"> Repeat Password</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix">assignment_ind</i>
        <input name="level" type="text" class="validate white-text" minlength="1" maxlength="1">
        <label for="text" class="white-text">Privilege Level (0-User, 1-Admin)</label>
        <span class="helper-text" data-error="wrong" data-success="correct"></span>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix">email</i>
        <input name="email" type="email" class="validate white-text" maxlength="25">
        <label for="email" class="white-text">Email</label>
        <span class="helper-text white-text" data-error="wrong" data-success="correct"></span>
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
</div>

<script>
  $(document).ready(function () 
  {
    $(".sidenav").sidenav();
  });
</script>

<?php include "footer.php"; ?>