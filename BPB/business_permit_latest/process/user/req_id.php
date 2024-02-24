<?php 
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");
$method = $_POST['method'];

if($method == 'check_req_id'){
	$requester = $_POST['requester'];

	## CHECK IF HAS FOR RENEWAL DATA
	$query = "SELECT id,request_id FROM mpdc_db WHERE requester = '$requester' AND req_type = 'renewal'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() AS $j){
			echo $request_id = $j['request_id'];
			$stmt = NULL;
		}
	}
	## IF NO FOR RENEW GENERATE NEW REQ ID
	else{
		$query = "SELECT id,request_id FROM mpdc_db WHERE requester = '$requester' AND req_type = 'registration'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			foreach($stmt->fetchALL() AS $j){
				echo $request_id = $j['request_id'];
				$stmt = NULL;
			}
		}else{
			$stmt = NULL;
	
			$prefix = "REQ:";
			$dateCode = date('ymd');
			$randomCode = mt_rand(10000,50000);
			echo $prefix."".$dateCode."".$randomCode;
		}	
	}


	// $query = "SELECT id,request_id FROM mpdc_db WHERE requester = '$requester' AND req_type = 'registration'";
	// $stmt = $conn->prepare($query);
	// $stmt->execute();
	// if ($stmt->rowCount() > 0) {
	// 	foreach($stmt->fetchALL() AS $j){
	// 		echo $request_id = $j['request_id'];
	// 		$stmt = NULL;
	// 	}
	// }else{
	// 	$stmt = NULL;

	// 	$prefix = "REQ:";
	// 	$dateCode = date('ymd');
	// 	$randomCode = mt_rand(10000,50000);
	// 	echo $prefix."".$dateCode."".$randomCode;
	// }
}

elseif($method == 'check_req_id_renewal'){
	$requester = $_POST['requester'];

	$query = "SELECT id,request_id FROM mpdc_db WHERE requester = '$requester' AND req_type = 'registration'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() AS $j){
			echo $request_id = $j['request_id'];
			$stmt = NULL;
		}
	}else{
		$stmt = NULL;

		$prefix = "REQ:";
		$dateCode = date('ymd');
		$randomCode = mt_rand(10000,50000);
		echo $prefix."".$dateCode."".$randomCode;
	}
}elseif ($method == 'check_status') {
	$requester = $_POST['requester'];
	$req_id = $_POST['req_id'];

	$query = "SELECT * FROM mpdc_db WHERE requester = '$requester' AND request_id = '$req_id'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() AS $j){
			$tct_status = $j['tct_status'];
			$dti_status = $j['dti_status'];
			$bcr_status = $j['bcr_status'];
			$csl_status = $j['csl_status'];
			$mc_status = $j['mc_status'];
			$dpwh_status = $j['dpwh_status'];
			$op_status = $j['op_status'];
			$pbp_status = $j['pbp_status'];
			$gs_status = $j['gs_status'];
			$bp_status = $j['bp_status'];

			if ($tct_status == '') {
				$tct_status = 'Pending';
			}else{
				$tct_status = ucfirst($j['tct_status']);
			}

			if ($dti_status == '') {
				$dti_status = 'Pending';
			}else{
				$dti_status = ucfirst($j['dti_status']);
			}
			if ($bcr_status == '') {
				$bcr_status = 'Pending';
			}else{
				$bcr_status = ucfirst($j['bcr_status']);
			}
			if ($csl_status == '') {
				$csl_status = 'Pending';
			}else{
				$csl_status = ucfirst($j['csl_status']);
			}
			if ($mc_status == '') {
				$mc_status = 'Pending';
			}else{
				$mc_status = ucfirst($j['mc_status']);
			}
			if ($dpwh_status == '') {
				$dpwh_status = 'Pending';
			}else{
				$dpwh_status = ucfirst($j['dpwh_status']);
			}
			if ($op_status == '') {
				$op_status = 'Pending';
			}else{
				$op_status = ucfirst($j['op_status']);
			}
			if ($pbp_status == '') {
				$pbp_status = 'Pending';
			}else{
				$pbp_status = ucfirst($j['pbp_status']);
			}
			if ($gs_status == '') {
				$gs_status = 'Pending';
			}else{
				$gs_status = ucfirst($j['gs_status']);
			}
			if ($bp_status == '') {
				$bp_status = 'Pending';
			}else{
				$bp_status = ucfirst($j['bp_status']);
			}

			echo $tct_status.'~!~'.$dti_status.'~!~'.$bcr_status.'~!~'.$csl_status.'~!~'.$mc_status.'~!~'.$dpwh_status.'~!~'.$op_status.'~!~'.$pbp_status.'~!~'.$gs_status.'~!~'.$bp_status.'~!~'.$j['applicant_name'].'~!~'.$j['applicant_address'].'~!~'.$j['owner'].'~!~'.$j['title_no'].'~!~'.$j['td_no'].'~!~'.$j['pin'].'~!~'.$j['total_area'].'~!~'.$j['location_lot'].'~!~'.$j['rol'].'~!~'.$j['sign_applicant'].'~!~'.$j['sign_owner'].'~!~'.$j['tct'].'~!~'.$j['dti'].'~!~'.$j['bcr'].'~!~'.$j['csl'].'~!~'.$j['mc'].'~!~'.$j['dpwh'].'~!~'.$j['op'].'~!~'.$j['pbp'].'~!~'.$j['gs'].'~!~'.$j['bp'];
			$stmt = NULL;
		}
	}else{
		echo "";
		$stmt = NULL;
	}
}elseif ($method == 'check_button') {
	$requester = $_POST['requester'];
	$req_id = $_POST['req_id'];

	$query = "SELECT * FROM mpdc_db WHERE requester = '$requester' AND request_id = '$req_id'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		echo 'existing';
		$stmt = NULL;
	}else{
		echo 'none';
		$stmt = NULL;
	}
}elseif ($method == 'submit_renewal_req') {
	$requester = $_POST['requester'];
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
	$renewal_lp = removeDataPrefix($_POST['renewal_lp']);

	$query = "SELECT requester, applicant_name, applicant_address, owner, title_no, td_no, pin, total_area, location_lot, rol, sign_applicant, sign_owner, tct, dti, bcr, csl, mc, dpwh, op, pbp, gs, bp, lp, req_type, assessment, assessment_receipt, date_submitted FROM mpdc_db WHERE requester = '$requester'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() AS $j){
			$requester = $j['requester'];
			$applicant_name = $j['applicant_name'];
			$applicant_address = $j['applicant_address'];
			$owner = $j['owner'];
			$title_no = $j['title_no'];
			$td_no = $j['td_no'];
			$pin = $j['pin'];
			$total_area = $j['total_area'];
			$location_lot = $j['location_lot'];
			$rol = $j['rol'];
			$sign_applicant = $j['sign_applicant'];
			$sign_owner = $j['sign_owner'];
			$tct = $j['tct'];
			$dti = $j['dti'];
			$bcr = $j['bcr'];
			$csl = $j['csl'];
			$mc = $j['mc'];
			$dpwh = $j['dpwh'];
			$op = $j['op'];
			$pbp = $j['pbp'];
			$gs = $j['gs'];
			$bp = $j['bp'];
			$assessment = $j['assessment'];
			$assessment_receipt = $j['assessment_receipt'];
			$stmt = NULL;

			$query = "INSERT INTO mpdc_db(requester, request_id, applicant_name, applicant_address, owner, title_no, td_no, pin, total_area, location_lot, rol, sign_applicant, sign_owner, tct, dti, bcr, csl, mc, dpwh, op, pbp, gs, bp, lp, req_type, assessment, assessment_receipt, date_submitted)VALUES('$requester', '$applicant_name', '$applicant_address', '$owner', '$title_no', '$td_no', '$pin', '$total_area', '$location_lot', '$rol', '$sign_applicant', '$sign_owner', '$tct', '$dti', '$bcr', '$csl', '$mc', '$dpwh', '$op', '$pbp', '$gs', '$bp', '$renewal_lp', '$req_type', '$assessment', '$assessment_receipt', '$server_date_time')";
			$stmt = $conn->prepare($query);
			if ($stmt->execute()) {
				echo 'success';
				$stmt = NULL;
			}else{
				echo 'error';
				$stmt = NULL;
			}
		}
	}else{
		$stmt = NULL;
		echo 'invalid';
	}
}



$conn = NULL;
?>