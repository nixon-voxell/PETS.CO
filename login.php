<!DOCTYPE html>
<html lang="en">
<?php include "includes/navbar.php"; ?>
<form method="post" action="includes/login_inc.php">
  <div class="container">
    <div class = "header">
      <h2><i class="material-icons">sentiment_very_satisfied</i>
        <font size="5">Please Login:</font></h2>
    </div>
    <div class="row">
      <div class="input-field col s5">
        <i class="material-icons">stars</i>
        <label>Username or Email</label>
        <input type="text" name="username">
      </div>
    </div>
    <div class="row">
      <div class="input-field col s5">
        <i class="material-icons">stars</i>
        <label>Password</label>
        <input type="password" name="pwd">
      </div>
    </div>
    <div class="row">
        <button type="submit" name="submit" class="btn">Login</button>
        Not yet a member? <a href="sign_up.php">Sign Up</a>
    </div>
    <div class="errormsg">
      <?php
        if (isset($_GET["error"])){
          if($_GET["error"] == "emptyinput"){
            echo "<p>*Fill in all fields!<p>";
          }
          else if ($_GET["error"] == "wronglogin"){
            echo "<p>*Incorrect credentials!</p>";
          }
        }
      ?>
    </div>
  </div>
</form>

<?php include "includes/footer.php"; ?>
</html>
