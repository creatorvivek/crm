
<div class="row clearfix">
  <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
          <div class="row">
            <div class="col-md-6">
              Issue and solution
            </div>
            <?= form_open('task/issue_list',array('id'=>'form_validation')) ?>
            <!-- <p>select category</p> -->

            <div class="col-md-4">
              <div class="form-group">
                <select class="form-control show-tick category" id="category" name="category" required>
                  <option value="">--Select category--</option>
                  <?php foreach($issue_category as $row) {  ?>

                   <option value="<?= $row['id'] ?>"><?= $row['category_name'] ?></option>
                 <?php   } ?>
               </select>
             </div>
           </div>
           <div class="col-md-2">
            <button type="submit" class="btn btn-default waves-effect">
              <i class="material-icons">search</i>
            </button>
          </div>
          <?= form_close(); ?>
        </div>
      </h2>


    </div>

  </div>
</div>
<?php foreach($issue_list as $row)
{ ?>

  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="card">
      <div class="header">
        <h4>
          <div class="row clearfix">
            <div class="col-md-8">
          <!-- <div class="float-left" align="left" > -->
            <?= $row['issue'] ?>
          </div>
        <!-- </div> -->
          <!-- <br> -->
          <div class="col-md-4" align="right">
            <small>By - <?= $row['staff_name'] ?> </small>
          </div>
        </div>
        </h4>

      </div>
      <div class="body">
        <?= $row['solution'] ?>
      </div>
    </div>
  </div>
<?php } ?>


<!-- Jquery DataTable Plugin Js -->
<!-- <script src="<?= base_url() ?>/assets/admin/plugins/sweetalert/sweetalert.min.js"></script> -->
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<!-- <script src="<?= base_url() ?>assets/admin/js/pages/tables/jquery-datatable.js"></script> -->
    <!--  <script type="text/javascript">
     	$(document).ready( function () {
    $('.js-basic-example').DataTable({
        responsive: true,
        "processing": true
    });
});
</script> -->

<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

<script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script>
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