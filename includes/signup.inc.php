<?php
require_once "./utils/common_util.php";
if (isset($_POST["submit"]))
{
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeatPwd"];
  $email = $_POST["email"];

  if (EmptyInputSignup($username, $pwd, $repeatPwd, $email) !== false)  
  {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }
  else if (InvalidUid($username) !== false)
  {
    header("location: ../signup.php?error=invaliduid");
  }
  else if (PwdMatch($pwd, $repeatPwd) !== false)
  {
    header("location: ../signup.php?error=passwordsdontmatch"); 
  }
  else if (UIDExists($conn, $username, $email) !== false) 
  {
    header("location: ../signup.php?error=usrnametaken");
  }
  CreateUser($conn, $username, $pwd, $email);
  echo "<p>You have signed up! Redirecting to login page...</p>";
  header( "refresh:1.5;url=../login.php");
}
else
{
  header("location: ../signup.php");
  exit();
}
?>