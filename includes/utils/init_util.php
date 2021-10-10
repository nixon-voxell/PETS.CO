<?php
function ExecuteSQL($stmt, $sql)
{
  // TODO: log to a file
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    write_log("Error creating table");
    exit();
  }

  mysqli_stmt_execute($stmt);
}

function CreateNeededTables($conn)
{
  $tables = array();

  //Members table no error
  array_push(
    $tables, "CREATE TABLE IF NOT EXISTS Members(
      MemberID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
      Username VARCHAR(64) NOT NULL,
      Password VARCHAR(512) NOT NULL,
      Email VARCHAR(64) NOT NULL,
      PriviledgeLevel INT NOT NULL,
      OTP INT NOT NULL
    )"
  );

  // Orders table (display cart (items table) /payment + orderitems tables) no error
  array_push(
    $tables, "CREATE TABLE IF NOT EXISTS Orders(
      OrderID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
      MemberID INT NOT NULL,
      FOREIGN KEY (MemberID) REFERENCES Members(MemberID),
      CartFlag BIT NOT NULL DEFAULT 1
    )"
  );

  // Payment table (payment history) no error
  array_push(
    $tables, "CREATE TABLE IF NOT EXISTS Payment(
      PaymentID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
      OrderID INT NOT NULL,
      FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
      PaymentDate DATE NOT NULL
    )"
  );

  // Items table no error
  array_push(
    $tables, "CREATE TABLE IF NOT EXISTS Items(
      ItemID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
      Name VARCHAR(64) NOT NULL,
      Brand VARCHAR(64) NOT NULL,
      Description VARCHAR(512) NOT NULL,
      Category INT NOT NULL,
      SellingPrice VARCHAR(64) NOT NULL,
      QuantityInStock INT NOT NULL
    )"
  );

  // OrderItems table no error
  array_push(
    $tables, "CREATE TABLE IF NOT EXISTS OrderItems(
      OrderItemID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
      OrderID INT NOT NULL,
      ItemID INT NOT NULL,
      FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
      FOREIGN KEY (ItemID) REFERENCES Items(ItemID),
      Price VARCHAR(64) NOT NULL,
      Quantity INT NOT NULL,
      AddedDatetime DATETIME NOT NULL,
      Feedback VARCHAR(512),
      Rating INT
    )"
  );

  $stmt = mysqli_stmt_init($conn);
  for ($i=0; $i < count($tables); $i++)
    ExecuteSQL($stmt, $tables[$i]);

  mysqli_stmt_close($stmt);
}

