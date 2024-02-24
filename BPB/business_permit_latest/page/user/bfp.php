<?php
include 'plugins/navbar.php';
include 'plugins/sidebar/bfpbar.php';
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Apply Business Permit</b></h1>
            <br>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><b>Apply Business Permit</b></li>
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-6">
             <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="#" class="btn btn-info modal-trigger" data-toggle="modal" data-target="#user_bfp" onclick="check_req_id();">Upload Requirements</a>
                  </div>
                </div>
          </div>
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
                <h3 class="card-title">
                  <label id="req_id2"></label>
                </h3>
              </div>
              <div class="card-body">
              	<div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-secondary">
                      <div class="card-header">
                        <h3 class="card-title"><label>Assessment:</label></h3>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <p style="text-align: center;">
                          <div id="pdf-container_bfp_assessment_user"></div>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-info">
                      <div class="card-header">
                        <h3 class="card-title"><label>Upload Receipt:</label></h3>
                      </div>
                      <div class="card-body">
                        <form action="../../process/user/bfp_receipt.php" method="POST" enctype="multipart/form-data">
                          <input type="hidden" name="req_id_ref" id="req_id_ref" class="form-control">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                               <label>Click to Pay:</label>
                                <a href="https://www.lbp-eservices.com/egps/portal/Merchants.jsp"><img src="../../dist/img/lb.PNG" style="height:100px;"></a>
                                <hr>
                                <br>
                              <label>Receipt File:</label>
                              <input type="file" name="bfp_receipt_file" class="form-control" accept="application/pdf">
                              <hr>
                              <br>
                              <div class="float-right">
                                <input type="submit" name="submit_bfp_receipt" class="btn btn-primary" value="Submit">
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-success">
                      <div class="card-header">
                        <h3 class="card-title"><label>FSIC:</label></h3>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <p style="text-align: center;">
                          <div id="pdf-container_bfp_fsic_user"></div>
                          </p>
                        </div>
                      </div>
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
include 'plugins/javascript/bfp_script.php';
?>