<?php
include 'plugins/navbar.php';
include 'plugins/sidebar/mpdcbar.php';
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Assessment & Locational Permit</b></h1>
            <br>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><b>Assessment & Locational Permit</b></li>
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
                 <!-- <form action="../../process/user/mpdc_assessment.php" method="POST" enctype="multipart/form-data"> -->
                <h3 class="card-title"><label id="req_id"></label></h3>
                <input type="hidden" name="req_id_ref" id="req_id_ref" class="form-control">
              </div>
              <div class="card-body">
              	<div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><label>Assessment</label></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-7 col-md-6 col-sm-12">
                                  <label>Assessment File:</label>
                                  <br>
                                  <div id="pdf-container_assessment"></div>
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-12">
                                    <label>Click to Pay:</label>
                                    <a href="https://www.lbp-eservices.com/egps/portal/Merchants.jsp"><img src="../../dist/img/lb.PNG" style="height:100px;"></a>
                                    <hr>
                                    <br>
                                    <label>Assessment Receipt:</label>
                                    <input type="file" id="assessment_receipt" class="form-control" accept="application/pdf">
                                    <br>
                                     <label>Status: <b id="mpdc_f_status_check"></b></label>
                                     <hr>
                                    <div class="float-right">
                                    <!-- <input type="submit" name="submit_assessment" class="btn btn-lg btn-primary" value="Submit"> -->
                                    <a href="#" class="btn btn-lg btn-primary" onclick="submit_mpdc_receipt()">Submit</a>
                                    </div>
                                  <!-- </form> -->
                                </div>
                              </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6">
                     <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title"><label>Locational Permit</label></h3>
                        </div>
                        <div class="card-body">
                          <br>
                             <div id="pdf-container_lp"></div>
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
include 'plugins/javascript/mpdc_script.php';
?>