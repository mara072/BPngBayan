<?php 
include '../conn.php';

$method = $_POST['method'];

if ($method == 'total_graph') {
	$c = 0;

	$query = "SELECT 'mpdc' AS dept,COUNT(CASE WHEN f_status = 'approved' THEN 1 END) AS Approved,COUNT(CASE WHEN f_status IS NULL THEN 1 END) AS PENDING FROM mpdc_db
UNION
SELECT 'mto' AS dept,COUNT(CASE WHEN f_status = 'approved' THEN 1 END) AS Approved,COUNT(CASE WHEN f_status IS NULL THEN 1 END) AS PENDING FROM mto_db
UNION
SELECT 'sanidad' AS dept,COUNT(CASE WHEN f_status = 'approved' THEN 1 END) AS Approved,COUNT(CASE WHEN f_status IS NULL THEN 1 END) AS PENDING FROM sanidad_db
UNION
SELECT 'menro' AS dept,COUNT(CASE WHEN f_status = 'approved' THEN 1 END) AS Approved,COUNT(CASE WHEN f_status IS NULL THEN 1 END) AS PENDING FROM menro_db
UNION
SELECT 'meo' AS dept,COUNT(CASE WHEN f_status = 'approved' THEN 1 END) AS Approved,COUNT(CASE WHEN f_status IS NULL THEN 1 END) AS PENDING FROM meo_db
UNION
SELECT 'bfp' AS dept,COUNT(CASE WHEN f_status = 'approved' THEN 1 END) AS Approved,COUNT(CASE WHEN f_status IS NULL THEN 1 END) AS PENDING FROM bfp_db
UNION
SELECT 'bplo' AS dept,COUNT(CASE WHEN f_status = 'approved' THEN 1 END) AS Approved,COUNT(CASE WHEN f_status IS NULL THEN 1 END) AS PENDING FROM bplo_db";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			echo '<tr>';
				echo '<td class="dept">'.strtoupper($j['dept']).'</td>';
				echo '<td class="pending">'.$j['PENDING'].'</td>';
				echo '<td class="aprpoved">'.$j['Approved'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td style="text-align:center; color:red;" colspan="3">No Result !!!</td>';
		echo '</tr>';
	} 
}else



if ($method == 'fetch_account') {
	$username = $_POST['username'];
	$c = 0;

	$query = "SELECT * FROM user_accounts WHERE username LIKE '$username%'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			$status = $j['status'];
			if ($status == 1) {
				$status = 'Approved';
			}else{
				$status = 'Pending';
			}
			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#edit_account" onclick="get_account_details(&quot;'.$j['id'].'~!~'.$j['full_name'].'~!~'.$j['username'].'~!~'.$j['password'].'~!~'.$j['role'].'~!~'.$j['dept'].'~!~'.$j['status'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['full_name'].'</td>';
				echo '<td>'.$j['username'].'</td>';
				echo '<td>'.$j['role'].'</td>';
				echo '<td>'.$status.'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td style="text-align:center; color:red;" colspan="4">No Result !!!</td>';
		echo '</tr>';
	}
}else if ($method == 'add_account') {
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	$dept = $_POST['dept'];
	// $query = "SELECT id FROM user_accounts WHERE username = '$username'";
	// $stmt = $conn->prepare($query);
	// $stmt->execute();
	// if ($stmt->rowCount() > 0) {
	// 		echo 'duplicate';
	// 		$stmt = NULL;
	// }else{
		// $stmt = NULL;
		$query = "INSERT INTO user_accounts(`full_name`,`username`,`password`,`role`,`dept`,`status`)VALUES('$fullname','$username','$password','$role','$dept','1')";
		$stmt = $conn->prepare($query);
		if ($stmt->execute()) {
			echo 'success';
			$stmt = NULL;
		}else{
			echo 'error';
			$stmt = NULL;
		}
	// }
}else if ($method == 'delete_account') {
	$id = $_POST['id'];

	$query = "DELETE FROM user_accounts WHERE id = '$id'";
	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		echo 'success';
		$stmt = NULL;
	}else{
		echo 'error';
		$stmt = NULL;
	}
}else if ($method == 'update_account') {
	$id = $_POST['id'];
	$full_name = $_POST['full_name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	$dept = $_POST['dept'];
	$status = $_POST['status'];

	// $query = "SELECT id FROM user_accounts WHERE fullname = '$fullname' AND username = '$username' AND password = '$password' AND brgy_name = '$brgyDesig'";
	// $stmt = $conn->prepare($query);
	// $stmt->execute();
	// if ($stmt->rowCount() > 0) {
	// 		echo 'duplicate';
	// 		$stmt = NULL;
	// }else{
	// 	$stmt = NULL;
		$query = "UPDATE user_accounts SET full_name = '$full_name', username = '$username', password = '$password', role = '$role', dept = '$dept', status = '$status' WHERE id = '$id'";
		$stmt = $conn->prepare($query);
		if ($stmt->execute()) {
			echo 'success';
			$stmt = NULL;
		}else{
			echo 'error';
			$stmt = NULL;
		}
	// }
}

$conn = NULL;
?>