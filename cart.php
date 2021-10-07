<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Cart</title>
<?php include "header.php"; ?>

<div class="wide-container">
  <h4 class="grey-text">Cart</h4>

  <div class="row">
    <div class="col s8">
      <ul class="collapsible popout" id="cart">
        <li>
          <div class="collapsible-header"><i class="material-icons">pets</i>First</div>
          <div class="collapsible-body row" style="margin: 0px;">
            <span class="col s6">Date Added: </span>
            <span class="col s6">Category: Pet</span>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">toys</i>Second</div>
          <div class="collapsible-body row" style="margin: 0px;">
            <span class="col s6">Date Added: </span>
            <span class="col s6">Category: Accessory</span>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">restaurant</i>Third</div>
          <div class="collapsible-body row" style="margin: 0px;">
            <span class="col s6">Date Added: </span>
            <span class="col s6">Category: Food</span>
          </div>
        </li>
      </ul>
    </div>

    <div class="col s4">
      <div class="card brown darken-3">
        <div class="card-content white-text">
          <span class="card-title" style="font-weight: bold;">Cart Details</span>
          <p>Total Items: </p>
          <p>Delivery Charges: </p>
          <p>Sum Total: </p>
        </div>
        <div class="card-action">
          <a href="#">Empty Cart</a>
        </div>
      </div>
    </div>
  </div>

  <h4 class="grey-text">Previous Orders</h4>
  <h5 class="text-blue-grey">#1</h5>
  <div class="row">
    <div class="col s8">
      <ul class="collapsible popout" id="orders">
        <li>
          <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
          <div class="collapsible-body"><span>Date Added: </span></div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
          <div class="collapsible-body"><span>Date Added: </span></div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
          <div class="collapsible-body"><span>Date Added: </span></div>
        </li>
      </ul>
    </div>

    <div class="col s4">
      <div class="card grey darken-3">
        <div class="card-content white-text">
          <span class="card-title" style="font-weight: bold;">Order Details</span>
          <p>Total Items: </p>
          <p>Delivery Charges: </p>
          <p>Sum Total: </p>
          <p>Date: </p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
</html>