<?php
include 'plugins/navbar.php';
include 'plugins/sidebar/dashboardbar.php';
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
              <div class="card-body table-responsive">
              	<div id="req_tracking">
              		
              	</div>
                <!-- <button class="btn btn-success">Renew</button> -->
              </div>
            </div>
      	</div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php
include 'plugins/footer.php';
include 'plugins/javascript/dashboard_script.php';
?>