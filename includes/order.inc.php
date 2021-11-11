<?php

require_once "data/item.data.php";

/**
 * @param Item $item
 * @param OrderItem $cartItem
*/
function GenerateItem($item, $cartItem, $memberID)
{
  $itemID = $item->GetItemID();
  $quantityInStock = $item->GetQuantityInStock();
  $itemName = $item->GetName();
  $categoryIdx = $item->GetCategory();
  $iconName = Item::CATEGORY_ICON[$categoryIdx];
  $categoryName = Item::CATEGORY[$categoryIdx];

  $dateAdded = $cartItem->GetAddedDateTime();
  $price = $cartItem->GetPrice();
  $price = "$" . $price;
  $quantity = $cartItem->GetQuantity();
  $quantityDisplay = "x" . $quantity;
  $orderItemID = $cartItem->GetOrderItemID();
  echo(
    "<li>
      <form method='GET' class='collapsible-header collapsible-card bold'>
        <input type='hidden' name='member_id' value=$memberID>
        <input type='hidden' name='item_id' value=$itemID>
        <input type='hidden' name='qty' value=$quantity>
        <input type='hidden' name='qty_stock' value=$quantityInStock>
        <i class='material-icons'>$iconName</i>

        <p class='col s3' style='padding: 0px; margin: 0px;'>$itemName</p>
        <p class='col s3' style='padding: 0px; margin: 0px;'>$price</p>
        <p class='col s3' style='padding: 0px; margin: 0px;'>$quantityDisplay</p>

        <a class='btn orange darken-4 col s1 light-weight-text' style='margin-right: 5px; padding: 0px;'
          href='item_page.php?item_id=$itemID'>
          Inspect
        </a>
        <button class='btn red darken-4 col s1' style='padding: 0px; margin: 0px;'
          name='remove_item' value='$orderItemID'
          onclick=\"return confirm('Are you sure you want remove \'$itemName\'?');\">
          Remove
        </button>
      </form>
      <div class='collapsible-body row collapsible-card bold' style='margin: 0px;'>
        <div class='col s6'>
          <span>Date Added:</span>
          <span class='light-weight-text'>$dateAdded</span>
        </div>
        <div class='col s6'>
          <span>Category:</span>
          <span class='light-weight-text'>$categoryName</span>
        </div>
      </div>
    </li>"
  );
}