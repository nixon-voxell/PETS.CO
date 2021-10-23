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
  $sql = mysqli_query($conn, "SELECT memberid, cartflag FROM Orders WHERE memberid = '$uid' AND cartflag = 1")
  or die ("SELECT statement FAILED!");
  
  while (list($usrid, $cartFlag) = mysqli_fetch_array($sql))
  if ($usrid == $uid && $cartFlag == "1")
    include "cart_items.php";

  else if ($usrid == $uid && $cartFlag == "0")
    include "order_items.php";

  else if (($usrid == $uid && $cartFlag == "1") && ($usrid == $uid && $cartFlag == "0"))
  {
    include "cart_items.php";
    include "order_items.php";
  }
  else echo "ERROR!";
}

function SearchOrders($conn, $searchMember)
{
  $sql = "SELECT M.username, M.email, o.* FROM Members M
    INNER JOIN Orders O using (memberid) WHERE Username LIKE '%$searchMember%'
    ORDER BY Username";
  $result = mysqli_query($conn, $sql)or die ("SELECT statement FAILED!");
  while ($row = mysqli_fetch_assoc($result) ) 
  { 
    $memberID = $row["MemberID"]; 
    $username = $row["Username"]; 
    $email = $row["Email"]; 
    $orderID = $row["OrderID"]; 
    $cartFlag = $row["CartFlag"]; 

    echo(
      "<tr>
        <td>$username</td>
        <td>$email</td>
        <td>$orderID</td>
        <td>$memberID</td>
        <td>$cartFlag</td>
        <td><button name='inspect' value='$memberID' class='btn'><i class='material-icons'>search</i></button></td>
      </tr>"
    );
  }
}

function SearchUser($conn, $searchMember)
{
  $result = mysqli_query($conn, "SELECT Username, PrivilegeLevel FROM Members WHERE Username LIKE '%$searchMember%' ORDER BY Username") or die ("User does not exists!");
  while ($row = mysqli_fetch_assoc($result) ) 
  { 
  $username = $row["Username"]; 
  echo(
    "<tr>
      <td>$username</td>
      <td><button name='inspect' value='$username' class='btn'><i class='material-icons'>search</i></button></td>
    </tr>"
  );
  }
}

function EmptyInputSelectUser($value)
  { return empty($value); }

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
}