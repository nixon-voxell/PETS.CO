<?php
require_once "dbhandler.php";
require_once "common_util.php";

function EmptyInputLogin($username, $pwd) { return empty($username) or empty($pwd); }


function LoginUser($conn, $username, $pwd)
{
  $UIDExists = UIDExists($conn, $username, $username);

  if ($UIDExists === false)
  {
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $pwdHashed = $UIDExists["Password"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if($checkPwd === false)
  {
    header("location: ../login.php?error=wronglogin");
    exit();
  } else if ($checkPwd === true)
  {
    session_start();
    $_SESSION["MemberID"] = $UIDExists["MemberID"];
    $_SESSION["Username"] = $UIDExists["Username"];
    header("location: ../index.php");
    exit();
  }
}