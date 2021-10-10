<?php
require_once "utils/manage_profile_util.php";
require_once "utils/common_util.php";

if (isset($_POST["update"])) 
{
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeatPwd"];
  $email = $_POST["email"];
  $id = $_POST["id"];

  if (PwdMatch($pwd, $repeatPwd))
  {
    header("location: ../manage_profile.php?error=passwordsdontmatch");
    exit();
  }
  else if (EmptyInput($username, $pwd, $repeatPwd, $email))
  {
    header("location: ../manage_profile.php?error=emptyinput");
    exit();
  }
  UpdateUser($conn, $username, $pwd, $email, $id);
  header("location: ../manage_profile.php?error=none");
  exit();
}
  else
  {
    header("location: ../manage_profile.php");
    exit();
  }
?>