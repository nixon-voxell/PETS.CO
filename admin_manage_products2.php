<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Manage Products Panel</title>
</head>
<?php 
  include "header.php"; 
  include "includes/admin.inc.php";
  include "includes/utils/dbhandler.php";
  include "admin_nav_bar.php";
  include "side_nav.html";
?>

<div class="container">
  <h3 class="page-title">Manage Products</h3>

  <!-- users list start -->
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <div class="card-content black-text">
        <span class="card-title orange-text bold">Products List</span>

        <!-- search product input field start -->
        <form action="admin_manage_products2.php" method="POST">
          <div class="row" style="margin: 0px;">
          <div class="input-field col s3" style = "color:azure">
              <input name="search_product" type="text" class="validate white-text" maxlength="20">
              <label for="search_product">Search product by brand</label>
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
        <!-- search product input field end -->

        <!-- search product result list start -->
        <form action="admin_manage_products2.php" method="GET">
          <table class="responsive-table">
            <thead class="text-primary">
              <tr><th>Product Brand</th><th></th></tr>
            </thead>
            <tbody>
              <?php
                if (isset($_POST["search_product"]))
                {
                  $searchProduct = $_POST["search_product"];

                  if (EmptyInputSelectProduct($searchProduct))
                    echo "<p class='prompt-warning'>Please enter a value</p>";
                  else
                  {
                    $sql = "SELECT Image, Name, Brand FROM Items WHERE Brand LIKE '%$searchProduct%' ORDER BY Brand";
                    $result = $conn->query($sql) or die ("Product does not exists!");
                    while ($row = mysqli_fetch_assoc($result) ) 
                    { 
                      $brand = $row["Brand"]; 
                      echo(
                        "<tr>
                          <td>$brand</td>
                          <td>
                            <button name='inspect_product' value='$brand' class='btn'>
                              <i class='material-icons'>search</i>
                            </button>
                          </td>
                        </tr>"
                      );
                    }
                  }
                }

                if (!isset($searchProduct) || EmptyInputSelectProduct($searchProduct))
                {
                  // limited search to prevent page overflow
                  $sql = "SELECT ItemID, Image, Name, Brand FROM Items ORDER BY Brand LIMIT 20";
                  $result = $conn->query($sql) or die ($conn->error);
                  while ($row = mysqli_fetch_assoc($result)) 
                  { 
                    $brand = $row["Brand"];
                    $iid = $row["ItemID"]; 
                    echo(
                      "<tr>
                        <td>$brand</td>
                        <td class='left-align'>
                          <button name='inspect_product' value='$iid' class='btn'>
                            <i class='material-icons'>search</i>
                          </button>
                        </td> 
                      </tr>"
                    );
                  }
                  unset($_POST["search_product"]);
                }
                ?>
            </tbody>
          </table>
        </form>
        <!-- search product result list end -->
      </div>
    </div>
  </div>
  <!-- productss list end -->

  <!-- selected product details start -->
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <div class="card-content white-text">
        <span class="card-title orange-text bold">Selected Product Details</span>
        <table class="responsive-table">
          <form action="admin_manage_products2.php" method="GET">
            <thead class="text-primary">
            <tr><th>ItemID</th><th>Product Image</th><th>Name</th><th>Brand</th>
            <th>Description</th><th>Category</th><th>Selling Price</th><th>Qty In Stock</th></tr>
            </thead>
            <tbody>
              <?php
                // inspect product
                if (isset($_GET["inspect_product"]))
                {
                  $iid = $_GET["inspect_product"];
                  $sql = "SELECT * FROM Items where ItemID = $iid ORDER BY Brand";
                  $result = $conn->query($sql) or die("<p> * ItemID error, please try again!</p>");
                  while ($row = mysqli_fetch_assoc($result))    
                  {
                    $image=$row['Image'];
                    $itemID = $row["ItemID"];
                    $deleteid = $row["ItemID"];
                    $editid = $row["ItemID"];
                    $name = $row['Name'];
                    $brand = $row["Brand"];
                    $description = $row["Description"];
                    $category = $row["Category"];
                    $sellingprice = $row["SellingPrice"];
                    $quantityinstock = $row["QuantityInStock"];

                    echo
                      "<tr> 
                        <td>$itemID</td>
                        <td>$image</td>
                        <td>$name</td>
                        <td>$brand</td>
                        <td>$description</td>
                        <td>$category</td>
                        <td>$sellingprice</td>
                        <td>$quantityinstock</td>
                        <td><a> 
                          <button class='btn red darken-4' name='edit' value='$itemID' class='btn'>
                          <a href='edit_products.php? itemid=$itemID & action=edit'>Edit</a></button>
                          <br><br>
                          <button class='btn red darken-4' name='delete_product' value='$itemID'
                          onclick=\"return confirm('Are you sure you want to delete record: \'$name, $brand\'?');\">Delete</button>
                        </a></td>
                      </tr>";
                  }
                }

                // delete product
                if (isset($_GET["delete_product"]))
                {
                  $id = $_GET["delete_product"];
                  $sql =  "DELETE FROM Items WHERE ItemID = $id";
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
      <div class="card-content">
        <span class="card-title orange-text bold">Create Product</span>
        <form action="admin_manage_products2.php" method="POST">
          <div class="row">
            <div class="input-field col s8 white-text">
              <i class="material-icons prefix">account_circle</i>
              <input name="name" type="text" class="validate white-text" minlength="2" maxlength="30">
              <label for="name" class="white-text"> Product Name</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s8 white-text">
              <i class="material-icons prefix">account_circle</i>
              <input name="brand" type="text" class="validate white-text" minlength="6" maxlength="20">
              <label for="brand" class="white-text"> Brand</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s8 white-text">
              <i class="material-icons prefix">account_circle</i>
              <input name="description" type="text" class="validate white-text" minlength="5" maxlength="30">
              <label for="description" class="white-text"> Description</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s8 white-text">
              <i class="material-icons prefix white-text">account_circle</i>
              <select name="category">
                <option value="" disabled selected>Choose your option</option>
                <option value=1>Dog</option>
                <option value=2>Food</option>
                <option value=3>Accessory</option>
              </select>
              <label class="white-text">Category</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s8 white-text">
              <i class="material-icons prefix">account_circle</i>
              <input name="sellingprice" type="text" class="validate white-text" maxlength="30">
              <label for="sellingprice" class="white-text">Selling Price</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s8 white-text">
              <i class="material-icons prefix white-text">account_circle</i>
              <input name="quantityinstock" type="text" class="validate white-text" maxlength="30">
              <label for="quantityinstock" class="white-text">Quantity In Stock</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s8 white-text">
              <i class="material-icons prefix">account_circle</i>
              <input name="image" type="text" class="validate white-text">
              <label for="image" class="white-text">Product Image</label>
              <span class="helper-text white-text" data-error="wrong_file_type"></span>
              <div class="errormsg">
                <?php
                  if (isset($_GET["error"]))
                  {
                    if ($_GET["error"] == "EmptyInput")
                      echo "<p>*Fill in all fields!<p>";

                    else if ($_GET["error"] == "None")
                      echo "<p class='green-text'>Added Product.</p>";
                  }
                ?>
              </div>
            </div>
          </div>
          <input class="btn orange btn-block z-depth-5" type="submit" name="submit_product" value="Create Product">
        </form>
      </div>
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