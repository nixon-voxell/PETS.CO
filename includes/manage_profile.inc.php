<?php
require_once "utils/manage_profile_util.php";
require_once "utils/common_util.php";

if (isset($_POST["update"])) {
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeatPwd"];
  $email = $_POST["email"];
  $id = $_POST["id"];

  if (PwdNotMatch($pwd, $repeatPwd))
  {
    header("location: ../signup.php?error=passwordsdontmatch");
    exit();
  }
  else if (InputIsEmpty($username, $pwd, $repeatPwd, $email))
  {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }
  UpdateUser($conn, $username, $pwd, $email,$id);
  header("location: ../index.php");
}
  else
  {
  header("location: ../manage_profile.php");
  exit();
  }
?>