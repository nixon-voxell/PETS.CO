<?php
require_once "utils/manageuseraccount_util.php";
require_once "utils/common_util.php";

if (isset($_POST["update"])) {
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeatPwd"];
  $email = $_POST["email"];
  $id = $_POST["id"];

  if(PwdMatch($pwd, $repeatPwd) !== false) {
    header("location: ../signup.php?error=passwordsdontmatch");
    exit();
  }
  else if(EmptyInputUpdate($username, $pwd, $repeatPwd, $email) !==false) {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }
  UpdateUser($conn, $username, $pwd, $email,$id);
  {
  $_SESSION['email']=$email;
  
  header("location: ../index.php?email='$email'");
  }
}
  else
  {
  header("location: ../manageuserprofile.php");
  exit();
  }
?>