<?php
?>
<h4 class="white-text page-title">Previous Orders</h4>
<h5 class="white-text">#1</h5>
<div class="row">
  <div class="col s8">
    <ul class="collapsible popout black-text" id="orders">
      <li>
        <form class="collapsible-header">
          <i class="material-icons">filter_drama</i>
          <p class="col s10" style="padding: 0px; margin: 0px;">First</p>
          <button class="btn red darken-4 col s2" style="padding: 0px; margin: 0px;"
          name='delete' value='$deleteid'
          onclick="return confirm('Are you sure you want remove this item?');">Remove Item</button>
        </form>
        <div class="collapsible-body row white" style="margin: 0px;">
          <span class="col s6">Date Added: </span>
          <span class="col s6">Category: Pet</span>
        </div>
      </li>
      <li>
        <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
        <div class="collapsible-body row white" style="margin: 0px;">
          <span class="col s6">Date Added: </span>
          <span class="col s6">Category: Pet</span>
        </div>
      </li>
      <li>
        <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
        <div class="collapsible-body row white" style="margin: 0px;">
          <span class="col s6">Date Added: </span>
          <span class="col s6">Category: Pet</span>
        </div>
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