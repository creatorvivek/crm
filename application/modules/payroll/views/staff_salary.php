<style type="text/css">

  .form-groups label.error {
    font-size: 12px;
    display: block;
    margin-top: 5px;
    font-weight: normal;
    color: #F44336; }
  </style>


  <div class="row clearfix">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          <h2><?= $staff_name ?> Salary</h2>

        </div>
        <div class="body">
          <form id="form_validation" method="POST"  action="<?= base_url() ?>payroll/add_staff_salary">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
     <!--      <div class="form-group form-float">
            <div class="form-line">
              <input type="text" class="form-control" name="payhead_name" required="" aria-required="true" >
              <label class="form-label">Payhead Name<span class="col-pink">*</span></label>
            </div>
          </div>
          

          <div class="form-group form-float">
            <div class="form-line">
              <textarea class="form-control" name="description" required></textarea>
              <label class="form-label">Description<span class="col-pink">*</span></label>
            </div>
          </div>
           <div class="form-group">
          <select class="form-control show-tick" name="payhead_type" required>

            <option value=""> --select --</option>
            <option value="1">Addition</option>
            <option value="2">Deduction</option>
            
            
          </select>
        </div> -->
        <div class="row clearfix">
          <div class="col-md-12">
            <p>
              Department <span class="col-pink">*</span>
            </p>
            <div class="form-groups">
              <select class="form-control show-tick method" id="designation_id" name="designation" onchange="fetch_employee()" required>
                <option value="">--Select --</option>
                <?php 
                foreach($department as $row): ?>
                  <option value="<?= $row['id'] ?>" <?=  set_select('designation',''. $row['id']. '') ?> ><?= $row['name'] ?></option>
                <?php endforeach; ?>

              </select>
              <span class="error"><?= form_error('designation');?></span>
            </div>
          </div>
          <div class="col-md-12">
            <p>
              <?= $staff_name ?>  Name <span class="col-pink">*</span>
            </p>
            <div class="form-groups">
              <select class="form-control employee_id" id="staff_fetch" name="employee" onchange="fetch_emolyee_payroll()" >
                <!-- <option value="">--Select --</option> -->
                <!-- <option value="6">anurag</option> -->

              </select>
              <span class="error"><?= form_error('employee');?></span>
            </div>

          </div>

          <div class="col-md-12">
           <p>
            Year <span class="col-pink">*</span>
          </p>
          <div class="form-groups">
            <select class="form-control show-tick method"  name="year" required>
              <option value="">--Select --</option>

              <option value="2019" <?=  set_select('year','2019') ?>>2019</option>
              <option value="2020" <?=  set_select('year','2020') ?>>2020</option>
              <option value="2021" <?=  set_select('year','2021') ?>>2021</option>
            </select>



            <span class="error"><?= form_error('year');?></span>
          </div>
        </div>
        <div class="col-md-12">
          <p>
            Month <span class="col-pink">*</span>
          </p>
          <div class="form-groups">
            <select class="form-control show-tick method"  name="month" required>


              <option value="" selected="selected">Select Month</option>
              <option value="1" <?=  set_select('month','1') ?> >January</option>
              <option value="2" <?=  set_select('month','2') ?>>February</option>
              <option value="3" <?=  set_select('month','3') ?>>March</option>
              <option value="4" <?=  set_select('month','4') ?>>April</option>
              <option value="5" <?=  set_select('month','5') ?>>May</option>

              <option value="6" <?=  set_select('month','6') ?>>June</option>
              <option value="7" <?=  set_select('month','7') ?>>July</option>
              <option value="8" <?=  set_select('month','8') ?>>August</option>
              <option value="9" <?=  set_select('month','9') ?>>September</option>
              <option value="10" <?=  set_select('month','10') ?>>October</option>
              <option value="11" <?=  set_select('month','11') ?>>November</option>
              <option value="12" <?=  set_select('month','12') ?>>December</option>
            </select>
            <span class="error"><?= form_error('month');?></span>
          </div>
        </div>
        <div class="col-md-12 show_checkbox">
           <div class="form-group">
           <input type="checkbox" id="basic_checkbox_2" class="filled-in check" name="check" value="1"  onclick="showOption()"   />
             <label for="basic_checkbox_2">Extra ?</label>
           </div>
       </div>
        <div class="attribute">
        <div class="col-md-6">
          <div class="form-groups">
            <select class="form-control payhead"  required>
              <option value="">--Select Payhead --</option>

              <?php foreach ($payhead_list as $row): ?>
                <option value="<?= $row['id'] ?>"><?= $row['payhead_name'] ?></option>  
              <?php endforeach ?>
            </select>
            <span class="error"><?= form_error('year');?></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-groups">
           <input type="text" class="form-control amount_enter" placeholder="amount"  required="" onkeypress="return isNumberKey(event);" aria-required="true"  >
         </div>
       </div>
       <div class="col-md-2">

        <button class="btn btn-primary waves-effect add_payhead" type="button">ADD</button>

      </div>
    </div>
      <div class="col-md-12 fetch_payroll_table"></div>
      <table class="table table-bordered attribute2"><thead><tr class="dynamicRows"><th>Payhead</th><th>Amt or % </th><th>Amount</th></tr></thead><tbody class="appends"></tbody><tfoot><tr><td colspan="2">Total<input type="hidden" name="total_amount" class="total_amount"></td><td class="total_amount_text"></td></tr></tfoot></table>
      <div class="col-md-12">
        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
      </div>
    </form>
  </div>
</div>
</div>



<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

<script>
  $(document).ready( function () {
    $('.js-basic-example').DataTable();
    $('.show_checkbox,.attribute2,.attribute').hide();
    fetch_employee();
  } );

  $('.add_payhead').click(function(){
    var payhead=$('.payhead').val();
    var amount=$('.amount_enter').val();
    // console.log(payhead);
    if(payhead!='' && amount!='')
    {
    var row,status;
    $.ajax({
      type: "post",
      url: "<?= base_url() ?>payroll/payhead_detail",
      data:{payhead_id:payhead,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
      success: function (data) {
        var obj=JSON.parse(data);
        console.log(obj)
        if(obj.payhead_type==1){
          status='+';

        }
        else
        {
          status='-';
        }
        row= '<tr><td>'+
              '<input type="hidden" name="payhead_id[]" value="'+obj['payhead_id']+'">'+
              '<input type="hidden" name="amount[]" class="amount" value="'+amount+'" data-id="'+obj.payhead_type+'"><input type="hidden" name="unit[]" class="unit" value="'+amount+'"><input type="hidden" name="unit_type[]" class="unit_type" value="1"> '+obj['payhead_name']+'</td><td>'+amount+'   Rs    '+status+'</td><td>'+amount+'</td></tr>'
               $('.appends').append(row);
               total_amount();
               // $(row).insertAfter($('table tr.dynamicRows:first'));
                
      },
    });
    $('.amount_enter').val('');
  }



  });

  $('#form_validation').validate({
    rules: {
      'checkbox': {
        required: true
      },
      'gender': {
        required: true
      }
    },
    highlight: function (input) {
      $(input).parents('.form-line').addClass('error');
    },
    unhighlight: function (input) {
      $(input).parents('.form-line').removeClass('error');
    },
    errorPlacement: function (error, element) {
      $(element).parents('.form-groups').append(error);
    }



  });

  function fetch_emolyee_payroll()
  {
    $.ajax({
      type: "post",
      url: "<?= base_url() ?>payroll/fetch_staff_payroll",
      data:{staff_id:$('.employee_id').val(),<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
      success: function (data) {
            // console.log(data);
            var obj=JSON.parse(data);
            var row='';
            var display;
            // console.log(obj);

            // head='<table class="table table-bordered"><thead><tr class="dynamicRows"><th>Payhead</th><th>Amt or % </th><th>Amount</th></tr></thead><tbody>'
            for(var i=0;i<obj['main_data'].length;i++)
            {
              if(obj['main_data'][i]['unit_type']==1)
              {
                display='Rs';
              }
              else
              {
                display='%';
              }

              row+= '<tr><td>'+
              '<input type="hidden" name="payhead_id[]" value="'+obj['main_data'][i]['payhead_id']+'">'+
              '<input type="hidden" name="amount[]" class="amount" data-id="'+obj['main_data'][i]['payhead_type']+'" value="'+obj['main_data'][i]['amount']+'"><input type="hidden" class="unit" name="unit[]" value="'+obj['main_data'][i]['unit']+'"><input type="hidden" class="unit_type" name="unit_type[]" value="'+obj['main_data'][i]['unit_type']+'"> '+obj['main_data'][i]['payhead_name']+'</td><td>'+obj['main_data'][i]['unit']+'    ' +  display   +'    '+obj['main_data'][i]['status']+'</td><td>'+obj['main_data'][i]['amount']+'</td></tr>'
            }
                // row='</table>'

                // $('.fetch_payroll_table').html(head+row+'</tbody><tfoot><tr><td colspan="2">Total</td><td><input type="hidden" name="gross" value="'+obj['gross']['gross_amount']+'" >'+obj['gross']['gross_amount']+' /-</td></tr></tfoot></table>');
                 $('.appends').html(row);
                 $('.show_checkbox,.attribute2').show();
                 total_amount();
            // for(var i=0;i<obj.length;i++)
            // {
            //     row+='<option value="'+obj[i]['id']+'">'+obj[i]['name']+'</option>'    
            // }
             // console.log();
            // $('#staff_fetch').append(row);    
          },
          error:function(data)
          {
            console.log('error');
          },
        });

  }

  function fetch_employee()
  {

    var designation_id=$('#designation_id').val();

    $.ajax({
      type: "post",
      url: "<?= base_url() ?>staff/fetch_staff",
      data:{designation_id:designation_id,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
      success: function (data) {
        var obj=JSON.parse(data);
        var row='';
        if(obj.length>0)
        {
          var start='<option value="">--Select--</option>'
          for(var i=0;i<obj.length;i++)
          {
            row+='<option value="'+obj[i]['id']+'">'+obj[i]['name']+'</option>'    
          }
          // console.log(row);
          $('#staff_fetch').html(start+row);   
        }
        else {

          $('#staff_fetch').html('<option value="">--No data--</option>');   
        } 
      },
      error:function(data)
      {
        console.log('error');
      },
    });
  }

  function total_amount()
  {
      // $('unit_type').
      var tot=0;
      var negative=0;
      var positive=0;
    $(".amount").each(function(){
      // console.log($('.amount').val());
      console.log($(this).attr('data-id'));
  if($(this).attr('data-id')=='2')
  {
    // $(this).val()=0;
    negative += parseInt($(this).val());
  }
  else
  {

    positive += parseInt($(this).val());
  }
  tot=positive-negative;
  $('.total_amount_text').text(tot);
  $('.total_amount').val(tot);
  // console.log(tot);
  });
  }

function showOption()
{
// $('#show_option').show();
 if($('.check').is(':checked'))
  {
$('.attribute').fadeIn();
}
else
{
$('.attribute').fadeOut();

}


}

</script>