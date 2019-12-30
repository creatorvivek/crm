             
  


  <!DOCTYPE html>
  <html>
  <head>
    <title></title>
  <link rel="stylesheet" href="<?= base_url() ;?>assets/admin/plugins/bootstrap/css/bootstrap.css">
  <script src="<?= base_url() ;?>assets/admin/plugins/jquery/jquery.min.js"></script>
  <style type="text/css">
  /*  @page {
   size: 8.27in 11.69in;
   margin: 12mm 3mm 10mm 3mm;
}*/
.rectanglespace
{
  height:100px;
  /*width:100%;*/
  background-color:#e8eaed;

}
.text_main
{
  /*text-align:center;*/
  font-weight: 900;
font-style: bold;
  font-size: 20px;
  position: relative;
  top: 40%;
  left:50%;
  
}
 body {
        width: 100%;
        height: 100%;
        margin: 10px;
        padding: 10px;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
        overflow-x:hidden;

    }
   /* * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }*/
   /* .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
       
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }*/
    .subpage {
        /* padding: 1cm; */
        /* border: 5px red solid; */
        /* height: 257mm; */
        /* outline: 2cm #FFEAEA solid; */
    }
  /* table tr
    {
      margin-bottom: 40px;
    }*/
    
    @media print {
        html, body {
           /* width: 210mm;
            height: 297mm;      */  
        }
    @page {
        size: A4;
        margin: 0;
    }
      }
  </style>
  </head>
  <body>
 



 <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="rectanglespace">
              <div class="text_main">INVOICE</div>
              <div class="pull-left">
              
              <img src="<?= base_url() ?>/new.png">
            </div>

            </div>
            
            <br><br><br><br><br><br>

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <!-- <i class="fa fa-globe"></i> AdminLTE, Inc. -->
                    <!-- <small class="float-right">Date: 2/10/2014</small> -->
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong><?php if($invoice['company_name']) {echo $invoice['company_name'] ; } ?></strong><br>
                    <?= $invoice['f_address'] ?>
                    <br>
                    Phone: <?= $invoice['f_mobile'] ?> <br>
                    Email: <?= $invoice['f_email'] ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?= $invoice['name'] ?></strong><br>
                    <?= $invoice['address'] ?><br>
                    Phone:  <?= $invoice['mobile'] ?><br>
                    Email: <?= $invoice['email'] ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  <b>Invoice NO.<?= $invoice['invoice_id'] ?></b><br>
                  <br>
                  <!-- <b>Order ID:</b> 4F3S8J<br> -->
                  <!-- <b>Payment Due:</b> 2/22/2014<br> -->
                  <!-- <b>Account:</b> 968-34567 -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <!-- <br><br><br> -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Particulars</th>
                      <th>price</th>
                      <!-- <th>Description</th>
                      <th>Subtotal</th> -->
                    </tr>
                    </thead>
                    <tbody>
                   <?= $rows ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="<?= base_url() ?>assets/admin/dist/img/credit/visa.png" alt="Visa">
                  <img src="<?= base_url() ?>assets/admin/dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="<?= base_url() ?>assets/admin/dist/img/credit/american-express.png" alt="American Express">
                  <!-- <img src="<?= base_url() ?>assets/admin/dist/img/credit/paypal2.png" alt="Paypal"> -->

                  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    This payment option are available here
                  </p>
                  <br>
                  
                  <p><div class="pull-right">
              <!-- <img src="<?= base_url() ?>/barcode.php?text=<?= $barcode ?>"> -->
            </div></p>
                </div>

                <!-- /.col -->
                <div class="col-6">
                  <!-- <p class="lead">Amount Due 2/22/2014</p> -->

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                         <td><?= $invoice['amount'] ?></td> 
                      </tr>
                        <?php ($tax=json_decode($invoice['tax'],true)) ;
                       
                        $tax_amount=0;
                        for($i=0;$i<count($tax);$i++) {
                        ?>
                      <tr>
                        <th><?=(array_keys($tax[$i]))[0] ?>(<?=(array_values($tax[$i]))[0] ?>%)</th>

                     <td><?= round(($invoice['amount']  * (array_values($tax[$i]))[0])/100) ?></td> 
                     <!-- use for total  -->
                     <?php  $tax_amount= $tax_amount+round(($invoice['amount']  * (array_values($tax[$i]))[0])/100)     ?>
                      </tr>
                      <?php } ?>
                      

                      
                      <tr>
                        <th>Total:</th>
                        <td><?= $invoice['amount']+ ($tax_amount) ?> </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <!-- <a onclick="printFunction()" id="printpagebutton" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
                 <!--  <button type="button" class="btn btn-success float-right"><i class="fa fa-credit-card"></i> Submit
                    Payment
                  </button> -->
                  <button type="button" class="btn btn-primary float-right" onclick="printFunction()" id="printpagebutton" target="_blank" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>

 
            <script type="text/javascript">
              function printFunction()
              {
                var printButton = document.getElementById("printpagebutton");
                  //Set the print button visibility to 'hidden' 
             printButton.style.visibility = 'hidden';
                window.print();
                 printButton.style.visibility = 'visible';
              }


            </script>
             </body>
  </html>