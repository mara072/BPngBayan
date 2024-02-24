<script type="text/javascript">
$(function() {
req_tracking();
});

const req_tracking =()=>{
    let requester = '<?=$uname;?>';
    $.ajax({
        url:'../../process/user/req_tracking.php',
                type: 'POST',
                cache: false,
                data:{
                  method: 'req_tracking',
                  requester:requester
                },success:function(response){
                    // console.log(response);
                  $('#req_tracking').html(response);
                }
    });  
}

const renew_this_request =(req_id)=> {
  // console.log(id);
  let requester = '<?=$uname;?>';
  $.ajax({
    url:'../../process/user/req_tracking.php',
    type:'POST',
    cache:false,
    data:{
      method:'renew_function',
      req_id:req_id, 
      requester:requester
    },success:function(response){
      // console.log(response);
      if(response == 'success'){
        Swal.fire({
                    title: 'Renewal Request successfully submitted, and history generated.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1000
                  });
      }else{
        Swal.fire({
                    title: 'Failed please try again.',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000
                  });
      }
    }
  })
}

const preview_qr=(code)=>{
  // console.log(code)
  window.open("preview_qr.php?code="+code, "_blank")
}
</script>