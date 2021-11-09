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
      $itemID = $items[$itemIdx]->GetItemID();
      $image = $items[$itemIdx]->GetImage();
      echo(
        "<div class='col s3'>
          <div href='item_page.php?item_id=$itemID'
            class='selectable-card'>
            <img class='shadow-img' src='images/$image' style='width:250px;'>
          </div>
        </div>"
      );
    }
    echo("</div>");
  }
}