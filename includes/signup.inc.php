<?php

if (isset($_POST["submit"]))
{
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeat_pwd"];
  $email = $_POST["email"];

  require_once "./utils/dbhandler.php";
  require_once "./utils/common_util.php";

  if (EmptyInput($username, $pwd, $repeatPwd, $email) !== false)
  {
    header("location: ../signup.php?error=empty_input");
    exit();
  }
  
  if (InvalidUid($username) !== false)
  {
    header("location: ../signup.php?error=invalid_uid");
    exit();
  }

  if (PwdNotMatch($pwd, $repeatPwd))
  {
    header("location: ../signup.php?error=passwords_dont_match");
    exit();
  }

  if (UIDExists($conn, $username, $email))
  {
    header("location: ../signup.php?error=username_taken");
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