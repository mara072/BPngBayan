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
                }
    });  
}

const check_status =()=>{
   let requester = '<?=$uname;?>';
   let req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/meo.php',
                type: 'POST',
                cache: false,
                data:{ 
                  method: 'check_status',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  let data = response.split('~!~');
                  let op_status = data[0];
                  let bp_status = data[1];
                  let op = data[2];
                  let bp = data[3];
                  $('#op_status_meos').val(op_status);
                  $('#bp_status_meo').val(bp_status);

                  $('#op_file_check').val(op);
                  $('#bp_file_check').val(bp);
 
                  if (op_status == 'Approved') {
                    document.getElementById('op_file_meo').style.display = 'none';
                  }else{
                    document.getElementById('op_file_meo').style.display = 'block';
                  }

                  if (bp_status == 'Approved') {
                    document.getElementById('bp_file_meo').style.display = 'none';
                  }else{
                    document.getElementById('bp_file_meo').style.display = 'block';
                  }
                  
                }
    }); 
}



 let op_file = null;
 let bp_file = null;

   function submit_meo_reqs() {
            const op_fileInput = document.getElementById('op_file_meo');
            const bp_fileInput = document.getElementById('bp_file_meo');

            // Use Promise.all to wait for both promises to resolve
            Promise.all([
                convertFileToBase64(op_fileInput, 'OP'),
                convertFileToBase64(bp_fileInput, 'BP')
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
                            if (documentType === 'OP') {
                                op_file = base64Data;
                            }else if (documentType === 'BP') {
                                bp_file = base64Data;
                            }

                            resolve(); // Resolve the promise once the FileReader is done
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If the file is empty, set the corresponding base64 variable to null
                        if (documentType === 'OP') {
                                op_file = null;
                            }else if (documentType === 'BP') {
                                bp_file = null;
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
                  url:'../../process/user/meo.php',
                          type: 'POST',
                          cache: false,
                          data:{
                            method: 'submit_meo_reqs',
                            req_id_ref:req_id_ref,
                            requester:requester,
                            op_file:op_file,
                            bp_file:bp_file
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

const check_button =()=>{
   let requester = $('#requester').val();
   let req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/meo.php',
                type: 'POST',
                cache: false,
                data:{ 
                  method: 'check_button',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  if (response == 'existing') {
                    document.getElementById('submit_meo_req').style.display = 'none';
                  }else{
                    document.getElementById('update_meo_req').style.display = 'none';
                  }
                }
    });
}

 let op_file_update = null;
 let bp_file_update = null;

   function update_meo_reqs() {
            const op_file_updateInput = document.getElementById('op_file_meo');
            const bp_file_updateInput = document.getElementById('bp_file_meo');

            // Use Promise.all to wait for both promises to resolve
            Promise.all([
                convertFileToBase64_update(op_file_updateInput, 'OP'),
                convertFileToBase64_update(bp_file_updateInput, 'BP')
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
                            if (documentType === 'OP') {
                                op_file_update = base64Data;
                            }else if (documentType === 'BP') {
                                bp_file_update = base64Data;
                            }

                            resolve(); // Resolve the promise once the FileReader is done
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If the file is empty, set the corresponding base64 variable to null
                        if (documentType === 'OP') {
                                op_file_update = null;
                            }else if (documentType === 'BP') {
                                bp_file_update = null;
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
              let op_file_check = $('#op_file_check').val();
              let op_status_meo = $('#op_status_meos').val();
              let bp_file_check = $('#bp_file_check').val();
              let bp_status_meo = $('#bp_status_meo').val();
              // console.log(op_status_meo);
               $.ajax({
                  url:'../../process/user/meo.php',
                          type: 'POST',
                          cache: false,
                          data:{
                            method: 'update_meo_reqs',
                            req_id_ref:req_id_ref,
                            requester:requester,
                            op_file_update:op_file_update,
                            bp_file_update:bp_file_update,
                            op_file_check:op_file_check,
                            op_status_meo:op_status_meo,
                            bp_file_check:bp_file_check,
                            bp_status_meo:bp_status_meo
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

</script>