<?php
include 'plugins/navbar.php';
include 'plugins/sidebar/bplobar.php';
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Upload Requirements & Business Permit</b></h1>
            <br>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><b>Upload Requirements & Business Permit</b></li>
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
                          <input type="hidden" id="requester" value="<?=$uname;?>">
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <label>Cedula:</label>
                            <input type="file" id="bplo_cedula_file" class="form-control" accept="application/pdf" required>
                            <input type="hidden" id="bplo_check_cedula" class="form-control">
                            <br>
                            <label>Status: <b id="bplo_status_cedula"> </b></label>
                          </div>
                         <div class="col-lg-6 col-md-6 col-sm-12">
                            <label>DTI:</label>
                            <input type="file" id="bplo_dti_file" class="form-control" accept="application/pdf" required>
                            <input type="hidden" id="bplo_check_dti" class="form-control">
                            <br>
                            <label>Status: <b id="bplo_status_dti"> </b></label>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-12">
                            <label>Brgy. Business Clearance & Official Receipt</label>
                            <input type="file" id="bplo_bbcor_file" class="form-control" accept="application/pdf" required>
                            <input type="hidden" id="bplo_check_bbcor" class="form-control">
                            <br>
                            <label>Status: <b id="bplo_status_bbcor"> </b></label>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <label>SSS Certificate of Compliance:</label>
                            <input type="file" id="bplo_scc_file" class="form-control" accept="application/pdf" required>
                            <input type="hidden" id="bplo_check_scc" class="form-control">
                            <br>
                            <label>Status: <b id="bplo_status_scc"> </b></label>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-12">
                            <label>2x2 Picture(2pcs):</label>
                            <input type="file" id="bplo_2pic_file" class="form-control" accept="application/pdf" required>
                            <input type="hidden" id="bplo_check_2pic" class="form-control">
                            <br>
                            <label>Status: <b id="bplo_status_2pic"> </b></label>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="float-right">
                              <a href="#" class="btn btn-lg btn-primary" id="submit_bplo_req" onclick="submit_bplo_req()">Submit</a>
                              <a href="#" class="btn btn-lg btn-primary" id="update_bplo_req" onclick="update_bplo_req()">Update Requirements</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                     <div class="card card-secondary">
                        <div class="card-header">
                          <h3 class="card-title"><label>Business Permit</label></h3>
                        </div>
                        <div class="card-body">
                          <br>
                             <div id="pdf-container_bp"></div>
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
include 'plugins/javascript/bplo_script.php';
?>