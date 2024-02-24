<?php
require '../../process/conn.php';
$id = $_GET['id'];
$requester = $_GET['requester'];
$request_id = $_GET['request_id'];
$applicant_name = $_GET['applicant_name'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>Business Permit</title>
	  <link rel="icon" href="../../dist/img/logo.png" type="image/x-icon" />
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
	  <!-- SweetAlert2 -->
	  <link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.min.css">
</head>
<body>
	<br>
	<div class="row">
		<div class="col-lg-2">
			
		</div>
		<div class="col-lg-8">
			<!-- Main content -->
		    <section class="content">
		      <div class="container-fluid">
		        <div class="card card-primary card-outline">
		          <div class="card-header">
		            <h3 class="card-title"><b>Issuance of Locational Clearance for Business Permit:</b></h3>
		          </div> <!-- /.card-body -->
		          <div class="card-body">
		          	<!-- <form action="../../process/approver/issuance.php" method="POST" enctype="multipart/form-data"> -->
		          	<div class="col-lg-12">
		          		<div class="row">
		          			<div class="col-lg-5">
		          				<label>Requester:</label>
		          				<input type="hidden" id="permit_id" name="permit_id" class="form-control" value="<?=$id;?>" readonly>
		          				<input type="text" id="permit_requester" class="form-control" value="<?=$applicant_name;?>" readonly>
		          			</div>
		          			<div class="col-lg-4">
		          				
		          			</div>
		          			<div class="col-lg-3">
		          				<label>Upload Permit:</label>
		          				<input type="file" id="lcbp_file" class="form-control" accept="application/pdf" required >
		          				<br>
		          				<div class="float-right">
		          				<!-- <input type="submit" name="issuance_lcbp" id="issue_permit_mpdc" class="btn btn-primary" value="Issue Permit"> -->
		          				<a href="#" class="btn btn-primary" onclick="issue_permit_mpdc();">Issue Locational Permit</a>
		          				</div>
		          			</div>
		          		</div>
		          	</div>
		          	<!-- </form> -->
		          </div><!-- /.card-body -->
		        </div>
		      </div><!-- /.container-fluid -->
		    </section>
		    <!-- /.content -->
		</div>
		<div class="col-lg-2">
			
		</div>
	</div>
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- ChartJS -->
<script src="../../node_modules/chart.js/dist/chart.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>

<script type="text/javascript">
$(function() {
    check_status();
    // send_email('<?=$requester;?>','<?=$request_id;?>','<?=$applicant_name;?>','mpdc');

});	

const check_status =()=>{
 let id = $('#permit_id').val();
 $.ajax({
        url:'../../process/approver/mpdc.php',
                type: 'POST',
                cache: false,
                serverSide:true,
                data:{
                  method: 'check_status',
                    id:id
                },success:function(response){
                  $('#mpdc_status').html(response);
                }
  });
}


const issue_permit_mpdc =()=> {
  let lcbp_file = document.getElementById('lcbp_file');

  if (lcbp_file.files.length > 0) {
    let file = lcbp_file.files[0];

    // Create a FileReader to read the selected file
    let reader = new FileReader();

    // Define an event handler for when the file reading is done
    reader.onload = function (e) {
        // The result of the FileReader contains the base64 data URI
        let lcbp_file = e.target.result;
         	let id = $('#permit_id').val();
        let lcbp_files = lcbp_file;
      $.ajax({
          url: '../../process/approver/mpdc.php',
          type: 'POST',
          cache: false,
          data: {
            method: 'issue_permit_mpdc',
            id: id,
            lcbp_files: lcbp_files
          },success: function (response) {
            if (response == 'success') {
              Swal.fire({
                title: 'Successfully Submitted',
                icon: 'success',
                showConfirmButton: false,
                timer: 1000
              });
               setTimeout(function () {
					        window.location.href = 'dashboard.php';
					    }, 1000);
              // send email
              send_email('<?=$requester;?>','<?=$request_id;?>','<?=$applicant_name;?>','mpdc');

            }else if(response == 'invalid') {
              Swal.fire({
                title: 'Requirements Not Yet Complete',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
              });
            }else {
              Swal.fire({
                title: 'Error',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
              });
            }
          }
        });

    };
    // Read the selected file as a Data URL (base64)
    reader.readAsDataURL(file);
}else{
  Swal.fire({
      icon: 'info',
      title: 'Please Select Locational Permit File',
      text: 'info',
      showConfirmButton: false,
      timer: 1000
    });
}
}

const send_email =(requester,request_id,applicant_name,dept_sender)=>{
  // console.log(requester)
  // console.log(request_id)
  // console.log(applicant_name)
  // console.log(dept_sender)
  $.ajax({
    url:'../../process/mailer/index.php',
    type: 'POST',
    data:{
      requester_email:requester,
      request_id:request_id,
      applicant_name:applicant_name,
      dept_sender:dept_sender
    },success:function(response){
      console.log(response);
    }
  })
}
</script>
</body>
</html>

