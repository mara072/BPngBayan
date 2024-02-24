<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");
if (isset($_POST['submit_assessment'])) {
    $req_id = $_POST['req_id_ref'];
    $assessment_receipt = ($_FILES['assessment_receipt']['tmp_name']);

    if (empty($assessment_receipt)) {
        $assessment = '';
    }else{
        $assessment_receipt = file_get_contents($assessment_receipt);
        $assessment = base64_encode($assessment_receipt);
    }

    $query = "UPDATE mpdc_db SET assessment_receipt = '$assessment' WHERE request_id = '$req_id'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
                 echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/user/mpdc.php";</script>';
                $stmt = NULL;
    }else{
                echo '<script>alert("Error"); window.location.href="../../page/user/mpdc.php";</script>';
                $stmt = NULL;
    }
}

$conn = NULL;
?>