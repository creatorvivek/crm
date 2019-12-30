 
<div class="outstanding_page">
 <div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      
      <div class="header">
         <div class="row clearfix">
           <div class="col-md-6">
        <h2>Outstanding Balance</h2>
      </div>
       <div class="col-md-6" align="right">
        <button type="button" class="button btn-success" onclick="print()">print</button>
      </div>
    </div>
      </div>
      <div class="body">
        <h4 align="center"><?= $customer_name['name']  ?></h4>
       <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <!-- <th>PAYMENT ID</th> -->
              <th>Date</th>
              <th>Invoice Number</th>
              <!-- <th>Customer Name</th> -->
              <!-- <th>PAYMENT ID</th> -->
              <th>Total</th>
              <th>Paid</th>
              <th>Balance</th>
              <!-- <th>status</th> -->
              
              <!-- <th>Actions</th> -->
            </tr>
          </thead>
          <tbody>
           

            
            <?php 
            
            $debit_sub=0;
            
            $bal=0;
              if($initial) {  
                // $debit_sub= $initial['paid'] ;
                ?>   
              <tr>
                <td> <?=  date('j F Y ', strtotime( $initial['created_at']) ) ; ?><br>
                
              </td>
              <td>Initial balance</td>
              
              <td><?= $initial['total'] ?> </td>
              <td><?= $initial['paid'] ?>  </td>
              <td><?= $initial['total']- $initial['paid']   ?></td> 

              </tr>
        <?php   }   
        for ($k=0;$k<count($outstanding);$k++) {  
                         // $credit_sub += $outstanding[$k]['total']; 
             $debit_sub += $outstanding[$k]['paid']; 
             $bal += $outstanding[$k]['total'] - $outstanding[$k]['paid'];
             ?>
             <tr>
              <td> <?=  date('j F Y ', strtotime( $outstanding[$k]['created_at']) ) ; ?><br>
                
              </td>
              <td><a href="<?= base_url() ?>sales/sales_invoice_view/<?= $outstanding[$k]['invoice_id'] ?>" target="_blank"><?= $outstanding[$k]['invoice_id'] ?></a></td>
              
              <td><?= $outstanding[$k]['total'] ?> </td>
              <td><?= $outstanding[$k]['paid'] ?>  </td>
              <td><?= $outstanding[$k]['total']- $outstanding[$k]['paid']   ?></td> 
              
              
            </tr>
         
 <?php } ?>
        </tbody>
                        <tfoot>        <!--  <tr>
                                             <td colspan="3"><?= $bal ?></td>
                                            <td><strong><?= $debit_sub ?></strong></td>
                                            <td><strong><?= $bal ?></strong></td>
                                        
                                          </tr>  -->
                                          <tr>
                                        <?php   if($initial){ $bal  =  $bal  + $initial['total']- $initial['paid'];   } ?>
                                            <td class="text-right" colspan="4"><b>TOTAL BALANCE</b></td>
                                            <td align="center" ><strong><?= $bal ?></strong></td>
                                            
                                            <!-- <td></td> -->
                                            
                                          </tr>

                                        </tfoot>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          

                          <script src="<?= base_url() ?>assets/jquery-printme.min.js"></script>
                          <script type="text/javascript">
                            function print()
                            {
                              $(".outstanding_page").printMe({path:["<?= base_url() ?>assets/admin/plugins/bootstrap/css/bootstrap.min.css","<?= base_url() ?>assets/admin/print.css"]});
                            }

                            
                          </script>     