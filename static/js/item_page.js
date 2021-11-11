const MAX_QUANTITY = document.getElementById("max-quantity").value;
const QTY = document.getElementById("qty");
const SYNC_QTY = document.getElementById("sync-qty");

// make sures that the number does not exceeds the quantity in stock
function numberChanged()
{
  QTY.value = Math.max(Math.min(MAX_QUANTITY, QTY.value), 0);
  SYNC_QTY.value = QTY.value;
}

function addQty()
{
  var value = parseInt(QTY.value);
  QTY.value = value + 1;
  numberChanged();
}

function subtractQty()
{
  QTY.value -= 1;
  numberChanged();
}

function addToCart()
{
  var value = parseInt(QTY.value);
  if (value != 0)
    return confirm('Are you sure you want to add this item to cart?');
  else alert("There is nothing to add!");
}