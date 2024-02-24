<div class="modal fade bd-example-modal-xl" id="check_req" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width:90%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Check Requirements</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" id="mpdc_id_req" class="form-control">
          <input type="hidden" id="mpdc_requester_req" class="form-control">
          <input type="hidden" id="mpdc_request_id_req" class="form-control">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Applicant Name:</label>
            <input type="text" id="applicant_name_mpdc" class="form-control" readonly>
            </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Applicant Address:</label>
            <input type="text" id="applicant_address_mpdc" class="form-control" readonly>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Name of Owner:</label>
            <input type="text" id="owner_mpdc" class="form-control" readonly>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Title No:</label>
            <input type="text" id="title_no_mpdc" class="form-control" readonly>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>TD No:</label>
            <input type="text" id="td_no_mpdc" class="form-control" readonly>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>PIN:</label>
            <input type="text" id="pin_mpdc" class="form-control" readonly>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Total Area of Lot(In Square Meters):</label>
            <input type="text" id="total_area_mpdc" class="form-control" readonly>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-12">
            <label>Location of Lot (Street, Barangay, Municipality, Province):</label>
            <input type="text" id="location_lot_mpdc" class="form-control" readonly>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Right Over Land:</label>
            <input type="text" id="rol_mpdc" class="form-control" readonly>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Signature of Application:</label>
            <br>
            <img src="" id="preview_signature_applicant" style="height:150px; width: 150px;">
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Signature of Owner:</label>
            <br>
            <img src="" id="preview_signature_owner" style="height:150px; width: 150px;">
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>TCT:</label>
            <select id="mpdc_tct_status" class="form-control">
              <option value="">Select Document Status</option>
              <?php
              require '../../process/conn.php';
              $query ="SELECT status FROM docs_status";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              if ($stmt->rowCount() > 0) {
                foreach ($stmt->fetchAll() AS $j) {
                  echo '<option value="'.$j['status'].'">'.strtoupper($j['status']).'</option>';
                }
              }
              ?>
            </select>
            <br>
            <div id="pdf-container_tct"></div>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-12">
            <label>DTI/SEC:</label>
             <select id="mpdc_dti_status" class="form-control">
              <option value="">Select Document Status</option>
              <?php
              require '../../process/conn.php';
              $query ="SELECT status FROM docs_status";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              if ($stmt->rowCount() > 0) {
                foreach ($stmt->fetchAll() AS $j) {
                  echo '<option value="'.$j['status'].'">'.strtoupper($j['status']).'</option>';
                }
              }
              ?>
            </select>
            <br>
            <div id="pdf-container_dti_sec"></div>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Brgy. Business Clearance with Receipt:</label>
             <select id="mpdc_bbcwr_status" class="form-control">
              <option value="">Select Document Status</option>
              <?php
              require '../../process/conn.php';
              $query ="SELECT status FROM docs_status";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              if ($stmt->rowCount() > 0) {
                foreach ($stmt->fetchAll() AS $j) {
                  echo '<option value="'.$j['status'].'">'.strtoupper($j['status']).'</option>';
                }
              }
              ?>
            </select>
            <br>
            <div id="pdf-container_bbcwr"></div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Contract of Sale / Lease:</label>
             <select id="mpdc_cosl_status" class="form-control">
              <option value="">Select Document Status</option>
              <?php
              require '../../process/conn.php';
              $query ="SELECT status FROM docs_status";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              if ($stmt->rowCount() > 0) {
                foreach ($stmt->fetchAll() AS $j) {
                  echo '<option value="'.$j['status'].'">'.strtoupper($j['status']).'</option>';
                }
              }
              ?>
            </select>
            <br>
            <div id="pdf-container_cosl"></div>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Market Clearance:</label>
             <select id="mpdc_mc_status" class="form-control">
              <option value="">Select Document Status</option>
              <?php
              require '../../process/conn.php';
              $query ="SELECT status FROM docs_status";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              if ($stmt->rowCount() > 0) {
                foreach ($stmt->fetchAll() AS $j) {
                  echo '<option value="'.$j['status'].'">'.strtoupper($j['status']).'</option>';
                }
              }
              ?>
            </select>
            <br>
            <div id="pdf-container_mc"></div>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-12">
            <label>DPWH Clearance:</label>
             <select id="mpdc_dpwh_status" class="form-control">
              <option value="">Select Document Status</option>
              <?php
              require '../../process/conn.php';
              $query ="SELECT status FROM docs_status";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              if ($stmt->rowCount() > 0) {
                foreach ($stmt->fetchAll() AS $j) {
                  echo '<option value="'.$j['status'].'">'.strtoupper($j['status']).'</option>';
                }
              }
              ?>
            </select>
            <br>
            <div id="pdf-container_dpwh"></div>
          </div>
        </div>
        <hr>
        <div class="row">
           <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Occupancy Permit:</label>
             <select id="mpdc_op_status" class="form-control">
              <option value="">Select Document Status</option>
              <?php
              require '../../process/conn.php';
              $query ="SELECT status FROM docs_status";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              if ($stmt->rowCount() > 0) {
                foreach ($stmt->fetchAll() AS $j) {
                  echo '<option value="'.$j['status'].'">'.strtoupper($j['status']).'</option>';
                }
              }
              ?>
            </select>
            <br>
            <div id="pdf-container_op"></div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Picture of Business Place:</label>
             <select id="mpdc_pobp_status" class="form-control">
              <option value="">Select Document Status</option>
              <?php
              require '../../process/conn.php';
              $query ="SELECT status FROM docs_status";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              if ($stmt->rowCount() > 0) {
                foreach ($stmt->fetchAll() AS $j) {
                  echo '<option value="'.$j['status'].'">'.strtoupper($j['status']).'</option>';
                }
              }
              ?>
            </select>
            <br>
            <div id="pdf-container_pobp"></div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Geographical Sketch:</label>
             <select id="mpdc_gs_status" class="form-control">
              <option value="">Select Document Status</option>
              <?php
              require '../../process/conn.php';
              $query ="SELECT status FROM docs_status";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              if ($stmt->rowCount() > 0) {
                foreach ($stmt->fetchAll() AS $j) {
                  echo '<option value="'.$j['status'].'">'.strtoupper($j['status']).'</option>';
                }
              }
              ?>
            </select>
            <br>
            <div id="pdf-container_gs"></div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Building Permit:</label>
             <select id="mpdc_bp_status" class="form-control">
              <option value="">Select Document Status</option>
              <?php
              require '../../process/conn.php';
              $query ="SELECT status FROM docs_status";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              if ($stmt->rowCount() > 0) {
                foreach ($stmt->fetchAll() AS $j) {
                  echo '<option value="'.$j['status'].'">'.strtoupper($j['status']).'</option>';
                }
              }
              ?>
            </select>
            <br>
            <div id="pdf-container_bp"></div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Assessment Receipt:</label>
            <div style="padding-top: 63px;" id="pdf-container_ar"></div>
          </div>
        </div>
            
      </div> 
          <div class="modal-footer">
            <div class="row">
               <div class="col-lg-4">
                    <div class="float-right">
                        <a href="#" class="btn btn-info" onclick="check_mpdc_req()">Check&nbsp;Requirements</a>&ensp;
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="float-left">
                        <a href="#" class="btn btn-secondary modal-trigger" data-toggle="modal" data-target="#mpdc_assessment" onclick="hide_modal()">Upload&nbsp;Assessment</a>&ensp;&ensp;
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="float-right">
                        <a href="#" class="btn btn-primary" onclick="issuance_olp()">Issuance&nbsp;of&nbsp;Locational&nbsp;Permit</a>
                    </div>
                </div>
            </div>
          </div>
    </div>
  </div>
</div>