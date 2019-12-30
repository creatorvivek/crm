  
<style type="text/css">
  th
  {
    font-size: 14px;
    background-color:;
  }
  td
  {
   font-size: 13px;
 }
 .small_unit
 {
  font-size:12px;
}
#details
{
  font-size: 12px;
}

</style>




<form id="form_validation" method="POST"  action="<?= base_url() ?>purchase/purchase_order_edit/<?= $purchase_order['purchase_id'] ?>">
 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
 <div class="row clearfix">
  <div class="col-md-8">
    <div class="card">
      <div class="header" align="center">
        <h2><?php echo isset($heading)?$heading:'ADD PURCHASE' ?></h2>

      </div>
      <div class="body">
        <div class="row clearfix">
         <div class="col-md-6">
          <div class="form-group">
           <!-- <div class="form-line"> -->
            <select class="form-control" name="vendor_id" required=""  >
              <option value="" >--Select Vendor-- </option>
              <?php 
                foreach($vendor as $row)
                {
                  ?>

                  <option value="<?= $row['id'] ?>"  <?php if($purchase_order['vendor_id']==$row['id']){ echo  'selected'; }   ?>    ><?= $row['name'] ?></option>
                <?php   }

              ?>

            </select>
            <!-- </div> -->
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="text" class="form-control" name="vendor_invoice" value="<?= ($this->input->post('vendor_invoice') ? $this->input->post('vendor_invoice') : $purchase_order['vendor_invoice_id']); ?>"  aria-required="true">
              <label class="form-label">Vendor Invoice ID</label>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
           <!-- <div class="form-line"> -->
            <select class="form-control show-tick"   id="item1" aria-required="true" onchange="item_fetch(1)">
              <option value="" >--Select Item-- </option>
              <?php {
                foreach($item as $row)
                {
                  ?>

                  <option value="<?= $row['id'] ?>"><?= $row['item_name'] ?></option>
                <?php   }

              }?>

            </select>
            <!-- </div> -->
          </div>
        </div>
        <div class="col-md-4">
         <div class="form-group form-float">
          <div class="form-line">
            <input type="text" class="form-control datemask" required value="<?= ($this->input->post('purchase_date') ? $this->input->post('purchase_date') : $purchase_order['purchase_date']); ?>" readonly='true' id="date"  name="purchase_date"   placeholder="purchase date">
            <span class="error"><?= form_error('purchase_date');?></span>
            <label class="form-label">Purchase Date</label>
          </div>
        </div>
      </div>
         <!--  <div class="col-md-3">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="company_name" required="" aria-required="true">
                <label class="form-label">Item Company Name <span class="col-pink">*</span></label>
              </div>
            </div>
          </div> -->





      <!--     <div class="col-md-1">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control qty" name="qty" value=1 required=""  onkeyup="totalAmount();dynamicSerial()"  aria-required="true" onkeypress="return isNumberKey(event)" >
                <label class="form-label">Quantity <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control purchase_amount" name="purchase_amount" required="" aria-required="true" onkeyup="totalAmount()" onkeypress="return isNumberKey(event)" maxlength="10">
                <label class="form-label">Purchase Amount(unit) <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="selling_amount" required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                <label class="form-label">Selling Amount <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group form-float">
              <div class="form-line placeholder">
                <input type="text" class="form-control total_amount" name="total_amount" required=""  aria-required="true" onkeypress="return isNumberKey(event)" >
                <label class="form-label">Total <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>
            <div class="col-md-1">
              <button type="button" class="btn btn-info add_row">+</button>
            </div>
              <div class="col-md-12 add_new_row"></div>
          <div class="col-md-12">
           <div class="form-group">
            <div class="form-line">
             <input type="checkbox" id="basic_checkbox_2" class="filled-in check" name="check" value="1" onchange="dynamicSerial()"  />
             <label for="basic_checkbox_2">Write serial and model no</label>
           </div>
         </div>
       </div> -->
       <div class="row">
        <div class="col-md-12">
          <!-- /.box-header -->
          <!-- <div class="box-body no-padding"> -->
            <div class="table-responsive">
              <table class="table table-bordered table_info" id="purchaseInvoice">
                <tbody>

                  <tr class="dynamicRows">
                    <th width="10%" class="text-center">ITEM NAME</th>
                    <th width="10%" class="text-center">QUANTITY</th>
                    <th width="10%" class="text-center">PURCHASE AMOUNT</th>
                    <th width="10%" class="text-center">SELLING AMOUNT</th>
                    <!-- <th width="20%" class="text-center">TAX(%)</th> -->


                    <!-- <th width="15%" class="text-center">TAX(%)</th> -->
                    <!-- <th width="10%" class="text-center">{{ trans('message.table.tax') }}({{Session::get('currency_symbol')}})</th> -->
                    <!-- <th width="10%" class="text-center">DISCOUNT(%)</th> -->
                    <th width="10%" class="text-center">AMOUNT</th>
                    <th width="5%"  class="text-center">ACTION</th>
                  </tr>

                  <tr class="tableInfo"><td colspan="4" align="right"><strong>Sub total</strong></td><td align="left" colspan="2"><strong id="subTotal"></strong></td>
                  </tr>

                  <tr class="tableInfo"><td colspan="4" align="right"><strong>Total Tax</strong></td><td align="left" colspan="2"><strong id="taxTotal"></strong></td>
                  </tr>
                  <tr class="tableInfo"><td colspan="4" align="right"><strong>Total</strong></td><td align="left" colspan="2"><input type='text' name="total_amount" class="form-control" id ="grandTotal" readonly></td></tr>

                </tbody>
              </table>
            </div>
            <br><br>
            <!-- </div> -->
          </div>
          <!-- /.box-body -->
          <div class="col-md-12">

          </div>
        </div>

        <div class="col-md-12">
         <button class="btn btn-info" type="submit">Submit</button>
       </div>
     </div>
   </div>
 </div>
</div>





<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 otherPanel">
 <div class="card mod1"  style="overflow-y: scroll;max-height: 700px;">
  <div class="newRow1"></div>
</div>


<div class="card mod2" style="overflow-y: scroll;max-height: 700px;display:none;">
<div class="newRow2"></div>
</div>
<div class="card mod3" style="overflow-y: scroll;max-height: 700px;display:none;">
<div class="newRow3"></div>
</div>
<div class="card mod4" style="overflow-y: scroll;max-height: 700px;display:none;">
<div class="newRow4"></div>
</div>
<div class="card mod5" style="overflow-y: scroll;max-height: 700px;display:none;">
<div class="newRow4"></div>
</div>
<!-- <div class="newRow5"></div>
<div class="newRow6"></div>
<div class="newRow7"></div>
<div class="newRow8"></div>
<div class="newRow9"></div>
<div class="newRow10"></div>
<div class="newRow11"></div>
<div class="newRow12"></div>
<div class="newRow13"></div>
<div class="newRow15"></div> -->

</div>
</div>
</form>
</div>

<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

<script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script>

<script src="<?= base_url() ?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  $(document).ready(function()
  {
    // $('.table_info').hide();
    fetch_ordered_item();
  });



  $( ".datemask" ).datepicker({
     //    flat: true,
     //   date: '2008-07-31',
     // current: '2008-07-31',
     dateFormat: "dd-mm-yy",
     changeMonth: true,
     changeYear: true,
     // yearRange: '1950:2012'
     maxDate: "+0d",
     // shortYearCutoff: 50
     // minDate: "-2m"
     // constrainInput: false


   });


  var count=1;
  var price=[];
  function dynamicSerial(count,item_name,item_id)
  {
  
  var line='<div class="body">'+
  '<div class="col-md-12" align="center">'+item_name+'</div>'+
  '<div class="col-md-6">'+
  '<div class="form-group form-float">'+
  '<div class="form-line ps">'+
  '<input type="text" class="form-control " name="serial_number'+item_id+'[]" required="" aria-required="true">'+
  '<label class="form-label">Serial no.</label>'+
  '</div>'+
  '</div>'+
  '</div>'+
  '<div class="col-md-6">'+
  '<div class="form-group form-float">'+
  '<div class="form-line ps">'+
  '<input type="text" class="form-control" name="model_number'+item_id+'[]" required="" aria-required="true">'+
  '<label class="form-label">Model no.</label>'+
  '</div>'+
  '</div>'+
  '</div></div>';
  $('.newRow'+count).empty();
  // console.log(line);
  var qty=$('.qty'+count).val();
  // console.log(qty);
  if($('.check'+count).is(':checked'))
  {

    // console.log(qty);
    for(var i=0;i<qty;i++)
    {
      $('.mod'+count).show();
      $('.newRow'+count).append(line);
      $(".ps").addClass("focused");
    }
  }
  else
  {
    $('.mod'+count).hide();
    // $('.otherPanel').hide();
    $('.newRow'+count).empty();
  }


} 


function totalAmount()
{ 
  var purchase_amount=$('.purchase_amount').val();
  var qty=$('.qty').val();
  var total_purchase=purchase_amount*qty;
  $('.total_amount').val(total_purchase);
  $(".placeholder").addClass("focused");

}



function item_fetch(id)
{
  // $('#item1').attr('disabled',true);
  $('#error_item').hide();
  var item_id=$('#item'+id).val();
  if(item_id)
  {
    // console.log(item_id);/

    $("#item1 option[value="+item_id+"]").prop('disabled',true);
    $('.table_info').fadeIn();
// console.log(item_id);

$.ajax({
  type: "post",
  url: "<?= base_url() ?>item/fetch_item_detail",
  data:{item_id:item_id,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
  success: function (data) {
    var obj=JSON.parse(data);
   
var new_row = '<tr id="row'+count+'">'+
'<td class="text-center"><input type="hidden" name="item_id[]" value="'+obj.id +'"><input type="hidden" name="item_name[]" value="'+obj.item_name +'">'+obj.item_name +'</td>'+

'<td class="text-center">'+
'<input type="text" class="form-control qty'+count+'" name="qty[]"   value="1"  onkeypress="return isNumberKey(event)"  onkeyup="changeQuantity('+count+')" class="text-center qty'+count+'" ><small class="small_unit">'+obj.unit+'</small><br><input type="checkbox" id="basic_checkbox_'+count+'" class="filled-in check'+count+'" name="check[]" value="1" onchange="dynamicSerial('+count+',\''+obj.item_name+'\','+obj.id+')"  />'+
'<label for="basic_checkbox_'+count+'">Write serial and model no</label></td><td class="text-center"><input class="form-control purchase_amount'+count+'"  type="text" name="purchase_amount[]" onkeyup="changeQuantity('+count+')" ></td>'+
'<td class="text-center"><input type="text" class="form-control" name="selling_amount[]" >'+
'<td class="text-center"><input class="form-control amount amount_item'+count+'" type="text" name="amount[]" ></td><td class="text-center"><button type="button" id="'+count+'" onclick="deleteRow('+count+')" class="btn btn-danger delete_item"><i class="material-icons">delete</i></button></td><tr>';


$(new_row).insertAfter($('table tr.dynamicRows:last'));
count++;
total();
// ,\''+obj[i]['address']+'\'


//                           '<td class="text-center"><input type="text" class="form-control text-center discount'+count+'" name="discount[]" onkeyup="discount('+count+')" data-input-id="'+count+'" id="discount_id_'+count+'" max="100" min="0"></td>'+
//                           '<td class="2text-center"><input class="form-control text-center amount amount_item'+count+'" type="text" amount-id = "'+count+'" id="amount_'+count+'" value="'+obj.selling_price+'" name="item_price[]" ></td><input type="hidden" name="item_id[]" class="item_id" value="'+obj.id+'">'+
//                           '<td class="text-center"><button type="button" id="'+count+'" onclick="deleteRow('+count+')" class="btn btn-danger delete_item"><i class="material-icons">delete</i></button></td>'+
//                           '<input type="hidden" class="amount_hidden'+count+'" value="'+obj.selling_price +'" ><input type="hidden"  name="unit[]" value="'+obj.unit +'" > '

//                           '</tr>';

},
});
}
}
function changeQuantity(id)
{
  var amount=$(".purchase_amount"+id).val();
  // console.log(amount);
  var qty=$('.qty'+id).val();
  // console.log(qty);
  if(qty>0)
  {

    var newAmount=qty*amount;
    // console.log(amount);
    // console.log(qty);
    // console.log(newAmount);
    $('.amount_item'+id).val(newAmount);
    total();
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

//         function changeQuantity(id)
//         {
//           var qty= $('.qty'+id).val();
//           var base_amount= $('.amount_hidden'+id).val();
//           if(qty>0)
//           {
//            var discount= $('.discount'+id).val();
//            var amount= qty*base_amount;
//   // var amount=  qty*basic_amount;

//   newAmount=amount-(amount*discount)/100;
//   $('.amount_item'+id).val(newAmount);
//   total();
// }
// }

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




function removeList()
{
          // alert('ff');
          $(document).on('click', '.removeList', function() {
            var delete_rows = $(this).data("row");

            $('#' + delete_rows).remove();
          });
        }


        function deleteRow(id)
        {
         $('#row'+id).remove();
         total();
       }

function fetch_ordered_item()
{
$.ajax({
  type: "post",
  url: "<?= base_url() ?>item/fetch_order_item_details",
  data:{purchase_id:<?= $purchase_order['purchase_id'] ?>,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
  success: function (data) {
    var obj=JSON.parse(data);
    console.log(obj);
    var new_rows='';
    var count=1;
   for(var it=0;it<obj.length;it++)
   {
  new_rows += '<tr id="row'+count+'">'+
'<td class="text-center"><input type="hidden" name="purchase_details_id[]" value="'+obj[it].id +'" <input type="hidden" name="item_id[]" value="'+obj[it].item_id +'"><input type="hidden" name="item_name[]" value="'+obj[it].item_name +'">'+obj[it].item_name +'</td>'+
'<td class="text-center">'+
'<input type="text" class="form-control qty'+count+'" name="qty[]"   value="1"  onkeypress="return isNumberKey(event)"  onkeyup="changeQuantity('+count+')" class="text-center qty'+count+'" ><small class="small_unit">'+obj[it].measurement_unit+'</small><br><input type="checkbox" id="order_checkbox_'+count+'" class="filled-in check'+count+'" name="check[]" value="1" onchange="dynamicSerial('+count+',\''+obj[it].item_name+'\','+obj[it].item_id+')"  />'+
'<label for="order_checkbox_'+count+'">Write serial and model no</label></td><td class="text-center"><input class="form-control purchase_amount'+count+'"  type="text" name="purchase_amount[]"  value="'+obj[it].purchase_price+'" onkeyup="changeQuantity('+count+')" ></td>'+
'<td class="text-center"><input type="text" class="form-control" name="selling_amount[]" value="'+obj[it].selling_price+'" >'+
'<td class="text-center"><input class="form-control amount amount_item'+count+'" value="'+obj[it].amount+'" type="text" name="amount[]" ></td><td class="text-center"><button type="button" id="'+count+'" onclick="deleteRow('+count+')" class="btn btn-danger delete_item"><i class="material-icons">delete</i></button></td><tr>';
$(new_rows).insertAfter($('table tr.dynamicRows:last'));
count++;
}

// count++;
total();


}
});
}

     </script>