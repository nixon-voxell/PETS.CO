<?php
// redirect to cart page
if (isset($_GET["redirect"])) header("refresh:1.5;url=cart.php?member_id=$memberID");
// check for ratings & review available start
function CheckRating($conn, $orderItemID)
{
  $sql = "SELECT Rating FROM OrderItems WHERE OrderItemID = $orderItemID";
  $result = $conn->query($sql) or die($conn->error);
  $row = $result->fetch_assoc();
  $rating = $row["Rating"];

  if ($rating != NULL) { return $rating; } 
  else { return 0; }
}

function CheckReviewAvailable($conn, $orderItemID)
{
  $sql = "SELECT Feedback FROM OrderItems WHERE OrderItemID = $orderItemID";
  $result = $conn->query($sql) or die($conn->error);
  $row = $result->fetch_assoc();
  $feedback = $row["Feedback"];

  if ($feedback != NULL) { return $feedback; } 
  else return "Leave your comment.";
}
// check for ratings & review available end

// submit review
function EmptyInputReview($rating, $review)
{ return empty($rating) || (empty($review)); }

if (isset($_POST["submit"]))
{
  $review = $_POST["review"];
  $rating = $_POST["rating"];

  if (EmptyInputReview($rating, $review))
  {
    echo("<script>location.href = 'review.php?error=empty_input&review_item=$orderItemID';</script>");
    exit();
  } else
  {
    $sql = "UPDATE OrderItems SET Feedback = '$review', Rating = $rating
      WHERE OrderItemID = $orderItemID";
    $conn->query($sql) or die($conn->error);
    // echo("<script>location.href = 'review.php?error=none&review_item=$orderItemID&redirect=1';</script>");
    // exit();
  }
}