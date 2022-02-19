<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Manage Personal Account</title>
<?php include "header.php"; ?>

<div class="container">
  <h3 class="page-title">Manage Personal Profile</h3>

  <div id="id_card_parent" class="rounded-card-parent">
    <div id="id_card" class="card rounded-card" style="height: 350px;">
      <div class="row">
        <button id="edit" class="btn orange col" onclick="edit_profile(this)" style="margin-right: 20px">Edit</button>
        <div class="errormsg">
          <?php
            if (isset($_GET["error"]))
            {
              if ($_GET["error"] == "empty_input")
                echo "<p>*Fill in all fields!<p>";

              else if ($_GET["error"] == "invalid_uid")
                echo "<p>*Choose a proper username!</p>";

              else if ($_GET["error"] == "invalidemail")
                echo "<p>*Choose a proper email!</p>";

              else if ($_GET["error"] == "passwords_dont_match")
                echo "<p>*Passwords doesn't match!</p>";

              else if ($_GET["error"] == "stmtfailed")
                echo "<p>*Something went wrong, please try again!</p>";

              else if ($_GET["error"] == "username_taken")
                echo "<p>*Username already taken!</p>";

              else if ($_GET["error"] == "none")
                echo "<p class='bold' style='color: green'>Successfully changed your profile.</p>";
            }
          ?>
        </div>
      </div>
      <div class="card-content white-text">
        <form class="col s12" action="includes/manage_profile.inc.php" method="POST">
          <div class="row">
            <div class="input-field col s6">
              <i class="material-icons prefix">account_circle</i>
              <?php
              echo "<input name='id' type='hidden' value='$memberID'/>";
              echo"<input class='white-text' name='username' type='text' value='$username'/>";
              ?>
              <label class='cyan-text' for="username">Enter New Username</label>
              <span class="helper-text grey-text" data-error="Min 5, Max 12 characters" data-success="correct">Min 5, Max 12 characters</span>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <i class="material-icons prefix">email</i>
              <?php
              echo "<input class='white-text' name='email' type='text' value='$email'/>";
              ?>
              <label class='cyan-text' for="email">Enter New Email</label>
              <span class="helper-text white-text" data-error="wrong" data-success="correct"></span>
            </div>
          </div>
          <div class="row" id="enter_pwd">
            <div class="input-field col s6">
              <i class="material-icons prefix"> password</i>
              <input class='white-text' name="pwd" type="password" class="validate" minlength="6" maxlength="20">
              <label class='cyan-text' for="password">Enter New Password</label>
              <span class="helper-text grey-text" data-error="Min 8, Max 20 characters" data-success="correct">Min 8, Max 20 characters</span>
            </div>
          </div>
          <div class="row" id="enter_repeat_pwd">
            <div class="input-field col s6">
              <i class="material-icons prefix"> password</i>
              <input class='white-text' name="repeat_pwd" type="password" class="validate" maxlength="14">
              <label class='cyan-text' for="repeat_pwd"> Repeat New Password</label>
            </div>
          </div>
          <br>
          <button id="update_account" type="submit" name="update" class="btn">Update Account</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="./static/js/manage_profile.js"></script>
<?php include "footer.php"; ?>
</html>
