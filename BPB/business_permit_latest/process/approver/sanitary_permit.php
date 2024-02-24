<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");
if (isset($_POST['issue_sanitary_permit'])) {
    $id = $_POST['sanidad_assessment_id'];
    $sanitary_permit_file = ($_FILES['sanitary_permit']['tmp_name']);

    if (empty($sanitary_permit_file)) {
        $sanitary = '';
    }else{
        $sanitary_permit_file = file_get_contents($sanitary_permit_file);
        $sanitary = base64_encode($sanitary_permit_file);
    }

    $query = "UPDATE sanidad_db SET sanitary_permit = '$sanitary', f_status = 'approved' WHERE id = '$id'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/approver/sanidad.php";</script>';
        $stmt = NULL;
    }else{
        echo '<script>alert("Error"); window.location.href="../../page/approver/sanidad.php";</script>';
        $stmt = NULL;
    }
}
    $conn = NULL; 
?>