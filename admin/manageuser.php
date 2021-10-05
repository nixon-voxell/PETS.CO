<?php
session_start();
include("../includes/utils/dbhandler.php");
include("../includes/utils/common_util.php");

// For testing write_log()
if(isset($_GET['action'])){

}

if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{
  $user_id = $_GET['user_id'];
  mysqli_query($conn,"delete from members where id='$user_id'")or die("SQL Delete Failed.");
}
  
include "sidenav.php";
include "topheader.php";
?>

<div class="content">
  <div class="container-fluid">
    <div class="col-md-14">
      <div class="card">
        <div class="card-header card-haeder-primary">
          <h4 class="card-title">Manage User</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table tablesorter table-hover" id="">
            <thead class="text-primary">
              <tr><th>User Name</th>
              <th>Email</th>
              <th>Privilege level</th>
              <th><a href="adduser.php" class="btn btn-success">Add New</a></th>
            </tr></thead>
            <tbody>
              <?php
              $result=mysqli_query($conn,"select id, username, email, priviledge_level from members order by username") or die ("SQL Select FAILED!");

              while (list($id, $username, $email, $privilege_level)=mysqli_fetch_array($result))
              {
                echo "<tr>
                <td>$username</td><td>$email</td><td>privilege_level</td>";

                echo    "<td>
                          <a href='edituser.php?user_id=$id' type='button' rel='tooltip' title='' class='btn btn-info btn-link btn-sm' data-original-title='Edit User'>
                          <i class='material-icons'>edit</i>
                          <div class='ripple-container'></div></a>
                          <a href='manageuser.php?user_id=$id&action=delete' type='button' rel='tooltip' title='' class='btn btn-danger btn-link btn-sm' data-original-title='Delete User'>
                          <i class='material-icons'>close</i>
                          <div class='ripple-container'></div></a>
                        </td>
                      </tr>";
              }
              mysqli_close($conn);
              ?>
            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>