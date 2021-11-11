<?php

class Item
{
  /** @var int $itemID */
  private $itemID;
  /** @var string $name */
  private $name;
  /** @var string $brand */
  private $brand;
  /** @var string $description */
  private $description;
  /** @var int $category */
  private $category;
  /** @var float $sellingPrice */
  private $sellingPrice;
  /** @var int $quantityInStock */
  private $quantityInStock;
  /** @var int $image */
  private $image;
  
  /** @var Review[] $reviews */
  private $reviews;
  /** @var float $avgRating */
  private $avgRating;

  /** @var string[] CATEGORY */
  public const CATEGORY = ["Dog", "Food", "Accessory"];
  /** @var string[] CATEGORY_ICON */
  public const CATEGORY_ICON = ["pets", "restaurant", "toys"];

  function __construct($itemID, $conn)
  {
    $this->itemID = $itemID;
    $this->InitData($conn);
    $this->UpdateReviews($conn);
  }

  // copy databse data to object data
  /** @param mysqli $conn */
  public function InitData($conn)
  {
    $sql = "SELECT * FROM Items WHERE ItemID = $this->itemID";
    $result = $conn->query($sql) or die($conn->error);

    $row = $result->fetch_array(MYSQLI_ASSOC);
    $this->name = $row["Name"];
    $this->brand = $row["Brand"];
    $this->description = $row["Description"];
    $this->category = $row["Category"];
    $this->sellingPrice = $row["SellingPrice"];
    $this->quantityInStock = $row["QuantityInStock"];
    $this->image = $row["Image"];
  }
  
  // copy reviews and ratings from database
  /** @param mysqli $conn */
  public function UpdateReviews($conn)
  {
    $this->reviews = array();
    $sql = "SELECT OI.Feedback, OI.Rating, O.MemberID FROM OrderItems OI, Orders O
      WHERE OI.ItemID = $this->itemID AND OI.OrderID = O.OrderID";
    $result = $conn->query($sql) or die ($conn->error);

    $this->avgRating = -1;
    $totalRatings = 0;
    while ($row = $result->fetch_assoc())
    {
      $feedback = $row["Feedback"];
      $rating = $row["Rating"];
      $memberID = $row["MemberID"];
      $nameResult = $conn->query("SELECT Username FROM Members M WHERE MemberID = $memberID") or die($conn->error);
      $username = $nameResult->fetch_array()[0];
      // check to see if a review has been made or not
      if ($rating != NULL)
      {
        // if feedback is empty, we assign it as empty string
        if ($feedback != NULL) array_push($this->reviews, new Review($username, $rating, $feedback));
        else array_push($this->reviews, new Review($username, $rating, ""));
        $this->avgRating += $rating;
        $totalRatings++;
      }
    }

    if ($totalRatings > 0) $this->avgRating /= $totalRatings;
  }

  // check whether this item has any reviews
  public function HasReviews()
  {
    if (isset($this->reviews) && count($this->reviews) > 0) return true;
    return false;
  }

  // copy object data to database
  /** @param mysqli $conn */
  public function SetData($conn)
  {
    $sql = "UPDATE Items SET
      Name = '$this->name',
      Brand = '$this->brand',
      Description = '$this->description',
      Category = $this->category,
      SellingPrice = $this->sellingPrice,
      QuantityInStock = $this->quantityInStock
      WHERE ItemID = $this->itemID";

    $conn->query($sql) or die($conn->error);
  }

  //// set data
  /** @param float $sellingPrice */
  public function SetSellingPrice($sellingPrice) { $this->sellingPrice = $sellingPrice; }
  /** @param int $quantityInStock */
  public function SetQuantityInStock($quantityInStock) { $this->quantityInStock = $quantityInStock; }

  //// get data
  public function GetItemID() { return $this->itemID; }
  public function GetName() { return $this->name; }
  public function GetBrand() { return $this->brand; }
  public function GetDescription() { return $this->description; }
  public function GetCategory() { return $this->category; }
  public function GetSellingPrice() { return $this->sellingPrice; }
  public function GetQuantityInStock() { return $this->quantityInStock; }
  public function GetImage() { return $this->image; }
  public function GetReviews() { return $this->reviews; }
  public function GetAvgRatings() { return $this->avgRating / 5 * 100; }
}