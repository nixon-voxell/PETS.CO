<?php

require_once "data/item.data.php";

/**
 * @param string $itemName
 * @param int $categoryIdx
 * @param string $dateAdded
 * @param int $itemID
*/
function GenerateItem($itemName, $categoryIdx, $dateAdded, $itemID)
{
  $iconName = Item::CATEGORY_ICON[$categoryIdx];
  $categoryName = Item::CATEGORY[$categoryIdx];
  echo(
    "<li>
      <form class='collapsible-header'>
        <i class='material-icons'>$iconName</i>
        <p class='col s10' style='padding: 0px; margin: 0px;'>$itemName</p>
        <button class='btn red darken-4 col s2' style='padding: 0px; margin: 0px;'
        name='remove_item' value='$itemID'
        onclick=\"return confirm('Are you sure you want remove \'$itemName\'?');\">
          Remove Item
        </button>
      </form>
      <div class='collapsible-body row white' style='margin: 0px;'>
        <span class='col s6'>Date Added: $dateAdded</span>
        <span class='col s6'>Category: $categoryName</span>
      </div>
    </li>"
  );
}