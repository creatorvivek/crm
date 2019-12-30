<div class="row clearfix">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2 align="center">
        ADD CATEGORY
        
        </h2>
        
      </div>
      <div class="body">
        <?= form_open('category/add',array("class"=>"form-horizontal","id"=>"form_validation")); ?>
        <div class="col-md-12">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="text" id="name" name="name" class="form-control" required onkeypress="return isAlpha(event)" >
              <label class="form-label">Category Name</label>
            </div>
          </div>
        </div>
        <!-- <div class="form-group">
          <label for="category" class="col-md-4 control-label"><span class="text-danger">*</span>Select Parent Category</label>
          <div class="col-md-3">
            <select name="paraent_cat_id" class="form-control">
              <option value="0"> no parent category</option>
            </select>
            <span class="text-danger name_error"></span>
          </div>
        </div> -->
        <div class="col-md-12">
         <!--  <p>
            <b>Parent Category</b>
          </p> -->
          <div class="form-group">
          <select class="form-control show-tick" name="category_id" required>

            <option value=""> --select category--</option>
            <option value="0"> no parent category</option>
            <?php  foreach($category as $row)
            { ?>
            <option value="<?= $row['category_id'] ?>" > <?= $row['name'] ?></option>
            <?php } ?>
            
          </select>
        </div>
        </div>
        <button class="btn btn-info">Add</button>
        <?= form_close() ?>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
        CATEGORY LIST
        <!-- <div class="card-tools pull-right">
                          <a href="<?= base_url('category/add_category'); ?>" class="btn btn-success">Add Category</a>
                        </div>  -->
        </h2>
        
      </div>
      <div class="body">
        
         <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover user_table dataTable">
          <thead>
            <tr>
              <!-- <th>Ticket id</th> -->
              <th>#S No</th>
              <th>Name</th>
              <th>Action</th>
             
          
            </tr>
          </thead>
          <tbody>
            <?php foreach($category as $row){ ?>
            <tr id="<?= $row['id'] ?>">
              
              <td><?= $row['category_id']; ?></td>
              <td><?= $row['name']; ?></td>
              <td><a href="<?= base_url() ?>category/category_edit/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">create</i></a></td>
          
            
               
               <!--  <td>
                  
                  <div class="btn-group" role="group">
                    <a href="<?= base_url() ?>ticket/add_ticket?crn=<?= $row['id'] ?>&name=<?= $row['name'] ?>&mobile=<?= $row['mobile'] ?>&email=<?= $row['email'] ?>" data-toggle="tooltip" data-placement="top" title="generate ticket" class="btn btn-info"><i class="material-icons">assignment</i></a>
                    <a href="<?= base_url() ?>crn/update/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">create</i></a>
                    <a href="<?= base_url() ?>crn/customer_info/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">explore</i></a>
                    
                    <button type="button" class="btn btn-danger" onclick="delFunction(<?php echo $row['id'] ?>);" data-toggle="tooltip" data-placement="top" title="Delete"><i class="material-icons">delete</i></button>
                  </div>
                  
               
              </td> -->
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      </div>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2 align="center">
      CATEGORY TREE
        
        </h2>
        
      </div>
      <div class="body">
    <div  id="treeview_json">
      </div>
    </div>
  </div>
</div>
</div>


      <!-- /.tab-pane -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />
  
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
     <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
$(document).ready( function () {
$('.user_table').DataTable(
{
 
// "processing": true
});
} );
 function delFunction(id)
        {
     swal({
      title: "Are you sure?", 
      text: "Are you sure that you want to delete this id?", 
      type: "warning",
      showCancelButton: true,
      closeOnConfirm: false,
      confirmButtonText: "Yes, delete it!",
      confirmButtonColor: "#ec6c62"
    }, function() {
      $.ajax({
        url: "<?= base_url() ?>crn/remove/"+id,
        type: "DELETE"
      })
      .done(function(data) {
        swal("Deleted!", "Your file was successfully deleted!", "success");
         $('#'+id+'').fadeOut(300);
      })
      .error(function(data) {
        swal("Oops", "We couldn't connect to the server!", "error");
      });
    });
  }


  $(document).ready(function(){
  
   var treeData;
   
   $.ajax({
        type: "GET",  
        url: "<?= base_url() ?>category/getItem",
        dataType: "json",       
        success: function(response)  
        {
           initTree(response)
        }   
  });
    
  function initTree(treeData) {
    $('#treeview_json').treeview({data: treeData});
  }
   
});
</script>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

  <script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script>