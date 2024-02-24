<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];


if ($method == 'meo_requirements') {
	$requester = $_POST['requester'];
	$request_type = $_POST['request_type'];
	$c = 0;

	$query ="SELECT * FROM meo_db WHERE requester LIKE '$requester%' AND req_type LIKE '$request_type%'";
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
			echo '<tr style="cursor:pointer; color:'.$color.';" class="modal-trigger" data-toggle="modal" data-target="#meocheck_req" onclick="get_meoreq_details(&quot;'.$j['id'].'~!~'.$j['requester'].'~!~'.$j['request_id'].'~!~'.$j['op'].'~!~'.$j['bp'].'~!~'.$j['op_status'].'~!~'.$j['bp_status'].'&quot;)">';
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
}elseif ($method == 'approved_meo') {
	$id = $_POST['id'];
	$op_status = $_POST['op_status'];
	$bp_status = $_POST['bp_status'];

	if ($op_status == 'approved' && $bp_status == 'approved') {
		$query = "UPDATE meo_db SET op_status = 'approved',bp_status = 'approved', date_updated = '$server_date_time', f_status = 'approved' WHERE id = '$id'";

		$stmt = $conn->prepare($query);
		if ($stmt->execute()) {
			echo 'success';
			$stmt = NULL;
		}else{
			echo 'error';
			$stmt = NULL;
		}
	}else{
		$query = "UPDATE meo_db SET op_status = '$op_status',bp_status = '$bp_status', date_updated = '$server_date_time' WHERE id = '$id'";

		$stmt = $conn->prepare($query);
		if ($stmt->execute()) {
			echo 'checked';
			$stmt = NULL;
		}else{
			echo 'error';
			$stmt = NULL;
		}
	}

}
$conn = NULL;
?>