<?php 
//sign up functions
function emptyInputSignup($username, $pwd, $repeatPwd, $email){
  $result="";
  if (empty($username) or (empty($pwd)) or (empty($repeatPwd)) or (empty($email))) {
    $result = true;
  }
  else{
    $result = false;
  }
  return $result;
}

function invalidUid($username){
  $result="";
  if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    $result = true;    
  }
  else{
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $repeatPwd){
  $result="";
  if($pwd !== $repeatPwd){
    $result = true;    
  }
  else{
    $result = false;
  }
  return $result;
}

function uidExists($conn, $username, $email){
  $sql = "SELECT * FROM account where username = ? OR email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){ 
    header("location: ../sign_up.php?error=stmtfailed");
    exit();
  }
  
  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if($row = mysqli_fetch_assoc($resultData)){
    return $row;
  }
  else{
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createUser($conn, $username, $pwd, $email){
  $sql = "INSERT INTO account (username, password, email) VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){ 
    header("location: ../sign_up.php?error=stmtfailed");
    exit();
  }
  
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $email);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../sign_up.php?error=none");
  exit();

  //login functions
  function emptyInputLogin($username, $pwd){
    $result="";
    if (empty($username) or (empty($pwd))) {
      $result = true;
    }
    else{
      $result = false;
    }
    return $result;
  }
}

function loginUser($conn, $username, $pwd){
  $uidExists = uidExists($conn, $username, $username);

  if ($uidExists === false){
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $pwdHashed = $uidExists["password"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if($checkPwd === false){
    header("location: ../login.php?error=wronglogin");
    exit();
  }
  else if ($checkPwd === true){
    session_start();
    $_SESSION["id"] = $uidExists["id"];
    $_SESSION["username"] = $uidExists["username"];
    header("location: ../index.php");
    exit();
  }
}



