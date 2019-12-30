<style type="text/css">
 .underline:hover
 {
 text-decoration: none;
 color:white;
 }   
.underline
{
     text-decoration: none;
      color:white;
}
</style>
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>
                <div class="page-loader-wrapper">
                    <div class="loader">
                        <div class="preloader">

                            <div class="spinner-layer pl-red">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                        <p>Please wait...</p>
                    </div>
            </div>
            <!-- Widgets -->
            <div class="row clearfix">
                <?php if($this->session->type==2 || $this->session->type==3) { ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="<?=  base_url() ?>item/item_list" class="underline" data-toogle="tooltip" title="click to view">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL STOCK </div>
                            <div class="number count-to total_stock" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><small div class="total_stock_quantity"></small></div>
                        </div>
                    </div>
                            </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">local_atm</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL STOCK AMOUNT </div>
                            <div class="number count-to total_stock_amount" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                     <a href="<?=  base_url() ?>sales/sales_list" class="underline" data-toogle="tooltip" title="click to view">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL SALES(&#8377) </div>
                            <div class="number count-to total_sell" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                   <a href="<?= base_url() ?>sales/payment_list" class="underline" data-toggle="tooltip" title="click to view">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">credit_card</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL PAYMENT (&#8377)</div>
                            <div class="number count-to total_payment" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </a>
                </div>
        <!--         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?= base_url() ?>ticket/ticket_list" class="underline">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL TICKETS</div>
                            <div class="number count-to total_ticket" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a href="<?= base_url() ?>ticket/ticket_list/open" class="underline">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">OPEN TICKETS</div>
                            <div class="number count-to open_ticket" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?= base_url() ?>ticket/ticket_list/close" class="underline">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">CLOSE TICKETS</div>
                            <div class="number count-to close_ticket" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </a>
                </div> -->
            </div>
             <div class="row clearfix">
               <!--  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="body bg-pink">
                             <div class="m-b--35 font-bold">STOCK SUMMARY</div>
                            <ul class="dashboard-stat-list">
                                <li><a href="<?= base_url() ?>item/item_list" class="underline">
                                    Total stock
                                    <span class="pull-right"><b class="total_stock"></b> <small>item</small></span>
                                     </a>
                                </li>
                           
                                <li>
                                    Sell Stock
                                    <span class="pull-right"><b class="sell_stock"></b> <small>item</small></span>
                                </li> 
                                <li>
                                    Total Stock Amount
                                    <span class="pull-right"><b class="total_stock_amount"></b> <small>&#8377</small></span>
                                </li>
                                <li>
                                    Sell Stock This Month
                                    <span class="pull-right"><b class="this_month_stock_sell"></b> <small>item</small></span>
                                </li>
                              
                            </ul>
                        </div>
                    </div>
                </div> -->
                <!-- #END# Visitors -->
                <!-- Latest Social Trends -->

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-cyan">
                            <div class="m-b--35 font-bold">SALES SUMMARY</div>
                            <ul class="dashboard-stat-list">
                                 <li>
                                    <a href="<?= base_url() ?>sales/sales_list" class="underline" data-toggle="tooltip" title="click to view">
                                    TOTAL SALES
                                    <span class="pull-right"><b class="total_sell"></b> <small>&#8377</small></span>
                                </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>sales/invoice_list" class="underline" data-toogle="tooltip" title="click to view">
                                    TOTAL INVOICE
                                    <span class="pull-right">
                                        <b class="total_invoice"></b>
                                    </span>
                                </a>
                                </li>
                              <!--   <li>
                                    Today Invoice
                                    <span class="pull-right">
                                        <b class="today_invoice"></b>
                                    </span>
                                </li> -->
                                <!-- <li>Total Stock Amount<span class="pull-right">
                                        <b class="total_stock_amount"></b> &#8377
                                    </span></li> -->
                                   
                                <!-- <li>Total Profit<span class="pull-right">
                                        <b class="total_profit"></b> &#8377
                                    </span></li> -->
                                     <li>
                                     <a href="<?= base_url() ?>sales/sales_list?status=1" class="underline" data-toggle="tooltip" title="click to view">
                                    TODAY SALES
                                    <span class="pull-right"><b class="today_sell"></b> <small>&#8377</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>sales/sales_list?status=2" class="underline" data-toggle="tooltip" title="click to view">
                                    YESTERDAY SALES
                                    <span class="pull-right"><b class="s_yesterday"></b> <small>&#8377</small></span>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>sales/sales_list?status=3" class="underline" data-toggle="tooltip" title="click to view">
                                    LAST ONE WEEK SALES
                                    <span class="pull-right"><b class="s_last_one_week"></b> <small>&#8377</small></span>
                                         </a>    
                                </li>
                                 <li>
                                    <a href="<?= base_url() ?>sales/sales_list?status=4" class="underline" data-toggle="tooltip" title="click to view">
                                    LAST ONE  MONTH SALES
                                    <span class="pull-right"><b class="s_last_one_month"></b> <small>&#8377</small></span>
                                </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>sales/sales_list?status=5" class="underline" data-toggle="tooltip" title="click to view">
                                    THIS MONTH SALES
                                    <span class="pull-right"><b class="s_this_month"></b> <small>&#8377</small></span>
                                </li>
                                <li>
                                     <a href="<?= base_url() ?>sales/sales_list?status=6" class="underline" data-toggle="tooltip" title="click to view">
                                    THIS YEAR SALES
                                    <span class="pull-right"><b class="s_this_year"></b> <small>&#8377</small></span>
                                </a>
                                </li>
                                <!-- <li>#bootstraptemplate</li>
                                <li>
                                    #freehtmltemplate
                                    <span class="pull-right">
                                        <i class="material-icons">trending_up</i>
                                    </span>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Latest Social Trends -->
                <!-- Answered Tickets -->
               
                 <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">PAYMENT DETAILS</div>
                            <ul class="dashboard-stat-list">
                               <!--  <li>
                                    TODAY
                                    <span class="pull-right"><b>12</b> <small>TICKETS</small></span>
                                </li> -->
                                 <!-- <li>
                                    <a href="<?= base_url() ?>sales/sales_list" class="underline" data-toggle="tooltip" title="click to view">
                                    TOTAL SELL
                                    <span class="pull-right"><b class="total_sell"></b> <small>&#8377</small></span>
                                </a>
                                </li> -->
                                <li>
                                      <a href="<?= base_url() ?>sales/payment_list" class="underline" data-toggle="tooltip" title="click to view">
                                    TOTAL PAYMENT
                                    <span class="pull-right"><b class="total_payment"></b> <small>&#8377</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>account/invoice_list?status=pending" class="underline" data-toggle="tooltip" title="click to view">
                                    PAYMENT PENDING
                                    <span class="pull-right"><b class="payment_pending"></b> <small>&#8377</small></span>
                                    </a>
                                </li>
                                <li>
                                     <a href="<?= base_url() ?>sales/payment_list?status=1" class="underline" data-toggle="tooltip" title="click to view">
                                    TODAY PAYMENT
                                    <span class="pull-right"><b class="p_today"></b> <small>&#8377</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>sales/payment_list?status=2" class="underline" data-toggle="tooltip" title="click to view">
                                    YESTERDAY PAYMENT
                                    <span class="pull-right"><b class="p_yesterday"></b> <small>&#8377</small></span>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>sales/payment_list?status=3" class="underline" data-toggle="tooltip" title="click to view">
                                    LAST ONE WEEK PAYMENT
                                    <span class="pull-right"><b class="p_last_one_week"></b> <small>&#8377</small></span>
                                         </a>    
                                </li>
                                 <li>
                                    <a href="<?= base_url() ?>sales/payment_list?status=4" class="underline" data-toggle="tooltip" title="click to view">
                                    LAST ONE  MONTH PAYMENT
                                    <span class="pull-right"><b class="p_last_one_month"></b> <small>&#8377</small></span>
                                </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>sales/payment_list?status=5" class="underline" data-toggle="tooltip" title="click to view">
                                    THIS MONTH PAYMENT
                                    <span class="pull-right"><b class="p_this_month"></b> <small>&#8377</small></span>
                                </li>
                                <li>
                                     <a href="<?= base_url() ?>sales/payment_list?status=6" class="underline" data-toggle="tooltip" title="click to view">
                                    THIS YEAR PAYMENT
                                    <span class="pull-right"><b class="p_this_year"></b> <small>&#8377</small></span>
                                </a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-orange">
                            <div class="font-bold m-b--35"> TICKETS SUMMARY</div>
                            <ul class="dashboard-stat-list">
                                <a href="<?= base_url() ?>ticket/ticket_list" class="underline">
                                <li>
                                    TOTAL TICKETS
                                    <span class="pull-right"><b class="total_ticket"></b> <small>TICKETS</small></span>
                                </li>
                                </a><a href="<?= base_url() ?>ticket/ticket_list/open" class="underline">
                                <li>
                                    TOTAL OPEN TICKETS
                                    <span class="pull-right"><b class="open_ticket"></b> <small>TICKETS</small></span>
                                </li>
                                </a><a href="<?= base_url() ?>ticket/ticket_list/close" class="underline">
                                <li>
                                    TOTAL CLOSED TICKETS
                                    <span class="pull-right"><b class="close_ticket"></b> <small>TICKETS</small></span>
                                </li>
                                </a>
                                 <a href="<?= base_url() ?>ticket/ticket_list/1" class="underline">
                                <li>
                                    YESTERDAY
                                    <span class="pull-right"><b class="yesterday"></b> <small>TICKETS</small></span>
                                </li>
                            </a>
                                 <a href="<?= base_url() ?>ticket/ticket_list/2" class="underline">
                                <li>
                                    LAST ONE WEEK
                                    <span class="pull-right"><b class="last_one_week"></b> <small>TICKETS</small></span>
                                </li>
                            </a>
                             <a href="<?= base_url() ?>ticket/ticket_list/3" class="underline">
                                <li>
                                    THIS MONTH
                                    <span class="pull-right"><b class="this_month"></b> <small>TICKETS</small></span>
                                </li>
                            </a>
                             <a href="<?= base_url() ?>ticket/ticket_list/4" class="underline">
                                 <li>
                                    LAST ONE  MONTH
                                    <span class="pull-right"><b class="last_one_month"></b> <small>TICKETS</small></span>
                                </li>
                            </a>
                             <a href="<?= base_url() ?>ticket/ticket_list/5" class="underline">
                                <li>
                                    THIS YEAR
                                    <span class="pull-right"><b class="this_year"></b> <small>TICKETS</small></span>
                                </li>
                            </a>
                              
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->
            </div>
                             <!-- #start Line Chart-->
<div class="row clearfix">
           
             <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
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
                            <canvas id="line_chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
           
           
                 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Payment  Chart </h2>
                            <!-- <h2>ddd</h2> -->
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" onclick="paymentGraph(1)">LAST 7 DAYS</a></li>
                                        <li><a href="javascript:void(0);" onclick="paymentGraph(2)">LAST MONTH</a></li>
                                        <li><a href="javascript:void(0);" onclick="paymentGraph(3)">THIS MONTH</a></li>
                                        <li><a href="javascript:void(0);" onclick="paymentGraph(4)">THIS YEAR</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <canvas id="line_chart_payment" height="150"></canvas>
                        </div>
                    </div>
                </div>
           
          
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Ticket Generation Chart </h2>
                            <!-- <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul> -->
                        </div>
                        <div class="body">
                            <canvas id="ticket_chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
          

            </div>
             <!-- <div class="row clearfix sales_target"> -->
             

                <!--  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>SALES TARGET</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                         <div class="body">
                            <div class="">TARGET FOR THIS FINANCIAL YEAR - <b class="target"></b>&#8377</div>
                              <div class="progress">
                                <div class="progress-bar bg-cyan progress-bar-striped active" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 75%">
                                    <div class="sale_target"></div>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
             -->
            
               
                       
                                <!-- <div class="col-xs-12 ol-sm-12 col-md-4 col-lg-4">
                                   
                                    <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingOne_1">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_1" onclick="customerData()">
                                                        Customer Information    
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_1">
                                                <div class="panel-body">
                                                         <ul class="dashboard-stat-list">
                            
                                                            <li>
                                                                YESTERDAY
                                                                <span class="pull-right"><b class="c_yesterday"></b> </span>
                                                            </li>
                                                            <li>
                                                                LAST ONE WEEK
                                                                <span class="pull-right"><b class="c_last_one_week"></b> </span>
                                                            </li>
                                                            <li>
                                                                THIS MONTH
                                                                <span class="pull-right"><b class="c_this_month"></b> </span>
                                                            </li>
                                                             <li>
                                                                LAST ONE  MONTH
                                                                <span class="pull-right"><b class="c_last_one_month"></b> </span>
                                                            </li>
                                                            <li>
                                                                THIS YEAR
                                                                <span class="pull-right"><b class="c_this_year"></b> </span>
                                                            </li>
                                                            <li>
                                                                ALL
                                                                <span class="pull-right"><b class="total_customer"></b> </span>
                                                            </li>
                                                        </ul>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div> -->
                                <!-- </div> -->
            <!-- </div> -->
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <!-- <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>CPU USAGE (%)</h2>
                                </div>
                                <div class="col-xs-12 col-sm-6 align-right">
                                    <div class="switch panel-switch-btn">
                                        <span class="m-r-10 font-12">REAL TIME</span>
                                        <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                    </div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="real_time_chart" class="dashboard-flot-chart"></div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- #END# CPU Usage -->


                <!-- #END# Line Chart -->
            <!-- <div class="row clearfix"> -->
                <!-- Visitors -->
               
                                       
           <!--  <div class="row clearfix">
               
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>TASK INFOS</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Status</th>
                                            <th>Manager</th>
                                            <th>Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Task A</td>
                                            <td><span class="label bg-green">Doing</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Task B</td>
                                            <td><span class="label bg-blue">To Do</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Task C</td>
                                            <td><span class="label bg-light-blue">On Hold</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Task D</td>
                                            <td><span class="label bg-orange">Wait Approvel</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Task E</td>
                                            <td>
                                                <span class="label bg-red">Suspended</span>
                                            </td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- #END# Task Info -->
                <!-- Browser Usage -->
               <!--  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>BROWSER USAGE</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="donut_chart" class="dashboard-donut-chart"></div>
                        </div>
                    </div>
                </div> -->
                <!-- #END# Browser Usage -->
            
             <!-- Chart Plugins Js -->
    <script src="<?= base_url() ?>assets/admin/plugins/chartjs/Chart.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/admin/plugins/jquery-countto/jquery.countTo.js"></script>

   
    <script type="text/javascript">
   $(document).ready(function(){  
    stock();
    account_info();
    ticket_info();
    // target();
    paymentData();
    // lineGraph();
   
        new Chart(document.getElementById("line_chart").getContext("2d"), getChartJs('line'));
    
        new Chart(document.getElementById("line_chart_payment").getContext("2d"),getPaymentChartJs('line'));

    new Chart(document.getElementById("ticket_chart").getContext("2d"), getChartJs('bar'));
    // ticketGraph();
});
   function stock(){   
        $.ajax({
        type: "GET",
        url: "<?= base_url() ?>home/stock_count",

success: function (data) {
var obj=JSON.parse(data);
// console.log(obj.total_stock);
$('.total_stock').html(obj.total_stock);
$('.total_stock_quantity').html(obj.total_qty);
// $('.sell_stock').html(obj.sell_stock);
// $('.total_stock_amount').html(obj.total_stock_amount.toLocaleString('en-IN'));
// $('.this_month_stock_sell').html(obj.this_month_stock_sell);
},
});
}


function account_info()
{
    $.ajax({
        type: "GET",
        url: "<?= base_url() ?>home/account_dashboard",

success: function (data) {
var obj=JSON.parse(data);
// console.log(obj);
// $('.total_stock_amount').html(obj.total_stock_amount);
$('.total_invoice').html(obj.total_invoices);
// $('.today_invoice').html(obj.today_invoices);
// $('.total_profit').html(obj.total_profit);
// $('.total_profit').html(obj.total_profit);
// $('.total_profit').html(obj.total_profit);
$('.total_sell').html(obj.total_sell);
$('.s_this_month').html(obj.s_this_month);
            $('.s_this_year').html(obj.s_this_year);
            $('.s_yesterday').html(obj.s_yesterday);
            $('.s_last_one_month').html(obj.s_last_one_month);
            $('.s_last_one_week').html(obj.s_last_one_week);
            $('.total_payment').html(obj.total_payment);
             $('.payment_pending').html(obj.total_pending);
             $('.today_sell').html(obj.s_today);


},

});
}
function ticket_info()
{
    $.ajax({
        type: "GET",
        url: "<?= base_url() ?>home/ticket_calculation",

success: function (data) {
var obj=JSON.parse(data);
// console.log(obj);
$('.total_ticket').html(obj.total_ticket);
$('.open_ticket').html(obj.open_ticket);
// $('.today_invoice').html(obj.today_invoices);
$('.close_ticket').html(obj.close_ticket);
$('.this_month').html(obj.this_month);
$('.this_year').html(obj.this_year);
$('.yesterday').html(obj.yesterday);
$('.last_one_month').html(obj.last_one_month);
$('.last_one_week').html(obj.last_one_week);
// $('.total_sell').html(obj.total_sell);


},

});
}

function lineGraph(id)
{
    // $(function () {
    new Chart(document.getElementById("line_chart").getContext("2d"), getChartJs('line',id));
  
    // new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));
    // new Chart(document.getElementById("radar_chart").getContext("2d"), getChartJs('radar'));
    // new Chart(document.getElementById("pie_chart").getContext("2d"), getChartJs('pie'));
// });
}
function paymentGraph(id)
{
      new Chart(document.getElementById("line_chart_payment").getContext("2d"),getPaymentChartJs('line',id));
}
function getChartJs(type,option) {
        // console.log(option);
    var config = null;
    // var option='';
    if (type === 'line') {

         $.ajax({
        type: "POST",
        data:{id:option,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
         async:false,
        
        url: "<?= base_url() ?>home/line_graph_sell_purchase",

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
    }
    else if(type==='bar')
    { 
        $.ajax({
        type: "GET",
         async:false,
        url: "<?= base_url() ?>home/ticket_calculation_in_month",

            success: function (data) { 
                var obj=JSON.parse(data);
                // console.log(obj);
                var month=[];
            var count=[];
            // var sales_amount=[];
            for(var i=0;i<obj.length;i++)
            {
                month.push(obj[i].month);
                count.push(obj[i].count);
            }
         config = {
            type: 'bar',
            data: {
                labels: month,
                datasets: [{
                    label: "Ticket Count",
                    data: count,
                    backgroundColor: 'rgba(0, 188, 212, 0.8)'
                },
                 // {
                 //        label: "My Second dataset",
                 //        data: [28, 48, 40, 19, 86, 27, 90],
                 //        backgroundColor: 'rgba(233, 30, 99, 0.8)'
                 //    }
                    ]
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
  // console.log(config);
    return config;
}



/*for payment chart.js*/
function getPaymentChartJs(type,option) {
        // console.log(option);
    var config = null;
    // var option='';
    if (type === 'line') {

         $.ajax({
        type: "POST",
        data:{id:option,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
         async:false,
        
        url: "<?= base_url() ?>home/payment_graph",

            success: function (data) {
                console.log(data);
            var obj=JSON.parse(data);
            console.log(obj);   
            // alert('success');
            var payment_amount=[];
            var month=[];
            // var sales_month=[];
            // var sales_amount=[];
            // for(var i=0;i<obj.purchase.length;i++)
            // {
            //     month.push(obj.purchase[i].month);
            //     purchase_amount.push(obj.purchase[i].purchase_price);
            // }

             for(var j=0;j<obj.payment.length;j++)
            {
                month.push(obj.payment[j].month);
                payment_amount.push(obj.payment[j].payment);
            }

            // console.log(month);
            // console.log(sales_amount);

 config = {
            type: 'line',
            data: {
                labels:month,
                datasets: [

                {
                    label: "Payment Amount",
                    data: payment_amount,
                    borderColor: 'rgba(0, 188, 212, 0.75)',
                    backgroundColor: 'rgba(0, 188, 212, 0.3)',
                    pointBorderColor: 'rgba(0, 188, 212, 0)',
                    pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                    pointBorderWidth: 1
                }, 
                // {
                //         label: "Sale Amount",
                //         data: sales_amount,
                //         borderColor: 'rgba(233, 30, 99, 0.75)',
                //         backgroundColor: 'rgba(233, 30, 99, 0.3)',
                //         pointBorderColor: 'rgba(233, 30, 99, 0)',
                //         pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
                //         pointBorderWidth: 1
                //     }
                    ]
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

  // console.log(config);
    return config;
}
/*---------*/
function ticketGraph()
{



        $.ajax({
        type: "GET",
         async:false,
        url: "<?= base_url() ?>home/ticket_calculation_in_month",

            success: function (data) { 
         config = {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    data: [65, 59, 80, 81, 56, 55, 40],
                    backgroundColor: 'rgba(0, 188, 212, 0.8)'
                }, {
                        label: "My Second dataset",
                        data: [28, 48, 40, 19, 86, 27, 90],
                        backgroundColor: 'rgba(233, 30, 99, 0.8)'
                    }]
            },
            options: {
                responsive: true,
                legend: false
            }
        }
    },
});
    }

// function target()
// {
//      $.ajax({
//         type: "GET",
//         url: "<?= base_url() ?>home/target_fetch",

// success: function (data) {
// var obj=JSON.parse(data);
// // console.log(obj.target);
// if(obj.target=='' && obj.target==null)
// {

//     $('.sales_target').hide();
//     // console.log("Ddd");
     

// }
// else
// {
//    $('.sales_target').show();
// // console.log(obj['sales_count'][0]);
// var target=obj['target'][0]['target'];
//     $('.target').html(target);
// // $('.today_invoice').html(obj.today_invoices);
//     var sale=obj['sales_count'][0];
//         var percentage=(sale/target)*100;
//             var decimalPercent=percentage.toFixed(2);
//             // console.log(decimalPercent);
//     $('.sale_target').html(decimalPercent+'%');
// // $('.total_sell').html(obj.total_sell);
// $(".progress-bar").attr("aria-valuenow", ""+decimalPercent+"");
// // $(".progress-bar").attr("width", "50");
// $(".progress-bar").attr('style',  'width:'+decimalPercent+'%');
// }
// },
// error:function(data)
// {
//     console.log('server side error');
// }

// });
// }

function purchase_chart_analysis()
{

}
  
  function customerData()
  {
     $.ajax({
        type: "GET",
        url: "<?= base_url() ?>home/customer_count",

            success: function (data) {
                var obj=JSON.parse(data);
            $('.c_this_month').html(obj.this_month);
            $('.c_this_year').html(obj.this_year);
            $('.c_yesterday').html(obj.yesterday);
            $('.c_last_one_month').html(obj.last_one_month);
            $('.c_last_one_week').html(obj.last_one_week);
                
            },
                });

  }


  function paymentData()
  {
        $.ajax({
        type: "GET",
        url: "<?= base_url() ?>home/payment_count",

            success: function (data) {
                var obj=JSON.parse(data);
                // console.log(obj);
            $('.p_this_month').html(obj.p_this_month.toLocaleString('en-IN'));
            $('.p_this_year').html(obj.p_this_year);
            $('.p_yesterday').html(obj.p_yesterday);
            $('.p_last_one_month').html(obj.p_last_one_month);
            $('.p_last_one_week').html(obj.p_last_one_week);
            $('.total_payment').html(obj.total_payment);
             $('.payment_pending').html(obj.total_pending);
             $('.p_today').html(obj.p_today);
                
            },
            error:function(data)
                            {
                                    console.log('error');
                            }  ,          
                });


  }


    </script>