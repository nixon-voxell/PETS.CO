<?php
  require_once "includes/utils/dbhandler.php";
  if (isset($_GET["member_id"]))
  {
    /** @var int $memberID */
    $memberID = $_GET["member_id"];
    $member = Member::CreateMemberFromID($memberID, $conn);
    $cart = $member->GetCart();
    $cartID = $cart->GetOrderID();
    $cartItems = $cart->GetOrderItems();
    $cartItemCount = count($cartItems);
  }

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
    header("location: cart.php?member_id=$memberID");
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
          $sumTotal = 0;
          for ($c=0; $c < $cartItemCount; $c++)
          {
            $orderItem = $cartItems[$c];
            $item = new Item($orderItem->GetItemID(), $conn);
            GenerateItem($item, $orderItem, $memberID);

            $quantity = $orderItem->GetQuantity();
            $price = $orderItem->GetPrice();
            $sumTotal += $price * $quantity;
          }
          $sumTotal = number_format($sumTotal+1, 2);
        }
      ?>
    </ul>
  </div>

  <div class="col s4">
    <div class="rounded-card-parent">
      <div class="card rounded-card tint-glass-cyan blurer">
        <span class="card-title bold">Cart Details</span>
        <form action="checkout_payment.php" method="GET">
          <table class="responsive-table">
            <tbody>
              <?php
                echo("<tr><th>Total Items:</th><td>$cartItemCount</td></tr>");
                echo("<tr><th>Delivery Charges:</th><td>$1.00</td></tr>");
                echo("<tr><th>Sum Total:</th><td>$$sumTotal</td></tr>");
              ?>
            </tbody>
          </table>
          <?php if (!isset($_GET["view_order"]) && $cartItemCount > 0) { ?>
          <button class="btn orange darken-3" style="margin-top: 10px;">
            Checkout
          </button>
          <input type="hidden" name="order_id" value=<?php echo($cartID); ?>>
          <input type="hidden" name="view_order" value=1>
          <input type="hidden" name="member_id" value=<?php echo($memberID) ?>>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>