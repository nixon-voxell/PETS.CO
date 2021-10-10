<?php
require_once "utils/common_util.php";
require_once "utils/dbhandler.php";

function CreateUser($conn, $username, $pwd, $email)
{
  $sql = "INSERT INTO Members (Username, Password, Email) VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    echo "<p>*Something went wrong, please try again!</p>";
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $email);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

if (isset($_POST["submit"]))
{
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeatPwd"];
  $email = $_POST["email"];

  if (UIDExists($conn, $username, $email) !== false)
  {
    header("location: ../signup.php?error=usrnametaken");
    exit();
  }
  else if (PwdMatch($pwd, $repeatPwd) !== false)
  {
    header("location: ../signup.php?error=passwordsdontmatch");
    exit();
  }
  else if (InvalidUid($username) !== false)
  {
    header("location: ../signup.php?error=invaliduid");
    exit();
  }
  else if(EmptyInput($username, $pwd, $repeatPwd, $email) !== false)
  {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }

  CreateUser($conn, $username, $pwd, $email);
  header("location: ../signup.php?error=none");
  exit();
}

else
{
  header("location: ../signup.php");
  exit();
}
?>