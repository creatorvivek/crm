

<div class="row">

  <div class="col-md-5">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Frenchise Setting</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <?= form_open('setting/add',array("class"=>"form-horizontal","id"=>"form")) ?>
        <div class="row">
        <div class="col-md-5">
          <label for="ticket" class="col-md-12 control-label"><span class="text-danger">*</span>GST Number</label>
          <div class="form-group">
            <input type="text" name="gst_number" maxlength="15" class="form-control" id="gst_number" required  autofocus />
            <span class="text-danger name_error"></span>
          </div>
        </div>
       
        <div class="col-md-5">
          <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Bank Account No.</label>
          <div class="form-group">
            <input type="text" name="bank_account"  class="form-control" />
            <span class="text-danger nas_error"></span>
          </div>
        </div>
        <div class="col-md-10">
          
          <div class="checkbox">
            <div class="form-group">
            <label><input type="checkbox" name="isp_license"  value="1">&nbsp Have Isp License</label>
          </div>
          </div>
        </div>  
          <div class="col-md-5">
            <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Billing Cycle</label>
            <div class="form-group">
              <input type="text" name="billing_cycle" data-toggle="tooltip" title="Enter date in which billing is occure" class="form-control" id="billing_cycle" onkeyup="date_chk()" />
              <span class="text-danger billing_error"></span>
            </div>
          </div>
           <div class="col-md-5">
            <label for="task" class="col-md-12 control-label"><span class="text-danger">*</span>Customer Care Number</label>
            <div class="form-group">
              <input type="text" name="customer_care" data-toggle="tooltip" title="Enter customer care number" class="form-control" id="customer_care" />
              <span class="text-danger billing_error"></span>
            </div>
          </div>
           <div class="col-md-5">
          <label for="ticket" class="col-md-12 control-label"><span class="text-danger">*</span>Tax Name</label>
          <div class="form-group">
            <input type="text"   class="form-control tax_name" id="tax_name" required    data-toggle="tooltip" title="example: 9" />
            <span class="text-danger name_error"></span>
          </div>
        </div>
         <div class="col-md-5">
          <label for="ticket" class="col-md-12 control-label"><span class="text-danger">*</span>Tax (%)</label>
          <div class="form-group">
            <input type="text"  class="form-control tax_percent" id="tax_percent" required   data-toggle="tooltip" title="example: 9" />
            <span class="text-danger name_error"></span>
          </div>
        </div>
        <div class="col-md-2">
          <label for="ticket" class="col-md-12 control-label"></label>
          <div class="form-group">
            <button type="button" class="btn btn-success add_tax">+</button>
            <span class="text-danger name_error"></span>
          </div>
        </div>
        <div  class="col-md-12" id="addRowsId"></div>
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header">
              <h3 class="card-title">
                Frenchise Terms and condition
               
              </h3>
             <!--  tools box
             <div class="card-tools">
               <button type="button" class="btn btn-tool btn-sm"
                       data-widget="collapse"
                       data-toggle="tooltip"
                       title="Collapse">
                 <i class="fa fa-minus"></i>
               </button>
               <button type="button" class="btn btn-tool btn-sm"
                       data-widget="remove"
                       data-toggle="tooltip"
                       title="Remove">
                 <i class="fa fa-times"></i>
               </button>
             </div>
             /. tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="mb-3">
                <textarea id="terms" name="terms" style="width: 100%"></textarea>
              </div>
             
            </div>
          </div>
          <!-- /.card -->
</div>
<!-- /.row inside card -->
<input type="hidden" name="tax_name"  id="t_name">
<input type="hidden" name="tax_percent"  id="t_percent">

        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-5">
            <button type="submit" class="btn btn-success save">Save</button>
          </div>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
<script type="text/javascript">
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
  var tax_coloumn=' <div id="row'+count+'" class="row"><div class="col-md-5" ><div class="form-group"><input type="text"  maxlength="15" class="form-control tax_name" id="tax_name" required  data-toggle="tooltip" title="example: 9" /></div></div><div class="col-md-5"><div class="form-group"><input type="text"  maxlength="15" class="form-control tax_percent" id="tax_percent" required   data-toggle="tooltip" title="example: 9" /></div></div><div class="col-md-2"><button type="button" data-row="row'+count+'" class="btn btn-danger remove">-</div>';
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
// console.log(tax_name);

$('#t_name').val(tax_name);
$('#t_percent').val(tax_percent);
// $('#tax_percent').val(t_percent);

});





  </script>
  <!-- CK Editor -->
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

    $('.textarea').wysihtml5({
      toolbar: { fa: true }
    })
  })
</script>