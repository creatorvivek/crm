<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Sales_model extends MY_Model{
  function __construct(){
    parent::__construct();
  }


  function  select_item($table_name,$condition,$content_display)
  {


    $this->db->select($content_display);
    $this->db->from(''.$this->$table_name.' as t1');
     // $this->db->order_by("DATE(purchase_item.created_at)", "inc");
    if(!is_null($condition))
      $this->db->where($condition);
    $this->db->join(''.$this->table_item_stock.' as t2','t2.item_id=t1.id');
    // $this->db->join(''.$this->table_purchase_details.' as t3','t3.item_id=t1.id and t3.f_id=t1.f_id');
    $data= $this->db->get()->result_array();
    if($data){

      return $data;
    }
    return array();		
    // return json_encode($returnData);
  }

  function sales_list($table_name,$condition,$content_display,$interval_unit='',$table_row='sales.created_at')
  {


    $this->db->select($content_display);
    $this->db->from($this->$table_name);
    if(!is_null($condition))
      $this->db->where($condition);
    $this->db->join($this->table_staff,''.$this->$table_name.'.created_by='.$this->table_staff.'.id');
  	// $this->db->join($this->table_item,''.$this->$table_name.'.item_id='.$this->table_item.'.id');
    if($interval_unit)
     $this->db->where(" DATE(".$table_row.") BETWEEN DATE_SUB( CURDATE( ),".$interval_unit." ) AND CURDATE()");
   $data= $this->db->get()->result_array();
   if($data){

    return $data;
  }
  return array();		
    // return json_encode($returnData);
}
function  sales_list_current($table_name,$display_contents,$condition,$interval_unit='',$table_row='sales.created_at',$start_date='',$end_date='')
{

  $this->db->select($display_contents);
  $this->db->from($this->$table_name);

  $this->db->where($condition);
 // if(!empty($start_date) && !empty($end_date))
  $this->db->join($this->table_staff,''.$this->$table_name.'.created_by='.$this->table_staff.'.id');
  if($interval_unit)
    $this->db->where(" DATE(".$table_row.") between  DATE_FORMAT(CURDATE() ,".$interval_unit.") AND CURDATE()");

  $data=$this->db->get()->result_array();
  return $data;

}
function search($table_name,$condition,$content_display,$search)
{
 $this->db->select($content_display);



 $this->db->from($this->$table_name);  
 
 $this->db->where($condition);

 $this->db->group_start();
 $this->db->where("item.item_name like '$search%' ");
               // $this->db->or_where("crn.name like '%search_query%' ");
 $this->db->or_where("item.serial_no like '$search%' ");

 $this->db->group_end();

 $data=$this->db->get()->result_array();
 $sql = $this->db->last_query();
 return $data;
}
function get_max_order_no($table_name,$params)
{

 $this->db->select_max('order_id');
 $this->db->from($this->$table_name);
 $this->db->where($params);       
 $id = $this->db->get()->row_array();
      // return json_encode($id);
 if(is_null($id['order_id']))
 {
   // $id=1;
   return '';
 }
 else
 {
   $id= ++$id['order_id'];
   $returnData= array('status'=>'success','data'=>$id,'status_code'=>200) ;
 }
 return $id;
}

function select_payment_details($table_name,$condition,$content_display)
{
 $this->db->select($content_display);
 $this->db->from($this->$table_name);
 if(!is_null($condition))
  $this->db->where($condition);
    // $this->db->join($this->table_invoices,''.$this->$table_name.'.invoice_id='.$this->table_invoices.'.invoice_id)' AND  );
$this->db->join($this->table_invoices,'invoices.invoice_id=payment_details.invoice_id and invoices.f_id=payment_details.f_id' );
  // $this->db->join($this->table_invoices,''.$this->$table_name.'.f_id='.$this->table_invoices.'.f_id');
$data= $this->db->get()->row_array();
if($data){

  return $data;
}
return array();   
}

function sales_report($table_name,$display_contents,$condition,$start_date='',$end_date='',$status='',$coloumn='created_at')
{



 $this->db->select($display_contents);
 $this->db->from($this->$table_name);

 $this->db->where($condition);
 $this->db->join($this->table_staff,''.$this->$table_name.'.created_by='.$this->table_staff.'.id');
 if(!empty($start_date) && !empty($end_date))
  $this->db->where("date(sales.".$coloumn.") BETWEEN '$start_date' AND '$end_date'");
if(!empty($status))
  $this->db->where('status',$status);
$data=$this->db->get()->result_array();


return $data;

}

function  payment_report($table_name,$display_contents,$condition,$start_date='',$end_date='',$status='',$coloumn='created_at')
{



 $this->db->select($display_contents);
 $this->db->from(''.$this->$table_name.' as t1');

 $this->db->where($condition);
 if(!empty($start_date) && !empty($end_date))
  $this->db->where("date(".$coloumn.") BETWEEN '$start_date' AND '$end_date'");

if(!empty($status))
  $this->db->where('status',$status);
$this->db->join(''.$this->table_crn.' as t2','t1.customer_id=t2.id');
$data=$this->db->get()->result_array();


return $data;

}


function initial_balance_status($table_name,$customer_id,$f_id)
{
  $this->db->select('initial_balance,paid,balance_status');
  $this->db->where(array('f_id'=>$f_id,'id'=>$customer_id));

  $this->db->where('status!=','paid');
  $this->db->limit(1);   
  $record=$this->db->get('crn')->row_array();
  if($record['initial_balance']==$record['paid'])
  {
    $this->db->where(array('f_id'=>$f_id,'id'=>$customer_id));
    $this->db->set('status',"paid");
    $this->db->update('crn');  
  }
  else if($record['initial_balance']>$record['paid'])
  {

    $this->db->where(array('f_id'=>$f_id,'id'=>$customer_id));
    $this->db->set('status',"partially");
    $this->db->update('crn');  
  }


}

function fetchSerialNoItem($table_name,$condition,$content_display)
{


 $this->db->select($content_display);
 $this->db->from(''.$this->$table_name.' as t1');
 if(!is_null($condition))
  $this->db->where($condition);
    // $this->db->join($this->table_invoices,''.$this->$table_name.'.invoice_id='.$this->table_invoices.'.invoice_id)' AND  );
$this->db->join(''.$this->table_purchase_master.' as t2','t2.purchase_id=t1.purchase_id and t1.f_id=t2.f_id');
  // $this->db->join($this->table_invoices,''.$this->$table_name.'.f_id='.$this->table_invoices.'.f_id');
$data= $this->db->get()->result_array();

return $data;





}







}