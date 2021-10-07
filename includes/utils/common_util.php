<?php

function UIDExists($conn, $loginName)
{
  $sql = "SELECT * FROM Members where Username = ? OR Email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }
  
  mysqli_stmt_bind_param($stmt, "ss", $loginName, $loginName);
  mysqli_stmt_execute($stmt);
  
  $result = mysqli_stmt_get_result($stmt);
  
  if ($row = mysqli_fetch_assoc($result)) return $row;
  else return false;

  mysqli_stmt_close($stmt);
}

function write_log($log_msg)
{
  $log_filename = "logs";
  if (!file_exists($log_filename))
    mkdir($log_filename, 0777, true);

  $log_file_data = $log_filename.'/debug.log';
  file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
}
