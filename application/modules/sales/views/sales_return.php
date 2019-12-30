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
<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <form action="<?= base_url() ?>sales/sales_return" method="post">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
        <div class="body">
          <div class="row clearfix">

            <div class="col-md-3">
              <div class="input-group">
                <span class="input-group-addon">
                  Invoice Id
                </span>
                <div class="form-line">
                  <input type="text" class="form-control"  name="invoice_id" placeholder="Enter invoice id" autocomplete="off">
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <select class="form-control" name="customer_id">
                <option value="">--Select Customer</option>
                <?php foreach ($customers as $row) {  ?>
                  <option value="<?= $row['id'] ?>"  <?=  set_select('customer_id',''. $row['id']. '') ?>   ><?= $row['name'] ?></option>
                <?php }  ?>
              </select>
            </div>          
            <div class="col-md-1">
              <div class="form-group">
                <!-- <label>dfsdf </label> -->
                <button type="submit"   class="btn btn-primary form-control" >SEARCH</button>
              </div>
            </div>

          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php if(isset($invoice))  { ?>
  <div class="row">
    <div class="col-md-8 right-padding-col8">
      <div class="card">


       <div class="body">
        <div class="row">
         <div class="col-md-6">
          <div class="main_heading" ><b><?= $invoice['company_name'] ?></b></div>
          <div class="heading"><?= $invoice['f_mobile'] ?></div>
          <div class="heading"><?= $invoice['f_email'] ?></div>
          <div class="heading"><?= $invoice['f_address'] ?></div>
          <div class="heading"><?= $invoice['f_city'] ?></div>
          <div class="heading"><?= $invoice['f_pincode'] ?></div>
        </div>

        <div class="col-md-6">
         <div class="main_heading" ><b>Bill To</b></div>
         <div class="heading"><?= $invoice['name'] ?></div>
         <div class="heading"><?= $invoice['mobile'] ?> </div>
         <div class="heading"><?= $invoice['address'] ?></div>
         <div class="heading"><?= $invoice['c_city'] ?></div>
         <div class="heading"><?= $invoice['c_pincode'] ?></div>
       </div>

       <div class="col-md-4">
        <strong>Invoice Id # -:  <?= $invoice['invoice_id'] ?> </strong>
        <h5>Date -:  <?= $invoice['created_at'] ?>  </h5>

      </div>

    </div>
    <div class="row">
          <form action="<?= base_url() ?>sales/sales_return_process" method="post">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="body no-padding">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
        <input type="hidden" name="customer_id" value="<?= $invoice['customer_id'] ?>" >
        <input type="hidden" name="invoice_id" value="<?= $invoice['invoice_id'] ?>" >
        <input type="hidden" name="total_return" class="return_total_post" >
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
                  <th class="text-center">Return Quantity</th>
                  <th class="text-center">Return Amount</th>
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
                    <td class="text-center"><input type="text" class="return_quantity" onkeypress="return isNumberKey(event)" required=""></td>
                    <td class="text-center"><input type="text" class="return_amount" onkeypress="return isNumberKey(event)" required="" ></td>    
                    <!-- <td class="text-center">0.00</td> -->
                    <!-- <td class="text-center">0.00</td> -->

                  </tr>
                <?php } ?>






                <tr class="tableInfos f_size"><td colspan="3" align="right"><strong>Total return</strong></td><td colspan="2" class="text-right"><strong class="return_total"></strong></td></tr>


              </tbody>
            </table>
          </div>
          <br><br>
        </div>
      </div>
      <div class="col-md-12" align="center">

        <button class="btn btn-success" type="submit">Return</button>
      </div>
    </div>
  </div>
</div>
</div>
        </form>


</div>      

<?php }  ?>

<script type="text/javascript">
  $('.return_amount').change(function(){ 

    var total=0;
    $('.return_amount').each(function(){
      total += +$(this).val();
    });
    $('.return_total').text(total);
    $('.return_total_post').val(total);
  });
</script>