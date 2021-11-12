<!DOCTYPE html>
<html lang="en">
<title>Make your review</title>

<?php
  include "header.php";
  require_once "includes/utils/dbhandler.php";
  require_once "includes/data/order_item.data.php";
  require_once "includes/review.inc.php";
  $orderItemID = $_GET["review_item"];
?>

<link href="stylesheet" href="rating_stars.css">
<div class="container" style="margin-top: 50px;">
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <h4 class="orange-text bold">Review Page</h4>
      <form action="review.php?review_item=<?php echo($orderItemID); ?>" method="POST" style="padding-left: 10px;">
        <?php
          $rating = CheckRating($conn, $orderItemID);
          echo("<input type='hidden' id='rating' name='rating' value=$rating>");
        ?>

        <div class="row" style="padding-top: 20px;">
          <div class="rate">
            <input type="radio" id="star5" name="rating_star" value=5 onclick="ratingChanged();"/>
            <label for="star5" title="5 Stars">5 stars</label>
            <input type="radio" id="star4" name="rating_star" value=4 onclick="ratingChanged();"/>
            <label for="star4" title="4 Stars">4 stars</label>
            <input type="radio" id="star3" name="rating_star" value=3 onclick="ratingChanged();"/>
            <label for="star3" title="3 Stars">3 stars</label>
            <input type="radio" id="star2" name="rating_star" value=2 onclick="ratingChanged();"/>
            <label for="star2" title="2 Stars">2 stars</label>
            <input type="radio" id="star1" name="rating_star" value=1 onclick="ratingChanged();"/>
            <label for="star1" title="1 Star">1 star</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 white-text">
            <i class="material-icons prefix">rate_review</i>
            <textarea id="review" class="materialize-textarea white-text" data-length="250"
              name="review"><?php echo(CheckReviewAvailable($conn, $orderItemID));?></textarea>
          </div>
          <div class="errormsg">
            <?php
              if (isset($_GET["error"]))
              {
                if ($_GET["error"] == "empty_input")
                  echo "<p>*Fill in all fields!<p>";
              }
            ?>
          </div>
            <?php
              if (isset($_GET["error"]))
              {
                if ($_GET["error"] == "none")
                  echo "<p style='color: green; font-weight: bold'>Thanks for rating! Redirecting to cart page...</p>";
              }
            ?>
          </div>
          <div class="container center-align">
            <input class="btn orange" type="submit" name="submit" value="Submit Review">
          </div>
        </div>
        </div>
      </form>   
    </div>
  </div>
</div>

<script>
  var STARS;
  var RATING;
  var STAR_COUNT;

  $(document).ready(function() 
  {
    STARS = document.getElementsByName("rating_star");
    RATING = document.getElementById("rating");
    STAR_COUNT = STARS.length
    
    // initial condition of rating (from database)
    for (var i=0; i < STAR_COUNT; i++) 
    {
      if (STARS[i].value > RATING.value) continue;
      else STARS[i].checked = true;
    }
    $("textarea#review").characterCounter();
  });

  function ratingChanged()
  {
    for (var i=0; i < STAR_COUNT; i++) 
    {
      if (STARS[i].checked == true) 
      {
        RATING.value = STARS[i].value;
        console.log(RATING.value);
        break;
      }
    }
  }
</script>

<?php include "footer.php"; ?>