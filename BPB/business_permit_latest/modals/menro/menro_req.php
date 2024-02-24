<div class="modal fade bd-example-modal-xl" id="menrocheck_req" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
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
          <input type="hidden" id="menro_id_req" class="form-control">
          <input type="hidden" id="menro_requester_req" class="form-control">
          <input type="hidden" id="menro_request_id_req" class="form-control">
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <label>Recycle Bin:</label>
            <select id="menro_rb_status" class="form-control">
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
            <div id="pdf-container_rb_menro"></div>
          </div>
        </div>
      </div> 
          <div class="modal-footer">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <a href="#" class="btn btn-primary" onclick="approved_menro()">Approve Request</a>
                    </div>
                </div>
            </div>
          </div>
    </div>
  </div>
</div>