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
                }
    });  
}

const check_status =()=>{
   let requester = '<?=$uname;?>';
   let req_id = $('#req_id_ref').val();
   $.ajax({
        url:'../../process/user/menro.php',
                type: 'POST',
                cache: false,
                data:{ 
                  method: 'check_status',
                  requester:requester,
                  req_id:req_id
                },success:function(response){
                  let f_status = response;
                  $('#rb_status').val(f_status);
                  if (f_status == 'Approved') {
                    document.getElementById('rb_file').style.display = 'none';
                  }else{
                    document.getElementById('rb_file').style.display = 'block';
                  }
                  
                }
    }); 
}

const submit_menro_reqs =()=>{
    let recycle_bin = document.getElementById('rb_file');

    if (recycle_bin.files.length > 0) {
    let file = recycle_bin.files[0];

    // Create a FileReader to read the selected file
    let reader = new FileReader();

    // Define an event handler for when the file reading is done
    reader.onload = function (e) {
        // The result of the FileReader contains the base64 data URI
        let recycle_bin = e.target.result;
         
    let req_id_ref = $('#req_id_ref').val();
    let requester = '<?=$uname;?>';
    let recycle_bin_file = recycle_bin;
      $.ajax({
          url: '../../process/user/menro.php',
          type: 'POST',
          cache: false,
          data: {
            method: 'submit_menro_req',
            req_id_ref: req_id_ref,
            requester:requester,
            recycle_bin_file: recycle_bin_file
          },success: function (response) {
            console.log(response);
            if (response == 'success') {
              Swal.fire({
                title: 'Successfully Submitted',
                icon: 'success',
                showConfirmButton: false,
                timer: 1000
              });
            }else if (response == 'update') {
              Swal.fire({
                title: 'Successfully Updated',
                icon: 'success',
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
  Swal.fire({
      icon: 'info',
      title: 'Please Select Recycle Bin File',
      text: 'info',
      showConfirmButton: false,
      timer: 1000
    });
}
}
</script>