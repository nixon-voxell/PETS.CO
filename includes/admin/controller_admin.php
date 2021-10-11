<?php 

function EmptyInputCreateUser($username, $pwd, $repeatPwd, $email, $privilegeLevel)
{ return empty($username) or (empty($pwd)) or (empty($repeatPwd)) or (empty($email)) or (empty($privilegeLevel)); }

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

function DeleteUser($conn, $userid)
{
  $sql = "DELETE FROM Members WHERE MemberID='$userid';";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    echo "<p>*UserID does not exists!</p>";
    exit();
  }

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function EmptyInputSelectUser($userid)
  { return empty($userid); }

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
  $emailadd = $_POST["email"];
  $privilegeLevel = $_POST["level"];

  require_once "includes/utils/dbhandler.php";
  require_once "includes/utils/common_util.php";

  if (PwdMatch($pass, $repeatPass) !== false)
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
  if (EmptyInputCreateUser($usrname, $pass, $repeatPass, $emailadd, $privilegeLevel) !== false)
  {
    header("location: admin_manage_users.php?error=emptyinput");
  }

  AddUser($conn, $usrname, $pass, $emailadd, $privilegeLevel);
  header ("location: admin_manage_users.php?error=none");
  exit();
}

if (isset($_POST["deleteuser"]))
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