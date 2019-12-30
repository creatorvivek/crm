<div class="row clearfix">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2 align="center">
        ADD CATEGORY LEAD
        
        </h2>
        
      </div>
      <div class="body">
        <?= form_open('reports/add_lead',array("class"=>"form-horizontal")); ?>
        <div class="col-md-12">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="text" id="name" name="lead_name" class="form-control" required onkeypress="return isAlpha(event)" >
              <label class="form-label">Lead Category Name</label>
            </div>
          </div>
        </div>
         <!-- <div class="col-md-12"> -->
           <div class="form-group">
          <button class="btn btn-info" type="submit">Add</button>
        <?= form_close() ?>
         </div>
      </div>
    <!-- </div> -->
    </div>
  </div>

   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
       <div class="card">
      <div class="header">
        <h2>
        LEAD CATEGORY LIST
        </h2>
        
      </div>
      <div class="body">
        
         <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover user_table dataTable">
          <thead>
            <tr>
              <!-- <th>Ticket id</th> -->
              <th>#S No</th>
              <th>Name</th>
             
          
            </tr>
          </thead>
          <tbody>
            <?php 

            $count=1;
            foreach($lead as $row){ ?>
            <tr>
              
              <td><?= $count++  ?></td>
              <td><?= $row['lead_name']; ?></td>
          
            
               
               <!--  <td>
                  
                  <div class="btn-group" role="group">
                    <a href="<?= base_url() ?>ticket/add_ticket?crn=<?= $row['id'] ?>&name=<?= $row['name'] ?>&mobile=<?= $row['mobile'] ?>&email=<?= $row['email'] ?>" data-toggle="tooltip" data-placement="top" title="generate ticket" class="btn btn-info"><i class="material-icons">assignment</i></a>
                    <a href="<?= base_url() ?>crn/update/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">create</i></a>
                    <a href="<?= base_url() ?>crn/customer_info/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">explore</i></a>
                    
                    <button type="button" class="btn btn-danger" onclick="delFunction(<?php echo $row['id'] ?>);" data-toggle="tooltip" data-placement="top" title="Delete"><i class="material-icons">delete</i></button>
                  </div>
                  
               
              </td> -->
            </tr>
            <?php } ?>
          </tbody>
        </table>


   </div>
</div>