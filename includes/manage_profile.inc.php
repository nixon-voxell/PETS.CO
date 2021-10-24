<?php
require_once "utils/manage_profile_util.php";
require_once "utils/common_util.php";

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