
      
    <!--   <ul class="nav nav-pills ml-auto p-2 pull-left">
        <li class="nav-item"><a class="nav-link active show" href="#tab_1" data-toggle="tab">Customer</a></li>
        <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Frenchise</a></li>


      </ul> -->
      <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               <?= $title ?>
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

            <thead>
              <tr>
                <th>Ticket id</th>
                <th>name</th>
                <th>Email</th>

                <th>Mobile</th>
                <!-- <th>Comment</th> -->
                <th>Description</th>
                <th>Assign</th>
                <th>Attend type</th>
                <th>Priority</th>
                <th>Created_at</th>
                <th>status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach($ticket as $row){ ?>
                <tr>
                  <td><a href="<?= base_url()?>ticket/log_ticket_by_ticket_no/<?= $row['ticket_id'] ?>"><?= $row['ticket_id'] ?></a></td>

                  <td><?= $row['name']; ?></td>
                  <td><?= $row['email']; ?></td>


                  <td><?= $row['mobile']; ?><br><button class="btn btn-info"><a href="<?= base_url() ?>sms/index?mobile=<?= $row['mobile'] ?>" style="color:white">sms</a></button><button class="btn btn-danger">Call</button></td>
                  <!-- <td><?= $row['comment']; ?></td> -->
                  <?php if(empty($row['description']))
                    {   $row['description']= '-' ;     }
                   ?>
                    
                  <td><?= $row['description']; ?></td>
                  <?php if($row['assign'] ==NULL)
                  { ?>
                    <td style="color:red">unassigned<br><div class="anchor">
                    <!-- <a href="<?= base_url()?>ticket/ticket_response/<?= $row['ticket_id'] ?>">click to assign</a> -->
                  </div></td>
                  <?php  } else { ?>
                    <td style="color:green">assign</td>
                  <?php } ?>

                  <td><?= $row['attend_type']; ?></td>
                  <td><?= $row['priority']; ?></td>
                  <td><?= $row['created_at']; ?><br><div class="creator_name"><?= '-'. $row['staff_name']; ?></div></td>
                  <td><span class="badge <?php if($row['status']=='open'){
              echo 'bg-pink';} else if($row['status']=='request to close'){
                echo 'bg-orange';
              } else{
                echo 'bg-teal';
              }
                ?>"><?= $row['status']; ?></span></td>

                  <td>
                    <div class="btn-group" >

                      <a class="btn btn-info" href="<?= base_url()?>ticket/log_ticket_by_ticket_no/<?= $row['ticket_id'] ?>">Log</a>
                      
                      <!-- <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Reply"><a href="<?= base_url() ?>ticket/ticket_response/<?= $row['ticket_id'] ?>"><i class="fa fa-reply"></i></a></button> -->

                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>

        <!-- /.tab-pane -->
      
      <!-- /.tab-content -->
      <div id="dataModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" >

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <!-- <h4 class="modal-title">Modal Header</h4> -->
            </div>
            <div class="modal-body" id="student_detail">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
    </div><!-- /.card-body -->
  </div>
  <!-- ./card -->
</div>
<!-- /.col -->
</div>
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