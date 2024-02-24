<div class="modal fade bd-example-modal-xl" id="mtocheck_req" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <input type="hidden" id="mto_id_req" class="form-control">
          <input type="hidden" id="mto_requester_req" class="form-control">
          <input type="hidden" id="mto_request_id_req" class="form-control">
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12">
            <label>Water Bill Payment:</label>
            <select id="mto_wbp_status" class="form-control">
              <option>Select Document Status</option>
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
            <div id="pdf-container_wbp_mto"></div>
          </div>
           <div class="col-lg-3 col-md-3 col-sm-12">
            <label>Real Property Tax Payment:</label>
             <select id="mto_rptp_status" class="form-control">
              <option>Select Document Status</option>
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
            <div id="pdf-container_rptp_mto"></div>
          </div>
           <div class="col-lg-3 col-md-3 col-sm-12">
            <label>Cedula:</label>
             <select id="mto_cedula_status" class="form-control">
              <option>Select Document Status</option>
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
            <div id="pdf-container_cedula_mto"></div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <label>Assesment Receipt:</label>
            <div id="pdf-container_ar_mto" style="padding-top: 63px;"></div>
          </div>
        </div>
      </div> 
          <div class="modal-footer">
            <div class="row">
               <div class="col-lg-4">
                    <div class="float-right">
                        <a href="#" class="btn btn-info" onclick="check_mto_req()">Check&nbsp;Requirements</a>&ensp;
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="float-right">
                        <a href="#" class="btn btn-secondary modal-trigger" data-toggle="modal" data-target="#mto_assessment" onclick="hide_modal()">Upload&nbsp;Assessment</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="float-left">
                        <a href="#" class="btn btn-primary" onclick="approved_mto()">Approve Request</a>
                    </div>
                </div>
            </div>
          </div>
    </div>
  </div>
</div>