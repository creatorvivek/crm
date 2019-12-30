
<div class="row clearfix">
   <div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>
                Item Details

            </h2>

        </div>
        <div class="body">
            <div class="row clearfix">
            <div class="col-md-6">
               <!--  <p>item  name - <span class="heading_item"><?= $item_details['item_name'] ?> </span></p><br>
                <p>Company name <span class="heading_item"><?= $item_details['company_name'] ?> </span></p><br> -->
                <div class="card profile-card">
                        <!-- <div class="profile-header">&nbsp;</div> -->
                        <!-- <div class="profile-body"> -->
                           <div class="header">Item Details</div>
                           
                        <!-- </div> -->
                        <div class="profile-footer">
                            <ul>
                                <li>
                                    <span>Item  Name</span>
                                    <span><?= $item_details['item_name'] ?></span>
                                </li>
                                <li>
                                    <span>Company Name</span>
                                    <span><?= $item_details['company_name'] ?></span>
                                </li>
                                <li>
                                    <span>Unit</span>
                                    <span><?= $item_details['measurement_unit'] ?></span>
                                </li>
                                <li>
                                    <span>Description</span>
                                    <span><?= $item_details['description'] ?></span>
                                </li>
                                 <li>
                                    <span>Category</span>
                                    <span><?= $item_details['category_name'] ?></span>
                                </li>
                                <li>
                                    <span>Hsn </span>
                                    <span><?= $item_details['hsn'] ?></span>
                                </li>
                                <li>
                                    <span>Created Source</span>
                                    <span><?= $item_details['staff_name'] ?></span>
                                </li>
                                 <li>
                                    <span>Created At</span>
                                    <span><?= $item_details['created_at'] ?></span>
                                </li>
                            </ul>
                           
                        </div>
                    </div>
            </div>
            <div class="col-md-6">
             
                    <div class="card profile-card">
                        <div class="header">Stock Details</div>
                        <!-- <div class="profile-body">
                           
                           
                        </div> -->
                        <div class="profile-footer">
                            <ul>
                                <li>
                                    <span>Opening stock</span>
                                    <span><?= $item_details['opening_balance'] ?></span>
                                </li>
                                <li>
                                    <span>Stock in hand</span>
                                    <span><?= $item_details['qty_in_hand'] ?></span>
                                </li>
                                <li>
                                    <span>Stock purchase</span>
                                    <span><?= $item_details['qty_purchase'] ?></span>
                                </li>
                                <li>
                                    <span>Stock sale</span>
                                    <span><?= $item_details['qty_sale'] ?></span>
                                </li>
                                
                            </ul>
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
         <!--    </div>
        </div> -->
<div class="row clearfix">
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h2>
                   <?= isset($heading)?$heading:'PURCHASE LIST' ?>

               </h2>

           </div>
           <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>#Purchase id</th>

                            <th>Qty</th>
                            <!-- <th>Vendor</th> -->
                            <th>Amount/unit</th>
                            <th>Total</th>
                            <th>Date</th>



                        </tr>
                    </thead>

                    <tbody>
                       <?php foreach($item_purchase as $row)
                       { ?>
                        <tr>
                            <td><?= $row['purchase_id'] ?></td>
                            <td><?= $row['qty'] ?></td>

                            <td><?= $row['purchase_price'] ?></td>
                            <td><?= $row['amount'] ?></td>
                            <td><?= $row['created_at'] ?></td>

                            
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- ## sales -->
<div class="col-lg-6 col-md-6">
    <div class="card">
        <div class="header">
            <h2>
                <?= isset($heading)?$heading:'SALES LIST' ?>

            </h2>

        </div>
        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>#order id</th>

                            <th>Qty</th>

                            <!-- <th>Amount/unit</th> -->
                            <th>Total</th>
                            <th>date</th>



                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($item_sales as $row)
                        { ?>
                            <tr>
                                <td><?= $row['order_no'] ?></td>
                                <td><?= $row['quantity'] ?></td>

                                <td><?= $row['price'] ?></td>
                                <td><?= $row['created_at'] ?></td>
                                <!-- <td><?= $row['amount'] ?></td> -->


                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

     <div class="col-md-10">
                    <div class="card">
                        <div class="header">
                            <h2>Sales  Chart </h2>
                            <!-- <h2>ddd</h2> -->
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" onclick="lineGraph(1)">LAST 7 DAYS</a></li>
                                        <li><a href="javascript:void(0);" onclick="lineGraph(2)">LAST MONTH</a></li>
                                        <li><a href="javascript:void(0);" onclick="lineGraph(3)">THIS MONTH</a></li>
                                        <li><a href="javascript:void(0);" onclick="lineGraph(4)">THIS YEAR</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <canvas id="line_chart" height="120"></canvas>
                        </div>
                    </div>
                </div>

</div>
</div>
</div>
</div>
</div>

<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?= base_url() ?>assets/admin/js/pages/tables/jquery-datatable.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/chartjs/Chart.bundle.min.js"></script>
<script type="text/javascript">
     $(document).ready(function(){  
        lineGraph(3);
     });
    function lineGraph(id)
{

    new Chart(document.getElementById("line_chart").getContext("2d"), getChartJs('line',id));
  
}

function getChartJs(type,option) {
        // console.log(option);

        var item_id="<?= $this->uri->segment(3) ?>"
    var config = null;
    // var option='';
    if (type === 'line') {

         $.ajax({
        type: "POST",
        data:{id:option,item_id:item_id,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
         async:false,
        
        url: "<?= base_url() ?>item/item_sale_graph",

            success: function (data) {
                console.log(data);
            var obj=JSON.parse(data);
            console.log(obj);   
            // alert('success');
            var purchase_amount=[];
            var month=[];
            var sales_month=[];
            var sales_amount=[];
            // for(var i=0;i<obj.purchase.length;i++)
            // {
            //     month.push(obj.purchase[i].month);
            //     purchase_amount.push(obj.purchase[i].purchase_price);
            // }

             for(var j=0;j<obj.sell.length;j++)
            {
                sales_month.push(obj.sell[j].month);
                sales_amount.push(obj.sell[j].sell_price);
            }

            // console.log(month);
            // console.log(sales_amount);

 config = {
            type: 'line',
            data: {
                labels: sales_month,
                datasets: [

                // {
                //     label: "Purchase Amount",
                //     data: purchase_amount,
                //     borderColor: 'rgba(0, 188, 212, 0.75)',
                //     backgroundColor: 'rgba(0, 188, 212, 0.3)',
                //     pointBorderColor: 'rgba(0, 188, 212, 0)',
                //     pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                //     pointBorderWidth: 1
                // }, 
                {
                        label: "Sale Amount",
                        data: sales_amount,
                        borderColor: 'rgba(233, 30, 99, 0.75)',
                        backgroundColor: 'rgba(233, 30, 99, 0.3)',
                        pointBorderColor: 'rgba(233, 30, 99, 0)',
                        pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
                        pointBorderWidth: 1
                    }]
            },
            options: {
                responsive: true,
                legend: false
            }
        }
    },
    error:function(data)
    {
        // alert('can not connect to server');
        console.log('can not connect to server')
    },

});
         return config;
     }
 }















</script>