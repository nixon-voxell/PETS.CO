<?php

if (isset($_POST["submit"]))
{
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeatPwd"];
  $email = $_POST["email"];

  require_once "dbhandler.php";
  require_once "functions.php";

  if(emptyInputSignup($username, $pwd, $repeatPwd, $email) !== false)
  {
    header("location: ../sign_up.php?error=emptyinput");
    exit();
  }
  if(invalidUid($username) !== false)
  {
    header("location: ../sign_up.php?error=invaliduid");
    exit();
  }
  if(pwdMatch($pwd, $repeatPwd) !== false)
  {
    header("location: ../sign_up.php?error=passwordsdontmatch");
    exit();
  }
  if(uidExists($conn, $username, $email) !== false)
  {
    header("location: ../sign_up.php?error=usrnametaken");
    exit();
  }

  createUser($conn, $username, $pwd, $email);
}

else
{
  header("location: ../sign_up.php");
  exit();
}
?>