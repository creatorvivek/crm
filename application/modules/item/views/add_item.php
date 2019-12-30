<div class="row clearfix">
  <div class="col-lg-8 col-md-8    col-sm-12 col-xs-12">
    <div class="card">
      <div class="header" align="center">
        <h2><?php echo isset($heading)?$heading:'ADD ITEM' ?></h2>
        
      </div>
      <div class="body">
        <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>item/add_item_process">
           <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
           <div class="row clearfix">
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="name" required="" aria-required="true" >
                <label class="form-label">Item Name <span class="col-pink">*</span></label>
                <span class="error"><?= form_error('name');?></span>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <textarea class="form-control" name="description" required></textarea>
                <label class="form-label">Description <span class="col-pink">*</span></label>
                <span class="error"><?= form_error('description');?></span>
              </div>
            </div>
          </div>
         
         <div class="col-md-6">
          
            <div class="form-group" >
              <select class="form-control show-tick" id="category_select" name="category_id" required="" onchange="addCategoryModal()">
               
               <!--  <option value=""> --select category--</option> 

               
                <?php  foreach($category as $row)
                { ?>
                <option value="<?= $row['category_id'] ?>" > <?= $row['name'] ?></option>
                <?php } ?> 
                 <option value="default"> -- ADD CATEGORY-- </option>  -->
              
                
              </select>
              <span class="error"><?= form_error('category_id');?></span>
            </div>
          </div>
            <div class="col-md-6">
            <div class="form-group form-float">
             
               <select class="form-control show-tick" name="unit" required="" aria-required="true" >
                <option value="">--select measurement unit--</option>
              
                <?php {
                  foreach($measurement_unit as $row)
                  {
                    ?>

                    <option value="<?= $row['symbol'] ?>"><?= $row['symbol'] ?></option>
                  <?php   }

                }?>

              </select>
             <span class="error"><?= form_error('unit');?></span>
            </div>
          </div>
            <div class="col-md-4">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="company_name" required="" aria-required="true">
                <label class="form-label">Item Company Name <span class="col-pink">*</span></label>
                <span class="error"><?= form_error('company_name');?></span>
              </div>
            </div>  
          </div>

          <div class="col-md-4">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="hsn" required="" aria-required="true" >
                <label class="form-label">Hsn number</label>
                  <span class="error"><?= form_error('hsn');?></span>
              </div>
            </div>
          </div>
           <div class="col-md-4">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="selling_price" required="" aria-required="true" onkeypress="return isNumber(event)" >
                <label class="form-label">Selling Price </label>
              </div>
            </div>
          </div>
          <!-- <div class="col-md-4">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="snp" required="" aria-required="true" >
                <label class="form-label">Hsn number</label>
              </div>
            </div>
          </div> -->
          <div class="col-md-12">
           <div class="form-group">
           <input type="checkbox" id="basic_checkbox_2" class="filled-in check" name="check" value="1"  onclick="showOption()"   />
             <label for="basic_checkbox_2">opening stock ?</label>
           </div>
       </div>
       <div id="show_option">
        <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="opening_stock" required="" aria-required="true">
                <label class="form-label">Opening stock <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="stock_value" required="" aria-required="true" onkeypress="return isNumber(event)" >
                <label class="form-label">Opening stock value(per unit)</label>
              </div>
            </div>
          </div>
        </div>
          <div class="col-md-12" align="center">
          <!-- <div class="form-group"> -->
          <button class="btn btn-primary waves-effect" align="center" type="submit">SUBMIT</button>
        </div>
      </div>
        <!-- </div> -->
        </form>
      </div>
    </div>
  </div>


 
</div>


<!-- modal start -->
  <div class="modal fade" id="customerModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ADD NEW CATEGORY</h4>
          <!-- <p>Invoice-id - <?= $invoice[0]['invoice_id'] ?></p> -->
        </div>
        <div class="modal-body">

              <div class="body">
       <div class="msg_alert col-red"></div>
        <div class="col-md-12">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="text" id="cat_name" name="name" class="form-control" required="" onkeypress="return checkSpcialChar(event)" >
              <label class="form-label">Category Name <span class="col-pink">*</span></label>
            </div>
          </div>
        </div>
        <br><br>
        
        <div class="col-md-12">
         <!--  <p>
            <b>Parent Category</b>
          </p> -->
          <div class="form-group">
          <select class="form-control show-tick" name="category_id" id="category_id" required>

            <option value=""> --select category--</option>
            <option value="0"> no parent category</option>
            <?php  foreach($category as $row)
            { ?>
            <option value="<?= $row['category_id'] ?>" > <?= $row['name'] ?></option>
            <?php } ?>
            
          </select>
        </div>
        </div>
        <button class="btn btn-info" onclick="addCategory()">Add</button>
        
      </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

<script type="text/javascript">

  $(document).ready( function () {

         fetch_category();
         $('#show_option').hide();
  });


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


 function fetch_category()
 {
 $.get("<?= base_url()?>category/call",function(data)
 {
  console.log(data);
  var start='<option value=""> --select category--</option>'
  var end='<option value="default"> -- ADD CATEGORY-- </option>'
    
  // var obj=JSON.parse(data);
  //   console.log(obj[0].category_id);
  // var row='';
  // for(var i=0;i<obj.length;i++)
  // {
  //       row += "<option value="+obj[i].category_id+">"+obj[i].name+"</option>";
  // }
  //   console.log(row);
   $('#category_select').html(start+data+end);
 });

 }
function addCategoryModal()
{
  // alert();
  var i=$('#category_select').val();
  // console.log(i);
  // alert("d");
  if($('#category_select').val()=='default')
  {
  $('#customerModal').modal();
  $('#customerModal').show();
}
}

function addCategory()
{
  var category_name = $('#cat_name').val();
  var category_id = $('#category_id').val();
if(category_name && category_id)
{
  $.ajax({

type: "post",
url: "<?= base_url() ?>category/add",
data:{category_id:category_id,name:category_name,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
success: function (data) {
  // $('#customerModal').hide();
  // fetch_category();
   $('#customerModal').modal('hide');
 fetch_category();

},
});
}
 else{
  $('.msg_alert').html('fill both fields are mendatory');
  $('.msg_alert').fadeOut(5000);

 } 
}


function showOption()
{
// $('#show_option').show();
 if($('.check').is(':checked'))
  {
$('#show_option').fadeIn();
}
else
{
$('#show_option').fadeOut();

}


}


</script>