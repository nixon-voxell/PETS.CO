<?php

function CreateNeededTables($conn)
{
  $tables = array();

  // account table
  array_push(
    $tables, "CREATE TABLE IF NOT EXISTS account (
    id INT(100) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    `password`VARCHAR(512) NOT NULL,
    email VARCHAR(50) NOT NULL,
    privilegeLevel INT(50) NOT NULL
    )"
  );

  // orders table
  array_push(
    $tables, "CREATE TABLE IF NOT EXISTS orders (
    OrderID INT(100) NOT NULL PRIMARY KEY,
    id INT(100) NOT NULL,
    FOREIGN KEY (id) REFERENCES account(id),
    OrderDate DATE NOT NULL,
    DeliveredDate DATE NOT NULL,
    CartFlag INT(50) NOT NULL
    )"
  );

  // payment table
  array_push(
    $tables, "CREATE TABLE IF NOT EXISTS payment (
    PaymentID INT(100) NOT NULL PRIMARY KEY,
    OrderID INT(100) NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES orders(OrderID),
    PaymentDate DATE NOT NULL
    )"
  );

  // items table
  array_push(
    $tables, "CREATE TABLE IF NOT EXISTS items (
    ItemID INT(100) NOT NULL PRIMARY KEY,
    Description VARCHAR(512) NOT NULL,
    SellingPrice VARCHAR(50) NOT NULL,
    QuantityInStock INT(50) NOT NULL
    )"
  );

  // orderItems table
  array_push(
    $tables, "CREATE TABLE IF NOT EXISTS orderItems (
    OrderItemID INT(100) NOT NULL PRIMARY KEY,
    OrderID INT(100) NOT NULL,
    ItemID INT(100) NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES orders(OrderID),
    FOREIGN KEY (ItemID) REFERENCES items(ItemID),
    Price VARCHAR(50) NOT NULL,
    Quantity INT(50) NOT NULL
    )"
  );

  // reviews table
  array_push(
    $tables, "CREATE TABLE IF NOT EXISTS reviews (
    ReviewID INT(100) NOT NULL PRIMARY KEY,
    OrderItemID INT(100) NOT NULL,
    FOREIGN KEY (OrderItemID) REFERENCES orderItems(OrderItemID),
    ReviewDate DATE NOT NULL,
    Feedback VARCHAR(512),
    RATING INT(50) NOT NULL
    )"
  );

  for ($i=0; $i < count($tables); $i++)
  {
    CreateTable($conn, $tables[$i]);
  }
}

function CreateTable($conn, $sql)
{
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
    echo("ERROR");

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}