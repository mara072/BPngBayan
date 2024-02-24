<?php
include 'plugins/navbar.php';
include 'plugins/sidebar/bp_renewbar.php';
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>History of Business Permit</b></h1>
            <br>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><b>History of Business Permit</b></li>
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
      		<!-- LIST OF HISTORY BUSINESS PERMIT -->
          <div class="table-responsive ">
            <table  class="table table-head-fixed text-nowrap"  style="height:100%; width:100%;">
              <thead>
                <th>REQ ID</th>
                <th>BUSINESS</th>
                <th>REQUESTER</th>
                <th>APPLICANT NAME</th>
                <th>OWNER</th>
                <th>REQUEST DATETIME</th>
                <th>MPDC APPROVAL DATE</th>
                <th>MTO APPROVAL DATE</th>
                <th>SANIDAD APPROVAL DATE</th>
                <th>MENRO APPROVAL DATE</th>
                <th>MEO APPROVAL DATE</th>
                <th>BFP APPROVAL DATE</th>
                <th>BPLO APPROVAL DATE</th>
                <th>REQUEST TYPE</th>
              </thead>
              <tbody id="table_history"></tbody>
            </table>
          </div>
          
      	</div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php
include 'plugins/footer.php';
include 'plugins/javascript/bp_renew_script.php';
?>