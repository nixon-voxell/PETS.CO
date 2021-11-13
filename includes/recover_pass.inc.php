<?php

require "utils/dbhandler.php";
require_once "utils/common_util.php";
$errors = array();
$submit_email = "";

// if user click recover pass button in recover pass form
if (isset($_POST["submit_email"]))
{
  $submit_email = $_POST["submit_email"];

  if (empty($submit_email))
  {
    header("location: recover_pass.php?reset=empty_input");
    exit();

  } else
  {
    $submit_email = mysqli_real_escape_string($conn, $_POST["email"]);

    $check_email = "SELECT * FROM Members WHERE Email = '$submit_email'";

    $query = mysqli_query($conn, $check_email);

    // if email in database, do below
    if (mysqli_num_rows($query) > 0)
    {
      // otp code to reset password
      $otp = rand(999999, 111111);
      $insertotp = "UPDATE Members SET OTP = $otp WHERE Email = '$submit_email'";
      $query = mysqli_query($conn, $insertotp);
      if ($query)
      {
        $subject = "Reset Password for Pets.Co Members";
        $message = "
        The link To enter your otp code: localhost//PETS.co/otp.php
        Here is your reset password otp : $otp
        
        Ignore if you didn't make this request";
        
        // Our email
        $sender = "From: pets.co.customerservice@gmail.com";
        if (mail($submit_email, $subject, $message, $sender))
        {
          $info = "Please check your email for otp code - $submit_email";
          $_SESSION["Info"] = $info;
          $_SESSION["Email"] = $submit_email;
          header("location: recover_pass.php?reset=Success");
          exit();
        } else header("location: recover_pass.php?reset=OtpError");
      } else header("location: recover_pass.php?reset=Error");
    } else header("location: recover_pass.php?reset=EmailInvalid");
  }
}

// if user click submit OTP button
if (isset($_POST["submit_otp"]))
{
  $otp = $_POST["entered_otp"];

  if (empty($otp))
  {
    header("location: recover_pass.php?reset=emptyinput");
    exit();
  } else
  {
    $_SESSION["Info"] = "";

    $otp_code = mysqli_real_escape_string($conn, $_POST["entered_otp"]);
    $check_otp = "SELECT * FROM Members WHERE otp = $otp_code";
    $code_res = mysqli_query($conn, $check_otp);

    if (mysqli_num_rows($code_res) > 0){
      $fetch_data = mysqli_fetch_assoc($code_res);
      $submit_email = $fetch_data["email"];
      $_SESSION["Email"] = $submit_email;
      $info = "<p class='page-title'>Please create a new password and save it</p>";
      $_SESSION["Info"] = $info;
      header("location: new_pass.php");
      exit();
    } else $errors["otp_error"] = "You've entered incorrect code!";
  }
}

// if user click change password button
if (isset($_POST["change_pass"]))
{
  $pwd = $_POST["password"];
  $repeatPwd = $_POST["cpassword"];

  if (empty($pwd) || empty($repeatPwd))
  {
    header("location: new_pass.php?error=empty_input");
    exit();
  } else
  {
    $_SESSION["Info"] = "";

    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $cpassword = mysqli_real_escape_string($conn, $_POST["cpassword"]);
    if ($password !== $cpassword)
    {
      $errors["password"] = "Passwords does not match!";
    } else
    {
      $otp = 0;
      $submit_email = $_SESSION["Email"]; //getting this email using session
      $encryptpass = password_hash($password, PASSWORD_BCRYPT);
      $update_pass = "UPDATE Members SET otp = $otp, password = '$encryptpass' WHERE email = '$submit_email'";
      $run_query = mysqli_query($conn, $update_pass);
      if ($run_query)
      {
        $info = "<p class='page-title'>You've changed your password! Redirecting to login page...</p>";
        $_SESSION["Info"] = $info;
        header( "refresh:5;url=login.php" );
      } else $errors["db_error"] = "Faied to change your password!";
    }
  }
}