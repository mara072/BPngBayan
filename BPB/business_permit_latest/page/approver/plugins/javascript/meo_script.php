<script type="text/javascript">
$(function() {
    meo_search_req();
}); 
const meo_search_req =()=>{
    let requester = $('#meo_requester_search').val();
    let request_type = $('#meo_request_type_search').val();

    $('#spinner').css('display','block');
	$.ajax({
        url:'../../process/approver/meo.php',
                type: 'POST',
                cache: false,
                serverSide:true,
                data:{
                  method: 'meo_requirements',
                    requester:requester,
                    request_type:request_type
                },success:function(response){
                  $('#meo_check_req').html(response);
                  $('#spinner').fadeOut();
                }
  });
}

const get_email_data =()=>{
  var requester = $('#meo_requester_req').val();
  var request_id = $('#meo_request_id_req').val();
  send_email(requester,request_id,'','MEO');
}

//SENDS THE EMAIL 
const send_email =(requester,request_id,applicant_name,dept_sender)=>{
  
  console.log(requester)
  console.log(request_id)
  console.log(applicant_name)
  console.log(dept_sender)
  
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

const get_meoreq_details = async (param)=>{
    let data = param.split('~!~');
    let id = data[0];
    let requester = data[1];
    let request_id = data[2];
    let op = data[3];
    let bp = data[4];
    let op_status = data[5];
    let bp_status = data[6];

    $('#meo_id_req').val(id);
    $('#meo_requester_req').val(requester);
    $('#meo_request_id_req').val(request_id);

    $('#meo_op_status').val(op_status);
    $('#meo_bp_status').val(bp_status);

    // Display PDFs sequentially with delays
    await displayPDFWithDelay('pdf-container_ob_meo', op, 1000);
    await displayPDFWithDelay('pdf-container_bp_meo', bp, 1000);
}

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

const check_meo =()=>{
   let id = $('#meo_id_req').val();
   let op_status = $('#meo_op_status').val();
   let bp_status = $('#meo_bp_status').val();
    $.ajax({
              url:'../../process/approver/meo.php',
                      type: 'POST',
                      cache: false,
                      data:{
                        method: 'approved_meo',
                          id:id,
                          op_status:op_status,
                          bp_status:bp_status
                      },success:function(response){
                        if (response == 'success') {
                          Swal.fire({
                              icon: 'success',
                              title: 'successfully Appproved',
                              text: 'Success',
                              showConfirmButton: false,
                              timer : 1000
                          });
                          $('#meocheck_req').modal('hide');
                          meo_search_req();
                          get_email_data();
                        }else if (response == 'checked') {
                          Swal.fire({
                              icon: 'info',
                              title: 'Successfully Checked',
                              text: 'Information',
                              showConfirmButton: false,
                              timer : 1000
                          });
                          $('#meocheck_req').modal('hide');
                          meo_search_req();
                        }else{
                          Swal.fire({
                              icon: 'error',
                              title: 'Error',
                              text: 'Error',
                              showConfirmButton: false,
                              timer : 1000
                          });
                          $('#meocheck_req').modal('hide');
                          meo_search_req();
                        }
                      }
    });
}
</script>