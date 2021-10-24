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