<!--   <div class="card">
    <div class="body">
      <div class="row">
        <div class="col-md-10">
         <div class="top-bar-title">Sales Order</div>
       </div>
       <div class="col-md-2">
        <a href="<?= base_url() ?>sales/sale_add" class="btn btn-block btn-default btn-flat btn-border-orange">New Sales Order</a>
      </div>
    </div>
  </div>
</div>  -->
<!---Top Section End-->
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
       font-family: sans-serif;
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
    </style>
<div class="row">
  <div class="col-md-8 right-padding-col8">
    <div class="card">
      <div class="body">

        <div class="row">
          <div class="col-md-4">
            <button class="btn btn-default btn-flat delete-btn" type="button" ><?= $invoice[0]['status'] ?></button>
            <!-- <br> -->
            <!-- <strong>Location : Primary Location</strong> -->
          </div>
          <div class="col-md-8">
            <div class="btn-group pull-right">
              <!-- <button title="Email" type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#emailOrder">Email</button> -->
              <!-- <a target="_blank" href="http://localhost/stockpile/order/print/5" title="Print" class="btn btn-default btn-flat">Print</a> -->
              <!-- <a target="_blank" href="http://localhost/stockpile/order/pdf/5" title="PDF" class="btn btn-default btn-flat">PDF</a> -->
              <a href="<?= base_url() ?>account/get_invoice/<?= $invoice[0]['invoice_id'] ?>" title="print invoice" class="btn btn-default btn-flat" target="_blank">Print</a>

              <!--  <form method="POST" action="http://localhost/stockpile/order/delete/5" accept-charset="UTF-8" style="display:inline"> -->
                <!-- <input type="hidden" name="_token" value="BRggZJo9L0dYzTdzOXf1JgbZGvHDkcW9TKJascgC"> -->
                <button class="btn btn-default btn-flat delete-btn" type="button"  data-toggle="modal" data-target="#payModal">
                 Pay
               </button>
             </form>
           </div>
         </div>
       </div>
     </div>

     <div class="body">
      <div class="row">
 <div class="col-md-6">
          <div class="main_heading" ><b><?= $invoice[0]['company_name'] ?></b></div>
          <div class="heading"><?= $invoice[0]['f_mobile'] ?></div>
          <div class="heading"><?= $invoice[0]['f_email'] ?></div>
          <div class="heading"><?= $invoice[0]['f_address'] ?></div>
          <div class="heading"><?= $invoice[0]['f_city'] ?></div>
          <div class="heading"><?= $invoice[0]['f_pincode'] ?></div>
        </div>

        <div class="col-md-6">
           <div class="main_heading" ><b>Bill To</b></div>
          <div class="heading"><?= $invoice[0]['name'] ?></div>
          <div class="heading"><?= $invoice[0]['mobile'] ?> </div>
          <div class="heading"><?= $invoice[0]['address'] ?></div>
          <div class="heading"><?= $invoice[0]['c_city'] ?></div>
          <div class="heading"><?= $invoice[0]['c_pincode'] ?></div>
        </div>
                  
                  <div class="col-md-4">
                  <strong>Invoice Id # -:  <?= $invoice[0]['invoice_id'] ?> </strong>
                  <h5>Date -:  <?= $invoice[0]['created_at'] ?>  </h5>
                
                  </div>
               
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="body no-padding">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="salesInvoice">
                        <tbody>
                          <tr class="tbl_header_color dynamicRows">
                            <!-- <th width="30%" class="text-center">Description</th> -->
                            <!-- <th width="10%" class="text-center">Quantity</th> -->
                              <th  class="text-center">Particular</th>
                              <th class="text-center">Quantity</th>
                            <!-- <th width="10%" class="text-center">Tax(%)</th> -->
                            <!-- <th class="text-center" width="10%">Discount(%)</th> -->
                            <th  class="text-center">Amount(&#8377)</th>
                          </tr>

                          <?php 
                          $sub=0;
                          foreach($invoice_particular as $row )  {
                            $sub=$sub+$row['price'];
                            ?>
                            <tr>                             
                              <td class="text-center"><?= $row['particular'] ?></td>
                              <td class="text-center"><?= $row['quantity'] ?> <small>  <?= $row['unit'] ?> </small> </td>
                              <td class="text-center"><?= $row['price'] ?></td>
                              <!-- <td class="text-center">0.00</td> -->
                              <!-- <td class="text-center">0.00</td> -->

                            </tr>
                          <?php } ?>


                          <tr class="tableInfos">
                            <td colspan="2" align="right" class="f_size" >Sub Total</td><td align="right" class="f_size" colspan="2"><?= $sub ?></td>
                          </tr>
                           <?php ($tax=json_decode($invoice[0]['tax'],true)) ;
                        // var_dump($tax);
                        $tax_amount=0;
                        for($i=0;$i<count($tax);$i++) {
                        ?>
                      <tr>
                        <!-- <th><?=(array_keys($tax[$i]))[0] ?>(<?=(array_values($tax[$i]))[0] ?>%)</th> -->

                     <!-- <td><?= round(($invoice[0]['amount']  * (array_values($tax[$i]))[0])/100) ?></td>  -->
                     <!-- use for total  -->
                     <?php  $tax_amount= $tax_amount+round(($invoice[0]['amount']  * (array_values($tax[$i]))[0])/100)     ?>
                      </tr>
                          <tr><td colspan="2" align="right"><?=(array_keys($tax[$i]))[0] ?>(<?=(array_values($tax[$i]))[0] ?>%)</td><td colspan="2" class="text-right"><?= round(($invoice[0]['amount']  * (array_values($tax[$i]))[0])/100) ?></td></tr>
                      <?php } ?>
                          <tr class="tableInfos f_size"><td colspan="2" align="right"><strong>Grand Total</strong></td><td colspan="2" class="text-right"><strong><?= $invoice[0]['total'] ?></strong></td></tr>
                          <tr>

                            <td colspan="2" align="right" class="f_size">Paid</td><td colspan="2" class="text-right f_size"><?= $invoice[0]['paid'] ?></td></tr>
                            <tr class="tableInfos f_size"><td colspan="2" align="right"><strong style="color:red">Due</strong></td><td colspan="2" class="text-right f_size"><strong style="color:red"><?php echo $invoice[0]['total'] -$invoice[0]['paid'] ?></strong></td></tr>
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
          <!--Modal end -->
          <div class="col-md-4 left-padding-col4">
            <div class="card">
              <div class="header text-center">
                <h5 class="text-left text-info"><b>Order No # <a href="<?= base_url() ?>sales/sales_order_view/<?= $invoice[0]['order_id'] ?>"><?= $invoice[0]['order_id'] ?></a></b></h5>
              </div>
            </div>
            <!--Start-->
            <div class="card">
              <div class="header text-center">
                <strong>Invoices</strong>
              </div>
              <div class="body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th width="65%" class="left">Invoice No #</th>
                      <th width="35%" class="text-right">Amount(&#8377)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td align="left">
                        <a href="<?= base_url() ?>sales/sales_invoice_view/<?= $invoice[0]['invoice_id'] ?>">
                         <i class="fa fa-chevron-right" aria-hidden="true"></i>
                         <?= $invoice[0]['invoice_id'] ?>
                       </a>


                     </td>
                     <td align="right"><?= $invoice[0]['amount'] ?></td>
                   </tr>
                   <td colspan="1" align="right"><strong>Total</stron></td>
                    <td align="right"><strong><?= $invoice[0]['total'] ?></strong></td>
                  </tbody>
                </table>
              </div>
            </div> 
            <!--END-->
            <div class="card">
              <div class="header text-center">
                <strong>Payments</strong>
              </div>
              <div class="body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">Payment No</th>
                        <th>Invoice No</th>
                        <th>Method</th>
                        <th>Amount(&#8377)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $total_paid=0;

                      foreach($payment as $pay) { 

                        $total_paid=$total_paid+$pay['amount'];
                        ?>
                        <tr>
                          <td align="center"><a href="<?= base_url() ?>sales/reciept_view/<?= $pay['payment_id'] ?>"><?= $pay['payment_id'] ?></a></td>
                          <td align="center">  <a href="<?= base_url() ?>sales/sales_invoice_view/<?= $invoice[0]['invoice_id'] ?>"><?= $pay['invoice_id'] ?></a></td>
                          <td align="center"><?= $pay['payment_method'] ?></td>
                          <td align="right"><?= $pay['amount'] ?></td>
                        </tr>
                      <?php } ?>
                      <td colspan="3" align="right"><strong>Total</strong></td><td align="right"><strong><?= $total_paid ?></strong></td>
                    </tbody>
                  </table>
                </div>
                <div class="btn-block-left-padding" style="margin-top:10px;">
                  <!-- <a href="http://localhost/stockpile/payment/pay-all/5" title="Pay All" class="btn btn-success btn-flat btn-block">Pay All</a> -->
                </div>
              </div>
            </div>
   <!--  <div class="card card-default">
      <div class="card-header text-center">
        <strong>Shipments</strong>
      </div>
      <div class="body">
                <h5 class="text-center">No shipment found!</h5>
              </div>
        
                 <div class="body">
          <div class="row">
            <div class="col-md-6 btn-block-left-padding">
              <a href="http://localhost/stockpile/shipment/add/5" title="Manually packing items" class="btn btn-success btn-flat btn-block">Create Manually</a>
            </div>
            <div class="col-md-6 btn-block-right-padding">
              <a href="http://localhost/stockpile/shipment/create-auto-shipment/5" title="Automatically packing all unpacked items" class="btn bg-orange btn-flat btn-block">Create Automatically</a>
            </div>
          </div>
        </div>
      </div>        -->
    </div>      </div>
  </section>
  <!-- Modal Dialog -->
  <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Delete Parmanently</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure about this ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirm">Delete</button>
        </div>
      </div>
    </div>
  </div>
  <!-- ---- -->
  <!--Pay Modal Start-->
  <div class="modal fade" id="payModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Payment On</h4>
          <p>Invoice-id - <?= $invoice[0]['invoice_id'] ?></p>
        </div>
        <div class="modal-body">

          <form class="form-horizontal" id="payForm" action="<?= base_url() ?>sales/payment_status" method="POST">
             <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

            <!-- <input type="hidden" name="invoice_reference" value="{{$saleDataInvoice->reference}}"> -->
            <!-- <input type="hidden" name="order_reference" value="{{$saleDataOrder->reference}}"> -->
            <input type="hidden" name="customer_id" value="<?= $invoice[0]['customer_id'] ?>">

            <input type="hidden" name="order_id" value="<?= $invoice[0]['order_id'] ?>">
            <input type="hidden" name="invoice_id" value="<?= $invoice[0]['invoice_id'] ?>">

            <div class="form-group">
              <label for="payment_type_id" class="col-sm-3 control-label">Payment Type : </label>
              <div class="col-sm-6">

                <select style="width:100%" class="form-control" name="payment_type" id="payment_type_id">
                  <?php foreach($payment_type as $payments) { ?>}
                  <option value="<?= $payments['name'] ?>"><?= $payments['name'] ?></option>
                <?php } ?>
              </select>

            </div>
          </div>
          <div class="form-group">
            <!-- <div class="form-line"> -->
              <label for="amount" class="col-sm-3 control-label">Amount </label>
              <div class="col-sm-6">
                <input type="number" name="pay" value="<?= $invoice[0]['total'] ?>" class="form-control" id="amount" placeholder="Amount">
              </div>
              <!-- </div> -->
            </div>
            <!-- <div class="form-group">
              <div class="form-line">
                <label for="payment_date" class="col-sm-3 control-label">Paid On : </label>
                <div class="col-sm-6">
                  <input type="text" name="payment_date" class="form-control" id="payment_date" placeholder="payment_date">
                </div>
                </div>
              </div> -->

        <!--   <div class="form-group">
            <label for="reference" class="col-sm-3 control-label">{{ trans('message.table.reference') }} : </label>
            <div class="col-sm-6">
              <input type="text" name="reference" class="form-control" id="reference" placeholder="{{ trans('message.table.reference') }}">
            </div>
          </div> -->

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
              <button type="submit" class="btn btn-primary btn-flat">Pay Now</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <!--Pay Modal End
    <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="purchase_amount" required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                <label class="form-label">Purchase Amount</label>
              </div>
            </div>
          </div>