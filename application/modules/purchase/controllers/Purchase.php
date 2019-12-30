<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Purchase extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Purchase_model');
  }


##add purchase order view fetch vendor
  function add_purchase()
  {
    $f_id = $this->session->f_id;

    $data['title'] = 'ADD PURCHASE';
  // $this->load->model('category/Category_model');
    $params = array('f_id' => $f_id,'status'=>1);
    $vendorParams=array('f_id'=>$f_id,'status'=>1,'contact_type!='=>1);
    $data['vendor'] = $this->Purchase_model->select('table_crn', $vendorParams, array('id', 'name'));
    $data['item'] = $this->Purchase_model->select('table_item', $params, array('id','item_name','description','company_name'));
  // $data['measurement_unit'] = $this->Purchase_model->select('table_measurement_unit', $params, array('id','symbol'));
        // var_dump($category);die;
            // $data['category'] = $category;
    $data['heading'] = 'ADD PURCHASE';
    $data['_view'] = 'add_purchase';
    $this->load->view('index', $data);

  }

  function add_purchase_process()
  {
 
    $f_id = $this->session->f_id;
    $staff_id = $this->session->staff_id;

    $vendor_invoice = strip_tags($this->input->post('vendor_invoice',1));
    $vendor_id = strip_tags($this->input->post('vendor_id', 1));
    $item_id = $this->input->post('item_id',1);
    $item_name = $this->input->post('item_name',1);
    $selling_price = $this->input->post('selling_amount',1);
    $purchase_price = $this->input->post('purchase_amount',1);
    $purchase_date = $this->input->post('purchase_date', 1);
    $qty =     $this->input->post('qty', 1);
    $amount =  $this->input->post('amount', 1);
    $batch_id= $this->input->post('check', 1);
  // $item_category = strip_tags($this->input->post('category_id', 1));

  // $model_number =   $this->input->post('model_number');
  // $serial_number =  $this->input->post('serial_number');
  // $company_name =   strip_tags($this->input->post('company_name', 1));
  // $unit =         strip_tags($this->input->post('unit', 1));
    $total_amount =       strip_tags($this->input->post('total_amount', 1));

    $this->load->library('form_validation');
    $this->form_validation->set_rules('vendor_id', 'Vendor', 'required|trim');
  // $this->form_validation->set_rules('description', 'description', 'required|trim');

  // $this->form_validation->set_rules('selling_amount', 'selling price', 'required');
 // print_r($this->input->post());die;

    $purchase_id=$this->get_purchase_id();
    if ($this->form_validation->run()) {

##add purchase detail in master table
      $itemParams = array(


        'f_id' => $f_id,
        'total_amount'=>$total_amount,
        'purchase_id'=>$purchase_id,
        'vendor_id'=>$vendor_id,
        'vendor_invoice_id'=>$vendor_invoice,
        'tax'=> '',
        'purchase_date'=>$purchase_date,

        'created_at' => date('Y-m-d H-i-s'),  
        'created_by' => $staff_id

      );
      $purchase_reference_id = $this->Purchase_model->insert('table_purchase_master', $itemParams);

      ##--##

## add purchase particular 
      for($j=0;$j<count($item_id);$j++)
      {
        $purchaseDetailsparam=array(
          'purchase_id'=>$purchase_id,
          'item_id' => $item_id[$j],
          'selling_price' => $selling_price[$j],
          'purchase_price' => $purchase_price[$j],
          'qty'=>$qty[$j],
          'amount'=>$amount[$j],
          'f_id'=>$f_id,
          'created_at' => date('Y-m-d H-i-s'),
        );


        $purchase_order_detail = $this->Purchase_model->insert('table_purchase_details', $purchaseDetailsparam);

        ##--if item added by batch wise example(serial number and model no) ##

        if($batch_id[$j])
        {
          for($k=0;$k<$qty[$j];$k++)
          {
            $batchParams=array(
              'model_no'=>$this->input->post('model_number'.$item_id[$j].'['.$k.']'),
              'serial_no'=>$this->input->post('serial_number'.$item_id[$j].'['.$k.']'),
              'item_id'=>$item_id[$j],
              'f_id'=>$f_id,
              'purchase_id'=>$purchase_id


            );
                  // print_r($batchParams);
            $purchase_order_detail_batch_wise = $this->Purchase_model->insert('table_purchase_details_batch_wise',$batchParams); 
          }


        }             






      }





      if ($purchase_order_detail) {
        $this->session->alerts = array(
          'severity' => 'success',
          'title' => 'successfully added'
        );
        redirect('purchase/purchase_list');

      } else {
        $data['error'] = "item not added";
        $data['_view'] = 'add_item';
        $this->load->view('index', $data);
      }

    }
    else
    {
      $this->add_purchase();
    }
  }

## after purchase order entry admin approve 
  function purchase_approved($purchase_id)
  {
 #maintain stock items
    $f_id = $this->session->f_id;

  ##fetch purchase details
    $condition = array('t1.f_id' =>$f_id,'purchase_id'=>$purchase_id);
    $purchase_order=$this->Purchase_model->fetch_purchase_vendor('table_purchase_master',$condition,array('t1.id as purchase_reference_id','t1.purchase_status','t1.vendor_id','t1.purchase_id','t1.tax','t1.total_amount','Date(t1.created_at) as created_at','t2.name as vendor_name','t2.email as vendor_email','t2.mobile as vendor_mobile','t2.address as vendor_address','t2.city as vendor_city','t2.pincode as vendor_pincode','t2.name as company_name'));
    $conditionParticular = array('t1.f_id' =>$f_id,'t1.purchase_id'=>$purchase_id);

    $purchase_particular=$this->Purchase_model->fetch_purchase_order_details('table_purchase_details',$conditionParticular,array('*'));
## check if already purchase status approved then it can be run double time 
    if($purchase_order['purchase_status']!='approved')
    {
      for($j=0;$j<count($purchase_particular);$j++)
      {
        $itemStockCondition=array(
          'f_id'=>$f_id,
          'item_id' => $purchase_particular[$j]['item_id']
        );
        $itemStockDetails=$this->Purchase_model->select_id('table_item_stock',$itemStockCondition,array('qty_purchase','qty_in_hand'));

        $itemStockParams=array(
          'qty_purchase'=>$itemStockDetails['qty_purchase']+$purchase_particular[$j]['qty'],
          'qty_in_hand'=>$itemStockDetails['qty_in_hand']+$purchase_particular[$j]['qty']
        );
        $result=$this->Purchase_model->update_col('table_item_stock',$itemStockCondition,$itemStockParams);

      }
      $approveCondition=array('f_id'=>$f_id,'purchase_id'=>$purchase_id);
      $this->Purchase_model->update_col('table_purchase_master',$approveCondition,array('purchase_status'=>'approved'));


       ## maintain Account table
      $accountTransaction=array(
        'reference_id'=>$purchase_order['purchase_reference_id'],
        'reference_type'=>3,
        'ledger_group'=>9,##assets
        'debit'=>$purchase_order['total_amount'],
        'f_id'=>$f_id,
        'bill_id'=>$purchase_id,
        'customer_id'=>$purchase_order['vendor_id'],

        'created_at'=>date('Y-m-d H-i-s')

      );

      $accountTransactionDouble=array(
        'reference_id'=>$purchase_order['purchase_reference_id'],
        'reference_type'=>3,
        'ledger_group'=>7,##sundry creditors beacace it is an credit
        'credit'=>$purchase_order['total_amount'],
        'f_id'=>$f_id,
        'bill_id'=>$purchase_id,
        'customer_id'=>$purchase_order['vendor_id'],
        'double_entry'=>1,
        'created_at'=>date('Y-m-d H-i-s')

      );

      $this->Purchase_model->insert('table_account_transaction',$accountTransaction);
      $this->Purchase_model->insert('table_account_transaction',$accountTransactionDouble);
      $this->session->alerts = array(
        'severity' => 'success',
        'title' => 'successfully approved'
      );
      redirect('purchase/purchase_list');
    }
    else 
    {
     $this->session->alerts = array(
      'severity' => 'danger',
      'title' => 'already approved'
    );
     redirect('purchase/purchase_list');

   }



 }

##not perfectly improved in future
 function purchase_order_edit($purchase_id)
 {

// $this->Purchase_model->
  $f_id = $this->session->f_id;
  $params = array('f_id' => $f_id,'status'=>1);
  $vendorParams=array('f_id'=>$f_id,'status'=>1,'contact_type!='=>1);
  $data['vendor'] = $this->Purchase_model->select('table_crn', $vendorParams, array('id', 'name'));
  $data['item'] = $this->Purchase_model->select('table_item', $params, array('id','item_name'));
  $condition = array('t1.f_id' =>$f_id,'purchase_id'=>$purchase_id,'t1.status!='=>'paid');
  $data['purchase_order']=$this->Purchase_model->fetch_purchase_vendor('table_purchase_master',$condition,array('t1.purchase_id','t1.tax','t1.total_amount','Date(t1.created_at) as created_at','t2.name as vendor_name','t2.email as vendor_email','t2.mobile as vendor_mobile','t2.address as vendor_address','t2.city as vendor_city','t2.pincode as vendor_pincode','t2.name as company_name','t1.vendor_id','t1.purchase_date','t1.vendor_invoice_id','t1.purchase_status'));
  $conditionParticular = array('t1.f_id' =>$f_id,'t1.purchase_id'=>$purchase_id);

  $data['purchase_particular']=$this->Purchase_model->fetch_purchase_order_details('table_purchase_details',$conditionParticular,array('*'));

  if($data['purchase_order']['purchase_status']!='approved')
  {
    if (isset($data['purchase_order']['purchase_id'])) 
    {
      $this->load->library('form_validation');
      $vendor_invoice = strip_tags($this->input->post('vendor_invoice',1));
      $vendor_id = strip_tags($this->input->post('vendor_id', 1));
      $item_id = $this->input->post('item_id',1);
      $item_name = $this->input->post('item_name',1);
      $selling_price = $this->input->post('selling_amount',1);
      $purchase_price = $this->input->post('purchase_amount',1);
      $purchase_date = $this->input->post('purchase_date', 1);
      $qty =     $this->input->post('qty', 1);
      $amount =  $this->input->post('amount', 1);
      $batch_id= $this->input->post('check', 1);
      $purchase_detail_id= $this->input->post('purchase_detail_id', 1);
  // $item_category = strip_tags($this->input->post('category_id', 1));

  // $model_number =   $this->input->post('model_number');
  // $serial_number =  $this->input->post('serial_number');
  // $company_name =   strip_tags($this->input->post('company_name', 1));
  // $unit =         strip_tags($this->input->post('unit', 1));
      $total_amount =       strip_tags($this->input->post('total_amount', 1));
    // $this->form_validation->set_rules('selling_amount', 'Selling Amount', 'required');
    // $this->form_validation->set_rules('email','Email','max_length[50]|valid_email');
    // $this->form_validation->set_rules('name', 'Item Name', 'required|trim');
    // $this->form_validation->set_rules('description', 'description', 'required|trim');
// echo $opening_stock*$stock_value;die;
    // $this->form_validation->set_rules('unit', 'measurement unit', 'required');
    // $this->form_validation->set_rules('paddress','Permanent Address','required');
      $this->form_validation->set_rules('vendor_id','Vendor','required');

      if ($this->form_validation->run()) {
      // echo '<pre>';
        // print_r($this->input->post());die;
        $staff_id = $this->session->staff_id;

        $conditionPurchaseParam=array(
          'f_id' => $f_id,
          'purchase_id'=>$purchase_id

        );
        $itemParams = array(

          'total_amount'=>$total_amount,
          'vendor_id'=>$vendor_id,
          'vendor_invoice_id'=>$vendor_invoice,
          'tax'=> '',
          'purchase_date'=>$purchase_date,

        );
    // print_r($itemParams);
        $purchase_reference_id = $this->Purchase_model->update_col('table_purchase_master',$conditionPurchaseParam,$itemParams);


      ##purchase item details update
        for($p=0;$p<count($purchase_detail_id);$p++)
        {
          $purchaseDetailParam=array(


            'selling_price' => $selling_price[$p],
            'purchase_price' => $purchase_price[$p],
            'qty'=>$qty[$j],
            'amount'=>$amount[$j],
          );
          $purchaseDetailCondition=array('id'=>$purchase_detail_id[$p],'purchase_id'=>$purchase_id,'f_id'=>$f_id );
          $purchase_reference_id = $this->Purchase_model->update_col('table_purchase_details',$conditionPurchaseParam,$purchaseDetailCondition,$purchaseDetailParam);



        }



// die;

        $this->session->alerts = array(
          'severity' => 'success',
          'title' => 'successfully updated'
        );
        redirect('purchase/purchase_list');
      } else {
        $data['_view'] = 'edit_purchase_order';
        $this->load->view('index', $data);
      }
    } else
    show_error('The purchase order you are trying to edit does not exist.');
  }else
  show_error('Once order is approved you cant update order');

}






function purchase_list()
{
  $data['title'] = 'PURCHASE LIST';
  $f_id = $this->session->f_id;
  if($this->input->get('id'))
  {
    $item_id=$this->input->get('id');
    $condition = array('t1.f_id' => $f_id);
  }
  else
  { 
    $condition = array('t1.f_id' => $f_id);
  } 
  $categoryParam = array('f_id' => $f_id);
  $category = $this->Purchase_model->select('table_category', $categoryParam, array('category_id', 'name'));
  $data['category'] = $category;
  $data['purchase']=$this->Purchase_model->purchase_list('table_purchase_master',$condition,array('t1.created_at','t3.name as staff_name','t2.name as vendor_name','t1.purchase_id as purchase_id','t1.total_amount','t1.status','t1.purchase_status'));

// echo '<pre>';
// print_r($data['purchase']);
  $data['_view'] = 'purchase_list';
  $this->load->view('index', $data);


  
}

function get_purchase_id()
{
  $f_id=$this->session->f_id;
  $invoiceNoParams=array('f_id'=>$f_id);
  // $maxInvoiceNo=modules::run('api_call/api_call/call_api',''.api_url().'account/get_max_invoice_no',$invoiceNoParams,'POST');
  $maxInvoiceNo= json_decode($this->Purchase_model->purchase_order_id('table_purchase_master',$invoiceNoParams),1);
 // print_r($maxInvoiceNo);die;
  if($maxInvoiceNo['status']=='not found')
  {
    return $invoice_id='1';
    // echo 1;
  }
  else if($maxInvoiceNo['status']=='success')
  {

   return $invoice_id=$maxInvoiceNo['data'];
   // echo $invoice_id;
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



function payment_status()
{
  $f_id = $this->session->f_id;
  $staff_id = $this->session->staff_id;
  $invoice_id = $this->input->post('invoice_id');
  $payment_type = $this->input->post('payment_type');
  $paid = $this->input->post('pay');
  $order_reference = $this->input->post('order_id');
  $customer_id = $this->input->post('customer_id');
  $payment_date = $this->input->post('payment_date');
  $params = array(
    'f_id' => $f_id,
    'invoice_id' => $invoice_id,
    'staff_id' => $staff_id,
    'payment_method' => $payment_type,
    'amount' => $paid,
    'order_reference' => $order_reference,
    'payment_date' => $payment_date,
    'customer_id'=>$customer_id


  );
  $this->Purchase_model->insert('table_payment_details', $params); 

##update invoice paid column
  $invoiceCondition=array(
    'invoice_id'=>$invoice_id,
    'f_id'=>$f_id
  );
  $invoiceParams=array(
    'paid'=>$paid
  );
  $this->Purchase_model->update_col('table_invoices',$invoiceCondition,$invoiceParams); 
  $this->load->model('Account/Account_model');
  $this->Account_model->maintain_status_invoice($paid, $f_id, $invoice_id);
  $this->session->alerts = array(
    'severity' => 'success',
    'title' => 'successfully Paid'
  );


  redirect('item/sales_order_view/2');
}


function reciept_view($payment_id)
{
 $f_id = $this->session->f_id;
 $data['_view'] = 'reciept_view';
 $params=array('payment_details.f_id'=>$f_id,'payment_details.id'=>$payment_id);
 $data=$this->Purchase_model->select_payment_details('table_payment_details',$params,array('payment_details.invoice_id','name','mobile','company_name','f_mobile','f_email','address','f_address','payment_details.amount','payment_date','c_city','c_pincode','payment_method')); 
   // print_r($data);die;
 $data['_view'] = 'reciept_view';
 $this->load->view('index', $data);

}


function fetch_order_item_details()
{
  $f_id = $this->session->f_id;
  $purchase_id = $this->input->post('purchase_id');
  $conditionParticular = array('t1.f_id' =>$f_id,'t1.purchase_id'=>$purchase_id);

  $data['purchase_particular']=$this->Purchase_model->fetch_purchase_order_details('table_purchase_details',$conditionParticular,array('t1.*','t3.item_name','measurement_unit' ));
  echo json_encode($data['purchase_particular']);


}
function vendor_payment()
{

  $data['_view'] = 'vendor/add_payment';
  $this->load->view('index.php',$data);
}



function purchase_order_view($purchase_id)
{
  $data['title']='purchase order';
  $f_id = $this->session->f_id;
  $condition = array('t1.f_id' =>$f_id,'purchase_id'=>$purchase_id,'t1.status!='=>'paid');
  $data['purchase_order']=$this->Purchase_model->fetch_purchase_vendor('table_purchase_master',$condition,array('t1.purchase_id','t1.tax','t1.total_amount','Date(t1.created_at) as created_at','t2.name as vendor_name','t2.email as vendor_email','t2.mobile as vendor_mobile','t2.address as vendor_address','t2.city as vendor_city','t2.pincode as vendor_pincode','t2.name as company_name'));
  $conditionParticular = array('t1.f_id' =>$f_id,'t1.purchase_id'=>$purchase_id);

  $data['purchase_particular']=$this->Purchase_model->fetch_purchase_order_details('table_purchase_details',$conditionParticular,array('*'));
$batchWiseCondition=array('t1.f_id'=>$f_id,'t1.purchase_id'=>$purchase_id);
// print_r($data['purchase_particular']);die;
$data['batch_wise']=$this->Purchase_model->fetch_item_batch_wise('table_purchase_details_batch_wise',$batchWiseCondition,array('t2.item_name','t1.model_no','t1.serial_no'));

  // echo "<pre>";
  // print_r($data);
  // die;
  $data['_view'] = 'purchase_order_view';
  $this->load->view('index.php',$data);

}

##purchase details of vendors
function fetch_vendor_purchase()
{
// echo "2";
 $f_id = $this->session->f_id;
 $vendor_id=$this->input->post('vendor_id');
 $condition=array('f_id'=>$f_id,'vendor_id'=>$vendor_id,'status!='=>'paid','purchase_status'=>'approved');
 $data['vendor_bill']=$this->Purchase_model->select('table_purchase_master',$condition,array('*'));
 $balanceCondition=array('id'=>$vendor_id,
  'f_id'=>$f_id,'balance_status!='=>'paid');
 
 $data['initial_balance']= $this->Purchase_model->select_id('table_crn',$balanceCondition,array('initial_balance','paid'));
 echo json_encode($data);


}


function payment_vendor()
{

  // print_r($this->input->post());
  // die;
  $f_id=$this->session->f_id;
  $staff_id=$this->session->staff_id;
    // $payment_id=$this->input->post("payment_id",1);
  // $paid=
  $vendor_id=trim($this->input->post('vendor_id',1));

  $method=trim($this->input->post('method',1));
  $total_amount=$this->input->post('total_amount',1);
 ##in form of array
  $purchase_id=$this->input->post('purchase_id',1);
  $paid_amount=$this->input->post('purchase_payment',1);
  $initial_balance_paid=$this->input->post('initial_balance_payment',1);
  if($initial_balance_paid>0)
  {
    $initialBalanceCondition=array(
      'f_id'=>$f_id,
      'id'=>$vendor_id
    );

       ##fetch previous paid balance for updation
    $paidBalance=$this->Purchase_model->select_id('table_crn',$initialBalanceCondition,array('paid'));
    $newPaidbalance=$paidBalance['paid']+$initial_balance_paid;
    $this->Purchase_model->update_col('table_crn',$initialBalanceCondition,array('paid'=>$newPaidbalance));
    $this->load->model('sales/Sales_model');
    $this->Sales_model->initial_balance_status('table_crn',$vendor_id,$f_id);


  }
  $purchase_count=count($purchase_id);
  if($purchase_count>0)
  {

    $purchases=array();
    for ($j=0; $j <$purchase_count ; $j++) { 
   # code...
      if($paid_amount[$j]>0)
      {
        array_push($purchases,$purchase_id[$j]);
      }

    }
 // print_r($purchases);
    $payment_id= modules::run('account/account/get_vendor_payment_id');
    $paidParams = array
    (
      'f_id' => $f_id,
      'payment_id'=>$payment_id,
      'purchase_id' => json_encode($purchases),
      'staff_id' => $staff_id,
      'vendor_id' => $vendor_id,
      'payment_mode' => $method,
      'total_amount' => $total_amount,

      'created_at' => date('Y-m-d H-i-s')


    );

      // print_r($paidParams);die;
    $payment_reference_id=$this->Purchase_model->insert('table_vendors_payment', $paidParams);
    for($i=0;$i<$purchase_count;$i++)
    {

     if($paid_amount[$i]>0)
     {
      $purchaseCondition=array(
        'purchase_id'=>$purchase_id[$i],
        'f_id'=>$f_id
      );
      $purchasePaidParams=array(
        'paid'=>$paid_amount[$i]
      );
      $this->Purchase_model->update_col('table_purchase_master',$purchaseCondition,$purchasePaidParams); 
      $this->load->model('Account/Account_model');
      $this->Account_model->maintain_status_purchase($paid_amount[$i],$f_id,$purchase_id[$i]);
    }
  }
  $accountTransaction=array(
    'reference_id'=>$payment_reference_id,
    'reference_type'=>4,## vendor payment
  'ledger_group'=>10,##assets
  'credit'=>$total_amount,
  'f_id'=>$f_id,
  'vendor_payment_id'=>$payment_id,
  'customer_id'=>$vendor_id,
  'double_entry'=>1,              
  'created_at'=>date('Y-m-d H-i-s')

);

  $accountTransactionDouble=array
  (
    'reference_id'=>$payment_reference_id,
    'reference_type'=>4,
      'ledger_group'=>7,##sundry creditors
      'debit'=>$total_amount,
      'f_id'=>$f_id,
      'vendor_payment_id'=>$payment_id,
      'customer_id'=>$vendor_id,
      'created_at'=>date('Y-m-d H-i-s')

    );
  $this->Account_model->insert('table_account_transaction',$accountTransactionDouble);
  $this->Account_model->insert('table_account_transaction',$accountTransaction);
  $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully added'

  );
  redirect('purchase/vendor_payment');
}

}

function search_vendors_details()
{
  $search_query=$this->input->post('search',1);
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id,'contact_type!='=>1);
  $result=$this->Purchase_model->search_query('table_crn',$condition,$search_query);
  echo json_encode($result);
}
/*all function end*/
}
?>	