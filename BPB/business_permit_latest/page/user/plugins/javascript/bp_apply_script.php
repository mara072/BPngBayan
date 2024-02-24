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
                  check_button();
                   check_status();
                }
    });  
}
const check_button =()=>{
   let requester = '<?=$uname;?>';
   let req_id = document.querySelector('#req_id').innerHTML;
   $.ajax({
        url:'../../process/user/req_id.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_button',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  if (response == 'existing') {
                    document.getElementById('submit_bp_req').style.display = 'none';
                  }else{
                    document.getElementById('update_bp_req').style.display = 'none';
                  }
                }
    });
}

const check_status =()=>{
    let requester = '<?=$uname;?>';
    let req_id = document.querySelector('#req_id').innerHTML;
    $.ajax({
        url:'../../process/user/req_id.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_status',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  let data = response.split('~!~');
                  let tct_status = data[0];
                  let dti_status = data[1];
                  let bcr_status = data[2];
                  let csl_status = data[3];
                  let mc_status = data[4];
                  let dpwh_status = data[5];
                  let op_status = data[6];
                  let pbp_status = data[7];
                  let gs_status = data[8];
                  let bp_status = data[9];
                  let applicant_name = data[10];
                  let applicant_address = data[11];
                  let owner = data[12];
                  let title_no = data[13];
                  let td_no = data[14];
                  let pin = data[15];
                  let total_area = data[16];
                  let location_lot = data[17];
                  let rol = data[18];
                  let sa_file = data[19];
                  let so_file = data[20];
                  let tct_file = data[21];
                  let dti_file = data[22];
                  let bcr_file = data[23];
                  let csl_file = data[24];
                  let mc_file = data[25];
                  let dpwh_file = data[26];
                  let op_file = data[27];
                  let pbp_file = data[28];
                  let gs_file = data[29];
                  let bp_file = data[30];

                  $('#sa_file_check').val(sa_file);
                  $('#so_file_check').val(so_file);
                  $('#tct_file_check').val(tct_file);
                  $('#dti_file_check').val(dti_file);
                  $('#bcr_file_check').val(bcr_file);
                  $('#csl_file_check').val(csl_file);
                  $('#mc_file_check').val(mc_file);
                  $('#dpwh_file_check').val(dpwh_file);                  
                  $('#op_file_check').val(op_file);
                  $('#pbp_file_check').val(pbp_file);
                  $('#gs_file_check').val(gs_file);
                  $('#bp_file_check').val(bp_file);

                  $('#applicant_name').val(applicant_name);
                  $('#applicant_address').val(applicant_address);
                  $('#owner').val(owner);
                  $('#title_no').val(title_no);
                  $('#td_no').val(td_no);
                  $('#owner').val(owner);
                  $('#pin').val(pin);
                  $('#total_area').val(total_area);
                  $('#location_lot').val(location_lot);
                  $('#rol').val(rol);
                  $('#tct_req_status').html(tct_status);
                  $('#dti_req_status').html(dti_status);
                  $('#bcr_req_status').html(bcr_status);
                  $('#csl_req_status').html(csl_status);
                  $('#mc_req_status').html(mc_status);
                  $('#dpwh_req_status').html(dpwh_status);
                  $('#op_req_status').html(op_status);
                  $('#pbp_req_status').html(pbp_status);
                  $('#gs_req_status').html(gs_status);
                  $('#bp_req_status').html(bp_status);
                  if (tct_status == 'Approved') {
                    document.getElementById('tct_file').style.display = 'none';
                  }else{
                    document.getElementById('tct_file').style.display = 'block';
                  }
                  if (dti_status == 'Approved') {
                    document.getElementById('dti_file').style.display = 'none';
                  }else{
                    document.getElementById('dti_file').style.display = 'block';
                  }
                  if (bcr_status == 'Approved') {
                    document.getElementById('bcr_file').style.display = 'none';
                  }else{
                    document.getElementById('bcr_file').style.display = 'block';
                  }
                  if (csl_status == 'Approved') {
                    document.getElementById('csl_file').style.display = 'none';
                  }else{
                    document.getElementById('csl_file').style.display = 'block';
                  }
                  if (mc_status == 'Approved') {
                    document.getElementById('mc_file').style.display = 'none';
                  }else{
                    document.getElementById('mc_file').style.display = 'block';
                  }
                  if (dpwh_status == 'Approved') {
                    document.getElementById('dpwh_file').style.display = 'none';
                  }else{
                    document.getElementById('dpwh_file').style.display = 'block';
                  }
                  if (op_status == 'Approved') {
                    document.getElementById('op_file').style.display = 'none';
                  }else{
                    document.getElementById('op_file').style.display = 'block';
                  }
                  if (pbp_status == 'Approved') {
                    document.getElementById('pbp_file').style.display = 'none';
                  }else{
                    document.getElementById('pbp_file').style.display = 'block';
                  }
                  if (gs_status == 'Approved') {
                    document.getElementById('gs_file').style.display = 'none';
                  }else{
                    document.getElementById('gs_file').style.display = 'block';
                  }
                  if (bp_status == 'Approved') {
                    document.getElementById('bp_file').style.display = 'none';
                  }else{
                    document.getElementById('bp_file').style.display = 'block';
                  }

                }
    });
}

  let sa_file = null;
  let so_file = null;
  let tct_file = null;
  let dti_file = null;
  let bcr_file = null;
  let csl_file = null;
  let mc_file = null;
  let dpwh_file = null;
  let op_file = null;
  let pbp_file = null;
  let gs_file = null;
  let bp_file = null;

   function submit_bp_req() {
            const sa_fileInput = document.getElementById('sa_file');
            const so_fileInput = document.getElementById('so_file');
            const tct_fileInput = document.getElementById('tct_file');
            const dti_fileInput = document.getElementById('dti_file');
            const bcr_fileInput = document.getElementById('bcr_file');
            const csl_fileInput = document.getElementById('csl_file');
            const mc_fileInput = document.getElementById('mc_file');
            const dpwh_fileInput = document.getElementById('dpwh_file');
            const op_fileInput = document.getElementById('op_file');
            const pbp_fileInput = document.getElementById('pbp_file');
            const gs_fileInput = document.getElementById('gs_file');
            const bp_fileInput = document.getElementById('bp_file');

            // Use Promise.all to wait for both promises to resolve
            Promise.all([
                convertFileToBase64(sa_fileInput, 'SA'),
                convertFileToBase64(so_fileInput, 'SO'),
                convertFileToBase64(tct_fileInput, 'TCT'),
                convertFileToBase64(dti_fileInput, 'DTI'),
                convertFileToBase64(bcr_fileInput, 'BCR'),
                convertFileToBase64(csl_fileInput, 'CSL'),
                convertFileToBase64(mc_fileInput, 'MC'),
                convertFileToBase64(dpwh_fileInput, 'DPWH'),
                convertFileToBase64(op_fileInput, 'OP'),
                convertFileToBase64(pbp_fileInput, 'PBP'),
                convertFileToBase64(gs_fileInput, 'GS'),
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
                            if (documentType === 'SA') {
                                sa_file = base64Data;
                            }else if (documentType === 'SO') {
                                so_file = base64Data;
                            }else if (documentType === 'TCT') {
                                tct_file = base64Data;
                            }else if (documentType === 'DTI') {
                                dti_file = base64Data;
                            }else if (documentType === 'BCR') {
                                bcr_file = base64Data;
                            }else if (documentType === 'CSL') {
                                csl_file = base64Data;
                            }else if (documentType === 'MC') {
                                mc_file = base64Data;
                            }else if (documentType === 'DPWH') {
                                dpwh_file = base64Data;
                            }else if (documentType === 'OP') {
                                op_file = base64Data;
                            }else if (documentType === 'PBP') {
                                pbp_file = base64Data;
                            }else if (documentType === 'GS') {
                                gs_file = base64Data;
                            }else if (documentType === 'BP') {
                                bp_file = base64Data;
                            }

                            resolve(); // Resolve the promise once the FileReader is done
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If the file is empty, set the corresponding base64 variable to null
                        if (documentType === 'SA') {
                                sa_file = null;
                            }else if (documentType === 'SO') {
                                so_file = null;
                            }else if (documentType === 'TCT') {
                                tct_file = null;
                            }else if (documentType === 'DTI') {
                                dti_file = null;
                            }else if (documentType === 'BCR') {
                                bcr_file = null;
                            }else if (documentType === 'CSL') {
                                csl_file = null;
                            }else if (documentType === 'MC') {
                                mc_file = null;
                            }else if (documentType === 'DPWH') {
                                dpwh_file = null;
                            }else if (documentType === 'OP') {
                                op_file = null;
                            }else if (documentType === 'PBP') {
                                pbp_file = null;
                            }else if (documentType === 'GS') {
                                gs_file = null;
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
              let applicant_name = $('#applicant_name').val();
              let applicant_address = $('#applicant_address').val();
              let owner = $('#owner').val();
              let title_no = $('#title_no').val();
              let td_no = $('#td_no').val();
              let pin = $('#pin').val();
              let total_area = $('#total_area').val();
              let location_lot = $('#location_lot').val();
              let rol = $('#rol').val();
              if (applicant_name == '') {
                Swal.fire({
                  title: 'Please Applicant Name',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(applicant_address == ''){
                Swal.fire({
                  title: 'Please Input Applicant Address',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(owner == ''){
                Swal.fire({
                  title: 'Please Input Owner Name',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(title_no == ''){
                Swal.fire({
                  title: 'Please Input Title No',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(td_no == ''){
                Swal.fire({
                  title: 'Please Input TD No',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(pin == ''){
                Swal.fire({
                  title: 'Please Input Pin',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(total_area == ''){
                Swal.fire({
                  title: 'Please Input Total Area of Lot',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(location_lot == ''){
                Swal.fire({
                  title: 'Please Input Location of Lot',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(rol == ''){
                Swal.fire({
                  title: 'Please Input Right Over Land',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(sa_file === null){
                Swal.fire({
                  title: 'Please Select Signature of Application File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(so_file === null){
                Swal.fire({
                  title: 'Please Select Signature of Owner File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(tct_file === null){
                Swal.fire({
                  title: 'Please Select TCT File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(dti_file === null){
                Swal.fire({
                  title: 'Please Select DTI / SEC File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(bcr_file === null){
                Swal.fire({
                  title: 'Please Select Signature of Owner File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(op_file === null){
                Swal.fire({
                  title: 'Please Select Occupancy Permit File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(pbp_file === null){
                Swal.fire({
                  title: 'Please Select Picture of Business Place File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(gs_file === null){
                Swal.fire({
                  title: 'Please Select Geographical Sketch File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else if(bp_file === null){
                Swal.fire({
                  title: 'Please Select Building Permnit File',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 1000
                });
              }else{

               $.ajax({
                  url:'../../process/user/mpdc.php',
                          type: 'POST',
                          cache: false,
                          data:{
                            method: 'submit_bp_req',
                            req_id_ref:req_id_ref,
                            requester:requester,
                            applicant_name:applicant_name,
                            applicant_address:applicant_address,
                            owner:owner,
                            title_no:title_no,
                            td_no:td_no,
                            pin:pin,
                            total_area:total_area,
                            location_lot:location_lot,
                            rol:rol,
                            sa_file:sa_file,
                            so_file:so_file,
                            tct_file:tct_file,
                            dti_file:dti_file,
                            bcr_file:bcr_file,
                            csl_file:csl_file,
                            mc_file:mc_file,
                            dpwh_file:dpwh_file,
                            op_file:op_file,
                            pbp_file:pbp_file,
                            gs_file:gs_file,
                            bp_file:bp_file
                          },success:function(response){
                            if (response == 'success') {
                              Swal.fire({
                                title: 'Successfully Submitted',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1000
                              });
                               
                            }else if(response == 'existing'){
                              Swal.fire({
                                title: 'Already Have Requirements',
                                icon: 'info',
                                showConfirmButton: false,
                                timer: 1000
                              });
                               
                            }else{
                              Swal.fire({
                                title: 'Error',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1000
                              });
                               
                            }
                          }
              });  
              }
        }

let sa_fileContent;
let so_fileContent;
let tct_fileContent;
let dti_fileContent;
let bcr_fileContent;
let csl_fileContent;
let mc_fileContent;
let dpwh_fileContent;
let op_fileContent;
let pbp_fileContent;
let gs_fileContent;
let bp_fileContent;

  async function update_bp_req() {
       let req_id_ref = $('#req_id_ref').val();
    let requester = $('#requester').val();
    let applicant_name = $('#applicant_name').val();
    let applicant_address = $('#applicant_address').val();
    let owner = $('#owner').val();
    let title_no = $('#title_no').val();
    let td_no = $('#td_no').val();
    let pin = $('#pin').val();
    let total_area = $('#total_area').val();
    let location_lot = $('#location_lot').val();
    let rol = $('#rol').val();
    let sa_file_check =$('#sa_file_check').val();
    let so_file_check =$('#so_file_check').val();
    sa_fileContent = await readFileContent('sa_file');
    so_fileContent = await readFileContent('so_file');
    tct_fileContent = await readFileContent('tct_file');
    dti_fileContent = await readFileContent('dti_file');
    bcr_fileContent = await readFileContent('bcr_file');
    csl_fileContent = await readFileContent('csl_file');
    mc_fileContent = await readFileContent('mc_file');
    dpwh_fileContent = await readFileContent('dpwh_file');
    op_fileContent = await readFileContent('op_file');
    pbp_fileContent = await readFileContent('pbp_file');
    gs_fileContent = await readFileContent('gs_file');
    bp_fileContent = await readFileContent('bp_file');
    
    let tct_status = document.querySelector('#tct_req_status').innerHTML;
    let tct_file;
    let dti_status = document.querySelector('#dti_req_status').innerHTML;
    let dti_file;
    let bcr_status = document.querySelector('#bcr_req_status').innerHTML;
    let bcr_file;
    let csl_status = document.querySelector('#csl_req_status').innerHTML;
    let csl_file;
    let mc_status = document.querySelector('#mc_req_status').innerHTML;
    let mc_file;
    let dpwh_status = document.querySelector('#dpwh_req_status').innerHTML;
    let dpwh_file;
    let op_status = document.querySelector('#op_req_status').innerHTML;
    let op_file;
    let pbp_status = document.querySelector('#pbp_req_status').innerHTML;
    let pbp_file;
    let gs_status = document.querySelector('#gs_req_status').innerHTML;
    let gs_file;
    let bp_status = document.querySelector('#bp_req_status').innerHTML;
    let bp_file;

    if (tct_status === 'Approved') {
      tct_file = $('#tct_file_check').val();
    } else {
      tct_file = tct_fileContent;
    }

    if (dti_status === 'Approved') {
      dti_file = $('#dti_file_check').val();
    } else {
      dti_file = dti_fileContent;
    }

   if (bcr_status === 'Approved') {
      bcr_file = $('#bcr_file_check').val();
    } else {
      bcr_file = bcr_fileContent;
    }

  if (csl_status === 'Approved') {
      csl_file = $('#csl_file_check').val();
    } else {
      csl_file = csl_fileContent;
    }

  if (mc_status === 'Approved') {
      mc_file = $('#mc_file_check').val();
    } else {
      mc_file = mc_fileContent;
    }

  if (dpwh_status === 'Approved') {
      dpwh_file = $('#dpwh_file_check').val();
    } else {
      dpwh_file = dpwh_fileContent;
    }

  if (dpwh_status === 'Approved') {
      dpwh_file = $('#dpwh_file_check').val();
    } else {
      dpwh_file = dpwh_fileContent;
    }

  if (op_status === 'Approved') {
      op_file = $('#op_file_check').val();
    } else {
      op_file = op_fileContent;
    }
  if (pbp_status === 'Approved') {
      pbp_file = $('#pbp_file_check').val();
    } else {
      pbp_file = pbp_fileContent;
    }
  if (gs_status === 'Approved') {
      gs_file = $('#gs_file_check').val();
    } else {
      gs_file = gs_fileContent;
    }
  if (bp_status === 'Approved') {
      bp_file = $('#bp_file_check').val();
    } else {
      bp_file = bp_fileContent;
    }

   if (applicant_name == '') {
                  Swal.fire({
                    title: 'Please Applicant Name',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if(applicant_address == ''){
                  Swal.fire({
                    title: 'Please Input Applicant Address',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if(owner == ''){
                  Swal.fire({
                    title: 'Please Input Owner Name',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if(title_no == ''){
                  Swal.fire({
                    title: 'Please Input Title No',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if(td_no == ''){
                  Swal.fire({
                    title: 'Please Input TD No',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if(pin == ''){
                  Swal.fire({
                    title: 'Please Input Pin',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if(total_area == ''){
                  Swal.fire({
                    title: 'Please Input Total Area of Lot',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if(location_lot == ''){
                  Swal.fire({
                    title: 'Please Input Location of Lot',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if(rol == ''){
                  Swal.fire({
                    title: 'Please Input Right Over Land',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if (tct_file === null) {
                    Swal.fire({
                    title: 'Please Select TCT File',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if (dti_file === null) {
                    Swal.fire({
                    title: 'Please Select DTI/SEC File',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if (bcr_file === null) {
                    Swal.fire({
                    title: 'Please Select Brgy. Business Clearance with Receipt File',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if (csl_file === null) {
                    Swal.fire({
                    title: 'Please Select Contract of Sale / Lease File',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if (mc_file === null) {
                    Swal.fire({
                    title: 'Please Select Market Clearance File',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if (dpwh_file === null) {
                    Swal.fire({
                    title: 'Please Select DPWH Clearance File',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if (op_file === null) {
                    Swal.fire({
                    title: 'Please Select Occupancy Permit File',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if (pbp_file === null) {
                    Swal.fire({
                    title: 'Please Select Picture of Business Place File',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if (gs_file === null) {
                    Swal.fire({
                    title: 'Please Select Geographical Sketch File',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else if (bp_file === null) {
                    Swal.fire({
                    title: 'Please Select Business Permit File',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
                }else{
                  //ajax
                   $.ajax({
                    url:'../../process/user/mpdc.php',
                            type: 'POST',
                            cache: false,
                            data:{
                              method: 'update_bp_req',
                              req_id_ref:req_id_ref,
                              requester:requester,
                              applicant_name:applicant_name,
                              applicant_address:applicant_address,
                              owner:owner,
                              title_no:title_no,
                              td_no:td_no,
                              pin:pin,
                              total_area:total_area,
                              location_lot:location_lot,
                              rol:rol,
                              sa_fileContent:sa_fileContent,
                              so_fileContent:so_fileContent,
                              tct_file:tct_file,
                              dti_file:dti_file,
                              bcr_file:bcr_file,
                              csl_file:csl_file,
                              mc_file:mc_file,
                              dpwh_file:dpwh_file,
                              op_file:op_file,
                              pbp_file:pbp_file,
                              gs_file:gs_file,
                              bp_file:bp_file,
                              sa_file_check:sa_file_check,
                              so_file_check:so_file_check
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

  function readFileContent(inputId) {
    return new Promise(resolve => {
      const fileInput = document.getElementById(inputId);

      if (!fileInput) {
        console.error(`File input with id '${inputId}' not found.`);
        resolve(null);
        return;
      }

      const file = fileInput.files[0];
      if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
          const base64Content = e.target.result;
          resolve(base64Content);
        };

        reader.readAsDataURL(file);
      } else {
        resolve(null);
      }
    });
  }


</script>