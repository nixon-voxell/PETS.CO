<?php
require_once "dbhandler.php";
require_once "common_util.php";

function InputIsEmpty($username, $pwd, $repeatPwd, $email)
{ return empty($username) or (empty($pwd)) or (empty($repeatPwd)) or (empty($email)); }

function InvalidUid($username)
{ return !preg_match("/^[a-zA-Z0-9]*$/", $username); }

function PwdNotMatch($pwd, $repeatPwd)
{ return $pwd !== $repeatPwd; }

function UpdateUser($conn, $username, $pwd, $email, $id)
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

  mysqli_stmt_bind_param($stmt, "sssi", $username, $hashedPwd, $email,$id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  
  session_start();
  $_SESSION["Username"] = $username;
  $_SESSION["Email"] = $email;

  header("location: ../index.php?error=none");
  exit();
}
