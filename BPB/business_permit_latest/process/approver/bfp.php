<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];

if ($method == 'bfp_requirements') {
	$requester = $_POST['requester'];
	$request_type = $_POST['request_type'];
	$c = 0;

	$query ="SELECT * FROM bfp_db WHERE requester LIKE '$requester%' AND req_type LIKE '$request_type%'";
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
			echo '<tr style="cursor:pointer; color:'.$color.';" class="modal-trigger" data-toggle="modal" data-target="#bfpcheck_req" onclick="get_bfpreq_details(&quot;'.$j['id'].'~!~'.$j['requester'].'~!~'.$j['request_id'].'~!~'.$j['owner'].'~!~'.$j['exact_address'].'~!~'.$j['bfsben'].'~!~'.$j['authorized_rep'].'~!~'.$j['tobn'].'~!~'.$j['tfa'].'~!~'.$j['storey_no'].'~!~'.$j['email_address'].'~!~'.$j['contact_no'].'~!~'.$j['owner_sign'].'~!~'.$j['fire_ex_receipt'].'~!~'.$j['fer_status'].'~!~'.$j['building_permit'].'~!~'.$j['bp_status'].'~!~'.$j['fsca'].'~!~'.$j['fsca_status'].'~!~'.$j['arr'].'~!~'.$j['arr_status'].'~!~'.$j['occupancy_permit'].'~!~'.$j['op_status'].'~!~'.$j['pob'].'~!~'.$j['pob_status'].'~!~'.$j['fcp'].'~!~'.$j['fcp_status'].'&quot;)">';
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
}elseif ($method == 'check_bfp_req') {
	$id = $_POST['id'];
	$requester = $_POST['requester'];
	$request_id = $_POST['request_id'];
	$fer_status = $_POST['fer_status'];
	$bp_status = $_POST['bp_status'];
	$fsca_status = $_POST['fsca_status'];
	$arr_status = $_POST['arr_status'];
	$op_status = $_POST['op_status'];
	$pob_status = $_POST['pob_status'];
	$fcp_status = $_POST['fcp_status'];

	$query = "UPDATE bfp_db SET fer_status = '$fer_status',bp_status = '$bp_status', fsca_status = '$fsca_status', arr_status = '$arr_status', op_status = '$op_status', pob_status = '$pob_status',fcp_status = '$fcp_status', date_updated = '$server_date_time' WHERE id = '$id'";

	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		echo 'success';
		$stmt = NULL;
	}else{
		echo 'error';
		$stmt = NULL;
	}
}

$conn = NULL;
?>