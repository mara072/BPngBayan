<?php
include 'plugins/navbar.php';
include 'plugins/sidebar/bp_applybar.php';
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
              <div class="card-body" >
              	<div class="row">
                  <input type="hidden" name="req_id_ref" id="req_id_ref">
                  <input type="hidden" name="requester" id="requester" value="<?=$uname;?>">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <label>Applicant Name:</label>
                      <input type="text" name="applicant_name" id="applicant_name" class="form-control">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <label>Applicant Address:</label>
                      <input type="text" name="applicant_address" id="applicant_address" class="form-control">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <label>Name of Owner:</label>
                      <input type="text" name="owner" id="owner" class="form-control">
                    </div>
              	</div>
                <hr>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Title No:</label>
                    <input type="text" name="title_no" id="title_no" class="form-control">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>TD No:</label>
                    <input type="text" name="td_no" id="td_no" class="form-control">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>PIN:</label>
                    <input type="text" name="pin" id="pin" class="form-control">
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Total Area of Lot(In Square Meters):</label>
                    <input type="text" name="total_area" id="total_area" class="form-control">
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12">
                    <label>Location of Lot (Street, Barangay, Municipality, Province):</label>
                    <input type="text" name="location_lot" id="location_lot" class="form-control">
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Right Over Land:</label>
                    <input type="text" name="rol" id="rol" class="form-control">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Signature of Application:</label>
                    <input type="file" name="sa_file" id="sa_file" class="form-control" accept="image/jpeg, image/jpg" >
                    <input type="hidden" id="sa_file_check">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Signature of Owner:</label>
                    <input type="file" name="so_file" id="so_file" class="form-control" accept="image/jpeg, image/jpg" >
                    <input type="hidden" id="so_file_check">
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>TCT:</label>
                    <input type="file" name="tct_file" id="tct_file" class="form-control" accept="application/pdf" >
                    <input type="hidden" id="tct_file_check">
                    <br>
                    <label>Status: <b style="font: bold;" id="tct_req_status"></b></label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>DTI / SEC:</label>
                    <input type="file" name="dti_file" id="dti_file" class="form-control" accept="application/pdf" >
                    <input type="hidden" id="dti_file_check">
                    <br>
                    <label>Status: <b id="dti_req_status"></b></label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Brgy. Business Clearance with Receipt:</label>
                    <input type="file" name="bcr_file" id="bcr_file" class="form-control" accept="application/pdf" >
                    <input type="hidden" id="bcr_file_check">
                    <br>
                    <label>Status: <b id="bcr_req_status"></b></label>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Contract of Sale / Lease:</label>
                    <input type="file" name="csl_file" id="csl_file" class="form-control" accept="application/pdf">
                    <input type="hidden" id="csl_file_check">
                    <br>
                    <label>Status: <b id="csl_req_status"></b></label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Market Clearance:</label>
                    <input type="file" name="mc_file" id="mc_file" class="form-control" accept="application/pdf">
                    <input type="hidden" id="mc_file_check">
                    <br>
                    <label>Status: <b id="mc_req_status"></b></label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>DPWH Clearance:</label>
                    <input type="file" name="dpwh_file" id="dpwh_file" class="form-control" accept="application/pdf">
                    <input type="hidden" id="dpwh_file_check">
                    <br>
                    <label>Status: <b id="dpwh_req_status"></b></label>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Occupancy Permit:</label>
                    <input type="file" name="op_file" id="op_file" class="form-control" accept="application/pdf" >
                    <input type="hidden" id="op_file_check">
                    <br>
                    <label>Status: <b id="op_req_status"></b></label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Picture of Business Place:</label>
                    <input type="file" name="pbp_file" id="pbp_file" class="form-control" accept="application/pdf" >
                    <input type="hidden" id="pbp_file_check">
                    <br>
                    <label>Status: <b id="pbp_req_status"></b></label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Geographical Sketch:</label>
                    <input type="file" name="gs_file" id="gs_file" class="form-control" accept="application/pdf" >
                    <input type="hidden" id="gs_file_check">
                    <br>
                    <label>Status: <b id="gs_req_status"></b></label>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Building Permit:</label>
                    <input type="file" name="bp_file" id="bp_file" class="form-control" accept="application/pdf" >
                    <input type="hidden" id="bp_file_check">
                    <br>
                    <label>Status: <b id="bp_req_status"></b></label>
                  </div>
                </div>
              	<hr>
              	<div class="row">
              		<div class="col-lg-12">
              			<div class="float-right">
                      <button class="btn btn-lg btn-primary" id="submit_bp_req" onclick="submit_bp_req()">Submit</button>
                      <button class="btn btn-lg btn-primary" id="update_bp_req" onclick="update_bp_req()">Update Requirements</button>
                    <!-- </form> -->
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
include 'plugins/javascript/bp_apply_script.php';
?>