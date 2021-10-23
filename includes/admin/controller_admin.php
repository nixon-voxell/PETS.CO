<?php 

function EmptyInputCreateUser($username, $pwd, $repeatPwd, $privilegeLevel, $email)
{ return empty($username) or (empty($pwd)) or (empty($repeatPwd)) or ($privilegeLevel === "") or (empty($email)); }

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
  $sql = "SELECT M.Username, M.Email, O.* FROM Members M
    INNER JOIN Orders O using (MemberID) WHERE Username LIKE '%$searchMember%'
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

function EmptyInputSelectUser($value) { return empty($value); }

if (isset($_POST["submit_user"]))
{
  $username = $_POST["username"];
  $pass = $_POST["pwd"];
  $repeatPass = $_POST["repeat_pwd"];
  $emailadd = $_POST["email"];
  $privilegeLevel = $_POST["level"];

  require_once "includes/utils/dbhandler.php";
  require_once "includes/utils/common_util.php";
  
  if (EmptyInputCreateUser($username, $pass, $repeatPass, $emailadd, $privilegeLevel))
  {
    header("location: admin_manage_users.php?error=EmptyInput");
    exit();
  }
  if (PwdNotMatch($pass, $repeatPass))
  {
    header("location: admin_manage_users.php?error=PasswordsDontMatch");
    exit();
  }
  if (InvalidUid($username))
  {
    header("location: admin_manage_users.php?error=Invaliduid");
    exit();
  }
  if (UIDExists($conn, $username, $emailadd ))
  {
    header("location: admin_manage_users.php?error=UsernameTaken");
    exit();
  }

  $privilegeLevel -= 1;
  CreateUser($conn, $username, $pass, $email, $privilegeLevel);
  header ("location: admin_manage_users.php?error=None");
}