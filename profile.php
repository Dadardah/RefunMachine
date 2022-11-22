<?php
include 'inc/header.php';
Session::CheckSession();

 ?>

<?php

if (isset($_GET['id'])) {
  $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $updateUser = $users->updateUserByIdInfo($userid, $_POST);

}
if (isset($updateUser)) {
  echo $updateUser;
}




 ?>

 <div class="card ">
   <div class="card-header">
         <h3>User Profile</h3>   <!--<span class="float-right"> <a href="scan.php" class="btn btn-primary">Back</a>  -->
        </div>
        <div class="card-body">

    <?php
    $getUinfo = $users->getUserInfoById($userid);
    if ($getUinfo) {
     ?>
          <div style="width:600px; margin:0px auto">

          <form class="" action="" method="POST">
              <div class="form-group">
                <label for="name">ชื่อผู้ใช้</label>
                <input type="text" name="name" value="<?php echo $getUinfo->name; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo $getUinfo->username; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">อีเมล์</label>
                <input type="email" id="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="mobile">เบอร์โทร</label>
                <input type="text" id="mobile" name="mobile" value="<?php echo $getUinfo->mobile; ?>" class="form-control">
              </div>

              <div class="form-group">
                <button type="submit" name="update" class="btn btn-success">Update</button>
                <a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id;?>">Password change</a>
              </div>
          </form>
        </div>

      <?php }else{

      } ?>



      </div>
    </div>


  <?php
  include 'inc/footer.php';

  ?>
