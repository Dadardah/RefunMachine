<?php
include 'inc/header.php';
Session::CheckLogin();
?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
   $userLog = $users->userLoginAuthotication($_POST);
}
if (isset($userLog)) {
  echo $userLog;
}

$logout = Session::get('logout');
if (isset($logout)) {
  echo $logout;
}



 ?>

<div class="card ">
<div class="card-header">
<div class="container">
        <div class="content-wrapper">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <div class="image-wrapper">
                        <img src="img/login2.jpg" alt="Mobirise Website Builder">
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1 mbr-form" data-form-type="formoid">
                <form class="" action="" method="post">
                    <div class="dragArea row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h1 class="mbr-section-title mb-4 display-2">
                                <strong>Refun Bottle</strong>
                            </h1>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        </div>
                        <div class="col-lg-12 col-md col-12 form-group mb-3" data-for="name">
                            <input type="" name="username" placeholder="Username" data-form-field="name" class="form-control" value="" id="name-form4-z">
                        </div>
                        <div class="col-lg-12 col-md col-12 form-group mb-3" data-for="password">
                            <input type="password" name="password" placeholder="Password" data-form-field="email" class="form-control" value="" id="email-form4-z">
                        </div>
                        <div class="col-6  mbr-section-btn">
                            <button onclick="location.href='register.php'" type="button" class="btn btn-secondary display-4">Register</button>
                        </div>
                        <div class="col-6  mbr-section-btn">
                            <button type="submit" name="login" class="btn btn-info display-4">Login</button>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h1 class="mbr-section-title mb-4 display-2">
                                <strong></strong>
                            </h1>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button onclick="location.href='donate.php'" type="button" class="btn btn-success display-4">บริจาค</button>
                        </div>
                    </div>
                </form>
                
            </div>
            </div>
        </div>
    </div>


  <?php
  include 'inc/footer.php';

  ?>
