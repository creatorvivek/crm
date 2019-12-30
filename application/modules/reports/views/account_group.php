<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
        <div class="card">
                        <div class="header">
                            <h2 align="center">
                                  <?= ucfirst($company_name) ?>
                                  <div style="font-size: 24px" align="center">GENERAL LEDGER</div>
                            </h2>
                            
                        </div>
                        <div class="body">

<div class="table-responsive">
  <table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
   
        <th>GROUP NAME</th>
        <th>DEBIT</th>
  
        <th>CREDIT</th>
       
    
      </tr>
    </thead>
    <tbody>



    <?php     foreach($account_group as $row)  { ?>
        <tr>
        
        <td><?= $row['group_name'] ?>  </td>
        <td><?= $row['debit'] ?> </td>
        <td><?= $row['credit'] ?> </td>
    


                  </tr>



                <?php } ?>
              </tbody>
             
            </table>
          </div>
         
        </div>
      </div>
    </div>
  </div>
</div>