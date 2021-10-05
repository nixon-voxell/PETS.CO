<?php

if (isset($_POST["update"]))
{
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeatPwd"];
  $email = $_POST["email"];

  require_once "utils/manage_profile_util.php";

  if(EmptyInputUpdate($username, $pwd, $repeatPwd, $email))
  {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }
  else if(InvalidUid($username))
    header("location: ../signup.php?error=invaliduserid");
  else if(PwdMatch($pwd, $repeatPwd))
    header("location: ../signup.php?error=passwordsdontmatch");
  else if(UIDExists($conn, $username, $email))
    header("location: ../signup.php?error=usrnametaken");

  UpdateUser($conn, $username, $pwd, $email);
  $_SESSION["Email"]=$email;
  header("location: ../index.php?email='$email'");
}

else
{
  header("location: ../signup.php");
  exit();
}
?>