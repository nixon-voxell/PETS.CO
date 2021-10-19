<!DOCTYPE html>
<html lang="en">
<title>PETS.CO</title>
<?php include "header.php"; ?>

<div class="carousel carousel-slider center">
  <div class="carousel-fixed-item center">
    <a class="btn waves-effect waves-teal grey darken-4 cyan-text">Shop!</a>
  </div>
  <a class="carousel-item carousel-magic" href="#"
  style="background-image: url('./static/images/solo_dog.jpg'); background-position-y: 50%;">
    <h2>Dogs</h2>
    <p class="white-text fixed center">We offer the best quality dogs.</p>
  </a>
  <a class="carousel-item carousel-magic" href="#"
  style="background-image: url('./static/images/dog_food.jpg'); background-position-y: 60%;">
    <h2>Food</h2>
    <p class="white-text">Your dog will definitely love our delicious dog food!</p>
  </a>
  <a class="carousel-item carousel-magic" href="#"
  style="background-image: url('./static/images/dog_toy.jpg'); background-position-y: 20%;">
    <h2>Toys</h2>
    <p class="white-text">Have fun with your dog with our toys!</p>
  </a>
</div>

<?php include "footer.php"; ?>

<!-- database table initialization -->
<?php include "includes/init.inc.php"; ?>
</html>