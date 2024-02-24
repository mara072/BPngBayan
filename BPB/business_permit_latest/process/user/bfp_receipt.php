<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");
if (isset($_POST['submit_bfp_receipt'])) {
    $req_id = $_POST['req_id_ref'];
    $fcp_receipt = ($_FILES['bfp_receipt_file']['tmp_name']);

    if (empty($fcp_receipt)) {
        $fcp = '';
    }else{
        $fcp_receipt = file_get_contents($fcp_receipt);
        $fcp = base64_encode($fcp_receipt);
    }

    $query = "UPDATE bfp_db SET fcp = '$fcp' WHERE request_id = '$req_id'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
                 echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/bfp.php";</script>';
                $stmt = NULL;
    }else{
                echo '<script>alert("Error"); window.location.href="../../page/user/bfp.php";</script>';
                $stmt = NULL;
    }
}

$conn = NULL;
?>

