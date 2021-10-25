<?php

/**
 * @param mysqli $conn
 * @param string $username
 * @param string $pwd
 * @param string $email
*/
function CreateUser($conn, $username, $pwd, $email, $privilegeLevel=0)
{
  // create member
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
  $sql = "INSERT INTO Members(Username, Password, Email, PrivilegeLevel)
    VALUES ('$username', '$hashedPwd', '$email', $privilegeLevel);";
  $conn->query($sql) or die("<p>*User creation error, please try again!</p>");

  // get member id
  $sql = "SELECT MemberID FROM Members where Username = '$username';";
  $result = $conn->query($sql) or die("<p>*MemberID error, please try again!</p>");

  $row = $result->fetch_assoc();
  $memberID = $row["MemberID"];

  // create cart
  $sql = "INSERT INTO Orders(MemberID) VALUES ($memberID);";
  $result = $conn->query($sql) or die("<p>*Cart creation error, please try again!</p>");
}

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

function EmptyInput($username, $pwd, $repeatPwd, $email)
{ return empty($username) || (empty($pwd)) || (empty($repeatPwd)) || (empty($email)); }

function InvalidUid($username)
{ return !preg_match("/^[a-zA-Z0-9]*$/", $username); }

function PwdNotMatch($pwd, $repeatPwd)
{ return $pwd !== $repeatPwd; }


/**
 * @param mysqli $conn
 * @param string $name
 * @param string $brand
 * @param string $description
 * @param string $category
 * @param string $sellingprice
 * @param string $quantityinstock
 * @param string $image
*/
function CreateProduct($conn, $name, $brand, $description, $category, $sellingprice, $quantityinstock, $image=0)
{
  // create product
  $sql = "INSERT INTO Items(Name, Brand, Description, Category, SellingPrice, QuantityInStock, Image)
    VALUES ('$name', '$brand', '$description', $category, $sellingprice, $quantityinstock, '$image');";
  $conn->query($sql) or die("<p>*Product creation error, please try again!</p>");

  // get item id
  $sql = "SELECT ItemID FROM items where Name = '$name';";
  $result = $conn->query($sql) or die("<p>*ItemID error, please try again!</p>");

  $row = $result->fetch_assoc();
  $itemID = $row["ItemID"];
}


