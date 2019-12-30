
      



<div class="row clearfix">
    <div class="col-xs-12 col-sm-3">
        <div class="card profile-card">
            <div class="profile-header">&nbsp;</div>
            <div class="profile-body">
                <div class="image-area">
                    <img src="<?= base_url() ?>uploads/<?= isset($this->session->profile_image) ? $this->session->profile_image : 'user.png' ?>" alt="Profile Image" width="48" height="48"  />
                </div>
                <div class="content-area">
                    <h3 class="u_name"></h3>
                    <!-- <p>Web Software Developer</p> -->
                    <p id="auth_type"></p>
                </div>
            </div>
            <div class="profile-footer">
                <ul>
                    <li>
                        <span>USERNAME</span>
                        <span class="u_username"></span>
                    </li>
                               <!--  <li>
                                    <span>Following</span>
                                    <span>1.201</span>
                                </li>
                                <li>
                                    <span>Friends</span>
                                    <span>14.252</span>
                                </li> -->
                            </ul>
                            <!-- <button class="btn btn-primary btn-lg waves-effect btn-block">FOLLOW</button> -->
                        </div>
                    </div>

                 <!--    <div class="card card-about-me">
                        <div class="header">
                            <h2>ABOUT ME</h2>
                        </div>
                        <div class="body">
                            <ul>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">library_books</i>
                                        Education
                                    </div>
                                    <div class="content">
                                        B.S. in Computer Science from the University of Tennessee at Knoxville
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">location_on</i>
                                        Location
                                    </div>
                                    <div class="content">
                                        Malibu, California
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">edit</i>
                                        Skills
                                    </div>
                                    <div class="content">
                                        <span class="label bg-red">UI Design</span>
                                        <span class="label bg-teal">JavaScript</span>
                                        <span class="label bg-blue">PHP</span>
                                        <span class="label bg-amber">Node.js</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">notes</i>
                                        Description
                                    </div>
                                    <div class="content">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                </div>
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div class="body">
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li> -->
                                    <li role="presentation"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                                    <li role="presentation"><a href="#change_username_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Username</a></li>
                                    <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
                                    <li role="presentation"><a href="#profile_picture" aria-controls="profile_picture" role="tab" data-toggle="tab">Change Profile Picture</a></li>
                                </ul>

                                <div class="tab-content">
                                 <!--    <div role="tabpanel" class="tab-pane fade in " id="home">
                                        <div class="panel panel-default panel-post">
                                            <div class="panel-heading">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img src="../../images/user-lg.jpg" />
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            <a href="#">Marc K. Hammond</a>
                                                        </h4>
                                                        Shared publicly - 26 Oct 2018
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="post">
                                                    <div class="post-heading">
                                                        <p>I am a very simple wall post. I am good at containing <a href="#">#small</a> bits of <a href="#">#information</a>. I require little more information to use effectively.</p>
                                                    </div>
                                                    <div class="post-content">
                                                        <img src="<?= base_url() ?>assets/admin/images/profile-post-image.jpg" class="img-responsive" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">thumb_up</i>
                                                            <span>12 Likes</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">comment</i>
                                                            <span>5 Comments</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">share</i>
                                                            <span>Share</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" placeholder="Type a comment" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default panel-post">
                                            <div class="panel-heading">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img src="<?= base_url() ?>assets/admin/images/user-lg.jpg" />
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            <a href="#">Marc K. Hammond</a>
                                                        </h4>
                                                        Shared publicly - 01 Oct 2018
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="post">
                                                    <div class="post-heading">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                    </div>
                                                    <div class="post-content">
                                                        <iframe width="100%" height="360" src="https://www.youtube.com/embed/10r9ozshGVE" frameborder="0" allowfullscreen=""></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">thumb_up</i>
                                                            <span>125 Likes</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">comment</i>
                                                            <span>8 Comments</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">share</i>
                                                            <span>Share</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" placeholder="Type a comment" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div role="tabpanel" class="tab-pane fade in active" id="profile_settings">
                                        <form class="form-horizontal" method="post" action="<?= base_url() ?>profile/update_profile">
                                           <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                           <div class="form-group">
                                            <label for="NameSurname" class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10 ">
                                                <div class="form-line">
                                                   <!-- <div class="u_name"> -->
                                                    <input type="text" class="form-control u_name" id="NameSurname" name="name" placeholder="Name"  required>
                                                    <!-- </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Email" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="email" class="form-control u_email" id="Email" name="email" placeholder="Email"  required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="InputSkills" class="col-sm-2 control-label">Mobile</label>

                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control u_mobile" id="InputSkills" name="mobile" placeholder="Mobile Number" required="">
                                                </div>
                                            </div>
                                        </div>

                                           <!--  <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <input type="checkbox" id="terms_condition_check" class="chk-col-red filled-in" />
                                                    <label for="terms_condition_check">I agree to the <a href="#">terms and conditions</a></label>
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-info">UPDATE</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="change_username_settings">
                                        <!-- <div id="successpw"></div> -->
                                        <form class="form-horizontal" method="post">
                                            <div class="form-group">
                                                <label for="OldUsername" class="col-sm-3 control-label">Old Username</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="oldUsername" name="OldUsername" placeholder="Old Username" required>
                                                        <div id="error_username" class="col-red"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewUsername" class="col-sm-3 control-label">New Username</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="newUsername" name="NewUsername" onkeyup="checkUsername()" placeholder="New Username" required>
                                                    </div>
                                                    <span id="error"></span>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewUsernameConfirm" class="col-sm-3 control-label">New Username (Confirm)</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="newUsernameConfirm" name="NewUsernameConfirm" placeholder="New Username (Confirm)" required>
                                                    </div>
                                                    <div id="error_match" class="col-red"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-info username_submit">UPDATE</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="change_password_settings">
                                        <div id="successpw"></div>
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="oldPassword" name="OldPassword" placeholder="Old Password" required>
                                                        <div id="error_dbmatch" class="col-red"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="newPassword" name="NewPassword" placeholder="New Password" required>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="newPasswordConfirm" name="NewPasswordConfirm" placeholder="New Password (Confirm)" required>
                                                    </div>
                                                    <div id="error_match_pw" class="col-red"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-info submitpassword">UPDATE</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="profile_picture">
                                     <div class="row">
                                        <form  id="upload_form" align="center" enctype="multipart/form-data"> 
                                             <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                          <div class="col-md-8"> 
                                              <input type="file" name="image_file" id="image_file" />  


                                              <!-- <button type="button" name="upload" id="upload" value="Upload" class="btn btn-info" onclick="imageSubmit()"/>  submit </button> -->
                                              <br>
                                              <br>
                                              <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info" />  
                                          </div> 
                                      </form>  
                                      <div class="col-md-4">
                                         <div id="uploaded_image">  
                                             <div id="previous_logo"><?php if(isset($profile_image[0]['profile_image']))   {    ?>
                                                 <img src="<?= base_url() ?>uploads/<?= $profile_image[0]['profile_image'] ?>"  width="120" height="120" alt="logo">
                                             <?php } ?>
                                         </div>  
                                     </div>
                                 </div>
                                 <div class="text-success col-md-12" id="message"></div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- <script src="<?= base_url() ?>assets/admin/plugins/bootstrap-notify/bootstrap-notify.js"></script> -->
 <script src="<?= base_url() ?>assets/admin/plugins/sweetalert/sweetalert.min.js"></script>
 <!-- <script src="<?= base_url() ?>assets/admin/js/pages/ui/notifications.js"></script> -->
 <script type="text/javascript">

    $(document).ready(function(){
                 // $("#successpw").notify("Hello Box");
                 getInformationUser();	
             });		

    function getInformationUser()
    {
      $.ajax({
         type: "GET",
        		 // async:false,
              url: "<?= base_url() ?>profile/user_profile_info",

              success: function (data) { 
                var obj=JSON.parse(data);
                console.log(obj);	
                $('.u_name').html(obj.name)
                $('.u_name').val(obj.name)
                $('.u_username').html(obj.username);
                $('.u_mobile').html(obj.mobile);
                $('.u_mobile').val(obj.mobile);
                $('.u_email').html(obj.email);
                $('.u_email').val(obj.email);
                $('.u_profile_image').html(obj.profile_image);
                var auth_id=obj.authorization_id;
                // console.log('auth'+auth_id);
                // var auth_name;
              //   switch(auth_id)
              //   {
              //   	case 1:
              //   	var auth_name="super admin";
              //   	break;
              //   	case 2:
              //   	var auth_name="admin";
              //   	 console.log(auth_name);
              //   	break;
              //   	case 3:
              //   	var auth_name="staff";
              //   	break;
              //   }
              // console.log(auth_name);
              //   $('#auth_type').html(auth_name);


          },

      });
  }


  $(".submitpassword").click(function(event) {
    event.preventDefault();
    var password = $('#oldPassword').val();
    var newpassword = $('#newPassword').val();
    var cpassword = $('#newPasswordConfirm').val();
    $.ajax({
        method: "POST",
        url:" <?= base_url() ?>profile/check_password", 
        data: {
            password:password,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"
        },
        success: function(responseObject) {
                  // console.log(responseObject);   
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
        $('#error_dbmatch').hide();
        $('#error').html("Password field cannot be empty");
    }
      // else if(obj!=password)
      // {
      //   $('#error_dbmatch').html("please write correct password");
      // }
      else if(newpassword!=cpassword)
      {
        $('#error_dbmatch').hide();
          // var msg="please fill all the field";
          $('#error_match_pw').html("new password and confirm should be same");

          // $('#error_username').show();

      }
      else
      {
        $.ajax({
            method: "POST",
            url:" <?= base_url() ?>profile/change_password", 
            data: {
                newpassword:newpassword,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"
            },
            success: function(response) {
                console.log(response);
                if(response)
                {

                    // $("#successpw").notify("Hello Box");
                    $('#successpw').html("Your password is successfully changed");
                    $('#successpw').css("color","green");

                    $('#error_dbmatch').hide();
                    $('#error_match_pw').hide();
                    $('#error').hide();
                    $('#oldPassword').val('');
                    $('#newPassword').val('');
                    $('#newPasswordConfirm').val('');
                }
                else
                {
                   $('#error_dbmatch').hide();
                   $('#error_match').hide();
                   $('#successpw').html("Your password is not updated");
                   $('#successpw').css("color","red");
               }


           }
       });
    }
}
});
});

  $(".username_submit").click(function(event) {
      event.preventDefault();
      var user_name = $("input#oldUsername").val();
      var nuser_name = $("input#newUsername").val();
      var cuser_name = $("input#newUsernameConfirm").val();
      var user_name_current= "<?= $this->session->username ?>";
      var user_id= "<?= $this->session->user_id ?>";
// console.log(user_name);
if(user_name=='' || user_name==null)
{
  $('#error_username').html("username cannot be empty");
}
else if(user_name_current!=user_name)
{
  $('#error_username').html("please enter your current username");
}
else if(nuser_name!=cuser_name)
{
  $('#error_match').html("new username and confirm username is not matched");
}

else
{
  $('#error_username').hide();
  $('#error_match').hide();
  $('#error').hide();

  $.ajax({
    method: "POST",
    url:" <?= base_url() ?>profile/change_username", 
    data: {
      username:nuser_name,user_id:user_id,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"
  },
  success: function(responseObject) {
      console.log(responseObject);
      if(responseObject==1)
      {
         $('#success').html("username successfully changed");
         $('#error_username').hide();
         $('#error_match').hide();
         // alert('please logout and login again for change');
         swal('username successfully changed,   please logout and login again for change');
          $("input#oldUsername").val('');
      $("input#newUsername").val('');
       $("input#newUsernameConfirm").val('');

     }
 }



});
}
});
  function checkUsername()
  {
      var nuser_name = $("input#newUsername").val();
      if(nuser_name.length>1)
      {
         $.ajax({
            method: "POST",
            url:" <?= base_url() ?>profile/check_username_PROCESS", 
            data: {
              username:nuser_name,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"
          },
          success: function(responseObject) {
           console.log(responseObject);
           var obj=JSON.parse(responseObject);

           if(obj.length==0)
           {
             $('#error').html("username is available");
             $('#error').css('color','green');
             $('.username_submit').prop("disabled",false);

         }
         else
         {
          $('.username_submit').prop("disabled",true);
          $('#error').html("username is already exist");
          $('#error').css('color','red');
      }
  }
});
     }
 }

  $('#upload_form').on('submit', function(e){  
           e.preventDefault();  
           if($('#image_file').val() == '')  
           {  
                alert("Please Select the File");  
           }  
           else  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>profile/image_upload",   
                     //base_url() = http://localhost/tutorial/codeigniter  
                     method:"POST",  
                     data:new FormData(this),  
                     contentType: false,  
                     cache: false,  
                     processData:false,  
                     success:function(data)  
                     {  
                      console.log(data);
                          $('#uploaded_image').html(data);  
                          // $('#message').html('Image succesfully loaded apply after login');  

                     },
                     error:function(data)
                     {
                        console.log("upload image function error");
                     }, 
                });  
           }  
      });  
</script> 