<?php 

function EmptyInputCreateUser($username, $pwd, $repeatPwd, $privilegeLevel, $email)
{ return empty($username) or (empty($pwd)) or (empty($repeatPwd)) or (empty($privilegeLevel)) or (empty($email)); }

function AddUser($conn, $username, $pwd, $email, $privilegeLevel)
{
  $sql = "INSERT INTO Members (Username, Password, Email, PrivilegeLevel) VALUES (?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    echo "<p>*Something went wrong, please try again!</p>";
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssss", $username, $hashedPwd, $email, $privilegeLevel);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function SelectedIDOrders($conn, $uid)
{
  $sql = mysqli_query($conn, "SELECT memberid, cartflag from Orders WHERE memberid = '$uid' and cartflag = '1'")
  or die ("Select statement FAILED!");
  
  while (list($usrid, $cartFlag) = mysqli_fetch_array($sql))
  if ($usrid == $uid && $cartFlag == "1")
    include "cart_items.php";

  else if ($usrid == $uid && $cartFlag == "0")
    include "cart_orders.php";

  else if (($usrid == $uid && $cartFlag == "1") && ($usrid == $uid && $cartFlag == "0"))
  { 
    include "cart_items.php";
    include "cart_orders.php";
  }
  else echo "ERROR!";
}

function DeleteUser($conn, $userid)
{
  $sql = "DELETE FROM Members WHERE MemberID = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    echo "<p>*UserID does not exists!</p>";
    exit();
  }
  mysqli_stmt_bind_param($stmt, "i", $userid);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function SearchOrders($conn, $searchmember)
{
  $sql = mysqli_query($conn, "SELECT M.username, M.email, o.* from Members M INNER JOIN Orders O using (memberid) WHERE Username LIKE '%$searchmember%' order by Username")or die ("*User does not exists!");

  while (list($username, $email, $orderid, $memberid, $cartflag) = mysqli_fetch_array($sql))
    echo "<tr><td>$username</td><td>$email</td><td>$orderid</td><td>$memberid</td><td>$cartflag</tr>";
}

function SearchUser($conn, $searchmember)
{
  $result = mysqli_query($conn, "Select MemberID, Username, Email, Password, PrivilegeLevel from Members WHERE Username LIKE '%$searchmember%' order by Username")or die ("*User does not exists!");

  while (list($memberID, $username, $email, $password, $priviledge_level) = mysqli_fetch_array($result))
    echo "<tr><td>$memberID</td><td>$username</td><td>$email</td><td>$password</td><td>$priviledge_level</td></tr>";
}

function ChooseUser($conn, $privilegelevel)
{
  $result = mysqli_query($conn, "Select MemberID, Username, Email, Password, PrivilegeLevel from Members WHERE PrivilegeLevel = '$privilegelevel' order by Username")or die ("*Privilege Level does not exists!");

  while (list($memberID, $username, $email, $password, $priviledge_level) = mysqli_fetch_array($result))
    echo "<tr><td>$memberID</td><td>$username</td><td>$email</td><td>$password</td><td>$priviledge_level</td></tr>";
}

function EmptyInputSelectUser($value)
  { return empty($value); }

// View Customer Cart/Orders (Customer List)
function ShowCustomerList($conn)
{
  $sql = mysqli_query($conn, "SELECT M.username, M.email, o.* from Members M INNER JOIN Orders O using (memberid) order by username")
  or die ("Select statement FAILED!");

  while (list($username, $email, $orderid, $memberid, $cartflag) = mysqli_fetch_array($sql))
    echo "<tr><td>$username</td><td>$email</td><td>$orderid</td><td>$memberid</td><td>$cartflag</tr>";
}

if (isset($_POST["submituser"]))
{
  $usrname = $_POST["username"];
  $pass = $_POST["pwd"];
  $repeatPass = $_POST["repeatPwd"];
  $privilegeLevel = $_POST["level"];
  $emailadd = $_POST["email"];

  require_once "includes/utils/dbhandler.php";
  require_once "includes/utils/common_util.php";

  if (EmptyInputCreateUser($usrname, $pass, $repeatPass, $emailadd, $privilegeLevel) !== false)
  {
    header("location: admin_manage_users.php?error=emptyinput");
    exit();
  }
  if (PwdNotMatch($pass, $repeatPass) !== false)
  {
    header("location: admin_manage_users.php?error=passwordsdontmatch");
    exit();
  }
  if (InvalidUid($usrname) !== false)
  {
    header("location: admin_manage_users.php?error=invaliduid");
    exit();
  }
  if (UIDExists($conn, $usrname, $emailadd ) !== false)
  {
    header("location: admin_manage_users.php?error=usrnametaken");
    exit();
  }

  AddUser($conn, $usrname, $pass, $emailadd, $privilegeLevel);
  header ("location: admin_manage_users.php?error=none");
  exit();
}

if (isset($_POST["userid"]))
{
  $userid = $_POST["userid"];

  require_once "includes/utils/dbhandler.php";

  if (EmptyInputSelectUser($userid) !== false)
  {
    header ("location: admin_manage_users.php?error=emptyid");
    exit();
  }

  DeleteUser($conn, $userid);
  header ("location: admin_manage_users.php?error=deleted");
  exit();
}
