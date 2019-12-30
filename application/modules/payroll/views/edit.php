<div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>UPDATE LEAVE CATEGORY</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>leave/update_leave_category/<?= $category_name['id'] ?> ">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="category_name" required="" aria-required="true" value="<?= $this->input->post('category_name')?$this->input->post('category_name'):$category_name['category_name'] ?>" >
                                        <label class="form-label">Leave Category Name <span class="col-pink">*</span></label>
                                        <span class="error"><?= form_error('category_name');?></span>
                                    </div>
                                </div>
                               
                                <button class="btn btn-primary waves-effect" type="submit">UPDATE</button>
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
                                          </tr>
                                    </thead>
                                  
                                    <tbody>
                                      <?php 
                                      // $total=0;
                                      $count=1;
                                      foreach($leave_category as $row)
                                      { 

                                        ?>
                                        <tr>

                                                <td><?= $count++ ?></td>
                                                <td><?= $row['category_name'] ?></td>
                                                
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