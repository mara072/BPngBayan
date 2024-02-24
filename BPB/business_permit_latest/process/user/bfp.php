<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];
if ($method == 'check_assessment') {
	 $req_id = $_POST['req_id'];

	 $query = "SELECT assessment FROM bfp_db WHERE request_id = '$req_id'";
	 $stmt = $conn->prepare($query);
	 $stmt->execute();
	 if ($stmt->rowCount() > 0) {
	 	foreach ($stmt->fetchAll() AS $j) {
	 		echo $j['assessment'];
	 		$stmt = NULL;
	 	}
	 }
}elseif ($method == 'check_fsic') {
	$req_id = $_POST['req_id'];

	 $query = "SELECT fsic FROM bfp_db WHERE request_id = '$req_id'";
	 $stmt = $conn->prepare($query);
	 $stmt->execute();
	 if ($stmt->rowCount() > 0) {
	 	foreach ($stmt->fetchAll() AS $j) {
	 		echo $j['fsic'];
	 		$stmt = NULL;
	 	}
	 }
}elseif ($method == 'submit_bfp_req') {
	$req_id_ref = $_POST['req_id_ref'];
	
	$requester = $_POST['requester'];
	
	$owner_name = $_POST['owner_name'];
	
	$bfsbe = $_POST['bfsbe'];
	
	$address = $_POST['address'];
	
	$ar = $_POST['ar'];
	
	$tobn = $_POST['tobn'];
	
	$tfa = $_POST['tfa'];
	
	$nos = $_POST['nos'];
	
	$contact_no = $_POST['contact_no'];
	
	$email = $_POST['email'];
	

	function removeDataPrefix($base64String)
    {
        // Check if the string starts with "data:image" or "data:application"
        if (preg_match('/^data:(image|application)\/[a-z]+;base64,/', $base64String, $matches)) {
            // Remove the matched prefix
            return preg_replace('/^data:(image|application)\/[a-z]+;base64,/', '', $base64String);
        }
        return $base64String;
    }
    $soar_file = removeDataPrefix($_POST['soar_file']);
    $fer_file = removeDataPrefix($_POST['fer_file']);
    $bp_file = removeDataPrefix($_POST['bp_file']);
    $op_file = removeDataPrefix($_POST['op_file']);
    $fsicaf_file = removeDataPrefix($_POST['fsicaf_file']);
    $arwr_file = removeDataPrefix($_POST['arwr_file']);
    $pob_file = removeDataPrefix($_POST['pob_file']);

    $query = "SELECT id FROM meo_db WHERE request_id = '$req_id_ref' AND f_status = 'approved'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    	$stmt = NULL;

    	$query = "INSERT INTO bfp_db(`requester`, `request_id`, `owner`, `exact_address`, `bfsben`, `authorized_rep`, `tobn`, `tfa`, `storey_no`, `email_address`, `contact_no`, `owner_sign`, `fire_ex_receipt`, `building_permit`, `occupancy_permit`, `fsca`, `arr`, `pob`, `req_type`, `date_submitted`) VALUES ('$requester','$req_id_ref','$owner_name','$address','$bfsbe','$ar','$tobn','$tfa','$nos','$email','$contact_no','$soar_file','$fer_file','$bp_file','$op_file','$fsicaf_file','$arwr_file','$pob_file','registration','$server_date_time')";
         $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
             echo 1;
              $stmt = NULL;
         }else{
            echo 0;
             $stmt = NULL;
         }
    }else{
    	$stmt = NULL;
    	echo 3;
    }
}elseif ($method == 'check_status') {
	$requester = $_POST['requester'];
	$req_id = $_POST['req_id'];

	$query = "SELECT * FROM bfp_db WHERE requester = '$requester' AND request_id = '$req_id'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchAll() AS $j) {
			$requester = $j['requester'];
			$request_id = $j['request_id'];
			$owner = $j['owner'];
			$exact_address = $j['exact_address'];
			$bfsben = $j['bfsben'];
			$authorized_rep = $j['authorized_rep'];
			$tobn = $j['tobn'];
			$tfa = $j['tfa'];
			$storey_no = $j['storey_no'];
			$email_address = $j['email_address'];
			$contact_no = $j['contact_no'];
			$owner_sign = $j['owner_sign'];
			$fire_ex_receipt = $j['fire_ex_receipt'];
			$fer_status = $j['fer_status'];
			$building_permit = $j['building_permit'];
			$bp_status = $j['bp_status'];
			$occupancy_permit = $j['occupancy_permit'];
			$op_status = $j['op_status'];
			$fsca = $j['fsca'];
			$fsca_status = $j['fsca_status'];
			$arr = $j['arr'];
			$arr_status = $j['arr_status'];
			$pob = $j['pob'];
			$pob_status = $j['pob_status'];

			if ($fer_status == '') {
				$fer_status = 'Pending';
			}else{
				$fer_status = ucfirst($j['fer_status']);
			}
			if ($bp_status == '') {
				$bp_status = 'Pending';
			}else{
				$bp_status = ucfirst($j['bp_status']);
			}

			if ($op_status == '') {
				$op_status = 'Pending';
			}else{
				$op_status = ucfirst($j['op_status']);
			}

			if ($fsca_status == '') {
				$fsca_status = 'Pending';
			}else{
				$fsca_status = ucfirst($j['fsca_status']);
			}

			if ($arr_status == '') {
				$arr_status = 'Pending';
			}else{
				$arr_status = ucfirst($j['arr_status']);
			}

			if ($pob_status == '') {
				$pob_status = 'Pending';
			}else{
				$pob_status = ucfirst($j['pob_status']);
			}

			echo $requester.'~!~'.$request_id.'~!~'.$owner.'~!~'.$exact_address.'~!~'.$bfsben.'~!~'.$authorized_rep.'~!~'.$tobn.'~!~'.$tfa.'~!~'.$storey_no.'~!~'.$email_address.'~!~'.$contact_no.'~!~'.$owner_sign.'~!~'.$fire_ex_receipt.'~!~'.$fer_status.'~!~'.$building_permit.'~!~'.$bp_status.'~!~'.$occupancy_permit.'~!~'.$op_status.'~!~'.$fsca.'~!~'.$fsca_status.'~!~'.$arr.'~!~'.$arr_status.'~!~'.$pob.'~!~'.$pob_status;
			$stmt = NULL;
		}
	}else{
		echo '';
		$stmt = NULL;
	}
}elseif ($method == 'check_buttons') {
	$requester = $_POST['requester'];
	$req_id = $_POST['req_id'];

	$query = "SELECT * FROM bfp_db WHERE requester = '$requester' AND request_id = '$req_id'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		echo 1;
		$stmt = NULL;
	}else{
		echo 0;
		$stmt = NULL;
	}
}elseif ($method == 'update_bfp_req') {
	$req_id_ref = $_POST['req_id_ref'];
	
	$requester = $_POST['requester'];
	
	$owner_name = $_POST['owner_name'];
	
	$bfsbe = $_POST['bfsbe'];
	
	$address = $_POST['address'];
	
	$ar = $_POST['ar'];
	
	$tobn = $_POST['tobn'];
	
	$tfa = $_POST['tfa'];
	
	$nos = $_POST['nos'];
	
	$contact_no = $_POST['contact_no'];
	
	$email = $_POST['email'];

	$fer_status = $_POST['fer_status'];
	$bp_status = $_POST['bp_status'];
	$op_status = $_POST['op_status'];
	$fsicaf_status = $_POST['fsicaf_status'];
	$arwr_status = $_POST['arwr_status'];
	$pob_status = $_POST['pob_status'];
	$soar_check = $_POST['soar_check'];
	$fer_check = $_POST['fer_check'];
	$bp_check = $_POST['bp_check'];
	$op_check = $_POST['op_check'];
	$fsicaf_check = $_POST['fsicaf_check'];
	$arwr_check = $_POST['arwr_check'];
	$pob_check = $_POST['pob_check'];
	

	function removeDataPrefix($base64String)
    {
        // Check if the string starts with "data:image" or "data:application"
        if (preg_match('/^data:(image|application)\/[a-z]+;base64,/', $base64String, $matches)) {
            // Remove the matched prefix
            return preg_replace('/^data:(image|application)\/[a-z]+;base64,/', '', $base64String);
        }
        return $base64String;
    }
    $soar_file = removeDataPrefix($_POST['soar_file_update']);
    $fer_file = removeDataPrefix($_POST['fer_file_update']);
    $bp_file = removeDataPrefix($_POST['bp_file_update']);
    $op_file = removeDataPrefix($_POST['op_file_update']);
    $fsicaf_file = removeDataPrefix($_POST['fsicaf_file_update']);
    $arwr_file = removeDataPrefix($_POST['arwr_file_update']);
    $pob_file = removeDataPrefix($_POST['pob_file_update']);

    if ($fer_status == 'Approved') {
    	$fer_file = $fer_check;
    }else{
    	$fer_file = $fer_file;
    }

    if ($soar_check == '') {
    	$soar_file = $soar_file;
    }else{
    	$soar_file = $soar_check;
    }

    if ($op_status == 'Approved') {
    	$op_file = $op_check;
    }else{
    	$op_file = $op_file;
    }

    if ($bp_status == 'Approved') {
    	$bp_file = $bp_check;
    }else{
    	$bp_file = $bp_file;
    }

    if ($fsicaf_status == 'Approved') {
    	$fsicaf_file = $fsicaf_check;
    }else{
    	$fsicaf_file = $fsicaf_file;
    }

    if ($arwr_status == 'Approved') {
    	$arwr_file = $arwr_check;
    }else{
    	$arwr_file = $arwr_file;
    }

    if ($pob_status == 'Approved') {
    	$pob_file = $pob_check;
    }else{
    	$pob_file = $pob_file;
    }


    $query = "SELECT id FROM meo_db WHERE request_id = '$req_id_ref' AND requester = '$requester' AND f_status = 'approved'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    	$stmt = NULL;

    	$query = "UPDATE bfp_db SET owner = '$owner_name', exact_address = '$address', bfsben = '$bfsbe', authorized_rep = '$ar', tobn = '$tobn', tfa = '$tfa', storey_no = '$nos', email_address = '$email', contact_no = '$contact_no', owner_sign = '$soar_file',fire_ex_receipt = '$fer_file', building_permit = '$bp_file', fsca = '$fsicaf_file', arr = '$arwr_file', pob = '$pob_file', date_updated = '$server_date_time' WHERE  request_id = '$req_id_ref' AND requester = '$requester'";
         $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
             echo 1;
              $stmt = NULL;
         }else{
            echo 0;
             $stmt = NULL;
         }
    }else{
    	$stmt = NULL;
    	echo 3;
    }
}
$conn = NULL;
?>	