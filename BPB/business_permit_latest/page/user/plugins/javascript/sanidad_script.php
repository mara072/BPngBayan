<script type="text/javascript">
$(function() {
    check_req_id();
    setTimeout(check_sp, 3000);
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
                  check_status();
                  check_button();
                }
    });  
}

const check_sp =()=>{
  var req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/sanidad.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_sp',
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

 let fecalysis_file = null;
 let urinalysis_file = null;
 let xray_file = null;
 let drug_test_file = null;

   function submit_sanidad_reqs() {
            const fecalysis_fileInput = document.getElementById('fecalysis_file');
            const urinalysis_fileInput = document.getElementById('urinalysis_file');
            const xray_fileInput = document.getElementById('xray_file');
            const drug_test_fileInput = document.getElementById('drug_test_file');

            // Use Promise.all to wait for both promises to resolve
            Promise.all([
                convertFileToBase64(fecalysis_fileInput, 'FECALYSIS'),
                convertFileToBase64(urinalysis_fileInput, 'URINALYSIS'),
                convertFileToBase64(xray_fileInput, 'XRAY'),
                convertFileToBase64(drug_test_fileInput, 'DRUG')
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
                            if (documentType === 'FECALYSIS') {
                                fecalysis_file = base64Data;
                            }else if (documentType === 'URINALYSIS') {
                                urinalysis_file = base64Data;
                            }else if (documentType === 'XRAY') {
                                xray_file = base64Data;
                            }else if (documentType === 'DRUG') {
                                drug_test_file = base64Data;
                            }

                            resolve(); // Resolve the promise once the FileReader is done
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If the file is empty, set the corresponding base64 variable to null
                        if (documentType === 'FECALYSIS') {
                                fecalysis_file = null;
                            }else if (documentType === 'URINALYSIS') {
                                urinalysis_file = null;
                            }else if (documentType === 'XRAY') {
                                xray_file = null;
                            }else if (documentType === 'DRUG') {
                                drug_test_file = null;
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
                  url:'../../process/user/sanidad.php',
                          type: 'POST',
                          cache: false,
                          data:{
                            method: 'submit_sanidad_reqs',
                            req_id_ref:req_id_ref,
                            requester:requester,
                            fecalysis_file:fecalysis_file,
                            urinalysis_file:urinalysis_file,
                            xray_file:xray_file,
                            drug_test_file:drug_test_file
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
        url:'../../process/user/sanidad.php',
                type: 'POST',
                cache: false,
                data:{ 
                  method: 'check_status',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  
                  let data = response.split('~!~');
                  let fecalysis_status = data[0];
                  let urinalysis_status = data[1];
                  let chest_xray_status = data[2];
                  let drug_test_status = data[3];
                  let fecalysis = data[4];
                  let urinalysis = data[5];
                  let chest_xray = data[6];
                  let drug_test = data[7];
                  let f_status = data[8];
                  $('#sanidad_status_fecalysis').html(fecalysis_status);
                  $('#sanidad_status_urinalysis').html(urinalysis_status);
                  $('#sanidad_status_xray').html(chest_xray_status);
                  $('#sanidad_status_drug_test').html(drug_test_status);
                  $('#fecalysis_check').val(fecalysis);
                  $('#urinalysis_check').val(urinalysis);
                  $('#xray_check').val(chest_xray);
                  $('#drug_test_check').val(drug_test);

                  if (fecalysis_status == 'Approved') {
                    document.getElementById('fecalysis_file').style.display = 'none';
                  }else{
                    document.getElementById('fecalysis_file').style.display = 'block';
                  }
                  if (urinalysis_status == 'Approved') {
                    document.getElementById('urinalysis_file').style.display = 'none';
                  }else{
                    document.getElementById('urinalysis_file').style.display = 'block';
                  }
                  if (chest_xray_status == 'Approved') {
                    document.getElementById('xray_file').style.display = 'none';
                  }else{
                    document.getElementById('xray_file').style.display = 'block';
                  }
                  if (drug_test_status == 'Approved') {
                    document.getElementById('drug_test_file').style.display = 'none';
                  }else{
                    document.getElementById('drug_test_file').style.display = 'block';
                  }
                }
    }); 
}

const check_button =()=>{
   let requester = $('#requester').val();
   let req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/sanidad.php',
                type: 'POST',
                cache: false,
                data:{ 
                  method: 'check_button',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  if (response == 'existing') {
                    document.getElementById('submit_sanidad_req').style.display = 'none';
                  }else{
                    document.getElementById('update_sanidad_req').style.display = 'none';
                  }
                }
    });
}

 let fecalysis_file_update = null;
 let urinalysis_file_update = null;
 let xray_file_update = null;
 let drug_test_file_update = null;

   function update_sanidad_reqs() {
            const fecalysis_file_updateInput = document.getElementById('fecalysis_file');
            const urinalysis_file_updateInput = document.getElementById('urinalysis_file');
            const xray_file_updateInput = document.getElementById('xray_file');
            const drug_test_file_updateInput = document.getElementById('drug_test_file');

            // Use Promise.all to wait for both promises to resolve
            Promise.all([
                convertFileToBase64_update(fecalysis_file_updateInput, 'FECALYSIS'),
                convertFileToBase64_update(urinalysis_file_updateInput, 'URINALYSIS'),
                convertFileToBase64_update(xray_file_updateInput, 'XRAY'),
                convertFileToBase64_update(drug_test_file_updateInput, 'DRUG')
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
                            if (documentType === 'FECALYSIS') {
                                fecalysis_file_update = base64Data;
                            }else if (documentType === 'URINALYSIS') {
                                urinalysis_file_update = base64Data;
                            }else if (documentType === 'XRAY') {
                                xray_file_update = base64Data;
                            }else if (documentType === 'DRUG') {
                                drug_test_file_update = base64Data;
                            }

                            resolve(); // Resolve the promise once the FileReader is done
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If the file is empty, set the corresponding base64 variable to null
                        if (documentType === 'FECALYSIS') {
                                fecalysis_file_update = null;
                            }else if (documentType === 'URINALYSIS') {
                                urinalysis_file_update = null;
                            }else if (documentType === 'XRAY') {
                                xray_file_update = null;
                            }else if (documentType === 'DRUG') {
                                drug_test_file_update = null;
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
              let fecalysis_check = $('#fecalysis_check').val();
              let urinalysis_check = $('#urinalysis_check').val();
              let xray_check = $('#xray_check').val();
              let drug_test_check = $('#drug_test_check').val();
              let fecalysis_status = $('#sanidad_status_fecalysis').html();
              let urinalysis_status = $('#sanidad_status_urinalysis').html();
              let xray_status = $('#sanidad_status_xray').html();
              let drug_test_status = $('#sanidad_status_drug_test').html();
               $.ajax({
                  url:'../../process/user/sanidad.php',
                          type: 'POST',
                          cache: false,
                          data:{
                            method: 'update_sanidad_reqs',
                            req_id_ref:req_id_ref,
                            requester:requester,
                            fecalysis_file_update:fecalysis_file_update,
                            urinalysis_file_update:urinalysis_file_update,
                            xray_file_update:xray_file_update,
                            drug_test_file_update:drug_test_file_update,
                            fecalysis_check:fecalysis_check,
                            urinalysis_check:urinalysis_check,
                            xray_check:xray_check,
                            drug_test_check:drug_test_check,
                            fecalysis_status:fecalysis_status,
                            urinalysis_status:urinalysis_status,
                            xray_status:xray_status,
                            drug_test_status:drug_test_status
                          },success:function(response){
                            if (response == 'success') {
                              Swal.fire({
                                title: 'Successfully Updated',
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
</script>