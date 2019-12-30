
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                            	<?= $heading ?>
                                <!-- STOCK LIST -->
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Description</th>
                                            <th>Purchase Price</th>
                                            <th>Selling Price</th>
                                            <th>Serial No</th>
                                            <th>Model No</th>
                                            <th>Adding By</th> 
                                            <th>Category</th>
                                            <th>Action</th>
                                          
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                    	<?php foreach($item as $row)
                                    	{ ?>
                                        <tr>
                                            <td><?= $row['item_name'] ?></td>
                                            <td><?= $row['description'] ?></td>
                                            <td><?= $row['purchase_price'] ?></td>
                                            <td><?= $row['selling_price'] ?></td>
                                            <td><?= $row['serial_no'] ?></td>
                                            <td><?= $row['model_no'] ?></td>
                                            <td><?= $row['staff_name'] ?></br><?= $row['created_at'] ?></td>
                                            <td>
                                            <?php foreach($category as $row2)
                                            { 
                                            	if($row2['category_id']==$row['category'])
                                            	{ 
                                            		echo $category_name=$row2['name'];
                                            	}  
                                           }	 ?>	


                                             </td>
                                             <td>
                                            	<div class="btn-group" role="group">
                                            	<!-- <a href="<?= base_url() ?>item/edit/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">create</i></a> -->
                                            	
                                            </div>
                                        </td>
                                    <!-- <button type="button" class="btn btn-default waves-effect">LEFT</button>
                                    <button type="button" class="btn btn-default waves-effect">MIDDLE</button>
                                    <button type="button" class="btn btn-default waves-effect">RIGHT</button> -->
                               				 
                                            <!-- <td><a href="<?= base_url() ?>/item/edit/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">create</i></a></td> -->
                                           
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
    <!--  <script type="text/javascript">
     	$(document).ready( function () {
    $('.js-basic-example').DataTable({
        responsive: true,
        "processing": true
    });
});
     </script> -->