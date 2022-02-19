<!DOCTYPE html>
<html lang="en">
<title>PETS.CO</title>
<?php
  include "header.php";
  require_once "includes/utils/dbhandler.php";
?>

<div class="carousel carousel-slider center" style="margin-bottom: 100px">
  <div class="carousel-fixed-item center">
    <a class="btn waves-effect waves-teal grey darken-4 cyan-text">Shop!</a>
  </div>
  <a class="carousel-item carousel-magic" href="search_catalogue.php?category=0"
  style="background-image: url('./static/images/solo_dog.jpg'); background-position-y: 50%;">
    <h2>DOGS</h2>
    <p class="white-text fixed center">Find your fur-ever family member. <br> We offer the best quality dogs at the best price. </p>
  </a>
  <a class="carousel-item carousel-magic" href="search_catalogue.php?category=1"
  style="background-image: url('./static/images/dog_food.jpg'); background-position-y: 60%;">
    <h2>FOOD</h2>
    <p class="white-text">At Pets.co, we strive to provide the best for your dogs by sourcing only the best wholesome products. <br> We are dog lovers too! Your dog will definitely love our delicious dog food!</p>
  </a>
  <a class="carousel-item carousel-magic" href="search_catalogue.php?category=2"
  style="background-image: url('./static/images/dog_toy.jpg'); background-position-y: 20%;">
    <h2>ACCESSORIES</h2>
    <p class="white-text">Give your dog the most comfortable life with our accessories!</p>
  </a>
</div>

<div class="container">
  <div class="row">
    <div class="row">
      <h4 class="page-title lovelo center">Categories</h4>
    </div>
    <div class="row" style="margin-left: 20px">
      <div class="col">
        <div class="selectable-card" style="width: 350px; margin: 20px;">
          <a href="search_catalogue.php?category=0">
            <?php include_once "dog.html"; ?>
            <h5 class="orange-text center bold">DOGS</h5>
          </a>
        </div>
      </div>

      <div class="col">
        <div class="selectable-card" style="width: 350px; margin: 20px;">
          <a href="search_catalogue.php?category=1">
            <?php include_once "food.html"; ?>
            <h5 class="white-text center bold">FOOD</h5>
          </a>
        </div>
      </div>

      <div class="col">
        <div class="selectable-card" style="width: 350px; margin: 20px;">
          <a href="search_catalogue.php?category=2">
            <?php include_once "ball.html"; ?>
            <h5 class="orange-text center bold">ACCESSORIES</h5>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <h4 class="page-title" style="display: inline;">Best Selling Products</h4>
  </div>

  <?php
    $sql = "SELECT ItemID, AVG(Rating) FROM OrderItems
      GROUP BY ItemID
      ORDER BY AVG(Rating) DESC";

    /** @var mysqli $conn */
    $result = $conn->query($sql) or die($conn->error);

    $items = array();
    $ratings = array();
    while ($row = $result->fetch_array())
    {
      $itemID = $row[0];
      $avgRating = $row[1];
      array_push($items, new Item($itemID, $conn));
      array_push($ratings, $avgRating);
    }

    $itemCount = count($items);

    echo("<div class='row'>");
    // generate 4 items in a row
    for ($itemIdx=0, $itemAdded=0; $itemAdded < 4 && $itemIdx < $itemCount;)
    {
      $item = $items[$itemIdx];
      $avgRating = $ratings[$itemIdx++];
      if ($item->GetQuantityInStock() <= 0) continue;
      $itemAdded++;

      $itemID = $item->GetItemID();
      $image = $item->GetImage();
      $name = $item->GetName();
      $brand = $item->GetBrand();
      $price = $item->GetSellingPrice();
      $price = "$" . number_format($price, 2);

      $starWidth = $avgRating / 5 * 100;
      echo(
        "<div class='col s3'>
          <a href='item_page.php?item_id=$itemID'>
            <div class='selectable-card tint-glass-brown blurer' style='height: 450px; min-width: 300px'>
              <img class='shadow-img' src='images/$image' style='max-height: 200px; max-width: 250px;'>
              <table>
                <tbody>
                  <tr><th>Name: </th><td>$name</td></tr>
                  <tr><th>Brand: </th><td>$brand</td></tr>
                  <tr><th>Price: </th><td>$price</td></tr>
                  <tr>
                    <div class='ratings'>
                      <div class='empty-stars'></div>
                      <div class='full-stars' style='width: $starWidth%'></div>
                    </div>
                  </tr>
                </tbody>
              </table>
            </div>
          </a>
        </div>"
      );
    }
    echo("</div>");
  ?>
</div>

<div class="section" style="margin-top: 100px;">
  <div class="wide-container">
    <h3 class="white-text">You're in good company!</h3>
    <h5 class="white-text">
      At <b class="orange-text">Pets.co</b>, we strive for <b class="orange-text">PETS</b>.
      These guiding principles define our commitment and promise to serve you better
      by working towards our mutual goals.
    </h5>

    <div class="container row center-align" style="margin-bottom: 0px;">
      <div class="col">
        <div class="rounded-card-parent">
          <div class="card rounded-card tint-glass-black" style="height: 300px; width: 250px;">
            <img src="static/images/values_images/P.svg" height="200px">
            <div class="row">
              <h5 class="orange-text bold center" style="display: inline;">P</h5>
              <h5 class="white-text bold center" style="display: inline;">REMIUM</h5>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="rounded-card-parent">
          <div class="card rounded-card tint-glass-black" style="height: 300px; width: 250px;">
            <img src="static/images/values_images/E.svg" height="200px">
            <div class="row">
              <h5 class="orange-text bold center" style="display: inline;">E</h5>
              <h5 class="white-text bold center" style="display: inline;">NTHUSIATIC</h5>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="rounded-card-parent">
          <div class="card rounded-card tint-glass-black" style="height: 300px; width: 250px;">
            <img src="static/images/values_images/T.svg" height="200px">
            <div class="row">
              <h5 class="orange-text bold center" style="display: inline;">T</h5>
              <h5 class="white-text bold center" style="display: inline;">RUSTWORTY</h5>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="rounded-card-parent">
          <div class="card rounded-card tint-glass-black" style="height: 300px; width: 250px;">
            <img src="static/images/values_images/S.svg" height="200px">
            <div class="row">
              <h5 class="orange-text bold center" style="display: inline;">S</h5>
              <h5 class="white-text bold center" style="display: inline;">AFETY</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

<!-- database table initialization -->
<?php include "includes/init.inc.php"; ?>
</html>