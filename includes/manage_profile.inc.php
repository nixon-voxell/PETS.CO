<?php
require_once "utils/dbhandler.php";
require_once "utils/common_util.php";
require_once "data/member.data.php";

function UpdateUser($conn, $username, $pwd, $email, $memberID)
{
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
  $sql = "UPDATE Members SET Username = ?, Password=?, Email = ? where MemberID = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../manage_profile.php?error=Statementfailed");
    exit();
  }
  
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "sssi", $username, $hashedPwd, $email, $memberID);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  
  session_start();
  /** @var Member $member */
  $member = $_SESSION["Member"];
  $member->SetUsername($username);
  $member->SetEmail($email);
  $_SESSION["Member"] = $member;
}

if (isset($_POST["update"])) 
{
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeat_pwd"];
  $email = $_POST["email"];
  $memberID = $_POST["id"];

  if (PwdNotMatch($pwd, $repeatPwd))
  {
    header("location: ../manage_profile.php?error=passwordsdontmatch");
    exit();
  }
  else if (EmptyInput($username, $pwd, $repeatPwd, $email))
  {
    header("location: ../manage_profile.php?error=emptyinput");
    exit();
  }
  UpdateUser($conn, $username, $pwd, $email, $memberID);
  header("location: ../manage_profile.php?error=none");
  exit();
}
else
{
  header("location: ../manage_profile.php");
  exit();
}
?>