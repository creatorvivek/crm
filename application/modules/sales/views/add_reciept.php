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
        <h2>RECIEPT</h2>
        
      </div>
      <div class="body">
        <form id="form_validation" method="POST" action="<?= base_url() ?>sales/reciept_pay">
         <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
         <div class="row clearfix">
          <div style="color:red"><?php echo validation_errors(); ?></div>
           <div class="col-md-8">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control search"  aria-required="true" onkeypress="search()" >
                <label class="form-label">Search Customer by name and Mobile</label>
              </div>
              <spna style="color:red" id="error_customer"></spna>
            </div>
            <ul id="show_search_result" class="dropdown-menu customtable"></ul>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-bordered" id="details"></table>
            </div>
          </div>
          <input type="hidden" name="customer_id" class="customer_id">
          <input type="hidden" name="order_id" class="order_id">
          <div class="col-md-8">
            <table class="table table-bordered show_invoice"></table>
          </div>
          <input type="hidden" class="count">
          <input type="hidden" class="amount_paid_total" name="total_amount">
        <!--   <div class="col-md-8">
            <p>Select Bill Reference</p>
            <div class="form-group">
              <select class="form-control show-tick method" id="bill_refrence" name="invoice_id" required onchange="fetch_amount_invoice()">
              

              </select>
            </div>
          </div> -->
          <!-- div class="col-md-4">
            <div id="display_bal"></div>
          </div> -->
          <!-- <div class="col-md-6">
           <div class="form-group form-float">
            <div class="form-line">
              <input type="text" class="form-control" name="paid" required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10" value="<?= $this->input->post('paid'); ?>">
              <label class="form-label">Paid <span class="col-pink">*</span></label>
              <span class="error"><?= form_error('paid');?></span>
            </div>
          </div>
        </div> -->
        <div class="col-md-6">
          <div class="form-group">
            <select class="form-control show-tick method" id="method" name="method" required onchange="check_cheque()">
              <option value="">--Select Payment Method--</option>
              <option value="cash">cash</option>
              <option value="swipe">swipe card</option>
              <option value="cheque">cheque</option>
              <option value="online">online</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="addField"></div>
        </div>
        <div class="col-md-12">
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
      </div>

    </form>
  </div>
</div>
</div>
</div>

<script type="text/javascript">
 $(document).ready(function()
{
  $('.method').hide();

});
 function search()
 {
  var search=$('.search').val();
  $.ajax({
    type: "post",
    url: "<?= base_url() ?>crn/search_customer_details",
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
    url: "<?= base_url() ?>crn/fetch_customer_invoice",
    data:{customer_id:id,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
    success: function (data) {

      var obj=JSON.parse(data);
      // console.log(obj.customer_invoice);
      var row,due,row2;

      var checkbox='<div class="form-group">'+
      '<input type="checkbox" id="basic_checkbox_2" class="filled-in check" name="check" value="1"  onclick="paid_all()"   />'+
      '<label for="basic_checkbox_2">Paid All</label>'+
      '</div>'
    
      // var checkbox_single='<div class="form-group">'+
      // '<input type="checkbox" id="basic_checkbox_2" class="filled-in check" name="check" value="1"  onclick="paid_single('+count+')"   />'+
      // '<label for="basic_checkbox'+count+'"></label>'+
      // '</div>';
      
      var option='<option value="">--select--- </option>';
      var count=0;
      var dueInitial;
      if(obj.customer_invoice.length>0)
      {
        // console.log(obj.customer_invoice[0].invoice_id);
        for(var i=0;i<obj.customer_invoice.length;i++)
        {
          due=obj.customer_invoice[i].total-obj.customer_invoice[i].paid;
          console.log(due);
          row += "<tr><td><input type='hidden' name='invoice_id[]' value='"+obj.customer_invoice[i].invoice_id+"' >"+obj.customer_invoice[i].invoice_id+"</td><td>"+obj.customer_invoice[i].total+"</td><td class='due"+i+"'>"+due+"</td><td><input type='text' class='form-control invoice_payment payment"+i+"' name='invoice_payment[]' onkeyup='calculate_total_amount()' value='0' ></td><td><div class='form-group'><input type='checkbox' id='basic_checkbox"+count+ "' class='filled-in check"+count+"' name='check' value='1'  onclick='paid_single("+count+")'   /><label for='basic_checkbox"+count+"'></label></div></td></tr>";
          count++;
        }
          // console.log(row);
                  // $('#show_search_result').show();
          // $('#details').html("");
          $('.show_invoice').html('<thead><tr><th>Invoice No</th><th>Invoice Amount</th><th>Amount Due</th><th>payment </th><th>'+checkbox+'</th></tr></thead><tbody>'+row+'</tbody><tfoot><tr><td colspan="3">Total</td><td class="total_amount"></td></tr></tfoot>');
          $('.method').show();
          $('.count').val(count);
          calculate_total_amount();
        }

        if(obj.initial_balance.initial_balance)
        {
          dueInitial=obj.initial_balance.initial_balance-obj.initial_balance.paid
          row2 += "<tr><td>Initial balance</td><td>"+obj.initial_balance.initial_balance+"</td><td class='due"+i+"'>"+dueInitial+"</td><td><input type='text' class='form-control invoice_payment payment"+i+"' name='initial_balance_payment' onkeyup='calculate_total_amount()' value='0' ></td><td><div class='form-group'><input type='checkbox' id='basic_checkbox"+count+ "' class='filled-in check"+count+"' name='check' value='1'  onclick='paid_single("+count+")'   /><label for='basic_checkbox"+count+"'></label></div></td></tr>";
           count++;
           $('.show_invoice').append(row2);
            $('.method').show();
          $('.count').val(count);
          calculate_total_amount();

        }
        else
        {
                  // $('#bill_refrence').html(option);
                }
// paid_all();

},
});

}

function fetch_amount_invoice()
{
  var invoice_id=$('#bill_refrence').val();
  $.ajax({
    type: "post",
    url: "<?= base_url() ?>account/fetch_invoice_info",
    data:{invoice_id:invoice_id,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
    success: function (data) {
      // console.log(data);

      var obj=JSON.parse(data);
                // var row;  
                var heading='<h4>Balance</h4>';
                var total=obj.total-obj.paid;
                $('#display_bal').html(heading+total);
                $('.order_id').val(obj.order_id);
                // var option='<option value="">--select--- </option>';
                // if(obj.length>0)
                // {

                //   for(var i=0;i<obj.length;i++)
                //   {
                //     row += '<option value="'+obj[i].invoice_id+'">'+obj[i].invoice_id+'</option>';

                //   }
                //   // $('#show_search_result').show();
                //   $('#bill_refrence').html(option+row);
                // }
                // else
                // {
                //   $('#bill_refrence').html(option);
                // }


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

    // console.log(tot);
    $('.total_amount').text(tot);
    $('.amount_paid_total').val(tot);

}

function check_cheque()
{

var payment_method=$('#method').val();
if(payment_method=='cheque')
{

    var row= '<div class="form-group">'+
              '<div class="form-line">'+
                '<input type="text" class="form-control"  name="cheque_no" placeholder="cheque number" onkeypress="return isNumberKey(event)" >'+
                // '<label class="form-label">Cheque No.</label>'+
              '</div>'+
            '</div>';
            $('.addField').show();
$('.addField').html(row);

}
else
{
$('.addField').hide();

}

}
</script>   