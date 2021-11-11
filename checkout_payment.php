<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Checkout Payment</title>
<?php include "header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

<style>
.icon-container
{
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 40px;
}
</style>

<?php include "includes/order.inc.php" ?>
<?php require_once "includes/utils/dbhandler.php" ?>

<div class="wide-container" style="margin-bottom: 40px;">
  <?php include "cart_items.php" ?>
  <div class="rounded-card-parent">
    <div class="rounded-card card-content">
      <h4 class="orange-text">Payment</h4>
      <form class="col s12 white-text"
        action="checkout_payment.php?order_id=<?php echo($_GET["order_id"]) ?>&member_id=<?php echo($_GET["member_id"]) ?>&view_order=1"
        method="POST" style="margin-left: 50px;">
        <div class="row">
          <div class="input-field col s3">
            <i class="material-icons prefix">account_circle</i>
            <input id="name" type="text" placeholder="XXX XXX XXX" name="card_name" class="validate white-text">
            <label class="active cyan-text" for="name">Name on Card</label>
            <span class="helper-text grey-text" data-error="CardHolder Name" data-success="CardHolder Name"></span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s3">
            <i class="material-icons prefix">badge</i>
            <input placeholder="0000 0000 0000 0000" id="card_number" name="card_number" type="text" class="validate white-text">
            <label class="active cyan-text" for="card_number">Card Number</label>
            <span class="helper-text grey-text" data-error="Invalid Card Number" data-success="Valid Card Number"></span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s2">
            <i class="material-icons prefix">date_range</i>
            <input id="icon_prefix" type="tel" name="exp_month" class="validate white-text">
            <label for="icon_prefix">Exp Month</label>
            <span class="helper-text grey-text" data-error="Invalid Exp Month" data-success="Valid Exp Month"></span>
          </div>
          <div class="input-field col s2">
            <i class="material-icons prefix">event</i>
            <input id="icon_telephone" type="tel" name="exp_year" class="validate white-text">
            <label for="icon_telephone">Exp Year</label>
            <span class="helper-text grey-text" data-error="Invalid Exp Year" data-success="Valid Exp Year"></span>
          </div>
          <div class="input-field col s2">
            <i class="material-icons prefix">confirmation_number</i>
            <input id="icon_telephone" type="tel" name="cvv" class="validate white-text">
            <label for="icon_telephone">CVV</label>
            <span class="helper-text grey-text" data-error="Invalid CVV" data-success="Valid CVV"></span>
          </div>

          <div class="rounded-card col s3 right" style="background-color: white; text-align:center; margin-right: 140px">
            <div class="card-content">
              <label style="font-weight: bold; font-size: 24px;">Accepted Cards</label>
              <div class="icon-container">
                <i class="fa fa-cc-visa" style="color: navy"></i>
                <i class="fa fa-cc-amex" style="color: blue"></i>
                <i class="fa fa-cc-mastercard" style="color: red"></i>
                <i class="fa fa-cc-discover" style="color: orange"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s3">
            <i class="material-icons prefix">home</i>
            <input placeholder="House No, Street, District, Zip, State" id="home" name="address" type="text" class="validate white-text">
            <label class="active cyan-text" for="home">Billing Address</label>
            <span class="helper-text grey-text" data-error="Invalid Address" data-success="Valid Address"></span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s2">
            <select name="country">
              <option value="" disabled selected>Choose</option>
              <option value="1">Malaysia</option>
            </select>
            <label class="cyan-text">Country</label>
          </div>
          <div class="input-field col s2">
          <i class="material-icons prefix">map</i>
            <input id="icon_telephone" type="tel" name="state" class="validate white-text">
            <label for="icon_telephone">State</label>
            <span class="helper-text grey-text" data-error="Invalid State" data-success="Valid State"></span>
          </div>
          <div class="input-field col s2">
          <i class="material-icons prefix">place</i>
            <input id="icon_telephone" type="tel" name="zip" class="validate white-text">
            <label for="icon_telephone">Zip</label>
            <span class="helper-text grey-text" data-error="Invalid Zip Code" data-success="Valid Zip Code"></span>
          </div>
        </div>
        <div class="errormsg">
          <?php
            if (isset($_GET["error"]))
            {
              if ($_GET["error"] == "empty_input")
                echo "<p>*Fill in all fields!<p>";
            }
          ?>
        </div>
        <button type="submit" name="payment" class="btn">Confirm Payment</button>
      </form>
    </div>
  </div>
</div>

<?php
  function EmptyInputPayment($name, $number, $month, $year, $cvv, $address, $country, $state, $zip)
  { return empty($name) || (empty($number)) || (empty($month)) || (empty($year)) || (empty($cvv)) 
    || (empty($address)) || (empty($country)) || (empty($state)) || (empty($zip)); }

  if (isset($_POST["payment"])) 
  {
    $name = $_POST["card_name"];
    $number = $_POST["card_number"];
    $month = $_POST["exp_month"];
    $year = $_POST["exp_year"];
    $cvv = $_POST["cvv"];
    $address = $_POST["address"];
    $country = $_POST["country"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];

    if (EmptyInputPayment($name, $number, $month, $year, $cvv, $address, $country, $state, $zip))
    {
      $orderID = $_GET["order_id"];
      $memberID = $_GET["member_id"];
      echo("<script>location.href = 'checkout_payment.php?error=empty_input&order_id=$orderID&member_id=$memberID&view_order=1';</script>");
      exit();
    }

    if (isset($_GET["order_id"]))
    {
      $orderid = $_GET["order_id"];
      $sql = "INSERT INTO Payment(OrderID, PaymentDate)
        VALUES($orderid, CURRENT_TIME)";
      $conn->query($sql) or die($conn->error);

      $sql = "UPDATE Orders SET CartFlag = 0 WHERE OrderID = $orderid";
      $conn->query($sql) or die($conn->error);

      $sql = "INSERT INTO Orders(MemberID, CartFlag)
        VALUES($memberID, 1)";
      $conn->query($sql) or die($conn->error);
      echo("<script>location.href = 'payment_successful.php';</script>");
      exit();
    }
  }
?>

<script>
  $(document).ready(function(){
    $('select').formSelect();
  });
</script>


<?php include "footer.php"; ?>
</html>