<div class="row clearfix">
           
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Profit  Chart </h2>
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
                            <canvas id="line_chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
<script src="<?= base_url() ?>assets/admin/plugins/chartjs/Chart.bundle.min.js"></script>
            <script type="text/javascript">

                 $(document).ready(function(){  
        new Chart(document.getElementById("line_chart").getContext("2d"), getChartJs('line',1));
              
    });

                function getChartJs(type,option) {
     
    var config = null;
    // var option='';
    if (type === 'line') {

         $.ajax({
        type: "POST",
        data:{id:option,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
         async:false,
        
        url: "<?= base_url() ?>reports/profit_graph",

            success: function (data) {
                // console.log(data);
            var obj=JSON.parse(data);
            console.log(obj);   
            // alert('success');
            var profit_price=[];
            // var month=[];
            var profit_month=[];
            // var sales_amount=[];
            // for(var i=0;i<obj.purchase.length;i++)
            // {
            //     month.push(obj.purchase[i].month);
            //     purchase_amount.push(obj.purchase[i].purchase_price);
            // }
            // console.log(obj[0].month);
             for(var j=0;j<obj.length;j++)
            {
                profit_month.push(obj[j].month);
                profit_price.push(obj[j].profit);
            }

            // console.log(month);
            // console.log(sales_amount);

 config = {
            type: 'line',
            data: {
                labels: profit_month,
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
                        label: "Profit Amount",
                        data: profit_price,
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
     }
return config;

 }
            </script>