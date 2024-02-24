<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];


if ($method == 'sanidad_requirements') {
	$requester = $_POST['requester'];
	$request_type = $_POST['request_type'];
	$c = 0;

	$query ="SELECT * FROM sanidad_db WHERE requester LIKE '$requester%' AND req_type LIKE '$request_type%'";
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
			echo '<tr style="cursor:pointer; color:'.$color.';" class="modal-trigger" data-toggle="modal" data-target="#sanidadcheck_req" onclick="get_sanidadreq_details(&quot;'.$j['id'].'~!~'.$j['requester'].'~!~'.$j['request_id'].'~!~'.$j['fecalysis'].'~!~'.$j['fecalysis_status'].'~!~'.$j['urinalysis'].'~!~'.$j['urinalysis_status'].'~!~'.$j['chest_xray'].'~!~'.$j['chest_xray_status'].'~!~'.$j['drug_test'].'~!~'.$j['drug_test_status'].'~!~'.$j['sanitary_permit'].'&quot;)">';
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
}elseif ($method == 'check_sanidad_req') {
	$id = $_POST['id'];
	$requester = $_POST['requester'];
	$request_id = $_POST['request_id'];
	$fecalysis = $_POST['fecalysis'];
	$urinalysis = $_POST['urinalysis'];
	$chest_xray = $_POST['chest_xray'];
	$drug_test = $_POST['drug_test'];

	$query = "UPDATE sanidad_db SET fecalysis_status = '$fecalysis',urinalysis_status = '$urinalysis', chest_xray_status = '$chest_xray',drug_test_status = '$drug_test', date_updated = '$server_date_time' WHERE id = '$id'";

	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		echo 'success';
		$stmt = NULL;
	}else{
		echo 'error';
		$stmt = NULL;
	}
}elseif ($method == 'sanidad_issue_assessment') {
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
	$sanidadfile = removeDataPrefix($_POST['sanidadfile']);

	$query = "SELECT * FROM sanidad_db WHERE id = '$id' AND fecalysis_status = 'Approved' OR urinalysis_status = 'Approved' OR chest_xray_status = 'Approved' OR drug_test_status = 'Approved'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() < 0) {
		echo 'invalid';
		$stmt = NULL;
	}else{
		$stmt = NULL;

	$query = "UPDATE sanidad_db SET sanitary_permit = '$sanidadfile', f_status = 'approved' WHERE id = '$id'";
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