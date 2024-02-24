<script type="text/javascript">
$(function() {
    bplo_search_req();
});

const get_email_data =()=>{
  var requester = $('#bplo_requester_req').val();
  var request_id = $('#bplo_request_id_req').val();
  send_email(requester,request_id,'','BPLO');
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
      // console.log(response);
      // if(response == 'Message has been sent'){
        send_sms(requester);
      // }
    }
  })
}

const send_sms =(requester)=>{
  $.ajax({
    url:'../../process/twilio_sms/index.php',
    type: 'POST',
    cache:false,
    data:{
      requester:requester
    },success:function(response){
      console.log(response);
    }
  })
}

const bplo_search_req =()=>{
    let requester = $('#bplo_requester_search').val();
    let request_type = $('#bplo_request_type_search').val();

    $('#spinner').css('display','block');
	$.ajax({
        url:'../../process/approver/bplo.php',
                type: 'POST',
                cache: false,
                serverSide:true,
                data:{
                  method: 'bplo_requirements',
                    requester:requester,
                    request_type:request_type
                },success:function(response){
                  $('#bplo_check_req').html(response);
                  $('#spinner').fadeOut();
                }
  });
}

const get_bploreq_details = async (param) => {
    let data = param.split('~!~');
    let id = data[0];
	let requester = data[1];
	let request_id = data[2];
	let cedula = data[3];
	let dti = data[4];
	let bbcor = data[5];
	let scc = data[6];
	let pic = data[7];
	let cedula_status = data[8];
	let dti_status = data[9];
	let bbcor_status = data[10];
	let scc_status = data[11];
	let pic_status = data[12];
    $('#bplo_id_req').val(id);
    $('#bplo_requester_req').val(requester);
    $('#bplo_request_id_req').val(request_id);
    $('#bplo_cedula_status').val(cedula_status);
    $('#bplo_dti_status').val(dti_status);
    $('#bplo_bbcor_status').val(bbcor_status);
    $('#bplo_scc_status').val(scc_status);
    $('#bplo_pic_status').val(pic_status);

//     // Display PDFs sequentially with delays
    await displayPDFWithDelay('pdf-container_cedula_bplo', cedula, 1000);
    await displayPDFWithDelay('pdf-container_dti_bplo', dti, 1000);
    await displayPDFWithDelay('pdf-container_bbcor_bplo', bbcor, 1000);
    await displayPDFWithDelay('pdf-container_scc_bplo', scc, 2000);
    await displayPDFWithDelay('pdf-container_pic_bplo', pic, 2000);
    

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


const check_bplo_req =()=>{
	let id = $('#bplo_id_req').val();
	let cedula_status = $('#bplo_cedula_status').val();
	let dti_status = $('#bplo_dti_status').val();
	let bbcor_status = $('#bplo_bbcor_status').val();
	let scc_status = $('#bplo_scc_status').val();
	let pic_status = $('#bplo_pic_status').val();
	if (cedula_status == '') {
		Swal.fire({
                title: 'Select Cedula Status',
                icon: 'info',
                showConfirmButton: false,
                timer: 1000
        });
	}else if(dti_status == ''){
		Swal.fire({
                title: 'Select DTI Status',
                icon: 'info',
                showConfirmButton: false,
                timer: 1000
        });
	}else if(bbcor_status == ''){
		Swal.fire({
                title: 'Select Brgy. Business Clearance & Official Receipt Status',
                icon: 'info',
                showConfirmButton: false,
                timer: 1000
        });
	}else if(scc_status == ''){
		Swal.fire({
                title: 'Select SSS Certificate of Compliance Status',
                icon: 'info',
                showConfirmButton: false,
                timer: 1000
        });
	}else if(pic_status == ''){
		Swal.fire({
                title: 'Select 2x2 Picture Status',
                icon: 'info',
                showConfirmButton: false,
                timer: 1000
        });
	}else{
	$.ajax({
        url:'../../process/approver/bplo.php',
                type: 'POST',
                cache: false,
                serverSide:true,
                data:{
                  method: 'check_bplo_req',
                    id:id,
					cedula_status:cedula_status,
					dti_status:dti_status,
					bbcor_status:bbcor_status,
					scc_status:scc_status,
					pic_status:pic_status
                },success:function(response){
                	console.log(response);
                  if (response == 'success') {
                  	Swal.fire({
		                title: 'Successfully Checked',
		                icon: 'success',
		                showConfirmButton: false,
		                timer: 1000
		              });
                  }else{
                  	Swal.fire({
	                title: 'Successfully Error',
	                icon: 'success',
	                showConfirmButton: false,
	                timer: 1000
	              });
                  }
                }
  });
	}
}

const hide_modal =()=>{
  let id = $('#bplo_id_req').val();

  $('#bplo_assessment_id').val(id);
  
    $('#bplocheck_req').modal('hide');
}

const bplo_issue_assessment =()=> {
  let bplo_fileContent = document.getElementById('bplo_bp_file_for_issue');
  if (bplo_fileContent.files.length > 0) {
    let file = bplo_fileContent.files[0];

    // Create a FileReader to read the selected file
    let reader = new FileReader();

    // Define an event handler for when the file reading is done
    reader.onload = function (e) {
        // The result of the FileReader contains the base64 data URI
        let bplo_fileContent = e.target.result;
        let id = $('#bplo_assessment_id').val();
        let bplo_file = bplo_fileContent;
      $.ajax({
          url: '../../process/approver/bplo.php',
          type: 'POST',
          cache: false,
          data: {
            method: 'bplo_issue_bp',
            id: id,
            bplo_file: bplo_file
          },success: function (response) {
            if (response == 'success') {
              Swal.fire({
                title: 'Successfully Submitted',
                icon: 'success',
                showConfirmButton: false,
                timer: 1000
              });
              $('#bplo_bp').modal('hide');
              bplo_search_req();
              get_email_data();
            }else if(response == 'invalid'){
              Swal.fire({
                title: 'Please Check the Status of All Requirements',
                icon: 'info',
                showConfirmButton: false,
                timer: 1000
              });
              $('#bplo_bp').modal('hide');
              bplo_search_req();
            }else {
              Swal.fire({
                title: 'Error',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
              });
              $('#bplo_bp').modal('hide');
              bplo_search_req();
            }
          }
        });

    };
    // Read the selected file as a Data URL (base64)
    reader.readAsDataURL(file);
}else{
  Swal.fire({
      icon: 'info',
      title: 'Please Select Business Permit File',
      text: 'info',
      showConfirmButton: false,
      timer: 1000
    });
}
}
</script>