<!DOCTYPE html>
<html lang="en">
<title>Make your review</title>

<?php 
  include "header.php";
  require_once "includes/utils/dbhandler.php";
  require_once "includes/data/order_item.data.php";
?>

<link href="stylesheet" href="rating_stars.css">
<div class="container" style="margin-top: 50px;">
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <h4 class="orange-text bold">Review Page</h4>
      <form action="review.php" method="POST" style="padding-left: 10px;">
        <input type="hidden" name="orderItemID" value=<?php echo($orderItemID) ?>>
        <div class="row" style="padding-top: 20px;">
          <div class="rate">
            <input type="radio" id="star5" name="rating" value="5" onclick="postToController();"/>
            <label for="star5" title="5 Stars">5 stars</label>
            <input type="radio" id="star4" name="rating" value="4" onclick="postToController();"/>
            <label for="star4" title="4 Stars">4 stars</label>
            <input type="radio" id="star3" name="rating" value="3" onclick="postToController();"/>
            <label for="star3" title="3 Stars">3 stars</label>
            <input type="radio" id="star2" name="rating" value="2" onclick="postToController();"/>
            <label for="star2" title="2 Stars">2 stars</label>
            <input type="radio" id="star1" name="rating" value="1" onclick="postToController();"/>
            <label for="star1" title="1 Star">1 star</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 white-text">
            <i class="material-icons prefix">rate_review</i>
            <textarea id="textarea2" class="materialize-textarea white-text" data-length="250" name="review"></textarea>
            <label for="textarea2">Leave your comment</label>
          </div>
          <div class="errormsg">
            <?php
              if (isset($_GET["error"]))
              {
                if ($_GET["error"] == "empty_input")
                  echo "<p>*Fill in all fields!<p>";

                else if ($_GET["error"] == "none")
                  echo "<p>Thanks for rating! Redirecting to cart page...</p>";
              }
            ?>
          </div>
          <div class="container center-align">
            <input class="btn orange" type="submit" name="submit" value="Submit Review">
          </div>
        </div>
        </div>
        <script>
          function postToController() 
          {
            for (i = 0; i < document.getElementsByName("rating").length; i++) 
            {
              if (document.getElementsByName('rating')[i].checked == true) 
              {
                var ratingValue = document.getElementsByName('rating')[i].value;
                break;
              }
            }
          }
        </script>
        <?php
          function EmptyInputReview($rating, $review)
          { return empty($rating) || (empty($review)); }

          if (isset($_POST["submit"]))
          {
            $review = $_POST["review"];
            $rating = "<script>document.writeln(ratingValue);</script>";

            if (EmptyInputReview($rating, $review))
            {
              $orderItemID = $_GET["review_item"];
              echo("<script>location.href = 'review.php?error=empty_input&review_item=$orderItemID';</script>");
              exit();
            }

            if (isset($_GET["review_item"]))
            {
              $reviewItem = $_GET["review_item"];
              $sql = "UPDATE OrderItems SET Feedback = $review AND Rating = $rating
                WHERE OrderItemID = $orderItemID";
              $conn->query($sql) or die($conn->error);
              echo("<script>location.href = 'review.php?error=none';</script>");
              header( "refresh:1.5;url=login.php" );
              // echo("<script>location.href = 'cart.php';</script>");
              exit();
            }
          }
        ?>
      </form>   
    </div>
  </div>
</div>

<script>
  $(document).ready(function() 
  { $("textarea#textarea2").characterCounter(); });
</script>

<?php include "footer.php"; ?>