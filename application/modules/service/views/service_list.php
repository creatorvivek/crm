


<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
       <?= $header ?>
        </h2>
        
      </div>
      <div class="body">
        
         <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover user_table dataTable">
          <thead>
            <tr>
             
              
              
              <th>Service Name</th>
               <th>Description</th> 
               <th>Amount</th>
               <th>Validity</th>
               <th>Action</th>
              <!-- <th></th>  -->
            
            </tr>
          </thead>
          <tbody>
            <?php foreach($service as $row) {  ?>
            <tr>
             
              <td><?= $row['service_name']; ?></td>
               <td><?= $row['description']; ?></td> 
               <td><?= $row['amount']; ?></td>
              
              <td><?= $row['validity']. '  '  .  $row['validity_unit'] ?> </td> 
               <td>
                                              <div class="btn-group" role="group">
                                              <a data-toggle="tooltip" title="Add Edit" href="<?= base_url() ?>service/service_edit/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">create</i></a>
                                             <!--  <a data-toggle="tooltip" title="Add Quantity" href="<?= base_url() ?>item/add_more_item/<?= $row['id'] ?> " class="btn btn-success waves-effect"><i class="material-icons">add</i></a> -->
                                            </div>
              </td>
            </tr>
            <?php }  ?>
          </tbody>
        </table>
      </div>
      </div>
    </div>
  </div>
</div>


      <!-- /.tab-pane -->
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
</script>