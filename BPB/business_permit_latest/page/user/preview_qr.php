<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview QR Code</title>
</head>
<body>
    <center>
        <p style="font-family:'Courier New', Courier, monospace">Your QR Code</p>
        <div id="qrcode"></div>
    </center>
<?php
    require '../../process/conn.php';
    $code = $_GET['code'];
    
    ## GET REQUESTER 
    $requester_get = "SELECT requester FROM mpdc_db WHERE request_id = '$code' LIMIT 1";
    $stmt = $conn->prepare($requester_get);
    $stmt->execute();
    foreach($stmt->fetchall() as $x){
        $requester =  $x['requester'];
    }

    ## GET OWNER NAME
    $owner_get = "SELECT `owner` FROM bfp_db WHERE request_id = '$code' LIMIT 1";
    $stmt1 = $conn->prepare($owner_get);
    $stmt1->execute();
    foreach($stmt1->fetchall() as $o){
        $owner =  $o['owner'];
    }

    ## GET BUSINESS NAME 
    $busname = "SELECT bfsben,exact_address FROM bfp_db WHERE request_id = '$code'";
    $stmt = $conn->prepare($busname);
    $stmt->execute();
    foreach($stmt->fetchall() as $x){
        $business =  $x['bfsben'];
        $address = $x['exact_address'];
    }
    
    ##
    $qrcode_val = "$code~!~$owner~!~$address~!~$business";

?>
<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../user/plugins/qrcodejs/qrcode.min.js"></script>
<script>
      var qrcode = new QRCode(document.getElementById("qrcode"), {
                width : 150,
                height : 150
            });

        const makeCode =()=>{
            var elText = '<?=$qrcode_val;?>';
            qrcode.makeCode(elText)
        }
        makeCode();
</script>
</body>
</html>