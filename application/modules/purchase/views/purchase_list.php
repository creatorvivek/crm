
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                            	<?= isset($heading)?$heading:'PURCHASE LIST' ?>
                                <!-- STOCK LIST -->
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#Purchase id</th>
                                            <!-- <th>Description</th> -->
                                            <th>Total Amount</th>
                                            <!-- <th>Selling Price</th> -->
                                            <!-- <th>Serial No</th> -->
                                            <!-- <th>Stock In</th> -->
                                            <!-- <th>Stock out</th> -->
                                            <!-- <th>Stock reamaning</th> -->

                                            <!-- <th>Unit</th> -->
                                            <th>Vendor</th>
                                            <th>Adding By</th> 
                                            <th>Billed Status</th>
                                            <th>Order Status</th>
                                            <th>Action</th>
                                          
                                        </tr>
                                    </thead>    
                                  
                                    <tbody>
                                    	<?php foreach($purchase as $row)
                                    	{ ?>
                                        <tr>
                                            <td><a href="<?= base_url() ?>purchase/purchase_order_view/<?= $row['purchase_id'] ?>" data-toggle="tooltip" title="click here to view purchase order detail"><?= $row['purchase_id'] ?></a></td>
                                            <!-- <td><?= $row['description'] ?></td> -->
                                            <td><?= $row['total_amount'] ?></td>
                                            <!-- <td><?= $row['selling_price'] ?></td> -->
                                            <!-- <td><?= $row['serial_no'] ?></td> -->
                                            <!-- <td><?= $row['model_no'] ?></td> -->
                                            <!-- <td><?= $row['quantity'] ?></td> -->
                                            <!-- <td><?= $row['quantity_out'] ?></td> -->
                                            <!-- <td><?= $row['quantity_for_sale'] ?></td> -->
                                            <!-- <td><?= $row['unit'] ?></td> -->
                                            <td><?= $row['vendor_name'] ?></td>
                                            <td><?= $row['staff_name'] ?></br><?= $row['created_at'] ?></td>
                                            <td><?= $row['status'] ?></td>
                                            <td><?= $row['purchase_status'] ?></td>
                                            <!-- <td> -->
                                          <!--  <?php foreach($category as $row2)
                                            { 
                                            	if($row2['category_id']==$row['category'])
                                            	{ 
                                            		echo $category_name=$row2['name'];
                                            	}  
                                            }	 ?>	
  -->

                                            
                                        <td> 
                                          <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        
                                        <li><a href="<?= base_url() ?>purchase/purchase_approved/<?= $row['purchase_id'] ?> ">Mark Approve</a></li>
                                        <li><a href="<?= base_url() ?>purchase/purchase_order_edit/<?= $row['purchase_id'] ?>">edit</a></li>
                                        <li><a href="javascript:void(0);">Mark Cancle</a></li>
                                       
                                    </ul>
                                </div>
                            </td>
                                        </tr>
                                            









                                       <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
          <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?= base_url() ?>assets/admin/js/pages/tables/jquery-datatable.js"></script>
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