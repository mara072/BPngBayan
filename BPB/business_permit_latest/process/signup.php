<?php
include 'conn.php';

$method = $_POST['method'];

if ($method == 'register') {
	$full_name = $_POST['full_name'];
	$contact_no = $_POST['contact_no'];
	$address = $_POST['address'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT id FROM user_accounts WHERE username = '$username' OR contact_no = '$contact_no'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		echo 'existing';
		$stmt = NULL;
	}else{
		$stmt = NULL;
		$query = "INSERT INTO user_accounts(`full_name`,`contact_no`,`address`,`username`,`password`,`role`)VALUES('$full_name','$contact_no','$address','$username','$password','user')";
		$stmt = $conn->prepare($query);
		if ($stmt->execute()) {
			echo 'success';
			$stmt = NULL;
		}else{
			echo 'error';
			$stmt = NULL;
		}
	}
}

?>