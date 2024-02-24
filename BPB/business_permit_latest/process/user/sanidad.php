<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];
if ($method == 'check_sp') {
	$req_id = $_POST['req_id'];

	 $query = "SELECT sanitary_permit FROM sanidad_db WHERE request_id = '$req_id'";
	 $stmt = $conn->prepare($query);
	 $stmt->execute();
	 if ($stmt->rowCount() > 0) {
	 	foreach ($stmt->fetchAll() AS $j) {
	 		echo $j['sanitary_permit'];
	 		$stmt = NULL;
	 	}
	 }
}elseif ($method == 'submit_sanidad_reqs') {
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
    $fecalysis_file = removeDataPrefix($_POST['fecalysis_file']);
    $urinalysis_file = removeDataPrefix($_POST['urinalysis_file']);
    $xray_file = removeDataPrefix($_POST['xray_file']);
    $drug_test_file = removeDataPrefix($_POST['drug_test_file']);

    $query = "SELECT id FROM mto_db WHERE requester = '$requester' AND request_id = '$req_id_ref' AND f_status = 'approved'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    	$stmt = NULL;
    	$query = "INSERT INTO sanidad_db(`requester`, `request_id`, `fecalysis`, `urinalysis`, `chest_xray`, `drug_test`, `req_type`, `date_submitted`)VALUES('$requester','$req_id_ref','$fecalysis_file','$urinalysis_file','$xray_file','$drug_test_file','registration','$server_date_time')";
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
}elseif ($method == 'check_status') {
	$requester = $_POST['requester'];
	$req_id = $_POST['req_id'];
	$query = "SELECT * FROM sanidad_db WHERE requester = '$requester' AND request_id = '$req_id'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() AS $j){
			$fecalysis_status = $j['fecalysis_status'];
			$urinalysis_status = $j['urinalysis_status'];
			$chest_xray_status = $j['chest_xray_status'];
			$drug_test_status = $j['drug_test_status'];
            $f_status = $j['f_status'];
			if ($fecalysis_status == '') {
				$fecalysis_status = 'Pending';
			}else{
				$fecalysis_status = ucfirst($j['fecalysis_status']);
			}

			if ($urinalysis_status == '') {
				$urinalysis_status = 'Pending';
			}else{
				$urinalysis_status = ucfirst($j['urinalysis_status']);
			}
			if ($chest_xray_status == '') {
				$chest_xray_status = 'Pending';
			}else{
				$chest_xray_status = ucfirst($j['chest_xray_status']);
			}
			if ($drug_test_status == '') {
				$drug_test_status = 'Pending';
			}else{
				$drug_test_status = ucfirst($j['drug_test_status']);
			}
            if ($f_status == '') {
                $f_status = 'Pending';
            }else{
                $f_status = ucfirst($j['f_status']);
            }
		echo $fecalysis_status.'~!~'.$urinalysis_status.'~!~'.$chest_xray_status.'~!~'.$drug_test_status.'~!~'.$j['fecalysis'].'~!~'.$j['urinalysis'].'~!~'.$j['chest_xray'].'~!~'.$j['drug_test'].'~!~'.$f_status;
		}
	}else{ 
		echo '';
		$stmt = NULL;
	}
}elseif ($method == 'check_button') {
	$requester = $_POST['requester'];
	$req_id = $_POST['req_id'];

	$query = "SELECT * FROM sanidad_db WHERE requester = '$requester' AND request_id = '$req_id'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		echo 'existing';
		$stmt = NULL;
	}else{
		echo 'none';
		$stmt = NULL;
	}
}elseif ($method == 'update_sanidad_reqs') {
	$req_id_ref = $_POST['req_id_ref'];
	$requester = $_POST['requester'];
	$fecalysis_check = $_POST['fecalysis_check'];
	$urinalysis_check = $_POST['urinalysis_check'];
	$xray_check = $_POST['xray_check'];
	$drug_test_check = $_POST['drug_test_check'];
	$fecalysis_status = $_POST['fecalysis_status'];
	$urinalysis_status = $_POST['urinalysis_status'];
	$xray_status = $_POST['xray_status'];
	$drug_test_status = $_POST['drug_test_status'];
	function removeDataPrefix($base64String)
    {
        // Check if the string starts with "data:image" or "data:application"
        if (preg_match('/^data:(image|application)\/[a-z]+;base64,/', $base64String, $matches)) {
            // Remove the matched prefix
            return preg_replace('/^data:(image|application)\/[a-z]+;base64,/', '', $base64String);
        }
        return $base64String;
    }
    $fecalysis_file = removeDataPrefix($_POST['fecalysis_file_update']);
    $urinalysis_file = removeDataPrefix($_POST['urinalysis_file_update']);
    $xray_file = removeDataPrefix($_POST['xray_file_update']);
    $drug_test_file = removeDataPrefix($_POST['drug_test_file_update']);

    if ($fecalysis_status == 'Approved') {
    	$fecalysis_file = $fecalysis_check;
    }else{
    	$fecalysis_file = $fecalysis_file;
    }

    if ($urinalysis_status == 'Approved') {
    	$urinalysis_file = $urinalysis_check;
    }else{
    	$urinalysis_file = $urinalysis_file;
    }

    if ($xray_status == 'Approved') {
    	$xray_file = $xray_check;
    }else{
    	$xray_file = $xray_file;
    }

    if ($drug_test_status == 'Approved') {
    	$drug_test_file = $drug_test_check;
    }else{
    	$drug_test_file = $drug_test_file;
    }

    $query = "SELECT id FROM sanidad_db WHERE requester = '$requester' AND request_id = '$req_id_ref'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    	$stmt = NULL;
    	$query = "UPDATE sanidad_db SET fecalysis = '$fecalysis_file',urinalysis = '$urinalysis_file',chest_xray = '$xray_file',drug_test = '$drug_test_file', date_updated = '$server_date_time' WHERE requester = '$requester' AND request_id = '$req_id_ref'";
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
}
$conn = NULL;
?>