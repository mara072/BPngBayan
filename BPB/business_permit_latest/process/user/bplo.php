<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];
if ($method == 'submit_bplo_req') {
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
    $cedula_file = removeDataPrefix($_POST['cedula_file']);
    $dti_file = removeDataPrefix($_POST['dti_file']);
    $bbcor_file = removeDataPrefix($_POST['bbcor_file']);
    $scc_file = removeDataPrefix($_POST['scc_file']);
    $pic_file = removeDataPrefix($_POST['pic_file']);

    $query = "SELECT id FROM bfp_db WHERE requester = '$requester' AND request_id = '$req_id_ref' AND f_status = 'approved'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    	$stmt = NULL;
    	$query = "INSERT INTO bplo_db(`requester`, `request_id`, `cedula`, `dti`, `bbcor`, `scc`, `pic`, `req_type`, `date_submitted`)VALUES('$requester','$req_id_ref','$cedula_file','$dti_file','$bbcor_file','$scc_file','$pic_file', 'registration','$server_date_time')";
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
    $query = "SELECT * FROM bplo_db WHERE requester = '$requester' AND request_id = '$req_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() AS $j){
            $cedula_status = $j['cedula_status'];
            $dti_status = $j['dti_status'];
            $bbcor_status = $j['bbcor_status'];
            $scc_status = $j['scc_status'];
            $pic_status = $j['pic_status'];
            if ($cedula_status == '') {
                $cedula_status = 'Pending';
            }else{
                $cedula_status = ucfirst($j['cedula_status']);
            }

            if ($dti_status == '') {
                $dti_status = 'Pending';
            }else{
                $dti_status = ucfirst($j['dti_status']);
            }
            if ($bbcor_status == '') {
                $bbcor_status = 'Pending';
            }else{
                $bbcor_status = ucfirst($j['bbcor_status']);
            }
            if ($scc_status == '') {
                $scc_status = 'Pending';
            }else{
                $scc_status = ucfirst($j['scc_status']);
            }
            if ($pic_status == '') {
                $pic_status = 'Pending';
            }else{
                $pic_status = ucfirst($j['pic_status']);
            }
        echo $cedula_status.'~!~'.$dti_status.'~!~'.$bbcor_status.'~!~'.$scc_status.'~!~'.$pic_status.'~!~'.$j['cedula'].'~!~'.$j['dti'].'~!~'.$j['bbcor'].'~!~'.$j['scc'].'~!~'.$j['pic'];
        }
    }else{ 
        echo '';
        $stmt = NULL;
    }
}elseif ($method == 'check_button') {
   $requester = $_POST['requester'];
    $req_id = $_POST['req_id'];

    $query = "SELECT * FROM bplo_db WHERE requester = '$requester' AND request_id = '$req_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo 'existing';
        $stmt = NULL;
    }else{
        echo 'none';
        $stmt = NULL;
    }
}elseif ($method == 'update_bplo_req') {
    $req_id_ref = $_POST['req_id_ref'];
    $requester = $_POST['requester'];
    $bplo_check_cedula = $_POST['bplo_check_cedula'];
    $bplo_check_dti = $_POST['bplo_check_dti'];
    $bplo_check_bbcor = $_POST['bplo_check_bbcor'];
    $bplo_check_scc = $_POST['bplo_check_scc'];
    $bplo_check_2pic = $_POST['bplo_check_2pic'];
    $bplo_status_cedula = $_POST['bplo_status_cedula'];
    $bplo_status_dti = $_POST['bplo_status_dti'];
    $bplo_status_bbcor = $_POST['bplo_status_bbcor'];
    $bplo_status_scc = $_POST['bplo_status_scc'];
    $bplo_status_2pic = $_POST['bplo_status_2pic'];
    function removeDataPrefix($base64String)
    {
        // Check if the string starts with "data:image" or "data:application"
        if (preg_match('/^data:(image|application)\/[a-z]+;base64,/', $base64String, $matches)) {
            // Remove the matched prefix
            return preg_replace('/^data:(image|application)\/[a-z]+;base64,/', '', $base64String);
        }
        return $base64String;
    }
    $cedula_file = removeDataPrefix($_POST['cedula_file_update']);
    $dti_file = removeDataPrefix($_POST['dti_file_update']);
    $bbcor_file = removeDataPrefix($_POST['bbcor_file_update']);
    $scc_file = removeDataPrefix($_POST['scc_file_update']);
    $pic_file = removeDataPrefix($_POST['pic_file_update']);
    
    if ($bplo_status_cedula == 'Approved') {
        $cedula_file = $bplo_check_cedula;
    }else{
        $cedula_file = $cedula_file;
    }
    if ($bplo_status_dti == 'Approved') {
        $dti_file = $bplo_check_dti;
    }else{
        $dti_file = $dti_file;
    }
    if ($bplo_status_bbcor == 'Approved') {
        $bbcor_file = $bplo_check_bbcor;
    }else{
        $bbcor_file = $bbcor_file;
    }
    if ($bplo_status_scc == 'Approved') {
        $scc_file = $bplo_check_scc;
    }else{
        $scc_file = $scc_file;
    }
    if ($bplo_status_2pic == 'Approved') {
        $pic_file = $bplo_check_2pic;
    }else{
        $pic_file = $pic_file;
    }

    $query = "UPDATE bplo_db SET cedula = '$cedula_file', dti = '$dti_file', bbcor = '$bbcor_file', scc = '$scc_file', pic = '$pic_file' WHERE requester = '$requester' AND request_id = '$req_id_ref'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        echo 'success';
        $stmt = NULL;
    }else{
        echo 'error';
        $stmt = NULL;
    }
}elseif ($method == 'check_bp') {
    $req_id = $_POST['req_id'];

    $query = "SELECT bp FROM bplo_db WHERE request_id = '$req_id'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        foreach ($stmt->fetchALL() AS $j) {
            echo $j['bp'];
        }
    }
}
$conn = NULL;
?>