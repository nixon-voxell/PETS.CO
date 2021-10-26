<?php

class Order
{
  /** @var int $orderID */
  private $orderID;
  /** @var OrderItem[] $orderItems */
  private $orderItems;
  
  function __construct($orderID, $conn)
  {
    $this->orderID = $orderID;
    $this->UpdateOrderItems($conn);
  }
  
  
  // update order items related to this order
  public function UpdateOrderItems($conn)
  {
    $sql = "SELECT OrderItemID FROM OrderItems WHERE OrderID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $this->orderID);
    
    if (mysqli_stmt_execute($stmt))
    {
      $result = mysqli_stmt_get_result($stmt);
      
      // create multiple OrderItem instances
      $this->orderItems = array();
      while ($row = $result->fetch_array(MYSQLI_ASSOC))
      array_push($this->orderItems, new OrderItem($row["OrderItemID"], $conn));
    }
    
    mysqli_stmt_close($stmt);
  }
  
  //// get data
  public function GetOrderID() { return $this->orderID; }
  public function GetORderItems() { return $this->orderItems; }
}