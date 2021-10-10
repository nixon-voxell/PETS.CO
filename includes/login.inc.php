<?php

if (isset($_POST["submit"]))
{
  
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];

  require_once "utils/login_util.php";

  if (EmptyInputLogin($username, $pwd) !== false)
  {
    header("location: ../login.php?error=emptyinput");
    exit();
  }

  LoginUser($conn, $username, $pwd);
} else
{
  header("location: ../login.php");
  exit();
}