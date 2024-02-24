<div class="modal fade bd-example-modal-xl" id="bplo_bp" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Upload Business Permit:</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <input type="hidden" name="bplo_assessment_id" id="bplo_assessment_id" class="form-control">
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <label>Business Permit File:</label>
            <input type="file" id="bplo_bp_file_for_issue" class="form-control" accept="application/pdf" required>
          </div>
        </div>
      </div>  
          <div class="modal-footer">
            <div class="row">
               <div class="col-lg-12">
                    <div class="float-right">
                        <a href="#" class="btn btn-lg btn-primary" onclick="bplo_issue_assessment()">Submit</a>
                      
                    </div>
                </div>
            </div>  
          </div>
    </div>
  </div>
</div>