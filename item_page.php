<!DOCTYPE html>
<html lang="en">

<?php 
include "header.php";
include "includes/utils/dbhandler.php";

if (isset($_GET['itemid']))
  {
    $itemID = $_GET['itemid'];
    // $sql = "select ItemID, Name, Brand, Description, Category, SellingPrice, QuantityInStock, image from Items where ItemID=$itemID";
    $result = mysqli_query($conn, "select ItemID, Name, Brand, Description, SellingPrice, QuantityInStock, image from Items where ItemID=$itemID") 
    or die ("SQL statement Failed !!");
    //$result=$conn->query($sql) or die("SQL Update Failed !");
    list($itemid, $name, $brand, $description, $sellingprice, $quantityinstock, $image) = mysqli_fetch_array($result);
  }
?>

<div class="container">
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <span class="card-title orange-text bold" style="padding-left: 0px;">Item Page</span>
      <form action="" method="POST" style="padding-left: 10px;">
      <div class="row">
        <div class="col">
          <br>
          <img src="https://petico.my/image/cache/catalog/PRODUCTS/ROYAL%20CANIN/DOG/Size%20Health/Adult/Maxi%20Adult/SHN%20Maxi%20Adult%20Hero%201-250x250.jpg" width="300" height="300">           
        </div>
        <br>
        <div class="col">
          <div class="row">
            <label for="productname" class="white-text">Royal Canin Dog Food</label>
          </div>
          <div class="row">
            <div class="ratings">
              <div class="empty-stars"></div>
              <div class="full-stars" style="width:90%"></div>
            </div>
          </div>
          <div class="row">
          <label for="stock" class="cyan-text bold">In Stock</label>
          <i class="material-icons prefix">done</i>
          </div>
          <div class="row">
          <label for="productprice" class="white-text">RM150</label>
          </div>
          <div class="row">
            <div class="d-flex flex-row flex-wrap">
              <label for="addQty" class="white-text">Quantity</label>
              <a class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">-</i></a>
              <input type="float" style="width:10%"></input>
              <a class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">add</i></a>
            </div>
          </div>
          <div class="row">
            <button class='btn green' name='addcart' value='$itemID' class='btn'>
              <a class='white-text' href='cart.php? itemid=$itemID & action=addcart'>
              Add to Cart</a>
            </button>
            <button class='btn green' name='purchase' value='$itemID' class='btn'>
              <a class='white-text' href='? itemid=$itemID & action=purchase'>
              Buy Now</a>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div> 
  
<?php include "footer.php";?>