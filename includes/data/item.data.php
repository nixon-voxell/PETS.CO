<?php

class Item
{
  private $itemID;
  public $name;
  public $brand;
  public $description;
  public $category;
  public $sellingPrice;
  public $quantityInStock;

  public $reviews;

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
      $result = mysqli_stmt_get_result($stmt);

      $row = $result->fetch_array(MYSQLI_ASSOC);
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
      $result = mysqli_stmt_get_result($stmt);
      while ($row = $result->fetch_array(MYSQLI_ASSOC))
      {
        $feedback = $row["Feedback"];
        $rating = $row["Rating"];
        // check to see if a review has been made or not
        if ($rating != NULL)
        {
          // if feedback is empty, we assign it as empty string
          if ($feedback != NULL) array_push($this->reviews, new Review($feedback, $rating));
          else array_push($this->reviews, new Review("", $rating));
        }
      }
    }
    mysqli_stmt_close($stmt);
  }

  // check whether this item has any reviews
  public function HasReviews()
  {
    if (isset($this->reviews) && count($this->reviews) > 0) return true;
    return false;
  }

  // copy object data to database
  public function SetData($conn)
  {
    $sql = "UPDATE Items SET
      Name = ?, Brand = ?, Description = ?, Category = ?, SellingPrice = ?, QuantityInStock = ?
      WHERE ItemID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param(
      $stmt, "sssiiii",
      $this->name,
      $this->brand,
      $this->description,
      $this->category,
      $this->sellingPrice,
      $this->quantityInStock,
      $this->itemID
    );
    
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $success;
  }
}