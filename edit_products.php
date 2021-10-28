<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Edit Product</title>
<?php 
  include "header.php";
  include "includes/admin/controller_admin.php";
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

      $sql = "update Items set Name='$name', Brand='$brand', Description='$description', Category=$category, SellingPrice='$sellingprice', QuantityInStock=$quantityinstock, Image='$image' where ItemID=$itemid;";
      $conn->query($sql) or die("SQL Update Failed !");
      header("location: admin_manage_products2.php?message=UpdateProductSuccessful");
      mtsqli_close($conn);
    }  
  ?>

<div class="rounded-card-parent">
  <div class="card rounded-card">
    <span class="card-title orange-text bold" style="padding-left: 20px;">Edit Product</span>
    <form action="edit_products.php" method="POST" style="padding-left: 10px;">
    <div class="row">
      <input type="hidden" name="itemid" id="itemid" value="<?php echo $itemID;?>">
    </div>
      <div class="row">
        <div class="input-field col s8 white-text">
          <i class="material-icons prefix">account_circle</i>
          <input name="name" type="text" class="validate white-text" minlength="2" maxlength="30">
          <?php
          echo "<input class='white-text' name='name' type='text' value='$name'/>";
          ?>
          <label for="name" class="white-text"> Product Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8 white-text">
          <i class="material-icons prefix">account_circle</i>
          <input name="brand" type="text" class="validate white-text" minlength="6" maxlength="20">
          <?php
          echo "<input class='white-text' name='brand' type='text' value='$brand'/>";
          ?>
          <label for="brand" class="white-text"> Brand</label>
        </div>
      </div>
      <div class="row">
          <div class="input-field col s8 white-text">
            <i class="material-icons prefix">account_circle</i>
            <input name="description" type="text" class="validate white-text" minlength="5" maxlength="30">
            <?php
            echo "<input class='white-text' name='description' type='text' value='$description'/>";
            ?>
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
          <?php
          echo "<input class='white-text' name='sellingprice' type='text' value='$sellingprice'/>";
          ?>
          <label for="sellingprice">Selling Price</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8 white-text">
          <i class="material-icons prefix white-text">account_circle</i>
          <input name="quantityinstock" type="text" class="validate white-text" maxlength="30">
          <?php
          echo "<input class='white-text' name='quantityinstock' type='text' value='$quantityinstock'/>";
          ?>
          <label for="quantityinstock">Quantity In Stock</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8 white-text">
          <i class="material-icons prefix">account_circle</i>
          <input name="image" type="text" class="validate white-text">
          <label for="image" class="white-text">Product Image</label>
          <span class="helper-text white-text" data-error="wrong_file_type"></span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8" style = "color:black">
          <?php 
          echo "<img src='images/$image' style='width:100px; height:100px;'>"
          ?>
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
