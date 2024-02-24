<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];
if($method == 'submit_bp_req'){
	$req_id_ref = $_POST['req_id_ref'];
	$requester = $_POST['requester'];
	$applicant_name = $_POST['applicant_name'];
	$applicant_address = $_POST['applicant_address'];
	$owner = $_POST['owner'];
	$title_no = $_POST['title_no'];
	$td_no = $_POST['td_no'];
	$pin = $_POST['pin'];
	$total_area = $_POST['total_area'];
	$location_lot = $_POST['location_lot'];
	$rol = $_POST['rol'];
	$sa_file = $_POST['sa_file'];
	$so_file = $_POST['so_file'];
	$tct_file = $_POST['tct_file'];
	$dti_file = $_POST['dti_file'];
	$bcr_file = $_POST['bcr_file'];
	$csl_file = $_POST['csl_file'];
	$mc_file = $_POST['mc_file'];
	$dpwh_file = $_POST['dpwh_file'];
	$op_file = $_POST['op_file'];
	$pbp_file = $_POST['pbp_file'];
	$gs_file = $_POST['gs_file'];
	$bp_file = $_POST['bp_file'];

	$query ="SELECT id FROM mpdc_db WHERE requester = '$requester' AND request_id = '$req_id_ref'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		echo "existing";
		$stmt = NULL;
	}else{
	$stmt = NULL;
	$query = "INSERT INTO mpdc_db(`requester`, `request_id`, `applicant_name`, `applicant_address`, `owner`, `title_no`, `td_no`, `pin`, `total_area`, `location_lot`, `rol`, `sign_applicant`, `sign_owner`, `tct`, `dti`, `bcr`, `csl`, `mc`, `dpwh`, `op`, `pbp`, `gs`, `bp`, `req_type`, `date_submitted`)VALUES('$requester','$req_id_ref','$applicant_name','$applicant_address','$owner','$title_no','$td_no','$pin','$total_area','$location_lot','$rol','$sa_file','$so_file','$tct_file','$dti_file','$bcr_file','$csl_file','$mc_file','$dpwh_file','$op_file','$pbp_file','$gs_file','$bp_file','registration','$server_date_time')";
            $stmt = $conn->prepare($query);
            if ($stmt->execute()) {
                 echo "success";
                $stmt = NULL;
            }else{
                echo "error";
                $stmt = NULL;
            } 
    } 
}elseif($method == 'update_bp_req'){

	$req_id_ref = $_POST['req_id_ref'];
	$requester = $_POST['requester'];
	$applicant_name = $_POST['applicant_name'];
	$applicant_address = $_POST['applicant_address'];
	$owner = $_POST['owner'];
	$title_no = $_POST['title_no'];
	$td_no = $_POST['td_no'];
	$pin = $_POST['pin'];
	$total_area = $_POST['total_area'];
	$location_lot = $_POST['location_lot'];
	$rol = $_POST['rol'];
	$sa_file_check = $_POST['sa_file_check'];
	$so_file_check = $_POST['so_file_check'];
	  function removeDataPrefix($base64String)
    {
        // Check if the string starts with "data:image" or "data:application"
        if (preg_match('/^data:(image|application)\/[a-z]+;base64,/', $base64String, $matches)) {
            // Remove the matched prefix
            return preg_replace('/^data:(image|application)\/[a-z]+;base64,/', '', $base64String);
        }
        return $base64String;
    }

	$sa_file = removeDataPrefix($_POST['sa_fileContent']);
    $so_file = removeDataPrefix($_POST['so_fileContent']);
    $tct_file = removeDataPrefix($_POST['tct_file']);
    $dti_file = removeDataPrefix($_POST['dti_file']);
    $bcr_file = removeDataPrefix($_POST['bcr_file']);
    $csl_file = removeDataPrefix($_POST['csl_file']);
    $mc_file = removeDataPrefix($_POST['mc_file']);
    $dpwh_file = removeDataPrefix($_POST['dpwh_file']);
    $op_file = removeDataPrefix($_POST['op_file']);
    $pbp_file = removeDataPrefix($_POST['pbp_file']);
    $gs_file = removeDataPrefix($_POST['gs_file']);
    $bp_file = removeDataPrefix($_POST['bp_file']);

    if ($sa_file == NULL) {
    	$sa_file = $sa_file_check;
    }else{
    	$sa_file = $sa_file;
    }

    if ($so_file == NULL) {
    	$so_file = $so_file_check;
    }else{
    	$so_file = $so_file;
    }

	$query = "UPDATE mpdc_db SET applicant_name = '$applicant_name', applicant_address = '$applicant_address', owner = '$owner', title_no = '$title_no', td_no = '$td_no', pin = '$pin', total_area = '$total_area', location_lot = '$location_lot', rol = '$rol', sign_applicant = '$sa_file', sign_owner = '$so_file', tct = '$tct_file', dti = '$dti_file', bcr = '$bcr_file', csl = '$csl_file', mc = '$mc_file', dpwh = '$dpwh_file', op = '$op_file', pbp = '$pbp_file', gs = '$gs_file', bp = '$bp_file', date_updated = '$server_date_time'";
            $stmt = $conn->prepare($query);
            if ($stmt->execute()) {
                 echo "success";
                $stmt = NULL;
            }else{
                echo "error";
                $stmt = NULL;
            } 
}elseif ($method == 'check_assessment') {
	 $req_id = $_POST['req_id'];

	 $query = "SELECT assessment FROM mpdc_db WHERE request_id = '$req_id'";
	 $stmt = $conn->prepare($query);
	 $stmt->execute();
	 if ($stmt->rowCount() > 0) {
	 	foreach ($stmt->fetchAll() AS $j) {
	 		echo $j['assessment'];
	 		$stmt = NULL;
	 	}
	 }
}elseif ($method == 'check_lp') {
	$req_id = $_POST['req_id'];

	 $query = "SELECT lp FROM mpdc_db WHERE request_id = '$req_id'";
	 $stmt = $conn->prepare($query);
	 $stmt->execute();
	 if ($stmt->rowCount() > 0) {
	 	foreach ($stmt->fetchAll() AS $j) {
	 		echo $j['lp'];
	 		$stmt = NULL;
	 	}
	 }
}elseif ($method == 'submit_mpdc_receipt') {
	$req_id_ref = $_POST['req_id_ref'];
	
	function removeDataPrefix($base64String)
    {
        // Check if the string starts with "data:image" or "data:application"
        if (preg_match('/^data:(image|application)\/[a-z]+;base64,/', $base64String, $matches)) {
            // Remove the matched prefix
            return preg_replace('/^data:(image|application)\/[a-z]+;base64,/', '', $base64String);
        }
        return $base64String;
    }
	$assessment_receipt = removeDataPrefix($_POST['assessment']);

	$query = "UPDATE mpdc_db SET assessment_receipt = '$assessment_receipt' WHERE request_id = '$req_id_ref'";
	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		echo "success";
		$stmt = NULL;
	}else{
		echo "error";
		$stmt = NULL;
	}	
}elseif ($method == 'check_status') {
	$requester = $_POST['requester'];
	$req_id = $_POST['req_id'];

	$query = "SELECT * FROM mpdc_db WHERE requester = '$requester' AND request_id = '$req_id'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() AS $j){
            $f_status = $j['f_status'];
			
            if ($f_status == '') {
                $f_status = 'Pending';
            }else{
                $f_status = ucfirst($j['f_status']);
            }
		echo $f_status;
		}
	}else{ 
		echo '';
		$stmt = NULL;
	}
}
$conn = NULL;
?>