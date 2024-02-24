<div class="modal fade bd-example-modal-xl" id="mpdc_assessment" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Upload Assessment:</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <!-- <form action="../../process/approver/mpdc_assessment.php" method="POST" enctype="multipart/form-data"> -->
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <input type="hidden" name="mpdc_assessment_id" id="mpdc_assessment_id" class="form-control">
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <label>Assessment File:</label>
            <input type="file" id="mpdc_assessment_file_for_issue" class="form-control" accept="application/pdf" required>
          </div>
        </div>
      </div>  
          <div class="modal-footer">
            <div class="row">
               <div class="col-lg-12">
                    <div class="float-right">
                        <!-- <input type="submit" name="mpdc_assessment" class="btn btn-lg btn-primary" value="Submit"> -->
                        <a href="#" class="btn btn-lg btn-primary" onclick="mpdc_issue_assessment()">Submit</a>
                      <!-- </form> -->
                    </div>
                </div>
            </div>  
          </div>
    </div>
  </div>
</div>