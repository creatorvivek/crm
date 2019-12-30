<div class="col-md-5">
	<!-- <div class="card card-primary"> -->

		<!-- /.card-header -->
		<!-- <div class="card-body"> -->


			<div class="post">
				<!-- action="<?= base_url() ?>profile/changePassword" -->
				<!-- <form> -->
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Enter Password</label>
							<input type="password" class="form-control" id="password"  placeholder="Enter current password" required >
						</div>
						<div id="error_dbmatch" style="color:red"></div>
						<div class="form-group">
							<label for="exampleInputPassword1">New Password</label>
							<input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password" required>
						</div>
						<div id="error" style="color:red"></div>
						<div class="form-group">
							<label for="exampleInputPassword1">Confirm Password</label>
							<input type="password" class="form-control" id="cpassword" placeholder="Confirm Password"  required>
						</div>
						<div id="error_match" style="color:red"></div>
						<!-- <input type="hidden" name="user_id" value="<?= $userdata->auth_id ?>"> -->


					</div>
					<!-- /.card-body -->

					<div class="card-footers">
						<button type="submit" class="btn btn-primary submitpassword">Submit</button>
					</div>
					<!-- </form> -->
					<div id="successpw" style="color:green"></div>



				</div>


				<!-- </div> -->
				<!-- /.card-body -->
				<!-- </div> --><!-- /.card -->


			</div><!-- /col -->
			<script type="text/javascript">
				var staff_id="<?= $this->session->staff_id ?>";
				$(".submitpassword").click(function(event) {
					event.preventDefault();
					var password = $('#password').val();
					var newpassword = $('#newpassword').val();
					var cpassword = $('#cpassword').val();
					$.ajax({
						method: "POST",
						url:" <?= base_url() ?>admin/checkPassword", 
						data: {
							password:password,staff_id:staff_id
						},
						success: function(responseObject) {
     			  console.log(responseObject);	
     			  var obj=JSON.parse(responseObject); 
     			  console.log(obj);
      // console.log(obj);
      if(password=='')
      {
      	$('#error_dbmatch').html("password cannot be empty");
      }
      else if(obj.length==0)
      {
      	$('#error_dbmatch').html("please write correct password");
      }
      else if(newpassword=='' || newpassword== null)
      {
      	$('#error').html("Password field cannot be empty");
      }
      else if(obj!=password)
      {
      	$('#error_dbmatch').html("please write correct password");
      }
      else if(newpassword!=cpassword)
      {
          // var msg="please fill all the field";
          $('#error_match').html("new password and confirm should be same");

          // $('#error_username').show();

      }
      else
      {
      	$.ajax({
      		method: "POST",
      		url:" <?= base_url() ?>admin/changePassword", 
      		data: {
      			newpassword:newpassword,caf_id:caf_id
      		},
      		success: function(response) {
      			if(response=='success')
      			{
      				$('#successpw').html("Your password is successfully changed");
      				$('#error_dbmatch').hide();
      				$('#error_match').hide();
      				$('#error').hide();
      				$('#password').val('');
      				$('#nepassword').val('');
      				$('#cpassword').val('');
      			}
      			else
      			{
      				$('#successpw').html("Your password is not updated");
      			}


      		}
      	});
      }
  }
});
				});






			</script>