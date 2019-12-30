

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <b>Setting</b></br>
        <small>setting is applicable after logout</small>
       
      </div>
      <div class="body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
          <li role="presentation" class="active"><a href="#profile" data-toggle="tab">GENERAL SETTING</a></li>
          <li role="presentation" ><a href="#home" data-toggle="tab">TAX SETTING</a></li>
          <li role="presentation" ><a href="#invoice_due" data-toggle="tab">INVOICE DUE SETTING</a></li>
          <li role="presentation" ><a href="#logo" data-toggle="tab">UPLOAD LOGO</a></li>
          <!-- <li role="presentation" ><a href="#dashboard" data-toggle="tab">DASHBOARD SETTING</a></li> -->
          <!-- <li role="presentation"><a href="#messages" data-toggle="tab">MESSAGES</a></li>
            <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li> -->
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">



            <div role="tabpanel" class="tab-pane fade in active" id="profile">
              <form action="<?= base_url() ?>setting/general_setting_update" method="post">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                <div class="row">
             <div class="col-md-8">
                  <p>SELECT PANEL COLOR</p>
              <div class="form-group form-float">
            <select class="form-control" name="color">
              <option value="red" <?php if($seller_data[0]['panel_color']=='red') { echo 'selected'; } ?> >red</option>
              <option value="pink" <?php if($seller_data[0]['panel_color']=='pink') { echo 'selected'; } ?>  >pink</option>
              <option value="purple" <?php if($seller_data[0]['panel_color']=='purple') { echo 'selected'; } ?> >purple</option>
              <option value="blue" <?php if($seller_data[0]['panel_color']=='blue'){ echo 'selected'; } ?> >blue</option>

            </select>
          </div>
          </div>
                 <!--  <div class="col-md-8">
                <div class="demo-switch">
                  <p>
                   Auto Logout &nbsp <small>  (panel will auto logout when no activity occure)  </small>
                 </p>
                 <div class="switch">
                  <label>OFF<input type="checkbox" name="auto_logout" value="1" <?php if($seller_data[0]['auto_logout']==1){ echo 'checked';} ?> ><span class="lever"></span>ON</label>
                </div>

              </div>
            </div>

        
              <div class="col-md-8">
               <div class="form-group form-float">
                <div class="form-line">
                  <input type="text" class="form-control" value="<?= ($this->input->post('auto_logout_time') ? $this->input->post('auto_logout_time') : $seller_data[0]['auto_logout_time']); ?>" name="auto_logout_time" required="" aria-required="true" onkeypress="return isNumberKey(event)">
                  <label class="form-label">Auto Logout Time (in seconds)</label>
                </div>
              </div>
            </div> -->
            <br><br>
            <div class="col-md-5">
              <div class="form-group form-float">
                <button class="btn btn-primary waves-effect" type="submit">Update</button>
              </div>
            </div>
          </div>
          </form>
        </div>
        <div role="tabpanel" class="tab-pane" id="home">

          <form method="post" action="<?= base_url() ?>setting/tax_update">      
           <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">    
           <div class="row">
            <?php 
            $length=count($tax);
            if($length==0)
              { ?>
                <div class="col-md-5">
                  <div class="form-group form-float">
                   <div class="form-line">
                    <input type="text"   class="form-control tax_name" id="tax_name" aria-required="true"   data-toggle="tooltip" title="example: 9" />
                    <label  class="col-md-12 form-label"><span class="text-danger">*</span>Tax Name</label>
                  </div>
                  <span class="text-danger name_error"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group form-float">
                 <div class="form-line">
                  <input type="text"  class="form-control tax_percent" id="tax_percent"  aria-required="true"  data-toggle="tooltip" title="example: 9" />
                  <label  class="col-md-12 form-label"><span class="text-danger">*</span>Tax (%)</label>
                </div>

              </div>
            </div>
            <div class="col-md-2">
              <label  class="col-md-12 form-label"> </label>
              <div class="form-group">
                <button type="button" class="btn btn-success add_tax">+</button>
                <span class="text-danger name_error"></span>
              </div>
            </div>
          <?php    }
          else {
            for($i=0;$i<$length;$i++) { ?>
              <div class="col-md-5">
                <div class="form-group form-float">
                 <div class="form-line">
                  <input type="text"   class="form-control tax_name" id="tax_name" aria-required="true"  value="<?= (array_keys($tax[$i]))[0] ?>"   data-toggle="tooltip" title="example: 9" />
                  <label  class="col-md-12 form-label"><span class="text-danger">*</span>Tax Name</label>
                </div>

              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group form-float">
               <div class="form-line">
                <input type="text"  class="form-control tax_percent" id="tax_percent" aria-required="true"  value="<?= (array_values($tax[$i]))[0] ?>" data-toggle="tooltip" title="example: 9" />
                <label  class="col-md-12 form-label"><span class="text-danger">*</span>Tax (%)</label>
              </div>

            </div>
          </div>

          <?php if($i==0)  { ?>
           <div class="col-md-2">
            <div class="form-group">
              <button type="button" class="btn btn-success add_tax">+</button>

              <label  class="col-md-12 form-label">  </label>
            </div>
          </div> 
        <?php } 
        else  { ?>

          <div class="col-md-2">
            <label  class="col-md-12 form-label"></label>
            <div class="form-group">
              <button type="button" data-row="row<?= $i ?>" class="btn btn-danger remove">-</button>

            </div>
          </div> 

        <?php  } } }

        ?>
        <input type="hidden" id="t_name"  name="tax_name">
        <input type="hidden" id="t_percent" name="tax_percent">
        <div id="addRowsId"></div>
        <div class="col-md-12">
         <div class="form-group">
          <button type="submit" class="btn btn-success save" >Submit</button>
        </div>
      </div>
    </div>
  </form>


</div>
<div role="tabpanel" class="tab-pane" id="dashboard">
  <form method="post" action="<?= base_url() ?>setting/dashboard_setting">      
   <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">   
   <div class="demo-checkbox">

    <input type="checkbox" id="basic_checkbox_2" class="filled-in" name="sales" value="1"  />
    <label for="basic_checkbox_2">SALES GRAPH</label>
    <input type="checkbox" id="basic_checkbox_3" class="filled-in" name="payment" value="1" />
    <label for="basic_checkbox_3">PAYMENT GRAPH</label>
    <input type="checkbox" id="basic_checkbox_4" class="filled-in"  name="ticket"  value="1" />
    <label for="basic_checkbox_4">TICKET GRAPH</label>

  </div>

  <button type="submit" class="btn btn-success dashboard_submit" >UPDATE</button>
</form>
</div>
<div role="tabpanel" class="tab-pane" id="invoice_due">
          <form method="post" action="<?= base_url() ?>setting/invoice_setting_update">  
             <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">  
              <div class="col-md-4">
                <div class="form-group form-float">
                 <div class="form-line">
                  <input type="text"  class="form-control" name="due_day" value="<?= $seller_data[0]['invoice_due_day'] ?>" aria-required="true"  data-toggle="tooltip" title="the number of days after invoice date when due notification is shows" />
                  <label  class="col-md-12 form-label"><span class="text-danger">*</span>DUE DAYS OF INVOICE</label>
                </div>

              </div>
            </div>
              <!-- <div class="col-md-12"> -->
         
          <button type="submit" class="btn btn-success" >Submit</button>
        
      <!-- </div> -->
          </form>
</div>
<div role="tabpanel" class="tab-pane" id="logo">
   <div class="row">
                                        <form  id="upload_logo" align="center" enctype="multipart/form-data" method="post"> 
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
                                             <div id="previous_logo"><?php if(isset($seller_data[0]['logo']))   {    ?>
                                                 <img src="<?= base_url() ?>uploads/<?= $seller_data[0]['logo'] ?>"  width="120" height="120" alt="logo">
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

<script type="text/javascript">


  var count=1;
  $('.add_tax').click(function(){
    var tax_coloumn='<div id="row'+count+'" class="row">'+
    '<div class="col-md-5">'+
    '<div class="form-group form-float">'+
    '<div class="form-line focused">'+
    '<input type="text"   class="form-control tax_name" id="tax_name"    data-toggle="tooltip" title="example: 9" />'+
    '<label  class="col-md-12 form-label"><span class="text-danger">*</span>Tax Name</label>'+
    '</div>'+
    '<span class="text-danger name_error"></span>'+
    '</div>'+
    '</div>'+
    '<div class="col-md-4">'+
    '<div class="form-group form-float">'+
    '<div class="form-line focused">'+
    '<input type="text"  class="form-control tax_percent" id="tax_percent"    data-toggle="tooltip" title="example: 9" />'+
    '<label  class="col-md-12 form-label"><span class="text-danger">*</span>Tax (%)</label>'+
    '</div>'+
    '<span class="text-danger name_error"></span>'+
    '</div>'+
    '</div>'+
    '<div class="col-md-2">'+
    '<label  class="col-md-12 form-label"></label>'+
    '<div class="form-group">'+
    '<button type="button" data-row="row'+count+'" class="btn btn-danger remove">-</button>'+
    '<span class="text-danger name_error"></span>'+
    '</div>'+
    '</div>'

    $('#addRowsId').append(tax_coloumn);
  });


  $(document).on('click', '.remove', function(){
    var delete_row = $(this).data("row");
    $('#' + delete_row).remove();
  });

  $(".save").click(function( event ) {

  // event.preventDefault();
  var tax_name=[];
  var tax_percent=[];
  $('.tax_name').each(function(){
    tax_name.push($(this).val());
  });
  $('.tax_percent').each(function(){
    tax_percent.push($(this).val());
  });
  console.log(tax_name);

  $('#t_name').val(tax_name);
  $('#t_percent').val(tax_percent);
// $('#tax_percent').val(t_percent);

});
  $('#upload_logo').on('submit', function(e){  
           e.preventDefault();  
           if($('#image_file').val() == '')  
           {  
                alert("Please Select the File");  
           }  
           else  
           {  
                $.ajax({  
                     url:"<?= base_url(); ?>setting/logo_upload",   
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