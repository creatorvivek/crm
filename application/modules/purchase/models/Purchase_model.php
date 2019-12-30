<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Purchase_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }


function stock_list($table_name,$condition,$content_display)
{


    $this->db->select($content_display);
    $this->db->from(''.$this->$table_name.' as t1');
    if(!is_null($condition))
      $this->db->where($condition);
  	$this->db->join(''.$this->table_staff.' as t2','t1.created_by=t2.id');
    $this->db->join(''.$this->table_item_stock.' as t3','t1.id=t3.item_id');
    $data= $this->db->get()->result_array();
    if($data){
      
    return $data;
    }
    return array();		
    // return json_encode($returnData);
  }



  function search($table_name,$condition,$content_display,$search)
  {
     $this->db->select($content_display);



    $this->db->from($this->$table_name);  
 
    $this->db->where($condition);
  
    $this->db->group_start();
    $this->db->where("item.item_name like '%$search%' ");
               // $this->db->or_where("crn.name like '%search_query%' ");
               $this->db->or_where("item.serial_no like '%$search%' ");
            
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
    $this->db->from($table_name);
    if(!is_null($condition))
      $this->db->where($condition);
    $this->db->join($this->table_invoices,''.$table_name.'.invoice_id='.$this->table_invoices.'.invoice_id');
    // $this->db->join($this->table_item,''.$this->$table_name.'.item_id='.$this->table_item.'.id');
    $data= $this->db->get()->row_array();
    if($data){
      
    return $data;
    }
    return array();   
 }



 ##purchase list with multiple joining of table

function purchase_list($table_name,$condition,$content_display)
{
  $this->db->select($content_display);
    $this->db->from(''.$this->$table_name.' as t1');
    if(!is_null($condition))
      $this->db->where($condition);
    // $this->db->join($this->table_item,''.$this->$table_name.'.item_id='.$this->table_item.'.id');
    $this->db->join(''.$this->table_crn.' as t2','t1.vendor_id=t2.id');
    $this->db->join(''.$this->table_staff.' as t3','t1.created_by=t3.id');

    // $this->db->join($this->table_item,''.$this->$table_name.'.item_id='.$this->table_item.'.id');
    $data= $this->db->get()->result_array();
    if($data){
      
    return $data;
    }
    return array();   
 }
##used in ajax
function fetch_item_details($table_name,$condition,$content_display)
{
 $this->db->select($content_display);
    $this->db->from(''.$this->$table_name.' as t1');
    if(!is_null($condition))
      $this->db->where($condition);
    $this->db->join(''.$this->table_item_stock.' t2','t2.item_id=t1.id');
    // $this->db->join($this->table_vendor,''.$this->$table_name.'.vendor_id='.$this->table_vendor.'.id');
    $this->db->join(''.$this->table_staff.' t3','t1.created_by=t3.id');

    // $this->db->join($this->table_item,''.$this->$table_name.'.item_id='.$this->table_item.'.id');
    $data= $this->db->get()->row_array();
    if($data){
      
    return $data;
    }
    return array();   
}


function getSellPurchaseSum($table_name,$condition=null,$selected_contents,$interval_unit,$group_by='MONTH',$order_by='MONTH')
{
   $this->db->select($selected_contents);
    $this->db->from($this->$table_name);
    if(!is_null($condition))
    $this->db->where($condition); 
        if(!is_null($interval_unit))
         $this->db->where(" DATE(created_at) between  DATE_SUB(CURDATE() ,".$interval_unit.") AND CURDATE()");
    $this->db->group_by(''.$group_by.'(created_at)');
    $this->db->order_by(''.$order_by.'(created_at)','asc');
    return $data=$this->db->get()->result_array();

}

function getSellPurchaseSumCurrent($table_name,$condition,$selected_contents,$interval_unit,$group_by='MONTH',$order_by='MONTH')
{


 
 $this->db->select($selected_contents);
  $this->db->from($this->$table_name);
 $this->db->where($condition);
  if(!is_null($interval_unit))
   $this->db->where(" DATE(created_at) between  DATE_FORMAT(CURDATE() ,'".$interval_unit."') AND CURDATE()");
  $this->db->group_by(''.$group_by.'(created_at)');
    $this->db->order_by(''.$order_by.'(created_at)','asc');
    return $data=$this->db->get()->result_array();




}

function purchase_order_id($table_name,$params)
{

  $this->db->select_max('purchase_id');
   $this->db->from($this->$table_name);
   $this->db->where($params);       
   $id = $this->db->get()->row_array();
      // return json_encode($id);
   if(is_null($id['purchase_id']))
   {
   // $id=1;
     $returnData= array('status'=>'not found','status_code'=>404) ;
   }
   else
   {
     $id= ++$id['purchase_id'];
     $returnData= array('status'=>'success','data'=>$id,'status_code'=>200) ;
   }
   return json_encode($returnData);
}

function fetch_purchase_order_details($table_name,$condition,$content_display)
{

 $this->db->select($content_display);
    $this->db->from(''.$this->$table_name.' as t1');
    if(!is_null($condition))
      $this->db->where($condition);
    
    $this->db->join(''.$this->table_item.' t3','t3.id=t1.item_id');
   
    $data= $this->db->get()->result_array();
    if($data){
      
    return $data;
    }
    return array();   


}

function fetch_purchase_vendor($table_name,$condition,$content_display)
{

    $this->db->select($content_display);
    $this->db->from(''.$this->$table_name.' as t1');
    if(!is_null($condition))
      $this->db->where($condition);
    
    $this->db->join(''.$this->table_crn.' t2','t2.id=t1.vendor_id');
   
    $data= $this->db->get()->row_array();
    if($data){
      
    return $data;
    }
    return array();   


}


    function search_query($table_name,$condition,$search_query)
    {


  
        $this->db->select('id,name,email,mobile,pincode,city,address');

        $this->db->from(''.$this->$table_name.' as t1');  

        $this->db->where($condition);

        $this->db->group_start();
        $this->db->where("t1.name like '$search_query%' ");

        $this->db->or_where("t1.mobile like '$search_query%' ");
        // $this->db->or_where("t1.company_name like '$search_query%' ");

        $this->db->group_end();

        $data=$this->db->get()->result_array();
        $sql = $this->db->last_query();
        return $data;
    }

function fetch_item_batch_wise($table_name,$condition,$content_display)
{

 $this->db->select($content_display);
    $this->db->from(''.$this->$table_name.' as t1');
    if(!is_null($condition))
      $this->db->where($condition);
    
    $this->db->join(''.$this->table_item.' t2','t2.id=t1.item_id');
   
    $data= $this->db->get()->result_array();
    if($data){
      
    return $data;
    }
    return array();   





}



##end of class
}