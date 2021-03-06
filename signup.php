<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Sign Up</title>
<?php include "header.php"; ?>

<form action="includes/signup.inc.php" method="POST">
  <div class="container">
    <h3 class="page-title white-text">Register</h3>
    <div class="rounded-card-parent">
      <div class="card rounded-card">
        <div class="row">
          <div class="input-field col s6">
            <i class="material-icons prefix white-text">account_circle</i>
            <input name="username" type="text" class="validate white-text" minlength="5" maxlength="12">
            <label for="username" class="white-text">Username</label>
            <span class="helper-text grey-text" data-error="Min 5, Max 12 characters" data-success="Min 5, Max 12 characters">Min 5, Max 12 characters</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <i class="material-icons prefix white-text"> password</i>
            <input name="pwd" type="password" class="validate white-text" minlength="8" maxlength="20">
            <label for="password" class="white-text"> Password</label>
            <span class="helper-text grey-text" data-error="Min 8, Max 20 characters" data-success="Min 8, Max 20 characters">Min 8, Max 20 characters</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <i class="material-icons prefix white-text"> password</i>
            <input name="repeat_pwd" type="password" class="validate white-text" maxlength="20">
            <label for="repeat_pwd" class="white-text"> Repeat Password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <i class="material-icons prefix white-text">email</i>
            <input name="email" type="email" class="validate white-text" maxlength="25">
            <label for="email" class="white-text">Email</label>
            <span class="helper-text white-text" data-error="wrong" data-success="correct"></span>
          </div>
        </div>
        <input class="btn" type="submit" name="submit" value="Register">
        <div class="errormsg">
          <?php
            if (isset($_GET["error"]))
            {
              if ($_GET["error"] == "empty_input")
                echo "<p>*Fill in all fields!<p>";

              else if ($_GET["error"] == "invaliid_uid")
                echo "<p>*Choose a proper username!</p>";

              else if ($_GET["error"] == "passwords_dont_match")
                echo "<p>*Passwords doesn't match!</p>";

              else if ($_GET["error"] == "username_taken")
                echo "<p>*Username/Email already taken!</p>";

              else if ($_GET["error"] == "none")
              {
                echo "<p class='green-text bold'>You have signed up! Redirecting to login page...</p>";
                header( "refresh:1.5;url=login.php" );
                exit();
              }
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</form>

<?php include "footer.php"; ?>
</html>