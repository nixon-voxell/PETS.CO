<?php
require_once "dbhandler.php";
require_once "common_util.php";

function EmptyInputUpdate($username, $pwd, $repeatPwd, $email)
{ return empty($username) or (empty($pwd)) or (empty($repeatPwd)) or (empty($email)); }

function InvalidUid($username)
{ return !preg_match("/^[a-zA-Z0-9]*$/", $username); }

function PwdMatch($pwd, $repeatPwd)
{ return $pwd !== $repeatPwd; }

function UpdateUser($conn, $username, $pwd, $email)
{
  $sql = "update account set password=?, email=?, where username=?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../manageuserprofile.php?error=Statementfailed");
    exit();
  }
  
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $email);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  session_start();
  $_SESSION["username"] = $username;
  $_SESSION["email"] = $email;

  header("location: ../manageuserprofile.php?error=none");
  exit();
}