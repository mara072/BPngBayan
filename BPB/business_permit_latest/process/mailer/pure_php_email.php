<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../conn.php';
// require 'vendor/phpmailer/phpmailer/src/Exception.php';
// require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require 'vendor/phpmailer/phpmailer/src/SMTP.php';

// $send_to = 'maramikael0721@gmail.com';

## GET DATA
$send_to =  $_GET['requester_email'];

$request_id = $_GET['request_id'];
$applicant_name = $_GET['applicant_name'];
$dept_sender = strtoupper($_GET['dept_sender']);

if(empty($applicant_name)){ 
    $get_name = "SELECT full_name from user_accounts WHERE username LIKE '$send_to%'";
    $stmt = $conn->prepare($get_name);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        foreach($stmt->fetchall() as $x){
            $applicant_name = $x['full_name'];
        }
    }else{
        $applicant_name = $send_to;
    }
    
}

require 'vendor/autoload.php';
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'businesspermitngbayan@outlook.com';                     // SMTP username
    $mail->Password   = 'BPngBayan@2023';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('businesspermitngbayan@outlook.com', 'Business Permit ng Bayan (BPB) Web-Based Business Permit Registration and Renewal System');
    $mail->addAddress($send_to);     // Add a recipient
    // $mail->addAddress('');               // Name is optional
    $mail->addReplyTo('no-reply@outlook.com', 'No Reply');
    // $mail->addCC('');
    // $mail->addBCC('');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('C:\Users\Admin\Downloads\DATA.zip');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Business Permit Update Notification';
    $mail->Body    = '<div>
                    <p>Dear '.$applicant_name.', </p>
                    <br>
                    <p>Your business permit was successfully approved by '.$dept_sender.', as of '.$server_date_time.', with request ID - '.$request_id.'.</p>
                    <br>
                    <br>
                    <b>- Web-Based Business Permit Registration and Renewal System </b>
                        
    </div>';
    $mail->AltBody = '';

    $mail->send();
    // echo 'Message has been sent';
    echo '<script>alert("Succesfully Submitted"); window.location.href="../../page/approver/bfp.php";</script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>