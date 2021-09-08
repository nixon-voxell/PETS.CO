<?php
  include "includes/nav.php";
?>
<body>
  <div class = "header">
    <h2><i class="material-icons">sentiment_very_satisfied</i>
      <font size="5">Please Login:</font></h2>
  </div>

  <form method="post" action="includes/login_inc.php">
  <div class="row">
    <div class="input-field col s5">
      <i class="material-icons">stars</i>
      <label>Username or Email</label>
      <input type="text" name="username">
    </div>
  </div>
  <div class="row">
    <div class="input-field col s5">
      <i class="material-icons">stars</i>
      <label>Password</label>
      <input type="password" name="pwd">
    </div>
  </div>
  <div class="row">
    <div class="input-field col s5">
      <button type="submit" name="login" class="btn">Login</button>
    </div>
  </div>
    <p>
      Not yet a member ? <a href="sign_up.php">Sign up</a>
    </p>
  </form>

  <div id="errormsg">
      <?php
        if (isset($_GET["error"])){
          if($_GET["error"] == "emptyinput"){
            echo "<p>*Fill in all fields!<p>";
          }
          else if ($_GET["error"] == "wronglogin"){
            echo "<p>*Incorrect credentials!</p>";
          }
        }
      ?>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
