<?php
require_once "dbhandler.php";
require_once "common_util.php";

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
