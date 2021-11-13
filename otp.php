<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PETS.CO - OTP</title>
</head>

<?php
include "header.php";
require_once "includes/recover_pass.inc.php";

$_SESSION["Email"] = $submit_email;
if ($submit_email !== false)
{
  ?>
  <div class="container">
    <div class="rounded-card-parent">
      <div class="rounded-card" style="margin-top: 100px">
        <form class="col s12" action="otp.php" method="POST">
          <h3 class="grey-text">Code Verification</h3>
          <!-- error message -->
          <?php 
          if (isset($_SESSION["Info"])){
            ?>
            <?php
          }
          ?>
          <?php
          if (count($errors) > 0)
          {
            ?>
            <div class="card-panel red lighten-2">
            <?php
            foreach($errors as $showerror){
              echo $showerror;
            }
            ?>
            </div>
            <?php
          }
          ?>
          <!-- end of error message -->

          <div class="row">
            <div class="input-field col s6">
              <i class="material-icons prefix white-text"> pin</i>
              <input name="entered_otp" type="text" class="validate white-text" minlength="6" maxlength="6">
              <label for="password" class="white-text"> OTP code here</label>
              <span class="helper-text white-text" data-error="6 Digit OTP" data-success="6 Digit OTP">6 Digit OTP</span>
            </div>
          </div>
          <input class="btn btn-block" type="submit" name="submit_otp" value="Submit OTP">
        </form>
      </div>
    </div>
  </div>
</html>

<?php
}else
{
  header("location: login.php");
  exit();
}
?>