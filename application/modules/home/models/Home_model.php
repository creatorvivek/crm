<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Home_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }


function getSellPurchaseSum($table_name,$condition=null,$selected_contents,$interval_unit,$group_by='MONTHNAME',$order_by='MONTHNAME')
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
function getSellPurchaseSumCurrent($table_name,$condition,$selected_contents,$interval_unit,$group_by='MONTHNAME',$order_by='MONTHNAME')
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
function getPaymentSum($table_name,$condition=null,$selected_contents,$interval_unit,$group_by='MONTHNAME',$order_by='MONTHNAME')
{
   $this->db->select($selected_contents);
    $this->db->from($this->$table_name);
    if(!is_null($condition))
    $this->db->where($condition); 
        if(!is_null($interval_unit))
         $this->db->where("  Date(payment_date) between  DATE_SUB(CURDATE() ,".$interval_unit.") AND CURDATE()");
    $this->db->group_by(''.$group_by.'(payment_date)');
    $this->db->order_by(''.$order_by.'(payment_date)','asc');
    return $data=$this->db->get()->result_array();

}
function getPaymentCurrent($table_name,$condition,$selected_contents,$interval_unit,$group_by='MONTHNAME',$order_by='MONTHNAME')
{


 
 $this->db->select($selected_contents);
  $this->db->from($this->$table_name);

 $this->db->where($condition);
  if(!is_null($interval_unit))
   $this->db->where("   Date(payment_date) between  DATE_FORMAT(CURDATE() ,'".$interval_unit."') AND CURDATE()");
  $this->db->group_by(''.$group_by.'(payment_date)');
    $this->db->order_by(''.$order_by.'(payment_date)','asc');
    return $data=$this->db->get()->result_array();




}


}