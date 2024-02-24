<script type="text/javascript">
$(function() {
    check_req_id();
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
                  check_bp();
                }
    });  
}

const check_bp =()=>{
  var req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/bplo.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_bp',
                  req_id:req_id
                },success:function(response){
                  let bp = response;
                  
                  displayPDF('pdf-container_bp', bp);
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

let cedula_file = null;
let dti_file = null;
let bbcor_file = null;
let scc_file = null;
let pic_file = null;

   function submit_bplo_req() {
            const cedula_fileInput = document.getElementById('bplo_cedula_file');
            const dti_fileInput = document.getElementById('bplo_dti_file');
            const bbcor_fileInput = document.getElementById('bplo_bbcor_file');
            const scc_fileInput = document.getElementById('bplo_scc_file');
            const pic_fileInput = document.getElementById('bplo_2pic_file');

            // Use Promise.all to wait for both promises to resolve
            Promise.all([
                convertFileToBase64(cedula_fileInput, 'CEDULA'),
                convertFileToBase64(dti_fileInput, 'DTI'),
                convertFileToBase64(bbcor_fileInput, 'BBCOR'),
                convertFileToBase64(scc_fileInput, 'SCC'),
                convertFileToBase64(pic_fileInput, 'PIC')
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
                            if (documentType === 'CEDULA') {
                                cedula_file = base64Data;
                           	}else if (documentType === 'DTI') {
                                dti_file = base64Data;
                            }else if (documentType === 'BBCOR') {
                                bbcor_file = base64Data;
                            }else if (documentType === 'SCC') {
                                scc_file = base64Data;
                            }else if (documentType === 'PIC') {
                                pic_file = base64Data;
                            }

                            resolve(); // Resolve the promise once the FileReader is done
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If the file is empty, set the corresponding base64 variable to null
                        if (documentType === 'CEDULA') {
                                cedula_file = null;
                            }else if (documentType === 'DTI') {
                                dti_file = null;
                            }else if (documentType === 'BBCOR') {
                                bbcor_file = null;
                            }else if (documentType === 'SCC') {
                                scc_file = null;
                            }else if (documentType === 'PIC') {
                                pic_file = null;
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
            console.log(req_id_ref);
            console.log(requester);
              if (cedula_file === null) {
                Swal.fire({
                  title: 'Please Select Cedula File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(dti_file === null){
                Swal.fire({
                  title: 'Please Select DTI File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(bbcor_file === null){
                Swal.fire({
                  title: 'Please Select Brgy. Business Clearance & Official Receipt File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(scc_file === null){
                Swal.fire({
                  title: 'Please Select SSS Certificate of Compliance File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(pic_file === null){
                Swal.fire({
                  title: 'Please Select 2x2 Picture File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else{

               $.ajax({
                  url:'../../process/user/bplo.php',
                          type: 'POST',
                          cache: false,
                          data:{
                            method: 'submit_bplo_req',
                            req_id_ref:req_id_ref,
                            requester:requester,
                            cedula_file:cedula_file,
							dti_file:dti_file,
							bbcor_file:bbcor_file,
							scc_file:scc_file,
							pic_file:pic_file
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
                            }else if(response == 'existing'){
                              Swal.fire({
                                title: 'Already Have Requirements',
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
} 

const check_status =()=>{
   let requester = $('#requester').val();
   let req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/bplo.php',
                type: 'POST',
                cache: false,
                data:{ 
                  method: 'check_status',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  
                  let data = response.split('~!~');
                  let cedula_status = data[0];
                  let dti_status = data[1];
                  let bbcor_status = data[2];
                  let scc_status = data[3];
                  let pic_status = data[4];
                  let cedula = data[5];
                  let dti = data[6];
                  let bbcor = data[7];
                  let scc = data[8];
                  let pic = data[9];

                  $('#bplo_status_cedula').html(cedula_status);
                  $('#bplo_status_dti').html(dti_status);
                  $('#bplo_status_bbcor').html(bbcor_status);
                  $('#bplo_status_scc').html(scc_status);
                  $('#bplo_status_2pic').html(pic_status);
                  $('#bplo_check_cedula').val(cedula);
                  $('#bplo_check_dti').val(dti);
                  $('#bplo_check_bbcor').val(bbcor);
                  $('#bplo_check_scc').val(scc);
                  $('#bplo_check_2pic').val(pic);
                  if (cedula_status == 'Approved') {
                    document.getElementById('bplo_cedula_file').style.display = 'none';
                  }else{
                    document.getElementById('bplo_cedula_file').style.display = 'block';
                  }
                  if (dti_status == 'Approved') {
                    document.getElementById('bplo_dti_file').style.display = 'none';
                  }else{
                    document.getElementById('bplo_dti_file').style.display = 'block';
                  }
                  if (bbcor_status == 'Approved') {
                    document.getElementById('bplo_bbcor_file').style.display = 'none';
                  }else{
                    document.getElementById('bplo_bbcor_file').style.display = 'block';
                  }
                  if (scc_status == 'Approved') {
                    document.getElementById('bplo_scc_file').style.display = 'none';
                  }else{
                    document.getElementById('bplo_scc_file').style.display = 'block';
                  }
                  if (pic_status == 'Approved') {
                    document.getElementById('bplo_2pic_file').style.display = 'none';
                  }else{
                    document.getElementById('bplo_2pic_file').style.display = 'block';
                  }
                }
    }); 
}

const check_button =()=>{
   let requester = $('#requester').val();
   let req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/bplo.php',
                type: 'POST',
                cache: false,
                data:{ 
                  method: 'check_button',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  if (response == 'existing') {
                    document.getElementById('submit_bplo_req').style.display = 'none';
                  }else{
                    document.getElementById('update_bplo_req').style.display = 'none';
                  }
                }
    });
}

let cedula_file_update = null;
let dti_file_update = null;
let bbcor_file_update = null;
let scc_file_update = null;
let pic_file_update = null;

   function update_bplo_req() {
            const cedula_file_update = document.getElementById('bplo_cedula_file');
            const dti_file_update = document.getElementById('bplo_dti_file');
            const bbcor_file_update = document.getElementById('bplo_bbcor_file');
            const scc_file_update = document.getElementById('bplo_scc_file');
            const pic_file_update = document.getElementById('bplo_2pic_file');

            // Use Promise.all to wait for both promises to resolve
            Promise.all([
                convertFileToBase64_update(cedula_file_update, 'CEDULA'),
                convertFileToBase64_update(dti_file_update, 'DTI'),
                convertFileToBase64_update(bbcor_file_update, 'BBCOR'),
                convertFileToBase64_update(scc_file_update, 'SCC'),
                convertFileToBase64_update(pic_file_update, 'PIC')
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
                            if (documentType === 'CEDULA') {
                                cedula_file_update = base64Data;
                            }else if (documentType === 'DTI') {
                                dti_file_update = base64Data;
                            }else if (documentType === 'BBCOR') {
                                bbcor_file_update = base64Data;
                            }else if (documentType === 'SCC') {
                                scc_file_update = base64Data;
                            }else if (documentType === 'PIC') {
                                pic_file_update = base64Data;
                            }

                            resolve(); // Resolve the promise once the FileReader is done
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If the file is empty, set the corresponding base64 variable to null
                        if (documentType === 'CEDULA') {
                                cedula_file_update = null;
                            }else if (documentType === 'DTI') {
                                dti_file_update = null;
                            }else if (documentType === 'BBCOR') {
                                bbcor_file_update = null;
                            }else if (documentType === 'SCC') {
                                scc_file_update = null;
                            }else if (documentType === 'PIC') {
                                pic_file_update = null;
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
              let bplo_check_cedula = $('#bplo_check_cedula').val();
              let bplo_check_dti = $('#bplo_check_dti').val();
              let bplo_check_bbcor = $('#bplo_check_bbcor').val();
              let bplo_check_scc = $('#bplo_check_scc').val();
              let bplo_check_2pic = $('#bplo_check_2pic').val();
              let bplo_status_cedula = $('#bplo_status_cedula').html();
              let bplo_status_dti = $('#bplo_status_dti').html();
              let bplo_status_bbcor = $('#bplo_status_bbcor').html();
              let bplo_status_scc = $('#bplo_status_scc').html();
              let bplo_status_2pic = $('#bplo_status_2pic').html();

               $.ajax({
                  url:'../../process/user/bplo.php',
                          type: 'POST',
                          cache: false,
                          data:{
                            method: 'update_bplo_req',
                            req_id_ref:req_id_ref,
                            requester:requester,
                            cedula_file_update:cedula_file_update,
                            dti_file_update:dti_file_update,
                            bbcor_file_update:bbcor_file_update,
                            scc_file_update:scc_file_update,
                            pic_file_update:pic_file_update,
                            bplo_check_cedula:bplo_check_cedula,
                            bplo_check_dti:bplo_check_dti,
                            bplo_check_bbcor:bplo_check_bbcor,
                            bplo_check_scc:bplo_check_scc,
                            bplo_check_2pic:bplo_check_2pic,
                            bplo_status_cedula:bplo_status_cedula,
                            bplo_status_dti:bplo_status_dti,
                            bplo_status_bbcor:bplo_status_bbcor,
                            bplo_status_scc:bplo_status_scc,
                            bplo_status_2pic:bplo_status_2pic
                          },success:function(response){
                            console.log(response);
                            if (response == 'success') {
                              Swal.fire({
                                title: 'Successfully Updated',
                                icon: 'success',
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