<?php
require_once "utils/dbhandler.php";
require_once "data/item.data.php";

const CATEGORY_NAMES = ["Dog", "Food", "Accessory"];
const SORT_NAMES = ["Price low to high", "Price high to low", "Rating high to low"];

/**
 * @param Item[] $items
 */
function GenerateItemList($items)
{
  $itemCount = count($items);

  $itemIdx = 0;
  while ($itemIdx < $itemCount)
  {
    echo("<div class='row'>");
    // generate 4 items in a row
    for ($i=0; $itemIdx < $itemCount && $i < 4; $i++, $itemIdx++)
    {
      $item = $items[$itemIdx];
      if ($item->GetQuantityInStock() <= 0) continue;

      $itemID = $item->GetItemID();
      $image = $item->GetImage();
      $name = $item->GetName();
      $brand = $item->GetBrand();
      $price = $item->GetSellingPrice();
      $price = "$" . number_format($price, 2);
      echo(
        "<div class='col s3'>
          <a href='item_page.php?item_id=$itemID'>
            <div class='selectable-card' style='height: 450px; min-width: 300px'>
              <img class='shadow-img' src='images/$image' style='max-height: 200px; max-width: 250px;'>
              <table>
                <tbody>
                  <tr><th>Name: </th><td>$name</td></tr>
                  <tr><th>Brand: </th><td>$brand</td></tr>
                  <tr><th>Price: </th><td>$price</td></tr>
                </tbody>
              </table>
            </div>
          </a>
        </div>"
      );
    }
    echo("</div>");
  }
}