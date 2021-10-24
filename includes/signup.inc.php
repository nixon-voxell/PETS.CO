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
    header("location: ../signup.php?error=EmptyInput");
    exit();
  }
  
  if (InvalidUid($username) !== false)
  {
    header("location: ../signup.php?error=Invaliduid");
    exit();
  }

  if (PwdNotMatch($pwd, $repeatPwd))
  {
    header("location: ../signup.php?error=PasswordsDontMatch");
    exit();
  }

  if (UIDExists($conn, $username, $email))
  {
    header("location: ../signup.php?error=UsernameTaken");
    exit();
  }

  CreateUser($conn, $username, $pwd, $email);
  header("location: ../signup.php?error=None");
}

else
{
  header("location: ../signup.php");
  exit();
}
?>