<?php
include 'plugins/navbar.php';
include 'plugins/sidebar/mtobar.php';
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Upload Requirements & Assessment Record</b></h1>
            <br>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><b>Upload Requirements & Assessment Record</b></li>
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
                <h3 class="card-title"><label id="req_id"></label></h3>
              </div>
              <div class="card-body">
              	<div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-info">
                      <div class="card-header">
                        <h3 class="card-title"><label>Upload Requirements</label></h3>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <input type="hidden" name="req_id_ref" id="req_id_ref">
                          <input type="hidden" name="requester" id="requester" value="<?=$uname;?>">
                          <div class="col-lg-4 col-md-4 col-sm-12">
                            <label>Water Bill <br>Payment:</label>
                            <input type="file" name="wbp_file" id="wbp_file" class="form-control" accept="application/pdf" required>
                            <input type="hidden" id="wbp_check" class="form-control">
                            <br>
                            <label>Status: <b id="mto_status_wbr"></b></label>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12">
                            <label>Real Property Tax <br>Payment:</label>
                            <input type="file" name="rptp_file" id="rptp_file" class="form-control" accept="application/pdf" required>
                            <input type="hidden" id="rptp_check" class="form-control">
                            <br>
                            <label>Status: <b id="mto_status_rptp"></b></label>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12">
                            <label>Cedula:</label>
                            <div style="padding-top: 20px;">
                            <input type="file" name="cedula_file" id="cedula_file" class="form-control" accept="application/pdf" required>
                            <input type="hidden" id="cedula_check" class="form-control">
                            <br>
                            <label>Status: <b id="mto_status_cedula"></b></label>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="float-right">
                              <a href="#" class="btn btn-lg btn-primary" id="submit_mto_req" onclick="submit_mto_req()">Submit</a>
                              <a href="#" class="btn btn-lg btn-primary" id="update_mto_req" onclick="update_mto_req()">Update Requirements</a>
                            <!-- </form> -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12">
                     <div class="card card-secondary">
                        <div class="card-header">
                          <h3 class="card-title"><label>Assessment Record</label></h3>
                        </div>
                        <div class="card-body">
                          <br>
                             <div id="pdf-container_ar"></div>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12">
                      <div class="card card-secondary">
                        <div class="card-header">
                          <h3 class="card-title"><label>Assessment Receipt</label></h3>
                        </div>
                        <!-- <form action="../../process/user/processor.php" method="POST" enctype="multipart/form-data"> -->
                          <input type="hidden" name="req_id_ref_mto_receipt" id="req_id_ref_mto_receipt">
                        <div class="card-body">
                          <label>Click to Pay:</label>
                          <a href="https://www.lbp-eservices.com/egps/portal/Merchants.jsp"><img src="../../dist/img/lb.PNG" style="height:100px;"></a>
                          <hr>
                          <br>
                          <label>Upload Assessment Receipt:</label>
                          <input type="file" name="mto_receipt_file" id="mto_receipt_file" class="form-control" accept="application/pdf" required>
                          <br>
                          <label>Status: <b id="mto_fstatus_chcek"></b></label>
                          <hr>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="float-right">
                                <!-- <input type="submit" name="submit_mto_receipt" class="btn btn-lg btn-primary" value="Submit"> -->
                                <a href="#" class="btn btn-lg btn-primary" onclick="submit_mto_receipt()">Submit</a>
                              <!-- </form> -->
                              </div>
                            </div>
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
include 'plugins/javascript/mto_script.php';
?>