<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Search Catalogue</title>
<?php include "header.php"; ?>

<div class="container" style="padding-top: 50px;">
  <div class="selectable-card nav-wrapper">
    <div class="row" style="margin: 0px;">
      <div class="col s6">
        <div class="col">
          <h6>Filter:</h6>
        </div>

        <div class="col">
          <ul id="filter_dropdown" class="dropdown-content">
            <li><a class="cyan-text" href="#!">Dog</a></li>
            <li><a class="cyan-text" href="#!">Food</a></li>
            <li><a class="cyan-text" href="#!">Accessory</a></li>
          </ul>
          <a class="btn dropdown-trigger cyan" data-target="filter_dropdown" style="margin-top: 5px;">
            Select Category
            <i class="material-icons right">arrow_drop_down</i>
          </a>
        </div>
      </div>

      <div class="col s6">
        <div class="col">
          <h6>Sort:</h6>
        </div>

        <div class="col">
          <ul id="sort_dropdown" class="dropdown-content">
            <li><a href="#!">Price low to high</a></li>
            <li><a href="#!">Price high to low</a></li>
            <li><a href="#!">Rating high to low</a></li>
          </ul>
          <a class="btn dropdown-trigger" data-target="sort_dropdown" style="margin-top: 5px;">
            Select Sort Type
            <i class="material-icons right">arrow_drop_down</i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // dropdown
  $('.dropdown-trigger').dropdown();
</script>

<?php include "footer.php"; ?>
</html>