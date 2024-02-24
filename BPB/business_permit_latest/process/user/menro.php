<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];
if ($method == 'submit_menro_req') {
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
    $recycle_bin_file = removeDataPrefix($_POST['recycle_bin_file']);

    $query = "SELECT id FROM menro_db WHERE requester = '$requester' AND request_id = '$req_id_ref'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    	$stmt = NULL;
    	$query = "UPDATE menro_db SET rb = '$recycle_bin_file', date_updated = '$server_date_time' WHERE request_id = '$req_id_ref'";
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
    	$query = "INSERT INTO menro_db(`requester`, `request_id`, `rb`,`req_type`, `date_submitted`)VALUES('$requester','$req_id_ref','$recycle_bin_file','registration','$server_date_time')";
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

    $query = "SELECT * FROM menro_db WHERE requester = '$requester' AND request_id = '$req_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() AS $j){
            $f_status = $j['f_status'];
            
            if ($f_status == '') {
                $f_status = 'Pending';
            }else{
                $f_status = ucfirst($j['f_status']);
            }
        echo $f_status;
        }
    }else{ 
        echo '';
        $stmt = NULL;
    }
}

$conn = NULL;
?>