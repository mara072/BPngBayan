<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];


if ($method == 'mpdc_requirements') {
	$requester = $_POST['requester'];
	$request_type = $_POST['request_type'];
	$c = 0;

	$query ="SELECT * FROM mpdc_db WHERE requester LIKE '$requester%' AND req_type LIKE '$request_type%'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() AS $j){
			$f_status = $j['f_status'];
			if ($f_status == '') {
				$f_status = 'PENDING';
				$color = 'red';
			}else{
				$f_status = strtoupper($j['f_status']);
				$color = '';
			}
			$c++;
			echo '<tr style="cursor:pointer; color:'.$color.';" class="modal-trigger" data-toggle="modal" data-target="#check_req" onclick="get_req_details(&quot;'.$j['id'].'~!~'.$j['requester'].'~!~'.$j['request_id'].'~!~'.$j['applicant_name'].'~!~'.$j['applicant_address'].'~!~'.$j['owner'].'~!~'.$j['title_no'].'~!~'.$j['td_no'].'~!~'.$j['pin'].'~!~'.$j['total_area'].'~!~'.$j['location_lot'].'~!~'.$j['rol'].'~!~'.$j['sign_applicant'].'~!~'.$j['sign_owner'].'~!~'.$j['tct'].'~!~'.$j['tct_status'].'~!~'.$j['dti'].'~!~'.$j['dti_status'].'~!~'.$j['bcr'].'~!~'.$j['bcr_status'].'~!~'.$j['csl'].'~!~'.$j['csl_status'].'~!~'.$j['mc'].'~!~'.$j['mc_status'].'~!~'.$j['dpwh'].'~!~'.$j['dpwh_status'].'~!~'.$j['op'].'~!~'.$j['op_status'].'~!~'.$j['pbp'].'~!~'.$j['pbp_status'].'~!~'.$j['gs'].'~!~'.$j['gs_status'].'~!~'.$j['bp'].'~!~'.$j['bp_status'].'~!~'.$j['assessment_receipt'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['request_id'].'</td>';
				echo '<td>'.$j['requester'].'</td>';
				echo '<td>'.strtoupper($j['req_type']).'</td>';
				echo '<td>'.$f_status.'</td>';
			echo '</tr>';
			$stmt = NULL;
		}
	}else{
		echo '<tr>';
			echo '<td style="text-align:center; color:red;" colspan="5">No Result</td>';
		echo '</tr>';
		$stmt = NULL;
	}
}elseif ($method == 'check_mpdc_req') {
	$id = $_POST['id'];
	$requester = $_POST['requester'];
	$request_id = $_POST['request_id'];
	$tct_status = $_POST['tct_status'];
	$dti_status = $_POST['dti_status'];
	$bcr_status = $_POST['bcr_status'];
	$csl_status = $_POST['csl_status'];
	$mc_status = $_POST['mc_status'];
	$dpwh_status = $_POST['dpwh_status'];
	$op_status = $_POST['op_status'];
	$pbp_status = $_POST['pbp_status'];
	$gs_status = $_POST['gs_status'];
	$bp_status = $_POST['bp_status'];

	$query = "UPDATE mpdc_db SET tct_status = '$tct_status',dti_status = '$dti_status', bcr_status = '$bcr_status', csl_status = '$csl_status', mc_status = '$mc_status', dpwh_status = '$dpwh_status', op_status ='$op_status', pbp_status = '$pbp_status', gs_status = '$gs_status', bp_status = '$bp_status', date_updated = '$server_date_time' WHERE id = '$id'";

	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		echo 'success';
		$stmt = NULL;
	}else{
		echo 'error';
		$stmt = NULL;
	}
}elseif ($method == 'check_status') {
	$id = $_POST['id'];

	$query = "SELECT f_status FROM mpdc_db WHERE id = '$id'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
}elseif ($method == 'mpdc_issue_assessment') {
	$id = $_POST['id'];
	 function removeDataPrefix($base64String)
    {
        // Check if the string starts with "data:image" or "data:application"
        if (preg_match('/^data:(image|application)\/[a-z]+;base64,/', $base64String, $matches)) {
            // Remove the matched prefix
            return preg_replace('/^data:(image|application)\/[a-z]+;base64,/', '', $base64String);
        }
        return $base64String;
    }
	$mpdc_file = removeDataPrefix($_POST['mpdc_file']);

	$query = "SELECT * FROM mpdc_db WHERE id = '$id' AND tct_status = 'Approved' OR dti_status = 'Approved' OR  bcr_status = 'Approved' OR  csl_status = 'Approved' OR  mc_status = 'Approved' OR  dpwh_status = 'Approved' OR  op_status ='Approved' OR  pbp_status = 'Approved' OR  gs_status = 'Approved' OR  bp_status = 'Approved'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() < 0) {
		echo 'invalid';
		$stmt = NULL;
	}else{
		$stmt = NULL;
	$query = "UPDATE mpdc_db SET assessment = '$mpdc_file' WHERE id = '$id'";
	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		echo "success";
		$stmt = NULL;
	}else{
		echo "error";
		$stmt = NULL;
	}

	}
}elseif ($method == 'issue_permit_mpdc') {
	$id = $_POST['id'];

	 function removeDataPrefix($base64String)
    {
        // Check if the string starts with "data:image" or "data:application"
        if (preg_match('/^data:(image|application)\/[a-z]+;base64,/', $base64String, $matches)) {
            // Remove the matched prefix
            return preg_replace('/^data:(image|application)\/[a-z]+;base64,/', '', $base64String);
        }
        return $base64String;
    }
	$lcbp_files = removeDataPrefix($_POST['lcbp_files']);

	$query = "SELECT * FROM mpdc_db WHERE id = '$id' AND assessment_receipt = ''";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() < 0) {
		echo 'invalid';
		$stmt = NULL;
	}else{
		$stmt = NULL;

	$query = "UPDATE mpdc_db SET lp = '$lcbp_files', f_status = 'approved' WHERE id = '$id'";
	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		echo "success";
		$stmt = NULL;
	}else{
		echo "error";
		$stmt = NULL;
	}
	}
}

$conn = NULL;
?>