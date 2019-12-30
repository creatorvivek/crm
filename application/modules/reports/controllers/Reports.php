
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->helper('user_helper');
  $this->load->model('Reports_model');
  if($this->session->authorization_id != 2)
  {

     show_error('You have not permitted to open this ');
  }
}



/*function profit_analysis()
{
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);  
  if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $date_range = explode(' - ',$this->input->post('date_range'));
    $start_date = date_change_db($date_range[0]);


    $end_date = date_change_db($date_range[1]);

    $sales_sum=$this->Reports_model->report('table_sales',array("sum(total) as 'sell_total'"),$condition,$start_date,$end_date,'',$coloumn='created_at');
    $data['sales_sum']=$sales_sum[0]['sell_total'];
  // print_r($data['sumSales']);die;
    $purchase_sum=$this->Reports_model->report('table_purchase',array("sum(total_purchase_price) as 'purchase_price'","sum(quantity_for_sale*purchase_price) as stock_remain"),$condition,$start_date,$end_date,'',$coloumn='created_at');
    $data['purchase_sum']=$purchase_sum[0]['purchase_price'];
    $stockReaminingPrice=$purchase_sum[0]['stock_remain'];
    $data['profit']=$data['sales_sum']-$data['purchase_sum']+$stockReaminingPrice;
  // print_r($data['purchase_sum']);die;
// report($table_name,$display_contents,$condition,$start_date='',$end_date='',$status='',$coloumn='created_at')
  }
  $data['_view'] = 'profitgraph';
  $this->load->view('index.php',$data);

}

function profit_graph()
{

 $f_id=$this->session->f_id;
 $condition=array('f_id'=>$f_id);
 $sales_sum=$this->Reports_model->data_between_date('table_sales_details',array("sum(price-(quantity*purchase_price)) as 'profit'","sum(price) as sales","MONTHNAME(created_at) as month"),$condition,'','',$group_by='MONTH',$order_by='MONTH');
  // echo '<pre>';
  // print_r($sales_sum);
 echo json_encode($sales_sum);

}

function profit_graph_show()
{

 $data['_view'] = 'profit_graph';
 $this->load->view('index.php',$data);
}
function sales_analysis()
{
  $f_id=$this->session->f_id;

  $condition=array('f_id'=>$f_id);  
  $purchase_condition='purchase_price';
  $selling_condition='selling_price';
  $sumPurchase=$this->Reports_model->salesAnalysis('table_item_graph',$condition,$purchase_condition);
  $sumSales=$this->Reports_model->salesAnalysis('table_item_graph',$condition,$selling_condition);
  
  print_r($sumPurchase);
  print_r($sumSales);
}*/

function sales_report()
{

   $data['title'] = 'SALES LIST';
    $f_id = $this->session->f_id;
    $staff_id = $this->session->staff_id;
    $data['heading'] = 'SALES LIST';
    $this->load->model('sales/Sales_model');
    if($_SERVER['REQUEST_METHOD'] == 'POST' )
    {
     $this->load->helper('user_helper');
     $date_range = explode(' - ',$this->input->post('date_range'));
     $start_date = date_change_db($date_range[0]);


     $end_date = date_change_db($date_range[1]);
    // }

     $condition=array(

      'sales.f_id'=>$f_id,

    );


     $itemList = $this->Sales_model->sales_report('table_sales',array('customer_name', 'sales.email', 'sales.mobile', 'total', 'staff.name as staff_name', 'sales.created_at', 'sales.order_id','customer_id'),$condition,$start_date,$end_date,$status='');
   }
   else
   {
    // $params = array('sales.f_id' => $f_id);
    // $itemList = $this->Sales_model->sales_list('table_sales', $params, array('customer_name', 'sales.email', 'sales.mobile', 'total', 'staff.name as staff_name', 'sales.created_at', 'sales.order_id','customer_id'));
    $status=trim($this->input->get('status',1));
    $table_row='sales.created_at';
    switch($status)
    {
    #today sales
      case 1:
      $condition=array('sales.f_id'=>$f_id,'date(sales.created_at)'=>date('Y-m-d'));
      $itemList = $this->Sales_model->sales_list('table_sales', $condition, array('customer_name', 'sales.email', 'sales.mobile', 'total', 'staff.name as staff_name', 'sales.created_at', 'sales.order_id','customer_id'));
      break;
            ##yesterday
      case 2:
      $condition=array('sales.f_id'=>$f_id,'date(sales.created_at)'=>date('Y-m-d',strtotime("-1 days")));
      $itemList = $this->Sales_model->sales_list('table_sales', $condition, array('customer_name', 'sales.email', 'sales.mobile', 'total', 'staff.name as staff_name', 'sales.created_at', 'sales.order_id','customer_id'));
      break;
             ##1 week
      case 3:
      $condition=array('sales.f_id'=>$f_id);
    
      $itemList = $this->Sales_model->sales_list('table_sales',$condition,array('customer_name', 'sales.email', 'sales.mobile', 'total', 'staff.name as staff_name', 'sales.created_at', 'sales.order_id','customer_id'),'INTERVAL 6 DAY',$table_row);
      break;

              ##last one month
      case 4:
      $condition=array('sales.f_id'=>$f_id);
     
      $itemList = $this->Sales_model->sales_list('table_sales',$condition,array('customer_name', 'sales.email', 'sales.mobile', 'total', 'staff.name as staff_name', 'sales.created_at', 'sales.order_id','customer_id'),'INTERVAL 1 MONTH',$table_row);
      break;
              ##this month
      case 5:
      $condition=array('sales.f_id'=>$f_id);
    
      $itemList = $this->Sales_model->sales_list_current('table_sales',array('customer_name', 'sales.email', 'sales.mobile', 'total', 'staff.name as staff_name', 'sales.created_at', 'sales.order_id','customer_id'),$condition,"'%y-%m-01'",$table_row);
      break;
              ##this year
      case 6:
      $condition=array('sales.f_id'=>$f_id);
    
      $itemList = $this->Sales_model->sales_list_current('table_sales',array('customer_name', 'sales.email', 'sales.mobile', 'total', 'staff.name as staff_name', 'sales.created_at', 'sales.order_id','customer_id'),$condition,"'%y-01 -01'",$table_row);
      break;

      default:
      {
        $condition=array('sales.f_id'=>$f_id);
        $itemList = $this->Sales_model->sales_list('table_sales', $condition, array('customer_name', 'sales.email', 'sales.mobile', 'total', 'staff.name as staff_name', 'sales.created_at', 'sales.order_id','customer_id'));

      }
    }
  }
   // echo '<pre>';
    // print_r($itemList);die;
  // $categoryParam=array('f_id'=>$f_id);
  // $this->load->model('category/Category_model');
  // $category=$this->Category_model->select('table_category',$categoryParam,array('category_id','name'));
  // $data['category']=$category;
  // $this->output->enable_profiler(TRUE);
   // die;

  $data['item'] = $itemList;
  // $this->output->enable_profiler(TRUE);
  $data['_view'] = 'sales_report';
  $this->load->view('index', $data);
}







function invoice_report()
{
  $f_id=$this->session->f_id;
  if($this->input->get('status')=='pending')
  {
    $invoiceParam=array(
    'f_id'=>$f_id,
    'status!='=>'paid'
       );  
    $invoice_list=$this->Reports_model->select('table_invoices',$invoiceParam,array('id','name','mobile','email','amount','paid','status','invoice_id','created_at','total','customer_id'));
  }
 
else if($_SERVER['REQUEST_METHOD'] == 'POST' )
  {
     $this->load->helper('user_helper');
    $date_range = explode(' - ',$this->input->post('date_range'));
    $start_date = date_change_db($date_range[0]);


    $end_date = date_change_db($date_range[1]);
    // }
  
    $condition=array(
   
      'f_id'=>$f_id,
     
    );
  // var_dump($ledgerParam);
  // die;
    $invoice_list= $this->Reports_model->report('table_invoices',array('*'),$condition,$start_date,$end_date,$status='');

  }
  else
  {
  $invoiceParam=array(
    'f_id'=>$f_id

  );
 $invoice_list=$this->Reports_model->select('table_invoices',$invoiceParam,array('id','name','mobile','email','amount','paid','status','invoice_id','created_at','total','customer_id'));

  }
  
    $data['invoice']=$invoice_list;
    $data['heading']='INVOICE REPORT';
  $data['_view'] = 'invoice_report';

  $this->load->view('index.php',$data);



}

function purchase_report()
{

  $f_id = $this->session->f_id;
  $data['vendors']=$this->Reports_model->select('table_vendor',array('f_id' => $f_id),array('id','name'));
  $this->load->model('item/Item_model');
  $data['title'] = 'PURCHASE REPORT';
  if($this->input->post())
  {
    $this->load->helper('user_helper');
    $date_range = explode(' - ',$this->input->post('date_range'));
    // print_r($this->input->post('date_range'));die;
    if($this->input->post('date_range'))
    {
    $start_date = date_change_db($date_range[0]);
    $end_date = date_change_db($date_range[1]);
    }
    else
    {
      $start_date='';
      $end_date='';
    }
    // $item_id=$this->input->get('id');
    $vendor_id=$this->input->post('vendor_id');
    $status=$this->input->post('status');
    if($vendor_id)
    {
    $condition = array('t1.f_id' => $f_id,'vendor_id'=>$vendor_id);
    }
    else
    {
      $condition = array('t1.f_id' => $f_id);
    }
    $data['purchase']=$this->Reports_model->purchaseReport('table_purchase_master',$condition,array('t1.created_at','t2.name as staff_name','t3.name as vendor_name','t1.id as purchase_id','t1.total_amount','t1.status'),$start_date,$end_date);
  }
  else
  { 
    $condition = array('t1.f_id' => $f_id);
  $data['purchase']=$this->Item_model->purchase_list('table_purchase_master',$condition,array('t1.created_at','t3.name as staff_name','t2.name as vendor_name','t1.id as purchase_id','t1.total_amount','t1.status'));
  } 
  $categoryParam = array('f_id' => $f_id);
  $category = $this->Reports_model->select('table_category', $categoryParam, array('category_id', 'name'));
  $data['category'] = $category;

// echo '<pre>';
// print_r($data['purchase']);
  $data['_view'] = 'purchase_report';
  $this->load->view('index', $data);



}

function customer_ledger_report()
{
 $f_id=$this->session->f_id;
  $data['title']='Customer Ledger';
  $data['customers']=$this->Reports_model->select('table_crn',array('f_id' => $f_id,'contact_type'=>1),array('id','name'));
  if($this->input->post())
  {
##reference id is used for venodor thats why

   $date_range = explode(' - ',$this->input->post('date_range'));
    // print_r($this->input->post('date_range'));die;
    if($this->input->post('date_range'))
    {
    $start_date = date_change_db($date_range[0]);
    $end_date = date_change_db($date_range[1]);
    }
    else
    {
      $start_date='';
      $end_date='';
    }
  $customer_id=$this->input->post('customer_id');
  $data['customer_name']=$this->Reports_model->select_id('table_crn',array('f_id' => $f_id,'id'=>$customer_id),array('name'));
  $data['customer_id']=$customer_id;
  $condition=array('customer_id'=>$customer_id,'f_id'=>$f_id,'reference_type!='=>3,'reference_type!='=>4,'double_entry'=>0);
  $data['customer_ledger']=$this->Reports_model->report('table_account_transaction',array('*'),$condition,$start_date,$end_date);
}



 $data['_view'] = 'customer_ledger';

  $this->load->view('index.php',$data);


}

function vendor_ledger_report()
{
 $f_id=$this->session->f_id;
 $data['title']='Vendor Ledger';
  $data['customers']=$this->Reports_model->select('table_crn',array('f_id' => $f_id,'contact_type'=>2),array('id','name'));
  if($this->input->post())
  {
##reference id is used for venodor thats why
   $date_range = explode(' - ',$this->input->post('date_range'));
    // print_r($this->input->post('date_range'));die;
    if($this->input->post('date_range'))
    {
    $start_date = date_change_db($date_range[0]);
    $end_date = date_change_db($date_range[1]);
    }
    else
    {
      $start_date='';
      $end_date='';
    }
  $customer_id=$this->input->post('customer_id');
  $data['vendor_id']=$customer_id;
  $condition=array('customer_id'=>$customer_id,'f_id'=>$f_id,'double_entry'=>0);
  $data['customer_ledger']=$this->Reports_model->vendor_ledger_report('table_account_transaction',array('t1.*','t2.type'),$condition,$start_date,$end_date);
}

  // echo '<pre>';
  // print_r($data);
  // die;
 $data['_view'] = 'vendor_ledger';

  $this->load->view('index.php',$data);


}

function reciept_report()
{
  $this->load->model('sales/Sales_model');
  $f_id=$this->session->f_id;
   $data['customers']=$this->Reports_model->select('table_crn',array('f_id' => $f_id),array('id','name'));
$data['heading']='RECEIPT REPORT';
  if($_SERVER['REQUEST_METHOD'] == 'POST' )
  {
    if($this->input->post('date_range'))
    {
   $this->load->helper('user_helper');
   $date_range = explode(' - ',$this->input->post('date_range'));
    $start_date = date_change_db($date_range[0]);
    $end_date = date_change_db($date_range[1]);
    }
    else
    {
      $start_date='';
      $end_date='';
    }
 
   $customer_id=$this->input->post('customer_id');
    // }
   if($customer_id)
   {
     $condition=array(

    't1.f_id'=>$f_id,
    'customer_id'=>$customer_id

  );
   }
   else
   {
   $condition=array(

    't1.f_id'=>$f_id,

  );
 }
 
   $data['payment'] = $this->Sales_model->payment_report('table_payment_details',array('t1.payment_id','t1.invoice_id_json','t1.amount','t1.payment_date','t1.payment_method','t2.name as customer_name'),$condition,$start_date,$end_date,$status='','payment_date');
  
 }
 else
 {
 
      $condition=array('f_id'=>$f_id);
      $data['payment'] = $this->Sales_model->select('table_payment_details', $condition, array('*'));

  
}

$data['_view'] = 'payment_recieved_report';
$this->load->view('index', $data);


}


function payment_report()
{
  $this->load->model('sales/Sales_model');
  $f_id=$this->session->f_id;
   $data['customers']=$this->Reports_model->select('table_crn',array('f_id' => $f_id,'contact_type'=>2),array('id','name'));
$data['heading']='PAYMENT REPORT';
  if($_SERVER['REQUEST_METHOD'] == 'POST' )
  {
    if($this->input->post('date_range'))
    {
   $this->load->helper('user_helper');
   $date_range = explode(' - ',$this->input->post('date_range'));
    $start_date = date_change_db($date_range[0]);
    $end_date = date_change_db($date_range[1]);
    }
    else
    {
      $start_date='';
      $end_date='';
    }
 
   $customer_id=$this->input->post('customer_id');
    // }
   if($customer_id)
   {
     $condition=array(

    't1.f_id'=>$f_id,
    'vendor_id'=>$customer_id

  );
   }
   else
   {
   $condition=array(

    't1.f_id'=>$f_id,

  );
 }
 
      $data['payment'] = $this->Reports_model->payment_report('table_vendors_payment',array('t1.payment_id','t1.total_amount','t1.created_at','t1.payment_mode','t2.name as customer_name'),$condition,$start_date,$end_date,$status='','t1.created_at');
  
 }
 else
 {
      
      $condition=array('f_id'=>$f_id);
      $data['payment'] = $this->Reports_model->select('table_vendors_payment', $condition, array('*'));

  
}
    
$data['_view'] = 'payment_vendor';
$this->load->view('index', $data);


}






// function profit_analysis()
// {

// $f_id=$this->session->f_id;
// $condition=array('f_id'=>$f_id);  
// // $sumPurchase=$this->Reports_model->salesAnalysis('table_item_graph',$condition,$purchase_condition);

// ##last 1 month profit
//   $duration='INTERVAL 3 MONTH';
//   $data['sumSales']=$this->Reports_model->data_between_date('table_sales',array("MONTHNAME(created_at) as month","sum(total) as 'sell_total'"),$condition,$duration,$coloumn='created_at','MONTH','MONTH');

//   $data['sumPurchase']=$this->Reports_model->data_between_date('table_purchase',array("MONTHNAME(created_at) as month","sum(total_purchase_price) as 'purchase_total'","sum(purchase_price*quantity_for_sale) as 'stock reamaning'"),$condition,$duration,$coloumn='created_at','MONTH','MONTH');
//   // $stockPriceReamaning =  $this->Reports_model->data_between_date('table_purchase',array("MONTHNAME(created_at) as month","sum(purchase_price*quantity_for_sale) as 'stock reamaning'"),$condition,$duration,$coloumn='created_at');
//   // print_r($stockPriceReamaning);
//   // $this->output->enable_profiler(TRUE);
//    // $profit= $sumSales-$sumPurchase + $stockPriceReamaning[0]['sum'];
// // echo $stockPriceReamaning ;
// // echo '<br>';
//   echo json_encode($data);

// }

##daily work report of employee




function tax_return()
{

 $f_id=$this->session->f_id;
    // $taxCondition=array('f_id'=> $f_id);
     // $tax_json=$this->Reports_model->select_id('table_seller_setting',$taxCondition,array('tax'));
     // print_r($tax_json);
     // $data['tax']=json_decode($tax_json['tax'],1);   
     // print_r($data['tax']);
     // die;
 if($this->input->post())
 {
    $date_range = explode(' - ',$this->input->post('date_range'));
    $start_date = date_change_db($date_range[0]);
    $end_date = date_change_db($date_range[1]);
    $tax_name=$this->input->post('tax_name',1);
    $condition=array('f_id'=>$f_id,'tax_name'=>$tax_name);
    $data['tax_report']=$this->Reports_model->report('table_tax_count',array('invoice_id','tax_name','tax_amount','created_at'),$condition,$start_date,$end_date);
 }
 else
 {
  $condition=array('f_id'=>$f_id);
  $data['tax_report']=$this->Reports_model->select('table_tax_count',$condition,array('invoice_id','tax_name','tax_amount','created_at'));
    }
  $data['_view'] = 'tax_return';
 $this->load->view('index.php',$data);


}




function add_lead()
{

  $f_id=$this->session->f_id;

if($this->input->post())
{



$lead_name=$this->input->post('lead_name');
$params=array(
  "lead_name"=>$lead_name,
  "f_id"=>$f_id,
  "created_at"=>date('Y-m-d H:i:s')
);

$last_inserted_id=$this->Reports_model->insert('table_lead',$params);
if($last_inserted_id)
{
 $this->session->alerts = array(
        'severity'=> 'success',
        'title'=> 'succesfully add'

      );


}
else
{
  $this->session->alerts = array(
        'severity'=> 'danger',
        'title'=> 'not added'

      );
}
      redirect('reports/add_lead');
}
else
{
  $leadCondition=array("f_id"=>$f_id);
  $data['lead']=$this->Reports_model->select('table_lead',$leadCondition,array('id','lead_name'));
$data['_view'] = 'add_lead';
 $this->load->view('index.php',$data);
}

}


function account_transaction_report()
{
 
  $f_id=$this->session->f_id;
  $data['title']="Account Transaction";
  $condition=array('f_id'=>$f_id);

  #fetch company name

  $result=$this->Reports_model->select_id('table_seller_setting',$condition,array('company_name'));
  $data['company_name']=$result['company_name'];
  if($this->input->post())
  {
    $date_range = explode(' - ',$this->input->post('date_range'));
    $start_date = date_change_db($date_range[0]);
    $end_date = date_change_db($date_range[1]);

  }
  else
  {
    $start_date = '';
    $end_date = '';
  }
     $data['transaction']=$this->Reports_model->accountTransaction('table_account_transaction',$condition,array('t1.created_at','t1.debit','t1.reference_type','t1.credit','t1.reference','t1.debit','t1.invoice_id','t1.reciept_id','t1.bill_id','t2.group_name','t3.type'),$start_date,$end_date);
  
$data['_view'] = 'account_transaction';
 $this->load->view('index.php',$data);
// 

}

function general_ledger()
{
   $f_id=$this->session->f_id;
  $data['title']="General ledger";
  $condition=array('f_id'=>$f_id);

  #fetch company name

  $result=$this->Reports_model->select_id('table_seller_setting',$condition,array('company_name'));
  $data['company_name']=$result['company_name'];

 $data['account_group']=$this->Reports_model->debitCreditAccountGroup('table_account_transaction',$condition,array('t2.group_name',"sum(debit) as debit","sum(credit) as credit"));
 // print_r($result);
$data['_view'] = 'account_group';
 $this->load->view('index.php',$data);
}

function vendor_payment_report()
{

$data['vendor_payment']=$this->Reports_model->select('table_vendor_payment_details',array('f_id'=>$this->session->f_id),array('*'));
$data['_view'] = 'vendor_payment';
 $this->load->view('index.php',$data);
}


function profit_loss()
{
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
 $data['account_group']=$this->Reports_model->debitCreditAccountGroup('table_account_transaction',$condition,array('t2.group_name',"sum(debit) as debit","sum(credit) as credit"));
 $data['_view'] = 'profit_loss';
 $this->load->view('index.php',$data);

}

function balance_sheet()
{
$f_id=$this->session->f_id;
$data['title']='Balance Sheet';

   $condition=array('f_id'=>$f_id,'ledger_group'=>10);
  ##opening balance adjustment  (22=ledger group)
    $conditionOpeningBalanceAdjustment=array('f_id'=>$f_id,'ledger_group'=>22);
   $data['company_name']=$this->Reports_model->select_id('table_seller_setting',array('f_id'=>$f_id),array('company_name')); 
    // print_r($data['company_name']);die;
   if($this->input->post())
   {
        $date_range = explode(' - ',$this->input->post('date_range'));
        $start_date = date_change_db($date_range[0]);
         $end_date = date_change_db($date_range[1]);

        
       $cash_debit=$this->Reports_model->sum_column('table_account_transaction',$condition,'debit',$start_date,$end_date);
      $cash_credit=$this->Reports_model->sum_column('table_account_transaction',$condition,'credit',$start_date,$end_date);
      $data['cash']=$cash_debit-$cash_credit;
      // print_r($data['cash']);die;
      ##account recieable
      ##5 means sales account 4=purchase account,9=stock in hand
      $basicCondition=array('f_id'=>$f_id);
      $conditionAccountRecieveable=array('1','8');
      $conditionAccountPayable=array('3','4','7','14');
      $conditionInventoryAssets=array('f_id'=>$f_id,'ledger_group'=>9);
      $conditionExpences=array('11','4');
      $data['account_recieve']=$this->Reports_model->sum_column_balance_sheet('table_account_transaction',$basicCondition,'credit',$conditionAccountRecieveable,$start_date,$end_date);
      $data['account_payable_credit']=$this->Reports_model->sum_column_balance_sheet('table_account_transaction',$basicCondition,'credit',$conditionAccountPayable,$start_date,$end_date);
      $data['account_payable_debit']=$this->Reports_model->sum_column_balance_sheet('table_account_transaction',$basicCondition,'debit',$conditionAccountPayable,$start_date,$end_date);
      $data['account_payable']=$data['account_payable_credit']-$data['account_payable_debit'];
      $inventory_asset_debit=$this->Reports_model->sum_column('table_account_transaction', $conditionInventoryAssets,'debit',$start_date,$end_date);
      $inventory_asset_credit=$this->Reports_model->sum_column_balance_sheet('table_account_transaction', $conditionInventoryAssets,'credit',$start_date,$end_date);

      $opening_balance_adjustment_credit=$this->Reports_model->sum_column_balance_sheet('table_account_transaction', $conditionOpeningBalanceAdjustment,'credit',$start_date,$end_date);

      $opening_balance_adjustment_debit=$this->Reports_model->sum_column_balance_sheet('table_account_transaction', $conditionOpeningBalanceAdjustment,'debit',$start_date,$end_date);

      $data['opening_balance_adjustment']=$opening_balance_adjustment_credit-$opening_balance_adjustment_debit;
      $data['gst_payable']=0;
      $data['expences']=$this->Reports_model->sum_column_balance_sheet('table_account_transaction',$basicCondition,'debit',$conditionExpences,$start_date,$end_date);
       // print_r($data['expences']);die;




   }
   else
   {


   ##cash

   $cash_debit=$this->Reports_model->sum_column('table_account_transaction',$condition,'debit');
   $cash_credit=$this->Reports_model->sum_column('table_account_transaction',$condition,'credit');

      $data['cash']=$cash_debit-$cash_credit;
      ##account recieable
      ##5 means sales account 4=purchase account,9=stock in hand ,3=capital account,7=sundry creditors, 14=liabilities,11=expences
      $basicCondition=array('f_id'=>$f_id);
      $conditionAccountRecieveable=array('1','8');
      $conditionAccountPayable=array('3','4','7','14');
      $conditionInventoryAssets=array('f_id'=>$f_id,'ledger_group'=>9);
      $conditionExpences=array('11','4');
      $data['account_recieve']=$this->Reports_model->sum_column_balance_sheet('table_account_transaction',$basicCondition,'credit',$conditionAccountRecieveable);
      $data['account_payable_credit']=$this->Reports_model->sum_column_balance_sheet('table_account_transaction',$basicCondition,'credit',$conditionAccountPayable);
      $data['account_payable_debit']=$this->Reports_model->sum_column_balance_sheet('table_account_transaction',$basicCondition,'debit',$conditionAccountPayable);
      $data['account_payable']=$data['account_payable_credit']-$data['account_payable_debit'];
      $inventory_asset_debit=$this->Reports_model->sum_column('table_account_transaction', $conditionInventoryAssets,'debit');
      $inventory_asset_credit=$this->Reports_model->sum_column_balance_sheet('table_account_transaction', $conditionInventoryAssets,'credit');
      $opening_balance_adjustment_credit=$this->Reports_model->sum_column_balance_sheet('table_account_transaction', $conditionOpeningBalanceAdjustment,'credit');
      $opening_balance_adjustment_debit=$this->Reports_model->sum_column_balance_sheet('table_account_transaction', $conditionOpeningBalanceAdjustment,'debit');
      $data['opening_balance_adjustment']=$opening_balance_adjustment_credit-$opening_balance_adjustment_debit;
      $data['gst_payable']=0;
      $data['expences']=$this->Reports_model->sum_column_balance_sheet('table_account_transaction',$basicCondition,'debit',$conditionExpences);


     } 
      $data['total_current_assets']=$data['cash']+$data['account_recieve'];
      // print_r(expression)
      $data['total_current_liabilities']= $data['account_payable']+$data['opening_balance_adjustment']+$data['gst_payable'];
      $data['inventory_assets']=$inventory_asset_debit-$inventory_asset_credit;
               $data['total_assets']=$data['inventory_assets']+$data['total_current_assets'];
              $data['equities']=$data['total_assets']-$data['total_current_liabilities'];
              $data['total_liabilities_equities']=$data['total_current_liabilities']+$data['equities'];
   
   $data['_view'] = 'balance_sheet';
 $this->load->view('index.php',$data);
 // $this->load->view('balance_sheet');


}


function account_transaction_ledger($ledger_id)
{

  $f_id=$this->session->f_id;
  $start_date='';
  $end_date='';
  $data['title']="Account Transaction";
  $condition=array('f_id'=>$f_id);

  #fetch company name

  $result=$this->Reports_model->select_id('table_seller_setting',array('f_id'=>$f_id),array('company_name'));
  $data['company_name']=$result['company_name'];
  $condition=array('f_id'=>$f_id,'ledger_group'=>$ledger_id);
$data['transaction']=$this->Reports_model->accountTransaction('table_account_transaction',$condition,array('t1.created_at','t1.debit','t1.reference_type','t1.credit','t1.reference','t1.debit','t1.invoice_id','t1.reciept_id','t1.bill_id','t2.group_name','t3.type'),$start_date,$end_date);
 
  $data['_view'] = 'account_transaction';
 $this->load->view('index.php',$data);
}





/*all function end*/
}
?>	