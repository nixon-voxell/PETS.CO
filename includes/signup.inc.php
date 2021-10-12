<?php

if (isset($_POST["submit"]))
{
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeatPwd"];
  $email = $_POST["email"];

  require_once "./utils/dbhandler.php";
  require_once "./utils/common_util.php";

  if (EmptyInput($username, $pwd, $repeatPwd, $email) !== false)
  {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }
  
  if (InvalidUid($username) !== false)
  {
    header("location: ../signup.php?error=invaliduid");
    exit();
  }

  if (PwdNotMatch($pwd, $repeatPwd))
  {
    header("location: ../signup.php?error=passwordsdontmatch");
    exit();
  }

  if (UIDExists($conn, $username, $email))
  {
    header("location: ../signup.php?error=usrnametaken");
    exit();
  }

  CreateUser($conn, $username, $pwd, $email);
  header("location: ../signup.php?error=none");
}

else
{
  header("location: ../signup.php");
  exit();
}
?>