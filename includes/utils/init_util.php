<?php
// create all needed tables
function CreateNeededTables($conn)
{
  // account table
  $sql = "CREATE TABLE IF NOT EXISTS account (
    id int(100) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    username varchar(50) NOT NULL,
    password varchar(512) NOT NULL,
    email varchar(50) NOT NULL
    );";

  CreateTable($conn, $sql);
}

function CreateTable($conn, $sql)
{
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
    echo("ERROR");

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}