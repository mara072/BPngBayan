<script type="text/javascript">
$(function() {
    check_req_id();
    setTimeout(check_assessment, 3000);
    setTimeout(check_fsic, 3000);
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
                  $('#req_id2').html(response);
                  $('#req_id_ref').val(response);
                  $('#req_id_ref3').val(response);
                  $('#user_bfp').modal('show');
                  check_button();
                  check_status();
                  
                }
    });  
}

const check_assessment =()=>{
  var req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/bfp.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_assessment',
                  req_id:req_id
                },success:function(response){
                  let assessment = response;
                  
                  displayPDF('pdf-container_bfp_assessment_user', assessment);
                }
    });  
}

const check_fsic =()=>{
  var req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/bfp.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_fsic',
                  req_id:req_id
                },success:function(response){
                  let fsic = response;
                  
                  displayPDF('pdf-container_bfp_fsic_user', fsic);
                }
    });  
}

const check_status =()=>{
    let requester = '<?=$uname;?>';
    let req_id = $('#req_id_ref3').val();
    $.ajax({
        url:'../../process/user/bfp.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_status',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  let data = response.split('~!~');
                  let requester = data[0];
                  let request_id = data[1];
                  let owner = data[2];
                  let exact_address = data[3];
                  let bfsben = data[4];
                  let authorized_rep = data[5];
                  let tobn = data[6];
                  let tfa = data[7];
                  let storey_no = data[8];
                  let email_address = data[9];
                  let contact_no = data[10];
                  let owner_sign = data[11];
                  let fire_ex_receipt = data[12];
                  let fer_status = data[13];
                  let building_permit = data[14];
                  let bp_status = data[15];
                  let occupancy_permit = data[16];
                  let op_status = data[17];
                  let fsca = data[18];
                  let fsca_status = data[19];
                  let arr = data[20];
                  let arr_status = data[21];
                  let pob = data[22];
                  let pob_status = data[23];

                  $('#owner_name').val(owner);
                  $('#bfsbe').val(bfsben);
                  $('#address').val(exact_address);
                  $('#ar').val(authorized_rep);
                  $('#tobn').val(tobn);
                  $('#tfa').val(tfa);
                  $('#nos').val(storey_no);
                  $('#contact_no').val(contact_no);                  
                  $('#email').val(email_address);

                  $('#fer_check').val(fire_ex_receipt);
                  $('#bp_check').val(building_permit);
                  $('#op_check').val(occupancy_permit);
                  $('#fsicaf_check').val(fsca);
                  $('#arwr_check').val(arr);
                  $('#pob_check').val(pob);

                  $('#fer_status').html(fer_status);
                  $('#bp_status').html(bp_status);
                  $('#op_status').html(op_status);
                  $('#fsicaf_status').html(fsca_status);
                  $('#arwr_status').html(arr_status);
                  $('#pob_status').html(pob_status);

                  if (fer_status == 'Approved') {
                    document.getElementById('fer_file').style.display = 'none';
                  }else{
                    document.getElementById('fer_file').style.display = 'block';
                  }
                  if (bp_status == 'Approved') {
                    document.getElementById('bp_file').style.display = 'none';
                  }else{
                    document.getElementById('bp_file').style.display = 'block';
                  }
                  if (op_status == 'Approved') {
                    document.getElementById('op_file').style.display = 'none';
                  }else{
                    document.getElementById('op_file').style.display = 'block';
                  }
                  if (fsca_status == 'Approved') {
                    document.getElementById('fsicaf_file').style.display = 'none';
                  }else{
                    document.getElementById('fsicaf_file').style.display = 'block';
                  }
                  if (arr_status == 'Approved') {
                    document.getElementById('arwr_file').style.display = 'none';
                  }else{
                    document.getElementById('arwr_file').style.display = 'block';
                  }
                  if (pob_status == 'Approved') {
                    document.getElementById('pob_file').style.display = 'none';
                  }else{
                    document.getElementById('pob_file').style.display = 'block';
                  }            

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

 let soar_file = null;
 let fer_file = null;
 let bp_file = null;
 let op_file = null;
 let fsicaf_file = null;
 let arwr_file = null;
 let pob_file = null;

   function submit_bfp_req() {
            const soar_fileInput = document.getElementById('soar_file');
            const fer_fileInput = document.getElementById('fer_file');
            const bp_fileInput = document.getElementById('bp_file');
            const op_fileInput = document.getElementById('op_file');
            const fsicaf_fileInput = document.getElementById('fsicaf_file');
            const arwr_fileInput = document.getElementById('arwr_file');
            const pob_fileInput = document.getElementById('pob_file');

            // Use Promise.all to wait for both promises to resolve
            Promise.all([
                convertFileToBase64(soar_fileInput, 'SOAR'),
                convertFileToBase64(fer_fileInput, 'FER'),
                convertFileToBase64(bp_fileInput, 'BP'),
                convertFileToBase64(op_fileInput, 'OP'),
                convertFileToBase64(fsicaf_fileInput, 'FSICAF'),
                convertFileToBase64(arwr_fileInput, 'ARWR'),
                convertFileToBase64(pob_fileInput, 'POB')
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
                            if (documentType === 'SOAR') {
                                soar_file = base64Data;
                            }else if (documentType === 'FER') {
                                fer_file = base64Data;
                            }else if (documentType === 'BP') {
                                bp_file = base64Data;
                            }else if (documentType === 'OP') {
                                op_file = base64Data;
                            }else if (documentType === 'FSICAF') {
                                fsicaf_file = base64Data;
                            }else if (documentType === 'ARWR') {
                                arwr_file = base64Data;
                            }else if (documentType === 'POB') {
                                pob_file = base64Data;
                            }

                            resolve(); // Resolve the promise once the FileReader is done
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If the file is empty, set the corresponding base64 variable to null
                         if (documentType === 'SOAR') {
                                soar_file = null;
                            }else if (documentType === 'FER') {
                                fer_file = null;
                            }else if (documentType === 'BP') {
                                bp_file = null;
                            }else if (documentType === 'OP') {
                                op_file = null;
                            }else if (documentType === 'FSICAF') {
                                fsicaf_file = null;
                            }else if (documentType === 'ARWR') {
                                arwr_file = null;
                            }else if (documentType === 'POB') {
                                pob_file = null;
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
              let req_id_ref = $('#req_id_ref3').val();
              let requester = $('#requester').val();
              let owner_name = $('#owner_name').val();
              let bfsbe = $('#bfsbe').val();
              let address = $('#address').val();
              let ar = $('#ar').val();
              let tobn = $('#tobn').val();
              let tfa = $('#tfa').val();
              let nos = $('#nos').val();
              let contact_no = $('#contact_no').val();
              let email = $('#email').val();
               $.ajax({
                  url:'../../process/user/bfp.php',
                          type: 'POST',
                          cache: false,
                          data:{
                            method: 'submit_bfp_req',
                            req_id_ref:req_id_ref,
                            requester:requester,
                            owner_name:owner_name,
                            bfsbe:bfsbe,
                            address:address,
                            ar:ar,
                            tobn:tobn,
                            tfa:tfa,
                            nos:nos,
                            contact_no:contact_no,
                            email:email,
                            soar_file:soar_file,
                            fer_file:fer_file,
                            bp_file:bp_file,
                            op_file:op_file,
                            fsicaf_file:fsicaf_file,
                            arwr_file:arwr_file,
                            pob_file:pob_file
                          },success:function(response){
                            if (response == 1) {
                              Swal.fire({
                                title: 'Successfully Submitted',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1000
                              });
                               // window.location.reload();
                            }else if(response == 3){
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

const check_button =()=>{
   let requester = '<?=$uname;?>';
   let req_id = $('#req_id_ref3').val();
   $.ajax({
        url:'../../process/user/bfp.php',
                type: 'POST',
                cache: false,
                data:{ 
                  method: 'check_buttons',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  if (response == 1) {
                    document.getElementById('submit_bfp_req').style.display = 'none';
                  }else{
                    document.getElementById('update_bfp_req').style.display = 'none';
                  }
                }
    });
}

 let soar_file_update = null;
 let fer_file_update = null;
 let bp_file_update = null;
 let op_file_update = null;
 let fsicaf_file_update = null;
 let arwr_file_update = null;
 let pob_file_update = null;

   function update_bfp_req() {
            const soar_file_updateInput = document.getElementById('soar_file');
            const fer_file_updateInput = document.getElementById('fer_file');
            const bp_file_updateInput = document.getElementById('bp_file');
            const op_file_updateInput = document.getElementById('op_file');
            const fsicaf_file_updateInput = document.getElementById('fsicaf_file');
            const arwr_file_updateInput = document.getElementById('arwr_file');
            const pob_file_updateInput = document.getElementById('pob_file');

            // Use Promise.all to wait for both promises to resolve
            Promise.all([
                convertFileToBase64_update(soar_file_updateInput, 'SOAR'),
                convertFileToBase64_update(fer_file_updateInput, 'FER'),
                convertFileToBase64_update(bp_file_updateInput, 'BP'),
                convertFileToBase64_update(op_file_updateInput, 'OP'),
                convertFileToBase64_update(fsicaf_file_updateInput, 'FSICAF'),
                convertFileToBase64_update(arwr_file_updateInput, 'ARWR'),
                convertFileToBase64_update(pob_file_updateInput, 'POB')
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
                            if (documentType === 'SOAR') {
                                soar_file_update = base64Data;
                            }else if (documentType === 'FER') {
                                fer_file_update = base64Data;
                            }else if (documentType === 'BP') {
                                bp_file_update = base64Data;
                            }else if (documentType === 'OP') {
                                op_file_update = base64Data;
                            }else if (documentType === 'FSICAF') {
                                fsicaf_file_update = base64Data;
                            }else if (documentType === 'ARWR') {
                                arwr_file_update = base64Data;
                            }else if (documentType === 'POB') {
                                pob_file_update = base64Data;
                            }

                            resolve(); // Resolve the promise once the FileReader is done
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If the file is empty, set the corresponding base64 variable to null
                         if (documentType === 'SOAR') {
                                soar_file_update = null;
                            }else if (documentType === 'FER') {
                                fer_file_update = null;
                            }else if (documentType === 'BP') {
                                bp_file_update = null;
                            }else if (documentType === 'OP') {
                                op_file_update = null;
                            }else if (documentType === 'FSICAF') {
                                fsicaf_file_update = null;
                            }else if (documentType === 'ARWR') {
                                arwr_file_update = null;
                            }else if (documentType === 'POB') {
                                pob_file_update = null;
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
              let req_id_ref = $('#req_id_ref3').val();
              let requester = $('#requester').val();
              let owner_name = $('#owner_name').val();
              let bfsbe = $('#bfsbe').val();
              let address = $('#address').val();
              let ar = $('#ar').val();
              let tobn = $('#tobn').val();
              let tfa = $('#tfa').val();
              let nos = $('#nos').val();
              let contact_no = $('#contact_no').val();
              let email = $('#email').val();
              let fer_status = $('#fer_status').html();
              let bp_status = $('#bp_status').html();
              let op_status = $('#op_status').html();
              let fsicaf_status = $('#fsicaf_status').html();
              let arwr_status = $('#arwr_status').html();
              let pob_status = $('#pob_status').html();
              let soar_check = $('#soar_check').val();
              let fer_check = $('#fer_check').val();
              let bp_check = $('#bp_check').val();
              let op_check = $('#op_check').val();
              let fsicaf_check = $('#fsicaf_check').val();
              let arwr_check = $('#arwr_check').val();
              let pob_check = $('#pob_check').val();

               $.ajax({
                  url:'../../process/user/bfp.php',
                          type: 'POST',
                          cache: false,
                          data:{
                            method: 'update_bfp_req',
                            req_id_ref:req_id_ref,
                            requester:requester,
                            owner_name:owner_name,
                            bfsbe:bfsbe,
                            address:address,
                            ar:ar,
                            tobn:tobn,
                            tfa:tfa,
                            nos:nos,
                            contact_no:contact_no,
                            email:email,
                            soar_file_update:soar_file_update,
                            fer_file_update:fer_file_update,
                            bp_file_update:bp_file_update,
                            op_file_update:op_file_update,
                            fsicaf_file_update:fsicaf_file_update,
                            arwr_file_update:arwr_file_update,
                            pob_file_update:pob_file_update,
                            fer_status:fer_status,
                            bp_status:bp_status,
                            op_status:op_status,
                            fsicaf_status:fsicaf_status,
                            arwr_status:arwr_status,
                            pob_status:pob_status,
                            soar_check:soar_check,
                            fer_check:fer_check,
                            bp_check:bp_check,
                            op_check:op_check,
                            fsicaf_check:fsicaf_check,
                            arwr_check:arwr_check,
                            pob_check:pob_check
                          },success:function(response){
                            console.log(response);
                            if (response == 1) {
                              Swal.fire({
                                title: 'Successfully Updated',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1000
                              });
                               // window.location.reload();
                            }else if(response == 3){
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
</script>