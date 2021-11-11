<!DOCTYPE html>
<html lang="en">

<?php 
include "header.php";
include "includes/utils/dbhandler.php";
require_once "includes/search_catalogue.inc.php";

if (isset($_GET['item_id']))
  {
    $itemID = $_GET['item_id'];
    // $sql = "select ItemID, Name, Brand, Description, Category, SellingPrice, QuantityInStock, image from Items where ItemID=$itemID";
    $result = mysqli_query($conn, "select ItemID, Name, Brand, Description, SellingPrice, QuantityInStock, image from Items where ItemID=$itemID") 
    or die ("SQL statement Failed !!");
    //$result=$conn->query($sql) or die("SQL Update Failed !");
    list($itemID, $name, $brand, $description, $sellingprice, $quantityinstock, $image) = mysqli_fetch_array($result);
  }
?>

<div class="container">
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <span class="card-title orange-text bold" style="padding-left: 0px;">Item Page</span>
      <form action="" method="POST" style="padding-left: 10px;">
        <?php
          echo("
            <div class='row'>
              <div class='col'>   
                <br>
                <img class='shadow-img' src='images/$image' style='max-height: 300px; max-width: 300px;'>
              </div>
              <br>
              <div class='col'>
                <div class='row'>
                  <tr><th>Product Name: </th>
                  <label for='productname' class='white-text'>$name</label>
                </div>
                <div class='row'>
                  <tr><th>Brand: </th>
                  <label for='brand' class='white-text'>$brand</label>
                </div>
                <div class='row'>
                  <tr><th>Description: </th>
                  <label for='description' class='white-text'>$description</label>
                </div>
                <div class='row'>
                  <div class='ratings'>
                    <div class='empty-stars'></div>
                    <div class='full-stars' style='width:90%'></div>
                  </div>
                </div>
                <div class='row'>
                  <tr><th>Quantity In Stock: </th>
                  <label for='qtyinstock' class='cyan-text bold'>$quantityinstock</label>
                  <i class='material-icons prefix'>done</i>
                </div>
                <div class='row'>
                  <tr><th>Price: </th>
                  <label for='productprice' class='white-text'>$sellingprice</label>
                </div>
                <div class='row'>
                  <div class='d-flex flex-row flex-wrap'>
                    <label for='addQty' class='white-text'>Quantity</label>
                    <a class='btn-floating btn-small waves-effect waves-light red'><i class='material-icons'>remove</i></a>
                    <input type='float' style='width:10%'></input>
                    <a class='btn-floating btn-small waves-effect waves-light green'><i class='material-icons'>add</i></a>
                  </div>
                </div>
                <div class='row'>
                  <button class='btn green' name='addcart' value='$itemID' class='btn'>
                    <a class='white-text' href='cart.php? itemid=$itemID & action=addcart'>
                    Add to Cart</a>
                  </button>
                </div>
              </div>
            </div>
          ");
        ?>
      </div>
    </div>
  </div> 
</div>

<?php include "footer.php";?>