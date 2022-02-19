<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Manage Users Panel</title>
</head>
<?php 
  include "header.php"; 
  include "includes/admin.inc.php";
  include "includes/utils/dbhandler.php";
  include "admin_nav_bar.php"; 
  include "side_nav.html"; 
?>

<div class="container">
  <h3 class="page-title">Manage Users</h3>

  <!-- users list start -->
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <div class="card-content white-text">
        <span class="card-title orange-text bold">Users List</span>

        <!-- search member input field start -->
        <form action="admin_manage_users.php" method="POST">
          <div class="row" style="margin: 0px;">
            <div class="input-field col s3" style = "color:azure">
              <input name="search_member" type="text" class="validate white-text" maxlength="20">
              <label for="search_member">Search member by name</label>
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

        <!-- search member result list start -->
        <form action="admin_manage_users.php" method="GET">
          <table class="responsive-table">
            <thead class="text-primary">
              <tr><th>Username</th><th></th></tr>
            </thead>
            <tbody>
              <?php
                if (isset($_POST["search_member"]))
                {
                  $searchMember = $_POST["search_member"];
                  
                  if (EmptyInputSelectUser($searchMember))
                    echo "<p class='prompt-warning'>Please enter a value</p>";
                  else
                  {
                    $sql = "SELECT Username, PrivilegeLevel FROM Members WHERE Username LIKE '%$searchMember%' ORDER BY Username";
                    $result = $conn->query($sql) or die ("User does not exists!");
                    while ($row = mysqli_fetch_assoc($result) ) 
                    { 
                      $username = $row["Username"]; 
                      echo(
                        "<tr>
                          <td>$username</td>
                          <td>
                            <button name='inspect' value='$username' class='btn'>
                              <i class='material-icons'>search</i>
                            </button>
                          </td>
                        </tr>"
                      );
                    }
                  }
                }

                if (!isset($searchMember) || EmptyInputSelectUser($searchMember))
                {
                  // limited search to prevent page overflow
                  $sql = "SELECT Username, PrivilegeLevel FROM Members ORDER BY Username LIMIT 20";
                  $result = $conn->query($sql) or die ($conn->error);
                  while ($row = mysqli_fetch_assoc($result) ) 
                  { 
                    $username = $row["Username"]; 
                    echo(
                      "<tr>
                        <td>$username</td>
                        <td class='left-align'>
                          <button name='inspect' value='$username' class='btn'>
                            <i class='material-icons'>search</i>
                          </button>
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
  <?php if (isset($_GET["inspect"])) { ?>
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
                  $uid = $_GET["inspect"];
                  $sql = "SELECT MemberID, Username, Email, PrivilegeLevel FROM Members WHERE Username = '$uid' ORDER BY Username";
                  $result = $conn->query($sql) or die ("Select statement FAILED!");
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
                      </tr>"
                    );
                  }
                ?>
              </tbody>
            </form>
          </table>
        </div>
      </div>
    </div>
  <?php } ?>

  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <div class="card-content">
        <span class="card-title orange-text bold">Create User</span>
        <form action="admin_manage_users.php" method="POST">
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
                    if ($_GET["error"] == "empty_input")
                      echo "<p>*Fill in all fields!<p>";

                    else if ($_GET["error"] == "passwords_dont_match")
                      echo "<p>*Passwords doesn't match!</p>";

                    else if ($_GET["error"] == "invaliid_uid")
                      echo "<p>*Choose a proper username!</p>";

                    else if ($_GET["error"] == "username_taken")
                      echo "<p>*Username/Email already taken!</p>";

                    else if ($_GET["error"] == "none")
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
  </div>

<script>
  $(document).ready(function () 
  {
    $(".sidenav").sidenav();
  });

  $(document).ready(function(){
    $('select').formSelect();
  });
</script>

<?php include "footer.php"; ?>