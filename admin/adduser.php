<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Add User</title>
<?php 
// include "topheader.php"; 

include("../includes/utils/dbhandler.php");
include("../includes/utils/common_util.php");

?>

<?php
if (isset($_POST["submit"]))
{


  // $id=$_POST['user_id'];

  write_log("print8-");

  $username = $_POST["username"];
  $password = $_POST["pwd"];
  $repeatPwd = $_POST["repeatPwd"];
  $email = $_POST["email"];
  // $hashedPwd=password_hash($password, PASSWORD_DEFAULT);

  mysqli_query($conn, "INSERT INTO members set username='$username', email='$email', password='$password'") or die ("SQL Sttement Failed!");
  header("location: ./adduser.php?Message=AddUserSuccessful");
  mysqli_close($conn);
  
  function AddUser($conn, $username, $password, $email)
  {
  $sql = "INSERT INTO members (username, password, email) VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ./adduser.php?error=stmtfailed");
    exit();
  }
  }
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add User</title>
</head>
<body>
<div class="container">
  <h3 class="grey-text">Add User</h3>
  <form class="col s12" action="./adduser.php" method="post">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">account_circle</i>
        <input name="username" type="text" class="validate" minlength="5" maxlength="12">
        <label for="username">Username</label>
        <span class="helper-text" data-error="Min 5, Max 12 characters" data-success="correct">Min 5, Max 12 characters</span>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix"> password</i>
        <input name="pwd" type="password" class="validate" minlength="8" maxlength="20">
        <label for="password"> Password</label>
        <span class="helper-text" data-error="Min 8, Max 20 characters" data-success="correct">Min 8, Max 20 characters</span>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix"> password</i>
        <input name="repeatPwd" type="password" class="validate" maxlength="20">
        <label for="repeatPwd"> Repeat Password</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">email</i>
        <input name="email" type="email" class="validate" maxlength="25">
        <label for="email">Email</label>
        <span class="helper-text" data-error="wrong" data-success="correct"></span>
      </div>
    </div>
    <input class="btn btn-block" type="submit" name="submit" value="Add User">
  </form>

</body>
</html>


<?php 
include "footer.php"; 
?>