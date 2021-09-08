<?php
  include "includes/nav.php";
?>

<body>
  <div class="container">
    <h2 class="black-text">
      Register an account
    </h2>
    <form class="col s12" action="includes/signup_inc.php" method="post">
      <div class="row">
        <div class="input-field col s5">
          <i class="material-icons prefix">account_circle</i>
          <input name="username" type="text" class="validate" maxlength="12">
          <label for="username">Username</label>
          <span class="helper-text" data-error="wrong" data-success="right">Max 12 characters</span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s5">
          <i class="material-icons prefix"> password</i>
          <input name="pwd" type="password" class="validate" maxlength="14">
          <label for="password"> Password</label>
          <span class="helper-text" data-error="wrong" data-success="right">Max 14 characters</span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s5">
          <i class="material-icons prefix"> password</i>
          <input name="repeatPwd" type="password" class="validate" maxlength="14">
          <label for="repeatPwd"> Repeat Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s5">
          <i class="material-icons prefix">email</i>
          <input name="email" type="email" class="validate" maxlength="25">
          <label for="email">Email</label>
          <span class="helper-text" data-error="wrong" data-success="right"></span>
        </div>
      </div>
      <input class="btn btn-block" type="submit" name="submit" value="Register">
    </form>

    <div id="errormsg">
      <?php
        if (isset($_GET["error"])){
          if($_GET["error"] == "emptyinput"){
            echo "<p>*Fill in all fields!<p>";
          }
          else if ($_GET["error"] == "invaliduid"){
            echo "<p>*Choose a proper username!</p>";
          }
          else if ($_GET["error"] == "invalidemail"){
            echo "<p>*Choose a proper email!</p>";
          }
          else if ($_GET["error"] == "passwordsdontmatch"){
            echo "<p>*Passwords doesn't match!</p>";
          }
          else if ($_GET["error"] == "stmtfailed"){
            echo "<p>*Something went wrong, please try again!</p>";
          }
          else if ($_GET["error"] == "usrnametaken"){
            echo "<p>*Username already taken!</p>";
          }
          else if ($_GET["error"] == "none"){
            echo "<p>You have signed up! Redirecting to home page...</p>";
          }
        }
      ?>
  </div>

</body>
</html>