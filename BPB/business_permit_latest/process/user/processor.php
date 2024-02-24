<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");
if (isset($_POST['submit_bp_req'])) {
    $requester = $_POST['requester'];
    $req_id_ref = $_POST['req_id_ref'];
    $applicant_name = $_POST['applicant_name'];
    $applicant_address = $_POST['applicant_address'];
    $owner = $_POST['owner'];
    $title_no = $_POST['title_no'];
    $td_no = $_POST['td_no'];
    $pin = $_POST['pin'];
    $total_area = $_POST['total_area'];
    $location_lot = $_POST['location_lot'];
    $rol = $_POST['rol'];
    $sa_file = ($_FILES['sa_file']['tmp_name']);
    $so_file = ($_FILES['so_file']['tmp_name']);
    $tct_file = ($_FILES['tct_file']['tmp_name']);
    $dti_file = ($_FILES['dti_file']['tmp_name']);
    $bcr_file = ($_FILES['bcr_file']['tmp_name']);
    $csl_file = ($_FILES['csl_file']['tmp_name']);
    $mc_file = ($_FILES['mc_file']['tmp_name']);
    $dpwh_file = ($_FILES['dpwh_file']['tmp_name']);
    $op_file = ($_FILES['op_file']['tmp_name']);
    $pbp_file = ($_FILES['pbp_file']['tmp_name']);
    $gs_file = ($_FILES['gs_file']['tmp_name']);
    $bp_file = ($_FILES['bp_file']['tmp_name']);

    if (empty($sa_file)) {
        $sa = '';
    }else{
        $sa_file = file_get_contents($sa_file);
        $sa = base64_encode($sa_file);
    } 

    if (empty($so_file)) {
        $so = '';
    }else{
        $so_file = file_get_contents($so_file);
        $so = base64_encode($so_file);
    }

    if (empty($tct_file)) {
        $tct = '';
    }else{
        $tct_file = file_get_contents($tct_file);
        $tct = base64_encode($tct_file);
    }

    if (empty($dti_file)) {
        $dti = '';
    }else{
        $dti_file = file_get_contents($dti_file);
        $dti = base64_encode($dti_file);
    }

    if (empty($bcr_file)) {
        $bcr = '';
    }else{
        $bcr_file = file_get_contents($bcr_file);
        $bcr = base64_encode($bcr_file);
    }

    if (empty($csl_file)) {
        $csl = '';
    }else{
        $csl_file = file_get_contents($csl_file);
        $csl = base64_encode($csl_file);
    }

    if (empty($mc_file)) {
        $mc = '';
    }else{
        $mc_file = file_get_contents($mc_file);
        $mc = base64_encode($mc_file);
    }

    if (empty($dpwh_file)) {
        $dpwh = '';
    }else{
        $dpwh_file = file_get_contents($dpwh_file);
        $dpwh = base64_encode($dpwh_file);
    }

    if (empty($op_file)) {
        $op = '';
    }else{
        $op_file = file_get_contents($op_file);
        $op = base64_encode($op_file);
    }

    if (empty($pbp_file)) {
        $pbp = '';
    }else{
        $pbp_file = file_get_contents($pbp_file);
        $pbp = base64_encode($pbp_file);
    }

    if (empty($gs_file)) {
        $gs = '';
    }else{
        $gs_file = file_get_contents($gs_file);
        $gs = base64_encode($gs_file);
    }

    if (empty($bp_file)) {
        $bp = '';
    }else{
        $bp_file = file_get_contents($bp_file);
        $bp = base64_encode($bp_file);
    }


        $query = "INSERT INTO mpdc_db(`requester`, `request_id`, `applicant_name`, `applicant_address`, `owner`, `title_no`, `td_no`, `pin`, `total_area`, `location_lot`, `rol`, `sign_applicant`, `sign_owner`, `tct`, `dti`, `bcr`, `csl`, `mc`, `dpwh`, `op`, `pbp`, `gs`, `bp`, `req_type`, `date_submitted`)VALUES('$requester','$req_id_ref','$applicant_name','$applicant_address','$owner','$title_no','$td_no','$pin','$total_area','$location_lot','$rol','$sa','$so','$tct','$dti','$bcr','$csl','$mc','$dpwh','$op','$pbp','$gs','$bp','registration','$server_date_time')";
            $stmt = $conn->prepare($query);
            if ($stmt->execute()) {
                 echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/dashboard.php";</script>';
                $stmt = NULL;
            }else{
                echo '<script>alert("Error"); window.location.href="../../page/user/dashboard.php";</script>';
                $stmt = NULL;
            }  
}elseif (isset($_POST['submit_mto_req'])) {
    $requester = $_POST['requester'];
    $req_id_ref = $_POST['req_id_ref'];

    $wbp_file = ($_FILES['wbp_file']['tmp_name']);
    $rptp_file = ($_FILES['rptp_file']['tmp_name']);
    $cedula_file = ($_FILES['cedula_file']['tmp_name']);

    if (empty($wbp_file)) {
        $mto_64base = '';
    }else{
        $wbp_file = file_get_contents($wbp_file);
        $wbp = base64_encode($wbp_file);
    }

    if (empty($rptp_file)) {
        $rptp = '';
    }else{
        $rptp_file = file_get_contents($rptp_file);
        $rptp = base64_encode($rptp_file);
    }

    if (empty($cedula_file)) {
        $cedula = '';
    }else{
        $cedula_file = file_get_contents($cedula_file);
        $cedula = base64_encode($cedula_file);
    }

    $query ="SELECT id FROM mto_db WHERE requester = '$requester' AND request_id = '$req_id_ref'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $stmt = NULL;
        $query = "UPDATE mto_db SET wbp = '$wbp', rptp = '$rptp', cedula = '$cedula' , date_updated = '$server_date_time' WHERE requester = '$requester' AND request_id = '$req_id_ref'";
         $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
             echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/dashboard.php";</script>';
              $stmt = NULL;
         }else{
           echo '<script>alert("Error"); window.location.href="../../page/user/dashboard.php";</script>';
             $stmt = NULL;
         }
    }else{
        $stmt = NULL;
        $query = "INSERT INTO mto_db (`requester`,`request_id`,`wbp`,`rptp`,`cedula`,`req_type`,`date_submitted`)VALUES('$requester','$req_id_ref','$wbp','$rptp','$cedula','registration',$server_date_time')";
         $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
             echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/dashboard.php";</script>';
              $stmt = NULL;
         }else{
            echo '<script>alert("Error"); window.location.href="../../page/user/dashboard.php";</script>';
             $stmt = NULL;
         }
    }
}elseif (isset($_POST['submit_mto_receipt'])) {
    $req_id_ref = $_POST['req_id_ref_mto_receipt'];
    $mto_receipt_file = ($_FILES['mto_receipt_file']['tmp_name']);

    if (empty($mto_receipt_file)) {
        $ar = '';
    }else{
        $mto_receipt_file = file_get_contents($mto_receipt_file);
        $ar = base64_encode($mto_receipt_file);
    }

    $query = "UPDATE mto_db SET assessment_receipt = '$ar' WHERE request_id = '$req_id_ref'";
    $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
             echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/mto.php";</script>';
              $stmt = NULL;
         }else{
            echo '<script>alert("Error"); window.location.href="../../page/user/mto.php";</script>';
             $stmt = NULL;
         }
}elseif (isset($_POST['submit_sanidad_reqs'])) {
    $req_id_ref = $_POST['req_id_ref'];
    $requester = $_POST['requester'];
    $fecalysis_file = ($_FILES['fecalysis_file']['tmp_name']);
    $urinalysis_file = ($_FILES['urinalysis_file']['tmp_name']);
    $xray_file = ($_FILES['xray_file']['tmp_name']);
    $drug_test_file = ($_FILES['drug_test_file']['tmp_name']);
   
    if (empty($fecalysis_file)) {
        $fecalysis = '';
    }else{
        $fecalysis_file = file_get_contents($fecalysis_file);
        $fecalysis = base64_encode($fecalysis_file);
    }

    if (empty($urinalysis_file)) {
        $urinalysis = '';
    }else{
        $urinalysis_file = file_get_contents($urinalysis_file);
        $urinalysis = base64_encode($urinalysis_file);
    }

    if (empty($xray_file)) {
        $xray = '';
    }else{
        $xray_file = file_get_contents($xray_file);
        $xray = base64_encode($xray_file);
    }

    if (empty($drug_test_file)) {
        $drug_test = '';
    }else{
        $drug_test_file = file_get_contents($drug_test_file);
        $drug_test = base64_encode($drug_test_file);
    }

    $query ="SELECT id FROM sanidad_db WHERE requester = '$requester' AND request_id = '$req_id_ref'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $stmt = NULL;
        $query = "UPDATE sanidad_db SET fecalysis = '$fecalysis', urinalysis = '$urinalysis', chest_xray = '$xray', drug_test = '$drug_test' , date_updated = '$server_date_time' WHERE requester = '$requester' AND request_id = '$req_id_ref'";
         $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
             echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/sanidad.php";</script>';
              $stmt = NULL;
         }else{
           echo '<script>alert("Error"); window.location.href="../../page/user/sanidad.php";</script>';
             $stmt = NULL;
         }
    }else{
        $stmt = NULL;
        $query = "INSERT INTO sanidad_db (`requester`,`request_id`,`fecalysis`,`urinalysis`,`chest_xray`,`drug_test`,`req_type`,`date_submitted`)VALUES('$requester','$req_id_ref','$fecalysis','$urinalysis','$xray','$drug_test','registration','$server_date_time')";
         $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
             echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/sanidad.php";</script>';
              $stmt = NULL;
         }else{
            echo '<script>alert("Error"); window.location.href="../../page/user/sanidad.php";</script>';
             $stmt = NULL;
         }
    } 
}elseif (isset($_POST['submit_menro_req'])) {
    $req_id_ref = $_POST['req_id_ref'];
    $requester = $_POST['requester'];
    $rb_file = ($_FILES['rb_file']['tmp_name']);
   
    if (empty($rb_file)) {
        $rb = '';
    }else{
        $rb_file = file_get_contents($rb_file);
        $rb = base64_encode($rb_file);
    }

    $query ="SELECT id FROM menro_db WHERE requester = '$requester' AND request_id = '$req_id_ref'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $stmt = NULL;
        $query = "UPDATE menro_db SET rb = '$rb', date_updated = '$server_date_time' WHERE requester = '$requester' AND request_id = '$req_id_ref'";
         $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
             echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/menro.php";</script>';
              $stmt = NULL;
         }else{
           echo '<script>alert("Error"); window.location.href="../../page/user/menro.php";</script>';
             $stmt = NULL;
         }
    }else{
        $stmt = NULL;
        $query = "INSERT INTO menro_db (`requester`,`request_id`,`rb`,`req_type`,`date_submitted`)VALUES('$requester','$req_id_ref','$rb','registration','$server_date_time')";
         $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
             echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/menro.php";</script>';
              $stmt = NULL;
         }else{
            echo '<script>alert("Error"); window.location.href="../../page/user/menro.php";</script>';
             $stmt = NULL;
         }
    } 
}elseif (isset($_POST['submit_meo_req'])) {
    $req_id_ref = $_POST['req_id_ref'];
    $requester = $_POST['requester'];
    $rb_file = ($_FILES['rb_file']['tmp_name']);
   
    if (empty($rb_file)) {
        $rb = '';
    }else{
        $rb_file = file_get_contents($rb_file);
        $rb = base64_encode($rb_file);
    }

    $query ="SELECT id FROM meo_db WHERE requester = '$requester' AND request_id = '$req_id_ref'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $stmt = NULL;
        $query = "UPDATE meo_db SET rb = '$rb', date_updated = '$server_date_time' WHERE requester = '$requester' AND request_id = '$req_id_ref'";
         $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
             echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/meo.php";</script>';
              $stmt = NULL;
         }else{
           echo '<script>alert("Error"); window.location.href="../../page/user/meo.php";</script>';
             $stmt = NULL;
         }
    }else{
        $stmt = NULL;
        $query = "INSERT INTO meo_db (`requester`,`request_id`,`rb`,`req_type`,`date_submitted`)VALUES('$requester','$req_id_ref','$rb','registration','$server_date_time')";
         $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
             echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/meo.php";</script>';
              $stmt = NULL;
         }else{
            echo '<script>alert("Error"); window.location.href="../../page/user/meo.php";</script>';
             $stmt = NULL;
         }
    } 
}elseif (isset($_POST['submit_bfp_req'])) {
   $req_id_ref = $_POST['req_id_ref3'];
   $requester = $_POST['requester'];
   $owner = $_POST['owner_name'];
   $bfsben = $_POST['bfsbe'];
   $exact_address = $_POST['address'];
   $ar = $_POST['ar'];
   $tobn = $_POST['tobn'];
   $tfa = $_POST['tfa'];
   $nos = $_POST['nos'];
   $contact_no = $_POST['contact_no'];
   $email = $_POST['email'];
   $soar_file = ($_FILES['soar_file']['tmp_name']);
   $fer_file = ($_FILES['fer_file']['tmp_name']);
   $bp_file = ($_FILES['bp_file']['tmp_name']);
   $op_file = ($_FILES['op_file']['tmp_name']);
   $fsicaf_file = ($_FILES['fsicaf_file']['tmp_name']);
   $arwr_file = ($_FILES['arwr_file']['tmp_name']);
   $pob_file = ($_FILES['pob_file']['tmp_name']);

    
    if (empty($soar_file)) {
        $soar = '';
    }else{
        $soar_file = file_get_contents($soar_file);
        $soar = base64_encode($soar_file);
    } 

    if (empty($fer_file)) {
        $fer = '';
    }else{
        $fer_file = file_get_contents($fer_file);
        $fer = base64_encode($fer_file);
    } 

    if (empty($bp_file)) {
        $bp = '';
    }else{
        $bp_file = file_get_contents($bp_file);
        $bp = base64_encode($bp_file);
    } 

    if (empty($op_file)) {
        $op = '';
    }else{
        $op_file = file_get_contents($op_file);
        $op = base64_encode($op_file);
    } 

    if (empty($fsicaf_file)) {
        $fsicaf = '';
    }else{
        $fsicaf_file = file_get_contents($fsicaf_file);
        $fsicaf = base64_encode($fsicaf_file);
    }

    if (empty($arwr_file)) {
        $arwr = '';
    }else{
        $arwr_file = file_get_contents($arwr_file);
        $arwr = base64_encode($arwr_file);
    } 

    if (empty($pob_file)) {
        $pob = '';
    }else{
        $pob_file = file_get_contents($pob_file);
        $pob = base64_encode($pob_file);
    }  

    $query ="SELECT id FROM bfp_db WHERE requester = '$requester' AND request_id = '$req_id_ref'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $stmt = NULL;
        $query = "UPDATE bfp_db SET owner = '$owner', exact_address = '$exact_address', bfsben = '$bfsben', authorized_rep = '$ar', tobn = '$tobn', tfa = '$tfa', storey_no = '$nos', email_address = '$email', contact_no = '$contact_no', owner_sign = '$soar', fire_ex_receipt = '$fer', building_permit = '$bp', occupancy_permit = '$op', fsca = '$fsicaf', arr = '$arwr', pob = '$pob', date_updated = '$server_date_time' WHERE requester = '$requester' AND request_id = '$req_id_ref'";
         $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
             echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/bfp.php";</script>';
              $stmt = NULL;
         }else{
           echo '<script>alert("Error"); window.location.href="../../page/user/bfp.php";</script>';
             $stmt = NULL;
         }
    }else{
        $stmt = NULL;
        $query = "INSERT INTO bfp_db(`requester`, `request_id`, `owner`, `exact_address`, `bfsben`, `authorized_rep`, `tobn`, `tfa`, `storey_no`, `email_address`, `contact_no`, `owner_sign`, `fire_ex_receipt`, `building_permit`, `occupancy_permit`, `fsca`, `arr`, `pob`, `req_type`, `date_submitted`) VALUES ('$requester','$req_id_ref','$owner','$exact_address','$bfsben','$ar','$tobn','$tfa','$nos','$email','$contact_no','$soar','$fer','$bp','$op','$fsicaf','$arwr','$pob','registration','$server_date_time')";
         $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
             echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/bfp.php";</script>';
              $stmt = NULL;
         }else{
            echo '<script>alert("Error"); window.location.href="../../page/user/bfp.php";</script>';
             $stmt = NULL;
         }
    }
}

$conn = NULL;
?>