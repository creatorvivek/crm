<div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>ADD DESIGNATION</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>staff/add_designation">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="designation_name" required="" aria-required="true" value="<?= $this->input->post('designation_name'); ?>" >
                                        <label class="form-label">Designation Name <span class="col-pink">*</span></label>
                                        <span class="error"><?= form_error('designation_name');?></span>
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
                            <h2>DESIGNATION  LIST</h2>
                            
                        </div>
                       <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered  table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                         
                                            <th>#S No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                          </tr>
                                    </thead>
                                  
                                    <tbody>
                                      <?php 
                                      // $total=0;
                                      $count=1;
                                      foreach($designation as $row)
                                      { 

                                        ?>
                                        <tr>

                                                <td><?= $count++ ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><a href="<?= base_url() ?>staff/designation_update/<?= $row['id'] ?>" class="btn btn-primary waves-effect" data-toggle="tooltip" data-placement="top" title="edit"><i class="material-icons">create</i></a></td>
                                                
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
         
  <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?= base_url() ?>assets/admin/js/pages/tables/jquery-datatable.js"></script>            

<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

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
 </script>