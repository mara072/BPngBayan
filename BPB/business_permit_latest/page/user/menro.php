<?php
include 'plugins/navbar.php';
include 'plugins/sidebar/menrobar.php';
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Upload Requirements & Status</b></h1>
            <br>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><b>Upload Requirements & Status</b></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      	<div class="col-lg-12 col-md-12 col-sm-12">
      		<div class="card card-primary">
              <div class="card-header">
                 <!-- <form action="../../process/user/processor.php" method="POST" enctype="multipart/form-data"> -->
                <h3 class="card-title"><label id="req_id"></label></h3>
              </div>
              <div class="card-body">
              	<div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-secondary">
                      <div class="card-header">
                        <h3 class="card-title"><label>Upload Requirements</label></h3>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <input type="hidden" name="req_id_ref" id="req_id_ref">
                          <input type="hidden" name="requester" id="requester" value="<?=$uname;?>">
                          <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Recycle Bin:</label>
                            <input type="file" id="rb_file" class="form-control" accept="application/pdf" >
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Status:</label>
                            <input type="text" id="rb_status" class="form-control" readonly>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="float-right">
                              <!-- <input type="submit" name="submit_menro_req" class="btn btn-lg btn-primary" value="Submit"> -->
                              <a href="#" class="btn btn-lg btn-primary" onclick="submit_menro_reqs()">Submit</a>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-12">
                  </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
      	</div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php
include 'plugins/footer.php';
include 'plugins/javascript/menro_script.php';
?>