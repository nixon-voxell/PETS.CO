<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Manage Products Panel</title>
</head>
<?php 
  require_once "header.php"; 
  require_once "admin_nav_bar.php";
  require_once "side_nav.html";
  include "includes/admin.inc.php";
  include "includes/utils/dbhandler.php";
?>

<div class="container">
  <h3 class="page-title">Manage Products</h3>

  <!-- users list start -->
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <div class="card-content black-text">
        <span class="card-title orange-text bold">Products List</span>

        <!-- search product input field start -->
        <form action="admin_manage_products.php" method="POST">
          <div class="row" style="margin: 0px;">
          <div class="input-field col s3" style = "color:azure">
              <input name="search_product" type="text" class="validate white-text" maxlength="20">
              <label for="search_product">Search product by brand</label>
              <div class="errormsg">
                <?php
                  if (isset($_GET["error"]))
                  {
                    if ($_GET["error"] == "empty_search")
                    echo "<p>Empty Input!</p>";
                  }
                  ?>
              </div>
            </div>
          </div>
        </form>
        <!-- search product input field end -->

        <!-- search product result list start -->
        <form action="admin_manage_products.php" method="GET">
          <table class="responsive-table">
            <thead class="text-primary">
              <tr><th>Name</th><th>Brand</th><th></th></tr>
            </thead>
            <tbody>
              <?php
                if (isset($_POST["search_product"]))
                {
                  require_once "includes/data/item.data.php";
                  $searchProduct = $_POST["search_product"];

                  if (EmptyInputSelectProduct($searchProduct))
                    echo "<p class='prompt-warning'>Please enter a value</p>";
                  else
                  {
                    $sql = "SELECT ItemID, Name, Brand FROM Items WHERE Brand LIKE '%$searchProduct%' ORDER BY Brand";
                    $result = $conn->query($sql) or die ("Product does not exists!");
                    while ($row = mysqli_fetch_assoc($result) ) 
                    {
                      $itemID = $row["ItemID"]; 
                      $brand = $row["Brand"];
                      $name = $row["Name"];
                      echo(
                        "<tr>
                          <td class='white-text'>$brand</td>
                          <td class='white-text'>$name</td>
                          <td>
                            <button name='inspect_product' value='$itemID' class='btn'>
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
                  $sql = "SELECT ItemID, Name, Brand FROM Items ORDER BY Brand LIMIT 20";
                  $result = $conn->query($sql) or die ($conn->error);
                  while ($row = mysqli_fetch_assoc($result)) 
                  {
                    $itemID = $row["ItemID"]; 
                    $brand = $row["Brand"];
                    $name = $row["Name"];
                    echo(
                      "<tr>
                        <td class='white-text'>$brand</td>
                        <td class='white-text'>$name</td>
                        <td>
                          <button name='inspect_product' value='$itemID' class='btn'>
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
  <?php if (isset($_GET["inspect_product"])) { ?>
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <div class="card-content white-text">
        <span class="card-title orange-text bold">Selected Product Details</span>
        <table class="responsive-table">
          <form action="admin_manage_products.php" method="GET">
            <thead class="text-primary">
            <tr><th>Image</th><th>Name</th><th>Brand</th>
            <th>Description</th><th>Category</th><th>Selling Price</th><th>Qty In Stock</th></tr>
            </thead>
            <tbody>
              <?php
                // inspect product
                $itemID = $_GET["inspect_product"];
                $sql = "SELECT * FROM Items where ItemID = $itemID ORDER BY Brand";
                $result = $conn->query($sql) or die("<p> * ItemID error, please try again!</p>");
                while ($row = mysqli_fetch_assoc($result))    
                {
                  $itemID = $row["ItemID"];
                  $image = $row['Image'];
                  $deleteid = $row["ItemID"];
                  $editid = $row["ItemID"];
                  $name = $row['Name'];
                  $brand = $row["Brand"];
                  $description = $row["Description"];
                  $category = $row["Category"];
                  $category = Item::CATEGORY_ICON[(int)$category];
                  $sellingprice = $row["SellingPrice"];
                  $sellingprice = "$ ". number_format($sellingprice, 2);
                  $quantityinstock = $row["QuantityInStock"];

                  echo(
                    "<tr>
                      <td><img src='images/$image' style='height:100px;'></td>
                      <td>$name</td>
                      <td>$brand</td>
                      <td>$description</td>
                      <td><i class='material-icons prefix'>$category</i></td>
                      <td>$sellingprice</td>
                      <td>$quantityinstock</td>
                      <td><a>
                        <button class='btn yellow darken-4' name='edit' value='$itemID' class='btn'>
                          <a class='white-text' href='edit_products.php?item_id=$itemID'>
                          Edit</a>
                        </button>
                        <button class='btn red darken-4' name='delete_product' value='$itemID'
                        onclick=\"return confirm('Are you sure you want to delete record: \'$name, $brand\'?');\">Delete</button>
                      </a></td>
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
  <?php }
    // delete product
    if (isset($_GET["delete_product"]))
    {
      $id = $_GET["delete_product"];
      $sql =  "DELETE FROM Items WHERE ItemID = $id";
      $conn->query($sql) or die ("<p class='red-text'>*Delete statement FAILED!</p>");
    }
  ?>
  <!-- selected member details end -->

  <!-- create product start -->
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <div class="card-content">
        <span class="card-title orange-text bold">Create Product</span>
        <form action="admin_manage_products.php" method="POST">
          <div class="row">
            <div class="col s6" style="padding-right: 40px;">
              <div class="row">
                <div class="input-field white-text">
                  <i class="material-icons prefix">inventory_2</i>
                  <input name="name" type="text" class="validate white-text" maxlength="30">
                  <label for="name" class="white-text">Product Name</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field white-text">
                  <i class="material-icons prefix">branding_watermark</i>
                  <input name="brand" type="text" class="validate white-text" maxlength="20">
                  <label for="brand" class="white-text">Brand</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field white-text">
                  <i class="material-icons prefix">description</i>
                  <input name="description" type="text" class="validate white-text" minlength="5" maxlength="30">
                  <label for="description" class="white-text">Description</label>
                </div>
              </div>
            </div>
            <div class="col s6" style="padding-right: 40px;">
              <div class="row">
                <div class="input-field white-text">
                  <i class="material-icons prefix white-text">category</i>
                  <select name="category">
                    <option value="" disabled selected>Choose your option</option>
                    <option value=0>Dog</option>
                    <option value=1>Food</option>
                    <option value=2>Accessory</option>
                  </select>
                  <label class="white-text">Category</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field white-text">
                  <i class="material-icons prefix">attach_money</i>
                  <input name="sellingprice" type="number" step=".01" class="validate white-text" maxlength="30">
                  <label for="sellingprice" class="white-text">Selling Price</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field white-text">
                  <i class="material-icons prefix white-text">production_quantity_limits</i>
                  <input name="quantityinstock" type="number" class="validate white-text" maxlength="30">
                  <label for="quantityinstock" class="white-text">Quantity In Stock</label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="file-field col s8">
              <a class="waves-effect waves-light btn cyan">
                <i class="material-icons prefix">image</i>
                <input type="file">
              </a>
              <div class="file-path-wrapper">
                <input name="image" class="file-path validate white-text" type="text" onchange="update_image(this)">
              </div>
            </div>
            <img id="image" src="" style="width: 300px;">
          </div>

          <div class="errormsg">
            <?php
              if (isset($_GET["create_product"]))
              {
                if ($_GET["create_product"] == "empty_input")
                  echo "<p>*Fill in all fields!<p>";

                else if ($_GET["create_product"] == "successful")
                  echo "<p class='green-text'>Added Product.</p>";
              }
            ?>
          </div>
          <input class="btn orange btn-block z-depth-5" type="submit" name="submit_product" value="Create Product">
        </form>
      </div>
    </div> 
  </div>
  <!-- create product end -->
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });

  $(document).ready(function(){
    $('select').formSelect();
  });

  function update_image(path)
  {
    var image = document.getElementById("image");
    image.src = `images/${path.value}`;
  }
</script>

<?php include "footer.php"; ?>