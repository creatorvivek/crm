<div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>ADD LEAVE CATEGORY</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>leave/add_leave_category">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="category_name" required="" aria-required="true" value="<?= $this->input->post('category_name'); ?>" >
                                        <label class="form-label">Leave Category Name <span class="col-pink">*</span></label>
                                        <span class="error"><?= form_error('category_name');?></span>
                                    </div>
                                </div>
                               
                                <button class="btn btn-primary waves-effect" type="submit">ADD</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>LEAVE CATEGORY LIST</h2>
                            
                        </div>
                       <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered  table-hover  dataTable">
                                    <thead>
                                        <tr>
                                         
                                            <th>S NO</th>
                                            <th>Category Name</th>
                                            <th>Action</th>
                                          </tr>
                                    </thead>
                                  
                                    <tbody>
                                      <?php 
                                      // $total=0;
                                      $count=1;
                                      foreach($leave_category as $row)
                                      { 

                                        ?>
                                        <tr id="<?= $row['id'] ?>">

                                                <td><?= $count++ ?></td>
                                                <td><?= $row['category_name'] ?></td>
                                                <td><a href="<?= base_url() ?>leave/update_leave_category/<?= $row['id'] ?>" class="btn btn-primary waves-effect" data-toggle="tooltip" data-placement="top" title="edit"><i class="material-icons">create</i></a>
                                                 <a href="#" onclick="delFunction(<?= $row['id'] ?>)"  class="btn btn-danger"><i class="material-icons">delete</i></a>   

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
         
              

<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>
 <script src="<?= base_url() ?>/assets/admin/plugins/sweetalert/sweetalert.min.js"></script>
 <!-- <script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script> -->
 <script type="text/javascript">
   $('#form_validation').validate({
        rules: {
            'checkbox': {
                required: true
            },
            'gender': {
                required: true
            }
        },
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
        url: "<?= base_url() ?>leave/remove_leave_category/"+id,
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