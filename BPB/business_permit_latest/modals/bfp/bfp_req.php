<div class="modal fade bd-example-modal-xl" id="bfpcheck_req" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width:90%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Check Requirements BFP</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" id="bfp_id_req" class="form-control">
          <input type="hidden" id="bfp_requester_req" class="form-control">
          <input type="hidden" id="bfp_request_id_req" class="form-control">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Owner Name:</label>
            <input type="text" id="bfp_owner_name" class="form-control" readonly>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Building / Facility / Structure / Business / Establishment id:</label>
            <input type="text" id="bfp_bfsbe" class="form-control" readonly>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Exact Address:</label>
            <input type="text" id="bfp_address" class="form-control" readonly>
          </div>
        </div>
        <hr>
        <div class="row">
           <div class="col-lg-4 col-md-4 col-sm-12">
              <label>Authorized Representative:</label>
              <input type="text" id="bfp_ar" class="form-control" readonly>
            </div>
             <div class="col-lg-4 col-md-4 col-sm-12">
              <label>Type of Occupancy / Business Nature:</label>
              <input type="text" id="bfp_tobn" class="form-control" readonly>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <label>Total Floor Area:</label>
              <input type="text" id="bfp_tfa" class="form-control" readonly>
            </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>No. of Storey:</label>
            <input type="text" id="bfp_nos" class="form-control" readonly>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Contact Number:</label>
            <input type="number" id="bfp_contact_no" class="form-control" readonly>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Email Address:</label>
            <input type="text" id="bfp_email" class="form-control" readonly>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Signature of Owner / Authorized Representative::</label>
            <br>
            <img src="" id="preview_soar" style="height:150px; width: 150px;">
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Fire Extinguisher Receipt:</label>
            <select id="bfp_fer_status" class="form-control">
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
            <div id="pdf-container_fer_bfp"></div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Assessment Record with Receipt(MTO):</label>
            <select id="bfp_arwr_status" class="form-control">
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
            <div id="pdf-container_arwr_bfp"></div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Building Permit:</label>
            <select id="bfp_bp_status" class="form-control">
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
            <div id="pdf-container_bp_bfp"></div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Occupancy Permit:</label>
            <select id="bfp_op_status" class="form-control">
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
            <div id="pdf-container_op_bfp"></div>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Fire Safety Inspection Certificate Application Form:</label>
             <select id="bfp_fscaf_status" class="form-control">
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
            <div id="pdf-container_fscaf_bfp"></div>
          </div>
        </div>
        <hr>
        <div class="row">
           <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Picture of Business:</label>
             <select id="bfp_pob_status" class="form-control">
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
            <div id="pdf-container_pob_bfp"></div>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Fire Code Payment:</label>
             <select id="bfp_fcp_status" class="form-control">
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
            <div id="pdf-container_fcp_bfp"></div>
          </div>
        </div>
      </div> 
          <div class="modal-footer">
            <div class="row">
               <div class="col-lg-4">
                    <div class="float-right">
                        <a href="#" class="btn btn-info" onclick="check_bfp_req()">Check&nbsp;Requirements</a>&ensp;
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="float-left">
                        <a href="#" class="btn btn-secondary modal-trigger" data-toggle="modal" data-target="#bfp_assessment" onclick="hide_modal()">Upload&nbsp;Assessment</a>&ensp;&ensp;
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="float-right">
                        <a href="#" class="btn btn-secondary modal-trigger" data-toggle="modal" data-target="#bfp_fsic" onclick="fsic_modal()">Issuance&nbsp;of&nbsp;FSIC</a>
                    </div>
                </div>
            </div>
          </div>
    </div>
  </div>
</div>