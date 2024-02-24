<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");
if (isset($_POST['mto_assessment'])) {
    $id = $_POST['mto_assessment_id'];
    $assessment_file = ($_FILES['mto_assessment']['tmp_name']);

    if (empty($assessment_file)) {
        $assessment = '';
    }else{
        $assessment_file = file_get_contents($assessment_file);
        $assessment = base64_encode($assessment_file);
    }

    $query = "UPDATE mto_db SET assessment_record = '$assessment' WHERE id = '$id'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/approver/mto.php";</script>';
        $stmt = NULL;
    }else{
        echo '<script>alert("Error"); window.location.href="../../page/approver/mto.php";</script>';
        $stmt = NULL;
    }
}
    $conn = NULL; 
?>