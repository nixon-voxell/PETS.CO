<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Manage Personal Account</title>
<?php include "header.php"; ?>

<div class="container">
  <h3 class="white-text page-title">Manage Personal Profile</h3>
  <button id="edit" class="btn orange" onclick="edit_profile(this)">Edit</button>

  <div class="card white" style="box-shadow: black 2px 10px 20px 10px;">
    <div class="card-content">
      <form class="col s12" action="includes/manage_profile.inc.php" method="post">
        <div class="row">
          <div class="input-field col s6">
            <i class="material-icons prefix">account_circle</i>
            <?php
            echo "<input name='id' type='hidden' value='$memberID'/>";
            echo"<input name='username' type='text' value='$username'/>";
            ?>
            <label for="username">Enter New Username</label>
            <span class="helper-text" data-error="Min 5, Max 12 characters" data-success="correct">Min 5, Max 12 characters</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <i class="material-icons prefix">email</i>
            <?php
            echo "<input name='email' type='text' value='$email'/>";
            ?>
            <label for="email">Enter New Email</label>
            <span class="helper-text" data-error="wrong" data-success="correct"></span>
          </div>
        </div>
        <div class="row" id="enter_pwd">
          <div class="input-field col s6">
            <i class="material-icons prefix"> password</i>
            <input name="pwd" type="password" class="validate" minlength="6" maxlength="20">
            <label for="password">Enter New Password</label>
            <span class="helper-text" data-error="Min 8, Max 20 characters" data-success="correct">Min 8, Max 20 characters</span>
          </div>
        </div>
        <div class="row" id="enter_repeat_pwd">
          <div class="input-field col s6">
            <i class="material-icons prefix"> password</i>
            <input name="repeatPwd" type="password" class="validate" maxlength="14">
            <label for="repeatPwd"> Repeat New Password</label>
          </div>
        </div>
        <br>
        <button type="submit" name="update" class="btn">Update Account</button>
      </form>
    </div>
  </div>

  <div class="errormsg">
    <?php
      if (isset($_GET["error"]))
      {
        if ($_GET["error"] == "emptyinput")
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
          echo "<p>Successfully changed your profile.</p>";
          exit();
        }
      }
    ?>
  </div>
</div>

<script src="./static/js/manage_profile.js"></script>
<?php include "footer.php"; ?>
</html>
