<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Edit Product</title>
<?php 
  include "header.php";
  include "includes/admin/controller_admin.php";

  if (isset($_GET['itemid']))
  {
    $itemid = $_GET['itemid'];
    $result = mysqli_query($conn, "select ItemID, Name, Brand, Description, Category, SellingPrice, QuantityInStock, image from items where ItemID=$itemid") or die ("SQL statement Failed !!");
    list($itemid, $name, $brand, $description, $category, $sellingprice, $quantityinstock, $image) = mysqli_fetch_array($result);
  }
 
    if (isset($_POST["update"]))
    {
      $itemid = $_POST["itemid"];
      $name = $_POST["name"];
      $brand = $_POST["brand"];
      $description = $_POST["description"];
      $category = $_POST["category"];
      $sellingprice = $_POST["sellingprice"];
      $quantityinstock = $_POST["quantityinstock"];
      $image = $_POST["image"];

$sql="update items set Name='$name', Brand='$brand', Description='$description', Category=$category, SellingPrice='$sellingprice', QuantityInStock=$quantityinstock, image='$image' where ItemID=$itemid;";
mysqli_query($conn,$sql) or die("SQL Update Failed !");
      header("location: admin_manage_products.php?message=UpdateProductSuccessful");
      mtsqli_close($conn);
    }  
?>

<div class="container">
<h3 class="grey-text">Edit Product</h3>
<form class="col s12" action="edit_products.php" method="post">
<div class="row">
  <input type="hidden" name="itemid" id="itemid" value="<?php echo $itemid;?>">
</div>
<div class="row">
  <div class="input-field col s8" style = "color:black">
    <i class="material-icons prefix">assignment_ind</i>
      <input name="name" type="text" class="validate" value="<?php echo $name;?>">
        <span class="helper-text" data-error="wrong" data-success="correct" style = "color:black"></span>
      <label for="name">Product Name</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s8" style = "color:black">
      <i class="material-icons prefix">assignment_ind</i>
      <input name="brand" type="text" class="validate" value="<?php echo $brand;?>">
      <span class="helper-text" data-error="wrong" data-success="correct" style = "color:black"></span>
      <label for="brand">Brand</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s8" style = "color:black">
      <i class="material-icons prefix">assignment_ind</i>
      <input name="description" type="text" class="validate" value="<?php echo $description;?>">
      <span class="helper-text" data-error="wrong" data-success="correct" style = "color:black"></span>
      <label for="description">Description</label>
    </div>
  </div>
    <div class="row">
      <div class="input-field col s8" style = "color:black">
        <i class="material-icons prefix">assignment_ind</i>
        <input name="category" type="text" class="validate" value="<?php echo $category;?>">
        <span class="helper-text" data-error="wrong" data-success="correct" style = "color:black"></span>
        <label for="category">Category</label>
      </div>
    </div>
      <div class="row">
        <div class="input-field col s8" style = "color:black">
          <i class="material-icons prefix">assignment_ind</i>
          <input name="sellingprice" type="text" class="validate" value="<?php echo $sellingprice;?>">
          <span class="helper-text" data-error="wrong" data-success="correct" style = "color:black"></span>
          <label for="sellingprice">Selling Price</label>
      </div>
    </div>
      <div class="row">
        <div class="input-field col s8" style = "color:black">
          <i class="material-icons prefix">assignment_ind</i>
          <input name="quantityinstock" type="text" class="validate" value="<?php echo $quantityinstock;?>">
          <span class="helper-text" data-error="wrong" data-success="correct" style = "color:black"></span>
          <label for="quantityinstock">Quantity In Stock</label>
      </div>
    </div>
      <div class="row">
        <div class="input-field col s8" style = "color:black">
        <i class="material-icons prefix">assignment_ind</i>
        <input name="image" type="text" class="validate" value="<?php echo $image;?>">
        <span class="helper-text" data-error="wrong" data-success="correct" style = "color:black"></span>
        <label for="image">Product Image</label>
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
