<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Login</title>
<?php include "header.php"; ?>

<form method="post" action="includes/login.inc.php">
  <div class="container">
    <h3 class="grey-text">Login</h3>
    <div class="row">
      <div class="input-field col s6">
      <i class="material-icons prefix">account_circle</i>
        <label>Username or Email</label>
        <input type="text" name="username">
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
      <i class="material-icons prefix"> password</i>
        <label>Password</label>
        <input type="password" name="pwd">
      </div>
    </div>
    <div class="row">
        <button type="submit" name="submit" class="btn">Login</button>
        <p class="grey-text">Not yet a member? <a href="signup.php">Sign Up!</a></p>
        <p><a href="recover_pass.php">Forgot Password?</a></p>
    </div>
    <div class="errormsg">
      <?php
        if (isset($_GET["error"]))
        {
          if($_GET["error"] == "emptyinput")
            echo "<p>*Fill in all fields!</p>";
          else if ($_GET["error"] == "wronglogin")
            echo "<p>*Incorrect credentials!</p>";
        }
      ?>
    </div>
  </div>
</form>

<?php include "footer.php"; ?>
</html>
