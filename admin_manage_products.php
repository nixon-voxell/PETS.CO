<?php 
include "header.php"; 
include "includes/admin/controller_admin.php";
$username = $_SESSION["Username"];
$email = $_SESSION["Email"]; 
// $itemid = $_SESSION["ItemID"];
?>

<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Manage Products Panel</title>
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
        <img src="admin_image.jpg" style="width: 300px; height: 220px;">
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

<!-- manage products start -->
<div class="container">
<h3 class="white-text"> Manage Products </h3>
  <div class="row">
  <div class="col s12 m10; z-depth-5">
      <div class="card grey">
        <div class="card-content white-text">
        <span class="card-title" style="color: orange; font-weight: bold; text-align: center">Products List</span>
          <table class="centered; responsive-table">
            <thead class="text-primary">
              <tr><th>Product Image</th><th>ItemID</th><th>Name</th><th>Brand</th><th>Description</th><th>Category</th><th>Selling Price</th><th>Qty In Stock</th><th>Edit / Delete</th></tr>
              
            </thead>
            <tbody>
            <?php
              $sql = "select ItemID, Name, Brand, Description, Category, SellingPrice, QuantityInStock, image from items order by name,brand";
              $result = mysqli_query($conn,$sql)or die ("Select statement FAILED!");
              while (list($itemid,$name,$brand,$description,$category,$sellingprice,$quantityinstock,$image)=mysqli_fetch_array($result))
              {
              echo "<tr>
              <td><img src='images/$image' style='width:50px; height:50px;'></td>
              <td>$itemid</td>
              <td>$name</td>
              <td>$brand</td>
              <td>$description</td>
              <td>$category</td>
              <td>$sellingprice</td>
              <td>$quantityinstock</td>
              <td>
                <a href='edit_products.php?itemid=$itemid&action=edit'>Edit</a><br>
                <a href='admin_manage_products.php?itemid=$itemid&action=delete'>Delete</a>
              </td>
              </tr>";
              }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="card-panel orange lighten-2; white-text" style="font-size: 20px">Create Products</div>      
    <form class="col s12" action="admin_manage_products.php" method="post">
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix">account_circle</i>
        <input name="name" type="text" class="validate" maxlength="30">
        <span class="helper-text" data-error="wrong" data-success="correct" style = "color:azure"></span>
        <label for="name">Name</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix">account_circle</i>
        <input name="brand" type="text" class="validate" maxlength="30">
        <span class="helper-text" data-error="wrong" data-success="correct" style = "color:azure"></span>
        <label for="brand">Brand</label>
      </div>
    </div>
    <div class="row">
    <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix"> password</i>
        <input name="description" type="text" class="validate" maxlength="30">
        <span class="helper-text" data-error="wrong" data-success="correct" style = "color:azure"></span>
        <label for="description">Description</label>
      </div>
      <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix">account_circle</i>
        <input name="category" type="text" class="validate" maxlength="30">
        <span class="helper-text" data-error="wrong" data-success="correct" style = "color:azure"></span>
        <label for="category">Category</label>
      </div>
    </div>
    </div>
    <div class="row">
    <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix"> password</i>
        <input name="sellingprice" type="text" class="validate" maxlength="30">
        <span class="helper-text" data-error="wrong" data-success="correct" style = "color:azure"></span>
        <label for="sellingprice">Selling Price</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix"> password</i>
        <input name="quantityinstock" type="text" class="validate" maxlength="30">
        <span class="helper-text" data-error="wrong" data-success="correct" style = "color:azure"></span>
        <label for="quantityinstock">Quantity In Stock</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s8" style = "color:azure">
        <i class="material-icons prefix">assignment_ind</i>
        <input name="image" type="text" class="validate">
        <span class="helper-text" data-error="wrong" data-success="correct" style = "color:azure"></span>
        <label for="image">Product Image</label>
      </div>
    </div>
    <input class="btn orange btn-block; z-depth-5" type="submit" name="submitproduct" value="Create Product">
        <?php
          if (isset($_GET["error"]))
          {
            if ($_GET["error"] == "emptyinput")
              echo "<p>*Fill in all fields!<p>";
          }
        ?>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<script>
  $(document).ready(function () 
  {
    $(".sidenav").sidenav();
  });
</script>

<?php include "footer.php"; ?>