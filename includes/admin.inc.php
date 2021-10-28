<?php 
require_once "includes/utils/dbhandler.php";
require_once "includes/utils/common_util.php";

function EmptyInputCreateUser($username, $pwd, $repeatPwd, $privilegeLevel, $email)
{ return empty($username) || (empty($pwd)) || (empty($repeatPwd)) or ($privilegeLevel === "") || (empty($email));}

function EmptyInputSelectUser($value) { return empty($value); }

function EmptyInputSelectProduct($value) { return empty($value); }

function EmptyInputCreateProduct($name, $brand, $description, $category, $sellingprice, $quantityinstock, $image)
{
  return empty($name) || empty($brand) || empty($description) ||
  ($category === "") || empty($sellingprice) ||
  empty($quantityinstock) || empty($image);
}

//Manage User
if (isset($_POST["submit_user"]))
{
  $username = $_POST["username"];
  $pass = $_POST["pwd"];
  $repeatPass = $_POST["repeat_pwd"];
  $emailadd = $_POST["email"];
  $privilegeLevel = $_POST["level"];

  require_once "includes/utils/dbhandler.php";
  require_once "includes/utils/common_util.php";

  if (EmptyInputCreateUser($username, $pass, $repeatPass, $emailadd, $privilegeLevel))
  {
    header("location: admin_manage_users.php?error=EmptyInput");
    exit();
  }
  if (PwdNotMatch($pass, $repeatPass))
  {
    header("location: admin_manage_users.php?error=PasswordsDontMatch");
    exit();
  }
  if (InvalidUid($username))
  {
    header("location: admin_manage_users.php?error=Invaliduid");
    exit();
  }
  if (UIDExists($conn, $username, $emailadd ))
  {
    header("location: admin_manage_users.php?error=UsernameTaken");
    exit();
  }

  $privilegeLevel -= 1;
  CreateUser($conn, $username, $pass, $email, $privilegeLevel);
  header ("location: admin_manage_users.php?error=None");
  mysqli_close($conn);
}


//Manage Products
if (isset($_POST["submit_product"]))
{
  $name = $_POST["name"];
  $brand = $_POST["brand"];
  $description = $_POST["description"];
  $category = $_POST["category"];
  $sellingprice = $_POST["sellingprice"];
  $quantityinstock = $_POST["quantityinstock"];
  $image = $_POST["image"];

  if (EmptyInputCreateProduct($name, $brand, $description, $category, $sellingprice, $quantityinstock, $image))
  {
    header("location: admin_manage_products2.php?error=EmptyInput");
    exit();
  }

  CreateProduct($conn, $name, $brand, $description, $category, $sellingprice, $quantityinstock, $image);
  header("location: admin_manage_products2.php?message=CreateProductSuccessful");
  mysqli_close($conn);
}



  //   if (isset($_GET['action']) && $_GET['action'] == 'delete')
  //   {
  //     $itemid = $_GET["itemid"];
  //     mysqli_query($conn,"delete from items where ItemID=$itemid") or die ("SQL Statement Failed");
  //   }
  // }
