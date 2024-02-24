<?php
include 'plugins/navbar.php';
include 'plugins/sidebar/sanidadbar.php';
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Dashboard</b></h1>
            <br>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><b>Dashboard</b></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      	<div class="col-lg-12 col-md-12 col-sm-12">
      		<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Request Status</h3>
              </div>
              <div class="card-body table-responsive" style="height: 700px;">
              	  <div class="row">
	              	<div class="col-lg-2">
	              		<label>Requester:</label>
	              		<input type="text" id="sanidad_requester_search" class="form-control" autocomplete="off">
	              	</div>
	              	<div class="col-lg-2">
	              		<label>Request Type:</label>
	              		<select id="sanidad_request_type_search" class="form-control">
	              			<option value="">Select Request Type</option>
	              			<option value="registration">Registration</option>
	              			<option value="renewal">Renewal</option>
	              		</select>
	              	</div>
	              	<div class="col-lg-8" style="padding-top:20px;">
	              		<div class="float-right">
	              			<a href="#" class="btn btn-lg btn-primary" onclick="sanidad_search_req()">Search <i class="fas fa-search"></i></a>
	              		</div>
	              	</div>
	              </div>
	              <br>
              <table class="table table-head-fixed text-nowrap">
			        <thead style="text-align:center;">
			        	<th>#</th>
			        	<th>Request ID</th>
			        	<th>Requester</th>
			        	<th>Request Type</th>
			        	<th>Request Status</th>
			        </thead>
			        <tbody style="text-align:center;" id="sanidad_check_req"></tbody>
			    </table>
			    <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">   
                      <div class="spinner" id="spinner" style="display:none;">
                        <div class="loader float-sm-center"></div>    
                      </div>
                    </div>
                  </div>
              </div>
            </div>
      	</div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php
include 'plugins/footer.php';
include 'plugins/javascript/sanidad_script.php';
?>