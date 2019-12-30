
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
    background-color:;
  }
  .small_unit
  {
    font-size:12px;
  }
  #details
  {
    font-size: 12px;
  }

  input:-webkit-autofill + label {
    // Insert your active label styles
  }
</style>





<div class="row clearfix">
  <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header" align="center">
        <h2><?php echo isset($heading)?$heading:'ADD FOR SALE' ?></h2>
        
      </div>
      <div class="body">
        <form id="form_validation" method="POST">
         <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
         <div class="col-md-8">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="text" class="form-control search"  aria-required="true" onkeypress="search()" >
              <label class="form-label">Search Customer by name and Mobile Number</label>
              <spna style="color:red" id="error_customer"></spna>
            </div>
          </div>
          <ul id="show_search_result" class="dropdown-menu customtable"></ul>
        </div>
        <div class="col-md-4">
          <div class="form-group form-float">
           <button class="btn btn-default btn-flat delete-btn" type="button"  data-toggle="modal" data-target="#customerModal">
             ADD NEW CUSTOMER
           </button>
         </div>
       </div>
       <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered" id="details"></table>
        </div>
      </div>
         <!--  <div class="col-md-8">
            <div class="form-group form-float">
              <div class="form-line f_name">
                <input type="text" class="form-control name" name="name"  readonly  required="" aria-required="true" onkeypress="return isAlpha(event)">
                <label class="form-label">Customer Name</label>
              </div>
            </div>
          </div> -->
          <!-- <div class="col-md-4">
            <div class="form-group form-float">
              <div class="form-line" id="bs_datepicker_container">
                <input type="text" class="form-control" name="date"  required="" aria-required="true" >
                <label class="form-label col-md-4">Date</label>
              </div>
            </div>
          </div> -->

          <!-- <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line  f_number">
                <input type="text" class="form-control mobile" name="mobile"  required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                <label class="form-label">Mobile Number</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line  f_email">
                <input type="email" class="form-control email" name="email"  required="" aria-required="true"  >
                <label class="form-label">Email</label>
              </div>
            </div>
          </div> -->
          <div class="col-md-6">
            <div class="form-group">
              <select class="form-control show-tick item" name="item[]" id="item1" data-live-search="true" onchange="test_two(1)" >
                <option value="">--Select item--</option>
                <?php  foreach($items as $row)
                {
                  ?>
                  <option value="<?= $row['id'] ?>" ><?= $row['item_name'] .'  (Rs.   '. $row['selling_price'] .' )' ?></option>
                <?php } ?>
              </select>
            </div>
            <span id="error_item" style="color:red"></span>
          </div>
          <input type="hidden" class="customer_id" name="customer_id">
          <input type="hidden" class="email" name="email">
          <input type="hidden" class="mobile" name="mobile">
          <input type="hidden" class="name" name="name">
          <input type="hidden" class="pincode" name="pincode">
          <input type="hidden" class="city" name="city">
          <input type="hidden" class="address" name="address">
          
         <!--  <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="exampleInputEmail1"></label>
                  <input class="form-control auto" placeholder="Search Item" id="search" onkeyup="search_item()">
                
                <ul class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" id="ui-id-2"  style="display: none; top: 60px; left: 15px; width: 520px;">
                <li>No Item Found!</li>
                </ul>

              </div>
            </div>
          </div> -->
          <!--  <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="model_number" required="" aria-required="true">
                <label class="form-label">Model no.</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="model_number" required="" aria-required="true">
                <label class="form-label">Item Company Name</label>
              </div>
            </div>
          </div> -->
          <div  id="addRow" ></div>
         <!--  <div class="col-md-6">
         
            
         </div> -->
          <!-- <div class="form-group">
            <input type="radio" name="gender" id="male" class="with-gap" value="male">
            <label for="male">Male</label>
            <input type="radio" name="gender" id="female" class="with-gap" value="female">
            <label for="female" class="m-l-20">Female</label>
          </div> -->
          <!-- <br> -->

         <!--  <div class="col-md-6">
          <div class="form-group"> -->
           <div class="row">
            <div class="col-md-12">
              <!-- /.box-header -->
              <!-- <div class="box-body no-padding"> -->
                <div class="table-responsive">
                  <table class="table table-bordered table_info" id="purchaseInvoice">
                    <tbody>

                      <tr class="dynamicRows">
                        <th width="10%" class="text-center">ITEM NAME</th>
                        <th width="10%" class="text-center">STOCK</th>
                        <th width="10%" class="text-center">QUANTITY</th>
                        <th width="10%" class="text-center">DISCOUNT(%)</th>
                        <!-- <th width="20%" class="text-center">TAX(%)</th> -->


                        <!-- <th width="15%" class="text-center">TAX(%)</th> -->
                        <!-- <th width="10%" class="text-center">{{ trans('message.table.tax') }}({{Session::get('currency_symbol')}})</th> -->
                        <!-- <th width="10%" class="text-center">DISCOUNT(%)</th> -->
                        <th width="20%" class="text-center">AMOUNT</th>
                        <th width="5%"  class="text-center">ACTION</th>
                      </tr>

                      <tr class="tableInfo"><td colspan="4" align="right"><strong>Sub total</strong></td><td align="left" colspan="2"><strong id="subTotal"></strong></td>
                      </tr>

                      <tr class="tableInfo"><td colspan="4" align="right"><strong>Total Tax</strong></td><td align="left" colspan="2"><strong id="taxTotal"></strong></td>
                      </tr>
                      <tr class="tableInfo"><td colspan="4" align="right"><strong>Total</strong></td><td align="left" colspan="2"><input type='text' name="total" class="form-control" id ="grandTotal" readonly></td></tr>

                    </tbody>
                  </table>
                </div>
                <br><br>
                <!-- </div> -->
              </div>
          <div class="col-md-4">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control paid_amount"  name="paid_amount" onkeypress="return isNumberKey(event)" >
                <label class="form-label">Paid Amount</label>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control show-tick method" id="method" name="method">
                <option value="">--Select Payment Method--</option>
                <option value="cash">cash</option>
                <option value="swipe">swipe card</option>
                <option value="cheque">cheque</option>
                <option value="online">online</option>
              </select>
            </div>
          </div>
              <!-- /.box-body -->
              <div class="col-md-12">
             <!--  <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('message.table.note') }}</label>
                    <textarea placeholder="{{ trans('message.table.description') }} ..." rows="3" class="form-control" name="comments"></textarea>
                  </div> -->
                  <!-- <a href="{{url('/sales/list')}}" class="btn btn-info btn-flat">{{ trans('message.form.cancel') }}</a> -->
                  <!-- <button type="submit" class="btn btn-primary btn-flat pull-right" id="btnSubmit">Submit</button> -->
                </div>
              </div>
              <button class="btn btn-primary waves-effect" type="button" onclick="form_submit()">SUBMIT</button>
          <!-- </div>
          </div> -->
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal start -->
<div class="modal fade" id="customerModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ADD NEW CUSTOMER</h4>
        <!-- <p>Invoice-id - <?= $invoice[0]['invoice_id'] ?></p> -->
      </div>
      <div class="modal-body">

        <form class="form-horizontal" id="payForm" action="<?= base_url() ?>crn/add_crn_process?redirect_sale=1" method="POST">
         <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
         <div class="row">
          <div class="col-md-12">
           <div class="form-group form-float">
            <div class="form-line">
              <input type="text" class="form-control" name="name" required="" aria-required="true" >
              <label class="form-label">Name <span class="col-pink">*</span></label>
            </div>
          </div>
        </div>
        <br><br><br>
        <div class="col-md-12">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="text" class="form-control" name="mobile" required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
              <label class="form-label">Mobile <span class="col-pink">*</span></label>
            </div>
          </div>
        </div>
        <br><br><br>
        <div class="col-md-12">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="email" class="form-control" name="email" required="" aria-required="true">
              <label class="form-label">Email <span class="col-pink">*</span></label>
            </div>
          </div>
        </div>
        <br><br><br>
        <div class="col-md-12">
          <div class="form-group form-float">
            <div class="form-line">
              <textarea class="form-control" name="address" required></textarea>
              <label class="form-label">Addesss <span class="col-pink">*</span></label>
            </div>
          </div>
        </div>
        <br><br><br>
        <div class="col-md-12">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="text" class="form-control" name="city" required="" aria-required="true" onkeypress="return isAlpha(event)">
              <label class="form-label">City <span class="col-pink">*</span></label>
            </div>
          </div>
        </div>
        <br><br><br>
        <div class="col-md-6">
         <div class="form-group form-float">
          <div class="form-line">
            <input type="text" class="form-control" name="pincode" required="" aria-required="true" maxlength="10" onkeypress="return isNumberKey(event)">
            <label class="form-label">Pincode <span class="col-pink">*</span></label>
          </div>
        </div>
      </div>
      <br><br><br>
      <div class="col-md-6">
        <div class="form-group">
          <input type="radio" name="gender" id="male" class="with-gap" value="male">
          <label for="male">Male</label>

          <input type="radio" name="gender" id="female" class="with-gap" value="female">
          <label for="female" class="m-l-20">Female</label>
        </div>
      </div>
      <br><br><br>
    </div>
    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
  </form>
</div>
</div>
</div>
</div>

<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script>
<!-- <script src="<?= base_url() ?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->

<script type="text/javascript">
  var count=1;
  var price=[];
  //  if(!customer_id)
  // {
  //   alert("hii");
  // }
  var customer_id=$('.customer_id').val();
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

  function showPrice(id)
  {
    var item_id=$('#item'+id).val();
// console.log(item_id);
$.ajax({
  type: "post",
  url: "<?= base_url() ?>item/fetch_amount",
  data:{item_id:item_id},
  success: function (data) {
    console.log(data);
    $('.amount'+id).val(data);
  },
});
}

function addRow()
{
// $('#add').click(function(){
  var item_id=$('#item1').val();
  console.log(item_id);
  $.ajax({
    type: "GET",
    url: "<?= base_url() ?>item/fetch_item",
// data:{search:search},
success: function (data) {
// console.log(data);
var obj=JSON.parse(data);
var option;
for(var i=0;i<obj.length;i++)
{
 if(obj[i].id==item_id)
 {
  continue;
} 
option+='<option value="'+obj[i].id+'">'+obj[i].item_name+'</option>';
}

var row='<div class="row clearfix" id="row' + count + '"><div class="col-md-6"><div class="form-group"><select class="form-control show-tick item" name="item[]" id="item'+count+'" required="" onchange="showPrice('+count+')"><option value="">--select item--</option>'+option+'</select></div></div><div class="col-md-4"><div class="form-group"><div class="form-line"><input type="text" class="form-control price amount'+count+'" placeholder="amount" name="amount[]" required="" ></div></div></div><div class="col-md-2"><div class="form-group form-float"><button type="button" class="btn btn-danger removeList" id="remove"  data-row="row' + count + '"  onclick="removeList()">-</button></div></div></div>';
$('#addRow').append(row);
count ++;
// $('.price').each(function() {
//                price.push($(this).val());
//             });
// console.log(price);
},
});  

// console.log('s');
// });

}

function removeList()
{
          // alert('ff');
          $(document).on('click', '.removeList', function() {
            var delete_rows = $(this).data("row");

            $('#' + delete_rows).remove();
          });
        }
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
              console.log(obj);
              if(obj.length>0)
              {
                var row;
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

// +obj[i].plan_id+','+obj[i].amount+','+validity+',\''+obj[i].name+'\'
function fill_detail(id,mobile,pincode,address,city,email,name)
{
  // $('.name').val(name);
  // console.log(mobile);
  $('#error_customer').hide();
  $('.search').val(''); 
  $('.customer_id').val(id);
  $('.mobile').val(mobile); 
  $('.name').val(name); 
  $('.address').val(address);
  $('.pincode').val(pincode);
  $('.city').val(city);
  // alert(name) ;
  $('.email').val(email); 
  // $('.f_name').addClass('focused');
  // $('.f_email').addClass('focused');
  // $('.f_number').addClass('focused');
  // $('.f_name').addClass('focused');
  $('#show_search_result').hide();

  $('#details').html("<tr><th>Name</th><th>Mobile</th><th>Email</th></tr><tr><td>"+name+"</td><td>"+mobile+"</td><td>"+email+"</td></tr>");

}
function total()
{
  var price;
  $('.price').each(function() {
   price.push($(this).val());
 });
// console.log(price);

}

function test_two(id)
{
  // $('#item1').attr('disabled',true);
  $('#error_item').hide();
  var item_id=$('#item'+id).val();
  if(item_id)
  {
    console.log(item_id);

    $("#item1 option[value="+item_id+"]").prop('disabled',true);
    $('.table_info').show();
// console.log(item_id);

$.ajax({
  type: "post",
  url: "<?= base_url() ?>item/fetch_amount",
  data:{item_id:item_id,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
  success: function (data) {
    var obj=JSON.parse(data);
    console.log(obj);
// alert(obj);
$('.amount'+id).val(obj.selling_price);

var new_row = '<tr id="row'+count+'">'+
'<td class="text-center"><input type="hidden" name="item_name[]" value="'+obj.item_name +'">'+obj.item_name +'</td>'+
'<td class="text-center"><input type="hidden" class="text-center" name="stock" readonly value="'+obj.qty_in_hand +'">'+obj.qty_in_hand +'  (<small class="small_unit">'+obj.unit+'</small>)</td>'+
'<td class="text-center">'+
'<input type="text" min=0 max="'+obj.qty_in_hand +'"  name="qty[]"   value="1"  onkeypress="return isNumberKey(event)"  onkeyup="changeQuantity('+count+')" class="text-center qty'+count+'" ><br><small class="small_unit">'+obj.unit+'</small><br><input type="checkbox" id="basic_checkbox_'+count+'" class="filled-in check'+count+'" name="check[]" value="1" onchange="fetch_serial_no('+count+',\''+obj.item_name+'\','+obj.id+')"  />'+
'<label for="basic_checkbox_'+count+'">serial Wise</label></td>'+

'<td class="text-center"><input type="text" class="form-control text-center discount'+count+'" name="discount[]" onkeyup="discount('+count+')" data-input-id="'+count+'" id="discount_id_'+count+'" max="100" min="0"></td>'+
'<td class="text-center"><input class="form-control text-center amount amount_item'+count+'" type="text" amount-id = "'+count+'" id="amount_'+count+'" value="'+obj.selling_price+'" name="item_price[]" ></td><input type="hidden" name="item_id[]" class="item_id" value="'+obj.id+'">'+
'<td class="text-center"><button type="button" id="'+count+'" onclick="deleteRow('+count+')" class="btn btn-danger delete_item"><i class="material-icons">delete</i></button></td>'+
'<input type="hidden" class="amount_hidden'+count+'" value="'+obj.selling_price +'" ><input type="hidden"  name="unit[]" value="'+obj.unit +'" ></tr>';

                          $(new_row).insertAfter($('table tr.dynamicRows:last'));
                          count++;
                // function changeQuantity(id)
                // {
                //     var amount=obj.selling_price;
                //      var qty=$('.qty'+id).val();
                //         if(qty>0)
                //                 {

                //                 var newAmount=qty*amount;
                //                 console.log(amount);
                //                 console.log(qty);
                //                 console.log(newAmount);
                //                 $('.amount_item'+id).val(newAmount);
                //                 }
                //               }
                total();
                
              },
            });
}
}
function total()
{
 var sum = 0;
 var total=0;
    // var tax=0.18;
    var subtotal=0;
    var taxTotal=0
    $(".amount").each(function(){
      sum += +$(this).val();
    });
    subtotal=$("#subTotal").html(sum);
    var tax=calculateTax(sum);
    // taxTotalDecimal=(parseInt(sum))*tax;
    var taxTotal=Math.round(tax);
    // console.log(taxTotal);
    $('#taxTotal').html(taxTotal);
    total=parseInt(sum)+parseInt(taxTotal);
    $('#grandTotal').val(total);
    // console.log(total);
    // console.log(sum);
          // var plan_name = $('.plan', b).text();
        }
        $(document).on("change", ".amount", function() {
         total();
       });

        function changeQuantity(id)
        {
          var qty= $('.qty'+id).val();
          var base_amount= $('.amount_hidden'+id).val();
          if(qty>0)
          {
           var discount= $('.discount'+id).val();
           var amount= qty*base_amount;
  // var amount=  qty*basic_amount;
  
  newAmount=amount-(amount*discount)/100;
  $('.amount_item'+id).val(newAmount);
  total();
}
}
function discount(id)
{

  var qty= $('.qty'+id).val();
  var discount= $('.discount'+id).val();
   // var amount= $('.amount_item'+id).val();
   var basic_amount= $('.amount_hidden'+id).val();
   // console.log('d'+discount);
   var amount= qty*basic_amount;

   newAmount=amount-(amount*discount)/100;
   $('.amount_item'+id).val(newAmount);
    // changeQuantity(id)
    total();
   // alert(newAmount);


 }
 function calculateTax(amo) {
  var total = 0;
  $.ajax({
    url: "<?= base_url() ?>account/get_tax",
    async: false,
    method: "GET",
    success: function(data) {

      var amount = amo;
      var obj = JSON.parse(data);

      for (var i = 0; i < obj.length; i++) {

        total += (Object.values(obj[i]) * amount) / 100;

      }
                // console.log(total);
              }
            });
  return total;
}

function deleteRow(id)
{
 $('#row'+id).remove();
 total();
}


function form_submit()
{
  console.log($('.item_id').val());
  var item_id=$('.item_id').val();
  var customer_id=$('.customer_id').val();
  var paid=$('.paid_amount').val();
  var payment_method= $('#method').val();
  // console.log(payment_method);
  // console.log(paid);
  if(!customer_id)
  {
    $('#error_customer').show();
    $('#error_customer').html("customer selection required");
  }
  else if(item_id=='' || item_id==null || item_id=='undefined' )
  {
    $('#error_customer').hide();
    $('#error_item').show();
    $('#error_item').html("item selection required");

  }
  else if(paid>0 && !payment_method)
  {
    
    alert("please select payment method");
    
  }

  
  else
  {
   document.getElementById("form_validation").action ="<?= base_url() ?>sales/add_sales";
   document.getElementById("form_validation").submit();

 } 
 
 
 



}
$(document).ready(function()
{
  $('.table_info').hide();

});

function fetch_serial_no(count,item_name,item_id)
{
// alert(count);
$('.otherPanel').show();
 if($('.check'+count).is(':checked'))
  {
$.ajax({
  type: "post",
  url: "<?= base_url() ?>sales/fetch_serial_no_item_wise",
  
  data:{item_id:item_id,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
  success: function (data) {
    var obj=JSON.parse(data);
      console.log(obj);
      if(obj.length>0)
      {
        var serial_row='';
        for(var i=0;i<obj.length;i++)
        {

          serial_row+='<input type="checkbox" id="serial'+i+count+item_id+'" class="filled-in serial'+count+'"  name="serial'+item_id+'[]" value="'+obj[i].serial_no+'" >'+
                                '<label for="serial'+i+count+item_id+'">'+obj[i].serial_no+'</label><br>'
        }
        $('.serial_no_display'+count).append('<div class="header">'+item_name+'</div><div class="body">'+serial_row+'</div>');
      }
      else
      {

        $('.serial_no_display'+count).html('<p>Currently this item is not in batch wise</p> ');
      }
  },
});
}

else{

$('.serial_no_display'+count).empty();
  
}

}
</script>
