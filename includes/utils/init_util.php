<?php

function CreateNeededTables($conn)
{
  $errors = [];

  // account table
  $table0 = "CREATE TABLE IF NOT EXISTS account (
    id INT(100) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    `password`VARCHAR(512) NOT NULL,
    email VARCHAR(50) NOT NULL,
    privilegeLevel INT(50) NOT NULL
    )";

  // orders table
  $table1 = "CREATE TABLE IF NOT EXISTS orders (
    OrderID INT(100) NOT NULL PRIMARY KEY,
    id INT(100) NOT NULL,
    FOREIGN KEY (id) REFERENCES account(id),
    OrderDate DATE NOT NULL,
    DeliveredDate DATE NOT NULL,
    CartFlag INT(50) NOT NULL
    )";

  // payment table
  $table2 = "CREATE TABLE IF NOT EXISTS payment (
    PaymentID INT(100) NOT NULL PRIMARY KEY,
    OrderID INT(100) NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES orders(OrderID),
    PaymentDate DATE NOT NULL
    )";

  // items table
  $table3 = "CREATE TABLE IF NOT EXISTS items (
    ItemID INT(100) NOT NULL PRIMARY KEY,
    Description VARCHAR(512) NOT NULL,
    SellingPrice VARCHAR(50) NOT NULL,
    QuantityInStock INT(50) NOT NULL
    )";

  // orderItems table
  $table4 = "CREATE TABLE IF NOT EXISTS orderItems (
    OrderItemID INT(100) NOT NULL PRIMARY KEY,
    OrderID INT(100) NOT NULL,
    ItemID INT(100) NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES orders(OrderID),
    FOREIGN KEY (ItemID) REFERENCES items(ItemID),
    Price VARCHAR(50) NOT NULL,
    Quantity INT(50) NOT NULL
    )";

  // reviews table
  $table5 = "CREATE TABLE IF NOT EXISTS reviews (
    ReviewID INT(100) NOT NULL PRIMARY KEY,
    OrderItemID INT(100) NOT NULL,
    FOREIGN KEY (OrderItemID) REFERENCES ordersItems(OrderItemID),
    ReviewDate DATE NOT NULL,
    Feedback VARCHAR(512),
    RATING INT(50) NOT NULL
    )";
  
  $tables = [$table0, $table1, $table2, $table3, $table4, $table5];


  foreach($tables as $t => $sql)
  {
    $query = @$conn->query($sql);

    // sql error handler
    if(!$query)
      $errors[] = "Table $t: Creation failed ($conn->error)";
  }

  foreach($errors as $msg) 
  {
    echo "$msg <br>";
  }
}