<?php
session_start();
include("../includes/utils/dbhandler.php");
include("../includes/utils/common_util.php");
write_log("print-7--".$id);
$id = $_GET['user_id'];
$result=mysqli_query($conn,"select id, username, email, password, priviledge_level from members where id = '$id'")or die ("SQL Select Statement Failed!");

list($id, $username, $email, $password, $priviledge_level)= mysqli_fetch_array($result);


if(isset($_POST['btn_save']))
{
  $id=$_POST['user_id'];
  write_log("print-8--".$id);
  
  $username=$_POST['username'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $priviledge_level=$_POST['priviledge_level'];

  $hashedPwd=password_hash($password, PASSWORD_DEFAULT);

  mysqli_query($conn, "update members set username='$username', email='$email', password='$hashedPwd', priviledge_level='$priviledge_level' where id=$id") or die ("SQL Sttement Failed!");
  header("location: ./manageuser.php?Message=UpdateUserSuccessful");
  mysqli_close($conn);
}
include "sidenav.php";
include "topheader.php";
?>

<div class="content">
  <div class="container-fluid">
    <div class="col-md-5 mx-auto">
      <div class="card">
        <div class="card-header card-haeder-primary">
          <h4 class="title">User</h4>
        </div>
        <form action="edituser.php" name="form" method="post" enctype="multipart/form-data">>
        <div class="card-body">

          <input type="hidden" name="user_id" id="user_id" value="<?php echo $id;?>"/>
          <div class="col-md-12">
            <div class="form-group">
              <label>User Name</label>
              <input type="text" id ="username" name="username" class="form-control" value="<?php echo $username; ?>">
            </div>  
          </div>
          <div class="col-md-12">
            <div class="form-group">

            <label for="exampleInputEmail">Email</label>
            <input type="text" id="email" name="email" class="form-control" value="<?php echo $email; ?>">
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>