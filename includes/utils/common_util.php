<?php

function UIDExists($conn, $loginName)
{
  $sql = "SELECT * FROM Members where Username = ? OR Email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }
  
  mysqli_stmt_bind_param($stmt, "ss", $loginName, $loginName);
  mysqli_stmt_execute($stmt);
  
  $result = mysqli_stmt_get_result($stmt);
  
  if ($row = mysqli_fetch_assoc($result)) return $row;
  else return false;

  mysqli_stmt_close($stmt);
}

function write_log($log_msg)
{
  $log_filename = "logs";
  if (!file_exists($log_filename))
    mkdir($log_filename, 0777, true);

  $log_file_data = $log_filename.'/debug.log';
  file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
}

include_once "login_util.php";
define( "PRIVILEGE_LEVEL_ADMIN", "1" );

function isAdmin() 
{
  if ( isset( $_SESSION["MemberID"] ) && $_SESSION["PrivilegeLevel"] == PRIVILEGE_LEVEL_ADMIN ) 
    return true;
  else 
    return false;
}

require_once "dbhandler.php";

function EmptyInputSignup($username, $pwd, $repeatPwd, $email)
{ return empty($username) or (empty($pwd)) or (empty($repeatPwd)) or (empty($email)); }

function InvalidUid($username)
{ return !preg_match("/^[a-zA-Z0-9]*$/", $username); }

function PwdMatch($pwd, $repeatPwd)
{ return $pwd !== $repeatPwd; }

function CreateUser($conn, $username, $pwd, $email)
{
  $sql = "INSERT INTO Members (Username, Password, Email) VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    echo "<p>*Something went wrong, please try again!</p>";
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $email);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  exit();
}

