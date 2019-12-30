<style type="text/css">
  
.form-control{margin-bottom:0;width:100%;float:none}
  
</style>

<div class="form-group">
            <select class="form-control show-tick method" id="designation_id" name="designation" onchange="fetch_employee()" required>
              <option value="">--Select --</option>
              <?php 
              foreach($designation as $row): ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
              <?php endforeach; ?>
              
            </select>
            <span class="error"><?= form_error('designation');?></span>
          </div>
                    <p>
                        Name <span class="col-pink">*</span>
                    </p>
                    <div class="form-group">
                        <select class="form-control" id="staff_fetch" name="staff" >
                            <option value="">--Select --</option>
                            <option value="6">Anurag</option>

                        </select>
                        <span class="error"><?= form_error('staff');?></span>
                    </div>
       <script>             
    function fetch_employee()
    {

        var designation_id=$('#designation_id').val();

        $.ajax({
          type: "post",
          url: "<?= base_url() ?>staff/fetch_staff",
          data:{designation_id:designation_id,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
          success: function (data) {
            var obj=JSON.parse(data);
            var row='';
            for(var i=0;i<obj.length;i++)
            {
                row+='<option value="'+obj[i]['id']+'">'+obj[i]['name']+'</option>'    
            }
            console.log(row);
            $('#staff_fetch').html(row);    
        },
        error:function(data)
        {
                console.log('error');
        },
    });
    }

</script>