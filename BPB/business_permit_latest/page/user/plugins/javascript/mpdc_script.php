<script type="text/javascript">
$(function() {
    check_req_id();
    setTimeout(check_assessment, 3000);
    setTimeout(check_lp, 3000);
}); 

const check_status =()=>{
   let requester = '<?=$uname;?>';
   let req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/mpdc.php',
                type: 'POST',
                cache: false,
                data:{ 
                  method: 'check_status',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  let f_status = response;
                  $('#mpdc_f_status_check').html(f_status);
                  if (f_status == 'Approved') {
                    document.getElementById('assessment_receipt').style.display = 'none';
                  }else{
                    document.getElementById('assessment_receipt').style.display = 'block';
                  }
                  
                }
    }); 
}

const check_req_id =()=>{
    let requester = '<?=$uname;?>';
    $.ajax({
        url:'../../process/user/req_id.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_req_id',
                  requester:requester
                },success:function(response){
                  $('#req_id').html(response);
                  $('#req_id_ref').val(response);
                  check_status();
                }
    });  
}

const check_assessment =()=>{
  var req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/mpdc.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_assessment',
                  req_id:req_id
                },success:function(response){
                  let assessment = response;
                  
                  displayPDF('pdf-container_assessment', assessment);
                }
    });  
}

const check_lp =()=>{
  var req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/mpdc.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_lp',
                  req_id:req_id
                },success:function(response){
                  let lp = response;
                  
                  displayPDF('pdf-container_lp', lp);
                }
    });  
}

const displayPDF = (containerId, base64pdf) => {
    // Create a data URL for the PDF
    const pdfData = "data:application/pdf;base64," + base64pdf;

    // Create an iframe to display the PDF
    const iframe = document.createElement('iframe');
    iframe.src = pdfData;
    iframe.style.width = '100%';
    iframe.style.height = '50vh';

    // Replace the content of the specified container element with the new iframe
    const pdfContainer = document.getElementById(containerId);
    pdfContainer.innerHTML = ''; // Clear existing content
    pdfContainer.appendChild(iframe);
};

const submit_mpdc_receipt =()=>{
    let assessment_receipt = document.getElementById('assessment_receipt');

    if (assessment_receipt.files.length > 0) {
    let file = assessment_receipt.files[0];

    // Create a FileReader to read the selected file
    let reader = new FileReader();

    // Define an event handler for when the file reading is done
    reader.onload = function (e) {
        // The result of the FileReader contains the base64 data URI
        let assessment_receipt = e.target.result;
         
    let req_id_ref = $('#req_id_ref').val();
    let assessment = assessment_receipt;
      $.ajax({
          url: '../../process/user/mpdc.php',
          type: 'POST',
          cache: false,
          data: {
            method: 'submit_mpdc_receipt',
            req_id_ref: req_id_ref,
            assessment: assessment
          },success: function (response) {
            if (response == 'success') {
              Swal.fire({
                title: 'Successfully Submitted',
                icon: 'success',
                showConfirmButton: false,
                timer: 1000
              });
            }else {
              Swal.fire({
                title: 'Error',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
              });
            }
          }
        });

    };
    // Read the selected file as a Data URL (base64)
    reader.readAsDataURL(file);
}else{
  Swal.fire({
      icon: 'info',
      title: 'Please Select Assessment Receipt',
      text: 'info',
      showConfirmButton: false,
      timer: 1000
    });
}
}
</script>