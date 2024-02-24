<div class="modal fade bd-example-modal-xl" id="bplocheck_req" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width:90%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
        <b>Graph</b>
            <b>Check Requirements</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" id="bplo_id_req" class="form-control">
          <input type="hidden" id="bplo_requester_req" class="form-control">
          <input type="hidden" id="bplo_request_id_req" class="form-control">
        </div>
        <div class="row">
           <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Cedula:</label>
             <select id="bplo_cedula_status" class="form-control">
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
            <div id="pdf-container_cedula_bplo"></div>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-12">
            <label>DTI:</label>
             <select id="bplo_dti_status" class="form-control">
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
            <div id="pdf-container_dti_bplo"></div>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-12">
            <label>Brgy. Business Clearance & Official Receipt:</label>
             <select id="bplo_bbcor_status" class="form-control">
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
            <div id="pdf-container_bbcor_bplo"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <label>SSS Certificate of Compliance:</label>
             <select id="bplo_scc_status" class="form-control">
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
            <div id="pdf-container_scc_bplo"></div>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-12">
            <label>2x2 Picture(2pcs):</label>
             <select id="bplo_pic_status" class="form-control">
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
            <div id="pdf-container_pic_bplo"></div>
          </div>
        </div>
      </div> 
          <div class="modal-footer">
            <div class="row">
               <div class="col-lg-6">
                    <div class="float-right">
                        <a href="#" class="btn btn-info" onclick="check_bplo_req()">Check&nbsp;Requirements</a>&ensp;
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="float-right">
                        <a href="#" class="btn btn-secondary modal-trigger" data-toggle="modal" data-target="#bplo_bp" onclick="hide_modal()">Issue&nbsp;Business Permit</a>
                    </div>
                </div>
            </div>
          </div>
    </div>
  </div>
</div>