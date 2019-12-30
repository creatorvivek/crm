<style type="text/css">
  #show_search_result{
    background-color: #Fffffe;
    list-style-type:none;
  }
  #show_search_result li:hover
  {
    background-color:grey;
    /*color:white;*/
  }
  .list_design
  {
    font-size: 12px;
    color:blue;
  }
  .customtable
  {
    width:100%;
    max-width: 700px;
    min-width: 300px;
    max-height: 400px;
    border-collapse:collapse; 
    background-color: #f8f8f8;
    overflow-y: scroll;

    /*background-color:red;*/
  } 
  .customtable td
  {

    padding:7px; 


  }
  .customtable tr:hover
  {

    background-color:#d2d2d2;


  }
  .customtable tr
  {

    display: block;

  }
  th
  {
    font-size: 14px;
  }
  input:-webkit-autofill + label {
    // Insert your active label styles
  }
</style>


<div class="row clearfix">
  <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header" align="center">
        <h2>PAYMENT</h2>
        
      </div>
      <div class="body">
        <form id="form_validation" method="POST" action="<?= base_url() ?>purchase/payment_vendor">
         <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
         <div class="row clearfix">
           <div class="col-md-8">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control search"  aria-required="true" onkeypress="search()" >
                <label class="form-label">Search Vendors by name and Mobile</label>
              </div>
              <spna style="color:red" id="error_customer"></spna>
            </div>
            <ul id="show_search_result" class="dropdown-menu customtable"></ul>
          </div>
          <div class="col-md-8">
            <div class="table-responsive">
              <table class="table table-bordered" id="details"></table>
            </div>
          </div>
          <input type="hidden" name="vendor_id" class="customer_id">
          <!-- <input type="hidden" name="order_id" class="order_id"> -->
          <div class="col-md-8">
            <table class="table table-bordered show_purchase_detail"></table>
          </div>
          <input type="hidden" class="count">
          <input type="hidden" class="amount_paid_total" name="total_amount">
          <div class="col-md-12">
            <div id="show_warning"></div>
          </div>
         <!--  <div class="col-md-6">
           <div class="form-group form-float">
            <div class="form-line">
              <input type="text" class="form-control" name="paid" required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10" value="<?= $this->input->post('paid'); ?>">
              <label class="form-label">Paid <span class="col-pink">*</span></label>
              <span class="error"><?= form_error('paid');?></span>
            </div>
          </div>
        </div> -->
        <div class="col-md-6 payment_method">
          <div class="form-group">
            <select class="form-control show-tick method" id="method" name="method" required>
              <option value="">--Select Payment Method--</option>
              <option value="cash">cash</option>
              <option value="swipe">swipe card</option>
              <option value="cheque">cheque</option>
              <option value="online">online</option>
            </select>
          </div>
          <div class="error"></div>
        </div>
        <div class="col-md-12">
          <button type="button" class="btn btn-info" onclick="form_submit()">Submit</button>
        </div>
      </div>

    </form>
  </div>
</div>
</div>
</div>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>  
<script type="text/javascript">
 $(document).ready(function()
  {
  
  $('.payment_method').hide();

  });

 function search()
 {
  var search=$('.search').val();
  $.ajax({
    type: "post",
    url: "<?= base_url() ?>purchase/search_vendors_details",
    data:{search:search,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
    success: function (data) {
// console.log(data);
var obj=JSON.parse(data);
var row;
if(obj.length>0)
{

  for(var i=0;i<obj.length;i++)
  {
    row += '<tr onclick="fill_detail('+obj[i]['id']+','+obj[i]['mobile']+','+obj[i]['pincode']+',\''+obj[i]['address']+'\',\''+obj[i]['city']+'\',\''+obj[i]['email']+'\',\''+obj[i].name+'\')"><td>'+obj[i]['name']+'</td><td>'+obj[i]['mobile']+'</td></tr>';

  }
  $('#show_search_result').show();
  $('#show_search_result').html(row);
}
else
{
  $('#show_search_result').hide();
}
        // $('.amount'+id).val(data);
      },
    });

}



function fill_detail(id,mobile,pincode,address,city,email,name)
{
  // $('.name').val(name);
  // console.log(mobile);
  $('.search').val(''); 
  $('.customer_id').val(id);
  $('.mobile').val(mobile); 
  $('.name').val(name); 
  $('.address').val(address);
  $('.pincode').val(pincode);
  $('.city').val(city);
  $('#show_search_result').hide();
  $('#details').html("<tr><th>Name</th><th>Mobile</th><th>Email</th></tr><tr><td>"+name+"</td><td>"+mobile+"</td><td>"+email+"</td></tr>");


  /*fetch invoice id according to customer*/
$.ajax({
    type: "post",
    url: "<?= base_url() ?>purchase/fetch_vendor_purchase",
    data:{vendor_id:id,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
    success: function (data) {

      var obj=JSON.parse(data);
      console.log(obj);
       var row,due,row2;
      var checkbox='<div class="form-group">'+
      '<input type="checkbox" id="basic_checkbox_2" class="filled-in check" name="check" value="1"  onclick="paid_all()"   />'+
      '<label for="basic_checkbox_2">Paid All</label>'+
      '</div>'
    
    
      
      var option='<option value="">--select--- </option>';
      var count=0;
      if(obj.vendor_bill.length>0)
      {
        for(var i=0;i<obj.vendor_bill.length;i++)
        {
          due=obj.vendor_bill[i].total_amount-obj.vendor_bill[i].paid
          // console.log()
          row += "<tr><td><input type='hidden' name='purchase_id[]' value='"+obj.vendor_bill[i].purchase_id+"' >"+obj.vendor_bill[i].purchase_id+"</td><td>"+obj.vendor_bill[i].total_amount+"</td><td class='due"+i+"'>"+due+"</td><td><input type='text' class='form-control invoice_payment payment"+i+"'  onkeypress='return isNumberKey(event)''   name='purchase_payment[]' onkeyup='calculate_total_amount()' value='0' ></td><td><div class='form-group'><input type='checkbox' id='basic_checkbox"+count+ "' class='filled-in check"+count+"' name='check' value='1'  onclick='paid_single("+count+")'   /><label for='basic_checkbox"+count+"'></label></div></td></tr>";
          count++;

        }
                  // $('#show_search_result').show();
          // $('#details').html("");
          $('.show_purchase_detail').html('<thead><tr><th>Purchase id</th><th>Purchase Amount</th><th>Amount Due</th><th>Payment </th><th>'+checkbox+'</th></tr></thead><tbody>'+row+'</tbody><tfoot><tr><td colspan="3">Total</td><td class="total_amount"></td></tr></tfoot>');

          $('.count').val(count);
          calculate_total_amount();
          $('.payment_method').show();
        }
        if(obj.initial_balance.initial_balance)
        {
          dueInitial=obj.initial_balance.initial_balance-obj.initial_balance.paid
          row2 += "<tr><td>Initial balance</td><td>"+obj.initial_balance.initial_balance+"</td><td class='due"+i+"'>"+dueInitial+"</td><td><input type='text' class='form-control invoice_payment payment"+i+"' name='initial_balance_payment' onkeyup='calculate_total_amount()' value='0' ></td><td><div class='form-group'><input type='checkbox' id='basic_checkbox"+count+ "' class='filled-in check"+count+"' name='check' value='1'  onclick='paid_single("+count+")'   /><label for='basic_checkbox"+count+"'></label></div></td></tr>";
           count++;
           $('.show_purchase_detail').append(row2);
            // $('.method').show();
          $('.count').val(count);
           $('.payment_method').show();
          calculate_total_amount();

        }
        else if(!(obj.vendor_bill.length>0) &&  !obj.initial_balance.initial_balance)
        {
                  // $('#bill_refrence').html(option);
                  // alert("no ")
                   // $( "span" ).text( "Not valid!" ).show().fadeOut( 1000 );
                   $('#show_warning').html('You have no payment reamaning for this vendor').show().fadeOut( 9000 );
                   $('#show_warning').css('color','red');
                   // $('#show_warning').fadeOut(9000);
                }
paid_all();

},
});

}

function paid_all()
{
  var count=$('.count').val();
  // console.log(count);
  if($('.check').is(':checked'))
  {
    for(var j=0;j<count;j++)
    {
      $('.payment'+j).val($('.due'+j).text());
      // $('.check'+count).is(':checked')
      $('.check'+j).prop('checked', true);

    }
  }
else
{
  for(var j=0;j<count;j++)
    {
      $('.payment'+j).val('');
      $('.check'+j).prop('checked', false);

    }


}
 calculate_total_amount();
  }

function paid_single(count)
{
 if($('.check'+count).is(':checked'))
  {
$('.payment'+count).val($('.due'+count).text());
}
else
{
  $('.payment'+count).val('');
}

 calculate_total_amount();
}



function calculate_total_amount()
{
var tot=0;
$(".invoice_payment").each(function(){
  if($(this).val()=='' || $(this).val()==null)
  {
    // $(this).val()=0;
    // tot += parseInt($(this).val());
  }
  else
  {

    tot += parseInt($(this).val());
  }
});

    console.log(tot);
    $('.total_amount').text(tot);
    $('.amount_paid_total').val(tot);

}


function validation()
{
var method =$('#method').val();
var amount_paid_total =$('.amount_paid_total').val();
var customer_id =$('.customer_id').val();
  if(method && amount_paid_total>0 && customer_id)

   // 
  {

    return true;
  }
  else
  {

    return false;
  }

}

function form_submit()
{

$('#form_validation').validate({

highlight: function (input) {
$(input).parents('.form-line').addClass('error');
},
unhighlight: function (input) {
$(input).parents('.form-line').removeClass('error');
},
errorPlacement: function (error, element) {
$(element).parents('.form-group').append(error);
}
});

  if(validation())
  {
     $('#form_validation').submit();

  }
  else
  {
    alert('some field is missing')
  }
}

</script>   