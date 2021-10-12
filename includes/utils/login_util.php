<?php
require_once "dbhandler.php";
require_once "common_util.php";

function EmptyInputLogin($username, $pwd) { return empty($username) or empty($pwd); }


function LoginUser($conn, $loginName, $pwd)
{
  $memberDetail = UIDExists($conn, $loginName);

  if ($memberDetail === false)
  {
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $pwdHashed = $memberDetail["Password"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if ($checkPwd === false)
  {
    header("location: ../login.php?error=wronglogin");
    exit();
  } else if ($checkPwd === true)
  {
    session_start();
    require_once "../includes/data/member.data.php";
    $member = new Member(
      $memberDetail["MemberID"],
      $memberDetail["Username"],
      $memberDetail["Email"],
      $memberDetail["PrivilegeLevel"],
      $conn
    );

    $_SESSION["Member"] = $member;
    header("location: ../index.php");
    exit();
    // $_SESSION["MemberID"] = $memberDetail["MemberID"];
    // $_SESSION["Username"] = $memberDetail["Username"];
    // $_SESSION["Email"] = $memberDetail["Email"];
    // $_SESSION["PrivilegeLevel"] = $memberDetail["PrivilegeLevel"];
  }
}