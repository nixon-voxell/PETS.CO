<?php

require "utils/dbhandler.php";
$errors = array();
$email = "";

// if user click recover pass button in recover pass form
if(isset($_POST["submitemail"]))
{
  $email = $_POST["submitemail"];

  function EmptyInput($email)
  { return (empty($email)); }

  if(EmptyInput($email) !== false)
  {
    header("location: reset_pass.php?reset=emptyinput");
    exit();

  }else
  {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    $check_email = "SELECT * FROM account WHERE email='$email'";

    $query = mysqli_query($conn, $check_email);

    // if email in database, do below
    if(mysqli_num_rows($query) > 0)
    {
      // otp code to reset password
      $otp = rand(999999, 111111);
      $insertotp = "UPDATE account SET otp = $otp WHERE email = '$email'";
      $query = mysqli_query($conn, $insertotp);
      if($query)
      {
        $subject = "Reset Password for Pets.Co account";
        $message = "
        The link To enter your otp code: localhost//PETS.co/otp.php
        Here is your reset password otp : $otp
        
        Ignore if you didn't make this request";
        
        // Our email
        $sender = "From: pets.co.customerservice@gmail.com";
        if(mail($email, $subject, $message, $sender))
        {
          $info = "Please check your email for otp code - $email";
          $_SESSION["info"] = $info;
          $_SESSION["email"] = $email;
          header("location: recover_pass.php?reset=success");
          exit();
        }else{
          header("location: reset_pass.php?reset=otperror");
        }
      }else{
        header("location: reset_pass.php?reset=error");
      }
    }else{
      header("location: reset_pass.php?reset=emailinvalid");
    }
  }
}

// if user click submit OTP button
if(isset($_POST["submitotp"]))
{
  $otp = $_POST["enteredotp"];

  function EmptyInput($otp)
  { return (empty($otp)); }

  if(EmptyInput($otp) !== false)
  {
    header("location: reset_pass.php?reset=emptyinput");
    exit();
  }else
  {
    $_SESSION["info"] = "";

    $otp_code = mysqli_real_escape_string($conn, $_POST["enteredotp"]);
    $check_otp = "SELECT * FROM account WHERE otp = $otp_code";
    $code_res = mysqli_query($conn, $check_otp);

    if(mysqli_num_rows($code_res) > 0){
      $fetch_data = mysqli_fetch_assoc($code_res);
      $email = $fetch_data["email"];
      $_SESSION["email"] = $email;
      $info = "Please create a new password and save it";
      $_SESSION["info"] = $info;
      header("location: new_pass.php");
      exit();
    }else{
      $errors["otp-error"] = "You've entered incorrect code!";
    }
  }
}

// if user click change password button
if(isset($_POST["change_pass"]))
{
  $pwd = $_POST["password"];
  $repeatPwd = $_POST["cpassword"];

  function EmptyInput($pwd, $repeatPwd)
  { return (empty($pwd or $repeatPwd)); }

  if(EmptyInput($pwd, $repeatPwd) !== false)
  {
    header("location: ../new_pass.php?error=emptyinput");
    exit();
  }else
  {
    $_SESSION["info"] = "";

    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $cpassword = mysqli_real_escape_string($conn, $_POST["cpassword"]);
    if($password !== $cpassword)
    {
      $errors["password"] = "Passwords does not match!";
    }else{
      $otp = 0;
      $email = $_SESSION["email"]; //getting this email using session
      $encryptpass = password_hash($password, PASSWORD_BCRYPT);
      $update_pass = "UPDATE account SET otp = $otp, password = '$encryptpass' WHERE email = '$email'";
      $run_query = mysqli_query($conn, $update_pass);
      if($run_query)
      {
        $info = "You've changed your password! Redirecting to login page...";
        $_SESSION["info"] = $info;
        header( "refresh:5;url=login.php" );
      }else{
        $errors["db-error"] = "Faied to change your password!";
      }
    }
  }
}