<?php

class Item
{
  private $itemID;
  private $name;
  private $brand;
  private $description;
  private $category;
  private $sellingPrice;
  private $quantityInStock;

  private $reviews;

  function __construct($itemID, $conn)
  {
    $this->itemID = $itemID;
    $this->InitData($conn);
    $this->GetReviews($conn);
  }

  // copy databse data to object data
  public function InitData($conn)
  {
    $sql = "SELECT * FROM Items WHERE ItemID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $this->itemID);

    if (mysqli_stmt_execute($stmt))
    {
      $orderItem = mysqli_stmt_get_result($stmt);

      $row = $orderItem->fetch_array(MYSQLI_ASSOC);
      $this->name = $row["Name"];
      $this->brand = $row["Brand"];
      $this->description = $row["Description"];
      $this->category = $row["Category"];
      $this->sellingPrice = $row["SellingPrice"];
      $this->quantityInStock = $row["QuantityInStock"];
    }

    mysqli_stmt_close($stmt);
  }

  // copy reviews and ratings from database
  public function GetReviews($conn)
  {
    $this->reviews = array();
    $sql = "SELECT Feedback, Rating FROM OrderItems WHERE ItemID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $this->itemID);

    if (mysqli_stmt_execute($stmt))
    {
      $reviewDetail = mysqli_stmt_get_result($stmt);
      while ($row = $reviewDetail->fetch_array(MYSQLI_ASSOC))
        array_push($this->reviews, new Review($row["Feedback"], $row["Rating"]));
    }
  }

  public function HasReviews()
  {
    if (isset($this->reviews) && count($this->reviews) > 0) return true;
    return false;
  }
}