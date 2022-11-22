<?php
include 'inc/ui.php';
include 'inc/header.php';



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
      <div class="card ">
        <div class="card-header">
          <h3><i class="fas fa-users mr-2"></i>บริจาคขวด 
          
<?php

$name = Session::get('name');

if (isset($name)) { ?>

<span class="float-right">ยินดีต้อนรับ <strong>
<span class="badge badge-lg badge-secondary text-white"></span>
</strong></span> <?php echo $name;?>

<?php }?>

</h3>
</div>

<div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 image-wrapper">
                <img src="img/login.jpg" alt="Mobirise Website Builder">
            </div>
            <div class="col-12 col-md">
                <div class="text-wrapper">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2"><strong>ใส่ขวด</strong></h1>
                    <p id='line0' class="mbr-text mbr-fonts-style display-7"></p>
                    <p id='line1' class="mbr-text mbr-fonts-style display-7"></p>
                    <p id='line2' class="mbr-text mbr-fonts-style display-7"></p>
                    <p id='line3' class="mbr-text mbr-fonts-style display-7"></p>
                    <p id='line4' class="mbr-text mbr-fonts-style display-7"></p>
                    <div style="text-align: center;" class="mb-3"><h2 for="exampleFormControlInput1" class="form-label">จำนวนขวดที่ใส่</h2></div>
                    <h1 id="total_bottle" style="text-align: center;" class="mbr-section-title mbr-fonts-style mb-3 display-2">0</h1>
                    <div class="modal-footer">
                      <button onclick="location.href='login.php?action=logout'" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button onclick="location.href='login.php?action=logout'" type="button" class="btn btn-primary">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>


  <?php
  include 'inc/footer.php';
  ?>

<script>
            $.ajax({
				        url:"service.php",
				        method:"POST",
                data:({"service_name" : "getdatetime"}),
				        success:function(data)
				        {
                  console.log(data) 
                  var array = JSON.parse(data);
                  count(array['current_timestamp()'])
					        
				        }
			    });


function count(datetime){
  $.ajax({
				        url:"service.php",
				        method:"POST",
                data:({"service_name" : "get_donate",date:datetime}),
				        success:function(data)
				        {
					        console.log(data)
                  var array = JSON.parse(data);
                  document.getElementById('total_bottle').innerHTML = array["quantity"]
                  //$('#total_bottle').val(array["quantity"])
                  console.log("<?php echo date('Y-m-d H:m:s'); ?>")
                  count(datetime)
                  
				        }
			          });
}
</script>
