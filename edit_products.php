<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Edit Product</title>
<?php 
  require_once "header.php";
  require_once "admin_nav_bar.php";
  require_once "side_nav.html";
  // include "includes/admin/controller_admin.php";
  include "includes/utils/dbhandler.php";

  if (isset($_GET['item_id']))
  {
    $itemID = $_GET['item_id'];
    $sql = "SELECT ItemID, Name, Brand, Description, Category, SellingPrice, QuantityInStock, Image
      FROM Items WHERE ItemID = $itemID";

    $result = $conn->query($sql) or die ($conn->error);

    list($item_id, $name, $brand, $description, $category, $sellingprice, $quantityinstock, $image)
      = $result->fetch_array();

    echo "<p style='visibility: hidden' id='category_id'>$category</p>";
  }

    if (isset($_POST["update"]))
    {
      $image = $_POST['image'];
      $itemID = $_POST["item_id"];
      $name = $_POST['name'];
      $brand = $_POST["brand"];
      $description = $_POST["description"];
      $category = $_POST["category"];
      $sellingprice = $_POST["sellingprice"];
      $quantityinstock = $_POST["quantityinstock"];

      $sql = "UPDATE Items SET Name='$name', Brand='$brand', Description='$description',
        Category=$category, SellingPrice='$sellingprice', QuantityInStock=$quantityinstock,
        Image='$image' WHERE ItemID=$itemID;";

      $conn->query($sql) or die($conn->error);
      header("location: admin_manage_products.php?update_product=successful");
    }
  ?>

<div class="rounded-card-parent container" style="margin-top: 50px;">
  <div class="card rounded-card">
    <span class="card-title orange-text bold" style="padding-left: 20px;">Edit Product</span>
    <form action="edit_products.php" method="POST" style="padding-left: 10px;">
      <div class="row">
        <input type="hidden" name="item_id" id="item_id" value="<?php echo $itemID;?>">
      </div>
      <div class="row">
        <div class="col s6" style="padding-right: 40px;">
          <div class="row">
            <div class="input-field white-text">
              <i class="material-icons prefix">inventory_2</i>
              <input name="name" type="text" class="validate white-text" maxlength="30"
                value="<?php echo $name;?>">
              <label for="name" class="white-text">Product Name</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field white-text">
              <i class="material-icons prefix">branding_watermark</i>
              <input name="brand" type="text" class="validate white-text" maxlength="20"
                value="<?php echo $brand;?>">
              <label for="brand" class="white-text">Brand</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field white-text">
              <i class="material-icons prefix">description</i>
              <input name="description" type="text" class="validate white-text" minlength="5" maxlength="30"
                value="<?php echo $description;?>">
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
              <input name="sellingprice" type="number" step=".01" class="validate white-text" maxlength="30"
                value="<?php echo $sellingprice;?>">
              <label for="sellingprice" class="white-text">Selling Price</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field white-text">
              <i class="material-icons prefix white-text">production_quantity_limits</i>
              <input name="quantityinstock" type="number" class="validate white-text" maxlength="30"
                value="<?php echo $quantityinstock;?>">
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
            <input name="image" class="file-path validate white-text" type="text" onchange="update_image(this)"
              value="<?php echo $image;?>">
          </div>
        </div>
        <img class="shadow-img" id="image" src="images/<?php echo $image;?>" style="width: 300px;">
      </div>
      <button type="submit" id="update" name="update" class="btn">Update Product</button>
    </form>
  </div>
</div>

<div class="errormsg">
  <?php
    if (isset($_GET["error"]))
    {
      if ($_GET["error"] == "emptyinput")
        echo "<p>*Fill in all fields!<p>";

      else if ($_GET["error"] == "prdexist")
        echo "<p>*Product already exist!</p>";

      else if ($_GET["error"] == "none")
      {
        echo "<p>Product Has Been Edited</p>";
        header( "url=manage_user_products.php" );
        exit();
      }
    }
  ?>
</div>

<script>
  $(document).ready(function () 
  {
    $(".sidenav").sidenav();

    var categoryId = parseInt(document.getElementById("category_id").textContent);
    categoryId += 1;
    var select = document.querySelector('select');
    select.querySelectorAll('option')[categoryId].selected = true;

    $('select').formSelect();
  });
  
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });

  function update_image(path)
  {
    var image = document.getElementById("image");
    image.src = `images/${path.value}`;
  }
</script>

<?php include "footer.php"; ?>
