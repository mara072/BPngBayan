<?php
include '../conn.php';

$requester = $_POST['requester'];

$get_name = "SELECT contact_no from user_accounts WHERE username = '$requester'";
$stmt = $conn->prepare($get_name);
$stmt->execute();
if($stmt->rowCount() > 0){
    foreach($stmt->fetchall() as $x){
        $toNumber = $x['contact_no'];

        if (substr($toNumber, 0, 3) === '+63') {
            // Display the formatted number without modification
          
        } else {
            // Format the number with '+63' if it doesn't start with it
            $toNumber = '+63' . substr($toNumber, 1);
           
        }
        header("location: sms.php?number=$toNumber");
       
    }
}
?>