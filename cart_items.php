<?php
  require_once "includes/utils/dbhandler.php";
  if (isset($_GET["remove_item"]))
  {
    $orderItemID = $_GET["remove_item"];
    $sql = "DELETE FROM OrderItems WHERE OrderItemID = $orderItemID";
    $conn->query($sql) or die($conn->error);
    
    $itemID = $_GET["item_id"];
    $quantity = $_GET["qty"];
    $quantityInStock = $_GET["qty_stock"];
    $quantityInStock += $quantity;
    $sql = "UPDATE Items SET QuantityInStock = $quantityInStock WHERE ItemID = $itemID";
    $conn->query($sql) or die($conn->error);
  }

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

<h4 class="page-title">Cart</h4>
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
            GenerateItem($item, $cartItems[$c], $memberID);
            $totalSum += $item->GetSellingPrice();
          }
          $totalSum = number_format($totalSum, 2);
        }
      ?>
    </ul>
  </div>

  <div class="col s4">
    <div class="rounded-card-parent">
      <div class="card rounded-card tint-glass-cyan blurer">
        <span class="card-title bold">Cart Details</span>
        <form action="checkout.php" method="GET">
          <table class="responsive-table">
            <tbody>
              <?php
                if (isset($cartItems))
                {
                  echo("<tr><th>Total Items:</th><td>$cartItemCount</td></tr>");
                  echo("<tr><th>Delivery Charges:</th><td>$1.00</td></tr>");
                  echo("<tr><th>Sum Total:</th><td>$$totalSum</td></tr>");
                } else
                {
                  echo("<tr><th>Total Items:</th><td>0</td></tr>");
                  echo("<tr><th>Delivery Charges:</th><td>$0.00</td></tr>");
                  echo("<tr><th>Sum Total:</th><td>$0.00</td></tr>");
                }
              ?>
            </tbody>
          </table>
          <?php if (!isset($_GET["view_order"])) { ?>
          <button class="btn orange darken-3" style="margin-top: 10px;">
            Checkout
          </button>
          <input type="hidden" name="empty_cart" value=1>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>