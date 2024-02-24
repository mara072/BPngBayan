<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];
if ($method == 'submit_meo_reqs') {
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
    $op_file = removeDataPrefix($_POST['op_file']);
    $bp_file = removeDataPrefix($_POST['bp_file']);

    $query = "SELECT id FROM meo_db WHERE requester = '$requester' AND request_id = '$req_id_ref'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    	$stmt = NULL;
    	$query = "UPDATE meo_db SET op = '$op_file',bp = '$bp_file' , date_updated = '$server_date_time' WHERE request_id = '$req_id_ref'";
         $stmt = $conn->prepare($query);
         if ($stmt->execute()) {
            echo 'update';
            $stmt = NULL;
        }else{
            echo 'error';
            $stmt = NULL;
        }
    }else{
    	$stmt = NULL;
    	$query = "INSERT INTO meo_db(`requester`, `request_id`, `op`,`bp`,`req_type`, `date_submitted`)VALUES('$requester','$req_id_ref','$op_file','$bp_file','registration','$server_date_time')";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            echo 'success';
            $stmt = NULL;
        }else{
            echo 'error';
            $stmt = NULL;
        }
    }
}elseif ($method == 'check_status') {
    $requester = $_POST['requester'];
    $req_id = $_POST['req_id'];

    $query = "SELECT * FROM meo_db WHERE requester = '$requester' AND request_id = '$req_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() AS $j){
            $op_status = $j['op_status'];
            $bp_status = $j['bp_status'];
            
            if ($op_status == '') {
                $op_status = 'Pending';
            }else{
                $op_status = ucfirst($j['op_status']);
            }

            if ($bp_status == '') {
                $bp_status = 'Pending';
            }else{
                $bp_status = ucfirst($j['bp_status']);
            }
        echo $op_status.'~!~'.$bp_status.'~!~'.$j['op'].'~!~'.$j['bp'];
        }
    }else{ 
        echo '';
        $stmt = NULL;
    }
}elseif ($method == 'check_button') {
    $requester = $_POST['requester'];
    $req_id = $_POST['req_id'];

    $query = "SELECT * FROM meo_db WHERE requester = '$requester' AND request_id = '$req_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo 'existing';
        $stmt = NULL;
    }else{
        echo 'none';
        $stmt = NULL;
    }
}elseif ($method == 'update_meo_reqs') {
    $req_id_ref = $_POST['req_id_ref'];
    $requester = $_POST['requester'];
    $op_file_checks = $_POST['op_file_check'];
    $op_status_meo = $_POST['op_status_meo'];
    $bp_file_check = $_POST['bp_file_check'];
    $bp_status_meo = $_POST['bp_status_meo'];

    function removeDataPrefix($base64String)
    {
        // Check if the string starts with "data:image" or "data:application"
        if (preg_match('/^data:(image|application)\/[a-z]+;base64,/', $base64String, $matches)) {
            // Remove the matched prefix
            return preg_replace('/^data:(image|application)\/[a-z]+;base64,/', '', $base64String);
        }
        return $base64String;
    }
    $op_file = removeDataPrefix($_POST['op_file_update']);
    $bp_file = removeDataPrefix($_POST['bp_file_update']);

      if ($op_status_meo == 'Approved') {
        $op_file == $op_file_checks;
    }else{
        $op_file == $op_file;
    }

    if ($bp_status_meo == 'Approved') {
        $bp_file == $bp_file_check;
    }else{
        $bp_file == $bp_file;
    }

    $query = "SELECT id FROM meo_db WHERE requester = '$requester' AND request_id = '$req_id_ref'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $stmt = NULL;
        $query = "UPDATE meo_db SET op = '$op_file',bp = '$bp_file', date_updated = '$server_date_time' WHERE request_id = '$req_id_ref'";
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