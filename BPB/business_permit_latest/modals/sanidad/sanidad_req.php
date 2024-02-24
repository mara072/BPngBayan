<div class="modal fade bd-example-modal-xl" id="sanidadcheck_req" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <input type="hidden" id="sanidad_id_req" class="form-control">
          <input type="hidden" id="sanidad_requester_req" class="form-control">
          <input type="hidden" id="sanidad_request_id_req" class="form-control">
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12">
            <label>Fecalysis:</label>
            <select id="sanidad_fecalysis_status" class="form-control">
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
            <div id="pdf-container_fecalysis_sanidad"></div>
          </div>
           <div class="col-lg-3 col-md-3 col-sm-12">
            <label>Urinalysis:</label>
             <select id="sanidad_urinalysis_status" class="form-control">
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
            <div id="pdf-container_urinalysis_sanidad"></div>
          </div>
           <div class="col-lg-3 col-md-3 col-sm-12">
            <label>Chest X-ray:</label>
             <select id="sanidad_xray_status" class="form-control">
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
            <div id="pdf-container_xray_sanidad"></div>
          </div>
           <div class="col-lg-3 col-md-3 col-sm-12">
            <label>Drug Test:</label>
             <select id="sanidad_dt_status" class="form-control">
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
            <div id="pdf-container_dt_sanidad"></div>
          </div>
        </div>
      </div> 
          <div class="modal-footer">
            <div class="row">
               <div class="col-lg-6">
                    <div class="float-right">
                        <a href="#" class="btn btn-info" onclick="check_sanidad_req()">Check&nbsp;Requirements</a>&ensp;
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="float-right">
                        <a href="#" class="btn btn-secondary modal-trigger" data-toggle="modal" data-target="#sanidad_assessment" onclick="hide_modal()">Upload&nbsp;Assessment</a>
                    </div>
                </div>
            </div>
          </div>
    </div>
  </div>
</div>