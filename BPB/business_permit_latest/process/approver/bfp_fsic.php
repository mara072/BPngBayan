<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");
if (isset($_POST['bfp_fsic'])) {
    $id = $_POST['bfp_fsic_id'];
    $fsic_file = ($_FILES['bfp_fsic']['tmp_name']);

    if (empty($fsic_file)) {
        $fsic = '';
    }else{
        $fsic_file = file_get_contents($fsic_file);
        $fsic = base64_encode($fsic_file);
    }

    $query = "UPDATE bfp_db SET fsic = '$fsic', f_status = 'approved' WHERE id = '$id'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {

        $get_data_email = "SELECT requester, request_id, `owner` FROM bfp_db WHERE id = '$id'";
        $stmt = $conn->prepare($get_data_email);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchall() as $x){
                $requester =  $x['requester'];
                $request_id = $x['request_id'];
                $applicant_name = $x['owner'];

                header("location: ../mailer/pure_php_email.php?requester_email=$requester&&request_id=$request_id&&applicant_name=$applicant_name&&dept_sender=BFP");
                //  echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/approver/bfp.php";</script>';
                $stmt = NULL;
            }
        }

        // echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/approver/bfp.php";</script>';
        // $stmt = NULL;
    }else{
        echo '<script>alert("Error"); window.location.href="../../page/approver/bfp.php";</script>';
        $stmt = NULL;
    }
}
    $conn = NULL; 
?>