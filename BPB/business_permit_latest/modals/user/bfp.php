<div class="modal fade bd-example-modal-xl" id="user_bfp" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width:90%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          <!-- <form action="../../process/user/processor.php" method="POST" enctype="multipart/form-data"> -->
            <b>Upload BFP Requirements</b>
            <hr>
            <label id="req_id" style="color:red;"></label>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
                  <input type="hidden" id="req_id_ref3">
                  <input type="hidden" id="requester" value="<?=$uname;?>">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <label>Owner Name:</label>
                      <input type="text" id="owner_name" class="form-control">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <label>Building / Facility / Structure / Business / Establishment Name:</label>
                      <input type="text" id="bfsbe" class="form-control">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <label>Exact Address:</label>
                      <input type="text" id="address" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Authorized Representative:</label>
                    <input type="text" id="ar" class="form-control">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Type of Occupancy / Business Nature:</label>
                    <input type="text" id="tobn" class="form-control">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Total Floor Area:</label>
                    <input type="text" id="tfa" class="form-control">
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>No. of Storey:</label>
                    <input type="text" id="nos" class="form-control">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Contact Number:</label>
                    <input type="number" id="contact_no" class="form-control">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Email Address:</label>
                    <input type="text" id="email" class="form-control">
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Signature of Owner / Authorized Representative:</label>
                    <input type="file" id="soar_file" class="form-control" accept="image/jpeg, image/jpg" >
                    <input type="hidden" id="soar_check" class="form-control">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Fire Extinguisher Receipt:</label>
                    <input type="file" id="fer_file" class="form-control" accept="application/pdf" >
                    <input type="hidden" id="fer_check" class="form-control">
                    <label>Status: <b id="fer_status"></b></label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Building Permit:</label>
                    <input type="file" id="bp_file" class="form-control" accept="application/pdf" >
                    <input type="hidden" id="bp_check" class="form-control">
                    <label>Status: <b id="bp_status"></b></label>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Occupancy Permit:</label>
                    <input type="file" id="op_file" class="form-control" accept="application/pdf" >
                    <input type="hidden" id="op_check" class="form-control">
                    <label>Status: <b id="op_status"></b></label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Fire Safety Inspection Certificate Application Form:</label>
                    <input type="file" id="fsicaf_file" class="form-control" accept="application/pdf" >
                    <input type="hidden" id="fsicaf_check" class="form-control">
                    <label>Status: <b id="fsicaf_status"></b></label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Assessment Record with Receipt(MTO):</label>
                    <input type="file" id="arwr_file" class="form-control" accept="application/pdf">
                    <input type="hidden" id="arwr_check" class="form-control">
                    <label>Status: <b id="arwr_status"></b></label>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <label>Picture of Business:</label>
                    <input type="file" id="pob_file" class="form-control" accept="application/pdf">
                    <input type="hidden" id="pob_check" class="form-control">
                    <label>Status: <b id="pob_status"></b></label>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="float-right">
                      <!-- <input type="submit" name="submit_bfp_req" class="btn btn-lg btn-primary" value="Submit"> -->
                      <a href="#" class="btn btn-lg btn-primary" id="submit_bfp_req" onclick="submit_bfp_req()">Submit</a>
                      <a href="#" class="btn btn-lg btn-primary" id="update_bfp_req" onclick="update_bfp_req()">Update Requirements</a>
                    <!-- </form> -->
                    </div>
                  </div>
                </div>
      </div> 
    </div>
  </div>
</div>