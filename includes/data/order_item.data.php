<?php

class OrderItem
{
  /** @var int $orderItemID */
  private $orderItemID;
  /** @var int $itemID */
  private $itemID;
  /** @var int $price */
  private $price;
  /** @var int $quantity */
  private $quantity;
  /** @var string $addedDateTime */
  private $addedDateTime;

  function __construct($orderItemID, $conn)
  {
    $this->orderItemID = $orderItemID;
    $this->InitData($conn);
  }

  // copy databse data to object data
  /** @param mysqli $conn */
  public function InitData($conn)
  {
    $sql = "SELECT * FROM OrderItems WHERE OrderItemID = $this->orderItemID";
    $result = $conn->query($sql) or die($conn->error);

    $row = $result->fetch_assoc();
    $this->itemID = $row["ItemID"];
    $this->price = $row["Price"];
    $this->quantity = $row["Quantity"];
    $this->addedDateTime = $row["AddedDatetime"];
  }

  // remove order from database
  public function DeleteOrder($conn)
  {
    $sql = "DELETE * FROM OrderItems WHERE OrderItemID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $this->orderItemID);

    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $success;
  }

  //// get data
  public function GetOrderItemID() { return $this->orderItemID; }
  public function GetItemID() { return $this->itemID; }
  public function GetPrice() { return $this->price; }
  public function GetQuantity() { return $this->quantity; }
  public function GetAddedDateTime() { return $this->addedDateTime; }
}