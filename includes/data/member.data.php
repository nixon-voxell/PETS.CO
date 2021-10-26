<?php

class Member
{
  /** @var int $memberID */
  private $memberID;
  /** @var string $username */
  private $username;
  /** @var string $email */
  private $email;
  /** @var int $privilegeLevel */
  private $privilegeLevel;
  
  /** @var Order $cart */
  private $cart;
  /** @var Order[] $orders */
  private $orders;

  /**
   * @param int $memberID
   * @param string $username
   * @param string $email
   * @param int $privilegeLevel
   * @param mysqli $conn
   */
  function __construct($memberID, $username, $email, $privilegeLevel, $conn)
  {
    $this->memberID = $memberID;
    $this->username = $username;
    $this->email = $email;
    $this->privilegeLevel = $privilegeLevel;
    $this->UpdateCart($conn);
    $this->UpdatePreviousOrder($conn);
  }

  /**
   * @param int $memberID
   * @param mysqli $conn
   * @return Member
  */
  public static function CreateMemberFromID($memberID, $conn)
  {
    $sql = "SELECT * FROM Members WHERE MemberID = $memberID";
    $result = $conn->query($sql) or die($conn->error);
    $row = $result->fetch_assoc();
    $username = $row["Username"];
    $email = $row["Email"];
    $privilegeLevel = $row["PriviledgeLevel"];

    return new Member($memberID, $username, $email, $privilegeLevel, $conn);
  }

  // copy databse data to object data
  /** @param mysqli $conn */
  public function InitData($conn)
  {
    $sql = "SELECT * FROM Members WHERE Username = $this->username";
    $result = $conn->query($sql) or die($conn->error);

    $row = $result->fetch_assoc();
    $this->memberID = $row["MemberID"];
    $this->email = $row["Email"];
    $this->privilegeLevel = $row["PriviledgeLevel"];
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
  public function GetPriviledgeLevel() { return $this->privilegeLevel; }
  public function GetCart() { return $this->cart; }
  public function GetOrders() { return $this->orders; }

  //// set data
  public function SetUsername($username) { $this->username = $username; }
  public function SetEmail($email) { $this->email = $email; }
}