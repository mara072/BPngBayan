<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];

if ($method == 'mpdc_requirements') {
	$requester = $_POST['requester'];
	$request_type = $_POST['request_type'];
	$c = 0;

	$query ="SELECT * FROM mpdc WHERE requester LIKE '$requester%' AND req_type LIKE '$request_type%'";
	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		foreach($stmt->fetchALL() AS $j){
			$f_status = $j['f_status'];
			if ($f_status == '') {
				$f_status = 'PENDING';
			}else{
				$f_status = strtoupper($j['f_status']);
			}
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_req" onclick="get_req_details(&quot;'.$j['id'].'~!~'.$j['requester'].'~!~'.$j['request_id'].'~!~'.$j['tct'].'~!~'.$j['dti_sec'].'~!~'.$j['brgy_clearance_receipt'].'~!~'.$j['application_form'].'~!~'.$j['contract_of_sale_lease'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['request_id'].'</td>';
				echo '<td>'.$j['requester'].'</td>';
				echo '<td>'.strtoupper($j['req_type']).'</td>';
				echo '<td>'.$f_status.'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td style="text-align:center; color:red;" colspan="5">No Result</td>';
		echo '</tr>';
	}
}

$conn = NULL;
?>