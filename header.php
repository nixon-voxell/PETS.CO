<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./static/css/base.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="./static/materialize/js/materialize.js"></script>
</head>

<?php 
  include "includes/data/member.data.php";
  include "includes/data/order.data.php";
  include "includes/data/order_item.data.php";
  include "includes/data/item.data.php";
  include "includes/data/review.data.php";
  include_once "includes/utils/common_util.php";
  session_start();

  if (isset($_SESSION["Member"]))
  {
    /** @var Member $member */
    $member = $_SESSION["Member"];
    // write_log($member);
    $memberID = $member->GetMemberID();
    $username = $member->GetUsername();
    $email = $member->GetEmail();
    $privilegeLevel = $member->GetPriviledgeLevel();
    $cart = $member->GetCart();
    $orders = $member->GetOrders();
  }
?>

<body>
  <nav style="height: 100px";>
    <div class="nav-wrapper black">
      <a href="index.php"><img src = "logo.svg" alt="logo" id="logo" class="brand-logo" height="100"/></a>

      <ul class="right hide-on-med-and-down">
        <?php
          if (isset($_SESSION["Member"]))
          { ?>
            <li class="grey darken-4"
            style="height: 60px; width: 400px; border-radius: 20px; margin-top: 20px;
            box-shadow: 0px 0px 10px cyan; margin-right: 20px;">
              <form action="search_catalogue.php">
                <div class="white-text row" style="padding-right: 40px; padding-left: 20px;">
                  <i class="material-icons col s2">search</i>
                  <!-- remain the last search name -->
                  <input type="text" name="search_name" placeholder="Search"
                    class="white-text col s10 autocomplete-content"
                    value="<?php if (isset($_GET["search_name"])) echo($_GET["search_name"]); ?>">
                </div>
              </form>
            </li>
          <?php if ($privilegeLevel == 1)
              echo "<li><a class='admin admin_manage_users admin_view_orders' href='admin.php'>Admin Panel</a></li>";
            echo "<li><a class='cart' href='cart.php?member_id=$memberID'>Cart<span class='new badge unglow' id='cart_badge'>0</span></a></li>";
            echo "<li><a class='manage_profile' href='manage_profile.php?email=$email'>Manage Profile</a></li>";
            echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
          } else
          {
            echo "<li><a class='login' href='login.php'>Login</a></li>";
            echo "<li><a class='signup' href='signup.php'>Sign Up</a></li>";
          }
          ?>
      </ul>
    </div>
  </nav>
    
  <script src="./static/js/header.js"></script>
  <div class="content">