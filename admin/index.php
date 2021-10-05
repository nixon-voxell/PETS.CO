<?php
session_start();
include("../includes/utils/dbhandler.php");
include "sidenav.php";
include "topheader.php";
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
         <div class="panel-body">
          </div>
          <div class="col-md-14">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title"> Users List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive ps">
                  <table class="table table-hover tablesorter " id="">
                    <thead class=" text-primary">
                        <tr><th>ID</th><th>Username</th><th>Password</th><th>Email</th><th>Privilege Level</th>
                    </tr></thead>
                    <tbody>
                      <?php
                        $result=mysqli_query($conn,"select id,username,email,password,priviledge_level from members order by username")or die ("Select statement FAILED!");

                        while(list($id,$username,$email,$password,$priviledge_level)=mysqli_fetch_array($result))
                        {
                        echo "<tr><td>$id</td><td>$username</td><td>$email</td><td>$password</td><td>$priviledge_level</td>

                        </tr>";
                        }
                        ?>
                    </tbody>
                  </table>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                   <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
                   </div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                   <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;">
                   </div>
                </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
      <?php
include "footer.php";
?>






