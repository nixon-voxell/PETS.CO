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
  /** @param mysqli $conn */
  public function UpdateOrderItems($conn)
  {
    $sql = "SELECT OrderItemID FROM OrderItems WHERE OrderID = $this->orderID";
    
    $result = $conn->query($sql);
    
    // create multiple OrderItem instances
    $this->orderItems = array();
    while ($row = $result->fetch_assoc())
      array_push($this->orderItems, new OrderItem($row["OrderItemID"], $conn));
  }

  // clear all items in the order
  /** @param mysqli $conn */
  public function EmptyItems($conn)
  {
    $sql = "DELETE FROM OrderItems WHERE OrderID = $this->orderID";
    $conn->query($sql);
    $this->orderItems = array();
  }
  
  //// get data
  public function GetOrderID() { return $this->orderID; }
  public function GetORderItems() { return $this->orderItems; }
}