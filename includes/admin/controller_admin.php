<?php 
require "includes/utils/dbhandler.php";
require_once "includes/utils/common_util.php";

if (!function_exists("EmptyInputCreateUser")) 
{
function EmptyInputCreateUser($username, $pwd, $repeatPwd, $email, $privilegeLevel)
{ return empty($username) || (empty($pwd)) || (empty($repeatPwd)) || (empty($email)) || (empty($privilegeLevel)); }
}

if (!function_exists("AddUser")) 
{
  function AddUser($conn, $username, $pwd, $email, $privilegeLevel)
  {
    $sql = "INSERT INTO members (Username, Password, Email, PriviledgeLevel) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      echo "<p>*Something went wrong, please try again!</p>";
      exit();
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $username, $hashedPwd, $email, $privilegeLevel);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }
}

if (!function_exists("DeleteUser")) 
{
  function DeleteUser($conn, $userid)
  {
    $sql = "DELETE FROM members WHERE MemberID='$userid';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      echo "<p>*UserID does not exists!</p>";
      exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }
}

if (!function_exists("EmptyInputSelectUser")) 
{
function EmptyInputSelectUser($userid)
  { return empty($userid); }
}


// View Customer Cart/Orders (Customer List)
if (!function_exists("ShowCustomerList")) 
{
  function ShowCustomerList($conn)
  {
    $sql = mysqli_query($conn, "SELECT M.username, M.email, o.* from Members M INNER JOIN Orders O using (memberid) order by username")
    or die ("Select statement FAILED!");

    while(list($username, $email, $orderid, $memberid, $cartflag) = mysqli_fetch_array($sql))
      echo "<tr><td>$username</td><td>$email</td><td>$orderid</td><td>$orderid</td><td>$memberid</td><td>$cartflag</tr>";
  }
}


// View/Manage(Customer List)
if (isset($_POST["submituser"]))
{
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeatPwd"];
  $email = $_POST["email"];
  $privilegeLevel = $_POST["level"];

  if (EmptyInputCreateUser($username, $pwd, $repeatPwd, $email, $privilegeLevel) !== false)
  {
    header("location: admin_manage_users.php?error=emptyinput");
    exit();
  }
  else if (InvalidUid($username) !== false)
    header("location: admin_manage_users.php?error=invaliduid");
  else if (PwdMatch($pwd, $repeatPwd) !== false)
    header("location: admin_manage_users.php?error=passwordsdontmatch");
  else if (UIDExists($conn, $username, $email) !== false)
    header("location: admin_manage_users.php?error=usrnametaken");

  AddUser($conn, $username, $pwd, $email, $privilegeLevel);
  header ("location: admin_manage_users.php?error=none");
}

if (isset($_POST["deleteuser"]))
{
  $userid = $_POST["userid"];

  function EmptyInputDeleteUser($userid)
  { return empty($userid); }

  if (EmptyInputDeleteUser($userid) !== false)
  { 
    header ("location: admin_manage_users.php?error=emptyid");
    exit();
  }

  DeleteUser($conn, $userid);
  header ("location: admin_manage_users.php?error=deleted");
}


// View/Manage(Products)
if (isset($_POST["submitproduct"]))
{
  $name = $_POST["name"];
  $brand = $_POST["brand"];
  $description = $_POST["description"];
  $category = $_POST["category"];
  $sellingprice = $_POST["sellingprice"];
  $quantityinstock = $_POST["quantityinstock"];
  $image = $_POST["image"];
  
  mysqli_query($conn, "insert into items (Name, Brand, Description, Category, SellingPrice, QuantityInStock, image) values ('$name', '$brand', '$description', '$category', '$sellingprice', '$quantityinstock', '$image')") or die ("SQL Insert Failed!");
  header("location: admin_manage_products.php?message=CreateProductSuccessful");
  mtsqli_close($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      echo "<p>*Something went wrong, please try again!</p>";
      exit();
    }
    if (EmptyInputCreateProduct($name, $brand, $description, $category, $sellingprice, $quantityinstock, $image) !== false)
    {
      header("location: admin_manage_users.php?error=emptyinput");
      exit();
    }
    if (isset($_GET['action']) && $_GET['action'] == 'delete')
    {
      $itemid = $_GET["itemid"];
      mysqli_query($conn,"delete from items where ItemID=$itemid") or die ("SQL Statement Failed");
    }
  }
?>



