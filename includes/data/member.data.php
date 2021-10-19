<?php

class Member
{
  /** @var int $memberID */
  private $memberID;
  /** @var string $username */
  private $username;
  /** @var string $email */
  private $email;
  /** @var int $priviledgeLevel */
  private $priviledgeLevel;
  
  /** @var Order $cart */
  private $cart;
  /** @var Order[] $orders */
  private $orders;

  function __construct($memberID, $username, $email, $priviledgeLevel, $conn)
  {
    $this->memberID = $memberID;
    $this->username = $username;
    $this->email = $email;
    $this->priviledgeLevel = $priviledgeLevel;
    $this->UpdateCart($conn);
    $this->UpdatePreviousOrder($conn);
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
  public function UpdateCart($conn)
  {
    $sql = "SELECT OrderID FROM Orders WHERE MemberID = ? AND CartFlag = 1";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $this->memberID);

    if (mysqli_stmt_execute($stmt))
    {
      $result = mysqli_stmt_get_result($stmt);

      $row = $result->fetch_array(MYSQLI_ASSOC);
      require_once "order.data.php";
      $this->cart = new Order($row["OrderID"], $conn);
    }

    mysqli_stmt_close($stmt);
  }

  // copy previous order data from database
  public function UpdatePreviousOrder($conn)
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

  //// get data
  public function GetMemberID() { return $this->memberID; }
  public function GetUsername() { return $this->username; }
  public function GetEmail() { return $this->email; }
  public function GetPriviledgeLevel() { return $this->priviledgeLevel; }
  public function GetCart() { return $this->cart; }
  public function GetOrders() { return $this->orders; }

  //// set data
  public function SetUsername($username) { $this->username = $username; }
  public function SetEmail($email) { $this->email = $email; }
}