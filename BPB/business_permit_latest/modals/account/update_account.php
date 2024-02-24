<div class="modal fade bd-example-modal-xl" id="edit_account" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Account Details</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
             <div class="modal-body">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <label>Full Name:</label>
                <input type="hidden" id="id_account">
                <input type="text" id="fullname_update" class="form-control" autocomplete="off">
              </div>
               <div class="col-lg-6 col-md-6 col-sm-12">
                 <label>Username:</label>
                 <input type="text" id="username_update" class="form-control" autocomplete="off">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                 <label>Password:</label>
                 <input type="password" id="password_update" class="form-control" autocomplete="off">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                 <label>User Type:</label>
                  <select id="role_update" class="form-control" onchange="">
                  <option value="">Select User Type</option>
                  <option value="sa">Admin</option>
                  <option value="approver">Approver</option>
                  <option value="user">User</option>
              </select> 
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                 <label>Department:</label>
                  <select id="dept_update" class="form-control" onchange="">
                  <option value="">Select Department</option>
                  <option value="mpdc">MPDC</option>
                  <option value="mto">MTO</option>
                  <option value="sanidad">SANIDAD</option>
                  <option value="menro">MENRO</option>
                  <option value="meo">MEO</option>
                  <option value="bfp">BFP</option>
                  <option value="bplo">BPLO</option>
              </select> 
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                 <label>Status:</label>
                  <select id="status_update" class="form-control" onchange="">
                  <option value="">Select Status</option>
                  <option value="0">For Approval</option>
                  <option value="1">Approved</option>
              </select> 
              </div>
            </div>
      </div>  

          </div>
        <hr>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <a href="#" class="btn btn-danger" onclick="delete_account()">Delete Account</a>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="float-right">
              <a href="#" class="btn btn-primary" onclick="update_account()">Update Account</a>
            </div>
          </div>
        </div>
        </div> 
    </div>
  </div>
</div>