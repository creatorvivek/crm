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
                                <table class="table table-bordered table-striped table-hover sales_table dataTable">
                                    <thead>
                                        <tr>
                                          <!-- <th>Sales Order #</th> -->
                                            <th>Customer Name</th>
                                            <th>Customer Mobile</th>
                                            <!-- <th>Item Name</th> -->
                                            <th>Customer Email</th>
                                            <!-- <th>Serial No</th> -->
                                            <!-- <th>Model No</th> -->
                                            <th>Created At</th> 
                                            <th>Print</th>
                                            <!-- <th>Category</th> -->
                                            <!-- <th>Action</th> -->
                                          
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                      <?php 
                                      // $total=0;

                                      foreach($quotation as $row)
                                      { 


                                        // $total+=$row['total'];
                                        ?>
                                        <tr>

                                            	<td><?= $row['c_name'] ?></td>
                                            	<td><?= $row['c_mobile'] ?></td>
                                            	<td data-toggle="tooltip" title="click to send email"><a href="mailto:<?= $row['c_email'] ?>"><?= $row['c_email'] ?></a></td>
                                            	<td><?= $row['created_at'] ?></td>
                                                 <td>
                                                    <div class="btn-group" role="group">
                                         	<a href="<?= base_url() ?>quotation/quotation_print/<?=  $row['id']  ?>" class="btn btn-info" target="_blank" data-toggle="tooltip" title="print"><i class="material-icons">print</i></a>
                                            <!-- <a href="<?= base_url() ?>quotation/quotation_print/<?=  $row['id']  ?>" class="btn btn-success" data-toggle="tooltip" title="order"><i class="material-icons">shopping_cart</i></a> -->
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
