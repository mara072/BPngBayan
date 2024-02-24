<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");
if (isset($_POST['issuance_lcbp'])) {
	 $id = $_POST['permit_id'];
	 $requester = $_POST['permit_requester'];
	 $lcbp = ($_FILES['lcbp_file']['tmp_name']);

	if (empty($lcbp)) {
        $lcbp_64base = '';
    }else{
        $lcbp = file_get_contents($lcbp);
        $lcbp_64base = base64_encode($lcbp);
    }

    $query = "UPDATE mpdc_db SET lp = '$lcbp_64base', f_status = 'approved' WHERE id = '$id'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
    	echo '<script>alert("Success"); window.location.href="../../page/approver/dashboard.php";</script>'; 
    }else{
       echo '<script>alert("Error"); window.location.href="../../page/approver/dashboard.php";</script>';
    }
}

$conn = NULL;
?>