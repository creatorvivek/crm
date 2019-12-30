<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Leave_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }



function leaveApplicationList($table_name,$condition,$selected_contents)
{
	
 
  $this->db->select($selected_contents);
  $this->db->from($this->$table_name);
  $this->db->where($condition);
  // $this->db->join('ticket','ticket.ticket_id=log_ticket.ticket_id and ticket.f_id=log_ticket.f_id');
  $this->db->join('leave_category',''.$this->$table_name.'.category_id=leave_category.id');
  $data=$this->db->get()->result_array();


 
    return $data;
  


}


function leaveNotification($table_name,$condition,$selected_contents)
{
  
 
  $this->db->select($selected_contents);
  $this->db->from(''.$this->$table_name.' as t1');
  $this->db->where($condition);
  // $this->db->join('ticket','ticket.ticket_id=log_ticket.ticket_id and ticket.f_id=log_ticket.f_id');
  $this->db->join('staff as t2','t1.staff_id=t2.id');
  $data=$this->db->get()->result_array();


 
    return $data;
  


}









}