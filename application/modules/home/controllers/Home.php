<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->model('Home_model');
}



function dashboard()
{

  $data['title'] = 'Dashboard';
  $data['_view'] = 'dashboard';
  $this->load->view('index',$data);
  // $this->output->enable_profiler(TRUE);

}
// function dashBoardCounting()
// {
//     $this->load->model('Home_model');
 
//   $MyOpenTicketParamsByGroup=array(
//     'f_id'=>$f_id,
//     'assign_id'=>$group_id,
//     'status'=>'open'
//   );
//   $activeCustomerParam=array(

//     'status'=>1,
//     'f_id'=>$f_id
//   );
//   $pendingInvoiceCountParams=array(
//     'f_id'=>$f_id,
//     'status'=>'pending'
//   );
//    $paidInvoiceCountParams=array(
//     'f_id'=>$f_id,
//     'status'=>'paid'
//   );
//     $partiallyInvoiceCountParams=array(
//     'f_id'=>$f_id,
//     'status'=>'partially'
//   );
//     $totalStock=array(
//       'f_id'=>$f_id,
//     );
//     $totalStockAmount=array('f_id'=>$f_id);
//    $data['total_stock_amount'] =$this->Home_model->sum_column('table_item',$totalStockAmount,'purchase_price');
//    // $data['total_stock_amount']);
//     $this->Home_model->counting('table_ticket',$totalTicketParams);
//   // $totalTicketCount=modules::run('api_call/api_call/call_api',''.api_url().'ticket/countingTickets',$totalTicketParams,'POST');
//   $data['totalTicketCount']=$totalTicketCount['data'];
//   $this->Home_model->counting('table_ticket',$totalOpenTicketParams);
//   $totalOpenTicketCount=modules::run('api_call/api_call/call_api',''.api_url().'ticket/countingTickets',$totalOpenTicketParams,'POST');
//   $data['totalOpenTicketCount']=$totalOpenTicketCount['data'];
//   $totalCloseTicketCount=modules::run('api_call/api_call/call_api',''.api_url().'ticket/countingTickets',$totalCloseTicketParams,'POST');
//   $data['totalCloseTicketCount']=$totalCloseTicketCount['data'];
//   $myOpenTicketCount=modules::run('api_call/api_call/call_api',''.api_url().'ticket/myTicketsCount',$MyOpenTicketParams,'POST');
// // $data['myOpenTicketCount']=$myOpenTicketCount['data'];
//   $myOpenTicketCountByGroup=modules::run('api_call/api_call/call_api',''.api_url().'ticket/myTicketsCount',$MyOpenTicketParamsByGroup,'POST');
//   $data['myOpenTicketCount']=$myOpenTicketCount['data']+$myOpenTicketCountByGroup['data'];
//   $myCloseTicketCount=modules::run('api_call/api_call/call_api',''.api_url().'ticket/myTicketsCount',$MyCloseTicketParams,'POST');
//   $data['myCloseTicketCount']=$myCloseTicketCount['data'];
//   ##count number of customer
//   $totalCustomerCount=modules::run('api_call/api_call/call_api',''.api_url().'caf/cafCount',$totalTicketParams,'POST');
//   $data['totalCustomer']=$totalCustomerCount['data'];
//   ##count active customer
//   $activeCustomerCount=modules::run('api_call/api_call/call_api',''.api_url().'caf/cafCount',$activeCustomerParam,'POST');
//   $data['activeCustomer']=$activeCustomerCount['data'];
//   ##total credit
//   $totalCreditCount=modules::run('api_call/api_call/call_api',''.api_url().'account/totalCredit',$totalTicketParams,'POST');
//   $data['total_credit']=$totalCreditCount['data']['credit'];
//   ##number of invoice count
//   $totalInvoiceCount=modules::run('api_call/api_call/call_api',''.api_url().'caf/cafCount',$totalTicketParams,'POST');
//   $data['total_invoices']=$totalInvoiceCount['data'];

//   $totalPendingInvoiceCount=modules::run('api_call/api_call/call_api',''.api_url().'account/countCreditInvoice',$pendingInvoiceCountParams,'POST');
//   $data['total_pending_count']=$totalPendingInvoiceCount['data'];
//   $totalPaidInvoiceCount=modules::run('api_call/api_call/call_api',''.api_url().'account/countCreditInvoice',$paidInvoiceCountParams,'POST');
//   $data['total_paid_count']=$totalPaidInvoiceCount['data'];
//    $totalPartiallyInvoiceCount=modules::run('api_call/api_call/call_api',''.api_url().'account/countCreditInvoice',$partiallyInvoiceCountParams,'POST');
//   $data['total_partially_count']=$totalPartiallyInvoiceCount['data'];
// // var_dump($data)
//   ##credit in invoice
// $totalPendingInvoiceCredit=modules::run('api_call/api_call/call_api',''.api_url().'account/sumAmountInvoice',$pendingInvoiceCountParams,'POST');
//   $data['total_pending_credit']=$totalPendingInvoiceCredit['data']['total'];
//   $totalPaidInvoiceCredit=modules::run('api_call/api_call/call_api',''.api_url().'account/sumAmountInvoice',$paidInvoiceCountParams,'POST');
//   $data['total_paid_credit']=$totalPaidInvoiceCredit['data']['total'];
//    $totalPartiallyInvoiceCredit=modules::run('api_call/api_call/call_api',''.api_url().'account/sumAmountInvoice',$partiallyInvoiceCountParams,'POST');
//   $data['total_partially_credit']=$totalPartiallyInvoiceCredit['data']['total'];

//   echo json_encode($data);
// // die;
// }


##ajax call (count  stock)
function stock_count()
{
     $f_id=$this->session->f_id;
  // $f_id=1;
    $totalStockParam=array('f_id'=>$f_id);
    $data['total_stock']=$this->Home_model->sum_column('table_item_stock',$totalStockParam,'qty_in_hand');
  
    $condition=array('f_id'=>$f_id);
    $sellStockParam=array('f_id'=>$f_id);
    // $data['sell_stock']= $this->Home_model->sum_column('table_sales_details',$sellStockParam,'quantity');
   
    // $data['total_stock_amount']=$this->Home_model->sum_column('table_purchase',$totalStockParam,'total_purchase_price');
      // $stock_balance=$this->Home_model->select('table_item_stock',$condition,array("sum(purchase_price*quantity_for_sale) as stock_balance"));
      // $data['total_stock_amount']=$stock_balance[0]['stock_balance'];
    // $data['this_month_stock_sell']=$this->Home_model->data_current_count('table_item',array('*'),$sellStockParam,"'%y-%m-01'");
   echo json_encode($data);
}

##ajax call
function account_dashboard()
{
  $f_id=$this->session->f_id;
  // $f_id=1;
   $condition=array('f_id'=>$f_id);
  $totalInvoiceParam=array('f_id'=>$f_id);
  $data['total_invoices']=$this->Home_model->counting('table_invoices',$totalInvoiceParam);
 
  $totalStockAmount=array('f_id'=>$f_id);
  $data['total_stock_amount']=$this->Home_model->sum_column('table_purchase',$totalStockAmount,'total_purchase_price');
   $data['total_payment']=$this->Home_model->sum_column('table_payment_details', $totalInvoiceParam,'amount');
  $todayCondition =array('Date(created_at)'=>date(date('Y-m-d')),'f_id'=>$f_id );
  $yesterdayCondition=array('Date(created_at)'=>date('Y-m-d',strtotime("-1 days")),'f_id'=>$f_id);
   $data['total_sell']=$this->Home_model->sum_column('table_sales',$totalStockAmount,'total');
  // print_r($total_sell);die;
   $data['s_last_one_week']=$this->Home_model->data_sum_between_date('table_sales','total',$condition,"INTERVAL 6 DAY");
  $data['s_yesterday']=$this->Home_model->sum_column('table_sales',$yesterdayCondition,'total');
  $data['s_today']=$this->Home_model->sum_column('table_sales',$todayCondition,'total');
  $data['s_last_one_month']=$this->Home_model->data_sum_between_date('table_sales','total',$condition,"INTERVAL 1 MONTH");
  $data['s_this_month']=$this->Home_model->data_sum_current('table_sales','total',$condition,"'%y-%m-01'");
  $data['s_this_year']=$this->Home_model->data_sum_current('table_sales','total',$condition,"'%y-01-01'");

    // $this->output->enable_profiler(TRUE);
   echo json_encode($data);
}
##ajax call
 function ticket_calculation()
 {
   $f_id=$this->session->f_id;
  // $f_id=1;
  $staff_id=$this->session->staff_id;
  $group_id=$this->session->group_id;
  $totalTicketParams=array(
    'f_id'=>$f_id
  );
  $totalOpenTicketParams=array(
    'f_id'=>$f_id,
    'status!='=>'close'
  );
  $totalCloseTicketParams=array(
    'f_id'=>$f_id,
    'status'=>'close'
  );
  $MyCloseTicketParams=array(
    'f_id'=>$f_id,
    'assign_id'=>$staff_id,
    'status'=>'close'
  );
  $MyOpenTicketParams=array(
    'f_id'=>$f_id,
    'assign_id'=>$staff_id,
    'status'=>'open'
  );
  $yesterdayTicketParams=array(
 'Date(created_at)'=>date('Y/m/d',strtotime("-1 days")),
 'f_id'=>$f_id
 

  );

 $data['total_ticket']=$this->Home_model->counting('table_ticket',$totalTicketParams);
 $data['open_ticket']=$this->Home_model->counting('table_ticket',$totalOpenTicketParams);
 $data['close_ticket']=$this->Home_model->counting('table_ticket',$totalCloseTicketParams);
  $data['last_one_week']=$this->Home_model->data_between_date_count('table_ticket',array('*'),$totalTicketParams,"INTERVAL 6 DAY");
  $data['yesterday']=$this->Home_model->data_between_date_count('table_ticket',array('*'),$yesterdayTicketParams);
  $data['last_one_month']=$this->Home_model->data_between_date_count('table_ticket',array('*'),$totalTicketParams,"INTERVAL 1 MONTH");
  $data['this_month']=$this->Home_model->data_current_count('table_ticket',array('*'),$totalTicketParams,"'%y-%m-01'");
  $data['this_year']=$this->Home_model->data_current_count('table_ticket',array('*'),$totalTicketParams,"'%y-01-01'");


 echo json_encode($data);

 }
##ajax call
function payment_count()
{
 $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
  $data['total_sell']=$this->Home_model->sum_column('table_sales',$condition,'total');

  
  ## total payment
  $data['total_payment']=$this->Home_model->sum_column('table_payment_details',$condition,'amount');
  
  $total_pending  = $data['total_sell'] - $data['total_payment'];
      if($total_pending>0)
      {
        $data['total_pending']=$total_pending;
      }
      else
      {
        $data['total_pending']=0;
      }
  ##today payment
  $todayCondition =array('Date(payment_date)'=>date(date('Y-m-d')),'f_id'=>$f_id );
 
  $data['today_payment']=$this->Home_model->sum_column('table_payment_details',$todayCondition,'amount');
 


/*  ...*/

  ##yesterday payment
    
    $yesterdayCondition=array('Date(payment_date)'=>date('Y/m/d',strtotime("-1 days")),'f_id'=>$f_id);
    $data['p_last_one_week']=$this->Home_model->data_sum_between_date('table_payment_details','amount',$condition,"INTERVAL 6 DAY",'payment_date');
  $data['p_yesterday']=$this->Home_model->sum_column('table_payment_details',$yesterdayCondition,'amount','payment_date');
  $data['p_today']=$this->Home_model->sum_column('table_payment_details',$todayCondition,'amount','payment_date');
  $data['p_last_one_month']=$this->Home_model->data_sum_between_date('table_payment_details','amount',$condition,"INTERVAL 1 MONTH",'payment_date');
  $data['p_this_month']=$this->Home_model->data_sum_current('table_payment_details','amount',$condition,"'%y-%m-01'",'payment_date');
  $data['p_this_year']=$this->Home_model->data_sum_current('table_payment_details','amount',$condition,"'%y-01-01'",'payment_date');

  echo json_encode($data);

}

function line_graph_sell_purchase()
{

  $id=trim($this->input->post('id'));
  // $id=1;
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
  switch($id)
  {
    #last 6 days
    case 1:
    $duration='INTERVAL 6 DAY';
     // $data['purchase']=$this->Home_model->getSellPurchaseSum('table_item',$condition,array("DAYNAME(created_at) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='DAY',$order_by='DAY');
   $data['sell']=$this->Home_model->getSellPurchaseSum('table_sales',$condition,array("DAYNAME(created_at) as month","sum(total) as sell_price","count(id) as count"),$duration,$group_by='DAY',$order_by='DAY');
   // echo $id;
    break;
    #last 1 month
    case 2:
    $duration='INTERVAL 1 MONTH';
    // $data['purchase']=$this->Home_model->getSellPurchaseSum('table_item',$condition,array("DATE(created_at) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
       $data['sell']=$this->Home_model->getSellPurchaseSum('table_sales',$condition,array("DATE(created_at) as month","sum(total) as sell_price","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
    break;
    ## this month
    case 3:
    $duration='%y-%m-01';
    // $data['purchase']=$this->Home_model->getSellPurchaseSumCurrent('table_item',$condition,array("DATE(created_at) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
       $data['sell']=$this->Home_model->getSellPurchaseSumCurrent('table_sales',$condition,array("DATE(created_at) as month","sum(total) as sell_price","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
    break;
    ##this year
     case 4:
    $duration='%y-01-01';
    // $data['purchase']=$this->Home_model->getSellPurchaseSumCurrent('table_item',$condition,array("MONTHNAME(created_at) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='MONTH',$order_by='MONTH');
       $data['sell']=$this->Home_model->getSellPurchaseSumCurrent('table_sales',$condition,array("MONTHNAME(created_at) as month","sum(total) as sell_price","count(id) as count"),$duration,$group_by='MONTHNAME',$order_by='MONTHNAME');
    break;
    default:
    {
       // $data['purchase']=$this->Home_model->getSellPurchaseSum('table_item',$condition,array("MONTHNAME(created_at) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration=null);
       $data['sell']=$this->Home_model->getSellPurchaseSum('table_sales',$condition,array("MONTHNAME(created_at) as month","sum(total) as sell_price","count(id) as count"),$duration=null);
       break;
  // print_r($data['purchase']);/
    }      
    
  }
    // $this->output->enable_profiler(TRUE);
 
  echo json_encode($data);



}
##ajx call by dashboard
function payment_graph()
{

$id=trim($this->input->post('id'));
  // $id=1;
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
  switch($id)
  {
    #last 6 days
    case 1:
    $duration='INTERVAL 6 DAY';
     // $data['purchase']=$this->Home_model->getSellPurchaseSum('table_item',$condition,array("DAYNAME(created_at) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='DAY',$order_by='DAY');
   $data['payment']=$this->Home_model->getPaymentSum('table_payment_details',$condition,array("DAYNAME(payment_date) as month","sum(amount) as payment","count(id) as count"),$duration,$group_by='DAY',$order_by='DAY');
   // echo $id;
    break;
    #last 1 month
    case 2:
    $duration='INTERVAL 1 MONTH';
    // $data['purchase']=$this->Home_model->getSellPurchaseSum('table_item',$condition,array("DATE(payment_date) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
       $data['payment']=$this->Home_model->getPaymentSum('table_payment_details',$condition,array("DATE(payment_date) as month","sum(amount) as payment","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
    break;
    ## this month
    case 3:
    $duration='%y-%m-01';
    // $data['purchase']=$this->Home_model->getSellPurchaseSumCurrent('table_item',$condition,array("DATE(payment_date) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
       $data['payment']=$this->Home_model->getPaymentCurrent('table_payment_details',$condition,array("DATE(payment_date) as month","sum(amount) as payment","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
    break;
    ##this year
     case 4:
    $duration='%y-01-01';
    // $data['purchase']=$this->Home_model->getSellPurchaseSumCurrent('table_item',$condition,array("MONTHNAME(payment_date) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='MONTH',$order_by='MONTH');
       $data['payment']=$this->Home_model->getPaymentCurrent('table_payment_details',$condition,array("MONTHNAME(payment_date) as month","sum(amount) as payment","count(id) as count"),$duration,$group_by='MONTHNAME',$order_by='MONTHNAME');
    break;
    default:
    {
       // $data['purchase']=$this->Home_model->getSellPurchaseSum('table_item',$condition,array("MONTHNAME(payment_date) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration=null);
       $data['payment']=$this->Home_model->getPaymentSum('table_payment_details',$condition,array("MONTHNAME(payment_date) as month","sum(amount) as payment","count(id) as count"),$duration=null);
       break;
  // print_r($data['purchase']);/
    }      
    
  }
    // $this->output->enable_profiler(TRUE);
 
  echo json_encode($data);


}
function ticket_calculation_in_month()
{
 $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
$data['sell']=$this->Home_model->getSellPurchaseSum('table_ticket',$condition,array("MONTHNAME(created_at) as month","count(id) as count"),$duration=null);
echo json_encode($data['sell']);

}

// function target_fetch()
// {
//   $f_id=$this->session->f_id;
//   $data['sales_count']=[];
//   $condition=array('f_id'=>$f_id);
//   $data['target']= $this->Home_model->select('table_target_sales',$condition,array('start_date','end_date','target'));
//   for($i=0;$i<count($data['target']);$i++)
//   {
//   $sales=$this->Home_model->sum_column('table_sales',$condition,'total', $data['target'][$i]['start_date'],$data['target'][$i]['end_date'] );
//   array_push($data['sales_count'],$sales);
//   }
//   // echo '<pre>';
//   // print_r($data);
//   echo json_encode($data);
// }
  


function not_found()
{
   $this->output->set_status_header('404');
  $this->load->view('404');
}
##customer or vendor count called by ajax
function customer_count()
{
 $f_id=$this->session->f_id;
$totalCrnParams=array(
    'f_id'=>$f_id
  );
  $data['last_one_week']=$this->Home_model->data_between_date_count('table_crn',array('*'),$totalCrnParams,"INTERVAL 6 DAY");
  $data['yesterday']=$this->Home_model->data_between_date_count('table_crn',array('*'),$totalCrnParams,"INTERVAL 1 DAY");
  $data['last_one_month']=$this->Home_model->data_between_date_count('table_crn',array('*'),$totalCrnParams,"INTERVAL 1 MONTH");
  $data['this_month']=$this->Home_model->data_current_count('table_crn',array('*'),$totalCrnParams,"'%y-%m-01'");
  $data['this_year']=$this->Home_model->data_current_count('table_crn',array('*'),$totalCrnParams,"'%y-01-01'");

  echo json_encode($data);
 
 }



}
?>	