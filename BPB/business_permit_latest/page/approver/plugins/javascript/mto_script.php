<script type="text/javascript">
$(function() {
    mto_search_req();
    
});

const get_data =()=>{
  var requester = $('#mto_requester_req').val();
  var request_id = $('#mto_request_id_req').val();
  send_email(requester,request_id,'','mto');
}
//SENDS THE EMAIL 
const send_email =(requester,request_id,applicant_name,dept_sender)=>{
  
  // console.log(requester)
  // console.log(request_id)
  // console.log(applicant_name)
  // console.log(dept_sender)
  $.ajax({
    url:'../../process/mailer/index.php',
    type: 'POST',
    data:{
      requester_email:requester,
      request_id:request_id,
      applicant_name:applicant_name,
      dept_sender:dept_sender
    },success:function(response){
      console.log(response);
    }
  })
}

const mto_search_req =()=>{
    let requester = $('#mto_requester_search').val();
    let request_type = $('#mto_request_type_search').val();

    $('#spinner').css('display','block');
	   $.ajax({
        url:'../../process/approver/mto.php',
                type: 'POST',
                cache: false,
                serverSide:true,
                data:{
                  method: 'mto_requirements',
                    requester:requester,
                    request_type:request_type
                },success:function(response){
                  $('#mto_check_req').html(response);
                  $('#spinner').fadeOut();
                }
  });
}

const get_mtoreq_details = async (param) => {
    let data = param.split('~!~');
    let id = data[0];
    let requester = data[1];
    let request_id = data[2];
    let wbp = data[3];
    let wbp_status = data[4];
    let rptp = data[5];
    let rptp_status = data[6];
    let cedula = data[7];
    let cedula_status = data[8];
    let ar = data[9];

    $('#mto_id_req').val(id);
    $('#mto_requester_req').val(requester);
    $('#mto_request_id_req').val(request_id);

    $('#mto_wbp_status').val(wbp_status);
    $('#mto_rptp_status').val(rptp_status);
    $('#mto_cedula_status').val(cedula_status);

    

    // Display PDFs sequentially with delays
    await displayPDFWithDelay('pdf-container_wbp_mto', wbp, 1000);
    await displayPDFWithDelay('pdf-container_rptp_mto', rptp, 2000);
    await displayPDFWithDelay('pdf-container_cedula_mto', cedula, 2000);
    await displayPDFWithDelay('pdf-container_ar_mto', ar, 2000);
   
};

const displayPDFWithDelay = (containerId, pdfPath, delay) => {
    return new Promise((resolve) => {
        setTimeout(() => {
            displayPDF(containerId, pdfPath);
            resolve();
        }, delay);
    });
};

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

const check_mto_req =() =>{
    let id = $('#mto_id_req').val();
    let requester = $('#mto_requester_req').val();
    let request_id = $('#mto_request_id_req').val();
    let wbp = $('#mto_wbp_status').val();
    let rptp = $('#mto_rptp_status').val();
    let cedula = $('#mto_cedula_status').val();

    $.ajax({
        url:'../../process/approver/mto.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_mto_req',
                    id:id,
                    requester:requester,
                    request_id:request_id,
                    wbp:wbp,
                    rptp:rptp,
                    cedula:cedula
                },success:function(response){
                  if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'successfully Checked',
                        text: 'Success',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    $('#mtocheck_req').modal('hide');
                    mto_search_req();
                  }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    $('#mtocheck_req').modal('hide');
                    mto_search_req();
                  }
                }
      });
}

const hide_modal =()=>{
  let id = $('#mto_id_req').val();
  $('#mto_assessment_id').val(id);
    $('#mtocheck_req').modal('hide');
}

const approved_mto =()=>{
   let id = $('#mto_id_req').val();
    
    $.ajax({
              url:'../../process/approver/mto.php',
                      type: 'POST',
                      cache: false,
                      data:{
                        method: 'approved_mto',
                          id:id
                      },success:function(response){
                        if (response == 'success') {
                          Swal.fire({
                              icon: 'success',
                              title: 'successfully Appproved',
                              text: 'Success',
                              showConfirmButton: false,
                              timer : 1000
                          });
                          $('#mtocheck_req').modal('hide');
                          mto_search_req();
                          //GET DATA FOR EMAIL
                          get_data();
                        }else{
                          Swal.fire({
                              icon: 'error',
                              title: 'Error',
                              text: 'Error',
                              showConfirmButton: false,
                              timer : 1000
                          });
                          $('#mtocheck_req').modal('hide');
                          mto_search_req();
                        }
                      }
    });
}

const issue_mto_assessment =()=> {
  let mto_fileContent = document.getElementById('mto_assessment_file');
  if (mto_fileContent.files.length > 0) {
    let file = mto_fileContent.files[0];

    // Create a FileReader to read the selected file
    let reader = new FileReader();

    // Define an event handler for when the file reading is done
    reader.onload = function (e) {
        // The result of the FileReader contains the base64 data URI
        let mto_fileContent = e.target.result;
        let id = $('#mto_assessment_id').val();
        let mto_file = mto_fileContent;
      $.ajax({
          url: '../../process/approver/mto.php',
          type: 'POST',
          cache: false,
          data: {
            method: 'mto_issue_assessment',
            id: id,
            mto_file: mto_file
          },success: function (response) {
            if (response == 'success') {
              Swal.fire({
                title: 'Successfully Submitted',
                icon: 'success',
                showConfirmButton: false,
                timer: 1000
              });
              $('#mto_assessment').modal('hide');
              mto_search_req();
            }else if(response == 'invalid'){
              Swal.fire({
                title: 'Please Check the Status of All Requirements',
                icon: 'info',
                showConfirmButton: false,
                timer: 1000
              });
              $('#mto_assessment').modal('hide');
              mto_search_req();
            }else {
              Swal.fire({
                title: 'Error',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
              });
              $('#mto_assessment').modal('hide');
              mto_search_req();
            }
          }
        });

    };
    // Read the selected file as a Data URL (base64)
    reader.readAsDataURL(file);
}else{
  Swal.fire({
      icon: 'info',
      title: 'Please Select Assessment File',
      text: 'info',
      showConfirmButton: false,
      timer: 1000
    });
}
}


</script>