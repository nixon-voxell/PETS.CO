<?php

require_once "data/item.data.php";

/**
 * @param string $itemName
 * @param int $categoryIdx
 * @param string $dateAdded
*/
function GenerateItem($itemName, $categoryIdx, $dateAdded)
{
  $iconName = Item::CATEGORY_ICON[$categoryIdx];
  $categoryName = Item::CATEGORY[$categoryIdx];
  return "
  <li>
    <div class='collapsible-header cyan white'><i class='material-icons'>$iconName</i>$itemName</div>
    <div class='collapsible-body row white' style='margin: 0px;'>
      <span class='col s6'>Date Added: $dateAdded</span>
      <span class='col s6'>Category: $categoryName</span>
    </div>
  </li>
  ";
}