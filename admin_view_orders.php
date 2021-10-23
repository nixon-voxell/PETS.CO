<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - View Orders Panel</title>
</head>
<?php 
include "header.php";
include "includes/admin/controller_admin.php";
require_once "includes/utils/dbhandler.php";
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
  <h3 class="page-title white-text">Customers Cart/Orders </h3>
  <div class="row" style="padding-bottom: 10px;">
    <div class="col s12 m10; z-depth-5">
      <div class="card grey darken-3">
        <div class="card-content white-text">
          <span class="card-title" style="color: orange; font-weight: bold; text-align: center">Customers List</span>
          <form class="col s12" action="admin_view_orders.php" method="POST">
          <div class="row">
            <div class="input-field col s2 white-text">
              <input name="searchuid" type="text" class="validate; white-text" maxlength="20">
              <label for="searchuid">Search Member by Name</label>
              <span class="helper-text" data-error="text only" data-success="correct"></span>
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
          <table class="responsive-table centered">
            <thead class="text-white" style="border-bottom: 2px solid red;">
              <tr><th>Username</th><th>Email</th><th>OrderID</th><th>MemberID</th><th>CartFlag</th></tr>
            </thead>
            <tbody style="border-bottom: 2px solid white;">
            <form class="col s14" action="admin_view_orders.php" method="GET" style="margin-left: 1080px">
              <?php 
                if (isset($_POST["searchuid"]))
                {
                  $searchuid = $_POST["searchuid"];

                  if (EmptyInputSelectUser($searchuid) !== false)
                    echo "<p>Please Enter A Value!<p>";

                  SearchOrders($conn, $searchuid);
                }
                else
                {
                  $result = mysqli_query($conn, "SELECT M.username, M.email, o.* from Members M INNER JOIN Orders O using (memberid) order by Username") or die ("SELECT statement FAILED!");
                  while ($row = mysqli_fetch_assoc($result) ) 
                  { 
                    $id = $row["MemberID"]; 
                    echo "<tr><td>" . $row['username'] . "</td><td>" . $row['email'] . "</td><td>" .
                    $row['OrderID'] . "</td><td>" . $row['MemberID'] . "</td><td>" . $row['CartFlag'] .
                    "</td><td><button name='vieworder' value='$id' class='btn'><i class='material-icons'>search</i></button></td></tr>";
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
      <div class="card grey darken-3">
        <div class="card-content">
          <span class="card-title center-align cyan-text" style="font-weight: bold">Cart/Orders Details</span>
          <table class="centered responsive-table">
          <tbody>
          <?php
          // View Selected Customer Cart/Orders 
          if (isset($_GET["vieworder"]))
          {
            $uid = $_GET["vieworder"];
            echo $cartItemCount;
            echo $orderCount;
            SelectedIDOrders($conn, $uid);
          }  
          ?>
          </tbody>
          </table>
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