<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - View Orders Panel</title>
</head>
<?php 
  include "header.php";
  include "includes/admin.inc.php";
  require_once "includes/utils/dbhandler.php";
?>

<?php include "admin_nav_bar.php"; ?>

<?php include "side_nav.html"; ?>

<!-- manage users start -->
<div class="container">
  <h3 class="page-title white-text">Customers Cart/Orders </h3>
  <div class="row" style="padding-bottom: 10px;">
    <div class="rounded-card-parent">
      <div class="card rounded-card">
        <div class="card-content white-text">
          <span class="card-title orange-text bold">Customers List</span>
          <form class="row" action="admin_view_orders.php" method="POST" style="margin: 0px;">
            <div class="input-field col s3 white-text">
              <input name="search_member" type="text" class="validate; white-text" maxlength="20">
              <label for="search_member">Search member by name</label>
              <span class="helper-text" data-error="text only" data-success="correct"></span>
            </div>
          </form>
          <table class="responsive-table">
            <thead>
              <tr><th>Username</th><th>Email</th><th>MemberID</th><th></th></tr>
            </thead>
            <tbody>
              <?php 
                if (isset($_POST["search_member"]))
                {
                  $searchMember = $_POST["search_member"];

                  if (EmptyInputSelectUser($searchMember))
                    echo "<p class='prompt-warning'>Please enter a value!<p>";
                  else
                  {
                    $sql = "SELECT * FROM Members WHERE Username LIKE '%$searchMember%' ORDER BY Username";
                    $result = $conn->query($sql) or die ("Select statement FAILED!");
                    while ($row = $result->fetch_assoc()) 
                    {
                      $memberID = $row["MemberID"];
                      $searchMember = $row["Username"];
                      $email = $row["Email"];
                      echo(
                        "<tr>
                          <td>$searchMember</td>
                          <td>$email</td>
                          <td>$memberID</td>
                          <td>
                            <button name='view_order' value='$memberID' class='btn'>
                              <i class='material-icons'>search</i>
                            </button>
                          </td>
                        </tr>"
                      );
                    }
                  }
                }

                // if searchMember is not set or searchMember is empty
                if (!isset($searchMember) || EmptyInputSelectUser($searchMember))
                {
                  // limited search to prevent page overflow
                  $sql = "SELECT * FROM Members ORDER BY Username LIMIT 20";
                  $result = $conn->query($sql) or die($conn->error);
                  while ($row = $result->fetch_assoc()) 
                  {
                    $memberID = $row["MemberID"];
                    $searchMember = $row["Username"];
                    $email = $row["Email"];
                    echo(
                      "<tr>
                        <td>$searchMember</td>
                        <td>$email</td>
                        <td>$memberID</td>
                        <td>
                          <form action='admin_view_orders.php' method='GET'>
                            <input type='hidden' name='username' value='$searchMember'/>
                            <input type='hidden' name='member_id' value='$memberID'/>
                            <button name='view_order' value=1 class='btn' type='submit'>
                              <i class='material-icons'>search</i>
                            </button>
                          </form>
                        </td>
                      </tr>"
                    );
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php if (isset($_GET["view_order"])) { ?>
    <div class="rounded-card-parent">
      <div class="card rounded-card">
        <div class="card-content">
          <span class="card-title cyan-text bold">
            Cart/Order Details
            <?php echo("[".$_GET["username"]."]");?>
          </span>
            <?php
              // View Selected Customer Cart/Orders 
              if (isset($_GET["view_order"]))
              {
                $uid = $_GET["view_order"];
                include_once "cart_items.php";
                include_once "order_items.php";
              }  
            ?>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<script>
  $(document).ready(function () 
  {
    $(".sidenav").sidenav();
  });
</script>

<?php include "footer.php"; ?>