  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023-2030 <a href="#"></a>Business Permit</strong>
    <!-- 2014-2021. -->
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->
<?php
include '../../modals/logout.php';
include '../../modals/mpdc/mpdc_req.php';
include '../../modals/mpdc/mpdc_assessment.php';
include '../../modals/mto/mto_req.php';
include '../../modals/mto/mto_assessment.php';
include '../../modals/sanidad/sanidad_req.php';
include '../../modals/sanidad/sanitary_permit.php';
include '../../modals/menro/menro_req.php';
include '../../modals/meo/meo_req.php';
include '../../modals/bfp/bfp_req.php';
include '../../modals/bfp/bfp_assessment.php';
include '../../modals/bfp/bfp_fsic.php';
include '../../modals/bplo/bplo_req.php';
include '../../modals/bplo/bplo_bp.php';
?>
<!-- jQuery -->
<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- ChartJS -->
<script src="../../node_modules/chart.js/dist/chart.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
</body>
</html>
