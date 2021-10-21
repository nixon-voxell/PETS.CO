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
          <form class="col s12" action="admin_manage_users.php" method="post" style="margin-left: 80px">
        <div class="input-field col s2" style = "color:azure">
          <input name="searchmember" type="text" class="validate white-text" maxlength="20">
          <label for="searchmember">Search Member by Name</label>
          </form>
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
          <table class="centered responsive-table">
            <thead class="text-primary">
              <tr><th>Username</th><th>Privilege Level</th></tr>
            </thead>
            <tbody>
            <form class="col s14" action="admin_manage_users.php" method="get" style="margin-left: 1080px">
            <?php
              if (isset($_POST["searchmember"]))
              {
                $searchmember = $_POST["searchmember"];

                require_once "includes/utils/dbhandler.php";

                if (EmptyInputSelectUser($searchmember) !== false)
                  echo "<p>Please Enter A Value!<p>";

                SearchUser($conn, $searchmember);
              }else
              {
                $result = mysqli_query($conn,"select Username, PrivilegeLevel from members order by username")or die ("Select statement FAILED!");
                while ($row = mysqli_fetch_assoc($result) ) 
                { 
                  $id = $row["Username"]; 
                  echo "<tr><td>" . $row['Username'] . "</td><td>" . $row['PrivilegeLevel'] . "</td><td><button name='inspect' value='$id' class='btn'><i class='material-icons'>search</i></button></td></tr>";
                }
              }
            ?>
            </form>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col s12 m10; z-depth-5">
      <div class="card #212121 grey darken-4">
        <div class="card-content white-text">
          <span class="card-title" style="color: orange; font-weight: bold; text-align: center">Selected Member Details</span>
          <table class="responsive-table centered">
          <form class="col s14" action="admin_manage_users.php" method="get">
            <thead class="text-primary">
              <tr><th>MemberID</th><th>Username</th><th>Email</th><th>Privilege Level</th></tr>
            </thead>
            <tbody>
              <?php
                if (isset($_GET["inspect"]))
                {
                  $uid = $_GET["inspect"];
                  $result = mysqli_query($conn, "Select MemberID, Username, Email, PrivilegeLevel from Members WHERE Username = '$uid' order by Username")or die ("Select statement FAILED!");
                  while ($row = mysqli_fetch_array($result))
                  {
                    $deleteid = $row["MemberID"];                                                                                                                                                                                                                  
                    echo "<tr><td>" . $row['MemberID'] . "</td><td>" . $row['Username'] . "</td><td>" . $row['Email'] . "</td><td>" . $row['PrivilegeLevel'] . "</td><td><button class='btn red darken-4' name='delete' value='$deleteid'><a>Delete User</a></button></td></tr>";

                    if (isset($_GET["delete"]))
                    {
                      $id = $_GET["delete"];
                      $sql =  "Delete from Members WHERE MemberID = '$id'";
                      mysqli_query($conn, $sql)or die ("Delete statement FAILED!");
                    }
                  }
                }
              ?>
            </tbody>
            </form>
          </table>
        </div>
      </div>
    </div>
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