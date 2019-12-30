 <!--Bootstrap Date Picker -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                BOOTSTRAP DATE PICKER
                                <small>Taken from <a href="https://github.com/uxsolutions/bootstrap-datepicker" target="_blank">github.com/uxsolutions/bootstrap-datepicker</a></small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">

                                 <div class="col-xs-3">
                                    <h2 class="card-inside-title">Text Input</h2>
                                    <div class="form-group">
                                        <div class="form-line" id="bs_datepicker_container">
                                            <input type="text" class="form-control" placeholder="Please choose a date...">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-xs-3">
                                    <h2 class="card-inside-title">Text Input</h2>
                                    <div class="form-group">
                                        <div class="form-line" id="bs_datepicker_container">
                                            <input type="text" class="form-control" placeholder="Please choose a date...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="card-inside-title">Component</h2>
                                    <div class="input-group date" id="bs_datepicker_component_container">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Please choose a date...">
                                        </div>
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                    </div>
                                </div> -->
                                <!-- <div class="col-xs-6">
                                    <h2 class="card-inside-title">Range</h2>
                                    <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Date start...">
                                        </div>
                                        <span class="input-group-addon">to</span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Date end...">
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <!-- <script src="<?= base_url() ?>assets/admin/plugins/momentjs/moment.js"></script> -->
              <!-- <script src="<?= base_url() ?>assets/admin/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script> -->
            <script src="<?= base_url() ?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
            <!--  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script type="text/javascript">
    
$(function () {
    //Textarea auto growth
    // autosize($('textarea.auto-growth'));

    //Datetimepicker plugin
    // $('.datetimepicker').bootstrapMaterialDatePicker({
    //     format: 'dddd DD MMMM YYYY - HH:mm',
    //     clearButton: true,
    //     weekStart: 1
    // });

    // $('.datepicker').bootstrapMaterialDatePicker({
    //     format: 'dddd DD MMMM YYYY',
    //     clearButton: true,
    //     weekStart: 1,
    //     time: false
    // });

    // $('.timepicker').bootstrapMaterialDatePicker({
    //     format: 'HH:mm',
    //     clearButton: true,
    //     date: false
    // });

    //Bootstrap datepicker plugin
    $('#bs_datepicker_container input').datepicker({
        autoclose: true,
        container: '#bs_datepicker_container'
    });

    // $('#bs_datepicker_component_container').datepicker({
    //     autoclose: true,
    //     container: '#bs_datepicker_component_container'
    // });
    // //
    // $('#bs_datepicker_range_container').datepicker({
    //     autoclose: true,
    //     container: '#bs_datepicker_range_container'
    // });
});


</script>