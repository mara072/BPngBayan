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
            <h1 class="m-0"><b>Upload Requirements & Sanitary Permit</b></h1>
            <br>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><b>Upload Requirements & Sanitary Permit</b></li>
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
                 <!-- <form action="../../process/user/processor.php" method="POST" enctype="multipart/form-data"> -->
                <h3 class="card-title"><label id="req_id"></label></h3>
              </div>
              <div class="card-body">
              	<div class="row">
                  <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="card card-info">
                      <div class="card-header">
                        <h3 class="card-title"><label>Upload Requirements</label></h3>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <input type="hidden" name="req_id_ref" id="req_id_ref">
                          <input type="hidden" name="requester" id="requester" value="<?=$uname;?>">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                            <label>Fecalysis:</label>
                            <input type="file" id="fecalysis_file" class="form-control" accept="application/pdf" >
                            <input type="hidden" id="fecalysis_check" class="form-control">
                            <br>
                            <label>Status: <b id="sanidad_status_fecalysis"></b></label>
                          </div>
                          <div class="col-lg-3 col-md-3 col-sm-12">
                            <label>Urinalysis:</label>
                            <input type="file" id="urinalysis_file" class="form-control" accept="application/pdf" >
                            <input type="hidden" id="urinalysis_check" class="form-control">
                            <br>
                            <label>Status: <b id="sanidad_status_urinalysis"></b></label>
                          </div>
                          <div class="col-lg-3 col-md-3 col-sm-12">
                            <label>Chest X-ray:</label>
                            <input type="file" id="xray_file" class="form-control" accept="application/pdf" >
                            <input type="hidden" id="xray_check" class="form-control">
                            <br>
                            <label>Status: <b id="sanidad_status_xray"></b></label>
                          </div>
                          <div class="col-lg-3 col-md-3 col-sm-12">
                            <label>Drug Test:</label>
                            <input type="file" id="drug_test_file" class="form-control" accept="application/pdf" >
                            <input type="hidden" id="drug_test_check" class="form-control">
                            <br>
                            <label>Status: <b id="sanidad_status_drug_test"></b></label>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="float-right">
                              <!-- <input type="submit" name="submit_sanidad_reqs" class="btn btn-lg btn-primary" value="Submit"> -->
                              <a href="#" class="btn btn-lg btn-primary" id="submit_sanidad_req" onclick="submit_sanidad_reqs()">Submit</a>
                               <a href="#" class="btn btn-lg btn-primary" id="update_sanidad_req" onclick="update_sanidad_reqs()">Update Requirements</a>
                            <!-- </form> -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                     <div class="card card-secondary">
                        <div class="card-header">
                          <h3 class="card-title"><label>Sanitary Permit</label></h3>
                        </div>
                        <div class="card-body">
                          <br>
                             <div id="pdf-container_ar"></div>
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
      	</div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php
include 'plugins/footer.php';
include 'plugins/javascript/sanidad_script.php';
?>