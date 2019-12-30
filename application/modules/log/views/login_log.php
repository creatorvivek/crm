


<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
    
      <div class="header">
                            <h2>
                               LOGIN LOG
                       <div class="card-tools pull-right">
                         <a href="<?= base_url() ?>log/delete_login_log" class="btn btn-danger">DELETE ALL</a>
                        </div> 
                            </h2>
                            
                        </div>
      <div class="body">
        
         <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover user_table dataTable">
          <thead>
            <tr>
             
              
              
              <th>USERNAME</th>
               <th>IP ADDRESS</th> 
               <th>STATUS</th>
              <th>LOGIN TIME</th> 
              <th>LOGOUT TIME</th> 
            
            </tr>
          </thead>
          <tbody>
            <?php foreach($log as $row) {  ?>
            <tr>
             
              <td><?= $row['username']; ?></td>
               <td><?= $row['ip_address']; ?></td> 
               <td><?= $row['status']; ?></td>
            
              <td><?= $row['date']; ?></td> 
              <td><?= $row['logout_time']; ?></td> 
               
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