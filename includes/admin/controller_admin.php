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

function SearchOrders($conn, $searchmember)
{
  $result = mysqli_query($conn, "SELECT M.username, M.email, o.* from Members M INNER JOIN Orders O using (memberid) WHERE Username LIKE '%$searchmember%' order by Username")or die ("Select statement FAILED!");
  while ($row = mysqli_fetch_assoc($result) ) 
  { 
    $id = $row["MemberID"]; 
    echo "<tr><td>" . $row['Username'] . "</td><td>" . $row['Email'] . "</td><td>" . $row['OrderID'] . "</td><td>" . $row['MemberID'] . "</td><td>" . $row['CartFlag'] . "</td><td><button name='inspect' value='$id' class='btn'><i class='material-icons'>search</i></button></td></tr>";
  }
}

function SearchUser($conn, $searchmember)
{
  $result = mysqli_query($conn, "Select Username, PrivilegeLevel from Members WHERE Username LIKE '%$searchmember%' order by Username")or die ("User does not exists!");
  while ($row = mysqli_fetch_assoc($result) ) 
  { 
  $id = $row["Username"]; 
  echo "<tr><td>" . $row['Username'] . "</td><td>" . $row['PrivilegeLevel'] . "</td><td><button name='inspect' value='$id' class='btn'><i class='material-icons'>search</i></button></td></tr>";
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