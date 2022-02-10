					function sAlert(message,loca){
						swal({
							icon: "success",
							title: "Success!",
							text: message,
							showConfirmButton: false,
							timer: 3000
						}).then(function() {
							if(loca!="")
								window.location =loca;
							});
					}
					
					function fAlert(message){
						swal({
							icon: 'error',
							title: 'Oops...',
							text: message,
							showConfirmButton: false,
							timer: 3000
						});
					}
					
					function logout(){
						swal({
							icon: "info",
							  title: "Are you sure?",
							  text: "You will be logging out?",
							  buttons: [
								'No, cancel it!',
								'Yes, I am sure!'
							  ],
							  dangerMode: true,
							}).then(function(isConfirm) {
							  if (isConfirm) {
								swal({
								  title: 'System Message!',
								  text: 'Logging out!',
								  icon: 'success',
								}).then(function() {
								  window.location ="./logout";
								});
							  } 
							});
					}