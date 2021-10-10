<?php 
require "./includes/utils/dbhandler.php";
require_once "includes/utils/common_util.php";

if (!function_exists("EmptyInputCreateUser")) 
{
  function EmptyInputCreateUser($username, $pwd, $repeatPwd, $email, $privilegeLevel)
  { return empty($username) or (empty($pwd)) or (empty($repeatPwd)) or (empty($email)) or (empty($privilegeLevel)); }
}

if (!function_exists("AddUser")) 
{
  function AddUser($conn, $username, $pwd, $email, $privilegeLevel)
  {
    $sql = "INSERT INTO members (username, password, email, privilegeLevel) VALUES (?, ?, ?, ?);";
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
}

if (!function_exists("DeleteUser")) 
{
  function DeleteUser($conn, $userid)
  {
    $sql = "DELETE FROM members WHERE id='$userid';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      echo "<p>*UserID does not exists!</p>";
      exit();
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }
}

if (!function_exists("EmptyInputSelectUser")) 
{
function EmptyInputSelectUser($userid)
  { return empty($userid); }
}

// View Customer Cart/Orders (Customer List)
if (!function_exists("ShowCustomerList")) 
{
  function ShowCustomerList($conn)
  {
    $sql = mysqli_query($conn, "SELECT M.username, M.email, o.* from Members M INNER JOIN Orders O using (memberid) order by username")
    or die ("Select statement FAILED!");

    while (list($username, $email, $orderid, $memberid, $cartflag) = mysqli_fetch_array($sql))
      echo "<tr><td>$username</td><td>$email</td><td>$orderid</td><td>$orderid</td><td>$memberid</td><td>$cartflag</tr>";
  }
}

if (isset($_POST["submituser"]))
{
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeatPwd"];
  $email = $_POST["email"];
  $privilegeLevel = $_POST["level"];

  if (EmptyInputCreateUser($username, $pwd, $repeatPwd, $email, $privilegeLevel) !== false)
  {
    header("location: admin_manage_users.php?error=emptyinput");
    exit();
  }
  else if (InvalidUid($username) !== false)
    header("location: admin_manage_users.php?error=invaliduid");
  else if (PwdMatch($pwd, $repeatPwd) !== false)
    header("location: admin_manage_users.php?error=passwordsdontmatch");
  else if (UIDExists($conn, $username, $email) !== false)
    header("location: admin_manage_users.php?error=usrnametaken");

  AddUser($conn, $username, $pwd, $email, $privilegeLevel);
  header ("location: admin_manage_users.php?error=none");
}

if (isset($_POST["deleteuser"]))
{
  $userid = $_POST["userid"];

  if (EmptyInputSelectUser($userid) !== false)
    header ("location: admin_manage_users.php?error=emptyid");

  DeleteUser($conn, $userid);
  header ("location: admin_manage_users.php?error=deleted");
}