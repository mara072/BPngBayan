<script type="text/javascript">
$(function() {
    sanidad_search_req();
});
const sanidad_search_req =()=>{
    let requester = $('#sanidad_requester_search').val();
    let request_type = $('#sanidad_request_type_search').val();

    $('#spinner').css('display','block');
	$.ajax({
        url:'../../process/approver/sanidad.php',
                type: 'POST',
                cache: false,
                serverSide:true,
                data:{
                  method: 'sanidad_requirements',
                    requester:requester,
                    request_type:request_type
                },success:function(response){
                  $('#sanidad_check_req').html(response);
                  $('#spinner').fadeOut();
                }
  });
}

const get_sanidadreq_details = async (param)=>{
    let data = param.split('~!~');
    let id = data[0];
    let requester = data[1];
    let request_id = data[2];
    let fecalysis = data[3];
    let fecalysis_status = data[4];
    let urinalysis = data[5];
    let urinalysis_status = data[6];
    let chest_xray = data[7];
    let chest_xray_status = data[8];
    let drug_test = data[9];
    let drug_test_status = data[10];
    let sanitary_permit = data[11];

    $('#sanidad_id_req').val(id);
    $('#sanidad_requester_req').val(requester);
    $('#sanidad_request_id_req').val(request_id);

    $('#sanidad_fecalysis_status').val(fecalysis_status);
    $('#sanidad_urinalysis_status').val(urinalysis_status);
    $('#sanidad_xray_status').val(chest_xray_status);
    $('#sanidad_dt_status').val(drug_test_status);

    // Display PDFs sequentially with delays
    await displayPDFWithDelay('pdf-container_fecalysis_sanidad', fecalysis, 1000);
    await displayPDFWithDelay('pdf-container_urinalysis_sanidad', urinalysis, 2000);
    await displayPDFWithDelay('pdf-container_xray_sanidad', chest_xray, 2000);
    await displayPDFWithDelay('pdf-container_dt_sanidad', drug_test, 2000);
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

const check_sanidad_req =() =>{
    let id = $('#sanidad_id_req').val();
    let requester = $('#sanidad_requester_req').val();
    let request_id = $('#sanidad_request_id_req').val();
    let fecalysis = $('#sanidad_fecalysis_status').val();
    let urinalysis = $('#sanidad_urinalysis_status').val();
    let chest_xray = $('#sanidad_xray_status').val();
    let drug_test = $('#sanidad_dt_status').val();

    $.ajax({
        url:'../../process/approver/sanidad.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_sanidad_req',
                    id:id,
                    requester:requester,
                    request_id:request_id,
                    fecalysis:fecalysis,
                    urinalysis:urinalysis,
                    chest_xray:chest_xray,
                    drug_test:drug_test
                },success:function(response){
                  if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'successfully Checked',
                        text: 'Success',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    $('#sanidadcheck_req').modal('hide');
                    sanidad_search_req();
                  }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    $('#sanidadcheck_req').modal('hide');
                    sanidad_search_req();
                  }
                }
      });
}

const hide_modal =()=>{
  let id = $('#sanidad_id_req').val();
  $('#sanidad_assessment_id').val(id);
    $('#sanidadcheck_req').modal('hide');

}

const get_email_data =()=>{
  var requester = $('#sanidad_requester_req').val();
  var request_id = $('#sanidad_request_id_req').val();
  send_email(requester,request_id,'','sanidad');
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

const issue_sanitary_permit =()=>{
     let sanidad_fileContent = document.getElementById('sanitary_permit_file');
  if (sanidad_fileContent.files.length > 0) {
    let file = sanidad_fileContent.files[0];

    // Create a FileReader to read the selected file
    let reader = new FileReader();

    // Define an event handler for when the file reading is done
    reader.onload = function (e) {
        // The result of the FileReader contains the base64 data URI
        let sanidad_fileContent = e.target.result;
        let id = $('#sanidad_assessment_id').val();
        let sanidadfile = sanidad_fileContent;
      $.ajax({
          url: '../../process/approver/sanidad.php',
          type: 'POST',
          cache: false,
          data: {
            method: 'sanidad_issue_assessment',
            id: id,
            sanidadfile: sanidadfile
          },success: function (response) {
            console.log(response);
            if (response == 'success') {
              Swal.fire({
                title: 'Successfully Submitted',
                icon: 'success',
                showConfirmButton: false,
                timer: 1000
              });
              $('#sanidad_assessment').modal('hide');
              sanidad_search_req();
              //get email data and send notif
              get_email_data();
            }else if(response == 'invalid'){
              Swal.fire({
                title: 'Please Check the Status of All Requirements',
                icon: 'info',
                showConfirmButton: false,
                timer: 1000
              });
              $('#sanidad_assessment').modal('hide');
              sanidad_search_req();
            }else {
              Swal.fire({
                title: 'Error',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
              });
              $('#sanidad_assessment').modal('hide');
              sanidad_search_req();
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