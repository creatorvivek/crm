<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Item extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Item_model');
  }





  function add_item()
  {
    // echo "hii";
    $f_id = $this->session->f_id;
    $data['title'] = 'ADD ITEM';

    $params = array('f_id' => $f_id);
    $this->load->model('category/Category_model');
    // $category = $this->Category_model->select('table_category', $params, array('category_id', 'name'));
    $category=modules::run('category/category/call');
    // print_r($category);die;
    $f_id = $this->session->f_id;
    $condition = array('f_id' => $f_id,'status'=>1);
    $data['measurement_unit'] = $this->Item_model->select('table_measurement_unit', $condition, array('id','symbol'));
// var_dump($category);die;
    $data['category'] = $category;
    $data['heading'] = 'ADD ITEM';
    $data['_view'] = 'add_item';
    $this->load->view('index', $data);
  }
  ##add item form processing
  function add_item_process()
  {

   $f_id = $this->session->f_id;
   $staff_id = $this->session->staff_id;

   $item_name = strip_tags($this->input->post('name', 1));
   $description = strip_tags($this->input->post('description', 1));
   $item_category = strip_tags($this->input->post('category_id', 1));
   $selling_price = strip_tags($this->input->post('selling_price', 1));
   $measurement_unit = strip_tags($this->input->post('unit', 1));
   $company_name = strip_tags($this->input->post('company_name', 1));
   $hsn = strip_tags($this->input->post('hsn', 1));
   $opening_stock = strip_tags($this->input->post('opening_stock', 1));
   $stock_value = strip_tags($this->input->post('stock_value', 1));
   $this->load->library('form_validation');
   $this->form_validation->set_rules('name', 'Item Name', 'required|trim');
   $this->form_validation->set_rules('description', 'description', 'required|trim');
   $this->form_validation->set_rules('company_name', 'description', 'required|trim');
   $this->form_validation->set_rules('category_id', 'Category', 'required');

   $this->form_validation->set_rules('unit', 'measurement unit', 'required');
##  backend validation if checked in opening stock
   if($opening_stock>0)
   {
     $this->form_validation->set_rules('opening_stock', 'Opening_stock', 'required');
     $this->form_validation->set_rules('stock_value', 'Stock Value', 'required');
   }

   if ($this->form_validation->run()) {


    $itemParams = array(

      'item_name' =>$item_name,
      'description' => $description,
      'category' => $item_category,
      'selling_price'=>$selling_price,
      'f_id' => $f_id,
      'hsn'=>$hsn,  
      'measurement_unit'=>$measurement_unit,
      'company_name'=> $company_name,


      'created_at' => date('Y-m-d H-i-s'),
      'created_by' => $staff_id

    );
    $insertItemId = $this->Item_model->insert('table_item', $itemParams);

##opening balance
    if(!$opening_stock)
    {
      $opening_stock=0;
    }
    $stockParams=array(

      'item_id'=>$insertItemId,
      'opening_balance'=>$opening_stock,
      'qty_in_hand'=>$opening_stock,
      'f_id'=>$f_id


    );
    $insertStockDetils=$this->Item_model->insert('table_item_stock', $stockParams);
    ## account transaction maintain
    if($opening_stock>0)
    {

      $total_stock_value= $opening_stock*$stock_value;
      $account_transaction=array(
        'debit'=>$total_stock_value,
              ##for opening balance
        'reference_type'=>6,
        'ledger_group'=>9,
        ##9 means stock in HAND

        'f_id'=>$f_id,
        'created_at'=>date('Y-m-d')
      );
      $account_transactionDouble=array(
        'credit'=>$total_stock_value,
              ##for opening balance
        'reference_type'=>6,
        'ledger_group'=>22,
        ##22 opening balance adjustment
        'double_entry'=>1,
        'f_id'=>$f_id,
        'created_at'=>date('Y-m-d')
      );
      $transaction_insert= $this->Item_model->insert('table_account_transaction',$account_transaction);
      $transaction_insert= $this->Item_model->insert('table_account_transaction',$account_transactionDouble);
    }

    if ($insertStockDetils) {
      $this->session->alerts = array(
        'severity' => 'success',
        'title' => 'successfully added'
      );
      redirect('item/item_list');
    }


  }
  else
  {
    $this->add_item();
  }
}
function item_list()
{

  /*future use*/
  $data['title'] = 'ITEM LIST';
  $f_id = $this->session->f_id;
  $staff_id = $this->session->staff_id;
  $params = array('t1.f_id' => $f_id);
  $itemList = $this->Item_model->stock_list('table_item', $params, array('t1.id', 't1.item_name', 't1.description', 't1.created_at', 'category', 't2.name as staff_name','t1.hsn','t3.qty_in_hand','t3.qty_sale','t3.qty_purchase','t1.measurement_unit as unit','t1.company_name'));
    // print_r($itemList);die;
   // echo '<pre>';
  $categoryParam = array('f_id' => $f_id);
  $this->load->model('category/Category_model');
  $category = $this->Category_model->select('table_category', $categoryParam, array('category_id', 'name'));
  $data['category'] = $category;
  // $this->output->enable_profiler(TRUE);
   // die;
  $data['heading'] = 'ITEM LIST';
  $data['item'] = $itemList;
  $data['_view'] = 'item_list';
  $this->load->view('index', $data);


}




  ##item stock by item id
// function item_stock($item_id='')
// {
//  $f_id = $this->session->f_id;
//  $condition=array('f_id'=>$f_id,'item_id'=>$item_id);
//     // echo '2';
//  $item_count=$this->Item_model->sum_column('table_purchase_details',$condition,'qty');
//  print_r($item_count);

// }


function add_more_qty($id)
{   
    // $item_id= $this->input->post('item_id', 1); 
 $qty =   strip_tags($this->input->post('newqty', 1));
 $purchase_price = strip_tags($this->input->post('purchase_amount', 1));
 $total=$qty*$purchase_price;
 $condition = array('id' => $id,'f_id'=>$this->session->f_id);
      ##fetch item detail by item id
 $item = $this->Item_model->select('table_item', $condition, array('id', 'total_purchase_price','quantity'));
 if($item)
 {
  $total_purchase_price=$item[0]['total_purchase_price'];
  $quantity=$item[0]['quantity'];
  $newQuantity=$qty+$quantity;
  $newTotalPurchasePrice=$total_purchase_price+$total;
  $paramsItem=array('total_purchase_price'=>$newTotalPurchasePrice,'quantity'=>$newQuantity);
  $result=$this->Item_model->update_col('table_item',$condition,$paramsItem);
  if($result)
  {
   $this->session->alerts = array(
    'severity' => 'success',
    'title' => 'successfully quantity adjusted'
  );
 }
 redirect('item/item_list');


}



}
function add_more_item($id)
{ 
  $data['id']=$id;
  $condition=array('id'=>$id,'f_id'=>$this->session->f_id);
  $item = $this->Item_model->select('table_item', $condition, array('id', 'purchase_price','quantity'));
    // print_r($item);
  if($item[0])
  {
    $data['quantity']=$item[0]['quantity'];
    $data['purchase_price']=$item[0]['purchase_price'];
  }
  else
  {
    $data['quantity']='';
    $data['purchase_price']='';
  }

  $data['_view'] = 'add_qty';
  $this->load->view('index', $data);
}
## item add





## ajax call fetch selling amount and all details of item
function fetch_amount()
{
  $item_id = $this->input->post('item_id');
  $f_id = $this->session->f_id;
  // $params = array();
  // $item = $this->Item_model->fetch_item_details('table_item', $params, array('purchase_item.id', 'selling_price', 'item_name','quantity_for_sale','unit'));
   // print_r($item);
  $params = array('t1.f_id' =>$f_id,'t1.id' => $item_id);
  // $params = array('t1.f_id' =>$f_id);
  $item = $this->Item_model->fetch_item_details('table_item',$params, array('t1.id','t1.item_name','t1.description','t1.selling_price','t2.qty_in_hand','t1.measurement_unit as unit'));
  echo json_encode($item);



}

// function fetch_item()
// {
//   $f_id = $this->session->f_id;
//   $params = array('f_id' => $f_id, 'quantity>=' => 1);
//   $item = $this->Item_model->select('table_item', $params, array('id', 'item_name', 'description', 'selling_price', 'purchase_price', 'model_no', 'serial_no', 'created_by', 'created_at','quantity_for_sale'));
//   echo json_encode($item);
// }


function edit_item($id)
{
  $data['title'] = "EDIT ITEM";
  $data['heading'] = "EDIT ITEM";
  $f_id = $this->session->f_id;

  $condition = array('id' => $id, 'f_id' => $f_id);
  $this->load->model('category/Category_model');
  $catParams = array('f_id' => $f_id);
  $category = $this->Category_model->select('table_category', $catParams, array('category_id', 'name'));

  $data['category'] = $category;
  $data['item'] = $this->Item_model->select_id('table_item', $condition, array('id', 'selling_price', 'item_name','category','company_name','hsn','measurement_unit','description'));

  $data['measurement_unit'] = $this->Item_model->select('table_measurement_unit', array('f_id'=>$f_id), array('id','symbol'));



  if (isset($data['item']['id'])) {
    $this->load->library('form_validation');


    $this->form_validation->set_rules('name', 'Item Name', 'required|trim');
    $this->form_validation->set_rules('description', 'description', 'required|trim');
    $this->form_validation->set_rules('company_name', 'description', 'required|trim');
    $this->form_validation->set_rules('category_id', 'Category', 'required');
    $this->form_validation->set_rules('unit', 'measurement unit', 'required');

    $item_name = strip_tags($this->input->post('name', 1));
    $description = strip_tags($this->input->post('description', 1));
    $item_category = strip_tags($this->input->post('category_id', 1));
    $selling_price = strip_tags($this->input->post('selling_price', 1));
    $measurement_unit = strip_tags($this->input->post('unit', 1));
    $company_name = strip_tags($this->input->post('company_name', 1));
    $hsn = strip_tags($this->input->post('hsn', 1));
    if ($this->form_validation->run()) {

      $staff_id = $this->session->staff_id;

      $itemParams = array(

        'item_name' =>$item_name,
        'description' => $description,
        'category' => $item_category,
        'selling_price'=>$selling_price,
        'hsn'=>$hsn,  
        'measurement_unit'=>$measurement_unit,
        'company_name'=> $company_name

      );
     // print_r($itemParams);
      $this->Item_model->update_col('table_item',$condition,$itemParams);



      $this->session->alerts = array(
        'severity' => 'success',
        'title' => 'successfully updated'
      );
      redirect('item/item_list');
    } else {
      $data['_view'] = 'edit_item';
      $this->load->view('index', $data);
    }
  } else
  show_error('The item you are trying to edit does not exist.');
}


/*function search()
{
  $search = $this->input->post('search'); 
 // $search=$this->uri->segment(3);
  $condition = array('f_id' => $this->session->f_id);
  $data = array();
  $data['status_no'] = 0;
  $data['message'] = 'No Item Found!';
  $data['items'] = array();
  $item = $this->Item_model->search('table_item', $condition, array('id', 'item_name'), $search);
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

}*/


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
  $this->Item_model->insert('table_payment_details', $params); 

##update invoice paid column
  $invoiceCondition=array(
    'invoice_id'=>$invoice_id,
    'f_id'=>$f_id
  );
  $invoiceParams=array(
    'paid'=>$paid
  );
  $this->Item_model->update_col('table_invoices',$invoiceCondition,$invoiceParams); 
  $this->load->model('Account/Account_model');
  $this->Account_model->maintain_status_invoice($paid, $f_id, $invoice_id);
  $this->session->alerts = array(
    'severity' => 'success',
    'title' => 'successfully Paid'
  );


  redirect('item/sales_order_view/2');
}



function measurement_unit()
{
 $f_id = $this->session->f_id;
 $condition = array('f_id' => $f_id,'status'=>1);
 $data['unit'] = $this->Item_model->select('table_measurement_unit', $condition, array('id','name','symbol'));
 $data['_view'] = 'unit/measurement_unit';
 $this->load->view('index', $data);
}

function add_measurement_unit()
{
 $this->load->library('form_validation');

 $this->form_validation->set_rules('measurement_unit','measurement Unit Name','required|trim|alpha_numeric_spaces');
 $this->form_validation->set_rules('symbol','Symbol','required|trim|alpha_numeric_spaces');
 if($this->form_validation->run() )     
 {  
   $name = strip_tags($this->input->post('measurement_unit',1));
   $symbol = strip_tags($this->input->post('symbol',1));

   $f_id=$this->session->f_id;

   $params=array(
    'name'=>$name,
    'created_at'=>date('Y-m-d'),
    'f_id'=>$f_id,
    'symbol'=>$symbol


  );

   $id=$this->Item_model->insert('table_measurement_unit',$params);

   $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully added'

  );
   redirect('item/measurement_unit');

 }
 else
 {
  $this->measurement_unit();
}

}


##ajax call
function fetch_item_detail()
{
  $f_id = $this->session->f_id;
  $item_id = $this->input->post('item_id');
  $params = array('f_id' =>$f_id,'id'=>$item_id);
  $item = $this->Item_model->select_id('table_item', $params, array('id','item_name','measurement_unit as unit'));
   // print_r($item);
  echo json_encode($item);

}
#ajax call
function fetch_order_item_details()
{
  $f_id = $this->session->f_id;
  $purchase_id = $this->input->post('purchase_id');
  $conditionParticular = array('t1.f_id' =>$f_id,'t1.purchase_id'=>$purchase_id);

  $data['purchase_particular']=$this->Item_model->fetch_purchase_order_details('table_purchase_details',$conditionParticular,array('t1.*','t3.item_name','measurement_unit' ));
  echo json_encode($data['purchase_particular']);


}

## particular item total details by item id
function fetch_item_total_detail($item_id='')
{

  $f_id = $this->session->f_id;
  $condiitonItem = array('t1.f_id' =>$f_id,'t1.id'=>$item_id);
  $data['item_details'] = $this->Item_model->fetch_item_details('table_item', $condiitonItem, array('t1.*','t3.name as staff_name','t2.*','t4.name as category_name'));
  $conditionPurchase= array('f_id' =>$f_id,'item_id'=>$item_id);
  $data['item_purchase'] = $this->Item_model->select('table_purchase_details', $conditionPurchase, array('*'));
  $conditionSale=array('f_id' =>$f_id,'particular'=>$item_id,'type'=>1);
  $data['item_sales'] = $this->Item_model->select('table_sales_details',$conditionSale, array('*'));
     // echo '<pre>';
     // print_r($data);
  $data['_view'] = 'item_full_details';
  $this->load->view('index.php',$data);




}

##ajax call by item details
function item_sale_graph()
{

  $id=trim($this->input->post('id'));
  $item_id=trim($this->input->post('item_id'));
  // $id=1;
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id,'particular'=>$item_id,'type'=>1);
  switch($id)
  {
    #last 6 days
    case 1:
    $duration='INTERVAL 6 DAY';
     // $data['purchase']=$this->Home_model->getSellPurchaseSum('table_item',$condition,array("DAYNAME(created_at) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='DAY',$order_by='DAY');
    $data['sell']=$this->Item_model->getSellPurchaseSum('table_sales_details',$condition,array("DAYNAME(created_at) as month","sum(price) as sell_price","count(id) as count"),$duration,$group_by='DAY',$order_by='DAY');
   // echo $id;
    break;
    #last 1 month
    case 2:
    $duration='INTERVAL 1 MONTH';
    // $data['purchase']=$this->Item_model->getSellPurchaseSum('table_item',$condition,array("DATE(created_at) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
    $data['sell']=$this->Item_model->getSellPurchaseSum('table_sales_details',$condition,array("DATE(created_at) as month","sum(price) as sell_price","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
    break;
    ## this month
    case 3:
    $duration='%y-%m-01';
    // $data['purchase']=$this->Item_model->getSellPurchaseSumCurrent('table_item',$condition,array("DATE(created_at) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
    $data['sell']=$this->Item_model->getSellPurchaseSumCurrent('table_sales_details',$condition,array("DATE(created_at) as month","sum(price) as sell_price","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
    break;
    ##this year
    case 4:
    $duration='%y-01-01';
    // $data['purchase']=$this->Item_model->getSellPurchaseSumCurrent('table_item',$condition,array("MONTHNAME(created_at) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='MONTH',$order_by='MONTH');
    $data['sell']=$this->Item_model->getSellPurchaseSumCurrent('table_sales_details',$condition,array("MONTHNAME(created_at) as month","sum(price) as sell_price","count(id) as count"),$duration,$group_by='MONTH',$order_by='MONTH');
    break;
    default:
    {
       // $data['purchase']=$this->Item_model->getSellPurchaseSum('table_item',$condition,array("MONTHNAME(created_at) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration=null);
     $data['sell']=$this->Item_model->getSellPurchaseSum('table_sales_details',$condition,array("MONTHNAME(created_at) as month","sum(price) as sell_price","count(id) as count"),$duration=null);
     break;
  // print_r($data['purchase']);/
   }      

 }
    // $this->output->enable_profiler(TRUE);
 
 echo json_encode($data);



}

function item_adjustment()
{

  $data['_view'] = 'item_adjustment';
  $this->load->view('index.php',$data);
}


function item_adjustment_process()
{
  $reason=$this->input->post('reason',1);
  $description=$this->input->post('description',1);
  $date=$this->input->post('date');
  $staff_id=$this->session->staff_id;
  $f_id=$this->session->f_id;

##data in array
  $item_id=$this->input->post('item_id');
  $quantity_adjusted=$this->input->post('quantity_adjusted');
  
  $item_adjusment_param=array('employee_id'=>$staff_id,'description'=>$description,'date'=>$date,'reason'=>$reason);

  $item_adjustment_id=$this->Item_model->insert('table_item_adjustment',$item_adjusment_param);


  $item_count=count($item_id);

  for($i=0;$i<$item_count;$i++)
  {
  ##fetch qty in hand 
    $conditionStock=array('f_id'=>$f_id,'item_id'=>$item_id[$i]);
    $qtyHand=$this->Item_model->select_id('table_item_stock',$conditionStock,array('qty_in_hand'));
    $newQuantity= $quantity_adjusted[$i]+ $qtyHand['qty_in_hand'];
  ##update item stock in table
    $itemUpdateCondition=array('item_id'=>$item_id[$i]);
    $itemParam=array('qty_in_hand'=>$newQuantity);
    $this->Item_model->update_col('table_item_adjustment_details',$item_adjustment_details,$itemParam);
    $item_adjustment_details=array
    (
      'adjust_id'=>$item_adjustment_id,
      'item_id'=>$item_id[$i],
      'quantity_adjusted'=>$quantity_adjusted[$i]

    );

    $item_adjustment_id=$this->Item_model->insert('table_item_adjustment_details',$item_adjustment_details);





  }



}



/*all function end*/
}
?>	