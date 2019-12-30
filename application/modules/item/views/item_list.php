
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
                                            <th>Stock on hand</th>
                                            <th>Qty purchase</th>
                                            <th>Qty sale</th>
                                            <th>Hsn Number</th>
                                            <th>Company Name</th>
                                            <th>Usage Unit</th>
                                            <!-- <th>Serial No</th> -->
                                            <!-- <th>Stock</th> -->

                                            <!-- <th>Unit</th> -->
                                            <!-- <th>Qty sell</th>/ -->
                                            <th>Category</th>
                                            <th>Adding By</th> 
                                            <th>Action</th>
                                          
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                    	<?php foreach($item as $row)
                                    	{ ?>
                                        <tr>
                                            <td><a href="<?= base_url() ?>item/fetch_item_total_detail/<?= $row['id'] ?>"><?= $row['item_name'] ?></a></td>
                                            <td><?= $row['description'] ?></td>
                                             <td><?= $row['qty_in_hand'] ?></td> 
                                            <td><?= $row['qty_purchase'] ?></td> 
                                            <td><?= $row['qty_sale'] ?></td> 
                                            <td><?= $row['hsn'] ?></td>
                                            <td><?= $row['company_name'] ?></td> 
                                            <!-- <td><?= $row['quantity'] ?></td> -->
                                          <td><?= $row['unit'] ?></td> 
                                            <td>
                                            <?php foreach($category as $row2)
                                            { 
                                            	if($row2['category_id']==$row['category'])
                                            	{ 
                                            		echo $category_name=$row2['name'];
                                            	}  
                                            }	 ?>	


                                             </td>
                                            <td><?= $row['staff_name'] ?></br><?= $row['created_at'] ?></td>
                                          <td>
                                            	<div class="btn-group" role="group">
                                            	<a data-toggle="tooltip" title="Edit item" href="<?= base_url() ?>item/edit_item/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">create</i></a>
                                            	
                                            </div>
                                            </td> 
                                   
                               				 
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
       <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?= base_url() ?>assets/admin/js/pages/tables/jquery-datatable.js"></script>