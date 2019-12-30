  
    <div class="card">
      <div class="header">
        <h2>
         <!-- SALARY LIST -->
         <?= isset($heading)?$heading:'SALARY LIST' ?>
         <!-- STOCK LIST -->
       </h2>

     </div>
     <div class="body">
      <div class="table-responsive">
        <table class="table table-bordered  table-hover js-basic-example dataTable" id="invoiceTable">
          <thead>
            <tr>

              <th>Name</th>
              <th>Gross Salary</th>
              <th>Year</th>
              <th>Month</th>
              <th>Issue date</th>
    
              <th>Actions</th>
      </tr>
    </thead>
    <tbody>

      <?php 
      


      foreach ($salary as $row) { 



        ?>
        <tr>


         <td><?= $row['name'] ?></td>
         <td><?= $row['gross_salary'] ?></td>
         <td><?= $row['year'] ?></td>
        <?php $dateObj   = DateTime::createFromFormat('!m', $row['month']); 
$monthName = $dateObj->format('F');     ?>
         <td><?= $monthName ?></td>
         <td><?= $row['created_at'] ?></td>
         <td> 
                  
                  <div class="btn-group" role="group">
                   
                 
                    <a href="<?= base_url() ?>payroll/salary_slip/<?= $row['id'] ?>" class="btn btn-primary waves-effect" data-toggle="tooltip" data-placement="top" title="Salary slip"><i class="material-icons">explore</i></a>
                   
                  
                  </div>
                  
               
              </td>


         

       </tr>
     <?php } ?>
   </tbody>
   
 </table>
</div>


</div>
</div>
 <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
  

    <script type="text/javascript">
      $(document).ready(function() {
    $('.js-basic-example').DataTable( {
        "order": [[ 4, "desc" ]]
    } );
} );
    </script>