<!DOCTYPE html>
<html lang="en">

<?php 
  include "header.php";
  require_once "includes/utils/dbhandler.php";
  require_once "includes/search_catalogue.inc.php";
  require_once "includes/data/item.data.php";

  if (isset($_GET["item_id"]))
  {
    $itemID = $_GET["item_id"];
    $item = new Item($itemID, $conn);

    $image = $item->GetImage();
    $name = $item->GetName();
    $brand = $item->GetBrand();
    $description = $item->GetDescription();
    $quantityInStock = $item->GetQuantityInStock();
    $price = $item->GetSellingPrice();
    $displayPrice = "$" . number_format($price, 2);
    $category = $item->GetCategory();
    $category = Item::CATEGORY_ICON[(int)$category];

    $hasReviews = $item->HasReviews();
    $avgRatings = $item->GetAvgRatings();

    // ammount of item to be added to the cart
    $cartQty = 0;
    if (isset($_GET["qty"])) $cartQty = $_GET["qty"];
    if ($cartQty > 0)
    {
      // we can only add to cart if the quantity in stock is larger than the request quantity
      if ($quantityInStock >= $cartQty)
      {
        $item->SetQuantityInStock($quantityInStock - $cartQty);
        $item->SetData($conn);

        $orderID = $cart->GetOrderID();
        // check if order has been added before
        $sql = "SELECT OrderItemID, Quantity FROM OrderItems WHERE OrderID = $orderID AND ItemID = $itemID";
        $result = $conn->query($sql) or die($conn->error);
        $row = $result->fetch_assoc();
        $orderItemID = $row["OrderItemID"];

        if ($orderItemID == NULL)
        {
          // add as new order
          $sql = "INSERT INTO OrderItems(OrderID, ItemID, Price, Quantity, AddedDatetime)
            VALUES ($orderID, $itemID, $price, $cartQty, CURRENT_TIME)";
          $conn->query($sql) or die($conn->error);
        } else
        {
          $cartQty += $row["Quantity"];
          $sql = "UPDATE OrderItems SET Quantity = $cartQty";
          $conn->query($sql) or die($conn->error);
        }

        header("location: http://localhost/PETS.co/item_page.php?item_id=$itemID");
        exit();
      }
    }
  } else die("<h5 class='container white-text page-title' style='margin-top: 50px'>No item selected...</h5>");
?>

<input type="hidden" id="max-quantity" value=<?php echo($quantityInStock) ?>>
<div class="container" style="margin-top: 50px;">
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <a class="btn red darken-2" href="search_catalogue.php?search_name=">< BACK TO SEARCH</a>
      <h4 class="orange-text bold"><?php echo($name); ?></h4>
      <form action="item_page.php" method="GET" style="padding-left: 10px;">
        <input type="hidden" name="item_id" value=<?php echo($itemID) ?>>
        <div class="row" style="padding-top: 20px;">
          <div class="col s4">   
            <img class="shadow-img" src="images/<?php echo($image); ?>"
              style="max-height: 300px; max-width: 300px;">
          </div>
          <div class="col s6">
            <div class="row">
              <table>
                <tbody>
                  <tr><th>Name: </th><td><?php echo($name); ?></td></tr>
                  <tr><th>Brand: </th><td><?php echo($brand); ?></td></tr>
                  <tr><th>Description: </th><td><?php echo($description); ?></td></tr>
                  <tr>
                    <th>Rating: </th>
                    <td>
                      <?php
                        if ($hasReviews)
                        {
                          echo(
                            "<div class='ratings'>
                              <div class='empty-stars'></div>
                              <div class='full-stars' style='width: $avgRatings%'></div>
                            </div>"
                          );
                        } else echo("-")
                      ?>
                    </td>
                  </tr>
                  <tr><th>Quantity In Stock: </th><td><?php echo($quantityInStock); ?></td></tr>
                  <tr><th>Price: </th><td><?php echo($displayPrice); ?></td></tr>
                  <tr><th>Category: </th><td><i class='material-icons prefix'><?php echo($category); ?></i></td></tr>
                </tbody>
              </table>
            </div>

            <h6 class="bold cyan-text">Quantity</h6>
            <div class="row input-field" style="padding-left: 10px;">
              <button type="button" class="btn-floating btn-small waves-effect waves-light red"
                onclick="subtractQty()">
                <i class="material-icons">remove</i>
              </button>

              <input id="qty" class="white-text" type="number" disabled
                style="padding: 10px; width: 10%;" value=0></input>
              <input id="sync-qty" name="qty" class="white-text" type="hidden" value=0></input>

              <button type="button" class="btn-floating btn-small waves-effect waves-light green"
                onclick="addQty()">
                <i class="material-icons">add</i>
              </button>
            </div>
            <div class="row">
              <button type="submit" class="btn waves-effect waves-light" onclick="return addToCart()">
                <a class="white-text">
                  <i class="material-icons right">shopping_cart</i>
                  Add To Cart
                </a>
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <h4 class="white-text" style="margin-bottom: 40px;">Reviews</h4>

      <?php
        if ($hasReviews)
        {
          $reviews = $item->GetReviews();
          $reviewCount = count($reviews);
          for ($i=0; $r < $reviewCount; $r++)
          {
            $review = $reviews[$i];
            $username = $review->GetUsername();
            $feedback = $review->GetFeedback();
            $rating = $review->GetRating();
            echo(
              "<div class='ratings'>
                <div class='empty-stars'></div>
                <div class='full-stars' style='width: $rating%'></div>
              </div>
              <div class=input-field'>
                <i class='material-icons prefix cyan-text'>account_circle</i>
                <input id='icon_prefix' disabled type='text' class='white-text' value='$feedback'>
                <label for='icon_prefix' class='white-text'>$username</label>
              </div>"
            );
          }
        } else echo("<h6 class='grey-text'>There are no reviews yet... Be the first to leave a review!</h6>")
      ?>
    </div>
  </div>
</div>

<script src="static/js/item_page.js"></script>

<?php include "footer.php";?>