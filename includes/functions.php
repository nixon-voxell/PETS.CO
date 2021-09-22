<?php 
//sign up functions
function EmptyInputSignup($username, $pwd, $repeatPwd, $email)
{ return empty($username) or (empty($pwd)) or (empty($repeatPwd)) or (empty($email)); }

function InvalidUid($username)
{ return !preg_match("/^[a-zA-Z0-9]*$/", $username); }

function PwdMatch($pwd, $repeatPwd)
{ return $pwd !== $repeatPwd; }

function UIDExists($conn, $username, $email)
{
  $sql = "SELECT * FROM account where username = ? OR email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }
  
  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if($row = mysqli_fetch_assoc($resultData))
    return $row;
  else
  {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function CreateUser($conn, $username, $pwd, $email)
{
  $sql = "INSERT INTO account (username, password, email) VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }
  
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $email);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../signup.php?error=none");
  exit();
}

//login functions
function EmptyInputLogin($username, $pwd) { return empty($username) or empty($pwd); }


function LoginUser($conn, $username, $pwd)
{
  $UIDExists = UIDExists($conn, $username, $username);

  if ($UIDExists === false)
  {
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $pwdHashed = $UIDExists["password"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if($checkPwd === false)
  {
    header("location: ../login.php?error=wronglogin");
    exit();
  } else if ($checkPwd === true)
  {
    session_start();
    $_SESSION["id"] = $UIDExists["id"];
    $_SESSION["username"] = $UIDExists["username"];
    header("location: ../index.php");
    exit();
  }
}