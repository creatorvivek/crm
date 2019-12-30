<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sales extends MY_Controller
{
// public $f_id= $this->session->f_id;
  function __construct()
  {
    parent::__construct();
    $this->load->model('Sales_model');
  }






  


## process of sales add
  function add_sales()
  {
        // print_r($this->input->post());die;

    $data['title'] = "ADD SALES";
    $f_id = $this->session->f_id;
    $staff_id = $this->session->staff_id;
    $customer_name = strip_tags($this->input->post('name', 1));
    $customer_id = strip_tags($this->input->post('customer_id', 1));
    $qty=$this->input->post('qty',1);
 // $description=strip_tags($this->input->post('description',1));
    $mobile = strip_tags($this->input->post('mobile', 1));
    $email = strip_tags($this->input->post('email', 1));
    $address = strip_tags($this->input->post('address', 1));
    $pincode = strip_tags($this->input->post('pincode', 1));
    $city = strip_tags($this->input->post('city', 1));
    $unit =$this->input->post('unit', 1);
    $selling_price = $this->input->post('selling_amount', 1);
    $item_id = $this->input->post('item_id', 1);
    $amount = $this->input->post('item_price', 1);
    $item_name = $this->input->post('item_name', 1);
    $total = strip_tags($this->input->post('total', 1));
    $discount=$this->input->post('discount', 1);
    $method=$this->input->post('method', 1);
  // $total=22;
    // print_r($item_name);die;
    $orderParams = array('f_id' => $f_id);
    $order_no = $this->Sales_model->get_max_order_no('table_sales', $orderParams);
    if (!$order_no) {
      $order_no = 1;
    }

    $itemCount = count($item_id);

    $date = date('Y-m-d H:i:s');


    $params = array('customer_name' => $customer_name, 'customer_id' => $customer_id, 'mobile' => $mobile, 'email' => $email, 'f_id' => $f_id, 'created_by' => $staff_id, 'created_at' => $date, 'total' => $total, 'order_id' => $order_no);
 // print_r($params);die;
    $addSales = $this->Sales_model->insert('table_sales', $params);
#update stock

    for ($i = 0; $i < count($item_id); $i++) 
    { 
      # code...

      // $condition = array('id' => $item_id[$i]);
      // ##fetch item quantity 
      // $quantity=$this->Sales_model->select('table_purchase',$condition,array('quantity_for_sale','purchase_price','item_id','quantity_out'));
      // $reamaning_item=$quantity[0]['quantity_for_sale']-$qty[$i];
      // $quantity_out=$quantity[0]['quantity_out'];
      // ##update how much quantity out and how much reamaning for sales
      // $quantity_out_update = $quantity[0]['quantity_out']+$qty[$i];
      // $itemParams = array('quantity_for_sale' => $reamaning_item,'quantity_out'=>$quantity_out_update);
      // $this->Sales_model->update_col('table_purchase', $condition, $itemParams);
      ##update stock
     $itemStockCondition=array(
      'f_id'=>$f_id,
      'item_id' => $item_id[$i]
    );
     $itemStockDetails=$this->Sales_model->select_id('table_item_stock',$itemStockCondition,array('qty_sale','qty_in_hand'));

     $itemStockParams=array(
      'qty_sale'=>$itemStockDetails['qty_sale']+$qty[$i],
      'qty_in_hand'=>$itemStockDetails['qty_in_hand']-$qty[$i]
    );
     $resultUpdate=$this->Sales_model->update_col('table_item_stock',$itemStockCondition,$itemStockParams);


    ##inserts sale details
     $saleDetailsParam = array(
      'particular' => $item_id[$i],
      'price' => $amount[$i],
      'f_id' => $f_id,
      'quantity'=>$qty[$i],
      'order_no' => $order_no,
      'created_at' =>$date,
      'purchase_price'=>'',
      'discount_percent'=>$discount[$i],
      'type'=>1
    );

     $addSalesDetails = $this->Sales_model->insert('table_sales_details', $saleDetailsParam);

      ##for profit loss graph

      // $profitLossParam=array(
      //   'item_purchase_id'=>$item_id[$i],
      //   'item_id'=>$quantity[0]['item_id'],
      //   'purchase_price'=>$quantity[0]['purchase_price'],
      //   'selling_price'=>round($amount[$i]/$qty[$i]),
      //   'qty'=>$qty[$i],
      //   'created_at'=>$date,
      //   'f_id'=>$f_id


      // );
      //  $addGraphDetails = $this->Sales_model->insert('table_item_graph',$profitLossParam);
     /*end profit loss graph*/

   }
   


   $particularParam = array(
    'particular' => $item_name,
    'price' => $amount,
    'quantity'=>$qty,
    'unit'=>$unit
  );
    // print_r($particularParam);die;
   $invoiceParams = array(
    'customer_name' => $customer_name, 'mobile' => $mobile, 'email' => $email, 'f_id' => $f_id, 'created_by' => $staff_id, 'created_at' => $date, 'order_id' => $order_no, 'customer_id' => $customer_id,'c_city'=>$city,'c_pincode'=>$pincode,'address'=>$address

  );
   $invoice_id = modules::run('account/account/invoice', $invoiceParams, $particularParam);
  ## paid amount
   $paid_amount= $this->input->post('paid_amount');
   if ($paid_amount > 0) 
   {
        ##generate Payment id
    $payment_id= modules::run('account/account/get_payment_id');
    $paidParams = array
    (
      'f_id' => $f_id,
      'payment_id'=>$payment_id,
      'invoice_id_json' => json_encode($invoice_id),
      'invoice_id'=>$invoice_id,
      'staff_id' => $staff_id,
      'customer_id' => $customer_id,
      'payment_method' => $method,
      'amount' => $paid_amount,
        // 'order_reference' => $order_no,
      'payment_date' => date('Y-m-d H-i-s')


    );

    $payment_reference_id=$this->Sales_model->insert('table_payment_details', $paidParams);

    $invoiceCondition=array(
      'invoice_id'=>$invoice_id,
      'f_id'=>$f_id
    );
    $invoicePaidParams=array(
      'paid'=>$paid_amount
    );
    $this->Sales_model->update_col('table_invoices',$invoiceCondition,$invoicePaidParams); 
    $this->load->model('Account/Account_model');
    $this->Account_model->maintain_status_invoice($paid_amount,$f_id,$invoice_id);
    $accountTransaction=array(
      'reference_id'=>$payment_reference_id,
      'reference_type'=>2,
      'debit'=>$paid_amount,
      'f_id'=>$f_id,
      'ledger_group'=>10,##cash in hand
      'reciept_id'=>$payment_id,
      'customer_id'=>$customer_id,
       'created_at'=>date('Y-m-d')

    );
    $accountTransactionDouble=array(
      'reference_id'=>$payment_reference_id,
      'reference_type'=>2,
      'credit'=>$paid_amount,
      'f_id'=>$f_id,
      'ledger_group'=>6,
      'reciept_id'=>$payment_id,
      'customer_id'=>$customer_id,
      'double_entry'=>1,
       'created_at'=>date('Y-m-d')

    );
    $this->Account_model->insert('table_account_transaction',$accountTransaction);
    $this->Account_model->insert('table_account_transaction',$accountTransactionDouble);

  }

  $this->session->alerts = array(
    'severity' => 'success',
    'title' => 'successfully added'
  );
  redirect('sales/sales_list');



 // $serial_number=strip_tags($this->input->post('serial_number',1));
 // $company_name=strip_tags($this->input->post('company_name',1));
}
function add_sales_service()
{
    
  $data['title'] = "ADD SALES & SERVICE";
  $f_id = $this->session->f_id;
  $staff_id = $this->session->staff_id;
  $customer_name = strip_tags($this->input->post('name', 1));
  $customer_id = strip_tags($this->input->post('customer_id', 1));
  $qty=$this->input->post('qty',1);
 // $description=strip_tags($this->input->post('description',1));
  $mobile = strip_tags($this->input->post('mobile', 1));
  $email = strip_tags($this->input->post('email', 1));
  $address = strip_tags($this->input->post('address', 1));
  $pincode = strip_tags($this->input->post('pincode', 1));
  $city = strip_tags($this->input->post('city', 1));
  $unit =$this->input->post('unit', 1);
  $selling_price = $this->input->post('selling_amount', 1);
  $item_id = $this->input->post('item_id', 1);
  $amount = $this->input->post('item_price', 1);
  $item_name = $this->input->post('item_name', 1);
  $total = strip_tags($this->input->post('total', 1));
  $discount=$this->input->post('discount', 1);
  $method=$this->input->post('method', 1);


      ##for service
  $service_amount = $this->input->post('service_price',1);
  $service_id = $this->input->post('service_id',1);
     // print_r($service_id);die;
  $service_name = $this->input->post('service_name',1);
  $service_discount=$this->input->post('service_discount',1);
  $service_unit=$this->input->post('service_unit',1);
  $service_validity=$this->input->post('service_validity',1);
  // $total=22;
    // print_r($item_name);die;
  $orderParams = array('f_id' => $f_id);
  $order_no = $this->Sales_model->get_max_order_no('table_sales', $orderParams);
  if (!$order_no) {
    $order_no = 1;
  }

  $itemCount = count($item_id);

  $date = date('Y-m-d H:i:s');


  $params = array('customer_name' => $customer_name, 'customer_id' => $customer_id, 'mobile' => $mobile, 'email' => $email, 'f_id' => $f_id, 'created_by' => $staff_id, 'created_at' => $date, 'total' => $total, 'order_id' => $order_no);
 // print_r($params);die;
  $addSales = $this->Sales_model->insert('table_sales', $params);
#update stock
    // print_r($item_id);
  for ($i = 0; $i < count($item_id); $i++) 
  { 
      # code...

      // $condition = array('id' => $item_id[$i]);
      // ##fetch item quantity 
      // $quantity=$this->Sales_model->select('table_purchase',$condition,array('quantity_for_sale','purchase_price','item_id','quantity_out'));
      // $reamaning_item=$quantity[0]['quantity_for_sale']-$qty[$i];
      // $quantity_out=$quantity[0]['quantity_out'];
      // ##update how much quantity out and how much reamaning for sales
      // $quantity_out_update = $quantity[0]['quantity_out']+$qty[$i];
      // $itemParams = array('quantity_for_sale' => $reamaning_item,'quantity_out'=>$quantity_out_update);
      // $this->Sales_model->update_col('table_purchase', $condition, $itemParams);

    $itemStockCondition=array(
      'f_id'=>$f_id,
      'item_id' => $item_id[$i]
    );
    $itemStockDetails=$this->Sales_model->select_id('table_item_stock',$itemStockCondition,array('qty_sale','qty_in_hand'));

    $itemStockParams=array(
      'qty_sale'=>$itemStockDetails['qty_sale']+$qty[$i],
      'qty_in_hand'=>$itemStockDetails['qty_in_hand']-$qty[$i]
    );
      // print_r($itemStockParams);die;
    $resultUpdate=$this->Sales_model->update_col('table_item_stock',$itemStockCondition,$itemStockParams);



  $serial_no_array=$this->input->post('serial'.$item_id[$i]);
  if($serial_no_array)
  {

    $serial_no_json=json_encode($serial_no_array);
  }
  else
  {
    $serial_no_json="{}";
  }
    ##inserts sale details
    $saleDetailsParam = array(
      'particular' => $item_id[$i],
      'price' => $amount[$i],
      'f_id' => $f_id,
      'quantity'=>$qty[$i],
      'order_no' => $order_no,
      'created_at' =>$date,
      'purchase_price'=>'',
      'serial_no'=>$serial_no_json,
      'discount_percent'=>$discount[$i],
      'type'=>1
    );
    // print_r($item_id[0]);
    // print_r($saleDetailsParam);
    $addSalesDetails = $this->Sales_model->insert('table_sales_details', $saleDetailsParam);

      ##for profit loss graph

      // $profitLossParam=array(
      //   'item_purchase_id'=>$item_id[$i],
      //   'item_id'=>$quantity[0]['item_id'],
      //   'purchase_price'=>$quantity[0]['purchase_price'],
      //   'selling_price'=>round($amount[$i]/$qty[$i]),
      //   'qty'=>$qty[$i],
      //   'created_at'=>$date,
      //   'f_id'=>$f_id


      // );
      //  $addGraphDetails = $this->Sales_model->insert('table_item_graph',$profitLossParam);
    /*end profit loss graph*/

##serial number status on and insert in sales order
if(count($serial_no_array)>0)
{


      for($serial_item=0;$serial_item<count($serial_no_array);$serial_item++)
      {
        $itemSaleStatusCondition=array('f_id'=>$f_id,'item_id'=>$item_id[$i],'serial_no'=>$serial_no_array[$serial_item]);
        // print_r($itemSaleStatusCondition);
        $this->Sales_model->update_col('table_purchase_details_batch_wise',$itemSaleStatusCondition,array('sale_status'=>1));

      }
}
// die;
  }


    
    ##update item status
    #for service
  if($service_id)
  {
    for($j = 0; $j < count($service_id); $j++)
    {
       ##inserts sale details
       // $item_id = $this->input->post('item_id', 1);

      $serviceDetailsParam = array(
        'particular' => $service_id[$j],
        'price' => $service_amount[$j],
        'f_id' => $f_id,
        'quantity'=>$service_validity[$j],
        'order_no' => $order_no,
        'created_at' =>$date,
        'purchase_price'=>$service_amount[$j],
        'discount_percent'=>$service_discount[$j],
        'type'=>2
      );
      
      $addServiceDetails = $this->Sales_model->insert('table_sales_details', $serviceDetailsParam);
    }
  }

  $particular=array();
  $particular_amount=array();
  $particular_qty=array();
  $particular_unit=array();
  if(!$service_id)
  {
    $service_name=array();
    $service_amount=array();
    $service_validity=array();
    $service_unit=array();
  }
  if(!$item_id)
  {

    $item_name=array();
    $amount=array();
    $qty=array();
    $unit=array();

  }
  $array3=array_merge($item_name,$service_name);
  $array4=array_merge($amount,$service_amount);
  $array5=array_merge($qty,$service_validity);
  $array6=array_merge($unit,$service_unit);
  array_push($particular,$array3);
  array_push($particular_amount,$array4);
  array_push($particular_qty,$array5);
  array_push($particular_unit,$array6);
    // array_push($particular,$item_name);
    // echo '<pre>';
    // print_r($particular_amount);
  $particularParam = array(
    'particular' => $particular[0],
    'price' => $particular_amount[0],
    'quantity'=>$particular_qty[0],
    'unit'=>$particular_unit[0]
  );
    // die;
    // print_r($particularParam);
  $invoiceParams = array(
    'customer_name' => $customer_name, 'mobile' => $mobile, 'email' => $email, 'f_id' => $f_id, 'created_by' => $staff_id, 'created_at' => $date, 'order_id' => $order_no, 'customer_id' => $customer_id,'c_city'=>$city,'c_pincode'=>$pincode,'address'=>$address

  );
  $invoice_id = modules::run('account/account/invoice', $invoiceParams, $particularParam);
  ## paid amount
  $paid_amount= $this->input->post('paid_amount');
  if ($paid_amount > 0) 
  { 
        ##generate Payment id
    $payment_id= modules::run('account/account/get_payment_id');
    $paidParams = array
    (
      'f_id' => $f_id,
      'payment_id'=>$payment_id,
      'invoice_id' => json_encode($invoice_id),
      'invoice_id'=>$invoice_id,
      'staff_id' => $staff_id,
      'customer_id' => $customer_id,
      'payment_method' => $method,
      'amount' => $paid_amount,
        // 'order_reference' => $order_no,
      'payment_date' => date('Y-m-d H-i-s')


    );

    $payment_reference_id=$this->Sales_model->insert('table_payment_details', $paidParams);
    $invoiceCondition=array(
      'invoice_id'=>$invoice_id,
      'f_id'=>$f_id
    );
    $invoicePaidParams=array(
      'paid'=>$paid_amount
    );
    $this->Sales_model->update_col('table_invoices',$invoiceCondition,$invoicePaidParams); 
    $this->load->model('Account/Account_model');
    $this->Account_model->maintain_status_invoice($paid_amount,$f_id,$invoice_id);
    
    $accountTransaction=array(
      'reference_id'=>$payment_reference_id,
      'reference_type'=>2,
      'debit'=>$paid_amount,
      'f_id'=>$f_id,
      'ledger_group'=>10,
      'reciept_id'=>$payment_id,
      'customer_id'=>$customer_id,
       'created_at'=>date('Y-m-d')

    );
    $accountTransactionDouble=array(
      'reference_id'=>$payment_reference_id,
      'reference_type'=>2,
      'credit'=>$paid_amount,
      'f_id'=>$f_id,
      'ledger_group'=>6,
      'reciept_id'=>$payment_id,
      'customer_id'=>$customer_id,
      'double_entry'=>1,
       'created_at'=>date('Y-m-d')

    );
    $this->Account_model->insert('table_account_transaction',$accountTransaction);
    $this->Account_model->insert('table_account_transaction',$accountTransactionDouble);
 

  }

  $this->session->alerts = array(
    'severity' => 'success',
    'title' => 'successfully added'
  );
  redirect('sales/sales_list');

}






function sale_add()
{
  $data['title'] = "ADD SALES";
  $f_id = $this->session->f_id;
  // echo $f_id;die;
  $params = array('t1.f_id' =>$f_id,'t2.qty_in_hand>'=>0);
  $item = $this->Sales_model->select_item('table_item',$params, array('t1.id','t1.item_name','t1.description','t1.selling_price','t2.qty_in_hand','t1.measurement_unit as unit'));
  // print_r($item);die;
  $data['items'] = $item;
  $data['_view'] = 'add_sales';
  $this->load->view('index', $data);

}
function sale_service_add()
{
  $data['title'] = "ADD SALES & SERVICES";
  $f_id = $this->session->f_id; 

  $params = array('t1.f_id' =>$f_id,'t2.qty_in_hand>'=>0);
  $item = $this->Sales_model->select_item('table_item',$params, array('t1.id','t1.item_name','t1.description','t1.selling_price','t2.qty_in_hand','t1.measurement_unit as unit'));
    // print_r($item);die;
  $condition=array('f_id'=>$f_id);
  $data['service']=$this->Sales_model->select('table_services',$condition,array('*'));

  $data['items'] = $item;
  $data['_view'] = 'add_sales_service';
  $this->load->view('index', $data);
}
function add_service()
{
    // print_r($this->input->post());die;
  $f_id = $this->session->f_id;
  $staff_id = $this->session->staff_id;
  $customer_name = strip_tags($this->input->post('name', 1));
  $customer_id = strip_tags($this->input->post('customer_id', 1));
  $qty=$this->input->post('qty',1);
 // $description=strip_tags($this->input->post('description',1));
  $mobile = strip_tags($this->input->post('mobile', 1));
  $email = strip_tags($this->input->post('email', 1));
  $address = strip_tags($this->input->post('address', 1));
  $pincode = strip_tags($this->input->post('pincode', 1));
  $city = strip_tags($this->input->post('city', 1));
  $unit = strip_tags($this->input->post('unit', 1));
  $selling_price = $this->input->post('selling_amount', 1);
  $item_id = $this->input->post('item_id', 1);
  $amount = $this->input->post('item_price', 1);
  $item_name = $this->input->post('item_name', 1);
  $total = strip_tags($this->input->post('total', 1));
  $discount=$this->input->post('discount', 1);
  $method=$this->input->post('method', 1);
  // $total=22;
    // print_r($item_name);die;
  
  $orderParams = array('f_id' => $f_id);
  $order_no = $this->Sales_model->get_max_order_no('table_sales', $orderParams);
  if (!$order_no) {
    $order_no = 1;
  }
 // print_r($order_no);die;
  $itemCount = count($item_id);
 // echo $itemCount;
  $date = date('Y-m-d H:i:s');

    // $params['item_id']=$item_id[$i];
    // $params['item_amount']=$amount[$i];
  $params = array('customer_name' => $customer_name, 'customer_id' => $customer_id, 'mobile' => $mobile, 'email' => $email, 'f_id' => $f_id, 'created_by' => $staff_id, 'created_at' => $date, 'total' => $total, 'order_id' => $order_no);
 // print_r($params);die;
  $addSales = $this->Sales_model->insert('table_sales', $params);
#update stock
  for ($i = 0; $i < count($item_id); $i++) { 
      # code...


    ##inserts sale details
    $saleDetailsParam = array(
      'particular' => $item_id[$i],
      'price' => $amount[$i],
      'f_id' => $f_id,
      'quantity'=>$qty[$i],
      'order_no' => $order_no,
      'created_at' =>$date,
      'discount_percent'=>$discount[$i],
      'type'=>2
    );
    $addSalesDetails = $this->Sales_model->insert('table_sales_details', $saleDetailsParam);
  }
  $particularParam = array(
    'particular' => $item_name,
    'price' => $amount,
    'quantity'=>$qty,
    'unit'=>$unit
  );
    // print_r($particularParam);die;
  $invoiceParams = array(
    'customer_name' => $customer_name, 'mobile' => $mobile, 'email' => $email, 'f_id' => $f_id, 'created_by' => $staff_id, 'created_at' => $date, 'order_id' => $order_no, 'customer_id' => $customer_id,'c_city'=>$city,'c_pincode'=>$pincode,'address'=>$address

  );
  $invoice_id = modules::run('account/account/invoice', $invoiceParams, $particularParam);
  ## paid amount
  $paid_amount= $this->input->post('paid_amount');
  if ($paid_amount > 0) 
  {
        ##generate Payment id
    $payment_id= modules::run('account/account/get_payment_id');
    $paidParams = array
    (
      'f_id' => $f_id,
      'payment_id'=>$payment_id,
      'invoice_id' => $invoice_id,
      'staff_id' => $staff_id,
      'customer_id' => $customer_id,
      'payment_method' => $method,
      'amount' => $paid_amount,
      'order_reference' => $order_no,
      'payment_date' => date('Y-m-d H-i-s')


    );

    $payment_reference_id=$this->Sales_model->insert('table_payment_details', $paidParams);
    $invoiceCondition=array(
      'invoice_id'=>$invoice_id,
      'f_id'=>$f_id
    );
    $invoicePaidParams=array(
      'paid'=>$paid_amount
    );
    $this->Sales_model->update_col('table_invoices',$invoiceCondition,$invoicePaidParams); 
    $this->load->model('Account/Account_model');
    $this->Account_model->maintain_status_invoice($paid_amount,$f_id,$invoice_id);

    $accountTransaction=array(
      'reference_id'=>$payment_reference_id,
      'reference_type'=>2,
      'debit'=>$paid_amount,
      'f_id'=>$f_id,
      'ledger_group'=>10,
      'reciept_id'=>$payment_id,
      'customer_id'=>$customer_id,
       'created_at'=>date('Y-m-d')

    );
    $accountTransactionDouble=array(
      'reference_id'=>$payment_reference_id,
      'reference_type'=>2,
      'credit'=>$paid_amount,
      'f_id'=>$f_id,
      'ledger_group'=>6,
      'reciept_id'=>$payment_id,
      'customer_id'=>$customer_id,
      'double_entry'=>1,
       'created_at'=>date('Y-m-d')

    );
    
    $this->Account_model->insert('table_account_transaction',$accountTransactionDouble);
    $this->Account_model->insert('table_account_transaction',$accountTransaction);

  }

  $this->session->alerts = array(
    'severity' => 'success',
    'title' => 'successfully added'
  );
  redirect('sales/sales_list');
}
function sales_list()
{

  $data['title'] = 'SALES LIST';
  $f_id = $this->session->f_id;
  $staff_id = $this->session->staff_id;
  $data['heading'] = 'SALES LIST';

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
$data['_view'] = 'sales_item';
$this->load->view('index', $data);

}

function sales_return()
{
  $data['title']="Sales Return";
$f_id = $this->session->f_id;
 $data['customers']=$this->Sales_model->select('table_crn',array('f_id' => $f_id,'contact_type'=>1),array('id','name'));
if($this->input->post())
{
$customer_id=$this->input->post('customer_id',1);
$invoice_id=$this->input->post('invoice_id',1);
 $conditionParticular = array('invoice_id' => $invoice_id, 'f_id' => $f_id);
$condition=array('customer_id'=>$customer_id,'invoice_id'=>$invoice_id,'f_id'=>$f_id);
// print_r($condition);
 $data['invoice'] = $this->Sales_model->select_id('table_invoices', $condition, array('*'));
  $data['invoice_particular'] = $this->Sales_model->select('table_master_invoice', $conditionParticular, array('*'));
##fetch invoice details
  // echo '<pre>';
  // print_r($data);
  // die;
}
$data['_view'] = 'sales_return';
$this->load->view('index', $data);

}

function sales_return_process()
{
// print_r($this->input->post());die;
$total=$this->input->post('total_return',1);
$customer_id=$this->input->post('customer_id',1);
$f_id = $this->session->f_id;
$invoice_id=$this->input->post('invoice_id',1);
##amount credit by sales account

$accountTransaction=array(
      // 'reference_id'=>$payment_reference_id,
      'reference_type'=>8,
      'debit'=>$total,
      'f_id'=>$f_id,
      'ledger_group'=>5,
      'invoice_id'=>$invoice_id,
      'customer_id'=>$customer_id,
       'created_at'=>date('Y-m-d')

    );
$accountTransactionDouble=array(
      // 'reference_id'=>$payment_reference_id,
      'reference_type'=>8,
      'credit'=>$total,
      'f_id'=>$f_id,
      'ledger_group'=>6,
      'invoice_id'=>$invoice_id,
      'customer_id'=>$customer_id,
       'created_at'=>date('Y-m-d'),
       'double_entry'=>1

    );

  $this->Sales_model->insert('table_account_transaction',$accountTransaction);
  $this->Sales_model->insert('table_account_transaction',$accountTransactionDouble);

$returnParam=array(
 'f_id'=>$f_id,
 'invoice_id'=>$invoice_id,
      'customer_id'=>$customer_id,
       'created_at'=>date('Y-m-d'),
       'total'=>$total



);

 $this->Sales_model->insert('table_sales_return',$returnParam);
}







function fetch_amount()
{
  $item_id = $this->input->post('item_id');
  $params = array('id' => $item_id);
  $item = $this->Sales_model->select('table_item', $params, array('id', 'selling_price', 'description', 'item_name'));
   // print_r($item[0]['selling_price']);
  echo json_encode($item[0]);



}

function fetch_item()
{
  $f_id = $this->session->f_id;
  $params = array('f_id' => $f_id, 'quantity>' => 0);
  $item = $this->Sales_model->select('table_item', $params, array('id', 'item_name', 'description', 'selling_price', 'purchase_price', 'model_no', 'serial_no', 'created_by', 'created_at','quantity'));
  echo json_encode($item);
}




function saled_item_list()
{
 /*future use*/
 $data['title'] = 'ITEM LIST';
 $f_id = $this->session->f_id;
 $staff_id = $this->session->staff_id;
 $params = array('item.f_id' => $f_id, 'status' => 0);
 $itemList = $this->Sales_model->stock_list('table_item', $params, array('item.id', 'item_name', 'description', 'selling_price', 'purchase_price', 'model_no', 'serial_no', 'item.created_by', 'item.created_at', 'category', 'staff.name as staff_name'));
    // print_r($itemList);die;
   // echo '<pre>';
 $categoryParam = array('f_id' => $f_id);
 $this->load->model('category/Category_model');
 $category = $this->Category_model->select('table_category', $categoryParam, array('category_id', 'name'));
 $data['category'] = $category;
  // $this->output->enable_profiler(TRUE);
   // die;
 $data['heading'] = 'SAILED ITEM LIST';
 $data['item'] = $itemList;
 $data['_view'] = 'saled_item_list';
 $this->load->view('index', $data);
}
function search()
{
  $search = $this->input->post('search'); 
 // $search=$this->uri->segment(3);
  $condition = array('f_id' => $this->session->f_id);
  $data = array();
  $data['status_no'] = 0;
  $data['message'] = 'No Item Found!';
  $data['items'] = array();
  $item = $this->Sales_model->search('table_item', $condition, array('id', 'item_name'), $search);
  // print_r($items);

  $i = 0;
  if ($item) {
    $data['status_no'] = 1;
    $data['message'] = 'Item Found';
  // $items['status_no'] = 1;
  }
  foreach ($item as $key => $value) {

                    // $itemPriceValue = DB::table('sale_prices')->where(['stock_id'=>$value->stock_id,'sales_type_id'=>$request['salesTypeId']])->select('price')->first();
                    // if(!isset($itemPriceValue)){
                    //     $itemSalesPriceValue = 0;
                    // }
                    // else
                    //  {
                    //     $itemSalesPriceValue = $itemPriceValue->price;
                    //  }
    $return_arr[$i]['id'] = $value['id'];
    $return_arr[$i]['item_name'] = $value['item_name'];
                    // $return_arr[$i]['description'] = $value->description;
                    // $return_arr[$i]['units'] = $value->units;
                    // $return_arr[$i]['price'] = $itemSalesPriceValue;
                    // $return_arr[$i]['tax_rate'] = $value->tax_rate;
                    // $return_arr[$i]['tax_id'] = $value->tax_id;
    $i++;
  }
               // echo json_encode($return_arr);
  $data['items'] = $return_arr;

  echo json_encode($data);
  // echo json_encode($items);

}

function sales_invoice_view($invoice_id)
{
  $data['title']='invoice_view';
  $f_id = $this->session->f_id;
  $condition = array('invoice_id' => $invoice_id, 'f_id' => $f_id);
  $data['invoice'] = $this->Sales_model->select('table_invoices', $condition, array('*'));
  $data['invoice_particular'] = $this->Sales_model->select('table_master_invoice', $condition, array('*'));
  $data['payment'] = $this->Sales_model->select('table_payment_details', $condition, array('*'));
  $data['payment_type'] = $this->Sales_model->select('table_payment_type',null, array('*'));

// echo '<pre>'; 
  // print_r($data);die;
  $data['_view'] = 'invoice_view';
  $this->load->view('index', $data);
}
function sales_order_view($order_id)
{
  $data['title']='Sales order_detail';
  $f_id = $this->session->f_id;
    // echo $f_id;
  $condition = array('order_id'=>$order_id,'f_id' => $f_id);
  $data['invoice'] = $this->Sales_model->select('table_invoices',$condition,array('*'));
  // print_r($data['invoice']);die;
  $invoiceParams=array('invoice_id' =>$data['invoice'][0]['invoice_id'],'f_id' => $f_id);
     // print_r($data['invoice']);
  $data['invoice_particular'] = $this->Sales_model->select('table_master_invoice', $invoiceParams, array('*'));
  $data['payment'] = $this->Sales_model->select('table_payment_details', $invoiceParams, array('*'));

  $data['_view'] = 'sales_order_view';
  $this->load->view('index', $data);
      // $data['payment'] = $this->Sales_model->select('table_payment_details', $condition, array('*'));

} 
function payment_status()
{
  $payment_id= modules::run('account/account/get_payment_id');
  $f_id = $this->session->f_id;
  $staff_id = $this->session->staff_id;
  $invoice_id = trim($this->input->post('invoice_id',1));
  $payment_type = $this->input->post('payment_type',1);
  $paid = $this->input->post('pay',1);
  $order_reference = $this->input->post('order_id',1);
  $customer_id = $this->input->post('customer_id',1);
  $payment_date = date('Y-m-d H-i-s');
    // print_r($customer_id);die;
  $params = array(
    'f_id' => $f_id,
    'invoice_id' => $invoice_id,
    'staff_id' => $staff_id,
    'payment_method' => $payment_type,
    'amount' => $paid,
    'order_reference' => $order_reference,
    'payment_date' => $payment_date,
    'customer_id'=>$customer_id,
    'payment_id'=>$payment_id


  );
  $payment_reference_id=$this->Sales_model->insert('table_payment_details', $params); 

##update invoice paid column
  $invoiceCondition=array(
    'invoice_id'=>$invoice_id,
    'f_id'=>$f_id
  );
  $invoiceParams=array(
    'paid'=>$paid
  );
// $this->Sales_model->update_col('table_invoices',$invoiceCondition,$invoiceParams); 
  $this->load->model('Account/Account_model');
  $this->Account_model->maintain_status_invoice($paid, $f_id, $invoice_id);

  $payment_id= modules::run('account/account/get_payment_id');
  $accountTransaction= array(
    'reference_id'=>$payment_reference_id,
    'reference_type'=>2,
    'credit'=> $paid,
    'f_id'=>$f_id,
    'reciept_id'=>$payment_id,
    'customer_id'=>$customer_id,
                  // 'caf_id'=>$params[0]['id'],
    'created_at'=>date('Y-m-d H-i-s')

  );
     ##generate Payment id
  $this->Account_model->insert('table_account_transaction',$accountTransaction);
  $this->session->alerts = array(
    'severity' => 'success',
    'title' => 'successfully Paid'
  );
  redirect('sales/sales_invoice_view/'.$invoice_id.'');
}


function reciept_view($payment_id)
{

 $f_id = $this->session->f_id;
 $data['_view'] = 'reciept_view';
 $params=array('payment_details.f_id'=>$f_id,'payment_details.payment_id'=>$payment_id);
 $data=$this->Sales_model->select_payment_details('table_payment_details',$params,array('payment_details.invoice_id','name','email','mobile','company_name','f_mobile','f_email','f_logo','address','f_address','f_city','f_pincode','payment_details.amount','payment_date','payment_method','c_pincode','c_city')); 
   // print_r($data);die;
 $data['_view'] = 'reciept_view2';
 $this->load->view('reciept_view2', $data);

}

function sale_service()
{
  $f_id = $this->session->f_id;
  $condition = array('f_id' => $f_id);
  $data['service']=$this->Sales_model->select('table_services',$condition,array('*'));
  $data['_view'] = 'sales_service';
  $this->load->view('index', $data);
}


function payment_list()
{
  $data['heading']='PAYMENT LIST';
  $f_id=$this->session->f_id;
  if($_SERVER['REQUEST_METHOD'] == 'POST' )
  {
   $this->load->helper('user_helper');
   $date_range = explode(' - ',$this->input->post('date_range'));
   $start_date = date_change_db($date_range[0]);


   $end_date = date_change_db($date_range[1]);
    // }

   $condition=array(

    't1.f_id'=>$f_id,

  );
  // var_dump($ledgerParam);
  // die;
   $data['payment'] = $this->Sales_model->payment_report('table_payment_details',array('t1.payment_id','t1.payment_date','t1.invoice_id_json','t1.amount','t1.payment_date','t1.payment_method','t2.name as customer_name'),$condition,$start_date,$end_date,$status='','payment_date');

 }
 else
 {
  $status=trim($this->input->get('status',1));
  switch($status)
  {
    #today payment
    case 1:
    $condition=array('f_id'=>$f_id,'date(payment_date)'=>date('Y-m-d'));
    $data['payment'] = $this->Sales_model->select('table_payment_details', $condition, array('*'));
    break;
            ##yesterday
    case 2:
    $condition=array('f_id'=>$f_id,'date(payment_date)'=>date('Y-m-d',strtotime("-1 days")));
    $data['payment'] = $this->Sales_model->select('table_payment_details', $condition, array('*'));
    break;
             ##1 week
    case 3:
    $condition=array('f_id'=>$f_id);
    $table_row="payment_date";
    $data['payment'] = $this->Sales_model->data_between_date('table_payment_details',array('*'),$condition,'INTERVAL 6 DAY',$table_row);
    break;

              ##last one month
    case 4:
    $condition=array('f_id'=>$f_id);
    $table_row="payment_date";
    $data['payment'] = $this->Sales_model->data_between_date('table_payment_details',array('*'),$condition,'INTERVAL 1 MONTH',$table_row);
    break;
              ##this month
    case 5:
    $condition=array('f_id'=>$f_id);
    $table_row="payment_date";
    $data['payment'] = $this->Sales_model->data_current('table_payment_details',array('*'),$condition,"'%y-%m-01'",$table_row);
    break;
              ##this year
    case 6:
    $condition=array('f_id'=>$f_id);
    $table_row="payment_date";
    $data['payment'] = $this->Sales_model->data_current('table_payment_details',array('*'),$condition,"'%y-01 -01'",$table_row);
    break;

    default:
    {
      $condition=array('f_id'=>$f_id);
      $data['payment'] = $this->Sales_model->select('table_payment_details', $condition, array('*'));

    }
  }
}
// $this->output->enable_profiler(TRUE);
$data['_view'] = 'payment_list';
$this->load->view('index', $data);
}





// function sales_order_by_quotation()
// {


//   $f_id=$this->session->f_id;
// $condition=array('f_id'=>$f_id,'id'=>$id);
// $detailsCondition=array('f_id'=>$f_id,'quo_id'=>$id);
// $quotation= $this->Quotation_model->select('table_quotation',$condition,array('*'));
// $q_result=$quotation[0];
// $quotation_details= $this->Quotation_model->select('table_quotation_details',$detailsCondition,array('*'));


//  $orderParams = array('f_id' => $f_id);
//     $order_no = $this->Sales_model->get_max_order_no('table_sales', $orderParams);
//     if (!$order_no) {
//       $order_no = 1;
//     }

//     $itemCount = count($item_id);

//     $date = date('Y-m-d H:i:s');


//     $params = array('customer_name' => $q_result['c_name'], 'customer_id' => 43, 'mobile' => $q_result['c_mobile'], 'email' => $q_result['c_email'],, 'f_id' => $f_id, 'created_by' => $staff_id, 'created_at' => $date, 'total' => $q_result['grand_total'], 'order_id' => $order_no);
//  // print_r($params);die;
//     $addSales = $this->Sales_model->insert('table_sales', $params);
// #update stock
//     for ($i = 0; $i < count($item_id); $i++) { 
//       # code...

//       $condition = array('id' => $item_id[$i]);
//       ##fetch item quantity 
//       $quantity=$this->Sales_model->select('table_purchase',$condition,array('quantity_for_sale','purchase_price','item_id'));
//       $reamaning_item=$quantity[0]['quantity_for_sale']-$qty[$i];
//       $quantity_out=$quantity[0]['quantity_out'];
//       ##update how much quantity out and how much reamaning for sales
//       $quantity_out_update = $quantity[0]['quantity_out']+$qty[$i];
//       $itemParams = array('quantity_for_sale' => $reamaning_item,'quantity_out'=>$quantity_out_update);
//       $this->Sales_model->update_col('table_purchase', $condition, $itemParams);

//     ##inserts sale details
//       $saleDetailsParam = array(
//         'particular' => $item_id[$i],
//         'price' => $amount[$i],
//         'f_id' => $f_id,
//         'quantity'=>$qty[$i],
//         'order_no' => $order_no,
//         'created_at' =>$date,
//         'discount_percent'=>$discount[$i]
//       );
//       $addSalesDetails = $this->Sales_model->insert('table_sales_details', $saleDetailsParam);

//       ##for profit loss graph

//       $profitLossParam=array(
//         'item_purchase_id'=>$item_id[$i],
//         'item_id'=>$quantity[0]['item_id'],
//         'purchase_price'=>$quantity[0]['purchase_price'],
//         'selling_price'=>round($amount[$i]/$qty[$i]),
//         'qty'=>$qty[$i],
//         'created_at'=>$date,
//         'f_id'=>$f_id


//       );
//        $addGraphDetails = $this->Sales_model->insert('table_item_graph',$profitLossParam);
//       /*end profit loss graph*/

//     }
//     $particularParam = array(
//       'particular' => $quotation_details,
//       'price' => $amount,
//       'quantity'=>$qty,
//       'unit'=>$unit
//     );
//     // print_r($particularParam);die;
//     $invoiceParams = array(
//       'customer_name' => $customer_name, 'mobile' => $mobile, 'email' => $email, 'f_id' => $f_id, 'created_by' => $staff_id, 'created_at' => $date, 'order_id' => $order_no, 'customer_id' => $customer_id,'c_city'=>$city,'c_pincode'=>$pincode,'address'=>$address

//     );
//     $invoice_id = modules::run('account/account/invoice', $invoiceParams, $particularParam);
//   ## paid amount
//     $paid_amount= $this->input->post('paid_amount');
//     if ($paid_amount > 0) 
//     {
//         ##generate Payment id
//       $payment_id= modules::run('account/account/get_payment_id');
//       $paidParams = array
//       (
//         'f_id' => $f_id,
//         'payment_id'=>$payment_id,
//         'invoice_id' => $invoice_id,
//         'staff_id' => $staff_id,
//         'customer_id' => $customer_id,
//         'payment_method' => $method,
//         'amount' => $paid_amount,
//         'order_reference' => $order_no,
//         'payment_date' => date('Y-m-d H-i-s')


//       );

//       $payment_reference_id=$this->Sales_model->insert('table_payment_details', $paidParams);
//       $invoiceCondition=array(
//         'invoice_id'=>$invoice_id,
//         'f_id'=>$f_id
//       );
//       $invoicePaidParams=array(
//         'paid'=>$paid_amount
//       );
//       $this->Sales_model->update_col('table_invoices',$invoiceCondition,$invoicePaidParams); 
//       $this->load->model('Account/Account_model');
//       $this->Account_model->maintain_status_invoice($paid_amount,$f_id,$invoice_id);
//       $accountTransaction=array(
//         'reference_id'=>$payment_reference_id,
//         'reference_type'=>2,
//         'credit'=>$paid_amount,
//         'f_id'=>$f_id,
//         'reciept_id'=>$payment_id,
//         'customer_id'=>$customer_id,
//                   // 'caf_id'=>$params[0]['id'],
//         'created_at'=>date('Y-m-d H-i-s')

//       );
//       $this->Account_model->insert('table_account_transaction',$accountTransaction);

//     }

//     $this->session->alerts = array(
//       'severity' => 'success',
//       'title' => 'successfully added'
//     );
//     redirect('sales/sales_list');



function invoice_list()
{
  $f_id=$this->session->f_id;
  if($this->input->get('status')=='pending')
  {
    $invoiceParam=array(
      'f_id'=>$f_id,
      'status!='=>'paid'
    );  
    $invoice_list=$this->Sales_model->select('table_invoices',$invoiceParam,array('id','name','mobile','email','amount','paid','status','invoice_id','created_at','total','customer_id'));
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
   $invoice_list= $this->Sales_model->report('table_invoices',array('*'),$condition,$start_date,$end_date,$status='');

 }
 else
 {
  $invoiceParam=array(
    'f_id'=>$f_id

  );
  $invoice_list=$this->Sales_model->select('table_invoices',$invoiceParam,array('id','name','mobile','email','amount','paid','status','invoice_id','created_at','total','customer_id'));

}

$data['invoice']=$invoice_list;
$data['heading']='INVOICE LIST';
$data['_view'] = 'invoice_list';

$this->load->view('index.php',$data);



}






function invoice_due_notification()
{
  $f_id=$this->session->f_id;
  $data['invoice']=[];
  $today_date=date_create(date('Y-m-d'));
  $condition=array('f_id'=>$f_id);
  ##fetch seller invoice due day
  $setting_data=$this->Sales_model->select_id('table_seller_setting',$condition,array('invoice_due_day'));
  $invoice_due_day=$setting_data['invoice_due_day'];
  // print_r($invoice_due_day);die;
  $invoiceCondition=array('f_id'=>$f_id,'status!='=>'paid');
  $result=$this->Sales_model->select('table_invoices',$invoiceCondition,array('*'));
  for($i=0;$i<count($result);$i++)
  {
    $date1=date_create($result[$i]['created_at']);
    $diff=date_diff($date1,$today_date);
    $difference=$diff->format("%a");
    // echo $difference;
    if($difference>$invoice_due_day)
    {
      array_push($data['invoice'],$result[$i]);
    }
  }
  // echo '<pre>';
// print_r($invoice);
  $data['_view'] = 'invoice_due_list';

  $this->load->view('index.php',$data);

}

function profit_graph()
{

 $f_id=$this->session->f_id;
 $condition=array('f_id'=>$f_id);
 $sales_sum=$this->Sales_model->data_between_date('table_sales_details',array("sum(price-(quantity*purchase_price)) as 'profit'","sum(price) as sales","MONTHNAME(created_at) as month"),$condition,'','',$group_by='MONTH',$order_by='MONTH');
  // echo '<pre>';
  // print_r($sales_sum);
 echo json_encode($sales_sum);

}


function fetch_serial_no_item_wise()
{
$item_id=$this->input->post('item_id',1);
 $f_id=$this->session->f_id;
 $condition=array('t1.f_id'=>$f_id,'t2.purchase_status'=>'approved','t1.item_id'=>$item_id,'t1.sale_status'=>0);
     $serial_no= $this->Sales_model->fetchSerialNoItem('table_purchase_details_batch_wise',$condition,array('serial_no'));

     // print_r($serial_no);
     echo json_encode($serial_no);
}





function profit_graph_show()
{

 $data['_view'] = 'profit_graph';
 $this->load->view('index.php',$data);
}


## reciept 

function reciept()
{
  $data['title']='reciept add';
  $data['_view'] = 'add_reciept';
  $this->load->view('index.php',$data);

}

function add_reciept()
{
  // print_r($this->input->post());die;
 $f_id=$this->session->f_id;
 $staff_id=$this->session->staff_id;
 $customer_id=trim($this->input->post('customer_id',1));
 $invoice_id=$this->input->post('invoice_id',1);
 $order_no=trim($this->input->post('order_id',1));
 $paid_amount=trim($this->input->post('paid',1));
 $method=trim($this->input->post('method',1));

 $payment_id= modules::run('account/account/get_payment_id');
 $paidParams = array
 (
  'f_id' => $f_id,
  'payment_id'=>$payment_id,
  'invoice_id' => $invoice_id,
  'staff_id' => $staff_id,
  'customer_id' => $customer_id,
  'payment_method' => $method,
  'amount' => $paid_amount,
  'order_reference' => $order_no,
  'payment_date' => date('Y-m-d H-i-s')


);

 $payment_reference_id=$this->Sales_model->insert('table_payment_details', $paidParams);
 $invoiceCondition=array(
  'invoice_id'=>$invoice_id,
  'f_id'=>$f_id
);
 $invoicePaidParams=array(
  'paid'=>$paid_amount
);
 $this->Sales_model->update_col('table_invoices',$invoiceCondition,$invoicePaidParams); 
 $this->load->model('Account/Account_model');
 $this->Account_model->maintain_status_invoice($paid_amount,$f_id,$invoice_id);
 $accountTransaction=array(
  'reference_id'=>$payment_reference_id,
  'reference_type'=>2,
  'credit'=>$paid_amount,
  'f_id'=>$f_id,
  'reciept_id'=>$payment_id,
  'customer_id'=>$customer_id,
                  // 'caf_id'=>$params[0]['id'],
  'created_at'=>date('Y-m-d H-i-s')

);
 $this->Account_model->insert('table_account_transaction',$accountTransaction);



}

function reciept_pay()

{
  // echo '<pre>';
  // print_r($this->input->post());
  // die;
 
  $this->load->library('form_validation');
  $this->form_validation->set_rules('customer_id', 'selection of customer', 'required|trim');
  $this->form_validation->set_rules('method', 'Mehod', 'required');
// echo $opening_stock*$stock_value;die;
  $this->form_validation->set_rules('total_amount','Total Amount', 'required');
  // $this->form_validation->set_rules('opening_stock', 'opening_stock', 'required');
 // print_r($this->input->post());die;
  if ($this->form_validation->run()) {

    $f_id=$this->session->f_id;
    $staff_id=$this->session->staff_id;
    $customer_id=trim($this->input->post('customer_id',1));
    $order_no=trim($this->input->post('order_id',1));
    $method=trim($this->input->post('method',1));
    $total_amount=$this->input->post('total_amount',1);
 ##in form of array
    $invoice_id=$this->input->post('invoice_id',1);
    $paid_amount=$this->input->post('invoice_payment',1);
    $initial_balance_paid=$this->input->post('initial_balance_payment',1);
    if($initial_balance_paid>0)
    {
    $initialBalanceCondition=array(
      'f_id'=>$f_id,
      'id'=>$customer_id,
    );

      ##fetch previous paid balance for updation 

    $paidBalance=$this->Sales_model->select_id('table_crn',$initialBalanceCondition,array('paid'));

          $newPaidbalance=$paidBalance['paid']+$initial_balance_paid;

          $this->Sales_model->update_col('table_crn',$initialBalanceCondition,array('paid'=>$newPaidbalance));
          $this->Sales_model->initial_balance_status('table_crn',$customer_id,$f_id);




    }
    $invoice_count=count($invoice_id);

    $invoices=array();
    for ($j=0; $j <$invoice_count ; $j++) { 
   # code...
      if($paid_amount[$j]>0)
      {
        array_push($invoices,$invoice_id[$j]);
      }

    }
 // print_r($invoices);
    $payment_id= modules::run('account/account/get_payment_id');

    $paidParams = array
    (
      'f_id' => $f_id,
      'payment_id'=>$payment_id,
      'invoice_id_json' => json_encode($invoices),
      'invoice_id'=>$invoice_id[0],
      'staff_id' => $staff_id,
      'customer_id' => $customer_id,
      'payment_method' => $method,
      'amount' => $total_amount,

      'payment_date' => date('Y-m-d H-i-s')


    );
      // print_r($paidParams);die;
 $payment_reference_id=$this->Sales_model->insert('table_payment_details', $paidParams);
    for($i=0;$i<$invoice_count;$i++)
    {

     if($paid_amount[$i]>0)
     {
      $invoiceCondition=array(
        'invoice_id'=>$invoice_id[$i],
        'f_id'=>$f_id
      );
      $invoicePaidParams=array(
        'paid'=>$paid_amount[$i]
      );
      $this->Sales_model->update_col('table_invoices',$invoiceCondition,$invoicePaidParams); 
      $this->load->model('Account/Account_model');
      $this->Account_model->maintain_status_invoice($paid_amount[$i],$f_id,$invoice_id[$i]);
    }
  }
  $accountTransaction=array(
    'reference_id'=>$payment_reference_id,
    'reference_type'=>2,
    'debit'=>$total_amount,
    'f_id'=>$f_id,
    'reciept_id'=>$payment_id,
    'customer_id'=>$customer_id,
    'ledger_group'=>10, ##temporary  cash
    'double_entry'=>1,
    'created_at'=>date('Y-m-d')

  );
   $accountTransactionDouble=array(

    'reference_id'=>$payment_reference_id,
    'reference_type'=>2,
    'credit'=>$total_amount,
    'f_id'=>$f_id,
    'reciept_id'=>$payment_id,
    'customer_id'=>$customer_id,
    'ledger_group'=>6, ##sundry debitors
                  
    'created_at'=>date('Y-m-d')

  );

  $this->Account_model->insert('table_account_transaction',$accountTransactionDouble);
  $this->Account_model->insert('table_account_transaction',$accountTransaction);
  $this->session->alerts = array(
      'severity' => 'success',
      'title' => 'successfully added'
    );
    redirect('sales/payment_list');
}
else
{
  $this->reciept();
}
}
// }




/*all function end*/
}
?>	