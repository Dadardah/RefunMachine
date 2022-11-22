<?php
include 'inc/header.php';

Session::CheckSession();

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>
<?php


$point = $users->get_bottle_point();



 ?>
      <div class="card ">
        <div class="card-header">
          <h3><i class="fas fa-users mr-2"></i>History <span class="float-right">Welcome! <strong>
            <span class="badge badge-lg badge-secondary text-white">
<?php
$username = Session::get('username');
if (isset($username)) {
  echo $username;
}
 ?></span>

          </strong></span></h3>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-8">
            <table id="datahistory" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th  class="text-center">วันที่</th>
                      <th  class="text-center">รายการ</th>
                      <th  class="text-center">จำนวน</th>
                    </tr>
                  </thead>
                  <tbody>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tbody>
              </table>
            </div>
            <div class="col-md-4">
                <div class="card-box align-center ">
                        <h4 class="card-title mbr-fonts-style align-center mb-4 display-1">
                            <strong>Point</strong>
                        </h4>
                        <p class="mbr-text mbr-fonts-style mb-4 display-7"></p>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3 " data-for="name">
                            <h4 class="card-title mbr-fonts-style align-center mb-4 display-1">
                              <strong><?php echo $point->quantity; ?></strong>
                            </h4>
                        </div>
                        <div>
                            <button onclick="location.href='scan.php'" class="btn btn-success display-4">ใส่ขวด</button>
                        </div>
                    </div>
            </div>
          </div>
        </div>
      </div>


<script>

</script>

  <?php
  include 'inc/footer.php';

  ?>
