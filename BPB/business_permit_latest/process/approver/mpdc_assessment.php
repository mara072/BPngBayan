<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");
if (isset($_POST['mpdc_assessment'])) {
    $id = $_POST['mpdc_assessment_id'];
    $assessment_file = ($_FILES['mpdc_assessment']['tmp_name']);

    if (empty($assessment_file)) {
        $assessment = '';
    }else{
        $assessment_file = file_get_contents($assessment_file);
        $assessment = base64_encode($assessment_file);
    }

    $query = "UPDATE mpdc_db SET assessment = '$assessment' WHERE id = '$id'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/approver/dashboard.php";</script>';
        $stmt = NULL;
    }else{
        echo '<script>alert("Error"); window.location.href="../../page/approver/dashboard.php";</script>';
        $stmt = NULL;
    }
}
    $conn = NULL; 
?>