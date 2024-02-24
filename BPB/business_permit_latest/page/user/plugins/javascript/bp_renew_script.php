<script type="text/javascript">
$(function() {
    check_req_id();
    setTimeout(load_history,1000);
}); 

const check_req_id =()=>{
    let requester = '<?=$uname;?>';
    $.ajax({
        url:'../../process/user/req_id.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'check_req_id_renewal',
                  requester:requester
                },success:function(response){
                  $('#req_id').html(response);
                  $('#req_id_ref').val(response);
                }
    });  
}

 const submit_renewal_req =()=> {
    

  let renewal_lp_fileContent = document.getElementById('renewal_lp');

  if (renewal_lp_fileContent.files.length > 0) {
    let file = renewal_lp_fileContent.files[0];

    // Create a FileReader to read the selected file
    let reader = new FileReader();

    // Define an event handler for when the file reading is done
    reader.onload = function (e) {
        // The result of the FileReader contains the base64 data URI
        let renewal_lp_fileContent = e.target.result;
        let requester = $('#requester_renewal').val();
         let req_id_ref = $('#req_id_ref').val();
        let renewal_lp = renewal_lp_fileContent;
     
      $.ajax({
          url: '../../process/user/req_id.php',
          type: 'POST',
          cache: false,
          data: {
            method: 'submit_renewal_req',
            requester: requester,
            req_id_ref:req_id_ref,
            renewal_lp: renewal_lp
          },success: function (response) {
            console.log(response);
            if (response == 'success') {
              Swal.fire({
                title: 'Successfully Submitted',
                icon: 'success',
                showConfirmButton: false,
                timer: 1000
              });
            }else if(response == 'invalid'){
              Swal.fire({
                title: 'No Existing Business Permit for Renewal',
                icon: 'info',
                showConfirmButton: false,
                timer: 1000
              });
            }else {
              Swal.fire({
                title: 'Error',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
              });
            }
          }
        });

    };
    // Read the selected file as a Data URL (base64)
    reader.readAsDataURL(file);
}else{
  // Swal.fire({
  //     icon: 'info',
  //     title: 'Please Select Localtional Permit File',
  //     text: 'info',
  //     showConfirmButton: false,
  //     timer: 1000
  //   });
}
}




const load_history =()=>{
  let requester = '<?=$uname;?>';
  $.ajax({
    url:'../../process/user/req_tracking.php',
    type: 'POST',
    cache:false,
    data:{
      method: 'view_history',
      requester:requester 
    },success:function(response){
      // console.log(response)
      $('#table_history').html(response);
    }
  })
}
</script>