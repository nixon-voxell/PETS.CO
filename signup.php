<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Sign Up</title>
<?php include "header.php"; ?>

<div class="container">
  <h3 class="grey-text">Register</h3>
  <form class="col s12" action="includes/signup.inc.php" method="post">
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
        <input name="pwd" type="password" class="validate" minlength="6" maxlength="20">
        <label for="password"> Password</label>
        <span class="helper-text" data-error="Min 8, Max 20 characters" data-success="correct">Min 8, Max 20 characters</span>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix"> password</i>
        <input name="repeatPwd" type="password" class="validate" maxlength="14">
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
    <input class="btn btn-block" type="submit" name="submit" value="Register">
  </form>

  <div class="errormsg">
    <?php
      if (isset($_GET["error"]))
      {
        if($_GET["error"] == "emptyinput")
          echo "<p>*Fill in all fields!<p>";

        else if ($_GET["error"] == "invaliduid")
          echo "<p>*Choose a proper username!</p>";

        else if ($_GET["error"] == "invalidemail")
          echo "<p>*Choose a proper email!</p>";

        else if ($_GET["error"] == "passwordsdontmatch")
          echo "<p>*Passwords doesn't match!</p>";

        else if ($_GET["error"] == "stmtfailed")
          echo "<p>*Something went wrong, please try again!</p>";

        else if ($_GET["error"] == "usrnametaken")
          echo "<p>*Username already taken!</p>";

        else if ($_GET["error"] == "none")
        {
          echo "<p>You have signed up! Redirecting to login page...</p>";
          header( "refresh:1.5;url=login.php" );
          exit();
        }
      }
    ?>
  </div>
</div>

<?php include "footer.php"; ?>
</html>