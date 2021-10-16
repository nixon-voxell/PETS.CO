<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - View Orders Panel</title>
</head>
<?php 
  include "header.php";
  include "includes/admin/controller_admin.php";
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
  <h3 class="grey-text">Customers Cart/Orders </h3>
  <div class="row" style="padding-bottom: 10px;">
    <div class="col s12 m10; z-depth-5">
      <div class="card grey darken-3">
        <div class="card-content white-text">
          <span class="card-title" style="color: orange; font-weight: bold; text-align: center">Customers List</span>
          <form class="col s12" action="admin_view_orders.php" method="post">
          <div class="row">
            <div class="input-field col s2" style = "color:azure;">
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
          <table class="responsive-table">
            <thead class="text-white" style="border-bottom: 2px solid red;">
              <tr><th>Username</th><th>Email</th><th>OrderID</th><th>MemberID</th><th>CartFlag</th></tr>
            </thead>
            <tbody style="border-bottom: 2px solid white;">
            <?php 
              if (isset($_POST["searchuid"]))
              {
                $searchuid = $_POST["searchuid"];

                require_once "includes/utils/dbhandler.php";

                if (EmptyInputSelectUser($searchuid) !== false)
                  echo "<p>Please Enter A Value!<p>";

                SearchOrders($conn, $searchuid);
              }else
              { include_once "includes/utils/dbhandler.php";
                ShowCustomerList($conn); 
              }
            ?>
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
          <span class="card-title center-align cyan-text" style="font-weight: bold">Selected MemberID Cart/Orders Details</span>
          <table class="centered responsive-table">
          <tbody>
          <?php 
          // View Selected Customer Cart/Orders 
          if (isset($_POST["selectuser"]))
          {
            $uid = $_POST["uid"];

            if (EmptyInputSelectUser($uid) !== false)
              echo "<p>Enter an ID to view again!</p>";

            SelectedIDOrders($conn, $uid);
          }?>
          
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row z-depth-5" style="padding: 10px;">
  <div class="card-panel #00acc1 cyan darken-1 z-depth-5 white-text" style="font-size: 20px">Select MemberID to View Cart/Ordered Items</div>      
    <form class="col s12" action="admin_view_orders.php" method="post">
    <div class="row">
      <div class="input-field col s8">
        <i class="material-icons prefix white-text" >account_circle</i>
        <input name="uid" type="text" class="validate" minlength="1" maxlength="3">
        <label for="uid" class="white-text">ID</label>
        <span class="helper-text white-text" data-error="Max 3 Characters" data-success="Max 3 Characters">Max 3 Characters</span>
      </div>
    </div>

    <input class="btn cyan btn-block; z-depth-5" type="submit" name="selectuser" value="Select ID">
    <div class="card-panel cyan darken-1; z-depth-5" style="font-size: 20px"></div>
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