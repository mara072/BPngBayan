<?php
 
include 'conn.php';
 session_start();
 if (isset($_POST['login_btn'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];
   if (empty($username)) {
      echo 'Please Enter Username';
   }else if(empty($password)){
      echo 'Please Enter Password';
   }else{
      $check = "SELECT id,role,status,dept FROM user_accounts WHERE BINARY username = '$username' AND BINARY password = '$password'";
      $stmt = $conn->prepare($check);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
         foreach ($stmt->fetchAll() AS $j) {
            $status = $j['status'];
            $role = $j['role'];
            $dept = $j['dept'];
            if ($status == 0) {
               echo '<script>alert("Account not yet verified"); window.location.href="../index.php";</script>';   
            }else{
               if ($role == 'sa') {                
                  $_SESSION['username'] = $username;
                  header('location: ../page/admin/dashboard.php');
               }elseif ($role == 'approver') {
                  if ($dept == 'mpdc') {
                     $_SESSION['username'] = $username;
                     header('location: ../page/approver/dashboard.php');
                  }elseif ($dept == 'mto') {
                     $_SESSION['username'] = $username;
                     header('location: ../page/approver/mto.php');
                  }elseif ($dept == 'sanidad') {
                     $_SESSION['username'] = $username;
                     header('location: ../page/approver/sanidad.php');
                  }elseif ($dept == 'menro') {
                     $_SESSION['username'] = $username;
                     header('location: ../page/approver/menro.php');
                  }elseif ($dept == 'meo') {
                     $_SESSION['username'] = $username;
                     header('location: ../page/approver/meo.php');
                  }elseif ($dept == 'bfp') {
                     $_SESSION['username'] = $username;
                     header('location: ../page/approver/bfp.php');
                  }elseif ($dept == 'bplo') {
                     $_SESSION['username'] = $username;
                     header('location: ../page/approver/bplo.php');
                  }

                  
               }elseif ($role == 'user') {
                  $_SESSION['username'] = $username;
                  header('location: ../page/user/dashboard.php');
               }
            }

         }
      }else{
            echo '<script>alert("Wrong Username or Password"); window.location.href="../index.php";</script>';
      }
   }
 }
 if (isset($_POST['Logout'])) {
   session_unset();
   session_destroy();
   header('location: ../index.php');
 }
?>

