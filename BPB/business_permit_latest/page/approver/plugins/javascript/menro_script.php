<script type="text/javascript">
$(function() {
    menro_search_req();
});
const menro_search_req =()=>{
    let requester = $('#menro_requester_search').val();
    let request_type = $('#menro_request_type_search').val();

    $('#spinner').css('display','block');
	$.ajax({
        url:'../../process/approver/menro.php',
                type: 'POST',
                cache: false,
                serverSide:true,
                data:{
                  method: 'menro_requirements',
                    requester:requester,
                    request_type:request_type
                },success:function(response){
                  $('#menro_check_req').html(response);
                  $('#spinner').fadeOut();
                }
  });
}

const get_menroreq_details = async (param)=>{
    let data = param.split('~!~');
    let id = data[0];
    let requester = data[1];
    let request_id = data[2];
    let rb = data[3];
    let f_status = data[4];

    $('#menro_id_req').val(id);
    $('#menro_requester_req').val(requester);
    $('#menro_request_id_req').val(request_id);

    $('#menro_rb_status').val(f_status);

    // Display PDFs sequentially with delays
    await displayPDFWithDelay('pdf-container_rb_menro', rb, 1000);
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


const get_email_data =()=>{
  var requester = $('#menro_requester_req').val();
  var request_id = $('#menro_request_id_req').val();
  send_email(requester,request_id,'','menro');
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


const approved_menro =()=>{
   let id = $('#menro_id_req').val();
    
    $.ajax({
              url:'../../process/approver/menro.php',
                      type: 'POST',
                      cache: false,
                      data:{
                        method: 'approved_menro',
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
                          $('#menrocheck_req').modal('hide');
                          menro_search_req();
                          get_email_data();
                        }else{
                          Swal.fire({
                              icon: 'error',
                              title: 'Error',
                              text: 'Error',
                              showConfirmButton: false,
                              timer : 1000
                          });
                          $('#menrocheck_req').modal('hide');
                          menro_search_req();
                        }
                      }
    });
}
</script>