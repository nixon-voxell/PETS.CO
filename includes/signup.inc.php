<?php

if (isset($_POST["submit"]))
{
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeatPwd"];
  $email = $_POST["email"];

  require_once "utils/signup_util.php";

  if(EmptyInputSignup($username, $pwd, $repeatPwd, $email) !== false)
  {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }
  else if(InvalidUid($username) !== false)
    header("location: ../signup.php?error=invaliduid");
  else if(PwdNotMatch($pwd, $repeatPwd) !== false)
    header("location: ../signup.php?error=passwordsdontmatch");
  else if(UIDExists($conn, $username, $email) !== false)
    header("location: ../signup.php?error=usrnametaken");

  CreateUser($conn, $username, $pwd, $email);
}

else
{
  header("location: ../signup.php");
  exit();
}
?>