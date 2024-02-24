<div class="modal fade bd-example-modal-xl" id="meocheck_req" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
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
          <input type="hidden" id="meo_id_req" class="form-control">
          <input type="hidden" id="meo_requester_req" class="form-control">
          <input type="hidden" id="meo_request_id_req" class="form-control">
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <label>Occupancy Permit:</label>
            <select id="meo_op_status" class="form-control">
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
            <div id="pdf-container_ob_meo"></div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <label>Building Permit:</label>
            <select id="meo_bp_status" class="form-control">
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
            <div id="pdf-container_bp_meo"></div>
          </div>
        </div>
      </div> 
          <div class="modal-footer">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <a href="#" class="btn btn-primary" onclick="check_meo()">Check Requirements</a>
                    </div>
                </div>
            </div>
          </div>
    </div>
  </div>
</div>