  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="../../dist/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b class="text-md">&ensp; BPB:Business Permit</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=ucfirst($uname);?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link">
                <i class="nav-icon fas fa-desktop"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
           <!--  <li class="nav-item">
              <a href="employee_details.php" class="nav-link">
                <i class="nav-icon far fa-address-card"></i>
                <p>
                  Apply / Renew Business Permit
                </p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="#" class="nav-link">
              <i class="nav-icon far fa-file-alt"></i>
              <p>
              Business Permit
              <i class="right fas fa-angle-left"></i>
              </p>
              </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="bp_apply.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Apply</p>
              </a>
              </li>
              <li class="nav-item">
              <a href="bp_renew.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>History</p>
              </a>
              </li>
              </ul>
             </li>
             <li class="nav-item">
              <a href="mpdc.php" class="nav-link">
                <i class="nav-icon  fas fa-users"></i>
                <p>
                  MPDC
                </p>
              </a>
            </li>
             <li class="nav-item">
              <a href="mto.php" class="nav-link ">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  MTO
                </p>
              </a>
            </li>
             <li class="nav-item">
              <a href="sanidad.php" class="nav-link active">
                <i class="nav-icon  fas fa-users"></i>
                <p>
                  SANIDAD
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="menro.php" class="nav-link">
                <i class="nav-icon  fas fa-users"></i>
                <p>
                  MENRO
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="meo.php" class="nav-link">
                <i class="nav-icon  fas fa-users"></i>
                <p>
                  MEO
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="bfp.php" class="nav-link">
                <i class="nav-icon  fas fa-users"></i>
                <p>
                  BFP
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="bplo.php" class="nav-link">
                <i class="nav-icon  fas fa-users"></i>
                <p>
                  BPLO
                </p>
              </a>
            </li>
             <?php include 'logout.php' ;?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>