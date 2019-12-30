
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                SELLER LIST
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Seller Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Type</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                          
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                    	<?php 
                                    	foreach($seller as $row)
                                    	{ ?>
                                        <tr>
                                            <td><?= $row['company_name'] ?></td>
                                            <td><?= $row['name'] ?></td>
                                            <td><?= $row['mobile'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['address'] ?></td>
                                            <td><?= $row['city'] ?></td>
                                            <?php 
                                            switch($row['type'])
                                            {
                                            	case 1:
                                            	$type='service';
                                            	break;
                                            	case 2:
                                            	$type='product';
                                            	break;
                                            	case 3:
                                            	$type='service and product';
                                            	break;
                                            }
                                            ?>
                                            <td> <?= $type ?> </td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td><div class="btn-group" >
									

                      <a class="btn btn-info" href="<?= base_url()?>super_admin/edit/<?= $row['id'] ?>">Edit</a>
                     

                   
						</div>
					</td>
						
					</div>

                                           
                                        </tr>
                                        
                                       <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Jquery DataTable Plugin Js -->
   
     <!-- <script src="<?= base_url() ?>assets/admin/js/pages/tables/jquery-datatable.js"></script> -->
     <script type="text/javascript">
     	$(document).ready( function () {
    $('.js-basic-example').DataTable({
        responsive: true,
        "processing": true,
        "order":[7]
    });
});
     </script>