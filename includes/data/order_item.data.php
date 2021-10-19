<?php

class OrderItem
{
  private $orderItemID;
  private $itemID;
  private $price;
  private $quantity;
  private $addedDateTime;

  function __construct($orderItemID, $conn)
  {
    $this->orderItemID = $orderItemID;
    $this->InitData($conn);
  }

  // copy databse data to object data
  public function InitData($conn)
  {
    $sql = "SELECT * FROM OrderItems WHERE OrderItemID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $this->orderItemID);

    if (mysqli_stmt_execute($stmt))
    {
      $result = mysqli_stmt_get_result($stmt);

      $row = $result->fetch_array(MYSQLI_ASSOC);
      $this->itemID = $row["ItemID"];
      $this->price = $row["Price"];
      $this->quantity = $row["Quantity"];
      $this->addedDateTime = $row["AddedDateTime"];
    }

    mysqli_stmt_close($stmt);
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
  public function GetPrice() { return $this->price; }
}