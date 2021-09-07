<?php
  include 'nav.php';
?>

<body>
  <div class="container">
    <h2 class="black-text">
      Register an account
    </h2>
    <form class="col s12">
      <div class="row">
        <div class="input-field col s5">
          <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" type="text" class="validate">
          <label for="icon_prefix">Username</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s5">
          <i class="material-icons prefix"> password</i>
          <input id="password" type="password" class="validate">
          <label for="password"> Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s5">
          <i class="material-icons prefix"> password</i>
          <input id="confirmpassword" type="password" class="validate">
          <label for="Confirm Password"> Confirm Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s5">
          <i class="material-icons prefix">email</i>
          <input id="email" type="email" class="validate">
          <label for="email">Email</label>
          <span class="helper-text" data-error="wrong" data-success="right">Helper text</span>
        </div>
      </div>
      <p>
        <input class="btn btn-block" type="submit" value="Register">
      </p>
    </form>
  </div>
</body>
</html>