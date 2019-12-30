<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Quotation_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }



function vendor_list($table_name,$condition,$selected_contents)
{
	
 
  $this->db->select($selected_contents);
  $this->db->from($this->$table_name);
  $this->db->where($condition);
  // $this->db->join('ticket','ticket.ticket_id=log_ticket.ticket_id and ticket.f_id=log_ticket.f_id');
  $this->db->join('staff','staff.id=vendor.staff_id','left');
  $data=$this->db->get()->result_array();


 
    return $data;
  


}










}