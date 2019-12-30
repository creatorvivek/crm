



<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              <?= isset($heading)?$heading:'Invoice Due List' ?>
                                <!-- STOCK LIST -->
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
        <!-- <th>ID</th> -->
        <th>Invoice Number #</th>
        <th>Customer Name</th>
        <th>Base Amount (&#8377)</th>
        <th>Total Amount (&#8377)</th>
        <th>Date</th>
        <th>status</th>
        <th>Pending Amount (&#8377)</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>

    <?php 
       $total=0;
      $total_payment=0;



    foreach ($invoice as $row) { 

        $total+=$row['total'];
        $total_payment+=$row['total']-$row['paid'];


      ?>
        <tr>
          
            <td data-toggle="tooltip" data-placement="top" title="click to view invoice details" ><a href="<?= base_url() ?>sales/sales_invoice_view/<?=$row['invoice_id'] ?>" ><?=$row['invoice_id'] ?> </a></td>
            <td data-toggle="tooltip" data-placement="top" title="click to view" ><a href="<?= base_url() ?>crn/customer_info/<?= $row['customer_id'] ?>"><?=$row['name'] ?> </a></td>
             <td><?= $row['amount'] ?></td>
              <td><?= $row['total'] ?></td>
             <!-- <td><?=$row['created_at'] ?></td> -->
            <td class="date"> <?=  date('j F Y ', strtotime( $row['created_at']) ) ; ?><br>
            <?=  date('h :i a', strtotime($row['created_at']) ) ; ?></td>
             <td><span class="label <?php if($row['status']=='pending'){
              echo 'label-danger';} else if($row['status']=='partially'){
                echo 'label-warning';
              } else{
                echo 'label-success';
              }
                ?>"><?= $row['status'] ?></span></td>
                <td><?= $row['total']-$row['paid'] ?></td>
             <td><a href="<?= site_url('account/get_invoice/'.$row['invoice_id']); ?>" class="btn btn-info btn-xs" target="_blank">Get Pdf</a> 
            </td>
        </tr>
    <?php } ?>
    </tbody>
   <?php  if($total!=0)
    { ?>
    <tfoot>
      <td colspan="=3"></td>
      <td></td>
      <td></td>
      <td><b><?= $total ?> &#8377</b></td>
      <td></td>
      <td></td>
      <td><b><?= $total_payment ?> &#8377</b></td>
      <td></td>
    </tfoot>
  <?php } ?>
</table>
</div>

<div class="modal" id="user_profile">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" >User Profile</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body body">
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</div>
</div>

 <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/moment.js"></script>
     <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
      <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    
<script>
    $(document).ready( function () {
        $('.js-basic-example').DataTable();
    } );
     $('#daterange').daterangepicker(
    {
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment()
    },
    function (start, end) {
      $('#daterange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }
    );

   function showView(student_id) {     
     $.ajax({  
      url:"<?= base_url()?>student/fetchStudentView",  
      method:"post",  
      data:{id:student_id},  
      success:function(data){  
       
        var obj=JSON.parse(data);
   
          if(obj.parent_id)
          {
            var parent_name=obj.parent_name;
          }
          else
          {
            
            var parent_name='<form method="post" action="<?= base_url() ?>parents/add_parent"><button>add </button><input type="hidden" name="studentId" value='+student_id+' ></form>';
          
          }
        $('#student_detail').html('<table class="table table-striped table-bordered table-responsive"><tr><th>Student name</th><th>classes</th><th>Email</th><th>Mobile</th><th>Parent Name</th><th>Permanent Address</th><th>Corresponding Address</th></tr><tr><td>'+obj.name+'</td><td>'+obj.classes+'</td><td>'+obj.email+'</td><td>'+obj.mobile+'</td><td>'+parent_name+'</td><td>'+obj.permanent_address+'</td><td>'+obj.temporary_address+'</td><table>');  
        $('#dataModal').modal("show");  
      }  
    });  
   }
 
</script>
