
<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/accountbar.php';?>
  <!-- Main Sidebar Container -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Account Management</b></h1><br>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Account Management</li>
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#add_account">Add Account</a>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
<div class="card-body">
  <div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
          <span><b>Username:</b></span>
          <input type="text" id="account_username_search" class="form-control" style="height:45px; border: 1px solid black; font-size: 25px;">
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12" style="padding-top: 20px;">
          <div class="float-right">
            <a href="#" class="btn btn-primary" onclick="search_account()">Search &ensp;<i class="fas fa-search"></i> </a>
          </div>
        </div>
       </div>
    <br>
    <div class="row">
         <div class="col-12">
            <div class="card-body table-responsive p-0" style="height: 420px;">
              <table class="table table-head-fixed text-nowrap table-hover" id="">
                  <thead style="text-align:center;">
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>User Type</th>
                    <th>Status</th>
                  </thead>
                  <tbody id="list_of_accounts" style="text-align:center;"></tbody>
              </table>
              <div class="row">
                  <div class="col-6"></div>
                      <div class="col-6">   
                        <div class="spinner" id="spinner" style="display:none;">
                          <div class="loader float-sm-center"></div>    
                        </div>
                  </div>
                </div>
              </div>
          </div>
         
  <!-- end row -->
    </div>
   <!-- end container -->
  </div>

</div>
        <!-- /.card-body -->

                <div class="card-footer">
               
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php include 'plugins/footer.php';?>
<?php include 'plugins/javascript/account_script.php';?>