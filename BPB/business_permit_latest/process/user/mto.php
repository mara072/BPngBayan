<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];
if ($method == 'check_ar') {
	$req_id = $_POST['req_id'];

	 $query = "SELECT assessment_record FROM mto_db WHERE request_id = '$req_id'";
	 $stmt = $conn->prepare($query);
	 $stmt->execute();
	 if ($stmt->rowCount() > 0) {
	 	foreach ($stmt->fetchAll() AS $j) {
	 		echo $j['assessment_record'];
	 		$stmt = NULL;
	 	}
	 }
}elseif ($method == 'submit_mto_req') {
	$req_id_ref = $_POST['req_id_ref'];
	$requester = $_POST['requester'];
	
	function removeDataPrefix($base64String)
    {
        // Check if the string starts with "data:image" or "data:application"
        if (preg_match('/^data:(image|application)\/[a-z]+;base64,/', $base64String, $matches)) {
            // Remove the matched prefix
            return preg_replace('/^data:(image|application)\/[a-z]+;base64,/', '', $base64String);
        }
        return $base64String;
    }
    $wbp_file = removeDataPrefix($_POST['wbp_file']);
    $rptp_file = removeDataPrefix($_POST['rptp_file']);
    $cedula_file = removeDataPrefix($_POST['cedula_file']);

    $query = "SELECT id FROM mpdc_db WHERE requester = '$requester' AND request_id = '$req_id_ref' AND f_status = 'approved'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    	$stmt = NULL;
    	$query = "INSERT INTO mto_db(`requester`, `request_id`, `wbp`, `rptp`, `cedula`, `req_type`, `date_submitted`)VALUES('$requester','$req_id_ref','$wbp_file','$rptp_file','$cedula_file','registration','$server_date_time')";
    	$stmt = $conn->prepare($query);
    	if ($stmt->execute()) {
    		echo 'success';
    		$stmt = NULL;
    	}else{
    		echo 'error';
    		$stmt = NULL;
    	}
    }else{
    	$stmt = NULL;
    	echo 'invalid';
    }
}elseif ($method == 'check_button') {
	$requester = $_POST['requester'];
	$req_id = $_POST['req_id'];

	$query = "SELECT * FROM mto_db WHERE requester = '$requester' AND request_id = '$req_id'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		echo 'existing';
		$stmt = NULL;
	}else{
		echo 'none';
		$stmt = NULL;
	}
}elseif ($method == 'check_status') {
	$requester = $_POST['requester'];
	$req_id = $_POST['req_id'];

	$query = "SELECT * FROM mto_db WHERE requester = '$requester' AND request_id = '$req_id'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() AS $j){
			$wbp_status = $j['wbp_status'];
			$rptp_status = $j['rptp_status'];
			$cedula_status = $j['cedula_status'];
            $f_status = $j['f_status'];
			if ($wbp_status == '') {
				$wbp_status = 'Pending';
			}else{
				$wbp_status = ucfirst($j['wbp_status']);
			}

			if ($rptp_status == '') {
				$rptp_status = 'Pending';
			}else{
				$rptp_status = ucfirst($j['rptp_status']);
			}
			if ($cedula_status == '') {
				$cedula_status = 'Pending';
			}else{
				$cedula_status = ucfirst($j['cedula_status']);
			}
            if ($f_status == '') {
                $f_status = 'Pending';
            }else{
                $f_status = ucfirst($j['f_status']);
            }
		echo $wbp_status.'~!~'.$rptp_status.'~!~'.$cedula_status.'~!~'.$j['wbp'].'~!~'.$j['rptp'].'~!~'.$j['cedula'].'~!~'.$f_status;
		}
	}else{ 
		echo '';
		$stmt = NULL;
	}
}elseif ($method == 'update_mto_req') {
	$req_id_ref = $_POST['req_id_ref'];
	$requester = $_POST['requester'];
	$wbp_status = $_POST['wbp_status'];
	$rptp_status = $_POST['rptp_status'];
	$cedula_status = $_POST['cedula_status'];
	$wbp_check = $_POST['wbp_check'];
	$rptp_check = $_POST['rptp_check'];
	$cedula_check = $_POST['cedula_check'];
	
	function removeDataPrefix($base64String)
    {
        // Check if the string starts with "data:image" or "data:application"
        if (preg_match('/^data:(image|application)\/[a-z]+;base64,/', $base64String, $matches)) {
            // Remove the matched prefix
            return preg_replace('/^data:(image|application)\/[a-z]+;base64,/', '', $base64String);
        }
        return $base64String;
    }
    $wbp_file_update = removeDataPrefix($_POST['wbp_file_update']);
    $rptp_file_update = removeDataPrefix($_POST['rptp_file_update']);
    $cedula_file_update = removeDataPrefix($_POST['cedula_file_update']);

    if ($wbp_status == 'Approved') {
    	$wbp_file_update = $wbp_check;
    }else{
    	$wbp_file_update = $wbp_file_update;
    }

    if ($rptp_status == 'Approved') {
    	$rptp_file_update = $rptp_check;
    }else{
    	$rptp_file_update = $rptp_file_update;
    }

    if ($cedula_status == 'Approved') {
    	$cedula_file_update = $cedula_check;
    }else{
    	$cedula_file_update = $cedula_file_update;
    }


    $query = "SELECT id FROM mto_db WHERE requester = '$requester' AND request_id = '$req_id_ref'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    	$stmt = NULL;
    	$query = "UPDATE mto_db SET wbp = '$wbp_file_update',rptp = '$rptp_file_update',cedula = '$cedula_file_update', date_updated = '$server_date_time' WHERE requester = '$requester' AND request_id = '$req_id_ref'";
    	$stmt = $conn->prepare($query);
    	if ($stmt->execute()) {
    		echo 'success';
    		$stmt = NULL;
    	}else{
    		echo 'error';
    		$stmt = NULL;
    	}
    }else{
    	$stmt = NULL;
    	echo 'invalid';
    }
}elseif ($method == 'submit_mto_receipt') {
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

    $query = "UPDATE mto_db SET assessment_receipt = '$assessment_receipt' WHERE request_id = '$req_id_ref'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        echo "success";
        $stmt = NULL;
    }else{
        echo "error";
        $stmt = NULL;
    }
}
$conn = NULL;
?>