<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method']; 

if ($method == 'bplo_requirements') {
	$requester = $_POST['requester'];
	$request_type = $_POST['request_type'];
	$c = 0;

	$query ="SELECT * FROM bplo_db WHERE requester LIKE '$requester%' AND req_type LIKE '$request_type%'";
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
			echo '<tr style="cursor:pointer; color:'.$color.';" class="modal-trigger" data-toggle="modal" data-target="#bplocheck_req" onclick="get_bploreq_details(&quot;'.$j['id'].'~!~'.$j['requester'].'~!~'.$j['request_id'].'~!~'.$j['cedula'].'~!~'.$j['dti'].'~!~'.$j['bbcor'].'~!~'.$j['scc'].'~!~'.$j['pic'].'~!~'.$j['cedula_status'].'~!~'.$j['dti_status'].'~!~'.$j['bbcor_status'].'~!~'.$j['scc_status'].'~!~'.$j['pic_status'].'&quot;)">';
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
}elseif ($method == 'check_bplo_req') {
	$id = $_POST['id'];
	$cedula_status = $_POST['cedula_status'];
	$dti_status = $_POST['dti_status'];
	$bbcor_status = $_POST['bbcor_status'];
	$scc_status = $_POST['scc_status'];
	$pic_status = $_POST['pic_status'];

	$query = "UPDATE bplo_db SET cedula_status = '$cedula_status', dti_status = '$dti_status', bbcor_status = '$bbcor_status', scc_status = '$scc_status', pic_status = '$pic_status', date_updated = '$server_date_time' WHERE id = '$id'";
	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		echo 'success';
		$stmt = NULL;
	}else{
		echo 'error';
		$stmt = NULL;
	}
}elseif ($method == 'bplo_issue_bp') {
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
	$bplo_file = removeDataPrefix($_POST['bplo_file']);

	$query = "SELECT * FROM bplo_db WHERE cedula_status = 'approved' AND dti_status = 'approved' AND bbcor_status = 'approved' AND scc_status = 'approved' AND pic_status = 'approved' AND id = '$id'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() <= 0) {
		echo 'invalid';
		$stmt = NULL;
	}else{
		$stmt = NULL;

	$query = "UPDATE bplo_db SET bp = '$bplo_file', f_status = 'approved' WHERE id = '$id'";
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