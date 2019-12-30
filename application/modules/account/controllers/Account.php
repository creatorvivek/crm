<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/qr/qrlib.php');
class Account extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->model('Account_model');
}


##not direct call it is called by other modules controller when sales and service happen

function invoice($params,$particular)
{
  ##fetch invoice id according to seller
  $invoice_id=$this->get_invoice_id();
  // print_r($invoice_id);
  $f_id=$this->session->f_id;
  $seller_info=$this->seller_info($f_id);
 
##insert particular and amount in master invoice table_invoices
  $length=count($particular['particular']);
  $amount=0;
  for($k=0;$k<$length;$k++)
  {
    
    $masterInvoiceParams=array(
      'invoice_id'=>$invoice_id,
      'particular'=>$particular['particular'][$k],
      'price'=>$particular['price'][$k],
      'quantity'=>$particular['quantity'][$k],
      'unit'=>$particular['unit'][$k],
      'f_id'=>$f_id



    );

    $amount=$amount+$particular['price'][$k];
    $data=$this->Account_model->insert('table_master_invoice', $masterInvoiceParams);
 
  }
## maintain tax of seller
      ##direct fetch by seller setting tax 
  $tax_detail=json_decode($seller_info[0]['tax'],1) ;
  // print_r(array_values($tax_detail[0]));
  $tax_amount=0;
  // $tax_amount=round($amount*0.18);
  for($i=0;$i<count($tax_detail);$i++) {
        // print_r($tax_detail[$i])  ;           




  
   $tax_amount = $tax_amount+round($amount  * (array_values($tax_detail[$i])[0])/100)   ;


   $taxMaintain=array(

    'invoice_id'=>$invoice_id,
    'f_id'=>$f_id,
    'tax_name'=>array_keys($tax_detail[$i])[0],
    'tax_amount'=>round(($amount * (array_values($tax_detail[$i]))[0])/100) 


  ); 

   $insertTaxDetail=$this->Account_model->insert('table_tax_count',$taxMaintain);

   

  }
  $total=$amount+round($tax_amount);
##insert in database
##check seller have isp licence or not if not have upper seller has to pay dot
    $seller_id_param=array('f_id'=>$f_id);
 
##insert invoice details
 $invoiceParams=array(
  'invoice_id'=>$invoice_id,
  'name'=>$params['customer_name'],
  'customer_id'=>$params['customer_id'],
  'company_name'=>$seller_info[0]['company_name'],
  'f_mobile'=>$seller_info[0]['mobile'],
  'f_email'=>$seller_info[0]['email'],
  'f_logo'=>$seller_info[0]['logo'],
  'f_id'=>$f_id,
  'email'=>$params['email'],
  'mobile'=>$params['mobile'],
  'order_id'=>$params['order_id'],
  'address'=>$params['address'],
  'c_city'=>$params['c_city'],
  'c_pincode'=>$params['c_pincode'],
  'f_address'=>$seller_info[0]['address'],
  'f_city'=>$seller_info[0]['city'],
  'f_pincode'=>$seller_info[0]['pincode'],
  'tax'=>$seller_info[0]['tax'],
  'created_at'=>date('y-m-d H-i-s'),
  'amount'=>$amount,
  'total'=>$total
 
);
// print_r($invoiceParams);die;
 // $collectUserInformation=modules::run('api_call/api_call/call_api',''.api_url().'account/insert_invoice_information',$invoiceParams,'POST');
 $collectUserInformation=$this->Account_model->insert('table_invoices',$invoiceParams);
 // print_r(expression)
 $last_inserted_id=$collectUserInformation;

 $accountTransaction=array(
  'reference_id'=>$last_inserted_id,
  'reference_type'=>1,##invoice type
  'ledger_group'=>6,##sundry debitors(account recieble)
  'debit'=>$total,
  'f_id'=>$f_id,
  'invoice_id'=>$invoice_id,
  'customer_id'=>$params['customer_id'],
  
  'created_at'=>date('Y-m-d H-i-s')

);

##becaz 
 if($tax_amount>0)
 {
 $accountTransactionTax=array(
  'reference_id'=>$last_inserted_id,
  'reference_type'=>1,
  'ledger_group'=>15,##duty & taxes
  'credit'=>$tax_amount,
  'f_id'=>$f_id,
  'invoice_id'=>$invoice_id,
  'customer_id'=>$params['customer_id'],
   'double_entry'=>1,
  'created_at'=>date('Y-m-d H-i-s')

);
    $this->Account_model->insert('table_account_transaction',$accountTransactionTax);
}

 ## becaz sales increse increse then credit incresase
    $accountTransactionDouble=array(
      'reference_id'=>$last_inserted_id,
      'reference_type'=>1,
      'credit'=>$amount,
      'f_id'=>$f_id,
      'ledger_group'=>5,##sales account
      'invoice_id'=>$invoice_id,
      'customer_id'=>$params['customer_id'],
      'double_entry'=>1,
       'created_at'=>date('Y-m-d H-i-s')

    );
    $this->Account_model->insert('table_account_transaction',$accountTransaction);
    $this->Account_model->insert('table_account_transaction',$accountTransactionDouble);

 



return $invoice_id;
}






private function get_reciept_id()
{
  $f_id=$this->session->f_id;
  $recieptNoParams=array('f_id'=>$f_id);
  $maxRecieptNo=modules::run('api_call/api_call/call_api',''.api_url().'account/getMaxRecieptNo',$recieptNoParams,'POST');
  if($maxRecieptNo['status']=='not found')
  {
    return $reciept_id='reciept'.$f_id.'_00001';
  }
  else if($maxRecieptNo['status']=='success')
  {

    return $reciept_id=$maxRecieptNo['data'];
  }
  else
  {
    try
    {
      if($maxRecieptNo['error'])

        throw new Exception($maxRecieptNo['error'], 1);

    }
    catch(Exception $e)
    {
     echo $e->getMessage();
     exit();
   }     
 }
}

private function get_invoice_id()
{
  $f_id=$this->session->f_id;
  $invoiceNoParams=array('f_id'=>$f_id);
  // $maxInvoiceNo=modules::run('api_call/api_call/call_api',''.api_url().'account/get_max_invoice_no',$invoiceNoParams,'POST');
 $maxInvoiceNo= json_decode($this->Account_model->get_max_invoice_no('table_invoices',$invoiceNoParams),1);
 // print_r($maxInvoiceNo);die;
  if($maxInvoiceNo['status']=='not found')
  {
    return $invoice_id='1';
  }
  else if($maxInvoiceNo['status']=='success')
  {

   return $invoice_id=$maxInvoiceNo['data'];
 }
 else
 {
  try
  {
    if($maxInvoiceNo['error'])

      throw new Exception($maxInvoiceNo['error'], 1);
    
  }
  catch(Exception $e)
  {
   echo $e->getMessage();
   exit();
 }     
}
}
 function get_payment_id()
{
  $f_id=$this->session->f_id;
  $invoiceNoParams=array('f_id'=>$f_id);
  // $maxInvoiceNo=modules::run('api_call/api_call/call_api',''.api_url().'account/get_max_invoice_no',$invoiceNoParams,'POST');
 $maxInvoiceNo= json_decode($this->Account_model->get_max_payment_no($invoiceNoParams),1);
 // print_r($maxInvoiceNo);die;
  if($maxInvoiceNo['status']=='not found')
  {
    return $invoice_id='1';
  }
  else if($maxInvoiceNo['status']=='success')
  {

   return $invoice_id=$maxInvoiceNo['data'];
 }
 else
 {
  try
  {
    if($maxInvoiceNo['error'])

      throw new Exception($maxInvoiceNo['error'], 1);
    
  }
  catch(Exception $e)
  {
   echo $e->getMessage();
   exit();
 }     
}
}
function get_vendor_payment_id()
{
$f_id=$this->session->f_id;
  $paymentNoParams=array('f_id'=>$f_id);
  // $maxInvoiceNo=modules::run('api_call/api_call/call_api',''.api_url().'account/get_max_invoice_no',$invoiceNoParams,'POST');
 $maxPaymentNo= json_decode($this->Account_model->get_max_vendor_payment_no($paymentNoParams),1);
 // print_r($maxPaymentNo);die;
  if($maxPaymentNo['status']=='not found')
  {
    return $payment_id='1';
  }
  else if($maxPaymentNo['status']=='success')
  {

   return $payment_id=$maxPaymentNo['data'];
 }
 else
 {
  try
  {
    if($maxPaymentNo['error'])

      throw new Exception($maxPaymentNo['error'], 1);
    
  }
  catch(Exception $e)
  {
   echo $e->getMessage();
   exit();
 }     
}
}



function get_invoice($invoice_id)
{
  $f_id=$this->session->f_id;
  $params=array('invoice_id'=>$invoice_id,'f_id'=>$f_id);
  // $getInvoiceData=modules::run('api_call/api_call/call_api',''.api_url().'account/get_invoice_data',$params,'POST');
  // var_dump($getInvoiceData);
  $getInvoiceData=$this->Account_model->select('table_invoices',$params,array('id','name','mobile','email','company_name','f_mobile','f_email','f_logo','f_address','address','amount','tax','created_at','invoice_id','total','c_city','c_pincode'));
 
  $get_particular_detail=$this->Account_model->select('table_master_invoice',$params,array('particular','price','quantity'));
          // var_dump($get_particular_detail['data']);

  $rows = "";
  $no =1;
  $subtotal=0;
  $data['rows']='';
  $length=count($get_particular_detail);
  for($i=0;$i<$length;$i++) {


    $name = $get_particular_detail[$i]["particular"];
    $quantity = $get_particular_detail[$i]["quantity"];
    $price = $get_particular_detail[$i]["price"];
    $subtotal = $subtotal + $price;

    if($name!=""){
      $data['rows'] .= "<tr><td>".$no."</td><td>".$name."</td><td>".$quantity."</td><td>".$price."</td>
      </tr>";
    }
    $no++;


  }


  ##take invoice template to database seller basis
  $data['invoice']=$getInvoiceData[0];
  $invoice_template=$this->session->invoice_template;
  if($invoice_template==0){$invoice_template='default';}
  // $this->load->view('invoice_template/'.$invoice_template,$data);
  $this->load->view('invoice_template/first',$data);

}

function get_reciept($id)
{
 $params=array('reciept_id'=>$id);
 $getRecieptData=modules::run('api_call/api_call/call_api',''.api_url().'account/getRecieptData',$params,'POST');
  // var_dump($getInvoiceData);
 try
 {
  if($getRecieptData=='')
  {
    throw new Exception("server down", 1);
    log_error("account/getRecieptData function error");

  }
  if(isset($getRecieptData['error']))
  {
    throw new Exception($getRecieptData['error'], 1);
  }
}
catch(Exception $e)
{
  die(show_error($e->getMessage()));
}

if($getRecieptData['status']=='success')
{
 $data['reciept']=$getRecieptData['data'][0];
 // var_dump($data['reciept']);
}
 // $data['_view'] = 'reciept';

$this->load->view('reciept',$data);
}

function invoice_list()
{
  $f_id=$this->session->f_id;
  if($this->input->get('status')=='pending')
  {
    $invoiceParam=array(
    'f_id'=>$f_id,
    'status!='=>'paid'
       );  
    $invoice_list=$this->Account_model->select('table_invoices',$invoiceParam,array('id','name','mobile','email','amount','paid','status','invoice_id','created_at','total','customer_id'));
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
    $invoice_list= $this->Account_model->report('table_invoices',array('*'),$condition,$start_date,$end_date,$status='');

  }
  else
  {
  $invoiceParam=array(
    'f_id'=>$f_id

  );
 $invoice_list=$this->Account_model->select('table_invoices',$invoiceParam,array('id','name','mobile','email','amount','paid','status','invoice_id','created_at','total','customer_id'));

  }
  
    $data['invoice']=$invoice_list;
    $data['heading']='INVOICE LIST';
  $data['_view'] = 'invoice_list';

  $this->load->view('index.php',$data);



}
function invoice_list_condition()
{

 $status=$this->input->get('status');
 $f_id=$this->session->f_id;
 $invoiceParam=array(
  'f_id'=>$f_id,
  'status'=>$status

);

 $invoice_list= modules::run('api_call/api_call/call_api',''.api_url().'account/invoiceList',$invoiceParam,'POST');
 try
 {
  if($invoice_list=='')
  {
    throw new Exception("server down", 1);
    log_error("account/invoiceList function error");

  }
  if(isset($invoice_list['error']))
  {
    throw new Exception($invoice_list['error'], 1);
  }
}
catch(Exception $e)
{
  die(show_error($e->getMessage()));
}

if($invoice_list['status']=='success')
{
  $data['invoice']=$invoice_list['data'];
}
else 
{
  $data['invoice']=[];
}
$data['_view'] = 'invoice_list';

$this->load->view('index.php',$data);


}

 function seller_info($f_id)

{
  $condition=array('seller_setting.f_id'=>$f_id);
  $data=$this->Account_model->fetch_seller_details('table_seller_setting',$condition,array('logo','name','mobile','email','address','gst_number','tax','city','pincode','company_name'));
  return $data;
  // print_r($data);
}




## ajax call

function fetch_invoice_info()
{


$condition=array(

  'invoice_id'=>trim($this->input->post('invoice_id',1)),
   'f_id'=>$this->session->f_id
);
  $invoice_details=$this->Account_model->select_id('table_invoices',$condition,array('paid','total','status','order_id'));
  echo  json_encode($invoice_details);
}


##customer reamaning balance  in invoice (invoice status is not paid) 
function customer_outstanding_balance($customer_id='')
{

$f_id=$this->session->f_id;

  ##fetch customer name by is
 $data['customer_name']=$this->Account_model->select_id('table_crn',array('f_id'=>$f_id,'id'=>$customer_id),array('name'));
 
$condition=array('t1.customer_id'=>$customer_id,'t1.f_id'=>$f_id,'t1.reference_type'=>1,'t2.status!='=>'paid','double_entry'=>0);
  $transaction=$this->Account_model->fetch_customer_outstanding_balance('table_account_transaction',$condition,array('t1.invoice_id','t1.created_at','t2.total','t2.paid'));
  $data['outstanding']=$this->Account_model->fetch_customer_outstanding_balance('table_account_transaction',$condition,array('t1.invoice_id','t1.created_at','t2.total','t2.paid'));
 
## fetch if opening balance is pending
 
$conditionOpeningBalance=array('id'=>$customer_id,'f_id'=>$f_id,'balance_status!='=>'paid','initial_balance>'=>0);

 $initial_balance=$this->Account_model->select_id('table_crn',$conditionOpeningBalance,array('initial_balance','paid','date(created_at) as created_at'));

    $data['initial']=array("created_at"=>$initial_balance['created_at'],"invoice_id"=>'',"total"=>$initial_balance['initial_balance'],"paid"=>$initial_balance['paid']);
  
   $data['_view'] = 'outstanding_balance';

  $this->load->view('index.php',$data);


}

## manual entry entered by accounted

function journal_entry()
{
##fetch contact
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
  $data['contact']=$this->Account_model->select('table_crn',$condition,array('id','name'));
  $data['account_group']=$this->Account_model->select('table_ledger_group',null,array('id','group_name'));
  // echo '<pre>';
  // print_r($data);
// die;
 $data['_view'] = 'journal_entry';

  $this->load->view('index.php',$data);


}

function journal_entry_process()
{

  print_r($this->input->post());
  // die;
$f_id=$this->session->f_id;
$notes=$this->input->post('notes');
$reference=$this->input->post('reference');
$reference=1;
##array
$debit=$this->input->post('debit');
$credit=$this->input->post('credit');
// $account=$this->input->post('account');
$ledger_group=$this->input->post('ledger_group');
$reference_type=$this->input->post('reference_type');

$customer_id=$this->input->post('customer_id');
$amount=$this->input->post('amount');
#--#
##generate journal number seller wise
    $journal_number = $this->fetch_journal_number();


$journalParam=array(

'reference'=>$reference,
'notes'=>$notes,
'journal_no'=>$journal_number,
'f_id'=>$f_id,
'amount'=>$amount,
'created_at'=>date('Y-m-d H-i-s')


);
        
##insert new journal
$journal_reference_id=$this->Account_model->insert('table_manual_journal',$journalParam);

for($i=0;$i<count($ledger_group);$i++)
{
##insert general 
$accountTransaction=array
(
  'reference_id'=>$journal_reference_id,
  'reference_type'=>5,##journal entry
  'ledger_group'=>$ledger_group[$i],
  'debit'=>$debit[$i],
  'credit'=>$credit[$i],
  'f_id'=>$f_id,
    'double_entry'=>$i,
  'customer_id'=>$customer_id[$i],
  
  'created_at'=>date('Y-m-d H-i-s')

);

// $this->Account_model->insert('table_account_transaction',$accountTransaction);


}

}


private function fetch_journal_number()
{
$f_id=$this->session->f_id;
  $journalNoParams=array('f_id'=>$f_id);
 
 $maxJournalNo= json_decode($this->Account_model->get_max_journal_no('table_manual_journal',$journalNoParams),1);
 // print_r($maxInvoiceNo);die;
  if($maxJournalNo['status']=='not found')
  {
    return $journal_id='1';
  }
  else if($maxJournalNo['status']=='success')
  {

   return $journal_id=$maxJournalNo['data'];
  }
 else
 {
  try
  {
    if($maxInvoiceNo['error'])

      throw new Exception($maxInvoiceNo['error'], 1);
    
  }
  catch(Exception $e)
  {
   echo $e->getMessage();
   exit();
 }     
}


}

/*all function end*/
}
?>	