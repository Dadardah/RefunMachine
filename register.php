<?php
include 'inc/header.php';
Session::CheckLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

  $register = $users->userRegistration($_POST);
}

if (isset($register)) {
  echo $register;
}


 ?>


 <div class="card ">
   <div class="card-header">
   <div class="col-lg-12 col-md-12 col-sm-12">
                            <h1 class=" text-center mbr-section-title mb-4 display-2">
                                <strong>User Registration</strong>
                                 <span class="float-right"> <a href="login.php" class="btn btn-primary">Back</a> 
                            </h1>
                        </div>
        </div>
        <div class="cad-body row justify-content-center ">



            <div style="width:600px; margin:0px auto">

            <form class="" action="" method="post">
                <div class="form-group pt-3">
                  <label for="name">ชื่อผู้ใช้</label>
                  <input type="text" name="name"  class="form-control">
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username"  class="form-control">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control">
                  <input type="hidden" name="roleid" value="1" class="form-control">
                </div>
                <div class="form-group">
                  <label for="email">อีเมล์</label>
                  <input type="email" name="email"  class="form-control">
                </div>
                <div class="form-group">
                  <label for="mobile">เบอร์โทร</label>
                  <input type="text" name="mobile"  class="form-control">
                </div>
               
                <div class="form-group">
                  <button type="submit" name="register" class="btn btn-success display-4 ">Register</button>
                </div>


            </form>
          </div>


        </div>
      </div>



  <?php
  include 'inc/footer.php';

  ?>
