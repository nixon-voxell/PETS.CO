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
    <h2>DOGS</h2>
    <p class="white-text fixed center">Find your fur-ever family member. <br> We offer the best quality dogs at the best price. </p>
  </a>
  <a class="carousel-item carousel-magic" href="#"
  style="background-image: url('./static/images/dog_food.jpg'); background-position-y: 60%;">
    <h2>FOOD</h2>
    <p class="white-text">At Pets.co, we strive to provide the best for your dogs by sourcing only the best wholesome products. <br> We are dog lovers too! Your dog will definitely love our delicious dog food!</p>
  </a>
  <a class="carousel-item carousel-magic" href="#"
  style="background-image: url('./static/images/dog_toy.jpg'); background-position-y: 20%;">
    <h2>ACCESSORIES</h2>
    <p class="white-text">Give your dog the most comfortable life with our accessories!</p>
  </a>
</div>

<div class="container">
  <div class="row">
    <div class="col s12 m6">
      <div class="rounded-card-parent">
        <div class="card rounded-card">
          <div class="card-content white-text">
            <span class="card-title">Card Title</span>
            <p>I am a very simple card. I am good at containing small bits of information.
            I am convenient because I require little markup to use effectively.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="col s12 m6">
      <div class="rounded-card-parent">
        <div class="card rounded-card">
          <div class="card-content white-text">
            <span class="card-title">Card Title</span>
            <p>I am a very simple card. I am good at containing small bits of information.
            I am convenient because I require little markup to use effectively.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

<!-- database table initialization -->
<?php include "includes/init.inc.php"; ?>
</html>