<script type="text/javascript">
$(function() {
    mpdc_search_req();
});
const mpdc_search_req =()=>{
    let requester = $('#mpdc_requester_search').val();
    let request_type = $('#mpdc_request_type_search').val();

    $('#spinner').css('display','block');
	$.ajax({
        url:'../../process/approver/mpdc.php',
                type: 'POST',
                cache: false,
                serverSide:true,
                data:{
                  method: 'mpdc_requirements',
                    requester:requester,
                    request_type:request_type
                },success:function(response){
                  $('#mpdc_check_req').html(response);
                  $('#spinner').fadeOut();
                }
  });
}

const get_req_details = async (param) => {
    let data = param.split('~!~');
    let id = data[0];
    let requester = data[1];
    let request_id = data[2];
    let applicant_name = data[3];
    let applicant_address = data[4];
    let owner = data[5];
    let title_no = data[6];
    let td_no = data[7];
    let pin = data[8];
    let total_area = data[9];
    let location_lot = data[10];
    let rol = data[11];
    let sign_applicant = data[12];
    let sign_owner = data[13];
    let tct = data[14];
    let tct_status = data[15];
    let dti = data[16];
    let dti_status = data[17];
    let bcr = data[18];
    let bcr_status = data[19];
    let csl = data[20];
    let csl_status = data[21];
    let mc = data[22];
    let mc_status = data[23];
    let dpwh = data[24];
    let dpwh_status = data[25];
    let op = data[26];
    let op_status = data[27];
    let pbp = data[28];
    let pbp_status = data[29];
    let gs = data[30];
    let gs_status = data[31];
    let bp = data[32];
    let bp_status = data[33];
    let assessment_receipt = data[34];

    $('#mpdc_id_req').val(id);
    $('#mpdc_requester_req').val(requester);
    $('#mpdc_request_id_req').val(request_id);
    $('#applicant_name_mpdc').val(applicant_name);
    $('#applicant_address_mpdc').val(applicant_address);
    $('#owner_mpdc').val(owner);
    $('#title_no_mpdc').val(title_no);
    $('#td_no_mpdc').val(td_no);
    $('#pin_mpdc').val(pin);
    $('#total_area_mpdc').val(total_area);
    $('#location_lot_mpdc').val(location_lot);
    $('#rol_mpdc').val(rol);


$('#preview_signature_applicant').attr('src', 'data:image/png;base64,' + sign_applicant);
$('#preview_signature_owner').attr('src', 'data:image/png;base64,' + sign_owner);

    $('#mpdc_tct_status').val(tct_status);
    $('#mpdc_dti_status').val(dti_status);
    $('#mpdc_bbcwr_status').val(bcr_status);
    $('#mpdc_cosl_status').val(csl_status);
    $('#mpdc_mc_status').val(mc_status);
    $('#mpdc_dpwh_status').val(dpwh_status);
    $('#mpdc_op_status').val(op_status);
    $('#mpdc_pobp_status').val(pbp_status);
    $('#mpdc_gs_status').val(gs_status);
    $('#mpdc_bp_status').val(bp_status);

    // Display PDFs sequentially with delays
    await displayPDFWithDelay('pdf-container_tct', tct, 1000);
    await displayPDFWithDelay('pdf-container_dti_sec', dti, 2000);
    await displayPDFWithDelay('pdf-container_bbcwr', bcr, 2000);
    await displayPDFWithDelay('pdf-container_cosl', csl, 2000);
    await displayPDFWithDelay('pdf-container_mc', mc, 2000);
    await displayPDFWithDelay('pdf-container_dpwh', dpwh, 2000);
    await displayPDFWithDelay('pdf-container_op', op, 2000);
    await displayPDFWithDelay('pdf-container_pobp', pbp, 2000);
    await displayPDFWithDelay('pdf-container_gs', gs, 2000);
    await displayPDFWithDelay('pdf-container_bp', bp, 2000);
    await displayPDFWithDelay('pdf-container_ar', assessment_receipt, 2000);
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

const check_mpdc_req =() =>{
    let id = $('#mpdc_id_req').val();
    let requester = $('#mpdc_requester_req').val();
    let request_id = $('#mpdc_request_id_req').val();
    let tct_status = $('#mpdc_tct_status').val();
    let dti_status = $('#mpdc_dti_status').val();
    let bcr_status = $('#mpdc_bbcwr_status').val();
    let csl_status = $('#mpdc_cosl_status').val();
    let mc_status = $('#mpdc_mc_status').val();
    let dpwh_status = $('#mpdc_dpwh_status').val();
    let op_status = $('#mpdc_op_status').val();
    let pbp_status = $('#mpdc_pobp_status').val();
    let gs_status = $('#mpdc_gs_status').val();
    let bp_status = $('#mpdc_bp_status').val();

    $.ajax({
        url:'../../process/approver/mpdc.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_mpdc_req',
                    id:id,
                    requester:requester,
                    request_id:request_id,
                    tct_status:tct_status,
                    dti_status:dti_status,
                    bcr_status:bcr_status,
                    csl_status:csl_status,
                    mc_status:mc_status,
                    dpwh_status:dpwh_status,
                    op_status:op_status,
                    pbp_status:pbp_status,
                    gs_status:gs_status,
                    bp_status:bp_status
                },success:function(response){
                  if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'successfully Checked',
                        text: 'Success',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    $('#check_req').modal('hide');
                    mpdc_search_req();
                  }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    $('#check_req').modal('hide');
                    mpdc_search_req();
                  }
                }
  });
} 

const hide_modal =()=>{
  let id = $('#mpdc_id_req').val();
  let applicant_name = $('#applicant_name_mpdc').val();

  $('#mpdc_assessment_id').val(id);
  $('#mpdc_requester_req').val(applicant_name);
  
    $('#check_req').modal('hide');
}

const issuance_olp =()=>{
    let id = $('#mpdc_id_req').val();
    let requester = $('#mpdc_requester_req').val();
    let request_id = $('#mpdc_request_id_req').val();
    let applicant_name = $('#applicant_name_mpdc').val();

    window.open('issuance_olp.php?id='+id+'&&requester='+requester+'&&request_id='+request_id+'&&applicant_name='+applicant_name);
}

const mpdc_issue_assessment =()=> {
  let mpdc_fileContent = document.getElementById('mpdc_assessment_file_for_issue');

  if (mpdc_fileContent.files.length > 0) {
    let file = mpdc_fileContent.files[0];

    // Create a FileReader to read the selected file
    let reader = new FileReader();

    // Define an event handler for when the file reading is done
    reader.onload = function (e) {
        // The result of the FileReader contains the base64 data URI
        let mpdc_fileContent = e.target.result;
        let id = $('#mpdc_assessment_id').val();
        let mpdc_file = mpdc_fileContent;
      $.ajax({
          url: '../../process/approver/mpdc.php',
          type: 'POST',
          cache: false,
          data: {
            method: 'mpdc_issue_assessment',
            id: id,
            mpdc_file: mpdc_file
          },success: function (response) {
            if (response == 'success') {
              Swal.fire({
                title: 'Successfully Submitted',
                icon: 'success',
                showConfirmButton: false,
                timer: 1000
              });
              $('#').modal('hide');
            }else if(response == 'invalid'){
              Swal.fire({
                title: 'Please Check the Status of All Requirements',
                icon: 'info',
                showConfirmButton: false,
                timer: 1000
              });
              $('#').modal('hide');
            }else {
              Swal.fire({
                title: 'Error',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
              });
              $('#').modal('hide');
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