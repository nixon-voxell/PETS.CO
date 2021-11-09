<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Edit Product</title>
<?php 
  include "header.php";
  // include "includes/admin/controller_admin.php";
  include "includes/utils/dbhandler.php";

  if (isset($_GET['itemid']))
  {
    $itemID = $_GET['itemid'];
    // $sql = "select ItemID, Name, Brand, Description, Category, SellingPrice, QuantityInStock, image from Items where ItemID=$itemID";
    $result = mysqli_query($conn, "select ItemID, Name, Brand, Description, Category, SellingPrice, QuantityInStock, image from Items where ItemID=$itemID") 
    or die ("SQL statement Failed !!");

    
    //$result=$conn->query($sql) or die("SQL Update Failed !");


    list($itemid, $name, $brand, $description, $category, $sellingprice, $quantityinstock, $image) = mysqli_fetch_array($result);
  }

    if (isset($_POST["update"]))
    {
      $image= $_POST['image'];
      $itemID = $_POST["itemid"];
      $name = $_POST['name'];
      $brand = $_POST["brand"];
      $description = $_POST["description"];
      $category = $_POST["category"];
      $sellingprice = $_POST["sellingprice"];
      $quantityinstock = $_POST["quantityinstock"];

      $sql = "update Items set Name='$name', Brand='$brand', Description='$description', Category=$category, SellingPrice='$sellingprice', QuantityInStock=$quantityinstock, Image='$image' where ItemID=$itemID;";
      $conn->query($sql) or die("SQL Update Failed !");
      header("location: admin_manage_products.php?message=UpdateProductSuccessful");
    }  
  ?>

<div class="rounded-card-parent container">
  <div class="card rounded-card">
    <span class="card-title orange-text bold" style="padding-left: 20px;">Edit Product</span>
    <form action="edit_products.php" method="POST" style="padding-left: 10px;">
    <div class="row">
      <input type="hidden" name="itemid" id="itemid" value="<?php echo $itemID;?>">
    </div>
      <div class="row">
        <div class="input-field col s8 white-text">
          <i class="material-icons prefix">inventory_2</i>
          <?php
          echo "<input class='white-text' name='name' type='text' value='$name'/>";
          ?>
          <label for="name" class="white-text">Product Name</label>
          <span class="helper-text white-text" data-error="wrong" data-success="correct"></span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8 white-text">
          <i class="material-icons prefix">branding_watermark</i>
          <?php
          echo "<input class='white-text' name='brand' type='text' value='$brand'/>";
          ?>
          <label for="brand" class="white-text">Brand</label>
          <span class="helper-text white-text" data-error="wrong" data-success="correct"></span>
        </div>
      </div>
      <div class="row">
          <div class="input-field col s8 white-text">
            <i class="material-icons prefix">description</i>
            <?php
            echo "<input class='white-text' name='description' type='text' value='$description'/>";
            ?>
            <label for="description" class="white-text"> Description</label>
            <span class="helper-text white-text" data-error="wrong" data-success="correct"></span>
          </div>
        </div>
      <div class="row">
        <div class="input-field col s8 white-text">
          <i class="material-icons prefix white-text">category</i>
            <?php
            echo "<input class='white-text' name='category' type='text' value='$category'/>";
            ?>
          <label for="category" class="white-text">Category</label>
          <span class="helper-text grey-text" data-error="wrong" data-success="correct">Category:1-Dog, 2-Food, 3-Accessories</span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8 white-text">
          <i class="material-icons prefix">attach_money</i>
          <?php
          echo "<input class='white-text' name='sellingprice' type='text' value='$sellingprice'/>";
          ?>
          <label for="sellingprice" class="white-text">Selling Price</label>
          <span class="helper-text white-text" data-error="wrong" data-success="correct"></span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8 white-text">
          <i class="material-icons prefix white-text">production_quantity_limits</i>
          <?php
          echo "<input class='white-text' name='quantityinstock' type='text' value='$quantityinstock'/>";
          ?>
          <label for="quantityinstock" class="white-text">Quantity In Stock</label>
          <span class="helper-text white-text" data-error="wrong" data-success="correct"></span>
        </div>
      </div>
      <div class="row">
        <div class="file-field col s8">
          <a class="waves-effect waves-light btn cyan">
            <i class="material-icons prefix">image</i>
            <input type="file">
          </a>
          <div class="file-path-wrapper">
            <?php
            echo "<input name='image' class='file-path validate white-text' type='text' value='$image'>"
            ?>
          </div>
        </div>
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
</html>

<?php include "footer.php"; ?>
