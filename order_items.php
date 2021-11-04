<?php
  require_once "includes/utils/dbhandler.php";
  if (isset($_GET["member_id"]))
  {
    /** @var int $memberID */
    $memberID = $_GET["member_id"];
    $member = Member::CreateMemberFromID($memberID, $conn);
    $orders = $member->GetOrders();
    $orderCount = count($orders);
  }
?>

<h4 class="page-title">Previous Orders</h4>
<h5 class="white-text">#1</h5>
<div class="row">
  <div class="col s8">
    <ul class="collapsible popout black-text" id="orders">
      <li>
        <form class="collapsible-header collapsible-card bold">
          <i class="material-icons">filter_drama</i>
          <p class="col s10" style="padding: 0px; margin: 0px;">First</p>
          <button class="btn red darken-4 col s2" style="padding: 0px; margin: 0px;"
          name='delete' value='$deleteid'
          onclick="return confirm('Are you sure you want remove this item?');">Remove Item</button>
        </form>
        <div class="collapsible-body row collapsible-card bold" style="margin: 0px;">
          <div class="col s6">
            <span>Date Added:</span>
            <span class="light-weight-text">2020-10-8</span>
          </div>
          <div class="col s6">
            <span>Category:</span>
            <span class="light-weight-text">Pet</span>
          </div>
        </div>
      </li>
    </ul>
  </div>

  <div class="col s4">
    <div class="rounded-card-parent">
      <div class="card rounded-card tint-glass-brown">
        <div class="card-content white-text">
          <span class="card-title bold">Order Details</span>
          <table class="responsive-table">
            <tbody>
              <tr><td>Total Items:</td><td>0</td></tr>
              <tr><td>Delivery Charges:</td><td>$0.00</td></tr>
              <tr><td>Sum Total:</td><td>$0.00</td></tr>
              <tr><td>Date:</td><td>2021-11-4</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>