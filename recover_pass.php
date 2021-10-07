<?php require_once "includes/recover_pass.inc.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PETS.CO - Recover Your Password</title>
</head>

<?php include "header.php"; ?>
<div class="container">
  <h3 class="grey-text">Recover Your Password</h3>
  <p> Please enter your email address so we can assist you in recovering your account. </p>
  <form class="col s12" action="recover_pass.php" method="post">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">email</i>
        <input name="email" type="email" class="validate" maxlength="25">
        <label for="email">Email</label>
        <span class="helper-text" data-error="wrong" data-success="correct"></span>
      </div>
    </div>
    <input class="btn btn-block" type="submit" name="submit_email" value="Recover my Password">
    <div class="errormsg">
      <?php
        if (isset($_GET["reset"]))
        {
          if($_GET["reset"] == "success")
            echo "<p>*Check your e-mail spam folder!<p></br>";
          else if ($_GET["reset"] == "emptyinput")
            echo "<p>*Fill in all fields!</p>";
          else if ($_GET["reset"] == "otperror")
            echo "<p>*Failed while sending code!</p>";
          else if ($_GET["reset"] == "error")
            echo "<p>*Something went wrong! Please try again later.</p>";
          else if ($_GET["reset"] == "emailinvalid")
            echo "<p>*This email address does not exist!</p>";
        }
      ?>
    </div>
  </form>
</div>
</html>
