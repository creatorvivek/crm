
<div class="row clearfix">
        <div class="card">
            <div class="body bg-danger">
                    code used for ticket module -> {name} ,{ticket_id}  <br>
                    code used for user credential-> {username} ,{password}, {url}.
            </div>
        </div>





</div>




<div class="row clearfix">
    <form action="<?= base_url() ?>setting/email_template_update" method="post">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
    <?php for($i=0;$i<count($template);$i++) 
     { ?>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Module  -  :  <?= $template[$i]['module'] ?>
                               
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                      <div class="form-line">
                                        <input type="text" class="form-control" name="subject[]" required="" aria-required="true" value="<?= $template[$i]['subject'] ?>" >
                                        <label class="form-label">Subject</label>
                                      </div>
                                    </div>
                            <textarea id="ckeditor<?= $i ?>" name="body[]">
                               <?= $template[$i]['context'] ?>
                            </textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id[]" value="<?= $template[$i]['id']  ?>">
        <?php } ?>
        <button type="submit" class="btn btn-info">Update</button>
    </form>
            </div>
           
                 <script src="<?= base_url() ?>assets/admin/plugins/ckeditor/ckeditor.js"></script>
                 <script type="text/javascript">
                    var count="<?= count($template) ?>";
                     $(function()
                     {
                        for(var j=0;j<count;j++)
                        {
                        // console.log($('#ckeditor').val());
                         CKEDITOR.replace('ckeditor'+j);
    CKEDITOR.config.height = 200;
                        }
                     });

                 </script>
          