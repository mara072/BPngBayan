<script type="text/javascript">
$(function(){
    search_account();
});


const search_account =()=>{
	$('#spinner').css('display','block');
	let username = document.getElementById('account_username_search').value;
	$.ajax({
        url:'../../process/admin/processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_account',
                    username:username
                },success:function(response){
                  document.getElementById('list_of_accounts').innerHTML = response;
                   $('#spinner').fadeOut();
                }
    });
}

const save_account =()=>{
	let fullname = $('#fullname').val();
	let username = $('#username').val();
	let password = $('#password').val();
	let role = $('#role').val();
	let dept = $('#dept').val();

	if (fullname == '') {
			Swal.fire({
	            icon: 'info',
	            title: 'Please Input Full Name !!!',
	            text: 'Information',
	            showConfirmButton: false,
	            timer : 1000
	        });
	}else if(username == ''){
			Swal.fire({
	            icon: 'info',
	            title: 'Please Input Username !!!',
	            text: 'Information',
	            showConfirmButton: false,
	            timer : 1000
	        });
	}else if(password == ''){
			Swal.fire({
	            icon: 'info',
	            title: 'Please Input Password !!!',
	            text: 'Information',
	            showConfirmButton: false,
	            timer : 1000
	        });
	}else if(role == ''){
			Swal.fire({
	            icon: 'info',
	            title: 'Please Select User Type !!!',
	            text: 'Information',
	            showConfirmButton: false,
	            timer : 1000
	        });
	}else{
		$.ajax({
	        url:'../../process/admin/processor.php',
	        type:'POST',
	        cache:false,
	        data:{
	            method:'add_account',
	            fullname:fullname,
				username:username,
				password:password,
				role:role,
				dept:dept
	        },success:function(response){    
	            console.log(response);
	            if (response == 'success') {
	                    Swal.fire({
	                      icon: 'success',
	                      title: 'Successfully Recorded!!!',
	                      text: 'Success',
	                      showConfirmButton: false,
	                      timer : 1000
	                    });
	                    $("#fullname").val('');
	          			$("#username").val('');
	          			$("#password").val('');
	          			$("#role").val('');
	          			$('#add_account').modal('hide');
	          			search_account();
	            }else{
	                    Swal.fire({
	                      icon: 'error',
	                      title: 'Error !!!',
	                      text: 'Error',
	                      showConfirmButton: false,
	                      timer : 1000
	                    });
	                    $("#fullname").val('');
	          			$("#username").val('');
	          			$("#password").val('');
	          			$("#role").val('');
	          			$('#add_account').modal('hide');
	          			search_account();       
	                }
	        }
	    });
	}
}

const get_account_details =(param)=>{
	let data = param.split('~!~');
    let id = data[0];
    let full_name = data[1];
    let username = data[2];
    let password = data[3];
    let role = data[4];
	let dept = data[5];
	let status = data[6];

    $('#id_account').val(id);
    $('#fullname_update').val(full_name);
	$('#username_update').val(username);
	$('#password_update').val(password);
	$('#role_update').val(role);
	$('#dept_update').val(dept);
	$('#status_update').val(status);
}

const update_account =()=>{
	let id = $('#id_account').val();
    let full_name = $('#fullname_update').val();
	let username = $('#username_update').val();
	let password = $('#password_update').val();
	let role = $('#role_update').val();
	let dept = $('#dept_update').val();
	let status = $('#status_update').val();
	
	if (fullname == '') {
			Swal.fire({
	            icon: 'info',
	            title: 'Please Input Full Name !!!',
	            text: 'Information',
	            showConfirmButton: false,
	            timer : 1000
	        });
	}else if(username == ''){
			Swal.fire({
	            icon: 'info',
	            title: 'Please Input Username !!!',
	            text: 'Information',
	            showConfirmButton: false,
	            timer : 1000
	        });
	}else if(password == ''){
			Swal.fire({
	            icon: 'info',
	            title: 'Please Input Password !!!',
	            text: 'Information',
	            showConfirmButton: false,
	            timer : 1000
	        });
	}else if(role == ''){
			Swal.fire({
	            icon: 'info',
	            title: 'Please Select User Type !!!',
	            text: 'Information',
	            showConfirmButton: false,
	            timer : 1000
	        });
	}else if(status == ''){
			Swal.fire({
	            icon: 'info',
	            title: 'Please Select Status !!!',
	            text: 'Information',
	            showConfirmButton: false,
	            timer : 1000
	        });
	}else{
		$.ajax({
	        url:'../../process/admin/processor.php',
	        type:'POST',
	        cache:false,
	        data:{
	            method:'update_account',
	            	id:id,
					full_name:full_name,
					username:username,
					password:password,
					role:role,
					dept:dept,
					status:status
	        },success:function(response){    
	            
	            if (response == 'success') {
	                    Swal.fire({
	                      icon: 'success',
	                      title: 'Successfully Updated !!!',
	                      text: 'Success',
	                      showConfirmButton: false,
	                      timer : 1000
	                    });
	          			$('#edit_account').modal('hide');
	          			search_account();
	            }else if(response == 'duplicate'){
	                     Swal.fire({
	                      icon: 'info',
	                      title: 'Duplicate Data !!!',
	                      text: 'Information',
	                      showConfirmButton: false,
	                      timer : 1000
	                    });
	                   $('#edit_account').modal('hide');
	          		   search_account();
	            }else{
	                    Swal.fire({
	                      icon: 'error',
	                      title: 'Error !!!',
	                      text: 'Error',
	                      showConfirmButton: false,
	                      timer : 1000
	                    });
	                    $('#edit_account').modal('hide');
	          			search_account();        
	                }
	        }
	    });
	}
}

const delete_account =()=>{
	let id = $('#id_account').val();
	$.ajax({
	        url:'../../process/admin/processor.php',
	        type:'POST',
	        cache:false,
	        data:{
	            method:'delete_account',
	            	id:id
	        },success:function(response){    
	            
	            if (response == 'success') {
	                    Swal.fire({
	                      icon: 'info',
	                      title: 'Successfully Deleted !!!',
	                      text: 'Information',
	                      showConfirmButton: false,
	                      timer : 1000
	                    });
	          			$('#edit_account').modal('hide');
	          			search_account(); 
	            }else{
	                    Swal.fire({
	                      icon: 'error',
	                      title: 'Error !!!',
	                      text: 'Error',
	                      showConfirmButton: false,
	                      timer : 1000
	                    });
	          			$('#edit_account').modal('hide');
	          			search_account();           
	                }
	        }
	    });
}
</script>