
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= $heading ?> LIST
                       <div class="card-tools pull-right">
                          <a href="<?= base_url('vendor/add_vendor'); ?>" class="btn btn-success">Add Vendor</a>
                        </div> 
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Vendor Company</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Gender</th>
                                            <th>Created date</th>
                                            <th>Action</th>
                                          
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                    	<?php foreach($vendor as $row)
                                    	{ ?>
                                        <!-- <tr id="<?= $row['id'] ?>"> -->
                                            <td><?= $row['name'] ?></td>
                                            <td><?= $row['company_name'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['mobile'] ?></td>
                                            <td><?= $row['gender'] ?></td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                <a href="<?= base_url() ?>vendor/update/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">create</i></a>
                                                 
                                                 <!--  <button type="button" class="btn btn-danger" onclick="delFunction(<?php echo $row['id'] ?>);" data-toggle="tooltip" data-placement="top" title="Delete"><i class="material-icons">delete</i></button> -->
                                            </div>
                                        </td>
                                           
                                        </tr>
                                        
                                       <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Jquery DataTable Plugin Js -->
      <!-- <script src="<?= base_url() ?>/assets/admin/plugins/sweetalert/sweetalert.min.js"></script> -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <!-- <script src="<?= base_url() ?>assets/admin/js/pages/tables/jquery-datatable.js"></script> -->
    <!--  <script type="text/javascript">
     	$(document).ready( function () {
    $('.js-basic-example').DataTable({
        responsive: true,
        "processing": true
    });
});
     </script> -->
<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

<script type="text/javascript">
  $(document).ready( function () {
    $('.js-basic-example').DataTable(
    {
      "processing": true
    });
  } );
</script>
     <script type="text/javascript">
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
        url: "<?= base_url() ?>staff/remove/"+id,
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