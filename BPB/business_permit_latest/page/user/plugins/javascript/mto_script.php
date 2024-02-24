<script type="text/javascript">
$(function() {
    check_req_id();
    setTimeout(check_ar, 3000);

}); 

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
                  $('#req_id_ref_mto_receipt').val(response);
                  check_button();
                  check_status();
                }
    });  
}

const check_ar =()=>{
  var req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/mto.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_ar',
                  req_id:req_id
                },success:function(response){
                  let lp = response;
                  
                  displayPDF('pdf-container_ar', lp);
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

  let wbp_file = null;
  let rptp_file = null;
  let cedula_file = null;

   function submit_mto_req() {
            const wbp_fileInput = document.getElementById('wbp_file');
            const rptp_fileInput = document.getElementById('rptp_file');
            const cedula_fileInput = document.getElementById('cedula_file');

            // Use Promise.all to wait for both promises to resolve
            Promise.all([
                convertFileToBase64(wbp_fileInput, 'WBP'),
                convertFileToBase64(rptp_fileInput, 'RPTP'),
                convertFileToBase64(cedula_fileInput, 'CEDULA')
            ]).then(() => {
                // Both promises have resolved, now call the AJAX function
                sendBase64Data();
            });
        }

         function convertFileToBase64(fileInput, documentType) {
            const files = fileInput.files;

            const promises = [];

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                const promise = new Promise((resolve, reject) => {
                    // Check if the file has data (non-zero size)
                    if (file.size > 0) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            const base64Data = e.target.result.split(',')[1];

                            // Store base64 data in respective variables
                            if (documentType === 'WBP') {
                                wbp_file = base64Data;
                            }else if (documentType === 'RPTP') {
                                rptp_file = base64Data;
                            }else if (documentType === 'CEDULA') {
                                cedula_file = base64Data;
                            }

                            resolve(); // Resolve the promise once the FileReader is done
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If the file is empty, set the corresponding base64 variable to null
                        if (documentType === 'WBP') {
                                wbp_file = null;
                            }else if (documentType === 'RPTP') {
                                rptp_file = null;
                            }else if (documentType === 'CEDULA') {
                                cedula_file = null;
                            }

                        resolve(); // Resolve the promise since there is no data
                    }
                });

                promises.push(promise);
            }

            return Promise.all(promises); // Return a promise that resolves when all promises in the array have resolved
        }

        function sendBase64Data() {
            // Set the value attribute of the input elements
              let req_id_ref = $('#req_id_ref').val();
              let requester = $('#requester').val();
               $.ajax({
                  url:'../../process/user/mto.php',
                          type: 'POST',
                          cache: false,
                          data:{
                            method: 'submit_mto_req',
                            req_id_ref:req_id_ref,
                            requester:requester,
                            wbp_file:wbp_file,
                            rptp_file:rptp_file,
                            cedula_file:cedula_file
                          },success:function(response){
                            console.log(response);
                            if (response == 'success') {
                              Swal.fire({
                                title: 'Successfully Submitted',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1000
                              });
                               // window.location.reload();
                            }else if(response == 'invalid'){
                              Swal.fire({
                                title: 'Invalid',
                                icon: 'info',
                                showConfirmButton: false,
                                timer: 1000
                              });
                               // window.location.reload();
                            }else{
                              Swal.fire({
                                title: 'Error',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1000
                              });
                               // window.location.reload();
                            }
                          }
              });  
}
 
const check_status =()=>{
   let requester = $('#requester').val();
   let req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/mto.php',
                type: 'POST',
                cache: false,
                data:{ 
                  method: 'check_status',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  let data = response.split('~!~');
                  let wbp_status = data[0];
                  let rptp_status = data[1];
                  let cedula_status = data[2];
                  let wbp = data[3];
                  let rptp = data[4];
                  let cedula = data[5];
                  let f_status = data[6];

                  $('#mto_status_wbr').html(wbp_status);
                  $('#mto_status_rptp').html(rptp_status);
                  $('#mto_status_cedula').html(cedula_status);
                  $('#wbp_check').val(wbp);
                  $('#rptp_check').val(rptp);
                  $('#cedula_check').val(cedula);
                  $('#mto_fstatus_chcek').html(f_status);

                  if (wbp_status == 'Approved') {
                    document.getElementById('wbp_file').style.display = 'none';
                  }else{
                    document.getElementById('wbp_file').style.display = 'block';
                  }
                  if (rptp_status == 'Approved') {
                    document.getElementById('rptp_file').style.display = 'none';
                  }else{
                    document.getElementById('rptp_file').style.display = 'block';
                  }
                  if (cedula_status == 'Approved') {
                    document.getElementById('cedula_file').style.display = 'none';
                  }else{
                    document.getElementById('cedula_file').style.display = 'block';
                  }
                  if (f_status == 'Approved') {
                    document.getElementById('mto_receipt_file').style.display = 'none';
                  }else{
                    document.getElementById('mto_receipt_file').style.display = 'block';
                  }
                }
    }); 
}

const check_button =()=>{
   let requester = $('#requester').val();
   let req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/mto.php',
                type: 'POST',
                cache: false,
                data:{ 
                  method: 'check_button',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  if (response == 'existing') {
                    document.getElementById('submit_mto_req').style.display = 'none';
                  }else{
                    document.getElementById('update_mto_req').style.display = 'none';
                  }
                }
    });
}

  let wbp_file_update = null;
  let rptp_file_update = null;
  let cedula_file_update = null;

   function update_mto_req() {
            const wbp_file_updateInput = document.getElementById('wbp_file');
            const rptp_file_updateInput = document.getElementById('rptp_file');
            const cedula_file_updateInput = document.getElementById('cedula_file');

            // Use Promise.all to wait for both promises to resolve
            Promise.all([
                convertFileToBase64_update(wbp_file_updateInput, 'WBP'),
                convertFileToBase64_update(rptp_file_updateInput, 'RPTP'),
                convertFileToBase64_update(cedula_file_updateInput, 'CEDULA')
            ]).then(() => {
                // Both promises have resolved, now call the AJAX function
                sendBase64Data_update();
            });
        }

         function convertFileToBase64_update(fileInput, documentType) {
            const files = fileInput.files;

            const promises = [];

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                const promise = new Promise((resolve, reject) => {
                    // Check if the file has data (non-zero size)
                    if (file.size > 0) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            const base64Data = e.target.result.split(',')[1];

                            // Store base64 data in respective variables
                            if (documentType === 'WBP') {
                                wbp_file_update = base64Data;
                            }else if (documentType === 'RPTP') {
                                rptp_file_update = base64Data;
                            }else if (documentType === 'CEDULA') {
                                cedula_file_update = base64Data;
                            }

                            resolve(); // Resolve the promise once the FileReader is done
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If the file is empty, set the corresponding base64 variable to null
                        if (documentType === 'WBP') {
                                wbp_file_update = null;
                            }else if (documentType === 'RPTP') {
                                rptp_file_update = null;
                            }else if (documentType === 'CEDULA') {
                                cedula_file_update = null;
                            }

                        resolve(); // Resolve the promise since there is no data
                    }
                });

                promises.push(promise);
            }

            return Promise.all(promises); // Return a promise that resolves when all promises in the array have resolved
        }

        function sendBase64Data_update() {
            // Set the value attribute of the input elements
              let req_id_ref = $('#req_id_ref').val();
              let requester = $('#requester').val();
              let wbp_status = $('#mto_status_wbr').html();
              let rptp_status = $('#mto_status_rptp').html();
              let cedula_status = $('#mto_status_cedula').html();
              let wbp_check = $('#wbp_check').val();
              let rptp_check = $('#rptp_check').val();
              let cedula_check = $('#cedula_check').val();
               $.ajax({
                  url:'../../process/user/mto.php',
                          type: 'POST',
                          cache: false,
                          data:{
                            method: 'update_mto_req',
                            req_id_ref:req_id_ref,
                            requester:requester,
                            wbp_status:wbp_status,
                            rptp_status:rptp_status,
                            cedula_status:cedula_status,
                            wbp_check:wbp_check,
                            rptp_check:rptp_check,
                            cedula_check:cedula_check,
                            wbp_file_update:wbp_file_update,
                            rptp_file_update:rptp_file_update,
                            cedula_file_update:cedula_file_update
                          },success:function(response){
                            console.log(response);
                            if (response == 'success') {
                              Swal.fire({
                                title: 'Successfully Submitted',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1000
                              });
                               // window.location.reload();
                            }else if(response == 'invalid'){
                              Swal.fire({
                                title: 'Invalid',
                                icon: 'info',
                                showConfirmButton: false,
                                timer: 1000
                              });
                               // window.location.reload();
                            }else{
                              Swal.fire({
                                title: 'Error',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1000
                              });
                               // window.location.reload();
                            }
                          }
              });  
}

const submit_mto_receipt =()=>{
    let assessment_receipt = document.getElementById('mto_receipt_file');

    if (assessment_receipt.files.length > 0) {
    let file = assessment_receipt.files[0];

    // Create a FileReader to read the selected file
    let reader = new FileReader();

    // Define an event handler for when the file reading is done
    reader.onload = function (e) {
        // The result of the FileReader contains the base64 data URI
        let assessment_receipt = e.target.result;
         
    let req_id_ref = $('#req_id_ref_mto_receipt').val();
    let assessment = assessment_receipt;
      $.ajax({
          url: '../../process/user/mto.php',
          type: 'POST',
          cache: false,
          data: {
            method: 'submit_mto_receipt',
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