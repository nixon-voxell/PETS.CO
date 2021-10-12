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

<!-- Nav bar-->
<nav>
  <div class="nav wrapper">
    <a href="admin.php" class="brand-logo center">Admin Panel</a>
    <a href="" data-target="slide-out" class="sidenav-trigger show-on-large" style="margin-top: 15px" data-activates="slide-out"><i class="material-icons">menu</i></a>
  </div>
</nav>
<!-- Nav bar end-->

<?php include "side_nav.html"; ?>

<!-- manage users start -->
<div class="container">
  <h3 class="grey-text">Customers Cart/Orders </h3>
  <div class="row" style="padding-bottom: 10px;">
    <div class="col s12 m10; z-depth-5">
      <div class="card grey darken-4">
        <div class="card-content white-text">
          <span class="card-title" style="color: orange; font-weight: bold; text-align: center">Customers List</span>
          <table class="responsive-table">
            <thead class="text-white" style="border-bottom: 2px solid red;">
              <tr><th>Username</th><th>Email</th><th>OrderID</th><th>MemberID</th><th>CartFlag</th></tr>
            </thead>
            <tbody style="border-bottom: 2px solid white;">
            <?php 
              include_once "includes/utils/dbhandler.php";
              ShowCustomerList($conn); 
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col s12 m10; z-depth-5">
      <div class="card grey darken-4">
        <div class="card-content black-text">
          <span class="card-title center-align white-text" style="font-weight: bold">Selected MemberID <?php if ($cartflag = 1) echo "Cart"; else echo "Previous Order";?> Details</span>
          <table class="centered responsive-table">
          <tbody>
          <?php 
          // View Selected Customer Cart/Orders 
          if (isset($_POST["selectuser"]))
          {
            $uid = $_POST["uid"];

            if (EmptyInputSelectUser($uid) !== false)
              echo "Enter an ID to choose again!";

            SelectedIDOrders($conn, $uid);
          }
          
          function SelectedIDOrders($conn, $uid)
          {
            $sql = mysqli_query($conn, "SELECT memberid, cartflag from Orders WHERE memberid = '$uid' and cartflag = '1'")
            or die ("Select statement FAILED!");
            
            while (list($usrid, $cartFlag) = mysqli_fetch_array($sql))
            if ($usrid == $uid && $cartFlag == "1")
            {
              include "cart_items.php" ?>

          <?php } else if ($usrid == $uid && $cartFlag == "0")
          { include "cart_orders.php" ?>
          
          <?php } else echo "ERROR!"; }?>
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
        <i class="material-icons prefix">account_circle</i>
        <input name="uid" type="text" class="validate" minlength="1" maxlength="3">
        <label for="uid">ID</label>
        <span class="helper-text" data-error="Max 3 Characters" data-success="correct">Max 3 Characters</span>
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