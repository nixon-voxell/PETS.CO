<?php

class Member
{
  private $memberID;
  private $username;
  private $email;
  private $priviledgeLevel;

  public $cart;
  public $orders;

  function __construct($username, $conn)
  {
    $this->username = $username;
    $this->InitData($conn);
    $this->GetCart($conn);
    $this->GetPreviousOrder($conn);
  }

  // copy databse data to object data
  public function InitData($conn)
  {
    $sql = "SELECT * FROM Members WHERE Username = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $this->username);

    if (mysqli_stmt_execute($stmt))
    {
      $result = mysqli_stmt_get_result($stmt);

      $row = $result->fetch_array(MYSQLI_ASSOC);
      $this->memberID = $row["MemberID"];
      $this->email = $row["Email"];
      $this->priviledgeLevel = $row["PriviledgeLevel"];
    }

    mysqli_stmt_close($stmt);
  }

  // copy cart data from database
  public function GetCart($conn)
  {
    $sql = "SELECT OrderID FROM Orders WHERE MemberID = ? AND CartFlag = 1";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $this->memberID);

    if (mysqli_stmt_execute($stmt))
    {
      $result = mysqli_stmt_get_result($stmt);

      $row = $result->fetch_array(MYSQLI_ASSOC);
      $this->cart = new Order($row["OrderID"], $conn);
    }

    mysqli_stmt_close($stmt);
  }

  // copy previous order data from database
  public function GetPreviousOrder($conn)
  {
    $this->orders = array();
    $sql = "SELECT OrderID FROM Orders WHERE MemberID = ? AND CartFlag = 0";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $this->memberID);

    if (mysqli_stmt_execute($stmt))
    {
      $result = mysqli_stmt_get_result($stmt);

      while ($row = $result->fetch_array(MYSQLI_ASSOC))
        array_push($this->orders, new Order($row["OrderID"], $conn));
    }

    mysqli_stmt_close($stmt);
  }

  // check if member has cart (must have a cart, if cart does not exists, means there is something wrong)
  public function HasCart() { return isset($this->cart); }

  // check if there is any previous orders made by the member
  public function HasPreviousOrder()
  {
    if (isset($this->orders) && count($this->orders) > 0) return true;
    return false;
  }
}