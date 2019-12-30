


<div class="row clearfix">
  <div class="col-lg-8 col-md-8    col-sm-12 col-xs-12">
    <div class="card">
      <div class="header" align="center">
        <h2><?php echo isset($heading)?$heading:'ADD ITEM' ?></h2>
        
      </div>
      <div class="body">
        <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>item/edit_item/<?= $item['id'] ?>">
           <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
           <div class="row clearfix">
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="name" required="" aria-required="true" value="<?= ($this->input->post('name') ? $this->input->post('name') : $item['item_name']); ?>">
                <label class="form-label">Item Name <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>
         
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <textarea class="form-control" name="description" required><?= ($this->input->post('description') ? $this->input->post('description') : $item['description']); ?></textarea>
                <label class="form-label">Discription <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>
 
         <div class="col-md-6">
          
            <div class="form-group" >
              <select class="form-control show-tick" id="category_select" name="category_id" required="">
               <option value="">Select Category </option>
              <?php  foreach($category as $row)
            { ?>
             
            <option value="<?= $row['category_id'] ?>" <?= ($item['category']==$row['category_id'])?"selected":""?> > <?= $row['name'] ?></option>
           
             <?php   }
                ?>
              
                
              </select>
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

                    <option value="<?= $row['symbol'] ?>" <?php if($row['symbol']==$item['measurement_unit']) { echo "selected";}  ?> ><?= $row['symbol'] ?></option>
                  <?php   }

                }?>

              </select>
             
            </div>
          </div>
            <div class="col-md-4">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="company_name" required="" aria-required="true" value="<?= ($this->input->post('company_name') ? $this->input->post('company_name') : $item['company_name']); ?>">
                <label class="form-label">Item Company Name <span class="col-pink">*</span></label>
              </div>
            </div>  
          </div>

          <div class="col-md-4">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="hsn" required="" aria-required="true" value="<?= ($this->input->post('hsn') ? $this->input->post('hsn') : $item['hsn']); ?>" >
                <label class="form-label">Hsn number</label>
              </div>
            </div>
          </div>
           <div class="col-md-4">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="selling_price" value="<?= ($this->input->post('selling_price') ? $this->input->post('selling_price') : $item['selling_price']); ?>"   required="" aria-required="true" onkeypress="return isNumber(event)" >
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
          <!-- <div class="col-md-12">
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
        </div> -->
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




<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

<script type="text/javascript">

  $(document).ready( function () {

         // fetch_category();
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
  $.ajax({
type: "post",
url: "<?= base_url() ?>category/add",
data:{category_id:category_id,name:category_name,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
success: function (data) {
  // $('#customerModal').hide();
  // fetch_category();
 location.reload();

},
});
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

















