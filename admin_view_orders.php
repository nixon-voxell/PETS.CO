<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - View Orders Panel</title>
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
    <a href=""><i class="material-icons blue-text">view_agenda</i>View Customer Cart/Orders </a>
  </li>
</ul>

<!--SideNav Finished-->

<!-- manage users start -->
<div class="container">
  <h3 class="white-text"> View Customers Cart/Orders </h3>
  <div class="row">
    <div class="col s12 m10; z-depth-5">
      <div class="card #212121 grey darken-4">
        <div class="card-content white-text">
          <span class="card-title" style="color: orange; font-weight: bold; text-align: center">Customers List</span>
          <table class="centered; responsive-table">
            <thead class="text-primary">
              <tr><th>Username</th><th>Email</th><th>OrderID</th><th>OrderID</th><th>MemberID</th><th>CartFlag</th></tr>
            </thead>
            <tbody>
            <?php ShowCustomerList($conn); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <div class="row">
    <div class="col s12 m10; z-depth-5">
      <div class="card cyan">
        <div class="card-content black-text">
          <span class="card-title" style="text-align: center; color: white; font-weight: bold">Selected MemberID <?php if ($cartflag = 1) echo "Cart"; else echo "Previous Order";?> Details</span>
          <table class="centered; responsive-table">
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
            {?>
            <div class="row">
              <div class="col s8">
              <ul class="collapsible popout" id="cart">
                <li>
                  <div class="collapsible-header"><i class="material-icons">pets</i>First</div>
                  <div class="collapsible-body row" style="margin: 0px;">
                    <span class="col s6">Date Added: </span>
                    <span class="col s6">Category: Pet</span>
                  </div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">toys</i>Second</div>
                  <div class="collapsible-body row" style="margin: 0px;">
                    <span class="col s6">Date Added: </span>
                    <span class="col s6">Category: Accessory</span>
                  </div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">restaurant</i>Third</div>
                  <div class="collapsible-body row" style="margin: 0px;">
                    <span class="col s6">Date Added: </span>
                    <span class="col s6">Category: Food</span>
                  </div>
                </li>
              </ul>
              </div>
              <div class="col s4">
                <div class="card brown darken-3">
                  <div class="card-content white-text">
                    <span class="card-title" style="font-weight: bold;">Cart Details</span>
                    <p>Total Items: </p>
                    <p>Delivery Charges: </p>
                    <p>Sum Total: </p>
                  </div>
                </div>
              </div>
            </div>
          <?php } else if ($usrid == $uid && $cartFlag == "0")
          {?>
          <h5 class="text-blue-grey">#1</h5>
          <div class="row">
            <div class="col s8">
              <ul class="collapsible popout" id="orders">
                <li>
                  <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
                  <div class="collapsible-body"><span>Date Added: </span></div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
                  <div class="collapsible-body"><span>Date Added: </span></div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
                  <div class="collapsible-body"><span>Date Added: </span></div>
                </li>
              </ul>
            </div>

            <div class="col s4">
              <div class="card grey darken-3">
                <div class="card-content white-text">
                  <span class="card-title" style="font-weight: bold;">Order Details</span>
                  <p>Total Items: </p>
                  <p>Delivery Charges: </p>
                  <p>Sum Total: </p>
                  <p>Date: </p>
                </div>
              </div>
            </div>
          </div>
          <?php } else echo "ERROR!"; }?>
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row; z-depth-5">
  <div class="card-panel #00acc1 cyan darken-1; z-depth-5 white-text" style="font-size: 20px">Select MemberID to View Cart/Ordered Items</div>      
    <form class="col s12" action="admin_view_orders.php" method="post">
    <div class="row">
      <div class="input-field col s8">
        <i class="material-icons prefix">account_circle</i>
        <input name="uid" type="text" class="validate" minlength="1" maxlength="3">
        <label for="uid">ID</label>
        <span class="helper-text " style="color: azure" data-error="Max 3 Characters" data-success="correct">Max 3 Characters</span>
      </div>
    </div>
    <input class="btn cyan btn-block; z-depth-5" type="submit" name="selectuser" value="Select ID">
    <div class="card-panel cyan darken-1; z-depth-5" style="font-size: 20px">
    </div>   
    </form>
</div>

<script>
  $(document).ready(function () 
  {
    $(".sidenav").sidenav();
  });
</script>

<?php include "footer.php"; ?>