<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];


if ($method == 'mto_requirements') {
	$requester = $_POST['requester'];
	$request_type = $_POST['request_type'];
	$c = 0;

	$query ="SELECT * FROM mto_db WHERE requester LIKE '$requester%' AND req_type LIKE '$request_type%'";
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
			echo '<tr style="cursor:pointer; color:'.$color.';" class="modal-trigger" data-toggle="modal" data-target="#mtocheck_req" onclick="get_mtoreq_details(&quot;'.$j['id'].'~!~'.$j['requester'].'~!~'.$j['request_id'].'~!~'.$j['wbp'].'~!~'.$j['wbp_status'].'~!~'.$j['rptp'].'~!~'.$j['rptp_status'].'~!~'.$j['cedula'].'~!~'.$j['cedula_status'].'~!~'.$j['assessment_receipt'].'&quot;)">';
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
}elseif ($method == 'check_mto_req') {
	$id = $_POST['id'];
	$requester = $_POST['requester'];
	$request_id = $_POST['request_id'];
	$wbp = $_POST['wbp'];
	$rptp = $_POST['rptp'];
	$cedula = $_POST['cedula'];

	$query = "UPDATE mto_db SET wbp_status = '$wbp',rptp_status = '$rptp', cedula_status = '$cedula', date_updated = '$server_date_time' WHERE id = '$id'";

	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		echo 'success';
		$stmt = NULL;
	}else{
		echo 'error';
		$stmt = NULL;
	}
}elseif ($method == 'approved_mto') {
	$id = $_POST['id'];

	$query = "UPDATE mto_db SET f_status = 'approved', date_updated = '$server_date_time' WHERE id = '$id'";

	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		echo 'success';
		$stmt = NULL;
	}else{
		echo 'error';
		$stmt = NULL;
	}
}elseif ($method == 'mto_issue_assessment') {
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
	$mto_file = removeDataPrefix($_POST['mto_file']);

	$query = "SELECT * FROM mto_db WHERE id = '$id' AND wbp_status = 'Approved' OR rptp_status = 'Approved' OR cedula_status = 'Approved'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() < 0) {
		echo 'invalid';
		$stmt = NULL;
	}else{
		$stmt = NULL;

	$query = "UPDATE mto_db SET assessment_record = '$mto_file' WHERE id = '$id'";
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