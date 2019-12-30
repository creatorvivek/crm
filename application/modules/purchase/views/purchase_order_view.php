  <style type="text/css">
    


    .f_size
    {
      font-size: 14px;
      /*color:red;*/
    }
     th
    {
      background-color: #eff3f9;
      font-size: 15px;
    }
    .heading
    {
      color:black;
      line-height: 1.6;
       font-size: 12px;
    }
    .main_heading
    {
      font-size: 16px;
      color:black;
      font-weight: 900px;
      
    }
    td
    {
      font-size: 13px;
    }
    .card_adjust
    {
      height: 30px;
    }
   /* h5
    {
      color:#001;
    }*/
  </style>


<!---Top Section End-->
<div class="row">
  <div class="col-md-8 right-padding-col8">
    <div class="card">
      <div class="header">
                            <h2>
                             Purchase Order
                                <!-- STOCK LIST -->
                            </h2>
                            
                        </div>
      <div class="body">

        <div class="row">
          <div class="col-md-4">
            <button class="btn btn-default btn-flat delete-btn" type="button" >Order id - <?= $purchase_order['purchase_id'] ?></button>
            <!-- <br> -->
            <!-- <strong>Location : Primary Location</strong> -->
          </div>
          <div class="col-md-8">
            <div class="btn-group pull-right">
              <!-- <button title="Email" type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#emailOrder">Email</button> -->
              <!-- <a target="_blank" href="http://localhost/stockpile/order/print/5" title="Print" class="btn btn-default btn-flat">Print</a> -->
              <!-- <a target="_blank" href="http://localhost/stockpile/order/pdf/5" title="PDF" class="btn btn-default btn-flat">PDF</a> -->
              <!-- <a href="http://localhost/stockpile/order/edit/5" title="Edit" class="btn btn-default btn-flat">Edit</a> -->

              <!--  <form method="POST" action="http://localhost/stockpile/order/delete/5" accept-charset="UTF-8" style="display:inline"> -->
                <!-- <input type="hidden" name="_token" value="BRggZJo9L0dYzTdzOXf1JgbZGvHDkcW9TKJascgC"> -->
                <!-- <button class="btn btn-default btn-flat delete-btn" type="button"  data-toggle="modal" data-target="#payModal">
                 Pay
               </button> -->
             
           </div>
         </div>
       </div>
     </div>

     <div class="body">
      <div class="row">

        <div class="col-md-6">
          <div class="main_heading" ><b><?= $purchase_order['company_name'] ?></b></div>
          <div class="heading"><?= $purchase_order['vendor_mobile'] ?></div>
          <div class="heading"><?= $purchase_order['vendor_email'] ?></div>
          <div class="heading"><?= $purchase_order['vendor_address'] ?></div>
          <div class="heading"><?= $purchase_order['vendor_city'] ?></div>
          <div class="heading"><?= $purchase_order['vendor_pincode'] ?></div>
        </div>

        <div class="col-md-6">
           <div class="main_heading" ><b></b></div>
         <!--  <div class="heading"><?= $purchase_order['name'] ?></div>
          <div class="heading"><?= $purchase_order['mobile'] ?> </div>
          <div class="heading"><?= $purchase_order['address'] ?></div>
          <div class="heading"><?= $purchase_order['c_city'] ?></div>
          <div class="heading"><?= $purchase_order['c_pincode'] ?></div> -->
        </div>
                  
                  <div class="col-md-4">
                  <strong>Purchase Order # -  <?= $purchase_order['purchase_id'] ?> </strong>
                  <h5>Date -  <?= $purchase_order['created_at'] ?>  </h5>
               
                  </div>
               
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="body no-padding">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="salesInvoice">
                        <tbody>
                          <tr class="tbl_header_color dynamicRows">
                            <!-- <th width="30%" class="text-center">Description</th> -->
                            <th  class="text-center">Particular</th>
                            <th class="text-center">Quantity</th>
                            <!-- <th width="10%" class="text-center">Tax(%)</th> -->
                            <th class="text-center" >Rate</th>
                            <th  class="text-center">Amount(&#8377)</th>
                          </tr>

                          <?php 
                          $sub=0;
                          foreach($purchase_particular as $row )  {
                            $sub=$sub+$row['amount'];
                            ?>
                            <tr>                             
                              <td class="text-center"><?= $row['item_name'] ?></td>
                              <td class="text-center"><?= $row['qty'] ?><small>  <?= $row['measurement_unit'] ?></small></td>
                              <td class="text-center"><?= $row['purchase_price'] ?></td>
                              <td class="text-center"><?= $row['amount'] ?></td>
                              <!-- <td class="text-center">0.00</td> -->
                              <!-- <td class="text-center">0.00</td> -->

                            </tr>
                          <?php } ?>


                          <tr class="tableInfos f_size">
                            <td colspan="2" align="right" >Sub Total</td><td align="right" colspan="2"><?= $sub ?></td>
                          </tr>
                           <?php ($tax=json_decode($purchase_order['tax'],true)) ;
                        // var_dump($tax);
                        $tax_amount=0;
                        for($i=0;$i<count($tax);$i++) {
                        ?>
                      <tr>
                        <!-- <th><?=(array_keys($tax[$i]))[0] ?>(<?=(array_values($tax[$i]))[0] ?>%)</th> -->

                     <!-- <td><?= round(($purchase_order['amount']  * (array_values($tax[$i]))[0])/100) ?></td>  -->
                     <!-- use for total  -->
                     <?php  $tax_amount= $tax_amount+round(($purchase_order['amount']  * (array_values($tax[$i]))[0])/100)     ?>
                      </tr>
                          <tr class="f_size"><td colspan="2" align="right" ><?=(array_keys($tax[$i]))[0] ?>(<?=(array_values($tax[$i]))[0] ?>%)</td><td colspan="2" class="text-right"><?= round(($purchase_order['amount']  * (array_values($tax[$i]))[0])/100) ?></td></tr>
                      <?php } ?>
                          <tr class="tableInfos f_size"><td colspan="2" align="right"><strong>Grand Total</strong></td><td colspan="2" class="text-right"><strong><?= ($purchase_order['total_amount']) ?></strong></td></tr>
                          <!-- <tr class="f_size">

                            <td colspan="2" align="right">Paid</td><td colspan="2" class="text-right"><?= $purchase_order['paid'] ?></td></tr>
                            <tr class="tableInfos f_size"><td colspan="2" align="right"><strong style="color:red">Due</strong></td><td colspan="2" class="text-right"><strong style="color:red"><?php echo round($purchase_order['total_amount']) -$purchase_order['paid'] ?></strong></td></tr> -->
                          </tbody>
                        </table>
                      </div>
                      <br><br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <table class="table table-bordered">
 <tr><th>Serial no.</th><th>Model no.</th></tr>
            <?php for($j=0;$j<count($batch_wise);$j++)
            {  ?>
            <!-- <div class="body"> -->
  <!-- <div class="col-md-12" align="center"></div> -->
  <!-- <div class="col-md-6"> -->
  <!-- <div class="form-group form-float">
  <div class="form-line ps">
  <input type="text" class="form-control " name="serial_numberitem_id[]" required="" aria-required="true"> -->
  <tr><td><b>item name</b></td><td><?= $batch_wise[$j]['item_name']  ?></td></tr>
 <tr><td><?= $batch_wise[$j]['serial_no']  ?></td><td><?= $batch_wise[$j]['model_no']  ?></td></tr>
  <!-- <label class="form-label"><?= $batch_wise[$j]['serial_no']  ?></label> -->
  <!-- </div> -->
  
 <!--  <div class="col-md-6">
 
  <label class="form-label"><?= $batch_wise[$j]['model_no']  ?></label>
  </div> -->
  <!-- </div> -->
<?php } ?>
</table>
</div>
          </div>
        </div>
          <!--Modal start-->
          <div id="emailOrder" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <form id="sendOrderInfo" method="POST" action="http://localhost/stockpile/order/email-order-info">
                <input type="hidden" value="BRggZJo9L0dYzTdzOXf1JgbZGvHDkcW9TKJascgC" name="_token" id="token">
                <input type="hidden" value="5" name="order_id" id="order_id">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Send order information to client</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="email">Send To:</label>
                      <input type="email" value="rahul@gmail.com" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                      <label for="subject">Subject:</label>
                      <input type="text" class="form-control" name="subject" id="subject" value="Your Order# SO-0003 from Stockpile has been created.">
                    </div>
                    <div class="form-groupa">
                      <textarea id="compose-textarea" name="message" id='message' class="form-control editor" style="height: 200px">&lt;p&gt;Hi rahul vaidya,&lt;/p&gt;&lt;p&gt;Thank you for your order. Here&rsquo;s a brief overview of your Order #SO-0003 that was created on 2019-02-11. The order total is $70.95.&lt;/p&gt;&lt;p&gt;If you have any questions, please feel free to reply to this email. &lt;/p&gt;&lt;p&gt;&lt;b&gt;Billing address&lt;/b&gt;&lt;/p&gt;&lt;p&gt;&nbsp;1&lt;/p&gt;&lt;p&gt;&nbsp;mandla&lt;/p&gt;&lt;p&gt;&nbsp;mp&lt;/p&gt;&lt;p&gt;&nbsp;491001&lt;/p&gt;&lt;p&gt;&nbsp;IN&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;b&gt;Order summary&lt;br&gt;&lt;/b&gt;&lt;/p&gt;&lt;p&gt;&lt;b&gt;&lt;/b&gt;&lt;div&gt;1x camera&lt;/div&gt;&lt;div&gt;1x router&lt;/div&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Regards,&lt;/p&gt;&lt;p&gt;Stockpile&lt;/p&gt;&lt;br&gt;&lt;br&gt;</textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button><button type="submit" class="btn btn-primary btn-sm">Send</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
       