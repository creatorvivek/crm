 

 
<div class="row ">

  <div class="col-md-7 col-md-10 col-xs-10 col-xl-7">
    <?php if(isset($message)){echo $message;} ?>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <ul class="nav nav-pills ml-auto p-2 pull-left">
            <li class="nav-item"><a class="nav-link active show" href="#tab_1" data-toggle="tab">Personals Information</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Billing Information</a></li>
          </ul>

        </h3>
      </div>
      <!-- /.card-header -->
      <?= form_open_multipart('setting/frenchise_setting_edit/'.$frenchise[0]['f_id'].'',array("class"=>"form-horizontal")) ?>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active show" id="tab_1">
            <div class="row"> 
              <div class="col-md-5">
                <label  class="col-md-12 control-label"><span class="text-danger">*</span>Frenchise name</label>
                <div class="form-group">
                  <input type="text" name="f_name" value="<?= ($this->input->post('f_name') ? $this->input->post('f_name') : $frenchise[0]['name']); ?>"  class="form-control" id="f_name" required  autofocus />
                  <span class="text-danger f_name_error"></span>
                </div>
              </div>

              <div class="col-md-5">
                <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Mobile Number</label>
                <div class="form-group">
                  <input type="text" name="mobile" value="<?= ($this->input->post('mobile') ? $this->input->post('mobile') : $frenchise[0]['mobile']); ?>" maxlength=10 class="form-control" id="mobile" onfocusout="validateMobile()"  />
                  <span class="text-danger col-md-12 mobile_error"></span>
                </div>
              </div>

              <div class="col-md-5">
                <label for="task" class="col-md-12 control-label">Crn Number</label>
                <div class="form-group">
                  <input type="text" name="crn_number" disabled  class="form-control" id="crn_number" value="<?= ($this->input->post('crn_number') ? $this->input->post('crn_number') : $frenchise[0]['crn_number']); ?>"  />
                  <span class="text-danger nas_error"></span>
                </div>
              </div>
              <div class="col-md-5">
                <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Email</label>
                <div class="form-group">
                  <input type="text" name="email" value="<?= ($this->input->post('email') ? $this->input->post('email') : $frenchise[0]['email']); ?>" class="form-control" id="email"  />
                  <span class="text-danger nas_error"></span>
                </div>
              </div>
              <div class="col-md-10">
                <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Address</label>
                <div class="form-group">
                  <textarea row="7" class="form-control" name="address"> <?= ($this->input->post('address') ? $this->input->post('address') : $frenchise[0]['address']); ?>  </textarea>
                  <span class="text-danger nas_error"></span>
                </div>
              </div>
              <div class="col-md-5">
                <label for="task" class="col-md-12 control-label">Upload Logo</label>
                <div class="form-group">
                  <input type="file" name="logo"  class="form-control"   />
                  <span class="text-danger nas_error"></span>
                </div>
              </div>
              <div class="col-md-5">
                <label for="task" class="col-md-12 control-label">Upload Profile Picture</label>
                <div class="form-group">
                  <input type="file" name="profile_pic"  class="form-control"   />
                  <span class="text-danger nas_error"></span>
                </div>
              </div>
        <div class="col-md-5">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Short Name</label>
          <div class="form-group">
            <input type="text" name="short_name" value="<?= ($this->input->post('short_name') ? $this->input->post('short_name') : $frenchise[0]['short_name']); ?>" class="form-control" id="short_name" data-toggle="tooltip" title="short name are used in prefix in ieee username" maxlength=5  />
            <span class="text-danger nas_error"></span>
          </div>
        </div>
      <!-- <div class="col-md-5">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Password</label>
          <div class="form-group">
            <input type="password" name="pw" value="<?= $this->input->post("pw"); ?>" class="form-control" id="pw"  />
            <span class="text-danger nas_error"></span>
          </div>
        </div>  -->

        <!-- <div class="col-md-5">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Frenchise Type</label>
          <select class="form-control" id="f_type" name="f_type">
            <option value="">--Select--</option>
            <option value="1">Fix capacity</option>
            <option value="2">Share Revenue</option>
          </select>
        </div>
        <div id="revenue_persent"  class="col-md-5" style="display:none;">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Revenue %</label>
          <div class="form-group">
            <input type="text" name="r_persent" class="form-control">
          </div>
        </div> -->
      </div>



      <!-- <div class="form-group">
        <div class="col-sm-offset-4 col-sm-5">
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </div> -->


    </div>
    <div class="tab-pane" id="tab_2">
      <div class="row"> 
<div class="col-md-5">
  <?php if(!isset($frenchise_account['gst_number'])){ echo $frenchise_account['gst_number']=''; } ?>
          <label  class="col-md-12 control-label"><span class="text-danger">*</span>GST Number</label>
          <div class="form-group">

            <input type="text" name="gst_number" maxlength="15" class="form-control" id="gst_number"  value="<?= ($this->input->post('gst_number') ? $this->input->post('gst_number') : $frenchise_account['gst_number'] ) ?>"   autofocus />
            <span class="text-danger name_error"></span>
          </div>
        </div>
        <div class="col-md-5">
           <?php if(!isset($frenchise_account['bank_account'])){ echo $frenchise_account['bank_account']=''; } ?>
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Bank Account No.</label>
          <div class="form-group">
            <input type="text" name="bank_account"  class="form-control" value="<?= ($this->input->post('bank_account') ? $this->input->post('bank_account') : $frenchise_account['bank_account']); ?>"/>
            <span class="text-danger nas_error"></span>
          </div>
        </div>

           <?php if(!isset($frenchise_account['isp_license'])){  $frenchise_account['isp_license']=0; } ?>
              <?php  if($frenchise_account['isp_license']==1){ ?>
        <div class="col-md-10">

          <div class="checkbox">
            <div class="form-group">
              <label><input type="checkbox" name="isp_license" checked value="1">&nbsp Have Isp License</label>
            </div>
          </div>
        </div>  
      <?php } else { ?>

   <div class="col-md-10">

          <div class="checkbox">
            <div class="form-group">
              <label><input type="checkbox" name="isp_license"  value="1">&nbsp Have Isp License</label>
            </div>
          </div>
        </div>  

      <?php } ?>
        <div class="col-md-5">
           <?php if(!isset($frenchise_account['billing_cycle'])){ echo $frenchise_account['billing_cycle']=''; } ?>
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Billing Cycle</label>
          <div class="form-group">
            <input type="text" name="billing_cycle" data-toggle="tooltip" title="Enter date in which billing is occure" class="form-control" id="billing_cycle" onkeyup="date_chk()" onkeypress="return isNumberKey(event)" value="<?= ($this->input->post('billing_cycle') ? $this->input->post('billing_cycle') : $frenchise_account['billing_cycle']); ?>" />
            <span class="text-danger billing_error"></span>
          </div>
        </div>
        <div class="col-md-5">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Customer care number</label>
           <?php if(!isset($frenchise_account['customer_care'])){ echo $frenchise_account['customer_care']=''; } ?>
          <div class="form-group">
            <input type="text" name="customer_care" data-toggle="tooltip" title="Enter your customer care number" class="form-control" id="billing_cycle"  value="<?= ($this->input->post('customer_care') ? $this->input->post('customer_care') : $frenchise_account['customer_care']); ?>" onkeypress="return isNumberKey(event)" />
            <span class="text-danger "></span>
          </div>
        </div>
        <?php 
        $length=count($tax);
        if($length==0)
          { ?>
            <div class="col-md-5">
              <label  class="col-md-12 control-label"><span class="text-danger">*</span>Tax Name</label>
              <div class="form-group">
                <input type="text"   class="form-control tax_name" id="tax_name"    data-toggle="tooltip" title="example: 9" />
                <span class="text-danger name_error"></span>
              </div>
            </div>
            <div class="col-md-4">
              <label  class="col-md-12 control-label"><span class="text-danger">*</span>Tax (%)</label>
              <div class="form-group">
                <input type="text"  class="form-control tax_percent" id="tax_percent"    data-toggle="tooltip" title="example: 9" />
                <span class="text-danger name_error"></span>
              </div>
            </div>
            <div class="col-md-2">
              <label  class="col-md-12 control-label"></label>
              <div class="form-group">
                <button type="button" class="btn btn-success add_tax">+</button>
                <span class="text-danger name_error"></span>
              </div>
            </div>
          <?php    }
          else
            for($i=0;$i<$length;$i++) { ?>
              <div class="col-md-5">
                <label  class="col-md-12 control-label"><span class="text-danger">*</span>Tax Name</label>
                <div class="form-group">
                  <input type="text"   class="form-control tax_name" id="tax_name"   value="<?= (array_keys($tax[$i]))[0] ?>"   data-toggle="tooltip" title="example: 9" />
                  <span class="text-danger name_error"></span>
                </div>
              </div>
              <div class="col-md-4">
                <label  class="col-md-12 control-label"><span class="text-danger">*</span>Tax (%)</label>
                <div class="form-group">
                  <input type="text"  class="form-control tax_percent" id="tax_percent"   value="<?= (array_values($tax[$i]))[0] ?>" data-toggle="tooltip" title="example: 9" />
                  <span class="text-danger name_error"></span>
                </div>
              </div>

              <?php if($i==0){ ?>
               <div class="col-md-2">
                <label  class="col-md-12 control-label">  </label>
                <div class="form-group">
                  <button type="button" class="btn btn-success add_tax">+</button>
                  <span class="text-danger name_error"></span>
                </div>
              </div> 
            <?php } 
            else{ ?>

              <div class="col-md-2">
                <label  class="col-md-12 control-label"></label>
                <div class="form-group">
                  <button type="button"  class="btn btn-danger remove">-</button>
                  <span class="text-danger name_error"></span>
                </div>
              </div> 

            <?php  }

            ?>
          <?php  } ?>
          <div  class="col-md-12" id="addRowsId"></div>
          <div class="col-md-10">
          <div class="card ">
            <div class="card-header">
              <h3 class="card-title">
                Frenchise Terms and condition
               
              </h3>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php if(!isset($frenchise_account['terms'])){ echo $frenchise_account['terms']=''; } ?>
              <div class="mb-3">
                <textarea id="terms" name="terms" style="width: 100%"><?= ($this->input->post('terms') ? $this->input->post('terms') : $frenchise_account['terms']); ?></textarea>
              </div>
             
            </div>
          </div>
          <!-- /.card -->
</div>
        </div>
      </div>
    </div>
  <input type="hidden" name="tax_name"  id="t_name">
  <input type="hidden" name="tax_percent"  id="t_percent">
  <!-- ./card body -->
    <div class="col-sm-offset-4 col-sm-12 col-md-12" >
  <div class="form-group" align="center">
      <button class="btn btn-success save">save</button>
    </div>
  </div>
  </div>
  <?= form_close(); ?>
</div>
</div>
<script type="text/javascript">
  $('#f_type').change(function(){
    var f_type=$('#f_type').val();
    if(f_type==2)
    {
      $('#revenue_persent').show();

    }
    else
    {
      $('#revenue_persent').hide();
    }

  });
  function validateMobile()
  {
    var mobile=$('#mobile').val();

    if(mobile=='')
    {
      $('.mobile_error').show();
      $('.mobile_error').html('Please fill this field');
      $('#mobile').focus();
    }
    else
    {
      $('.mobile_error').hide();
      $.ajax({
        type: "post",
        url: "<?= base_url() ?>crn/mobileCheck",
        data:{mobile:mobile},
        success: function (data) {
        // console.log(data);
        var obj=JSON.parse(data);
        // console.log(obj);
        // console.log(obj.length);
        if(obj.length>0)
        {
          $('.mobile_error').show();
          // $('.mobile_error').html('mobile number with crn='+obj[0].crn_id+'');
          $('#crn_number').val(obj[0].crn_id);
        }
        else
        {
          $('#crn_number').val(' ');
        }
      },
    });

    }
  }

  function date_chk(){
    var dt = document.getElementById('billing_cycle').value;
    if(dt>28 || dt<1){
      $('.billing_error').html('date range should between 1 to 28');
    // alert('Date Not Be Greater Than 28');
    document.getElementById('billing_cycle').value='';
  }
  else
  {
    $('.billing_error').hide();
  }
}

var count=1;
$('.add_tax').click(function(){
  var tax_coloumn='<div id="row'+count+'" class="row"><div class="col-md-5" ><div class="form-group"><input type="text"  maxlength="15" class="form-control tax_name" id="tax_name"   data-toggle="tooltip" title="example: 9" /></div></div><div class="col-md-4"><div class="form-group"><input type="text"  maxlength="15" class="form-control tax_percent" id="tax_percent"    data-toggle="tooltip" title="example: 9" /></div></div><div class="col-md-2"><button type="button" data-row="row'+count+'" class="btn btn-danger remove">-</div>';
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
</script>
<script src="<?= base_url() ;?>assets/admin/plugins/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    ClassicEditor
      .create(document.querySelector('#terms'))
      .then(function (editor) {
        // The editor instance
      })
      .catch(function (error) {
        console.error(error)
      })

    // bootstrap WYSIHTML5 - text editor

    // $('.textarea').wysihtml5({
    //   toolbar: { fa: true }
    // })
  })
</script>