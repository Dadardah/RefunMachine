<?php
include 'inc/ui.php';
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


 ?>
      <div class="card ">
        <div class="card-header">
          <h3><i class="fas fa-users mr-2"></i>สะสมแต้ม <span class="float-right">ยินดีต้อนรับ <strong>
            <span class="badge badge-lg badge-secondary text-white">
<?php
$name = Session::get('name');
if (isset($name)) {
  echo $name;
}
 ?></span>

          </strong></span></h3>
        </div>
        <div class="container bg-info">
        <div class="row justify-content-center ">
            <div class="card col-12 col-lg-10">
                <div class="card-wrapper">
                    <div class="card-box align-center ">
                        <h4 class="card-title mbr-fonts-style align-center mb-4 display-1">
                            <strong>Scan Barcode</strong>
                        </h4>
                        <p class="mbr-text mbr-fonts-style mb-4 display-7"></p>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3 " data-for="name">
                            <input style="text-align: center;" id="barcode" type="text" name="barcode" placeholder="BARCODE" data-form-field="name" class="form-control" value="" id="name-form7-k">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div id="modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-body">
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
                      <button onclick="location.href='history.php'" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button onclick="location.href='history.php'" type="button" class="btn btn-primary">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
      </div>
   
    </div>
  </div>
</div>

<script>

document.getElementById("barcode").focus();


document.getElementById("barcode")
    .addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
      var barcode = $('#barcode').val();
      $.ajax({
				url:"service.php",
				method:"POST",
				data:({"service_name" : "get_bottle",barcode:barcode}),
				success:function(data)
				{
          //console.log(data)
				
          var array = JSON.parse(data);
          if (array == false) {alert('ไม่พบข้อมูล Barcode')}else{
          document.getElementById('line0').innerHTML = "<b>BarCode : </b>"+array['barcode']
          document.getElementById('line1').innerHTML = "<b>ชื่อ : </b>"+array['name']
          document.getElementById('line2').innerHTML = "<b>ยี่ห้อ : </b>"+array['brand']
          document.getElementById('line3').innerHTML = "<b>ขนาด : </b>"+array['volume']
          document.getElementById('line4').innerHTML = "<b>คะแนน : </b>"+array['point']
          //console.log(array);
          $('#modal').modal({
            keyboard: false
          })
          console.log(array['timestamp_'])
          $.ajax({
				        url:"service.php",
				        method:"POST",
                data:({"service_name" : "insert_bottle_tran",barcode:barcode,date:array['timestamp_']}),
				        success:function(data)
				        {
					        console.log('insert_bottle_tran_0') 
                  setTimeout(count(barcode,array['timestamp_']), 3000);          
				        }
			    });
 
        }
				}
			});

     
    }
});
function count(barcode,timestamp_){


  $.ajax({
				        url:"service.php",
				        method:"POST",
                data:({"service_name" : "get_bottle_tran",barcode:barcode,date:timestamp_}),
				        success:function(data)
				        {
					        console.log(data)
                  var array = JSON.parse(data);
                  document.getElementById('total_bottle').innerHTML = array["quantity"]
                  //$('#total_bottle').val(array["quantity"])
                  //console.log("<?php echo date('Y-m-d H:m:s'); ?>")
                  count(barcode,timestamp_)
                  
				        }
			          });


}
</script>
  <?php
  include 'inc/footer.php';

  ?>
