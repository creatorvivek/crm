<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Reports_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }



//     function salesAnalysis($table_name,$condition=null,$coloumn_name,$start_date='',$end_date='')
//     {

//     	 $this->db->select_sum($coloumn_name);
//  		 if(!is_null($condition))
//   		  $this->db->where($condition);
//   			 if(!empty($start_date) && !empty($end_date))
//   				$this->db->where("date(created_at) BETWEEN '$start_date' AND '$end_date'");
//  					 $count=$this->db->get($this->$table_name)->row_array();
//  					 return $count[$coloumn_name];





//     }




// function issueList($table_name,$condition,$content_display)
// {


//     $this->db->select($content_display);
//     $this->db->from($this->$table_name);
//     if(!is_null($condition))
//       $this->db->where($condition);
//     $this->db->join($this->table_staff,''.$this->$table_name.'.staff_id='.$this->table_staff.'.id');
//     $data= $this->db->get()->result_array();
//     if($data){
      
//     return $data;
//     }
//     return array();   
   
//   }

//   function dailyReport($table_name,$condition,$content_display,$start_date,$end_date)
//   {

//  $this->db->select($content_display);
//     $this->db->from($this->$table_name);
//     if(!is_null($condition))
//       $this->db->where($condition);
//     $this->db->join($this->table_staff,''.$this->$table_name.'.staff_id='.$this->table_staff.'.id');
//      if(!empty($start_date) && !empty($end_date))
//           $this->db->where("date(".$this->$table_name.".created_at) BETWEEN '$start_date' AND '$end_date'");
//     $data= $this->db->get()->result_array();
//     if($data){
      
//     return $data;
//     }
//     return array();   



//   }


function purchaseReport($table_name,$condition,$display_contents,$start_date='',$end_date='',$status='',$coloumn='created_at')
{

 
 
 $this->db->select($display_contents);
 $this->db->from(''.$this->$table_name.' as t1');

 $this->db->where($condition);
 $this->db->join(''.$this->table_vendor.' as t3','t1.vendor_id=t3.id');
 $this->db->join(''.$this->table_staff.' as t2','t1.created_by=t2.id');
 if(!empty($start_date) && !empty($end_date))
  $this->db->where("date(t1.".$coloumn.") BETWEEN '$start_date' AND '$end_date'");
if(!empty($status))
  $this->db->where('t1.status',$status);
$data=$this->db->get()->result_array();


return $data;

}


function accountTransaction($table_name,$condition,$display_contents,$start_date='',$end_date='',$status='',$coloumn='created_at')
{

$this->db->select($display_contents);
 $this->db->from(''.$this->$table_name.' as t1');

$this->db->order_by("created_at","asc");
 $this->db->where($condition);
 $this->db->join(''.$this->table_ledger_group.' as t2','t1.ledger_group=t2.id');
 $this->db->join(''.$this->table_account_transaction_type.' as t3','t1.reference_type=t3.id');
 if(!empty($start_date) && !empty($end_date))
  $this->db->where("date(t1.".$coloumn.") BETWEEN '$start_date' AND '$end_date'");
if(!empty($status))
  $this->db->where('t1.status',$status);

$data=$this->db->get()->result_array();
return $data;

}



function debitCreditAccountGroup($table_name,$condition,$display_contents)
{

$this->db->select($display_contents);
 $this->db->from(''.$this->$table_name.' as t1');

 $this->db->where($condition);
 $this->db->join(''.$this->table_ledger_group.' as t2','t1.ledger_group=t2.id');
 // $this->db->join(''.$this->table_staff.' as t2','t1.created_by=t2.id');
 $this->db->group_by('ledger_group');
//  if(!empty($start_date) && !empty($end_date))
//   $this->db->where("date(t1.".$coloumn.") BETWEEN '$start_date' AND '$end_date'");
// if(!empty($status))
//   $this->db->where('t1.status',$status);
$data=$this->db->get()->result_array();


return $data;
}


function vendor_ledger_report($table_name,$display_contents,$condition,$start_date='',$end_date='',$status='',$coloumn='created_at')
{

 $this->db->select($display_contents);
 $this->db->from("".$this->$table_name." as t1" );
  $this->db->join(''.$this->table_account_transaction_type.' as t2','t1.reference_type=t2.id');
 $this->db->where($condition);
 $this->db->order_by('created_at','inc');
 if(!empty($start_date) && !empty($end_date))
  $this->db->where("date(".$coloumn.") BETWEEN '$start_date' AND '$end_date'");
if(!empty($status))
  $this->db->where('status',$status);
$data=$this->db->get()->result_array();


return $data;

}

function sum_column_balance_sheet($table_name,$condition=null,$coloumn_name,$where_in_condition='',$start_date='',$end_date='')
{
  
  $this->db->select_sum($coloumn_name);
  if(!is_null($condition))
    $this->db->where($condition);
    if(!empty($where_in_condition))
    $this->db->where_in('ledger_group',$where_in_condition);
   if(!empty($start_date) && !empty($end_date))
  $this->db->where("date(created_at) BETWEEN '$start_date' AND '$end_date'");
  $count=$this->db->get($this->$table_name)->row_array();
    if($count[$coloumn_name])
    {
 return $count[$coloumn_name];
}
else
{
  return 0;
 
}

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
$this->db->join(''.$this->table_crn.' as t2','t1.vendor_id=t2.id');
$data=$this->db->get()->result_array();


return $data;

}











}