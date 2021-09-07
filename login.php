<?php
include 'nav.php';
?>

<body>
  <div class = "header">
    <h2><i class="material-icons">sentiment_very_satisfied</i>
      <font size="5">Please Login:</font></h2>
  </div>

  <form method="post" action="login.html">
    <div class="input-group">
      <i class="material-icons">stars</i>
      <label>Username</label>
      <input type="text" name="username">
    </div>

    <div class="input-group">
      <i class="material-icons">stars</i>
      <label>Password</label>
      <input type="password" name="password">
    </div>

    <div class="input-group">
      <button type="submit" name="login" class="btn">Login</button>
    </div>
    
    <p>
      Not yet a member ? <a href="sign_up.html">Sign up</a>
    </p>
  </form> 

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body> 
</html> 
