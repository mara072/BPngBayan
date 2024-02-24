<?php
include '../conn.php';
ini_set('max_execution_time', '0');
ini_set("memory_limit", "-1");

$method = $_POST['method'];

if ($method == 'req_tracking') {
	$requester = $_POST['requester'];

	$query = "SELECT mpdc_db.f_status,mpdc_db.req_type,mpdc_db.request_id,mto_db.f_status AS mto_status, sanidad_db.f_status AS sanidad_status,menro_db.f_status AS menro_status,meo_db.f_status AS meo_status, bfp_db.f_status AS bfp_status, bplo_db.f_status AS bplo_status FROM mpdc_db LEFT JOIN mto_db ON mto_db.request_id = mpdc_db.request_id LEFT JOIN sanidad_db ON sanidad_db.request_id = mpdc_db.request_id LEFT JOIN menro_db ON menro_db.request_id = mpdc_db.request_id LEFT JOIN meo_db ON meo_db.request_id = mpdc_db.request_id LEFT JOIN bfp_db ON bfp_db.request_id = mpdc_db.request_id LEFT JOIN bplo_db ON bplo_db.request_id = mpdc_db.request_id WHERE mpdc_db.requester = '$requester'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() AS $j){
			$request_id = $j['request_id'];
			$f_status = $j['f_status'];
			$mto_status = $j['mto_status'];
			$sanidad_status = $j['sanidad_status'];
			$menro_status = $j['menro_status'];
			$meo_status = $j['meo_status'];
			$bfp_status = $j['bfp_status'];
			$bplo_status = $j['bplo_status'];
			if ($f_status == '') {
				$f_status = 'PENDING';
			}else{
				$f_status = $j['f_status'];
			}

			if ($mto_status == '') {
				$mto_status = 'PENDING';
			}else{
				$mto_status = $j['mto_status'];
			}

			if ($sanidad_status == '') {
				$sanidad_status = 'PENDING';
			}else{
				$sanidad_status = $j['sanidad_status'];
			}

			if ($menro_status == '') {
				$menro_status = 'PENDING';
			}else{
				$menro_status = $j['menro_status'];
			}

			if ($meo_status == '') {
				$meo_status = 'PENDING';
			}else{
				$meo_status = $j['meo_status'];
			}

			if ($bfp_status == '') {
				$bfp_status = 'PENDING';
			}else{
				$bfp_status = $j['bfp_status'];
			}
			$btn_type = "";
			if ($bplo_status == '') {
				$bplo_status = 'PENDING';
				$btn_type = "disabled";
			}else{
				$bplo_status = $j['bplo_status'];
				$btn_type = "";
			}

			// echo '<table class="table table-head-fixed text-nowrap" style="height:100%; width:100%;">
			//         <thead style="display:;">
			//            	<tr>
			//              	<th style="text-align:center; border: 2px solid gray;">REQUEST ID</th>
			//              	<th colspan="2" style="text-align:center; border: 2px solid gray;">MPDC</th>
			// 			    <th colspan="2" style="text-align:center; border: 2px solid gray;">MTO</th>
			// 			    <th colspan="2" style="text-align:center; border: 2px solid gray;">SANIDAD</th>
			// 			    <th colspan="2" style="text-align:center; border: 2px solid gray;">MENRO</th>
			// 			    <th colspan="2" style="text-align:center; border: 2px solid gray;">MEO</th>
			// 			    <th colspan="2" style="text-align:center; border: 2px solid gray;">BFP</th>
			// 			    <th colspan="2" style="text-align:center; border: 2px solid gray;">BPLO</th>
			//            	</tr>
			//         </thead>
			//         <tbody id="">
			//         	<tr>
			//         		<td rowspan="3" style="text-align:center; border: 2px solid gray;"><br>'.$request_id.'</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Registration</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Renewal</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Registration</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Renewal</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Registration</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Renewal</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Registration</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Renewal</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Registration</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Renewal</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Registration</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Renewal</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Registration</td>
			//         		<td style="text-align:center; border: 2px solid gray;">Renewal</td>
			//         	</tr>
			//         	<tr>
			//         		<td style="text-align:center; border: 2px solid gray;">'.$f_status.'</td>
			//         		<td style="text-align:center; border: 2px solid gray;"></td>
			//         		<td style="text-align:center; border: 2px solid gray;">'.$mto_status.'</td>
			//         		<td style="text-align:center; border: 2px solid gray;"></td>
			//         		<td style="text-align:center; border: 2px solid gray;">'.$sanidad_status.'</td>
			//         		<td style="text-align:center; border: 2px solid gray;"></td>
			//         		<td style="text-align:center; border: 2px solid gray;">'.$menro_status.'</td>
			//         		<td style="text-align:center; border: 2px solid gray;"></td>
			//         		<td style="text-align:center; border: 2px solid gray;">'.$meo_status.'</td>
			//         		<td style="text-align:center; border: 2px solid gray;"></td>
			//         		<td style="text-align:center; border: 2px solid gray;">'.$bfp_status.'</td>
			//         		<td style="text-align:center; border: 2px solid gray;"></td>
			//         		<td style="text-align:center; border: 2px solid gray;">'.$bplo_status.'</td>
			//         		<td style="text-align:center; border: 2px solid gray;"></td>
			//         	</tr>
			//         </tbody>
			//     </table>
			// 	<br>
			// 	<button class="btn btn-success" onclick="renew_this_request(&quot;'.$request_id.'&quot;)" '.$btn_type.'>Renew: '.$request_id.'</button>
			// 	';
			echo '<table class="table table-head-fixed text-nowrap" style="height:100%; width:100%;">
			        <thead style="display:;">
			           	<tr>
			             	<th style="text-align:center; border: 2px solid gray;">REQUEST ID</th>
			             	<th  style="text-align:center; border: 2px solid gray;">MPDC</th>
						    <th  style="text-align:center; border: 2px solid gray;">MTO</th>
						    <th  style="text-align:center; border: 2px solid gray;">SANIDAD</th>
						    <th  style="text-align:center; border: 2px solid gray;">MENRO</th>
						    <th  style="text-align:center; border: 2px solid gray;">MEO</th>
						    <th  style="text-align:center; border: 2px solid gray;">BFP</th>
						    <th  style="text-align:center; border: 2px solid gray;">BPLO</th>
			           	</tr>
			        </thead>
			        <tbody id="">
			        	<tr>
			        		<td rowspan="3" style="text-align:center; border: 2px solid gray;"><br>'.$request_id.'</td>
			        		<td style="text-align:center; border: 2px solid gray;">Status</td>
			        		
			        		<td style="text-align:center; border: 2px solid gray;">Status</td>
			        		
			        		<td style="text-align:center; border: 2px solid gray;">Status</td>
			        		
			        		<td style="text-align:center; border: 2px solid gray;">Status</td>
			        		
			        		<td style="text-align:center; border: 2px solid gray;">Status</td>
			        		
			        		<td style="text-align:center; border: 2px solid gray;">Status</td>
			        		
			        		<td style="text-align:center; border: 2px solid gray;">Status</td>
			        		
			        	</tr>
			        	<tr>
			        		<td style="text-align:center; border: 2px solid gray;">'.$f_status.'</td>
			        		
			        		<td style="text-align:center; border: 2px solid gray;">'.$mto_status.'</td>
			        		
			        		<td style="text-align:center; border: 2px solid gray;">'.$sanidad_status.'</td>
			        		
			        		<td style="text-align:center; border: 2px solid gray;">'.$menro_status.'</td>
			        		
			        		<td style="text-align:center; border: 2px solid gray;">'.$meo_status.'</td>
			        		
			        		<td style="text-align:center; border: 2px solid gray;">'.$bfp_status.'</td>
			        		
			        		<td style="text-align:center; border: 2px solid gray;">'.$bplo_status.'</td>			        		
			        	</tr>
			        </tbody>
			    </table>
				<br>
				<button class="btn btn-success" onclick="renew_this_request(&quot;'.$request_id.'&quot;)" '.$btn_type.'>Renew: '.$request_id.'</button>
				<button class="btn btn-success" onclick="preview_qr(&quot;'.$request_id.'&quot;)" '.$btn_type.'>View QR Code</button>
				';
		}
	}

}

elseif ($method == "renew_function"){
	$request_id = $_POST['req_id'];
	$requester = $_POST['requester'];

	## GET DATA
	// $DATA = "SELECT mpdc_db.requester AS REQUESTER_UNAME, mpdc_db.applicant_name AS APPLICANT_NAME,
	// bfp_db.bfsben AS BUSINESS_NAME, mpdc_db.`owner` AS BUSINESS_OWNER, mpdc_db.date_submitted AS REQUEST_DATE, mpdc_db.date_updated AS MPDC_APPROVE_DATE,
	// mto_db.date_updated as MTO_APROVE_DATE, sanidad_db.date_updated AS SANIDAD_APPROVE_DATE,
	// menro_db.date_updated as MENRO_APPROVE_DATE, meo_db.date_updated AS MEO_APPROVE_DATE,
	// bfp_db.date_updated AS BFP_APPROVE_DATE, bplo_db.date_updated AS BPLO_APPROVE_DATE
	// FROM  mpdc_db LEFT JOIN mto_db ON mto_db.request_id = mpdc_db.request_id LEFT JOIN sanidad_db ON sanidad_db.request_id = mpdc_db.request_id LEFT JOIN menro_db ON menro_db.request_id = mpdc_db.request_id LEFT JOIN meo_db ON meo_db.request_id = mpdc_db.request_id LEFT JOIN bfp_db ON bfp_db.request_id = mpdc_db.request_id LEFT JOIN bplo_db ON bplo_db.request_id = mpdc_db.request_id WHERE bplo_db.f_status = 'approved' AND mpdc_db.requester = '$requester' AND mpdc_db.request_id = '$request_id'";
	$DATA = "INSERT INTO req_history (`REQ_ID`,`REQUESTER`,`APPLICANT_NAME`,`BUSINESS`,`OWNER`,`REQUEST_DATETIME`,`MPDC_APPROVAL_DATE`,`MTO_APPROVAL_DATE`,`SANIDAD_APPROVAL_DATE`,`MENRO_APPROVAL_DATE`,`MEO_APPROVAL_DATE`,`BFP_APPROVAL_DATE`,`BPLO_APPROVAL_DATE`,`REQUEST_TYPE`)
	
	SELECT mpdc_db.request_id AS REQ_ID, mpdc_db.requester AS REQUESTER_UNAME, mpdc_db.applicant_name AS APPLICANT_NAME,
	bfp_db.bfsben AS BUSINESS_NAME, mpdc_db.`owner` AS BUSINESS_OWNER, mpdc_db.date_submitted AS REQUEST_DATE, mpdc_db.date_updated AS MPDC_APPROVE_DATE,
	mto_db.date_updated as MTO_APROVE_DATE, sanidad_db.date_updated AS SANIDAD_APPROVE_DATE,
	menro_db.date_updated as MENRO_APPROVE_DATE, meo_db.date_updated AS MEO_APPROVE_DATE,
	bfp_db.date_updated AS BFP_APPROVE_DATE, bplo_db.date_updated AS BPLO_APPROVE_DATE,
	bplo_db.req_type AS REQUEST_TYPE
	FROM  mpdc_db LEFT JOIN mto_db ON mto_db.request_id = mpdc_db.request_id LEFT JOIN sanidad_db ON sanidad_db.request_id = mpdc_db.request_id LEFT JOIN menro_db ON menro_db.request_id = mpdc_db.request_id LEFT JOIN meo_db ON meo_db.request_id = mpdc_db.request_id LEFT JOIN bfp_db ON bfp_db.request_id = mpdc_db.request_id LEFT JOIN bplo_db ON bplo_db.request_id = mpdc_db.request_id WHERE bplo_db.f_status = 'approved' AND mpdc_db.requester = '$requester' AND mpdc_db.request_id = '$request_id' 
	";
	$stmt = $conn->prepare($DATA);
	if($stmt->execute()){
		// echo "success";
		
		$RENEW_QUERY = [
			"DELETE FROM bplo_db WHERE request_id = '$request_id'",
			"DELETE FROM bfp_db WHERE request_id = '$request_id'",
			"DELETE FROM meo_db WHERE request_id = '$request_id'",
			"DELETE FROM menro_db WHERE request_id = '$request_id'",
			"DELETE FROM sanidad_db WHERE request_id = '$request_id'",
			"DELETE FROM mto_db WHERE request_id = '$request_id'",
			"UPDATE mpdc_db SET sign_applicant = '', sign_owner = '', tct= '', tct_status = '',dti='', dti_status= '', bcr = '', bcr_status = '', csl ='', csl_status = '', mc = '', mc_status = '', dpwh = '', dpwh_status = '', op = '',op_status = '', pbp = '', pbp_status = '', gs = '', gs_status = '', bp ='',bp_status = '', req_type = 'renewal', assessment = '',assessment_receipt = '', date_submitted = '$server_date_time', date_updated = NULL, f_status = '' WHERE request_id = '$request_id'"
		];

		$RENEW_QRY_COUNT = count($RENEW_QUERY);
		foreach($RENEW_QUERY as $QUERY){
			$stmt = $conn->prepare($QUERY);
			if($stmt->execute()){
				$RENEW_QRY_COUNT -= 1;
			}
		}
		if ($RENEW_QRY_COUNT === 0) {
			echo "success";
		} else {
			echo "failed";
		}

	}else{
		echo "failed";
	}
	
}

elseif($method == 'view_history'){
	$requester = $_POST['requester'];
	$SQL = "SELECT * FROM req_history WHERE REQUESTER LIKE '$requester%'";
	$stmt = $conn->prepare($SQL);
	$stmt->execute();
	if($stmt->rowCount() > 0){
		foreach($stmt->fetchALL() as $x){
			echo '<tr>';
			echo '<td>'.$x['REQ_ID'].'</td>';
			echo '<td>'.strtoupper($x['BUSINESS']).'</td>';
			echo '<td>'.$x['REQUESTER'].'</td>';
			echo '<td>'.$x['APPLICANT_NAME'].'</td>';
			echo '<td>'.$x['OWNER'].'</td>';
			echo '<td>'.$x['REQUEST_DATETIME'].'</td>';
			echo '<td>'.$x['MPDC_APPROVAL_DATE'].'</td>';
			echo '<td>'.$x['MTO_APPROVAL_DATE'].'</td>';
			echo '<td>'.$x['SANIDAD_APPROVAL_DATE'].'</td>';
			echo '<td>'.$x['MENRO_APPROVAL_DATE'].'</td>';
			echo '<td>'.$x['MEO_APPROVAL_DATE'].'</td>';
			echo '<td>'.$x['BFP_APPROVAL_DATE'].'</td>';
			echo '<td>'.$x['BPLO_APPROVAL_DATE'].'</td>';
			echo '<td>'.strtoupper($x['REQUEST_TYPE']).'</td>';
			echo '</tr>';
		}
		
	}

}

$conn = NULL;
?>