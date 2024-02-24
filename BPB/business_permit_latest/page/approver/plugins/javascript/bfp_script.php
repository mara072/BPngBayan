<script type="text/javascript">
$(function() {
    bfp_search_req();
});
const bfp_search_req =()=>{
    let requester = $('#bfp_requester_search').val();
    let request_type = $('#bfp_request_type_search').val();

    $('#spinner').css('display','block');
	$.ajax({
        url:'../../process/approver/bfp.php',
                type: 'POST',
                cache: false,
                serverSide:true,
                data:{
                  method: 'bfp_requirements',
                    requester:requester,
                    request_type:request_type
                },success:function(response){
                  $('#bfp_check_req').html(response);
                  $('#spinner').fadeOut();
                }
  });
}

const get_bfpreq_details = async (param) => {
    let data = param.split('~!~');
    let id = data[0];
    let requester = data[1];
    let request_id = data[2];
    let owner = data[3];
    let exact_address = data[4];
    let bfsben = data[5];
    let authorized_rep = data[6];
    let tobn = data[7];
    let tfa = data[8];
    let storey_no = data[9];
    let email_address = data[10];
    let contact_no = data[11];
    let owner_sign = data[12];
    let fire_ex_receipt = data[13];
    let fer_status = data[14];
    let building_permit = data[15];
    let bp_status = data[16];
    let fsca = data[17];
    let fsca_status = data[18];
    let arr = data[19];
    let arr_status = data[20];
    let occupancy_permit = data[21];
    let op_status = data[22];
    let pob = data[23];
    let pob_status = data[24];
    let fcp = data[25];
    let fcp_status = data[26];
    $('#bfp_id_req').val(id);
    $('#bfp_requester_req').val(requester);
    $('#bfp_request_id_req').val(request_id);
    $('#bfp_owner_name').val(owner);
    $('#bfp_bfsbe').val(bfsben);
    $('#bfp_address').val(exact_address);
    $('#bfp_ar').val(authorized_rep);
    $('#bfp_tobn').val(tobn);
    $('#bfp_tfa').val(tfa);
    $('#bfp_nos').val(storey_no);
    $('#bfp_contact_no').val(contact_no);
    $('#bfp_email').val(email_address);
   


$('#preview_soar').attr('src', 'data:image/png;base64,' + owner_sign);

    $('#bfp_fer_status').val(fer_status);
    $('#bfp_bp_status').val(bp_status);
    $('#bfp_op_status').val(op_status);
    $('#bfp_fscaf_status').val(fsca_status);
    $('#bfp_arwr_status').val(arr_status);
    $('#bfp_pob_status').val(pob_status);
    $('#bfp_fcp_status').val(fcp_status);

//     // Display PDFs sequentially with delays
    await displayPDFWithDelay('pdf-container_fer_bfp', fire_ex_receipt, 1000);
    await displayPDFWithDelay('pdf-container_bp_bfp', building_permit, 1000);
    await displayPDFWithDelay('pdf-container_op_bfp', occupancy_permit, 1000);
    await displayPDFWithDelay('pdf-container_fscaf_bfp', fsca, 2000);
    await displayPDFWithDelay('pdf-container_arwr_bfp', arr, 2000);
    await displayPDFWithDelay('pdf-container_pob_bfp', pob, 2000);
    await displayPDFWithDelay('pdf-container_fcp_bfp', fcp, 2000);
    

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

const check_bfp_req =() =>{
    let id = $('#bfp_id_req').val();
    let requester = $('#bfp_requester_req').val();
    let request_id = $('#bfp_request_id_req').val();
    let fer_status = $('#bfp_fer_status').val();
    let bp_status = $('#bfp_bp_status').val();
    let fsca_status = $('#bfp_fscaf_status').val();
    let arr_status = $('#bfp_arwr_status').val();
    let op_status = $('#bfp_op_status').val();
    let pob_status = $('#bfp_pob_status').val();
    let fcp_status = $('#bfp_fcp_status').val();
    $.ajax({
        url:'../../process/approver/bfp.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_bfp_req',
                    id:id,
                    requester:requester,
                    request_id:request_id,
                    fer_status:fer_status,
                    bp_status:bp_status,
                    fsca_status:fsca_status,
                    arr_status:arr_status,
                    op_status:op_status,
                    pob_status:pob_status,
                    fcp_status:fcp_status
                },success:function(response){
                  console.log(response);
                  if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'successfully Checked',
                        text: 'Success',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    $('#bfpcheck_req').modal('hide');
                    bfp_search_req();
                  }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    $('#bfpcheck_req').modal('hide');
                    bfp_search_req();
                  }
                }
  });
}

const hide_modal =()=>{
  let id = $('#bfp_id_req').val();
  let applicant_name = $('#applicant_name_bfp').val();
  console.log(applicant_name);
  $('#bfp_assessment_id').val(id);
  $('#bfp_requester_req').val(applicant_name);
  
    $('#bfpcheck_req').modal('hide');
}

const fsic_modal =()=>{
  let id = $('#bfp_id_req').val();
  let applicant_name = $('#applicant_name_bfp').val();
  console.log(applicant_name);
  $('#bfp_fsic_id').val(id);
  $('#bfp_requester_req').val(applicant_name);
  
    $('#bfpcheck_req').modal('hide');
}
</script>