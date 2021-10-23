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

<div class="container">
  <h3 class="white-text page-title">Manage Users</h3>

  <!-- users list start -->
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <div class="card-content white-text">
        <span class="card-title orange-text bold">Users List</span>

        <!-- search member input field start -->
        <form action="admin_manage_users.php" method="POST">
          <div class="row" style="margin: 0px;">
            <div class="input-field col s3" style = "color:azure">
              <input name="SearchMember" type="text" class="validate white-text" maxlength="20">
              <label for="SearchMember">Search member by name</label>
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
          </div>
        </form>
        <!-- search member input field end -->

        <!-- serach member result list start -->
        <form action="admin_manage_users.php" method="GET">
          <table class="responsive-table">
            <thead class="text-primary">
              <tr><th>Username</th><th></th></tr>
            </thead>
            <tbody>
              <?php
                if (isset($_POST["SearchMember"]))
                {
                  $searchMember = $_POST["SearchMember"];
                  
                  require_once "includes/utils/dbhandler.php";
                  
                  if (EmptyInputSelectUser($searchMember) !== false)
                  echo "<p class='yellow-text' style='font-style: italic;'>Please enter a value</p>";
                  
                  SearchUser($conn, $searchMember);
                }else
                {
                  $sql = "SELECT Username, PrivilegeLevel FROM Members ORDER BY Username";
                  $result = $conn->query($sql) or die ("SELECT statement FAILED!");
                  while ($row = mysqli_fetch_assoc($result) ) 
                  { 
                    $username = $row["Username"]; 
                    echo(
                      "<tr>
                        <td>$username</td>
                        <td class='left-align'>
                          <button name='inspect' value='$username' class='btn'><i class='material-icons'>search</i></button>
                        </td> 
                      </tr>"
                    );
                  }
                }
                ?>
            </tbody>
          </table>
        </form>
        <!-- serach member result list end -->
      </div>
    </div>
  </div>
  <!-- users list end -->

  <!-- selected member details start -->
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <div class="card-content white-text">
        <span class="card-title orange-text bold">Selected Member Details</span>
        <table class="responsive-table">
          <form action="admin_manage_users.php" method="GET">
            <thead class="text-primary">
              <tr><th>MemberID</th><th>Username</th><th>Email</th><th>Privilege Level</th></tr>
            </thead>
            <tbody>
              <?php
                // inspect user
                if (isset($_GET["inspect"]))
                {
                  $uid = $_GET["inspect"];
                  $sql = "SELECT MemberID, Username, Email, PrivilegeLevel FROM Members WHERE Username = '$uid' ORDER BY Username";
                  $result = mysqli_query($conn, $sql) or die ("Select statement FAILED!");
                  while ($row = mysqli_fetch_array($result))
                  {
                    $deleteid = $row["MemberID"];
                    $username = $row["Username"];
                    $email = $row["Email"];
                    $privilegeLevel = $row["PrivilegeLevel"];
                    echo(
                      "<tr>
                        <td>$deleteid</td>
                        <td>$username</td>
                        <td>$email</td>
                        <td>$privilegeLevel</td>
                        <td><a>
                          <button class='btn red darken-4' name='delete' value='$deleteid'
                            onclick=\"return confirm('Are you sure you want delete \'$username\'?');\">Delete User</button>
                        </a></td>
                      </tr>"
                    );
                  }
                }

                // delete user
                if (isset($_GET["delete"]))
                {
                  $id = $_GET["delete"];
                  $sql =  "DELETE FROM Members WHERE MemberID = $id";
                  $conn->query($sql) or die ("<p class='red-text'>*Delete statement FAILED!</p>");
                }
              ?>
            </tbody>
          </form>
        </table>
      </div>
    </div>
  </div>
  <!-- selected member details end -->

  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <span class="card-title orange-text bold" style="padding-left: 20px;">Create User</span>
      <form action="admin_manage_users.php" method="POST" style="padding-left: 10px;">
        <div class="row">
          <div class="input-field col s8 white-text">
            <i class="material-icons prefix">account_circle</i>
            <input name="username" type="text" class="validate white-text" minlength="5" maxlength="12">
            <span class="helper-text grey-text" data-error="Min 5, Max 12 characters" data-success="Min 5, Max 12 characters">Min 5, Max 12 characters</span>
            <label for="username" class="white-text"> Username</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s8 white-text">
            <i class="material-icons prefix"> password</i>
            <input name="pwd" type="password" class="validate white-text" minlength="6" maxlength="20">
            <span class="helper-text grey-text" data-error="Min 8, Max 20 characters" data-success="Min 8, Max 20 characters">Min 8, Max 20 characters</span>
            <label for="pwd" class="white-text"> Password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s8 white-text">
            <i class="material-icons prefix"> password</i>
            <input name="repeat_pwd" type="password" class="validate white-text" maxlength="14">
            <label for="repeat_pwd" class="white-text"> Repeat Password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s8 white-text">
            <i class="material-icons prefix white-text">assignment_ind</i>
            <select name="level">
              <option value="" disabled selected>Choose your option</option>
              <option value=1>Member</option>
              <option value=2>Admin</option>
            </select>
            <label class="white-text">Privilege Level</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s8 white-text">
            <i class="material-icons prefix">email</i>
            <input name="email" type="email" class="validate white-text" maxlength="25">
            <label for="email" class="white-text">Email</label>
            <span class="helper-text white-text" data-error="wrong" data-success="correct"></span>
            <div class="errormsg">
              <?php
                if (isset($_GET["error"]))
                {
                  if ($_GET["error"] == "EmptyInput")
                    echo "<p>*Fill in all fields!<p>";

                  else if ($_GET["error"] == "PasswordsDontMatch")
                    echo "<p>*Passwords doesn't match!</p>";

                  else if ($_GET["error"] == "Invaliduid")
                    echo "<p>*Choose a proper username!</p>";

                  else if ($_GET["error"] == "UsernameTaken")
                    echo "<p>*Username/Email already taken!</p>";

                  else if ($_GET["error"] == "None")
                    echo "<p class='green-text'>Added User.</p>";
                }
              ?>
            </div>
          </div>
        </div>
        <input class="btn orange btn-block z-depth-5" type="submit" name="submit_user" value="Create User">
      </form>
    </div> 
  </div>

<script>
  $(document).ready(function () 
  {
    $(".sidenav").sidenav();
  });
  
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('select').formSelect();
  });
</script>

<?php include "footer.php"; ?>