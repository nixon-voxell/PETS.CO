<?php
  require_once "includes/utils/dbhandler.php";
  if (isset($_GET["member_id"]))
  {
    /** @var int $memberID */
    $memberID = $_GET["member_id"];
    $member = Member::CreateMemberFromID($memberID, $conn);
    $cart = $member->GetCart();
    $cartItems = $cart->GetOrderItems();
    $cartItemCount = count($cartItems);
  }
?>

<div class="row">
  <div class="col s8">
    <ul class="collapsible popout" id="cart">
      <!-- generate all rows of items -->
      <?php
        if (isset($cartItems))
        {
          $totalSum = 0;
          for ($c=0; $c < $cartItemCount; $c++)
          {
            $itemID = $cartItems[$c]->GetItemID();
            $item = new Item($itemID, $conn);
            echo(GenerateItem($item->GetName(), $item->GetCategory(), $cartItems[$c]->GetAddedDateTime()));
            $totalSum += $item->GetSellingPrice();
          }
        }
      ?>
    </ul>
  </div>

  <div class="col s4">
    <div class="card brown darken-3">
      <div class="card-content white-text">
        <span class="card-title" style="font-weight: bold;">Cart Details</span>
        <?php
          if (isset($cartItems))
          {
            echo("<p>Total Items: $cartItemCount</p>");
            echo("<p>Delivery Charges: $totalSum</p>");
            echo("<p>Sum Total: </p>");
          } else
          {
            echo("<p>Total Items: 0</p>");
            echo("<p>Delivery Charges: $0.00</p>");
            echo("<p>Sum Total: $0.00</p>");
          }
        ?>
      </div>
      <div class="card-action">
        <a href="#">Empty Cart</a>
      </div>
    </div>
  </div>
</div>