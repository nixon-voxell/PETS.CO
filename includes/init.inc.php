<?php

require_once "utils/dbhandler.php";
require_once "utils/common_util.php";

function CreateMemberTable($conn)
{
  $sql = "CREATE TABLE IF NOT EXISTS account (
    id int(100) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    username varchar(50) NOT NULL,
    password varchar(512) NOT NULL,
    email varchar(50) NOT NULL
    );";

  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
    echo("ERROR");

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  exit();
}

CreateMemberTable($conn);