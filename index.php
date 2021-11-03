<!DOCTYPE html>
<html lang="en">
<title>PETS.CO</title>
<?php include "header.php";?>

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

<div class="row container" style="text-align: center; margin-bottom: 100px">
  <h3 class="white-text page-title">The largest community of pets enthusiasts</h3>
</div>

<div class="container">
  <div class="row">
    <div class="row">
      <h4 class="white-text page-title" style="display: inline;;">Categories</h4>
      <a href="#" class="page-title yellow-text" style="display: inline;">Shop All></a>
    </div>
    <div class="col">
      <div class="selectable-card">
        <?php include_once "dog.html"; ?>
        <h5 class="orange-text center bold">DOG</h5>
      </div>
    </div>

    <div class="col">
      <div class="rounded-card-parent">
        <div class="card rounded-card white">
          <a href="https://petico.my/brit-care/">
            <img src="dog_food.jpg" width="220" height="150">
            <h5 class="green-text center">Food</h5>
          </a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="rounded-card-parent">
        <div class="card rounded-card white">
          <a href="https://petico.my/alps/">
            <img src="dog_accessory.webp" width="220" height="150">
            <h5 class="green-text center">Accessories</h5>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="row">
      <h4 class="white-text page-title" style="display: inline;">Best Sellers On Sale</h4>
      <a href="#" class="page-title yellow-text" style="display: inline;">Shop All></a>
    </div>
    <div class="col s12 m3">
      <div class="rounded-card-parent">
        <div class="card rounded-card white center">
          <a href="https://petico.my/royal-canin-maxi-adult-15kg-dry-dog-food.html">
            <img src="https://petico.my/image/cache/catalog/PRODUCTS/ROYAL%20CANIN/DOG/Size%20Health/Adult/Maxi%20Adult/SHN%20Maxi%20Adult%20Hero%201-250x250.jpg" width="250" height="300" style="padding-right: 30px">            
          </a>
          <div class="ratings">
            <div class="empty-stars"></div>
            <div class="full-stars" style="width:100%"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col s12 m3">
      <div class="rounded-card-parent">
        <div class="card rounded-card white center">
          <a href="https://petico.my/brit-premium-by-nature-adult-l-15-kg-dry-dog-food.html">
            <img src="https://petico.my/image/cache/catalog/PRODUCTS/BRIT%20PREMIUM/brit-premium-by-nature-adult-l-15-kg-dry-dog-food-648-250x250h.jpg" width="250" height="300" style="padding-right: 30px">
          </a>
          <div class="ratings">
            <div class="empty-stars"></div>
            <div class="full-stars" style="width:92.5%"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col s12 m3">
      <div class="rounded-card-parent center">
        <div class="card rounded-card white">
          <a href="https://petico.my/instinct-dog-be-natural-real-salmon-and-brown-rice-recipe-2kg-dry-dog-food.html">
            <img src="https://petico.my/image/cache/catalog/PRODUCTS/INSTINCT/DOG/Be%20Natural/Be%20Natural%20Salmon%202kg%20652892-250x250.jpg" width="250" height="300" style="padding-right: 30px">               
          </a>
          <div class="ratings">
            <div class="empty-stars"></div>
            <div class="full-stars" style="width:90%"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col s15 m3">
      <div class="rounded-card-parent">
        <div class="card rounded-card white center">
          <a href="https://petico.my/instinct-dog-be-natural-real-salmon-and-brown-rice-recipe-2kg-dry-dog-food.html">
            <img src="https://www.alpsnaturalpetfood.com/wp-content/uploads/2021/06/Alps-Pureness-Canned-Free-Range-Beef-Pate-Recipe-1.png" width="250" height="300" style="padding-right: 60px">  
          </a>
          <div class="ratings">
            <div class="empty-stars"></div>
            <div class="full-stars" style="width:88.88%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row center" style="margin-top: 150px">
    <h2 class="white-text page-title">You're in good company</h2>
    <h5 class="white-text page-title">
      <b class="orange-text">At Pets.co</b>, we strive for <b class="orange-text">PETS</b>. These guiding principles define our commitment and promise to serve you better by working towards our mutual goals.
    </h5>
  </div>

  <div class="row center" style="margin-bottom: 150px">
    <div class="col s12 m3">
      <div class="rounded-card-parent">
        <div class="card rounded-card black">
          <img src="static/values_images/P.jpg" width="200" height="200">
          <h5 class="orange-text bold center" style="display: inline; vertical-align: top">P</h5><h5 class="white-text bold center" style="display: inline; vertical-align: top">REMIUM<h5>
        </div>
      </div>
    </div>

    <div class="col s12 m3">
      <div class="rounded-card-parent">
        <div class="card rounded-card black">
          <img src="static/values_images/E.png"width="200" height="200">
          <h5 class="orange-text bold center" style="display: inline; vertical-align: top">E</h5><h5 class="white-text bold center" style="display: inline; vertical-align: top">NTHUSIATIC<h5>
        </div>
      </div>
    </div>

    <div class="col s12 m3">
      <div class="rounded-card-parent">
        <div class="card rounded-card black">
          <img src="static/values_images/T.png"  width="200" height="200">
          <h5 class="orange-text bold center" style="display: inline; vertical-align: top">T</h5><h5 class="white-text bold center" style="display: inline; vertical-align: top">RUSTWORTY<h5>
        </div>
      </div>
    </div>

    <div class="col s12 m3">
      <div class="rounded-card-parent">
        <div class="card rounded-card black">
          <img src="static/values_images/S.jpg" width="200" height="200">
          <h5 class="orange-text bold center" style="display: inline; vertical-align: top">S</h5><h5 class="white-text bold center" style="display: inline; vertical-align: top">AFETY<h5>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

<!-- database table initialization -->
<?php include "includes/init.inc.php"; ?>
</html>