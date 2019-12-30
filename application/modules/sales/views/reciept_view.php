
    <!-- Main content -->


      <div class="card ">
        <div class="body">
          <div class="row">
            <div class="col-md-12">
             <div class="top-bar-title padding-bottom">Reciept</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Default card -->
    <div class="row">
        <div class="col-md-8 right-padding-col8">
            <div class="card ">
              

              <div class="body">
                <h3 class="text-center">Payment Reciept</h3>
                <div class="row">
                  
                  <div class="col-md-4">
                    <strong><?= $company_name ?></strong>
                    <h5 class=""><?= $f_address ?></h5>
                    <h5 class=""><?= $f_city ?></h5>
                    <h5 class=""><?= $f_pincode ?></h5>
                    <!-- <h5 class=""><?= $company_city ?> , <?= $company_state ?></h5> -->
                    <!-- <h5 class="">{{ Session::get('company_country_id') }}, {{ Session::get('company_zipCode') }}</h5> -->
                  </div>                 

                  <div class="col-md-4">
                    <strong><?= $name ?></strong>
                    <h5><?= $mobile ?></h5>
                    <h5><?= $address ?></h5>
                    <h5><?= $c_pincode ?></h5> 
                  </div>

                </div>
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Payment date-     <?= $payment_date ?></h5>
                      <h5>Payment Method -   <?= $payment_method ?></h5>
                      <div class="well well-lg label-primary text-center" style="color:white">Payment Amount:  <strong><?= $amount ?></strong></div>
                    </div>
                  </div>
                 <!--  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                          <table class="table table-bordered">
                            <tbody>
                              <tr class="tbl_header_color dynamicRows">
                                <th width="20%" class="text-center">{{ trans('message.invoice.order_no') }}</th>
                                <th width="20%" class="text-center">{{ trans('message.invoice.invoice_no') }}</th>
                                <th width="20%" class="text-center">{{ trans('message.invoice.invoice_date') }}</th>
                                <th width="20%" class="text-center">{{ trans('message.invoice.invoice_amount') }}</th>
                                <th width="20%" class="text-center">{{ trans('message.invoice.paid_amount') }}</th>
                              </tr>
                              <tr>
                                <td width="20%" class="text-center">{{ $paymentInfo->order_reference }}</td>
                                <td width="20%" class="text-center">{{ $paymentInfo->invoice_reference }}</td>
                                <td width="20%" class="text-center">{{ formatDate($paymentInfo->invoice_date) }}</td>
                                <td width="20%" class="text-center">{{ Session::get('currency_symbol').number_format($paymentInfo->invoice_amount,2,'.',',') }}</td>
                                <td width="20%" class="text-center">{{ Session::get('currency_symbol').number_format($paymentInfo->amount,2,'.',',') }}</td>
                              </tr>
                            </tbody>
                          </table>
                      </div>
                      </div>
                  </div> -->
              </div>

            </div>
        </div>
        <!--Modal start-->
 <!--  -->
        <!--Modal end -->
        <!--rightpart-->
    
    <script type="text/javascript">
     
    // $('#sendPaymentReceipt').validate({
    //     rules: {
    //         email: {
    //             required: true
    //         },
    //         subject:{
    //            required: true,
    //         },
    //         message:{
    //            required: true,
    //         }                   
    //     }
    // });
    </script>
